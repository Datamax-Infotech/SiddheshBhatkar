<?php
  session_start();
  require ("inc/header_session.php");
  require ("mainfunctions/database.php");
  require ("mainfunctions/general-functions.php");
  
  ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>B2B Email List Tool</title>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
    <LINK rel='stylesheet' type='text/css' href='css/ucb_common_style.css' >
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
      padding: 5px;
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
      width:1000px;
      z-index:1002;
      margin: 0px 0 0 0px; 
      padding: 10px 10px 10px 10px;
      border-color:black; 
      border-width:2px;
      overflow: auto;
      }
    </style>
    <script language="JavaScript" SRC="inc/CalendarPopup.js"></script><script language="JavaScript" src="inc/general.js"></script>
    <script language="JavaScript">document.write(getCalendarStyles());</script>
    <script language="JavaScript">
      var cal2xx = new CalendarPopup("listdiv");
      cal2xx.showNavigationDropdowns();
      var cal3xx = new CalendarPopup("listdiv");
      cal3xx.showNavigationDropdowns();
    </script>
    <script language="JavaScript">
      function load_div(id){
      	var element = document.getElementById("spanctr" + id); //replace elementId with your element's Id.
      
      	var rect = element.getBoundingClientRect();
      	var elementLeft,elementTop; //x and y
      	var scrollTop = document.documentElement.scrollTop?
      					document.documentElement.scrollTop:document.body.scrollTop;
      	var scrollLeft = document.documentElement.scrollLeft?                   
      					 document.documentElement.scrollLeft:document.body.scrollLeft;
      	elementTop = rect.top+scrollTop;
      	elementLeft = rect.left+scrollLeft;
      
      	document.getElementById("light").innerHTML = document.getElementById("spanctr" + id).innerHTML;
      	document.getElementById('light').style.display='block';
      	document.getElementById('fade').style.display='block';
      
      	document.getElementById('light').style.left='100px';
      	document.getElementById('light').style.top=elementTop + 100 + 'px';
      
      }
      		
      function close_div(){
      	document.getElementById('light').style.display='none';
      }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
      $(document).ready(function(){
      	$('#account_type').on('change', function(){
      		var account_type_sel = $(this).val();
      		if(account_type_sel){
      			$.ajax({
      				type:'POST',
      				url:'show_status_dd.php',
      				data:'account_type_sel='+account_type_sel,
      				success:function(html){
      					//$('#statusID').html(html);
      					$('#statusID_List').html(html);
      				}
      			}); 
      			$.ajax({
      				type:'POST',
      				url:'show_ind_dd.php',
      				data:'account_type_sel='+account_type_sel,
      				success:function(html){
      					$('#industry_id').html(html);
      				}
      			});
      		}
      	});
      });
    </script>
  </head>
  <style type="text/css">
    .search input {
    height: 24px !important;
    }
    .display_title {
    font-size: 12px;
    padding: 3px;
    font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
    background: #ABC5DF;
    white-space: nowrap;
    }
    .lk_btn{
    font-size: 12px;
    font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
    border: 1px solid #000;
    padding: 5px 10px;
    border-radius: 3px;
    background: #e4e4e4;
    color: #222;
    text-decoration: none;
    text-underline-position: unset;
    cursor: pointer;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    }
  </style>
  <body>
    <?php include("inc/header.php"); ?>
    <div class="main_data_css">
      <div id="light" class="white_content"></div>
      <div id="fade" class="black_overlay"></div>
      <div class="dashboard_heading" style="float: left;">
        <div style="float: left;">
          B2B Email List Tool  
        </div>
        &nbsp;
        <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
          <span class="tooltiptext">This tool allows the user to generate email lists based on filtering criteria.</span>
        </div>
        <br>
      </div>
      <form method="post" name="email_frm" action="getEmails2.php">
        <table border="0" cellspacing="1" cellpadding="1" width="100%">
          <tr>
            
            <td style="width:50%;">
              <table border="0" cellspacing="1" cellpadding="1" width="100%">
                <tr>
                  <td>
                    <div id="">
                      <span>Account Type</span>
                      <select name="account_type" id="account_type" class="ser_form_component dd_style">
                        <option selected="">Both</option>
                        <option <?php if ($_REQUEST["account_type"] == "Sales") echo 'selected'; ?> value="Sales">Sales</option>
                        <option <?php if ($_REQUEST["account_type"] == "Purchasing") echo 'selected'; ?> value="Purchasing">Purchasing</option>
                      </select>
                    </div>
                    <br>
                  </td>
                </tr>
                <tr>
                  <td id="statusID_List">
                    <div id="" style="float:left;">
                      <?php
                        $status = "Select * from status ";	
                        if (($_REQUEST["account_type"] == "Both"|| $_REQUEST["account_type"] == "")) {
                        	$status .= "where (sales_flg = 0 or sales_flg = 1 or sales_flg = 2) order by sort_order";
                        }
                        elseif (($_REQUEST["account_type"] == "Sales")) {
                        	$status .= "where (sales_flg = 1 or sales_flg = 2) order by sort_order";
                        }else{	
                        	$status .= "where (sales_flg = 0 or sales_flg = 2) order by sort_order";
                        }	
						
						db_b2b();
                        $status_sql = db_query($status);
                        
                        if($_REQUEST['statusID'] == '' && $_REQUEST['statusIDurl'] != ''){
                        	$_REQUEST['statusID'] = explode(",", $_REQUEST['statusIDurl']);
                        }
                        
                        $iteration = 1;
                        while ($statusrw= array_shift($status_sql)) {
                        	$checked = "";
                        	if(isset($_REQUEST['btntool'])){}else{
                        		$checked = " checked";
                        	}
                        	if(isset($_REQUEST['statusID']) && sizeof($_REQUEST['statusID'])>0 ){
                        		if(in_array($statusrw['id'], $_REQUEST['statusID'])){
                        			$checked = " checked";
                        		}
                        	}else{
                        		if(in_array($statusrw['id'], array(24,31,33,43,44,49))){
                        			$checked = "";
                        		}
                        	}
                        	
                        	if($iteration < 18 ){
                        		echo '<input type="checkbox" name="statusID[]" value="'.$statusrw['id'].'" '.$checked.'> '. $statusrw["name"] .'<br>';
                        		$iteration++;
                        	}else{
                        		echo '</div><div>';
                        		echo '<input type="checkbox" name="statusID[]" value="'.$statusrw['id'].'" '.$checked.'> '. $statusrw["name"] .'<br>';
                        		$iteration =1;
                        
                        	}
                        }
                        ?>
                    </div>
                  </td>
                </tr>
              </table>
            </td>
            <td style="width:50%; vertical-align: top;">
              <table border="0" cellspacing="1" cellpadding="1" width="100%">
                <tr>
                  <td>Account Owner</td>
                  <td>
                    <select name="employeeID" id="employeeID">
                      <option value='All'>All</option>
                      <?php
                        $d = "Select * from employees WHERE status LIKE 'ACTIVE' ORDER BY name ASC";
                        db_b2b();
						$result = db_query($d);
                        while ($row = array_shift($result)) 
                        {
                        	echo "<option value='";
                        	echo $row["employeeID"];
                        	if ($row["employeeID"] == $_REQUEST["employeeID"]) {
                        	echo "' selected >";
                        	} else {
                        	echo "'>";
                        	}
                        	echo $row["name"] . "</option>";
                        }
                        ?>
                      <option value='No Owner' <?php if ($_REQUEST["employeeID"] == "No Owner") { echo " selected "; }?>>No Owner</option>
                      <option value='Inactive Owner'  <?php if ($_REQUEST["employeeID"] == "Inactive Owner") { echo " selected "; }?>>Inactive Owner</option>
                    </select>
                  </td>
                  <td style="padding-left: 20px;">Industry</td>
                  <td>
                    <?php //echo "-----".$_REQUEST["account_type"]; ?>
                    <select size="1" name="industry_id" id="industry_id" style="width:200px;" onchange="industry_chg(); return false;">
                      <option value="All">All</option>
                      <?php
                        $sql_parentrec = "Select * from industry_master where active_flg = 1 ";
                        if (($_REQUEST["account_type"] == "Both" || $_REQUEST["account_type"] == "")) {
                        	$sql_parentrec .= " order by sort_order";
                        }
                        elseif (($_REQUEST["account_type"] == "Sales")) {
                        	$sql_parentrec .= "and sellto_flg = 1 order by sort_order";
                        }else{	
                        	$sql_parentrec .= "and sellto_flg = 0 order by sort_order";
                        }
						db_b2b();
                        $view_parentrec = db_query($sql_parentrec);
                        while ($rec_parentrec = array_shift($view_parentrec)) {
                        	echo "<option value='" . $rec_parentrec["industry_id"] . "' " ;
                        	if ($rec_parentrec["industry_id"] == $_REQUEST["industry_id"])
                        		echo " selected ";
                        	echo " >" . $rec_parentrec["industry"] . "</option>";
                        }
                        ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td >State</td>
                  <td>
                    <select name="state" id="state">
                      <option value="All" >All</option>
                      <?php
                        $tableedit  = "SELECT * FROM zones where zone_country_id in (223,38,37) ORDER BY zone_country_id desc, zone_name";
                        db_b2b();
						$dt_view_res = db_query($tableedit);
                        while ($row = array_shift($dt_view_res)) {
                        ?>
                      <option 
                        <?php 
                          if ((trim($row["zone_name"]).",".trim($row["zone_code"])) == $_REQUEST["state"]) 
                          	echo " selected ";
                            ?> value="<?php echo trim($row["zone_name"]).",".trim($row["zone_code"])?>">
                        <?php echo $row["zone_name"]?>
                        (<?php echo $row["zone_code"]?>)
                      </option>
                      <?php
                        }
                        ?>
                    </select>
                  </td>
                  <td style="padding-left: 20px;">Territory</td>
                  <td>
                    <select name="territory" id="territory">
                      <option value="All">All</option>
                      <option <?php if ($_REQUEST["territory"] == "Canada East") echo 'selected'; ?> >Canada East</option>
                      <option <?php if ($_REQUEST["territory"] == "East") echo 'selected'; ?> >East</option>
                      <option <?php if ($_REQUEST["territory"] == "South") echo 'selected'; ?> >South</option>
                      <option <?php if ($_REQUEST["territory"] == "Midwest") echo 'selected'; ?> >Midwest</option>
                      <option <?php if ($_REQUEST["territory"] == "North Central") echo 'selected'; ?> >North Central</option>
                      <option <?php if ($_REQUEST["territory"] == "South Central") echo 'selected'; ?> >South Central</option>
                      <option <?php if ($_REQUEST["territory"] == "Canada West") echo 'selected'; ?> >Canada West</option>
                      <option <?php if ($_REQUEST["territory"] == "Pacific Northwest") echo 'selected'; ?> >Pacific Northwest</option>
                      <option <?php if ($_REQUEST["territory"] == "West") echo 'selected'; ?> >West</option>
                      <option <?php if ($_REQUEST["territory"] == "Canada") echo 'selected'; ?> >Canada</option>
                      <option <?php if ($_REQUEST["territory"] == "Mexico") echo 'selected'; ?> >Mexico</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <input type="checkbox" name="duplicate_email" value="1" <?php if ($_REQUEST["duplicate_email"] == "1") echo 'checked'; ?>> Remove Duplicates
                  </td>
                  <td colspan="2">
                    <input type="checkbox" name="invalid_email" value="1" <?php if ($_REQUEST["invalid_email"] == "1") echo 'checked'; ?>> Remove Invalid Emails
                  </td>
                </tr>
                <tr>
                  <td colspan="4">
                    <input type="submit" name="btntool" id="btntool" value="Search" />
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </form>
      <div ><i>Note: Please wait until you see <font color="red">"END OF REPORT"</font> at the bottom of the report, before using the sort option.</i></div>
      <br>
      <?php
               
        $MGArray = "";
        $cond="";
        if((isset($_REQUEST["account_type"])) && ($_REQUEST["account_type"]!="")){
        	if($_REQUEST["account_type"]=="Both"){
        		$cond=" ";
        	}
        	if($_REQUEST["account_type"]=="Sales"){
        		$cond=" and haveNeed='Need Boxes'";
        	}
        	if($_REQUEST["account_type"]=="Purchasing"){
        		$cond=" and haveNeed='Have Boxes'";
        	}
        }else{
        	$cond=" ";
        }
        
        if (isset($_REQUEST["employeeID"]))
        {
        	if ($_REQUEST["employeeID"] == 'All'){
        		//$cond.=" and  assignedto != ''";
        	} else if ($_REQUEST["employeeID"] == 'No Owner'){
        		$cond .= " and  assignedto = ''";
        	} else if ($_REQUEST["employeeID"] == 'Inactive Owner'){
        		
        	}else{
        		$cond.=" and assignedto = '". $_REQUEST["employeeID"]."'";
        	}
        }
        else{
        	//$cond.=" and  assignedto = ''";
        }
        
        //
        if (isset($_REQUEST["statusID"]))
        {
        	if (count($_REQUEST["statusID"]) > 0 ){
        		$idlist = implode(",", $_REQUEST["statusID"]);
        		$cond.=" and companyInfo.status IN (". $idlist .")";
        
        	}	
        }
        else{
        	//$cond.=" and  status = ''";
        }
        
        
        //
        if (isset($_REQUEST["industry_id"]))
        {
        	if ($_REQUEST["industry_id"] == 'All'){
        			//$cond.=" and  industry_id = ''";
        	}
        	else{
        		$cond.=" and industry_id = '". $_REQUEST["industry_id"]."'";
        	}
        }
        else{
        	//$cond.=" and  industry_id = ''";
        }
        //
        if($_REQUEST["state"] == "")
        {
        	$state = ""; 
        }
        else
        {       
        	if($_REQUEST["state"] == "All")
        	{
        		$tableedit  = "SELECT zone_name,zone_code FROM zones where zone_country_id in (223,38) ORDER BY zone_country_id, zone_code";
        		db_b2b();
				$dt_view_res = db_query($tableedit);
        		while ($row = array_shift($dt_view_res)) 
        		{
        			$zone_name .= $row ["zone_name"].",".$row ["zone_code"].",";
        			$zone_code .= $row ["zone_code"].",";
        		}
        
        		$lines = rtrim($zone_name,',');
        		$lines_c = rtrim($zone_code,',');
        		//echo $lines;
        		$lines = explode(",",$lines);
        		$lines_c = explode(",",$lines_c);
        		$state_val=$lines_c;
        	}
        	else
        	{
        		$lines = explode(",",$_REQUEST["state"]);
        		$lines_c = explode(",",$_REQUEST["state"]);
        		$state_val=$lines_c[1];
        	}
        
        	foreach($lines as $line)
        	{
        	  $items = explode(",","'".$line."'");
        	  $values[] = $items[0];
        	}
        	//
        	
        	//		
        	$state_1 = implode(",", $values);
        	if($_REQUEST["state"] != "All")
        	{
        		$state = " and state in(".$state_1.")";
        	}	
        	//echo $state;
        }
        //
        $display="yes";
        $canada_east=array('NB', 'NF', 'NS','ON', 'PE', 'QC');
        $east=array('ME','NH','VT','MA','RI','CT','NY','PA','MD','VA','WV','NJ','DC','DE'); //14
        $south=array('NC','SC','GA','AL','MS','TN','FL');
        $midwest=array('MI','OH','IN','KY');
        $north_central=array('ND','SD','NE','MN','IA','IL','WI');
        $south_central=array('LA','AR','MO','TX','OK','KS','CO','NM');
        $canada_west=array('AB', 'BC', 'MB', 'NT', 'NU', 'SK', 'YT');
        $pacific_northwest=array('WA','OR','ID','MT','WY','AK');
        $west=array('CA','NV','UT','AZ','HI');
        $canada=array();
        $mexico=array('AG','BS','CH','CL','CM','CO','CS','DF','DG','GR','GT','HG','JA','ME','MI','MO','NA','NL','OA','PB','QE','QR','SI','SL','SO','TB','TL','TM','VE','ZA');
        //
        $territory=$_REQUEST["territory"];
        if(($_REQUEST["territory"]!="All") && ($_REQUEST["state"]=="All")){
        	if($territory=="Canada East")
        	{
        		foreach($canada_east as $canada_east1)
        		{
        		  $items = explode(",","'".$canada_east1."'");
        		  $values1[] = $items[0];
        		}
        		$states = implode(",", $values1);
        		$state = " and state in(".$states.")";
        	}
        	if($territory=="East")
        	{
        		foreach($east as $east1)
        		{
        		  $items = explode(",","'".$east1."'");
        		  $values1[] = $items[0];
        		}
        		$states = implode(",", $values1);
        		$state = " and state in(".$states.")";
        	}
        	if($territory=="South")
        	{
        		foreach($south as $south1)
        		{
        		  $items = explode(",","'".$south1."'");
        		  $values1[] = $items[0];
        		}
        		$states = implode(",", $values1);
        		$state = " and state in(".$states.")";
        	}
        	if($territory=="Midwest")
        	{
        		foreach($midwest as $midwest1)
        		{
        		  $items = explode(",","'".$midwest1."'");
        		  $values1[] = $items[0];
        		}
        		$states = implode(",", $values1);
        		$state = " and state in(".$states.")";
        		
        	}
        
        	if($territory=="North Central")
        	{
        		foreach($north_central as $north_central1)
        		{
        		  $items = explode(",","'".$north_central1."'");
        		  $values1[] = $items[0];
        		}
        		$states = implode(",", $values1);
        		$state = " and state in(".$states.")";
        	}
        	if($territory=="South Central")
        	{
        		foreach($south_central as $south_central1)
        		{
        		  $items = explode(",","'".$south_central1."'");
        		  $values1[] = $items[0];
        		}
        		$states = implode(",", $values1);
        		$state = " and state in(".$states.")";
        		
        	}
        	if($territory=="Canada West")
        	{
        		foreach($canada_west as $canada_west1)
        		{
        		  $items = explode(",","'".$canada_west1."'");
        		  $values1[] = $items[0];
        		}
        		$states = implode(",", $values1);
        		$state = " and state in(".$states.")";
        	}
        	if($territory=="Pacific Northwest")
        	{
        		foreach($pacific_northwest as $pacific_northwest1)
        		{
        		  $items = explode(",","'".$pacific_northwest1."'");
        		  $values1[] = $items[0];
        		}
        		$states = implode(",", $values1);
        		$state = " and state in(".$states.")";
        		
        	}
        	if($territory=="West")
        	{
        		foreach($west as $west1)
        		{
        		  $items = explode(",","'".$west1."'");
        		  $values1[] = $items[0];
        		}
        		$states = implode(",", $values1);
        		$state = " and state in(".$states.")";
        
        	}
        	if($territory=="Canada")
        	{
        		foreach($canada as $canada1)
        		{
        		  $items = explode(",","'".$canada1."'");
        		  $values1[] = $items[0];
        		}
        		$states = implode(",", $values1);
        		//$state = " and state in(".$states.")";
        		
        	}
        	if($territory=="Mexico")
        	{
        		foreach($mexico as $mexico1)
        		{
        		  $items = explode(",","'".$mexico1."'");
        		  $values1[] = $items[0];
        		}
        		$states = implode(",", $values1);
        		$state = " and state in(".$states.")";
        	}
        }//
        
        if ( isset($_REQUEST['btntool']) || ($_REQUEST["sorting"] == "yes")){
        	//
        	if (isset($_REQUEST["sorting"]) == 'yes')
        	{
        		$x = "Select ID, contact, company, lower(email) as email, state, industry_id, assignedto, assignedto from companyInfo where email !='0' and contact!='0' and email !='' and (contact!='' or contact!=' ') ".$cond." ".$state." order by " .$_REQUEST["sort"]." ".$_REQUEST["sort_order_pre"]."";
        	} else if ($_REQUEST["employeeID"] == 'Inactive Owner'){
        		$x = "Select ID, contact, company, lower(companyInfo.email) as email, state, industry_id, assignedto, assignedto from companyInfo inner join employees on employees.employeeID = companyInfo.assignedto where employees.status = 'Inactive' and companyInfo.email !='0' and contact!='0' and companyInfo.email !='' and contact!='' and contact!='  ' ".$cond." ".$state." order by contact asc";
        	}else {
        		$x = "Select ID, contact, company, lower(email) as email, state, industry_id, assignedto, assignedto from companyInfo where email !='0' and contact!='0' and email !='' and contact!='' and contact!='  ' ".$cond." ".$state." order by contact asc";
        	}
        	//
        	
        	$sort_url="getEmails2.php?account_type=".$_REQUEST['account_type']."&statusIDurl=".$idlist."&employeeID=".$_REQUEST['employeeID']."&state=".$_REQUEST['state']."&territory=".$_REQUEST['territory']."&industry_id=".$_REQUEST['industry_id']."&duplicate_email=".$_REQUEST['duplicate_email']."&invalid_email=".$_REQUEST['invalid_email']."&sorting=yes&sort_order_pre=";
        	
			$ascimg = "<img src='images/sort_asc.png' width='5px' height='10px'>";
        	$descimg = "<img src='images/sort_desc.png' width='5px' height='10px'>";
        	?>		
      <table border="0" cellspacing="1" cellpadding="1" align="center" width="800" >
        <tr>
          <td class="display_title" align=center>Sr. No.</td>
          <td class="display_title" align=center>Name&nbsp;
            <a href="<?php echo $sort_url.'ASC&sort=contact';?>"><?php echo $ascimg;?></a>&nbsp;
            <a href="<?php echo $sort_url.'DESC&sort=contact';?>"><?php echo $descimg;?></a>
          </td>
          <td class="display_title" align=center>Email &nbsp;
            <a href="<?php echo $sort_url.'ASC&sort=email';?>"><?php echo $ascimg;?></a>&nbsp;
            <a href="<?php echo $sort_url.'DESC&sort=email';?>"><?php echo $descimg;?></a>
          </td>
          <td class="display_title" align=center>Company&nbsp;
            <a href="<?php echo $sort_url.'ASC&sort=ID';?>"><?php echo $ascimg;?></a>&nbsp;
            <a href="<?php echo $sort_url.'DESC&sort=ID';?>"><?php echo $descimg;?></a>
          </td>
          <td class="display_title" align=center>Rep&nbsp;
            <a href="<?php echo $sort_url.'ASC&sort=rep';?>"><?php echo $ascimg;?></a>&nbsp;
            <a href="<?php echo $sort_url.'DESC&sort=rep';?>"><?php echo $descimg;?></a>
          </td>
        </tr>
        <?php
          echo '<a href="email_csv.php"><span class="">"Click Here"</span></a> to export the table.<br><br>';
          
          if (isset($_REQUEST["sorting"]) == 'yes')
          {
          	
          	$MGArray = $_SESSION['arraydata'];
          
          	if($_GET['sort'] == "contact")
          	{
          		$MGArraysort_I = array();
          		foreach ($MGArray as $MGArraytmp) {
          			$MGArraysort_I[] = $MGArraytmp['contact'];
          			
          		}
          		if ($_GET['sort_order_pre'] == "ASC") {
          			array_multisort($MGArraysort_I,SORT_ASC,SORT_STRING,$MGArray); 
          		}
          		if ($_GET['sort_order_pre'] == "DESC") {
          			array_multisort($MGArraysort_I,SORT_DESC,SORT_STRING,$MGArray); 
          		}
          	}
          	
          	if($_GET['sort'] == "state")
          	{
          		$MGArraysort_I = array();
          		foreach ($MGArray as $MGArraytmp) {
          			$MGArraysort_I[] = $MGArraytmp['state'];
          			
          		}
          		if ($_GET['sort_order_pre'] == "ASC") {
          			array_multisort($MGArraysort_I,SORT_ASC,SORT_STRING,$MGArray); 
          		}
          		if ($_GET['sort_order_pre'] == "DESC") {
          			array_multisort($MGArraysort_I,SORT_DESC,SORT_STRING,$MGArray); 
          		}
          	}
          
          	if($_GET['sort'] == "email")
          	{
          		$MGArraysort_I = array();
          		foreach ($MGArray as $MGArraytmp) {
          			$MGArraysort_I[] = $MGArraytmp['email'];
          			
          		}
          		if ($_GET['sort_order_pre'] == "ASC") {
          			array_multisort($MGArraysort_I,SORT_ASC,SORT_STRING,$MGArray); 
          		}
          		if ($_GET['sort_order_pre'] == "DESC") {
          			array_multisort($MGArraysort_I,SORT_DESC,SORT_STRING,$MGArray); 
          		}
          	}
          
          	if($_GET['sort'] == "ID")
          	{
          		$MGArraysort_I = array();
          		foreach ($MGArray as $MGArraytmp) {
          			$MGArraysort_I[] = $MGArraytmp['company'];
          			
          		}
          		if ($_GET['sort_order_pre'] == "ASC") {
          			array_multisort($MGArraysort_I,SORT_ASC,SORT_STRING,$MGArray); 
          		}
          		if ($_GET['sort_order_pre'] == "DESC") {
          			array_multisort($MGArraysort_I,SORT_DESC,SORT_STRING,$MGArray); 
          		}
          	}
          	
          	if($_GET['sort'] == "rep")
          	{
          		$MGArraysort_I = array();
          		foreach ($MGArray as $MGArraytmp) {
          			$MGArraysort_I[] = $MGArraytmp['rep_name'];
          			
          		}
          		if ($_GET['sort_order_pre'] == "ASC") {
          			array_multisort($MGArraysort_I,SORT_ASC,SORT_STRING,$MGArray); 
          		}
          		if ($_GET['sort_order_pre'] == "DESC") {
          			array_multisort($MGArraysort_I,SORT_DESC,SORT_STRING,$MGArray); 
          		}
          	}
          	//echo "<pre>"; print_r($MGArray[2]); echo "</pre>";
          	$scnt = 1;
          	foreach ($MGArray as $srow) {
          		$name = explode(" ",ucfirst($srow["contact"]));
          ?>
        <tr>
          <td bgColor='#E4EAEB' align ='center'><?php echo $scnt;?></td>
          <td bgColor='#E4EAEB' align ='left'>			
            <?php if ($srow["contact"] != "" ) {echo $name[0]." ".$name[1];}?>
          </td>
          <td bgColor='#E4EAEB' align ='left'><?php echo $srow["email"];?></td>
          <td bgColor='#E4EAEB' align ='left'>
            <a target="_blank" href="viewCompany.php?ID=<?php echo $srow["ID"];?>"><?php echo $srow["company"];?>	
            </a>
          </td>
          <td bgColor='#E4EAEB' align ='center'><?php  echo $srow["rep_name"];	?></td>
        </tr>
        <?php
          $scnt++;
          }
          
          }else{    // else part if sorting is not clicked.
          
          $display="yes";
         
          db_b2b();
          $result = db_query($x);
          
          // To Remove duplicate Email.
          if($_REQUEST['duplicate_email'] == 1 ){
          	
          	$result = array_intersect_key($result, array_unique(array_column($result, 'email')));
          }
           
          $cnt = 1;
          while ($row = array_shift($result)) 
          {
          	$name = explode(" ",ucfirst($row["contact"]));
          	
          	if($_REQUEST["territory"]!="All" && $_REQUEST["state"]!="All")
          	{
          
          		if($territory=="Canada East")
          		{
          			if (in_array($state_val, $canada_east, TRUE)) { 
          				$state = " and state in ('".$state_val."')";
          				$display="yes";
          			}
          			else{
          				$display="no";
          			}
          
          		}
          		if($territory=="East")
          		{
          			if (in_array($state_val, $east, TRUE)) { 
          				$state = " and state in ('".$state_val."')";
          				$display="yes";
          			}
          			else{
          				$display="no";
          			}
          		}
          		if($territory=="South")
          		{
          			if (in_array($state_val, $south, TRUE)) { 
          				$state = " and state in ('".$state_val."')";
          				$display="yes";
          			}
          			else{
          				$display="no";
          			}
          		}
          		if($territory=="Midwest")
          		{
          			if (in_array($state_val, $midwest, TRUE)) { 
          				$state = " and state in ('".$state_val."')";
          			}
          			else{
          				$display="no";
          			}
          		}
          		if($territory=="North Central")
          		{
          			if (in_array($state_val, $north_central, TRUE)) { 
          				$state = " and state in ('".$state_val."')";
          				$display="yes";
          			}
          			else{
          				$display="no";
          			}
          		}
          		if($territory=="South Central")
          		{
          			if (in_array($state_val, $south_central, TRUE)) { 
          				$state = " and state in ('".$state_val."')";
          				$display="yes";
          			}
          			else{
          				$display="no";
          			}
          		}
          		if($territory=="Canada West")
          		{
          			if (in_array($state_val, $canada_west, TRUE)) { 
          				$state = " and state in ('".$state_val."')";
          				$display="yes";
          			}
          			else{
          				$display="no";
          			}
          		}
          		if($territory=="Pacific Northwest")
          		{
          			if (in_array($state_val, $pacific_northwest, TRUE)) { 
          				$state = " and state in ('".$state_val."')";
          				$display="yes";
          			}
          			else{
          				$display="no";
          			}
          		}
          		if($territory=="West")
          		{
          			if (in_array($state_val, $west, TRUE)) { 
          				$state = " and state in ('".$state_val."')";
          				$display="yes";
          			}
          			else{
          				$display="no";
          			}
          		}
          		if($territory=="Canada")
          		{
          			if (in_array($state_val, $canada, TRUE)) { 
          				$state = " and state in ('".$state_val."')";
          			}
          			else{
          				$display="no";
          			}
          		}
          		if($territory=="Mexico")
          		{
          			if (in_array($state_val, $mexico, TRUE)) { 
          				$state = " and state in ('".$state_val."')";
          				$display="yes";
          			}
          			else{
          				$display="no";
          			}
          		}
          	}else{
          		$display = "yes";
          	}
          
          	if($_REQUEST['invalid_email'] == 1 ){
          		$email_chk = validEmail($row["email"]);
          		if ($email_chk != 1){
          			$display = "no";
          		}
          	}	
          	//echo "display " . $row["email"] . " " . $display . "<br>";
          	if ($display == "yes")
          	{
          	
          ?>
        <tr>
          <td bgColor='#E4EAEB' align ='center'>
            <?php echo $cnt;?>
          </td>
          <td bgColor='#E4EAEB' align ='left'>
            <?php if ($row["contact"] != "" ) {echo $name[0]." ".$name[1];}?>
          </td>
          <td bgColor='#E4EAEB' align ='left'>
            <?php echo $row["email"];?>
          </td>
          <td bgColor='#E4EAEB' align ='left'>
            <a target="_blank" href="viewCompany.php?ID=<?php echo $row["ID"];?>">
            <?php 
              if($row["company"] == ""){
              	$company_name = get_nickname_val($row["company"], $row["ID"]);
              }else{
              	$company_name = $row["company"];
              }
              echo $company_name;?>	
            </a>
          </td>
          <td bgColor='#E4EAEB' align ='center'>
            <?php 
              if($row["assignedto"] == ""){}else{
              	$rep_name = get_employee_initials($row["assignedto"]);
              	echo $rep_name;
              }
              ?>
          </td>
          <!-- <td bgColor='#E4EAEB' align ='left'>
            <?php
              $sql_parentrec = "Select * from industry_master where active_flg = 1 ";
              if (($_REQUEST["account_type"] == "Sales")) {
              	$sql_parentrec .= "and sellto_flg = 1 and industry_id = '" . $row["industry_id"] . "' order by sort_order";
              }else{	
              	$sql_parentrec .= "and sellto_flg = 0 and industry_id = '" . $row["industry_id"] . "' order by sort_order";
              }
              db_b2b();
              $view_parentrec = db_query($sql_parentrec);
              while ($rec_parentrec = array_shift($view_parentrec)) {
              	echo $rec_parentrec["industry"];
              }
              
              ?>
            </td>
            <td bgColor='#E4EAEB' align ='left'>
            	<?php echo $territory;?>
            </td> -->
        </tr>
        <?php
          $MGArray[] = array('ID' => $row["ID"], 'company' => $company_name, 'contact' => $row["contact"], 
          				'email' => $row["email"], 'state' => $row["state"], 
          				'assignedto' => $row["assignedto"], 'rep_name' => $rep_name );
          $cnt ++;
          }
          
          }
          
          $_SESSION['arraydata'] = $MGArray;
          
          } //sorting else part closed here.
          ?>
      </table>
    
      <div><i><font color="red">"END OF REPORT"</font></i></div>
      <?php
        }	
        ?>
    </div>
  </body>
</html>
