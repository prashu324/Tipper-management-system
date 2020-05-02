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
	<title>dfs</title>
	<link rel="stylesheet" type="text/css" href="style.css">
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
<form action="" name="dabstract" method="post" onsubmit="return(formValidate());">
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
<?php
	if(isset($_POST["month"])){
		$fp=fopen('driver abstract.csv','w');
		$fields=array('Driver name','Total Distance','Total diesel','Net KMPL','Driver Muster','Driver Salary','Cleaner days','Cleaner Salary','Driver Incentive','Total salary','Total beta');
		fputcsv($fp, $fields);
		$month=$_POST["month"];
		$sql1="SELECT * FROM drivers";
		$result1=mysqli_query($conn,$sql1);
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
			$dbeta=round($dmuster*$row1["driverbeta"]+$dcleaner*$row1["cleanerbeta"],2);
			$mustersalary=round($dmuster*$row1["driversalary"]/30,2);
			$cleanersalary=round($dcleaner*$row1["cleanersalary"]/30,2);
			$incentive = $ddistance/2;
			$dsalary=round($dmuster*$row1["driversalary"]/30+$dcleaner*$row1["cleanersalary"]/30+$ddistance/2,2);
			$fields=array($dname,$ddistance,$ddiesel,$dkmpl,$dmuster,$mustersalary,$dcleaner,$cleanersalary,$incentive,$dsalary,$dbeta);
			$r=fputcsv($fp, $fields);
		}
		fclose($fp);
		if($r){
			echo "Exported successfully";
			header("refresh:3;url=dailyform.php");
		}
		else
			echo "Problem in exporting";
	}
?>
</body>
</html>