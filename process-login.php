<?php
require 'functions.php';

$username 	= $_POST['username'];
$password 	= $_POST['password'];
$url		= $_POST['url'];

$redmine = new Redmine($url, $username, $password);
$login = $redmine->login();

if ($login) {
	$_SESSION['redmine']['username'] 	= $_POST['username'];
	$_SESSION['redmine']['password'] 	= $_POST['password'];
	$_SESSION['redmine']['url'] 		= $_POST['url'];

	if ($_POST['save_url']) {
		Utils::storeUrl($_POST['url']);
	}
		
	header('Location:issues.php');
} else {
	Utils::setMessage('Invalid username/password/API key or incorrect link. Please try again.');
	header('Location:login.php');
}
