<?php
   require ("inc/header_session.php");
   require ("../mainfunctions/database.php");
   require ("../mainfunctions/general-functions.php");
?>
<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <title>SCORECARD: Operations Function - Facilities Dept.</title>
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
         select, input {
         font-family: Arial, Helvetica, sans-serif; 
         font-size: 12px; 
         color : #000000; 
         font-weight: normal; 
         }
         table.datatable {
         border-collapse: collapse;
         background: #FFF;
         width: 50%;
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
         /*height: 20px;*/
         border: 1px solid white;
         padding: 3px;
         }
      </style>
      <LINK rel='stylesheet' type='text/css' href='one_style.css' >
      <SCRIPT LANGUAGE="JavaScript" SRC="inc/CalendarPopup.js"></SCRIPT><SCRIPT LANGUAGE="JavaScript" SRC="inc/general.js"></SCRIPT>
      <script LANGUAGE="JavaScript">document.write(getCalendarStyles());</script>
      <script LANGUAGE="JavaScript">
         var cal2xx = new CalendarPopup("listdiv");
         
         cal2xx.showNavigationDropdowns();
         
         var cal3xx = new CalendarPopup("listdiv");
         
         cal3xx.showNavigationDropdowns();
         
         
         
         
         
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
         
         	document.getElementById('fade').style.display='block';
         
         
         
         	document.getElementById('light').style.left='100px';
         
         	document.getElementById('light').style.top=elementTop + 100 + 'px';
         
         }
         
         
         
         
         
         function close_div(){
         
         	document.getElementById('light').style.display='none';
         
         }		
         
      </script> 
      <style>		
         .main_data_css{
         margin: 0 auto;
         width: 100%;
         height: auto;
         clear: both !important;
         padding-top: 35px;
         margin-left: 10px;
         margin-right: 10px;
         }
         .search input {
         height: 24px !important;
         }	
         .black_overlay{
         display: none;
         position: absolute;
         }
         .white_content {
         display: none;
         position: absolute;
         padding: 5px;
         border: 2px solid black;
         background-color: white;
         overflow:auto;
         height:600px;
         width:850px;
         z-index:1002;
         margin: 0px 0 0 0px; 
         padding: 10px 10px 10px 10px;
         border-color:black; 
         border-width:2px;
         overflow: auto;
         }
      </style>
      <LINK rel='stylesheet' type='text/css' href='one_style.css' >
      <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
      <link rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>
   </head>
   <body>
      <div id="light" class="white_content">
      </div>
      <div id="fade" class="black_overlay"></div>
      <?php include("inc/header.php"); ?>
      <div class="main_data_css">
         <?php
            function Warehouse_Fullness_Cal($warehouseid_selected){
            
            	$space_taken_by_item_final = 0;
            
            	
            
            	$box_type_str_arr = array("'Gaylord','GaylordUCB', 'PresoldGaylord', 'Loop'", "'LoopShipping','Box','Boxnonucb','Presold','Medium','Large','Xlarge','Boxnonucb'" , "'SupersackUCB','SupersacknonUCB'", "'DrumBarrelUCB','DrumBarrelnonUCB'", "'PalletsUCB','PalletsnonUCB'", "'Recycling','Other','Waste-to-Energy'");
            
            	foreach ($box_type_str_arr as $box_type_str_arr_tmp){
            
            
            
            		$dt_view_qry = "SELECT *,LWH, CONVERT(trim(SUBSTRING_INDEX(`LWH`, 'x', -1)) ,UNSIGNED INTEGER) AS `ht` from tmp_inventory_list_set2_condition2 where wid = " .  $warehouseid_selected . " and type_ofbox in (" . $box_type_str_arr_tmp . ") order by ht, description";
					
					db_b2b();
            		$dt_view_res = db_query($dt_view_qry);
            
            
            
            		$tmpwarenm = ""; $tmp_noofpallet = 0; $ware_house_boxdraw = "";
            
            		while ($dt_view_row = array_shift($dt_view_res)) {
            
            
            
            			$boxqry="select bpallet_l, bpallet_w, bpallet_h from loop_boxes where id=".$dt_view_row["trans_id"];
            
            				//echo $boxqry;
            
            			$cubic_footage_strapped_pallet = 0; $space_taken_by_item = 0;
						
						db();
            			$boxres=db_query($boxqry);
            
            			while($boxrow=array_shift($boxres)){
            
            				//Calculate strapped_pallets_inv
            
            				if($dt_view_row["actual"]>0){
            
            					$strapped_pallets_inv=$dt_view_row["actual"]/$dt_view_row["per_pallet"];
            
            				}
            
            				else{
            
            					$strapped_pallets_inv=0;
            
            				}
            
            				$bpallet_l=$boxrow["bpallet_l"];
            
            				$bpallet_w=$boxrow["bpallet_w"];
            
            				$bpallet_h=$boxrow["bpallet_h"];
            
            
            
            				$cubic_footage_strapped_pallet=($bpallet_l*$bpallet_w*$bpallet_h)/1728;
            
            
            
            				$space_taken_by_item=$strapped_pallets_inv*$cubic_footage_strapped_pallet;
            
            			}	
            
            			
            
            			$space_taken_by_item_final = $space_taken_by_item_final+$space_taken_by_item;
            
            		}
            
            		
            
            	}
            
            
            
            	$pallet_space = 0;
            
            	$boxqry= "select id, pallet_space from loop_warehouse where id=".$warehouseid_selected;
				
				db();
            	$boxres=db_query($boxqry);
            
            	while($boxrow=array_shift($boxres)){
            
            		$pallet_space = $boxrow["pallet_space"];
            
            	}	
            
            
            
            	$wh_fullness=$space_taken_by_item_final/$pallet_space*100;
            
            	return number_format($wh_fullness,0) . "%";
            
            
            
            }
            
            
            
            	$time = strtotime(Date('Y-m-d'));
            
            	$st_friday = $time;
            
            	$st_friday_last = date('m/d/Y', strtotime('last sunday -7 days'));
            
            	$st_thursday_last = date('m/d/Y', strtotime('last saturday'));
            
            	
            
            	//$st_friday_last = '01/01/2019';
            
            	$in_dt_range = "no";
            
            	if( $_REQUEST["date_from"] !="" && $_REQUEST["date_to"] !=""){
            
            		$date_from_val = date("Y-m-d", strtotime($_REQUEST["date_from"]));
            
            		$date_to_val_org = date("Y-m-d", strtotime($_REQUEST["date_to"]));
            
            		$date_to_val = date("Y-m-d", strtotime($_REQUEST["date_to"]));
            
            		//$date_to_val = date("Y-m-d", strtotime('+1 day', strtotime($_REQUEST["date_to"])));
            
            		$in_dt_range = "yes";
            
            		//
            
            		$assignid=$_REQUEST["assignid"];
            
            		//
            
            	}else{
            
            		$in_dt_range = "no";
            
            		$date_from_val = date("Y-m-d", strtotime($st_friday_last));
            
            		$date_to_val_org = date("Y-m-d", strtotime($st_thursday_last));
            
            		$date_to_val = date("Y-m-d", strtotime($st_thursday_last));
            
            		//$date_to_val = date("Y-m-d", strtotime('+1 day', strtotime($st_thursday_last)));
            
            		$assignid="all";
            
            	}
            
            	if($assignid=="all"){
            
            		$empqry="";
            
            	}
            
            	else{
            
            		$empqry=" and assignedto=".$assignid;
            
            	}
            
            	?>
         <div class="dashboard_heading" style="float: left;">
            <div style="float: left;">
               SCORECARD: Operations Function -  Facilities Deptartment
               <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
                  <span class="tooltiptext">
                  This scorecard shows the user the data for the Facilities Department.
                  </span>
               </div>
               <div style="height: 13px;">&nbsp;</div>
            </div>
         </div>
         <form method="post" name="sales_func" action="SCORECARD_operations_function_facilities_dept.php">
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
                     <input type="submit" name="btntool" value="Submit" />
                     <input type="hidden" name="sale_pgpost" id="sale_pgpost" value=""/>
                  </td>
               </tr>
            </table>
         </form>
         <br>
         <!--New table formatting-->
         <!------------------Table for HV warehouse------------------->
         <?php
            if( isset($_REQUEST["btntool"])){
            
            //Calculate money lost ----------------------------------------- 
            
            	//
            
            	if( $_REQUEST["date_from"] =="" && $_REQUEST["date_to"] ==""){
            
            		
            
            			$dfa = explode('/', $st_friday_last);
            
            			$dfs = $dfa[2] . "-" . $dfa[0] . "-" . $dfa[1] . " 00:00:00";
            
            			$df = date($dfs);
            
            			$dta = explode('/', $st_thursday_last);
            
            			$dts = $dta[2] . "-" . $dta[0] . "-" . $dta[1] . " 23:59:59";
            
            			$dt = date($dts);
            
            	}
            
            	else{
            
            			if (date("d") < 16)
            
            			{ 	
            
            				$dt = date('Y-m-01');
            
            				$dttitle = date('m/01/Y');
            
            			}
            
            			else { $dt = date('Y-m-16'); 
            
            			$dttitle = date('m/16/Y');
            
            			}
            
            			$dfa = explode('/',$_REQUEST["date_from"]);
            
            			$dfs = $dfa[2] . "-" . $dfa[0] . "-" . $dfa[1] . " 00:00:00";
            
            			$df = date($dfs);
            
            			$dta = explode('/',$_REQUEST["date_to"]);
            
            			$dts = $dta[2] . "-" . $dta[0] . "-" . $dta[1] . " 23:59:59";
            
            			$dt = date($dts);
            
            			//
            
            	}
            
            			//echo $dfs."-".$dts;
            
            			$array_warehouse[] = array('id' => 18);
            
            			$array_warehouse[] = array('id' => 556);
            
            			$array_warehouse[] = array('id' => 2563);
            
            							
            
            			foreach ($array_warehouse as $array_warehouse2) {
            
            				$x=1; $MGArray = array();
            
            				$query = "SELECT DISTINCT worker_id, loop_timeclock.warehouse_id FROM loop_timeclock WHERE time_out <> '0000-00-00 00:00:00' and (loop_timeclock.type LIKE '%Production' OR loop_timeclock.type LIKE '%kits' OR loop_timeclock.type LIKE '%achines') AND loop_timeclock.warehouse_id in (" . $array_warehouse2["id"] . ") AND (time_in BETWEEN '" . $dfs . "' AND '" . $dts . "')";
            
            				
							db();
            				$resq = db_query($query);
            
            				While ($rowq = array_shift($resq))
            
            				{
            
            					$query = "SELECT name, loop_workers.rate_cost AS RC, SUM(TIME_TO_SEC(TIMEDIFF(time_out,time_in)))/3600 AS DT FROM loop_timeclock LEFT JOIN loop_workers ON loop_timeclock.worker_id = loop_workers.id WHERE (loop_timeclock.type LIKE '%Production' OR loop_timeclock.type LIKE '%kits' OR loop_timeclock.type LIKE '%achines') AND loop_timeclock.time_out <> '0000-00-00 00:00:00' and loop_timeclock.worker_id = " . $rowq["worker_id"] ." and (time_in BETWEEN '" . $dfs . "' AND '" . $dts . "')";
            
            					/*if($_GET["start_date"] != "qqq")
            
            					{
            
            						$query .= " AND time_in BETWEEN '" . $dfs . "'";
            
            					}
            
            					if($_GET["date_to"] != "qqqq")
            
            					{
            
            					 $query .= " AND '" . $dts . "'";
            
            					}*/
								db();
            					$res = db_query($query);
            
            					$hours = 0; $hourrate = 0;
            
            					while ($row = array_shift($res)){
            
            						$name = $row["name"];
            
            						$hourrate = $row["RC"];
            
            						if ($row["DT"] > 0){
            
            							$hours = $row["DT"];
            
            						}
            
            						$query2 = "SELECT rate, production FROM loop_timeclock_production WHERE worker_id =  " . $rowq["worker_id"]." AND ( date BETWEEN '" . $dfs . "' AND '" . $dts . "')";
            
            						/*if($_GET["start_date"] != "q")
            
            						{
            
            							$query2 .= " AND date BETWEEN '" . $dfs . "'";
            
            						}
            
            						if($_GET["date_to"] != "q")
            
            						{
            
            							$query2 .= " AND '" . $dts . "'";
            
            						}*/
									db();
            						$res2 = db_query($query2);
            
            						$efficiency = 0; $tot_production = 0;
            
            						while ($row2 = array_shift($res2)){
            
            						
            
            /**************************************************************************************************************************/
            
            /**************************************************************************************************************************/ 
            
            								$et_query="select * from loop_worker_tier where tier = (select emp_tier from loop_workers where id=".$rowq["worker_id"].")";

											db();
            								$etres=db_query($et_query);
            
            								$et_row=array_shift($etres);
            
            								$emp_tier_value=$et_row["tier_value"];
            
            								
            
            								$production_val = $row2["rate"]*$row2["production"];
            
            								
            
            								$tot_production_tier = $production_val * $emp_tier_value;
            
            								$tot_production = $tot_production + number_format(($production_val + $tot_production_tier),2);
            
            								
            
            /**************************************************************************************************************************/
            
            /**************************************************************************************************************************/ 
            
            						}
            
            							if (($row["DT"] * $row["RC"]) > 0 )
            
            							{ 	
            
            								$efficiency = 100*$row2["P"]/($row["DT"] * $row["RC"]); }
            
            							else{	$efficiency = 0; }
            
            						
            
            					}
            
            						$warehouse_name = "";
            
            						if ($rowq["warehouse_id"] == 18){
            
            							$warehouse_name = "Hunt Valley";
            
            						}
            
            						if ($rowq["warehouse_id"] == 556){
            
            							$warehouse_name = "Hannibal";
            
            						}
            
            						if ($rowq["warehouse_id"] == 2563){
            
            							$warehouse_name = "Milwaukee";
            
            						}
            
            
            
            						$MGArray[] = array('name' => $name, 'warehouse_name' => $warehouse_name, "hourrate" => $hourrate, 'totalhours' => $hours, 'efficiency' => $efficiency, 'production' => $tot_production);
            
            					}
            
            
            
            						if ($array_warehouse2["id"] == 18){
            
            							$warehouse_name = "Hunt Valley";
            
            						}
            
            						if ($array_warehouse2["id"] == 556){
            
            							$warehouse_name = "Hannibal";
            
            						}
            
            						if ($array_warehouse2["id"] == 2563){
            
            							$warehouse_name = "Milwaukee";
            
            						}
            
            
            
            						$vc_array_value = array();
            
            						$vc_array_name = array();
            
            						foreach ($MGArray as $key => $row)
            
            						{
            
            							$vc_array_value[$key] = $row['production'];
            
            							$vc_array_name[$key] = $row['efficiency'];
            
            						}
            
            						array_multisort($vc_array_value, SORT_DESC, $vc_array_name, SORT_DESC, $MGArray);
            
            						$tot_prod_hrs = 0; $tot_production = 0; $money_lost_tot = 0;
            
            						foreach ($MGArray as $MGArraytmp2) {
            
            							if ($MGArraytmp2["efficiency"] >= 100) {
            
            								$color = "<font color=green face=bold>";
            
            							} elseif ($MGArraytmp2["efficiency"] < 100) {
            
            								$color = "<font color=red face=bold>";
            
            							}  else {
            
            								$color = "<font color=#333333>";
            
            							}  
            
            						
            
            							$tot_prod_hrs = $tot_prod_hrs + $MGArraytmp2["totalhours"];
            
            							if ($MGArraytmp2["totalhours"] > 0){
            
            							}	
            
            							$tot_production = $tot_production + $MGArraytmp2["production"];
            
            							
            
            							/*if ($MGArraytmp2["efficiency"] < 100) {
            
            								$money_lost1 = (floatval($MGArraytmp2["production"])/floatval($MGArraytmp2["efficiency"]))*100;
            
            								$money_lost1 = $money_lost1 - floatval($MGArraytmp2["production"]);
            
            								if ($money_lost1 > 0){
            
            									$money_lost = $money_lost1*-1;
            
            								}else{
            
            									$money_lost = 0;
            
            								}										
            
            								$money_lost_tot = $money_lost + $money_lost_tot; 
            
            								
            
            							}else{
            
            								//$money_lost_tot ="0.00";
            
            							}*/
            
            
            
            
            
            							$money_lost = str_replace(",", "", number_format($MGArraytmp2["production"],2)) - (str_replace(",", "", number_format($MGArraytmp2["hourrate"],2))* str_replace(",", "", number_format($MGArraytmp2["totalhours"],2)));
            
            							
            
            							//echo $MGArraytmp2["name"] . " " . str_replace(",", "", number_format($MGArraytmp2["production"],2)) . "-" . str_replace(",", "", number_format($MGArraytmp2["hourrate"],2)) . " - " . str_replace(",", "", number_format($MGArraytmp2["totalhours"],2)) . " = " . $money_lost . "<br>";
            
            
            
            							if ($money_lost >0) {
            
            								//echo "$0.00";
            
            							}else{
            
            								if ($money_lost < 0){
            
            									//echo $color . "$" . number_format($money_lost,2); 
            
            								}else{
            
            									$money_lost = 0;
            
            								}										
            
            								$money_lost_tot = $money_lost_tot + $money_lost; 
            
            							}
            
            							
            
            							$x++;
            
            						}
            
            						
            
            						//echo $warehouse_name . " - " . $money_lost_tot . "<br>";
            
            							$MGArray_tot[] = array('warehouse_name' => $warehouse_name,'tot_prod_hrs' => $tot_prod_hrs, 'tot_production' => $tot_production, 'money_lost_tot' => $money_lost_tot);							
            
            							$money_lost_array[] = number_format($money_lost_tot,2);
            
            						?>
         <?php } 
            
            $tot_prod_hrs = 0; $tot_production = 0; $money_lost_tot = 0; $rank_val = 1;
            
            foreach ($MGArray_tot as $MGArraytmp2) {
            
				if ($MGArraytmp2["tot_prod_hrs"] != 0) { // Added this for Divide by zero error - Siddhesh
					$prod_hrs_array[] = number_format($MGArraytmp2["tot_production"] / $MGArraytmp2["tot_prod_hrs"], 2);
				} else {
					$prod_hrs_array[] = 0;
				}
            
            	
            
            	$tot_prod_hrs = $tot_prod_hrs + $MGArraytmp2["tot_prod_hrs"];
            
            			
            
            	$tot_production = $tot_production + $MGArraytmp2["tot_production"];
            
            	$money_lost_tot  = $money_lost_tot + $MGArraytmp2["money_lost_tot"];
            
            			
            
            	$rank_val = $rank_val +1;
            
            } 
            
            
            
			if ($tot_prod_hrs != 0) { // Added this for Divide by zero error - Siddhesh
				$prod_hrs_array_all = number_format($tot_production/$tot_prod_hrs,2);
			} else {
				$prod_hrs_array_all = 0;
			}
            
            
            
            $total_prod_hrs=$tot_prod_hrs;
            
            $total_production==$tot_production;
            
			if ($tot_prod_hrs != 0) { // Added this for Divide by zero error - Siddhesh
				$total_prod_per_hrs = $tot_production / $tot_prod_hrs;
			} else {
				$total_prod_per_hrs = 0;
			}
            
            $total_money_lost=$money_lost_tot;	
            
            //End Calculate money lost--------------------------------------
            
            
            
            //
            
            //-------Find Production per Hour of Entire Facility---------------------
            
            $array_warehouse1[] = array('id' => 18);
            
            $array_warehouse1[] = array('id' => 556);
            
            $array_warehouse1[] = array('id' => 2563);
            
            foreach ($array_warehouse1 as $array_warehouse2) {	 
            
            $production_total=0; 
            
            
            
            $sqlw = "SELECT DISTINCT worker_id AS WID FROM loop_timeclock INNER JOIN loop_workers ON loop_workers.id = loop_timeclock.worker_id WHERE loop_timeclock.time_in BETWEEN '" . $date_from_val . "' AND '" . $date_to_val . "' and loop_workers.warehouse_id in (" . $array_warehouse2["id"] . ")  ORDER BY loop_workers.warehouse_id ASC, loop_workers.name ASC";
            
            //	echo $sqlw;
			db();
            $resultw = db_query($sqlw);
            
            if(tep_db_num_rows($resultw)>0)
            
            {
            
            $production_total1 = 0; $regulartime = 0;
            
            while ($roww = array_shift($resultw)) {
            
            $start_date = isset($_REQUEST["date_from"])?strtotime($_REQUEST["date_from"]):strtotime($st_friday_last);
            
            $end_date = isset($_REQUEST["date_to"])?strtotime($_REQUEST["date_to"]):strtotime($st_thursday_last);
            
            $start_date = date('Y-m-d', $start_date);
            
            $end_date = date('Y-m-d', $end_date + 86400);
            
            $end_date_ot = date('Y-m-d', $end_date);
            
            
            
            $time = strtotime($start_date);
            
            $st_tuesday = strtotime('last tuesday', $time);
            
            $st_monday = strtotime('+6 days', $st_tuesday);
            
            
            
            $query = "SELECT *, DATE_FORMAT(date, '%W, %M %d, %Y') AS D, rate AS R, production AS P FROM loop_timeclock_production WHERE worker_id = " . $roww["WID"] . " AND (date BETWEEN '$date_from_val' AND '$date_to_val') ORDER BY date ASC";
			
			db();
            $res = db_query($query);
            
            $ques_prod_entries=0;
            
            while($row = array_shift($res))
            
            {
            
            $production_total+=$row["R"] * $row["P"];
            
            $production_total1 = $production_total1 + ($row["R"] * $row["P"]);
            
            }
            
            
            
            //(loop_timeclock.type LIKE '%Production' OR loop_timeclock.type LIKE '%kits' OR loop_timeclock.type LIKE '%achines') AND
            
            $query = "SELECT name, loop_workers.rate_cost AS RC, SUM(TIME_TO_SEC(TIMEDIFF(time_out,time_in)))/3600 AS DT FROM loop_timeclock LEFT JOIN loop_workers ON loop_timeclock.worker_id = loop_workers.id WHERE loop_timeclock.time_out <> '0000-00-00 00:00:00' and loop_timeclock.worker_id = " . $roww["WID"];
            
            $query .= " AND time_in BETWEEN '" . $date_from_val . "'";
            
            $query .= " AND '" . $date_to_val . "'";
            
            //echo $query . "<br>";
            db();
            $res = db_query($query);
            
            $name = "";
            
            $hours = 0;
            
            while ($row = array_shift($res)){
            
            $name = $row["name"];
            
            if ($row["DT"] > 0){
            
            	$hours = $row["DT"];
            
            }
            
            
            
            $query2 = "SELECT SUM( rate * production) AS P FROM loop_timeclock_production WHERE worker_id =  " . $roww["WID"];
            
            $query2 .= " AND date BETWEEN '" . $date_from_val . "'";
            
            $query2 .= " AND '" . $date_to_val . "'";
            
			db();
            $res2 = db_query($query2);
            
            $efficiency = 0; $tot_production = 0;
            
            while ($row2 = array_shift($res2)){
            
            	$tot_production = $row2["P"];
            
            	if (($row["DT"] * $row["RC"]) > 0 )
            
            	{ 	$efficiency = 100*$row2["P"]/($row["DT"] * $row["RC"]); }
            
            	else{	$efficiency = 0; }
            
            }
            
            }
            
            
            
            $regulartime = $regulartime + $hours;
            
            					
            
            //echo "Prod :" . $array_warehouse2["id"] . " " . $production_total1 . " - " . $regulartime . "<br>";
            
            }//end while 
            
            }
            
            
            
            if ($regulartime > 0 ) { 
            
            $overtime = number_format($overtime,2);
            
            $regulartime = number_format($regulartime,2);
            
            //
            
            //echo "Tot:" . $array_warehouse2["id"] . " " . $production_total . " - " . $regulartime . "<br>";
            
            
            
            $prod_per_hr1 = $production_total/$regulartime;
            
            $prod_per_hr = number_format($prod_per_hr1,2);
            
            
            
            $rate = number_format($rate,2);
            
            $billing_rate = number_format($billing_rate,2);
            
            $hours_t=number_format($regulartime * $rate + $overtime * $rate*1.5,2);
            
            
            
            //Total
            
            $d=str_replace(",", "", $hours_t);
            
            }
            
            
            
            $total_regular_hrs=bcadd($total_regular_hrs, $regulartime,2);
            
            $total_h=bcadd($total_h, $d,2);
            
            $total_production=bcadd($total_production, $production_total,2);
            
            $prod_per_hr2=$prod_per_hr2+$prod_per_hr1;  
            
            
            
            $total_prod_per_hrs_entire[]=$prod_per_hr2;
            
            
            
            $total_regular_hrs=0;
            
            $prod_per_hr2=0;
            
            $total_overtime_hrs=0;
            
            $total_h=0;
            
            $total_production=0;
            
            $total_prod_bonus=0;
            
            $total_other_bonus=0;
            
            $total_bonus_new=0;
            
            
            
            //}//end loop warehouse while(
            
            }
            
            //-------End Find Production per Hour of Entire Facility---------------------
            
            //
            
            
            
            //
            
            ?>
         <table cellSpacing="1" cellPadding="1" border="0" class="datatable">
            <tr>
               <td colspan="2" class="style17" align="center">
                  <strong>UCB-HV Warehouse</strong>
               </td>
            </tr>
            <tr>
               <td style="width: 200" class="style17" align="center">
                  <b>Measurables</b>
               </td>
               <td style="width: 190" class="style17" align="center">
                  <b>Number</b>
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  Order Issues
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
                  <?php
                     $lisoftrans = "<span style='width:800px;'><table cellSpacing='1' cellPadding='1' border='0' width='780'>";
                     
                     $lisoftrans .= "<tr><td class='txtstyle_color'>LOOP ID</td><td class='txtstyle_color'>Company Nickname</td></tr>";
                     
                     
                     
                     $hv_orderissue= 0;
                     
                     $dt_view_qry = "SELECT loop_warehouse.b2bid , loop_transaction_buyer.warehouse_id, loop_warehouse.warehouse_name, loop_transaction_buyer_order_issue.trans_id as I FROM loop_transaction_buyer_order_issue ";
                     
                     $dt_view_qry .= " INNER JOIN loop_transaction_buyer ON loop_transaction_buyer_order_issue.trans_id = loop_transaction_buyer.id INNER JOIN loop_warehouse ON loop_warehouse.id = loop_transaction_buyer.warehouse_id ";
                     
                     $dt_view_qry .= "where loop_transaction_buyer.ignore = 0 and order_issue_start_date_time between '" . $date_from_val . "' AND '" . $date_to_val . " 23:59:59' ";
                     
                     $dt_view_qry .= " GROUP BY loop_transaction_buyer.id order by loop_transaction_buyer.id";
                     
                     //echo "<br/>" . $dt_view_qry . "<br/><br/>";
					 db();
                     $data_res = db_query($dt_view_qry);
                     
                     while ($boxes = array_shift($data_res)) {
                     
                     	$query_so = "SELECT trans_rec_id FROM loop_salesorders WHERE trans_rec_id = " .$boxes['I']." and location_warehouse_id=18 group by trans_rec_id";
                     
                     	//echo $query_so;
						db();
                     	$result_so = db_query($query_so);
                     
                     	while ($so_row = array_shift($result_so)) {
                     
                     		//$loc_warehouse_id = $so_row["location_warehouse_id"];
                     
                     		//
                     
                     		$hv_orderissue=$hv_orderissue+1;
                     
                     		
                     
                     		$nickname = get_nickname_val($boxes["warehouse_name"], $boxes["b2bid"]);
                     
                     		
                     
                     		$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany.php?ID=" . $boxes["b2bid"] . "&show=transactions&warehouse_id=" . $boxes["warehouse_id"] . "&rec_type=Supplier&proc=View&searchcrit=&id=". $boxes["warehouse_id"] ."&rec_id=" . $boxes['I'] . "&display=buyer_view'>". $boxes['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     	}
                     
                     
                     
                     }
                     
                     $lisoftrans .= "</table></span>";
                     
                     
                     
                     //$dt_view_row = tep_db_num_rows($data_res);
                     
                     if ($hv_orderissue > 0){
                     
                     	echo "<a href='#' onclick='load_div(1); return false;'>" . number_format($hv_orderissue,0) . "</font></a>";
                     
                     	echo "<span id='1' style='display:none;'><a href='#' onclick='close_div(); return false;'>Close</a>" . $lisoftrans  . "</span>";
                     
                     
                     
                     }else{
                     
                     	echo $hv_orderissue;
                     
                     }					
                     
                     ?>
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  Warehouse Fullness
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
                  <?php	echo Warehouse_Fullness_Cal(18);	?>
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  Pickup Requests (excl. Recycling)
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
                  <?php
                     $lisoftrans = "<span style='width:800px;'><table cellSpacing='1' cellPadding='1' border='0' width='780'>";
                     
                     $lisoftrans .= "<tr><td class='txtstyle_color'>LOOP ID</td><td class='txtstyle_color'>Company Nickname</td></tr>";
                     
                     
                     
                     $pickup_requested_hv=0;
                     
                     	$warehouse_id_list_str  = "15, 79, 32, 185, 111, 738 ,899 ,1191 ,1027 ,747 ,1514 ,1806 ,1472 ,1473 ,1527 ,1503 ,1972, 1491, 2134 ,2343, 2449, 2636, 2609";
                     
                     //
                     
                     	$query = "SELECT loop_warehouse.b2bid , loop_transaction.warehouse_id, loop_warehouse.warehouse_name, loop_transaction.id as I FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE loop_transaction.ignore = 0 and (warehouse_id IN (" . $warehouse_id_list_str . ") or pa_warehouse = 18) and (transaction_date between '" . $date_from_val . "' AND '" . $date_to_val . " 23:59:59') and pr_recycling = 0  ORDER BY loop_transaction.ID ASC";

						db();
                     	$res = db_query($query);
                     
                     	//echo $query;
                     
                     	while($row = array_shift($res))
                     
                     	{
                     
                     		$pickup_requested_hv = $pickup_requested_hv + 1;
                     
                     		
                     
                     		$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                     
                     		
                     
                     		$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany-purchasing.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $row["warehouse_id"] ."&rec_id=" . $row['I'] . "&display=seller_view'>". $row['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     
                     
                     	}
                     
                     	$lisoftrans .= "</table></span>";
                     
                     
                     
                     	if ($pickup_requested_hv > 0){
                     
                     		echo "<a href='#' onclick='load_div(2); return false;'>" . number_format($pickup_requested_hv,0) . "</font></a>";
                     
                     		echo "<span id='2' style='display:none;'><a href='#' onclick='close_div(); return false;'>Close</a>" . $lisoftrans  . "</span>";
                     
                     
                     
                     	}else{
                     
                     		echo $pickup_requested_hv;
                     
                     	}					
                     
                     	
                     
                     ?>
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  Outstanding Unprocessed Trailers
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
                  <?php
                     $lisoftrans = "<span style='width:800px;'><table cellSpacing='1' cellPadding='1' border='0' width='780'>";
                     
                     $lisoftrans .= "<tr><td class='txtstyle_color'>LOOP ID</td><td class='txtstyle_color'>Company Nickname</td></tr>";
                     
                     
                     
                     $query_main = "SELECT id, company_name from loop_warehouse where id not in (238) and rec_type = 'Sorting' order by company_name";
                     
					 db();
                     $resq_main = db_query($query_main);
                     
                     	$show_data = "yes";
                     
                     		$warehouse_id_list_str  = "15, 79, 32, 185, 111, 738 ,899 ,1191 ,1027 ,747 ,1514 ,1806 ,1472 ,1473 ,1527 ,1503 ,1972, 1491, 2134 ,2343, 2449, 2636, 2609"; 
                     
                     		$warehouse_id_list_str2 = "15 ,79 ,32 ,185 ,111 ,738 ,899 ,1191 ,1027 ,747 ,1514 ,1806, 1472 ,1473 ,1527 ,1503 ,1972, 1491, 2134, 2343, 2449, 2636, 2609";
                     
                     		$warehouse_id_list_str3 = "15 ,79 ,32 ,185 ,111 ,738 ,899 ,1191 ,1027 ,747 ,1514 ,1806, 1472 ,1473 ,1527, 1503, 1972, 1491, 2134, 2343, 2449, 2636, 2609";
                     
                     
                     
                     		$hv_total = 0; $hv_total_exl_recy = 0;
                     
                     		$hv_tobe_process = 0;
                     
                     		$query = "SELECT loop_warehouse.b2bid , loop_transaction.warehouse_id, loop_warehouse.warehouse_name, loop_transaction.id as I from loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE warehouse_id IN ( $warehouse_id_list_str) AND bol_employee LIKE '' and pa_warehouse = '' AND pr_recycling = 0 and pr_ucblot = 0 and loop_transaction.ignore = 0";

							db();
                     		$resq = db_query($query);
                     
                     		while($row = array_shift($resq))
                     
                     		{
                     
                     			$hv_tobe_process = $hv_tobe_process + 1;
                     
                     			
                     
                     			$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                     
                     			
                     
                     			$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany-purchasing.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $row["warehouse_id"] ."&rec_id=" . $row['I'] . "&display=seller_view'>". $row['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     		}
                     
                     		
                     
                     		$query = "SELECT loop_warehouse.b2bid , loop_transaction.warehouse_id, loop_warehouse.warehouse_name, loop_transaction.id as I from loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE loop_transaction.pa_warehouse = 18 and loop_transaction.cp_notes = '' AND bol_employee LIKE ''  AND pr_recycling = 0 and pr_ucblot = 0 and loop_transaction.ignore = 0 and loop_transaction.id not in ";
                     
                     		$query .= " (SELECT loop_transaction.id from loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE warehouse_id in ( $warehouse_id_list_str) AND bol_employee LIKE ''  AND pr_recycling = 0 and pr_ucblot = 0 and loop_transaction.ignore = 0)";
							
							db();
                     		$resq = db_query($query);
                     
                     		while($row = array_shift($resq))
                     
                     		{
                     
                     			$hv_tobe_process = $hv_tobe_process + 1;
                     
                     			
                     
                     			$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                     
                     			
                     
                     			$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany-purchasing.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $row["warehouse_id"] ."&rec_id=" . $row['I'] . "&display=seller_view'>". $row['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     		}
                     
                     		$hv_total = $hv_total + $hv_tobe_process;
                     
                     		
                     
                     		$hv_tobe_process_in_lot = 0;
                     
                     		$query = "SELECT loop_warehouse.b2bid , loop_transaction.warehouse_id, loop_warehouse.warehouse_name, loop_transaction.id as I FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE warehouse_id IN ( $warehouse_id_list_str2) AND pr_ucblot = 1 AND bol_employee LIKE '' and loop_transaction.ignore = 0";
							
							db();
                     		$resq = db_query($query);
                     
                     		while($row = array_shift($resq))
                     
                     		{
                     
                     			$hv_tobe_process_in_lot = $hv_tobe_process_in_lot + 1;
                     
                     			
                     
                     			$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                     
                     			
                     
                     			$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany-purchasing.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $row["warehouse_id"] ."&rec_id=" . $row['I'] . "&display=seller_view'>". $row['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     		}
                     
                     		
                     
                     		$query = "SELECT loop_warehouse.b2bid , loop_transaction.warehouse_id, loop_warehouse.warehouse_name, loop_transaction.id as I FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE loop_transaction.pa_warehouse = 18 and loop_transaction.cp_notes = '' AND bol_employee LIKE '' AND pr_ucblot = 1 and loop_transaction.ignore = 0 and loop_transaction.id not in ";
                     
                     		$query .= " (SELECT loop_transaction.id FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE warehouse_id IN ( $warehouse_id_list_str2) AND pr_ucblot = 1 AND bol_employee LIKE '' and loop_transaction.ignore = 0)";
							
							db();
                     		$resq = db_query($query);
                     
                     		while($row = array_shift($resq))
                     
                     		{
                     
                     			$hv_tobe_process_in_lot = $hv_tobe_process_in_lot + 1;
                     
                     			
                     
                     			$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                     
                     			
                     
                     			$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany-purchasing.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $row["warehouse_id"] ."&rec_id=" . $row['I'] . "&display=seller_view'>". $row['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     		}
                     
                     		$hv_total = $hv_total + $hv_tobe_process_in_lot;
                     
                     		
                     
                     		$hv_tobe_process_in_recycling = 0;
                     
                     		$query = "SELECT loop_transaction.id, pr_requestby, pr_requestdate, pr_pickupdate, pr_dock, pr_trailer, pa_employee, bol_filename, company_name, loop_warehouse.id as wid FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE warehouse_id IN ( $warehouse_id_list_str2) AND pr_recycling = 1 AND bol_employee LIKE '' and loop_transaction.ignore = 0";
							
							db();
                     		$resq = db_query($query);
                     
                     		$hv_tobe_process_in_recycling = tep_db_num_rows($resq);
                     
                     		
                     
                     		$query = "SELECT loop_transaction.id AS A FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE loop_transaction.pa_warehouse = 18 and loop_transaction.cp_notes = '' AND bol_employee LIKE '' AND pr_recycling = 1 and loop_transaction.ignore = 0 and loop_transaction.id not in ";
                     
                     		$query .= " (SELECT loop_transaction.id FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE warehouse_id IN ( $warehouse_id_list_str2) AND pr_recycling = 1 AND bol_employee LIKE '' and loop_transaction.ignore = 0)";
							
							db();
                     		$resq = db_query($query);
                     
                     		$hv_tobe_process_in_recycling = $hv_tobe_process_in_recycling + tep_db_num_rows($resq);
                     
                     		$hv_total = $hv_total + $hv_tobe_process_in_recycling;
                     
                     		
                     
                     		$hv_in_process = 0;
                     
                     		$query = "SELECT loop_warehouse.b2bid , loop_transaction.warehouse_id, loop_warehouse.warehouse_name, loop_transaction.id as I FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE (pa_warehouse = 18) and srt_dockdoors_flg =1 AND ucbunloaded_flg=0 and loop_transaction.ignore = 0 ORDER BY loop_transaction.ID ASC";
							
							db();
                     		$resq = db_query($query);
                     
                     		while($row = array_shift($resq))
                     
                     		{
                     
                     			$hv_in_process = $hv_in_process + 1;
                     
                     			
                     
                     			$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                     
                     			
                     
                     			$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany-purchasing.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $row["warehouse_id"] ."&rec_id=" . $row['I'] . "&display=seller_view'>". $row['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     		}
                     
                     		
                     
                     		$query = "SELECT loop_warehouse.b2bid , loop_transaction.warehouse_id, loop_warehouse.warehouse_name, loop_transaction.id as I FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE (pa_warehouse = 18) and pa_pickupdate <> '' AND ucbunloaded_flg=1  AND (sort_entered = 0 or usr_file LIKE '') AND transaction_date > '2010-10-28' and loop_transaction.ignore = 0 ORDER BY loop_transaction.ID ASC";
							
							db();
                     		$resq = db_query($query);
                     
                     		while($row = array_shift($resq))
                     
                     		{
                     
                     			$hv_in_process = $hv_in_process + 1;
                     
                     			
                     
                     			$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                     
                     			
                     
                     			$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany-purchasing.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $row["warehouse_id"] ."&rec_id=" . $row['I'] . "&display=seller_view'>". $row['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     		}
                     
                     		$hv_total = $hv_total + $hv_in_process;
                     
                     		
                     
                     		$hv_total_exl_recy = $hv_total - $hv_tobe_process_in_recycling;
                     
                     		
                     
                     		$lisoftrans .= "</table></span>";
                     
                     		
                     
                     		$str_hv = "";
                     
                     		if ($hv_tobe_process > 0 || $hv_tobe_process_in_lot > 0 || $hv_tobe_process_in_recycling > 0 || $hv_in_process > 0)
                     
                     		{
                     
                     			$show_data = "no";
                     
                     	
                     
                     			echo "<a href='#' onclick='load_div(3); return false;'>" . number_format($hv_total_exl_recy,0) . "</font></a>";
                     
                     			echo "<span id='3' style='display:none;'><a href='#' onclick='close_div(); return false;'>Close</a>" . $lisoftrans  . "</span>";
                     
                     		
                     
                     		}else{
                     
                     	
                     
                     			echo "0";
                     
                     	   }
                     
                     
                     
                     	?>
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  Red Inbound Trailers
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
                  <?php
                     $lisoftrans = "<span style='width:800px;'><table cellSpacing='1' cellPadding='1' border='0' width='780'>";
                     
                     $lisoftrans .= "<tr><td class='txtstyle_color'>LOOP ID</td><td class='txtstyle_color'>Company Nickname</td></tr>";
                     
                     
                     
                     $hv_unproccess_days=0;
                     
                     /*$query = "SELECT *, loop_warehouse.b2bid , loop_transaction.warehouse_id, loop_warehouse.warehouse_name, loop_transaction.id as I 
                     
                     FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id 
                     
                     WHERE (pa_warehouse = 18) and pa_pickupdate <> '' AND ucbunloaded_flg=1  AND (sort_entered = 0 or usr_file LIKE '') 
                     
                     AND transaction_date > '2010-10-28' and loop_transaction.ignore = 0 ORDER BY loop_transaction.ID ASC";*/
                     
                     
                     
                     /*
                     
                     below logic is commented as it is duplicate code, and any changes in HV, HA, etc dash will need to recode here. So stored in Database.
                     
                     $warehouse_id_list_str  = "15, 79, 32, 185, 111, 738 ,899 ,1191 ,1027 ,747 ,1514 ,1806 ,1472 ,1473 ,1527 ,1503 ,1972, 1491, 2134 ,2343, 2449, 2636, 2609"; 
                     
                     $warehouse_id_list_str2 = "15 ,79 ,32 ,185 ,111 ,738 ,899 ,1191 ,1027 ,747 ,1514 ,1806, 1472 ,1473 ,1527 ,1503 ,1972, 1491, 2134, 2343, 2449, 2636, 2609";
                     
                     $warehouse_id_list_str3 = "15 ,79 ,32 ,185 ,111 ,738 ,899 ,1191 ,1027 ,747 ,1514 ,1806, 1472 ,1473 ,1527, 1503, 1972, 1491, 2134, 2343, 2449, 2636, 2609";
                     
                     
                     
                     $query = "SELECT loop_warehouse.b2bid , loop_transaction.id as I, loop_warehouse.warehouse_name, pr_requestby, pr_requestdate, pr_pickupdate, pr_dock, pr_trailer, pa_employee, bol_filename, company_name, loop_warehouse.id as warehouse_id FROM loop_transaction 
                     
                     INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE warehouse_id IN ( $warehouse_id_list_str) 
                     
                     AND bol_employee LIKE '' AND loop_transaction.pa_warehouse ='' AND pr_recycling = 0 and srt_dockdoors_flg=0 and pr_ucblot = 0 and loop_transaction.ignore = 0";
                     
                     $res = db_query($query,db());
                     
                     while($row = array_shift($res))
                     
                     {
                     
                     		$today=strtotime(date("m/d/Y"));
                     
                     		$request_date=strtotime($row["pr_requestdate"]);
                     
                     		$diff=($today - $request_date)/60/60/24;
                     
                     		
                     
                     		if($diff>5)
                     
                     		{
                     
                     			$hv_unproccess_days=$hv_unproccess_days+1;
                     
                     			
                     
                     			$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                     
                     	
                     
                     			$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany-purchasing.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $row["warehouse_id"] ."&rec_id=" . $row['I'] . "&display=seller_sort'>". $row['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     		}	
                     
                     }
                     
                     
                     
                     $query = "SELECT *, loop_warehouse.b2bid , loop_transaction.id as I, loop_warehouse.warehouse_name, loop_warehouse.id as warehouse_id FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id 
                     
                     WHERE loop_transaction.pa_warehouse = 18 and loop_transaction.cp_notes = '' 
                     
                     AND bol_employee LIKE ''  AND pr_recycling = 0 and pr_ucblot = 0 and srt_dockdoors_flg=0 and loop_transaction.ignore = 0 ORDER BY loop_transaction.ID ASC";
                     
                     $res = db_query($query,db());
                     
                     while($row = array_shift($res))
                     
                     {
                     
                     	$hv_unproccess_days=$hv_unproccess_days+1;
                     
                     	
                     
                     	$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                     
                     	
                     
                     	$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany-purchasing.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $row["warehouse_id"] ."&rec_id=" . $row['I'] . "&display=seller_sort'>". $row['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     }
                     
                     
                     
                     //table 2				
                     
                     $query = "SELECT loop_warehouse.b2bid , loop_transaction.id as I, loop_warehouse.warehouse_name, pr_requestby, pr_requestdate, pr_pickupdate, pr_dock, pr_trailer, pa_employee, bol_filename, company_name, loop_warehouse.id as warehouse_id FROM loop_transaction INNER JOIN loop_warehouse 
                     
                     ON loop_transaction.warehouse_id = loop_warehouse.id WHERE warehouse_id IN ( $warehouse_id_list_str2) 
                     
                     AND srt_dockdoors_flg=0 AND pr_ucblot = 1 AND bol_employee LIKE '' and loop_transaction.ignore = 0";
                     
                     $res = db_query($query,db());
                     
                     while($row = array_shift($res))
                     
                     {
                     
                     	$hv_unproccess_days=$hv_unproccess_days+1;
                     
                     	
                     
                     	$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                     
                     	
                     
                     	$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany-purchasing.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $row["warehouse_id"] ."&rec_id=" . $row['I'] . "&display=seller_sort'>". $row['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     }
                     
                     
                     
                     $query = "SELECT *, loop_warehouse.b2bid , loop_transaction.id as I, loop_warehouse.warehouse_name, loop_warehouse.id as warehouse_id FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE loop_transaction.pa_warehouse = 18 
                     
                     and loop_transaction.cp_notes = '' AND srt_dockdoors_flg=0 AND bol_employee LIKE '' AND pr_ucblot = 1 and loop_transaction.ignore = 0 ORDER BY loop_transaction.ID ASC";
                     
                     $res = db_query($query,db());
                     
                     while($row = array_shift($res))
                     
                     {
                     
                     	$hv_unproccess_days=$hv_unproccess_days+1;
                     
                     	
                     
                     	$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                     
                     	
                     
                     	$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany-purchasing.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $row["warehouse_id"] ."&rec_id=" . $row['I'] . "&display=seller_sort'>". $row['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     }
                     
                     
                     
                     //table 3
                     
                     $query = "SELECT loop_warehouse.b2bid , loop_transaction.id as I, loop_warehouse.warehouse_name, pr_requestby, pr_requestdate, pr_pickupdate, pr_dock, pr_trailer, pa_employee, bol_filename, company_name, loop_warehouse.id as warehouse_id FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE warehouse_id IN ( $warehouse_id_list_str2) 
                     
                     AND pr_recycling = 1 AND bol_employee LIKE '' AND ucbunloaded_flg=0 and loop_transaction.ignore = 0";
                     
                     $res = db_query($query,db());
                     
                     while($row = array_shift($res))
                     
                     {
                     
                     	$hv_unproccess_days=$hv_unproccess_days+1;
                     
                     	
                     
                     	$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                     
                     	
                     
                     	$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany-purchasing.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $row["warehouse_id"] ."&rec_id=" . $row['I'] . "&display=seller_sort'>". $row['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     }
                     
                     
                     
                     $query = "SELECT loop_warehouse.b2bid , loop_transaction.id as I, loop_warehouse.warehouse_name, loop_warehouse.id as warehouse_id FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE loop_transaction.pa_warehouse = 18 and loop_transaction.cp_notes = '' AND bol_employee LIKE '' AND pr_recycling = 1 and loop_transaction.ignore = 0 AND ucbunloaded_flg=0 ORDER BY loop_transaction.ID ASC";
                     
                     $res = db_query($query,db());
                     
                     while($row = array_shift($res))
                     
                     {
                     
                     	$hv_unproccess_days=$hv_unproccess_days+1;
                     
                     	
                     
                     	$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                     
                     	
                     
                     	$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany-purchasing.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $row["warehouse_id"] ."&rec_id=" . $row['I'] . "&display=seller_sort'>". $row['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     }
                     
                     
                     
                     //table 4
                     
                     $query = "SELECT loop_warehouse.b2bid , loop_transaction.id as I, loop_warehouse.warehouse_name, loop_warehouse.id as warehouse_id FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE (pa_warehouse = 18) and srt_dockdoors_flg =1 AND ucbunloaded_flg=0 and loop_transaction.ignore = 0 ORDER BY loop_transaction.ID ASC";
                     
                     $res = db_query($query,db());
                     
                     while($row = array_shift($res))
                     
                     {
                     
                     	$hv_unproccess_days=$hv_unproccess_days+1;
                     
                     	
                     
                     	$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                     
                     	
                     
                     	$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany-purchasing.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $row["warehouse_id"] ."&rec_id=" . $row['I'] . "&display=seller_sort'>". $row['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     }
                     
                     
                     
                     //table 5
                     
                     $query = "SELECT loop_warehouse.b2bid , loop_transaction.id as I, loop_warehouse.warehouse_name, loop_warehouse.id as warehouse_id FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE (pa_warehouse = 18) and pa_pickupdate <> '' AND ucbunloaded_flg=1  AND (sort_entered = 0 or usr_file LIKE '') AND transaction_date > '2010-10-28' and loop_transaction.ignore = 0 ORDER BY loop_transaction.ID ASC";
                     
                     $res = db_query($query,db());
                     
                     while($row = array_shift($res))
                     
                     {
                     
                     	$hv_unproccess_days=$hv_unproccess_days+1;
                     
                     	
                     
                     	$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                     
                     	
                     
                     	$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany-purchasing.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $row["warehouse_id"] ."&rec_id=" . $row['I'] . "&display=seller_sort'>". $row['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     }
                     
                     
                     
                     $lisoftrans .= "</table></span>";
                     
                     */
                     
                     
                     
                     $query = "SELECT variablevalue from tblvariable where variablename = 'HV_red_row_cnt'";
					 
					 db();
                     $res = db_query($query);
                     
                     while($row = array_shift($res))
                     
                     {
                     
                     	$hv_unproccess_days = $row["variablevalue"];
                     
                     }
                     
                     
                     
                     $HV_red_row_loop_ids = "";
                     
                     $query = "SELECT variablevalue from tblvariable where variablename = 'HV_red_row_loop_ids'";
					 
					 db();
                     $res = db_query($query);
                     
                     while($row = array_shift($res))
                     
                     {
                     
                     	$HV_red_row_loop_ids = $row["variablevalue"];
                     
                     }
                     
                     
                     
                     $query = "SELECT loop_warehouse.b2bid , loop_transaction.id as I, loop_warehouse.warehouse_name, loop_warehouse.id as warehouse_id FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE loop_transaction.id in (" . $HV_red_row_loop_ids . ")";
					 
					 db();
                     $res = db_query($query);
                     
                     while($row = array_shift($res))
                     
                     {
                     
                     	$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                     
                     	
                     
                     	$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany-purchasing.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $row["warehouse_id"] ."&rec_id=" . $row['I'] . "&display=seller_sort'>". $row['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     }
                     
                     
                     
                     $lisoftrans .= "</table></span>";
                     
                     
                     
                     if($hv_unproccess_days>0)
                     
                     {
                     
                     	echo "<a href='#' onclick='load_div(4); return false;'><span style='color:#FF0000'>" . number_format($hv_unproccess_days,0) . "</span></font></a>";
                     
                     	echo "<span id='4' style='display:none;'><a href='#' onclick='close_div(); return false;'>Close</a>" . $lisoftrans  . "</span>";
                     
                     }
                     
                     else{
                     
                     	echo "<span style='color:#000000'>" . $hv_unproccess_days. "</span>";
                     
                     }
                     
                     
                     
                     ?>
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  Money Lost on Red Leaderboard Names
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
                  <?php
                     if($money_lost_array[0]<0)
                     
                     {
                     
                     	echo "<span style='color:#FF0000'>";
                     
                     }
                     
                     else{
                     
                     	echo "<span style='color:#000000'>";
                     
                     }
                     
                     	echo "$".$money_lost_array[0]."</span>";
                     
                     ?>
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  Average Production per Hour (Labor Only)
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
                  <?php echo "$".number_format($prod_hrs_array[0],2);
                     ?>
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  Average Production per Hour (All Employees)
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
                  $<?php echo number_format($total_prod_per_hrs_entire[0],2)?>
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  # of Loop Boxes Sorted
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
                  <?php
                     
                     //, loop_transaction.id as rec_id, loop_transaction.warehouse_id as rec_warehouse_id , box_id, sort_date, sum(boxgood) as boxgood 
                     
                     $sort_qry="SELECT sum(boxgood) as boxgood FROM loop_boxes_sort inner join loop_transaction on loop_transaction.id = loop_boxes_sort.trans_rec_id inner join loop_boxes on loop_boxes.id = loop_boxes_sort.box_id where loop_transaction.ignore = 0 and (DATE_FORMAT(STR_TO_DATE(sort_date, '%m/%d/%Y'), '%Y-%m-%d') BETWEEN '" . $date_from_val . "' and '" . $date_to_val . "') and loop_boxes.type in ('Loop', 'LoopShipping') and loop_boxes_sort.warehouse_id=18 group by box_id";
                     
                     //echo $sort_qry;
                     db();
                     $sort_qry_res=db_query($sort_qry);
                     
                     while($sort_row = array_shift($sort_qry_res))
                     
                     {
                     
                     	$boxid=$sort_row["box_id"];
                     
                     	$hv_total_qty= $hv_total_qty + $sort_row["boxgood"];
                     
                     }
                     
                     echo number_format($hv_total_qty, 0);
                     
                     ?>
               </td>
            </tr>
         </table>
         <!------------------End Table for HV warehouse------------------->
         <br>
         <!------------------Table for HA warehouse------------------->
         <table cellSpacing="1" cellPadding="1" border="0" class="datatable">
            <tr>
               <td colspan="2" class="style17" align="center">
                  <strong>UCB-HA Warehouse</strong>
               </td>
            </tr>
            <tr>
               <td style="width: 200" class="style17" align="center">
                  <b>Measurables</b>
               </td>
               <td style="width: 190" class="style17" align="center">
                  <b>Number</b>
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  Order Issues
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
                  <?php
                     $lisoftrans = "<span style='width:800px;'><table cellSpacing='1' cellPadding='1' border='0' width='780'>";
                     
                     $lisoftrans .= "<tr><td class='txtstyle_color'>LOOP ID</td><td class='txtstyle_color'>Company Nickname</td></tr>";
                     
                     
                     
                     $ha_orderissue= 0;
                     
                     $dt_view_qry = "SELECT loop_warehouse.b2bid , loop_transaction_buyer.warehouse_id, loop_warehouse.warehouse_name, loop_transaction_buyer_order_issue.trans_id as I FROM loop_transaction_buyer_order_issue ";
                     
                     $dt_view_qry .= " INNER JOIN loop_transaction_buyer ON loop_transaction_buyer_order_issue.trans_id = loop_transaction_buyer.id INNER JOIN loop_warehouse ON loop_warehouse.id = loop_transaction_buyer.warehouse_id ";
                     
                     $dt_view_qry .= "where loop_transaction_buyer.ignore = 0 and order_issue_start_date_time between '" . $date_from_val . "' AND '" . $date_to_val . " 23:59:59' ";
                     
                     $dt_view_qry .= " GROUP BY loop_transaction_buyer.id order by loop_transaction_buyer.id";
                     
                     //echo "<br/>" . $dt_view_qry . "<br/><br/>";
                     db();
                     $data_res = db_query($dt_view_qry,);
                     
                     while ($boxes = array_shift($data_res)) {
                     
                     	$query_so = "SELECT trans_rec_id FROM loop_salesorders WHERE trans_rec_id = " .$boxes['I']." and location_warehouse_id=556 group by trans_rec_id";
                     
                     	//echo $query_so;
						db();
                     	$result_so = db_query($query_so);
                     
                     	while ($so_row = array_shift($result_so)) {
                     
                     		//$loc_warehouse_id = $so_row["location_warehouse_id"];
                     
                     		//
                     
                     		$ha_orderissue=$ha_orderissue+1;
                     
                     		
                     
                     		$nickname = get_nickname_val($boxes["warehouse_name"], $boxes["b2bid"]);
                     
                     		
                     
                     		$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany.php?ID=" . $boxes["b2bid"] . "&show=transactions&warehouse_id=" . $boxes["warehouse_id"] . "&rec_type=Supplier&proc=View&searchcrit=&id=". $boxes["warehouse_id"] ."&rec_id=" . $boxes['I'] . "&display=buyer_view'>". $boxes['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     	}
                     
                     
                     
                     }
                     
                     $lisoftrans .= "</table></span>";
                     
                     
                     
                     //$dt_view_row = tep_db_num_rows($data_res);
                     
                     if ($ha_orderissue > 0){
                     
                     	echo "<a href='#' onclick='load_div(5); return false;'>" . number_format($ha_orderissue,0) . "</font></a>";
                     
                     	echo "<span id='5' style='display:none;'><a href='#' onclick='close_div(); return false;'>Close</a>" . $lisoftrans  . "</span>";
                     
                     
                     
                     }else{
                     
                     	echo $ha_orderissue;
                     
                     }					
                     
                     ?>			
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  Warehouse Fullness
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
                  <?php	echo Warehouse_Fullness_Cal(556);	?>
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  Pickup Requests (excl. Recycling)
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
                  <?php
                     $lisoftrans = "<span style='width:800px;'><table cellSpacing='1' cellPadding='1' border='0' width='780'>";
                     
                     $lisoftrans .= "<tr><td class='txtstyle_color'>LOOP ID</td><td class='txtstyle_color'>Company Nickname</td></tr>";
                     
                     
                     
                     $pickup_requested_ha=0;
                     
                     	$IN_LIST = "504, 1076, 1073, 532, 1074, 694, 1089, 1517, 1535, 1539, 1543, 1264, 1655, 1659, 2128, 2165, 2201, 2288, 2289, 2444, 2491, 2494, 2502, 3289"; //trailers in TO BE PROCESSED table
                     
                     //
                     
                     	$query = "SELECT loop_warehouse.b2bid , loop_transaction.warehouse_id, loop_warehouse.warehouse_name, loop_transaction.id as I FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE loop_transaction.ignore = 0 and (warehouse_id IN ( " . $IN_LIST . " ) or pa_warehouse = 556)  and pr_recycling = 0  and (transaction_date between '" . $date_from_val . "' AND '" . $date_to_val . " 23:59:59') ORDER BY loop_transaction.ID ASC";

						db();
                     	$res = db_query($query);
                     
                     	//echo $query;
                     
                     	while($row = array_shift($res))
                     
                     	{
                     
                     		$pickup_requested_ha = $pickup_requested_ha + 1;
                     
                     		
                     
                     		$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                     
                     		
                     
                     		$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany-purchasing.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $row["warehouse_id"] ."&rec_id=" . $row['I'] . "&display=seller_view'>". $row['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     
                     
                     	}
                     
                     	$lisoftrans .= "</table></span>";
                     
                     
                     
                     	if ($pickup_requested_ha > 0){
                     
                     		echo "<a href='#' onclick='load_div(6); return false;'>" . number_format($pickup_requested_ha,0) . "</font></a>";
                     
                     		echo "<span id='6' style='display:none;'><a href='#' onclick='close_div(); return false;'>Close</a>" . $lisoftrans  . "</span>";
                     
                     
                     
                     	}else{
                     
                     		echo $pickup_requested_ha;
                     
                     	}					
                     
                     	
                     
                     ?>				
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  Outstanding Unprocessed Trailers
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
                  <?php
                     //HA					 
                     
                     $lisoftrans = "<span style='width:800px;'><table cellSpacing='1' cellPadding='1' border='0' width='780'>";
                     
                     $lisoftrans .= "<tr><td class='txtstyle_color'>LOOP ID</td><td class='txtstyle_color'>Company Nickname</td></tr>";
                     
                     
                     
                     	$ha_total = 0; $ha_total_exl_recy = 0;
                     
                     	$IN_LIST = "504, 1076, 1073, 532, 1074, 694, 1089, 1517, 1535, 1539, 1543, 1264, 1655, 1659, 2128, 2165, 2201, 2288, 2289, 2444, 2491, 2494, 2502, 3289";
                     
                     	$ha_tobe_process = 0;
                     
                     	$query = "SELECT loop_warehouse.b2bid , loop_transaction.warehouse_id, loop_warehouse.warehouse_name, loop_transaction.id as I from loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE loop_transaction.ignore = 0 and warehouse_id IN ( " . $IN_LIST . " ) and pa_warehouse = '' AND pr_recycling = 0 and pr_ucblot = 0 AND bol_employee LIKE '' ORDER BY loop_transaction.ID ASC";
						
						db();
                     	$resq = db_query($query);
                     
                     	while($row = array_shift($resq))
                     
                     	{
                     
                     		$ha_tobe_process = $ha_tobe_process + 1;
                     
                     		
                     
                     		$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                     
                     		
                     
                     		$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany-purchasing.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $row["warehouse_id"] ."&rec_id=" . $row['I'] . "&display=seller_view'>". $row['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     	}
                     
                     	$ha_total = $ha_total + $ha_tobe_process;
                     
                     	
                     
                     	$ha_tobe_process_in_lot = 0;
                     
                     	$query = "SELECT loop_warehouse.b2bid , loop_transaction.warehouse_id, loop_warehouse.warehouse_name, loop_transaction.id as I FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE loop_transaction.ignore = 0 and warehouse_id IN ( " . $IN_LIST . " ) and pa_warehouse = 556 and loop_transaction.cp_notes = '' AND pr_ucblot = 1 AND srt_dockdoors_flg=0 AND bol_employee LIKE '' ORDER BY loop_transaction.ID ASC";
						
						db();
                     	$resq = db_query($query);
                     
                     	while($row = array_shift($resq))
                     
                     	{
                     
                     		$ha_tobe_process_in_lot = $ha_tobe_process_in_lot + 1;
                     
                     		
                     
                     		$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                     
                     		
                     
                     		$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany-purchasing.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $row["warehouse_id"] ."&rec_id=" . $row['I'] . "&display=seller_view'>". $row['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     	}
                     
                     	$ha_total = $ha_total + $ha_tobe_process_in_lot;
                     
                     	
                     
                     	$ha_tobe_process_in_recycling = 0;
                     
                     	$query = "SELECT loop_transaction.id FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE loop_transaction.ignore = 0 and warehouse_id IN ( " . $IN_LIST . " )  and pa_warehouse = 556 and loop_transaction.cp_notes = ''  AND pr_recycling = 1 AND ucbunloaded_flg=0 AND bol_employee LIKE '' ORDER BY loop_transaction.ID ASC";
						
						db();
                     	$resq = db_query($query);
                     
                     	$ha_tobe_process_in_recycling = tep_db_num_rows($resq);
                     
                     	$ha_total = $ha_total + $ha_tobe_process_in_recycling;
                     
                     	
                     
                     	$ha_in_process = 0;
                     
                     	$query = "SELECT loop_warehouse.b2bid , loop_transaction.warehouse_id, loop_warehouse.warehouse_name, loop_transaction.id as I FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE (pa_warehouse = 556) and srt_dockdoors_flg =1 AND ucbunloaded_flg=0 and loop_transaction.ignore = 0 ORDER BY loop_transaction.ID ASC";
						
						db();
                     	$resq = db_query($query);
                     
                     	while($row = array_shift($resq))
                     
                     	{
                     
                     		$ha_in_process = $ha_in_process + 1;
                     
                     		
                     
                     		$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                     
                     		
                     
                     		$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany-purchasing.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $row["warehouse_id"] ."&rec_id=" . $row['I'] . "&display=seller_view'>". $row['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     	}
                     
                     
                     
                     	$query = "SELECT loop_warehouse.b2bid , loop_transaction.warehouse_id, loop_warehouse.warehouse_name, loop_transaction.id as I from loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE loop_transaction.ignore = 0 and (pa_warehouse = 556) and pa_pickupdate <> '' and cp_date <> '' AND ucbunloaded_flg=1 AND (sort_entered = 0 or usr_file LIKE '') AND transaction_date > '2010-10-28' ORDER BY loop_transaction.ID ASC";
						
						db();
                     	$resq = db_query($query);
                     
                     	while($row = array_shift($resq))
                     
                     	{
                     
                     		$ha_in_process = $ha_in_process + 1;
                     
                     		
                     
                     		$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                     
                     		
                     
                     		$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany-purchasing.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $row["warehouse_id"] ."&rec_id=" . $row['I'] . "&display=seller_view'>". $row['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     	}
                     
                     	$ha_total = $ha_total + $ha_in_process;
                     
                     	
                     
                     	$ha_total_exl_recy = $ha_total - $ha_tobe_process_in_recycling;	
                     
                     			
                     
                     	$lisoftrans .= "</table></span>";
                     
                     	
                     
                     	$str_ha = "";
                     
                     	if ($ha_tobe_process > 0 || $ha_tobe_process_in_lot > 0 || $ha_tobe_process_in_recycling > 0 || $ha_in_process > 0)
                     
                     	{
                     
                     		
                     
                     		$show_data = "no";
                     
                     		
                     
                     		echo "<a href='#' onclick='load_div(7); return false;'>" . number_format($ha_total_exl_recy,0) . "</font></a>";
                     
                     		echo "<span id='7' style='display:none;'><a href='#' onclick='close_div(); return false;'>Close</a>" . $lisoftrans  . "</span>";
                     
                     	?>
                  <?php }else{
                     echo "0";
                     
                      }											
                     
                     
                     
                     ?>
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  Red Inbound Trailers
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
                  <?php
                     $lisoftrans = "<span style='width:800px;'><table cellSpacing='1' cellPadding='1' border='0' width='780'>";
                     
                     $lisoftrans .= "<tr><td class='txtstyle_color'>LOOP ID</td><td class='txtstyle_color'>Company Nickname</td></tr>";
                     
                     
                     
                     $ha_unproccess_days=0;
                     
                     //$query = "SELECT *, loop_warehouse.b2bid , loop_transaction.warehouse_id, loop_warehouse.warehouse_name, loop_transaction.id as I FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE (pa_warehouse = 556) and pa_pickupdate <> '' AND ucbunloaded_flg=1  AND (sort_entered = 0 or usr_file LIKE '') AND transaction_date > '2010-10-28' and loop_transaction.ignore = 0 ORDER BY loop_transaction.ID ASC";
                     
                     
                     
                     /*$query = "SELECT *, loop_warehouse.b2bid , loop_transaction.warehouse_id, loop_warehouse.warehouse_name, loop_transaction.id as I 
                     
                     FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id 
                     
                     WHERE (pa_warehouse = 556) and (pr_ucblot_dt <> '' or srt_ucbdockdoor_dt <> '' or ucbunloaded_dt <> '')
                     
                     AND (sort_entered = 0) AND transaction_date > '2010-10-28' and loop_transaction.ignore = 0 ORDER BY loop_transaction.ID ASC";
                     
                     $res = db_query($query,db());
                     
                     while($row = array_shift($res))
                     
                     {
                     
                     	//echo "pr_ucblot_dt - " . $row["pr_ucblot_dt"] . " - " . $row["srt_ucbdockdoor_dt"] . " - " . $row["ucbunloaded_dt"];
                     
                     	
                     
                     	$bs_days1 = 0; $bs_days2 = 0; $bs_days3 = 0;		
                     
                     	$today=strtotime(date("m/d/Y"));
                     
                     	if ($row["pr_ucblot_dt"] != "" && $row["pr_ucblot_dt"] != "0000-00-00 00:00:00"){
                     
                     		$confirm_date=strtotime($row["pr_ucblot_dt"]);
                     
                     		while ($confirm_date <= $today) {
                     
                     			if (date('N', $confirm_date) <= 5) {
                     
                     			 $bs_days1++;    
                     
                     			}
                     
                     			$confirm_date += 86400;
                     
                     		}
                     
                     	}	
                     
                     	
                     
                     	if ($row["srt_ucbdockdoor_dt"] != "" && $row["srt_ucbdockdoor_dt"] != "0000-00-00 00:00:00"){
                     
                     		$confirm_date=strtotime($row["srt_ucbdockdoor_dt"]);
                     
                     		while ($confirm_date <= $today) {
                     
                     			if (date('N', $confirm_date) <= 5) {
                     
                     			 $bs_days2++;    
                     
                     			}
                     
                     			$confirm_date += 86400;
                     
                     		}
                     
                     	}	
                     
                     	
                     
                     	if ($row["ucbunloaded_dt"] != "" && $row["ucbunloaded_dt"] != "0000-00-00 00:00:00"){
                     
                     		$confirm_date=strtotime($row["ucbunloaded_dt"]);
                     
                     		while ($confirm_date <= $today) {
                     
                     			if (date('N', $confirm_date) <= 5) {
                     
                     			 $bs_days3++;    
                     
                     			}
                     
                     			$confirm_date += 86400;
                     
                     		}
                     
                     	}
                     
                     	
                     
                     	if($bs_days1>3 || $bs_days2>3 || $bs_days3>3)					
                     
                     	{
                     
                     		$ha_unproccess_days=$ha_unproccess_days+1;
                     
                     		
                     
                     		$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                     
                     		
                     
                     		$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany-purchasing.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $row["warehouse_id"] ."&rec_id=" . $row['I'] . "&display=seller_sort'>". $row['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     		
                     
                     	}	
                     
                     }*/
                     
                     
                     
                     $query = "SELECT variablevalue from tblvariable where variablename = 'HA_red_row_cnt'";
					 
					 db();
                     $res = db_query($query);
                     
                     while($row = array_shift($res))
                     
                     {
                     
                     	$ha_unproccess_days = $row["variablevalue"];
                     
                     }
                     
                     
                     
                     $HA_red_row_loop_ids = "";
                     
                     $query = "SELECT variablevalue from tblvariable where variablename = 'HA_red_row_loop_ids'";
					 
					 db();
                     $res = db_query($query);
                     
                     while($row = array_shift($res))
                     
                     {
                     
                     	$HA_red_row_loop_ids = $row["variablevalue"];
                     
                     }
                     
                     
                     
                     $query = "SELECT loop_warehouse.b2bid , loop_transaction.id as I, loop_warehouse.warehouse_name, loop_warehouse.id as warehouse_id FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE loop_transaction.id in (" . $HA_red_row_loop_ids . ")";
					 
					 db();
                     $res = db_query($query);
                     
                     while($row = array_shift($res))
                     
                     {
                     
                     	$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                     
                     	
                     
                     	$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany-purchasing.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $row["warehouse_id"] ."&rec_id=" . $row['I'] . "&display=seller_sort'>". $row['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     }
                     
                     $lisoftrans .= "</table></span>";
                     
                     
                     
                     if($ha_unproccess_days>0)
                     
                     {
                     
                     	echo "<a href='#' onclick='load_div(8); return false;'><span style='color:#FF0000'>" . number_format($ha_unproccess_days,0) . "</span></font></a>";
                     
                     	echo "<span id='8' style='display:none;'><a href='#' onclick='close_div(); return false;'>Close</a>" . $lisoftrans  . "</span>";
                     
                     }
                     
                     else{
                     
                     	echo "<span style='color:#000000'>" . $ha_unproccess_days. "</span>";
                     
                     }
                     
                     
                     
                     ?>				
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  Money Lost on Red Leaderboard Names
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
                  <?php
                     if($money_lost_array[1]<0)
                     
                     {
                     
                     	echo "<span style='color:#FF0000'>";
                     
                     }
                     
                     else{
                     
                     	echo "<span style='color:#000000'>";
                     
                     }
                     
                     echo "$".$money_lost_array[1]."</span>";
                     
                     ?>
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  Average Production per Hour (Labor Only)
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
                  <?php echo "$".number_format($prod_hrs_array[1],2);
                     ?>
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  Average Production per Hour (All Employees)
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
                  $<?php echo number_format($total_prod_per_hrs_entire[1],2)?>
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  # of Loop Boxes Sorted
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center"><span class="style3" style="width: 190">
                  <?php
                     //$sort_qry="SELECT loop_boxes_sort.warehouse_id, loop_transaction.id as rec_id, loop_transaction.warehouse_id as rec_warehouse_id , box_id, sort_date, sum(boxgood) as boxgood FROM loop_boxes_sort inner join loop_transaction on loop_transaction.id = loop_boxes_sort.trans_rec_id inner join loop_boxes on loop_boxes.id = loop_boxes_sort.box_id where loop_transaction.ignore = 0 and (DATE_FORMAT(STR_TO_DATE(sort_date, '%m/%d/%Y'), '%Y-%m-%d') BETWEEN '" . $date_from_val . "' and '" . $date_to_val . "') and loop_boxes.type in ('LoopShipping', 'Box', 'Boxnonucb', 'Presold', 'Medium', 'Large', 'Xlarge') and loop_boxes_sort.warehouse_id=556 group by loop_transaction.id order by loop_boxes_sort.id";
                     
                     $sort_qry="SELECT sum(boxgood) as boxgood FROM loop_boxes_sort inner join loop_transaction on loop_transaction.id = loop_boxes_sort.trans_rec_id inner join loop_boxes on loop_boxes.id = loop_boxes_sort.box_id where loop_transaction.ignore = 0 and (DATE_FORMAT(STR_TO_DATE(sort_date, '%m/%d/%Y'), '%Y-%m-%d') BETWEEN '" . $date_from_val . "' and '" . $date_to_val . "') and loop_boxes.type in ('Loop', 'LoopShipping') and loop_boxes_sort.warehouse_id=556 group by box_id";
                     
                     //echo $sort_qry;
					 db();
                     $sort_qry_res=db_query($sort_qry);
                     
                     while($sort_row = array_shift($sort_qry_res))
                     
                     {
                     
                     	$ha_total_qty = $ha_total_qty + $sort_row["boxgood"];
                     
                     }
                     
                     echo number_format($ha_total_qty, 0);
                     
                     ?>
                  </span>
               </td>
            </tr>
         </table>
         <!------------------End Table for HA warehouse------------------->
         <br>
         <!------------------Table for ML warehouse------------------->
         <table cellSpacing="1" cellPadding="1" border="0" class="datatable">
            <tr>
               <td colspan="2" class="style17" align="center">
                  <strong>UCB-ML Warehouse</strong>
               </td>
            </tr>
            <tr>
               <td style="width: 200" class="style17" align="center">
                  <b>Measurables</b>
               </td>
               <td style="width: 190" class="style17" align="center">
                  <b>Number</b>
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  Order Issues
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
                  <?php
                     $lisoftrans = "<span style='width:800px;'><table cellSpacing='1' cellPadding='1' border='0' width='780'>";
                     
                     $lisoftrans .= "<tr><td class='txtstyle_color'>LOOP ID</td><td class='txtstyle_color'>Company Nickname</td></tr>";
                     
                     
                     
                     $ml_orderissue= 0;
                     
                     $dt_view_qry = "SELECT loop_warehouse.b2bid , loop_transaction_buyer.warehouse_id, loop_warehouse.warehouse_name, loop_transaction_buyer_order_issue.trans_id as I FROM loop_transaction_buyer_order_issue ";
                     
                     $dt_view_qry .= " INNER JOIN loop_transaction_buyer ON loop_transaction_buyer_order_issue.trans_id = loop_transaction_buyer.id INNER JOIN loop_warehouse ON loop_warehouse.id = loop_transaction_buyer.warehouse_id ";
                     
                     $dt_view_qry .= "where loop_transaction_buyer.ignore = 0 and order_issue_start_date_time between '" . $date_from_val . "' AND '" . $date_to_val . " 23:59:59' ";
                     
                     $dt_view_qry .= " GROUP BY loop_transaction_buyer.id order by loop_transaction_buyer.id";
                     
                     //echo "<br/>" . $dt_view_qry . "<br/><br/>";
                     db();
                     $data_res = db_query($dt_view_qry);
                     
                     while ($boxes = array_shift($data_res)) {
                     
                     	$query_so = "SELECT trans_rec_id FROM loop_salesorders WHERE trans_rec_id = " .$boxes['I']." and location_warehouse_id=2563 group by trans_rec_id";
                     
                     	//echo $query_so;
						db();
                     	$result_so = db_query($query_so);
                     
                     	while ($so_row = array_shift($result_so)) {
                     
                     		//$loc_warehouse_id = $so_row["location_warehouse_id"];
                     
                     		//
                     
                     		$ml_orderissue=$ml_orderissue+1;
                     
                     		
                     
                     		$nickname = get_nickname_val($boxes["warehouse_name"], $boxes["b2bid"]);
                     
                     		
                     
                     		$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany.php?ID=" . $boxes["b2bid"] . "&show=transactions&warehouse_id=" . $boxes["warehouse_id"] . "&rec_type=Supplier&proc=View&searchcrit=&id=". $boxes["warehouse_id"] ."&rec_id=" . $boxes['I'] . "&display=buyer_view'>". $boxes['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     	}
                     
                     
                     
                     }
                     
                     $lisoftrans .= "</table></span>";
                     
                     
                     
                     //$dt_view_row = tep_db_num_rows($data_res);
                     
                     if ($ml_orderissue > 0){
                     
                     	echo "<a href='#' onclick='load_div(9); return false;'>" . number_format($ml_orderissue,0) . "</font></a>";
                     
                     	echo "<span id='9' style='display:none;'><a href='#' onclick='close_div(); return false;'>Close</a>" . $lisoftrans  . "</span>";
                     
                     
                     
                     }else{
                     
                     	echo $ml_orderissue;
                     
                     }					
                     
                     ?>			
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  Warehouse Fullness
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
                  <?php	echo Warehouse_Fullness_Cal(2563);	?>
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  Pickup Requests (excl. Recycling)
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center"><span class="style3" style="width: 190">
                  <?php
                     $lisoftrans = "<span style='width:800px;'><table cellSpacing='1' cellPadding='1' border='0' width='780'>";
                     
                     $lisoftrans .= "<tr><td class='txtstyle_color'>LOOP ID</td><td class='txtstyle_color'>Company Nickname</td></tr>";
                     
                     
                     
                     $pickup_requested_ml=0;
                     
                     	$warehouse_id_list_str = "616, 718, 1089, 2596, 694, 1073, 3270, 3351, 3144";//trailers in TO BE PROCESSED table
                     
                     //
                     
                     	$query = "SELECT loop_warehouse.b2bid , loop_transaction.warehouse_id, loop_warehouse.warehouse_name, loop_transaction.id as I FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE loop_transaction.ignore = 0 and (warehouse_id IN ( " . $warehouse_id_list_str . " ) or pa_warehouse = 2563)  AND pr_recycling = 0  and (transaction_date between '" . $date_from_val . "' AND '" . $date_to_val . " 23:59:59') ORDER BY loop_transaction.ID ASC";
					 	
						db();
                     	$res = db_query($query);
                     
                     	//echo $query;
                     
                     	while($row = array_shift($res))
                     
                     	{
                     
                     		$pickup_requested_ml = $pickup_requested_ml + 1;
                     
                     		
                     
                     		$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                     
                     		
                     
                     		$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany-purchasing.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $row["warehouse_id"] ."&rec_id=" . $row['I'] . "&display=seller_view'>". $row['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     
                     
                     	}
                     
                     	$lisoftrans .= "</table></span>";
                     
                     
                     
                     	if ($pickup_requested_ml > 0){
                     
                     		echo "<a href='#' onclick='load_div(10); return false;'>" . number_format($pickup_requested_ml,0) . "</font></a>";
                     
                     		echo "<span id='10' style='display:none;'><a href='#' onclick='close_div(); return false;'>Close</a>" . $lisoftrans  . "</span>";
                     
                     
                     
                     	}else{
                     
                     		echo $pickup_requested_ml;
                     
                     	}					
                     
                     	
                     
                     ?>								
                  </span>
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  Outstanding Unprocessed Trailers
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
                  <?php			
                     $lisoftrans = "<span style='width:800px;'><table cellSpacing='1' cellPadding='1' border='0' width='780'>";
                     
                     $lisoftrans .= "<tr><td class='txtstyle_color'>LOOP ID</td><td class='txtstyle_color'>Company Nickname</td></tr>";
                     
                     
                     
                     //ML
                     
                     $warehouse_id_list_str = "616, 718, 1089, 2596, 694, 1073, 3270, 3351, 3144";
                     
                     
                     
                     $ml_total = 0; $ml_total_exl_recy = 0;
                     
                     $ml_tobe_process = 0;
                     
                     $query = "SELECT loop_warehouse.b2bid , loop_transaction.warehouse_id, loop_warehouse.warehouse_name, loop_transaction.id as I FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE warehouse_id IN ( $warehouse_id_list_str) and pa_warehouse = '' AND bol_employee LIKE '' AND pr_recycling = 0 and pr_ucblot = 0 and srt_dockdoors_flg=0 and loop_transaction.ignore = 0";
                     
					 db();
                     $resq = db_query($query);
                     
                     while($row = array_shift($resq))
                     
                     {
                     
                     	$ml_tobe_process = $ml_tobe_process + 1;
                     
                     	
                     
                     	$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                     
                     	
                     
                     	$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany-purchasing.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $row["warehouse_id"] ."&rec_id=" . $row['I'] . "&display=seller_view'>". $row['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     }
                     
                     
                     
                     $query = "SELECT loop_warehouse.b2bid , loop_transaction.warehouse_id, loop_warehouse.warehouse_name, loop_transaction.id as I FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE loop_transaction.pa_warehouse = 2563 and loop_transaction.cp_notes = '' AND bol_employee LIKE ''  AND pr_recycling = 0 AND pr_ucblot = 0 and loop_transaction.ignore = 0 and loop_transaction.id not in ";
                     
                     $query .= " (SELECT loop_transaction.id FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE warehouse_id IN ( $warehouse_id_list_str) AND bol_employee LIKE '' AND pr_recycling = 0 and pr_ucblot = 0 and loop_transaction.ignore = 0)";
                     
					 db();
                     $resq = db_query($query);
                     
                     while($row = array_shift($resq))
                     
                     {
                     
                     	$ml_tobe_process = $ml_tobe_process + 1;
                     
                     	
                     
                     	$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                     
                     	
                     
                     	$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany-purchasing.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $row["warehouse_id"] ."&rec_id=" . $row['I'] . "&display=seller_view'>". $row['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     }
                     
                     $ml_total = $ml_total + $ml_tobe_process;
                     
                     
                     
                     $ml_tobe_process_in_lot = 0;
                     
                     $query = "SELECT loop_warehouse.b2bid , loop_transaction.warehouse_id, loop_warehouse.warehouse_name, loop_transaction.id as I FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE warehouse_id IN ( $warehouse_id_list_str)  and pa_warehouse = 2563 AND srt_dockdoors_flg=0 AND pr_ucblot = 1 AND bol_employee LIKE '' and loop_transaction.ignore = 0";
                     
					 db();
                     $resq = db_query($query);
                     
                     while($row = array_shift($resq))
                     
                     {
                     
                     	$ml_tobe_process_in_lot = $ml_tobe_process_in_lot + 1;
                     
                     	
                     
                     	$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                     
                     	
                     
                     	$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany-purchasing.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $row["warehouse_id"] ."&rec_id=" . $row['I'] . "&display=seller_view'>". $row['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     }
                     
                     
                     
                     $query = "SELECT loop_warehouse.b2bid , loop_transaction.warehouse_id, loop_warehouse.warehouse_name, loop_transaction.id as I FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE loop_transaction.pa_warehouse = 2563 and loop_transaction.cp_notes = '' AND bol_employee LIKE '' AND pr_ucblot = 1 and loop_transaction.ignore = 0 and loop_transaction.id not in ";
                     
                     $query .= " (SELECT loop_transaction.id FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE warehouse_id IN ( $warehouse_id_list_str) AND pr_ucblot = 1 AND bol_employee LIKE '' and loop_transaction.ignore = 0)";
                     
					 db();
                     $resq = db_query($query);
                     
                     while($row = array_shift($resq))
                     
                     {
                     
                     	$ml_tobe_process_in_lot = $ml_tobe_process_in_lot + 1;
                     
                     	
                     
                     	$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                     
                     	
                     
                     	$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany-purchasing.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $row["warehouse_id"] ."&rec_id=" . $row['I'] . "&display=seller_view'>". $row['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     }
                     
                     $ml_total = $ml_total + $ml_tobe_process_in_lot;
                     
                     
                     
                     $ml_tobe_process_in_recycling = 0;
                     
                     $query = "SELECT loop_transaction.id FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE warehouse_id IN ( $warehouse_id_list_str ) and pa_warehouse = '' AND pr_recycling = 1 AND bol_employee LIKE '' and loop_transaction.ignore = 0";
                     
					 db();
                     $resq = db_query($query);
                     
                     $ml_tobe_process_in_recycling = tep_db_num_rows($resq);
                     
                     
                     
                     $query = "SELECT *, loop_transaction.id AS A, loop_warehouse.id as wid FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE loop_transaction.pa_warehouse = 2563 and loop_transaction.cp_notes = '' AND bol_employee LIKE '' AND pr_recycling = 1 and loop_transaction.ignore = 0 and loop_transaction.id not in ";
                     
                     $query .= " (SELECT loop_transaction.id FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE warehouse_id IN ( $warehouse_id_list_str ) AND pr_recycling = 1 AND bol_employee LIKE '' and loop_transaction.ignore = 0)";
					 
					 db();
                     $resq = db_query($query);
                     
                     $ml_tobe_process_in_recycling = $ml_tobe_process_in_recycling + tep_db_num_rows($resq);
                     
                     $ml_total = $ml_total + $ml_tobe_process_in_recycling;
                     
                     
                     
                     $ml_in_process = 0;
                     
                     $query = "SELECT loop_warehouse.b2bid , loop_transaction.warehouse_id, loop_warehouse.warehouse_name, loop_transaction.id as I FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE (pa_warehouse = 2563)  and srt_dockdoors_flg =1 AND ucbunloaded_flg=0 and loop_transaction.ignore = 0 ORDER BY loop_transaction.ID ASC";
                     
					 db();
                     $resq = db_query($query);
                     
                     while($row = array_shift($resq))
                     
                     {
                     
                     	$ml_in_process = $ml_in_process + 1;
                     
                     	
                     
                     	$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                     
                     	
                     
                     	$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany-purchasing.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $row["warehouse_id"] ."&rec_id=" . $row['I'] . "&display=seller_view'>". $row['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     }
                     
                     
                     
                     $query = "SELECT loop_warehouse.b2bid , loop_transaction.warehouse_id, loop_warehouse.warehouse_name, loop_transaction.id as I FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE (pa_warehouse = 2563) and pa_pickupdate <> '' and cp_date <> '' AND ucbunloaded_flg=1 AND (sort_entered = 0 or usr_file LIKE '') AND transaction_date > '2010-10-28' and loop_transaction.ignore = 0 ORDER BY loop_transaction.ID ASC";
                     
					 db();
                     $resq = db_query($query);
                     
                     while($row = array_shift($resq))
                     
                     {
                     
                     	$ml_in_process = $ml_in_process + 1;
                     
                     	
                     
                     	$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                     
                     	
                     
                     	$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany-purchasing.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $row["warehouse_id"] ."&rec_id=" . $row['I'] . "&display=seller_view'>". $row['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     }
                     
                     $ml_total = $ml_total + $ml_in_process;
                     
                     
                     
                     $ml_total_exl_recy = $ml_total - $ml_tobe_process_in_recycling;
                     
                     
                     
                     $lisoftrans .= "</table></span>";
                     
                     		
                     
                     $str_ml = "";
                     
                     if ($ml_tobe_process > 0 || $ml_tobe_process_in_lot > 0 || $ml_tobe_process_in_recycling > 0 || $ml_in_process > 0)
                     
                     {
                     
                     	$show_data = "no";
                     
                     	
                     
                     	echo "<a href='#' onclick='load_div(11); return false;'>" . number_format($ml_total_exl_recy,0) . "</font></a>";
                     
                     	echo "<span id='11' style='display:none;'><a href='#' onclick='close_div(); return false;'>Close</a>" . $lisoftrans  . "</span>";
                     
                     	
                     
                     }else{
                     
                     
                     
                     echo "0";
                     
                       }						   						   
                     
                     ?>
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  Red Inbound Trailers
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
                  <?php
                     $lisoftrans = "<span style='width:800px;'><table cellSpacing='1' cellPadding='1' border='0' width='780'>";
                     
                     $lisoftrans .= "<tr><td class='txtstyle_color'>LOOP ID</td><td class='txtstyle_color'>Company Nickname</td></tr>";
                     
                     
                     
                     $ml_unproccess_days=0;
                     
                     //$query = "SELECT *, loop_warehouse.b2bid , loop_transaction.warehouse_id, loop_warehouse.warehouse_name, loop_transaction.id as I FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE (pa_warehouse = 2563) and pa_pickupdate <> '' AND ucbunloaded_flg=1  AND (sort_entered = 0 or usr_file LIKE '') AND transaction_date > '2010-10-28' and loop_transaction.ignore = 0 ORDER BY loop_transaction.ID ASC";
                     
                     
                     
                     /*$query = "SELECT *, loop_warehouse.b2bid , loop_transaction.warehouse_id, loop_warehouse.warehouse_name, loop_transaction.id as I 
                     
                     FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id 
                     
                     WHERE (pa_warehouse = 2563) and (pr_ucblot_dt <> '' or srt_ucbdockdoor_dt <> '' or ucbunloaded_dt <> '')
                     
                     AND (sort_entered = 0) AND transaction_date > '2010-10-28' and loop_transaction.ignore = 0 ORDER BY loop_transaction.ID ASC";
                     
                     $res = db_query($query,db());
                     
                     while($row = array_shift($res))
                     
                     {
                     
                     	//echo "pr_ucblot_dt - " . $row["pr_ucblot_dt"] . " - " . $row["srt_ucbdockdoor_dt"] . " - " . $row["ucbunloaded_dt"];
                     
                     	
                     
                     	$bs_days1 = 0; $bs_days2 = 0; $bs_days3 = 0;		
                     
                     	$today=strtotime(date("m/d/Y"));
                     
                     	if ($row["pr_ucblot_dt"] != "" && $row["pr_ucblot_dt"] != "0000-00-00 00:00:00"){
                     
                     		$confirm_date=strtotime($row["pr_ucblot_dt"]);
                     
                     		while ($confirm_date <= $today) {
                     
                     			if (date('N', $confirm_date) <= 5) {
                     
                     			 $bs_days1++;    
                     
                     			}
                     
                     			$confirm_date += 86400;
                     
                     		}
                     
                     	}	
                     
                     	
                     
                     	if ($row["srt_ucbdockdoor_dt"] != "" && $row["srt_ucbdockdoor_dt"] != "0000-00-00 00:00:00"){
                     
                     		$confirm_date=strtotime($row["srt_ucbdockdoor_dt"]);
                     
                     		while ($confirm_date <= $today) {
                     
                     			if (date('N', $confirm_date) <= 5) {
                     
                     			 $bs_days2++;    
                     
                     			}
                     
                     			$confirm_date += 86400;
                     
                     		}
                     
                     	}	
                     
                     	
                     
                     	if ($row["ucbunloaded_dt"] != "" && $row["ucbunloaded_dt"] != "0000-00-00 00:00:00"){
                     
                     		$confirm_date=strtotime($row["ucbunloaded_dt"]);
                     
                     		while ($confirm_date <= $today) {
                     
                     			if (date('N', $confirm_date) <= 5) {
                     
                     			 $bs_days3++;    
                     
                     			}
                     
                     			$confirm_date += 86400;
                     
                     		}
                     
                     	}
                     
                     	
                     
                     	if($bs_days1>3 || $bs_days2>3 || $bs_days3>3)		
                     
                     	{
                     
                     		$ml_unproccess_days=$ml_unproccess_days+1;
                     
                     		
                     
                     		$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                     
                     		
                     
                     		$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany-purchasing.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $row["warehouse_id"] ."&rec_id=" . $row['I'] . "&display=seller_sort'>". $row['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     		
                     
                     	}	
                     
                     }*/
                     
                     
                     
                     $query = "SELECT variablevalue from tblvariable where variablename = 'ML_red_row_cnt'";
                     
					 db();
                     $res = db_query($query);
                     
                     while($row = array_shift($res))
                     
                     {
                     
                     	$ml_unproccess_days = $row["variablevalue"];
                     
                     }
                     
                     
                     
                     $ML_red_row_loop_ids = "";
                     
                     $query = "SELECT variablevalue from tblvariable where variablename = 'ML_red_row_loop_ids'";
                     
					 db();
                     $res = db_query($query);
                     
                     while($row = array_shift($res))
                     
                     {
                     
                     	$ML_red_row_loop_ids = $row["variablevalue"];
                     
                     }
                     
                     $query = "SELECT loop_warehouse.b2bid , loop_transaction.id as I, loop_warehouse.warehouse_name, loop_warehouse.id as warehouse_id FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE loop_transaction.id in (" . $ML_red_row_loop_ids . ")";
                     
					 db();
                     $res = db_query($query);
                     
                     while($row = array_shift($res))
                     
                     {
                     
                     	$nickname = get_nickname_val($row["warehouse_name"], $row["b2bid"]);
                     
                     	
                     
                     	$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a target='_blank' href='viewCompany-purchasing.php?ID=" . $row["b2bid"] . "&show=transactions&warehouse_id=" . $row["warehouse_id"] . "&rec_type=Manufacturer&proc=View&searchcrit=&id=". $row["warehouse_id"] ."&rec_id=" . $row['I'] . "&display=seller_sort'>". $row['I'] . "</a></td><td bgColor='#E4EAEB'>" . $nickname . "</td></tr>";
                     
                     }
                     
                     
                     
                     $lisoftrans .= "</table></span>";
                     
                     
                     
                     if($ml_unproccess_days>0)
                     
                     {
                     
                     	echo "<a href='#' onclick='load_div(12); return false;'><span style='color:#FF0000'>" . number_format($ml_unproccess_days,0) . "</span></font></a>";
                     
                     	echo "<span id='12' style='display:none;'><a href='#' onclick='close_div(); return false;'>Close</a>" . $lisoftrans  . "</span>";
                     
                     }
                     
                     else{
                     
                     	echo "<span style='color:#000000'>" . $ml_unproccess_days. "</span>";
                     
                     }
                     
                     
                     
                     ?>
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  Money Lost on Red Leaderboard Names
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
                  <?php 
                     if($money_lost_array[2]<0)
                     
                     {
                     
                     	echo "<span style='color:#FF0000'>";
                     
                     }
                     
                     else{
                     
                     	echo "<span style='color:#000000'>";
                     
                     }
                     
                     echo "$".$money_lost_array[2]."</span>";
                     
                     ?>
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  Average Production per Hour (Labor Only)
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
                  <?php echo "$".number_format($prod_hrs_array[2],2);
                     ?>
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  Average Production per Hour (All Employees)
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
                  $<?php echo number_format($total_prod_per_hrs_entire[2],2)?>
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  # of Loop Boxes Sorted
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center"><span class="style3" style="width: 190">
                  <?php
                     //$sort_qry="SELECT loop_boxes_sort.warehouse_id, loop_transaction.id as rec_id, loop_transaction.warehouse_id as rec_warehouse_id , box_id, sort_date, sum(boxgood) as boxgood FROM loop_boxes_sort inner join loop_transaction on loop_transaction.id = loop_boxes_sort.trans_rec_id inner join loop_boxes on loop_boxes.id = loop_boxes_sort.box_id where loop_transaction.ignore = 0 and (DATE_FORMAT(STR_TO_DATE(sort_date, '%m/%d/%Y'), '%Y-%m-%d') BETWEEN '" . $date_from_val . "' and '" . $date_to_val . "') and loop_boxes.type in ('LoopShipping', 'Box', 'Boxnonucb', 'Presold', 'Medium', 'Large', 'Xlarge') and loop_boxes_sort.warehouse_id=2563 group by loop_transaction.id order by loop_boxes_sort.id";
                     
                     $sort_qry="SELECT sum(boxgood) as boxgood FROM loop_boxes_sort inner join loop_transaction on loop_transaction.id = loop_boxes_sort.trans_rec_id inner join loop_boxes on loop_boxes.id = loop_boxes_sort.box_id where loop_transaction.ignore = 0 and (DATE_FORMAT(STR_TO_DATE(sort_date, '%m/%d/%Y'), '%Y-%m-%d') BETWEEN '" . $date_from_val . "' and '" . $date_to_val . "') and loop_boxes.type in ('Loop', 'LoopShipping') and loop_boxes_sort.warehouse_id=2563 group by box_id";
                     
					 db();
                     $sort_qry_res=db_query($sort_qry);
                     
                     while($sort_row = array_shift($sort_qry_res))
                     
                     {
                     
                     	$ml_total_qty= $ml_total_qty + $sort_row["boxgood"];
                     
                     }
                     
                     echo number_format($ml_total_qty, 0);
                     
                     ?>
                  </span>
               </td>
            </tr>
         </table>
         <!------------------End Table for ML warehouse------------------->
         <br>
         <!-------------------Table to display Totals-------------------->
         <table cellSpacing="1" cellPadding="1" border="0" class="datatable">
            <tr>
               <td colspan="2" class="style17" align="center">
                  <strong>Totals</strong>
               </td>
            </tr>
            <tr>
               <td style="width: 200" class="style17" align="center">
                  <b>Measurables</b>
               </td>
               <td style="width: 190" class="style17" align="center">
                  <b>Number</b>
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  Order Issues
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
                  <?php
                     $dt_view_qry = "SELECT loop_transaction_buyer_order_issue.trans_id as I FROM loop_transaction_buyer_order_issue ";
                     
                     $dt_view_qry .= " INNER JOIN loop_transaction_buyer ON loop_transaction_buyer_order_issue.trans_id = loop_transaction_buyer.id ";
                     
                     $dt_view_qry .= "where loop_transaction_buyer.ignore = 0 and order_issue_start_date_time between '" . $date_from_val . "' AND '" . $date_to_val . " 23:59:59' ";
                     
                     $dt_view_qry .= " GROUP BY loop_transaction_buyer.id order by loop_transaction_buyer.id";
                     
                     //echo "<br/>" . $dt_view_qry . "<br/><br/>";
                     db();
                     $data_res = db_query($dt_view_qry);
                     
                     $dt_view_row = tep_db_num_rows($data_res);
                     
                     //
                     
                     if($dt_view_row>0)
                     
                     {
                     
                     	echo "<span style='color:#FF0000'>";
                     
                     }
                     
                     else{
                     
                     	echo "<span style='color:#000000'>";
                     
                     }
                     
                     echo $dt_view_row."</span>";
                     
                     ?>
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  Pickup Requests (excl. Recycling)
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
                  <?php $total_pickup_requests=$pickup_requested_hv+$pickup_requested_ha+$pickup_requested_ml;
                     echo $total_pickup_requests;
                     
                     ?>
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  Outstanding Unprocessed Trailers
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
                  <?php $total_uncompressed_trailers=$hv_total_exl_recy+$ha_total_exl_recy+$ml_total_exl_recy;
                     echo $total_uncompressed_trailers;
                     
                     ?>
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  Red Inbound Trailers
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
                  <?php
                     $total_unproccess_days= $hv_unproccess_days+$ha_unproccess_days+$ml_unproccess_days;
                     
                     
                     
                     if($total_unproccess_days>0)
                     
                     {
                     
                     echo "<span style='color:#FF0000'>";
                     
                     }
                     
                     else{
                     
                     echo "<span style='color:#000000'>";
                     
                     }
                     
                     echo $total_unproccess_days."</span>";
                     
                     ?>
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  Money Lost on Red Leaderboard Names
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
                  <?php
                     if($total_money_lost<0)
                     
                     {
                     
                     	echo "<span style='color:#FF0000'>";
                     
                     }
                     
                     else{
                     
                     	echo "<span style='color:#000000'>";
                     
                     }
                     
                     	echo "$".number_format($total_money_lost,2)."</span>";
                     
                     ?>
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  Average Production per Hour (Labor Only)
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
                  <?php 
                     //$total_prod_hr=$prod_hrs_array[0]+$prod_hrs_array[1]+$prod_hrs_array[2];
                     
                     
                     
                     echo "$".number_format($prod_hrs_array_all,2); 
                     
                     ?>
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  Average Production per Hour (All Employees)
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
                  <?php
                     $prod_entire_facility=($total_prod_per_hrs_entire[0]+$total_prod_per_hrs_entire[1]+$total_prod_per_hrs_entire[2])/3;
                     
                     echo "$".number_format($prod_entire_facility,2);
                     
                     ?>
               </td>
            </tr>
            <tr>
               <td style="width: 200" bgcolor="#e4e4e4" class="style3" align="left">
                  # of Loop Boxes Sorted
               </td>
               <td style="width: 190" bgcolor="#e4e4e4" class="style3" align="center">
                  <?php
                     $total_sorted=$hv_total_qty+$ha_total_qty+$ml_total_qty;
                     
                     	echo number_format($total_sorted, 0);
                     
                     ?>
               </td>
            </tr>
         </table>
         <!-------------------End Table to display Totals-------------------->
         <!--End new table formatting-->
         <?php }?>	
      </div>
   </body>
</html>