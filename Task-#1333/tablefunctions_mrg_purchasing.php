<?php 
   $parent_comp_id      	 = "";
   $com_haveNeed        	 = "";
   $pidresultd          	 = "";
   $com_haveNeed        	 = "";
   $pidresult           	 = "";
   $opt_out_mkt_email   	 = "";
   $tmpstr              	 = "";
   $gayl_box_dimensions 	 = "";
   $opt_out_mkt_email   	 = "";
   $sup_box_size_id          = "";
   $supersack_box_dimensions = "";
   $p_box_size_id            = "";
   $s_box_size_id            = "";
?>
<script language="JavaScript" src="inc/general.js"></SCRIPT>
<script language="JavaScript">
   //<!--
   function formCheckInv()
   {
   
   	if (validateEmail(document.frmselltoedit.selltoemail.value) == false)
   	{
   		alert('Please enter a valid email address.');
   		return false;
   	}
   }
   
   function formCheckInvShip()
   {
   
   	if (validateEmail(document.frmshiptoedit.shiptoemail.value) == false)
   	{
   		alert('Please enter a valid email address.');
   		return false;
   	}
   }
   
   function parent_ch_chg(){
   	var parent_child_txt = document.getElementById("parent_child").value;
   	
   	if(parent_child_txt == "Child")
   	{
   		parent_child_td.style.display = "block"; 
   	}
   }
   
   function industry_chg(){
   	var industry_txt = document.getElementById("industry_id").value;
   	
   	if(industry_txt == 13 || industry_txt == 19)
   	{
   		industry_txt_td.style.display = "block"; 
   	}else{
   		industry_txt_td.style.display = "none"; 
   	}
   }
   
   function formCheckInv_billto()
   {
   
   	if (validateEmail(document.frmbilltoedit.billtoemail.value) == false)
   	{
   		alert('Please enter a valid email address.');
   		return false;
   	}
   }
   
   function validateEmail(email) { 
       var regexva = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
       if (email != '')
   	{
   		return regexva.test(email);
   	}else{
   		return true;
   	}
   } 
   
   //-->
   	
   //
   	//Ship edit
   	function updateShipBoxRescueEditnew(mainid, ctrlid, recid)
   	{ 
   		//
   		var s_length="", s_width="", s_height="";
   		var ship_length = document.getElementsByName('ship_length[]');
   		var ship_width = document.getElementsByName('ship_width[]');
   		var ship_height = document.getElementsByName('ship_height[]');
     			for (var i = 0, iLen = ship_length.length; i < iLen; i++) {
       			s_length+=ship_length[i].value+"-";
     			}
   		for (var i = 0, iLen = ship_width.length; i < iLen; i++) {
   				s_width+=ship_width[i].value+"-";
     			}
   		for (var i = 0, iLen = ship_height.length; i < iLen; i++) {
   				s_height+=ship_height[i].value+"-";
     			}
   		
   		//
   		var compid = document.getElementById("comp_id").value;
   		//alert(compid);
   		var shipping_box_id = document.getElementById("shipping_box_id").value;
   		
   		var wall = document.getElementById("wall"+ctrlid).value;
   		var box_condition = document.getElementById("box_condition"+ctrlid).value;
   		var req_another_box = document.getElementById("req_another_box"+ctrlid).value;
   		var frequency = document.getElementById("frequency"+ctrlid).value;
   		var quantity = document.getElementById("quantity"+ctrlid).value;
   		var s_box_size_id = document.getElementById("s_box_size_id").value;
   		
   		//frequency = document.getElementById("frequency"+ctrlid).value;
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
   			  // alert(xmlhttp.responseText);
   			
   			document.getElementById("divBoxShipRescue_child"+mainid).style.display = 'block';
   			document.getElementById("divBoxShipRescue_child_edit"+mainid).style.display = 'none';
   			$("#divBoxShipRescue_child"+mainid).load(window.location.href + " #divBoxShipRescue_child"+mainid);
   		  }
   		}
   
   		xmlhttp.open("POST","editTables_dynamic_new_purchasing.php?boxrescue_edit=yes&companyid="+compid+"&shipping_box_id="+shipping_box_id+"&ctrlid="+ctrlid+"&wall="+wall+"&box_condition="+box_condition+"&req_another_box="+req_another_box+"&frequency="+frequency+"&quantity="+quantity+"&s_box_size_id="+s_box_size_id+"&s_length="+s_length+"&s_width="+s_width+"&s_height="+s_height,true);			
   		xmlhttp.send();
   	}
   	//
   	
   //
   	function validates()
   	{
   		var txt11=document.getElementById("industry_id").value;
   		if (txt11=="")				  	
   		{
   			alert("Please select Industry");
   			return false;
   		}
   
   		
   		var link_id_txt = document.getElementById("link_id_txt").value;
   		var b2b_id = document.getElementById("b2b_id").value;
   		
   		if (link_id_txt != ""){
   			if (link_id_txt == b2b_id){
   				alert("Link ID = B2B ID, not allowed.");
   				return false;
   			}
   		}
   
   		if(document.getElementById("parent_child").value==""){
   			alert("Data is saved, but you need to setup the Parent/Child.");
   		}
   		return true;
   	}
