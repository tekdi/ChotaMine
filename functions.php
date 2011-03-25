<?php
error_reporting(0);
//error_reporting(0);
//ini_set('display_errors', 'On');
session_start();
$_SESSION['redmine_auth'] = array();
$_SESSION['redmine_message'] = '';

require_once 'redmine.php';
require_once 'config.php';

class Utils {
	
	function select($options, $name, $attribs='') {
		$html = '<select name="'.$name.'" ' .$attribs . '>';
		foreach ($options as $k => $option)  {
			$html .= '<option value="'.$k.'">'.$option.'</option>';
		}
		$html .= '</select>';
		
		return $html;
	}
	
	function getAttribute($object, $attribute)
	{
		if(isset($object[$attribute]))
			return (string) $object[$attribute];
	}
	
	function getProcessLink($path='') {
	
		$file = basename($path);
		$file = 'process-'.$file;
		
		return $file;
	}
	
	function isLoggedin() {
		$url = isset($_SESSION['redmine']['url']) || $_COOKIE['redmine_url'];
		if (isset($_SESSION['redmine']['username']) && isset($_SESSION['redmine']['password']) && $url) {
			return true;
		}  else {
			return false;
		}
	
	}
	
	function requireLogin() {
		if (!Utils::isLoggedin()) {
			Utils::setMessage('Please Login');
			header('Location: login.php');
		}
	}
	
	function collectIssues($issues) {
		$keys = array_keys($issues);
		$count = count($issues[$keys[0]]);
		
		for ($i=0; $i<$count; $i++) {
			foreach ($keys as $key) {
				$temp[$i][$key] = $issues[$key][$i];
			}
			$temp[$i]['project_id'] = $_POST['project'];
		}
		
		return $temp;
	}
	
	function customFieldRow($fields) {
		
		$i = 0;
		$html = '';
		
		foreach ($fields as $field) {
			$class = 'row' . ($i & 1);

			$html .= '<tr class="'.$class.'">';
			$html .= '<td align="right">'.$field->name.'</td>';
			$html .= '<td align="left"><input type="text" name="project[custom_field_values]['.$field->id.']" size="30" /></td>';
			$html .= '</tr>';
			
			$i++;
		}
		return $html;
	}
	
	function showMessage() {
		if ($_SESSION['redmine_message'])
			$html = '<p class="message">'.$_SESSION['redmine_message'].'</p>';
		else
			$html = '';
		
		// Clear message
		Utils::setMessage('');
		
		return $html;
	}
	
	function setMessage($message) {
		$_SESSION['redmine_message'] = $message;
	}
	
	function storeUrl($url) {
		$urls = explode('|*|', $_COOKIE['redmine_url']);
		$urls[] = urlencode($url);
		$urls = implode('|*|', $urls);
		
		setcookie('redmine_url', $urls, time() + (365*24*3600));
	}
	
	function getLastUrl() {

		$urls = Utils::getUrls();
		return end($urls);
	}
	
	function getUrls() {
		$temp = array();
		$urls = explode('|*|', $_COOKIE['redmine_url']);
		foreach ($urls as $url) {
			if ($url) $temp[urldecode($url)] = urldecode($url);
		}

		return $temp;
	}

}

// Functions

/*
 * Needed as a walk array callback
 */
function issues_result($field) {
	echo '<th align="left">' . ucfirst($field) . '</th>';
}
