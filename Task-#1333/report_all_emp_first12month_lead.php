<?php
  require("inc/header_session.php");
  require("../mainfunctions/database.php");
  require("../mainfunctions/general-functions.php");
  ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>Sales Rep's Revenue in 1st Year Report</title>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
    <LINK rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>
  </head>
  <?php include("inc/header.php"); ?>
  <div class="main_data_css">
    <div class="dashboard_heading" style="float: left;">
      <div style="float: left;">
        Sales Rep's Revenue in 1st Year Report
        <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
          <span class="tooltiptext">
          This report shows the user the amount of revenue each sales rep has sold within their first year (12 months) of employment.
          </span>
        </div>
        <div style="height: 13px;">&nbsp;</div>
      </div>
    </div>
    <table cellSpacing="1" cellPadding="1" border="0" width="900" id="table9" class="tablesorter">
      <thead>
        <tr>
          <th align="left" width="170px" style="background: #ABC5DF;"><u>Employee</u></th>
          <th width='120px' align="center" style="background: #ABC5DF;" colspan="12">First 12 months</th>
          <th align="left" width="170px" style="background: #ABC5DF;">Total</th>
        </tr>
      </thead>
      <tbody>
        <?php
		  db();
          $sql = "SELECT * FROM loop_employees WHERE status = 'Active' and leaderboard = 1 and Official_Start_Date is not null ORDER BY quota DESC";
          $result = db_query($sql);
          while ($rowemp = array_shift($result)) {
          	$cal_month = date("m", strtotime($rowemp["Official_Start_Date"]));
          	$cal_yr = date("Y", strtotime($rowemp["Official_Start_Date"]));
          	$cal_month_tot = $cal_month + 11;
          	$emp_tot = 0;
          	$dt_start = $rowemp["Official_Start_Date"];
          	echo "<tr><td bgColor='#E4EAEB'>&nbsp;</td>";
          	for ($month_cnt = 1; $month_cnt <= 12; $month_cnt++) {
          		$dt_cal = strtotime($month_cnt . ' month', strtotime($dt_start));
          		$cal_yr = date("Y", $dt_cal);
          		$cal_month = date("m", $dt_cal);
          		echo "<td bgColor='#E4EAEB' align ='right'>" . $cal_month . "/" . "01/" . $cal_yr . "</td>";
          	}
          	echo "<td bgColor='#E4EAEB'>&nbsp;</td></tr>";
          	echo "<tr><td bgColor='#E4EAEB' align ='left'>" . $rowemp["name"] . "</td>";
          	$month_cnt_n = 0;
          	for ($month_cnt = 1; $month_cnt <= 12; $month_cnt++) {
          		$dt_cal = strtotime($month_cnt . ' month', strtotime($dt_start));
          	
          		$cal_yr = date("Y", $dt_cal);
          		$cal_month = date("m", $dt_cal);
				db();
          		$sqlmtd = "SELECT SUM(po_poorderamount) AS SUMPO FROM loop_transaction_buyer WHERE po_employee LIKE '" . $rowemp["initials"] . "' AND loop_transaction_buyer.ignore < 1 AND transaction_date BETWEEN '" . $cal_yr . "-" . $cal_month . "-01 00:00:00'  AND '" . $cal_yr . "-" . $cal_month . "-" . date("t", strtotime($cal_yr . "-" . $cal_month . "-01")) . " 23:59:59'";
          		
          		$resultmtd = db_query($sqlmtd);
          		$summtd_SUMPO = 0;
          		while ($summtd = array_shift($resultmtd)) {
          			if ($summtd["SUMPO"] > 0) {
          				$summtd_SUMPO = $summtd["SUMPO"];
          				$emp_tot = $emp_tot + $summtd_SUMPO;
          			}
          		}
          
          		echo "<td bgColor='#E4EAEB' align ='right'>" . number_format($summtd_SUMPO, 2) . "</td>";
          	}
          	echo "<td bgColor='#E4EAEB' align ='right'>" . number_format($emp_tot, 2) . "</td>";
          	echo "</tr>";
          }
          ?>
      </tbody>
    </table>
  </div>
  </body>
</html>