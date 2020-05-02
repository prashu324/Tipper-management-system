<?php
	session_start();
	$host="localhost";
	$username="root";
	$password="";
	$dbname="lorrydrivers";
	$conn=mysqli_connect($host,$username,$password,$dbname);
	$lno=$_SESSION["lno"];
	$dieselrate=$_POST["dieselrate"];
	$instoken=$_POST["instoken"];
	$deptint=$_POST["deptint"];
	$expenses=$_POST["expenses"];
	$autonagar=$_POST["autonagar"];
	$ramarao=$_POST["ramarao"];
	$sealtyres=$_POST["sealtyres"];
	$breakinsp=$_POST["breakinsp"];
	$nagendram=$_POST["nagendram"];
	$kmpllimit=$_POST["perkm"];
	$sql1="UPDATE lorries SET dieselrate='$dieselrate', instoken='$instoken', deptint='$deptint', expenses='$expenses', autonagar='$autonagar', ramarao='$ramarao', sealtyres='$sealtyres', breakinsp='$breakinsp', nagendram='$nagendram', kmpllimit='$kmpllimit' WHERE lorryno='$lno'";
	$result=mysqli_query($conn,$sql1);
	if($result)
		echo "Updated successfully";
	else
		echo "Problem in updating.";
	header("refresh:5;url=dailyform.php");
?>