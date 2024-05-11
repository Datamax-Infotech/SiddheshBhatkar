<?php
   require ("../mainfunctions/database.php");
   
   require ("../mainfunctions/general-functions.php");
   
   require ("inc/functions_mysqli.php");
   
   $location_address="HK Trans Production";
   
   function hktranswarehousepage()
   {
   
   	return "https://loops.usedcardboardboxes.com/hktranswarehouse_1223644451.php";
   
   }
   
?>
<?php
   //1115 UCB - HK Trans LLC
   
   $urlRefresh = hktranswarehousepage();
   
   header("Refresh: 10; URL=".hktranswarehousepage()); // redirect in 5 seconds
   
   $IN_LIST = "1548, 1956, 3672, 3648, 3635"; //trailers in TO BE PROCESSED table
   
?>
<!DOCTYPE html>
<html>
   <title>HK Trans - Dashboard</title>
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
         
         
         
         function display_file(filename, formtype){
         
         	document.getElementById("light").innerHTML = "<a href='javascript:void(0)' onclick=document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'>Close</a> &nbsp;<center>" + formtype +	"</center><br/> <embed src='"+ filename + "' width='800' height='800'>";
         
         	document.getElementById('light').style.display='block';
         
         	document.getElementById('fade').style.display='block';
         
         
         
         	document.getElementById('light').style.left= '200px';
         
         	document.getElementById('light').style.top= 50 + 'px';
         
         	
         
         }
         
         
         
         function eod_popup(warehousetbl)
         
         {
         
         	document.getElementById("hd_warehouse").value = warehousetbl;  
         
         	
         
         	document.getElementById("light").innerHTML = "<a href='javascript:void(0)' onclick=document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'>Close</a><br>" + document.getElementById("diveod").innerHTML;
         
         	document.getElementById('light').style.display='block';
         
         	
         
         	document.getElementById('light').style.left= '400px';
         
         	document.getElementById('light').style.top= 100 + 'px';
         
         }
         
         
         
         
         
         
         
         function confirmationRequest(a,b,c) {
         
         var answer = confirm("Request Pickup of Trailer #"+a+"?")
         
         if (answer){
         
         	window.location = "<?php echo hktranswarehousepage()?>?action=request&req_id="+b+"&trailer_no="+a+"&dock="+encodeURIComponent(c);
         
         }
         
         else{
         
         	alert("Request Cancelled");
         
         }
         
         }
         
         
         
         function confirmationDelivery(a,b,c) {
         
         var answer = confirm("Confirm Delivery of Trailer #"+a+" to UCB warehouse?")
         
         if (answer){
         
         	window.location = "<?php echo hktranswarehousepage()?>?action=confirm&conf_id="+b+"&trailer_no="+a+"&dock="+encodeURIComponent(c);
         
         }
         
         else{
         
         	alert("Request Cancelled");
         
         }
         
         }
         
         
         
         function undoucbdockdoor(trailerno, recid) {
         
         var answer = confirm("Do you wish to Undo the UCBDockDoor Flag of Trailer #"+trailerno+"?")
         
         if (answer){
         
         	window.location = "<?php echo hktranswarehousepage()?>?action=undoucbdockdoor&conf_id="+recid+"&trailer_no="+trailerno;
         
         }
         
         else{
         
         	alert("Request Cancelled");
         
         }
         
         }
         
         
         
         
         
         function confirmationRecycling(a,b,c) {
         
         var answer = confirm("Confirm Trailer #"+a+" is recycling?")
         
         if (answer){
         
         	window.location = "<?php echo hktranswarehousepage()?>?action=recycling&conf_id="+b+"&trailer_no="+a+"&dock="+encodeURIComponent(c);
         
         }
         
         else{
         
         	alert("Cancelled");
         
         }
         
         }
         
         
         
         function confirmationUcblot(a,b,c) {
         
         var answer = confirm("Confirm Trailer #"+a+" is UCB Lot?")
         
         if (answer){
         
         	window.location = "<?php echo hktranswarehousepage()?>?action=ucblot&conf_id="+b+"&trailer_no="+a+"&dock="+encodeURIComponent(c);
         
         }
         
         else{
         
         	alert("Cancelled");
         
         }
         
         }
         
         function confirmationUnloaded(a,b,c) {
         
         var answer = confirm("Confirm Trailer #"+a+" is UCB Unloaded?")
         
         if (answer){
         
         	window.location = "<?php echo hktranswarehousepage()?>?action=confirm&conf_id="+b+"&trailer_no="+a+"&dock="+encodeURIComponent(c);
         
         }
         
         else{
         
         	alert("Cancelled");
         
         }
         
         }
         
         
         
         function confirmationUnloaded_new(trailer, recid, dock, warehouse_id) {
         
         selectobject = document.getElementById("btnDelivered"+recid);
         
         
         
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
         
         	n_left = f_getPosition(selectobject, 'Left');
         
         	n_top  = f_getPosition(selectobject, 'Top');
         
         	document.getElementById("light_dd").innerHTML = xmlhttp.responseText;
         
         	document.getElementById('light_dd').style.display='block';
         
         	//document.getElementById('fade').style.display='block';
         
         	
         
         	document.getElementById('light_dd').style.left= (n_left - 400) + 'px';//(n_left - 300) + 'px';
         
         	  document.getElementById('light_dd').style.height= 250 + 'px';
         
         	  document.getElementById('light_dd').style.width= 450 + 'px';
         
         	  document.getElementById('light_dd').style.top=n_top + 20 + 'px';
         
           }
         
         }
         
         
         
         xmlhttp.open("POST","wa_unloaded_popup.php?recid="+recid+"&dock="+encodeURIComponent(dock)+"&warehouse_id="+warehouse_id+"&trailer="+encodeURIComponent(trailer)+"&dd_flg=1",true);		
         
         xmlhttp.send();
         
         
         
         }
         
         
         
         function save_unloaded_val(recid)
         
         {
         
            var txtunloadedwhere = document.getElementById("txtunloadedwhere").value;
         
         var warehouse_id = document.getElementById("warehouse_id").value;
         
         var wa_dd_save = document.getElementById("wa_dd_save").value;
         
         
         
         var rec_id = document.getElementById("rec_id").value;
         
         var dock = document.getElementById("dock").value;
         
         var trailer = document.getElementById("trailer").value;
         
         
         
         if (window.XMLHttpRequest)
         
         {// code for IE7+, Firefox, Chrome, Opera, Safari
         
         	xmlhttp=new XMLHttpRequest();
         
         }
         
         else
         
         {// code for IE6, IE5
         
         	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
         
         }
         
         xmlhttp.onreadystatechange=function()
         
         {
         
         	if (xmlhttp.readyState==4 && xmlhttp.status==200)
         
         	{
         
         		alert("DockDoor added successfully");
         
                  	document.getElementById('light_dd').style.display='none';
         
         		window.location = "<?php echo hktranswarehousepage()?>";
         
         	}
         
         }
         
         
         
         xmlhttp.open("POST","wa_unloaded_popup.php?updatedockdoor=1&wa_dd_save="+wa_dd_save+"&txtunloadedwhere="+txtunloadedwhere+"&warehouse_id="+warehouse_id+"&rec_id="+rec_id+"&dock="+encodeURIComponent(dock)+"&trailer="+trailer,true);
         
         xmlhttp.send();
         
              
         
         }
         
         
         
         
         
         function timedRefresh(timeoutPeriod) {
         
         
         
         setTimeout("location.reload(true);",timeoutPeriod);
         
         
         
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
         
         
         
         function fn_delivered_to_dock(trailer,recid,editflg,wh_name)
         
         { 
         
         	 selectobject = document.getElementById("dockdoor_"+recid);
         
         
         
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
         
         			n_left = f_getPosition(selectobject, 'Left');
         
         			n_top  = f_getPosition(selectobject, 'Top');
         
         			document.getElementById("light_dd").innerHTML = xmlhttp.responseText;
         
         			document.getElementById('light_dd').style.display='block';
         
         			//document.getElementById('fade').style.display='block';
         
         			
         
         			document.getElementById('light_dd').style.left= (n_left - 300) + 'px';//(n_left - 300) + 'px';
         
         			  document.getElementById('light_dd').style.height= 370 + 'px';
         
         			  document.getElementById('light_dd').style.width= 600 + 'px';
         
         			  document.getElementById('light_dd').style.top=n_top + 20 + 'px';
         
         		  }
         
         		}
         
         
         
         		xmlhttp.open("POST","wa_dock_door_delivered.php?recid="+recid+"&trailer="+trailer+"&dd_flg=1"+"&editflg="+editflg+"&wh_name="+wh_name,true);		
         
         		xmlhttp.send();
         
         }
         
         //
         
         function save_dockdoor_val(recid)
         
         {
         
            var srt_dock_doors = document.getElementById("srt_dock_doors").value;
         
         var warehouse_id = document.getElementById("warehouse_id").value;
         
         var wa_dd_save = document.getElementById("wa_dd_save").value;
         
         var wh_name = document.getElementById("wh_name").value;
         
         if (window.XMLHttpRequest)
         
         {// code for IE7+, Firefox, Chrome, Opera, Safari
         
         	xmlhttp=new XMLHttpRequest();
         
         }
         
         else
         
         {// code for IE6, IE5
         
         xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
         
         }
         
         xmlhttp.onreadystatechange=function()
         
         {
         
         	if (xmlhttp.readyState==4 && xmlhttp.status==200)
         
         	{
         
         		alert("DockDoor added successfully");
         
                  	document.getElementById('light_dd').style.display='none';
         
         		window.location = "<?php echo hktranswarehousepage()?>";
         
         	}
         }
         
         xmlhttp.open("POST","wa_dock_door_delivered.php?updatedockdoor=1&wa_dd_save="+wa_dd_save+"&srt_dock_doors="+srt_dock_doors+"&warehouse_id="+warehouse_id+"&rec_id="+recid+"&wh_name="+wh_name,true);
         
         xmlhttp.send();
         
         }
         
         //
         
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
         
         
         
         function expand()
         
         {
         
         if(document.getElementById("pending_ship").innerHTML == "")
         
         	{
         
         	document.getElementById("pending_ship").innerHTML = "<br/>Loading .....<img src='images/wait_animated.gif' />";
         
         	
         
         	if(document.getElementById("pending_ship").style.display == "none")
         
         	{//alert("1");
         
         		document.getElementById("pending_ship").style.display = "block";
         
         	}
         
         	else
         
         	{//alert("2");	
         
         		if (window.XMLHttpRequest)
         
         		{// code for IE7+, Firefox, Chrome, Opera, Safari
         
         		  xmlhttp=new XMLHttpRequest();
         
         		}
         
         		
         
         		else
         
         		{// code for IE6, IE5
         
         		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
         
         		}
         
         		
         
         		xmlhttp.onreadystatechange=function()
         
         		{
         
         		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
         
         		  {
         
         				document.getElementById("pending_ship").innerHTML = xmlhttp.responseText;  
         
         		  }
         
         			//alert(xmlhttp.responseText);
         
         	    }
         
         	}
         
         
         
         	//alert("flyer_pdf.php?id=" + id);
         
         	xmlhttp.open("POST","pending_shipment_hktrans.php",true);
         
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
         
         		{//alert("1");
         
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
         
         		xmlhttp.open("POST","inv_hktrans.php",true);
         
         		xmlhttp.send();
         
         	}else{
         
         		document.getElementById("hide_tr").style.display = "none";
         
         		document.getElementById("inv").style.display="block";
         
         	}
         
         }
         
            function expand_b2cinv()
         
         {
         
         	
         
         	if(document.getElementById("b2c_inv").innerHTML == "")
         
         	{
         
         		document.getElementById("b2c_inv").innerHTML = "<br/>Loading .....<img src='images/wait_animated.gif' />";
         
         		
         
         		if(document.getElementById("b2c_inv").style.display == "none")
         
         		{//alert("1");
         
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
         
         		xmlhttp.open("POST","report_b2c_inventory_for_dashboard.php?whid=3",true);
         
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
         
         
         
         function collapse_inv()
         
         {
         
         	document.getElementById("inv").style.display = "none";
         
         	document.getElementById("hide_tr").style.display = "block";
         
         	
         
         }
         
         
         
         
         
         function dynamic_Select(sort)
         
         {
         
         	var skillsSelect = document.getElementById('dropdown');
         
         	var selectedText = skillsSelect.options[skillsSelect.selectedIndex].value;
         
         	document.getElementById("temp").value = selectedText;
         
         	//alert(document.getElementById("temp").value);
         
         }
         
         
         
         function undodelivery(trailerno, recid, dockno) {
         
         	var answer = confirm("Do you wish to Undo the Confirm Delivery of Trailer #"+trailerno+"?")
         
         	if (answer){
         
         		window.location = "<?php echo hktranswarehousepage()?>?action=undodelivery&conf_id="+recid+"&trailer_no="+trailerno+"&dock="+dockno;
         
         	}
         
         	else{
         
         		alert("Request Cancelled");
         
         	}
         
         }
         
         
         
         function displayucbinv(colid,sortflg)
         
         {
         
         	
         
         	document.getElementById("div_ucbinv_w").innerHTML  = "<br/><div style='text-align: center;'>Loading .....<img src='images/wait_animated.gif' /></div>"; 			
         
         
         
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
         
         			//alert(xmlhttp.responseText);
         
         			document.getElementById("div_ucbinv_w").innerHTML = xmlhttp.responseText; 
         
         		}
         
         	}
         
         
         
         	xmlhttp.open("GET","inventory_displayucbinv_warehouse.php?colid=" + colid + "&wid=1115"+ "&sortflg=" + sortflg ,true);	
         
         	xmlhttp.send();
         
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
         
         //
         
         /*Special order complete function*/
         
            function complete_specialorder_row(ctrlnm, rec_id, completed_flg){
         
         	/*var selectobject = document.getElementById("complete_so"+ctrlnm); 
         
         	var n_left = f_getPosition(selectobject, 'Left');
         
         	var n_top  = f_getPosition(selectobject, 'Top');*/
         
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
         
         			//document.getElementById("light").innerHTML = "<a href='javascript:void(0)' onclick=document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'>Close</a> <br><hr>"+ xmlhttp.responseText;
         
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
         
                //alert(quote_id+quote_rq_id);
         
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
         
            //
         
            function btnsendclick_so(id) 
         
         {	
         
         	var tmp_element1,tmp_element2,tmp_element3,tmp_element4,tmp_element5;
         
         	
         
         	tmp_element1 = document.getElementById("txtemailto").value; 
         
         	
         
         	tmp_element3 = document.getElementById("txtemailcc").value; 
         
         
         
         	tmp_element4 = document.getElementById("txtemailsubject").value; 
         
         
         
         	tmp_element5 = document.getElementById("hidden_reply_eml").value; 
         
         	
         
                var warehouse_id = document.getElementById("wid").value; 
         
         	var rec_id = document.getElementById("rec_id").value;
         
         	/*var warehouse_id = document.getElementById("warehouse_id_e"+id).value; 
         
         	var rec_id = document.getElementById("rec_id_e"+id).value;*/
         
         	
         
         	var inst = FCKeditorAPI.GetInstance("txtemailbody");
         
         	var emailtext = inst.GetHTML();
         
         	//alert(emailtext);
         
         	tmp_element5.value = emailtext;
         
         	//tmp_element2.submit();
         
         	
         
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
         
         			if (xmlhttp.responseText == "emailsend"){
         
         				alert("Email Sent.");
         
         			}else{	
         
         				alert(xmlhttp.responseText);
         
         				//alert("Email Error.");
         
         			}
         
         		    document.getElementById('light').style.display='none';
         
         		}
         
         	}
         
         
         
         	xmlhttp.open("GET","so_complete_email_send.php?txtemailto=" + tmp_element1+ "&unqid=" + id + "&warehouse_id=" + warehouse_id + "&rec_id=" + rec_id + "&txtemailcc=" + tmp_element3 + "&txtemailsubject=" + encodeURIComponent(tmp_element4)+ "&hidden_sendemail=inemailmode&txtemailbody=" + encodeURIComponent(emailtext) , true);
         
         	xmlhttp.send();
         
         	
         
         }
         
            //
         
         /*Special order update function*/
         
            function update_so_note(ctrlnm, rec_id, empid){
         
         	/*var selectobject = document.getElementById("complete_so"+ctrlnm); 
         
         	var n_left = f_getPosition(selectobject, 'Left');
         
         	var n_top  = f_getPosition(selectobject, 'Top');*/
         
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
         text-align: center;
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
         .white_content_dd {
         display: none;
         position: absolute;
         top: 10%;
         left: 10%;
         width: 70%;
         height: 85%;
         padding: 16px;
         border: 1px solid gray;
         background-color: white;
         z-index:1002;
         overflow: auto;
         box-shadow: 8px 8px 5px #888888;
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
      
       
      
      function undodelivery(trailerno, recid, dockno) {
      
      	var answer = confirm("Do you wish to Undo the Confirm Delivery of Trailer #"+trailerno+"?")
      
      	if (answer){
      
      		window.location = "<?php echo hktranswarehousepage()?>?action=undodelivery&conf_id="+recid+"&trailer_no="+trailerno+"&dock="+dockno;
      
      	}
      
      	else{
      
      		alert("Request Cancelled");
      
      	}
      
      }
      
      
      
      
      
      function undorecycling(trailerno, recid, dockno) {
      
      	var answer = confirm("Do you wish to Undo the RECYCLING Flag of Trailer #"+trailerno+"?")
      
      	if (answer){
      
      		window.location = "<?php echo hktranswarehousepage()?>?action=undorecycling&conf_id="+recid+"&trailer_no="+trailerno+"&dock="+dockno;
      
      	}
      
      	else{
      
      		alert("Request Cancelled");
      
      	}
      
      }
      
      
      
      function undoucblot(trailerno, recid, dockno) {
      
      	var answer = confirm("Do you wish to Undo the UCBLot Flag of Trailer #"+trailerno+"?")
      
      	if (answer){
      
      		window.location = "<?php echo hktranswarehousepage()?>?action=undoucblot&conf_id="+recid+"&trailer_no="+trailerno+"&dock="+dockno;
      
      	}
      
      	else{
      
      		alert("Request Cancelled");
      
      	}
      
      } 
      
   </script>
   <body onload="JavaScript:timedRefresh(1200000);">
      <div id="light_dd" class="white_content_dd"></div>
      <?php
         if (isset($_REQUEST["btnqtyofkitship"])){
         
         	$rec_found = "no"; $unqid = 0;
         
         	$query4 = "SELECT * FROM orders_by_warehouse_eod where warehouse_name = '" . $_REQUEST["hd_warehouse"] . "' and eod_date = '" . date("Y-m-d") . "'";
			
			db();
         	$dt_view_res4 = db_query($query4);
         
         	while ($objQuote4= array_shift($dt_view_res4)) 
         
         	{
         
         		$rec_found = "yes";
         
         		$unqid = $objQuote4["unqid"];
         
         	}
         
         	
         
         	$count_shipped = 0; $count_pending_ship = 0;
         
         
         
         	$warehouse_name = "";
         
         	if ($_REQUEST["hd_warehouse"] == "hk"){
         
         		$warehouse_name = "HK Trans";
         
         		$sql_pc = "SELECT * FROM `orders_active_ucb_los_angeles` inner join orders on orders.orders_id = orders_active_ucb_los_angeles.orders_id WHERE ship_status LIKE 'Y' and DATE_FORMAT(date_purchased, '%Y-%m-%d') = '" . date("Y-m-d") . "'";
				
				db();
         		$result_pc = db_query($sql_pc);
         
         		$count_shipped = tep_db_num_rows($result_pc);
         
         		
         
         		$sql_pc = "SELECT * FROM `orders_active_ucb_los_angeles` where ship_status LIKE 'N'";
				
				db();
         		$result_pc = db_query($sql_pc);
         
         		$count_pending_ship = tep_db_num_rows($result_pc);
         
         	}
         
         
         
         	$message = "Following are the EOD details:<br><br>";
         
         	$message .= "Warehouse name: " . $warehouse_name . "<br>";
         
         	if ($count_pending_ship > 0){
         
         		$message .= "Labels to be Printed: <font color=red>" . $count_pending_ship . "(NOT ALL LABELS PRINTED BY EOD) </font><br>";
         
         		echo "<script>";
         
         		echo "alert('NOT ALL LABELS PRINTED BY EOD');";
         
         		echo "</script>";
         
         	}else{	
         
         		$message .= "Labels to be Printed: " . $count_pending_ship . "<br>";
         
         	}	
         
         	$message .= "No. of Qty of Kits Shipped (as per database): " . $count_shipped . "<br>";
         
         	if ($count_shipped != $_REQUEST["qtyofkitship"]){
         
         		$message .= "No. of Qty of Kits Shipped (as per EOD entry): <font color=red>" . $_REQUEST["qtyofkitship"] . "(QTY SHIPPED DIFFERENT FROM QTY PRINTED)</font><br>";
         
         		echo "<script>";
         
         		echo "alert('QTY SHIPPED DIFFERENT FROM QTY PRINTED');";
         
         		echo "</script>";
         
         	}else{
         
         		$message .= "No. of Qty of Kits Shipped (as per EOD entry): " . $_REQUEST["qtyofkitship"] . "<br>";
         
         	}	
         
         	$message .= "Date: " . date("Y-m-d H:i:s") . " CT<br>";
         
         	$message .= "Initials: " . $_COOKIE["userinitials"] . "<br>";
         
         	
         
         	$mailheaders = "From: Loops System <admin@usedcardboardboxes.com>\n";
         
         	$mailheaders.= "MIME-Version: 1.0\r\n";
         
         	$mailheaders.= "Content-Type: text/html; charset=ISO-8859-1\r\n";
         
         	$resp = sendemail_php_function(null, '', "customerservice@UsedCardboardBoxes.com", "", "", "ucbemail@usedcardboardboxes.com", "Loops Usedcardboardboxes", "admin@usedcardboardboxes.com", "B2C End of Day status - " . $warehouse_name, $message); 
         
         	if ($rec_found == "yes"){
         
         		$sql = "UPDATE orders_by_warehouse_eod SET eod_date = '" . date("Y-m-d") . "', warehouse_name = '" . $warehouse_name . "', no_of_kits_shipped = '" . $_REQUEST["qtyofkitship"] . "', eod_entry_date = '" . date("Y-m-d H:i:s") . "', eod_entry_done_by = '" . $_COOKIE['userinitials'] . "'	where unqid = '" . $unqid . "'";
				
				db();
         		$result = db_query($sql);
         
         	}else{
         
         		$sql = "Insert into orders_by_warehouse_eod (eod_date, warehouse_name, no_of_kits_shipped, eod_entry_date, eod_entry_done_by) values('" . date("Y-m-d") . "', '" . $warehouse_name . "', '" . $_REQUEST["qtyofkitship"] . "', '" . date("Y-m-d H:i:s") . "', '" . $_COOKIE['userinitials'] . "')";
         
				db();
         		$result = db_query($sql);
         
         	}	
         
         }
         
         
         if ($_REQUEST["action"] == "confirm")
         
         {
         
         	$str_email="<html><head></head><body bgcolor=\"#E7F5C2\"><table align=\"center\" cellpadding=\"0\"><tr><td><p align=\"center\"><a href=\"http://www.usedcardboardboxes.com/index.php\"><img width=\"650\" height=\"166\" src=\"https://loops.usedcardboardboxes.com/images/ucb-banner1.jpg\"></a></p></td></tr><tr><td><p align=\"left\"><font face=\"arial\" size=\"2\">";
         
         	$str_email.= "Dear UsedCardboardBoxes.com,<br><br>This email is to confirm delivery of Trailer # " . $_REQUEST["trailer_no"] . ". Details below:<br><br>";
         
         	$str_email.= "Dock #:  <b>".$_REQUEST["dock"]."</b> <br>";
         
         	$str_email.= "Trailer #:  <b>".$_REQUEST["trailer_no"]."</b> <br><br>";
         
         	$str_email.= "Delivered to:<br><b>Used Cardboard Boxes<br>2011 S. Highway 61<br>Hannibal, MO 63401</b><br>";	
         
         	$str_email.= "Best Regards<br>";
         
         	$str_email.= "UsedCardboardBoxes.com<br>";
         
         	$str_email.= "</font></td></tr><tr><td><p align=\"center\"><img width=\"650\" height=\"87\" src=\"https://loops.usedcardboardboxes.com/images/ucb-footer1.jpg\"></p></td></tr></table></body></html>";
         
         
         
         	$recipient = "davidkrasnow@usedcardboardboxes.com, martymetro@usedcardboardboxes.com";
         
         	$subject = "Notification: Trailer Delivered to UCB - Clubhouse Rd";
         
         	$mailheadersadmin = "From: UsedCardboardBoxes.com <operations@UsedCardboardBoxes.com>\n";
         
         	$mailheadersadmin.= "MIME-Version: 1.0\r\n";
         
         	$mailheadersadmin.= "Content-Type: text/html; charset=ISO-8859-1\r\n";
         
         
         
         	$resp = sendemail_php_function(null, '', $recipient, "", "", "ucbemail@usedcardboardboxes.com", "Operations Usedcardboardboxes", "operations@UsedCardboardBoxes.com", $subject, $str_email); 
         
         
         
         	$sql3ud = "UPDATE loop_transaction SET pa_warehouse = '1115', bol_file = 'No BOL', bol_employee = 'UCB-HK', bol_date = '".date("m/d/Y")."', pa_pickupdate = '".date("m/d/Y")."' WHERE id = '". $_REQUEST["conf_id"] . "'";
			
			db();
         	$result3ud = db_query($sql3ud);
         
         	$sql3ud = "UPDATE loop_transaction SET cp_notes = 'Delivery Confirmed via Warehouse Dashboard', cp_employee = 'UCB-HK', cp_date = '".date("m/d/Y")."' WHERE id = '". $_REQUEST["conf_id"] . "'";
			
			db();
         	$result3ud = db_query($sql3ud);
         
         	$ucbunloaded_note="Entered via warehouse[HK] dashboard";
         
         	$sql3ud = "UPDATE loop_transaction SET ucbunloaded_flg = 1, ucbunloaded_note = '".$ucbunloaded_note."', ucbunloaded_by= '" . $_COOKIE['userinitials'] . "', ucbunloaded_dt = '" . date("Y-m-d H:i:s") . "' WHERE id = '". $_REQUEST["conf_id"] . "'";
			
			db();
         	$result3ud = db_query($sql3ud);
         
         	hktranswarehousepage() ;
         
         }
         
         
         
         if ($_REQUEST["action"] == "undodelivery")
         
         {
         
         	//pa_warehouse = '',	
         
         	$sql3ud = "UPDATE loop_transaction SET  bol_file = '', ucbunloaded_flg = 0, bol_employee = '', bol_date = '', pa_pickupdate = '', cp_notes = '', cp_employee = '', cp_date = '' WHERE id = '". $_REQUEST["conf_id"] . "'";
			
			db();
         	$result3ud = db_query($sql3ud);
         
         	$sql3ud = "UPDATE loop_transaction SET pr_recycling = 0, mark_as_recycling_by = '', mark_as_recycling_on = '' WHERE id = '". $_REQUEST["conf_id"] . "'";
			
			db();
         	$result3ud = db_query($sql3ud);
         
         
         	$sql3ud = "UPDATE loop_transaction SET pr_ucblot = 0, srt_dockdoors_flg = 0, srt_dock_doors = '' , srt_ucbdockdoor_note = '', srt_ucbdockdoor_by = '' WHERE id = '". $_REQUEST["conf_id"] . "'";
			
			db();
         	$result3ud = db_query($sql3ud);
         
         
         	hktranswarehousepage() ;
         
         }
         
         if ($_REQUEST["action"] == "undorecycling")
         {
         
         	$sql3ud = "UPDATE loop_transaction SET pr_recycling = 0, mark_as_recycling_by = '', mark_as_recycling_on = ''  WHERE id = '". $_REQUEST["conf_id"] . "'";
			
			db();
         	$result3ud = db_query($sql3ud);
         
         	hktranswarehousepage() ;
         
         }
         
         
         
         
         
         if ($_REQUEST["action"] == "recycling")
         
         {
         
         
         
         
         
         	$sql3ud = "UPDATE loop_transaction SET pr_recycling = 1, pa_warehouse = 1115, mark_as_recycling = '1', mark_as_recycling_by = '".$_COOKIE['employeeid']."', mark_as_recycling_on ='".date("Y-m-d H:i:s")."' WHERE id = '". $_REQUEST["conf_id"] . "'";
			
			db();
         	$result3ud = db_query($sql3ud);
         
         	hktranswarehousepage() ;
         
         
         
         }
         
         
         
         if ($_REQUEST["action"] == "undoucblot")
         
         {
         
         	//pa_warehouse = '',
         
         	$sql3ud = "UPDATE loop_transaction SET pr_ucblot = 0,  pr_ucblot_note='', pr_ucblot_by='' WHERE id = '". $_REQUEST["conf_id"] . "'";
            
			db();
         	$result3ud = db_query($sql3ud);
         
         	hktranswarehousepage() ;
         
         }
         
         
         
         if ($_REQUEST["action"] == "ucblot")
         
         {
         
         	$ucblot_dt=date("Y-m-d H:i:s");
         
         	$pr_ucblot_note = "Entered via warehouse [HK] dashboard";
         
         	//
         
         	$sql3ud = "UPDATE loop_transaction SET pr_ucblot = 1, pa_warehouse = 1115, pr_ucblot_by='".$_COOKIE['userinitials']."', pr_ucblot_dt='".$ucblot_dt."' , pr_ucblot_note='".$pr_ucblot_note."' WHERE id = '". $_REQUEST["conf_id"] . "'";
            
			db();
         	$result3ud = db_query($sql3ud);
         
         	hktranswarehousepage() ;
         
         }
         
         if($_REQUEST["action"] == "undoucbdockdoor")
         {
         
         	$sql3ud = "UPDATE loop_transaction SET srt_dockdoors_flg = 0, srt_dock_doors = '' , srt_ucbdockdoor_note = '', srt_ucbdockdoor_by = '' WHERE id = '". $_REQUEST["conf_id"] . "'";
            
			db();
         	$result3ud = db_query($sql3ud);
         
         	hktranswarehousepage();
         
         }
         
         if ($_REQUEST["action"] == "ucbunloaded")
         
         {
         
         	$ucbunloaded_note="Entered from warehouse[HK] dashboard";
         
         	$sql3ud = "UPDATE loop_transaction SET ucbunloaded_flg = 1, ucbunloaded_note = '".$ucbunloaded_note."', ucbunloaded_by= '" . $_COOKIE['userinitials'] . "', ucbunloaded_dt = '" . date("Y-m-d H:i:s") . "' WHERE id = '". $_REQUEST["conf_id"] . "'";
            
			db();
         	$result3ud = db_query($sql3ud);
         
         	hktranswarehousepage();
         
         }
         
         
         
         
         
         echo "<script type=\"text/javascript\">";
         
         echo "function display_preoder() {";
         
         echo " var totcnt = document.getElementById('inventory_preord_totctl').value;";
         
         
         
         echo " for (var tmpcnt = 1; tmpcnt < totcnt; tmpcnt++) {";
         
         echo " if (document.getElementById('inventory_preord_top_' + tmpcnt).style.display == 'table-row') ";
         
         echo " { document.getElementById('inventory_preord_top_' + tmpcnt).style.display='none'; } else {";
         
         echo "  document.getElementById('inventory_preord_top_' + tmpcnt).style.display='table-row'; } ";
         
         
         
         echo " if (document.getElementById('inventory_preord_top2_' + tmpcnt).style.display == 'table-row') ";
         
         echo " { document.getElementById('inventory_preord_top2_' + tmpcnt).style.display='none'; } else {";
         
         echo "  document.getElementById('inventory_preord_top2_' + tmpcnt).style.display='table-row'; } ";
         
         
         
         echo " if (document.getElementById('inventory_preord_bottom_' + tmpcnt).style.display == 'table-row') ";
         
         echo " { document.getElementById('inventory_preord_bottom_' + tmpcnt).style.display='none'; } else {";
         
         echo "  document.getElementById('inventory_preord_bottom_' + tmpcnt).style.display='table-row'; } ";
         
         
         
         echo " var totcnt_child = document.getElementById('inventory_preord_bottom_hd'+ tmpcnt).value;";
         
         
         
         echo " for (var tmpcnt_n = 1; tmpcnt_n < totcnt_child; tmpcnt_n++) {";
         
         echo " if (document.getElementById('inventory_preord_' + tmpcnt + '_' + tmpcnt_n).style.display == 'table-row') ";
         
         echo " { document.getElementById('inventory_preord_' + tmpcnt + '_' + tmpcnt_n).style.display='none'; } else {";
         
         echo "  document.getElementById('inventory_preord_' + tmpcnt + '_' + tmpcnt_n).style.display='table-row'; } ";
         
         echo "}";
         
         
         
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
               <b><i>UCB - HK Trans LLC</i></b>
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
      <br>
      <?php
         $wh_name="HK";
         
         ?>
      <table>
         <tr>
            <td colSpan="2" valign="top">
               <!--------------- REQUESTED TABLE ---------------->
               <table cellSpacing="1" cellPadding="1" border="0" width="700px;">
                  <tr align="middle">
                     <td colSpan="10" class="style7">
                        <b>Inbound Trailers: Requested, Not Delivered</b>
                     </td>
                  </tr>
                  <tr>
                     <td style="width:75" class="style17" align="center">
                        <b>DATE REQUEST</b>
                     </td>
                     <td style="width: 75" class="style17" align="center">
                        <b>TRANS #</b>
                     </td>
                     <td style="width: 75" class="style17" align="center">
                        <b>TRAILER #</b>
                     </td>
                     <td class="style5" align="center">
                        <b>SUPPLIER DOCK</b>
                     </td>
                     <td class="style5" align="center">
                        <b>BOL</b>
                     </td>
                     <td style="width:100" valign="middle" class="style16" align="center">
                        <b>REQUESTED BY</b>
                     </td>
                     <td style="width:300" valign="middle" class="style16" align="center">
                        <b> COMPANY </b>
                     </td>
                     <td valign="middle" class="style16" align="center">
                        <b>CONFIRM DELIVERY TO DOCK</b>
                     </td>
                     <td valign="middle" class="style16" align="center">
                        <b>CONFIRM DELIVERY TO LOT</b>
                     </td>
                     <td valign="middle" class="style16" align="center">
                        <b>SENT TO RECYCLING</b>
                     </td>
                  </tr>
                  <?php
                   
                     $query = "Insert into loop_mcc_dash_tobeprc (rec_id, pr_requestby, pr_requestdate, pr_pickupdate, pr_dock, pr_trailer, pa_employee, bol_filename, company_name, wid) ";
                     
                     $query .= "SELECT loop_transaction.id, pr_requestby, pr_requestdate, pr_pickupdate, pr_dock, pr_trailer, pa_employee, bol_filename, company_name, loop_warehouse.id as wid FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE warehouse_id IN ( $IN_LIST) AND bol_employee LIKE '' AND loop_transaction.pa_warehouse ='' AND pr_recycling = 0 and srt_dockdoors_flg=0 and pr_ucblot = 0 and loop_transaction.ignore = 0";
                     
					 db();
                     db_query($query);
                     
                     $query = "SELECT *, loop_transaction.id AS A, loop_warehouse.id as wid FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE loop_transaction.pa_warehouse = 1115 and loop_transaction.cp_notes = '' AND bol_employee LIKE ''  AND pr_recycling = 0 and pr_ucblot = 0 and srt_dockdoors_flg=0 and loop_transaction.ignore = 0 ORDER BY loop_transaction.ID ASC";
                     
					 db();
                     $res = db_query($query);
                     
                     while($row = array_shift($res))
                     
                     {
                     
                     	$res_rechk = db_query("Select rec_id from loop_mcc_dash_tobeprc where rec_id = '" . $row["A"] . "'" );
                     
                     	$rechk = "no";
                     
                     	while($row_rechk = array_shift($res_rechk))
                     
                     	{	
                     
                     		$rechk = "yes";
                     
                     	}
                     
                     	if ($rechk == "no"){
                     
                     		$query = "Insert into loop_mcc_dash_tobeprc (rec_id, pr_requestby, pr_requestdate, pr_pickupdate, pr_dock, pr_trailer, pa_employee, bol_filename, company_name, wid) ";
                     
                     		$query .= "SELECT '" . $row["A"] . "', '" . str_replace("'", "\'" , $row["pr_requestby"]) . "', '" . str_replace("'", "\'" , $row["pr_requestdate"]) . "', '" . str_replace("'", "\'" ,$row["pr_pickupdate"]) . "', '" . str_replace("'", "\'" , $row["pr_dock"]) . "', '" . str_replace("'", "\'" , $row["pr_trailer"]) . "', '" . str_replace("'", "\'" , $row["pa_employee"]) . "', '" . str_replace("'", "\'" , $row["bol_filename"]) . "', '" . $row["company_name"] . "', '" . $row["wid"] . "'";
                     
                     		db();
                     		db_query($query);
                     
                     	}
                     
                     }
                     
                     
                     
                     $query = "Select * from loop_mcc_dash_tobeprc order by rec_id asc";
                     
					 db();
                     $res = db_query($query);
                     
                     while($row = array_shift($res))
                     
                     {
                     
                     	$b2bid = 0;
                     
                     	$query1 = "Select b2bid from loop_warehouse where id = '" . $row["wid"] . "'";
                         
						db();
                     	$res1 = db_query($query1);
                     
                     	while($row1 = array_shift($res1))
                     
                     	{
                     
                     		$b2bid = $row1["b2bid"];
                     
                     	}
                     
                     	
                     
                     	//
                     
                     		$today=strtotime(date("m/d/Y"));
                     
                     		$request_date=strtotime($row["pr_requestdate"]);
                     
                     		$diff=($today - $request_date)/60/60/24;
                     
                     		//echo $diff."<br>";
                     
                     		
                     
                     		if($diff>5)
                     
                     		{
                     
                     			$tablerow_color="#f5dddc";
                     
                     		}
                     
                     		elseif($diff==5)
                     
                     		{
                     
                     			$tablerow_color="#FFFF99";
                     
                     		}
                     
                     		elseif($diff<5)
                     
                     		{
                     
                     			$tablerow_color="#e4e4e4";
                     
                     		}
                     
                     	//echo $bs_days."<br>";
                     
                     	//
                     
                     	
                     
                     	?>
                  <tr vAlign="center">
                     <td bgColor="<?php echo $tablerow_color?>" class="style3"  align="center">	
                        <?php echo date('m-d-Y', strtotime($row["pr_requestdate"])); ?>
                     </td>
                     <td bgColor="<?php echo $tablerow_color?>" class="style3"  align="center">	
                        <?php echo $row["rec_id"]; ?>
                     </td>
                     <td bgColor="<?php echo $tablerow_color?>" class="style3"  align="center">	
                        <?php echo $row["pr_trailer"]; ?>
                     </td>
                     <td bgColor="<?php echo $tablerow_color?>" class="style3"  align="center">	
                        <?php echo $row["pr_dock"]; ?>
                     </td>
                     <td bgColor="<?php echo $tablerow_color?>" class="style3"  align="center">
                        <?php
                           if ($row["bol_filename"] != "") { ?>
                        <div style="cursor: pointer;" onclick="display_file('files/<?php echo $row["bol_filename"];?>', 'BOL')"><font color="blue"><u>View BOL</u></font></div>
                        <?php } ?>
                     </td>
                     <td bgColor="<?php echo $tablerow_color?>" class="style3">	
                        <?php echo $row["pr_requestby"]; ?>
                     </td>
                     <td align="left" bgColor="<?php echo $tablerow_color?>" class="style3">	
                        <a target="_blank" href="viewCompany.php?ID=<?php echo $b2bid?>&show=transactions&warehouse_id=<?php echo $row["wid"]?>&rec_type=Manufacturer&proc=View&searchcrit=&id=<?php echo $row["wid"]?>&rec_id=<?php echo $row["rec_id"]?>&display=seller_view"><?php echo getnickname($row["company_name"], $row["wid"]); ?></a>
                     </td>
                     <td  align="center" bgColor="<?php echo $tablerow_color?>" class="style3">
                        <div id="dockdoor_<?php echo $row["rec_id"]?>">
                           <input type=button value="Delivered to DOCK" style="cursor:pointer;" onclick="fn_delivered_to_dock('<?php echo $row["pr_trailer"]; ?>','<?php echo $row["rec_id"]?>','false','<?php echo $wh_name; ?>')" >
                        </div>
					</td>
                     <td  align="center" bgColor="<?php echo $tablerow_color?>" class="style3">	
                        <input type=button value="Delivered to LOT" style="cursor:pointer;" onclick="confirmationUcblot('<?php echo $row["pr_trailer"]; ?>',<?php echo $row["rec_id"]?>,'<?php echo $row["pr_dock"]; ?>')" >
                     </td>
                     <td  align="center" bgColor="<?php echo $tablerow_color?>" class="style3">	
                        <input type=button value="Recycling" style="cursor:pointer;" onclick="confirmationRecycling('<?php echo $row["pr_trailer"]; ?>',<?php echo $row["rec_id"]?>,'<?php echo $row["pr_dock"]; ?>')" >
                     </td>
                  </tr>
                  <?php
                     }
                     
                     $query = "delete from loop_mcc_dash_tobeprc";
                      
					 db();
                     db_query($query);
                     
                     ?>
               </table>
               <br><Br>
               <?php
                  $query = "SELECT *, loop_transaction.id AS A FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE loop_transaction.ignore = 0 and pa_warehouse = 1115 and ((loop_transaction.cp_notes = '' AND pr_ucblot = 1 AND srt_dockdoors_flg=0 AND bol_employee LIKE '') or (srt_dockdoors_flg =1 AND ucbunloaded_flg=0) or (ucbunloaded_flg=1 AND (sort_entered = 0 or usr_file LIKE ''))) ORDER BY loop_transaction.ID ASC";
                  
				  db();
                  $res = db_query($query);
                  
                  while($rowflg=array_shift($res)){
                  
                  	//echo $rowflg["A"]."<br>";
                  
                  	//
                  
                  	$ucblot="01/01/1970"; $ucbdocdoor= "01/01/1970"; $ucbunloaded= "01/01/1970";
                  
                  	if ($rowflg["pr_ucblot_dt"] != "" && $rowflg["pr_ucblot_dt"] != "0000-00-00 00:00:00"){
                  
                  		$ucblot=date("m/d/Y", strtotime($rowflg["pr_ucblot_dt"]));
                  
                  	}	
                  
                  	if ($rowflg["srt_ucbdockdoor_dt"] != "" && $rowflg["srt_ucbdockdoor_dt"] != "0000-00-00 00:00:00"){
                  
                  		$ucbdocdoor=date("m/d/Y", strtotime($rowflg["srt_ucbdockdoor_dt"]));
                  
                  	}	
                  
                  	if ($rowflg["ucbunloaded_dt"] != "" && $rowflg["ucbunloaded_dt"] != "0000-00-00 00:00:00"){
                  
                  		$ucbunloaded=date("m/d/Y", strtotime($rowflg["ucbunloaded_dt"]));
                  
                  	}	
                  
                  	//
                  
                  	//echo $rowflg["A"]."=".$ucblot."--".$ucbdocdoor."--".$ucbunloaded."<br>";
                  
                  	//
                  
                  	if(($ucblot!="01/01/1970") && ($ucbdocdoor=="01/01/1970") && ($ucbunloaded=="01/01/1970")){
                  
                  		$oldestdate=$ucblot;
                  
                  	}
                  
                  	elseif(($ucblot=="01/01/1970") && ($ucbdocdoor!="01/01/1970") && ($ucbunloaded=="01/01/1970")){
                  
                  		$oldestdate=$ucbdocdoor;
                  
                  	}
                  
                  	elseif(($ucblot=="01/01/1970") && ($ucbdocdoor=="01/01/1970") && ($ucbunloaded!="01/01/1970")){
                  
                  		$oldestdate=$ucbunloaded;
                  
                  	}
                  
                  	elseif(($ucblot!="01/01/1970") && ($ucbdocdoor!="01/01/1970") && ($ucbunloaded=="01/01/1970")){
                  
                  		
                  
                  		$oldestdate1=strtotime($ucblot);
                  
                  		$oldestdate2=strtotime($ucbdocdoor);
                  
                  		if($oldestdate1<$oldestdate2){
                  
                  			$oldestdate=date("m/d/Y", strtotime($ucblot));
                  
                  		}
                  
                  		else{
                  
                  			$oldestdate=date("m/d/Y", strtotime($ucbdocdoor));
                  
                  		}
                  
                  	}
                  
                  	elseif(($ucblot!="01/01/1970" ) && ($ucbdocdoor=="01/01/1970") && ($ucbunloaded!="01/01/1970")){
                  
                  		
                  
                  		$oldestdate1=strtotime($ucblot);
                  
                  		$oldestdate2=strtotime($ucbunloaded);
                  
                  		if($oldestdate1<$oldestdate2){
                  
                  			$oldestdate=date("m/d/Y", strtotime($ucblot));
                  
                  		}
                  
                  		else{
                  
                  			$oldestdate=date("m/d/Y", strtotime($ucbunloaded));
                  
                  		}
                  
                  	}
                  
                  	elseif(($ucblot=="01/01/1970") && ($ucbdocdoor!="01/01/1970") && ($ucbunloaded!="01/01/1970")){
                  
                  		
                  
                  		$oldestdate1=strtotime($ucbdocdoor);
                  
                  		$oldestdate2=strtotime($ucbunloaded);
                  
                  		if($oldestdate1<$oldestdate2){
                  
                  			$oldestdate=date("m/d/Y", strtotime($ucbdocdoor));
                  
                  		}
                  
                  		else{
                  
                  			$oldestdate=date("m/d/Y", strtotime($ucbunloaded));
                  
                  		}
                  
                  	}
                  
                  	elseif(($ucblot!="01/01/1970") && ($ucbdocdoor!="01/01/1970") && ($ucbunloaded!="01/01/1970")){
                  
                  		$oldestdate1=strtotime($ucblot);
                  
                  		$oldestdate2=strtotime($ucbdocdoor);
                  
                  		$oldestdate3=strtotime($ucbunloaded);
                  
                  		$old_dt=min($oldestdate1, $oldestdate2, $oldestdate3);
                  
                  		$oldestdate=date("m/d/Y", $old_dt);
                  
                  	}
                  
                  	$oldest_date.=$oldestdate.",";
                  
                  	$trs_id.=$rowflg["A"].",";
                  
                  	//
                  
                  }
                  
                  $oldest_date=rtrim($oldest_date, ", ");
                  
                  $trns_id=rtrim($trs_id, ", ");
                  
                  
                  
                  //echo $trns_id . "<br>";
                  
                  //echo $oldest_date . "<br>";
                  
                  //
                  
                  ?>
               <!--------------- UCB Lot TABLE ---------------->
               <table cellSpacing="1" cellPadding="1" border="0" width="700px;">
                  <tr align="center">
                     <td colSpan="10" class="style7">
                        <b>Inbound Trailers: Delivered to Lot, Needs Put in Dock Door</b>
                     </td>
                  </tr>
                  <tr>
                     <td style="width:75" class="style17" align="center">
                        <b>DATE REQUEST</b>
                     </td>
                     <td style="width: 75" class="style17" align="center">
                        <b>TRANS #</b>
                     </td>
                     <td style="width: 100" class="style17" align="center">
                        <b>TRAILER #</b>
                     </td>
                     <td class="style5" align="center">
                        <b>SUPPLIER DOCK</b>
                     </td>
                     <td class="style5" align="center">
                        <b>BOL</b>
                     </td>
                     <td style="width:100" valign="middle" class="style16" align="center">
                        <b>REQUESTED BY</b>
                     </td>
                     <td style="width:300" valign="middle" class="style16" align="center">
                        <b>COMPANY</b>
                     </td>
                     <td valign="middle" class="style16" align="center">
                        <b>CONFIRM DELIVERY TO DOCK</b>
                     </td>
                     <td valign="middle" class="style16" align="center">
                        <b>UNDO</b>
                     </td>
                  </tr>
                  <?php
                     
                     $tablerow_color="";
                     
                     $query = "SELECT *, loop_transaction.id AS A FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE loop_transaction.ignore = 0 and pa_warehouse = 1115 and loop_transaction.cp_notes = '' AND pr_ucblot = 1 AND srt_dockdoors_flg=0 AND bol_employee LIKE '' ORDER BY loop_transaction.ID ASC";
                    
					 db();
                     $res = db_query($query);
                     
                     while($row = array_shift($res))
                     
                     {
                     
                     	
                     
                     	//$oldest_date
                     
                     	$date_arr=explode(",",$oldest_date);
                     
                     	$trns_arr=explode(",",$trns_id);
                     
                     		for($i=0; $i<count($trns_arr); $i++)
                     
                     		{
                     
                     			if($trns_arr[$i]==$row["A"])
                     
                     			{
                     
                     				if($date_arr[$i]!="")
                     
                     				{
                     
                     					$ucblot_dt = strtotime($date_arr[$i]);
                     
                     					$today=strtotime(date("m/d/Y"));
                     
                     					$diff=($today - $ucblot_dt)/60/60/24;
                     
                     					//echo $ucblot_dt . " = " . $diff."<br>";
                     
                     
                     
                     					if($diff>3)
                     
                     					{
                     
                     						$tablerow_color="#f5dddc";
                     
                     					}
                     
                     					elseif($diff==3)
                     
                     					{
                     
                     						$tablerow_color="#FFFF99";
                     
                     					}
                     
                     					elseif($diff<3)
                     
                     					{
                     
                     						$tablerow_color="#e4e4e4";
                     
                     					}
                     
                     				}
                     
                     			}
                     
                     		}
                     
                     	?>
                  <tr vAlign="center">
                     <td bgColor="<?php echo $tablerow_color?>" class="style3"  align="center">	
                        <?php echo date('m-d-Y', strtotime($row["pr_requestdate"])); ?>
                     </td>
                     <td bgColor="<?php echo $tablerow_color?>" class="style3"  align="center">	
                        <?php echo $row["A"]; ?>
                     </td>
                     <td bgColor="<?php echo $tablerow_color?>" class="style3"  align="center">	
                        <?php echo $row["pr_trailer"]; ?>
                     </td>
                     <td bgColor="<?php echo $tablerow_color?>" class="style3"  align="center">	
                        <?php echo $row["pr_dock"]; ?>
                     </td>
                     <td bgColor="<?php echo $tablerow_color?>" class="style3"  align="center">
                        <?php
                           if ($row["bol_filename"] != "") { ?>
                        <div style="cursor: pointer;" onclick="display_file('files/<?php echo $row["bol_filename"];?>', 'BOL')"><font color="blue"><u>View BOL</u></font></div>
                        <?php } ?>
                     </td>
                     <td bgColor="<?php echo $tablerow_color?>" class="style3">	
                        <?php echo $row["pr_requestby"]; ?>
                     </td>
                     <td align="left" bgColor="<?php echo $tablerow_color?>" class="style3">	
                        <a target="_blank" href="viewCompany.php?ID=<?php echo $row["b2bid"]?>&show=transactions&warehouse_id=<?php echo $row["warehouse_id"]?>&rec_type=Manufacturer&proc=View&searchcrit=&id=<?php echo $row["warehouse_id"]?>&rec_id=<?php echo $row["A"]?>&display=seller_view"><?php echo getnickname($row["company_name"], $row["warehouse_id"]); ?></a>
                     </td>
                     <td  align="center" bgColor="<?php echo $tablerow_color?>" class="style3">
                        <div id="dockdoor_<?php echo $row["A"]?>">
                           <input type=button value="Delivered to DOCK" style="cursor:pointer;" onclick="fn_delivered_to_dock('<?php echo $row["pr_trailer"]; ?>','<?php echo $row["A"]?>','false', '<?php echo $wh_name; ?>')" >
                        </div>
                    </td>
                     <td align="center" bgColor="<?php echo $tablerow_color?>" class="style3">	
                        <input type=button value="UnDo" style="cursor:pointer;" onclick="undoucblot('<?php echo $row["pr_trailer"]; ?>',<?php echo $row["A"]?>,'<?php echo $row["pr_dock"]; ?>')" >
                     </td>
                  </tr>
                  <?php
                     }
                     
                     ?>
               </table>
               <!--------------- END Recycling TABLE ---------------->
               <br><Br>
               <!--------------- RECYCLING TABLE ---------------->
               <table cellSpacing="1" cellPadding="1" border="0" width="700px;">
                  <tr align="middle">
                     <td colspan="10" class="style7">
                        <b>Inbound Trailers: Delivered Directly to Recycler, Pending Receipt and Sort Report</b>
                     </td>
                  </tr>
                  <tr>
                     <td style="width:75" class="style17" align="center">
                        <b>DATE REQUEST</b>
                     </td>
                     <td style="width: 75" class="style17" align="center">
                        <b>TRANS #</b>
                     </td>
                     <td style="width:75" class="style17" align="center">
                        <b>TRAILER #</b>
                     </td>
                     <td class="style5" align="center">
                        <b>SUPPLIER DOCK</b>
                     </td>
                     <td class="style5" align="center">
                        <b>BOL</b>
                     </td>
                     <td style="width:100" valign="middle" class="style16" align="center">
                        <b>REQUESTED BY</b>
                     </td>
                     <td style="width:300" valign="middle" class="style16" align="center">
                        <b> COMPANY </b>
                     </td>
                     <td valign="middle" class="style16" align="center">
                        <b>RECYCLER RECEIVED</b>
                     </td>
                     <td valign="middle" class="style16" align="center">
                        <b>UNDO</b>
                     </td>
                  </tr>
                  <?php
                     //and warehouse_id IN ( " . $IN_LIST . " )
                     
                     $query = "SELECT *, loop_transaction.id AS A FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE loop_transaction.ignore = 0 and pa_warehouse = 1115 and loop_transaction.cp_notes = ''  AND pr_recycling = 1 AND ucbunloaded_flg=0 AND bol_employee LIKE '' ORDER BY loop_transaction.ID ASC";
                     
					 db();
                     $res = db_query($query);
                     
                     while($row = array_shift($res))
                     
                     {
                     
                     		$today=strtotime(date("m/d/Y"));
                     
                     		$request_date=strtotime($row["pr_requestdate"]);
                     
                     		$diff=($today - $request_date)/60/60/24;
                     
                     		//echo $diff."<br>";
                     
                     		
                     
                     		if($diff>14)
                     
                     		{
                     
                     			$tablerow_color="#f5dddc";
                     
                     		}
                     
                     		elseif($diff==14)
                     
                     		{
                     
                     			$tablerow_color="#FFFF99";
                     
                     		}
                     
                     		elseif($diff<14)
                     
                     		{
                     
                     			$tablerow_color="#e4e4e4";
                     
                     		}
                     
                     	
                     
                     	?>
                  <tr vAlign="center">
                     <td bgColor="<?php echo $tablerow_color?>" class="style3"  align="center">	
                        <?php echo date('m-d-Y', strtotime($row["pr_requestdate"])); ?>
                     </td>
                     <td bgColor="<?php echo $tablerow_color?>" class="style3"  align="center">	
                        <?php echo $row["A"]; ?>
                     </td>
                     <td bgColor="<?php echo $tablerow_color?>" class="style3"  align="center">	
                        <?php echo $row["pr_trailer"]; ?>
                     </td>
                     <td bgColor="<?php echo $tablerow_color?>" class="style3"  align="center">	
                        <?php echo $row["pr_dock"]; ?>
                     </td>
                     <td bgColor="<?php echo $tablerow_color?>" class="style3"  align="center">
                        <?php
                           if ($row["bol_filename"] != "") { ?>
                        <div style="cursor: pointer;" onclick="display_file('files/<?php echo $row["bol_filename"];?>', 'BOL')"><font color="blue"><u>View BOL</u></font></div>
                        <?php } ?>
                     </td>
                     <td bgColor="<?php echo $tablerow_color?>" class="style3">	
                        <?php echo $row["pr_requestby"]; ?>
                     </td>
                     <td align="left" bgColor="<?php echo $tablerow_color?>" class="style3">	
                        <a target="_blank" href="viewCompany.php?ID=<?php echo $row["b2bid"]?>&show=transactions&warehouse_id=<?php echo $row["warehouse_id"]?>&rec_type=Manufacturer&proc=View&searchcrit=&id=<?php echo $row["warehouse_id"]?>&rec_id=<?php echo $row["A"]?>&display=seller_view"><?php echo getnickname($row["company_name"], $row["warehouse_id"]); ?></a>
                     </td>
                     <td  align="center" bgColor="<?php echo $tablerow_color?>" class="style3">	
                        <input type=button value="Delivered" style="cursor:pointer;" onclick="confirmationUnloaded('<?php echo $row["pr_trailer"]; ?>','<?php echo $row["A"]?>','<?php echo $row["pr_dock"]?>')" >
                     </td>
                     <td  align="center" bgColor="<?php echo $tablerow_color?>" class="style3">	
                        <input type=button value="UnDo" style="cursor:pointer;" onclick="undorecycling('<?php echo $row["pr_trailer"]; ?>',<?php echo $row["A"]?>,'<?php echo $row["pr_dock"]; ?>')" >
                     </td>
                  </tr>
                  <?php
                     }
                     
                     
                     
                     ?>
               </table>
               <!--------------- END Recycling TABLE ---------------->
            </td>
            <!--------------- END REQUESTED TABLE ---------------->
            <td vAlign="top">
               <!--------------- BEGIN IN PROCESS TABLE ---------------->
               <!----------------New In DockDoor Table--------------->	
               <div id="indockdoor">
                  <table cellSpacing="1" cellPadding="1" border="0" width="700px;">
                     <tr align="middle">
                        <td colSpan="10" class="style7">
                           <b>Inbound Trailers: In Dock Door, Not Unloaded</b>
                        </td>
                     </tr>
                     <tr>
                        <td style="width:75" class="style17" align="center">
                           <b>UCB DOCK</b>
                        </td>
                        <td style="width:75" class="style17" align="center">
                           <b>DATE REQUEST</b>
                        </td>
                        <td style="width: 75" class="style17" align="center">
                           <b>TRANS #</b>
                        </td>
                        <td style="width: 100" class="style17" align="center">
                           <b>TRAILER #</b>
                        </td>
                        <td class="style5" align="center">
                           <b>SUPPLIER DOCK</b>
                        </td>
                        <td class="style5" align="center">
                           <b>BOL</b>
                        </td>
                        <td style="width:300" valign="middle" class="style16" align="center">
                           <b> COMPANY </b>
                        </td>
                        <td valign="middle" class="style16" align="center">
                           <b>PRINT SORT REPORT</b>
                        </td>
                        <td valign="middle" class="style16" align="center">
                           <b>CONFIRM UNLOADED</b>
                        </td>
                        <td valign="middle" class="style16" align="center">
                           <b>UNDO</b>
                        </td>
                     </tr>
                     <?php
                        $query = "SELECT *, loop_warehouse.warehouse_name AS CN, loop_warehouse.id as wid , loop_transaction.id AS LTID FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE (pa_warehouse = 1115) and srt_dockdoors_flg =1 AND ucbunloaded_flg=0 and loop_transaction.ignore = 0 ORDER BY loop_transaction.ID ASC";
                        
						db();
                        $res = db_query($query);
                        
                        while($row = array_shift($res))
                        
                        {
                        
                        	$rec_id=$row["LTID"];
                        
                        	$b2bid = 0;
                        
                        	$query1 = "Select b2bid from loop_warehouse where id = '" . $row["wid"] . "'";
                            
							db();
                        	$res1 = db_query($query1);
                        
                        	while($row1 = array_shift($res1))
                        
                        	{
                        
                        		$b2bid = $row1["b2bid"];
                        
                        	}
                        
                        	
                        
                        	//
                        
                        	$date_arr=explode(",",$oldest_date);
                        
                        	$trns_arr=explode(",",$trns_id);
                        
                        		for($i=0; $i<count($trns_arr); $i++)
                        
                        		{
                        
                        			if($trns_arr[$i]==$row["LTID"])
                        
                        			{
                        
                        				if($date_arr[$i]!="")
                        
                        				{
                        
                        					$ucblot_dt = strtotime($date_arr[$i]);
                        
                        					$today=strtotime(date("m/d/Y"));
                        
                        					$diff=($today - $ucblot_dt)/60/60/24;
                        
                        					//echo $diff."<br>";
                        
                        
                        
                        					if($diff>3)
                        
                        					{
                        
                        						$tablerow_color="#f5dddc";
                        
                        					}
                        
                        					elseif($diff==3)
                        
                        					{
                        
                        						$tablerow_color="#FFFF99";
                        
                        					}
                        
                        					elseif($diff<3)
                        
                        					{
                        
                        						$tablerow_color="#e4e4e4";
                        
                        					}
                        
                        				}
                        
                        			}
                        
                        		}
                        
                        	?>
                     <tr align="center">
                        <td bgColor="<?php echo $tablerow_color?>" class="style3"  align="center">
                           <?php echo $row["srt_dock_doors"]; ?>
                           <br>
                           <div id="dockdoor_<?php echo $row["LTID"]?>">
                              <a href="#" onClick="fn_delivered_to_dock('<?php echo $row["pr_trailer"]; ?>','<?php echo $row["LTID"]?>','true','<?php echo $wh_name; ?>')" >
                              Edit
                              </a>
                           </div>
                        </td>
                        <td bgColor="<?php echo $tablerow_color?>" class="style3"  align="center">	
                           <?php echo date('m-d-Y', strtotime($row["pr_requestdate"])); ?>
                        </td>
                        <td bgColor="<?php echo $tablerow_color?>" class="style3"  align="center">	
                           <?php echo $row["LTID"]; ?>
                        </td>
                        <td bgColor="<?php echo $tablerow_color?>" class="style3"  align="center">	
                           <?php echo $row["pr_trailer"]; ?>
                        </td>
                        <td bgColor="<?php echo $tablerow_color?>" class="style3"  align="center">	
                           <?php echo $row["pr_dock"]; ?>
                        </td>
                        <td bgColor="<?php echo $tablerow_color?>" class="style3"  align="center">
                           <?php
                              if ($row["bol_filename"] != "") { ?>
                           <div style="cursor: pointer;" onclick="display_file('files/<?php echo $row["bol_filename"];?>', 'BOL')"><font color="blue"><u>View BOL</u></font></div>
                           <?php } ?>
                        </td>
                        <td align="left" bgColor="<?php echo $tablerow_color?>" class="style3">	
                           <a target="_blank" href="viewCompany.php?ID=<?php echo $b2bid?>&show=transactions&warehouse_id=<?php echo $row["wid"]?>&rec_type=Manufacturer&proc=View&searchcrit=&id=<?php echo $row["wid"]?>&rec_id=<?php echo $rec_id?>&display=seller_view"><?php echo getnickname($row["company_name"], $row["wid"]); ?></a>
                        </td>
                        <td bgColor="<?php echo $tablerow_color?>" class="style3">				
                           <?php if ($row["manulasortrep_print"] == "Y") { ?>					
                           <input style="cursor:pointer;" type="button" value="Re-Print Report" onClick="printsortrep('<?php echo $row["LTID"] ?>' , '<?php echo $row["manulasortrep_print"]; ?>')"><?php } else {?><input type="button" value="Print Report" onClick="printsortrep('<?php echo $row["LTID"] ?>' , '<?php echo $row["manulasortrep_print"]; ?>')">
                           <?php }?>			
                        </td>
                        <td  align="center" bgColor="<?php echo $tablerow_color?>" class="style3">	
                           <input type=button value="UNLOADED" id="btnDelivered<?php echo $rec_id?>" style="cursor:pointer;" onclick="confirmationUnloaded_new('<?php echo $row["pr_trailer"]; ?>','<?php echo $rec_id?>','<?php echo $row["pr_dock"]?>','1115')" >
                        </td>
                        <td align="center" bgColor="<?php echo $tablerow_color?>" class="style3">	
                           <input type=button value="UnDo" style="cursor:pointer;" onclick="undoucbdockdoor('<?php echo $row["pr_trailer"]; ?>','<?php echo $rec_id?>')" >
                        </td>
                     </tr>
                     <?php
                        }
                        
                        		//
                        
                        ?>
                  </table>
               </div>
               <!---------------End New In DockDoor Table------------>	
               <br><br>	
               <table cellSpacing="1" cellPadding="1" border="0" width="700px;">
                  <tr align="middle">
                     <td colSpan="10" class="style7">
                        <b>Inbound Trailers: Unloaded, Not Processed (Sorted or Entered)</b>
                     </td>
                  </tr>
                  <tr>
                     <td style="width: 75" class="style17" align="center">
                        <b>Area Unloaded</b>
                     </td>
                     <td style="width: 75" class="style17" align="center">
                        <b>DATE REQUEST</b>
                     </td>
                     <td style="width: 75" class="style17" align="center">
                        <b>TRANS #</b>
                     </td>
                     <td style="width: 75" class="style17" align="center">
                        <b>TRAILER #</b>
                     </td>
                     <td class="style5" align="center">
                        <b>SUPPLIER DOCK</b>
                     </td>
                     <td class="style5" align="center">
                        <b>BOL</b>
                     </td>
                     <td style="width: 350" class="style16" align="center">
                        <b>COMPANY</b>
                     </td>
                     <td style="width: 100" class="style16" align="center">
                        <b>PRINT SORT REPORT</b>
                     </td>
                     <td valign="middle" style="width: 100" class="style16" align="center">
                        <b>ENTER SORT REPORT</b>
                     </td>
                     <td valign="middle" style="width: 100" class="style16" align="center">
                        <b>UNDO</b>
                     </td>
                  </tr>
                  <script LANGUAGE="JavaScript">function printsortrep(id, printstatus) {	if (printstatus == "Y")	{		var answer = confirm("Report already printed. Do you wish to re-print?");		if (answer){			window.location = "sortreport2.php?rec_id=" + id ;		}	}else{						window.location = "sortreport2.php?rec_id=" + id ;	}}function PrintPickListRep(id, printstatus) {	if (printstatus == "Y")	{		var answer = confirm("Report already printed. Do you wish to re-print?");		if (answer){			window.location = "picklist.php?rec_id=" + id ;		}	}else{						window.location = "picklist.php?rec_id=" + id ;	}}
                     function PrintPickListRep_so(id, printstatus) {	if (printstatus == "Y")	{		var answer = confirm("Report already printed. Do you wish to re-print?");		if (answer){			window.location = "picklist.php?rec_id=" + id ;		}	}else{						window.location = "picklist.php?rec_id=" + id ;	}}
                     
                     
                     
                  </script>
                  <?php
                     $query = "SELECT *, loop_warehouse.warehouse_name AS CN, loop_transaction.id AS LTID FROM loop_transaction INNER JOIN loop_warehouse ON loop_transaction.warehouse_id = loop_warehouse.id WHERE loop_transaction.ignore = 0 and (pa_warehouse = 1115) and pa_pickupdate <> '' and cp_date <> '' AND ucbunloaded_flg=1 AND (sort_entered = 0 or usr_file LIKE '') AND transaction_date > '2010-10-28' ORDER BY loop_transaction.ID ASC";
                     
					 db();
                     $res = db_query($query);
                     
                     while($row = array_shift($res))
                     {
                     
                     	$date_arr=explode(",",$oldest_date);
                     
                     	$trns_arr=explode(",",$trns_id);
                     
                     		for($i=0; $i<count($trns_arr); $i++)
                     
                     		{
                     
                     			if($trns_arr[$i]==$row["LTID"])
                     
                     			{
                     
                     				//echo $trns_arr[$i];
                     
                     				if($date_arr[$i]!="")
                     
                     				{
                     
                     					$ucblot_dt = strtotime($date_arr[$i]);
                     
                     					$today=strtotime(date("m/d/Y"));
                     
                     					$diff=($today - $ucblot_dt)/60/60/24;
                     
                     					//echo $diff."<br>";
                     
                     
                     
                     					if($diff>3)
                     
                     					{
                     
                     						$tablerow_color="#f5dddc";
                     
                     					}
                     
                     					elseif($diff==3)
                     
                     					{
                     
                     						$tablerow_color="#FFFF99";
                     
                     					}
                     
                     					elseif($diff<3)
                     
                     					{
                     
                     						$tablerow_color="#e4e4e4";
                     
                     					}
                     
                     				}
                     
                     			}
                     
                     		}	
                     
                     			
                     
                     	?>
                  <tr vAlign="center">
                     <td bgColor="<?php echo $tablerow_color?>" class="style3"  align="center">
                        <?php echo $row["area_unloaded"]; ?>
                     </td>
                     <td bgColor="<?php echo $tablerow_color?>" class="style3"  align="center">
                        <?php echo date('m-d-Y', strtotime($row["pr_requestdate"])); ?>
                     </td>
                     <td bgColor="<?php echo $tablerow_color?>" class="style3"  align="center">	
                        <?php echo $row["LTID"]; ?>
                     </td>
                     <td bgColor="<?php echo $tablerow_color?>" class="style3"  align="center">	
                        <?php echo $row["pr_trailer"]; ?>
                     </td>
                     <td bgColor="<?php echo $tablerow_color?>" class="style3"  align="center">
                        <?php echo $row["pr_dock"]; ?>
                     </td>
                     <td bgColor="<?php echo $tablerow_color?>" class="style3"  align="center">
                        <?php
                           if ($row["bol_filename"] != "") { ?>
                        <div style="cursor: pointer;" onclick="display_file('files/<?php echo $row["bol_filename"];?>', 'BOL')"><font color="blue"><u>View BOL</u></font></div>
                        <?php } ?>
                     </td>
                     <td bgColor="<?php echo $tablerow_color?>" class="style3">
                        <a target="_blank" href="viewCompany.php?ID=<?php echo $row["b2bid"]?>&show=transactions&warehouse_id=<?php echo $row["warehouse_id"]?>&rec_type=Manufacturer&proc=View&searchcrit=&id=<?php echo $row["warehouse_id"]?>&rec_id=<?php echo $row["LTID"]?>&display=seller_view"><?php echo getnickname($row["company_name"], $row["warehouse_id"]); ?></a>				
                     </td>
                     <!-- Added by Mooneem 07-14-12  -->			
                     <td bgColor="<?php echo $tablerow_color?>" class="style3">				
                        <?php if ($row["manulasortrep_print"] == "Y") { ?>					
                        <input style="cursor:pointer;"  type="button" value="Re-Print Report" onClick="printsortrep('<?php echo $row["LTID"] ?>' , '<?php echo $row["manulasortrep_print"]; ?>')">				
                        <?php } else {?>					
                        <input type="button" value="Print Report" onClick="printsortrep('<?php echo $row["LTID"] ?>' , '<?php echo $row["manulasortrep_print"]; ?>')">				
                        <?php }?>			
                     </td>
                     <!-- Added by Mooneem 07-14-12  -->
                     <td bgColor="<?php echo $tablerow_color?>" class="style3">
                        <INPUT style="cursor:pointer;" type="button" value="Enter Sort Report" onClick="window.open('viewCompany-purchasing.php?ID=<?php echo  $row["b2bid"]; ?>&show=transactions&warehouse_id=<?php echo  $row["warehouse_id"]; ?>&rec_type=Manufacturer&proc=View&searchcrit=&id=<?php echo  $row["warehouse_id"]; ?>&rec_id=<?php echo  $row["LTID"]; ?>&display=seller_sort')" > 
                        <!-- Email davidkrasnow@usedcardboardboxes.com -->
                     </td>
                     <td  align="center" bgColor="<?php echo $tablerow_color?>" class="style3">	
                        <input type=button value="UnDo" style="cursor:pointer;" onclick="undodelivery('<?php echo $row["pr_trailer"]; ?>',<?php echo $row["LTID"]?>,'<?php echo $row["pr_dock"]; ?>')" >
                     </td>
                  </tr>
                  <?php
                     }
                     
                     ?>
               </table>
               <!--------------- END IN PROCESS TABLE ---------------->
            </td>
         </tr>
      </table>
      <br><br>
      <table>
         <tr>
            <td valign="top">
               <table cellSpacing="1" cellPadding="1" border="0" width="700px;">
                  <tr align="middle">
                     <td class="style7" colSpan="6">
                        <b>Freight Booking</b>
                     </td>
                  </tr>
                  <tr>
                     <td class="style17" align="center" >
                        <b>Loop ID</b>
                     </td>
                     <td class="style17" align="center" >
                        <b>Type</b>
                     </td>
                     <td class="style17" align="center">
                        <b>Company Name</b>
                     </td>
                     <td class="style17" align="center">
                        <b>Date</b>
                     </td>
                     <td class="style17" align="center">
                        <b>Time</b>
                     </td>
                     <td class="style17" align="center">
                        <b>PRINT</b>
                     </td>
                  </tr>
                  <?php
                     $todays_dt = date("Y-m-d");
                     
                     $next_date = date('Y-m-d', strtotime($todays_dt. ' + 4 days'));
                     
                     db();
                     $res = db_query("DELETE FROM han_temp");
                     
                     $query = "SELECT loop_warehouse.warehouse_name AS warehousename,";
                     
                     $query.= " loop_transaction_buyer.warehouse_id AS wid , loop_transaction_buyer.id AS trid, loop_transaction_freight.*, ";
                     
                     $query.= " loop_transaction_buyer.picklist_print FROM loop_transaction_buyer";
                     
                     $query.= " INNER JOIN loop_warehouse ON loop_transaction_buyer.warehouse_id = loop_warehouse.id";
                     
                     $query.= " INNER JOIN loop_salesorders ON loop_transaction_buyer.id = loop_salesorders.trans_rec_id";
                     
                     $query.= " INNER JOIN loop_transaction_freight ON loop_transaction_buyer.id = loop_transaction_freight.trans_rec_id" ;
                     
                     $query.= " WHERE loop_transaction_buyer.so_entered = 1 and loop_transaction_buyer.shipped = 0 and loop_transaction_buyer.ignore = 0";
                     
                     $query.= " AND loop_transaction_buyer.bol_signed_uploaded = 0";
                     
                     $query.= " AND loop_transaction_buyer.id > 67 and location_warehouse_id = 1115";
                     
                     $query.= " and (loop_transaction_freight.date >='".$todays_dt."' and loop_transaction_freight.date <= '".$next_date."')";
                     
                     $query.= " group by trid order by loop_transaction_freight.date ASC";
                     
                     db();
                     $res = db_query($query);
                     
                     while($rows = array_shift($res))
                     {
                     
                     	$ins_qry_1 = "INSERT INTO han_temp (`type` , `trid` , `wid` , `warehousename` , `date` , `time` , `picklist_print`) VALUES ('Outbound','" . $rows["trid"] . "', '" . $rows["wid"] . "', '" . $rows["warehousename"] . "', '" .$rows["date"]. "', '" . $rows["time"]. "', '" . $rows["picklist_print"] . "')";
                     
                         $ins_res_1 = db_query($ins_qry_1);
                     
                     }
                     
                     $query_1 = "SELECT loop_warehouse.warehouse_name AS warehousename,";
                     
                     $query_1.= " loop_transaction_buyer.warehouse_id AS wid , loop_transaction_buyer.id AS trid, loop_transaction_freight.*, ";
                     
                     $query_1.= " loop_transaction_buyer.picklist_print FROM loop_transaction_buyer";
                     
                     $query_1.= " INNER JOIN loop_warehouse ON loop_transaction_buyer.warehouse_id = loop_warehouse.id";
                     
                     $query_1.= " INNER JOIN loop_salesorders ON loop_transaction_buyer.id = loop_salesorders.trans_rec_id";
                     
                     $query_1.= " INNER JOIN loop_transaction_freight ON loop_transaction_buyer.id = loop_transaction_freight.trans_rec_id" ;
                     
                     $query_1.= " WHERE loop_transaction_buyer.so_entered = 1 and loop_transaction_buyer.shipped = 0 and loop_transaction_buyer.ignore = 0";
                     
                     $query_1.= " AND loop_transaction_buyer.bol_signed_uploaded = 0";
                     
                     $query_1.= " AND loop_transaction_buyer.id > 67 and location_warehouse_id = 1115";
                     
                     $query_1.= " and loop_transaction_freight.date < '".$todays_dt."'";
                     
                     $query_1.= " group by trid order by loop_transaction_freight.date ASC";
                     
                     db();
                     $res_1 = db_query($query_1);
                     
                     while($row_1 = array_shift($res_1))
                     {
                     	$ins_qry_2 = "INSERT INTO han_temp (`type` , `trid` , `wid` , `warehousename` , `date` , `time` , `picklist_print`) VALUES ('Outbound','" . $row_1["trid"] . "', '" . $row_1["wid"] . "', '" . $row_1["warehousename"] . "', '" .$row_1["date"]. "', '" . $row_1["time"]. "', '" . $row_1["picklist_print"] . "')";
                     
						db();
                        $ins_res_2 = db_query($ins_qry_2);
                     
                     }
                     
                     $qry = "select * from han_temp order by date asc";
                     
					 db();
                     $result = db_query($qry);
                     
                     while($row = array_shift($result))
                     
                     {
                     
                     ?>
                  <tr vAlign="center">
                     <td bgColor="#e4e4e4" class="style3"  align="center">
                        <?php echo $row["trid"];?>
                     </td>
                     <td bgColor="#e4e4e4" class="style3"  align="center">
                        <?php echo $row["type"];?>
                     </td>
                     <?php
                        if($row['type']=="Inbound")
                        
                        {?>
                     <td bgColor="#e4e4e4" class="style3"  align="center">
                        <u>
                        <a href="viewCompany-purchasing.php?ID=<?php echo $row["wid"]?>"><?php echo $row["warehousename"];?></a>
                        </u>
                     </td>
                     <?php }
                        else{ ?>	
                     <td bgColor="#e4e4e4" class="style3"  align="center">
                        <p align="center">
                           <span class="infotxt_freight ">
                              <u><a target="_blank" href="http://loops.usedcardboardboxes.com/search_results.php?warehouse_id=<?php echo $row["wid"]?>&rec_type=Supplier&proc=View&searchcrit=&id=<?php echo $row["wid"]?>&rec_id=<?php echo $row["trid"];?>&display=buyer_ship"><?php echo $row["warehousename"];?></a></u>
                              <span style="width:570px;">
                        <table cellSpacing="1" cellPadding="1" border="0" width="570">
                        <tr align="middle">
                        <td class="style7" colspan="3" style="height: 16px"><strong>SALE ORDER DETAILS FOR ORDER ID: <?php echo $row["trid"]?></strong></td>
                        </tr>
                        <tr vAlign="center">
                        <td bgColor="#e4e4e4" width="70" class="style17" ><font size=1>
                        <strong>QTY</strong></font></td>
                        <td bgColor="#e4e4e4" width="400" class="style17" ><font size=1>
                        <strong>Box Description</strong></font></td>
                        </tr>
                        <?php

						   db();
                           $get_sales_order = db_query("Select *, loop_salesorders.notes AS A, loop_salesorders.pickup_date AS B, loop_salesorders.freight_vendor AS C, loop_salesorders.time AS D, loop_boxes.isbox AS I From loop_salesorders Inner Join loop_boxes ON loop_salesorders.box_id = loop_boxes.id WHERE trans_rec_id = '". $row["trid"] . "'");
                           
                           while ($boxes = array_shift($get_sales_order)) {
                           
                           	$so_notes = $boxes["A"];
                           
                           	$so_pickup_date = $boxes["B"];
                           
                           	$so_freight_vendor = $boxes["C"];
                           
                           	$so_time = $boxes["D"];
                           
						?>	
                        <tr bgColor="#e4e4e4">
                        <td height="13" class="style1" align="right"><Font Face='arial' size='1'><?php echo $boxes["qty"]; ?>
                        </td>
                        <td align="left" height="13" style="width: 578px" class="style1">  
                        <?php if ($boxes["I"] == "Y") { ?>
                        <font size="1" Face="arial"><?php echo $boxes["blength"]; ?> <?php echo $boxes["blength_frac"]; ?> x <?php echo $boxes["bwidth"]; ?> <?php echo $boxes["bwidth_frac"]; ?> x <?php echo $boxes["bdepth"]; ?> <?php echo $boxes["bdepth_frac"]; ?> <?php echo $boxes["bdescription"]; ?></font>
                        <?php } else { ?>
                        <font size="1" Face="arial"><?php echo $boxes["bdescription"]; ?></font>
                        <?php } ?>
                        </td>
                        </tr>
                        <?php } ?>
                        <?php	
                           $soqry = "Select * From loop_salesorders_manual WHERE trans_rec_id = '". $row["trid"] . "'";
                           
						   db();
                           $get_sales_order2 = db_query($soqry);
                           
                           while ($boxes2 = array_shift($get_sales_order2)) {
                           
                           ?>	
                        <tr bgColor="#e4e4e4">
                        <td height="13" class="style1" align="right"><Font Face='arial' size='1'><?php echo $boxes2["qty"]; ?>
                        </td>
                        <td height="13" class="style1" align="right">&nbsp;</td>
                        <td align="left" height="13" style="width: 578px" class="style1" colspan=2>  
                        <font size="1" Face="arial">&nbsp;&nbsp;<?php echo $boxes2["description"]; ?></font></td>
                        </tr>
                        <?php	}	?>
                        </table>
                        </span>
                        </span>
                        </p>
                     </td>
                     <?php }
                        if($row["date"] == "" || $row["date"] == "0000-00-00")
                        
                        {?>
                     <td bgColor="#e4e4e4" class="style3"  align="center">&nbsp;</td>
                     <?php }
                        else
                        
                        {
                        
                               $fr_book_dt= strtotime($row["date"]);
                        
                               $today_date= strtotime(date('m/d/Y'));
                        
                               if($today_date>$fr_book_dt){
                        
                        ?>
                     <td bgColor="red" class="style3"  align="center"><?php echo $row["date"];?></td>
                     <?php
                        }else if($fr_book_dt == $today_date){
                        
                        ?>
                     <td bgColor="yellow" class="style3"  align="center"><?php echo $row["date"];?></td>
                     <?php
                        }else{
                        
                        ?>
                     <td bgColor="#e4e4e4" class="style3"  align="center"><?php echo $row["date"];?></td>
                     <?php
                        }
                        
                        }?>
                     <td bgColor="#e4e4e4" class="style3"  align="center">
                        <?php echo $row["time"];?>
                     </td>
                     </td>
                     <?php if ($row["picklist_print"] == "Y") { ?>	
                     <td bgColor="#e4e4e4" class="style3"  align="center">	
                        <a href="#" onClick="PrintPickListRep('<?php echo $row["trid"] ?>' , '<?php echo $row["picklist_print"]; ?>')">Re-Print Picklist</a>
                     </td>
                     <?php } 
                        if ($row["picklist_print"] == "N") { ?>									
                     <td bgColor="#e4e4e4" class="style3"  align="center">&nbsp;</td>
                     <?php }
                        if ($row["picklist_print"] == "" || $row["picklist_print"] == "null") { ?>	
                     <td bgColor="#e4e4e4" class="style3"  align="center">	
                        <a href="#" onClick="PrintPickListRep('<?php echo $row["trid"] ?>' , '<?php echo $row["picklist_print"]; ?>')">Print Picklist</a>				
                     </td>
                     <?php }?>			
                  </tr>
                  <?php
                     }

                     db();
                     db_query("DELETE FROM han_temp");	
                     
                     ?>
               </table>
            </td>
            <td valign="top" colSpan="2">
               <table cellSpacing="1" cellPadding="1" border="0" width="700px;">
                  <tr align="middle">
                     <td class="style7" colSpan="7">
                        <b>Pending Order Pick-Ups</b>
                        <a href="javascript:void(0);" onclick="expand();">Expand/</a>
                        <a href="javascript:void(0);" onclick="collapse();">Collapse</a>
                     </td>
                  </tr>
                  <tr>
                     <td colSpan="7">
                        <div id="pending_ship" ></div>
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
      </table>
      <br><br>
      <!--Special Orders table-->
      <table cellSpacing="1" cellPadding="1" border="0" width="700px;">
         <tr align="middle">
            <td class="style7" colSpan="8">
               <b>Special Orders</b>
            </td>
         </tr>
         <tr>
            <td class="style17" align="center" >
               <b>Loop ID</b>
            </td>
            <td class="style17" align="center">
               <b>Company Name</b>
            </td>
            <td class="style17" align="center" >
               <b>Deadline</b>
            </td>
            <td class="style17" align="center" >
               <b>Print Picklist</b>
            </td>
            <td class="style17" align="center">
               <b>Last Note</b>
            </td>
            <td class="style17" align="center">
               <b>Last Note Date</b>
            </td>
            <td class="style17" align="center">
               <b>Update</b>
            </td>
            <td class="style17" align="center" >
               <b>Processing Complete</b>
            </td>
         </tr>
         <?php
            $emp_id = $_COOKIE['employeeid'];
            
            $query = "select *, loop_transaction_buyer.id As wid from loop_transaction_buyer INNER JOIN loop_warehouse ON loop_transaction_buyer.warehouse_id = loop_warehouse.id INNER JOIN loop_salesorders ON loop_transaction_buyer.id = loop_salesorders.trans_rec_id where special_order_complete = 0 and loop_transaction_buyer.shipped = 0 AND loop_transaction_buyer.needreprocessing =1 and loop_salesorders.location_warehouse_id = 1115 AND loop_transaction_buyer.id > 67 group by loop_transaction_buyer.id order by reprocessingdeadline ASC";
            
            db();
            $res = db_query($query);
            
            while($rows = array_shift($res))  
            {
            
                $special_order_complete=$rows["special_order_complete"];
            
                $deadline_date= strtotime($rows["reprocessingdeadline"]);
            
                $rec_type=$rows["rec_type"];
            
                $todaydate= strtotime(date('m/d/Y'));
            
                if($todaydate>$deadline_date){
            
                    $bgclass = "special_order_red";
            
                }
            
                elseif($special_order_complete==1){
            
                    $bgclass = "special_order_green";
            
                }
            
                else{
            
                    $bgclass = "special_order_normal";
            
                }
            
                $sql_translog = "SELECT message, date FROM loop_transaction_notes WHERE loop_transaction_notes.company_id = '" . $rows["warehouse_id"] . "' and loop_transaction_notes.rec_id = '" . $rows["wid"] . "' ORDER BY id DESC LIMIT 0,1";
				
				db();
                $result_translog = db_query($sql_translog);
            
                $last_note_text = "";
            
                $last_note_date = "";
            
                while($last_translog = array_shift($result_translog))
            
                {
            
                    $lastnote_text = $last_translog["message"];
            
                    $last_note_date = $last_translog["date"];
            
                }
            
                ?>
         <tr class="<?php echo $bgclass; ?>" id="so<?php echo $rows["wid"]?>">
            <td class="style3" >
               <a href="viewCompany.php?ID=<?php echo $rows["b2bid"]?>&show=transactions&warehouse_id=<?php echo $rows["warehouse_id"]?>&rec_type=Supplier&proc=View&searchcrit=&id=<?php echo $rows["warehouse_id"]?>&rec_id=<?php echo $rows["wid"]?>&display=buyer_view" target="_blank"><?php echo $rows["wid"]; ?></a>
            </td>
            <td class="style3" >
               <span class="so_infotxt">
                  <a href="viewCompany.php?ID=<?php echo $rows["b2bid"]?>&show=transactions&warehouse_id=<?php echo $rows["warehouse_id"]?>&rec_type=Supplier&proc=View&searchcrit=&id=<?php echo $rows["warehouse_id"]?>&rec_id=<?php echo $rows["wid"]?>&display=buyer_view" target="_blank"> <?php echo $rows["warehouse_name"]; ?></a>
                  <!--Display sales order popup on hover-->
                  <span style="width:570px;">
                     <table cellSpacing="1" cellPadding="1" border="0" width="570">
                        <tr align="middle">
                           <td class="style7" colspan="3" style="height: 16px"><strong>SALE ORDER DETAILS FOR ORDER ID: <?php echo $rows["wid"]?></strong></td>
                        </tr>
                        <tr vAlign="center">
                           <td bgColor="#e4e4e4" width="70" class="style17" ><font size=1>
                              <strong>QTY</strong></font>
                           </td>
                           <td bgColor="#e4e4e4" width="100" class="style17" ><font size=1>
                              <strong>Box Description</strong></font>
                           </td>
                           <td bgColor="#e4e4e4" width="400" class="style17" ><font size=1>
                              <strong>Notes</strong></font>
                           </td>
                        </tr>
                        <?php
						   db();
                           $get_sales_order = db_query("Select *, loop_salesorders.notes AS A, loop_salesorders.pickup_date AS B, loop_salesorders.freight_vendor AS C, loop_salesorders.time AS D, loop_boxes.isbox AS I From loop_salesorders Inner Join loop_boxes ON loop_salesorders.box_id = loop_boxes.id WHERE trans_rec_id = '". $rows["wid"] . "'");
                           
                           while ($boxes = array_shift($get_sales_order)) {
                           
                           	$so_notes = $boxes["A"];
                           
                           	$so_pickup_date = $boxes["B"];
                           
                           	$so_freight_vendor = $boxes["C"];
                           
                           	$so_time = $boxes["D"];
                           
                           ?>	
                        <tr bgColor="#e4e4e4">
                           <td height="13" class="style1" align="right"><Font Face='arial' size='1'><?php echo $boxes["qty"]; ?>
                           </td>
                           <td align="left" height="13" style="width: 578px" class="style1">  
                              <?php if ($boxes["I"] == "Y") { ?>
                              <font size="1" Face="arial"><?php echo $boxes["blength"]; ?> <?php echo $boxes["blength_frac"]; ?> x <?php echo $boxes["bwidth"]; ?> <?php echo $boxes["bwidth_frac"]; ?> x <?php echo $boxes["bdepth"]; ?> <?php echo $boxes["bdepth_frac"]; ?> <?php echo $boxes["bdescription"]; ?></font>
                              <?php } else { ?>
                              <font size="1" Face="arial"><?php echo $boxes["bdescription"]; ?></font>
                              <?php } ?>
                           </td>
                           <td height="13" style="width: 94px" class="style1" align="left"><Font Face='arial' size='1'>
                              <?php
                                 echo $so_notes; 
                                 
                                 ?>	
                           </td>
                        </tr>
                        <?php }//End while $boxes = array_shift($get_sales_order)) ?>
                        <?php	
                           $soqry = "Select * From loop_salesorders_manual WHERE trans_rec_id = '". $rows["wid"] . "'";
                           
						   db();
                           $get_sales_order2 = db_query($soqry);
                           
                           while ($boxes2 = array_shift($get_sales_order2)) {
                           
                           ?>	
                        <tr bgColor="#e4e4e4">
                           <td height="13" class="style1" align="right"><Font Face='arial' size='1'><?php echo $boxes2["qty"]; ?>
                           </td>
                           <td height="13" class="style1" align="right">&nbsp;</td>
                           <td align="left" height="13" style="width: 578px" class="style1" colspan=2>  
                              <font size="1" Face="arial">&nbsp;&nbsp;<?php echo $boxes2["description"]; ?></font>
                           </td>
                        </tr>
                        <?php
                           }//end while ($boxes2 = array_shift($get_sales_order2))	
                           
                           ?>
                     </table>
                  </span>
                  <!--End display sales order popup on hover-->
               </span>
            </td>
            <td class="style3" >
               <?php 
                  if($rows["reprocessingdeadline"]=="NULL" || $rows["reprocessingdeadline"]=="")
                  
                  {
                  
                  	$deadlinedate="";
                  
                  }
                  
                  else{
                  
                  	$deadlinedate=date('m-d-Y', strtotime($rows["reprocessingdeadline"]));
                  
                  }
                  
                  echo $deadlinedate; ?> 
               <input type="hidden" name="deadlinedate" id="deadlinedate<?php echo $rows["wid"]; ?>" value="<?php echo $deadlinedate; ?>"> 
            </td>
            <?php
               $bgColor_val = "#e4e4e4";
               
                if ($rows["picklist_print"] == "Y") { 
               
               $pprint="Re-Print Picklist";
               
               ?>	
            <td class="style3" align="center">	
               <a href="#" onClick="PrintPickListRep_so('<?php echo $rows["wid"]; ?>' , '<?php echo $rows["picklist_print"]; ?>')">Re-Print Picklist</a>
            </td>
            <?php } 
               if ($rows["picklist_print"] == "N") { 
               
               $pprint="";
               
               ?>									
            <td class="style3" align="center">&nbsp;</td>
            <?php }
               if ($rows["picklist_print"] == "" || $rows["picklist_print"] == "null") {
               
               $pprint="Print Picklist";
               
               ?>
            <td class="style3" align="center">	
               <a href="#" onClick="PrintPickListRep_so('<?php echo $rows["wid"]; ?>' , '<?php echo $rows["picklist_print"]; ?>')">Print Picklist</a>				
            </td>
            <?php }
               ?>	
            <input type="hidden" name="pprintdata" id="pprintdata<?php echo $rows["wid"]?>" value="<?php echo $pprint; ?>">
            <td class="style3">
               <textarea name="last_note_so" id="last_note_so<?php echo $rows["wid"]; ?>"><?php echo $lastnote_text; ?></textarea>
            </td>
            <td class="style3">
               <div id="transdate_div<?php echo $rows["wid"]?>">
                  <?php echo  $last_note_date; ?>
               </div>
            </td>
            <td class="style3" align="center">
               <input type="hidden" name="rect_type_so" id="rect_type_so<?php echo $rows["wid"]?>" value="<?php echo $rec_type; ?>">
               <input type="button" name="update_so" id='update_so<?php echo $rows["wid"]?>' onclick="update_so_note(<?php echo $rows["wid"]?>,<?php echo $rows["warehouse_id"]; ?>,<?php echo $emp_id; ?>); return false;" value="Update">
               <div id="transinfo<?php echo $rows["wid"]?>"></div>
            </td>
            <td class="style3" align="center">
               <div id="complete_so_div<?php echo $rows["wid"]?>">
                  <?php
                     if($special_order_complete==0)
                     
                     {
                     
                         ?>
                  <input type="button" name="complete_so" id='complete_so<?php echo $rows["wid"]?>' onclick="complete_specialorder_row(<?php echo $rows["wid"]?>,<?php echo $rows["warehouse_id"]; ?>,1); return false;" value="Complete">
                  <?php
                     }
                     
                     if($special_order_complete==1)
                     
                     {
                     
                     ?>
                  Completed<br>
                  <input type="button" name="undo_complete_so" id='undo_complete_so<?php echo $rows["wid"]?>' onclick="complete_specialorder_row(<?php echo $rows["wid"]?>,<?php echo $rows["warehouse_id"]; ?>,0); return false;" value="Undo">
                  <?php
                     }
                     
                     ?>
               </div>
            </td>
         </tr>
         <?php
            }
            
            ?>
      </table>
      <!--End Special Orders table-->
      <br/><br/>
      <!--------------- END SALES ORDER TABLE ---------------->
      <!--------------- BEGIN INVENTORY TABLE ---------------->
      <br><br>
      <table>
         <tr>
            <td valign="top" colSpan="2">
               <div id="hide_tr">
                  <table cellSpacing="1" cellPadding="1" border="0" width="700px" >
                     <tr align="middle">
                        <td class="style7" colSpan="6" valign="top"> 
                           <b>INVENTORY</b>
                           <a href="javascript:void(0);" onclick="expand_inv();">Expand/</a>
                           <a href="javascript:void(0);" onclick="collapse_inv();">Collapse</a>
                        </td>
                     </tr>
                  </table>
               </div>
               <div id="inv"></div>
            </td>
         </tr>
      </table>
      <!--------------- END INVENTORY TABLE ---------------->
      <br><br>
      <!--B2C Inventory table-->
      <table>
         <tr>
            <td valign="top" colSpan="2">
               <div id="hide_b2cinv">
                  <table cellSpacing="1" cellPadding="1" border="0" width="700px" >
                     <tr align="middle">
                        <td class="style7" colSpan="6" valign="top"> 
                           <b>B2C Inventory</b>
                           <a href="javascript:void(0);" onclick="expand_b2cinv();">Expand/</a>
                           <a href="javascript:void(0);" onclick="collapse_b2cinv();">Collapse</a>
                        </td>
                     </tr>
                  </table>
               </div>
               <div id="b2c_inv"></div>
            </td>
         </tr>
      </table>
      </td>
      </tr>
      </table>
      <!--------------- BEGIN PENDING KIT TABLE ---------------->
      <br>
      <br>
      <?php
         $sql_pc = "SELECT * FROM `orders_active_ucb_los_angeles` WHERE ship_status LIKE 'N' ";
         
		 db();
         $result_pc = db_query($sql_pc);
         
         $count_pc3 =tep_db_num_rows($result_pc);
         
         
         
         $currentdate = new DateTime();
         
         $prev_date = $currentdate;
         
         
         
         $sql_pc2 = "SELECT orders_active_export.orders_id FROM `orders_active_export` WHERE warehouse_id = 1 and orders_active_export.print_date BETWEEN '". $prev_date->format("Y-m-d") . "' and '" . $prev_date->format("Y-m-d") . " 23:59:59" . "'";
         
		 db();
         $result_pc2 = db_query($sql_pc2);
         
         $count_pc_tot_for_day2 = 0;
         
         while ($result_pc_row = array_shift($result_pc2)) {
         
         	//$count_pc_tot_for_day2= $result_pc_row["no_of_kits_shipped"];
         
         	$count_pc_tot_for_day2 = $count_pc_tot_for_day2 + 1;
         
         }			
         
         
         
         ?>
      <table>
         <tr>
            <td valign="top">
               <table cellSpacing="1" cellPadding="1" border="0" width="300" >
                  <tr align="middle">
                     <td colSpan="4" class="style7" style="height: 16px">
                        <b>PENDING SHIPMENTS</b>
                     </td>
                  </tr>
                  <tr align="middle">
                     <td class="style7" style="height: 16px">
                        Warehouse
                     </td>
                     <td class="style7" style="height: 16px">
                        Labels to be Printed
                     </td>
                     <td class="style7" style="height: 16px">
                        Labels Printed Today
                     </td>
                  </tr>
                  <tr vAlign="center">
                     <td bgColor="#e4e4e4" class="style12" style="width: 10%">LA</td>
                     <td bgColor="#e4e4e4" class="style12" style="width: 10%">
                        <a href="https://b2c.usedcardboardboxes.com/pending_shipments.php?tbl=hannibal&fromdash=y&posting=yes" target="_blank"><?php echo $count_pc3; ?></a>
                     </td>
                     <td bgColor="#e4e4e4" class="style12" style="width: 10%">
                        <a href="https://b2c.usedcardboardboxes.com/shipments_shipped.php?tbl=hannibal&fromdash=y&posting=yes" target="_blank"><b><?php echo $count_pc_tot_for_day2; ?></b></a>
                     </td>
                  </tr>
               </table>
            </td>
            <td>
               <table cellSpacing="1" cellPadding="1" border="0" width="300px;">
                  <tr align="middle">
                     <td class="style7">
                        <b>QUICK LINKS</b>
                     </td>
                  </tr>
                  <tr>
                     <td bgColor="#e4e4e4" class="style12center" >
                        <a href="http://loops.usedcardboardboxes.com/report_hktrans_inventory.php"><b>Physical Inventory Report</b></a>
                     </td>
                  </tr>
                  <tr>
                     <td bgColor="#e4e4e4" class="style12center" >
                        <a href="http://loops.usedcardboardboxes.com/TrailerSweep_HK.php"><b>Trailer Sweep</b></a>
                     </td>
                  </tr>
                  <tr>
                     <td bgColor="#e4e4e4" class="style12center" >
                        <a target="_blank" href="http://loops.usedcardboardboxes.com/report_inbound_inventory_summary.php?warehouse_id=1115"><b><span style="text-transform: uppercase;">Inbound Summary</span></b></a>
                     </td>
                  </tr>
                  <tr>
                     <td bgColor="#e4e4e4" class="style12center" >
                        <a target="_blank" href="kit_box_report.php?warehouse_id=1115"><b>Kit Box Inventory</b></a>
                     </td>
                  </tr>
                  <tr>
                     <td bgColor="#e4e4e4" class="style12center" >
                        <a target="_blank" href="deletewarehousetransaction.php"><b>Remove Duplicate Trailers</b></a>
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
      </table>
      <!-------------------------------------------- End Kits --------->
      <br>
      <div id="light" class="white_content">
      </div>
      <div id="fade" class="black_overlay"></div>
      <div id="diveod" style="display:none;">
         <form action="<?php echo hktranswarehousepage();?>" name="frmeod" id="frmeod" method="post">
            <table>
               <tr>
                  <td ><strong>Confirm Qty of Kits Shipped</strong></td>
               </tr>
               <tr>
                  <td >Enter No. of Qty of Kits Shipped Today: &nbsp;<input type="text" name="qtyofkitship" id="qtyofkitship" value=""/></td>
               </tr>
               <tr>
                  <td ><input type="submit" name="btnqtyofkitship" id="btnqtyofkitship" value="Update"/>
                     <input type="hidden" name="hd_warehouse" id="hd_warehouse" value=""/>
                  </td>
               </tr>
            </table>
         </form>
      </div>
   </body>
</html>
