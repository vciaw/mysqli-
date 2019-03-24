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
	$time = time();
	$sql = $con -> query("INSERT INTO data (name,content,time) VALUES ('$_POST[name]', '$_POST[content]', '$time')");
	if($sql){
		echo "add one record";
	}
	else{
		echo 'failed'.mysql_error();
	}
?> 	