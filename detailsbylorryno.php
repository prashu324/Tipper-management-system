<?php
	$host="localhost";
	$username="root";
	$password="";
	$dbname="lorrydrivers";
	$conn=mysqli_connect($host,$username,$password,$dbname);
	$sql2="SELECT * FROM lorries";
	$result2=mysqli_query($conn,$sql2);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Details by lorry no</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" language="javascript">
		function formValidate(){
			var lorryno=document.tripform.lorry;
			var month=document.tripform.month;
			if(lorryselect(lorryno)){
				if(monthvalidate(month)){
					return true;
				}
			}
			return false;
		}
		function lorryselect(lorryno){
			if(lorryno.value=="0"){
				alert('Select lorry no from the list');
				
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
	<h1>Tipper wise Details in a given month</h1>
	<form name="tripform" action="" method="post">
		Enter the lorry number : 
		<select name='lorry'>
			<option value="0">Please select lorry</option>
			<?php
				while($row2=mysqli_fetch_array($result2,MYSQL_ASSOC)){
					echo "<option>".$row2["lorryno"]."</option>";
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
		<input type="submit" onclick="return(formValidate());">
	</form>
	<?php
		if(isset($_POST["lorry"])&&isset($_POST["month"])){
			$lno=$_POST["lorry"];
			$month=$_POST["month"];
			$sql1="SELECT * FROM dailytravel WHERE lorryno='$lno'";
			$result1=mysqli_query($conn,$sql1);
			$sql3="SELECT * FROM lorries WHERE lorryno='$lno'";
			$result3=mysqli_query($conn,$sql3);
			$row3=mysqli_fetch_array($result3,MYSQL_ASSOC);
			echo "<h1>Details of trips made by the tipper ".$lno." : </h1>";
			echo "<table border=5><tr><th>Date of work</th><th>Driver name</th><th>Diesel</th><th>Distance</th><th>KMPL</th><th>Latest tested KMPL</th></tr>";
			$tdistance=0;
			$tdiesel=0;
			while($row1=mysqli_fetch_array($result1,MYSQL_ASSOC)){
				$date=strtotime($row1["dateoftravel"]);
				$m=date('m',$date);
				$d=date('d-m-y',$date);
				if($m==$month){
					$dname=$row1["drivername"];
					$diesel=$row1["quantity"];
					$dist=$row1["distance"];
					$kmpl=round($row1["kmpl"],2);
					$tdistance+=$dist;
					$tdiesel+=$diesel;
					$kmpllimit=$row3["kmpllimit"];
					if($kmpl>$row3["kmpllimit"])
						$color="green";
					else
						$color="red";
					echo "<tr><td>$d</td><td>$dname</td><td>$diesel</td><td>$dist</td><td style='background-color:$color;color:white;'>$kmpl</td><td>$kmpllimit</td></tr>";
				}
			}
			$netkmpl=0;
			if($tdiesel!=0)
				$netkmpl=round($tdistance/$tdiesel,2);
			echo "<tr><td></td><td>Total</td><td>$tdiesel</td><td>$tdistance</td><td>$netkmpl</td></tr></table>";
		}
	?>
	<br>
</body>
</html>