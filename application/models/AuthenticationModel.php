<?php

class AuthenticationModel extends Model{
	private $session;
	private $user;

	public function init(){
		$this->session = new Session;
		$this->user = new User($this->session, $this->db, new Hash);

		return $this;
	}

	public function login($user, $pass){
		$this->user->login($user, $pass);
	}

	public function register($user, $pass){
		return $this->user->register($user, $pass);
	}

	public function logout(){
		$this->user->logout();
	}

	public function isLoggedIn(){
		return $this->user->isLoggedIn();
	}

	public function getUserData($field){
		return $this->user->get($field);
	}
}