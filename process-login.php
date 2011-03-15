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
	
	if ($_POST['save_url'] || $_SESSION['redmine']['url'])
		setcookie('redmine_url', $_SESSION['redmine']['url'], time() + (365*24*3600));
		
	header('Location:issues.php');
} else {
	header('Location:login.php');
}
