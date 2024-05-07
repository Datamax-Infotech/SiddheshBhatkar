<?php

session_start();

require_once ("inc/header_session.php");
require_once ("../mainfunctions/database.php");
require_once ("../mainfunctions/general-functions.php");
?>
<html>
	<head>
		<title>Purchasing Revenue & Profit Report</title>

	</head>

	<script language="JavaScript" src="inc/CalendarPopup.js"></script><language language="JavaScript" SRC="inc/general.js"></SCRIPT>

	<script language="JavaScript">document.write(getCalendarStyles());</script>

	<script language="JavaScript">

		var cal2xx = new CalendarPopup("listdiv");

		cal2xx.showNavigationDropdowns();

		function set_emp_start_dt(){

			var seloption = document.getElementById('eid');

			var selectedindexforvalue = seloption.options[seloption.selectedIndex];

			var date3 = selectedindexforvalue.getAttribute('data-date');

			document.getElementById('date_from').value = date3;

		}

	
		function loadmainpg(){

			var date_from = document.getElementById('date_from').value;

			var date_to = document.getElementById('date_to').value;

			var seloption = document.getElementById('eid');

			var selectedindexforvalue = seloption.options[seloption.selectedIndex];

			var date3 = selectedindexforvalue.getAttribute('data-date');

			var date4 = document.getElementById('date_tomorrow').value;

			var dformat1 = "yyyy-MM-dd";

			var dformat2 = "yyyy-MM-dd";

			if(date_from !="" && date_to !=""){

				document.b2bpurchasing.submit();

				return true;

			}

		}
	</script> 
	<style>

	.outer-container{

		width: 100%;

		margin: 0 auto;

	}

	.container{

		padding: 10px;

		

	}	

	.content{

		margin: 0 auto;

		width:100%;

		display:grid;

	}

	.txtstyle, .txtstyle_color

	{

	font-family:arial;

	font-size:13;

	font-weight:700;

	height:16px; 

	background:#ABC5DF;

	text-align: center;

	}



	.center

	{

		text-align: center;

	}

	.left

	{

		text-align: left;

	}



	</style>	
	<link rel='stylesheet' type='text/css' href='css/ucb_common_style.css' >

	<link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
	<body>

<?php require_once ("inc/header.php"); ?>

<br>

