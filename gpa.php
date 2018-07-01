<?php
global $conn;
	include  'dbConnection.php';
	$sql = "SELECT student_id, last_name, gpa_points, hrs_attempted, advisors.advisor_id, advisors.email AS admail FROM students, advisors"; 
	$sql .= " WHERE students.advisor_id = advisors.advisor_id ORDER BY gpa_points/hrs_attempted";
		$rows = $conn->query($sql);

		$all_students = $rows->fetchAll(PDO::FETCH_ASSOC);

		$output = json_encode($all_students);
		echo $output;
?>