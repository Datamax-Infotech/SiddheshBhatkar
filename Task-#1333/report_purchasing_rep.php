<?php
   require ("inc/header_session.php");  
   require ("../mainfunctions/database.php"); 
   require ("../mainfunctions/general-functions.php");
  
   $initials =  $_COOKIE['userinitials'];
?>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
      <title>B2B Purchasing Rep Revenue Report</title>
      <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
      <LINK rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>
      <SCRIPT LANGUAGE="JavaScript" SRC="inc/CalendarPopup.js"></SCRIPT><SCRIPT LANGUAGE="JavaScript" SRC="inc/general.js"></SCRIPT>
      <script LANGUAGE="JavaScript">document.write(getCalendarStyles());</script>
      <script LANGUAGE="JavaScript">
         var cal1xx = new CalendarPopup("listdiv");
         
         cal1xx.showNavigationDropdowns();
         
         var cal2xx = new CalendarPopup("listdiv");
         
         cal2xx.showNavigationDropdowns();
         
         var cal3xx = new CalendarPopup("listdiv");
         
         cal3xx.showNavigationDropdowns();	
         
         var cal4xx = new CalendarPopup("listdiv");
         
         cal4xx.showNavigationDropdowns();	
         
      </script>
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
         }
         .white_content {
         display: none;
         position: absolute;
         top: 5%;
         left: 10%;
         width: 40%;
         height: 50%;
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
         .style1_org {
         font-size: xx-small;
         color: #000;
         }
         .style1_org_white {
         font-size: xx-small;
         color: #fff;
         }
      </style>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script>
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
         
         
         
         function edit_comm_row(payment_id, buyer_id, paymentflg, eid){
         
         
         
           // alert(eid);
         
         var selectobject = document.getElementById(payment_id); 
         
         
         
         var n_left = f_getPosition(selectobject, 'Left');
         
         
         
         var n_top  = f_getPosition(selectobject, 'Top');
         
              document.getElementById('light').style.left = 300 + 'px';
         
         
         
         document.getElementById('light').style.top = n_top + 30 + 'px';
         
              //
         
              var date_from=document.getElementById('date_from').value;
         
              var date_to=document.getElementById('date_to').value;
         
              //
         
         
         
         if (window.XMLHttpRequest)
         
         
         
         {
         
         xmlhttp=new XMLHttpRequest();
         
         }
         
         
         
         else
         
         {
         
         xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
         
         
         
         }
         
         xmlhttp.onreadystatechange=function()
         
         
         
         {
         
         if (xmlhttp.readyState==4 && xmlhttp.status==200)
         
         
         
         {	
         
         
         
                   // alert(ctrlnm);
         
         
         
         document.getElementById("light").innerHTML = "<a href='javascript:void(0)' onclick=document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'>Close</a> <br><hr>"+ xmlhttp.responseText;//
         
         
         
         document.getElementById('light').style.display='block';
         
         
         
         /*	document.getElementById('light').style.left = n_left + 10 + 'px';
         
         
         
         document.getElementById('light').style.top = n_top + 10 + 'px';*/
         
         
         
         }
         
         
         
         }
         
         xmlhttp.open("GET","edit_commission_frm.php?payment_id="+payment_id+"&buyer_id="+buyer_id+"&paymentflg="+paymentflg+"&eid="+eid+"&date_from="+date_from+"&date_to="+date_to, true);
         
         
         
         xmlhttp.send();
         
         }
         
         
         
         //
         
         function commission_update(payment_id, buyer_id)
         
         { 
         
         var paymentflg = document.getElementById("paymentflg").value;
         
         
         
         var status = document.getElementById("status").value;
         
         var company_id = document.getElementById("company_id").value;
         
         var typeid = document.getElementById("typeid").value;
         
         var estimated_cost = document.getElementById("estimated_cost").value;
         
         var confirmed_cost = document.getElementById("confirmed_cost").value;
         
         var notes = escape(document.getElementById("notes").value);
         
         var employee = document.getElementById("employee").value;
         
         var eid = document.getElementById("eid").value;
         
         var date_from=document.getElementById('date_from').value;
         
         var date_to=document.getElementById('date_to').value;
         
         // alert(notes);
         
         //alert(employee);
         
         //
         
         if (window.XMLHttpRequest)
         
         
         
         {// code for IE7+, Firefox, Chrome, Opera, Safari
         
         
         
         xmlhttp=new XMLHttpRequest();
         
         }
         
         else
         
         {
         
         // code for IE6, IE5
         
         xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
         
         }
         
         xmlhttp.onreadystatechange=function()
         
         {
         
         if (xmlhttp.readyState==4 && xmlhttp.status==200)
         
         
         
         {
         
           document.getElementById('light').style.display='none';
         
         document.getElementById('fade').style.display='none';
         
         
         
           // alert(xmlhttp.responseText);
         
         document.getElementById("buyer_row"+payment_id).innerHTML=xmlhttp.responseText;
         
          // $("#val_profit"+buyer_id).load(location.href + " #val_profit");
         
         var comm_val = document.getElementById("comm_val").value;
         
         var profit_val = document.getElementById("profit_val").value;
         
         
         
         document.getElementById("val_profit"+buyer_id).innerHTML=profit_val;
         
         document.getElementById("val_commission"+buyer_id).innerHTML=comm_val;
         
         update_summary_table(payment_id,buyer_id,paymentflg,eid,date_from,date_to);
         
         }
         
         }
         
         xmlhttp.open("POST","commission_report_updated.php?updatereq=1&payment_id="+payment_id+"&buyer_id="+buyer_id+"&status="+status+"&company_id="+company_id+"&paymentflg="+paymentflg+"&typeid="+typeid+"&estimated_cost="+estimated_cost+"&confirmed_cost="+confirmed_cost+"&notes="+notes+"&eid="+eid+"&employee="+employee+"&date_from="+date_from+"&date_to="+date_to,true);
         
         
         
         xmlhttp.send();
         
         
         
         }
         
           
         
         function update_summary_table(payment_id,buyer_id,paymentflg,eid,date_from,date_to){
         
         if (window.XMLHttpRequest)
         
         
         
         {// code for IE7+, Firefox, Chrome, Opera, Safari
         
         
         
         xmlhttp=new XMLHttpRequest();
         
         }
         
         else
         
         {
         
         // code for IE6, IE5
         
         xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
         
         }
         
         xmlhttp.onreadystatechange=function()
         
         {
         
         if (xmlhttp.readyState==4 && xmlhttp.status==200)
         
         
         
         {
         
           document.getElementById('light').style.display='none';
         
         document.getElementById('fade').style.display='none';
         
         
         
           // alert(xmlhttp.responseText);
         
         document.getElementById("summary_row").innerHTML=xmlhttp.responseText;
         
         
         
         }
         
         }
         
         xmlhttp.open("POST","summary_report_updated.php?updatereq=1&payment_id="+payment_id+"&buyer_id="+buyer_id+"&paymentflg="+paymentflg+"&eid="+eid+"&date_from="+date_from+"&date_to="+date_to,true);
         
         
         
         xmlhttp.send();
         
         }
         
         //
         
            
         
         function delete_comm_row(payment_id, buyer_id, paymentflg, eid)
         
         {
         
         
         
         var choice = confirm('Do you really want to delete this record?');
         
         
         
         if(choice === true) {
         
         var date_from=document.getElementById('date_from').value;
         
         var date_to=document.getElementById('date_to').value;
         
         
         
         //  var p="other";
         
         //alert(paymentflg);
         
         //
         
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
         
         document.getElementById("show_rec"+buyer_id).innerHTML=xmlhttp.responseText;
         
           // $("#show_rec").load(location.href + " #show_rec");
         
         //
         
         var comm_val = document.getElementById("comm_val").value;
         
         var profit_val = document.getElementById("profit_val").value;
         
         //
         
         document.getElementById("val_profit"+buyer_id).innerHTML=profit_val;
         
         document.getElementById("val_commission"+buyer_id).innerHTML=comm_val;
         
           //document.getElementById("qts"+req_unq_id).innerHTML=xmlhttp.responseText;
         
         update_summary_table(payment_id,buyer_id,paymentflg,eid,date_from,date_to);
         
         alert("Record has been deleted!!");
         
         }
         
         }
         
         xmlhttp.open("GET","delete_commission_row.php?deldata=1&payment_id="+payment_id+"&buyer_id="+buyer_id+"&paymentflg="+paymentflg+"&eid="+eid+"&date_from="+date_from+"&date_to="+date_to, true);
         
         
         
         xmlhttp.send();
         
         }
         
         else{
         
         
         
         }
         
         
         
         }
         
      </script>
      <?php
         echo "<LINK rel='stylesheet' type='text/css' href='one_style.css' >";
         
         ?>
   </head>
   <script>
      function set_paidflg(data) {
      
      	
      
      	if (document.getElementById("match_confirmed").value == "commissions_paid")
      
      	{
      
      		document.getElementById ("paidunpaid_flg").value = "Paid";
      
      		document.getElementById("showcal").style.display = "inline";
      
      	}else{
      
      		document.getElementById("showcal").style.display = "none";
      
      	}	
      
      }			
      
      
      
      function loadmainpg() 
      
      {
      
      	//document.getElementById("paidunpaid_flg").value = value;
      
      	if(document.getElementById("match_confirmed").value == "commissions_paid"){
      
      		document.getElementById("paidunpaid_flg").value = "Paid";
      
      	}else{
      
      		document.getElementById("paidunpaid_flg").value = "Unpaid";
      
      	}	
      
      	
      
      	//if(document.getElementById ("paidunpaid_flg").value == "Paid")
      
      	if(document.getElementById("match_confirmed").value == "commissions_paid")
      
      	{
      
      		if(document.getElementById('date_from').value !="" && document.getElementById('date_to').value !="")
      
      		{
      
      			  //document.frmactive.action = "adminpg.php";
      
      			  document.rptpurchasingrep.submit();
      
      		}
      
      		else
      
      		{
      
      			  alert("Please select Mark as paid date From/To.");
      
      			  return false;
      
      		}
      
      	}else{
      
      		document.rptpurchasingrep.submit();
      
      	}
      
      }
      
      
      
      function calovecomm(totrev){
      
      	var totcom;
      
      	totcom = totrev * document.getElementById('overallcomm').value;
      
      	document.getElementById('overallcomm_val').value = totcom.toFixed(2);
      
      }
      
          //
      
   </script>
   <script>
      function showEmailVersion(){
      
          if(document.getElementById('show_e').checked==true){
      
              var url = window.location.href;
      
               url+='&show_e=Y';
      
          }
      
          else
      
              {
      
                  var originalurl = window.location.href; 
      
                 var url = removeParam("show_e", originalurl); 
      
              }
      
         window.location.href = url;
      
      
      
      }
      
      
      
      function showEmptySections(){
      
          if(document.getElementById('show_empty_sections').checked==true){
      
              var url = window.location.href;
      
               url+='?&show_empty_sections=Y';
      
          }
      
          else
      
              {
      
                  var originalurl = window.location.href; 
      
                 var url = removeParam("show_empty_sections", originalurl); 
      
              }
      
         window.location.href = url;
      
      
      
      }
      
      
      
      function removeParam(key, sourceURL) {
      
          var rtn = sourceURL.split("?")[0],
      
              param,
      
              params_arr = [],
      
              queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
      
          if (queryString !== "") {
      
              params_arr = queryString.split("&");
      
              for (var i = params_arr.length - 1; i >= 0; i -= 1) {
      
                  param = params_arr[i].split("=")[0];
      
                  if (param === key) {
      
                      params_arr.splice(i, 1);
      
                  }
      
              }
      
              rtn = rtn + "?" + params_arr.join("&");
      
          }
      
          return rtn;
      
      }
      
   </script>
   <style>
      .newtxttheam_withdot
      {
      font-family:Arial, Helvetica, sans-serif;
      font-size:xx-small;
      padding:4px;
      background-color:#e4e4e4;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
      }
      .newtxttheam_withdot_light
      {
      font-family:Arial, Helvetica, sans-serif;
      font-size:xx-small;
      padding:4px;
      background-color:#f4f5ef;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
      }
      .newtxttheam_withdot_red
      {
      font-family:Arial, Helvetica, sans-serif;
      font-size:xx-small;
      padding:4px;
      background-color:red;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
      }
      .highlight_row{
      background-color: #df2f2f;
      }
      .rec_row{
      background-color: #e4e4e4;
      }
   </style>
   <body>
      <?php include("inc/header.php"); ?>
      <div class="main_data_css">
         <div id="light" class="white_content"></div>
         <div id="fade" class="black_overlay"></div>
         <div class="dashboard_heading" style="float: left;">
            <div style="float: left;">
               B2B Purchasing Rep Revenue Report   
               <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
                  <span class="tooltiptext">This report shows the user all revenue a purchasing rep has produced from their deals within a date range.</span>
               </div>
               <br>
            </div>
         </div>
         <form method="post" name="rptpurchasingrep" id="rptpurchasingrep" action="report_purchasing_rep.php">
            <table >
               <tr>
                  <td valign="top">
                     <span style="vertical-align:top;">Revenue By Purchasing Rep: </span>
                     <select name="eid[]" id="eid" multiple size="10">
                        <?php		
                           $qry = "Select * from loop_employees where status = 'Active' ORDER BY name asc";
						   db();
                           $qry_res = db_query($qry);
                           
                           while ($emp_row = array_shift($qry_res)) {
                           
                           ?>
                        <option <?php foreach ($_POST['eid'] as $eid_sel) if ($emp_row["id"]==$eid_sel) echo " selected ";  ?> value="<?php echo $emp_row["id"];?>"><?php echo $emp_row["name"]; ?></option>
                        <?php	
                           }
                           
                           ?>
                     </select>
                  </td>
                  <td>
                     Date from: 
                     <input type="text" name="date_from" id="date_from" size="8" value="<?php echo isset($_REQUEST['date_from']) ? $_REQUEST['date_from'] : ''; ?>" > 
                     <a href="#" onclick="cal2xx.select(document.rptpurchasingrep.date_from,'dtanchor2xx','yyyy-MM-dd'); return false;" name="dtanchor2xx" id="dtanchor2xx"><img border="0" src="images/calendar.jpg"></a>
                     <div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>
                     To: 
                     <input type="text" name="date_to" id="date_to" size="8" value="<?php echo isset($_REQUEST['date_to']) ? $_REQUEST['date_to'] : ''; ?>" > 
                     <a href="#" onclick="cal2xx.select(document.rptpurchasingrep.date_to,'dtanchor3xx','yyyy-MM-dd'); return false;" name="dtanchor3xx" id="dtanchor3xx"><img border="0" src="images/calendar.jpg"></a>
                     <div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>
                  </td>
                  <td>
                     <input type="submit" value="Run Report">
                     <input type="hidden" id="reprun" name="reprun" value="yes">
                  </td>
               </tr>
            </table>
         </form>
         <?php if (isset($_REQUEST["reprun"])) {?>
         <table>
            <tr style="background: #2B1B17;">
               <td colspan="10" style="color:#ffffff" align="center"><font size=1>Report Purchasing Rep</font></td>
            </tr>
            <?php
               $sort_order = "asc";
               
               if($_REQUEST['sort_order'] == "asc")
               
               {
               
               	$sort_order = "desc";
               
               }else{
               
               	$sort_order = "asc";
               
               }
               
               
               
               $sorturl="report_purchasing_rep.php?eid=".$_REQUEST['eid']."&date_from=".$_REQUEST['date_from']."&date_to=".$_REQUEST['date_to'];	
               
               ?>
            <tr style="background: #2B1B17;">
               <td style="color:#ffffff" align="middle"><font size="1" face="Arial, Helvetica, sans-serif" >Employee&nbsp;<a href="<?php echo $sorturl; ?>&emp=asc&sort=y"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;<a href="<?php echo $sorturl; ?>&emp=desc&sort=y"><img src="images/sort_desc.png" width="6px;" height="12px;"></a></font></td>
               <td style="color:#ffffff" align="middle"><font size="1" face="Arial, Helvetica, sans-serif" >Box Source&nbsp;<a href="<?php echo $sorturl; ?>&box_source=asc&sort=y"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;<a href="<?php echo $sorturl; ?>&box_source=desc&sort=y"><img src="images/sort_desc.png" width="6px;" height="12px;"></a></font></td>
               <td style="color:#ffffff" align="middle"><font size="1" face="Arial, Helvetica, sans-serif" >Customer&nbsp;<a href="<?php echo $sorturl; ?>&customer=asc&sort=y"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;<a href="<?php echo $sorturl; ?>&customer=desc&sort=y"><img src="images/sort_desc.png" width="6px;" height="12px;"></a></font></td>
               <td style="color:#ffffff" align="middle"><font size="1" face="Arial, Helvetica, sans-serif" >Order ID&nbsp;<a href="<?php echo $sorturl; ?>&orderid=asc&sort=y"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;<a href="<?php echo $sorturl; ?>&orderid=desc&sort=y"><img src="images/sort_desc.png" width="6px;" height="12px;"></a></font></td>
               <td style="color:#ffffff" align="middle"><font size="1" face="Arial, Helvetica, sans-serif" >Description&nbsp;<a href="<?php echo $sorturl; ?>&description=asc&sort=y"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;<a href="<?php echo $sorturl; ?>&description=desc&sort=y"><img src="images/sort_desc.png" width="6px;" height="12px;"></a></font></td>
               <td style="color:#ffffff" align="middle"><font size="1" face="Arial, Helvetica, sans-serif" >Division&nbsp;<a href="<?php echo $sorturl; ?>&division=asc&sort=y"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;<a href="<?php echo $sorturl; ?>&division=desc&sort=y"><img src="images/sort_desc.png" width="6px;" height="12px;"></a></font></td>
               <td style="color:#ffffff" align="middle"><font size="1" face="Arial, Helvetica, sans-serif" >Category&nbsp;<a href="<?php echo $sorturl; ?>&category=asc&sort=y"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;<a href="<?php echo $sorturl; ?>&category=desc&sort=y"><img src="images/sort_desc.png" width="6px;" height="12px;"></a></font></td>
               <td style="color:#ffffff" align="middle"><font size="1" face="Arial, Helvetica, sans-serif" >Quantity&nbsp;<a href="<?php echo $sorturl; ?>&qty=asc&sort=y"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;<a href="<?php echo $sorturl; ?>&qty=desc&sort=y"><img src="images/sort_desc.png" width="6px;" height="12px;"></a></font></td>
               <td style="color:#ffffff" align="middle"><font size="1" face="Arial, Helvetica, sans-serif" >Price&nbsp;<a href="<?php echo $sorturl; ?>&price=asc&sort=y"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;<a href="<?php echo $sorturl; ?>&price=desc&sort=y"><img src="images/sort_desc.png" width="6px;" height="12px;"></a></font></td>
               <td style="color:#ffffff" align="middle"><font size="1" face="Arial, Helvetica, sans-serif" >Total&nbsp;<a href="<?php echo $sorturl; ?>&total=asc&sort=y"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;<a href="<?php echo $sorturl; ?>&total=desc&sort=y"><img src="images/sort_desc.png" width="6px;" height="12px;"></a></font></td>
            </tr>
            <?php
               foreach ($_POST['eid'] as $eid_sel) {		
               
               	$emp_name = "";
				db();
               	$qry = db_query("Select name from loop_employees where id = " . $eid_sel);
               
               	while ($row_rs_tmprs = array_shift($qry)) {
               
               		$emp_name = $row_rs_tmprs["name"]; 
               
               	}
               
               
               
               	$str_box_list_ids = ""; $str_box_list_transids = "";
               
               	db();
               	$qry = db_query("SELECT distinct(loop_box_id) AS id, trans_rec_id FROM loop_invoice_items WHERE box_item_founder_emp_id=". $eid_sel);
               
               	while ($row_rs_tmprs = array_shift($qry)) {
               
               		$str_box_list_ids .= $row_rs_tmprs["id"] . ","; 
               
               		$str_box_list_transids .= $row_rs_tmprs["trans_rec_id"] . ","; 
               
               	}
               
               	if ($str_box_list_transids != ""){
               
               		$str_box_list_transids = substr($str_box_list_transids, 0, strlen($str_box_list_transids)-1);
               
               	}
               
               	
               
               	if ($str_box_list_ids != ""){
               
               		$str_box_list_ids = substr($str_box_list_ids, 0, strlen($str_box_list_ids)-1);
               
               	
               
               		$row_no = 0;
					db();
               		$qry = db_query("Select box_id, qty, loop_bol_tracking.trans_rec_id FROM loop_bol_tracking inner join loop_invoice_details on loop_invoice_details.trans_rec_id = loop_bol_tracking.trans_rec_id 
               
               		where loop_invoice_details.trans_rec_id in (" . $str_box_list_transids . ") and loop_invoice_details.timestamp between '" . date("Y-m-d" , strtotime($_REQUEST["date_from"])) . "' and '" . date("Y-m-d" , strtotime($_REQUEST["date_to"])) . " 23:59:59' and box_id in (" . $str_box_list_ids . ")");
               
               
               		while ($row_rs_tmprs = array_shift($qry)) {
               
               			$vendor_b2b_rescue = 0; $box_source = ""; $bdescription = ""; $division_id = ""; $category_id = ""; $division = ""; $category = "";
						db();
               			$qry_box = db_query("Select * from loop_boxes where id = " . $row_rs_tmprs["box_id"]);
               
               			while ($row_rs_data = array_shift($qry_box)) {
               
               				$vendor_b2b_rescue = $row_rs_data["vendor_b2b_rescue"]; 
               
               				$bdescription = $row_rs_data["bdescription"]; 
               
               				$division_id = $row_rs_data["division"]; 
               
               				$category_id = $row_rs_data["category"]; 
               
               			}
               
               
               			if ($row_rs_tmprs["trans_rec_id"] != $tmp_trans_id ){
               
               				$row_no	= 0;		
               
               			}else{
               
               				$row_no	= $row_no + 1;		
               
               			}			
               
               
               			$price = 0; $total = 0;
               
               			db();
               			$qry_box_main = db_query("Select * from loop_invoice_items where trans_rec_id = " . $row_rs_tmprs["trans_rec_id"] . " and loop_box_id = '" . $row_rs_tmprs["box_id"] . "'");
               
               			while ($row_rs_data_main = array_shift($qry_box_main)) {
               
               				$quantity = $quantity + $row_rs_data_main["quantity"];
               
               				$price = $row_rs_data_main["price"];
               
               				$total = $total + str_replace(",", "", $row_rs_data_main["total"]);
               
               			}	
               
               			
               
               			$qry1 = "SELECT * FROM division_master where division_id = ". $division_id;
						db();
               			$dt_view_res = db_query($qry1);
               
               			while ($data_row = array_shift($dt_view_res)) {
               
               				$division = $data_row["division"];
               
               			}
               
               			$qry1 = "SELECT * FROM category_master where category_id = ". $category_id;
						db();
               			$dt_view_res = db_query($qry1);
               
               			while ($data_row = array_shift($dt_view_res)) {
               
               				$category = $data_row["category"];
               
               			}
               
               			
               
               			$q1 = "SELECT id, company_name, b2bid FROM loop_warehouse where id = $vendor_b2b_rescue";
						db();
               			$query = db_query($q1);
               
               			while($fetch = array_shift($query))
               
               			{
               
               				$box_source = $fetch['company_name'] . " (Loop ID: " . $fetch["id"] . " B2B ID:" . $fetch["b2bid"] . ")";
               
               			}			
               
               
               
               			$b2bid = 0; $company_name = ""; $wid = 0;
               
               			$q1 = "SELECT loop_warehouse.b2bid, loop_warehouse.id as wid, company_name FROM loop_transaction_buyer inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id where loop_transaction_buyer.id = " . $row_rs_tmprs["trans_rec_id"];
						db();
               			$query = db_query($q1);
               
               			while($fetch = array_shift($query))
               
               			{
               
               				$b2bid = $fetch['b2bid'];
               
               				$wid = $fetch['wid'];
               
               				$company_name = $fetch['company_name']; 
               
               			}			
               
               			
               
               			$customer = getnickname($company_name, $b2bid);
               
               			$classnm = "newtxttheam_withdot"; 
               
               			$gr_total = $gr_total + str_replace(",", "", $total);
               
               		?>
            <tr>
               <td align="left" class="<?php echo $classnm?>"><?php echo $emp_name; ?></td>
               <td align="left" class="<?php echo $classnm?>"><?php echo $box_source; ?></td>
               <td align="left" class="<?php echo $classnm?>"><?php echo $customer; ?></td>
               <td align="left" class="<?php echo $classnm?>"><a href ="viewCompany.php?ID=<?php echo $b2bid;?>&show=transactions&warehouse_id=<?php echo $wid;?>&rec_type=Supplier&proc=View&searchcrit=&id=<?php echo $wid;?>&rec_id=<?php echo $row_rs_tmprs["trans_rec_id"];?>&display=buyer_payment" target="_blank"><font size=1><?php echo $row_rs_tmprs["trans_rec_id"]; ?></font></a></td>
               <td align="left" class="<?php echo $classnm?>"><?php echo $bdescription; ?></td>
               <td align="left" class="<?php echo $classnm?>"><?php echo $division; ?></td>
               <td align="left" class="<?php echo $classnm?>"><?php echo $category; ?></td>
               <td align="right" class="<?php echo $classnm?>"><?php echo $quantity; ?></td>
               <td align="right" class="<?php echo $classnm?>"><?php echo $price; ?></td>
               <td align="right" class="<?php echo $classnm?>">$<?php echo number_format(str_replace(",", "", $total),2); ?></td>
            </tr>
            <?php
               $tmp_trans_id = $row_rs_tmprs["trans_rec_id"];
               
               }	
               
               }
               
               }	
               
               ?>
            <tr>
               <td colspan="9" align="right">Total</td>
               <td align="right" class="<?php echo $classnm; ?>">$<?php echo number_format($gr_total,2); ?></td>
            </tr>
         </table>
         <?php }?>
      </div>
   </body>
</html>
