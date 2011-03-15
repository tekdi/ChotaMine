<?php
require 'functions.php';

$username = $_POST['username'];
$password = $_POST['password'];
$redmine = new Redmine(REMINE_URL, $username, $password);
$login = $redmine->login();

if ($login) {
	$_SESSION['redmine']['username'] = $_POST['username'];
	$_SESSION['redmine']['password'] = $_POST['password'];
	header('Location:issues.php');
} else {
	header('Location:login.php');
}
