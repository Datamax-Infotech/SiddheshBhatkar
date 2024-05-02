<?php
	session_start();
	require_once("inc/header_session.php");
	require_once("../mainfunctions/database.php");
	require_once("../mainfunctions/general-functions.php")
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Deleted and Active/Inactive Transaction log list | UsedCardboardBoxes</title>
		<link rel="stylesheet" type="text/css" href="css/new_header-dashboard.css" />
		<link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
		<link rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>

		<script language="JavaScript" src="inc/CalendarPopup.js"></SCRIPT>
		<script language="JavaScript" src="inc/general.js"></SCRIPT>

		<script language="JavaScript">
			document.write(getCalendarStyles());
		</script>

		<script language="JavaScript">
			var cal2xx = new CalendarPopup("listdiv");

			cal2xx.showNavigationDropdowns();





			function loadmainpg() {

				var date_from = document.getElementById('date_from').value;

				var date_to = document.getElementById('date_to').value;

				var dformat1 = "yyyy-MM-dd";

				var dformat2 = "yyyy-MM-dd";



				if (date_from != "" && date_to != "") {

					var chkdate1 = compareDates(date_from, dformat1, date_to, dformat2);

					if (chkdate1 != 0) {

						alert("'To Date' must be greater then 'From Date'");

						return false;

					}



					if (chkdate1 == 0) {

						document.report_del_history.submit();

						return true;

					}



				}

			}
		</script>
	</head>
	<style>
		.outer-container {

			width: 100%;

			margin: 0 auto;

		}

		.container {

			padding: 10px;



		}

		.content {

			margin: 0 auto;

			width: 100%;

			display: grid;

		}

		.txtstyle_color {

			font-family: arial;

			font-size: 13;

			font-weight: 700;

			height: 16px;

			background: #d6d6d6;

			color: #333333;

			text-align: center;

		}

		.datarow tr:hover td {

			background-color: #FFFFFF;

		}

		.rowstyle {

			padding: 0 5px;

			background-color: #EDEDED;

		}

		.center {

			text-align: center;

		}

		.left {

			text-align: left;

		}
	</style>
	<body>
		<?php require_once("inc/header.php");

		if (!isset($_GET['date_from'])) {

			$_REQUEST['date_from']	= date("Y-m-d", strtotime("-1 week"));

			$_REQUEST['date_to']	= date("Y-m-d", strtotime("now"));

			$_GET['quotesse'] = 1;
		}
		?>

		<br><br>

		<div class="outer-container">

			<div class="container">

				<div class="dashboard_heading" style="float: left;">

					<div style="float: left;">Deleted/Cancelled Transaction Summary Report</div>

					&nbsp;<div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>

						<span class="tooltiptext">This report shows the user all B2B transactions that have been deleted or cancelled.</span>
					</div>

					<div style="height: 13px;">&nbsp;</div>

				</div>

				<div class="content">
	
					<form method="get" name="report_del_history" id="report_del_history" action="<?php echo $_SERVER['PHP_SELF']; ?>">

						<table>

							<tr>

								<td style="white-space: nowrap;">

									<div id="showcal">

										Date from:

										<input type="text" name="date_from" id="date_from" size="8" value="<?php echo isset($_REQUEST['date_from']) ? $_REQUEST['date_from'] : ''; ?>">

										<a href="#" onclick="cal2xx.select(document.report_del_history.date_from,'dtanchor2xx','yyyy-MM-dd'); return false;" name="dtanchor2xx" id="dtanchor2xx"><img border="0" src="images/calendar.jpg"></a>

										<div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>

									</div>

								</td>

								<td>

									<div id="showcal">

										&emsp;To:

										<input type="text" name="date_to" id="date_to" size="8" value="<?php echo isset($_REQUEST['date_to']) ? $_REQUEST['date_to'] : ''; ?>">

										<a href="#" onclick="cal2xx.select(document.report_del_history.date_to,'dtanchor3xx','yyyy-MM-dd'); return false;" name="dtanchor3xx" id="dtanchor3xx"><img border="0" src="images/calendar.jpg"></a>



									</div>

								</td>

								<td rowspan='3'>

									<input type="hidden" id="reprun" name="reprun" value="yes">

									<input type="hidden" id="date_tomorrow" value="<?php echo date("Y-m-j", strtotime("+1 day")); ?>">

									<input type="button" value="Run Report" onClick="javascript: return loadmainpg()">

								</td>

							</tr>

						</table>

					</form>

					<h3><i>This Page show the entire list of record either Deleted or their ignore status is changed.</i></h3>
				</div><br>

				<div class="content">
					<?php
						$sqlpara = '';

						$sorturl = "report_del_history.php?date_from=" . $_REQUEST["date_from"] . "&date_to=" . $_REQUEST["date_to"];

						if (isset($_REQUEST['sort'])) {

							switch ($_REQUEST['sort']) {

								case 'tname':
									$sqlpara = "ORDER BY `trans_table` " . $_REQUEST['sort_order_pre'];
									break;

								case 'recid':
									$sqlpara = "ORDER BY `trans_rec_id` " . $_REQUEST['sort_order_pre'];
									break;

								case 'statN':
									$sqlpara = "ORDER BY `trans_status` " . $_REQUEST['sort_order_pre'];
									break;

								case 'statusr':
									$sqlpara = "ORDER BY `trans_removed_by` " . $_REQUEST['sort_order_pre'];
									break;

								case 'reason':
									$sqlpara = "ORDER BY `trans_reason` " . $_REQUEST['sort_order_pre'];
									break;

								case 'cdate':
									$sqlpara = "ORDER BY `trans_date` " . $_REQUEST['sort_order_pre'];
									break;
							}
						}

						if (!isset($_GET['date_from'])) {

							$_REQUEST['date_from']	= date("Y-m-d", strtotime("-1 week"));

							$_REQUEST['date_to']	= date("Y-m-d", strtotime("now"));

							$_GET['quotesse'] = 1;
						}

					?>

					<table class="datarow" cellSpacing='1' cellPadding='1' border='0'>

						<thead>

							<tr>

								<th width="100%" bgcolor="#C0CDDA" align="center" colspan="7">

									<font face="Arial, Helvetica, sans-serif">Records Deleted</font>

								</th>

							</tr>

							<tr>

								<th class='txtstyle_color' width='10%'>Sr. No.</th>



								<th class='txtstyle_color' width='20%'>Table Name &nbsp;

									<a href='<?php echo $sorturl; ?>sort_order_pre=ASC&sort=tname'><img src='images/sort_asc.png' width='6px' height='12px'></a>&nbsp;

									<a href='<?php echo $sorturl; ?>sort_order_pre=DESC&sort=tname'><img src='images/sort_desc.png' width='6px' height='12px'></a>

								</th>

								<th class='txtstyle_color' width='10%'>Record Id&nbsp;

									<a href='<?php echo $sorturl; ?>sort_order_pre=ASC&sort=recid'><img src='images/sort_asc.png' width='6px' height='12px'></a>&nbsp;

									<a href='<?php echo $sorturl; ?>sort_order_pre=DESC&sort=recid'><img src='images/sort_desc.png' width='6px' height='12px'></a>

								</th>

								<th class='txtstyle_color' width='10%'>Status&nbsp;

									<a href='<?php echo $sorturl; ?>sort_order_pre=ASC&sort=statN'><img src='images/sort_asc.png' width='6px' height='12px'></a>&nbsp;

									<a href='<?php echo $sorturl; ?>sort_order_pre=DESC&sort=statN'><img src='images/sort_desc.png' width='6px' height='12px'></a>

								</th>

								<th class='txtstyle_color' width='15%'>Status Change By&nbsp;

									<a href='<?php echo $sorturl; ?>sort_order_pre=ASC&sort=statusr'><img src='images/sort_asc.png' width='6px' height='12px'></a>&nbsp;

									<a href='<?php echo $sorturl; ?>sort_order_pre=DESC&sort=statusr'><img src='images/sort_desc.png' width='6px' height='12px'></a>

								</th>

								<th class='txtstyle_color' width='25%'>Reason&nbsp;

									<a href='<?php echo $sorturl; ?>sort_order_pre=ASC&sort=reason'><img src='images/sort_asc.png' width='6px' height='12px'></a>&nbsp;

									<a href='<?php echo $sorturl; ?>sort_order_pre=DESC&sort=reason'><img src='images/sort_desc.png' width='6px' height='12px'></a>

								</th>

								<th class='txtstyle_color' width='10%'>Date&nbsp;

									<a href='<?php echo $sorturl; ?>sort_order_pre=ASC&sort=cdate'><img src='images/sort_asc.png' width='6px' height='12px'></a>&nbsp;

									<a href='<?php echo $sorturl; ?>sort_order_pre=DESC&sort=cdate'><img src='images/sort_desc.png' width='6px' height='12px'></a>

								</th>

							</tr>

						</thead>

						<?php

						db();

						$start_Dt = $_GET["date_from"];

						$end_Dt = $_GET["date_to"];

						if ($sqlpara == "") {

							$result = db_query("SELECT * FROM loop_transaction_deleted where trans_date between '" . $start_Dt . "' AND '" . $end_Dt . " 23:59:59' order by trans_date desc");
						} else {

							$result = db_query("SELECT * FROM loop_transaction_deleted where trans_date between '" . $start_Dt . "' AND '" . $end_Dt . " 23:59:59' " . $sqlpara);
						}

						if (!empty($result)) {
							$slno = 0;
							
							while ($row = array_shift($result)) {

						?>
								<tr>

									<td class='rowstyle center'><?php echo (++$slno); ?></td>

									<td class='rowstyle'><?php echo $row['trans_table']; ?></td>

									<td class='rowstyle center'><?php echo $row['trans_rec_id']; ?></td>

									<td class='rowstyle'><?php echo $row['trans_status']; ?></td>

									<td class='rowstyle'><?php echo $row['trans_removed_by']; ?></td>

									<td class='rowstyle'><?php echo $row['trans_reason']; ?></td>

									<td class='rowstyle center'><?php echo timestamp_to_date($row['trans_date']); ?></td>

								</tr>
						<?php

							}
						}

						?>

					</table><br>

				</div>

			</div>

		</div>

	</body>

</html>