</script>
<?php
   function viewCompany( string $company, string $industry, string $website, string $preparer, string $howHear, string $help, int $ID, int $overall_revenue_comp, string $noof_location, string $nickname, string $createddt, string $loopurl, string $parent_child, int $parent_comp_id, string $haveNeed, int $industry_id, string $industry_other, int $loopid, string $internal_external, string $comp_abbrv, string $publicity, string $link_sales_id, int $link_purchasing_id, mixed $style_tbl, mixed $style_tbl_tr, mixed $sales_purc_team_ignore_com, mixed $last_date): void
   {	
   	
   	$website = "http://" . $website;
   	if ($parent_child == 'Child') {
   		$parent_comp_nm = get_nickname_val($company, $parent_comp_id);
   		
   	}
   	//echo $loopurl."<br>";
   	$newurl="viewComp_info.php?".$loopurl."&Edit=1&show=companyinfo";
   	?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
   /*Tooltip style*/
   .tooltip {
   position: relative;
   display: inline-block;
   }
   .tooltip .tooltiptext {
   visibility: hidden;
   width: 250px;
   background-color: #464646;
   color: #fff;
   text-align: left;
   border-radius: 6px;
   padding: 5px 7px;
   position: absolute;
   z-index: 1;
   top: -5px;
   left: 110%;
   /*white-space: nowrap;*/
   font-size: 12px;
   font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif!important;
   }
   .tooltip .tooltiptext::after {
   content: "";
   position: absolute;
   top: 35%;
   right: 100%;
   margin-top: -5px;
   border-width: 5px;
   border-style: solid;
   border-color: transparent black transparent transparent;
   }
   .tooltip:hover .tooltiptext {
   visibility: visible;
   }
   .fa-info-circle{
   font-size: 9px;
   color: #767676;
   }
</style>
<table border="0" width="100%" cellspacing="1" cellpadding="1" class="<?php echo $style_tbl;?>">
   <tr align="center" class="<?php echo $style_tbl_tr;?>">
      <td colspan="2" bgcolor="#C0CDDA" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">COMPANY INFO </font>
         <font face="Arial, Helvetica, sans-serif" size="1" color="#C0CDDA"><a href="#" onClick="comp_geturl('<?php echo $newurl; ?>');"><img bgcolor="#C0CDDA" src="images/edit.jpg"></a></font>
      </td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td height="13" width="40%"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Company Name (Legal Name)</font></td>
      <td align="left" width="60%" height="13"><font face="Arial, Helvetica, sans-serif" size="1">
         <?php echo $company?></font>
      </td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Company Nickname – City, ST</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1">
         <?php echo $nickname?></font>
      </td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Company Abbreviation</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1">
         <?php echo $comp_abbrv?></font>
      </td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">B2B ID#</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1">
         <?php echo $ID?></font>
      </td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">LOOP ID#</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1">
         <?php echo $loopid?></font>
      </td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Parent/Child Flag</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1"><?php echo $parent_child;?></font>
      </td>
   </tr>
   <?php if ($parent_child == 'Child') { ?>
   <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Parent Company</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1">
         <?php $parent_comp_nm = ""; ?>
		 <a href="http://loops.usedcardboardboxes.com/viewCompany.php?ID=<?php echo $parent_comp_id?>" target="_blank"><?php echo $parent_comp_nm; ?></a>
         </font>
      </td>
   </tr>
   <?php } ?>
   <tr bgcolor="#E4E4E4">
      <?php
         if($haveNeed=="Have Boxes"){
         	//sales
         	$com_haveNeed="Need Boxes";
         	$link_id=$link_sales_id;
         	$txt="sales";
         }
         if($haveNeed=="Need Boxes"){
         	//purchasing
         	$com_haveNeed="Have Boxes";
         	$link_id=$link_purchasing_id;
         	$txt="purchasing";
         }
         ?>
		 <?php $txt = ""; ?>
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Link to <?php echo $txt?> record</font></td>
      <td align="left" height="13">
         <font face="Arial, Helvetica, sans-serif" size="1">
         <?php
            $linkcomp_query="select ID, link_sales_id, link_purchasing_id, landing_pg_enter_by from companyInfo where ID=".$ID;
            
            db_b2b();
            $linkcomp_res=db_query($linkcomp_query);
            
            $linkcomp_row=array_shift($linkcomp_res);
            
            $landing_pg_enter_by = $linkcomp_row["landing_pg_enter_by"];
            
            if($haveNeed=="Have Boxes"){
            	$link_id=$linkcomp_row["link_sales_id"];
            }
            if($haveNeed=="Need Boxes"){
            	$link_id=$linkcomp_row["link_purchasing_id"];
            }
            //
			$link_id = "";
            $sql_parentrec = "Select parent_comp_id,shipState, shipCity, company from companyInfo where ID = '" . $link_id . "'";
            $comp_link = "";
            
            db_b2b();
            $view_parentrec = db_query($sql_parentrec);
            
            while ($rec_parentrec = array_shift($view_parentrec)) {
            	//$comp_link = $rec_parentrec["company"];
            	$tmppos_1 = strpos($rec_parentrec["company"], "-");
            	if($tmppos_1 != false)
            	{
            		$comp_link = $rec_parentrec["company"];
            	}else {
            		if ($rec_parentrec["shipCity"] <> "" || $rec_parentrec["shipState"] <> "" ) 
            		{
            			$comp_link = $rec_parentrec["company"] . " - " . $rec_parentrec["shipCity"] . ", " . $rec_parentrec["shipState"] ;
            		}else { $comp_link = $rec_parentrec["company"]; }
            	}
            }
            //
            ?>
         <a href="http://loops.usedcardboardboxes.com/viewCompany.php?ID=<?php echo $link_id?>" target="_blank">
         <?php echo $comp_link;
            ?></a>
         </font>
      </td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Industry</font></td>
      <td align="left" height="13">
         <font face="Arial, Helvetica, sans-serif" size="1">
         <?php
            $sellto_flg = 1;
            if($haveNeed == "Have Boxes") {
            	$sellto_flg = 0;
            }
            if ($industry_id != ""){
            	$sql_parentrec = "Select industry from industry_master where active_flg = 1 and sellto_flg = " . $sellto_flg . " and industry_id = '" . $industry_id."'";
            	
            	db_b2b();
            	$view_parentrec = db_query($sql_parentrec);
            
            	while ($rec_parentrec = array_shift($view_parentrec)) {
            		echo $rec_parentrec["industry"];
            	}
            	if ($industry_other != ""){
            		echo ":&nbsp;" . $industry_other;
            	}	
            }	
            ?>
         </font>
      </td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Website
         </font>
      </td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
         <a href="<?php echo $website?>" target="_blank"><?php echo $website?></a></font>
      </td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Overall Revenue of company (if published)</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
         <?php echo $overall_revenue_comp?></font>
      </td>
   </tr>
   <?php if ($parent_child == 'Parent') { ?>
   <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Number of locations in the US</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
         <?php echo $noof_location?></font>
      </td>
   </tr>
   <?php } ?>
   <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">UCB Qualifier</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
         <?php echo $preparer?></font>
      </td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Internal/External</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
         <?php if ($internal_external == "internal") echo "Internal";?>
         <?php if ($internal_external == "external") echo "External";?>
         </font>
      </td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">How did they hear about UCB?</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
         <?php echo $howHear?></font>
      </td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Reason For Contact</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
         <?php echo $help?></font>
      </td>
   </tr>
   <?php
      $created_by = "";
      $sql_parentrec = "Select name from employees where employeeID = '" . $landing_pg_enter_by . "'";
      
      db_b2b();
      $view_parentrec = db_query($sql_parentrec);
      
      while ($rec_parentrec = array_shift($view_parentrec)) {
      	$created_by = $rec_parentrec["name"];
      }
      ?>
   <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Record Created by</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
         <?php echo $created_by?></font>
      </td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Record Created on</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
         <?php echo $createddt?></font>
      </td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Last Contacted</font></td>
      <td align="left" height="13"><?php
         $last_date_days = 0; $last_date_days_color = "#333333";
         if ($last_date != ""){
         	$last_date_days = round((strtotime(date("Y-m-d")) - strtotime($last_date)) / (60 * 60 * 24));
         	if ($last_date_days > 90) {
         		$last_date_days_color = "red";
         	}	
         }	?>
         <font face="Arial, Helvetica, sans-serif" size="1" color="<?php echo $last_date_days_color;?>">
         <?php
            if ($last_date != "" && $last_date != "1969-12-31" && $last_date != "0000-00-00"){
            	echo date("m/d/Y", strtotime($last_date)) . " (" . $last_date_days . " days ago)";
            }else{
            	echo "Never Contacted (" . $last_date_days . " days ago)";
            }				
            	?></font>
      </td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Name Dropping</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
         <?php echo $publicity?></font>
      </td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td height="13">
         <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Hide From Call Lists?</font>
         <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
            <span class="tooltiptext">
            Check this box if we do not want this account showing on the Call List Reports, as to prevent any new reps from accidentally calling this account.
            </span>
         </div>
      </td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
         <?php if ($sales_purc_team_ignore_com == 1) {echo "Yes";} else {echo "No";}?></font>
      </td>
   </tr>
</table>
<?php
   }
   
   function viewCompanyEdit(string $company, string $industry, string $website, string $preparer, string $howHear, string $help, int $ID, int $overall_revenue_comp, string $noof_location, string $nickname, string $createddt, string $loopurl , string $parent_child, int $parent_comp_id, string $haveNeed, int $industry_id, string $industry_other, int $loopid, string $internal_external, string $comp_abbrv, string $publicity, int $link_sales_id, int $link_purchasing_id, string $style_tbl, string $style_tbl_tr, string $sales_purc_team_ignore_com, string $last_date):void
   {
   ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
   /*Tooltip style*/
   .tooltip {
   position: relative;
   display: inline-block;
   }
   .tooltip .tooltiptext {
   visibility: hidden;
   width: 250px;
   background-color: #464646;
   color: #fff;
   text-align: left;
   border-radius: 6px;
   padding: 5px 7px;
   position: absolute;
   z-index: 1;
   top: -5px;
   left: 110%;
   /*white-space: nowrap;*/
   font-size: 12px;
   font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif!important;
   }
   .tooltip .tooltiptext::after {
   content: "";
   position: absolute;
   top: 35%;
   right: 100%;
   margin-top: -5px;
   border-width: 5px;
   border-style: solid;
   border-color: transparent black transparent transparent;
   }
   .tooltip:hover .tooltiptext {
   visibility: visible;
   }
   .fa-info-circle{
   font-size: 9px;
   color: #767676;
   }
   .requir_text{
   font-size: 12px;
   font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
   margin-bottom: 4px;
   color: #CF0003;
   font-style: italic;
   }
</style>
<form method=post name="frm" id="frm" action="editTables_mrg_purchasing.php" onsubmit="return validates()">
   <table border="0" cellspacing="1" cellpadding="1" class="<?php echo $style_tbl;?>">
      <tr align="center" class="<?php echo $style_tbl_tr;?>">
         <td colspan="2" bgcolor="#C0CDDA" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">COMPANY INFO</font></td>
      </tr>
      <tr bgcolor="#E4E4E4">
         <td height="13" width="40%" colspan="2" >
            <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
               <div class="requir_text">* = Required Field</div>
         </td>
      </tr>
      <tr bgcolor="#E4E4E4">
      <td height="13" width="40%" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Company Name (Legal Name)</font></td>
      <td align="left" width="60%" height="13"><font face="Arial, Helvetica, sans-serif" size="1">
      <input size="30" type=text name="company" value="<?php echo $company?>"></font></td>
      </tr>
      <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Company Nickname – City, ST</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1">
      <input size="30" type=text name="nickname" value="<?php echo $nickname?>"></font></td>
      </tr>
      <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Company Abbreviation</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1">
      <input size="30" type=text name="comp_abbrv" value="<?php echo $comp_abbrv?>"></font></td>
      </tr>
      <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">B2B ID#</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1">
      <?php echo $ID?></font></td>
      </tr>
      <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">LOOP ID#</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1">
      <?php echo $loopid?></font></td>
      </tr>
      <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Parent/Child Flag</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1">
      <select size="1" name="parent_child" id="parent_child" onchange="parent_ch_chg(this.value); return false;" >
      <option value="" <?php if ($parent_child == '') { echo ' selected '; }?>></option>	
      <option value="Parent" <?php if ($parent_child == 'Parent') { echo ' selected '; }?>>Parent</option>	
      <option value="Child" <?php if ($parent_child == 'Child') { echo ' selected '; }?>>Child</option>	
      </select>
      </font><br>
      <?php  if ($parent_child == 'Child') {?>
      <div id="parent_child_td" >
      <?php  } else {?>
      <div id="parent_child_td" style="display:none;">
      <?php  } ?>
      <font face="Arial, Helvetica, sans-serif" size="1">Select Parent Company: 
      <select size="1" name="parent_child_sel" id="parent_child_sel" style="width:200px;">
      <option value="0">Select One</option>
      <?php
         $sql_parentrec = "Select ID,company, shipCity, shipState, nickname from companyInfo where active = 1 and status <> '31' and company <> '' and parent_child = 'Parent' order by company";
         
         db_b2b();
         $view_parentrec = db_query($sql_parentrec);
         
         while ($rec_parentrec = array_shift($view_parentrec)) {
         	$nickname = "";
         	if ($rec_parentrec["nickname"] != "") {
         		$nickname = $rec_parentrec["nickname"];
         	}else {
         		$tmppos_1 = strpos($rec_parentrec["company"], "-");
         		if ($tmppos_1 != false)
         		{
         			$nickname = $rec_parentrec["company"];
         		}else {
         			if ($rec_parentrec["shipCity"] <> "" || $rec_parentrec["shipState"] <> "" ) 
         			{
         				$nickname = $rec_parentrec["company"] . " - " . $rec_parentrec["shipCity"] . ", " . $rec_parentrec["shipState"] ;
         			}else { $nickname = $rec_parentrec["company"]; }
         		}
         	}
         
         	echo "<option value='" . $rec_parentrec["ID"] . "' " ;
         	if ($rec_parentrec["ID"] == $parent_comp_id)
         		echo " selected ";
         	echo " >" . $nickname . "</option>";
         }
         ?>
      </select></font>
      </div>
      </td>
      </tr>
      <tr bgcolor="#E4E4E4">
      <?php
         if($haveNeed=="Have Boxes"){
         	//sales
         	$com_haveNeed="Need Boxes";
         	$link_id=$link_sales_id;
         	$txt="sales";
         }
         if($haveNeed=="Need Boxes"){
         	//purchasing
         	$com_haveNeed="Have Boxes";
         	$link_id=$link_purchasing_id;
         	$txt="purchasing";
         }
         ?>
      <td><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Link to <?php echo $txt?> record</font></td>
      <td align="left" height="13">
      <font face="Arial, Helvetica, sans-serif" size="1">
      <?php
         //echo $haveNeed."--".$com_haveNeed;
         $compsql = "SELECT parent_child, parent_comp_id,loopid FROM companyInfo Where ID =" . $ID;
         
         db_b2b();
         $comp_result = db_query($compsql);	
         
         while ($comp_row = array_shift($comp_result)) {
         	$parent_child = $comp_row["parent_child"];
         	$parent_comp_id = $comp_row["parent_comp_id"]; 
         	
         	$parent_comp_nm = "";
         	if ($comp_row["nickname"] != "") {
         		$parent_comp_nm = $comp_row["nickname"];
         	}else {
         		$tmppos_1 = strpos($comp_row["company"], "-");
         		if ($tmppos_1 != false)
         		{
         			$parent_comp_nm = $comp_row["company"];
         		}else {
         			if ($comp_row["shipCity"] <> "" || $comp_row["shipState"] <> "" ) 
         			{
         				$parent_comp_nm = $comp_row["company"] . " - " . $comp_row["shipCity"] . ", " . $comp_row["shipState"] ;
         			}else { $parent_comp_nm = $comp_row["company"]; }
         		}
         	}										
         	
         }
         //echo "parent_child - " . $parent_child ."<br>";
         $total_rec = 0;	$show_idflg=""; 
         	if ($parent_child == "Parent") {
         	$pid_qry = "SELECT ID, parent_comp_id, shipState, shipCity, company FROM companyInfo Where status <> 31 and  parent_comp_id =" . $ID . " and parent_child = 'Child' and haveNeed='".$com_haveNeed."'";
         	
         	db_b2b();
         	$pidresult = db_query($pid_qry);	
         
         	$total_rec=tep_db_num_rows($pidresult);
         	if($total_rec>0){
         
         	?>
      <select id="link_comp_id" name="link_comp_id" style="width:200px;">
      <option value="">Select</option>
      <?php
         while ($pid_row = array_shift($pidresult)) {
         	$nickname = "";
         	if ($pid_row["nickname"] != "") {
         		$nickname = $pid_row["nickname"];
         	}else {
         		$tmppos_1 = strpos($pid_row["company"], "-");
         		if ($tmppos_1 != false)
         		{
         			$nickname = $pid_row["company"];
         		}else {
         			if ($pid_row["shipCity"] <> "" || $pid_row["shipState"] <> "" ) 
         			{
         				$nickname = $pid_row["company"] . " - " . $pid_row["shipCity"] . ", " . $pid_row["shipState"] ;
         			}else { $nickname = $pid_row["company"]; }
         		}
         	}																
         	
         	//echo $pid_row["company"]."<br>";
         	?>
      <option value="<?php echo $pid_row["ID"]?>" <?php if($link_id==$pid_row["ID"]){ echo "selected"; } ?> ><?php echo $nickname ." (".$pid_row["ID"].")"; ?></option>
      <?php
         }
         ?>
      </select>
      <?php
         }
         }else {
         if ($parent_comp_id >0 ){
         	$pid_qry = "SELECT ID, parent_comp_id, shipState, shipCity, company FROM companyInfo Where status <> 31 and  parent_comp_id = '" . $parent_comp_id."' and haveNeed='".$com_haveNeed."'";
         	
         	db_b2b();
         	$pidresult = db_query($pid_qry);	
         
         	$total_rec=tep_db_num_rows($pidresult);
         }
         
         if($total_rec>0 || $parent_comp_id!=""){
         	
         ?>
      <select id="link_comp_id" name="link_comp_id" style="width:200px;">
      <option value="">Select</option>
      <?php
         //
         ?>
      <?php
         while ($pid_row = array_shift($pidresult)) {
         	
         	$nickname = "";
         	if ($pid_row["nickname"] != "") {
         		$nickname = $pid_row["nickname"];
         	}else {
         		$tmppos_1 = strpos($pid_row["company"], "-");
         		if ($tmppos_1 != false)
         		{
         			$nickname = $pid_row["company"];
         		}else {
         			if ($pid_row["shipCity"] <> "" || $pid_row["shipState"] <> "" ) 
         			{
         				$nickname = $pid_row["company"] . " - " . $pid_row["shipCity"] . ", " . $pid_row["shipState"] ;
         			}else { $nickname = $pid_row["company"]; }
         		}
         	}																
         	
         	?>
      <option value="<?php echo $pid_row["ID"]?>" <?php if($link_id==$pid_row["ID"]){ echo "selected"; } ?> ><?php echo $nickname . " (".$pid_row["ID"].")"; ?></option>
      <?php
         }?>
      </select>		
      <?php }
         }
         
         ?>
      <div style="margin-top:3px;">
      Enter ID:
      <input name="link_id_txt" type="text" id="link_id_txt" value="<?php if($show_idflg=="no"){ echo $link_id; } else{ echo "";} ?>" >
      <input type="hidden" id="b2b_id" name="b2b_id" value="<?php echo $ID; ?>" >
      <?php
         //Dispaly name
         	
         	if($link_id != ""){
         		$sql_parentrec = "Select parent_comp_id, shipState, shipCity, company from companyInfo where ID = '" . $link_id . "'";
         		$comp_link = "";
         
         		db_b2b();
         		$view_parentrec = db_query($sql_parentrec);
         
         		while ($rec_parentrec = array_shift($view_parentrec)) {
         			//$comp_link = $rec_parentrec["company"];
         			$tmppos_1 = strpos($rec_parentrec["company"], "-");
         			if ($tmppos_1 != false)
         			{
         				$comp_link = $rec_parentrec["company"];
         			}else {
         				if ($rec_parentrec["shipCity"] <> "" || $rec_parentrec["shipState"] <> "" ) 
         				{
         					$comp_link = $rec_parentrec["company"] . " - " . $rec_parentrec["shipCity"] . ", " . $rec_parentrec["shipState"] ;
         				}else { $comp_link = $rec_parentrec["company"]; }
         			}
         		}
         		//
         		?>
      <a href="http://loops.usedcardboardboxes.com/viewCompany.php?ID=<?php echo $link_id?>" target="_blank">
      <?php echo $comp_link;
         ?></a>&nbsp;<a href="http://loops.usedcardboardboxes.com/viewCompany_remove_link.php?companyid=<?php echo $ID?>" target="_blank">Delete</a>
      <?php
         }
         ?>
      </div>
      </font>
      </td>
      </tr>
      <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Industry <span  class="requir_text">*</span></font></td>
      <td align="left" height="13">
      <font face="Arial, Helvetica, sans-serif" size="1">
      <select size="1" name="industry_id" id="industry_id" style="width:200px;" onchange="industry_chg(); return false;">
      <option value="">Select one</option>
      <?php
         $sellto_flg = 1;
         if($haveNeed == "Have Boxes") {
         	$sellto_flg = 0;
         }
         $sql_parentrec = "Select * from industry_master where active_flg = 1 and sellto_flg = " . $sellto_flg . " order by sort_order";
         
         db_b2b();
         $view_parentrec = db_query($sql_parentrec);
         
         while ($rec_parentrec = array_shift($view_parentrec)) {
         	echo "<option value='" . $rec_parentrec["industry_id"] . "' " ;
         	if ($rec_parentrec["industry_id"] == $industry_id)
         		echo " selected ";
         	echo " >" . $rec_parentrec["industry"] . "</option>";
         }
         ?>
      </select>
      <div id="industry_txt_td" style="display:none;">
      <input size="30" type="text" name="industry_other" id="industry_other" value="<?php echo $industry_other?>">
      </div>
      </font>
      </td>
      </tr>
      <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Website
      </font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
      <input size="30" type=text name="website" value="<?php echo $website?>"></font></td>
      </tr>
      <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Overall Revenue of company (if published)</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
      <input size="30" type=text name="overall_revenue_comp" value="<?php echo $overall_revenue_comp?>"></font></td>
      </tr>
      <?php if ($parent_child == 'Parent') { ?>
      <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Number of locations in the US</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
      <input size="30" type=text name="noof_location" value="<?php echo $noof_location?>" ></font></td>
      </tr>
      <?php } ?>
      <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">UCB Qualifier</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
      <input size="30" type=text name="preparer" value="<?php echo $preparer?>" ></font></td>
      </tr>
      <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Internal/External</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
      <select size="1" name="internal_external">
      <option value="">Select one</option>	
      <option value="internal" <?php if ($internal_external == "internal") echo " selected ";?>>Internal</option>	
      <option value="external" <?php if ($internal_external == "external") echo " selected ";?>>External</option>	
      </td>
      </tr>
      <tr bgcolor="#E4E4E4">
      <td height="13">
      <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">How did they hear about UCB?</font></td>
      <td align="left" height="13"><select size="1" name="howHear">
      <option value="">Select one</option>
      <?php
         $howH = "Select * from howHear";
         
         db_b2b();
         $dt_view_res2 = db_query($howH);
         
         while ($hh = array_shift($dt_view_res2)) {
         
         echo "<option ";
         if ($hh["name"] == $howHear)
         	echo " selected ";
         echo " >" . $hh["name"] . "</option>";
         }
         ?>
      </select></td>
      </tr>
      <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
      Reason for Contact</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
      <textarea rows="5" cols="22" name="help"><?php echo $help?></textarea></font></td>
      </tr>
      <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
      Record Created on</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
      <?php echo $createddt; ?></font></td>
      </tr>
      <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Last Contacted</font></td>
      <td align="left" height="13"><?php
         $last_date_days = 0; $last_date_days_color = "#333333";
         if ($last_date != ""){
         	$last_date_days = round((strtotime(date("Y-m-d")) - strtotime($last_date)) / (60 * 60 * 24));
         	if ($last_date_days > 90) {
         		$last_date_days_color = "red";
         	}	
         }	?>
      <font face="Arial, Helvetica, sans-serif" size="1" color="<?php echo $last_date_days_color;?>">
      <?php
         if ($last_date != "" && $last_date != "1969-12-31" && $last_date != "0000-00-00"){
         	echo date("m/d/Y", strtotime($last_date)) . " (" . $last_date_days . " days ago)";
         }else{
         	echo "Never Contacted (" . $last_date_days . " days ago)";
         }				
         
         ?></font></td>
      </tr>
      <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Name Dropping</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
      <input type="checkbox" name="publicity" value="Yes" <?php if($publicity=="Yes") echo "checked"; ?>>
      <?php echo $publicity?></font></td>
      </tr>
      <?php
         $rec_found = "no";	
         $user_qry = "SELECT id from loop_employees where level = 2 and initials = '" . $_COOKIE['userinitials'] . "'";
         
         db();
         $user_res = db_query($user_qry);
         
         while ($user_row = array_shift($user_res)) { 
         ?>
      <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Hide From Call Lists?</font>
      <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
      <span class="tooltiptext">
      Check this box if we do not want this account showing on the Call List Reports, as to prevent any new reps from accidentally calling this account.
      </span>
      </div>
      </td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
      <input type="checkbox" name="chk_sales_purc_team_ignore_com" value="1" <?php if($sales_purc_team_ignore_com=="1") echo "checked"; ?>>
      </font></td>
      </tr>
      <?php }
         ?>
      <tr bgcolor="#E4E4E4">
      <td colspan=2>
      <p align="center">&nbsp;<input align="center" style="cursor:pointer;" type="submit" value="Save">
      <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">&nbsp;<a href="viewComp_info.php?<?php echo $loopurl?>&show=companyinfo">nevermind</a></font>
      </td>
      </tr>
   </table>
   <input type=hidden name="editTable" value="company">
   <input type=hidden name="id" value="<?php echo $ID?>">
   <input type=hidden name="company_url" value="<?php echo $loopurl?>">
   <input type=hidden name="haveneed" value="<?php echo $haveNeed?>">
</form>
<?php
   }
   
   //Company sell to
   /*-------------------------------------------------------------------------------
   Extra Parameter passed in function added by Amarendra dated 14-05-2021 , extra parameter note by Bhavna on 17-08-2023
   -------------------------------------------------------------------------------*/
   function viewCompany_Sellto(string $contact, string $contactTitle, string $address, string $address2, string $city, string $state, string $zip, string $country, string $phone, string $mobileno, string $fax, string $email, int $ID, string $in_loops, string $loopurl, string $status, string $linkedin_profile, string  $main_line, string $main_line_ext, string $style_tbl, string $style_tbl_tr, string $opt_out_mkt_email, string $sell_to_note):void
   { 
   	$flg_ship_empty = "n";
   	$qry_2 = "Select contact from companyInfo where ID = " . $_REQUEST["ID"] . " and (contact <> '' and address <> '') and ((shipContact = '' or shipContact is null) and (shipAddress = '' or shipAddress is null) and (shipCity = '' or shipCity is null) and (shipState = '' or shipState is null) and (shipZip = '' or shipZip is null) and (shipemail = '' or shipemail is null))";
   	
   	db_b2b();
   	$dt_view_2 = db_query($qry_2);
   	
   	while ($myrow = array_shift($dt_view_2)) 
   	{
   		$flg_ship_empty = "y";
   	}	
   
   	if ($flg_ship_empty == "y"){
   		$qry_2 = "Select name from b2bbillto where companyid = " . $_REQUEST["ID"] . " ";
   		
   		db_b2b();
   		$dt_view_2 = db_query($qry_2);
   
   		while ($myrow = array_shift($dt_view_2)) 
   		{
   			$flg_ship_empty = "n";
   		}	
   	}	
   	
   	?>
<table border="0" width="100%" cellspacing="1" cellpadding="1" class="<?php echo $style_tbl;?>">
<tr align="center" class="<?php echo $style_tbl_tr;?>">
<td colspan="2" bgcolor="#C0CDDA" >
<font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php if($status == "Have Boxes") {?>
BUY FROM<br/>
<b>Primary Buy From</b><br>
<?php }else{?>	
SELL TO<br/>
<b>Primary Sell To</b><br>
<?php }
   if ($flg_ship_empty == "y"){?>
<a href="copy_sellto_rec.php?ID=<?php echo $ID;?>">Copy Sell To -> Ship To and Bill To</a><br>
<?php }?>
(the person who is authorized and agrees to purchase)
</font>
<?php
   $newurl="viewComp_info.php?".$loopurl."&Edit=12&show=companyinfo";
   ?>
<font face="Arial, Helvetica, sans-serif" size="1" color="#C0CDDA">
<?php if ($in_loops == "yes") { ?> 
<?php } else { ?>
<a href="#" onClick="comp_geturl('<?php echo $newurl; ?>');">
<?php }  ?>
<img bgcolor="#C0CDDA" src="images/edit.jpg"></a></font>
</td></tr>
<tr bgcolor="#E4E4E4">
<td height="13" width="40%"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Primary Contact
Name </font></td>
<td align="left" width="60%" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $contact?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="10"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Primary Contact
Title </font></td>
<td align="left" height="10"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $contactTitle?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Address 1</font>
<a target="_blank" href='https://www.google.com/maps/place/<?php echo str_replace(" ", "+" ,$address) . ",+" . str_replace(" ", "+" ,$city) . ",+" . str_replace(" ", "+" ,$state) . ",+" . str_replace(" ", "+" ,$zip)?>'>
<img src='images/googlemapicon.png' width='10px' height='10px'></a>
</td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $address?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="19"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Address 2</font></td>
<td align="left" height="19"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $address2?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">City</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $city?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">State/Province</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $state?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Zip</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $zip?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Country</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $country?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Main line</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php if ($main_line != "") { echo "<img src='images/phone_img.png' width='12px' height='12px'>&nbsp; <a href='tel:$main_line'>" . $main_line . "</a>";} ?>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Main line Ext</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $main_line_ext?> </font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Direct No</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php if ($phone != "") { echo "<img src='images/phone_img.png' width='12px' height='12px'>&nbsp; <a href='tel:$phone'>" . $phone . "</a>";} ?>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Mobile No</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php if ($mobileno != "") { echo "<img src='images/phone_img.png' width='12px' height='12px'>&nbsp; <a href='tel:$mobileno'>" . $mobileno . "</a>";} ?>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Reply
To E-mail</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<a href="mailto:<?php echo $email?>"><?php echo $email?></a></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">LinkedIn Profile</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php if ($linkedin_profile != "") {?>
<a target="_blank" href="<?php echo $linkedin_profile?>">Link to Profile</a></font></td>
<?php } ?>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Fax</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $fax?></font></td>
</tr>
<!-- ----------------------------------------------------------------------------
   Row added to show data in sell to table added by Amarendra dated 14-05-2021 
   ------------------------------------------------------------------------------- -->
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Opt-out Email Marketing</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo ( $opt_out_mkt_email == 0)? "No" : "Yes"?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Note</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $sell_to_note?></font></td>
</tr>
</table>
<?php
   }
   //end here Company sell to 
   
   
   //Sell to under company
   /*-------------------------------------------------------------------------------
   Extra Parameter passed in function added by Amarendra dated 14-05-2021 , Extra Parameter By Bhavna 17-08-2023
   -------------------------------------------------------------------------------*/
   function viewCompany_SelltoEdit(string $contact, string $contactTitle, string $address, string $address2, string $city, string $state, string $zip, string $country, string $phone, string $mobileno, string $fax, string $email, int $ID, string $in_loops, string $loopurl, string $status, string $linkedin_profile, string $main_line, string $main_line_ext, string $style_tbl, string $style_tbl_tr, string $opt_out_mkt_email, string $sell_to_note):void
   {
   ?>
<form method=post action="editTables_mrg_purchasing.php">
<script>
   function formchk(){
   	var txtshipZip = document.getElementById("zip").value;
   	var txtshipcountry = document.getElementById("country").value;
   	txtshipcountry = txtshipcountry.toLowerCase();
   	
   	strzip = txtshipZip.trim();
   	strziplen = strzip.length;
   	
   	if (txtshipcountry == "canada" ){
   		if (strziplen != 7){
   			alert("You have selected the Canada country and Zip code length <> 7, please check.");
   			return false;
   		}
   	}
   	if (strziplen == 7){
   		if (txtshipcountry != "canada" ){
   			alert("Zip code length = 7 and Country <> Canada, please check.");
   			return false;
   		}
   	}
   
   	if (txtshipcountry == "mexico" ){
   		if (strziplen != 5 && strziplen > 0){
   			alert("You have selected the Mexico country and Zip code length <> 5, please check.");
   			return false;
   		}
   	}
   
   	if (txtshipcountry == "usa" ){
   		if (strziplen != 5 && strziplen != 10 && strziplen > 0){
   			alert("You have selected the USA country and Zip code length <> 5 or length <> 10, please check.");
   			return false;
   		}
   	}
   
   	if (strziplen > 0){
   		if (txtshipcountry == "" ){
   			alert("Please select the Country, as Zip code is entered, please check.");
   			return false;
   		}
   	}			
   
   	if (document.getElementById("email").value != "")
   	{
   		var txtemail = document.getElementById("email").value;
   		
   		if (txtemail.substr(0, 1) == " "){
   			alert("You entered the contact email with a space before or after it. System automatically removed it prior to saving.");
   			return false;
   		}
   		if (txtemail.substr(txtemail.length-1, 1) == " "){
   			alert("You entered the contact email with a space before or after it. System automatically removed it prior to saving.");
   			return false;
   		}
   	}
   }
</script>
<table border="0" width="100%" cellspacing="1" cellpadding="1" class="<?php echo $style_tbl;?>">
<tr align="center" class="<?php echo $style_tbl_tr;?>">
<td colspan="2" bgcolor="#C0CDDA" >
<font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php if($status == "Have Boxes") {?>
BUY FROM
<?php }else{?>	
SELL TO
<?php }?>
<br/>
(the person who is authorized and agrees to purchase)
</font>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" width="60%"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Primary Contact Name</font></td>
<td align="left" width="40%" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input size="30" type=text name="contact" value="<?php echo $contact?>"></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="10"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Primary Contact Title</font></td>
<td align="left" height="10"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input size="30" type=text name="contactTitle" value="<?php echo $contactTitle?>"></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Address 1</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input size="30" type=text name="address" value="<?php echo $address?>"></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="19"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Address 2</font></td>
<td align="left" height="19"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input size="30" type=text name="address2" value="<?php echo $address2?>"></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">City</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input size="30" type=text name="city" value="<?php echo $city?>"></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">State/Province</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<select name="state" id="state">
<?php
   $tableedit  = "SELECT * FROM zones where zone_country_id in (223,38,37) ORDER BY zone_country_id desc, zone_name";
   
   db_b2b();
   $dt_view_res = db_query($tableedit);
   
   while ($row = array_shift($dt_view_res)) {
   ?>
<option 
   <?php 
      if ((trim($state) == trim($row["zone_code"])) ||  (trim($state) == trim($row["zone_name"])))
       echo " selected ";
        ?> value="<?php echo trim($row["zone_code"])?>">
<?php echo $row["zone_name"]?>
(<?php echo $row["zone_code"]?>)
</option>
<?php
   }
   ?>
</select>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Zip</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input size="30" type=text id="zip" name="zip" value="<?php echo $zip?>"></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Country</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<select name="country" id="country">
<option value="USA" <?php if ($country == "USA") { echo " selected "; }?>>USA</option> 
<option value="Canada" <?php if ($country == "Canada") { echo " selected "; }?>>Canada</option> 
<option value="Mexico" <?php if ($country == "Mexico") { echo " selected "; }?>>Mexico</option> 
</select>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Main line</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input size="30" type=text name="main_line" value="<?php echo $main_line?>"></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Main line Ext</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input size="30" type=text name="main_line_ext" value="<?php echo $main_line_ext?>"></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Direct No</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input size="30" type=text name="phone" value="<?php echo $phone?>"></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Mobile No</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input size="30" type=text name="mobileno" value="<?php echo $mobileno?>"></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Reply To E-mail</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input size="30" type=text name="email" id="email" value="<?php echo $email?>"></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">LinkedIn Profile</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input size="30" type=text name="linkedin_profile" value="<?php echo $linkedin_profile?>"></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Fax</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input size="30" type=text name="fax" value="<?php echo $fax?>"></font></td>
</tr>
<!-- ----------------------------------------------------------------------------
   Row added with checkbox in ship to table added by Amarendra dated 14-05-2021 
   ------------------------------------------------------------------------------- -->
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Opt-out Email Marketing</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input type="checkbox" name="opt_out_mkt_email" <?php echo ($opt_out_mkt_email ==1)? "checked='checked'" : ""?> value="<?php echo $opt_out_mkt_email?>">
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Note</font></td>
<td align="left" height="13"><textarea name="sell_to_note" ><?php echo $sell_to_note; ?></textarea></td>
</tr>
<tr bgcolor="#E4E4E4">
<td colspan=2>
<p align="center">&nbsp;<input align="center" style="cursor:pointer;" type="submit" value="Save"  onclick="return formchk();">
<?php if ($in_loops == "yes") { 		
   $tmpstr = $loopurl;
   $tmpstr = str_replace("Edit_mode=sellto_edit", "", $tmpstr);?> 	
<?php } else { ?> 	
<font face="Arial, Helvetica, sans-serif" size="1" color="#333333">&nbsp;<a href="viewComp_info.php?<?php echo $loopurl?>&show=companyinfo">nevermind</a></font>
<?php } ?> 	
</td>
</tr>
</table>
<?php if ($in_loops == "yes") { ?> 	
<input type="hidden" name="search_result_url" value="<?php echo $tmpstr?>">
<?php } else { ?> 	
<input type="hidden" name="search_result_url" value="no">
<?php } ?> 	
<input type=hidden name="editTable" value="company_sellto">
<input type=hidden name="id" value="<?php echo $ID?>">
<input type=hidden name="selltoedit_url" value="<?php echo $loopurl?>">
</form>
<?php
   }
   
   //Sell to end here
   
   
   ////////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////////
   //SHIPPING INFO
   ////////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////////
   /*-------------------------------------------------------------------------------
   Extra Parameter passed in function added by Amarendra dated 14-05-2021 
   -------------------------------------------------------------------------------*/
   function viewShipping(string $shipContact, string $shipTitle, string $shipAddress, string $shipAddress2, string $shipCity, string $shipState, string $shipZip, string $shipPhone, string $shipMobileno, int $ID, string $in_loops, string $loopurl, string $shipemail, string $status, string $linkedin_profile, string $main_line, string $main_line_ext, string $freightupdates, string $shipping_receiving_hours, string $shipcountry, string $style_tbl, string $style_tbl_tr, string $opt_out_mkt_shipto_email, string $territory, string $ship_to_note):void
   {
   ?>
<table width="100%" border="0" cellspacing="1" cellpadding="1" height="211" class="<?php echo $style_tbl;?>">
<tr align="center" class="<?php echo $style_tbl_tr;?>">
<td colspan="2" bgcolor="#C0CDDA" height="13">
<font face="Arial, Helvetica, sans-serif" size="1">
<?php if($status == "Need Boxes"){?>	
SHIP TO
<?php }else{?>
SHIP FROM
<?php }?>	
<br/>
(the person/location that will physically receive shipment)
<?php if ($in_loops == "yes") { ?> 
<?php } else { ?>
<?php $newurl="viewComp_info.php?".$loopurl."&Edit=2&show=companyinfo"; ?>
<a href="#" onClick="comp_geturl('<?php echo $newurl; ?>');">
<?php }  ?>
<img bgcolor="#C0CDDA" src="images/edit.jpg"></a></font>
</td></tr><tr bgcolor="#E4E4E4">
<td height="13" width="40%"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Contact
Name </font></td>
<td align="left" width="60%" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $shipContact?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="10"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Contact
Title </font></td>
<td align="left" height="10"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $shipTitle?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Address 1</font>
<a target="_blank" href='https://www.google.com/maps/place/<?php echo str_replace(" ", "+" ,$shipAddress) . ",+" . str_replace(" ", "+" ,$shipCity) . ",+" . str_replace(" ", "+" ,$shipState) . ",+" . str_replace(" ", "+" ,$shipZip)?>'>
<img src='images/googlemapicon.png' width='10px' height='10px'></a>
</td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $shipAddress?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="19"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Address 2</font></td>
<td align="left" height="19"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $shipAddress2?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">City</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $shipCity?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">State/Province</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $shipState?>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Zip</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $shipZip?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Country</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $shipcountry?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Territory</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $territory?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Main line</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php if ($main_line != "") { echo "<img src='images/phone_img.png' width='12px' height='12px'>&nbsp; <a href='tel:$main_line'>" . $main_line . "</a>";} ?>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Main line Ext</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $main_line_ext?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Direct No</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php if ($shipPhone != "") { echo "<img src='images/phone_img.png' width='12px' height='12px'>&nbsp; <a href='tel:$shipPhone'>" . $shipPhone . "</a>";} ?>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Mobile No</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php if ($shipMobileno != "") { echo "<img src='images/phone_img.png' width='12px' height='12px'>&nbsp; <a href='tel:$shipMobileno'>" . $shipMobileno . "</a>";} ?>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Email</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<a href="mailto:<?php echo $shipemail?>"><?php echo $shipemail?></a></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
LinkedIn Profile</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php if ($linkedin_profile != "") {?>
<a target="_blank" href="<?php echo $linkedin_profile?>">Link to Profile</a></font></td>
<?php } ?>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Receive Freight Updates</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php if ($freightupdates == 1) { echo "Yes";}?>
<?php if ($freightupdates == 0) { echo "No";}?>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Shipping/Receiving Hours</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $shipping_receiving_hours;?>
</font></td>
</tr>
<!-- ----------------------------------------------------------------------------
   Row added to show data in ship to  table added by Amarendra dated 14-05-2021 
   ------------------------------------------------------------------------------- -->
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Opt-out Email Marketing</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo ( $opt_out_mkt_shipto_email == 0)? "No" : "Yes"?></font></td>
</tr>
<!-- ----------------------------------------------------------------------------
   Row added to show data in ship to  table added by Bhavna dated 17-08-2023 
   ------------------------------------------------------------------------------- -->
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Note</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $ship_to_note?></font></td>
</tr>
</table>
<?php
   }
   /*-------------------------------------------------------------------------------
   Extra Parameter passed in function added by Amarendra dated 14-05-2021 
   -------------------------------------------------------------------------------*/
   function viewShippingEdit(string $shipContact, string $shipTitle, string $shipAddress, string $shipAddress2, string $shipCity, string $shipState, string $shipZip, string $shipPhone, string $shipMobileno, int $ID, string $in_loops, string $loopurl, string $shipemail, string $status, string $linked_profile, string $main_line, string $main_line_ext, string $freightupdates, string $shipping_receiving_hours, string $shipcountry, string $style_tbl, string $style_tbl_tr, string $opt_out_mkt_shipto_email, string $ship_to_note):void
   {
   ?>
<form method=post action="editTables_mrg_purchasing.php">
<script>
   function formchk_shipping(){
   	var txtshipZip = document.getElementById("shipZip").value;
   	var txtshipcountry = document.getElementById("shipcountry").value;
   	txtshipcountry = txtshipcountry.toLowerCase();
   	
   	strzip = txtshipZip.trim();
   	strziplen = strzip.length;
   	
   	if (txtshipcountry == "canada" ){
   		if (strziplen != 7){
   			alert("You have selected the Canada country and Zip code length <> 7, please check.");
   			return false;
   		}
   	}
   	if (strziplen == 7){
   		if (txtshipcountry != "canada" ){
   			alert("Zip code length = 7 and Country <> Canada, please check.");
   			return false;
   		}
   	}
   
   	if (txtshipcountry == "mexico" ){
   		if (strziplen != 5 && strziplen > 0){
   			alert("You have selected the Mexico country and Zip code length <> 5, please check.");
   			return false;
   		}
   	}
   
   	if (txtshipcountry == "usa" ){
   		if (strziplen != 5 && strziplen != 10  && strziplen > 0){
   			alert("You have selected the USA country and Zip code length <> 5 or length <> 10, please check.");
   			return false;
   		}
   	}
   
   	if (strziplen > 0){
   		if (txtshipcountry == "" ){
   			alert("Please select the Country, as Zip code is entered, please check.");
   			return false;
   		}
   	}
   		
   	if (document.getElementById("shipemail").value != "")
   	{
   		var txtemail = document.getElementById("shipemail").value;
   		
   		if (txtemail.substr(0, 1) == " "){
   			alert("You entered the contact email with a space before or after it. System automatically removed it prior to saving.");
   			return false;
   		}
   		if (txtemail.substr(txtemail.length-1, 1) == " "){
   			alert("You entered the contact email with a space before or after it. System automatically removed it prior to saving.");
   			return false;
   		}
   	}
   }
</script>
<table width="100%" border="0" cellspacing="1" cellpadding="1" height="211" class="<?php echo $style_tbl;?>">
<tr align="center" class="<?php echo $style_tbl_tr;?>">
<td colspan="2" bgcolor="#C0CDDA" height="13">
<font face="Arial, Helvetica, sans-serif" size="1"><?php if($status == "Need Boxes"){?>	
SHIP TO
<?php }else{?>
SHIP FROM
<?php }?>	 <br/>
(the person/location that will physically receive shipment)</font></td>
</tr><tr bgcolor="#E4E4E4">
<td height="13" width="40%"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Contact
Name </font></td>
<td align="left" width="60%" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input name="shipContact" value="<?php echo $shipContact?>" size="20"></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="10"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Contact
Title </font></td>
<td align="left" height="10"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input name="shipTitle" value="<?php echo $shipTitle?>" size="20"></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Address 1</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input name="shipAddress" value="<?php echo $shipAddress?>" size="20"></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="19"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Address 2</font></td>
<td align="left" height="19"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input name="shipAddress2" value="<?php echo $shipAddress2?>" size="20"></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">City</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input name="shipCity" value="<?php echo $shipCity?>" size="20"></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">State/Province</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<select name="shipState" id="shipState">
<option value="" ></option> 
<?php
   $tableedit  = "SELECT * FROM zones where zone_country_id in (223,38,37) ORDER BY zone_country_id desc, zone_name";
   
   db_b2b();
   $dt_view_res = db_query($tableedit);
   
   while ($row = array_shift($dt_view_res)) {
   ?>
<option 
   <?php 
      if ((trim($shipState) == trim($row["zone_code"])) ||  (trim($shipState) == trim($row["zone_name"])))
       echo " selected ";
        ?> value="<?php echo trim($row["zone_code"])?>">
<?php echo $row["zone_name"]?>
(<?php echo $row["zone_code"]?>)
</option>
<?php
   }
   ?>
</select>
</td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Zip</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input name="shipZip" id="shipZip" value="<?php echo $shipZip?>" size="20"></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Country</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<select name="shipcountry" id="shipcountry">
<option value="USA" <?php if ($shipcountry == "USA") { echo " selected "; }?>>USA</option> 
<option value="Canada" <?php if ($shipcountry == "Canada") { echo " selected "; }?>>Canada</option> 
<option value="Mexico" <?php if ($shipcountry == "Mexico") { echo " selected "; }?>>Mexico</option> 
</select>
</td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Main line</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input name="ship_main_line" value="<?php echo $main_line?>" size="20"></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Main line Ext</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input name="ship_main_line_ext" value="<?php echo $main_line_ext?>" size="20"></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Direct No</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input name="shipPhone" value="<?php echo $shipPhone?>" size="20"></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Mobile No</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input name="shipMobileno" value="<?php echo $shipMobileno?>" size="20"></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Email</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input name="shipemail" id="shipemail" value="<?php echo $shipemail?>" size="20"></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
LinkedIn Profile</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input name="shipto_linked_profile" value="<?php echo $linked_profile?>"></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Receive Freight Updates</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<select name="shipto_freightupdates">
<option value="1" <?php if ($freightupdates == 1) { echo " selected ";}?>>Yes</option> 
<option value="0" <?php if ($freightupdates == 0) { echo " selected ";}?>>No</option> 
</select>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Shipping/Receiving Hours</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input name="shipping_receiving_hours" value="<?php echo $shipping_receiving_hours;?>">
</font></td>
</tr>
<!-- ----------------------------------------------------------------------------
   Row added with checkbox in ship to table added by Amarendra dated 14-05-2021 
   ------------------------------------------------------------------------------- -->
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Opt-out Email Marketing</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input type="checkbox" name="opt_out_mkt_shipto_email" <?php echo ($opt_out_mkt_shipto_email ==1)? "checked='checked'" : ""?> value="<?php echo $opt_out_mkt_email?>">
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Note</font></td>
<td align="left" height="13"><textarea name="ship_to_note" ><?php echo $ship_to_note; ?></textarea></td>
</tr>
<tr bgcolor="#E4E4E4">
<td colspan=2>
<p align="center">&nbsp;<input align="center" style="cursor:pointer;" type="submit" value="Save" onclick="return formchk_shipping();">
<?php if ($in_loops == "yes") { 		
   $tmpstr = $loopurl;
   $tmpstr = str_replace("Edit_mode=shipto_edit", "", $tmpstr);?> 	
<?php } else { ?> 	
<font face="Arial, Helvetica, sans-serif" size="1" color="#333333">&nbsp;<a href="viewComp_info.php?<?php echo $loopurl?>&show=companyinfo">nevermind</a></font>
<?php } ?> 	
</td>
</tr>
</table>
<?php if ($in_loops == "yes") { ?> 	
<input type="hidden" name="search_result_url" value="<?php echo $tmpstr?>">
<?php } else { ?> 	
<input type="hidden" name="search_result_url" value="no">
<?php } ?> 	
<input type=hidden name="editTable" value="shipping">
<input type=hidden name="id" value="<?php echo $ID?>">
<input type=hidden name="shippto_url" value="<?php echo $loopurl?>">
</form>
<?php
   }
   
   //To display only ship names
   function viewShipTo_names(int $ID, string $in_loops, string $loopurl, string $status, string $style_tbl, string $style_tbl_tr):void {
   	
   	db_b2b();
   	$dt_view = db_query("SELECT * FROM b2bshipto WHERE companyid = " . $ID . " ORDER BY shiptoid");
   	
   	if ( tep_db_num_rows($dt_view) > 0){
   		while ($objdb = array_shift($dt_view)) {
   			//viewShipTodisplay_names($objdb["name"],$style_tbl,$style_tbl_tr);
   			if($objdb["title"] == ""){
   				$show_name = $objdb["name"];
   			}else{
   				$show_name = $objdb["name"] ." (".$objdb["title"].")";
   			}
   		?>
<table width="100%" border="0" cellspacing="1" cellpadding="3" class="<?php echo $style_tbl; ?>">
<tr bgcolor="#E4E4E4" >
<td align="left" width="60%"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $show_name?></font></td>
</tr>
</table>
<?php
   } 	
   }
   ?>		
<form method="POST" action="editTables_mrg_purchasing.php?action=shiptoadd" id="addshiptofrm" name="addshiptofrm">
<?php if ($in_loops == "yes") { ?> 	
<input type="hidden" name="companyid" value="<?php echo $ID?>">
<input type="hidden" name="search_result_url" value="<?php echo $loopurl?>">
<?php } else { ?> 	
<input type="hidden" name="id" value="<?php echo $ID?>">
<input type="hidden" name="search_result_url" value="no">
<input type="hidden" name="shiptoadd_url" value="<?php echo $loopurl?>">
<?php } ?> 	
<input style="cursor:pointer;" type="submit" name="addshipto" value="Add another SHIP TO">
</form>
<?php	
   }
   function viewShipTo(int $ID, string $in_loops, string $loopurl, string $status, string $style_tbl, string $style_tbl_tr):void {
   	
   	db_b2b();
   	$dt_view = db_query("SELECT * FROM b2bshipto WHERE companyid = " . $ID . " ORDER BY shiptoid");
   	
   	if ( tep_db_num_rows($dt_view) > 0){
   		while ($objdb = array_shift($dt_view)) {		
   			viewShipTodisplay($objdb["title"], $objdb["name"], $objdb["mainphone"], $objdb["mainphone"], $objdb["cellphone"], $objdb["email"], $ID, $objdb["shiptoid"], $objdb["fax"], $in_loops, $loopurl, $status, $objdb["linked_profile"], $objdb["main_line_ph"], $objdb["main_line_ph_ext"],$style_tbl,$style_tbl_tr,$objdb["opt_out_mkt_shipto_email"],$objdb["ship_to_note"]);
   			?>
<br/>
<?php			
   }	
   }else{
   //
   }
   ?>
<form method="POST" action="editTables_mrg_purchasing.php?action=shiptoadd" id="addshiptofrm" name="addshiptofrm">
<?php if ($in_loops == "yes") { ?> 	
<input type="hidden" name="companyid" value="<?php echo $ID?>">
<input type="hidden" name="search_result_url" value="<?php echo $loopurl?>">
<?php } else { ?> 	
<input type="hidden" name="id" value="<?php echo $ID?>">
<input type="hidden" name="search_result_url" value="no">
<input type="hidden" name="shiptoadd_url" value="<?php echo $loopurl?>">
<?php } ?> 	
<input style="cursor:pointer;" type="submit" name="addshipto" value="Add another SHIP TO">
</form>
<?php		
   }
   
   function viewShipToEdit(int $ID, int $shiptoid, string $in_loops, string $loopurl, string $status, string $style_tbl, string $style_tbl_tr):void
   {
   	db_b2b();
   	$dt_view = db_query("SELECT * FROM b2bshipto WHERE companyid = " . $ID . " ORDER BY shiptoid");
   	
   	if ( tep_db_num_rows($dt_view) > 0){
   		while ($objdb = array_shift($dt_view)) {
   			if ($objdb["shiptoid"] == $shiptoid){  
   				viewShipTodisplayedit($objdb["title"], $objdb["name"], $objdb["mainphone"], $objdb["mainphone"], $objdb["cellphone"], $objdb["email"], $ID, $shiptoid, $objdb["fax"] , $in_loops, $loopurl, $status, $objdb["linked_profile"], $objdb["main_line_ph"], $objdb["main_line_ph_ext"],$style_tbl,$style_tbl_tr, $objdb["opt_out_mkt_shipto_email"],$objdb["ship_to_note"]); 
   			}else{  
   				viewShipTodisplay($objdb["title"], $objdb["name"], $objdb["mainphone"], $objdb["mainphone"], $objdb["cellphone"], $objdb["email"], $ID, $objdb["shiptoid"], $objdb["fax"], $in_loops, $loopurl, $status, $objdb["linked_profile"], $objdb["main_line_ph"], $objdb["main_line_ph_ext"],$style_tbl,$style_tbl_tr, $objdb["opt_out_mkt_shipto_email"],$objdb["ship_to_note"]);
   			}
   		} 
   	}else{  
   		viewShipTodisplayedit("", "", "" , "" , "" , "", $ID, 0, "", $in_loops, $loopurl, $status, "", "", "",$style_tbl,$style_tbl_tr,"");
   	}
   ?>
<?php
   }
   
   function viewShipTodisplay(string $title, string $name, string $mainphone, string $directphone, string $cellphone, string $email, int $ID, int $shiptoid, string $fax, string $in_loops, string $loopurl, string $status, string $linkedin_profile, string $main_line, string $main_line_ext, string $style_tbl, string $style_tbl_tr,string $opt_out_mkt_shipto_email, string $ship_to_note):void {
   	?>
<table width="100%" border="0" cellspacing="1" cellpadding="3" height="211" class="<?php echo $style_tbl;?>">
<tr align="center" class="<?php echo $style_tbl_tr;?>">
<td colspan="2" bgcolor="#C0CDDA" height="13">
<font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php if($status == "Need Boxes") {?>
<!-- SHIP TO Contacts -->
<?php } else {?>
<!-- SHIP FROM Contacts -->
<?php } ?>
(the person who is authorized and agrees to purchase)
<?php if ($in_loops == "yes") { ?> 
<?php } else { 
   $newurl="viewComp_info.php?".$loopurl."&Edit=5&show=companyinfo&shiptoid=".$shiptoid;
   ?>
<a href="#" onClick="comp_geturl('<?php echo $newurl; ?>');">
<?php }  ?>
<img bgcolor="#C0CDDA"  src="images/edit.jpg"></a>
&nbsp;
<?php if ($in_loops == "yes") { ?> 
<a href="delete_shipto_mrg_mysqli.php?<?php echo $loopurl?>&shiptoid=<?php echo $shiptoid?>" onclick="return confirm('Are you sure you want to delete this record?')">
<?php } else { ?>
<a href="delete_shipto_mrg_mysqli.php?ID=<?php echo $ID?>&shiptoid=<?php echo $shiptoid?>" onclick="return confirm('Are you sure you want to delete this record?')">
<?php }  ?>
<img bgcolor="#C0CDDA" src="images/del_img.png"></a>
</font>
</td></tr>
<tr bgcolor="#E4E4E4">
<td height="10" width="40%" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Name</font></td>
<td align="left" width="60%" height="10"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $name?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Title </font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $title?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Main line</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php if ($main_line != "") { echo "<img src='images/phone_img.png' width='12px' height='12px'>&nbsp; <a href='tel:$main_line'>" . $main_line . "</a>";} ?>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Main line Ext</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $main_line_ext?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Direct No</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php if ($directphone != "") { echo "<img src='images/phone_img.png' width='12px' height='12px'>&nbsp; <a href='tel:$directphone'>" . $directphone . "</a>";} ?>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Mobile No</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php if ($cellphone != "") { echo "<img src='images/phone_img.png' width='12px' height='12px'>&nbsp; <a href='tel:$cellphone'>" . $cellphone . "</a>";} ?>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Email</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<a href="mailto:<?php echo $email?>"><?php echo $email?></a>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
LinkedIn Profile</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php if ($linkedin_profile != "") {?>
<a target="_blank" href="<?php echo $linkedin_profile?>">Link to Profile</a></font></td>
<?php } ?>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Fax</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $fax?></font></td>
</tr>
<!-- ----------------------------------------------------------------------------
   Row added to show record in sell to table added by Amarendra dated 14-05-2021 
   ------------------------------------------------------------------------------- -->
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Opt-out Email Marketing</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo ( $opt_out_mkt_shipto_email == 0)? "No" : "Yes"?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="10" width="40%" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Note</font></td>
<td align="left" width="60%" height="10"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $ship_to_note?></font></td>
</tr>
</table>
<?php
   }
   
   function viewShipTodisplayedit(string $title, string $name, string $mainphone, string $directphone, string $cellphone, string $email, int $ID, int $shiptoid, string $fax, string $in_loops, string $loopurl, string $status, string $linkedin_profile, string $main_line, string $main_line_ext, string $style_tbl, string $style_tbl_tr, string $opt_out_mkt_shipto_email, string $ship_to_note):void {
   	//echo "shiptoid -> ".$shiptoid;
   ?>
<form method=post action="editTables_mrg_purchasing.php" name="frmshiptoedit" id="frmshiptoedit" onSubmit="return formCheckInvShip()">
<script>
   function formchk_shiptoedit(){
   	if (document.getElementById("shiptoemail").value != "")
   	{
   		var txtemail = document.getElementById("shiptoemail").value;
   		
   		if (txtemail.substr(0, 1) == " "){
   			alert("You entered the contact email with a space before or after it. System automatically removed it prior to saving.");
   			return false;
   		}
   		if (txtemail.substr(txtemail.length-1, 1) == " "){
   			alert("You entered the contact email with a space before or after it. System automatically removed it prior to saving.");
   			return false;
   		}
   	}
   }
</script>
<table width="100%" border="0" cellspacing="1" cellpadding="1" height="211" class="<?php echo $style_tbl;?>">
<tr align="center" class="<?php echo $style_tbl_tr;?>">
<td colspan="2" bgcolor="#C0CDDA" >
<font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<!-- <?php if($status == "Need Boxes") {?>
   <!-- SHIP TO Contacts --
   <a href="update_shipto_primary_purchasing.php?ID=<?php echo $ID;?>&shiptoid=<?php echo $shiptoid; ?>">Make Primary Ship To</a><br>
   <?php } else {?>
   <!-- SHIP FROM Contacts --
   <a href="update_shipto_primary_purchasing.php?ID=<?php echo $ID;?>&shiptoid=<?php echo $shiptoid; ?>">Make Primary Ship From</a><br>
   <?php } ?> -->
(the person who is authorized and agrees to purchase)
</font>
</tr>
<tr bgcolor="#E4E4E4">
<td height="10" width="40%" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Name </font></td>
<td align="left" width="60%" height="10"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input name="shiptoname" value="<?php echo $name?>" size="20"></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Title
</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input name="shiptotitle" value="<?php echo $title?>" size="20"></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Main line</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input name="shipto_main_line" value="<?php echo $main_line?>" size="20"></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Main line Ext</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input name="shipto_main_line_ext" value="<?php echo $main_line_ext?>" size="20"></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Direct No</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input name="mainphone" value="<?php echo $directphone?>" size="20"></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Mobile No</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input name="cellphone" value="<?php echo $cellphone?>" size="20"></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Email</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input name="shiptoemail" id="shiptoemail" value="<?php echo $email?>" size="20" ></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
LinkedIn Profile</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input name="shipto_linkedin_profile" value="<?php echo $linkedin_profile?>" ></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Fax</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input name="mainfax" value="<?php echo $fax?>" size="20"></font></td>
</tr>
<!-- ----------------------------------------------------------------------------
   Row added with checkbox in ship to table added by Amarendra dated 14-05-2021 
   ------------------------------------------------------------------------------- -->
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Opt-out Email Marketing</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<input type="checkbox" name="opt_out_mkt_shipto_email" <?php echo ($opt_out_mkt_shipto_email ==1)? "checked='checked'" : ""?> value="<?php echo $opt_out_mkt_shipto_email?>">
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Note</font></td>
<td align="left" height="13"><textarea name="ship_to_note" ><?php  echo $ship_to_note; ?></textarea></td>
</tr>
<tr bgcolor="#E4E4E4">
<td colspan=2>
<p align="center">&nbsp;<input align="center" style="cursor:pointer;" type="submit" value="Save" onclick="formchk_shiptoedit(); return true;">
<?php if ($in_loops == "yes") { 		
   $tmpstr = $loopurl;
   $tmpstr = str_replace("Edit_mode=newshipto_edit", "", $tmpstr);?> 
<?php } else { ?> 	
<font face="Arial, Helvetica, sans-serif" size="1" color="#333333">&nbsp;<a href="viewComp_info.php?<?php echo $loopurl?>&show=companyinfo&nmind_ship=yes">nevermind</a></font>
<?php } ?> 
</td>
</tr>
</table>
<?php if ($in_loops == "yes") { ?> 	
<input type="hidden" name="search_result_url" value="<?php echo $tmpstr?>">
<?php } else { ?> 	
<input type="hidden" name="search_result_url" value="no">
<?php } ?> 
<input type="hidden" name="editTable" value="shipto">
<input type="hidden" name="id" value="<?php echo $ID?>">
<input type="hidden" name="shiptoid" value="<?php echo $shiptoid?>">
<input type="hidden" name="shipto_url" value="<?php echo $loopurl?>">
</form>
<?php
   }
   ?>
