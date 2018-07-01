<?php
global $conn;
include 'dbConnection.php';
if($_GET['sql'] == 'fetch') {
$sql = "SELECT * FROM students WHERE student_id = {$_GET['student_id']}";
			$rows = $conn->query($sql);

			$student = $rows->fetch(PDO::FETCH_ASSOC);

			$output = json_encode($student);
			echo $output;
		}
		elseif ($_GET['sql'] == 'update') {
			$id = $_GET['student_id'];
			$fn = $_GET['first_name'];
			$ln = $_GET['last_name'];
			$hc = $_GET['hrs_completed'];
			$ha = $_GET['hrs_attempted'];
			$gp = $_GET['gpa_points'];
			$ma = $_GET['major'];
			$ai = $_GET['advisor_id'];
			$em = $_GET['email'];


			$sql = "UPDATE students SET first_name = ?, last_name = ?, hrs_completed = ?, hrs_attempted = ?, gpa_points = ?, major = ?, advisor_id = ?, email = ? WHERE student_id = $id";
			$st = $conn->prepare($sql);
			$st->execute(array($fn, $ln, $hc, $ha, $gp, $ma, $ai, $em));
		}
		
?>