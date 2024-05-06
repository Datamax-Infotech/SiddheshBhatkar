<?php
  require ("inc/header_session.php");
  require ("../mainfunctions/database.php");
  require ("../mainfunctions/general-functions.php");
  ?>
<html>
  <head>
    <title>Accounts Owned by Status Report - Multiple Status - Assigned company</title>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
    <LINK rel='stylesheet' type='text/css' href='css/ucb_common_style.css' >
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
      .nowrap_style{
      white-space: nowrap;
      }
    </style>
    <SCRIPT LANGUAGE="JavaScript" SRC="inc/general.js"></SCRIPT>
    <script LANGUAGE="JavaScript">
      function loadmainpg() 
      
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
      
      }
      
      
      
      function update_nextstep(tmpcnt, mainid, empid, sortfield, sortorder, id, show, gc)
      
      {
      
      	if (document.getElementById("txt_nextstep" + tmpcnt).value == "")
      
      	{
      
      		alert("Please enter the Next Step details.");
      
      		return;
      
      	}
      
      	document.getElementById("sp_op_div_int" + tmpcnt).style.display = 'block';
      
      	document.getElementById("sp_op_div_int" + tmpcnt).innerHTML = "<br><br>Loading .....<img src='images/wait_animated.gif' />"; 						
      
      	
      
      	var nextstep_data = escape(document.getElementById("txt_nextstep" + tmpcnt).value);
      
      	var nextcomm_data = document.getElementById("txt_nextcomm" + tmpcnt).value;
      
      	
      
      	//document.location = "special_ops_report_update_test.php?companyID=" + mainid + "&txt_nextcomm="+ nextcomm_data + "&txt_nextstep=" + nextstep_data+"&empid="+empid+ "&sortfield="+ sortfield + "&sortorder=" + sortorder ;
      
       
      
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
      
      			document.getElementById("sp_op_div" + tmpcnt).innerHTML = xmlhttp.responseText;
      
      			document.getElementById("sp_op_div_int" + tmpcnt).style.display = 'none';
      
      		}
      
      	}
      
      	
      
      	xmlhttp.open("GET","report_multiple_stat_update.php?companyID=" + mainid + "&txt_nextcomm="+ nextcomm_data + "&txt_nextstep=" + nextstep_data+"&empid="+empid+ "&sortfield="+ sortfield + "&sortorder=" + sortorder + "&id="+ id + "&show=" + show + "&gc=" + gc + "&tmpcnt="+ tmpcnt,true);
      
      	xmlhttp.send();
      
      	
      
      }
      
      
      
    </script>
    <SCRIPT LANGUAGE="JavaScript" SRC="inc/CalendarPopup.js"></SCRIPT>
    <script LANGUAGE="JavaScript">document.write(getCalendarStyles());</script>
    <script LANGUAGE="JavaScript">
      var cal1xx = new CalendarPopup("listdiv");
      
      
      
      cal1xx.showNavigationDropdowns();
      
    </script>
  </head>
  <body>
    <?php  include("inc/header.php"); ?>
    <div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>
    <div class="main_data_css">
      <div class="dashboard_heading" style="float: left;">
        <div style="float: left;">
          Accounts Owned by Status Report  
          <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
            <span class="tooltiptext">This report allows the user to see all company records (accounts) which are filters by account status.</span>
          </div>
          <br>
        </div>
      </div>
    
      <?php  
        $all_inactive_emp = "";
        
        $cnt_no = 0; 
        
        ?>
      <form method="post" name="reportmultiplestatus" >
        <table>
          <tr>
            <td>Select the Status:</td>
            <td>
              <select name="status_lst[]" id="status_lst[]" multiple>
                <option value="0">All Status</option>
                <?php 
                  $sql = "Select * from status order by sort_order";
                  db_b2b();
                  $result = db_query($sql);
                  
                  while ($myrowsel = array_shift($result)) {
                  
                  	echo "<option value=".$myrowsel["id"]." ";
                  
                  
                  
                  	if(isset($_REQUEST["status_lst"])) 
                  
                  	{ 
                  
                  		$status_id_arr1 = $_REQUEST['status_lst'];
                  
                  		foreach ($status_id_arr1 as $status_id_arr_tmp1)	
                  
                  		{
                  
                  			if ($myrowsel["id"] == $status_id_arr_tmp1) echo " selected ";
                  
                  		}
                  
                  	}
                  
                  	echo " >". $myrowsel["name"] . "</option>";
                  
                  }
                  
                  ?>
              </select>
            </td>
            <td>&nbsp;</td>
            <td>Select the employee:</td>
            <td>
              <select name="employee_lst" id="employee_lst">
                <option value="0">All employee</option>
                <?php 
                  $sql = "SELECT name, initials, employeeID FROM employees where status = 'Active' order by name" ;
                  db_b2b();
                  $result = db_query($sql);
                  
                  while ($myrowsel = array_shift($result)) {
                  
                  	echo "<option value=".$myrowsel["employeeID"]." ";
                  
                  
                  
                  	if(isset($_REQUEST["employee_lst"])) 
                  
                  	{ 
                  
                  		if ($myrowsel["employeeID"] == $_REQUEST["employee_lst"]) echo " selected ";
                  
                  	}
                  
                  	echo " >". $myrowsel["name"] . "</option>";
                  
                  }
                  
                  ?>
              </select>
            </td>
            <td>
              Include viewable by: <input type="checkbox" name="chk_include_viewable" id="chk_include_viewable" value="1" <?php  if ($_REQUEST["chk_include_viewable"] == "1") { echo " checked ";}?> ">
            </td>
            <td>
              <input type="submit" value="Run Report">
            </td>
          </tr>
        </table>
        <div ><i>Note: Please wait until you see <font color="red">"END OF REPORT"</font> at the bottom of the report, before using the sort option.</i></div>
        <?php 
          if (isset($_REQUEST["employee_lst"])){
          
          	$eid = $_REQUEST["employee_lst"];
          
              $status_id_arr = $_REQUEST['status_lst'];
          
          
          
          	$status_id = ""; $status_id_str = "";
          
          	foreach ($status_id_arr as $status_id_arr_tmp)	
          
          	{
          
          		$status_id = $status_id . $status_id_arr_tmp . ",";
          
          		$status_id_str = $status_id_str . "status_lst[]=" . $status_id_arr_tmp . "&";
          
          	}
          
          	if (trim($status_id) != "") {
          
          		$status_id= substr($status_id, 0, strlen($status_id)-1); 
          
          	}
          
          	if (trim($status_id_str) != "") {
          
          		$status_id_str= substr($status_id_str, 0, strlen($status_id_str)-1); 
          
          	}
          
          
          
          	//echo "LIMIT" . $limit;
          
          	/*if ($_REQUEST["so"] == "A") {
          
          		$so = "D"; 
          
          	} 	
          
          	else {	
          
          		$so = "A";
          
          	}*/
          
          
          
          	if ($_REQUEST["sk"] != "" )
          
          	{
          
          		if ($eid > 0) {
          
          			$tmp_sortorder = "";
          
          			if ($_REQUEST["sk"] == "dt") {
          
          				$tmp_sortorder = "companyInfo.dateCreated";
          
          			} elseif ($_REQUEST["sk"] == "age") {
          
          				$tmp_sortorder = "companyInfo.dateCreated";
          
          			} elseif ($_REQUEST["sk"] == "cname") {
          
          				$tmp_sortorder = "companyInfo.company";
          
          			} elseif ($_REQUEST["sk"] == "qty") {
          
          				$tmp_sortorder = "companyInfo.company";
          
          			} elseif ($_REQUEST["sk"] == "nname") {
          
          				$tmp_sortorder = "companyInfo.nickname";
          
          			} elseif ($_REQUEST["sk"] == "nd") {
          
          				$tmp_sortorder = "companyInfo.next_date";
          
          			} elseif ($_REQUEST["sk"] == "ns") {
          
          				$tmp_sortorder = "companyInfo.next_step";
          
          			} elseif ($_REQUEST["sk"] == "ei") {
          
          				$tmp_sortorder = "employees.initials";
          
          			} elseif ($_REQUEST["sk"] == "lc") {
          
          				$tmp_sortorder = "companyInfo.company";
          
          			}else{ 
          
          				$tmp_sortorder = "companyInfo." . $_REQUEST["sk"]; 
          
          			}
          
          			
          
          			if ($so == "A") {
          
          				$tmp_sort = "D"; 
          
          			} 	
          
          			else {	
          
          				$tmp_sort = "A";
          
          			}
          
          		}
          
          		
          
          		if ($_REQUEST["sk"] == "dt") {
          
          			$skey = " ORDER BY companyInfo.dateCreated";
          
          		} elseif ($_REQUEST["sk"] == "age") {
          
          			$skey = " ORDER BY companyInfo.dateCreated";
          
          		} elseif ($_REQUEST["sk"] == "contact") {
          
          			$skey = " ORDER BY companyInfo.contact";
          
          		} elseif ($_REQUEST["sk"] == "cname") {
          
          			$skey = " ORDER BY companyInfo.company";
          
          		} elseif ($_REQUEST["sk"] == "nname") {
          
          			$skey = " ORDER BY companyInfo.nickname";
          
          		} elseif ($_REQUEST["sk"] == "city") {
          
          			$skey = " ORDER BY companyInfo.city";
          
          		} elseif ($_REQUEST["sk"] == "state") {
          
          			$skey = " ORDER BY companyInfo.state";
          
          		} elseif ($_REQUEST["sk"] == "zip") {
          
          			$skey = " ORDER BY companyInfo.zip";
          
          		} elseif ($_REQUEST["sk"] == "nd") {
          
          			$skey = " ORDER BY companyInfo.next_date";
          
          		} elseif ($_REQUEST["sk"] == "ns") {
          
          			$skey = " ORDER BY companyInfo.next_step";
          
          		} elseif ($_REQUEST["sk"] == "ei") {
          
          			$skey = " ORDER BY employees.initials";
          
          		} elseif ($_REQUEST["sk"] == "lc") {
          
          			$skey = " ORDER BY companyInfo.last_date";
          
          		} elseif ($_REQUEST["sk"] == "viewable") {
          
          			$skey = " ORDER BY companyInfo.viewable1, companyInfo.viewable2, companyInfo.viewable3, companyInfo.viewable4";
          
          		}
          
          
          
          		/*if ($_REQUEST["so"] != "") {
          
          			if ($_REQUEST["so"] == "A") {
          
          				$sord = " ASC";
          
          			} Else {
          
          				$sord = " DESC";
          
          			}
          
          		} ELSE {
          
          			$sord = " DESC";
          
          		}*/
          
          		if ($_REQUEST["so"] != "") {
          
          			if ($_REQUEST["so"] == "A") {
          
          				$sord = " ASC";
          
          			} 
          
          			if ($_REQUEST["so"] == "D") {
          
          				$sord = " DESC";
          
          			}
          
          		} ELSE {
          
          			$sord = " DESC";
          
          		}
          
          	}
          
          	else
          
          	{
          
          		$skey = " ORDER BY companyInfo.dateCreated " ;
          
          		$sord = " DESC"; 
          
          	}
          
          
          
          	if ($status_id == 0) {
          
          		$dt_view_qry = "SELECT * FROM status ORDER BY sort_order";
          
          	}else {
          
          		$dt_view_qry = "SELECT * FROM status where id in (" . $status_id . ") ORDER BY sort_order";
          
          	}
        
			db_b2b();
          	$dt_view_res = db_query($dt_view_qry);
          
          	while ($row = array_shift($dt_view_res)) {
          
          	 
          
          		$x = "Select companyInfo.id AS I, viewable1, viewable2, viewable3, viewable4, companyInfo.loopid AS LID, companyInfo.contact AS C,  companyInfo.dateCreated AS D,  companyInfo.company AS CO, companyInfo.nickname AS NN, companyInfo.phone AS PH,  companyInfo.city AS CI,  companyInfo.state AS ST,  companyInfo.zip AS ZI, companyInfo.next_step AS NS, companyInfo.last_date AS LD, companyInfo.next_date AS ND, employees.initials AS EI, employees.employeeID from companyInfo LEFT OUTER JOIN employees ON companyInfo.assignedto = employees.employeeID Where companyInfo.status =" . $row["id"];
          
          		if ($eid == 0) {	
          
          			//$x = $x . " AND ( employees.status = 'Inactive' ) ";
          
          		}else {
          
          			$x = $x . " AND ( companyInfo.assignedto = " . $eid . ")";
          
          		}
          
          
          
          		if ($_REQUEST["chk_include_viewable"] == "1"){
          
          			$x = $x . " or ( companyInfo.viewable1 = '" . $eid . "' or companyInfo.viewable2 = '" . $eid . "'  or companyInfo.viewable3 = '" . $eid . "' or companyInfo.viewable4 = '" . $eid . "')";
          
          		}
          
          		
          
          		$x = $x . " GROUP BY companyInfo.id " . $skey . $sord . " ";
          
          		//echo "<br/>" . $x . "<br/><br/>";
          
          		if ($limit > 0 )
          
          		{
          
          			$xL = $x . " LIMIT 0, " . $limit;
					db_b2b();
          			$data_res = db_query($xL);
					db_b2b();
          			$data_res_No_Limit = db_query($x);
          
          			$show = "" . $limit;
          
          		} else
          
          		{
          
          
					db_b2b();
          			$data_res = db_query($x);
					db_b2b();
          			$data_res_No_Limit = db_query($x);
          
          			$show = "All";
          
          		}
          
          
          
          		if (tep_db_num_rows($data_res_No_Limit) > 0) {
          
          		?>
        <table width="1300" border="0" cellspacing="1" cellpadding="1">
        <tr align="center">
          <td colspan="14" bgcolor="#FFCCCC"><font face="Arial, Helvetica, sans-serif" size="2" color="#333333"><b><?php echo $row["name"] . " - Total Records: " . tep_db_num_rows($data_res_No_Limit) . " - Showing: "; ?>
            <?php  if ($limit > 0) {
              if ($limit > tep_db_num_rows($data_res_No_Limit)) { echo tep_db_num_rows($data_res_No_Limit); } else { echo $limit; }?> <a href="<?php echo htmlentities($_SERVER['PHP_SELF']. "?" . $_SERVER['QUERY_STRING'] . "&limit=all");?>">Show All</a>
            <?php  } else { ?>All<?php  } ?>
            </b></font>
          </td>
        </tr>
        <?php  if (1==1 OR $limit == 100000 ) { ?>
        <tr class="nowrap_style">
          <td width="5%" bgcolor="#D9F2FF">
            <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">DATE
            <a href="<?php echo htmlentities($_SERVER['PHP_SELF']."?sk=dt&so=A&". $status_id_str . "&employee_lst=$eid&show= ".$_REQUEST["show"]."&chk_include_viewable= ".$_REQUEST["chk_include_viewable"]."&statusid=".$_REQUEST["statusid"] . "&searchterm=".$_REQUEST["searchterm"]."&andor=".$_REQUEST["andor"]."&state=".$_REQUEST["state"] ); ?>"><img src='images/sort_asc.png' width='6px;' height='12px;'></a> 
            <a href="<?php echo htmlentities($_SERVER['PHP_SELF']."?sk=dt&so=D&". $status_id_str . "&employee_lst=$eid&show= ".$_REQUEST["show"]."&chk_include_viewable= ".$_REQUEST["chk_include_viewable"]."&statusid=".$_REQUEST["statusid"] . "&searchterm=".$_REQUEST["searchterm"]."&andor=".$_REQUEST["andor"]."&state=".$_REQUEST["state"] ); ?>"><img src='images/sort_desc.png' width='6px;' height='12px;'></a> 
            </font>
          </td>
          <td width="5%" bgcolor="#D9F2FF">
            <font size="1" face="Arial, Helvetica, sans-serif" color="#333333">
            AGE
            <a href="<?php echo htmlentities($_SERVER['PHP_SELF']. "?sk=age&so=A&". $status_id_str . "&employee_lst=$eid&show=".$_REQUEST["show"]."&chk_include_viewable= ".$_REQUEST["chk_include_viewable"]."&statusid=".$_REQUEST["statusid"]  . "&searchterm=".$_REQUEST["searchterm"]."&andor=".$_REQUEST["andor"]."&state=".$_REQUEST["state"]); ?>"><img src='images/sort_asc.png' width='6px;' height='12px;'></a>
            <a href="<?php echo htmlentities($_SERVER['PHP_SELF']. "?sk=age&so=D&". $status_id_str . "&employee_lst=$eid&show=".$_REQUEST["show"]."&chk_include_viewable= ".$_REQUEST["chk_include_viewable"]."&statusid=".$_REQUEST["statusid"]  . "&searchterm=".$_REQUEST["searchterm"]."&andor=".$_REQUEST["andor"]."&state=".$_REQUEST["state"]); ?>"><img src='images/sort_desc.png' width='6px;' height='12px;'></a>
            </font>
          </td>
          <td width="10%" bgcolor="#D9F2FF" align="center">
            <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            CONTACT
            <a href="<?php echo htmlentities($_SERVER['PHP_SELF']. "?sk=contact&so=A&". $status_id_str . "&employee_lst=$eid&show=".$_REQUEST["show"]."&chk_include_viewable= ".$_REQUEST["chk_include_viewable"]."&statusid=".$_REQUEST["statusid"]  . "&searchterm=".$_REQUEST["searchterm"]."&andor=".$_REQUEST["andor"]."&state=".$_REQUEST["state"]); ?>"><img src='images/sort_asc.png' width='6px;' height='12px;'></a>
            <a href="<?php echo htmlentities($_SERVER['PHP_SELF']. "?sk=contact&so=D&". $status_id_str."&employee_lst=$eid&show=".$_REQUEST["show"]."&chk_include_viewable= ".$_REQUEST["chk_include_viewable"]."&statusid=".$_REQUEST["statusid"]."&searchterm=".$_REQUEST["searchterm"]."&andor=".$_REQUEST["andor"]."&state=".$_REQUEST["state"]); ?>"><img src='images/sort_desc.png' width='6px;' height='12px;'></a>
            </font>
          </td>
          <td width="21%" bgcolor="#D9F2FF">
            <font size="1" face="Arial, Helvetica, sans-serif" color="#333333">
            COMPANY NAME
            <a href="<?php echo htmlentities($_SERVER['PHP_SELF']. "?sk=cname&so=A&". $status_id_str . "&employee_lst=$eid&show=".$_REQUEST["show"]."&chk_include_viewable= ".$_REQUEST["chk_include_viewable"]."&statusid=".$_REQUEST["statusid"] . "&searchterm=".$_REQUEST["searchterm"]."&andor=".$_REQUEST["andor"]."&state=".$_REQUEST["state"] ); ?>"><img src='images/sort_asc.png' width='6px;' height='12px;'></a>
            <a href="<?php echo htmlentities($_SERVER['PHP_SELF']. "?sk=cname&so=D&". $status_id_str . "&employee_lst=$eid&show=".$_REQUEST["show"]."&chk_include_viewable= ".$_REQUEST["chk_include_viewable"]."&statusid=".$_REQUEST["statusid"] . "&searchterm=".$_REQUEST["searchterm"]."&andor=".$_REQUEST["andor"]."&state=".$_REQUEST["state"] ); ?>"><img src='images/sort_desc.png' width='6px;' height='12px;'></a>
            </font>
          </td>
          <td width="8%" bgcolor="#D9F2FF">
            <font size="1" face="Arial, Helvetica, sans-serif" color="#333333">PHONE</font>
          </td>
          <td bgcolor="#D9F2FF" align="center">
            <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            CITY
            <a href="<?php echo htmlentities($_SERVER['PHP_SELF']. "?sk=city&so=A&". $status_id_str . "&employee_lst=$eid&show=".$_REQUEST["show"]."&chk_include_viewable= ".$_REQUEST["chk_include_viewable"]."&statusid=".$_REQUEST["statusid"]  . "&searchterm=".$_REQUEST["searchterm"]."&andor=".$_REQUEST["andor"]."&state=".$_REQUEST["state"]); ?>"><img src='images/sort_asc.png' width='6px;' height='12px;'></a>
            <a href="<?php echo htmlentities($_SERVER['PHP_SELF']. "?sk=city&so=D&". $status_id_str . "&employee_lst=$eid&show=".$_REQUEST["show"]."&chk_include_viewable= ".$_REQUEST["chk_include_viewable"]."&statusid=".$_REQUEST["statusid"]  . "&searchterm=".$_REQUEST["searchterm"]."&andor=".$_REQUEST["andor"]."&state=".$_REQUEST["state"]); ?>"><img src='images/sort_desc.png' width='6px;' height='12px;'></a>
            </font>
          </td>
          <td bgcolor="#D9F2FF" align="center">
            <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            STATE
            <a href="<?php echo htmlentities($_SERVER['PHP_SELF']. "?sk=state&so=A&". $status_id_str . "&employee_lst=$eid&show=".$_REQUEST["show"]."&chk_include_viewable= ".$_REQUEST["chk_include_viewable"]."&statusid=".$_REQUEST["statusid"]  . "&searchterm=".$_REQUEST["searchterm"]."&andor=".$_REQUEST["andor"]."&state=".$_REQUEST["state"]); ?>"><img src='images/sort_asc.png' width='6px;' height='12px;'></a>
            <a href="<?php echo htmlentities($_SERVER['PHP_SELF']. "?sk=state&so=D&". $status_id_str . "&employee_lst=$eid&show=".$_REQUEST["show"]."&chk_include_viewable= ".$_REQUEST["chk_include_viewable"]."&statusid=".$_REQUEST["statusid"]  . "&searchterm=".$_REQUEST["searchterm"]."&andor=".$_REQUEST["andor"]."&state=".$_REQUEST["state"]); ?>"><img src='images/sort_desc.png' width='6px;' height='12px;'></a>
            </font>
          </td>
          <td bgcolor="#D9F2FF" align="center">
            <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            ZIP
            <a href="<?php echo htmlentities($_SERVER['PHP_SELF']. "?sk=zip&so=A&". $status_id_str . "&employee_lst=$eid&show=".$_REQUEST["show"]."&chk_include_viewable= ".$_REQUEST["chk_include_viewable"]."&statusid=".$_REQUEST["statusid"]  . "&searchterm=".$_REQUEST["searchterm"]."&andor=".$_REQUEST["andor"]."&state=".$_REQUEST["state"]); ?>"><img src='images/sort_asc.png' width='6px;' height='12px;'></a>
            <a href="<?php echo htmlentities($_SERVER['PHP_SELF']. "?sk=zip&so=D&". $status_id_str . "&employee_lst=$eid&show=".$_REQUEST["show"]."&chk_include_viewable= ".$_REQUEST["chk_include_viewable"]."&statusid=".$_REQUEST["statusid"]  . "&searchterm=".$_REQUEST["searchterm"]."&andor=".$_REQUEST["andor"]."&state=".$_REQUEST["state"]); ?>"><img src='images/sort_desc.png' width='6px;' height='12px;'></a>
            </font>
          </td>
          <td bgcolor="#D9F2FF" align="center">
            <font size="1" face="Arial, Helvetica, sans-serif" color="#333333">
            Assigned To
            <a href="<?php echo htmlentities($_SERVER['PHP_SELF']. "?sk=ei&so=A&". $status_id_str . "&employee_lst=$eid&show=".$_REQUEST["show"]."&chk_include_viewable= ".$_REQUEST["chk_include_viewable"]."&statusid=".$_REQUEST["statusid"]  . "&searchterm=".$_REQUEST["searchterm"]."&andor=".$_REQUEST["andor"]."&state=".$_REQUEST["state"]); ?>"><img src='images/sort_asc.png' width='6px;' height='12px;'></a>
            <a href="<?php echo htmlentities($_SERVER['PHP_SELF']. "?sk=ei&so=D&". $status_id_str . "&employee_lst=$eid&show=".$_REQUEST["show"]."&chk_include_viewable= ".$_REQUEST["chk_include_viewable"]."&statusid=".$_REQUEST["statusid"]  . "&searchterm=".$_REQUEST["searchterm"]."&andor=".$_REQUEST["andor"]."&state=".$_REQUEST["state"]); ?>"><img src='images/sort_desc.png' width='6px;' height='12px;'></a>
            </font>
          </td>
          <td bgcolor="#D9F2FF" align="center">
            <font size="1" face="Arial, Helvetica, sans-serif" color="#333333">
            Viewable By
            <a href="<?php echo htmlentities($_SERVER['PHP_SELF']. "?sk=viewable&so=A&". $status_id_str . "&employee_lst=$eid&show=".$_REQUEST["show"]."&chk_include_viewable= ".$_REQUEST["chk_include_viewable"]."&statusid=".$_REQUEST["statusid"]  . "&searchterm=".$_REQUEST["searchterm"]."&andor=".$_REQUEST["andor"]."&state=".$_REQUEST["state"]); ?>"><img src='images/sort_asc.png' width='6px;' height='12px;'></a>
            <a href="<?php echo htmlentities($_SERVER['PHP_SELF']. "?sk=viewable&so=D&". $status_id_str . "&employee_lst=$eid&show=".$_REQUEST["show"]."&chk_include_viewable= ".$_REQUEST["chk_include_viewable"]."&statusid=".$_REQUEST["statusid"]  . "&searchterm=".$_REQUEST["searchterm"]."&andor=".$_REQUEST["andor"]."&state=".$_REQUEST["state"]); ?>"><img src='images/sort_desc.png' width='6px;' height='12px;'></a>
            </font>
          </td>
          <td bgcolor="#D9F2FF" align="center">
            <font size="1" face="Arial, Helvetica, sans-serif" color="#333333">
            Next Step
            <a href="<?php echo htmlentities($_SERVER['PHP_SELF']. "?sk=ns&so=A&". $status_id_str . "&employee_lst=$eid&show=".$_REQUEST["show"]."&chk_include_viewable= ".$_REQUEST["chk_include_viewable"]."&statusid=".$_REQUEST["statusid"]  . "&searchterm=".$_REQUEST["searchterm"]."&andor=".$_REQUEST["andor"]."&state=".$_REQUEST["state"]); ?>"><img src='images/sort_asc.png' width='6px;' height='12px;'></a>
            <a href="<?php echo htmlentities($_SERVER['PHP_SELF']. "?sk=ns&so=D&". $status_id_str . "&employee_lst=$eid&show=".$_REQUEST["show"]."&chk_include_viewable= ".$_REQUEST["chk_include_viewable"]."&statusid=".$_REQUEST["statusid"]  . "&searchterm=".$_REQUEST["searchterm"]."&andor=".$_REQUEST["andor"]."&state=".$_REQUEST["state"]); ?>"><img src='images/sort_desc.png' width='6px;' height='12px;'></a>
            </font>
          </td>
          <td bgcolor="#D9F2FF" align="center">
            <font size="1" face="Arial, Helvetica, sans-serif" color="#333333">
            Last<br>Communication
            <a href="<?php echo htmlentities($_SERVER['PHP_SELF']. "?sk=lc&so=A&". $status_id_str . "&employee_lst=$eid&show=".$_REQUEST["show"]."&chk_include_viewable= ".$_REQUEST["chk_include_viewable"]."&statusid=".$_REQUEST["statusid"]  . "&searchterm=".$_REQUEST["searchterm"]."&andor=".$_REQUEST["andor"]."&state=".$_REQUEST["state"]); ?>"><img src='images/sort_asc.png' width='6px;' height='12px;'></a>
            <a href="<?php echo htmlentities($_SERVER['PHP_SELF']. "?sk=lc&so=D&". $status_id_str . "&employee_lst=$eid&show=".$_REQUEST["show"]."&chk_include_viewable= ".$_REQUEST["chk_include_viewable"]."&statusid=".$_REQUEST["statusid"]  . "&searchterm=".$_REQUEST["searchterm"]."&andor=".$_REQUEST["andor"]."&state=".$_REQUEST["state"]); ?>"><img src='images/sort_desc.png' width='6px;' height='12px;'></a>
            </font>
          </td>
          <td bgcolor="#D9F2FF" align="center">
            <font size="1" face="Arial, Helvetica, sans-serif" color="#333333">
            Next Communication
            <a href="<?php echo htmlentities($_SERVER['PHP_SELF']. "?sk=nd&so=A&". $status_id_str . "&employee_lst=$eid&show=".$_REQUEST["show"]."&chk_include_viewable= ".$_REQUEST["chk_include_viewable"]."&statusid=".$_REQUEST["statusid"]  . "&searchterm=".$_REQUEST["searchterm"]."&andor=".$_REQUEST["andor"]."&state=".$_REQUEST["state"]); ?>"><img src='images/sort_asc.png' width='6px;' height='12px;'></a>
            <a href="<?php echo htmlentities($_SERVER['PHP_SELF']. "?sk=nd&so=D&". $status_id_str . "&employee_lst=$eid&show=".$_REQUEST["show"]."&chk_include_viewable= ".$_REQUEST["chk_include_viewable"]."&statusid=".$_REQUEST["statusid"]  . "&searchterm=".$_REQUEST["searchterm"]."&andor=".$_REQUEST["andor"]."&state=".$_REQUEST["state"]); ?>"><img src='images/sort_desc.png' width='6px;' height='12px;'></a>
            </font>
          </td>
          <td bgcolor="#D9F2FF" align="center">
            <font size="1" face="Arial, Helvetica, sans-serif" color="#333333">Save
          </td>
        </tr>
        <?php 
          $forbillto_sellto = ""; 
          
          while ($data = array_shift($data_res)) {
          
          	$forbillto_sellto = $forbillto_sellto  . $data["I"] . ", ";
          
          
          
          	$viewable_str = "";
          
          	$query2 = "Select initials from employees where employeeID = '" . $data["viewable1"] . "' or employeeID = '" . $data["viewable2"] . "' or employeeID = '" . $data["viewable3"] . "' or employeeID = '" . $data["viewable4"] . "'";	
          
          	//echo $query2 . "<br>";
          
          	$res2 = db_query($query2);
          
          	while ($row2 = array_shift($res2)){
          
          		$viewable_str = $viewable_str . $row2["initials"] . " ";
          
          	}
          
          	
          
          ?>
        <tr id="sp_op_div_int<?php echo $cnt_no?>" valign="middle" style="display:none;">
          <td colspan="12">&nbsp;
          <td>
        </tr>
        <tr id="sp_op_div<?php echo $cnt_no?>" valign="middle">
          <td width="5%" bgcolor="#E4E4E4"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php  if ($data["LID"] > 0) echo "<b>"; ?><?php echo timestamp_to_datetime($data["D"]); 
            ?></font></td>
          <td width="5%" bgcolor="#E4E4E4"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php  if ($data["LID"] > 0) echo "<b>"; ?><?php echo date_diff_new($data["D"], "NOW");
            ?> Days</font></td>
          <td width="10%" bgcolor="#E4E4E4" align="center"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php  if ($data["LID"] > 0) echo "<b>"; ?><?php echo $data["C"]?></font></td>
          <td width="21%" bgcolor="#E4E4E4"><a href="http://loops.usedcardboardboxes.com/viewCompany.php?ID=<?php echo $data["I"]?>" target="_blank"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php  if ($data["LID"] > 0) echo "<b>"; ?><?php  if ($data["NN"] != "" ) echo $data["NN"]; else echo $data["CO"]?><?php  if ($data["LID"] > 0) echo "</b>"; ?></font></a></td>
          <td width="3%" bgcolor="#E4E4E4"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php  if ($data["LID"] > 0) echo "<b>"; ?><?php echo $data["PH"]?></font></td>
          <td width="10%" bgcolor="#E4E4E4" align="center"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php  if ($data["LID"] > 0) echo "<b>"; ?><?php echo $data["CI"]?></font></td>
          <td width="5%" bgcolor="#E4E4E4" align="center"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php  if ($data["LID"] > 0) echo "<b>"; ?><?php echo $data["ST"]?></font></td>
          <td width="5%" bgcolor="#E4E4E4" align="center"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php  if ($data["LID"] > 0) echo "<b>"; ?><?php echo $data["ZI"]?></font></td>
          <td width="5%" bgcolor="#E4E4E4" align="center"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $data["EI"]?></font></td>
          <td width="5%" bgcolor="#E4E4E4" align="center"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $viewable_str?></font></td>
          <td width="10%" bgcolor="#E4E4E4" align="center">
            <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            <textarea type="text" cols="70" rows="3" id="txt_nextstep<?php echo $cnt_no?>" ><?php echo $data["NS"]?></textarea>
            </font>
          </td>
          <td width="10%" bgcolor="#E4E4E4" align="center"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php  if ($data["LID"] > 0) echo "<b>"; ?><?php if ($data["LD"]!="") echo date('m/d/Y',strtotime($data["LD"]));?>
          <td width="15%" <?php  if ($data["ND"] == date('Y-m-d')) { ?> bgcolor="#00FF00" <?php  } elseif ($data["ND"] < date('Y-m-d') && $data["ND"] != "") { ?> bgcolor="#FF0000" <?php  } else { ?> bgcolor="#E4E4E4"  <?php  } ?> align="center">
            <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            <input type="text" name="txt_nextcomm<?php echo $cnt_no?>" id="txt_nextcomm<?php echo $cnt_no?>" size="10" value="<?php if ($data["ND"]!="") echo date('m/d/Y',strtotime($data["ND"]));?>"/>
            </font>
            <a href="#" onclick="cal1xx.select(document.reportmultiplestatus.txt_nextcomm<?php echo $cnt_no?>,'anchor1xx<?php echo $cnt_no?>','MM/dd/yyyy'); return false;" name="anchor1xx<?php echo $cnt_no?>" id="anchor1xx<?php echo $cnt_no?>">
            <img border="0" src="images/calendar.jpg"></a> 
          </td>
          <td bgcolor="#E4E4E4" width="5%" align="center"><input style="cursor:pointer;" type="button" onclick="update_nextstep(<?php echo $cnt_no?>,<?php echo $data["I"]?>,<?php echo $data["employeeID"]?>, '<?php echo $_REQUEST["sk"]?>', '<?php echo $_REQUEST["so"]?>', <?php echo $row["id"]?>, '<?php echo $_REQUEST["show"]?>', '<?php echo $_REQUEST["gc"]?>');" value="Save"/></td>
        </tr>
        <?php 
          $cnt_no = $cnt_no + 1;
          
          } // of the inactive or reactive if
          
          ob_flush();
          
          }
          
          echo "</table><p></p>";
          
          }
          
          }?>
        <div ><i><font color="red">"END OF REPORT"</font></i></div>
        <?php 
          }
          
          ?>
      </form>
    </div>
  </body>
</html>