<?php
   ////////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////////
   
   //Bill To 
   
   ////////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////////
   //To display only names
   function viewbillTo_names(int $ID, string $in_loops, string $loopurl, string $style_tbl, string $style_tbl_tr):void
   {
   
   	$qry = "Select * from b2bbillto where companyid = " . $ID . " order by billtoid LIMIT 18446744073709551610 OFFSET 1";
   	
   	db_b2b();
   	$dt_view= db_query($qry);
   
   	if ( tep_db_num_rows($dt_view) > 0)
   	{
   		while ($objdb = array_shift($dt_view)) {
   			viewbillTodisplay_names($objdb["name"],$objdb["title"],$style_tbl,$style_tbl_tr);
   		?>
<?php			
   } 
   ?>
<?php		
   }
   	?>
<form method="POST" action="editTables_mrg_purchasing.php?action=billtoadd" id="addbilltofrm" name="addbilltofrm">
<?php if ($in_loops == "yes") { ?> 	
<?php } else { ?> 	
<input type="hidden" name="id" value="<?php echo $ID?>">
<input type="hidden" name="search_result_url" value="no">
<input type="hidden" name="billtoadd_url" value="<?php echo "ID=". $ID; ?>">
<?php } ?> 	
<input style="cursor:pointer;" type="submit" name="addbillto" value="Add another BILL TO">
</form>
<?php		
  
   }
   //
   
   function view_primary_billTo(int $ID, string $in_loops, string $loopurl, string $style_tbl, string $style_tbl_tr, string $online_invoicing, string $bill_to_note)
   {
   $flg_first_rec = "y";
   $qry = "Select * from b2bbillto where companyid = " . $ID . " order by billtoid limit 1";
   
   db_b2b();
   $dt_view= db_query($qry);
   
   if ( tep_db_num_rows($dt_view) > 0)
   {
   
   while ($objdb = array_shift($dt_view)) {
   	//if ( tep_db_num_rows($dt_view) == 1){
   		$flg_first_rec = "y";
   		//echo $flg_first_rec;
   	//
   	view_primary_billTodisplay($objdb["title"], $objdb["name"], $objdb["address"], $objdb["address2"], $objdb["city"], $objdb["state"], $objdb["zipcode"], $objdb["mainphone"], $objdb["directphone"], $objdb["cellphone"], $objdb["email"], $ID, $objdb["billtoid"], $objdb["fax"], $in_loops, $loopurl, $objdb["linked_profile"], $objdb["main_line_ph"], $objdb["main_line_ph_ext"], $flg_first_rec, $style_tbl,$style_tbl_tr, $online_invoicing,$objdb["bill_to_note"]);
   	$flg_first_rec = "n";
   ?>
<?php			
   }
   //} 
   ?>
<?php		
   }else{
   	viewbillTodisplay("", "", "", "", "", "", "", "" , "" , "" , "", $ID,0, "", $in_loops, $loopurl, "", "", "", "y", $style_tbl,$style_tbl_tr, $online_invoicing,"");
   }
   
   ?>
<?php  //if ($in_loops == "no") { ?> 
<?php		
   // }
   }
   //
   function view_billTo(int $ID, string $in_loops, string $loopurl, string $style_tbl, string $style_tbl_tr):void
   {
   $flg_first_rec = "y";
   $qry = "Select * from b2bbillto where companyid = " . $ID . " order by billtoid LIMIT 18446744073709551610 OFFSET 1";
   
   db_b2b();
   $dt_view= db_query($qry);
   
   if ( tep_db_num_rows($dt_view) > 0)
   {
   while ($objdb = array_shift($dt_view)) {
   	/*if ( tep_db_num_rows($dt_view) == 1){
   		$flg_first_rec = "y";
   	}
   	*/
   	viewbillTodisplay($objdb["title"], $objdb["name"], $objdb["address"], $objdb["address2"], $objdb["city"], $objdb["state"], $objdb["zipcode"], $objdb["mainphone"], $objdb["directphone"], $objdb["cellphone"], $objdb["email"], $ID, $objdb["billtoid"], $objdb["fax"], $in_loops, $loopurl, $objdb["linked_profile"], $objdb["main_line_ph"], $objdb["main_line_ph_ext"], $flg_first_rec,$style_tbl,$style_tbl_tr, "", $objdb['bill_to_note']);
   	$flg_first_rec = "n";
   	
   	
   ?>
<?php			
   } 
   ?>
<?php		
   }else{
   	viewbillTodisplay("", "", "", "", "", "", "", "" , "" , "" , "", $ID,0, "", $in_loops, $loopurl, "", "", "", "y",$style_tbl,$style_tbl_tr,"");
   }
   
   ?>
<form method="POST" action="editTables_mrg_purchasing.php?action=billtoadd" id="addbilltofrm" name="addbilltofrm">
<?php if ($in_loops == "yes") { ?> 	
<?php } else { ?> 	
<input type="hidden" name="id" value="<?php echo $ID?>">
<input type="hidden" name="search_result_url" value="no">
<input type="hidden" name="billtoadd_url" value="<?php echo "ID=". $ID; ?>">
<?php } ?> 	
<input style="cursor:pointer;" type="submit" name="addbillto" value="Add another BILL TO">
</form>
<?php		
   //}
   }
   //
   function view_primary_billTodisplay(string $title, string $name, string $address, string $address2, string $city, string $state, string $zip, string $mainphone, string $directphone, string $cellphone, string $email, int $ID, int $billtoid, string $fax, string $in_loops, string $loopurl, string $linkedin_profile, string $main_line, string $main_line_ext, string $flg_first_rec, string $style_tbl, string $style_tbl_tr, string $online_invoicing, string $bill_to_note):void
   {
   ?>
<table width="100%" border="0" cellspacing="1" cellpadding="1" height="211" class="<?php echo $style_tbl;?>">
<tr align="center" class="<?php echo $style_tbl_tr;?>">
<td colspan="2" bgcolor="#C0CDDA" height="13">
<font face="Arial, Helvetica, sans-serif" size="1">BILL TO<br/>
<?php if ($flg_first_rec == "y") { ?> 
<b>Primary Bill To</b><br>
<?php } ?> 	
(the person/organization to whom we will invoice)
<?php
   if($online_invoicing=="None" || $online_invoicing=="" || $online_invoicing==" ")
   {
   
   }else{
   ?>
<br><font face="Arial, Helvetica, sans-serif" size="1" color="red"><strong>Invoicing Through: <?php echo $online_invoicing?></strong></font>
<?php	}?>
<?php if ($in_loops == "yes") { ?> 
<?php } else { 
   $newurl="viewComp_info.php?".$loopurl."&Edit=14&show=companyinfo&billtoid=".$billtoid;
   ?>
<a href="#" onClick="comp_geturl('<?php echo $newurl; ?>');">
<?php }  ?>
<img bgcolor="#C0CDDA"  src="images/edit.jpg"></a></font>
&nbsp;
<?php if ($flg_first_rec != "y") { ?> 
<?php if ($billtoid > 0 ) { if ($in_loops == "yes") { ?> 
<a href="delete_billto_mrg_purchasing.php?<?php echo $loopurl?>" onclick="return confirm('Are you sure you want to delete this record?')">
<?php } else { ?>
<a href="delete_billto_mrg_purchasing.php?ID=<?php echo $ID?>&billtoid=<?php echo $billtoid?>" onclick="return confirm('Are you sure you want to delete this record?')">
<?php }  ?>
<img bgcolor="#C0CDDA" src="images/del_img.png"></a>
<?php } ?>
<?php } ?>
</td></tr>
<tr bgcolor="#E4E4E4">
<td height="10" width="40%" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Name</font></td>
<td align="left" width="60%" height="10"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $name?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Title </font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $title?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Address 1</font>
<a target="_blank" href='https://www.google.com/maps/place/<?php echo str_replace(" ", "+" ,$address) . ",+" . str_replace(" ", "+" ,$city) . ",+" . str_replace(" ", "+" ,$state) . ",+" . str_replace(" ", "+" ,$zip)?>'>
<img src='images/googlemapicon.png' width='10px' height='10px'></a>
</td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $address?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="19" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Address 2</font></td>
<td align="left" height="19"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $address2?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">City</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $city?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">State/Province</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $state?>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Zip</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $zip?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Main line</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php if ($main_line != "") { echo "<img src='images/phone_img.png' width='12px' height='12px'>&nbsp; <a href='tel:$main_line'>" . $main_line . "</a>";} ?>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Main line Ext</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $main_line_ext?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Direct No</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php if ($mainphone != "") { echo "<img src='images/phone_img.png' width='12px' height='12px'>&nbsp; <a href='tel:$mainphone'>" . $mainphone . "</a>";} ?>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Mobile No</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php if ($cellphone != "") { echo "<img src='images/phone_img.png' width='12px' height='12px'>&nbsp; <a href='tel:$cellphone'>" . $cellphone . "</a>";} ?>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Email</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<a href="mailto:<?php echo $email?>"><?php echo $email?></a>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
LinkedIn Profile</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php if ($linkedin_profile != "") {?>
<a target="_blank" href="<?php echo $linkedin_profile?>">Link to Profile</a></font></td>
<?php } ?>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Fax</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $fax?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Note</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $bill_to_note?></font></td>
</tr>
</table>
<br/>
<?php
   }
   //
   
   function viewbillTodisplay(string $title, string $name, string $address, string $address2, string $city, string $state, string $zip, string $mainphone, string $directphone, string $cellphone, string $email, int $ID, int $billtoid,string $fax, string $in_loops, string $loopurl, string $linkedin_profile, string $main_line, string $main_line_ext, string $flg_first_rec, string $style_tbl, string $style_tbl_tr, string $online_invoicing = "", string $bill_to_note):void
   {
   ?>
<table width="100%" border="0" cellspacing="1" cellpadding="1" height="211"  class="<?php echo $style_tbl;?>">
<tr align="center" class="<?php echo $style_tbl_tr;?>">
<td colspan="2" bgcolor="#C0CDDA" height="13">
<font face="Arial, Helvetica, sans-serif" size="1">BILL TO<br/>
 	
(the person/organization to whom we will invoice)
<?php
   if($online_invoicing=="None" || $online_invoicing=="" || $online_invoicing==" ")
   {
   
   }else{
   ?>
<br><font face="Arial, Helvetica, sans-serif" size="1" color="red"><strong>Invoicing Through: <?php echo $online_invoicing?></strong></font>
<?php	}?>
<?php if ($in_loops == "yes") { ?> 
<?php } else { 
   $newurl="viewComp_info.php?".$loopurl."&Edit=4&show=companyinfo&billtoid=".$billtoid;
   
   ?>
<a href="#" onClick="comp_geturl('<?php echo $newurl; ?>');">
<?php }  ?>
<img bgcolor="#C0CDDA"  src="images/edit.jpg"></a></font>
&nbsp;
<?php if ($billtoid > 0 ) { if ($in_loops == "yes") { ?> 
<a href="delete_billto_mrg_purchasing.php?<?php echo $loopurl?>" onclick="return confirm('Are you sure you want to delete this record?')">
<?php } else { ?>
<a href="delete_billto_mrg_purchasing.php?ID=<?php echo $ID?>&billtoid=<?php echo $billtoid?>" onclick="return confirm('Are you sure you want to delete this record?')">
<?php }  ?>
<img bgcolor="#C0CDDA" src="images/del_img.png"></a>
<?php } ?>
</td></tr>
<tr bgcolor="#E4E4E4">
<td height="10" width="40%" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Name</font></td>
<td align="left" width="60%" height="10"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $name?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Title </font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $title?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Address 1</font>
<a target="_blank" href='https://www.google.com/maps/place/<?php echo str_replace(" ", "+" ,$address) . ",+" . str_replace(" ", "+" ,$city) . ",+" . str_replace(" ", "+" ,$state) . ",+" . str_replace(" ", "+" ,$zip)?>'>
<img src='images/googlemapicon.png' width='10px' height='10px'></a>
</td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $address?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="19" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Address 2</font></td>
<td align="left" height="19"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $address2?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">City</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $city?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">State/Province</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $state?>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Zip</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $zip?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Main line</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php if ($main_line != "") { echo "<img src='images/phone_img.png' width='12px' height='12px'>&nbsp; <a href='tel:$main_line'>" . $main_line . "</a>";} ?>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Main line Ext</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $main_line_ext?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Direct No</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php if ($mainphone != "") { echo "<img src='images/phone_img.png' width='12px' height='12px'>&nbsp; <a href='tel:$mainphone'>" . $mainphone . "</a>";} ?>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Mobile No</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php if ($cellphone != "") { echo "<img src='images/phone_img.png' width='12px' height='12px'>&nbsp; <a href='tel:$cellphone'>" . $cellphone . "</a>";} ?>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Email</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<a href="mailto:<?php echo $email?>"><?php echo $email?></a>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
LinkedIn Profile</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php if ($linkedin_profile != "") {?>
<a target="_blank" href="<?php echo $linkedin_profile?>">Link to Profile</a></font></td>
<?php } ?>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Fax</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $fax?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Note</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $bill_to_note?></font></td>
</tr>
</table>
<br/>
<?php
   }
   //
   function viewbillTodisplay_names(string $name, string $title, string $style_tbl, string $style_tbl_tr):void
   {
   	if($title == ""){
   		$show_name = $name;
   	}else{
   		$show_name = $name ." (".$title.")";
   	}
   ?>
<table width="100%" border="0" cellspacing="1" cellpadding="3" class="<?php echo $style_tbl; ?>">
   <tr bgcolor="#E4E4E4">
      <td align="left" width="60%"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
         <?php echo $show_name?></font>
      </td>
   </tr>
</table>
<?php
   }
   
   //view_primary_billTo
   function viewbillToEdit(int $ID, int $billtoid, string $in_loops, string $loopurl, string $style_tbl, string $style_tbl_tr)
   {
   	$flg_first_rec = "y";
   	$qry = "Select * from b2bbillto where companyid = " . $ID . " order by billtoid LIMIT 18446744073709551610 OFFSET 1";
   	
   	db_b2b();
   	$dt_view= db_query($qry);
   
   	if ( tep_db_num_rows($dt_view) > 0)
   	{
   		while ($objdb = array_shift($dt_view)) {
   			
   			if ($objdb["billtoid"] == $billtoid)
   				{ 
   					viewbillTodisplayedit($objdb["title"], $objdb["name"], $objdb["address"], $objdb["address2"], $objdb["city"], $objdb["state"], $objdb["zipcode"], $objdb["mainphone"], $objdb["directphone"], $objdb["cellphone"], $objdb["email"], $ID, $billtoid, $objdb["fax"] , $in_loops, $loopurl, $objdb["linked_profile"], $objdb["main_line_ph"], $objdb["main_line_ph_ext"], $flg_first_rec,$style_tbl,$style_tbl_tr,$objdb["bill_to_note"]); 
   					$flg_first_rec = "n";
   				}
   			else
   			{ 
   				viewbillTodisplay($objdb["title"], $objdb["name"], $objdb["address"], $objdb["address2"], $objdb["city"], $objdb["state"], $objdb["zipcode"], $objdb["mainphone"], $objdb["directphone"], $objdb["cellphone"], $objdb["email"], $ID, $objdb["billtoid"], $objdb["fax"], $in_loops, $loopurl, $objdb["linked_profile"], $objdb["main_line_ph"], $objdb["main_line_ph_ext"], "",$style_tbl,$style_tbl_tr, $objdb["bill_to_note"]);	}			
   		} 
   	}else{
   		viewbillTodisplayedit("", "", "", "", "", "", "", "" , "" , "" , "", $ID, 0, "", $in_loops, $loopurl, "", "", "", $flg_first_rec,"");
   	}
   	?>
<?php
   }
   //
   function view_primary_billToEdit(int $ID, int $billtoid, string $in_loops, string $loopurl, string $style_tbl, string $style_tbl_tr, string $bill_to_note):void
   {
   	$flg_first_rec = "y";
   	$qry = "Select * from b2bbillto where companyid = " . $ID . " order by billtoid limit 1";
   	
   	db_b2b();
   	$dt_view= db_query($qry);
   
   	if ( tep_db_num_rows($dt_view) > 0)
   	{
   		while ($objdb = array_shift($dt_view)) {
   		
   				$flg_first_rec = "y";
   			
   			if ($objdb["billtoid"] == $billtoid)
   				{ 
   					viewbillTodisplayedit($objdb["title"], $objdb["name"], $objdb["address"], $objdb["address2"], $objdb["city"], $objdb["state"], $objdb["zipcode"], $objdb["mainphone"], $objdb["directphone"], $objdb["cellphone"], $objdb["email"], $ID, $billtoid, $objdb["fax"] , $in_loops, $loopurl, $objdb["linked_profile"], $objdb["main_line_ph"], $objdb["main_line_ph_ext"],$flg_first_rec,$style_tbl,$style_tbl_tr,$objdb["bill_to_note"]); 
   					$flg_first_rec = "n";
   				}
   			else
   			{ 
   				viewbillTodisplay($objdb["title"], $objdb["name"], $objdb["address"], $objdb["address2"], $objdb["city"], $objdb["state"], $objdb["zipcode"], $objdb["mainphone"], $objdb["directphone"], $objdb["cellphone"], $objdb["email"], $ID, $objdb["billtoid"], $objdb["fax"], $in_loops, $loopurl, $objdb["linked_profile"], $objdb["main_line_ph"], $objdb["main_line_ph_ext"], "",$style_tbl,$style_tbl_tr, $objdb["bill_to_note"]);	}			
   		//} 
   		}
   	}else{
   		viewbillTodisplayedit("", "", "", "", "", "", "", "" , "" , "" , "", $ID, 0, "", $in_loops, $loopurl, "", "", "", $flg_first_rec,"","","");
   	}
   }
   
   		
   
   function viewbillTodisplayedit(string $title, string $name, string $address, string $address2, string $city, string $state, string $zip, string $mainphone, string $directphone, string $cellphone, string $email, int $ID, int $billtoid, string $fax, string $in_loops, string $loopurl, string $linked_profile, string $main_line, string $main_line_ext, string $flg_first_rec, string $style_tbl, string $style_tbl_tr, string $bill_to_note):void
   {
   ?>
<form method=post action="editTables_mrg_purchasing.php" name="frmbilltoedit" id="frmbilltoedit" onSubmit="return formCheckInv_billto()">
   <script>
      function formchk_billto(){
      	if (document.getElementById("billtoemail").value != "")
      	{
      		var txtemail = document.getElementById("billtoemail").value;
      		
      		if (txtemail.substr(0, 1) == " "){
      			alert("You entered the contact email with a space before or after it. System automatically removed it prior to saving.");
      			return false;
      		}
      		if (txtemail.substr(txtemail.length-1, 1) == " "){
      			alert("You entered the contact email with a space before or after it. System automatically removed it prior to saving.");
      			return false;
      		}
      	}
      }
   </script>																
   <table width="100%" border="0" cellspacing="1" cellpadding="1" height="211" class="<?php echo $style_tbl;?>">
      <tr align="center" class="<?php echo $style_tbl_tr;?>">
         <td colspan="2" bgcolor="#C0CDDA" height="13">
            <font face="Arial, Helvetica, sans-serif" size="1">BILL TO<br/>
            <?php if ($flg_first_rec == "y") { ?> 
            <a href="update_sellto_primary_purchasing.php?ID=<?php echo $ID;?>&billtoid=<?php echo $billtoid; ?>">Make Primary Bill To</a><br>
            <?php } ?> 	
            (the person/organization to whom we will invoice)</font>
         </td>
      </tr>
      <tr bgcolor="#E4E4E4">
         <td height="10" width="40%" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Name </font></td>
         <td align="left" width="60%" height="10"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            <input name="billtoname" value="<?php echo $name?>" size="20"></font>
         </td>
      </tr>
      <tr bgcolor="#E4E4E4">
         <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Title
            </font>
         </td>
         <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            <input name="billtotitle" value="<?php echo $title?>" size="20"></font>
         </td>
      </tr>
      <tr bgcolor="#E4E4E4">
         <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Address 1</font></td>
         <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            <input name="billtoAddress" value="<?php echo $address?>" size="20"></font>
         </td>
      </tr>
      <tr bgcolor="#E4E4E4">
         <td height="19"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Address 2</font></td>
         <td align="left" height="19"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            <input name="billtoAddress2" value="<?php echo $address2?>" size="20"></font>
         </td>
      </tr>
      <tr bgcolor="#E4E4E4">
         <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">City</font></td>
         <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            <input name="billtoCity" value="<?php echo $city?>" size="20"></font>
         </td>
      </tr>
      <tr bgcolor="#E4E4E4">
         <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">State/Province</font></td>
         <td align="left" height="13">
            <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
               <select name="billtoState">
                  <option value="" ></option>
                  <?php
                     $tableedit  = "SELECT * FROM zones where zone_country_id in (223,38,37) ORDER BY zone_country_id desc, zone_name";
                     
                     db_b2b();
                     $dt_view_res = db_query($tableedit);
                     
                     while ($row = array_shift($dt_view_res)) {
                     
                     ?>
                  <option 
                     <?php 
                        if ((trim($state) == trim($row["zone_code"])) ||  (trim($state) == trim($row["zone_name"])))
                        
                         echo " selected ";
                        
                          ?> value="<?php echo trim($row["zone_code"])?>">
                     <?php echo $row["zone_name"]?>
                     (<?php echo $row["zone_code"]?>)
                  </option>
                  <?php
                     }
                     
                     ?>
               </select>
         </td>
      </tr>
      <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Zip</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
      <input name="billtoZip" value="<?php echo $zip?>" size="20"></font></td>
      </tr>
      <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
      Main line</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
      <input name="billto_main_line" value="<?php echo $main_line?>" size="20"></font></td>
      </tr>
      <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
      Main line Ext</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
      <input name="billto_main_line_ext" value="<?php echo $main_line_ext?>" size="20"></font></td>
      </tr>
      <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
      Direct No</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
      <input name="mainphone" value="<?php echo $mainphone?>" size="20"></font></td>
      </tr>
      <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
      Mobile No</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
      <input name="cellphone" value="<?php echo $cellphone?>" size="20"></font></td>
      </tr>
      <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
      Email</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
      <input name="billtoemail" id="billtoemail" value="<?php echo $email?>" size="20" ></font></td>
      </tr>
      <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
      LinkedIn Profile</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
      <input name="billto_linked_profile" value="<?php echo $linked_profile?>" size="20" ></font></td>
      </tr>
      <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
      Fax</font></td>
      <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
      <input name="mainfax" value="<?php echo $fax?>" size="20"></font></td>
      </tr>
      <tr bgcolor="#E4E4E4">
      <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Note</font></td>
      <td align="left" height="13"><textarea name="bill_to_note" ><?php echo $bill_to_note; ?></textarea></td>
      </tr>
      <tr bgcolor="#E4E4E4">
      <td colspan=2>
      <p align="center">&nbsp;<input align="center" style="cursor:pointer;" type="submit" value="Save"  onclick="formchk_billto(); return true;">
      <?php if ($in_loops == "yes") { 		
         $tmpstr = $loopurl;
         $tmpstr = str_replace("Edit_mode=billto_edit", "", $tmpstr);?> 	
      <!--<font face="Arial, Helvetica, sans-serif" size="1" color="#333333">&nbsp;<a href="search_results.php?<?php//=$tmpstr?>">nevermind</a></font>-->
      <?php } else { ?> 	
      <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">&nbsp;<a href="viewComp_info.php?<?php echo $loopurl?>&show=companyinfo&pnmind=yes">nevermind</a></font>
      <?php } ?>
      </td>
      </tr>
   </table>
   <?php if ($in_loops == "yes") { ?> 	
   <input type="hidden" name="search_result_url" value="<?php echo $tmpstr?>">
   <?php } else { ?> 	
   <input type="hidden" name="search_result_url" value="no">
   <?php } ?> 	
   <input type=hidden name="editTable" value="billto">
   <input type=hidden name="id" value="<?php echo $ID?>">
   <input type=hidden name="billtoid" value="<?php echo $billtoid?>">
   <input type=hidden name="billto_url" value="<?php echo $loopurl?>">
</form>
<?php
   }
   
   	
   ////////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////////
   
   //Sell To 
   
   ////////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////////
   
   //To display only sell names
   function viewSellTo_names(int $ID, string $in_loops, string $loopurl, string $status, string $style_tbl, string $style_tbl_tr):void
   {
   
   	$qry = "Select * from b2bsellto where companyid = " . $ID . " order by selltoid";
   	
   	db_b2b();
   	$dt_view= db_query($qry);
   
   	if ( tep_db_num_rows($dt_view) > 0)
   	{
   		while ($objdb = array_shift($dt_view)) {
   			viewSellTodisplay_names($objdb["name"],$objdb["title"],$style_tbl,$style_tbl_tr);
   ?>
<?php			
   } 
   ?>
<?php		
   }else{
   	//viewSellTodisplay("", "", "", "", "", "", "", "" , "" , "" , "", $ID,0, "", $in_loops, $loopurl);
   }
   
   ?>
<?php  //if ($in_loops == "no") { ?> 
<form method="POST" action="editTables_mrg_purchasing.php?action=selltoadd" id="addsaletofrm" name="addsaletofrm">
<?php if ($in_loops == "yes") { ?> 	
<input type="hidden" name="companyid" value="<?php echo $ID?>">
<input type="hidden" name="search_result_url" value="<?php echo $loopurl?>">
<?php } else { ?> 	
<input type="hidden" name="id" value="<?php echo $ID?>">
<input type="hidden" name="search_result_url" value="no">
<input type="hidden" name="selltoadd_url" value="<?php echo $loopurl?>">
<?php } ?> 	
<input style="cursor:pointer;" type="submit" name="addsaleto" value="Add another SELL TO">
</form>
<?php		
   //}
   }
   //
   
   function viewSellTo(int $ID, string $in_loops, string $loopurl, string $status, string $style_tbl, string $style_tbl_tr):void
   {
   
   $qry = "Select * from b2bsellto where companyid = " . $ID . " order by selltoid";
   
   db_b2b();
   $dt_view= db_query($qry);
   
   if ( tep_db_num_rows($dt_view) > 0)
   {
   while ($objdb = array_shift($dt_view)) {
   	/*-------------------------------------------------------------------------------
   	Extra Parameter passed in function added by Amarendra dated 14-05-2021 
   	-------------------------------------------------------------------------------*/			
   	viewSellTodisplay($objdb["title"], $objdb["name"], $objdb["address"], $objdb["address2"], $objdb["city"], $objdb["state"], $objdb["zipcode"], $objdb["mainphone"], $objdb["mainphone"], $objdb["cellphone"], $objdb["email"], $ID, $objdb["selltoid"], $objdb["fax"], $in_loops, $loopurl, $status, $objdb["linked_profile"], $objdb["main_line_ph"], $objdb["main_line_ph_ext"],$style_tbl,$style_tbl_tr,$objdb["opt_out_mkt_sellto_email"], $objdb['sell_to_note']);
   	?>
<br/>
<?php			
   } 
   ?>
<?php		
   }else{
   	//viewSellTodisplay("", "", "", "", "", "", "", "" , "" , "" , "", $ID,0, "", $in_loops, $loopurl);
   }
   
   ?>
<?php  //if ($in_loops == "no") { ?> 
<form method="POST" action="editTables_mrg_purchasing.php?action=selltoadd" id="addsaletofrm" name="addsaletofrm">
<?php if ($in_loops == "yes") { ?> 	
<input type="hidden" name="companyid" value="<?php echo $ID?>">
<input type="hidden" name="search_result_url" value="<?php echo $loopurl?>">
<?php } else { ?> 	
<input type="hidden" name="id" value="<?php echo $ID?>">
<input type="hidden" name="search_result_url" value="no">
<input type="hidden" name="selltoadd_url" value="<?php echo $loopurl?>">
<?php } ?> 	
<input style="cursor:pointer;" type="submit" name="addsaleto" value="Add another SELL TO">
</form>
<?php		
   //}
   }
   
   /*-------------------------------------------------------------------------------
   Extra Parameter passed in function added by Amarendra dated 14-05-2021 
   -------------------------------------------------------------------------------*/
   function viewSellTodisplay(string $title, string $name, string $address, string $address2, string $city, string $state, string $zip, string $mainphone, string $directphone, string $cellphone, string $email, int $ID, int $selltoid, string $fax, string $in_loops, string $loopurl, string $status, string $linkedin_profile, string $main_line, string $main_line_ext, string $style_tbl, string $style_tbl_tr, string $opt_out_mkt_sellto_email, string $sell_to_note):void
   {
   ?>
<table width="100%" border="0" cellspacing="1" cellpadding="3" height="211" class="<?php echo $style_tbl;?>">
<tr align="center" class="<?php echo $style_tbl_tr;?>">
<td colspan="2" bgcolor="#C0CDDA" height="13">
<font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php if($status == "Have Boxes") {?>
<!--BUY FROM<br/>-->
<?php }else{?>	
<!--SELL TO<br/>-->
<?php }?>
(the person who is authorized and agrees to purchase)
<?php if ($in_loops == "yes") { ?> 
<?php } else { 
   $newurl="viewComp_info.php?".$loopurl."&Edit=3&show=companyinfo&selltoid=".$selltoid;
   
   ?>
<a href="#" onClick="comp_geturl('<?php echo $newurl; ?>');">
<?php }  ?>
<img bgcolor="#C0CDDA"  src="images/edit.jpg"></a>
&nbsp;
<?php if ($in_loops == "yes") { ?> 
<a href="delete_sellto_mrg_mysqli.php?<?php echo $loopurl?>&selltoid=<?php echo $selltoid?>" onclick="return confirm('Are you sure you want to delete this record?')">
<?php } else { ?>
<a href="delete_sellto_mrg_mysqli.php?ID=<?php echo $ID?>&selltoid=<?php echo $selltoid?>" onclick="return confirm('Are you sure you want to delete this record?')">
<?php }  ?>
<img bgcolor="#C0CDDA" src="images/del_img.png"></a>
</font>
</td></tr>
<tr bgcolor="#E4E4E4">
<td height="10" width="40%" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Name</font></td>
<td align="left" width="60%" height="10"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $name?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Title </font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $title?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Address 1</font>
<a target="_blank" href='https://www.google.com/maps/place/<?php echo str_replace(" ", "+" ,$address) . ",+" . str_replace(" ", "+" ,$city) . ",+" . str_replace(" ", "+" ,$state) . ",+" . str_replace(" ", "+" ,$zip)?>'>
<img src='images/googlemapicon.png' width='10px' height='10px'></a>
</td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $address?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="19" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Address 2</font></td>
<td align="left" height="19"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $address2?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">City</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $city?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">State/Province</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $state?>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Zip</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $zip?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Main line</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php if ($main_line != "") { echo "<img src='images/phone_img.png' width='12px' height='12px'>&nbsp; <a href='tel:$main_line'>" . $main_line . "</a>";} ?>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Main line Ext</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $main_line_ext?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Direct No</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php if ($directphone != "") { echo "<img src='images/phone_img.png' width='12px' height='12px'>&nbsp; <a href='tel:$directphone'>" . $directphone . "</a>";} ?>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Mobile No</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php if ($cellphone != "") { echo "<img src='images/phone_img.png' width='12px' height='12px'>&nbsp; <a href='tel:$cellphone'>" . $cellphone . "</a>";} ?>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Email</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<a href="mailto:<?php echo $email?>"><?php echo $email?></a>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
LinkedIn Profile</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php if ($linkedin_profile != "") {?>
<a target="_blank" href="<?php echo $linkedin_profile?>">Link to Profile</a></font></td>
<?php } ?>
</font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="13" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Fax</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $fax?></font></td>
</tr>
<!-- ----------------------------------------------------------------------------
   Row added to show record in sell to table added by Amarendra dated 14-05-2021 
   ------------------------------------------------------------------------------- -->
<tr bgcolor="#E4E4E4">
<td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
Opt-out Email Marketing</font></td>
<td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo ( $opt_out_mkt_sellto_email == 0)? "No" : "Yes"?></font></td>
</tr>
<tr bgcolor="#E4E4E4">
<td height="10" width="40%" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Note</font></td>
<td align="left" width="60%" height="10"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
<?php echo $sell_to_note; ?></font></td>
</tr>
</table>
<?php
   }
   //To display contact list
   function viewSellTodisplay_names(string $name, string $title, string $style_tbl, string $style_tbl_tr):void
   {
   	if($title == ""){
   		$show_name = $name;
   	}else{
   		$show_name = $name ." (".$title.")";
   	}
   ?>
<table width="100%" border="0" cellspacing="1" cellpadding="3" class="<?php echo $style_tbl; ?>">
   <tr bgcolor="#E4E4E4" >
      <td align="left" width="60%"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
         <?php echo $show_name;?></font>
      </td>
   </tr>
</table>
<?php
   }
   
   
   
   function viewSellToEdit(int $ID, int $selltoid, string $in_loops, string $loopurl, string $status, string $style_tbl, string $style_tbl_tr):void
   {
   	$qry = "Select * from b2bsellto where companyid = " . $ID . " order by selltoid";
   	
   	db_b2b();
   	$dt_view= db_query($qry);
   
   	if ( tep_db_num_rows($dt_view) > 0)
   	{
   		while ($objdb = array_shift($dt_view)) {
   			if ($objdb["selltoid"] == $selltoid)
   				/*-------------------------------------------------------------------------------
   				Extra Parameter passed in function added by Amarendra dated 14-05-2021 
   				-------------------------------------------------------------------------------*/
   				{ 
   					viewSellTodisplayedit($objdb["title"], $objdb["name"], $objdb["address"], $objdb["address2"], $objdb["city"], $objdb["state"], $objdb["zipcode"], $objdb["mainphone"], $objdb["mainphone"], $objdb["cellphone"], $objdb["email"], $ID, $selltoid, $objdb["fax"] , $in_loops, $loopurl, $status, $objdb["linked_profile"], $objdb["main_line_ph"], $objdb["main_line_ph_ext"],$style_tbl,$style_tbl_tr, $objdb["opt_out_mkt_sellto_email"],$objdb['sell_to_note']); }
   			else
   			{ 
   				viewSellTodisplay($objdb["title"], $objdb["name"], $objdb["address"], $objdb["address2"], $objdb["city"], $objdb["state"], $objdb["zipcode"], $objdb["mainphone"], $objdb["mainphone"], $objdb["cellphone"], $objdb["email"], $ID, $objdb["selltoid"], $objdb["fax"], $in_loops, $loopurl, $status, $objdb["linked_profile"], $objdb["main_line_ph"], $objdb["main_line_ph_ext"],$style_tbl,$style_tbl_tr, $objdb["opt_out_mkt_sellto_email"],$objdb['sell_to_note']);	}			
   		} 
   	}else{ 
   		viewSellTodisplayedit("", "", "", "", "", "", "", "" , "" , "" , "", $ID, 0, "", $in_loops, $loopurl, $status, "", "", "",$style_tbl,$style_tbl_tr,"");
   	}
   ?>
<?php
   }
   	
   /*-------------------------------------------------------------------------------
   Extra Parameter passed in function added by Amarendra dated 14-05-2021 
   -------------------------------------------------------------------------------*/
   function viewSellTodisplayedit(string $title, string $name, string $address, string $address2, string $city, string $state, string $zip, string $mainphone, string $directphone, string $cellphone, string $email, int $ID, int $selltoid, string $fax,  string $in_loops, string $loopurl,$status,  string $linkedin_profile, string $main_line, string $main_line_ext, string $style_tbl, string $style_tbl_tr, string $opt_out_mkt_sellto_email, string $sell_to_note):void
   {
   ?>
<form method=post action="editTables_mrg_purchasing.php" name="frmselltoedit" id="frmselltoedit" onSubmit="return formCheckInv()">
   <script>
      function formchk_selltoedit(){
      	if (document.getElementById("selltoemail").value != "")
      	{
      		var txtemail = document.getElementById("selltoemail").value;
      		
      		if (txtemail.substr(0, 1) == " "){
      			alert("You entered the contact email with a space before or after it. System automatically removed it prior to saving.");
      			return false;
      		}
      		if (txtemail.substr(txtemail.length-1, 1) == " "){
      			alert("You entered the contact email with a space before or after it. System automatically removed it prior to saving.");
      			return false;
      		}
      	}
      }
   </script>
   <table width="100%" border="0" cellspacing="1" cellpadding="1" height="211" class="<?php echo $style_tbl;?>">
      <tr align="center" class="<?php echo $style_tbl_tr;?>">
         <td colspan="2" bgcolor="#C0CDDA" >
            <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
               <?php if($status == "Have Boxes") {?>
               <!--BUY FROM<br/>-->
               <a href="update_sellto_primary_purchasing.php?ID=<?php echo $ID;?>&selltoid=<?php echo $selltoid; ?>">Make Primary Buy From</a><br>			
               <?php }else{?>	
               <!--SELL TO<br/>-->
               <a href="update_sellto_primary_purchasing.php?ID=<?php echo $ID;?>&selltoid=<?php echo $selltoid; ?>">Make Primary Sell To</a><br>			
               <?php } ?>
               (the person who is authorized and agrees to purchase)
            </font>
      </tr>
      <tr bgcolor="#E4E4E4">
         <td height="10" width="40%" ><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Name </font></td>
         <td align="left" width="60%" height="10"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            <input name="selltoname" value="<?php echo $name?>" size="20"></font>
         </td>
      </tr>
      <tr bgcolor="#E4E4E4">
         <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Title
            </font>
         </td>
         <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            <input name="selltotitle" value="<?php echo $title?>" size="20"></font>
         </td>
      </tr>
      <tr bgcolor="#E4E4E4">
         <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Address 1</font></td>
         <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            <input name="selltoAddress" value="<?php echo $address?>" size="20"></font>
         </td>
      </tr>
      <tr bgcolor="#E4E4E4">
         <td height="19"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Address 2</font></td>
         <td align="left" height="19"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            <input name="selltoAddress2" value="<?php echo $address2?>" size="20"></font>
         </td>
      </tr>
      <tr bgcolor="#E4E4E4">
         <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">City</font></td>
         <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            <input name="selltoCity" value="<?php echo $city?>" size="20"></font>
         </td>
      </tr>
      <tr bgcolor="#E4E4E4">
         <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">State/Province</font></td>
         <td align="left" height="13">
            <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            <select name="selltoState">
               <option value="" ></option>
               <?php
                  $tableedit  = "SELECT * FROM zones where zone_country_id in (223,38,37) ORDER BY zone_country_id desc, zone_name";
                  
                  db_b2b();
                  $dt_view_res = db_query($tableedit);
                  
                  while ($row = array_shift($dt_view_res)) {
                  ?>
               <option 
                  <?php 
                     if ((trim($state) == trim($row["zone_code"])) ||  (trim($state) == trim($row["zone_name"])))
                      echo " selected ";
                       ?> value="<?php echo trim($row["zone_code"])?>">
                  <?php echo $row["zone_name"]?>
                  (<?php echo $row["zone_code"]?>)
               </option>
               <?php
                  }
                  ?>
            </select>
         </td>
      </tr>
      <tr bgcolor="#E4E4E4">
         <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Zip</font></td>
         <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            <input name="selltoZip" value="<?php echo $zip?>" size="20"></font>
         </td>
      </tr>
      <tr bgcolor="#E4E4E4">
         <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            Main line</font>
         </td>
         <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            <input name="sellto_main_line" value="<?php echo $main_line?>" size="20"></font>
         </td>
      </tr>
      <tr bgcolor="#E4E4E4">
         <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            Main line Ext</font>
         </td>
         <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            <input name="sellto_main_line_ext" value="<?php echo $main_line_ext?>" size="20"></font>
         </td>
      </tr>
      <tr bgcolor="#E4E4E4">
         <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            Direct No</font>
         </td>
         <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            <input name="mainphone" value="<?php echo $directphone?>" size="20"></font>
         </td>
      </tr>
      <tr bgcolor="#E4E4E4">
         <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            Mobile No</font>
         </td>
         <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            <input name="cellphone" value="<?php echo $cellphone?>" size="20"></font>
         </td>
      </tr>
      <tr bgcolor="#E4E4E4">
         <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            Email</font>
         </td>
         <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            <input name="selltoemail" id="selltoemail" value="<?php echo $email?>" size="20" ></font>
         </td>
      </tr>
      <tr bgcolor="#E4E4E4">
         <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            LinkedIn Profile</font>
         </td>
         <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            <input name="sellto_linkedin_profile" value="<?php echo $linkedin_profile?>" ></font>
         </td>
      </tr>
      <tr bgcolor="#E4E4E4">
         <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            Fax</font>
         </td>
         <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            <input name="mainfax" value="<?php echo $fax?>" size="20"></font>
         </td>
      </tr>
      <!-- ----------------------------------------------------------------------------
         Row added with checkbox in ship to table added by Amarendra dated 14-05-2021 
         ------------------------------------------------------------------------------- -->
      <tr bgcolor="#E4E4E4">
         <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            Opt-out Email Marketing</font>
         </td>
         <td align="left" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            <input type="checkbox" name="opt_out_mkt_sellto_email" <?php echo ($opt_out_mkt_sellto_email ==1)? "checked='checked'" : ""?> value="<?php echo $opt_out_mkt_sellto_email?>">
            </font>
         </td>
      </tr>
      <tr bgcolor="#E4E4E4">
         <td height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Note</font></td>
         <td align="left" height="13"><textarea name="sell_to_note" ><?php echo $sell_to_note; ?></textarea></td>
      </tr>
      <tr bgcolor="#E4E4E4">
         <td colspan=2>
            <p align="center">
               &nbsp;<input align="center" style="cursor:pointer;" type="submit" value="Save" onclick="return formchk_selltoedit();">
               <?php if ($in_loops == "yes") { 		
                  $tmpstr = $loopurl;
                  $tmpstr = str_replace("Edit_mode=newsellto_edit", "", $tmpstr);?> 	
               <!--<font face="Arial, Helvetica, sans-serif" size="1" color="#333333">&nbsp;<a href="search_results.php?<?php //=$tmpstr?>">nevermind</a></font>-->
               <?php } else { ?> 	
               <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">&nbsp;<a href="viewComp_info.php?<?php echo $loopurl?>&show=companyinfo&nmind=yes">nevermind</a></font>
               <?php } ?> 
         </td>
      </tr>
   </table>
   <?php if ($in_loops == "yes") { ?> 	
   <input type="hidden" name="search_result_url" value="<?php echo $tmpstr?>">
   <?php } else { ?> 	
   <input type="hidden" name="search_result_url" value="no">
   <?php } ?> 	
   <input type=hidden name="editTable" value="sellto">
   <input type=hidden name="id" value="<?php echo $ID?>">
   <input type=hidden name="selltoid" value="<?php echo $selltoid?>">
   <input type=hidden name="sellto_url" value="<?php echo $loopurl?>">
</form>
<?php
   }
   
   	
   ////////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////////
   //GAYLORD INFO
   ////////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////////
   
   
   function viewGaylordInfo (string $shape, string $shape_rect, string $shape_oct, string $wall, string $wall_2, string $wall_3, string $wall_4, string $wall_5, string $wall_6, string $wall_7, string $wall_8, string $thetop, string $top_nolid, string $top_partial, string $top_full, string $top_hinged, string $top_remove, string $bottom, string $bottom_no, string $bottom_partial, string $bottom_partialsheet, string $bottom_fullflap, string $bottom_interlocking, string $bottom_tray, string $vents, string $vents_no, string $vents_yes, string $box_pallet, string $box_condition, int $quantity, int $gbox_dimensions, int $gbox_size_id, string $frequency, string $previous_contents, int $largest_qty, string $loading, int $price_beat, string $delivery_date, int $ID, string $in_loopflg, string $height_range_min , string $height_range_max):void
   {
   
   $aa = "SELECT * FROM boxesGaylord WHERE companyID = " . $ID;
   
   db_b2b();
   $dt_view_res = db_query($aa);
   
   $gb = array_shift($dt_view_res);
   $d = array();	
   	if ($gb["type"] == "spbox_not")
   	{
   	
   	$d["shape_rect"] = "Shape-Rectangular";
   	$d["shape_oct"] = "Shape-Octagonal";
   	$d["wall_2"] = "2-Wall";
   	$d["wall_3"] = "3-Wall";
   	$d["wall_4"] = "4-Wall";
   	$d["wall_5"] = "5-Wall";
   	$d["wall_6"] = "6-Wall";
   	$d["wall_7"] = "7-Wall";
   	$d["wall_8"] = "8-Wall";
   	$d["top_nolid"] = "No Lid";
   	$d["top_partial"] = "Partial Lid";
   	$d["top_full"] = "Full Lid";
   	$d["top_hinged"] = "Hinged Lid";
   	$d["top_remove"] = "Removable Lid";
   	$d["bottom_no"] = "No Bottom";
   	$d["bottom_partial"] = "Partial Bottom";
   	$d["bottom_partialsheet"] = "Bottom with Slipsheet";
   	$d["bottom_fullflap"] = "Full Flap Bottom";
   	$d["bottom_interlocking"] = "Interlocking Bottom";
   	$d["bottom_tray"] = "Tray Bottom";
   	$d["vents_no"] = "No Vents";
   	$d["vents_yes"] = "Yes Vents";
   	$d["box_pallet"] = "Yes Pallets";
   	$d["box_condition"] = "Use of Boxes";
   	$d["quantity"] = "Quantity";
   		$d["gbox_dimensions"] = "Dimensions";
   	$d["frequency"] = "Frequency";
   	$d["largest_qty"] = "Holding Quantity";
   	$d["price_beat"] = "Price to Beat";
   	$d["delivery_date"] = "Delivery Date";
   	$d["height_range_min"] = "Height Range Min";
   	$d["height_range_max"] = "Height Range Max";
   	}
   	if ($gb["type"] == "box_cml") {
   	$d["shape"] = "Entered Shape";
   	$d["wall"] = "Entered Wall";
   	$d["thetop"] = "Entered Top";
   	$d["bottom"] = "Entered Bottom";
   	$d["vents"] = "Entered Vents";
   	$d["box_condition"] = "Condition";
   	$d["quantity"] = "Quantity";
   	$d["gbox_dimensions"] = "Dimensions";
   	$d["frequency"] = "Frequency";
   	$d["previous_contents"] = "Previous Contents";
   	$d["largest_qty"] = "Holding Quantity";
   	$d["loading"] = "Loading Dock";
   	$d["price_beat"] = "Price to Beat";
   	$d["delivery_date"] = "Delivery Date";
   	}
   
   
   ?>
<div id="divGaylordBox" >
   <table width="100%" border="0" cellspacing="1" cellpadding="1">
      <tr align="center">
         <td colspan="2" bgcolor="#C0CDDA">
            <font face="Arial, Helvetica, sans-serif" size="1">
               GAYLORD TOTE REQUESTED 
               <a href="#" onclick="document.getElementById('divGaylordBoxEdit').style.display='block';document.getElementById('divGaylordBox').style.display='none'; return false;">
                  <img bgcolor="#C0CDDA"  src="images/edit.jpg"></a
            </font>
         </td>
      </tr>
      <tr align="center">
      <td colspan="2">
      <?php
         foreach ($d as $key => $value) {
         ?>
      <tr bgcolor="#E4E4E4">
      <td><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $value?></font></td>
      <td width="30%"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php
         If ($gb[$key] == "1" )
         echo "Yes";
         elseIf ($gb[$key] == "0") 
         echo "No";
         else
         echo $gb[$key];
         if($key=="gbox_dimensions")
         {
         echo $gbox_dimensions;
         }
         ?>
      </font></td>
      </tr>
      <?php
         }
         ?>
      <tr align="center">
      <td colspan="2" bgcolor="#E4E4E4">
      <a style='color:#0000FF;' id="lightbox" href="javascript:void(0);" onclick="display_gaylords(<?php echo $ID;?>,0)">
      <font face="Arial, Helvetica, sans-serif" size="1" color="#0000FF">GAYLORD MATCHING TOOL</a></font>
      <span id="gayloardtoolautoload" name="gayloardtoolautoload" style='color:red;'></span>
      </td>
      </tr>
      <script>
         display_gaylords_autoload(<?php echo $ID;?>,0);
      </script>	
   </table>
</div>
<div id="divGaylordBoxEdit" style="display:none;">
   <?php 
      //echo $gbox_dimensions;
      	viewGaylordEdit_new($shape,$shape_rect,$shape_oct,$wall,$wall_2,$wall_3,$wall_4,$wall_5,$wall_6,$wall_7,$wall_8,$thetop,$top_nolid,$top_partial,$top_full,$top_hinged,$top_remove,$bottom,$bottom_no,$bottom_partial,$bottom_partialsheet,$bottom_fullflap,$bottom_interlocking,$bottom_tray,$vents,$vents_no,$vents_yes,$box_pallet,$box_condition,$quantity,$frequency,$previous_contents,$largest_qty,$loading,$price_beat,$delivery_date,$ID, $gb["ID"], $height_range_min, $height_range_max,$gbox_dimensions, $gbox_size_id);		
      ?>	
</div>
<?php
   }
   
   
   function viewGaylordEdit_new (mixed $shape, mixed $shape_rect, mixed $shape_oct, mixed $wall, mixed $wall_2, mixed $wall_3, mixed $wall_4, mixed $wall_5, mixed $wall_6, mixed $wall_7, mixed $wall_8, mixed $thetop, mixed $top_nolid, mixed $top_partial, mixed $top_full, mixed $top_hinged, mixed $top_remove, mixed $bottom, mixed $bottom_no, mixed $bottom_partial, string $bottom_partialsheet, mixed $bottom_fullflap, mixed $bottom_interlocking, mixed $bottom_tray, mixed $vents, mixed $vents_no, mixed $vents_yes, mixed $box_pallet, mixed $box_condition, mixed $quantity, mixed $frequency, mixed $previous_contents, mixed $largest_qty, mixed $loading, mixed $price_beat, mixed $delivery_date, int $ID, mixed $gbid, mixed $height_range_min , mixed $height_range_max, mixed $gbox_dimensions, mixed $gbox_size_id):void
   {
   
   	$aa = "SELECT * FROM boxesGaylord WHERE companyID = " . $ID;
   
   	db_b2b();
   	$dt_view_res = db_query($aa);
   
   $gb = array_shift($dt_view_res);
   $d = array();
   if ($gb["type"] == "spbox_not") {
   ?>
<!-- <iframe name="ifrmgarlordinfo" src="editTables_mrg.php">
   </iframe> -->
<table width="100%" border="0" cellspacing="1" cellpadding="1">
   <form method="post" action="#">
      <tr align="center">
         <td colspan="2" bgcolor="#C0CDDA" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">GAYLORD BOX DETAILS - Buying</font></td>
      </tr>
      <?php
         $b["box_condition"] = "Use of Boxes";
         $b["quantity"] = "Quantity";
         $b["frequency"] = "Frequency";
         $b["largest_qty"] = "Holding Quantity";
         $b["loading"] = "Loading Dock";
         $b["price_beat"] = "Price To Beat";
         $b["delivery_date"] = "Delivery Date";
         $b["gbox_dimensions"] = "Dimensions";//gbox_dimensions
         
         foreach ($b as $key => $value) {
         ?>
      <tr bgcolor="#E4E4E4">
         <td><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $value?></font></td>
         <td width="30%">
            <?php
               if($key=="gbox_dimensions")
               {
               	$dims1=explode("x", $gbox_dimensions);	
               	//
               	//for($i=0; $i<count($dims1); $i++){
               		?>
            <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            Length: <input name="glength" type="text" id="glength" value="<?php echo $dims1[0]; ?>" size="4"><br>
            Width: &nbsp;&nbsp;<input type="text" name="gwidth" id="gwidth" value="<?php echo $dims1[1]; ?>" size="4"><br>
            Height: <input type="text" name="gheight" id="gheight" value="<?php echo $dims1[2]; ?>" size="4">
            <input type="hidden" name="gbox_size_id" id="gbox_size_id" value="<?php echo $gbox_size_id; ?>">
            </font>
            <?php
               //}
               }
               else{
               ?>
            <input type="text" name="<?php echo $key?>" id="<?php echo $key?>" value="<?php echo $gb[$key]?>">
            <?php
               }		
               	?>
         </td>
      </tr>
      <?php
         }
         ?>
      <tr bgcolor="#E4E4E4">
         <td><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Height Range Min</font></td>
         <td width="30%">
            <select name="height_range_min" id="height_range_min" >
            <?php	
               for ($tmpcnt=1; $tmpcnt <= 100;$tmpcnt++)
               {
               	echo "<option value='" . $tmpcnt;
               	if ($height_range_min == $tmpcnt) { echo " selected "; }
               	echo "'>" . $tmpcnt ." </option>";
               }
               ?></select>	
         </td>
      </tr>
      <tr bgcolor="#E4E4E4">
         <td><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Height Range Max</font></td>
         <td width="30%">
            <select name="height_range_max" id="height_range_max" >
            <?php	
               for ($tmpcnt=1; $tmpcnt <= 100;$tmpcnt++) 
               {
               	echo "<option value='" . $tmpcnt;
               	if ($height_range_max == $tmpcnt) { echo " selected "; }
               	echo "'>" . $tmpcnt ." </option>";
               }
               ?></select>	
         </td>
      </tr>
      <?php
         $d["shape_rect"] = "Shape-Rectangular";
         $d["shape_oct"] = "Shape-Octagonal";
         $d["wall_2"] = "2-Wall";
         $d["wall_3"] = "3-Wall";
         $d["wall_4"] = "4-Wall";
         $d["wall_5"] = "5-Wall";
         $d["wall_6"] = "6-Wall";
         $d["wall_7"] = "7-Wall";
         $d["wall_8"] = "8-Wall";
         $d["top_nolid"] = "No Lid";
         $d["top_partial"] = "Partial Lid";
         $d["top_full"] = "Full Lid";
         $d["top_hinged"] = "Hinged Lid";
         $d["top_remove"] = "Removable Lid";
         $d["bottom_no"] = "No Bottom";
         $d["bottom_partial"] = "Partial Bottom";
         $d["bottom_partialsheet"] = "Bottom with Slipsheet";
         $d["bottom_fullflap"] = "Full Flap Bottom";
         $d["bottom_interlocking"] = "Interlocking Bottom";
         $d["bottom_tray"] = "Tray Bottom";
         $d["vents_no"] = "No Vents";
         $d["vents_yes"] = "Yes Vents";
         $d["box_pallet"] = "Yes Pallets";
         
         
         ?>
      <?php
         foreach ($d as $key => $value) {
         ?>
      <tr bgcolor="#E4E4E4">
         <td><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $value?></font></td>
         <td width="30%"><input type="checkbox" name="<?php echo $key?>" id="<?php echo $key?>" <?php if ($gb[$key] == "1" ) echo "CHECKED"; ?> ></td>
      </tr>
      <?php
         }
         ?>	
      <input type=hidden name="editTable" value="boxesGaylord">
      <input type=hidden name="id" id="id" value="<?php echo $ID?>">
      <input type=hidden name="bid" id="bid" value="<?php echo $gbid?>">
      <tr bgcolor="#E4E4E4">
         <td width="50%" align="center">
            <input style="cursor:pointer;" type="button" value="Submit" onclick="updategaylordbox()" name="B1">
         </td>
         <td width="50%" align="center">
            <input type="button" style="cursor:pointer;" name="btncancel" value="Cancel" onclick="document.getElementById('divGaylordBoxEdit').style.display='none';document.getElementById('divGaylordBox').style.display='block';"/>
         </td>
      </tr>
   </form>
</table>
<?php
   }
   ?>
<?php
   if ($gb["type"] == "box_cml") {
   ?>
<table width="100%" border="0" cellspacing="1" cellpadding="1">
   <form method="post" action="editTables_mrg.php">
      <tr align="center">
         <td colspan="2" bgcolor="#C0CDDA" height="13"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">GAYLORD BOX DETAILS - Selling</font></td>
      </tr>
      <?php
         $d["shape"] = "Entered Shape";
         $d["wall"] = "Entered Wall";
         $d["thetop"] = "Entered Top";
         $d["bottom"] = "Entered Bottom";
         $d["vents"] = "Entered Vents";
         $d["box_condition"] = "Condition";
         $d["quantity"] = "Frequency";
         $d["frequency"] = "Entered Vents";
         $d["previous_contents"] = "Previous Contents";
         $d["largest_qty"] = "Holding Quantity";
         $d["loading"] = "Loading Dock";
         $d["price_beat"] = "Price to Beat";
         $d["delivery_date"] = "Delivery Date";
         
         foreach ($d as $key => $value) {
         
         ?>
      <tr bgcolor="#E4E4E4">
         <td><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $value?></font></td>
         <td width="30%"><input type="text" name="<?php echo $key?>" id="<?php echo $key?>" value="<?php echo $gb[$key]?>"></td>
      </tr>
      <?php
         }
         ?>
      <input type=hidden name="editTable" id="editTable" value="boxesGaylord">
      <input type=hidden name="id" id="id" value="<?php echo $ID?>">
      <tr bgcolor="#E4E4E4">
         <td width="100%" colspan="2" align="center"><input style="cursor:pointer;" type="submit" value="Submit" name="B1"></td>
      </tr>
   </form>
</table>
<?php
   }	
   
   }
   
   
   
   
   function viewBoxRequest(mixed $box1, mixed $box2, mixed $box3, mixed $box4, mixed $q1, mixed $q2, mixed $q3, mixed $q4, mixed $q5, mixed $q6, mixed $q7, mixed $q8, mixed $q9, mixed $q10, mixed $notes, int $ID):void
   
   {
   
   
   db_b2b();
   $strQuery = db_query("SELECT * FROM companyInfo WHERE ID ='$ID'");
   
   $rsd=array_shift($strQuery)
   
   ?>
<table width="100%" border="0" cellspacing="1" cellpadding="1">
   <?php
      if ($rsd['req_type'] == "box_cml")
      {
      	db_b2b();
      	$strquery=db_query("SELECT * FROM boxesForPickup WHERE companyID =''$ID'");
      	while($redp=array_shift($strquery))
      	{
      	$z = array();
      	//strQuery = "SELECT * FROM boxesForPickup WHERE companyID = " & ID
      	//Set rsDP = objConn.Execute(strQuery)
      	//Set d=Server.CreateObject("Scripting.Dictionary")
      	$z['gbox']="Gaylord Boxes";
      	$z['if_gaylords']="If Gaylords";
      	$z['no_of_rescue']="Estimated total number of boxes in this rescue";
      	$z['list_dimensions']="I can’t list the dimensions, the boxes are all different";
      	$z['length_lside']="Length (longest side)";
      	$z['widthInch']="Width (shortest side)";
      	$z['depthInch']="Depth (height excluding flaps)";
      	$z['thick']="Wall Thickness";
      	$z['color']="Color";
      	$z['printing']="Printing";
      	$z['labels']="Mailing Labels";
      	$z['comments']="Comments";
      	$z['box_condition']="Condition";
      	$z['priceGetting']="Price Getting";
      	$z['req_another_box']="Request another box";
      	
      	}
      	
      ?>
   <tr align="center">
      <td colspan="2" bgcolor="#C0CDDA"><font face="Arial, Helvetica, sans-serif" size="1">BOX REQUEST INFORMATION <a href="viewCompany.php?ID=<?php echo $ID;?>&bid=<?php echo $redp['ID']; ?>&Edit=3"><img bgcolor="#C0CDDA"  src="images/edit.jpg"></a></font></td>
   </tr>
   <form method="post" action="editTables_mrg.php">
      <?php
         foreach ($z as $key => $value) {
         ?>
      <tr bgcolor="#E4E4E4">
         <td><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $value; ?></font></td>
         <td width="30%"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $key; ?></font></td>
      </tr>
      <?php
         }
         ?>
   </form>
   <?php		
      } elseif ($rsd['req_type']=="spbox_not")
      {
      	db_b2b();
      	$strQuery=db_query("SELECT * FROM boxesrequested WHERE companyID = '$ID'");
      	while($rsdp=array_shift($strQuery))
      	{
      	$z = array();
      	//strQuery = "SELECT * FROM boxesrequested WHERE companyID = '" & ID & "'"
      	//Set rsDP = objConn.Execute(strQuery)
      	//Set d=Server.CreateObject("Scripting.Dictionary");
      	$z['preferred_delivery_date']="Preferred Delivery Date";
      	$z['receiving_dock_info']="Receiving Dock Info";
      	$z['receiving_dock_info_other']="Receiving Dock Info Other";
      	$z['gbox']="I need gaylord boxes (pallet boxes measuring approximately 42 x 48 x 36)";
      	$z['if_gaylords']="If Gaylords";
      	$z['cubic_order']="Specify Dimensions";
      	$z['cubicFeet']="Approx. cubic feet";
      	$z['lengthInch']="Length (longest side)";
      	$z['lengthFraction']="Can be";
      	$z['widthInch']="Width (shortest side)";
      	$z['widthFraction']="Can be";
      	$z['depthInch']="Depth (height excluding flaps)";
      	$z['depthFraction']="Can be";
      	$z['wall_thickness']="Wall thickness";
      	$z['color']="Color";
      	$z['printing']="Printing";
      	$z['unc_printing']="Unnacceptable printing";
      	$z['dimension_stamp']="Dimension Stamp";
      	$z['qty_for_box']="Quantity for this box";
      	$z['qty_for_month']="Quanitity used each month";
      	$z['recurring']="Recurring";
      	$z['price']="Price currently paid (help us be competitive)";
      	$z['current_vendor']="Current Vendor";
      	$z['what_this_box_used_for']="What this box is used for";
      	$z['comments']="Comments";
      	$z['req_another_box']="Request another box";
      	
      }
      
      ?>
   <tr align="center">
      <td colspan="2" bgcolor="#C0CDDA"><font face="Arial, Helvetica, sans-serif" size="1">BOX REQUEST</font><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">INFORMATION <a href="viewCompany.php?ID=<?php echo $ID; ?>&bid=
         <?php echo $rsdp['ID'] ?>&Edit=3"><img bgcolor="#C0CDDA"  src="images/edit.jpg"></a></font></td>
   </tr>
   <form method="post" action="editTables_mrg.php">
      <?php
         foreach ($z as $key => $value) 
         {
         ?>
      <tr bgcolor="#E4E4E4">
         <td><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $value;?></font></td>
         <td width="30%"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $key; ?></font></td>
      </tr>
      <?php
         }
         
         ?>
   </form>
   <tr align="center">
      <td colspan="2" bgcolor="#C0CDDA"><font face="Arial, Helvetica, sans-serif" size="1">BOX REQUEST INFORMATION</font> <a href="viewCompany.asp?ID=<%=ID%>&Edit=3"><img bgcolor="#C0CDDA"  src="images/edit.jpg"></a></td>
   </tr>
   <?php
      db_b2b();
      $X=db_query("Select * From boxesrequested Where CompanyID = '$ID'");
      while($fetchboxes=array_shift($X))
      {
      ?>
   <tr bgcolor="#E4E4E4">
      <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
         <a href="editBoxesRequested.php?ID=<?php echo $fetchboxes['ID']; ?>"><?php echo $fetchboxes['ID']; ?></a>
         </font>
      </td>
      <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
         <?php
            echo $fetchboxes['lengthInch']." - ".$fetchboxes['length_new_max']. " x "; 
            echo $fetchboxes['widthInch']." - ".$fetchboxes['width_new_max']. " x "; 
            echo $fetchboxes['depthInch']." - ".$fetchboxes['depth_new_max'] . "&nbsp;&nbsp;";
            echo $fetchboxes['newUsed']." " . $fetchboxes['printing'] . " " . $fetchboxes['labels']." ".$fetchboxes['writing']." ". 	        $fetchboxes['burst'];	
            echo "<br>U-line: " . $fetchboxes['ulineDollar'].$fetchboxes['ulineCents'];
            echo " Cost: " .$fetchboxes['costDollar'].$fetchboxes['costCents'];
            echo " Quantity: ".$fetchboxes['quantity'];
            echo "<BR>".$fetchboxes['description'];
            
            
            
            ?>
         </font>
      </td>
   </tr>
   <?php
      }
      ?>
   <tr bgcolor="#E4E4E4">
      <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Box #1</font></td>
      <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
         <?php
            if ($box1[0] <> 0)
            {
            	echo $box1[0];
            	if ($box1[1] <> 0)
            	{
            		echo " " . $box1[1]. "/" . $box1[2] . " x ";
            	}	
            	else
            	{
            		echo " x ";
            		
            	}	
            	
            	echo $box1[3];
            	if ($box1[4] <> 0)
            	{
            		echo " " & $box1[4]. "/" . $box1[5] . " x ";
            	}
            	else
            	{
            		echo " x ";
            	}
            	echo $box1[6];
            	if ($box1[7] <> 0)
            	{
            		echo " " . $box1[7] . "/" . $box1[8] . " (";
            	}
            	else
            	{
            		echo " (";
            	}
            
            	if ($box1[2] == 0)
            	{
            		$box1[2] = 1;
            	}
            
            	if ($box1[5] == 0)
            	{
            		$box1[5] = 1;
            	}
            
            	if ($box1[8] == 0)
            	{
            		$box1[8] = 1;
            		
            	}
            	
            	/*echo round(($box1[0] + $box1[1] /$box1[2]) * ($box1[3] + $box1[4] / $box1[5]) * ($box1[6] + $box1[7] / $box1[8] / 1728,2);
            	echo $box1[9] . " " . $box1[10] . " " . $box1[11] . " " . $box1[12];*/
            
            
            }
            
            ?></font>
      </td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Box #2</font></td>
      <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
         <?php
            if ($box2[0] <> 0)
            {
            	echo $box2[0];
            	if ($box2[1] <> 0)
            	{
            		echo " " . $box2[1] . "/" .$box2[2] . " x ";
            	}
            	else
            	{
            		echo " x ";
            	}
            	
            	echo $box2[3];
            	if ($box2[4] <> 0)
            	{
            		echo " " . $box2[4] . "/" . $box2[5] . " x ";
            	}
            	else
            	{
            		echo " x ";
            	}
            	echo $box2[6];
            	if ($box2[7] <> 0){
            		echo " " . $box2[7] . "/" . $box2[8] . " (";
            	}
            	else
            	{
            		echo " (";
            	}
            	
            	if ($box2[2] == 0)
            	{
            		$box2[2] = 1;
            	}
            
            	if ($box2[5] == 0)
            	{
            		$box2[5] = 1;
            	}
            
            	if ($box2[8] == 0)
            	{
            		$box2[8] = 1;
            	}
            	echo round(($box2[0] + $box2[1] / $box2[2]) * ($box2[3] + $box2[4] / $box2[5]) * ($box2[6] + $box2[7] / $box2[8]) / 1728, 2). "cf) ";
            	echo $box2[9] . " " . $box2[10] . " " . $box2[11] . " " . $box2[12];
            
            }
            ?>
         </font>
      </td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Box #3</font></td>
      <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
         <?php
            if ($box3[0] <> 0)
            {
            	echo $box3[0];
            	if ($box3[1] <> 0)
            	{
            		echo " " . $box3[1] . "/" . $box3[2] . " x ";
            	}
            	else
            	{
            		echo " x ";
            	}
            	echo $box3[3];
            	if ($box3[4] <> 0)
            	{
            		echo " " . $box3[4] . "/" . $box3[5] . " x ";
            	}
            	else
            	{
            		echo " x ";
            	}
            	echo $box3[6];
            	if ($box3[7] <> 0)
            	{
            		echo " " . $box3[7] . "/" . $box3[8] & " x ";
            	}
            	else
            	{
            		echo " x ";
            	}
            	
            	if($box3[2] == 0)
            	{	
            		$box3[2] = 1;
            	}
            
            	if ($box3[5] == 0)
            	{
            		$box3[5] = 1;
            	}
            
            	if ($box3[8] == 0)
            	{
            		$box3[8] = 1;
            	}
            	echo round(($box3[0] + $box3[1] / $box3[2]) * ($box3[3] + $box3[4] / $box3[5]) * ($box3[6] + $box3[7] / $box3[8]) / 1728, 2). "cf) ";
            	echo $box3[9] . " " . $box3[10] . " " . $box3[11] . " " . $box3[12];
            
            }
            ?></font>
      </td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Box #4</font></td>
      <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
         <?php
            if ($box4[0] <> 0)
            {
            	echo $box4[0];
            	
            	if ($box4[1] <> 0)
            	{
            		echo " " . $box4[1] . "/" . $box4[2] . " x ";
            	}	
            	else
            	{
            		echo " x ";
            	}
            	echo $box4[3];
            	if ($box4[4] <> 0)
            	{
            		echo " " . $box4[4] . "/" . $box4[5] . " x ";
            	}
            	else
            	{
            		echo " x ";
            	}
            	echo $box4[6];
            	if ($box4[7] <> 0)
            	{
            		echo " " . $box4[7] . "/" . $box4[8] . " x (";
            	}
            	else
            	{
            		echo " x (";
            	}
            	
            	if ($box4[2] == 0)
            	{
            		$box4[2] = 1;
            	}
            
            	if ($box4[5] == 0)
            	{
            		$box4[5] = 1;
            	}
            
            	if ($box4[8] = 0 )
            	{
            		$box4[8] = 1;
            	}
            
            	echo round(($box4[0] + $box4[1] / $box4[2]) * ($box4[3] + $box4[4] / $box4[5]) * ($box4[6] + $box4[7] / $box4(8)) / 1728, 2). "cf) ";
            	echo $box4[9] . " " . $box4[10] . " " . $box4[11] . " " . $box4[12];
            }
            
            
            ?></font>
      </td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">How will the boxes be
         used?</font>
      </td>
      <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
         <?php echo $q1; ?></font>
      </td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td width="160"><font face="Arial, Helvetica, sans-serif" size="1">When do you
         need the boxes?</font>
      </td>
      <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
         <?php echo $q2; ?></font>
      </td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td width="160"><font face="Arial, Helvetica, sans-serif" size="1">Delivered or
         pickup?</font>
      </td>
      <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
         <?php echo $q3; ?></font>
      </td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td width="160"><font face="Arial, Helvetica, sans-serif" size="1">Can boxes be
         larger?</font>
      </td>
      <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
         <?php echo $q4; ?></font>
      </td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td width="160"><font face="Arial, Helvetica, sans-serif" size="1">Can boxes be
         smaller?</font>
      </td>
      <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
         <?php echo $q5; ?></font>
      </td>
   </tr>
   <tr>
      <td bgcolor="#E4E4E4" width="160">
         <font face="Arial, Helvetica, sans-serif" size="1">Can there be markings?</font>
      </td>
      <td bgcolor="#E4E4E4" align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
         <?php echo $q6; ?></font>
      </td>
   </tr>
   <tr>
      <td bgcolor="#E4E4E4" width="160">
         <font face="Arial, Helvetica, sans-serif" size="1">Can the boxes have other
         names?</font>
      </td>
      <td bgcolor="#E4E4E4" align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
         <?php echo $q7; ?></font>
      </td>
   </tr>
   <tr>
      <td bgcolor="#E4E4E4" width="160">
         <font face="Arial, Helvetica, sans-serif" size="1">Can the boxes have labels or stickers?</font>
      </td>
      <td bgcolor="#E4E4E4" align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
         <?php echo $q8; ?></font>
      </td>
   </tr>
   <tr>
      <td bgcolor="#E4E4E4" width="160">
         <font face="Arial, Helvetica, sans-serif" size="1">Pricing for new or used
         boxes?</font>
      </td>
      <td bgcolor="#E4E4E4" align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
         <?php echo $q9; ?></font>
      </td>
   </tr>
   <tr>
      <td bgcolor="#E4E4E4" width="160">
         <font face="Arial, Helvetica, sans-serif" size="1">One time or recurring order?</font>
      </td>
      <td bgcolor="#E4E4E4" align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
         <?php echo $q10; ?></font>
      </td>
   </tr>
   <tr>
      <td bgcolor="#E4E4E4" width="160">
         <font face="Arial, Helvetica, sans-serif" size="1">Notes</font>
      </td>
      <td bgcolor="#E4E4E4" align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
         <?php echo $notes; ?></font>
      </td>
   </tr>
</table>
<?php
   }
   }
   
   
   
   
   function newViewBoxRequest(mixed $ID):void
   {
   ?>
<script LANGUAGE="JavaScript">
   function isNumberKey(evt){
   	var charCode = (evt.which) ? evt.which : event.keyCode
   	if (charCode > 31 && (charCode < 48 || charCode > 57))
   		if (charCode == 46 || charCode == 44 || charCode == 45)
   		{return true;}
   		else{return false;}
   	}else{
   			return true;
   	}
   }	
   
