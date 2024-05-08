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
		<title>Schnitzer Steel Catalog Export Tool</title>
		<link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet"> 
		<link rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>

		<style>

			.jaggaer_title{

				font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif; 

				font-size: 22px;

				margin-bottom:4px;

				margin-top:0px;

			}

			.jaggaer_sub_heading{

				font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif; 

				font-size: 13px;

			}

			.jaggaer_tble{

				border-collapse: collapse; 

				width: 100%; 

				

			}

			.jaggaer_tble td, .jaggaer_tble th {

				border: 1px solid #FDFDFD;

				padding: 3px;

			}

			.jaggaer_tble tr th{

				font-size: 13px;

				font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;

				background: #98bcdf;

			}

			.jaggaer_tble tr:nth-child(even) td{

				font-size: 12px;

				font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;

				background: #EBEBEB;;

			}

			.jaggaer_tble tr:nth-child(odd) td{

				font-size: 12px;

				font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;

				background: #F7F7F7;

			}

		</style>
	</head>
	<body>
		<?php

			function showtables($East_West_flg) {

				$boxqry="Select * from loop_boxes where (loop_boxes.type = 'Gaylord' or loop_boxes.type = 'GaylordUCB' or loop_boxes.type = 'PresoldGaylord' or loop_boxes.type = 'Loop') group by b2b_id";

				db();
				$boxres=db_query($boxqry);

				$boxnum=tep_db_num_rows($boxres);

				if($boxnum>0)

				{

				

				echo "<div>

				<table cellpadding=0 cellspacing=0 width='100%' class='jaggaer_tble'>

					<tr>

						<th colspan='14'>$East_West_flg Catalog</th>

					</tr>

					<tr>

						<th>Category</th>

						<th>UNSPSC</th>

						<th>Part Number</th>

						<th>Product Description</th>

						<th>Packaging UOM</th>

						<th>Product Size</th>

						<th>Manufacturer Name</th>

						<th>Manufacturer Part Number</th>

						<th>Lead Time</th>

						<th>Image URL</th>

						<th>More Information URL</th>

						<th>Searchable Keywords</th>

						<th>Long Description</th>

						<th>Brand</th>

					</tr>";

					

					while($boxrow=array_shift($boxres)){

						if ($East_West_flg == "West"){

							$inv_b2b = "SELECT * FROM inventory where ID ='". $boxrow["b2b_id"]."' and (tag like '%36%' or tag like '%38%' or tag like '%40%' or tag like '%43%') group by ID order by ID";

						}	

						if ($East_West_flg == "East"){

							$inv_b2b = "SELECT * FROM inventory where ID ='". $boxrow["b2b_id"]."' and (tag like '%35%' or tag like '%37%' or tag like '%39%' or tag like '%41%') group by ID order by ID";

						}	

						db_b2b();

						$inv_tag_res = db_query($inv_b2b);

						$boxtagnum=tep_db_num_rows($inv_tag_res);

						if($boxtagnum>0)

						{

							while($inv_boxrow=array_shift($inv_tag_res)){

								//Supplier Part Num and Supplier Aux Part Num

								$supplier_part_num_mfg ="UCB-".$inv_boxrow["ID"]."-FTL";

								$supplier_part_num = $inv_boxrow["schnitzer_ftl"];

								

								$UOM_code="Full Truckload";

								if($boxrow["ship_ltl"]==1)

								{

									$supplier_part_num_pal_mfg ="UCB-".$inv_boxrow["ID"]."-PALLET";

									$supplier_part_num_pal = $inv_boxrow["schnitzer_pallet"];

									$UOM_code_pal="1 Pallet";

								}

								

								$box_category= "Boxes";

								$box_UNSPSC = "24113100";

								$box_searchable_keyword = "gaylord, gaylords, used, cardboard, box, boxes, package, packages, packaging, tote, totes";



								$box_category_pal = "Wood Pallet";

								$box_UNSPSC_pal = "24112701";

								$box_searchable_keyword_pal = "used, pallet, pallets";

								

								//Find Name

								if ($East_West_flg == "West"){						

									$tag1='36';

									$tag2='38';

									$tag3='40';

									$tag4='43';

								}	

								if ($East_West_flg == "East"){						

									$tag1='35';

									$tag2='37';

									$tag3='39';

									$tag4='41';

								}	

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

								if ($East_West_flg == "West"){												

									if($tagrow["tags"]=="Schnitzer West - Top Flaps Gaylord"){

										$tagname="UCB Top Flaps Gaylord";

									}

									if($tagrow["tags"]=="Schnitzer West - Resin Gaylord"){

										$tagname="UCB Resin Gaylord";

									}

									if($tagrow["tags"]=="Schnitzer West - Standard Gaylord"){

										$tagname="UCB Standard Gaylord";

									}

									if($tagrow["tags"]=="Schnitzer West - Tall Gaylord"){

										$tagname="UCB Tall Gaylord";

									}

								}	



								if ($East_West_flg == "East"){												

									if($tagrow["tags"]=="Schnitzer East - Top Flaps Gaylord"){

										$tagname="UCB Top Flaps Gaylord";

									}

									if($tagrow["tags"]=="Schnitzer East - Resin Gaylord"){

										$tagname="UCB Resin Gaylord";

									}

									if($tagrow["tags"]=="Schnitzer East - Standard Gaylord"){

										$tagname="UCB Standard Gaylord";

									}

									if($tagrow["tags"]=="Schnitzer East - Tall Gaylord"){

										$tagname="UCB Tall Gaylord";

									}

								}	

								//

								

								$UOM_code="Full Truckload";

								$name = $tagname." - ".$inv_boxrow["location_state"] . " (" . $inv_boxrow["ID"]."-FTL" . ")";

								$name_pal = "";

								if($boxrow["ship_ltl"]==1)

								{

									$name_pal = $tagname." - ".$inv_boxrow["location_state"] . " (" . $inv_boxrow["ID"]."-PALLET" . ")";

								}

								

								//Active

								$b2b_status=$inv_boxrow["b2b_status"];

								if($b2b_status=="1.0"){

									$active="Yes";

								}

								else{

									$active="No";

								}



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

									$fob_save = number_format($fp,2);

									if($boxrow["ship_ltl"]==1){

										$fp_pal=($b2b_ulineDollar + $b2b_ulineCents + 6.00)*1.03;

										$fob_pal="$" . number_format($fp_pal,2);

										$fob_save_pal= number_format($fp_pal,2);

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

										//$bdescription_pal = $name_pal . ", ". $qty_pallet."/Pallet, ".$fob_pal." ea. - Lead Time: ". $estimated_next_load;

										$bdescription_pal = $name_pal . ", ". $qty_pallet."/Pallet";

										//$long_dscription_pal = $box_desc."".$qty_pallet."/Pallet, ".$fob_pal." ea. - Lead Time: ". $estimated_next_load;

										$long_dscription_pal = $name_pal . " " . $box_desc."".$qty_pallet."/Pallet";

									}

									//$bdescription = $name . ", ". $qty_ftl."/TL, ".$fob." ea. - Lead Time: ". $estimated_next_load;

									$bdescription = $name . ", ". $qty_ftl."/TL (1 Lot = " . $qty_ftl . " gaylords)";

									

									//$long_dscription = $box_desc."".$qty_ftl."/TL, ".$fob." ea. - Lead Time: ". $estimated_next_load;

									$long_dscription = $name . " " . $box_desc."".$qty_ftl."/TL";

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

										

							echo "<tr>

								<td class='display_row'>" . $box_category . "</td>

								<td>" . $box_UNSPSC . "</td>

								<td>" . $supplier_part_num . "</td>

								<td>" . $bdescription . "</td>

								<td>" . $UOM_code . "</td>

								<td>" . $UOM_code . "</td>

								<td>" . 'UsedCardboardBoxes.com' . "</td>

								<td>" . $supplier_part_num_mfg . "</td>

								<td>" . $estimated_next_load . "</td>

								<td>";

								

									if($boxrow['bpic_1'] != '') { echo 'https://loops.usedcardboardboxes.com/boxpics/'. $boxrow['bpic_1']; }

								

								echo "</td><td>https://www.usedcardboardboxes.com</td>

								<td>" . $box_searchable_keyword . "</td>

								<td>" . $long_dscription . "</td>

								<td>" . 'UsedCardboardBoxes.com' . "</td>

							</tr>";

							

								//

								$export_tbl_qry="INSERT INTO `export_jaggaer_csv_report` (East_West_Flg, box_searchable_keyword, box_category, box_b2bid, `state_surrounding` , `supplier_part_num`, `supplier_aux_part_num`, 

								`box_name`, `description`, long_desc, `price`, `currency`, `UOM_code`, `active`, `item_classification_name`, `UNSPSC_code`, `lead_time`, fob, 

								`manufacturer`, `contract_number`, `contract_team`, `savings`, `Price_tier1`, `Price_tier2`, `Price_tier3`, `Price_tier4`, 

								`Price_tier5`, `Price_tier6`, `Price_tier7`, `Price_tier8`, `Price_tier9`, `Price_tier10`, `Price_tier11`, `Price_tier12`, 

								`Price_tier13`, `Price_tier14`, `Price_tier15`, `Price_tier16`, `Price_tier17`, `Price_tier18`, `Price_tier19`, `Price_tier20`, `image_url`, 

								`link0_title`, `link0_url`, `link1_title`, `link1_url`, `link2_title`, `link2_url`, `link3_title`, `link3_url`, `link4_title`, `link4_url`, 

								`link5_title`, `link5_url`, `image0_url`, `image1_url`, `image2_url`, `image3_url`, `image4_url`, `image5_url`, `use_pack_weight`, 

								`pack_quantity`, `pack_weight`, `pack_weight_UOM`, `receive_catch_weight`, `item_number`) VALUES 

								('$East_West_flg', '".$box_searchable_keyword."','".$box_category."','".$inv_boxrow["ID"]."', '". $state_and_surrounding_state_str . "', '".$supplier_part_num."', '".$supplier_part_num_mfg."', '".$name."', '".$bdescription."', '".$long_dscription."', 

								'".$price_final."', 'USD', '".$UOM_code."', '".$active."', 'Gaylord Tote Boxes', '" . $box_UNSPSC . "', '".$estimated_next_load."', '". $fob_save ."', 

								'UsedCardboardBoxes.com', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 

								'".$boxrow["bpic_1"]."', '".$boxrow["bpic_2"]."', '".$boxrow["bpic_3"]."', '".$boxrow["bpic_4"]."', '', '', '', '', '', '', '', '')";

								
								db();
								$exprot_box_res=db_query($export_tbl_qry);

								//

								if($boxrow["ship_ltl"]==1){

									$price_pal_final= round($price_pal,2);

						

							echo "<tr>

								<td class='display_row'>" . $box_category . "</td>

								<td>" . $box_UNSPSC . "</td>

								<td>" . $supplier_part_num_pal . "</td>

								<td>" . $bdescription_pal . "</td>

								<td>" . $UOM_code_pal . "</td>

								<td>" . $UOM_code_pal . "</td>

								<td>" . 'UsedCardboardBoxes.com' . "</td>

								<td>" . $supplier_part_num_pal_mfg . "</td>

								<td>" . $estimated_next_load . "</td>

								<td>";

								

								if($boxrow['bpic_1'] != '') { echo 'https://loops.usedcardboardboxes.com/boxpics/' . $boxrow['bpic_1']; }

								

							echo "</td>

								<td>" . 'https://www.usedcardboardboxes.com' . "</td>

								<td>" . $box_searchable_keyword . "</td>

								<td>" . $long_dscription_pal . "</td>

								<td>" . 'UsedCardboardBoxes.com' . "</td>

							</tr>";	

					

									$export_tbl_qry="INSERT INTO `export_jaggaer_csv_report` (East_West_Flg, box_searchable_keyword, box_category, box_b2bid, `state_surrounding`, `supplier_part_num`, `supplier_aux_part_num`, `box_name`, 

									`description`, long_desc , `price`, `currency`, `UOM_code`, `active`, `item_classification_name`, `UNSPSC_code`, `lead_time`, fob,`manufacturer`, `contract_number`, 

									`contract_team`, `savings`, `Price_tier1`, `Price_tier2`, `Price_tier3`, `Price_tier4`, `Price_tier5`, `Price_tier6`, `Price_tier7`, `Price_tier8`, `Price_tier9`, 

									`Price_tier10`, `Price_tier11`, `Price_tier12`, `Price_tier13`, `Price_tier14`, `Price_tier15`, `Price_tier16`, `Price_tier17`, `Price_tier18`, `Price_tier19`, 

									`Price_tier20`, `image_url`, `link0_title`, `link0_url`, `link1_title`, `link1_url`, `link2_title`, `link2_url`, `link3_title`, `link3_url`, `link4_title`, `link4_url`, 

									`link5_title`, `link5_url`, `image0_url`, `image1_url`, `image2_url`, `image3_url`, `image4_url`, `image5_url`, `use_pack_weight`, `pack_quantity`, 

									`pack_weight`, `pack_weight_UOM`, `receive_catch_weight`, `item_number`) VALUES 

									('$East_West_flg', '".$box_searchable_keyword."','".$box_category."','".$inv_boxrow["ID"]."', '". $state_and_surrounding_state_str . "', 

									'".$supplier_part_num_pal."', '".$supplier_part_num_pal_mfg."', '".$name_pal."', '".$bdescription_pal."', '" . $long_dscription_pal . "', 

									'".$price_pal_final."', 'USD', '".$UOM_code_pal."', '".$active."', 'Gaylord Tote Boxes', '" . $box_UNSPSC . "', '".$estimated_next_load."', '".$fob_save_pal."', 'UsedCardboardBoxes.com', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '".$boxrow["bpic_1"]."', '".$boxrow["bpic_2"]."', '".$boxrow["bpic_3"]."', '".$boxrow["bpic_4"]."', '', '', '', '', '', '', '', '')";

									
									db();
									$exprot_box_res=db_query($export_tbl_qry);

								

								}

								

							}

						}

					}

					

					//this is not to insert twice

						$q1 = "SELECT * FROM export_jaggaer_csv_report where box_b2bid in (9999, 9991, 9992, 9993)";

						db();
						$v_query = db_query($q1);

						while($v_fetch = array_shift($v_query))

						{

						

							echo "<tr> <td class='display_row'>" . $v_fetch['box_category'] . "</td>

								<td>" . $v_fetch['UNSPSC_code'] . "</td>

								<td>" . $v_fetch['supplier_part_num'] . "</td>

								<td>" . $v_fetch['description'] . "</td>

								<td>" . $v_fetch['UOM_code'] . "</td>

								<td>" . $v_fetch['UOM_code'] . "</td>

								<td>" . 'UsedCardboardBoxes.com' . "</td>

								<td>" . $v_fetch['supplier_part_num'] . "</td>

								<td>" . $v_fetch['lead_time'] . "</td>

								<td>" . '125_Box_pic_1' . "</td>

								<td>" . 'https://www.usedcardboardboxes.com' . "</td>

								<td>" . $v_fetch['box_searchable_keyword'] . "</td>

								<td>" . $v_fetch['long_desc'] . "</td>

								<td>" . 'UsedCardboardBoxes.com' . "</td>

							</tr>";	

						}

					echo "</table>

				</div>";

			}	

			}

		?>



