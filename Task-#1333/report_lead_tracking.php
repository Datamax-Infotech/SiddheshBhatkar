<?php
	require ("inc/header_session.php");
	require ("mainfunctions/database.php");
	require ("mainfunctions/general-functions.php");
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<title>B2B Lead Tracking Report</title>
		<link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet"> 	
		<link rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>
		<style type="text/css">

			.txtstyle_color{

			font-family:arial;

			font-size:12;

			height: 16px; 

			background:#ABC5DF;

			}

			.black_overlay{

					display: none;

					position: absolute;

					top: 0%;

					left: 0%;

					width: 100%;

					height: 100%;

					background-color: gray;

					z-index:1001;

					-moz-opacity: 0.8;

					opacity:.80;

					filter: alpha(opacity=80);

				}

				.white_content {

					display: none;

					position: absolute;

					top: 5%;

					left: 10%;

					width: 60%;

					height: 90%;

					padding: 16px;

					border: 1px solid gray;

					background-color: white;

					z-index:1002;

					overflow: auto;

			}

		</style>
	</head>
	<script language="JavaScript" >
		function f_getPosition (e_elemRef, s_coord) {

			var n_pos = 0, n_offset,

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

		function show_file_inviewer_pos(filename, formtype, ctrlnm){

			var selectobject = document.getElementById(ctrlnm); 

			var n_left = f_getPosition(selectobject, 'Left');

			var n_top  = f_getPosition(selectobject, 'Top');



			document.getElementById("light").innerHTML = "<a href='javascript:void(0)' onclick=document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'>Close</a> &nbsp;<center>" + formtype +	"</center><br/> <embed src='"+ filename + "' width='800' height='800'>";

			document.getElementById('light').style.display='block';



			document.getElementById('light').style.left = n_left - 400 + 'px';

			document.getElementById('light').style.top = n_top + 10 + 'px';

		}
	</script>

	<script language="JavaScript" src="inc/CalendarPopup.js"></script><script language="JavaScript" src="inc/general.js"></script>

	<script language="JavaScript">document.write(getCalendarStyles());</script>

	<script language="JavaScript">

		var cal2xx = new CalendarPopup("listdiv");

		cal2xx.showNavigationDropdowns();

		var cal3xx = new CalendarPopup("listdiv");

		cal3xx.showNavigationDropdowns();

	</script>

	<link rel='stylesheet' type='text/css' href='one_style.css' >

	<body>

		<?php include("inc/header.php"); ?>
		<div class="main_data_css">
			<div id="light" class="white_content"></div>
			<div id="fade" class="black_overlay"></div>
			<div class="dashboard_heading" style="float: left;">
				<div style="float: left;">
					B2B Lead Tracking Report  
					<div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
						<span class="tooltiptext">This report allows the user to see all company records by the date they were entered into the system, and seeing where they are at in the sales and purchasing processes respectively.</span></div><br>
					</div>
				</div>
				<?php

					$time = strtotime(Date('Y-m-d'));

					$st_friday = $time;

					$st_friday_last = date('m/d/Y', strtotime('-6 days', $st_friday));

					$st_thursday_last = Date('m/d/Y');

					$in_dt_range = "no";

					if( $_REQUEST["date_from"] !="" && $_REQUEST["date_to"] !=""){

						$date_from_val = date("Y-m-d", strtotime($_REQUEST["date_from"]));

						$date_to_val_org = date("Y-m-d", strtotime($_REQUEST["date_to"]));

						$date_to_val = date("Y-m-d", strtotime('+1 day', strtotime($_REQUEST["date_to"])));

						$in_dt_range = "yes";

						$assignid=$_REQUEST["assignid"];

					}else{

						$date_from_val = date("Y-m-d", strtotime($st_friday_last));

						$date_to_val_org = date("Y-m-d", strtotime($st_thursday_last));

						$date_to_val = date("Y-m-d", strtotime('+1 day', strtotime($st_thursday_last)));

						$assignid="all";

					}

				?>
			<form method="post" name="shippingtool" action="report_lead_tracking.php">
				<table border="0">
					<tr>
						<td>Date Range Selector:</td>
						<td>
							From: 
							<input type="text" name="date_from" id="date_from" size="10" value="<?php echo isset($_GET["date_from"])? $_GET["date_from"]: date("m/d/Y", strtotime($date_from_val)); ?>" > 

							<a href="#" onclick="cal2xx.select(document.shippingtool.date_from,'dtanchor2xx','MM/dd/yyyy'); return false;" name="dtanchor2xx" id="dtanchor2xx"><img border="0" src="images/calendar.jpg"></a>

							<div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>		
							To: 

							<input type="text" name="date_to" id="date_to" size="10" value="<?php echo isset($_GET["date_to"])? $_GET["date_to"]: date("m/d/Y", strtotime($date_to_val_org)); ?>" > 

							<a href="#" onclick="cal3xx.select(document.shippingtool.date_to,'dtanchor3xx','MM/dd/yyyy'); return false;" name="dtanchor3xx" id="dtanchor3xx"><img border="0" src="images/calendar.jpg"></a>

						</td>
						<td>
							<select size="1" name="assignid">
								<option selected value="all">All</option>

							<?php

								$arr = explode(",", $row["assignedto"]);

								$qassign = "SELECT * FROM employees WHERE status='Active' order by name";
								db_b2b();
								$dt_view_res_assign = db_query($qassign);

								while ($res_assign= array_shift($dt_view_res_assign)) {

							?>

							<option <?php if (
								isset($_REQUEST["assignid"]) &&
								$_REQUEST["assignid"] == $res_assign["employeeID"]
							) {
								echo "selected";
							} ?> value="<?= $res_assign["employeeID"] ?>"><?= $res_assign["name"] ?>

							<?php

							}

							?>

						</select>
						&nbsp;&nbsp;
						Show only MM Lead?<input type="checkbox" name="chk_show_mm_lead" id="chk_show_mm_lead" value="Yes" <? if ($_REQUEST["chk_show_mm_lead"] == "Yes") { echo " checked ";} ?> />
					</td>
					<td>
						<input type="submit" name="btntool" value="Search" />
						<input type="hidden" name="hd_pgpost" id="hd_pgpost" value=""/>
					</td>
				</tr>
			</table>
		</form>

		<div ><i>Note: Wait for <font color="red">Report</font> to complete, use the Sort option after the Report is completed. Rescue records are shown in <span style="background:#bcf5bc;">Green</span> </i></div>

	<?php 
		function add_date($givendate,$day) {

			$cd = strtotime($givendate);

			$newdate = date('Y-m-d', mktime(date('m',$cd), date('d',$cd)+$day, date('Y',$cd)));

			return $newdate;

		}

		function getreportdata($eid, $so_val, $sk_val, $assignid, $dt_from, $dt_to, $rep_condition, $sales_rescue_flg, $compidlist, $tbl_count, $chk_show_mm_lead){

			global $tot_lead , $tot_lead_assign, $tot_lead_not_assign, $tot_contact, $tot_quotes_sent,$tot_deal_made;
			
			if ($so_val == "A") {

				$so = "D"; 

			}else{	

				$so = "A";

			}

			if ($sk_val != "" ){

				if ($eid > 0) {

					$tmp_sortorder = "";

			if ($sk_val == "dt") {

				$tmp_sortorder = "companyInfo.dateCreated";

			} elseif ($sk_val == "age") {

				$tmp_sortorder = "companyInfo.dateCreated";

			} elseif ($sk_val == "cname") {

				$tmp_sortorder = "companyInfo.company";

			} elseif ($sk_val == "qty") {

				$tmp_sortorder = "companyInfo.company";

			} elseif ($sk_val == "nname") {

				$tmp_sortorder = "companyInfo.nickname";

			} elseif ($sk_val == "nd") {

				$tmp_sortorder = "companyInfo.next_date";

			} elseif ($sk_val == "ns") {

				$tmp_sortorder = "companyInfo.next_step";

			} elseif ($sk_val == "ei") {

				$tmp_sortorder = "employees.initials";

			} elseif ($sk_val == "lc") {

				$tmp_sortorder = "companyInfo.company";

			}else{ 

				$tmp_sortorder = "companyInfo." . $sk_val; 

			}

			

			if ($so == "A") {

				$tmp_sort = "D"; 

			} 	

			else {	

				$tmp_sort = "A";

			}

			$sql_qry = "update employees set sort_fieldname = '". $tmp_sortorder."', sort_order='".$tmp_sort."' where employeeID = " . $eid ;
			db_b2b();
			db_query($sql_qry);

		}

		

		if ($sk_val == "dt") {

			$skey = " ORDER BY companyInfo.dateCreated";

		} elseif ($sk_val == "age") {

			$skey = " ORDER BY companyInfo.dateCreated";

		} elseif ($sk_val == "contact") {

			$skey = " ORDER BY companyInfo.contact";

		} elseif ($sk_val == "cname") {

			$skey = " ORDER BY companyInfo.company";

		} elseif ($sk_val == "nname") {

			$skey = " ORDER BY companyInfo.nickname";

		} elseif ($sk_val == "city") {

			$skey = " ORDER BY companyInfo.city";

		} elseif ($sk_val == "state") {

			$skey = " ORDER BY companyInfo.state";

		} elseif ($sk_val == "zip") {

			$skey = " ORDER BY companyInfo.zip";

		} elseif ($sk_val == "nd") {

			$skey = " ORDER BY companyInfo.next_date";

		} elseif ($sk_val == "ns") {

			$skey = " ORDER BY companyInfo.next_step";

		} elseif ($sk_val == "ei") {

			$skey = " ORDER BY employees.initials";

		} elseif ($sk_val == "lc") {

			$skey = " ORDER BY companyInfo.last_contact_date";

		}



		if ($so_val != "") {

			if ($so_val == "A") {

				$sord = " ASC";

			} Else {

				$sord = " DESC";

			}

		} ELSE {

			$sord = " DESC";

		}

	}

	else

	{

		if ($eid > 0) {

			$sql_qry = "Select sort_fieldname, sort_order from employees where employeeID = " . $eid .  "";
			db_b2b();
			$dt_view_res = db_query($sql_qry);

			while ($row = array_shift($dt_view_res)) {

				if ($row["sort_fieldname"] != "") {

					if ($row["sort_order"] == "A") {

						$sord = " ASC";

					} Else {

						$sord = " DESC";

					}

					$skey = " ORDER BY ". $row["sort_fieldname"];

				} else {

					$skey = " ORDER BY companyInfo.dateCreated " ;

					$sord = " DESC"; 

				}

			}

		}else {

			$skey = " ORDER BY companyInfo.dateCreated " ;

			$sord = " DESC"; 

		}

	}



	$quotes_archive_date = "";

	$query = "SELECT variablevalue FROM tblvariable where variablename = 'quotes_archive_date'";
	db();
	$dt_view_res3 = db_query($query);

	while ($objQuote= array_shift($dt_view_res3)) {

		$quotes_archive_date = $objQuote["variablevalue"];

	}



		$tmpdisplay_flg = "n";

	//companyInfo.haveNeed LIKE 'Need Boxes'

		/*if ($rep_condition == "leadnotassign"){

			$x = "Select companyInfo.shipCity , companyInfo.status, companyInfo.haveNeed, companyInfo.shipState, companyInfo.id AS I, companyInfo.howHear, companyInfo.loopid AS LID, companyInfo.contact AS C,  companyInfo.dateCreated AS D,  ";

			$x .= " companyInfo.company AS CO, companyInfo.nickname AS NN, companyInfo.phone AS PH,  companyInfo.city AS CI,  companyInfo.state AS ST,  companyInfo.zip AS ZI, ";

			$x .= " companyInfo.next_step AS NS, companyInfo.last_contact_date AS LD, companyInfo.next_date AS ND, employees.initials AS EI from companyInfo LEFT OUTER JOIN ";

			$x .= " employees ON companyInfo.assignedto = employees.employeeID Where companyInfo.assignedto = '' and (companyInfo.dateCreated >= '" . $dt_from . "' and companyInfo.dateCreated <= '" . $dt_to . "') ";

			$x .= " and companyInfo.haveNeed = '" . $sales_rescue_flg . "' and companyInfo.status not in (43, 31) GROUP BY companyInfo.id " . $skey . $sord . " ";

		}	*/

		//

			//echo $assignid;

		if($assignid=="all")

		{

			$empqry="";

		}

		else{

			$empqry=" and companyInfo.assignedto= $assignid";

		}

			

		$mm_lead = "";	

		if ($chk_show_mm_lead == "Yes") { 		

			$mm_lead = " and (howHear = 'MM Lead: LinkedIN' or howHear = 'MM Lead: Other' or howHear = 'MM Lead to be Qualified') ";	

		}



		//

		if ($rep_condition == "leadnotassign" || $rep_condition == "leadassignbutnotcontact" || $rep_condition == "leadassigncontacttbd" || 

		$rep_condition == "leadassigncontactnopo" || $rep_condition == "leadassigncontactponoaccpt" ||

		$rep_condition == "leadassigncontactpoaccpt" || $rep_condition == "leadassigncontactporeject" || $rep_condition == "leadunassign"){

		

			if ($compidlist != ""){

				$x = "Select companyInfo.shipCity , companyInfo.status, companyInfo.haveNeed, companyInfo.shipState, companyInfo.id AS I, companyInfo.howHear, companyInfo.loopid AS LID, companyInfo.contact AS C,  companyInfo.dateCreated AS D,  ";

				$x .= " companyInfo.company AS CO, companyInfo.nickname AS NN, companyInfo.phone AS PH,  companyInfo.city AS CI,  companyInfo.state AS ST,  companyInfo.zip AS ZI, ";

				$x .= " companyInfo.next_step AS NS, companyInfo.last_contact_date AS LD, companyInfo.next_date AS ND, employees.initials AS EI from companyInfo LEFT OUTER JOIN ";

				$x .= " employees ON companyInfo.assignedto = employees.employeeID Where companyInfo.haveNeed = '" . $sales_rescue_flg . "'" .$empqry. " and companyInfo.ID in (" . $compidlist .") " . $mm_lead;

			}			

			//echo $x;

		}	

	

		if ($rep_condition == "leadnotassignnotquoted"){

			$x = "Select companyInfo.shipCity , companyInfo.status, companyInfo.haveNeed, companyInfo.shipState, companyInfo.id AS I, companyInfo.howHear, companyInfo.loopid AS LID, companyInfo.contact AS C,  companyInfo.dateCreated AS D,  ";

			$x .= " companyInfo.company AS CO, companyInfo.nickname AS NN, companyInfo.phone AS PH,  companyInfo.city AS CI,  companyInfo.state AS ST,  companyInfo.zip AS ZI, ";

			$x .= " companyInfo.next_step AS NS, companyInfo.last_contact_date AS LD, companyInfo.next_date AS ND, employees.initials AS EI from companyInfo LEFT OUTER JOIN ";

			$x .= " employees ON companyInfo.assignedto = employees.employeeID Where companyInfo.assignedto > 0 and companyInfo.dateCreated >= '" . $dt_from . "' and companyInfo.dateCreated <= '" . $dt_to . "' ";

			$x .= " and companyInfo.haveNeed = '" . $sales_rescue_flg . "'" .$empqry . $mm_lead . "  GROUP BY companyInfo.id " . $skey . $sord . " " ;

			//echo $x;

		}	



		if ($rep_condition == "leadcontact"){

			$x = "Select companyInfo.shipCity , companyInfo.status, companyInfo.haveNeed, companyInfo.shipState, companyInfo.id AS I, companyInfo.howHear, companyInfo.loopid AS LID, companyInfo.contact AS C,  companyInfo.dateCreated AS D,  ";

			$x .= " companyInfo.company AS CO, companyInfo.nickname AS NN, companyInfo.phone AS PH,  companyInfo.city AS CI,  companyInfo.state AS ST,  companyInfo.zip AS ZI, ";

			$x .= " companyInfo.next_step AS NS, companyInfo.last_contact_date AS LD, companyInfo.next_date AS ND, employees.initials AS EI from companyInfo LEFT OUTER JOIN ";

			$x .= " employees ON companyInfo.assignedto = employees.employeeID where companyInfo.dateCreated >= '" . $dt_from . "' and companyInfo.dateCreated <= '" . $dt_to . "' ";

			$x .= " and companyInfo.haveNeed = '" . $sales_rescue_flg . "'" . $empqry . $mm_lead . "  GROUP BY companyInfo.id " . $skey . $sord . " ";

		}	//and companyInfo.status = 63 



		if ($rep_condition == "leadquoted"){

			$x = "Select companyInfo.shipCity ,companyInfo.status, companyInfo.haveNeed, companyInfo.shipState, companyInfo.id AS I, companyInfo.howHear, companyInfo.loopid AS LID, companyInfo.contact AS C,  companyInfo.dateCreated AS D,  ";

			$x .= " companyInfo.company AS CO, companyInfo.nickname AS NN, companyInfo.phone AS PH,  companyInfo.city AS CI,  companyInfo.state AS ST,  companyInfo.zip AS ZI, ";

			$x .= " companyInfo.next_step AS NS, companyInfo.last_contact_date AS LD, companyInfo.next_date AS ND, employees.initials AS EI from companyInfo LEFT OUTER JOIN ";

			$x .= " employees ON companyInfo.assignedto = employees.employeeID inner join quote on quote.companyID = companyInfo.ID Where companyInfo.assignedto > 0 and companyInfo.dateCreated >= '" . $dt_from . "' and companyInfo.dateCreated <= '" . $dt_to . "' ";

			$x .= " and companyInfo.haveNeed = '" . $sales_rescue_flg . "'" . $empqry . $mm_lead . "  GROUP BY companyInfo.id " . $skey . $sord . " ";

		}	



		if ($rep_condition == "leadclosedeal"){

			$x = "Select companyInfo.shipCity , companyInfo.status, companyInfo.haveNeed, companyInfo.shipState, companyInfo.id AS I, companyInfo.howHear, companyInfo.loopid AS LID, companyInfo.contact AS C,  companyInfo.dateCreated AS D,  ";

			$x .= " companyInfo.company AS CO, companyInfo.nickname AS NN, companyInfo.phone AS PH,  companyInfo.city AS CI,  companyInfo.state AS ST,  companyInfo.zip AS ZI, ";

			$x .= " companyInfo.next_step AS NS, companyInfo.last_contact_date AS LD, companyInfo.next_date AS ND, employees.initials AS EI from companyInfo LEFT OUTER JOIN ";

			$x .= " employees ON companyInfo.assignedto = employees.employeeID inner join quote on quote.companyID = companyInfo.ID Where companyInfo.assignedto > 0 and companyInfo.dateCreated >= '" . $dt_from . "' and companyInfo.dateCreated <= '" . $dt_to . "' ";

			$x .= " and companyInfo.haveNeed = '" . $sales_rescue_flg . "'" . $empqry . $mm_lead . "  GROUP BY companyInfo.id " . $skey . $sord . " ";

		}	

//			echo "<br/>" . $x . "<br/><br/>";



	?>

	<table width="650" border="0" cellspacing="1" cellpadding="1">

		<?php if ($rep_condition == "leadnotassign"){ ?>

			<tr>

				<td colspan="15" align="center" bgcolor="#D9F2FF"><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>Leads Unassigned</b></font></td>

			</tr>

		<?php } ?>

		<?php if ($rep_condition == "leadassignbutnotcontact"){ ?>

			<tr>

				<td colspan="15" align="center" bgcolor="#D9F2FF"><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>Leads Assigned, But Not Contacted</b></font></td>

			</tr>

		<?php } ?>

		

		<?php if ($rep_condition == "leadassigncontacttbd"){ ?>

			<tr>

				<td colspan="15" align="center" bgcolor="#D9F2FF"><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>Lead Contacted, Still Need to Qualify</b></font></td>

			</tr>

		<?php } ?>



		<?php if ($rep_condition == "leadassigncontactnopo"){ 

			if ($sales_rescue_flg == "Need Boxes") {?>

				<tr>

					<td colspan="15" align="center" bgcolor="#D9F2FF"><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>Lead is Qualified, But Not Quoted</b></font></td>

				</tr>

			<?php } else { ?>

				<tr>

					<td colspan="15" align="center" bgcolor="#D9F2FF"><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>Lead is Qualified, But No PO Sent</b></font></td>

				</tr>

		<?php 	}

		} ?>

		

		<?php if ($rep_condition == "leadassigncontactponoaccpt"){ 

			if ($sales_rescue_flg == "Need Boxes") {?>

				<tr>

					<td colspan="15" align="center" bgcolor="#D9F2FF"><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>Lead is Quoted, No Deal Yet</b></font></td>

				</tr>

			<?php } else { ?>

				<tr>

					<td colspan="15" align="center" bgcolor="#D9F2FF"><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>Lead has PO Sent, No Acceptance Yet</b></font></td>

				</tr>

		<?php 	}

		} ?>



		<?php if ($rep_condition == "leadassigncontactpoaccpt"){ 

			if ($sales_rescue_flg == "Need Boxes") {?>

				<tr>

					<td colspan="15" align="center" bgcolor="#D9F2FF"><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>Leads Where Quote is WON</b></font></td>

				</tr>

			<?php } else { ?>

				<tr>

					<td colspan="15" align="center" bgcolor="#D9F2FF"><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>Leads Where PO is ACCEPTED</b></font></td>

				</tr>

		<?php 	}

		} ?>



		<?php if ($rep_condition == "leadassigncontactporeject"){ 

			if ($sales_rescue_flg == "Need Boxes") {?>

				<tr>

					<td colspan="15" align="center" bgcolor="#D9F2FF"><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>Leads Where Quote is LOST</b></font></td>

				</tr>

			<?php } else { ?>

				<tr>

					<td colspan="15" align="center" bgcolor="#D9F2FF"><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>Leads Where PO was REJECTED</b></font></td>

				</tr>

		<?php 	}

		} ?>



		<?php if ($rep_condition == "leadunassign"){ 

			if ($sales_rescue_flg == "Need Boxes") {?>

				<tr>

					<td colspan="15" align="center" bgcolor="#D9F2FF"><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>Lead is Unqualified</b></font></td>

				</tr>

			<?php } else { ?>

				<tr>

					<td colspan="15" align="center" bgcolor="#D9F2FF"><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>Lead is Unqualified</b></font></td>

				</tr>

		<?php 	}

		} ?>

		

		<tr>

			<td bgcolor="#D9F2FF" align="center"><font size="1" face="Arial, Helvetica, sans-serif" width="bold" color="#333333">Sr. No.</font></td>

			<td bgcolor="#D9F2FF" align="center"><font size="1" face="Arial, Helvetica, sans-serif" color="#333333">Assigned To</td>

			<td width="5%" bgcolor="#D9F2FF"><font size="1" face="Arial, Helvetica, sans-serif" color="#333333">Age</font></td>

			<td width="21%" bgcolor="#D9F2FF"><font size="1" face="Arial, Helvetica, sans-serif" color="#333333">Company Name</font></td>

			<td bgcolor="#D9F2FF" align="center"><font size="1" face="Arial, Helvetica, sans-serif" color="#333333">Status</font></td>

			<td bgcolor="#D9F2FF" align="center"><font size="1" face="Arial, Helvetica, sans-serif" color="#333333">Lead Came From</font></td>



			<?php if ($rep_condition == "leadassigncontactponoaccpt"){ ?>

				<td bgcolor="#D9F2FF" align="center"><font size="1" face="Arial, Helvetica, sans-serif" color="#333333">Quote File</font></td>

			<?php } ?>

			<?php if ($rep_condition == "leadassigncontactpoaccpt"){ ?>

				<td bgcolor="#D9F2FF" align="center"><font size="1" face="Arial, Helvetica, sans-serif" color="#333333">Quote File</font></td>

				<td bgcolor="#D9F2FF" align="center"><font size="1" face="Arial, Helvetica, sans-serif" color="#333333">Transaction</font></td>

			<?php } ?>



			<?php if ($rep_condition == "leadassigncontactporeject"){ ?>

				<td bgcolor="#D9F2FF" align="center"><font size="1" face="Arial, Helvetica, sans-serif" color="#333333">Quote File</font></td>

				<td bgcolor="#D9F2FF" align="center"><font size="1" face="Arial, Helvetica, sans-serif" color="#333333">Reason Quote Lost</font></td>

			<?php } ?>



			<td bgcolor="#D9F2FF" align="center"><font size="1" face="Arial, Helvetica, sans-serif" color="#333333">Next Step</font></td>

			<td bgcolor="#D9F2FF" align="center"><font size="1" face="Arial, Helvetica, sans-serif" color="#333333">Last<br>Communication</font></td>

			<td bgcolor="#D9F2FF" align="center"><font size="1" face="Arial, Helvetica, sans-serif" color="#333333">Next Communication</font></td>

		</tr>

	<?php

	 $forbillto_sellto = ""; $main_cnt = 0;

	 

	if ($x != "") {
		db_b2b();
		$data_res = db_query($x);

		while ($data = array_shift($data_res)) {

		if ($data["haveNeed"] == "Need Boxes"){

			$rowcolor = "#E4E4E4";

		}else{

			$rowcolor = "#bcf5bc";

		}

		$forbillto_sellto = $forbillto_sellto  . $data["I"] . ", ";

		$nickname = getnickname($data["CO"], $data["I"]);

		$status_txt = "";

		$crm_db = "SELECT name FROM status where id = " . $data["status"];
		db_b2b();
		$crm_result = db_query($crm_db);

		while ($crm_data = array_shift($crm_result)) {

			$status_txt = $crm_data["name"];

		}

		$internal_flg = "no"; $lead_from_str = "";

		$crm_db = "SELECT companyID FROM CRM where companyID = " . $data["I"] . " and message like '%via internal landing page%'";
		db_b2b();
		$crm_result = db_query($crm_db);

		while ($crm_data = array_shift($crm_result)) {

			$internal_flg = "yes";

		}

		if ($data["howHear"] == ""){

			if ($internal_flg == "yes"){

				$lead_from_str = "Internal";

			}else{

				$lead_from_str = "External";

			}

		}else{

			if ($internal_flg == "yes"){

				$lead_from_str = "Internal: " . $data["howHear"];

			}else{

				$lead_from_str = "External: " . $data["howHear"];

			}

		}	

		$user_inactive = "no";

		$crm_db = "SELECT initials FROM loop_employees where initials = '" . $data["EI"] . "' and status = 'Inactive'";
		db();
		$crm_result = db_query($crm_db);

		while ($crm_data = array_shift($crm_result)) {

			$user_inactive = "yes";

		}

		$assign_str = "";

		if ($data["EI"] == "" || $user_inactive == "yes" || $data["EI"] == "MM"){

			if ($data["EI"] == ""){

				$assign_str = "<font face='Arial, Helvetica, sans-serif' size='1' color='red'>Not Assign</font>";

				$tot_lead_not_assign = $tot_lead_not_assign + 1; 

			}else{

				$assign_str = "<font face='Arial, Helvetica, sans-serif' size='1' color='red'>" . $data["EI"] . "</font>";

			}

		}else{

			$tot_lead_assign = $tot_lead_assign + 1; 

			$assign_str = "<font face='Arial, Helvetica, sans-serif' size='1' color='#333333'>" . $data["EI"] . "</font>";

		}

		if ($data["LD"] == ""){

			$contact_yes_no = "no";

			$last_contact_str = "<font face='Arial, Helvetica, sans-serif' size='1' color='red'>Not contacted</font>";

		}else{

			$contact_yes_no = "yes";

			$last_contact_str = "<font face='Arial, Helvetica, sans-serif' size='1' color='#333333'>" . date('m/d/Y',strtotime($data["LD"])) . "</font>";

		}	

		$skip_rec = "no"; $rec_found = "no"; $quoted_str_yes_no = "";

		if ($rep_condition == "leadnotassign" || $rep_condition == "leadassignbutnotcontact" || $rep_condition == "leadassigncontacttbd" || $rep_condition == "leadassigncontactnopo"){ 

		}else{

			$quoted_str = "<font face='Arial, Helvetica, sans-serif' size='1' color='red'>NO</font>";

			$crm_db = "SELECT filename, quoteDate FROM quote where companyID = '" . $data["I"] . "' order by ID desc limit 1";
			db_b2b();
			$crm_result = db_query($crm_db);

			while ($crm_data = array_shift($crm_result)) {

				$rec_found = "yes";

				$quoted_str_yes_no = "yes";

				

				$archeive_date = new DateTime(date("Y-m-d", strtotime($quotes_archive_date)));

				$quote_date = new DateTime(date("Y-m-d", strtotime($crm_data["quoteDate"])));

				

				if ($quote_date < $archeive_date){

					$quoted_str = "<font face='Arial, Helvetica, sans-serif' size='1' color='#333333'><a id=quotespdf" . $data["I"] . " href='https://usedcardboardboxes.sharepoint.com/:b:/r/sites/LoopsCRMEmailAttachments/Shared%20Documents/quotes/before_oct_18_2022/" . $crm_data["filename"] . "'>YES</a></font>";

				}else{

					$quoted_str = "<font face='Arial, Helvetica, sans-serif' size='1' color='#333333'><a id=quotespdf" . $data["I"] . " href='#' onclick=" . chr(34) . "show_file_inviewer_pos('quotes/" . $crm_data["filename"] . "', 'Quote', 'quotespdf" . $data["I"] . "'); return false;" . chr(34) . " >YES</a></font>";

				}

				

				if ($rep_condition == "leadnotassignnotquoted"){

					$skip_rec = "yes";

				}else{

					

				}

			}

		}	

		

		$quote_lost = "";

		if ($rep_condition == "leadassigncontactporeject"){

			$crm_db = "SELECT qstatus FROM quote where companyID = '" . $data["I"] . "' and qstatus in (3, 4, 5, 6, 7) order by ID desc limit 1";
			db_b2b();
			$crm_result = db_query($crm_db);

			while ($crm_data = array_shift($crm_result)) {

				if ($crm_data["qstatus"] == 3){			

					$quote_lost = "<font face='Arial, Helvetica, sans-serif' size='1' color='#333333'>Lost: Didn't Have Boxes</font>";

				}	

				if ($crm_data["qstatus"] == 4){			

					$quote_lost = "<font face='Arial, Helvetica, sans-serif' size='1' color='#333333'>Lost: Too Expensive</font>";

				}	

				if ($crm_data["qstatus"] == 5){			

					$quote_lost = "<font face='Arial, Helvetica, sans-serif' size='1' color='#333333'>Lost: Bought Elsewhere</font>";

				}	

				if ($crm_data["qstatus"] == 6){			

					$quote_lost = "<font face='Arial, Helvetica, sans-serif' size='1' color='#333333'>Lost: Died on Vine</font>";

				}	

				if ($crm_data["qstatus"] == 7){			

					$quote_lost = "<font face='Arial, Helvetica, sans-serif' size='1' color='#333333'>Lost: Other</font>";

				}	

			}

		}

		

		if ($rep_condition != "leadnotassignnotquoted"){

			$skip_rec = "yes";

		}

		if (($rec_found == "yes") && ($rep_condition != "leadnotassignnotquoted")){

			$skip_rec = "no";

		}

		

		if ($rep_condition == "leadnotassign" || $rep_condition == "leadassignbutnotcontact" || $rep_condition == "leadassigncontacttbd" || 

		$rep_condition == "leadassigncontactnopo" || $rep_condition == "leadassigncontactponoaccpt" || $rep_condition == "leadassigncontactpoaccpt"

		|| $rep_condition == "leadassigncontactporeject" || $rep_condition == "leadunassign"){

			$skip_rec = "no";

		}



		if ($rep_condition == "leadassigncontactpoaccpt"){

			if ($data["LID"] > 0){

				$closeddeal_str = "<font face='Arial, Helvetica, sans-serif' size='1' color='red'>NO</font>";

				$closeddeal_found = "no";

				if ($sales_rescue_flg == "Need Boxes") {

					$crm_db = "SELECT id FROM loop_transaction_buyer where warehouse_id = '" . $data["LID"] . "' order by id desc limit 1";

				}else{

					$crm_db = "SELECT id FROM loop_transaction where warehouse_id = '" . $data["LID"] . "' order by id desc limit 1";

				}				
				db_b2b();
				$crm_result = db_query($crm_db);

				while ($crm_data = array_shift($crm_result)) {

					$closeddeal_found = "yes";

					$tot_deal_made = $tot_deal_made + 1;

					$closeddeal_str = "<font face='Arial, Helvetica, sans-serif' size='1' color='#333333'><a href='viewCompany.php?ID=" . $data["I"] . "&show=transactions&warehouse_id=" . $data["LID"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=" . $data["LID"] . "&rec_id=" . $crm_data["id"] . "&display=seller_view' target='_blank'>YES</a></font>";

				}

			}	

		}

		if ($rep_condition == "leadquoted" && $closeddeal_found == "yes"){

			$skip_rec = "yes";

		}

		if ($rep_condition == "leadcontact" && $contact_yes_no == "yes"){

			$skip_rec = "no";

		}

	
		if ($rep_condition == "leadclosedeal" && $closeddeal_found == "yes"){

			$skip_rec = "no";

		}

		if ($rep_condition == "leadclosedeal" && $closeddeal_found == "no"){

			$skip_rec = "yes";

		}

	
		if ($skip_rec == "no"){

			$tot_lead = $tot_lead + 1; 

			

			if ($quoted_str_yes_no == "yes"){

				$tot_quotes_sent = $tot_quotes_sent + 1; 

			}

			if ($rep_condition == "leadcontact" && $contact_yes_no == "yes"){

				$tot_contact = $tot_contact + 1; 

			}

			$main_cnt = $main_cnt + 1;

	?>

		<tr valign="middle">

			<td  bgcolor="<?php echo $rowcolor ?>" align="center"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?= $main_cnt ?></font></td>



			<td  bgcolor="<?= $rowcolor ?>" align="center"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $assign_str ?></font></td>



			<td width="5%" bgcolor="<?php echo $rowcolor ?>"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php if ($data["LID"] > 0) echo "<b>"; ?><?php echo date_diff_new(
    $data["D"],
    "NOW"
) ?> Days</font></td>

			<td width="21%" bgcolor="<?= $rowcolor ?>"><a target="_blank" href="http://loops.usedcardboardboxes.com/viewCompany.php?ID=<?php echo $data[
    "I"
] ?>"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php if ($data["LID"] > 0) echo "<b>"; ?><?php echo $nickname; ?><?php if ($data["LID"] > 0) echo "</b>"; ?></font></a></td>



			<td width="15%" bgcolor="<?php echo $rowcolor ?>" align="center"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $status_txt ?></font></td>



			<td width="15%" bgcolor="<?php echo $rowcolor ?>" align="center"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $lead_from_str ?></font></td>



			<?php if ($rep_condition == "leadassigncontactponoaccpt"){ ?>

				<td width="15%" bgcolor="<?php echo $rowcolor ?>" align="center"><?php echo $quoted_str ?></td>

			<?php } ?>



			<?php if ($rep_condition == "leadassigncontactpoaccpt"){ ?>

				<td width="15%" bgcolor="<?php echo $rowcolor ?>" align="center"><?php echo $quoted_str ?></td>

				<td width="15%" bgcolor="<?php echo $rowcolor ?>" align="center"><?php echo $closeddeal_str ?></td>

			<?php } ?>



			<?php if ($rep_condition == "leadassigncontactporeject"){ ?>

				<td width="15%" bgcolor="<?php echo $rowcolor ?>" align="center"><?php echo $quoted_str ?></td>

				<td width="15%" bgcolor="<?php echo $rowcolor ?>" align="center"><?php echo $quote_lost ?></td>

			<?php } ?>

			

			<td width="15%" bgcolor="<?php echo $rowcolor ?>" align="center"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php if ($data["LID"] > 0) echo "<b>"; ?><?php echo $data[
    "NS"
] ?></font></td>

			

			<td width="10%" bgcolor="<?php echo $rowcolor ?>" align="center"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $last_contact_str ?></font></td>



			<td width="10%" <?php if ($data["ND"] == date('Y-m-d')) { ?> bgcolor="#00FF00" <?php } elseif ($data["ND"] < date('Y-m-d') && $data["ND"] != "") { ?> bgcolor="#FF0000" <?php } else { ?> bgcolor="<?php echo $rowcolor ?>"  <?php } ?> align="center"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php if ($data["LID"] > 0) echo "<b>"; ?><?php if ($data["ND"]!="") echo date('m/d/Y',strtotime($data["ND"]));?>

			</font></td>

		</tr>



	<?php

		}

	 } // of the inactive or reactive if

?>	

	<tr>

		<td colspan="15" align="right" bgcolor="#D9F2FF"><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>Total = <?php echo $tbl_count;?></b></font></td>

	</tr>

<?php	

	echo "</table>";

	

	}

}

	?>



<?php

//Rescue rec -----------------------------



	$tot_lead = 0; $tot_lead_str = "";

		//

		if($assignid=="all")

		{

			$empqry="";

		}

		else{

			$empqry=" and companyInfo.assignedto= $assignid ";

		}

		

	$main_sql = "Select companyInfo.ID from companyInfo LEFT OUTER JOIN ";

	$main_sql .= " employees ON companyInfo.assignedto = employees.employeeID where (companyInfo.dateCreated >= '" . $date_from_val . "' and companyInfo.dateCreated <= '" . $date_to_val . "') "; 

	$main_sql .= " and companyInfo.haveNeed = 'Have Boxes'" .$empqry . $mm_lead . " GROUP BY companyInfo.ID";
	db_b2b();
	$data_res = db_query($main_sql);

	while ($cnt_data = array_shift($data_res)) {

		$tot_lead = $tot_lead + 1;

		$tot_lead_str = $tot_lead_str . $cnt_data["ID"] . ",";

	}

	if ($tot_lead_str != ""){

		$tot_lead_str = substr($tot_lead_str, 0 , strlen($tot_lead_str)-1);

	}	

	

	$tot_lead_unassign = 0; $tot_lead_unassign_str = "";

	$main_sql = "Select companyInfo.ID from companyInfo LEFT OUTER JOIN ";

	$main_sql .= " employees ON companyInfo.assignedto = employees.employeeID where (companyInfo.dateCreated >= '" . $date_from_val . "' and companyInfo.dateCreated <= '" . $date_to_val . "') "; 

	$main_sql .= " and companyInfo.assignedto = '' and companyInfo.status not in (44, 31) and companyInfo.haveNeed = 'Have Boxes'" .$empqry . $mm_lead . " GROUP BY companyInfo.ID";
	db_b2b();
	$data_res = db_query($main_sql);

	while ($cnt_data = array_shift($data_res)) {

		$tot_lead_unassign = $tot_lead_unassign + 1;

		$tot_lead_unassign_str = $tot_lead_unassign_str . $cnt_data["ID"] . ",";

	}

	if ($tot_lead_unassign_str != ""){

		$tot_lead_unassign_str = substr($tot_lead_unassign_str, 0 , strlen($tot_lead_unassign_str)-1);

	}	

 

	$tot_lead_unassign_not_contact = 0; $tot_lead_unassign_not_contact_str = "";

	$main_sql = "Select companyInfo.ID from companyInfo LEFT OUTER JOIN ";

	$main_sql .= " employees ON companyInfo.assignedto = employees.employeeID where (companyInfo.dateCreated >= '" . $date_from_val . "' and companyInfo.dateCreated <= '" . $date_to_val . "') "; 

	$main_sql .= " and companyInfo.assignedto > 0 and companyInfo.status not in (44, 31) and (last_contact_date = '' or last_contact_date is null) and companyInfo.haveNeed = 'Have Boxes'" . $empqry . $mm_lead . " GROUP BY companyInfo.ID";


	db_b2b();
	$data_res = db_query($main_sql);

	while ($cnt_data = array_shift($data_res)) {
		
			$tot_lead_unassign_not_contact = $tot_lead_unassign_not_contact + 1;

			$tot_lead_unassign_not_contact_str = $tot_lead_unassign_not_contact_str . $cnt_data["ID"] . ",";
	}

	if ($tot_lead_unassign_not_contact_str != ""){

		$tot_lead_unassign_not_contact_str = substr($tot_lead_unassign_not_contact_str, 0 , strlen($tot_lead_unassign_not_contact_str)-1);

	}

	$tot_lead_assign_contact_tbd = 0; $tot_lead_assign_contact_tbd_str = "";

	$main_sql = "Select companyInfo.ID from companyInfo LEFT OUTER JOIN ";

	$main_sql .= " employees ON companyInfo.assignedto = employees.employeeID where (companyInfo.dateCreated >= '" . $date_from_val . "' and companyInfo.dateCreated <= '" . $date_to_val . "') "; 

	$main_sql .= " and companyInfo.assignedto > 0 and companyInfo.status = 6 and last_contact_date <> '' and companyInfo.haveNeed = 'Have Boxes'" .$empqry . $mm_lead . " GROUP BY companyInfo.ID";;
	db_b2b();
	$data_res = db_query($main_sql);

	while ($cnt_data = array_shift($data_res)) {

			$tot_lead_assign_contact_tbd = $tot_lead_assign_contact_tbd + 1;

			$tot_lead_assign_contact_tbd_str = $tot_lead_assign_contact_tbd_str . $cnt_data["ID"] . ",";
	}

	if ($tot_lead_assign_contact_tbd_str != ""){

		$tot_lead_assign_contact_tbd_str = substr($tot_lead_assign_contact_tbd_str, 0 , strlen($tot_lead_assign_contact_tbd_str)-1);

	}

	

	$tot_lead_assign_contact_nopo = 0; $tot_lead_assign_contact_nopo_str = "";

	$main_sql = "Select companyInfo.ID from companyInfo LEFT OUTER JOIN ";

	$main_sql .= " employees ON companyInfo.assignedto = employees.employeeID where (companyInfo.dateCreated >= '" . $date_from_val . "' and companyInfo.dateCreated <= '" . $date_to_val . "') "; 

	$main_sql .= " and companyInfo.assignedto > 0 and companyInfo.status not in (44, 31, 6) and last_contact_date <> '' and companyInfo.haveNeed = 'Have Boxes'" .$empqry . $mm_lead . " GROUP BY companyInfo.ID";

	db_b2b();
	$data_res = db_query($main_sql);

	while ($cnt_data = array_shift($data_res)) {

			$rec_found = "n";	
			db_b2b();
			$data_res2 = db_query("Select companyID from quote where companyID =" . $cnt_data["ID"] . " group by companyID");

			while ($cnt_data2 = array_shift($data_res2)) {

				$rec_found = "y";

			}			

			if ($rec_found == "n")

			{

				$tot_lead_assign_contact_nopo = $tot_lead_assign_contact_nopo + 1;

				$tot_lead_assign_contact_nopo_str = $tot_lead_assign_contact_nopo_str . $cnt_data["ID"] . ",";

			}	

		//}

	}

	if ($tot_lead_assign_contact_nopo_str != ""){

		$tot_lead_assign_contact_nopo_str = substr($tot_lead_assign_contact_nopo_str, 0 , strlen($tot_lead_assign_contact_nopo_str)-1);

	}

// tro chk

	

	$tot_lead_assign_contact_po_noaccpt = 0; $tot_lead_assign_contact_po_noaccpt_str = "";

	$main_sql = "Select companyInfo.ID from companyInfo LEFT OUTER JOIN ";

	$main_sql .= " employees ON companyInfo.assignedto = employees.employeeID where (companyInfo.dateCreated >= '" . $date_from_val . "' and companyInfo.dateCreated <= '" . $date_to_val . "') "; 

	$main_sql .= " and companyInfo.assignedto > 0 and companyInfo.status not in (44, 31, 6) and last_contact_date <> '' and companyInfo.haveNeed = 'Have Boxes'" .$empqry . $mm_lead . " GROUP BY companyInfo.ID";

	db_b2b();
	$data_res = db_query($main_sql);

	while ($cnt_data = array_shift($data_res)) {

			$rec_found = "n";	
			db_b2b();
			$data_res2 = db_query("Select qstatus from quote where companyID =" . $cnt_data["ID"] . " group by companyID");

			while ($cnt_data2 = array_shift($data_res2)) {

				$rec_found = "y";

				if ($cnt_data2["qstatus"] == 8)

				{

					$rec_found = "n";

					break;

				}	

			}			

			if ($rec_found == "y")
			{

				$tot_lead_assign_contact_po_noaccpt = $tot_lead_assign_contact_po_noaccpt + 1;

				$tot_lead_assign_contact_po_noaccpt_str = $tot_lead_assign_contact_po_noaccpt_str . $cnt_data["ID"] . ",";

			}	

	}

	if ($tot_lead_assign_contact_po_noaccpt_str != ""){

		$tot_lead_assign_contact_po_noaccpt_str = substr($tot_lead_assign_contact_po_noaccpt_str, 0 , strlen($tot_lead_assign_contact_po_noaccpt_str)-1);

	}

	$tot_lead_assign_contact_po_accpt = 0; $tot_lead_assign_contact_po_accpt_str = "";

	$main_sql = "Select companyInfo.ID, companyInfo.loopid from companyInfo LEFT OUTER JOIN ";

	$main_sql .= " employees ON companyInfo.assignedto = employees.employeeID where (companyInfo.dateCreated >= '" . $date_from_val . "' and companyInfo.dateCreated <= '" . $date_to_val . "') "; 

	$main_sql .= " and companyInfo.assignedto > 0 and companyInfo.status not in (44, 31, 6) and last_contact_date <> '' and companyInfo.haveNeed = 'Have Boxes'" .$empqry . $mm_lead . " GROUP BY companyInfo.ID";


	db_b2b();
	$data_res = db_query($main_sql);

	while ($cnt_data = array_shift($data_res)) {

			$rec_found = "n";	

			if ($cnt_data["loopid"] > 0){
				db();
				$data_res2 = db_query("SELECT id FROM loop_transaction where warehouse_id = " . $cnt_data["loopid"] . " order by id desc limit 1");

				while ($cnt_data2 = array_shift($data_res2)) {

					$rec_found = "y";

				}			

			}	

			if ($rec_found == "y")

			{

				$tot_lead_assign_contact_po_accpt = $tot_lead_assign_contact_po_accpt + 1;

				$tot_lead_assign_contact_po_accpt_str = $tot_lead_assign_contact_po_accpt_str . $cnt_data["ID"] . ",";

			}	

		//}

	}

	if ($tot_lead_assign_contact_po_accpt_str != ""){

		$tot_lead_assign_contact_po_accpt_str = substr($tot_lead_assign_contact_po_accpt_str, 0 , strlen($tot_lead_assign_contact_po_accpt_str)-1);

	}	

	

	$tot_lead_assign_contact_po_reject = 0; $tot_lead_assign_contact_po_reject_str = "";

	$main_sql = "Select companyInfo.ID from companyInfo LEFT OUTER JOIN ";

	$main_sql .= " employees ON companyInfo.assignedto = employees.employeeID where (companyInfo.dateCreated >= '" . $date_from_val . "' and companyInfo.dateCreated <= '" . $date_to_val . "') "; 

	$main_sql .= " and companyInfo.assignedto > 0 and companyInfo.status not in (44, 31, 6) and last_contact_date <> '' and companyInfo.haveNeed = 'Have Boxes'" .$empqry . $mm_lead . " GROUP BY companyInfo.ID";
;
	db_b2b();
	$data_res = db_query($main_sql);

	while ($cnt_data = array_shift($data_res)) {

			$rec_found = "n";	
			db_b2b();
			$data_res2 = db_query("Select qstatus from quote where companyID =" . $cnt_data["ID"] . " group by qstatus");

			while ($cnt_data2 = array_shift($data_res2)) {

				if ($cnt_data2["qstatus"] == 3 || $cnt_data2["qstatus"] == 4 || $cnt_data2["qstatus"] == 5 || $cnt_data2["qstatus"] == 6 || $cnt_data2["qstatus"] == 7)

				{

					$rec_found = "y";

				}	

				if ($cnt_data2["qstatus"] == 8 || $cnt_data2["qstatus"] == 1 || $cnt_data2["qstatus"] == 10 || $cnt_data2["qstatus"] == 11)

				{

					$rec_found = "n";

					break;

				}	

			}			

			if ($rec_found == "y")

			{

				$tot_lead_assign_contact_po_reject = $tot_lead_assign_contact_po_reject + 1;

				$tot_lead_assign_contact_po_reject_str = $tot_lead_assign_contact_po_reject_str . $cnt_data["ID"] . ",";

			}	

		//}

	}

	if ($tot_lead_assign_contact_po_reject_str != ""){

		$tot_lead_assign_contact_po_reject_str = substr($tot_lead_assign_contact_po_reject_str, 0 , strlen($tot_lead_assign_contact_po_reject_str)-1);

	}	

	

	$tot_lead_unqual = 0; $tot_lead_unqual_str = "";

	$main_sql = "Select companyInfo.ID from companyInfo LEFT OUTER JOIN ";

	$main_sql .= " employees ON companyInfo.assignedto = employees.employeeID where (companyInfo.dateCreated >= '" . $date_from_val . "' and companyInfo.dateCreated <= '" . $date_to_val . "') "; 

	$main_sql .= " and companyInfo.status in (44, 31) and companyInfo.haveNeed = 'Have Boxes'" .$empqry . $mm_lead . " GROUP BY companyInfo.ID";

		
	db_b2b();
	$data_res = db_query($main_sql);

	while ($cnt_data = array_shift($data_res)) {

		$tot_lead_unqual = $tot_lead_unqual + 1;

		$tot_lead_unqual_str = $tot_lead_unqual_str . $cnt_data["ID"] . ",";

	}

	if ($tot_lead_unqual_str != ""){

		$tot_lead_unqual_str = substr($tot_lead_unqual_str, 0 , strlen($tot_lead_unqual_str)-1);

	}	

//Rescue rec -----------------------------

	

?>

	<div id="divpurchasing" style="float: left; margin-right: 50px;">

		<h2>PURCHASING</h2>

		

			<table>

				<tr bgcolor="#D9F2FF">

					<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>Total Leads Into System</b></font></td>

					<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b><?php echo $tot_lead;?></b></font></td>

				</tr>

				<tr bgcolor="#D9F2FF">

					<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>Unassigned</b></font></td>

					<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b><?php echo $tot_lead_unassign;?></b></font></td>

				</tr>

				<tr bgcolor="#D9F2FF"> 

					<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>Assigned, But Not Contacted</b></font></td>

					<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b><?php echo $tot_lead_unassign_not_contact;?></b></font></td>

				</tr>

				<tr bgcolor="#D9F2FF">

					<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>Contacted, Still Need to Qualify</b></font></td>

					<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b><?php echo $tot_lead_assign_contact_tbd;?></b></font></td>

				</tr>

				<tr bgcolor="#D9F2FF">

					<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>Qualified, But No PO Sent</b></font></td>

					<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b><?php echo $tot_lead_assign_contact_nopo;?></b></font></td>

				</tr>

				<tr bgcolor="#D9F2FF">

					<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>PO Sent, No Acceptance Yet</b></font></td>

					<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b><?php echo $tot_lead_assign_contact_po_noaccpt;?></b></font></td>

				</tr>

				<tr bgcolor="#D9F2FF">

					<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>PO Won</b></font></td>

					<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b><?php echo $tot_lead_assign_contact_po_accpt;?></b></font></td>

				</tr>

				<tr bgcolor="#D9F2FF">

					<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>PO Lost</b></font></td>

					<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b><?php echo $tot_lead_assign_contact_po_reject;?></b></font></td>

				</tr>

				<tr bgcolor="#D9F2FF">

					<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>Unqualified</b></font></td>

					<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b><?php echo $tot_lead_unqual;?></b></font></td>

				</tr>

			</table>

		</font>

		<br>



		<?php getreportdata($eid , $_REQUEST["so"], $_REQUEST["sk"], $assignid, $date_from_val, $date_to_val, "leadnotassign", 'Have Boxes', $tot_lead_unassign_str, $tot_lead_unassign, $_REQUEST["chk_show_mm_lead"]); ?>

		<br>

		<?php 	getreportdata($eid , $_REQUEST["so"], $_REQUEST["sk"], $assignid, $date_from_val, $date_to_val, "leadassignbutnotcontact", 'Have Boxes', $tot_lead_unassign_not_contact_str, $tot_lead_unassign_not_contact, $_REQUEST["chk_show_mm_lead"]); ?>		

		<br>

		<?php getreportdata($eid , $_REQUEST["so"], $_REQUEST["sk"], $assignid, $date_from_val, $date_to_val, "leadassigncontacttbd", 'Have Boxes', $tot_lead_assign_contact_tbd_str, $tot_lead_assign_contact_tbd, $_REQUEST["chk_show_mm_lead"]); ?>		

		<br>

		<?php getreportdata($eid , $_REQUEST["so"], $_REQUEST["sk"], $assignid, $date_from_val, $date_to_val, "leadassigncontactnopo", 'Have Boxes', $tot_lead_assign_contact_nopo_str, $tot_lead_assign_contact_nopo, $_REQUEST["chk_show_mm_lead"]); ?>		

		<br>

		<?php getreportdata($eid , $_REQUEST["so"], $_REQUEST["sk"], $assignid, $date_from_val, $date_to_val, "leadassigncontactponoaccpt", 'Have Boxes', $tot_lead_assign_contact_po_noaccpt_str, $tot_lead_assign_contact_po_noaccpt, $_REQUEST["chk_show_mm_lead"]); ?>		

		<br>

		<?php getreportdata($eid , $_REQUEST["so"], $_REQUEST["sk"], $assignid, $date_from_val, $date_to_val, "leadassigncontactpoaccpt", 'Have Boxes', $tot_lead_assign_contact_po_accpt_str, $tot_lead_assign_contact_po_accpt, $_REQUEST["chk_show_mm_lead"]); ?>		

		<br>

		<?php getreportdata($eid , $_REQUEST["so"], $_REQUEST["sk"], $assignid, $date_from_val, $date_to_val, "leadassigncontactporeject", 'Have Boxes', $tot_lead_assign_contact_po_reject_str, $tot_lead_assign_contact_po_reject, $_REQUEST["chk_show_mm_lead"]); ?>		

		<br>

		<?php getreportdata($eid , $_REQUEST["so"], $_REQUEST["sk"], $assignid, $date_from_val, $date_to_val, "leadunassign", 'Have Boxes', $tot_lead_unqual_str, $tot_lead_unqual, $_REQUEST["chk_show_mm_lead"]); ?>		

		

	</div>



	<?php

	//Sales rec -----------------------------

		$tot_lead = 0; $tot_lead_str = "";

		$main_sql = "Select companyInfo.ID from companyInfo LEFT OUTER JOIN ";

		$main_sql .= " employees ON companyInfo.assignedto = employees.employeeID where (companyInfo.dateCreated >= '" . $date_from_val . "' and companyInfo.dateCreated <= '" . $date_to_val . "') "; 

		$main_sql .= " and companyInfo.haveNeed = 'Need Boxes'" .$empqry . $mm_lead . " GROUP BY companyInfo.ID";
		db_b2b();
		$data_res = db_query($main_sql);

		while ($cnt_data = array_shift($data_res)) {

			$tot_lead = $tot_lead + 1;

			$tot_lead_str = $tot_lead_str . $cnt_data["ID"] . ",";

		}

		if ($tot_lead_str != ""){

			$tot_lead_str = substr($tot_lead_str, 0 , strlen($tot_lead_str)-1);

		}	

		

		$tot_lead_unassign = 0; $tot_lead_unassign_str = "";

		$main_sql = "Select companyInfo.ID from companyInfo LEFT OUTER JOIN ";

		$main_sql .= " employees ON companyInfo.assignedto = employees.employeeID where (companyInfo.dateCreated >= '" . $date_from_val . "' and companyInfo.dateCreated <= '" . $date_to_val . "') "; 

		$main_sql .= " and companyInfo.assignedto = '' and companyInfo.status not in (43, 31) and companyInfo.haveNeed = 'Need Boxes'" .$empqry . $mm_lead . " GROUP BY companyInfo.ID";
		db_b2b();
		$data_res = db_query($main_sql);

		while ($cnt_data = array_shift($data_res)) {

			$tot_lead_unassign = $tot_lead_unassign + 1;

			$tot_lead_unassign_str = $tot_lead_unassign_str . $cnt_data["ID"] . ",";

		}

		if ($tot_lead_unassign_str != ""){

			$tot_lead_unassign_str = substr($tot_lead_unassign_str, 0 , strlen($tot_lead_unassign_str)-1);

		}	

	 

		$tot_lead_unassign_not_contact = 0; $tot_lead_unassign_not_contact_str = "";

		$main_sql = "Select companyInfo.ID from companyInfo LEFT OUTER JOIN ";

		$main_sql .= " employees ON companyInfo.assignedto = employees.employeeID where (companyInfo.dateCreated >= '" . $date_from_val . "' and companyInfo.dateCreated <= '" . $date_to_val . "') "; 

		$main_sql .= " and companyInfo.assignedto > 0 and companyInfo.status not in (43, 31) and last_contact_date is null and companyInfo.haveNeed = 'Need Boxes'" .$empqry . $mm_lead . " GROUP BY companyInfo.ID";

	
		db_b2b();
		$data_res = db_query($main_sql);

		while ($cnt_data = array_shift($data_res)) {

				$tot_lead_unassign_not_contact = $tot_lead_unassign_not_contact + 1;

				$tot_lead_unassign_not_contact_str = $tot_lead_unassign_not_contact_str . $cnt_data["ID"] . ",";

		}

		if ($tot_lead_unassign_not_contact_str != ""){

			$tot_lead_unassign_not_contact_str = substr($tot_lead_unassign_not_contact_str, 0 , strlen($tot_lead_unassign_not_contact_str)-1);

		}

		$tot_lead_assign_contact_tbd = 0; $tot_lead_assign_contact_tbd_str = "";

		$main_sql = "Select companyInfo.ID from companyInfo LEFT OUTER JOIN ";

		$main_sql .= " employees ON companyInfo.assignedto = employees.employeeID where (companyInfo.dateCreated >= '" . $date_from_val . "' and companyInfo.dateCreated <= '" . $date_to_val . "') "; 

		$main_sql .= " and companyInfo.assignedto > 0 and companyInfo.status = 3 and last_contact_date <> '' and companyInfo.haveNeed = 'Need Boxes'" .$empqry . $mm_lead . " GROUP BY companyInfo.ID";

		db_b2b();
		$data_res = db_query($main_sql);

		while ($cnt_data = array_shift($data_res)) {

				$tot_lead_assign_contact_tbd = $tot_lead_assign_contact_tbd + 1;

				$tot_lead_assign_contact_tbd_str = $tot_lead_assign_contact_tbd_str . $cnt_data["ID"] . ",";

		}

		if ($tot_lead_assign_contact_tbd_str != ""){

			$tot_lead_assign_contact_tbd_str = substr($tot_lead_assign_contact_tbd_str, 0 , strlen($tot_lead_assign_contact_tbd_str)-1);

		}

		

		$tot_lead_assign_contact_nopo = 0; $tot_lead_assign_contact_nopo_str = "";

		$main_sql = "Select companyInfo.ID from companyInfo LEFT OUTER JOIN ";

		$main_sql .= " employees ON companyInfo.assignedto = employees.employeeID where (companyInfo.dateCreated >= '" . $date_from_val . "' and companyInfo.dateCreated <= '" . $date_to_val . "') "; 

		$main_sql .= " and companyInfo.assignedto > 0 and companyInfo.status not in (43, 31, 3) and last_contact_date <> '' and companyInfo.haveNeed = 'Need Boxes'" .$empqry . $mm_lead . " GROUP BY companyInfo.ID";

		db_b2b();
		$data_res = db_query($main_sql);

		while ($cnt_data = array_shift($data_res)) {

				$rec_found = "n";	
				db_b2b();
				$data_res2 = db_query("Select companyID from quote where companyID =" . $cnt_data["ID"] . " group by companyID");

				while ($cnt_data2 = array_shift($data_res2)) {

					$rec_found = "y";

				}			

				if ($rec_found == "n")

				{

					$tot_lead_assign_contact_nopo = $tot_lead_assign_contact_nopo + 1;

					$tot_lead_assign_contact_nopo_str = $tot_lead_assign_contact_nopo_str . $cnt_data["ID"] . ",";

				}	

			//}

		}

		if ($tot_lead_assign_contact_nopo_str != ""){

			$tot_lead_assign_contact_nopo_str = substr($tot_lead_assign_contact_nopo_str, 0 , strlen($tot_lead_assign_contact_nopo_str)-1);

		}

	// tro chk

		

		$tot_lead_assign_contact_po_noaccpt = 0; $tot_lead_assign_contact_po_noaccpt_str = "";

		$main_sql = "Select companyInfo.ID from companyInfo LEFT OUTER JOIN ";

		$main_sql .= " employees ON companyInfo.assignedto = employees.employeeID where (companyInfo.dateCreated >= '" . $date_from_val . "' and companyInfo.dateCreated <= '" . $date_to_val . "') "; 

		$main_sql .= " and companyInfo.assignedto > 0 and companyInfo.status not in (43, 31, 3) and last_contact_date <> '' and companyInfo.haveNeed = 'Need Boxes'" .$empqry . $mm_lead . " GROUP BY companyInfo.ID";


		db_b2b();
		$data_res = db_query($main_sql);

		while ($cnt_data = array_shift($data_res)) {

				$rec_found = "n";	
				db_b2b();
				$data_res2 = db_query("Select qstatus from quote where companyID =" . $cnt_data["ID"] . " group by companyID");

				while ($cnt_data2 = array_shift($data_res2)) {

					$rec_found = "y";

					if ($cnt_data2["qstatus"] == 8)

					{

						$rec_found = "n";

						break;

					}	

				}			

				if ($rec_found == "y")

				{

					$tot_lead_assign_contact_po_noaccpt = $tot_lead_assign_contact_po_noaccpt + 1;

					$tot_lead_assign_contact_po_noaccpt_str = $tot_lead_assign_contact_po_noaccpt_str . $cnt_data["ID"] . ",";

				}	

			//}

		}

		if ($tot_lead_assign_contact_po_noaccpt_str != ""){

			$tot_lead_assign_contact_po_noaccpt_str = substr($tot_lead_assign_contact_po_noaccpt_str, 0 , strlen($tot_lead_assign_contact_po_noaccpt_str)-1);

		}

		

		$tot_lead_assign_contact_po_accpt = 0; $tot_lead_assign_contact_po_accpt_str = "";

		$main_sql = "Select companyInfo.ID, companyInfo.loopid from companyInfo LEFT OUTER JOIN ";

		$main_sql .= " employees ON companyInfo.assignedto = employees.employeeID where (companyInfo.dateCreated >= '" . $date_from_val . "' and companyInfo.dateCreated <= '" . $date_to_val . "') "; 

		$main_sql .= " and companyInfo.assignedto > 0 and companyInfo.status not in (43, 31, 3) and last_contact_date <> '' and companyInfo.haveNeed = 'Need Boxes'" .$empqry . $mm_lead . " GROUP BY companyInfo.ID";


		db_b2b();
		$data_res = db_query($main_sql);

		while ($cnt_data = array_shift($data_res)) {

				$rec_found = "n";	

				if ($cnt_data["loopid"] > 0){
					db();
					$data_res2 = db_query("SELECT id FROM loop_transaction_buyer where warehouse_id = " . $cnt_data["loopid"] . " order by id desc limit 1");

					while ($cnt_data2 = array_shift($data_res2)) {

						$rec_found = "y";

					}			

				}	

				if ($rec_found == "y")

				{

					$tot_lead_assign_contact_po_accpt = $tot_lead_assign_contact_po_accpt + 1;

					$tot_lead_assign_contact_po_accpt_str = $tot_lead_assign_contact_po_accpt_str . $cnt_data["ID"] . ",";

				}	

			//}

		}

		if ($tot_lead_assign_contact_po_accpt_str != ""){

			$tot_lead_assign_contact_po_accpt_str = substr($tot_lead_assign_contact_po_accpt_str, 0 , strlen($tot_lead_assign_contact_po_accpt_str)-1);

		}	

		

		$tot_lead_assign_contact_po_reject = 0; $tot_lead_assign_contact_po_reject_str = "";

		$main_sql = "Select companyInfo.ID from companyInfo LEFT OUTER JOIN ";

		$main_sql .= " employees ON companyInfo.assignedto = employees.employeeID where (companyInfo.dateCreated >= '" . $date_from_val . "' and companyInfo.dateCreated <= '" . $date_to_val . "') "; 

		$main_sql .= " and companyInfo.assignedto > 0 and companyInfo.status not in (43, 31, 3) and last_contact_date <> '' and companyInfo.haveNeed = 'Need Boxes'" .$empqry . $mm_lead . " GROUP BY companyInfo.ID";

		db_b2b();
		$data_res = db_query($main_sql);

		while ($cnt_data = array_shift($data_res)) {
				$rec_found = "n";	
				db_b2b();
				$data_res2 = db_query("Select qstatus from quote where companyID =" . $cnt_data["ID"] . " group by qstatus");

				while ($cnt_data2 = array_shift($data_res2)) {

					if ($cnt_data2["qstatus"] == 3 || $cnt_data2["qstatus"] == 4 || $cnt_data2["qstatus"] == 5 || $cnt_data2["qstatus"] == 6 || $cnt_data2["qstatus"] == 7)

					{

						$rec_found = "y";

					}	

					if ($cnt_data2["qstatus"] == 8 || $cnt_data2["qstatus"] == 1 || $cnt_data2["qstatus"] == 10 || $cnt_data2["qstatus"] == 11)

					{

						$rec_found = "n";

						break;

					}	

				}			

				if ($rec_found == "y")

				{

					$tot_lead_assign_contact_po_reject = $tot_lead_assign_contact_po_reject + 1;

					$tot_lead_assign_contact_po_reject_str = $tot_lead_assign_contact_po_reject_str . $cnt_data["ID"] . ",";

				}	

			//}

		}

		if ($tot_lead_assign_contact_po_reject_str != ""){

			$tot_lead_assign_contact_po_reject_str = substr($tot_lead_assign_contact_po_reject_str, 0 , strlen($tot_lead_assign_contact_po_reject_str)-1);

		}	

		

		$tot_lead_unqual = 0; $tot_lead_unqual_str = "";

		$main_sql = "Select companyInfo.ID from companyInfo LEFT OUTER JOIN ";

		$main_sql .= " employees ON companyInfo.assignedto = employees.employeeID where (companyInfo.dateCreated >= '" . $date_from_val . "' and companyInfo.dateCreated <= '" . $date_to_val . "') "; 

		$main_sql .= " and companyInfo.status in (43, 31) and companyInfo.haveNeed = 'Need Boxes'" .$empqry . $mm_lead . " GROUP BY companyInfo.ID";

		db_b2b();
		$data_res = db_query($main_sql);

		while ($cnt_data = array_shift($data_res)) {

			$tot_lead_unqual = $tot_lead_unqual + 1;

			$tot_lead_unqual_str = $tot_lead_unqual_str . $cnt_data["ID"] . ",";

		}

		if ($tot_lead_unqual_str != ""){

			$tot_lead_unqual_str = substr($tot_lead_unqual_str, 0 , strlen($tot_lead_unqual_str)-1);

		}	



	//Sales rec -----------------------------	

	

	?>

	<div id="divsales" style="flaot:right; margin-left: 700px;">

		<h2>SALES</h2>

		

		<table>

			<tr bgcolor="#D9F2FF">

				<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>Total Leads Into System</b></font></td>

				<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b><?php echo $tot_lead;?></b></font></td>

			</tr>

			<tr bgcolor="#D9F2FF">

				<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>Unassigned</b></font></td>

				<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b><?php echo $tot_lead_unassign;?></b></font></td>

			</tr>

			<tr bgcolor="#D9F2FF"> 

				<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>Assigned, But Not Contacted</b></font></td>

				<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>php echo $tot_lead_unassign_not_contact;?></b></font></td>

			</tr>

			<tr bgcolor="#D9F2FF">

				<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>Contacted, Still Need to Qualify</b></font></td>

				<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b><?php echo $tot_lead_assign_contact_tbd;?></b></font></td>

			</tr>

			<tr bgcolor="#D9F2FF">

				<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>Qualified, Not Quoted</b></font></td>

				<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b><?php echo $tot_lead_assign_contact_nopo;?></b></font></td>

			</tr>

			<tr bgcolor="#D9F2FF">

				<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>Quoted, No Deal Yet</b></font></td>

				<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b><?php echo $tot_lead_assign_contact_po_noaccpt;?></b></font></td>

			</tr>

			<tr bgcolor="#D9F2FF">

				<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>Quote Won</b></font></td>

				<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b><?php echo $tot_lead_assign_contact_po_accpt;?></b></font></td>

			</tr>

			<tr bgcolor="#D9F2FF">

				<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>Quote Lost</b></font></td>

				<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b><?php echo $tot_lead_assign_contact_po_reject;?></b></font></td>

			</tr>

			<tr bgcolor="#D9F2FF">

				<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b>Unqualified</b></font></td>

				<td><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b><?php echo $tot_lead_unqual;?></b></font></td>

			</tr>

		</table>

		<br>

		

		<?php getreportdata($eid , $_REQUEST["so"], $_REQUEST["sk"], $assignid, $date_from_val,  $date_to_val, "leadnotassign", 'Need Boxes', $tot_lead_unassign_str, $tot_lead_unassign, $_REQUEST["chk_show_mm_lead"]); ?>

		<br>

		<?php 	getreportdata($eid , $_REQUEST["so"], $_REQUEST["sk"], $assignid, $date_from_val, $date_to_val, "leadassignbutnotcontact", 'Need Boxes', $tot_lead_unassign_not_contact_str, $tot_lead_unassign_not_contact, $_REQUEST["chk_show_mm_lead"]); ?>		

		<br>

		<?php getreportdata($eid , $_REQUEST["so"], $_REQUEST["sk"], $assignid, $date_from_val, $date_to_val, "leadassigncontacttbd", 'Need Boxes', $tot_lead_assign_contact_tbd_str, $tot_lead_assign_contact_tbd, $_REQUEST["chk_show_mm_lead"]); ?>		

		<br>

		<?php getreportdata($eid , $_REQUEST["so"], $_REQUEST["sk"], $assignid, $date_from_val, $date_to_val, "leadassigncontactnopo", 'Need Boxes', $tot_lead_assign_contact_nopo_str, $tot_lead_assign_contact_nopo, $_REQUEST["chk_show_mm_lead"]); ?>		

		<br>

		<?php getreportdata($eid , $_REQUEST["so"], $_REQUEST["sk"], $assignid, $date_from_val, $date_to_val, "leadassigncontactponoaccpt", 'Need Boxes', $tot_lead_assign_contact_po_noaccpt_str, $tot_lead_assign_contact_po_noaccpt, $_REQUEST["chk_show_mm_lead"]); ?>		

		<br>

		<?php getreportdata($eid , $_REQUEST["so"], $_REQUEST["sk"], $assignid, $date_from_val, $date_to_val, "leadassigncontactpoaccpt", 'Need Boxes', $tot_lead_assign_contact_po_accpt_str, $tot_lead_assign_contact_po_accpt, $_REQUEST["chk_show_mm_lead"]); ?>		

		<br>

		<?php getreportdata($eid , $_REQUEST["so"], $_REQUEST["sk"], $assignid, $date_from_val, $date_to_val, "leadassigncontactporeject", 'Need Boxes', $tot_lead_assign_contact_po_reject_str, $tot_lead_assign_contact_po_reject, $_REQUEST["chk_show_mm_lead"]); ?>		

		<br>

		<?php getreportdata($eid , $_REQUEST["so"], $_REQUEST["sk"], $assignid, $date_from_val, $date_to_val, "leadunassign", 'Need Boxes', $tot_lead_unqual_str, $tot_lead_unqual, $_REQUEST["chk_show_mm_lead"]); ?>		

		</div>
		<?php

			//}
		?>	

 		</div>
	</body>
</html>

