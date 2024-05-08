<?php
require ("inc/header_session.php");
require ("../mainfunctions/database.php");
require ("../mainfunctions/general-functions.php");

?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>UCB Top Clients Report</title>
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

				color: #333333;

				font-size: small;

			}

			.style8 {

				text-align: left;

				font-family: Arial, Helvetica, sans-serif;

				color: #333333;

				font-size: small;

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

			.pop-table{

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

				background-color: #ABC5DF;

			}



			select, input {

			font-family: Arial, Helvetica, sans-serif; 

			font-size: 12px; 

			color : #000000; 

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

			padding-left: 5px;

			}

			table.datatable tr:nth-child(even) td{

				background-color: #e4e4e4;

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

				width: 70%;

				height: 85%;

				padding: 16px;

				border: 1px solid gray;

				background-color: white;

				z-index:1002;

				overflow: auto;

			}

			table.datatable tr td.equal_date_bg{

				background:#E4E4E4;

			}

			table.datatable tr td.less_date_bg{

				background:#f5dddc;

			}

			

		</style>	

		<script language="JavaScript" src="inc/CalendarPopup.js"></script><script language="JavaScript" src="inc/general.js"></script>

		<script language="JavaScript">document.write(getCalendarStyles());</script>

		<script language="JavaScript">

			var cal2xx = new CalendarPopup("listdiv");

			cal2xx.showNavigationDropdowns();

			var cal3xx = new CalendarPopup("listdiv");

			cal3xx.showNavigationDropdowns();

		</script>

		<script>

			function load_div(id){

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



				document.getElementById('light').style.left='100px';

				document.getElementById('light').style.top=elementTop + 100 + 'px';

			}

			

			function close_div(){

				document.getElementById('light').style.display='none';

			}



			function set_drop_down(){

				if (document.getElementById('sales_purchase').value == "sales_record"){

					document.getElementById('trans_rev_profit').style.display='inline';

					document.getElementById('industry_sale').style.display='block';

					document.getElementById('industry_purchase').style.display='none';

					document.getElementById('trans_rev_profit_purchasing').style.display='none';

				}

				

				if (document.getElementById('sales_purchase').value == "purchasing_record"){

					document.getElementById('trans_rev_profit_purchasing').style.display='inline';

					document.getElementById('industry_purchase').style.display='block';

					document.getElementById('industry_sale').style.display='none';

					document.getElementById('trans_rev_profit').style.display='none';

				}

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

				UCB Top Clients Report   

			

			<div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>

			<span class="tooltiptext">This report shows UCB's largest (top) customer and suppliers, measured in various ways such as revenue, payments, transactions, and profit.</span></div>

			</div>

		</div>

		<?php

		$time = strtotime(Date('Y-m-d'));

		$st_friday = $time;

		$st_friday_last = date('m/d/Y', strtotime('-6 days', $st_friday));



		$st_thursday_last = Date('m/d/Y');

		//$st_friday_last = '01/01/2019';

		//Find default dates

		$previous_week = strtotime("-1 week +1 day");



		$start_week = strtotime("last sunday midnight",$previous_week);

		$end_week = strtotime("next saturday",$start_week);



		$start_week = date("Y-m-d",$start_week);

		$end_week = date("Y-m-d",$end_week);



		$start_week = date("Y-01-01");

		$end_week = date("Y-m-d");



		//echo $start_week.' '.$end_week ;

		//

		//

		$in_dt_range = "no";

		if( $_REQUEST["date_from"] !="" && $_REQUEST["date_to"] !=""){

			$date_from_val = date("Y-m-d", strtotime($_REQUEST["date_from"]));

			$date_to_val_org = date("Y-m-d", strtotime($_REQUEST["date_to"]));

			$date_to_val = date("Y-m-d", strtotime('+1 day', strtotime($_REQUEST["date_to"])));

			$in_dt_range = "yes";

			//

			$assignid=$_REQUEST["assignid"];

			//

		}else{

			$in_dt_range = "no";

			$date_from_val = $start_week;

			$date_to_val_org = $end_week;

			$date_to_val = $end_week;

			$assignid="all";

		}

		

		if($assignid=="all"){

			$empqry="";

		}

		else{

			$empqry=" and assignedto=".$assignid;

		}

		

		?>

		

		<form method="post" name="sales_func" action="report_top_ucb_client.php">

			<input type="hidden" name="runfrm" value="runreport">

			<table border="0">

			<tr>

				<td width="135px;">

					# of records to display:&nbsp; <input type="text" name="txt_no_rec" id="txt_no_rec" size="10" value="<?php if ($_REQUEST['txt_no_rec'] == "") { echo "100"; } else {echo $_REQUEST['txt_no_rec'];} ?>" > 

				</td>

				<td width="180px;"><br>

					<select name="sales_purchase" id="sales_purchase" onchange="set_drop_down()">

						<!-- <option value="0">Please Select</option> -->

						<option value="sales_record" <?php if ($_REQUEST["sales_purchase"] == "sales_record" ) echo " selected "; ?> >SALES RECORDS</option>

						<option value="purchasing_record" <?php if ($_REQUEST["sales_purchase"] == "purchasing_record" ) echo " selected "; ?>>PURCHASING RECORDS</option>

					</select>	

				</td>

				<td width="290px;">

					Industry: &nbsp;

				<?php

					if($_REQUEST["sales_purchase"]=="sales_record" || $_REQUEST["sales_purchase"]==""){ 

						echo '<select name="industry_sale" id="industry_sale" style="width:286px;">';

					}else{

						echo '<select name="industry_sale" id="industry_sale" style="width:286px;display: none">';

					}

					echo '<option value="">Select Industry</option>';

				

					$indqry = "SELECT * FROM industry_master WHERE active_flg=1 AND sellto_flg=1";
					
					db_b2b();
					$indres = db_query($indqry);

					while($r1 = array_shift($indres)){

						echo '<option value="'.$r1["industry_id"].'"';

						echo (($_REQUEST["industry_sale"] == $r1["industry_id"])? " selected" : "");

						echo '>'.$r1["industry"].'</option>';

					}

					echo '</select>';

					

					if ($_REQUEST["sales_purchase"] == "purchasing_record" ) {

						echo '<select name="industry_purchase" id="industry_purchase" style="width:286px;">';

					}else{

						echo '<select name="industry_purchase" id="industry_purchase" style="width:286px; display:none">';

					}

					

					echo '<option value="">Select Industry</option>';

					$indqry = "SELECT * FROM industry_master WHERE active_flg=1 AND sellto_flg=0";

					db_b2b();
					$indres = db_query($indqry);

					while($r2 = array_shift($indres)){

						echo '<option value="'.$r2["industry_id"].'"';

						echo (($_REQUEST["industry_purchase"] == $r2["industry_id"])? " selected" : "");

						echo '>'.$r2["industry"].'</option>';

					}

					echo '</select>';

				?>

				

				</td>

				<td width="150px;">

					Data that will be displayed:&nbsp;

					<?php if ($_REQUEST["sales_purchase"] == "sales_record" || $_REQUEST["sales_purchase"] == "") { ?>

						<select name="trans_rev_profit" id="trans_rev_profit">

					<?php }else{ ?>

						<select name="trans_rev_profit" id="trans_rev_profit" style="display:none;">

					<?php } ?>

						<!-- <option value="0">Please Select</option> -->

						<option value="transaction" <?php if ($_REQUEST["trans_rev_profit"] == "transaction" ) echo " selected "; ?>>TRANSACTIONS</option>

						<option value="revenue" <?php if ($_REQUEST["trans_rev_profit"] == "revenue" ) echo " selected "; ?>>REVENUE</option>

						<option value="profit" <?php if ($_REQUEST["trans_rev_profit"] == "profit" ) echo " selected "; ?>>PROFIT</option>

					</select>	

					<?php if ($_REQUEST["sales_purchase"] == "purchasing_record" ) { ?>

						<select name="trans_rev_profit_purchasing" id="trans_rev_profit_purchasing">

					<?php }else{ ?>

						<select name="trans_rev_profit_purchasing" id="trans_rev_profit_purchasing" style="display:none;">

					<?php } ?>

						<option value="transaction" <?php if ($_REQUEST["trans_rev_profit_purchasing"] == "transaction" ) echo " selected "; ?>>TRANSACTIONS</option>

						<option value="payments" <?php if ($_REQUEST["trans_rev_profit_purchasing"] == "payments" ) echo " selected "; ?>>PAYMENTS</option>

						<option value="revenue" <?php if ($_REQUEST["trans_rev_profit_purchasing"] == "revenue" ) echo " selected "; ?>>REVENUE</option>

						<option value="profit" <?php if ($_REQUEST["trans_rev_profit_purchasing"] == "profit" ) echo " selected "; ?>>PROFIT</option>

					</select>	

				</td>

				<td width="280px;"><br>

					From: 

						<input type="text" name="date_from" id="date_from" size="10" value="<?php echo isset($_GET['date_from']) ? $_GET['date_from'] : date("m/d/Y", strtotime($date_from_val)); ?>" > 

						<a href="#" onclick="cal2xx.select(document.sales_func.date_from,'dtanchor2xx','MM/dd/yyyy'); return false;" name="dtanchor2xx" id="dtanchor2xx"><img border="0" src="images/calendar.jpg"></a>

						<div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>		

					To: 

						<input type="text" name="date_to" id="date_to" size="10" value="<?php echo isset($_GET['date_to']) ? $_GET['date_to'] : date("m/d/Y", strtotime($date_to_val_org)); ?>" > 

						<a href="#" onclick="cal3xx.select(document.sales_func.date_to,'dtanchor3xx','MM/dd/yyyy'); return false;" name="dtanchor3xx" id="dtanchor3xx"><img border="0" src="images/calendar.jpg"></a>

				</td>

				

				<td width="55px;">

					Aggregate by Parent:&nbsp;<input type="checkbox" name="chk_show_parent" id="chk_show_parent" value="yes" <?php if ($_REQUEST['chk_show_parent'] == "yes") echo " checked "; ?>>

				</td>



				<td width="80px;">

					Exclude Recycling Transactions?:&nbsp;<input type="checkbox" name="chk_exclude_recycle" id="chk_exclude_recycle" <?php if ($_REQUEST['chk_exclude_recycle'] == "yes") echo " checked "; ?> value="yes"> 

				</td>



				<td width="80px;">

					Exclude UCBZW Transactions?:&nbsp;<input type="checkbox" name="chk_exclude_ucbzw" id="chk_exclude_ucbzw" <?php if ($_REQUEST['chk_exclude_ucbzw'] == "yes") echo " checked "; ?> value="yes"> 

				</td>



				<td width="55px;">

					<input type="submit" name="btntool" value="Submit" />

				</td>

				</tr>

			</table>

			

			<div ><i>Note: Please wait until you see <font color="red">"END OF REPORT"</font> at the bottom of the report, before using the sort option.</i></div>

		</form>



	<br><br>

	<?php

	if(isset($_REQUEST["runfrm"]) && ($_REQUEST["runfrm"]=="runreport"))

	{

			$txt_no_rec = $_REQUEST["txt_no_rec"];

			$txt_no_rec_str = "";

			if ($txt_no_rec != ""){

				$txt_no_rec_str = " limit " . $txt_no_rec;

			}

			$txt_no_rec = floatval($_REQUEST["txt_no_rec"]);



			$show_parent_str = "";

			if ($_REQUEST["chk_show_parent"] == "yes"){

				$show_parent_str = " (parent_child = 'Parent' or parent_child = '') and ";

			}

			

			$show_recycling_flg_str = "";

			if ($_REQUEST["chk_exclude_recycle"] == "yes"){

				$show_recycling_flg_str = " and recycling_flg = 0";

			}



			$show_ucbzw_flg_str = "";

			if ($_REQUEST["chk_exclude_ucbzw"] == "yes"){

				$show_ucbzw_flg_str = " and UCBZeroWaste_flg = 0";

			}

			

			$trans_rev_profit_sel = "";

			$industry_type = "";

			if ($_REQUEST["sales_purchase"] == "sales_record"){

				$trans_rev_profit_sel = $_REQUEST["trans_rev_profit"];

				$industry_type = $_REQUEST["industry_sale"];

			}

			if ($_REQUEST["sales_purchase"] == "purchasing_record"){

				$trans_rev_profit_sel = $_REQUEST["trans_rev_profit_purchasing"];

				$industry_type = $_REQUEST["industry_purchase"];

			}

			

		function get_account_owner($comp_id)

		{

			$emp_name = "";

			$qry_master = "Select employees.initials FROM companyInfo inner join employees on employees.employeeID = companyInfo.assignedto where ID = '" . $comp_id . "'";

			db_b2b();
			$res_data_master = db_query($qry_master);

			while ($row_rs_tmprs_master = array_shift($res_data_master)) {

				$emp_name = $row_rs_tmprs_master["initials"];

			}			

			

			db();

			return $emp_name;

		}

		function get_last_and_next_date($comp_id){

			$date_array=[];

			db_b2b();

			$qry_master = "Select last_contact_date,next_date FROM companyInfo where ID = '" . $comp_id . "'";

			$res_data_master = db_query($qry_master);

			while ($row_rs_tmprs_master = array_shift($res_data_master)) {

				if ($row_rs_tmprs_master["last_contact_date"] != ""){

					$date_array['last_contact_date'] = date("m/d/Y", strtotime($row_rs_tmprs_master["last_contact_date"]));

				}

				if ($row_rs_tmprs_master["next_date"] != ""){

					$date_array['next_date'] = date("m/d/Y", strtotime($row_rs_tmprs_master["next_date"]));

				}

			}			

			db();

			return $date_array;

		}

		

		function condition_check_for_dates($actual_date){

			$current_date = new DateTime(date("Y-m-d"));

			$actual_date_comp = new DateTime(date("Y-m-d", strtotime($actual_date)));

			if ($actual_date_comp < $current_date){

				$class_name="less_date_bg";

			}

			return $class_name;

		}

	?>

		<table cellSpacing="1" cellPadding="1" border="0" class="datatable">

			<tr>

				<td style="width: 50" class="style17" align="center">

					<b>Account Owner</b></td>

				<td style="width: 300" class="style17" align="center">

					<b>Company name</b></td>

		<?php	if( $trans_rev_profit_sel == "transaction" ){ ?>

				<td style="width: 200" class="style17" align="right">

					<b>Total Number Transaction</b></td>

		<?php }?>	

		<?php	if( $trans_rev_profit_sel == "revenue" ){ ?>

				<td style="width: 200" class="style17" align="right">

					<b>Total Revenue</b></td>

		<?php }?>	

		<?php	if( $trans_rev_profit_sel == "profit" ){ ?>

				<td style="width: 200" class="style17" align="right">

					<b>Total Profit</b></td>

		<?php }?>	

		<?php	if( $trans_rev_profit_sel == "payments" ){ ?>

				<td style="width: 200" class="style17" align="right">

					<b>Total Payments</b></td>

		<?php }?>	

		<?php if( $_REQUEST["sales_purchase"] == "sales_record" ){?>

			<td style="width: 50" class="style17" align="center">

				<b> Last Delivery Date</b>

			</td>

			<td style="width: 50" class="style17" align="center">

				<b> Last Contact Date</b>

			</td>

			<td style="width: 50" class="style17" align="center">

				<b> Next Step Date</b>

			</td>

			

		<?php } if( $_REQUEST["sales_purchase"] == "purchasing_record" ){?>

			<td style="width: 50" class="style17" align="center">

				<b> Last Sort Report Date</b>

			</td>

			<td style="width: 50" class="style17" align="center">

				<b> Last Communication Date</b>

			</td>

			<td style="width: 50" class="style17" align="center">

				<b> Next Step Date</b>

			</td>

		<?php } ?>

		</tr>

			<?php

			if( $trans_rev_profit_sel == "transaction" ){

				if ($show_parent_str == ""){

					if( $_REQUEST["sales_purchase"] == "sales_record" ){

						$qry = "Select warehouse_name, warehouse_id, b2bid, count(*) as cnt from loop_transaction_buyer inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id where `ignore` = 0 $show_recycling_flg_str $show_ucbzw_flg_str and (transaction_date >= '" . $date_from_val . "' and transaction_date <= '" . $date_to_val . "') group by warehouse_id order by count(*) desc "; 

					}

					

					if( $_REQUEST["sales_purchase"] == "purchasing_record" ){

						$qry = "Select warehouse_name, warehouse_id, b2bid, count(*) as cnt from loop_transaction inner join loop_warehouse on loop_warehouse.id = loop_transaction.warehouse_id where `ignore` = 0 and (transaction_date >= '" . $date_from_val . "' and transaction_date <= '" . $date_to_val . "') group by warehouse_id order by count(*) desc "; 

					}

					//echo $qry . "<br>";

					$tot_cnt = 0; $cnt = 0; 

					db();
					$qry_res_p = db_query($qry);

					while($row = array_shift($qry_res_p)){

						$is_parent = "no";

						$com_ind = '';

						$industry_chk = "No";

						if($industry_type != ''){

							$com_ind = get_industry($row["b2bid"]);

							if($industry_type == $com_ind ){

								$industry_chk = "Yes";

							}

						}else{

							$industry_chk = "Yes";

						}



						if($industry_chk == "Yes") {

						//if ($is_parent == "no" && $show_parent_str == "") {

							//echo "Cnt - " . $txt_no_rec . " - " . $cnt . "<br>";

							if ($txt_no_rec > 0) {

								if ($txt_no_rec <= $cnt){ break; }

							}

							if( $_REQUEST["sales_purchase"] == "sales_record" ){ 

								$last_delivery_date = "";

								$qry_last_delivery_date = "Select last_delivery_date from loop_warehouse WHERE b2bid = '".$row['b2bid']."' ORDER BY last_delivery_date desc limit 1";

								db();
								$qry_res_last_delivery_date = db_query($qry_last_delivery_date);

								while($row_last_delivery_date = array_shift($qry_res_last_delivery_date)){

									if ($row_last_delivery_date['last_delivery_date'] != "")

									{

										$last_delivery_date = date("m/d/Y", strtotime($row_last_delivery_date['last_delivery_date']));

									}	

								}	

							}

							if( $_REQUEST["sales_purchase"] == "purchasing_record" ){

								$bol_sort_date = "";

								$qry_bol_date = "Select last_sort_date as bol_sort_date from loop_warehouse WHERE id = '".$row['warehouse_id']."'";

								db();
								$qry_res_bol_date = db_query($qry_bol_date);

								while($row_bol_date = array_shift($qry_res_bol_date)){

									if ($row_bol_date['bol_sort_date'] != "")

									{

										$bol_sort_date = date("m/d/Y", strtotime($row_bol_date['bol_sort_date']));

									}	

								}	

							}

							$date_array=get_last_and_next_date($row["b2bid"]);

							$last_contact_date=$date_array['last_contact_date'];

							$next_date=$date_array['next_date'];

							$new_cnt = $row["cnt"];

						?>					

							<tr>

								<td style="width: 50"class="style3" align="left">

									<?php echo get_account_owner($row["b2bid"]); ?>

								</td>

								<td style="width: 300"class="style3" align="left">

									<a target="_blank" href="viewCompany.php?ID=<?php echo $row["b2bid"]; ?>"><?php echo get_nickname_val($row["warehouse_name"], $row["b2bid"]); ?></a>

								</td>

								<td style="width: 200"class="style3" align="right">

									<?php echo $new_cnt; ?>

								</td>

								<?php if( $_REQUEST["sales_purchase"] == "sales_record" ){ ?>

									<td>

										<?php echo $last_delivery_date; ?>

									</td>

								<?php } if( $_REQUEST["sales_purchase"] == "purchasing_record" ){ ?> 

									<td>

										<?php echo $bol_sort_date; ?>

									</td>

								<?php } ?>

							

								<td class="<?php echo condition_check_for_dates($last_contact_date); ?>">

									<?php echo $last_contact_date; ?>

								</td>

								<td class="<?php echo condition_check_for_dates($next_date); ?>">

									<?php echo $next_date; ?>

								</td>

							</tr>

						<?php

							$cnt = $cnt + 1;

							$tot_cnt = $tot_cnt + $new_cnt;

						}

					}

					

					if ($tot_cnt > 0 ){

					?>					

						<tr>

							<td colspan="2" style="width: 300"class="style3" align="right">

								<b>Total:<b>

							</td>

							<td style="width: 200"class="style3" align="right">

								<b><?php echo $tot_cnt; ?></b>

							</td>

							<td colspan="3" style="width: 300"class="style3" align="right">

								&nbsp;

							</td>

						</tr>

					<?php	

					}

				}

				

				//Parent case

				if ($show_parent_str != ""){

					

//Select parent_comp_id, ID, loopid FROM companyInfo where loopid > 0 and parent_comp_id in

//(Select ID FROM companyInfo where (parent_child = 'Parent' or parent_child = '')

//and haveNeed = UPPER('Need boxes') and active = 1) and (parent_child = 'Child') order by parent_comp_id

	

//Select warehouse_name, b2bid, count(*) as cnt from loop_transaction_buyer inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id where

//warehouse_id in ((5050, 1199, 5027, 3868) (3630,3482,3454,2781))a

//and `ignore` = 0 and (transaction_date >= '2022-01-01' and transaction_date <= '2022-11-01') group by warehouse_id order by count(*) desc	

					if( $_REQUEST["sales_purchase"] == "sales_record" ){

						//$qry_master = "Select ID, company, loopid FROM companyInfo where $show_parent_str haveNeed = UPPER('Need boxes') and active = 1";

						//$qry_master = "Select parent_comp_id, company, ID, loopid FROM companyInfo where companyInfo.loopid > 0 and 

						//parent_comp_id in (Select ID FROM companyInfo where (parent_child = 'Parent' or parent_child = '')

						//and haveNeed = UPPER('Need boxes') and active = 1) and (parent_child = 'Child') order by parent_comp_id, loopid";

						

						$qry_master = "Select parent_comp_id, company, ID, loopid FROM companyInfo where companyInfo.status not in(24,31,49) and companyInfo.active=1 and 

						companyInfo.loopid > 0 and 

						parent_comp_id in (Select ID FROM companyInfo where (parent_child = 'Parent')

						and haveNeed = UPPER('Need boxes') and active = 1) and (parent_child = 'Child') 

						union

						Select ID as parent_comp_id, company, ID, loopid FROM companyInfo where companyInfo.status not in(24,31,49) and companyInfo.active=1 and companyInfo.loopid > 0

						and haveNeed = UPPER('Need boxes') and active = 1 and (parent_child = '' or (parent_child = 'Parent' and parent_comp_id = 0))

						order by parent_comp_id, loopid";

					}	

					if( $_REQUEST["sales_purchase"] == "purchasing_record" ){

						//$qry_master = "Select ID, company, loopid FROM companyInfo where $show_parent_str haveNeed = UPPER('have boxes') and active = 1";

						//$qry_master = "Select parent_comp_id, company, ID, loopid FROM companyInfo where companyInfo.loopid > 0 and 

						//parent_comp_id in (Select ID FROM companyInfo where (parent_child = 'Parent' or parent_child = '')

						//and haveNeed = UPPER('have boxes') and active = 1) and (parent_child = 'Child') order by parent_comp_id, loopid";



						$qry_master = "Select parent_comp_id, company, ID, loopid FROM companyInfo where  companyInfo.status not in(24,31,49) and companyInfo.active=1 and 

						companyInfo.loopid > 0 and 

						parent_comp_id in (Select ID FROM companyInfo where (parent_child = 'Parent')

						and haveNeed = UPPER('have boxes') and active = 1) and (parent_child = 'Child') 

						union

						Select ID as parent_comp_id, company, ID, loopid FROM companyInfo where  companyInfo.status not in(24,31,49) and companyInfo.active=1 and companyInfo.loopid > 0

						and haveNeed = UPPER('have boxes') and active = 1 and (parent_child = '' or (parent_child = 'Parent' and parent_comp_id = 0))

						order by parent_comp_id, loopid";

					}	

					$comp_id_list = ""; $comp_b2bid_list = ""; $parent_comp_id_str = ""; $parent_comp_str = "";

					$trans_array = array();

					db_b2b();

					$res_data_master = db_query($qry_master);

					while ($row_rs_tmprs_master = array_shift($res_data_master)) {

						

						$com_ind_parent = get_industry($row_rs_tmprs_master["parent_comp_id"]);

						if($industry_type == $com_ind_parent ){

							if ($comp_id_list != "" && ($parent_comp_id_str != $row_rs_tmprs_master["parent_comp_id"]) && $parent_comp_id_str != ""){

								if ($comp_id_list != ""){

									$comp_id_list = substr(trim($comp_id_list), 1 , strlen($comp_id_list));

								}	

								

								//echo $parent_comp_str . " | " . $parent_comp_id_str . " = " . $row_rs_tmprs_master["parent_comp_id"] . " | " . $comp_id_list . "<br>";



								if( $_REQUEST["sales_purchase"] == "sales_record" ){

									$qry = "Select warehouse_name, warehouse_id, b2bid, count(*) as cnt from loop_transaction_buyer inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id where warehouse_id in ($comp_id_list) and `ignore` = 0 $show_recycling_flg_str $show_ucbzw_flg_str and (transaction_date >= '" . $date_from_val . "' and transaction_date <= '" . $date_to_val . "') order by count(*) desc "; 

								}

								if( $_REQUEST["sales_purchase"] == "purchasing_record" ){

									$qry = "Select warehouse_name,warehouse_id, b2bid, count(*) as cnt from loop_transaction inner join loop_warehouse on loop_warehouse.id = loop_transaction.warehouse_id where warehouse_id in ($comp_id_list) and `ignore` = 0 and (transaction_date >= '" . $date_from_val . "' and transaction_date <= '" . $date_to_val . "') order by count(*) desc "; 

								}

								//echo $qry . "<br>";

								$tot_cnt = 0; $cnt = 0; $new_cnt = 0; 

								db();
								$qry_res_p = db_query($qry);

								while($row = array_shift($qry_res_p)){

									$com_ind = '';

									$industry_chk = "No";

									if($industry_type != ''){

										$com_ind = get_industry($row["b2bid"]);

										if($industry_type == $com_ind ){

											$industry_chk = "Yes";

										}

									}else{

										$industry_chk = "Yes";

									}



									if($industry_chk == "Yes") {

										$new_cnt = $row["cnt"];

										$date_array=get_last_and_next_date($row["b2bid"]);

										$last_contact_date=$date_array['last_contact_date'];

										$next_date=$date_array['next_date'];

										if( $_REQUEST["sales_purchase"] == "sales_record" ){ 

											$last_delivery_date = "";

											$qry_last_delivery_date = "Select last_delivery_date from loop_warehouse WHERE b2bid = '".$row['b2bid']."' ORDER BY last_delivery_date desc limit 1";

											db();
											$qry_res_last_delivery_date = db_query($qry_last_delivery_date);

											while($row_last_delivery_date = array_shift($qry_res_last_delivery_date)){

												if ($row_last_delivery_date['last_delivery_date'] != "")

												{

													$last_delivery_date = date("m/d/Y", strtotime($row_last_delivery_date['last_delivery_date']));

												}	

											}	

										}

										if( $_REQUEST["sales_purchase"] == "purchasing_record" ){

											$bol_sort_date = "";

											$qry_bol_date = "Select last_sort_date as bol_sort_date from loop_warehouse WHERE id = '".$row['warehouse_id']."'";

											db();
											$qry_res_bol_date = db_query($qry_bol_date);

											while($row_bol_date = array_shift($qry_res_bol_date)){

												if ($row_bol_date['bol_sort_date'] != "")

												{

													$bol_sort_date = date("m/d/Y", strtotime($row_bol_date['bol_sort_date']));

												}	

											}	

										}

										$trans_array[] = array('trans_cnt' => $new_cnt, 'company' => $parent_comp_str, 'b2bid' => $parent_comp_id_str,'last_delivery_date'=>$last_delivery_date,

										'last_contact_date'=>$last_contact_date,'next_date'=>$next_date, 'bol_sort_date'=>$bol_sort_date);

									}

								}



								$comp_id_list = "";

							}



							if ($parent_comp_id_str != $row_rs_tmprs_master["parent_comp_id"]){

								db();
								$qry_res_p = db_query("Select id from loop_warehouse where b2bid = '" . $row_rs_tmprs_master["parent_comp_id"] . "'");

								while($row = array_shift($qry_res_p)){

									$comp_id_list = $comp_id_list . "," . $row["id"];

								}

							}



							if ($row_rs_tmprs_master["loopid"] > 0){

								$comp_id_list = $comp_id_list . "," . $row_rs_tmprs_master["loopid"];

							}	

							

							$parent_comp_id_str = $row_rs_tmprs_master["parent_comp_id"];

							$parent_comp_str = $row_rs_tmprs_master["company"];

						}

					}

					

					$MGArraysort_I = array();

					foreach ($trans_array as $MGArraytmp) {

						$MGArraysort_I[] = $MGArraytmp['trans_cnt'];

					}

					array_multisort($MGArraysort_I,SORT_DESC,SORT_NUMERIC,$trans_array); 

					

					$cnt = 0; $tot_cnt = 0;

					foreach ($trans_array as $MGArraytmp2) {

						if ($txt_no_rec > 0) {

							if ($txt_no_rec <= $cnt){ break; }

						}				

						?>					

							<tr>

								<td style="width: 50"class="style3" align="left">

									<?php echo get_account_owner($MGArraytmp2["b2bid"]); ?>

								</td>

								<td style="width: 300"class="style3" align="left">

									<a target="_blank" href="viewCompany.php?ID=<?php echo $MGArraytmp2["b2bid"]; ?>"><?php echo get_nickname_val($MGArraytmp2["company"], $MGArraytmp2["b2bid"]); ?></a>

								</td>

								<td style="width: 200"class="style3" align="right">

									<?php echo $MGArraytmp2["trans_cnt"]; ?>

								</td>

								

								<?php if( $_REQUEST["sales_purchase"] == "sales_record" ){ ?>

								<td>

									<?php echo $MGArraytmp2['last_delivery_date']; ?>

								</td>

								<?php } if( $_REQUEST["sales_purchase"] == "purchasing_record" ){ ?> 

								<td>

									<?php echo $MGArraytmp2['bol_sort_date']; ?>

								</td>

								<?php } ?>

								<td class="<?php echo condition_check_for_dates($MGArraytmp2['last_contact_date']); ?>">

									<?php echo $MGArraytmp2['last_contact_date']; ?>

								</td>

								<td class="<?php echo condition_check_for_dates($MGArraytmp2['next_date']); ?>">

									<?php echo $MGArraytmp2['next_date']; ?>

								</td>

							</tr>

						<?php	

						$tot_cnt = $tot_cnt + $MGArraytmp2["trans_cnt"];

						$cnt = $cnt + 1;

					}

					

					if ($tot_cnt > 0 ){

					?>					

						<tr>

							<td colspan="2" style="width: 300"class="style3" align="right">

								<b>Total:<b>

							</td>

							<td style="width: 200"class="style3" align="right">

								<b><?php echo $tot_cnt; ?></b>

							</td>

							<td colspan="3" style="width: 300"class="style3" align="right">

								&nbsp;

							</td>

						</tr>

					<?php	

					}					

					

				}	

			}	



			//Payments for Purchasing

			if( $trans_rev_profit_sel == "payments" ){

					

				if( $_REQUEST["sales_purchase"] == "purchasing_record" ){

					if ($show_parent_str == ""){

						$qry = "Select warehouse_name, b2bid, loop_transaction.warehouse_id,  sum(boxgood*sort_boxgoodvalue) as cnt from loop_transaction inner join loop_warehouse on loop_warehouse.id = loop_transaction.warehouse_id inner join loop_boxes_sort on loop_boxes_sort.trans_rec_id = loop_transaction.id INNER JOIN loop_boxes ON loop_boxes_sort.box_id = loop_boxes.id where `ignore` = 0 and boxgood > 0 and pr_requestdate_php >= '" . $date_from_val . "' and pr_requestdate_php <= '" . $date_to_val . "' group by loop_transaction.warehouse_id order by cnt desc "; 

						db();

						$tot_cnt = 0; $cnt = 0;

						$qry_res_p = db_query($qry);

						while($row = array_shift($qry_res_p)){

							$is_parent = "no";

							$com_ind = '';

							$industry_chk = "No";

							if($industry_type != ''){

								$com_ind = get_industry($row["b2bid"]);

								if($industry_type == $com_ind ){

									$industry_chk = "Yes";

								}

							}else{

								$industry_chk = "Yes";

							}



							if($industry_chk == "Yes") {

								$bol_sort_date = "";

								$qry_bol_date = "Select last_sort_date as bol_sort_date from loop_warehouse WHERE id = '".$row['warehouse_id']."'";

								db();
								$qry_res_bol_date = db_query($qry_bol_date);

								while($row_bol_date = array_shift($qry_res_bol_date)){

									if ($row_bol_date['bol_sort_date'] != "")

									{

										$bol_sort_date = date("m/d/Y", strtotime($row_bol_date['bol_sort_date']));

									}	

								}	

								

								$date_array=get_last_and_next_date($row["b2bid"]);

								$last_contact_date=$date_array['last_contact_date'];

								$next_date=$date_array['next_date'];

								if ($txt_no_rec > 0) {

									if ($txt_no_rec <= $cnt){ break; }

								}

								

								$other_charges = 0;

								$qry_child = "Select warehouse_name, b2bid, sum(freightcharge) as sumfreightcharge, sum(othercharge) as sumothercharge from loop_transaction inner join loop_warehouse on loop_warehouse.id = loop_transaction.warehouse_id where `ignore` = 0 and pr_requestdate_php >= '" . $date_from_val . "' and pr_requestdate_php <= '" . $date_to_val . "' and loop_transaction.warehouse_id = '" . $row["warehouse_id"] . "'"; 

								db();
								$qry_res_p_child = db_query($qry_child);

								while($row_child = array_shift($qry_res_p_child)){

									$other_charges = $row_child["sumfreightcharge"] + $row_child["sumothercharge"];

								}

								

							?>					

								<tr>

									<td style="width: 50"class="style3" align="left">

										<?php echo get_account_owner($row["b2bid"]); ?>

									</td>

									<td style="width: 300"class="style3" align="left">

										<a target="_blank" href="viewCompany.php?ID=<?php echo $row["b2bid"]; ?>"><?php echo get_nickname_val($row["warehouse_name"], $row["b2bid"]); ?></a>

									</td>

									<td style="width: 200"class="style3" align="right">

										$<?php echo number_format($row["cnt"]+$other_charges,0); ?>

									</td>

									<td>

										<?php echo $bol_sort_date; ?>

									</td>

									<td class="<?php echo condition_check_for_dates($last_contact_date); ?>">

										<?php echo $last_contact_date; ?>

									</td>

									<td class="<?php echo condition_check_for_dates($next_date); ?>">

										<?php echo $next_date; ?>

									</td>

								</tr>

							<?php	

								$tot_cnt = $tot_cnt + ($row["cnt"]+$other_charges);

								$cnt = $cnt + 1;

							}

						}

						

						if ($tot_cnt > 0 ){

						?>					

							<tr>

								<td style="width: 300"class="style3" align="right">

									<b>Total:</b>

								</td>

								<td style="width: 200"class="style3" align="right">

									$<b><?php echo number_format($tot_cnt,0); ?></b> 

								</td>

								<td colspan="3" style="width: 300"class="style3" align="right">

									&nbsp;

								</td>

							</tr>

						<?php	

						}

					}

				

					//Parent case

					if ($show_parent_str != ""){

						$comp_id_list = ""; $comp_b2bid_list = ""; $parent_comp_id_str = ""; $parent_comp_str = "";

						$trans_array = array();

						$qry_master = "Select parent_comp_id, company, ID, loopid FROM companyInfo where  companyInfo.status not in(24,31,49) and companyInfo.active=1 and companyInfo.loopid > 0 and 

						parent_comp_id in (Select ID FROM companyInfo where (parent_child = 'Parent')

						and haveNeed = UPPER('have boxes') and active = 1) and (parent_child = 'Child') 

						union

						Select ID as parent_comp_id, company, ID, loopid FROM companyInfo where  companyInfo.status not in(24,31,49) and companyInfo.active=1 and companyInfo.loopid > 0

						and haveNeed = UPPER('have boxes') and active = 1 and (parent_child = '' or (parent_child = 'Parent' and parent_comp_id = 0))

						order by parent_comp_id, loopid";

						db_b2b();

						$res_data_master = db_query($qry_master);

						while ($row_rs_tmprs_master = array_shift($res_data_master)) {

							

							if ($comp_id_list != "" && ($parent_comp_id_str != $row_rs_tmprs_master["parent_comp_id"]) && $parent_comp_id_str != ""){

								if ($comp_id_list != ""){

									$comp_id_list = substr(trim($comp_id_list), 1 , strlen($comp_id_list));

								}	

								

								//echo $parent_comp_str . " | " . $parent_comp_id_str . " = " . $row_rs_tmprs_master["parent_comp_id"] . " | " . $comp_id_list . "<br>";



								$qry = "Select warehouse_name, b2bid, loop_transaction.warehouse_id,  sum(boxgood*sort_boxgoodvalue) as cnt 

								from loop_transaction inner join loop_warehouse on loop_warehouse.id = loop_transaction.warehouse_id 

								inner join loop_boxes_sort on loop_boxes_sort.trans_rec_id = loop_transaction.id 

								INNER JOIN loop_boxes ON loop_boxes_sort.box_id = loop_boxes.id where `ignore` = 0 and boxgood > 0 

								and loop_transaction.warehouse_id in ($comp_id_list)

								and pr_requestdate_php >= '" . $date_from_val . "' and pr_requestdate_php <= '" . $date_to_val . "' group by loop_transaction.warehouse_id order by cnt desc "; 

								//echo $qry . "<br>";

								$tot_cnt = 0; $cnt = 0; $new_cnt = 0;

								db();
								$qry_res_p = db_query($qry);

								while($row = array_shift($qry_res_p)){

									

									$is_parent = "no";

									$com_ind = '';

									$industry_chk = "No";

									if($industry_type != ''){

										$com_ind = get_industry($row["b2bid"]);

										if($industry_type == $com_ind ){

											$industry_chk = "Yes";

										}

									}else{

										$industry_chk = "Yes";

									}



									if($industry_chk == "Yes") {

										$bol_sort_date = "";

										$qry_bol_date = "Select last_sort_date as bol_sort_date from loop_warehouse WHERE id = '".$row['warehouse_id']."'";

										db();
										$qry_res_bol_date = db_query($qry_bol_date);

										while($row_bol_date = array_shift($qry_res_bol_date)){

											if ($row_bol_date['bol_sort_date'] != "")

											{

												$bol_sort_date = date("m/d/Y", strtotime($row_bol_date['bol_sort_date']));

											}	

										}	



										$date_array=get_last_and_next_date($row["b2bid"]);

										$last_contact_date=$date_array['last_contact_date'];

										$next_date=$date_array['next_date'];

									

										if ($txt_no_rec > 0) {

											if ($txt_no_rec <= $cnt){ break; }

										}

									

										$other_charges = 0;

										$qry_child = "Select warehouse_name, b2bid, sum(freightcharge) as sumfreightcharge, sum(othercharge) as sumothercharge from loop_transaction inner join loop_warehouse on loop_warehouse.id = loop_transaction.warehouse_id where `ignore` = 0 and pr_requestdate_php >= '" . $date_from_val . "' and pr_requestdate_php <= '" . $date_to_val . "' and loop_transaction.warehouse_id = '" . $row["warehouse_id"] . "'"; 

										db();
										$qry_res_p_child = db_query($qry_child);

										while($row_child = array_shift($qry_res_p_child)){

											$other_charges = $row_child["sumfreightcharge"] + $row_child["sumothercharge"];

										}								

									

										$new_cnt = $new_cnt + str_replace(",", "", number_format($row["cnt"]+$other_charges,0));

									}

								}

								if ($new_cnt > 0) {

									//echo "Data found = ". $parent_comp_str . " | " . $parent_comp_id_str . " = " . $row_rs_tmprs_master["parent_comp_id"] . " | " . $comp_id_list . "<br>";

									

									$trans_array[] = array('trans_cnt' => $new_cnt, 'company' => $parent_comp_str, 'b2bid' => $parent_comp_id_str,

										'last_contact_date'=>$last_contact_date,'next_date'=>$next_date, 'bol_sort_date'=>$bol_sort_date);

								}

								$comp_id_list = "";

							}



							if ($parent_comp_id_str != $row_rs_tmprs_master["parent_comp_id"]){

								db();
								$qry_res_p = db_query("Select id from loop_warehouse where b2bid = '" . $row_rs_tmprs_master["parent_comp_id"] . "'");

								while($row = array_shift($qry_res_p)){

									$comp_id_list = $comp_id_list . "," . $row["id"];

								}

							}



							if ($row_rs_tmprs_master["loopid"] > 0){

								$comp_id_list = $comp_id_list . "," . $row_rs_tmprs_master["loopid"];

							}	

							

							$parent_comp_id_str = $row_rs_tmprs_master["parent_comp_id"];

							$parent_comp_str = $row_rs_tmprs_master["company"];

						}

						

						$MGArraysort_I = array();

						foreach ($trans_array as $MGArraytmp) {

							$MGArraysort_I[] = $MGArraytmp['trans_cnt'];

						}

						array_multisort($MGArraysort_I,SORT_DESC,SORT_NUMERIC,$trans_array); 

						

						$cnt = 0; $tot_cnt = 0;

						foreach ($trans_array as $MGArraytmp2) {

							if ($txt_no_rec > 0) {

								if ($txt_no_rec <= $cnt){ break; }

							}				

							?>					

								<tr>

									<td style="width: 50"class="style3" align="left">

										<?php echo get_account_owner($MGArraytmp2["b2bid"]); ?>

									</td>

									<td style="width: 300"class="style3" align="left">

										<a target="_blank" href="viewCompany.php?ID=<?php echo $MGArraytmp2["b2bid"]; ?>"><?php echo get_nickname_val($MGArraytmp2["company"], $MGArraytmp2["b2bid"]); ?></a>

									</td>

									<td style="width: 200"class="style3" align="right">

										$<?php echo number_format($MGArraytmp2["trans_cnt"],0); ?>

									</td>

									<td>

										<?php echo $MGArraytmp2['bol_sort_date']; ?>

									</td>

									<td class="<?php echo condition_check_for_dates($MGArraytmp2['last_contact_date']); ?>">

										<?php echo $MGArraytmp2['last_contact_date']; ?>

									</td>

									<td class="<?php echo condition_check_for_dates($MGArraytmp2['next_date']); ?>">

										<?php echo $MGArraytmp2['next_date']; ?>

									</td>

								</tr>

							<?php	

							$tot_cnt = $tot_cnt + $MGArraytmp2["trans_cnt"];

							$cnt = $cnt + 1;

						}

						

						if ($tot_cnt > 0 ){

						?>					

							<tr>

								<td colspan="2" style="width: 300"class="style3" align="right">

									<b>Total:<b>

								</td>

								<td style="width: 200"class="style3" align="right">

									<b>$<?php echo number_format($tot_cnt,0); ?></b>

								</td>

								<td colspan="3" style="width: 300"class="style3" align="right">

									&nbsp;

								</td>

								

							</tr>

						<?php	

						}		

					}											

				}	

			}	

			

			if( $trans_rev_profit_sel == "revenue" ){

				if( $_REQUEST["sales_purchase"] == "sales_record" ){

					if ($show_parent_str == ""){

						//$qry = "Select warehouse_name, b2bid, sum(inv_amount) as cnt from loop_transaction_buyer inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id where `ignore` = 0 $show_recycling_flg_str and (DATE_FORMAT(STR_TO_DATE(loop_transaction_buyer.inv_date_of, '%m/%d/%Y'), '%Y-%m-%d') >= '" . $date_from_val . "' and DATE_FORMAT(STR_TO_DATE(loop_transaction_buyer.inv_date_of, '%m/%d/%Y'), '%Y-%m-%d') <= '" . $date_to_val . "') group by warehouse_id order by sum(inv_amount) desc "; 

						//sum(total_revenue)

						$qry = "Select warehouse_name, warehouse_id, b2bid, sum(inv_amount) as cnt from loop_transaction_buyer inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id where `ignore` = 0 $show_recycling_flg_str $show_ucbzw_flg_str and (DATE_FORMAT(STR_TO_DATE(loop_transaction_buyer.inv_date_of, '%m/%d/%Y'), '%Y-%m-%d') >= '" . $date_from_val . "' and DATE_FORMAT(STR_TO_DATE(loop_transaction_buyer.inv_date_of, '%m/%d/%Y'), '%Y-%m-%d') <= '" . $date_to_val . "') group by warehouse_id order by sum(inv_amount) desc "; 

						//echo $qry . "<br>";

						$tot_cnt = 0; $cnt = 0;

						db();
						$qry_res_p = db_query($qry);

						while($row = array_shift($qry_res_p)){

							$is_parent = "no";

							$com_ind = '';

							$industry_chk = "No";

							if($industry_type != ''){

								$com_ind = get_industry($row["b2bid"]);

								if($industry_type == $com_ind ){

									$industry_chk = "Yes";

								}

							}else{

								$industry_chk = "Yes";

							}



							if($industry_chk == "Yes") {



								$date_array=get_last_and_next_date($row["b2bid"]);

								$last_contact_date=$date_array['last_contact_date'];

								$next_date=$date_array['next_date'];

								

								$last_delivery_date = "";		

								$qry_last_delivery_date = "Select last_delivery_date from loop_warehouse WHERE b2bid = '".$row['b2bid']."' ORDER BY last_delivery_date desc limit 1";

								db();
								$qry_res_last_delivery_date = db_query($qry_last_delivery_date);

								while($row_last_delivery_date = array_shift($qry_res_last_delivery_date)){

									if ($row_last_delivery_date['last_delivery_date'] != "")

									{

										$last_delivery_date = date("m/d/Y", strtotime($row_last_delivery_date['last_delivery_date']));

									}	

								}	

							

								if ($txt_no_rec > 0) {

									if ($txt_no_rec <= $cnt){ break; }

								}

							?>					

								<tr>

									<td style="width: 50"class="style3" align="left">

										<?php echo get_account_owner($row["b2bid"]); ?>

									</td>

								

									<td style="width: 300"class="style3" align="left">

										<a target="_blank" href="viewCompany.php?ID=<?php echo $row["b2bid"]; ?>"><?php echo get_nickname_val($row["warehouse_name"], $row["b2bid"]); ?></a>

									</td>

									<td style="width: 200"class="style3" align="right">

										$<?php echo number_format($row["cnt"],0); ?>

									</td>

									<td>

										<?php echo $last_delivery_date; ?>

									</td>

									<td class="<?php echo condition_check_for_dates($last_contact_date); ?>">

										<?php echo $last_contact_date; ?>

									</td>

									<td class="<?php echo condition_check_for_dates($next_date); ?>">

										<?php echo $next_date; ?>

									</td>

								</tr>

							<?php	

								$tot_cnt = $tot_cnt + ($row["cnt"]);

								$cnt = $cnt + 1;

							}

						}

						

						if ($tot_cnt > 0 ){

						?>					

							<tr>

								<td colspan="2" style="width: 300"class="style3" align="right">

									<b>Total:</b>

								</td>

								<td style="width: 200"class="style3" align="right">

									$<b><?php echo number_format($tot_cnt,0); ?></b> 

								</td>

								<td colspan="3" style="width: 300"class="style3" align="right">

									&nbsp;

								</td>

							</tr>

						<?php	

						}

					}

				

					//Parent case

					if ($show_parent_str != ""){
						
						$comp_id_list = ""; $comp_b2bid_list = ""; $parent_comp_id_str = ""; $parent_comp_str = "";

						$trans_array = array();

						$qry_master = "Select parent_comp_id, company, ID, loopid FROM companyInfo where  companyInfo.status not in(24,31,49) and companyInfo.active=1 and companyInfo.loopid > 0 and 

						parent_comp_id in (Select ID FROM companyInfo where (parent_child = 'Parent')

						and haveNeed = UPPER('Need boxes') and active = 1) and (parent_child = 'Child') 

						union

						Select ID as parent_comp_id, company, ID, loopid FROM companyInfo where  companyInfo.status not in(24,31,49) and companyInfo.active=1 and companyInfo.loopid > 0

						and haveNeed = UPPER('Need boxes') and active = 1 and (parent_child = '' or (parent_child = 'Parent' and parent_comp_id = 0))

						order by parent_comp_id, loopid";

						db_b2b();

						$res_data_master = db_query($qry_master);

						while ($row_rs_tmprs_master = array_shift($res_data_master)) {

							if ($comp_id_list != "" && ($parent_comp_id_str != $row_rs_tmprs_master["parent_comp_id"]) && $parent_comp_id_str != ""){

								if ($comp_id_list != ""){

									$comp_id_list = substr(trim($comp_id_list), 1 , strlen($comp_id_list));

								}	

								

								//echo $parent_comp_str . " | " . $parent_comp_id_str . " = " . $row_rs_tmprs_master["parent_comp_id"] . " | " . $comp_id_list . "<br>";

								$qry = "Select warehouse_name,warehouse_id,b2bid, sum(inv_amount) as cnt from loop_transaction_buyer inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id 

								where `ignore` = 0 $show_recycling_flg_str $show_ucbzw_flg_str and warehouse_id in ($comp_id_list) and (DATE_FORMAT(STR_TO_DATE(loop_transaction_buyer.inv_date_of, '%m/%d/%Y'), '%Y-%m-%d') >= '" . $date_from_val . "' and DATE_FORMAT(STR_TO_DATE(loop_transaction_buyer.inv_date_of, '%m/%d/%Y'), '%Y-%m-%d') <= '" . $date_to_val . "') 

								order by sum(inv_amount) desc "; 

								//echo $qry . "<br>";

								$tot_cnt = 0; $cnt = 0; $new_cnt = 0;

								db();
								$qry_res_p = db_query($qry);

								while($row = array_shift($qry_res_p)){

							

									$is_parent = "no";

									$com_ind = '';

									$industry_chk = "No";

									if($industry_type != ''){

										$com_ind = get_industry($row["b2bid"]);

										if($industry_type == $com_ind ){

											$industry_chk = "Yes";

										}

									}else{

										$industry_chk = "Yes";

									}



									if($industry_chk == "Yes") {

									

										$date_array=get_last_and_next_date($row["b2bid"]);

										$last_contact_date=$date_array['last_contact_date'];

										$next_date=$date_array['next_date'];

									

										$last_delivery_date = "";

										$qry_last_delivery_date = "Select last_delivery_date from loop_warehouse WHERE b2bid = '".$row['b2bid']."' ORDER BY last_delivery_date desc limit 1";

										db();
										$qry_res_last_delivery_date = db_query($qry_last_delivery_date);

										while($row_last_delivery_date = array_shift($qry_res_last_delivery_date)){

											if ($row_last_delivery_date['last_delivery_date'] != "")

											{

												$last_delivery_date = date("m/d/Y", strtotime($row_last_delivery_date['last_delivery_date']));

											}	

										}	

									

										if ($txt_no_rec > 0) {

											if ($txt_no_rec <= $cnt){ break; }

										}

										

										$new_cnt = str_replace(",", "", number_format($row["cnt"],0));

									}

								}

								if ($new_cnt > 0) {

									$trans_array[] = array('trans_cnt' => $new_cnt, 'company' => $parent_comp_str, 'b2bid' => $parent_comp_id_str,'last_delivery_date'=>$last_delivery_date,

										'last_contact_date'=>$last_contact_date,'next_date'=>$next_date);

								}

								$comp_id_list = "";

							}



							if ($parent_comp_id_str != $row_rs_tmprs_master["parent_comp_id"]){

								db();
								$qry_res_p = db_query("Select id from loop_warehouse where b2bid = '" . $row_rs_tmprs_master["parent_comp_id"] . "'");

								while($row = array_shift($qry_res_p)){

									$comp_id_list = $comp_id_list . "," . $row["id"];

								}

							}



							if ($row_rs_tmprs_master["loopid"] > 0){

								$comp_id_list = $comp_id_list . "," . $row_rs_tmprs_master["loopid"];

							}	

							

							$parent_comp_id_str = $row_rs_tmprs_master["parent_comp_id"];

							$parent_comp_str = $row_rs_tmprs_master["company"];

						}

						

						$MGArraysort_I = array();

						foreach ($trans_array as $MGArraytmp) {

							$MGArraysort_I[] = $MGArraytmp['trans_cnt'];

						}

						array_multisort($MGArraysort_I,SORT_DESC,SORT_NUMERIC,$trans_array); 

						

						$cnt = 0; $tot_cnt = 0;

						foreach ($trans_array as $MGArraytmp2) {

							if ($txt_no_rec > 0) {

								if ($txt_no_rec <= $cnt){ break; }

							}				

							?>					

								<tr>

									<td style="width: 50"class="style3" align="left">

										<?php echo get_account_owner($MGArraytmp2["b2bid"]); ?>

									</td>

									<td style="width: 300"class="style3" align="left">

										<a target="_blank" href="viewCompany.php?ID=<?php echo $MGArraytmp2["b2bid"]; ?>"><?php echo get_nickname_val($MGArraytmp2["company"], $MGArraytmp2["b2bid"]); ?></a>

									</td>

									<td style="width: 200"class="style3" align="right">

										$<?php echo number_format($MGArraytmp2["trans_cnt"],0); ?>

									</td>

									<td>

										<?php echo $MGArraytmp2['last_delivery_date']; ?>

									</td>

									<td class="<?php echo condition_check_for_dates($MGArraytmp2['last_contact_date']); ?>">

										<?php echo $MGArraytmp2['last_contact_date']; ?>

									</td>

									<td class="<?php echo condition_check_for_dates($MGArraytmp2['next_date']); ?>">

										<?php echo $MGArraytmp2['next_date']; ?>

									</td>

								</tr>

							<?php	

							$tot_cnt = $tot_cnt + $MGArraytmp2["trans_cnt"];

							$cnt = $cnt + 1;

						}

						

						if ($tot_cnt > 0 ){

						?>					

							<tr>

								<td colspan="2" style="width: 300"class="style3" align="right">

									<b>Total:<b>

								</td>

								<td style="width: 200"class="style3" align="right">

									<b>$<?php echo number_format($tot_cnt,0); ?></b>

								</td>

								<td colspan="3" style="width: 300"class="style3" align="right">

									&nbsp;

								</td>

								

							</tr>

						<?php	

						}								

					}						

				}

				if ($_REQUEST["sales_purchase"] == "purchasing_record" ){

					if ($show_parent_str == ""){

						$qry = "Select warehouse_name, warehouse_id, b2bid, sum(estimated_revenue) as cnt from loop_transaction inner join loop_warehouse on loop_warehouse.id = loop_transaction.warehouse_id where `ignore` = 0 and transaction_date >= '" . $date_from_val . "' and transaction_date <= '" . $date_to_val . "' group by warehouse_id order by sum(estimated_revenue) desc "; 

						//echo $qry . "<br>";

						$tot_cnt = 0; $cnt = 0;

						db();
						$qry_res_p = db_query($qry);

						while($row = array_shift($qry_res_p)){

							$is_parent = "no";

							$com_ind = '';

							$industry_chk = "No";

							if($industry_type != ''){

								$com_ind = get_industry($row["b2bid"]);

								if($industry_type == $com_ind ){

									$industry_chk = "Yes";

								}

							}else{

								$industry_chk = "Yes";

							}



							if($industry_chk == "Yes") {

								$date_array=get_last_and_next_date($row["b2bid"]);

								$last_contact_date=$date_array['last_contact_date'];

								$next_date=$date_array['next_date'];

								

								$bol_sort_date = "";

								$qry_bol_date = "Select last_sort_date as bol_sort_date from loop_warehouse WHERE id = '".$row['warehouse_id']."'";

								db();
								$qry_res_bol_date = db_query($qry_bol_date);

								while($row_bol_date = array_shift($qry_res_bol_date)){

									if ($row_bol_date['bol_sort_date'] != "")

									{

										$bol_sort_date = date("m/d/Y", strtotime($row_bol_date['bol_sort_date']));

									}	

								}	

								

								if ($txt_no_rec > 0) {

									if ($txt_no_rec <= $cnt){ break; }

								}

							?>					

								<tr>

									<td style="width: 50"class="style3" align="left">

										<?php echo get_account_owner($row["b2bid"]); ?>

									</td>

								

									<td style="width: 300"class="style3" align="left">

										<a target="_blank" href="viewCompany.php?ID=<?php echo $row["b2bid"]; ?>"><?php echo get_nickname_val($row["warehouse_name"], $row["b2bid"]); ?></a>

									</td>

									<td style="width: 200"class="style3" align="right">

										$<?php echo number_format($row["cnt"],0); ?>

									</td>

									<td>

										<?php echo $bol_sort_date; ?>

									</td>

									<td class="<?php echo condition_check_for_dates($last_contact_date); ?>">

										<?php echo $last_contact_date; ?>

									</td>

									<td class="<?php echo condition_check_for_dates($next_date); ?>">

										<?php echo $next_date; ?>

									</td>

								</tr>

							<?php	

								$tot_cnt = $tot_cnt + ($row["cnt"]);

								$cnt = $cnt + 1;

							}

						}

						

						if ($tot_cnt > 0 ){

						?>					

							<tr>

								<td colspan="2" style="width: 300"class="style3" align="right">

									<b>Total:</b>

								</td>

								<td style="width: 200"class="style3" align="right">

									$<b><?php echo number_format($tot_cnt,0); ?></b> 

								</td>

								<td colspan="3" style="width: 300"class="style3" align="right">

									&nbsp;

								</td>

							</tr>

						<?php	

						}

					}

				

					//Parent case

					if ($show_parent_str != ""){

						$comp_id_list = ""; $comp_b2bid_list = ""; $parent_comp_id_str = ""; $parent_comp_str = "";

						$trans_array = array();

						$qry_master = "Select parent_comp_id, company, ID, loopid FROM companyInfo where  companyInfo.status not in(24,31,49) and companyInfo.active=1 and companyInfo.loopid > 0 and 

						parent_comp_id in (Select ID FROM companyInfo where (parent_child = 'Parent')

						and haveNeed = UPPER('Have boxes') and active = 1) and (parent_child = 'Child') 

						union

						Select ID as parent_comp_id, company, ID, loopid FROM companyInfo where  companyInfo.status not in(24,31,49) and companyInfo.active=1 and companyInfo.loopid > 0

						and haveNeed = UPPER('Have boxes') and active = 1 and (parent_child = '' or (parent_child = 'Parent' and parent_comp_id = 0))

						order by parent_comp_id, loopid";

						db_b2b();

						$res_data_master = db_query($qry_master);

						while ($row_rs_tmprs_master = array_shift($res_data_master)) {

							

							if ($comp_id_list != "" && ($parent_comp_id_str != $row_rs_tmprs_master["parent_comp_id"]) && $parent_comp_id_str != ""){

								if ($comp_id_list != ""){

									$comp_id_list = substr(trim($comp_id_list), 1 , strlen($comp_id_list));

								}	

								

								//echo $parent_comp_str . " | " . $parent_comp_id_str . " = " . $row_rs_tmprs_master["parent_comp_id"] . " | " . $comp_id_list . "<br>";

								$qry = "Select warehouse_name, warehouse_id, b2bid, sum(estimated_revenue) as cnt from loop_transaction inner join loop_warehouse on loop_warehouse.id = loop_transaction.warehouse_id 

								where `ignore` = 0 and warehouse_id in ($comp_id_list) and transaction_date >= '" . $date_from_val . "' and transaction_date <= '" . $date_to_val . "' order by sum(estimated_revenue) desc "; 

								//echo $qry . "<br>";

								$tot_cnt = 0; $cnt = 0; $new_cnt = 0;

								db();
								$qry_res_p = db_query($qry);

								while($row = array_shift($qry_res_p)){

									$is_parent = "no";

									$com_ind = '';

									$industry_chk = "No";

									if($industry_type != ''){

										$com_ind = get_industry($row["b2bid"]);

										if($industry_type == $com_ind ){

											$industry_chk = "Yes";

										}

									}else{

										$industry_chk = "Yes";

									}



									if($industry_chk == "Yes") {

										$bol_sort_date = "";

										$qry_bol_date = "Select last_sort_date as bol_sort_date from loop_warehouse WHERE id = '".$row['warehouse_id']."'";

										db();
										$qry_res_bol_date = db_query($qry_bol_date);

										while($row_bol_date = array_shift($qry_res_bol_date)){

											if ($row_bol_date['bol_sort_date'] != "")

											{

												$bol_sort_date = date("m/d/Y", strtotime($row_bol_date['bol_sort_date']));

											}	

										}	

										

										if ($txt_no_rec > 0) {

											if ($txt_no_rec <= $cnt){ break; }

										}

										

										$new_cnt = str_replace(",", "", number_format($row["cnt"],0));

									}

								}

								if ($new_cnt > 0) {

									$trans_array[] = array('trans_cnt' => $new_cnt, 'company' => $parent_comp_str, 'b2bid' => $parent_comp_id_str, 'last_contact_date'=>$last_contact_date,'next_date'=>$next_date, 'bol_sort_date'=>$bol_sort_date);

								}

								$comp_id_list = "";

							}



							if ($parent_comp_id_str != $row_rs_tmprs_master["parent_comp_id"]){

								db();
								$qry_res_p = db_query("Select id from loop_warehouse where b2bid = '" . $row_rs_tmprs_master["parent_comp_id"] . "'");

								while($row = array_shift($qry_res_p)){

									$comp_id_list = $comp_id_list . "," . $row["id"];

								}

							}



							if ($row_rs_tmprs_master["loopid"] > 0){

								$comp_id_list = $comp_id_list . "," . $row_rs_tmprs_master["loopid"];

							}	

							

							$parent_comp_id_str = $row_rs_tmprs_master["parent_comp_id"];

							$parent_comp_str = $row_rs_tmprs_master["company"];

						}

						

						$MGArraysort_I = array();

						foreach ($trans_array as $MGArraytmp) {

							$MGArraysort_I[] = $MGArraytmp['trans_cnt'];

						}

						array_multisort($MGArraysort_I,SORT_DESC,SORT_NUMERIC,$trans_array); 

						

						$cnt = 0; $tot_cnt = 0;

						foreach ($trans_array as $MGArraytmp2) {

							if ($txt_no_rec > 0) {

								if ($txt_no_rec <= $cnt){ break; }

							}				

							?>					

								<tr>

									<td style="width: 50"class="style3" align="left">

										<?php echo get_account_owner($MGArraytmp2["b2bid"]); ?>

									</td>

									<td style="width: 300"class="style3" align="left">

										<a target="_blank" href="viewCompany.php?ID=<?php echo $MGArraytmp2["b2bid"]; ?>"><?php echo get_nickname_val($MGArraytmp2["company"], $MGArraytmp2["b2bid"]); ?></a>

									</td>

									<td style="width: 200"class="style3" align="right">

										$<?php echo number_format($MGArraytmp2["trans_cnt"],0); ?>

									</td>

									<td>

										<?php echo $MGArraytmp2['bol_sort_date']; ?>

									</td>

									<td class="<?php echo condition_check_for_dates($MGArraytmp2['last_contact_date']); ?>">

										<?php echo $MGArraytmp2['last_contact_date']; ?>

									</td>

									<td class="<?php echo condition_check_for_dates($MGArraytmp2['next_date']); ?>">

										<?php echo $MGArraytmp2['next_date']; ?>

									</td>

								</tr>

							<?php	

							$tot_cnt = $tot_cnt + $MGArraytmp2["trans_cnt"];

							$cnt = $cnt + 1;

						}

						

						if ($tot_cnt > 0 ){

						?>					

							<tr>

								<td colspan="2" style="width: 300"class="style3" align="right">

									<b>Total:<b>

								</td>

								<td style="width: 200"class="style3" align="right">

									<b>$<?php echo number_format($tot_cnt,0); ?></b>

								</td>

								<td colspan="3" style="width: 300"class="style3" align="right">

									&nbsp;

								</td>

								

							</tr>

						<?php	

						}								

						

					}											

				}	

			}	



			if( $trans_rev_profit_sel == "profit" ){

				if( $_REQUEST["sales_purchase"] == "sales_record" ){

					if ($show_parent_str == ""){

						$inv_amount = 0;	

						$mgsortarray = array(); $b2bid= 0;

						$qry = "Select warehouse_name,warehouse_id, b2bid, inv_amount, sum(total_profit) as profit_val from loop_transaction_buyer inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id where `ignore` = 0 $show_recycling_flg_str $show_ucbzw_flg_str and (DATE_FORMAT(STR_TO_DATE(loop_transaction_buyer.inv_date_of, '%m/%d/%Y'), '%Y-%m-%d') >= '" . $date_from_val . "' and DATE_FORMAT(STR_TO_DATE(loop_transaction_buyer.inv_date_of, '%m/%d/%Y'), '%Y-%m-%d') <= '" . $date_to_val . "') group by warehouse_id order by profit_val desc "; 

						db();

						$qry_res_p = db_query($qry);

						while($row = array_shift($qry_res_p)){

							

							$com_ind = '';

							$industry_chk = "No";

							if($industry_type != ''){

								$com_ind = get_industry($row["b2bid"]);

								if($industry_type == $com_ind ){

									$industry_chk = "Yes";

								}

							}else{

								$industry_chk = "Yes";

							}



							if($industry_chk == "Yes") {

								$last_delivery_date = "";

								$qry_last_delivery_date = "Select last_delivery_date from loop_warehouse WHERE b2bid = '".$row['b2bid']."' ORDER BY last_delivery_date desc limit 1";

								db();
								$qry_res_last_delivery_date = db_query($qry_last_delivery_date);

								while($row_last_delivery_date = array_shift($qry_res_last_delivery_date)){

									if ($row_last_delivery_date['last_delivery_date'] != "")

									{

										$last_delivery_date = date("m/d/Y", strtotime($row_last_delivery_date['last_delivery_date']));

									}	

								}	

								

								$date_array=get_last_and_next_date($row["b2bid"]);

								$last_contact_date=$date_array['last_contact_date'];

								$next_date=$date_array['next_date'];

								

								$profit_val = $row['profit_val'];

								if ($txt_no_rec > 0) {

									if ($txt_no_rec <= $cnt){ break; }

								}

						?>					

							<tr>

								<td style="width: 50"class="style3" align="left">

									<?php echo get_account_owner($row["b2bid"]); ?>

								</td>

							

								<td style="width: 300"class="style3" align="left">

									<a target="_blank" href="viewCompany.php?ID=<?php echo $row["b2bid"]; ?>"><?php echo get_nickname_val($row["warehouse_name"], $row["b2bid"]); ?></a>

								</td>

								<td style="width: 200"class="style3" align="right">

									$<?php echo number_format($profit_val,0); ?>

								</td>

								<td>

									<?php echo $last_delivery_date; ?>

								</td>

								<td class="<?php echo condition_check_for_dates($last_contact_date); ?>">

									<?php echo $last_contact_date; ?>

								</td>

								<td class="<?php echo condition_check_for_dates($next_date); ?>">

									<?php echo $next_date; ?>

								</td>

							</tr>

						<?php	

								$cnt = $cnt + 1;

								$tot_cnt = $tot_cnt  + $$profit_val;

							}

						}

						

						if ($tot_cnt > 0 ){

						?>					

							<tr>

								<td colspan="2" style="width: 300"class="style3" align="right">

									<b>Total:<b>

								</td>

								<td style="width: 200"class="style3" align="right">

									$<?php echo number_format($tot_cnt,0); ?>

								</td>

								<td colspan="3" style="width: 300"class="style3" align="right">

									&nbsp;

								</td>

								

							</tr>

						<?php	

						}						

					}	



					if ($show_parent_str != ""){

						$comp_id_list = ""; $comp_b2bid_list = ""; $parent_comp_id_str = ""; $parent_comp_str = "";

						$trans_array = array();

					
						$qry_master = "Select parent_comp_id, company, ID, loopid FROM companyInfo where  companyInfo.status not in(24,31,49) and companyInfo.active=1 and companyInfo.loopid > 0 and 

						parent_comp_id in (Select ID FROM companyInfo where (parent_child = 'Parent')

						and haveNeed = UPPER('Need boxes') and active = 1) and (parent_child = 'Child') 

						union

						Select ID as parent_comp_id, company, ID, loopid FROM companyInfo where  companyInfo.status not in(24,31,49) and companyInfo.active=1 and companyInfo.loopid > 0

						and haveNeed = UPPER('Need boxes') and active = 1 and (parent_child = '' or (parent_child = 'Parent' and parent_comp_id = 0))

						order by parent_comp_id, loopid";

						db_b2b();
						$res_data_master = db_query($qry_master);

						while ($row_rs_tmprs_master = array_shift($res_data_master)) {

							

							if ($comp_id_list != "" && ($parent_comp_id_str != $row_rs_tmprs_master["parent_comp_id"]) && $parent_comp_id_str != ""){

								if ($comp_id_list != ""){

									$comp_id_list = substr(trim($comp_id_list), 1 , strlen($comp_id_list));

								}	

								

								//echo $parent_comp_str . " | " . $parent_comp_id_str . " = " . $row_rs_tmprs_master["parent_comp_id"] . " | " . $comp_id_list . "<br>";

								$qry = "Select warehouse_name, warehouse_id, b2bid, inv_amount, sum(total_profit) as profit_val from loop_transaction_buyer inner join 

								loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id where warehouse_id in ($comp_id_list) and `ignore` = 0 $show_recycling_flg_str $show_ucbzw_flg_str 

								and (DATE_FORMAT(STR_TO_DATE(loop_transaction_buyer.inv_date_of, '%m/%d/%Y'), '%Y-%m-%d') >= '" . $date_from_val . "' and DATE_FORMAT(STR_TO_DATE(loop_transaction_buyer.inv_date_of, '%m/%d/%Y'), '%Y-%m-%d') <= '" . $date_to_val . "') order by profit_val desc "; 

								//echo $qry . "<br>";

								$tot_cnt = 0; $cnt = 0; $new_cnt = 0;

								db();
								$qry_res_p = db_query($qry);

								while($row = array_shift($qry_res_p)){

									$is_parent = "no";

									$com_ind = '';

									$industry_chk = "No";

									if($industry_type != ''){

										$com_ind = get_industry($row["b2bid"]);

										if($industry_type == $com_ind ){

											$industry_chk = "Yes";

										}

									}else{

										$industry_chk = "Yes";

									}



									if($industry_chk == "Yes") {

										$last_delivery_date = "";

										$qry_last_delivery_date = "Select last_delivery_date from loop_warehouse WHERE b2bid = '".$row['b2bid']."' ORDER BY last_delivery_date desc limit 1";

										db();
										$qry_res_last_delivery_date = db_query($qry_last_delivery_date);

										while($row_last_delivery_date = array_shift($qry_res_last_delivery_date)){

											if ($row_last_delivery_date['last_delivery_date'] != "")

											{

												$last_delivery_date = date("m/d/Y", strtotime($row_last_delivery_date['last_delivery_date']));

											}	

										}	



										$date_array=get_last_and_next_date($row["b2bid"]);

										$last_contact_date=$date_array['last_contact_date'];

										$next_date=$date_array['next_date'];



										if ($txt_no_rec > 0) {

											if ($txt_no_rec <= $cnt){ break; }

										}

										

										$new_cnt = str_replace(",", "", number_format($row["profit_val"],0));

										$cnt = $cnt + 1;

									}

								}

								if ($new_cnt > 0) {

									$trans_array[] = array('trans_cnt' => $new_cnt, 'company' => $parent_comp_str, 'b2bid' => $parent_comp_id_str, 'last_contact_date'=>$last_contact_date,'next_date'=>$next_date, 'last_delivery_date'=>$last_delivery_date);

								}

								$comp_id_list = "";

							}



							if ($parent_comp_id_str != $row_rs_tmprs_master["parent_comp_id"]){

								db();
								$qry_res_p = db_query("Select id from loop_warehouse where b2bid = '" . $row_rs_tmprs_master["parent_comp_id"] . "'");

								while($row = array_shift($qry_res_p)){

									$comp_id_list = $comp_id_list . "," . $row["id"];

								}

							}



							if ($row_rs_tmprs_master["loopid"] > 0){

								$comp_id_list = $comp_id_list . "," . $row_rs_tmprs_master["loopid"];

							}	

							

							$parent_comp_id_str = $row_rs_tmprs_master["parent_comp_id"];

							$parent_comp_str = $row_rs_tmprs_master["company"];

						}

						

						$MGArraysort_I = array();

						foreach ($trans_array as $MGArraytmp) {

							$MGArraysort_I[] = $MGArraytmp['trans_cnt'];

						}

						array_multisort($MGArraysort_I,SORT_DESC,SORT_NUMERIC,$trans_array); 

						

						$cnt = 0; $tot_cnt = 0;

						foreach ($trans_array as $MGArraytmp2) {

							if ($txt_no_rec > 0) {

								if ($txt_no_rec <= $cnt){ break; }

							}				

							?>					

								<tr>

									<td style="width: 50"class="style3" align="left">

										<?php echo get_account_owner($MGArraytmp2["b2bid"]); ?>

									</td>

									<td style="width: 300"class="style3" align="left">

										<a target="_blank" href="viewCompany.php?ID=<?php echo $MGArraytmp2["b2bid"]; ?>"><?php echo get_nickname_val($MGArraytmp2["company"], $MGArraytmp2["b2bid"]); ?></a>

									</td>

									<td style="width: 200"class="style3" align="right">

										$<?php echo number_format($MGArraytmp2["trans_cnt"],0); ?>

									</td>

									<td>

										<?php echo $MGArraytmp2['last_delivery_date']; ?>

									</td>

									<td class="<?php echo condition_check_for_dates($MGArraytmp2['last_contact_date']); ?>">

										<?php echo $MGArraytmp2['last_contact_date']; ?>

									</td>

									<td class="<?php echo condition_check_for_dates($MGArraytmp2['next_date']); ?>">

										<?php echo $MGArraytmp2['next_date']; ?>

									</td>

								</tr>

							<?php	

							$tot_cnt = $tot_cnt + $MGArraytmp2["trans_cnt"];

							$cnt = $cnt + 1;

						}

						

						if ($tot_cnt > 0 ){

						?>					

							<tr>

								<td colspan="2" style="width: 300"class="style3" align="right">

									<b>Total:<b>

								</td>

								<td style="width: 200"class="style3" align="right">

									<b>$<?php echo number_format($tot_cnt,0); ?></b>									

								</td>

								<td colspan="3" style="width: 300"class="style3" align="right">

									&nbsp;

								</td>

							</tr>

						<?php	

						}								

						

					}						

			   }	

				if( $_REQUEST["sales_purchase"] == "purchasing_record" ){

					if ($show_parent_str == ""){

						$inv_amount = 0;	

						$cnt = 0; $tot_cnt = 0;

						$b2bid= 0;

						$qry = "Select warehouse_name,warehouse_id, b2bid, sum(estimated_profit) as sumprofit , loop_transaction.id from loop_transaction inner join loop_warehouse on loop_warehouse.id = loop_transaction.warehouse_id where `ignore` = 0 and (transaction_date >= '" . $date_from_val . "' and transaction_date <= '" . $date_to_val . "') group by loop_warehouse.b2bid order by sumprofit desc"; 

						db();
						$qry_res_p = db_query($qry);

						while($row = array_shift($qry_res_p)){

							$com_ind = '';

							$industry_chk = "No";

							if($industry_type != ''){

								$com_ind = get_industry($row["b2bid"]);

								if($industry_type == $com_ind ){

									$industry_chk = "Yes";

								}

							}else{

								$industry_chk = "Yes";

							}



							if($industry_chk == "Yes") {

								$bol_sort_date = "";

								$qry_bol_date = "Select last_sort_date as bol_sort_date from loop_warehouse WHERE id = '".$row['warehouse_id']."'";

								db();
								$qry_res_bol_date = db_query($qry_bol_date);

								while($row_bol_date = array_shift($qry_res_bol_date)){

									if ($row_bol_date['bol_sort_date'] != "")

									{

										$bol_sort_date = date("m/d/Y", strtotime($row_bol_date['bol_sort_date']));

									}	

								}	



								$date_array=get_last_and_next_date($row["b2bid"]);

								$last_contact_date=$date_array['last_contact_date'];

								$next_date=$date_array['next_date'];

								

								$inv_amount = $row["sumprofit"];  



								$profit_val = $profit_val + ($inv_amount);

							

								if ($txt_no_rec > 0) {

									if ($txt_no_rec <= $cnt){ break; }

								}

						?>					

							<tr>

								<td style="width: 50"class="style3" align="left">

									<?php echo get_account_owner($row["b2bid"]); ?>

								</td>

							

								<td style="width: 300"class="style3" align="left">

									<a target="_blank" href="viewCompany.php?ID=<?php echo $row["b2bid"]; ?>"><?php echo get_nickname_val($row["warehouse_name"], $row["b2bid"]); ?></a>

								</td>

								<td style="width: 200"class="style3" align="right">

									$<?php echo number_format($row["sumprofit"],0); ?>

								</td>

								<td>

									<?php echo $bol_sort_date; ?>

								</td>

								<td class="<?php echo condition_check_for_dates($last_contact_date); ?>">

									<?php echo $last_contact_date; ?>

								</td>

								<td class="<?php echo condition_check_for_dates($next_date); ?>">

									<?php echo $next_date; ?>

								</td>

							</tr>

						<?php	

								$cnt = $cnt + 1;

								$tot_cnt = $tot_cnt  + $row["sumprofit"];

							}

						}

						

						if ($tot_cnt > 0 ){

						?>					

							<tr>

								<td colspan="2" style="width: 300"class="style3" align="right">

									<b>Total:<b>

								</td>

								<td style="width: 200"class="style3" align="right">

									$<?php echo number_format($tot_cnt,0); ?>

								</td>

								<td colspan="3" style="width: 300"class="style3" align="right">

									&nbsp;

								</td>

							</tr>

						<?php	

						}

					}	



					if ($show_parent_str != ""){

						$comp_id_list = ""; $comp_b2bid_list = ""; $parent_comp_id_str = ""; $parent_comp_str = "";

						$trans_array = array();

						$qry_master = "Select parent_comp_id, company, ID, loopid FROM companyInfo where  companyInfo.status not in(24,31,49) and companyInfo.active=1 and companyInfo.loopid > 0 and 

						parent_comp_id in (Select ID FROM companyInfo where (parent_child = 'Parent')

						and haveNeed = UPPER('Have boxes') and active = 1) and (parent_child = 'Child') 

						union

						Select ID as parent_comp_id, company, ID, loopid FROM companyInfo where  companyInfo.status not in(24,31,49) and companyInfo.active=1 and companyInfo.loopid > 0

						and haveNeed = UPPER('Have boxes') and active = 1 and (parent_child = '' or (parent_child = 'Parent' and parent_comp_id = 0))

						order by parent_comp_id, loopid";

						db_b2b();

						$res_data_master = db_query($qry_master);

						while ($row_rs_tmprs_master = array_shift($res_data_master)) {

							

							if ($comp_id_list != "" && ($parent_comp_id_str != $row_rs_tmprs_master["parent_comp_id"]) && $parent_comp_id_str != ""){

								if ($comp_id_list != ""){

									$comp_id_list = substr(trim($comp_id_list), 1 , strlen($comp_id_list));

								}	

								

								//echo $parent_comp_str . " | " . $parent_comp_id_str . " = " . $row_rs_tmprs_master["parent_comp_id"] . " | " . $comp_id_list . "<br>";

								$qry = "Select warehouse_name, warehouse_id, b2bid, sum(estimated_profit) as sumprofit , loop_transaction.id from loop_transaction 

								inner join loop_warehouse on loop_warehouse.id = loop_transaction.warehouse_id where warehouse_id in ($comp_id_list) and `ignore` = 0 and (transaction_date >= '" . $date_from_val . "' and transaction_date <= '" . $date_to_val . "') 

								order by sumprofit desc"; 

								//echo $qry . "<br>";

								$tot_cnt = 0; $cnt = 0; $new_cnt = 0;

								db();
								$qry_res_p = db_query($qry);

								while($row = array_shift($qry_res_p)){

									$is_parent = "no";

									$com_ind = '';

									$industry_chk = "No";

									if($industry_type != ''){

										$com_ind = get_industry($row["b2bid"]);

										if($industry_type == $com_ind ){

											$industry_chk = "Yes";

										}

									}else{

										$industry_chk = "Yes";

									}



									if($industry_chk == "Yes") {

										$date_array=get_last_and_next_date($row["b2bid"]);

										$last_contact_date=$date_array['last_contact_date'];

										$next_date=$date_array['next_date'];

										

										$bol_sort_date = "";

										$qry_bol_date = "Select last_sort_date as bol_sort_date from loop_warehouse WHERE id = '".$row['warehouse_id']."'";

										db();
										$qry_res_bol_date = db_query($qry_bol_date);

										while($row_bol_date = array_shift($qry_res_bol_date)){

											if ($row_bol_date['bol_sort_date'] != "")

											{

												$bol_sort_date = date("m/d/Y", strtotime($row_bol_date['bol_sort_date']));

											}	

										}	

										

										if ($txt_no_rec > 0) {

											if ($txt_no_rec <= $cnt){ break; }

										}

										

										$new_cnt = str_replace(",", "", number_format($row["sumprofit"],0));

										$cnt = $cnt + 1;

									}

								}

								if ($new_cnt > 0) {

									$trans_array[] = array('trans_cnt' => $new_cnt, 'company' => $parent_comp_str, 'b2bid' => $parent_comp_id_str, 'last_contact_date'=>$last_contact_date,'next_date'=>$next_date, 'bol_sort_date'=>$bol_sort_date);

								}

								$comp_id_list = "";

							}



							if ($parent_comp_id_str != $row_rs_tmprs_master["parent_comp_id"]){

								db();
								$qry_res_p = db_query("Select id from loop_warehouse where b2bid = '" . $row_rs_tmprs_master["parent_comp_id"] . "'");
								
								while($row = array_shift($qry_res_p)){

									$comp_id_list = $comp_id_list . "," . $row["id"];

								}

							}



							if ($row_rs_tmprs_master["loopid"] > 0){

								$comp_id_list = $comp_id_list . "," . $row_rs_tmprs_master["loopid"];

							}	

							

							$parent_comp_id_str = $row_rs_tmprs_master["parent_comp_id"];

							$parent_comp_str = $row_rs_tmprs_master["company"];

						}

						

						$MGArraysort_I = array();

						foreach ($trans_array as $MGArraytmp) {

							$MGArraysort_I[] = $MGArraytmp['trans_cnt'];

						}

						array_multisort($MGArraysort_I,SORT_DESC,SORT_NUMERIC,$trans_array); 

						

						$cnt = 0; $tot_cnt = 0;

						foreach ($trans_array as $MGArraytmp2) {

							if ($txt_no_rec > 0) {

								if ($txt_no_rec <= $cnt){ break; }

							}				

							?>					

								<tr>

									<td style="width: 50"class="style3" align="left">

										<?php echo get_account_owner($MGArraytmp2["b2bid"]); ?>

									</td>

									<td style="width: 300"class="style3" align="left">

										<a target="_blank" href="viewCompany.php?ID=<?php echo $MGArraytmp2["b2bid"]; ?>"><?php echo get_nickname_val($MGArraytmp2["company"], $MGArraytmp2["b2bid"]); ?></a>

									</td>

									<td style="width: 200"class="style3" align="right">

										$<?php echo number_format($MGArraytmp2["trans_cnt"],0); ?>

									</td>

									<td>

										<?php echo $MGArraytmp2['bol_sort_date']; ?>

									</td>

									<td class="<?php echo condition_check_for_dates($MGArraytmp2['last_contact_date']); ?>">

										<?php echo $MGArraytmp2['last_contact_date']; ?>

									</td>

									<td class="<?php echo condition_check_for_dates($MGArraytmp2['next_date']); ?>">

										<?php echo $MGArraytmp2['next_date']; ?>

									</td>

								</tr>

							<?php	

							$tot_cnt = $tot_cnt + $MGArraytmp2["trans_cnt"];

							$cnt = $cnt + 1;

						}

						

						if ($tot_cnt > 0 ){

						?>					

							<tr>

								<td colspan="2" style="width: 300"class="style3" align="right">

									<b>Total:<b>

								</td>

								<td style="width: 200"class="style3" align="right">

									<b>$<?php echo number_format($tot_cnt,0); ?></b>

								</td>

								<td colspan="3" style="width: 300"class="style3" align="right">

									&nbsp;

								</td>

							</tr>

						<?php	

						}								



					}						

			   }				   

			}	

			

			?>

	</table>

	<div ><font color="red">"END OF REPORT"</font></div>

	

	<?php

}

	?>

	</div>

</body>

</html>