</script>
<div id="divBoxReqNew" style="display:none;">
   <form name="frmeditboxreq_add" action="#" method="POST">
      <input type="hidden" name="editcompanyid" id="editcompanyid" value="<?php echo $ID;?>">
      <table cellSpacing="1" cellPadding="1" border="0" style="font-size:1;">
         <tr>
            <td colspan="3" bgcolor="#C0CDDA"><font face="Arial, Helvetica, sans-serif" size="1">SHIPPING BOX REQUESTED (In Add mode)</font></td>
         </tr>
         <tr valign="top" bgcolor="#E4E4E4">
            <td><font size="1" face="Arial, Helvetica, sans-serif">Length:</font></td>
            <td>
               <input type="text" name="length" id="length" size="4">	
            </td>
         </tr>
         <tr valign="top" bgcolor="#E4E4E4">
            <td><font size="1" face="Arial, Helvetica, sans-serif">Width:</font></td>
            <td>
               <input type="text" name="width" size="4" id="width">
            </td>
         </tr>
         <tr valign="top" bgcolor="#E4E4E4">
            <td><font size="1" face="Arial, Helvetica, sans-serif">Height:</font></td>
            <td>
               <input type="text" name="height" size="4" id="height">
            </td>
         </tr>
         <tr valign="top" bgcolor="#E4E4E4">
            <td><font size="1" face="Arial, Helvetica, sans-serif">Wall:</font></td>
            <td colspan="2">
               <select name="wall" id="wall">
                  <option value="">Please Select</option>
                  <option value="1-Wall" >1-Wall</option>
                  <option value="2-Wall" >2-Wall</option>
                  <option value="3-Wall" >3-Wall</option>
                  <option value="4-Wall" >4-Wall</option>
                  <option value="5-Wall" >5-Wall</option>
               </select>
            </td>
         </tr>
         <tr valign="top" bgcolor="#E4E4E4">
            <td><font size="1" face="Arial, Helvetica, sans-serif">Quantity Requested:</font></td>
            <td colspan="2"><input name="quantityshipbox" type="text" id="quantityshipbox" size="7" maxlength="7" value=""></td>
         </tr>
         <tr valign="top" bgcolor="#E4E4E4">
            <td><font size="1" face="Arial, Helvetica, sans-serif">Recurring / One Time:</font></td>
            <td colspan="2">
               <select name="frequency_boxreq" id="frequency_boxreq">
                  <option>Please Select</option>
                  <option value="Recurring" >Recurring</option>
                  <option value="One-Time" >One-Time</option>
               </select>
            </td>
         </tr>
         <tr valign="top" bgcolor="#E4E4E4">
            <td><font size="1" face="Arial, Helvetica, sans-serif">Preferred Delivery Date:</font></td>
            <td colspan="2">
               <input type="text" name="delivery_date_boxreq" id="delivery_date_boxreq" size="8" value='' > 
               <a href="#" onclick="calboxreqadd.select(document.frmeditboxreq_add.delivery_date_boxreq,'dtanchor3xx','yyyy-MM-dd'); return false;" name="dtanchor3xx" id="dtanchor3xx"><img border="0" src="images/calendar.jpg"></a>
               <div ID="listdivboxreq" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>
            </td>
         </tr>
         <tr>
            <td colspan="3"><input type="button" style="cursor:pointer;" name="btnsubmit" value="Add" onclick="updateBoxReqAddnew()"/>&nbsp;&nbsp;
               <input type="button" style="cursor:pointer;" name="btncancel" value="Cancel" onclick="document.getElementById('divBoxReqNew').style.display='none';document.getElementById('divBoxReq').style.display='block';"/>
            </td>
         </tr>
      </table>
   </form>
