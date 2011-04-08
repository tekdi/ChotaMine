<?php
require 'functions.php';

$data['username'] 	= $_POST['username'];
$data['password'] 	= $_POST['password'];
$data['url']		= $_POST['url'];

$redmine = new Redmine($url, $username, $password);
$login = $redmine->login();

if ($login) {
	Utils::storeAuth($data);
	Utils::storeUrl($_POST['url']);
		
	header('Location:issues.php');
} else {
	Utils::setMessage('Invalid username/password/API key or incorrect link. Please try again.');
	header('Location:login.php');
}
