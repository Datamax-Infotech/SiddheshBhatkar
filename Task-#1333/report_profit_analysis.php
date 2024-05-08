<?php
	require("inc/header_session.php");
	require("../mainfunctions/database.php");
	require("../mainfunctions/general-functions.php");
?>
<!DOCTYPE html>
<html>
	<head>
	<title>Report Profit Analysis</title>
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



		span.infotxt:hover {
			text-decoration: none;
			background: #ffffff;
			z-index: 6;
		}

		span.infotxt span {
			position: absolute;
			left: -9999px;
			margin: 20px 0 0 0px;
			padding: 3px 3px 3px 3px;
			z-index: 6;
		}

		span.infotxt:hover span {
			left: 45%;
			background: #ffffff;
		}

		span.infotxt span {
			position: absolute;
			left: -9999px;
			margin: 0px 0 0 0px;
			padding: 3px 3px 3px 3px;
			border-style: solid;
			border-color: black;
			border-width: 1px;
		}

		span.infotxt:hover span {
			margin: 18px 0 0 170px;
			background: #ffffff;
			z-index: 6;
		}



		span.infotxt_freight:hover {
			text-decoration: none;
			background: #ffffff;
			z-index: 6;
		}

		span.infotxt_freight span {
			position: absolute;
			left: -9999px;
			margin: 20px 0 0 0px;
			padding: 3px 3px 3px 3px;
			z-index: 6;
		}

		span.infotxt_freight:hover span {
			left: 0%;
			background: #ffffff;
		}

		span.infotxt_freight span {
			position: absolute;
			width: 850px;
			overflow: auto;
			height: 300px;
			left: -9999px;
			margin: 0px 0 0 0px;
			padding: 10px 10px 10px 10px;
			border-style: solid;
			border-color: white;
			border-width: 50px;
		}

		span.infotxt_freight:hover span {
			margin: 5px 0 0 50px;
			background: #ffffff;
			z-index: 6;
		}

		span.infotxt_freight2:hover {
			text-decoration: none;
			background: #ffffff;
			z-index: 6;
		}

		span.infotxt_freight2 span {
			position: absolute;
			left: -9999px;
			margin: 20px 0 0 0px;
			padding: 3px 3px 3px 3px;
			z-index: 6;
		}

		span.infotxt_freight2:hover span {
			left: 0%;
			background: #ffffff;
		}

		span.infotxt_freight2 span {
			position: absolute;
			width: 850px;
			overflow: auto;
			height: 300px;
			left: -9999px;
			margin: 0px 0 0 0px;
			padding: 10px 10px 10px 10px;
			border-style: solid;
			border-color: white;
			border-width: 50px;
		}

		span.infotxt_freight2:hover span {
			margin: 5px 0 0 500px;
			background: #ffffff;
			z-index: 6;
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
	<script language="JavaScript" SRC="inc/general.js"></script>

	<script language="JavaScript">
		document.write(getCalendarStyles());
	</script>

	<script LANGUAGE="JavaScript">
		var cal2xx = new CalendarPopup("listdiv");

		cal2xx.showNavigationDropdowns();



		function loadmainpg()

		{

			if (document.getElementById('date_from').value != "" && document.getElementById('date_to').value != "")

			{

				//document.frmactive.action = "adminpg.php";

			} else

			{

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

				<div style="float: left;">Report Profit Analysis

					<div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>

						<span class="tooltiptext">

							This report shows the user the profitability of each department by month. This report will not match QuickBooks directly, but will be a good estimation of gross profit by department.

						</span>
					</div>

					<div style="height: 13px;">&nbsp;</div>

				</div>

			</div>

			<font color=red>THIS IS A PRIVATE REPORT, DO NOT SHARE THE LINK.</font><br>

			<form method="get" name="report_profit_analysis" action="report_profit_analysis.php">

				<table border="0">

					<tr>

						<td>

							Invoice Date From:

							<input type="text" name="date_from" id="date_from" size="10" value="<?php echo isset($_GET['date_from']) ? $_GET['date_from'] : ''; ?>">

							<a href="#" onclick="cal2xx.select(document.report_profit_analysis.date_from,'dtanchor2xx','MM/dd/yyyy'); return false;" name="dtanchor2xx" id="dtanchor2xx"><img border="0" src="images/calendar.jpg"></a>

							<div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>

							To:

							<input type="text" name="date_to" id="date_to" size="10" value="<?php echo isset($_GET['date_to']) ? $_GET['date_to'] : ''; ?>">

							<a href="#" onclick="cal2xx.select(document.report_profit_analysis.date_to,'dtanchor3xx','MM/dd/yyyy'); return false;" name="dtanchor3xx" id="dtanchor3xx"><img border="0" src="images/calendar.jpg"></a>

							<div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>

						</td>

						<td>

							<input type=submit value="Run Report">

						</td>

					</tr>

				</table>

			</form>

			<?php

			if (isset($_REQUEST["date_from"])) {

			?>

				<table cellSpacing="1" cellPadding="1" border="0" width="1000">

					<tr>

						<td bgColor='#c0cdda' align="center" colspan="9"><strong>Report Profit Analysis</strong></td>

					</tr>

					<tr>

						<td bgColor='#c0cdda' width="300"><strong><u>Transcation ID</u></strong></td>

						<td bgColor='#c0cdda' width="300"><strong><u>Invoice Date</u></strong></td>

						<td bgColor='#c0cdda' width="300"><strong><u>PO Amount</u></strong></td>

						<td bgColor='#c0cdda' width="300"><strong><u>Invoice Amount</u></strong></td>

						<td bgColor='#c0cdda' width="300"><strong><u>Sent Invoice Amount</u></strong></td>

						<td bgColor='#c0cdda' width="300"><strong><u>Paid Amount</u></strong></td>

						<td bgColor='#c0cdda' width="300"><strong><u>Vendor Payments</u></strong></td>

						<td bgColor='#c0cdda' width="300"><strong><u>Profit Amount</u></strong></td>

						<td bgColor='#c0cdda' width="300"><strong><u>COGS %</u></strong></td>

					</tr>

					<?php

					$date_from = date("Y-m-d", strtotime($_REQUEST["date_from"]));

					$date_to = date("Y-m-d", strtotime($_REQUEST["date_to"]));

					$sql = "SELECT loop_transaction_buyer.id as rec_id, loop_transaction_buyer.inv_date_of FROM loop_transaction_buyer WHERE STR_TO_DATE(loop_transaction_buyer.inv_date_of, '%m/%d/%Y') BETWEEN '" . $date_from . " 00:00:00' AND '" . $date_to . " 23:59:59' and loop_transaction_buyer.ignore = 0 ORDER BY loop_transaction_buyer.id";

					db();

					$result = db_query($sql);

					while ($rowtrans = array_shift($result)) {

						$vendor_pay = 0;

						$dt_view_qry = "SELECT *, loop_transaction_buyer_payments.id AS A , loop_transaction_buyer_payments.status AS B, files_companies.name AS C from loop_transaction_buyer_payments left JOIN files_companies ON loop_transaction_buyer_payments.company_id = files_companies.id  INNER JOIN loop_vendor_type ON loop_transaction_buyer_payments.typeid = loop_vendor_type.id  WHERE loop_transaction_buyer_payments.transaction_buyer_id = " . $rowtrans['rec_id'];

						db();

						$dt_view_res = db_query($dt_view_qry);

						$num_rows = tep_db_num_rows($dt_view_res);

						if ($num_rows > 0) {

							while ($dt_view_row = array_shift($dt_view_res)) {

								$vendor_pay += $dt_view_row["estimated_cost"];
							}
						}

						$dt_view_qry = "SELECT po_file, po_poorderamount, inv_amount, po_date, po_employee, inv_date, proof_of_delivery from loop_transaction_buyer WHERE id = '" . $rowtrans['rec_id'] . "' AND po_file != ''";

						db();

						$dt_view_res = db_query($dt_view_qry);

						$pofilename = "";

						$po_amt = 0;

						$inv_amount = 0;

						$po_date = "";

						$po_employee = "";

						$inv_date = "";
						$proof_of_delivery = "";

						while ($num_rows = array_shift($dt_view_res)) {

							$pofilename = $num_rows["po_file"];

							$po_amt = $num_rows["po_poorderamount"];

							$inv_amount = $num_rows["inv_amount"];

							$po_date = $num_rows["po_date"];

							$po_employee = $num_rows["po_employee"];

							$inv_date = $num_rows["inv_date"];

							$proof_of_delivery = empty($num_rows["proof_of_delivery"]) ? '' : $num_rows["proof_of_delivery"];
						}



						$so_view_qry = "SELECT file_name, bol_signed_file_name from loop_bol_files WHERE trans_rec_id = " . $rowtrans['rec_id'] . " and bol_shipped = 1 ORDER BY id DESC";

						$unsign_bol = "";
						$sign_bol = "";

						db();
						
						$so_view_res = db_query($so_view_qry);

						while ($rows = array_shift($so_view_res)) {

							$unsign_bol = $rows["file_name"];

							$sign_bol = $rows["bol_signed_file_name"];
						}





						$invoice_amt = 0;

						$inv_qry = "SELECT * FROM loop_invoice_items WHERE trans_rec_id = " . $rowtrans['rec_id'] . " ORDER BY id ASC";

						db();
						$inv_res = db_query($inv_qry);

						while ($inv_row = array_shift($inv_res)) {

							$invoice_amt += $inv_row["quantity"] * $inv_row["price"];
						}

						if ($invoice_amt == 0) {

							$invoice_amt = $inv_amount;
						}


						$inv_qry = "SELECT timestamp FROM loop_invoice_details WHERE trans_rec_id = " . $rowtrans['rec_id'] . " ORDER BY id ASC";

						$inv_timestamp = "";

						db();

						$inv_res = db_query($inv_qry);

						while ($inv_row = array_shift($inv_res)) {

							$inv_timestamp = $inv_row["timestamp"];
						}



						$dt_view_qry = "SELECT * from loop_buyer_payments WHERE trans_rec_id LIKE '" . $rowtrans['rec_id'] . "'";

						$paid_amount = 0;

						$paid_amount_date = "";

						db();
						$dt_view_res = db_query($dt_view_qry);

						while ($dt_view_row = array_shift($dt_view_res)) {

							$paid_amount += $dt_view_row["amount"];

							$paid_amount_date = $dt_view_row["date"];
						}

						$profit_val = $invoice_amt - $vendor_pay;

						$profit_val_per = "";

						if ($profit_val > 0) {

							$profit_val_per = ($profit_val * 100) / $invoice_amt;



							if ($profit_val_per > 50) {

								$profit_val_per = " (<font color='#F46DD9'>" . number_format((($profit_val * 100) / $invoice_amt), 2) . "%</font>)";
							} else if ($profit_val_per < 50) {

								$profit_val_per = " (<font color='#EE3838'>" . number_format((($profit_val * 100) / $invoice_amt), 2) . "%</font>)";
							}
						}

						$profit_val = number_format($invoice_amt - $vendor_pay, 2);

					?>

						<tr>

							<td bgColor='#e4e4e4'><?php echo $rowtrans["rec_id"]; ?></td>

							<td bgColor='#e4e4e4'><?php echo $rowtrans["inv_date_of"]; ?></td>

							<td bgColor='#e4e4e4' align="right">$<?php echo number_format($po_amt, 2); ?></td>

							<td bgColor='#e4e4e4' align="right">$<?php echo number_format($invoice_amt, 2); ?></td>

							<td bgColor='#e4e4e4' align="right">$<?php echo number_format($inv_amount, 2); ?></td>

							<td bgColor='#e4e4e4' align="right">$<?php echo number_format($paid_amount, 2); ?></td>

							<td bgColor='#e4e4e4' align="right">$<?php echo number_format($vendor_pay, 2); ?></td>

							<td bgColor='#e4e4e4' align="right">$<?php if ($profit_val > 0) {
																		echo '<font color=green>' . $profit_val . '</font>' . $profit_val_per;
																	} else {
																		echo '<font color=red>' . $profit_val . '</font>' . $profit_val_per;
																	} ?></td>

							<td bgColor='#e4e4e4' align="right"><?php echo number_format(($vendor_pay / $invoice_amt) * 100, 2); ?>%</td>



						</tr>

					<?php

						$po_amt_tot = $po_amt_tot + $po_amt;

						$invoice_amt_tot = $invoice_amt_tot + $invoice_amt;

						$inv_amount_tot = $inv_amount_tot + $inv_amount;

						$paid_amount_tot = $paid_amount_tot + $paid_amount;

						$vendor_pay_tot = $vendor_pay_tot + $vendor_pay;
					}

					$profit_val_tot1 = $invoice_amt_tot - $vendor_pay_tot;

					$profit_val_per_tot = ($profit_val_tot1 * 100) / $invoice_amt_tot;

					if ($profit_val_per_tot > 50) {

						$profit_val_per_tot = " (<font color='#F46DD9'>" . number_format((($profit_val_tot1 * 100) / $invoice_amt_tot), 2) . "%</font>)";
					} else if ($profit_val_per_tot < 50) {

						$profit_val_per_tot = " (<font color='#EE3838'>" . number_format((($profit_val_tot1 * 100) / $invoice_amt_tot), 2) . "%</font>)";
					}





					$profit_val_tot = number_format($invoice_amt_tot - $vendor_pay_tot, 2);

					?>

					<tr>

						<td bgColor='#e4e4e4' colspan="2"><strong>Total</strong></td>

						<td bgColor='#e4e4e4' align="right"><strong>$<?php echo number_format($po_amt_tot, 2); ?></strong></td>

						<td bgColor='#e4e4e4' align="right"><strong>$<?php echo number_format($invoice_amt_tot, 2); ?></strong></td>

						<td bgColor='#e4e4e4' align="right"><strong>$<?php echo number_format($inv_amount_tot, 2); ?></strong></td>

						<td bgColor='#e4e4e4' align="right"><strong>$<?php echo number_format($paid_amount_tot, 2); ?></strong></td>

						<td bgColor='#e4e4e4' align="right"><strong>$<?php echo number_format($vendor_pay_tot, 2); ?></strong></td>

						<td bgColor='#e4e4e4' align="right"><strong>$<?php if ($profit_val_tot > 0) {
																			echo '<font color=green>' . $profit_val_tot . '</font>' . $profit_val_per_tot;
																		} else {
																			echo '<font color=red>' . $profit_val_tot . '</font>' . $profit_val_per_tot;
																		} ?></strong></td>

						<td bgColor='#e4e4e4' align="right"><strong><?php echo number_format(($vendor_pay_tot / $invoice_amt_tot) * 100, 2); ?>%</strong></td>

					</tr>

				<?php

			} //date range

				?>
		</div>
	</body>
</html>