<?php

class AuthController extends Controller{
	private $authModel;

	public function __construct(){
		parent::__construct();

		$this->authModel = $this->loadModel('authentication')->init();
	}

	public function login(){
		$this->view->set('title', 'Login');

		// If user is logged in, redirect to game
		if($this->authModel->isLoggedIn()) redirect(PATH);

		$this->view->render('auth/login');
	}

	public function loginUser(){
		$validationModel = $this->loadModel('validation')->init();

		// Decode JSON POST data
		$data = decodePost();

		// Specify validation rules for input fields
		$validationRules = [
			'email' => [
				'required' => true,
				'email' => true
			],
			'password' => [
				'required' => true
			]
		];

		$validationModel->validate($data, $validationRules);

		// Check if validation passed succesfully
		if($validationModel->success()){
			$user = $validationModel->get('email');
			$pass = $validationModel->get('password');

			$this->authModel->login($user, $pass);

			if($this->authModel->isLoggedIn()){
				echo toJson(['success' => true]);
			}else{
				echo toJson(['errors' => 'Incorrect email or password.']);
			}
		}else{
			echo toJson(['errors' => $validationModel->errors()]);
		}
	}

	public function register(){
		$this->view->set('title', 'Register');

		if($this->authModel->isLoggedIn()) redirect(PATH);

		$this->view->render('auth/register');
	}

	public function registerUser(){
		$validationModel = $this->loadModel('validation')->init();

		// Decode JSON POST data
		$data = decodePost();

		// Specify validation rules for input fields
		$validationRules = [
			'email' => [
				'required' => true,
				'email' => true,
				'unique' => 'users'
			],
			'password' => [
				'required' => true,
				'min' => 6,
				'matches' => 'confirm_password'
			],
		];

		$validationModel->validate($data, $validationRules);
		
		// Check if validation passed succesfully
		if($validationModel->success()){
			$user = $validationModel->get('email');
			$pass = $validationModel->get('password');

			if($this->authModel->register($user, $pass)){
				echo toJson(['success' => true]);
			}else{
				echo toJson(['errors' => 'Registration failed. Please, try again.']);
			}
		}else{
			echo toJson(['errors' => $validationModel->errors()]);
		}
	}

	public function logout(){
		$this->authModel->logout();
		
		redirect(PATH . 'auth/login');
	}
}