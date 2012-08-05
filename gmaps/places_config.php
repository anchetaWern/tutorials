<?php
$db = new Mysqli("localhost", "root", "1234", "placio"); 
if ($db->connect_errno){
	die('Connect Error: ' . $db->connect_errno);
}
?>