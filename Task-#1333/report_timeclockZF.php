<?php 
   require ("inc/header_session.php");
   require ("../mainfunctions/database.php");
   require ("../mainfunctions/general-functions.php");
?>
<!DOCTYPE html>
<html>
   <head>
      <title>Individual Timeclock & Production Summary Report</title>
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
         width: 60%;
         height: 35%;
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
      </style>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script type="text/javascript">
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
         
         
         
         //Show quote request details
         
         
         
         
         
         function edit_timeclock(workerid, run, edit, id, startdate, enddate){
         
         var selectobject = document.getElementById(id); 
         
         var n_left = f_getPosition(selectobject, 'Left');
         
         var n_top  = f_getPosition(selectobject, 'Top');
         
         document.getElementById('light').style.left = n_left + 10 + 'px';
         
         document.getElementById('light').style.top = n_top + 10 + 'px';
         
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
         
                 
         
         document.getElementById("light").innerHTML = "<a href='javascript:void(0)' onclick=document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'>Close</a> &nbsp;<center></center><br/>"+xmlhttp.responseText;
         
             document.getElementById('light').style.display='block';
         
         }
         
         }
         
             xmlhttp.open("GET","timeclockZF_edit.php?edit="+edit+"&workerid="+workerid+"&id="+id+"&startdate="+startdate+"&enddate="+enddate,true);
         
          xmlhttp.send();
         
         }
         
         //----Update timeclock entry-----------------------------------------------------------------------------
         
         function timeclockZF_update(id)
         
         {
         
         
         
         // var workerid = document.getElementById("workerid"+id).value;
         
         var timeclockid = document.getElementById("timeclockid").value;
         
         var worker = document.getElementById("worker").value;
         
         var new_time_in = document.getElementById("time_in_date").value+" "+document.getElementById("time_in_hour").value+":"+document.getElementById("time_in_minute").value+":00";
         
          
         
         var new_time_out = document.getElementById("time_out_date").value+" "+document.getElementById("time_out_hour").value+":"+document.getElementById("time_out_minute").value+":00";
         
         
         
         var time_in_old = document.getElementById("time_in_old").value;
         
         var time_out_old = document.getElementById("time_out_old").value;
         
         
         
         var punch_type = document.getElementById("punch_type").value;
         
         var new_notes = document.getElementById("new_notes").value;
         
         //
         
         
         
         //document.getElementById("t"+id).innerHTML=xmlhttp.responseText;
         
         
         
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
         
                 alert('Updated record successfully');
         
                 window.location.reload();  
         
                // alert(xmlhttp.responseText);
         
                // document.getElementById("t"+id).innerHTML=xmlhttp.responseText;
         
                // document.getElementById("t"+id).innerHTML=xmlhttp.responseText;
         
         //document.getElementById("light").innerHTML = "<a href='javascript:void(0)' onclick=document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'>Close</a> &nbsp;<center></center><br/>"+xmlhttp.responseText;
         
            // document.getElementById('light').style.display='block';
         
         }
         
         }
         
             xmlhttp.open("GET","timeclockZF_update_report.php?uaction=update&timeclockid="+timeclockid+"&worker="+worker+"&new_time_in="+new_time_in+"&new_time_out="+new_time_out+"&time_in_old="+time_in_old+"&time_out_old="+time_out_old+"&punch_type="+punch_type+"&new_notes="+new_notes,true);
         
         xmlhttp.send();
         
         }
         
         //
         
         //Edit Production report
         
         function edit_production_timeclock(workerid, run, edit, id, startdate, enddate){
         
         var selectobject = document.getElementById(id); 
         
         var n_left = f_getPosition(selectobject, 'Left');
         
         var n_top  = f_getPosition(selectobject, 'Top');
         
         document.getElementById('light').style.left = n_left + 10 + 'px';
         
         document.getElementById('light').style.top = n_top + 10 + 'px';
         
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
         
                 
         
         document.getElementById("light").innerHTML = "<a href='javascript:void(0)' onclick=document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'>Close</a> &nbsp;<center></center><br/>"+xmlhttp.responseText;
         
             document.getElementById('light').style.display='block';
         
         }
         
         }
         
             xmlhttp.open("GET","timeclockZF_production_edit.php?edit="+edit+"&workerid="+workerid+"&id="+id+"&startdate="+startdate+"&enddate="+enddate,true);
         
          xmlhttp.send();
         
         }
         
         //
         
         //----Update production entry-----------------------------------------------------------------------------
         
         function timeclockZF_production_update(id)
         
         {
         
         
         
         // var workerid = document.getElementById("workerid"+id).value;
         
         var productionid = document.getElementById("productionid").value;
         
         
         
         var new_date = document.getElementById("new_date").value;
         
         var new_rate = document.getElementById("new_rate").value;
         
         
         
         var new_production = document.getElementById("new_production").value;
         
         
         
         var worker = document.getElementById("worker").value;
         
         var notes = document.getElementById("notes").value;
         
         
         
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
         
                 alert('Updated record successfully');
         
                 window.location.reload();  
         
         }
         
         }
         
             xmlhttp.open("GET","timeclockZF_production_update_report.php?uaction=update&productionid="+productionid+"&worker="+worker+"&new_date="+new_date+"&new_rate="+new_rate+"&new_production="+new_production+"&notes="+notes,true);
         
         xmlhttp.send();
         
         }
         
         //
         
      </script>
      <style type="text/css">
         .header_td_style
         {
         font-family:arial;
         font-size:12;
         height: 16px; 
         background:#ABC5DF;
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
         .table_margin{
         padding-right: 10px;
         }
      </style>
      <script type="text/javascript"> 
         function checkdate()
         
         {
         
         	if (document.getElementById("new_time_in").value == "") {
         
         		alert("Please enter the New Time In.");
         
         		return false;
         
         	}
         
         	
         
         	if (document.getElementById("new_time_out").value == "") {
         
         		alert("Please enter the New Time Out.");
         
         		return false;
         
         	}
         
         	
         
         	if (document.getElementById("new_time_in").value > document.getElementById("new_time_out").value) {
         
         		alert("New Time In > New Time out, please check.");
         
         		return false;
         
         	}
         
         	
         
         	document.rptSearch2.submit();
         
         }
         
         
         
         function timeclock_del(id, action , worker, type, start_date, end_date, rep_typ)
         
         {
         
         	var alert_ret = confirm("Are you sure you want to delete the record?")
         
         	
         
         	if (alert_ret) 
         
         	{
         
         		document.location = "timeclock_delete_main_new.php?id=" + id + "&action=" + action + "&worker=" + worker + "&type=" + type + "&start_date=" + start_date + "&end_date=" + end_date + "&rep_typ=" + rep_typ;
         
         	}
         
         	
         
         }
         
         
         
         function splitdata_save(frmnam, cnt)
         
         {
         
         	var flg = "n";
         
         	if (document.getElementById("min_break" + cnt).value == "") {
         
         		alert("Please enter break in minutes.");
         
         		flg = "y";
         
         		return false;
         
         	}	
         
         	if (flg == "n") {
         
         		frmnam.submit();
         
         		return true;
         
         	}
         
         }
         
         
         
         function splitdata(cnt)
         
         {
         
         	document.getElementById("splitentry" + cnt).style.display = "block";
         
         	document.getElementById("splitentry_main" + cnt).style.display = "none";
         
         }
         
         
         
         function splitdata_cancel(cnt)
         
         {
         
         	document.getElementById("splitentry" + cnt).style.display = "none";
         
         	document.getElementById("splitentry_main" + cnt).style.display = "block";
         
         }
         
         
         
      </script>
      <LINK rel='stylesheet' type='text/css' href='one_style.css' >
      <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
      <link rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>
   </head>
   <body>
      <?php include("inc/header.php"); ?>
      <div class="main_data_css">
         <div class="dashboard_heading" style="float: left;">
            <div style="float: left;">
               Individual Timeclock & Production Summary Report
               <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
                  <span class="tooltiptext">
                  This report shows the user the summary of the timeclock and production within a provided time period for a specific employee. There are 2 versions of this report, this is the manager version which can be edited.
                  </span>
               </div>
               <div style="height: 13px;">&nbsp;</div>
            </div>
         </div>
         <div id="light" class="white_content"></div>
         <div id="fade" class="black_overlay"></div>
         <br>
         <form name="rptSearch" action="" method="GET">
            <input type="hidden" name="action" value="run">
            <br /><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
            Find 
            <select name="worker">
               <option>Please Select</option>
               <option value=-1>ALL</option>
               <?php 
                  $total_production = 0; 
                  $total_production_val = 0;
                  $first_week = 1; 
                  $first_week_regular_time = 0;
                  $first_week_overtime = 0;
                  $start_date1 = "";
                  $rowEditedDtls = array();
                  $bonusProTotal = 0;
                  $tierIncresedValTotal = 0;
                  $grandTotalAll = 0;
                  $dt = "";
                  $total_orders = 0;
                  $bonus = 0;
                  
                  $sql3 = "SELECT * FROM loop_workers ORDER BY active DESC, name ASC";
                  
                  db();
                  $result3 = db_query($sql3);
                  
                  while ($myrowsel3 = array_shift($result3)) {
                  
                  ?>
               <option value="<?php echo $myrowsel3["id"]; ?>" <?php if ($myrowsel3["id"]==$_REQUEST["worker"]) echo "selected"; ?>><?php echo $myrowsel3["name"]; ?></option>
               <?php } ?>
            </select>
            of type 
            <select name="type">
               <option value="%">Any</option>
               <?php
                  $sql3 = "SELECT DISTINCT(type) FROM loop_timeclock";
                  
                  db();
                  $result3 = db_query($sql3);
                  
                  while ($myrowsel3 = array_shift($result3)) {
                  
                  ?>
               <option value="<?php echo $myrowsel3["type"]; ?>" <?php if ($myrowsel3["type"]==$_REQUEST["type"]) echo "selected"; ?> ><?php echo $myrowsel3["type"]; ?></option>
               <?php } ?>
            </select>
            <SCRIPT language="JavaScript" src="inc/CalendarPopup.js"></SCRIPT>
            <script language="JavaScript">document.write(getCalendarStyles());</script>
            <script language="JavaScript">
               var cal1xx = new CalendarPopup("listdiv");
               
               cal1xx.showNavigationDropdowns();
               
               var cal2xx = new CalendarPopup("listdiv");
               
               cal2xx.showNavigationDropdowns();
               
            </script>
            <SCRIPT LANGUAGE="JavaScript" SRC="inc/CalendarPopuptmp.js"></SCRIPT>
            <SCRIPT LANGUAGE="JavaScript" SRC="inc/general.js"></SCRIPT>
            <script LANGUAGE="JavaScript">document.write(getCalendarStyles());</script>
            <script LANGUAGE="JavaScript">
               var cal2xx = new CalendarPopupnew1("listdiv");
               
               cal2xx.showNavigationDropdowns();
               
            </script>
            <?php
               $start_date = isset($_GET["start_date"])?strtotime($_GET["start_date"]):strtotime(date('m/d/Y'));
               
               $end_date = isset($_GET["end_date"])?strtotime($_GET["end_date"]):strtotime(date('m/d/Y'));
               
               ?>
            <font face="Arial, Helvetica, sans-serif" color="#333333" size="1"> from: <input type="text" name="start_date" size="11" value="<?php echo (isset($_GET["start_date"]) && $_GET["start_date"] != "")?date('m/d/Y', $start_date):""?>"> <a href="#" onclick="cal1xx.select(document.rptSearch.start_date,'anchor1xx','MM/dd/yyyy'); return false;" name="anchor1xx" id="anchor1xx"><img border="0" src="images/calendar.jpg"></a> <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">to: <input type="text" name="end_date" size="11" value="<?php echo (isset($_GET["end_date"]) && $_GET["start_date"] != "")?date('m/d/Y', $end_date):""?>"> <a href="#" onclick="cal1xx.select(document.rptSearch.end_date,'anchor2xx','MM/dd/yyyy'); return false;" name="anchor2xx" id="anchor2xx"><img border="0" src="images/calendar.jpg"></a>
            &nbsp; <input type="submit" value="Search">
         </form>
         <div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>
         <br></span></span>
         <br><br>
         <?php
            if ($_GET["action"] == 'run') {
            
            if ($_GET["delete"] == 'true') {
            
               db();
               $res = db_query("DELETE FROM loop_timeclock_bonus WHERE id = " . $_REQUEST["id"]);
            
            }
            
            if ($_REQUEST["worker"] != -1)
            
            {
            
            $start_date = date('Y-m-d', $start_date);
            
            $end_date_bonus = date('Y-m-d', $end_date);
            
            $end_date = date('Y-m-d', $end_date + 86400);
            
            $end_date_ot = date('Y-m-d', strtotime($end_date));
            
            
            
            if ($start_date > $end_date) {
            
            	echo "<font size=20>Nice Try, David - You thought I would not catch an error where the start date comes after the end date.</font>";
            
            }
            
            
            
            $time = strtotime($start_date);
            
            $st_tuesday = strtotime('last tuesday', $time);
            
            
            
            //echo $start_date . "<BR>";
            
            //echo $time . "<BR>";
            
            //echo $st_tuesday;"<BR>";
            
            //echo date('Y-m-d 00:00:01',$time) . "<BR>";
            
            //echo date('Y-m-d 00:00:01',$st_tuesday). "<BR>";
            
            $st_monday = strtotime('+6 days', $st_tuesday);
            
            //echo date('Y-m-d 23:59:59',$st_monday);
            
            ?>
         <table cellSpacing="1" cellPadding="3" width="950" border="0">
            <tr align="middle">
               <td colSpan="13" class="style7">
                  TIMECLOCK REPORT FOR: 
                  <?php
                     $query = "SELECT * FROM `loop_workers` WHERE id = " . $_REQUEST["worker"] ;
                     
                     db();
                     $res = db_query($query);
                     
                     $row = array_shift($res);
                     
                     $name = $row["name"];
                     
                     $rate = $row["rate_cost"];
                     
                     echo "<b>".$row["name"]."</b>";
                     
                     ?>
               </td>
            </tr>
            <tr>
               <td class="style17">
                  <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
                  DATE</font>
               </td>
               <td class="style17">
                  <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
                  TIME IN</font>
               </td>
               <td class="style5" >
                  <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
                  TIME OUT
               </td>
               <td align="middle" class="style16">
                  <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
                  AMOUNT
               </td>
               <td align="middle" class="style16">
                  <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
                  TYPE
               </td>
               <td align="middle" class="style16">
                  <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
                  IP CLOCK-IN
               </td>
               <td align="middle" class="style16">
                  <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
                  IP CLOCK-OUT
               </td>
               <td align="middle" class="style16">
                  <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
                  EDIT
               </td>
               <td align="middle" class="style16">
                  <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
                  ADD BREAK
               </td>
               <td align="middle" class="style16">
                  <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
                  DELETE
               </td>
               <td align="middle" class="style16">
                  <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
                  NOTES
               </td>
            </tr>
            <?php
               $query = "SELECT *, IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)) AS A, DATE_FORMAT(time_in, '%W, %M %d, %Y') AS D, DATE_FORMAT(time_out, '%W, %M %d, %Y') AS Datetimeout, TIME(time_in) AS T_I, TIME(time_out) AS T_O FROM loop_timeclock WHERE type LIKE '%" . $_REQUEST["type"] ."' AND worker_id = " . $_REQUEST["worker"] . " ";
               
               if($_GET["start_date"] != "")
               
               {
               
                $query .= " AND time_in BETWEEN '$start_date'";
               
               }
               
               if($_GET["end_date"] != "")
               
               {
               
                $query .= " AND '$end_date'";
               
               }
               
               $query .= " order by time_in";
               
               // echo $query;
               
               $cnt = 0;
               
               db();
               $res = db_query($query);
               
               while($row = array_shift($res))
               
               {
               
               $cnt = $cnt +1;
               
               ?>
            <tr vAlign="center" id="<?php echo $row["id"]; ?>" >
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  <?php echo $row["D"]; ?>
               </td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  <?php echo $row["T_I"]; ?>
               </td>
               <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  <?php echo $row["T_O"]; ?>
               </td>
               <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right>
                  <?php 
                     $time_diff_h = 0; $time_diff_m = 0;
                     
                     if (strpos($row["A"], ":") > 0) {
                     
                     	$time_diff_h = substr($row["A"], 0, strpos($row["A"],':')); 
                     
                     	$tmpdt = substr($row["A"], strpos($row["A"],':')+1); 
                     
                     	$time_diff_m = substr($tmpdt, 0, strpos($tmpdt,':')); 
                     
                     }
                     
                     if (($time_diff_h > 8) || ($time_diff_h == 8 && $time_diff_m > 0)) { ?>
                  <font face="Arial, Helvetica, sans-serif" color="red" size="1">	
                  <?php } else { ?>
                  <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  <?php } ?>
                  <?php echo $row["A"]; ?>
               </td>
               </td>
               <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  <?php echo $row["type"];?>
               </td>
               <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  <?php echo $row["ipaddress"];?>
               </td>
               <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  <?php echo $row["ipaddress_clkout"];?>
               </td>
               <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  <a href='#' id='<?php echo $row["id"];?>' onclick="edit_timeclock('<?php echo $_REQUEST["worker"];?>', 'run', 'edit','<?php echo $row["id"];?>','<?php echo $_REQUEST["start_date"];?>','<?php echo $_REQUEST["end_date"];?>');return false;">Edit</a>
               </td>
               <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=center>
                  <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
                     <div id="splitentry_main<?php echo $cnt;?>">
                        <input style="cursor:pointer;" type="button" onclick="splitdata(<?php echo $cnt?>);" value="Add Break"/>
                     </div>
                     <div id="splitentry<?php echo $cnt;?>" style="display:none;">
                        <form method="post" action="timeclockZF_update_new.php" name="frmsplitdata" id="frmsplitdata">
                           <table>
                              <tr>
                                 <td>
                                    <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
                                    Enter Minutes: </font>
                                    <input type="text" name="min_break" id="min_break<?php echo $cnt;?>" value="30" />
                                    <input type="hidden" name="split_timein" id="split_timein" value="<?php echo date("Y-m-d" , strtotime($row["D"])) . " ". $row["T_I"]; ?>" />
                                 </td>
                              </tr>
                              <tr>
                                 <td><input type="hidden" name="split_timeout" id="split_timeout<?php echo $cnt;?>" value="<?php echo date("Y-m-d" , strtotime($row["Datetimeout"])) . " " . $row["T_O"]; ?>" /></td>
                              </tr>
                              <tr>
                                 <td align="center">
                                    <input type="hidden" name="split_timeout_btn_hd" id="split_timeout_btn_hd" value="<?php echo $row["id"]; ?>" />
                                    <input type="button" onclick="splitdata_save(this.form,<?php echo $cnt?>);" name="split_timeout_btn<?php echo $cnt;?>" id="split_timeout_btn<?php echo $cnt;?>" value="Save" />
                                    <input type="button" onclick="splitdata_cancel(<?php echo $cnt?>);" name="split_timeout_btn_cancel<?php echo $cnt;?>" id="split_timeout_btn_cancel<?php echo $cnt;?>" value="Cancel" />
                                 </td>
                              </tr>
                  </font>
                  </table>
                  </form>
                  </div>
               </td>
               <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  <a href="#" onclick="timeclock_del(<?php echo $row["id"];?>,'<?php echo $_REQUEST["action"];?>',<?php echo $_REQUEST["worker"];?>,'<?php echo $_REQUEST["type"];?>','<?php echo $_REQUEST["start_date"];?>','<?php echo $_REQUEST["end_date"];?>', 'timclk');">Delete</a>
               </td>
               <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=left><font size=1><?php if ($row["time_in_old"] != "0000-00-00 00:00:00") echo $row["time_in_old"];?> <?php  if ($row["time_out_old"] != "0000-00-00 00:00:00") echo $row["time_out_old"];?> <?php echo $row["notes"];?></font></td>
            </tr>
            <?php
               }
             
               ?>
            <!-- For total row new code -->
            <?php
               $time = strtotime($start_date);
               
               if (date('l',$time) != "Tuesday") {
               
               	$st_tuesday = strtotime('last tuesday', $time);
               
               } else {
               
               	$st_tuesday = $time;
               
               }
               
               
               
               $st = strtotime($start_date);
               
               $ed = strtotime($end_date);
               
               $st_monday = strtotime('+6 days', $st_tuesday);
               
               
               
               $overtime = 0;
               
               $regulartime = 0;
               
               while($st_tuesday < $ed)
               
               {
               
               	$query = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE  worker_id = " . $_REQUEST["worker"]  . " ";
               
               	if($_GET["start_date"] != "")
               
               	{
               
               	 $query .= " AND time_in BETWEEN '" . date('Y-m-d 00:00:00',$st_tuesday) . "'";
               
               	}
               
               	if($_GET["end_date"] != "")
               
               	{
               
               	 if ($st_monday < $ed) {
               
               	 $query .= " AND '" . date('Y-m-d 23:59:59',$st_monday) . "'";
               
               	 }
               
               	 else {
               
               		$query .= " AND '" . date('Y-m-d 23:59:59',$ed - 1) . "'";
               
               	 }
               
               	}
                  
                  db();
               	$res = db_query($query);
               
               	while($row = array_shift($res))
               
               	{
               
               
               
               		if (date('Y-m-d',$st_tuesday) < $start_date)
               
               		{
               
               			$fquery = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE  worker_id = " . $_REQUEST["worker"]  . " ";
               
               			
               
               			 $fquery .= " AND time_in BETWEEN '" . date('Y-m-d 00:00:00',$time) . "'";
               
               			
               
               				if ($st_monday < $ed) {
               
               			 $fquery .= " AND '" . date('Y-m-d 23:59:59',$st_monday) . "'";
               
               				 }
               
               			else {
               
               			$fquery .= " AND '" . date('Y-m-d 23:59:59',$ed - 1) . "'";
               
               			}
               
               
               
               			$start_date1 = $st_monday;
               
               
                        db();
               			$fres = db_query($fquery);
               
               			$frow = array_shift($fres);
               
               			
               
               
               
               			if (($row["DT"]/3600) > 40) 
               
               			{ 
               
               				$first_week_regular_time = $frow["DT"]/3600 - ($row["DT"]/3600 - 40);
               
               				if ($first_week_regular_time < 0) $first_week_regular_time = 0;
               
               				$first_week_overtime = ($row["DT"]/3600 - 40);
               
               			//	echo $first_week_overtime;
               
               				if ($first_week_overtime > $frow["DT"]/3600) $first_week_overtime = $frow["DT"]/3600;
               
               			} else
               
               			{
               
               				$first_week_regular_time = $frow["DT"]/3600;
               
               				$first_week_overtime = 0;
               
               			}
               
               
               
               			//echo date('m/d/Y',$time);
               
               		} else
               
               		{
               
               			//echo date('m/d/Y',$st_tuesday);	
               
               		}
               
               			//echo " - ";
               
               
               
               		if (date('Y-m-d',$st_monday) < $end_date)
               
               		{
               
               			//echo date('m/d/Y',$st_monday);
               
               		} else
               
               		{
               
               			//echo date('m/d/Y',$ed-1);	
               
               		}
               
               
               
               		if ($first_week == 1)
               
               		{
               
               				//echo number_format($first_week_regular_time,2);
               
               				$regulartime += $first_week_regular_time;
               
               		} else {
               
               				if (($row["DT"]/3600) > 40) { 
               
               					//echo number_format(40 ,2);
               
               					$regulartime += 40; 
               
               				} else { 
               
               					//echo number_format($row["DT"]/3600 ,2); 
               
               					$regulartime += number_format($row["DT"]/3600 ,2); 
               
               				}
               
               		}
               
               
               
               		if ($first_week == 1)
               
               		{
               
               			//echo number_format($first_week_overtime,2);
               
               			$overtime += $first_week_overtime;
               
               		} else { 
               
               			if (($row["DT"]/3600) > 40) {
               
                           $overtime += (float)number_format($row["DT"]/3600,2) - 40; 
               
               			}
               
               				
               
               		}
               
               			$first_week = 0;
               
               
               
               			$production_val = $row["R"]*$row["P"];
               
               			
               
               			$tierIncresedVal =  number_format(($production_val * $row["tier_value"]), 2);
               
               			
               
               			if($tierIncresedVal == 'Invalid Tier Value'){
               
               				$grandTotal = number_format($production_val ,2);
               
               			}else{
               
                           $grandTotal = number_format($production_val + (float)str_replace(',', '', $tierIncresedVal), 2);
               
               			}				
               
               
               			$pq     = "SELECT name, loop_workers.rate_cost AS RC, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))/3600 AS DT FROM loop_timeclock LEFT JOIN loop_workers ON loop_timeclock.worker_id = loop_workers.id WHERE (loop_timeclock.type LIKE '%Production' OR loop_timeclock.type LIKE '%kits' OR loop_timeclock.type LIKE '%achines') AND loop_timeclock.worker_id = " . $_REQUEST["worker"];
               
               			$pq .= " AND (time_in >= '" . $start_date1 . " 00:00:00' and time_in <= '" . $start_date1 . " 23:59:59') ";
               
               			
                        db();
               			$pres       = db_query($pq);
               
               			$prow       = array_shift($pres);
               
               			$totalHours = $prow["DT"];
               
               			$hourlyRate = $prow["RC"];
               
               
               
               			$hourlyValue = ($totalHours * $hourlyRate);
               
               
               
               			//echo "bonus = " . $grandTotal . " - " . $hourlyValue . "<br>";
               
                        $bonus = str_replace(',', '', $grandTotal) - str_replace(',', '', (string)$hourlyValue);
               
               	}
               
               	$st_tuesday = strtotime('+7 days', $st_tuesday);
               
               	$st_monday = strtotime('+7 days', $st_monday);
               
               
               
               }
               
               	$reg_hrs=number_format($regulartime,2);
               
               		
               
               	//echo number_format($regulartime,2);
               
               	//echo number_format($overtime,2); 
               
               ?>
            <tr vAlign="center">
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               </td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  <?php echo $total_orders; ?>
               </td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  Total Hours
               </td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  <?php echo number_format($regulartime+$overtime,2); ?>  
               </td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               </td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               </td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               </td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               </td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               </td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               </td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               </td>
            </tr>
         </table>
         <br/>
         <!-- For total row new code -->
         <table cellSpacing="1" cellPadding="3" width="950" border="0">
            <tr align="middle">
               <td colSpan="12" class="style7">
                  PRODUCTION REPORT FOR: 
                  <?php
                     $query = "SELECT * FROM `loop_workers` WHERE id = " . $_REQUEST["worker"] ;
                     
                     db();
                     $res = db_query($query);
                     
                     $row = array_shift($res);
                     
                     $name = $row["name"];
                     
                     echo "<b>".$row["name"]."</b>";
                     
                     ?>
               </td>
            </tr>
            <tr>
               <td class="style17">
                  <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
                  PRODUCTION DATE</font>
               </td>
               <td class="style17">
                  <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
                  ENTERED ON</font>
               </td>
               <td class="style17">
                  <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
                  RATE</font>
               </td>
               <td class="style5" >
                  <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
                  PRODUCTION
               </td>
               <td align="middle" class="style5">
                  <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
                  SUBTOTAL
               </td>
               <td align="middle" class="style5">
                  <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
                  TIER INCREASE
               </td>
               <td align="middle" class="style5">
                  <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
                  GRAND TOTAL
               </td>
               <td align="middle" class="style5">
                  <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">		
                  TIER
               </td>
               <td align="middle" class="style5">
                  <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">EDIT
               </td>
               <td align="middle" class="style5">
                  <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">DELETE
               </td>
               <td align="middle" class="style5">
                  <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">NOTES
               </td>
            </tr>
            <?php
               $query = "SELECT *, DATE_FORMAT(date, '%W, %M %d, %Y') AS D, rate AS R, production AS P, added_by AS addedEmp, added_on AS recordDate FROM loop_timeclock_production WHERE worker_id = " . $_REQUEST["worker"] . " ";
               
               if($_GET["start_date"] != "")
               
               {
               
                $query .= " AND date BETWEEN '$start_date'";
               
               }
               
               if($_GET["end_date"] != "")
               
               {
               
                $query .= " AND '$end_date' ORDER BY date ASC";
               
               }
      
               db();
               $res = db_query($query);
               
               $production_total=0;
               
               while($row = array_shift($res))
               
               {
               
               	$wq="select emp_tier from loop_workers where id='".$_REQUEST["worker"]."'";
                  
                  db();
               	$wres=db_query($wq);
               
               	$wrow=array_shift($wres);
               
               	$emp_tier=$wrow["emp_tier"];
               
               	
               	$et_query="select * from loop_worker_tier where id='". $row["tier_id"] ."'";
                  
                  db();
               	$etres = db_query($et_query);
               
               	$et_row = array_shift($etres);
               
               	$tier_name = $et_row["tier"];
               
               	
               
               	$et_query="select * from loop_worker_tier where tier='".$emp_tier."'";
                  
                  db();
               	$etres=db_query($et_query);
               
               	$et_row=array_shift($etres);
               
               	$emp_tier_value=$et_row["tier_value"];
               
               	//
               
               	//$new_rate= $row["R"]*$emp_tier_value;
               
               	$production_val = $row["R"]*$row["P"];
               
               	//
               
               //
               
               ?>
            <tr vAlign="center">
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  <?php echo $row["D"]; ?>
               </td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  <?php 
                     if($row['recordDate'] != ''){
                     
                     	echo date("m/d/Y H:i:s", strtotime($row['recordDate'])).' ('.$row['addedEmp'].')';
                     
                     }
                     
                     ?>
               </td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  $<?php echo number_format($row["R"],2); ?>
               </td>
               <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  <?php echo $row["P"]; ?>
               </td>
               <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  $<?php echo number_format($production_val,2);?>
               </td>
               <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
                  <?php                 
                     $tierIncresedVal =  number_format(($production_val * $emp_tier_value), 2);
                     
                     echo "$".$tierIncresedVal;
                     
                     ?>
               </td>
               <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
                  <?php
                     if($tierIncresedVal == 'Invalid Tier Value'){
                     
                         $grandTotal = number_format($production_val ,2);
                     
                     }else{
                     
                        $et_row = $etres[0];
                        $emp_tier_value = $et_row["tier_value"];
                        $grandTotal = number_format($production_val + str_replace(',', '', ($production_val * $emp_tier_value)), 2);
                     
                     }				
                     
                     echo "$". $grandTotal;
                     
                     ?>
               </td>
               <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=left><font size=1><?php echo $tier_name;?></font></td>
               <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=center>
                  <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  <?php
                       if(isset($rowEditedDtls['edited_on'])){
                           echo "Edited on ".date("m/d/Y H:i:s", strtotime($rowEditedDtls['edited_on'])).' ('.$rowEditedDtls['edited_by'].')<br />';
                     
                        }
                     
                     ?>
                  <a href='#' id='<?php echo $row["id"];?>' onclick="edit_production_timeclock('<?php echo $_REQUEST["worker"];?>', 'run', 'edit','<?php echo $row["id"];?>','<?php echo $_REQUEST["start_date"];?>','<?php echo $_REQUEST["end_date"];?>'); return false;">Edit</a>       
               </td>
               <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  <a href="#" onclick="timeclock_del(<?php echo $row["id"];?>,'<?php echo $_REQUEST["action"];?>',<?php echo $_REQUEST["worker"];?>,'<?php echo $_REQUEST["type"];?>','<?php echo $_REQUEST["start_date"];?>','<?php echo $_REQUEST["end_date"];?>', 'prodrep');">Delete</a>
               </td>
               <td bgColor="#e4e4e4" style="height: 22px;" class="style3" align=left><font size=1><?php echo $row["notes"];?></font></td>
            </tr>
            <?php
               $production_total += str_replace(',', '', number_format($production_val,2));
               
               $bonusProTotal += $row["R"] * $row["P"];
               
                 if($tierIncresedVal != 'Invalid Tier Value'){
               
                     $tierIncresedValTotal += str_replace(',', '', $tierIncresedVal);
               
                 }
               
                 $grandTotalAll += str_replace(',', '', $grandTotal);
               
               }
               
               
               
               ?>
            <tr vAlign="center">
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               </td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               </td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               </td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  Total Production Value
               </td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  <?php echo "$".number_format($production_total,2); ?> 
               </td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  <?php echo "$".number_format($tierIncresedValTotal,2); ?>
               </td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
                  <?php echo "$".number_format($grandTotalAll,2); ?>	
               </td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               </td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               </td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               </td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
               </td>
            </tr>
         </table>
         <br><br>
         <table width="28%" cellpadding="4">
            <tr align="middle">
               <td colSpan="5" class="style7"><b>Hours by Type Report for: <?php echo $name;?></b></td>
            </tr>
            <tr vAlign="center">
               <td class="style17" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">Type</font></td>
               <td class="style17" style="height: 22px;" align="center" colspan="3"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  Total Hours
               </td>
            </tr>
            <?php
               $tq = "SELECT DISTINCT(type) FROM loop_timeclock WHERE time_in BETWEEN '$start_date' AND '$end_date'";
               
               
               db();
               $tres = db_query($tq);
               
               while($trow = array_shift($tres))
               
               {
               
               
               
               $query = "SELECT type, SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE type LIKE '%" . $trow["type"] ."' AND worker_id = " . $_REQUEST["worker"]  . " ";
               
               if($_GET["start_date"] != "")
               
               {
               
                $query .= " AND time_in BETWEEN '$start_date'";
               
               }
               
               if($_GET["end_date"] != "")
               
               {
               
                $query .= " AND '$end_date'";
               
               }
               
               db();
               $res = db_query($query);
               
               
               
               while($row = array_shift($res))
               
               {
               
                     if($trow["type"]==$row["type"])
               
                     {
               
                         
               
               ?>
            <tr vAlign="center">
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  <?php echo $trow["type"];?>
               </td>
               <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  Total Hours
               </td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  <?php echo $row["ADT"]; ?> 
               </td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  <?php echo number_format($row["DT"]/3600,2); ?>  
               </td>
            </tr>
            <?php 
               }
               
               }
               
               
               
               }
               
               ?>
         </table>
         <!------------- OVERTIME -------------------->
         <?php
            $time = strtotime($start_date);
            
            if (date('l',$time) != "Tuesday") {
            
            $st_tuesday = strtotime('last tuesday', $time);
            
            } else {
            
            $st_tuesday = $time;
            
            }
            
            //echo $start_date . "<BR>";
            
            $st = strtotime($start_date);
            
            $ed = strtotime($end_date);
            
            //echo $time . "<BR>";
            
            //echo $st_tuesday;"<BR>";
            
            //echo date('Y-m-d 00:00:01',$time) . "<BR>";
            
            //echo date('Y-m-d 00:00:01',$st_tuesday). "<BR>";
            
            $st_monday = strtotime('+6 days', $st_tuesday);
            
            //echo date('Y-m-d 23:59:59',$st_monday);
            
            
            
            //echo "time: " . $time . "<br>";
            
            //echo "start_date: " . $start_date . "<br>";
            
            //echo "st_sunday: " . $st_tuesday . "<br>";
            
            //echo "st: " . $st . "<br>";
            
            //echo "ed: " . $ed . "<br>";
            
            //echo "end_date: " . $end_date . "<br>";
            
            
            
            ?>
         <br><br>
         <table width="28%" cellpadding="4">
            <tr align="middle">
               <td colSpan="4" class="style7"><strong>Breakdown by Work Week Tues-Mon</strong><br><b><?php echo $name;?></b></td>
            </tr>
            <tr vAlign="center">
               <td bgColor="#99FF99" class="style3" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  Date Range
               </td>
               <td bgColor="#99FF99" class="style3" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  Regular Hours
               </td>
               <td bgColor="#99FF99" class="style3" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  Overtime Hours 
               </td>
               <td bgColor="#99FF99" class="style3" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  Bonus
               </td>
            </tr>
            <?php
               $overtime = 0;
               
               $regulartime = 0;
               
               while($st_tuesday < $ed)
               
               {
               
               $query = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE  worker_id = " . $_REQUEST["worker"]  . " ";
               
               if($_GET["start_date"] != "")
               
               {
               
                $query .= " AND time_in BETWEEN '" . date('Y-m-d 00:00:00',$st_tuesday) . "'";
               
               }
               
               if($_GET["end_date"] != "")
               
               {
               
                if ($st_monday < $ed) {
               
                $query .= " AND '" . date('Y-m-d 23:59:59',$st_monday) . "'";
               
                }
               
                else {
               
                $query .= " AND '" . date('Y-m-d 23:59:59',$ed - 1) . "'";
               
                }
               
               }
               
               db();
               $res = db_query($query);
               
               //echo $query . "<br><br>";
               
               while($row = array_shift($res))
               
               {
               
               ?>
            <tr vAlign="center">
               <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  <?php
                     
                     if (date('Y-m-d',$st_tuesday) < $start_date)
                     
                     {
                     
                     //This is the first one. We also need to get the time from the start date to the end of the week
                     
                     $fquery = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock  WHERE  worker_id = " . $_REQUEST["worker"]  . " ";
                     
                     
                     
                     $fquery .= " AND time_in BETWEEN '" . date('Y-m-d 00:00:00',$time) . "'";
                     
                     
                     
                     	if ($st_monday < $ed) {
                     
                     $fquery .= " AND '" . date('Y-m-d 23:59:59',$st_monday) . "'";
                     
                      }
                     
                     else {
                     
                     $fquery .= " AND '" . date('Y-m-d 23:59:59',$ed - 1) . "'";
                     
                     }
                     
                     
                     
                     $start_date1 = $st_monday;
                     
                     
                     db();
                     $fres = db_query($fquery);
                     
                     //echo $fquery . "<br><br>";
                     
                     $frow = array_shift($fres);
                     
                     
                     
                     $first_week = 1;
                     
                     
                     
                     if (($row["DT"]/3600) > 40) 
                     
                     { 
                     
                     $first_week_regular_time = $frow["DT"]/3600 - ($row["DT"]/3600 - 40);
                     
                     if ($first_week_regular_time < 0) $first_week_regular_time = 0;
                     
                     $first_week_overtime = ($row["DT"]/3600 - 40);
                     
                     //	echo $first_week_overtime;
                     
                     if ($first_week_overtime > $frow["DT"]/3600) $first_week_overtime = $frow["DT"]/3600;
                     
                     //	echo $first_week_overtime;
                     
                     //This is if there are more overtime hours for the entire week than hours in the pay pay period for the week.
                     
                     //	if ($first_week_overtime > ($row["DT"]/3600 - 40)) $first_week_overtime = ($row["DT"]/3600 - 40);
                     
                     //	echo $first_week_overtime;
                     
                     //	echo "-" . $first_week;
                     
                     } else
                     
                     {
                     
                     $first_week_regular_time = $frow["DT"]/3600;
                     
                     $first_week_overtime = 0;
                     
                     }
                     
                     
                     
                     echo date('m/d/Y',$time);
                     
                     } else
                     
                     {
                     
                     echo date('m/d/Y',$st_tuesday);	
                     
                     }
                     
                     echo " - ";
                     
                     
                     
                     if (date('Y-m-d',$st_monday) < $end_date)
                     
                     {
                     
                     echo date('m/d/Y',$st_monday);
                     
                     } else
                     
                     {
                     
                     echo date('m/d/Y',$ed-1);	
                     
                     }
                     
                     ?>
               </td>
               <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;"  align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  <?php
                     if ($first_week == 1)
                     
                     {
                     
                     	echo number_format($first_week_regular_time,2);
                     
                     	$regulartime += $first_week_regular_time;
                     
                     } else {
                     
                     	if (($row["DT"]/3600) > 40) { echo number_format(40 ,2); $regulartime += 40; } else { echo number_format($row["DT"]/3600 ,2); $regulartime += number_format($row["DT"]/3600 ,2); }
                     
                     }
                     
                     ?>  
               </td>
               <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  <?php
                     if ($first_week == 1)
                     
                     {
                     
                     	echo number_format($first_week_overtime,2);
                     
                     	$overtime += $first_week_overtime;
                     
                     } else { 
                     
                     if (($row["DT"]/3600) > 40) { echo number_format((float)($row["DT"]/3600)-40 ,2); $overtime += (float)number_format($row["DT"]/3600,2) - 40; }
                     
                     		
                     
                     }
                     
                     $first_week = 0;
                     
                     ?> 
               </td>
               <!-- BONUS CALCULATION START -->
               <?php    
                  $production_val = $row["R"]*$row["P"];
                  
                  
                  
                  $tierIncresedVal =  number_format(($production_val * $row["tier_value"]), 2);
                  
                  
                  
                  if($tierIncresedVal == 'Invalid Tier Value'){
                  
                  	$grandTotal = number_format($production_val ,2);
                  
                  }else{
                  
                  $grandTotal = number_format($production_val + floatval(str_replace(',', '', $tierIncresedVal)), 2);
                  
                  }				
                  
                  
                  
                  $pq     = "SELECT name, loop_workers.rate_cost AS RC, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))/3600 AS DT FROM loop_timeclock LEFT JOIN loop_workers ON loop_timeclock.worker_id = loop_workers.id WHERE (loop_timeclock.type LIKE '%Production' OR loop_timeclock.type LIKE '%kits' OR loop_timeclock.type LIKE '%achines') AND loop_timeclock.worker_id = " . $_REQUEST["worker"];
                  
                  $pq .= " AND (time_in >= '" . $start_date1 . " 00:00:00' and time_in <= '" . $start_date1 . " 23:59:59') ";
                  
                  
                  db();
                  $pres       = db_query($pq);
                  
                  $prow       = array_shift($pres);
                  
                  $totalHours = $prow["DT"];
                  
                  $hourlyRate = $prow["RC"];
                  
                  
                  
                  $hourlyValue = ($totalHours * $hourlyRate);
                  
                  
                  
                  //echo "bonus = " . $grandTotal . " - " . $hourlyValue . "<br>";
                  
                  $total_orders = floatval(str_replace(',', '', $grandTotal)) - floatval(str_replace(',', '', strval($hourlyValue)));
                  
                  ?>
               <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align="right"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  <?php if ($bonus != 0) {echo "$".number_format($bonus,2); } ?>
               </td>
            </tr>
            <?php 
               }
               
               $st_tuesday = strtotime('+7 days', $st_tuesday);
               
               $st_monday = strtotime('+7 days', $st_monday);
               
               }
               
               $reg_hrs=number_format($regulartime,2);
               
               ?>
            <tr vAlign="center">
               <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;"  align="right"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  TOTAL
               </td>
               <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  <?php echo number_format($regulartime,2); ?>  
               </td>
               <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;"  align="right"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  <?php echo number_format($overtime,2); ?>  
               </td>
               <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;"  align="right"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  <?php 
                     $pq = "SELECT name, loop_workers.rate_cost AS RC, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))/3600 AS DT FROM loop_timeclock LEFT JOIN loop_workers ON loop_timeclock.worker_id = loop_workers.id WHERE (loop_timeclock.type LIKE '%Production' OR loop_timeclock.type LIKE '%kits' OR loop_timeclock.type LIKE '%achines') AND loop_timeclock.worker_id = " . $_REQUEST["worker"];
                     
                     if($_GET["start_date"] != "qqq")
                     
                     {
                     
                     $pq .= " AND time_in BETWEEN '" . $start_date . "'";
                     
                     }
                     
                     if($_GET["end_date"] != "qqqq")
                     
                     {
                     
                     $pq .= " AND '" . $end_date . "'";
                     
                     }
                     
                     db();
                     $pres = db_query($pq);
                     
                     $prow = array_shift($pres);
                     
                     $name = $prow["name"];
                     
                     $hours = $prow["DT"];
                     
                     $query = "SELECT SUM( rate * production) AS P FROM loop_timeclock_production WHERE worker_id =  " . $_REQUEST["worker"];
                     
                     if($_GET["start_date"] != "q")
                     
                     {
                     
                     $query .= " AND date BETWEEN '" . $dt . "'";
                     
                     }
                     
                     if($_GET["end_date"] != "q")
                     
                     {
                     
                     $query .= " AND NOW()";
                     
                     }
                     
                     db();
                     $pres = db_query($query);
                     
                     $prow2 = array_shift($pres);
                     
                     
                     
                     	if (($prow["DT"] * $prow["RC"]) > 0 )
                     
                     	{
                     
                                        $efficiency = 100*$prow2["P"]/($prow["DT"] * $prow["RC"]); 
                     
                     	}
                     
                     	else{	$efficiency = 0; }
                     
                     
                     
                        $bonus = floatval(str_replace(',', '', $grandTotalAll)) - floatval(str_replace(',', '', number_format((floatval(str_replace(',', '', number_format($prow["DT"], 2))) * $prow["RC"]), 2)));
                     
                     
                     
                     	if ($bonus < 0){
                     
                     		echo "$0.00";
                     
                     	}else{
                     
                     		echo "$" . number_format($bonus,2);
                     
                     	}			
                     
                     	 
                     
                     	//$bonus=$production_total - ($prow["DT"] * $prow["RC"]);
                     
                     	
                     
                     	
                     
                     		
                     
                     ?>  
               </td>
            </tr>
         </table>
         <br><br>
         <?php
            $query = "SELECT * FROM loop_timeclock_bonus WHERE worker_id =  " . $_REQUEST["worker"] . " AND date BETWEEN '" . $start_date . "' AND '" . $end_date_bonus  . "'";
            
            db();
            $res = db_query($query);
            
            $other_bonus = 0;
            
            if(tep_db_num_rows($res)>0)
            
            {
            
            
            
            ?>
         <table width=28% cellpadding="4">
            <tr align="middle">
               <td colSpan="4" class="style7"><b>Other Bonus Report</b></td>
            </tr>
            <tr vAlign="center">
               <td bgColor="#99FF99" class="style3" style="height: 22px;" align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  Date
               </td>
               <td bgColor="#99FF99" class="style3" style="height: 22px;" align=center><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  Amount
               </td>
               <td bgColor="#99FF99" class="style3" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  Notes
               </td>
               <td bgColor="#99FF99" class="style3" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  Delete
               </td>
            </tr>
            <?php
               while ($brow = array_shift($res))
               
               {
               
               	$other_bonus = $other_bonus + $brow["amount"];
               
               ?>
            <tr vAlign="center">
               <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  <?php echo timestamp_to_date($brow["date"])?>
               </td>
               <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align=right><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  $<?php echo number_format($brow["amount"],2)?>
               </td>
               <td bgColor="#e4e4e4" class="style3 table_margin" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  <?php echo $brow["notes"]?>
               </td>
               <td bgColor="#e4e4e4" class="style3" style="height: 22px;" align="center"><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">	
                  <a href="report_timeclockZF.php?worker=<?php echo $_REQUEST["worker"]?>&action=run&delete=true&id=<?php echo $brow["id"]?>&start_date=<?php echo $_REQUEST["start_date"]?>&end_date=<?php echo $_REQUEST["end_date"]?>">Delete</a>
               </td>
            </tr>
            <?php } ?>
         </table>
         <?php
            }// $query;
            
            
            
            if ($bonus >= 0){
            
            	$final_total_bonus = $other_bonus + $bonus;
            
            }else{
            
            	$final_total_bonus = $other_bonus;
            
            }	
            
            
            
            ?>
         <h3>Total Bonus: <?php
            
            if ($final_total_bonus > 0){   
            
            	echo "$" . number_format($final_total_bonus,2);
            
            }else{
            
            	echo "$0.00";
            
            }		
            
            ?></h3>
         <?php
            } // end if != -1 (single person
            
            
            
            
            
            else {
            
            	//To display the details when ALL option is selected
            
            	$start_date = date('Y-m-d', $start_date);
            
            	$end_date = date('Y-m-d', $end_date + 86400);
            
            
            
            	if ($start_date > $end_date) {
            
            	echo "<font size=20>Nice Try, David - You thought I would not catch an error where the start date comes after the end date.</font>";
            
            	}
            
            
            
            	?>
         <table border="0" cellspacing="1" cellpadding="2" >
            <tr>
               <td class="header_td_style">Warehouse name</td>
               <?php
                  $type_q = "SELECT DISTINCT(type) as typenm FROM loop_timeclock where type!='' order by type";
                  
                  db();
                  $type_res = db_query($type_q);
                  
                  while($type_row = array_shift($type_res))
                  
                  {
                  
                  	?> 
               <td class="header_td_style"><?php echo $type_row["typenm"]; ?></td>
               <?php  }	?>
            </tr>
            <?php
               if($start_date !="" && $end_date!="")
               
               {
               
               	//$type = "";	
               
               
               
               	$tq1 = "SELECT warehouse_id,warehouse_name FROM loop_timeclock inner join loop_warehouse on loop_timeclock.warehouse_id=loop_warehouse.id group by warehouse_id";
               
                  db();
               	$tres1 = db_query($tq1);
               
               	while($trow1 = array_shift($tres1))
               
               	{
               
               ?>
            <tr vAlign="center">
               <td bgcolor="#E4EAEB" class="style3" style="height: 22px;">
                  <?php echo $trow1['warehouse_name'];?>
               </td>
               <?php
                  $type_q = "SELECT DISTINCT(type) as typenm FROM loop_timeclock where type!='' order by type";
                  
                  db();
                  $type_res = db_query($type_q);
                  
                  while($type_row = array_shift($type_res))
                  
                  {
                  
                  	$type_str = "'".$type_row['typenm']."'";
                  
                  
                  
                  	$query = "SELECT warehouse_id, type, SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock WHERE type = " . $type_str . " AND warehouse_id = ".$trow1['warehouse_id']."";
                  
                  	if($_GET["start_date"] != "")
                  
                  	{
                  
                  	 $query .= " AND time_in BETWEEN '$start_date'";
                  
                  	}
                  
                  	if($_GET["end_date"] != "")
                  
                  	{
                  
                  	 $query .= " AND '$end_date' group by type";
                  
                  	}
                  
                     db();
                  	$res = db_query($query);
                  
                  	$rec_found = "no";
                  
                  	while($row = array_shift($res))
                  
                  	{
                  
                  		$rec_found = "yes";
                  
                  ?>
               <td bgcolor="#E4EAEB" class="style3 table_margin" style="height: 22px;" align=right>
                  <?php echo $row["ADT"]; ?> 
               </td>
               <?php } 
                  if ($rec_found == "no") { ?>
               <td bgcolor="#E4EAEB" class="style3" style="height: 22px;" align=right>&nbsp;</td>
               <?php	}  ?>
               <?php
                  } ?>
            </tr>
            <?php } ?>
            <tr>
               <td  bgcolor="#E4EAEB" style="font-size:8pt; font-weight:bold; height: 22px;">Total</td>
               <?php	
                  $type_q = "SELECT DISTINCT(type) as typenm FROM loop_timeclock where type!='' order by type";
                  
                  db();
                  $type_res = db_query($type_q);
                  
                  while($type_row = array_shift($type_res))
                  
                  {
                  
                  	$type_str = "'".$type_row['typenm']."'";
                  
                  
                  
                  	$query = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in))))) AS ADT, SUM(TIME_TO_SEC(IF(time_out = '0000-00-00 00:00:00', '00:00:00', TIMEDIFF(time_out,time_in)))) AS DT FROM loop_timeclock WHERE type = " . $type_str ;
                  
                  	if($_GET["start_date"] != "")
                  
                  	{
                  
                  	 $query .= " AND time_in BETWEEN '$start_date'";
                  
                  	}
                  
                  	if($_GET["end_date"] != "")
                  
                  	{
                  
                  	 $query .= " AND '$end_date' group by type";
                  
                  	}
                  
                     db();
                  	$res = db_query($query);
                  
                  	while($row = array_shift($res))
                  
                  	{
                  
                  ?>
               <td bgcolor="#E4EAEB" style="font-size:8pt; font-weight:bold; height: 22px;" align=right>
                  <?php echo $row["ADT"]; ?>
               </td>
               <?php } 
                  }	?>
            </tr>
            <?php }?>
         </table>
         <?php
            }
            
            ?>
         <?php
           
            } // end if "run"
            
            ?>
         <br><br>
         <?php
            if ($_REQUEST["edit"]=="true" && $_REQUEST["id"] != "")
            
            {
            
            $query = "SELECT * FROM loop_timeclock WHERE id = ".$_REQUEST["id"];

            db();
            $res = db_query($query);
            
            while($row = array_shift($res))
            
            {
            
            ?>
         <form name="rptSearch2" action="report_timeclockZF.php" method="GET">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="edit" value="true">
            <input type="hidden" name="timeclockid" value="<?php echo $_REQUEST["id"]?>">
            <input type="hidden" name="time_in_old" value="<?php echo $row["time_in"]?>">
            <input type="hidden" name="time_out_old" value="<?php echo $row["time_out"]?>">
            <table>
               <tr align="middle">
                  <td colSpan="10" class="style7">
                     UPDATE TIMESHEET 
                  </td>
               </tr>
               <tr>
                  <td bgColor="#e4e4e4">Employee</td>
                  <td bgColor="#e4e4e4">Time In</td>
                  <td bgColor="#e4e4e4">Time Out</td>
                  <td bgColor="#e4e4e4">New Time In</td>
                  <td bgColor="#e4e4e4">New Time Out</td>
                  <td bgColor="#e4e4e4">Type</td>
                  <td bgColor="#e4e4e4">Notes</td>
               </tr>
               <tr>
                  <td bgColor="#e4e4e4">
                     <select name="worker">
                        <option>Please Select</option>
                        <?php 
                           $sql3 = "SELECT * FROM loop_workers";
                           
                           db();
                           $result3 = db_query($sql3);
                           
                           while ($myrowsel3 = array_shift($result3)) {
                           
                           ?>
                        <option value="<?php echo $myrowsel3["id"]; ?>" <?php if ($myrowsel3["id"]==$_REQUEST["worker"]) echo "selected"; ?>><?php echo $myrowsel3["name"]; ?></option>
                        <?php } ?>
                     </select>
                  </td>
                  <td bgColor="#e4e4e4"><?php echo $row["time_in"];?></td>
                  <td bgColor="#e4e4e4"><?php echo $row["time_out"];?></td>
                  <td bgColor="#e4e4e4"><input name="new_time_in" id="new_time_in" value="<?php echo $row["time_in"];?>"></td>
                  <td bgColor="#e4e4e4"><input name="new_time_out" id="new_time_out" value="<?php echo $row["time_out"];?>"></td>
                  <td bgColor="#e4e4e4">
                     <select id="punch_type" name="punch_type">
                        <option <?php if (strtoupper($row["type"]) == strtoupper('Utility')) echo " selected ";?> value="Utility">Utility</option>
                        <option <?php if (strtoupper($row["type"]) == strtoupper('Training')) echo " selected ";?> value="Training">Training</option>
                        <option <?php if (strtoupper($row["type"]) == strtoupper('Production')) echo " selected ";?> value="Production">Box Sorting</option>
                        <option <?php if (strtoupper($row["type"]) == strtoupper('Forklift')) echo " selected ";?> value="Forklift">Forklift Operator</option>
                        <option <?php if (strtoupper($row["type"]) == strtoupper('kits')) echo " selected ";?> value="kits">Kits</option>
                        <option <?php if (strtoupper($row["type"]) == strtoupper('Machines')) echo " selected ";?> value="Machines">Machines</option>
                        <option <?php if (strtoupper($row["type"]) == strtoupper('Office')) echo " selected ";?> value="Office">Office</option>
                        <option <?php if (strtoupper($row["type"]) == strtoupper('PTO')) echo " selected ";?> value="PTO">PTO</option>
                        <option <?php if (strtoupper($row["type"]) == strtoupper('Holiday')) echo " selected ";?> value="Holiday">Holiday</option>
                        <option <?php if (strtoupper($row["type"]) == strtoupper('McC_Baling')) echo " selected ";?> value="McC_Baling">McC_Baling</option>
                     </select>
                  </td>
                  <td bgColor="#e4e4e4"><input size=25 name=notes value="<?php echo $row["notes"];?>"></td>
               </tr>
               <tr>
                  <td bgColor="#e4e4e4" colspan=10 align=center>
                     <input type="button" value="Update" onclick="checkdate()">
                  </td>
               </tr>
            </table>
         </form>
         <?php
            }
            
            }
            
            
            
            if ($_REQUEST["editproduction"]=="true" && $_REQUEST["id"] != "")
            
            {
            
            $query = "SELECT * FROM loop_timeclock_production WHERE id = ".$_REQUEST["id"];
            
            db();
            $res = db_query($query);
            
            while($row = array_shift($res))
            
            {
            
            ?>
         <form name="rptSearch2" action="report_timeclockZF.php" method="GET">
            <input type="hidden" name="action" value="updateproduction">
            <input type="hidden" name="editproduction" value="true">
            <input type="hidden" name="productionid" value="<?php echo $_REQUEST["id"]?>">
            <table>
               <tr align="middle">
                  <td colSpan="10" class="style7">
                     UPDATE PRODUCTION SHEET 
                  </td>
               </tr>
               <tr>
                  <td bgColor="#e4e4e4">Employee</td>
                  <td bgColor="#e4e4e4">Date</td>
                  <td bgColor="#e4e4e4">Rate</td>
                  <td bgColor="#e4e4e4">Production</td>
                  <td bgColor="#e4e4e4">Notes</td>
               </tr>
               <tr>
                  <td bgColor="#e4e4e4">
                     <select name="worker">
                        <option>Please Select</option>
                        <?php
                           $sql3 = "SELECT * FROM loop_workers";
                           
                           db();
                           $result3 = db_query($sql3);
                           
                           while ($myrowsel3 = array_shift($result3)) {
                           
                           ?>
                        <option value="<?php echo $myrowsel3["id"]; ?>" <?php if ($myrowsel3["id"]==$_REQUEST["worker"]) echo "selected"; ?>><?php echo $myrowsel3["name"]; ?></option>
                        <?php } ?>
                        <?php $d = explode(' ',$row["date"]);?>
                     </select>
                  </td>
                  <td bgColor="#e4e4e4"><input name=new_date value="<?php echo $d[0];?>"></td>
                  <td bgColor="#e4e4e4"><input name="new_rate" value="<?php echo $row["rate"];?>"></td>
                  <td bgColor="#e4e4e4"><input name="new_production" value="<?php echo $row["production"];?>"></td>
                  <td bgColor="#e4e4e4"><input size=25 name=notes value="<?php echo $row["notes"];?>"></td>
               </tr>
               <tr>
                  <td bgColor="#e4e4e4" colspan=10 align=center>
                     <input type=submit value="Update">
                  </td>
               </tr>
            </table>
         </form>
         <?php
            }
            
            }
            
            
            
            if ($_REQUEST["action"]=="updateproduction")
            
            {
            
            $sql3 = "UPDATE loop_timeclock_production SET date = '" . $_REQUEST["new_date"] . " 00:00:01', rate = '" . $_REQUEST["new_rate"] . "', production = '" . $_REQUEST["new_production"] . "', worker_id = '" . $_REQUEST["worker"] . "', notes = '" . $_REQUEST["notes"] . "' WHERE id = " . $_REQUEST["productionid"];
            
            db();
            $result3 = db_query($sql3);
            
            $myrowsel3 = array_shift($result3);
            
            
            
            		$message_123 = "The following change was made to the production: ";
            
            		$message_123 .= "<br><br>Worker ID: " . $_REQUEST["worker"] . "\n\n";
            
            		$message_123 .= "<br><br>Transaction ID: " . $_REQUEST["productionid"] . "\n\n";
            
            		$message_123 .= "<br><br>New Date: " . $_REQUEST["new_date"] . "\n\n";
            
            		$message_123 .= "<br><br>New Rate: " . $_REQUEST["new_rate"] . "\n\n";
            
            		$message_123 .= "<br><br>New Production: " . $_REQUEST["new_production"] . "\n\n";
            
            		$message_123 .= "<br><br>Notes: " . $_REQUEST["notes"] . "\n\n";
            
            		$message_123 .= "<br><br><a href=\"https://b2c.usedcardboardboxes.com/report_timeclockZF.php?action=run&worker=" . $_REQUEST["worker"] . "&start_date=&end_date=\">Check </a>\n";
            
            		$headers_123  = "MIME-Version: 1.0\r\n"; 
            
            		$headers_123 .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
            
            		$headers_123 .= "From: UCB Website <no-reply@usedcardboardboxes.com>\r\n"; 
            
            		$to_123 = "davidkrasnow@usedcardboardboxes.com";
            
            
            
            		echo $message_123;
            
            		
            
            		$resp = sendemail_php_function(null, '', $to_123, "", "", "ucbemail@usedcardboardboxes.com", "Operations Usedcardboardboxes", "Operations@UsedCardboardBoxes.com", 'TIME CLOCK EDIT', $message_123); 
            
            
            
            /*SET EDITED DETAILS START*/
            
            
            
            $sql3 = "INSERT INTO loop_timeclock_production_edited_by SET timeclock_production_id = '".$_REQUEST["productionid"]."', edited_by = '".$_COOKIE['userinitials']."', edited_on = '".date('Y-m-d H:i:s')."' ";
            
            db();
            $result3 = db_query($sql3);
            
            /*SET EDITED DETAILS END*/
            
            }
            
            if ($_REQUEST["action"]=="update")
            
            {
            
            $sql3 = "UPDATE loop_timeclock SET type = '" . $_REQUEST["punch_type"] . "', time_in = '" . $_REQUEST["new_time_in"] . "', time_out = '" . $_REQUEST["new_time_out"] . "', time_in_old = '" . $_REQUEST["time_in_old"] . "', time_out_old = '" . $_REQUEST["time_out_old"] . "', worker_id = '" . $_REQUEST["worker"] . "', notes = '" . $_REQUEST["notes"] . "' WHERE id = " . $_REQUEST["timeclockid"];
            
            db();
            $result3 = db_query($sql3);
            
            $myrowsel3 = array_shift($result3);
            
            $message_123 = "The following change was made to the timeclock: ";
      
            $message_123 .= "<br><br>Worker ID: " . $_REQUEST["worker"] . "\n\n";
      
            $message_123 .= "<br><br>Transaction ID: " . $_REQUEST["timeclockid"] . "\n\n";
      
            $message_123 .= "<br><br>Old Time In: " . $_REQUEST["time_in_old"] . "\n\n";
      
            $message_123 .= "<br><br>New Time In: " . $_REQUEST["new_time_in"] . "\n\n";
      
            $message_123 .= "<br><br>Old Time Out: " . $_REQUEST["time_out_old"] . "\n\n";
      
            $message_123 .= "<br><br>New Time Out: " . $_REQUEST["new_time_out"] . "\n\n";
      
            $message_123 .= "<br><br>Notes: " . $_REQUEST["notes"] . "\n\n";
      
            $message_123 .= "<br><br><a href=\"https://b2c.usedcardboardboxes.com/report_timeclockZF.php?action=run&worker=" . $_REQUEST["worker"] . "&start_date=&end_date=\">Check </a>\n";
      
            $headers_123  = "MIME-Version: 1.0\r\n"; 
      
            $headers_123 .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
      
            $headers_123 .= "From: UCB Website <no-reply@usedcardboardboxes.com>\r\n"; 
      
            $to_123 = "davidkrasnow@usedcardboardboxes.com";
      
            $resp = sendemail_php_function(null, '', $to_123, "", "", "ucbemail@usedcardboardboxes.com", "Operations Usedcardboardboxes", "Operations@UsedCardboardBoxes.com", 'TIME CLOCK EDIT', $message_123); 
            
            }
            
            ?>
         <br><br>
      </div>
   </body>
</html>
