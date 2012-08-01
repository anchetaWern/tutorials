<?php
//output everything submitted via POST
//print_r($_POST);

//output everything submitted via GET
//print_r($_GET);

//loop through the array
/*
foreach($_POST as $row){
	echo $row."\n";
} 
*/
$obj = json_encode($_POST);
print_r($obj);
?>