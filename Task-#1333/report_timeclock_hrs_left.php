<?php
	require ("inc/header_session.php");
	require ("../mainfunctions/database.php");
	require ("../mainfunctions/general-functions.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>McCormick HVP Staffing Hours Budget Report</title>
		<link rel='stylesheet' type='text/css' href='one_style.css' >
		<link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
		<link rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>
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

		</style>
	</head>
	<body>
	<?php include("inc/header.php"); ?>
	<div class="main_data_css">
		<div class="dashboard_heading" style="float: left;">

			<div style="float: left;">McCormick HVP Staffing Hours Budget Report

			<div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>

			<span class="tooltiptext">

				This report calculates the number of hours on the budget for each month, the total hours used so far, and the balance remaining. The monthly budget of hours can be edited within this report by using the "Update Monthly Budget Hours" link.

			</span></div>

			

			<div style="height: 13px;">&nbsp;</div>				

			</div>

		</div>

		<a href="warehouse_month_tothrs.php" target="_blank">Update Month wise Hours</a>

		<br><br>

		<table>
			<tr>
				<td bgColor='#ABC5DF' width=100 align=right>Month</td>
				<td bgColor="#ABC5DF" width=100 align=right>Budget Hours</td>
				<td bgColor="#ABC5DF" width=100 align=right>Total Hours</td>
				<td bgColor="#ABC5DF" width=150 align=right>Hours left on Budget</td>
			</tr>
			<?php

 				for ($monthcnt=date('m')-1; $monthcnt <= date('m'); $monthcnt++) {

					$start_date = strtotime(date($monthcnt . '/1/Y'));

					$end_date = strtotime(date($monthcnt ."/t/Y"));

					$month_hr_budget = 0;

					$sql_t1 = "SELECT * from hours_on_budget where FiscalYear = " . date('Y') . " and FiscalMonth = " . $monthcnt;
					
					db();
					$result_t1 = db_query($sql_t1 );

					while ($row_t1 = array_shift($result_t1)) {

						$month_hr_budget = $row_t1["hours_budget"];

					}

					$tothrs = 0;

					$start_date = date('Y-m-d', $start_date);

					$end_date = date("Y-m-t", strtotime($start_date));

					$sqlw = "SELECT DISTINCT worker_id AS WID FROM loop_timeclock INNER JOIN loop_workers ON loop_workers.id = loop_timeclock.worker_id WHERE loop_workers.id <> 476 and loop_workers.warehouse_id = 15 and loop_timeclock.time_in BETWEEN '" . $start_date . "' AND '" . $end_date . "' ORDER BY loop_workers.warehouse_id ASC, loop_workers.name ASC";
					
					db();
					$resultw = db_query($sqlw);

					while ($roww = array_shift($resultw)) {

						$start_date = strtotime(date($monthcnt . '/1/Y'));

						$end_date = strtotime(date($monthcnt ."/t/Y"));



						$start_date = date('Y-m-d', $start_date);

						$end_date = date("Y-m-t", strtotime($start_date));



						$time = strtotime($start_date);

						$st_tuesday = strtotime('last tuesday', $time);



						$st_monday = strtotime('+6 days', $st_tuesday);



						$time = strtotime($start_date);

						if (date('l',$time) != "Tuesday") {

							$st_tuesday = strtotime('last tuesday', $time);

						} else {

							$st_tuesday = $time;

						}

						

						$st = strtotime($start_date);

						$ed = strtotime($end_date);

						$st_monday = strtotime('+6 days', $st_tuesday);



						$overtime = 0;

						$regulartime = 0; 
						$first_week_overtime = "";

						while($st_tuesday < $ed)

						{

							$query = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE  worker_id = " . $roww["WID"]  . " ";

							$query .= " AND time_in BETWEEN '" . date('Y-m-d 00:00:00',$st_tuesday) . "'";

							if ($st_monday < $ed) {

								$query .= " AND '" . date('Y-m-d 23:59:59',$st_monday) . "'";

							}

							else {

								$query .= " AND '" . date('Y-m-d 23:59:59',$ed) . "'";

							}

							db();
							$res = db_query($query);

							$first_week = 0; $first_week_regular_time = 0;

							while($row = array_shift($res))

							{

								if (date('Y-m-d',$st_tuesday) < $start_date)

								{

									//This is the first one. We also need to get the time from the start date to the end of the week

									$fquery = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE  worker_id = " . $roww["WID"]  . " ";

								

									$fquery .= " AND time_in BETWEEN '" . date('Y-m-d 00:00:00',$time) . "'";

								

									if ($st_monday < $ed) {

										$fquery .= " AND '" . date('Y-m-d 23:59:59',$st_monday) . "'";

									} else {

										$fquery .= " AND '" . date('Y-m-d 23:59:59',$ed) . "'";

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

									} else

									{

										$first_week_regular_time = $frow["DT"]/3600;

										$first_week_overtime = 0;

									}

							}	



								if ($first_week == 1)

								{

									$regulartime += $first_week_regular_time;

								} else {

									if (($row["DT"]/3600) > 40) { 

										$regulartime += 40; } else { 

										$regulartime += number_format($row["DT"]/3600 ,2); }

								}

								if ($first_week == 1)

								{

									$overtime += $first_week_overtime;

								} else { 

									if (($row["DT"]/3600) > 40) { 

										$overtime += number_format((float)$row["DT"]/3600,2) - 40; 

									}

								}

								$first_week = 0;

							}	

							$st_tuesday = strtotime('+7 days', $st_tuesday);

							$st_monday = strtotime('+7 days', $st_monday);

						}

					
						if ($regulartime > 0 ) { 

							$overtime = number_format($overtime,2);

							$regulartime = number_format($regulartime,2);

							$tothrs = $tothrs + $regulartime + (float)$overtime * 1.5;

						}

					}

					$hr_left = $month_hr_budget - $tothrs;

					$bgcolor ="#E4EAEB";

					if ($hr_left >= 200 && $hr_left <= 500) {

						$bgcolor ="yellow";

					}

					if ($hr_left >= 0 && $hr_left < 200) {

						$bgcolor ="orange";

					}

					if ($hr_left < 0) {

						$bgcolor ="red";

					}

				?>
				<tr>
					<td bgColor="<?php echo $bgcolor; ?>" width=100 align=right><?php echo date("F",mktime(0, 0, 0, $monthcnt, 10)) ?></td>
					<td bgColor="<?php echo $bgcolor; ?>" width=100 align=right><?php echo number_format($month_hr_budget,2) ?></td>
					<td bgColor="<?php echo $bgcolor; ?>" width=100 align=right><?php echo number_format($tothrs,2) ?></td>
					<td bgColor="<?php echo $bgcolor; ?>" width=150 align=right><?php echo number_format($hr_left,2) ?></td>
				</tr>	
				<?php
 					}	
				?>

			</table>
			<br><br><br>
		</div>
	</body>
</html>

