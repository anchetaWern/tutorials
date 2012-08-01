<?php
//output contents of the $_POST variable
echo "output contents of the POST variable:\n";
print_r($_POST);

//output only the contents of the names object
echo "output only the names:\n";
print_r($_POST['names']);

//output the contents of the letters array
echo "output the contents of the letters array:\n";
print_r($_POST['letters']);
?>