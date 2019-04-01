<?php
    date_default_timezone_set("Asia/Bangkok");
    //Security
	//Database
	$dbServer = "localhost";
	$dbUsername = "aquabus";
	$dbPassword = "jh7_8Z5c";
	$table = "aquabus";
	//Mail config
	$webmail = "admin@bnk48-stats.com";
	$subject = " - BNK48-STATS";
	// Create connection
	$conn = mysqli_connect($dbServer, $dbUsername, $dbPassword);
	$conn->select_db($table);
	mysqli_query($conn,"set names 'utf8'");
?>