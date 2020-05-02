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
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<script type="text/javascript" language="javascript">
		function formValidate(){
			var month=document.labstract.month;
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
<body>
<form action="" name="labstract" onsubmit="return(formValidate());" method="post">
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
	$sql0="SELECT * FROM drivers WHERE 1";
	$result0=mysqli_query($conn,$sql0);
	$row0=mysqli_fetch_array($result0,MYSQL_ASSOC);
	$driversalary=$row0["driversalary"];
	$cleanersalary=$row0["cleanersalary"];
	if(isset($_POST["month"])){
		$month=$_POST["month"];
		$sql1="SELECT * FROM lorries";
		$result1=mysqli_query($conn,$sql1);
		$fp=fopen('lorry abstract.csv','w');
		$fields=array('Lorry no','Diesel','Ins and token tax','Dep & Interest','Rama Rao & Dadar-Room rnt','Salaries','Expenses','Autonagar bills','Seal Tyres','Brake insp','Nagendram','Total Expenses','Total Distance','Net KMPL','Per KM Rs');
		fputcsv($fp, $fields);
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
			$instoken=$row1['instoken'];
			$depint=$row1['deptint'];
			$ramarao=$row1['ramarao'];
			$expenses=$row1['expenses'];
			$autonagar=$row1['autonagar'];
			$sealtyres=$row1['sealtyres'];
			$breakinsp=$row1['breakinsp'];
			$nagendram=$row1['nagendram'];
			$lsalary=round($lmuster*$driversalary/30+$lcleaner*$cleanersalary/30+$ldistance/2,2);
			$totaldieselrate=$ldiesel*$ldrate;
			$totalexpenses=round($totaldieselrate+$row1["instoken"]+$row1["deptint"]+$row1["ramarao"]+$lsalary+$row1["expenses"]+$row1["autonagar"]+$row1["sealtyres"]+$row1["breakinsp"]+$row1["nagendram"],2);
			if($ldistance!=0)
				$lperkm=round($totalexpenses/$ldistance,2);
			$fields=array($lno,$ldiesel,$instoken,$depint,$ramarao,$lsalary,$expenses,$autonagar,$sealtyres,$breakinsp,$nagendram,$totalexpenses,$ldistance,$lkmpl,$lperkm);
			$r=fputcsv($fp, $fields);
		}
		if($r){
			echo "Exported successfully";
			header("refresh:3;url=dailyform.php");
		}
	}
?>
</body>
</html>