</div>
<div id="divBoxReq" >
   <form name="frmeditboxreq_display" action="#" method="POST">
      <table>
         <tr align="center">
            <td colspan="2" bgcolor="#C0CDDA"><font face="Arial, Helvetica, sans-serif" size="1">SHIPPING BOX REQUESTED</font> &nbsp;
               <font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><a href="#" onclick="shippingbox_addnew(); return false;">Add New</a></font>
            </td>
         </tr>
         <?php
            $BoxReq_child = 1;
            $q="Select * From boxesrequested Where companyID = '".$ID."' order by ID";
            
            db_b2b();
            $X=db_query($q);
            
            while($fetchboxes=array_shift($X))
            {
            ?>
         <tr bgcolor="#E4E4E4">
            <td align="left" width="376">
               <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
                  <input type="hidden" name="editcompanyid_new" id="editcompanyid_new" value="<?php echo $ID;?>">
                  <div id="divBoxReq_child<?php echo $BoxReq_child;?>" >
                     <?php
                        //
                         		$boxsizequery = "Select * from box_sizes Where companyID = " .$ID ." and box_type='Shipping boxes' and buy_sell='buy' and boxID=".$fetchboxes["ID"];
                         		db_b2b();
                         		$dt_view_res = db_query($boxsizequery);
                        
                        		$row_bx = array_shift($dt_view_res);
                        		
                        		$ship_box_dimensions=$row_bx["length"]." x ".$row_bx["width"]." x ".$row_bx["height"]; 
                         //
                         /*echo $fetchboxes['lengthInch']." - ".$fetchboxes['length_new_max']. " x "; 
                        		echo $fetchboxes['widthInch']." - ". $fetchboxes['width_new_max'] . " x "; 
                        		echo $fetchboxes['depthInch']." - ".$fetchboxes['depth_new_max'] . "&nbsp;&nbsp;"; */
                         echo $ship_box_dimensions . "&nbsp;&nbsp;"; 
                        		?>
                     <a href='#' onclick="document.getElementById('divBoxReq_child<?php echo $BoxReq_child;?>').style.display='none';document.getElementById('divBoxReq_child_edit<?php echo $BoxReq_child;?>').style.display='block'; return false;">
                     <img bgcolor='#C0CDDA'  src='images/edit.jpg'></a> <br/>
                     <?php
                        echo $fetchboxes['thick']."<br>";
                        echo "Quantity: ".$fetchboxes['quantity'];
                        echo "<BR>".$fetchboxes['recurring'];
                        echo "<BR>Delivery Date: ".$fetchboxes['preferred_delivery_date'];
                        ?>
                     <!-- <br><a href="manage_box_b2bloop_copytoinv.php?compid=<?php echo $ID;?>&boxtype=bkrq&boxid=<?php echo $fetchboxes["ID"];?>" target="_blank"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Copy over to inventory</font></a> -->
                  </div>
                  <div id="divBoxReq_child_edit<?php echo $BoxReq_child;?>" style="display:none;">
                     <table cellSpacing="1" cellPadding="1" border="0" style="font-size:1;">
                        <tr>
                           <td colspan="3" bgcolor="#C0CDDA"><font face="Arial, Helvetica, sans-serif" size="1">SHIPPING BOX REQUESTED (In Edit mode)</font></td>
                        </tr>
                        <?php
                           $boxsizequery = "Select * from box_sizes Where companyID = " .$ID ." and box_type='Shipping boxes' and buy_sell='buy' and boxID=".$fetchboxes["ID"];
                           
                           db_b2b();
                           $dt_view_res = db_query($boxsizequery);
                           
                           $row_bx = array_shift($dt_view_res);
                           
                           $ship_box_dimensions=$row_bx["length"]." x ".$row_bx["width"]." x ".$row_bx["height"]; 
                           ?>
                        <tr valign="top" bgcolor="#E4E4E4">
                           <td><font size="1" face="Arial, Helvetica, sans-serif">Length:</font></td>
                           <td>
                              <input type="text" name="length" id="length<?php echo $BoxReq_child;?>" value="<?php echo $row_bx['length']; ?>" size="4">	
                           </td>
                        </tr>
                        <tr valign="top" bgcolor="#E4E4E4">
                           <td><font size="1" face="Arial, Helvetica, sans-serif">Width:</font></td>
                           <td>
                              <input type="text" name="width" value="<?php echo $row_bx['width']; ?>" size="4" id="width<?php echo $BoxReq_child;?>">
                           </td>
                        </tr>
                        <tr valign="top" bgcolor="#E4E4E4">
                           <td><font size="1" face="Arial, Helvetica, sans-serif">Height:</font></td>
                           <td>
                              <input type="text" name="height" value="<?php echo $row_bx['height']; ?>" size="4" id="height<?php echo $BoxReq_child;?>">
                              <input type="hidden" name="box_size_id" value="<?php echo $row_bx['id']; ?>" size="4" id="box_size_id<?php echo $BoxReq_child;?>">
                           </td>
                        </tr>
                        <tr valign="top" bgcolor="#E4E4E4">
                           <td><font size="1" face="Arial, Helvetica, sans-serif">Wall:</font></td>
                           <td colspan="2">
                              <select name="wall" id="wall<?php echo $BoxReq_child;?>">
                                 <option value="">Please Select</option>
                                 <option value="1-Wall" <?php if ($fetchboxes['thick'] == "1-Wall") { echo " selected ";} ?>>1-Wall</option>
                                 <option value="2-Wall" <?php if ($fetchboxes['thick'] == "2-Wall") { echo " selected ";} ?>>2-Wall</option>
                                 <option value="3-Wall" <?php if ($fetchboxes['thick'] == "3-Wall") { echo " selected ";} ?>>3-Wall</option>
                                 <option value="4-Wall" <?php if ($fetchboxes['thick'] == "4-Wall") { echo " selected ";} ?>>4-Wall</option>
                                 <option value="5-Wall" <?php if ($fetchboxes['thick'] == "5-Wall") { echo " selected ";} ?>>5-Wall</option>
                              </select>
                           </td>
                        </tr>
                        <tr valign="top" bgcolor="#E4E4E4">
                           <td><font size="1" face="Arial, Helvetica, sans-serif">Quantity Requested:</font></td>
                           <td colspan="2"><input name="quantity" type="text" id="quantity<?php echo $BoxReq_child;?>" size="7" maxlength="7" value="<?php echo $fetchboxes['quantity'];?>" ></td>
                        </tr>
                        <tr valign="top" bgcolor="#E4E4E4">
                           <td><font size="1" face="Arial, Helvetica, sans-serif">Recurring / One Time:</font></td>
                           <td colspan="2">
                              <select name="frequency" id="frequency<?php echo $BoxReq_child;?>">
                                 <option>Please Select</option>
                                 <option value="Recurring" <?php if ($fetchboxes['recurring'] == "Recurring") { echo " selected ";} ?>>Recurring</option>
                                 <option value="One-Time"  <?php if ($fetchboxes['recurring'] == "One-Time")  { echo " selected ";} ?>>One-Time</option>
                              </select>
                           </td>
                        </tr>
                        <tr valign="top" bgcolor="#E4E4E4">
                           <td><font size="1" face="Arial, Helvetica, sans-serif">Preferred Delivery Date:</font></td>
                           <td colspan="2">
                              <input type="text" name="delivery_date" id="delivery_date<?php echo $BoxReq_child;?>" class="tcal" size="8" value="<?php echo $fetchboxes['preferred_delivery_date'];?>" > 
                           </td>
                        </tr>
                        <tr>
                           <td colspan="3">
                              <input type="button" style="cursor:pointer;" name="btnSave" value="Save" onclick="updateBoxReqEditnew(<?php echo $BoxReq_child;?>, <?php echo $fetchboxes['ID']; ?>)"/>&nbsp;&nbsp;
                              <input type="button" style="cursor:pointer;" name="btncancel" value="Cancel" onclick="document.getElementById('divBoxReq_child<?php echo $BoxReq_child;?>').style.display='block';document.getElementById('divBoxReq_child_edit<?php echo $BoxReq_child;?>').style.display='none';"/>
                           </td>
                        </tr>
                     </table>
                  </div>
               </font>
            </td>
         </tr>
         <tr>
            <td bgcolor="#E4E4E4">
               <a style='color:#0000FF;' id="lightbox_shipping<?php echo $BoxReq_child;?>" href="javascript:void(0);" onclick="display_shipping_tool(<?php echo $ID;?>,0,<?php echo $fetchboxes["ID"];?>,<?php echo $BoxReq_child;?>)">
               <font face="Arial, Helvetica, sans-serif" size="1" color="#0000FF">SHIPPING BOX MATCHING TOOL</a></font>
            </td>
         </tr>
         <tr>
            <td>&nbsp;</td>
         </tr>
         <?php
            $BoxReq_child = $BoxReq_child + 1;
            }
            ?>
      </table>
   </form>
