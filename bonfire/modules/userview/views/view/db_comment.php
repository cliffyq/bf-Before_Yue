<?php
//session_start();

$host="localhost"; // Host name
$username="test"; // Mysql username
$password="test"; // Mysql password
$db_name="bonfire"; // Database name
$tbl_name="bf_comment"; // Table name

$conn = mysql_connect($host,$username,$password);
if (!$conn){
	die("Failed£º" . mysql_error());
}
mysql_select_db("bonfire", $conn);
?>