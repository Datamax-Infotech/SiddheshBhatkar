<?php
	require ("inc/header_session.php");
	require ("mainfunctions/database.php");
	require ("mainfunctions/general-functions.php");
   
   	session_start();

	$st_friday_last = date('m') . "/01/" . date('Y');
   
   	$st_thursday_last = Date('m/d/Y');

   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Call List Report - B2B Purchasing</title>
      <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
      <link rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script>
         function update_status(req_id)
         
         {
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
         			alert(xmlhttp.responseText);
         		}
         	}
         	xmlhttp.open("GET","report_sales_team_update.php?req_id="+req_id,true);
         
         	xmlhttp.send();		
         }
         
         function setseldropdown(selid)
         {
         	if (selid == 1){
         		document.getElementById("owned_rec").value = "";
         	}
         
         	if (selid == 2){
         		document.getElementById("emp_id").value = "";
         	}
         }
         
         function update_cancel(req_id)
         {
         	if (window.XMLHttpRequest)
         	{
         	  xmlhttp=new XMLHttpRequest();
         	}else{
         
         	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
         
         	}
         
         	xmlhttp.onreadystatechange=function()
         	{
         		if (xmlhttp.readyState==4 && xmlhttp.status==200)
         		{
         			alert(xmlhttp.responseText);
         		}
         	}
         
         	xmlhttp.open("GET","ap_report_cancel.php?req_form_id="+req_id,true);
         
         	xmlhttp.send();		
         
         }
         
         $(function() {
         
           // bind change event to select
         
           $('#owner_select').on('change', function() {
         
         	var url = $(this).val(); // get selected value
         
         	if (url) { // require a URL
         
         	  window.location = url; // redirect
         
         	}
         
         	return false;
         
           });
         
         });
         
      </script>
      <style type="text/css">
         .main_data_css{
         margin: 0 auto;
         width: 100%;
         height: auto;
         clear: both !important;
         padding-top: 35px;
         margin-left: 10px;
         margin-right: 10px;
         }
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
         height: 90%;
         padding: 16px;
         border: 1px solid gray;
         background-color: white;
         z-index:1002;
         overflow: auto;
         }
      </style>
   </head>
   <body>
      <?php include("inc/header.php"); ?>
      <div class="main_data_css">
         <div class="dashboard_heading" style="float: left;">
            <div style="float: left;">
               Call List Report - B2B Purchasing  
               <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
                  <span class="tooltiptext">This report shows the user all B2B purchasing accounts in the system which meet the conditions listed. These conditions are designed to generate a focused report of accounts which should have a higher probability to yield sales. This list is refreshed every night, and then divided up evenly and fairly amongst all sales reps on the list.</span>
               </div>
               <br>
            </div>
         </div>
         <SCRIPT LANGUAGE="JavaScript" SRC="inc/CalendarPopup.js"></SCRIPT><SCRIPT LANGUAGE="JavaScript" SRC="inc/general.js"></SCRIPT>
         <script LANGUAGE="JavaScript">document.write(getCalendarStyles());</script>
         <script LANGUAGE="JavaScript">
            var cal2xx = new CalendarPopup("listdiv");
            
            cal2xx.showNavigationDropdowns();
            
         </script>
         <?php
            db();
            
            $issup = "no";
            
            $sql = "SELECT is_supervisor FROM loop_employees where initials = '" . $_COOKIE['userinitials'] . "' and level = 2";
            
            $result = db_query($sql);
            
            while ($myrowsel = array_shift($result)) {
            
            	$issup = "yes";
            
            }
            
            db_b2b();
            
            $sql_time = "Select run_date from purchasing_team_queue_2 limit 1";
            
            $result_time = db_query($sql_time);
            
            $row = array_shift($result_time);
            
            ?>
         <h3>
            <i>Data last updated: <?php echo timeAgo($row["run_date"]);?> (updates every 24 hrs)</i>&nbsp;&nbsp; 
            <?php if ($issup == "yes") { ?> &nbsp;&nbsp; <a href="cron_job_purchasing_team_queue_2.php" target="_blank">Run Cron Job for Purchasing Team Queue</a><?php }?>
         </h3>
         </h3>
         <form method="post" name="frm_report_purchasing_team_list" action="report_purchasing_team_list.php">
            <table border="0">
               <tr>
                  <td>Employee:</td>
                  <td>
                     <select name="emp_id" id="emp_id" onchange="setseldropdown(1)">
                        <option value="">Please Select</option>
                        <?php
                           $qry = "SELECT employees.* FROM purchasing_team_queue_2 inner join employees on employees.loopID = purchasing_team_queue_2.assign_to_emp where assign_to_emp <> '' group by assign_to_emp";
                           db_b2b();
                           $qry_res = db_query($qry);
                           
                           while ($emp_row = array_shift($qry_res)) {
                           
                           ?>
                        <option <?php if ($emp_row["loopID"]==$_REQUEST["emp_id"]) echo " selected ";?> value="<?php echo $emp_row["loopID"];?>"><?php echo $emp_row["name"]; ?></option>
                        <?php 
                           }
                           
                           ?>
                     </select>
                  </td>
                  <td>
                     &nbsp;
                     <input type="submit" name="btntool" value="Search" />
                     <input type="hidden" name="hd_pgpost" id="hd_pgpost" value="yes"/>
                  </td>
                  <?php if ($issup == "yes") { ?>
                  <td>
                     Select Account Owner:
                     <select id="owned_rec" name="owned_rec" onchange="setseldropdown(2)">
                        <option value="">Please Select</option>
                        <?php
                           $owner_qry = "SELECT * FROM employees where status='Active' order by name asc";
						   
						   db_b2b();
                           $owner_row = db_query($owner_qry);
                           
                           while ($owner_res= array_shift($owner_row)) {
                           
                           	?>
                        <option <?php if ($owner_res["employeeID"]==$_REQUEST["owned_rec"]) echo " selected ";?> value="<?php echo $owner_res["employeeID"]?>"><?php echo $owner_res["name"]?></option>
                        <?php
                           }
                           
                           ?>
                     </select>
                  </td>
                  <td>
                     &nbsp;
                     <input type="submit" name="btntool_owner" id="btntool_owner" value="Search by Account Owner" />
                     <input type="hidden" name="hd_pgpost" id="hd_pgpost" value="yes"/>
                  </td>
                  <?php } ?>				
               </tr>
            </table>
         </form>
         <table width="900" border="0" cellspacing="1" cellpadding="1">
            <tr >
               <td bgcolor="#C0CDDA">
                  <font size="2">Employee Name</font>
               </td>
               <td bgcolor="#C0CDDA">
                  <font size="2">Condition 1</font>
               </td>
               <td bgcolor="#C0CDDA">
                  <font size="2">Total Companies assign</font>
               </td>
            </tr>
            <?php
               db_b2b();
               
               $tot_amount = 0; $tot_cnt1 = 0; $tot_cnt2 = 0; $tot_cnt3 = 0; $tot_cnt4 = 0; $tot_cnt = 0;
               
               $tot_cnt5 = 0; $tot_cnt6 = 0; $tot_cnt7 = 0; $tot_cnt8 = 0;
               
               $sql = "SELECT employees.name, assign_to_emp, count(*) as cnt FROM purchasing_team_queue_2 inner join employees on employees.loopID = purchasing_team_queue_2.assign_to_emp where assign_to_emp <> '' group by assign_to_emp order by name";
               
               $result = db_query($sql);
               
               while ($myrowsel = array_shift($result)) {
               
               	$cnt1 = 0;
               
               	$sql1 = "SELECT count(*) as cnt FROM purchasing_team_queue_2 where assign_to_emp = '" . $myrowsel["assign_to_emp"] . "' and report_criteria = 1";
				
				db_b2b();
               	$result1 = db_query($sql1);
               
               	while ($myrowsel1 = array_shift($result1)) {
               
               		$cnt1 = $myrowsel1["cnt"];
               
               	}
               
               	
               
               	$tot_cnt1 = $tot_cnt1 + $cnt1; 
               
               	
               
               	$tot_cnt = $tot_cnt + $myrowsel["cnt"]; 
               
               	?>
            <tr align="center">
               <td bgcolor="#E4E4E4" ><?php echo $myrowsel["name"];?></td>
               <td bgcolor="#E4E4E4" ><?php echo $cnt1;?></td>
               <td bgcolor="#E4E4E4" ><?php echo $myrowsel["cnt"];?></td>
            </tr>
            <?php
               }
               
               ?>
            <tr align="center">
               <td bgcolor="#E4E4E4" ><b>Total</b></td>
               <td bgcolor="#E4E4E4" ><b><?php echo $tot_cnt1;?></b></td>
               <td bgcolor="#E4E4E4" ><b><?php echo $tot_cnt;?></b></td>
            </tr>
         </table>
         <br><br>		
         <div>
            <u>Current call list report conditions</u> <br>
            1. Any purchasing accounts not contacted in > 6 months, and next step is > 15 days old.
            <br><br>
         </div>
         <?php 	
            if (isset($_REQUEST["hd_pgpost"])){ 
            
            	$emp_name = "";
            
            	if ($_REQUEST['emp_id'] != ""){
            
            		$sql = "SELECT * FROM employees where loopID = " . $_REQUEST['emp_id'];
					
					db_b2b();
            		$result = db_query($sql);
            
            		while ($myrowsel = array_shift($result)) {
            
            			$emp_name = $myrowsel["name"];
            
            		}
            
            		echo "Call List for <b>" . $emp_name . "</b>:<br><br>";
            
            	}	
            
            
            	if ($_REQUEST['owned_rec'] != ""){
            
            		$sql = "SELECT * FROM employees where employeeID = " . $_REQUEST['owned_rec'];
					db_b2b();
            		$result = db_query($sql);
            
            		while ($myrowsel = array_shift($result)) {
            
            			$emp_name = $myrowsel["name"];
            
            		}
            
            		echo "Call List for Account Owner = <b>" . $emp_name . "</b>:<br><br>";
            
            	}	
            
            ?>		
         <?php
            $sorturl="report_purchasing_team_list.php?emp_id=".$_REQUEST['emp_id']."&hd_pgpost=yes"; 
            
            $tot_rec = 0;
            
            if (!isset($_REQUEST["sort"])) {
            
            	$tot_amount = 0;
            
            	//where (payment_status is null or payment_status = 0)
            
            	if ($_REQUEST["hd_pgpost"] == "yes"){
            
            		if (isset($_REQUEST["btntool"])){
            
            			//$sql = "SELECT * FROM purchasing_team_queue_2 where assign_to_emp = " . $_REQUEST['emp_id'] . " and assign_to_emp_on between '" . date("Y-m-d" , strtotime($_REQUEST['date_from'])) . "' and '" . date("Y-m-d" , strtotime($_REQUEST['date_to'])) . " 23:59:59' order by unqid";
            
            			$sql = "SELECT * FROM purchasing_team_queue_2 where assign_to_emp = " . $_REQUEST['emp_id'] . " order by unqid";
            
            		}
            
            		
            
            		if (isset($_REQUEST["btntool_owner"])){
            
            			if((isset($_REQUEST["owned_rec"])) && ($_REQUEST["owned_rec"] != ""))
            
            			{
            
            				$sql = "SELECT * FROM purchasing_team_queue_2 inner join companyInfo on companyInfo.ID = purchasing_team_queue_2.company_id where companyInfo.assignedto = " . $_REQUEST['owned_rec'] . " order by unqid";
            
            			}
            
            		}	
            
            	}	
            
            	//echo $sql;
				db_b2b();
            	$result = db_query($sql);
            
            	$tot_rec = tep_db_num_rows($result);
            
            }		
            
            
            
            if ($tot_rec > 0 || (isset($_REQUEST["sort"])))
            
            { 
            
            	?>
         <div ><i>Note: Please wait until you see <font color="red">"END OF REPORT"</font> at the bottom of the report, before using the sort option.</i></div>
         <table width="1000" border="0" cellspacing="1" cellpadding="1">
            <tr >
               <td bgcolor="#C0CDDA">
                  <font size="2">Company Name</font>
                  <font size="1">&nbsp;<a href="<?php echo $sorturl; ?>&sort_order_pre=ASC&sort=company_name"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;<a href="<?php echo $sorturl; ?>&sort_order_pre=DESC&sort=company_name"><img src="images/sort_desc.png" width="6px;" height="12px;"></a>
                  </font>  
               </td>
               <td bgcolor="#C0CDDA">
                  <font size="2">Account status</font>
                  <font size="1">&nbsp;<a href="<?php echo $sorturl; ?>&sort_order_pre=ASC&sort=account_status"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;<a href="<?php echo $sorturl; ?>&sort_order_pre=DESC&sort=account_status"><img src="images/sort_desc.png" width="6px;" height="12px;"></a>
                  </font>  
               </td>
               <td bgcolor="#C0CDDA">
                  <font size="2">Industry</font>
                  <font size="1">&nbsp;<a href="<?php echo $sorturl; ?>&sort_order_pre=ASC&sort=industry"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;<a href="<?php echo $sorturl; ?>&sort_order_pre=DESC&sort=industry"><img src="images/sort_desc.png" width="6px;" height="12px;"></a>
                  </font>  
               </td>
               <td bgcolor="#C0CDDA">
                  <font size="2"># of Transactions</font>
                  <font size="1">&nbsp;<a href="<?php echo $sorturl; ?>&sort_order_pre=ASC&sort=no_of_trans"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;<a href="<?php echo $sorturl; ?>&sort_order_pre=DESC&sort=no_of_trans"><img src="images/sort_desc.png" width="6px;" height="12px;"></a>
                  </font>  
               </td>
               <td bgcolor="#C0CDDA">
                  <font size="2">Parent/Child</font>
                  <font size="1">&nbsp;<a href="<?php echo $sorturl; ?>&sort_order_pre=ASC&sort=parent_child"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;<a href="<?php echo $sorturl; ?>&sort_order_pre=DESC&sort=parent_child"><img src="images/sort_desc.png" width="6px;" height="12px;"></a>
                  </font>  
               </td>
               <td bgcolor="#C0CDDA">
                  <font size="2">Last Contacted on</font>
                  <font size="1">&nbsp;<a href="<?php echo $sorturl; ?>&sort_order_pre=ASC&sort=last_contact"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;<a href="<?php echo $sorturl; ?>&sort_order_pre=DESC&sort=last_contact"><img src="images/sort_desc.png" width="6px;" height="12px;"></a>
                  </font>  
               </td>
               <td bgcolor="#C0CDDA">
                  <font size="2">Added condition</font>
                  <font size="1">&nbsp;<a href="<?php echo $sorturl; ?>&sort_order_pre=ASC&sort=added_condition"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;<a href="<?php echo $sorturl; ?>&sort_order_pre=DESC&sort=added_condition"><img src="images/sort_desc.png" width="6px;" height="12px;"></a>
                  </font>  
               </td>
               <td bgcolor="#C0CDDA">
                  <font size="2">Owner</font>
                  <font size="1">&nbsp;<a href="<?php echo $sorturl; ?>&sort_order_pre=ASC&sort=owner"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;<a href="<?php echo $sorturl; ?>&sort_order_pre=DESC&sort=owner"><img src="images/sort_desc.png" width="6px;" height="12px;"></a>
                  </font>  
               </td>
            </tr>
            <?php
               }else{
               
				if ($tot_rec > 0)
               
               	{
               
               		echo "No entries in the database for " . $emp_name . "<br>";
               
               	}	
               
               }
               
               
               
               if (!isset($_REQUEST["sort"])) {
               
               	while ($myrowsel = array_shift($result)) {
               
               	
               
               		$dateCreated = ""; $dateCreated_sort = ""; $assignedto = ""; $last_contact_date = ""; $last_contact_date_sort = ""; $loopid = ""; $parent_child = ""; $parent_comp_id = "";
               
               		$industry_id = ""; $comp_status = "";
					
					db_b2b();
               		$result_child = db_query("Select dateCreated, status, assignedto, last_contact_date, loopid, parent_child, parent_comp_id, industry_id from 	 where ID = '".$myrowsel["company_id"]."'");
               
               		
               
               		$num_com_rows=tep_db_num_rows($result_child);
               
               		if($num_com_rows>0)
               
               		{
               
               			while ($myrowsel_child = array_shift($result_child)) {
               
               				$industry_id = $myrowsel_child["industry_id"];
               
               				$dateCreated = date("m/d/Y" , strtotime($myrowsel_child["dateCreated"]));
               
               				$dateCreated_sort = date("Y-m-d" , strtotime($myrowsel_child["dateCreated"]));
               
               				$assignedto = $myrowsel_child["assignedto"];
               
               				$loopid = $myrowsel_child["loopid"];
               
               				$parent_child = $myrowsel_child["parent_child"];
               
               				$parent_comp_id = $myrowsel_child["parent_comp_id"];
               
               				$comp_status = $myrowsel_child["status"];
               
               
               
               				if ($myrowsel_child["last_contact_date"] != "") {
               
               					$last_contact_date = date("m/d/Y" , strtotime($myrowsel_child["last_contact_date"]));
               
               					$last_contact_date_sort = date("Y-m-d" , strtotime($myrowsel_child["last_contact_date"]));
               
               				}	
               
               			}
               
               
               
               			$assigned_name = "";
						
						db_b2b();
               			$result_child = db_query("Select name, initials from employees where employeeID = '". $assignedto ."'");
               
               			while ($myrowsel_child = array_shift($result_child)) {
               
               				$assigned_name = $myrowsel_child["initials"];
               
               			}
               
               
               
               			$acc_status = "";
						db();
               			$result_child = db_query("Select name from status where id = '".$comp_status."'");
               
               			while ($myrowsel_child = array_shift($result_child)) {
               
               				$acc_status = $myrowsel_child["name"];
               
               			}
               
               
               
               			$industry_nm = "";
               
               			$sql_parentrec = "Select * from industry_master where active_flg = 1 and industry_id = '" . $industry_id . "' ";
						
						db_b2b();
               			$view_parentrec = db_query($sql_parentrec);
               
               			while ($rec_parentrec = array_shift($view_parentrec)) {
               
               				 $industry_nm = $rec_parentrec["industry"];
               
               			}
               
               			
               
               			$no_of_trans = "";
               
               			if ($loopid >0){
               
               				db();
               
               				$result_child = db_query("Select count(*) as cnt from loop_transaction where warehouse_id = " . $loopid);
               
               				while ($myrowsel_child = array_shift($result_child)) {
               
               					$no_of_trans = $myrowsel_child["cnt"];
               
               				}
               
               				db_b2b();
               
               			}	
               
               
               
               				$nickname = getnickname('', $myrowsel["company_id"]);
               
               			?>
            <tr >
               <td bgcolor="#E4E4E4" ><a href="viewCompany.php?ID=<?php echo $myrowsel["company_id"]; ?>" target="_blank"><font size="2"><?php echo $nickname;?></font></a></td>
               <td bgcolor="#E4E4E4" ><font size="2"><?php echo $acc_status; ?></font></td>
               <td bgcolor="#E4E4E4" ><font size="2"><?php echo $industry_nm; ?></font></td>
               <?php
                  $condition_name = "";
                  
                  
                  
                  if ($myrowsel["report_criteria"] == 1) { 
                  
                  	$condition_name = "Any purchasing accounts not contacted in > 6 months, and next step is > 15 days old.";
                  
                  } 
                  
                  ?>
               <td bgcolor="#E4E4E4" ><font size="2"><?php echo $no_of_trans;?></font></td>
               <?php 
                  $parent_child_str = "";
                  
                  if ($parent_child == "Child"){
                  
                  	$parent_child_str = "<a href='viewCompany.php?ID=" . $parent_comp_id . "' target='_blank'><font size='2'>" . getnickname('', $parent_comp_id) . "</font></a>";
                  
                  }
                  
                  
                  
                  if ($parent_child == "Parent"){
                  
                  	$parent_child_str = "Parent";
                  
                  }
                  
                  ?>
               <td bgcolor="#E4E4E4" ><font size="2"><?php echo $parent_child_str;?></font></td>
               <td bgcolor="#E4E4E4" ><font size="2"><?php echo $last_contact_date;?></font></td>
               <td bgcolor="#E4E4E4" ><font size="2"><?php echo $myrowsel["report_criteria"]. ". " . $condition_name;?></font></td>
               <td bgcolor="#E4E4E4" ><font size="2"><?php echo $assigned_name;?></font></td>
               </tr>
            <?php
               $MGArray[] = array('company_id' => $myrowsel["company_id"], 'nickname' => $nickname,'report_criteria' => $myrowsel["report_criteria"], 'no_of_trans' => $no_of_trans,
               
               'last_contact_date'=> $last_contact_date, 'last_contact_date_sort' => $last_contact_date_sort, 'industry_nm' => $industry_nm, 'acc_status' => $acc_status,
               
               'parent_child_str' => $parent_child_str, 'condition_name' => $condition_name, 'dateCreated_sort' => $dateCreated_sort, 'dateCreated' => $dateCreated,'assigned_name' => $assigned_name);
               
               }
               
               }
               
               
               
               $_SESSION['sortarrayn'] = $MGArray;
               
               ?>
            <div ><i><font color="red">"END OF REPORT"</font></i></div>
            <?php
               }else{
               
               
               
               	$sort_order_pre = "DESC";
               
               	if($_POST['sort_order_pre'] == "ASC")
               
               	{
               
               		$sort_order_pre = "DESC";
               
               	}else{
               
               		$sort_order_pre = "ASC";
               
               	}
               
               
               
               	$MGArray = $_SESSION['sortarrayn'];
               
               	
               
               	if($_REQUEST['sort'] == "industry" && $_REQUEST['sort_order_pre'] == "ASC")
               
               	{
               
               		$MGArraysort_I = array();
               
               		foreach ($MGArray as $MGArraytmp) {
               
               			$MGArraysort_I[] = $MGArraytmp['industry_nm'];
               
               		}
               
               		array_multisort($MGArraysort_I,SORT_ASC,SORT_STRING,$MGArray); 
               
               	}
               
               
               
               	if($_REQUEST['sort'] == "industry" && $_REQUEST['sort_order_pre'] == "DESC")
               
               	{
               
               		$MGArraysort_I = array();
               
               		foreach ($MGArray as $MGArraytmp) {
               
               			$MGArraysort_I[] = $MGArraytmp['industry_nm'];
               
               		}
               
               		array_multisort($MGArraysort_I,SORT_DESC,SORT_STRING,$MGArray); 
               
               	}
               
               
               
               	if($_REQUEST['sort'] == "account_status" && $_REQUEST['sort_order_pre'] == "ASC")
               
               	{
               
               		$MGArraysort_I = array();
               
               		foreach ($MGArray as $MGArraytmp) {
               
               			$MGArraysort_I[] = $MGArraytmp['acc_status'];
               
               		}
               
               		array_multisort($MGArraysort_I,SORT_ASC,SORT_STRING,$MGArray); 
               
               	}
               
               
               
               	if($_REQUEST['sort'] == "account_status" && $_REQUEST['sort_order_pre'] == "DESC")
               
               	{
               
               		$MGArraysort_I = array();
               
               		foreach ($MGArray as $MGArraytmp) {
               
               			$MGArraysort_I[] = $MGArraytmp['acc_status'];
               
               		}
               
               		array_multisort($MGArraysort_I,SORT_DESC,SORT_STRING,$MGArray); 
               
               	}
               
               						
               
               	if($_REQUEST['sort'] == "company_name" && $_REQUEST['sort_order_pre'] == "ASC")
               
               	{
               
               		$MGArraysort_I = array();
               
               		foreach ($MGArray as $MGArraytmp) {
               
               			$MGArraysort_I[] = $MGArraytmp['nickname'];
               
               		}
               
               		array_multisort($MGArraysort_I,SORT_ASC,SORT_STRING,$MGArray); 
               
               	}
               
               
               
               	if($_REQUEST['sort'] == "company_name" && $_REQUEST['sort_order_pre'] == "DESC")
               
               	{
               
               		$MGArraysort_I = array();
               
               		foreach ($MGArray as $MGArraytmp) {
               
               			$MGArraysort_I[] = $MGArraytmp['nickname'];
               
               		}
               
               		array_multisort($MGArraysort_I,SORT_DESC,SORT_STRING,$MGArray); 
               
               	}
               
               
               
               	if($_REQUEST['sort'] == "no_of_trans" && $_REQUEST['sort_order_pre'] == "ASC")
               
               	{
               
               		$MGArraysort_I = array();
               
               		foreach ($MGArray as $MGArraytmp) {
               
               			$MGArraysort_I[] = $MGArraytmp['no_of_trans'];
               
               		}
               
               		array_multisort($MGArraysort_I,SORT_ASC,SORT_NUMERIC,$MGArray); 
               
               	}
               
               
               
               	if($_REQUEST['sort'] == "no_of_trans" && $_REQUEST['sort_order_pre'] == "DESC")
               
               	{
               
               		$MGArraysort_I = array();
               
               		foreach ($MGArray as $MGArraytmp) {
               
               			$MGArraysort_I[] = $MGArraytmp['no_of_trans'];
               
               		}
               
               		array_multisort($MGArraysort_I,SORT_DESC,SORT_NUMERIC,$MGArray); 
               
               	}
               
               	
               
               	if($_REQUEST['sort'] == "parent_child" && $_REQUEST['sort_order_pre'] == "ASC")
               
               	{
               
               		$MGArraysort_I = array();
               
               		foreach ($MGArray as $MGArraytmp) {
               
               			$MGArraysort_I[] = $MGArraytmp['parent_child_str'];
               
               		}
               
               		array_multisort($MGArraysort_I,SORT_ASC,SORT_STRING,$MGArray); 
               
               	}
               
               
               
               	if($_REQUEST['sort'] == "parent_child" && $_REQUEST['sort_order_pre'] == "DESC")
               
               	{
               
               		$MGArraysort_I = array();
               
               		foreach ($MGArray as $MGArraytmp) {
               
               			$MGArraysort_I[] = $MGArraytmp['parent_child_str'];
               
               		}
               
               		array_multisort($MGArraysort_I,SORT_DESC,SORT_STRING,$MGArray); 
               
               	}
               
               	
               
               	if($_REQUEST['sort'] == "last_contact" && $_REQUEST['sort_order_pre'] == "ASC")
               
               	{
               
               		$MGArraysort_I = array();
               
               		foreach ($MGArray as $MGArraytmp) {
               
               			$MGArraysort_I[] = $MGArraytmp['last_contact_date_sort'];
               
               		}
               
               		array_multisort($MGArraysort_I,SORT_ASC,SORT_STRING,$MGArray); 
               
               	}
               
               
               
               	if($_REQUEST['sort'] == "last_contact" && $_REQUEST['sort_order_pre'] == "DESC")
               
               	{
               
               		$MGArraysort_I = array();
               
               		foreach ($MGArray as $MGArraytmp) {
               
               			$MGArraysort_I[] = $MGArraytmp['last_contact_date_sort'];
               
               		}
               
               		array_multisort($MGArraysort_I,SORT_DESC,SORT_STRING,$MGArray); 
               
               	}
               
               	
               
               	if($_REQUEST['sort'] == "added_condition" && $_REQUEST['sort_order_pre'] == "ASC")
               
               	{
               
               		$MGArraysort_I = array();
               
               		foreach ($MGArray as $MGArraytmp) {
               
               			$MGArraysort_I[] = $MGArraytmp['condition_name'];
               
               		}
               
               		array_multisort($MGArraysort_I,SORT_ASC,SORT_STRING,$MGArray); 
               
               	}
               
               
               
               	if($_REQUEST['sort'] == "added_condition" && $_REQUEST['sort_order_pre'] == "DESC")
               
               	{
               
               		$MGArraysort_I = array();
               
               		foreach ($MGArray as $MGArraytmp) {
               
               			$MGArraysort_I[] = $MGArraytmp['condition_name'];
               
               		}
               
               		array_multisort($MGArraysort_I,SORT_DESC,SORT_STRING,$MGArray); 
               
               	}
               
               	
               
               	if($_REQUEST['sort'] == "owner" && $_REQUEST['sort_order_pre'] == "ASC")
               
               	{
               
               		$MGArraysort_I = array();
               
               		foreach ($MGArray as $MGArraytmp) {
               
               			$MGArraysort_I[] = $MGArraytmp['assigned_name'];
               
               		}
               
               		array_multisort($MGArraysort_I,SORT_ASC,SORT_STRING,$MGArray); 
               
               	}
               
               
               
               	if($_REQUEST['sort'] == "owner" && $_REQUEST['sort_order_pre'] == "DESC")
               
               	{
               
               		$MGArraysort_I = array();
               
               		foreach ($MGArray as $MGArraytmp) {
               
               			$MGArraysort_I[] = $MGArraytmp['assigned_name'];
               
               		}
               
               		array_multisort($MGArraysort_I,SORT_DESC,SORT_STRING,$MGArray); 
               
               	}
               
               	
               
               	foreach ($MGArray as $MGArraytmp2) { ?>
            <tr >
               <td bgcolor="#E4E4E4" ><a href="viewCompany.php?ID=<?php echo $MGArraytmp2["company_id"]; ?>" target="_blank"><font size="2"><?php echo $MGArraytmp2["nickname"];?></font></a></td>
               <td bgcolor="#E4E4E4" ><font size="2"><?php echo $MGArraytmp2["acc_status"]?></font></td>
               <td bgcolor="#E4E4E4" ><font size="2"><?php echo $MGArraytmp2["industry_nm"]?></font></td>
               <td bgcolor="#E4E4E4" ><font size="2"><?php echo $MGArraytmp2["no_of_trans"]?></font></td>
               <td bgcolor="#E4E4E4" ><font size="2"><?php echo $MGArraytmp2["parent_child_str"]?></font></td>
               <td bgcolor="#E4E4E4" ><font size="2"><?php echo $MGArraytmp2["last_contact_date"]?></font></td>
               <td bgcolor="#E4E4E4" ><font size="2"><?php echo $MGArraytmp2["condition_name"]?></font></td>
               <td bgcolor="#E4E4E4" ><font size="2"><?php echo $MGArraytmp2["assigned_name"]?></font></td>
            </tr>
            <?php
				}
               }			
               
               ?>
         </table>
         <div ><i><font color="red">"END OF REPORT"</font></i></div>
         <?php }?>
      </div>
   </body>
</html>
