<?php
global $conn;
include 'includes/header.php';
	$id = $_GET['student_id'];
		
			  $sql = "DELETE FROM students WHERE student_id = $id";
			  $st = $conn->exec( $sql );
?>