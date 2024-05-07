<?
require ("inc/header_session.php");
require ("../mainfunctions/database.php");
require ("../mainfunctions/general-functions.php");

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Supply & Demand Scorecard Report </title>
<link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet"> 
<LINK rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>

<style type="text/css">
.style7 {
	font-size: x-small;
	font-family: Arial, Helvetica, sans-serif;
	color: #333333;
	background-color: #FFF0F0;
}

.style7_2 {
	font-size: x-small;
	font-family: Arial, Helvetica, sans-serif;
	color: #333333;
	background-color: #bcf5bc;
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
	font-family: Arial, Helvetica, sans-serif;`
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
	background-color: #FFF0F0;
}

.style_demand_child {
	font-family: Arial, Helvetica, sans-serif;
	font-size: x-small;
	color: #333333;
	background-color: #EEE8CD;
}

.style_child {
	font-family: Arial, Helvetica, sans-serif;
	font-size: x-small;
	color: #333333;
	background-color: #FFF0F0;
}


.style17_2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: x-small;
	color: #333333;
	background-color: #bcf5bc;
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
		width: 90%;
		height: 85%;
		padding: 16px;
		border: 1px solid gray;
		background-color: white;
		z-index:1002;
		overflow: auto;
	}
	
</style>	

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

        <script type="text/javascript">
			$(document).ready(function() {
				var options = {
					chart: {
						renderTo: 'container',
						type: 'area',
						marginRight: 130,
						marginBottom: 25
					},
					title: {
						text: 'SUPPLY - Available Loads over Last 3 Weeks',
						x: -20 //center
					},
					subtitle: {
						text: '',
						x: -20
					},
					xAxis: {
						title: {
							text: 'Days'
						},
						categories: []
					},
					yAxis: {
						title: {
							text: 'Total Available Loads'
						},
						plotLines: [{
							value: 0,
							width: 1,
							color: '#808080'
						}]
					},
					legend: {
						layout: 'vertical',
						align: 'right',
						verticalAlign: 'top',
						x: -10,
						y: 100,
						borderWidth: 0
					},
					plotOptions: {
						area: {
							stacking: 'normal',
							lineColor: '#666666',
							lineWidth: 1,
							marker: {
								lineWidth: 1,
								lineColor: '#666666'
							}
						}
					},
					series: []
				}
				 
				var options2 = {
					chart: {
						renderTo: 'container2',
						type: 'area',
						marginRight: 130,
						marginBottom: 25
					},
					title: {
						text: 'DEMAND - Demand Entries over Last 3 Weeks',
						x: -20 //center
					},
					subtitle: {
						text: '',
						x: -20
					},
					xAxis: {
						title: {
							text: 'Days'
						},
						categories: []
					},
					yAxis: {
						title: {
							text: 'Total Demand Entries'
						},
						plotLines: [{
							value: 0,
							width: 1,
							color: '#808080'
						}]
					},
					legend: {
						layout: 'vertical',
						align: 'right',
						verticalAlign: 'top',
						x: -10,
						y: 100,
						borderWidth: 0
					},
					plotOptions: {
						area: {
							stacking: 'normal',
							lineColor: '#666666',
							lineWidth: 1,
							marker: {
								lineWidth: 1,
								lineColor: '#666666'
							}
						}
					},
					series: []
				}
				
				$.getJSON("report_supply_chart_data.php", function(json) {
				options.xAxis.categories = json[0]['data'];
					options.series[0] = json[1];
					options.series[1] = json[2];
					options.series[2] = json[3];
					options.series[3] = json[4];
					options.series[4] = json[5];
					
					chart = new Highcharts.Chart(options);
				});

				$.getJSON("report_demand_chart_data.php", function(json) {
				options2.xAxis.categories = json[0]['data'];
					options2.series[0] = json[1];
					options2.series[1] = json[2];
					options2.series[2] = json[3];
					options2.series[3] = json[4];
					options2.series[4] = json[5];
					
					chart = new Highcharts.Chart(options2);
				});
			});		
			
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
	
			function load_popup(id){
				document.getElementById("light").style.display = "block";
				var selectobject = document.getElementById(id);
				var n_left = f_getPosition(selectobject, 'Left');
				var n_top  = f_getPosition(selectobject, 'Top');
				n_left = n_left + 100;
				n_top = n_top + 50;
				document.getElementById('light').style.left = n_left + 'px';
				document.getElementById('light').style.top = n_top + 'px';

				document.getElementById("light").innerHTML = document.getElementById(id).innerHTML; 
			}
			
			function close_div(){
				document.getElementById('light').style.display='none';
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
        </script>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
		
</head>

<body>
<? include("inc/header.php"); ?>
<div class="main_data_css">
	<div id="light" class="white_content"></div>
	<div id="fade" class="black_overlay"></div>
	<div class="dashboard_heading" style="float: left;">
		<div style="float: left;">
			Supply & Demand Scorecard Report    
		
		<div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
		<span class="tooltiptext">This reports shows the user a summary of data regarding supply (what we have to sell) and demand (what customers want to buy).</span></div><br>
		</div>
	</div>

<!-- 
<div id="light" class="white_content"></div>
<div id="fade" class="black_overlay"></div>

<table border="0" width="800px;">
	<tr>
		<td width="30%">
			<img src="images/ucb-logo-zero.jpg" width="100px" height="100px">
		</td>
		<td align=center width="50%">
			<font face="Ariel" size="5">
			<b>B2B Division - Supply and Demand Scorecard</b>
		</td>
	</tr>
</table>
-->
	<table cellSpacing="1" cellPadding="1" border="0" width="800px;">

		<tr align="middle">
			<td colSpan="15" class="style7">
			<b>SUPPLY</b></td>
		</tr>
		<tr>
			<td style="width: 150" class="style17" align="center">
				<b>Available Loads</b>
			</td>
			<?
				$time = strtotime(Date('Y-m-d'));
				for ($day_cnt = 13; $day_cnt >= 0; $day_cnt = $day_cnt- 1){
					$time_new = strtotime('-' . $day_cnt . ' days', $time);
					
					echo "<td style='width:100' class='style17' align='center'>" . Date("m/d", $time_new) . "</td>";
				}
			?>			
		</tr>		
		
			<?
			$tot_row1 = 0; $tot_row2 = 0; $tot_row3 = 0; $tot_row4 = 0; $tot_row4 = 0; $tot_row5 = 0; $tot_row6 = 0; $tot_row7 = 0; $tot_row8 = 0; $tot_row9 = 0; 
			$tot_row10 = 0; $tot_row11 = 0; $tot_row12 = 0; $tot_row13 = 0; $tot_row14 = 0;  
//	$dt_view_qry = "Insert into SupplyDemand_data (SupplyDemand_flg, inventory_date, Urgents, Gaylords, ShippingBoxes, Supersacks, Pallets, Other, waste_to_energy, inward_date) ";				

			$Array_type = array('Urgents', 'Gaylords', 'ShippingBoxes', 'Supersacks', 'Pallets', 'Other');
			//, 'waste_to_energy'
			$time = strtotime(Date('Y-m-d')); $running_cnt = 0;
			foreach ($Array_type as $Array_type_tmp) {
				
				echo "<tr>";
				echo "<td style='width:100' class='style17' align='left'>" . $Array_type_tmp . "</td>";
				$cnt = 0; $main_cnt_prev = 0;
				for ($day_cnt = 13; $day_cnt >= 0; $day_cnt = $day_cnt- 1){
					$time_new = strtotime('-' . $day_cnt . ' days', $time);
			
					$dt_view_qry = "SELECT * from SupplyDemand_data where SupplyDemand_flg = 'Supply' and inventory_date = '" . Date("Y-m-d", $time_new) . "' order by unqid";
					//echo $Array_type_tmp . " - " . $day_cnt . " - " . $dt_view_qry . "<br>";
					$rec_found = "no"; $main_cnt = 0; 
					$dt_view_res = db_query($dt_view_qry, db_b2b() );
					while ($dt_view_row = array_shift($dt_view_res)) {
						$running_cnt = $running_cnt + 1;
						
						$rec_found = "yes";
						$main_cnt = $dt_view_row[$Array_type_tmp];
						if ($main_cnt == 0){
							$font_color = "green";
						}else{
							if ($main_cnt_prev <= $main_cnt){
								$font_color = "red";
							}else{
								$font_color = "green";
							}
						}	
						if ($dt_view_row[$Array_type_tmp . "_list"] != ""){
							echo "<td style='width:100' class='style_child' align='right'><a href='#' id='popupid$running_cnt' onclick='load_popup(" . $running_cnt . "); return false;'><font color=" . $font_color . ">". $dt_view_row[$Array_type_tmp] . "</font></a>";
							echo "<div id='$running_cnt' style='display:none;'><a href='#' onclick='close_div(); return false;'>Close</a><br>" . $dt_view_row[$Array_type_tmp . "_list"] . "</div>";
						}else{
							echo "<td style='width:100' class='style_child' align='right'><font color=" . $font_color . ">". $dt_view_row[$Array_type_tmp] . "</font>";
						}						
						echo "</td>";
						$main_cnt_prev = $dt_view_row[$Array_type_tmp];
					}
					if ($rec_found == "no"){
						echo "<td style='width:100' class='style_child' align='right'>&nbsp;</td>";
					}
					
					$cnt = $cnt + 1;
					if ($Array_type_tmp != "Urgents"){
						if ($cnt == 1){
							$tot_row1 = $tot_row1 + $main_cnt;
						}
						if ($cnt == 2){
							$tot_row2 = $tot_row2 + $main_cnt;
						}
						if ($cnt == 3){
							$tot_row3 = $tot_row3 + $main_cnt;
						}
						if ($cnt == 4){
							$tot_row4 = $tot_row4 + $main_cnt;
						}
						if ($cnt == 5){
							$tot_row5 = $tot_row5 + $main_cnt;
						}
						if ($cnt == 6){
							$tot_row6 = $tot_row6 + $main_cnt;
						}
						if ($cnt == 7){
							$tot_row7 = $tot_row7 + $main_cnt;
						}
						if ($cnt == 8){
							$tot_row8 = $tot_row8 + $main_cnt;
						}
						if ($cnt == 9){
							$tot_row9 = $tot_row9 + $main_cnt;
						}
						if ($cnt == 10){
							$tot_row10 = $tot_row10 + $main_cnt;
						}
						if ($cnt == 11){
							$tot_row11 = $tot_row11 + $main_cnt;
						}
						if ($cnt == 12){
							$tot_row12 = $tot_row12 + $main_cnt;
						}
						if ($cnt == 13){
							$tot_row13 = $tot_row13 + $main_cnt;
						}
						if ($cnt == 14){
							$tot_row14 = $tot_row14 + $main_cnt;
						}
					}	
				}
				echo "</tr>";				
			}
			
			echo "<tr>";
			echo "<td style='width:100' class='style_child' align='right'><b>Total</b></td>";
			echo "<td style='width:100' class='style_child' align='right'><b>" . $tot_row1 . "</b></td>";

			if ($tot_row2 == 0){
				$font_color = "green";
			}else{
				if ($tot_row1 <= $tot_row2){
					$font_color = "red";
				}else{
					$font_color = "green";
				}
			}	
			echo "<td style='width:100' class='style_child' align='right'><b><font color=" . $font_color . ">" . $tot_row2 . "</font></b></td>";
			if ($tot_row3 == 0){
				$font_color = "green";
			}else{
				if ($tot_row2 <= $tot_row3){
					$font_color = "red";
				}else{
					$font_color = "green";
				}
			}	
			echo "<td style='width:100' class='style_child' align='right'><b><font color=" . $font_color . ">" . $tot_row3 . "</font></b></td>";
			if ($tot_row4 == 0){
				$font_color = "green";
			}else{
				if ($tot_row3 <= $tot_row4){
					$font_color = "red";
				}else{
					$font_color = "green";
				}
			}	
			echo "<td style='width:100' class='style_child' align='right'><b><font color=" . $font_color . ">" . $tot_row4 . "</font></b></td>";
			if ($tot_row5 == 0){
				$font_color = "green";
			}else{
				if ($tot_row4 <= $tot_row5){
					$font_color = "red";
				}else{
					$font_color = "green";
				}
			}	
			echo "<td style='width:100' class='style_child' align='right'><b><font color=" . $font_color . ">" . $tot_row5 . "</font></b></td>";
			if ($tot_row6 == 0){
				$font_color = "green";
			}else{
				if ($tot_row5 <= $tot_row6){
					$font_color = "red";
				}else{
					$font_color = "green";
				}
			}	
			echo "<td style='width:100' class='style_child' align='right'><b><font color=" . $font_color . ">" . $tot_row6 . "</font></b></td>";
			if ($tot_row7 == 0){
				$font_color = "green";
			}else{
				if ($tot_row6 <= $tot_row7){
					$font_color = "red";
				}else{
					$font_color = "green";
				}
			}	
			echo "<td style='width:100' class='style_child' align='right'><b><font color=" . $font_color . ">" . $tot_row7 . "</font></b></td>";
			if ($tot_row8 == 0){
				$font_color = "green";
			}else{
				if ($tot_row7 <= $tot_row8){
					$font_color = "red";
				}else{
					$font_color = "green";
				}
			}	
			echo "<td style='width:100' class='style_child' align='right'><b><font color=" . $font_color . ">" . $tot_row8 . "</font></b></td>";
			if ($tot_row9 == 0){
				$font_color = "green";
			}else{
				if ($tot_row8 <= $tot_row9){
					$font_color = "red";
				}else{
					$font_color = "green";
				}
			}	
			echo "<td style='width:100' class='style_child' align='right'><b><font color=" . $font_color . ">" . $tot_row9 . "</font></b></td>";
			if ($tot_row10 == 0){
				$font_color = "green";
			}else{
				if ($tot_row9 <= $tot_row10){
					$font_color = "red";
				}else{
					$font_color = "green";
				}
			}	
			echo "<td style='width:100' class='style_child' align='right'><b><font color=" . $font_color . ">" . $tot_row10 . "</font></b></td>";
			if ($tot_row11 == 0){
				$font_color = "green";
			}else{
				if ($tot_row10 <= $tot_row11){
					$font_color = "red";
				}else{
					$font_color = "green";
				}
			}	
			echo "<td style='width:100' class='style_child' align='right'><b><font color=" . $font_color . ">" . $tot_row11 . "</font></b></td>";
			if ($tot_row12 == 0){
				$font_color = "green";
			}else{
				if ($tot_row11 <= $tot_row12){
					$font_color = "red";
				}else{
					$font_color = "green";
				}
			}	
			echo "<td style='width:100' class='style_child' align='right'><b><font color=" . $font_color . ">" . $tot_row12 . "</font></b></td>";
			if ($tot_row13 == 0){
				$font_color = "green";
			}else{
				if ($tot_row12 <= $tot_row13){
					$font_color = "red";
				}else{
					$font_color = "green";
				}
			}	
			echo "<td style='width:100' class='style_child' align='right'><b><font color=" . $font_color . ">" . $tot_row13 . "</font></b></td>";
			if ($tot_row14 == 0){
				$font_color = "green";
			}else{
				if ($tot_row13 <= $tot_row14){
					$font_color = "red";
				}else{
					$font_color = "green";
				}
			}	
			echo "<td style='width:100' class='style_child' align='right'><b><font color=" . $font_color . ">" . $tot_row14 . "</font></b></td>";
			echo "</tr>";				
		?>
	</table>
	
	<br><br>
	<div id="container" align="center" width="800px"></div>
	<br><br>
	
	<table cellSpacing="1" cellPadding="1" border="0" width="800px;">

		<tr align="middle">
			<td colSpan="15" class="style_demand_child">
			<b>DEMAND</b></td>
		</tr>
		<tr>
			<td style="width: 350" class="style_demand_child" align="center">
				<b>Demand Entries</b>
			</td>
			<?
				$time = strtotime(Date('Y-m-d'));
				for ($day_cnt = 13; $day_cnt >= 0; $day_cnt = $day_cnt- 1){
					$time_new = strtotime('-' . $day_cnt . ' days', $time);
					
					echo "<td style='width:100' class='style_demand_child' align='center'>" . Date("m/d", $time_new) . "</td>";
				}
			?>			
		</tr>		
		
			<?
			
			$lisoftrans_top_head = "<span style='width:700px;'><table cellSpacing='1' cellPadding='1' border='0' width='850' >
			<tr vAlign='center'>
			
				<td bgColor='#e4e4e4' class='style12center' align='center'><b>Quote/Sales Request ID</b></td>  
				
				<td bgColor='#e4e4e4' class='style12center' align='center'><b>Sales Request Item</b></td>  

				<td bgColor='#e4e4e4' class='style12center' align='center'><b>Company</b></td>  
				
				<td bgColor='#e4e4e4' class='style12center' align='center'><font size=1><b>Date of Request</b></font></td>	  
			</tr>";			
			
			$tot_row1 = 0; $tot_row2 = 0; $tot_row3 = 0; $tot_row4 = 0; $tot_row4 = 0; $tot_row5 = 0; $tot_row6 = 0; $tot_row7 = 0; $tot_row8 = 0; $tot_row9 = 0; 
			$tot_row10 = 0; $tot_row11 = 0; $tot_row12 = 0; $tot_row13 = 0; $tot_row14 = 0;  
//	$dt_view_qry = "Insert into SupplyDemand_data (SupplyDemand_flg, inventory_date, Urgents, Gaylords, ShippingBoxes, Supersacks, Pallets, Other, waste_to_energy, inward_date) ";				

			$Array_type = array('Gaylords', 'ShippingBoxes', 'Supersacks', 'Pallets', 'Other');
			$time = strtotime(Date('Y-m-d'));
			foreach ($Array_type as $Array_type_tmp) {
				echo "<tr>";
				echo "<td style='width:100' class='style_demand_child' align='left'>" . $Array_type_tmp . "</td>";
				$cnt = 0; $main_cnt_prev = 0;
				for ($day_cnt = 13; $day_cnt >= 0; $day_cnt = $day_cnt- 1){
					$time_new = strtotime('-' . $day_cnt . ' days', $time);
					if ($Array_type_tmp == 'Gaylords'){
						$quote_item_id = 1;	
					}
					if ($Array_type_tmp == 'ShippingBoxes'){
						$quote_item_id = 2;	
					}
					if ($Array_type_tmp == 'Supersacks'){
						$quote_item_id = 3;	
					}
					if ($Array_type_tmp == 'Pallets'){
						$quote_item_id = 4;	
					}
					if ($Array_type_tmp == 'Other'){
						$quote_item_id = 7;	
					}
					$dt_view_qry = "SELECT count(*) as sumcnt from quote_request where quote_item = $quote_item_id and (quote_date >= '" . Date("Y-m-d 00:00:00", $time_new) . "' and quote_date <= '" . Date("Y-m-d 23:59:59", $time_new) . "') ";
					$rec_found = "no"; $main_cnt = 0;
					$dt_view_res = db_query($dt_view_qry, db() );
					while ($dt_view_row = array_shift($dt_view_res)) {
						$running_cnt = $running_cnt + 1;
						
						$rec_found = "yes";
						$main_cnt = $dt_view_row["sumcnt"];
						
						if ($main_cnt == 0){
							$font_color = "green";
						}else{
							if ($main_cnt_prev <= $main_cnt){
								$font_color = "red";
							}else{
								$font_color = "green";
							}
						}	

						$lisoftrans = "";
						if ($Array_type_tmp == 'Gaylords'){
							$quote_qry="Select * from quote_request inner join quote_gaylord on quote_request.quote_id = quote_gaylord.quote_id where quote_item = $quote_item_id and (quote_date >= '" . Date("Y-m-d 00:00:00", $time_new) . "' and quote_date <= '" . Date("Y-m-d 23:59:59", $time_new) . "')";
						}
						if ($Array_type_tmp == 'ShippingBoxes'){
							$quote_qry="Select * from quote_request inner join quote_shipping_boxes on quote_request.quote_id = quote_shipping_boxes.quote_id where quote_item = $quote_item_id and (quote_date >= '" . Date("Y-m-d 00:00:00", $time_new) . "' and quote_date <= '" . Date("Y-m-d 23:59:59", $time_new) . "')";
						}
						if ($Array_type_tmp == 'Supersacks'){
							$quote_qry="Select * from quote_request inner join quote_supersacks on quote_request.quote_id = quote_supersacks.quote_id where quote_item = $quote_item_id and (quote_date >= '" . Date("Y-m-d 00:00:00", $time_new) . "' and quote_date <= '" . Date("Y-m-d 23:59:59", $time_new) . "')";
						}
						if ($Array_type_tmp == 'Pallets'){
							$quote_qry="Select * from quote_request inner join quote_pallets on quote_request.quote_id = quote_pallets.quote_id where quote_item = $quote_item_id and (quote_date >= '" . Date("Y-m-d 00:00:00", $time_new) . "' and quote_date <= '" . Date("Y-m-d 23:59:59", $time_new) . "')";
						}
						if ($Array_type_tmp == 'Other'){
							$quote_qry="Select * from quote_request inner join quote_other on quote_request.quote_id = quote_other.quote_id where quote_item = $quote_item_id and (quote_date >= '" . Date("Y-m-d 00:00:00", $time_new) . "' and quote_date <= '" . Date("Y-m-d 23:59:59", $time_new) . "')";
						}
						$quote_res=db_query($quote_qry,db());
						while($quote_row=array_shift($quote_res))
						{
							$sales_date = explode(" ", $quote_row["quote_date"]);

							$lisoftrans .= "<tr><td bgColor='#E4EAEB'><a href='viewCompany.php?ID=". $quote_row["companyID"] . "' target='_blank'><font size=1>". $quote_row["quote_id"] . "</td>";
							$lisoftrans .= "<td bgColor='#E4EAEB'><font size=1>" . $Array_type_tmp . "</td><td bgColor='#E4EAEB'><font size=1>". get_nickname_val('', $quote_row["companyID"]) . "</td>";
							$lisoftrans .= "<td bgColor='#E4EAEB'><font size=1>" . $sales_date[0] . "</td></tr>";
							
						}
						echo "<td style='width:100' class='style_demand_child' align='right'><a href='#' id='popupid$running_cnt' onclick='load_popup(" . $running_cnt . "); return false;'><font color=" . $font_color . ">". $main_cnt . "</font></a>";
						echo "<div id='$running_cnt' style='display:none;'><a href='#' onclick='close_div(); return false;'>Close</a><br>" . $lisoftrans_top_head . $lisoftrans . "</table></span>" . "</div></td>";
						
						
						$main_cnt_prev = $dt_view_row["sumcnt"];

					}
					if ($rec_found == "no"){
						echo "<td style='width:100' class='style_demand_child' align='center'>&nbsp;</td>";
					}
					
					$cnt = $cnt + 1;
					
					if ($cnt == 1){
						$tot_row1 = $tot_row1 + $main_cnt;
					}
					if ($cnt == 2){
						$tot_row2 = $tot_row2 + $main_cnt;
					}
					if ($cnt == 3){
						$tot_row3 = $tot_row3 + $main_cnt;
					}
					if ($cnt == 4){
						$tot_row4 = $tot_row4 + $main_cnt;
					}
					if ($cnt == 5){
						$tot_row5 = $tot_row5 + $main_cnt;
					}
					if ($cnt == 6){
						$tot_row6 = $tot_row6 + $main_cnt;
					}
					if ($cnt == 7){
						$tot_row7 = $tot_row7 + $main_cnt;
					}
					if ($cnt == 8){
						$tot_row8 = $tot_row8 + $main_cnt;
					}
					if ($cnt == 9){
						$tot_row9 = $tot_row9 + $main_cnt;
					}
					if ($cnt == 10){
						$tot_row10 = $tot_row10 + $main_cnt;
					}
					if ($cnt == 11){
						$tot_row11 = $tot_row11 + $main_cnt;
					}
					if ($cnt == 12){
						$tot_row12 = $tot_row12 + $main_cnt;
					}
					if ($cnt == 13){
						$tot_row13 = $tot_row13 + $main_cnt;
					}
					if ($cnt == 14){
						$tot_row14 = $tot_row14 + $main_cnt;
					}
				}
				echo "</tr>";				
			}
			
			echo "<tr>";
			echo "<td style='width:100' class='style_demand_child' align='right'><b>Total</b></td>";
			echo "<td style='width:100' class='style_demand_child' align='right'><b>" . $tot_row1 . "</b></td>";

			if ($tot_row2 == 0){
				$font_color = "green";
			}else{
				if ($tot_row1 <= $tot_row2){
					$font_color = "red";
				}else{
					$font_color = "green";
				}
			}	
			echo "<td style='width:100' class='style_demand_child' align='right'><b><font color=" . $font_color . ">" . $tot_row2 . "</font></b></td>";
			if ($tot_row3 == 0){
				$font_color = "green";
			}else{
				if ($tot_row2 <= $tot_row3){
					$font_color = "red";
				}else{
					$font_color = "green";
				}
			}	
			echo "<td style='width:100' class='style_demand_child' align='right'><b><font color=" . $font_color . ">" . $tot_row3 . "</font></b></td>";
			if ($tot_row4 == 0){
				$font_color = "green";
			}else{
				if ($tot_row3 <= $tot_row4){
					$font_color = "red";
				}else{
					$font_color = "green";
				}
			}	
			echo "<td style='width:100' class='style_demand_child' align='right'><b><font color=" . $font_color . ">" . $tot_row4 . "</font></b></td>";
			if ($tot_row5 == 0){
				$font_color = "green";
			}else{
				if ($tot_row4 <= $tot_row5){
					$font_color = "red";
				}else{
					$font_color = "green";
				}
			}	
			echo "<td style='width:100' class='style_demand_child' align='right'><b><font color=" . $font_color . ">" . $tot_row5 . "</font></b></td>";
			if ($tot_row6 == 0){
				$font_color = "green";
			}else{
				if ($tot_row5 <= $tot_row6){
					$font_color = "red";
				}else{
					$font_color = "green";
				}
			}	
			echo "<td style='width:100' class='style_demand_child' align='right'><b><font color=" . $font_color . ">" . $tot_row6 . "</font></b></td>";
			if ($tot_row7 == 0){
				$font_color = "green";
			}else{
				if ($tot_row6 <= $tot_row7){
					$font_color = "red";
				}else{
					$font_color = "green";
				}
			}	
			echo "<td style='width:100' class='style_demand_child' align='right'><b><font color=" . $font_color . ">" . $tot_row7 . "</font></b></td>";
			if ($tot_row8 == 0){
				$font_color = "green";
			}else{
				if ($tot_row7 <= $tot_row8){
					$font_color = "red";
				}else{
					$font_color = "green";
				}
			}	
			echo "<td style='width:100' class='style_demand_child' align='right'><b><font color=" . $font_color . ">" . $tot_row8 . "</font></b></td>";
			if ($tot_row9 == 0){
				$font_color = "green";
			}else{
				if ($tot_row8 <= $tot_row9){
					$font_color = "red";
				}else{
					$font_color = "green";
				}
			}	
			echo "<td style='width:100' class='style_demand_child' align='right'><b><font color=" . $font_color . ">" . $tot_row9 . "</font></b></td>";
			if ($tot_row10 == 0){
				$font_color = "green";
			}else{
				if ($tot_row9 <= $tot_row10){
					$font_color = "red";
				}else{
					$font_color = "green";
				}
			}	
			echo "<td style='width:100' class='style_demand_child' align='right'><b><font color=" . $font_color . ">" . $tot_row10 . "</font></b></td>";
			if ($tot_row11 == 0){
				$font_color = "green";
			}else{
				if ($tot_row10 <= $tot_row11){
					$font_color = "red";
				}else{
					$font_color = "green";
				}
			}	
			echo "<td style='width:100' class='style_demand_child' align='right'><b><font color=" . $font_color . ">" . $tot_row11 . "</font></b></td>";
			if ($tot_row12 == 0){
				$font_color = "green";
			}else{
				if ($tot_row11 <= $tot_row12){
					$font_color = "red";
				}else{
					$font_color = "green";
				}
			}	
			echo "<td style='width:100' class='style_demand_child' align='right'><b><font color=" . $font_color . ">" . $tot_row12 . "</font></b></td>";
			if ($tot_row13 == 0){
				$font_color = "green";
			}else{
				if ($tot_row12 <= $tot_row13){
					$font_color = "red";
				}else{
					$font_color = "green";
				}
			}	
			echo "<td style='width:100' class='style_demand_child' align='right'><b><font color=" . $font_color . ">" . $tot_row13 . "</font></b></td>";
			if ($tot_row14 == 0){
				$font_color = "green";
			}else{
				if ($tot_row13 <= $tot_row14){
					$font_color = "red";
				}else{
					$font_color = "green";
				}
			}	
			echo "<td style='width:100' class='style_demand_child' align='right'><b><font color=" . $font_color . ">" . $tot_row14 . "</font></b></td>";
			echo "</tr>";				
		?>
	</table>	
	
	<br><br>
	<div id="container2" align="center" width="800px"></div>
	</div>
</body>
</html>