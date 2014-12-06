<?php
$db = new MySqli('localhost', 'root', '', 'tutorials');

$action = (!empty($_POST['action'])) ? $_POST['action'] : '';
$student = (!empty($_POST['student'])) ? $_POST['student'] : '';


if(!empty($student)){
	$name = $student['name'];
	$age = $student['age'];	
}

switch($action){

	case 'insert':

		$db->query("INSERT INTO students SET name = '$name', age = '$age'"); 
		echo $db->insert_id; //last insert id
	break;

	case 'update':

		$id = $student['id'];
		$db->query("UPDATE students SET name = '$name', age = '$age' WHERE id = '$id'");
	break;

	case 'delete':

		$id = $_POST['student_id'];
		$db->query("UPDATE students SET status = 0 WHERE id = '$id'");
	break;

	default:
		$students = $db->query("SELECT * FROM students WHERE status = 1");
		$students_r = array();
		while($row = $students->fetch_array()){

			$id = $row['id'];
			$name = $row['name'];
			$age = $row['age'];
			$name_update = false;
			$age_update = false;
			$name_focus = false;
			$age_focus = false;

			$students_r[] = array(
				'id' => $id, 'name' => $name, 'age' => $age, 
				'nameUpdate' => $name_update, 'ageUpdate' => $age_update,
				'nameHasFocus' => $name_focus, 'ageHasFocus' => $age_focus
				); 
		}

		echo json_encode($students_r);
	break;
}
?>