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
	<title>New Tipper</title>
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
	<h1>Add a New Tipper</h1>
	<form action="" method="post">
		Tipper No : <input type="text" name="lno" required><br><br>
		<input type="submit" value="Add"><br>
	</form>
</center>
<?php
	if(isset($_POST["lno"])){
			$lno=$_POST["lno"];
			$flag=0;
			$sql1="SELECT * FROM lorries WHERE 1";
			$result1=mysqli_query($conn,$sql1);
			while ($row2=mysqli_fetch_array($result1,MYSQL_ASSOC)) {
				if($row2["lorryno"]==$lno){
					$flag=1;
					break;
				}
			}
			if($flag==0){
				$sql2="INSERT INTO lorries SET lorryno='$lno'";
				$result2=mysqli_query($conn,$sql2);
				if($result2){
					echo "New tipper added successfully";
					header("refresh:3;url=dailyform.php");
				}
				else
					echo "Problem in Adding new tipper ".mysqli_error();
			}
			else if($flag==1){
				echo "This tipper already exists.";
				header("refresh:5;url=newlorry.php");
			}
		}
?>
</body>
</html>