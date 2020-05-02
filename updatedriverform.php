<?php
	session_start();
	$host="localhost";
	$username="root";
	$password="";
	$dbname="lorrydrivers";
	$conn=mysqli_connect($host,$username,$password,$dbname);
	$sql1="SELECT * FROM drivers WHERE 1";
	$result1=mysqli_query($conn,$sql1);
	$row1=mysqli_fetch_array($result1,MYSQL_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Driver details</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<ul>
		<li><a href="dailyform.php"> Home</a></li>
		<li class="dropdown">
			<a href="javascript:void(0)" class="dropbtn">Driver</a>
			<div class="dropdown-content">
				<a href="newdriver.php">New</a>
				<a href="updatedriverform.php">Update</a>
				<a href="deletedriver.php">Delete</a>
			</div>
		</li>
		<li class="dropdown">
			<a href="javascript:void(0)" class="dropbtn">Tipper</a>
			<div class="dropdown-content">
				<a href="newlorry.php">New</a>
				<a href="updatelorryform.php">Update</a>
				<a href="deletelorry.php">Delete</a>
			</div>
		</li>
		<li class="dropdown">
			<a href="javascript:void(0)" class="dropbtn">Abstract</a>
			<div class="dropdown-content">
				<a href="lorryabstract.php">Tipper</a>
				<a href="driversabstract.php">Driver</a>
			</div>
		</li>
		<li class="dropdown">
			<a href="javascript:void(0)" class="dropbtn">Trip details by</a>
			<div class="dropdown-content">
				<a href="detailsbydate.php">Date</a>
				<a href="detailsbylorryno.php">Tipper no</a>
				<a href="detailsbydriver.php">Driver name</a>
			</div>
		</li>
	</ul>
	<center>
	<h1>Update details of all Drivers</h1>
	<form action="updatedriverdetails.php" method="post">
		Driver Salary per Month : <input type="number" name="dsalary" value="<?php echo $row1['driversalary']; ?>"><br><br>
		Cleaner Salary per Month : <input type="number" name="csalary" value="<?php echo $row1['cleanersalary']; ?>"><br><br>
		Driver beta : <input type="number" name="dbeta" value="<?php echo $row1['driverbeta']; ?>"><br><br>
		Cleaner beta : <input type="number" name="cbeta" value="<?php echo $row1['cleanerbeta']; ?>"><br><br>
		<input type="submit" value="Update">
	</form>
	</center>
</body>
</html>