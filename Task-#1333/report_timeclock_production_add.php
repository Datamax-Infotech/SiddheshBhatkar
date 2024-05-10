<?php
	require ("inc/header_session.php");
	require ("../mainfunctions/database.php");
	require ("../mainfunctions/general-functions.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Add Production Tool</title>
		<style type="text/css">
			.timeclock_prod_div{

				float:left; 

				width: 45%; 

				border-right:1px solid #5A5A5A;

			}

			.b2c_inventory_div{

				float:left; 

				width: 45%; 

				margin-left: 7px;

			}

			.b2c_inventory_div_inner{

				width: 99%;

				margin: 0 auto;

			}

			.title_txt{

				width: 99%;

				padding: 4px 0px;

				font-family: "Arial", "sans-serif";

				font-size: 15px;

				background: #DCDCDC;

				font-weight: bold;

				text-align: center;

			}

			.txtstyle_color

			{

			font-family:arial;

			font-size:12;

			height: 16px; 

			background:#ABC5DF;

			}



			.txtstyle

			{

				font-family:arial;

				font-size:12;

			}



			.style7 {

				font-size: xx-small;

				font-family: Arial, Helvetica, sans-serif;

				color: #333333;

				background-color: #FFCC66;

			}

			.style5 {

				font-family: Arial, Helvetica, sans-serif;

				font-size: x-small;

				text-align: center;

				background-color: #99FF99;

			}

			.style6 {

				text-align: center;

				background-color: #99FF99;

			}

			.style2 {

				font-family: Arial, Helvetica, sans-serif;

				font-size: x-small;

			}

			.style3 {

				font-family: Arial, Helvetica, sans-serif;

				font-size: x-small;

				color: #333333;

			}

			.style8 {

				text-align: left;

				font-family: Arial, Helvetica, sans-serif;

				font-size: x-small;

				color: #333333;

			}

			.style11 {

				font-family: Arial, Helvetica, sans-serif;

				font-size: x-small;

				color: #333333;

				text-align: center;

			}

			.style10 {

				text-align: left;

			}

			.style12 {

				font-family: Arial, Helvetica, sans-serif;

				font-size: x-small;

				color: #333333;

				text-align: right;

			}

			.style13 {

				font-family: Arial, Helvetica, sans-serif;

			}

			.style14 {

				font-size: x-small;

			}

			.style15 {

				font-size: small;

			}

			.style16 {

				font-family: Arial, Helvetica, sans-serif;

				font-size: x-small;

				background-color: #99FF99;

			}

			.style17 {

				background-color: #99FF99;

			}

			select, input {

			font-family: Arial, Helvetica, sans-serif; 

			font-size: 10px; 

			color : #000000; 

			font-weight: normal; 

			}

		</style>
   	 	<script>

			function validations(){

			
				if(document.rptSearch.worker.value=="-")

					{

						alert("Please select employee name");

						return false;

					}

				var value_1 = document.rptSearch.value_1.value;

				var production_1 = document.rptSearch.production_1.value;

				var value_2 = document.rptSearch.value_2.value;

				var production_2 = document.rptSearch.production_2.value;

				var value_3 = document.rptSearch.value_3.value;

				var production_3 = document.rptSearch.production_3.value;

				var value_4 = document.rptSearch.value_4.value;

				var production_4 = document.rptSearch.production_4.value;

				var value_5 = document.rptSearch.value_5.value;

				var production_5 = document.rptSearch.production_5.value;

				var value_6 = document.rptSearch.value_6.value;

				var production_6 = document.rptSearch.production_6.value;

				var value_7 = document.rptSearch.value_7.value;

				var production_7 = document.rptSearch.production_7.value;

				var value_8 = document.rptSearch.value_8.value;

				var production_8 = document.rptSearch.production_8.value;

				var value_9 = document.rptSearch.value_9.value;

				var production_9 = document.rptSearch.production_9.value;

				var value_10 = document.rptSearch.value_10.value;

				var production_10 = document.rptSearch.production_10.value;

				var value_11 = document.rptSearch.value_11.value;

				var production_11 = document.rptSearch.production_11.value;

				var value_12 = document.rptSearch.value_12.value;

				var production_12 = document.rptSearch.production_12.value;

				var value_13 = document.rptSearch.value_13.value;

				var production_13 = document.rptSearch.production_13.value;

				var value_14 = document.rptSearch.value_14.value;

				var production_14 = document.rptSearch.production_14.value;

				var value_15 = document.rptSearch.value_15.value;

				var production_15 = document.rptSearch.production_15.value;

				var value_16 = document.rptSearch.value_16.value;

				var production_16 = document.rptSearch.production_16.value;

				var value_17 = document.rptSearch.value_17.value;

				var production_17 = document.rptSearch.production_17.value;

				var value_18 = document.rptSearch.value_18.value;

				var production_18 = document.rptSearch.production_18.value;

				if( (value_1 == "-") && (value_2 == "-") && (value_3 == "-") && (value_4 == "-") && (value_5 == "-") && (value_6 == "-") && (value_7 == "-") && (value_8 == "-") && (value_9 == "-") && (value_10 == "-") && (value_11 == "-") && (value_12 == "-") && (value_13 == "-") && (value_14 == "-") && (value_15 == "-") && (value_16 == "-") && (value_17 == "-") && (value_18 == "-") ){

					alert("Please select production type.");

					return false;

				}else if(value_1 == "-" && production_1 != ""){

					alert("Please select Production type #1.");

					document.rptSearch.production_1.focus();

					return false;

				}else if(value_2 == "-" && production_2 != ""){

					alert("Please select Production type #2");

					document.rptSearch.production_2.focus();

					return false;

				}else if(value_3 == "-" && production_3 != ""){

					alert("Please select Production type #3");

					document.rptSearch.production_3.focus();

					return false;

				}else if(value_4 == "-" && production_4 != ""){

					alert("Please select Production type #4");

					document.rptSearch.production_4.focus();

					return false;

				}else if(value_5 == "-" && production_5 != ""){

					alert("Please select Production type #5");

					document.rptSearch.production_5.focus();

					return false;

				}else if(value_6 == "-" && production_6 != ""){

					alert("Please select Production type #6");

					document.rptSearch.production_6.focus();

					return false;

				}else if(value_7 == "-" && production_7 != ""){

					alert("Please select Production type #7");

					document.rptSearch.production_7.focus();

					return false;

				}else if(value_8 == "-" && production_8 != ""){

					alert("Please select Production type #8");

					document.rptSearch.production_8.focus();

					return false;

				}else if(value_9 == "-" && production_9 != ""){

					alert("Please select Production type #9");

					document.rptSearch.production_9.focus();

					return false;

				}else if(value_10 == "-" && production_10 != ""){

					alert("Please select Production type #10");

					document.rptSearch.production_10.focus();

					return false;

				}else if(value_11 == "-" && production_11 != ""){

					alert("Please select Production type #11");

					document.rptSearch.production_11.focus();

					return false;

				}else if(value_12 == "-" && production_12 != ""){

					alert("Please select Production type #12");

					document.rptSearch.production_12.focus();

					return false;

				}else if(value_13 == "-" && production_13 != ""){

					alert("Please select Production type #13");

					document.rptSearch.production_13.focus();

					return false;

				}else if(value_14 == "-" && production_14 != ""){

					alert("Please select Production type #14");

					document.rptSearch.production_14.focus();

					return false;

				}else if(value_15 == "-" && production_15 != ""){

					alert("Please select Production type #15");

					document.rptSearch.production_15.focus();

					return false;

				}else if(value_16 == "-" && production_16 != ""){

					alert("Please select Production type #16");

					document.rptSearch.production_16.focus();

					return false;

				}else if(value_17 == "-" && production_17 != ""){

					alert("Please select Production type #17");

					document.rptSearch.production_17.focus();

					return false;

				}else if(value_18 == "-" && production_18 != ""){

					alert("Please select Production type #18");

					document.rptSearch.production_18.focus();

					return false;

				}

            return true;

        }

    	</script>

		<link rel='stylesheet' type='text/css' href='one_style.css' >

		<link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">

		<link rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>

	</head>
	<body>

    <?php include("inc/header.php"); ?>



	<div class="main_data_css">

		<div class="dashboard_heading" style="float: left;">

			<div style="float: left;">Add Production Tool

			<div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>

			<span class="tooltiptext">

				This tool allows the user to enter production for employees on the timeclock.

			</span></div>



			<div style="height: 13px;">&nbsp;</div>		

			</div>			

		</div>

   <div class="timeclock_prod_div">

      <div class="title_txt">Add Timeclock Production</div>

	<form name="rptSearch" action="<?php echo htmlspecialchars(
     $_SERVER["REQUEST_URI"]
 ); ?>" method="POST" onSubmit="return validations()">

	<input type="hidden" name="action" value="productionadd">

	<input type="hidden" name="wid" value="<?php echo $_REQUEST["wid"] ?>">