<?php include("inc/header.php"); ?>

<div class="main_data_css">

	<div class="dashboard_heading" style="float: left;">

		<div style="float: left;">

			Schnitzer Steel Catalog Export Tool    

		<div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>

		<span class="tooltiptext">This report allows the user to create a new csv catalog file with the click of a button, which can be used to upload into the JAGGAER system so that Schnitzer Steel customers know the inventory UCB has available to them. As a note, products cannot be uploaded into JAGGAER without an ORACLE Part Number.</span></div>

		<div style="height: 13px;">&nbsp;</div>

		</div>

	</div>	

<!-- 

	<h3 class="jaggaer_title">CSV Generator for JAGGAER</h3>

	<div class="jaggaer_sub_heading">This report allows the user to create a new csv catalog file with the click of a button, which can be used to upload into the JAGGAER system so that JAGGAER customers know the inventory UCB has available.</div>

	<br>

-->	

	<table cellpadding=0 cellspacing=0 width="100%" class="jaggaer_tble">

		<tr>

			<th colspan="6">JAGGAER process - History

				<a href="Jaggaer_csv_history.php" target="_blank" name="jaggaer_history" id="jaggaer_history">Show all History</a>

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

		$history_qry = "Select * from jaggaer_export_history order by id desc limit 10";
			
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

	//
	db();
	db_query("delete from export_jaggaer_csv_report");



		?>

		<a href="jaggaer_excel_export.php?East_West_Flg=West">Download West product excel file</a>

		<br>

		<br><a href="jaggaer_pricing_excel_export.php?East_West_Flg=West">Download West pricing excel file</a>

		<br><br>

		<a href="jaggaer_excel_export.php?East_West_Flg=East">Download East product excel file</a>

		<br>

		<br><a href="jaggaer_pricing_excel_export.php?East_West_Flg=East">Download East pricing excel file</a>

		<br><br>

		

	<?php 

		showtables("West");

	?>

		<br><br>

	<?php	

		showtables("East");

	?>

	</div>

</body>

</html>