<div class="outer-container">

	<div class="container">

		<div class="dashboard_heading" style="float: left;">

			<div style="float: left;">

				Purchasing Revenue & Profit Report

			

				<div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>

				<span class="tooltiptext">This report shows purchasing revenue & profit for selected employee.</span></div><br>

			</div>

		</div>

		

		<form method="POST" name="b2bpurchasing" id="b2bpurchasing" action="<?php echo $_SERVER['PHP_SELF'];?>">

			<table>

			<tr>

				<td>

					<select id="eid" name="eid" onchange="set_emp_start_dt()">			

					<?php	

						echo '<option  value="">All</option>';

						$sql = "SELECT * FROM loop_employees WHERE (dashboard_view = 'Rescue' or dashboard_view = 'Pallet Sourcing') and status = 'Active' ORDER BY name";
						db();
						$result = db_query($sql);

						while ($rowemp = array_shift($result)) {	

							echo '<option  value="'.$rowemp['id'].'" data-date="'.$rowemp['Official_Start_Date'].'"';

							echo ($_POST["eid"] == $rowemp['id'])?"selected" : "" ;

							echo '>'. $rowemp['name'] .'</option>';

						}

					?>

					</select>

				</td>

				<td style="white-space: nowrap;">

						<div id="showcal" >

					Date from: 

						<input type="text" name="date_from" id="date_from" size="8" value="<?php echo isset($_REQUEST['date_from']) ? $_REQUEST['date_from'] : ''; ?>" > 

						<a href="#" onclick="cal2xx.select(document.b2bpurchasing.date_from,'dtanchor2xx','yyyy-MM-dd'); return false;" name="dtanchor2xx" id="dtanchor2xx"><img border="0" src="images/calendar.jpg"></a>

						<div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>		

					&emsp;To: 

						<input type="text" name="date_to" id="date_to" size="8" value="<?php echo isset($_REQUEST['date_to']) ? $_REQUEST['date_to'] : date("Y-m-d"); ?>" > 

						<a href="#" onclick="cal2xx.select(document.b2bpurchasing.date_to,'dtanchor3xx','yyyy-MM-dd'); return false;" name="dtanchor3xx" id="dtanchor3xx"><img border="0" src="images/calendar.jpg"></a>

						<div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>		

					</div>

				</td>

				<td>

					<?php if ($_POST["chk_chkucbzw"] == "chkucbzw") {?>

						UCBZW Clients Only: <input type="checkbox" name="chk_chkucbzw" id="chk_chkucbzw" value="chkucbzw" checked>

					<?php }else{ ?>

						UCBZW Clients Only: <input type="checkbox" name="chk_chkucbzw" id="chk_chkucbzw" value="chkucbzw" >

					<?php } ?>

				</td>

				<td>

					<select id="margin_filter" name="margin_filter" >			

						<option value="1" <?php if ($_REQUEST['margin_filter'] == 1) { echo " selected "; } ?> >Double Checked Only</option>

						<option value="2" <?php if ($_REQUEST['margin_filter'] == 2) { echo " selected "; } ?> >Booked Revenue</option>

					</select>

				</td>

				<td>

					Box Type: <select name="boxtype" id="boxtype" >

						<option value="">All</option>

						<option value="Gaylord" <?php if ($_REQUEST["boxtype"] == "Gaylord") { echo " selected "; }?>>Gaylord</option>

						<option value="Shipping" <?php if ($_REQUEST["boxtype"] == "Shipping") { echo " selected "; }?>>Shipping Box</option>

						<option value="Supersack" <?php if ($_REQUEST["boxtype"] == "Supersack") { echo " selected "; }?>>Supersack</option>

						<option value="Pallets" <?php if ($_REQUEST["boxtype"] == "Pallets") { echo " selected "; }?>>Pallets</option>

						<option value="Other" <?php if ($_REQUEST["boxtype"] == "Other") { echo " selected "; }?>>Other</option>

					</select>				

				</td>

				<td>

					<input type="button" value="Run Report" onClick="javascript: return loadmainpg()">

					<input type="hidden" id="reprun" name="reprun" value="yes">

					<input type="hidden" id="date_tomorrow" value="<?php echo date("Y-m-j", strtotime("+1 day"));?>">

				</td>

				

			</tr>

		</table>

	</form>



<br>

<div class="content">

<?php



