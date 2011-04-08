<?php
require_once 'ActiveResource.php';

class Redmine {

	var $url 		= '';
	var $username 	= '';
	var $password 	= '';
	
	function Redmine($url='', $username='', $password='') {
		$this->url 			= $url ? $url : $_SESSION['redmine_auth']['url'];
		$this->username		= $username ? $username : $_SESSION['redmine_auth']['username'];
		$this->password		= $password ? $password : $_SESSION['redmine_auth']['password'];
		
		if (substr($this->url,0,8) == 'https://') {
			$site = str_replace('https://', '', $this->url);
			$this->site = 'https://'.$this->username.':'.$this->password.'@'.$site;
		} elseif (substr($this->url,0,7) == 'http://') {
			$site = str_replace('http://', '', $this->url);
			$this->site = 'http://'.$this->username.':'.$this->password.'@'.$site;
		} else {
			$this->site			= 'http://'.$this->username.':'.$this->password.'@'.$this->url;
		}

	}
	
	function login() {
		
		$user = new ActiveResource();
		$user->element_name 	= 'users';
		$user->site 			= $this->site;
		$user->request_format	= 'xml';
		try {
			$user->find('current');
		} catch (Exception $e) {
			$user->set('mail', '');
		}
		$mail = $user->__get('mail');

		if (strlen($mail) > 6) {
			return true;
		} else {
			return false;
		}
	}
	
	function getProjects() {
		if (isset($_SESSION['redmine_data']['projects']) && is_object($_SESSION['redmine_data']['projects'])) {
			return $_SESSION['redmine_data']['projects'];
		}

		$inputs['limit'] = 100;
		$projects = new ActiveResource();
		$projects->element_name 	= 'projects';
		$projects->site 			= $this->site;
		$projects->request_format	= 'json';
		$projects->find('all', $inputs);
		
		$output = $projects->_data;
		$_SESSION['redmine_data']['projects'] = $output;

		return $output;
	}

	function getUsers() {
		if (isset($_SESSION['redmine_data']['users']) && is_object($_SESSION['redmine_data']['users'])) {
			return $_SESSION['redmine_data']['users'];
		}

		$inputs['limit'] = 100;
		$projects = new ActiveResource();
		$projects->element_name 	= 'users';
		$projects->site 			= $this->site;
		$projects->request_format	= 'json';
		$projects->find('all', $inputs);
		
		$output = $projects->_data;
		$_SESSION['redmine_data']['users'] = $output;

		return $output;
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
	}
	
	function saveIssues( $issues ) {
		
		$i = 0;
		foreach ($issues as $k => $issue) {
			if (!$issue['subject']) continue;
			
			$rest = new ActiveResource($issue);
			$rest->element_name 	= 'issues';
			$rest->site 			= $this->site;
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
