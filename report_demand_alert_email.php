<?php
  require_once ("inc/header_session.php");
  require_once ("mainfunctions/database.php");
  require_once ("mainfunctions/general-functions.php");
  
  $chkinitials =  $_COOKIE['userinitials'];
  
  $matchStr_e= "Select * from employees WHERE initials='".$chkinitials."'";
  db_b2b();
  $res_e = db_query($matchStr_e);
  
  $row_e=array_shift($res_e);
  
  $logged_emp_id=$row_e["employeeID"];

?> 
<!DOCTYPE html>
<html>
  <head>
    <title>Demand Alert Email List Report</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style type="text/css">
      body {
      margin-left: 0px;
      margin-top: 0px;
      margin-right: 0px;
      margin-bottom: 0px;
      padding: 0px 20px;
      }
      .display_title{
      background-color:#ABC5DF;
      font-size:13px;
      }
      .style12{
      background-color:#E4E4E4;
      font-size:12px;
      }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
    <link rel='stylesheet' type='text/css' href='css/ucb_common_style.css' >
  </head>
  <body>
    <?php
      include("inc/header.php");
      
	?>
    <div id="light" class="white_content"></div>
    <div id="fade" class="black_overlay"></div>
    <div class="main_data_css">
      <div class="dashboard_heading" style="float: left;">
        <div style="float: left;">
          Demand Alert Email List Report
          <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
            <span class="tooltiptext">
            This report allows the user to see all companies that are within a certain range of a demand entry, which is used to generate email lists for marketing demand alerts.
            </span>
          </div>
        </div>
      </div>
      <table width="99%" border="0" cellspacing="1" cellpadding="0">
        <tbody>
          <tr align="center">
            <td bgcolor="#C0CDDA"><font face="Arial, Helvetica, sans-serif" size="2" color="#333333">DEMANDS</font></td>
          </tr>
          <tr>
            <td>
              <form method="get" name="search_frm" action="report_demand_alert_email.php">
                <table width="100%" border="0" cellspacing="0" cellpadding="1">
                  <tr>
                    <td colspan="6" bgcolor="#C0CDDA">
                      <?php
                        $selStr = "SELECT * FROM quote_request ORDER BY quote_id";
                        
						db();
                        $selRes = db_query($selStr);
                        
                        while ($qreq = array_shift($selRes)) {
                        
                        	
                        
                        	if($qreq["quote_item"] == 1){
                        
                        		$selStr2 = "SELECT * FROM quote_gaylord WHERE quote_id = ". $qreq["quote_id"] ;
                        
                        		
                        
                        	}else if($qreq["quote_item"] == 2){
                        
                        		$selStr2 = "SELECT * FROM quote_shipping_boxes WHERE quote_id = ". $qreq["quote_id"] ;
                        
                        		
                        
                        	}else if($qreq["quote_item"] == 3){
                        
                        		$selStr2 = "SELECT * FROM quote_supersacks WHERE quote_id = ". $qreq["quote_id"] ;
                        
                        		
                        
                        	}else if($qreq["quote_item"] == 4){
                        
                        		$selStr2 = "SELECT * FROM quote_pallets WHERE quote_id = ". $qreq["quote_id"] ;
                        
                        	
                        
                        	}else if($qreq["quote_item"] == 5){
                        
                        		$selStr2 = "SELECT * FROM quote_dbi WHERE quote_id = ". $qreq["quote_id"] ;
                        
                        		
                        
                        	}else if($qreq["quote_item"] == 6){
                        
                        		$selStr2 = "SELECT * FROM quote_recycling WHERE quote_id = ". $qreq["quote_id"] ;
                        
                        		
                        
                        	}else if($qreq["quote_item"] == 7){
                        
                        		$selStr2 = "SELECT * FROM quote_other WHERE quote_id = ". $qreq["quote_id"] ;
                        
                        	}
                        
                        	db();
                        
                        	$result2 = db_query($selStr2);
                        
                        	
                        
                        	if(count($result2)> 0 ){
                        
                        		while($qreq2 = array_shift($result2)){
                        
                        
                        
                        			$vendor_name = $tipStr = "";
                        
                        			$b2bid = $qreq["companyID"];
                        
                        			$vendor_name = get_nickname_val("", $b2bid);
                       
                        			$tipStr = $tipStr . $qreq["quote_id"] . " - " . $vendor_name;
                        
                    
                        			$MGArray[] = array('I' => $qreq["quote_id"], 'tipStr' => $tipStr, 'vendor_name' => $vendor_name);
                        
                        		}
                        
                        	}
                        
                        }
                        
                        
                        $MGArraysort_I = array();
                        
                        ?>
                      <select name="demandID" style="width:100%">
                      <?php
                        foreach ($MGArray as $MGArraytmp) {
                        
                        	$MGArraysort_I[] = $MGArraytmp['vendor_name'];
                        
                        }
                        
                        array_multisort($MGArraysort_I,SORT_ASC,SORT_STRING,$MGArray); 
                        
                        
                        
                        foreach ($MGArray as $MGArraytmp2) {
                        
                        
                        
                        	if ($MGArraytmp2["I"] == $_REQUEST["demandID"]) {
                        
                        			echo "<option value=" . $MGArraytmp2["I"] . " Selected >";
                        
                        		}		
                        
                        	if ($MGArraytmp2["I"] != $_REQUEST["demandID"]) {
                        
                        			echo "<option value=" . $MGArraytmp2["I"] . " >";
                        
                        		}
                        
                        
                        
                        	echo $MGArraytmp2["tipStr"] . "</option>";
                        
                        }
                        
                        ?>
                      </select>					  
                    </td>
                  </tr>
                  <tr bgcolor="#E4E4E4">
                    <td colspan="6">
                      How many miles to search for: <input type=text name="miles" value=<?php echo $_REQUEST["miles"]; ?>>
                    </td>
                  </tr>
                  <?php
                    $chk_box1_se1 = ""; $chk_box1_se2 = ""; $chk_box1_se3 = ""; $chk_box1_se4 = "";
                    
                    $chk_box1_se5 = ""; $chk_box1_se6 = ""; $chk_box1_se7 = ""; $chk_box1_se8 = "";
                    
                    if($_REQUEST["box_broker"] == "1"){ $chk_box1_se1 = 'checked'; }
                    
                    if($_REQUEST["food_bev_cpg"] == "1"){ $chk_box1_se2 = 'checked'; }
                    
                    if($_REQUEST["plastic_resin"] == "1"){ $chk_box1_se3 = 'checked'; }
                    
                    if($_REQUEST["post_industrial"] == "1"){ $chk_box1_se4 = 'checked'; }
                    
                    if($_REQUEST["produce_agri"] == "1"){ $chk_box1_se5 = 'checked'; }
                    
                    if($_REQUEST["pallet_bro"] == "1"){ $chk_box1_se6 = 'checked'; }
                    
                    if($_REQUEST["pallet_pro"] == "1"){ $chk_box1_se7 = 'checked'; }
                    
                    if($_REQUEST["other"] == "1"){ $chk_box1_se8 = 'checked'; }
                    
                    
                    
                    if (!isset($_REQUEST["btnsubmit"])) {
                    
                    	$chk_box1_se1 = "checked"; 
                    
                    	$chk_box1_se4 = "checked";
                    
                    	$chk_box1_se6 = "checked";
                    
                    	$chk_box1_se7 = "checked";
                    
                    }
                    
                    ?>
                  <tr bgcolor="#E4E4E4">
                    <td>
                      <input type="checkbox" name="box_broker" id="box_broker" <?php echo $chk_box1_se1; ?> value="1" />
                      <strong>Box Broker(Supplier)</strong>
                    </td>
                    <td>
                      <input type="checkbox" name="food_bev_cpg" id="food_bev_cpg" <?php echo $chk_box1_se2; ?> value="1" />
                      <strong>Food/Bev/CPG Manufacturing and Processing</strong>
                    </td>
                    <td>
                      <input type="checkbox" name="plastic_resin" id="plastic_resin" <?php echo $chk_box1_se3; ?> value="1" />
                      <strong>Plastic-Resin Manufacturing</strong>
                    </td>
                    <td>
                      <input type="checkbox" name="post_industrial" id="post_industrial" <?php echo $chk_box1_se4; ?> value="1" />
                      <strong>Post-Industrial Recycling</strong>
                    </td>
                    <td rowspan="2">
                      <input name="btnsubmit" id="btnsubmit" type=submit value="Submit">
                    </td>
                    <td rowspan="2" align="right">
                      <input type="checkbox" name="showall_emp" id="showall_emp" value="yes" onclick="if(this.checked){this.form.submit()}else{this.form.submit()}" >Show only my record(s)
                    </td>
                  </tr>
                  <tr bgcolor="#E4E4E4">
                    <td>	
                      <input type="checkbox" name="produce_agri" id="produce_agri" <?php  echo $chk_box1_se5; ?> value="1" />
                      <strong>Produce/Agriculture</strong>
                    </td>
                    <td>
                      <input type="checkbox" name="pallet_bro" id="pallet_bro" <?php  echo $chk_box1_se6;  ?> value="1" />
                      <strong>Pallet Broker</strong>
                    </td>
                    <td>
                      <input type="checkbox" name="pallet_pro" id="pallet_pro" <?php echo $chk_box1_se7; ?> value="1" />
                      <strong>Pallet Processor</strong>
                    </td>
                    <td>
                      <input type="checkbox" name="other" id="other" <?php echo $chk_box1_se8; ?> value="1" />
                      <strong>Other</strong>&nbsp;&nbsp;&nbsp;
                    </td>
                  </tr>
                </table>
              </form>
            </td>
          </tr>
        </tbody>
      </table>
      <div ><i>Note: Please wait until you see <font color="red">"END OF REPORT"</font> at the bottom of the report, before download the report.</i></div>
      <?php if (isset($_REQUEST["btnsubmit"])) { ?>
      <br>
      <table width="70%" border="0" cellspacing="1" cellpadding="0">
        <tr>
          <td valign="top"><a href="report_demand_alert_email_export.php">Download Excel</a></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td>
            <div id='div_req_sop'>
              <table cellpadding=2 cellspacing=1 width="100%">
                <?php 
				  db_b2b();
                  db_query("delete from demand_alert_email");
                  
                  
                  
                  $quoSql = "SELECT companyID FROM quote_request WHERE quote_id=". $_REQUEST["demandID"];

				  db();
                  $quores = db_query($quoSql);
                  
                  $quoCom = array_shift($quores);
                  
                  
                  
                  $comStr1= "SELECT * FROM companyInfo WHERE ID = " . $quoCom["companyID"];

				  db_b2b();
                  $resStr1 = db_query($comStr1);
                  
                  $comSelt = array_shift($resStr1);
                  
                  
                  
                  $zipStr= "";
                  
                  $comzip = strpos($comSelt["shipZip"], " ");
                  
                  if ($comzip != false)	{ 	
                  
                  	$tmp_zipval = str_replace(" ", "", $comSelt["shipZip"]);
                  
                  	$zipStr= "Select * from zipcodes_canada WHERE zip = '" . $tmp_zipval . "'";
                  
                  }else {
                  
                  	$zipStr= "Select * from ZipCodes WHERE zip = '" . intval($comSelt["shipZip"]) . "'";
                  
                  }
                  
                  
                  db_b2b();
                  $result1 = db_query($zipStr);
                  
                  while ($ziploc = array_shift($result1)) {
                  
                  	$locLat = $ziploc["latitude"];							
                  
                  	$locLong = $ziploc["longitude"];
                  
                  }
                  
                  
                  
                  // Checkbox selected or not
                  
                  $indu_list = "";
                  
                  $indu_list_found = "N";
                  
                  if((isset($_REQUEST["box_broker"])) && ($_REQUEST["box_broker"]=="1")){
                  
                  	$indu_list = "18";
                  
                  	$indu_list_found = "Y";
                  
                  }
                  
                  
                  
                  if((isset($_REQUEST["food_bev_cpg"])) && ($_REQUEST["food_bev_cpg"]=="1")){
                  
                  	
                  
                  	if($indu_list_found == 'Y'){
                  
                  		$indu_list .= ", 15";
                  
                  	}else{
                  
                  		$indu_list = "15";
                  
                  		$indu_list_found = "Y";
                  
                  	}
                  
                  }
                  
                  
                  
                  if((isset($_REQUEST["plastic_resin"])) && ($_REQUEST["plastic_resin"]=="1")){
                  
                  	
                  
                  	if($indu_list_found == 'Y'){
                  
                  		$indu_list .= ", 16";
                  
                  	}else{
                  
                  		$indu_list = "16";
                  
                  		$indu_list_found = "Y";
                  
                  	}
                  
                  }
                  
                  
                  
                  if((isset($_REQUEST["post_industrial"])) && ($_REQUEST["post_industrial"]=="1")){
                  
                  	
                  
                  	if($indu_list_found == 'Y'){
                  
                  		$indu_list .= ", 17";
                  
                  	}else{
                  
                  		$indu_list = "17";
                  
                  		$indu_list_found = "Y";
                  
                  	}
                  
                  }
                  
                  
                  
                  if((isset($_REQUEST["produce_agri"])) && ($_REQUEST["produce_agri"]=="1")){
                  
                  	
                  
                  	if($indu_list_found == 'Y'){
                  
                  		$indu_list .= ", 14";
                  
                  	}else{
                  
                  		$indu_list = "14";
                  
                  		$indu_list_found = "Y";
                  
                  	}
                  
                  }
                  
                  
                  
                  if((isset($_REQUEST["pallet_bro"])) && ($_REQUEST["pallet_bro"]=="1")){
                  
                  	
                  
                  	if($indu_list_found == 'Y'){
                  
                  		$indu_list .= ", 20";
                  
                  	}else{
                  
                  		$indu_list = "20";
                  
                  		$indu_list_found = "Y";
                  
                  	}
                  
                  }
                  
                  
                  
                  if((isset($_REQUEST["pallet_pro"])) && ($_REQUEST["pallet_pro"]=="1")){
                  
                  	
                  
                  	if($indu_list_found == 'Y'){
                  
                  		$indu_list .= ", 21";
                  
                  	}else{
                  
                  		$indu_list = "21";
                  
                  		$indu_list_found = "Y";
                  
                  	}
                  
                  }
                  
                  
                  
                  if((isset($_REQUEST["other"])) && ($_REQUEST["other"]=="1")){
                  
                  	
                  
                  	if($indu_list_found == 'Y'){
                  
                  		$indu_list .= ", 19";
                  
                  	}else{
                  
                  		$indu_list = "19";
                  
                  		$indu_list_found = "Y";
                  
                  	}
                  
                  }
                  
                  
                  
                  $indus_Sql = "";
                  
                  if($indu_list_found == "Y"){
                  
                  	$indus_Sql = "AND companyInfo.industry_id IN (".$indu_list.")";
                  
                  }
                  
                  
                  
                  if((isset($_REQUEST["showall_emp"])) && ($_REQUEST["showall_emp"]=="yes")){
                  
                  	$sql = "SELECT companyInfo.ID, companyInfo.shipZip, companyInfo.industry_id, companyInfo.status, companyInfo.email, companyInfo.company, companyInfo.contact, companyInfo.nickname, companyInfo.shipCity, companyInfo.shipState, employees.name as empname, employees.initials as initials FROM companyInfo left join employees on employees.employeeID = companyInfo.assignedto where companyInfo.shipZip <> '' and haveNeed = 'Have Boxes' and companyInfo.status NOT IN (24, 31, 43) ". $indus_Sql ." AND companyInfo.assignedto =".$_COOKIE['b2b_id'];
                  
                  	
                  
                  }else{
                  
                  	$sql = "SELECT companyInfo.ID, companyInfo.shipZip, companyInfo.industry_id, companyInfo.status, companyInfo.email, companyInfo.company, companyInfo.contact, companyInfo.nickname, companyInfo.shipCity, companyInfo.shipState, employees.name as empname, employees.initials as initials FROM companyInfo left join employees on employees.employeeID= companyInfo.assignedto where companyInfo.shipZip <> '' and haveNeed = 'Have Boxes' and companyInfo.status NOT IN (24, 31, 43) ".$indus_Sql."";
                  
                  
                  
                  }
                  
                  
                  db_b2b();
                  $com_result = db_query($sql);
                  
                  ?>
                <thead>
                  <tr>
                    <th class="display_title">Name</th>
                    <th class="display_title">Buy From Email</th>
                    <th class="display_title">Company</th>
                    <th class="display_title">Rep</th>
                  </tr>
                </thead>
                <tbody>
                  <?php  
                    while($rwOne = array_shift($com_result) ){
                    
                    	$tmppos_1 = strpos($rwOne["shipZip"], " ");
                    
                    	if ($tmppos_1 != false)
                    
                    	{ 	
                    
                    		$tmp_zipval = str_replace(" ", "", $rwOne["shipZip"]);
                    
                    		$zipStr= "Select * from zipcodes_canada WHERE zip = '" . $tmp_zipval . "'";
                    
                    	}else {
                    
                    		$zipStr= "Select * from ZipCodes WHERE zip = '" . intval($rwOne["shipZip"]) . "'";
                    
                    	}
                    
                    	
						db_b2b();
                    	$result2 = db_query($zipStr);
                    
                    	$objShipZip= array_shift($result2);		
                    
                    
                    
                    	$shipLat = $objShipZip["latitude"];
                    
                    	$shipLong = $objShipZip["longitude"];
                    
                    
                    
                    	$distLat = ($shipLat - $locLat) * 3.141592653 / 180;
                    
                    	$distLong = ($shipLong - $locLong) * 3.141592653 / 180;
                    
                    
                    
                    	$distA = Sin($distLat/2) * Sin($distLat/2) + Cos($shipLat * 3.14159 / 180) * Cos($locLat * 3.14159 / 180) * Sin($distLong/2) * Sin($distLong/2);
                    
                    
                    
                    	$distC = 2 * atan2(sqrt($distA),sqrt(1-$distA));
                    
                    
                    
                    	if ( (int) (6371 * $distC * .621371192) < $_REQUEST["miles"]) {	
                    
                    		$nickname = get_nickname_val($rwOne["company"], $rwOne["ID"]);
                    
                    		//echo (int) (6371 * $distC * .621371192) . " " . $nickname . " <br>";
                    
                    
                    
                    		echo '<tr><td class="style12">';
                    
                    		echo $rwOne["contact"] .'</td><td class="style12">';
                    
                    		echo $rwOne["email"] .'</td>';
                    
                    		echo "<td class='style12'>"; //<a target='_blank' href='viewCompany.php?ID=" . $rwOne["ID"] . "'>
                    
                    		echo $nickname . "</td>";
                    
                    		echo '<td class="style12">';
                    
                    		echo $rwOne["initials"] .'</td></tr>';
                    
                    		
                    
                    		$report_date=date("Y-m-d");
                    
                    		
                    
                    		$secSql = "Select * from b2bsellto where companyid = ". $rwOne["ID"] ." order by selltoid";
							db_b2b();
                    		$secRes = db_query($secSql);
                    
                    		if( tep_db_num_rows($secRes) > 0){
                    
                    			while($secRw = array_shift($secRes)){
                    
                    				if($secRw["name"] != "" && $secRw["email"] != ""){
                    
                    					echo '<tr><td class="style12">';
                    
                    					echo $secRw["name"] .'</td><td class="style12">';
                    
                    					echo $secRw["email"] .'</td><td class="style12">';
                    
                    					echo $nickname .'</td><td class="style12">';
                    
                    					echo $rwOne["initials"] .'</td></tr>';
                    
                    					
                    
                    					$inner_qry = "insert into demand_alert_email (name, email, company_name, date, rep) values ('". str_replace("'", "\'" , $secRw["name"])."', '".$secRw["email"]."', '". str_replace("'", "\'" , $nickname) ."', '".$report_date."', '". $rwOne["initials"] ."')";
										db_b2b();
                    					db_query($inner_qry);
                    
                    				}
                    
                    			}
                    
                    		}
                    
                    		
                    
                    		$sql_qry = "insert into demand_alert_email (name, email, company_name, date, rep) values ('". str_replace("'", "\'" , $rwOne["contact"])."', '".$rwOne["email"]."', '". str_replace("'", "\'" , $nickname) ."', '".$report_date."', '". $rwOne["initials"] ."')";
							db_b2b();
                    		db_query($sql_qry);
                    
                    	}
                    
                    }
                    
                    ?>
                </tbody>
              </table>
            </div>
          </td>
        </tr>
      </table>
      <div ><i><font color="red">"END OF REPORT"</font></i></div>
      <?php 	} ?>
    </div>
  </body>
</html>
