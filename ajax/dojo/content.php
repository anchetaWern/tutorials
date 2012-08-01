<?php
//convert JSON string into JSON
$obj = json_decode($_POST['obj']);

//JSON can't be accessed like arrays: $obj['names']
$names = $obj->names; //that's why we access them like accesing methods or properties from real objects like this
$languages = $obj->languages;
echo "<h1>Names: </h1>";
//we then loop through the items like how were used to with arrays
foreach($names as $row){
	echo "<li>".$row."</li>";
}

echo "<h1>Languages: </h1>";
foreach($languages as $row){
	echo "<li>".$row."</li>";
}
?>