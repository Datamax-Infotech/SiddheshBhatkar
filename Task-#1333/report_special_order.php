<?php
require ("inc/header_session.php");
require ("../mainfunctions/database.php");
require ("../mainfunctions/general-functions.php");
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Special Orders Summary</title>
	<style type="text/css">
		.style7 {
			font-size: x-small;
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

		.style12center {
			font-family: Arial, Helvetica, sans-serif;
			font-size: x-small;
			color: #333333;
			text-align: center;
		}

		.style12right {
			font-family: Arial, Helvetica, sans-serif;
			font-size: x-small;
			color: #333333;
			text-align: right;
		}

		.style12left {
			font-family: Arial, Helvetica, sans-serif;
			font-size: x-small;
			color: #333333;
			text-align: left;
		}

		.style13 {
			font-family: Arial, Helvetica, sans-serif;
		}

		.style14 {
			font-size: x-small;
		}

		.style15 {
			font-size: x-small;
		}

		.style16 {
			font-family: Arial, Helvetica, sans-serif;
			font-size: x-small;
			background-color: #99FF99;
		}

		.style17 {
			font-family: Arial, Helvetica, sans-serif;
			font-size: x-small;
			color: #333333;
			background-color: #99FF99;
		}

		select,
		input {
			font-family: Arial, Helvetica, sans-serif;
			font-size: 12px;
			color: #000000;
			font-weight: normal;
		}

		table.datatable {
			border-collapse: collapse;
			background: #FFF;
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

		span.so_infotxt:hover {
			text-decoration: none;
			background: #ffffff;
			z-index: 6;
		}

		span.so_infotxt span {
			position: absolute;
			left: -9999px;
			margin: 20px 0 0 0px;
			padding: 3px 3px 3px 3px;
			z-index: 6;
		}

		span.so_infotxt:hover span {
			left: 0%;
			background: #ffffff;
		}

		span.so_infotxt span {
			position: absolute;
			left: -9999px;
			margin: 0px 0 0 0px;
			padding: 3px 3px 3px 3px;
			border-style: solid;
			border-color: black;
			border-width: 1px;
		}

		span.so_infotxt:hover span {
			margin: 18px 0 0 50px;
			background: #ffffff;
			z-index: 6;
		}

		.special_order_normal {
			background-color: #e4e4e4;
		}

		.special_order_red {
			background-color: #FF0004;
		}

		.special_order_green {
			background-color: #51D337;
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
			width: 1000px;
			z-index: 1002;
			margin: 0px 0 0 0px;
			padding: 10px 10px 10px 10px;
			border-color: black;
			border-width: 2px;
			overflow: auto;
		}
	</style>
	<SCRIPT LANGUAGE="JavaScript" SRC="inc/CalendarPopup.js"></SCRIPT>
	<SCRIPT LANGUAGE="JavaScript" SRC="inc/general.js"></SCRIPT>
	<script LANGUAGE="JavaScript">
		document.write(getCalendarStyles());
	</script>
	<script LANGUAGE="JavaScript">
		var cal2xx = new CalendarPopup("listdiv");

		cal2xx.showNavigationDropdowns();

		var cal3xx = new CalendarPopup("listdiv");

		cal3xx.showNavigationDropdowns();
	</script>
	<script LANGUAGE="JavaScript">
		/*Special order update function*/

		function update_so_note(ctrlnm, rec_id, empid) {

			var last_note = escape(document.getElementById("last_note_so" + ctrlnm).value);

			var rec_type = document.getElementById("rect_type_so" + ctrlnm).value;

			if (window.XMLHttpRequest) {

				xmlhttp = new XMLHttpRequest();
			} else {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}

			xmlhttp.onreadystatechange = function() {

				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

					alert("Note has been updated successfully");

					document.getElementById("transinfo" + ctrlnm).innerHTML = xmlhttp.responseText;

					var trans_note = document.getElementById("trans_note").value;

					var trans_date = document.getElementById("trans_date").value;

					document.getElementById("last_note_so" + ctrlnm).value = trans_note;

					document.getElementById("transdate_div" + ctrlnm).innerHTML = trans_date;

				}

			}

			xmlhttp.open("POST", "update_note_special_oder.php?wid=" + ctrlnm + "&update_flg=1" + "&empid=" + empid + "&rec_id=" + rec_id + "&rec_type=" + rec_type + "&last_note=" + last_note, true);

			xmlhttp.send();

		}

		function f_getPosition(e_elemRef, s_coord) {

			var n_pos = 0,
				n_offset,

				e_elem = e_elemRef;

			while (e_elem) {

				n_offset = e_elem["offset" + s_coord];

				n_pos += n_offset;

				e_elem = e_elem.offsetParent;

			}

			e_elem = e_elemRef;

			while (e_elem != document.body) {

				n_offset = e_elem["scroll" + s_coord];

				if (n_offset && e_elem.style.overflow == 'scroll')

					n_pos -= n_offset;

				e_elem = e_elem.parentNode;

			}

			return n_pos;

		}

		/*Special order complete function*/

		function complete_specialorder_row(ctrlnm, rec_id, completed_flg) {

			var updatefrom = "report_so";

			if (window.XMLHttpRequest) {

				xmlhttp = new XMLHttpRequest();
			} else {

				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}

			xmlhttp.onreadystatechange = function() {

				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

					if (xmlhttp.responseText != "undo completed") {

						var table_row = document.getElementById("so" + ctrlnm);

						table_row.setAttribute('class', 'special_order_green');

						document.getElementById("complete_so_div" + ctrlnm).innerHTML = xmlhttp.responseText;

						so_process_complete_email(ctrlnm, rec_id, 1);

					}

					if (xmlhttp.responseText == "undo completed") {

						var table_row = document.getElementById("so" + ctrlnm);

						table_row.setAttribute('class', 'special_order_normal');

						document.getElementById("complete_so_div" + ctrlnm).innerHTML = "<input type='button' name='complete_so' id='complete_so" + ctrlnm + "' onclick='complete_specialorder_row(" + ctrlnm + "," + rec_id + ",1); return false;' value='Complete'>";

					}
				}
			}

			xmlhttp.open("GET", "complete_special_oder.php?wid=" + ctrlnm + "&completed_flg=" + completed_flg + "&rec_id=" + rec_id + "&updatefrom=" + updatefrom, true);

			xmlhttp.send();

		}

		function so_process_complete_email(ctrlnm, rec_id, flg) {

			var selectedText, selectobject, rec_type, skillsSelect, n_left, n_top;

			selectobject = document.getElementById("complete_so_div" + ctrlnm);

			var deadlinedate = document.getElementById("deadlinedate" + ctrlnm).value;

			var pprintdata = document.getElementById("pprintdata" + ctrlnm).value;

			var n_left = f_getPosition(selectobject, 'Left');

			var n_top = f_getPosition(selectobject, 'Top');

			document.getElementById('light').style.left = 300 + 'px';

			document.getElementById('light').style.top = n_top + 30 + 'px';

			if (window.XMLHttpRequest) {

				xmlhttp = new XMLHttpRequest();
			} else {

				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}

			xmlhttp.onreadystatechange = function() {

				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

					document.getElementById("light").innerHTML = "<a href='javascript:void(0)' onclick=document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'>Close</a> &nbsp;<center></center><br/>" + xmlhttp.responseText;

					document.getElementById('light').style.display = 'block';

				}
			}

			xmlhttp.open("POST", "so_complete_process_email.php?wid=" + rec_id + "&rec_id=" + ctrlnm + "&deadlinedate=" + deadlinedate + "&pprintdata=" + pprintdata + "&complete_email=1", true);

			xmlhttp.send();

		}

		function load_div(id) {

			var element = document.getElementById("spanctr" + id); //replace elementId with your element's Id.

			var rect = element.getBoundingClientRect();

			var elementLeft, elementTop; //x and y

			var scrollTop = document.documentElement.scrollTop ?

				document.documentElement.scrollTop : document.body.scrollTop;

			var scrollLeft = document.documentElement.scrollLeft ?

				document.documentElement.scrollLeft : document.body.scrollLeft;

			elementTop = rect.top + scrollTop;

			elementLeft = rect.left + scrollLeft;

			document.getElementById("light").innerHTML = document.getElementById("spanctr" + id).innerHTML;

			document.getElementById('light').style.display = 'block';

			document.getElementById('fade').style.display = 'block';

			document.getElementById('light').style.left = '100px';

			document.getElementById('light').style.top = elementTop + 100 + 'px';

		}

		function close_div() {

			document.getElementById('light').style.display = 'none';

		}
	</script>
	<link rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>
	<LINK rel='stylesheet' type='text/css' href='one_style.css'>
	<link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
