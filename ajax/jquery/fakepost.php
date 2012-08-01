<?php
//advantage: you can access the submitted data using both $_GET and $_POST methods
echo "Im accessed via GET method\n";
echo "name: " . $_GET['name']."\n";
echo "technique: ". $_GET['technique']."\n\n";

//Accessing data using $_POST method
echo "Im accessed via POST method:\n";
echo "name: " . $_POST['name']."\n";
echo "technique: ". $_POST['technique']."\n";

?>