if(isset($_POST["reprun"]) && $_POST["reprun"] == "yes"){



$uid = $_POST["eid"];

$start_Dt = $_POST["date_from"];

$end_Dt = $_POST["date_to"];

$chk_chkucbzw = $_POST["chk_chkucbzw"];

/*

$uid = 119;

$start_Dt = "2021-01-01";

$end_Dt = "2021-01-31";

*/

	$tot_quota = 0;

	

	$tot_quotaytd = 0;

	$tot_quotaactual = 0;

	$tot_quota_mtd = 0; $tot_quota_deal_mtd = 0;

	$tot_quotaactual_mtd = 0; $Summary_arr = array();

	$quota_one_day = 0; $lisoftrans_tot = "";

	

	$dt_year_value = date('Y', strtotime($start_Dt));

	$dt_month_value = date('m', strtotime($start_Dt));

	$current_year_value = date('Y');

	

	$days_this_year = floor((strtotime(DATE("Y-m-d")) - strtotime(DATE("Y-01-01")))/(60*60*24)) ;

	if ($uid == ""){

		$sql = "SELECT 0 as id , 'Operations' as name union SELECT id , name FROM loop_employees ORDER BY name";

	}else{

		$sql = "SELECT id , name FROM loop_employees WHERE id= ".$uid." ORDER BY quota DESC";

	}		
	db();
	$result = db_query($sql);

	while ($rowemp = array_shift($result)) {

		$quota = 0; $quotadate = "";  $deal_quota = 0; $monthly_qtd = 0;

		

		$display_data = "no";

		$lisoftrans = "<table cellSpacing='1' cellPadding='1' border='0'>";

		$lisoftrans .= "<tr><td class='txtstyle center' colspan='9'>" . $rowemp["name"] . "</td></tr>";

		$lisoftrans .= "<tr><td class='txtstyle_color' width='5%'>Sl. No.</td><td class='txtstyle_color' width='21%'>Supplier</td><td class='txtstyle_color' width='21%'>Customer</td><td class='txtstyle_color' width='21%'>Description</td><td class='txtstyle_color' width='6%'>Quantity</td><td class='txtstyle_color' width='6%'>Price</td><td class='txtstyle_color' width='6%'>Revenue</td><td class='txtstyle_color' width='6%'>Profit</td><td class='txtstyle_color' width='6%'>Margin</td></tr>";

		$quote_amount = 0;

		$slno = 1;

		$str_box_list_ids = ""; 

		$summtd_SUMPO = 0; $summtd_dealcnt = 0; $avg_revenue_cnt = 0; $avg_profit_cnt = 0; $invoice_amt_ind_all = 0; $str_box_list_transids = "";

		if ($_REQUEST["boxtype"] == ""){

			db();
			$qry = db_query("SELECT distinct(loop_box_id) AS id, trans_rec_id FROM loop_invoice_items WHERE box_item_founder_emp_id=". $rowemp["id"]);

		}else{



			if ($_REQUEST["boxtype"] == 'Shipping') {$boxtype = "'LoopShipping','Box','Boxnonucb','Presold','Medium','Large','Xlarge','Boxnonucb'";}

			if ($_REQUEST["boxtype"] == "Gaylord") {$boxtype = "'Gaylord','GaylordUCB', 'PresoldGaylord', 'Loop'";}

			if ($_REQUEST["boxtype"] == "Supersack") {$boxtype = "'SupersackUCB','SupersacknonUCB'";}

			if ($_REQUEST["boxtype"] == "Pallets") {$boxtype = "'PalletsUCB','PalletsnonUCB'";}

			if ($_REQUEST["boxtype"] == "Other") {$boxtype = "'DrumBarrelUCB','DrumBarrelnonUCB', 'Recycling', 'Other', 'Waste-to-Energy'";}

			
			db();
			
			$qry = db_query("Select loop_boxes.id, loop_invoice_items.trans_rec_id from loop_boxes inner join loop_invoice_items on loop_invoice_items.loop_box_id = loop_boxes.id

			where box_item_founder_emp_id= '". $rowemp["id"] . "' and loop_boxes.type in (" . $boxtype . ")");

		}			

		while ($row_rs_tmprs = array_shift($qry)) {

			$str_box_list_ids .= $row_rs_tmprs["id"] . ","; 

			$str_box_list_transids .= $row_rs_tmprs["trans_rec_id"] . ","; 

		}

		if ($str_box_list_ids != ""){

			$str_box_list_ids = substr($str_box_list_ids, 0, strlen($str_box_list_ids)-1);

		}

		if ($str_box_list_transids != ""){

			$str_box_list_transids = substr($str_box_list_transids, 0, strlen($str_box_list_transids)-1);

		}

		//echo $headtxt . "<br>" . $rowemp["id"] . "<br>";

		$tot_profit = 0;

		if ($str_box_list_ids != ""){

			$row_no = 0; $tmp_trans_id = ""; $vendor_b2b_rescue = 0;
			db();
			$qry = db_query("Select loop_transaction_buyer.warehouse_id, box_id, qty, loop_bol_tracking.trans_rec_id FROM loop_bol_tracking inner join loop_invoice_details

			on loop_invoice_details.trans_rec_id = loop_bol_tracking.trans_rec_id inner join loop_transaction_buyer on loop_transaction_buyer.id = loop_bol_tracking.trans_rec_id 

			where loop_transaction_buyer.ignore = 0 and loop_invoice_details.trans_rec_id in (" . $str_box_list_transids . ") and loop_invoice_details.timestamp between '" . $start_Dt . "' and '" . $end_Dt . " 23:59:59' and box_id in (" . $str_box_list_ids . ")");


			while ($row_rs_tmprs = array_shift($qry)) {

				if ($row_rs_tmprs["trans_rec_id"] != $tmp_trans_id ){

					$row_no	= 0;		

				}else{

					$row_no	= $row_no + 1;		

				}			



				$box_qry = "SELECT * FROM loop_boxes WHERE id = " . $row_rs_tmprs["box_id"];
				db();
				$box_res = db_query($box_qry);

				$boxdesc = "";

				while ($box_row = array_shift($box_res)) {

					$boxdesc = round($box_row["blength"])." ";

					if ($box_row["blength_frac"]!="")

						$boxdesc .= $box_row["blength_frac"]." ";

					$boxdesc .= "x ". round($box_row["bwidth"])." ";

					if ($box_row["bwidth_frac"]!="")

						$boxdesc .= $box_row["bwidth_frac"]." ";

					$boxdesc .= "x ". round($box_row["bdepth"]) ." ";

					if ($box_row["bdepth_frac"]!="")

						$boxdesc .= $box_row["bdepth_frac"]." ";

					$boxdesc .= $box_row["bdescription"]; 

					$vendor_b2b_rescue = $box_row["vendor_b2b_rescue"]; 

				}	



				$price = 0; $total = 0; $quantity = 0; $invoice_amt=0; $box_desc = ""; $invoice_amt_ind =0;

				db();

				$qry_box_main = db_query("Select * from loop_invoice_items where trans_rec_id = " . $row_rs_tmprs["trans_rec_id"] . " and loop_box_id = '" . $row_rs_tmprs["box_id"] . "'");

				

				while ($row_rs_data_main = array_shift($qry_box_main)) {

					$quantity = $quantity + $row_rs_data_main["quantity"];

					$price = $row_rs_data_main["price"];

					$total = $total + str_replace(",", "", $row_rs_data_main["total"]);

					$box_desc = $row_rs_data_main['description']; 

					$invoice_amt_ind = $invoice_amt_ind + $row_rs_data_main["quantity"]*$row_rs_data_main["price"];

				}	

				

				if ($quantity > 0)

				{

			

					$b2bid = 0; $company_name = ""; $wid = 0; $inv_number = ""; $double_checked = 0;

					$virtual_inventory_trans_id = 0 ; $virtual_inventory_company_id = 0 ; 

					$q1 = "SELECT loop_warehouse.b2bid, inv_number , inv_amount, loop_warehouse.id as wid, virtual_inventory_company_id, virtual_inventory_trans_id, double_checked, company_name FROM loop_transaction_buyer inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id where loop_transaction_buyer.id = " . $row_rs_tmprs["trans_rec_id"];
					
					db();
					$query = db_query($q1);

					while($fetch = array_shift($query))
					{

						$b2bid = $fetch['b2bid'];

						$wid = $fetch['wid'];

						$double_checked = $fetch['double_checked'];

						$company_name = $fetch['company_name']; 

						$inv_number = $fetch['inv_number']; 

						$inv_amount = $fetch["inv_amount"];  

						$virtual_inventory_trans_id = $fetch['virtual_inventory_trans_id']; 

						$virtual_inventory_company_id = $fetch['virtual_inventory_company_id']; 

					}			

									

					$supplier_b2bid = 0; $supplier_wid = 0; $supplier_company_name = ""; 

					if ($virtual_inventory_trans_id != -1){

						$q1 = "SELECT loop_warehouse.b2bid, loop_warehouse.id as wid, company_name FROM loop_transaction inner join loop_warehouse on loop_warehouse.id = loop_transaction.warehouse_id where loop_transaction.id = " . $virtual_inventory_trans_id;

						db();
						$query = db_query($q1);

						while($fetch = array_shift($query))

						{

							$supplier_b2bid = $fetch['b2bid'];

							$supplier_wid = $fetch['wid'];

							$supplier_company_name = $fetch['company_name']; 

						}			

						

						$nickname_supplier = get_nickname_val($supplier_company_name, $supplier_b2bid);

						

						$supp_nm = $virtual_inventory_trans_id . "-" . $nickname_supplier;

					}else{

						$virtual_inventory_trans_id = "";

						$supp_nm = "";

						

						$q1_supp = "SELECT * FROM loop_warehouse where id = ". $vendor_b2b_rescue;

						db();
						$query_supp = db_query($q1_supp);

						while($fetch_supp = array_shift($query_supp))

						{

							$supp_nm = get_nickname_val($fetch_supp['company_name'], $fetch_supp['b2bid']);

							

							$supplier_b2bid = $fetch_supp['b2bid'];

							$supplier_wid = $fetch_supp['id'];

							$supplier_company_name = $fetch_supp['company_name']; 

						}

					}					

				

					$display_rec = "yes";

					if ($chk_chkucbzw == "chkucbzw"){

						$display_rec = "no";

						$box_qry = "SELECT ucbzw_flg FROM companyInfo WHERE ID = '" . $supplier_b2bid . "' and ucbzw_flg = 1 and ucbzw_account_status = 83";

						db_b2b();

						$box_res = db_query($box_qry);

						while ($box_row = array_shift($box_res)) {

							$display_rec = "yes";

						}															

					}

				

					if ($display_rec == "yes"){

						db();

						$qry_box_main = db_query("Select * from loop_invoice_items where trans_rec_id = " . $row_rs_tmprs["trans_rec_id"] . " ");

						while ($row_rs_data_main = array_shift($qry_box_main)) {

							$invoice_amt += $row_rs_data_main["quantity"]*$row_rs_data_main["price"];

						}	



						$gr_total = str_replace(",", "", $total);

				

						$summtd_SUMPO = $summtd_SUMPO + str_replace(",", "" , number_format($gr_total,0));			

						db();

						$result_finalpmt = db_query("Select ROUND(sum(loop_buyer_payments.amount),2) as amt from loop_buyer_payments where trans_rec_id = " . $row_rs_tmprs["trans_rec_id"]);

						while ($summtd_finalpmt = array_shift($result_finalpmt)) {

							$finalpaid_amt = $summtd_finalpmt["amt"];

						}


						$invoice_amt= 0;

						if ($finalpaid_amt > 0){

							$invoice_amt= str_replace("," , "", $finalpaid_amt);

						}

						if ($finalpaid_amt == 0 && $inv_amount > 0){

							$invoice_amt= str_replace("," , "", $inv_amount);

						}

						if ($finalpaid_amt == 0 && $inv_amount == 0 && $row_rs_tmprs["loop_inv_amount"] > 0){

							$invoice_amt = str_replace("," , "", $row_rs_tmprs["loop_inv_amount"]);

						}

					

						//echo $row_rs_tmprs["trans_rec_id"] . " finalpaid_amt - " . $finalpaid_amt . " inv_amount - " . $inv_amount . " row_rs_tmprsinv_amount - " . $row_rs_tmprs["loop_inv_amount"] . "<br>";

											

						$nickname = get_nickname_val($company_name, $b2bid);

						$nickname_supplier = "";



						$avg_revenue_cnt = $avg_revenue_cnt + 1;			



						$vendor_pay = 0; $profit_val = ""; $profit_val_per = ""; $profit_val_str = "";



						$to_quantity = 0;	

						//$dt_view_qry = "SELECT sum(quantity) as quantity FROM loop_invoice_items WHERE trans_rec_id = " . $row_rs_tmprs["trans_rec_id"] . " "; 

						//total > 0 and removed this as line item can have 0 values

						$dt_view_qry = "SELECT sum(quantity) as quantity FROM loop_invoice_items WHERE category_id <> 7 and trans_rec_id = " . $row_rs_tmprs["trans_rec_id"] . " "; 
						
						db();
						$dt_view_res = db_query($dt_view_qry);

						while ($dt_view_row = array_shift($dt_view_res)) {

							$to_quantity = $dt_view_row["quantity"];

						}					

						

						$quantity_per = ($quantity * 100)/$to_quantity;

						

						$dt_view_qry = "SELECT *, loop_transaction_buyer_payments.id AS A , loop_transaction_buyer_payments.status AS B, files_companies.name AS C from loop_transaction_buyer_payments left JOIN files_companies ON loop_transaction_buyer_payments.company_id = files_companies.id  INNER JOIN loop_vendor_type ON loop_transaction_buyer_payments.typeid = loop_vendor_type.id  WHERE loop_transaction_buyer_payments.transaction_buyer_id = " . $row_rs_tmprs["trans_rec_id"];

						db();
						$dt_view_res = db_query($dt_view_qry);

						while ($dt_view_row = array_shift($dt_view_res)) {

							$vendor_pay += $dt_view_row["estimated_cost"]; 

						}



						$gross_profit_val = $invoice_amt - $vendor_pay;

						$profit_val = ($quantity_per * $gross_profit_val)/100;

						//$profit_val =  $gross_profit_val;

						

						//$profit_val_per = number_format((($profit_val * 100)/$invoice_amt),2) . "%";

						

						$profit_val_p = (($gross_profit_val * 100)/$invoice_amt);

						

						$invoice_amt_ind_all = $invoice_amt_ind_all + $invoice_amt_ind;

						

						

						//$profit_val_per = number_format(($profit_val_p * 100)/$quantity_per,2) . "%";

						if ($_REQUEST["margin_filter"] == 1){

							$profit_val_str1 = "";

							if ($double_checked == 1){

								$tot_profit = $tot_profit + str_replace(",", "" , number_format($profit_val,0));

								

								$profit_val_per = number_format(($profit_val * 100)/$invoice_amt_ind,2) . "%";

								

								$profit_val = "$" . number_format($profit_val,2);

								

								$avg_profit_cnt = $avg_profit_cnt + 1;

							}else{

								$profit_val_str = "style='color:red;'";

								$profit_val_str1 = $profit_val_str;

								$profit_val = "TBD"; 

								$profit_val_per = "TBD";

							}

							

						}else{

							if ($double_checked == 1){

								

							}else{

								$profit_val_str = "style='color:red;'";

							}									

							$tot_profit = $tot_profit + str_replace(",", "" , number_format($profit_val,0));

							$avg_profit_cnt = $avg_profit_cnt + 1;			

							

							$profit_val_per = number_format(($profit_val * 100)/$invoice_amt_ind,2) . "%";

							$profit_val_str1 = $profit_val_str;

							

							$profit_val = "$" . number_format($profit_val,2);

						}								



						$summtd_dealcnt = $summtd_dealcnt + 1;

						

						$lisoftrans .= "<tr>

						<td class='center' bgColor='#E4EAEB'>" . $slno++ . "</td>

						<td bgColor='#E4EAEB'><a target='_blank' href='viewCompany.php?ID=" . $supplier_b2bid . "&show=transactions&warehouse_id=" . $supplier_wid . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $supplier_wid ."&rec_id=" . $virtual_inventory_trans_id . "&display=seller_sort'>". $supp_nm . "</a></td>

						<td bgColor='#E4EAEB'><a target='_blank' href='viewCompany.php?ID=" . $b2bid . "&show=transactions&warehouse_id=" . $wid . "&rec_type=Supplier&proc=View&searchcrit=&id=". $wid ."&rec_id=" . $row_rs_tmprs["trans_rec_id"] . "&display=buyer_invoice'>". $row_rs_tmprs["trans_rec_id"] . "-" . $nickname . "</a></td>

						<td bgColor='#E4EAEB'><a target='_blank' href='manage_box_b2bloop.php?id=" . $row_rs_tmprs["box_id"] . "&proc=View'>". $box_desc . "</a></td>

						<td class='center' bgColor='#E4EAEB'>" . number_format($quantity,0) . "</td>

						<td class='center' bgColor='#E4EAEB'>$" . number_format($price, 2) . "</td>

						<td bgColor='#E4EAEB' align='right'>$" . number_format(str_replace(",", "", $total),0) . "</td>

						<td bgColor='#E4EAEB' $profit_val_str align='right'>" . $profit_val . "</td>

						<td class='center' $profit_val_str1 bgColor='#E4EAEB'>" . $profit_val_per . "</td>

						</tr>";

						$display_data = "yes";

					}	

				}

				$tmp_trans_id = $row_rs_tmprs["trans_rec_id"];

			}

		}

			

		if ($summtd_SUMPO > 0){

			$profit_val_per_tot = number_format(($tot_profit * 100)/$invoice_amt_ind_all,2) . "%";

			

			//echo $summtd_SUMPO . " | " . $avg_revenue_cnt . " | " . $tot_profit . "<br>";

			$avg_profit = 0;

			if ($tot_profit <> 0 && $avg_profit_cnt <> 0){

				$avg_profit = $tot_profit/$avg_profit_cnt;

			}				

			

			$lisoftrans .= "<tr><td bgColor='#ABC5DF'>&nbsp;</td><td bgColor='#ABC5DF'>&nbsp;</td><td bgColor='#ABC5DF'>&nbsp;</td><td bgColor='#ABC5DF'>&nbsp;</td><td bgColor='#ABC5DF'>&nbsp;</td><td bgColor='#ABC5DF'>&nbsp;</td>

			<td bgColor='#ABC5DF' align='right'>$" . number_format($summtd_SUMPO,0) . "</td><td bgColor='#ABC5DF' align='right'>$" . number_format($tot_profit,0) . "</td><td bgColor='#ABC5DF'>&nbsp;</td></tr>";

			$Summary_arr[] = array('emp_name' => $rowemp["name"], 'revenue' => $summtd_SUMPO, 'profit' => $tot_profit, 'invoice_amt_ind_all' => $invoice_amt_ind_all,

			'avg_revenue' => $summtd_SUMPO/$avg_revenue_cnt, 'avg_profit' => $avg_profit, 'margin_emp' => $profit_val_per_tot);

		}

		$lisoftrans .= "</table></span><br>";

		

		if ($display_data == "yes")

		{

			echo $lisoftrans;

		}	

	}

	

?>

	<table width="50%" cellSpacing='1' cellPadding='1' border='0'>

		<tr><td class='txtstyle_color' width='20%'>Employee Name</td>

		<td class='txtstyle_color' width='5%'>Grand Total Revenue</td><td class='txtstyle_color' width='5%'>Grand Total Profit</td>

		<td class='txtstyle_color' width='5%'>Average Revenue</td><td class='txtstyle_color' width='5%'>Average Profit</td>

		<td class='txtstyle_color' width='5%'>Margin</td></tr>

	<?php

		$tot_revenue = $tot_profit = $tot_avg_revenue = $invoice_amt_ind_all = $tot_avg_profit = 0;

		foreach ($Summary_arr as $Summary_arrRow) {	

			$lisoftrans = "<tr><td bgColor='#E4EAEB' align='center'>" . $Summary_arrRow["emp_name"] . "</td>";

			$lisoftrans .= "<td bgColor='#E4EAEB' align='right' >$" . number_format($Summary_arrRow["revenue"],0) . "</td>";

			$lisoftrans .= "<td bgColor='#E4EAEB' align='right' >$" . number_format($Summary_arrRow["profit"],0) . "</td>";

			$lisoftrans .= "<td bgColor='#E4EAEB' align='right' >$" . number_format($Summary_arrRow["avg_revenue"],0) . "</td>";

			$lisoftrans .= "<td bgColor='#E4EAEB' align='right' >$" . number_format($Summary_arrRow["avg_profit"],0) . "</td>";

			$lisoftrans .= "<td bgColor='#E4EAEB' align='right' >" . $Summary_arrRow["margin_emp"] . "</td>";

			$lisoftrans .= "</tr>";

			

			echo $lisoftrans;

			

			$tot_revenue = $tot_revenue + str_replace(",", "" , number_format($Summary_arrRow["revenue"],0));

			$tot_profit = $tot_profit + str_replace(",", "" , number_format($Summary_arrRow["profit"],0));

			$tot_avg_revenue = $tot_avg_revenue + str_replace(",", "" , number_format($Summary_arrRow["avg_revenue"],0));

			$tot_avg_profit = $tot_avg_profit + str_replace(",", "" , number_format($Summary_arrRow["avg_profit"],0));

			

			$invoice_amt_ind_all = $invoice_amt_ind_all + str_replace(",", "" , number_format($Summary_arrRow["invoice_amt_ind_all"],0)); 

		}

		

		$profit_val_per_tot = number_format(($tot_profit * 100)/$invoice_amt_ind_all,2) . "%";

		

		$lisoftrans = "<tr><td bgColor='#E4EAEB' align='center'><b>Total</b></td>";

		$lisoftrans .= "<td bgColor='#E4EAEB' align='right' ><b>$" . number_format($tot_revenue,0) . "</b></td>";

		$lisoftrans .= "<td bgColor='#E4EAEB' align='right' ><b>$" . number_format($tot_profit,0) . "</b></td>";

		$lisoftrans .= "<td bgColor='#E4EAEB' align='right' ><b>$" . number_format($tot_avg_revenue,0) . "</b></td>";

		$lisoftrans .= "<td bgColor='#E4EAEB' align='right' ><b>$" . number_format($tot_avg_profit,0) . "</b></td>";

		$lisoftrans .= "<td bgColor='#E4EAEB' align='right' ><b>" . $profit_val_per_tot . "</b></td>";

		$lisoftrans .= "</tr>";

		

		echo $lisoftrans;

		

		?>

	</table>

	<?php

}

	?>

		</div>

	</div>

</div>

</body>

</html>