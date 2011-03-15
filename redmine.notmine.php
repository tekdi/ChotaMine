<?php
# (c) 2011 Thomas Spycher - Zero-One

 
/**
 * redmine class.
 * 
 */
class redmine {
 
	/**
	 * url
	 * 
	 * @var mixed
	 * @access private
	 */
	private $url;
 
	/**
	 * apikey
	 * 
	 * @var mixed
	 * @access private
	 */
	private $apikey;
 
	/**
	 * curl
	 * 
	 * @var mixed
	 * @access private
	 */
	private $curl;
 
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @param array $config. (default: array())
	 * @return void
	 */
	function __construct($config = array()) {
		$this->url = $config['url'];
		$this->apikey = $config['apikey'];
 
		//$this->listUsers();
	}
 
	/**
	 * runRequest function.
	 * 
	 * @access private
	 * @param mixed $restUrl
	 * @param string $method. (default: 'GET')
	 * @param string $data. (default: "")
	 * @return void
	 */
	private function runRequest($restUrl, $method = 'GET', $data = ""){
        $method = strtolower($method);
 
        $this->curl = curl_init();
 
        // Authentication
        if(isset($this->apikey)) {
			curl_setopt($this->curl, CURLOPT_USERPWD, "$this->apikey:".rand(100000, 199999) );
			curl_setopt($this->curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		}
 
        switch ($method) {
			case "post":
				curl_setopt($this->curl, CURLOPT_POST, 1);
				if(isset($data)) curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
				break;
			case "put":
				curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'PUT'); 
				if(isset($data)) curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
				break;
			case "delete":
				curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, "DELETE");
				break;
			default: // get
				break;
		}
 
		try {
			curl_setopt($this->curl, CURLOPT_URL, $this->url.$restUrl); 
			curl_setopt($this->curl, CURLOPT_PORT , 80); 
			curl_setopt($this->curl, CURLOPT_VERBOSE, 0); 
			curl_setopt($this->curl, CURLOPT_HEADER, 0); 
			curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($this->curl, CURLOPT_HTTPHEADER, array("Content-Type: text/xml", "Content-length: ".strlen($data))); 
 
			$response = curl_exec($this->curl); 
			if(!curl_errno($this->curl)){ 
		  		$info = curl_getinfo($this->curl); 
			} else { 
				curl_close($this->curl); 
				return false;
			}
 
 
			curl_close($this->curl); 
		} catch (Exception $e) {
    		return false;
		}
 
		if($response) {
			if(substr($response, 0, 1) == '<') {
				return new SimpleXMLElement($response);
			} else {
				return false;
			}
		}
		return true;
    }
 
	/**
	 * getUsers function.
	 * 
	 * @access public
	 * @return void
	 */
	public function getUsers() {
		return $this->runRequest('/users.xml', 'GET', '');
	}
 
	/**
	 * getProjects function.
	 * 
	 * @access public
	 * @return void
	 */
	public function getProjects() {
		return $this->runRequest('/projects.xml', 'GET', '');
	}
 
	/**
	 * getIssues function.
	 * 
	 * @access public
	 * @param mixed $projectId
	 * @return void
	 */
	public function getIssues($projectId) {
		return $this->runRequest('/issues.xml'.$projectId, 'GET', '');
	}
 
	/**
	 * addIssue function.
	 * 
	 * @access public
	 * @param mixed $subject
	 * @param mixed $description
	 * @param mixed $project_id
	 * @param int $category_id. (default: 1)
	 * @param bool $created_on. (default: false)
	 * @param bool $start_date. (default: false)
	 * @param bool $due_date. (default: false)
	 * @return void
	 */
	public function addIssue($subject, $description, $project_id, $category_id = 1, $assignmentUserId = 1, $created_on = false, $due_date = false) {
		$priority_id = 4;
 
		$xml = new SimpleXMLElement('<?xml version="1.0"?><issue></issue>');
		$xml->addChild('subject', htmlentities($subject));
		$xml->addChild('project_id', $project_id);
		$xml->addChild('priority_id', $priority_id);
		$xml->addChild('description', htmlentities($description));
		$xml->addChild('category_id', $category_id);
		if($created_on) $xml->addChild('start_date', $created_on);		
		if($due_date) $xml->addChild('due_date', $due_date);
		$xml->addChild('assigned_to_id', $assignmentUserId);
 
		return $this->runRequest('/issues.xml', 'POST', $xml->asXML() );
	}
 
	/**
	 * addNoteToIssue function.
	 * 
	 * @access public
	 * @param mixed $issueId
	 * @param mixed $note
	 * @return void
	 */
	public function addNoteToIssue($issueId, $note) {
		$xml = new SimpleXMLElement('<?xml version="1.0"?><issue></issue>');
		$xml->addChild('id', $issueId);
		$xml->addChild('notes', htmlentities($note));
		return $this->runRequest('/issues/'.$issueId.'.xml', 'PUT', $xml->asXML() );
	}
 
}
?>
