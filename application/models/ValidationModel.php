<?php

class ValidationModel extends Model{
	private $errorHandler;
	private $validator;

	public function init(){
		$this->errorHandler = new ErrorHandler;
		$this->validator = new Validation($this->errorHandler, $this->db);

		return $this;	
	}

	public function validate($input, $rules){
		return $this->validator->check($input, $rules);
	}

	public function errors(){
		return $this->validator->errors()->all();
	}

	public function addError($error, $key = null){
		$this->errorHandler->add($error, $key);
	}
	
	public function success(){
		return $this->validator->success();
	}

	public function get($item){
		return $this->validator->valid($item);
	}
}