<span class="style13"><span class="style15">



<br /><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">



</span><span class="style14"><span class="style15">

<br />

 <?php if (isset($_REQUEST["opt"]) && $_REQUEST["opt"] == "mngview") { ?>

        <font face="Arial, Helvetica, sans-serif" color="#333333" size="2">   

        Employee: 

            <?php
            $sql3 = "SELECT * FROM loop_workers where id=" . $_REQUEST["wk"];

			db();
            $result3 = db_query($sql3);

            $myrowsel3 = array_shift($result3);

            echo "<span style='font-size:11px;'>" .
                $myrowsel3["name"] .
                "</span>";
            ?>

        <input type="hidden" name="worker" value="<?php echo $_REQUEST[
            "wk"
        ]; ?>">

        </font>&nbsp;&nbsp;

    <?php } else { ?>

	<font face="Arial, Helvetica, sans-serif" color="#333333" size="2">Employee</font>

		<select name="worker"><option value="-">Please Select</option>

		<?php

		if ($_REQUEST["wid"]>0) 

		{ 

			$sql3 = "SELECT * FROM loop_workers WHERE active=1 and warehouse_id = " . $_REQUEST["wid"] . " ORDER BY active DESC, name ASC";

		} else {

			$sql3 = "SELECT * FROM loop_workers where active=1 ORDER BY active DESC, name ASC";

		}

		db();
		$result3 = db_query($sql3);

		while ($myrowsel3 = array_shift($result3)) {

		?>

			<option value="<?php echo $myrowsel3["id"]; ?>" <?php if ($myrowsel3["id"]==$_REQUEST["worker"]) echo "selected"; ?>><?php echo $myrowsel3["name"]; ?></option>

		<?php } ?>

		</select> 

		<?php } ?>

</span>

    

 <span class="style14"><span class="style15">









<SCRIPT LANGUAGE="JavaScript" SRC="inc/CalendarPopup.js"></SCRIPT>

<script LANGUAGE="JavaScript">document.write(getCalendarStyles());</script>

<script LANGUAGE="JavaScript">

	var cal1xx = new CalendarPopup("listdiv");

	 cal1xx.showNavigationDropdowns();

</script>

    

    

    

    <SCRIPT language="JavaScript" src="inc/CalendarPopup.js"></SCRIPT>

<script language="JavaScript">document.write(getCalendarStyles());</script>

<script language="JavaScript">

	var cal1xx1 = new CalendarPopup("listdiv");

	cal1xx1.showNavigationDropdowns();



</script>

<?php

