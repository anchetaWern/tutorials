<?php
//accessing form data
/*
echo "Name: ".$_POST['one_name']. "\n";
echo "Language: ".$_POST['one_language'];
*/

print_r($_POST);

//accessing repititive form data (sorry if I messed up the naming, what I mean by this is 
//accessing the data from form fields which are repeating. In this case the name. Note that this only works if we
//name our text fields like this: age[] note the open and close brackets right after the actual name of the field). 
echo "Names: \n";
foreach($_POST['name'] as $row){
	echo "\t".$row."\n";
}
?>