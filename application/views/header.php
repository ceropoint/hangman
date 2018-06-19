<!DOCTYPE html>
<html lang="en" ng-app="hangmanApp">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
	integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
	<link rel="stylesheet" href="<?php echo PATH; ?>css/style.css">
	<title><?php echo ($this->get('title')) ? $this->get('title') . ' | ' : '';?><?php echo MAIN_TITLE; ?></title>
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<?php if($this->get('loggedIn')): ?>
						<a class="navbar-brand" href="<?php echo PATH; ?>auth/logout"><i class="fa fa-sign-out"></i> Sign out</a>
					<?php else : ?>
						<a class="navbar-brand" href="<?php echo PATH; ?>auth/login"><i class="fa fa-sign-in"></i> Sign in</a>
						<a class="navbar-brand" href="<?php echo PATH; ?>auth/register"><i class="fa fa-user-plus"></i> Register</a>
					<?php endif; ?>
				</div>
			</div>
		</nav>
		