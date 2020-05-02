<?php
	$host="localhost";
	$username="root";
	$password="";
	$dbname="lorrydrivers";
	$conn=mysqli_connect($host,$username,$password,$dbname);
	$sql1="SELECT * FROM lorries WHERE 1";
	$result1=mysqli_query($conn,$sql1);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Delete Tipper</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" language="javascript">
		function formValidate(){
			var lorryno=document.deletelorry.lno;
			if(lorryselect(lorryno)){
				return true;
			}
			return false;
		}
		function driverselect(driver){
			if(driver.value=="0"){
				alert("Select driver from the list");
				driver.focus();
				return false;
			}
			else
				return true;
		}
		function lorryselect(lorryno){
			if(lorryno.value=="0"){
				alert('Select lorry no from the list');
				lorryno.focus();
				return false;
			}
			else
				return true;
		}
		function monthvalidate(month){
			if(month.value=="0"){
				alert('Select month from the list');
				month.focus();
				return false;
			}
			else
				return true;
		}
	</script>
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
	<h1>Delete a Tipper</h1>
	<form action="" name="deletelorry" onsubmit="return(formValidate());" method="post">
		Select a Tipper : 
		<select name="lno">
			<option value="0">Please select lorry</option>
			<?php
				while($row1=mysqli_fetch_array($result1,MYSQL_ASSOC)){
					echo "<option>".$row1["lorryno"]."</option>";
				}
			?>
		</select><br><br>
		<input type="submit" value="Delete">
	</form>
</center>
<?php
	if(isset($_POST["lno"])){
		$lno=$_POST["lno"];
		$sql2="DELETE FROM lorries WHERE lorryno='$lno'";
		$result2=mysqli_query($conn,$sql2);
		if($result2){
			echo "Tipper deleted successfully";
			header("refresh:3;url=dailyform.php");
		}
		else
			echo "Problem in deleting tipper ".mysqli_error();
	}
?>
</body>
</html>