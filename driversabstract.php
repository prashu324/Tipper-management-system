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
	<title>Drivers' Abstract</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style type="text/css">
		td{
			text-align: right;
		}
		body{
			font-size: 18px;
		}
	</style>
	<script type="text/javascript" language="javascript">
		function formValidate(){
			var month=document.dabstract.month;
			if(monthvalidate(month)){
				return true;
			}
			return false;
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
<form action="" name="dabstract" onsubmit="return(formValidate());" method="post">
	Enter the month : 
	<select name="month">
		<option value="0">Please select month</option>
		<option>January</option>
		<option>February</option>
		<option>March</option>
		<option>April</option>
		<option>May</option>
		<option>June</option>
		<option>July</option>
		<option>August</option>
		<option>September</option>
		<option>October</option>
		<option>November</option>
		<option>December</option>
	</select><br>
	<input type="submit">
</form>
</center>
<?php
	if(isset($_POST["month"])){
		$month=$_POST["month"];
		$sql1="SELECT * FROM drivers";
		$result1=mysqli_query($conn,$sql1);
		echo "<h1>Drivers' Abstract for the month of ".$month." : </h1>";
		echo "<table border=5 width=1200><tr><th>Driver Name</th><th>Total Distance</th><th>Total Diesel</th><th>Net KMPL</th><th>Driver Muster</th><th>Driver Salary</th><th>Cleaner Days</th><th>Cleaner Salary</th><th>Driver Incentive</th><th>Total Salary</th><th>Total Beta</th></tr>";
		while($row1=mysqli_fetch_array($result1,MYSQL_ASSOC)){
			$dname=$row1["drivername"];
			$dmuster=0;
			$dcleaner=0;
			$dsalary=0;
			$ddistance=0;
			$ddiesel=0;
			$dkmpl=0;
			$dbeta=0;
			$sql2="SELECT * FROM dailytravel WHERE drivername='$dname'";
			$result2=mysqli_query($conn,$sql2);
			while($row2=mysqli_fetch_array($result2,MYSQL_ASSOC)){
				$date=strtotime($row2["dateoftravel"]);
				$m=date('F',$date);
				if($m==$month){
					$ddistance+=$row2["distance"];
					$dmuster+=$row2["drivermuster"];
					$dcleaner+=$row2["cleanerdays"];
					$ddiesel+=$row2["quantity"];
				}
			}
			if($ddiesel!=0)
				$dkmpl=round($ddistance/$ddiesel,2);
			if($dkmpl>3)
				$color="green";
			else if($dkmpl>=2.5)
				$color="orange";
			else
				$color="red";
			$dbeta=round($dmuster*$row1["driverbeta"]+$dcleaner*$row1["cleanerbeta"],2);
			$mustersalary=round($dmuster*$row1["driversalary"]/30,2);
			$cleanersalary=round($dcleaner*$row1["cleanersalary"]/30,2);
			$incentive = $ddistance/2;
			$dsalary=round($dmuster*$row1["driversalary"]/30+$dcleaner*$row1["cleanersalary"]/30+$ddistance/2,2);
			echo "<tr><td width=150px>$dname</td><td>$ddistance</td><td>$ddiesel</td><td style='background-color:$color;color:white;'>$dkmpl</td><td>$dmuster</td><td>$mustersalary</td><td>$dcleaner</td><td>$cleanersalary</td><td>$incentive</td><td>$dsalary</td><td>$dbeta</td></tr>";
		}
		echo "</table>";
		echo "<br><center><a href='driversabstractcsv.php'><button>Export to Excel file</button></a></center>";
	}
?>
</body>
</html>