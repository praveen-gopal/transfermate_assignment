<?php
	include_once('dbconn.php');
	include_once('WritetoDB_Controller.php');
	include_once('ReadXML_Controller.php');
	
	$type = $_REQUEST["type"];
	
	if($type == 'ajaxCall') {
		
		$key = $_REQUEST["key"];
		
		if (strlen($key) > 2) {
		
			$writeIntoDB = new WritetoDB_Controller();			
			$authorList = $writeIntoDB->getAuthorsListByKey($key);
			
			// echo '<pre>'; print_r($authorList); die;
			
			if(!empty($authorList)) {
				$data = '<table class="table table-bordered"><thead><tr><th scope="col">Author</th><th scope="col">Book</th></tr></thead><tbody>';
				foreach($authorList as $value) {
					$data .= "<tr>";
					$data .= "<td>" .$value['AuthorName']."</td>";
					$data .= "<td>" .$value['BookName']."</td>";
					$data .= "</tr>";
				}
				$data .= '</tbody></table>';
				
				echo $data;
			} else {
				echo "No Records Found..!!!";
			}
		}	
	
	}
	
	if($type == 'cronJob') {
		$dirs  = 'xml_files';
		$readXML = new ReadXML_Controller($dirs);
		$writeIntoDB = new WritetoDB_Controller();
		$already_exists_authorAndBook = $writeIntoDB->insert($readXML->get_xml_data());
		// echo '<pre>'; print_r($already_exists_authorAndBook); die;
		
		/*
		$data = '<table border="1"><thead><tr><th scope="col">Author</th><th scope="col">Book</th></tr></thead><tbody>';
		foreach($already_exists_authorAndBook as $value) {
			$data .= "<tr>";
			$data .= "<td>" .$value['AuthorName']."</td>";
			$data .= "<td>" .$value['BookName']."</td>";
			$data .= "</tr>";
		}
		$data .= '</tbody></table>';
		echo $data;
		*/
		
		echo "Executed the Job successfully..!!!";
		
	}

?>