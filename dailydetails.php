<?php
	$host="localhost";
	$username="root";
	$password="";
	$dbname="lorrydrivers";
	$conn=mysqli_connect($host,$username,$password,$dbname);

	$dname=$_POST["driver"];
	$lno=$_POST["lorry"];
	$date=$_POST["date"];
	$freading=$_POST["meter"];
	$quantity=$_POST["qty"];
	$muster=$_POST["muster"];
	$cleaner=$_POST["cleaner"];

	$sql1="SELECT * FROM lorries WHERE lorryno='$lno'";
	$result1=mysqli_query($conn,$sql1);
	$row1=mysqli_fetch_array($result1,MYSQL_ASSOC);

	$distance=$freading-$row1["reading"];
	$kmpl=round($distance/$quantity,2);
	
	$sql3="INSERT INTO dailytravel SET lorryno='$lno',drivername='$dname',dateoftravel='$date',reading='$freading',quantity='$quantity',distance='$distance',kmpl='$kmpl',drivermuster='$muster',cleanerdays='$cleaner'";
	$result3=mysqli_query($conn,$sql3);

	$sql2="UPDATE lorries SET reading='$freading' WHERE lorryno='$lno'";
	$result2=mysqli_query($conn,$sql2);

	if($result1&&$result2&&$result3){
		echo "Submission is successful<br>";
		echo $dname." has got ".$kmpl." kmpl on ".$date;
		header("refresh:5;url=dailyform.php");
	}
	else
		die("There is some error in submission. ".mysqli_error());
	mysqli_close($conn);
?>