$start_date = isset($_GET["start_date"])?strtotime($_GET["start_date"]):strtotime(date('m/d/Y'));
$showdata="show"; // Moved to new position - Siddhesh
$total_orders = 0; // Moved to new position - Siddhesh
$product_array[] = array(); // Moved to new position - Siddhesh

$worker = isset($_REQUEST['worker']) ? $worker = $_REQUEST['worker'] : $worker = 0; //Defined for query column value blank error for multiple queries
?>

    

  <font face="Arial, Helvetica, sans-serif" color="#333333" size="2"> from: 

  <input type="text" name="start_date" size="11" 

  value="<?php echo isset($_GET["start_date"]) && $_GET["start_date"] != ""
      ? date("m/d/Y", $start_date)
      : date("m/d/Y") ?>"> 

  <a href="#" onclick="cal1xx1.select(document.rptSearch.start_date,'anchor1xx','MM/dd/yyyy'); return false;" name="anchor1xx" id="anchor1xx"><img border="0" src="images/calendar.jpg"></a> 

  MM/DD/YYYY</font>



  <div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>


	<br><br></span></span></span>

<table>

<tr align="middle">

			<td colSpan="10" class="style7">

			ADD PRODUCTION </td>

	</tr>

	<tr>	<td bgColor="#e4e4e4">Production Type ($ w/ Stored Value)</td><td bgColor="#e4e4e4">Production Count</td><td bgColor="#e4e4e4">Notes</td>	</tr>	

	<tr>	

		<td bgColor="#e4e4e4" align="right">1: $

			<select name="value_1">

				<option value="-">Select</option>

			<?php

			$pquery="select * from production_type_val order by type_value ASC";

			db();
			$pres=db_query($pquery);

			while($prow=array_shift($pres))

			{

				?>

				<option value="<?php echo $prow["type_value"]; ?>"><?php echo "$". number_format($prow["type_value"],2)." ".$prow["prod_type"]; ?></option>

				<?php

			}

			?>

			</select>

		</td>

		<td bgColor="#e4e4e4"><input name="production_1" value=""></td><td bgColor="#e4e4e4"><input size=25 name="notes_1" value=""></td>	</tr>	

	<tr>	<td bgColor="#e4e4e4" align="right">2: $

			<select name="value_2">

				<option value="-" >Select</option>

			<?php

			$pquery="select * from production_type_val order by type_value ASC";

			db();
			$pres=db_query($pquery);

			while($prow=array_shift($pres))

			{

				?>

				<option value="<?php echo $prow["type_value"]; ?>"><?php echo "$". number_format($prow["type_value"],2)." ".$prow["prod_type"]; ?></option>

				<?php

			}

			?>

			</select>

		</td>

		<td bgColor="#e4e4e4"><input name="production_2" value=""></td><td bgColor="#e4e4e4"><input size=25 name="notes_2" value=""></td>	</tr>	

	<tr>	

		<td bgColor="#e4e4e4" align="right">3: $

				<select name="value_3">

					<option value="-" >Select</option>

			<?php

			$pquery="select * from production_type_val order by type_value ASC";
			
			db();
			$pres=db_query($pquery,);

			while($prow=array_shift($pres))

			{

				?>

				<option value="<?php echo $prow["type_value"]; ?>"><?php echo "$". number_format($prow["type_value"],2)." ".$prow["prod_type"]; ?></option>

				<?php

			}

			?>

			</select>

		</td>

		<td bgColor="#e4e4e4">

			<input name="production_3" value=""></td><td bgColor="#e4e4e4"><input size=25 name="notes_3" value=""></td>	</tr>	

	<tr>	

		<td bgColor="#e4e4e4" align="right">4: $

				<select name="value_4">

					<option value="-" >Select</option>

			<?php

			$pquery="select * from production_type_val order by type_value ASC";

			db();
			$pres=db_query($pquery);

			while($prow=array_shift($pres))

			{

				?>

				<option value="<?php echo $prow["type_value"]; ?>"><?php echo "$".number_format($prow["type_value"],2)." ".$prow["prod_type"]; ?></option>

				<?php

			}

			?>

			</select>

		</td>

		<td bgColor="#e4e4e4"><input name="production_4" value=""></td><td bgColor="#e4e4e4"><input size=25 name="notes_4" value=""></td>	</tr>	

	<tr>

		<td bgColor="#e4e4e4" align="right">5: $

				<select name="value_5">

					<option value="-" >Select</option>

			<?php

			$pquery="select * from production_type_val order by type_value ASC";

			db();
			$pres=db_query($pquery);

			while($prow=array_shift($pres))

			{

				?>

				<option value="<?php echo $prow["type_value"]; ?>"><?php echo "$".number_format($prow["type_value"],2)." ".$prow["prod_type"]; ?></option>

				<?php

			}

			?>

			</select>

		</td><td bgColor="#e4e4e4"><input name="production_5" value=""></td><td bgColor="#e4e4e4"><input size=25 name="notes_5" value=""></td>	</tr>	

	<tr>

		<td bgColor="#e4e4e4" align="right">6: $

				<select name="value_6">

					<option value="-" >Select</option>

			<?php

			$pquery="select * from production_type_val order by type_value ASC";

			db();
			$pres=db_query($pquery);

			while($prow=array_shift($pres))

			{

				?>

				<option value="<?php echo $prow["type_value"]; ?>"><?php echo "$".number_format($prow["type_value"],2)." ".$prow["prod_type"]; ?></option>

				<?php

			}

			?>

			</select>

		</td><td bgColor="#e4e4e4"><input name="production_6" value=""></td><td bgColor="#e4e4e4"><input size=25 name="notes_6" value=""></td>	</tr>	

	<tr>

		<td bgColor="#e4e4e4" align="right">7: $

				<select name="value_7">

					<option value="-" >Select</option>

			<?php

			$pquery="select * from production_type_val order by type_value ASC";

			db();
			$pres=db_query($pquery);

			while($prow=array_shift($pres))

			{

				?>

				<option value="<?php echo $prow["type_value"]; ?>"><?php echo "$".number_format($prow["type_value"],2)." ".$prow["prod_type"]; ?></option>

				<?php

			}

			?>

			</select>

		</td>

		<td bgColor="#e4e4e4"><input name="production_7" value=""></td><td bgColor="#e4e4e4"><input size=25 name="notes_7" value=""></td>	</tr>	

	<tr>

		<td bgColor="#e4e4e4" align="right">8: $

				<select name="value_8">

					<option value="-" >Select</option>

			<?php

			$pquery="select * from production_type_val order by type_value ASC";

			db();
			$pres=db_query($pquery);

			while($prow=array_shift($pres))

			{

				?>

				<option value="<?php echo $prow["type_value"]; ?>"><?php echo "$".number_format($prow["type_value"],2)." ".$prow["prod_type"]; ?></option>

				<?php

			}

			?>

			</select>

		</td><td bgColor="#e4e4e4"><input name="production_8" value=""></td><td bgColor="#e4e4e4"><input size=25 name="notes_8" value=""></td>	</tr>	

	<tr>

		<td bgColor="#e4e4e4" align="right">9: $

				<select name="value_9">

					<option value="-" >Select</option>

			<?php

			$pquery="select * from production_type_val order by type_value ASC";

			db();
			$pres=db_query($pquery);

			while($prow=array_shift($pres))

			{

				?>

				<option value="<?php echo $prow["type_value"]; ?>"><?php echo "$".number_format($prow["type_value"],2)." ".$prow["prod_type"]; ?></option>

				<?php

			}

			?>

			</select>

		</td><td bgColor="#e4e4e4"><input name="production_9" value=""></td><td bgColor="#e4e4e4"><input size=25 name="notes_9" value=""></td>	</tr>	

	<tr>

		<td bgColor="#e4e4e4" align="right">10: $

				<select name="value_10">

					<option value="-" >Select</option>

			<?php

			$pquery="select * from production_type_val order by type_value ASC";

			db();
			$pres=db_query($pquery);

			while($prow=array_shift($pres))

			{

				?>

				<option value="<?php echo $prow["type_value"]; ?>"><?php echo "$".number_format($prow["type_value"],2)." ".$prow["prod_type"]; ?></option>

				<?php

			}

			?>

			</select>

		</td>

		<td bgColor="#e4e4e4"><input name="production_10" value=""></td><td bgColor="#e4e4e4"><input size=25 name="notes_10" value=""></td>	</tr>

    

    <tr>	<td bgColor="#e4e4e4" align="right">11: $

			<select name="value_11">

				<option value="-" >Select</option>

			<?php

			$pquery="select * from production_type_val order by type_value ASC";

			db();
			$pres=db_query($pquery);

			while($prow=array_shift($pres))

			{

				?>

				<option value="<?php echo $prow["type_value"]; ?>"><?php echo "$".number_format($prow["type_value"],2)." ".$prow["prod_type"]; ?></option>

				<?php

			}

			?>

			</select>

		</td>

		<td bgColor="#e4e4e4"><input name="production_11" value=""></td><td bgColor="#e4e4e4"><input size=25 name="notes_11" value=""></td>	</tr>

    <tr>	

		<td bgColor="#e4e4e4" align="right">12: $

				<select name="value_12">

					<option value="-" >Select</option>

			<?php

			$pquery="select * from production_type_val order by type_value ASC";

			db();
			$pres=db_query($pquery);

			while($prow=array_shift($pres))

			{

				?>

				<option value="<?php echo $prow["type_value"]; ?>"><?php echo "$". number_format($prow["type_value"],2)." ".$prow["prod_type"]; ?></option>

				<?php

			}

			?>

			</select>

		</td>

		<td bgColor="#e4e4e4"><input name="production_12" value=""></td><td bgColor="#e4e4e4"><input size=25 name="notes_12" value=""></td>	</tr>

    <tr>	<td bgColor="#e4e4e4" align="right">13: $

		<select name="value_13">

			<option value="-" >Select</option>

			<?php

			$pquery="select * from production_type_val order by type_value ASC";

			db();
			$pres=db_query($pquery);

			while($prow=array_shift($pres))

			{

				?>

				<option value="<?php echo $prow["type_value"]; ?>"><?php echo "$". number_format($prow["type_value"],2)." ".$prow["prod_type"]; ?></option>

				<?php

			}

			?>

			</select>

		</td>

		<td bgColor="#e4e4e4"><input name="production_13" value=""></td><td bgColor="#e4e4e4"><input size=25 name="notes_13" value=""></td>	</tr>

	 <tr>	<td bgColor="#e4e4e4" align="right">14: $

		<select name="value_14">

			<option value="-" >Select</option>

			<?php

			$pquery="select * from production_type_val order by type_value ASC";

			db();
			$pres=db_query($pquery);

			while($prow=array_shift($pres))

			{

				?>

				<option value="<?php echo $prow["type_value"]; ?>"><?php echo "$". number_format($prow["type_value"],2)." ".$prow["prod_type"]; ?></option>

				<?php

			}

			?>

			</select>

		 </td><td bgColor="#e4e4e4"><input name="production_14" value=""></td><td bgColor="#e4e4e4"><input size=25 name="notes_14" value=""></td>	</tr>

    <tr>	<td bgColor="#e4e4e4" align="right">15: $

		<select name="value_15">

			<option value="-" >Select</option>

			<?php

			$pquery="select * from production_type_val order by type_value ASC";

			db();
			$pres=db_query($pquery);

			while($prow=array_shift($pres))

			{

				?>

				<option value="<?php echo $prow["type_value"]; ?>"><?php echo "$". number_format($prow["type_value"],2)." ".$prow["prod_type"]; ?></option>

				<?php

			}

			?>

			</select>

		</td><td bgColor="#e4e4e4"><input name="production_15" value=""></td><td bgColor="#e4e4e4"><input size=25 name="notes_15" value=""></td>	</tr>

    <tr>	

		<td bgColor="#e4e4e4" align="right">16: $

			<select name="value_16">

				<option value="-" >Select</option>

			<?php

			$pquery="select * from production_type_val order by type_value ASC";

			db();
			$pres=db_query($pquery);

			while($prow=array_shift($pres))

			{

				?>

				<option value="<?php echo $prow["type_value"]; ?>"><?php echo "$". number_format($prow["type_value"],2)." ".$prow["prod_type"]; ?></option>

				<?php

			}

			?>

			</select>

		</td>

		<td bgColor="#e4e4e4"><input name="production_16" value=""></td><td bgColor="#e4e4e4"><input size=25 name="notes_16" value=""></td>	</tr>

    <tr>	<td bgColor="#e4e4e4" align="right">17: $

		<select name="value_17">

			<option value="-" >Select</option>

			<?php

			$pquery="select * from production_type_val order by type_value ASC";

			db();
			$pres=db_query($pquery);

			while($prow=array_shift($pres))

			{

				?>

				<option value="<?php echo $prow["type_value"]; ?>"><?php echo "$". number_format($prow["type_value"],2)." ".$prow["prod_type"]; ?></option>

				<?php

			}

			?>

			</select>

		</td>

		<td bgColor="#e4e4e4"><input name="production_17" value=""></td><td bgColor="#e4e4e4"><input size=25 name="notes_17" value=""></td>	</tr>

    <tr>	<td bgColor="#e4e4e4" align="right">18: $

		<select name="value_18">

			<option value="-" >Select</option>

			<?php

			$pquery="select * from production_type_val order by type_value ASC";

			db();
			$pres=db_query($pquery);

			while($prow=array_shift($pres))

			{

				?>

				<option value="<?php echo $prow["type_value"]; ?>"><?php echo "$". number_format($prow["type_value"],2)." ".$prow["prod_type"]; ?></option>

				<?php

			}

			?>

			</select>

		</td>

		<td bgColor="#e4e4e4"><input name="production_18" value=""></td><td bgColor="#e4e4e4"><input size=25 name="notes_18" value=""></td>	</tr>

    

		<tr>

			<td bgColor="#e4e4e4" colspan=10 align=center>

				<input type=submit value="Add Production">

			</td>

		</tr>

	</table>

    

	</form>

