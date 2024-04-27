<?  
   require ("inc/header_session.php");
   require ("mainfunctions/database.php");
   require ("mainfunctions/general-functions.php");
   
   ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
   <head>
      <title>Manager Timeclock & Production Summary Reports</title>
      <style type="text/css">
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
         font-size:14px;
         color: #333333;
         font-weight: normal;
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
         /*table {
         border-collapse: collapse;
         background: #FFF;
         table-layout: fixed;
         width: 70%;
         }
         table thead {
         position: fixed;
         top: 0;
         left: 0;
         width: 100%;
         background: #FFF;
         display: table;
         table-layout: fixed;
         border: solid 1px #000;
         }
         table tbody {
         margin-top: 24px;
         }
         table {
         border: 1px solid black;
         }
         td,
         th {
         height: 20px;
         border: 1px solid black;
         }*/
         table.datatable {
         border-collapse: collapse;
         background: #FFF;
         width: 70%;
         }
         /*table thead {
         position: fixed;
         top: 0;
         left: 0;
         width: 100%;
         background: #FFF;
         display: table;
         table-layout: fixed;
         border: solid 1px #000;
         }*/
         table.datatable tbody {
         margin-top: 24px;
         }
         table.datatable {
         border: 1px solid white;
         }
         table.datatable tr td,
         table.datatable tr th {
         height: 20px;
         border: 1px solid white;
         padding: 5px;
         }
      </style>
      <style>
      </style>
      <link href="css/timeclock_reports.css" rel="stylesheet">
      <LINK rel='stylesheet' type='text/css' href='one_style.css' >
      <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
      <link rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>
   </head>
   <body>
      <? include("inc/header.php"); ?>
      <div class="main_data_css">
         <div class="dashboard_heading" style="float: left;">
            <div style="float: left;">
               Manager Timeclock & Production Summary Reports
               <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
                  <span class="tooltiptext">
                  This report shows the users various summaries that relate to the timeclock and production within a provided time period.
                  </span>
               </div>
               <div style="height: 13px;">&nbsp;</div>
            </div>
         </div>
         <?php
            // echo "<LINK rel='stylesheet' type='text/css' href='one_style.css' >";
            ?>
         <form name="rptSearch" action="" method="GET">
            <input type="hidden" name="action" value="run">
            <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
            <span class="style14">
               <span class="style15">
                  <input type=hidden name="worker" value=0>
                  <table class="navi_table">
                     <tr>
                        <td align="left">
                           <a href="Timeclock_Manager.php">TimeclockDK3</a>
                        </td>
                        <td align="left">
                           <a href="Warehouse_Hours_Review.php" >Manager Review</a>
                        </td>
                        <td align="left">
                           <a href="Staffing_Summary.php" class="active_link">Staffing Summary</a>
                        </td>
                        <td align="left">
                           <a href="Warehouse_Hours_Payroll.php">Payroll Summary</a>
                        </td>
                        <td align="left">
                           <a href="Warehouse_Analysis.php">Time by Status by Location</a>
                        </td>
                        <td align="left">
                           <a href="warehouse_production_report.php">Production Report</a>
                        </td>
                        <td align="left">
                           <a href="report_leaderboard_mgr.php">Leaderboard Manager</a>
                        </td>
                        <td align="left">
                           <a href="report_unprocessed_inbound_trailers_report.php">Unprocessed Inbound Trailers Report</a>
                        </td>
                     </tr>
                     <tr>
                        <?php
                           $chkinitials =  $_COOKIE['userinitials'];
                           $emp_level_qry = db_query("SELECT * FROM loop_employees where initials = '" . $chkinitials . "'",db());
                           $emp_level_res = array_shift($emp_level_qry);
                           if($emp_level_res["level"]==2)
                           {
                           
                           ?>
                        <td align="left">
                           <a href="HV_Hours_Review.php" >HV Manager Review</a>
                        </td>
                        <td align="left">
                           <a href="HA_Hours_Review.php" >HA Manager Review</a>
                        </td>
                        <td align="left">
                           <a href="ML_Hours_Review.php" >ML Manager Review</a>
                        </td>
                        <td align="left">
                           <a href="HVP_Hours_Review.php" >HVP Manager Review</a>
                        </td>
                        <td>
                           <a href="MLC_Hours_Review.php" >McCormick MLC Manager Review</a>
                        </td>
                        <td align="left">
                           <a href="LA_Hours_Review.php" >LA Manager Review</a>
                        </td>
                        <td align="left">
                           <a href="MckFMC_Hours_Review.php" >McCormick FMC Manager Review</a>
                        </td>
                        <?php
                           }
                           ?>
                     </tr>
                  </table>
                  <br>
                  <SCRIPT LANGUAGE="JavaScript" SRC="inc/CalendarPopup.js"></SCRIPT>
                  <script LANGUAGE="JavaScript">document.write(getCalendarStyles());</script>
                  <script LANGUAGE="JavaScript">
                     var cal1xx = new CalendarPopup("listdiv");
                     cal1xx.showNavigationDropdowns();
                     var cal2xx = new CalendarPopup("listdiv");
                     cal2xx.showNavigationDropdowns();
                  </script>
                  <?
                     $start_date = isset($_GET["start_date"])?strtotime($_GET["start_date"]):strtotime(date('m/d/Y'));
                     $end_date = isset($_GET["end_date"])?strtotime($_GET["end_date"]):strtotime(date('m/d/Y'));
                     ?>
                  <table class="date_table">
                     <tr>
                        <td>
                           <font face="Arial, Helvetica, sans-serif" color="#333333" size="2"> From: <input type="text" name="start_date" size="11" value="<?=(isset($_GET["start_date"]) && $_GET["start_date"] != "")?date('m/d/Y', $start_date):""?>"> <a href="#" onclick="cal1xx.select(document.rptSearch.start_date,'anchor1xx','MM/dd/yyyy'); return false;" name="anchor1xx" id="anchor1xx"><img border="0" src="images/calendar.jpg"></a> </font>
                        </td>
                        <td>
                           <font face="Arial, Helvetica, sans-serif" color="#333333" size="2">To: <input type="text" name="end_date" size="11" value="<?=(isset($_GET["end_date"]) && $_GET["start_date"] != "")?date('m/d/Y', $end_date):""?>"> <a href="#" onclick="cal1xx.select(document.rptSearch.end_date,'anchor2xx','MM/dd/yyyy'); return false;" name="anchor2xx" id="anchor2xx"><img border="0" src="images/calendar.jpg"></a></font>
                        </td>
                        <td>
                           &nbsp; <input type="submit" value="Search">
                        </td>
                     </tr>
                  </table>
         </form>
         <div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>
         <br></span></span>
         <table width="70%" class="datatable">
         <tbody class="content">
            <?php
               if ($_GET["action"] == 'run') {
               if ($_REQUEST["worker"] != -1)
               {
                   ?>
            <tr>
               <td colspan="12" bgcolor="#FFCC66" style="font-size: 12px; font-weight: bold;text-align: center;">
                  Staffing Summary
               </td>
            </tr>
            <?
               $start_date = isset($_GET["start_date"])?strtotime($_GET["start_date"]):strtotime(date('m/d/Y'));
               $end_date = isset($_GET["end_date"])?strtotime($_GET["end_date"]):strtotime(date('m/d/Y'));
               
               
               
               $start_date = date('Y-m-d', $start_date);
               $end_date = date('Y-m-d', $end_date + 86400);
                   
               	   $AFE=db_query("SELECT * FROM loop_warehouse where id in (15, 4880)",db());
               	   while($AFERes=array_shift($AFE))
               	   {
               			//Siddhesh Bhatkar - Fetching worker which is from warehouse 15
               	   		$CheckEventsIsAvail=tep_db_num_rows(db_query("SELECT * FROM loop_workers WHERE warehouse_id='".$AFERes['id']."'",db()));


               	   		if($CheckEventsIsAvail>0){
                               
               			 /*$sqlw = "SELECT DISTINCT worker_id AS WID FROM loop_timeclock INNER JOIN loop_workers ON loop_workers.id = loop_timeclock.worker_id WHERE loop_timeclock.time_in BETWEEN '" . $start_date . "' AND '" . $end_date . "' and loop_workers.warehouse_id='".$AFERes['id']."' ORDER BY loop_workers.warehouse_id ASC, loop_workers.name ASC";
                           $resultw = db_query($sqlw,db() );
                           while ($roww = array_shift($resultw)) {
                               echo "<tr><td colspan='12'>test".$roww["WID"]."</td></tr>";
                           }*/
                          
               
               			// "SELECT DISTINCT warehouse_id  FROM loop_workers INNER JOIN loop_warehouse ON loop_workers.warehouse_id = loop_warehouse.id ORDER BY warehouse_id.warehouse_id ASC";
               			$sqlw = "SELECT DISTINCT worker_id AS WID FROM loop_timeclock INNER JOIN loop_workers ON loop_workers.id = loop_timeclock.worker_id WHERE loop_timeclock.time_in BETWEEN '" . $start_date . "' AND '" . $end_date . "' and loop_workers.warehouse_id='".$AFERes['id']."' ORDER BY loop_workers.warehouse_id ASC, loop_workers.name ASC";
               			//echo $sqlw . "<br>"; die();
               			$resultw = db_query($sqlw,db() );
               			if(tep_db_num_rows($resultw)>0)
               			{
                                   
               				$nickname = get_nickname_val($AFERes["company_name"], $AFERes["b2bid"]);
               
               				$location.= $nickname."|";
               				
                               ?>
            
            <?php if($AFERes['id'] == '15'){ ?>
            	<tr>
               		<td colspan="12" bgcolor="#d6d6d6" style="font-size: 12px; font-weight: bold;">
                  		<?php echo $nickname; ?>
               		</td>
            	</tr>
	            <tr>
	               <th bgcolor="#99FF99" class="style3" style="height: 22px;" width=150 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Name</strong></font></th>
	               <th bgColor="#99FF99" class="style3" style="height: 22px;" width=50 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Regular Hours</strong></font></th>
	               <!--<th bgColor="#99FF99" class="style3" style="height: 22px;" width=50 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Rate</strong></font></th>-->
	               <th bgColor="#99FF99" class="style3" style="height: 22px;" width=50 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Regular Pay Rate</strong></font></th>
	               <th bgColor="#99FF99" class="style3" style="height: 22px;" width=50 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Loaded Reg Rate</strong></font></th>
	               <th bgColor="#99FF99" class="style3" style="height: 22px;" width=50 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Overtime Hours</strong></font></th>
	               <th bgColor="#99FF99" class="style3" style="height: 22px;" width=50 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Overtime Rate</strong></font></th>
	               <th bgColor="#99FF99" class="style3" style="height: 22px;" width=50 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Loaded OT Rate</strong></font></th>
	               <th bgColor="#99FF99" class="style3" style="height: 22px;" width=50 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Hourly Pay Total</strong></font></th>
	               <th bgColor="#99FF99" class="style3" style="height: 22px;" width=50 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Loaded Hourly Total</strong></font></th>
	               <th bgColor="#99FF99" class="style3" style="height: 22px;" width=50 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Billing Rate</strong></font></th>
	               <th bgColor="#99FF99" class="style3" style="height: 22px;" width=50 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Billing OT Rate</strong></th>
	               <th bgColor="#99FF99" class="style3" style="height: 22px;" width=50 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Billing Total</strong></th>
	            </tr>
    		<?php }else {?>
    			<tr>
               		<td colspan="9" bgcolor="#d6d6d6" style="font-size: 12px; font-weight: bold;">
                  		<?php echo $nickname; ?>
               		</td>
            	</tr>
    			<tr>
					<th bgcolor="#99FF99" class="style3" style="height: 22px;" width=150 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Name</strong></font></th>
					<th bgColor="#99FF99" class="style3" style="height: 22px;" width=50 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Regular Hours</strong></font></th>
					<th bgColor="#99FF99" class="style3" style="height: 22px;" width=50 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Regular Rate</strong></font></th>
					<th bgColor="#99FF99" class="style3" style="height: 22px;" width=50 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Overtime Hours</strong></font></th>
					<th bgColor="#99FF99" class="style3" style="height: 22px;" width=50 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Overtime Rate</strong></font></th>
					<th bgColor="#99FF99" class="style3" style="height: 22px;" width=50 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Hourly Total</strong></font></th>
					<th bgColor="#99FF99" class="style3" style="height: 22px;" width=50 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Billing Rate</strong></font></th>
					<th bgColor="#99FF99" class="style3" style="height: 22px;" width=50 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Billing OT Rate</strong></th>
					<th bgColor="#99FF99" class="style3" style="height: 22px;" width=50 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Billing Total</strong></th>
				</tr>
        	<?php } ?>
            <?php
               while ($roww = array_shift($resultw)) {
               	/*$w_query=db_query("select * loop_warehouse where id=".$roww["warehouse_id"],db());
               	$w_row = array_shift($w_query);
                  echo $w_row["warehouse_id"];*/
               
               	$start_date = isset($_GET["start_date"])?strtotime($_GET["start_date"]):strtotime(date('m/d/Y'));
               	$end_date = isset($_GET["end_date"])?strtotime($_GET["end_date"]):strtotime(date('m/d/Y'));
               
               	$start_date = date('Y-m-d', $start_date);
               	$end_date = date('Y-m-d', $end_date + 86400);
               	$end_date_ot = date('Y-m-d', $end_date);
               
               	if ($start_date > $end_date) {
               		echo "<font size=20>Nice Try, David - You thought I would not catch an error where the start date comes after the end date.</font>";
               	}
               
            ?>
            <?php
               // echo $query_clicks;
            ?>
            <?php
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
            <?php
               $query = "SELECT * FROM `loop_workers` WHERE id = " . $roww["WID"] ;
               $res = db_query($query,db());
               $row = array_shift($res);
               $name = $row["name"];
               $emp_type = $row["employee_type"];   
               $worker_id = $row["id"];
               $rate = $row["rate_cost"];
               $rate_cost = $row["rate_cost"];
               $billing_rate = $row["bill_rate"];
           	?>
            <?php
               $query = "SELECT *, DATE_FORMAT(date, '%W, %M %d, %Y') AS D, rate AS R, production AS P FROM loop_timeclock_production WHERE worker_id = " . $roww["WID"] . " ";
               if($_GET["start_date"] != "")
               {
                $query .= " AND date BETWEEN '$start_date'";
               }
               if($_GET["end_date"] != "")
               {
                $query .= " AND '$end_date' ORDER BY date ASC";
               }
               // echo $query;
               $res = db_query($query,db());
               $production_total=0;
               while($row = array_shift($res))
               {
               
           	?>
            <?php
               $production_total+=$row["R"] * $row["P"];
               }
               
           	?>
            <?php
               $time = strtotime($start_date);
               if (date('l',$time) != "Tuesday") {
               $st_tuesday = strtotime('last tuesday', $time);
               } else {
               $st_tuesday = $time;
               }
               //echo $start_date . "<BR>";
               $st = strtotime($start_date);
               $ed = strtotime($end_date);
               //echo $time . "<BR>";
               //echo $st_tuesday;"<BR>";
               //echo date('Y-m-d 00:00:01',$time) . "<BR>";
               //echo date('Y-m-d 00:00:01',$st_tuesday). "<BR>";
               $st_monday = strtotime('+6 days', $st_tuesday);
               //echo date('Y-m-d 23:59:59',$st_monday);
               
               //echo "time: " . $time . "<br>";
               //echo "start_date: " . $start_date . "<br>";
               //echo "st_sunday: " . $st_tuesday . "<br>";
               //echo "st: " . $st . "<br>";
               //echo "ed: " . $ed . "<br>";
               //echo "end_date: " . $end_date . "<br>";
               
           	?>
            <?
               $overtime = 0;
               $regulartime = 0;
               while($st_tuesday < $ed)
               {
               $query = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE  worker_id = " . $roww["WID"]  . " ";
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
               $res = db_query($query,db());
               //echo $query . "<br><br>";
               while($row = array_shift($res))
               {
           	?>
            <?php
               if (date('Y-m-d',$st_tuesday) < $start_date)
               {
               	//This is the first one. We also need to get the time from the start date to the end of the week
               	$fquery = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE  worker_id = " . $roww["WID"]  . " ";
               	
               	 $fquery .= " AND time_in BETWEEN '" . date('Y-m-d 00:00:00',$time) . "'";
               	
                   if ($st_monday < $ed) {
               	   $fquery .= " AND '" . date('Y-m-d 23:59:59',$st_monday) . "'";
                   }
                	else {
                	  $fquery .= " AND '" . date('Y-m-d 23:59:59',$ed - 1) . "'";
                	}
               
               $fres = db_query($fquery,db());
               //echo $fquery . "<br><br>";
               $frow = array_shift($fres);
               
               $first_week = 1;
               
               if (($row["DT"]/3600) > 40) 
               { 
               	$first_week_regular_time = $frow["DT"]/3600 - ($row["DT"]/3600 - 40);
               	if ($first_week_regular_time < 0) $first_week_regular_time = 0;
               	   $first_week_overtime = ($row["DT"]/3600 - 40);
               	if ($first_week_overtime > $frow["DT"]/3600) $first_week_overtime = $frow["DT"]/3600;
               } 
               else
               {
               	$first_week_regular_time = $frow["DT"]/3600;
               	$first_week_overtime = 0;
               }
               //	echo date('m/d/Y',$time);
               } else
               {
               //	echo date('m/d/Y',$st_tuesday);	
               }
               //	echo " - ";
               
               if (date('Y-m-d',$st_monday) < $end_date)
               {
               //	echo date('m/d/Y',$st_monday);
               } else
               {
               //	echo date('m/d/Y',$ed-1);	
               }
               ?>
            <? 
               if ($first_week == 1)
               {
               //		echo number_format($first_week_regular_time,2);
               $regulartime += $first_week_regular_time;
               } else {
               if (($row["DT"]/3600) > 40) { 
               //			echo number_format(40 ,2); 
               	$regulartime += 40; } else { 
               //			echo number_format($row["DT"]/3600 ,2); 
               	$regulartime += number_format($row["DT"]/3600,2); }
               }
               ?>  
            <?
               if ($first_week == 1)
               {
               //		echo number_format($first_week_overtime,2);
                 $overtime += $first_week_overtime;
               } else { 
               if (($row["DT"]/3600) > 40) { 
               //			echo number_format(($row["DT"]/3600)-40 ,2); 
               	$overtime += number_format($row["DT"]/3600,2) - 40; }	
               }
               $first_week = 0;
               ?> 
            <?php 
               }
                   $st_tuesday = strtotime('+7 days', $st_tuesday);
                   $st_monday = strtotime('+7 days', $st_monday);
               }
               ?>
            <? 
               $pq = "SELECT name, loop_workers.rate_cost AS RC, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))/3600 AS DT FROM loop_timeclock LEFT JOIN loop_workers ON loop_timeclock.worker_id = loop_workers.id WHERE (loop_timeclock.type LIKE '%Production' OR loop_timeclock.type LIKE '%kits' OR loop_timeclock.type LIKE '%achines') AND loop_timeclock.worker_id = " . $roww["WID"];
               if($_GET["start_date"] != "qqq")
               {
               $pq .= " AND time_in BETWEEN '" . $start_date . "'";
               }
               if($_GET["end_date"] != "qqqq")
               {
               $pq .= " AND '" . $end_date . "'";
               }
               $pres = db_query($pq,db());
               $prow = array_shift($pres);
               //$name = $prow["name"];
               $hours = $prow["DT"];
               $query = "SELECT SUM( rate * production) AS P FROM loop_timeclock_production WHERE worker_id =  " . $roww["WID"];
               if($_GET["start_date"] != "q")
               {
               $query .= " AND date BETWEEN '" . $dt . "'";
               }
               if($_GET["end_date"] != "q")
               {
               $query .= " AND NOW()";
               }
               $pres = db_query($query,db());
               $prow2 = array_shift($pres);
               
                  if (($prow["DT"] * $prow["RC"]) > 0 )
                  { 	
                      $efficiency = 100*$prow2["P"]/($prow["DT"] * $prow["RC"]);
                  }
                  else
                  {	
                      $efficiency = 0; 
                  }
                  $bonus = $production_total - ($prow["DT"] * $prow["RC"]);
               
                  $obqry = "SELECT SUM(amount) AS OB FROM loop_timeclock_bonus WHERE worker_id = " . $roww["WID"] . " AND date BETWEEN '" . $start_date . "' AND '" . $end_date . "'" ;
                  $obres = db_query($obqry,db());
                  $obrow = array_shift($obres);
                  $other_bonus = $obrow["OB"];
                  $total_bonus = $obrow["OB"] + $bonus;
               ?>  
            <? if ($regulartime > 0 ) { 
               $overtime = number_format($overtime,2);
               $regulartime = number_format($regulartime,2);
               $rate1 = number_format($rate,2);
                  //
                      $billing_rate2 = number_format($billing_rate,2);
                      if($billing_rate2!="")
                      {
                          $billing_rate = number_format($billing_rate2,2);
                      }
                      else{
                          $billing_rate = 0.00;
                      }
                  
                  if($emp_type=="UCB Employee") 
                  {
          	   			if($AFERes['id'] == 15){

                      		$rate=$rate1*1.23;
                      	}else{
                      		$rate=$rate1*1.24; 
                      	}
                  }
                  else{
                      $rate=$rate1;
                  }
                      
               $billing_rate1 = number_format($billing_rate,2);
                   $billing_ot_rate=$billing_rate1*1.5;    
                      
                   $hours_t=number_format($regulartime * $rate_cost + $overtime * $rate_cost*1.5,2);
               ?>
            <?php if($AFERes['id'] == 15){ ?>
            <tr>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=150 align=left><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
                  <a href="https://loops.usedcardboardboxes.com/report_timeclockZF.php?action=run&worker=<?=$worker_id;?>&type=&start_date=<?=$_GET["start_date"];?>&end_date=<?=$_GET["end_date"];?>" target="_blank">
                  <?=$name;?>
                  </a>
               </td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><?=$regulartime;?></td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">$<?=$rate_cost;?></td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">$<?=$rate;?></td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
                  <?
                     if($overtime>0)
                     {
                           echo "<span style='color:#FF0000'>".$overtime."</span>";
                     }
                     else{
                           echo $overtime;
                     }
                     ?>
                  </font>
               </td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">$<?=number_format($rate_cost*1.5,2);?></td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">$<?=number_format($rate*1.5,2);?></td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">$<?=number_format($regulartime * $rate_cost + $overtime * $rate_cost*1.5,2);?></td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">$<?=number_format($regulartime * $rate + $overtime * $rate*1.5,2);?></td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">$<?=number_format($billing_rate,2);?></td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">$<?=number_format($billing_ot_rate,2);?></td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">$<?=number_format($regulartime * $billing_rate + $overtime * $billing_rate*1.5,2);?></td>
            </tr>
        	<?php } else{ ?>
    		<tr>
				<td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=150 align=left><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
			        <a href="https://loops.usedcardboardboxes.com/report_timeclockZF.php?action=run&worker=<?=$worker_id;?>&type=&start_date=<?=$_GET["start_date"];?>&end_date=<?=$_GET["end_date"];?>" target="_blank">
			            <?=$name;?>
			        </a></td>
				<td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><?=$regulartime;?></td>
				<td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">$<?=$rate;?></td>
				<td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
			         <?
			        if($overtime>0)
			        {
			              echo "<span style='color:#FF0000'>".$overtime."</span>";
			        }
			        else{
			              echo $overtime;
			        }
			        ?>
			        </font>
			        </td>
				<td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">$<?=number_format($rate*1.5,2);?></td>
				<td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">$<?=number_format($regulartime * $rate + $overtime * $rate*1.5,2);?></td>
				<td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">$<?=number_format($billing_rate,2);?></td>
				<td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">$<?=number_format($billing_ot_rate,2);?></td>
			    <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">$<?=number_format($regulartime * $billing_rate + $overtime * $billing_rate*1.5,2);?></td>
			</tr>
        	<?php } ?>
            <?
               //Total
                  $d=str_replace(",", "", $hours_t);
               // echo $billing_rate;
               
                  }//if ($regulartime > 0 )
               $total_regular_hrs=bcadd($total_regular_hrs, $regulartime,2);
               $total_overtime_hrs=bcadd($total_overtime_hrs, $overtime,2);
               
               $total_h=bcadd($total_h, $d,2);
               
               
               $billing_total1=number_format($regulartime * $billing_rate + $overtime * $billing_rate*1.5,2);
               //
               $bt=str_replace(",", "", $billing_total1);
               $billing_total=bcadd($billing_total, $bt,2);
               
               //
               //echo $d."--".$total_h."--"."<br><br>";
               }//end while ($roww = array_shift($resultw)) {
               //
               //hard code employee - The Manager, Bob Windsor $39,586.21 $50,621.50
               if($AFERes['id']==15)
               {
                  //$total_h=$total_h+2325.00;
                  //$billing_total=$billing_total+2276.00;
               $total_h=$total_h+2841.67;
               $billing_total=$billing_total+3128.13
                  ?> 
            <tr>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=150 align=left><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
                  Bob Windsor
               </td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"></td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"></td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
                  </font>
               </td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"></td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"></td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"></td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">$2,841.67</td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"></td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Ar
                  ial, Helvetica, sans-serif" color="#333333" size="1"></td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Ar
                  ial, Helvetica, sans-serif" color="#333333" size="1"></td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">$3,128.13</td>
            </tr>
            <?
               }//End hard code employee row
               
               //
               $f_total_regular_hrs.=$total_regular_hrs."|";
               $f_total_overtime_hrs.=$total_overtime_hrs."|";
               //$f_total_h=$;
               $f_total_h.=$total_h."|";
               $f_billing_total.=$billing_total."|";
               
               //
                   $final_total_regular_hrs=$final_total_regular_hrs+$total_regular_hrs;
                   $final_total_overtime_hrs=$final_total_overtime_hrs+$total_overtime_hrs;
                   $final_total_h=$final_total_h+$total_h;
                   $final_billing_total=$final_billing_total+$billing_total;
               
                   
               ?>
               <?php if($AFERes['id']==15) { ?>
            <tr>
               <td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold;">Total</td>
               <td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold;" align="right"><?=number_format($total_regular_hrs,2)?></td>
               <td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold;" align="right"></td>
               <td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold;" align="right"></td>
               <td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold;" align="right"><?=number_format($total_overtime_hrs,2)?></td>
               <td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold;"></td>
               <td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold;"></td>
               <td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold;" align="right">
                  $<?=number_format($total_h,2)?>
               </td>
               <td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold;" align="right"></td>
               <td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold;" align="right"></td>
               <td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold;" align="right"></td>
               <td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold;" align="right">$<?=number_format($billing_total,2)?></td>
            </tr>
        	<?php }else{ ?>
        		<tr><td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold;">Total</td>
        			<td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold;" align="right"><?=number_format($total_regular_hrs,2)?></td>
        			<td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold;" align="right"></td>
        			<td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold;" align="right"><?=number_format($total_overtime_hrs,2)?></td>
        			<td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold;"></td>
        			<td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold;" align="right">$<?=number_format($total_h,2)?></td>
        			<td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold;" align="right"></td>
        			<td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold;" align="right"></td>
        			<td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold;" align="right">$<?=number_format($billing_total,2)?></td>
    </tr>
        	<?php } ?>
            <tr>
               <td colspan="12" bgcolor="#FFFFFF" height="4px"></td>
            </tr>
            <?
               }
                     $total_regular_hrs=0;
                     $total_overtime_hrs=0;
                     $total_h=0;
                     $billing_total=0;
               
                 }//end if($CheckEventsIsAvail>0)
                        
               }//end loop warehouse while(
                 ?>
            <tr>
               <td colspan="5" bgcolor="#3F3F3F" height="4px" style="color: #FFFFFF;">Summary Table</td>
            </tr>
            <tr>
               <td bgcolor="#C0CDDA" class="style3" style="height: 22px;" width=150 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">Location</font></td>
               <td bgColor="#C0CDDA" class="style3" style="height: 22px;" width=50 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">Regular Hours</font></td>
               <td bgColor="#C0CDDA" class="style3" style="height: 22px;" width=50 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">Overtime Hours</font></td>
               <td bgColor="#C0CDDA" class="style3" style="height: 22px;" width=50 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">Hourly Total</td>
               <td bgColor="#C0CDDA" class="style3" style="height: 22px;" width=50 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">Billing Total</font></td>
            </tr>
            <?
               $new_l=rtrim($location,"| ");
               $arr = explode('|',$new_l);
               //
               $new_r_h=rtrim($f_total_regular_hrs,"| ");
               $arr_new_r_h = explode('|',$new_r_h);
               //
               $new_ot_h=rtrim($f_total_overtime_hrs,"| ");
               $arr_new_ot_h = explode('|',$new_ot_h);
               //
               $new_h=rtrim($f_total_h,"| ");
               $arr_new_h = explode('|',$new_h);
               //
               $new_b_t=rtrim($f_billing_total,"| ");
               $arr_new_b_t = explode('|',$new_b_t);
               //
               
               //
               foreach($arr as $i =>$key) {
               //foreach($arr as $i){ 
               ?>
            <tr>
               <td  bgcolor="#e4e4e4" style="font-size: 11px; font-weight: normal; font-family: 'Arial';"><?//=$location?>
                  <? echo($key.'<br>'); ?>
               </td>
               <td bgcolor="#e4e4e4" style="font-size: 11px; font-weight: normal; font-family: 'Arial';" align="right">
                  <?=number_format($arr_new_r_h[$i],2)?>
               </td>
               <td bgcolor="#e4e4e4" style="font-size: 11px; font-weight: normal; font-family: 'Arial';" align="right"><?=number_format($arr_new_ot_h[$i],2)?></td>
               <!--  <td bgcolor="#e4e4e4" style="font-size: 12px; font-weight: normal;" align="right">$<?//=$arr_new_t_p[$i]?></td>-->
               <td bgcolor="#e4e4e4" style="font-size: 11px; font-weight: normal; font-family: 'Arial';" align="right">$<?=number_format($arr_new_h[$i],2)?></td>
               <!--<td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold;" align="right"><?//=number_format($total_h,2)?></td>-->
               <td bgcolor="#e4e4e4" style="font-size: 11px; font-weight: normal; font-family: 'Arial';" align="right">$<?=number_format($arr_new_b_t[$i],2)?></td>
               <!--<td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold;"></td>
                  <td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold;"></td>
                  <td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold;"></td>-->
            </tr>
            <?
               }
               ?>
            <tr>
               <td  bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold; font-family: 'Arial'">Grand Total
               </td>
               <td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold; font-family: 'Arial'" align="right">
                  <?=number_format($final_total_regular_hrs,2)?>
               </td>
               <td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold; font-family: 'Arial';" align="right"><?=number_format($final_total_overtime_hrs,2)?></td>
               <td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold; font-family: 'Arial';" align="right">$<?=number_format($final_total_h,2)?></td>
               <td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold; font-family: 'Arial';" align="right">$<?=number_format($final_billing_total,2)?></td>
               <!--<td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold;" align="right"><?//=number_format($total_h,2)?></td>-->
               <!--<td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold;"></td>
                  <td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold;"></td>
                  <td bgcolor="#c8c8c8" style="font-size: 12px; font-weight: bold;"></td>-->
            </tr>
            <?
               echo "</tbody></table>";
               } // end if != -1 (single person
               
               
               
               
               
               
               //------------ Ignore Below Here -------------
               
               
               else {
               
               
               $start_date = date('Y-m-d', $start_date);
               $end_date = date('Y-m-d', $end_date + 86400);
               
               if ($start_date > $end_date) {
               echo "<font size=20>Nice Try, David - You thought I would not catch an error where the start date comes after the end date.</font>";
               }
               
               ?>
            <?php
               $wquery = "SELECT DISTINCT(worker_id) FROM `loop_timeclock` WHERE time_in BETWEEN '$start_date' AND '$end_date'";
               $wres = db_query($wquery,db());
               while ($wrow = array_shift($wres))
               {
               
               // echo $query_clicks;
               ?>
            <table cellSpacing="1" cellPadding="1" width="800" border="0">
               <tr align="middle">
                  <td colSpan="10" class="style7">
                     TIMECLOCK REPORT FOR: 
                     <?php
                        $query = "SELECT * FROM loop_workers WHERE id = " . $wrow["worker_id"] ;
                        $res = db_query($query,db());
                        $row = array_shift($res);
                        $name = $row["name"];
                        echo "<b>".$name."</b>";
                        ?>
                  </td>
               </tr>
               <tr>
                  <td class="style17">
                     <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
                     DATE</font>
                  </td>
                  <td class="style17">
                     <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
                     TIME IN</font>
                  </td>
                  <td class="style5" >
                     <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
                     TIME OUT
                  </td>
                  <td align="middle" class="style16">
                     <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
                     AMOUNT
                  </td>
                  <td align="middle" class="style16">
                     <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
                     EDIT
                  </td>
                  <td align="middle" class="style16">
                     <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
                     NOTES
                  </td>
               </tr>
               <?php
                  $query = "SELECT *, IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)) AS A, DATE_FORMAT(time_in, '%W, %M %d, %Y') AS D, TIME(time_in) AS T_I, TIME(time_out) AS T_O FROM loop_timeclock WHERE type LIKE '%" . $_REQUEST["type"] ."' AND worker_id = " . $wrow["worker_id"] . " ";
                  if($_GET["start_date"] != "")
                  {
                   $query .= " AND time_in BETWEEN '$start_date'";
                  }
                  if($_GET["end_date"] != "")
                  {
                   $query .= " AND '$end_date'";
                  }
                  // echo $query;
                  $res = db_query($query,db());
                  while($row = array_shift($res))
                  {
                  
                  ?>
               <tr vAlign="center">
                  <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                     <? echo $row["D"]; ?>
                  </td>
                  <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                     <? echo $row["T_I"]; ?>
                  </td>
                  <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                     <? echo $row["T_O"]; ?>
                  </td>
                  <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                     <? echo $row["A"];?>
                  </td>
                  <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                     <a href="report_timeclockZF.php?worker=<?=$_REQUEST["worker"];?>&action=run&edit=true&id=<? echo $row["id"];?>&start_date=<?=$_REQUEST["start_date"];?>&end_date=<?=$_REQUEST["end_date"];?>">Edit</a>
                  </td>
                  <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=left><font size=1><? if ($row["time_in_old"] != "0000-00-00 00:00:00") echo $row["time_in_old"];?> <?  if ($row["time_out_old"] != "0000-00-00 00:00:00") echo $row["time_out_old"];?> <? echo $row["notes"];?></font></td>
               </tr>
               <?php
                  }
                  $query = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE type LIKE '%" . $_REQUEST["type"] ."' AND worker_id = " . $wrow["worker_id"] . " ";
                  if($_GET["start_date"] != "")
                  {
                   $query .= " AND time_in BETWEEN '$start_date'";
                  }
                  if($_GET["end_date"] != "")
                  {
                   $query .= " AND '$end_date'";
                  }
                  $res = db_query($query,db());
                  while($row = array_shift($res))
                  {
                  ?>
               <tr vAlign="center">
                  <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  </td>
                  <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                     <? echo $total_orders; ?>
                  </td>
                  <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                     Total Hours
                  </td>
                  <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                     <? echo $row["ADT"]; ?> 
                  </td>
                  <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                     <? echo number_format($row["DT"]/3600,2); ?>  
                  </td>
                  <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  </td>
               </tr>
               <?php 
                  }
                  ?>
            </table>
            <table>
               <tr align="middle">
                  <td colSpan="4" class="style7"><b><?=$name;?></b></td>
               </tr>
               <?
                  $tq = "SELECT DISTINCT(type) FROM loop_timeclock WHERE time_in BETWEEN '$start_date' AND '$end_date'";
                  
                  $tres = db_query($tq,db());
                  while($trow = array_shift($tres))
                  {
                  $query = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE type LIKE '%" . $trow["type"] ."' AND worker_id = " . $wrow["worker_id"] . " ";
                  if($_GET["start_date"] != "")
                  {
                   $query .= " AND time_in BETWEEN '$start_date'";
                  }
                  if($_GET["end_date"] != "")
                  {
                   $query .= " AND '$end_date'";
                  }
                  $res = db_query($query,db());
                  while($row = array_shift($res))
                  {
                  ?>
               <tr vAlign="center">
                  <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                     <?=$trow["type"];?>
                  </td>
                  <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                     Total Hours
                  </td>
                  <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                     <? echo $row["ADT"]; ?> 
                  </td>
                  <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                     <? echo number_format($row["DT"]/3600,2); ?>  
                  </td>
               </tr>
               <?php 
                  }
                  
                  }
                  ?>
            </table>
            <?
               } // end distinct WHILE
               
               
               } // end else (this is the show all
               } // end if "run"
               ?>
            <br><br><br>
            <?
               if ($_REQUEST["edit"]=="true")
               {
               $query = "SELECT * FROM loop_timeclock WHERE id = ".$_REQUEST["id"];
               $res = db_query($query,db());
               while($row = array_shift($res))
               {
               ?>
            <form name="rptSearch2" action="report_timeclockZF.php" method="GET">
               <input type="hidden" name="action" value="update">
               <input type="hidden" name="edit" value="true">
               <input type="hidden" name="timeclockid" value="<?=$_REQUEST["id"]?>">
               <input type="hidden" name="time_in_old" value="<?=$row["time_in"]?>">
               <input type="hidden" name="time_out_old" value="<?=$row["time_out"]?>">
               <table>
                  <tr align="middle">
                     <td colSpan="10" class="style7">
                        UPDATE TIMESHEET 
                     </td>
                  </tr>
                  <tr>
                     <td bgColor="#e4e4e4">Employee</td>
                     <td bgColor="#e4e4e4">Time In</td>
                     <td bgColor="#e4e4e4">Time Out</td>
                     <td bgColor="#e4e4e4">New Time In</td>
                     <td bgColor="#e4e4e4">New Time Out</td>
                     <td bgColor="#e4e4e4">Notes</td>
                  </tr>
                  <tr>
                     <td bgColor="#e4e4e4">
                        <select name="worker">
                           <option>Please Select</option>
                           <? 
                              $sql3 = "SELECT * FROM loop_workers";
                              $result3 = db_query($sql3,db() );
                              while ($myrowsel3 = array_shift($result3)) {
                              ?>
                           <option value="<? echo $myrowsel3["id"]; ?>" <? if ($myrowsel3["id"]==$_REQUEST["worker"]) echo "selected"; ?>><? echo $myrowsel3["name"]; ?></option>
                           <? } ?>
                        </select>
                     </td>
                     <td bgColor="#e4e4e4"><?=$row["time_in"];?></td>
                     <td bgColor="#e4e4e4"><?=$row["time_out"];?></td>
                     <td bgColor="#e4e4e4"><input name=new_time_in value="<?=$row["time_in"];?>"></td>
                     <td bgColor="#e4e4e4"><input name=new_time_out value="<?=$row["time_out"];?>"></td>
                     <td bgColor="#e4e4e4"><input size=25 name=notes value="<?=$row["notes"];?>"></td>
                  </tr>
                  <tr>
                     <td bgColor="#e4e4e4" colspan=10 align=center>
                        <input type=submit value="Update">
                     </td>
                  </tr>
               </table>
            </form>
            <?
               }
               }
               if ($_REQUEST["editproduction"]=="true")
               {
               $query = "SELECT * FROM loop_timeclock_production WHERE id = ".$_REQUEST["id"];
               $res = db_query($query,db());
               while($row = array_shift($res))
               {
               ?>
            <form name="rptSearch2" action="report_timeclockZF.php" method="GET">
               <input type="hidden" name="action" value="updateproduction">
               <input type="hidden" name="editproduction" value="true">
               <input type="hidden" name="productionid" value="<?=$_REQUEST["id"]?>">
               <table>
                  <tr align="middle">
                     <td colSpan="10" class="style7">
                        UPDATE PRODUCTION SHEET 
                     </td>
                  </tr>
                  <tr>
                     <td bgColor="#e4e4e4">Employee</td>
                     <td bgColor="#e4e4e4">Date</td>
                     <td bgColor="#e4e4e4">Rate</td>
                     <td bgColor="#e4e4e4">Production</td>
                     <td bgColor="#e4e4e4">Notes</td>
                  </tr>
                  <tr>
                     <td bgColor="#e4e4e4">
                        <select name="worker">
                           <option>Please Select</option>
                           <? 
                              $sql3 = "SELECT * FROM loop_workers";
                              $result3 = db_query($sql3,db() );
                              while ($myrowsel3 = array_shift($result3)) {
                              ?>
                           <option value="<? echo $myrowsel3["id"]; ?>" <? if ($myrowsel3["id"]==$_REQUEST["worker"]) echo "selected"; ?>><? echo $myrowsel3["name"]; ?></option>
                           <? } ?>
                           <? $d = explode(' ',$row["date"]);?>
                        </select>
                     </td>
                     <td bgColor="#e4e4e4"><input name=new_date value="<?=$d[0];?>"></td>
                     <td bgColor="#e4e4e4"><input name="new_rate" value="<?=$row["rate"];?>"></td>
                     <td bgColor="#e4e4e4"><input name="new_production" value="<?=$row["production"];?>"></td>
                     <td bgColor="#e4e4e4"><input size=25 name=notes value="<?=$row["notes"];?>"></td>
                  </tr>
                  <tr>
                     <td bgColor="#e4e4e4" colspan=10 align=center>
                        <input type=submit value="Update">
                     </td>
                  </tr>
               </table>
            </form>
            <?
               }
               }
               if ($_REQUEST["action"]=="updateproduction")
               {
               $sql3 = "UPDATE loop_timeclock_production SET date = '" . $_REQUEST["new_date"] . " 00:00:01', rate = '" . $_REQUEST["new_rate"] . "', production = '" . $_REQUEST["new_production"] . "', worker_id = '" . $_REQUEST["worker"] . "', notes = '" . $_REQUEST["notes"] . "' WHERE id = " . $_REQUEST["productionid"];
               $result3 = db_query($sql3,db() );
               $myrowsel3 = array_shift($result3);
               ;
               
               		$message_123 = "The following change was made to the production: ";
               		$message_123 .= "<br><br>Worker ID: " . $_REQUEST["worker"] . "\n\n";
               		$message_123 .= "<br><br>Transaction ID: " . $_REQUEST["productionid"] . "\n\n";
               		$message_123 .= "<br><br>New Date: " . $_REQUEST["new_date"] . "\n\n";
               		$message_123 .= "<br><br>New Rate: " . $_REQUEST["new_rate"] . "\n\n";
               		$message_123 .= "<br><br>New Production: " . $_REQUEST["new_production"] . "\n\n";
               		$message_123 .= "<br><br>Notes: " . $_REQUEST["notes"] . "\n\n";
               		$message_123 .= "<br><br><a href=\"https://b2c.usedcardboardboxes.com/report_timeclockZF.php?action=run&worker=" . $_REQUEST["worker"] . "&start_date=&end_date=\">Check </a>\n";
               		$headers_123  = "MIME-Version: 1.0\r\n"; 
               		$headers_123 .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
               		$headers_123 .= "From: UCB Website <no-reply@usedcardboardboxes.com>\r\n"; 
               		$to_123 = "davidkrasnow@usedcardboardboxes.com";
               
               		echo $message_123;
               		
               		$resp = sendemail_php_function(null, '', $to_123, "", "", "ucbemail@usedcardboardboxes.com", "Operations Usedcardboardboxes", "Operations@UsedCardboardBoxes.com", 'TIME CLOCK EDIT', $message_123); 
               
               }
               
               if ($_REQUEST["action"]=="update")
               {
               $sql3 = "UPDATE loop_timeclock SET time_in = '" . $_REQUEST["new_time_in"] . "', time_out = '" . $_REQUEST["new_time_out"] . "', time_in_old = '" . $_REQUEST["time_in_old"] . "', time_out_old = '" . $_REQUEST["time_out_old"] . "', worker_id = '" . $_REQUEST["worker"] . "', notes = '" . $_REQUEST["notes"] . "' WHERE id = " . $_REQUEST["timeclockid"];
               $result3 = db_query($sql3,db() );
               $myrowsel3 = array_shift($result3);
               
               
               		$message_123 = "The following change was made to the timeclock: ";
               		$message_123 .= "<br><br>Worker ID: " . $_REQUEST["worker"] . "\n\n";
               		$message_123 .= "<br><br>Transaction ID: " . $_REQUEST["timeclockid"] . "\n\n";
               		$message_123 .= "<br><br>Old Time In: " . $_REQUEST["time_in_old"] . "\n\n";
               		$message_123 .= "<br><br>New Time In: " . $_REQUEST["new_time_in"] . "\n\n";
               		$message_123 .= "<br><br>Old Time Out: " . $_REQUEST["time_out_old"] . "\n\n";
               		$message_123 .= "<br><br>New Time Out: " . $_REQUEST["new_time_out"] . "\n\n";
               		$message_123 .= "<br><br>Notes: " . $_REQUEST["notes"] . "\n\n";
               		$message_123 .= "<br><br><a href=\"https://b2c.usedcardboardboxes.com/report_timeclockZF.php?action=run&worker=" . $_REQUEST["worker"] . "&start_date=&end_date=\">Check </a>\n";
               		$headers_123  = "MIME-Version: 1.0\r\n"; 
               		$headers_123 .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
               		$headers_123 .= "From: UCB Website <no-reply@usedcardboardboxes.com>\r\n"; 
               		$to_123 = "davidkrasnow@usedcardboardboxes.com";
               //		$to_123 = "mdewan@tivex.com";
               		$resp = sendemail_php_function(null, '', $to_123, "", "", "ucbemail@usedcardboardboxes.com", "Operations Usedcardboardboxes", "Operations@UsedCardboardBoxes.com", 'TIME CLOCK EDIT', $message_123); 
               
               }
               ?>
            <script>
               TableThing = function(params) {
                   settings = {
                       table: $('#entriestable'),
                       thead: []
                   };
               
                   this.fixThead = function() {
                       // empty our array to begin with
                       settings.thead = [];
                       // loop over the first row of td's in &lt;tbody> and get the widths of individual &lt;td>'s
                       $('tbody tr:eq(1) td', settings.table).each( function(i,v){
                           settings.thead.push($(v).width());
                       });
               
                       // now loop over our array setting the widths we've got to the &lt;th>'s
                       for(i=0;i<settings.thead.length;i++) {
                           $('thead th:eq('+i+')', settings.table).width(settings.thead[i]);
                       }
               
                       // here we attach to the scroll, adding the class 'fixed' to the &lt;thead> 
                       $(window).scroll(function() {
                           var windowTop = $(window).scrollTop();
               
                           if (windowTop > settings.table.offset().top) {
                               $("thead", settings.table).addClass("fixed");
                           }
                           else {
                               $("thead", settings.table).removeClass("fixed");
                           }
                       });
                   }
               }
               $(function(){
                   var table = new TableThing();
                   table.fixThead();
                   $(window).resize(function(){
                       table.fixThead();
                   });
               });
            </script>
      </div>
   </body>
</html>
<? if (isset($_GET["start_date"])) { ?>
REPORT DONE
<? } ?>
