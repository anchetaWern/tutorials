<?php
//output all of the contents of the $_POST variable
echo "output all of the contents of the POST variable:\n";
print_r($_POST);

//output specific array
echo "output specific array:\n";
print_r($_POST['names']);

//output all of the objects contents
echo "output all of the objects contents:\n";
print_r($_POST['foods']);

//output only the foods
echo "output only the foods:\n";
print_r($_POST['foods']['names']);

//output a specific food
echo "output a specific food:\n";
echo $_POST['foods']['names'][0];
?>