<div>

    	<?php



	if ($_REQUEST["action"]=="productionadd")

	{

		$sqlw = "SELECT * FROM loop_workers WHERE id = " .  $_REQUEST["worker"];

		db();
		$resultw = db_query($sqlw);	

		$roww = array_shift($resultw);

		$workerid = $roww["id"];

		$type = $_REQUEST["type"];

		$warehouse_id = $roww["warehouse_id"];

		$rate_cost = $roww["rate_cost"];

		$rate_revenue = $roww["rate_revenue"];



		$getTierval = "SELECT * FROM loop_worker_tier WHERE tier = '".$roww["emp_tier"]."'";

		db();
		$resTierval = db_query($getTierval);

		$rowTierval = array_shift($resTierval);

		$tierval 	= $rowTierval["tier_value"];

		$tier_id    = $rowTierval["id"];

		

		$x=1;

		While ($x <19 ) {

			$v = "value_" . $x;

			$p = "production_" . $x;

			$n = "notes_" . $x;

			

			$notes = str_replace("'", "\'" ,$_REQUEST[$n]); 

       		// echo $p;

			if ($_REQUEST[$p] != "") 

			{

				//

				$sql3 = "INSERT INTO loop_timeclock_production SET date = '" . date("Y-m-d",strtotime($_REQUEST["start_date"])) . " 00:00:01', warehouse_id='" . $warehouse_id . "', worker_id = '" . $workerid . "', rate='" . $_POST[$v] . "', production='" . $_POST[$p] . "', notes = '" . $notes . "', tier_value = '".$tierval."', tier_id = '".$tier_id."', added_by = '".$_COOKIE['userinitials']."', added_on = '".date('Y-m-d H:i:s')."'  ";

				db();
				$result3 = db_query($sql3);

				//echo $sql3;

			}

			$x++;

		}

        

        ?>

        

    <?php

	}

   if($showdata=="show")

   {

       echo "<br><br>";

    $start_date_org = $_REQUEST["start_date"];

    $start_date=$_REQUEST["start_date"]." 00:00:01";

   //$start_date1 = date("Y-m-d",strtotime(str_replace('/','-',$start_date)));

   $start_date1 = date("Y-m-d 00:00:01",strtotime($start_date));

       //echo $start_date ;

$time = strtotime($start_date);



$st_tuesday = strtotime('last tuesday', $time);



//echo $start_date . "<BR>";

//echo $time . "<BR>";

//echo $st_tuesday;"<BR>";

//echo date('Y-m-d 00:00:01',$time) . "<BR>";

//echo date('Y-m-d 00:00:01',$st_tuesday). "<BR>";

$st_monday = strtotime('+6 days', $st_tuesday);

//echo date('Y-m-d 23:59:59',$st_monday);

?>

<table cellSpacing="1" cellPadding="1" width="99%" border="0">

	<tr align="middle">

		<td colSpan="13" class="style7">

		TIMECLOCK REPORT FOR: 



<?php
$query = "SELECT * FROM `loop_workers` WHERE id = ".$worker."";

db();
$res = db_query($query);

$row = array_shift($res);

$name = $row["name"];

$rate = $row["rate_cost"];

echo "<b>" . $row["name"] . "</b>";
?>

</td>

	</tr>

	<tr>

		<td class="style17">

		<font face="Arial, Helvetica, sans-serif" color="#333333" size="1">

		DATE</font></td>

		<td class="style17">

		<font face="Arial, Helvetica, sans-serif" color="#333333" size="1">

		TIME IN</font></td>

		<td class="style5" >

		<font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		

		TIME OUT</td>

		<td align="middle" class="style16">

		<font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		

		AMOUNT</td>

		<td align="middle" class="style16">

		<font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		

		TYPE</td>

		<td align="middle" class="style16">

		<font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		

		IP CLOCK-IN</td>

		<td align="middle" class="style16">

		<font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		

		IP CLOCK-OUT</td>

		<td align="middle" class="style16">

		<font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		

		NOTES</td>

	</tr>

	

<?php
$query =
    "SELECT *, IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)) AS A, DATE_FORMAT(time_in, '%W, %M %d, %Y') AS D, TIME(time_in) AS T_I, TIME(time_out) AS T_O FROM loop_timeclock WHERE  worker_id = ".$worker.
    " ";

if ($start_date != "") {
    $query .=
        " AND (time_in >= '" .
        $start_date_org .
        " 00:00:00' and time_in <= '" .
        $start_date_org .
        " 23:59:59') ";
}

$query .= " order by time_in";

// echo $query . "<br>";

db();
$res = db_query($query);

while ($row = array_shift($res)) { ?>





		<tr vAlign="center">

			<td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	

			<?php echo $row["D"]; ?></td>

			<td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	

			<?php echo $row["T_I"]; ?></td>

			<td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	

			<?php echo $row["T_O"]; ?></td>



			<td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right>

			<?php 

				$time_diff_h = 0; $time_diff_m = 0;

				if (strpos($row["A"], ":") > 0) {

					$time_diff_h = substr($row["A"], 0, strpos($row["A"],':')); 

					$tmpdt = substr($row["A"], strpos($row["A"],':')+1); 

					$time_diff_m = substr($tmpdt, 0, strpos($tmpdt,':')); 

				}

			if (($time_diff_h > 8) || ($time_diff_h == 8 && $time_diff_m > 0)) { ?>

				<font face="Arial, Helvetica, sans-serif" color="red" size="1">	

			<?php } else { ?>

				<font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	

			<?php } ?>

			<?php echo $row["A"]; ?></td>

			</td>

			<td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	

			<?php echo $row["type"];?></td>

			<td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	

			<?php echo $row["ipaddress"];?></td>

			<td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	

			<?php echo $row["ipaddress_clkout"];?></td>



			<td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=left><font size=1><?php if ($row["time_in_old"] != "0000-00-00 00:00:00") echo $row["time_in_old"];?> <?php  if ($row["time_out_old"] != "0000-00-00 00:00:00") echo $row["time_out_old"];?> <?php echo $row["notes"];?></font></td>

		

		</tr>

<?php }

$query =
    "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE worker_id = ".$worker." ";

if ($start_date != "") {
    $query .=
        " AND (time_in >= '" .
        $start_date1 .
        " 00:00:00' and time_in <= '" .
        $start_date1 .
        " 23:59:59') ";
}

db();
$res = db_query($query);

while ($row = array_shift($res)) { ?>

<tr vAlign="center">

		<td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	

		 </td>

		<td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	

		<?php echo $total_orders; ?></td>

		<td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	

		Total HoursA</td>

		<td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	

		<?php echo $row["ADT"]; ?> </td>

		<td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	

		<?php echo number_format($row["DT"]/3600,2); ?>  </td>

		<td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	

		 </td>

		<td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	

		 </td>

		<td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	

		 </td>

	</tr>

<?php }
?>



</table>



<br/>

    <table cellSpacing="1" cellPadding="1" width="99%" border="0">

	<tr align="middle">

		<td colSpan="10" class="style7">

		PRODUCTION REPORT FOR: 



<?php
$query = "SELECT * FROM `loop_workers` WHERE id = ".$worker."";

db();
$res = db_query($query, );

$row = array_shift($res);

$name = $row["name"];

echo "<b>" . $row["name"] . "</b>";
?>

</td>

	</tr>

	<tr>

		<td class="style17">

		<font face="Arial, Helvetica, sans-serif" color="#333333" size="1">

		PRODUCTION DATE</font></td>

		<td class="style17">

		<font face="Arial, Helvetica, sans-serif" color="#333333" size="1">

		ENTERED ON</font></td>

		<td class="style17">

		<font face="Arial, Helvetica, sans-serif" color="#333333" size="1">

		RATE</font></td>

		<td class="style5" >

		<font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		

		PRODUCTION</td>

		<td align="middle" class="style16">

		<font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		

		SUBTOTAL</td>

		<td align="middle" class="style16">

		<font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		

		TIER INCREASE</td>

		<td align="middle" class="style16">

		<font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		

		GRAND TOTAL</td>

		<td align="middle" class="style16">

		<font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		

		TIER</td>

		<td align="middle" class="style16">

		<font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		

		NOTES</td>

	</tr>

	

<?php
$query =
    "SELECT *, DATE_FORMAT(date, '%W, %M %d, %Y') AS D, rate AS R, production AS P, added_by AS addedEmp, added_on AS recordDate FROM loop_timeclock_production WHERE worker_id = ".$worker.
    " ";

if ($start_date != "") {
    $query .= " AND date ='$start_date1'";
}

//echo $query . "<br>";
db();
$res = db_query($query);

$production_total = 0;

$bonusProTotal = 0;

$tierIncresedValTotal = $grandTotalAll = 0;

while ($row = array_shift($res)) { ?>

<?php

//

	$wq="select emp_tier from loop_workers where id='".$_REQUEST["worker"]."'";

	db();
	$wres=db_query($wq);

	$wrow=array_shift($wres);

	$emp_tier=$wrow["emp_tier"];

	

	$et_query="select * from loop_worker_tier where id='". $row["tier_id"] ."'";

	db();
	$etres = db_query($et_query);

	$et_row = array_shift($etres);

	$tier_name = $et_row["tier"];

	

	$et_query="select * from loop_worker_tier where tier='".$emp_tier."'";

	db();
	$etres=db_query($et_query);

	$et_row=array_shift($etres);

	$emp_tier_value=$et_row["tier_value"];

	//

	//$new_rate= $row["R"]*$emp_tier_value;

	$production_val = $row["R"]*$row["P"];

	//

//

?>



		<tr vAlign="center">

			<td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	

			<?php echo $row["D"]; ?></td>

			<td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	

				<?php 

				if($row['recordDate'] != ''){

					echo date("m/d/Y H:i:s", strtotime($row['recordDate'])).' ('.$row['addedEmp'].')';

				}

				?>

			</td>

			<td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	

			$<?php echo number_format($row["R"],2); ?></td>

			<td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	

			<?php echo $row["P"]; ?></td>



			<td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	

				

				

			$<?php echo number_format($production_val,2);?></td>



			<td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">

				<?php                 

				$tierIncresedVal =  number_format(($production_val * $row["tier_value"]), 2);

				echo "$".$tierIncresedVal;

				?>

			</td>

			<td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">

				<?php

                if($tierIncresedVal == 'Invalid Tier Value'){

                    $grandTotal = number_format($production_val ,2);

                }else{

					$grandTotal = number_format($production_val + floatval(str_replace(',', '', $tierIncresedVal)), 2);

                }				

				echo "$". $grandTotal;

				?>

			</td>



			<td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=left><font size=1><?php echo $tier_name;?></font></td>

		

			<td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=left><font size=1><?php echo $row["notes"];?></font></td>

		

		</tr>

<?php
$production_total += str_replace(",", "", number_format($production_val, 2));

$bonusProTotal += $row["R"] * $row["P"];

if ($tierIncresedVal != "Invalid Tier Value") {
    $tierIncresedValTotal += $tierIncresedVal;
}

$grandTotalAll += str_replace(",", "", $grandTotal);
}
?>

<tr vAlign="center">

		<td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	

		 </td>

		<td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	

		 </td>

		<td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	

		 </td>

		<td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	

		 	Total Production Value

		</td>

		<td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	

			<?php echo "$".number_format($production_total,2); ?> 

		</td>

		<td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	

            <?php echo "$".number_format($tierIncresedValTotal,2); ?>

		</td>

		<td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">

        <?php echo "$".number_format($grandTotalAll,2); ?>	

		</td>

		<td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	

		 </td>

		<td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	

		 </td>

	</tr>

</table>

<!-- BONUS CALCULATION START -->

    <?php    

    $pq     = "SELECT name, loop_workers.rate_cost AS RC, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))/3600 AS DT FROM loop_timeclock LEFT JOIN loop_workers ON loop_timeclock.worker_id = loop_workers.id WHERE (loop_timeclock.type LIKE '%Production' OR loop_timeclock.type LIKE '%kits' OR loop_timeclock.type LIKE '%achines') AND loop_timeclock.worker_id = ".$worker." ";

	if($start_date != "")

	{

		$pq .= " AND (time_in >= '" . $start_date1 . " 00:00:00' and time_in <= '" . $start_date1 . " 23:59:59') ";

	}

	db();

    $pres       = db_query($pq);

    $prow       = array_shift($pres);

    $totalHours = $prow["DT"];

    $hourlyRate = $prow["RC"];



    $hourlyValue = ($totalHours * $hourlyRate);

    $bonus = $grandTotalAll - $hourlyValue;



    ?>

    <br/>

    <table cellSpacing="1" cellPadding="1" width="40%" border="0">

        <tr align="middle">

            <td colSpan="2" class="style7">Produciton Bonus Calculation</td>

        </tr>

        <tr vAlign="center">

            <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">Hourly Value</td>

            <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><?php echo "$".number_format($hourlyValue,2); ?></td>

        </tr>

        <tr vAlign="center">

            <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">Production Value</td>

            <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><?php echo "$".number_format($grandTotalAll,2); ?>   </td>

        </tr>

        <tr vAlign="center">

            <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><b>Bonus</b></td>

            <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><?php echo "$".number_format($bonus,2); ?> </td>

        </tr>

    </table>



<!-- BONUS CALCULATION ENDS -->







<?php

}

