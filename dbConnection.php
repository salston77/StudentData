<?php
	global $conn; 
	$dsn = "mysql:host=localhost;dbname=student_data";
	$username = "root";
	$password = "";
		try {
			$conn = new PDO( $dsn, $username, $password );
			$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		}
		catch ( PDOException $e ) {
			echo "Connection Failed: " . $e->getMessage();
		}
?>