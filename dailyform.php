<?php
	$host="localhost";
	$username="root";
	$password="";
	$dbname="lorrydrivers";
	$conn=mysqli_connect($host,$username,$password,$dbname);
	$sql1="SELECT drivername FROM drivers";
	$result1=mysqli_query($conn,$sql1);
	$sql2="SELECT lorryno FROM lorries";
	$result2=mysqli_query($conn,$sql2);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Form</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style type="text/css">
		#form{
				
			width: 400px;
			float: center;
			
		}

		ul {
		    list-style-type: none;
		    margin: 0;
		    padding: 0;
		    overflow: hidden;
		    background-color: #333;
		    text-align: center;
		}

		li {
		    float: left;
		}

		li a, .dropbtn {
		    display: inline-block;
		    color: white;
		    text-align: center;
		    padding: 14px 16px;
		    text-decoration: none;
		}

		li a:hover, .dropdown:hover .dropbtn {
		    background-color: red;
		}

		li.dropdown {
		    display: inline-block;
		}

		.dropdown-content {
		    display: none;
		    position: absolute;
		    background-color: #f9f9f9;
		    min-width: 160px;
		    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
		    z-index: 1;
		}
		.dropdown-content a {
		    color: black;
		    padding: 12px 16px;
		    text-decoration: none;
		    display: block;
		    text-align: left;
		}

		.dropdown-content a:hover {
			background-color: #f1f1f1
		}

		.dropdown:hover .dropdown-content {
		    display: block;
		}

		input{
			width: 100%;
			padding: 10px;
			text-align: center;
			font-size: 18px;
		}
	
		input : focus{
			width: 100%;
			padding: 10px;
			background-color: rgb(240,240,240);
			border-color: rgb(100,100,100);
			font-size: 28px;
		}
	
	</style>
	<script type="text/javascript" language="javascript">
		function formValidate(){
			var driver=document.dailytravel.driver;
			var lorryno=document.dailytravel.lorry;
			if(driverselect(driver)){
				if(lorryselect(lorryno)){
					return true;
				}
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
<body style="font-size: 18px;">
	
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
	<div id="form">
		<h1>Daily Trip details </h1>
		<form name='dailytravel' onsubmit="return(formValidate());" action='dailydetails.php' method='post'>
			Driver Name : 
			<select name='driver'>
				<option value="0">Please select driver</option>
				<?php
					while($row1=mysqli_fetch_array($result1,MYSQL_ASSOC)){
						echo "<option>".$row1["drivername"]."</option>";
					}
				?>
			</select><br><br>
			Lorry Number : 
			<select name='lorry'>
				<option value="0">Please select lorry</option>
				<?php
					while($row2=mysqli_fetch_array($result2,MYSQL_ASSOC)){
						echo "<option>".$row2["lorryno"]."</option>";
					}
				?>
			</select><br><br>
			Date : <input type="date" name="date" required><br><br>
			Quantity of Diesel : <input type="text" name="qty" required><br><br>
			Final Meter reading : <input type="text" name="meter" required><br><br>
			Driver Muster : <input type="number" name="muster" required><br><br>
			Cleaner Muster : <input type="number" name="cleaner" required><br><br>
			<input type="submit">
		</form>
	</div></center>
</body>
</html>