?>

  





<br></span></span></span>

</div>

</div>

<div class="b2c_inventory_div">

     <div class="title_txt">Add B2C Kit Inventory</div>

<br><br><br>

     <div class="b2c_inventory_div_inner">   

          <table border="0" align="center">

        <?php 

	       $in_dt_range = "no";

	       if (isset($_POST["ctrl_hd"])){

		      $recfound = "no";

		

		      for ($ctlcnt=0; $ctlcnt < $_POST["ctrl_hd"]; $ctlcnt++) {

			     if ($_POST["qty"][$ctlcnt] <> "") {
					
					db();
				    $result2 = db_query("insert into products_kit_item_inventory (qty, notes, products_kit_item_id, warehouse_id, last_updated_on, updated_by, in_out_flg) values(" . $_POST["qty"][$ctlcnt] . ", '" . $_POST["note"][$ctlcnt] . "',  " . $_POST["prod_id"][$ctlcnt] . ", " . $_POST["warehouseid"] . ", '" . date("Y-m-d H:i:s") . "', '" . $_COOKIE['userinitials'] . "', 0)");

				
                    db();
				    $result_main = db_query("select products_kit_item_id from products_kit_item_master where products_kit_item_id = " . $_POST["prod_id"][$ctlcnt] . " and active = 1 order by display_order");

				    while ($row_main = array_shift($result_main)) {	

					

					//and products_kit_raw_item_id = " . $_POST["prod_id"][$ctlcnt] . "
					   db();
					   $result_child = db_query("select products_kit_item_id, products_kit_raw_item_id, data_val from products_kit_rawitem_mapping where products_kit_item_id = " . $row_main["products_kit_item_id"] . " order by unqid");

					   while ($row_child = array_shift($result_child)) {	
						  db();
						  $result3 = db_query("insert into products_kit_raw_item_inventory (qty, notes, products_kit_raw_item_id, warehouse_id, last_updated_on, updated_by, in_out_flg) values('-" . $_POST["qty"][$ctlcnt] * $row_child["data_val"] . "', '" . $_POST["note"][$ctlcnt] . "', " . $row_child["products_kit_raw_item_id"] . ", " . $_POST["warehouseid"] . ", '" . date("Y-m-d H:i:s") . "', '" . $_COOKIE['userinitials'] . "', 1)");

					}					 

				}

			}

		}

	

        	echo "<script type=\"text/javascript\">";

	echo "window.location.href=\"report_b2c_inventory_new.php" . "\";";

	echo "</script>";

	echo "<noscript>";

	echo "<meta http-equiv=\"refresh\" content=\"0;url=report_b2c_inventory_new.php" . "\" />";

	echo "</noscript>"; exit;

	

	}