</head>

<body>
	<div id="light" class="white_content">
	</div>
	<div id="fade" class="black_overlay"></div>
	<?php include "inc/header.php"; ?>
	<div class="main_data_css">
		<div class="dashboard_heading" style="float: left;">
			<div style="float: left;">
				B2B Special Orders Summary Report
				<div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
					<span class="tooltiptext">This report allows the user to see all orders that require special processing or re-processing.</span>
				</div>
				<br>
			</div>
		</div>
		<form method="post" name="inv_frm" action="report_special_order.php">
			<table border="0">
				<tr>
					<td>Date Range Selector:</td>
					<td>
						From:
						<input type="text" name="date_from" id="date_from" size="10" value="<?php echo isset(
																								$_POST["date_from"]
																							)
																								? $_POST["date_from"]
																								: ""; ?>">
						<a href="#" onclick="cal2xx.select(document.inv_frm.date_from,'dtanchor2xx','MM/dd/yyyy'); return false;" name="dtanchor2xx" id="dtanchor2xx"><img border="0" src="images/calendar.jpg"></a>
						<div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>
						To:
						<input type="text" name="date_to" id="date_to" size="10" value="<?php echo isset(
																							$_POST["date_to"]
																						)
																							? $_POST["date_to"]
																							: ""; ?>">
						<a href="#" onclick="cal3xx.select(document.inv_frm.date_to,'dtanchor3xx','MM/dd/yyyy'); return false;" name="dtanchor3xx" id="dtanchor3xx"><img border="0" src="images/calendar.jpg"></a>
					</td>
					<td width="30px">
					</td>
					<td>
						<input type="submit" name="btntool" id="btntool" value="Search" />
					</td>
				</tr>
			</table>
		</form>
		<table cellSpacing="1" cellPadding="1" border="0" class="datatable" width="1300px">
			<tr vAlign="center">
				<td colspan="6">&nbsp;</td>
			</tr>
			<?php if (isset($_REQUEST["date_from"]) || isset($_REQUEST["date_to"])) {
				$sorturl = htmlentities(
					$_SERVER["PHP_SELF"] .
						"?date_from=" .
						$_REQUEST["date_from"] .
						"&date_to=" .
						$_REQUEST["date_to"] .
						"&"
				);
			} else {
				$sorturl = htmlentities($_SERVER["PHP_SELF"] . "?");
			} ?>
			<tr>
				<td class="style17" align="center">
					<b>Sr. No</b>
				</td>
				<td class="style17" align="center">
					<b>Trans#</b>
					<a href="<?php echo $sorturl; ?>sk=wid&so=A"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;
					<a href="<?php echo $sorturl; ?>sk=wid&so=D"><img src="images/sort_desc.png" width="6px;" height="12px;"></a>
				</td>
				<td class="style17" align="center" width="150px">
					<b>Warehouse Name</b>
					<a href="<?php echo $sorturl; ?>sk=wname&so=A"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;
					<a href="<?php echo $sorturl; ?>sk=wname&so=D"><img src="images/sort_desc.png" width="6px;" height="12px;"></a>
				</td>
				<td class="style17" align="center" width="320px">
					<b>Company</b>
					<a href="<?php echo $sorturl; ?>sk=wh_name&so=A"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;
					<a href="<?php echo $sorturl; ?>sk=wh_name&so=D"><img src="images/sort_desc.png" width="6px;" height="12px;"></a>
				</td>
				<td class="style17" align="center">
					<b>Deadline</b>
					<a href="<?php echo $sorturl; ?>sk=dline&so=A"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;
					<a href="<?php echo $sorturl; ?>sk=dline&so=D"><img src="images/sort_desc.png" width="6px;" height="12px;"></a>
				</td>
				<td class="style17" align="center" width="300px">
					<b>Last Note</b>
					<a href="<?php echo $sorturl; ?>sk=lastn&so=A"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;
					<a href="<?php echo $sorturl; ?>sk=lastn&so=D"><img src="images/sort_desc.png" width="6px;" height="12px;"></a>
				</td>
				<td class="style17" align="center">
					<b>Last Note Date</b>
					<a href="<?php echo $sorturl; ?>sk=ldate&so=A"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;
					<a href="<?php echo $sorturl; ?>sk=ldate&so=D"><img src="images/sort_desc.png" width="6px;" height="12px;"></a>
				</td>
				<td class="style17" align="center"><b>Update</b></td>
				<td class="style17" align="center"><b>Processing Complete</b></td>
			</tr>
			<?php
			$emp_id = $_COOKIE["employeeid"];

			db();

			$time = strtotime(Date("Y-m-d"));

			$st_friday = $time;

			$st_friday_last = date("m/d/Y", strtotime("-6 days", $st_friday));

			$st_thursday_last = Date("m/d/Y");

			$in_dt_range = "no";

			if ($_REQUEST["date_from"] != "" && $_REQUEST["date_to"] != "") {
				$date_from_val = date("Y-m-d", strtotime($_REQUEST["date_from"]));

				$date_to_val_org = date(
					"Y-m-d 23:55:55",
					strtotime($_REQUEST["date_to"])
				);

				$date_to_val = date("Y-m-d 23:55:55", strtotime($_REQUEST["date_to"]));

				$in_dt_range = "yes";
			} else {
				$in_dt_range = "no";
			}

			//$special_order_status=" special_order_complete = 0 and ";

			$special_order_status = " ";

			if ($in_dt_range == "yes") {
				$special_order_status =
					" (loop_transaction_buyer.special_order_complete_date BETWEEN  '" .
					$date_from_val .
					"' and '" .
					$date_to_val .
					"') and special_order_complete = 1 and loop_transaction_buyer.needreprocessing = 1 AND loop_transaction_buyer.id > 67 group by loop_transaction_buyer.id order by reprocessingdeadline ASC";

				//
			} else {
				$special_order_status =
					" loop_transaction_buyer.shipped = 0 and special_order_complete = 0 and loop_transaction_buyer.needreprocessing = 1 AND loop_transaction_buyer.id > 67 group by loop_transaction_buyer.id order by reprocessingdeadline ASC";
			}

			db();
			$query =
				"select *, loop_transaction_buyer.id As wid from loop_transaction_buyer INNER JOIN loop_warehouse ON loop_transaction_buyer.warehouse_id = loop_warehouse.id INNER JOIN loop_salesorders ON loop_transaction_buyer.id = loop_salesorders.trans_rec_id where " .
				$special_order_status .
				"  ";

			$srno = 0;

			$res = db_query($query);
			$datarray = array();
			while ($rows = array_shift($res)) {

				$special_order_complete = $rows["special_order_complete"];

				$deadline_date = strtotime($rows["reprocessingdeadline"]);

				$rec_type = $rows["rec_type"];

				$todaydate = strtotime(date("m/d/Y"));

				$bgcolor = "#e4e4e4";

				if ($todaydate > $deadline_date && $special_order_complete == 0) {
					$bgclass = "special_order_red";
				} elseif ($special_order_complete == 1) {
					$bgclass = "special_order_green";
				} else {
					$bgclass = "special_order_normal";
				}

				db();

				$sql_translog =
					"SELECT message, date FROM loop_transaction_notes WHERE loop_transaction_notes.company_id = '" .
					$rows["warehouse_id"] .
					"' and loop_transaction_notes.rec_id = '" .
					$rows["wid"] .
					"' ORDER BY id DESC LIMIT 0,1";

				$result_translog = db_query($sql_translog);

				$lastnote_text = "";

				$last_note_date = "";

				while ($last_translog = array_shift($result_translog)) {
					$lastnote_text = $last_translog["message"];

					$last_note_date = $last_translog["date"];
				}

				$wharr = db_query(
					"Select *, loop_salesorders.notes AS A, loop_salesorders.pickup_date AS B, loop_salesorders.freight_vendor AS C, loop_salesorders.time AS D, loop_boxes.isbox AS I From loop_salesorders Inner Join loop_boxes ON loop_salesorders.box_id = loop_boxes.id WHERE trans_rec_id = '" .
						$rows["wid"] .
						"'"
				);

				$whrarr = array_shift($wharr);

				$sql = db_query(
					"Select * from loop_warehouse where id = '" .
						$whrarr["location_warehouse_id"] .
						"'"
				);

				$sqlarr = array_shift($sql);

				$datarray[] = [
					"wid" => $rows["wid"],
					"b2bid" => $rows["b2bid"],
					"wh_id" => $rows["warehouse_id"],
					"rcol" => $bgclass,

					"wh_name" => $rows["warehouse_name"],
					"dline" => $rows["reprocessingdeadline"],

					"rec_type" => $rows["rec_type"],
					"wname" => $sqlarr["warehouse_name"],
					"wcity" => $sqlarr["warehouse_city"],

					"pl_print" => $rows["picklist_print"],
					"lastn" => $lastnote_text,
					"ldate" => $last_note_date,

					"soc" => $special_order_complete,
					"socd" => $rows["special_order_complete_date"],
				];
			} //while loop closed

			if (!empty($_REQUEST["sk"]) && !empty($_REQUEST["so"])) {
				$key = $_REQUEST["sk"];

				$sortarray_key = [];

				foreach ($datarray as $tmparray) {
					$sortarray_key[] = $tmparray[$key];
				}

				if ($_REQUEST["so"] == "A") {
					array_multisort($sortarray_key, SORT_ASC, SORT_REGULAR, $datarray);
				} else {
					array_multisort($sortarray_key, SORT_DESC, SORT_REGULAR, $datarray);
				}

				$arraynew = $datarray;
			} else {
				$arraynew = $datarray;
			}

			foreach ($arraynew as $showdata) { ?>
				<tr class="<?php echo $showdata["rcol"]; ?>" id="so<?php echo $showdata["wid"]; ?>">
					<td class="style12center" align="center"><?php echo ++$srno; ?></td>
					<td class="style12center" align="center">
						<a href="viewCompany.php?ID=<?php echo $showdata["b2bid"]; ?>&show=transactions&warehouse_id=<?php echo $showdata["wh_id"]; ?>&rec_type=Supplier&proc=View&searchcrit=&id=<?php echo $showdata["wh_id"]; ?>&rec_id=<?php echo $showdata["wid"]; ?>&display=buyer_view" target="_blank"><?php echo $showdata["wid"]; ?></a>
					</td>
					<td class="style12center" align="center">
						<?php echo $showdata["wname"]; ?>
					</td>
					<td class="style12left" align="left">
						<span class="so_infotxt">
							<a href="viewCompany.php?ID=<?php echo $showdata["b2bid"]; ?>&show=transactions&warehouse_id=<?php echo $showdata["wh_id"]; ?>&rec_type=Supplier&proc=View&searchcrit=&id=<?php echo $showdata["wh_id"]; ?>&rec_id=<?php echo $showdata["wid"]; ?>&display=buyer_view" target="_blank"> <?php echo $showdata["wh_name"]; ?></a>
							<!--Display sales order popup on hover-->
							<span style="width:570px;">
								<table cellSpacing="0" cellPadding="1" border="0" width="570">
									<tr align="middle">
										<td class="style7" colspan="3" style="height: 16px"><strong>SALE ORDER DETAILS FOR ORDER ID: <?php echo $showdata["wid"]; ?></strong></td>
									</tr>
									<tr vAlign="center">
										<td bgColor="#e4e4e4" width="70" class="style17">
											<font size=1><strong>QTY</strong></font>
										</td>
										<td bgColor="#e4e4e4" width="300" class="style17">
											<font size=1><strong>Box Description</strong></font>
										</td>
										<td bgColor="#e4e4e4" width="200" class="style17">
											<font size=1><strong>Notes</strong></font>
										</td>
									</tr>
									<?php
									db();
									$get_sales_order = db_query(
										"Select *, loop_salesorders.notes AS A, loop_salesorders.pickup_date AS B, loop_salesorders.freight_vendor AS C, loop_salesorders.time AS D, loop_boxes.isbox AS I From loop_salesorders Inner Join loop_boxes ON loop_salesorders.box_id = loop_boxes.id WHERE trans_rec_id = '" .
											$showdata["wid"] .
											"'"
									);

									while ($boxes = array_shift($get_sales_order)) {

										$so_notes = $boxes["A"];

										$so_pickup_date = $boxes["B"];

										$so_freight_vendor = $boxes["C"];

										$so_time = $boxes["D"];
									?>
										<tr bgColor="#e4e4e4">
											<td height="13" class="style1" align="right">
												<font Face='arial' size='1'><?php echo $boxes["qty"]; ?></font>
											</td>
											<td align="left" height="13" class="style1">
												<?php if ($boxes["I"] == "Y") { ?>
													<font size="1" Face="arial"><?php echo $boxes["blength"]; ?> <?php echo $boxes["blength_frac"]; ?> x <?php echo $boxes["bwidth"]; ?> <?php echo $boxes["bwidth_frac"]; ?> x <?php echo $boxes["bdepth"]; ?> <?php echo $boxes["bdepth_frac"]; ?> <?php echo $boxes["bdescription"]; ?></font>
												<?php } else { ?>
													<font size="1" Face="arial"><?php echo $boxes["bdescription"]; ?></font>
												<?php } ?>
											</td>
											<td height="13" class="style1" align="left">
												<Font Face='arial' size='1'><?php echo $so_notes; ?>
											</td>
										</tr>
									<?php
									} //End while

									$soqry =
										"Select * From loop_salesorders_manual WHERE trans_rec_id = '" .
										$showdata["wid"] .
										"'";

									$get_sales_order2 = db_query($soqry);

									while ($boxes2 = array_shift($get_sales_order2)) { ?>
										<tr bgColor="#e4e4e4">
											<td height="13" class="style1" align="right">
												<Font Face='arial' size='1'><?php echo $boxes2["qty"]; ?>
											</td>
											<td height="13" class="style1" align="right">&nbsp;</td>
											<td align="left" height="13" style="width: 578px" class="style1" colspan=2>
												<font size="1" Face="arial">&nbsp;&nbsp;<?php echo $boxes2["description"]; ?></font>
											</td>
										</tr>
									<?php }
									//end while
									?>
								</table>
							</span>
							<!--End display sales order popup on hover-->
						</span>
					</td>
					<td class="style12center" align="left">
						<?php
						if ($showdata["dline"] == "NULL" || $showdata["dline"] == "") {
							$deadlinedate = "";
						} else {
							$deadlinedate = date("m/d/Y", strtotime($showdata["dline"]));
						}

						echo $deadlinedate;
						?>
						<input type="hidden" name="deadlinedate" id="deadlinedate<?php echo $showdata["wid"]; ?>" value="<?php echo $deadlinedate; ?>">
						<?php
						$pprint = "";
						if ($showdata["pl_print"] == "Y") {
							$pprint = "Re-Print Picklist";
						}

						if ($showdata["pl_print"] == "N") {
							$pprint = "";
						}

						if ($showdata["pl_print"] == "" || $showdata["pl_print"] == "null") {
							$pprint = "Print Picklist";
						}
						?>
						<input type="hidden" name="pprintdata" id="pprintdata<?php echo $showdata["wid"]; ?>" value="<?php echo $pprint; ?>">
					</td>
					<td class="style12left" align="left">
						<textarea name="last_note_so" id="last_note_so<?php echo $showdata["wid"]; ?>" style="width: 300px;"><?php echo $showdata["lastn"]; ?></textarea>
					</td>
					<td class="style12center" align="left">
						<div id="transdate_div<?php echo $showdata["wid"]; ?>">
							<?php echo $showdata["ldate"]; ?>
						</div>
					</td>
					<td class="style3" align="center">
						<input type="hidden" name="rect_type_so" id="rect_type_so<?php echo $showdata["wid"]; ?>" value="<?php echo $showdata["rec_type"]; ?>">
						<input type="button" name="update_so" id='update_so<?php echo $showdata["wid"]; ?>' onclick="update_so_note(<?php echo $showdata["wid"]; ?>,<?php echo $showdata["wh_id"]; ?>,<?php echo $emp_id; ?>); return false;" value="Update">
						<div id="transinfo<?php echo $showdata["wid"]; ?>"></div>
					</td>
					<td class="style3" align="center">
						<div id="complete_so_div<?php echo $showdata["wid"]; ?>">
							<?php
							if ($showdata["soc"] == 0) { ?>
								<input type="button" name="complete_so" id='complete_so<?php echo $showdata["wid"]; ?>' onclick="complete_specialorder_row(<?php echo $showdata["wid"]; ?>,<?php echo $showdata["wh_id"]; ?>,1); return false;" value="Complete">
							<?php }
							if ($showdata["soc"] == 1) { ?>
								Completed by
								<?php echo $_COOKIE["userinitials"]; ?><br>
								<?php echo $showdata["socd"]; ?><br>
								<input type="button" name="undo_complete_so" id='undo_complete_so<?php echo $showdata["wid"]; ?>' onclick="complete_specialorder_row(<?php echo $showdata["wid"]; ?>,<?php echo $showdata["wh_id"]; ?>,0); return false;" value="Undo">
							<?php }
							?>
						</div>
					</td>
					<section></section>
				</tr>
			<?php } // closed foreach
			ob_flush();
			?>
		</table>
	</div>
</body>

</html>