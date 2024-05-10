<?php
   require ("../mainfunctions/database.php");
   require ("../mainfunctions/general-functions.php");
   
   function huntvalleywarehousepage(){
   
   		return "huntvalleyoffice_159265234358979.php";
   }
   
?>
<?php 
   $warehouse_id_list_str  = "15, 79, 32, 185, 111, 738 ,899 ,1191 ,1027 ,747 ,1514 ,1806 ,1472 ,1473 ,1527 ,1503 ,1972, 1491, 2134 ,2343, 2449, 2636, 2609"; 
   
   $warehouse_id_list_str2 = "15 ,79 ,32 ,185 ,111 ,738 ,899 ,1191 ,1027 ,747 ,1514 ,1806, 1472 ,1473 ,1527 ,1503 ,1972, 1491, 2134, 2343, 2449, 2636, 2609";
   
   $warehouse_id_list_str3 = "15 ,79 ,32 ,185 ,111 ,738 ,899 ,1191 ,1027 ,747 ,1514 ,1806, 1472 ,1473 ,1527, 1503, 1972, 1491, 2134, 2343, 2449, 2636, 2609";
   
   $urlRefresh = "huntvalleyoffice_159265234358979.php";
   
   $location_address="Hunt Valley Office";
   
   ?>
<!DOCTYPE html>
<html>
   <title>Hunt Valley - Dashboard</title>
   <head>
      <style type="text/css">
         span.infotxt:hover {text-decoration: none; background: #ffffff; z-index: 6; }
         span.infotxt span {position: absolute; left: -9999px; margin: 20px 0 0 0px; padding: 3px 3px 3px 3px; z-index: 6;}
         span.infotxt:hover span {left: 45%; background: #ffffff;} 
         span.infotxt span {position: absolute; left: -9999px; margin: 0px 0 0 0px; padding: 3px 3px 3px 3px; border-style:solid; border-color:black; border-width:1px;}
         span.infotxt:hover span {margin: 18px 0 0 170px; background: #ffffff; z-index:6;} 
         span.infotxt_freight:hover {text-decoration: none; background: #ffffff; z-index: 6; }
         span.infotxt_freight span {position: absolute; left: -9999px; margin: 20px 0 0 0px; padding: 3px 3px 3px 3px; z-index: 6;}
         span.infotxt_freight:hover span {left: 0%; background: #ffffff;} 
         span.infotxt_freight span {position: absolute; left: -9999px; margin: 0px 0 0 0px; padding: 3px 3px 3px 3px; border-style:solid; border-color:black; border-width:1px;}
         span.infotxt_freight:hover span {margin: 18px 0 0 170px; background: #ffffff; z-index:6;} 
         span.so_infotxt:hover {text-decoration: none; background: #ffffff; z-index: 6; }
         span.so_infotxt span {position: absolute; left: -9999px; margin: 20px 0 0 0px; padding: 3px 3px 3px 3px; z-index: 6;}
         span.so_infotxt:hover span {left: 0%; background: #ffffff;} 
         span.so_infotxt span {position: absolute; left: -9999px; margin: 0px 0 0 0px; padding: 3px 3px 3px 3px; border-style:solid; border-color:black; border-width:1px;}
         span.so_infotxt:hover span {margin: 18px 0 0 50px; background: #ffffff; z-index:6;} 
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
         padding: 5px;
         border: 2px solid black;
         background-color: white;
         z-index:1002;
         overflow: auto;
         }
      </style>
      <script LANGUAGE="JavaScript">
         function chkssn(){
         
         	if (document.getElementById('ssn_txt').value.trim() == ""){
         
         		alert("Please enter the last four digit of your SSN.");
         
         		return false;
         
         	}else {
         
         		return true;
         
         	}
         
         }
         
         function chkssn_logout(id){
         
         	if (document.getElementById('ssn_txt_logout'+id).value.trim() == ""){
         
         		alert("Please enter the last four digit of your SSN.");
         
         		return false;
         
         	}else {
         
         		return true;
         
         	}
         
         }
         
         function eod_popup(warehousetbl)
         
         {
         
         	document.getElementById("hd_warehouse").value = warehousetbl;  
         
         	document.getElementById("light").innerHTML = "<a href='javascript:void(0)' onclick=document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'>Close</a><br>" + document.getElementById("diveod").innerHTML;
         
         	document.getElementById('light').style.display='block';
         
         	document.getElementById('light').style.left= '400px';
         
         	document.getElementById('light').style.top= 100 + 'px';
         
         }
         
         function display_file(filename, formtype){
         
         	document.getElementById("light").innerHTML = "<a href='javascript:void(0)' onclick=document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'>Close</a> &nbsp;<center>" + formtype +	"</center><br/> <embed src='"+ filename + "' width='800' height='800'>";
         
         	document.getElementById('light').style.display='block';
         
         	document.getElementById('fade').style.display='block';
         
         	document.getElementById('light').style.left= '200px';
         
         	document.getElementById('light').style.top= 50 + 'px';
         
         }
         
         function confirmationRequest(a,b,c) {
         
         var answer = confirm("Request Pickup of Trailer #"+a+"?")
         
         if (answer){
         
         	window.location = "<?php echo huntvalleywarehousepage()?>?action=request&req_id="+b+"&trailer_no="+a+"&dock="+c;
         
         }
         
         else{
         
         	alert("Request Cancelled");
         
         }
         
         }
         
         function confirmationDelivery(a,b,c) {
         
         var answer = confirm("Confirm Delivery of Trailer #"+a+" to UCB warehouse?")
         
         if (answer){
         
         	window.location = "<?php echo huntvalleywarehousepage()?>?action=confirm&conf_id="+b+"&trailer_no="+a+"&dock="+c;
         
         }
         
         else{
         
         	alert("Request Cancelled");
         
         }
         
         }
         
         function confirmationRecycling(a,b,c) {
         
         var answer = confirm("Confirm Trailer #"+a+" is recycling?")
         
         if (answer){
         
         	window.location = "<?php echo huntvalleywarehousepage()?>?action=recycling&conf_id="+b+"&trailer_no="+a+"&dock="+c;
         
         }
         
         else{
         
         	alert("Cancelled");
         
         }
         
         }
         
         function confirmationUcblot(a,b,c) {
         
         var answer = confirm("Confirm Trailer #"+a+" is UCB Lot?")
         
         if (answer){
         
         	window.location = "<?php echo huntvalleywarehousepage()?>?action=ucblot&conf_id="+b+"&trailer_no="+a+"&dock="+c;
         
         }
         
         else{
         
         	alert("Cancelled");
         
         }
         
         }
         
         function timedRefresh(timeoutPeriod) {
         
         setTimeout("location.reload(true);",timeoutPeriod);
         
         }
         
         function expand()
         
         {
         
         if(document.getElementById("pending_ship").innerHTML == "")
         
         	{
         
         	document.getElementById("pending_ship").innerHTML = "<br/>Loading .....<img src='images/wait_animated.gif' />";
         
         	if(document.getElementById("pending_ship").style.display == "none")
         
         	{
         
         		document.getElementById("pending_ship").style.display = "block";
         
         	}
         
         	else
         
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
         
         				document.getElementById("pending_ship").innerHTML = xmlhttp.responseText;  
         
         		  }
         
         	    }
         
         	}
         
         	xmlhttp.open("POST","pending_shipment_huntvalley.php",true);
         
         	xmlhttp.send();
         
         	}else{
         
         		document.getElementById("pending_ship").style.display="block";
         
         	}
         
         }
         
         function collapse()
         
         {
         
         	document.getElementById("pending_ship").style.display = "none";
         
         }
         
         function expand_inv()
         
         {
         
         	if(document.getElementById("inv").innerHTML == "")
         
         	{
         
         		document.getElementById("inv").innerHTML = "<br/>Loading .....<img src='images/wait_animated.gif' />";
         
         		if(document.getElementById("inv").style.display == "none")
         
         		{
         
         			document.getElementById("inv").style.display = "block";
         
         		}
         
         		else
         
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
         
         				document.getElementById("hide_tr").style.display="none";
         
         				document.getElementById("inv").innerHTML = xmlhttp.responseText;  
         
         			  }
         
         			}
         
         		}	
         
         		xmlhttp.open("POST","inv_huntvalley.php",true);
         
         		xmlhttp.send();
         
         	}else{
         
         		document.getElementById("hide_tr").style.display = "none";
         
         		document.getElementById("inv").style.display="block";
         
         	}
         
         }
         
         function collapse_inv()
         
         {
         
         	document.getElementById("inv").style.display = "none";
         
         	document.getElementById("hide_tr").style.display = "block";
         
         }
         
           function expand_b2cinv()
         
         {
         
         	if(document.getElementById("b2c_inv").innerHTML == "")
         
         	{
         
         		document.getElementById("b2c_inv").innerHTML = "<br/>Loading .....<img src='images/wait_animated.gif' />";
         
         		if(document.getElementById("b2c_inv").style.display == "none")
         
         		{
         
         			document.getElementById("b2c_inv").style.display = "block";
         
         		}
         
         		else
         
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
         
         			document.getElementById("hide_b2cinv").style.display="none";
         
         			document.getElementById("b2c_inv").innerHTML = xmlhttp.responseText;  
         
         		  }
         
         		}
         
         		}	
         
         		xmlhttp.open("POST","report_b2c_inventory_for_dashboard.php?whid=1",true);
         
         		xmlhttp.send();
         
         	}else{
         
         		document.getElementById("hide_b2cinv").style.display = "none";
         
         		document.getElementById("b2c_inv").style.display="block";
         
         	}
         
         }
         
            function collapse_b2cinv()
         
         {
         
         	document.getElementById("b2c_inv").style.display = "none";
         
         	document.getElementById("hide_b2cinv").style.display = "block";
         
         }
         
         function dynamic_Select(sort)
         
         {
         
         	var skillsSelect = document.getElementById('dropdown');
         
         	var selectedText = skillsSelect.options[skillsSelect.selectedIndex].value;
         
         	document.getElementById("temp").value = selectedText;
         
         }
         
         function sort_Select(warehouseid)
         
         {
         
         	var Selectval = document.getElementById('sort_by_order');
         
         	var order_type = Selectval.options[Selectval.selectedIndex].text;
         
         	if(document.getElementById("dropdown").value == "")
         
         	{
         
         		alert("Please Select the field.");
         
         	}
         
         	else
         
         	{
         
         		document.getElementById("tempval_focus").focus();
         
         		document.getElementById("tempval").style.display = "none";
         
         		document.getElementById("tempval1").innerHTML  = "<br/><div style='text-align: center;'>Loading .....<img src='images/wait_animated.gif' /></div>"; 			
         
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
         
         				if(order_type != "")
         
         				{
         
         					document.getElementById("tempval1").innerHTML = xmlhttp.responseText; 
         
         				}
         
         			}
         
         		}
         
         		xmlhttp.open("GET","pre_order_sort.php?warehouseid=" + warehouseid + "&selectedgrpid_inedit="+document.getElementById("temp").value+"&sort_order="+order_type,true);	
         
         		xmlhttp.send();
         
         	}
         
         } 
         
         function f_getPosition (e_elemRef, s_coord) {
         
         	var n_pos = 0, n_offset,
         
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
         
         function displayafterpo(boxid)
         
         {
         
         	document.getElementById("light").innerHTML  = "<br/><div style='text-align: center;'>Loading .....<img src='images/wait_animated.gif' /></div>"; 			
         
         	document.getElementById('light').style.display='block';
         
         	document.getElementById('fade').style.display='block';
         
         	var selectobject = document.getElementById("after_pos" + boxid);
         
         	var n_left = f_getPosition(selectobject, 'Left');
         
         	var n_top  = f_getPosition(selectobject, 'Top');
         
         	n_left = n_left - 250;
         
         	n_top = n_top - 100;
         
         	document.getElementById('light').style.left=n_left + 'px';
         
         	document.getElementById('light').style.top=n_top + 20 + 'px';
         
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
         
         			document.getElementById("light").innerHTML = "<a href='javascript:void(0)' onclick=document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'>Close</a> <br><hr>" + xmlhttp.responseText; 
         
         		}
         
         	}
         
         	xmlhttp.open("GET","inventory_showafterpo.php?id=" + boxid,true);	
         
         	xmlhttp.send();
         
         } 	
         
         function display_orders_data(tmpcnt, box_id, wid) {
         
         	if (document.getElementById('inventory_preord_top_' + tmpcnt).style.display == 'table-row')
         
         	{ 
         
         		document.getElementById('inventory_preord_top_' + tmpcnt).style.display='none'; 
         
         	} else {
         
         		document.getElementById('inventory_preord_top_' + tmpcnt).style.display='table-row'; 
         
         	} 
         
         	document.getElementById("inventory_preord_middle_div_"+tmpcnt).innerHTML = "<br><br>Loading .....<img src='images/wait_animated.gif' />"; 				
         
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
         
         		  document.getElementById("inventory_preord_middle_div_"+tmpcnt).innerHTML = xmlhttp.responseText;
         
         		}
         
         	}
         
         	xmlhttp.open("GET","gaylordstatus_childtable.php?box_id=" +box_id+"&wid="+wid+"&tmpcnt="+tmpcnt,true);
         
         	xmlhttp.send();
         
         }
         
         function displayflyer_main(boxid, flyernm)
         
         {
         
         	document.getElementById("light").innerHTML  = "<a href='javascript:void(0)' onclick=document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'>Close</a> <br><hr><embed src='boxpics/" + flyernm + "' width='700' height='800'>"; 			
         
         	document.getElementById('light').style.display='block';
         
         	document.getElementById('fade').style.display='block';
         
         	var selectobject = document.getElementById("box_fly_div_main"+boxid);
         
         	var n_left = f_getPosition(selectobject, 'Left');
         
         	var n_top  = f_getPosition(selectobject, 'Top');
         
         	n_left = n_left - 350;
         
         	n_top = n_top - 200;
         
         	document.getElementById('light').style.left=n_left + 'px';
         
         	document.getElementById('light').style.top=n_top + 20 + 'px';
         
         }	
         
         function displayactualpallet(boxid)
         
         {
         
         	document.getElementById("light").innerHTML  = "<br/><div style='text-align: center;'>Loading .....<img src='images/wait_animated.gif' /></div>"; 			
         
         	document.getElementById('light').style.display='block';
         
         	document.getElementById('fade').style.display='block';
         
         	var selectobject = document.getElementById("actual_pos"+boxid);
         
         	var n_left = f_getPosition(selectobject, 'Left');
         
         	var n_top  = f_getPosition(selectobject, 'Top');
         
         	n_top = n_top - 200;
         
         	document.getElementById('light').style.left=n_left + 'px';
         
         	document.getElementById('light').style.top=n_top + 20 + 'px';
         
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
         
         			document.getElementById("light").innerHTML = "<a href='javascript:void(0)' onclick=document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'>Close</a> <br><hr>" + xmlhttp.responseText; 
         
         		}
         
         	}
         
         	xmlhttp.open("GET","report_inventory.php?inventory_id="+boxid+"&action=run",true);	
         
         	xmlhttp.send();	
         
         }	
         
         function display_preoder_sel(tmpcnt, reccnt, box_id, wid) {
         
         	if (reccnt > 0 ) {
         
         	if (document.getElementById('inventory_preord_top_' + tmpcnt).style.display == 'table-row') 
         
         	{ document.getElementById('inventory_preord_top_' + tmpcnt).style.display='none'; } else {
         
         	 document.getElementById('inventory_preord_top_' + tmpcnt).style.display='table-row'; }
         
         	document.getElementById("inventory_preord_middle_div_"+tmpcnt).innerHTML = "<br><br>Loading .....<img src='images/wait_animated.gif' />"; 				
         
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
         
         		  document.getElementById("inventory_preord_middle_div_"+tmpcnt).innerHTML = xmlhttp.responseText;
         
         		}
         
         	}
         
         	xmlhttp.open("GET","inventory_preorder_childtable.php?box_id=" +box_id+"&wid="+wid,true);
         
         	xmlhttp.send();
         
         	}
         
         }
         
         function displayboxdata(boxid)
         
         {
         
         	document.getElementById("light").innerHTML  = "<br/><div style='text-align: center;'>Loading .....<img src='images/wait_animated.gif' /></div>"; 			
         
         	document.getElementById('light').style.display='block';
         
         	document.getElementById('fade').style.display='block';
         
         	var selectobject = document.getElementById("box_div" + boxid);
         
         	var n_left = f_getPosition(selectobject, 'Left');
         
         	var n_top  = f_getPosition(selectobject, 'Top');
         
         	n_left = n_left - 350;
         
         	n_top = n_top - 200;
         
         	document.getElementById('light').style.left=n_left + 'px';
         
         	document.getElementById('light').style.top=n_top + 20 + 'px';
         
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
         
         			document.getElementById("light").innerHTML = "<a href='javascript:void(0)' onclick=document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'>Close</a> <br><hr>" + xmlhttp.responseText; 
         
         		}
         
         	}
         
         	xmlhttp.open("GET","manage_box_b2bloop.php?id=" + boxid + "&proc=View&",true);	
         
         	xmlhttp.send();
         
         } 
         
         function displayboxdata_main(boxid)
         
         {
         
         	document.getElementById("light").innerHTML  = "<br/><div style='text-align: center;'>Loading .....<img src='images/wait_animated.gif' /></div>"; 			
         
         	document.getElementById('light').style.display='block';
         
         	document.getElementById('fade').style.display='block';
         
         	var selectobject = document.getElementById("box_div_main" + boxid);
         
         	var n_left = f_getPosition(selectobject, 'Left');
         
         	var n_top  = f_getPosition(selectobject, 'Top');
         
         	n_left = n_left - 350;
         
         	n_top = n_top - 200;
         
         	document.getElementById('light').style.left=n_left + 'px';
         
         	document.getElementById('light').style.top=n_top + 20 + 'px';
         
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
         
         			document.getElementById("light").innerHTML = "<a href='javascript:void(0)' onclick=document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'>Close</a> <br><hr>" + xmlhttp.responseText; 
         
         		}
         
         	}
         
         	xmlhttp.open("GET","manage_box_b2bloop.php?id=" + boxid + "&proc=View&",true);	
         
         	xmlhttp.send();
         
         } 
         
            function complete_specialorder_row(ctrlnm, rec_id, completed_flg){
         
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
         
                        if(xmlhttp.responseText=="completed"){
         
                              var table_row = document.getElementById("so"+ctrlnm);
         
                              table_row.setAttribute('class', 'special_order_green');
         
                            document.getElementById("complete_so_div"+ctrlnm).innerHTML = "Completed<br><input type='button' name='undo_complete_so' id='undo_complete_so"+ctrlnm+"' onclick='complete_specialorder_row("+ctrlnm+","+rec_id+",0); return false;' value='Undo'>";
         
                           so_process_complete_email(ctrlnm,rec_id,1);
         
                        }
         
                        if(xmlhttp.responseText=="undo completed"){
         
                              var table_row = document.getElementById("so"+ctrlnm);
         
                              table_row.setAttribute('class', 'special_order_normal');
         
                              document.getElementById("complete_so_div"+ctrlnm).innerHTML = "<input type='button' name='complete_so' id='complete_so"+ctrlnm+"' onclick='complete_specialorder_row("+ctrlnm+","+rec_id+",1); return false;' value='Complete'>";
         
                        }
         
         		}
         
         	}
         
         	xmlhttp.open("GET","complete_special_oder.php?wid="+ctrlnm+"&completed_flg="+completed_flg+"&rec_id="+rec_id,true);
         
         	xmlhttp.send();
         
         }
         
         function so_process_complete_email(ctrlnm,rec_id,flg)
         
         { 
         
         	 var selectedText,selectobject,rec_type,skillsSelect,n_left,n_top;
         
         	 selectobject = document.getElementById("complete_so_div"+ctrlnm);
         
         	var deadlinedate = document.getElementById("deadlinedate"+ctrlnm).value;
         
         	var pprintdata = document.getElementById("pprintdata"+ctrlnm).value;
         
         	 var n_left = f_getPosition(selectobject, 'Left');
         
         	var n_top  = f_getPosition(selectobject, 'Top');
         
         	document.getElementById('light').style.left = 300 + 'px';
         
         	document.getElementById('light').style.top = n_top + 30 + 'px';
         
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
         
         		document.getElementById("light").innerHTML = "<a href='javascript:void(0)' onclick=document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'>Close</a> &nbsp;<center></center><br/>"+xmlhttp.responseText;
         
         		document.getElementById('light').style.display='block';
         
         	  }
         
         	}
         
         	xmlhttp.open("POST","so_complete_process_email.php?wid="+rec_id+"&rec_id="+ctrlnm+"&deadlinedate="+deadlinedate+"&pprintdata="+pprintdata+"&complete_email=1",true);			
         
         	xmlhttp.send();
         
         }
         
            function btnsendclick_so(id) 
         
         {	
         
         	var tmp_element1,tmp_element2,tmp_element3,tmp_element4,tmp_element5;
         
         	tmp_element1 = document.getElementById("txtemailto").value; 
         
         	tmp_element3 = document.getElementById("txtemailcc").value; 
         
         	tmp_element2 = document.getElementById("email_so"); 
         
         	tmp_element4 = document.getElementById("txtemailsubject").value; 
         
         	tmp_element5 = document.getElementById("hidden_reply_eml").value; 
         
                var warehouse_id = document.getElementById("wid").value; 
         
         	var rec_id = document.getElementById("rec_id").value;
         
         	var inst = FCKeditorAPI.GetInstance("txtemailbody");
         
         	var emailtext = inst.GetHTML();
         
         	tmp_element5.value = emailtext;
         
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
         
         			if (xmlhttp.responseText == ""){
         
         				alert("Email Sent.");
         
         			}else{	
         
         				alert(xmlhttp.responseText);
         
         			}
         
         		    document.getElementById('light').style.display='none';
         
         		}
         
         	}
         
         	xmlhttp.open("GET","so_complete_email_send.php?txtemailto=" + tmp_element1+ "&unqid=" + id + "&warehouse_id=" + warehouse_id + "&rec_id=" + rec_id + "&txtemailcc=" + tmp_element3 + "&txtemailsubject=" + encodeURIComponent(tmp_element4)+ "&hidden_sendemail=inemailmode&txtemailbody=" + encodeURIComponent(emailtext) , true);
         
         	xmlhttp.send();
         
         }
         
            function update_so_note(ctrlnm, rec_id, empid){
         
                var last_note = escape(document.getElementById("last_note_so"+ctrlnm).value);
         
                var rec_type = document.getElementById("rect_type_so"+ctrlnm).value;
         
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
         
         			document.getElementById("transinfo"+ctrlnm).innerHTML=xmlhttp.responseText;
         
         			var trans_note=document.getElementById("trans_note").value;
         
         			var trans_date=document.getElementById("trans_date").value;
         
         			document.getElementById("last_note_so"+ctrlnm).value=trans_note;
         
         			document.getElementById("transdate_div"+ctrlnm).innerHTML=trans_date;
         
                        alert("Note has been updated successfully");	
         
         		}
         
         	}
         
         	xmlhttp.open("POST","update_note_special_oder.php?wid="+ctrlnm+"&update_flg=1"+"&empid="+empid+"&rec_id="+rec_id+"&rec_type="+rec_type+"&last_note="+last_note,true);
         
         	xmlhttp.send();
         
         }
         
      </script>
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
         .special_order_normal{
         background-color: #e4e4e4;
         }
         .special_order_red{
         background-color:#FF0004;
         }
         .special_order_green{
         background-color:#51D337;
         }
      </style>
   </head>
   <script language="JavaScript">
      function FormCheck()
      
      {
      
      	if (document.BOLForm.trailer_no.value == "" |
      
      		document.BOLForm.dock.value =="" |
      
      		document.BOLForm.fullname.value =="")
      
      	{
      
      		alert("Please Complete All Field.\n Need help? Call 1-888-BOXES-88");
      
      		return false;
      
      	}
      
      }
      
   </SCRIPT>	 
   <script type="text/javascript"> 
      function update_cart()
      
      {
      
        var x
      
        var total=0
      
        var order_total
      
        for (x=1; x<=10; x++)
      
        {
      
          item_total=document.getElementById("weight_"+x)
      
          total = total + item_total.value * 1
      
        }
      
        order_total=document.getElementById("order_total")
      
        document.getElementById("order_total").value=total.toFixed(0)
      
       }
      
   </script>
   <body onload="JavaScript:timedRefresh(1200000);">
      <?php
         if ($_REQUEST["action"] == "confirm")
         
         {
         
         	$str_email="<html><head></head><body bgcolor=\"#E7F5C2\"><table align=\"center\" cellpadding=\"0\"><tr><td><p align=\"center\"><a href=\"http://www.usedcardboardboxes.com/index.php\"><img width=\"650\" height=\"166\" src=\"https://loops.usedcardboardboxes.com/images/ucb-banner1.jpg\"></a></p></td></tr><tr><td><p align=\"left\"><font face=\"arial\" size=\"2\">";
         
         	$str_email.= "Dear UsedCardboardBoxes.com,<br><br>This email is to confirm delivery of Trailer # " . $_REQUEST["trailer_no"] . " from McCormick & Company. Details below:<br><br>";
         
         	$str_email.= "McCormick Dock #:  <b>".$_REQUEST["dock"]."</b> <br>";
         
         	$str_email.= "Trailer #:  <b>".$_REQUEST["trailer_no"]."</b> <br><br>";
         
         	$str_email.= "Delivered to:<br><b>Used Cardboard Boxes<br>350 Clubhouse Rd<br>Suite F-G<br>Hunt Valley, MD 21031</b><br>";	
         
         	$str_email.= "Best Regards<br>";
         
         	$str_email.= "UsedCardboardBoxes.com<br>";
         
         	$str_email.= "</font></td></tr><tr><td><p align=\"center\"><img width=\"650\" height=\"87\" src=\"https://loops.usedcardboardboxes.com/images/ucb-footer1.jpg\"></p></td></tr></table></body></html>";
         
         	$recipient = "davidkrasnow@usedcardboardboxes.com, martymetro@usedcardboardboxes.com";
         
         	$subject = "Notification: Trailer Delivered to UCB - Clubhouse Rd";
         
         	$mailheadersadmin = "From: UsedCardboardBoxes.com <operations@UsedCardboardBoxes.com>\n";
         
         	$mailheadersadmin.= "MIME-Version: 1.0\r\n";
         
         	$mailheadersadmin.= "Content-Type: text/html; charset=ISO-8859-1\r\n";
         
         	$resp = sendemail_php_function(null, '', $recipient, "", "", "ucbemail@usedcardboardboxes.com", "Operations Usedcardboardboxes", "operations@UsedCardboardBoxes.com", $subject, $str_email); 
         
         	$sql3ud = "UPDATE loop_transaction SET pa_warehouse = '3558', bol_file = 'No BOL', bol_employee = 'UCB-HV', bol_date = '".date("m/d/Y")."', pa_pickupdate = '".date("m/d/Y")."' WHERE id = ". $_REQUEST["conf_id"];
			
			db();
         	$result3ud = db_query($sql3ud);
         
         	$sql3ud = "UPDATE loop_transaction SET cp_notes = 'Delivery Confirmed via Warehouse Dashboard', cp_employee = 'UCB-HV', cp_date = '".date("m/d/Y")."' WHERE id = ". $_REQUEST["conf_id"];
			
			db();
         	$result3ud = db_query($sql3ud);
         
         	redirect($urlRefresh);
         
         }
         
         $emp_login_msg = "";
         
         $fraud_found=0;
         
         if ($_REQUEST["action"] == "clockin")
         
         {
         
         	if ($_REQUEST["worker"] > 0 ) 
         
         	{
         
         		$rec_bypass = "no";
         
         		$sql_chk = "select user_pwd, user_masterpin from loop_workers where id = " . $_REQUEST["worker"];
				
				db();
         		$result_chk = db_query($sql_chk);
         
         		$rec_found = "notfound";
         
         		$emp_login_msg = "<font color=red><b>Entered last four digit of your SSN is not matching, please check.</b></font>";
         
         		while($row_chk = array_shift($result_chk)){
         
         			$rec_found = "found";
         
         			if ($row_chk["user_pwd"] != "0"){
         
         				if ($row_chk["user_pwd"] != $_REQUEST["ssn_txt"]) {
         
         					$rec_bypass = "err";
         
         					$emp_login_msg = "<font color=red><b>Entered last four digit of your SSN is not matching, please check.</b></font>";
         
         				}else{
         
         					$emp_login_msg = "";
         
         				}
         
         			}
         
         		}
         
         		if ($rec_bypass == "err"){
         
         			$sql_chk = "select variablevalue from tblvariable where variablename = 'master_pin'";
					
					db();
         			$result_chk = db_query($sql_chk);
         
         			while($row_chk = array_shift($result_chk)){
         
         				if ($row_chk["variablevalue"] != $_REQUEST["ssn_txt"]){
         
         					$rec_bypass = "err";
         
         					$emp_login_msg = "<font color=red><b>Entered last four digit of your SSN is not matching, please check.</b></font>";
         
         				}else{
         
         					$emp_login_msg = "";
         
         					$rec_bypass = "no";
         
         				}
         
         			}
         
         		}				
         
         		if ($rec_bypass == "no") {
         
         			$sql3ud = "INSERT INTO loop_timeclock (`worker_id` ,`warehouse_id` , `location_address` , `time_in`, `type`, `ipaddress`) VALUES ('" . $_REQUEST["worker"] . "', '3558', '".$location_address."', NOW() + INTERVAL 1 HOUR, '" . $_REQUEST["type"] . "', '" . $_SERVER["REMOTE_ADDR"] . "')";
					
					db();
         			$result3ud = db_query($sql3ud);
         
                     $ipcheckqery="select * from timeclock_check_ip where loop_warehouse_id=3558 and ipaddress='".$_SERVER["REMOTE_ADDR"]."'";
					
					 db();
                     $ipcheckqery_r = db_query($ipcheckqery);
         
                     $row_ipcheck = array_shift($ipcheckqery_r);
         
                     if(tep_db_num_rows($ipcheckqery_r)>0)
         
                     {
         
                         $fraud_found=0; 
         
         				redirect($urlRefresh);
         
                     }
         
                     else{
         
                         $worker_selected=$_REQUEST["worker"];
         
                         $fraud_found=1; 
         
                     }  
         
         		}
         
         	}
         
         }
         
         if ($_REQUEST["action"] == "clockout")
         
         {
         
         	$rec_bypass = "no";
         
         	$sql_chk = "select user_pwd, user_masterpin from loop_workers where id = " . $_REQUEST["worker_clockout"];
			
			db();
         	$result_chk = db_query($sql_chk);
         
         	$rec_found = "notfound";
         
         	$emp_login_msg = "<font color=red><b>Entered last four digit of your SSN is not matching, please check.</b></font>";
         
         	while($row_chk = array_shift($result_chk)){
         
         		$rec_found = "found";
         
         		if ($row_chk["user_pwd"] != "0") {
         
         			if ($row_chk["user_pwd"] != $_REQUEST["ssn_txt_logout"]) {
         
         				$rec_bypass = "err";
         
         				$emp_login_msg = "<font color=red><b>Entered last four digit of your SSN is not matching, please check.</b></font>";
         
         			}else{
         
         				$emp_login_msg = "";
         
         			}
         
         		}
         
         	}
         
         	if ($rec_bypass == "err"){
         
         		$sql_chk = "select variablevalue from tblvariable where variablename = 'master_pin'";
				 
				db();
         		$result_chk = db_query($sql_chk);
         
         		while($row_chk = array_shift($result_chk)){
         
         			if ($row_chk["variablevalue"] != $_REQUEST["ssn_txt_logout"]){
         
         				$rec_bypass = "err";
         
         				$emp_login_msg = "<font color=red><b>Entered last four digit of your SSN is not matching, please check.</b></font>";
         
         			}else{
         
         				$emp_login_msg = "";
         
         				$rec_bypass = "no";
         
         			}
         
         		}
         
         	}				
         
         	if ($rec_bypass == "no") {
         
         		  $sql3ud = "UPDATE loop_timeclock SET time_out = NOW() + INTERVAL 1 HOUR, ipaddress_clkout = '" . $_SERVER["REMOTE_ADDR"] . "' WHERE id = ". $_REQUEST["id"];

				  db();
         		  $result3ud = db_query($sql3ud,);
         
                 $ipcheckqery="select * from timeclock_check_ip where loop_warehouse_id=3558 and ipaddress='".$_SERVER["REMOTE_ADDR"]."'";
				 
				 db();
                 $ipcheckqery_r = db_query($ipcheckqery);
         
                 $row_ipcheck = array_shift($ipcheckqery_r);
         
                 if(tep_db_num_rows($ipcheckqery_r)>0)
         
                 {
         
                     $fraud_found=0;
         
         			redirect($urlRefresh);
         
                 }
         
                 else{
         
                     $worker_selected=$_REQUEST["worker_clockout"];
         
                     $fraud_found=1;
         
                 }
         
         	}
         
         }
         
         if($fraud_found==1)
         
         {
         
             $query = "SELECT loop_workers.name, loop_workers.id, loop_warehouse.id AS whid, loop_warehouse.company_name AS wh_name FROM loop_workers INNER JOIN loop_warehouse ON loop_workers.warehouse_id = loop_warehouse.id WHERE loop_workers.id=".$worker_selected;
			
			 db();
             $res = db_query($query);
         
             $w_row = array_shift($res);
         
             $worker_name=$w_row["name"];
         
             $worker_loc=$w_row["wh_name"];
         
             $fraud_email="<html><head></head><body bgcolor=\"#E7F5C2\"><table align=\"center\" cellpadding=\"0\"><tr><td><p align=\"center\"><a href=\"http://www.usedcardboardboxes.com/index.php\"><img width=\"650\" height=\"166\" src=\"https://loops.usedcardboardboxes.com/images/ucb-banner1.jpg\"></a></p></td></tr><tr><td><p align=\"left\"><font face=\"arial\" size=\"2\">";
         
         	if ($_REQUEST["action"]	== "clockout") {
         
         		$fraud_email.= "Dear David,<br><br>Employee <b>logout</b> from different IP. Below are details,<br><br>";
         
         	}else{
         
         		$fraud_email.= "Dear David,<br><br>Employee <b>login</b> from different IP. Below are details,<br><br>";
         
         	}	
         
             $fraud_email.= "Name: <b>".$worker_name."</b><br>";
         
             $fraud_email.= "IP Address:  <b>".$_SERVER["REMOTE_ADDR"]."</b> <br><br>";
         
             $fraud_email.= "Location:  <b>UCB - HV</b> <br><br>";
         
             $fraud_email.= "Best Regards<br>";
         
             $fraud_email.= "UsedCardboardBoxes.com<br>";
         
             $fraud_email.= "</font></td></tr><tr><td><p align=\"center\"><img width=\"650\" height=\"87\" src=\"https://loops.usedcardboardboxes.com/images/ucb-footer1.jpg\"></p></td></tr></table></body></html>";
         
             $f_recipient = "davidkrasnow@usedcardboardboxes.com";
         
             $f_subject = "Time-Clock fraud warning";
         
             $mailheadersadmin1 = "From: UsedCardboardBoxes.com <operations@UsedCardboardBoxes.com>\n";
         
             $mailheadersadmin1.= "MIME-Version: 1.0\r\n";
         
             $mailheadersadmin1.= "Content-Type: text/html; charset=ISO-8859-1\r\n";
         
           redirect($urlRefresh);
         
         }
         
         echo "<script type=\"text/javascript\">";
         
         echo "function display_preoder() {";
         
         echo " var totcnt = document.getElementById('inventory_preord_totctl').value;";
         
         echo " for (var tmpcnt = 1; tmpcnt < totcnt; tmpcnt++) {";
         
         echo " if (document.getElementById('inventory_preord_top_' + tmpcnt).style.display == 'table-row') ";
         
         echo " { document.getElementById('inventory_preord_top_' + tmpcnt).style.display='none'; } else {";
         
         echo "  document.getElementById('inventory_preord_top_' + tmpcnt).style.display='table-row'; } ";
         
         echo "}";
         
         echo "}";
         
         echo "</script>";
         
         ?>
      <!---- TABLE TO FORMAT ----------->
      <table border="0">
         <tr>
            <td width="30%">
               <img src="ucb_logo.jpg">
            </td>
            <td align=center width="50%">
               <font face="Ariel" size="5">
               <b>UsedCardboardBoxes.com<br></b>
               Dashboard Report for:<br>
               <b><i>UCB - Hunt Valley</i></b>
               </i>
            </td>
            <td align="right"  width="20%">
               <img src="new_interface_help.gif">
            </td>
         </tr>
         <tr>
            <td valign="top">
            </td>
            <td width="100">&nbsp;
            </td>
            <td valign="top">
            </td>
         </tr>
      </table>
      <table border="0">
      <tr>
         <td valign="top">
            <!--------------- EMPLOYEE TABLE ---------------->
            <form method="post" action="<?php echo $urlRefresh?>" onsubmit="return chkssn();">
               <input type=hidden name="action" value="clockin">
               <table cellSpacing="1" cellPadding="1" border="0" width="700px;">
                  <tr align="middle">
                     <td class="style7" colspan="5">
                        <b>TIMECLOCK - WHO IS WORKING?</b>
                     </td>
                  </tr>
                  <tr align="middle">
                     <td colspan="5">
                        <?php echo $emp_login_msg; ?>
                     </td>
                  </tr>
                  <tr>
                     <td class="style17" align="center">
                        <b>NAME</b>
                     </td>
                     <td class="style17" align="center">
                        <b>TIME IN</b>
                     </td>
                     <td class="style17" align="center">			
                        <b>TYPE</b>
                     </td>
                     <td class="style17" align="center">			
                        <b>IP</b>
                     </td>
                     <td class="style5" align="center">
                        <b>LOGOUT</b>
                     </td>
                  </tr>
                  <tr vAlign="center">
                     <td bgColor="#e4e4e4" class="style3"  align="center">
                        <select id = "worker" name="worker">
                           <option value="-1">Select Worker</option>
                           <?php
                              $query = " SELECT * FROM loop_workers WHERE warehouse_id = 3558 and active = 1 and ";
                              
                              $query .= " id not in (select worker_id from loop_timeclock where warehouse_id = 3558 and time_out = '0000-00-00 00:00:00' AND loop_timeclock.id > 66800 group by worker_id) ORDER BY name ASC";
                              
							  db();
                              $res = db_query($query);
                              
                              while($row = array_shift($res))
                              
                              {
                              
                              	?>
                           <option value="<?php echo $row["id"]?>"><?php echo $row["name"]?></option>
                           <?php
                              }
                              
                              ?>
                        </select>
                     </td>
                     <td bgColor="#e4e4e4" class="style3"  align="center">
                        <select id = "type" name="type">
                           <option value="Office">Office</option>
                        </select>
                     </td>
                     <?php
                        $date1=mktime(date("H")+3, date("i"), date("s"), date("m"), date("d"), date("Y")); 
                        
                        ?>
                     <td bgColor="#e4e4e4" class="style3"  align="center" colspan="3">	
                        SSN (last 4 digit) <input type="password" name="ssn_txt" id="ssn_txt" value="" size="4"/>
                        <input style="cursor:pointer;" type=submit value="CLOCK IN" >
                     </td>
                  </tr>
            </form>
            <?php
               $query = "SELECT loop_timeclock.id AS A, loop_workers.name AS B, loop_timeclock.time_in AS C, loop_timeclock.type AS D, loop_timeclock.ipaddress AS IP, loop_timeclock.worker_id  FROM loop_timeclock INNER JOIN loop_workers ON loop_timeclock.worker_id = loop_workers.id WHERE loop_timeclock.time_out = '0000-00-00 00:00:00' AND loop_timeclock.warehouse_id = 3558 and loop_timeclock.location_address='".$location_address."' ORDER BY loop_timeclock.time_in ASC";
				
			   db();
               $res = db_query($query);
               
               while($row = array_shift($res))
               
               {
               
               	?>
            <form method="post" action="<?php echo $urlRefresh?>" onsubmit="return chkssn_logout(<?php echo $row["A"]?>);">
            <input type=hidden name="action" value="clockout">
            <input type=hidden name="id" value="<?php echo $row["A"]?>">
            <input type=hidden name="worker_clockout" value="<?php echo $row["worker_id"]?>">
            <tr vAlign="center">
            <td bgColor="#e4e4e4" class="style3"  align="center" width="200px;">	
            <?php echo $row["B"]; ?></td>
            <td bgColor="#e4e4e4" class="style3"  align="center" width="150px;">	
            <?php echo date('h:i:s A m/d/Y', strtotime($row["C"])); ?>
            </td>			
            <td bgColor="#e4e4e4" class="style3"  align="center" width="50px;">					
            <?php echo $row["D"];?>
            </td>			
            <td bgColor="#e4e4e4" class="style3"  align="center" width="50px;">					
            <a href="http://whatismyipaddress.com/ip/<?php echo $row["IP"]; ?>" target="_blank"><?php echo $row["IP"]; ?>
            </td>
            <td bgColor="#e4e4e4" align=middle class="style3" width="250px;">	
            SSN (last 4 digit) <input type="password" name="ssn_txt_logout" id="ssn_txt_logout<?php echo $row["A"]?>" value="" size="4"/>
            <input style="cursor:pointer;" type=submit value="Clock Out">
            </td>
            </tr>
            </form>
            <?php
               }
               
               ?>
            </table>
         </td>
         <!--------------- END EMPLOYEE TABLE ---------------->
         <td valign="top">
         <!--------------- PRODUCTION TABLE ----------------><br></td>
         <td valign="top">
         <!--------------------- BEGIN QUICK LINKS  ----------------------------------------------->
         <table cellSpacing="1" cellPadding="1" border="0" width="200">
         <tr align="middle">
         <td class="style7">
         <b>QUICK LINKS</b></td>
         </tr>
         <tr>
         <td bgColor="#e4e4e4" class="style12center" >
         <a href="http://loops.usedcardboardboxes.com/report_timeclock_public.php"><b>VIEW TIMECLOCK</b></a>
         </td>
         </tr>
         </table>
         <!----------------------- END QUICK LINKS ------------>
         </td>
      </tr>
      <!--------------- END PRODUCTION TABLE ---------------->
      <br><br>
      <!--------------- END IN PROCESS TABLE ---------------->
      <!--------------- BEGIN SALES ORDER TABLE ----------------><br>
      <!------------- McCormick Trailer Report ---------------->
      <div id="light" class="white_content">
      </div>
      <div id="fade" class="black_overlay"></div>
   </body>
</html>
