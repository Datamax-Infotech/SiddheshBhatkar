<?php
   require ("inc/header_session.php");
   require ("../mainfunctions/database.php");
   require ("../mainfunctions/general-functions.php");
   ?>
<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <title>SCORECARD: B2B Sales Team / Rep</title>
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
         .pop-table{
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
         select, input {
         font-family: Arial, Helvetica, sans-serif; 
         font-size: 12px; 
         color : #000000; 
         font-weight: normal; 
         }
         table.datatable {
         border-collapse: collapse;
         background: #FFF;
         width: 30%;
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
         border: 1px solid white;
         }
         table.datatable tr td,
         table.datatable tr th {
         height: 20px;
         border: 1px solid white;
         padding-left: 5px;
         }
         table.datatable tr:nth-child(even) td{
         background-color: #e4e4e4;
         }
         table.datatable tr:nth-child(odd) td{
         background-color: #F5F5F5;
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
         width: 70%;
         height: 85%;
         padding: 16px;
         border: 1px solid gray;
         background-color: white;
         z-index:1002;
         overflow: auto;
         }
      </style>
      <SCRIPT LANGUAGE="JavaScript" SRC="inc/CalendarPopup.js"></SCRIPT><SCRIPT LANGUAGE="JavaScript" SRC="inc/general.js"></SCRIPT>
      <script LANGUAGE="JavaScript">document.write(getCalendarStyles());</script>
      <script LANGUAGE="JavaScript">
         var cal2xx = new CalendarPopup("listdiv");
         
         cal2xx.showNavigationDropdowns();
         
         var cal3xx = new CalendarPopup("listdiv");
         
         cal3xx.showNavigationDropdowns();
         
      </script>
      <script>
         function load_div(id){
         
         	var element = document.getElementById(id); //replace elementId with your element's Id.
         
         	var rect = element.getBoundingClientRect();
         
         	var elementLeft,elementTop; //x and y
         
         	var scrollTop = document.documentElement.scrollTop?
         
         					document.documentElement.scrollTop:document.body.scrollTop;
         
         	var scrollLeft = document.documentElement.scrollLeft?                   
         
         					 document.documentElement.scrollLeft:document.body.scrollLeft;
         
         	elementTop = rect.top+scrollTop;
         
         	elementLeft = rect.left+scrollLeft;
         
         
         
         	document.getElementById("light").innerHTML = document.getElementById(id).innerHTML;
         
         	document.getElementById('light').style.display='block';
         
         
         
         	document.getElementById('light').style.left='100px';
         
         	document.getElementById('light').style.top=elementTop + 100 + 'px';
         
         }
         
         
         
         function close_div(){
         
         	document.getElementById('light').style.display='none';
         
         }
         
         		
         
      </script>
   </head>
   <body>
      
      <?php include("inc/header.php"); ?>
      <div class="main_data_css">
         <div id="light" class="white_content"></div>
         <div id="fade" class="black_overlay"></div>
         <div class="dashboard_heading" style="float: left;">
            <div style="float: left;">
               SCORECARD: B2B Sales Team / Rep    
               <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
                  <span class="tooltiptext">This scorecard shows the user the data for the B2B sales team or an individual rep.</span>
               </div>
            </div>
         </div>
         <!-- <h3>SCORECARD: Sales Function - Sales Dept.</h3> -->
         <?php
            $time = strtotime(Date('Y-m-d'));
            
            $st_friday = $time;
            
            $st_friday_last = date('m/d/Y', strtotime('-6 days', $st_friday));
            
            
            
            $st_thursday_last = Date('m/d/Y');
            
            //$st_friday_last = '01/01/2019';
            
            //Find default dates
            
            $previous_week = strtotime("-1 week +1 day");
            
            
            
            $start_week = strtotime("last sunday midnight",$previous_week);
            
            $end_week = strtotime("next saturday",$start_week);
            
            
            
            $start_week = date("Y-m-d",$start_week);
            
            $end_week = date("Y-m-d",$end_week);
            
            
            
            //echo $start_week.' '.$end_week ;
            
            //
            
            //
            
            $in_dt_range = "no";
            
            if( $_REQUEST["date_from"] !="" && $_REQUEST["date_to"] !=""){
            
            	$date_from_val = date("Y-m-d", strtotime($_REQUEST["date_from"]));
            
            	$date_to_val_org = date("Y-m-d", strtotime($_REQUEST["date_to"]));
            
            	$date_to_val = date("Y-m-d", strtotime('+1 day', strtotime($_REQUEST["date_to"])));
            
            	$in_dt_range = "yes";
            
            	//
            
            	$assignid=$_REQUEST["assignid"];
            
            	//
            
            }else{
            
            	$in_dt_range = "no";
            
            	$date_from_val = $start_week;
            
            	$date_to_val_org = $end_week;
            
            	$date_to_val = $end_week;
            
            	$assignid="all";
            
            }
            
            
            
            if($assignid=="all"){
            
            	$empqry="";
            
            }
            
            else{
            
            	$empqry=" and assignedto=".$assignid;
            
            }
            
            
            
            ?>
         <form method="post" name="sales_func" action="SCORECARD_sales_function_sales_dept.php">
            <input type="hidden" name="runfrm" value="runreport">
            <table border="0">
               <tr>
                  <td>Date Range Selector:</td>
                  <td>
                     From: 
                     <input type="text" name="date_from" id="date_from" size="10" value="<?php echo isset($_GET['date_from']) ? $_GET['date_from'] : date("m/d/Y", strtotime($date_from_val)); ?>" > 
                     <a href="#" onclick="cal2xx.select(document.sales_func.date_from,'dtanchor2xx','MM/dd/yyyy'); return false;" name="dtanchor2xx" id="dtanchor2xx"><img border="0" src="images/calendar.jpg"></a>
                     <div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>
                     To: 
                     <input type="text" name="date_to" id="date_to" size="10" value="<?php echo isset($_GET['date_to']) ? $_GET['date_to'] : date("m/d/Y", strtotime($date_to_val_org)); ?>" > 
                     <a href="#" onclick="cal3xx.select(document.sales_func.date_to,'dtanchor3xx','MM/dd/yyyy'); return false;" name="dtanchor3xx" id="dtanchor3xx"><img border="0" src="images/calendar.jpg"></a>
                  </td>
                  <td>
                     <select size="1" name="assignid">
                        <option selected value="all">All</option>
                        <?php
                           $arr = explode(",", $row["assignedto"]);
                           
                           $qassign = "SELECT * FROM employees WHERE status='Active' order by name";

						   db_b2b();
                           $dt_view_res_assign = db_query($qassign);
                           
                           while ($res_assign= array_shift($dt_view_res_assign)) {
                           
                           ?>
                        <option <?php if(isset($_REQUEST["assignid"]) && $_REQUEST["assignid"]==$res_assign["employeeID"]){ echo "selected"; } ?> value="<?php echo $res_assign["employeeID"]?>"><?php echo $res_assign["name"]?>
                           <?php
                              }
                              
                              ?>
                     </select>
                  </td>
                  <td>
                     <input type="submit" name="btntool" value="Submit" />
                     <input type="hidden" name="sale_pgpost" id="sale_pgpost" value=""/>
                  </td>
               </tr>
            </table>
         </form>
         <?php
            if(isset($_POST["runfrm"]) && ($_POST["runfrm"]=="runreport"))
            
            {
            
            //
            
            $lisoftrans = "<span style='width:800px;'><table cellSpacing='1' cellPadding='1' border='0' width='800' class='pop-table'>";
            
            $lisoftrans .= "<tr><td bgColor='#ABC5DF'>B2B ID</td><td bgColor='#ABC5DF'>Account Owner</td><td bgColor='#ABC5DF'>Company Nickname</td><td bgColor='#ABC5DF'>Next Step Date</td></tr>";
            
            db_b2b();
            
            $qry=db_query("Select companyInfo.status, companyInfo.haveNeed, companyInfo.shipState, companyInfo.ID as I, companyInfo.howHear, companyInfo.loopid, companyInfo.contact, companyInfo.dateCreated, companyInfo.company, companyInfo.nickname, companyInfo.next_step, companyInfo.last_contact_date, companyInfo.next_date, employees.initials, employees.name as E from companyInfo LEFT OUTER JOIN employees ON companyInfo.assignedto = employees.employeeID Where companyInfo.haveNeed = 'Need Boxes' and companyInfo.status not in (31) and companyInfo.active=1");
            
            $sales_rec= 0;
            
            while($myrow=array_shift($qry)){
            
            	$nickname = get_nickname_val($myrow["company"], $myrow["I"]);
            
            	$nextdate = "";
            
            	if ($myrow["next_date"] != ""){
            
            		$nextdate = date("m/d/Y", strtotime($myrow["next_date"]));
            
            	}			
            
            	$sales_rec = $sales_rec + 1;
            
            	$lisoftrans .= "<tr><td bgColor='#E4EAEB'>". $myrow["I"] . "</td>";
            
            	//Get rep
            
            	$lisoftrans .= "<td bgColor='#E4EAEB'>". $myrow["E"] . "</td>";
            
            	//
            
            	$lisoftrans .= "<td bgColor='#E4EAEB'><a target='_blank' href='viewCompany.php?ID=" . $myrow["I"] . "'>". $nickname . "</a></td>";
            
            	$lisoftrans .= "<td bgColor='#E4EAEB'>". $nextdate . "</td></tr>";
            
            }
            
            $lisoftrans .= "</table></span>";
        
            
            	$tot_lead = 0; $tot_lead_str = "";
            
            	$main_sql = "Select companyInfo.ID from companyInfo LEFT OUTER JOIN ";
            
            	$main_sql .= " employees ON companyInfo.assignedto = employees.employeeID where "; 
            
            	$main_sql .= " companyInfo.haveNeed = 'Need Boxes'" .$empqry . " and companyInfo.status not in (31) GROUP BY companyInfo.ID";
            
				db_b2b();
            	$data_res = db_query($main_sql);
            
            	while ($cnt_data = array_shift($data_res)) {
            
            		$tot_lead = $tot_lead + 1;
            
            		$tot_lead_str = $tot_lead_str . $cnt_data["ID"] . ",";
            
            	}
            
            	if ($tot_lead_str != ""){
            
            		$tot_lead_str = substr($tot_lead_str, 0 , strlen($tot_lead_str)-1);
            
            	}
            
            else{
            
            	$tot_lead_str=0;
            
            }
            
            
            
            	
            
            //
            
            ?>
         <table cellSpacing="1" cellPadding="1" border="0" class="datatable">
            <tr>
               <td style="width: 200" class="style17" align="center">
                  <b>Measurables</b>
               </td>
               <td style="width: 190" class="style17" align="center">
                  <b>Number</b>
               </td>
            </tr>
            <tr>
               <td style="width: 200"class="style3" align="left">
                  Total Sales Records in Loops (excl. TRASH)
               </td>
               <td style="width: 190"class="style3" align="center">
                  <a href='#' onclick='load_div(1); return false;'><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo number_format($sales_rec); ?></font></a>
                  <span id='1' style='display:none;'><a href='#' onclick='close_div(); return false;'>Close</a><?php echo $lisoftrans; ?></span>
               </td>
            </tr>
            <tr>
               <td style="width: 200"class="style3" align="left">
                  Total Past Due Sales Records in Loops Database (excl. TRASH)
               </td>
               <td style="width: 190; color: #F30004;"class="style3" align="center">
                  <?php
                     $lisoftrans = "<span style='width:800px;'><table cellSpacing='1' cellPadding='1' border='0' width='800' class='pop-table'>";
                     
                     $lisoftrans .= "<tr><td bgColor='#ABC5DF'>B2B ID</td><td bgColor='#ABC5DF'>Account Owner</td><td bgColor='#ABC5DF'>Company Nickname</td><td bgColor='#ABC5DF'>Next Step Date</td></tr>";
                     
                     
                     $past_qry="Select company, next_date, companyInfo.ID as I, companyInfo.next_step, employees.initials, employees.name as E from companyInfo LEFT OUTER JOIN employees ON companyInfo.assignedto = employees.employeeID  Where companyInfo.haveNeed = 'Need Boxes' and companyInfo.status not in (31) and companyInfo.active=1 and next_date < CURDATE() AND next_date > '1900-01-01'"; 
                     
					 db_b2b();
                     $qry_res_p=db_query($past_qry);
                     
                     $tot_past_due_sales = 0;
                     
                     while($myrow=array_shift($qry_res_p)){
                     
                     	$tot_past_due_sales = $tot_past_due_sales + 1;
                     
                     	$nickname = get_nickname_val($myrow["company"], $myrow["I"]);
                     
                     	$nextdate = "";
                     
                     	if ($myrow["next_date"] != ""){
                     
                     		$nextdate = date("m/d/Y", strtotime($myrow["next_date"]));
                     
                     	}			
                     
                     	
                     
                     	//
                     
                     	$lisoftrans .= "<tr><td bgColor='#E4EAEB'>". $myrow["I"] . "</td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'>". $myrow["E"] . "</td>";
                     
                     	//
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'><a target='_blank' href='viewCompany.php?ID=" . $myrow["I"] . "'>". $nickname . "</a></td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'>". $nextdate . "</td></tr>";
                     
                     }
                     
                     $lisoftrans .= "</table><br></span>";
                     
                     ?>
                  <a href='#' onclick='load_div(2); return false;'><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo number_format($tot_past_due_sales); ?></font></a>
                  <span id='2' style='display:none;'><a href='#' onclick='close_div(); return false;'>Close</a><?php echo $lisoftrans; ?></span>
               </td>
            </tr>
            <tr>
               <td style="width: 200"class="style3" align="left">
                  % of Records which are Past Due
               </td>
               <td style="width: 190"class="style3" align="center">
                  <?php
                     $percent_past_due=($tot_past_due_sales*100)/$sales_rec;
                     
                     echo number_format($percent_past_due,2)."%";
                     
                     ?>
               </td>
            </tr>
            <tr>
               <td style="width: 200"class="style3" align="left">
                  Total New Internal Leads
               </td>
               <td style="width: 190"class="style3" align="center">
                  <?php
                     $lisoftrans = "<span style='width:900px;'><table cellSpacing='1' cellPadding='1' border='0' width='900' class='pop-table'>";
                     
                     $lisoftrans .= "<tr><td bgColor='#ABC5DF'>Assgin To</td><td bgColor='#ABC5DF'>Age</td><td bgColor='#ABC5DF'>Company Name</td><td bgColor='#ABC5DF'>Status</td><td bgColor='#ABC5DF'>Lead Came From</td><td bgColor='#ABC5DF'>Next Step</td><td bgColor='#ABC5DF'>Last Communication</td><td bgColor='#ABC5DF'>Next Communication</td></tr>";
                     
                     $crm_db = "SELECT *, companyInfo.ID as I,companyInfo.status as st, employees.status as estatus FROM companyInfo LEFT OUTER JOIN employees ON companyInfo.assignedto = employees.employeeID where ID in (".$tot_lead_str.") and internal_external = 'internal' and (companyInfo.dateCreated >= '" . $date_from_val . "' and companyInfo.dateCreated <= '" . $date_to_val . "')";
                     
                     db_b2b();
                     $crm_result=db_query($crm_db);
                     
                     $lead_from_internal = 0;
                     
                     while($myrow=array_shift($crm_result)){
                     
                     	$lead_from_internal = $lead_from_internal + 1;
                     
                     	$nickname = get_nickname_val($myrow["company"], $myrow["I"]);
                     
                     	$nextdate = "";
                     
                     	if ($myrow["next_date"] != ""){
                     
                     		$nextdate = date("m/d/Y", strtotime($myrow["next_date"]));
                     
                     	}			
                     
                     	//
                     
                     	if($myrow["initials"] == "" || $myrow["estatus"] == "inactive" ){
                     
                     		$assign_str = "<font face='Arial, Helvetica, sans-serif' size='1' color='red'>Not Assign</font>";
                     
                     	}
                     
                     	else{
                     
                     		$assign_str =$myrow["initials"];
                     
                     	}
                     
                     	
                     
                     	//
                     
                     	$status_txt = "";
                     
                     	$scrm_db = "SELECT name FROM status where id = " . $myrow["st"];
						
						db_b2b();
                     	$scrm_result = db_query($scrm_db);
                     
                     	while ($crm_data = array_shift($scrm_result)) {
                     
                     		$status_txt = $crm_data["name"];
                     
                     	}
                     
                     	//
                     
                     	if ($myrow["last_contact_date"] == ""){
                     
                     		$contact_yes_no = "no";
                     
                     		$last_contact_str = "<font face='Arial, Helvetica, sans-serif' size='1' color='red'>Not contacted</font>";
                     
                     	}else{
                     
                     		$contact_yes_no = "yes";
                     
                     		$last_contact_str = "<font face='Arial, Helvetica, sans-serif' size='1' color='#333333'>" . date('m/d/Y',strtotime($myrow["last_contact_date"])) . "</font>";
                     
                     	}
                     
                     	//
                     
                     	if ($myrow["loopid"] > 0){
                     
                     		$next_step=$myrow["next_step"];
                     
                     	}
                     
                     	else{
                     
                     		$next_step="";
                     
                     	}
                     
                     
                     
                     	if($myrow["next_date"] != "")
                     
                     	{
                     
                     		$next_comm=date('m/d/Y',strtotime($myrow["next_date"]));
                     
                     	}
                     
                     	else{
                     
                     		$next_comm="";
                     
                     	}
                     
                     	//
                     
                     	$lisoftrans .= "<tr><td bgColor='#E4EAEB'>". $assign_str . "</td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'>". date_diff_new($myrow["dateCreated"], "NOW")." Days </td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'><a target='_blank' href='viewCompany.php?ID=" . $myrow["I"] . "'>". $nickname . "</a></td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'>". $status_txt . "</td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'>". $myrow["internal_external"] . "</td>";
                     
                     	
                     
                     	$lisoftrans .= "<td width='250px' bgColor='#E4EAEB'>". $next_step . "</td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'>". $last_contact_str . "</td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'>". $next_comm . "</td>";
                     
                     	
                     
                     	$lisoftrans .= "</tr>";
                     
                     }
                     
                     	//
                     
                     $lisoftrans .= "</table><br><br></span>";
                     
                     ?>
                  <a href='#' onclick='load_div(3); return false;'><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo number_format($lead_from_internal); ?></font></a>
                  <span id='3' style='display:none;'><a href='#' onclick='close_div(); return false;'>Close</a><?php echo $lisoftrans; ?></span>
               </td>
            </tr>
            <tr>
               <td style="width: 200"class="style3" align="left">
                  Total New External Leads
               </td>
               <td style="width: 190"class="style3" align="center">
                  <?php
                     $lisoftrans = "<span style='width:900px;'><table cellSpacing='1' cellPadding='1' border='0' width='900' class='pop-table'>";
                     
                     $lisoftrans .= "<tr><td bgColor='#ABC5DF'>Record Created Date</td><td bgColor='#ABC5DF'>B2B ID</td><td bgColor='#ABC5DF'>Account Owner</td><td bgColor='#ABC5DF'>Company Nickname</td><td bgColor='#ABC5DF'>Status</td><td bgColor='#ABC5DF'>Lead Came From</td><td bgColor='#ABC5DF'>Next Step</td><td bgColor='#ABC5DF'>Last Communication</td><td bgColor='#ABC5DF'>Next Step Date</td></tr>";
                     
                     $crm_db = "SELECT *, companyInfo.ID as I,companyInfo.status as st, employees.status as estatus FROM companyInfo LEFT OUTER JOIN employees ON companyInfo.assignedto = employees.employeeID where ID in (".$tot_lead_str.") and internal_external = 'external' and (companyInfo.dateCreated >= '" . $date_from_val . "' and companyInfo.dateCreated <= '" . $date_to_val . "')"; 
					 
					 db_b2b();
                     $crm_result=db_query($crm_db);
                     
                     $lead_from_external = 0;
                     
                     while($myrow=array_shift($crm_result)){
                     
                     	$lead_from_external = $lead_from_external + 1;
                     
                     	$nickname = get_nickname_val($myrow["company"], $myrow["I"]);
                     
                     	$nextdate = "";
                     
                     	if ($myrow["next_date"] != ""){
                     
                     		$nextdate = date("m/d/Y", strtotime($myrow["next_date"]));
                     
                     	}			
                     
                     	
                     
                     	if($myrow["initials"] == "" || $myrow["estatus"] == "inactive"){
                     
                     		$assign_str = "<font face='Arial, Helvetica, sans-serif' size='1' color='red'>Not Assign</font>";
                     
                     	}
                     
                     	else{
                     
                     		$assign_str =$myrow["initials"];
                     
                     	}
                     
                     	
                     
                     	//
                     
                     	$status_txt = "";
                     
                     	$scrm_db = "SELECT name FROM status where id = " . $myrow["st"];
						
						db_b2b();
                     	$scrm_result = db_query($scrm_db);
                     
                     	while ($crm_data = array_shift($scrm_result)) {
                     
                     		$status_txt = $crm_data["name"];
                     
                     	}
                     
                     	//
                     
                     	if ($myrow["last_contact_date"] == ""){
                     
                     		$contact_yes_no = "no";
                     
                     		$last_contact_str = "<font face='Arial, Helvetica, sans-serif' size='1' color='red'>Not contacted</font>";
                     
                     	}else{
                     
                     		$contact_yes_no = "yes";
                     
                     		$last_contact_str = "<font face='Arial, Helvetica, sans-serif' size='1' color='#333333'>" . date('m/d/Y',strtotime($myrow["last_contact_date"])) . "</font>";
                     
                     	}
                     
                     	//
                     
                     	if ($myrow["loopid"] > 0){
                     
                     		$next_step=$myrow["next_step"];
                     
                     	}
                     
                     	else{
                     
                     		$next_step="";
                     
                     	}
                     
                     	
                     
                     	if($myrow["next_date"] != "")
                     
                     	{
                     
                     		$next_comm=date('m/d/Y',strtotime($myrow["next_date"]));
                     
                     	}
                     
                     	else{
                     
                     		$next_comm="";
                     
                     	}
                     
                     	
                     
                     	//
                     
                     	$lisoftrans .= "<tr><td bgColor='#E4EAEB'>". date('m/d/Y',strtotime($myrow["dateCreated"])) . "</td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'>". $myrow["I"] . "</td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'>". $assign_str . "</td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'><a target='_blank' href='viewCompany.php?ID=" . $myrow["I"] . "'>". $nickname . "</a></td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'>". $status_txt . "</td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'>". $myrow["internal_external"] . "</td>";
                     
                     	
                     
                     	$lisoftrans .= "<td width='250px' bgColor='#E4EAEB'>". $next_step . "</td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'>". $last_contact_str . "</td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'>". $next_comm . "</td>";
                     
                     	
                     
                     	$lisoftrans .= "</tr>";
                     
                     }
                     
                     $lisoftrans .= "</table><br><br></span>";
                     
                     ?>
                  <a href='#' onclick='load_div(4); return false;'><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo number_format($lead_from_external); ?></font></a>
                  <span id='4' style='display:none;'><a href='#' onclick='close_div(); return false;'>Close</a><?php echo $lisoftrans; ?></span>
               </td>
            </tr>
            <tr>
               <td style="width: 200"class="style3" align="left">
                  # of External Leads NOT Assigned
               </td>
               <td style="width: 190"class="style3" align="center">
                  <?php
                     $lisoftrans = "<span style='width:900px;'><table cellSpacing='1' cellPadding='1' border='0' width='900' class='pop-table'>";
                     
                     $lisoftrans .= "<tr><td bgColor='#ABC5DF'>Assgin To</td><td bgColor='#ABC5DF'>Age</td><td bgColor='#ABC5DF'>Company Name</td><td bgColor='#ABC5DF'>Status</td><td bgColor='#ABC5DF'>Lead Came From</td><td bgColor='#ABC5DF'>Next Step</td><td bgColor='#ABC5DF'>Last Communication</td><td bgColor='#ABC5DF'>Next Communication</td></tr>";
                     
                     
                     
                     $tot_lead_unassign = 0; 
                     
                     $main_sql = "SELECT *, companyInfo.ID as I,companyInfo.status as st, employees.status as estatus from companyInfo LEFT OUTER JOIN ";
                     
                     $main_sql .= " employees ON companyInfo.assignedto = employees.employeeID where  (companyInfo.dateCreated >= '" . $date_from_val . "' and companyInfo.dateCreated <= '" . $date_to_val . "') and ";  
                     
                     $main_sql .= " companyInfo.assignedto = '' and internal_external = 'external' and companyInfo.status not in (31) and companyInfo.haveNeed = 'Need Boxes'" .$empqry . " GROUP BY companyInfo.ID";
					 
					 db_b2b();
                     $data_res = db_query($main_sql);
                     
                     while($myrow=array_shift($data_res)){
                     
                     	$tot_lead_unassign = $tot_lead_unassign + 1;
                     
                     	$nickname = get_nickname_val($myrow["company"], $myrow["I"]);
                     
                     
                     
                     	if($myrow["initials"] == "" || $myrow["estatus"] == "inactive"){
                     
                     		$assign_str = "<font face='Arial, Helvetica, sans-serif' size='1' color='red'>Not Assign</font>";
                     
                     	}
                     
                     	else{
                     
                     		$assign_str =$myrow["initials"];
                     
                     	}
                     
                     	
                     
                     	//
                     
                     	$status_txt = "";
                     
                     	$scrm_db = "SELECT name FROM status where id = " . $myrow["st"];
						
						db_b2b();
                     	$scrm_result = db_query($scrm_db);
                     
                     	while ($crm_data = array_shift($scrm_result)) {
                     
                     		$status_txt = $crm_data["name"];
                     
                     	}
                     
                     	//
                     
                     	if ($myrow["last_contact_date"] == ""){
                     
                     		$contact_yes_no = "no";
                     
                     		$last_contact_str = "<font face='Arial, Helvetica, sans-serif' size='1' color='red'>Not contacted</font>";
                     
                     	}else{
                     
                     		$contact_yes_no = "yes";
                     
                     		$last_contact_str = "<font face='Arial, Helvetica, sans-serif' size='1' color='#333333'>" . date('m/d/Y',strtotime($myrow["last_contact_date"])) . "</font>";
                     
                     	}
                     
                     	//
                     
                     	if ($myrow["loopid"] > 0){
                     
                     		$next_step=$myrow["next_step"];
                     
                     	}
                     
                     	else{
                     
                     		$next_step="";
                     
                     	}
                     
                     
                     
                     	if($myrow["next_date"] != "")
                     
                     	{
                     
                     		$next_comm=date('m/d/Y',strtotime($myrow["next_date"]));
                     
                     	}
                     
                     	else{
                     
                     		$next_comm="";
                     
                     	}
                     
                     	//
                     
                     	
                     
                     	$lisoftrans .= "<tr><td bgColor='#E4EAEB'>". $assign_str . "</td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'>". date_diff_new($myrow["dateCreated"], "NOW")." Days </td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'><a target='_blank' href='viewCompany.php?ID=" . $myrow["I"] . "'>". $nickname . "</a></td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'>". $status_txt . "</td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'>". $myrow["internal_external"] . "</td>";
                     
                     	
                     
                     	$lisoftrans .= "<td width='250px' bgColor='#E4EAEB'>". $next_step . "</td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'>". $last_contact_str . "</td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'>". $next_comm . "</td>";
                     
                     	
                     
                     	$lisoftrans .= "</tr>";
                     
                     }
                     
                     $lisoftrans .= "</table><br><br></span>";
                     
                     ?>
                  <a href='#' onclick='load_div(5); return false;'><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo number_format($tot_lead_unassign); ?></font></a>
                  <span id='5' style='display:none;'><a href='#' onclick='close_div(); return false;'>Close</a><?php echo $lisoftrans; ?></span>
               </td>
            </tr>
            <tr>
               <td style="width: 200"class="style3" align="left">
                  # of External Leads NOT Contacted
               </td>
               <td style="width: 190"class="style3" align="center">
                  <?php
                     $lisoftrans = "<span style='width:900px;'><table cellSpacing='1' cellPadding='1' border='0' width='900' class='pop-table'>";
                     
                     $lisoftrans .= "<tr><td bgColor='#ABC5DF'>Assgin To</td><td bgColor='#ABC5DF'>Age</td><td bgColor='#ABC5DF'>Company Name</td><td bgColor='#ABC5DF'>Status</td><td bgColor='#ABC5DF'>Lead Came From</td><td bgColor='#ABC5DF'>Next Step</td><td bgColor='#ABC5DF'>Last Communication</td><td bgColor='#ABC5DF'>Next Communication</td></tr>";
                     
                     
                     
                     $tot_lead_unassign_not_contact = 0; 
                     
                     $main_sql = "SELECT *, companyInfo.ID as I,companyInfo.status as st, employees.status as estatus from companyInfo LEFT OUTER JOIN ";
                     
                     $main_sql .= " employees ON companyInfo.assignedto = employees.employeeID where (companyInfo.dateCreated >= '" . $date_from_val . "' and companyInfo.dateCreated <= '" . $date_to_val . "') and "; 
                     
                     $main_sql .= " companyInfo.assignedto > 0 and internal_external = 'external' and companyInfo.status not in (43, 31) and last_contact_date is null and companyInfo.haveNeed = 'Need Boxes'" .$empqry . " GROUP BY companyInfo.ID";
                     
                     db_b2b();
                     
                     $data_res = db_query($main_sql);
                     
                     while($myrow=array_shift($data_res)){
                     
                     	$tot_lead_unassign_not_contact = $tot_lead_unassign_not_contact + 1;
                     
                     	
                     
                     	$nickname = get_nickname_val($myrow["company"], $myrow["I"]);
                     
                     	$nextdate = "";
                     
                     	if ($myrow["next_date"] != ""){
                     
                     		$nextdate = date("m/d/Y", strtotime($myrow["next_date"]));
                     
                     	}			
                     
                     	
                     
                     	if($myrow["initials"] == "" || $myrow["estatus"] == "inactive"){
                     
                     		$assign_str = "<font face='Arial, Helvetica, sans-serif' size='1' color='red'>Not Assign</font>";
                     
                     	}
                     
                     	else{
                     
                     		$assign_str =$myrow["initials"];
                     
                     	}
                     
                     	
                     
                     	//
                     
                     	$status_txt = "";
                     
                     	$scrm_db = "SELECT name FROM status where id = " . $myrow["st"];
						
						db_b2b();
                     	$scrm_result = db_query($scrm_db);
                     
                     	while ($crm_data = array_shift($scrm_result)) {
                     
                     		$status_txt = $crm_data["name"];
                     
                     	}
                     
                     	//
                     
                     	if ($myrow["last_contact_date"] == ""){
                     
                     		$contact_yes_no = "no";
                     
                     		$last_contact_str = "<font face='Arial, Helvetica, sans-serif' size='1' color='red'>Not contacted</font>";
                     
                     	}else{
                     
                     		$contact_yes_no = "yes";
                     
                     		$last_contact_str = "<font face='Arial, Helvetica, sans-serif' size='1' color='#333333'>" . date('m/d/Y',strtotime($myrow["last_contact_date"])) . "</font>";
                     
                     	}
                     
                     	//
                     
                     	if ($myrow["loopid"] > 0){
                     
                     		$next_step=$myrow["next_step"];
                     
                     	}
                     
                     	else{
                     
                     		$next_step="";
                     
                     	}
                     
                     	
                     
                     	if($myrow["next_date"] != "")
                     
                     	{
                     
                     		$next_comm=date('m/d/Y',strtotime($myrow["next_date"]));
                     
                     	}
                     
                     	else{
                     
                     		$next_comm="";
                     
                     	}
                     
                     	//
                     
                     	$lisoftrans .= "<tr><td bgColor='#E4EAEB'>". $assign_str . "</td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'>". date_diff_new($myrow["dateCreated"], "NOW")." Days </td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'><a target='_blank' href='viewCompany.php?ID=" . $myrow["I"] . "'>". $nickname . "</a></td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'>". $status_txt . "</td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'>". $myrow["internal_external"] . "</td>";
                     
                     	
                     
                     	$lisoftrans .= "<td width='250px' bgColor='#E4EAEB'>". $next_step . "</td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'>". $last_contact_str . "</td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'>". $next_comm . "</td>";
                     
                     	
                     
                     	$lisoftrans .= "</tr>";
                     
                     }
                     
                     $lisoftrans .= "</table><br><br></span>";
                     
                     ?>
                  <a href='#' onclick='load_div(6); return false;'><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo number_format($tot_lead_unassign_not_contact); ?></font></a>
                  <span id='6' style='display:none;'><a href='#' onclick='close_div(); return false;'>Close</a><?php echo $lisoftrans; ?></span>
               </td>
            </tr>
            <tr>
               <td style="width: 200"class="style3" align="left">
                  # of External Leads NOT Qualified
               </td>
               <td style="width: 190"class="style3" align="center">
                  <?php
                     $lisoftrans = "<span style='width:900px;'><table cellSpacing='1' cellPadding='1' border='0' width='900' class='pop-table'>";
                     
                     $lisoftrans .= "<tr><td bgColor='#ABC5DF'>Assgin To</td><td bgColor='#ABC5DF'>Age</td><td bgColor='#ABC5DF'>Company Name</td><td bgColor='#ABC5DF'>Status</td><td bgColor='#ABC5DF'>Lead Came From</td><td bgColor='#ABC5DF'>Next Step</td><td bgColor='#ABC5DF'>Last Communication</td><td bgColor='#ABC5DF'>Next Communication</td></tr>";
                     
                     
                     
                     $tot_lead_assign_contact_tbd = 0; 
                     
                     $main_sql = "SELECT *, companyInfo.ID as I,companyInfo.status as st, employees.status as estatus from companyInfo LEFT OUTER JOIN ";
                     
                     $main_sql .= " employees ON companyInfo.assignedto = employees.employeeID where (companyInfo.dateCreated >= '" . $date_from_val . "' and companyInfo.dateCreated <= '" . $date_to_val . "') and "; 
                     
                     $main_sql .= " companyInfo.assignedto > 0 and internal_external = 'external' and companyInfo.status = 6 and last_contact_date <> '' and companyInfo.haveNeed = 'Need Boxes'" .$empqry . " GROUP BY companyInfo.ID";
                     
                     db_b2b();
                     
                     $data_res = db_query($main_sql);
                     
                     while($myrow=array_shift($data_res)){
                     
                     	$tot_lead_assign_contact_tbd = $tot_lead_assign_contact_tbd + 1;
                     
                     	
                     
                     	$nickname = get_nickname_val($myrow["company"], $myrow["I"]);
                     
                     	$nextdate = "";
                     
                     	if ($myrow["next_date"] != ""){
                     
                     		$nextdate = date("m/d/Y", strtotime($myrow["next_date"]));
                     
                     	}			
                     
                     	
                     
                     	if($myrow["initials"] == "" || $myrow["estatus"] == "inactive"){
                     
                     		$assign_str = "<font face='Arial, Helvetica, sans-serif' size='1' color='red'>Not Assign</font>";
                     
                     	}
                     
                     	else{
                     
                     		$assign_str =$myrow["initials"];
                     
                     	}
                     
                     
                     	$status_txt = "";
                     
                     	$scrm_db = "SELECT name FROM status where id = " . $myrow["st"];
						
						db_b2b();
                     	$scrm_result = db_query($scrm_db);
                     
                     	while ($crm_data = array_shift($scrm_result)) {
                     
                     		$status_txt = $crm_data["name"];
                     
                     	}
                     
                     	//
                     
                     	if ($myrow["last_contact_date"] == ""){
                     
                     		$contact_yes_no = "no";
                     
                     		$last_contact_str = "<font face='Arial, Helvetica, sans-serif' size='1' color='red'>Not contacted</font>";
                     
                     	}else{
                     
                     		$contact_yes_no = "yes";
                     
                     		$last_contact_str = "<font face='Arial, Helvetica, sans-serif' size='1' color='#333333'>" . date('m/d/Y',strtotime($myrow["last_contact_date"])) . "</font>";
                     
                     	}
                     
                     	//
                     
                     	if ($myrow["loopid"] > 0){
                     
                     		$next_step=$myrow["next_step"];
                     
                     	}
                     
                     	else{
                     
                     		$next_step="";
                     
                     	}
                     
                     	
                     
                     	if($myrow["next_date"] != "")
                     
                     	{
                     
                     		$next_comm=date('m/d/Y',strtotime($myrow["next_date"]));
                     
                     	}
                     
                     	else{
                     
                     		$next_comm="";
                     
                     	}
                     
                     	//
                     
                     	$lisoftrans .= "<tr><td bgColor='#E4EAEB'>". $assign_str . "</td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'>". date_diff_new($myrow["dateCreated"], "NOW")." Days </td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'><a target='_blank' href='viewCompany.php?ID=" . $myrow["I"] . "'>". $nickname . "</a></td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'>". $status_txt . "</td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'>". $myrow["internal_external"] . "</td>";
                     
                     	
                     
                     	$lisoftrans .= "<td width='250px' bgColor='#E4EAEB'>". $next_step . "</td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'>". $last_contact_str . "</td>";
                     
                     	$lisoftrans .= "<td bgColor='#E4EAEB'>". $next_comm . "</td>";
                     
                     	
                     
                     	$lisoftrans .= "</tr>";
                     
                     }
                     
                     $lisoftrans .= "</table><br><br></span>";
                     
                     ?>
                  <a href='#' onclick='load_div(7); return false;'><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo number_format($tot_lead_assign_contact_tbd); ?></font></a>
                  <span id='7' style='display:none;'><a href='#' onclick='close_div(); return false;'>Close</a><?php echo $lisoftrans; ?></span>
               </td>
            </tr>
            <tr>
               <td style="width: 200"class="style3" align="left">
                  # of Phone Calls
               </td>
               <td style="width: 190"class="style3" align="center">
                  <?php
                     $lisoftrans = "<span style='width:800px;'><table cellSpacing='1' cellPadding='1' border='0' width='800' class='pop-table'>";
                     
                     $lisoftrans .= "<tr><td bgColor='#ABC5DF'>Sr. No.</td><td bgColor='#ABC5DF'>Company Nickname</td><td bgColor='#ABC5DF'>CRM Type</td><td bgColor='#ABC5DF'>CRM Message</td><td bgColor='#ABC5DF'>Employee</td><td bgColor='#ABC5DF'>View File</td><td bgColor='#ABC5DF'>CRM Date</td></tr>";
                     
                     
                     
                     $crm_ph_call = 0; $srno=0;
                     
                     $main_sql = "SELECT *,companyID as I FROM CRM where companyID in (".$tot_lead_str.") and type='phone' and (timestamp >='".$date_from_val ."' and timestamp <'".$date_to_val ."')";
                     
                     db_b2b();
                     
                     $data_res = db_query($main_sql);
                     
                     while($myrow=array_shift($data_res)){
                     
                     	$crm_ph_call = $crm_ph_call + 1;
                     
                     	
                     
                     	$nickname = get_nickname_val($myrow["company"], $myrow["I"]);
                     
                     	$nextdate = "";
                     
                     	if ($myrow["next_date"] != ""){
                     
                     		$nextdate = date("m/d/Y", strtotime($myrow["next_date"]));
                     
                     	}			
                     
                     	$srno=$srno+1;
                     
                     	//
                     
                     	if($myrow["file_name"]!="")
                     
                     	{
                     
                     		$crm_file_name="<a style='color:#0000FF;' target='_blank' href='crm_files=".$myrow["file_name"]."'>View File</a>";
                     
                     	}
                     
                     	else{
                     
                     		$crm_file_name="";
                     
                     	}
                     
                     
                     
                     	//
                     
                     	$lisoftrans .= "<tr><td bgColor='#E4EAEB'>". $srno  . "</td><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany.php?ID=" . $myrow["I"] . "'>". $nickname . "</a></td><td bgColor='#E4EAEB'>". $myrow["type"]  . "</td><td bgColor='#E4EAEB'>". $myrow["message"]  . "</td><td bgColor='#E4EAEB'>". $myrow["employee"]  . "</td><td bgColor='#E4EAEB'>". $crm_file_name  . "</td><td bgColor='#E4EAEB'>". $myrow["messageDate"]  . "</td></tr>";
                     
                     }
                     
                     $lisoftrans .= "</table><br><br></span>";
                     
                     ?>
                  <a href='#' onclick='load_div(8); return false;'><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo number_format($crm_ph_call); ?></font></a>
                  <span id='8' style='display:none;'><a href='#' onclick='close_div(); return false;'>Close</a><?php echo $lisoftrans; ?></span>
               </td>
            </tr>
            <tr>
               <td style="width: 200"class="style3" align="left">
                  # of Emails
               </td>
               <td style="width: 190"class="style3" align="center">
                  <?php
                     $lisoftrans = "<span style='width:800px;'><table cellSpacing='1' cellPadding='1' border='0' width='800' class='pop-table'>";
                     
                     $lisoftrans .= "<tr><td bgColor='#ABC5DF'>Sr. No.</td><td bgColor='#ABC5DF'>Company Nickname</td><td bgColor='#ABC5DF'>CRM Type</td><td bgColor='#ABC5DF'>CRM Message</td><td bgColor='#ABC5DF'>Employee</td><td bgColor='#ABC5DF'>View File</td><td bgColor='#ABC5DF'>CRM Date</td></tr>";
                     
                     
                     
                     $crm_email_call = 0;$srno =0;
                     
                     $main_sql = "SELECT *,companyID as I FROM CRM where companyID in (".$tot_lead_str.") and type='email' and (timestamp >='".$date_from_val ."' and timestamp <'".$date_to_val ."')";
                     
                     db_b2b();
                     
                     $data_res = db_query($main_sql);
                     
                     while($myrow=array_shift($data_res)){
                     
                     	$crm_email_call = $crm_email_call + 1;
                     
                     	
                     
                     	$nickname = get_nickname_val('', $myrow["I"]);
                     
                     	
                     
                     	$nextdate = "";
                     
                     	if ($myrow["next_date"] != ""){
                     
                     		$nextdate = date("m/d/Y", strtotime($myrow["next_date"]));
                     
                     	}			
                     
                     	$srno=$srno+1;
                     
                     	//
                     
                     	if($myrow["file_name"]!="")
                     
                     	{
                     
                     		$crm_file_name="<a style='color:#0000FF;' target='_blank' href='crm_files=".$myrow["file_name"]."'>View File</a>";
                     
                     	}
                     
                     	else{
                     
                     		$crm_file_name="";
                     
                     	}
                     
                     	//Get email
                     
                     	$final_msg = ""; $final_msg_top = ""; $attachment_str = ""; $email_body_toppart = "";
                     
                     	$attstr = "" ; $emailtxt="";
                     
                     	$lisoftrans .= "<tr><td bgColor='#E4EAEB'>". $srno  . "</td><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany.php?ID=" . $myrow["I"] . "'>". $nickname . "</a></td><td bgColor='#E4EAEB'>". $myrow["type"]  . "</td><td bgColor='#E4EAEB'>". $emailtxt . "</td><td bgColor='#E4EAEB'>". $myrow["employee"]  . "</td><td bgColor='#E4EAEB'>". $crm_file_name . "</td><td bgColor='#E4EAEB'>". $myrow["messageDate"]  . "</td></tr>";
                     
                     }
                     
                     $lisoftrans .= "</table><br><br></span>";
                     
                     ?>
                  <a href='#' onclick='load_div(9); return false;'><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo number_format($crm_email_call); ?></font></a>
                  <span id='9' style='display:none;'><a href='#' onclick='close_div(); return false;'>Close</a><?php echo $lisoftrans; ?></span>
               </td>
            </tr>
            <tr>
               <td style="width: 200"class="style3" align="left">
                  # of Quotes Sent
               </td>
               <td style="width: 190"class="style3" align="center">
                  <?php
                     $lisoftrans = "<span style='width:800px;'><table cellSpacing='1' cellPadding='1' border='0' width='800' class='pop-table'>";
                     
                     $lisoftrans .= "<tr><td bgColor='#ABC5DF'>Date</td><td bgColor='#ABC5DF'>Company Nickname</td><td bgColor='#ABC5DF'>Account Owner</td><td bgColor='#ABC5DF'>Type</td><td bgColor='#ABC5DF'>Amount</td><td bgColor='#ABC5DF'>Status</td></tr>";
                     
                     
                     
                     $quote_sent = 0; 
                     
                     if($assignid=="all")
                     
                     {
                     
                     	$data_res2 = "SELECT quote.ID as QI, quoteDate, qstatus, quote.rep AS R, employees.name AS E, filename, quoteType, quote_total, companyID as I FROM quote LEFT OUTER JOIN employees ON quote.rep = employees.employeeID WHERE qstatus !=2 AND (quoteDate BETWEEN '" . $date_from_val. "' AND '".$date_to_val."') order by quoteDate Desc";
                     
						db_b2b();
                     
                     	$result = db_query($data_res);
                     
                     }
                     
                     else
                     
                     {
                     
                     	$data_res2 = "SELECT quote.ID as QI, quoteDate, qstatus, quote.rep AS R, employees.name AS E, filename, quoteType, quote_total, companyID as I FROM quote LEFT OUTER JOIN employees ON quote.rep = employees.employeeID WHERE rep LIKE '" . $assignid . "' AND  qstatus !=2 AND quoteDate BETWEEN '" . $date_from_val. "' AND '".$date_to_val."'  order by quoteDate Desc";
						
						db_b2b();
                     	$result = db_query($data_res2);
                     
                     }
                     
                     //echo $main_sql;
                     
                     while($myrow=array_shift($result)){
                     
                     	$quote_sent = $quote_sent + 1;
                     
                     	
                     
                     	$nickname = get_nickname_val('', $myrow["I"]);
                     
                     	$nextdate = "";
                     
                     	if ($myrow["next_date"] != ""){
                     
                     		$nextdate = date("m/d/Y", strtotime($myrow["next_date"]));
                     
                     	}			
                     
                     	//Quote type
                     
                     	$quotety="";
                     
                     	if ($myrow["filename"] != "") { 
                     
                     	
                     
                     		$archeive_date = new DateTime(date("Y-m-d", strtotime($quotes_archive_date)));
                     
                     		$quote_date = new DateTime(date("Y-m-d", strtotime($myrow["quoteDate"])));
                     
                     		
                     
                     		if ($quote_date < $archeive_date){
                     
                     			$quotety = "<a href='https://usedcardboardboxes.sharepoint.com/:b:/r/sites/LoopsCRMEmailAttachments/Shared%20Documents/quotes/before_oct_18_2022/" . $myrow["filename"] . "'>";
                     
                     		}else{
                     
                     			$quotety = "<a href='http://loops.usedcardboardboxes.com/quotes/".$myrow["filename"]."'>";
                     
                     		}
                     
                     	
                     
                     	} elseif ($myrow["quoteType"] == "Quote") {
                     
                     		$quotety="<a href='http://loops.usedcardboardboxes.com/fullquote.php?ID=".$myrow["QI"]."'>";
                     
                     	?>
                  <?php } elseif ($myrow["quoteType"] == "Quote Select") {
                     $quotety="<a href='http://b2b.usedcardboardboxes.com/b2b5/quoteselect.asp?ID=".$myrow["QI"]."'>";
                     
                     } 
                     
                     $quotety.=$myrow["quoteType"]."</a>";
                     
                     $quote_date = date('m/d/Y', strtotime($myrow["quoteDate"]));
                     
                     //
                     
                     $boxSql = "Select * from quote_status Where status=1 and qid=".$myrow["qstatus"];
                     
					 db_b2b();
                     $dt_view_res4 = db_query($boxSql);
                     
                     $status_res = array_shift($dt_view_res4);
                     
                     //
                     
                     $lisoftrans .= "<tr><td bgColor='#E4EAEB'>". $quote_date . "</td><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany.php?ID=" . $myrow["I"] . "'>". $nickname . "</a></td><td bgColor='#E4EAEB'>". $myrow["E"] . "</td><td bgColor='#E4EAEB'>". $quotety . "</td><td bgColor='#E4EAEB'>". number_format($myrow["quote_total"],2) . "</td><td bgColor='#E4EAEB'>". $status_res["status_name"] . "</td></tr>";
                     
                     }
                     
                     $lisoftrans .= "</table><br><br></span>";
                     
                     ?>
                  <a href='#' onclick='load_div(10); return false;'><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo number_format($quote_sent); ?></font></a>
                  <span id='10' style='display:none;'><a href='#' onclick='close_div(); return false;'>Close</a><?php echo $lisoftrans; ?></span>
               </td>
            </tr>
            <tr>
               <td style="width: 200"class="style3" align="left">
                  # of Closed Deals
               </td>
               <td style="width: 190"class="style3" align="center">
                  <?php
                     $lisoftrans = "<span style='width:800px;'><table cellSpacing='1' cellPadding='1' border='0' width='800' class='pop-table'>";
                     
                     $lisoftrans .= "<tr><td bgColor='#ABC5DF'>Companh Name</td><td bgColor='#ABC5DF'>Empolyee</td><td bgColor='#ABC5DF'>PO Amount</td></tr>";
                     
                     
                     
                     $closed_deal = 0; 
                     
                     if($assignid=="all")
                     
                     {
                     
                     	$sql = "SELECT *, loop_warehouse.b2bid, loop_warehouse.warehouse_name, loop_transaction_buyer.id AS I FROM loop_transaction_buyer INNER JOIN loop_warehouse ON loop_warehouse.id = loop_transaction_buyer.warehouse_id WHERE loop_transaction_buyer.ignore < 1 and Leaderboard = 'B2B' and (transaction_date >= DATE_FORMAT('$date_from_val' , '%Y-%m-%d') and transaction_date <= DATE_FORMAT('$date_to_val' , '%Y-%m-%d'))"; 
                     
                     }
                     
                     else{
                     
                     	$sql = "SELECT * FROM loop_employees WHERE status ='Active' and id=".$assignid;
						
						db();
                     	$result = db_query($sql);
                     
                     	while ($rowemp = array_shift($result)) {
                     
                     		$initials = $rowemp["initials"];
                     
                     		$sql = "SELECT *, loop_warehouse.b2bid, loop_warehouse.warehouse_name, loop_transaction_buyer.id AS I FROM loop_transaction_buyer INNER JOIN loop_warehouse ON loop_warehouse.id = loop_transaction_buyer.warehouse_id WHERE loop_transaction_buyer.ignore < 1 and Leaderboard = 'B2B' and po_employee = '$initials' and (transaction_date >= DATE_FORMAT('$date_from_val' , '%Y-%m-%d') and transaction_date <= DATE_FORMAT('$date_to_val' , '%Y-%m-%d'))"; 
                     
                     	}
                     
                     }
                     
                     db();
                     
                     $result = db_query($sql);
                     
                     while($myrow=array_shift($result)){
                     
                     	$closed_deal = $closed_deal + 1;
                     
                     	
                     
                     	$nickname = get_nickname_val($myrow["warehouse_name"], $myrow["b2bid"]);
                     
                     	$nextdate = "";
                     
                     	if ($myrow["next_date"] != ""){
                     
                     		$nextdate = date("m/d/Y", strtotime($myrow["next_date"]));
                     
                     	}			
                     
                     	
                     
                     	//$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany.php?ID=" . $myrow["b2bid"] . "&show=transactions&warehouse_id=" . $myrow["warehouse_id"] . "&rec_type=Supplier&proc=View&searchcrit=&id=". $myrow["warehouse_id"] ."&rec_id=" . $myrow["I"] . "&display=buyer_payment'>". $nickname . "</td></tr>";
                     
                     	if($myrow["po_poorderamount"]>0)
                     
                                     {
                     
                     		$lisoftrans .= "<tr><td bgColor='#E4EAEB' align='left' width='240px'><a target='_blank'	href='search_results.php?warehouse_id=" . $myrow["warehouse_id"] . "&rec_type=Supplier&proc=View&searchcrit=&id=" . $myrow["warehouse_id"] . "&rec_id=" . $myrow["I"] . "&display=buyer_view'>" . $nickname . "</a></td><td width='20px' align='left'  bgColor='#E4EAEB'>" . $myrow["po_employee"] . "</td><td width='40px' align='right' bgColor='#E4EAEB'>$" . number_format($myrow["po_poorderamount"],2) . "</td></tr>";
                     
                                     }
                     
                     }
                     
                     $lisoftrans .= "</table></span>";
                     
                     ?>
                  <a href='#' onclick='load_div(11); return false;'><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo number_format($closed_deal); ?></font></a>
                  <span id='11' style='display:none;'><a href='#' onclick='close_div(); return false;'>Close</a><?php echo $lisoftrans; ?></span>
               </td>
            </tr>
            <tr>
               <td style="width: 200"class="style3" align="left">
                  # of Closed Deals Which Were 1st Time Customers
               </td>
               <td style="width: 190"class="style3" align="center">
                  <?php
                     $first_rec_cnt_s = 0;
                     
                     $lisoftrans = "<span style='width:800px;'><table cellSpacing='1' cellPadding='1' border='0' width='800' class='pop-table'>";
                     
                     $lisoftrans .= "<tr><td bgColor='#ABC5DF'>Loop ID</td><td bgColor='#ABC5DF'>Company Nickname</td><td bgColor='#ABC5DF'>PO Amount</td></tr>";
                     
                     
                     
                     if($assignid=="all")
                     
                     {
                     
                     	$dt_view_qry = "SELECT distinct loop_transaction_buyer.id, loop_transaction_buyer.warehouse_id, loop_warehouse.b2bid, loop_warehouse.warehouse_name, po_poorderamount AS SUMPO FROM loop_transaction_buyer INNER JOIN loop_warehouse ON loop_transaction_buyer.warehouse_id = loop_warehouse.id where `ignore` = 0 and no_invoice = 0 and (transaction_date >= DATE_FORMAT('$date_from_val' , '%Y-%m-%d') and transaction_date <= DATE_FORMAT('$date_to_val' , '%Y-%m-%d'))";
                     
						db();
                     
                     	$dt_view_res = db_query($dt_view_qry);
                     
                     	while ($dt_view_row = array_shift($dt_view_res)) {
                     
                     
                     
                     		$fdq = "SELECT id AS I FROM loop_transaction_buyer WHERE warehouse_id = " . $dt_view_row["warehouse_id"] . " and `ignore` = 0 and no_invoice = 0 ORDER BY I ASC LIMIT 0,1";
							
							db();
                     		$fd_res = db_query($fdq);
                     
                     		$first_deal_s = 0; $first_deal_id = 0;
                     
                     		while ($fd_row = array_shift($fd_res)) {
                     
                     			if ($fd_row["I"] == $dt_view_row["id"]){
                     
                     				$first_deal_s = 1;
                     
                     				$first_deal_id = $dt_view_row["id"];
                     
                     				break;
                     
                     			}
                     
                     		} 
                     
                     		if ($first_deal_s == 1)
                     
                     		{
                     
                     			$first_rec_cnt_s = $first_rec_cnt_s + 1;
                     
                     
                     
                     			$nickname = get_nickname_val($dt_view_row["warehouse_name"], $dt_view_row["b2bid"]);
                     
                     			
                     
                     			$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany.php?ID=" . $dt_view_row["b2bid"] . "&show=transactions&warehouse_id=" . $dt_view_row["warehouse_id"] . "&rec_type=Supplier&proc=View&searchcrit=&id=". $dt_view_row["warehouse_id"] ."&rec_id=" . $first_deal_id . "&display=buyer_payment'>". $dt_view_row["id"] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td><td bgColor='#E4EAEB' align='right'>$" . number_format($dt_view_row["SUMPO"],0) . "</td></tr>";
                     
                     		}
                     
                     	}	
                     
                     }
                     
                     else{
                     
                     	$sql = "SELECT * FROM loop_employees WHERE quota > 0 and id=".$assignid." ORDER BY quota DESC";
						
						db();
                     	$result = db_query($sql);
                     
                     	while ($rowemp = array_shift($result)) {
                     
                     		$initials = $rowemp["initials"];
                     
                     		$dt_view_qry = "SELECT distinct loop_transaction_buyer.id, loop_transaction_buyer.warehouse_id, loop_warehouse.b2bid, loop_warehouse.warehouse_name, po_poorderamount AS SUMPO FROM loop_transaction_buyer INNER JOIN loop_warehouse ON loop_transaction_buyer.warehouse_id = loop_warehouse.id where `ignore` = 0 and no_invoice = 0 and po_employee = '$initials' and (transaction_date >= DATE_FORMAT('$date_from_val' , '%Y-%m-%d') and transaction_date <= DATE_FORMAT('$date_to_val' , '%Y-%m-%d'))";
                     
                     		db();
                     
                     		$dt_view_res = db_query($dt_view_qry);
                     
                     		while ($dt_view_row = array_shift($dt_view_res)) {
                     
                     			$fdq = "SELECT id AS I FROM loop_transaction_buyer WHERE warehouse_id = " . $dt_view_row["warehouse_id"] . " and `ignore` = 0 and no_invoice = 0 and po_employee = '$initials' ORDER BY I ASC LIMIT 0,1";
								
								db();
                     			$fd_res = db_query($fdq);
                     
                     			$first_deal_s = 0; $first_deal_id = 0;
                     
                     			while ($fd_row = array_shift($fd_res)) {
                     
                     				if ($fd_row["I"] == $dt_view_row["id"]){
                     
                     					$first_deal_s = 1;
                     
                     					$first_deal_id = $dt_view_row["id"];
                     
                     					break;
                     
                     				}
                     
                     			} 
                     
                     			if ($first_deal_s == 1)
                     
                     			{
                     
                     				$first_rec_cnt_s = $first_rec_cnt_s + 1;
                     
                     
                     
                     				$nickname = get_nickname_val($dt_view_row["warehouse_name"], $dt_view_row["b2bid"]);
                     
                     
                     
                     				$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany.php?ID=" . $dt_view_row["b2bid"] . "&show=transactions&warehouse_id=" . $dt_view_row["warehouse_id"] . "&rec_type=Supplier&proc=View&searchcrit=&id=". $dt_view_row["warehouse_id"] ."&rec_id=" . $first_deal_id . "&display=buyer_payment'>". $dt_view_row["id"] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td><td bgColor='#E4EAEB' align='right'>$" . number_format($dt_view_row["SUMPO"],0) . "</td></tr>";
                     
                     			}
                     
                     		}
                     
                     	}
                     
                     }
                     
                     
                     
                     $lisoftrans .= "</table></span>";
                     
                     ?>
                  <a href='#' onclick='load_div(12); return false;'><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo number_format($first_rec_cnt_s); ?></font></a>
                  <span id='12' style='display:none;'><a href='#' onclick='close_div(); return false;'>Close</a><?php echo $lisoftrans; ?></span>
               </td>
            </tr>
            <tr>
               <td style="width: 200"class="style3" align="left">
                  Difference of PO Entered and Quota
               </td>
               <td style="width: 190"class="style3" align="center">
                  <?php
                     $txtcolor="#333333";
                     
                     $lisoftrans = "<span style='width:800px;'><table cellSpacing='1' cellPadding='1' border='0' width='800' class='pop-table'>";
                     
                     $lisoftrans .= "<tr><td bgColor='#ABC5DF'>Loop ID</td><td bgColor='#ABC5DF'>Invoice Number</td><td bgColor='#ABC5DF'>Company Nickname</td><td bgColor='#ABC5DF'>PO Amount</td></tr>";
                     
                     
                     
                     $tot_quota = 0; $quota = 0;
                     
                     $begin = new DateTime( $date_from_val );
                     
                     $end   = new DateTime( $date_to_val );
                     
                     
                     
                     for($datecnt = $begin; $datecnt < $end; $datecnt->modify('+1 day')){
                     
                     	$start_Dt_tmp = $datecnt->format("Y-m-d");
                     
                     	$newsel = "Select quota_month, quota , deal_quota, quota_year  from employee_quota_overall where b2borb2c = 'b2b' and quota_year = " . $datecnt->format("Y"). " and quota_month = " . $datecnt->format("m");
						
						db();
                     	$result_empq = db_query($newsel);
                     
                     	while ($rowemp_empq = array_shift($result_empq)) {
                     
                     		$quota_one_day = $rowemp_empq["quota"]/date('t', strtotime($start_Dt_tmp));
                     
                     		$quota = $quota + $quota_one_day;
                     
                     	}		
                     
                     }
                     
                     $tot_quota = $tot_quota + $quota;
                     
                     
                     
                     $tot_po_amount=0;$summtd_dealcnt = 0;
                     
                     if($assignid=="all")
                     
                     {
                     
                     	$sqlrespo = "SELECT loop_transaction_buyer.inv_number, po_poorderamount as inv_amount, loop_transaction_buyer.id, loop_transaction_buyer.warehouse_id, loop_warehouse.b2bid FROM loop_transaction_buyer inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id WHERE loop_transaction_buyer.ignore < 1 AND transaction_date between '" . $date_from_val . "' AND '" . $date_to_val . " 23:59:59'";
                     
                     	db();

                     	$respo = db_query($sqlrespo);
                     
                     	while ($respo_row = array_shift($respo)) {
                     
                     		$tot_po_amount=$tot_po_amount+ $respo_row["inv_amount"];
                     
                     		//
                     
                     		$nickname = get_nickname_val('', $respo_row["b2bid"]);
                     
                     		//
                     
                     		if($respo_row["inv_amount"]>0)
                     
                     		{
                     
                     			$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany.php?ID=" . $respo_row["b2bid"] . "&show=transactions&warehouse_id=" . $respo_row["warehouse_id"] . "&rec_type=Supplier&proc=View&searchcrit=&id=". $respo_row["warehouse_id"] ."&rec_id=" . $respo_row["id"] . "&display=buyer_view'>". $respo_row["id"] . "</a></td><td bgColor='#E4EAEB'>" . $respo_row["inv_number"] . "</td><td bgColor='#E4EAEB'>" . $nickname . "</td><td bgColor='#E4EAEB' align='right'>$" . number_format($inv_amt_totake,0) . "</td></tr>";
                     
                     		}
                     
                     	}	
                     
                     }
                     
                     else{
                     
                     	$sql = "SELECT * FROM loop_employees WHERE quota > 0 and id=".$assignid." ORDER BY quota DESC";
						
						db();
                     	$result = db_query($sql);
                     
                     	while ($rowemp = array_shift($result)) {
                     
                     		$initials = $rowemp["initials"];
                     
                     		$sqlrespo = "SELECT loop_transaction_buyer.inv_number, po_poorderamount as inv_amount, loop_transaction_buyer.id, loop_transaction_buyer.warehouse_id, loop_warehouse.b2bid FROM loop_transaction_buyer inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id WHERE po_employee LIKE '" . $initials . "' AND loop_transaction_buyer.ignore < 1 AND transaction_date between '" . $date_from_val . "' AND '" . $date_to_val . " 23:59:59'";
                     
                     		db();
                     		$respo = db_query($sqlrespo);
                     
                     		while ($respo_row = array_shift($respo)) {
                     
                     
                     
                     			$tot_po_amount=$tot_po_amount+$respo_row["inv_amount"];
                     
                     			//
                     
                     			$nickname = get_nickname_val('', $respo_row["b2bid"]);
                     
                     			//
                     
                     			if($respo_row["inv_amount"]>0)
                     
                     			{
                     
                     				$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany.php?ID=" . $respo_row["b2bid"] . "&show=transactions&warehouse_id=" . $respo_row["warehouse_id"] . "&rec_type=Supplier&proc=View&searchcrit=&id=". $respo_row["warehouse_id"] ."&rec_id=" . $respo_row["id"] . "&display=buyer_view'>". $respo_row["id"] . "</a></td><td bgColor='#E4EAEB'>" . $respo_row["inv_number"] . "</td><td bgColor='#E4EAEB'>" . $nickname . "</td><td bgColor='#E4EAEB' align='right'>$" . number_format($respo_row["inv_amount"],0) . "</td></tr>";
                     
                     			}
                     
                     		}
                     
                     	}
                     
                     }
                     
                     $poquota=$tot_po_amount-$tot_quota;
                     
                     $lisoftrans .= "</table></span>";
                    
                     
                     	if($poquota>0){
                     
                     		$txtcolor="#00971A";
                     
                     	}
                     
                     	if($poquota<0){
                     
                     		$txtcolor="#FF0004";
                     
                     	}
                     
                     //
                     
                     ?>
                  <a href='#' onclick='load_div(13); return false;'><font face="Arial, Helvetica, sans-serif" size="1" color="<?php echo $txtcolor; ?>"><?php echo "$". number_format($poquota,0); ?></font></a>
                  <span id='13' style='display:none;'><a href='#' onclick='close_div(); return false;'>Close</a><?php echo $lisoftrans; ?></span>
               </td>
            </tr>
            <tr>
               <td style="width: 200"class="style3" align="left">
                  Difference of Revenue and Quota
               </td>
               <td style="width: 190"class="style3" align="center">
                  <?php
                     $lisoftrans = "<span style='width:800px;'><table cellSpacing='1' cellPadding='1' border='0' width='800' class='pop-table'>";
                     
                     $lisoftrans .= "<tr><td bgColor='#ABC5DF'>Loop ID</td><td bgColor='#ABC5DF'>Invoice Number</td><td bgColor='#ABC5DF'>Company Nickname</td><td bgColor='#ABC5DF'>Revenue Amount</td></tr>";
                     
                     //
                     
                     $tot_po_amount=0;$summtd_dealcnt = 0;
                     
                     if($assignid=="all")
                     
                     {
                     
                     	
                     	$sqlrespo = "SELECT loop_transaction_buyer.inv_number, loop_transaction_buyer.inv_amount as invsent_amt , loop_invoice_details.total as inv_amount, loop_transaction_buyer.id, loop_transaction_buyer.warehouse_id, loop_warehouse.b2bid FROM loop_transaction_buyer left join loop_invoice_details on loop_invoice_details.trans_rec_id = loop_transaction_buyer.id inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id WHERE loop_invoice_details.total > 0 and Leaderboard = 'B2B' AND loop_transaction_buyer.ignore < 1 AND (case when inv_date_of is NULL or inv_date_of = '' then loop_invoice_details.timestamp else STR_TO_DATE(inv_date_of, '%m/%d/%Y') end) BETWEEN '" . $date_from_val . "' AND '" . $date_to_val . " 23:59:59'";
						
						db();
                     	$respo = db_query($sqlrespo);
                     
                     	while ($respo_row = array_shift($respo)) {
                     
                     		$finalpaid_amt = 0;
							
							db();
                     		$result_finalpmt = db_query("Select ROUND(sum(loop_buyer_payments.amount),2) as amt from loop_buyer_payments where trans_rec_id = " . $respo_row["id"]  );
                     
                     		while ($summtd_finalpmt = array_shift($result_finalpmt)) {
                     
                     			$finalpaid_amt = $summtd_finalpmt["amt"];
                     
                     		}
                     
                     
                     
                     		$inv_amt_totake= 0;
                     
                     		
                     
                     		if ($finalpaid_amt > 0){
                     
                     			$inv_amt_totake= str_replace("," , "", $finalpaid_amt);
                     
                     		}
                     
                     		if ($finalpaid_amt == 0 && $respo_row["invsent_amt"] > 0){
                     
                     			$inv_amt_totake= str_replace("," , "", $respo_row["invsent_amt"]);
                     
                     		}
                     
                     		if ($finalpaid_amt == 0 && $respo_row["invsent_amt"] == 0 && $respo_row["inv_amount"] > 0){
                     
                     			$inv_amt_totake = str_replace("," , "", $respo_row["inv_amount"]);
                     
                     		}
                     
                     		
                     
                     		$tot_rev_amount=$tot_rev_amount+$inv_amt_totake;
                     
                     		//
                     
                     		$nickname = get_nickname_val('', $respo_row["b2bid"]);
                     
                     		//
                     
                     		if($respo_row["inv_amount"]>0)
                     
                     		{
                     
                     			$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany.php?ID=" . $respo_row["b2bid"] . "&show=transactions&warehouse_id=" . $respo_row["warehouse_id"] . "&rec_type=Supplier&proc=View&searchcrit=&id=". $respo_row["warehouse_id"] ."&rec_id=" . $respo_row["id"] . "&display=buyer_view'>". $respo_row["id"] . "</a></td><td bgColor='#E4EAEB'>" . $respo_row["inv_number"] . "</td><td bgColor='#E4EAEB'>" . $nickname . "</td><td bgColor='#E4EAEB' align='right'>$" . number_format($inv_amt_totake,0) . "</td></tr>";
                     
                     		}
                     
                     	}	
                     
                     }
                     
                     else{
                     
                     
                     
                     	$sql = "SELECT * FROM loop_employees WHERE quota > 0 and id=".$assignid." ORDER BY quota DESC";
						
						db();
                     	$result = db_query($sql);
                     
                     	while ($rowemp = array_shift($result)) {
                     
                     		$initials = $rowemp["initials"];
                     
                     		$sqlrespo = "SELECT loop_transaction_buyer.inv_number, loop_transaction_buyer.inv_amount as invsent_amt , loop_invoice_details.total as inv_amount, loop_transaction_buyer.id, loop_transaction_buyer.warehouse_id, loop_warehouse.b2bid FROM loop_transaction_buyer left join loop_invoice_details on loop_invoice_details.trans_rec_id = loop_transaction_buyer.id inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id WHERE loop_invoice_details.total > 0 and po_employee LIKE '" . $initials . "' and Leaderboard = 'B2B' AND loop_transaction_buyer.ignore < 1 AND (case when inv_date_of is NULL or inv_date_of = '' then loop_invoice_details.timestamp else STR_TO_DATE(inv_date_of, '%m/%d/%Y') end) BETWEEN '" . $date_from_val . "' AND '" . $date_to_val . " 23:59:59'";						
							
							db();
                     		$respo = db_query($sqlrespo);
                     
                     		while ($respo_row = array_shift($respo)) {
                     
                     			$finalpaid_amt = 0;
								
								db();
                     			$result_finalpmt = db_query("Select ROUND(sum(loop_buyer_payments.amount),2) as amt from loop_buyer_payments where trans_rec_id = " . $respo_row["id"]  );
                     
                     			while ($summtd_finalpmt = array_shift($result_finalpmt)) {
                     
                     				$finalpaid_amt = $summtd_finalpmt["amt"];
                     
                     			}
                     
                     
                     
                     			$inv_amt_totake= 0;
                     
                     			
                     
                     			if ($finalpaid_amt > 0){
                     
                     				$inv_amt_totake= str_replace("," , "", $finalpaid_amt);
                     
                     			}
                     
                     			if ($finalpaid_amt == 0 && $respo_row["invsent_amt"] > 0){
                     
                     				$inv_amt_totake= str_replace("," , "", $respo_row["invsent_amt"]);
                     
                     			}
                     
                     			if ($finalpaid_amt == 0 && $respo_row["invsent_amt"] == 0 && $respo_row["inv_amount"] > 0){
                     
                     				$inv_amt_totake = str_replace("," , "", $respo_row["inv_amount"]);
                     
                     			}
                     
                     		
                     
                     			$tot_rev_amount=$tot_rev_amount+$inv_amt_totake;
                     
                     			//
                     
                     			$nickname = get_nickname_val('', $respo_row["b2bid"]);
                     
                     			//
                     
                     			if($respo_row["inv_amount"]>0)
                     
                     			{
                     
                     				$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany.php?ID=" . $respo_row["b2bid"] . "&show=transactions&warehouse_id=" . $respo_row["warehouse_id"] . "&rec_type=Supplier&proc=View&searchcrit=&id=". $respo_row["warehouse_id"] ."&rec_id=" . $respo_row["id"] . "&display=buyer_view'>". $respo_row["id"] . "</a></td><td bgColor='#E4EAEB'>" . $respo_row["inv_number"] . "</td><td bgColor='#E4EAEB'>" . $nickname . "</td><td bgColor='#E4EAEB' align='right'>$" . number_format($respo_row["inv_amount"],0) . "</td></tr>";
                     
                     			}
                     
                     		}
                     
                     	}
                     
                     }
                     
                     $revquota=$tot_rev_amount-$tot_quota;
                      
                     $lisoftrans .= "</table></span>";
                     
                     //
                     	if($revquota>0){
                     
                     		$txtcolor="#00971A";
                     
                     	}
                     
                     	if($revquota<=0){
                     
                     		$txtcolor="#FF0004";
                     
                     	}
                     
                     //
                     
                     ?>
                  <a href='#' onclick='load_div(14); return false;'><font face="Arial, Helvetica, sans-serif" size="1" color="<?php echo $txtcolor; ?>"><?php echo "$". number_format($revquota,0); ?></font></a>
                  <span id='14' style='display:none;'><a href='#' onclick='close_div(); return false;'>Close</a><?php echo $lisoftrans; ?></span>			
               </td>
            </tr>
            <tr>
               <td style="width: 200"class="style3" align="left">
                  # of Reps in the Red YTD
               </td>
               <td style="width: 190"class="style3" align="center">
                  <?php
                     
                     $no_emp_inred = 0; $diff_ytd = 0;
                     
                     $sql = "SELECT * FROM loop_employees where quota > 0 and leaderboard = 1 ORDER BY quota DESC";
                     db();
                     $result = db_query($sql);
                     
                     while ($rowemp = array_shift($result)) {
                     
                     	$summtd_SUMPO = 0; 
                     
                     	$empqry_nm= " and po_employee LIKE '" . $rowemp["initials"] . "'";
                     
                     	$sqlmtd = "SELECT loop_transaction_buyer.inv_number, loop_transaction_buyer.inv_amount as invsent_amt , loop_invoice_details.total as inv_amount, loop_transaction_buyer.id, loop_transaction_buyer.warehouse_id, loop_warehouse.b2bid FROM loop_transaction_buyer left join loop_invoice_details on loop_invoice_details.trans_rec_id = loop_transaction_buyer.id inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id WHERE loop_invoice_details.total > 0 $empqry_nm AND loop_transaction_buyer.ignore < 1 AND (case when inv_date_of is NULL or inv_date_of = '' then loop_invoice_details.timestamp else STR_TO_DATE(inv_date_of, '%m/%d/%Y') end) BETWEEN '" . date("Y-01-01") . "' AND '" . date("Y-m-d") . " 23:59:59'";
                     
                     	db();
                     
                     	$resultmtd = db_query($sqlmtd);
                     
                     	while ($summtd = array_shift($resultmtd)) {
                     
                     		$finalpaid_amt = 0;

							db();
                     		$result_finalpmt = db_query("Select ROUND(sum(loop_buyer_payments.amount),2) as amt from loop_buyer_payments where trans_rec_id = " . $summtd["id"]  );
                     
                     		while ($summtd_finalpmt = array_shift($result_finalpmt)) {
                     
                     			$finalpaid_amt = $summtd_finalpmt["amt"];
                     
                     		}
                     
                     
                     
                     		$inv_amt_totake= 0;
                     
                     		if ($finalpaid_amt > 0){
                     
                     			$inv_amt_totake= str_replace("," , "", $finalpaid_amt);
                     
                     		}
                     
                     		if ($finalpaid_amt == 0 && $summtd["invsent_amt"] > 0){
                     
                     			$inv_amt_totake= str_replace("," , "", $summtd["invsent_amt"]);
                     
                     		}
                     
                     		if ($finalpaid_amt == 0 && $summtd["invsent_amt"] == 0 && $summtd["inv_amount"] > 0){
                     
                     			$inv_amt_totake = str_replace("," , "", $summtd["inv_amount"]);
                     
                     		}
                     
                     		
                     
                     		$summtd_SUMPO = $summtd_SUMPO + $inv_amt_totake;
                     
                     	}
                     
                     
                     
                     	$quota_mtd = 0; $donot_add = ""; $days_in_month = 0;
                     
                     	$dt_month_value_1 = date('m');
                     
						db();
                     
                     	$result_empq = db_query("Select quota_month, quota, deal_quota from employee_quota where emp_id = " . $rowemp["id"] . " and quota_year = " . date("Y") . " order by quota_month");
                     
                     	while ($rowemp_empq = array_shift($result_empq)) {
                     
                     		$quota = $quota + $rowemp_empq["quota"];
                     
                     
                     
                     		$todays_dt=date('m/d/Y');
                     
                     		$days_today = 1+dateDiff($todays_dt,date('Y-m-01'));
                     
                     		$days_in_month = 1+dateDiff(date('Y-m-t'),date('Y-m-01'));
                     
                     		
                     
                     		if ($donot_add == "") {
                     
                     			if ($rowemp_empq["quota_month"] <= $dt_month_value_1) {
                     
                     				if ($rowemp_empq["quota_month"] == $dt_month_value_1) {
                     
                     					$donot_add = "yes";
                     
                     					$monthly_qtd_1 = ($days_today*$rowemp_empq["quota"])/$days_in_month;
                     
                     					
                     
                     					$quota_mtd = $quota_mtd + $monthly_qtd_1;
                     
                     				}else{
                     
                     					$quota_mtd = $quota_mtd + $rowemp_empq["quota"];
                     
                     				}
                     
                     			}
                     
                     		}
                     
                     	}
                     
                     	$monthly_qtd_TD = $quota_mtd;
                     
                     	
                     
                     	//echo $rowemp["name"] . " " . $summtd_SUMPO . " - " . $monthly_qtd_TD . "<br>";
                     
                     	if (($summtd_SUMPO*100/$monthly_qtd_TD) < 100 && $summtd_SUMPO > 0 && $monthly_qtd_TD > 0) { $color_y_new = "red"; $no_emp_inred = $no_emp_inred + 1;} 
                     
                     	if ($summtd_SUMPO == 0 && $monthly_qtd_TD > 0) { $color_y_new = "red"; $no_emp_inred = $no_emp_inred + 1;}
                     
                     	
                     
                     }
                     
                     
                     
                     echo $no_emp_inred;				
                     
                     ?>
               </td>
            </tr>
            <tr>
               <td style="width: 200"class="style3" align="left">
                  Difference of YTD Revenue and YTD Quota of Ops Team
               </td>
               <?php
                  $summtd_SUMPO = 0; 
                  
                  $sqlmtd = "SELECT loop_transaction_buyer.inv_number, loop_transaction_buyer.inv_amount as invsent_amt , loop_invoice_details.total as inv_amount, loop_transaction_buyer.id, loop_transaction_buyer.warehouse_id, loop_warehouse.b2bid FROM loop_transaction_buyer left join loop_invoice_details on loop_invoice_details.trans_rec_id = loop_transaction_buyer.id inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id WHERE loop_invoice_details.total > 0 AND loop_transaction_buyer.ignore < 1 AND (case when inv_date_of is NULL or inv_date_of = '' then loop_invoice_details.timestamp else STR_TO_DATE(inv_date_of, '%m/%d/%Y') end) BETWEEN '" . date("Y-01-01") . "' AND '" . date("Y-m-d") . " 23:59:59'";
                  
                  db();
                  
                  $resultmtd = db_query($sqlmtd);
                  
                  while ($summtd = array_shift($resultmtd)) {
                  
                  	$finalpaid_amt = 0;

					db();
                  	$result_finalpmt = db_query("Select ROUND(sum(loop_buyer_payments.amount),2) as amt from loop_buyer_payments where trans_rec_id = " . $summtd["id"]);
                  
                  	while ($summtd_finalpmt = array_shift($result_finalpmt)) {
                  
                  		$finalpaid_amt = $summtd_finalpmt["amt"];
                  
                  	}
                  
                  
                  
                  	$inv_amt_totake= 0;
                  
                  	if ($finalpaid_amt > 0){
                  
                  		$inv_amt_totake= str_replace("," , "", $finalpaid_amt);
                  
                  	}
                  
                  	if ($finalpaid_amt == 0 && $summtd["invsent_amt"] > 0){
                  
                  		$inv_amt_totake= str_replace("," , "", $summtd["invsent_amt"]);
                  
                  	}
                  
                  	if ($finalpaid_amt == 0 && $summtd["invsent_amt"] == 0 && $summtd["inv_amount"] > 0){
                  
                  		$inv_amt_totake = str_replace("," , "", $summtd["inv_amount"]);
                  
                  	}
                  
                  	
                  
                  	$summtd_SUMPO = $summtd_SUMPO + $inv_amt_totake;
                  
                  }
                  
                  
                  
                  $quota = 0;
                  
                  $date_from_val = date("Y-01-01");
                  
                  $date_to_val = date("Y-m-d");
                  
                  
                  
                  $begin = new DateTime( $date_from_val );
                  
                  $end   = new DateTime( $date_to_val );
                  
                  
                  
                  for($datecnt = $begin; $datecnt < $end; $datecnt->modify('+1 day')){
                  
                  	$start_Dt_tmp = $datecnt->format("Y-m-d");
                  
                  	$newsel = "Select quota_month, quota , deal_quota, quota_year  from employee_quota_overall where b2borb2c = 'b2b' and quota_year = " . $datecnt->format("Y"). " and quota_month = " . $datecnt->format("m");
					
					db();
                  	$result_empq = db_query($newsel);
                  
                  	while ($rowemp_empq = array_shift($result_empq)) {
                  
                  		$quota_one_day = $rowemp_empq["quota"]/date('t', strtotime($start_Dt_tmp));
                  
                  		$quota = $quota + $quota_one_day;
                  
                  	}		
                  
                  }
                  
                  $monthly_qtd_TD = $quota;
                  
                  //echo $summtd_SUMPO . " " . $monthly_qtd_TD . "<br>";
                  
                  
                  
                  $diff_ytd = ($summtd_SUMPO - $monthly_qtd_TD);	
                  
                  
                  
                  if($diff_ytd>0){
                  
                  $txtcolor="#00971A";
                  
                  }
                  
                  if($diff_ytd<=0){
                  
                  $txtcolor="#FF0004";
                  
                  }
                  
                  ?>
               <td style="width: 190"class="style3" align="center">
                  <span style="color:<?php echo $txtcolor; ?>">$<?php echo number_format($diff_ytd, 0);?></span>
               </td>
            </tr>
         </table>
         <?php
            }
            
            ?>
      </div>
   </body>
</html>
