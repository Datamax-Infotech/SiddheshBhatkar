<?php
	session_start();
	require ("inc/header_session.php");
	require ("../mainfunctions/database.php");
	require ("../mainfunctions/general-functions.php");
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>LKQ COUPA Catalog Export Tool</title>
		<link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet"> 
		<link rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>
		<style>

			.coupa_title{

				font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif; 

				font-size: 22px;

				margin-bottom:4px;

				margin-top:0px;

			}

			.coupa_sub_heading{

				font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif; 

				font-size: 13px;

			}

			.coupa_tble{

				border-collapse: collapse; 

				width: 100%; 

				

			}

			.coupa_tble td, .coupa_tble th {

				border: 1px solid #FDFDFD;

				padding: 3px;

			}

			.coupa_tble tr th{

				font-size: 13px;

				font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;

				background: #98bcdf;

			}

			.coupa_tble tr:nth-child(even) td{

				font-size: 12px;

				font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;

				background: #EBEBEB;;

			}

			.coupa_tble tr:nth-child(odd) td{

				font-size: 12px;

				font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;

				background: #F7F7F7;

			}

		</style>
	</head>
	<body>
	<?php include("inc/header.php"); ?>
		<div class="main_data_css">
			<div class="dashboard_heading" style="float: left;">

				<div style="float: left;">

					LKQ COUPA Catalog Export Tool    

				<div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>

				<span class="tooltiptext">This report allows the user to create a new csv catalog file with the click of a button, which can be used to upload into the COUPA system so that COUPA customers know the inventory UCB has available.</span></div>

				<div style="height: 13px;">&nbsp;</div>

				</div>

			</div>

			<table cellpadding=0 cellspacing=0 width="100%" class="coupa_tble">
				<tr>

					<th colspan="6">COUPA process - History

						<a href="Coupa_csv_history.php" target="_blank" name="coupa_history" id="coupa_history">Show all History</a>

					</th>

				</tr>	
				<tr>

					<th>Date Created</th>

					<th>User Initial</th>

					<th>Total Gaylord Boxes</th>

					<th>FTL Gaylord Boxes</th>

					<th>Pallet Gaylord Boxes</th>

					<th>FTL Pallet Boxes</th>

				</tr>	
				<?php

					$history_qry = "Select * from coupa_export_history order by id desc limit 10";

					db();
					$history_data = db_query($history_qry);

					while($history_row=array_shift($history_data)){

				?>
				<tr>
					<td class="display_row"><?php echo $history_row["date_created"]; ?></td>

					<td class="display_row"><?php echo $history_row["userinitial"]; ?></td>

					<td class="display_row"><?php echo $history_row["total_gaylord_boxes"]; ?></td>

					<td class="display_row"><?php echo $history_row["FTL_gaylord_boxes"]; ?></td>

					<td class="display_row"><?php echo $history_row["PALLET_gaylord_boxes"]; ?></td>

					<td class="display_row"><?php echo $history_row["FTL_PAL_boxes"]; ?></td>
				</tr>	
				<?php

					}

				?>
			</table>
			<br><br>	
			<?php
				db();
				db_query("delete from export_coupa_csv_report");

				//and  inactive = 0 and b2b_status not in ('2.5', '2.6', '2.7') 

				$boxqry="select * from loop_boxes where (loop_boxes.type = 'Gaylord' or loop_boxes.type = 'GaylordUCB' or loop_boxes.type = 'PresoldGaylord' or loop_boxes.type = 'Loop') ";

				$boxres=db_query($boxqry);

				$boxnum=tep_db_num_rows($boxres);

				if($boxnum>0)

				{

				?>

				<a href="coupa_excel_export.php">Download CSV</a><br><br>
			<div>

			<table cellpadding=0 cellspacing=0 width="100%" class="coupa_tble">

			<tr>

				<th>Supplier Part Num*</th>

				<th>Supplier Aux Part Num</th>

				<th>Name*</th>

				<th>Tags*</th>

				<th>Description*</th>

				<th>Price*</th>

				<th>Currency*</th>

				<th>UOM code*</th>

				<th>Active*</th>

				<th>Item Classification Name</th>

				<th>UNSPSC Code</th>

				<th>Lead Time</th>

				<th>Manufacturer</th>

				<th>Contract Number</th>

				<th>Contract Term</th>

				<th>Image 0 Url</th>

				<th>Image 1 Url</th>

				<th>Image 2 Url</th>

				<th>Image 3 Url</th>

			</tr>

			<?php

			while($boxrow=array_shift($boxres)){

				$inv_b2b = "SELECT * FROM inventory where ID ='". $boxrow["b2b_id"]."' and 

				((tag = '10' or tag like '%,10' or tag like '%,10,%' or tag like '10,%')

				or (tag = '9' or tag like '%,9' or tag like '%,9,%' or tag like '9,%')

				or (tag = '8' or tag like '%,8' or tag like '%,8,%' or tag like '8,%')

				or (tag = '7' or tag like '%,7' or tag like '%,7,%' or tag like '7,%'))

				order by ID";

				db_b2b();
				$inv_tag_res = db_query($inv_b2b);

				$boxtagnum=tep_db_num_rows($inv_tag_res);

				if($boxtagnum>0)

				{

					while($inv_boxrow=array_shift($inv_tag_res)){

						//Supplier Part Num and Supplier Aux Part Num

						$supplier_part_num="UCB-".$inv_boxrow["ID"]."-FTL";

						$UOM_code="FTL";

						if($boxrow["ship_ltl"]==1)

						{

							$supplier_part_num_pal="UCB-".$inv_boxrow["ID"]."-PALLET";

							$UOM_code_pal="PF";

						}

						

						//Find Name

						$tag1='7';

						$tag2='8';

						$tag3='9';

						$tag4='10';

						//echo $inv_boxrow["tag"]."<br><br>";

						if (strpos($inv_boxrow["tag"], ',') !== false) {

							$tag=explode(",",$inv_boxrow["tag"]);

							//echo $inv_boxrow["tag"]."<br>";

							if (in_array($tag1, $tag, TRUE)) 

							{ 

								$tagid=$tag1;

							} 

							if (in_array($tag2, $tag, TRUE)) 

							{ 

								$tagid=$tag2;

							} 

							if (in_array($tag3, $tag, TRUE)) 

							{ 

								$tagid=$tag3;

							} 

							if (in_array($tag4, $tag, TRUE)) 

							{ 

								$tagid=$tag4;

							} 

						}

						else{

							$tagid=$inv_boxrow["tag"];

						}

						//echo $tagid."<br>";

						$tagqry="select * from loop_inv_tags where id='".$tagid."'";

						db();
						$tagres=db_query($tagqry);

						$tagrow=array_shift($tagres);

						if($tagrow["tags"]=="Coupa - Tall Gaylord"){

							$tagname="UCB Tall Gaylords";

						}

						if($tagrow["tags"]=="Coupa - Standard Gaylord"){

							$tagname="UCB Standard Gaylords";

						}

						if($tagrow["tags"]=="Coupa - Top Flaps Gaylord"){

							$tagname="UCB Top Flaps Gaylords";

						}

						if($tagrow["tags"]=="Coupa - Other Gaylords"){

							$tagname="UCB Other Gaylords";

						}

						//

						

						$UOM_code="FTL";

						$name = $tagname." - ".$inv_boxrow["location_state"] . " (Item #UCB-" . $inv_boxrow["ID"]."-FTL" . ")";

						$name_pal = "";

						if($boxrow["ship_ltl"]==1)

						{

							$name_pal = $tagname." - ".$inv_boxrow["location_state"] . " (Item #UCB-" . $inv_boxrow["ID"]."-PALLET" . ")";

						}

						

						//Active

						$b2b_status=$inv_boxrow["b2b_status"];

						if($b2b_status=="1.0"){

							$active="Yes";

						}

						else{

							$active="No";

						}

						/*$b2bstatus_array=array('2.5', '2.6', '2.7');

						if (in_array($b2b_status, $b2bstatus_array, TRUE)) 

						{ 

						 	$active="No";

						} 

						else{

							$active="Yes";

						}*/

						//Description

						$b2b_ulineDollar = $inv_boxrow["ulineDollar"];

						$b2b_ulineCents = $inv_boxrow["ulineCents"];

						$uniform_mixed_load = $boxrow["uniform_mixed_load"];

						if($uniform_mixed_load=="Mixed"){

							$blength_min = $boxrow["blength_min"];

							$blength_max = $boxrow["blength_max"];

							$bwidth_min = $boxrow["bwidth_min"];

							$bwidth_max = $boxrow["bwidth_max"];

							$bheight_min = $boxrow["bheight_min"];

							$bheight_max = $boxrow["bheight_max"];

							//

							//$box_desc=$blength_min."-".$blength_max."x".$bwidth_min."-".$bwidth_max."x".$bheight_min."-".$bheight_max;

							//

							//$bwall_min = $boxrow["bwall_min"];

							//$bwall_max = $boxrow["bwall_max"];

							//$box_desc.=" ".$bwall_min."-".$bwall_max."ply, ";

							

							if ($blength_min == $blength_max){

								$box_desc = floatval($blength_min). "x";

							}else{

								$box_desc = floatval($blength_min)."-".floatval($blength_max). "x";

							}

							if ($bwidth_min == $bwidth_max){

								$box_desc .= floatval($bwidth_min). "x";

							}else{

								$box_desc .= floatval($bwidth_min)."-".floatval($bwidth_max). "x";

							}

							if ($bheight_min == $bheight_max){

								$box_desc .= floatval($bheight_min). "x";

							}else{

								$box_desc .= floatval($bheight_min)."-".floatval($bheight_max);

							}

							//

							$bwall_min = $boxrow["bwall_min"];

							$bwall_max = $boxrow["bwall_max"];

							

							if ($bwall_min == $bwall_max){

								$box_desc .= " " . floatval($bwall_min). "ply, ";

							}else{

								$box_desc .= " ". floatval($bwall_min)."-".floatval($bwall_max)."ply, ";

							}							

							

							//Mixed Shape

							if($inv_boxrow["shape_rect"]+$inv_boxrow["shape_oct"]>1){

								$box_desc .= "Mixed Shape, ";

							}

							else{

								if($inv_boxrow["shape_rect"]==1){

									$box_desc .= "Rectangular, ";

								}

								if($inv_boxrow["shape_oct"]==1){

									$box_desc .= "Octagonal, ";

								}

							}

							

							//top config

							if(($inv_boxrow["top_nolid"]+$inv_boxrow["top_partial"]+$inv_boxrow["top_full"]+$inv_boxrow["top_remove"]+$inv_boxrow["top_spout"])>1)

							{

								$box_desc .= "Mixed Top, ";

							}

							else{

								//top config

								if($inv_boxrow["top_nolid"]==1)

								{

									$box_desc .= "No Top, ";

								}

								if($inv_boxrow["top_partial"]==1)

								{

									$box_desc .=  "Partial Flap Top, ";

								}

								if($inv_boxrow["top_full"]==1)

								{

									$box_desc .= "Full Flap Top, ";

								}

								if($inv_boxrow["top_remove"]==1)

								{

									$box_desc .= "Lid Top, ";

								}

								if($inv_boxrow["top_spout"]==1)

								{

									$box_desc .= "No Top, ";

								}

							}

							//bottom config

							if(($inv_boxrow["bottom_no"]+$inv_boxrow["bottom_partial"]+$inv_boxrow["bottom_partialsheet"]+$inv_boxrow["bottom_fullflap"]+$inv_boxrow["bottom_tray"]+$inv_boxrow["bottom_spout"]+$inv_boxrow["bottom_spiked"])>1)

							{

								$box_desc .= "Mixed Bottom, ";

							}

							else{

								if($inv_boxrow["bottom_no"]==1)

								{

									$box_desc .= "No Bottom, ";

								}

								if($inv_boxrow["bottom_partial"]==1)

								{

									$box_desc .=  "Partial Flap Bottom, ";

								}

								if($inv_boxrow["bottom_partialsheet"]==1)

								{

									$box_desc .= "Slip Sheet Bottom, ";

								}

								if($inv_boxrow["bottom_fullflap"]==1)

								{

									$box_desc .= "Full Flap Bottom, ";

								}

								if($inv_boxrow["bottom_tray"]==1)

								{

									$box_desc .= "Tray Bottom, ";

								}

								if($inv_boxrow["bottom_spout"]==1)

								{

									$box_desc .= "No Bottom, ";

								}

								if($inv_boxrow["bottom_spiked"]==1)

								{

									$box_desc .= "No Bottom, ";

								}

							}

							//Vents

							if($inv_boxrow["vents_yes"]+$inv_boxrow["vents_no"]>1)

							{

								$box_desc .= "Mixed Vents ";

							}

							else{

								if($inv_boxrow["vents_no"]==1)

								{

									$box_desc .= "";

								}

								if($inv_boxrow["vents_yes"]==1)

								{

									$box_desc .= "Vents, ";

								}

							}

							//

							/*if($boxrow["ship_ltl"]==1){

								$bdescription_pal=$box_desc;

							}

							$bdescription=$box_desc;*/

							//

						}

						else{

							$blength = $boxrow["blength"];

							$bwidth = $boxrow["bwidth"];

							$bheight = $boxrow["bdepth"];



							$blength_frac = $boxrow["blength_frac"];

							$bwidth_frac = $boxrow["bwidth_frac"];

							$bdepth_frac = $boxrow["bdepth_frac"];

							if($blength_frac!="")

							{

								$frac=explode("/",$blength_frac);

								$numerator=$frac[0];

								$denominator=$frac[1];



								//echo $blength_frac."<br>";

								$box_length=$blength+$numerator / $denominator;

							}

							else{

								$frac="";

								$box_length=$blength;

							}

							//box width fraction

							if($bwidth_frac!="")

							{

								$frac=explode("/",$bwidth_frac);

								$numerator=$frac[0];

								$denominator=$frac[1];

								$box_width=$bwidth+$numerator / $denominator;

							}

							else{

								$frac="";

								$box_width=$bwidth;

							}



						   //box height fraction

							if($bdepth_frac!="")

							{

								$frac=explode("/",$bdepth_frac);

								$numerator=$frac[0];

								$denominator=$frac[1];

								$box_height=$bheight+$numerator / $denominator;

							}

							else{

								$frac="";

								$box_height=$bheight;

							}

							//box size lxwxh

							$box_desc=$box_length."x".$box_width."x".$box_height." ";

							//box wall

							$bwall = $boxrow["bwall"];

							$bwall = preg_replace("(\n)", "<BR>", $bwall);

							$box_desc.=$bwall."ply, ";

							//box shape

							if($inv_boxrow["shape_rect"]==1){

								$box_desc .= "Rectangular, ";

							}

							if($inv_boxrow["shape_oct"]==1){

								$box_desc .= "Octagonal, ";

							}

							//top config

							if($inv_boxrow["top_nolid"]==1)

							{

								$box_desc .= "No Top, ";

							}

							if($inv_boxrow["top_partial"]==1)

							{

								$box_desc .=  "Partial Flap Top, ";

							}

							if($inv_boxrow["top_full"]==1)

							{

								$box_desc .= "Full Flap Top, ";

							}

							if($inv_boxrow["top_remove"]==1)

							{

								$box_desc .= "Lid Top, ";

							}

							if($inv_boxrow["top_spout"]==1)

							{

								$box_desc .= "No Top, ";

							}

							//bottom config

							if($inv_boxrow["bottom_no"]==1)

							{

								$box_desc .= "No Bottom, ";

							}

							if($inv_boxrow["bottom_partial"]==1)

							{

								$box_desc .=  "Partial Flap Bottom, ";

							}

							if($inv_boxrow["bottom_partialsheet"]==1)

							{

								$box_desc .= "Slip Sheet Bottom, ";

							}

							if($inv_boxrow["bottom_fullflap"]==1)

							{

								$box_desc .= "Full Flap Bottom, ";

							}

							if($inv_boxrow["bottom_tray"]==1)

							{

								$box_desc .= "Tray Bottom, ";

							}

							if($inv_boxrow["bottom_spout"]==1)

							{

								$box_desc .= "No Bottom, ";

							}

							if($inv_boxrow["bottom_spiked"]==1)

							{

								$box_desc .= "No Bottom, ";

							}

							//Vents

							if($inv_boxrow["vents_no"]==1)

							{

								$box_desc .= "";

							}

							if($inv_boxrow["vents_yes"]==1)

							{

								$box_desc .= "Vents, ";

							}

							

							//

						}//end else

						//Get quantity

							if($boxrow["ship_ltl"]==1){

								$qty_pallet=number_format($inv_boxrow["quantity_per_pallet"]);

							}

							$qty_ftl=number_format($inv_boxrow["quantity"]);

							//

							$fp=($b2b_ulineDollar + $b2b_ulineCents)*1.03;

							$fob="$" . number_format($fp,2);

							if($boxrow["ship_ltl"]==1){

								$fp_pal=($b2b_ulineDollar + $b2b_ulineCents + 6.00)*1.03;

								$fob_pal="$" . number_format($fp_pal,2);

							}

							//

							$leadtime=$boxrow["lead_time"]." days";

							//

							//Buy Now, Load Can Ship In

							$txt_after_po =$boxrow["after_po"];

							$boxes_per_trailer = $boxrow["boxes_per_trailer"];

							$estimated_next_load = 0; $display_lead_time = 0;

							if ($txt_after_po >= $boxes_per_trailer) {



								if ($boxrow["lead_time"] == 0){

									$estimated_next_load = 1 . " Day";

									$display_lead_time = 1;

								}

								if ($inv_boxrow["lead_time"] == 1){

									$estimated_next_load= $inv_boxrow["lead_time"] . " Day";

									$display_lead_time = $inv_boxrow["lead_time"];

								}							

								if ($inv_boxrow["lead_time"] > 1){

									$estimated_next_load= $inv_boxrow["lead_time"] . " Days";

									$display_lead_time = $inv_boxrow["lead_time"];

								}	

								

							}

							else{

								if (($boxrow["expected_loads_per_mo"] <= 0) && ($txt_after_po < $boxes_per_trailer)){

									$estimated_next_load= 0;

									$display_lead_time = 0;

								}else{

									/*$estimated_next_load = (ceil((((($txt_after_po/$boxes_per_trailer)*-1)+1)/$boxrow["expected_loads_per_mo"])*4))/7;

									echo $boxrow["b2b_id"]."estim=".$estimated_next_load."<br>";

									$dayRemainder = $estimated_next_load % 7;

									echo "dateremainder:-".$dayRemainder."<br>";

									$estimated_next_load = ceil($estimated_next_load + $dayRemainder);*/

									

									$estimated_next_load1=ceil((((($txt_after_po/$boxes_per_trailer)*-1)+1)/$boxrow["expected_loads_per_mo"])*4);

									$estimated_next_load2=$estimated_next_load1*7;

									$estimated_next_load=$estimated_next_load2." Days";

									$display_lead_time = $estimated_next_load2;

								}

							}



							if ($txt_after_po == 0 && $boxrow["expected_loads_per_mo"] == 0 ) {

								$estimated_next_load= 0;

								$display_lead_time = 0;

							}

							//

							if($boxrow["lead_time"]==0){

								$box_lead_time="0";

							}

							if($boxrow["lead_time"]==1){

								$box_lead_time=$boxrow["lead_time"]." day";

							}

							if($boxrow["lead_time"]>1){

								$box_lead_time=$boxrow["lead_time"]." days";

							}

							//

							//

							if($boxrow["ship_ltl"]==1){

								$bdescription_pal=$box_desc."".$qty_pallet."/Pallet, ".$fob_pal." ea. - Lead Time: ". $estimated_next_load;

							}

							$bdescription=$box_desc."".$qty_ftl."/TL, ".$fob." ea. - Lead Time: ". $estimated_next_load;

						//End description

						//Calculate Price

						if($boxrow["ship_ltl"]==1){

							$qty_pal=$inv_boxrow["quantity_per_pallet"];

							$min_fob_p=$b2b_ulineDollar + $b2b_ulineCents + 6.00;

							$price_pal1=$qty_pal*$min_fob_p;

							//$price_pal=$price_pal1*1.03;

					

							$price_pal = str_replace(",","",str_replace("$","",$fob_pal)) * str_replace(",","",str_replace("$","",$qty_pallet));

							$price_pal = round($price_pal, 2);

						}

						$bqty=$inv_boxrow["quantity"];

						$min_fob=$b2b_ulineDollar + $b2b_ulineCents;

						$price=$bqty*$min_fob;

						//

						$pp=$price*1.03;

						//$price_final= round($pp,2);

						

						$price_final = str_replace(",","",str_replace("$","", $fob)) * str_replace(",","",str_replace("$","",$qty_ftl));

						$price_final = round($price_final, 2);

						

						if($display_lead_time > 30){

							$active="No";

						}

						

						$box_warehouse_id = $boxrow["box_warehouse_id"];

						$b2b_location_st = "";

						if ($inv_boxrow["vendor_b2b_rescue"] != "" && $box_warehouse_id=="238"){

							$q1 = "SELECT * FROM loop_warehouse where id = ".$inv_boxrow["vendor_b2b_rescue"];

							db();
							$v_query = db_query($q1);

							while($v_fetch = array_shift($v_query))

							{
								db_b2b();
								$com_qry=db_query("select * from companyInfo where ID='".$v_fetch["b2bid"]."'");

								$com_row= array_shift($com_qry);

								$b2b_location_st = $com_row["shipState"];

							}

						}

						elseif($box_warehouse_id>0 && $box_warehouse_id!="238"){

							db();
							$lwqry = db_query("Select * from loop_warehouse where id = ".$box_warehouse_id);

							while ($lwrow = array_shift($lwqry))

							{

								$b2b_location_st = $lwrow["warehouse_state"]; 

							}

						}	



						$state_and_surrounding_state_str = ""; $state_and_surrounding_state_str1 = "";

						$q1 = "SELECT * FROM state_surrounding_state_master where state = '". $b2b_location_st . "' order by unqid";

						db_b2b();
						$v_query = db_query($q1);

						while($v_fetch = array_shift($v_query))

						{

							$state_and_surrounding_state_str1 = $v_fetch["state_full_name"] . " " . $v_fetch["state"];

							$state_and_surrounding_state_str .= $v_fetch["surrounding_state_full_name"] . " " . $v_fetch["surrounding_state"] . " ";

						}

						if (trim($state_and_surrounding_state_str) != "")

						{

							$state_and_surrounding_state_str = trim($state_and_surrounding_state_str1 . " " . trim($state_and_surrounding_state_str));

						}						

								

				?>

					<tr>

						<td class="display_row"><?php echo $supplier_part_num; ?></td>

						<td><?php echo $supplier_part_num; ?></td>

						<td><?php echo $name; ?></td>

						<td><?php echo $state_and_surrounding_state_str; ?></td>

						<td><?php echo $bdescription; ?></td>

						<td><?php echo $price_final; ?></td>

						<td>USD</td>

						<td><?php echo $UOM_code; ?></td>

						<td><?php echo $active; ?></td>

						<td>Gaylord Tote Boxes</td>

						<td><?php echo $display_lead_time; ?></td>

						<td>UsedCardboardBoxes.com</td>

						<td></td>

						<td></td>

						<td><?php if($boxrow["bpic_1"] != '') { echo $boxrow["bpic_1"]; } ?> </td>

						<td><?php if($boxrow["bpic_2"] != '') { echo $boxrow["bpic_2"]; } ?></td>

						<td><?php if($boxrow["bpic_3"] != '') { echo $boxrow["bpic_3"]; } ?></td>

						<td><?php if($boxrow["bpic_4"] != '') { echo $boxrow["bpic_4"]; } ?></td>

					</tr>	

				<?php
						//

						$export_tbl_qry="INSERT INTO `export_coupa_csv_report` (box_b2bid, `state_surrounding` , `supplier_part_num`, `supplier_aux_part_num`, `box_name`, `description`, `price`, `currency`, `UOM_code`, `active`, `item_classification_name`, `UNSPSC_code`, `lead_time`, `manufacturer`, `contract_number`, `contract_team`, `savings`, `Price_tier1`, `Price_tier2`, `Price_tier3`, `Price_tier4`, `Price_tier5`, `Price_tier6`, `Price_tier7`, `Price_tier8`, `Price_tier9`, `Price_tier10`, `Price_tier11`, `Price_tier12`, `Price_tier13`, `Price_tier14`, `Price_tier15`, `Price_tier16`, `Price_tier17`, `Price_tier18`, `Price_tier19`, `Price_tier20`, `image_url`, `link0_title`, `link0_url`, `link1_title`, `link1_url`, `link2_title`, `link2_url`, `link3_title`, `link3_url`, `link4_title`, `link4_url`, `link5_title`, `link5_url`, `image0_url`, `image1_url`, `image2_url`, `image3_url`, `image4_url`, `image5_url`, `use_pack_weight`, `pack_quantity`, `pack_weight`, `pack_weight_UOM`, `receive_catch_weight`, `item_number`) VALUES ('".$inv_boxrow["ID"]."', '". $state_and_surrounding_state_str . "', '".$supplier_part_num."', '".$supplier_part_num."', '".$name."', '".$bdescription."', '".$price_final."', 'USD', '".$UOM_code."', '".$active."', 'Gaylord Tote Boxes', '', '".$display_lead_time."', 'UsedCardboardBoxes.com', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '".$boxrow["bpic_1"]."', '".$boxrow["bpic_2"]."', '".$boxrow["bpic_3"]."', '".$boxrow["bpic_4"]."', '', '', '', '', '', '', '', '')";

						db();
						$exprot_box_res=db_query($export_tbl_qry);

						//

						if($boxrow["ship_ltl"]==1){

							$price_pal_final= round($price_pal,2);

				?>

					<tr>

						<td class="display_row"><?php echo $supplier_part_num_pal; ?></td>

						<td><?php echo $supplier_part_num_pal; ?></td>

						<td><?php echo $name_pal; ?></td>

						<td><?php echo $state_and_surrounding_state_str; ?></td>

						<td><?php echo $bdescription_pal; ?></td>

						<td><?php echo $price_pal_final; ?></td>

						<td>USD</td>

						<td><?php echo $UOM_code_pal; ?></td>

						<td><?php echo $active; ?></td>

						<td>Gaylord Tote Boxes</td>

						<td></td>

						<td><?php echo $display_lead_time; ?></td>

						<td>UsedCardboardBoxes.com</td>

						<td></td>

						<td></td>

						<td><?php if($boxrow["bpic_1"] != '') { echo $boxrow["bpic_1"]; } ?> </td>

						<td><?php if($boxrow["bpic_2"] != '') { echo $boxrow["bpic_2"]; } ?></td>

						<td><?php if($boxrow["bpic_3"] != '') { echo $boxrow["bpic_3"]; } ?></td>

						<td><?php if($boxrow["bpic_4"] != '') { echo $boxrow["bpic_4"]; } ?></td>

					</tr>	

			<?php

							$export_tbl_qry="INSERT INTO `export_coupa_csv_report` ( box_b2bid, `state_surrounding`, `supplier_part_num`, `supplier_aux_part_num`, `box_name`, `description`, `price`, `currency`, `UOM_code`, `active`, `item_classification_name`, `UNSPSC_code`, `lead_time`, `manufacturer`, `contract_number`, `contract_team`, `savings`, `Price_tier1`, `Price_tier2`, `Price_tier3`, `Price_tier4`, `Price_tier5`, `Price_tier6`, `Price_tier7`, `Price_tier8`, `Price_tier9`, `Price_tier10`, `Price_tier11`, `Price_tier12`, `Price_tier13`, `Price_tier14`, `Price_tier15`, `Price_tier16`, `Price_tier17`, `Price_tier18`, `Price_tier19`, `Price_tier20`, `image_url`, `link0_title`, `link0_url`, `link1_title`, `link1_url`, `link2_title`, `link2_url`, `link3_title`, `link3_url`, `link4_title`, `link4_url`, `link5_title`, `link5_url`, `image0_url`, `image1_url`, `image2_url`, `image3_url`, `image4_url`, `image5_url`, `use_pack_weight`, `pack_quantity`, `pack_weight`, `pack_weight_UOM`, `receive_catch_weight`, `item_number`) VALUES ('".$inv_boxrow["ID"]."', '". $state_and_surrounding_state_str . "', '".$supplier_part_num_pal."', '".$supplier_part_num_pal."', '".$name_pal."', '".$bdescription_pal."', '".$price_pal_final."', 'USD', '".$UOM_code_pal."', '".$active."', 'Gaylord Tote Boxes', '', '".$display_lead_time."', 'UsedCardboardBoxes.com', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '".$boxrow["bpic_1"]."', '".$boxrow["bpic_2"]."', '".$boxrow["bpic_3"]."', '".$boxrow["bpic_4"]."', '', '', '', '', '', '', '', '')";

							db();
							$exprot_box_res=db_query($export_tbl_qry);

						

						}

						

					}

				}

			}

			

				//To add record 

				$export_tbl_qry="INSERT INTO `export_coupa_csv_report` (box_b2bid, `state_surrounding` , `supplier_part_num`, `supplier_aux_part_num`, 

				`box_name`, `description`, `price`, `currency`, `UOM_code`, `active`, `item_classification_name`, `UNSPSC_code`, `lead_time`, `manufacturer`, 

				`contract_number`, `contract_team`, `savings`, `Price_tier1`, `Price_tier2`, `Price_tier3`, `Price_tier4`, `Price_tier5`, `Price_tier6`, `Price_tier7`, `Price_tier8`, 

				`Price_tier9`, `Price_tier10`, `Price_tier11`, `Price_tier12`, `Price_tier13`, `Price_tier14`, `Price_tier15`, `Price_tier16`, `Price_tier17`, `Price_tier18`, `Price_tier19`, `Price_tier20`, 

				`image_url`, `link0_title`, `link0_url`, `link1_title`, `link1_url`, `link2_title`, `link2_url`, `link3_title`, `link3_url`, `link4_title`, `link4_url`, `link5_title`, `link5_url`, `image0_url`, 

				`image1_url`, `image2_url`, `image3_url`, `image4_url`, `image5_url`, `use_pack_weight`, `pack_quantity`, `pack_weight`, `pack_weight_UOM`, `receive_catch_weight`, 

				`item_number`) VALUES ('9999', '', 'UCB-StandardPallet-FTL', 'UCB-StandardPallet-FTL', 'UCB Standard 4-way Pallet (FTL)', '48x40 Standard 4-way Stringer Pallet, 540/TL, $20.00 ea. - Lead Time: 14 Days',

				'10800', 'USD', 'FTL', 'Yes', 'Whitewood Pallets', '', '14', 'UsedCardboardBoxes.com', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '',

				'', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '125_Box_pic_1',

				'125_Box_pic_2', '125_Box_pic_3', 

				'125_Box_pic_4', '', '', '', '', '', '', '', '')";

				db();
				$exprot_box_res = db_query($export_tbl_qry);

				$export_tbl_qry="INSERT INTO `export_coupa_csv_report` (box_b2bid, `state_surrounding` , `supplier_part_num`, `supplier_aux_part_num`, 

				`box_name`, `description`, `price`, `currency`, `UOM_code`, `active`, `item_classification_name`, `UNSPSC_code`, `lead_time`, `manufacturer`, 

				`contract_number`, `contract_team`, `savings`, `Price_tier1`, `Price_tier2`, `Price_tier3`, `Price_tier4`, `Price_tier5`, `Price_tier6`, `Price_tier7`, `Price_tier8`, 

				`Price_tier9`, `Price_tier10`, `Price_tier11`, `Price_tier12`, `Price_tier13`, `Price_tier14`, `Price_tier15`, `Price_tier16`, `Price_tier17`, `Price_tier18`, `Price_tier19`, `Price_tier20`, 

				`image_url`, `link0_title`, `link0_url`, `link1_title`, `link1_url`, `link2_title`, `link2_url`, `link3_title`, `link3_url`, `link4_title`, `link4_url`, `link5_title`, `link5_url`, `image0_url`, 

				`image1_url`, `image2_url`, `image3_url`, `image4_url`, `image5_url`, `use_pack_weight`, `pack_quantity`, `pack_weight`, `pack_weight_UOM`, `receive_catch_weight`, 

				`item_number`) VALUES ('9991', '', 'UCB-StandardPallet-STACK', 'UCB-StandardPallet-STACK', 'UCB Standard 4-way Pallet (STACK)', '48x40 Standard 4-way Stringer Pallet, 18/stack, $23.50 ea. - Lead Time: 14 Days',

				'423', 'USD', 'PF', 'Yes', 'Whitewood Pallets', '', '14', 'UsedCardboardBoxes.com', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '',

				'', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '125_Box_pic_1',

				'125_Box_pic_2', '125_Box_pic_3', 

				'125_Box_pic_4', '', '', '', '', '', '', '', '')";

				db();
				$exprot_box_res = db_query($export_tbl_qry);

				$export_tbl_qry="INSERT INTO `export_coupa_csv_report` (box_b2bid, `state_surrounding` , `supplier_part_num`, `supplier_aux_part_num`, 

				`box_name`, `description`, `price`, `currency`, `UOM_code`, `active`, `item_classification_name`, `UNSPSC_code`, `lead_time`, `manufacturer`, 

				`contract_number`, `contract_team`, `savings`, `Price_tier1`, `Price_tier2`, `Price_tier3`, `Price_tier4`, `Price_tier5`, `Price_tier6`, `Price_tier7`, `Price_tier8`, 

				`Price_tier9`, `Price_tier10`, `Price_tier11`, `Price_tier12`, `Price_tier13`, `Price_tier14`, `Price_tier15`, `Price_tier16`, `Price_tier17`, `Price_tier18`, `Price_tier19`, `Price_tier20`, 

				`image_url`, `link0_title`, `link0_url`, `link1_title`, `link1_url`, `link2_title`, `link2_url`, `link3_title`, `link3_url`, `link4_title`, `link4_url`, `link5_title`, `link5_url`, `image0_url`, 

				`image1_url`, `image2_url`, `image3_url`, `image4_url`, `image5_url`, `use_pack_weight`, `pack_quantity`, `pack_weight`, `pack_weight_UOM`, `receive_catch_weight`, 

				`item_number`) VALUES ('9992', '', 'UCB-HeatPallet-FTL', 'UCB-HeatPallet-FTL', 'UCB Heat Treated 4-way Pallet (FTL)', '48x40 Heat Treated 4-way Stringer Pallet, 540/TL, $22.50 ea. - Lead Time: 14 Days',

				'12150', 'USD', 'FTL', 'Yes', 'Whitewood Pallets', '', '14', 'UsedCardboardBoxes.com', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '',

				'', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '125_Box_pic_1',

				'125_Box_pic_2', '125_Box_pic_3', 

				'125_Box_pic_4', '', '', '', '', '', '', '', '')";

				db();
				$exprot_box_res = db_query($export_tbl_qry);

				$export_tbl_qry="INSERT INTO `export_coupa_csv_report` (box_b2bid, `state_surrounding` , `supplier_part_num`, `supplier_aux_part_num`, 

				`box_name`, `description`, `price`, `currency`, `UOM_code`, `active`, `item_classification_name`, `UNSPSC_code`, `lead_time`, `manufacturer`, 

				`contract_number`, `contract_team`, `savings`, `Price_tier1`, `Price_tier2`, `Price_tier3`, `Price_tier4`, `Price_tier5`, `Price_tier6`, `Price_tier7`, `Price_tier8`, 

				`Price_tier9`, `Price_tier10`, `Price_tier11`, `Price_tier12`, `Price_tier13`, `Price_tier14`, `Price_tier15`, `Price_tier16`, `Price_tier17`, `Price_tier18`, `Price_tier19`, `Price_tier20`, 

				`image_url`, `link0_title`, `link0_url`, `link1_title`, `link1_url`, `link2_title`, `link2_url`, `link3_title`, `link3_url`, `link4_title`, `link4_url`, `link5_title`, `link5_url`, `image0_url`, 

				`image1_url`, `image2_url`, `image3_url`, `image4_url`, `image5_url`, `use_pack_weight`, `pack_quantity`, `pack_weight`, `pack_weight_UOM`, `receive_catch_weight`, 

				`item_number`) VALUES ('9993', '', 'UCB-HeatPallet-STACK', 'UCB-HeatPallet-STACK', 'UCB Heat Treated 4-way Pallet (STACK)', '48x40 Heat Treated 4-way Stringer Pallet, 18/stack, $25.50 ea. - Lead Time: 14 Days',

				'459', 'USD', 'PF', 'Yes', 'Whitewood Pallets', '', '14', 'UsedCardboardBoxes.com', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '',

				'', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '125_Box_pic_1',

				'125_Box_pic_2', '125_Box_pic_3', 

				'125_Box_pic_4', '', '', '', '', '', '', '', '')";

				db();
				$exprot_box_res= db_query($export_tbl_qry);

				$q1 = "SELECT * FROM export_coupa_csv_report where box_b2bid in (9999, 9991, 9992, 9993)";

				db();
				$v_query = db_query($q1);

				while($v_fetch = array_shift($v_query))

				{

				

			?>

					<tr>

						<td class="display_row"><?php echo $v_fetch["supplier_part_num"]; ?></td>

						<td><?php echo $v_fetch["supplier_aux_part_num"]; ?></td>

						<td><?php echo $v_fetch["box_name"]; ?></td>

						<td>&nbsp;</td>

						<td><?php echo $v_fetch["description"]; ?></td>

						<td><?php echo $v_fetch["price"]; ?></td>

						<td>USD</td>

						<td><?php echo $v_fetch["UOM_code"]; ?></td>

						<td><?php echo $v_fetch["active"]; ?></td>

						<td>Gaylord Tote Boxes</td>

						<td></td>

						<td><?php echo $v_fetch["lead_time"]; ?></td>

						<td>UsedCardboardBoxes.com</td>

						<td></td>

						<td></td>

						<td>125_Box_pic_1</td>

						<td>125_Box_pic_2</td>

						<td>125_Box_pic_3</td>

						<td>125_Box_pic_4</td>

					</tr>	

			<?php }?>		

		</table>

	</div>

	<?php

	}

	?>

	</div>

</body>

</html>