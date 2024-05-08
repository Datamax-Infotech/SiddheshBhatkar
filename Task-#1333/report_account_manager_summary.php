<?php
	require("inc/header_session.php");
	require("../mainfunctions/database.php");
	require("../mainfunctions/general-functions.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>B2B Sales Rep Summary Report</title>
		<link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
		<link rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>
		<link rel="stylesheet" href="sorter/style_rep.css" />
		<style type="text/css">
			.txtstyle_color {

				font-family: arial;

				font-size: 12;

				height: 16px;

				background: #ABC5DF;

			}



			.txtstyle {

				font-family: arial;
				font-size: 12;
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

			select,
			input {
				font-family: Arial, Helvetica, sans-serif;
				font-size: 10px;
				color: #000000;
				font-weight: normal;
			}

			.main_data_css {
				margin: 0 auto;
				width: 100%;
				height: auto;
				clear: both !important;
				padding-top: 35px;
				margin-left: 10px;
				margin-right: 10px;
			}


			.black_overlay {

				display: none;

				position: absolute;

			}

			.white_content {

				display: none;

				position: absolute;

				padding: 5px;

				border: 2px solid black;

				background-color: white;

				overflow: auto;

				height: 600px;

				width: 850px;

				z-index: 1002;

				margin: 0px 0 0 0px;

				padding: 10px 10px 10px 10px;

				border-color: black;

				border-width: 2px;

				overflow: auto;

			}
		</style>

		<script type="text/javascript" src="sorter/jquery-latest.js"></script>

		<script type="text/javascript" src="sorter/jquery.tablesorter.js"></script>

		<script language="JavaScript" SRC="inc/CalendarPopup.js"></script>
		<script script="JavaScript" SRC="inc/general.js"></script>

		<script script="JavaScript">
			document.write(getCalendarStyles());
		</script>

		<script script="JavaScript">
			var cal2xx = new CalendarPopup("listdiv");

			cal2xx.showNavigationDropdowns();


			function loadmainpg() {
				if (document.getElementById('date_from').value != "" && document.getElementById('date_to').value != "") {
					//document.frmactive.action = "adminpg.php";
				} else {
					alert("Please select date From/To.");
					return false;
				}
			}


			function load_div(id) {
				//var gpos = getAbsPosition(document.getElementById(id)); 			

				var element = document.getElementById(id); //replace elementId with your element's Id.

				var rect = element.getBoundingClientRect();

				var elementLeft, elementTop; //x and y

				var scrollTop = document.documentElement.scrollTop ?

					document.documentElement.scrollTop : document.body.scrollTop;

				var scrollLeft = document.documentElement.scrollLeft ?

					document.documentElement.scrollLeft : document.body.scrollLeft;

				elementTop = rect.top + scrollTop;

				elementLeft = rect.left + scrollLeft;



				document.getElementById("light").innerHTML = document.getElementById(id).innerHTML;

				document.getElementById('light').style.display = 'block';

				document.getElementById('fade').style.display = 'block';



				document.getElementById('light').style.left = '100px';

				document.getElementById('light').style.top = elementTop + 100 + 'px';



				/*alert(document.getElementById(id).style.display);
				if (document.getElementById(id).style.display == "none"){
					document.getElementById(id).style.display = 'block';
				}else{
					document.getElementById(id).style.display = 'none';
				}*/

			}



			function close_div() {

				document.getElementById('light').style.display = 'none';

			}
		</script>
	</head>
	<body>
		<?php include("inc/header.php"); ?>

		<div class="main_data_css">
			<div id="light" class="white_content"></div>
			<div id="fade" class="black_overlay"></div>

			<div class="dashboard_heading" style="float: left;">
				<div style="float: left;">
					B2B Sales Rep Summary Report

					<div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
						<span class="tooltiptext">This report shows the user everything you need to know about a B2B Sales Rep regarding deals they sell, quotas, largest customers, etc.</span>
					</div><br>
				</div>
			</div>

			<?php

			function leadertbl($start_Dt, $end_Dt, $headtxt, $tilltoday, $currentyr, $tbl_head_color, $tbl_color, $emp_sel, $unqid)
			{

				$sstr_emp = "";



				$tot_quota = 0;

				$tot_quotaytd = 0;

				$tot_quotaactual = 0;

				$tot_quota_mtd = 0;
				$tot_quota_deal_mtd = 0;

				$tot_quotaactual_mtd = 0;

				$quota_one_day = 0;



				$dt_year_value = date('Y', strtotime($start_Dt));

				$dt_month_value = date('m', strtotime($start_Dt));

				$current_year_value = date('Y');



				$summtd_dealcnt_tot = 0;
				$quota_in_st_en_tot = 0;
				$monthly_qtd_tot = 0;
				$summtd_SUMPO_tot = 0;



				$days_this_year = floor((strtotime(DATE("Y-m-d")) - strtotime(DATE("Y-01-01"))) / (60 * 60 * 24));

				if ($emp_sel == "All") {

					$sstr_emp = "";

					$sql = "SELECT * FROM loop_employees ORDER BY quota DESC";
				} else {

					$sstr_emp = " and initials = '" . $emp_sel . "' ";

					$sql = "SELECT * FROM loop_employees WHERE quota > 0 and leaderboard = 1 $sstr_emp ORDER BY quota DESC";
				}
				db();
				$result = db_query($sql);

				while ($rowemp = array_shift($result)) {

					$quota = 0;
					$quotadate = "";
					$deal_quota = 0;
					$monthly_qtd = 0;

					//if ($current_year_value != $dt_year_value) {
					db();
					$result_empq = db_query("Select quota_month from employee_quota where emp_id = " . $rowemp["id"] . " and quota_year = " . $dt_year_value . " order by quota_month limit 1");

					while ($rowemp_empq = array_shift($result_empq)) {

						$quotadate = date($dt_year_value . "-" . str_pad($rowemp_empq["quota_month"], 2, "0", STR_PAD_LEFT) . "-01");
					}



					//echo "<br>headtxt: " . $headtxt  . "<br>";

					$quota_days_TD = 0;

					if ($start_Dt > $quotadate) {

						$quota_days_TD = 1 + floor((strtotime($end_Dt) - strtotime($start_Dt)) / (60 * 60 * 24));
					} else {

						$quota_days_TD = 1 + floor((strtotime($end_Dt) - strtotime($quotadate)) / (60 * 60 * 24));
					}

					if ($tilltoday == "Y") {

						if ($start_Dt > $quotadate) {

							$dim = 1 + floor((strtotime(Date('Y-m-d')) - strtotime($start_Dt)) / (60 * 60 * 24));
						} else {

							$dim = 1 + floor((strtotime(Date('Y-m-d')) - strtotime($quotadate)) / (60 * 60 * 24));
						}
					} else {

						$dim = 1 + floor((strtotime($end_Dt) - strtotime($start_Dt)) / (60 * 60 * 24));
					}



					if (
						$headtxt == "Today" || $headtxt == "Yesterday" || $headtxt == "TTLY Today"

						|| $headtxt == "This Month" || $headtxt == "Last Month" || $headtxt == "TTLY Month"
					) {
						db();
						$result_empq = db_query("Select sum(quota) as sumquota, sum(deal_quota) as deal_quota from employee_quota where emp_id = " . $rowemp["id"] . " and quota_year = " . $dt_year_value . " and quota_month = " . $dt_month_value);

						while ($rowemp_empq = array_shift($result_empq)) {

							$quota = $rowemp_empq["sumquota"];

							//$quotadate = $rowemp_empq["quota_date"];

							$deal_quota = $rowemp_empq["deal_quota"];
						}

						if ($headtxt == "TTLY Week" || $headtxt == "TTLY Month") {

							if ($start_Dt > $quotadate) {

								$dim = 1 + floor((strtotime(Date($dt_year_value . '-m-d')) - strtotime($start_Dt)) / (60 * 60 * 24));
							} else {

								$dim = 1 + floor((strtotime(Date($dt_year_value . '-m-d')) - strtotime($quotadate)) / (60 * 60 * 24));
							}
						}

						$st_date_t = Date('Y-m-01', strtotime($start_Dt));

						$end_date_t = Date('Y-m-t', strtotime($start_Dt));



						if ($headtxt == "TTLY Month") {

							$dim = 1 + floor((strtotime(Date($dt_year_value . '-m-d')) - strtotime($start_Dt)) / (60 * 60 * 24));



							$st_date_t = Date($dt_year_value . '-m-01', strtotime($start_Dt));

							$end_date_t = Date($dt_year_value . '-m-t', strtotime($start_Dt));



							if ($st_date_t > $quotadate) {

								$quota_days_TD = 1 + floor((strtotime($end_date_t) - strtotime($st_date_t)) / (60 * 60 * 24));
							} else {

								$quota_days_TD = 1 + floor((strtotime($end_date_t) - strtotime($quotadate)) / (60 * 60 * 24));
							}
						}



						if ($headtxt == "Last Month") {

							$quota_days = 1 +  floor((strtotime($end_date_t) - strtotime($st_date_t)) / (60 * 60 * 24));
						} else {

							$quota_days = date("t", strtotime($start_Dt));
						}

						$quota_one_day = $quota / $quota_days;

						//echo "test : " . $headtxt. " " . $end_Dt. " " . $st_date_t . " " . $end_date_t . " " . $quota_days . " " . $quota_one_day . " " . $quota_days_TD . " " . $dim. "<br>";

						$quota_in_st_en = $quota_one_day * $quota_days_TD;

						//$monthly_qtd = $quota*$dim/$total_days_this_year;



						//echo "quota : " . $headtxt . " " . $start_Dt. " " . $st_date_t . " " . $end_date_t . " " . $quota . " " . $dim . " " . $quota_days . "<br>";



						if ($headtxt == "This Month") {

							$monthly_qtd = (date("d") * $quota) / date("t");
						} else {

							$monthly_qtd = $quota * $dim / $quota_days;
						}
					}



					if ($headtxt == "TTLY Week") {

						$begin = new DateTime($start_Dt);

						$end   = new DateTime($end_Dt);

						$currentdate  = new DateTime(date("Y-m-d"));

						$quota = 0;
						$quota_to_date = 0;

						for ($datecnt = $begin; $datecnt <= $end; $datecnt->modify('+1 day')) {

							$start_Dt_tmp = $datecnt->format("Y-m-d");

							$quota_mtd = 0;

							$newsel = "Select quota_month, quota , deal_quota, quota_year  from employee_quota where emp_id = " . $rowemp["id"] . " and quota_year = " . $datecnt->format("Y") . " and quota_month = " . $datecnt->format("m");
							
							db();
							$result_empq = db_query($newsel);

							while ($rowemp_empq = array_shift($result_empq)) {

								$quota_one_day = $rowemp_empq["quota"] / date('t', strtotime($start_Dt_tmp));

								$quota = $quota + $quota_one_day;

								if ($datecnt <= $currentdate) {

									$quota_to_date = $quota_to_date + $quota_one_day;
								}
							}
						}

						$quota_in_st_en = $quota;

						$monthly_qtd = $quota_to_date;
					}



					if ($headtxt == "This Week" || $headtxt == "Last Week") {

						$begin = new DateTime($start_Dt);

						$end   = new DateTime($end_Dt);

						$currentdate  = new DateTime(date("Y-m-d"));

						$quota = 0;
						$quota_to_date = 0;

						for ($datecnt = $begin; $datecnt <= $end; $datecnt->modify('+1 day')) {

							$start_Dt_tmp = $datecnt->format("Y-m-d");

							$quota_mtd = 0;

							$newsel = "Select quota_month, quota , deal_quota, quota_year  from employee_quota where emp_id = " . $rowemp["id"] . " and quota_year = " . $datecnt->format("Y") . " and quota_month = " . $datecnt->format("m");
							db();
							$result_empq = db_query($newsel);

							while ($rowemp_empq = array_shift($result_empq)) {

								$quota_one_day = $rowemp_empq["quota"] / date('t', strtotime($start_Dt_tmp));

								$quota = $quota + $quota_one_day;

								if ($datecnt <= $currentdate) {

									$quota_to_date = $quota_to_date + $quota_one_day;
								}
							}
						}

						$quota_in_st_en = $quota;

						$monthly_qtd = $quota_to_date;
					}



					if ($headtxt == "This Quarter" || $headtxt == "Last Quarter" || $headtxt == "TTLY Quarter") {

						$current_qtr = ceil(date('n', strtotime($start_Dt)) / 3);

						if ($current_qtr == 1) {
							db();
							$result_empq = db_query("Select quota_month, quota , deal_quota from employee_quota where emp_id = " . $rowemp["id"] . " and quota_year = " . $dt_year_value . " and quota_month in(1,2,3) order by quota_month");

							if ($headtxt == "TTLY Quarter") {

								$date_qtr = date('m/d/Y', strtotime(date($dt_year_value . "-01-01")));
							} else {

								$date_qtr = date('m/d/Y', strtotime(date("Y-01-01")));
							}
						}

						if ($current_qtr == 2) {
							db();
							$result_empq = db_query("Select quota_month, quota , deal_quota from employee_quota where emp_id = " . $rowemp["id"] . " and quota_year = " . $dt_year_value . " and quota_month in(4,5,6) order by quota_month");

							if ($headtxt == "TTLY Quarter") {

								$date_qtr = date('m/d/Y', strtotime(date($dt_year_value . "-04-01")));
							} else {

								$date_qtr = date('m/d/Y', strtotime(date("Y-04-01")));
							}
						}

						if ($current_qtr == 3) {
							db();
							$result_empq = db_query("Select quota_month, quota , deal_quota from employee_quota where emp_id = " . $rowemp["id"] . " and quota_year = " . $dt_year_value . " and quota_month in(7,8,9) order by quota_month");

							if ($headtxt == "TTLY Quarter") {

								$date_qtr = date('m/d/Y', strtotime(date($dt_year_value . "-07-01")));
							} else {

								$date_qtr = date('m/d/Y', strtotime(date("Y-07-01")));
							}
						}

						if ($current_qtr == 4) {
							db();
							$result_empq = db_query("Select quota_month, quota , deal_quota from employee_quota where emp_id = " . $rowemp["id"] . " and quota_year = " . $dt_year_value . " and quota_month in(10,11,12) order by quota_month");

							if ($headtxt == "TTLY Quarter") {

								$date_qtr = date('m/d/Y', strtotime(date($dt_year_value . "-10-01")));
							} else {

								$date_qtr = date('m/d/Y', strtotime(date("Y-10-01")));
							}
						}

						$quota_mtd = 0;
						$donot_add = "";
						$days_in_month = 30;

						$dt_month_value_1 = date('m');

						while ($rowemp_empq = array_shift($result_empq)) {

							$quota = $quota + $rowemp_empq["quota"];

							//$deal_quota = $rowemp_empq["deal_quota"];

							if ($headtxt == "This Quarter") {

								$todays_dt = date('m/d/Y');

								$days_today = 1 + dateDiff($todays_dt, date('Y-m-01'));

								$days_in_month = 1 + dateDiff(date('Y-m-t'), date('Y-m-01'));
							}

							if ($headtxt == "TTLY Quarter") {

								$todays_dt = date($dt_year_value . "-m-d");

								$days_today = 1 + dateDiff($todays_dt, date($dt_year_value . "-m-01"));

								$days_in_month = 1 + dateDiff(date($dt_year_value . '-m-t'), date($dt_year_value . '-m-01'));
							}

							if ($headtxt == "Last Quarter") {

								$days_today = 91;
							}

							if ($donot_add == "") {

								if ($rowemp_empq["quota_month"] <= $dt_month_value_1) {

									if ($rowemp_empq["quota_month"] == $dt_month_value_1) {

										$donot_add = "yes";

										$monthly_qtd_1 = ($days_today * $rowemp_empq["quota"]) / $days_in_month;



										$quota_mtd = $quota_mtd + $monthly_qtd_1;
									} else {

										$quota_mtd = $quota_mtd + $rowemp_empq["quota"];
									}
								}
							}
						}



						//$quota_days = 91;

						//$quota_one_day = $quota/$quota_days;



						$quota_in_st_en = $quota;



						/*if ($headtxt == "This Quarter") {
					$todays_dt=date('m/d/Y');
					$days_today = dateDiff($todays_dt,$date_qtr);
				}
				if ($headtxt == "TTLY Quarter") {
					$todays_dt=date($dt_year_value ."-m-d");
					$days_today = dateDiff($todays_dt,$date_qtr);
				}
				$monthly_qtd = ($days_today*$quota)/91;*/



						if ($headtxt == "Last Quarter") {

							$monthly_qtd = ($days_today * $quota) / 91;
						} else {

							$monthly_qtd = $quota_mtd;
						}
					}



					if ($headtxt == "This Year" || $headtxt == "Last Year" || $headtxt == "TTLY Year") {

						$quota_mtd = 0;
						$donot_add = "";
						$days_in_month = 0;

						$dt_month_value_1 = date('m');
						db();
						$result_empq = db_query("Select quota_month, quota, deal_quota from employee_quota where emp_id = " . $rowemp["id"] . " and quota_year = " . $dt_year_value . " order by quota_month");

						while ($rowemp_empq = array_shift($result_empq)) {

							$quota = $quota + $rowemp_empq["quota"];

							//$deal_quota = $rowemp_empq["deal_quota"];



							if ($headtxt == "This Year") {

								$todays_dt = date('m/d/Y');

								$days_today = 1 + dateDiff($todays_dt, date('Y-m-01'));

								$days_in_month = 1 + dateDiff(date('Y-m-t'), date('Y-m-01'));
							}

							if ($headtxt == "TTLY Year") {

								$todays_dt = date($dt_year_value . "-m-d");

								$days_today = 1 + dateDiff($todays_dt, date($dt_year_value . "-m-01"));

								$days_in_month = 1 + dateDiff(date($dt_year_value . '-m-t'), date($dt_year_value . '-m-01'));
							}

							if ($headtxt == "Last Year") {

								$days_today = 365;
							}

							if ($donot_add == "") {

								if ($rowemp_empq["quota_month"] <= $dt_month_value_1) {

									if ($rowemp_empq["quota_month"] == $dt_month_value_1) {

										$donot_add = "yes";

										$monthly_qtd_1 = ($days_today * $rowemp_empq["quota"]) / $days_in_month;



										$quota_mtd = $quota_mtd + $monthly_qtd_1;
									} else {

										$quota_mtd = $quota_mtd + $rowemp_empq["quota"];
									}
								}
							}
						}



						//$quota_days = 365;

						//$quota_one_day = $quota/$quota_days;



						$quota_in_st_en = $quota;



						/*$date_qtr = date('m/d/Y', strtotime(date("Y-01-01"))); 
				if ($headtxt == "This Year") {
					$todays_dt=date('m/d/Y');
					$days_today = dateDiff($todays_dt,$date_qtr);
				}
				if ($headtxt == "TTLY Year") {
					$todays_dt=date($dt_year_value . '-m-d');
					$date_qtr=date($dt_year_value . '-01-01');
					$days_today = dateDiff($todays_dt,$date_qtr);
				}*/

						if ($headtxt == "Last Year") {

							$monthly_qtd = ($days_today * $quota) / 365;
						} else {

							$monthly_qtd = $quota_mtd;
						}
					}



					$lisoftrans = "<span style='width:800px;'><table cellSpacing='1' cellPadding='1' border='0' width='780'>";

					$lisoftrans .= "<tr><td class='txtstyle_color'>LOOP ID</td><td class='txtstyle_color'>Company Nickname</td><td class='txtstyle_color'>Revenue Amount</td></tr>";



					if ($tilltoday == "Y") {

						//$sqlmtd = "SELECT inv_amount, loop_transaction_buyer.id, loop_transaction_buyer.warehouse_id, loop_warehouse.b2bid FROM loop_transaction_buyer inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id WHERE inv_amount > 0 and po_employee LIKE '" . $rowemp["initials"] . "' AND loop_transaction_buyer.ignore < 1 AND STR_TO_DATE(inv_date_of, '%m/%d/%Y') BETWEEN '" . $start_Dt . "'  AND SYSDATE()";
						$sqlmtd = "SELECT loop_transaction_buyer.inv_amount as invsent_amt , loop_invoice_details.total as inv_amount, loop_transaction_buyer.id, loop_transaction_buyer.warehouse_id, loop_warehouse.b2bid FROM loop_transaction_buyer left join loop_invoice_details on loop_invoice_details.trans_rec_id = loop_transaction_buyer.id inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id WHERE loop_invoice_details.total > 0 and po_employee LIKE '" . $rowemp["initials"] . "' AND loop_transaction_buyer.ignore < 1 AND (case when inv_date_of is NULL or inv_date_of = '' then loop_invoice_details.timestamp else STR_TO_DATE(inv_date_of, '%m/%d/%Y') end) BETWEEN '" . $start_Dt . "' AND '" . Date("Y-m-d") . " 23:59:59'";
					} else {

						//$sqlmtd = "SELECT inv_amount, loop_transaction_buyer.id, loop_transaction_buyer.warehouse_id, loop_warehouse.b2bid FROM loop_transaction_buyer inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id  WHERE inv_amount > 0 and po_employee LIKE '" . $rowemp["initials"] . "' AND loop_transaction_buyer.ignore < 1 AND STR_TO_DATE(inv_date_of, '%m/%d/%Y') BETWEEN '" . $start_Dt . "'  AND '" . $end_Dt . " 23:59:59'";
						$sqlmtd = "SELECT loop_transaction_buyer.inv_amount as invsent_amt , loop_invoice_details.total as inv_amount, loop_transaction_buyer.id, loop_transaction_buyer.warehouse_id, loop_warehouse.b2bid FROM loop_transaction_buyer left join loop_invoice_details on loop_invoice_details.trans_rec_id = loop_transaction_buyer.id inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id WHERE loop_invoice_details.total > 0 and po_employee LIKE '" . $rowemp["initials"] . "' AND loop_transaction_buyer.ignore < 1 AND (case when inv_date_of is NULL or inv_date_of = '' then loop_invoice_details.timestamp else STR_TO_DATE(inv_date_of, '%m/%d/%Y') end) BETWEEN '" . $start_Dt . "'  AND '" . $end_Dt . " 23:59:59'";
					}

					if ($headtxt == "TTLY Week" || $headtxt == "TTLY Quarter" || $headtxt == "TTLY Year" || $headtxt == "TTLY Month") {

						/*if ($headtxt == "TTLY Year") {
					$end_Dt = Date($dt_year_value . '-m-d');
					$start_Dt = Date($dt_year_value . '-01-01');
				}else{
					$end_Dt = Date($dt_year_value . '-m-d');
				}
				$sqlmtd = "SELECT SUM(inv_amount) AS SUMPO, count(inv_amount) as dealcnt FROM loop_transaction_buyer WHERE inv_amount > 0 and po_employee LIKE '" . $rowemp["initials"] . "' AND loop_transaction_buyer.ignore < 1 AND STR_TO_DATE(inv_date_of, '%m/%d/%Y') BETWEEN '" . $start_Dt . "'  AND '" . $end_Dt . " 23:59:59'";
				*/

						if ($headtxt == "LAST TO LAST YEAR") {

							$dt_year_value_1 = $dt_year_value;

							$end_Dtn = Date($dt_year_value_1 . '-12-31');

							$start_Dtn = Date($dt_year_value_1 . '-01-01');
						} else {

							$start_Dtn = $start_Dt;

							$end_Dtn = $end_Dt;
						}

						//$sqlmtd = "SELECT SUM(inv_amount) AS SUMPO, count(inv_amount) as dealcnt FROM loop_transaction_buyer WHERE inv_amount > 0 and po_employee LIKE '" . $rowemp["initials"] . "' AND loop_transaction_buyer.ignore < 1 AND STR_TO_DATE(inv_date_of, '%m/%d/%Y') BETWEEN '" . $start_Dtn . "'  AND '" . $end_Dtn . " 23:59:59'";

						//$sqlmtd = "SELECT inv_amount, loop_transaction_buyer.id, loop_transaction_buyer.warehouse_id, loop_warehouse.b2bid FROM loop_transaction_buyer inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id WHERE inv_amount > 0 and po_employee LIKE '" . $rowemp["initials"] . "' AND loop_transaction_buyer.ignore < 1 AND STR_TO_DATE(inv_date_of, '%m/%d/%Y') BETWEEN '" . $start_Dtn . "'  AND '" . $end_Dtn . " 23:59:59'";
						$sqlmtd = "SELECT loop_transaction_buyer.inv_amount as invsent_amt , loop_invoice_details.total as inv_amount, loop_transaction_buyer.id, loop_transaction_buyer.warehouse_id, loop_warehouse.b2bid FROM loop_transaction_buyer left join loop_invoice_details on loop_invoice_details.trans_rec_id = loop_transaction_buyer.id inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id WHERE loop_invoice_details.total > 0 and po_employee LIKE '" . $rowemp["initials"] . "' AND loop_transaction_buyer.ignore < 1 AND (case when inv_date_of is NULL or inv_date_of = '' then loop_invoice_details.timestamp else STR_TO_DATE(inv_date_of, '%m/%d/%Y') end) BETWEEN '" . $start_Dtn . "'  AND '" . $end_Dtn . " 23:59:59'";
					}

					db();
					$resultmtd = db_query($sqlmtd);

					$summtd_SUMPO = 0;
					$summtd_dealcnt = 0;

					while ($summtd = array_shift($resultmtd)) {

						$nickname = "";

						if ($summtd["b2bid"] > 0) {

							$sql = "SELECT nickname, company, shipCity, shipState FROM companyInfo where ID = " . $summtd["b2bid"];

							db_b2b();

							$result_comp = db_query($sql);

							while ($row_comp = array_shift($result_comp)) {

								$tmppos_1 = strpos($row_comp["company"], "-");

								if ($tmppos_1 != false) {

									$nickname = $row_comp["company"];
								} else {

									if ($row_comp["shipCity"] <> "" || $row_comp["shipState"] <> "") {

										$nickname = $row_comp["company"] . " - " . $row_comp["shipCity"] . ", " . $row_comp["shipState"];
									} else {
										$nickname = $row_comp["company"];
									}
								}
							}
						} else {

							$nickname = $summtd["warehouse_name"];
						}

						$finalpaid_amt = 0;

						db();
						$result_finalpmt = db_query("Select ROUND(sum(loop_buyer_payments.amount),2) as amt from loop_buyer_payments where trans_rec_id = " . $summtd["id"]);
						while ($summtd_finalpmt = array_shift($result_finalpmt)) {
							$finalpaid_amt = $summtd_finalpmt["amt"];
						}

						$inv_amt_totake = 0;
						/*if ($finalpaid_amt > 0){
					if ($summtd["invsent_amt"] > 0){
						if ($finalpaid_amt < $summtd["invsent_amt"]){
							$inv_amt_totake= $summtd["invsent_amt"];
						}else{
							$inv_amt_totake= $finalpaid_amt;
						}
					}else{
						if ($finalpaid_amt < $summtd["inv_amount"]){
							$inv_amt_totake= $summtd["inv_amount"];
						}else{
							$inv_amt_totake= $finalpaid_amt;
						}
					}
				}
				if ($inv_amt_totake == 0 && $summtd["inv_amount"] > 0){
					if ($summtd["invsent_amt"] < $summtd["inv_amount"]){
						$inv_amt_totake= $summtd["inv_amount"];
					}else{
						$inv_amt_totake= $summtd["invsent_amt"];
					}				
				}
				if ($inv_amt_totake == 0 && $summtd["invsent_amt"] > 0){
					$inv_amt_totake= $summtd["invsent_amt"];
				}*/
						if ($finalpaid_amt > 0) {
							$inv_amt_totake = $finalpaid_amt;
						}
						if ($finalpaid_amt == 0 && $summtd["invsent_amt"] > 0) {
							$inv_amt_totake = $summtd["invsent_amt"];
						}
						if ($finalpaid_amt == 0 && $summtd["invsent_amt"] == 0 && $summtd["inv_amount"] > 0) {
							$inv_amt_totake = $summtd["inv_amount"];
						}

						$summtd_SUMPO = $summtd_SUMPO + $inv_amt_totake;

						$summtd_dealcnt = $summtd_dealcnt + 1;

						$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany.php?ID=" . $summtd["b2bid"] . "&show=transactions&warehouse_id=" . $summtd["warehouse_id"] . "&rec_type=Supplier&proc=View&searchcrit=&id=" . $summtd["warehouse_id"] . "&rec_id=" . $summtd["id"] . "&display=buyer_payment'>" . $summtd["id"] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td><td bgColor='#E4EAEB' align='right'>$" . number_format($inv_amt_totake, 0) . "</td></tr>";
					}

					if ($summtd_SUMPO > 0) {

						$lisoftrans .= "<tr><td bgColor='#ABC5DF'>&nbsp;</td><td bgColor='#ABC5DF'>&nbsp;</td><td bgColor='#ABC5DF' align='right'>$" . number_format($summtd_SUMPO, 0) . "</td></tr>";
					}

					$lisoftrans .= "</table></span>";



					//echo "$" . number_format($sumytd["SUMPO"],0);

					//$monthly_actual = 0 + $summtd_SUMPO;

					//$monthly_percentage = 100* ( $summtd_SUMPO/($quota*$dim/$quota_days));



					$summtd_dealcnt_tot = $summtd_dealcnt_tot + $summtd_dealcnt;

					$quota_in_st_en_tot = $quota_in_st_en_tot + $quota_in_st_en;

					$monthly_qtd_tot = $monthly_qtd_tot + $monthly_qtd;

					$summtd_SUMPO_tot = $summtd_SUMPO_tot + $summtd_SUMPO;
				}

				$MGArray = array();

				if ($quota_in_st_en_tot > 0) {

					if ($summtd_SUMPO_tot >= $monthly_qtd_tot) {
						$color = "green";
					} elseif ($summtd_SUMPO_tot < $monthly_qtd_tot) {
						$color = "red";
					} else {
						$color = "black";
					};

					if ($monthly_qtd_tot == 0) {
						$color = "black";
					}

					$MGArray[] = [
							'name'        => '',
							'deal_count'  => $summtd_dealcnt_tot,
							'quota'       => $quota_in_st_en_tot,
							'quotatodate' => $monthly_qtd_tot,
							'po_entered'  => $summtd_SUMPO_tot, 
							'percent_val' => $color, 
							'lisoftrans'  => $lisoftrans
					];
				}



				$_SESSION['sortarrayn'] = $MGArray;



				$sort_order_pre = "ASC";

				if ($_POST['sort_order_pre'] == "ASC") {

					$sort_order_pre = "DESC";
				} else {

					$sort_order_pre = "ASC";
				}



				if (isset($_REQUEST["sort"])) {

					$MGArray = $_SESSION['sortarrayn'];

					if ($_POST['sort'] == "name" && $_POST['sort_order_pre'] == "ASC") {

						$MGArraysort_I = array();



						foreach ($MGArray as $MGArraytmp) {

							$MGArraysort_I[] = $MGArraytmp['companyID'];
						}

						array_multisort($MGArraysort_I, SORT_ASC, SORT_NUMERIC, $MGArray);
					}
				} else {



					$MGArray = $_SESSION['sortarrayn'];

					$MGArraysort_I = array();



					foreach ($MGArray as $MGArraytmp) {

						$MGArraysort_I[] = $MGArraytmp['po_entered'];
					}

					array_multisort($MGArraysort_I, SORT_DESC, SORT_NUMERIC, $MGArray);
				}

				$tot_quota_mtd = 0;
				$tot_quotaactual_mtd = 0;
				$tot_quota_deal_mtd = 0;

				foreach ($MGArray as $MGArraytmp2) {



					$name = $MGArraytmp2["name"];

					$monthly_deal_qtd = $MGArraytmp2["deal_count"];

					$monthly_qtd = $MGArraytmp2["quota"];

					$monthly_qtd_TD = $MGArraytmp2["quotatodate"];

					$summtd_SUMPO = $MGArraytmp2["po_entered"];

					//$monthly_percentage = $MGArraytmp2["percent_val"];



					//if ($monthly_percentage >= 100 ) { $color_y = "green"; } elseif ($monthly_percentage >= 80 ) { $color_y = "E0B003"; } else { $color_y = "B03030"; };

					$color_y = $MGArraytmp2["percent_val"];



					echo "<td bgColor='$tbl_color' align ='left'>" . $headtxt . "</td><td bgColor='$tbl_color' align = right>";

					echo number_format($monthly_deal_qtd, 0);

					if ($currentyr == "Y") {

						echo "</td><td bgColor='$tbl_color' align = 'right'>";

						echo "$" . number_format($monthly_qtd, 0);

						echo "</td><td bgColor='$tbl_color' align = 'right'>";

						echo "$" . number_format($monthly_qtd_TD, 0);
					} else {

						echo "</td><td bgColor='$tbl_color' align = 'right'>";

						echo "$" . number_format($monthly_qtd, 0);
					}



					echo "</td><td bgColor='$tbl_color' align = 'right'><a href='#' onclick='load_div(" . $unqid . $MGArraytmp2["empid"] . "); return false;'><font color='" . $color_y . "'>$" . number_format($summtd_SUMPO, 0) . "</font></a>";

					echo "<span id='" . $unqid . $MGArraytmp2["empid"] . "' style='display:none;'><a href='#' onclick='close_div(); return false;'>Close</a>" . $MGArraytmp2["lisoftrans"] . "</span>";

					echo "</td>";



					//$monthly_qtd = number_format($monthly_qtd,0);

					//$summtd_SUMPO = number_format($summtd_SUMPO,0);

					$monthly_deal_qtd = number_format($monthly_deal_qtd, 0);



					$tot_quota_mtd = $tot_quota_mtd + $monthly_qtd;

					$tot_quota_mtd_TD = $tot_quota_mtd_TD + $monthly_qtd_TD;

					$tot_quotaactual_mtd = $tot_quotaactual_mtd + $summtd_SUMPO;

					$tot_quota_deal_mtd = $tot_quota_deal_mtd + $monthly_deal_qtd;
				}
			}

			?>

			<!-- Load the page by default with old logic - do not apply date range-->

			<table border="0">

				<tr>
					<td colspan="3" align="left">

						<form method="get" name="rpt_leaderboard" action="report_account_manager_summary.php">

							<table border="0">
								<tr>

									<td>

										Select Employee: <select name="emp_sel">
											<option value="All">All</option>
											<?php
											db();
											$sql = "SELECT * FROM loop_employees order by status, name";
											$result = db_query($sql);
											while ($myrowsel = array_shift($result)) {
												echo "<option value=" . $myrowsel["initials"] . " ";

												if (isset($_REQUEST["emp_sel"])) {
													if ($myrowsel["initials"] == $_REQUEST["emp_sel"]) echo " selected ";
												}
												if ($myrowsel["status"] != 'Active') {
													echo " >" . $myrowsel["name"] . "(Inactive)</option>";
												} else {
													echo " >" . $myrowsel["name"] . "</option>";
												}
											}
											?>
										</select>

									</td>

									<td>

										<input type=submit value="Run Report">

									</td>

								</tr>

							</table>

						</form>

					</td>
				</tr>

				<?php

				$in_dt_range = "no";

				$date_from_val = date("Y-m-d");

				$in_dt_range = "no";



				//if( $_GET["date_from"] !=""){

				//	$date_from_val = date("Y-m-d", strtotime($_GET["date_from"]));

				//	$in_dt_range = "yes";

				//}


				$all_emp = "";
				$emp_name = "";
				$emp_id = "";
				$emp_b2b_id = "";

				if ($_GET["emp_sel"] != "") {

					$all_emp = $_GET["emp_sel"];


					if ($_GET["emp_sel"] != "All") {

						$sql = "SELECT * FROM loop_employees WHERE initials = '" . $all_emp . "'";
						db();
						$result = db_query($sql);

						while ($myrowsel = array_shift($result)) {

							$emp_name = $myrowsel["name"];
							$emp_id = $myrowsel["id"];
							$emp_b2b_id = $myrowsel["b2b_id"];
						}
					} else {

						$all_emp = "All";

						$emp_name = "All";
					}

					$in_dt_range = "yes";
				}



				if ($in_dt_range == "yes") {

				?>



					<tr>

						<td colspan="3">

							<?php

							$tbl_color = '#ABC5DF';

							echo "<table cellSpacing='1' cellPadding='1' border='0' width='1260'>";

							echo "	<tr>";

							echo "		<td align='center' class='txtstyle_color' style='background:$tbl_color' width='420px'><strong>" . chr(34) . $emp_name . chr(34) . " Report for THIS Period</strong></td>";

							echo "		<td align='center' width='50px'>&nbsp;</td>";

							echo "		<td align='center' class='txtstyle_color' style='background:$tbl_color' width='320px'><strong>" . chr(34) . $emp_name . chr(34) . " Report for LAST Period</strong></td>";

							echo "		<td align='center' width='50px'>&nbsp;</td>";

							echo "		<td align='center' class='txtstyle_color' style='background:$tbl_color' width='420px'><strong>" . chr(34) . $emp_name . chr(34) . " Report for THIS TIME LAST YEAR (TTLY) Period</strong></td>";

							echo "	</tr>";

							echo "</table>";

							echo "<table cellSpacing='1' cellPadding='1' border='0' width='1260' id='table9' class='tablesorter'>";

							echo "<thead>";

							echo "	<tr style='height:50px;'>";

							echo "		<th align='left' bgColor='$tbl_color' width='70px'><u>Range</u></th>";

							echo "		<th width='50px' bgColor='$tbl_color' align='center'><u>Deals</u></th>";

							echo "		<th width='100px' bgColor='$tbl_color' align='center'><u>Quota</u></th>";

							echo "		<th width='100px' bgColor='$tbl_color' align='center'><u>Quota To Date</u></th>";

							echo "		<th width='100px' bgColor='$tbl_color' align=center><u>Revenue</u></th>";

							echo "		<th align='left' width='50px'>&nbsp;</th>";

							echo "		<th align='left' bgColor='$tbl_color' width='70px'><u>Range</u></th>";

							echo "		<th width='50px' bgColor='$tbl_color' align='center'><u>Deals</u></th>";

							echo "		<th width='100px' bgColor='$tbl_color' align='center'><u>Quota</u></th>";

							echo "		<th width='100px' bgColor='$tbl_color' align=center><u>Revenue</u></th>";

							echo "		<th align='left' width='50px'>&nbsp;</th>";

							echo "		<th align='left' bgColor='$tbl_color' width='70px'><u>Range</u></th>";

							echo "		<th width='50px' bgColor='$tbl_color' align='center'><u>Deals</u></th>";

							echo "		<th width='100px' bgColor='$tbl_color' align='center'><u>Quota</u></th>";

							echo "		<th width='100px' bgColor='$tbl_color' align='center'><u>Quota To Date</u></th>";

							echo "		<th width='100px' bgColor='$tbl_color' align=center><u>Revenue To Date</u></th>";

							echo "	</tr>";

							echo "</thead>";

							echo "<tbody>";



							$last_yr = Date('Y') - 1;

							$yesterday = date("Y-m-d", strtotime("-1 days"));

							$unqid = 1;

							?>

					<tr>

						<?php leadertbl(Date('Y-m-d', strtotime($date_from_val)), Date('Y-m-d', strtotime($date_from_val)), "Today", 'N', 'Y', '#ABC5DF', '#E4EAEB', $all_emp, $unqid); ?>

						<td width="50">&nbsp;</td>

						<?php

						$unqid = $unqid + 1;

						leadertbl($yesterday, $yesterday, "Yesterday", 'N', 'N', '#ABC5DF', '#E4EAEB', $all_emp, $unqid); ?>

						<td width="50">&nbsp;</td>

						<?php

						$unqid = $unqid + 1;

						leadertbl(Date($last_yr . '-m-d'), Date($last_yr . '-m-d'), "TTLY Today", 'N', 'Y', '#ABC5DF', '#E4EAEB', $all_emp, $unqid); ?>

					</tr>

					<tr>

						<?php

						$time = strtotime($date_from_val);



						if (date('l', $time) != "Friday") {

							$st_friday = strtotime('last friday', $time);
						} else {

							$st_friday = $time;
						}

						$st_friday_last = strtotime('-7 days', $st_friday);

						$st_thursday_last = strtotime('+6 days', $st_friday_last);

						$st_thursday = strtotime('+6 days', $st_friday);



						$st_date = Date('Y-m-d', $st_friday);

						$end_date = Date('Y-m-d', $st_thursday);



						$st_date_lastyr = Date($last_yr . '-m-d', strtotime($st_date));

						$end_date_lastyr = Date($last_yr . '-m-d', strtotime($end_date));



						$st_friday_last = Date('Y-m-d', $st_friday_last);

						$st_thursday_last = Date('Y-m-d', $st_thursday_last);

						?>



						<?php

						$unqid = $unqid + 1;

						leadertbl($st_date, $end_date, "This Week", 'Y', 'Y', '#ABC5DF', '#E4EAEB', $all_emp, $unqid); ?>

						<td width="50">&nbsp;</td>

						<?php

						$unqid = $unqid + 1;

						leadertbl($st_friday_last, $st_thursday_last, "Last Week", 'N', 'N', '#ABC5DF', '#E4EAEB', $all_emp, $unqid); ?>

						<td width="50">&nbsp;</td>

						<?php

						$unqid = $unqid + 1;

						leadertbl($st_date_lastyr, $end_date_lastyr, "TTLY Week", 'N', 'Y', '#ABC5DF', '#E4EAEB', $all_emp, $unqid); ?>

					</tr>

					<tr>

						<?php

						$st_date = Date('Y-m-01', strtotime($date_from_val));

						$end_date = Date('Y-m-t', strtotime($date_from_val));



						$st_date_lastyr = Date($last_yr . '-m-01', strtotime($date_from_val));

						$end_date_lastyr = Date($last_yr . '-m-t', strtotime($date_from_val));



						$st_lastmonth = date('Y-m-01', strtotime($date_from_val . ' last month'));

						$end_lastmonth = date('Y-m-t', strtotime($date_from_val . ' last month'));

						?>

						<?php

						$unqid = $unqid + 1;

						leadertbl($st_date, $end_date, "This Month", 'Y', 'Y', '#ABC5DF', '#E4EAEB', $all_emp, $unqid); ?>

						<td width="50">&nbsp;</td>

						<?php $unqid = $unqid + 1;

						leadertbl($st_lastmonth, $end_lastmonth, "Last Month", 'N', 'N', '#ABC5DF', '#E4EAEB', $all_emp, $unqid); ?>

						<td width="50">&nbsp;</td>

						<?php $unqid = $unqid + 1;

						leadertbl($st_date_lastyr, $end_date_lastyr, "TTLY Month", 'N', 'Y', '#ABC5DF', '#E4EAEB', $all_emp, $unqid); ?>

					</tr>

					<tr>

						<?php

						function getCurrentQuarter($timestamp = false)
						{

							if (!$timestamp) $timestamp = time();

							$day = date('n', strtotime($timestamp));

							$quarter = ceil($day / 3);

							return $quarter;
						}



						function getPreviousQuarter($timestamp = false)
						{

							if (!$timestamp) $timestamp = time();

							$quarter = getCurrentQuarter($timestamp) - 1;

							if ($quarter < 0) {

								$quarter = 4;
							}

							return $quarter;
						}



						$quarter = getCurrentQuarter($date_from_val);



						$year = date('Y', strtotime($date_from_val));



						$st_date_n = new DateTime($year . '-' . ($quarter * 3 - 2) . '-1');

						//Get first day of first month of next quarter

						$endMonth = $quarter * 3 + 1;

						if ($endMonth > 12) {

							$endMonth = 1;

							$year++;
						}

						$end_date_n = new DateTime($year . '-' . $endMonth . '-1');



						//Subtract 1 second to get last day of prior month

						$end_date_n->sub(new DateInterval('PT1S'));

						$st_date = $st_date_n->format('Y-m-d');

						$end_date = $end_date_n->format('Y-m-d');



						$st_date_lastyr = Date($last_yr . '-m-d', strtotime($st_date));

						$end_date_lastyr = Date($last_yr . '-m-d', strtotime($end_date));



						$quarter = getPreviousQuarter($date_from_val);

						$year = date('Y', strtotime($date_from_val));



						/*$st_lastqtr_n = new DateTime($year.'-'.date('m', strtotime($date_from_val)).'-1');
						//Get first day of first month of next quarter
						$endMonth = $quarter*3+1;
						if($endMonth>12){
							$endMonth = 1;
							$year++;
						}
						$end_lastqtr_n = new DateTime($year.'-'.$endMonth.'-1');
						//Subtract 1 second to get last day of prior month
						$end_lastqtr_n->sub(new DateInterval('PT1S'));
						$st_lastqtr = $st_lastqtr_n->format('Y-m-d');
						$end_lastqtr = $end_lastqtr_n->format('Y-m-d');*/



						$current_month = date('m');

						$current_year = date('Y');



						if ($current_month >= 1 && $current_month <= 3) {

							$st_lastqtr = date('Y-m-d', strtotime('1-October-' . ($current_year - 1)));  // timestamp or 1-October Last Year 12:00:00 AM

							$end_lastqtr = date('Y-m-d', strtotime('31-December-' . ($current_year - 1)));  // // timestamp or 1-January  12:00:00 AM means end of 31 December Last year

						} else if ($current_month >= 4 && $current_month <= 6) {

							$st_lastqtr = date('Y-m-d', strtotime('1-January-' . $current_year));  // timestamp or 1-Januray 12:00:00 AM

							$end_lastqtr = date('Y-m-d', strtotime('31-March-' . $current_year));  // timestamp or 1-April 12:00:00 AM means end of 31 March

						} else  if ($current_month >= 7 && $current_month <= 9) {

							$st_lastqtr = date('Y-m-d', strtotime('1-April-' . $current_year));  // timestamp or 1-April 12:00:00 AM

							$end_lastqtr = date('Y-m-d', strtotime('30-June-' . $current_year));  // timestamp or 1-July 12:00:00 AM means end of 30 June

						} else  if ($current_month >= 10 && $current_month <= 12) {

							$st_lastqtr = date('Y-m-d', strtotime('1-July-' . $current_year));  // timestamp or 1-July 12:00:00 AM

							$end_lastqtr = date('Y-m-d', strtotime('30-September-' . $current_year));  // timestamp or 1-October 12:00:00 AM means end of 30 September

						}



						?>



						<?php $unqid = $unqid + 1;

						leadertbl($st_date, $end_date, "This Quarter", 'Y', 'Y', '#ABC5DF', '#E4EAEB', $all_emp, $unqid); ?>

						<td width="50">&nbsp;</td>

						<?php $unqid = $unqid + 1;

						leadertbl($st_lastqtr, $end_lastqtr, "Last Quarter", 'N', 'N', '#ABC5DF', '#E4EAEB', $all_emp, $unqid); ?>

						<td width="50">&nbsp;</td>

						<?php $unqid = $unqid + 1;

						leadertbl($st_date_lastyr, $end_date_lastyr, "TTLY Quarter", 'N', 'Y', '#ABC5DF', '#E4EAEB', $all_emp, $unqid); ?>

					</tr>

					<tr>

						<?php

						$st_date = Date('Y-01-01', strtotime($date_from_val));

						$end_date = Date('Y-12-31', strtotime($date_from_val));



						$st_date_lastyr = Date($last_yr . '-01-01', strtotime($date_from_val));

						$end_date_lastyr = Date($last_yr . '-m-d', strtotime($date_from_val));



						$st_lastyr = date('Y-01-01', strtotime($date_from_val . ' -1 year'));

						$end_lastyr = date('Y-12-31', strtotime($date_from_val . ' -1 year'));

						?>

						<?php $unqid = $unqid + 1;

						leadertbl($st_date, $end_date, "This Year", 'Y', 'Y', '#ABC5DF', '#E4EAEB', $all_emp, $unqid); ?>

						<td width="50">&nbsp;</td>

						<?php $unqid = $unqid + 1;

						leadertbl($st_lastyr, $end_lastyr, "Last Year", 'N', 'N', '#ABC5DF', '#E4EAEB', $all_emp, $unqid); ?>

						<td width="50">&nbsp;</td>

						<?php $unqid = $unqid + 1;

						leadertbl($st_date_lastyr, $end_date_lastyr, "TTLY Year", 'N', 'Y', '#ABC5DF', '#E4EAEB', $all_emp, $unqid); ?>

					</tr>

			</table>

			</td>

			</tr>

			</tbody>

			</table>

			<br><br>

			<table cellSpacing='1' cellPadding='1' border='0' width='1400'>

				<tr>

					<td align='center' class='txtstyle_color' style='font-size:10pt;background:#ABC5DF' colspan='14'><strong>"<?php echo $emp_name; ?>" Summary</strong></td>

				</tr>

			</table>

			<table cellSpacing='1' cellPadding='1' border='0' width='1400' id='table9' class='tablesorter'>

				<thead>

					<tr>

						<th align='left' bgColor='#ABC5DF' width='80px'><u>Range</u></th>

						<th align='left' bgColor='#ABC5DF' width='180px'><u>What</u></th>



						<?php

						for ($month_cnt = 1; $month_cnt <= 12; $month_cnt = $month_cnt + 1) { ?>

							<th align='left' bgColor='#ABC5DF' width='70px'><u><?php echo date("F", mktime(0, 0, 0, $month_cnt, 10)); ?></u></th>

							<?php

							if ($month_cnt == 3) {

								echo "<th bgcolor='#4BACC6' width='90px' align='left'><b>Quarter 1</b></th>";
							}

							if ($month_cnt == 6) {

								echo "<th bgcolor='#4BACC6' width='90px' align='left'><b>Quarter 2</b></th>";
							}

							if ($month_cnt == 9) {

								echo "<th bgcolor='#4BACC6' width='90px' align='left'><b>Quarter 3</b></th>";
							}

							if ($month_cnt == 12) {

								echo "<th bgcolor='#4BACC6' width='90px' align='left'><b>Quarter 4</b></th>";
							}

							?>

						<?php } ?>

						<th align='left' bgColor='#D8E4BC' width='100px'><u><b>Total</b></u></th>

					</tr>

				</thead>

				<tbody>

					<?php

					$tot_po_enter = 0;
					$tot_contact = 0;
					$tot_quota = 0;
					$tot_cost = 0;
					$tot_revenue = 0;
					$tot_revenue_collected = 0;
					$tot_profit = 0;

					$quota_mtd_overall = 0;

					$str_summary = "";
					$emp_st_date = "";

					if ($all_emp != "All") {

						$sql = "SELECT quota, quotadate, b2b_id, deal_quota, id, Official_Start_Date, name FROM loop_employees WHERE initials = '" . $all_emp . "' and Official_Start_Date is not null";
					} else {

						$sql = "SELECT quota, quotadate, b2b_id, deal_quota, id, Official_Start_Date, name FROM loop_employees WHERE id = 10";
					}
					db();
					$result = db_query($sql);

					while ($res = array_shift($result)) {

						$emp_st_date = $res["Official_Start_Date"];
						
						$startyr = Date('Y', strtotime($res["Official_Start_Date"]));
					
						for ($yr_cnt = $startyr; $yr_cnt <= date('Y'); $yr_cnt = $yr_cnt + 1) {

							//Contacts made 
							$emp_yr_contact_tot = 0;
							$emp_qtr_tot = 0;
							$quotes_str = "<tr><td bgcolor='#E4EAEB'>Quotes</td>";
							$emp_yr_quote_tot = 0;
							$emp_qtr_quote_tot = 0;
							$tot_quota = 0;

							echo "<tr ><td rowspan='8' bgcolor='#E4EAEB'>" . $yr_cnt . "</td>";
							echo "<td bgcolor='#E4EAEB'>Contacts (Email+Call)</td>";

							for ($month_cnt = 1; $month_cnt <= 12; $month_cnt = $month_cnt + 1) {
								$month_lastd = Date("Y-m-d", strtotime($yr_cnt . "-" . $month_cnt . "-01"));
								$month_last_dt = date("Y-m-t", strtotime($month_lastd));

								$date1 = new DateTime($emp_st_date);
								$date2 = new DateTime($month_last_dt);

								if ($date1 <= $date2) {

									db_b2b();
									if ($all_emp != "All") {
										$result_crm = db_query("Select sum(leads) as leads, sum(daily_touches) as daily_touches, sum(daily_quotes) as daily_quotes, sum(daily_deals) as daily_deals, 
									sum(email_sent) as email_sent, sum(calls_made) as calls_made, sum(demand_entries) as demand_entries, sum(quote_requests) as quote_requests, 
									sum(first_time_customer) as first_time_customer, sum(sales_po_amunt) as sales_po_amunt, sum(first_time_supplier) as first_time_supplier, sum(purchase_orders) as purchase_orders, 
									sum(po_total) as po_total
									from employee_all_activity_details where entry_date BETWEEN '" . Date("Y-m-d 00:00:00", strtotime($yr_cnt . "-" . $month_cnt . "-01")) . "' AND '" . $month_last_dt . " 00:00:00'
									and employee_id = '" . $emp_id . "'");
									} else {
										$result_crm = db_query("Select sum(leads) as leads, sum(daily_touches) as daily_touches, sum(daily_quotes) as daily_quotes, sum(daily_deals) as daily_deals, 
									sum(email_sent) as email_sent, sum(calls_made) as calls_made, sum(demand_entries) as demand_entries, sum(quote_requests) as quote_requests, 
									sum(first_time_customer) as first_time_customer, sum(sales_po_amunt) as sales_po_amunt, sum(first_time_supplier) as first_time_supplier, sum(purchase_orders) as purchase_orders, 
									sum(po_total) as po_total
									from employee_all_activity_details where entry_date BETWEEN '" . Date("Y-m-d 00:00:00", strtotime($yr_cnt . "-" . $month_cnt . "-01")) . "' AND '" . $month_last_dt . " 00:00:00'");
									}
									$contact_act_tmp = 0;
									$contact_act_ph1 = 0;
									$quote_req_cnt = 0;
									$quotes_sent = 0;
									while ($rowemp_crm = array_shift($result_crm)) {
										//$lead_tmp = $rowemp_crm["leads"] ;
										$contact_act_tmp = $rowemp_crm["email_sent"];
										$contact_act_ph1 = $rowemp_crm["calls_made"];
										//$demand_entry_tmp = $rowemp_crm["demand_entries"] ;
										$quote_req_cnt = $rowemp_crm["quote_requests"];
										$quotes_sent = $rowemp_crm["daily_quotes"];

										$emp_qtr_tot = $emp_qtr_tot + ($contact_act_tmp + $contact_act_ph1);
										$tot_contact = $tot_contact + ($contact_act_tmp + $contact_act_ph1);
										$emp_yr_contact_tot = $emp_yr_contact_tot + ($contact_act_tmp + $contact_act_ph1);

										$emp_yr_quote_tot = $emp_yr_quote_tot + $quotes_sent;
										$emp_qtr_quote_tot = $emp_qtr_quote_tot + $quotes_sent;
										$tot_quota = $tot_quota + $quotes_sent;
									}

									echo "<td bgcolor='#E4EAEB' align='right'>" . ($contact_act_tmp + $contact_act_ph1) . "</td>";
									$quotes_str .= "<td bgcolor='#E4EAEB' align='right'>" . ($quotes_sent) . "</td>";

									if ($month_cnt == 3 || $month_cnt == 6  || $month_cnt == 9 || $month_cnt == 12) {

										echo "<td bgcolor='#B7DEE8' align='right'><b>" . $emp_qtr_tot . "</b></td>";
										$quotes_str .= "<td bgcolor='#B7DEE8' align='right'>" . ($emp_qtr_quote_tot) . "</td>";

										$emp_qtr_tot = 0;
										$emp_qtr_quote_tot = 0;
									}
								} else {

									echo "<td bgcolor='#E4EAEB' align='right'>&nbsp;</td>";
									$quotes_str .= "<td bgcolor='#E4EAEB' align='right'>&nbsp;</td>";

									if ($month_cnt == 3 || $month_cnt == 6  || $month_cnt == 9 || $month_cnt == 12) {

										echo "<td bgcolor='#B7DEE8' align='right'>&nbsp;</td>";
										$quotes_str .= "<td bgcolor='#B7DEE8' align='right'>&nbsp;</td>";

										$emp_qtr_tot = 0;
										$emp_qtr_quote_tot = 0;
									}
								}
							}

							echo "<td bgcolor='#EBF1DE' align='right'><strong>" . $emp_yr_contact_tot . "</strong></td></tr>";
							$quotes_str .= "<td bgcolor='#EBF1DE' align='right'><strong>" . $tot_quota . "</strong></td></tr>";

							//Quotes made
							echo $quotes_str;

							//Po enter

							$emp_yr_poenter_tot = 0;
							$emp_qtr_tot = 0;
							$dim_ytr = 0;
							$emp_yr_deal_tot = 0;

							echo "<tr >";
							echo "<td bgcolor='#E4EAEB'>PO Entered</td>";

							$dt_year_value = date('Y', strtotime($emp_st_date));
							$current_year_value = $yr_cnt;

							$quota = 0;
							$quotadate = "";
							$deal_quota = 0;
							if ($all_emp != "All") {

								if ($current_year_value == $dt_year_value) {
									db();
									$result_empq = db_query("Select * from loop_employee_quota where empid = " . $res["id"] . " and Year(quota_date) = " . $dt_year_value);
									while ($rowemp_empq = array_shift($result_empq)) {
										$quota = $rowemp_empq["quota"];
										$quotadate = $rowemp_empq["quota_date"];
										$deal_quota = $rowemp_empq["deal_quota"];

										$days_this_year = 1 +  floor((strtotime(DATE($dt_year_value . "-12-31")) - strtotime($quotadate)) / (60 * 60 * 24));
									}
								} else {

									$quota = $res["quota"];

									$quotadate = $res["quotadate"];

									$deal_quota = $res["deal_quota"];

									$days_this_year = 366;
								}
							}

							for ($month_cnt = 1; $month_cnt <= 12; $month_cnt = $month_cnt + 1) {
								$month_lastd = Date("Y-m-d", strtotime($yr_cnt . "-" . $month_cnt . "-01"));
								$month_last_dt = date("Y-m-t", strtotime($month_lastd));


								$date1 = new DateTime($emp_st_date);
								$date2 = new DateTime($month_last_dt);

								//echo $emp_st_date . " " . $month_lastd . " " . $diff . "<br>";

								if ($date1 <= $date2) {
									$dim = 1 + floor((strtotime($month_last_dt) - strtotime($yr_cnt . "-" . $month_cnt . "-01")) / (60 * 60 * 24));
									$dim_qtr = $dim_qtr + $dim;
									$dim_ytr = $dim_ytr + $dim;
									$total_days_this_year = $days_this_year;

									if ($all_emp != "All") {
										$sqlmtd = "SELECT sum(round(loop_transaction_buyer.po_poorderamount,0)) as SUMPO, count(po_poorderamount) as dealcnt FROM loop_transaction_buyer WHERE po_employee LIKE '" . $all_emp . "' AND loop_transaction_buyer.ignore < 1 AND transaction_date BETWEEN '" . Date("Y-m-d", strtotime($yr_cnt . "-" . $month_cnt . "-01")) . "' AND '" . $month_last_dt . " 23:59:59'";
									} else {
										$sqlmtd = "SELECT sum(round(loop_transaction_buyer.po_poorderamount,0)) AS SUMPO, count(po_poorderamount) as dealcnt FROM loop_transaction_buyer WHERE loop_transaction_buyer.ignore < 1 AND transaction_date BETWEEN '" . Date("Y-m-d", strtotime($yr_cnt . "-" . $month_cnt . "-01")) . "' AND '" . $month_last_dt . " 23:59:59'";
									}
									db();
									$resultmtd = db_query($sqlmtd);

									$summtd_SUMPO = 0;
									while ($summtd = array_shift($resultmtd)) {
										if ($summtd["SUMPO"] > 0) {
											$summtd_SUMPO = $summtd["SUMPO"];
											$emp_yr_poenter_tot = $emp_yr_poenter_tot + $summtd_SUMPO;
											$tot_po_enter = $tot_po_enter + $summtd_SUMPO;
											$emp_qtr_tot = $emp_qtr_tot + $summtd_SUMPO;
										}

										$emp_yr_deal_tot = $emp_yr_deal_tot + $summtd["dealcnt"];
									}

									//$monthly_percentage = 100* ( $summtd_SUMPO/($quota*$dim/$total_days_this_year));

									//if ($monthly_percentage >= 100 ) { $color_y = "green"; } elseif ($monthly_percentage >= 80 ) { $color_y = "E0B003"; } else { $color_y = "B03030"; };

									echo "<td bgcolor='#E4EAEB' align='right'>$" . number_format($summtd_SUMPO, 0) . "</td>";

									if ($month_cnt == 3 || $month_cnt == 6  || $month_cnt == 9 || $month_cnt == 12) {
										//$monthly_percentage = 100* ( $emp_qtr_tot/($quota*$dim_qtr/$total_days_this_year));
										//if ($monthly_percentage >= 100 ) { $color_y = "green"; } elseif ($monthly_percentage >= 80 ) { $color_y = "E0B003"; } else { $color_y = "B03030"; };

										echo "<td bgcolor='#B7DEE8' align='right'><b>$" . number_format($emp_qtr_tot, 0) . "</b></td>";
										$emp_qtr_tot = 0;
										$dim_qtr = 0;
									}
								} else {

									echo "<td bgcolor='#E4EAEB' align='right'>&nbsp;</td>";
									if ($month_cnt == 3 || $month_cnt == 6  || $month_cnt == 9 || $month_cnt == 12) {
										echo "<td bgcolor='#B7DEE8' align='right'>&nbsp;</td>";
										$emp_qtr_tot = 0;
									}
								}
							}

							//$monthly_percentage = 100* ($emp_yr_poenter_tot/($quota*$dim_ytr/$total_days_this_year));

							//if ($monthly_percentage >= 100 ) { $color_y = "green"; } elseif ($monthly_percentage >= 80 ) { $color_y = "E0B003"; } else { $color_y = "B03030"; };

							echo "<td bgcolor='#EBF1DE' align='right'><strong>$" . number_format($emp_yr_poenter_tot, 0) . "</strong></td></tr>";



							//Revenue Invoiced

							$emp_yr_rev_inv_tot = 0;
							$emp_qtr_tot = 0;
							$quota_month_qtr = 0;
							$quota_yr_qtr = 0;

							echo "<tr >";
							echo "<td bgcolor='#E4EAEB'>Revenue Invoiced</td>";

							for ($month_cnt = 1; $month_cnt <= 12; $month_cnt = $month_cnt + 1) {
								$month_lastd = Date("Y-m-d", strtotime($yr_cnt . "-" . $month_cnt . "-01"));
								$month_last_dt = date("Y-m-t", strtotime($month_lastd));

								$date1 = new DateTime($emp_st_date);
								$date2 = new DateTime($month_last_dt);

								//echo $emp_st_date . " " . $month_lastd . " " . $diff . "<br>";
								if ($date1 <= $date2) {
									if (($yr_cnt == date("Y")) && ($month_cnt == date("m"))) {
										//$dim = 1 + floor((strtotime(date("Y-m-d")) - strtotime($yr_cnt . "-" . $month_cnt . "-01")/(60*60*24)));
									} else {
										$dim = 1 + floor((strtotime($month_last_dt) - strtotime($yr_cnt . "-" . $month_cnt . "-01")) / (60 * 60 * 24));
									}

									$st_date_t = Date('Y-m-01', strtotime($yr_cnt . "-" . $month_cnt . "-01"));
									$end_date_t = Date('Y-m-t', strtotime($yr_cnt . "-" . $month_cnt . "-01"));

									$quota_days = 1 +  floor((strtotime($end_date_t) - strtotime($st_date_t)) / (60 * 60 * 24));
									$quota_month = 0;

									if ($all_emp != "All") {
										db();
										$result_empq = db_query("Select sum(quota) as sumquota from employee_quota where emp_id = " . $res["id"] . " and quota_year = " . $yr_cnt . " and quota_month = " . $month_cnt);
									} else {
										db();
										$result_empq = db_query("Select sum(quota) as sumquota from employee_quota where quota_year = " . $yr_cnt . " and quota_month = " . $month_cnt);
									}
									while ($rowemp_empq = array_shift($result_empq)) {
										$quota_month = $rowemp_empq["sumquota"];
									}

									$quota_month_qtr = $quota_month_qtr + $quota_month;
									$quota_yr_qtr = $quota_yr_qtr + $quota_month;

									if ($all_emp != "All") {
										//$sqlmtd = "SELECT SUM(inv_amount) AS SUMPO FROM loop_transaction_buyer WHERE po_employee LIKE '" . $all_emp . "' AND loop_transaction_buyer.ignore < 1 AND inv_amount > 0 and STR_TO_DATE(inv_date_of, '%m/%d/%Y') BETWEEN '" . Date("Y-m-d", strtotime($yr_cnt . "-" . $month_cnt . "-01")) . "' AND '" . $month_last_dt . " 23:59:59'";
										$sqlmtd = "SELECT loop_transaction_buyer.inv_amount as invsent_amt, loop_invoice_details.total as inv_amount, loop_transaction_buyer.id, loop_transaction_buyer.warehouse_id, loop_warehouse.b2bid FROM loop_transaction_buyer left join loop_invoice_details on loop_invoice_details.trans_rec_id = loop_transaction_buyer.id inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id WHERE loop_invoice_details.total > 0 and po_employee LIKE '" . $all_emp . "' AND loop_transaction_buyer.ignore < 1 AND (case when inv_date_of is NULL or inv_date_of = '' then loop_invoice_details.timestamp else STR_TO_DATE(inv_date_of, '%m/%d/%Y') end) BETWEEN '" . Date("Y-m-d", strtotime($yr_cnt . "-" . $month_cnt . "-01")) . "' AND '" . $month_last_dt . " 23:59:59'";
									} else {
										//$sqlmtd = "SELECT SUM(inv_amount) AS SUMPO FROM loop_transaction_buyer WHERE loop_transaction_buyer.ignore < 1 AND inv_amount > 0 and STR_TO_DATE(inv_date_of, '%m/%d/%Y') BETWEEN '" . Date("Y-m-d", strtotime($yr_cnt . "-" . $month_cnt . "-01")) . "' AND '" . $month_last_dt . " 23:59:59'";
										$sqlmtd = "SELECT loop_transaction_buyer.inv_amount as invsent_amt, loop_invoice_details.total as inv_amount, loop_transaction_buyer.id, loop_transaction_buyer.warehouse_id, loop_warehouse.b2bid FROM loop_transaction_buyer left join loop_invoice_details on loop_invoice_details.trans_rec_id = loop_transaction_buyer.id inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id WHERE loop_invoice_details.total > 0 AND loop_transaction_buyer.ignore < 1 AND (case when inv_date_of is NULL or inv_date_of = '' then loop_invoice_details.timestamp else STR_TO_DATE(inv_date_of, '%m/%d/%Y') end) BETWEEN '" . Date("Y-m-d", strtotime($yr_cnt . "-" . $month_cnt . "-01")) . "' AND '" . $month_last_dt . " 23:59:59'";
									}
									db();
									$resultmtd = db_query($sqlmtd);

									$summtd_SUMPO = 0;
									$summtd_dealcnt = 0;

									while ($summtd = array_shift($resultmtd)) {

										$inv_amt_totake = 0;
										if ($summtd["invsent_amt"] > 0) {
											$inv_amt_totake = str_replace(",", "", $summtd["invsent_amt"]);
										}
										if ($summtd["invsent_amt"] == 0 && $summtd["inv_amount"] > 0) {
											$inv_amt_totake = str_replace(",", "", $summtd["inv_amount"]);
										}

										$summtd_SUMPO = $summtd_SUMPO + str_replace(",", "", number_format($inv_amt_totake, 0));

										//echo "F" . $finalpaid_amt . " " . $summtd["invsent_amt"] . " " . $summtd["inv_amount"] . "<br>";
										//echo $inv_amt_totake . "<br>";

										$emp_yr_rev_inv_tot = $emp_yr_rev_inv_tot + str_replace(",", "", number_format($inv_amt_totake, 0));

										$tot_revenue = $tot_revenue + str_replace(",", "", number_format($inv_amt_totake, 0));

										$emp_qtr_tot = $emp_qtr_tot + str_replace(",", "", number_format($inv_amt_totake, 0));

										//$summtd_dealcnt = $summtd["dealcnt"];
									}

									if (($yr_cnt == date("Y")) && ($month_cnt == date("m"))) {
										$quota_mtd = (date("d") * $quota_month) / date("t");
									} else {
										$quota_mtd = $quota_month * $dim / $quota_days;
									}

									//echo $yr_cnt . " " . $month_cnt . ": " . $quota_month . " ". $dim . " " . $quota_days . " " . $quota_mtd . "<br>";
									if ($summtd_SUMPO >= $quota_mtd) {
										$color = "green";
									} elseif ($summtd_SUMPO < $quota_mtd) {
										$color = "red";
									} else {
										$color = "black";
									};

									if ($quota_mtd == 0) {
										$color = "black";
									}

									if (($yr_cnt == date("Y")) && ($month_cnt > date("m"))) {
										$color = "black";
									}

									echo "<td bgcolor='#E4EAEB' align='right'><font color='" . $color . "'>$" . number_format($summtd_SUMPO, 0) . "</font></td>";
									if ($month_cnt == 3 || $month_cnt == 6  || $month_cnt == 9 || $month_cnt == 12) {

										$current_qtr_t = ceil(date('n') / 3);

										$qtr_on_dt = ceil(date('n', strtotime($yr_cnt . "-" . $month_cnt . "-01")) / 3);



										if ($yr_cnt == date("Y") && $current_qtr_t == $qtr_on_dt) {

											if ($current_qtr_t == 1) {

												$date_qtr = date('m/d/Y', strtotime(date("Y-01-01")));
											}

											if ($current_qtr_t == 2) {

												$date_qtr = date('m/d/Y', strtotime(date("Y-04-01")));
											}

											if ($current_qtr_t == 3) {

												$date_qtr = date('m/d/Y', strtotime(date("Y-07-01")));
											}

											if ($current_qtr_t == 4) {

												$date_qtr = date('m/d/Y', strtotime(date("Y-10-01")));
											}

											$todays_dt = date('m/d/Y');

											$days_today = dateDiff($todays_dt, $date_qtr);

											$quota_mtd = ($days_today * $quota_month_qtr) / 91;
										} else {

											$quota_mtd = $quota_month_qtr;
										}

										//echo "quota_mtd: " . $quota_mtd . " $yr_cnt $current_qtr_t<br>";

										if ($emp_qtr_tot >= $quota_mtd) {
											$color = "green";
										} elseif ($emp_qtr_tot < $quota_mtd) {
											$color = "red";
										} else {
											$color = "black";
										};

										if ($quota_mtd == 0) {
											$color = "black";
										}



										if (($yr_cnt == date("Y")) && ($qtr_on_dt > $current_qtr_t)) {
											$color = "black";
										}

										echo "<td bgcolor='#B7DEE8' align='right'><font color='" . $color . "'><b>$" . number_format($emp_qtr_tot, 0) . "</b></font></td>";

										$emp_qtr_tot = 0;
										$quota_month_qtr = 0;
									}
								} else {

									echo "<td bgcolor='#E4EAEB' align='right'>&nbsp;</td>";

									if ($month_cnt == 3 || $month_cnt == 6  || $month_cnt == 9 || $month_cnt == 12) {

										echo "<td bgcolor='#B7DEE8' align='right'>&nbsp;</td>";

										$emp_qtr_tot = 0;
									}
								}
							}

							$quota_mtd = $quota_yr_qtr;

							$quota_mtd_overall = $quota_mtd_overall + $quota_mtd;

							//echo "quota_yr_qtr: " . $quota_mtd . "<br>";

							if ($emp_yr_rev_inv_tot >= $quota_mtd) {
								$color = "green";
							} elseif ($emp_yr_rev_inv_tot < $quota_mtd) {
								$color = "red";
							} else {
								$color = "black";
							};

							if ($quota_mtd == 0) {
								$color = "black";
							}



							echo "<td bgcolor='#EBF1DE' align='right'><font color='" . $color . "'><strong>$" . number_format($emp_yr_rev_inv_tot, 0) . "</strong></font></td></tr>";



							//Revenue Collected

							$emp_yr_rev_coll_tot = 0;
							$emp_qtr_tot = 0;
							$emp_qtr_tot_cost = 0;
							$emp_yr_cost_tot = 0;

							$emp_yr_grossprf_tot = 0;
							$emp_yr_tot2 = 0;
							$profit_margin = 0;
							$emp_qtr_tot_grprf = 0;

							echo "<tr >";

							echo "<td bgcolor='#E4EAEB'>Revenue Collected</td>";

							$str_cost = "<tr ><td bgcolor='#E4EAEB'>Cost</td>";

							$str_gross_profit = "<tr ><td bgcolor='#E4EAEB'>Gross Profit</td>";

							$str_avg_profit = "<tr ><td bgcolor='#E4EAEB'>Avg Profit Margin</td>";



							for ($month_cnt = 1; $month_cnt <= 12; $month_cnt = $month_cnt + 1) {

								$month_lastd = Date("Y-m-d", strtotime($yr_cnt . "-" . $month_cnt . "-01"));

								$month_last_dt = date("Y-m-t", strtotime($month_lastd));



								$date1 = new DateTime($emp_st_date);

								$date2 = new DateTime($month_last_dt);



								//echo $emp_st_date . " " . $month_lastd . " " . $diff . "<br>";

								if ($date1 <= $date2) {

									if ($all_emp != "All") {

										$sqlmtd = "SELECT loop_transaction_buyer.report_commissions_bydate, loop_transaction_buyer.report_commissions_by, loop_warehouse.company_name AS B, loop_warehouse.b2bid, ";

										$sqlmtd .= " loop_transaction_buyer.warehouse_id AS D, loop_transaction_buyer.inv_amount AS F, loop_transaction_buyer.so_entered AS G, loop_transaction_buyer.po_date AS H , ";

										$sqlmtd .= " loop_transaction_buyer.id AS I, loop_transaction_buyer.inv_date_of AS J FROM loop_transaction_buyer INNER JOIN loop_warehouse ON ";

										$sqlmtd .= " loop_transaction_buyer.warehouse_id = loop_warehouse.id WHERE loop_transaction_buyer.shipped = 1 AND inv_entered = 1 AND commission_paid = 1 AND loop_transaction_buyer.ignore = 0 AND loop_transaction_buyer.po_employee LIKE '" . $all_emp . "' and (report_commissions_bydate >='" . Date("Y-m-d", strtotime($yr_cnt . "-" . $month_cnt . "-01")) . "') AND (report_commissions_bydate <= '" . $month_last_dt . " 23:59:59') GROUP BY loop_transaction_buyer.id ORDER BY loop_transaction_buyer.id";
									} else {

										$sqlmtd = "SELECT loop_transaction_buyer.report_commissions_bydate, loop_transaction_buyer.report_commissions_by, loop_warehouse.company_name AS B, loop_warehouse.b2bid, ";

										$sqlmtd .= " loop_transaction_buyer.warehouse_id AS D, loop_transaction_buyer.inv_amount AS F, loop_transaction_buyer.so_entered AS G, loop_transaction_buyer.po_date AS H , ";

										$sqlmtd .= " loop_transaction_buyer.id AS I, loop_transaction_buyer.inv_date_of AS J FROM loop_transaction_buyer INNER JOIN loop_warehouse ON ";

										$sqlmtd .= " loop_transaction_buyer.warehouse_id = loop_warehouse.id WHERE loop_transaction_buyer.shipped = 1 AND inv_entered = 1 AND commission_paid = 1 AND loop_transaction_buyer.ignore = 0 and (report_commissions_bydate >='" . Date("Y-m-d", strtotime($yr_cnt . "-" . $month_cnt . "-01")) . "') AND (report_commissions_bydate <= '" . $month_last_dt . " 23:59:59') GROUP BY loop_transaction_buyer.id ORDER BY loop_transaction_buyer.id";
									}
									db();
									$dt_view_res1new = db_query($sqlmtd);
									$emp_yr_grossprf_tot = 0;

									$summtd_SUMPO = 0;
									$summtd_dealcnt = 0;
									$tot_rev = 0;
									$tot_cost_1 = 0;
									$profit_margin = 0;
									$total_profit_1 = 0;

									while ($dt_view_row = array_shift($dt_view_res1new)) {

										//This is the payment Info for the Customer paying UCB

										$payments_sql = "SELECT SUM(loop_buyer_payments.amount) AS A FROM loop_buyer_payments WHERE trans_rec_id = " . $dt_view_row["I"];
										
										db();
										$payment_qry = db_query($payments_sql);

										$payment = array_shift($payment_qry);



										//This is the payment info for UCB paying the related vendors

										$vendor_sql = "SELECT COUNT(loop_transaction_buyer_payments.id) AS A, MIN(loop_transaction_buyer_payments.status) AS B, MAX(loop_transaction_buyer_payments.status) AS C FROM loop_transaction_buyer_payments WHERE loop_transaction_buyer_payments.transaction_buyer_id = " . $dt_view_row["I"];
										
										db();
										$vendor_qry = db_query($vendor_sql);

										$vendor = array_shift($vendor_qry);



										//Info about Shipment

										$bol_file_qry = "SELECT * FROM loop_bol_files WHERE trans_rec_id LIKE '" . $dt_view_row["I"] . "' ORDER BY id DESC";

										db();
										$bol_file_res = db_query($bol_file_qry);

										$bol_file_row = array_shift($bol_file_res);



										$fbooksql = "SELECT * FROM loop_transaction_freight WHERE trans_rec_id=" . $dt_view_row["I"];

										db();
										$fbookresult = db_query($fbooksql);

										$freightbooking = array_shift($fbookresult);



										$vendors_paid = 0; //Are the vendors paid

										$vendors_entered = 0; //Has a vendor transaction been entered?
										$invoice_paid = 0; //Have they paid their invoice?
										$invoice_entered = 0; //Has the inovice been entered

										$signed_customer_bol = 0; 	//Customer Signed BOL Uploaded

										$courtesy_followup = 0; 	//Courtesy Follow Up Made

										$delivered = 0; 	//Delivered

										$signed_driver_bol = 0; 	//BOL Signed By Driver

										$shipped = 0; 	//Shipped

										$bol_received = 0; 	//BOL Received @ WH

										$bol_sent = 0; 	//BOL Sent to WH"

										$bol_created = 0; 	//BOL Created

										$freight_booked = 0; //freight booked

										$sales_order = 0;   // Sales Order entered

										$po_uploaded = 0;  //po uploaded 



										//Are all the vendors paid?
										if ($vendor["B"] == 2 && $vendor["C"] == 2) {

											$vendors_paid = 1;
										}



										//Have we entered a vendor transaction?
										if ($vendor["A"] > 0) {

											$vendors_entered = 1;
										}



										//Have they paid their invoice?
										if (number_format($dt_view_row["F"], 2) == number_format($payment["A"], 2) && $dt_view_row["F"] != "") {

											$invoice_paid = 1;
										}



										//Has an invoice amount been entered?
										if ($dt_view_row["F"] > 0) {

											$invoice_entered = 1;
										}



										if ($bol_file_row["bol_shipment_signed_customer_file_name"] != "") {
											$signed_customer_bol = 1;
										}	//Customer Signed BOL Uploaded

										if ($bol_file_row["bol_shipment_followup"] > 0) {
											$courtesy_followup = 1;
										}	//Courtesy Follow Up Made

										if ($bol_file_row["bol_shipment_received"] > 0) {
											$delivered = 1;
										}	//Delivered

										if ($bol_file_row["bol_signed_file_name"] != "") {
											$signed_driver_bol = 1;
										}	//BOL Signed By Driver

										if ($bol_file_row["bol_shipped"] > 0) {
											$shipped = 1;
										}	//Shipped

										if ($bol_file_row["bol_received"] > 0) {
											$bol_received = 1;
										}	//BOL Received @ WH

										if ($bol_file_row["bol_sent"] > 0) {
											$bol_sent = 1;
										}	//BOL Sent to WH"

										if ($bol_file_row["id"] > 0) {
											$bol_created = 1;
										}	//BOL Created



										if ($freightbooking["id"] > 0) {
											$freight_booked = 1;
										} //freight booked



										if (($dt_view_row["G"] == 1)) {
											$sales_order = 1;
										} //sales order created

										if ($dt_view_row["H"] != "") {
											$po_uploaded = 1;
										} //po uploaded 



										$boxsource = "";

										$box_qry = "SELECT loop_transaction_buyer_payments.id AS A , loop_transaction_buyer_payments.status AS B, files_companies.name AS C from loop_transaction_buyer_payments INNER JOIN files_companies ON loop_transaction_buyer_payments.company_id = files_companies.id  INNER JOIN loop_vendor_type ON loop_transaction_buyer_payments.typeid = loop_vendor_type.id  WHERE loop_transaction_buyer_payments.typeid = 1 AND loop_transaction_buyer_payments.transaction_buyer_id = " . $dt_view_row["I"];
										db();
										$box_res = db_query($box_qry);

										while ($box_row = array_shift($box_res)) {
											$boxsource = $box_row["C"];
										}



										$display_rec = "no";

										if ($invoice_entered == 1 && $invoice_paid == 1) {

											$display_rec = "yes";
										}



										if ($display_rec == "yes") {

											$tot_rev  = $tot_rev + $dt_view_row["F"];



											$dt_view_qry2 = "SELECT SUM(loop_bol_tracking.qty) AS A, loop_bol_tracking.bol_STL1 AS B, loop_bol_tracking.trans_rec_id AS C, loop_bol_tracking.warehouse_id AS D, loop_bol_tracking.bol_pickupdate AS E, loop_bol_tracking.quantity1 AS Q1, loop_bol_tracking.quantity2 AS Q2, loop_bol_tracking.quantity3 AS Q3 FROM loop_bol_tracking WHERE loop_bol_tracking.trans_rec_id = " . $dt_view_row["I"];
											db();
											$dt_view_res2 = db_query($dt_view_qry2);

											$dt_view_row2 = array_shift($dt_view_res2);



											$pay = 0;

											$pay_qry = "SELECT *, loop_transaction_buyer_payments.id AS A , loop_transaction_buyer_payments.status AS B, files_companies.name AS C from loop_transaction_buyer_payments INNER JOIN files_companies ON loop_transaction_buyer_payments.company_id = files_companies.id  INNER JOIN loop_vendor_type ON loop_transaction_buyer_payments.typeid = loop_vendor_type.id  WHERE loop_transaction_buyer_payments.transaction_buyer_id = " . $dt_view_row["I"];
											db();
											$pay_res = db_query($pay_qry);

											while ($pay_row = array_shift($pay_res)) {

												$pay = $pay + $pay_row["amount"];

												$tot_cost_1 = $tot_cost_1 + $pay_row["amount"];
											}



											if ($dt_view_row["F"] > $pay) {

												$total_profit_1 = $total_profit_1 + ($dt_view_row["F"] - $pay);
											}
										}	//if not paid



									}



									if ($tot_rev > 0) {

										$summtd_SUMPO = $tot_rev;

										$emp_yr_rev_coll_tot = $emp_yr_rev_coll_tot + $summtd_SUMPO;

										$tot_revenue_collected = $tot_revenue_collected + $summtd_SUMPO;

										$emp_qtr_tot = $emp_qtr_tot + $summtd_SUMPO;



										$emp_yr_cost_tot = $emp_yr_cost_tot + $tot_cost_1;

										$emp_qtr_tot_cost = $emp_qtr_tot_cost + $tot_cost_1;

										$tot_cost = $tot_cost + $tot_cost_1;



										$emp_yr_grossprf_tot = $emp_yr_grossprf_tot + $total_profit_1;

										$tot_profit = $tot_profit + $total_profit_1;

										$emp_qtr_tot_grprf = $emp_qtr_tot_grprf + $total_profit_1;



										$profit_margin = ($total_profit_1 * 100) / $tot_rev;

										$profit_margin = number_format($profit_margin, 2) . "%";
									}

									echo "<td bgcolor='#E4EAEB' align='right'>$" . number_format($summtd_SUMPO, 0) . "</td>";

									$str_cost .= "<td bgcolor='#E4EAEB' align='right'>$" . number_format($tot_cost_1, 0) . "</td>";

									$str_gross_profit .= "<td bgcolor='#E4EAEB' align='right'>$" . number_format($total_profit_1, 0) . "</td>";

									$str_avg_profit .= "<td bgcolor='#E4EAEB' align='right'>" . $profit_margin . "</td>";



									if ($month_cnt == 3 || $month_cnt == 6  || $month_cnt == 9 || $month_cnt == 12) {

										echo "<td bgcolor='#B7DEE8' align='right'><b>$" . number_format($emp_qtr_tot, 0) . "</b></td>";

										$str_cost .= "<td bgcolor='#B7DEE8' align='right'>$" . number_format($emp_qtr_tot_cost, 0) . "</td>";

										$str_gross_profit .= "<td bgcolor='#B7DEE8' align='right'>$" . number_format($emp_qtr_tot_grprf, 0) . "</td>";



										$profit_margin = ($emp_qtr_tot_grprf * 100) / $emp_qtr_tot;

										$profit_margin = number_format($profit_margin, 2) . "%";



										$str_avg_profit .= "<td bgcolor='#B7DEE8' align='right'>" . $profit_margin . "</td>";

										$emp_qtr_tot = 0;
										$emp_qtr_tot_cost = 0;
										$emp_qtr_tot_grprf = 0;
									}
								} else {

									echo "<td bgcolor='#E4EAEB' align='right'>&nbsp;</td>";

									$str_cost .= "<td bgcolor='#E4EAEB' align='right'>&nbsp;</td>";

									$str_gross_profit .= "<td bgcolor='#E4EAEB' align='right'>&nbsp;</td>";

									$str_avg_profit .= "<td bgcolor='#E4EAEB' align='right'>&nbsp;</td>";

									if ($month_cnt == 3 || $month_cnt == 6  || $month_cnt == 9 || $month_cnt == 12) {

										echo "<td bgcolor='#B7DEE8' align='right'>&nbsp;</td>";

										$str_cost .= "<td bgcolor='#B7DEE8' align='right'>&nbsp;</td>";

										$str_gross_profit .= "<td bgcolor='#B7DEE8' align='right'>&nbsp;</td>";

										$str_avg_profit .= "<td bgcolor='#B7DEE8' align='right'>&nbsp;</td>";

										$emp_qtr_tot = 0;
										$emp_qtr_tot_cost = 0;
										$emp_qtr_tot_grprf = 0;
									}
								}
							}

							echo "<td bgcolor='#EBF1DE' align='right'><strong>$" . number_format($emp_yr_rev_coll_tot, 0) . "</strong></td></tr>";

							$str_cost .= "<td bgcolor='#EBF1DE' align='right'><strong>$" . number_format($emp_yr_cost_tot, 0) . "</strong></td></tr>";

							$str_gross_profit .= "<td bgcolor='#EBF1DE' align='right'><strong>$" . number_format($emp_yr_grossprf_tot, 0) . "</strong></td></tr>";



							$profit_margin = ($emp_yr_grossprf_tot * 100) / $emp_yr_rev_coll_tot;

							$profit_margin = number_format($profit_margin, 2) . "%";



							$str_avg_profit .= "<td bgcolor='#EBF1DE' align='right'><strong>" . $profit_margin . "</strong></td></tr>";



							echo $str_cost;

							//echo $str_gross_profit;

							//echo $str_avg_profit;
							####################################################################
							echo "<tr >";
							echo "<td bgcolor='#E4EAEB'>Gross Profit</td>";
							$avg_profit_rw = "<tr ><td bgcolor='#E4EAEB'>Avg Profit Margin</td>";

							$emp_yr_grossprf_tot = 0;

							for ($month_cnt = 1; $month_cnt <= 12; $month_cnt = $month_cnt + 1) {
								$month_lastd = Date("Y-m-d", strtotime($yr_cnt . "-" . $month_cnt . "-01"));
								$month_last_dt = date("Y-m-t", strtotime($month_lastd));
								$date1 = new DateTime($emp_st_date);
								$date2 = new DateTime($month_last_dt);

								if ($date1 <= $date2) {
									if ($all_emp != "All") {
										$sqlmtd = "SELECT loop_transaction_buyer.po_employee, loop_transaction_buyer.po_delivery_dt, loop_transaction_buyer.po_date, loop_transaction_buyer.inv_number, 
									loop_transaction_buyer.inv_amount as invsent_amt, loop_invoice_details.total as inv_amount, loop_transaction_buyer.id, loop_transaction_buyer.warehouse_id, loop_warehouse.b2bid FROM loop_transaction_buyer left join loop_invoice_details on loop_invoice_details.trans_rec_id = 
									loop_transaction_buyer.id inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id WHERE loop_invoice_details.total > 0 and po_employee LIKE '" . $all_emp . "' and Leaderboard = 'B2B' AND loop_transaction_buyer.ignore < 1 AND (case when inv_date_of is NULL or inv_date_of = '' then loop_invoice_details.timestamp else STR_TO_DATE(inv_date_of, '%m/%d/%Y') end) BETWEEN '" . Date("Y-m-d", strtotime($yr_cnt . "-" . $month_cnt . "-01")) . "'  AND '" . $month_last_dt . " 23:59:59'";
									} else {
										$sqlmtd = "SELECT loop_transaction_buyer.po_employee, loop_transaction_buyer.po_delivery_dt, loop_transaction_buyer.po_date, loop_transaction_buyer.inv_number, 
									loop_transaction_buyer.inv_amount as invsent_amt, loop_invoice_details.total as inv_amount, loop_transaction_buyer.id, loop_transaction_buyer.warehouse_id, loop_warehouse.b2bid FROM loop_transaction_buyer left join loop_invoice_details on loop_invoice_details.trans_rec_id = 
									loop_transaction_buyer.id inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id WHERE loop_invoice_details.total > 0 and loop_transaction_buyer.shipped = 1 AND inv_entered = 1 AND commission_paid = 1 AND loop_transaction_buyer.ignore = 0 AND (case when inv_date_of is NULL or inv_date_of = '' then loop_invoice_details.timestamp else STR_TO_DATE(inv_date_of, '%m/%d/%Y') end) BETWEEN '" . Date("Y-m-d", strtotime($yr_cnt . "-" . $month_cnt . "-01")) . "'  AND '" . $month_last_dt . " 23:59:59'";
									}
									db();
									$dt_view_res1new = db_query($sqlmtd);

									$SUMPO1 = 0;
									$summtd_SUMPO_sale_rev = 0;
									while ($dt_view_row = array_shift($dt_view_res1new)) {
										//
										$inv_amt_totake = 0;
										if ($dt_view_row["invsent_amt"] > 0) {
											$inv_amt_totake = str_replace(",", "", $dt_view_row["invsent_amt"]);
										}
										if ($dt_view_row["invsent_amt"] == 0 && $dt_view_row["inv_amount"] > 0) {
											$inv_amt_totake = str_replace(",", "", $dt_view_row["inv_amount"]);
										}

										$summtd_SUMPO_sale_rev = $summtd_SUMPO_sale_rev + str_replace(",", "", number_format($inv_amt_totake, 0));

										$estimated_cost = 0;
										$qryB2bCogs = "SELECT loop_transaction_buyer.id, sum(estimated_cost) as estimated_cost 
									FROM loop_transaction_buyer 
									INNER JOIN loop_transaction_buyer_payments ON loop_transaction_buyer_payments.transaction_buyer_id = loop_transaction_buyer.id 
									WHERE loop_transaction_buyer.Leaderboard = 'B2B' and loop_transaction_buyer.id = '" . $dt_view_row["id"] . "'   
									and loop_transaction_buyer.ignore = 0 group by loop_transaction_buyer.id ORDER BY loop_transaction_buyer.id";
									db();	
									$resB2bCogs = db_query($qryB2bCogs);

										while ($resB2bCogs_row = array_shift($resB2bCogs)) {
											$estimated_cost = str_replace(",", "", $resB2bCogs_row['estimated_cost']);
										}



										$SUMPO1 = $SUMPO1 + ($inv_amt_totake - $estimated_cost);
									}

									$tot_revenue_coll_yr = $tot_revenue_coll_yr + $summtd_SUMPO_sale_rev;
									$tot_revenue_coll = $tot_revenue_coll + $summtd_SUMPO_sale_rev;
									$emp_qtr_tot = $emp_qtr_tot + $summtd_SUMPO_sale_rev;
									$emp_yr_grossprf_tot = $emp_yr_grossprf_tot + $SUMPO1;
									$tot_profit = $tot_profit + $SUMPO1;
									$emp_qtr_tot_grprf = $emp_qtr_tot_grprf + $SUMPO1;

									$profit_margin = $SUMPO1 * 100 / str_replace(",", "", number_format($summtd_SUMPO_sale_rev, 0));
									$profit_margin = number_format($profit_margin, 2) . "%";

									echo "<td bgcolor='#E4EAEB' align='right'>$" . number_format($SUMPO1, 0) . "</td>";

									$avg_profit_rw .= "<td bgcolor='#E4EAEB' align='right'>" . $profit_margin . "</td>";
									if ($month_cnt == 3 || $month_cnt == 6  || $month_cnt == 9 || $month_cnt == 12) {


										echo "<td bgcolor='#B7DEE8' align='right'>$" . number_format($emp_qtr_tot_grprf, 0) . "</td>";



										$profit_margin = ($emp_qtr_tot_grprf * 100) / $emp_qtr_tot;

										$profit_margin = number_format($profit_margin, 2) . "%";



										$avg_profit_rw .= "<td bgcolor='#B7DEE8' align='right'>" . $profit_margin . "</td>";

										$emp_qtr_tot = 0;
										$emp_qtr_tot_grprf = 0;
									}
								} else {


									echo "<td bgcolor='#E4EAEB' align='right'>&nbsp;</td>";

									$avg_profit_rw .= "<td bgcolor='#E4EAEB' align='right'>&nbsp;</td>";

									if ($month_cnt == 3 || $month_cnt == 6  || $month_cnt == 9 || $month_cnt == 12) {

										echo "<td bgcolor='#B7DEE8' align='right'>&nbsp;</td>";
										$avg_profit_rw .= "<td bgcolor='#B7DEE8' align='right'>&nbsp; </td>";

										$emp_qtr_tot = 0;
										$emp_qtr_tot_cost = 0;
										$emp_qtr_tot_grprf = 0;
									}
								}
							}


							echo  "<td bgcolor='#EBF1DE' align='right'><strong>$" . number_format($emp_yr_grossprf_tot, 0) . "</strong></td></tr>";



							$profit_margin = ($emp_yr_grossprf_tot * 100) / $tot_revenue_coll_yr;

							$profit_margin = number_format($profit_margin, 2) . "%";



							$avg_profit_rw .= "<td bgcolor='#EBF1DE' align='right'><strong>" . $profit_margin . "</strong></td></tr>";

							echo $avg_profit_rw;
							####################################################################


							if ($yr_cnt != date('Y')) {

					?>

								<tr>

									<td align='left' bgColor='#ABC5DF' width='80px'><u>Range</u></td>

									<td align='left' bgColor='#ABC5DF' width='150px'><u>What</u></td>

									<?php

									for ($month_cnt = 1; $month_cnt <= 12; $month_cnt = $month_cnt + 1) { ?>

										<td align='left' bgColor='#ABC5DF' width='70px'><u><?php echo date("F", mktime(0, 0, 0, $month_cnt, 10)); ?></u></td>

										<?php

										if ($month_cnt == 3) {

											echo "<td bgcolor='#4BACC6' width='90px' align='left'><b>Quarter 1</b></td>";
										}

										if ($month_cnt == 6) {

											echo "<td bgcolor='#4BACC6' width='90px' align='left'><b>Quarter 2</b></td>";
										}

										if ($month_cnt == 9) {

											echo "<td bgcolor='#4BACC6' width='90px' align='left'><b>Quarter 3</b></td>";
										}

										if ($month_cnt == 12) {

											echo "<td bgcolor='#4BACC6' width='90px' align='left'><b>Quarter 4</b></td>";
										}

										?>

									<?php } ?>

									<td align='left' bgColor='#D8E4BC' width='100px'><u><b>Total</b></u></td>

								</tr>

					<?php

							}





							if ($all_emp != "All") {

								$sqlmtd = "Select count(po_poorderamount) as deal_cancel_cnt FROM loop_transaction_buyer WHERE po_employee LIKE '" . $all_emp . "' AND loop_transaction_buyer.ignore = 1 and transaction_date BETWEEN '" . Date("Y-m-d", strtotime($yr_cnt . "-01-01")) . "' AND '" . Date("Y-m-d", strtotime($yr_cnt . "-12-31")) . " 23:59:59'";
							} else {

								$sqlmtd = "Select count(po_poorderamount) as deal_cancel_cnt FROM loop_transaction_buyer WHERE loop_transaction_buyer.ignore = 1 and transaction_date BETWEEN '" . Date("Y-m-d", strtotime($yr_cnt . "-01-01")) . "' AND '" . Date("Y-m-d", strtotime($yr_cnt . "-12-31")) . " 23:59:59'";
							}
							db();
							$resultmtd = db_query($sqlmtd);

							while ($summtd = array_shift($resultmtd)) {

								$deal_cancel_cnt = $summtd["deal_cancel_cnt"];
							}



							$str_summary .= "<tr><td align='left' bgColor='#E4EAEB' >" . $yr_cnt . "</td>";

							if ($deal_cancel_cnt > 0 && $emp_yr_deal_tot > 0) {

								$str_summary .=	"	<td align='right' bgColor='#E4EAEB' > " .  number_format(($deal_cancel_cnt * 100) / $emp_yr_deal_tot, 2) . "%</td>";
							} else {

								$str_summary .=	"	<td align='right' bgColor='#E4EAEB' >0.00%</td>";
							}

							$str_summary .=	"	<td align='right' bgColor='#E4EAEB' >" . number_format($emp_yr_contact_tot, 0) . "</td>";

							$str_summary .=	"	<td align='right' bgColor='#E4EAEB' >" . number_format($emp_yr_quote_tot, 0) . "</td>";

							$str_summary .=	"	<td align='right' bgColor='#E4EAEB' >$" . number_format($emp_yr_poenter_tot, 0) . "</td>";

							$str_summary .=	"	<td align='right' bgColor='#E4EAEB' ><font color='" . $color . "'>$" . number_format($emp_yr_rev_inv_tot, 0) . "</font></td>";

							$str_summary .=	"	<td align='right' bgColor='#E4EAEB' >$" . number_format($emp_yr_rev_coll_tot, 0) . "</td>";

							$str_summary .=	"	<td align='right' bgColor='#E4EAEB' >$" . number_format($emp_yr_cost_tot, 0) . "</td>";

							$str_summary .=	"	<td align='right' bgColor='#E4EAEB' >$" . number_format($emp_yr_grossprf_tot, 0) . "</td>";

							$str_summary .=	"	<td align='right' bgColor='#E4EAEB' >" . number_format(($emp_yr_grossprf_tot * 100) / $emp_yr_rev_coll_tot, 2) . "%</td>";

							$str_summary .=	"</tr>";
						}
					}

					?>

				</tbody>

			</table>



			<br /><br />

			<?php

					//Overall summary

					$summtd_SUMPO = 0;
					$summtd_dealcnt = 0;

					$deal_cancel_cnt = 0;

					if ($all_emp != "All") {

						$sqlmtd = "SELECT sum(round(loop_transaction_buyer.po_poorderamount,0)) AS SUMPO, count(po_poorderamount) as dealcnt FROM loop_transaction_buyer WHERE po_employee LIKE '" . $all_emp . "' AND loop_transaction_buyer.ignore < 1";
					} else {

						$sqlmtd = "SELECT sum(round(loop_transaction_buyer.po_poorderamount,0)) AS SUMPO, count(po_poorderamount) as dealcnt FROM loop_transaction_buyer WHERE loop_transaction_buyer.ignore < 1";
					}
					db();
					$resultmtd = db_query($sqlmtd);

					while ($summtd = array_shift($resultmtd)) {

						if ($summtd["SUMPO"] > 0) {

							$summtd_SUMPO = $summtd["SUMPO"];
						}

						$summtd_dealcnt = $summtd["dealcnt"];
					}



					if ($all_emp != "All") {

						$sqlmtd = "Select count(po_poorderamount) as deal_cancel_cnt FROM loop_transaction_buyer WHERE po_employee LIKE '" . $all_emp . "' AND loop_transaction_buyer.ignore = 1";
					} else {

						$sqlmtd = "Select count(po_poorderamount) as deal_cancel_cnt FROM loop_transaction_buyer WHERE loop_transaction_buyer.ignore = 1";
					}

					db();
					$resultmtd = db_query($sqlmtd);

					while ($summtd = array_shift($resultmtd)) {

						$deal_cancel_cnt = $summtd["deal_cancel_cnt"];
					}

					//echo $summtd_dealcnt . " " . $deal_cancel_cnt;



					if ($tot_revenue >= $quota_mtd_overall) {
						$color = "green";
					} elseif ($tot_revenue < $quota_mtd_overall) {
						$color = "red";
					} else {
						$color = "black";
					};



			?>

			<table cellSpacing='1' cellPadding='1' border='0' width='800'>

				<tr>

					<td align='center' class='txtstyle_color' style='font-size:10pt;background:#ABC5DF' colspan='9'><strong>"<?php echo $emp_name; ?>" Life @ UCB Summary (Start Date: <?php echo $emp_st_date; ?>)</strong></td>

				</tr>

			</table>

			<table cellSpacing='1' cellPadding='1' border='0' width='800' id='table9' class='tablesorter'>

				<thead>

					<tr>

						<th align='left' bgColor='#E4EAEB'>Year</th>

						<th align='left' bgColor='#E4EAEB'>% of Deals Cancelled</th>

						<th align='left' bgColor='#E4EAEB'>Total Contacts</th>

						<th align='left' bgColor='#E4EAEB'>Total Quotes</th>

						<th align='left' bgColor='#E4EAEB'>Total PO Entered</th>

						<th align='left' bgColor='#E4EAEB'>Total Revenue Invoiced</th>

						<th align='left' bgColor='#E4EAEB'>Total Revenue Collected</th>

						<th align='left' bgColor='#E4EAEB'>Total Cost</th>

						<th align='left' bgColor='#E4EAEB'>Total Gross Profit</th>

						<th align='left' bgColor='#E4EAEB'>Total Average Profit Margin</th>

					</tr>

				</thead>

				<tbody>

					<?php echo $str_summary;

					$per_Deals_cancelled = "0.00%";

					if ($deal_cancel_cnt > 0 && $summtd_dealcnt > 0) {

						$per_Deals_cancelled = number_format(($deal_cancel_cnt * 100) / $summtd_dealcnt, 2) . "%";
					}

					?>

					<tr>

						<td align='center' bgColor='#E4EAEB'><b>Total</b></td>

						<td align='right' bgColor='#E4EAEB'><b><?php echo $per_Deals_cancelled; ?></b></td>

						<td align='right' bgColor='#E4EAEB'><b><?php echo number_format($tot_contact, 0); ?></b></td>

						<td align='right' bgColor='#E4EAEB'><b><?php echo number_format($tot_quota, 0); ?></b></td>

						<td align='right' bgColor='#E4EAEB'><b>$<?php echo number_format($tot_po_enter, 0); ?></b></td>

						<td align='right' bgColor='#E4EAEB'>
							<font color="<?php echo $color; ?>"><b>$<?php echo number_format($tot_revenue, 0); ?></b></font>
						</td>

						<td align='right' bgColor='#E4EAEB'><b>$<?php echo number_format($tot_revenue_collected, 0); ?></b></td>

						<td align='right' bgColor='#E4EAEB'><b>$<?php echo number_format($tot_cost, 0); ?></b></td>

						<td align='right' bgColor='#E4EAEB'><b>$<?php echo number_format($tot_profit, 0); ?></b></td>

						<td align='right' bgColor='#E4EAEB'><b><?php echo number_format(($tot_profit * 100) / $tot_revenue, 2); ?>%</b></td>

					</tr>

				</tbody>

			</table>



			<br /><br />



			<?php

					$tot_po_enter = 0;
					$tot_contact = 0;
					$tot_quota = 0;
					$tot_cost = 0;

					$emp_st_date = "";

					if ($all_emp != "All") {

						$sql = "SELECT quota, quotadate, deal_quota, id, Official_Start_Date FROM loop_employees WHERE initials = '" . $all_emp . "' and Official_Start_Date is not null";
					} else {

						$sql = "SELECT quota, quotadate, deal_quota, id, Official_Start_Date FROM loop_employees WHERE id = 2";
					}
					db();
					$result = db_query($sql);

					while ($res = array_shift($result)) {

						$emp_st_date = $res["Official_Start_Date"];

						$startyr = Date('Y', strtotime($res["Official_Start_Date"]));

						for ($yr_cnt = $startyr; $yr_cnt <= date('Y'); $yr_cnt = $yr_cnt + 1) {

							//Contacts made 

							$emp_yr_tot = 0;
							$emp_qtr_tot = 0;

			?>

					<table cellSpacing='1' cellPadding='1' border='0' width='800'>

						<tr>

							<?php if ($all_emp != "All") { ?>

								<td align='center' class='txtstyle_color' style='font-size:10pt;background:#ABC5DF' colspan='7'><strong>"<?php echo $emp_name; ?>" <?php echo $yr_cnt; ?> Top 10 Customers (Based on Gross Profit)</strong></td>

							<?php } else { ?>

								<td align='center' class='txtstyle_color' style='font-size:10pt;background:#ABC5DF' colspan='7'><strong>"<?php echo $emp_name; ?>" <?php echo $yr_cnt; ?> Top 25 Customers (Based on Gross Profit)</strong></td>

							<?php } ?>

						</tr>

					</table>

					<table cellSpacing='1' cellPadding='1' border='0' width='800' id='table9' class='tablesorter'>

						<thead>

							<tr>

								<th align='left' bgColor='#ABC5DF' width='50px'><u>Rank</u></th>

								<th align='left' bgColor='#ABC5DF' width='270px'><u>Customer</u></th>

								<th align='left' bgColor='#ABC5DF' width='80px'><u>PO Entered</u></th>

								<th align='left' bgColor='#ABC5DF' width='80px'><u>Revenue</u></th>

								<th align='left' bgColor='#ABC5DF' width='80px'><u>Cost</u></th>

								<th align='left' bgColor='#ABC5DF' width='80px'><u>Gross Profit</u></th>

								<th align='left' bgColor='#ABC5DF' width='80px'><u>Gross Profit Margin</u></th>

							</tr>

						</thead>

						<tbody>



					<?php

							$MGArray = array();

							if ($all_emp != "All") {

								$sqlmtd = "SELECT loop_warehouse.warehouse_name, loop_transaction_buyer.warehouse_id, sum(loop_transaction_buyer.po_poorderamount) as po_poorderamount, sum(loop_transaction_buyer.inv_amount) as inv_amount, loop_warehouse.company_name, loop_warehouse.b2bid FROM loop_transaction_buyer inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id where po_employee LIKE '" . $all_emp . "' AND loop_transaction_buyer.ignore < 1 AND transaction_date BETWEEN '" . Date("Y-m-d 00:00:00", strtotime($yr_cnt . "-01-01")) . "' AND '" . Date("Y-m-d 00:00:00", strtotime($yr_cnt . "-12-31")) . "' group by loop_transaction_buyer.warehouse_id";
								$sqlmtd_new = "SELECT loop_transaction_buyer.inv_amount as invsent_amt , loop_invoice_details.total as inv_amount, loop_transaction_buyer.id, loop_transaction_buyer.warehouse_id, loop_warehouse.b2bid FROM loop_transaction_buyer left join loop_invoice_details on loop_invoice_details.trans_rec_id = loop_transaction_buyer.id inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id WHERE loop_invoice_details.total > 0 and po_employee LIKE '" . $all_emp . "' AND loop_transaction_buyer.ignore < 1 AND (case when inv_date_of is NULL or inv_date_of = '' then loop_invoice_details.timestamp else STR_TO_DATE(inv_date_of, '%m/%d/%Y') end) BETWEEN '" . Date("Y-m-d 00:00:00", strtotime($yr_cnt . "-01-01")) . "' AND '" . Date("Y-m-d 00:00:00", strtotime($yr_cnt . "-12-31")) . "'";
							} else {

								$sqlmtd = "SELECT loop_warehouse.warehouse_name, loop_transaction_buyer.warehouse_id, sum(loop_transaction_buyer.po_poorderamount) as po_poorderamount, sum(loop_transaction_buyer.inv_amount) as inv_amount, loop_warehouse.company_name, loop_warehouse.b2bid FROM loop_transaction_buyer inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id where loop_transaction_buyer.ignore < 1 AND transaction_date BETWEEN '" . Date("Y-m-d 00:00:00", strtotime($yr_cnt . "-01-01")) . "' AND '" . Date("Y-m-d 00:00:00", strtotime($yr_cnt . "-12-31")) . "' group by loop_transaction_buyer.warehouse_id";
								$sqlmtd_new = "SELECT loop_transaction_buyer.inv_amount as invsent_amt , loop_invoice_details.total as inv_amount, loop_transaction_buyer.id, loop_transaction_buyer.warehouse_id, loop_warehouse.b2bid FROM loop_transaction_buyer left join loop_invoice_details on loop_invoice_details.trans_rec_id = loop_transaction_buyer.id inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id WHERE loop_invoice_details.total > 0 AND loop_transaction_buyer.ignore < 1 AND (case when inv_date_of is NULL or inv_date_of = '' then loop_invoice_details.timestamp else STR_TO_DATE(inv_date_of, '%m/%d/%Y') end) BETWEEN '" . Date("Y-m-d 00:00:00", strtotime($yr_cnt . "-01-01")) . "' AND '" . Date("Y-m-d 00:00:00", strtotime($yr_cnt . "-12-31")) . "'";
							}
							db();
							$resultmtd = db_query($sqlmtd);

							while ($summtd = array_shift($resultmtd)) {

								$company_name = "";

								$sql_cost = "SELECT nickname FROM companyInfo where ID = " . $summtd["b2bid"];

								db_b2b();

								$sql_cost_res = db_query($sql_cost);

								while ($sql_cost_rs = array_shift($sql_cost_res)) {

									$company_name = $sql_cost_rs["nickname"];
								}

								if ($all_emp != "All") {

									$sqlmtd_new = "SELECT loop_transaction_buyer.inv_amount as invsent_amt , loop_invoice_details.total as inv_amount, loop_transaction_buyer.id, loop_transaction_buyer.warehouse_id, loop_warehouse.b2bid FROM loop_transaction_buyer left join loop_invoice_details on loop_invoice_details.trans_rec_id = loop_transaction_buyer.id inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id WHERE po_employee LIKE '" . $all_emp . "' AND loop_transaction_buyer.ignore < 1 AND (case when inv_date_of is NULL or inv_date_of = '' then loop_invoice_details.timestamp else STR_TO_DATE(inv_date_of, '%m/%d/%Y') end) BETWEEN '" . Date("Y-m-d 00:00:00", strtotime($yr_cnt . "-01-01")) . "' AND '" . Date("Y-m-d 00:00:00", strtotime($yr_cnt . "-12-31")) . "' and loop_transaction_buyer.warehouse_id = " . $summtd["warehouse_id"];
								} else {

									$sqlmtd_new = "SELECT loop_transaction_buyer.inv_amount as invsent_amt , loop_invoice_details.total as inv_amount, loop_transaction_buyer.id, loop_transaction_buyer.warehouse_id, loop_warehouse.b2bid FROM loop_transaction_buyer left join loop_invoice_details on loop_invoice_details.trans_rec_id = loop_transaction_buyer.id inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id WHERE loop_transaction_buyer.ignore < 1 AND (case when inv_date_of is NULL or inv_date_of = '' then loop_invoice_details.timestamp else STR_TO_DATE(inv_date_of, '%m/%d/%Y') end) BETWEEN '" . Date("Y-m-d 00:00:00", strtotime($yr_cnt . "-01-01")) . "' AND '" . Date("Y-m-d 00:00:00", strtotime($yr_cnt . "-12-31")) . "' and loop_transaction_buyer.warehouse_id = " . $summtd["warehouse_id"];
								}
								$actual_rev_mtd = 0;

								db();
								$resultmtd_new = db_query($sqlmtd_new);
								while ($summtd_new = array_shift($resultmtd_new)) {
									$finalpaid_amt = 0;
									db();
									$result_finalpmt = db_query("Select ROUND(sum(loop_buyer_payments.amount),2) as amt from loop_buyer_payments where trans_rec_id = " . $summtd_new["id"]);
									while ($summtd_finalpmt = array_shift($result_finalpmt)) {
										$finalpaid_amt = $summtd_finalpmt["amt"];
									}

									$inv_amt_totake = 0;
									/*if ($finalpaid_amt > 0){
										if ($summtd_new["invsent_amt"] > 0){
											if ($finalpaid_amt < $summtd_new["invsent_amt"]){
												$inv_amt_totake= $summtd_new["invsent_amt"];
											}else{
												$inv_amt_totake= $finalpaid_amt;
											}
										}else{
											if ($finalpaid_amt < $summtd_new["inv_amount"]){
												$inv_amt_totake= $summtd_new["inv_amount"];
											}else{
												$inv_amt_totake= $finalpaid_amt;
											}
										}
									}
									if ($inv_amt_totake == 0 && $summtd_new["inv_amount"] > 0){
										if ($summtd_new["invsent_amt"] < $summtd_new["inv_amount"]){
											$inv_amt_totake= $summtd_new["inv_amount"];
										}else{
											$inv_amt_totake= $summtd_new["invsent_amt"];
										}				
									}
									if ($inv_amt_totake == 0 && $summtd_new["invsent_amt"] > 0){
										$inv_amt_totake= $summtd_new["invsent_amt"];
									}*/
									if ($finalpaid_amt > 0) {
										$inv_amt_totake = $finalpaid_amt;
									}
									if ($finalpaid_amt == 0 && $summtd_new["invsent_amt"] > 0) {
										$inv_amt_totake = $summtd_new["invsent_amt"];
									}
									if ($finalpaid_amt == 0 && $summtd_new["invsent_amt"] == 0 && $summtd_new["inv_amount"] > 0) {
										$inv_amt_totake = $summtd_new["inv_amount"];
									}

									$actual_rev_mtd = $actual_rev_mtd + $inv_amt_totake;
								}


								if ($all_emp != "All") {

									$sql_cost = "SELECT Sum(loop_transaction_buyer_payments.amount) as totcost FROM loop_transaction_buyer inner join loop_transaction_buyer_payments on loop_transaction_buyer_payments.transaction_buyer_id = loop_transaction_buyer.id where po_employee LIKE '" . $all_emp . "' AND loop_transaction_buyer.ignore < 1 AND transaction_date BETWEEN '" . Date("Y-m-d 00:00:00", strtotime($yr_cnt . "-01-01")) . "' AND '" . Date("Y-m-d 00:00:00", strtotime($yr_cnt . "-12-31")) . "' and loop_transaction_buyer.warehouse_id = " . $summtd["warehouse_id"];
								} else {

									$sql_cost = "SELECT Sum(loop_transaction_buyer_payments.amount) as totcost FROM loop_transaction_buyer inner join loop_transaction_buyer_payments on loop_transaction_buyer_payments.transaction_buyer_id = loop_transaction_buyer.id where loop_transaction_buyer.ignore < 1 AND transaction_date BETWEEN '" . Date("Y-m-d 00:00:00", strtotime($yr_cnt . "-01-01")) . "' AND '" . Date("Y-m-d 00:00:00", strtotime($yr_cnt . "-12-31")) . "' and loop_transaction_buyer.warehouse_id = " . $summtd["warehouse_id"];
								}
								db();
								$sql_cost_res = db_query($sql_cost);

								while ($sql_cost_rs = array_shift($sql_cost_res)) {

									$grs_pft_tmp = $actual_rev_mtd - $sql_cost_rs["totcost"];

									$profit_margin = ($grs_pft_tmp * 100) / $actual_rev_mtd;

									if ($company_name == "") {

										$company_name = $summtd["warehouse_name"];
									}

									$MGArray[] = array(
										'b2bid' => $summtd["b2bid"], 'company_name' => $company_name, 'po_poorderamount' => $summtd["po_poorderamount"],

										'inv_amount' => $actual_rev_mtd, 'totcost' => $sql_cost_rs["totcost"], 'profit' => $grs_pft_tmp, 'profit_margin' => $profit_margin
									);
								}
							}



							//print_r($MGArray);



							$MGArraysort_I = array();

							foreach ($MGArray as $MGArraytmp) {

								$MGArraysort_I[] = $MGArraytmp['profit'];
							}

							array_multisort($MGArraysort_I, SORT_DESC, SORT_NUMERIC, $MGArray);



							if ($all_emp != "All") {

								$total_disp_cnt = 10;
							} else {

								$total_disp_cnt = 25;
							}



							$po_enter = 0;
							$rev = 0;
							$cost = 0;
							$grs_pft = 0;
							$grs_pft_mrgin = 0;
							$grs_pft_tmp = 0;
							$top10 = 1;

							foreach ($MGArray as $MGArraytmp2) {

								if ($top10 <= $total_disp_cnt) {

									$name = $MGArraytmp2["name"];

									$po_enter = $po_enter + $MGArraytmp2["po_poorderamount"];

									$rev = $rev + $MGArraytmp2["inv_amount"];

									$grs_pft_tmp = $MGArraytmp2["inv_amount"] - $MGArraytmp2["totcost"];



									$cost = $cost + $MGArraytmp2["totcost"];

									$grs_pft = $grs_pft + $grs_pft_tmp;



									echo "<tr><td bgcolor='#E4EAEB' align='center'>" . $top10 . "</td>";

									echo "<td bgcolor='#E4EAEB' align='left'><a href='viewCompany.php?ID=" . $MGArraytmp2["b2bid"] . "'>" . $MGArraytmp2["company_name"] . "</a></td>";

									echo "<td bgcolor='#E4EAEB' align='right'>$" . number_format($MGArraytmp2["po_poorderamount"], 0) . "</td>";

									echo "<td bgcolor='#E4EAEB' align='right'>$" . number_format($MGArraytmp2["inv_amount"], 0) . "</td>";



									echo "<td bgcolor='#E4EAEB' align='right'>$" . number_format($MGArraytmp2["totcost"], 0) . "</td>";

									echo "<td bgcolor='#E4EAEB' align='right'>$" . number_format($MGArraytmp2["profit"], 0) . "</td>";



									echo "<td bgcolor='#E4EAEB' align='right'>" . number_format($MGArraytmp2["profit_margin"], 2) . "%</td></tr>";
								}

								$top10 = $top10 + 1;
							}



							echo "<tr><td colspan='2' bgcolor='#E4EAEB' align='left'><b>Total</b></td>";

							echo "<td bgcolor='#E4EAEB' align='right'><b>$" . number_format($po_enter, 0) . "</b></td>";

							echo "<td bgcolor='#E4EAEB' align='right'><b>$" . number_format($rev, 0) . "</b></td>";

							echo "<td bgcolor='#E4EAEB' align='right'><b>$" . number_format($cost, 0) . "</b></td>";

							echo "<td bgcolor='#E4EAEB' align='right'><b>$" . number_format($grs_pft, 0) . "</b></td>";



							$profit_margin = ($grs_pft * 100) / $rev;

							$profit_margin = number_format($profit_margin, 2) . "%";



							echo "<td bgcolor='#E4EAEB' align='right'><b>" . $profit_margin . "</b></td>";

							echo "</tr>";

							echo "</tbody></table><br><br>";
						}
					}

					?>

					</table>



					<br /><br />



					<?php if ($_GET["emp_sel"] != "All") { ?>

						<table border="0">

							<tr>
								<td style="font-size:16pt;"><strong>Lead Assignment</strong></td>
							</tr>

							<tr>

								<td valign="top">

									<table cellSpacing="1" cellPadding="1" border="0" width="1170">

										<tr>
											<td class="txtstyle_color" align="center" style="font-size:14pt;"><strong>Sales Assignments</strong></td>
										</tr>

									</table>

									<table cellSpacing="1" cellPadding="1" border="0" width="1170" id="table15" class="tablesorter">

										<thead>

											<tr>

												<th width="170px" bgColor='#E4EAEB'><u>Employee</u></th>

												<th width='100px' bgColor='#E4EAEB' align="center"><u>Qualified Proactive</u></th>

												<th width='100px' bgColor='#E4EAEB' align="center"><u>Quoted</u></th>

												<th width='100px' bgColor='#E4EAEB' align="center"><u>Open Deal</u></th>

												<th width='100px' bgColor='#E4EAEB' align="center"><u>Prospect - TBD</u></th>

												<th width='100px' bgColor='#E4EAEB' align="center"><u>Contracted</u></th>

												<th width='100px' bgColor='#E4EAEB' align="center"><u>Qualified Reactive</u></th>

												<th width='100px' bgColor='#E4EAEB' align="center"><u>Shipping Box Customer</u></th>

												<th width='100px' bgColor='#E4EAEB' align="center"><u>Unqualified</u></th>

												<th width='100px' bgColor='#E4EAEB' align="center"><u>Inactive</u></th>

												<th width='100px' bgColor='#E4EAEB' align="center"><u>Total</u></th>

											</tr>

										</thead>

										<tbody>

											<?php

											$grandtot = 0;

											//$sqle = "SELECT DISTINCT (employees.employeeid) FROM employees INNER JOIN companyInfo ON employees.employeeid = companyInfo.assignedto WHERE companyInfo.status IN (3,32,56,36,50,51)";

											$col1 = 0;
											$col2 = 0;
											$col3 = 0;
											$col4 = 0;
											$col5 = 0;
											$col6 = 0;
											$col7 = 0;
											$col8 = 0;
											$col9 = 0;
											$col10 = 0;

											$sql = "SELECT id, b2b_id ,name, initials as EMPLOYEE FROM loop_employees where initials = '" . $all_emp . "'";
											db();
											$resulte = db_query($sql);

											while ($rowemp_loop = array_shift($resulte)) {

												$sql = "SELECT employeeID FROM employees WHERE employeeID = " . $rowemp_loop["b2b_id"];
												db_b2b();
												$rowemp_1 = db_query($sql);

												while ($rowemp = array_shift($rowemp_1)) {

													$sql = "SELECT sum(status) as cnt FROM companyInfo WHERE assignedto = " . $rowemp["employeeID"] . " AND status IN (32,36, 56, 3, 51, 50, 60, 43, 24)";

													db_b2b();

													$result_m = db_query($sql);

													$overall_cnt = 0;

													while ($rowemp_m = array_shift($result_m)) {

														$overall_cnt = $rowemp_m["cnt"];
													}



													if ($overall_cnt > 0) {

														$tot = 0;

														$sql = "SELECT * FROM companyInfo WHERE assignedto = " . $rowemp["employeeID"] . " AND status = 32";

														db_b2b();

														$result = db_query($sql);

														$tmp_val = tep_db_num_rows($result);

														$col1 = $col1 + $tmp_val;

														echo "<tr><td bgColor='#E4EAEB'>" . $rowemp_loop["name"] . "</td><td bgColor='#E4EAEB' align=right><a target='_blank' href='report_show_assignments.php?show=status&statusid=32&eid=" . $rowemp["employeeID"] . "'>" . $tmp_val . "</a></td>";

														echo "<td bgColor='#E4EAEB' align=right>";

														$sql = "SELECT * FROM companyInfo WHERE assignedto = " . $rowemp["employeeID"] . " AND status = 36";

														db_b2b();

														$result = db_query($sql);

														$tmp_val = tep_db_num_rows($result);

														$col2 = $col2 + $tmp_val;

														echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=36&eid=" . $rowemp["employeeID"] . "'>" . $tmp_val . "</a>";

														echo "</td><td bgColor='#E4EAEB' align=right>";

														$sql = "SELECT * FROM companyInfo WHERE assignedto = " . $rowemp["employeeID"] . " AND status = 56";

														db_b2b();

														$result = db_query($sql);

														$tmp_val = tep_db_num_rows($result);

														$col3 = $col3 + $tmp_val;

														echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=56&eid=" . $rowemp["employeeID"] . "'>" . $tmp_val . "</a>";

														echo "</td><td bgColor='#E4EAEB' align=right>";

														$sql = "SELECT * FROM companyInfo WHERE assignedto = " . $rowemp["employeeID"] . " AND status = 3";

														db_b2b();

														$result = db_query($sql);

														$tmp_val = tep_db_num_rows($result);

														$col4 = $col4 + $tmp_val;

														echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=3&eid=" . $rowemp["employeeID"] . "'>" . $tmp_val . "</a>";

														echo "</td><td bgColor='#E4EAEB' align=right>";

														$sql = "SELECT * FROM companyInfo WHERE assignedto = " . $rowemp["employeeID"] . " AND status = 51";

														db_b2b();

														$result = db_query($sql);

														$tmp_val = tep_db_num_rows($result);

														$col5 = $col5 + $tmp_val;

														echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=51&eid=" . $rowemp["employeeID"] . "'>" . $tmp_val . "</a>";

														echo "</td><td bgColor='#E4EAEB' align=right>";

														$sql = "SELECT * FROM companyInfo WHERE assignedto = " . $rowemp["employeeID"] . " AND status = 50";

														db_b2b();

														$result = db_query($sql);

														$tmp_val = tep_db_num_rows($result);

														$col6 = $col6 + $tmp_val;

														echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=50&eid=" . $rowemp["employeeID"] . "'>" . $tmp_val . "</a>";

														echo "</td><td bgColor='#E4EAEB' align=right>";

														$sql = "SELECT * FROM companyInfo WHERE assignedto = " . $rowemp["employeeID"] . " AND status = 60";

														db_b2b();

														$result = db_query($sql);

														$tmp_val = tep_db_num_rows($result);

														$col7 = $col7 + $tmp_val;

														echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=60&eid=" . $rowemp["employeeID"] . "'>" . $tmp_val . "</a>";

														echo "</td><td bgColor='#E4EAEB' align=right>";

														$sql = "SELECT * FROM companyInfo WHERE assignedto = " . $rowemp["employeeID"] . " AND status = 43";

														db_b2b();
														$result = db_query($sql);

														$tmp_val = tep_db_num_rows($result);

														$col8 = $col8 + $tmp_val;

														echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=43&eid=" . $rowemp["employeeID"] . "'>" . $tmp_val . "</a>";

														echo "</td><td bgColor='#E4EAEB' align=right>";

														$sql = "SELECT * FROM companyInfo WHERE assignedto = " . $rowemp["employeeID"] . " AND status = 24";
														
														db_b2b();
														$result = db_query($sql);

														$tmp_val = tep_db_num_rows($result);

														$col9 = $col9 + $tmp_val;

														echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=24&eid=" . $rowemp["employeeID"] . "'>" . $tmp_val . "</a>";

														echo "</td><td bgColor='#E4EAEB' align=right>";

														$sql = "SELECT * FROM companyInfo WHERE assignedto = " . $rowemp["employeeID"] . " AND status IN (32,36, 56, 3, 51, 50, 60, 43, 24)";

														db_b2b();

														$result = db_query($sql);

														$tmp_val = tep_db_num_rows($result);

														$col10 = $col10 + $tmp_val;

														echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=32,36,56,3,51,50,60,43,24&eid=" . $rowemp["employeeID"] . "'>" . $tmp_val . "</a>";

														echo "</td>";



														echo "</tr>";
													}
												}
											}



											echo "</tbody>";

											?>

									</table>



								</td>





							</tr>



							<tr>
								<td>&nbsp;</td>
							</tr>



							<tr>

								<td valign="top">

									<table cellSpacing="1" cellPadding="1" border="0" width="1170">

										<tr>
											<td class="txtstyle_color" align="center" style="font-size:14pt;"><strong>Rescue Assignments</strong></td>
										</tr>

									</table>

									<table cellSpacing="1" cellPadding="1" border="0" width="1170" id="table15" class="tablesorter">

										<thead>

											<tr>

												<th width="170px" bgColor='#E4EAEB'><u>Employee</u></th>

												<th width='100px' bgColor='#E4EAEB' align="center"><u>Special Ops</u></th>

												<th width='100px' bgColor='#E4EAEB' align="center"><u>Qualified Proactive</u></th>

												<th width='60px' bgColor='#E4EAEB' align="center"><u>P1</u></th>

												<th width='60px' bgColor='#E4EAEB' align="center"><u>P2</u></th>

												<th width='60px' bgColor='#E4EAEB' align="center"><u>P3</u></th>

												<th width='100px' bgColor='#E4EAEB' align="center"><u>PO or PA Sent</u></th>

												<th width='100px' bgColor='#E4EAEB' align="center"><u>Prospect - TBD</u></th>

												<th width='100px' bgColor='#E4EAEB' align="center"><u>Open Deal</u></th>

												<th width='100px' bgColor='#E4EAEB' align="center"><u>Contracted</u></th>

												<th width='100px' bgColor='#E4EAEB' align="center"><u>Qualified Reactive</u></th>

												<th width='100px' bgColor='#E4EAEB' align="center"><u>Unqualified</u></th>

												<th width='100px' bgColor='#E4EAEB' align="center"><u>Inactive</u></th>

												<th width='100px' bgColor='#E4EAEB' align="center"><u>New Box Manufacturer</u></th>

												<th width='80px' bgColor='#E4EAEB' align="center"><u>Total</u></th>

											</tr>

										</thead>

										<tbody>

											<?php

											$grandtot = 0;

											//$sqle = "SELECT DISTINCT (employees.employeeid) FROM employees INNER JOIN companyInfo ON employees.employeeid = companyInfo.assignedto WHERE companyInfo.status IN (3,32,56,36,50,51)";

											$col1 = 0;
											$col2 = 0;
											$col3 = 0;
											$col4 = 0;
											$col5 = 0;
											$col6 = 0;
											$col7 = 0;
											$col8 = 0;
											$col9 = 0;
											$col10 = 0;
											$col11 = 0;
											$col12 = 0;
											$col13 = 0;
											$col14 = 0;

											$sql = "SELECT id, b2b_id ,name, initials as EMPLOYEE FROM loop_employees  where initials = '" . $all_emp . "'";
											db();
											$resulte = db_query($sql);

											while ($rowemp_loop = array_shift($resulte)) {

												$sql = "SELECT employeeID FROM employees WHERE employeeID = " . $rowemp_loop["b2b_id"];
												
												db_b2b();
												$rowemp_1 = db_query($sql);

												while ($rowemp = array_shift($rowemp_1)) {

													$sql = "SELECT sum(status) as cnt FROM companyInfo WHERE assignedto = " . $rowemp["employeeID"] . " AND status IN (58, 47, 61, 62, 63, 48, 6, 55, 38, 46, 44, 49, 59)";

													db_b2b();
													$result_m = db_query($sql);

													$overall_cnt = 0;

													while ($rowemp_m = array_shift($result_m)) {

														$overall_cnt = $rowemp_m["cnt"];
													}

													if ($overall_cnt > 0) {

														$tot = 0;

														$sql = "SELECT * FROM companyInfo WHERE assignedto = " . $rowemp["employeeID"] . " AND status = 58";
														
														db_b2b();
														$result = db_query($sql);

														$tmp_val = tep_db_num_rows($result);

														$col1 = $col1 + $tmp_val;

														echo "<tr><td bgColor='#E4EAEB'>" . $rowemp_loop["name"] . "</td><td bgColor='#E4EAEB' align=right><a target='_blank' href='report_show_assignments.php?show=status&statusid=58&eid=" . $rowemp["employeeID"] . "'>" . $tmp_val . "</a></td>";

														echo "<td bgColor='#E4EAEB' align=right>";

														$sql = "SELECT * FROM companyInfo WHERE assignedto = " . $rowemp["employeeID"] . " AND status = 47";

														db_b2b();
														$result = db_query($sql);

														$tmp_val = tep_db_num_rows($result);

														$col2 = $col2 + $tmp_val;

														echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=47&eid=" . $rowemp["employeeID"] . "'>" . $tmp_val . "</a>";

														echo "</td><td bgColor='#E4EAEB' align=right>";

														$sql = "SELECT * FROM companyInfo WHERE assignedto = " . $rowemp["employeeID"] . " AND status = 61";

														db_b2b();
														$result = db_query($sql);

														$tmp_val = tep_db_num_rows($result);

														$col3 = $col3 + $tmp_val;

														echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=61&eid=" . $rowemp["employeeID"] . "'>" . $tmp_val . "</a>";

														echo "</td><td bgColor='#E4EAEB' align=right>";

														$sql = "SELECT * FROM companyInfo WHERE assignedto = " . $rowemp["employeeID"] . " AND status = 62";

														db_b2b();
														$result = db_query($sql);

														$tmp_val = tep_db_num_rows($result);

														$col4 = $col4 + $tmp_val;

														echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=62&eid=" . $rowemp["employeeID"] . "'>" . $tmp_val . "</a>";

														echo "</td><td bgColor='#E4EAEB' align=right>";

														$sql = "SELECT * FROM companyInfo WHERE assignedto = " . $rowemp["employeeID"] . " AND status = 63";
														
														db_b2b();
														$result = db_query($sql);

														$tmp_val = tep_db_num_rows($result);

														$col5 = $col5 + $tmp_val;

														echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=63&eid=" . $rowemp["employeeID"] . "'>" . $tmp_val . "</a>";

														echo "</td><td bgColor='#E4EAEB' align=right>";

														$sql = "SELECT * FROM companyInfo WHERE assignedto = " . $rowemp["employeeID"] . " AND status = 48";

														db_b2b();

														$result = db_query($sql);

														$tmp_val = tep_db_num_rows($result);

														$col6 = $col6 + $tmp_val;

														echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=48&eid=" . $rowemp["employeeID"] . "'>" . $tmp_val . "</a>";

														echo "</td><td bgColor='#E4EAEB' align=right>";

														$sql = "SELECT * FROM companyInfo WHERE assignedto = " . $rowemp["employeeID"] . " AND status = 6";

														db_b2b();

														$result = db_query($sql);

														$tmp_val = tep_db_num_rows($result);

														$col7 = $col7 + $tmp_val;

														echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=6&eid=" . $rowemp["employeeID"] . "'>" . $tmp_val . "</a>";

														echo "</td><td bgColor='#E4EAEB' align=right>";

														$sql = "SELECT * FROM companyInfo WHERE assignedto = " . $rowemp["employeeID"] . " AND status = 55";

														db_b2b();

														$result = db_query($sql);

														$tmp_val = tep_db_num_rows($result);

														$col8 = $col8 + $tmp_val;

														echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=55&eid=" . $rowemp["employeeID"] . "'>" . $tmp_val . "</a>";

														echo "</td><td bgColor='#E4EAEB' align=right>";

														$sql = "SELECT * FROM companyInfo WHERE assignedto = " . $rowemp["employeeID"] . " AND status = 38";

														db_b2b();

														$result = db_query($sql);

														$tmp_val = tep_db_num_rows($result);

														$col9 = $col9 + $tmp_val;

														echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=38&eid=" . $rowemp["employeeID"] . "'>" . $tmp_val . "</a>";

														echo "</td><td bgColor='#E4EAEB' align=right>";

														$sql = "SELECT * FROM companyInfo WHERE assignedto = " . $rowemp["employeeID"] . " AND status = 46";

														db_b2b();

														$result = db_query($sql);

														$tmp_val = tep_db_num_rows($result);

														$col10 = $col10 + $tmp_val;

														echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=46&eid=" . $rowemp["employeeID"] . "'>" . $tmp_val . "</a>";

														echo "</td><td bgColor='#E4EAEB' align=right>";

														$sql = "SELECT * FROM companyInfo WHERE assignedto = " . $rowemp["employeeID"] . " AND status = 44";

														db_b2b();

														$result = db_query($sql);

														$tmp_val = tep_db_num_rows($result);

														$col11 = $col11 + $tmp_val;

														echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=44&eid=" . $rowemp["employeeID"] . "'>" . $tmp_val . "</a>";

														echo "</td><td bgColor='#E4EAEB' align=right>";

														$sql = "SELECT * FROM companyInfo WHERE assignedto = " . $rowemp["employeeID"] . " AND status = 49";

														db_b2b();

														$result = db_query($sql);

														$tmp_val = tep_db_num_rows($result);

														$col12 = $col12 + $tmp_val;

														echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=49&eid=" . $rowemp["employeeID"] . "'>" . $tmp_val . "</a>";

														echo "</td><td bgColor='#E4EAEB' align=right>";

														$sql = "SELECT * FROM companyInfo WHERE assignedto = " . $rowemp["employeeID"] . " AND status = 59";

														db_b2b();

														$result = db_query($sql);

														$tmp_val = tep_db_num_rows($result);

														$col13 = $col13 + $tmp_val;

														echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=59&eid=" . $rowemp["employeeID"] . "'>" . $tmp_val . "</a>";

														echo "</td><td bgColor='#E4EAEB' align=right>";

														$sql = "SELECT * FROM companyInfo WHERE assignedto = " . $rowemp["employeeID"] . " AND status IN (58, 47, 61, 62, 63, 48, 6, 55, 38, 46, 44, 49, 59)";

														db_b2b();

														$result = db_query($sql);

														$tmp_val = tep_db_num_rows($result);

														$col14 = $col14 + $tmp_val;

														echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=58,47,61,62,63,48,6,55,38,46,44,49,59&eid=" . $rowemp["employeeID"] . "'>" . $tmp_val . "</a>";

														echo "</td>";



														echo "</tr>";
													}
												}
											}



											echo "</tbody>";

											?>

									</table>



								</td>





							</tr>



							<tr>
								<td>&nbsp;</td>
							</tr>



							<tr>

								<td valign="top">

									<table cellSpacing="1" cellPadding="1" border="0" width="1170">

										<tr>
											<td class="txtstyle_color" align="center" style="font-size:14pt;"><strong>Other Assignments</strong></td>
										</tr>

									</table>

									<table cellSpacing="1" cellPadding="1" border="0" width="1170" id="table15" class="tablesorter">

										<thead>

											<tr>

												<th width="170px" bgColor='#E4EAEB'><u>Employee</u></th>

												<th width='100px' bgColor='#E4EAEB' align="center"><u>B2C Relationship</u></th>

												<th width='100px' bgColor='#E4EAEB' align="center"><u>Other</u></th>

												<th width='60px' bgColor='#E4EAEB' align="center"><u>Trash</u></th>

												<th width='80px' bgColor='#E4EAEB' align="center"><u>Total</u></th>

											</tr>

										</thead>

										<tbody>

											<?php

											$grandtot = 0;

											//$sqle = "SELECT DISTINCT (employees.employeeid) FROM employees INNER JOIN companyInfo ON employees.employeeid = companyInfo.assignedto WHERE companyInfo.status IN (3,32,56,36,50,51)";

											$col1 = 0;
											$col2 = 0;
											$col3 = 0;
											$col4 = 0;

											$sql = "SELECT id, b2b_id ,name, initials as EMPLOYEE FROM loop_employees where initials = '" . $all_emp . "'";

											db();
											$resulte = db_query($sql);



											while ($rowemp_loop = array_shift($resulte)) {

												$sql = "SELECT employeeID FROM employees WHERE employeeID = " . $rowemp_loop["b2b_id"];

												db_b2b();

												$rowemp_1 = db_query($sql);



												while ($rowemp = array_shift($rowemp_1)) {

													$sql = "SELECT sum(status) as cnt FROM companyInfo WHERE assignedto = " . $rowemp["employeeID"] . " AND status IN (52, 33, 31)";

													db_b2b();
													$result_m = db_query($sql);

													$overall_cnt = 0;

													while ($rowemp_m = array_shift($result_m)) {

														$overall_cnt = $rowemp_m["cnt"];
													}



													if ($overall_cnt > 0) {

														$tot = 0;

														$sql = "SELECT * FROM companyInfo WHERE assignedto = " . $rowemp["employeeID"] . " AND status = 52";

														db_b2b();

														$result = db_query($sql);

														$tmp_val = tep_db_num_rows($result);

														$col1 = $col1 + $tmp_val;

														echo "<tr><td bgColor='#E4EAEB'>" . $rowemp_loop["name"] . "</td><td bgColor='#E4EAEB' align=right><a target='_blank' href='report_show_assignments.php?show=status&statusid=52&eid=" . $rowemp["employeeID"] . "'>" . $tmp_val . "</a></td>";

														echo "<td bgColor='#E4EAEB' align=right>";

														$sql = "SELECT * FROM companyInfo WHERE assignedto = " . $rowemp["employeeID"] . " AND status = 33";

														db_b2b();

														$result = db_query($sql);

														$tmp_val = tep_db_num_rows($result);

														$col2 = $col2 + $tmp_val;

														echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=33&eid=" . $rowemp["employeeID"] . "'>" . $tmp_val . "</a>";

														echo "</td><td bgColor='#E4EAEB' align=right>";

														$sql = "SELECT * FROM companyInfo WHERE assignedto = " . $rowemp["employeeID"] . " AND status = 31";

														db_b2b();

														$result = db_query($sql);

														$tmp_val = tep_db_num_rows($result);

														$col3 = $col3 + $tmp_val;

														echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=31&eid=" . $rowemp["employeeID"] . "'>" . $tmp_val . "</a>";

														echo "</td><td bgColor='#E4EAEB' align=right>";

														$sql = "SELECT * FROM companyInfo WHERE assignedto = " . $rowemp["employeeID"] . " AND status IN (52, 33, 31)";

														db_b2b();

														$result = db_query($sql);

														$tmp_val = tep_db_num_rows($result);

														$col4 = $col4 + $tmp_val;

														echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=52,33,31&eid=" . $rowemp["employeeID"] . "'>" . $tmp_val . "</a>";

														echo "</td>";



														echo "</tr>";
													}
												}
											}



											echo "</tbody>";



											?>

									</table>



								</td>



							</tr>



						</table>

					<?php } ?>

					<br /> <br />

				<?php }

				?>
				<!-- Load the page by default with old logic - do not apply date range-->
		</div>
	</body>
</html>