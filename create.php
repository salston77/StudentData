<?php
global $conn;
include 'dbConnection.php';
	$id = $_GET['student_id'];
			$fn = $_GET['first_name'];
			$ln = $_GET['last_name'];
			$hc = $_GET['hrs_completed'];
			$ha = $_GET['hrs_attempted'];
			$gp = $_GET['gpa_points'];
			$ma = $_GET['major'];
			$ai = $_GET['advisor_id'];
			$em = $_GET['email'];

			$sql = "INSERT INTO students VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$st = $conn->prepare($sql);
			$st->execute(array($id, $fn, $ln, $hc, $ha, $gp, $ma, $ai, $em));
?>