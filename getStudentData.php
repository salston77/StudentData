<?php 
	include 'includes/header.php';

	function returnStudents() {
		global $conn;

		$sql = "SELECT * FROM students";
		$rows = $conn->query($sql);

		$all_students = $rows->fetchAll(PDO::FETCH_ASSOC);

		$output = json_encode($all_students);
		echo $output;
	}

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		if(isset($_GET['student_id'])) {
			$sql = "SELECT * FROM students WHERE student_id = {$_GET['student_id']}";
			$rows = $conn->query($sql);

			$student = $rows->fetch(PDO::FETCH_ASSOC);

			$output = json_encode($student);
			echo $output;
			exit;
		}
		if(isset($_GET['sql']) && $_GET['sql']=='insert') {
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
		}

		elseif(isset($_GET['sql']) && $_GET['sql']=='update') {
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
			$st->execute(array($id, $fn, $ln, $hc, $ha, $gp, $ma, $ai, $em));

			returnStudents();
		}

		elseif(isset($_GET['sql']) && $_GET['sql']=='delete') {
			  $id = $_GET['student_id'];
		
			  $sql = "DELETE FROM students WHERE student_id = $id";
			  $st = $conn->exec( $sql );
			  
			  returnStudents();
		 }
		else {
			returnStudents();
		}
	}
?>
