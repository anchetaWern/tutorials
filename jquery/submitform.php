<?php
//accessing everthing submitted via POST
//print_r($_POST);

//accessing individual fields
//echo $_POST['one_name'];

//accessing fields with the same field name
echo "Names: \n";
foreach($_POST['name'] as $row){
	echo "\t".$row."\n";
} 
?>
