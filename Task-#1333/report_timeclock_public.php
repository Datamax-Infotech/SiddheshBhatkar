<?php
   require ("inc/header_session.php");
   require ("../mainfunctions/database.php");
   require ("../mainfunctions/general-functions.php");
?>
<!DOCTYPE html>
<html>
   <head>
      <title>Employee Public Timeclock & Production Summary Report</title>
      <style type="text/css">
         .header_td_style
         {
         font-family:arial;
         font-size:12;
         height: 16px; 
         background:#ABC5DF;
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
         .table_margin{
         padding-right: 10px;
         }
      </style>
      <script type="text/javascript"> 
         function checkdate()
         
         {
         
         	if (document.getElementById("new_time_in").value == "") {
         
         		alert("Please enter the New Time In.");
         
         		return false;
         
         	}
         
         	
         
         	if (document.getElementById("new_time_out").value == "") {
         
         		alert("Please enter the New Time Out.");
         
         		return false;
         
         	}
         
         	
         
         	if (document.getElementById("new_time_in").value > document.getElementById("new_time_out").value) {
         
         		alert("New Time In > New Time out, please check.");
         
         		return false;
         
         	}
         
         	
         
         	document.rptSearch2.submit();
         
         }
         
         
         
         function chkssn(){
         
         	if (document.getElementById('ssn_txt').value.trim() == ""){
         
         		alert("Please enter the last four digit of your SSN.");
         
         		return false;
         
         	}else {
         
         		return true;
         
         	}
         
         }
         
         
         
      </script>
      <LINK rel='stylesheet' type='text/css' href='one_style.css' >
      <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
      <link rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>
   </head>
   <body>
      <?php include("inc/header.php"); ?>
      <div class="main_data_css">
      <div class="dashboard_heading" style="float: left;">
         <div style="float: left;">
            Employee Public Timeclock & Production Summary Report 
            <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
               <span class="tooltiptext">
               This report shows the user the summary of the timeclock and production within a provided time period for a specific employee.
               </span>
            </div>
            <div style="height: 13px;">&nbsp;</div>
         </div>
      </div>
      <form name="rptSearch" action="" method="GET" onsubmit="return chkssn();">
         <input type="hidden" name="action" value="run">
         <br /><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
         Find 
         <select name="worker">
            <option>Please Select</option>
            <option value=-1>ALL</option>
            <?php
               $total_production = 0; $total_production_val = 0; 
               
               $sql3 = "SELECT * FROM loop_workers ORDER BY active DESC, name ASC";
               
			   db();
               $result3 = db_query($sql3);
               
               while ($myrowsel3 = array_shift($result3)) {
               
               ?>
            <option value="<?php echo $myrowsel3["id"]; ?>" <?php if ($myrowsel3["id"]==$_REQUEST["worker"]) echo "selected"; ?>><?php echo $myrowsel3["name"]; ?></option>
            <?php } ?>
         </select>
         <script language="JavaScript" src="inc/CalendarPopup.js"></SCRIPT>
         <script language="JavaScript">document.write(getCalendarStyles());</script>
         <script language="JavaScript">
            var cal1xx = new CalendarPopup("listdiv");
            
            cal1xx.showNavigationDropdowns();
            
            var cal2xx = new CalendarPopup("listdiv");
            
            cal2xx.showNavigationDropdowns();
            
         </script>
         <?php
            $start_date = isset($_GET["start_date"])?strtotime($_GET["start_date"]):strtotime(date('m/d/Y'));
            
            $end_date = isset($_GET["end_date"])?strtotime($_GET["end_date"]):strtotime(date('m/d/Y'));
            
			$first_week = 1; // Moved to new position - Siddhesh
			$first_week_regular_time = ""; // Moved to new position - Siddhesh
			$first_week_overtime = ""; // Moved to new position - Siddhesh
			$start_date1 = ""; // Moved to new position - Siddhesh
			$total_orders = ""; // Moved to new position - Siddhesh
			$bonusProTotal = ""; // Moved to new position - Siddhesh
			$tierIncresedValTotal = ""; // Moved to new position - Siddhesh
			$grandTotalAll = ""; // Moved to new position - Siddhesh
			$production_value = 0; // Moved to new position - Siddhesh
			$production_bonus = ""; // Moved to new position - Siddhesh
			$other_bonus = 0; // Moved to new position - Siddhesh
			$reg_hrs = 0; // Moved to new position - Siddhesh
			$overtime = 0;  // Moved to new position - Siddhesh
			$rate = 0; // Moved to new position - Siddhesh
			$production_hours = 0; // Moved to new position - Siddhesh
			$dt = ""; // Moved to new position - Siddhesh
			$st_monday = ""; //Moved to new position - Siddhesh
			$bonus = ""; //Moved to new position - Siddhesh

		?>
         <font face="Arial, Helvetica, sans-serif" color="#333333" size="1"> from: <input type="text" name="start_date" size="11" value="<?php echo (isset($_GET["start_date"]) && $_GET["start_date"] != "")?date('m/d/Y', $start_date):""?>"> <a href="#" onclick="cal1xx.select(document.rptSearch.start_date,'anchor1xx','MM/dd/yyyy'); return false;" name="anchor1xx" id="anchor1xx"><img border="0" src="images/calendar.jpg"></a> <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">to: <input type="text" name="end_date" size="11" value="<?php echo (isset($_GET["end_date"]) && $_GET["start_date"] != "")?date('m/d/Y', $end_date):""?>"> <a href="#" onclick="cal1xx.select(document.rptSearch.end_date,'anchor2xx','MM/dd/yyyy'); return false;" name="anchor2xx" id="anchor2xx"><img border="0" src="images/calendar.jpg"></a>
         &nbsp;SSN (last 4 digit): <input type="password" name="ssn_txt" id="ssn_txt" value="">
         &nbsp; <input type="submit" value="Search">
      </form>
      <div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>
      <br><br>
      <?php
         if ($_GET["action"] == 'run') {
         
         	$rec_bypass = "no";
         
         	$sql_chk = "select user_pwd from loop_workers where id = " . $_REQUEST["worker"];
			
			db();
         	$result_chk = db_query($sql_chk);
         
         	$rec_found = "notfound";
         
         	$emp_login_msg = "<font color=red><b>Entered last four digit of your SSN is not matching, please check.</b></font>";
         
         	while($row_chk = array_shift($result_chk)){
         
         		$rec_found = "found";
         
         		if ($row_chk["user_pwd"] != "0") {
         
         			if ($row_chk["user_pwd"] != $_REQUEST["ssn_txt"]) {
         
         				$rec_bypass = "err";
         
         				$emp_login_msg = "<font color=red><b>Entered last four digit of your SSN is not matching, please check.</b></font>";
         
         			}else{
         
         				$emp_login_msg = "";
         
         			}
         
         		}else{
         
         			$rec_bypass = "err";
         
         			$emp_login_msg = "<font color=red><b>SSN not updated in the master, please check.</b></font>";
         
         		}
         
         	}
         
         	if ($rec_bypass == "err"){
         
         		$sql_chk = "select variablevalue from tblvariable where variablename = 'master_pin'";
				
				db();
         		$result_chk = db_query($sql_chk);
         
         		while($row_chk = array_shift($result_chk)){
         
         			if ($row_chk["variablevalue"] != $_REQUEST["ssn_txt"]){
         
         				$rec_bypass = "err";
         
         				$emp_login_msg = "<font color=red><b>Entered last four digit of your SSN is not matching, please check.</b></font>";
         
         			}else{
         
         				$emp_login_msg = "";
         
         				$rec_bypass = "no";
         
         			}
         
         
         
         		}
         
         		echo $emp_login_msg;
         
         	}
         
         	
         
         	if ($rec_bypass != "err"){
         
         
         
         		if ($_GET["delete"] == 'true') {
					db();
         			$res = db_query("DELETE FROM loop_timeclock_bonus WHERE id = " . $_REQUEST["id"]);
         
         		}
         
         		if ($_REQUEST["worker"] != -1)
         
         		{
         
         			$start_date = date('Y-m-d', $start_date);
         
         			$end_date_bonus = date('Y-m-d', $end_date);
         
         			$end_date = date('Y-m-d', $end_date + 86400);
         
					$end_date = strtotime($end_date);
					$end_date_ot = date('Y-m-d', $end_date);
         
         			if ($start_date > $end_date) {
         
         			echo "<font size=20>Nice Try, David - You thought I would not catch an error where the start date comes after the end date.</font>";
         
         		}
         
         
         
         		?>
     
      <?php
         $time = strtotime($start_date);
         
         $st_tuesday = strtotime('last tuesday', $time);
         
         $st_monday = strtotime('+6 days', $st_tuesday);
         
         ?>
      <table cellSpacing="1" cellPadding="3" width="800" border="0">
         <tr align="middle">
            <td colSpan="11" class="style7">
               TIMECLOCK REPORT FOR: 
               <?php
                  $query = "SELECT * FROM `loop_workers` WHERE id = " . $_REQUEST["worker"] ;
				
				  db();
                  $res = db_query($query);
                  
                  $row = array_shift($res);
                  
                  $name = $row["name"];
                  
                  $rate = $row["rate_cost"];
                  
                  echo "<b>".$row["name"]."</b>";
                  
                  ?>
            </td>
         </tr>
         <tr>
            <td class="style17" align="center">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               DATE</font>
            </td>
            <td class="style17" align="center">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               TIME IN</font>
            </td>
            <td class="style5" align="center">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               TIME OUT
            </td>
            <td align="middle" class="style16" align="center">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               AMOUNT
            </td>
            <td valign="middle" class="style16" align="center">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               TYPE
            </td>
            <td align="center" class="style16">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               IP CLOCK-IN
            </td>
            <td align="center" class="style16">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               IP CLOCK-OUT
            </td>
            <td align="center" class="style16">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               NOTES
            </td>
         </tr>
         <?php
            $query = "SELECT *, IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)) AS A, DATE_FORMAT(time_in, '%W, %M %d, %Y') AS D, TIME(time_in) AS T_I, TIME(time_out) AS T_O FROM loop_timeclock WHERE worker_id = " . $_REQUEST["worker"] . " ";
            
            if($_GET["start_date"] != "")
            
            {
            
             $query .= " AND time_in BETWEEN '$start_date'";
            
            }
            
            if($_GET["end_date"] != "")
            
            {
            
             $query .= " AND '$end_date'";
            
            }
            
            $query .= " order by time_in";
            
            db();
            $res = db_query($query);
            
            while($row = array_shift($res))
            
            {
            
            
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["D"]; ?>
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["T_I"]; ?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["T_O"]; ?>
            </td>
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
               <?php echo $row["A"]; ?>
            </td>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["type"];?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["ipaddress"];?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["ipaddress_clkout"];?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=left><font size=1><?php if ($row["time_in_old"] != "0000-00-00 00:00:00") echo $row["time_in_old"];?> <?php  if ($row["time_out_old"] != "0000-00-00 00:00:00") echo $row["time_out_old"];?> <?php echo $row["notes"];?></font></td>
         </tr>
         <?php
            }
            
         ?>
         <!-- For total row new code -->
         <?php
            $time = strtotime($start_date);
            
            if (date('l',$time) != "Tuesday") {
            
            	$st_tuesday = strtotime('last tuesday', $time);
            
            } else {
            
            	$st_tuesday = $time;
            
            }
            
            
            
            $st = strtotime($start_date);
            
			$ed = strtotime(strval($end_date));
            
            $st_monday = strtotime('+6 days', $st_tuesday);
            
            
            
            $overtime = 0; $overtime_production = 0;
            
            $regulartime = 0;
            
            while($st_tuesday < $ed)
            
            {
            
            	$query = "SELECT loop_timeclock.type, SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE  worker_id = " . $_REQUEST["worker"]  . " ";
            
            	if($_GET["start_date"] != "")
            
            	{
            
            	 $query .= " AND time_in BETWEEN '" . date('Y-m-d 00:00:00',$st_tuesday) . "'";
            
            	}
            
            	if($_GET["end_date"] != "")
            
            	{
            
            	 if ($st_monday < $ed) {
            
            	 $query .= " AND '" . date('Y-m-d 23:59:59',$st_monday) . "'";
            
            	 }
            
            	 else {
            
            		$query .= " AND '" . date('Y-m-d 23:59:59',$ed - 1) . "'";
            
            	 }
            
            	}
				
				db();
            	$res = db_query($query);
				
         
            
            	while($row = array_shift($res))
            
            	{
            
            
            
            		if (date('Y-m-d',$st_tuesday) < $start_date)
            
            		{
            
            			$fquery = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE  worker_id = " . $_REQUEST["worker"]  . " ";
            
        
            			$fquery .= " AND time_in BETWEEN '" . date('Y-m-d 00:00:00',$time) . "'";
            
						if ($st_monday < $ed) {
            
            			 $fquery .= " AND '" . date('Y-m-d 23:59:59',$st_monday) . "'";
            
            				 }
            
            			else {
            
            			$fquery .= " AND '" . date('Y-m-d 23:59:59',$ed - 1) . "'";
            
            			}
            
						db();
            
            			$fres = db_query($fquery);
            
            			$frow = array_shift($fres);
            
            			if (($row["DT"]/3600) > 40) 
            
            			{ 
            
            				$first_week_regular_time = $frow["DT"]/3600 - ($row["DT"]/3600 - 40);
            
            				if ($first_week_regular_time < 0) $first_week_regular_time = 0;
            
            				$first_week_overtime = ($row["DT"]/3600 - 40);
            
            			//	echo $first_week_overtime;
            
            				if ($first_week_overtime > $frow["DT"]/3600) $first_week_overtime = $frow["DT"]/3600;
            
            			} else
            
            			{
            
            				$first_week_regular_time = $frow["DT"]/3600;
            
            				$first_week_overtime = 0;
            
            			}
            
            
            
            			//echo date('m/d/Y',$time);
            
            		} else
            
            		{
            
            			//echo date('m/d/Y',$st_tuesday);	
            
            		}
            
            			//echo " - ";
            
            
            
            		if (date('Y-m-d',$st_monday) < $end_date)
            
            		{
            
            			//echo date('m/d/Y',$st_monday);
            
            		} else
            
            		{
            
            			//echo date('m/d/Y',$ed-1);	
            
            		}
            
            
            
            		if ($first_week == 1)
            
            		{
            
            				//echo number_format($first_week_regular_time,2);
            
            				$regulartime += $first_week_regular_time;
            
            		} else {
            
            				if (($row["DT"]/3600) > 40) { 
            
            					//echo number_format(40 ,2);
            
            					$regulartime += 40; 
            
            				} else { 
            
            					//echo number_format($row["DT"]/3600 ,2); 
            
            					$regulartime += number_format($row["DT"]/3600 ,2); 
            
            				}
            
            		}
            
            
            
            		if ($first_week == 1)
            
            		{
            
            			//echo number_format($first_week_overtime,2);
            
            			$overtime += $first_week_overtime;
            
            			if ($row["type"] == 'Production' || $row["type"] == 'kits' || $row["type"] == 'machines' ){
            
            				$overtime_production += $first_week_overtime;
            
            			}	
            
            		} else { 
            
            			if (($row["DT"]/3600) > 40) {
            
            				//echo number_format(($row["DT"]/3600)-40 ,2); 
            
							$overtime += (int)number_format($row["DT"]/3600,2) - 40; 
            
            				if ($row["type"] == 'Production' || $row["type"] == 'kits' || $row["type"] == 'machines' ){
            
            					$overtime_production += (int)number_format($row["DT"]/3600,2) - 40; 
            
            				}	
            
            			}
            
            				
            
            		}
            
            			$first_week = 0;
            
            
            
            			$production_val = $row["R"]*$row["P"];
            
            			
            
            			$tierIncresedVal =  number_format(($production_val * $row["tier_value"]), 2);
            
            			
            
            			if($tierIncresedVal == 'Invalid Tier Value'){
            
            				$grandTotal = number_format($production_val ,2);
            
            			}else{
            
							$grandTotal = number_format($production_val + floatval(str_replace(',', '', $tierIncresedVal)), 2);
            
            			}				
            
            
            
            			$pq     = "SELECT name, loop_workers.rate_cost AS RC, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))/3600 AS DT FROM loop_timeclock LEFT JOIN loop_workers ON loop_timeclock.worker_id = loop_workers.id WHERE (loop_timeclock.type LIKE '%Production' OR loop_timeclock.type LIKE '%kits' OR loop_timeclock.type LIKE '%achines') AND loop_timeclock.worker_id = " . $_REQUEST["worker"];
            
            			$pq .= " AND (time_in >= '" . $start_date1 . " 00:00:00' and time_in <= '" . $start_date1 . " 23:59:59') ";
            
            			db();
            
            			$pres       = db_query($pq);
            
            			$prow       = array_shift($pres);
            
            			$totalHours = $prow["DT"];
            
            			$hourlyRate = $prow["RC"];
            
            
            			$hourlyValue = ($totalHours * $hourlyRate);
            
            			//echo "bonus = " . $grandTotal . " - " . $hourlyValue . "<br>";
        
						$bonus =  floatval(str_replace(',', '', strval($grandTotal))) -  floatval(str_replace(',', '', strval($hourlyValue)));
            
            			$st_tuesday = strtotime('+7 days', $st_tuesday);
            
            			$st_monday = strtotime('+7 days', $st_monday);
            
            
            
            }
            
            	$reg_hrs=number_format($regulartime,2);
        
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $total_orders; ?>
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Total Hours
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo number_format($regulartime+$overtime,2); ?>  
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
         </tr>
      </table>
      <br/>
      <!-- For total row new code -->
      <table cellSpacing="1" cellPadding="3" width="950" border="0">
         <tr align="middle">
            <td colSpan="12" class="style7">
               PRODUCTION REPORT FOR: 
               <?php
                  $query = "SELECT * FROM `loop_workers` WHERE id = " . $_REQUEST["worker"] ;
				  
				  db();
                  $res = db_query($query);
                  
                  $row = array_shift($res);
                  
                  $name = $row["name"];
                  
                  echo "<b>".$row["name"]."</b>";
                  
                  ?>
            </td>
         </tr>
         <tr>
            <td class="style17">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               PRODUCTION DATE</font>
            </td>
            <td class="style17">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               ENTERED ON</font>
            </td>
            <td class="style17">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               RATE</font>
            </td>
            <td class="style5" >
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               PRODUCTION
            </td>
            <td align="middle" class="style5">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               SUBTOTAL
            </td>
            <td align="middle" class="style5">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               TIER INCREASE
            </td>
            <td align="middle" class="style5">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               GRAND TOTAL
            </td>
            <td align="middle" class="style5">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               TIER
            </td>
            <td align="middle" class="style5">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">NOTES
            </td>
         </tr>
         <?php
            $query = "SELECT *, DATE_FORMAT(date, '%W, %M %d, %Y') AS D, rate AS R, production AS P, added_by AS addedEmp, added_on AS recordDate FROM loop_timeclock_production WHERE worker_id = " . $_REQUEST["worker"] . " ";
            
            if($_GET["start_date"] != "")
            
            {
            
             $query .= " AND date BETWEEN '$start_date'";
            
            }
            
            if($_GET["end_date"] != "")
            
            {
            
             $query .= " AND '$end_date' ORDER BY date ASC";
            
            }
            
            db();
            
            $res = db_query($query);
            
            $production_total=0;
            
            while($row = array_shift($res))
            {
            
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
            
            
            
            	//$new_rate= $row["R"]*$emp_tier_value;
            
            	$production_val = $row["R"]*$row["P"];
            
            	
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["D"]; ?>
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php 
                  if($row['recordDate'] != ''){
                  
                  	echo date("m/d/Y H:i:s", strtotime($row['recordDate'])).' ('.$row['addedEmp'].')';
                  
                  }
                  
                  ?>
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               $<?php echo number_format($row["R"],2); ?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["P"]; ?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               $<?php echo number_format($production_val,2);?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               <?php               
                  $tierIncresedVal =  number_format(($production_val * $emp_tier_value), 2);
                  
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
            $production_total += str_replace(',', '', number_format($production_val,2));
            
            $bonusProTotal += $row["R"] * $row["P"];
            
              if($tierIncresedVal != 'Invalid Tier Value'){
            
                  $tierIncresedValTotal += $tierIncresedVal;
            
              }
            
              $grandTotalAll += str_replace(',', '', $grandTotal);
            
            }
            
            
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Total Production Value
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo "$".number_format($production_total,2); ?> 
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo "$".number_format($tierIncresedValTotal,2); ?>
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               <?php echo "$".number_format($grandTotalAll,2); ?>	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
         </tr>
      </table>
      <br><br>
      <table width="28%" cellpadding="4">
         <tr align="middle">
            <td colSpan="5" class="style7"><b>Hours by Type Report for: <?php echo $name;?></b></td>
         </tr>
         <tr vAlign="center">
            <td class="style17" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">Type</font></td>
            <td class="style17" style="height: 22px;" align="center" colspan="3"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Total Hours
            </td>
         </tr>
         <?php
            $tq = "SELECT DISTINCT(type) FROM loop_timeclock WHERE time_in BETWEEN '$start_date' AND '$end_date'";
            
            
			db();
            $tres = db_query($tq);
            
            while($trow = array_shift($tres))
            
            {
            
            
            
            $query = "SELECT type, SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE type LIKE '%" . $trow["type"] ."' AND worker_id = " . $_REQUEST["worker"]  . " ";
            
            if($_GET["start_date"] != "")
            
            {
            
             $query .= " AND time_in BETWEEN '$start_date'";
            
            }
            
            if($_GET["end_date"] != "")
            
            {
            
             $query .= " AND '$end_date'";
            
            }
            
			db();
            $res = db_query($query);
            
            while($row = array_shift($res))
            
            {
            
            	  if($trow["type"]==$row["type"])
            
            	  {
            
            		  
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $trow["type"];?>
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Total Hours
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["ADT"]; ?> 
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo number_format($row["DT"]/3600,2); ?>  
            </td>
         </tr>
         <?php 
            }
            
            }
            
            
            
            }
            
            ?>
      </table>
      <!------------- OVERTIME -------------------->
      <?php
         $time = strtotime($start_date);
         
         if (date('l',$time) != "Tuesday") {
         
         $st_tuesday = strtotime('last tuesday', $time);
         
         } else {
         
         $st_tuesday = $time;
         
         }
           
         $st = strtotime($start_date);
         
		 $ed = strtotime(strval($end_date));
         
         $st_monday = strtotime('+6 days', $st_tuesday);
        
         ?>
      <br><br>
      <table width="28%" cellpadding="4">
         <tr align="middle">
            <td colSpan="4" class="style7"><strong>Breakdown by Work Week Tues-Mon</strong><br><b><?php echo $name;?></b></td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Date Range
            </td>
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Regular Hours
            </td>
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Overtime Hours 
            </td>
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Bonus
            </td>
         </tr>
         <?php
            $overtime = 0;
            
            $regulartime = 0;
            
            while($st_tuesday < $ed)
            
            {
            
            $query = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE  worker_id = " . $_REQUEST["worker"]  . " ";
            
            if($_GET["start_date"] != "")
            
            {
            
             $query .= " AND time_in BETWEEN '" . date('Y-m-d 00:00:00',$st_tuesday) . "'";
            
            }
            
            if($_GET["end_date"] != "")
            
            {
            
             if ($st_monday < $ed) {
            
             $query .= " AND '" . date('Y-m-d 23:59:59',$st_monday) . "'";
            
             }
            
             else {
            
             $query .= " AND '" . date('Y-m-d 23:59:59',$ed - 1) . "'";
            
             }
            
            }
            
			db();
            $res = db_query($query);
            
            while($row = array_shift($res))
            
            {
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php
                  if (date('Y-m-d',$st_tuesday) < $start_date)
                  
                  {
                  
                  	//This is the first one. We also need to get the time from the start date to the end of the week
                  
                  	$fquery = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE  worker_id = " . $_REQUEST["worker"]  . " ";
                  
                  	
                  
                  	 $fquery .= " AND time_in BETWEEN '" . date('Y-m-d 00:00:00',$time) . "'";
                  
                  	
                  
                  		if ($st_monday < $ed) {
                  
                  	 $fquery .= " AND '" . date('Y-m-d 23:59:59',$st_monday) . "'";
                  
                  		 }
                  
                  	else {
                  
                  	$fquery .= " AND '" . date('Y-m-d 23:59:59',$ed - 1) . "'";
                  
                  	}
                  
				  db();
                  $fres = db_query($fquery);
                  
                  $frow = array_shift($fres);
                  
                  $first_week = 1;
                  
                  if (($row["DT"]/3600) > 40) 
                  
                  { 
                  
                  	$first_week_regular_time = $frow["DT"]/3600 - ($row["DT"]/3600 - 40);
                  
                  	if ($first_week_regular_time < 0) $first_week_regular_time = 0;
                  
                  	$first_week_overtime = ($row["DT"]/3600 - 40);
                  
                  //	echo $first_week_overtime;
                  
                  	if ($first_week_overtime > $frow["DT"]/3600) $first_week_overtime = $frow["DT"]/3600;
                  
                  //	echo $first_week_overtime;
                  
                  	//This is if there are more overtime hours for the entire week than hours in the pay pay period for the week.
                  
                  //	if ($first_week_overtime > ($row["DT"]/3600 - 40)) $first_week_overtime = ($row["DT"]/3600 - 40);
                  
                  //	echo $first_week_overtime;
                  
                  //	echo "-" . $first_week;
                  
                  } else
                  
                  {
                  
                  	$first_week_regular_time = $frow["DT"]/3600;
                  
                  	$first_week_overtime = 0;
                  
                  }
                  
                  
                  
                  	echo date('m/d/Y',$time);
                  
                  } else
                  
                  {
                  
                  	echo date('m/d/Y',$st_tuesday);	
                  
                  }
                  
                  	echo " - ";
                  
                  
                  
                  if (date('Y-m-d',$st_monday) < $end_date)
                  
                  {
                  
                  	echo date('m/d/Y',$st_monday);
                  
                  } else
                  
                  {
                  
                  	echo date('m/d/Y',$ed-1);	
                  
                  }
                  
                                    ?></font>
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align="right"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php
                  if ($first_week == 1)
                  
                  {
                  
                  echo number_format($first_week_regular_time,2);
                  
                  $regulartime += $first_week_regular_time;
                  
                  } else {
                  
                  if (($row["DT"]/3600) > 40) { echo number_format(40 ,2); $regulartime += 40; } else { echo number_format($row["DT"]/3600 ,2); $regulartime += number_format($row["DT"]/3600 ,2); }
                  
                  }
                  
                  ?>  
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php
                  if ($first_week == 1)
                  
                  {
                  
                  echo number_format($first_week_overtime,2);
                  
                  $overtime += $first_week_overtime;
                  
                  } else { 
                  
					if (($row["DT"]/3600) > 40) { echo number_format((float)($row["DT"]/3600)-40 ,2); $overtime += number_format($row["DT"]/3600,2) - 40; }
                  
                  		
                  
                  }
                  
                  $first_week = 0;
                  
                  ?> 
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
         </tr>
         <?php 
            }
            
            $st_tuesday = strtotime('+7 days', $st_tuesday);
            
            $st_monday = strtotime('+7 days', $st_monday);
            
            }
            
            $reg_hrs=number_format($regulartime,2);
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px; border-top: 1px solid black;" align="right"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               TOTAL
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo number_format($regulartime,2); ?>  
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;border-top: 1px solid black;" align="right"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo number_format($overtime,2); ?>  
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;border-top: 1px solid black;" align="right"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php 
                  $pq = "SELECT name, loop_workers.rate_cost AS RC, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))/3600 AS DT FROM loop_timeclock LEFT JOIN loop_workers ON loop_timeclock.worker_id = loop_workers.id 
                  
                  WHERE (loop_timeclock.type LIKE '%Production' OR loop_timeclock.type LIKE '%kits' OR loop_timeclock.type LIKE '%achines') AND loop_timeclock.worker_id = " . $_REQUEST["worker"];
                  
                  if($_GET["start_date"] != "qqq")
                  
                  {
                  
                   $pq .= " AND time_in BETWEEN '" . $start_date . "'";
                  
                  }
                  
                  if($_GET["end_date"] != "qqqq")
                  
                  {
                  
                   $pq .= " AND '" . $end_date . "'";
                  
                  }

                  db();
                  $pres = db_query($pq);
                  
                  $prow = array_shift($pres);
                  
                  $name = $prow["name"];
                  
                  $hours = $prow["DT"];
                  
                  $production_hours = $hours;
                  
                  
                  $query = "SELECT SUM( rate * production) AS P FROM loop_timeclock_production WHERE worker_id =  " . $_REQUEST["worker"];
                  
                  if($_GET["start_date"] != "q")
                  
                  {
                  
                   $query .= " AND date BETWEEN '" . $dt . "'";
                  
                  }
                  
                  if($_GET["end_date"] != "q")
                  
                  {
                  
                   $query .= " AND NOW()";
                  
                  }
                  
				  db();
                  $pres = db_query($query);
                  
                  $prow2 = array_shift($pres);
                  
                  
                  
                  			if (($prow["DT"] * $prow["RC"]) > 0 )
                  
                  			{ 	$efficiency = 100*$prow2["P"]/($prow["DT"] * $prow["RC"]); }
                  
                  			else{	$efficiency = 0; }
                  
                  			
                  
                  			$production_value = str_replace( ',', '', number_format((str_replace( ',', '', number_format($prow["DT"],2)) * $prow["RC"]),2));				
                  
							$production_bonus = str_replace(',', '', $grandTotalAll) - floatval(str_replace(',', '', number_format((str_replace(',', '', number_format($prow["DT"], 2)) * $prow["RC"]), 2)));
                  
                  		
                  			if ($production_bonus < 0){
                  
                  				echo "$0.00";
                  
                  				$production_bonus = 0;
                  
                  			}else{
                  
                  				echo "$" . number_format($production_bonus,2);
                  
                  			}			
                  
                  		?>  
            </td>
         </tr>
      </table>
      <br><br>
      <?php
        
         $query = "SELECT * FROM loop_timeclock_bonus WHERE worker_id =  " . $_REQUEST["worker"] . " AND date BETWEEN '" . $start_date . "' AND '" . $end_date_bonus  . "'";
						
		 db();
         $res = db_query($query);
         
                 if(tep_db_num_rows($res)>0)
         
                 {
         
         
         
         ?>
      <table width=28% cellpadding="4">
         <tr align="middle">
            <td colSpan="4" class="style7"><b>Other Bonus Report</b></td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Date
            </td>
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Amount
            </td>
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Notes
            </td>
         </tr>
         <?php
            while ($brow = array_shift($res))
            
            {
            
            	$other_bonus = $other_bonus + $brow["amount"];
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo timestamp_to_date($brow["date"]);?>
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               $<?php echo number_format($brow["amount"],2);?>
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $brow["notes"];?>
            </td>
			</tr>
         <?php } ?>
      </table>
      <?php // $query; 
         }
         
         
         
         if ($bonus >= 0){
         
         $final_total_bonus = $other_bonus + $bonus;
         
         }else{
         
         $final_total_bonus = $other_bonus;
         
         }	
         
         
         
         ?>
      
      <?
         ?>
      <?
         } // end if != -1 (single person
         
 }
 else {
         
         	//To display the details when ALL option is selected
         
         	$start_date = date('Y-m-d', $start_date);
         
         	$end_date = date('Y-m-d', $end_date + 86400);
         
         
         
         	if ($start_date > $end_date) {
         
         	echo "<font size=20>Nice Try, David - You thought I would not catch an error where the start date comes after the end date.</font>";
         
         	}
         
         
         
         	?>
      <table border="0" cellspacing="1" cellpadding="2" >
         <tr>
            <td class="header_td_style">Warehouse name</td>
            <?php	
               $type_q = "SELECT DISTINCT(type) as typenm FROM loop_timeclock where type!='' order by type";
		
			   db();
               $type_res = db_query($type_q);
               
               while($type_row = array_shift($type_res))
               
               {
               
               	?> 
            <td class="header_td_style"><?php echo $type_row["typenm"]; ?></td>
            <?php  }	?>
         </tr>
         <?php
            if($start_date !="" && $end_date!="")
            
            {
            
            	//$type = "";	
            
            
            
            	$tq1 = "SELECT warehouse_id,warehouse_name FROM loop_timeclock inner join loop_warehouse on loop_timeclock.warehouse_id=loop_warehouse.id group by warehouse_id";
				
				db();
            	$tres1 = db_query($tq1);
            
            	while($trow1 = array_shift($tres1))
            
            	{
            
            ?>
         <tr vAlign="center">
            <td bgcolor="#E4EAEB" class="style3" style="height: 22px;">
               <?php echo $trow1['warehouse_name'];?>
            </td>
            <?php
               $type_q = "SELECT DISTINCT(type) as typenm FROM loop_timeclock where type!='' order by type";
               
			   db();
               $type_res = db_query($type_q);
               
               while($type_row = array_shift($type_res))
               
               {
               
               	$type_str = "'".$type_row['typenm']."'";
               
               
               
               	$query = "SELECT warehouse_id, type, SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock WHERE type = " . $type_str . " AND warehouse_id = ".$trow1['warehouse_id']."";
               
               	if($_GET["start_date"] != "")
               
               	{
               
               	 $query .= " AND time_in BETWEEN '$start_date'";
               
               	}
               
               	if($_GET["end_date"] != "")
               
               	{
               
               	 $query .= " AND '$end_date' group by type";
               
               	}
               
               
				db();
               	$res = db_query($query);
               
               	$rec_found = "no";
               
               	while($row = array_shift($res))
               
               	{
               
               		$rec_found = "yes";
               
               ?>
            <td bgcolor="#E4EAEB" class="style3" style="height: 22px;" align=right>
               <?php echo $row["ADT"]; ?> 
            </td>
            <?php } 
               if ($rec_found == "no") { ?>
            <td bgcolor="#E4EAEB" class="style3" style="height: 22px;" align=right>&nbsp;</td>
            <?php	}  ?>
            <?php
               } ?>
         </tr>
         <?php } ?>
         <tr>
            <td  bgcolor="#E4EAEB" style="font-size:8pt; font-weight:bold; height: 22px;">Total</td>
            <?php	
               $type_q = "SELECT DISTINCT(type) as typenm FROM loop_timeclock where type!='' order by type";
			   
			   db();
               $type_res = db_query($type_q);
               
               while($type_row = array_shift($type_res))
               
               {
               
               	$type_str = "'".$type_row['typenm']."'";
               
               
               
               	$query = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock WHERE type = " . $type_str ;
               
               	if($_GET["start_date"] != "")
               
               	{
               
               	 $query .= " AND time_in BETWEEN '$start_date'";
               
               	}
               
               	if($_GET["end_date"] != "")
               
               	{
               
               	 $query .= " AND '$end_date' group by type";
               
               	}
               
               
				db();
               	$res = db_query($query);
               
               	while($row = array_shift($res))
               
               	{
               
               ?>
            <td bgcolor="#E4EAEB" style="font-size:8pt; font-weight:bold; height: 22px;" align=right>
               <?php echo $row["ADT"]; ?>
            </td>
            <?php } 
               }	?>
         </tr>
         <?php }?>
      </table>
      <?php
         }
         
         ?>
      <?php
         }
         
            $rate = number_format($rate,2);
         
            $ovt=number_format($overtime,2);
         
            //echo $reg_hrs."-".$rate.number_format($overtime,2);;
         
            //
         
            $reg_hrs_n=str_replace(",", "", $reg_hrs);
         
            $ovt_n=str_replace(",", "", $ovt);
         
			$base_pay = floatval($reg_hrs_n) * floatval($rate) + (floatval($ovt_n) * 1.5 * floatval($rate));
         $final_pay_check = $base_pay + floatval($production_bonus) + floatval($other_bonus);
         
         ?>
      <br>
      <table width="28%" cellpadding="4">
         <tr vAlign="center">
            <td class="style7" style="height: 22px;" align="center" colspan="2">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><b>Production Bonus Calculation</b></font>
            </td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" align="left" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Hourly Rate
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               $<?php echo $rate;?>
            </td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" align="left" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Total Regular Hours (Production + Kits + Machines)
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo number_format($production_hours,2);?>
            </td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" align="left" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Hourly Value of Production
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                $<?php echo number_format($production_value,2);?>
            </td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" align="left" style="height: 22px;border-bottom: 1px solid black;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Production Value
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;border-bottom: 1px solid black;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php $grandTotalAll = floatval($grandTotalAll);
               $grandTotalAllFormatted = number_format($grandTotalAll, 2);
               echo "$".$grandTotalAllFormatted;?>
            </td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" align="left" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <b>Difference</b>
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               $<?php echo number_format($grandTotalAll-$production_value,2);?>
            </td>
         </tr>
      </table>
      <br>
      <table width="28%" cellpadding="4">
         <tr vAlign="center">
            <td class="style7" style="height: 22px;border-bottom: 1px solid black;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><b>Hourly Pay</b></font></td>
            <td class="style7" style="height: 22px;border-bottom: 1px solid black;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><b>Production Bonus</b></td>
            <td class="style7" style="height: 22px;border-bottom: 1px solid black;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><b>Other Bonus</b></td>
            <td class="style7" style="height: 22px;border-bottom: 1px solid black;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><b>Total Pay</b></td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <b>$<?php echo number_format($base_pay,2);?></b>
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <b>$<?php echo number_format(floatval($production_bonus),2);?></b>
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <b>$<?php echo number_format($other_bonus,2);?></b>
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <b>$<?php echo number_format($final_pay_check,2);?></b>
            </td>
         </tr>
      </table>
      <?php
         } // end if "run"
         
                                                                                          
         
         ?>
      <br>
      <?php  
         ?>
      <br><br>
   </body>
</html>
<?php
   require ("inc/header_session.php");
   require ("mainfunctions/database.php");
   require ("mainfunctions/general-functions.php");
?>
<!DOCTYPE html>
<html>
   <head>
      <title>Employee Public Timeclock & Production Summary Report</title>
      <style type="text/css">
         .header_td_style
         {
         font-family:arial;
         font-size:12;
         height: 16px; 
         background:#ABC5DF;
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
         .table_margin{
         padding-right: 10px;
         }
      </style>
      <script type="text/javascript"> 
         function checkdate()
         
         {
         
         	if (document.getElementById("new_time_in").value == "") {
         
         		alert("Please enter the New Time In.");
         
         		return false;
         
         	}
         
         	
         
         	if (document.getElementById("new_time_out").value == "") {
         
         		alert("Please enter the New Time Out.");
         
         		return false;
         
         	}
         
         	
         
         	if (document.getElementById("new_time_in").value > document.getElementById("new_time_out").value) {
         
         		alert("New Time In > New Time out, please check.");
         
         		return false;
         
         	}
         
         	
         
         	document.rptSearch2.submit();
         
         }
         
         
         
         function chkssn(){
         
         	if (document.getElementById('ssn_txt').value.trim() == ""){
         
         		alert("Please enter the last four digit of your SSN.");
         
         		return false;
         
         	}else {
         
         		return true;
         
         	}
         
         }
         
         
         
      </script>
      <LINK rel='stylesheet' type='text/css' href='one_style.css' >
      <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
      <link rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>
   </head>
   <body>
      <?php include("inc/header.php"); ?>
      <div class="main_data_css">
      <div class="dashboard_heading" style="float: left;">
         <div style="float: left;">
            Employee Public Timeclock & Production Summary Report 
            <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
               <span class="tooltiptext">
               This report shows the user the summary of the timeclock and production within a provided time period for a specific employee.
               </span>
            </div>
            <div style="height: 13px;">&nbsp;</div>
         </div>
      </div>
      <form name="rptSearch" action="" method="GET" onsubmit="return chkssn();">
         <input type="hidden" name="action" value="run">
         <br /><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
         Find 
         <select name="worker">
            <option>Please Select</option>
            <option value=-1>ALL</option>
            <?php
               $total_production = 0; $total_production_val = 0; 
               
               $sql3 = "SELECT * FROM loop_workers ORDER BY active DESC, name ASC";
               
			   db();
               $result3 = db_query($sql3);
               
               while ($myrowsel3 = array_shift($result3)) {
               
               ?>
            <option value="<?php echo $myrowsel3["id"]; ?>" <?php if ($myrowsel3["id"]==$_REQUEST["worker"]) echo "selected"; ?>><?php echo $myrowsel3["name"]; ?></option>
            <?php } ?>
         </select>
         <script language="JavaScript" src="inc/CalendarPopup.js"></SCRIPT>
         <script language="JavaScript">document.write(getCalendarStyles());</script>
         <script language="JavaScript">
            var cal1xx = new CalendarPopup("listdiv");
            
            cal1xx.showNavigationDropdowns();
            
            var cal2xx = new CalendarPopup("listdiv");
            
            cal2xx.showNavigationDropdowns();
            
         </script>
         <?php
            $start_date = isset($_GET["start_date"])?strtotime($_GET["start_date"]):strtotime(date('m/d/Y'));
            
            $end_date = isset($_GET["end_date"])?strtotime($_GET["end_date"]):strtotime(date('m/d/Y'));
            
			$first_week = 1; // Moved to new position - Siddhesh
			$first_week_regular_time = ""; // Moved to new position - Siddhesh
			$first_week_overtime = ""; // Moved to new position - Siddhesh
			$start_date1 = ""; // Moved to new position - Siddhesh
			$total_orders = ""; // Moved to new position - Siddhesh
			$bonusProTotal = ""; // Moved to new position - Siddhesh
			$tierIncresedValTotal = ""; // Moved to new position - Siddhesh
			$grandTotalAll = ""; // Moved to new position - Siddhesh
			$production_value = 0; // Moved to new position - Siddhesh
			$production_bonus = ""; // Moved to new position - Siddhesh
			$other_bonus = 0; // Moved to new position - Siddhesh
			$reg_hrs = 0; // Moved to new position - Siddhesh
			$overtime = 0;  // Moved to new position - Siddhesh
			$rate = 0; // Moved to new position - Siddhesh
			$production_hours = 0; // Moved to new position - Siddhesh
			$dt = ""; // Moved to new position - Siddhesh
			$st_monday = ""; //Moved to new position - Siddhesh
			$bonus = ""; //Moved to new position - Siddhesh

		?>
         <font face="Arial, Helvetica, sans-serif" color="#333333" size="1"> from: <input type="text" name="start_date" size="11" value="<?php echo (isset($_GET["start_date"]) && $_GET["start_date"] != "")?date('m/d/Y', $start_date):""?>"> <a href="#" onclick="cal1xx.select(document.rptSearch.start_date,'anchor1xx','MM/dd/yyyy'); return false;" name="anchor1xx" id="anchor1xx"><img border="0" src="images/calendar.jpg"></a> <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">to: <input type="text" name="end_date" size="11" value="<?php echo (isset($_GET["end_date"]) && $_GET["start_date"] != "")?date('m/d/Y', $end_date):""?>"> <a href="#" onclick="cal1xx.select(document.rptSearch.end_date,'anchor2xx','MM/dd/yyyy'); return false;" name="anchor2xx" id="anchor2xx"><img border="0" src="images/calendar.jpg"></a>
         &nbsp;SSN (last 4 digit): <input type="password" name="ssn_txt" id="ssn_txt" value="">
         &nbsp; <input type="submit" value="Search">
      </form>
      <div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>
      <br><br>
      <?php
         if ($_GET["action"] == 'run') {
         
         	$rec_bypass = "no";
         
         	$sql_chk = "select user_pwd from loop_workers where id = " . $_REQUEST["worker"];
			
			db();
         	$result_chk = db_query($sql_chk);
         
         	$rec_found = "notfound";
         
         	$emp_login_msg = "<font color=red><b>Entered last four digit of your SSN is not matching, please check.</b></font>";
         
         	while($row_chk = array_shift($result_chk)){
         
         		$rec_found = "found";
         
         		if ($row_chk["user_pwd"] != "0") {
         
         			if ($row_chk["user_pwd"] != $_REQUEST["ssn_txt"]) {
         
         				$rec_bypass = "err";
         
         				$emp_login_msg = "<font color=red><b>Entered last four digit of your SSN is not matching, please check.</b></font>";
         
         			}else{
         
         				$emp_login_msg = "";
         
         			}
         
         		}else{
         
         			$rec_bypass = "err";
         
         			$emp_login_msg = "<font color=red><b>SSN not updated in the master, please check.</b></font>";
         
         		}
         
         	}
         
         	if ($rec_bypass == "err"){
         
         		$sql_chk = "select variablevalue from tblvariable where variablename = 'master_pin'";
				
				db();
         		$result_chk = db_query($sql_chk);
         
         		while($row_chk = array_shift($result_chk)){
         
         			if ($row_chk["variablevalue"] != $_REQUEST["ssn_txt"]){
         
         				$rec_bypass = "err";
         
         				$emp_login_msg = "<font color=red><b>Entered last four digit of your SSN is not matching, please check.</b></font>";
         
         			}else{
         
         				$emp_login_msg = "";
         
         				$rec_bypass = "no";
         
         			}
         
         
         
         		}
         
         		echo $emp_login_msg;
         
         	}
         
         	
         
         	if ($rec_bypass != "err"){
         
         
         
         		if ($_GET["delete"] == 'true') {
					db();
         			$res = db_query("DELETE FROM loop_timeclock_bonus WHERE id = " . $_REQUEST["id"]);
         
         		}
         
         		if ($_REQUEST["worker"] != -1)
         
         		{
         
         			$start_date = date('Y-m-d', $start_date);
         
         			$end_date_bonus = date('Y-m-d', $end_date);
         
         			$end_date = date('Y-m-d', $end_date + 86400);
         
					$end_date = strtotime($end_date);
					$end_date_ot = date('Y-m-d', $end_date);
         
         			if ($start_date > $end_date) {
         
         			echo "<font size=20>Nice Try, David - You thought I would not catch an error where the start date comes after the end date.</font>";
         
         		}
         
         
         
         		?>
     
      <?php
         $time = strtotime($start_date);
         
         $st_tuesday = strtotime('last tuesday', $time);
         
         $st_monday = strtotime('+6 days', $st_tuesday);
         
         ?>
      <table cellSpacing="1" cellPadding="3" width="800" border="0">
         <tr align="middle">
            <td colSpan="11" class="style7">
               TIMECLOCK REPORT FOR: 
               <?php
                  $query = "SELECT * FROM `loop_workers` WHERE id = " . $_REQUEST["worker"] ;
				
				  db();
                  $res = db_query($query);
                  
                  $row = array_shift($res);
                  
                  $name = $row["name"];
                  
                  $rate = $row["rate_cost"];
                  
                  echo "<b>".$row["name"]."</b>";
                  
                  ?>
            </td>
         </tr>
         <tr>
            <td class="style17" align="center">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               DATE</font>
            </td>
            <td class="style17" align="center">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               TIME IN</font>
            </td>
            <td class="style5" align="center">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               TIME OUT
            </td>
            <td align="middle" class="style16" align="center">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               AMOUNT
            </td>
            <td valign="middle" class="style16" align="center">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               TYPE
            </td>
            <td align="center" class="style16">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               IP CLOCK-IN
            </td>
            <td align="center" class="style16">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               IP CLOCK-OUT
            </td>
            <td align="center" class="style16">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               NOTES
            </td>
         </tr>
         <?php
            $query = "SELECT *, IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)) AS A, DATE_FORMAT(time_in, '%W, %M %d, %Y') AS D, TIME(time_in) AS T_I, TIME(time_out) AS T_O FROM loop_timeclock WHERE worker_id = " . $_REQUEST["worker"] . " ";
            
            if($_GET["start_date"] != "")
            
            {
            
             $query .= " AND time_in BETWEEN '$start_date'";
            
            }
            
            if($_GET["end_date"] != "")
            
            {
            
             $query .= " AND '$end_date'";
            
            }
            
            $query .= " order by time_in";
            
            db();
            $res = db_query($query);
            
            while($row = array_shift($res))
            
            {
            
            
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["D"]; ?>
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["T_I"]; ?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["T_O"]; ?>
            </td>
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
               <?php echo $row["A"]; ?>
            </td>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["type"];?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["ipaddress"];?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["ipaddress_clkout"];?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=left><font size=1><?php if ($row["time_in_old"] != "0000-00-00 00:00:00") echo $row["time_in_old"];?> <?php  if ($row["time_out_old"] != "0000-00-00 00:00:00") echo $row["time_out_old"];?> <?php echo $row["notes"];?></font></td>
         </tr>
         <?php
            }
            
         ?>
         <!-- For total row new code -->
         <?php
            $time = strtotime($start_date);
            
            if (date('l',$time) != "Tuesday") {
            
            	$st_tuesday = strtotime('last tuesday', $time);
            
            } else {
            
            	$st_tuesday = $time;
            
            }
            
            
            
            $st = strtotime($start_date);
            
			$ed = strtotime(strval($end_date));
            
            $st_monday = strtotime('+6 days', $st_tuesday);
            
            
            
            $overtime = 0; $overtime_production = 0;
            
            $regulartime = 0;
            
            while($st_tuesday < $ed)
            
            {
            
            	$query = "SELECT loop_timeclock.type, SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE  worker_id = " . $_REQUEST["worker"]  . " ";
            
            	if($_GET["start_date"] != "")
            
            	{
            
            	 $query .= " AND time_in BETWEEN '" . date('Y-m-d 00:00:00',$st_tuesday) . "'";
            
            	}
            
            	if($_GET["end_date"] != "")
            
            	{
            
            	 if ($st_monday < $ed) {
            
            	 $query .= " AND '" . date('Y-m-d 23:59:59',$st_monday) . "'";
            
            	 }
            
            	 else {
            
            		$query .= " AND '" . date('Y-m-d 23:59:59',$ed - 1) . "'";
            
            	 }
            
            	}
				
				db();
            	$res = db_query($query);
				
         
            
            	while($row = array_shift($res))
            
            	{
            
            
            
            		if (date('Y-m-d',$st_tuesday) < $start_date)
            
            		{
            
            			$fquery = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE  worker_id = " . $_REQUEST["worker"]  . " ";
            
        
            			$fquery .= " AND time_in BETWEEN '" . date('Y-m-d 00:00:00',$time) . "'";
            
						if ($st_monday < $ed) {
            
            			 $fquery .= " AND '" . date('Y-m-d 23:59:59',$st_monday) . "'";
            
            				 }
            
            			else {
            
            			$fquery .= " AND '" . date('Y-m-d 23:59:59',$ed - 1) . "'";
            
            			}
            
						db();
            
            			$fres = db_query($fquery);
            
            			$frow = array_shift($fres);
            
            			if (($row["DT"]/3600) > 40) 
            
            			{ 
            
            				$first_week_regular_time = $frow["DT"]/3600 - ($row["DT"]/3600 - 40);
            
            				if ($first_week_regular_time < 0) $first_week_regular_time = 0;
            
            				$first_week_overtime = ($row["DT"]/3600 - 40);
            
            			//	echo $first_week_overtime;
            
            				if ($first_week_overtime > $frow["DT"]/3600) $first_week_overtime = $frow["DT"]/3600;
            
            			} else
            
            			{
            
            				$first_week_regular_time = $frow["DT"]/3600;
            
            				$first_week_overtime = 0;
            
            			}
            
            
            
            			//echo date('m/d/Y',$time);
            
            		} else
            
            		{
            
            			//echo date('m/d/Y',$st_tuesday);	
            
            		}
            
            			//echo " - ";
            
            
            
            		if (date('Y-m-d',$st_monday) < $end_date)
            
            		{
            
            			//echo date('m/d/Y',$st_monday);
            
            		} else
            
            		{
            
            			//echo date('m/d/Y',$ed-1);	
            
            		}
            
            
            
            		if ($first_week == 1)
            
            		{
            
            				//echo number_format($first_week_regular_time,2);
            
            				$regulartime += $first_week_regular_time;
            
            		} else {
            
            				if (($row["DT"]/3600) > 40) { 
            
            					//echo number_format(40 ,2);
            
            					$regulartime += 40; 
            
            				} else { 
            
            					//echo number_format($row["DT"]/3600 ,2); 
            
            					$regulartime += number_format($row["DT"]/3600 ,2); 
            
            				}
            
            		}
            
            
            
            		if ($first_week == 1)
            
            		{
            
            			//echo number_format($first_week_overtime,2);
            
            			$overtime += $first_week_overtime;
            
            			if ($row["type"] == 'Production' || $row["type"] == 'kits' || $row["type"] == 'machines' ){
            
            				$overtime_production += $first_week_overtime;
            
            			}	
            
            		} else { 
            
            			if (($row["DT"]/3600) > 40) {
            
            				//echo number_format(($row["DT"]/3600)-40 ,2); 
            
							$overtime += (int)number_format($row["DT"]/3600,2) - 40; 
            
            				if ($row["type"] == 'Production' || $row["type"] == 'kits' || $row["type"] == 'machines' ){
            
            					$overtime_production += (int)number_format($row["DT"]/3600,2) - 40; 
            
            				}	
            
            			}
            
            				
            
            		}
            
            			$first_week = 0;
            
            
            
            			$production_val = $row["R"]*$row["P"];
            
            			
            
            			$tierIncresedVal =  number_format(($production_val * $row["tier_value"]), 2);
            
            			
            
            			if($tierIncresedVal == 'Invalid Tier Value'){
            
            				$grandTotal = number_format($production_val ,2);
            
            			}else{
            
							$grandTotal = number_format($production_val + floatval(str_replace(',', '', $tierIncresedVal)), 2);
            
            			}				
            
            
            
            			$pq     = "SELECT name, loop_workers.rate_cost AS RC, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))/3600 AS DT FROM loop_timeclock LEFT JOIN loop_workers ON loop_timeclock.worker_id = loop_workers.id WHERE (loop_timeclock.type LIKE '%Production' OR loop_timeclock.type LIKE '%kits' OR loop_timeclock.type LIKE '%achines') AND loop_timeclock.worker_id = " . $_REQUEST["worker"];
            
            			$pq .= " AND (time_in >= '" . $start_date1 . " 00:00:00' and time_in <= '" . $start_date1 . " 23:59:59') ";
            
            			db();
            
            			$pres       = db_query($pq);
            
            			$prow       = array_shift($pres);
            
            			$totalHours = $prow["DT"];
            
            			$hourlyRate = $prow["RC"];
            
            
            			$hourlyValue = ($totalHours * $hourlyRate);
            
            			//echo "bonus = " . $grandTotal . " - " . $hourlyValue . "<br>";
        
						$bonus =  floatval(str_replace(',', '', strval($grandTotal))) -  floatval(str_replace(',', '', strval($hourlyValue)));
            
            			$st_tuesday = strtotime('+7 days', $st_tuesday);
            
            			$st_monday = strtotime('+7 days', $st_monday);
            
            
            
            }
            
            	$reg_hrs=number_format($regulartime,2);
        
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $total_orders; ?>
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Total Hours
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo number_format($regulartime+$overtime,2); ?>  
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
         </tr>
      </table>
      <br/>
      <!-- For total row new code -->
      <table cellSpacing="1" cellPadding="3" width="950" border="0">
         <tr align="middle">
            <td colSpan="12" class="style7">
               PRODUCTION REPORT FOR: 
               <?php
                  $query = "SELECT * FROM `loop_workers` WHERE id = " . $_REQUEST["worker"] ;
				  
				  db();
                  $res = db_query($query);
                  
                  $row = array_shift($res);
                  
                  $name = $row["name"];
                  
                  echo "<b>".$row["name"]."</b>";
                  
                  ?>
            </td>
         </tr>
         <tr>
            <td class="style17">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               PRODUCTION DATE</font>
            </td>
            <td class="style17">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               ENTERED ON</font>
            </td>
            <td class="style17">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               RATE</font>
            </td>
            <td class="style5" >
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               PRODUCTION
            </td>
            <td align="middle" class="style5">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               SUBTOTAL
            </td>
            <td align="middle" class="style5">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               TIER INCREASE
            </td>
            <td align="middle" class="style5">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               GRAND TOTAL
            </td>
            <td align="middle" class="style5">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               TIER
            </td>
            <td align="middle" class="style5">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">NOTES
            </td>
         </tr>
         <?php
            $query = "SELECT *, DATE_FORMAT(date, '%W, %M %d, %Y') AS D, rate AS R, production AS P, added_by AS addedEmp, added_on AS recordDate FROM loop_timeclock_production WHERE worker_id = " . $_REQUEST["worker"] . " ";
            
            if($_GET["start_date"] != "")
            
            {
            
             $query .= " AND date BETWEEN '$start_date'";
            
            }
            
            if($_GET["end_date"] != "")
            
            {
            
             $query .= " AND '$end_date' ORDER BY date ASC";
            
            }
            
            db();
            
            $res = db_query($query);
            
            $production_total=0;
            
            while($row = array_shift($res))
            {
            
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
            
            
            
            	//$new_rate= $row["R"]*$emp_tier_value;
            
            	$production_val = $row["R"]*$row["P"];
            
            	
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["D"]; ?>
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php 
                  if($row['recordDate'] != ''){
                  
                  	echo date("m/d/Y H:i:s", strtotime($row['recordDate'])).' ('.$row['addedEmp'].')';
                  
                  }
                  
                  ?>
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               $<?php echo number_format($row["R"],2); ?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["P"]; ?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               $<?php echo number_format($production_val,2);?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               <?php               
                  $tierIncresedVal =  number_format(($production_val * $emp_tier_value), 2);
                  
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
            $production_total += str_replace(',', '', number_format($production_val,2));
            
            $bonusProTotal += $row["R"] * $row["P"];
            
              if($tierIncresedVal != 'Invalid Tier Value'){
            
                  $tierIncresedValTotal += $tierIncresedVal;
            
              }
            
              $grandTotalAll += str_replace(',', '', $grandTotal);
            
            }
            
            
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Total Production Value
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo "$".number_format($production_total,2); ?> 
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo "$".number_format($tierIncresedValTotal,2); ?>
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               <?php echo "$".number_format($grandTotalAll,2); ?>	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
         </tr>
      </table>
      <br><br>
      <table width="28%" cellpadding="4">
         <tr align="middle">
            <td colSpan="5" class="style7"><b>Hours by Type Report for: <?php echo $name;?></b></td>
         </tr>
         <tr vAlign="center">
            <td class="style17" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">Type</font></td>
            <td class="style17" style="height: 22px;" align="center" colspan="3"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Total Hours
            </td>
         </tr>
         <?php
            $tq = "SELECT DISTINCT(type) FROM loop_timeclock WHERE time_in BETWEEN '$start_date' AND '$end_date'";
            
            
			db();
            $tres = db_query($tq);
            
            while($trow = array_shift($tres))
            
            {
            
            
            
            $query = "SELECT type, SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE type LIKE '%" . $trow["type"] ."' AND worker_id = " . $_REQUEST["worker"]  . " ";
            
            if($_GET["start_date"] != "")
            
            {
            
             $query .= " AND time_in BETWEEN '$start_date'";
            
            }
            
            if($_GET["end_date"] != "")
            
            {
            
             $query .= " AND '$end_date'";
            
            }
            
			db();
            $res = db_query($query);
            
            while($row = array_shift($res))
            
            {
            
            	  if($trow["type"]==$row["type"])
            
            	  {
            
            		  
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $trow["type"];?>
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Total Hours
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["ADT"]; ?> 
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo number_format($row["DT"]/3600,2); ?>  
            </td>
         </tr>
         <?php 
            }
            
            }
            
            
            
            }
            
            ?>
      </table>
      <!------------- OVERTIME -------------------->
      <?php
         $time = strtotime($start_date);
         
         if (date('l',$time) != "Tuesday") {
         
         $st_tuesday = strtotime('last tuesday', $time);
         
         } else {
         
         $st_tuesday = $time;
         
         }
           
         $st = strtotime($start_date);
         
		 $ed = strtotime(strval($end_date));
         
         $st_monday = strtotime('+6 days', $st_tuesday);
        
         ?>
      <br><br>
      <table width="28%" cellpadding="4">
         <tr align="middle">
            <td colSpan="4" class="style7"><strong>Breakdown by Work Week Tues-Mon</strong><br><b><?php echo $name;?></b></td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Date Range
            </td>
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Regular Hours
            </td>
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Overtime Hours 
            </td>
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Bonus
            </td>
         </tr>
         <?php
            $overtime = 0;
            
            $regulartime = 0;
            
            while($st_tuesday < $ed)
            
            {
            
            $query = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE  worker_id = " . $_REQUEST["worker"]  . " ";
            
            if($_GET["start_date"] != "")
            
            {
            
             $query .= " AND time_in BETWEEN '" . date('Y-m-d 00:00:00',$st_tuesday) . "'";
            
            }
            
            if($_GET["end_date"] != "")
            
            {
            
             if ($st_monday < $ed) {
            
             $query .= " AND '" . date('Y-m-d 23:59:59',$st_monday) . "'";
            
             }
            
             else {
            
             $query .= " AND '" . date('Y-m-d 23:59:59',$ed - 1) . "'";
            
             }
            
            }
            
			db();
            $res = db_query($query);
            
            while($row = array_shift($res))
            
            {
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php
                  if (date('Y-m-d',$st_tuesday) < $start_date)
                  
                  {
                  
                  	//This is the first one. We also need to get the time from the start date to the end of the week
                  
                  	$fquery = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE  worker_id = " . $_REQUEST["worker"]  . " ";
                  
                  	
                  
                  	 $fquery .= " AND time_in BETWEEN '" . date('Y-m-d 00:00:00',$time) . "'";
                  
                  	
                  
                  		if ($st_monday < $ed) {
                  
                  	 $fquery .= " AND '" . date('Y-m-d 23:59:59',$st_monday) . "'";
                  
                  		 }
                  
                  	else {
                  
                  	$fquery .= " AND '" . date('Y-m-d 23:59:59',$ed - 1) . "'";
                  
                  	}
                  
				  db();
                  $fres = db_query($fquery);
                  
                  $frow = array_shift($fres);
                  
                  $first_week = 1;
                  
                  if (($row["DT"]/3600) > 40) 
                  
                  { 
                  
                  	$first_week_regular_time = $frow["DT"]/3600 - ($row["DT"]/3600 - 40);
                  
                  	if ($first_week_regular_time < 0) $first_week_regular_time = 0;
                  
                  	$first_week_overtime = ($row["DT"]/3600 - 40);
                  
                  //	echo $first_week_overtime;
                  
                  	if ($first_week_overtime > $frow["DT"]/3600) $first_week_overtime = $frow["DT"]/3600;
                  
                  //	echo $first_week_overtime;
                  
                  	//This is if there are more overtime hours for the entire week than hours in the pay pay period for the week.
                  
                  //	if ($first_week_overtime > ($row["DT"]/3600 - 40)) $first_week_overtime = ($row["DT"]/3600 - 40);
                  
                  //	echo $first_week_overtime;
                  
                  //	echo "-" . $first_week;
                  
                  } else
                  
                  {
                  
                  	$first_week_regular_time = $frow["DT"]/3600;
                  
                  	$first_week_overtime = 0;
                  
                  }
                  
                  
                  
                  	echo date('m/d/Y',$time);
                  
                  } else
                  
                  {
                  
                  	echo date('m/d/Y',$st_tuesday);	
                  
                  }
                  
                  	echo " - ";
                  
                  
                  
                  if (date('Y-m-d',$st_monday) < $end_date)
                  
                  {
                  
                  	echo date('m/d/Y',$st_monday);
                  
                  } else
                  
                  {
                  
                  	echo date('m/d/Y',$ed-1);	
                  
                  }
                  
                                    ?></font>
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align="right"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php
                  if ($first_week == 1)
                  
                  {
                  
                  echo number_format($first_week_regular_time,2);
                  
                  $regulartime += $first_week_regular_time;
                  
                  } else {
                  
                  if (($row["DT"]/3600) > 40) { echo number_format(40 ,2); $regulartime += 40; } else { echo number_format($row["DT"]/3600 ,2); $regulartime += number_format($row["DT"]/3600 ,2); }
                  
                  }
                  
                  ?>  
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php
                  if ($first_week == 1)
                  
                  {
                  
                  echo number_format($first_week_overtime,2);
                  
                  $overtime += $first_week_overtime;
                  
                  } else { 
                  
					if (($row["DT"]/3600) > 40) { echo number_format((float)($row["DT"]/3600)-40 ,2); $overtime += number_format($row["DT"]/3600,2) - 40; }
                  
                  		
                  
                  }
                  
                  $first_week = 0;
                  
                  ?> 
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
         </tr>
         <?php 
            }
            
            $st_tuesday = strtotime('+7 days', $st_tuesday);
            
            $st_monday = strtotime('+7 days', $st_monday);
            
            }
            
            $reg_hrs=number_format($regulartime,2);
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px; border-top: 1px solid black;" align="right"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               TOTAL
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo number_format($regulartime,2); ?>  
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;border-top: 1px solid black;" align="right"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo number_format($overtime,2); ?>  
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;border-top: 1px solid black;" align="right"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php 
                  $pq = "SELECT name, loop_workers.rate_cost AS RC, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))/3600 AS DT FROM loop_timeclock LEFT JOIN loop_workers ON loop_timeclock.worker_id = loop_workers.id 
                  
                  WHERE (loop_timeclock.type LIKE '%Production' OR loop_timeclock.type LIKE '%kits' OR loop_timeclock.type LIKE '%achines') AND loop_timeclock.worker_id = " . $_REQUEST["worker"];
                  
                  if($_GET["start_date"] != "qqq")
                  
                  {
                  
                   $pq .= " AND time_in BETWEEN '" . $start_date . "'";
                  
                  }
                  
                  if($_GET["end_date"] != "qqqq")
                  
                  {
                  
                   $pq .= " AND '" . $end_date . "'";
                  
                  }

                  db();
                  $pres = db_query($pq);
                  
                  $prow = array_shift($pres);
                  
                  $name = $prow["name"];
                  
                  $hours = $prow["DT"];
                  
                  $production_hours = $hours;
                  
                  
                  $query = "SELECT SUM( rate * production) AS P FROM loop_timeclock_production WHERE worker_id =  " . $_REQUEST["worker"];
                  
                  if($_GET["start_date"] != "q")
                  
                  {
                  
                   $query .= " AND date BETWEEN '" . $dt . "'";
                  
                  }
                  
                  if($_GET["end_date"] != "q")
                  
                  {
                  
                   $query .= " AND NOW()";
                  
                  }
                  
				  db();
                  $pres = db_query($query);
                  
                  $prow2 = array_shift($pres);
                  
                  
                  
                  			if (($prow["DT"] * $prow["RC"]) > 0 )
                  
                  			{ 	$efficiency = 100*$prow2["P"]/($prow["DT"] * $prow["RC"]); }
                  
                  			else{	$efficiency = 0; }
                  
                  			
                  
                  			$production_value = str_replace( ',', '', number_format((str_replace( ',', '', number_format($prow["DT"],2)) * $prow["RC"]),2));				
                  
							$production_bonus = str_replace(',', '', $grandTotalAll) - floatval(str_replace(',', '', number_format((str_replace(',', '', number_format($prow["DT"], 2)) * $prow["RC"]), 2)));
                  
                  		
                  			if ($production_bonus < 0){
                  
                  				echo "$0.00";
                  
                  				$production_bonus = 0;
                  
                  			}else{
                  
                  				echo "$" . number_format($production_bonus,2);
                  
                  			}			
                  
                  		?>  
            </td>
         </tr>
      </table>
      <br><br>
      <?php
        
         $query = "SELECT * FROM loop_timeclock_bonus WHERE worker_id =  " . $_REQUEST["worker"] . " AND date BETWEEN '" . $start_date . "' AND '" . $end_date_bonus  . "'";
						
		 db();
         $res = db_query($query);
         
                 if(tep_db_num_rows($res)>0)
         
                 {
         
         
         
         ?>
      <table width=28% cellpadding="4">
         <tr align="middle">
            <td colSpan="4" class="style7"><b>Other Bonus Report</b></td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Date
            </td>
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Amount
            </td>
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Notes
            </td>
         </tr>
         <?php
            while ($brow = array_shift($res))
            
            {
            
            	$other_bonus = $other_bonus + $brow["amount"];
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo timestamp_to_date($brow["date"]);?>
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               $<?php echo number_format($brow["amount"],2);?>
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $brow["notes"];?>
            </td>
			</tr>
         <?php } ?>
      </table>
      <?php // $query; 
         }
         
         
         
         if ($bonus >= 0){
         
         $final_total_bonus = $other_bonus + $bonus;
         
         }else{
         
         $final_total_bonus = $other_bonus;
         
         }	
         
         
         
         ?>
      
      <?
         ?>
      <?
         } // end if != -1 (single person
         
 }
 else {
         
         	//To display the details when ALL option is selected
         
         	$start_date = date('Y-m-d', $start_date);
         
         	$end_date = date('Y-m-d', $end_date + 86400);
         
         
         
         	if ($start_date > $end_date) {
         
         	echo "<font size=20>Nice Try, David - You thought I would not catch an error where the start date comes after the end date.</font>";
         
         	}
         
         
         
         	?>
      <table border="0" cellspacing="1" cellpadding="2" >
         <tr>
            <td class="header_td_style">Warehouse name</td>
            <?php	
               $type_q = "SELECT DISTINCT(type) as typenm FROM loop_timeclock where type!='' order by type";
		
			   db();
               $type_res = db_query($type_q);
               
               while($type_row = array_shift($type_res))
               
               {
               
               	?> 
            <td class="header_td_style"><?php echo $type_row["typenm"]; ?></td>
            <?php  }	?>
         </tr>
         <?php
            if($start_date !="" && $end_date!="")
            
            {
            
            	//$type = "";	
            
            
            
            	$tq1 = "SELECT warehouse_id,warehouse_name FROM loop_timeclock inner join loop_warehouse on loop_timeclock.warehouse_id=loop_warehouse.id group by warehouse_id";
				
				db();
            	$tres1 = db_query($tq1);
            
            	while($trow1 = array_shift($tres1))
            
            	{
            
            ?>
         <tr vAlign="center">
            <td bgcolor="#E4EAEB" class="style3" style="height: 22px;">
               <?php echo $trow1['warehouse_name'];?>
            </td>
            <?php
               $type_q = "SELECT DISTINCT(type) as typenm FROM loop_timeclock where type!='' order by type";
               
			   db();
               $type_res = db_query($type_q);
               
               while($type_row = array_shift($type_res))
               
               {
               
               	$type_str = "'".$type_row['typenm']."'";
               
               
               
               	$query = "SELECT warehouse_id, type, SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock WHERE type = " . $type_str . " AND warehouse_id = ".$trow1['warehouse_id']."";
               
               	if($_GET["start_date"] != "")
               
               	{
               
               	 $query .= " AND time_in BETWEEN '$start_date'";
               
               	}
               
               	if($_GET["end_date"] != "")
               
               	{
               
               	 $query .= " AND '$end_date' group by type";
               
               	}
               
               
				db();
               	$res = db_query($query);
               
               	$rec_found = "no";
               
               	while($row = array_shift($res))
               
               	{
               
               		$rec_found = "yes";
               
               ?>
            <td bgcolor="#E4EAEB" class="style3" style="height: 22px;" align=right>
               <?php echo $row["ADT"]; ?> 
            </td>
            <?php } 
               if ($rec_found == "no") { ?>
            <td bgcolor="#E4EAEB" class="style3" style="height: 22px;" align=right>&nbsp;</td>
            <?php	}  ?>
            <?php
               } ?>
         </tr>
         <?php } ?>
         <tr>
            <td  bgcolor="#E4EAEB" style="font-size:8pt; font-weight:bold; height: 22px;">Total</td>
            <?php	
               $type_q = "SELECT DISTINCT(type) as typenm FROM loop_timeclock where type!='' order by type";
			   
			   db();
               $type_res = db_query($type_q);
               
               while($type_row = array_shift($type_res))
               
               {
               
               	$type_str = "'".$type_row['typenm']."'";
               
               
               
               	$query = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock WHERE type = " . $type_str ;
               
               	if($_GET["start_date"] != "")
               
               	{
               
               	 $query .= " AND time_in BETWEEN '$start_date'";
               
               	}
               
               	if($_GET["end_date"] != "")
               
               	{
               
               	 $query .= " AND '$end_date' group by type";
               
               	}
               
               
				db();
               	$res = db_query($query);
               
               	while($row = array_shift($res))
               
               	{
               
               ?>
            <td bgcolor="#E4EAEB" style="font-size:8pt; font-weight:bold; height: 22px;" align=right>
               <?php echo $row["ADT"]; ?>
            </td>
            <?php } 
               }	?>
         </tr>
         <?php }?>
      </table>
      <?php
         }
         
         ?>
      <?php
         }
         
            $rate = number_format($rate,2);
         
            $ovt=number_format($overtime,2);
         
            //echo $reg_hrs."-".$rate.number_format($overtime,2);;
         
            //
         
            $reg_hrs_n=str_replace(",", "", $reg_hrs);
         
            $ovt_n=str_replace(",", "", $ovt);
         
			$base_pay = floatval($reg_hrs_n) * floatval($rate) + (floatval($ovt_n) * 1.5 * floatval($rate));
         $final_pay_check = $base_pay + floatval($production_bonus) + floatval($other_bonus);
         
         ?>
      <br>
      <table width="28%" cellpadding="4">
         <tr vAlign="center">
            <td class="style7" style="height: 22px;" align="center" colspan="2">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><b>Production Bonus Calculation</b></font>
            </td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" align="left" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Hourly Rate
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               $<?php echo $rate;?>
            </td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" align="left" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Total Regular Hours (Production + Kits + Machines)
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo number_format($production_hours,2);?>
            </td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" align="left" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Hourly Value of Production
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                $<?php echo number_format($production_value,2);?>
            </td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" align="left" style="height: 22px;border-bottom: 1px solid black;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Production Value
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;border-bottom: 1px solid black;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php $grandTotalAll = floatval($grandTotalAll);
               $grandTotalAllFormatted = number_format($grandTotalAll, 2);
               echo "$".$grandTotalAllFormatted;?>
            </td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" align="left" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <b>Difference</b>
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               $<?php echo number_format($grandTotalAll-$production_value,2);?>
            </td>
         </tr>
      </table>
      <br>
      <table width="28%" cellpadding="4">
         <tr vAlign="center">
            <td class="style7" style="height: 22px;border-bottom: 1px solid black;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><b>Hourly Pay</b></font></td>
            <td class="style7" style="height: 22px;border-bottom: 1px solid black;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><b>Production Bonus</b></td>
            <td class="style7" style="height: 22px;border-bottom: 1px solid black;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><b>Other Bonus</b></td>
            <td class="style7" style="height: 22px;border-bottom: 1px solid black;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><b>Total Pay</b></td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <b>$<?php echo number_format($base_pay,2);?></b>
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <b>$<?php echo number_format(floatval($production_bonus),2);?></b>
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <b>$<?php echo number_format($other_bonus,2);?></b>
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <b>$<?php echo number_format($final_pay_check,2);?></b>
            </td>
         </tr>
      </table>
      <?php
         } // end if "run"
         
                                                                                          
         
         ?>
      <br>
      <?php  
         ?>
      <br><br>
   </body>
</html>
<?php
   require ("inc/header_session.php");
   require ("mainfunctions/database.php");
   require ("mainfunctions/general-functions.php");
?>
<!DOCTYPE html>
<html>
   <head>
      <title>Employee Public Timeclock & Production Summary Report</title>
      <style type="text/css">
         .header_td_style
         {
         font-family:arial;
         font-size:12;
         height: 16px; 
         background:#ABC5DF;
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
         .table_margin{
         padding-right: 10px;
         }
      </style>
      <script type="text/javascript"> 
         function checkdate()
         
         {
         
         	if (document.getElementById("new_time_in").value == "") {
         
         		alert("Please enter the New Time In.");
         
         		return false;
         
         	}
         
         	
         
         	if (document.getElementById("new_time_out").value == "") {
         
         		alert("Please enter the New Time Out.");
         
         		return false;
         
         	}
         
         	
         
         	if (document.getElementById("new_time_in").value > document.getElementById("new_time_out").value) {
         
         		alert("New Time In > New Time out, please check.");
         
         		return false;
         
         	}
         
         	
         
         	document.rptSearch2.submit();
         
         }
         
         
         
         function chkssn(){
         
         	if (document.getElementById('ssn_txt').value.trim() == ""){
         
         		alert("Please enter the last four digit of your SSN.");
         
         		return false;
         
         	}else {
         
         		return true;
         
         	}
         
         }
         
         
         
      </script>
      <LINK rel='stylesheet' type='text/css' href='one_style.css' >
      <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
      <link rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>
   </head>
   <body>
      <?php include("inc/header.php"); ?>
      <div class="main_data_css">
      <div class="dashboard_heading" style="float: left;">
         <div style="float: left;">
            Employee Public Timeclock & Production Summary Report 
            <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
               <span class="tooltiptext">
               This report shows the user the summary of the timeclock and production within a provided time period for a specific employee.
               </span>
            </div>
            <div style="height: 13px;">&nbsp;</div>
         </div>
      </div>
      <form name="rptSearch" action="" method="GET" onsubmit="return chkssn();">
         <input type="hidden" name="action" value="run">
         <br /><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
         Find 
         <select name="worker">
            <option>Please Select</option>
            <option value=-1>ALL</option>
            <?php
               $total_production = 0; $total_production_val = 0; 
               
               $sql3 = "SELECT * FROM loop_workers ORDER BY active DESC, name ASC";
               
			   db();
               $result3 = db_query($sql3);
               
               while ($myrowsel3 = array_shift($result3)) {
               
               ?>
            <option value="<?php echo $myrowsel3["id"]; ?>" <?php if ($myrowsel3["id"]==$_REQUEST["worker"]) echo "selected"; ?>><?php echo $myrowsel3["name"]; ?></option>
            <?php } ?>
         </select>
         <script language="JavaScript" src="inc/CalendarPopup.js"></SCRIPT>
         <script language="JavaScript">document.write(getCalendarStyles());</script>
         <script language="JavaScript">
            var cal1xx = new CalendarPopup("listdiv");
            
            cal1xx.showNavigationDropdowns();
            
            var cal2xx = new CalendarPopup("listdiv");
            
            cal2xx.showNavigationDropdowns();
            
         </script>
         <?php
            $start_date = isset($_GET["start_date"])?strtotime($_GET["start_date"]):strtotime(date('m/d/Y'));
            
            $end_date = isset($_GET["end_date"])?strtotime($_GET["end_date"]):strtotime(date('m/d/Y'));
            
			$first_week = 1; // Moved to new position - Siddhesh
			$first_week_regular_time = ""; // Moved to new position - Siddhesh
			$first_week_overtime = ""; // Moved to new position - Siddhesh
			$start_date1 = ""; // Moved to new position - Siddhesh
			$total_orders = ""; // Moved to new position - Siddhesh
			$bonusProTotal = ""; // Moved to new position - Siddhesh
			$tierIncresedValTotal = ""; // Moved to new position - Siddhesh
			$grandTotalAll = ""; // Moved to new position - Siddhesh
			$production_value = 0; // Moved to new position - Siddhesh
			$production_bonus = ""; // Moved to new position - Siddhesh
			$other_bonus = 0; // Moved to new position - Siddhesh
			$reg_hrs = 0; // Moved to new position - Siddhesh
			$overtime = 0;  // Moved to new position - Siddhesh
			$rate = 0; // Moved to new position - Siddhesh
			$production_hours = 0; // Moved to new position - Siddhesh
			$dt = ""; // Moved to new position - Siddhesh
			$st_monday = ""; //Moved to new position - Siddhesh
			$bonus = ""; //Moved to new position - Siddhesh

		?>
         <font face="Arial, Helvetica, sans-serif" color="#333333" size="1"> from: <input type="text" name="start_date" size="11" value="<?php echo (isset($_GET["start_date"]) && $_GET["start_date"] != "")?date('m/d/Y', $start_date):""?>"> <a href="#" onclick="cal1xx.select(document.rptSearch.start_date,'anchor1xx','MM/dd/yyyy'); return false;" name="anchor1xx" id="anchor1xx"><img border="0" src="images/calendar.jpg"></a> <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">to: <input type="text" name="end_date" size="11" value="<?php echo (isset($_GET["end_date"]) && $_GET["start_date"] != "")?date('m/d/Y', $end_date):""?>"> <a href="#" onclick="cal1xx.select(document.rptSearch.end_date,'anchor2xx','MM/dd/yyyy'); return false;" name="anchor2xx" id="anchor2xx"><img border="0" src="images/calendar.jpg"></a>
         &nbsp;SSN (last 4 digit): <input type="password" name="ssn_txt" id="ssn_txt" value="">
         &nbsp; <input type="submit" value="Search">
      </form>
      <div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>
      <br><br>
      <?php
         if ($_GET["action"] == 'run') {
         
         	$rec_bypass = "no";
         
         	$sql_chk = "select user_pwd from loop_workers where id = " . $_REQUEST["worker"];
			
			db();
         	$result_chk = db_query($sql_chk);
         
         	$rec_found = "notfound";
         
         	$emp_login_msg = "<font color=red><b>Entered last four digit of your SSN is not matching, please check.</b></font>";
         
         	while($row_chk = array_shift($result_chk)){
         
         		$rec_found = "found";
         
         		if ($row_chk["user_pwd"] != "0") {
         
         			if ($row_chk["user_pwd"] != $_REQUEST["ssn_txt"]) {
         
         				$rec_bypass = "err";
         
         				$emp_login_msg = "<font color=red><b>Entered last four digit of your SSN is not matching, please check.</b></font>";
         
         			}else{
         
         				$emp_login_msg = "";
         
         			}
         
         		}else{
         
         			$rec_bypass = "err";
         
         			$emp_login_msg = "<font color=red><b>SSN not updated in the master, please check.</b></font>";
         
         		}
         
         	}
         
         	if ($rec_bypass == "err"){
         
         		$sql_chk = "select variablevalue from tblvariable where variablename = 'master_pin'";
				
				db();
         		$result_chk = db_query($sql_chk);
         
         		while($row_chk = array_shift($result_chk)){
         
         			if ($row_chk["variablevalue"] != $_REQUEST["ssn_txt"]){
         
         				$rec_bypass = "err";
         
         				$emp_login_msg = "<font color=red><b>Entered last four digit of your SSN is not matching, please check.</b></font>";
         
         			}else{
         
         				$emp_login_msg = "";
         
         				$rec_bypass = "no";
         
         			}
         
         
         
         		}
         
         		echo $emp_login_msg;
         
         	}
         
         	
         
         	if ($rec_bypass != "err"){
         
         
         
         		if ($_GET["delete"] == 'true') {
					db();
         			$res = db_query("DELETE FROM loop_timeclock_bonus WHERE id = " . $_REQUEST["id"]);
         
         		}
         
         		if ($_REQUEST["worker"] != -1)
         
         		{
         
         			$start_date = date('Y-m-d', $start_date);
         
         			$end_date_bonus = date('Y-m-d', $end_date);
         
         			$end_date = date('Y-m-d', $end_date + 86400);
         
					$end_date = strtotime($end_date);
					$end_date_ot = date('Y-m-d', $end_date);
         
         			if ($start_date > $end_date) {
         
         			echo "<font size=20>Nice Try, David - You thought I would not catch an error where the start date comes after the end date.</font>";
         
         		}
         
         
         
         		?>
     
      <?php
         $time = strtotime($start_date);
         
         $st_tuesday = strtotime('last tuesday', $time);
         
         $st_monday = strtotime('+6 days', $st_tuesday);
         
         ?>
      <table cellSpacing="1" cellPadding="3" width="800" border="0">
         <tr align="middle">
            <td colSpan="11" class="style7">
               TIMECLOCK REPORT FOR: 
               <?php
                  $query = "SELECT * FROM `loop_workers` WHERE id = " . $_REQUEST["worker"] ;
				
				  db();
                  $res = db_query($query);
                  
                  $row = array_shift($res);
                  
                  $name = $row["name"];
                  
                  $rate = $row["rate_cost"];
                  
                  echo "<b>".$row["name"]."</b>";
                  
                  ?>
            </td>
         </tr>
         <tr>
            <td class="style17" align="center">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               DATE</font>
            </td>
            <td class="style17" align="center">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               TIME IN</font>
            </td>
            <td class="style5" align="center">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               TIME OUT
            </td>
            <td align="middle" class="style16" align="center">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               AMOUNT
            </td>
            <td valign="middle" class="style16" align="center">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               TYPE
            </td>
            <td align="center" class="style16">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               IP CLOCK-IN
            </td>
            <td align="center" class="style16">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               IP CLOCK-OUT
            </td>
            <td align="center" class="style16">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               NOTES
            </td>
         </tr>
         <?php
            $query = "SELECT *, IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)) AS A, DATE_FORMAT(time_in, '%W, %M %d, %Y') AS D, TIME(time_in) AS T_I, TIME(time_out) AS T_O FROM loop_timeclock WHERE worker_id = " . $_REQUEST["worker"] . " ";
            
            if($_GET["start_date"] != "")
            
            {
            
             $query .= " AND time_in BETWEEN '$start_date'";
            
            }
            
            if($_GET["end_date"] != "")
            
            {
            
             $query .= " AND '$end_date'";
            
            }
            
            $query .= " order by time_in";
            
            db();
            $res = db_query($query);
            
            while($row = array_shift($res))
            
            {
            
            
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["D"]; ?>
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["T_I"]; ?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["T_O"]; ?>
            </td>
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
               <?php echo $row["A"]; ?>
            </td>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["type"];?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["ipaddress"];?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["ipaddress_clkout"];?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=left><font size=1><?php if ($row["time_in_old"] != "0000-00-00 00:00:00") echo $row["time_in_old"];?> <?php  if ($row["time_out_old"] != "0000-00-00 00:00:00") echo $row["time_out_old"];?> <?php echo $row["notes"];?></font></td>
         </tr>
         <?php
            }
            
         ?>
         <!-- For total row new code -->
         <?php
            $time = strtotime($start_date);
            
            if (date('l',$time) != "Tuesday") {
            
            	$st_tuesday = strtotime('last tuesday', $time);
            
            } else {
            
            	$st_tuesday = $time;
            
            }
            
            
            
            $st = strtotime($start_date);
            
			$ed = strtotime(strval($end_date));
            
            $st_monday = strtotime('+6 days', $st_tuesday);
            
            
            
            $overtime = 0; $overtime_production = 0;
            
            $regulartime = 0;
            
            while($st_tuesday < $ed)
            
            {
            
            	$query = "SELECT loop_timeclock.type, SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE  worker_id = " . $_REQUEST["worker"]  . " ";
            
            	if($_GET["start_date"] != "")
            
            	{
            
            	 $query .= " AND time_in BETWEEN '" . date('Y-m-d 00:00:00',$st_tuesday) . "'";
            
            	}
            
            	if($_GET["end_date"] != "")
            
            	{
            
            	 if ($st_monday < $ed) {
            
            	 $query .= " AND '" . date('Y-m-d 23:59:59',$st_monday) . "'";
            
            	 }
            
            	 else {
            
            		$query .= " AND '" . date('Y-m-d 23:59:59',$ed - 1) . "'";
            
            	 }
            
            	}
				
				db();
            	$res = db_query($query);
				
         
            
            	while($row = array_shift($res))
            
            	{
            
            
            
            		if (date('Y-m-d',$st_tuesday) < $start_date)
            
            		{
            
            			$fquery = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE  worker_id = " . $_REQUEST["worker"]  . " ";
            
        
            			$fquery .= " AND time_in BETWEEN '" . date('Y-m-d 00:00:00',$time) . "'";
            
						if ($st_monday < $ed) {
            
            			 $fquery .= " AND '" . date('Y-m-d 23:59:59',$st_monday) . "'";
            
            				 }
            
            			else {
            
            			$fquery .= " AND '" . date('Y-m-d 23:59:59',$ed - 1) . "'";
            
            			}
            
						db();
            
            			$fres = db_query($fquery);
            
            			$frow = array_shift($fres);
            
            			if (($row["DT"]/3600) > 40) 
            
            			{ 
            
            				$first_week_regular_time = $frow["DT"]/3600 - ($row["DT"]/3600 - 40);
            
            				if ($first_week_regular_time < 0) $first_week_regular_time = 0;
            
            				$first_week_overtime = ($row["DT"]/3600 - 40);
            
            			//	echo $first_week_overtime;
            
            				if ($first_week_overtime > $frow["DT"]/3600) $first_week_overtime = $frow["DT"]/3600;
            
            			} else
            
            			{
            
            				$first_week_regular_time = $frow["DT"]/3600;
            
            				$first_week_overtime = 0;
            
            			}
            
            
            
            			//echo date('m/d/Y',$time);
            
            		} else
            
            		{
            
            			//echo date('m/d/Y',$st_tuesday);	
            
            		}
            
            			//echo " - ";
            
            
            
            		if (date('Y-m-d',$st_monday) < $end_date)
            
            		{
            
            			//echo date('m/d/Y',$st_monday);
            
            		} else
            
            		{
            
            			//echo date('m/d/Y',$ed-1);	
            
            		}
            
            
            
            		if ($first_week == 1)
            
            		{
            
            				//echo number_format($first_week_regular_time,2);
            
            				$regulartime += $first_week_regular_time;
            
            		} else {
            
            				if (($row["DT"]/3600) > 40) { 
            
            					//echo number_format(40 ,2);
            
            					$regulartime += 40; 
            
            				} else { 
            
            					//echo number_format($row["DT"]/3600 ,2); 
            
            					$regulartime += number_format($row["DT"]/3600 ,2); 
            
            				}
            
            		}
            
            
            
            		if ($first_week == 1)
            
            		{
            
            			//echo number_format($first_week_overtime,2);
            
            			$overtime += $first_week_overtime;
            
            			if ($row["type"] == 'Production' || $row["type"] == 'kits' || $row["type"] == 'machines' ){
            
            				$overtime_production += $first_week_overtime;
            
            			}	
            
            		} else { 
            
            			if (($row["DT"]/3600) > 40) {
            
            				//echo number_format(($row["DT"]/3600)-40 ,2); 
            
							$overtime += (int)number_format($row["DT"]/3600,2) - 40; 
            
            				if ($row["type"] == 'Production' || $row["type"] == 'kits' || $row["type"] == 'machines' ){
            
            					$overtime_production += (int)number_format($row["DT"]/3600,2) - 40; 
            
            				}	
            
            			}
            
            				
            
            		}
            
            			$first_week = 0;
            
            
            
            			$production_val = $row["R"]*$row["P"];
            
            			
            
            			$tierIncresedVal =  number_format(($production_val * $row["tier_value"]), 2);
            
            			
            
            			if($tierIncresedVal == 'Invalid Tier Value'){
            
            				$grandTotal = number_format($production_val ,2);
            
            			}else{
            
							$grandTotal = number_format($production_val + floatval(str_replace(',', '', $tierIncresedVal)), 2);
            
            			}				
            
            
            
            			$pq     = "SELECT name, loop_workers.rate_cost AS RC, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))/3600 AS DT FROM loop_timeclock LEFT JOIN loop_workers ON loop_timeclock.worker_id = loop_workers.id WHERE (loop_timeclock.type LIKE '%Production' OR loop_timeclock.type LIKE '%kits' OR loop_timeclock.type LIKE '%achines') AND loop_timeclock.worker_id = " . $_REQUEST["worker"];
            
            			$pq .= " AND (time_in >= '" . $start_date1 . " 00:00:00' and time_in <= '" . $start_date1 . " 23:59:59') ";
            
            			db();
            
            			$pres       = db_query($pq);
            
            			$prow       = array_shift($pres);
            
            			$totalHours = $prow["DT"];
            
            			$hourlyRate = $prow["RC"];
            
            
            			$hourlyValue = ($totalHours * $hourlyRate);
            
            			//echo "bonus = " . $grandTotal . " - " . $hourlyValue . "<br>";
        
						$bonus =  floatval(str_replace(',', '', strval($grandTotal))) -  floatval(str_replace(',', '', strval($hourlyValue)));
            
            			$st_tuesday = strtotime('+7 days', $st_tuesday);
            
            			$st_monday = strtotime('+7 days', $st_monday);
            
            
            
            }
            
            	$reg_hrs=number_format($regulartime,2);
        
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $total_orders; ?>
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Total Hours
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo number_format($regulartime+$overtime,2); ?>  
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
         </tr>
      </table>
      <br/>
      <!-- For total row new code -->
      <table cellSpacing="1" cellPadding="3" width="950" border="0">
         <tr align="middle">
            <td colSpan="12" class="style7">
               PRODUCTION REPORT FOR: 
               <?php
                  $query = "SELECT * FROM `loop_workers` WHERE id = " . $_REQUEST["worker"] ;
				  
				  db();
                  $res = db_query($query);
                  
                  $row = array_shift($res);
                  
                  $name = $row["name"];
                  
                  echo "<b>".$row["name"]."</b>";
                  
                  ?>
            </td>
         </tr>
         <tr>
            <td class="style17">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               PRODUCTION DATE</font>
            </td>
            <td class="style17">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               ENTERED ON</font>
            </td>
            <td class="style17">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               RATE</font>
            </td>
            <td class="style5" >
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               PRODUCTION
            </td>
            <td align="middle" class="style5">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               SUBTOTAL
            </td>
            <td align="middle" class="style5">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               TIER INCREASE
            </td>
            <td align="middle" class="style5">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               GRAND TOTAL
            </td>
            <td align="middle" class="style5">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               TIER
            </td>
            <td align="middle" class="style5">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">NOTES
            </td>
         </tr>
         <?php
            $query = "SELECT *, DATE_FORMAT(date, '%W, %M %d, %Y') AS D, rate AS R, production AS P, added_by AS addedEmp, added_on AS recordDate FROM loop_timeclock_production WHERE worker_id = " . $_REQUEST["worker"] . " ";
            
            if($_GET["start_date"] != "")
            
            {
            
             $query .= " AND date BETWEEN '$start_date'";
            
            }
            
            if($_GET["end_date"] != "")
            
            {
            
             $query .= " AND '$end_date' ORDER BY date ASC";
            
            }
            
            db();
            
            $res = db_query($query);
            
            $production_total=0;
            
            while($row = array_shift($res))
            {
            
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
            
            
            
            	//$new_rate= $row["R"]*$emp_tier_value;
            
            	$production_val = $row["R"]*$row["P"];
            
            	
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["D"]; ?>
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php 
                  if($row['recordDate'] != ''){
                  
                  	echo date("m/d/Y H:i:s", strtotime($row['recordDate'])).' ('.$row['addedEmp'].')';
                  
                  }
                  
                  ?>
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               $<?php echo number_format($row["R"],2); ?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["P"]; ?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               $<?php echo number_format($production_val,2);?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               <?php               
                  $tierIncresedVal =  number_format(($production_val * $emp_tier_value), 2);
                  
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
            $production_total += str_replace(',', '', number_format($production_val,2));
            
            $bonusProTotal += $row["R"] * $row["P"];
            
              if($tierIncresedVal != 'Invalid Tier Value'){
            
                  $tierIncresedValTotal += $tierIncresedVal;
            
              }
            
              $grandTotalAll += str_replace(',', '', $grandTotal);
            
            }
            
            
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Total Production Value
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo "$".number_format($production_total,2); ?> 
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo "$".number_format($tierIncresedValTotal,2); ?>
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               <?php echo "$".number_format($grandTotalAll,2); ?>	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
         </tr>
      </table>
      <br><br>
      <table width="28%" cellpadding="4">
         <tr align="middle">
            <td colSpan="5" class="style7"><b>Hours by Type Report for: <?php echo $name;?></b></td>
         </tr>
         <tr vAlign="center">
            <td class="style17" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">Type</font></td>
            <td class="style17" style="height: 22px;" align="center" colspan="3"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Total Hours
            </td>
         </tr>
         <?php
            $tq = "SELECT DISTINCT(type) FROM loop_timeclock WHERE time_in BETWEEN '$start_date' AND '$end_date'";
            
            
			db();
            $tres = db_query($tq);
            
            while($trow = array_shift($tres))
            
            {
            
            
            
            $query = "SELECT type, SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE type LIKE '%" . $trow["type"] ."' AND worker_id = " . $_REQUEST["worker"]  . " ";
            
            if($_GET["start_date"] != "")
            
            {
            
             $query .= " AND time_in BETWEEN '$start_date'";
            
            }
            
            if($_GET["end_date"] != "")
            
            {
            
             $query .= " AND '$end_date'";
            
            }
            
			db();
            $res = db_query($query);
            
            while($row = array_shift($res))
            
            {
            
            	  if($trow["type"]==$row["type"])
            
            	  {
            
            		  
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $trow["type"];?>
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Total Hours
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["ADT"]; ?> 
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo number_format($row["DT"]/3600,2); ?>  
            </td>
         </tr>
         <?php 
            }
            
            }
            
            
            
            }
            
            ?>
      </table>
      <!------------- OVERTIME -------------------->
      <?php
         $time = strtotime($start_date);
         
         if (date('l',$time) != "Tuesday") {
         
         $st_tuesday = strtotime('last tuesday', $time);
         
         } else {
         
         $st_tuesday = $time;
         
         }
           
         $st = strtotime($start_date);
         
		 $ed = strtotime(strval($end_date));
         
         $st_monday = strtotime('+6 days', $st_tuesday);
        
         ?>
      <br><br>
      <table width="28%" cellpadding="4">
         <tr align="middle">
            <td colSpan="4" class="style7"><strong>Breakdown by Work Week Tues-Mon</strong><br><b><?php echo $name;?></b></td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Date Range
            </td>
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Regular Hours
            </td>
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Overtime Hours 
            </td>
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Bonus
            </td>
         </tr>
         <?php
            $overtime = 0;
            
            $regulartime = 0;
            
            while($st_tuesday < $ed)
            
            {
            
            $query = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE  worker_id = " . $_REQUEST["worker"]  . " ";
            
            if($_GET["start_date"] != "")
            
            {
            
             $query .= " AND time_in BETWEEN '" . date('Y-m-d 00:00:00',$st_tuesday) . "'";
            
            }
            
            if($_GET["end_date"] != "")
            
            {
            
             if ($st_monday < $ed) {
            
             $query .= " AND '" . date('Y-m-d 23:59:59',$st_monday) . "'";
            
             }
            
             else {
            
             $query .= " AND '" . date('Y-m-d 23:59:59',$ed - 1) . "'";
            
             }
            
            }
            
			db();
            $res = db_query($query);
            
            while($row = array_shift($res))
            
            {
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php
                  if (date('Y-m-d',$st_tuesday) < $start_date)
                  
                  {
                  
                  	//This is the first one. We also need to get the time from the start date to the end of the week
                  
                  	$fquery = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE  worker_id = " . $_REQUEST["worker"]  . " ";
                  
                  	
                  
                  	 $fquery .= " AND time_in BETWEEN '" . date('Y-m-d 00:00:00',$time) . "'";
                  
                  	
                  
                  		if ($st_monday < $ed) {
                  
                  	 $fquery .= " AND '" . date('Y-m-d 23:59:59',$st_monday) . "'";
                  
                  		 }
                  
                  	else {
                  
                  	$fquery .= " AND '" . date('Y-m-d 23:59:59',$ed - 1) . "'";
                  
                  	}
                  
				  db();
                  $fres = db_query($fquery);
                  
                  $frow = array_shift($fres);
                  
                  $first_week = 1;
                  
                  if (($row["DT"]/3600) > 40) 
                  
                  { 
                  
                  	$first_week_regular_time = $frow["DT"]/3600 - ($row["DT"]/3600 - 40);
                  
                  	if ($first_week_regular_time < 0) $first_week_regular_time = 0;
                  
                  	$first_week_overtime = ($row["DT"]/3600 - 40);
                  
                  //	echo $first_week_overtime;
                  
                  	if ($first_week_overtime > $frow["DT"]/3600) $first_week_overtime = $frow["DT"]/3600;
                  
                  //	echo $first_week_overtime;
                  
                  	//This is if there are more overtime hours for the entire week than hours in the pay pay period for the week.
                  
                  //	if ($first_week_overtime > ($row["DT"]/3600 - 40)) $first_week_overtime = ($row["DT"]/3600 - 40);
                  
                  //	echo $first_week_overtime;
                  
                  //	echo "-" . $first_week;
                  
                  } else
                  
                  {
                  
                  	$first_week_regular_time = $frow["DT"]/3600;
                  
                  	$first_week_overtime = 0;
                  
                  }
                  
                  
                  
                  	echo date('m/d/Y',$time);
                  
                  } else
                  
                  {
                  
                  	echo date('m/d/Y',$st_tuesday);	
                  
                  }
                  
                  	echo " - ";
                  
                  
                  
                  if (date('Y-m-d',$st_monday) < $end_date)
                  
                  {
                  
                  	echo date('m/d/Y',$st_monday);
                  
                  } else
                  
                  {
                  
                  	echo date('m/d/Y',$ed-1);	
                  
                  }
                  
                                    ?></font>
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align="right"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php
                  if ($first_week == 1)
                  
                  {
                  
                  echo number_format($first_week_regular_time,2);
                  
                  $regulartime += $first_week_regular_time;
                  
                  } else {
                  
                  if (($row["DT"]/3600) > 40) { echo number_format(40 ,2); $regulartime += 40; } else { echo number_format($row["DT"]/3600 ,2); $regulartime += number_format($row["DT"]/3600 ,2); }
                  
                  }
                  
                  ?>  
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php
                  if ($first_week == 1)
                  
                  {
                  
                  echo number_format($first_week_overtime,2);
                  
                  $overtime += $first_week_overtime;
                  
                  } else { 
                  
					if (($row["DT"]/3600) > 40) { echo number_format((float)($row["DT"]/3600)-40 ,2); $overtime += number_format($row["DT"]/3600,2) - 40; }
                  
                  		
                  
                  }
                  
                  $first_week = 0;
                  
                  ?> 
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
         </tr>
         <?php 
            }
            
            $st_tuesday = strtotime('+7 days', $st_tuesday);
            
            $st_monday = strtotime('+7 days', $st_monday);
            
            }
            
            $reg_hrs=number_format($regulartime,2);
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px; border-top: 1px solid black;" align="right"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               TOTAL
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo number_format($regulartime,2); ?>  
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;border-top: 1px solid black;" align="right"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo number_format($overtime,2); ?>  
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;border-top: 1px solid black;" align="right"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php 
                  $pq = "SELECT name, loop_workers.rate_cost AS RC, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))/3600 AS DT FROM loop_timeclock LEFT JOIN loop_workers ON loop_timeclock.worker_id = loop_workers.id 
                  
                  WHERE (loop_timeclock.type LIKE '%Production' OR loop_timeclock.type LIKE '%kits' OR loop_timeclock.type LIKE '%achines') AND loop_timeclock.worker_id = " . $_REQUEST["worker"];
                  
                  if($_GET["start_date"] != "qqq")
                  
                  {
                  
                   $pq .= " AND time_in BETWEEN '" . $start_date . "'";
                  
                  }
                  
                  if($_GET["end_date"] != "qqqq")
                  
                  {
                  
                   $pq .= " AND '" . $end_date . "'";
                  
                  }

                  db();
                  $pres = db_query($pq);
                  
                  $prow = array_shift($pres);
                  
                  $name = $prow["name"];
                  
                  $hours = $prow["DT"];
                  
                  $production_hours = $hours;
                  
                  
                  $query = "SELECT SUM( rate * production) AS P FROM loop_timeclock_production WHERE worker_id =  " . $_REQUEST["worker"];
                  
                  if($_GET["start_date"] != "q")
                  
                  {
                  
                   $query .= " AND date BETWEEN '" . $dt . "'";
                  
                  }
                  
                  if($_GET["end_date"] != "q")
                  
                  {
                  
                   $query .= " AND NOW()";
                  
                  }
                  
				  db();
                  $pres = db_query($query);
                  
                  $prow2 = array_shift($pres);
                  
                  
                  
                  			if (($prow["DT"] * $prow["RC"]) > 0 )
                  
                  			{ 	$efficiency = 100*$prow2["P"]/($prow["DT"] * $prow["RC"]); }
                  
                  			else{	$efficiency = 0; }
                  
                  			
                  
                  			$production_value = str_replace( ',', '', number_format((str_replace( ',', '', number_format($prow["DT"],2)) * $prow["RC"]),2));				
                  
							$production_bonus = str_replace(',', '', $grandTotalAll) - floatval(str_replace(',', '', number_format((str_replace(',', '', number_format($prow["DT"], 2)) * $prow["RC"]), 2)));
                  
                  		
                  			if ($production_bonus < 0){
                  
                  				echo "$0.00";
                  
                  				$production_bonus = 0;
                  
                  			}else{
                  
                  				echo "$" . number_format($production_bonus,2);
                  
                  			}			
                  
                  		?>  
            </td>
         </tr>
      </table>
      <br><br>
      <?php
        
         $query = "SELECT * FROM loop_timeclock_bonus WHERE worker_id =  " . $_REQUEST["worker"] . " AND date BETWEEN '" . $start_date . "' AND '" . $end_date_bonus  . "'";
						
		 db();
         $res = db_query($query);
         
                 if(tep_db_num_rows($res)>0)
         
                 {
         
         
         
         ?>
      <table width=28% cellpadding="4">
         <tr align="middle">
            <td colSpan="4" class="style7"><b>Other Bonus Report</b></td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Date
            </td>
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Amount
            </td>
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Notes
            </td>
         </tr>
         <?php
            while ($brow = array_shift($res))
            
            {
            
            	$other_bonus = $other_bonus + $brow["amount"];
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo timestamp_to_date($brow["date"]);?>
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               $<?php echo number_format($brow["amount"],2);?>
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $brow["notes"];?>
            </td>
			</tr>
         <?php } ?>
      </table>
      <?php // $query; 
         }
         
         
         
         if ($bonus >= 0){
         
         $final_total_bonus = $other_bonus + $bonus;
         
         }else{
         
         $final_total_bonus = $other_bonus;
         
         }	
         
         
         
         ?>
      
      <?
         ?>
      <?
         } // end if != -1 (single person
         
 }
 else {
         
         	//To display the details when ALL option is selected
         
         	$start_date = date('Y-m-d', $start_date);
         
         	$end_date = date('Y-m-d', $end_date + 86400);
         
         
         
         	if ($start_date > $end_date) {
         
         	echo "<font size=20>Nice Try, David - You thought I would not catch an error where the start date comes after the end date.</font>";
         
         	}
         
         
         
         	?>
      <table border="0" cellspacing="1" cellpadding="2" >
         <tr>
            <td class="header_td_style">Warehouse name</td>
            <?php	
               $type_q = "SELECT DISTINCT(type) as typenm FROM loop_timeclock where type!='' order by type";
		
			   db();
               $type_res = db_query($type_q);
               
               while($type_row = array_shift($type_res))
               
               {
               
               	?> 
            <td class="header_td_style"><?php echo $type_row["typenm"]; ?></td>
            <?php  }	?>
         </tr>
         <?php
            if($start_date !="" && $end_date!="")
            
            {
            
            	//$type = "";	
            
            
            
            	$tq1 = "SELECT warehouse_id,warehouse_name FROM loop_timeclock inner join loop_warehouse on loop_timeclock.warehouse_id=loop_warehouse.id group by warehouse_id";
				
				db();
            	$tres1 = db_query($tq1);
            
            	while($trow1 = array_shift($tres1))
            
            	{
            
            ?>
         <tr vAlign="center">
            <td bgcolor="#E4EAEB" class="style3" style="height: 22px;">
               <?php echo $trow1['warehouse_name'];?>
            </td>
            <?php
               $type_q = "SELECT DISTINCT(type) as typenm FROM loop_timeclock where type!='' order by type";
               
			   db();
               $type_res = db_query($type_q);
               
               while($type_row = array_shift($type_res))
               
               {
               
               	$type_str = "'".$type_row['typenm']."'";
               
               
               
               	$query = "SELECT warehouse_id, type, SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock WHERE type = " . $type_str . " AND warehouse_id = ".$trow1['warehouse_id']."";
               
               	if($_GET["start_date"] != "")
               
               	{
               
               	 $query .= " AND time_in BETWEEN '$start_date'";
               
               	}
               
               	if($_GET["end_date"] != "")
               
               	{
               
               	 $query .= " AND '$end_date' group by type";
               
               	}
               
               
				db();
               	$res = db_query($query);
               
               	$rec_found = "no";
               
               	while($row = array_shift($res))
               
               	{
               
               		$rec_found = "yes";
               
               ?>
            <td bgcolor="#E4EAEB" class="style3" style="height: 22px;" align=right>
               <?php echo $row["ADT"]; ?> 
            </td>
            <?php } 
               if ($rec_found == "no") { ?>
            <td bgcolor="#E4EAEB" class="style3" style="height: 22px;" align=right>&nbsp;</td>
            <?php	}  ?>
            <?php
               } ?>
         </tr>
         <?php } ?>
         <tr>
            <td  bgcolor="#E4EAEB" style="font-size:8pt; font-weight:bold; height: 22px;">Total</td>
            <?php	
               $type_q = "SELECT DISTINCT(type) as typenm FROM loop_timeclock where type!='' order by type";
			   
			   db();
               $type_res = db_query($type_q);
               
               while($type_row = array_shift($type_res))
               
               {
               
               	$type_str = "'".$type_row['typenm']."'";
               
               
               
               	$query = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock WHERE type = " . $type_str ;
               
               	if($_GET["start_date"] != "")
               
               	{
               
               	 $query .= " AND time_in BETWEEN '$start_date'";
               
               	}
               
               	if($_GET["end_date"] != "")
               
               	{
               
               	 $query .= " AND '$end_date' group by type";
               
               	}
               
               
				db();
               	$res = db_query($query);
               
               	while($row = array_shift($res))
               
               	{
               
               ?>
            <td bgcolor="#E4EAEB" style="font-size:8pt; font-weight:bold; height: 22px;" align=right>
               <?php echo $row["ADT"]; ?>
            </td>
            <?php } 
               }	?>
         </tr>
         <?php }?>
      </table>
      <?php
         }
         
         ?>
      <?php
         }
         
            $rate = number_format($rate,2);
         
            $ovt=number_format($overtime,2);
         
            //echo $reg_hrs."-".$rate.number_format($overtime,2);;
         
            //
         
            $reg_hrs_n=str_replace(",", "", $reg_hrs);
         
            $ovt_n=str_replace(",", "", $ovt);
         
			$base_pay = floatval($reg_hrs_n) * floatval($rate) + (floatval($ovt_n) * 1.5 * floatval($rate));
         $final_pay_check = $base_pay + floatval($production_bonus) + floatval($other_bonus);
         
         ?>
      <br>
      <table width="28%" cellpadding="4">
         <tr vAlign="center">
            <td class="style7" style="height: 22px;" align="center" colspan="2">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><b>Production Bonus Calculation</b></font>
            </td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" align="left" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Hourly Rate
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               $<?php echo $rate;?>
            </td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" align="left" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Total Regular Hours (Production + Kits + Machines)
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo number_format($production_hours,2);?>
            </td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" align="left" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Hourly Value of Production
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                $<?php echo number_format($production_value,2);?>
            </td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" align="left" style="height: 22px;border-bottom: 1px solid black;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Production Value
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;border-bottom: 1px solid black;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php $grandTotalAll = floatval($grandTotalAll);
               $grandTotalAllFormatted = number_format($grandTotalAll, 2);
               echo "$".$grandTotalAllFormatted;?>
            </td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" align="left" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <b>Difference</b>
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               $<?php echo number_format($grandTotalAll-$production_value,2);?>
            </td>
         </tr>
      </table>
      <br>
      <table width="28%" cellpadding="4">
         <tr vAlign="center">
            <td class="style7" style="height: 22px;border-bottom: 1px solid black;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><b>Hourly Pay</b></font></td>
            <td class="style7" style="height: 22px;border-bottom: 1px solid black;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><b>Production Bonus</b></td>
            <td class="style7" style="height: 22px;border-bottom: 1px solid black;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><b>Other Bonus</b></td>
            <td class="style7" style="height: 22px;border-bottom: 1px solid black;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><b>Total Pay</b></td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <b>$<?php echo number_format($base_pay,2);?></b>
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <b>$<?php echo number_format(floatval($production_bonus),2);?></b>
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <b>$<?php echo number_format($other_bonus,2);?></b>
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <b>$<?php echo number_format($final_pay_check,2);?></b>
            </td>
         </tr>
      </table>
      <?php
         } // end if "run"
         
                                                                                          
         
         ?>
      <br>
      <?php  
         ?>
      <br><br>
   </body>
</html>
<?php
   require ("inc/header_session.php");
   require ("mainfunctions/database.php");
   require ("mainfunctions/general-functions.php");
?>
<!DOCTYPE html>
<html>
   <head>
      <title>Employee Public Timeclock & Production Summary Report</title>
      <style type="text/css">
         .header_td_style
         {
         font-family:arial;
         font-size:12;
         height: 16px; 
         background:#ABC5DF;
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
         .table_margin{
         padding-right: 10px;
         }
      </style>
      <script type="text/javascript"> 
         function checkdate()
         
         {
         
         	if (document.getElementById("new_time_in").value == "") {
         
         		alert("Please enter the New Time In.");
         
         		return false;
         
         	}
         
         	
         
         	if (document.getElementById("new_time_out").value == "") {
         
         		alert("Please enter the New Time Out.");
         
         		return false;
         
         	}
         
         	
         
         	if (document.getElementById("new_time_in").value > document.getElementById("new_time_out").value) {
         
         		alert("New Time In > New Time out, please check.");
         
         		return false;
         
         	}
         
         	
         
         	document.rptSearch2.submit();
         
         }
         
         
         
         function chkssn(){
         
         	if (document.getElementById('ssn_txt').value.trim() == ""){
         
         		alert("Please enter the last four digit of your SSN.");
         
         		return false;
         
         	}else {
         
         		return true;
         
         	}
         
         }
         
         
         
      </script>
      <LINK rel='stylesheet' type='text/css' href='one_style.css' >
      <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
      <link rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>
   </head>
   <body>
      <?php include("inc/header.php"); ?>
      <div class="main_data_css">
      <div class="dashboard_heading" style="float: left;">
         <div style="float: left;">
            Employee Public Timeclock & Production Summary Report 
            <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
               <span class="tooltiptext">
               This report shows the user the summary of the timeclock and production within a provided time period for a specific employee.
               </span>
            </div>
            <div style="height: 13px;">&nbsp;</div>
         </div>
      </div>
      <form name="rptSearch" action="" method="GET" onsubmit="return chkssn();">
         <input type="hidden" name="action" value="run">
         <br /><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
         Find 
         <select name="worker">
            <option>Please Select</option>
            <option value=-1>ALL</option>
            <?php
               $total_production = 0; $total_production_val = 0; 
               
               $sql3 = "SELECT * FROM loop_workers ORDER BY active DESC, name ASC";
               
			   db();
               $result3 = db_query($sql3);
               
               while ($myrowsel3 = array_shift($result3)) {
               
               ?>
            <option value="<?php echo $myrowsel3["id"]; ?>" <?php if ($myrowsel3["id"]==$_REQUEST["worker"]) echo "selected"; ?>><?php echo $myrowsel3["name"]; ?></option>
            <?php } ?>
         </select>
         <script language="JavaScript" src="inc/CalendarPopup.js"></SCRIPT>
         <script language="JavaScript">document.write(getCalendarStyles());</script>
         <script language="JavaScript">
            var cal1xx = new CalendarPopup("listdiv");
            
            cal1xx.showNavigationDropdowns();
            
            var cal2xx = new CalendarPopup("listdiv");
            
            cal2xx.showNavigationDropdowns();
            
         </script>
         <?php
            $start_date = isset($_GET["start_date"])?strtotime($_GET["start_date"]):strtotime(date('m/d/Y'));
            
            $end_date = isset($_GET["end_date"])?strtotime($_GET["end_date"]):strtotime(date('m/d/Y'));
            
			$first_week = 1; // Moved to new position - Siddhesh
			$first_week_regular_time = ""; // Moved to new position - Siddhesh
			$first_week_overtime = ""; // Moved to new position - Siddhesh
			$start_date1 = ""; // Moved to new position - Siddhesh
			$total_orders = ""; // Moved to new position - Siddhesh
			$bonusProTotal = ""; // Moved to new position - Siddhesh
			$tierIncresedValTotal = ""; // Moved to new position - Siddhesh
			$grandTotalAll = ""; // Moved to new position - Siddhesh
			$production_value = 0; // Moved to new position - Siddhesh
			$production_bonus = ""; // Moved to new position - Siddhesh
			$other_bonus = 0; // Moved to new position - Siddhesh
			$reg_hrs = 0; // Moved to new position - Siddhesh
			$overtime = 0;  // Moved to new position - Siddhesh
			$rate = 0; // Moved to new position - Siddhesh
			$production_hours = 0; // Moved to new position - Siddhesh
			$dt = ""; // Moved to new position - Siddhesh
			$st_monday = ""; //Moved to new position - Siddhesh
			$bonus = ""; //Moved to new position - Siddhesh

		?>
         <font face="Arial, Helvetica, sans-serif" color="#333333" size="1"> from: <input type="text" name="start_date" size="11" value="<?php echo (isset($_GET["start_date"]) && $_GET["start_date"] != "")?date('m/d/Y', $start_date):""?>"> <a href="#" onclick="cal1xx.select(document.rptSearch.start_date,'anchor1xx','MM/dd/yyyy'); return false;" name="anchor1xx" id="anchor1xx"><img border="0" src="images/calendar.jpg"></a> <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">to: <input type="text" name="end_date" size="11" value="<?php echo (isset($_GET["end_date"]) && $_GET["start_date"] != "")?date('m/d/Y', $end_date):""?>"> <a href="#" onclick="cal1xx.select(document.rptSearch.end_date,'anchor2xx','MM/dd/yyyy'); return false;" name="anchor2xx" id="anchor2xx"><img border="0" src="images/calendar.jpg"></a>
         &nbsp;SSN (last 4 digit): <input type="password" name="ssn_txt" id="ssn_txt" value="">
         &nbsp; <input type="submit" value="Search">
      </form>
      <div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>
      <br><br>
      <?php
         if ($_GET["action"] == 'run') {
         
         	$rec_bypass = "no";
         
         	$sql_chk = "select user_pwd from loop_workers where id = " . $_REQUEST["worker"];
			
			db();
         	$result_chk = db_query($sql_chk);
         
         	$rec_found = "notfound";
         
         	$emp_login_msg = "<font color=red><b>Entered last four digit of your SSN is not matching, please check.</b></font>";
         
         	while($row_chk = array_shift($result_chk)){
         
         		$rec_found = "found";
         
         		if ($row_chk["user_pwd"] != "0") {
         
         			if ($row_chk["user_pwd"] != $_REQUEST["ssn_txt"]) {
         
         				$rec_bypass = "err";
         
         				$emp_login_msg = "<font color=red><b>Entered last four digit of your SSN is not matching, please check.</b></font>";
         
         			}else{
         
         				$emp_login_msg = "";
         
         			}
         
         		}else{
         
         			$rec_bypass = "err";
         
         			$emp_login_msg = "<font color=red><b>SSN not updated in the master, please check.</b></font>";
         
         		}
         
         	}
         
         	if ($rec_bypass == "err"){
         
         		$sql_chk = "select variablevalue from tblvariable where variablename = 'master_pin'";
				
				db();
         		$result_chk = db_query($sql_chk);
         
         		while($row_chk = array_shift($result_chk)){
         
         			if ($row_chk["variablevalue"] != $_REQUEST["ssn_txt"]){
         
         				$rec_bypass = "err";
         
         				$emp_login_msg = "<font color=red><b>Entered last four digit of your SSN is not matching, please check.</b></font>";
         
         			}else{
         
         				$emp_login_msg = "";
         
         				$rec_bypass = "no";
         
         			}
         
         
         
         		}
         
         		echo $emp_login_msg;
         
         	}
         
         	
         
         	if ($rec_bypass != "err"){
         
         
         
         		if ($_GET["delete"] == 'true') {
					db();
         			$res = db_query("DELETE FROM loop_timeclock_bonus WHERE id = " . $_REQUEST["id"]);
         
         		}
         
         		if ($_REQUEST["worker"] != -1)
         
         		{
         
         			$start_date = date('Y-m-d', $start_date);
         
         			$end_date_bonus = date('Y-m-d', $end_date);
         
         			$end_date = date('Y-m-d', $end_date + 86400);
         
					$end_date = strtotime($end_date);
					$end_date_ot = date('Y-m-d', $end_date);
         
         			if ($start_date > $end_date) {
         
         			echo "<font size=20>Nice Try, David - You thought I would not catch an error where the start date comes after the end date.</font>";
         
         		}
         
         
         
         		?>
     
      <?php
         $time = strtotime($start_date);
         
         $st_tuesday = strtotime('last tuesday', $time);
         
         $st_monday = strtotime('+6 days', $st_tuesday);
         
         ?>
      <table cellSpacing="1" cellPadding="3" width="800" border="0">
         <tr align="middle">
            <td colSpan="11" class="style7">
               TIMECLOCK REPORT FOR: 
               <?php
                  $query = "SELECT * FROM `loop_workers` WHERE id = " . $_REQUEST["worker"] ;
				
				  db();
                  $res = db_query($query);
                  
                  $row = array_shift($res);
                  
                  $name = $row["name"];
                  
                  $rate = $row["rate_cost"];
                  
                  echo "<b>".$row["name"]."</b>";
                  
                  ?>
            </td>
         </tr>
         <tr>
            <td class="style17" align="center">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               DATE</font>
            </td>
            <td class="style17" align="center">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               TIME IN</font>
            </td>
            <td class="style5" align="center">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               TIME OUT
            </td>
            <td align="middle" class="style16" align="center">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               AMOUNT
            </td>
            <td valign="middle" class="style16" align="center">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               TYPE
            </td>
            <td align="center" class="style16">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               IP CLOCK-IN
            </td>
            <td align="center" class="style16">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               IP CLOCK-OUT
            </td>
            <td align="center" class="style16">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               NOTES
            </td>
         </tr>
         <?php
            $query = "SELECT *, IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)) AS A, DATE_FORMAT(time_in, '%W, %M %d, %Y') AS D, TIME(time_in) AS T_I, TIME(time_out) AS T_O FROM loop_timeclock WHERE worker_id = " . $_REQUEST["worker"] . " ";
            
            if($_GET["start_date"] != "")
            
            {
            
             $query .= " AND time_in BETWEEN '$start_date'";
            
            }
            
            if($_GET["end_date"] != "")
            
            {
            
             $query .= " AND '$end_date'";
            
            }
            
            $query .= " order by time_in";
            
            db();
            $res = db_query($query);
            
            while($row = array_shift($res))
            
            {
            
            
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["D"]; ?>
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["T_I"]; ?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["T_O"]; ?>
            </td>
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
               <?php echo $row["A"]; ?>
            </td>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["type"];?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["ipaddress"];?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["ipaddress_clkout"];?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=left><font size=1><?php if ($row["time_in_old"] != "0000-00-00 00:00:00") echo $row["time_in_old"];?> <?php  if ($row["time_out_old"] != "0000-00-00 00:00:00") echo $row["time_out_old"];?> <?php echo $row["notes"];?></font></td>
         </tr>
         <?php
            }
            
         ?>
         <!-- For total row new code -->
         <?php
            $time = strtotime($start_date);
            
            if (date('l',$time) != "Tuesday") {
            
            	$st_tuesday = strtotime('last tuesday', $time);
            
            } else {
            
            	$st_tuesday = $time;
            
            }
            
            
            
            $st = strtotime($start_date);
            
			$ed = strtotime(strval($end_date));
            
            $st_monday = strtotime('+6 days', $st_tuesday);
            
            
            
            $overtime = 0; $overtime_production = 0;
            
            $regulartime = 0;
            
            while($st_tuesday < $ed)
            
            {
            
            	$query = "SELECT loop_timeclock.type, SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE  worker_id = " . $_REQUEST["worker"]  . " ";
            
            	if($_GET["start_date"] != "")
            
            	{
            
            	 $query .= " AND time_in BETWEEN '" . date('Y-m-d 00:00:00',$st_tuesday) . "'";
            
            	}
            
            	if($_GET["end_date"] != "")
            
            	{
            
            	 if ($st_monday < $ed) {
            
            	 $query .= " AND '" . date('Y-m-d 23:59:59',$st_monday) . "'";
            
            	 }
            
            	 else {
            
            		$query .= " AND '" . date('Y-m-d 23:59:59',$ed - 1) . "'";
            
            	 }
            
            	}
				
				db();
            	$res = db_query($query);
				
         
            
            	while($row = array_shift($res))
            
            	{
            
            
            
            		if (date('Y-m-d',$st_tuesday) < $start_date)
            
            		{
            
            			$fquery = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE  worker_id = " . $_REQUEST["worker"]  . " ";
            
        
            			$fquery .= " AND time_in BETWEEN '" . date('Y-m-d 00:00:00',$time) . "'";
            
						if ($st_monday < $ed) {
            
            			 $fquery .= " AND '" . date('Y-m-d 23:59:59',$st_monday) . "'";
            
            				 }
            
            			else {
            
            			$fquery .= " AND '" . date('Y-m-d 23:59:59',$ed - 1) . "'";
            
            			}
            
						db();
            
            			$fres = db_query($fquery);
            
            			$frow = array_shift($fres);
            
            			if (($row["DT"]/3600) > 40) 
            
            			{ 
            
            				$first_week_regular_time = $frow["DT"]/3600 - ($row["DT"]/3600 - 40);
            
            				if ($first_week_regular_time < 0) $first_week_regular_time = 0;
            
            				$first_week_overtime = ($row["DT"]/3600 - 40);
            
            			//	echo $first_week_overtime;
            
            				if ($first_week_overtime > $frow["DT"]/3600) $first_week_overtime = $frow["DT"]/3600;
            
            			} else
            
            			{
            
            				$first_week_regular_time = $frow["DT"]/3600;
            
            				$first_week_overtime = 0;
            
            			}
            
            
            
            			//echo date('m/d/Y',$time);
            
            		} else
            
            		{
            
            			//echo date('m/d/Y',$st_tuesday);	
            
            		}
            
            			//echo " - ";
            
            
            
            		if (date('Y-m-d',$st_monday) < $end_date)
            
            		{
            
            			//echo date('m/d/Y',$st_monday);
            
            		} else
            
            		{
            
            			//echo date('m/d/Y',$ed-1);	
            
            		}
            
            
            
            		if ($first_week == 1)
            
            		{
            
            				//echo number_format($first_week_regular_time,2);
            
            				$regulartime += $first_week_regular_time;
            
            		} else {
            
            				if (($row["DT"]/3600) > 40) { 
            
            					//echo number_format(40 ,2);
            
            					$regulartime += 40; 
            
            				} else { 
            
            					//echo number_format($row["DT"]/3600 ,2); 
            
            					$regulartime += number_format($row["DT"]/3600 ,2); 
            
            				}
            
            		}
            
            
            
            		if ($first_week == 1)
            
            		{
            
            			//echo number_format($first_week_overtime,2);
            
            			$overtime += $first_week_overtime;
            
            			if ($row["type"] == 'Production' || $row["type"] == 'kits' || $row["type"] == 'machines' ){
            
            				$overtime_production += $first_week_overtime;
            
            			}	
            
            		} else { 
            
            			if (($row["DT"]/3600) > 40) {
            
            				//echo number_format(($row["DT"]/3600)-40 ,2); 
            
							$overtime += (int)number_format($row["DT"]/3600,2) - 40; 
            
            				if ($row["type"] == 'Production' || $row["type"] == 'kits' || $row["type"] == 'machines' ){
            
            					$overtime_production += (int)number_format($row["DT"]/3600,2) - 40; 
            
            				}	
            
            			}
            
            				
            
            		}
            
            			$first_week = 0;
            
            
            
            			$production_val = $row["R"]*$row["P"];
            
            			
            
            			$tierIncresedVal =  number_format(($production_val * $row["tier_value"]), 2);
            
            			
            
            			if($tierIncresedVal == 'Invalid Tier Value'){
            
            				$grandTotal = number_format($production_val ,2);
            
            			}else{
            
							$grandTotal = number_format($production_val + floatval(str_replace(',', '', $tierIncresedVal)), 2);
            
            			}				
            
            
            
            			$pq     = "SELECT name, loop_workers.rate_cost AS RC, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))/3600 AS DT FROM loop_timeclock LEFT JOIN loop_workers ON loop_timeclock.worker_id = loop_workers.id WHERE (loop_timeclock.type LIKE '%Production' OR loop_timeclock.type LIKE '%kits' OR loop_timeclock.type LIKE '%achines') AND loop_timeclock.worker_id = " . $_REQUEST["worker"];
            
            			$pq .= " AND (time_in >= '" . $start_date1 . " 00:00:00' and time_in <= '" . $start_date1 . " 23:59:59') ";
            
            			db();
            
            			$pres       = db_query($pq);
            
            			$prow       = array_shift($pres);
            
            			$totalHours = $prow["DT"];
            
            			$hourlyRate = $prow["RC"];
            
            
            			$hourlyValue = ($totalHours * $hourlyRate);
            
            			//echo "bonus = " . $grandTotal . " - " . $hourlyValue . "<br>";
        
						$bonus =  floatval(str_replace(',', '', strval($grandTotal))) -  floatval(str_replace(',', '', strval($hourlyValue)));
            
            			$st_tuesday = strtotime('+7 days', $st_tuesday);
            
            			$st_monday = strtotime('+7 days', $st_monday);
            
            
            
            }
            
            	$reg_hrs=number_format($regulartime,2);
        
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $total_orders; ?>
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Total Hours
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo number_format($regulartime+$overtime,2); ?>  
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
         </tr>
      </table>
      <br/>
      <!-- For total row new code -->
      <table cellSpacing="1" cellPadding="3" width="950" border="0">
         <tr align="middle">
            <td colSpan="12" class="style7">
               PRODUCTION REPORT FOR: 
               <?php
                  $query = "SELECT * FROM `loop_workers` WHERE id = " . $_REQUEST["worker"] ;
				  
				  db();
                  $res = db_query($query);
                  
                  $row = array_shift($res);
                  
                  $name = $row["name"];
                  
                  echo "<b>".$row["name"]."</b>";
                  
                  ?>
            </td>
         </tr>
         <tr>
            <td class="style17">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               PRODUCTION DATE</font>
            </td>
            <td class="style17">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               ENTERED ON</font>
            </td>
            <td class="style17">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               RATE</font>
            </td>
            <td class="style5" >
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               PRODUCTION
            </td>
            <td align="middle" class="style5">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               SUBTOTAL
            </td>
            <td align="middle" class="style5">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               TIER INCREASE
            </td>
            <td align="middle" class="style5">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               GRAND TOTAL
            </td>
            <td align="middle" class="style5">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               TIER
            </td>
            <td align="middle" class="style5">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">NOTES
            </td>
         </tr>
         <?php
            $query = "SELECT *, DATE_FORMAT(date, '%W, %M %d, %Y') AS D, rate AS R, production AS P, added_by AS addedEmp, added_on AS recordDate FROM loop_timeclock_production WHERE worker_id = " . $_REQUEST["worker"] . " ";
            
            if($_GET["start_date"] != "")
            
            {
            
             $query .= " AND date BETWEEN '$start_date'";
            
            }
            
            if($_GET["end_date"] != "")
            
            {
            
             $query .= " AND '$end_date' ORDER BY date ASC";
            
            }
            
            db();
            
            $res = db_query($query);
            
            $production_total=0;
            
            while($row = array_shift($res))
            {
            
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
            
            
            
            	//$new_rate= $row["R"]*$emp_tier_value;
            
            	$production_val = $row["R"]*$row["P"];
            
            	
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["D"]; ?>
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php 
                  if($row['recordDate'] != ''){
                  
                  	echo date("m/d/Y H:i:s", strtotime($row['recordDate'])).' ('.$row['addedEmp'].')';
                  
                  }
                  
                  ?>
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               $<?php echo number_format($row["R"],2); ?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["P"]; ?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               $<?php echo number_format($production_val,2);?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               <?php               
                  $tierIncresedVal =  number_format(($production_val * $emp_tier_value), 2);
                  
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
            $production_total += str_replace(',', '', number_format($production_val,2));
            
            $bonusProTotal += $row["R"] * $row["P"];
            
              if($tierIncresedVal != 'Invalid Tier Value'){
            
                  $tierIncresedValTotal += $tierIncresedVal;
            
              }
            
              $grandTotalAll += str_replace(',', '', $grandTotal);
            
            }
            
            
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Total Production Value
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo "$".number_format($production_total,2); ?> 
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo "$".number_format($tierIncresedValTotal,2); ?>
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               <?php echo "$".number_format($grandTotalAll,2); ?>	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
         </tr>
      </table>
      <br><br>
      <table width="28%" cellpadding="4">
         <tr align="middle">
            <td colSpan="5" class="style7"><b>Hours by Type Report for: <?php echo $name;?></b></td>
         </tr>
         <tr vAlign="center">
            <td class="style17" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">Type</font></td>
            <td class="style17" style="height: 22px;" align="center" colspan="3"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Total Hours
            </td>
         </tr>
         <?php
            $tq = "SELECT DISTINCT(type) FROM loop_timeclock WHERE time_in BETWEEN '$start_date' AND '$end_date'";
            
            
			db();
            $tres = db_query($tq);
            
            while($trow = array_shift($tres))
            
            {
            
            
            
            $query = "SELECT type, SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE type LIKE '%" . $trow["type"] ."' AND worker_id = " . $_REQUEST["worker"]  . " ";
            
            if($_GET["start_date"] != "")
            
            {
            
             $query .= " AND time_in BETWEEN '$start_date'";
            
            }
            
            if($_GET["end_date"] != "")
            
            {
            
             $query .= " AND '$end_date'";
            
            }
            
			db();
            $res = db_query($query);
            
            while($row = array_shift($res))
            
            {
            
            	  if($trow["type"]==$row["type"])
            
            	  {
            
            		  
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $trow["type"];?>
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Total Hours
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["ADT"]; ?> 
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo number_format($row["DT"]/3600,2); ?>  
            </td>
         </tr>
         <?php 
            }
            
            }
            
            
            
            }
            
            ?>
      </table>
      <!------------- OVERTIME -------------------->
      <?php
         $time = strtotime($start_date);
         
         if (date('l',$time) != "Tuesday") {
         
         $st_tuesday = strtotime('last tuesday', $time);
         
         } else {
         
         $st_tuesday = $time;
         
         }
           
         $st = strtotime($start_date);
         
		 $ed = strtotime(strval($end_date));
         
         $st_monday = strtotime('+6 days', $st_tuesday);
        
         ?>
      <br><br>
      <table width="28%" cellpadding="4">
         <tr align="middle">
            <td colSpan="4" class="style7"><strong>Breakdown by Work Week Tues-Mon</strong><br><b><?php echo $name;?></b></td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Date Range
            </td>
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Regular Hours
            </td>
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Overtime Hours 
            </td>
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Bonus
            </td>
         </tr>
         <?php
            $overtime = 0;
            
            $regulartime = 0;
            
            while($st_tuesday < $ed)
            
            {
            
            $query = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE  worker_id = " . $_REQUEST["worker"]  . " ";
            
            if($_GET["start_date"] != "")
            
            {
            
             $query .= " AND time_in BETWEEN '" . date('Y-m-d 00:00:00',$st_tuesday) . "'";
            
            }
            
            if($_GET["end_date"] != "")
            
            {
            
             if ($st_monday < $ed) {
            
             $query .= " AND '" . date('Y-m-d 23:59:59',$st_monday) . "'";
            
             }
            
             else {
            
             $query .= " AND '" . date('Y-m-d 23:59:59',$ed - 1) . "'";
            
             }
            
            }
            
			db();
            $res = db_query($query);
            
            while($row = array_shift($res))
            
            {
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php
                  if (date('Y-m-d',$st_tuesday) < $start_date)
                  
                  {
                  
                  	//This is the first one. We also need to get the time from the start date to the end of the week
                  
                  	$fquery = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE  worker_id = " . $_REQUEST["worker"]  . " ";
                  
                  	
                  
                  	 $fquery .= " AND time_in BETWEEN '" . date('Y-m-d 00:00:00',$time) . "'";
                  
                  	
                  
                  		if ($st_monday < $ed) {
                  
                  	 $fquery .= " AND '" . date('Y-m-d 23:59:59',$st_monday) . "'";
                  
                  		 }
                  
                  	else {
                  
                  	$fquery .= " AND '" . date('Y-m-d 23:59:59',$ed - 1) . "'";
                  
                  	}
                  
				  db();
                  $fres = db_query($fquery);
                  
                  $frow = array_shift($fres);
                  
                  $first_week = 1;
                  
                  if (($row["DT"]/3600) > 40) 
                  
                  { 
                  
                  	$first_week_regular_time = $frow["DT"]/3600 - ($row["DT"]/3600 - 40);
                  
                  	if ($first_week_regular_time < 0) $first_week_regular_time = 0;
                  
                  	$first_week_overtime = ($row["DT"]/3600 - 40);
                  
                  //	echo $first_week_overtime;
                  
                  	if ($first_week_overtime > $frow["DT"]/3600) $first_week_overtime = $frow["DT"]/3600;
                  
                  //	echo $first_week_overtime;
                  
                  	//This is if there are more overtime hours for the entire week than hours in the pay pay period for the week.
                  
                  //	if ($first_week_overtime > ($row["DT"]/3600 - 40)) $first_week_overtime = ($row["DT"]/3600 - 40);
                  
                  //	echo $first_week_overtime;
                  
                  //	echo "-" . $first_week;
                  
                  } else
                  
                  {
                  
                  	$first_week_regular_time = $frow["DT"]/3600;
                  
                  	$first_week_overtime = 0;
                  
                  }
                  
                  
                  
                  	echo date('m/d/Y',$time);
                  
                  } else
                  
                  {
                  
                  	echo date('m/d/Y',$st_tuesday);	
                  
                  }
                  
                  	echo " - ";
                  
                  
                  
                  if (date('Y-m-d',$st_monday) < $end_date)
                  
                  {
                  
                  	echo date('m/d/Y',$st_monday);
                  
                  } else
                  
                  {
                  
                  	echo date('m/d/Y',$ed-1);	
                  
                  }
                  
                                    ?></font>
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align="right"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php
                  if ($first_week == 1)
                  
                  {
                  
                  echo number_format($first_week_regular_time,2);
                  
                  $regulartime += $first_week_regular_time;
                  
                  } else {
                  
                  if (($row["DT"]/3600) > 40) { echo number_format(40 ,2); $regulartime += 40; } else { echo number_format($row["DT"]/3600 ,2); $regulartime += number_format($row["DT"]/3600 ,2); }
                  
                  }
                  
                  ?>  
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php
                  if ($first_week == 1)
                  
                  {
                  
                  echo number_format($first_week_overtime,2);
                  
                  $overtime += $first_week_overtime;
                  
                  } else { 
                  
					if (($row["DT"]/3600) > 40) { echo number_format((float)($row["DT"]/3600)-40 ,2); $overtime += number_format($row["DT"]/3600,2) - 40; }
                  
                  		
                  
                  }
                  
                  $first_week = 0;
                  
                  ?> 
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
         </tr>
         <?php 
            }
            
            $st_tuesday = strtotime('+7 days', $st_tuesday);
            
            $st_monday = strtotime('+7 days', $st_monday);
            
            }
            
            $reg_hrs=number_format($regulartime,2);
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px; border-top: 1px solid black;" align="right"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               TOTAL
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo number_format($regulartime,2); ?>  
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;border-top: 1px solid black;" align="right"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo number_format($overtime,2); ?>  
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;border-top: 1px solid black;" align="right"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php 
                  $pq = "SELECT name, loop_workers.rate_cost AS RC, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))/3600 AS DT FROM loop_timeclock LEFT JOIN loop_workers ON loop_timeclock.worker_id = loop_workers.id 
                  
                  WHERE (loop_timeclock.type LIKE '%Production' OR loop_timeclock.type LIKE '%kits' OR loop_timeclock.type LIKE '%achines') AND loop_timeclock.worker_id = " . $_REQUEST["worker"];
                  
                  if($_GET["start_date"] != "qqq")
                  
                  {
                  
                   $pq .= " AND time_in BETWEEN '" . $start_date . "'";
                  
                  }
                  
                  if($_GET["end_date"] != "qqqq")
                  
                  {
                  
                   $pq .= " AND '" . $end_date . "'";
                  
                  }

                  db();
                  $pres = db_query($pq);
                  
                  $prow = array_shift($pres);
                  
                  $name = $prow["name"];
                  
                  $hours = $prow["DT"];
                  
                  $production_hours = $hours;
                  
                  
                  $query = "SELECT SUM( rate * production) AS P FROM loop_timeclock_production WHERE worker_id =  " . $_REQUEST["worker"];
                  
                  if($_GET["start_date"] != "q")
                  
                  {
                  
                   $query .= " AND date BETWEEN '" . $dt . "'";
                  
                  }
                  
                  if($_GET["end_date"] != "q")
                  
                  {
                  
                   $query .= " AND NOW()";
                  
                  }
                  
				  db();
                  $pres = db_query($query);
                  
                  $prow2 = array_shift($pres);
                  
                  
                  
                  			if (($prow["DT"] * $prow["RC"]) > 0 )
                  
                  			{ 	$efficiency = 100*$prow2["P"]/($prow["DT"] * $prow["RC"]); }
                  
                  			else{	$efficiency = 0; }
                  
                  			
                  
                  			$production_value = str_replace( ',', '', number_format((str_replace( ',', '', number_format($prow["DT"],2)) * $prow["RC"]),2));				
                  
							$production_bonus = str_replace(',', '', $grandTotalAll) - floatval(str_replace(',', '', number_format((str_replace(',', '', number_format($prow["DT"], 2)) * $prow["RC"]), 2)));
                  
                  		
                  			if ($production_bonus < 0){
                  
                  				echo "$0.00";
                  
                  				$production_bonus = 0;
                  
                  			}else{
                  
                  				echo "$" . number_format($production_bonus,2);
                  
                  			}			
                  
                  		?>  
            </td>
         </tr>
      </table>
      <br><br>
      <?php
        
         $query = "SELECT * FROM loop_timeclock_bonus WHERE worker_id =  " . $_REQUEST["worker"] . " AND date BETWEEN '" . $start_date . "' AND '" . $end_date_bonus  . "'";
						
		 db();
         $res = db_query($query);
         
                 if(tep_db_num_rows($res)>0)
         
                 {
         
         
         
         ?>
      <table width=28% cellpadding="4">
         <tr align="middle">
            <td colSpan="4" class="style7"><b>Other Bonus Report</b></td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Date
            </td>
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Amount
            </td>
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Notes
            </td>
         </tr>
         <?php
            while ($brow = array_shift($res))
            
            {
            
            	$other_bonus = $other_bonus + $brow["amount"];
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo timestamp_to_date($brow["date"]);?>
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               $<?php echo number_format($brow["amount"],2);?>
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $brow["notes"];?>
            </td>
			</tr>
         <?php } ?>
      </table>
      <?php // $query; 
         }
         
         
         
         if ($bonus >= 0){
         
         $final_total_bonus = $other_bonus + $bonus;
         
         }else{
         
         $final_total_bonus = $other_bonus;
         
         }	
         
         
         
         ?>
      
      <?
         ?>
      <?
         } // end if != -1 (single person
         
 }
 else {
         
         	//To display the details when ALL option is selected
         
         	$start_date = date('Y-m-d', $start_date);
         
         	$end_date = date('Y-m-d', $end_date + 86400);
         
         
         
         	if ($start_date > $end_date) {
         
         	echo "<font size=20>Nice Try, David - You thought I would not catch an error where the start date comes after the end date.</font>";
         
         	}
         
         
         
         	?>
      <table border="0" cellspacing="1" cellpadding="2" >
         <tr>
            <td class="header_td_style">Warehouse name</td>
            <?php	
               $type_q = "SELECT DISTINCT(type) as typenm FROM loop_timeclock where type!='' order by type";
		
			   db();
               $type_res = db_query($type_q);
               
               while($type_row = array_shift($type_res))
               
               {
               
               	?> 
            <td class="header_td_style"><?php echo $type_row["typenm"]; ?></td>
            <?php  }	?>
         </tr>
         <?php
            if($start_date !="" && $end_date!="")
            
            {
            
            	//$type = "";	
            
            
            
            	$tq1 = "SELECT warehouse_id,warehouse_name FROM loop_timeclock inner join loop_warehouse on loop_timeclock.warehouse_id=loop_warehouse.id group by warehouse_id";
				
				db();
            	$tres1 = db_query($tq1);
            
            	while($trow1 = array_shift($tres1))
            
            	{
            
            ?>
         <tr vAlign="center">
            <td bgcolor="#E4EAEB" class="style3" style="height: 22px;">
               <?php echo $trow1['warehouse_name'];?>
            </td>
            <?php
               $type_q = "SELECT DISTINCT(type) as typenm FROM loop_timeclock where type!='' order by type";
               
			   db();
               $type_res = db_query($type_q);
               
               while($type_row = array_shift($type_res))
               
               {
               
               	$type_str = "'".$type_row['typenm']."'";
               
               
               
               	$query = "SELECT warehouse_id, type, SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock WHERE type = " . $type_str . " AND warehouse_id = ".$trow1['warehouse_id']."";
               
               	if($_GET["start_date"] != "")
               
               	{
               
               	 $query .= " AND time_in BETWEEN '$start_date'";
               
               	}
               
               	if($_GET["end_date"] != "")
               
               	{
               
               	 $query .= " AND '$end_date' group by type";
               
               	}
               
               
				db();
               	$res = db_query($query);
               
               	$rec_found = "no";
               
               	while($row = array_shift($res))
               
               	{
               
               		$rec_found = "yes";
               
               ?>
            <td bgcolor="#E4EAEB" class="style3" style="height: 22px;" align=right>
               <?php echo $row["ADT"]; ?> 
            </td>
            <?php } 
               if ($rec_found == "no") { ?>
            <td bgcolor="#E4EAEB" class="style3" style="height: 22px;" align=right>&nbsp;</td>
            <?php	}  ?>
            <?php
               } ?>
         </tr>
         <?php } ?>
         <tr>
            <td  bgcolor="#E4EAEB" style="font-size:8pt; font-weight:bold; height: 22px;">Total</td>
            <?php	
               $type_q = "SELECT DISTINCT(type) as typenm FROM loop_timeclock where type!='' order by type";
			   
			   db();
               $type_res = db_query($type_q);
               
               while($type_row = array_shift($type_res))
               
               {
               
               	$type_str = "'".$type_row['typenm']."'";
               
               
               
               	$query = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock WHERE type = " . $type_str ;
               
               	if($_GET["start_date"] != "")
               
               	{
               
               	 $query .= " AND time_in BETWEEN '$start_date'";
               
               	}
               
               	if($_GET["end_date"] != "")
               
               	{
               
               	 $query .= " AND '$end_date' group by type";
               
               	}
               
               
				db();
               	$res = db_query($query);
               
               	while($row = array_shift($res))
               
               	{
               
               ?>
            <td bgcolor="#E4EAEB" style="font-size:8pt; font-weight:bold; height: 22px;" align=right>
               <?php echo $row["ADT"]; ?>
            </td>
            <?php } 
               }	?>
         </tr>
         <?php }?>
      </table>
      <?php
         }
         
         ?>
      <?php
         }
         
            $rate = number_format($rate,2);
         
            $ovt=number_format($overtime,2);
         
            //echo $reg_hrs."-".$rate.number_format($overtime,2);;
         
            //
         
            $reg_hrs_n=str_replace(",", "", $reg_hrs);
         
            $ovt_n=str_replace(",", "", $ovt);
         
			$base_pay = floatval($reg_hrs_n) * floatval($rate) + (floatval($ovt_n) * 1.5 * floatval($rate));
         $final_pay_check = $base_pay + floatval($production_bonus) + floatval($other_bonus);
         
         ?>
      <br>
      <table width="28%" cellpadding="4">
         <tr vAlign="center">
            <td class="style7" style="height: 22px;" align="center" colspan="2">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><b>Production Bonus Calculation</b></font>
            </td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" align="left" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Hourly Rate
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               $<?php echo $rate;?>
            </td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" align="left" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Total Regular Hours (Production + Kits + Machines)
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo number_format($production_hours,2);?>
            </td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" align="left" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Hourly Value of Production
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                $<?php echo number_format($production_value,2);?>
            </td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" align="left" style="height: 22px;border-bottom: 1px solid black;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Production Value
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;border-bottom: 1px solid black;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php $grandTotalAll = floatval($grandTotalAll);
               $grandTotalAllFormatted = number_format($grandTotalAll, 2);
               echo "$".$grandTotalAllFormatted;?>
            </td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" align="left" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <b>Difference</b>
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               $<?php echo number_format($grandTotalAll-$production_value,2);?>
            </td>
         </tr>
      </table>
      <br>
      <table width="28%" cellpadding="4">
         <tr vAlign="center">
            <td class="style7" style="height: 22px;border-bottom: 1px solid black;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><b>Hourly Pay</b></font></td>
            <td class="style7" style="height: 22px;border-bottom: 1px solid black;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><b>Production Bonus</b></td>
            <td class="style7" style="height: 22px;border-bottom: 1px solid black;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><b>Other Bonus</b></td>
            <td class="style7" style="height: 22px;border-bottom: 1px solid black;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><b>Total Pay</b></td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <b>$<?php echo number_format($base_pay,2);?></b>
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <b>$<?php echo number_format(floatval($production_bonus),2);?></b>
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <b>$<?php echo number_format($other_bonus,2);?></b>
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <b>$<?php echo number_format($final_pay_check,2);?></b>
            </td>
         </tr>
      </table>
      <?php
         } // end if "run"
         
                                                                                          
         
         ?>
      <br>
      <?php  
         ?>
      <br><br>
   </body>
</html>
<?php
   require ("inc/header_session.php");
   require ("mainfunctions/database.php");
   require ("mainfunctions/general-functions.php");
?>
<!DOCTYPE html>
<html>
   <head>
      <title>Employee Public Timeclock & Production Summary Report</title>
      <style type="text/css">
         .header_td_style
         {
         font-family:arial;
         font-size:12;
         height: 16px; 
         background:#ABC5DF;
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
         .table_margin{
         padding-right: 10px;
         }
      </style>
      <script type="text/javascript"> 
         function checkdate()
         
         {
         
         	if (document.getElementById("new_time_in").value == "") {
         
         		alert("Please enter the New Time In.");
         
         		return false;
         
         	}
         
         	
         
         	if (document.getElementById("new_time_out").value == "") {
         
         		alert("Please enter the New Time Out.");
         
         		return false;
         
         	}
         
         	
         
         	if (document.getElementById("new_time_in").value > document.getElementById("new_time_out").value) {
         
         		alert("New Time In > New Time out, please check.");
         
         		return false;
         
         	}
         
         	
         
         	document.rptSearch2.submit();
         
         }
         
         
         
         function chkssn(){
         
         	if (document.getElementById('ssn_txt').value.trim() == ""){
         
         		alert("Please enter the last four digit of your SSN.");
         
         		return false;
         
         	}else {
         
         		return true;
         
         	}
         
         }
         
         
         
      </script>
      <LINK rel='stylesheet' type='text/css' href='one_style.css' >
      <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
      <link rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>
   </head>
   <body>
      <?php include("inc/header.php"); ?>
      <div class="main_data_css">
      <div class="dashboard_heading" style="float: left;">
         <div style="float: left;">
            Employee Public Timeclock & Production Summary Report 
            <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
               <span class="tooltiptext">
               This report shows the user the summary of the timeclock and production within a provided time period for a specific employee.
               </span>
            </div>
            <div style="height: 13px;">&nbsp;</div>
         </div>
      </div>
      <form name="rptSearch" action="" method="GET" onsubmit="return chkssn();">
         <input type="hidden" name="action" value="run">
         <br /><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
         Find 
         <select name="worker">
            <option>Please Select</option>
            <option value=-1>ALL</option>
            <?php
               $total_production = 0; $total_production_val = 0; 
               
               $sql3 = "SELECT * FROM loop_workers ORDER BY active DESC, name ASC";
               
			   db();
               $result3 = db_query($sql3);
               
               while ($myrowsel3 = array_shift($result3)) {
               
               ?>
            <option value="<?php echo $myrowsel3["id"]; ?>" <?php if ($myrowsel3["id"]==$_REQUEST["worker"]) echo "selected"; ?>><?php echo $myrowsel3["name"]; ?></option>
            <?php } ?>
         </select>
         <script language="JavaScript" src="inc/CalendarPopup.js"></SCRIPT>
         <script language="JavaScript">document.write(getCalendarStyles());</script>
         <script language="JavaScript">
            var cal1xx = new CalendarPopup("listdiv");
            
            cal1xx.showNavigationDropdowns();
            
            var cal2xx = new CalendarPopup("listdiv");
            
            cal2xx.showNavigationDropdowns();
            
         </script>
         <?php
            $start_date = isset($_GET["start_date"])?strtotime($_GET["start_date"]):strtotime(date('m/d/Y'));
            
            $end_date = isset($_GET["end_date"])?strtotime($_GET["end_date"]):strtotime(date('m/d/Y'));
            
			$first_week = 1; // Moved to new position - Siddhesh
			$first_week_regular_time = ""; // Moved to new position - Siddhesh
			$first_week_overtime = ""; // Moved to new position - Siddhesh
			$start_date1 = ""; // Moved to new position - Siddhesh
			$total_orders = ""; // Moved to new position - Siddhesh
			$bonusProTotal = ""; // Moved to new position - Siddhesh
			$tierIncresedValTotal = ""; // Moved to new position - Siddhesh
			$grandTotalAll = ""; // Moved to new position - Siddhesh
			$production_value = 0; // Moved to new position - Siddhesh
			$production_bonus = ""; // Moved to new position - Siddhesh
			$other_bonus = 0; // Moved to new position - Siddhesh
			$reg_hrs = 0; // Moved to new position - Siddhesh
			$overtime = 0;  // Moved to new position - Siddhesh
			$rate = 0; // Moved to new position - Siddhesh
			$production_hours = 0; // Moved to new position - Siddhesh
			$dt = ""; // Moved to new position - Siddhesh
			$st_monday = ""; //Moved to new position - Siddhesh
			$bonus = ""; //Moved to new position - Siddhesh

		?>
         <font face="Arial, Helvetica, sans-serif" color="#333333" size="1"> from: <input type="text" name="start_date" size="11" value="<?php echo (isset($_GET["start_date"]) && $_GET["start_date"] != "")?date('m/d/Y', $start_date):""?>"> <a href="#" onclick="cal1xx.select(document.rptSearch.start_date,'anchor1xx','MM/dd/yyyy'); return false;" name="anchor1xx" id="anchor1xx"><img border="0" src="images/calendar.jpg"></a> <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">to: <input type="text" name="end_date" size="11" value="<?php echo (isset($_GET["end_date"]) && $_GET["start_date"] != "")?date('m/d/Y', $end_date):""?>"> <a href="#" onclick="cal1xx.select(document.rptSearch.end_date,'anchor2xx','MM/dd/yyyy'); return false;" name="anchor2xx" id="anchor2xx"><img border="0" src="images/calendar.jpg"></a>
         &nbsp;SSN (last 4 digit): <input type="password" name="ssn_txt" id="ssn_txt" value="">
         &nbsp; <input type="submit" value="Search">
      </form>
      <div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>
      <br><br>
      <?php
         if ($_GET["action"] == 'run') {
         
         	$rec_bypass = "no";
         
         	$sql_chk = "select user_pwd from loop_workers where id = " . $_REQUEST["worker"];
			
			db();
         	$result_chk = db_query($sql_chk);
         
         	$rec_found = "notfound";
         
         	$emp_login_msg = "<font color=red><b>Entered last four digit of your SSN is not matching, please check.</b></font>";
         
         	while($row_chk = array_shift($result_chk)){
         
         		$rec_found = "found";
         
         		if ($row_chk["user_pwd"] != "0") {
         
         			if ($row_chk["user_pwd"] != $_REQUEST["ssn_txt"]) {
         
         				$rec_bypass = "err";
         
         				$emp_login_msg = "<font color=red><b>Entered last four digit of your SSN is not matching, please check.</b></font>";
         
         			}else{
         
         				$emp_login_msg = "";
         
         			}
         
         		}else{
         
         			$rec_bypass = "err";
         
         			$emp_login_msg = "<font color=red><b>SSN not updated in the master, please check.</b></font>";
         
         		}
         
         	}
         
         	if ($rec_bypass == "err"){
         
         		$sql_chk = "select variablevalue from tblvariable where variablename = 'master_pin'";
				
				db();
         		$result_chk = db_query($sql_chk);
         
         		while($row_chk = array_shift($result_chk)){
         
         			if ($row_chk["variablevalue"] != $_REQUEST["ssn_txt"]){
         
         				$rec_bypass = "err";
         
         				$emp_login_msg = "<font color=red><b>Entered last four digit of your SSN is not matching, please check.</b></font>";
         
         			}else{
         
         				$emp_login_msg = "";
         
         				$rec_bypass = "no";
         
         			}
         
         
         
         		}
         
         		echo $emp_login_msg;
         
         	}
         
         	
         
         	if ($rec_bypass != "err"){
         
         
         
         		if ($_GET["delete"] == 'true') {
					db();
         			$res = db_query("DELETE FROM loop_timeclock_bonus WHERE id = " . $_REQUEST["id"]);
         
         		}
         
         		if ($_REQUEST["worker"] != -1)
         
         		{
         
         			$start_date = date('Y-m-d', $start_date);
         
         			$end_date_bonus = date('Y-m-d', $end_date);
         
         			$end_date = date('Y-m-d', $end_date + 86400);
         
					$end_date = strtotime($end_date);
					$end_date_ot = date('Y-m-d', $end_date);
         
         			if ($start_date > $end_date) {
         
         			echo "<font size=20>Nice Try, David - You thought I would not catch an error where the start date comes after the end date.</font>";
         
         		}
         
         
         
         		?>
     
      <?php
         $time = strtotime($start_date);
         
         $st_tuesday = strtotime('last tuesday', $time);
         
         $st_monday = strtotime('+6 days', $st_tuesday);
         
         ?>
      <table cellSpacing="1" cellPadding="3" width="800" border="0">
         <tr align="middle">
            <td colSpan="11" class="style7">
               TIMECLOCK REPORT FOR: 
               <?php
                  $query = "SELECT * FROM `loop_workers` WHERE id = " . $_REQUEST["worker"] ;
				
				  db();
                  $res = db_query($query);
                  
                  $row = array_shift($res);
                  
                  $name = $row["name"];
                  
                  $rate = $row["rate_cost"];
                  
                  echo "<b>".$row["name"]."</b>";
                  
                  ?>
            </td>
         </tr>
         <tr>
            <td class="style17" align="center">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               DATE</font>
            </td>
            <td class="style17" align="center">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               TIME IN</font>
            </td>
            <td class="style5" align="center">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               TIME OUT
            </td>
            <td align="middle" class="style16" align="center">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               AMOUNT
            </td>
            <td valign="middle" class="style16" align="center">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               TYPE
            </td>
            <td align="center" class="style16">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               IP CLOCK-IN
            </td>
            <td align="center" class="style16">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               IP CLOCK-OUT
            </td>
            <td align="center" class="style16">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               NOTES
            </td>
         </tr>
         <?php
            $query = "SELECT *, IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)) AS A, DATE_FORMAT(time_in, '%W, %M %d, %Y') AS D, TIME(time_in) AS T_I, TIME(time_out) AS T_O FROM loop_timeclock WHERE worker_id = " . $_REQUEST["worker"] . " ";
            
            if($_GET["start_date"] != "")
            
            {
            
             $query .= " AND time_in BETWEEN '$start_date'";
            
            }
            
            if($_GET["end_date"] != "")
            
            {
            
             $query .= " AND '$end_date'";
            
            }
            
            $query .= " order by time_in";
            
            db();
            $res = db_query($query);
            
            while($row = array_shift($res))
            
            {
            
            
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["D"]; ?>
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["T_I"]; ?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["T_O"]; ?>
            </td>
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
               <?php echo $row["A"]; ?>
            </td>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["type"];?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["ipaddress"];?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["ipaddress_clkout"];?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=left><font size=1><?php if ($row["time_in_old"] != "0000-00-00 00:00:00") echo $row["time_in_old"];?> <?php  if ($row["time_out_old"] != "0000-00-00 00:00:00") echo $row["time_out_old"];?> <?php echo $row["notes"];?></font></td>
         </tr>
         <?php
            }
            
         ?>
         <!-- For total row new code -->
         <?php
            $time = strtotime($start_date);
            
            if (date('l',$time) != "Tuesday") {
            
            	$st_tuesday = strtotime('last tuesday', $time);
            
            } else {
            
            	$st_tuesday = $time;
            
            }
            
            
            
            $st = strtotime($start_date);
            
			$ed = strtotime(strval($end_date));
            
            $st_monday = strtotime('+6 days', $st_tuesday);
            
            
            
            $overtime = 0; $overtime_production = 0;
            
            $regulartime = 0;
            
            while($st_tuesday < $ed)
            
            {
            
            	$query = "SELECT loop_timeclock.type, SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE  worker_id = " . $_REQUEST["worker"]  . " ";
            
            	if($_GET["start_date"] != "")
            
            	{
            
            	 $query .= " AND time_in BETWEEN '" . date('Y-m-d 00:00:00',$st_tuesday) . "'";
            
            	}
            
            	if($_GET["end_date"] != "")
            
            	{
            
            	 if ($st_monday < $ed) {
            
            	 $query .= " AND '" . date('Y-m-d 23:59:59',$st_monday) . "'";
            
            	 }
            
            	 else {
            
            		$query .= " AND '" . date('Y-m-d 23:59:59',$ed - 1) . "'";
            
            	 }
            
            	}
				
				db();
            	$res = db_query($query);
				
         
            
            	while($row = array_shift($res))
            
            	{
            
            
            
            		if (date('Y-m-d',$st_tuesday) < $start_date)
            
            		{
            
            			$fquery = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE  worker_id = " . $_REQUEST["worker"]  . " ";
            
        
            			$fquery .= " AND time_in BETWEEN '" . date('Y-m-d 00:00:00',$time) . "'";
            
						if ($st_monday < $ed) {
            
            			 $fquery .= " AND '" . date('Y-m-d 23:59:59',$st_monday) . "'";
            
            				 }
            
            			else {
            
            			$fquery .= " AND '" . date('Y-m-d 23:59:59',$ed - 1) . "'";
            
            			}
            
						db();
            
            			$fres = db_query($fquery);
            
            			$frow = array_shift($fres);
            
            			if (($row["DT"]/3600) > 40) 
            
            			{ 
            
            				$first_week_regular_time = $frow["DT"]/3600 - ($row["DT"]/3600 - 40);
            
            				if ($first_week_regular_time < 0) $first_week_regular_time = 0;
            
            				$first_week_overtime = ($row["DT"]/3600 - 40);
            
            			//	echo $first_week_overtime;
            
            				if ($first_week_overtime > $frow["DT"]/3600) $first_week_overtime = $frow["DT"]/3600;
            
            			} else
            
            			{
            
            				$first_week_regular_time = $frow["DT"]/3600;
            
            				$first_week_overtime = 0;
            
            			}
            
            
            
            			//echo date('m/d/Y',$time);
            
            		} else
            
            		{
            
            			//echo date('m/d/Y',$st_tuesday);	
            
            		}
            
            			//echo " - ";
            
            
            
            		if (date('Y-m-d',$st_monday) < $end_date)
            
            		{
            
            			//echo date('m/d/Y',$st_monday);
            
            		} else
            
            		{
            
            			//echo date('m/d/Y',$ed-1);	
            
            		}
            
            
            
            		if ($first_week == 1)
            
            		{
            
            				//echo number_format($first_week_regular_time,2);
            
            				$regulartime += $first_week_regular_time;
            
            		} else {
            
            				if (($row["DT"]/3600) > 40) { 
            
            					//echo number_format(40 ,2);
            
            					$regulartime += 40; 
            
            				} else { 
            
            					//echo number_format($row["DT"]/3600 ,2); 
            
            					$regulartime += number_format($row["DT"]/3600 ,2); 
            
            				}
            
            		}
            
            
            
            		if ($first_week == 1)
            
            		{
            
            			//echo number_format($first_week_overtime,2);
            
            			$overtime += $first_week_overtime;
            
            			if ($row["type"] == 'Production' || $row["type"] == 'kits' || $row["type"] == 'machines' ){
            
            				$overtime_production += $first_week_overtime;
            
            			}	
            
            		} else { 
            
            			if (($row["DT"]/3600) > 40) {
            
            				//echo number_format(($row["DT"]/3600)-40 ,2); 
            
							$overtime += (int)number_format($row["DT"]/3600,2) - 40; 
            
            				if ($row["type"] == 'Production' || $row["type"] == 'kits' || $row["type"] == 'machines' ){
            
            					$overtime_production += (int)number_format($row["DT"]/3600,2) - 40; 
            
            				}	
            
            			}
            
            				
            
            		}
            
            			$first_week = 0;
            
            
            
            			$production_val = $row["R"]*$row["P"];
            
            			
            
            			$tierIncresedVal =  number_format(($production_val * $row["tier_value"]), 2);
            
            			
            
            			if($tierIncresedVal == 'Invalid Tier Value'){
            
            				$grandTotal = number_format($production_val ,2);
            
            			}else{
            
							$grandTotal = number_format($production_val + floatval(str_replace(',', '', $tierIncresedVal)), 2);
            
            			}				
            
            
            
            			$pq     = "SELECT name, loop_workers.rate_cost AS RC, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))/3600 AS DT FROM loop_timeclock LEFT JOIN loop_workers ON loop_timeclock.worker_id = loop_workers.id WHERE (loop_timeclock.type LIKE '%Production' OR loop_timeclock.type LIKE '%kits' OR loop_timeclock.type LIKE '%achines') AND loop_timeclock.worker_id = " . $_REQUEST["worker"];
            
            			$pq .= " AND (time_in >= '" . $start_date1 . " 00:00:00' and time_in <= '" . $start_date1 . " 23:59:59') ";
            
            			db();
            
            			$pres       = db_query($pq);
            
            			$prow       = array_shift($pres);
            
            			$totalHours = $prow["DT"];
            
            			$hourlyRate = $prow["RC"];
            
            
            			$hourlyValue = ($totalHours * $hourlyRate);
            
            			//echo "bonus = " . $grandTotal . " - " . $hourlyValue . "<br>";
        
						$bonus =  floatval(str_replace(',', '', strval($grandTotal))) -  floatval(str_replace(',', '', strval($hourlyValue)));
            
            			$st_tuesday = strtotime('+7 days', $st_tuesday);
            
            			$st_monday = strtotime('+7 days', $st_monday);
            
            
            
            }
            
            	$reg_hrs=number_format($regulartime,2);
        
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $total_orders; ?>
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Total Hours
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo number_format($regulartime+$overtime,2); ?>  
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
         </tr>
      </table>
      <br/>
      <!-- For total row new code -->
      <table cellSpacing="1" cellPadding="3" width="950" border="0">
         <tr align="middle">
            <td colSpan="12" class="style7">
               PRODUCTION REPORT FOR: 
               <?php
                  $query = "SELECT * FROM `loop_workers` WHERE id = " . $_REQUEST["worker"] ;
				  
				  db();
                  $res = db_query($query);
                  
                  $row = array_shift($res);
                  
                  $name = $row["name"];
                  
                  echo "<b>".$row["name"]."</b>";
                  
                  ?>
            </td>
         </tr>
         <tr>
            <td class="style17">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               PRODUCTION DATE</font>
            </td>
            <td class="style17">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               ENTERED ON</font>
            </td>
            <td class="style17">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               RATE</font>
            </td>
            <td class="style5" >
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               PRODUCTION
            </td>
            <td align="middle" class="style5">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               SUBTOTAL
            </td>
            <td align="middle" class="style5">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               TIER INCREASE
            </td>
            <td align="middle" class="style5">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               GRAND TOTAL
            </td>
            <td align="middle" class="style5">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
               TIER
            </td>
            <td align="middle" class="style5">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">NOTES
            </td>
         </tr>
         <?php
            $query = "SELECT *, DATE_FORMAT(date, '%W, %M %d, %Y') AS D, rate AS R, production AS P, added_by AS addedEmp, added_on AS recordDate FROM loop_timeclock_production WHERE worker_id = " . $_REQUEST["worker"] . " ";
            
            if($_GET["start_date"] != "")
            
            {
            
             $query .= " AND date BETWEEN '$start_date'";
            
            }
            
            if($_GET["end_date"] != "")
            
            {
            
             $query .= " AND '$end_date' ORDER BY date ASC";
            
            }
            
            db();
            
            $res = db_query($query);
            
            $production_total=0;
            
            while($row = array_shift($res))
            {
            
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
            
            
            
            	//$new_rate= $row["R"]*$emp_tier_value;
            
            	$production_val = $row["R"]*$row["P"];
            
            	
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["D"]; ?>
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php 
                  if($row['recordDate'] != ''){
                  
                  	echo date("m/d/Y H:i:s", strtotime($row['recordDate'])).' ('.$row['addedEmp'].')';
                  
                  }
                  
                  ?>
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               $<?php echo number_format($row["R"],2); ?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["P"]; ?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               $<?php echo number_format($production_val,2);?>
            </td>
            <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               <?php               
                  $tierIncresedVal =  number_format(($production_val * $emp_tier_value), 2);
                  
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
            $production_total += str_replace(',', '', number_format($production_val,2));
            
            $bonusProTotal += $row["R"] * $row["P"];
            
              if($tierIncresedVal != 'Invalid Tier Value'){
            
                  $tierIncresedValTotal += $tierIncresedVal;
            
              }
            
              $grandTotalAll += str_replace(',', '', $grandTotal);
            
            }
            
            
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Total Production Value
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo "$".number_format($production_total,2); ?> 
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo "$".number_format($tierIncresedValTotal,2); ?>
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               <?php echo "$".number_format($grandTotalAll,2); ?>	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;border-top: 1px solid black;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
         </tr>
      </table>
      <br><br>
      <table width="28%" cellpadding="4">
         <tr align="middle">
            <td colSpan="5" class="style7"><b>Hours by Type Report for: <?php echo $name;?></b></td>
         </tr>
         <tr vAlign="center">
            <td class="style17" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">Type</font></td>
            <td class="style17" style="height: 22px;" align="center" colspan="3"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Total Hours
            </td>
         </tr>
         <?php
            $tq = "SELECT DISTINCT(type) FROM loop_timeclock WHERE time_in BETWEEN '$start_date' AND '$end_date'";
            
            
			db();
            $tres = db_query($tq);
            
            while($trow = array_shift($tres))
            
            {
            
            
            
            $query = "SELECT type, SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE type LIKE '%" . $trow["type"] ."' AND worker_id = " . $_REQUEST["worker"]  . " ";
            
            if($_GET["start_date"] != "")
            
            {
            
             $query .= " AND time_in BETWEEN '$start_date'";
            
            }
            
            if($_GET["end_date"] != "")
            
            {
            
             $query .= " AND '$end_date'";
            
            }
            
			db();
            $res = db_query($query);
            
            while($row = array_shift($res))
            
            {
            
            	  if($trow["type"]==$row["type"])
            
            	  {
            
            		  
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $trow["type"];?>
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Total Hours
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $row["ADT"]; ?> 
            </td>
            <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo number_format($row["DT"]/3600,2); ?>  
            </td>
         </tr>
         <?php 
            }
            
            }
            
            
            
            }
            
            ?>
      </table>
      <!------------- OVERTIME -------------------->
      <?php
         $time = strtotime($start_date);
         
         if (date('l',$time) != "Tuesday") {
         
         $st_tuesday = strtotime('last tuesday', $time);
         
         } else {
         
         $st_tuesday = $time;
         
         }
           
         $st = strtotime($start_date);
         
		 $ed = strtotime(strval($end_date));
         
         $st_monday = strtotime('+6 days', $st_tuesday);
        
         ?>
      <br><br>
      <table width="28%" cellpadding="4">
         <tr align="middle">
            <td colSpan="4" class="style7"><strong>Breakdown by Work Week Tues-Mon</strong><br><b><?php echo $name;?></b></td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Date Range
            </td>
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Regular Hours
            </td>
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Overtime Hours 
            </td>
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Bonus
            </td>
         </tr>
         <?php
            $overtime = 0;
            
            $regulartime = 0;
            
            while($st_tuesday < $ed)
            
            {
            
            $query = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE  worker_id = " . $_REQUEST["worker"]  . " ";
            
            if($_GET["start_date"] != "")
            
            {
            
             $query .= " AND time_in BETWEEN '" . date('Y-m-d 00:00:00',$st_tuesday) . "'";
            
            }
            
            if($_GET["end_date"] != "")
            
            {
            
             if ($st_monday < $ed) {
            
             $query .= " AND '" . date('Y-m-d 23:59:59',$st_monday) . "'";
            
             }
            
             else {
            
             $query .= " AND '" . date('Y-m-d 23:59:59',$ed - 1) . "'";
            
             }
            
            }
            
			db();
            $res = db_query($query);
            
            while($row = array_shift($res))
            
            {
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php
                  if (date('Y-m-d',$st_tuesday) < $start_date)
                  
                  {
                  
                  	//This is the first one. We also need to get the time from the start date to the end of the week
                  
                  	$fquery = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE  worker_id = " . $_REQUEST["worker"]  . " ";
                  
                  	
                  
                  	 $fquery .= " AND time_in BETWEEN '" . date('Y-m-d 00:00:00',$time) . "'";
                  
                  	
                  
                  		if ($st_monday < $ed) {
                  
                  	 $fquery .= " AND '" . date('Y-m-d 23:59:59',$st_monday) . "'";
                  
                  		 }
                  
                  	else {
                  
                  	$fquery .= " AND '" . date('Y-m-d 23:59:59',$ed - 1) . "'";
                  
                  	}
                  
				  db();
                  $fres = db_query($fquery);
                  
                  $frow = array_shift($fres);
                  
                  $first_week = 1;
                  
                  if (($row["DT"]/3600) > 40) 
                  
                  { 
                  
                  	$first_week_regular_time = $frow["DT"]/3600 - ($row["DT"]/3600 - 40);
                  
                  	if ($first_week_regular_time < 0) $first_week_regular_time = 0;
                  
                  	$first_week_overtime = ($row["DT"]/3600 - 40);
                  
                  //	echo $first_week_overtime;
                  
                  	if ($first_week_overtime > $frow["DT"]/3600) $first_week_overtime = $frow["DT"]/3600;
                  
                  //	echo $first_week_overtime;
                  
                  	//This is if there are more overtime hours for the entire week than hours in the pay pay period for the week.
                  
                  //	if ($first_week_overtime > ($row["DT"]/3600 - 40)) $first_week_overtime = ($row["DT"]/3600 - 40);
                  
                  //	echo $first_week_overtime;
                  
                  //	echo "-" . $first_week;
                  
                  } else
                  
                  {
                  
                  	$first_week_regular_time = $frow["DT"]/3600;
                  
                  	$first_week_overtime = 0;
                  
                  }
                  
                  
                  
                  	echo date('m/d/Y',$time);
                  
                  } else
                  
                  {
                  
                  	echo date('m/d/Y',$st_tuesday);	
                  
                  }
                  
                  	echo " - ";
                  
                  
                  
                  if (date('Y-m-d',$st_monday) < $end_date)
                  
                  {
                  
                  	echo date('m/d/Y',$st_monday);
                  
                  } else
                  
                  {
                  
                  	echo date('m/d/Y',$ed-1);	
                  
                  }
                  
                                    ?></font>
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align="right"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php
                  if ($first_week == 1)
                  
                  {
                  
                  echo number_format($first_week_regular_time,2);
                  
                  $regulartime += $first_week_regular_time;
                  
                  } else {
                  
                  if (($row["DT"]/3600) > 40) { echo number_format(40 ,2); $regulartime += 40; } else { echo number_format($row["DT"]/3600 ,2); $regulartime += number_format($row["DT"]/3600 ,2); }
                  
                  }
                  
                  ?>  
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php
                  if ($first_week == 1)
                  
                  {
                  
                  echo number_format($first_week_overtime,2);
                  
                  $overtime += $first_week_overtime;
                  
                  } else { 
                  
					if (($row["DT"]/3600) > 40) { echo number_format((float)($row["DT"]/3600)-40 ,2); $overtime += number_format($row["DT"]/3600,2) - 40; }
                  
                  		
                  
                  }
                  
                  $first_week = 0;
                  
                  ?> 
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
            </td>
         </tr>
         <?php 
            }
            
            $st_tuesday = strtotime('+7 days', $st_tuesday);
            
            $st_monday = strtotime('+7 days', $st_monday);
            
            }
            
            $reg_hrs=number_format($regulartime,2);
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px; border-top: 1px solid black;" align="right"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               TOTAL
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;border-top: 1px solid black;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo number_format($regulartime,2); ?>  
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;border-top: 1px solid black;" align="right"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo number_format($overtime,2); ?>  
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;border-top: 1px solid black;" align="right"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php 
                  $pq = "SELECT name, loop_workers.rate_cost AS RC, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))/3600 AS DT FROM loop_timeclock LEFT JOIN loop_workers ON loop_timeclock.worker_id = loop_workers.id 
                  
                  WHERE (loop_timeclock.type LIKE '%Production' OR loop_timeclock.type LIKE '%kits' OR loop_timeclock.type LIKE '%achines') AND loop_timeclock.worker_id = " . $_REQUEST["worker"];
                  
                  if($_GET["start_date"] != "qqq")
                  
                  {
                  
                   $pq .= " AND time_in BETWEEN '" . $start_date . "'";
                  
                  }
                  
                  if($_GET["end_date"] != "qqqq")
                  
                  {
                  
                   $pq .= " AND '" . $end_date . "'";
                  
                  }

                  db();
                  $pres = db_query($pq);
                  
                  $prow = array_shift($pres);
                  
                  $name = $prow["name"];
                  
                  $hours = $prow["DT"];
                  
                  $production_hours = $hours;
                  
                  
                  $query = "SELECT SUM( rate * production) AS P FROM loop_timeclock_production WHERE worker_id =  " . $_REQUEST["worker"];
                  
                  if($_GET["start_date"] != "q")
                  
                  {
                  
                   $query .= " AND date BETWEEN '" . $dt . "'";
                  
                  }
                  
                  if($_GET["end_date"] != "q")
                  
                  {
                  
                   $query .= " AND NOW()";
                  
                  }
                  
				  db();
                  $pres = db_query($query);
                  
                  $prow2 = array_shift($pres);
                  
                  
                  
                  			if (($prow["DT"] * $prow["RC"]) > 0 )
                  
                  			{ 	$efficiency = 100*$prow2["P"]/($prow["DT"] * $prow["RC"]); }
                  
                  			else{	$efficiency = 0; }
                  
                  			
                  
                  			$production_value = str_replace( ',', '', number_format((str_replace( ',', '', number_format($prow["DT"],2)) * $prow["RC"]),2));				
                  
							$production_bonus = str_replace(',', '', $grandTotalAll) - floatval(str_replace(',', '', number_format((str_replace(',', '', number_format($prow["DT"], 2)) * $prow["RC"]), 2)));
                  
                  		
                  			if ($production_bonus < 0){
                  
                  				echo "$0.00";
                  
                  				$production_bonus = 0;
                  
                  			}else{
                  
                  				echo "$" . number_format($production_bonus,2);
                  
                  			}			
                  
                  		?>  
            </td>
         </tr>
      </table>
      <br><br>
      <?php
        
         $query = "SELECT * FROM loop_timeclock_bonus WHERE worker_id =  " . $_REQUEST["worker"] . " AND date BETWEEN '" . $start_date . "' AND '" . $end_date_bonus  . "'";
						
		 db();
         $res = db_query($query);
         
                 if(tep_db_num_rows($res)>0)
         
                 {
         
         
         
         ?>
      <table width=28% cellpadding="4">
         <tr align="middle">
            <td colSpan="4" class="style7"><b>Other Bonus Report</b></td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Date
            </td>
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Amount
            </td>
            <td bgColor="#99FF99" class="style3" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Notes
            </td>
         </tr>
         <?php
            while ($brow = array_shift($res))
            
            {
            
            	$other_bonus = $other_bonus + $brow["amount"];
            
            ?>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo timestamp_to_date($brow["date"]);?>
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               $<?php echo number_format($brow["amount"],2);?>
            </td>
            <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo $brow["notes"];?>
            </td>
			</tr>
         <?php } ?>
      </table>
      <?php // $query; 
         }
         
         
         
         if ($bonus >= 0){
         
         $final_total_bonus = $other_bonus + $bonus;
         
         }else{
         
         $final_total_bonus = $other_bonus;
         
         }	
         
         
         
         ?>
      
      <?
         ?>
      <?
         } // end if != -1 (single person
         
 }
 else {
         
         	//To display the details when ALL option is selected
         
         	$start_date = date('Y-m-d', $start_date);
         
         	$end_date = date('Y-m-d', $end_date + 86400);
         
         
         
         	if ($start_date > $end_date) {
         
         	echo "<font size=20>Nice Try, David - You thought I would not catch an error where the start date comes after the end date.</font>";
         
         	}
         
         
         
         	?>
      <table border="0" cellspacing="1" cellpadding="2" >
         <tr>
            <td class="header_td_style">Warehouse name</td>
            <?php	
               $type_q = "SELECT DISTINCT(type) as typenm FROM loop_timeclock where type!='' order by type";
		
			   db();
               $type_res = db_query($type_q);
               
               while($type_row = array_shift($type_res))
               
               {
               
               	?> 
            <td class="header_td_style"><?php echo $type_row["typenm"]; ?></td>
            <?php  }	?>
         </tr>
         <?php
            if($start_date !="" && $end_date!="")
            
            {
            
            	//$type = "";	
            
            
            
            	$tq1 = "SELECT warehouse_id,warehouse_name FROM loop_timeclock inner join loop_warehouse on loop_timeclock.warehouse_id=loop_warehouse.id group by warehouse_id";
				
				db();
            	$tres1 = db_query($tq1);
            
            	while($trow1 = array_shift($tres1))
            
            	{
            
            ?>
         <tr vAlign="center">
            <td bgcolor="#E4EAEB" class="style3" style="height: 22px;">
               <?php echo $trow1['warehouse_name'];?>
            </td>
            <?php
               $type_q = "SELECT DISTINCT(type) as typenm FROM loop_timeclock where type!='' order by type";
               
			   db();
               $type_res = db_query($type_q);
               
               while($type_row = array_shift($type_res))
               
               {
               
               	$type_str = "'".$type_row['typenm']."'";
               
               
               
               	$query = "SELECT warehouse_id, type, SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock WHERE type = " . $type_str . " AND warehouse_id = ".$trow1['warehouse_id']."";
               
               	if($_GET["start_date"] != "")
               
               	{
               
               	 $query .= " AND time_in BETWEEN '$start_date'";
               
               	}
               
               	if($_GET["end_date"] != "")
               
               	{
               
               	 $query .= " AND '$end_date' group by type";
               
               	}
               
               
				db();
               	$res = db_query($query);
               
               	$rec_found = "no";
               
               	while($row = array_shift($res))
               
               	{
               
               		$rec_found = "yes";
               
               ?>
            <td bgcolor="#E4EAEB" class="style3" style="height: 22px;" align=right>
               <?php echo $row["ADT"]; ?> 
            </td>
            <?php } 
               if ($rec_found == "no") { ?>
            <td bgcolor="#E4EAEB" class="style3" style="height: 22px;" align=right>&nbsp;</td>
            <?php	}  ?>
            <?php
               } ?>
         </tr>
         <?php } ?>
         <tr>
            <td  bgcolor="#E4EAEB" style="font-size:8pt; font-weight:bold; height: 22px;">Total</td>
            <?php	
               $type_q = "SELECT DISTINCT(type) as typenm FROM loop_timeclock where type!='' order by type";
			   
			   db();
               $type_res = db_query($type_q);
               
               while($type_row = array_shift($type_res))
               
               {
               
               	$type_str = "'".$type_row['typenm']."'";
               
               
               
               	$query = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock WHERE type = " . $type_str ;
               
               	if($_GET["start_date"] != "")
               
               	{
               
               	 $query .= " AND time_in BETWEEN '$start_date'";
               
               	}
               
               	if($_GET["end_date"] != "")
               
               	{
               
               	 $query .= " AND '$end_date' group by type";
               
               	}
               
               
				db();
               	$res = db_query($query);
               
               	while($row = array_shift($res))
               
               	{
               
               ?>
            <td bgcolor="#E4EAEB" style="font-size:8pt; font-weight:bold; height: 22px;" align=right>
               <?php echo $row["ADT"]; ?>
            </td>
            <?php } 
               }	?>
         </tr>
         <?php }?>
      </table>
      <?php
         }
         
         ?>
      <?php
         }
         
            $rate = number_format($rate,2);
         
            $ovt=number_format($overtime,2);
         
            //echo $reg_hrs."-".$rate.number_format($overtime,2);;
         
            //
         
            $reg_hrs_n=str_replace(",", "", $reg_hrs);
         
            $ovt_n=str_replace(",", "", $ovt);
         
			$base_pay = floatval($reg_hrs_n) * floatval($rate) + (floatval($ovt_n) * 1.5 * floatval($rate));
         $final_pay_check = $base_pay + floatval($production_bonus) + floatval($other_bonus);
         
         ?>
      <br>
      <table width="28%" cellpadding="4">
         <tr vAlign="center">
            <td class="style7" style="height: 22px;" align="center" colspan="2">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><b>Production Bonus Calculation</b></font>
            </td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" align="left" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Hourly Rate
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               $<?php echo $rate;?>
            </td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" align="left" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Total Regular Hours (Production + Kits + Machines)
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php echo number_format($production_hours,2);?>
            </td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" align="left" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Hourly Value of Production
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                $<?php echo number_format($production_value,2);?>
            </td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" align="left" style="height: 22px;border-bottom: 1px solid black;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               Production Value
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;border-bottom: 1px solid black;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <?php $grandTotalAll = floatval($grandTotalAll);
               $grandTotalAllFormatted = number_format($grandTotalAll, 2);
               echo "$".$grandTotalAllFormatted;?>
            </td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" align="left" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <b>Difference</b>
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               $<?php echo number_format($grandTotalAll-$production_value,2);?>
            </td>
         </tr>
      </table>
      <br>
      <table width="28%" cellpadding="4">
         <tr vAlign="center">
            <td class="style7" style="height: 22px;border-bottom: 1px solid black;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><b>Hourly Pay</b></font></td>
            <td class="style7" style="height: 22px;border-bottom: 1px solid black;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><b>Production Bonus</b></td>
            <td class="style7" style="height: 22px;border-bottom: 1px solid black;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><b>Other Bonus</b></td>
            <td class="style7" style="height: 22px;border-bottom: 1px solid black;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><b>Total Pay</b></td>
         </tr>
         <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <b>$<?php echo number_format($base_pay,2);?></b>
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <b>$<?php echo number_format(floatval($production_bonus),2);?></b>
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <b>$<?php echo number_format($other_bonus,2);?></b>
            </td>
            <td bgColor="#e4e4e4" class="style3" align="right" style="height: 22px;">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               <b>$<?php echo number_format($final_pay_check,2);?></b>
            </td>
         </tr>
      </table>
      <?php
         } // end if "run"
         
                                                                                          
         
         ?>
      <br>
      <?php  
         ?>
      <br><br>
   </body>
</html>
