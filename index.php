<?php
	include('header.php');
	
	/*
	include_once('ReadXML_Controller.php');
	include_once('WritetoDB_Controller.php');
	$dirs  = 'xml_files';

	$readXML = new ReadXML_Controller($dirs);
	$writeIntoDB = new WritetoDB_Controller();
	*/
	
	// echo "<pre>"; print_r($readXML->get_xml_data());
	// echo "<pre>"; print_r($writeIntoDB->getAuthersBooks());
	// echo "<pre>"; print_r($writeIntoDB->insert($readXML->get_xml_data()));
?>

<div class="container">    
	<h3>Search by Author</h3>
	<br>

	<div class="panel panel-primary">
		<div class="panel-heading">Search by Author</div>
		<div class="panel-body">
			<div class="row">
  
				<div class="col-md-4" style="margin-left:30px;">
					<input id="search" type="text" size="30" placeholder ="Search by author (Min 3 Char)" style="color: black">
				</div>
				
				<div class="col-md-8" style='width: 500px; margin-right: 80px; ' >
					<div id="search_result"></div>
				</div>
			
			</div>
		</div>
	</div>
</div>

<?php include('footer.php');?>