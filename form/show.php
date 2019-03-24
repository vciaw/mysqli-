<?php
$host = 'localhost';
$user = 'root';
$paddwd = 'root';
$database = 'test';
$con = new mysqli($host,$user,$paddwd,$database);
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }
$con->set_charset('utf8');
$result = $con -> query("SELECT * FROM data");
while($row = $result->fetch_array()){
		echo $row['name'].'<br/>';
		echo $row['content'].'<br/>';
		echo date('y-m-d',$row{'time'}).'<br/>';
	}
?>