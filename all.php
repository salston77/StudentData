<?php
global $conn;
	include  'dbConnection.php';
	$sql = "SELECT * FROM students";
		$rows = $conn->query($sql);

		$all_students = $rows->fetchAll(PDO::FETCH_ASSOC);

		$output = json_encode($all_students);
		echo $output;
?>