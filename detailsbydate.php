<?php
	$host="localhost";
	$username="root";
	$password="";
	$dbname="lorrydrivers";
	$conn=mysqli_connect($host,$username,$password,$dbname);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Daily Details</title>
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
		<h1>Daily Details</h1>
		<form action="" method="post">
			Enter the date : <input type="date" name="dot" required>
			<input type="submit">
		</form><br>
	
	<?php
		if(isset($_POST["dot"])){
			$date=$_POST["dot"];
			$dat=strtotime($_POST["dot"]);
			$d=date('d-m-Y',$dat);
			$sql1="SELECT * FROM dailytravel WHERE dateoftravel='$date'";
			$result1=mysqli_query($conn,$sql1);
			echo "<h1>Details of Trips made on ".$d."</h1>";
			echo "<table border=5><tr><th>Lorry no</th><th>Driver name</th><th>Diesel</th><th>Distance</th><th>KMPL</th><th>Latest tested KMPL</th></tr>";
			while($row1=mysqli_fetch_array($result1,MYSQL_ASSOC)){
				$lno=$row1["lorryno"];
				$dname=$row1["drivername"];
				$diesel=$row1["quantity"];
				$dist=$row1["distance"];
				$kmpl=round($row1["kmpl"],2);
				$sql2="SELECT * FROM lorries WHERE lorryno='$lno'";
				$result2=mysqli_query($conn,$sql2);
				$row2=mysqli_fetch_array($result2,MYSQL_ASSOC);
				$kmpllimit=$row2["kmpllimit"];
				if($kmpl>=$row2["kmpllimit"])
					$color="green";
				else
					$color="red";
				echo "<tr><td>$lno</td><td width='150'>$dname</td><td>$diesel</td><td>$dist</td><td style='background-color:$color;color:white;'>$kmpl</td><td>$kmpllimit</td></tr>";
			}
			echo "</table>";
		}
	?>
	</center>
</body>
</html>