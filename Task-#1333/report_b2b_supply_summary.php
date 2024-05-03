<?php
  require("inc/header_session.php");
  require("mainfunctions/database.php");
  require("mainfunctions/general-functions.php"); 
  ?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>B2B Supply Summary Report</title>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
    <LINK rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>
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
      font-size: 13px;
      padding: 3px;
      font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
      color: #333333;
      }
      .qty_freq_title {
      font-size: 14px;
      padding: 3px;
      font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
      color: #000000;
      font-weight: 600;
      }
      .display_row {
      font-size: 11px;
      padding: 3px;
      font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
      background: #EBEBEB;
      }
      .display_row a {
      color: #004CB3;
      font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
      }
      .display_row_alt {
      font-size: 11px;
      padding: 3px;
      font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
      background: #F7F7F7;
      }
      .display_row_alt a {
      color: #004CB3;
      font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
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
      /*border: 1px solid white;*/
      }
      table.datatable tr td,
      table.datatable tr th {
      height: 20px;
      border: 1px solid white;
      /*padding: 5px;*/
      }
      table.datatable tr:nth-child(even) {
      background-color: #EBEBEB;
      }
      table.datatable tr:nth-child(odd) {
      background-color: #F7F7F7;
      }
      table.datatable tr td.display_title {
      background: #98bcdf;
      }
      table.innertable {
      border-collapse: collapse;
      background: #FFF;
      }
      table.innertable tr td,
      table.innertable tr th {
      height: 20px;
      border: 1px solid white;
      /*padding: 5px;*/
      }
      .black_overlay {
      display: none;
      position: absolute;
      }
      .white_content {
      display: none;
      position: absolute;
      padding: 5px;
      border: 2px solid black;
      background-color: white;
      overflow: auto;
      height: 600px;
      width: 1000px;
      z-index: 1002;
      margin: 0px 0 0 0px;
      padding: 10px 10px 10px 10px;
      border-color: black;
      border-width: 2px;
      overflow: auto;
      }
      .display_table_tot {
      font-size: 12px;
      padding: 3px;
      font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
      background: #d7e3ee;
      font-weight: 600;
      }
      .display_table_tot a {
      color: #004CB3;
      font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
      }
      .display_table_tot_alt {
      font-size: 12px;
      padding: 3px;
      font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
      background: #cbdeee;
      font-weight: 600;
      }
      .display_table_tot_act {
      font-size: 12px;
      padding: 3px;
      font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
      background: #FFE4A9;
      font-weight: 600;
      }
      .display_table_tot_act_alt {
      font-size: 12px;
      padding: 3px;
      font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
      background: #FFE4A9;
      font-weight: 600;
      }
      .display_table {
      font-size: 11px;
      padding: 3px;
      font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
      background: #EBEBEB;
      }
      .display_table a {
      color: #004CB3;
      font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
      }
      .display_table_alt {
      font-size: 11px;
      padding: 3px;
      font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
      background: #F7F7F7;
      }
    </style>
    <SCRIPT LANGUAGE="JavaScript" SRC="inc/CalendarPopup.js"></SCRIPT>
    <SCRIPT LANGUAGE="JavaScript" SRC="inc/general.js"></SCRIPT>
    <script LANGUAGE="JavaScript">
      document.write(getCalendarStyles());
    </script>
    <script LANGUAGE="JavaScript">
      var cal2xx = new CalendarPopup("listdiv");
      
      cal2xx.showNavigationDropdowns();
      
      var cal3xx = new CalendarPopup("listdiv");
      
      cal3xx.showNavigationDropdowns();
    </script>
    <script LANGUAGE="JavaScript">
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
      
      
      
      function load_div(id) {
      
      	var element = document.getElementById("spanctr" + id); //replace elementId with your element's Id.
      
      
      
      	var rect = element.getBoundingClientRect();
      
      	var elementLeft, elementTop; //x and y
      
      	var scrollTop = document.documentElement.scrollTop ?
      
      		document.documentElement.scrollTop : document.body.scrollTop;
      
      	var scrollLeft = document.documentElement.scrollLeft ?
      
      		document.documentElement.scrollLeft : document.body.scrollLeft;
      
      	elementTop = rect.top + scrollTop;
      
      	elementLeft = rect.left + scrollLeft;
      
      
      
      	document.getElementById("light").innerHTML = document.getElementById("spanctr" + id).innerHTML;
      
      	document.getElementById('light').style.display = 'block';
      
      	document.getElementById('fade').style.display = 'block';
      
      
      
      	document.getElementById('light').style.left = '100px';
      
      	document.getElementById('light').style.top = elementTop + 100 + 'px';
      
      }
      
      
      
      function close_div() {
      
      	document.getElementById('light').style.display = 'none';
      
      }
      
      
      
      //---------------------------------------------------------------
      
      function show_supplier_details(vendor_b2b_rescue, row) {
      
      	var x = document.getElementById("supply" + vendor_b2b_rescue);
      
      
      
      	if (x.style.display == "none")
      
      	{
      
      		x.style.display = "block";
      
      		document.getElementById("supplier_total_row" + vendor_b2b_rescue).style.display = "none";
      
      
      
      	} else {
      
      		x.style.display = "none";
      
      		document.getElementById("supplier_total_row" + vendor_b2b_rescue).removeAttribute('style');
      
      	}
      
      	var element = document.getElementById("row_supply" + vendor_b2b_rescue);
      
      	element.removeAttribute('style');
      
      	var box_type = document.getElementById("box_type").value;
      
      	var sort_g_tool = document.getElementById("sort_g_tool").value;
      
      	var g_timing = document.getElementById("g_timing").value;
      
      
      
      
      
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
      
      			//document.getElementById("supply"+vendor_b2b_rescue).innerHTML = xmlhttp.responseText;
      
      		}
      
      	}
      
      	/*xmlhttp.open("POST","b2b_supply_summary_child.php?vendor_b2b_rescue="+vendor_b2b_rescue+"&box_type="+box_type+"&sort_g_tool="+sort_g_tool+"&g_timing="+g_timing+"&showdata=1",true);
      
         xmlhttp.send();*/
      
      }
      
      
      
      function display_preoder_sel(tmpcnt, reccnt, box_id, wid) {
      
      	if (document.getElementById('inventory_preord_top_' + tmpcnt).style.display == 'table-row')
      
      	{
      
      		document.getElementById('inventory_preord_top_' + tmpcnt).style.display = 'none';
      
      	} else {
      
      		document.getElementById('inventory_preord_top_' + tmpcnt).style.display = 'table-row';
      
      	}
      
      
      
      	document.getElementById("inventory_preord_middle_div_" + tmpcnt).innerHTML = "<br><br>Loading .....<img src='images/wait_animated.gif' />";
      
      
      
      	if (window.XMLHttpRequest)
      
      	{
      
      		xmlhttp = new XMLHttpRequest();
      
      	} else {
      
      		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      
      	}
      
      	xmlhttp.onreadystatechange = function()
      
      	{
      
      		if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
      
      		{
      
      			document.getElementById("inventory_preord_middle_div_" + tmpcnt).innerHTML = xmlhttp.responseText;
      
      		}
      
      	}
      
      
      
      	xmlhttp.open("GET", "gaylordstatus_childtable.php?box_id=" + box_id + "&wid=" + wid + "&tmpcnt=" + tmpcnt, true);
      
      	xmlhttp.send();
      
      }
      
      
      
      function show_supplier_expand_all(vendor_b2b_rescue) {
      
      	//alert(vendor_b2b_rescue);
      
      	var vid = new Array();
      
      	vid = vendor_b2b_rescue.split(",");
      
      	var text = "";
      
      	var i;
      
      	for (i = 0; i < vid.length; i++) {
      
      		//text += vid[i] + "\n";
      
      		var x = document.getElementById("supply" + vid[i]);
      
      
      
      		if (x.style.display == "none")
      
      		{
      
      			x.style.display = "block";
      
      			document.getElementById("supplier_total_row" + vid[i]).style.display = "none";
      
      		}
      
      
      
      	}
      
      	//alert(text);
      
      
      
      }
      
      function show_supplier_collapse_all(vendor_b2b_rescue) {
      
      	//alert(vendor_b2b_rescue);
      
      	var vid = new Array();
      
      	vid = vendor_b2b_rescue.split(",");
      
      	var text = "";
      
      	var i;
      
      	for (i = 0; i < vid.length; i++) {
      
      		//text += vid[i] + "\n";
      
      		var x = document.getElementById("supply" + vid[i]);
      
      
      
      		if (x.style.display == "block")
      
      		{
      
      			x.style.display = "none";
      
      			document.getElementById("supplier_total_row" + vid[i]).removeAttribute('style');
      
      		}
      
      
      
      	}
      
      	//alert(text);
      
      
      
      }
      
      //---------------------------------------------------------------------------------------------------------
      
      //
      
      function show_all_quotes(quote_id, companyID) {
      
      	var selectobject = document.getElementById("all_quote" + quote_id);
      
      	var n_left = f_getPosition(selectobject, 'Left');
      
      	var n_top = f_getPosition(selectobject, 'Top');
      
      	document.getElementById('light').style.left = n_left - 0 + 'px';
      
      	document.getElementById('light').style.top = n_top + 10 + 'px';
      
      	document.getElementById('light').style.width = 920 + 'px';
      
      	document.getElementById('light').style.height = 700 + 'px';
      
      	//
      
      	document.getElementById('light').style.display = 'block';
      
      	document.getElementById("light").innerHTML = "<br><br>Loading .....<img src='images/wait_animated.gif' />";
      
      
      
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
      
      			document.getElementById("light").innerHTML = "<a href='javascript:void(0)' onclick=document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'>Close</a> &nbsp;<center></center>" + xmlhttp.responseText;
      
      			document.getElementById('light').style.display = 'block';
      
      		}
      
      
      
      	}
      
      	xmlhttp.open("POST", "b2b_demand_summary_all_quotes.php?quote_id=" + quote_id + "&companyID=" + companyID + "&showallquotes=1", true);
      
      	xmlhttp.send();
      
      }
    </script>
  </head>
  <style type="text/css">
    .main_data_css {
    margin: 0 auto;
    /*width: 100%;*/
    height: auto;
    clear: both !important;
    padding-top: 35px;
    margin-left: 10px;
    margin-right: 10px;
    }
    .search input {
    height: 24px !important;
    }
    h2.boxtitle {
    font-size: 18px;
    font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
    margin-bottom: 4px;
    padding: 0px;
    color: #1E1E1E;
    }
  </style>
  <body>
    <?php include("inc/header.php"); ?>
    <div class="main_data_css">
      <div id="light" class="white_content"></div>
      <div id="fade" class="black_overlay"></div>
      <div class="dashboard_heading" style="float: left;">
        <div style="float: left;">
          B2B Supply Summary Report
          <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
            <span class="tooltiptext">This report shows the user all inventory that UCB has available to sell, presell, or even the potential to get...and sorts it by the annualized potential revenue. Thus, this report helps the user see the most valuable inventory items UCB has in it's entire supply pipeline.</span>
          </div>
          <div style="height: 13px;">&nbsp;</div>
        </div>
      </div>
      <?php
        $time = strtotime(Date('Y-m-d'));
        
        $st_friday = $time;
        
        $st_friday_last = date('m/d/Y', strtotime('-6 days', $st_friday));
        
        
        
        $st_thursday_last = Date('m/d/Y');
        
        //$st_friday_last = '01/01/2019';
        
        $in_dt_range = "no";
        
        if ($_REQUEST["date_from"] != "" && $_REQUEST["date_to"] != "") {
        
        	$date_from_val = date("Y-m-d", strtotime($_REQUEST["date_from"]));
        
        	$date_to_val_org = date("Y-m-d", strtotime($_REQUEST["date_to"]));
        
        	$date_to_val = date("Y-m-d", strtotime($_REQUEST["date_to"]));
        
        	$in_dt_range = "yes";
        
        	//
        
        } else {
        
        	if (isset($_REQUEST["warehouse_id"]) || isset($_REQUEST["inv_id"])) {
        
        		$in_dt_range = "no";
        
        		$date_from_val = date("Y-01-01", strtotime($st_friday_last));
        
        		$date_to_val_org = date("Y-m-d", strtotime($st_thursday_last));
        
        		$date_to_val = date("Y-m-d", strtotime($st_thursday_last));
        	} else {
        
        		$in_dt_range = "no";
        
        		$date_from_val = date("Y-m-d", strtotime($st_friday_last));
        
        		$date_to_val_org = date("Y-m-d", strtotime($st_thursday_last));
        
        		$date_to_val = date("Y-m-d", strtotime($st_thursday_last));
        	}
        }
        
        
        
        if (strpos($_SERVER['HTTP_REFERER'], "dashboardnew_account_pipeline.php")) {
        
        	$_REQUEST["employee"] = $_COOKIE['b2b_id'];
        }
        
        ?>
      <!-- <span style="font-size:18pt;">B2B Supply Summary</span>
        <h5>This report allows the user to see all inventory that UCB has available to sell, presell, or even the potential to get...and sorts it by the annualized potential revenue. Thus, this report helps the user see the most valuable inventory items UCB has in it's entire supply pipeline.</h5>
        
        -->
      <form method="post" name="inv_frm" action="report_b2b_supply_summary.php">
        <table border="0">
          <tr>
            <td>Employee</td>
            <td>
              <select id="employee" name="employee">
                <option value="~">All</option>
                <?php
                  db_b2b();

                  $getEmp = db_query("SELECT * FROM employees ORDER BY status asc, name asc");
                  
                  while ($rowsEmp = array_shift($getEmp)) {
                  
                  ?>
                <option <?php if (isset($_REQUEST["employee"]) && $rowsEmp["employeeID"] == $_REQUEST["employee"]) echo " selected ";  ?> value="<?php echo $rowsEmp["employeeID"]; ?>"><?php if ($rowsEmp["status"] != 'Active') {
                  echo $rowsEmp["name"] . "(Inactive)";
                  } else {
                  echo $rowsEmp["name"];
                  } ?></option>
                <?php
                  }
                  
                  ?>
              </select>
             </td>
            <td>
              Type:
            </td>
            <td>
              <select id="box_type" name="box_type">
                <option <?php if ($_REQUEST["box_type"] == "All") { ?>selected="selected" <?php } ?> value="All">All</option>
                <option <?php if ($_REQUEST["box_type"] == "Gaylord Totes") { ?>selected="selected" <?php } ?>>Gaylord Totes</option>
                <option <?php if ($_REQUEST["box_type"] == "Shipping Boxes") { ?>selected="selected" <?php } ?>>Shipping Boxes</option>
                <option <?php if ($_REQUEST["box_type"] == "Pallets") { ?>selected="selected" <?php } ?>>Pallets</option>
                <option <?php if ($_REQUEST["box_type"] == "Supersacks") { ?>selected="selected" <?php } ?>>Supersacks</option>
                <option <?php if ($_REQUEST["box_type"] == "Other") { ?>selected="selected" <?php } ?>>Other</option>
              </select>
            </td>
            <td width="10px;"></td>
            <td>
              Timing:
            </td>
            <td>
              <select name="g_timing" id="g_timing">
                <option value="1" <?php if ($_REQUEST["g_timing"] == "1") { ?>selected="selected" <?php } ?>>Rdy Now + Presell</option>
                <option <?php if ($_REQUEST["g_timing"] == "2") { ?>selected="selected" <?php } ?> value="2">FTL Rdy Now ONLY</option>
              </select>
            </td>
            <td width="10px;"></td>
            <td>
              Status:
            </td>
            <td>
              <select name="sort_g_tool" id="sort_g_tool">
                <option value="1" <?php if ($_REQUEST["sort_g_tool"] == "1") { ?>selected="selected" <?php } ?>>Available to Sell</option>
                <option value="2" <?php if ($_REQUEST["sort_g_tool"] == "2" || $_REQUEST["sort_g_tool"] == "") { ?>selected="selected" <?php } ?>>Available to Sell + Potential to Get</option>
              </select>
            </td>
            <td></td>
            <td><input type="submit" name="btntool" name="btntool" value="Submit"></td>
          </tr>
        </table>
      </form>
      <br>
      <?php if (isset($_REQUEST["btntool"])) { ?>
      <?php
        if (isset($_REQUEST["box_type"])) {
        
        	if ($_REQUEST["box_type"] == "Gaylord Totes") {
        
        		$box_type_arr = "'Gaylord','GaylordUCB', 'PresoldGaylord'";
        
        		$box_filter = "(inventory.box_type in (" . $box_type_arr . ")) and ";
        	} elseif ($_REQUEST["box_type"] == "Shipping Boxes") {
        
        		$box_type_arr = "'Box','Boxnonucb','Presold','Medium','Large','Xlarge','Boxnonucb'";
        
        		$box_filter = "(inventory.box_type in (" . $box_type_arr . ")) and ";
        	} elseif ($_REQUEST["box_type"] == "Pallets") {
        
        		$box_type_arr = "'PalletsUCB','PalletsnonUCB'";
        
        		$box_filter = "(inventory.box_type in (" . $box_type_arr . ")) and ";
        	} elseif ($_REQUEST["box_type"] == "Supersacks") {
        
        		$box_type_arr = "'SupersackUCB','SupersacknonUCB','Supersacks'";
        	} elseif ($_REQUEST["box_type"] == "Other") {
        
        		$box_type_arr = "'Other'";
        
        		$box_filter = "(inventory.box_type in (" . $box_type_arr . ")) and ";
        	}
        } else {
        
        	$box_type_arr = "";
        
        	$box_filter = "";
        }
        
        if (isset($_REQUEST["sort_g_tool"])) {
        
        	if ($_REQUEST["sort_g_tool"] == 1) {
        
        		$status_filter = "(b2b_status=1.0 or b2b_status=1.1 or b2b_status=1.2) AND ";
        	} elseif ($_REQUEST["sort_g_tool"] == 2) {
        
        		$status_filter = "(b2b_status=1.0 or b2b_status=1.1 or b2b_status=1.2 or b2b_status=2.0 or b2b_status=2.1 or b2b_status=2.2) AND ";
        	}
        } else {
        
        	$status_filter = "(b2b_status=1.0 or b2b_status=1.1 or b2b_status=1.2 or b2b_status=2.0 or b2b_status=2.1 or b2b_status=2.2) AND ";
        }
    
        db_b2b();

        $box_query = "SELECT * FROM inventory  WHERE " . $box_filter . "  " . $status_filter . " inventory.Active LIKE 'A' group by vendor_b2b_rescue ORDER BY vendor_b2b_rescue DESC";
        
        $act_inv_res = db_query($box_query);
        
        //echo tep_db_num_rows($act_inv_res);
        
        if (tep_db_num_rows($act_inv_res) > 0) {
        
        	$MGarray = array();
        	$MGarray_tot = array();
        	$_SESSION['sortarray'] = "";
        	$_SESSION['sortarray_tot'] = "";
        
        	while ($inv_rec = array_shift($act_inv_res)) {
        
        		$total_annual_amt = 0;
        		$total_expected_loads_per_mo = 0;
        
        		$vendor_b2b_rescue = $inv_rec["vendor_b2b_rescue"];

				db_b2b();

        		$inv_qry = "SELECT *, inventory.id AS I, inventory.lengthInch AS L, inventory.widthInch AS W, inventory.depthInch AS D, inventory.notes AS N, inventory.date AS DT FROM inventory  WHERE  " . $box_filter . "  " . $status_filter . " vendor_b2b_rescue='" . $vendor_b2b_rescue . "' order by vendor_b2b_rescue";
    
        		$inv_res = db_query($inv_qry);
        
        		while ($inv = array_shift($inv_res)) {
        
        			$annual_amt = 0;
        
        			$b2b_ulineDollar = round($inv["ulineDollar"]);
        
        			$b2b_ulineCents = $inv["ulineCents"];
        
        			$b2b_fob = $b2b_ulineDollar + $b2b_ulineCents;
        
        			$minfob = $b2b_fob;
        
        			$b2b_fob = "$" . number_format($b2b_fob, 2);
        
        
        
        			$b2b_costDollar = round($inv["costDollar"]);
        
        			$b2b_costCents = $inv["costCents"];
        
        			$b2b_cost = $b2b_costDollar + $b2b_costCents;
        
        			$b2bcost = $b2b_cost;
        
        			$b2b_cost = "$" . number_format($b2b_cost, 2);
        
        
        
        
        
        			//
        
        			$b2b_notes = $inv["N"];
        
        			$b2b_notes_date = $inv["DT"];
        
        			$invid = $inv["I"];
        
        			//
        
        			$bpallet_qty = 0;
        			$boxes_per_trailer = 0;
        			$box_type = "";
        			$loop_id = 0;
					
					db();

        			$qry_sku = "select id, sku, bpallet_qty, boxes_per_trailer, type, bwall from loop_boxes where b2b_id='" . $invid . "'";
        
        			//echo $qry_sku."<br>";
        
        			$sku = "";
        
        			$dt_view_sku = db_query($qry_sku);
        
        			while ($sku_val = array_shift($dt_view_sku)) {
        
        				$loop_id = $sku_val['id'];
        
        				$sku = $sku_val['sku'];
        
        				$bpallet_qty = $sku_val['bpallet_qty'];
        
        				$boxes_per_trailer = $sku_val['boxes_per_trailer'];
        
        				$box_type = $sku_val['type'];
        
        				$box_wall = $sku_val['bwall'];
        			}
        
        			//if ($inv["location_zip"] != "")		
        
        			//{
        
        			if ($inv["availability"] != "-3.5") {
        
        				$inv_id_list .= $inv["I"] . ",";
        			}
        
        			//To get the Actual PO, After PO
        
        			$rec_found_box = "n";
        
        			$actual_val = 0;
        			$after_po_val = 0;
        			$last_month_qty = 0;
        			$pallet_val = "";
        			$pallet_val_afterpo = "";
        
        			$tmp_noofpallet = 0;
        			$ware_house_boxdraw = "";
        			$preorder_txt = "";
        			$preorder_txt2 = "";
        			$box_warehouse_id = 0;
        			$next_load_available_date = "";
        
        
        
        			//
					db();

        			$qry_loc = "select id, box_warehouse_id,vendor_b2b_rescue, box_warehouse_id, next_load_available_date from loop_boxes where b2b_id=" . $inv["I"];
        
        			$dt_view = db_query($qry_loc);
        
        			while ($loc_res = array_shift($dt_view)) {
        
        				$box_warehouse_id = $loc_res["box_warehouse_id"];
        
        				$next_load_available_date = $loc_res["next_load_available_date"];
        
        
        
        				if ($loc_res["box_warehouse_id"] == "238") {
        
        					$vendor_b2b_rescue_id = $loc_res["vendor_b2b_rescue"];

							db_b2b();

        					$get_loc_qry = "Select * from companyInfo where loopid = " . $vendor_b2b_rescue_id;
        
        					$get_loc_res = db_query($get_loc_qry);
        
        					$loc_row = array_shift($get_loc_res);
        
        					$shipfrom_city = $loc_row["shipCity"];
        
        					$shipfrom_state = $loc_row["shipState"];
        
        					$shipfrom_zip = $loc_row["shipZip"];
        				} else {
        
        
        
        					$vendor_b2b_rescue_id = $loc_res["box_warehouse_id"];
							
							db();

        					$get_loc_qry = "Select * from loop_warehouse where id ='" . $vendor_b2b_rescue_id . "'";
        
        					$get_loc_res = db_query($get_loc_qry);
        
        					$loc_row = array_shift($get_loc_res);
        
        					$shipfrom_city = $loc_row["company_city"];
        
        					$shipfrom_state = $loc_row["company_state"];
        
        					$shipfrom_zip = $loc_row["company_zip"];
        				}
        			}
        
        			$ship_from  = $shipfrom_city . ", " . $shipfrom_state . " " . $shipfrom_zip;
        
        			//
        
        			$after_po_val_tmp = 0;
					
					db_b2b();

        			$dt_view_qry = "SELECT * from tmp_inventory_list_set2 where trans_id = " . $inv["loops_id"] . " order by warehouse, type_ofbox, Description";
        
        			$dt_view_res_box = db_query($dt_view_qry);
        
        			while ($dt_view_res_box_data = array_shift($dt_view_res_box)) {
        
        				$rec_found_box = "y";
        
        				$actual_val = $dt_view_res_box_data["actual"];
        
        				$after_po_val_tmp = $dt_view_res_box_data["afterpo"];
        
        				$last_month_qty = $dt_view_res_box_data["lastmonthqty"];
        
        				//
        
        			}
        
        			if ($rec_found_box == "n") {
        
        				$actual_val = $inv["actual_inventory"];
        
        				$after_po_val = $inv["after_actual_inventory"];
        
        				$last_month_qty = $inv["lastmonthqty"];
        			}
        
        
        
        			if ($box_warehouse_id == 238) {
        
        				$after_po_val = $inv["after_actual_inventory"];
        			} else {
        
        				if ($rec_found_box == "n") {
        
        					$after_po_val = $inv["after_actual_inventory"];
        				} else {
        
        					$after_po_val = $after_po_val_tmp;
        				}
        			}
        
        
        
        			$to_show_rec = "y";
        
        
        
        			if ($_REQUEST["g_timing"] == 2) {
        
        				$to_show_rec = "";
        
        				if ($after_po_val >= $boxes_per_trailer) {
        
        					$to_show_rec = "y";
        				}
        			}
        
        
        
        			//if ($sort_g_tool == 2){
        
        			//	$to_show_rec = "y";	
        
        			//}
        
        
        
        			if ($to_show_rec == "y") {
        
        				//account owner
        
        				if ($inv["vendor_b2b_rescue"] > 0) {
        
        
        
        					$vendor_b2b_rescue = $inv["vendor_b2b_rescue"];
							
							db();

        					$q1 = "SELECT id, company_name, b2bid FROM loop_warehouse where id = $vendor_b2b_rescue";
        
        					$query = db_query($q1);
        
        					while ($fetch = array_shift($query)) {
        
								db_b2b();

        						$comqry = "select *,employees.name as empname, employees.employeeID from companyInfo inner join employees on employees.employeeID=companyInfo.assignedto where companyInfo.id=" . $fetch["b2bid"];
        
        						$comres = db_query($comqry);
        
        						while ($comrow = array_shift($comres)) {
        
        							$ownername = $comrow["initials"];
        
        							$ownerStatus = $comrow["status"];
        
        							$empId = $comrow["employeeID"];
        						}
        					}
        				}
        
        				//
        
        				$vender_nm = "";
        				$vender_b2bid = 0;
        
        				if ($inv["vendor_b2b_rescue"] != "") {

							db();

        					$q1 = "SELECT * FROM loop_warehouse where id = " . $inv["vendor_b2b_rescue"];
        
        					$v_query = db_query($q1);
        
        					while ($v_fetch = array_shift($v_query)) {
        
        						$supplier_id = $v_fetch["b2bid"];
        
        						$vender_nm = getnickname($v_fetch['company_name'], $v_fetch["b2bid"]);
        
        						$vender_b2bid = $v_fetch["b2bid"];

								db_b2b();
								
        						$com_qry = db_query("select * from companyInfo where ID='" . $v_fetch["b2bid"] . "'");
        
        						$com_row = array_shift($com_qry);
        					}
        				}
        
        
        
        				//
        
        				if ($inv["lead_time"] <= 1) {
        
        					$lead_time = "Next Day";
        				} else {
        
        					$lead_time = $inv["lead_time"];
        				}
        
        
        
        				$estimated_next_load = "";
        				$b2bstatuscolor = "";
        
        				if ($box_warehouse_id == 238 && ($next_load_available_date != "" && $next_load_available_date != "0000-00-00")) {
        
        					//$next_load_available_date = $b2b_inv_row["next_load_available_date"];
        
        					//echo "next_load_available_date - " . $inv["I"] . " " . $next_load_available_date . " " . $inv["lead_time"] . "<br>";
        
        
        
        					//
        
        					$now_date = time(); // or your date as well
        
        					$next_load_date = strtotime($next_load_available_date);
        
        					$datediff = $next_load_date - $now_date;
        
        					$no_of_loaddays = round($datediff / (60 * 60 * 24));
        
        					//echo $no_of_loaddays;
        
        					if ($no_of_loaddays < $lead_time) {
        
        						if ($inv["lead_time"] > 1) {
        
        							$estimated_next_load = "<font color=green>" . $inv["lead_time"] . " Days</font>";
        						} else {
        
        							$estimated_next_load = "<font color=green>" . $inv["lead_time"] . " Day</font>";
        						}
        					} else {
        
        						$estimated_next_load = "<font color=green>" . $no_of_loaddays . " Days</font>";
        					}
        
        					//
        
        				} else {
        
        					if ($after_po_val >= $boxes_per_trailer) {
        
        						if ($inv["lead_time"] == 0) {
        
        							$estimated_next_load = "<font color=green>Now</font>";
        						}
        
        						if ($inv["lead_time"] == 1) {
        
        							$estimated_next_load = "<font color=green>" . $inv["lead_time"] . " Day</font>";
        						}
        
        						if ($inv["lead_time"] > 1) {
        
        							$estimated_next_load = "<font color=green>" . $inv["lead_time"] . " Days</font>";
        						}
        					} else {
        
        						if (($inv["expected_loads_per_mo"] <= 0) && ($after_po_val < $boxes_per_trailer)) {
        
        							$estimated_next_load = "<font color=red>Never (sell the " . $after_po_val . ")</font>";
        						} else {
        
        							// logic changed by Zac
        
        							$estimated_next_load = ceil((((($after_po_val / $boxes_per_trailer) * -1) + 1) / $inv["expected_loads_per_mo"]) * 4) . " Weeks";
        						}
        					}
        
        
        
        					if ($after_po_val == 0 && $inv["expected_loads_per_mo"] == 0) {
        
        						$estimated_next_load = "<font color=red>Ask Purch Rep</font>";
        					}
        
        
        
        					if ($inv["expected_loads_per_mo"] == 0) {
        
        						$expected_loads_per_mo = "<font color=red>0</font>";
        					} else {
        
        						$expected_loads_per_mo = $inv["expected_loads_per_mo"];
        					}
        				}
        
        				//							
        
        
        
        				$estimated_next_load = $inv["buy_now_load_can_ship_in"];
        
        
        
        				if ($inv["lead_time"] <= 1) {
        
        					$lead_time = "Next Day";
        				} else {
        
        					$lead_time = $inv["lead_time"] . " Days";
        				}
        
        
        
        				if ($inv["expected_loads_per_mo"] == 0) {
        
        					$expected_loads_per_mo = "<font color=red>0</font>";
        				} else {
        
        					$expected_loads_per_mo = $inv["expected_loads_per_mo"];
        				}
        
        				//
        
        				$b2b_status = $inv["b2b_status"];
        
						db();
        
        				$st_query = "select * from b2b_box_status where status_key='" . $b2b_status . "'";
        
        				$st_res = db_query($st_query);
        
        				$st_row = array_shift($st_res);
        
        				$b2bstatus_name = $st_row["box_status"];
        
        				if ($st_row["status_key"] == "1.0" || $st_row["status_key"] == "1.1" || $st_row["status_key"] == "1.2") {
        
        					$b2bstatuscolor = "green";
        				} elseif ($st_row["status_key"] == "2.0" || $st_row["status_key"] == "2.1" || $st_row["status_key"] == "2.2") {
        
        					$b2bstatuscolor = "orange";
        				}
        
        				//
        
        				if ($inv["box_urgent"] == 1) {
        
        					$b2bstatuscolor = "red";
        
        					$b2bstatus_name = "URGENT";
        				}
        
        				//
        
        				if ($inv["uniform_mixed_load"] == "Mixed") {
        
        					$blength = $inv["blength_min"] . " - " . $inv["blength_max"];
        
        					$bwidth = $inv["bwidth_min"] . " - " . $inv["bwidth_max"];
        
        					$bdepth = $inv["bheight_min"] . " - " . $inv["bheight_max"];
        				} else {
        
        					$blength = $inv["lengthInch"];
        
        					$bwidth = $inv["widthInch"];
        
        					$bdepth = $inv["depthInch"];
        				}
        
        				$blength_frac = 0;
        
        				$bwidth_frac = 0;
        
        				$bdepth_frac = 0;
        
        				//
        
        
        
        				$length = $blength;
        
        				$width = $bwidth;
        
        				$depth = $bdepth;
        
        
        
        				if ($inv["lengthFraction"] != "") {
        
        					$arr_length = explode("/", $inv["lengthFraction"]);
        
        					if (count($arr_length) > 0) {
        
        						$blength_frac = intval($arr_length[0]) / intval($arr_length[1]);
        
        						$length = floatval($blength + $blength_frac);
        					}
        				}
        
        				if ($inv["widthFraction"] != "") {
        
        					$arr_width = explode("/", $inv["widthFraction"]);
        
        					if (count($arr_width) > 0) {
        
        						$bwidth_frac = intval($arr_width[0]) / intval($arr_width[1]);
        
        						$width = floatval($bwidth + $bwidth_frac);
        					}
        				}
        
        				if ($inv["depthFraction"] != "") {
        
        					$arr_depth = explode("/", $inv["depthFraction"]);
        
        					if (count(arr_depth) > 0) {
        
        						$bdepth_frac = intval($arr_depth[0]) / intval($arr_depth[1]);
        
        						$depth = floatval($bdepth + $bdepth_frac);
        					}
        				}
        
        				$b_urgent = "No";
        				$contracted = "No";
        				$prepay = "No";
        				$ship_ltl = "No";
        
        				if ($inv["box_urgent"] == 1) {
        
        					$b_urgent = "Yes";
        				}
        
        				if ($inv["contracted"] == 1) {
        
        					$contracted = "Yes";
        				}
        
        				if ($inv["prepay"] == 1) {
        
        					$prepay = "Yes";
        				}
        
        				if ($inv["ship_ltl"] == 1) {
        
        					$ship_ltl = "Yes";
        				}
        
        				//
        
        				//echo $vender_nm."<br><br>";
        
        				$annual_amt = $inv["expected_loads_per_mo"] * $boxes_per_trailer * $minfob * 12;
        
        
        
        				$MGarray[] = array(
        					'after_po_val' => $after_po_val, 'pallet_val_afterpo' => $pallet_val_afterpo, 'boxes_per_trailer' => $boxes_per_trailer,
        
        					'preorder_txt2' => $preorder_txt2, 'estimated_next_load' => $estimated_next_load, 'expected_loads_per_mo' => $expected_loads_per_mo,
        
        					'boxes_per_trailer' => $boxes_per_trailer, 'b2b_fob' => $b2b_fob, 'b2bid' => $inv["I"], 'territory' => $territory, 'b2bstatus_name' => $b2bstatus_name,
        
        					'b2bstatuscolor' => $b2bstatuscolor, 'length' => $length, 'width' => $width, 'depth' => $depth, 'description' =>  $inv["description"], 'vendor_nm' => $vender_nm, 'vender_b2bid' => $vender_b2bid,
        
        					'ship_from' => $ship_from, 'ship_from2' => $ship_from2, 'ownername' => $ownername, 'b2b_notes' => $inv["N"], 'b2b_notes_date' => $inv["DT"], 'box_wall' => $box_wall, 'b_urgent' => $b_urgent, 'contracted' => $contracted, 'prepay' => $prepay, 'ship_ltl' => $ship_ltl, 'supplier_id' => $supplier_id, 'b2b_cost' => $b2b_cost,
        
        					'minfob' => $minfob,  'b2bcost' => $b2bcost, 'bpallet_qty' => $bpallet_qty, 'vendor_b2b_rescue_id' => $vendor_b2b_rescue_id, 'territory_sort' => $territory_sort, 'annual_amt' => $annual_amt, 'box_type' => $box_type, 'ownerStatus' => $ownerStatus, 'empId' => $empId
        				);
        
        				//
        
        				$total_annual_amt = $annual_amt + $total_annual_amt;
        
        				$total_expected_loads_per_mo = $expected_loads_per_mo + $total_expected_loads_per_mo;
        
        				//
        
        			}
        
        			//}
        
        		} //End while inv
        
        		$_SESSION['sortarray'] = $MGarray;
        
        		//
        
        		//echo $total_annual_amt."--".$total_expected_loads_per_mo."--".$vender_nm."--".$vendor_b2b_rescue."<br>";
        
        		//
        
        
        
        		//echo $total_annual_amt."<br><br>";
        
        
        
        		$MGarray_tot[] = array('total_annual_amt' => $total_annual_amt, 'vendor_b2b_rescue' => $vendor_b2b_rescue, 'total_expected_loads_per_mo' => $total_expected_loads_per_mo, 'vendor_nm' => $vender_nm, 'ship_from' => $ship_from, 'ownername' => $ownername, 'ownerStatus' => $ownerStatus, 'empId' => $empId);
        
        
        
        		$_SESSION['sortarray_tot'] = $MGarray_tot;
        	}
        } //check num rows >0
        
        //
        
        ?>
      <?php
        $MGArray_tot = $_SESSION['sortarray_tot'];
        
        $MGArray = $_SESSION['sortarray'];
        
        //
        
        $MGArraysort_I = array();
        
        foreach ($MGArray_tot as $MGArraytmp) {
        
        	$MGArraysort_I[] = $MGArraytmp['total_annual_amt'];
        }
        
        array_multisort($MGArraysort_I, SORT_DESC, SORT_NUMERIC, $MGArray_tot);

        //
        
        $srno = 0;
        
        foreach ($MGArray_tot as $MGArraytmp_ex) {
        
        	$vendor_id .= $MGArraytmp_ex["vendor_b2b_rescue"] . ",";
        }
        
        $vendor_ids = rtrim($vendor_id, ",");
        
        ?>
      <table cellSpacing="0" cellPadding="0" border="0" class="datatable" width="1400px">
        <tr>
          <td colspan="20px" align="center" class="qty_freq_title">Most Valuable Vendors <a href='#' onclick="show_supplier_expand_all('<?php echo $vendor_ids ?>'); return false;">Expand All</a> / <a href='#' onclick="show_supplier_collapse_all('<?php echo $vendor_ids ?>'); return false;">Collapse All</a></td>
        </tr>
        <tr>
          <td class='display_title' width="95px" align="center">Potential Revenue (Annual)</td>
          <!--<td class='display_title'>Actual</td>-->
          <td class='display_title' width="55px" align="center">Qty Avail</td>
          <td class='display_title' width="98px" align="center">Buy Now, Load Can Ship In</td>
          <td class='display_title' width="95px" align="center">Expected # of Loads/Mo</td>
          <td class='display_title' width="65px" align="center">Per Truckload</td>
          <td class='display_title' width="45px" align="center">MIN FOB</td>
          <td class='display_title' width="50px" align="center">B2B ID</td>
          <td class='display_title' width="70px" align="center">B2B Status</td>
          <td class='display_title' width="80px" align="center">Type</td>
          <td align="center" class='display_title' width="61px">L</td>
          <td align="center" class='display_title' width="10px">x</td>
          <td align="center" class='display_title' width="61px">W</td>
          <td align="center" class='display_title' width="10px">x</td>
          <td align="center" class='display_title' width="61px">H</td>
          <td class='display_title' width="120px" align="center">Description
          </td>
          <td class='display_title' width="100px" align="center">Supplier</td>
          <td class='display_title' width="90px" align="center">Ship From</td>
          <td class='display_title' width="80px" align="center">Supplier Relationship Owner</td>
        </tr>
        <?php
          $row = 0;
          
          //echo "<pre>"; print_r($MGArray_tot); echo "</pre>"; 
          
          
          
          if (isset($_REQUEST['employee'])) {
          
          	$srchEmpId = $_REQUEST['employee'];
          
          
          
          	foreach ($MGArray_tot as $k => $v) {
          
          		$newArr[$v['empId']][] = $v;
          	}
          
          	foreach ($newArr as $newArrKey => $newArrValue) {
          
          		if ($srchEmpId == $newArrKey) {
          
          			$newFinalArr = $newArrValue;
          		}
          	}
          
          	if ($_REQUEST['employee'] == '~') {
          
          		$finalArr = $MGArray_tot;
          	} else {
          
          		$finalArr = $newFinalArr;
          	}
          
          	foreach ($finalArr as $finalArrTemp) {
          
          		$finalArrTempSort[] = $finalArrTemp['total_annual_amt'];
          	}
          
          	array_multisort($finalArrTempSort, SORT_DESC, SORT_NUMERIC, $finalArr);
          
          
          
          	//echo "<hr>testing3.....<pre>"; print_r($finalArr); echo "</pre>"; exit();
          
          
          
          	foreach ($finalArr as $finalArrKey => $finalArrValue) {
          
          		$row = $row + 1;
          
          		if ($row_cnt == 0) {
          
          			$display_table_css = "display_table_tot";
          
          			$display_table_css_active = "display_table_tot_act";
          
          			$row_cnt = 1;
          		} else {
          
          			$row_cnt = 0;
          
          			$display_table_css = "display_table_tot_alt";
          
          			$display_table_css_active = "display_table_tot_act_alt";
          		}
          
          ?>
        <tr id='row_supply<?php echo $finalArrValue["vendor_b2b_rescue"]; ?>' style="height: 1px; ">
          <td colspan="20" style="height: 1px;">
            <div id='supply<?php echo $finalArrValue["vendor_b2b_rescue"]; ?>' style="width: 100%; display: none;">
              <table cellSpacing="0" cellPadding="0" border="0" class="innertable" width="100%">
                <?php
                  if ($row == 1) {
                  } else {
                  
                  ?>
                <tr>
                  <td colspan="20" style="background-color: #FFFFFF!important; border: none;"></td>
                </tr>
                <tr>
                  <td colspan="20" style="background-color: #FFFFFF!important; border: none;"></td>
                </tr>
                <?php
                  }
                  
                  $vendor_b2b_rescue = $finalArrValue["vendor_b2b_rescue"];
                  
                  //
                  db_b2b();

                  $inv_qry = "SELECT *, inventory.id AS I, inventory.lengthInch AS L, inventory.widthInch AS W, inventory.depthInch AS D, inventory.notes AS N, inventory.date AS DT FROM inventory  WHERE " . $box_filter . "  " . $status_filter . " vendor_b2b_rescue='" . $vendor_b2b_rescue . "' order by vendor_b2b_rescue";
                     
                  $inv_res = db_query($inv_qry);
                  
                  while ($inv = array_shift($inv_res)) {
                  
                  	$annual_amt = 0;
                  	$tmpTDstr = "";
                  
                  	$b2b_ulineDollar = round($inv["ulineDollar"]);
                  
                  	$b2b_ulineCents = $inv["ulineCents"];
                  
                  	$b2b_fob = $b2b_ulineDollar + $b2b_ulineCents;
                  
                  	$minfob = $b2b_fob;
                  
                  	$b2b_fob = "$" . number_format($b2b_fob, 2);
                  
                  
                  
                  	$b2b_costDollar = round($inv["costDollar"]);
                  
                  	$b2b_costCents = $inv["costCents"];
                  
                  	$b2b_cost = $b2b_costDollar + $b2b_costCents;
                  
                  	$b2bcost = $b2b_cost;
                  
                  	$b2b_cost = "$" . number_format($b2b_cost, 2);
                  
                  	//
                  
                  	$b2b_notes = $inv["N"];
                  
                  	$b2b_notes_date = $inv["DT"];
                  
                  	$invid = $inv["I"];
                  
                  	//
                  
                  	$bpallet_qty = 0;
                  	$boxes_per_trailer = 0;
                  	$box_type = "";
                  	$loop_id = 0;
					
					db();

                  	$qry_sku = "select id, sku, bpallet_qty, boxes_per_trailer, type, bwall from loop_boxes where b2b_id='" . $invid . "'";
                  
                  	//echo $qry_sku."<br>";
                  
                  	$sku = "";
                  
                  	$dt_view_sku = db_query($qry_sku);
                  
                  	while ($sku_val = array_shift($dt_view_sku)) {
                  
                  		$loop_id = $sku_val['id'];
                  
                  		$sku = $sku_val['sku'];
                  
                  		$bpallet_qty = $sku_val['bpallet_qty'];
                  
                  		$boxes_per_trailer = $sku_val['boxes_per_trailer'];
                  
                  		$box_type = $sku_val['type'];
                  
                  		$box_wall = $sku_val['bwall'];
                  	}
                  
                  	if ($inv["availability"] != "-3.5") {
                  
                  		$inv_id_list .= $inv["I"] . ",";
                  	}
                  
                  	//To get the Actual PO, After PO
                  
                  	$rec_found_box = "n";
                  
                  	$actual_val = 0;
                  	$after_po_val = 0;
                  	$last_month_qty = 0;
                  	$pallet_val = "";
                  	$pallet_val_afterpo = "";
                  
                  	$tmp_noofpallet = 0;
                  	$ware_house_boxdraw = "";
                  	$preorder_txt = "";
                  	$preorder_txt2 = "";
                  	$box_warehouse_id = 0;
                  	$next_load_available_date = "";
                  
                  	//
					db();

                  	$qry_loc = "select id, box_warehouse_id,vendor_b2b_rescue, box_warehouse_id, next_load_available_date from loop_boxes where b2b_id=" . $inv["I"];
                  
                  	$dt_view = db_query($qry_loc);
                  
                  	while ($loc_res = array_shift($dt_view)) {
                  
                  		$box_warehouse_id = $loc_res["box_warehouse_id"];
                  
                  		$next_load_available_date = $loc_res["next_load_available_date"];
                  
                  
                  
                  		if ($loc_res["box_warehouse_id"] == "238") {
                  
                  			$vendor_b2b_rescue_id = $loc_res["vendor_b2b_rescue"];

							db_b2b();

                  			$get_loc_qry = "Select * from companyInfo where loopid = " . $vendor_b2b_rescue_id;
                  
                  			$get_loc_res = db_query($get_loc_qry);
                  
                  			$loc_row = array_shift($get_loc_res);
                  
                  			$shipfrom_city = $loc_row["shipCity"];
                  
                  			$shipfrom_state = $loc_row["shipState"];
                  
                  			$shipfrom_zip = $loc_row["shipZip"];
                  		} else {
                  
                  			$vendor_b2b_rescue_id = $loc_res["box_warehouse_id"];
							
							db();

                  			$get_loc_qry = "Select * from loop_warehouse where id ='" . $vendor_b2b_rescue_id . "'";
                  
                  			$get_loc_res = db_query($get_loc_qry);
                  
                  			$loc_row = array_shift($get_loc_res);
                  
                  			$shipfrom_city = $loc_row["company_city"];
                  
                  			$shipfrom_state = $loc_row["company_state"];
                  
                  			$shipfrom_zip = $loc_row["company_zip"];
                  		}
                  	}
                  
                  	$ship_from  = $shipfrom_city . ", " . $shipfrom_state . " " . $shipfrom_zip;
                  
                  
                  
                  	//
                  
                  	$after_po_val_tmp = 0;

                  	db_b2b();

                  	$dt_view_qry = "SELECT * from tmp_inventory_list_set2 where trans_id = " . $inv["loops_id"] . " order by warehouse, type_ofbox, Description";
                  
                  	$dt_view_res_box = db_query($dt_view_qry);
                  
                  	while ($dt_view_res_box_data = array_shift($dt_view_res_box)) {
                  
                  		$rec_found_box = "y";
                  
                  		$actual_val = $dt_view_res_box_data["actual"];
                  
                  		$after_po_val_tmp = $dt_view_res_box_data["afterpo"];
                  
                  		$last_month_qty = $dt_view_res_box_data["lastmonthqty"];
                  
                  		//
                  
                  	}
                  
                  	if ($rec_found_box == "n") {
                  
                  		$actual_val = $inv["actual_inventory"];
                  
                  		$after_po_val = $inv["after_actual_inventory"];
                  
                  		$last_month_qty = $inv["lastmonthqty"];
                  	}
                  
                  
                  
                  	if ($box_warehouse_id == 238) {
                  
                  		$after_po_val = $inv["after_actual_inventory"];
                  	} else {
                  
                  		if ($rec_found_box == "n") {
                  
                  			$after_po_val = $inv["after_actual_inventory"];
                  		} else {
                  
                  			$after_po_val = $after_po_val_tmp;
                  		}
                  	}
                  
                  
                  
                  	$to_show_rec = "y";
                  
                  
                  
                  	if ($_REQUEST["g_timing"] == 2) {
                  
                  		$to_show_rec = "";
                  
                  		if ($after_po_val >= $boxes_per_trailer) {
                  
                  			$to_show_rec = "y";
                  		}
                  	}
                  
                  
                  
                  	//if ($sort_g_tool == 2){
                  
                  	//	$to_show_rec = "y";	
                  
                  	//}
                  
                  
                  
                  	if ($to_show_rec == "y") {
                  
                  		//account owner
                  
                  		if ($inv["vendor_b2b_rescue"] > 0) {
                  
                  
                  
                  			$vendor_b2b_rescue = $inv["vendor_b2b_rescue"];
							
							db();

                  			$q1 = "SELECT id, company_name, b2bid FROM loop_warehouse where id = $vendor_b2b_rescue";
                  
                  			$query = db_query($q1);
                  
                  			while ($fetch = array_shift($query)) {
                  				db_b2b();

                  				$comqry = "select *,employees.name as empname from companyInfo inner join employees on employees.employeeID=companyInfo.assignedto where employees.status='Active' and companyInfo.id=" . $fetch["b2bid"];
                  
                  				$comres = db_query($comqry);
                  
                  				while ($comrow = array_shift($comres)) {
                  
                  					$ownername = $comrow["initials"];
                  				}
                  			}
                  		}
                  
                  		$sales_order_qty = 0;

						db();
                  
                  		$dt_so = "SELECT loop_transaction_buyer.transaction_date, loop_salesorders.qty AS sumqty FROM loop_salesorders ";
                  
                  		$dt_so .= " INNER JOIN loop_transaction_buyer ON loop_transaction_buyer.id = loop_salesorders.trans_rec_id ";
                  
                  		$dt_so .= " WHERE loop_transaction_buyer.shipped = 0 and loop_salesorders.box_id = " . $inv["loops_id"] . " order by transaction_date desc limit 1";
                  
                  		$dt_res_so_item = db_query($dt_so);
                  
                  		while ($so_item_row = array_shift($dt_res_so_item)) {
                  
                  			$transaction_date = $so_item_row["transaction_date"];
                  
                  			if ($so_item_row["sumqty"] > 0) {
                  
                  				$sales_order_qty = $so_item_row["sumqty"];
                  			}
                  		}
                  
                  
                  
                  		//
                  
                  		$vender_nm = "";
                  		$vender_b2bid = 0;
                  
                  		if ($inv["vendor_b2b_rescue"] != "") {

							db();

                  			$q1 = "SELECT * FROM loop_warehouse where id = " . $inv["vendor_b2b_rescue"];
                  
                  			$v_query = db_query($q1);
                  
                  			while ($v_fetch = array_shift($v_query)) {
                  
                  				$supplier_id = $v_fetch["b2bid"];
                  
                  				$vender_nm = getnickname($v_fetch['company_name'], $v_fetch["b2bid"]);
                  
                  				$vender_b2bid = $v_fetch["b2bid"];
                  
                  				db_b2b();

                  				$com_qry = db_query("select * from companyInfo where ID='" . $v_fetch["b2bid"] . "'");
                  
                  				$com_row = array_shift($com_qry);
                  			}
                  		}
                  
                  
                  
                  		//
                  
                  		if ($inv["lead_time"] <= 1) {
                  
                  			$lead_time = "Next Day";
                  		} else {
                  
                  			$lead_time = $inv["lead_time"];
                  		}
                  
                  
                  
                  		$estimated_next_load = "";
                  		$b2bstatuscolor = "";
                  
                  		if ($box_warehouse_id == 238 && ($next_load_available_date != "" && $next_load_available_date != "0000-00-00")) {
                  
                  			//$next_load_available_date = $b2b_inv_row["next_load_available_date"];
                  
                  			//echo "next_load_available_date - " . $inv["I"] . " " . $next_load_available_date . " " . $inv["lead_time"] . "<br>";
                  
                  
                  
                  			//
                  
                  			$now_date = time(); // or your date as well
                  
                  			$next_load_date = strtotime($next_load_available_date);
                  
                  			$datediff = $next_load_date - $now_date;
                  
                  			$no_of_loaddays = round($datediff / (60 * 60 * 24));
                  
                  			//echo $no_of_loaddays;
                  
                  			if ($no_of_loaddays < $lead_time) {
                  
                  				if ($inv["lead_time"] > 1) {
                  
                  					$estimated_next_load = "<font color=green>" . $inv["lead_time"] . " Days</font>";
                  				} else {
                  
                  					$estimated_next_load = "<font color=green>" . $inv["lead_time"] . " Day</font>";
                  				}
                  			} else {
                  
                  				$estimated_next_load = "<font color=green>" . $no_of_loaddays . " Days</font>";
                  			}
                  
                  			//
                  
                  		} else {
                  
                  			if ($after_po_val >= $boxes_per_trailer) {
                  
                  				if ($inv["lead_time"] == 0) {
                  
                  					$estimated_next_load = "<font color=green>Now</font>";
                  				}
                  
                  				if ($inv["lead_time"] == 1) {
                  
                  					$estimated_next_load = "<font color=green>" . $inv["lead_time"] . " Day</font>";
                  				}
                  
                  				if ($inv["lead_time"] > 1) {
                  
                  					$estimated_next_load = "<font color=green>" . $inv["lead_time"] . " Days</font>";
                  				}
                  			} else {
                  
                  				if (($inv["expected_loads_per_mo"] <= 0) && ($after_po_val < $boxes_per_trailer)) {
                  
                  					$estimated_next_load = "<font color=red>Never (sell the " . $after_po_val . ")</font>";
                  				} else {
                  
                  					// logic changed by Zac
                  
                  					$estimated_next_load = ceil((((($after_po_val / $boxes_per_trailer) * -1) + 1) / $inv["expected_loads_per_mo"]) * 4) . " Weeks";
                  				}
                  			}
                  
                  
                  
                  			if ($after_po_val == 0 && $inv["expected_loads_per_mo"] == 0) {
                  
                  				$estimated_next_load = "<font color=red>Ask Purch Rep</font>";
                  			}
                  
                  
                  
                  			if ($inv["expected_loads_per_mo"] == 0) {
                  
                  				$expected_loads_per_mo = "<font color=red>0</font>";
                  			} else {
                  
                  				$expected_loads_per_mo = $inv["expected_loads_per_mo"];
                  			}
                  		}
                  
                  		//							
                  
                  		$estimated_next_load = $inv["buy_now_load_can_ship_in"];
                  
                  
                  
                  		if ($inv["lead_time"] <= 1) {
                  
                  			$lead_time = "Next Day";
                  		} else {
                  
                  			$lead_time = $inv["lead_time"] . " Days";
                  		}
                  
                  
                  
                  		if ($inv["expected_loads_per_mo"] == 0) {
                  
                  			$expected_loads_per_mo = "<font color=red>0</font>";
                  		} else {
                  
                  			$expected_loads_per_mo = $inv["expected_loads_per_mo"];
                  		}
                  
                  		//
                  
                  		$b2b_status = $inv["b2b_status"];
                  
						db();
                  
                  		$st_query = "select * from b2b_box_status where status_key='" . $b2b_status . "'";
                  
                  		$st_res = db_query($st_query);
                  
                  		$st_row = array_shift($st_res);
                  
                  		$b2bstatus_name = $st_row["box_status"];
                  
                  		if ($st_row["status_key"] == "1.0" || $st_row["status_key"] == "1.1" || $st_row["status_key"] == "1.2") {
                  
                  			$b2bstatuscolor = "green";
                  		} elseif ($st_row["status_key"] == "2.0" || $st_row["status_key"] == "2.1" || $st_row["status_key"] == "2.2") {
                  
                  			$b2bstatuscolor = "orange";
                  		}
                  
                  		//
                  
                  		if ($inv["box_urgent"] == 1) {
                  
                  			$b2bstatuscolor = "red";
                  
                  			$b2bstatus_name = "URGENT";
                  		}
                  
                  		//
                  
                  		if ($inv["uniform_mixed_load"] == "Mixed") {
                  
                  			$blength = $inv["blength_min"] . " - " . $inv["blength_max"];
                  
                  			$bwidth = $inv["bwidth_min"] . " - " . $inv["bwidth_max"];
                  
                  			$bdepth = $inv["bheight_min"] . " - " . $inv["bheight_max"];
                  		} else {
                  
                  			$blength = $inv["lengthInch"];
                  
                  			$bwidth = $inv["widthInch"];
                  
                  			$bdepth = $inv["depthInch"];
                  		}
                  
                  		$blength_frac = 0;
                  
                  		$bwidth_frac = 0;
                  
                  		$bdepth_frac = 0;
                  
                  		//
                  
                  
                  
                  		$length = $blength;
                  
                  		$width = $bwidth;
                  
                  		$depth = $bdepth;
                  
                  
                  
                  		if ($inv["lengthFraction"] != "") {
                  
                  			$arr_length = explode("/", $inv["lengthFraction"]);
                  
                  			if (count($arr_length) > 0) {
                  
                  				$blength_frac = intval($arr_length[0]) / intval($arr_length[1]);
                  
                  				$length = floatval($blength + $blength_frac);
                  			}
                  		}
                  
                  		if ($inv["widthFraction"] != "") {
                  
                  			$arr_width = explode("/", $inv["widthFraction"]);
                  
                  			if (count($arr_width) > 0) {
                  
                  				$bwidth_frac = intval($arr_width[0]) / intval($arr_width[1]);
                  
                  				$width = floatval($bwidth + $bwidth_frac);
                  			}
                  		}
                  
                  		if ($inv["depthFraction"] != "") {
							
                  			$arr_depth = explode("/", $inv["depthFraction"]);
                  
                  			if (count($arr_depth) > 0) {
                  
                  				$bdepth_frac = intval($arr_depth[0]) / intval($arr_depth[1]);
                  
                  				$depth = floatval($bdepth + $bdepth_frac);
                  			}
                  		}
                  
                  		$b_urgent = "No";
                  		$contracted = "No";
                  		$prepay = "No";
                  		$ship_ltl = "No";
                  
                  		if ($inv["box_urgent"] == 1) {
                  
                  			$b_urgent = "Yes";
                  		}
                  
                  		if ($inv["contracted"] == 1) {
                  
                  			$contracted = "Yes";
                  		}
                  
                  		if ($inv["prepay"] == 1) {
                  
                  			$prepay = "Yes";
                  		}
                  
                  		if ($inv["ship_ltl"] == 1) {
                  
                  			$ship_ltl = "Yes";
                  		}
                  
                  		//
                  
                  		//echo $vender_nm."<br><br>";
                  
                  		$annual_amt = $expected_loads_per_mo * $boxes_per_trailer * $minfob * 12;
                  
                  		//
                  
                  		$total_annual_amt = $annual_amt + $total_annual_amt;
                  
                  		$total_expected_loads_per_mo = $expected_loads_per_mo + $total_expected_loads_per_mo;
                  
                  		//-------------------------------------------------------------------------------
                  
                  		if ($row_cnts == 0) {
                  
                  			$display_innertable_css = "display_table";
                  
                  			$row_cnts = 1;
                  		} else {
                  
                  			$row_cnts = 0;
                  
                  			$display_innertable_css = "display_table_alt";
                  		}
                  
                  
                  
                  
                  
                  		$srno = $srno + 1;
                  
                  	?>
                <tr>
                  <td align='center' width="95px" class='<?php echo $display_innertable_css; ?>'>
                    $<?php echo number_format($annual_amt, 2); ?>
                    <?php if ($sales_order_qty > 0) { ?>
                    <div onclick="display_preoder_sel(<?php echo $srno; ?>, <?php echo $sales_order_qty; ?>, <?php echo $inv["loops_id"]; ?>, <?php echo $vendor_b2b_rescue_id; ?>)" style="cursor: pointer;">
                      <u>View</u>
                    </div>
                    <?php  } ?>
                  </td>
                  <td align='center' width="55px" class='<?php echo $display_innertable_css; ?>'><?php
                    if ($after_po_val < 0) {
                    
                    
                    
                    	if ($sales_order_qty > 0) {
                    	}
                    
                    	echo "<font color='blue'>" . number_format($after_po_val, 0) . $pallet_val_afterpo . $preorder_txt2;
                    } else if ($after_po_val >= $boxes_per_trailer) {
                    
                    
                    
                    	if ($sales_order_qty > 0) {
                    	}
                    
                    	echo "<font color='green'>" . number_format($after_po_val, 0) . $pallet_val_afterpo . $preorder_txt2;
                    } else {
                    
                    
                    
                    	if ($sales_order_qty > 0) {
                    	}
                    
                    	echo "<font color='black'>" . number_format($after_po_val, 0) . $pallet_val_afterpo . $preorder_txt2;
                    }
                    
                    ?></td>
                  <td width="85px" align='center' class='<?php echo $display_innertable_css; ?>'><?php echo $estimated_next_load; ?></td>
                  <td width="95px" align='center' class='<?php echo $display_innertable_css; ?>'><?php echo $expected_loads_per_mo; ?></td>
                  <td width="65px" align='center' class='<?php echo $display_innertable_css; ?>'><?php echo number_format($boxes_per_trailer, 0) ?></td>
                  <td width="45px" align='center' class='<?php echo $display_innertable_css; ?>'><?php echo $b2b_fob; ?></td>
                  <td width="50px" align='center' class='<?php echo $display_innertable_css; ?>'><?php echo $inv["I"]; ?></td>
                  <td width="70px" align='center' class='<?php echo $display_innertable_css; ?>'>
                    <font color="<?php echo $b2bstatuscolor; ?>"><?php echo $b2bstatus_name; ?></font>
                  </td>
                  <td width="80px" align='center' class='<?php echo $display_innertable_css; ?>'><?php echo $box_type; ?></td>
                  <td width="50px" align='center' class='<?php echo $display_innertable_css; ?>'><?php echo $length; ?></td>
                  <td width="10px" align='center' class='<?php echo $display_innertable_css; ?>'>x</td>
                  <td width="50px" align='center' class='<?php echo $display_innertable_css; ?>'><?php echo $width; ?></td>
                  <td width="10px" align='center' class='<?php echo $display_innertable_css; ?>'>x</td>
                  <td width="50px" align='center' class='<?php echo $display_innertable_css; ?>'><?php echo $depth; ?></td>
                  <td width="120px" align='center' class='<?php echo $display_innertable_css; ?>'><?php echo $inv["description"]; ?></td>
                  <td width="100px" align='center' class='<?php echo $display_innertable_css; ?>'><a target="_blank" href='viewCompany.php?ID=<?php echo $vender_b2bid; ?>'><?php echo $vender_nm; ?></a></td>
                  <td width="90px" align='center' class='<?php echo $display_innertable_css; ?>'><?php echo $ship_from; ?></td>
                  <td width="80px" align='center' class='<?php echo $display_innertable_css; ?>'><?php echo $ownername; ?></td>
                </tr>
                <?php if ($sales_order_qty > 0) { ?>
                <tr id='inventory_preord_top_<?php echo $srno; ?>' align="middle" style="display:none;">
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td colspan="9" style="font-size:xx-small; font-family: Arial, Helvetica, sans-serif; background-color: #FAFCDF; height: 16px">
                    <div id="inventory_preord_middle_div_<?php echo $srno; ?>"></div>
                  </td>
                </tr>
                <?php	} ?>
                <?php
                  }
                  } //End while inv
        
                  ?>
                <tr>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'>$<?php echo number_format($finalArrValue["total_annual_amt"]); ?></td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'></td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'></td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'>
                    <a href='#' onclick="show_supplier_details(<?php echo $finalArrValue["vendor_b2b_rescue"] ?>, <?php echo $row ?>); return false;"><?php echo $finalArrValue["total_expected_loads_per_mo"]; ?></a>
                  </td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'></td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'></td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'></td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'></td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'></td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'></td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'></td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'></td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'></td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'></td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'></td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'><?php echo $finalArrValue["vendor_nm"]; ?></td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'><?php echo $finalArrValue["ship_from"]; ?></td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'><?php echo $finalArrValue["ownername"]; ?></td>
                </tr>
              </table>
            </div>
          </td>
        </tr>
        <tr id="supplier_total_row<?php echo $finalArrValue["vendor_b2b_rescue"] ?>">
          <td align='center' class='<?php echo $display_table_css; ?>'>$<?php echo number_format($finalArrValue["total_annual_amt"], 2); ?></td>
          <td align='center' class='<?php echo $display_table_css; ?>'></td>
          <td align='center' class='<?php echo $display_table_css; ?>'></td>
          <td align='center' class='<?php echo $display_table_css; ?>'>
            <a href='#' onclick="show_supplier_details(<?php echo $finalArrValue["vendor_b2b_rescue"] ?>, <?php echo $row ?>); return false;"><?php echo $finalArrValue["total_expected_loads_per_mo"]; ?></a>
          </td>
          <td align='center' class='<?php echo $display_table_css; ?>'></td>
          <td align='center' class='<?php echo $display_table_css; ?>'></td>
          <td align='center' class='<?php echo $display_table_css; ?>'></td>
          <td align='center' class='<?php echo $display_table_css; ?>'></td>
          <td align='center' class='<?php echo $display_table_css; ?>'></td>
          <td align='center' class='<?php echo $display_table_css; ?>'></td>
          <td align='center' class='<?php echo $display_table_css; ?>'></td>
          <td align='center' class='<?php echo $display_table_css; ?>'></td>
          <td align='center' class='<?php echo $display_table_css; ?>'></td>
          <td align='center' class='<?php echo $display_table_css; ?>'></td>
          <td align='center' class='<?php echo $display_table_css; ?>'></td>
          <td align='center' class='<?php echo $display_table_css; ?>'><?php echo $finalArrValue["vendor_nm"]; ?></td>
          <td align='center' class='<?php echo $display_table_css; ?>'><?php echo $finalArrValue["ship_from"]; ?></td>
          <td align='center' class='<?php echo $display_table_css; ?>'><?php echo $finalArrValue["ownername"]; ?></td>
        </tr>
        <?php
          }
          } else {
          
          foreach ($MGArray_tot as $MGArraytmp2_tot) {
          
          	$row = $row + 1;
          
          	if ($row_cnt == 0) {
          
          		$display_table_css = "display_table_tot";
          
          		$display_table_css_active = "display_table_tot_act";
          
          		$row_cnt = 1;
          	} else {
          
          		$row_cnt = 0;
          
          		$display_table_css = "display_table_tot_alt";
          
          		$display_table_css_active = "display_table_tot_act_alt";
          	}
          
          ?>
        <tr id='row_supply<?php echo $MGArraytmp2_tot["vendor_b2b_rescue"]; ?>' style="height: 1px; ">
          <td colspan="20" style="height: 1px;">
            <div id='supply<?php echo $MGArraytmp2_tot["vendor_b2b_rescue"]; ?>' style="width: 100%; display: none;">
              <table cellSpacing="0" cellPadding="0" border="0" class="innertable" width="100%">
                <?php
                  if ($row == 1) {
                  } else {
                  
                  ?>
                <tr>
                  <td colspan="20" style="background-color: #FFFFFF!important; border: none;"></td>
                </tr>
                <tr>
                  <td colspan="20" style="background-color: #FFFFFF!important; border: none;"></td>
                </tr>
                <?php
                  }
                  
                  $vendor_b2b_rescue = $MGArraytmp2_tot["vendor_b2b_rescue"];
                  
                  //
                  db_b2b();

                  $inv_qry = "SELECT *, inventory.id AS I, inventory.lengthInch AS L, inventory.widthInch AS W, inventory.depthInch AS D, inventory.notes AS N, inventory.date AS DT FROM inventory  WHERE " . $box_filter . "  " . $status_filter . " vendor_b2b_rescue='" . $vendor_b2b_rescue . "' order by vendor_b2b_rescue";
                  
                  $inv_res = db_query($inv_qry);
                  
                  while ($inv = array_shift($inv_res)) {
                  
                  	$annual_amt = 0;
                  	$tmpTDstr = "";
                  
                  	$b2b_ulineDollar = round($inv["ulineDollar"]);
                  
                  	$b2b_ulineCents = $inv["ulineCents"];
                  
                  	$b2b_fob = $b2b_ulineDollar + $b2b_ulineCents;
                  
                  	$minfob = $b2b_fob;
                  
                  	$b2b_fob = "$" . number_format($b2b_fob, 2);
                  
                  
                  
                  	$b2b_costDollar = round($inv["costDollar"]);
                  
                  	$b2b_costCents = $inv["costCents"];
                  
                  	$b2b_cost = $b2b_costDollar + $b2b_costCents;
                  
                  	$b2bcost = $b2b_cost;
                  
                  	$b2b_cost = "$" . number_format($b2b_cost, 2);
                  
                  	//
                  
                  	$b2b_notes = $inv["N"];
                  
                  	$b2b_notes_date = $inv["DT"];
                  
                  	$invid = $inv["I"];
                  
                  	//
                  
                  	$bpallet_qty = 0;
                  	$boxes_per_trailer = 0;
                  	$box_type = "";
                  	$loop_id = 0;
					
					db();

                  	$qry_sku = "select id, sku, bpallet_qty, boxes_per_trailer, type, bwall from loop_boxes where b2b_id='" . $invid . "'";
                  
                  	//echo $qry_sku."<br>";
                  
                  	$sku = "";
                  
                  	$dt_view_sku = db_query($qry_sku);
                  
                  	while ($sku_val = array_shift($dt_view_sku)) {
                  
                  		$loop_id = $sku_val['id'];
                  
                  		$sku = $sku_val['sku'];
                  
                  		$bpallet_qty = $sku_val['bpallet_qty'];
                  
                  		$boxes_per_trailer = $sku_val['boxes_per_trailer'];
                  
                  		$box_type = $sku_val['type'];
                  
                  		$box_wall = $sku_val['bwall'];
                  	}
                  
                  	if ($inv["availability"] != "-3.5") {
                  
                  		$inv_id_list .= $inv["I"] . ",";
                  	}
                  
                  	//To get the Actual PO, After PO
                  
                  	$rec_found_box = "n";
                  
                  	$actual_val = 0;
                  	$after_po_val = 0;
                  	$last_month_qty = 0;
                  	$pallet_val = "";
                  	$pallet_val_afterpo = "";
                  
                  	$tmp_noofpallet = 0;
                  	$ware_house_boxdraw = "";
                  	$preorder_txt = "";
                  	$preorder_txt2 = "";
                  	$box_warehouse_id = 0;
                  	$next_load_available_date = "";
                  
					db();

                  	$qry_loc = "select id, box_warehouse_id,vendor_b2b_rescue, box_warehouse_id, next_load_available_date from loop_boxes where b2b_id=" . $inv["I"];
                  
                  	$dt_view = db_query($qry_loc);
                  
                  	while ($loc_res = array_shift($dt_view)) {
                  
                  		$box_warehouse_id = $loc_res["box_warehouse_id"];
                  
                  		$next_load_available_date = $loc_res["next_load_available_date"];
                  
                  
                  
                  		if ($loc_res["box_warehouse_id"] == "238") {
                  
                  			$vendor_b2b_rescue_id = $loc_res["vendor_b2b_rescue"];
							
							db_b2b();

                  			$get_loc_qry = "Select * from companyInfo where loopid = " . $vendor_b2b_rescue_id;
                  
                  			$get_loc_res = db_query($get_loc_qry);
                  
                  			$loc_row = array_shift($get_loc_res);
                  
                  			$shipfrom_city = $loc_row["shipCity"];
                  
                  			$shipfrom_state = $loc_row["shipState"];
                  
                  			$shipfrom_zip = $loc_row["shipZip"];
                  		} else {
                  
                  			$vendor_b2b_rescue_id = $loc_res["box_warehouse_id"];
							
							db();

                  			$get_loc_qry = "Select * from loop_warehouse where id ='" . $vendor_b2b_rescue_id . "'";
                  
                  			$get_loc_res = db_query($get_loc_qry);
                  
                  			$loc_row = array_shift($get_loc_res);
                  
                  			$shipfrom_city = $loc_row["company_city"];
                  
                  			$shipfrom_state = $loc_row["company_state"];
                  
                  			$shipfrom_zip = $loc_row["company_zip"];
                  		}
                  	}
                  
                  	$ship_from  = $shipfrom_city . ", " . $shipfrom_state . " " . $shipfrom_zip;
                  
                  
                  
                  	//
                  
                  	$after_po_val_tmp = 0;
                   	
					db_b2b();

                  	$dt_view_qry = "SELECT * from tmp_inventory_list_set2 where trans_id = " . $inv["loops_id"] . " order by warehouse, type_ofbox, Description";
                  
                  	$dt_view_res_box = db_query($dt_view_qry);
                  
                  	while ($dt_view_res_box_data = array_shift($dt_view_res_box)) {
                  
                  		$rec_found_box = "y";
                  
                  		$actual_val = $dt_view_res_box_data["actual"];
                  
                  		$after_po_val_tmp = $dt_view_res_box_data["afterpo"];
                  
                  		$last_month_qty = $dt_view_res_box_data["lastmonthqty"];
                  
                  		//
                  
                  	}
                  
                  	if ($rec_found_box == "n") {
                  
                  		$actual_val = $inv["actual_inventory"];
                  
                  		$after_po_val = $inv["after_actual_inventory"];
                  
                  		$last_month_qty = $inv["lastmonthqty"];
                  	}
                  
                  
                  
                  	if ($box_warehouse_id == 238) {
                  
                  		$after_po_val = $inv["after_actual_inventory"];
                  	} else {
                  
                  		if ($rec_found_box == "n") {
                  
                  			$after_po_val = $inv["after_actual_inventory"];
                  		} else {
                  
                  			$after_po_val = $after_po_val_tmp;
                  		}
                  	}
                  
                  
                  
                  	$to_show_rec = "y";
                  
                  
                  
                  	if ($_REQUEST["g_timing"] == 2) {
                  
                  		$to_show_rec = "";
                  
                  		if ($after_po_val >= $boxes_per_trailer) {
                  
                  			$to_show_rec = "y";
                  		}
                  	}
                  
                  
                  
                  	//if ($sort_g_tool == 2){
                  
                  	//	$to_show_rec = "y";	
                  
                  	//}
                  
                  
                  
                  	if ($to_show_rec == "y") {
                  
                  		//account owner
                  
                  		if ($inv["vendor_b2b_rescue"] > 0) {
                  
                  			$vendor_b2b_rescue = $inv["vendor_b2b_rescue"];
							
							db();

                  			$q1 = "SELECT id, company_name, b2bid FROM loop_warehouse where id = $vendor_b2b_rescue";
                  
                  			$query = db_query($q1);
                  
                  			while ($fetch = array_shift($query)) {
                  				db_b2b();

                  				$comqry = "select *,employees.name as empname from companyInfo inner join employees on employees.employeeID=companyInfo.assignedto where employees.status='Active' and companyInfo.id=" . $fetch["b2bid"];
                  
                  				$comres = db_query($comqry);
                  
                  				while ($comrow = array_shift($comres)) {
                  
                  					$ownername = $comrow["initials"];
                  				}
                  			}
                  		}
                  
                  		$sales_order_qty = 0;
						
						db();

                  		$dt_so = "SELECT loop_transaction_buyer.transaction_date, loop_salesorders.qty AS sumqty FROM loop_salesorders ";
                  
                  		$dt_so .= " INNER JOIN loop_transaction_buyer ON loop_transaction_buyer.id = loop_salesorders.trans_rec_id ";
                  
                  		$dt_so .= " WHERE loop_transaction_buyer.shipped = 0 and loop_salesorders.box_id = " . $inv["loops_id"] . " order by transaction_date desc limit 1";
                  
                  		$dt_res_so_item = db_query($dt_so);
                  
                  		while ($so_item_row = array_shift($dt_res_so_item)) {
                  
                  			$transaction_date = $so_item_row["transaction_date"];
                  
                  			if ($so_item_row["sumqty"] > 0) {
                  
                  				$sales_order_qty = $so_item_row["sumqty"];
                  			}
                  		}
                  
                  
                  
                  		//
                  
                  		$vender_nm = "";
                  		$vender_b2bid = 0;
                  
                  		if ($inv["vendor_b2b_rescue"] != "") {

							db();

                  			$q1 = "SELECT * FROM loop_warehouse where id = " . $inv["vendor_b2b_rescue"];
                  
                  			$v_query = db_query($q1);
                  
                  			while ($v_fetch = array_shift($v_query)) {
                  
                  				$supplier_id = $v_fetch["b2bid"];
                  
                  				$vender_nm = getnickname($v_fetch['company_name'], $v_fetch["b2bid"]);
                  
                  				$vender_b2bid = $v_fetch["b2bid"];
                  
                  
                  
                  				//$vender_nm = $v_fetch['company_name'];
                  
                  				//
                  				db_b2b();

                  				$com_qry = db_query("select * from companyInfo where ID='" . $v_fetch["b2bid"] . "'");
                  
                  				$com_row = array_shift($com_qry);
                  			}
                  		}
                  
                  
                  
                  		//
                  
                  		if ($inv["lead_time"] <= 1) {
                  
                  			$lead_time = "Next Day";
                  		} else {
                  
                  			$lead_time = $inv["lead_time"];
                  		}
                  
                  
                  
                  		$estimated_next_load = "";
                  		$b2bstatuscolor = "";
                  
                  		if ($box_warehouse_id == 238 && ($next_load_available_date != "" && $next_load_available_date != "0000-00-00")) {
                  
                  			//$next_load_available_date = $b2b_inv_row["next_load_available_date"];
                  
                  			//echo "next_load_available_date - " . $inv["I"] . " " . $next_load_available_date . " " . $inv["lead_time"] . "<br>";
                  
                  
                  
                  			//
                  
                  			$now_date = time(); // or your date as well
                  
                  			$next_load_date = strtotime($next_load_available_date);
                  
                  			$datediff = $next_load_date - $now_date;
                  
                  			$no_of_loaddays = round($datediff / (60 * 60 * 24));
                  
                  			//echo $no_of_loaddays;
                  
                  			if ($no_of_loaddays < $lead_time) {
                  
                  				if ($inv["lead_time"] > 1) {
                  
                  					$estimated_next_load = "<font color=green>" . $inv["lead_time"] . " Days</font>";
                  				} else {
                  
                  					$estimated_next_load = "<font color=green>" . $inv["lead_time"] . " Day</font>";
                  				}
                  			} else {
                  
                  				$estimated_next_load = "<font color=green>" . $no_of_loaddays . " Days</font>";
                  			}
                  
                  			//
                  
                  		} else {
                  
                  			if ($after_po_val >= $boxes_per_trailer) {
                  
                  				if ($inv["lead_time"] == 0) {
                  
                  					$estimated_next_load = "<font color=green>Now</font>";
                  				}
                  
                  				if ($inv["lead_time"] == 1) {
                  
                  					$estimated_next_load = "<font color=green>" . $inv["lead_time"] . " Day</font>";
                  				}
                  
                  				if ($inv["lead_time"] > 1) {
                  
                  					$estimated_next_load = "<font color=green>" . $inv["lead_time"] . " Days</font>";
                  				}
                  			} else {
                  
                  				if (($inv["expected_loads_per_mo"] <= 0) && ($after_po_val < $boxes_per_trailer)) {
                  
                  					$estimated_next_load = "<font color=red>Never (sell the " . $after_po_val . ")</font>";
                  				} else {
                  
                  					// logic changed by Zac
                  
                  					$estimated_next_load = ceil((((($after_po_val / $boxes_per_trailer) * -1) + 1) / $inv["expected_loads_per_mo"]) * 4) . " Weeks";
                  				}
                  			}
                  
                  
                  
                  			if ($after_po_val == 0 && $inv["expected_loads_per_mo"] == 0) {
                  
                  				$estimated_next_load = "<font color=red>Ask Purch Rep</font>";
                  			}
                  
                  
                  
                  			if ($inv["expected_loads_per_mo"] == 0) {
                  
                  				$expected_loads_per_mo = "<font color=red>0</font>";
                  			} else {
                  
                  				$expected_loads_per_mo = $inv["expected_loads_per_mo"];
                  			}
                  		}
                  
                  		//							
                  
                  		$estimated_next_load = $inv["buy_now_load_can_ship_in"];
                  
                  
                  
                  		if ($inv["lead_time"] <= 1) {
                  
                  			$lead_time = "Next Day";
                  		} else {
                  
                  			$lead_time = $inv["lead_time"] . " Days";
                  		}
                  
                  
                  
                  		if ($inv["expected_loads_per_mo"] == 0) {
                  
                  			$expected_loads_per_mo = "<font color=red>0</font>";
                  		} else {
                  
                  			$expected_loads_per_mo = $inv["expected_loads_per_mo"];
                  		}
                  
                  		//
                  
                  		$b2b_status = $inv["b2b_status"];
                  
						db();
                  
                  		$st_query = "select * from b2b_box_status where status_key='" . $b2b_status . "'";
                  
                  		$st_res = db_query($st_query);
                  
                  		$st_row = array_shift($st_res);
                  
                  		$b2bstatus_name = $st_row["box_status"];
                  
                  		if ($st_row["status_key"] == "1.0" || $st_row["status_key"] == "1.1" || $st_row["status_key"] == "1.2") {
                  
                  			$b2bstatuscolor = "green";
                  		} elseif ($st_row["status_key"] == "2.0" || $st_row["status_key"] == "2.1" || $st_row["status_key"] == "2.2") {
                  
                  			$b2bstatuscolor = "orange";
                  		}
                  
                  		//
                  
                  		if ($inv["box_urgent"] == 1) {
                  
                  			$b2bstatuscolor = "red";
                  
                  			$b2bstatus_name = "URGENT";
                  		}
                  
                  		//
                  
                  		if ($inv["uniform_mixed_load"] == "Mixed") {
                  
                  			$blength = $inv["blength_min"] . " - " . $inv["blength_max"];
                  
                  			$bwidth = $inv["bwidth_min"] . " - " . $inv["bwidth_max"];
                  
                  			$bdepth = $inv["bheight_min"] . " - " . $inv["bheight_max"];
                  		} else {
                  
                  			$blength = $inv["lengthInch"];
                  
                  			$bwidth = $inv["widthInch"];
                  
                  			$bdepth = $inv["depthInch"];
                  		}
                  
                  		$blength_frac = 0;
                  
                  		$bwidth_frac = 0;
                  
                  		$bdepth_frac = 0;
                  
                  		//
                  
                  
                  
                  		$length = $blength;
                  
                  		$width = $bwidth;
                  
                  		$depth = $bdepth;
                  
                  
                  
                  		if ($inv["lengthFraction"] != "") {
                  
                  			$arr_length = explode("/", $inv["lengthFraction"]);
                  
                  			if (count($arr_length) > 0) {
                  
                  				$blength_frac = intval($arr_length[0]) / intval($arr_length[1]);
                  
                  				$length = floatval($blength + $blength_frac);
                  			}
                  		}
                  
                  		if ($inv["widthFraction"] != "") {
                  
                  			$arr_width = explode("/", $inv["widthFraction"]);
                  
                  			if (count($arr_width) > 0) {
                  
                  				$bwidth_frac = intval($arr_width[0]) / intval($arr_width[1]);
                  
                  				$width = floatval($bwidth + $bwidth_frac);
                  			}
                  		}
                  
                  		if ($inv["depthFraction"] != "") {
                  
                  			$arr_depth = explode("/", $inv["depthFraction"]);
                  
                  			if (count($arr_depth) > 0) {
                  
                  				$bdepth_frac = intval($arr_depth[0]) / intval($arr_depth[1]);
                  
                  				$depth = floatval($bdepth + $bdepth_frac);
                  			}
                  		}
                  
                  		$b_urgent = "No";
                  		$contracted = "No";
                  		$prepay = "No";
                  		$ship_ltl = "No";
                  
                  		if ($inv["box_urgent"] == 1) {
                  
                  			$b_urgent = "Yes";
                  		}
                  
                  		if ($inv["contracted"] == 1) {
                  
                  			$contracted = "Yes";
                  		}
                  
                  		if ($inv["prepay"] == 1) {
                  
                  			$prepay = "Yes";
                  		}
                  
                  		if ($inv["ship_ltl"] == 1) {
                  
                  			$ship_ltl = "Yes";
                  		}
                  
                  		//
                  
                  		//echo $vender_nm."<br><br>";
                  
                  		$annual_amt = $expected_loads_per_mo * $boxes_per_trailer * $minfob * 12;
                  
                  		//
                  
                  		$total_annual_amt = $annual_amt + $total_annual_amt;
                  
                  		$total_expected_loads_per_mo = $expected_loads_per_mo + $total_expected_loads_per_mo;
                  
                  		//-------------------------------------------------------------------------------
                  
                  		if ($row_cnts == 0) {
                  
                  			$display_innertable_css = "display_table";
                  
                  			$row_cnts = 1;
                  		} else {
                  
                  			$row_cnts = 0;
                  
                  			$display_innertable_css = "display_table_alt";
                  		}
                  
                  
                  
                  
                  
                  		$srno = $srno + 1;
                  
                  	?>
                <tr>
                  <td align='center' width="95px" class='<?php echo $display_innertable_css; ?>'>
                    $<?php echo number_format($annual_amt, 2); ?>
                    <?php if ($sales_order_qty > 0) { ?>
                    <div onclick="display_preoder_sel(<?php echo $srno; ?>, <?php echo $sales_order_qty; ?>, <?php echo $inv["loops_id"]; ?>, <?php echo $vendor_b2b_rescue_id; ?>)" style="cursor: pointer;">
                      <u>View</u>
                    </div>
                    <?php  } ?>
                  </td>
                  <td align='center' width="55px" class='<?php echo $display_innertable_css; ?>'><?php
                    if ($after_po_val < 0) {
                    
                    
                    
                    	if ($sales_order_qty > 0) {
                    	}
                    
                    	echo "<font color='blue'>" . number_format($after_po_val, 0) . $pallet_val_afterpo . $preorder_txt2;
                    } else if ($after_po_val >= $boxes_per_trailer) {
                    
                    
                    
                    	if ($sales_order_qty > 0) {
                    	}
                    
                    	echo "<font color='green'>" . number_format($after_po_val, 0) . $pallet_val_afterpo . $preorder_txt2;
                    } else {
                    
                    
                    
                    	if ($sales_order_qty > 0) {
                    	}
                    
                    	echo "<font color='black'>" . number_format($after_po_val, 0) . $pallet_val_afterpo . $preorder_txt2;
                    }
                    
                    ?></td>
                  <td width="85px" align='center' class='<?php echo $display_innertable_css; ?>'><?php echo $estimated_next_load; ?></td>
                  <td width="95px" align='center' class='<?php echo $display_innertable_css; ?>'><?php echo $expected_loads_per_mo; ?></td>
                  <td width="65px" align='center' class='<?php echo $display_innertable_css; ?>'><?php echo number_format($boxes_per_trailer, 0) ?></td>
                  <td width="45px" align='center' class='<?php echo $display_innertable_css; ?>'><?php echo $b2b_fob; ?></td>
                  <td width="50px" align='center' class='<?php echo $display_innertable_css; ?>'><?php echo $inv["I"]; ?></td>
                  <td width="70px" align='center' class='<?php echo $display_innertable_css; ?>'>
                    <font color="<?php echo $b2bstatuscolor; ?>"><?php echo $b2bstatus_name; ?></font>
                  </td>
                  <td width="80px" align='center' class='<?php echo $display_innertable_css; ?>'><?php echo $box_type; ?></td>
                  <td width="50px" align='center' class='<?php echo $display_innertable_css; ?>'><?php echo $length; ?></td>
                  <td width="10px" align='center' class='<?php echo $display_innertable_css; ?>'>x</td>
                  <td width="50px" align='center' class='<?php echo $display_innertable_css; ?>'><?php echo $width; ?></td>
                  <td width="10px" align='center' class='<?php echo $display_innertable_css; ?>'>x</td>
                  <td width="50px" align='center' class='<?php echo $display_innertable_css; ?>'><?php echo $depth; ?></td>
                  <td width="120px" align='center' class='<?php echo $display_innertable_css; ?>'><?php echo $inv["description"]; ?></td>
                  <td width="100px" align='center' class='<?php echo $display_innertable_css; ?>'><a target="_blank" href='viewCompany.php?ID=<?php echo $vender_b2bid; ?>'><?php echo $vender_nm; ?></a></td>
                  <td width="90px" align='center' class='<?php echo $display_innertable_css; ?>'><?php echo $ship_from; ?></td>
                  <td width="80px" align='center' class='<?php echo $display_innertable_css; ?>'><?php echo $ownername; ?></td>
                </tr>
                <?php if ($sales_order_qty > 0) { ?>
                <tr id='inventory_preord_top_<?php echo $srno; ?>' align="middle" style="display:none;">
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td colspan="9" style="font-size:xx-small; font-family: Arial, Helvetica, sans-serif; background-color: #FAFCDF; height: 16px">
                    <div id="inventory_preord_middle_div_<?php echo $srno; ?>"></div>
                  </td>
                </tr>
                <?php	} ?>
                <?php
                  }
                  } //End while inv
                  
                  
                  
                  
                  
                  ?>
                <tr>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'>$<?php echo number_format($MGArraytmp2_tot["total_annual_amt"]); ?></td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'></td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'></td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'>
                    <a href='#' onclick="show_supplier_details(<?php echo $MGArraytmp2_tot["vendor_b2b_rescue"] ?>, <?php echo $row ?>); return false;"><?php echo $MGArraytmp2_tot["total_expected_loads_per_mo"]; ?></a>
                  </td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'></td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'></td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'></td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'></td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'></td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'></td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'></td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'></td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'></td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'></td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'></td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'><?php echo $MGArraytmp2_tot["vendor_nm"]; ?></td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'><?php echo $MGArraytmp2_tot["ship_from"]; ?></td>
                  <td align='center' class='<?php echo $display_table_css_active; ?>'><?php echo $MGArraytmp2_tot["ownername"]; ?></td>
                </tr>
              </table>
            </div>
          </td>
        </tr>
        <tr id="supplier_total_row<?php echo $MGArraytmp2_tot["vendor_b2b_rescue"] ?>">
          <td align='center' class='<?php echo $display_table_css; ?>'>$<?php echo number_format($MGArraytmp2_tot["total_annual_amt"], 2); ?></td>
          <td align='center' class='<?php echo $display_table_css; ?>'></td>
          <td align='center' class='<?php echo $display_table_css; ?>'></td>
          <td align='center' class='<?php echo $display_table_css; ?>'>
            <a href='#' onclick="show_supplier_details(<?php echo $MGArraytmp2_tot["vendor_b2b_rescue"] ?>, <?php echo $row ?>); return false;"><?php echo $MGArraytmp2_tot["total_expected_loads_per_mo"]; ?></a>
          </td>
          <td align='center' class='<?php echo $display_table_css; ?>'></td>
          <td align='center' class='<?php echo $display_table_css; ?>'></td>
          <td align='center' class='<?php echo $display_table_css; ?>'></td>
          <td align='center' class='<?php echo $display_table_css; ?>'></td>
          <td align='center' class='<?php echo $display_table_css; ?>'></td>
          <td align='center' class='<?php echo $display_table_css; ?>'></td>
          <td align='center' class='<?php echo $display_table_css; ?>'></td>
          <td align='center' class='<?php echo $display_table_css; ?>'></td>
          <td align='center' class='<?php echo $display_table_css; ?>'></td>
          <td align='center' class='<?php echo $display_table_css; ?>'></td>
          <td align='center' class='<?php echo $display_table_css; ?>'></td>
          <td align='center' class='<?php echo $display_table_css; ?>'><?php echo $MGArraytmp2_tot["vendor_nm"]; ?></td>
          <td align='center' class='<?php echo $display_table_css; ?>'><?php echo $MGArraytmp2_tot["ship_from"]; ?></td>
          <td align='center' class='<?php echo $display_table_css; ?>'><?php echo $MGArraytmp2_tot["ownername"]; ?></td>
        </tr>
        <?
          } //foreach ($MGArray_tot as $MGArraytmp2_tot) { close
          
          }
          
          //
          
          ?>
      </table>
      <?php
        } //End if isset(btntool)
        
        ?>
    </div>
  </body>
</html>
