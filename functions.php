<?php
error_reporting(E_ALL);
//ini_set('display_errors', 'On');
session_start();

require_once 'RESTclient.php';
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
		if ($_SESSION['redmine']['username'] && $_SESSION['redmine']['password']) {
			return true;
		}  else {
			return false;
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

}

// Functions
function issues_result($field) {
	echo '<th align="left">' . ucfirst($field) . '</th>';
}
