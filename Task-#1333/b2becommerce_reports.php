<?php 
   require ("inc/header_session.php");
   require ("../mainfunctions/database.php");
   require ("../mainfunctions/general-functions.php");
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>B2B Online Orders Report</title>
      <style>
         .modal-content{
         margin-top: 80px;
         }
         .main_data_css{
         margin: 0 auto;
         width: 100%;
         height: auto;
         clear: both !important;
         padding-top: 35px;
         margin-left: 10px;
         margin-right: 10px;
         }
         .report_title{
         font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif!important; 
         font-size: 22px;
         margin-bottom:4px;
         margin-top:0px;
         }
         .display_maintitle {
         font-size: 11px;
         padding: 3px;
         font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
         background: #ABC5DF;
         }	
         .display_title {
         font-size: 11px;
         padding: 3px;
         font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
         background: #b7d3ef;
         white-space: nowrap;
         }
         .display_table {
         font-size: 11px;
         padding: 3px;
         font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
         /*background: #E4EAEB;*/
         }
         .search input {
         text-indent: 32px;
         }
         .search input {
         width: 400px;
         height: 28px;
         font-size: 13px;
         font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
         background: #fcfcfc;
         border: 1px solid #aaa;
         border-radius: 7px;
         box-shadow: 0 0 1px #ededed, 0 10px 15px #f8f8f8 inset;
         }
         .ser_form_component {
         font-size: 12px;
         margin-top: 2px;
         margin-bottom: 2px;
         font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
         border: 1px solid #aaa;
         border-radius: 2px;
         }
         .search_btn {
         line-height: normal !important;
         }
         .search_main_div {
         width: 100%;
         text-align: center;
         position: relative;
         }
         .search {
         display: inline;
         }
         .search {
         position: relative;
         color: #aaa;
         font-size: 14px;
         }
         .show_filter_txt {
         margin-left: 10px;
         height: 30px;
         line-height: 30px;
         display: inline;
         }
         .main_container
         {
         height: 34px !important;
         }
         .link_txt a {
         font-size: 14px !important;
         }
      </style>
      <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
      <link rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>
      <link rel='stylesheet' type='text/css' href='css/bootstrap.min.css' >
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <script language="JavaScript" SRC="inc/CalendarPopup.js"></script><script language="JavaScript" src="inc/general.js"></script>
      <script language="JavaScript">document.write(getCalendarStyles());</script>
      <script language="JavaScript">
         var cal2xx = new CalendarPopup("listdiv");
         
         cal2xx.showNavigationDropdowns();
         
         var cal3xx = new CalendarPopup("listdiv");
         
         cal3xx.showNavigationDropdowns();
         
      </script>
      <script type="text/javascript">
         $(document).ready(function(){
         
         	/*report pg js start*/
         
         	$('#myModalOne').on('show.bs.modal', function (e) {
         
         		var rowid = $(e.relatedTarget).data('id');
         
         		$.ajax({
         
         			type : 'post',
         
         			url : 'b2becommerce_fetch_record.php', //Here you will fetch records 
         
         			data : { rowid: rowid, usefor: 'one' },
         
         			success : function(data){
         
         			$('.fetched-data').html(data);//Show fetched data from database
         
         			}
         
         		});
         
         	});
         
         	$('#myModalNewComp').on('show.bs.modal', function (e) {
         
         		var trackId = $(e.relatedTarget).data('id');
         
         		$(e.currentTarget).find('input[name="trackId"]').val(trackId);
         
         
         
         		$('#btnNewCompYes').click(function(){
         
         			var trackId = $('#trackId').val();
         
         			$.ajax({
         
         				type : 'POST',
         
         				cache: 'false',
         
         				url  : 'b2becommerce_fetch_record.php',
         
         				data : {rowid : trackId, usefor : 'createNewComp'},
         
         				success : function(response){
    
         					$('.fetched-data_newComp').html(response);
         
         				}
         
         			});
         
         		});
         
         	});
         
         
         
         	$('#myModalExistingComp').on('show.bs.modal', function (e) {
         
         		var trackId = $(e.relatedTarget).data('id');
         
         		$(e.currentTarget).find('input[name="trackId_1"]').val(trackId);
         
         
         
         		$('#btnMatchExistingComp').click(function(){
         
         			var trackId 	= $('#trackId_1').val();
         
         			var companyId 	= $('#companyId').val(); 
         
         			$.ajax({
         
         				type : 'POST',
         
         				cache: 'false',
         
         				url  : 'b2becommerce_fetch_record.php',
         
         				data : {rowid : trackId, usefor : 'matchExistingComp', companyId : companyId},
         
         				success : function(response){
         
         					$('.fetched-data_matchedExistingComp').html(response);
         
         				}
         
         			});
         
         		});
         
         	});
         
         
         
         	$('#myModalExistingComp').on('hidden.bs.modal', function () {
         
         	  	window.location.reload(true);
         
         	});
         
         	$('#myModalNewComp').on('hidden.bs.modal', function () {
         
         	  	window.location.reload(true);
         
         	});			
         
         
         
         	/*report pg js ends*/
         
         });
         
      </script>	
   <body>
      <?php include("inc/header.php"); ?>
      <div class="main_data_css">
         <div class="dashboard_heading" style="float: left;">
            <div style="float: left;">B2B Online Orders Report</div>
            &nbsp;
            <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
               <span class="tooltiptext">This report shows the user all orders which were placed online. This could be from accepting a sales quote, or buying inventory directly from an inventory detail page and clicking "Order Now."</span>
            </div>
            <div style="height: 13px;">&nbsp;</div>
         </div>

         <form name="frmB2bReports" id="frmB2bReports"  action="#">
            <table border="0" cellspacing="1" cellpadding="1">
               <tr align="center">
                  <td valign="top">
                     <input type="text" name="startDate" id="startDate" size="10" value="<?php if(isset($_REQUEST['startDate'])) {echo $_REQUEST['startDate']; }?>"/>
                     <a href="#" onclick="cal2xx.select(document.frmB2bReports.startDate,'anchor2xx','MM/dd/yyyy'); return false;" name="anchor2xx" id="anchor2xx">
                     <img border="0" src="images/calendar.jpg"></a>&nbsp;
                  </td>
                  <td valign="top">
                     <input type="text" name="endDate" id="endDate" size="10" value="<?php if(isset($_REQUEST['endDate'])) {echo $_REQUEST['endDate']; } ?>"/>
                     <a href="#" onclick="cal3xx.select(document.frmB2bReports.endDate,'anchor3xx','MM/dd/yyyy'); return false;" name="anchor3xx" id="anchor3xx">
                     <img border="0" src="images/calendar.jpg"></a>&nbsp;
                  </td>
                  <td>
                     <select name="repfilter[]" id="repfilter" multiple>
                        <option value="InComplete" <?php if(isset($_REQUEST["repfilter"])){ if (in_array("InComplete", $_REQUEST["repfilter"])) { echo " selected ";} }?>>Incomplete Orders</option>
                        <option value="Complete" <?php if(isset($_REQUEST["repfilter"])){ if (in_array("Complete", $_REQUEST["repfilter"])) { echo " selected ";} }?>>Complete Orders (Linked)</option>
                        <option value="Complete_notlinked" <?php if(isset($_REQUEST["repfilter"])){ if (in_array("Complete_notlinked", $_REQUEST["repfilter"])) { echo " selected ";} }?>>Complete Orders (Not Yet Linked)</option>
                     </select>
                  </td>
                  <td>&nbsp;</td>
                  <td valign="top">
                     <select name="orderFilter" id="orderFilter" >
                        <option value="-">Select</option>
                        <option value="1" <?php if ($_REQUEST["orderFilter"] == "1") { echo " selected ";}?>>BUY DIRECT Orders</option>
                        <option value="2" <?php if ($_REQUEST["orderFilter"] == "2") { echo " selected ";}?>>QUOTE Orders</option>
                     </select>
                  </td>
                  <td valign="top">
                     &nbsp;<input type="submit" id="btnrep" value="Run Report"/>
                  </td>
               </tr>
            </table>
            <div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>
         </form>
         <div id="div_general_forrep" name="div_general_forrep" >
            <table width="95%" border="1" cellspacing="2" cellpadding="2" style="border-color:white;">
               <tr class="display_maintitle" >
                  <!-- <td width="50px">Sr. No.</td> -->
                  <td width="50px" align="center">ID (View Order Data)</td>
                  <td width="150px">Orders From</td>
                  <td width="150px">Order/Tracking Date</td>
                  <td width="100px">IP Address</td>
                  <td width="150px" align="center">Contact Info</td>
                  <td width="150px" align="center">Quote ID</td>
                  <td width="290px" align="center">Box Description</td>
                  <td width="50px" align="center">Lead Time</td>
                  <td width="50px" align="center">Box Qty</td>
                  <td width="50px" align="center">Payment</td>
                  <td width="50px" align="center">Payment Amount</td>
                  <td width="50px" align="center">Shipping Type</td>
                  <!-- 
                     <td width="20px" align="center">Step 1</td>
                     
                     <td width="20px" align="center">Step 2</td>
                     
                     <td width="20px" align="center">Step 3</td>
                     
                     <td width="20px" align="center">Step 4</td>
                     
                     -->
                  <td width="40px" align="center">Action</td>
               </tr>
               <?php
                  
					if(isset($_REQUEST['startDate']) && isset($_REQUEST['endDate'])){
                  
						$startDate = date('Y-m-d', strtotime($_REQUEST['startDate']));
                  
                  		$endDate   = date('Y-m-d', strtotime($_REQUEST['endDate']));
                  
                  	}
                  
                 	 $srno = 1;
                  
                  	if (isset($_REQUEST["order_id"])){  
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE b2becommerce_order_item.id = '" . $_REQUEST["order_id"] . "'");	
                  
                  	}elseif($_REQUEST["repfilter"][0] == "InComplete" && $_REQUEST["repfilter"][1] == "Complete" && $_REQUEST["repfilter"][2] == "Complete_notlinked"){ //in-complete & complete(linked&not-linked)
                  
                  	if($_REQUEST['startDate'] != "" && $_REQUEST['endDate'] != "" && $_REQUEST['orderFilter'] == "-"){   
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE (response_trans_id <> '' AND order_date BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59' ) OR (response_trans_id = '' AND order_date BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59' ) ORDER BY order_date DESC");
                  
                  	}elseif($_REQUEST['startDate'] != "" && $_REQUEST['endDate'] != "" && $_REQUEST['orderFilter'] == "1"){   
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE (response_trans_id <> '' AND quote_id = 0 AND order_date BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59' AND response_amount > 0) OR (response_trans_id = '' AND quote_id = 0 AND order_date BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59' ) ORDER BY order_date DESC");
                  
                  	}elseif($_REQUEST['startDate'] != "" && $_REQUEST['endDate'] != "" && $_REQUEST['orderFilter'] == "2"){   
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE (response_trans_id <> '' AND quote_id > 0 AND order_date BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59' AND response_amount > 0) OR (response_trans_id = '' AND quote_id > 0 AND order_date BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59') ORDER BY order_date DESC");
                  
                  	}elseif($_REQUEST['startDate'] == "" && $_REQUEST['endDate'] == "" && $_REQUEST['orderFilter'] == "2"){   
                  		db();	
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE (response_trans_id <> '' AND quote_id > 0 AND response_amount > 0 ) OR (response_trans_id <> '' AND quote_id > 0) ORDER BY order_date DESC");
                  
                  	}elseif($_REQUEST['startDate'] == "" && $_REQUEST['endDate'] == "" && $_REQUEST['orderFilter'] == "1"){   
                  		db();	
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE (response_trans_id <> '' AND quote_id = 0 AND response_amount > 0) OR (response_trans_id <> '' AND quote_id = 0) ORDER BY order_date DESC");
                  
                  	}else{								
                  		db();	
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE (response_trans_id <> '' ) OR (response_trans_id = '') ORDER BY order_date DESC");
                  
                  	}
                  
                  }elseif($_REQUEST["repfilter"][0] == "Complete" && $_REQUEST["repfilter"][1] == "Complete_notlinked"){//All complete (both linked & not-linked)
                  
                  	if($_REQUEST['startDate'] != "" && $_REQUEST['endDate'] != "" && $_REQUEST['orderFilter'] == "-"){   
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE response_trans_id <> '' AND order_date BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59' AND response_amount > 0 ORDER BY order_date DESC");
                  
                  	}elseif($_REQUEST['startDate'] != "" && $_REQUEST['endDate'] != "" && $_REQUEST['orderFilter'] == "1"){   
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE response_trans_id <> '' AND quote_id = 0 AND order_date BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59' AND response_amount > 0 ORDER BY order_date DESC");
                  
                  	}elseif($_REQUEST['startDate'] != "" && $_REQUEST['endDate'] != "" && $_REQUEST['orderFilter'] == "2"){   
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE response_trans_id <> '' AND quote_id > 0 AND order_date BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59' AND response_amount > 0 ORDER BY order_date DESC");
                  
                  	}elseif($_REQUEST['startDate'] == "" && $_REQUEST['endDate'] == "" && $_REQUEST['orderFilter'] == "2"){   
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE response_trans_id <> '' AND quote_id > 0 AND response_amount > 0  ORDER BY order_date DESC");
                  
                  	}elseif($_REQUEST['startDate'] == "" && $_REQUEST['endDate'] == "" && $_REQUEST['orderFilter'] == "1"){  
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE response_trans_id <> '' AND quote_id = 0 AND response_amount > 0 ORDER BY order_date DESC");
                  
                  	}else{								
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE response_trans_id <> '' AND response_amount > 0 ORDER BY order_date DESC");
                  
                  	}
                  
                  }elseif($_REQUEST["repfilter"][1] == "Complete" && $_REQUEST["repfilter"][0] == "InComplete"){ //linked complete & in-complete
                  
                  	if($_REQUEST['startDate'] != "" && $_REQUEST['endDate'] != "" && $_REQUEST['orderFilter'] == "-"){   
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE (response_trans_id <> '' AND is_company_set = 1 AND order_date BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59') OR (response_trans_id = '' AND order_date BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59') ORDER BY order_date DESC");
                  
                  	}elseif($_REQUEST['startDate'] != "" && $_REQUEST['endDate'] != "" && $_REQUEST['orderFilter'] == "1"){   
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE (response_trans_id <> '' AND is_company_set = 1 AND  quote_id = 0 AND order_date BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59') OR (response_trans_id = ''  AND quote_id = 0 AND order_date BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59') ORDER BY order_date DESC");
                  
                  	}elseif($_REQUEST['startDate'] != "" && $_REQUEST['endDate'] != "" && $_REQUEST['orderFilter'] == "2"){   
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE (response_trans_id <> '' AND is_company_set = 1 AND quote_id > 0 AND order_date BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59') OR (response_trans_id = '' AND quote_id > 0 AND order_date BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59' ) ORDER BY order_date DESC");
                  
                  	}elseif($_REQUEST['startDate'] == "" && $_REQUEST['endDate'] == "" && $_REQUEST['orderFilter'] == "2"){   
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE (response_trans_id <> '' AND is_company_set = 1 AND quote_id > 0) OR (response_trans_id = '' AND quote_id > 0 ) ORDER BY order_date DESC");
                  
                  	}elseif($_REQUEST['startDate'] == "" && $_REQUEST['endDate'] == "" && $_REQUEST['orderFilter'] == "1"){  
                  		db();
                  
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE (response_trans_id <> '' AND is_company_set = 1 AND quote_id = 0 ) OR (response_trans_id = '' AND quote_id = 0 ) ORDER BY order_date DESC");
                  
                  	}else{								
                  		db();
                  
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE (response_trans_id <> '' AND is_company_set = 1) OR (response_trans_id = '') ORDER BY order_date DESC");
                  	}
                  
                  }elseif($_REQUEST["repfilter"][1] == "Complete_notlinked" && $_REQUEST["repfilter"][0] == "InComplete"){ //not-linked complete & in-complete
                  
                  	if($_REQUEST['startDate'] != "" && $_REQUEST['endDate'] != "" && $_REQUEST['orderFilter'] == "-"){   
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE (response_trans_id <> '' AND is_company_set = 0 AND order_date BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59') OR (response_trans_id = '' AND order_date BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59') ORDER BY order_date DESC");
                  
                  	}elseif($_REQUEST['startDate'] != "" && $_REQUEST['endDate'] != "" && $_REQUEST['orderFilter'] == "1"){   
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE (response_trans_id <> '' AND is_company_set = 0 AND  quote_id = 0 AND order_date BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59') OR (response_trans_id = ''  AND quote_id = 0 AND order_date BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59') ORDER BY order_date DESC");
                  
                  	}elseif($_REQUEST['startDate'] != "" && $_REQUEST['endDate'] != "" && $_REQUEST['orderFilter'] == "2"){  
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE (response_trans_id <> '' AND is_company_set = 0 AND quote_id > 0 AND order_date BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59') OR (response_trans_id = '' AND quote_id > 0 AND order_date BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59' ) ORDER BY order_date DESC");
                  
                  	}elseif($_REQUEST['startDate'] == "" && $_REQUEST['endDate'] == "" && $_REQUEST['orderFilter'] == "2"){  
                  
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE (response_trans_id <> '' AND is_company_set = 0 AND quote_id > 0) OR (response_trans_id = '' AND quote_id > 0 ) ORDER BY order_date DESC");
                  
                  	}elseif($_REQUEST['startDate'] == "" && $_REQUEST['endDate'] == "" && $_REQUEST['orderFilter'] == "1"){  
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE (response_trans_id <> '' AND is_company_set = 0 AND quote_id = 0 ) OR (response_trans_id = '' AND quote_id = 0 ) ORDER BY order_date DESC");
                  
                  	}else{								
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE (response_trans_id <> '' AND is_company_set = 0) OR (response_trans_id = '') ORDER BY order_date DESC");
                  
                  	}
                  
                  }elseif($_REQUEST["repfilter"][0] == "Complete"){ //linked complete only 
                  
                  	if($_REQUEST['startDate'] != "" && $_REQUEST['endDate'] != "" && $_REQUEST['orderFilter'] == "-"){ 
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE response_trans_id <> '' AND order_date BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59' AND is_company_set = 1 ORDER BY order_date DESC");
                  
                  	}elseif($_REQUEST['startDate'] != "" && $_REQUEST['endDate'] != "" && $_REQUEST['orderFilter'] == "1"){  
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE response_trans_id <> '' AND quote_id = 0 AND order_date BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59' AND is_company_set = 1 ORDER BY order_date DESC");
                  
                  	}elseif($_REQUEST['startDate'] != "" && $_REQUEST['endDate'] != "" && $_REQUEST['orderFilter'] == "2"){   
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE response_trans_id <> '' AND quote_id > 0 AND order_date BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59' AND is_company_set = 1 ORDER BY order_date DESC");
                  
                  	}elseif($_REQUEST['startDate'] == "" && $_REQUEST['endDate'] == "" && $_REQUEST['orderFilter'] == "2"){  
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE response_trans_id <> '' AND quote_id > 0 AND is_company_set = 1 ORDER BY order_date DESC");
                  
                  	}elseif($_REQUEST['startDate'] == "" && $_REQUEST['endDate'] == "" && $_REQUEST['orderFilter'] == "1"){   
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE response_trans_id <> '' AND quote_id = 0 AND is_company_set = 1 ORDER BY order_date DESC");
                  
                  	}else{								
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE response_trans_id <> '' AND is_company_set = 1 ORDER BY order_date DESC");
                  
                  	}
                  
                  }elseif($_REQUEST["repfilter"][0] == "InComplete"){ //ALL in-complete
                  
                  	if($_REQUEST['startDate'] != "" && $_REQUEST['endDate'] != "" && $_REQUEST['orderFilter'] == "-"){   
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE response_trans_id = '' AND order_date BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59' ORDER BY order_date DESC");
                  
                  	}elseif($_REQUEST['startDate'] != "" && $_REQUEST['endDate'] != "" && $_REQUEST['orderFilter'] == "1"){ 
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE response_trans_id = '' AND quote_id = 0 AND order_date BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59' ORDER BY order_date DESC");
                  
                  	}elseif($_REQUEST['startDate'] != "" && $_REQUEST['endDate'] != "" && $_REQUEST['orderFilter'] == "2"){   
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE response_trans_id = '' AND quote_id > 0 AND order_date BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59' ORDER BY order_date DESC");
                  
                  	}elseif($_REQUEST['startDate'] == "" && $_REQUEST['endDate'] == "" && $_REQUEST['orderFilter'] == "1"){  
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE response_trans_id = '' AND quote_id = 0 ORDER BY order_date DESC");
                  
                  	}elseif($_REQUEST['startDate'] == "" && $_REQUEST['endDate'] == "" && $_REQUEST['orderFilter'] == "2"){
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE response_trans_id = '' AND quote_id > 0 ORDER BY order_date DESC");
                  
                  	}else{ 
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE response_trans_id = '' ORDER BY order_date DESC");
                  
                  	}	
                  
                  }else{ //not linked complete only
                  
                  	if($_REQUEST['startDate'] != "" && $_REQUEST['endDate'] != "" && $_REQUEST['orderFilter'] == "-"){   
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE response_trans_id <> '' AND order_date BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59' AND is_company_set = 0 AND response_amount > 0 ORDER BY order_date DESC");
                  
                  	}elseif($_REQUEST['startDate'] != "" && $_REQUEST['endDate'] != "" && $_REQUEST['orderFilter'] == "1"){  
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE response_trans_id <> '' AND quote_id = 0 AND order_date BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59' AND is_company_set = 0 AND response_amount > 0 ORDER BY order_date DESC");
                  
                  	}elseif($_REQUEST['startDate'] != "" && $_REQUEST['endDate'] != "" && $_REQUEST['orderFilter'] == "2"){   
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE response_trans_id <> '' AND quote_id > 0 AND order_date BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59' AND is_company_set = 0 AND response_amount > 0 ORDER BY order_date DESC");
                  
                  	}elseif($_REQUEST['startDate'] == "" && $_REQUEST['endDate'] == "" && $_REQUEST['orderFilter'] == "2"){  
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE response_trans_id <> '' AND quote_id > 0 AND is_company_set = 0 AND response_amount > 0 ORDER BY order_date DESC");
                  
                  	}elseif($_REQUEST['startDate'] == "" && $_REQUEST['endDate'] == "" && $_REQUEST['orderFilter'] == "1"){  
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE response_trans_id <> '' AND quote_id = 0 AND is_company_set = 0 AND response_amount > 0 ORDER BY order_date DESC");
                  
                  	}else{								
                  		db();
                  		$getReportDt = db_query("SELECT * FROM b2becommerce_order_item WHERE response_trans_id <> '' AND is_company_set = 0 AND response_amount > 0 ORDER BY order_date DESC");
                  
                  	}
                  
                  }
                  
                  while($rowReportDt = array_shift($getReportDt)){
                  	db();
                  	$getData = db_query("SELECT * FROM b2becommerce_order_item WHERE session_id = '" . $rowReportDt['session_id'] . "' AND product_loopboxid = '" . $rowReportDt['product_loopboxid'] . "'");	
                  
                  	$rowData_track = array_shift($getData);
                  
                  	$machine_ip	   = $rowData_track['machine_ip'];
                  
                  	if($machine_ip == ""){
                  		db();
                  		$getData = db_query("SELECT * FROM b2becommerce_tracking WHERE session_id = '" . $rowReportDt['session_id'] . "'");	
                  
                  		$rowData_track = array_shift($getData);
                  
                  		$machine_ip	   = $rowData_track['machine_ip'];
                  
                  	}
                  
                  	db();
                  	$getBoxDesc = db_query("SELECT * FROM loop_boxes WHERE id =" . $rowReportDt['product_loopboxid']);	
                  
                  	$rowBoxDesc = array_shift($getBoxDesc);
                  
                  	db_b2b();
                  	
                  	$qryb2b = "SELECT * FROM inventory WHERE id = '" . $rowBoxDesc["b2b_id"] . "'";		
                  	
                  	$resb2b = db_query($qryb2b);		
                  
                  	$rowb2b = array_shift($resb2b);
                  
                  	$box_type = $rowb2b["box_type"];
                  
                  	$boxid_text		= "Item";
                  
                  	if (in_array(strtolower($box_type), array_map('strtolower', array("Gaylord", "GaylordUCB", "Loop", "PresoldGaylord" )))){ 
                  
                  		$boxid_text		= "Gaylord";
                  
                  	}elseif (in_array(strtolower($box_type), array_map('strtolower', array("Medium", "Large", "Xlarge", "LoopShipping", "Box", "Boxnonucb", "Presold" )))){ 
                  
                  		$boxid_text		= "Shipping Box";
                  
                  	}elseif (in_array(strtolower($box_type), array_map('strtolower', array("SupersackUCB", "SupersacknonUCB" )))){ 
                  
                  		$boxid_text		= "Super Sack";
                  
                  	}elseif (in_array(strtolower($box_type), array_map('strtolower', array("PalletsUCB", "PalletsnonUCB")))){ 
                  
                  		$boxid_text		= "Pallet";
                  
                  	}elseif (in_array(strtolower($box_type), array_map('strtolower', array("Recycling", "DrumBarrelUCB", "DrumBarrelnonUCB", "Waste-to-Energy", "Other")))) { 
                  
                  		$boxid_text		= "Item";
                  
                  	}
                  
                  	if ($rowReportDt['quote_id'] > 0){
                  		db();
                  		$getData = db_query("SELECT * FROM b2becommerce_order_item WHERE session_id = '" . $rowReportDt['session_id'] . "' AND quote_id = '" . $rowReportDt['quote_id'] . "'");	
                  
                  	}	
                  
                  	if ($rowReportDt['product_loopboxid'] > 0){
                  		db();
                  		$getData = db_query("SELECT * FROM b2becommerce_order_item WHERE session_id = '" . $rowReportDt['session_id'] . "' AND product_loopboxid = '" . $rowReportDt['product_loopboxid'] . "'");	
                  
                  	}	
                  
                  	$rowData = array_shift($getData);
                  
                  	if($srno%2 == 1){
                  
                  		$bgclass = "#F7F7F7";
                  
                  	}else{
                  
                  		$bgclass = "#EBEBEB";
                  	}
                  
                  ?>
               <tr bgcolor="<?php echo $bgclass;?>">
                  <td align="center">
                     <a href="#myModalOne" data-toggle="modal" data-id="<?php echo $rowData['id'];?>"><?php echo $rowData['id']; ?></a>
                  </td>
                  <td class="display_table" >
                     <?php
                        if($rowData['quote_id'] == "0"){
                        
                        	$orderFrom = 'BUY DIRECT';
                        
                        }else{
                        
                        	$orderFrom = 'QUOTE';
                        
                        }
                        
                        echo $orderFrom;
                        
                        ?>
                  </td>
                  <td class="display_table" >
                     <?php
                        if($rowData['order_date'] != ""){
                        
                        	echo date('m/d/Y H:i:s',strtotime($rowData['order_date']));
                        
                        }else{
                        
                        	echo date('m/d/Y H:i:s',strtotime($rowReportDt['record_date']));
                        
                        }
                        
                        ?>
                  </td>
                  <td class="display_table" ><a href="https://tools.keycdn.com/geo?host=<?php echo $machine_ip ?>" target="_blank"><?php echo $machine_ip; ?></a></td>
                  <td class="display_table" > 
                     <?php
                        if((!empty($rowData["contact_firstname"])) || (!empty($rowData["contact_lastname"]))){ 
                        
                        	echo $rowData["contact_firstname"]."&nbsp;".$rowData["contact_lastname"];
                        
                        }
                        
                        if((!empty($rowData["contact_firstname"])) || (!empty($rowData["contact_lastname"]))){ 
                        
                        	echo "<br>". $rowData["contact_company"];
                        
                        }
                        
                        if(!empty($rowData["shipping_city"])){ 
                        
                        	echo "<br>" . $rowData["shipping_city"];
                        
                        }
                        
                        if(!empty($rowData["shipping_state"])){ 
                        
                        	echo ", " . strtoupper($rowData["shipping_state"]);
                        
                        }
                        
                        $compid = 0;
                        
                        if($rowReportDt['quote_id'] > 0) { 
                        	db_b2b();
                        	$getDt = db_query("SELECT companyID FROM quote WHERE ID = " . $rowReportDt['quote_id']);
                        
                        	while($rowDt = array_shift($getDt)){
                        
                        		$compid = $rowDt["companyID"];
                        
                        	}
                        
                        }	
                        
                        $quote_id = $rowReportDt['quote_id']+3770;			
                        
                        ?>
                  </td>
                  <td class="display_table" ><?php if($rowReportDt['quote_id'] > 0){ echo "<a target='_blank' href='viewCompany.php?ID=" . $compid . "'>" . $quote_id . "</a>"; }?></td>
                  <td class="display_table" >
                     <?php
                        if($rowReportDt['quote_id'] > 0) { 
                        	db();
                        	$getOrderedProd = db_query("SELECT product_id, product_name FROM b2becommerce_order_item_details WHERE order_item_id = '".$rowReportDt['id']."'");
                        
                        	while ( $rowOrderedProd = array_shift($getOrderedProd)) {
                        
                        		if ($rowOrderedProd['product_id'] >5){
                        			db();
                        			$res_loopbox = db_query("SELECT * FROM loop_boxes WHERE id = '" . $rowOrderedProd['product_id'] . "'");	
                        
                        			$row_loopbox 	= array_shift($res_loopbox);
                        
                        			$id2 = $row_loopbox["b2b_id"];	
                        
                        			db_b2b();
                        			$resb2b = db_query("SELECT * FROM inventory WHERE id = '" . $id2 . "'");	
                        
                        			$rowb2b = array_shift($resb2b);
                        
                        			$box_type   = $rowb2b["box_type"];
                        
                        			$boxid_text = get_b2bEcomm_boxType_BasicDetails($box_type, 8);
                        
                        		
                        
                        		?> 
                     <a href="https://loops.usedcardboardboxes.com/manage_box_b2bloop.php?id=<?php echo $rowOrderedProd['product_id']; ?>&proc=View" target="_blank">
                     <?php echo "ID: ". $rowOrderedProd['product_id'] .", ". $boxid_text .",". $row_loopbox["system_description"]; ?>
                     </a>
                     <div class="sidebar-sept"></div>
                     <?php
                        }else{
                        
                        ?> 
                     <?php echo $rowOrderedProd['product_name']; ?>
                     <div class="sidebar-sept"></div>
                     <?php
                        }
                        
                        } 
                        
                        }else{ 
                        
                        ?> 
                     <a href="https://loops.usedcardboardboxes.com/manage_box_b2bloop.php?id=<?php echo $rowData['product_loopboxid']; ?>&proc=View" target="_blank">
                     <?php echo "ID: ". $rowBoxDesc["b2b_id"] .", ". $boxid_text .",". $rowBoxDesc["system_description"]; ?>
                     </a>
                     <?php } ?>
                  </td>
                  <td class="display_table" valign="top" >
                     <?php
                        db();
                        if($rowReportDt['quote_id'] > 0) { 
                        
                        	$resQty = db_query("SELECT product_availability FROM  b2becommerce_order_item_details WHERE order_item_id = ".$rowReportDt['id']." ORDER BY id ASC");
                        
                        	while ($rowsQty = array_shift($resQty)) {							
                        
                        		echo $rowsQty['product_availability'];
                        
                        		?>
                     <div class="sidebar-sept"></div>
                     <?php
                        }
                        
                        }else{
                        
                        echo $rowBoxDesc['lead_time'];
                        
                        }
                        
                        ?>	
                  	</td>
                  	<td class="display_table" valign="top" >
						<?php
                        	if($rowReportDt['quote_id'] > 0) { 
                        
                        		$resQty = db_query("SELECT product_qty FROM  b2becommerce_order_item_details WHERE order_item_id = ".$rowReportDt['id']." ORDER BY id ASC");
                        
                        		while ($rowsQty = array_shift($resQty)) {							
                        
                        			echo number_format($rowsQty['product_qty']);
                        
						?>
                     				<div class="sidebar-sept"></div>
                     	<?php
                        		}
                        
                        	}else{
                        
                        		echo $rowData['product_name']."<br>".number_format($rowData['product_qty']);;
                        
                        	}
                        ?>						
                  	</td>
                  	<td class="display_table" >
					<?php
                        if($rowData['response_trans_id'] == 'credit_term'){
                        
                        	echo 'Credit term';
                        }
                        
                        if($rowData['response_trans_id'] == 'credit_card'){
                        
                        	echo 'Credit card';
                        }
                        
					?>						
                  	</td>
                  	<?php if ($rowData['response_amount'] != ""){ ?>
						<td class="display_table" >$<?php echo number_format(str_replace(",", "", $rowData['response_amount']),2); ?>
							<?php if($rowData['response_trans_id'] == 'credit_card'){ ?>
							<span style="font-size:8px;">Convenience Fee (3%) included</span>
							<?php } ?>
						</td>
                  	<?php }else{ ?>
                  		<td class="display_table" ></td>
                  	<?php } ?>
                 	 	<td class="display_table" ><?php echo $rowData['pickup_type']; ?></td>
                  	<?php
						if(!empty($rowReportDt['response_trans_id']) && !empty($rowReportDt['response_amount']) ){
                    
							$warehouse_id = 0;
							db();
                     		
							$getDt = db_query("SELECT warehouse_id FROM loop_transaction_buyer WHERE id = '" . $rowReportDt['transaction_id']  . "'");
                     
							while($rowDt = array_shift($getDt)){
                     
								$warehouse_id = $rowDt["warehouse_id"];
							}
					?>
                  	<td class="display_table" >
                     	<table border="0" cellspacing="2" cellpadding="2" bgcolor="#E4E4E4">
							<tr>
								<?php if($rowReportDt['quote_id'] == 0) { ?>
									<?php if($rowReportDt['is_company_set'] == 0) { ?>
										<td class="display_table" width="40px" align="left" >
											<a href="#myModalNewComp" data-toggle="modal" data-id="<?php echo $rowReportDt['id']; ?>">Create new company</a>
										</td>
										<td class="display_table" width="40px" align="left" >
											<a href="#myModalExistingComp" data-toggle="modal" data-id="<?php echo $rowReportDt['id']; ?>">Matching existing company</a>
										</td>
									<?php }else { ?> 
										<td class="display_table" width="40px" align="left" >
											<a href="viewCompany.php?ID=<?php echo $rowReportDt['company_id']; ?>&proc=View&searchcrit=&show=transactions&rec_type=Supplier" target="_blank">Company Link : <?php echo $rowReportDt['company_id'];?></a>
										</td>
										<td class="display_table" width="40px" align="left" >
											<!-- Tracking Id is : <?php echo $trackingTransId; ?> -->
											<a href="viewCompany.php?ID=<?php echo $rowReportDt['company_id'];?>&show=transactions&warehouse_id=<?php echo $warehouse_id;?>&rec_type=Supplier&proc=View&searchcrit=&id=<?php echo $warehouse_id;?>&rec_id=<?php echo $rowReportDt['transaction_id'];?>&display=buyer_view" target="_blank"> Tracking Id is : <?php echo$rowReportDt['transaction_id']; ?></a>
										</td>
									<?php } ?>
								<?php }else{  ?> 
									<?php if($rowReportDt['is_company_set'] == 0) { ?>
										<td class="display_table" width="40px" align="left" >
											<a href="#myModalNewComp" data-toggle="modal" data-id="<?php echo $rowReportDt['id']; ?>">Create new company</a>
										</td>
										<td class="display_table" width="40px" align="left" >
											<a href="#myModalExistingComp" data-toggle="modal" data-id="<?php echo $rowReportDt['id']; ?>">Matching existing company</a>
										</td>
									<?php }else { ?> 
										<td class="display_table" width="40px" align="left" >
											<a href="viewCompany.php?ID=<?php echo $rowReportDt['company_id']; ?>&proc=View&searchcrit=&show=transactions&rec_type=Supplier" target="_blank">Company Link : <?php echo $rowReportDt['company_id'];?></a>
										</td>
										<td class="display_table" width="40px" align="left" >
											<!-- Tracking Id is : <?php echo $trackingTransId; ?> -->
											<a href="viewCompany.php?ID=<?php echo $rowReportDt['company_id'];?>&show=transactions&warehouse_id=<?php echo $warehouse_id;?>&rec_type=Supplier&proc=View&searchcrit=&id=<?php echo $warehouse_id;?>&rec_id=<?php echo $rowReportDt['transaction_id'];?>&display=buyer_view" target="_blank"> Tracking Id is : <?php echo $rowReportDt['transaction_id']; ?></a>
										</td>
									<?php } ?>
								<?php } ?>
							</tr>
                     	</table>
                  	</td>
                  	<?php
						}else{
                     ?>
                  	<td class="display_table" >
						<table border="0" cellspacing="2" cellpadding="2" bgcolor="#E4E4E4">
                        <tr>
                           <td class="display_table" colspan="2" align="left" style="color: red;" >Incomplete Orders</td>
                        </tr>
                     </table>
                  	</td>
                  	<?php
                     	}
					?>
				</tr>
				<?php
                  $srno++;
                  
                  } 
				?>	
            </table>
            <!-- Modal step 1 -->
            <div class="modal fade" id="myModalOne" role="dialog">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Steps details</h4>
                     </div>
                     <div class="modal-body">
                        <div class="fetched-data"></div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Modal step 2 -->
            <div class="modal fade" id="myModalTwo" role="dialog">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Step 2 details</h4>
                     </div>
                     <div class="modal-body">
                        <div class="fetched-data_two"></div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Modal step 3 -->
            <div class="modal fade" id="myModalThree" role="dialog">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Step 3 details</h4>
                     </div>
                     <div class="modal-body">
                        <div class="fetched-data_three"></div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Modal step 4 -->
            <div class="modal fade" id="myModalFour" role="dialog">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Step 4 details</h4>
                     </div>
                     <div class="modal-body">
                        <div class="fetched-data_four"></div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
            </div>
            <!-- new company -->
            <div class="modal fade" id="myModalNewComp" role="dialog">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Create new company confirmation</h4>
                     </div>
                     <div class="modal-body">
                        <div class="fetched-data_newComp"></div>
                        <table>
                           <tr>
                              <td colspan="2">Click on the "Create company" button to add new transaction?</td>
                           </tr>
                           <tr>
                              <td>
                                 <input type="hidden" value="" id="trackId" name="trackId">
                                 <input type="button" class="btn btn-default" name="btnNewCompYes" id="btnNewCompYes" value="Create company">
                              </td>
                           </tr>
                        </table>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
            </div>
            <!-- matching existing company -->
            <div class="modal fade" id="myModalExistingComp" role="dialog">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Matching existing company</h4>
                     </div>
                     <div class="modal-body">
                        <div class="fetched-data_matchedExistingComp"></div>
                        <table>
                           <tr>
                              <td>
                                 Enter B2B Company ID: <input type="text" value="" id="companyId" name="companyId">
                              </td>
                           </tr>
                           <tr>
                              <td>
                                 <input type="hidden" value="" id="trackId_1" name="trackId_1">
                                 <input type="button" class="btn btn-default" name="btnMatchExistingComp" id="btnMatchExistingComp" value="Submit">
                              </td>
                           </tr>
                        </table>
                     </div>
                     <div class="modal-footer">
                        <button type="button" id="modalClose" class="btn btn-default" data-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>
