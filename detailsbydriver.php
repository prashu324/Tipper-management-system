<?php
	$host="localhost";
	$username="root";
	$password="";
	$dbname="lorrydrivers";
	$conn=mysqli_connect($host,$username,$password,$dbname);
	$sql2="SELECT drivername FROM drivers";
	$result2=mysqli_query($conn,$sql2);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Details by Driver name</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" language="javascript">
		function formValidate(){
			var driver=document.driverdetails.driver;
			var month=document.driverdetails.month;
			if(driverselect(driver)){
				if(monthvalidate(month)){
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
	<h1>Driver wise Details</h1>
	<form action="" onsubmit="return(formValidate());" name="driverdetails" method="post">
		Enter the driver name : 
		<select name='driver'>
			<option value="0">Please select driver </option>
			<?php
				while($row2=mysqli_fetch_array($result2,MYSQL_ASSOC)){
					echo "<option>".$row2["drivername"]."</option>";
				}
			?>
		</select><br>
		Enter the month : 
		<select name="month">
			<option value="0">Please select month</option>
			<option>01</option>
			<option>02</option>
			<option>03</option>
			<option>04</option>
			<option>05</option>
			<option>06</option>
			<option>07</option>
			<option>08</option>
			<option>09</option>
			<option>10</option>
			<option>11</option>
			<option>12</option>
		</select><br>
		<input type="submit">
	</form>
	<?php
		if(isset($_POST["driver"])&&isset($_POST["month"])){
			$dname=$_POST["driver"];
			$month=$_POST["month"];
			$sql1="SELECT * FROM dailytravel WHERE drivername='$dname'";
			$result1=mysqli_query($conn,$sql1);
			echo "<h1>Details of trips made by ".$dname." : </h1>";
			echo "<table border=5><tr><th>Date of work</th><th>Lorry no</th><th>Diesel</th><th>Distance</th><th>KMPL</th><th>Latest tested KMPL</th></tr>";
			$tdistance=0;
			$tdiesel=0;
			$netkmpl=0;
			while($row1=mysqli_fetch_array($result1,MYSQL_ASSOC)){
				$date=strtotime($row1["dateoftravel"]);
				$m=date('m',$date);
				$d=date('d-m-y',$date);
				if($m==$month){
					$lno=$row1["lorryno"];
					$diesel=$row1["quantity"];
					$dist=$row1["distance"];
					$kmpl=round($row1["kmpl"],2);
					$sql3="SELECT * FROM lorries WHERE lorryno='$lno'";
					$result3=mysqli_query($conn,$sql3);
					$row3=mysqli_fetch_array($result3,MYSQL_ASSOC);
					$kmpllimit=$row3["kmpllimit"];
					if($kmpl>$row3["kmpllimit"])
						$color="green";
					else
						$color="red";
					$tdistance+=$dist;
					$tdiesel+=$diesel;
					echo "<tr><td>$d</td><td>$lno</td><td>$diesel</td><td>$dist</td><td style='background-color:$color;color:white;'>$kmpl</td><td>$kmpllimit</td></tr>";
				}
			}
			if($tdiesel!=0)
				$netkmpl=round($tdistance/$tdiesel,2);
			echo "<tr><td></td><td>Total</td><td>$tdiesel</td><td>$tdistance</td><td>$netkmpl</td></tr></table>";
		}
	?>
</center>
</body>
</html>