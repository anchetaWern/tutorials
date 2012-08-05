<?php
require_once('places_config.php');
$place = $_POST['place'];
$description = $_POST['description'];
$latitude = $_POST['lat'];
$longitude = $_POST['lng'];
$db->query("INSERT INTO tbl_places SET place='$place', description='$description', lat='$latitude', lng='$longitude'");
$place_id = $db->insert_id;
echo $place_id;
?>