<?php
  session_start();
  require("inc/header_session.php");
  require("../mainfunctions/database.php");
  require("../mainfunctions/general-functions.php");
  
  $sort_order_pre = "ASC";
  if ($_REQUEST['sort_order_pre'] == "ASC") {
  	$sort_order_pre = "DESC";
  } else {
  	$sort_order_pre = "ASC";
  }
  
  ?>
<html>
  <head>
    <title>Client Retention Report - B2B Purchasing</title>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
    <LINK rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>
    <style>
      .newtxttheam_withdot {
      font-family: Arial;
      font-size: 12px;
      padding: 4px;
      background-color: #EFEEE7;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
      }
    </style>
    <script type="text/javascript">
      function update_nextstep(tmpcnt, mainid) {
      	var tmpval = document.getElementById("txt_nextcomm_str" + tmpcnt).value;
      	if (tmpval == "") {
      		alert("Please enter the details.");
      		return;
      	}
      
      	var tmpval2 = document.getElementById("txt_nextstep" + tmpcnt).value;
      	var tmpval3 = document.getElementById("txt_nextcomm" + tmpcnt).value;
      
      	if (window.XMLHttpRequest) {
      		xmlhttp = new XMLHttpRequest();
      	} else {
      		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      	}
      	xmlhttp.onreadystatechange = function() {
      		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      			document.getElementById("child_main_div" + tmpcnt).innerHTML = "Record updated.";
      		}
      	}
      
      	xmlhttp.open("GET", "report_boxesorder_reminder_update.php?companyID=" + mainid + "&datatoupdate=" + tmpval + "&nextstep=" + tmpval2 + "&nextstepdt=" + tmpval3, true);
      	xmlhttp.send();
      }
    </script>
    <script LANGUAGE="JavaScript" SRC="inc/CalendarPopup.js"></script>
    <script LANGUAGE="JavaScript">
      document.write(getCalendarStyles());
    </script>
    <script LANGUAGE="JavaScript">
      var cal1xx = new CalendarPopup("listdiv");
      
      cal1xx.showNavigationDropdowns();
    </script>
  </head>
  <body>
    <?php include("inc/header.php"); ?>
    <div class="main_data_css">
      <?php
	    db();
        $user_qry = "SELECT id from loop_employees where level = 2 and initials = '" . $_COOKIE['userinitials'] . "'";
        $user_res = db_query($user_qry);
        while ($user_row = array_shift($user_res)) {
        	echo "<br>&nbsp;&nbsp;<a href='cron_save_selltoucb_reminder.php?showrep=yes'>Re-Run the Cron Job</a>";
        }
        ?>
      <div class="dashboard_heading" style="float: left;">
        <div style="float: left;">
          Client Retention Report - B2B Purchasing
          <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
            <span class="tooltiptext">This report shows the user all B2B Purchasing suppliers (meaning they have sold to from UCB before) who are overdue for an order for various reasons such as the average time between their previous orders is longer than the time since their last order, or having no orders in a certain amount of time.</span>
          </div>
          <br>
        </div>
      </div>
      <div>
        <form method="POST" name="frm" id="frm" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <table>
            <tr>
              <td>Query:</td>
              <td>
                <select name="order_dd" id="order_dd">
                  <option value="1" <?php if ($_REQUEST["order_dd"] == "1") {
                    echo "selected";
                    } else {
                    } ?>>Overdue for order, regardless of contact</option>
                  <option value="2" <?php if ($_REQUEST["order_dd"] == "2") {
                    echo "selected";
                    } else {
                    } ?>>Overdue for order, not contacted >3 months</option>
                  <option value="3" <?php if ($_REQUEST["order_dd"] == "3") {
                    echo "selected";
                    } else {
                    } ?>>No Orders > 6 months</option>
                  <option value="4" <?php if ($_REQUEST["order_dd"] == "4") {
                    echo "selected";
                    } else {
                    } ?>>No Orders > 12 months</option>
                  <option value="5" <?php if ($_REQUEST["order_dd"] == "5") {
                    echo "selected";
                    } else {
                    } ?>>No Orders > 24 months</option>
                  <option value="6" <?php if ($_REQUEST["order_dd"] == "6") {
                    echo "selected";
                    } else {
                    } ?>>No Orders > 36 months</option>
                  <option value="7" <?php if ($_REQUEST["order_dd"] == "7") {
                    echo "selected";
                    } else {
                    } ?>>Buying <= 75% avg month</option>
                </select>
              </td>
              <td><input type="submit" id="btnsubmit" name="btnsubmit" value="Run Report">
                <input type="hidden" id="reprun" name="reprun" value="yes">
              </td>
            </tr>
          </table>
        </form>
      </div>
      <?php
        
        if ((isset($_REQUEST["btnsubmit"])) || (isset($_REQUEST["sort_fld"]))) {
        
        	if (!isset($_REQUEST["sort_fld"]) && isset($_SESSION["sortarrayn"])) {
        
        		$rname = "report_boxesselltoucb_purchase" . $_REQUEST['order_dd'];
				db();
        		$query = "SELECT report_cache_str, sync_time from reports_cache where report_name = '" . $rname . "'";
        		$res = db_query($query);
        		while ($row = array_shift($res)) {
        			echo "<span style='font-size:14pt;'><i>Data last updated: " . timeAgo(date("m/d/Y H:i:s", strtotime($row["sync_time"]))) . " </i></span>";
        
        			echo $row["report_cache_str"];
        		}
        	} else {
        ?>
      <div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>
      <?php if ($_REQUEST["order_dd"] == "7") {
        ?>
      <div>
        <u>Conditions</u> <br>
        Condition I = We have bought from this company before this year, but not yet this year.<br>
        Condition II = When compared to the average per month during our best year with that supplier in the past, we are now buying 75% or less on average per month this year.
        <br>
      </div>
      <?php	} ?>
      <form method="post" name="sp_report_new">
        <table width="1400px">
          <tr>
            <td colspan="14" align="center">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="14" align="center">
              <div><i>Note: Please wait until you see <font color="red">"END OF REPORT"</font> at the bottom of the report, before using the sort option.</i></div>
            </td>
          </tr>
          <tr style="background: #2B1B17;">
            <td colspan="14" bgcolor="#C0CDDA" align="center"><b>Summary</b></td>
          </tr>
          <tr style="background: #2B1B17;">
            <td bgcolor="#C0CDDA" align="middle">Sr. No.</td>
            <td bgcolor="#C0CDDA" align="middle"><a href="report_boxesselltoucb_reminder.php?sort_fld=company_name&sort_order_pre=<?php echo $sort_order_pre; ?>&order_dd=<?php echo $_REQUEST["order_dd"]; ?>" bgcolor="#C0CDDA">Company Name</a></td>
            <td bgcolor="#C0CDDA" align="middle">
              <a href="report_boxesselltoucb_reminder.php?sort_fld=last_order_date&sort_order_pre=<?php echo $sort_order_pre; ?>&order_dd=<?php echo $_REQUEST["order_dd"]; ?>" bgcolor="#C0CDDA">
                Last Sort Report Date
            </td>
            <td bgcolor="#C0CDDA" align="middle"><a href="report_boxesselltoucb_reminder.php?sort_fld=totorder&sort_order_pre=<?php echo $sort_order_pre; ?>&order_dd=<?php echo $_REQUEST["order_dd"]; ?>" bgcolor="#C0CDDA">Number of purchases</a></td>
            <td bgcolor="#C0CDDA" align="middle"><a href="report_boxesselltoucb_reminder.php?sort_fld=totorderval&sort_order_pre=<?php echo $sort_order_pre; ?>&order_dd=<?php echo $_REQUEST["order_dd"]; ?>" bgcolor="#C0CDDA">Total Payments</a></td>
            <td bgcolor="#C0CDDA" align="middle">
              <a href="report_boxesselltoucb_reminder.php?sort_fld=avg_time_order&sort_order_pre=<?php echo $sort_order_pre; ?>&order_dd=<?php echo $_REQUEST["order_dd"]; ?>" bgcolor="#C0CDDA">
                Average Days Between Orders
            </td>
            <td bgcolor="#C0CDDA" align="middle"><a href="report_boxesselltoucb_reminder.php?sort_fld=no_days&sort_order_pre=<?php echo $sort_order_pre; ?>&order_dd=<?php echo $_REQUEST["order_dd"]; ?>" bgcolor="#C0CDDA"># of Days Since Last Order</td>
            <td bgcolor="#C0CDDA" align="middle"><a href="report_boxesselltoucb_reminder.php?sort_fld=rep_name&sort_order_pre=<?php echo $sort_order_pre; ?>&order_dd=<?php echo $_REQUEST["order_dd"]; ?>" bgcolor="#C0CDDA">Account Owner</td>
            <td bgcolor="#C0CDDA" align="middle"><a href="report_boxesselltoucb_reminder.php?sort_fld=acc_status&sort_order_pre=<?php echo $sort_order_pre; ?>&order_dd=<?php echo $_REQUEST["order_dd"]; ?>" bgcolor="#C0CDDA">Status</td>
            <td bgcolor="#C0CDDA" align="middle"><a href="report_boxesselltoucb_reminder.php?sort_fld=lastcontactdt&sort_order_pre=<? echo $sort_order_pre; ?>&order_dd=<?php echo $_REQUEST["order_dd"]; ?>" bgcolor="#C0CDDA">Last Contact Date</a></td>
            <td bgcolor="#C0CDDA" align="middle"><a href="report_boxesselltoucb_reminder.php?sort_fld=nextstep&sort_order_pre=<?php echo $sort_order_pre; ?>&order_dd=<?php echo $_REQUEST["order_dd"]; ?>" bgcolor="#C0CDDA">Next Step</a></td>
            <td bgcolor="#C0CDDA" align="middle"><a href="report_boxesselltoucb_reminder.php?sort_fld=nextstepdt&sort_order_pre=<?php echo $sort_order_pre; ?>&order_dd=<?php echo $_REQUEST["order_dd"]; ?>" bgcolor="#C0CDDA">Next Communication</a></td>
          </tr>
          <?php
            $classnm = "newtxttheam_withdot";
            if (isset($_REQUEST["sort_fld"])) {
            } else {
            	$MGArray = array();
            	$todays_dt = date('Y-m-d');
            	$warehouse_id = "";
            	$warehouse_id_2 = "";
            	$transaction_date = "";
            	$transaction_date_2 = "";
            	$newDate = "";
            	$cnt_no = 0;
            	//$_SESSION['sortarrayn'] ="";
            
            	if ($_REQUEST["order_dd"] != "7") {
					db();
            		$res_main = db_query("Select id, b2bid , warehouse_name, average_order_days, max_transaction_date, last_sort_date, max_transaction_cnt from loop_warehouse 
            where rec_type = 'Manufacturer' and Active = 1 and max_transaction_cnt > 1 and b2bid > 0 and average_order_days > 0 and (last_sort_date is not null and last_sort_date <> '0000-00-00') order by company_name");
            		while ($main_row = array_shift($res_main)) {
            			$wid = $main_row["id"];
            			$contact = "";
            			$sellto_main_line_ph = "";
            			$email = "";
            			$last_contact_dt = "";
            			$next_step = "";
            			$compid = 0;
            			$next_date = "";
            			$inactive_company = "n";
            			$status_owner = 0;
            			$acc_status = "";
            			$company_final = "";
						db_b2b();
            			$sql_comp = "Select ID, contact, sellto_main_line_ph, email, last_contact_date, next_step, next_date, company, 
            status, active, nickname from companyInfo where  active = 1 and status not in (31, 24, 49) and ID = " . $main_row["b2bid"];
            			$dt_view_res = db_query($sql_comp);
            			while ($row_comp = array_shift($dt_view_res)) {
            				$inactive_company = "y";
            				$status_owner = $row_comp["status"];
            
            				$company_final = $row_comp["nickname"];
            				if ($row_comp["nickname"] == "") {
            					$company_final = $row_comp["company"];
            				}
            
            				$contact = $row_comp["contact"];
            				$sellto_main_line_ph = $row_comp["sellto_main_line_ph"];
            				$email = $row_comp["email"];
            				$compid = $row_comp["ID"];
            
            				$last_contact_dt = date("Y-m-d", strtotime($row_comp["last_contact_date"]));
            				$next_step = $row_comp["next_step"];
            				$next_date = $row_comp["next_date"];
            			}
            
            			if ($inactive_company == "y") {
            
            				/*$max_transaction_date = $main_row["max_transaction_date"];
            
            $dt = date('Y-m-d', strtotime($max_transaction_date));
            $no_ofdays_todaysdt_lastorderdt = dateDiff($dt, $todays_dt);*/
            				//Sort date
            				if ($_REQUEST["order_dd"] == "2") {
            					$max_transaction_date = $main_row["max_transaction_date"];
            
            					$dt = date('Y-m-d', strtotime($max_transaction_date));
            					$no_ofdays_todaysdt_lastorderdt = dateDiff($dt, $todays_dt);
            					$Days = str_replace(",", "", number_format($main_row["average_order_days"]));
            					$Avergae_time = str_replace("-", "", $Days);
            					$no_ofdays_todaysdt_lastorderdt = str_replace(",", "", $no_ofdays_todaysdt_lastorderdt);
            					$Avergae_time = str_replace(",", "", $Avergae_time);
            
            					$newflg = "no";
            					$newflg1 = "no";
            					//echo "Step 1 " . $main_row["b2bid"] . " -  " . $no_ofdays_todaysdt_lastorderdt . " - " . $Avergae_time . "<br>";
            					if ($no_ofdays_todaysdt_lastorderdt >= $Avergae_time && $Avergae_time != 0) {
            						$newflg = "yes";
            					}
            
            					if ($no_ofdays_todaysdt_lastorderdt >= 20 && $Avergae_time == 0) {
            						$newflg = "yes";
            					}
            
            					$tot_orders = 0;
            					$tot_orders_val = 0;
            
            					$dt_new = date('Y-m-d', strtotime($last_contact_dt));
            					$last_contact90day = dateDiff($dt_new, $todays_dt);
            					//echo "Comp: ". $inv_row['company_name'] . " id:" . $compid . " " . $last_contact90day . "<br>";
            					if ($last_contact90day > 91) {
            						$newflg1 = "yes";
            					}
            
            					if ($newflg == "yes" && $newflg1 == "yes") {
            
            				
									db_b2b();
            						$sql_comp = "Select companyInfo.company, assignedto, nickname, employees.name from companyInfo inner join employees on companyInfo.assignedto = employees.employeeID where ID = '" . $main_row["b2bid"] . "'";
            						$dt_view_res = db_query($sql_comp);
            						$emp_name = "";
            						$newcompany = $row['company_name'];
            						while ($row_comp = array_shift($dt_view_res)) {
            							$emp_name = $row_comp['name'];
            							if ($row_comp['nickname'] == "") {
            								$newcompany = $row_comp['company'];
            							} else {
            								$newcompany = $row_comp['nickname'];
            							}
            						}
									db_b2b();
            						$status = "Select * from status where id = " . $status_owner;
            						$dt_view_res4 = db_query($status);
            						while ($objStatus = array_shift($dt_view_res4)) {
            							$acc_status = $objStatus["name"];
            						}
            
            						$tot_orders = $main_row["max_transaction_cnt"];
            						db();
            						$comp_res = db_query("Select sum(estimated_revenue) as rev_amount from loop_transaction where loop_transaction.ignore = 0 and warehouse_id = " . $main_row["id"]);
            						while ($comp_row = array_shift($comp_res)) {
            							$tot_orders_val = $comp_row["rev_amount"];
            						}
            
            						$no_ofdays_todaysdt_lastorderdt_org = $no_ofdays_todaysdt_lastorderdt;
            
            						if ($tot_orders == 1) {
            							$Avergae_time == "N/A";
            							$no_ofdays_todaysdt_lastorderdt_n = "N/A";
            						} else {
            							$no_ofdays_todaysdt_lastorderdt_n = $no_ofdays_todaysdt_lastorderdt . " days overdue";
            						}
            
            						if ($tot_orders >= 1) {
            							if ($company_final == "") {
            								$company_final = $newcompany;
            							}
            							$MGArray[] = array(
            								'company_name' => $company_final, 'warehouse_id' => $main_row["id"], 'last_order_date' => $max_transaction_date,
            								'avg_time_order' => $Avergae_time, 'no_days' => $no_ofdays_todaysdt_lastorderdt, 'no_days_n' => $no_ofdays_todaysdt_lastorderdt, 'rep_name' => $emp_name,
            								'sellto' => $contact, 'sellto_main_line_ph' => $sellto_main_line_ph, 'email' => $email, 'compid' => $compid, 'acc_status' => $acc_status,
            								'tot_orders' => $tot_orders, 'tot_orders_val' => $tot_orders_val, 'last_contact_dt' => $last_contact_dt, 'next_step' => $next_step, 'next_date' => $next_date
            							);
            							//
            							$cnt_no = $cnt_no + 1;
            						}
            					}
            				}
            
            				//
            				if ($_REQUEST["order_dd"] == "1") {
            					$max_transaction_date = $main_row["max_transaction_date"];
            
            					$dt = date('Y-m-d', strtotime($max_transaction_date));
            					$no_ofdays_todaysdt_lastorderdt = dateDiff($dt, $todays_dt);
            					$Days = str_replace(",", "", number_format($main_row["average_order_days"]));
            					$Avergae_time = str_replace("-", "", $Days);
            					$no_ofdays_todaysdt_lastorderdt = str_replace(",", "", $no_ofdays_todaysdt_lastorderdt);
            					$Avergae_time = str_replace(",", "", $Avergae_time);
            
            					$newflg = "no";
            					$newflg1 = "no";
            					//echo "Step 1 " . $main_row["b2bid"] . " -  " . $no_ofdays_todaysdt_lastorderdt . " - " . $Avergae_time . "<br>";
            					if ($no_ofdays_todaysdt_lastorderdt >= $Avergae_time && $Avergae_time != 0) {
            						$newflg = "yes";
            					}
            
            					if ($no_ofdays_todaysdt_lastorderdt >= 20 && $Avergae_time == 0) {
            						$newflg = "yes";
            					}
            
            					$tot_orders = 0;
            					$tot_orders_val = 0;
            
            					$dt_new = date('Y-m-d', strtotime($last_contact_dt));
            					$last_contact90day = dateDiff($dt_new, $todays_dt);
            					//echo "Comp: ". $inv_row['company_name'] . " id:" . $compid . " " . $last_contact90day . "<br>";
            					/*if($last_contact90day > 91)
            	{		
            		$newflg1 = "yes";
            	}
            */
            					if ($newflg == "yes") {
									db_b2b();
            						$sql_comp = "Select companyInfo.company, assignedto, nickname, employees.name from companyInfo inner join employees on companyInfo.assignedto = employees.employeeID where ID = '" . $main_row["b2bid"] . "'";
            						$dt_view_res = db_query($sql_comp);
            						$emp_name = "";
            						$newcompany = $row['company_name'];
            						while ($row_comp = array_shift($dt_view_res)) {
            							$emp_name = $row_comp['name'];
            							if ($row_comp['nickname'] == "") {
            								$newcompany = $row_comp['company'];
            							} else {
            								$newcompany = $row_comp['nickname'];
            							}
            						}
									db_b2b();
            						$status = "Select * from status where id = " . $status_owner;
            						$dt_view_res4 = db_query($status);
            						while ($objStatus = array_shift($dt_view_res4)) {
            							$acc_status = $objStatus["name"];
            						}
            
            						$tot_orders = $main_row["max_transaction_cnt"];
            				
									db();
            						$comp_res = db_query("Select sum(estimated_revenue) as rev_amount from loop_transaction where loop_transaction.ignore = 0 and warehouse_id = " . $main_row["id"]);
            						while ($comp_row = array_shift($comp_res)) {
            							$tot_orders_val = $comp_row["rev_amount"];
            						}
            
            						if ($tot_orders == 1) {
            							$Avergae_time == "N/A";
            							$no_ofdays_todaysdt_lastorderdt_n = "N/A";
            						} else {
            							$no_ofdays_todaysdt_lastorderdt_n = $no_ofdays_todaysdt_lastorderdt . " days overdue";
            						}
            
            						if ($tot_orders >= 1) {
            							if ($company_final == "") {
            								$company_final = $newcompany;
            							}
            							$MGArray[] = array(
            								'company_name' => $company_final, 'warehouse_id' => $main_row["id"], 'last_order_date' => $max_transaction_date,
            								'avg_time_order' => $Avergae_time, 'no_days' => $no_ofdays_todaysdt_lastorderdt, 'no_days_n' => $no_ofdays_todaysdt_lastorderdt, 'rep_name' => $emp_name,
            								'sellto' => $contact, 'sellto_main_line_ph' => $sellto_main_line_ph, 'email' => $email, 'compid' => $compid, 'acc_status' => $acc_status,
            								'tot_orders' => $tot_orders, 'tot_orders_val' => $tot_orders_val, 'last_contact_dt' => $last_contact_dt, 'next_step' => $next_step, 'next_date' => $next_date
            							);
            							//
            							$cnt_no = $cnt_no + 1;
            						}
            					}
            				} //End query 1
            
            				if ($_REQUEST["order_dd"] == "3" || $_REQUEST["order_dd"] == "4" || $_REQUEST["order_dd"] == "5" || $_REQUEST["order_dd"] == "6") {
            					$max_transaction_date = $main_row["last_sort_date"];
            
            					$dt = date('Y-m-d', strtotime($max_transaction_date));
            					$no_ofdays_todaysdt_lastorderdt = dateDiff($dt, $todays_dt);
            					$Days = str_replace(",", "", number_format($main_row["average_order_days"]));
            					$Avergae_time = str_replace("-", "", $Days);
            
            					$no_ofdays_todaysdt_lastorderdt = str_replace(",", "", $no_ofdays_todaysdt_lastorderdt);
            					$Avergae_time = str_replace(",", "", $Avergae_time);
            
            					$newflg = "no";
            					$newflg1 = "no";
            
            					//6 12 24 36
            					$month_cnt = 0;
            					if ($_REQUEST["order_dd"] == "3") {
            						$month_cnt = 6;
            					}
            					if ($_REQUEST["order_dd"] == "4") {
            						$month_cnt = 12;
            					}
            					if ($_REQUEST["order_dd"] == "5") {
            						$month_cnt = 24;
            					}
            					if ($_REQUEST["order_dd"] == "6") {
            						$month_cnt = 36;
            					}
            
            					if ($no_ofdays_todaysdt_lastorderdt >= (30 * $month_cnt)) {
            						$newflg = "yes";
            					}
            
            					$tot_orders = 0;
            					$tot_orders_val = 0;
            
            					$dt_new = date('Y-m-d', strtotime($last_contact_dt));
            					$last_contact90day = dateDiff($dt_new, $todays_dt);
            					//echo "Comp: ". $main_row["b2bid"] . " " . $no_ofdays_todaysdt_lastorderdt . "<br>";
            
            					if ($newflg == "yes") {
									db_b2b();
            						$sql_comp = "Select companyInfo.company, assignedto, nickname, employees.name from companyInfo inner join employees on companyInfo.assignedto = employees.employeeID where ID = '" . $main_row["b2bid"] . "'";
            						$dt_view_res = db_query($sql_comp);
            						$emp_name = "";
            						$newcompany = $row['company_name'];
            						while ($row_comp = array_shift($dt_view_res)) {
            							$emp_name = $row_comp['name'];
            							if ($row_comp['nickname'] == "") {
            								$newcompany = $row_comp['company'];
            							} else {
            								$newcompany = $row_comp['nickname'];
            							}
            						}
									db_b2b();
            						$status = "Select * from status where id = " . $status_owner;
            						$dt_view_res4 = db_query($status);
            						while ($objStatus = array_shift($dt_view_res4)) {
            							$acc_status = $objStatus["name"];
            						}
            
            						$tot_orders = $main_row["max_transaction_cnt"];
									db();
            						$comp_res = db_query("Select sum(estimated_revenue) as rev_amount from loop_transaction where loop_transaction.ignore = 0 and warehouse_id = " . $main_row["id"]);
            						while ($comp_row = array_shift($comp_res)) {
            							$tot_orders_val = $comp_row["rev_amount"];
            						}
            
            						$no_ofdays_todaysdt_lastorderdt_org = $no_ofdays_todaysdt_lastorderdt;
            
            						if ($tot_orders == 1) {
            							$Avergae_time = "N/A";
            							$no_ofdays_todaysdt_lastorderdt_n = "N/A";
            						} else {
            							$no_ofdays_todaysdt_lastorderdt_n = $no_ofdays_todaysdt_lastorderdt . " days overdue";
            						}
            
            						if ($tot_orders > 1) {
            							if ($company_final == "") {
            								$company_final = $newcompany;
            							}
            							$MGArray[] = array(
            								'company_name' => $company_final, 'warehouse_id' => $main_row["id"], 'last_order_date' => $max_transaction_date,
            								'avg_time_order' => $Avergae_time, 'no_days' => $no_ofdays_todaysdt_lastorderdt_org, 'no_days_n' => $no_ofdays_todaysdt_lastorderdt_n, 'rep_name' => $emp_name,
            								'sellto' => $contact, 'sellto_main_line_ph' => $sellto_main_line_ph, 'email' => $email, 'compid' => $compid, 'acc_status' => $acc_status,
            								'tot_orders' => $tot_orders, 'tot_orders_val' => $tot_orders_val, 'last_contact_dt' => $last_contact_dt, 'next_step' => $next_step, 'next_date' => $next_date
            							);
            						}
            					}
            				}
            				//}
            				$_SESSION['sortarrayn'] = $MGArray;
            			}
            		}
            	}
            
            	$rev_current_yr_flg = 0;
            	//For condtion 7
            	if ($_REQUEST["order_dd"] == "7") {
					db_b2b();
            		$res_main = db_query("Select b2bid from company_year_revenue_g_profit where sales_purchasing_flg = 2 group by b2bid");
            		while ($main_row = array_shift($res_main)) {
            			$newflg = "no";
            			$newflg1 = "no";
            			$data_found = "no";
            			$current_yr_revenue = 0;
            			$rev_current_yr_flg = 0;
						db_b2b();
            			$sql_comp = "Select revenue from company_year_revenue_g_profit where trans_year = '" . date("Y") . "' and b2bid = " . $main_row["b2bid"];
            			$dt_view_res = db_query($sql_comp);
            			while ($row_comp = array_shift($dt_view_res)) {
            				$data_found = "yes";
            				$current_yr_revenue = $row_comp["revenue"];
            			}
            
            			//If current Year data not found then display company record
            			if ($data_found == "no") {
            				$newflg = "yes";
            				$rev_current_yr_flg = 1;
            			}
            
            			//If (DK idea, total sales of last year (TTM) vs total sales of this year (TTM), as a pro-rated %, and if 75 < certain %, then it'll show on output table.)
            			// New logic as per Zac Step 1, find max Step 2, month avg  Step 3, this yr avg Step 4, compare Show on table?
            			if ($newflg == "no") {
            				$maxrevenue = 0;
							db_b2b();
            				$sql_comp = "Select max(revenue) as maxrevenue from company_year_revenue_g_profit where b2bid = " . $main_row["b2bid"];
            				$dt_view_res = db_query($sql_comp);
            				while ($row_comp = array_shift($dt_view_res)) {
            					$maxrevenue = $row_comp["maxrevenue"];
            				}
            				if ($maxrevenue > 0) {
            					$maxrevenue_avg = $maxrevenue / 12;
            					$current_m_days = (date("m") - 1) + (date("d") / date("t"));
            					$current_yr_revenue_avg = $current_yr_revenue / $current_m_days;
            					$revenue_avg = ($current_yr_revenue_avg / $maxrevenue_avg) * 100;
            					if ($revenue_avg <= 75) {
            						$rev_current_yr_flg = 2;
            						$newflg = "yes";
            						//echo "In step |" . $main_row["b2bid"] . " | ". $revenue_avg . " | " . $maxrevenue_avg . " | " . $current_yr_revenue_avg . " | " . $current_m_days;	
            					}
            				}
            			}
            
            			if ($newflg == "yes") {
            				$contact = "";
            				$sellto_main_line_ph = "";
            				$email = "";
            				$last_contact_dt = "";
            				$next_step = "";
            				$compid = 0;
            				$next_date = "";
            				$inactive_company = "n";
            				$status_owner = 0;
            				$acc_status = "";
            				$company_final = "";
							db_b2b();
            				$sql_comp = "Select ID, contact, sellto_main_line_ph, email, last_contact_date, next_step, next_date, company, 
            status, active, nickname from companyInfo where active = 1 and ID = " . $main_row["b2bid"];
            				$dt_view_res = db_query($sql_comp);
            				while ($row_comp = array_shift($dt_view_res)) {
            					$inactive_company = "y";
            					$status_owner = $row_comp["status"];
            
            					$company_final = $row_comp["nickname"];
            					if ($row_comp["nickname"] == "") {
            						$company_final = $row_comp["company"];
            					}
            
            					$contact = $row_comp["contact"];
            					$sellto_main_line_ph = $row_comp["sellto_main_line_ph"];
            					$email = $row_comp["email"];
            					$compid = $row_comp["ID"];
            
            					$last_contact_dt = $row_comp["last_contact_date"];
            					$next_step = $row_comp["next_step"];
            					$next_date = $row_comp["next_date"];
            				}
            
            				if ($inactive_company == "y") {
            					$tot_orders = 0;
            					$tot_orders_val = 0;
            					$average_order_days = "";
            					$loop_id = 0;
								db();
            					$sql_comp = "Select id, b2bid , warehouse_name, average_order_days, max_transaction_date, last_delivery_date, max_transaction_cnt from loop_warehouse 
            where b2bid = '" . $main_row["b2bid"] . "'";
            					$dt_view_res = db_query($sql_comp);
            					while ($row_comp = array_shift($dt_view_res)) {
            						$max_transaction_date = $row_comp["last_delivery_date"];
            						$average_order_days = $row_comp["average_order_days"];
            						$tot_orders = $row_comp["max_transaction_cnt"];
            						$loop_id = $row_comp["id"];
            					}
            
            					$dt = date('Y-m-d', strtotime($max_transaction_date));
            					$no_ofdays_todaysdt_lastorderdt = dateDiff($dt, $todays_dt);
            					$Days = str_replace(",", "", number_format($average_order_days));
            					$Avergae_time = str_replace("-", "", $Days);
            
            					$no_ofdays_todaysdt_lastorderdt = str_replace(",", "", $no_ofdays_todaysdt_lastorderdt);
            					$Avergae_time = str_replace(",", "", $Avergae_time);
            
            
            					$dt_new = date('Y-m-d', strtotime($last_contact_dt));
            					$last_contact90day = dateDiff($dt_new, $todays_dt);
            					db_b2b();
            					$sql_comp = "Select companyInfo.company, assignedto, nickname, employees.name from companyInfo
            inner join employees on companyInfo.assignedto = employees.employeeID where ID = '" . $main_row["b2bid"] . "'";
            					$dt_view_res = db_query($sql_comp);
            					$emp_name = "";
            					$newcompany = $row['company_name'];
            					while ($row_comp = array_shift($dt_view_res)) {
            						$emp_name = $row_comp['name'];
            						if ($row_comp['nickname'] == "") {
            							$newcompany = $row_comp['company'];
            						} else {
            							$newcompany = $row_comp['nickname'];
            						}
            					}
								db_b2b();
            					$status = "Select * from status where id = " . $status_owner;
            					$dt_view_res4 = db_query($status);
            					while ($objStatus = array_shift($dt_view_res4)) {
            						$acc_status = $objStatus["name"];
            					}
            
            					$no_ofdays_todaysdt_lastorderdt_org = $no_ofdays_todaysdt_lastorderdt;
            
            					if ($tot_orders == 1) {
            						$Avergae_time = "N/A";
            						$no_ofdays_todaysdt_lastorderdt = "N/A";
            					} else {
            						$no_ofdays_todaysdt_lastorderdt = $no_ofdays_todaysdt_lastorderdt . " days overdue";
            					}
								db();
            					$comp_res = db_query("Select sum(estimated_revenue) as rev_amount from loop_transaction where loop_transaction.ignore = 0 and warehouse_id = " . $loop_id);
            					while ($comp_row = array_shift($comp_res)) {
            						$tot_orders_val = $comp_row["rev_amount"];
            					}
            
            					if ($company_final == "") {
            						$company_final = $newcompany;
            					}
            					$MGArray[] = array(
            						'rev_current_yr_flg' => $rev_current_yr_flg, 'company_name' => $company_final, 'warehouse_id' => $loop_id, 'last_order_date' => $max_transaction_date,
            						'avg_time_order' => $Avergae_time, 'no_days' => $no_ofdays_todaysdt_lastorderdt_org, 'no_days_display' => $no_ofdays_todaysdt_lastorderdt, 'rep_name' => $emp_name,
            						'sellto' => $contact, 'sellto_main_line_ph' => $sellto_main_line_ph, 'email' => $email, 'compid' => $compid, 'acc_status' => $acc_status,
            						'tot_orders' => $tot_orders, 'tot_orders_val' => $tot_orders_val, 'last_contact_dt' => $last_contact_dt, 'next_step' => $next_step, 'next_date' => $next_date
            					);
            
            					$_SESSION['sortarrayn'] = $MGArray;
            				}
            			}
            		}
            	}
            
            	//echo "<br><br><br>";	
            	//By default sort by "Price to get business"
            	$MGArraysort_I = array();
            
            	foreach ($MGArray as $MGArraytmp) {
            		$MGArraysort_I[] = $MGArraytmp['tot_orders_val'];
            	}
            	array_multisort($MGArraysort_I, SORT_DESC, SORT_NUMERIC, $MGArray);
            
            	$cnt_no = 1;
            	foreach ($MGArray as $MGArraytmp2) {
            		if ($MGArraytmp2['last_contact_dt'] != "") {
            			$todays_dt = date('Y-m-d');
            			$cnt_date = str_replace(",", "", dateDiff($MGArraytmp2['last_contact_dt'], $todays_dt));
            			//echo $MGArraytmp2['compid'] . " " . $MGArraytmp2['last_contact_dt'] . " " . $todays_dt . " | " . $cnt_date . "<br>";
            			if ($cnt_date > 91) {
            				$bgcolor = "red";
            				$last_contactdays = "(" . $cnt_date . " days ago)";
            			} else {
            				$bgcolor = "#E4E4E4";
            				$last_contactdays = "";
            			}
            		}
            ?>
          <tr id="main_div<?php echo $cnt_no ?>">
            <td bgcolor="#E4E4E4">
              <font size='2'><?php echo $cnt_no; ?></font>
            </td>
            <td bgcolor="#E4E4E4"><b><a style="color:#006600" href="http://loops.usedcardboardboxes.com/search_results.php?id=<?php echo $MGArraytmp2["warehouse_id"]; ?>&proc=View&searchcrit=&rec_type=Manufacturer&page=0" target="_blank">
              <font size='2'><?php echo $MGArraytmp2["company_name"]; ?></font>
              </a></b>
              <?php if ($MGArraytmp2["rev_current_yr_flg"] == 1) echo "Condition I"; ?> <?php if ($MGArraytmp2["rev_current_yr_flg"] == 2) echo "Condition II"; ?>
            </td>
            <td bgcolor="#E4E4E4" align="left">
              <font size='2'><?php echo date("m/d/Y", strtotime($MGArraytmp2['last_order_date'])); ?></font>
            </td>
            <td align="right" bgcolor="#E4E4E4">
              <font size='2'><?php echo $MGArraytmp2["tot_orders"]; ?></font>
            </td>
            <td align="right" bgcolor="#E4E4E4">
              <font size='2'>$<?php echo number_format($MGArraytmp2["tot_orders_val"], 0); ?></font>
            </td>
            <td align="right" bgcolor="#E4E4E4">
              <font size='2'><?php echo $MGArraytmp2["avg_time_order"]; ?></font>
            </td>
            <td align="right" bgcolor="#E4E4E4">
              <font size='2'><?php echo $MGArraytmp2["no_days_n"]; ?></font>
            </td>
            <td align="right" bgcolor="#E4E4E4">
              <font size='2'><?php echo $MGArraytmp2['rep_name']; ?></font>
            </td>
            <td align="right" bgcolor="#E4E4E4">
              <font size='2'><?php echo $MGArraytmp2["acc_status"]; ?></font>
            </td>
            <td bgcolor="<?php echo $bgcolor; ?>" align="left">
              <font size='2'><?php if ($MGArraytmp2['last_contact_dt'] != "") {
                echo date("m/d/Y", strtotime($MGArraytmp2['last_contact_dt'])) . " " . $last_contactdays;
                } else {
                echo "";
                } ?> </font>
            </td>
            <td bgcolor="#E4E4E4" align="center" width="250px">
              <font size='2'>
                <?php echo $MGArraytmp2["next_step"]; ?>
              </font>
            </td>
            <td bgcolor="#E4E4E4" align="center">
              <font size='2'><?php if ($MGArraytmp2["next_date"] != "") {
                echo date('m/d/Y', strtotime($MGArraytmp2["next_date"]));
                } else {
                echo "";
                } ?></font>
            </td>
          </tr>
          <?php
            $cnt_no = $cnt_no + 1;
            }
            }
            
            if (isset($_REQUEST["sort_fld"])) {
            
            $rep_order = "company_name";
            if (isset($_REQUEST["sort_fld"])) {
            $rep_order = $_REQUEST["sort_fld"];
            }
            
            $MGArray = $_SESSION['sortarrayn'];
            
            if ($_REQUEST['sort_fld'] == "company_name") {
            $MGArraysort_I = array();
            $MGArraysort_II = array();
            
            foreach ($MGArray as $MGArraytmp) {
            	$MGArraysort_I[] = $MGArraytmp['company_name'];
            	$MGArraysort_II[] = $MGArraytmp['tot_orders_val'];
            }
            if ($_REQUEST['sort_order_pre'] == "ASC") {
            	//array_multisort($MGArraysort_II, SORT_DESC, SORT_NUMERIC, $MGArraysort_I,SORT_ASC,SORT_STRING,$MGArray); 
            	array_multisort($MGArraysort_I, SORT_ASC, SORT_STRING, $MGArray);
            }
            if ($_REQUEST['sort_order_pre'] == "DESC") {
            	//array_multisort($MGArraysort_II, SORT_DESC, SORT_NUMERIC, $MGArraysort_I,SORT_DESC,SORT_STRING,$MGArray); 
            	array_multisort($MGArraysort_I, SORT_DESC, SORT_STRING, $MGArray);
            }
            }
            
            if ($_REQUEST['sort_fld'] == "acc_status") {
            $MGArraysort_I = array();
            $MGArraysort_II = array();
            
            foreach ($MGArray as $MGArraytmp) {
            	$MGArraysort_I[] = $MGArraytmp['acc_status'];
            	$MGArraysort_II[] = $MGArraytmp['tot_orders_val'];
            }
            if ($_REQUEST['sort_order_pre'] == "ASC") {
            	//array_multisort($MGArraysort_II, SORT_DESC, SORT_NUMERIC, $MGArraysort_I,SORT_ASC,SORT_STRING,$MGArray); 
            	array_multisort($MGArraysort_I, SORT_ASC, SORT_STRING, $MGArray);
            }
            if ($_REQUEST['sort_order_pre'] == "DESC") {
            	//array_multisort($MGArraysort_II, SORT_DESC, SORT_NUMERIC, $MGArraysort_I,SORT_DESC,SORT_STRING,$MGArray); 
            	array_multisort($MGArraysort_I, SORT_DESC, SORT_STRING, $MGArray);
            }
            }
            
            if ($_REQUEST['sort_fld'] == "nextstepdt") {
            $MGArraysort_I = array();
            $MGArraysort_II = array();
            
            foreach ($MGArray as $MGArraytmp) {
            	$MGArraysort_I[] = $MGArraytmp['next_date'];
            	$MGArraysort_II[] = $MGArraytmp['tot_orders_val'];
            }
            if ($_REQUEST['sort_order_pre'] == "ASC") {
            	//array_multisort($MGArraysort_II, SORT_DESC, SORT_NUMERIC, $MGArraysort_I,SORT_ASC,SORT_STRING,$MGArray); 
            	array_multisort($MGArraysort_I, SORT_ASC, SORT_STRING, $MGArray);
            }
            if ($_REQUEST['sort_order_pre'] == "DESC") {
            	//array_multisort($MGArraysort_II, SORT_DESC, SORT_NUMERIC, $MGArraysort_I,SORT_DESC,SORT_STRING,$MGArray); 
            	array_multisort($MGArraysort_I, SORT_DESC, SORT_STRING, $MGArray);
            }
            }
            
            if ($_REQUEST['sort_fld'] == "phoneno") {
            $MGArraysort_I = array();
            $MGArraysort_II = array();
            
            foreach ($MGArray as $MGArraytmp) {
            	$MGArraysort_I[] = $MGArraytmp['sellto_main_line_ph'];
            	$MGArraysort_II[] = $MGArraytmp['tot_orders_val'];
            }
            if ($_REQUEST['sort_order_pre'] == "ASC") {
            	//array_multisort($MGArraysort_II, SORT_DESC, SORT_NUMERIC, $MGArraysort_I,SORT_ASC,SORT_STRING,$MGArray); 
            	array_multisort($MGArraysort_I, SORT_ASC, SORT_STRING, $MGArray);
            }
            if ($_REQUEST['sort_order_pre'] == "DESC") {
            	//array_multisort($MGArraysort_II, SORT_DESC, SORT_NUMERIC, $MGArraysort_I,SORT_DESC,SORT_STRING,$MGArray); 
            	array_multisort($MGArraysort_I, SORT_DESC, SORT_STRING, $MGArray);
            }
            }
            
            if ($_REQUEST['sort_fld'] == "email") {
            $MGArraysort_I = array();
            $MGArraysort_II = array();
            
            foreach ($MGArray as $MGArraytmp) {
            	$MGArraysort_I[] = $MGArraytmp['email'];
            	$MGArraysort_II[] = $MGArraytmp['tot_orders_val'];
            }
            if ($_REQUEST['sort_order_pre'] == "ASC") {
            	//array_multisort($MGArraysort_II, SORT_DESC, SORT_NUMERIC, $MGArraysort_I,SORT_ASC,SORT_STRING,$MGArray); 
            	array_multisort($MGArraysort_I, SORT_ASC, SORT_STRING, $MGArray);
            }
            if ($_REQUEST['sort_order_pre'] == "DESC") {
            	//array_multisort($MGArraysort_II, SORT_DESC, SORT_NUMERIC, $MGArraysort_I,SORT_DESC,SORT_STRING,$MGArray); 
            	array_multisort($MGArraysort_I, SORT_DESC, SORT_STRING, $MGArray);
            }
            }
            
            if ($_REQUEST['sort_fld'] == "last_order_date") {
            $MGArraysort_I = array();
            $MGArraysort_II = array();
            
            foreach ($MGArray as $MGArraytmp) {
            	$MGArraysort_I[] = $MGArraytmp['last_order_date'];
            	$MGArraysort_II[] = $MGArraytmp['tot_orders_val'];
            }
            if ($_REQUEST['sort_order_pre'] == "ASC") {
            	//array_multisort($MGArraysort_II, SORT_DESC, SORT_NUMERIC, $MGArraysort_I,SORT_ASC,SORT_STRING,$MGArray); 
            	array_multisort($MGArraysort_I, SORT_ASC, SORT_STRING, $MGArray);
            }
            if ($_REQUEST['sort_order_pre'] == "DESC") {
            	//array_multisort($MGArraysort_II, SORT_DESC, SORT_NUMERIC, $MGArraysort_I,SORT_DESC,SORT_STRING,$MGArray); 
            	array_multisort($MGArraysort_I, SORT_DESC, SORT_STRING, $MGArray);
            }
            }
            
            if ($_REQUEST['sort_fld'] == "totorder") {
            $MGArraysort_I = array();
            $MGArraysort_II = array();
            
            foreach ($MGArray as $MGArraytmp) {
            	$MGArraysort_I[] = $MGArraytmp['tot_orders'];
            	$MGArraysort_II[] = $MGArraytmp['tot_orders_val'];
            }
            if ($_REQUEST['sort_order_pre'] == "ASC") {
            	//array_multisort($MGArraysort_II, SORT_DESC, SORT_NUMERIC, $MGArraysort_I,SORT_ASC,SORT_NUMERIC,$MGArray); 
            	array_multisort($MGArraysort_I, SORT_ASC, SORT_NUMERIC, $MGArray);
            }
            if ($_REQUEST['sort_order_pre'] == "DESC") {
            	//array_multisort($MGArraysort_II, SORT_DESC, SORT_NUMERIC, $MGArraysort_I,SORT_DESC,SORT_NUMERIC,$MGArray); 
            	array_multisort($MGArraysort_I, SORT_DESC, SORT_NUMERIC, $MGArray);
            }
            }
            
            if ($_REQUEST['sort_fld'] == "totorderval") {
            $MGArraysort_I = array();
            
            foreach ($MGArray as $MGArraytmp) {
            	$MGArraysort_I[] = $MGArraytmp['tot_orders_val'];
            }
            if ($_REQUEST['sort_order_pre'] == "ASC") {
            	array_multisort($MGArraysort_I, SORT_ASC, SORT_NUMERIC, $MGArray);
            }
            if ($_REQUEST['sort_order_pre'] == "DESC") {
            	array_multisort($MGArraysort_I, SORT_DESC, SORT_NUMERIC, $MGArray);
            }
            }
            
            if ($_REQUEST['sort_fld'] == "avg_time_order") {
            $MGArraysort_I = array();
            $MGArraysort_II = array();
            
            foreach ($MGArray as $MGArraytmp) {
            	$MGArraysort_I[] = $MGArraytmp['avg_time_order'];
            	$MGArraysort_II[] = $MGArraytmp['tot_orders_val'];
            }
            if ($_REQUEST['sort_order_pre'] == "ASC") {
            	//array_multisort($MGArraysort_II, SORT_DESC, SORT_NUMERIC, $MGArraysort_I,SORT_ASC,SORT_NUMERIC,$MGArray); 
            	array_multisort($MGArraysort_I, SORT_ASC, SORT_NUMERIC, $MGArray);
            }
            if ($_REQUEST['sort_order_pre'] == "DESC") {
            	//array_multisort($MGArraysort_II, SORT_DESC, SORT_NUMERIC, $MGArraysort_I,SORT_DESC,SORT_NUMERIC,$MGArray); 
            	array_multisort($MGArraysort_I, SORT_DESC, SORT_NUMERIC, $MGArray);
            }
            }
            if ($_REQUEST['sort_fld'] == "no_days") {
            $MGArraysort_I = array();
            $MGArraysort_II = array();
            
            foreach ($MGArray as $MGArraytmp) {
            	$MGArraysort_I[] = $MGArraytmp['no_days'];
            	$MGArraysort_II[] = $MGArraytmp['tot_orders_val'];
            }
            if ($_REQUEST['sort_order_pre'] == "ASC") {
            	//array_multisort($MGArraysort_II, SORT_DESC, SORT_NUMERIC, $MGArraysort_I,SORT_ASC,SORT_NUMERIC,$MGArray); 
            	array_multisort($MGArraysort_I, SORT_ASC, SORT_NUMERIC, $MGArray);
            }
            if ($_REQUEST['sort_order_pre'] == "DESC") {
            	//array_multisort($MGArraysort_II, SORT_DESC, SORT_NUMERIC, $MGArraysort_I,SORT_DESC,SORT_NUMERIC,$MGArray); 
            	array_multisort($MGArraysort_I, SORT_DESC, SORT_NUMERIC, $MGArray);
            }
            }
            if ($_REQUEST['sort_fld'] == "rep_name") {
            $MGArraysort_I = array();
            $MGArraysort_II = array();
            
            foreach ($MGArray as $MGArraytmp) {
            	$MGArraysort_I[] = $MGArraytmp['rep_name'];
            	$MGArraysort_II[] = $MGArraytmp['tot_orders_val'];
            }
            if ($_REQUEST['sort_order_pre'] == "ASC") {
            	//array_multisort($MGArraysort_II, SORT_DESC, SORT_NUMERIC, $MGArraysort_I,SORT_ASC,SORT_STRING,$MGArray); 
            	array_multisort($MGArraysort_I, SORT_ASC, SORT_STRING, $MGArray);
            }
            if ($_REQUEST['sort_order_pre'] == "DESC") {
            	//array_multisort($MGArraysort_II, SORT_DESC, SORT_NUMERIC, $MGArraysort_I,SORT_DESC,SORT_STRING,$MGArray); 
            	array_multisort($MGArraysort_I, SORT_DESC, SORT_STRING, $MGArray);
            }
            }
            if ($_REQUEST['sort_fld'] == "lastcontactdt") {
            $MGArraysort_I = array();
            $MGArraysort_II = array();
            
            foreach ($MGArray as $MGArraytmp) {
            	$MGArraysort_I[] = $MGArraytmp['last_contact_dt'];
            	$MGArraysort_II[] = $MGArraytmp['tot_orders_val'];
            }
            if ($_REQUEST['sort_order_pre'] == "ASC") {
            	//array_multisort($MGArraysort_II, SORT_DESC, SORT_NUMERIC, $MGArraysort_I,SORT_ASC,SORT_STRING,$MGArray); 
            	array_multisort($MGArraysort_I, SORT_ASC, SORT_STRING, $MGArray);
            }
            if ($_REQUEST['sort_order_pre'] == "DESC") {
            	//array_multisort($MGArraysort_II, SORT_DESC, SORT_NUMERIC, $MGArraysort_I,SORT_DESC,SORT_STRING,$MGArray); 
            	array_multisort($MGArraysort_I, SORT_DESC, SORT_STRING, $MGArray);
            }
            }
            if ($_REQUEST['sort_fld'] == "nextstep") {
            $MGArraysort_I = array();
            $MGArraysort_II = array();
            foreach ($MGArray as $MGArraytmp) {
            	$MGArraysort_I[] = $MGArraytmp['next_step'];
            	$MGArraysort_II[] = $MGArraytmp['tot_orders_val'];
            }
            if ($_REQUEST['sort_order_pre'] == "ASC") {
            	//array_multisort($MGArraysort_II, SORT_DESC, SORT_NUMERIC, $MGArraysort_I,SORT_ASC,SORT_STRING,$MGArray); 
            	array_multisort($MGArraysort_I, SORT_ASC, SORT_STRING, $MGArray);
            }
            if ($_REQUEST['sort_order_pre'] == "DESC") {
            	//array_multisort($MGArraysort_II, SORT_DESC, SORT_NUMERIC, $MGArraysort_I,SORT_DESC,SORT_STRING,$MGArray); 
            	array_multisort($MGArraysort_I, SORT_DESC, SORT_STRING, $MGArray);
            }
            }
            
            $cnt_no = 1;
            foreach ($MGArray as $MGArraytmp2) {
            if ($MGArraytmp2['last_contact_dt'] != "") {
            	$todays_dt = date('Y-m-d');
            	$cnt_date = dateDiff($MGArraytmp2['last_contact_dt'], $todays_dt);
            	if ($cnt_date > 91) {
            		$bgcolor = "red";
            		$last_contactdays = "(" . $cnt_date . " days ago)";
            	} else {
            		$bgcolor = "#E4E4E4";
            		$last_contactdays = "";
            	}
            }
            ?>
          <tr id="main_div<?php echo $cnt_no ?>">
            <td bgcolor="#E4E4E4"><?php echo $cnt_no; ?></td>
            <td bgcolor="#E4E4E4"><b><a style="color:#006600" href="http://loops.usedcardboardboxes.com/search_results.php?id=<?php echo $MGArraytmp2["warehouse_id"]; ?>&proc=View&searchcrit=&rec_type=Manufacturer&page=0" target="_blank">
              <font size='2'><?php echo $MGArraytmp2["company_name"]; ?></font>
              </a></b>
            </td>
            <td bgcolor="#E4E4E4" align="left">
              <font size='2'><?php echo date("m/d/Y", strtotime($MGArraytmp2['last_order_date'])); ?></font>
            </td>
            <td align="right" bgcolor="#E4E4E4">
              <font size='2'><?php echo $MGArraytmp2["tot_orders"]; ?></font>
            </td>
            <td align="right" bgcolor="#E4E4E4">
              <font size='2'>$<?php echo number_format($MGArraytmp2["tot_orders_val"], 0); ?></font>
            </td>
            <td align="right" bgcolor="#E4E4E4">
              <font size='2'><?php echo $MGArraytmp2["avg_time_order"]; ?></font>
            </td>
            <td align="right" bgcolor="#E4E4E4">
              <font size='2'><?php echo $MGArraytmp2["no_days_n"]; ?></font>
            </td>
            <td align="right" bgcolor="#E4E4E4">
              <font size='2'><?php echo $MGArraytmp2['rep_name']; ?></font>
            </td>
            <td align="right" bgcolor="#E4E4E4">
              <font size='2'><?php echo $MGArraytmp2["acc_status"]; ?></font>
            </td>
            <td bgcolor="<?php echo $bgcolor; ?>" align="left">
              <font size='2'><?php if ($MGArraytmp2['last_contact_dt'] != "") {
                echo date("m/d/Y", strtotime($MGArraytmp2['last_contact_dt'])) . " " . $last_contactdays;
                } else {
                echo "";
                } ?></font>
            </td>
            <td bgcolor="#E4E4E4" align="center" width="250px">
              <font size='2'>
                <?php echo $MGArraytmp2["next_step"]; ?>
              </font>
            </td>
            <td bgcolor="#E4E4E4" align="center">
              <font size='2'><?php if ($MGArraytmp2["next_date"] != "") {
                echo date('m/d/Y', strtotime($MGArraytmp2["next_date"]));
                } else {
                echo "";
                } ?></font>
            </td>
          </tr>
          <?
            $cnt_no = $cnt_no + 1;
            }
            }
            
            ?>
        </table>
      </form>
      <div><i>
        <font color="red">"END OF REPORT"</font>
        </i>
      </div>
      <?php
        } // session else part ends here.
        } // if submit ends here
        ?>
    </div>
  </body>
</html>