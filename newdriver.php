<?php
	$host="localhost";
	$username="root";
	$password="";
	$dbname="lorrydrivers";
	$conn=mysqli_connect($host,$username,$password,$dbname);
	$sql1="SELECT * FROM drivers";
	$result1=mysqli_query($conn,$sql1);
	$row1=mysqli_fetch_array($result1,MYSQL_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
	<title>New Driver</title>
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
		<h1>Add a New Driver</h1>
		<form action="" method="post">
			Driver Name : <input type="text" name="dname" required><br><br>
			<input type="submit" value="Add"><br>
		</form>
	</center>
	<?php
		if(isset($_POST["dname"])){
			$dname=$_POST["dname"];
			$flag=0;
			$drivername=$row1["drivername"];
			$dsalary=$row1["driversalary"];
			$csalary=$row1["cleanersalary"];
			$dbeta=$row1["driverbeta"];
			$cbeta=$row1["cleanerbeta"];
			while ($row2=mysqli_fetch_array($result1,MYSQL_ASSOC)) {
				if($row2["drivername"]==$dname||$drivername==$dname){
					$flag=1;
					break;
				}
			}
			if($flag==0){
				$sql2="INSERT INTO drivers SET drivername='$dname', driversalary='$dsalary', cleanersalary='$csalary', driverbeta='$dbeta', cleanerbeta='$cbeta'";
				$result2=mysqli_query($conn,$sql2);
				if($result2){
					echo "New driver added successfully";
					header("refresh:3;url=dailyform.php");
				}
				else
					echo "Problem in Adding new driver ".mysqli_error();
			}
			else if($flag==1){
				echo "This driver already exists.";
				header("refresh:5;url=newdriver.php");
			}
		}
		
	?>
</body>
</html>