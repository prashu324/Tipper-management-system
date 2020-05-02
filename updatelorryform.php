<?php
	session_start();
	$host="localhost";
	$username="root";
	$password="";
	$dbname="lorrydrivers";
	$conn=mysqli_connect($host,$username,$password,$dbname);
	$sql2="SELECT lorryno FROM lorries";
	$result2=mysqli_query($conn,$sql2);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Lorry Details</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" language="javascript">
		function formValidate(){
			var lorryno=document.updatelorry.lorry;
			if(lorryselect(lorryno)){
				return true;
			}
			return false;
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
	<h1>Update Tipper details </h1>
	<form method="post" onsubmit="return(formValidate());" name="updatelorry">
		Select Tipper no : 
		<select name='lorry'>
			<option value="0">Please select lorry</option>
			<?php
				while($row2=mysqli_fetch_array($result2,MYSQL_ASSOC)){
					echo "<option>".$row2["lorryno"]."</option>";
				}
			?>
		</select><br><br>
		<input type="submit" name="submit" style="<?php if (isset($_POST["lorry"])): echo "display: none;"; endif ?>">
	</form>
	<?php
	if(isset($_POST["lorry"])){
		$lno=$_POST["lorry"];
		$_SESSION["lno"]=$lno;
		$sql1="SELECT * FROM lorries WHERE lorryno='$lno'";
		$result1=mysqli_query($conn,$sql1);
		$row1=mysqli_fetch_array($result1,MYSQL_ASSOC);
	?>
	<form action="updatelorrydetails.php" method="post">
		<h1><?php echo $lno;?></h1>
		Diesel Rate : <br><input type="float" name="dieselrate" value="<?php echo $row1['dieselrate'];?>"><br><br>
		Insurance and Token Tax : <br><input type="number" name="instoken" value="<?php echo $row1['instoken'];?>"><br><br>
		Depreciation and Interest : <br><input type="number" name="deptint" value="<?php echo $row1['deptint'];?>"><br><br>
		Rama Rao and Dadar-Room rnt : <br><input type="number" name="ramarao" value="<?php echo $row1['ramarao'];?>"><br><br>
		Expenses : <br><input type="number" name="expenses" value="<?php echo $row1['expenses'];?>"><br><br>
		Autonagar bills : <br><input type="number" name="autonagar" value="<?php echo $row1['autonagar'];?>"><br><br>
		Seal Tyres : <br><input type="number" name="sealtyres" value="<?php echo $row1['sealtyres'];?>"><br><br>
		Brake Insp : <br><input type="number" name="breakinsp" value="<?php echo $row1['breakinsp'];?>"><br><br>
		Nagendram : <br><input type="number" name="nagendram" value="<?php echo $row1['nagendram'];?>"><br><br>
		Tested KMPL : <br><input type="float" name="perkm" value="<?php echo $row1['kmpllimit'];?>"><br><br>
		<input type="submit" value="Update"><br>		
	</form>
<?php
}
?>
</center>
</body>
</html>