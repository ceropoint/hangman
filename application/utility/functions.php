<?php

// Autoload classes
spl_autoload_register(function($class){
    $paths = [
        ROOT . DS . 'application' . DS . 'core' . DS . $class . '.php',
        ROOT . DS . 'application' . DS . 'controllers' . DS . $class . '.php',
        ROOT . DS . 'application' . DS . 'models' . DS . $class . '.php',
        ROOT . DS . 'application' . DS . 'utility' . DS . $class . '.php',
        ROOT . DS . 'application' . DS . 'utility' . DS . 'phpmailer' . DS . 'class.' . strtolower($class) . '.php'
    ];

    foreach($paths as $path){
        if(file_exists($path)){
            require_once $path;
            break;
        }
    }
});

// Escape output
function esc($str){
	return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// Get class name
function getClassByName($name, $type = ''){
    $className = ucfirst($name);

    return $className .= ($type !== 'model') ? 'Controller' : 'Model';
}

// Redirect to page
function redirect($location){
    // Loose comparison allows for some flexibility
    $header = ($location != 404) ? 'Location: ' . $location : 'HTTP/1.0 404 Not Found';

    header($header);
    exit;
}

// Encode data into JSON format
function toJson($data){
    return json_encode($data);
}

// Decode data from a JSON format into PHP object/array
function fromJson($data, $toArray = false){
    return json_decode($data, $toArray);
}

function decodePost($toArray = true){
    $post = file_get_contents("php://input");
    
    return json_decode($post, $toArray);
}

// Register the occurence of an unexpected error
function regError($msg){
    // Development
    echo '<pre>' . $msg . '</pre><hr>';

    // Display error page to user
    $error = new ErrorController;
    $error->show();

    redirect(404);
}