</div>
<?php
   }
   
   function newViewBoxRequest_pallet(mixed $ID):void
   {
   ?>
<?php
   $bp_divBoxReq_child=3;
   ?>
<div id="divBoxReqP_child<?php echo $bp_divBoxReq_child;?>">
   <table>
      <?php	
         $display_flg_newbox = "y";
         $q="Select * From boxespallet Where companyID = '".$ID."' order by ID";
         
         db_b2b();
         $X=db_query($q);
         
         while($fetchboxesp=array_shift($X))
         {
         	/*if ($display_flg_newbox == "y"){
         		$display_flg_newbox = "n";*/
         ?>
      <tr align="center">
         <td colspan="2" bgcolor="#C0CDDA"><font face="Arial, Helvetica, sans-serif" size="1">PALLETS REQUESTED</font> &nbsp;<a href='#' onclick="document.getElementById('divBoxReqP_child<?php echo $bp_divBoxReq_child;?>').style.display='none';document.getElementById('divBoxReqP_child_edit<?php echo $bp_divBoxReq_child;?>').style.display='block'; return false;">
            <img bgcolor='#C0CDDA'  src='images/edit.jpg'></a>
         </td>
      </tr>
      <?php
         //}
         
         $boxsizequery = "Select * from box_sizes Where companyID = " .$ID ." and box_type='Pallets' and buy_sell='buy' and boxID=".$fetchboxesp["ID"];
         
         db_b2b();
         $dt_view_res = db_query($boxsizequery);
         
         $row_bx = array_shift($dt_view_res);
         
         $pallet_box_dimensions=$row_bx["length"]." x ".$row_bx["width"]; 
         ?>
      <tr bgcolor="#E4E4E4">
         <td align="left" width="376">
            <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            <?php echo $pallet_box_dimensions;?>
            <br><br>
            Quantity: <?php echo $fetchboxesp['quantity'];?><br>
            </font>
         </td>
      </tr>
      <tr bgcolor="#E4E4E4">
         <td align="left" width="376">
            <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            </font>
         </td>
      </tr>
      <?php
         }
         
         //if ($display_flg_newbox == "n"){
         ?>
   </table>
</div>
<div id="divBoxReqP_child_edit<?php echo $bp_divBoxReq_child;?>" style="display: none;">
   <form>
      <input type="hidden" name="editcompanyid_new" id="editcompanyid_new" value="<?php echo $ID;?>">
      <?php
         $q="Select * From boxespallet Where companyID = '".$ID."' order by ID";
         
         db_b2b();
         $X=db_query($q);
         
         $fetchboxesp=array_shift($X);
         ?>
      <table>
         <tr align="center">
            <td colspan="2" bgcolor="#C0CDDA"><font face="Arial, Helvetica, sans-serif" size="1">PALLETS REQUESTED (In Edit mode)</font> &nbsp;
            </td>
         </tr>
         <?php
            //}
            
            $boxsizequery = "Select * from box_sizes Where companyID = " .$ID ." and box_type='Pallets' and buy_sell='buy' and boxID=".$fetchboxesp["ID"];
            
            db_b2b();
            $dt_view_res = db_query($boxsizequery);
            
            $row_bx = array_shift($dt_view_res);
            
            $pallet_box_dimensions=$row_bx["length"]." x ".$row_bx["width"]; 
            ?>
         <input type="hidden" name="pallet_boxid" id="pallet_boxid<?php echo $bp_divBoxReq_child;?>" value="<?php echo $fetchboxesp["ID"]; ?>">
         <tr bgcolor="#E4E4E4">
            <td><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">length: </font></td>
            <td align="left" width="376">
               <font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><input type="text" name="plength" id="plength<?php echo $bp_divBoxReq_child;?>" value="<?php echo $row_bx["length"];?>"></font> <br>
            </td>
         </tr>
         <tr bgcolor="#E4E4E4">
            <td><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Width: </font></td>
            <td><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><input type="text" name="pwidth" id="pwidth<?php echo $bp_divBoxReq_child;?>" value="<?php echo $row_bx["width"];?>">
               <?php
                  if($row_bx['id']!="")
                  {
                  	$pbox_size_id=$row_bx['id'];
                  }
                  	else{
                  		$pbox_size_id="";
                  	}
                  	
                  	?>
               <input type="hidden" name="pbox_size_id" id="pbox_size_id<?php echo $bp_divBoxReq_child;?>" value="<?php echo $pbox_size_id; ?>">
               </font>
            </td>
         </tr>
         <tr bgcolor="#E4E4E4">
            <td><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Quantity: </font></td>
            <td><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
               <input type="text" name="quantity" id="quantity<?php echo $bp_divBoxReq_child;?>" value="<?php echo $fetchboxesp["quantity"];?>"></font>
            </td>
         </tr>
         <tr bgcolor="#E4E4E4">
            <td align="left" colspan="2">
               <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
               <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
               <input type="button" style="cursor:pointer;" name="btnSave" value="Save" onclick="updateBoxReqEditPallet(<?php echo $bp_divBoxReq_child;?>, <?php echo $fetchboxesp['ID']; ?>)"/>&nbsp;&nbsp;
               <input type="button" style="cursor:pointer;" name="btncancel" value="Cancel" onclick="document.getElementById('divBoxReqP_child<?php echo $bp_divBoxReq_child;?>').style.display='block';document.getElementById('divBoxReqP_child_edit<?php echo $bp_divBoxReq_child;?>').style.display='none';"/>
               </font>
               </font>
            </td>
         </tr>
         <?php
            //if ($display_flg_newbox == "n"){
            ?>
      </table>
   </form>
</div>
<?php
   //}
   }//end pallet function
   
   function newViewBoxRequest_supersack(mixed $ID):void
   {
   $sup_divBoxReq_child=4;
   ?>
<div id="divBoxReqSup_child<?php echo $sup_divBoxReq_child;?>">
   <table>
      <?php
         $display_flg_newbox = "y";
         $q="Select * From boxessupersack Where companyID = '".$ID."' order by ID";
         
         db_b2b();
         $X=db_query($q);
         
         while($fetchboxessup=array_shift($X))
         {
         	//if ($display_flg_newbox == "y"){
         		//$display_flg_newbox = "n";
         ?>
      <tr align="center">
         <td colspan="2" bgcolor="#C0CDDA"><font face="Arial, Helvetica, sans-serif" size="1">SUPERSACK REQUESTED</font> &nbsp;&nbsp;<a href='#' onclick="document.getElementById('divBoxReqSup_child<?php echo $sup_divBoxReq_child;?>').style.display='none';document.getElementById('divBoxReqSup_child_edit<?php echo $sup_divBoxReq_child;?>').style.display='block'; return false;">
            <img bgcolor='#C0CDDA'  src='images/edit.jpg'></a>
         </td>
      </tr>
      <?php
         //}
         
         $boxsizequery = "Select * from box_sizes Where companyID = " .$ID ." and box_type='Supersack' and buy_sell='buy' and boxID=".$fetchboxessup["ID"];
         
         db_b2b();
         $dt_view_res = db_query($boxsizequery);
         
         $row_bx = array_shift($dt_view_res);
         
         $supersack_box_dimensions=$row_bx["length"]." x ".$row_bx["width"]; 
         ?>
      <tr bgcolor="#E4E4E4">
         <td align="left" width="376">
            <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            <?php echo $supersack_box_dimensions;?>
            <br><br>
            Quantity: <?php echo $fetchboxessup['quantity'];?><br>
            </font>
         </td>
      </tr>
      <tr bgcolor="#E4E4E4">
         <td align="left" width="376">
            <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            </font>
         </td>
      </tr>
      <?php
         }
         //if ($display_flg_newbox == "n"){
         ?>
   </table>
</div>
<div id="divBoxReqSup_child_edit<?php echo $sup_divBoxReq_child;?>" style="display: none;">
   <form>
      <input type="hidden" name="editcompanyid_new" id="editcompanyid_new" value="<?php echo $ID;?>">
      <?php
         $q="Select * From boxessupersack Where companyID = '".$ID."' order by ID";
         
         db_b2b();
         $X=db_query($q);
         
         $fetchboxesup=array_shift($X);
         ?>
      <table>
         <tr align="center">
            <td colspan="2" bgcolor="#C0CDDA"><font face="Arial, Helvetica, sans-serif" size="1">SUPERSACKS REQUESTED (In Edit mode)</font> &nbsp;
            </td>
         </tr>
         <?php
            //}
            
            $boxsizequery = "Select * from box_sizes Where companyID = " .$ID ." and box_type='Supersack' and buy_sell='buy' and boxID=".$fetchboxesup["ID"];
            
            db_b2b();
            $dt_view_res = db_query($boxsizequery);
            
            $row_bx = array_shift($dt_view_res);
            
            $supers_box_dimensions=$row_bx["length"]." x ".$row_bx["width"]; 
            ?>
         <input type="hidden" name="sup_boxid" id="sup_boxid<?php echo $sup_divBoxReq_child;?>" value="<?php echo $fetchboxesup["ID"]; ?>">
         <tr bgcolor="#E4E4E4">
            <td><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">length: </font></td>
            <td align="left" width="376">
               <font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><input type="text" name="slength" id="slength<?php echo $sup_divBoxReq_child;?>" value="<?php echo $row_bx["length"];?>"></font> <br>
            </td>
         </tr>
         <tr bgcolor="#E4E4E4">
            <td><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Width: </font></td>
            <td><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><input type="text" name="swidth" id="swidth<?php echo $sup_divBoxReq_child;?>" value="<?php echo $row_bx["width"];?>">
               <input type="hidden" name="sbox_size_id" id="sbox_size_id<?php echo $sup_divBoxReq_child;?>" value="<?php echo $row_bx['id']; ?>">
               </font>
            </td>
         </tr>
         <tr bgcolor="#E4E4E4">
            <td><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Quantity: </font></td>
            <td><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
               <input type="text" name="quantity" id="quantity<?php echo $sup_divBoxReq_child;?>" value="<?php echo $fetchboxesup["quantity"];?>"></font>
            </td>
         </tr>
         <tr bgcolor="#E4E4E4">
            <td align="left" colspan="2">	
               <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
               <input type="button" style="cursor:pointer;" name="btnSave" value="Save" onclick="updateBoxReqEditSupersk(<?php echo $sup_divBoxReq_child;?>, <?php echo $fetchboxesup['ID']; ?>)"/>&nbsp;&nbsp;
               <input type="button" style="cursor:pointer;" name="btncancel" value="Cancel" onclick="document.getElementById('divBoxReqSup_child<?php echo $sup_divBoxReq_child;?>').style.display='block';document.getElementById('divBoxReqSup_child_edit<?php echo $sup_divBoxReq_child;?>').style.display='none';"/>
               </font>
            </td>
         </tr>
         <?php
            //if ($display_flg_newbox == "n"){
            ?>
      </table>
   </form>
</div>
<?php
   //}
   }//end pallet function
   //
   
   function viewRescue(mixed $ID):void
   {
   ?>
<table>
   <tr align="center">
      <td colspan="2" bgcolor="#C0CDDA"><font face="Arial, Helvetica, sans-serif" size="1">BOX RESCUE INFORMATION</font> </td>
   </tr>
   <?php
      $q="Select * From boxesForPickup Where companyID = '".$ID."'";
      
      db_b2b();
      $X=db_query($q);
      
      while($fetchboxes=array_shift($X))
      {
      	if ($fetchboxes["gbox"] == 'Y'){
      		?>
   <tr bgcolor="#E4E4E4">
      <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Type</font></td>
      <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Gaylord Boxes</font></td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Shape</font></td>
      <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["shape"];?></font></td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Top</font></td>
      <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["top"];?></font></td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Bottom</font></td>
      <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["bottom"];?></font></td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Vents</font></td>
      <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["vents"];?></font></td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Wall</font></td>
      <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["thick"];?></font></td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Contents</font></td>
      <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["previous_contents"];?></font></td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Condition</font></td>
      <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["box_condition"];?></font></td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Frequency</font></td>
      <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["frequency"];?></font></td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Quantity</font></td>
      <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["no_of_rescue"];?></font></td>
   </tr>
   <tr align="center">
      <td colspan="2" bgcolor="#C0CDDA">&nbsp;</td>
   </tr>
   <?php
      } else { 
      	?>
   <tr bgcolor="#E4E4E4">
      <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Type</font></td>
      <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Shipping Boxes</font></td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Dimensions</font></td>
      <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["length_lside"] . " x " . $fetchboxes["widthInch"] . " x " . $fetchboxes["depthInch"] ;?></font></td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Wall</font></td>
      <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["thick"];?></font></td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">New/Used</font></td>
      <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["box_condition"];?></font></td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Multiple Boxes</font></td>
      <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php if ($fetchboxes["req_another_box"]==1) {echo "Y";} else {echo "N";}?></font></td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Frequency</font></td>
      <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["frequency"];?></font></td>
   </tr>
   <tr bgcolor="#E4E4E4">
      <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Quantity</font></td>
      <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["no_of_rescue"];?></font></td>
   </tr>
   <tr align="center">
      <td colspan="2" bgcolor="#C0CDDA">&nbsp;</td>
   </tr>
   <?php
      }
      }
      ?>
</table>
<?php
   }
   
   function newviewRescue(int $ID):void
   {
   	?>
<div id="divBoxRescueNew" style="display:none;">
   <form name="frmeditboxreq_add" action="#" method="GET">
      <input type="hidden" name="editcompanyid" id="editcompanyid" value="<?php echo $ID;?>">
      <table width="400" border="0">
         <tr>
            <td bgcolor="#C0CDDA"><strong><font face="Arial, Helvetica, sans-serif" size="1">BOX RESCUE INFORMATION (In Add mode):</font></strong></td>
         </tr>
      </table>
      <table width="400" border="0" bgcolor="#E4E4E4">
         <input type="hidden" id="txt" name="txt" value="Gaylord Boxes">
         <tr valign="top">
            <td><font size="1" face="Arial, Helvetica, sans-serif">Select Boxes type</font></td>
            <td>
               <select name="selectboxes" id="selectboxes" onchange="loadmainpg()">
                  <option value="Please Select" >Please Select</option>
                  <option value="Gaylord Boxes" >Gaylord Boxes</option>
                  <option value="Shipping Boxes" >Shipping Boxes</option>
               </select>
            </td>
         </tr>
         <tr>
            <td colspan="2">&nbsp;</td>
         </tr>
      </table>
      <table width="400" cellSpacing="1" cellPadding="1" border="0" id="Gaylord" style="display:none;">
         <tr valign="top" bgcolor="#E4E4E4">
            <td width="100"><font size="1" face="Arial, Helvetica, sans-serif">Shape</font></td>
            <td width="300" style="padding-left:20px;"><input name="shape" type="text" id="shape" size="20" maxlength="30" ></td>
         </tr>
         <tr valign="top" bgcolor="#E4E4E4">
            <td width="100"><font size="1" face="Arial, Helvetica, sans-serif">Top</font></td>
            <td width="300" style="padding-left:20px;"><input name="top" type="text" id="top" size="20" maxlength="30" ></td>
         </tr>
         <tr valign="top" bgcolor="#E4E4E4">
            <td width="100"><font size="1" face="Arial, Helvetica, sans-serif">Bottom</font></td>
            <td width="300" style="padding-left:20px;"><input name="bottom" type="text" id="bottom" size="20" maxlength="30" ></td>
         </tr>
         <tr valign="top" bgcolor="#E4E4E4">
            <td width="100"><font size="1" face="Arial, Helvetica, sans-serif">Vents</font></td>
            <td width="300" style="padding-left:20px;"><input name="vents" type="text" id="vents" size="20" maxlength="30" ></td>
         </tr>
         <tr valign="top" bgcolor="#E4E4E4">
            <td width="100"><font size="1" face="Arial, Helvetica, sans-serif">Wall</font></td>
            <td width="300" style="padding-left:20px;">
               <select name="wall" id="wall" style="width:150px;">
                  <option value="">Please Select</option>
                  <option value="1-Wall" >1-Wall</option>
                  <option value="2-Wall" >2-Wall</option>
                  <option value="3-Wall" >3-Wall</option>
                  <option value="4-Wall" >4-Wall</option>
                  <option value="5-Wall" >5-Wall</option>
               </select>
            </td>
         </tr>
         <tr valign="top" bgcolor="#E4E4E4">
            <td width="100"><font size="1" face="Arial, Helvetica, sans-serif">Contents</font></td>
            <td width="300" style="padding-left:20px;"><input name="previous_contents" type="text" id="previous_contents" size="20" maxlength="30" ></td>
         </tr>
         <tr valign="top" bgcolor="#E4E4E4">
            <td width="100"><font size="1" face="Arial, Helvetica, sans-serif">Condition</font></td>
            <td width="300" style="padding-left:20px;">
               <select name="box_condition" id="box_condition" style="width:150px;">
                  <option value="">Please Select</option>
                  <option value="New" >New</option>
                  <option value="Used" >Used</option>
                  <option value="Soiled">Soiled</option>
                  <option value="Clean">Clean</option>
               </select>
            </td>
         </tr>
         <tr valign="top" bgcolor="#E4E4E4">
            <td width="100"><font size="1" face="Arial, Helvetica, sans-serif">Frequency</font></td>
            <td width="300" style="padding-left:20px;">
               <select name="frequency" id="frequency" style="width:150px;">
                  <option>Please Select</option>
                  <option value="Recurring" >Recurring</option>
                  <option value="One-Time" >One-Time</option>
               </select>
            </td>
         </tr>
         <tr valign="top" bgcolor="#E4E4E4">
            <td width="100"><font size="1" face="Arial, Helvetica, sans-serif">Quantity</font></td>
            <td width="300" style="padding-left:20px;"><input name="no_of_rescue" type="text" id="no_of_rescue" size="20" maxlength="30" ></td>
         </tr>
         <tr>
            <td width="400" colspan="2"><input type="button" style="cursor:pointer;" name="btnsubmit" value="Add" onclick="updateBoxRescueAddnew()"/>&nbsp;&nbsp;
               <input type="button" style="cursor:pointer;" name="btncancel" value="Cancel" onclick="document.getElementById('divBoxRescueNew').style.display='none';document.getElementById('divBoxRescue').style.display='block';"/>
            </td>
         </tr>
      </table>
      <table width="400" cellSpacing="1" cellPadding="1" border="0" id="Shipping" style="display:none">
         <?php //}	elseif($_GET["txt"] == "Shipping Boxes"){?>
         <tr valign="top" bgcolor="#E4E4E4">
            <td width="100"><font size="1" face="Arial, Helvetica, sans-serif">Length</font></td>
            <td width="300"><input name="length_lside" type="text" id="length_lside" size="20" maxlength="30" onkeypress="return isNumberKey(event)"></td>
         </tr>
         <tr valign="top" bgcolor="#E4E4E4">
            <td width="100"><font size="1" face="Arial, Helvetica, sans-serif">Width</font></td>
            <td width="300"><input name="width" type="text" id="width" size="20" maxlength="30" onkeypress="return isNumberKey(event)"></td>
         </tr>
         <tr valign="top" bgcolor="#E4E4E4">
            <td width="100"><font size="1" face="Arial, Helvetica, sans-serif">Height</font></td>
            <td width="300"><input name="height" type="text" id="height" size="20" maxlength="30" onkeypress="return isNumberKey(event)" ></td>
         </tr>
         <tr valign="top" bgcolor="#E4E4E4">
            <td width="100"><font size="1" face="Arial, Helvetica, sans-serif">Wall</font></td>
            <td width="300">
               <select name="wall_sh" id="wall_sh" style="width:150px;">
                  <option value="">Please Select</option>
                  <option value="1-Wall" >1-Wall</option>
                  <option value="2-Wall" >2-Wall</option>
                  <option value="3-Wall" >3-Wall</option>
                  <option value="4-Wall" >4-Wall</option>
                  <option value="5-Wall" >5-Wall</option>
               </select>
            </td>
         </tr>
         <tr valign="top" bgcolor="#E4E4E4">
            <td width="100"><font size="1" face="Arial, Helvetica, sans-serif">New/Used</font></td>
            <td width="300">
               <select name="box_condition_sh" id="box_condition_sh" style="width:150px;">
                  <option value="">Please Select</option>
                  <option value="New" >New</option>
                  <option value="Used" >Used</option>
                  <option value="Soiled">Soiled</option>
                  <option value="Clean">Clean</option>
               </select>
            </td>
         </tr>
         <tr valign="top" bgcolor="#E4E4E4">
            <td width="100"><font size="1" face="Arial, Helvetica, sans-serif">Multiple Boxes</font></td>
            <td width="300">
               <select name="req_another_box" id="req_another_box" >
                  <option value="1" >Y</option>
                  <option value="0" >N</option>
               </select>
            </td>
         </tr>
         <tr valign="top" bgcolor="#E4E4E4">
            <td width="100"><font size="1" face="Arial, Helvetica, sans-serif">Frequency</font></td>
            <td width="300" >
               <select name="frequency_sh" id="frequency_sh" style="width:150px;">
                  <option>Please Select</option>
                  <option value="Recurring" >Recurring</option>
                  <option value="One-Time" >One-Time</option>
               </select>
            </td>
         </tr>
         <tr valign="top" bgcolor="#E4E4E4">
            <td width="100"><font size="1" face="Arial, Helvetica, sans-serif">Quantity</font></td>
            <td width="300"><input name="no_of_rescue_sh" type="text" id="no_of_rescue_sh" size="20" maxlength="30" ></td>
         </tr>
         <tr bgcolor="#E4E4E4">
            <td width="400" colspan="2"><input type="button" style="cursor:pointer;" name="btnsubmit" value="Add" onclick="updateBoxRescueAddnew()"/>&nbsp;&nbsp;
               <input type="button" style="cursor:pointer;" name="btncancel" value="Cancel" onclick="document.getElementById('divBoxRescueNew').style.display='none';document.getElementById('divBoxRescue').style.display='block';"/>
            </td>
         </tr>
      </table>
   </form>
</div>
<input type="hidden" name="editcompanyid_new" id="editcompanyid_new" value="<?php echo $ID;?>">
<table>
   <tr align="center">
      <td colspan="2" bgcolor="#C0CDDA">
         <font face="Arial, Helvetica, sans-serif" size="1">BOX RESCUE INFORMATION</font> &nbsp;
         <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            <!--<a href="#" onclick="document.getElementById('divBoxRescueNew').style.display='block';document.getElementById('divBoxRescue').style.display='none'; return false;">Add New</a>-->
         </font>
      </td>
   </tr>
   <tr align="center">
      <td colspan="2">
         <table>
            <tr>
               <td>
                  <?php
                     $BoxReq_child = 1;
                     ?>
                  <div id="divBoxShipRescue_child<?php echo $BoxReq_child;?>" >
                     <table>
                        <?php
                           $q="Select * From boxesForPickup Where companyID = '".$ID."' order by ID";
                           
                           db_b2b();
                           $Xs=db_query($q);
                           
                           $shipnums=tep_db_num_rows($Xs);
                           $BoxReq_child_num=0;
                           if($shipnums>0){
                           while($fetchboxes=array_shift($Xs))
                           {
                           	
                           ?>
                        <tr bgcolor="#E4E4E4">
                           <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Type</font></td>
                           <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Shipping Boxes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <a href='#' onclick="document.getElementById('divBoxShipRescue_child<?php echo $BoxReq_child;?>').style.display='none'; document.getElementById('divBoxShipRescue_child_edit<?php echo $BoxReq_child;?>').style.display='block'; window.parent.document.getElementById('show_quoting').height = document.body.scrollHeight; return false; ">
                              <img bgcolor='#C0CDDA'  src='images/edit.jpg'></a></font>
                           </td>
                        </tr>
                        <tr bgcolor="#E4E4E4">
                           <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Wall</font></td>
                           <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["thick"];?></font></td>
                        </tr>
                        <tr bgcolor="#E4E4E4">
                           <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">New/Used</font></td>
                           <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["box_condition"];?></font></td>
                        </tr>
                        <tr bgcolor="#E4E4E4">
                           <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Multiple Boxes</font></td>
                           <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php if ($fetchboxes["req_another_box"]==1) {echo "Y";} else {echo "N";}?></font></td>
                        </tr>
                        <tr bgcolor="#E4E4E4">
                           <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Frequency</font></td>
                           <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["frequency"];?></font></td>
                        </tr>
                        <tr bgcolor="#E4E4E4">
                           <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Quantity</font></td>
                           <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["no_of_rescue"];?></font></td>
                        </tr>
                        <tr bgcolor="#E4E4E4">
                           <td width="160" valign="top"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Dimensions</font></td>
                           <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
                              <?php
                                 $boxsizequery = "Select * from box_sizes Where companyID = " .$ID ." and box_type='Shipping boxes' and buy_sell='sell' and boxID=".$fetchboxes["ID"];
                                 
                                 db_b2b();
                                 $dt_view_res = db_query($boxsizequery);
                                 
                                 while($row_bx = array_shift($dt_view_res))
                                 {
                                 	$ship_box_dimensions.=$row_bx["length"]." x ".$row_bx["width"]." x ".$row_bx["height"]."<br>"; 
                                 }
                                 echo $ship_box_dimensions;
                                 ?>
                              </font>
                           </td>
                        </tr>
                        <?php
                           }
                           }	
                           ?>
                     </table>
                  </div>
                  <!--Edit shipping box-->
                  <div id="divBoxShipRescue_child_edit<?php echo $BoxReq_child;?>" style="display:none;">
                     <form name="frmeditshipboxreq" action="" method="GET">
                        <input type="hidden" name="comp_id" id="comp_id" value="<?php echo $ID;?>">	
                        <table>
                           <?php
                              $q="Select * From boxesForPickup Where companyID = '".$ID."' order by ID";
                              
                              db_b2b();
                              $Xs=db_query($q);
                              
                              $shipnums=tep_db_num_rows($Xs);
                              if($shipnums>0){
                              while($fetchboxes=array_shift($Xs))
                              {
                              	$BoxReq_child_num=$BoxReq_child_num+1;
                              ?>
                           <input type="hidden" name="shipping_box_id" id="shipping_box_id" value="<?php echo $fetchboxes["ID"];?>">	
                           <tr bgcolor="#E4E4E4">
                              <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Type</font></td>
                              <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Shipping Boxes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                 </font>
                              </td>
                           </tr>
                           <tr bgcolor="#E4E4E4">
                              <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Wall</font></td>
                              <td align="left" width="376">
                                 <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
                                    <select name="wall" id="wall<?php echo $BoxReq_child_num;?>" style="width:150px;">
                                       <option value="">Please Select</option>
                                       <option value="1-Wall" <?php if ($fetchboxes["thick"] == "1-Wall") { echo " selected "; } ?>>1-Wall</option>
                                       <option value="2-Wall" <?php if ($fetchboxes["thick"] == "2-Wall") { echo " selected "; } ?>>2-Wall</option>
                                       <option value="3-Wall" <?php if ($fetchboxes["thick"] == "3-Wall") { echo " selected "; } ?>>3-Wall</option>
                                       <option value="4-Wall" <?php if ($fetchboxes["thick"] == "4-Wall") { echo " selected "; } ?>>4-Wall</option>
                                       <option value="5-Wall" <?php if ($fetchboxes["thick"] == "5-Wall") { echo " selected "; } ?>>5-Wall</option>
                                    </select>
                                 </font>
                              </td>
                           </tr>
                           <tr bgcolor="#E4E4E4">
                              <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">New/Used</font></td>
                              <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><input type="text" value="<?php echo $fetchboxes["box_condition"];?>" name="box_condition" id="box_condition<?php echo $BoxReq_child_num;?>"></font></td>
                           </tr>
                           <tr bgcolor="#E4E4E4">
                              <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Multiple Boxes</font></td>
                              <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><input type="text" value="<?php if ($fetchboxes["req_another_box"]==1) {echo "Y";} else {echo "N";}?>" name="req_another_box" id="req_another_box<?php echo $BoxReq_child_num;?>"></font></td>
                           </tr>
                           <tr bgcolor="#E4E4E4">
                              <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Frequency</font></td>
                              <td align="left" width="376">
                                 <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
                                    <select name="frequency" id="frequency<?php echo $BoxReq_child_num;?>">
                                       <option>Please Select</option>
                                       <option value="Recurring" <?php if($fetchboxes["frequency"]=="Recurring") { echo "selected"; } else {} ?> >Recurring</option>
                                       <option value="One-Time" <?php if($fetchboxes["frequency"]=="One-Time") { echo "selected"; } else {} ?>>One-Time</option>
                                    </select>
                                 </font>
                              </td>
                           </tr>
                           <tr bgcolor="#E4E4E4">
                              <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Quantity</font></td>
                              <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><input type="text" value="<?php echo $fetchboxes["no_of_rescue"];?>" name="quantity" id="quantity<?php echo $BoxReq_child_num;?>"></font></td>
                           </tr>
                           <tr bgcolor="#E4E4E4">
                              <td width="160" valign="top"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Dimensions</font></td>
                              <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
                                 <?php
                                    $boxsizequery = "Select * from box_sizes Where companyID = " .$ID ." and box_type='Shipping boxes' and buy_sell='sell' and boxID=".$fetchboxes["ID"];
                                    
                                    db_b2b();
                                    $dt_view_res = db_query($boxsizequery);
                                    
                                    while($row_bx = array_shift($dt_view_res))
                                    {
                                    	
                                    	$ship_box_dimensions.=$row_bx["length"]." x ".$row_bx["width"]." x ".$row_bx["height"]."<br>"; 
                                    	//
                                    	$s_box_size_id.=$row_bx["id"].'-';
                                    
                                    ?>
                                 <input type="text" name="ship_length[]" id="ship_length[]" value="<?php echo $row_bx['length']; ?>" size="4"> x <input type="text" name="ship_width[]" value="<?php echo $row_bx['width']; ?>" size="4" id="ship_width[]"> x <input type="text" name="ship_height[]" value="<?php echo $row_bx['height']; ?>" size="4" id="ship_height[]"><br>
                                 <?php
                                    }
                                    //echo $ship_box_dimensions;
                                    ?>
                                 <input type="hidden" name="s_box_size_id" id="s_box_size_id" value="<?php echo $s_box_size_id;?>">
                                 </font>
                              </td>
                           </tr>
                           <tr bgcolor="#E4E4E4">
                              <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif">
                                 <input type="button" style="cursor:pointer;" name="btnSave" value="Save" onclick="updateShipBoxRescueEditnew(<?php echo $BoxReq_child;?>, <?php echo $BoxReq_child_num;?>, <?php echo $fetchboxes['ID']; ?>)"/>&nbsp;&nbsp;
                                 <input type="button" style="cursor:pointer;" name="btncancel" value="Cancel" onclick="document.getElementById('divBoxShipRescue_child<?php echo $BoxReq_child;?>').style.display='block';document.getElementById('divBoxShipRescue_child_edit<?php echo $BoxReq_child;?>').style.display='none';"/>
                              </td>
                           </tr>
                           <?php
                              }
                              }	
                              ?>
                        </table>
                     </form>
                  </div>
                  <!--End edit shipping box rescue-->	
                  <!--Save shipping box-->
               </td>
            </tr>
            <tr>
               <td>
                  <!--view Gaylord box-->
                  <?php
                     $BoxReq_gchild = 2;
                     ?>
                  <div id="divBoxGaylordRescue_child<?php echo $BoxReq_gchild;?>" >
                     <table>
                        <?php
                           //
                           		$q="Select * From boxesforpickup_gaylord Where companyID = '".$ID."' order by ID";
                           			
                           			db_b2b();
                           		    $X=db_query($q);
                           
                           			$gaynums=tep_db_num_rows($X);
                           
                           		if($gaynums>0){
                           		while($fetchboxes=array_shift($X))
                           		{
                           			?>
                        <tr bgcolor="#E4E4E4">
                           <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Type</font></td>
                           <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Gaylord Boxes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <a href='#' onclick="document.getElementById('divBoxGaylordRescue_child<?php echo $BoxReq_gchild;?>').style.display='none';document.getElementById('divBoxGaylordRescue_child_edit<?php echo $BoxReq_gchild;?>').style.display='block'; return false;">
                              <img bgcolor='#C0CDDA'  src='images/edit.jpg'></a></font> 
                           </td>
                        </tr>
                        <tr bgcolor="#E4E4E4">
                           <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Shape</font></td>
                           <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["shape"];?></font></td>
                        </tr>
                        <tr bgcolor="#E4E4E4">
                           <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Top</font></td>
                           <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["top"];?></font></td>
                        </tr>
                        <tr bgcolor="#E4E4E4">
                           <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Bottom</font></td>
                           <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["bottom"];?></font></td>
                        </tr>
                        <tr bgcolor="#E4E4E4">
                           <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Vents</font></td>
                           <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["vents"];?></font></td>
                        </tr>
                        <tr bgcolor="#E4E4E4">
                           <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Wall</font></td>
                           <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["thick"];?></font></td>
                        </tr>
                        <tr bgcolor="#E4E4E4">
                           <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Contents</font></td>
                           <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["previous_contents"];?></font></td>
                        </tr>
                        <tr bgcolor="#E4E4E4">
                           <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Condition</font></td>
                           <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["box_condition"];?></font></td>
                        </tr>
                        <tr bgcolor="#E4E4E4">
                           <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Frequency</font></td>
                           <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["frequency"];?></font></td>
                        </tr>
                        <tr bgcolor="#E4E4E4">
                           <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Quantity</font></td>
                           <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["no_of_rescue"];?></font></td>
                        </tr>
                        <tr bgcolor="#E4E4E4">
                           <td width="160" valign="top"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Dimensions</font></td>
                           <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
                              <?php
                                 $boxsizequery = "Select * from box_sizes Where companyID = " .$ID ." and box_type='Gaylord' and buy_sell='sell' and boxID=".$fetchboxes["ID"];
                                 
                                 db_b2b();
                                 $dt_view_res = db_query($boxsizequery);
                                 
                                 while($row_bx = array_shift($dt_view_res))
                                 {
                                 	$gayl_box_dimensions.=$row_bx["length"]." x ".$row_bx["width"]." x ".$row_bx["height"]."<br>"; 
                                 }
                                 echo $gayl_box_dimensions;
                                 ?>
                              </font>
                           </td>
                        </tr>
                        <?php
                           }
                           }
                           ?>
                     </table>
                  </div>
                  <!--Edit gaylord boxes-->
                  <div id="divBoxGaylordRescue_child_edit<?php echo $BoxReq_gchild;?>" style="display: none;" >
                     <form name="frmeditgboxreq" action="" method="GET">
                        <input type="hidden" name="editcompanyid" value="<?php echo $ID;?>">
                        <table>
                           <?php
                              //
                              		$q="Select * From boxesforpickup_gaylord Where companyID = '".$ID."' order by ID";
                              			
                              		db_b2b();
                              		$X=db_query($q);
                              
                              		$gaynums=tep_db_num_rows($X);
                              
                              		if($gaynums>0){
                              		while($row=array_shift($X))
                              		{
                              			?>
                           <input type="hidden" name="comp_id" id="comp_id" value="<?php echo $ID;?>">	
                           <input type="hidden" name="gaylord_box_id" id="gaylord_box_id" value="<?php echo $row["ID"];?>">	
                           <tr bgcolor="#E4E4E4">
                              <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Type</font></td>
                              <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Gaylord Boxes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                 <a href='#' onclick="document.getElementById('divBoxGaylordRescue_child<?php echo $BoxReq_gchild;?>').style.display='none';document.getElementById('divBoxGaylordRescue_child_edit<?php echo $BoxReq_gchild;?>').style.display='block'; return false;">
                                 <img bgcolor='#C0CDDA'  src='images/edit.jpg'></a></font> 
                              </td>
                           </tr>
                           <tr bgcolor="#E4E4E4">
                              <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Shape</font></td>
                              <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
                                 <input name="shape" type="text" id="shape<?php echo $BoxReq_gchild;?>" size="20" maxlength="30" value="<?php echo $row["shape"];?>">
                                 </font>
                              </td>
                           </tr>
                           <tr bgcolor="#E4E4E4">
                              <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Top</font></td>
                              <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
                                 <input name="top" type="text" id="top<?php echo $BoxReq_gchild;?>" size="20" maxlength="30" value="<?php echo $row["top"];?>">
                                 </font>
                              </td>
                           </tr>
                           <tr bgcolor="#E4E4E4">
                              <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Bottom</font></td>
                              <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
                                 <input name="bottom" type="text" id="bottom<?php echo $BoxReq_gchild;?>" size="20" maxlength="30" value="<?php echo $row["bottom"];?>">
                                 </font>
                              </td>
                           </tr>
                           <tr bgcolor="#E4E4E4">
                              <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Vents</font></td>
                              <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
                                 <input name="vents" type="text" id="vents<?php echo $BoxReq_gchild;?>" size="20" maxlength="30" value="<?php echo $row["vents"];?>">
                                 </font>
                              </td>
                           </tr>
                           <tr bgcolor="#E4E4E4">
                              <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Wall</font></td>
                              <td align="left" width="376">
                                 <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
                                    <select name="wall" id="wall<?php echo $BoxReq_gchild;?>" style="width:150px;">
                                       <option value="">Please Select</option>
                                       <option value="1-Wall" <?php if ($row["thick"] == "1-Wall") { echo " selected "; } ?>>1-Wall</option>
                                       <option value="2-Wall" <?php if ($row["thick"] == "2-Wall") { echo " selected "; } ?>>2-Wall</option>
                                       <option value="3-Wall" <?php if ($row["thick"] == "3-Wall") { echo " selected "; } ?>>3-Wall</option>
                                       <option value="4-Wall" <?php if ($row["thick"] == "4-Wall") { echo " selected "; } ?>>4-Wall</option>
                                       <option value="5-Wall" <?php if ($row["thick"] == "5-Wall") { echo " selected "; } ?>>5-Wall</option>
                                    </select>
                                 </font>
                              </td>
                           </tr>
                           <tr bgcolor="#E4E4E4">
                              <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Contents</font></td>
                              <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
                                 <input name="previous_contents" type="text" id="previous_contents<?php echo $BoxReq_gchild;?>" size="20" maxlength="30" value="<?php echo $row["previous_contents"];?>">
                                 </font>
                              </td>
                           </tr>
                           <tr bgcolor="#E4E4E4">
                              <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Condition</font></td>
                              <td align="left" width="376">
                                 <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
                                    <select name="box_condition" id="box_condition<?php echo $BoxReq_gchild;?>" style="width:150px;">
                                       <option value="">Please Select</option>
                                       <option value="New" <?php if ($row["box_condition"] == "New") { echo " selected "; } ?>>New</option>
                                       <option value="Used" <?php if ($row["box_condition"] == "Used") { echo " selected "; } ?>>Used</option>
                                       <option value="Soiled" <?php if ($row["box_condition"] == "Soiled") { echo " selected "; } ?>>Soiled</option>
                                       <option value="Clean" <?php if ($row["box_condition"] == "Clean") { echo " selected "; } ?>>Clean</option>
                                    </select>
                                 </font>
                              </td>
                           </tr>
                           <tr bgcolor="#E4E4E4">
                              <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Frequency</font></td>
                              <td align="left" width="376">
                                 <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
                                    <select name="frequency" id="frequency<?php echo $BoxReq_gchild;?>" style="width:150px;">
                                       <option>Please Select</option>
                                       <option value="Recurring" <?php if ($row["frequency"] == "Recurring") { echo " selected "; } ?>>Recurring</option>
                                       <option value="One-Time" <?php if ($row["frequency"] == "One-Time") { echo " selected "; } ?>>One-Time</option>
                                    </select>
                                 </font>
                              </td>
                           </tr>
                           <tr bgcolor="#E4E4E4">
                              <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Quantity</font></td>
                              <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
                                 <input name="no_of_rescue" type="text" id="no_of_rescue<?php echo $BoxReq_gchild;?>" size="20" maxlength="30" value="<?php echo $row["no_of_rescue"];?>">
                                 </font>
                              </td>
                           </tr>
                           <tr bgcolor="#E4E4E4">
                              <td width="160" valign="top"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Dimensions</font></td>
                              <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
                                 <?php
                                    $boxsizequery = "Select * from box_sizes Where companyID = " .$ID ." and box_type='Gaylord' and buy_sell='sell' and boxID=".$row["ID"];
                                    
                                    db_b2b();
                                    $dt_view_res = db_query($boxsizequery);
                                    
                                    while($row_bx = array_shift($dt_view_res))
                                    {
                                    	$gayl_box_dimensions.=$row_bx["length"]." x ".$row_bx["width"]." x ".$row_bx["height"]."<br>"; 
                                    	$g_box_size_id.=$row_bx["id"].'-';
                                    ?>
                                 <input type="text" name="gay_length[]" id="gay_length[]" value="<?php echo $row_bx['length']; ?>" size="4"> x <input type="text" name="gay_width[]" value="<?php echo $row_bx['width']; ?>" size="4" id="gay_width[]"> x <input type="text" name="gay_height[]" value="<?php echo $row_bx['height']; ?>" size="4" id="gay_height[]"><br>
                                 <?php
                                    }
                                    
                                    ?>
                                 <input type="hidden" name="g_box_size_id" id="g_box_size_id" value="<?php echo $g_box_size_id;?>">
                                 </font>
                              </td>
                           </tr>
                           <tr bgcolor="#E4E4E4">
                              <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif">
                                 <input type="button" style="cursor:pointer;" name="btnSave" value="Save" onclick="updateGaylordBoxRescueEditnew(<?php echo $BoxReq_gchild;?>, <?php echo $row['ID']; ?>)"/>&nbsp;&nbsp;
                                 <input type="button" style="cursor:pointer;" name="btncancel" value="Cancel" onclick="document.getElementById('divBoxGaylordRescue_child<?php echo $BoxReq_gchild;?>').style.display='block';document.getElementById('divBoxGaylordRescue_child_edit<?php echo $BoxReq_gchild;?>').style.display='none';"/>
                              </td>
                           </tr>
                           <?php
                              }
                              }
                              ?>
                        </table>
                     </form>
                  </div>
                  <!--end edit gaylord boxes-->
               </td>
            </tr>
            <tr>
               <td>
                  <?php
                     $BoxReq_pchild = 3;
                     ?>
                  <div id="divBoxPalletRescue_child<?php echo $BoxReq_pchild;?>">
                     <table>
                        <?php
                           //
                           	$q="Select * From boxesforpickup_pallet Where companyID = '".$ID."' order by ID";
                           	
                           	db_b2b();
                           	$X=db_query($q);
                           
                           	$palnums=tep_db_num_rows($X);
                           	if($palnums>0){
                           	while($fetchboxespl=array_shift($X))
                           	{
                           		?>
                        <tr bgcolor="#E4E4E4">
                           <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Type</font></td>
                           <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Pallets&nbsp;&nbsp;&nbsp;&nbsp;
                              <a href='#' onclick="document.getElementById('divBoxPalletRescue_child<?php echo $BoxReq_pchild;?>').style.display='none';document.getElementById('divBoxPalletRescue_child_edit<?php echo $BoxReq_pchild;?>').style.display='block'; return false;">
                              <img bgcolor='#C0CDDA'  src='images/edit.jpg'></a></font>
                           </td>
                        </tr>
                        <tr bgcolor="#E4E4E4">
                           <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Wall</font></td>
                           <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxespl["thick"];?></font></td>
                        </tr>
                        <tr bgcolor="#E4E4E4">
                           <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">New/Used</font></td>
                           <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxespl["box_condition"];?></font></td>
                        </tr>
                        <tr bgcolor="#E4E4E4">
                           <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Multiple Boxes</font></td>
                           <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php if ($fetchboxespl["req_another_box"]==1) {echo "Y";} else {echo "N";}?></font></td>
                        </tr>
                        <tr bgcolor="#E4E4E4">
                           <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Frequency</font></td>
                           <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxespl["frequency"];?></font></td>
                        </tr>
                        <tr bgcolor="#E4E4E4">
                           <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Quantity</font></td>
                           <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxespl["no_of_rescue"];?></font></td>
                        </tr>
                        <tr bgcolor="#E4E4E4">
                           <td width="160" valign="top"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Dimensions</font></td>
                           <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
                              <?php
                                 $boxsizequery = "Select * from box_sizes Where companyID = " .$ID ." and box_type='Pallet' and buy_sell='sell' and boxID=".$fetchboxespl["ID"];
                                 
                                 db_b2b();
                                 $dt_view_res = db_query($boxsizequery);
                                 
                                 while($row_bx = array_shift($dt_view_res))
                                 {
                                 	$pallet_box_dimensions.=$row_bx["length"]." x ".$row_bx["width"]."<br>"; 
                                 }
                                 echo $pallet_box_dimensions;
                                 				?>
                              </font>
                           </td>
                        </tr>
                        <?php
                           }
                           }
                           ?>
                     </table>
                  </div>
                  <!--Edit pallet box-->
                  <div id="divBoxPalletRescue_child_edit<?php echo $BoxReq_pchild;?>" style="display:none;">
                     <form name="frmeditshipboxreq" action="" method="GET">
                        <input type="hidden" name="comp_id" id="comp_id" value="<?php echo $ID;?>">	
                        <table>
                           <?php
                              $q="Select * From boxesforpickup_pallet Where companyID = '".$ID."' order by ID";
                              
                              db_b2b();
                              $Xs=db_query($q);
                              
                              $shipnums=tep_db_num_rows($Xs);
                              if($shipnums>0){
                              while($fetchboxes=array_shift($Xs))
                              {
                              ?>
                           <input type="hidden" name="pallet_box_id" id="pallet_box_id" value="<?php echo $fetchboxes["ID"];?>">	
                           <tr bgcolor="#E4E4E4">
                              <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Type</font></td>
                              <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Pallet Boxes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                 </font>
                              </td>
                           </tr>
                           <tr bgcolor="#E4E4E4">
                              <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Wall</font></td>
                              <td align="left" width="376">
                                 <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
                                    <select name="wall" id="wall<?php echo $BoxReq_pchild;?>" style="width:150px;">
                                       <option value="">Please Select</option>
                                       <option value="1-Wall" <?php if ($fetchboxes["thick"] == "1-Wall") { echo " selected "; } ?>>1-Wall</option>
                                       <option value="2-Wall" <?php if ($fetchboxes["thick"] == "2-Wall") { echo " selected "; } ?>>2-Wall</option>
                                       <option value="3-Wall" <?php if ($fetchboxes["thick"] == "3-Wall") { echo " selected "; } ?>>3-Wall</option>
                                       <option value="4-Wall" <?php if ($fetchboxes["thick"] == "4-Wall") { echo " selected "; } ?>>4-Wall</option>
                                       <option value="5-Wall" <?php if ($fetchboxes["thick"] == "5-Wall") { echo " selected "; } ?>>5-Wall</option>
                                    </select>
                                 </font>
                              </td>
                           </tr>
                           <tr bgcolor="#E4E4E4">
                              <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">New/Used</font></td>
                              <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><input type="text" value="<?php echo $fetchboxes["box_condition"];?>" name="box_condition" id="box_condition<?php echo $BoxReq_pchild;?>"></font></td>
                           </tr>
                           <tr bgcolor="#E4E4E4">
                              <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Multiple Boxes</font></td>
                              <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><input type="text" value="<?php if ($fetchboxes["req_another_box"]==1) {echo "Y";} else {echo "N";}?>" name="req_another_box" id="req_another_box<?php echo $BoxReq_pchild;?>"></font></td>
                           </tr>
                           <tr bgcolor="#E4E4E4">
                              <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Frequency</font></td>
                              <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><input type="text" value="<?php echo $fetchboxes["frequency"];?>" name="frequency" id="frequency<?php echo $BoxReq_pchild;?>"></font></td>
                           </tr>
                           <tr bgcolor="#E4E4E4">
                              <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Quantity</font></td>
                              <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><input type="text" value="<?php echo $fetchboxes["no_of_rescue"];?>" name="quantity" id="quantity<?php echo $BoxReq_pchild;?>"></font></td>
                           </tr>
                           <tr bgcolor="#E4E4E4">
                              <td width="160" valign="top"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Dimensions</font></td>
                              <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
                                 <?php
                                    $boxsizequery = "Select * from box_sizes Where companyID = " .$ID ." and box_type='Pallet' and buy_sell='sell' and boxID=".$fetchboxes["ID"];
                                    
                                    db_b2b();
                                    $dt_view_res = db_query($boxsizequery);
                                    
                                    while($row_bx = array_shift($dt_view_res))
                                    {
                                    $pallet_box_dimensions.=$row_bx["length"]." x ".$row_bx["width"]."<br>"; 
                                    //
$p_box_size_id = '';
$p_box_size_id .= $row_bx["id"].'-';
                                    
                                    ?>
                                 <input type="text" name="pal_length[]" id="pal_length[]" value="<?php echo $row_bx['length']; ?>" size="4"> x <input type="text" name="pal_width[]" value="<?php echo $row_bx['width']; ?>" size="4" id="pal_width[]"> <br>
                                 <?php
                                    }
                                    //echo $ship_box_dimensions;
                                    ?>
                                 <input type="hidden" name="p_box_size_id" id="p_box_size_id" value="<?php echo $p_box_size_id;?>">
                                 </font>
                              </td>
                           </tr>
                           <tr bgcolor="#E4E4E4">
                              <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif">
                                 <input type="button" style="cursor:pointer;" name="btnSave" value="Save" onclick="updatePalletBoxRescueEditnew(<?php echo $BoxReq_pchild;?>, <?php echo $fetchboxes['ID']; ?>)"/>&nbsp;&nbsp;
                                 <input type="button" style="cursor:pointer;" name="btncancel" value="Cancel" onclick="document.getElementById('divBoxPalletRescue_child<?php echo $BoxReq_pchild;?>').style.display='block';document.getElementById('divBoxPalletRescue_child_edit<?php echo $BoxReq_pchild;?>').style.display='none';"/>
                              </td>
                           </tr>
                           <?php
                              }
                              }	
                              ?>
                        </table>
                     </form>
                  </div>
                  <!--End edit pallet box rescue-->	
               </td>
            </tr>
            <tr>
               <td>
                  <?php
                     $BoxReq_supchild = 4;
                     ?>
                  <div id="divBoxSuperRescue_child<?php echo $BoxReq_supchild;?>">
                     <table>
                        <?php
                           $q="Select * From boxesforpickup_supersack Where companyID = '".$ID."' order by ID";
                           
                           db_b2b();
                           $X=db_query($q);
                                 $supnums=tep_db_num_rows($X);
                           
                           if($supnums>0){
                           while($fetchboxessup=array_shift($X))
                           {
                           ?>
                        <tr bgcolor="#E4E4E4">
                           <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Type</font></td>
                           <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Supersacks&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <a href='#' onclick="document.getElementById('divBoxSuperRescue_child<?php echo $BoxReq_supchild;?>').style.display='none';document.getElementById('divBoxSuperRescue_child_edit<?php echo $BoxReq_supchild;?>').style.display='block'; return false;">
                              <img bgcolor='#C0CDDA'  src='images/edit.jpg'></a></font>
                           </td>
                        </tr>
                        <tr bgcolor="#E4E4E4">
                           <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Wall</font></td>
                           <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxessup["thick"];?></font></td>
                        </tr>
                        <tr bgcolor="#E4E4E4">
                           <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">New/Used</font></td>
                           <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxessup["box_condition"];?></font></td>
                        </tr>
                        <tr bgcolor="#E4E4E4">
                           <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Multiple Boxes</font></td>
                           <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php if ($fetchboxessup["req_another_box"]==1) {echo "Y";} else {echo "N";}?></font></td>
                        </tr>
                        <tr bgcolor="#E4E4E4">
                           <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Frequency</font></td>
                           <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxessup["frequency"];?></font></td>
                        </tr>
                        <tr bgcolor="#E4E4E4">
                           <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Quantity</font></td>
                           <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxessup["no_of_rescue"];?></font></td>
                        </tr>
                        <tr bgcolor="#E4E4E4">
                           <td width="160"  valign="top"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333" >Dimensions</font></td>
                           <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
                              <?php
                                 $boxsizequery = "Select * from box_sizes Where companyID = " .$ID ." and box_type='Supersacks' and buy_sell='sell' and boxID=".$fetchboxessup["ID"];
                                 
                                 db_b2b();
                                 $dt_view_res = db_query($boxsizequery);
                                 
                                 while($row_bx = array_shift($dt_view_res))
                                 {
                                 	$supersack_box_dimensions.=$row_bx["length"]." x ".$row_bx["width"]."<br>"; 
                                 }
                                 echo $supersack_box_dimensions;
                                 				?>
                              </font>
                           </td>
                        </tr>
                        <?php
                           }
                           }
                           ?>
                     </table>
                  </div>
                  <!--Edit supersack box-->
                  <div id="divBoxSuperRescue_child_edit<?php echo $BoxReq_supchild;?>" style="display:none;">
                     <form name="frmeditshipboxreq" action="" method="GET">
                        <input type="hidden" name="comp_id" id="comp_id" value="<?php echo $ID;?>">	
                        <table>
                           <?php
                              $q="Select * From boxesforpickup_supersack Where companyID = '".$ID."' order by ID";
                              
                              db_b2b();
                              $Xs=db_query($q);
                              
                              $shipnums=tep_db_num_rows($Xs);
                              if($shipnums>0){
                              while($fetchboxes=array_shift($Xs))
                              {
                              ?>
                           <input type="hidden" name="super_box_id" id="super_box_id" value="<?php echo $fetchboxes["ID"];?>">	
                           <tr bgcolor="#E4E4E4">
                              <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Type</font></td>
                              <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Supersacks&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                 </font>
                              </td>
                           </tr>
                           <tr bgcolor="#E4E4E4">
                              <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Wall</font></td>
                              <td align="left" width="376">
                                 <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
                                    <select name="wall" id="wall<?php echo $BoxReq_supchild;?>" style="width:150px;">
                                       <option value="">Please Select</option>
                                       <option value="1-Wall" <?php if ($fetchboxes["thick"] == "1-Wall") { echo " selected "; } ?>>1-Wall</option>
                                       <option value="2-Wall" <?php if ($fetchboxes["thick"] == "2-Wall") { echo " selected "; } ?>>2-Wall</option>
                                       <option value="3-Wall" <?php if ($fetchboxes["thick"] == "3-Wall") { echo " selected "; } ?>>3-Wall</option>
                                       <option value="4-Wall" <?php if ($fetchboxes["thick"] == "4-Wall") { echo " selected "; } ?>>4-Wall</option>
                                       <option value="5-Wall" <?php if ($fetchboxes["thick"] == "5-Wall") { echo " selected "; } ?>>5-Wall</option>
                                    </select>
                                 </font>
                              </td>
                           </tr>
                           <tr bgcolor="#E4E4E4">
                              <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">New/Used</font></td>
                              <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><input type="text" value="<?php echo $fetchboxes["box_condition"];?>" name="box_condition" id="box_condition<?php echo $BoxReq_supchild;?>"></font></td>
                           </tr>
                           <tr bgcolor="#E4E4E4">
                              <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Multiple Boxes</font></td>
                              <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><input type="text" value="<?php if ($fetchboxes["req_another_box"]==1) {echo "Y";} else {echo "N";}?>" name="req_another_box" id="req_another_box<?php echo $BoxReq_supchild;?>"></font></td>
                           </tr>
                           <tr bgcolor="#E4E4E4">
                              <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Frequency</font></td>
                              <td align="left" width="376">
                                 <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
                                    <select name="frequency" id="frequency<?php echo $BoxReq_supchild;?>">
                                       <option>Please Select</option>
                                       <option value="Recurring" <?php if($fetchboxes["frequency"]=="Recurring") { echo "selected"; } else {} ?> >Recurring</option>
                                       <option value="One-Time" <?php if($fetchboxes["frequency"]=="One-Time") { echo "selected"; } else {} ?>>One-Time</option>
                                    </select>
                                 </font>
                              </td>
                           </tr>
                           <tr bgcolor="#E4E4E4">
                              <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Quantity</font></td>
                              <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><input type="text" value="<?php echo $fetchboxes["no_of_rescue"];?>" name="quantity" id="quantity<?php echo $BoxReq_supchild;?>"></font></td>
                           </tr>
                           <tr bgcolor="#E4E4E4">
                              <td width="160" valign="top"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Dimensions</font></td>
                              <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
                                 <?php
                                    $boxsizequery = "Select * from box_sizes Where companyID = " .$ID ." and box_type='Supersacks' and buy_sell='sell' and boxID=".$fetchboxes["ID"];
                                    
                                    db_b2b();
                                    $dt_view_res = db_query($boxsizequery);
                                    
                                    while($row_bx = array_shift($dt_view_res))
                                    {
                                    		$super_box_dimensions.=$row_bx["length"]." x ".$row_bx["width"]."<br>"; 
                                    	//
                                    	$sup_box_size_id.=$row_bx["id"].'-';
                                    
                                    ?>
                                 <input type="text" name="sup_length[]" id="sup_length[]" value="<?php echo $row_bx['length']; ?>" size="4"> x <input type="text" name="sup_width[]" value="<?php echo $row_bx['width']; ?>" size="4" id="sup_width[]"> <br>
                                 <?php
                                    }
                                    //echo $ship_box_dimensions;
                                    ?>
                                 <input type="hidden" name="sup_box_size_id" id="sup_box_size_id" value="<?php echo $sup_box_size_id;?>">
                                 </font>
                              </td>
                           </tr>
                           <tr bgcolor="#E4E4E4">
                              <td colspan="2">
                                 <font size="1" face="Arial, Helvetica, sans-serif">
                                    <input type="button" style="cursor:pointer;" name="btnSave" value="Save" onclick="updateSuperBoxRescueEditnew(<?php echo $BoxReq_supchild;?>, <?php echo $fetchboxes['ID']; ?>)"/>&nbsp;&nbsp;
                                    <input type="button" style="cursor:pointer;" name="btncancel" value="Cancel" onclick="document.getElementById('divBoxSuperRescue_child<?php echo $BoxReq_pchild;?>divBoxSuperRescue_child>').style.display='block';document.getElementById('divBoxSuperRescue_child_edit<?php echo $BoxReq_supchild;?>').style.display='none';"/>
                              </td>
                           </tr>
                           <?php
                              }
                              }	
                              ?>
                        </table>
                     </form>
                  </div>
                  <!--End edit pallet box rescue-->	
               </td>
            </tr>
            <?php
               /*if ($fetchboxes["gbox"] == 'Y'){ ?>
            <tr bgcolor="#E4E4E4">
            <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Type</font></td>
            <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Gaylord Boxes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href='#' onclick="document.getElementById('divBoxRescue_child<?php echo $BoxReq_child;?>').style.display='none';document.getElementById('divBoxRescue_child_edit<?php echo $BoxReq_child;?>').style.display='block'; return false;">
            <img bgcolor='#C0CDDA'  src='images/edit.jpg'></a></font> 
            </td>
            </tr>
            <tr bgcolor="#E4E4E4">
            <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Shape</font></td>
            <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["shape"];?></font></td>
            </tr>
            <tr bgcolor="#E4E4E4">
            <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Top</font></td>
            <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["top"];?></font></td>
            </tr>
            <tr bgcolor="#E4E4E4">
            <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Bottom</font></td>
            <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["bottom"];?></font></td>
            </tr>
            <tr bgcolor="#E4E4E4">
            <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Vents</font></td>
            <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["vents"];?></font></td>
            </tr>
            <tr bgcolor="#E4E4E4">
            <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Wall</font></td>
            <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["thick"];?></font></td>
            </tr>
            <tr bgcolor="#E4E4E4">
            <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Contents</font></td>
            <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["previous_contents"];?></font></td>
            </tr>
            <tr bgcolor="#E4E4E4">
            <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Condition</font></td>
            <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["box_condition"];?></font></td>
            </tr>
            <tr bgcolor="#E4E4E4">
            <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Frequency</font></td>
            <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["frequency"];?></font></td>
            </tr>
            <tr bgcolor="#E4E4E4">
            <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Quantity</font></td>
            <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["no_of_rescue"];?></font></td>
            </tr>
            <?php
               } else { 
               	?>
            <tr bgcolor="#E4E4E4">
            <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Type</font></td>
            <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Shipping Boxes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href='#' onclick="document.getElementById('divBoxRescue_child<?php echo $BoxReq_child;?>').style.display='none';document.getElementById('divBoxRescue_child_edit<?php echo $BoxReq_child;?>').style.display='block'; return false;">
            <img bgcolor='#C0CDDA'  src='images/edit.jpg'></a></font>
            </td>
            </tr>
            <tr bgcolor="#E4E4E4">
            <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Dimensions</font></td>
            <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["length_lside"] . " x " . $fetchboxes["widthInch"] . " x " . $fetchboxes["depthInch"] ;?></font></td>
            </tr>
            <tr bgcolor="#E4E4E4">
            <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Wall</font></td>
            <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["thick"];?></font></td>
            </tr>
            <tr bgcolor="#E4E4E4">
            <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">New/Used</font></td>
            <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["box_condition"];?></font></td>
            </tr>
            <tr bgcolor="#E4E4E4">
            <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Multiple Boxes</font></td>
            <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php if ($fetchboxes["req_another_box"]==1) {echo "Y";} else {echo "N";}?></font></td>
            </tr>
            <tr bgcolor="#E4E4E4">
            <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Frequency</font></td>
            <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["frequency"];?></font></td>
            </tr>
            <tr bgcolor="#E4E4E4">
            <td width="160"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Quantity</font></td>
            <td align="left" width="376"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $fetchboxes["no_of_rescue"];?></font></td>
            </tr>
            <?php
               } */?>
            <tr><td bgcolor="#E4E4E4" colspan='2'><a href="manage_box_b2bloop_copytoinv.php?compid=<?php echo $ID;?>&boxtype=bkfp&boxid=<?php echo $fetchboxes["ID"];?>" target="_blank"><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">Copy over to inventory</font></a></td></tr>
            <tr><td colspan='2'>&nbsp;</td></tr>
         </table>
         <div id="divBoxGRescue_child_edit<?php echo $BoxReq_child;?>" style="display:none;">
         <!--//removedcode from here-->
         </div>
         <?php 
            $BoxReq_child = $BoxReq_child + 1;
            //}
            ?>
      </td>
   </tr>
</table>
<?php
   }
   
   function clientdashboard(mixed $ID):void
   {
   	?>
<table border="0" bgcolor="#F6F8E5" style="font-family:Arial, Helvetica, sans-serif; font-size:10;">
<tr align="center">
<td colspan="5" width="320px" bgcolor="#E8EEA8"><strong>Customer Dashboard Setup</strong></font></td>
</tr>
<form method="post" name="clientdash_adduser" action="clientdashboard_adduser_mrg.php">
<input type="hidden" name="hidden_companyid" value="<?php echo $ID; ?>" />
<tr align="center">
<td colspan="5" width="320px" align="left" bgcolor="#C1C1C1">Add new user for Customer</td>
</tr>
<tr align="center">
<td width="80px" >User name: </td>
<td colspan="4" width="320px" align="left"><input type="text" name="clientdash_username" id="clientdash_username" value="" /></td>
</tr>
<tr align="center">
<td width="80px" >Password: </td>
<td colspan="4" width="320px" align="left"><input type="password" name="clientdash_pwd" id="clientdash_pwd" value="" /></td>
</tr>
<tr align="center">
<td width="80px" >&nbsp;</td>
<td colspan="4" width="320px" align="left"><input type="button" name="clientdash_adduser" value="Add" onclick="clientdash_chkfrm()" /></td>
</tr>
</form>
<form method="post" name="clientdash_edituser" action="clientdashboard_edituser_mrg.php">
<tr align="center">
<td colspan="5" width="320px" align="left" bgcolor="#C1C1C1">Customer user list</td>
</tr>
<tr align="center">
<td width="80px" >User name</td>
<td width="80px" align="left">Password</td>
<td width="100px" align="left">Activate/Deactivate</td>
<td width="40px" align="left">Edit</td>
<td width="100px" align="left">Delete</td>
</tr>
<?php
   $qry ="Select * From clientdashboard_usermaster Where companyid = $ID";
   
   db();
   $res = db_query($qry);
   
   while($fetch_data=array_shift($res))
   {
   ?>
<input type="hidden" name="loginid" id="loginid" value="<?php echo $fetch_data["loginid"]; ?>" />
<tr align="center">
<td width="80px" ><input type="text" name="clientdash_username_edit" id="clientdash_username_edit" value="<?php echo $fetch_data["user_name"];?>" /></td>
<td width="80px" align="left"><input type="password" name="clientdash_pwd_edit" id="clientdash_pwd_edit" value="<?php echo $fetch_data["password"];?>" /></td>
<td width="100px" align="left"><input type="checkbox" name="clientdash_flg" id="clientdash_flg" <?php if ($fetch_data["activate_deactivate"] == 1) { echo " checked "; }?> /></td>
<td width="40px" align="left"><input type="button" value="Update" onclick="clientdash_edit()" /></td>
<td width="100px" align="left"><input type="button" value="Delete" onclick="clientdash_dele(<?php echo $fetch_data["loginid"];?>, <?php echo $ID;?>)" /></td>
</tr>
<?php
   }
   ?>
</form>
<tr align="center">
<td colspan="5" width="320px" align="left" >&nbsp;</td>
</tr>
<form method="post" name="clientdash_edituser_sec" action="clientdashboard_edit_sec_mrg.php">
<tr align="center">
<td colspan="5" width="320px" align="left" bgcolor="#C1C1C1">Section list</td>
</tr>
<tr align="center">
<td colspan="2" width="180px" align="left" >Section name</td>
<td width="100px" align="left">Activate/Deactivate</td>
<td width="40px" align="left">Edit</td>
<td width="80px" align="left">Delete</td>
</tr>
<?php
   $qry ="Select * From clientdashboard_section_details inner join clientdashboard_section_master on clientdashboard_section_master.section_id = clientdashboard_section_details.section_id where companyid = $ID";
   
   db();
   $res = db_query($qry);
   
   while($fetch_data=array_shift($res))
   {
   ?>
<input type="hidden" name="section_id" id="section_id" value="<?php echo $fetch_data["section_id"]; ?>" />
<input type="hidden" name="companyid_sec" id="companyid_sec" value="<?php echo $ID; ?>" />
<tr align="center">
<td colspan="2" width="180px" align="left"><?php echo $fetch_data["section_name"];?></td>
<td width="100px" align="left"><input type="checkbox" name="clientdash_sec_flg" id="clientdash_sec_flg" <?php if ($fetch_data["activate_deactivate"] == 1) { echo " checked "; }?> /></td>
<td width="40px" align="left"><input type="button" value="Update" onclick="clientdash_sec_edit(<?php echo $fetch_data["section_id"];?>, <?php echo $ID;?>)" /></td>
<td width="80px" align="left"><input type="button" value="Delete" onclick="clientdash_sec_dele(<?php echo $fetch_data["section_id"];?>, <?php echo $ID;?>)" /></td>
</tr>
<?php
   }
   ?>
</form>
<?php	
   db();
   $res = db_query("Select * from clientdashboard_section_master where section_id not in (select section_id from clientdashboard_section_details where companyid = $ID) order by section_name"); 
   	if (tep_db_num_rows($res) > 0) {
   ?>
<form method="post" name="clientdash_edituser_sec_add" action="clientdashboard_add_sec_mrg.php">
<input type="hidden" name="hidden_companyid_secadd" id="hidden_companyid_secadd" value="<?php echo $ID; ?>" />
<tr align="center">
<td colspan="2" width="180px" align="left" ><select name="clientdash_section" id="clientdash_section" >
<?php	
   while($fetch_data=array_shift($res))
   {
   	echo "<option value='" . $fetch_data["section_id"] . "'>" . $fetch_data["section_name"] ." </option>";
   }
   ?></select>
</td>
<td width="100px" align="left">&nbsp;</td>
<td colspan="2" width="120px" align="left"><input style="cursor:pointer;" type="submit" value="Add" /></td>
</tr>
</form>
<?php } ?>
</table>
<br/>
<?php
   }
   
   function addBoxRequested(mixed $ID):void
   {
   $strQuery = "SELECT * FROM companyInfo WHERE ID = " . $ID;
   
   db_b2b();
   $dt_view_res3 = db_query($strQuery);
   
   while ($co = array_shift($dt_view_res3)) {
   echo $co["req_type"];
   ?>
<table width="100%" border="0" cellspacing="1" cellpadding="1">
   <tr align="center">
      <td colspan="2" bgcolor="#C0CDDA"><font face="Arial, Helvetica, sans-serif" size="1">ADD A REQUESTED BOX</font></td>
   </tr>
   <?php
      if ($co["req_type"] == "box_cml" ) {
      	$strQuery = "SELECT * FROM boxesForPickup WHERE companyID = " . $ID;
      
      	db_b2b();
      	$dt_view_res3 = db_query($strQuery);
      
      	$bo = array_shift($dt_view_res3);
      	
      	$d["gbox"] = "Gaylord Boxes";
      	$d["if_gaylords"] = "If Gaylords";
      	$d["no_of_rescue"] = "Estimated total number of boxes in this rescue";
      	$d["list_dimensions"] = "I can’t list the dimensions, the boxes are all different";
      	$d["length_lside"] = "Length (longest side)";
      	$d["widthInch"] = "Width (shortest side)";
      	$d["depthInch"] = "Depth (height excluding flaps)";
      	$d["thick"] = "Wall Thickness";
      	$d["color"] = "Color";
      	$d["printing"] = "Printing";
      	$d["labels"] = "Mailing Labels";
      	$d["comments"] = "Comments";
      	$d["box_condition"] = "Condition";
      	$d["priceGetting"] = "Price Getting";
      	$d["req_another_box"] = "Request another box";
      ?>
   <form method="post" action="editTables_mrg.php">
      <?php
         foreach ($d as $key => $value) {
         ?>
      <tr bgcolor="#E4E4E4">
         <td><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $value?></font></td>
         <td width="30%"><input type="text" name="<?php echo $key?>"></td>
      </tr>
      <?php
         }
         ?>
      <input type=hidden name="editTable" value="AddboxesForPickup">
      <input type=hidden name="id" value="<?php echo $ID?>">
      <tr bgcolor="#E4E4E4">
         <td width="100%" colspan="2" align="center"><input style="cursor:pointer;" type="submit" value="Submit" name="B1"></td>
      </tr>
   </form>
   <?php
      } elseif ($co["req_type"] == "spbox_not") {
      $strQuery = "SELECT * FROM boxesrequested WHERE companyID LIKE '" . $ID . "'" ;
      echo $strQuery;
      
      db_b2b();
      $dt_view_res3 = db_query($strQuery);
      
      ?>
   <form method=post action="editTables_mrg.php">
      <?php
         while ($bo = array_shift($dt_view_res3)) {
         $d = array();
         $d["preferred_delivery_date"] = "Preferred Delivery Date";
         $d["receiving_dock_info_other"] = "Receiving Dock Info";
         $d["gbox"] = "I need gaylord boxes (pallet boxes measuring approximately 42 x 48 x 36)";
         $d["if_gaylords"] = "If Gaylords";
         $d["cubic_order"] = "Specify Dimensions";
         $d["cubicFeet"] = "Approx. cubic feet";
         $d["lengthInch"] = "Length (longest side)";
         $d["lengthFraction"] = "Can be";
         $d["widthInch"] = "Width (shortest side)";
         $d["widthFraction"] = "Can be";
         $d["depthInch"] = "Depth (height excluding flaps)";
         $d["depthFraction"] = "Can be";
         $d["wall_thickness"] = "Wall thickness";
         $d["color"] = "Color";
         $d["printing"] = "Printing";
         $d["unc_printing"] = "Unnacceptable printing";
         $d["dimension_stamp"] = "Dimension Stamp";
         $d["qty_for_box"] = "Quantity for this box";
         $d["qty_for_month"] = "Quanitity used each month";
         $d["price"] = "Price currently paid (help us be competitive)";
         $d["what_this_box_used_for"] = "What this box is used for";
         $d["comments"] = "Comments";
         $d["req_another_box"] = "Request another box";
         ?>
      <?php
         foreach ($d as $key => $value) {
         ?>
      <tr bgcolor="#E4E4E4">
         <td><font face="Arial, Helvetica, sans-serif" size="1" color="#333333"><?php echo $value?></font></td>
         <td width="30%"><input type="text" name="<?php echo $key;?>"></td>
      </tr>
      <?php
         }
         }
         ?>
      <input type=hidden name="editTable" value="AddboxesRequested">
      <input type=hidden name="id" value="<%=ID%>">
      <tr bgcolor="#E4E4E4">
         <td width="100%" colspan="2" align="center"><input style="cursor:pointer;" type="submit" value="Submit" name="B1"></td>
      </tr>
   </form>
   <?php
      } else { ; }
      ?>
</table>
<?php
   } }
   
   function remove_non_numeric(string $string):string { 
   return preg_replace('/\D/', '', $string); 
   }
   
   function right(string $string, string $chars):string
   { 
       $vright = substr($string, strlen($string)-$chars,$chars); 
       return $vright; 
       
   } 
   
   function make_insert_query(string $table_name, mixed $arr_data):string
   {
   	$fieldname = "";
   	$fieldvalue = "";
   	foreach($arr_data as $fldname => $fldval)
   	{
   		$fieldname = ($fieldname == "")?$fldname:$fieldname.','.$fldname;
   		$fieldvalue = ($fieldvalue == "")?"'".formatdata($fldval)."'":$fieldvalue.",'".formatdata($fldval)."'";
   	}
   	$query1 = "INSERT INTO ".$table_name." ($fieldname) VALUES($fieldvalue)";
   	return $query1;
   }
   
   function formatdata(mixed $data):string
   {
   	return addslashes(trim($data));
   }
   
   function putEmployee(mixed $data):void
   {
   ?>
<select size="1" name="<?php echo $data?>" id="<?php echo $data?>">
   <option value="">Please select</option>
   <?php
      db_b2b();
      $res = db_query("SELECT * FROM employees WHERE status LIKE 'Active'");
      while ($objEmp = array_shift($res)) {
      $selected = "";
      	If ($_COOKIE["b2b_id"] == $objEmp["employeeID"] ) {  
      		$selected = " selected ";
      	} Else { 
      		$selected = "";
      }
      ?>
   <option value="<?php echo $objEmp["employeeID"]?>"<?php echo $selected?>><?php echo $objEmp["name"]?></option>
   <?php
      }
      ?>
</select>
<?php
   }
   
   function get_initials_from_id_new(mixed $id):void {

   /////////////////////////////////////////// GET INITIALS FROM ID
   
   $dt_so = "SELECT * FROM loop_employees WHERE id = " . $id;
   
   db();
   $dt_res_so = db_query($dt_so);
   
   	while ($so_row = array_shift($dt_res_so)) {
function get_initials_from_id_new(mixed $id):string {
   /////////////////////////////////////////// GET INITIALS FROM ID
   
   $dt_so = "SELECT * FROM loop_employees WHERE id = " . $id;
   
   db();
   $dt_res_so = db_query($dt_so);
   
   	while ($so_row = array_shift($dt_res_so)) {
	   return $so_row["initials"];
   	}
}
   	}
   }
   
   function timestamp_to_datetime_new(mixed $d):string
   {
   
   	$da = explode(" ",$d);
   	$dp = explode("-", $da[0]);
   	$dh = explode(":", $da[1]);
   	
   	$x = $dp[1] . "/" . $dp[2] . "/" . $dp[0];
   
   
   	if ((int)$dh[0] - 2 > 12) {
		$x = $x . " " . ((int)$dh[0] - 12) . ":" . $dh[1] . "PM CT";
   	} else {
		$x = $x . " " . ((int)$dh[0]) . ":" . $dh[1] . "AM CT";
   	}
   	
   	return $x;
   }
   
   function viewSellTo_contacts(int $ID, int $selltoid, string $in_loops, string $loopurl, string $status, string $style_tbl, string $style_tbl_tr, string $mode_edit):void{
   
   	$qry = "Select * from b2bsellto where companyid = " . $ID . " order by selltoid";
   
   	db_b2b();
   	$dt_view= db_query($qry);
   
   	if ( tep_db_num_rows($dt_view) > 0){
   	
   		while ($objdb = array_shift($dt_view)) {
   			
   			if($objdb["title"] == ""){
   				$show_name = $objdb["name"];
   			}else{
   				$show_name = $objdb["name"] ." (". $objdb["title"] .")";
   			}
   		?>
<div>
   <table width="100%" border="0" cellspacing="1" cellpadding="3" class="<?php echo $style_tbl; ?>">
      <tr bgcolor="#E4E4E4" >
         <td align="left" width="89%">
            <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            <?php echo $show_name;?></font>
         </td>
         <td align="center" width="10%">
            <a id="arrasc_<?php echo $objdb['selltoid'];?>" href="javascript:void(0);" onclick="show_detaildiv(<?php echo $objdb["selltoid"];?> , 'N')"><img src="images/sort_asc.png" width="6px" height="11px"></a>
            <a id="arrdesc_<?php echo $objdb['selltoid'];?>" href="javascript:void(0);" onclick="show_detaildiv(<?php echo $objdb["selltoid"];?>,'N')" style="display: none;"><img src="images/sort_desc.png" width="6px" height="11px"></a>
         </td>
      </tr>
   </table>
</div>
<div id='detaildiv_<?php echo $objdb["selltoid"];?>' style="display: none;">
<?php
   if($objdb["selltoid"] == $selltoid && $selltoid != ''){
   	viewSellTodisplayedit($objdb["title"], $objdb["name"], $objdb["address"], $objdb["address2"], $objdb["city"], $objdb["state"], $objdb["zipcode"], $objdb["mainphone"], $objdb["mainphone"], $objdb["cellphone"], $objdb["email"], $ID, $selltoid, $objdb["fax"] , $in_loops, $loopurl, $status, $objdb["linked_profile"], $objdb["main_line_ph"], $objdb["main_line_ph_ext"],$style_tbl,$style_tbl_tr, $objdb["opt_out_mkt_sellto_email"], $objdb["sell_to_note"]);
   
   	echo "<script>show_detaildiv(".$objdb["selltoid"].",'N')</script>";
   }else if($mode_edit == 'yes' && $selltoid == ''){
   	viewSellTodisplayedit($objdb["title"], $objdb["name"], $objdb["address"], $objdb["address2"], $objdb["city"], $objdb["state"], $objdb["zipcode"], $objdb["mainphone"], $objdb["mainphone"], $objdb["cellphone"], $objdb["email"], $ID, $objdb["selltoid"], $objdb["fax"] , $in_loops, $loopurl, $status, $objdb["linked_profile"], $objdb["main_line_ph"], $objdb["main_line_ph_ext"],$style_tbl,$style_tbl_tr, $objdb["opt_out_mkt_sellto_email"], $objdb["sell_to_note"]);
   
   	echo "<script>show_detaildiv(".$objdb["selltoid"].",'N')</script>";
   }else{
   	viewSellTodisplay($objdb["title"], $objdb["name"], $objdb["address"], $objdb["address2"], $objdb["city"], $objdb["state"], $objdb["zipcode"], $objdb["mainphone"], $objdb["mainphone"], $objdb["cellphone"], $objdb["email"], $ID, $objdb["selltoid"], $objdb["fax"], $in_loops, $loopurl, $status, $objdb["linked_profile"], $objdb["main_line_ph"], $objdb["main_line_ph_ext"],$style_tbl,$style_tbl_tr, $objdb["opt_out_mkt_sellto_email"], $objdb['sell_to_note']);
   }
   
   echo '<br/></div>';
   	
   }	//while loop end					
   }		//if condition end
   
   ?>
<form method="POST" action="editTables_mrg_purchasing.php?action=selltoadd" id="addsaletofrm" name="addsaletofrm">
   <?php if ($in_loops == "yes") { ?> 	
   <input type="hidden" name="companyid" value="<?php echo $ID?>">
   <input type="hidden" name="search_result_url" value="<?php echo $loopurl?>">
   <?php } else { ?> 	
   <input type="hidden" name="id" value="<?php echo $ID?>">
   <input type="hidden" name="search_result_url" value="no">
   <input type="hidden" name="selltoadd_url" value="<?php echo $loopurl?>">
   <?php } ?> 	
   <input style="cursor:pointer;" type="submit" name="addsaleto" value="Add another SELL TO">
</form>
<?php 
   }
   
   function viewShipTo_contacts(int $ID, int $shiptoid, string $in_loops, string $loopurl, string $status, string $style_tbl, string $style_tbl_tr, string $mode_edit):void {
   
   	$qry = "SELECT * FROM b2bshipto WHERE companyid = " . $ID . " ORDER BY shiptoid";
   	
   	db_b2b();
   	$dt_view= db_query($qry);
   
   	if ( tep_db_num_rows($dt_view) > 0){
   	
   		while ($objdb = array_shift($dt_view)) {
   			
   			if($objdb["title"] == ""){
   				$show_name = $objdb["name"];
   			}else{
   				$show_name = $objdb["name"] ." (". $objdb["title"] .")";
   			}
   		?>
<div>
   <table width="100%" border="0" cellspacing="1" cellpadding="3" class="<?php echo $style_tbl; ?>">
      <tr bgcolor="#E4E4E4" >
         <td align="left" width="89%">
            <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            <?php echo $show_name;?></font>
         </td>
         <td align="center" width="10%">
            <a id="arrasc_<?php echo $objdb['shiptoid'];?>" href="javascript:void(0);" onclick="show_shipdetail(<?php echo $objdb["shiptoid"];?>)"><img src="images/sort_asc.png" width="6px" height="11px"></a>
            <a id="arrdesc_<?php echo $objdb['shiptoid'];?>" href="javascript:void(0);" onclick="show_shipdetail(<?php echo $objdb["shiptoid"];?>)" style="display: none;"><img src="images/sort_desc.png" width="6px" height="11px"></a>
         </td>
      </tr>
   </table>
</div>
<div id='shipdetail_<?php echo $objdb["shiptoid"];?>' style="display: none;">
<?php
   if($objdb["shiptoid"] == $shiptoid && $shiptoid != ''){
   	viewShipTodisplayedit($objdb["title"], $objdb["name"], $objdb["mainphone"], $objdb["mainphone"], $objdb["cellphone"], $objdb["email"], $ID, $shiptoid, $objdb["fax"] , $in_loops, $loopurl, $status, $objdb["linked_profile"], $objdb["main_line_ph"], $objdb["main_line_ph_ext"],$style_tbl,$style_tbl_tr, $objdb["opt_out_mkt_shipto_email"], $objdb['ship_to_note']); 
   
   
   
   	echo "<script>show_shipdetail(".$objdb["shiptoid"].")</script>";
   }else if($mode_edit == 'yes' && $shiptoid == ''){
   	viewShipTodisplayedit($objdb["title"], $objdb["name"], $objdb["mainphone"], $objdb["mainphone"], $objdb["cellphone"], $objdb["email"], $ID, $objdb["shiptoid"], $objdb["fax"] , $in_loops, $loopurl, $status, $objdb["linked_profile"], $objdb["main_line_ph"], $objdb["main_line_ph_ext"],$style_tbl,$style_tbl_tr, $objdb["opt_out_mkt_sellto_email"],$objdb['ship_to_note']);
   
   	echo "<script>show_shipdetail(".$objdb["shiptoid"].")</script>";
   }else{
   	viewShipTodisplay($objdb["title"], $objdb["name"], $objdb["mainphone"], $objdb["mainphone"], $objdb["cellphone"], $objdb["email"], $ID, $objdb["shiptoid"], $objdb["fax"], $in_loops, $loopurl, $status, $objdb["linked_profile"], $objdb["main_line_ph"], $objdb["main_line_ph_ext"],$style_tbl,$style_tbl_tr, $objdb["opt_out_mkt_shipto_email"],$objdb['ship_to_note']);
   }
   
   echo '<br/></div>';
   	
   }	//while loop end					
   }		//if condition end
   
   ?>
<form method="POST" action="editTables_mrg_purchasing.php?action=shiptoadd" id="addshiptofrm" name="addshiptofrm">
   <?php if ($in_loops == "yes") { ?> 	
   <input type="hidden" name="companyid" value="<?php echo $ID?>">
   <input type="hidden" name="search_result_url" value="<?php echo $loopurl?>">
   <?php } else { ?> 	
   <input type="hidden" name="id" value="<?php echo $ID?>">
   <input type="hidden" name="search_result_url" value="no">
   <input type="hidden" name="shiptoadd_url" value="<?php echo $loopurl?>">
   <?php } ?> 	
   <input style="cursor:pointer;" type="submit" name="addshipto" value="Add another SHIP TO">
</form>
<?php 
   }
   
   
   function view_billTo_contacts(int $ID, int $billtoid, string $in_loops, string $loopurl, string $style_tbl, string $style_tbl_tr, string $mode_edit):void {
   
   	$flg_first_rec = "y";
   	$qry = "Select * from b2bbillto where companyid = " . $ID . " order by billtoid LIMIT 18446744073709551610 OFFSET 1";
   	
   	db_b2b();
   	$dt_view= db_query($qry);
   
   	if ( tep_db_num_rows($dt_view) > 0){
   	
   		while ($objdb = array_shift($dt_view)) {
   			
   			if($objdb["title"] == ""){
   				$show_name = $objdb["name"];
   			}else{
   				$show_name = $objdb["name"] ." (". $objdb["title"] .")";
   			}
   		?>
<div>
   <table width="100%" border="0" cellspacing="1" cellpadding="3" class="<?php echo $style_tbl; ?>">
      <tr bgcolor="#E4E4E4" >
         <td align="left" width="89%">
            <font face="Arial, Helvetica, sans-serif" size="1" color="#333333">
            <?php echo $show_name;?></font>
         </td>
         <td align="center" width="10%">
            <a id="arrasc_<?php echo $objdb['billtoid'];?>" href="javascript:void(0);" onclick="show_billdetail(<?php echo $objdb["billtoid"];?>)"><img src="images/sort_asc.png" width="6px" height="11px"></a>
            <a id="arrdesc_<?php echo $objdb['billtoid'];?>" href="javascript:void(0);" onclick="show_billdetail(<?php echo $objdb["billtoid"];?>)" style="display: none;"><img src="images/sort_desc.png" width="6px" height="11px"></a>
         </td>
      </tr>
   </table>
</div>
<div id='billdetail_<?php echo $objdb["billtoid"];?>' style="display: none;">
<?php
   if($objdb["billtoid"] == $billtoid && $billtoid != ''){
   	
   	viewbillTodisplayedit($objdb["title"], $objdb["name"], $objdb["address"], $objdb["address2"], $objdb["city"], $objdb["state"], $objdb["zipcode"], $objdb["mainphone"], $objdb["directphone"], $objdb["cellphone"], $objdb["email"], $ID, $billtoid, $objdb["fax"] , $in_loops, $loopurl, $objdb["linked_profile"], $objdb["main_line_ph"], $objdb["main_line_ph_ext"], $flg_first_rec,$style_tbl,$style_tbl_tr,$objdb["bill_to_note"]); 
   
   		$flg_first_rec = "n";
   		echo "<script>show_billdetail(".$objdb["billtoid"].")</script>";
   
   }else if($mode_edit == 'yes' && $billtoid == ""){
   
   	viewbillTodisplayedit($objdb["title"], $objdb["name"], $objdb["address"], $objdb["address2"], $objdb["city"], $objdb["state"], $objdb["zipcode"], $objdb["mainphone"], $objdb["directphone"], $objdb["cellphone"], $objdb["email"], $ID, $billtoid, $objdb["fax"] , $in_loops, $loopurl, $objdb["linked_profile"], $objdb["main_line_ph"], $objdb["main_line_ph_ext"], $flg_first_rec,$style_tbl,$style_tbl_tr,$objdb["bill_to_note"]); 
   
   		$flg_first_rec = "y";
   		echo "<script>show_billdetail(".$objdb["billtoid"].")</script>";
   
   }else{
   	viewbillTodisplay($objdb["title"], $objdb["name"], $objdb["address"], $objdb["address2"], $objdb["city"], $objdb["state"], $objdb["zipcode"], $objdb["mainphone"], $objdb["directphone"], $objdb["cellphone"], $objdb["email"], $ID, $objdb["billtoid"], $objdb["fax"], $in_loops, $loopurl, $objdb["linked_profile"], $objdb["main_line_ph"], $objdb["main_line_ph_ext"], "",$style_tbl,$style_tbl_tr, "", $objdb["bill_to_note"]);
   }
   
   echo '<br/></div>';
   	
   }	//while loop end					
   }		//if condition end
   
   ?>
<form method="POST" action="editTables_mrg_purchasing.php?action=billtoadd" id="addbilltofrm" name="addbilltofrm">
   <?php if ($in_loops == "yes") { ?> 	
   <!--<input type="hidden" name="companyid" value="<?php //=$ID?>">
      <input type="hidden" name="search_result_url" value="<?php //=$loopurl?>">-->
   <?php } else { ?> 	
   <input type="hidden" name="id" value="<?php echo $ID?>">
   <input type="hidden" name="search_result_url" value="no">
   <input type="hidden" name="billtoadd_url" value="<?php echo "ID=". $ID; ?>">
   <?php } ?> 	
   <input style="cursor:pointer;" type="submit" name="addbillto" value="Add another BILL TO">
</form>
<?php 
   }
   
   ?>