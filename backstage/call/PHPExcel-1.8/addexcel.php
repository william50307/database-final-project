<?php
	require_once 'Classes/PHPExcel.php';
	require_once 'Classes/PHPExcel/IOFactory.php';
	require_once 'Classes/PHPExcel/Reader/Excel5.php';

	include("call/connMysql.php");
    if (!@mysqli_select_db($db_link, "form")) die("資料庫選擇失敗！");

    $filename = $_POST["excel"]

	$objReader = PHPExcel_IOFactory::createReader('xlsx');//use excel2007 for 2007 format 
	$objPHPExcel = $objReader->load($filename); //$filename可以是上傳的檔案，或者是指定的檔案
	$sheet = $objPHPExcel->getSheet(0); 
	$highestRow = $sheet->getHighestRow(); // 取得總行數 
	$highestColumn = $sheet->getHighestColumn(); // 取得總列數

	$k = 0; 
	//迴圈讀取excel檔案,讀取一條,插入一條
	for($j=2;$j<=$highestRow;$j  )
	{
	$a = $objPHPExcel->getActiveSheet()->getCell("mail".$j)->getValue();//獲取A列的值
	$b = $objPHPExcel->getActiveSheet()->getCell("name".$j)->getValue();//獲取B列的值
	$sql = "INSERT INTO table VALUES(".$a.",".$b.")";
	mysql_query($db_link, $sql);
	}
?>