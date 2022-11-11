<?php

class ReadXML_Controller
{
    public function __construct($dirs)
    {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
		$this->dirs = $dirs;
    }
	
	function find_all_files($dir)
	{
		$root = scandir($dir);
		foreach($root as $value)
		{
			if($value === '.' || $value === '..') {continue;}
			if(is_file("$dir/$value")) {$result[]="$dir/$value";continue;}
			foreach($this->find_all_files("$dir/$value") as $value)
			{
				$result[]=$value;
			}
		}
		return $result;
	}
	
	function get_xml_data() : array {
		
		$xml_files_list = $this->find_all_files($this->dirs);
		$xml_files_data = [];
		
		foreach($xml_files_list as $file_names) {
			$xml = simplexml_load_file($file_names) or die("Error: Cannot create object");
			foreach($xml->children() as $row){
				$xml_files_data[] = (array) $row;
			}
		}
		return $xml_files_data;
	}
	
}
?>