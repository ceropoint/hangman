<?php

class GameController extends Controller{
	private $authModel;
	private $gameModel;
	private $userId;

	public function __construct(){
		parent::__construct();

		$this->authModel = $this->loadModel('authentication')->init();

		// If user is not logged in, redirect to login page
		if(!$this->authModel->isLoggedIn()) redirect(PATH . 'auth/login');

		$this->gameModel = $this->loadModel('game');

		$this->view->set('loggedIn', true);
		$this->userId = $this->authModel->getUserData('id');
	}

	public function index(){
		$this->view->set('title', 'Game');

		$this->view->set('alphabet', $this->gameModel->getLetters());
		$this->view->set('categories', $this->gameModel->getCategories());
		
		$this->view->render('game/index');
	}
	
	public function getRandomWord($cat){
		echo toJson($this->gameModel->getRandomFromCategory($cat));
	}

	public function getStats(){
		echo toJson($this->gameModel->getStatistics($this->userId));
	}

	public function updateStats(){
		$data = decodePost(false);
		
		echo toJson(['success' => $this->gameModel->updateUserStats($this->userId, $data->stat)]);
	}
}