<?php
   require ("inc/header_session.php");
   require ("../mainfunctions/database.php");
   require ("../mainfunctions/general-functions.php");
?>
<!DOCTYPE html>
<html>
   <head>
      <title>Transactions Sold, Load # & Profit Report</title>
      <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
      <link rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>
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
      <script language="JavaScript" SRC="inc/CalendarPopup.js"></script><script language="JavaScript" SRC="inc/general.js"></script>
      <script language="JavaScript">document.write(getCalendarStyles());</script>
      <script language="JavaScript">
         var cal2xx = new CalendarPopup("listdiv");
         
         cal2xx.showNavigationDropdowns();
         
         function loadmainpg() 
         {
         	if(document.getElementById('date_from').value !="" && document.getElementById('date_to').value !="")
         	{
         		  //document.frmactive.action = "adminpg.php";
         	}else
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
      <div class="main_data_css">
         <div id="light" class="white_content"></div>
         <div id="fade" class="black_overlay"></div>
         <div class="dashboard_heading" style="float: left;">
            <div style="float: left;">
               Transactions Sold, Load # & Profit Report  
               <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
                  <span class="tooltiptext">This report shows the user all of the transactions sold within a date range, and state which load # it is for that customer (example, their first ordered load, their 5th loads, their 87th loads, etc), and how much gross profit we made off the transaction (and whether the gross profit calculation is finalized or estimated), and who sold the load.</span>
               </div>
               <br>
            </div>
         </div>
         <form method="get" name="report_transaction_list" action="report_transaction_list.php">
            <table border="0">
               <tr>
                  <td>Date Range Selector:</td>
                  <td>
                     <select name="date_filter" id="date_filter">
                        <option value="Closed Deal" <?php if ($_REQUEST["date_filter"] == "Closed Deal") { echo " selected "; }?> >Closed Deal</option>
                        <option value="Invoiced" <?php if ($_REQUEST["date_filter"] == "Invoiced") { echo " selected "; }?>>Invoiced</option>
                        <option value="Customer Paid" <?php if ($_REQUEST["date_filter"] == "Customer Paid") { echo " selected "; }?>>Customer Paid</option>
                     </select>
                  </td>
                  <td>Date Range Selector:</td>
                  <td>
                     From: 
                     <input type="text" name="date_from" id="date_from" size="10" value="<?php echo isset($_GET['date_from']) ? $_GET['date_from'] : ''; ?>" > 
                     <a href="#" onclick="cal2xx.select(document.report_transaction_list.date_from,'dtanchor2xx','MM/dd/yyyy'); return false;" name="dtanchor2xx" id="dtanchor2xx"><img border="0" src="images/calendar.jpg"></a>
                     <div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>
                     To: 
                     <input type="text" name="date_to" id="date_to" size="10" value="<?php echo isset($_GET['date_to']) ? $_GET['date_to'] : ''; ?>" > 
                     <a href="#" onclick="cal2xx.select(document.report_transaction_list.date_to,'dtanchor3xx','MM/dd/yyyy'); return false;" name="dtanchor3xx" id="dtanchor3xx"><img border="0" src="images/calendar.jpg"></a>
                  </td>
                  <td>
                     <input type=submit value="Run Report">
                  </td>
               </tr>
            </table>
         </form>
         <?php 
            $in_dt_range = "no";
            
            if( $_GET["date_from"] !="" && $_GET["date_to"] !=""){
            
            	$date_from_val = date("Y-m-d", strtotime($_GET["date_from"]));
            
            	$date_to_val = date("Y-m-d", strtotime($_GET["date_to"]));
            
            	$in_dt_range = "yes";
            
            }
            
            
            if ($in_dt_range == "yes"){
            
            ?>	
         <table width="900" cellSpacing="1" cellPadding="1" border="0" >
            <?php if ($_REQUEST["date_filter"] == "Closed Deal"){ ?>
            <tr>
               <td colspan=4 align=center><strong>List based on Closed Deal date range</strong></td>
            </tr>
            <?php } ?>	
            <?php if ($_REQUEST["date_filter"] == "Invoiced"){ ?>
            <tr>
               <td colspan=4 align=center><strong>List based on Invoiced date range</strong></td>
            </tr>
            <?php } ?>	
            <?php if ($_REQUEST["date_filter"] == "Customer Paid"){ ?>
            <tr>
               <td colspan=4 align=center><strong>List based on Customer Paid date range</strong></td>
            </tr>
            <?php } ?>	
            <tr>
               <td colspan=4 align=center>&nbsp;</td>
            </tr>
            <tr>
               <td colspan=4 class="txtstyle_color" align=center><strong>DEAL's Between <?php echo $date_from_val; ?> - <?php echo $date_to_val; ?></strong></td>
            </tr>
         </table>
         <table width="900" cellSpacing="1" cellPadding="1" border="0" id="table3" class="tablesorter">
            <thead>
               <tr>
                  <th align=center bgColor='#E4EAEB'>Account Owner</th>
                  <th align=center bgColor='#E4EAEB'>Company</th>
                  <th align=center bgColor='#E4EAEB'>Load #</th>
                  <th align=center bgColor='#E4EAEB'>PO Amount</th>
                  <th align=center bgColor='#E4EAEB'>Revenue Amount</th>
                  <th align=center bgColor='#E4EAEB'>Gross Profit</th>
                  <th align=center bgColor='#E4EAEB'>Costs Finalized?</th>
               </tr>
            </thead>
            <tbody>
               <?php
                  
                  if ($_REQUEST["date_filter"] == "Closed Deal"){
                  
                  	$sql = "SELECT loop_warehouse.b2bid , loop_transaction_buyer.inv_amount, loop_transaction_buyer.load_number, loop_transaction_buyer.po_poorderamount, loop_warehouse.warehouse_name, loop_warehouse.id as warehouse_id, loop_transaction_buyer.double_checked, loop_transaction_buyer.id AS I FROM loop_transaction_buyer INNER JOIN loop_warehouse ON loop_warehouse.id = loop_transaction_buyer.warehouse_id WHERE loop_transaction_buyer.ignore < 1 and " ;
                  
                  	$sql .= " loop_transaction_buyer.transaction_date >= '" . $date_from_val . "' and loop_transaction_buyer.transaction_date <= '" . $date_to_val . "' order by loop_warehouse.b2bid, loop_transaction_buyer.id"; 
                  
                  }
                  
                  if ($_REQUEST["date_filter"] == "Invoiced"){
                  
                  	$sql = "SELECT loop_warehouse.b2bid , loop_transaction_buyer.inv_amount, loop_transaction_buyer.load_number, loop_transaction_buyer.po_poorderamount, loop_warehouse.warehouse_name, loop_warehouse.id as warehouse_id, loop_transaction_buyer.double_checked, loop_transaction_buyer.id AS I FROM loop_transaction_buyer INNER JOIN loop_warehouse ON loop_warehouse.id = loop_transaction_buyer.warehouse_id WHERE loop_transaction_buyer.ignore < 1 and " ;
                  
                  	$sql .= " STR_TO_DATE(inv_date_of, '%m/%d/%Y') BETWEEN '" . $date_from_val . "' AND '" . $date_to_val . " 23:59:59' order by loop_warehouse.b2bid, loop_transaction_buyer.id"; 
                  
                  }
                  
                  if ($_REQUEST["date_filter"] == "Customer Paid"){
                  
                  	$sql = "SELECT loop_warehouse.b2bid , loop_transaction_buyer.inv_amount, loop_transaction_buyer.load_number, loop_transaction_buyer.po_poorderamount, loop_warehouse.warehouse_name, loop_warehouse.id as warehouse_id, loop_transaction_buyer.double_checked, loop_transaction_buyer.id AS I FROM loop_transaction_buyer INNER JOIN loop_warehouse ON loop_warehouse.id = loop_transaction_buyer.warehouse_id WHERE loop_transaction_buyer.ignore < 1 and " ;
                  
                  	$sql .= " loop_transaction_buyer.report_commissions_bydate >= '" . $date_from_val . "' and loop_transaction_buyer.report_commissions_bydate <= '" . $date_to_val . "' order by loop_warehouse.b2bid, loop_transaction_buyer.id"; 
                  
                  }
                  
                  
                  
                  $po_poorderamount_tot = 0; $gross_profit_tot = 0; $load_no = 1;
                  
                  $tmp_name = "";
                  db();	
                  $result = db_query($sql );
                  
                  while ($row = array_shift($result)) {
                  
                  	db_b2b();
                  
                  	$emp_name = "";
                  
                  	$result1 = db_query("Select employees.name from companyInfo inner join employees on companyInfo.assignedto = employees.employeeID where companyInfo.ID = " . $row["b2bid"]);
                  
                  	while ($row1 = array_shift($result1)) {
                  
                  		$emp_name = $row1["name"];
                  
                  	}
                  
                  	db();
                  
                  	$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                  
                  	$po_amount = $row["po_poorderamount"];
                  	
                  	$inv_amount = 0;
                  
                  	$sqlmtd = "SELECT loop_transaction_buyer.inv_number, loop_invoice_details.total as inv_amount, loop_transaction_buyer.id, loop_transaction_buyer.warehouse_id, loop_warehouse.b2bid FROM loop_transaction_buyer left join loop_invoice_details on loop_invoice_details.trans_rec_id = loop_transaction_buyer.id inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id WHERE loop_invoice_details.total > 0 and loop_transaction_buyer.id = " . $row["I"] . " and loop_transaction_buyer.ignore < 1";
					
					db();
                  	$result_finalpmt = db_query($sqlmtd);
                  
                  	while ($summtd_finalpmt = array_shift($result_finalpmt)) {
                  
                  		$inv_amount = $summtd_finalpmt["inv_amount"];
                  
                  	}
                  
                  	
                  
                  	$finalpaid_amt = 0;
					db();
                  	$result_finalpmt = db_query("Select ROUND(sum(loop_buyer_payments.amount),2) as amt from loop_buyer_payments where trans_rec_id = " . $row["I"] );
                  
                  	while ($summtd_finalpmt = array_shift($result_finalpmt)) {
                  
                  		$finalpaid_amt = $summtd_finalpmt["amt"];
                  
                  	}
                  
                  
                  
                  	$inv_amt_totake= 0;
                  
                  	
                  
                  	if ($finalpaid_amt > 0){
                  
                  		$inv_amt_totake= str_replace("," , "", $finalpaid_amt);
                  
                  	}
                  
                  	if ($finalpaid_amt == 0 && $row["invsent_amt"] > 0){
                  
                  		$inv_amt_totake= str_replace("," , "", $row["invsent_amt"]);
                  
                  	}
                  
                  	if ($finalpaid_amt == 0 && $row["invsent_amt"] == 0 && $inv_amount > 0){
                  
                  		$inv_amt_totake = str_replace("," , "", $inv_amount);
                  
                  	}
                  
                  	
                  
                  	$gross_profit = 0;
                  
                  	$vendor_pay = 0;
                  
                  	$dt_view_qry = "SELECT *, loop_transaction_buyer_payments.id AS A , loop_transaction_buyer_payments.status AS B, files_companies.name AS C from loop_transaction_buyer_payments left JOIN files_companies ON loop_transaction_buyer_payments.company_id = files_companies.id  INNER JOIN loop_vendor_type ON loop_transaction_buyer_payments.typeid = loop_vendor_type.id  WHERE loop_transaction_buyer_payments.transaction_buyer_id = " . $row["I"];
					db();
                  	$dt_view_res = db_query($dt_view_qry );
                  
                  	$num_rows = tep_db_num_rows($dt_view_res);
                  
                  	if ($num_rows > 0) {
                  
                  
                  
                  		while ($dt_view_row = array_shift($dt_view_res)) {
                  
                  			$vendor_pay += $dt_view_row["estimated_cost"]; 
                  
                  		}
                  
                  	}
                  
                  
                  
                  	$invoice_amt=0;
                  
                  	$inv_qry = "SELECT * FROM loop_invoice_items WHERE trans_rec_id = " . $row["I"] . " ORDER BY id ASC";
					db();
                  	$inv_res = db_query($inv_qry );
                  
                  	while ($inv_row = array_shift($inv_res)) {
                  
                  		$invoice_amt += $inv_row["quantity"]*$inv_row["price"];
                  
                  	}
                  
                  	if ($invoice_amt== 0) {
                  
                  		$invoice_amt=$inv_amount;
                  
                  	}
                  
                  	
                  
                  	$gross_profit = $invoice_amt - $vendor_pay;
                  
                  	
                  
                  	/*if ($tmp_name == $nickname){
                  
                  		$load_no = $load_no + 1;
                  
                  	}else{
                  
                  		$load_no = 1;
                  
                  	}*/
                  
                  	
                  
                  	$load_no = $row["load_number"];
                  
                  	
                  
                  	echo "<tr><td align='left'  bgColor='#E4EAEB'>" . $emp_name . "</td><td bgColor='#E4EAEB' align='left' ><a target='_blank' href='viewCompany.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Supplier&proc=View&searchcrit=&id=" . $row["warehouse_id"] . "&rec_id=" . $row["I"] . "&display=buyer_view'>" . $nickname . "</a></td><td bgColor='#E4EAEB'>" . $load_no . "</td>";
                  
                  	echo "<td align='right' bgColor='#E4EAEB'>$" . number_format($po_amount,2) . "</td>";
                  
                  	echo "<td align='right' bgColor='#E4EAEB'>$" . number_format($inv_amt_totake,2) . "</td>";
                  
                  	echo "<td align='right' bgColor='#E4EAEB'>$" . number_format($gross_profit,2) . "</td>";
                  
                  	
                  
                  	if ($row["double_checked"] == 1){
                  
                  		echo "<td align='center' bgColor='#E4EAEB'>Yes</td>";
                  
                  	}
                  
                  	if ($row["double_checked"] == 0){
                  
                  		echo "<td align='center' bgColor='#E4EAEB'><font color=red>No</font></td>";
                  
                  	}
                  
                  	echo "</tr>";
                  
                  	
                  
                  	$tmp_name = $nickname;
                  
                  	
                  
                  	$gross_profit_tot = $gross_profit_tot + $gross_profit;
                  
                  }
                  
                  echo "</tbody>";
                  
                  if ($gross_profit_tot > 0 )
                  
                  {
                  
                  	echo "<tr><td bgColor='#E4EAEB' colspan='4'>&nbsp;</td><td bgColor='#E4EAEB'><b>Total</b></td><td align='right' bgColor='#E4EAEB'><b>$" . number_format($gross_profit_tot,2) . "</b></td><td bgColor='#E4EAEB'>&nbsp;</td></tr>";
                  
                  }
                  
                  
                  
                  ?>
         </table>
         <?php 
            }
            
            ?>	
      </div>
   </body>
</html>
