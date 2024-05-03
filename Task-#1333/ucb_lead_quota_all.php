<?php
  require_once("inc/header_session.php");
  require_once("../mainfunctions/database.php");
  require_once("../mainfunctions/general-functions.php");
  
  if (isset($_REQUEST['tblname']) && $_REQUEST['tblname'] == 2) {
  	$tblname = "employee_quota_overall_GMI";
  	$orderstr = " quota_year, quota_month";
  	$title	 = "GMI";
  } elseif (isset($_REQUEST['tblname']) && $_REQUEST['tblname'] == 3) {
  	$tblname = "employee_quota_overall_UCBZW";
  	$orderstr = " quota_year, quota_month";
  	$title	 = "UCBZW";
  } elseif (isset($_REQUEST['tblname']) && $_REQUEST['tblname'] == 4) {
  	$tblname = "employee_quota_overall_purchasing";
  	$orderstr = "b2borb2c, quota_year, quota_month";
  	$title	 = "B2B Purchasing";
  } elseif (isset($_REQUEST['tblname']) && $_REQUEST['tblname'] == 5) {
  	$tblname = "employee_quota_overall";
  	$orderstr = "b2borb2c, quota_year, quota_month";
  	$title	 = "B2C";
  } elseif (isset($_REQUEST['tblname']) && $_REQUEST['tblname'] == 6) {
  	$tblname = "employee_quota_overall_sales_gp";
  	$orderstr = "b2borb2c, quota_year, quota_month";
  	$title	 = "B2B Sales Gross Profit";
  } elseif (isset($_REQUEST['tblname']) && $_REQUEST['tblname'] == 7) {
  	$tblname = "employee_quota_overall_purchasing_gp";
  	$orderstr = "b2borb2c, quota_year, quota_month";
  	$title	 = "B2B Purchasing Gross Profit";
  } elseif (isset($_REQUEST['tblname']) && $_REQUEST['tblname'] == 8) {
  	$tblname = "employee_quota_overall_ucbzw_share";
  	$orderstr = " quota_year, quota_month";
  	$title	 = "UCBZW Share";
  } elseif (isset($_REQUEST['tblname']) && $_REQUEST['tblname'] == 9) {
  	$tblname = "employee_quota_overall_stretch_g";
  	$orderstr = " quota_year, quota_month";
  	$title	 = "B2B Stretch Goal";
  } elseif (isset($_REQUEST['tblname']) && $_REQUEST['tblname'] == 10) {
  	$tblname = "employee_quota_overall_stretch_gprofit";
  	$orderstr = " quota_year, quota_month";
  	$title	 = "B2B Stretch Goal Gross Profit";
  } elseif (isset($_REQUEST['tblname']) && $_REQUEST['tblname'] == 11) {
  	$tblname = "employee_quota_overall_pallet_sale";
  	$orderstr = " quota_year, quota_month";
  	$title	 = "Pallets Revenue Quota";
  } elseif (isset($_REQUEST['tblname']) && $_REQUEST['tblname'] == 12) {
  	$tblname = "employee_quota_overall_pallet_sale_stretch";
  	$orderstr = " quota_year, quota_month";
  	$title	 = "Pallets Revenue Stretch";
  } elseif (isset($_REQUEST['tblname']) && $_REQUEST['tblname'] == 13) {
  	$tblname = "employee_quota_overall_pallet_gprofit";
  	$orderstr = " quota_year, quota_month";
  	$title	 = "Pallets G.Profit Quota";
  } elseif (isset($_REQUEST['tblname']) && $_REQUEST['tblname'] == 14) {
  	$tblname = "employee_quota_overall_pallet_gprofit_stretch";
  	$orderstr = " quota_year, quota_month";
  	$title	 = "Pallets G.Profit Stretch";
  } else {
  	$tblname = "employee_quota_overall";
  	$orderstr = "b2borb2c, quota_year, quota_month";
  	$title	 = "B2B Sales";
  }
  
  /////////////////////////////////////////////////////////////////// 
  
  
  if (isset($_REQUEST["unqid_del"])) {
  
  	if ($_REQUEST["unqid_del"] != "") {
		db();
  		$sql = "delete from " . $tblname . " WHERE unqid = " . (int)$_REQUEST["unqid_del"];
  
  		$result = db_query($sql);
  	}
  }
  
  if (isset($_REQUEST["btnedit_save"]) && isset($_REQUEST["btnedit"])) {
  	$b2borb2c = '';
  	if ($_REQUEST['tblname'] == 1) {
  		$b2borb2c = 'b2b';
  	}
  	if ($_REQUEST['tblname'] == 4) {
  		$b2borb2c = 'b2b';
  	}
  	if ($_REQUEST['tblname'] == 5) {
  		$b2borb2c = 'b2c';
  	}
  	if ($_REQUEST['tblname'] == 6) {
  		$b2borb2c = 'b2bgp';
  	}
  	if ($_REQUEST['tblname'] == 7) {
  		$b2borb2c = 'b2bpgp';
  	}
	
  	if (in_array($_REQUEST['tblname'], array(1, 4, 5, 6, 7))) {
  		$sql = "Update " . $tblname . " set b2borb2c = '" . $b2borb2c . "', quota_year = '" . $_POST["edit_quota_year"] . "', quota_month = '" . $_POST["edit_quota_month"] . "', quota = '" . str_replace(",", "", $_POST["edit_quota"]) . "', deal_quota = '" . str_replace(",", "", $_POST["edit_dealquota"]) . "' WHERE unqid = " . (int)$_POST["btnedit_save"];
  	} else {
  		$sql = "Update " . $tblname . " set quota_year = '" . $_POST["edit_quota_year"] . "', quota_month = '" . $_POST["edit_quota_month"] . "', quota = '" . str_replace(",", "", $_POST["edit_quota"]) . "', deal_quota = '" . str_replace(",", "", $_POST["edit_dealquota"]) . "' WHERE unqid = " . (int)$_POST["btnedit_save"];
  	}
	db();
  	$result = db_query($sql);
  }

  if (isset($_REQUEST["btnsave"]) && $_REQUEST["btnsave"] == 'Save') {
  
  	$b2borb2c = '';
  	if ($_REQUEST['tblname'] == 1) {
  		$b2borb2c = 'b2b';
  	}
  	if ($_REQUEST['tblname'] == 4) {
  		$b2borb2c = 'b2b';
  	}
  	if ($_REQUEST['tblname'] == 5) {
  		$b2borb2c = 'b2c';
  	}
  	if ($_REQUEST['tblname'] == 6) {
  		$b2borb2c = 'b2bgp';
  	}
  	if ($_REQUEST['tblname'] == 7) {
  		$b2borb2c = 'b2bpgp';
  	}
  	if (in_array($_REQUEST['tblname'], array(1, 4, 5, 6, 7))) {
  		$sql = "Insert into " . $tblname . " (b2borb2c, quota_year, quota_month, quota, deal_quota) values('" . $b2borb2c . "', '" . $_POST["quota_year"] . "', '" . $_POST["quota_month"] . "', '" . str_replace(",", "", $_POST["add_quota"]) . "' , '" . str_replace(",", "", $_POST["add_dealquota"]) . "')";
  	} else {
  		$sql = "Insert into " . $tblname . " (quota_year, quota_month, quota, deal_quota) values('" . $_POST["quota_year"] . "', '" . $_POST["quota_month"] . "', '" . str_replace(",", "", $_POST["add_quota"]) . "' , '" . str_replace(",", "", $_POST["add_dealquota"]) . "')";
  	}
	db();
  	$result = db_query($sql);
  }
  
  ?>
