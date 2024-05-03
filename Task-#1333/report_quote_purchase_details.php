<?php

    session_start();

  	require_once("inc/header_session.php");
	  require_once("mainfunctions/database.php");
  	require_once("mainfunctions/general-functions.php");
  
  	$quotes_archive_date = "";
  	db();
  	$query = "SELECT variablevalue FROM tblvariable where variablename = 'quotes_archive_date'";
  	$dt_view_res3 = db_query($query);
  
  	while ($objQuote = array_shift($dt_view_res3)) {
  		$quotes_archive_date = $objQuote["variablevalue"];
	}
  
?>
<!DOCTYPE html>
<html>
  <head>
    <title>B2B Quotes and Purchase Orders Summary Report</title>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
    <link rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>
    <link rel="stylesheet" type="text/css" href="css/new_header-dashboard.css" />
  </head>
  <script languages="JavaScript" src="inc/CalendarPopup.js"></script>
  <script languages="JavaScript" src="inc/general.js"></SCRIPT>
  <script languages="JavaScript">
    document.write(getCalendarStyles());
  </script>
  <script languages="JavaScript">
    var cal2xx = new CalendarPopup("listdiv");
    cal2xx.showNavigationDropdowns();
    
    function loadmainpg() {
    	var qnumber = document.getElementById('quotenumber').value;
    	if (qnumber != "") {
    		document.getElementById('date_from').value = "";
    		document.getElementById('date_to').value = "";
    		document.quotepoidform.submit();
    		return true;
    	} else {
    		var date_from = document.getElementById('date_from').value;
    		var date_to = document.getElementById('date_to').value;
    		var dformat1 = "yyyy-MM-dd";
    		var dformat2 = "yyyy-MM-dd";
    
    		if (date_from != "" && date_to != "") {
    			var chkdate1 = compareDates(date_from, dformat1, date_to, dformat2);
    			if (chkdate1 != 0) {
    				alert("'To Date' must be greater then 'From Date'");
    				return false;
    			}
    
    			if (chkdate1 == 0) {
    				document.getElementById('quotenumber').value = "";
    				document.quotepoform.submit();
    				return true;
    			}
    
    		}
    	}
    }
    
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
    
    
    function show_file_inviewer_pos(filename, formtype, ctrlnm) {
    	var filename2 = "https://loops.usedcardboardboxes.com/" + filename;
    
    	var selectobject = document.getElementById(ctrlnm);
    	var n_left = f_getPosition(selectobject, 'Left');
    	var n_top = f_getPosition(selectobject, 'Top');
    
    
    	document.getElementById("light").innerHTML = "<a href='javascript:void(0)' onclick=document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'>Close</a> &nbsp;<center>" + formtype + "</center><br/> <embed src='" + filename2 + "' width='800' height='800'>";
    	document.getElementById('light').style.left = 400 + 'px';
    	document.getElementById('light').style.top = (n_top + 10) + 'px';
    	document.getElementById('light').style.display = 'block';
    
    }
  </script>
  <style>
    .outer-container {
    width: 100%;
    margin: 0 auto;
    }
    .container {
    padding: 10px;
    }
    .content {
    margin: 10 auto;
    width: 100%;
    display: grid;
    }
    .txtstyle_color {
    font-family: arial;
    font-size: 13;
    font-weight: 700;
    height: 16px;
    background: #d6d6d6;
    color: #333333;
    text-align: center;
    }
    .datarow tr:hover td {
    background-color: #FFFFFF;
    }
    .rowstyle {
    padding: 0 5px;
    background-color: #EFEFEF;
    }
    .rowstyle2 {
    background-color: #FCC;
    }
    .center {
    text-align: center;
    }
    .left {
    text-align: left;
    }
    .right {
    text-align: right;
    }
    .white_content {
    display: none;
    position: absolute;
    top: 5%;
    left: 10%;
    width: 60%;
    height: 70%;
    padding: 16px;
    border: 1px solid gray;
    background-color: white;
    z-index: 99;
    overflow: auto;
    }

  </style>
  <body>
    <?php include("inc/header.php"); ?>
    <div class="main_data_css">
      <div id="light" class="white_content"> </div>
      <div class="dashboard_heading" style="float: left;">
        <div style="float: left;">B2B Quotes and Purchase Orders Summary Report</div>
        &nbsp;
        <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
          <span class="tooltiptext">This report shows the user all sales quotes and purchase orders generated, as well as details about each.</span>
        </div>
        <div style="height: 13px;">&nbsp;</div>
      </div>
      <?php
        if (!isset($_GET['date_from'])) {
        	$_REQUEST['date_from']	= date("Y-m-d", strtotime("-1 week"));
        	$_REQUEST['date_to']	= date("Y-m-d", strtotime("now"));
        	$_GET['quotesse'] = 1;
        }
        
        ?>
      <div class="container">
        <div class="content">
          <h2 style="margin:0;"><i>
            <?php
              if (isset($_GET['date_from'])) {
              	echo 'Showing Records for all Quotes and Purchase between dates ' . $_GET['date_from'] . ' ' . $_GET['date_to'];
              	$_GET['quotenumber'] = '';
              } else {
              	echo 'Showing Records for UCB Quote # ' . $_GET['quotenumber'];
              	$_GET['date_from'] = '';
              	$_GET['date_to'] = '';
              }
              ?>
            </i>
          </h2>
          <form method="get" name="quotepoform" id="quotepoform" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <table>
              <tr>
                <td style="white-space: nowrap;">
                  <div id="showcal">
                    Date from:
                    <input type="text" name="date_from" id="date_from" size="8" value="<?php echo isset($_REQUEST['date_from']) ? $_REQUEST['date_from'] : ''; ?>">
                    <a href="#" onclick="cal2xx.select(document.quotepoform.date_from,'dtanchor2xx','yyyy-MM-dd'); return false;" name="dtanchor2xx" id="dtanchor2xx"><img border="0" src="images/calendar.jpg"></a>
                    <div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>
                  </div>
                </td>
                <td>
                  <div id="showcal">
                    &emsp;To:
                    <input type="text" name="date_to" id="date_to" size="8" value="<?php echo isset($_REQUEST['date_to']) ? $_REQUEST['date_to'] : ''; ?>">
                    <a href="#" onclick="cal2xx.select(document.quotepoform.date_to,'dtanchor3xx','yyyy-MM-dd'); return false;" name="dtanchor3xx" id="dtanchor3xx"><img border="0" src="images/calendar.jpg"></a>
                    <div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>
                  </div>
                </td>
                <td>
                  <div style="padding:0 20px;">
                    <select name="quotesse" id="quotesse">
                      <option value="1" <?php echo (($_GET['quotesse'] == 1) ? 'selected' : ''); ?>>Quotes Only</option>
                      <option value="2" <?php echo (($_GET['quotesse'] == 2) ? 'selected' : ''); ?>>PO Only</option>
                      <option value="3" <?php echo (($_GET['quotesse'] == 3) ? 'selected' : ''); ?>>Both Quotes & PO</option>
                    </select>
                  </div>
                </td>
                <td>
                  <div style="padding:0 20px;">
                    <select name="quofilter" id="quofilter">
                      <option value="1" <?php echo (($_GET['quofilter'] == 1) ? 'selected' : ''); ?>>All</option>
                      <option value="2" <?php echo (($_GET['quofilter'] == 2) ? 'selected' : ''); ?>>Only Most Recent</option>
                    </select>
                  </div>
                </td>
                <td rowspan='3' valign="top">
                  <input type="hidden" id="reprun" name="reprun" value="yes">
                  <input type="hidden" id="date_tomorrow" value="<?php echo date("Y-m-j", strtotime("+1 day")); ?>">
                  <input type="button" value="Run Report" onClick="javascript: return loadmainpg()">
                </td>
              </tr>
              <tr>
                <td colspan="4" style="height:25px;">
                  <?php
                    $status_val = "";
                    db_b2b();
                    $dt_view_qry = "Select * from quote_status Where status=1 order by sort_order";
                    $dt_view_res = db_query($dt_view_qry);
                    while ($status_data = array_shift($dt_view_res)) {
                    	$status_val = $status_data["name"];
                    
                    	$temp_sel_val = "";
                    	if (isset($_REQUEST["reprun"])) {
                    	} else {
                    		$temp_sel_val = " checked ";
                    	}
                    
                    	if ($_REQUEST["chk_status_" . $status_data["qid"]] == 1) {
                    		$temp_sel_val = " checked ";
                    	}
                    	echo " <input type='checkbox' id='chk_status_" . $status_data["qid"] . "' name='chk_status_" . $status_data["qid"] . "' value=1 " . $temp_sel_val . " />" . $status_data["status_name"] . "";
                    }
                    
                    if ($_REQUEST["chk_status_3"] == 1) {
                    	$temp_sel_val = " checked ";
                    }
                    echo " <input type='checkbox' id='chk_status_3' name='chk_status_3' value=1 " . $temp_sel_val . " />Lost: Didn't Have Boxes";
                    if ($_REQUEST["chk_status_4"] == 1) {
                    	$temp_sel_val = " checked ";
                    }
                    echo " <input type='checkbox' id='chk_status_4' name='chk_status_4' value=1 " . $temp_sel_val . " />Lost: Too Expensive";
                    if ($_REQUEST["chk_status_6"] == 1) {
                    	$temp_sel_val = " checked ";
                    }
                    echo " <input type='checkbox' id='chk_status_6' name='chk_status_6' value=1 " . $temp_sel_val . " />Lost: Died on Vine";
                    
                    ?>
                </td>
              </tr>
              <tr>
                <td>
                  <label for "quotenumber"> Quote # (Only Numbers):</label>
                </td>
                <td colspan='3'>
          <form method="get" name="quotepoidform" id="quotepoidform" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <input type="number" value="" name="quotenumber" id="quotenumber">
          <input type="hidden" id="reprun" name="reprun" value="yes">
          </form>
          </td>
          </tr>
          </table>
          </form>
        </div>
        <br>
        <div class="content">
          <?php
            if (isset($_REQUEST['quotenumber'])) {
            	$sorturl = "report_quote_purchase_details.php?quotenumber" . $_REQUEST["quotenumber"];
            } else {
            	$sorturl = "report_quote_purchase_details.php?date_from=" . $_REQUEST["date_from"] . "&date_to=" . $_REQUEST["date_to"] . "&quotesse=" . $_REQUEST['quotesse'] . "&quofilter=" . $_REQUEST['quofilter'];
            }
            ?>
          <table class="datarow" cellSpacing='1' cellPadding='1' border='0'>
            <thead>
              <tr>
                <th width="100%" bgcolor="#C0CDDA" align="center" colspan="9">
                  <font face="Arial, Helvetica, sans-serif">QUOTES - PO GENERATED</font>
                </th>
              </tr>
              <tr>
                <th class='txtstyle_color' width='5%'>Sr. No.</th>
                <th class='txtstyle_color' width='5%'>Rep &nbsp;
                  <a href='<?php echo $sorturl; ?>&sort_order_pre=ASC&sort=rep'><img src='images/sort_asc.png' width='6px' height='12px'></a>&nbsp;
                  <a href='<?php echo $sorturl; ?>&sort_order_pre=DESC&sort=rep'><img src='images/sort_desc.png' width='6px' height='12px'></a>
                </th>
                <th class='txtstyle_color' width='25%'>Company Nickname &nbsp;
                  <a href='<?php echo $sorturl; ?>&sort_order_pre=ASC&sort=cname'><img src='images/sort_asc.png' width='6px' height='12px'></a>&nbsp;
                  <a href='<?php echo $sorturl; ?>&sort_order_pre=DESC&sort=cname'><img src='images/sort_desc.png' width='6px' height='12px'></a>
                </th>
                <th class='txtstyle_color' width='10%'>Quote Type&nbsp;
                  <a href='<?php echo $sorturl; ?>&sort_order_pre=ASC&sort=qtype'><img src='images/sort_asc.png' width='6px' height='12px'></a>&nbsp;
                  <a href='<?php echo $sorturl; ?>&sort_order_pre=DESC&sort=qtype'><img src='images/sort_desc.png' width='6px' height='12px'></a>
                </th>
                <th class='txtstyle_color' width='10%'>Quote #&nbsp;
                  <a href='<?php echo $sorturl; ?>&sort_order_pre=ASC&sort=rowsid'><img src='images/sort_asc.png' width='6px' height='12px'></a>&nbsp;
                  <a href='<?php echo $sorturl; ?>&sort_order_pre=DESC&sort=rowsid'><img src='images/sort_desc.png' width='6px' height='12px'></a>
                </th>
                <th class='txtstyle_color' width='10%'>Quote Date&nbsp;
                  <a href='<?php echo $sorturl; ?>&sort_order_pre=ASC&sort=qdate'><img src='images/sort_asc.png' width='6px' height='12px'></a>&nbsp;
                  <a href='<?php echo $sorturl; ?>&sort_order_pre=DESC&sort=qdate'><img src='images/sort_desc.png' width='6px' height='12px'></a>
                </th>
                <th class='txtstyle_color' width='10%'>Quote Amount&nbsp;
                  <a href='<?php echo $sorturl; ?>&sort_order_pre=ASC&sort=amount'><img src='images/sort_asc.png' width='6px' height='12px'></a>&nbsp;
                  <a href='<?php echo $sorturl; ?>&sort_order_pre=DESC&sort=amount'><img src='images/sort_desc.png' width='6px' height='12px'></a>
                </th>
                <th class='txtstyle_color' width='12%'>Status&nbsp;
                  <a href='<?php echo $sorturl; ?>&sort_order_pre=ASC&sort=statN'><img src='images/sort_asc.png' width='6px' height='12px'></a>&nbsp;
                  <a href='<?php echo $sorturl; ?>&sort_order_pre=DESC&sort=statN'><img src='images/sort_desc.png' width='6px' height='12px'></a>
                </th>
                <th class='txtstyle_color' width='10%'>Last Communication &nbsp;
                  <a href='<?php echo $sorturl; ?>&sort_order_pre=ASC&sort=lcomm'><img src='images/sort_asc.png' width='6px' height='12px'></a>&nbsp;
                  <a href='<?php echo $sorturl; ?>&sort_order_pre=DESC&sort=lcomm'><img src='images/sort_desc.png' width='6px' height='12px'></a>
                </th>
              </tr>
            </thead>
            <?php
              if (isset($_REQUEST["sort"])) {
              	$MGArray = $_SESSION['sortarrayn'];
              
              	if ($_GET['sort'] == "rep") {
              		$MGArraysort_I = array();
              		foreach ($MGArray as $MGArraytmp) {
              			$MGArraysort_I[] = $MGArraytmp['rep'];
              		}
              		if ($_GET['sort_order_pre'] == "ASC") {
              			array_multisort($MGArraysort_I, SORT_ASC, SORT_STRING, $MGArray);
              		}
              		if ($_GET['sort_order_pre'] == "DESC") {
              			array_multisort($MGArraysort_I, SORT_DESC, SORT_STRING, $MGArray);
              		}
              	}
              	if ($_GET['sort'] == "cname") {
              		$MGArraysort_I = array();
              		foreach ($MGArray as $MGArraytmp) {
              			$MGArraysort_I[] = $MGArraytmp['company_name'];
              		}
              		if ($_GET['sort_order_pre'] == "ASC") {
              			array_multisort($MGArraysort_I, SORT_ASC, SORT_STRING, $MGArray);
              		}
              		if ($_GET['sort_order_pre'] == "DESC") {
              			array_multisort($MGArraysort_I, SORT_DESC, SORT_STRING, $MGArray);
              		}
              	}
              	if ($_GET['sort'] == "rowsid") {
              		$MGArraysort_I = array();
              		foreach ($MGArray as $MGArraytmp) {
              			$MGArraysort_I[] = $MGArraytmp['rowid'];
              		}
              		if ($_GET['sort_order_pre'] == "ASC") {
              			array_multisort($MGArraysort_I, SORT_ASC, SORT_STRING, $MGArray);
              		}
              		if ($_GET['sort_order_pre'] == "DESC") {
              			array_multisort($MGArraysort_I, SORT_DESC, SORT_STRING, $MGArray);
              		}
              	}
              	if ($_GET['sort'] == "qtype") {
              		$MGArraysort_I = array();
              		foreach ($MGArray as $MGArraytmp) {
              			$MGArraysort_I[] = $MGArraytmp['qtype'];
              		}
              		if ($_GET['sort_order_pre'] == "ASC") {
              			array_multisort($MGArraysort_I, SORT_ASC, SORT_STRING, $MGArray);
              		}
              		if ($_GET['sort_order_pre'] == "DESC") {
              			array_multisort($MGArraysort_I, SORT_DESC, SORT_STRING, $MGArray);
              		}
              	}
              
              	if ($_GET['sort'] == "amount") {
              		$MGArraysort_I = array();
              		foreach ($MGArray as $MGArraytmp) {
              			$MGArraysort_I[] = $MGArraytmp['qamt'];
              		}
              		if ($_GET['sort_order_pre'] == "ASC") {
              			array_multisort($MGArraysort_I, SORT_ASC, SORT_NUMERIC, $MGArray);
              		}
              		if ($_GET['sort_order_pre'] == "DESC") {
              			array_multisort($MGArraysort_I, SORT_DESC, SORT_NUMERIC, $MGArray);
              		}
              	}
              	if ($_GET['sort'] == "qdate") {
              		$MGArraysort_I = array();
              		foreach ($MGArray as $MGArraytmp) {
              			$MGArraysort_I[] = $MGArraytmp['qdate'];
              		}
              		if ($_GET['sort_order_pre'] == "ASC") {
              			array_multisort($MGArraysort_I, SORT_ASC, SORT_STRING, $MGArray);
              		}
              		if ($_GET['sort_order_pre'] == "DESC") {
              			array_multisort($MGArraysort_I, SORT_DESC, SORT_STRING, $MGArray);
              		}
              	}
              	if ($_GET['sort'] == "statN") {
              		$MGArraysort_I = array();
              		foreach ($MGArray as $MGArraytmp) {
              			$MGArraysort_I[] = $MGArraytmp['statN'];
              		}
              		if ($_GET['sort_order_pre'] == "ASC") {
              			array_multisort($MGArraysort_I, SORT_ASC, SORT_STRING, $MGArray);
              		}
              		if ($_GET['sort_order_pre'] == "DESC") {
              			array_multisort($MGArraysort_I, SORT_DESC, SORT_STRING, $MGArray);
              		}
              	}
              	if ($_GET['sort'] == "lcomm") {
              		$MGArraysort_I = array();
              		foreach ($MGArray as $MGArraytmp) {
              			$MGArraysort_I[] = $MGArraytmp['lcomm'];
              		}
              		if ($_GET['sort_order_pre'] == "ASC") {
              			array_multisort($MGArraysort_I, SORT_ASC, SORT_STRING, $MGArray);
              		}
              		if ($_GET['sort_order_pre'] == "DESC") {
              			array_multisort($MGArraysort_I, SORT_DESC, SORT_STRING, $MGArray);
              		}
              	}
              	foreach ($MGArray as $MGArraytmp2) {
              		if ($MGArraytmp2["rowid"] != "") {
              
              
              ?>
            <tr>
              <td class='rowstyle center <?php echo $MGArraytmp2['col_code']; ?>'><?php echo (++$slno); ?></td>
              <td class='rowstyle center <?php echo $MGArraytmp2['col_code']; ?>'><?php echo $MGArraytmp2['rep']; ?></td>
              <td class='rowstyle <?php echo $MGArraytmp2['col_code']; ?>'><a target='_blank' href='viewCompany.php?ID=<?php echo $MGArraytmp2['company_id']; ?>&show=&warehouse_id=&rec_type=&proc=&searchcrit=&id=&rec_id=&display='><?php echo $MGArraytmp2['company_name']; ?></a></td>
              <td class='rowstyle center <?php echo $MGArraytmp2['col_code']; ?>'>
                <?php
                  $archeive_date = new DateTime(date("Y-m-d", strtotime($quotes_archive_date)));
                  $quote_date = new DateTime(date("Y-m-d", strtotime($MGArraytmp2["qdate"])));
                  
                  if ($quote_date < $archeive_date) {
                  ?>
                <a target="_blank" id='quotespdfs<?php echo $MGArraytmp2["rowid"] ?>' href='https://usedcardboardboxes.sharepoint.com/:b:/r/sites/LoopsCRMEmailAttachments/Shared%20Documents/quotes/before_oct_18_2022/<?php echo $MGArraytmp2["filename"]; ?>'><?php echo $MGArraytmp2["rowid"] ?></a>
                <?php
                  } else {
                  ?>
                <a href='#' id='quotespdfs<?php echo $MGArraytmp2["rowid"] ?>' onclick="show_file_inviewer_pos('quotes/<?php echo $MGArraytmp2["filename"]; ?>', 'Quote', 'quotespdfs<?php echo $MGArraytmp2["rowid"] ?>','iframe_tbl_generate'); return false;"><?php echo $MGArraytmp2["rowid"] ?></a>
                <?php
                  }
                  ?>
              </td>
              <td class='rowstyle center <?php echo $MGArraytmp2['col_code']; ?>'><?php echo $MGArraytmp2["rowid"]; ?></td>
              <td class='rowstyle center <?php echo $MGArraytmp2['col_code']; ?>'><?php echo $MGArraytmp2['qdate']; ?></td>
              <td class='rowstyle <?php echo $MGArraytmp2['col_code']; ?>' align='right'>$<?php echonumber_format($MGArraytmp2['qamt'], 2); ?></td>
              <td class='rowstyle center <?php echo $MGArraytmp2['col_code']; ?>'><?php echo $MGArraytmp2['statN']; ?></td>
              <td class='rowstyle center <?php echo $MGArraytmp2['col_code']; ?>'><?php echo $MGArraytmp2['lcomm']; ?></td>
            </tr>
            <?php
              } else {
              ?>
            <tr>
              <td class='rowstyle center' colspan='7'>
                <?php echo '<i><font color="red">No Record found for given quote' . $_GET['quotenumber'] . '</font></i>'; ?>
              </td>
            </tr>
            <?php
              }
              }
              } else {
              
              
              if (isset($_GET["reprun"]) && $_GET["reprun"] == "yes") {
              
              if (!empty($_GET['quotenumber'])) {
              	$rnumber = ($_GET['quotenumber'] - 3770);
              	$sql = "SELECT * FROM quote WHERE ID=" . $rnumber;
              } else {
              
              	$start_Dt = $_GET["date_from"];
              	$end_Dt = $_GET["date_to"];
              
              
              	if (isset($_GET['quotesse']) && $_GET['quotesse'] == 1) {
              		$searchstring = " IN ('Quote','Quote Select')";
              	}
              	if (isset($_GET['quotesse']) && $_GET['quotesse'] == 2) {
              		$searchstring = " = 'PO'";
              	}
              	if (isset($_GET['quotesse']) && $_GET['quotesse'] == 3) {
              		$searchstring = " IN ('Quote','Quote Select','PO')";
              	}
              
              	if (isset($_GET['quofilter']) && $_GET['quofilter'] == 1) {
              		$filterstr = "";
              	}
              	if (isset($_GET['quofilter']) && $_GET['quofilter'] == 2) {
              		$filterstr = " AND ID IN (SELECT MAX(ID) FROM quote GROUP BY companyID)";
              	}
              
              	$arr_new = array();
              	$filterstr_status = "";
              	db_b2b();
              	$dt_view_qry = "Select * from quote_status Where status=1";
              	$dt_view_res = db_query($dt_view_qry);
              	while ($status_data = array_shift($dt_view_res)) {
              
              		if ($_REQUEST["chk_status_" . $status_data["qid"]] == 1) {
              			$arr_new[] = $status_data["qid"];
              			if ($status_data["qid"] == 1) {
              				$filterstr_status .= "'0',";
              			}
              			$filterstr_status .= "'" . $status_data["qid"] . "',";
              		}
              	}
              	//For purchasing
              	if ($_REQUEST["chk_status_3"] == 1) {
              		$arr_new[] = 3;
              		$filterstr_status .= "'3',";
              	}
              
              	if ($_REQUEST["chk_status_4"] == 1) {
              		$arr_new[] = 4;
              		$filterstr_status .= "'4',";
              	}
              
              	if ($_REQUEST["chk_status_6"] == 1) {
              		$arr_new[] = 6;
              		$filterstr_status .= "'6',";
              	}
              
              	$filterstr_status_str = "";
              	if ($filterstr_status != "") {
              		$filterstr_status_str = " and qstatus in (" . rtrim($filterstr_status, ",") . ")";
              	}
              	db_b2b();
              	$sql = "SELECT * FROM quote WHERE `quoteDate` BETWEEN '" . $start_Dt . "' AND '" . $end_Dt . "' AND ";
              	$sql .= "`quoteType` " . $searchstring . " " . $filterstr . " " . $filterstr_status_str . " ORDER BY `ID` DESC";
              }
              //echo $sql;
              $result = db_query($sql);
              if (!empty($result)) {
              	while ($row = array_shift($result)) {
              		$emprep = $lastcomm = $no_of_days = $col_code = "";
              		db_b2b();
              		$empsql = db_query("SELECT initials FROM employees WHERE employeeID ='" . $row['rep'] . "'");
              		$emprec = array_shift($empsql);
              		$emprep	= $emprec['initials'];
              
              		//echo $no_of_days. " 565 <br>";
              		db_b2b();
              		$rowid = ($row['ID'] + 3770);
              		$companysql = "SELECT last_contact_date, nickname, company FROM companyInfo WHERE ID = " . $row['companyID'];
              		$compresult = db_query($companysql);
              		$companyrow = array_shift($compresult);
              
              		if ($companyrow['last_contact_date'] != "") {
              			$lastcomm = date("m/d/Y", strtotime($companyrow['last_contact_date'])) . " CT";
              		}
              
              		(($companyrow['nickname'] == "") ? $company_name = $companyrow['company'] : $company_name = $companyrow['nickname']);
              		if ($company_name == "") $company_name = "Details Missing";
              		if ($row['qstatus'] == 0) {
              			$status_row['status_name'] = "Open";
              		} else if ($row['qstatus'] == 3) {
              			$status_row['status_name'] = "Lost: Didn't Have Boxes";
              		} else if ($row['qstatus'] == 4) {
              			$status_row['status_name'] = "Lost: Too Expensive";
              		} else if ($row['qstatus'] == 6) {
              			$status_row['status_name'] = "Lost: Died on Vine";
              		} else {
              			db_b2b();
              			$boxSql = "Select `status_name` from quote_status Where qid=" . $row['qstatus'] . " AND status=1";
              			$status_name = db_query($boxSql);
              			$status_row = array_shift($status_name);
              		}
              
              	?>
            <tr>
              <td class='rowstyle center <?php echo $col_code; ?>'><?php echo (++$slno); ?></td>
              <td class='rowstyle center <?php echo $col_code; ?>'><?php echo $emprep; ?></td>
              <td class='rowstyle <?php echo $col_code; ?>'><a target='_blank' href='viewCompany.php?ID=<?php echo $row['companyID']; ?>&show=&warehouse_id=&rec_type=&proc=&searchcrit=&id=&rec_id=&display='><?php echo $company_name; ?></a></td>
              <td class='rowstyle center <?php echo $col_code; ?>'><?php echo $row['quoteType']; ?></td>
              <td class='rowstyle center <?php echo $col_code; ?>'>
                <?php
                  $archeive_date = new DateTime(date("Y-m-d", strtotime($quotes_archive_date)));
                  $quote_date = new DateTime(date("Y-m-d", strtotime($row["quoteDate"])));
                  
                  if ($quote_date < $archeive_date) {
                  ?>
                <a target="_blank" id='quotespdfs<?php echo $rowid ?>' href='https://usedcardboardboxes.sharepoint.com/:b:/r/sites/LoopsCRMEmailAttachments/Shared%20Documents/quotes/before_oct_18_2022/<?php echo $row["filename"]; ?>'><?php echo $rowid ?></a>
                <?php
                  } else {
                  ?>
                <a href='#' id='quotespdfs<?php echo $rowid ?>' onclick="show_file_inviewer_pos('quotes/<?php echo $row["filename"]; ?>', 'Quote', 'quotespdfs<?php echo $rowid ?>','iframe_tbl_generate'); return false;"><?php echo $rowid ?></a>
                <?php
                  }
                  ?>
              </td>
              <td class='rowstyle center <?php echo $col_code; ?>'><?php echo timestamp_to_date($row['quoteDate']); ?></td>
              <td class='rowstyle <?php echo $col_code; ?>' align='right'>$<?php echo number_format($row['quote_total'], 2); ?></td>
              <td class='rowstyle center <?php echo $col_code; ?>'><?php echo $status_row['status_name']; ?></td>
              <td class='rowstyle center <?php echo $col_code; ?>'><?php echo $lastcomm; ?></td>
            </tr>
            <?php
              $MGArray[] = array(
              	'company_id' => $row['companyID'], 'company_name' => $company_name, 'rowid' => $rowid, 'rep' => $emprep, 'filename' => $row["filename"],
              	'qtype' => $row['quoteType'], 'qamt' => $row['quote_total'],
              	'qdate' => timestamp_to_date($row['quoteDate']),
              	'statN' => $status_row['status_name'], 'col_code' => $col_code,
              	'lcomm' => $lastcomm
              );
              }
              $_SESSION['sortarrayn'] = $MGArray;
              } else {
              ?>
            <tr>
              <td class='rowstyle center' colspan=7>
                <?php echo '<i><font color="red">No Record found for given quote ' . $_GET['quotenumber'] . '</font></i>'; ?>
              </td>
            </tr>
            <?php
              }
              }
              }
              
              if (!isset($_GET['date_from']) && !isset($_GET['quotenumber'])) {
              echo '<script type="text/javascript">window.onload = function(){
              document.quotepoform.submit();
              }
              </script>';
              }
              ?>
          </table>
          </br>
          <?php
            $summary_array = $_SESSION['sortarrayn'];
            $sumamount = array_sum(array_column($summary_array, 'qamt'));
            $sumdate = array_count_values(array_column($summary_array, 'qdate'));
            $statusw = array_count_values(array_column($summary_array, 'statN'));
            //$sumcompany = array_count_values(array_column($summary_array, 'company_name'));
            
            $tempArr = array();
            $newArrsort_I = array();
            foreach ($summary_array as $newArrtmp) {
            if (isset($newArrtmp['company_name'])) {
              $newArrsort_I[] = $newArrtmp['company_name'];
            }
            if (count($summary_array) === count($newArrsort_I)) {
              array_multisort($newArrsort_I, SORT_ASC, SORT_STRING, $summary_array);
            }
            $size = count($summary_array);
            for ($j = 0; $j < $size; $j++) {
            	if (in_array($summary_array[$j]['company_id'], array_column($tempArr, 'companyid'))) {
            		$tempArr[$i]['counter'] += 1;
            	} else {
            		$i = $j;
            		$tempArr[$i]['rep'] = $summary_array[$j]['rep'];
            		$tempArr[$i]['companyid'] = $summary_array[$j]['company_id'];
            		$tempArr[$i]['company_name'] = $summary_array[$j]['company_name'];
            		$tempArr[$i]['counter'] = 1;
            	}
            }
            $sumcompany = array_values($tempArr);
            }
            ?>
          <table style="margin-top:50px;" cellSpacing='1' cellPadding='1' border='0' width="100%">
            <thead>
              <tr>
                <th bgcolor="#C0CDDA" align="center" colspan="3">
                  <font face="Arial, Helvetica, sans-serif">Summary Information</font>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="vertical-align: top;">
                  <table class="datarow" cellSpacing='1' cellPadding='1' border='0' width="100%">
                    <tr>
                      <th width="50%" class="txtstyle_color">Quote/ Purchase Orders</th>
                      <th width="50%" class="txtstyle_color">Amount</th>
                    </tr>
                    <tbody>
                      <tr>
                        <td class='rowstyle right'><b>Total</b></td>
                        <td class='rowstyle center'><b>$ <?php echo number_format($sumamount, 2); ?></b></td>
                      </tr>
                    </tbody>
                  </table>
                </td>
                <td style="vertical-align: top;">
                  <table class="datarow" cellSpacing='1' cellPadding='1' border='0' width="100%">
                    <tr>
                      <th width="50%" class="txtstyle_color">Quote Date</th>
                      <th width="50%" class="txtstyle_color">Quotes/purchase Orders Count</th>
                    </tr>
                    <?php
                      $Total_cnt = 0;
                      if (!empty($sumdate)) {
                      	foreach ($sumdate as $key => $val) {
                      ?>
                    <tr>
                      <td class='rowstyle'><?php echo $key ?></td>
                      <td class='rowstyle center'><?php echo $val ?></td>
                    </tr>
                    <?php
                      $Total_cnt = $Total_cnt + $val;
                      }
                      }
                      ?>
                    <tr>
                      <td class='rowstyle'><b>Total:</b></td>
                      <td class='rowstyle center'><b><?php echo $Total_cnt ?></b></td>
                    </tr>
                  </table>
                </td>
                <td style="vertical-align: top;">
                  <table class="datarow" cellSpacing='1' cellPadding='1' border='0' width="100%">
                    <tr>
                      <th width="50%" class="txtstyle_color">Status</th>
                      <th width="50%" class="txtstyle_color">Quotes/purchase Orders Count</th>
                    </tr>
                    <?php
                      $Total_cnt = 0;
                      if (!empty($statusw)) {
                      	foreach ($statusw as $key => $val) {
                      ?>
                    <tr>
                      <td class='rowstyle'><?php echo $key ?></td>
                      <td class='rowstyle center'><?php echo $val ?></td>
                    </tr>
                    <?php
                      $Total_cnt = $Total_cnt + $val;
                      }
                      }
                      ?>
                    <tr>
                      <td class='rowstyle'><b>Total:</b></td>
                      <td class='rowstyle center'><b><?php echo $Total_cnt ?></b></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan='3'>
                  <table class="datarow" cellSpacing='1' cellPadding='1' border='0' width="40%">
                    <tr>
                      <th width="5%" class="txtstyle_color" align="center">Sr. no.</th>
                      <th width="14%" class="txtstyle_color" align="center">Rep</th>
                      <th width="55%" class="txtstyle_color" align="center">Company Name</th>
                      <th width="25%" class="txtstyle_color" align="center">Quotes/purchase orders Count</th>
                    </tr>
                    <?php
                      $Total_cnt = 0;
                      $i = 0;
                      if (!empty(ksort($sumcompany))) {
                      	foreach ($sumcompany as $row) {
                      ?>
                    <tr>
                      <td class='rowstyle center'><?php echo ++$i; ?></td>
                      <td class='rowstyle center'><?php echo $row['rep'] ?></td>
                      <td class='rowstyle'><?php echo $row['company_name'] ?></td>
                      <td class='rowstyle center'><?php echo $row['counter'] ?></td>
                    </tr>
                    <?php
                      $Total_cnt = $Total_cnt + $row['counter'];
                      }
                      }
                      ?>
                    <tr>
                      <td colspan="3" class='rowstyle'><b>Total:</b></td>
                      <td class='rowstyle center'><b><?php echo $Total_cnt ?></b></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>