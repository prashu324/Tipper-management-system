<?php
	session_start();
	$host="localhost";
	$username="root";
	$password="";
	$dbname="lorrydrivers";
	$conn=mysqli_connect($host,$username,$password,$dbname);
	$dsal=$_POST["dsalary"];
	$csal=$_POST["csalary"];
	$dbeta=$_POST["dbeta"];
	$cbeta=$_POST["cbeta"];
	$sql1="UPDATE drivers SET driversalary='$dsal', cleanersalary='$csal', driverbeta='$dbeta', cleanerbeta='$cbeta' WHERE 1";
	$result1=mysqli_query($conn,$sql1);
	if($result1)
		echo "Drivers' details updated successfully";
	else
		echo "Problem in updating details. ".mysqli_error();
	header("refresh:5;url=dailyform.php");
?>