?>	

      <tr>

        <td>

            <form name="frm" action="" method="post">

            <font face="Arial, Helvetica, sans-serif" color="#333333" size="2">Select Location: 

                </font>

                <select name="location_dd" id="location_dd">

            <option selected value="-1">Select</option>

            <?php

            //load locations from database in dropdown
			db();
            $result_main = db_query("select warehouse_id, warehouse_name from kitinv_warehouse_master where activeflg = 1 order by warehouse_name");

            while ($row_main = array_shift($result_main)) 

            {

            ?>

            <option value="<?php echo $row_main["warehouse_id"]; ?>" <?php if ($row_main["warehouse_id"] == $_REQUEST["location_dd"]) { echo " selected "; }?>> <?php echo $row_main["warehouse_name"]; ?></option>

            <?php

            }

            ?>

            </select>

                <input type="submit" name="show_data" value="Submit">

            </form>

        </td>

      </tr>

        <?php if (
            isset($_REQUEST["show_data"]) &&
            $_REQUEST["show_data"] == "Submit"
        ) {
            if (
                isset($_REQUEST["location_dd"]) &&
                $_REQUEST["location_dd"] != "-1"
            ) { ?> 

                <tr>

                    <td>

                        <table cellSpacing="1" cellPadding="5" border="0" id="table8" width="100%">

                            <thead>

                                <tr><td class="txtstyle_color" colspan="3" align="center"><strong>B2C Kit Inventory</strong></td></tr>

                                <tr>

                                    <th bgColor='#E4EAEB' align=center width="150px">

                                        <u>Items</u>

                                    </th>

                                    <th bgColor='#E4EAEB' width="120px">

                                        <?php
											db();
                                            $result_main = db_query("select warehouse_id, warehouse_name from kitinv_warehouse_master where warehouse_id=".$_REQUEST["location_dd"]);

                                            $row_main = array_shift($result_main);	

                                            $warehouse_id=$row_main["warehouse_id"];

                                            echo $row_main["warehouse_name"];

                                        ?>

                                    </th>

                                    <th bgColor='#E4EAEB' align=center width="150px">

                                        <u>Notes</u>

                                    </th>

                                 <?php


									db();
                                    $result_main = db_query("select * from products_kit_item_master where active = 1 order by display_order");

                                    while ($row_main = array_shift($result_main)) {	

                                        $product_array[] = array('products_kit_item_id' => $row_main["products_kit_item_id"], 'products_kit_item' => $row_main["products_kit_item"]);

                                    }

                                ?> 

                                </tr>

                            </thead>

                            <tbody>

                                <form name="b2cinv"	id="b2cinv" action="report_timeclock_production_add.php" method="post">

                                    <?php

                                        $txt_cnt = 0; $tot_val = 0;

                                        echo "<input type='hidden' name='warehouseid' value='" . $warehouse_id . "'/>";

                                        foreach ($product_array as $product_array_tmp){

                                            echo "<tr><td bgColor='#E4EAEB'>" . $product_array_tmp["products_kit_item"] . "</td>";



                                            $data_found = "n"; 



                                                $txt_cnt = $txt_cnt + 1;	

                                                echo "<td bgColor='#E4EAEB' align='right'><input type='text' name='qty[]' id='qty_" . $txt_cnt ."' value=''/><input type='hidden' name='prod_id[]' value='" . $product_array_tmp["products_kit_item_id"] . "'/></td>

                                                <td bgColor='#E4EAEB'><textarea name='note[]' id='note_" . $txt_cnt ."'></textarea>";

                                                echo "</tr>";

                                        }//End foreach

                                    ?>

                                    <tr><td bgColor='#E4EAEB' colspan="<?php echo $txt_cnt;?>" align="center"><input type='submit' name='btnsubmit' id='btnsubmit' value='Submit'/></td></tr>



                                    <input type='hidden' name='ctrl_hd' id='ctrl_hd' value='<?php echo $txt_cnt;?>'/>

                                </form>

                            </tbody>

                        </table>

                    </td>

                </tr>

        <?php }
        } ?>

	   </table>

    </div>

</div>



	</div>

</body>

</html>
