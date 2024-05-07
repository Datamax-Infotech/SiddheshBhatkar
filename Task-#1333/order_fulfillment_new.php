<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
   <head>
      <title>Quote Request Summary Tool</title>
      <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
      <LINK rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>
   </head>
   <style type="text/css">
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
      }.white_content {display: none;position: absolute;top: 5%;
      left: 10%;
      width: 60%;
      height: 70%;
      padding: 16px;
      border: 1px solid gray;
      background-color: white;
      z-index:1002;
      overflow: auto;
      }
      .white_content_details {
      display: none;
      position: absolute;
      top: 0%;
      left: 10%;
      width: 50%;
      height: auto;
      padding: 16px;
      border: 1px solid gray;
      background-color: white;
      z-index:1002;
      overflow: auto;
      box-shadow: 8px 8px 5px #888888;
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
   </style>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script type="text/javascript">
      function f_getPosition (e_elemRef, s_coord) {
      
      var n_pos = 0, n_offset,
      
      e_elem = e_elemRef;	while (e_elem) {
      
      n_offset = e_elem["offset" + s_coord];
      
      n_pos += n_offset;
      
      e_elem = e_elem.offsetParent;
      
      }	e_elem = e_elemRef;
      
      while (e_elem != document.body) {
      
      n_offset = e_elem["scroll" + s_coord];
      
      if (n_offset && e_elem.style.overflow == 'scroll')
      
      n_pos -= n_offset;
      
      e_elem = e_elem.parentNode;
      
      }
      
      return n_pos;
      
      }
      
      
      
      
      
      function quote_req_tracker_update(comp_id, quote_request_tracker_id, quote_id)
      
      { 
      
      txtqreq_quoteno = document.getElementById("txtqreq_quoteno"+quote_id).value;
      
      
      
      var txtqreq_notes = document.getElementById('txtqreq_notes'+quote_id);
      
      var hdnDemandId   = document.getElementById('hdnDemandId_'+quote_id); 
      
      var hdnDemandType = document.getElementById('hdnDemandType_'+quote_id);
      
      
      
      //if(txtqreq_quoteno == "" || txtqreq_quoteno == "0"){
      
      //	alert("Please enter the Quote #.");
      
      //	return false;
      
      //} else { 
      
      if (window.XMLHttpRequest)
      
      {
      
      xmlhttp=new XMLHttpRequest();
      
      }
      
      else
      
      {// code for IE6, IE5
      
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      
      }
      
      xmlhttp.onreadystatechange=function()
      
      {
      
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
      
      {
      
      	document.getElementById("qts"+quote_id).innerHTML=xmlhttp.responseText;
      
      }
      
      }
      
      
      
      xmlhttp.open("GET","order_fulfillment_new_update.php?upd=1&company_id="+comp_id+"&qreq_quoteno="+ txtqreq_quoteno+"&quote_request_tracker_id="+quote_request_tracker_id+"&quote_id="+quote_id+"&txtqreq_notes="+encodeURIComponent(txtqreq_notes.value)+"&hdnDemandId="+hdnDemandId.value+"&hdnDemandType="+hdnDemandType.value,true);
      
      xmlhttp.send();
      
      //}
      
      }	
      
      
      
      
      
      function quote_req_tracker_update_notes(comp_id, quote_request_tracker_id, quote_id)
      
      { 
      
      var txtqreq_notes = document.getElementById('txtqreq_notes'+quote_id);
      
      var hdnDemandId   = document.getElementById('hdnDemandId_'+quote_id); 
      
      var hdnDemandType = document.getElementById('hdnDemandType_'+quote_id);
      
      
      
      //if(txtqreq_quoteno == "" || txtqreq_quoteno == "0"){
      
      //	alert("Please enter the Quote #.");
      
      //	return false;
      
      //} else { 
      
      if (window.XMLHttpRequest)
      
      {
      
      xmlhttp=new XMLHttpRequest();
      
      }
      
      else
      
      {// code for IE6, IE5
      
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      
      }
      
      xmlhttp.onreadystatechange=function()
      
      {
      
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
      
      {
      
      	document.getElementById("qts"+quote_id).innerHTML=xmlhttp.responseText;
      
      }
      
      }
      
      
      
      xmlhttp.open("GET","order_fulfillment_new_update.php?upd=1&company_id="+comp_id+"&qreq_quoteno=&quote_request_tracker_id="+quote_request_tracker_id+"&quote_id="+quote_id+"&txtqreq_notes="+encodeURIComponent(txtqreq_notes.value)+"&hdnDemandId="+hdnDemandId.value+"&hdnDemandType="+hdnDemandType.value,true);
      
      xmlhttp.send();
      
      //}
      
      }	
      
      
      
      function quote_req_tracker_deny(comp_id, quote_request_tracker_id, quote_id)
      
      {
      
      if (window.XMLHttpRequest)
      
      {
      
      xmlhttp=new XMLHttpRequest();
      
      }
      
      else
      
      {// code for IE6, IE5
      
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      
      }
      
      xmlhttp.onreadystatechange=function()
      
      {
      
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
      
      {
      
      document.getElementById("qts"+quote_id).innerHTML=xmlhttp.responseText;
      
      }
      
      }
      
      
      
      txtqreq_quoteno = document.getElementById("txtqreq_quoteno"+quote_id).value;
      
      
      
      xmlhttp.open("GET","order_fulfillment_new_update.php?deny=1&company_id="+comp_id+"&qreq_quoteno="+ txtqreq_quoteno+"&quote_request_tracker_id="+quote_request_tracker_id+"&quote_id="+quote_id,true);
      
      xmlhttp.send();
      
      }	
      
      
      
      
      
      //Show quote request details
      
      function show_details_inviewer_pos(quoteid, companyid, quote_item, unqid){
      
      var selectobject = document.getElementById(unqid); 
      
      var n_left = f_getPosition(selectobject, 'Left');
      
      var n_top  = f_getPosition(selectobject, 'Top');
      
      document.getElementById('light').style.left = n_left + 10 + 'px';
      
      document.getElementById('light').style.top = n_top + 10 + 'px';
      
      
      
      if (window.XMLHttpRequest)
      
      {// code for IE7+, Firefox, Chrome, Opera, Safari
      
      xmlhttp=new XMLHttpRequest();
      
      }
      
      else
      
      {// code for IE6, IE5
      
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      
      }
      
      xmlhttp.onreadystatechange=function()
      
      {
      
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
      
      {
      
      document.getElementById("light").innerHTML = "<a href='javascript:void(0)' onclick=document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'>Close</a> &nbsp;<center></center><br/>"+xmlhttp.responseText;
      
      document.getElementById('light').style.display='block';
      
      }
      
      }
      
      
      
      xmlhttp.open("GET","quote_show.php?showquotedata=1&quoteid="+quoteid+"&company_id="+companyid+"&quote_item="+quote_item,true);
      
      xmlhttp.send();
      
      }
      
   </script>
   <?php
      require ("inc/header_session.php");
      require ("../mainfunctions/database.php");
      require ("../mainfunctions/general-functions.php");
   ?>
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
   </style>
   <SCRIPT LANGUAGE="JavaScript" SRC="inc/CalendarPopup.js"></SCRIPT><SCRIPT LANGUAGE="JavaScript" SRC="inc/general.js"></SCRIPT>
   <script LANGUAGE="JavaScript">document.write(getCalendarStyles());</script>
   <script LANGUAGE="JavaScript">
      var cal2xx = new CalendarPopup("listdiv");
      
      
      
      cal2xx.showNavigationDropdowns();
      
      function chkdate() 
      
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
      
      
      
          if(Date.parse(document.getElementById('date_from').value)>=Date.parse(document.getElementById('date_to').value)){
      
      
      
              alert("Please select a different End Date.");
      
      
      
              return false;
      
      
      
          }
      
      }
      
      
      
   </script>
   <style>
      table tr.heading td{
      font-weight:bold;
      background:#C0CDDA;
      font-size:12px;
      font-family:Arial, Helvetica, sans-serif;
      color:"#333333";
      }
      table tr td{
      background:#e4e4e4;
      font-size:11px;
      font-family:Arial, Helvetica, sans-serif;
      color:"#333333";
      }
   </style>
   <body>
      <?php include("inc/header.php"); ?>
      <div class="main_data_css">
         <div id="light" class="white_content"></div>
         <div id="fade" class="black_overlay"></div>
         <div class="dashboard_heading" style="float: left;">
            <div style="float: left;">
               Quote Request Summary Tool    
               <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
                  <span class="tooltiptext">This report allows the user to view a summary of the quote request database entries, and mark when quotes have been made, or to deny the requests.</span>
               </div>
               <div style="height: 13px;">&nbsp;</div>
            </div>
         </div>
         <!-- <h2 ><b>Order Fulfillment Report</b></h2> -->	
         <form method="get" name="order_fulfill" action="order_fulfillment_new.php">
            <table style="background:white !important;">
               <tr>
                  <td style="background:white !important;">Date Range Selector:</td>
                  <td style="background:white !important;">
                     From: 
                     <input type="text" name="date_from" id="date_from" size="10" value="<?php echo isset($_GET['date_from']) ? $_GET['date_from'] : ''; ?>" > 
                     <a href="#" onclick="cal2xx.select(document.order_fulfill.date_from,'dtanchor2xx','MM/dd/yyyy'); return false;" name="dtanchor2xx" id="dtanchor2xx"><img border="0" src="images/calendar.jpg"></a>
                     <div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>
                     To: 
                     <input type="text" name="date_to" id="date_to" size="10" value="<?php echo isset($_GET['date_to']) ? $_GET['date_to'] : ''; ?>" > 
                     <a href="#" onclick="cal2xx.select(document.order_fulfill.date_to,'dtanchor3xx','MM/dd/yyyy'); return false;" name="dtanchor3xx" id="dtanchor3xx"><img border="0" src="images/calendar.jpg"></a>
                     <div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>
                  </td>
                  <?php
                     $repfilter = ""; $repfilter_str_incom = ""; $repfilter_str_qsent = ""; $repfilter_str_qdeny = "";
                     
                     
                     
                     if($_REQUEST["repfilter_incomplete"] == "Incomplete"){  
                     
                     	$repfilter_str_incom = "yes";
                     
                     	$repfilter = "Incomplete";
                     
                     }
                     
                     if($_REQUEST["repfilter_quote_sent"] == "Quote Sent"){  
                     
                     	$repfilter_str_qsent = "yes";
                     
                     	$repfilter = "Quote Sent";
                     
                     }
                     
                     if($_REQUEST["repfilter_quote_deny"] == "Quote Deny"){  
                     
                     	$repfilter_str_qdeny = "yes";
                     
                     	$repfilter = "Quote Deny";
                     
                     }
                     
                     ?>			
                  <td style="background:white !important;">
                     <input type="checkbox" name="repfilter_incomplete" id="repfilter_incomplete" value="Incomplete" <?php if ($repfilter_str_incom == "yes") { echo " checked ";}?> />Incomplete
                     <input type="checkbox" name="repfilter_quote_sent" id="repfilter_quote_sent" value="Quote Sent" <?php if ($repfilter_str_qsent == "yes") { echo " checked ";}?> />Quote Sent
                     <input type="checkbox" name="repfilter_quote_deny" id="repfilter_quote_deny" value="Quote Deny" <?php if ($repfilter_str_qdeny == "yes") { echo " checked ";}?> />Quote Deny
                  </td>
                  <td style="background:white !important;">
                     <input type="submit" value="Display" onClick="javascript: return chkdate()">
                  </td>
               </tr>
            </table>
         </form>
         <?php
           
            	$rep_filter_qry_str1 = ""; $rep_filter_qry_str2 = "";
            
            	if($repfilter == ""){  
            
            		$rep_filter_qry_str1 = " quote_req_status = 'Incomplete' and ";
            
            		$rep_filter_qry_str2 = " where quote_req_status = 'Incomplete' ";
            
            	}
            
            	if($repfilter != ""){ 
            
            	
            		if($repfilter_str_incom == "yes" && $repfilter_str_qsent == "yes" && $repfilter_str_qdeny == "yes"){  
            
            			$rep_filter_qry_str1 == "";
            
            			$rep_filter_qry_str2 == "";
            
            		}	
            
            		if($repfilter_str_incom == "yes" && $repfilter_str_qsent == "" && $repfilter_str_qdeny == "yes"){  
            
            			$rep_filter_qry_str1 = " (quote_req_status <> 'Quote Sent' and quote_req_deny = 1) and  ";
            
            			$rep_filter_qry_str2 = " where (quote_req_status <> 'Quote Sent' and quote_req_deny = 1) ";
            
            		}	
            
            		if($repfilter_str_incom == "yes" && $repfilter_str_qsent == "" && $repfilter_str_qdeny == ""){  
            
            			$rep_filter_qry_str1 = " (quote_req_status <> 'Quote Sent' and quote_req_deny <> 1) and ";
            
            			$rep_filter_qry_str2 = " where (quote_req_status <> 'Quote Sent' and quote_req_deny <> 1) ";
            
            		}	
            
            
            
            		if($repfilter_str_incom == "" && $repfilter_str_qsent == "yes" && $repfilter_str_qdeny == ""){  
            
            			$rep_filter_qry_str1 = " (quote_req_status = 'Quote Sent' ) and  ";
            
            			$rep_filter_qry_str2 = " where (quote_req_status = 'Quote Sent' ) ";
            
            		}	
            
            		if($repfilter_str_incom == "" && $repfilter_str_qsent == "yes" && $repfilter_str_qdeny == "yes"){  
            
            			$rep_filter_qry_str1 = " (quote_req_status = 'Quote Sent' and quote_req_deny = 1) and  ";
            
            			$rep_filter_qry_str2 = " where (quote_req_status = 'Quote Sent' and quote_req_deny = 1) ";
            
            		}	
            
            
            
            		if($repfilter_str_incom == "" && $repfilter_str_qsent == "" && $repfilter_str_qdeny == "yes"){  
            
            			$rep_filter_qry_str1 = " (quote_req_deny = 1 ) and  ";
            
            			$rep_filter_qry_str2 = " where (quote_req_deny = 1 ) ";
            
            		}	
            
            		
            
            	}	
            
            
            
            	if( $_GET["date_from"] !="" && $_GET["date_to"] !=""){
            
            		$date_from_val = date("Y-m-d", strtotime($_GET["date_from"]));
            
            		$date_to_val = date("Y-m-d", strtotime($_GET["date_to"]));
            
            
            
            		$getquotequery = "Select * from quote_request_tracker where $rep_filter_qry_str1 date_submitted BETWEEN '" . $date_from_val . "' AND '" . $date_to_val . " 23:59:59' order by quote_request_tracker_id DESC";
					
					db();
            		$quote_res = db_query($getquotequery);
            
            		$chkinitials =  $_COOKIE['userinitials'] ; 
            
            	}else{
            
            		$getquotequery = "Select * from quote_request_tracker $rep_filter_qry_str2 order by date_submitted desc";
					
					db();
            		$quote_res = db_query($getquotequery);	
            
            		$chkinitials =  $_COOKIE['userinitials'] ; 
            
            	}
            
            	?>
         <table width="1090px" id="q_table" class="table1" cellpadding="3" cellspacing="1">
            <tr class="heading">
               <td width="60px">
                  Quote Request ID
               </td>
               <td width="100px">
                  Quote Request Item
               </td>
               <td width="60px">
                  Demand ID
               </td>
               <td width="100px">
                  Company
               </td>
               <td width="80px">
                  Submitted Date
               </td>
               <td width="80px">
                  Completed Date
               </td>
               <td width="80px">
                  Status
               </td>
               <td width="100px">
                  Quote #
               </td>
               <td width="200px">
                  Notes
               </td>
               <td width="70px">
                  Quoted Date
               </td>
               <td width="50px">
                  Update
               </td>
               <td width="50px">
                  Deny
               </td>
            </tr>
            <?php
               $count=1;
               
               while($q_row=array_shift($quote_res))
               
               {
               
               	$quote_item = $q_row['quote_item'];
               
               	$quote_id = $q_row['quote_request_tracker_id'];
               
               	//
               
               
               
               	$demand_type = "";
               
               	$item_query = "Select * from quote_request_item where status=1 and quote_rq_id = " . $q_row['demand_type'];
				
				db();
               	$item_res = db_query($item_query);
               
               	while ($item_rows = array_shift($item_res)) {
               
               		$demand_type = $item_rows["item"];
               
               	}
               
               
               
               	$cid = $q_row['company_id'];			
               
               ?>
            <tr id="qts<?php echo $quote_id?>">
               <td>
                  <?php echo $quote_id; ?>
               </td>
               <td>
                  <a href='#' id='quote_req<?php echo $quote_id?>' onclick="show_details_inviewer_pos('<?php echo $q_row['demand_id']?>', '<?php echo $cid?>', '<?php echo $q_row['demand_type']?>','quote_req<?php echo $quote_id?>'); return false;"><?php echo $demand_type; ?></a>	
               </td>
               <td>
                  <?php echo $q_row['demand_id']; ?>
               </td>
               <td>
                  <?php
                     
                     $x = "Select companyInfo.ID, companyInfo.company from companyInfo where ID =".$cid;
                     
					 db_b2b();
                     $dt_view_res = db_query($x);
                     
                     $comprow = array_shift($dt_view_res);
                     
                     	echo "<a target='_blank' href='viewCompany.php?ID=".$comprow['ID']."&proc=View&searchcrit=&show=Quoting&rec_type=Supplier'>".$comprow["company"]."</a>"; 
                     
                     	db();
                     
                     ?>
               </td>
               <td>
                  <?php echo date("m/d/Y", strtotime($q_row['date_submitted'])); ?>
               </td>
               <td ><?php if ($q_row["date_completed"] != "") { 
                  echo date("m/d/Y", strtotime($q_row["date_completed"])); 
                  
                  }
                  
                  ?></td>

               <td ><?php 
                
                  	echo $q_row["quote_req_status"];
            
                  ?>
               </td>
               <?php if ($q_row["quote_req_status"] == "Quote Sent" ) {?>
               <td >
                  <div id="qidno_div_<?php echo $quote_id;?>"><?php echo $q_row["quote_id"];?></div>
               </td>
               <?php } else {?>
             
               <?php 
               
                  	if ($q_row["quote_req_deny"] == 0 ) {?>
               <td ><input type="text" name="txtqreq_quoteno" size="10" id="txtqreq_quoteno<?php echo $quote_id?>" value="" /></td>
               <?php }else{?>
               <td >&nbsp;</td>
               <?php }
                 
                  }?>
               <td width="200px">
                  <?php
                     $notesData = $q_row['quote_req_notes'];
                     
                     ?>
                  <?php if ($q_row["quote_req_status"] == "Quote Sent" ) {?>
                  <div id="qnote_div_<?php echo $quote_id;?>"> <?php echo $notesData;?> </div>
                  <?php if ($notesData != "") {?>
                  <input onclick="quote_req_tracker_edit(<?php echo $cid?>, <?php echo $q_row["quote_request_tracker_id"];?>, <?php echo $quote_id?>)" type="button" name="btnedit" id="btnedit<?php echo $quote_id?>" value="Edit" />
                  <?php }?>
                  <?php } else {
                     if ($q_row["quote_req_deny"] == 0 ) {?>
                  <input type="text" name="txtqreq_notes" size="30" id="txtqreq_notes<?php echo $quote_id?>" value="<?php echo $notesData;?>" />
                  <?php }else{?>
                  &nbsp;
                  <?php }
                     }?>					
                  <input type="hidden" name="hdnDemandId" id="hdnDemandId_<?php echo $quote_id;?>" value="<?php echo $q_row['demand_id'];?>">
                  <input type="hidden" name="hdnDemandType" id="hdnDemandType_<?php echo $quote_id?>" value="<?php echo $q_row['demand_type'];?>">
               </td>
               <td ><?php if ($q_row["quote_dated"] != "") { echo $q_row["quote_dated"]; }?></td>
               <?php if ($q_row["quote_req_status"] == "Quote Sent" && $q_row["quote_req_deny"] == 0) {?>
               <td>
                  <div id='btneditup_<?php echo $quote_id?>'>Complete</div>
               </td>
               <?php } else {?>
               <?php if ($q_row["quote_req_deny"] == 0 ) {?>	
               <td ><input type="button" name="btnupdate" id="btnupdate<?php echo $quote_id?>" value="Update" onclick="quote_req_tracker_update(<?php echo $cid?>, <?php echo $q_row["quote_request_tracker_id"];?>, <?php echo $quote_id?>)" /></td>
               <?php }else{?>
               <td >&nbsp;</td>
               <?php }
                  }?>
               <?php  if ($q_row["date_completed"] != "" || $q_row["quote_req_status"] == "Quote Sent" ) { ?>
               <td >&nbsp;</td>
               <?php }else {
                  if ($q_row["quote_req_deny"] == 1 ) {?>
               <td >Deny on <?php echo date("m/d/Y",  strtotime($q_row["quote_req_deny_on"])) . " by " . $q_row["quote_req_deny_by"];?></td>
               <?php } else {?>
               <td ><input type="button" name="btndeny" id="btndeny<?php echo $quote_id?>" value="Deny" onclick="quote_req_tracker_deny(<?php echo $cid?>, <?php echo $q_row["quote_request_tracker_id"];?>, <?php echo $quote_id?>)" /></td>
               <?php }
                  }	
                  
                  ?>		
            </tr>
            <?php
               }
               
               ?>
         </table>
      </div>
   </body>
</html>
<script>
   function quote_req_tracker_edit(comp_id, quote_request_tracker_id, quote_id){
   
   	var notetxt = document.getElementById('qnote_div_' + quote_id).innerHTML;
   
   	document.getElementById('qnote_div_' + quote_id).innerHTML = '<input type="text" name="txtqreq_notes" size="30" id="txtqreq_notes'+ quote_id +'" value="' + notetxt + '" />';
   
   	document.getElementById('btnedit' + quote_id).style.display = "none";
   
   	document.getElementById('btneditup_' + quote_id).innerHTML = '<input type="button" name="btnupdate" id="btnupdate'+ quote_id +'" value="Update" onclick="quote_req_tracker_update_notes('+ comp_id +', '+ quote_request_tracker_id +', '+ quote_id +')" />';
   
   }
   
</script>
