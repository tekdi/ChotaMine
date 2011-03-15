<?php
require_once 'RESTclient.php';
require_once 'ActiveResource.php';
/*
$inputs		        = array();
$url = 'http://219.64.91.134:880/projects.json?key=8fba3c47dd27cf93a7e7a9f9201c6fe71fb65b90';
$inputs['key'] = '8fba3c47dd27cf93a7e7a9f9201c6fe71fb65b90';

$rest = new RESTclient();
$rest->createRequest($url, "GET", $inputs);
$rest->sendRequest();
$output = $rest->getResponse();
//print_r($rest);
echo '<h2>Create</h2>';
echo $output;
*/
class Redmine extends RESTClient {

	var $url 		= '';
	var $username 	= '';
	var $password 	= '';
	
	function Redmine($url, $username, $password) {
		$this->url 			= $url ? $url : $_SESSION['redmine']['url'];
		$this->username		= $username ? $username : $_SESSION['redmine']['username'];
		$this->password		= $password ? $password : $_SESSION['redmine']['password'];
	}
	
	function login() {
		$rest = new RESTclient($this->url.'projects.json?limit=1', $this->username, $this->password);
		$output = $rest->getResponse();
		$op = json_decode($output);
		
		if (isset($op->projects)) {
			return true;
		} else {
			return true;
		}
	}
	
	function getProjects() {
		if (is_object($_SESSION['redmine']['projects'])) {
			return json_decode($_SESSION['redmine']['projects']);
		}
		
		$rest = new RESTclient($this->url.'projects.json?limit=100', $this->username, $this->password);
		$output = $rest->getResponse();
		$_SESSION['redmine']['projects'] = $output;

		return json_decode($output);
	}

	function getUsers() {
		if (is_object($_SESSION['redmine']['users'])) {
			return json_decode($_SESSION['redmine']['users']);
		}
		
		$rest = new RESTclient($this->url.'users.json?limit=100', $this->username, $this->password);
		$output = $rest->getResponse();
		$_SESSION['redmine']['users'] = $output;

		return json_decode($output);

	}
	
	function processProjects($projects) {
		$temp = array();
		foreach ($projects->projects as $project) {
			
			@$parent = $project->parent;
			$pid = $project->id;
			
			if ($parent) {
				$name = ' > ' . $project->name;
			} else {
				$name = $project->name;
			}
			$temp[$pid] = $name;

		}
		
		$temp = array(0 => 'Select Project') + $temp; // Note the + array_unshift will reassign keys		
		return $temp;
	}
	
	
	function processUsers($users) {
		$temp = array();
		foreach ($users->users as $user) {
			$temp[$user->id] = $user->firstname . ' ' . $user->lastname;
		}

		$temp = array(0 => 'Select User') + $temp; // Note the + array_unshift will reassign keys
		return $temp;
	}

	function saveProject($project) {
		$rest = new ActiveResource($project);	
		$rest->element_name 	= 'projects';
		$rest->site 			= $this->url;
		$rest->user 			= $this->username;
		$rest->password 		= $this->password;
		$rest->request_format	= 'xml';
		$rest->save();
		print_r($rest);
	}
	
	function saveIssues( &$issues ) {
		
		$i = 0;
		foreach ($issues as $k => $issue) {
			if (!$issue['subject']) continue;
			
			$rest = new ActiveResource($issue);
			$rest->element_name 	= 'issues';
			$rest->site 			= $this->url;
			$rest->user 			= $this->username;
			$rest->password 		= $this->password;
			$rest->request_format	= 'xml';
			$rest->save();
			$op = $rest->__get('id');

			if ($op > 0) {
				$issue['id'] = $op;
			} else {
				$issue['id'] = 'Failed';
			}
			
			$temp[$i] = $issue;
			$i++;
		}
		
		return $temp;	
	
	}
}
