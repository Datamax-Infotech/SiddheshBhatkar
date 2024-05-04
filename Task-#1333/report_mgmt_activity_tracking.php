<?php
	require ("inc/header_session.php");
	require ("../mainfunctions/database.php");
	require ("../mainfunctions/general-functions.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Contact Activity Summary Report - UCB Sales Review Report</title>
		<link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet"> 
		<link rel='stylesheet' type='text/css' href='css/ucb_common_style.css' >
		<meta http-equiv="refresh" content="1800" />	
		<link rel="stylesheet" href="sorter/style_rep.css" />
		<style type="text/css">

			.txtstyle_color

			{

			font-family:arial;

			font-size:12;

			height: 16px; 

			background:#ABC5DF;

			}



			.txtstyle

			{

				font-family:arial;

				font-size:12;

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



				span.infotxt:hover {text-decoration: none; background: #ffffff; z-index: 6; }

				span.infotxt span {position: absolute; left: -9999px; margin: 20px 0 0 0px; padding: 3px 3px 3px 3px; z-index: 6;}

				span.infotxt:hover span {left: 45%; background: #ffffff;} 

				span.infotxt span {position: absolute; left: -9999px; margin: 0px 0 0 0px; padding: 3px 3px 3px 3px; border-style:solid; border-color:black; border-width:1px;}

				span.infotxt:hover span {margin: 18px 0 0 170px; background: #ffffff; z-index:6;} 

				

				span.infotxt_freight:hover {text-decoration: none; background: #ffffff; z-index: 6; }

				span.infotxt_freight span {position: absolute; left: -9999px; margin: 20px 0 0 0px; padding: 3px 3px 3px 3px; z-index: 6;}

				span.infotxt_freight:hover span {left: 0%; background: #ffffff;} 

				span.infotxt_freight span {position: absolute; width:850px; overflow:auto; height:300px; left: -9999px; margin: 0px 0 0 0px; padding: 10px 10px 10px 10px; border-style:solid; border-color:white; border-width:50px;}

				span.infotxt_freight:hover span {margin: 5px 0 0 50px; background: #ffffff; z-index:6;} 

				

				span.infotxt_freight2:hover {text-decoration: none; background: #ffffff; z-index: 6; }

				span.infotxt_freight2 span {position: absolute; left: -9999px; margin: 20px 0 0 0px; padding: 3px 3px 3px 3px; z-index: 6;}

				span.infotxt_freight2:hover span {left: 0%; background: #ffffff;} 

				span.infotxt_freight2 span {position: absolute; width:850px; overflow:auto; height:300px; left: -9999px; margin: 0px 0 0 0px; padding: 10px 10px 10px 10px; border-style:solid; border-color:white; border-width:50px;}

				span.infotxt_freight2:hover span {margin: 5px 0 0 500px; background: #ffffff; z-index:6;} 



				.black_overlay{

					display: none;

					position: absolute;

				}

				.white_content {

					display: none;

					position: absolute;

					padding: 5px;

					border: 2px solid black;

					background-color: white;

					overflow:auto;

					height:600px;

					width:850px;

					z-index:1002;

					margin: 0px 0 0 0px; 

					padding: 10px 10px 10px 10px;

					border-color:black; 

					border-width:2px;

					overflow: auto;

				}

		</style>	
		<script type="text/javascript" src="sorter/jquery-latest.js"></script>
		<script type="text/javascript" src="sorter/jquery.tablesorter.js"></script>
		<script language="JavaScript" SRC="inc/CalendarPopup.js"></script><script language="JavaScript" SRC="inc/general.js"></SCRIPT>
		<script language="JavaScript">document.write(getCalendarStyles());</script>
		<script language="JavaScript">
			var cal2xx = new CalendarPopup("listdiv");

			cal2xx.showNavigationDropdowns();

			function loadmainpg() 
			{

				if(document.getElementById('date_from').value !="" && document.getElementById('date_to').value !="")

				{

					//document.frmactive.action = "adminpg.php";

				}

				else

				{

					alert("Please select date From/To.");

					return false;

				}

			}

			

			function load_div(id){

				//var gpos = getAbsPosition(document.getElementById(id)); 			

				var element = document.getElementById(id); //replace elementId with your element's Id.

				var rect = element.getBoundingClientRect();

				var elementLeft,elementTop; //x and y

				var scrollTop = document.documentElement.scrollTop?

								document.documentElement.scrollTop:document.body.scrollTop;

				var scrollLeft = document.documentElement.scrollLeft?                   

								document.documentElement.scrollLeft:document.body.scrollLeft;

				elementTop = rect.top+scrollTop;

				elementLeft = rect.left+scrollLeft;


				document.getElementById("light").innerHTML = document.getElementById(id).innerHTML;

				document.getElementById('light').style.display='block';

				document.getElementById('fade').style.display='block';

				document.getElementById('light').style.left='100px';

				document.getElementById('light').style.top=elementTop + 100 + 'px';

			}

			function close_div(){

				document.getElementById('light').style.display='none';

			}

		</script>
	</head>
	<body>

		<?php include("inc/header.php"); ?>

		<div id="light" class="white_content">

		</div>

		<div id="fade" class="black_overlay"></div>

		<div class="main_data_css">



	<div class="dashboard_heading" style="float: left;">

		<div style="float: left;">

			Contact Activity Summary Report 

		

		<div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>

		<span class="tooltiptext">This report shows the user all of the contact activity made by each B2B sales rep.</span></div><br>

		</div>

	</div>

	<form method="get" name="rpt_leaderboard" action="report_mgmt_activity_tracking.php">

		<table border="0">

			<tr>

				<td>Date Range Selector:</td>

				<td>

						From: 

							<input type="text" name="date_from" id="date_from" size="10" value="<?php echo isset($_GET['date_from']) ? $_GET['date_from'] : ''; ?>" > 

							<a href="#" onclick="cal2xx.select(document.rpt_leaderboard.date_from,'dtanchor2xx','MM/dd/yyyy'); return false;" name="dtanchor2xx" id="dtanchor2xx"><img border="0" src="images/calendar.jpg"></a>

							<div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>		

						To: 

							<input type="text" name="date_to" id="date_to" size="10" value="<?php echo isset($_GET['date_to']) ? $_GET['date_to'] : ''; ?>" > 

							<a href="#" onclick="cal2xx.select(document.rpt_leaderboard.date_to,'dtanchor3xx','MM/dd/yyyy'); return false;" name="dtanchor3xx" id="dtanchor3xx"><img border="0" src="images/calendar.jpg"></a>

							<div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>		

				</td>

				<td>

					<input type=submit value="Run Report">

				</td>

			</tr>

		</table>

	</form>

			

	<table border="0" >

		<tr><td style="font-size:16pt;" colspan="3"><strong>Activity Tracking</strong></td></tr>

		<tr>

			<td  valign="top">

				<?php 

				$contact_act_30 = 0;$contact_act_7 = 0;$contact_act_y = 0;$contact_act_t = 0;

				$contact_act_ph_30 = 0;$contact_act_ph_7 = 0;$contact_act_ph_y = 0;$contact_act_ph_t = 0;

				$quotes_sent_30 = 0;$quotes_sent_7 = 0;$quotes_sent_y = 0;$quotes_sent_t = 0;

				$lead_30 = 0;$lead_7 = 0; $lead_y = 0; $lead_t = 0;

				$quote_requests_30 = 0;$quote_requests_7 = 0;$quote_requests_y = 0;$quote_requests_t = 0;

				$demand_entries_30 = 0; $demand_entries_7 = 0; $demand_entries_y = 0; $demand_entries_t = 0;

				$fst_time_cust_30 = 0;$fst_time_cust_7 = 0;$fst_time_cust_y = 0;$fst_time_cust_t = 0;

				

				$tot30 = 0; $tot7 = 0; $toty = 0; $totT = 0;

				

				db_b2b();

				

				if (isset($_REQUEST["date_from"])){

					$date_from = date("Y-m-d", strtotime($_REQUEST["date_from"]));

					$date_to = date("Y-m-d", strtotime($_REQUEST["date_to"]));

				?>

					<table cellSpacing="1" cellPadding="1" border="0" width="700" id="table14" class="tablesorter">

					<thead>

						<tr>

							<th width='100px' bgColor='#ABC5DF'><u>Employee</u></th>

							<th width='200px' bgColor='#ABC5DF'>&nbsp;</th>

							<th width='60px' bgColor='#ABC5DF' align="center"><u><?php echo $_REQUEST["date_from"] . " - " . $_REQUEST["date_to"]; ?></u></th>

						</tr>

					</thead>

					<tbody>

				

				<?php

					//in date range

					//$sql = "SELECT id, b2b_id ,name, initials as EMPLOYEE, email FROM loop_employees WHERE status = 'Active' and activity_tracker_flg = 1 ORDER BY quota DESC";

					if(isset($_REQUEST["pallet_flg"]) && $_REQUEST["pallet_flg"] == "yes"){

						$sql = "SELECT id, b2b_id ,name, initials as EMPLOYEE, email FROM loop_employees WHERE status = 'Active' and (activity_tracker_flg_pallet = 1 OR activity_tracker_flg_purchasing_pallet = 1) ORDER BY quota DESC";

					}else{

						$sql = "SELECT id, b2b_id ,name, initials as EMPLOYEE, email FROM loop_employees WHERE status = 'Active' and (activity_tracker_flg = 1 OR activity_tracker_flg_purchasing = 1) ORDER BY quota DESC";

					}						

					db();

					$result = db_query($sql);

					while ($rowemp = array_shift($result)) {

						$sqlT = "SELECT ID, type, EmailID FROM CRM WHERE duplicate_added_by_system = 0 and type in ('phone', 'email') and EMPLOYEE LIKE '" . $rowemp["EMPLOYEE"] . "' AND timestamp between '" . $date_from . "' and '" . $date_to . "'";
						db_b2b();
						$result_crm = db_query($sqlT);

						$contact_act_tmp = 0; $eml_list =""; $contact_act_ph1 = 0;

						while ($rowemp_crm = array_shift($result_crm)) {

							if ($rowemp_crm["type"] == "phone"){

								$contact_act_ph1 = $contact_act_ph1 + 1 ;

							}	

							if ($rowemp_crm["type"] ==  "email"){

								$contact_act_tmp = $contact_act_tmp + 1 ;

							}	

							

							$eml_list .= $rowemp_crm["EmailID"] . ", ";

						}

						

						$result_crm = db_query("Select count(unqid) as cnt from tblemail where emaildate between '" . $date_from . "' and '" . $date_to . "' and fromadd = '" . $rowemp["email"] . "'", db_email() );

						while ($rowemp_crm = array_shift($result_crm)) {

							$contact_act_tmp = $contact_act_tmp + $rowemp_crm["cnt"] ;

						}

						

						$contact_act_t = $contact_act_tmp;

						//$contact_act_ph_t = $contact_act_ph1;



						$b2bempid = 0;

						$sql = "SELECT employeeID FROM employees where employeeID = " . $rowemp["b2b_id"];
						db_b2b();
						$result_t = db_query($sql);

						while ($rowtmp = array_shift($result_t)) { $b2bempid = $rowtmp["employeeID"] ;}



						$sqlT = "SELECT * FROM quote WHERE rep LIKE '" . $b2bempid . "' AND  qstatus !=2 AND quoteDate between '" . $date_from . "' and '" . $date_to . "'";
						db_b2b();
						$result_new = db_query($sqlT);

						$quotes_sent_t = tep_db_num_rows($result_new);

						//Lead

						$sqlT = "Select ID from companyInfo where landing_pg_enter_by = '" . $b2bempid . "' and dateCreated between '" . $date_from . "' and '" . $date_to . "'";

						
						db_b2b();

						$result_new = db_query($sqlT);

						$lead_today = tep_db_num_rows($result_new);


					//Quote Request tracker

						$sqlT = "Select quote_request_tracker_id from quote_request_tracker where quote_req_submitted_by = '" . $rowemp["EMPLOYEE"] . "' and date_submitted between '" . $date_from . "' and '" . $date_to . "'";
						
						db();

						$result_new = db_query($sqlT);

						$quote_requests_today = tep_db_num_rows($result_new);


					//First time rec

						$sqlT = "SELECT id FROM loop_transaction_buyer WHERE id in (SELECT min(id) FROM loop_transaction_buyer group by warehouse_id) and po_employee = '" . $rowemp["EMPLOYEE"] . "' and loop_transaction_buyer.ignore < 1 AND transaction_date between '" . $date_from . "' and '" . $date_to . "'";
						
						db();

						$result_new = db_query($sqlT);

						$fst_time_cust_today = tep_db_num_rows($result_new);

						

					//Demand entries

						db();

						$result_new = db_query("Select quote_id from quote_request where quote_date between '" . $date_from . "' and '" . $date_to . "' and user_initials = '" . $rowemp["EMPLOYEE"] . "'");

						$demand_entries_today = tep_db_num_rows($result_new);



						echo "<tr><td rowspan='7' bgColor='#E4EAEB' width='100px'>" . $rowemp["name"] . "</td>";



						echo "<td bgColor='#E4EAEB' width='200px'>Leads</td>";

					

						echo "<td bgColor='#E4EAEB' align='right' width='60px'>";

							$contact_act_tmp = $lead_today;

							$lead_today_total = $lead_today_total + $lead_today;

							

						echo "<a target='_blank' href='report_show_list.php?showlead=yes&date_flg=T&date_from_val=$date_from_val&date_to_val=$end_Dt&crmemp=" . $rowemp["emp_initials"] . "&b2bempid=" . $b2bempid. "'>" . $contact_act_tmp . "</a>";

						

						echo "</td></tr>";



						echo "<tr>";

						echo "<td bgColor='#E4EAEB' width='200px'>Emails</td>";

					

						echo "<td bgColor='#E4EAEB' align='right' width='60px'>";

							$contact_act_tmp = $contact_act_t;

							

						echo "<a target='_blank' href='report_daily_chart_crm_list.php?CRMday=T&in_dt_range=$in_dt_range&date_from_val=$date_from_val&crmemp=" . $rowemp["emp_initials"] . "'>" . $contact_act_tmp . "</a>";

						$contact_act_tot += $contact_act_tmp;

						echo "</td></tr>";

						

						echo "<tr>";

						echo "<td bgColor='#E4EAEB' width='200px'>Calls</td>";

					

						echo "<td bgColor='#E4EAEB' align='right' width='60px'>";

						$contact_act_tmp = $contact_act_ph1;

							

						echo "<a target='_blank' href='report_daily_chart_crm_list.php?CRMday=T&phone=y&in_dt_range=$in_dt_range&date_from_val=$date_from_val&crmemp=" . $rowemp["emp_initials"] . "'>" . $contact_act_tmp . "</a>";

						$contact_act_ph_t += $contact_act_tmp;

						

						echo "</td></tr>";



					//Demand Entries

						echo "<tr>";

						echo "<td bgColor='#E4EAEB' width='200px'>Demand Entries</td>";

					

						echo "<td bgColor='#E4EAEB' align='right' width='60px'>";

							$contact_act_tmp = $demand_entries_today;

							

							echo "<a target='_blank' href='report_show_list.php?showquote_req=demand_entry&date_flg=T&date_from_val=$date_from_val&date_to_val=$end_Dt&crmemp=" . $rowemp["emp_initials"] . "&b2bempid=" . $b2bempid. "'>" . $contact_act_tmp . "</a>";

							$demand_entries_t += $contact_act_tmp;



						echo "</td></tr>";

						

					//Quote Requests		

						echo "<tr>";

						echo "<td bgColor='#E4EAEB' width='200px'>Quote Requests</td>";

					

						echo "<td bgColor='#E4EAEB' align='right' width='60px'>";

							$contact_act_tmp = $quote_requests_today;

							

							echo "<a target='_blank' href='report_show_list.php?showquote_req=yes&date_flg=T&date_from_val=$date_from_val&date_to_val=$end_Dt&crmemp=" . $rowemp["emp_initials"] . "&b2bempid=" . $b2bempid. "'>" . $contact_act_tmp . "</a>";

							$quote_requests_t += $contact_act_tmp;



						echo "</td></tr>";

						

						echo "<tr><td bgColor='#E4EAEB' width='200px'>Quotes Sent</td>";



						echo "<td bgColor='#E4EAEB' align='right' width='60px'>";



						echo "<a target='_blank' href='report_show_open_quotes.php?in_dt_range=$in_dt_range&b2bempid=$b2bempid&date_from_val=$date_from_val&flg=Today'>" . $quotes_sent_t . "</a>";

							$quotes_sent_tot += $quotes_sent_t;

						echo "</td>";

						

						echo "</tr>";



					//1st time 

						echo "<tr>";

						echo "<td bgColor='#E4EAEB' width='200px'>1st Time Customers</td>";

					

						echo "<td bgColor='#E4EAEB' align='right' width='60px'>";

							$contact_act_tmp = $fst_time_cust_today;

							

							echo "<a target='_blank' href='report_show_list.php?showfirsttimerec=yes&date_flg=T&date_from_val=$date_from_val&date_to_val=$end_Dt&crmemp=" . $rowemp["emp_initials"] . "&b2bempid=" . $b2bempid. "'>" . $contact_act_tmp . "</a>";

							$fst_time_cust_t += $contact_act_tmp;

						echo "</td></tr>";

					}

					

					//Total



						echo "<tr><td rowspan='7' bgColor='#E4EAEB' width='100px'>Total</td>";



						echo "<td bgColor='#E4EAEB' width='200px'>Leads</td>";

						echo "<td bgColor='#E4EAEB' align='right' width='60px'>";

						echo $lead_today_total;

						echo "</td></tr>";



						echo "<tr>";

						echo "<td bgColor='#E4EAEB' width='200px'>Emails</td>";

						echo "<td bgColor='#E4EAEB' align='right' width='60px'>";

						echo $contact_act_tot;

						echo "</td></tr>";

						

						echo "<tr>";

						echo "<td bgColor='#E4EAEB' width='200px'>Calls</td>";

						echo "<td bgColor='#E4EAEB' align='right' width='60px'>";

						echo $contact_act_ph_t;

						echo "</td></tr>";



					//Demand Entries

						echo "<tr>";

						echo "<td bgColor='#E4EAEB' width='200px'>Demand Entries</td>";

						echo "<td bgColor='#E4EAEB' align='right' width='60px'>";

						echo $demand_entries_t;

						echo "</td></tr>";

						

					//Quote Requests		

						echo "<tr>";

						echo "<td bgColor='#E4EAEB' width='200px'>Quote Requests</td>";

						echo "<td bgColor='#E4EAEB' align='right' width='60px'>";

						echo $quote_requests_t;

						echo "</td></tr>";

						

						echo "<tr><td bgColor='#E4EAEB' width='200px'>Quotes Sent</td>";

						echo "<td bgColor='#E4EAEB' align='right' width='60px'>";

						echo $quotes_sent_tot;

						echo "</td>";

						echo "</tr>";



					//1st time 

						echo "<tr>";

						echo "<td bgColor='#E4EAEB' width='200px'>1st Time Customers</td>";

						echo "<td bgColor='#E4EAEB' align='right' width='60px'>";

						echo $fst_time_cust_t;

						echo "</td></tr>";

							

				//in date range

				

				}else{

				?>

					<table cellSpacing="1" cellPadding="1" border="0" width="700" id="table14" class="tablesorter">

					<thead>

						<tr>

							<th width='100px' bgColor='#ABC5DF'><u>Employee</u></th>

							<th width='200px' bgColor='#ABC5DF'>&nbsp;</th>

							<th width='60px' bgColor='#ABC5DF' align="center"><u>Today</u></th>

							<th width='60px' bgColor='#ABC5DF' align="center"><u>Yesterday</u></th>

							<th width='60px' bgColor='#ABC5DF' align="center"><u>Last 7</u></th>

							<th width='60px' bgColor='#ABC5DF' align="center"><u>Last 30</u></th>

						</tr>

					</thead>

					<tbody>

				

				<?php

					$sql = "SELECT * FROM report_activity_tracking ORDER BY unqid";

					$result = db_query($sql);

					while ($rowemp = array_shift($result)) {

						$b2bempid = 0;

						$sql = "SELECT employeeID FROM employees where loopID = '" . $rowemp["emp_id"] . "' and (activity_tracker_flg_pallet = 1 OR activity_tracker_flg_purchasing_pallet = 1) ";

						$result_t = db_query($sql);

						while ($rowtmp = array_shift($result_t)) { $b2bempid = $rowtmp["employeeID"] ;}

					

						echo "<tr><td rowspan='7' bgColor='#E4EAEB' width='100px'>" . $rowemp["emp_name"] . "</td>";



						echo "<td bgColor='#E4EAEB' width='200px'>Leads</td>";

					

						echo "<td bgColor='#E4EAEB' align='right' width='60px'>";

							$contact_act_tmp = $rowemp["lead_today"] ;

							

							echo "<a target='_blank' href='report_show_list.php?showlead=yes&date_flg=T&date_from_val=$date_from_val&date_to_val=$end_Dt&crmemp=" . $rowemp["emp_initials"] . "&b2bempid=" . $b2bempid. "'>" . $contact_act_tmp . "</a>";

							$lead_t += $contact_act_tmp;



						echo "</td><td bgColor='#E4EAEB' align='right' width='60px'>";

							$contact_act_tmp = $rowemp["lead_yesterday"] ;

							

							echo "<a target='_blank' href='report_show_list.php?showlead=yes&date_flg=Y&date_from_val=$date_from_val&date_to_val=$end_Dt&crmemp=" . $rowemp["emp_initials"] . "&b2bempid=" . $b2bempid. "'>" . $contact_act_tmp . "</a>";

							$lead_y += $contact_act_tmp;

							

						echo "</td><td bgColor='#E4EAEB' align='right' width='60px'>";

							$contact_act_tmp = $rowemp["lead_last7"] ;

							

							echo "<a target='_blank' href='report_show_list.php?showlead=yes&date_flg=7&date_from_val=$date_from_val&date_to_val=$end_Dt&crmemp=" . $rowemp["emp_initials"] . "&b2bempid=" . $b2bempid. "'>" . $contact_act_tmp . "</a>";

							$lead_7 += $contact_act_tmp;

							

						echo "<td bgColor='#E4EAEB' align='right' width='60px'>";

							$contact_act_tmp = $rowemp["lead_last30"];

							

							echo "<a target='_blank' href='report_show_list.php?showlead=yes&date_flg=30&date_from_val=$date_from_val&date_to_val=$end_Dt&crmemp=" . $rowemp["emp_initials"] . "&b2bempid=" . $b2bempid. "'>" . $contact_act_tmp . "</a>";

							$lead_30 += $contact_act_tmp;

							

						echo "</td></tr>";



						echo "<tr>";

						echo "<td bgColor='#E4EAEB' width='200px'>Emails</td>";

					

						echo "<td bgColor='#E4EAEB' align='right' width='60px'>";

							$contact_act_tmp = $rowemp["contact_today"] ;

							

							echo "<a target='_blank' href='report_daily_chart_crm_list.php?CRMday=T&in_dt_range=$in_dt_range&date_from_val=$date_from_val&crmemp=" . $rowemp["emp_initials"] . "'>" . $contact_act_tmp . "</a>";

							$contact_act_t += $contact_act_tmp;



						echo "</td><td bgColor='#E4EAEB' align='right' width='60px'>";

							$contact_act_tmp = $rowemp["contact_yesterday"] ;

							

							echo "<a target='_blank' href='report_daily_chart_crm_list.php?CRMday=Y&in_dt_range=$in_dt_range&date_from_val=$date_from_val&crmemp=" . $rowemp["emp_initials"] . "'>" . $contact_act_tmp . "</a>";

							$contact_act_y += $contact_act_tmp;

							

						echo "</td><td bgColor='#E4EAEB' align='right' width='60px'>";

							$contact_act_tmp = $rowemp["contact_last7"] ;

							

							echo "<a target='_blank' href='report_daily_chart_crm_list.php?CRMday=7&in_dt_range=$in_dt_range&date_from_val=$date_from_val&crmemp=" . $rowemp["emp_initials"] . "'>" . $contact_act_tmp . "</a>";

							$contact_act_7 += $contact_act_tmp;

							

						echo "<td bgColor='#E4EAEB' align='right' width='60px'>";

							$contact_act_tmp = $rowemp["contact_last30"];

							

							echo "<a target='_blank' href='report_daily_chart_crm_list.php?CRMday=30&in_dt_range=$in_dt_range&date_from_val=$date_from_val&crmemp=" . $rowemp["emp_initials"] . "'>" . $contact_act_tmp . "</a>";

							$contact_act_30 += $contact_act_tmp;

							

						echo "</td></tr>";

						

						echo "<tr>";

						echo "<td bgColor='#E4EAEB' width='200px'>Calls</td>";

					

						echo "<td bgColor='#E4EAEB' align='right' width='60px'>";

							$contact_act_tmp = $rowemp["contact_today_phone"] ;

							

							echo "<a target='_blank' href='report_daily_chart_crm_list.php?CRMday=T&phone=y&in_dt_range=$in_dt_range&date_from_val=$date_from_val&crmemp=" . $rowemp["emp_initials"] . "'>" . $contact_act_tmp . "</a>";

							$contact_act_ph_t += $contact_act_tmp;



						echo "</td><td bgColor='#E4EAEB' align='right' width='60px'>";

							$contact_act_tmp = $rowemp["contact_yesterday_phone"] ;

							

							echo "<a target='_blank' href='report_daily_chart_crm_list.php?CRMday=Y&phone=y&in_dt_range=$in_dt_range&date_from_val=$date_from_val&crmemp=" . $rowemp["emp_initials"] . "'>" . $contact_act_tmp . "</a>";

							$contact_act_ph_y += $contact_act_tmp;

							

						echo "</td><td bgColor='#E4EAEB' align='right' width='60px'>";

							$contact_act_tmp = $rowemp["contact_last7_phone"] ;

							

							echo "<a target='_blank' href='report_daily_chart_crm_list.php?CRMday=7&phone=y&in_dt_range=$in_dt_range&date_from_val=$date_from_val&crmemp=" . $rowemp["emp_initials"] . "'>" . $contact_act_tmp . "</a>";

							$contact_act_ph_7 += $contact_act_tmp;

							

						echo "<td bgColor='#E4EAEB' align='right' width='60px'>";

							$contact_act_tmp = $rowemp["contact_last30_phone"];

							

							echo "<a target='_blank' href='report_daily_chart_crm_list.php?CRMday=30&phone=y&in_dt_range=$in_dt_range&date_from_val=$date_from_val&crmemp=" . $rowemp["emp_initials"] . "'>" . $contact_act_tmp . "</a>";

							$contact_act_ph_30 += $contact_act_tmp;

							

						echo "</td></tr>";



					//Demand Entries

						echo "<tr>";

						echo "<td bgColor='#E4EAEB' width='200px'>Demand Entries</td>";

					

						echo "<td bgColor='#E4EAEB' align='right' width='60px'>";

							$contact_act_tmp = $rowemp["demand_entries_today"] ;

							

							echo "<a target='_blank' href='report_show_list.php?showquote_req=demand_entry&date_flg=T&date_from_val=$date_from_val&date_to_val=$end_Dt&crmemp=" . $rowemp["emp_initials"] . "&b2bempid=" . $b2bempid. "'>" . $contact_act_tmp . "</a>";

							$demand_entries_t += $contact_act_tmp;



						echo "</td><td bgColor='#E4EAEB' align='right' width='60px'>";

							$contact_act_tmp = $rowemp["demand_entries_yesterday"] ;

							

							echo "<a target='_blank' href='report_show_list.php?showquote_req=demand_entry&date_flg=Y&date_from_val=$date_from_val&date_to_val=$end_Dt&crmemp=" . $rowemp["emp_initials"] . "&b2bempid=" . $b2bempid. "'>" . $contact_act_tmp . "</a>";

							$demand_entries_y += $contact_act_tmp;

							

						echo "</td><td bgColor='#E4EAEB' align='right' width='60px'>";

							$contact_act_tmp = $rowemp["demand_entries_last7"] ;

							

							echo "<a target='_blank' href='report_show_list.php?showquote_req=demand_entry&date_flg=7&date_from_val=$date_from_val&date_to_val=$end_Dt&crmemp=" . $rowemp["emp_initials"] . "&b2bempid=" . $b2bempid. "'>" . $contact_act_tmp . "</a>";

							$demand_entries_7 += $contact_act_tmp;

							

						echo "<td bgColor='#E4EAEB' align='right' width='60px'>";

							$contact_act_tmp = $rowemp["demand_entries_last30"];

							

							echo "<a target='_blank' href='report_show_list.php?showquote_req=demand_entry&date_flg=30&date_from_val=$date_from_val&date_to_val=$end_Dt&crmemp=" . $rowemp["emp_initials"] . "&b2bempid=" . $b2bempid. "'>" . $contact_act_tmp . "</a>";

							$demand_entries_30 += $contact_act_tmp;

							

						echo "</td></tr>";

						

					//Quote Requests		

						echo "<tr>";

						echo "<td bgColor='#E4EAEB' width='200px'>Quote Requests</td>";

					

						echo "<td bgColor='#E4EAEB' align='right' width='60px'>";

							$contact_act_tmp = $rowemp["quote_requests_today"] ;

							

							echo "<a target='_blank' href='report_show_list.php?showquote_req=yes&date_flg=T&date_from_val=$date_from_val&date_to_val=$end_Dt&crmemp=" . $rowemp["emp_initials"] . "&b2bempid=" . $b2bempid. "'>" . $contact_act_tmp . "</a>";

							$quote_requests_t += $contact_act_tmp;



						echo "</td><td bgColor='#E4EAEB' align='right' width='60px'>";

							$contact_act_tmp = $rowemp["quote_requests_yesterday"] ;

							

							echo "<a target='_blank' href='report_show_list.php?showquote_req=yes&date_flg=Y&date_from_val=$date_from_val&date_to_val=$end_Dt&crmemp=" . $rowemp["emp_initials"] . "&b2bempid=" . $b2bempid. "'>" . $contact_act_tmp . "</a>";

							$quote_requests_y += $contact_act_tmp;

							

						echo "</td><td bgColor='#E4EAEB' align='right' width='60px'>";

							$contact_act_tmp = $rowemp["quote_requests_last7"] ;

							

							echo "<a target='_blank' href='report_show_list.php?showquote_req=yes&date_flg=7&date_from_val=$date_from_val&date_to_val=$end_Dt&crmemp=" . $rowemp["emp_initials"] . "&b2bempid=" . $b2bempid. "'>" . $contact_act_tmp . "</a>";

							$quote_requests_7 += $contact_act_tmp;

							

						echo "<td bgColor='#E4EAEB' align='right' width='60px'>";

							$contact_act_tmp = $rowemp["quote_requests_last30"];

							

							echo "<a target='_blank' href='report_show_list.php?showquote_req=yes&date_flg=30&date_from_val=$date_from_val&date_to_val=$end_Dt&crmemp=" . $rowemp["emp_initials"] . "&b2bempid=" . $b2bempid. "'>" . $contact_act_tmp . "</a>";

							$quote_requests_30 += $contact_act_tmp;

							

						echo "</td></tr>";

						

						echo "<tr><td bgColor='#E4EAEB' width='200px'>Quotes Sent</td>";



						echo "<td bgColor='#E4EAEB' align='right' width='60px'>";



						echo "<a target='_blank' href='report_show_open_quotes.php?in_dt_range=$in_dt_range&b2bempid=$b2bempid&date_from_val=$date_from_val&flg=Today'>" . $rowemp["quotes_today"] . "</a>";

							$quotes_sent_t += $rowemp["quotes_today"];

						echo "</td><td bgColor='#E4EAEB' align='right' width='60px'>";

							echo "<a target='_blank' href='report_show_open_quotes.php?in_dt_range=$in_dt_range&b2bempid=$b2bempid&date_from_val=$date_from_val&flg=yesterday'>" . $rowemp["quotes_yesterday"] . "</a>";

							$quotes_sent_y += $rowemp["quotes_yesterday"];

						echo "</td><td bgColor='#E4EAEB' align='right' width='60px'>";

							echo "<a target='_blank' href='report_show_open_quotes.php?in_dt_range=$in_dt_range&b2bempid=$b2bempid&date_from_val=$date_from_val&flg=7days'>" . $rowemp["quotes_last7"] . "</a>";

							$quotes_sent_7 += $rowemp["quotes_last7"];

						echo "<td bgColor='#E4EAEB' align='right' width='60px'>";



						echo "<a target='_blank' href='report_show_open_quotes.php?in_dt_range=$in_dt_range&b2bempid=$b2bempid&date_from_val=$date_from_val&flg=month'>" . $rowemp["quotes_last30"] . "</a>";

							$quotes_sent_30 += $rowemp["quotes_last30"];

						echo "</td>";

						

						echo "</tr>";



					//1st time 

						echo "<tr>";

						echo "<td bgColor='#E4EAEB' width='200px'>1st Time Customers</td>";

					

						echo "<td bgColor='#E4EAEB' align='right' width='60px'>";

							$contact_act_tmp = $rowemp["fst_time_cust_today"] ;

							

							echo "<a target='_blank' href='report_show_list.php?showfirsttimerec=yes&date_flg=T&date_from_val=$date_from_val&date_to_val=$end_Dt&crmemp=" . $rowemp["emp_initials"] . "&b2bempid=" . $b2bempid. "'>" . $contact_act_tmp . "</a>";

							$fst_time_cust_t += $contact_act_tmp;



						echo "</td><td bgColor='#E4EAEB' align='right' width='60px'>";

							$contact_act_tmp = $rowemp["fst_time_cust_yesterday"] ;

							

							echo "<a target='_blank' href='report_show_list.php?showfirsttimerec=yes&date_flg=Y&date_from_val=$date_from_val&date_to_val=$end_Dt&crmemp=" . $rowemp["emp_initials"] . "&b2bempid=" . $b2bempid. "'>" . $contact_act_tmp . "</a>";

							$fst_time_cust_y += $contact_act_tmp;

							

						echo "</td><td bgColor='#E4EAEB' align='right' width='60px'>";

							$contact_act_tmp = $rowemp["fst_time_cust_last7"] ;

							

							echo "<a target='_blank' href='report_show_list.php?showfirsttimerec=yes&date_flg=7&date_from_val=$date_from_val&date_to_val=$end_Dt&crmemp=" . $rowemp["emp_initials"] . "&b2bempid=" . $b2bempid. "'>" . $contact_act_tmp . "</a>";

							$fst_time_cust_7 += $contact_act_tmp;

							

						echo "<td bgColor='#E4EAEB' align='right' width='60px'>";

							$contact_act_tmp = $rowemp["fst_time_cust_last30"];

							

							echo "<a target='_blank' href='report_show_list.php?showfirsttimerec=yes&date_flg=30&date_from_val=$date_from_val&date_to_val=$end_Dt&crmemp=" . $rowemp["emp_initials"] . "&b2bempid=" . $b2bempid. "'>" . $contact_act_tmp . "</a>";

							$fst_time_cust_30 += $contact_act_tmp;

							

						echo "</td></tr>";

						

					}

					

						echo "<tr><td bgColor='#E4EAEB' rowspan='7' align=center><b>Total</td><td bgColor='#E4EAEB' width='200px'>Leads</td><td bgColor='#E4EAEB' align = right><strong>";

						echo $lead_t . " </strong></td><td bgColor='#E4EAEB' align = right><strong>";

						echo $lead_y . " </strong></td><td bgColor='#E4EAEB' align = right><strong>";

						echo $lead_7 . " </strong></td><td bgColor='#E4EAEB' align = right><strong>";

						echo $lead_30 . " </strong></td></tr><tr><td bgColor='#E4EAEB' width='200px'>Emails</td><td bgColor='#E4EAEB' align = right><strong>";

						echo $contact_act_t . " </strong></td><td bgColor='#E4EAEB' align = right><strong>";

						echo $contact_act_y . " </strong></td><td bgColor='#E4EAEB' align = right><strong>";

						echo $contact_act_7 . " </strong></td><td bgColor='#E4EAEB' align = right><strong>";

						echo $contact_act_30 . " </strong></td></tr><tr><td bgColor='#E4EAEB' width='200px'>Calls</td><td bgColor='#E4EAEB' align = right><strong>";

						echo $contact_act_ph_t . " </strong></td><td bgColor='#E4EAEB' align = right><strong>";

						echo $contact_act_ph_y . " </strong></td><td bgColor='#E4EAEB' align = right><strong>";

						echo $contact_act_ph_7 . " </strong></td><td bgColor='#E4EAEB' align = right><strong>";

						echo $contact_act_ph_30 . " </strong></td></tr><tr><td bgColor='#E4EAEB' width='200px'>Demand Entries</td><td bgColor='#E4EAEB' align = right><strong>";

						echo $demand_entries_t . " </strong></td><td bgColor='#E4EAEB' align = right><strong>";

						echo $demand_entries_y . " </strong></td><td bgColor='#E4EAEB' align = right><strong>";

						echo $demand_entries_7 . " </strong></td><td bgColor='#E4EAEB' align = right><strong>";

						echo $demand_entries_30 . " </strong></td></tr><tr><td bgColor='#E4EAEB' width='200px'>Quote Requests</td><td bgColor='#E4EAEB' align = right><strong>";

						echo $quote_requests_t . " </strong></td><td bgColor='#E4EAEB' align = right><strong>";

						echo $quote_requests_y . " </strong></td><td bgColor='#E4EAEB' align = right><strong>";

						echo $quote_requests_7 . " </strong></td><td bgColor='#E4EAEB' align = right><strong>";

						echo $quote_requests_30 . " </strong></td></tr><tr><td bgColor='#E4EAEB' width='200px'>Quotes Sent</td><td bgColor='#E4EAEB' align = right><strong>";

						echo $quotes_sent_t . " </strong></td><td bgColor='#E4EAEB' align = right><strong>";

						echo $quotes_sent_y . " </strong></td><td bgColor='#E4EAEB' align = right><strong>";

						echo $quotes_sent_7 . " </strong></td><td bgColor='#E4EAEB' align = right><strong>";

						echo $quotes_sent_30 . " </strong></td></tr><tr><td bgColor='#E4EAEB' width='200px'>1st Time Customers</td><td bgColor='#E4EAEB' align = right><strong>";

						echo $fst_time_cust_t . " </strong></td><td bgColor='#E4EAEB' align = right><strong>";

						echo $fst_time_cust_y . " </strong></td><td bgColor='#E4EAEB' align = right><strong>";

						echo $fst_time_cust_7 . " </strong></td><td bgColor='#E4EAEB' align = right><strong>";

						echo $fst_time_cust_30 . " </strong></td>";

						echo "</tr>";

					

					echo "</tbody>";

					}

					?>

				</table>

			

			</td>

			

		</tr>

	</table>

	</div>

</body>

</html>