<html>
  <head>
    <title>UCB Department Quota Tool - <?php echo $title; ?></title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <script LANGUAGE="JavaScript">
      function Del_warn(unqid) {
      	var option = confirm("Are you sure you want to delete this record?");
      	if (option == true) {
      		document.getElementById('unqid_del').value = unqid;
      	}
      }
      
      function edit_data(unqid) {
      	document.getElementById('unqid_edit').value = unqid;
      }
      
      function Add_quota() {
      	document.getElementById('unqid_add').value = "chk";
      }
      
      function btnsave_check() {
      
      	if (document.getElementById('quota_month').value == "") {
      		alert('Please select Quota Month');
      		return false;
      
      	} else if (document.getElementById('quota_year').value == "") {
      		alert('Please select Quota Year');
      		return false;
      
      	} else if (document.getElementById('add_quota').value == "") {
      		alert('Please enter Quota Value');
      		return false;
      
      	} else {
      		return true;
      	}
      }
      
      function btnedit_check() {
      
      	if (document.getElementById('edit_quota_month').value == "") {
      		alert('Please select Quota Month');
      		return false;
      
      	} else if (document.getElementById('edit_quota_year').value == "") {
      		alert('Please select Quota Year');
      		return false;
      
      	} else if (document.getElementById('edit_quota').value == "") {
      		alert('Please enter Quota Value');
      		return false;
      
      	} else {
      		return true;
      	}
      }
    </script>
    <LINK rel='stylesheet' type='text/css' href='one_style.css'>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/ucb_common_style.css">
    <style>
      .txtstyle_color {
      font-size: 14px;
      background: #ABC5DF;
      font-weight: 600;
      font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif !important;
      }
    </style>
  </head>
  <body>
    <?php include_once("inc/header.php"); ?>
    <div class="main_data_css">
      <div class="dashboard_heading" style="float: left;">
        <div style="float: left;">
          UCB Department Quota Tool
          <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
            <span class="tooltiptext">This tool allows the user to update the UCB department quotas for B2B Sales, B2B Purchasing, B2C, GMI and UCBZW. These values are then used to populate the UCB Sales Leaderboard. If you are looking to update an employee quota, that is done in the Office Employee Database.</span>
          </div>
        </div>
      </div>
      <div class="">
        <form method="post" name="leadfrm" action="ucb_lead_quota_all.php">
          <table>
            <tr>
              <td>Department</td>
              <td>
                <select name="tblname">
                  <option value="1" <?php echo ($_REQUEST['tblname'] == '1') ? "selected" : "" ?>>B2B Sales</option>
                  <option value="4" <?php echo ($_REQUEST['tblname'] == '4') ? "selected" : "" ?>>B2B Purchasing</option>
                  <option value="5" <?php echo ($_REQUEST['tblname'] == '5') ? "selected" : "" ?>>B2C</option>
                  <option value="2" <?php echo ($_REQUEST['tblname'] == '2') ? "selected" : "" ?>>GMI</option>
                  <option value="3" <?php echo ($_REQUEST['tblname'] == '3') ? "selected" : "" ?>>UCBZW</option>
                  <option value="6" <?php echo ($_REQUEST['tblname'] == '6') ? "selected" : "" ?>>B2B Sales G. Profit</option>
                  <option value="7" <?php echo ($_REQUEST['tblname'] == '7') ? "selected" : "" ?>>B2B Purchasing G. Profit</option>
                  <option value="8" <?php echo ($_REQUEST['tblname'] == '8') ? "selected" : "" ?>>UCBZW Share</option>
                  <option value="9" <?php echo ($_REQUEST['tblname'] == '9') ? "selected" : "" ?>>B2B Stretch Goal</option>
                  <option value="10" <?php echo ($_REQUEST['tblname'] == '10') ? "selected" : "" ?>>B2B Stretch Goal G. Profit</option>
                  <option value="11" <?php echo ($_REQUEST['tblname'] == '11') ? "selected" : "" ?>>Pallets Revenue Quota</option>
                  <option value="12" <?php echo ($_REQUEST['tblname'] == '12') ? "selected" : "" ?>>Pallets Revenue Stretch</option>
                  <option value="13" <?php echo ($_REQUEST['tblname'] == '13') ? "selected" : "" ?>>Pallets G.Profit Quota</option>
                  <option value="14" <?php echo ($_REQUEST['tblname'] == '14') ? "selected" : "" ?>>Pallets G.Profit Stretch</option>
                </select>
              </td>
              <td><input type="submit" name="btnfilter" value="Submit"> </td>
            </tr>
          </table>
          <div class="dashboard_heading"><?php echo $title ?></div>
          <?php
            if (isset($_REQUEST["unqid_edit"]) || isset($_REQUEST["unqid_add"])) {
            
            	if ($_REQUEST["unqid_edit"] != "") {
					db();

            		$sql = "SELECT * FROM " . $tblname . " WHERE unqid = " . (int)$_REQUEST["unqid_edit"] . "";
            
            		$result = db_query($sql);
            
            		$rowemp = array_shift($result);
            
            		$b2bflg = "";
            		$b2cflg = "";
            		if ($rowemp["b2borb2c"] == 'b2b') {
            			$b2bflg = " selected ";
            		}
            		if ($rowemp["b2borb2c"] == 'b2c') {
            			$b2cflg = " selected ";
            		}
            
            		echo '<br><hr width="70%" color="#CCC" align="left"><table>';
            
            		if ($tblname == 'employee_quota_overall' || $tblname == 'employee_quota_overall_purchasing') {
            
            		}
            
            		echo "<tr><td>Quota Date: </td><td> ";
            
            		echo "<select name='edit_quota_month' id='edit_quota_month' >";
            
            		echo "<option value=''>Quota month</option>";
            
            		for ($month_cnt = 1; $month_cnt <= 12; $month_cnt++) {
            
            			echo "<option value=" . $month_cnt . " ";
            
            			if ($rowemp["quota_month"] == $month_cnt) {
            				echo " selected ";
            			}
            
            			echo " >" . date("F", mktime(0, 0, 0, $month_cnt, 10)) . "</option>";
            		}
            
            		echo "</select>&nbsp;&nbsp;";
            
            		echo "<select name='edit_quota_year' id='edit_quota_year' >";
            
            		echo "	<option value=''>Quota Year</option>";
            
            		for ($yr_cnt = date("Y") - 10; $yr_cnt <= date("Y") + 1; $yr_cnt++) {
            
            			echo "<option value=" . $yr_cnt . " ";
            
            			if ($rowemp["quota_year"] == $yr_cnt) {
            				echo " selected ";
            			}
            
            			echo " >" . $yr_cnt . "</option>";
            		}
            
            		echo "</select>";
            
            		echo "</td></tr>";
        
            		echo "<tr><td>Quota: </td><td><input type='text' id='edit_quota' name='edit_quota' value='" . $rowemp["quota"] . "'/></td></tr>";
            		echo "<tr><td>Deals Quota: </td><td><input type='text' name='edit_dealquota' value='" . $rowemp["deal_quota"] . "'/></td></tr>";
            
            		echo "<tr><td colspan='2'><input type='hidden' name='btnedit_save' id='btnedit_save' value='" . $_REQUEST["unqid_edit"] . "' /><input onclick='return btnedit_check();' type='submit' name='btnedit' value='Save'/></td></tr>";
            
            		echo "</table>";
            	}
        
            
            	if ($_REQUEST["unqid_add"] == "chk") { ?>
          <br>
          <hr width="70%" color="#CCC" align="left">
          <table>
            <?php
              if ($tblname == 'employee_quota_overall' || $tblname == 'employee_quota_overall_purchasing') {
              ?>
        
            <?php } ?>
            <tr>
              <td>Quota Date: </td>
              <td>
                <select name="quota_month" id="quota_month">
                  <option value="">Quota month</option>
                  <?php
                    for ($month_cnt = 1; $month_cnt <= 12; $month_cnt++) {
                    
                    	echo "<option value=" . $month_cnt . " ";
                    
                    	echo " >" . date("F", mktime(0, 0, 0, $month_cnt, 10)) . "</option>";
                    }
                    
                    ?>
                </select>
                &nbsp;&nbsp;
                <select name="quota_year" id="quota_year">
                  <option value="">Quota Year</option>
                  <?php
                    for ($yr_cnt = date("Y") - 10; $yr_cnt <= date("Y") + 1; $yr_cnt++) {
                    
                    	echo "<option value=" . $yr_cnt . " ";
                    
                    	if (date("Y") == $yr_cnt) {
                    		echo " selected ";
                    	}
                    
                    	echo " >" . $yr_cnt . "</option>";
                    }
                    
                    ?>
                </select>
              </td>
            </tr>
            <tr>
              <td>Quota: </td>
              <td><input type='text' id='add_quota' name='add_quota' value='' /><br></td>
            </tr>
            <tr>
              <td>Deals Quota: </td>
              <td><input type='text' name='add_dealquota' value='' /><br></td>
            </tr>
            <tr>
              <td colspan='2'>
                <input onclick='return btnsave_check();' type='submit' name='btnsave' value='Save' />
                <br><br>
              </td>
            </tr>
          </table>
          <?php  }   // add closed.
            }   // if  add edit closed.
            
            ?>
          <table>
            <tr>
              <?php
                if ($tblname == 'employee_quota_overall' || $tblname == 'employee_quota_overall_purchasing' || $tblname == 'employee_quota_overall_sales_gp' || $tblname == 'employee_quota_overall_purchasing_gp') {
                	echo '<th class="txtstyle_color">B2B/B2C</th>';
                }
                ?>
              <th class="txtstyle_color">Quota Year</th>
              <th class="txtstyle_color">Quota Month</th>
              <th class="txtstyle_color">Quota</th>
              <th class="txtstyle_color">Deals Quota</th>
              <th class="txtstyle_color">&nbsp;</th>
              <th class="txtstyle_color">&nbsp;</th>
            </tr>
            <?php
              //$flg_show = "";
              if ($_REQUEST['tblname'] == 5) {
              	$sql = "SELECT * FROM " . $tblname . " WHERE b2borb2c = 'b2c'  ORDER BY " . $orderstr;
              } elseif (
              	$_REQUEST['tblname'] == 2 || $_REQUEST['tblname'] == 3 || $_REQUEST['tblname'] == 8 || $_REQUEST['tblname'] == 9
              	|| $_REQUEST['tblname'] == 10 || $_REQUEST['tblname'] == 11 || $_REQUEST['tblname'] == 12 || $_REQUEST['tblname'] == 13 || $_REQUEST['tblname'] == 14
              ) {
              	$sql = "SELECT * FROM " . $tblname . "  ORDER BY " . $orderstr;
              } elseif ($_REQUEST['tblname'] == 6) {
              	$sql = "SELECT * FROM " . $tblname . "  WHERE b2borb2c = 'b2bgp' ORDER BY " . $orderstr;
              } elseif ($_REQUEST['tblname'] == 7) {
              	$sql = "SELECT * FROM " . $tblname . "  WHERE b2borb2c = 'b2bpgp' ORDER BY " . $orderstr;
              } else {
              	$sql = "SELECT * FROM " . $tblname . " WHERE b2borb2c = 'b2b'  ORDER BY " . $orderstr;
              }
              db();
              $result = db_query($sql);
              while ($rowemp = array_shift($result)) {
              
              	echo "<tr>";
              
              	if ($tblname == 'employee_quota_overall' || in_array($_REQUEST['tblname'], array(1, 4, 5, 6, 7))) {
              		echo "<td bgColor='#E4EAEB' >" . $rowemp["b2borb2c"] . "</td>";
              	}
              	echo "<td bgColor='#E4EAEB' >" . $rowemp["quota_year"] . "</td>";
              	echo "<td bgColor='#E4EAEB' >" . date("F", mktime(0, 0, 0, $rowemp["quota_month"], 10)) . "</td>";
              	echo "<td bgColor='#E4EAEB' >" . $rowemp["quota"] . "</td>";
              	echo "<td bgColor='#E4EAEB' >" . $rowemp["deal_quota"] . "</td>";
              	echo "<td><input type='submit' name='btnedit' value='Edit'  onclick='edit_data(" . $rowemp["unqid"] . ")'/></td>";
              	echo "<td><input type='submit' name='btndel' value='Delete' onclick='Del_warn(" . $rowemp["unqid"] . ")'/></td></tr>";
              ?>
            <?php  }  ?>
            <tr>
              <td colspan="6">
                <input type="hidden" name="unqid_del" id="unqid_del" value="" />
                <input type="hidden" name="unqid_edit" id="unqid_edit" value="" />
                <input type="hidden" name="unqid_add" id="unqid_add" value="" />
                <input type="Submit" name="btnsubmit" value="Add Quota" onclick='Add_quota()' />
              </td>
            </tr>
          </table>
        </form>
      </div>
    </div>
  </body>
</html>