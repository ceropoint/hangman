<?php

class View{
	private $data = [];

	public function render($name){
		$header = ROOT . DS . 'application' . DS . 'views' . DS . 'header.php';
		$content = ROOT . DS . 'application' . DS . 'views' . DS . $name . '.php';
		$footer = ROOT . DS . 'application' . DS . 'views' . DS . 'footer.php';

		$page = [$header, $content, $footer];

		// Display error page if view does not exist
		if(!file_exists($content)) regError('View ' . $name . ' does not exist.');

		foreach($page as $file){
			require_once $file;
		}
	}

	public function set($key, $value){
		$this->data[$key] = $value;
	}

	public function get($key){
		return (isset($this->data[$key])) ? $this->data[$key] : null;
	}

}