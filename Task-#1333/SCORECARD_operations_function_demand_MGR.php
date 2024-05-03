<?php
  require("inc/header_session.php");
  require("../mainfunctions/database.php");
  require("../mainfunctions/general-functions.php");
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SCORECARD: B2B Demand </title>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/ucb_common_style.css">
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
      font-family: Arial, Helvetica, sans-serif;
      font-size: x-small;
      color: #333333;
      background-color: #99FF99;
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
      width: 40%;
      }
    
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
      padding: 5px;
      }
      table.datatable tr:nth-child(even) td {
      background-color: #e4e4e4;
      }
      table.datatable tr:nth-child(odd) td {
      background-color: #F5F5F5;
      }
    </style>
    <script language="JavaScript" SRC="inc/CalendarPopup.js"></script>
    <script language="JavaScript" SRC="inc/general.js"></script>
    <script language="JavaScript">
      document.write(getCalendarStyles());
    </script>
    <script language="JavaScript">
      var cal2xx = new CalendarPopup("listdiv");
      
      cal2xx.showNavigationDropdowns();
      
      var cal3xx = new CalendarPopup("listdiv");
      
      cal3xx.showNavigationDropdowns();
    </script>
    <style type="text/css">
      .black_overlay {
      display: none;
      position: absolute;
      top: 0%;
      left: 0%;
      width: 100%;
      height: 100%;
      background-color: gray;
      z-index: 1001;
      -moz-opacity: 0.8;
      opacity: .80;
      filter: alpha(opacity=80);
      }
      .white_content {
      display: none;
      position: absolute;
      top: 5%;
      left: 10%;
      width: 45%;
      height: 70%;
      padding: 16px;
      border: 1px solid gray;
      background-color: white;
      z-index: 1002;
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
      z-index: 1002;
      overflow: auto;
      box-shadow: 8px 8px 5px #888888;
      }
      .th_style {
      font-size: xx-small;
      background-color: #FF9900;
      font-family: Arial, Helvetica, sans-serif;
      color: #333333;
      }
      .style12_n {
      font-size: xx-small;
      font-family: Arial, Helvetica, sans-serif;
      color: #333333;
      text-align: left !important;
      }
      .style12_num {
      font-size: xx-small;
      font-family: Arial, Helvetica, sans-serif;
      color: #333333;
      text-align: right !important;
      }
      .style12_tot {
      font-size: xx-small;
      font-family: Arial, Helvetica, sans-serif;
      color: #333333;
      font-weight: bold;
      text-align: right !important;
      }
      .style12_heading {
      font-size: xx-small;
      font-family: Arial, Helvetica, sans-serif;
      color: #333333;
      font-weight: bold;
      text-align: center !important;
      }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
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
      
      
      
      function show_trans_no_delv_details() {
      
      	var selectobject = document.getElementById("trans_no_delv_div");
      
      
      
      	var n_left = f_getPosition(selectobject, 'Left');
      
      	var n_top = f_getPosition(selectobject, 'Top');
      
      	document.getElementById('light_todo').style.left = n_left - 200 + 'px';
      
      	document.getElementById('light_todo').style.top = n_top + 10 + 'px';
      
      	//
      
      	var tabl_head = "<tr vAlign='center'><td bgColor='#FF9900' colspan=2 class='style12_heading'>Transctions w/ No Ops Delivery Date</td></tr><tr><td bgColor='#e4e4e4' class='th_style'>";
      
      	tabl_head = tabl_head + "Transaction ID</td><td bgColor='#e4e4e4' class='th_style'>";
      
      	tabl_head = tabl_head + "Company Name</td></tr>";
      
      	document.getElementById("light_todo").innerHTML = "<a href='javascript:void(0)' onclick=document.getElementById('light_todo').style.display='none';document.getElementById('fade_todo').style.display='none'>Close</a> &nbsp;<center></center><br/><table cellspacing='1' cellpadding='3' border='0'>" + tabl_head + document.getElementById("no_of_trans_no_delv_date_str").value + "</table><br><br>";
      
      	document.getElementById('light_todo').style.display = 'block';
      
      	document.getElementById("inv_summ_div").focus();
      
      }
      
      //
      
      function show_trans_plann_del_pass_details() {
      
      	var selectobject = document.getElementById("trans_plann_del_pass_div");
      
      	var n_left = f_getPosition(selectobject, 'Left');
      
      	var n_top = f_getPosition(selectobject, 'Top');
      
      	document.getElementById('light_todo').style.left = n_left - 200 + 'px';
      
      	document.getElementById('light_todo').style.top = n_top + 10 + 'px';
      
      	var tabl_head = "<tr vAlign='center'><td bgColor='#FF9900' colspan=2 class='style12_heading'># of Transactions where Planned Delivery Date has Passed</td></tr><tr><td bgColor='#e4e4e4' class='th_style'>";
      
      	tabl_head = tabl_head + "Transaction ID</td><td bgColor='#e4e4e4' class='th_style'>";
      
      	tabl_head = tabl_head + "Company Name</td></tr>";
      
      	document.getElementById("light_todo").innerHTML = "<a href='javascript:void(0)' onclick=document.getElementById('light_todo').style.display='none';document.getElementById('fade_todo').style.display='none'>Close</a> &nbsp;<center></center><br/><table cellspacing='1' cellpadding='3' border='0'>" + tabl_head + document.getElementById("no_of_trans_plann_del_pass_str").value + "</table><br><br>";
      
      	document.getElementById('light_todo').style.display = 'block';

      
      	document.getElementById("trans_plann_del_pass_div").focus();
      
      }
      
      //
     
      function show_trans_ops_del_pass_details() {
      
      	var selectobject = document.getElementById("trans_ops_del_pass_div");
      
      	var n_left = f_getPosition(selectobject, 'Left');
      
      	var n_top = f_getPosition(selectobject, 'Top');
      
      	document.getElementById('light_todo').style.left = n_left - 200 + 'px';
      
      	document.getElementById('light_todo').style.top = n_top + 10 + 'px';
      
      	var tabl_head = "<tr vAlign='center'><td bgColor='#FF9900' colspan=2 class='style12_heading'># of Transactions where Ops Delivery Date has Passed</td></tr><tr><td bgColor='#e4e4e4' class='th_style'>";
      
      	tabl_head = tabl_head + "Transaction ID</td><td bgColor='#e4e4e4' class='th_style'>";
      
      	tabl_head = tabl_head + "Company Name</td></tr>";
      
      	document.getElementById("light_todo").innerHTML = "<a href='javascript:void(0)' onclick=document.getElementById('light_todo').style.display='none';document.getElementById('fade_todo').style.display='none'>Close</a> &nbsp;<center></center><br/><table cellspacing='1' cellpadding='3' border='0'>" + tabl_head + document.getElementById("no_of_trans_ops_del_pass_str").value + "</table><br><br>";
      
      	document.getElementById('light_todo').style.display = 'block';

      	document.getElementById("trans_ops_del_pass_div").focus();
      
      }
      
      //show_multiple_tl_mo_entry_details
      
      function show_multiple_tl_mo_entry_details() {
      
      	var selectobject = document.getElementById("multiple_tl_mo_entry_div");
      
      	var n_left = f_getPosition(selectobject, 'Left');
      
      	var n_top = f_getPosition(selectobject, 'Top');
      
      	document.getElementById('light').style.left = n_left - 200 + 'px';
      
      	document.getElementById('light').style.top = n_top + 10 + 'px';
      
      	//
      
      	var date_from_val = document.getElementById("date_from").value;
      
      	var date_to_val = document.getElementById("date_to").value;
      
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
      
      			document.getElementById("light").innerHTML = "<a href='javascript:void(0)' onclick=document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'>Close</a> &nbsp;<center></center><br/>" + xmlhttp.responseText;
      
      			document.getElementById('light').style.display = 'block';
      
      		}
      
      	}
      
      	xmlhttp.open("POST", "demand_mgr_popup.php?date_from_val=" + date_from_val + "&date_to_val=" + date_to_val + "&date_range=Yes&showquotedata=multiple_TL_mo_entered", true);
      
      	xmlhttp.send();
      
      }
      
      //
      
      function show_total_multiple_tl_mo_entry_details() {
      
      	var selectobject = document.getElementById("total_multiple_tl_mo_entry_div");
      
      	var n_left = f_getPosition(selectobject, 'Left');
      
      	var n_top = f_getPosition(selectobject, 'Top');
      
      	document.getElementById('light').style.left = n_left - 200 + 'px';
      
      	document.getElementById('light').style.top = n_top + 10 + 'px';
      
      	//
      
      	var date_from_val = document.getElementById("date_from").value;
      
      	var date_to_val = document.getElementById("date_to").value;
      
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
      
      			document.getElementById("light").innerHTML = "<a href='javascript:void(0)' onclick=document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'>Close</a> &nbsp;<center></center><br/>" + xmlhttp.responseText;
      
      			document.getElementById('light').style.display = 'block';
      
      		}
      
      
      
      	}
      
      	xmlhttp.open("POST", "demand_mgr_popup.php?date_from_val=" + date_from_val + "&date_to_val=" + date_to_val + "&date_range=no&showquotedata=multiple_TL_mo_entered", true);
      
      	xmlhttp.send();
      
      }
      
      //Demand Entries for Multiple TL/MO + 1 TL/mo Entered This Week
      
      function show_tl_mo_entry_details() {
      
      	var selectobject = document.getElementById("tl_mo_entry_div");
      
      	var n_left = f_getPosition(selectobject, 'Left');
      
      	var n_top = f_getPosition(selectobject, 'Top');
      
      	document.getElementById('light').style.left = n_left - 200 + 'px';
      
      	document.getElementById('light').style.top = n_top + 10 + 'px';
      
      	//
      
      	var date_from_val = document.getElementById("date_from").value;
      
      	var date_to_val = document.getElementById("date_to").value;
      
      	//
      
      	//
      
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
      
      			document.getElementById("light").innerHTML = "<a href='javascript:void(0)' onclick=document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'>Close</a> &nbsp;<center></center><br/>" + xmlhttp.responseText;
      
      			document.getElementById('light').style.display = 'block';
      
      		}
      
      
      
      	}
      
      	xmlhttp.open("POST", "demand_mgr_popup.php?date_from_val=" + date_from_val + "&date_to_val=" + date_to_val + "&date_range=Yes&showquotedata=tl_mo_entry", true);
      
      	xmlhttp.send();
      
      }
      
      //
      
      function show_total_tl_mo_entry_details() {
      
      	var selectobject = document.getElementById("total_tl_mo_entry_div");
      
      	var n_left = f_getPosition(selectobject, 'Left');
      
      	var n_top = f_getPosition(selectobject, 'Top');
      
      	document.getElementById('light').style.left = n_left - 200 + 'px';
      
      	document.getElementById('light').style.top = n_top + 10 + 'px';
      
      	//
      
      	var date_from_val = document.getElementById("date_from").value;
      
      	var date_to_val = document.getElementById("date_to").value;
      
      	//
      
      	//
      
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
      
      			document.getElementById("light").innerHTML = "<a href='javascript:void(0)' onclick=document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'>Close</a> &nbsp;<center></center><br/>" + xmlhttp.responseText;
      
      			document.getElementById('light').style.display = 'block';
      
      		}
      
      
      
      	}
      
      	xmlhttp.open("POST", "demand_mgr_popup.php?date_from_val=" + date_from_val + "&date_to_val=" + date_to_val + "&date_range=no&showquotedata=tl_mo_entry", true);
      
      	xmlhttp.send();
      
      }
      
      //
      
      //Total demand entry
      
      function show_total_demand_entry_in_details() {
      
      	var selectobject = document.getElementById("total_demand_entry_in_div");
      
      	var n_left = f_getPosition(selectobject, 'Left');
      
      	var n_top = f_getPosition(selectobject, 'Top');
      
      	document.getElementById('light').style.left = n_left - 200 + 'px';
      
      	document.getElementById('light').style.top = n_top + 10 + 'px';
      
      	//
      
      	var date_from_val = document.getElementById("date_from").value;
      
      	var date_to_val = document.getElementById("date_to").value;
      
      	//
      
      	//
      
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
      
      			document.getElementById("light").innerHTML = "<a href='javascript:void(0)' onclick=document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'>Close</a> &nbsp;<center></center><br/>" + xmlhttp.responseText;
      
      			document.getElementById('light').style.display = 'block';
      
      		}
      
      
      
      	}
      
      	xmlhttp.open("POST", "demand_mgr_popup.php?date_from_val=" + date_from_val + "&date_to_val=" + date_to_val + "&date_range=Yes&showquotedata=total_demand_entry_in", true);
      
      	xmlhttp.send();
      
      }
      
      //
      
      function show_total_demand_entry_details() {
      
      	var selectobject = document.getElementById("total_demand_entry_div");
      
      	var n_left = f_getPosition(selectobject, 'Left');
      
      	var n_top = f_getPosition(selectobject, 'Top');
      
      	document.getElementById('light').style.left = n_left - 200 + 'px';
      
      	document.getElementById('light').style.top = n_top + 10 + 'px';
      
      	//
      
      	var date_from_val = document.getElementById("date_from").value;
      
      	var date_to_val = document.getElementById("date_to").value;
      
      	//
      
      	//
      
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
      
      			document.getElementById("light").innerHTML = "<a href='javascript:void(0)' onclick=document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'>Close</a> &nbsp;<center></center><br/>" + xmlhttp.responseText;
      
      			document.getElementById('light').style.display = 'block';
      
      		}
      
      
      
      	}
      
      	xmlhttp.open("POST", "demand_mgr_popup.php?date_from_val=" + date_from_val + "&date_to_val=" + date_to_val + "&date_range=no&showquotedata=total_demand_entry", true);
      
      	xmlhttp.send();
      
      }
      
      //
      
      function show_oreders_num_details() {
      
      	var selectobject = document.getElementById("oreders_num_div");
      
      
      
      	var n_left = f_getPosition(selectobject, 'Left');
      
      	var n_top = f_getPosition(selectobject, 'Top');
      
      	document.getElementById('light_todo').style.left = n_left - 200 + 'px';
      
      	document.getElementById('light_todo').style.top = n_top + 10 + 'px';
      
      	//
      
      	//var date_from_val = document.getElementById("date_from").value;
      
      	//var date_to_val = document.getElementById("date_to").value;
      
      	//
      
      	var tabl_head = "<tr vAlign='center'><td bgColor='#FF9900' colspan=3 class='style12_heading'># of Customer Ready, Inventory Pending Orders Passed Planned Delivery Date</td></tr><tr><td bgColor='#e4e4e4' class='th_style'>";
      
      	tabl_head = tabl_head + "Transaction ID</td><td bgColor='#e4e4e4' class='th_style'>";
      
      	tabl_head = tabl_head + "Company Name</td><td bgColor='#e4e4e4' class='th_style'>PO Amount</td></tr>";
      
      	document.getElementById("light_todo").innerHTML = "<a href='javascript:void(0)' onclick=document.getElementById('light_todo').style.display='none';document.getElementById('fade_todo').style.display='none'>Close</a> &nbsp;<center></center><br/><table cellspacing='1' cellpadding='3' border='0'>" + tabl_head + document.getElementById("oreders_passed_str").value + "</table><br><br>";
      
      	document.getElementById('light_todo').style.display = 'block';
      
      
      
      	/*document.getElementById('light_todo').style.left= (n_left - 100) + 'px';
      
      	document.getElementById('light_todo').style.top= n_top - 250 + 'px';
      
      	document.getElementById('light_todo').style.width= 1200 + 'px';*/
      
      
      
      	document.getElementById("trans_ops_del_pass_div").focus();
      
      }
      
      //
    </script>
  </head>
  <body>
    <?php include_once("inc/header.php"); ?>
    <div class="main_data_css">
      <div class="dashboard_heading" style="float: left;">
        <div style="float: left;">
          SCORECARD: B2B Demand
          <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
            <span class="tooltiptext">This scorecard shows the user the data for the demand department, which feeds what the B2B purchasing team does.</span>
          </div>
        </div>
      </div>
      <div id="light" class="white_content"></div>
      <div id="fade" class="black_overlay"></div>
      <div id="light_todo" class="white_content"></div>
      <div id="fade_todo" class="black_overlay"></div>
      <?php
        $time = strtotime(Date('Y-m-d'));
        
        $st_friday = $time;
        
        $st_friday_last = date('m/d/Y', strtotime('-6 days', $st_friday));
        
        
        
        $st_thursday_last = Date('m/d/Y');
        
        //$st_friday_last = '01/01/2019';
        
        //Find default dates
        
        $previous_week = strtotime("-1 week +1 day");
        
        
        
        $start_week = strtotime("last sunday midnight", $previous_week);
        
        $end_week = strtotime("next saturday", $start_week);
        
        
        
        $start_week = date("Y-m-d", $start_week);
        
        $end_week = date("Y-m-d", $end_week);
        
        $in_dt_range = "no";
        
        if ($_REQUEST["date_from"] != "" && $_REQUEST["date_to"] != "") {
        
        	$date_from_val = date("Y-m-d", strtotime($_REQUEST["date_from"]));
        
        	$date_to_val_org = date("Y-m-d", strtotime($_REQUEST["date_to"]));
        
        	$date_to_val = date("Y-m-d", strtotime('+1 day', strtotime($_REQUEST["date_to"])));
        
        	//
        
        	$in_dt_range = "yes";
        
        	//
        
        } else {
        
        	$in_dt_range = "no";
        
        	$date_from_val = $start_week;
        
        	$date_to_val_org = $end_week;
        
        	$date_to_val = $end_week;
        }
        
        
        
        ?>
      <!-- <h3>SCORECARD: Operations Function  - Demand Manager</h3> -->
      <form method="post" name="sales_func" action="SCORECARD_operations_function_demand_MGR.php">
        <table border="0">
          <tr>
            <td>Date Range Selector:</td>
            <td>
              From:
              <input type="text" name="date_from" id="date_from" size="10" value="<?php echo isset($_GET['date_from']) ? $_GET['date_from'] : date("m/d/Y", strtotime($date_from_val)); ?>">
              <a href="#" onclick="cal2xx.select(document.sales_func.date_from,'dtanchor2xx','MM/dd/yyyy'); return false;" name="dtanchor2xx" id="dtanchor2xx"><img border="0" src="images/calendar.jpg"></a>
              <div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>
              To:
              <input type="text" name="date_to" id="date_to" size="10" value="<?php echo isset($_GET['date_to']) ? $_GET['date_to'] : date("m/d/Y", strtotime($date_to_val_org)); ?>">
              <a href="#" onclick="cal3xx.select(document.sales_func.date_to,'dtanchor3xx','MM/dd/yyyy'); return false;" name="dtanchor3xx" id="dtanchor3xx"><img border="0" src="images/calendar.jpg"></a>
            </td>
            <td>
              <input type="submit" name="btntool" value="Submit" />
              <input type="hidden" name="sale_pgpost" id="sale_pgpost" value="" />
            </td>
          </tr>
        </table>
      </form>
      <div id="inv_summ_div"></div>
      <table cellSpacing="1" cellPadding="1" border="0" class="datatable">
        <tr>
          <th style="width: 200" class="style17" align="center">
            <b>Measurables</b>
          </th>
          <th style="width: 190" class="style17" align="center">
            <b>Number</b>
          </th>
        </tr>
        <tr>
          <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
            # of Transctions w/ No Ops Delivery Date
          </td>
          <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
            <?php
              $no_of_trans_no_delv_date = 0;
              $no_of_trans_no_delv_date_str = "";
              
              //
              
              $inv_row = "";
              
              $no_of_trans_no_delv_date_str .= $inv_row;
              
              //
              
              $dt_so_item1 = "SELECT *,loop_transaction_buyer.id as I, loop_warehouse.b2bid, loop_warehouse.company_name FROM loop_transaction_buyer inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id ";
              
              $dt_so_item1 .= " where loop_transaction_buyer.ignore = 0 and loop_transaction_buyer.shipped = 0 and (loop_transaction_buyer.ops_delivery_date = '' or loop_transaction_buyer.ops_delivery_date is null)";
              
              //echo $dt_so_item1;
              db();

              $dt_res_so_item1 = db_query($dt_so_item1);
              
              while ($so_item_row1 = array_shift($dt_res_so_item1)) {
              
              	$no_of_trans_no_delv_date = $no_of_trans_no_delv_date + 1;
              
              	$inv_row = "<tr vAlign='center'><td bgColor='#e4e4e4' class='style12_n'>";
              
              	$inv_row .= $so_item_row1["I"] . "</td>";
              
              	$inv_row .= "<td bgColor='#e4e4e4' class='style12_n'>";
              
              	$inv_row .= "<a target='_blank' href='viewCompany.php?ID=" . $so_item_row1["b2bid"] . "&show=transactions&warehouse_id=" . $so_item_row1["warehouse_id"] . "&rec_type=Supplier&proc=View&searchcrit=&id=" . $so_item_row1["warehouse_id"] . "&rec_id=" . $so_item_row1["I"] . "&display=buyer_view'>" . getnickname($so_item_row1["company_name"], $so_item_row1["b2bid"]);
              
              	$inv_row .= "</a></td></tr>";
              
              
              
              	$no_of_trans_no_delv_date_str .= $inv_row;
              }
              
              if ($no_of_trans_no_delv_date > 0) {
              
              	//echo $no_of_trans_no_delv_date_str;
              
              ?>
            <input type="hidden" id="no_of_trans_no_delv_date_str" name="no_of_trans_no_delv_date_str" value="<?php echo $no_of_trans_no_delv_date_str; ?>" />
            <a href='#' id='trans_no_delv_div' onclick="show_trans_no_delv_details(); return false;">
            <?php
              echo $no_of_trans_no_delv_date;
              
              ?>
            </a>
            <?php
              } else {
              
              	echo $no_of_trans_no_delv_date;
              }
              
              ?>
          </td>
        </tr>
        <tr>
          <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
            # of Transactions where Planned Delivery Date has Passed
          </td>
          <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
            <?php
              $no_of_trans_plann_del_pass = 0;
              $no_of_trans_plann_del_pass_str = "";
              
              $inv_row = "";
              db();
              $dt_so_item1 = "SELECT loop_transaction_buyer.id as I, loop_transaction_buyer.*, loop_warehouse.b2bid, loop_warehouse.company_name FROM loop_transaction_buyer inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id ";
              
              $dt_so_item1 .= " where loop_transaction_buyer.ignore = 0 and loop_transaction_buyer.shipped = 0 and po_delivery_dt < '" . date("Y-m-d") . "'";
              
              $dt_res_so_item1 = db_query($dt_so_item1);
              
              while ($so_item_row1 = array_shift($dt_res_so_item1)) {
              
              	$no_of_trans_plann_del_pass = $no_of_trans_plann_del_pass + 1;
              
              	$inv_row = "<tr vAlign='center'><td bgColor='#e4e4e4' class='style12_n'>";
              
              	$inv_row .= $so_item_row1["I"] . "</td>";
              
              	$inv_row .= "<td bgColor='#e4e4e4' class='style12_n'>";
              
              	$inv_row .= "<a target='_blank' href='viewCompany.php?ID=" . $so_item_row1["b2bid"] . "&show=transactions&warehouse_id=" . $so_item_row1["warehouse_id"] . "&rec_type=Supplier&proc=View&searchcrit=&id=" . $so_item_row1["warehouse_id"] . "&rec_id=" . $so_item_row1["I"] . "&display=buyer_view'>" . getnickname($so_item_row1["company_name"], $so_item_row1["b2bid"]);
              
              	$inv_row .= "</a></td></tr>";
              
              
              
              	$no_of_trans_plann_del_pass_str .= $inv_row;
              
              	//
              
              
              
              	//
              
              }
              
              if ($no_of_trans_plann_del_pass > 0) {
              
              ?>
            <input type="hidden" id="no_of_trans_plann_del_pass_str" name="no_of_trans_plann_del_pass_str" value="<?php echo $no_of_trans_plann_del_pass_str; ?>" />
            <a href='#' id='trans_plann_del_pass_div' onclick="show_trans_plann_del_pass_details(); return false;">
            <?php
              echo $no_of_trans_plann_del_pass;
              
              ?>
            </a>
            <?php
              } else {
              
              	echo $no_of_trans_plann_del_pass;
              }
              
              ?>
          </td>
        </tr>
        <tr>
          <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left"># of Transactions where Ops Delivery Date has Passed</td>
          <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
            <?php
              $no_of_trans_ops_del_pass = 0;
              $no_of_trans_ops_del_pass_str = "";
              
              $inv_row = "";
			  db();
              
              $dt_so_item1 = "SELECT loop_transaction_buyer.id as I, loop_transaction_buyer.*, loop_warehouse.b2bid, loop_warehouse.company_name FROM loop_transaction_buyer inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id ";
              
              $dt_so_item1 .= " where loop_transaction_buyer.ignore = 0 and loop_transaction_buyer.shipped = 0 and ops_delivery_date < '" . date("Y-m-d") . "'";
              
              $dt_res_so_item1 = db_query($dt_so_item1);
              
              while ($so_item_row1 = array_shift($dt_res_so_item1)) {
              
              	$no_of_trans_ops_del_pass = $no_of_trans_ops_del_pass + 1;
              
              	//
              
              	$inv_row = "<tr vAlign='center'><td bgColor='#e4e4e4' class='style12_n'>";
              
              	$inv_row .= $so_item_row1["I"] . "</td>";
              
              	$inv_row .= "<td bgColor='#e4e4e4' class='style12_n'>";
              
              	$inv_row .= "<a target='_blank' href='viewCompany.php?ID=" . $so_item_row1["b2bid"] . "&show=transactions&warehouse_id=" . $so_item_row1["warehouse_id"] . "&rec_type=Supplier&proc=View&searchcrit=&id=" . $so_item_row1["warehouse_id"] . "&rec_id=" . $so_item_row1["I"] . "&display=buyer_view'>" . getnickname($so_item_row1["company_name"], $so_item_row1["b2bid"]);
              
              	$inv_row .= "</a></td></tr>";
              
              
              
              	$no_of_trans_ops_del_pass_str .= $inv_row;
              
              	//
              
              }
              
              if ($no_of_trans_ops_del_pass > 0) {
              
              ?>
            <input type="hidden" id="no_of_trans_ops_del_pass_str" name="no_of_trans_ops_del_pass_str" value="<?php echo $no_of_trans_ops_del_pass_str; ?>" />
            <a href='#' id='trans_ops_del_pass_div' onclick="show_trans_ops_del_pass_details(); return false;">
            <?php
              echo $no_of_trans_ops_del_pass;
              
              ?>
            </a>
            <?php
              } else {
              
              	echo $no_of_trans_ops_del_pass;
              }
              
              ?>
          </td>
        </tr>
        <?php
          //Quote request table
		  db();
          $quote_qry = "select * from quote_request";
          
          $quote_res = db_query($quote_qry);
          
          while ($quote_row = array_shift($quote_res)) {
          
          	$quote_id = $quote_id . $quote_row["quote_id"] . ",";
          }
          
          if ($quote_id != "") {
          
          	$quote_id = substr($quote_id, 0, strlen($quote_id) - 1);
          }
          
          //
		  db();
          $quote_qry = "select * from quote_request where quote_date >='" . $date_from_val . "' AND quote_date <= '" . $date_to_val . " 23:59:59'";
          
          $quote_res = db_query($quote_qry);
          
          while ($quote_row = array_shift($quote_res)) {
          
          	$quote_id_indate = $quote_id_indate . $quote_row["quote_id"] . ",";
          }
          
          if ($quote_id_indate != "") {
          
          	$quote_id_indate = substr($quote_id_indate, 0, strlen($quote_id_indate) - 1);
          } else {
          
          	$quote_id_indate = 0;
          }
          
          //------------------------------------------------------------------
          
          //Sales request table
		  db();

          $quote_qry = "select * from sales_request"; //where flag='' and deny_sales<>'Yes'
          
          $quote_res = db_query($quote_qry);
          
          while ($quote_row = array_shift($quote_res)) {
          
          	$sales_id = $sales_id . $quote_row["sales_request_id"] . ",";
          }
          
          if ($sales_id != "") {
          
          	$sales_id = substr($sales_id, 0, strlen($sales_id) - 1);
          }
          
          //
          
          $quote_qry = "select * from sales_request where sales_date >='" . $date_from_val . "' AND sales_date <= '" . $date_to_val . " 23:59:59'";
          
          //echo $quote_qry;
		  db();
          $quote_res = db_query($quote_qry);
          
          while ($quote_row = array_shift($quote_res)) {
          
          	$sales_id_indate = $sales_id_indate . $quote_row["sales_request_id"] . ",";
          }
          
          if ($sales_id_indate != "") {
          
          	$sales_id_indate = substr($sales_id_indate, 0, strlen($sales_id_indate) - 1);
          } else {
          
          	$sales_id_indate = 0;
          }
          
          //
          
          $sales_date_qry = " and sales_date >='" . $date_from_val . "' AND sales_date <= '" . $date_to_val . "'";
          
          $quote_date_qry = " and quote_date >='" . $date_from_val . "' AND quote_date <= '" . $date_to_val . "'";
          
          
          
          //
          
          ?>
        <tr>
          <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left"># of New Demand Entries for Multiple TL/mo Entered</td>
          <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
            <?php
              $multiple_tl_mo_entry = 0;
              
              //Quote tables---------------------------------
              db();
              $gquote_qry = "select * from quote_gaylord where g_frequency_order='Multiple per Month' and quote_id in (" . $quote_id_indate . ")";
              
              $gquote_res = db_query($gquote_qry);
              
              $gquote_num = tep_db_num_rows($gquote_res);
              
              //
              db();
              $sbquote_qry = "select * from quote_shipping_boxes where sb_frequency_order='Multiple per Month' and quote_id in (" . $quote_id_indate . ")";
              
              $sbquote_res = db_query($sbquote_qry);
              
              $sbquote_num = tep_db_num_rows($sbquote_res);
              
              
              
              $supquote_qry = "select * from quote_supersacks where  	 	sup_frequency_order='Multiple per Month' and quote_id in (" . $quote_id_indate . ")";
              
              $supquote_res = db_query($supquote_qry);
              
              $supquote_num = tep_db_num_rows($supquote_res);
              
              //---------------------------------------
              
              //Sales tables
              
              $sales_gquote_qry = "select * from sales_gaylord where g_frequency_order='Multiple per Month' and sales_request_id in (" . $sales_id_indate . ")";
              
              $sales_gquote_res = db_query($sales_gquote_qry);
              
              $sales_gquote_num = tep_db_num_rows($sales_gquote_res);
              
              //
              
              $sales_sbquote_qry = "select * from sales_shipping_boxes where sb_frequency_order='Multiple per Month' and sales_request_id in (" . $sales_id_indate . ")";
              
              $sales_sbquote_res = db_query($sales_sbquote_qry);
              
              $sales_sbquote_num = tep_db_num_rows($sales_sbquote_res);
              
              
              
              $sales_supquote_qry = "select * from sales_supersacks where  	 	sup_frequency_order='Multiple per Month' and sales_request_id in (" . $sales_id_indate . ")";
              
              $sales_supquote_res = db_query($sales_supquote_qry);
              
              $sales_supquote_num = tep_db_num_rows($sales_supquote_res);
              
              //
              
              $multiple_tl_mo_entry = $gquote_num + $sbquote_num + $supquote_num + $sales_gquote_num + $sales_sbquote_num + $sales_supquote_num;
              
              //
              
              if ($multiple_tl_mo_entry > 0) {
              
              ?>
            <a href='#' id='multiple_tl_mo_entry_div' onclick="show_multiple_tl_mo_entry_details(); return false;">
            <?php
              echo $multiple_tl_mo_entry;
              
              ?>
            </a>
            <?php
              } else {
              
              	echo $multiple_tl_mo_entry;
              }
              
              ?>
          </td>
        </tr>
        <tr>
          <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
            Total # of Demand Entries for Multiple TL/mo in System 
          </td>
          <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
            <?php
              $total_multiple_tl_mo_entry = 0;
              
              //Quote tables---------------------------------
              
              $gquote_qry = "select * from quote_gaylord where g_frequency_order='Multiple per Month' and quote_id in (" . $quote_id . ")";
              
              $gquote_res = db_query($gquote_qry);
              
              $gquote_num = tep_db_num_rows($gquote_res);
              
              //
              
              $sbquote_qry = "select * from quote_shipping_boxes where sb_frequency_order='Multiple per Month' and quote_id in (" . $quote_id . ")";
              
              $sbquote_res = db_query($sbquote_qry);
              
              $sbquote_num = tep_db_num_rows($sbquote_res);
              
              
              
              $supquote_qry = "select * from quote_supersacks where  	 	sup_frequency_order='Multiple per Month' and quote_id in (" . $quote_id . ")";
              
              $supquote_res = db_query($supquote_qry);
              
              $supquote_num = tep_db_num_rows($supquote_res);
              
              //---------------------------------------
              
              //Sales tables
              
              $sales_gquote_qry = "select * from sales_gaylord where g_frequency_order='Multiple per Month' and sales_request_id in (" . $sales_id . ")";
              
              $sales_gquote_res = db_query($sales_gquote_qry);
              
              $sales_gquote_num = tep_db_num_rows($sales_gquote_res);
              
              //
              
              $sales_sbquote_qry = "select * from sales_shipping_boxes where sb_frequency_order='Multiple per Month' and sales_request_id in (" . $sales_id . ")";
              
              $sales_sbquote_res = db_query($sales_sbquote_qry);
              
              $sales_sbquote_num = tep_db_num_rows($sales_sbquote_res);
              
              
              
              $sales_supquote_qry = "select * from sales_supersacks where  	 	sup_frequency_order='Multiple per Month' and sales_request_id in (" . $sales_id . ")";
              
              $sales_supquote_res = db_query($sales_supquote_qry);
              
              $sales_supquote_num = tep_db_num_rows($sales_supquote_res);
              
              //
              
              $total_multiple_tl_mo_entry = $gquote_num + $sbquote_num + $supquote_num + $sales_gquote_num + $sales_sbquote_num + $sales_supquote_num;
              
              //
              
              if ($total_multiple_tl_mo_entry > 0) {
              
              ?>
            <a href='#' id='total_multiple_tl_mo_entry_div' onclick="show_total_multiple_tl_mo_entry_details(); return false;">
            <?php
              echo $total_multiple_tl_mo_entry;
              
              ?>
            </a>
            <?php
              } else {
              
              	echo $total_multiple_tl_mo_entry;
              }
              
              ?>
          </td>
        </tr>
        <tr>
          <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
            # of New Demand Entries for Multiple TL/MO + 1 TL/mo Entered This Week
          </td>
          <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
            <?php
              $tl_mo_entry = 0;
              
              //Quote tables---------------------------------
              
              $gquote_qry = "select * from quote_request inner join quote_gaylord on quote_request.quote_id = quote_gaylord.quote_id where (g_frequency_order='Multiple per Month' or g_frequency_order='Once per Month') " . $quote_date_qry;
              
              $gquote_res = db_query($gquote_qry);
              
              $gtotal = tep_db_num_rows($gquote_res);
              
              //
              
              $sbquote_qry = "select * from quote_request inner join quote_shipping_boxes on quote_request.quote_id = quote_shipping_boxes.quote_id where (sb_frequency_order='Multiple per Month' or sb_frequency_order='Once per Month') " . $quote_date_qry;
              
              $sbquote_res = db_query($sbquote_qry);
              
              $sbtotal = tep_db_num_rows($sbquote_res);
              
              
              
              $supquote_qry = "select * from quote_request inner join quote_supersacks on quote_request.quote_id = quote_supersacks.quote_id where (sup_frequency_order='Multiple per Month' or sup_frequency_order='Once per Month') " . $quote_date_qry;
              
              $supquote_res = db_query($supquote_qry);
              
              $suptotal = tep_db_num_rows($supquote_res);
              
              //---------------------------------------
              
              //Sales tables
              
              $sales_gquote_qry = "select * from sales_request inner join sales_gaylord on sales_request.sales_request_id = sales_gaylord.sales_request_id where (g_frequency_order='Multiple per Month' or g_frequency_order='Once per Month')  " . $sales_date_qry;
              
              $sales_gquote_res = db_query($sales_gquote_qry);
              
              $sales_gtotal = tep_db_num_rows($sales_gquote_res);
              
              //
              
              $sales_sbquote_qry = "select * from sales_request inner join sales_shipping_boxes on sales_request.sales_request_id = sales_shipping_boxes.sales_request_id where (sb_frequency_order='Multiple per Month' or sb_frequency_order='Once per Month')   " . $sales_date_qry;
              
              $sales_sbquote_res = db_query($sales_sbquote_qry);
              
              $sales_sbtotal = tep_db_num_rows($sales_sbquote_res);
              
              
              
              $sales_supquote_qry = "select * from sales_request inner join sales_supersacks on sales_request.sales_request_id = sales_supersacks.sales_request_id where (sup_frequency_order='Multiple per Month' or sup_frequency_order='Once per Month')  " . $sales_date_qry;
              
              
              
              $sales_supquote_res = db_query($sales_supquote_qry);
              
              $sales_suptotal = tep_db_num_rows($sales_supquote_res);
              
              //
              
              //echo "qg-".$gtotal."qsb-".$sbtotal."qsupg-".$suptotal."sg-".$sales_gtotal."ssb-".$sales_sbtotal."ssup-".$sales_suptotal;
              
              $tl_mo_entry = $gtotal + $sbtotal + $suptotal + $sales_gtotal + $sales_sbtotal + $sales_suptotal;
              
              if ($tl_mo_entry > 0) {
              
              ?>
            <a href='#' id='tl_mo_entry_div' onclick="show_tl_mo_entry_details(); return false;">
            <?php
              echo $tl_mo_entry;
              
              ?>
            </a>
            <?php
              } else {
              
              	echo $tl_mo_entry;
              }
              
              ?>
          </td>
        </tr>
        <tr>
          <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">Total # of Demand Entries for Multiple TL/MO + 1 TL/mo in System</td>
          <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
            <?php
              $total_tl_mo_entry = 0;
              
              $sales_requestid = $quote_row["sales_request_id"];
              
              $gquote_qry = "select * from quote_gaylord where (g_frequency_order='Multiple per Month' or g_frequency_order='Once per Month') and quote_id in (" . $quote_id . ")";
              
              $gquote_res = db_query($gquote_qry);
              
              $gtotal = tep_db_num_rows($gquote_res);
              
              //
              
              $sbquote_qry = "select * from quote_shipping_boxes where (sb_frequency_order='Multiple per Month' or sb_frequency_order='Once per Month') and quote_id in (" . $quote_id . ")";
              
              $sbquote_res = db_query($sbquote_qry);
              
              $sbtotal = tep_db_num_rows($sbquote_res);
              
              
              
              $supquote_qry = "select * from quote_supersacks where  	 	(sup_frequency_order='Multiple per Month' or sup_frequency_order='Once per Month') and quote_id in (" . $quote_id . ")";
              
              $supquote_res = db_query($supquote_qry);
              
              $suptotal = tep_db_num_rows($supquote_res);
              
              //---------------------------------------
              
              //Sales tables
              
              $sales_gquote_qry = "select * from sales_gaylord where (g_frequency_order='Multiple per Month' or g_frequency_order='Once per Month') and sales_request_id in (" . $sales_id . ")";
              
              $sales_gquote_res = db_query($sales_gquote_qry);
              
              $sales_gtotal = tep_db_num_rows($sales_gquote_res);
              
              //
              
              $sales_sbquote_qry = "select * from sales_shipping_boxes where (sb_frequency_order='Multiple per Month' or sb_frequency_order='Once per Month') and sales_request_id in (" . $sales_id . ")";
              
              $sales_sbquote_res = db_query($sales_sbquote_qry);
              
              $sales_sbtotal = tep_db_num_rows($sales_sbquote_res);
              
              
              
              $sales_supquote_qry = "select * from sales_supersacks where  	 	(sup_frequency_order='Multiple per Month' or sup_frequency_order='Once per Month') and sales_request_id in (" . $sales_id . ")";
              
              $sales_supquote_res = db_query($sales_supquote_qry);
              
              $sales_suptotal = tep_db_num_rows($sales_supquote_res);
              
              //
              
              
              
              $total_tl_mo_entry = $gtotal + $sbtotal + $suptotal + $sales_gtotal + $sales_sbtotal + $sales_suptotal;
              
              if ($total_tl_mo_entry > 0) {
              
              ?>
            <a href='#' id='total_tl_mo_entry_div' onclick="show_total_tl_mo_entry_details(); return false;">
            <?php
              echo $total_tl_mo_entry;
              
              ?>
            </a>
            <?php
              } else {
              
              	echo $total_tl_mo_entry;
              }
              
              ?>
          </td>
        </tr>
        <tr>
          <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left"># of New Demand Entries Entered (all frequencies)</td>
          <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
            <?php
              $total_demand_entry_in = 0;
              
              //Quote tables---------------------------------
              
              $gquote_qry = "select * from quote_gaylord where quote_id in (" . $quote_id_indate . ")";
              
              $gquote_res = db_query($gquote_qry);
              
              $gtotal = tep_db_num_rows($gquote_res);
              
              //
              
              $sbquote_qry = "select * from quote_shipping_boxes where quote_id in (" . $quote_id_indate . ")";
              
              $sbquote_res = db_query($sbquote_qry);
              
              $sbtotal = tep_db_num_rows($sbquote_res);
              
              
              
              $supquote_qry = "select * from quote_supersacks where quote_id in (" . $quote_id_indate . ")";
              
              $supquote_res = db_query($supquote_qry);
              
              $suptotal = tep_db_num_rows($supquote_res);
              
              
              
              $palquote_qry = "select * from quote_pallets where quote_id in (" . $quote_id_indate . ")";
			  db();
              $palquote_res = db_query($palquote_qry);
              
              $paltotal = tep_db_num_rows($palquote_res);
              
              //---------------------------------------
              
              //Sales tables
              
              $sales_gquote_qry = "select * from sales_gaylord where sales_request_id in (" . $sales_id_indate . ")";
              
              $sales_gquote_res = db_query($sales_gquote_qry);
              
              $sales_gtotal = tep_db_num_rows($sales_gquote_res);
              
              //
              
              $sales_sbquote_qry = "select * from sales_shipping_boxes where sales_request_id in (" . $sales_id_indate . ")";
              
              $sales_sbquote_res = db_query($sales_sbquote_qry);
              
              $sales_sbtotal = tep_db_num_rows($sales_sbquote_res);
              
              
              
              $sales_supquote_qry = "select * from sales_supersacks where sales_request_id in (" . $sales_id_indate . ")";
              
              $sales_supquote_res = db_query($sales_supquote_qry);
              
              $sales_suptotal = tep_db_num_rows($sales_supquote_res);
              
              //
              
              
              
              $sales_palquote_qry = "select * from sales_pallets where sales_request_id in (" . $sales_id_indate . ")";
              db();
              $sales_palquote_res = db_query($sales_palquote_qry);
              
              $sales_paltotal = tep_db_num_rows($sales_palquote_res);
              
              //Calculate total
              
              $total_demand_entry_in = $gtotal + $sbtotal + $suptotal + $paltotal + $sales_gtotal + $sales_sbtotal + $sales_suptotal + $sales_paltotal;
              
              
              
              if ($total_demand_entry_in > 0) {
              
              ?>
            <a href='#' id='total_demand_entry_in_div' onclick="show_total_demand_entry_in_details(); return false;">
            <?php
              echo $total_demand_entry_in;
              
              ?>
            </a>
            <?php
              } else {
              
              	echo $total_demand_entry_in;
              }
              
              ?>
          </td>
        </tr>
        <tr>
          <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
            Total # of Demand Entries (Sales Leads) in System
          </td>
          <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
            <?php
              $total_demand_entry = 0;
              
              //Quote tables---------------------------------
              
              $gquote_qry = "select * from quote_gaylord where quote_id in (" . $quote_id . ")";
              
              $gquote_res = db_query($gquote_qry);
              
              $gtotal = tep_db_num_rows($gquote_res);
              
              //
              
              $sbquote_qry = "select * from quote_shipping_boxes where quote_id in (" . $quote_id . ")";
              
              $sbquote_res = db_query($sbquote_qry);
              
              $sbtotal = tep_db_num_rows($sbquote_res);
              
              
              
              $supquote_qry = "select * from quote_supersacks where quote_id in (" . $quote_id . ")";
              
              $supquote_res = db_query($supquote_qry);
              
              $suptotal = tep_db_num_rows($supquote_res);
              
              
              db();
              $palquote_qry = "select * from quote_pallets where quote_id in (" . $quote_id . ")";
              
              $palquote_res = db_query($palquote_qry);
              
              $paltotal = tep_db_num_rows($palquote_res);
              
              //---------------------------------------
              
              //Sales tables
              
              $sales_gquote_qry = "select * from sales_gaylord where sales_request_id in (" . $sales_id . ")";
              
              $sales_gquote_res = db_query($sales_gquote_qry);
              
              $sales_gtotal = tep_db_num_rows($sales_gquote_res);
              
              //
              
              $sales_sbquote_qry = "select * from sales_shipping_boxes where sales_request_id in (" . $sales_id . ")";
              
              $sales_sbquote_res = db_query($sales_sbquote_qry);
              
              $sales_sbtotal = tep_db_num_rows($sales_sbquote_res);
              
              
              
              $sales_supquote_qry = "select * from sales_supersacks where sales_request_id in (" . $sales_id . ")";
              
              $sales_supquote_res = db_query($sales_supquote_qry);
              
              $sales_suptotal = tep_db_num_rows($sales_supquote_res);
              
              //
              
			  db();
              $sales_palquote_qry = "select * from sales_pallets where sales_request_id in (" . $sales_id . ")";
              
              $sales_palquote_res = db_query($sales_palquote_qry);
              
              $sales_paltotal = tep_db_num_rows($sales_palquote_res);
              
              
              
              //Calculate total
              
              $total_demand_entry = $sales_gtotal + $sales_sbtotal + $sales_suptotal + $sales_paltotal + $gtotal + $sbtotal + $suptotal + $paltotal;
              
              //echo $total_demand_entry;
              
              if ($total_demand_entry > 0) {
              
              ?>
            <a href='#' id='total_demand_entry_div' onclick="show_total_demand_entry_details(); return false;">
            <?php
              echo $total_demand_entry;
              
              ?>
            </a>
            <?php
              } else {
              
              	echo $total_demand_entry;
              }
              
              ?>
          </td>
        </tr>
        <tr>
          <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left"># of orders sold &lt; min FOB</td>
          <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
            <?php
			  db();
              $dtt_view_qry = "SELECT * from loop_transaction_buyer where confirm_delivery_financials=1";
              
              $dtt_view_res1 = db_query($dtt_view_qry);
              
              while ($dtt_view_res = array_shift($dtt_view_res1)) {
              
              	$rec_id = $dtt_view_res["id"];
              
              	$quote_number = 0;
              	$freight_cost = 0;
              	$po_poorderamount = 0;
				db();
              	$dtt_view_qry = "SELECT quote_number, po_freight, po_poorderamount from loop_transaction_buyer WHERE id = " . $rec_id;
              
              	//echo $dtt_view_qry;
              
              	$dtt_view_res1 = db_query($dtt_view_qry);
              
              	while ($dtt_view_res = array_shift($dtt_view_res1)) {
              
              		$quote_number = $dtt_view_res["quote_number"];
              
              		$freight_cost = $dtt_view_res["po_freight"];
              
              		$po_poorderamount = $dtt_view_res["po_poorderamount"];
              
              		//echo $po_poorderamount;
              
              	}
              
              
              
              	$salesorder_qty = 0;
              	$weighted_average = 0;
				db();
              	$get_sales_order = db_query("Select loop_salesorders.qty, loop_boxes.b2b_id from loop_salesorders Inner Join loop_boxes ON loop_salesorders.box_id = loop_boxes.id WHERE trans_rec_id = " .   $rec_id);
              
              	while ($dtt_view_res = array_shift($get_sales_order)) {
              
              		$salesorder_qty = $salesorder_qty + $dtt_view_res["qty"];
              
              
              
              		//get Min FOB
              
              		db_b2b();
              
              		$min_fob = 0;
              
              		$get_box_data = db_query("Select ulineDollar, ulineCents from inventory where ID = " .  $dtt_view_res["b2b_id"]);
              
              		while ($box_data_res = array_shift($get_box_data)) {
              
              			$b2b_ulineDollar = round($box_data_res["ulineDollar"]);
              
              			$b2b_ulineCents = $box_data_res["ulineCents"];
              
              			$min_fob = $b2b_ulineDollar + $b2b_ulineCents;
              		}
              
              		if ($min_fob > 0) {
              
              			$weighted_average = $weighted_average + ($dtt_view_res["qty"] * $min_fob);
              		}
              
        
              	}
              
              
              
              	$weighted_average_fin =  $weighted_average / $salesorder_qty;
              
				db();
              
              	$get_sales_order = db_query("Select qty from loop_salesorders_manual WHERE trans_rec_id = " .   $rec_id);
              
              	while ($dtt_view_res = array_shift($get_sales_order)) {
              
              		$salesorder_qty = $salesorder_qty + $dtt_view_res["qty"];
              	}
              
              
              
              	//$quote_total = 0;
              
              	$quote_total = $po_poorderamount;
              
              	if (number_format((($quote_total - $freight_cost) / $salesorder_qty), 2) >= number_format($weighted_average_fin, 2)) {
              
              
              
              		$min_fob_val = "<font size='1' color='green'>$" . number_format((($quote_total - $freight_cost) / $salesorder_qty), 2) . "</font>";
              	} else {
              
              
              
              		$min_rec = $min_rec + 1;
              
              		$min_fob_val = "<font size='1' color='red'>$" . number_format((($quote_total - $freight_cost) / $salesorder_qty), 2) . "</font>";
              	}
              }
              
              echo $min_rec;
              
              ?>
          </td>
        </tr>
        <tr>
          <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
            # of Customer Ready, Inventory Pending Orders Passed Planned Delivery Date
          </td>
          <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
            <?php
              $po_amount = 0;
              
              $dt_view_qry = "SELECT po_employee, ops_delivery_date, booked_delivery_cost, freight_booked_delivery_date, loop_transaction_buyer.po_poorderamount, loop_transaction_buyer.po_freight, loop_transaction_buyer.virtual_inventory_company_id, loop_transaction_buyer.good_to_ship_action_dt, loop_transaction_buyer.no_invoice, loop_transaction_buyer.po_delivery, ";
              
              $dt_view_qry .= "loop_transaction_buyer.po_delivery_dt, loop_warehouse.b2bid, loop_warehouse.Active, loop_warehouse.company_name AS B, loop_transaction_buyer.warehouse_id, loop_transaction_buyer.inv_amount AS F, loop_transaction_buyer.so_entered , ";
              
              $dt_view_qry .= "loop_transaction_buyer.good_to_ship AS G, loop_transaction_buyer.po_date AS H , loop_transaction_buyer.id AS I, loop_transaction_buyer.inv_date_of AS J FROM loop_transaction_buyer INNER JOIN loop_warehouse ON loop_transaction_buyer.warehouse_id = loop_warehouse.id ";
              
              $dt_view_qry .= "WHERE $emp_query so_entered = 1 and loop_transaction_buyer.shipped = 0 AND inv_entered = 0 and loop_transaction_buyer.Preorder = 0 and loop_transaction_buyer.ignore = 0 and loop_transaction_buyer.good_to_ship = 0 and loop_transaction_buyer.no_invoice = 0 GROUP BY loop_transaction_buyer.id ORDER BY loop_transaction_buyer.id";
              
			  db();
			  
              $dt_view_res = db_query($dt_view_qry);
              
              while ($dt_view_row = array_shift($dt_view_res)) {
              
              	if ($dt_view_row["po_delivery_dt"] == "") {
              
              		if ($dt_view_row["po_delivery_dt"] == "") {
              
              			$Planned_delivery_date = "";
              		} else {
              
              			$Planned_delivery_date = date("m/d/Y", strtotime($dt_view_row["po_delivery"]));
              		}
              	} else {
              
              		$Planned_delivery_date = date("m/d/Y", strtotime($dt_view_row["po_delivery_dt"]));
              	}
              
              	//echo "Planned_delivery_date: " . $Planned_delivery_date . "<br>";
              
              	if ($Planned_delivery_date != "") {
              
              		$oreders_num = $oreders_num + 1;
              
              		$po_amount = $po_amount + $dt_view_row["po_poorderamount"];
              	}
              
              	//
              
              	$inv_row = "<tr vAlign='center'><td bgColor='#e4e4e4' class='style12_n'>";
              
              	$inv_row .= $dt_view_row["I"] . "</td>";
              
              	$inv_row .= "<td bgColor='#e4e4e4' class='style12_n'>";
              
              	$inv_row .= "<a target='_blank' href='viewCompany.php?ID=" . $dt_view_row["b2bid"] . "&show=transactions&warehouse_id=" . $dt_view_row["warehouse_id"] . "&rec_type=Supplier&proc=View&searchcrit=&id=" . $dt_view_row["warehouse_id"] . "&rec_id=" . $dt_view_row["I"] . "&display=buyer_view'>" . getnickname($dt_view_row["company_name"], $dt_view_row["b2bid"]);
              
              	$inv_row .= "</a></td><td bgColor='#e4e4e4' class='style12_n'>$" . number_format($dt_view_row["po_poorderamount"], 2) . "</td></tr>";
              
              
              
              	$oreders_passed_str .= $inv_row;
              
              	//
              
              }
              
              //echo $oreders_num;
              
              if ($oreders_num > 0) {
              
              	//$oreders_passed_str .= $inv_row;
              
              	$inv_row1 .= "<tr><td colspan=2 bgColor='#e4e4e4' class='style12_tot'>Total </td><td bgColor='#e4e4e4' class='style12_n'>$" . number_format($po_amount, 2) . "</td></tr>";
              
              	$oreders_passed_str .= $inv_row1;
              
              ?>
            <input type="hidden" id="oreders_passed_str" name="oreders_passed_str" value="<?php echo $oreders_passed_str; ?>" />
            <a href='#' id='oreders_num_div' onclick="show_oreders_num_details(); return false;">
            <?php
              echo $oreders_num;
              
              ?>
            </a>
            <?php
              } else {
              
              	echo $oreders_num;
              }
              
              ?>
          </td>
        </tr>
        <tr>
          <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
            Revenue Potential of Customer Ready, Inventory Pending Orders Passed Delivery Date
          </td>
          <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
            <?php
              echo "$" . number_format($po_amount);
              
              ?>
          </td>
        </tr>
      </table>
    </div>
  </body>
</html>