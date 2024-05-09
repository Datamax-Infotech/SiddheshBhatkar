<?php
   require ("inc/header_session.php");
   require ("mainfunctions/database.php");
   require ("mainfunctions/general-functions.php");
?>
<!DOCTYPE html>
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
      <link href="css/timeclock_reports.css" rel="stylesheet">
      <script>
         function chkvalidation()
         {
              var startDate = document.getElementById("start_date").value;
             var endDate = document.getElementById("end_date").value;
             if(Date.parse(endDate) <= Date.parse(startDate))
                 {
                     alert("End date should be greater than Start date");
                     return false;
                 }
             return true;
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
               Manager Timeclock & Production Summary Reports
               <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
                  <span class="tooltiptext">
                  This report shows the users various summaries that relate to the timeclock and production within a provided time period.
                  </span>
               </div>
               <div style="height: 13px;">&nbsp;</div>
            </div>
         </div>
         <br>
         <form name="rptSearch" action="" method="GET" onSubmit="return chkvalidation()">
            <input type="hidden" name="action" value="run">
            <span class="style13">
            <span class="style15">
               <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
               <span class="style14">
                  <span class="style15">
                     <input type=hidden name="worker" value=0>
                     <table class="navi_table">
                        <tr>
                           <td>
                              <a href="Timeclock_Manager.php" class="active_link">TimeclockDK3</a>
                           </td>
                           <td>
                              <a href="Warehouse_Hours_Review.php">Manager Review</a>
                           </td>
                           <td>
                              <a href="Staffing_Summary.php">Staffing Summary</a>
                           </td>
                           <td>
                              <a href="Warehouse_Hours_Payroll.php">Payroll Summary</a>
                           </td>
                           <td>
                              <a href="Warehouse_Analysis.php">Time by Status by Location</a>
                           </td>
                           <td>
                              <a href="warehouse_production_report.php">Production Report</a>
                           </td>
                           <td>
                              <a href="report_leaderboard_mgr.php">Leaderboard Manager</a>
                           </td>
                           <td>
                              <a href="report_unprocessed_inbound_trailers_report.php">Unprocessed Inbound Trailers Report</a>
                           </td>
                        </tr>
                        <tr>
                           <?php
                              $chkinitials =  $_COOKIE['userinitials'];
                              
							  db();
							  $emp_level_qry=db_query("SELECT * FROM loop_employees where initials = '" . $chkinitials . "'");
                              $emp_level_res=array_shift($emp_level_qry);
                              if($emp_level_res["level"]==2)
                              {
                              
                              ?>
                           <td>
                              <a href="HV_Hours_Review.php" >HV Manager Review</a>
                           </td>
                           <td>
                              <a href="HA_Hours_Review.php" >HA Manager Review</a>
                           </td>
                           <td>
                              <a href="ML_Hours_Review.php" >ML Manager Review</a>
                           </td>
                           <td>
                              <a href="HVP_Hours_Review.php" >HVP Manager Review</a>
                           </td>
                           <td>
                              <a href="MLC_Hours_Review.php" >McCormick MLC Manager Review</a>
                           </td>
                           <td>
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
                     <?php
                        $start_date = isset($_GET["start_date"])?strtotime($_GET["start_date"]):strtotime(date('m/d/Y'));
                        $end_date = isset($_GET["end_date"])?strtotime($_GET["end_date"]):strtotime(date('m/d/Y'));
                        ?>
                     <table class="date_table">
                        <tr>
                           <td>
                              <font face="Arial, Helvetica, sans-serif" color="#333333" size="2"> From: <input type="text" name="start_date" id="start_date" size="11" value="<?php echo (isset($_GET["start_date"]) && $_GET["start_date"] != "")?date('m/d/Y', $start_date):""?>"> <a href="#" onclick="cal1xx.select(document.rptSearch.start_date,'anchor1xx','MM/dd/yyyy'); return false;" name="anchor1xx" id="anchor1xx"><img border="0" src="images/calendar.jpg"></a> </font>
                           </td>
                           <td>
                              <font face="Arial, Helvetica, sans-serif" color="#333333" size="2">To: <input type="text" name="end_date" id="end_date" size="11" value="<?php echo (isset($_GET["end_date"]) && $_GET["start_date"] != "")?date('m/d/Y', $end_date):""?>"> <a href="#" onclick="cal1xx.select(document.rptSearch.end_date,'anchor2xx','MM/dd/yyyy'); return false;" name="anchor2xx" id="anchor2xx"><img border="0" src="images/calendar.jpg"></a></font>
                           </td>
                           <td>
                              &nbsp; <input type="submit" value="Search">
                           </td>
                        </tr>
                     </table>
         </form>
         <div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>
         <br></span></span></span>
         <table width="70%" class="datatable">
         <tbody class="content">
            <?php
               if ($_GET["action"] == 'run') {
               if ($_REQUEST["worker"] != -1)
               {
               
               $start_date = isset($_GET["start_date"])?strtotime($_GET["start_date"]):strtotime(date('m/d/Y'));
               $end_date = isset($_GET["end_date"])?strtotime($_GET["end_date"]):strtotime(date('m/d/Y'));
               
               ?>
            <tr>
               <td colspan="11" bgcolor="#FFCC66" style="font-size: 12px; font-weight: bold;text-align: center;">
                  TimeclockDK3
               </td>
            </tr>
            <tr>
               <td bgColor="#99FF99" class="style3" style="height: 22px;" width=150 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Name</strong></font></td>
               <td bgColor="#99FF99" class="style3" style="height: 22px;" width=50 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Warehouse Name</strong></font></td>
               <td bgColor="#99FF99" class="style3" style="height: 22px;" width=50 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Regular Hours</strong></font></td>
               <td bgColor="#99FF99" class="style3" style="height: 22px;" width=50 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Regular Rate</strong></font></td>
               <td bgColor="#99FF99" class="style3" style="height: 22px;" width=50 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Overtime Hours</strong></font></td>
               <td bgColor="#99FF99" class="style3" style="height: 22px;" width=50 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Overtime Rate</strong></font></td>
               <td bgColor="#99FF99" class="style3" style="height: 22px;" width=50 align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Hourly Total</strong></font></td>
               <td bgColor="#99FF99" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Production Total</strong></td>
               <td bgColor="#99FF99" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Production Bonus</strong></font></td>
               <td bgColor="#99FF99" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Other Bonus</strong></font></td>
               <td bgColor="#99FF99" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><strong>Total Bonus</strong></font></td>
            </tr>
            <?php
               $start_date = date('Y-m-d', $start_date);
               $end_date = date('Y-m-d', $end_date + 86400);
               $sqlw = "SELECT DISTINCT worker_id AS WID FROM loop_timeclock INNER JOIN loop_workers ON loop_workers.id = loop_timeclock.worker_id WHERE loop_timeclock.time_in BETWEEN '" . $start_date . "' AND '" . $end_date . "' ORDER BY loop_workers.warehouse_id ASC, loop_workers.name ASC";
			   
			   db();	
			   $resultw = db_query($sqlw );
               while ($roww = array_shift($resultw)) {
               
               $start_date = isset($_GET["start_date"])?strtotime($_GET["start_date"]):strtotime(date('m/d/Y'));
               $end_date = isset($_GET["end_date"])?strtotime($_GET["end_date"]):strtotime(date('m/d/Y'));
               
               
               
               $start_date = date('Y-m-d', $start_date);
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
               
			   db();  
			   $res = db_query($query);
               $row = array_shift($res);
               $name = $row["name"];
               $warehouse_id = $row["warehouse_id"];
               $emp_tier=$row["emp_tier"];
               if($emp_tier == ""){$emp_tier = "Tier 0";}
               
               $worker_id = $row["id"];
               $rate = $row["rate_cost"];
               $billing_rate = $row["bill_rate"];
               
               $warehouse_name = "";
               $dt_view_qry = "select company_name from loop_warehouse where id  = '" . $warehouse_id . "'";
               
			   db();
			   $dt_view_res = db_query($dt_view_qry);
               while ($dt_view_row = array_shift($dt_view_res)) {
               	$warehouse_name = $dt_view_row["company_name"];
               }
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

               db();
               $res = db_query($query);
               $production_total=0;
               $bonusProTotal = 0;
               $tierIncresedValTotal = $grandTotalAll = 0;
               
               while($row = array_shift($res))
               {
               $et_query="select * from loop_worker_tier where tier='".$emp_tier."'";

			   db();
               $etres=db_query($et_query);
               $et_row=array_shift($etres);
               $emp_tier_value=$et_row["tier_value"];
               
               $production_val = $row["R"]*$row["P"];
               $tierIncresedVal =  number_format(($production_val * $emp_tier_value), 2);
               
               if($tierIncresedVal == 'Invalid Tier Value'){
               	$grandTotal = number_format($production_val ,2);
               }else{
               	$grandTotal = number_format($production_val + str_replace( ',', '', $tierIncresedVal),2); 
               }
               
               ?>
            <?php
               $production_total += str_replace(',', '', $grandTotal);
                //$production_total+=$row["R"] * $row["P"];
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
             
               $st_monday = strtotime('+6 days', $st_tuesday);
              
               ?>
            <?php
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

			   db();
               $res = db_query($query);
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
               
			   db();
               $fres = db_query($fquery);
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
            <?php
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
            <?php
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
            <?php   
               	$pq     = "SELECT name, loop_workers.rate_cost AS RC, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))/3600 AS DT FROM loop_timeclock LEFT JOIN loop_workers ON loop_timeclock.worker_id = loop_workers.id WHERE (loop_timeclock.type LIKE '%Production' OR loop_timeclock.type LIKE '%kits' OR loop_timeclock.type LIKE '%achines') AND loop_timeclock.worker_id = " . $roww["WID"];
               	if($start_date != "")
               	{
               		$pq .= " AND (time_in >= '" . $start_date . " 00:00:00' and time_in <= '" . $end_date . " 23:59:59') ";
               	}
				   db();
                   $pres       = db_query($pq);
                   $prow       = array_shift($pres);
                   $totalHours = $prow["DT"];
                   $hourlyRate = $prow["RC"];
               
                   $hourlyValue = ($totalHours * $hourlyRate);
               	
               	$bonus = str_replace( ',', '',$production_total) - str_replace( ',', '', number_format((str_replace( ',', '', number_format($prow["DT"],2)) * $prow["RC"]),2));
               
                   $obqry = "SELECT SUM(amount) AS OB FROM loop_timeclock_bonus WHERE worker_id = " . $roww["WID"] . " AND date BETWEEN '" . $start_date . "' AND '" . $end_date . "'" ;
                   
				   db();
				   $obres = db_query($obqry);
                   $obrow = array_shift($obres);
                   $other_bonus = $obrow["OB"];
                   $total_bonus = $obrow["OB"] + $bonus;
               ?>  
            <?php if ($regulartime > 0 ) { 
               $overtime = number_format($overtime,2);
               $regulartime = number_format($regulartime,2);
               $rate = number_format($rate,2);
                      if($billing_rate!="")
                      {
                          $billing_rate1 = number_format($billing_rate,2);
                      }
                  else{
                         $billing_rate1=0.00;
                     }
               ?>
            <tr>
               <!-- <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=150 align=left><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><a href="https://loops.usedcardboardboxes.com/report_timeclockZF.php?action=run&worker=<?php echo $worker_id;?>&type=&start_date=<?php echo $_GET["start_date"];?>&end_date=<?php echo $_GET["end_date"];?>" target="_blank"><?php echo $name;?></a></td> -->
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=150 align=left><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><a href="report_timeclockZF.php?action=run&worker=<?php echo $worker_id;?>&type=&start_date=<?php echo $_GET["start_date"];?>&end_date=<?php echo $_GET["end_date"];?>" target="_blank"><?php echo $name;?></a></td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><?php echo $warehouse_name;?></td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1"><?php echo $regulartime;?></td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">$<?php echo $rate;?></td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
                  <?php
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
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">$<?php echo number_format($rate*1.5,2);?></td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">$<?php echo number_format($regulartime * $rate + $overtime * $rate*1.5,2);?></td>
               <!-- <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">$<?php echo number_format($billing_rate1,2);?></td>
                  <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">$<?php echo number_format($regulartime * $billing_rate + $overtime * $billing_rate*1.5,2);?></td> -->
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">$<?php echo number_format($production_total,2);?></td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">$<?php if ($bonus > 0) echo number_format($bonus,2); else echo "0.00";?></td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">$<? if ($other_bonus > 0) echo number_format($other_bonus,2); else echo "0.00";?></td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" width=50 align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">$<?php if ($total_bonus > 0) echo number_format($total_bonus,2); else echo "0.00";?></td>
            </tr>
            <?php
               }
               }
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
               
			   db();
			   $wres = db_query($wquery);
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
                        
						db();
						$res = db_query($query);
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
                  <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                     <?php echo $row["A"];?>
                  </td>
                  <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                     <a href="report_timeclockZF.php?worker=<?php echo $_REQUEST["worker"];?>&action=run&edit=true&id=<?php echo $row["id"];?>&start_date=<?php echo $_REQUEST["start_date"];?>&end_date=<?php echo $_REQUEST["end_date"];?>">Edit</a>
                  </td>
                  <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=left><font size=1><?php if ($row["time_in_old"] != "0000-00-00 00:00:00") echo $row["time_in_old"];?> <?php  if ($row["time_out_old"] != "0000-00-00 00:00:00") echo $row["time_out_old"];?> <?php echo $row["notes"];?></font></td>
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

				  db();
                  $res = db_query($query);
                  while($row = array_shift($res))
                  {
                  ?>
               <tr vAlign="center">
                  <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  </td>
                  <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                     <?php echo $total_orders; ?>
                  </td>
                  <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                     Total Hours
                  </td>
                  <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                     <?php echo $row["ADT"]; ?> 
                  </td>
                  <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                     <?php echo number_format($row["DT"]/3600,2); ?>  
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
                  <td colSpan="4" class="style7"><b><?php echo $name;?></b></td>
               </tr>
               <?php
                  $tq = "SELECT DISTINCT(type) FROM loop_timeclock WHERE time_in BETWEEN '$start_date' AND '$end_date'";
				  
				  db();
                  $tres = db_query($tq);
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

				  db();
                  $res = db_query($query);
                  while($row = array_shift($res))
                  {
                  ?>
               <tr vAlign="center">
                  <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                     <?php echo $trow["type"];?>
                  </td>
                  <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
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
                  ?>
            </table>
            <?php
               } // end distinct WHILE
               
               
               } // end else (this is the show all
               } // end if "run"
               ?>
            <br><br><br>
            <?php
               if ($_REQUEST["edit"]=="true")
               {
               $query = "SELECT * FROM loop_timeclock WHERE id = ".$_REQUEST["id"];
			   
			   db();
			   $res = db_query($query);
               while($row = array_shift($res))
               {
               ?>
            <form name="rptSearch2" action="report_timeclockZF.php" method="GET">
               <input type="hidden" name="action" value="update">
               <input type="hidden" name="edit" value="true">
               <input type="hidden" name="timeclockid" value="<?php echo $_REQUEST["id"]?>">
               <input type="hidden" name="time_in_old" value="<?php echo $row["time_in"]?>">
               <input type="hidden" name="time_out_old" value="<?php echo $row["time_out"]?>">
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
                           <?php
                              $sql3 = "SELECT * FROM loop_workers";
                              
							  db();
							  $result3 = db_query($sql3 );
                              while ($myrowsel3 = array_shift($result3)) {
                              ?>
                           <option value="<?php echo $myrowsel3["id"]; ?>" <?php if ($myrowsel3["id"]==$_REQUEST["worker"]) echo "selected"; ?>><?php echo $myrowsel3["name"]; ?></option>
                           <?php } ?>
                        </select>
                     </td>
                     <td bgColor="#e4e4e4"><?php echo $row["time_in"];?></td>
                     <td bgColor="#e4e4e4"><?php echo $row["time_out"];?></td>
                     <td bgColor="#e4e4e4"><input name="new_time_in" value="<?php echo $row["time_in"];?>"></td>
                     <td bgColor="#e4e4e4"><input name="new_time_out" value="<?php echo $row["time_out"];?>"></td>
                     <td bgColor="#e4e4e4"><input size="25" name="notes" value="<?php echo $row["notes"];?>"></td>
                  </tr>
                  <tr>
                     <td bgColor="#e4e4e4" colspan=10 align=center>
                        <input type=submit value="Update">
                     </td>
                  </tr>
               </table>
            </form>
            <?php
               }
               }
               if ($_REQUEST["editproduction"]=="true")
               {
               $query = "SELECT * FROM loop_timeclock_production WHERE id = ".$_REQUEST["id"];
			   
			   db();
			   $res = db_query($query);
               while($row = array_shift($res))
               {
               ?>
            <form name="rptSearch2" action="report_timeclockZF.php" method="GET">
               <input type="hidden" name="action" value="updateproduction">
               <input type="hidden" name="editproduction" value="true">
               <input type="hidden" name="productionid" value="<?php echo $_REQUEST["id"]?>">
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
                           <?php
                              $sql3 = "SELECT * FROM loop_workers";

							  db();
                              $result3 = db_query($sql3 );
                              while ($myrowsel3 = array_shift($result3)) {
                              ?>
                           <option value="<?php echo $myrowsel3["id"]; ?>" <?php if ($myrowsel3["id"]==$_REQUEST["worker"]) echo "selected"; ?>><?php echo $myrowsel3["name"]; ?></option>
                           <?php } ?>
                           <?php $d = explode(' ',$row["date"]);?>
                        </select>
                     </td>
                     <td bgColor="#e4e4e4"><input name=new_date value="<?php echo $d[0];?>"></td>
                     <td bgColor="#e4e4e4"><input name="new_rate" value="<?php echo $row["rate"];?>"></td>
                     <td bgColor="#e4e4e4"><input name="new_production" value="<?php echo $row["production"];?>"></td>
                     <td bgColor="#e4e4e4"><input size=25 name=notes value="<?php echo $row["notes"];?>"></td>
                  </tr>
                  <tr>
                     <td bgColor="#e4e4e4" colspan=10 align=center>
                        <input type=submit value="Update">
                     </td>
                  </tr>
               </table>
            </form>
            <?php
               }
               }
               if ($_REQUEST["action"]=="updateproduction")
               {
               	$sql3 = "UPDATE loop_timeclock_production SET date = '" . $_REQUEST["new_date"] . " 00:00:01', rate = '" . $_REQUEST["new_rate"] . "', production = '" . $_REQUEST["new_production"] . "', worker_id = '" . $_REQUEST["worker"] . "', notes = '" . $_REQUEST["notes"] . "' WHERE id = " . $_REQUEST["productionid"];
               	
				db();
				$result3 = db_query($sql3 );
               	$myrowsel3 = array_shift($result3);
               
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
			   
			   db();
			   $result3 = db_query($sql3 );
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
               		echo $message_123;
               		
               		$resp = sendemail_php_function(null, '', $to_123, "", "", "ucbemail@usedcardboardboxes.com", "Operations Usedcardboardboxes", "Operations@UsedCardboardBoxes.com", 'TIME CLOCK EDIT', $message_123); 
               }
               ?>
      </div>
   </body>
</html>