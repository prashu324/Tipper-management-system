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
	<title>Lorry Abstract</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style type="text/css">
		tr{
			height: 40px;
		}
		td{
			text-align: right;
			width: 80px;
		}
		body{
			font-size: 18px;
		}
	</style>
	<script type="text/javascript" language="javascript">
		function formValidate(){
			var month=document.labstract.month;
			if(monthvalidate(month)){
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
<form action="" onsubmit="return(formValidate());" name="labstract" method="post">
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
	$sql0="SELECT * FROM drivers WHERE 1";
	$result0=mysqli_query($conn,$sql0);
	$row0=mysqli_fetch_array($result0,MYSQL_ASSOC);
	$driversalary=$row0["driversalary"];
	$cleanersalary=$row0["cleanersalary"];
	if(isset($_POST["month"])){
		$month=$_POST["month"];
		$sql1="SELECT * FROM lorries";
		$result1=mysqli_query($conn,$sql1);
		echo "<h1>Lorry Abstract for the month of ".$month." : </h1>";
		echo "<table border=5 width=1300><tr><th>Lorry no</th><th>Diesel</th><th>Ins and Token Tax</th><th>Dep & interest</th><th>Rama Rao & Dadar-Room rnt</th><th>Salaries</th><th>Expenses</th><th>Autonagar Bills</th><th>Seal Tyres</th><th>Brake Insp</th><th>Nagendram</th><th>Total Expenses</th><th>Total Distance</th><th>Net KMPL</th><th>Latest tested KMPL</th><th>Per KM-Rs</th></tr>";
		while($row1=mysqli_fetch_array($result1,MYSQL_ASSOC)){
			$lno=$row1["lorryno"];
			$ldiesel=0;
			$ldistance=0;
			$lmuster=0;
			$ldiesel=0;
			$lkmpl=0;
			$lsalary=0;
			$lcleaner=0;
			$lbeta=0;
			$lperkm=0;
			$ldrate=$row1["dieselrate"];
			$sql2="SELECT * FROM dailytravel WHERE lorryno='$lno'";
			$result2=mysqli_query($conn,$sql2);
			while($row2=mysqli_fetch_array($result2,MYSQL_ASSOC)){
				$date=strtotime($row2["dateoftravel"]);
				$m=date('F',$date);
				if($m==$month){
					$ldistance+=$row2["distance"];
					$ldiesel+=$row2["quantity"];
					$lmuster+=$row2["drivermuster"];
					$lcleaner+=$row2["cleanerdays"];
				}
			}
			if($ldiesel!=0)
				$lkmpl=round($ldistance/$ldiesel,2);
			if($lkmpl>$row1["kmpllimit"])
				$color="green";
			else
				$color="red";
			$instoken=$row1['instoken'];
			$depint=$row1['deptint'];
			$ramarao=$row1['ramarao'];
			$expenses=$row1['expenses'];
			$autonagar=$row1['autonagar'];
			$sealtyres=$row1['sealtyres'];
			$breakinsp=$row1['breakinsp'];
			$nagendram=$row1['nagendram'];
			$latesttestedkmpl=$row1["kmpllimit"];
			$lsalary=round($lmuster*$driversalary/30+$lcleaner*$cleanersalary/30+$ldistance/2+$lmuster*$row0["driverbeta"]+$lcleaner*$row0["cleanerbeta"],2);
			//$lbeta=$lmuster*$row0["driverbeta"]+$lcleaner*$row0["cleanerbeta"];
			$totaldieselrate=$ldiesel*$ldrate;
			$totalexpenses=round($totaldieselrate+$row1["instoken"]+$row1["deptint"]+$row1["ramarao"]+$lsalary+$row1["expenses"]+$row1["autonagar"]+$row1["sealtyres"]+$row1["breakinsp"]+$row1["nagendram"],2);
			if($ldistance!=0)
				$lperkm=round($totalexpenses/$ldistance,2);
			if($lperkm<=80)
				$colour="green";
			else if($lperkm<90)
				$colour="orange";
			else
				$colour="red";
			echo "<tr><td>$lno</td><td>$totaldieselrate</td><td>$instoken</td><td>$depint</td><td>$ramarao</td><td>$lsalary</td><td>$expenses</td><td>$autonagar</td><td>$sealtyres</td><td>$breakinsp</td><td>$nagendram</td><td>$totalexpenses</td><td>$ldistance</td><td style='background-color:$color;color:white;'>$lkmpl</td><td>$latesttestedkmpl</td><td style='background-color:$colour;color:white;'>$lperkm</td>";
		}
		echo "</table>";
		echo "<br><center><a href='lorryabstractcsv.php'><button>Export to Excel</button></a></center>";
	}
?>
<br>
</body>
</html>