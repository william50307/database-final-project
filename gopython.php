<?php
// This is the data you want to pass to Python
$data = array('as', 'df', 'gh');
$data = json_encode($data);

$result = shell_exec('C:\xampp\htdocs\db\DBMS1\test.py '. '123');#pid
echo ($result);//取得關鍵字
?>