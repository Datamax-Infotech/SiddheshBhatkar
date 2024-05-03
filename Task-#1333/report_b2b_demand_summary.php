<?php
	require("inc/header_session.php");
	require("../mainfunctions/database.php");
	require("../mainfunctions/general-functions.php");
?>
<!doctype html>
<html>
	<head>

		<meta charset="utf-8">

		<title>B2B Demand Summary Report</title>

		<link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">

		<link rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>

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

				font-size: 13px;

				padding: 3px;

				font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;

				color: #333333;

			}

			.qty_freq_title {

				font-size: 14px;

				padding: 3px;

				font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;

				color: #000000;

				font-weight: 600;

			}

			.display_row {

				font-size: 11px;

				padding: 3px;

				font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;

				background: #EBEBEB;

			}

			.display_row a {

				color: #004CB3;

				font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;

			}

			.display_row_alt {

				font-size: 11px;

				padding: 3px;

				font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;

				background: #F7F7F7;

			}

			.display_row_alt a {

				color: #004CB3;

				font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;

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

			table.datatable tbody {

				margin-top: 24px;

			}

			table.datatable {

				/*border: 1px solid white;*/

			}

			table.datatable tr td,

			table.datatable tr th {

				height: 20px;

				border: 1px solid white;

				/*padding: 5px;*/

			}

			table.innertable {

				border-collapse: collapse;

				background: #FFF;

			}

			table.innertable tr td,

			table.innertable tr th {

				height: 20px;

				border: 1px solid white;

				padding: 5px;

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

		<script language="JavaScript" SRC="inc/CalendarPopup.js"></SCRIPT>
		<script language="JavaScript" SRC="inc/general.js"></SCRIPT>

		<script language="JavaScript">
			document.write(getCalendarStyles());
		</script>

		<script language="JavaScript">
			var cal2xx = new CalendarPopup("listdiv");

			cal2xx.showNavigationDropdowns();

			var cal3xx = new CalendarPopup("listdiv");

			cal3xx.showNavigationDropdowns();
		</script>

		<script language="JavaScript">
			
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

			function show_quote_table(quote_id, companyID, box_type) {

				var selectobject = document.getElementById("quote_ui" + quote_id);

				var n_left = f_getPosition(selectobject, 'Left');

				var n_top = f_getPosition(selectobject, 'Top');

				document.getElementById('light').style.left = n_left - 0 + 'px';

				document.getElementById('light').style.top = n_top + 10 + 'px';

				document.getElementById('light').style.width = 750 + 'px';

				document.getElementById('light').style.height = 700 + 'px';

				if (window.XMLHttpRequest)

				{ // code for IE7+, Firefox, Chrome, Opera, Safari

					xmlhttp = new XMLHttpRequest();

				} else

				{ // code for IE6, IE5

					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

				}

				xmlhttp.onreadystatechange = function()
				{

					if (xmlhttp.readyState == 4 && xmlhttp.status == 200)

					{

						document.getElementById("light").innerHTML = "<a href='javascript:void(0)' onclick=document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'>Close</a> &nbsp;<center></center>" + xmlhttp.responseText;

						document.getElementById('light').style.display = 'block';

					}
				}

				xmlhttp.open("POST", "b2b_demand_summary_entry_table.php?quote_id=" + quote_id + "&companyID=" + companyID + "&box_type=" + box_type + "&showquotedata=1", true);

				xmlhttp.send();
			}

			function show_all_quotes(quote_id, companyID) {

				var selectobject = document.getElementById("all_quote" + quote_id);

				var n_left = f_getPosition(selectobject, 'Left');

				var n_top = f_getPosition(selectobject, 'Top');

				document.getElementById('light').style.left = n_left - 0 + 'px';

				document.getElementById('light').style.top = n_top + 10 + 'px';

				document.getElementById('light').style.width = 920 + 'px';

				document.getElementById('light').style.height = 700 + 'px';

				document.getElementById('light').style.display = 'block';

				document.getElementById("light").innerHTML = "<br><br>Loading .....<img src='images/wait_animated.gif' />";

				if (window.XMLHttpRequest)

				{ // code for IE7+, Firefox, Chrome, Opera, Safari

					xmlhttp = new XMLHttpRequest();

				} else

				{ // code for IE6, IE5

					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

				}

				xmlhttp.onreadystatechange = function()

				{

					if (xmlhttp.readyState == 4 && xmlhttp.status == 200)

					{

						document.getElementById("light").innerHTML = "<a href='javascript:void(0)' onclick=document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'>Close</a> &nbsp;<center></center>" + xmlhttp.responseText;

						document.getElementById('light').style.display = 'block';

					}



				}

				xmlhttp.open("POST", "b2b_demand_summary_all_quotes.php?quote_id=" + quote_id + "&companyID=" + companyID + "&showallquotes=1", true);

				xmlhttp.send();

			}
		</script>
	</head>

	<style type="text/css">
		.main_data_css {

			margin: 0 auto;

			/*width: 100%;*/

			height: auto;

			clear: both !important;

			padding-top: 35px;

			margin-left: 10px;

			margin-right: 10px;

		}

		.search input {

			height: 24px !important;

		}

		h2.boxtitle {

			font-size: 20px;

			font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;

			margin-bottom: 4px;

			padding: 0px;

			color: #1E1E1E;

		}

		.style24 {

			font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif !important;

			font-size: 13px;

			background-color: #FF9900;

			color: #333333;

		}
	</style>

	<body>

			<?php include("inc/header.php"); ?>

			<div class="main_data_css">

				<div id="light" class="white_content"> </div>

				<div id="fade" class="black_overlay"></div>

				<div class="dashboard_heading" style="float: left;">

					<div style="float: left;">

						B2B Demand Summary Report

						<div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>

							<span class="tooltiptext">This report shows the user all demand entries that UCB has the opportunity sell to, regardless of whether we satiate that demand or not...and sections it by the most valuable demand entries to the least. Thus, this report helps the user see the most valuable demand entries UCB has in it's entire demand pipeline.</span>
						</div>

						<div style="height: 13px;">&nbsp;</div>

					</div>

				</div>

				<?php

					$time = strtotime(Date('Y-m-d'));

					$st_friday = $time;

					$st_friday_last = date('m/d/Y', strtotime('-6 days', $st_friday));

					$st_thursday_last = Date('m/d/Y');

					$in_dt_range = "no";

					if ($_REQUEST["date_from"] != "" && $_REQUEST["date_to"] != "") {

						$date_from_val = date("Y-m-d", strtotime($_REQUEST["date_from"]));

						$date_to_val_org = date("Y-m-d", strtotime($_REQUEST["date_to"]));

						$date_to_val = date("Y-m-d", strtotime($_REQUEST["date_to"]));

						$in_dt_range = "yes";

					} else {

						if (isset($_REQUEST["warehouse_id"]) || isset($_REQUEST["inv_id"])) {

							$in_dt_range = "no";

							$date_from_val = date("Y-01-01", strtotime($st_friday_last));

							$date_to_val_org = date("Y-m-d", strtotime($st_thursday_last));

							$date_to_val = date("Y-m-d", strtotime($st_thursday_last));
						} else {

							$in_dt_range = "no";

							$date_from_val = date("Y-m-d", strtotime($st_friday_last));

							$date_to_val_org = date("Y-m-d", strtotime($st_thursday_last));

							$date_to_val = date("Y-m-d", strtotime($st_thursday_last));
						}
					}

					if (strpos($_SERVER['HTTP_REFERER'], "dashboardnew_account_pipeline.php")) {

						$_REQUEST["employee"] = $_COOKIE['userinitials'];
					}
				?>

				<form method="post" name="inv_frm" action="report_b2b_demand_summary.php">

					<table border="0">

						<tr>

							<td>Employee</td>

							<td>

								<select id="employee" name="employee">

									<option value="~">All</option>

									<?php
										db_b2b();

										$getEmp = db_query("SELECT * FROM employees ORDER BY status ASC, name ASC");

										while ($rowsEmp = array_shift($getEmp)) {

									?>

										<option <?php if (isset($_REQUEST["employee"]) && $rowsEmp["initials"] == $_REQUEST["employee"]) echo " selected ";  ?> value="<?php echo $rowsEmp["initials"]; ?>"><?php if ($rowsEmp["status"] != 'Active') {
																																																	echo $rowsEmp["name"] . "(Inactive)";
																																																} else {
																																																	echo $rowsEmp["name"];
																																																} ?></option>

									<?php

									}

									?>

								</select>

							</td>

							<td>

								Type:

							</td>

							<td>

								<select id="box_type" name="box_type">

									<option <?php if ($_REQUEST["box_type"] == "All") { ?>selected="selected" <?php } ?> value="All">All</option>

									<option <?php if ($_REQUEST["box_type"] == "Gaylord Totes") { ?>selected="selected" <?php } ?>>Gaylord Totes</option>

									<option <?php if ($_REQUEST["box_type"] == "Shipping Boxes") { ?>selected="selected" <?php } ?>>Shipping Boxes</option>

									<option <?php if ($_REQUEST["box_type"] == "Pallets") { ?>selected="selected" <?php } ?>>Pallets</option>

									<option <?php if ($_REQUEST["box_type"] == "Supersacks") { ?>selected="selected" <?php } ?>>Supersacks</option>

									<option <?php if ($_REQUEST["box_type"] == "Other") { ?>selected="selected" <?php } ?>>Other</option>

								</select>

							</td>

							<td></td>

							<td><input type="submit" name="btntool" name="btntool" value="Submit" /></td>

						</tr>

					</table>

				</form>

				<br><br>

				<table cellSpacing="1" cellPadding="1" border="0" width="1400">

					<tr align="middle">

						<td colspan="12" class="style24" style="height: 16px"><strong>Demand Summary Report Notes</strong> <a href="update_demand_summ_v2_notes.php">Edit</a></td>

					</tr>

					<tr vAlign="left">

						<td colspan=12>

							<?php
							
								db();

								$sql = "SELECT * FROM loop_demand_summ_v2_notes ORDER BY dt DESC LIMIT 0,1";

								$res = db_query($sql);

								$row = array_shift($res);

								echo $row["notes"];

							?>

						</td>

					</tr>

				</table>

				<br>

				<?php if (isset($_REQUEST["btntool"])) { ?>

					<?php

						$box_type_cnt = 0;

						$gy = array();
						$sb = array();
						$pal = array();
						$sup = array();
						$other = array();

						$_SESSION['sortarraygy'] = "";
						$_SESSION['sortarraysb'] = "";
						$_SESSION['sortarraypal'] = "";
						$_SESSION['sortarraysup'] = "";
						$_SESSION['sortarrayother'] = "";

						$box_type_arry = array();

						if ($_REQUEST["box_type"] == "All") {

							$box_type_arry = array('Gaylord Totes', 'Shipping Boxes', 'Pallets', 'Supersacks', 'Other');
						} elseif ($_REQUEST["box_type"] == "Gaylord Totes") {

							$box_type_arry = array('Gaylord Totes');
						} elseif ($_REQUEST["box_type"] == "Shipping Boxes") {

							$box_type_arry = array('Shipping Boxes');
						} elseif ($_REQUEST["box_type"] == "Pallets") {

							$box_type_arry = array('Pallets');
						} elseif ($_REQUEST["box_type"] == "Supersacks") {

							$box_type_arry = array('Supersacks');
						} elseif ($_REQUEST["box_type"] == "Other") {

							$box_type_arry = array('Other');
						}

						foreach ($box_type_arry as $box_array) {

							$box_type = "";
							$box_type_title = "";
							$box_sub_type = "";
							$how_many_order_per_yr_order_str = "";

							if ($box_array == "Gaylord Totes") {

								$box_table = "quote_gaylord";

								$quantity_request = "g_quantity_request";

								$frequency_order = "g_frequency_order";

								$notes = "g_item_note";

								$prefix = "g";

								$box_type = "Gaylord";

								$box_type_title = "Gaylord Boxes";

								$box_sub_type = "g_item_sub_type";

								$how_many_order_per_yr_order_str = " order by g_how_many_order_per_yr desc";
							}

							if ($box_array == "Shipping Boxes") {

								$box_table = "quote_shipping_boxes";

								$quantity_request = "sb_quantity_requested";

								$frequency_order = "sb_frequency_order";

								$notes = "sb_notes";

								$prefix = "sb";

								$box_type = "";

								$box_type_title = "Shipping Boxes";

								$how_many_order_per_yr_order_str = " order by sb_how_many_order_per_yr desc";
							}

							if ($box_array == "Pallets") {

								$box_table = "quote_pallets";

								$quantity_request = "pal_quantity_requested";

								$frequency_order = "pal_frequency_order";

								$notes = "pal_note";

								$prefix = "pal";

								$box_type = "Pallets";

								$box_type_title = "Pallets";

								$box_sub_type = "pal_item_sub_type";

								$how_many_order_per_yr_order_str = " order by pal_how_many_order_per_yr desc";
							}

							if ($box_array == "Supersacks") {

								$box_table = "quote_supersacks";

								$quantity_request = "sup_quantity_requested";

								$frequency_order = "sup_frequency_order";

								$notes = "sup_notes";

								$box_type_title = "Supersacks";

								$prefix = "sup";
							}

							if ($box_array == "Other") {

								$box_table = "quote_other";

								$quantity_request = "other_quantity_requested";

								$frequency_order = "other_frequency_order";

								$notes = "other_note";

								$prefix = "other";

								$box_type_title = "Other";
							}

							$box_type_cnt = $box_type_cnt + 1;

					?>

					<table cellSpacing="0" cellPadding="1" border="0" class="datatable" width="1400px">

							<?php
								
								$qty_cnt = 0;
								$subtype_list = "";

								$subtype_arry = array();
								$subtype_child_array = array();

								$q1 = '';

								$subtype_arry[] = 'High Value Opportunity';

								if ($box_type != "") {
									
									db();

									$q1 = "SELECT unqid FROM loop_boxes_sub_type_master where box_type = '" . $box_type . "' and active_flg = 1 ORDER BY display_order ASC";

									$query = db_query($q1);

									while ($fetch = array_shift($query)) {

										$subtype_list .= $fetch['unqid'] . ",";

										$subtype_arry[] = $fetch['unqid'];
									}

									if ($subtype_list != "") {

										$subtype_list = substr($subtype_list, 0, strlen($subtype_list) - 1);
									}
								}

								if ($subtype_list == "") {

									$subtype_arry[] = 'empty';
								}

								foreach ($subtype_arry as $subtype_child_array) {

									$show_done = "no";

									$qty_cnt = $qty_cnt + 1;

									if ($qty_cnt == 1) {

										$bgcolor = "#98bcdf";
									}

									if ($qty_cnt == 2) {

										$bgcolor = "#d3f1c9";
									}

									if ($qty_cnt == 3) {

										$bgcolor = "#d9d1e9";
									}

									if ($qty_cnt == 4) {

										$bgcolor = "#f4cccc";
									}

									$show = 0;

									if ($subtype_child_array == "empty") {

										$bqry = "SELECT * FROM quote_request INNER JOIN $box_table ON quote_request.quote_id = $box_table.quote_id $how_many_order_per_yr_order_str";
									} else if ($subtype_child_array == "High Value Opportunity") {

										$bqry = "SELECT * FROM quote_request INNER JOIN $box_table ON quote_request.quote_id = $box_table.quote_id where high_value_target = 1 $how_many_order_per_yr_order_str";
									} else {

										if ($box_type == "") {

											$bqry = "SELECT * FROM quote_request INNER JOIN $box_table ON quote_request.quote_id = $box_table.quote_id $how_many_order_per_yr_order_str";
										} else {

											$bqry = "SELECT * FROM quote_request INNER JOIN $box_table ON quote_request.quote_id = $box_table.quote_id WHERE $box_sub_type ='" . $subtype_child_array . "' $how_many_order_per_yr_order_str";
										}
									}

									if ($subtype_child_array == "empty") {

										$subtype_child_name = "";
									} else if ($subtype_child_array == "High Value Opportunity") {

										$subtype_child_name = "High Value Opportunity";
									} else {

										if ($box_table == "quote_gaylord" || $box_table == "quote_shipping_boxes" || $box_table == "quote_pallets") {
											
											db();

											$q1 = "SELECT sub_type_name FROM loop_boxes_sub_type_master where unqid = '" . $subtype_child_array . "'";

											$query = db_query($q1);

											while ($fetch = array_shift($query)) {

												$subtype_child_name = $fetch['sub_type_name'];
											}
										}
									}
									db();
									$bres = db_query($bqry);

									$srno = 0;

									$bgcolor = "";
									$num_rows = tep_db_num_rows($bres);

									if ($num_rows > 0) {

										$display_data = "yes";

										$display_heading = "yes";

										$show = 1;
									}

									if ($show == 1 && $show_done == "no") {

							?>

									<tr>

										<td align="left">
											<h2 class="boxtitle"><?php echo $box_array; ?> <?php if ($subtype_child_name != "") {
																							echo " - <span style='color:#f29e00;'>" . $subtype_child_name;
																						} ?></span></h2>
										</td>

									</tr>

								<?php

									$show = 0;

									$show_done = "yes";

									$display_heading = '';
								}



								if ($display_heading == "yes") {

									$display_heading = "no";

								?>

									<tr>

										<?php if ($subtype_child_name == "") { ?>

											<td class="qty_freq_title" bgcolor="<?php echo $bgcolor; ?>" align="center">Orders <?php echo $box_type_title; ?></td>

										<?php } else { ?>

											<td class="qty_freq_title" bgcolor="<?php echo $bgcolor; ?>" align="center">Orders <?php echo $subtype_child_name; ?></td>

										<?php } ?>

									</tr>

									<tr>
										<td>
											<table cellpadding="3" cellspacing="1" width="100%" class="innertable">

												<tr>

													<td class="style17" bgcolor="<?php echo $bgcolor; ?>" align="center">

														<b>Sr. No</b>
													</td>

													<td class="style17" bgcolor="<?php echo $bgcolor; ?>" align="center">

														<b>Demand Entry ID</b>
													</td>

													<td class="style17" bgcolor="<?php echo $bgcolor; ?>" align="center">

														<b>Demand Entry Date</b>
													</td>

													<td class="style17" bgcolor="<?php echo $bgcolor; ?>" align="center">

														<b>Company Name</b>
													</td>

													<td class="style17" bgcolor="<?php echo $bgcolor; ?>" align="center">

														<b>Territory</b>
													</td>

													<td class="style17" bgcolor="<?php echo $bgcolor; ?>" align="center">

														<b>Rep</b>
													</td>

													<td class="style17" bgcolor="<?php echo $bgcolor; ?>" align="center">

														<b>Sub Type</b>
													</td>

													<td class="style17" bgcolor="<?php echo $bgcolor; ?>" align="center">

														<b>Annual Appetite</b>
													</td>

													<td class="style17" bgcolor="<?php echo $bgcolor; ?>" align="center">

														<b>Desired Price</b>
													</td>

													<td class="style17" bgcolor="<?php echo $bgcolor; ?>" align="center">

														<b>What Used For</b>
													</td>

													<td class="style17" bgcolor="<?php echo $bgcolor; ?>" align="center">

														<b>Also Needs Pallets</b>
													</td>

													<td class="style17" bgcolor="<?php echo $bgcolor; ?>" align="center">

														<b>Notes</b>
													</td>

												</tr>

												<?php

											}

											while ($brow = array_shift($bres)) {

												if ($State_where_main != "") {

													db_b2b();

													$comp_qry = "Select ID from companyInfo where ID = '" . $brow["companyID"] . "' " . $State_where_main;

													$comp_res = db_query($comp_qry);

													$comp_num_rows = tep_db_num_rows($comp_res);

													db();
												} else {

													$comp_num_rows = 1;
												}

												if ($comp_num_rows > 0) {

													if ($row_cnt == 0) {

														$display_row_css = "display_row";

														$row_cnt = 1;
													} else {

														$row_cnt = 0;

														$display_row_css = "display_row_alt";
													}

													$srno = $srno + 1;

													$company_name = get_nickname_val('', $brow["companyID"]);
													
													db_b2b();

													$query_comp = db_query("SELECT territory, employees.initials as empname, last_contact_date, employees.employeeID FROM companyInfo left join employees on employees.employeeID= companyInfo.assignedto where ID = '" . $brow["companyID"] . "'");

													$row_comp = array_shift($query_comp);

													$acc_owner = $row_comp["empname"];

													$acc_ownerid = $row_comp["employeeID"];

													$subtype = "";

													if ($box_table == "quote_gaylord" || $box_table == "quote_pallets") {

														if ($box_table == "quote_gaylord") {

															$q1 = "SELECT sub_type_name FROM loop_boxes_sub_type_master where unqid = '" . $brow["g_item_sub_type"]  . "'";
														}

														if ($box_table == "quote_pallets") {

															$q1 = "SELECT sub_type_name FROM loop_boxes_sub_type_master where unqid = '" . $brow["pal_item_sub_type"]  . "'";
														}

														db();
														$query = db_query($q1);

														while ($fetch = array_shift($query)) {

															$subtype = $fetch['sub_type_name'];
														}
													}

													$how_many_order_per_yr = "";

													if ($box_table == "quote_gaylord") {

														$how_many_order_per_yr = $brow["g_how_many_order_per_yr"];
													}

													if ($box_table == "quote_shipping_boxes") {

														$how_many_order_per_yr = $brow["sb_how_many_order_per_yr"];
													}

													if ($box_table == "quote_pallets") {

														$how_many_order_per_yr = $brow["pal_how_many_order_per_yr"];
													}

													if ($display_data == "yes") {

														if (isset($_REQUEST["employee"]) && $_REQUEST["employee"] == '~') {

												?>

															<tr>

																<td class="<?php echo $display_row_css; ?>" align="center">

																	<a href='#' id='all_quote<?php echo $brow['quote_id'] ?>' onclick="show_all_quotes(<?php echo $brow['quote_id'] ?>,<?php echo $brow["companyID"] ?>); return false;"><?php echo $srno; ?></a>
																</td>

																<td class="<?php echo $display_row_css; ?>" align="left">

																	<a href='#' id='quote_ui<?php echo $brow['quote_id'] ?>' onclick="show_quote_table(<?php echo $brow['quote_id'] ?>, <?php echo $brow["companyID"] ?>, '<?php echo $box_array; ?>'); return false;"><?php echo $brow["quote_id"]; ?></a>

																</td>

																<td class="<?php echo $display_row_css; ?>" align="left">

																	<?php echo date("m/d/Y", strtotime($brow["quote_date"])); ?></td>

																<td class="<?php echo $display_row_css; ?>" align="left">

																	<a href="viewCompany.php?ID=<?php echo $brow["companyID"]; ?>" target="_blank">

																		<?php echo $company_name; ?>

																	</a>

																</td>

																<td class="<?php echo $display_row_css; ?>" align="left">

																	<?php echo $row_comp["territory"]; ?></td>



																<td class="<?php echo $display_row_css; ?>" align="left">

																	<?php echo $acc_owner; ?></td>



																<td class="<?php echo $display_row_css; ?>" align="left">

																	<?php echo $subtype; ?></td>


																<td class="<?php echo $display_row_css; ?>" align="left" width="50px">

																	<?php echo number_format($how_many_order_per_yr, 0); ?></td>



																<td class="<?php echo $display_row_css; ?>" align="right">

																	<?php

																	if ($box_array == "Gaylord Totes") {

																		$desired_price = $brow["sales_desired_price_" . $prefix];
																	} else {

																		$desired_price = $brow[$prefix . "_sales_desired_price"];
																	}

																	if ($desired_price != "") {

																		echo "$" . number_format($desired_price, 2);
																	} else {

																		echo "$0";
																	}

																	?></td>

																<td class="<?php echo $display_row_css; ?>" align="left">

																	<?php echo $brow[$prefix . "_what_used_for"]; ?></td>

																<td class="<?php echo $display_row_css; ?>" align="center">

																	<?php

																	if ($box_array == "Gaylord Totes") {

																		$need_pallets = $brow["need_pallets"];
																	} else {

																		$need_pallets = $brow[$prefix . "need_pallets"];
																	}

																	echo $need_pallets;

																	?></td>

																<td class="<?php echo $display_row_css; ?>" align="left" width="350px">

																	<?php echo $brow[$notes]; ?></td>

															</tr>

															<?php

														} else {

															if (isset($_REQUEST["employee"]) && $_REQUEST["employee"] == $acc_owner) {

															?>

																<tr>

																	<td class="<?php echo $display_row_css; ?>" align="center">

																		<a href='#' id='all_quote<?php echo $brow['quote_id'] ?>' onclick="show_all_quotes(<?php echo $brow['quote_id'] ?>,<?php echo $brow["companyID"] ?>); return false;"><?php echo $srno; ?></a>
																	</td>

																	<td class="<?php echo $display_row_css; ?>" align="left">

																		<a href='#' id='quote_ui<?php echo $brow['quote_id'] ?>' onclick="show_quote_table(<?php echo $brow['quote_id'] ?>, <?php echo $brow["companyID"] ?>, '<?php echo $box_array; ?>'); return false;"><?php echo $brow["quote_id"]; ?></a>

																	</td>

																	<td class="<?php echo $display_row_css; ?>" align="left">

																		<?php echo date("m/d/Y", strtotime($brow["quote_date"])); ?></td>

																	<td class="<?php echo $display_row_css; ?>" align="left">

																		<a href="viewCompany.php?ID=<?php echo $brow["companyID"]; ?>" target="_blank">

																			<?php echo $company_name; ?>

																		</a>

																	</td>

																	<td class="<?php echo $display_row_css; ?>" align="left">

																		<?php echo $row_comp["territory"]; ?></td>

																	<td class="<?php echo $display_row_css; ?>" align="left">

																		<?php echo $acc_owner; ?></td>



																	<td class="<?php echo $display_row_css; ?>" align="left">

																		<?php echo $subtype; ?></td>

																	<td class="<?php echo $display_row_css; ?>" align="left" width="50px">

																		<?php echo number_format($how_many_order_per_yr, 0); ?></td>



																	<td class="<?php echo $display_row_css; ?>" align="right">

																		<?php

																		if ($box_array == "Gaylord Totes") {

																			$desired_price = $brow["sales_desired_price_" . $prefix];
																		} else {

																			$desired_price = $brow[$prefix . "_sales_desired_price"];
																		}



																		if ($desired_price != "") {

																			echo "$" . number_format($desired_price, 2);
																		} else {

																			echo "$0";
																		}

																		?></td>

																	<td class="<?php echo $display_row_css; ?>" align="left">

																		<?php echo $brow[$prefix . "_what_used_for"]; ?></td>

																	<td class="<?php echo $display_row_css; ?>" align="center">

																		<?php

																		if ($box_array == "Gaylord Totes") {

																			$need_pallets = $brow["need_pallets"];
																		} else {

																			$need_pallets = $brow[$prefix . "need_pallets"];
																		}

																		echo $need_pallets;

																		?></td>

																	<td class="<?php echo $display_row_css; ?>" align="left" width="350px">

																		<?php echo $brow[$notes]; ?></td>

																</tr>

														<?php

															}
														}

														?>

												<?php

														if ($box_type_cnt == 1) {

															$gy[] = array('companyID' => $brow["companyID"], 'acc_owner' => $acc_owner, 'quote_id' => $brow["quote_id"], 'box_size' => $brow[$prefix . "_item_length"] . "x" . $brow[$prefix . "_item_width"] . "x" . $brow[$prefix . "_item_height"], 'territory' => $territory, 'box_l' => $box_l, 'quote_date' => $brow["quote_date"], 'company_name' => $company_name, 'quantity_request' => $brow["$quantity_request"], 'frequency_order' => $brow["$frequency_order"], 'desired_price' => $desired_price, 'what_used_for' => $brow[$prefix . "_what_used_for"], 'need_pallets' => $need_pallets, 'notes' => $brow[$notes], 'qty_array' => $subtype_child_array);
														}

														if ($box_type_cnt == 1) {

															$gy[] = array('companyID' => $brow["companyID"], 'acc_owner' => $acc_owner, 'quote_id' => $brow["quote_id"], 'box_size' => $brow[$prefix . "_item_length"] . "x" . $brow[$prefix . "_item_width"] . "x" . $brow[$prefix . "_item_height"], 'territory' => $territory, 'box_l' => $box_l, 'quote_date' => $brow["quote_date"], 'company_name' => $company_name, 'quantity_request' => $brow["$quantity_request"], 'frequency_order' => $brow["$frequency_order"], 'desired_price' => $desired_price, 'what_used_for' => $brow[$prefix . "_what_used_for"], 'need_pallets' => $need_pallets, 'notes' => $brow[$notes], 'qty_array' => $subtype_child_array);
														}

														//

													}
												}
											}
											$display_data = '';
											if ($display_data == "yes") {

												?>



												<tr>
													<td colspan="12" height="18px"></td>
												</tr>

											</table>
										</td>
									</tr>

							<?php

											}



											$display_data = "no";
										} //End foreach  subtype_arry

							?>

						</table>

					<?php

					}

					//End foreach  box_type_arry

					?>

				<?php

				} //End if btntool

				?>

			</div>
	</body>
</html>