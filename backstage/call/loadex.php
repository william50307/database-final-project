<?php

	// $uploaddir = 'call/excel/';
	// $uploadfile = $uploaddir . basename($_FILES['excel']['name']);
	
	// if (move_uploaded_file($_FILES['excel']['tmp_name'], $uploadfile)) {
 //   		echo "File is valid, and was successfully uploaded";
	// } else {
	//     echo "Possible file upload attack!";
	// }

	
	try{
	  $hostname = "localhost"; 
	  $dbname = "form"; 
	  $username = "root"; 
	  $pw = "lis#2451,."; 
	  $dbh = new PDO("mysql:host=$hostname;dbname=$dbname","$username","$pw"); 
	  $dbh->query('SET NAMES "utf8"');  
	} catch (PDOException $e) { 
	  echo "Failed to get DB handle: " . $e->getMessage() . "\n"; 
	  exit; 
	}  
	// $res = $dbh->query("select * from form order by id desc limit 1 ")->fetch();  
	// printf("<pre>");
	// print_r(substr($res['id'],0,2));
	// printf("</pre>");
	// $res['id'] = intval(doubleval(substr($res['id'],0,2)))+1; 
	
	//phpExcel開始 
	$file = $_FILES['excel']['tmp_name'];
	ini_set('memory_limit','1024M');  
	require_once('phpExcel-1.8/Classes/PHPExcel/IOFactory.php'); 
	$Excel = PHPExcel_IOFactory::createReader('Excel5');  
	$Excel = PHPExcel_IOFactory::load($file);   
	//$objWorksheet = $objPHPExcel->getActiveSheet();  
	$sheet = $Excel->getSheet(0);  
	
	$array_out[] = null;  
	foreach ($sheet->getRowIterator() as $row_key => $row){  
	  $cellIterator = $row->getCellIterator();  
	  $cellIterator->setIterateOnlyExistingCells(false);   
	  foreach ($cellIterator as $cell_key => $cell){   
	    $array_out[$row_key][$cell_key] = $cell->getValue().''; 

	  } 
	} 
	$length = count($array_out)-1;
	$atts = count($array_out[1]);
	// for($i=1;$i<=$length;$i++){ 
	//  for($j=0;$j<=1;$j++){ 
	//   if($j==0){ $a = $array_out[$i][0]; } 
	//     if($j==1){ $b = $array_out[$i][1]; } 
	//  } 
	 
	//   $ins = $dbh->query("insert into form (t_id,t_name,t_phone) values ('t$res[t_id]','$a','$b')");      
	// }
	
	
	for($i=2;$i<=$length;$i++){
		$str = "";
		$values = array();
		foreach ($array_out[$i] as $key => $value) {
			$value = "'".$value."'";
			array_push($values,$value);
		}
		$str = join(",",$values);
		$ins = $dbh->query("insert into `form` (`stuid`,`zone`,`name`,`phone`,`extention`,`mail`,`quename`,`que`,`note`) values ($str)");
	}
	// printf("<pre>");
	// print_r($values);
	// printf("</pre>");
?>