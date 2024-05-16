<?php 
   require ("../mainfunctions/database.php");
   require ("../mainfunctions/general-functions.php");
?>
<!DOCTYPE html>
<html>
   <head>
      <title>UCB B2C Inventory</title>
      <link rel="stylesheet" href="sorter/style_rep.css" />
      <style type="text/css">
         .txtstyle_color
         {
         font-family:arial;
         font-size:12;
         height: 16px; 
         background:#ABC5DF;
         }
         .txtstyle
         {
         font-family:arial;
         font-size:12;
         }
         .style7 {
         font-size: xx-small;
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
         .style13 {
         font-family: Arial, Helvetica, sans-serif;
         }
         .style14 {
         font-size: x-small;
         }
         .style15 {
         font-size: small;
         }
         .style16 {
         font-family: Arial, Helvetica, sans-serif;
         font-size: x-small;
         background-color: #99FF99;
         }
         .style17 {
         background-color: #99FF99;
         }
         select, input {
         font-family: Arial, Helvetica, sans-serif; 
         font-size: 12px; 
         color : #000000; 
         font-weight: normal; 
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
      <script type="text/javascript" src="sorter/jquery-latest.js"></script>
      <script type="text/javascript" src="sorter/jquery.tablesorter.js"></script>
      <script type="text/javascript"> 
         function updateqty(cnt, item_id, warehouse_id)
         
         {
         
         	var retval = confirm("Do you wish to update the Quantity?");
         
         	if (retval == true) {
         
         		document.getElementById("qty_hd").value = document.getElementById("qty_"+cnt).value;
         
         		
         
         		document.getElementById("item_id_hd").value = item_id;
         
         		document.getElementById("warehouse_id_hd").value = warehouse_id;
         
         
         
         		document.b2cinv.submit();
         
         		return true;
         
         	} else {
         
         		return false;
         
         	} 			
         
         
         
         }
         
      </script>
   </head>
   <body>
      <table width="80%">
      <tr>
         <td width="60%">
            <!-- Load the page by default with old logic - do not apply date range-->
            <table border="0" cellpadding="3">
               <tr>
                  <td class="style7" colSpan="6" valign="top" align="center"> 
                     <b>B2C Inventory</b>
                     <a href="javascript:void(0);" onclick="expand_b2cinv();">Expand/</a>
                     <a href="javascript:void(0);" onclick="collapse_b2cinv();">Collapse</a>
                  </td>
               </tr>
               <tr>
                  <td>
                     <br>
                     <table cellSpacing="1" cellPadding="1" border="0" id="table8" >
                        <thead>
                           <tr>
                              <td class="txtstyle_color" colspan="14" align="center"><strong>B2C Raw Material Inventory</strong></td>
                           </tr>
                           <tr>
                              <th bgColor='#E4EAEB' align=center width="150px">
                                 <u>Location</u>
                              </th>
                              <?php
                                 db();
                                 $product_array[] = array();
                                 $product_array1[] = array();

                                 $result_main = db_query("select * from products_kit_raw_item_master where active = 1 order by display_order");
                                 
                                 while ($row_main = array_shift($result_main)) {	
                                 
                                 	$product_array[] = array('products_kit_raw_item_id' => $row_main["products_kit_raw_item_id"], 'products_kit_raw_item' => $row_main["products_kit_raw_item"]);
                                 
                                 ?>
                              <th width="80px" bgColor='#E4EAEB' align=center><u><?php echo $row_main["products_kit_raw_item"];?></u></th>
                              <?php }?>
                           </tr>
                        </thead>
                        <tbody>
                           <form name="b2cinv"	id="b2cinv" action="report_b2c_inventory_new.php" method="post">
                              <?php
                                 $txt_cnt = 1; $tot_val = 0;
                                 $whid = "";

                                 if($_REQUEST["whid"] != '') {
                                    $whid = $_REQUEST["whid"];
                                 } else {
                                    $whid = "";
                                 }
                                 
                                 db();
                                 $result_main = db_query("select warehouse_id, warehouse_name from kitinv_warehouse_master where activeflg = 1 and warehouse_id='".$whid."' order by warehouse_name");
                                 
                                 while ($row_main = array_shift($result_main)) {	
                                 
                                 	echo "<tr><td bgColor='#E4EAEB'>" . $row_main["warehouse_name"] . "</td>";
                                 
                                 	
                                 
                                 	foreach ($product_array as $product_array_tmp){
                                 
                                 		$data_found = "n"; $txt_cnt = $txt_cnt + 1;
                                 
										db();
                                 		$result_1 = db_query("select sum(qty) as qty from products_kit_raw_item_inventory where products_kit_raw_item_id = " . $product_array_tmp["products_kit_raw_item_id"] . " and warehouse_id = " . $row_main["warehouse_id"]);
                                 
                                 		while ($row_1 = array_shift($result_1)) {	
                                 
                                 			$data_found = "y";
                                 
                                 			if ($row_1["qty"] <> ""){
                                 
                                 				$tmp_qty = $row_1["qty"];
                                 
                                 			}else{
                                 
                                 				$tmp_qty = 0;
                                 
                                 			}
                                 
                                 			echo "<td bgColor='#E4EAEB' align='right'><a href='report_b2c_raw_inventory_history.php?rawinv=y&location=" . $row_main["warehouse_id"] . "&id=" . $product_array_tmp["products_kit_raw_item_id"] ."'>" . $tmp_qty . "</a></td>";
                                 
                                 		}						
                                 
                                 		if ($data_found == "n"){
                                 
                                 			echo "<td bgColor='#E4EAEB' align='right'><a href='report_b2c_raw_inventory_history.php?rawinv=y&location=" . $row_main["warehouse_id"] . "&id=" . $product_array_tmp["products_kit_raw_item_id"] ."'>0</a></td>";
                                 
                                 		}
                                 
                                 	}
                                 
                                 
                                 
                                 	echo "</tr>";
                                 
                                 }
                                 
                                 
                                 
                                 /*echo "<tr><td bgColor='#E4EAEB'>Total</td>";
                                 
                                 foreach ($product_array as $product_array_tmp){
                                 
                                 	$data_found = "n"; $txt_cnt = $txt_cnt + 1;
                                 
                                 	$result_1 = db_query("select sum(qty) as sumqty from products_kit_raw_item_inventory where products_kit_raw_item_id = " . $product_array_tmp["products_kit_raw_item_id"], db() );
                                 
                                 	while ($row_1 = array_shift($result_1)) {	
                                 
                                 			$data_found = "y";
                                 
                                 			echo "<td bgColor='#E4EAEB' align='right'>" . $row_1["sumqty"] . "</td>";
                                 
                                 	}						
                                 
                                 	if ($data_found == "n"){
                                 
                                 		echo "<td bgColor='#E4EAEB' align='right'>0</td>";
                                 
                                 	}
                                 
                                 }
                                 
                                 echo "</tr>";*/
                                 
                                 ?>
                              <input type='hidden' name='qty_hd' id='qty_hd' value=''/>
                              <input type='hidden' name='item_id_hd' id='item_id_hd' value=''/>
                              <input type='hidden' name='warehouse_id_hd' id='warehouse_id_hd' value=''/>
                              <input type='hidden' name='b2c_kit_inv' id='b2c_kit_inv' value='no'/>
                           </form>
                        </tbody>
                     </table>
                     <br><br>
                     <table cellSpacing="1" cellPadding="1" border="0" id="table8" >
                        <thead>
                           <tr>
                              <td class="txtstyle_color" colspan="10" align="center"><strong>B2C Kit Module Inventory</strong></td>
                           </tr>
                           <tr>
                              <th bgColor='#E4EAEB' align=center width="150px">
                                 <u>Location</u>
                              </th>
                              <?php
							     db();
                                 $result_main = db_query("select * from products_kit_item_master where active = 1 order by display_order");
                                 
                                 while ($row_main = array_shift($result_main)) {	
                                 
                                 	$product_array1[] = array('products_kit_item_id' => $row_main["products_kit_item_id"], 'products_kit_item' => $row_main["products_kit_item"]);
                                 
                                 ?>
                              <th width="80px" bgColor='#E4EAEB' align=center><u><?php echo $row_main["products_kit_item"];?></u></th>
                              <?php }?>
                           </tr>
                        </thead>
                        <tbody>
                           <form name="b2cinv"	id="b2cinv" action="report_b2c_inventory_new.php" method="post">
                              <?php
                                 $txt_cnt = 1; $tot_val = 0;
                                 $whid = "";

                                 if($_REQUEST["whid"] != '') {
                                    $whid = $_REQUEST["whid"];
                                 } else {
                                    $whid = "";
                                 }

                                 db();
                                 $result_main = db_query("select warehouse_id, warehouse_name from kitinv_warehouse_master where activeflg = 1 and warehouse_id=".$whid." order by warehouse_name");
                                 
                                 while ($row_main = array_shift($result_main)) {	
                                 
                                 	echo "<tr><td bgColor='#E4EAEB'>" . $row_main["warehouse_name"] . "</td>";
                                 
                                 	
                                 
                                 	foreach ($product_array1 as $product_array_tmp1){
                                 
                                 		$data_found = "n"; $txt_cnt = $txt_cnt + 1;
										
										db();
                                 		$result_1 = db_query("select sum(qty) as qty from products_kit_item_inventory where products_kit_item_id = " . $product_array_tmp1["products_kit_item_id"] . " and warehouse_id = " . $row_main["warehouse_id"]);
                                 
                                 		while ($row_1 = array_shift($result_1)) {	
                                 
                                 			if ($row_1["qty"] <> ""){
                                 
                                 				$tmp_qty = $row_1["qty"];
                                 
                                 			}else{
                                 
                                 				$tmp_qty = 0;
                                 
                                 			}
                                 
                                 
                                 
                                 			$data_found = "y";
                                 
                                 			echo "<td bgColor='#E4EAEB' align='right'><a href='report_b2c_raw_inventory_history.php?rawinv=n&location=" . $row_main["warehouse_id"] . "&id=" . $product_array_tmp1["products_kit_item_id"] ."'>" . $tmp_qty . "</a></td>";
                                 
                                 		}						
                                 
                                 		if ($data_found == "n"){
                                 
                                 			echo "<td bgColor='#E4EAEB' align='right'><a href='report_b2c_raw_inventory_history.php?rawinv=n&location=" . $row_main["warehouse_id"] . "&id=" . $product_array_tmp1["products_kit_item_id"] ."'>0</a></td>";
                                 
                                 		}
                                 
                                 	}
                                 
                                 
                                 
                                 	echo "</tr>";
                                 
                                 }
                                 
                                 
                                 
                                 /*echo "<tr><td bgColor='#E4EAEB'>Total</td>";
                                 
                                 foreach ($product_array1 as $product_array_tmp1){
                                 
                                 	$data_found = "n"; $txt_cnt = $txt_cnt + 1;
                                 
                                 	$result_1 = db_query("select sum(qty) as sumqty from products_kit_item_inventory where products_kit_item_id = " . $product_array_tmp1["products_kit_item_id"], db() );
                                 
                                 	while ($row_1 = array_shift($result_1)) {	
                                 
                                 		if ($row_1["sumqty"] > 0) {
                                 
                                 			$data_found = "y";
                                 
                                 			echo "<td bgColor='#E4EAEB' align='right'>" . $row_1["sumqty"] . "</td>";
                                 
                                 		}	
                                 
                                 	}						
                                 
                                 	if ($data_found == "n"){
                                 
                                 		echo "<td bgColor='#E4EAEB' align='right'>0</td>";
                                 
                                 	}
                                 
                                 }
                                 
                                 echo "</tr>";*/
                                 
                                 ?>
                              <input type='hidden' name='qty_hd' id='qty_hd' value=''/>
                              <input type='hidden' name='item_id_hd' id='item_id_hd' value=''/>
                              <input type='hidden' name='warehouse_id_hd' id='warehouse_id_hd' value=''/>
                              <input type='hidden' name='b2c_kit_inv' id='b2c_kit_inv' value='yes'/>
                           </form>
                        </tbody>
                     </table>
                     <br><br>
                     <table cellSpacing="1" cellPadding="1" border="0" id="table8" >
                        <thead>
                           <tr>
                              <td class="txtstyle_color" align="center"><strong>What Do You Want to Do? (Quick Links)</strong></td>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td class="txtstyle_color" align="center"><a href="report_b2c_inventory_raw_add.php?warehouse_id_d=<?php echo $_REQUEST["whid"]; ?>">Add More Raw Inventory</a></td>
                           </tr>
                           <tr>
                              <td class="txtstyle_color" align="center"><a href="report_b2c_inventory_add.php?warehouse_id_d=<?php echo $_REQUEST["whid"]; ?>">Add Kits That Were Assembled Today</a></td>
                           </tr>
                        </tbody>
                     </table>
                  </td>
               </tr>
            </table>
   </body>
</html>
