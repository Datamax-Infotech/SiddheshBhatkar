<?php
   session_start();
   
   require ("../mainfunctions/database.php");
   
   require ("../mainfunctions/general-functions.php");
   
   require ("inc/functions_mysqli.php");
 
?>	 
<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Kit Box Report</title>
      <style>
         .style24 {
         font-size: 12px;
         background-color: #FF9900;
         font-family: Arial, Helvetica, sans-serif;
         color: #333333;
         text-align: center;
         }
         .style12 {
         font-size: xx-small;
         font-family: Arial, Helvetica, sans-serif;
         color: #333333;
         text-align: center;
         }
         table.tablestyle {
         border-collapse: collapse;
         width: 100%;
         }
         table.tablestyle tr:nth-child(1){
         white-space: nowrap;
         }
         table.tablestyle tr th, table.tablestyle tr td {
         text-align: left;
         padding: 8px;
         }
         table.tablestyle tr td{
         font-size: xx-small;
         font-family: Arial, Helvetica, sans-serif;  
         border: 1px solid #F8F8F8;
         }
         table.tablestyle tr:nth-child(even) {
         background-color: #f4f4f4;
         }
         table.tablestyle tr:nth-child(odd) {
         background-color: #e4e4e4;
         }
      </style>
      <script>
         function displaykitbox(colid, sortflg)
         
         {
         
             document.getElementById("div_kitbox").innerHTML  = "<br/><div style='text-align: center;'>Loading .....<img src='images/wait_animated.gif' /></div>"; 			
         
         
         
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
         
                     document.getElementById("div_kitbox").innerHTML = xmlhttp.responseText; 
         
                 }
         
             }
         
         
         
             xmlhttp.open("GET","inventory_displaykitbox.php?colid=" + colid + "&sortflg=" + sortflg + "&warehouse_id=" + document.getElementById("wid").value,true);	
         
             xmlhttp.send();
         
         } 
         
      </script>
   </head>
   <body>
      <table width="80%">
         <tr align="middle">
            <td align="center" class="style24" style="height: 16px"><strong>Kit Box Report</strong></td>
         </tr>
         <tr>
            <td>
               <div id="div_kitbox" name="div_noninv_shipping" >
                  <table cellSpacing="1" cellPadding="1" border="0" width="1200" class="tablestyle" >
                     <?php
                        $sorturl="kit_box_report.php?warehouse_id=".$_REQUEST["warehouse_id"];
                        
                        ?>
                     <tr vAlign="left">
                        <td bgColor="#e4e4e4" class="style12"><b>Work as a Kit Box?&nbsp;<font size="1" face="Arial, Helvetica, sans-serif" color="#333333">&nbsp;<a href="<?php echo $sorturl; ?>&sort_order_pre=ASC&sort=workaskit"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;<a href="<?php echo $sorturl; ?>&sort_order_pre=DESC&sort=workaskit"><img src="images/sort_desc.png" width="6px;" height="12px;"></a></font></b></td>
                        <td bgColor="#e4e4e4" class="style12"><b>Size&nbsp;<font size="1" face="Arial, Helvetica, sans-serif" color="#333333"><a href="<?php echo $sorturl; ?>&sort_order_pre=ASC&sort=size"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;<a href="<?php echo $sorturl; ?>&sort_order_pre=DESC&sort=size"><img src="images/sort_desc.png" width="6px;" height="12px;"></a></font></b></td>
                        <td bgColor="#e4e4e4" class="style12"><b>Description&nbsp;<font size="1" face="Arial, Helvetica, sans-serif" color="#333333"><a href="<?php echo $sorturl; ?>&sort_order_pre=ASC&sort=descp"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;<a href="<?php echo $sorturl; ?>&sort_order_pre=DESC&sort=descp"><img src="images/sort_desc.png" width="6px;" height="12px;"></a></font></b></td>
                        <td bgColor="#e4e4e4" class="style12"><b>Vendor&nbsp;<font size="1" face="Arial, Helvetica, sans-serif" color="#333333"><a href="<?php echo $sorturl; ?>&sort_order_pre=ASC&sort=vend"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;<a href="<?php echo $sorturl; ?>&sort_order_pre=DESC&sort=vend"><img src="images/sort_desc.png" width="6px;" height="12px;"></a></font></b></td>
                        <td bgColor="#e4e4e4" class="style12"><b>Warehouse&nbsp;</b></td>
                        <td bgColor="#e4e4e4" class="style12"><b>Per Pallet&nbsp;<font size="1" face="Arial, Helvetica, sans-serif" color="#333333"><a href="<?php echo $sorturl; ?>&sort_order_pre=ASC&sort=perpallet"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;<a href="<?php echo $sorturl; ?>&sort_order_pre=DESC&sort=perpallet"><img src="images/sort_desc.png" width="6px;" height="12px;"></a></font></b></td>
                        <td bgColor="#e4e4e4" class="style12"><b>Per Truckload&nbsp;<font size="1" face="Arial, Helvetica, sans-serif" color="#333333"><a href="<?php echo $sorturl; ?>&sort_order_pre=ASC&sort=pertruckload"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;<a href="<?php echo $sorturl; ?>&sort_order_pre=DESC&sort=pertruckload"><img src="images/sort_desc.png" width="6px;" height="12px;"></a></font></b></td>
                     </tr>
                     <?php
                         $MGArray       = array();
                         $vc_array_sort = array();

                         $warehouse_id = "";

                        if (!isset($_REQUEST["sort"])){ 
                        
                        //, loop_boxes.blength, loop_boxes.bwidth, loop_boxes.bdepth,loop_boxes.bdescription
                        if(isset($_REQUEST["warehouse_id"])){
                           $warehouse_id = $_REQUEST["warehouse_id"];
                        }else{
                           $warehouse_id = "N/A";
                        }

                        $dt_view_qry = "SELECT loop_boxes.bpallet_qty, loop_boxes.flyer, loop_boxes.type, loop_boxes.boxes_per_trailer, loop_boxes.id AS I, loop_boxes.b2b_id AS B2BID, SUM(loop_inventory.boxgood) AS A, loop_warehouse.company_name AS B, loop_boxes.bdescription AS C, loop_boxes.blength AS L, loop_boxes.blength_frac AS LF, loop_boxes.bwidth AS W, loop_boxes.bwidth_frac AS WF, loop_boxes.bdepth AS D, loop_boxes.bdepth_frac as DF, loop_boxes.work_as_kit_box AS kitbox, loop_boxes.bwall AS WALL, loop_boxes.bstrength AS ST, loop_boxes.isbox as ISBOX, loop_boxes.type as TYPE, loop_warehouse.id AS wid, loop_warehouse.pallet_space, loop_boxes.sku as SKU FROM loop_inventory INNER JOIN loop_warehouse ON loop_inventory.warehouse_id = loop_warehouse.id INNER JOIN loop_boxes ON loop_inventory.box_id = loop_boxes.id where loop_warehouse.id = ".$warehouse_id." GROUP BY loop_inventory.box_id ORDER BY loop_boxes.work_as_kit_box";
                        
                        db();
                        $dt_view_res = db_query($dt_view_qry);
                        
                        $preordercnt = 1; 
                        
                        $tmpwarenm = ""; $tmp_noofpallet = 0; $ware_house_boxdraw = "";
                        
                        while ($dt_view_row = array_shift($dt_view_res)) {
                        
                        $vender_nm = ""; $newUsed = "";  $tmp_bpallet_qty = 0;  $tmp_boxes_per_trailer = 0;	$boxkit_sort = 99;
                        
                           if($dt_view_row["type"]=="Medium" || $dt_view_row["type"]=="Large" || $dt_view_row["type"]=="Xlarge" || $dt_view_row["type"]=="Box" || $dt_view_row["type"]=="Boxnonucb" || $dt_view_row["type"]=="Loop" || $dt_view_row["type"]=="Presold")
                        
                           { 
                        
                        $b2b_fob = 0; $b2b_cost = 0; $vendor_name= ""; $inv_id = 0;
                        
                               
                        
                               //
                        
                               $b2bid = $dt_view_row["B2BID"];
                        
                        
                        
                        $sql_b2b = "SELECT * FROM inventory where ID = ". $b2bid;
                                
                               db_b2b();
                               $result_b2b = db_query($sql_b2b);
                        
                               
                        
                               if ($myrowsel_b2b = array_shift($result_b2b)) {
                        
                                   $newUsed = $myrowsel_b2b["newUsed"]; 
                        
                        
                        
                        if ($myrowsel_b2b["vendor_b2b_rescue"] != ""){
                        
                        $q1 = "SELECT * FROM loop_warehouse where id = ".$myrowsel_b2b["vendor_b2b_rescue"];
                        
                        db();
                        $query = db_query($q1);
                        
                        while($fetch = array_shift($query))
                        
                        {
                        
                        $vender_nm = $fetch['company_name'] . " (Loop ID: " . $fetch["id"] . " B2B ID:" . $fetch["b2bid"] . ")";
                        
                        }
                        
                        }else{
                        
                        $q1 = "SELECT * FROM vendors where id = ".$myrowsel_b2b["vendor"];
                        
                        db_b2b();
                        $query = db_query($q1);
                        
                        
                        
                        while($fetch = array_shift($query))
                        
                        {
                        
                        $vender_nm = $fetch['Name'];
                        
                        }
                        
                        }	
                        
                        
                        
                        }
                        
                               //
                        
                               
                        
                               
                        
                               
                        
                        $qry = "select vendors.name AS VN, inventory.ID as invid, inventory.vendor AS V, ulineDollar, ulineCents, costDollar, costCents from inventory INNER JOIN vendors ON inventory.vendor = vendors.id where loops_id=".$dt_view_row["I"];	
                        
                        db_b2b();
                        $dt_view = db_query($qry);
                        
                        while ($sku_val = array_shift($dt_view)) 
                        
                        {
                        
                        $inv_id = $sku_val["invid"];
                        
                        $vendor_name = $sku_val["VN"];
                        
                        $b2b_ulineDollar = round($sku_val["ulineDollar"]);
                        
                        $b2b_ulineCents = $sku_val["ulineCents"];
                        
                        $b2b_fob = $b2b_ulineDollar + $b2b_ulineCents;
                        
                        $b2b_fob = number_format($b2b_fob,2);
                        
                        
                        
                        $b2b_costDollar = round($sku_val["costDollar"]);
                        
                        $b2b_costCents = $sku_val["costCents"];
                        
                        $b2b_cost = $b2b_costDollar+$b2b_costCents;
                        
                        $b2b_cost = number_format($b2b_cost,2);
                        
                        }
                        
                        
                        
                               $reccnt = 0;
                        
                                                               
                        
                               if ($dt_view_row["bpallet_qty"] > 0){
                        
                                   $tmp_bpallet_qty = $dt_view_row["bpallet_qty"];		
                        
                               }else{
                        
                                   $tmp_bpallet_qty = 0;		
                        
                               }			
                        
                        
                        
                               if ($dt_view_row["boxes_per_trailer"] > 0){
                        
                                   $tmp_boxes_per_trailer = $dt_view_row["boxes_per_trailer"];			
                        
                               }else{
                        
                                   $tmp_boxes_per_trailer = 0;		
                        
                               }
                        
                        
                        
                        $boxkit_sort = 99;
                        
                        if ($dt_view_row["kitbox"] == "Large"){
                        
                        $boxkit_sort = 2;
                        
                        }	
                        
                        if ($dt_view_row["kitbox"] == "Medium"){
                        
                        $boxkit_sort = 1;
                        
                        }	
                        
                        if ($dt_view_row["kitbox"] == "X-Large"){
                        
                        $boxkit_sort = 4;
                        
                        }
                        
                               if ($dt_view_row["kitbox"] == "Large (Fold at Seam)"){
                        
                        $boxkit_sort = 3;
                        
                        }	
                        
                               if ($dt_view_row["kitbox"] == "X-Large (Fold at Seam)"){
                        
                        $boxkit_sort = 5;
                        
                        }	
                        
                               ?>
                     <?php  
                        }
                        
                        
                        
                                             $MGArray[] = array('boxid' => $dt_view_row["I"],'kitbox' => $dt_view_row["kitbox"], 'boxdes' => $dt_view_row["C"], 'vendor_name' => $vender_nm, 
                        
                                 'warehouse' => $dt_view_row["B"], 'lwh' => $dt_view_row["L"] ." x ".$dt_view_row["W"]." x ".$dt_view_row["D"], 'vender_nm' => $vender_nm,
                        
                        	'perpallet' => $tmp_bpallet_qty, 'pertruckload' => $tmp_boxes_per_trailer, 'boxkit_sort' => $boxkit_sort); 
                        
                        }
                        
                                              //
                        
                     foreach ($MGArray as $key => $row) { 
                        
                        $vc_array_sort[$key] = $row['boxkit_sort']; 
                        
                        //print_r($row['boxkit_sort']);
                        
                     }
                        
                        
                        
                        array_multisort($vc_array_sort, SORT_ASC, $MGArray);
                        
                        
                        
                        foreach ($MGArray as $MGArraytmp2) { 
                        
                        ?>
                     <tr>
                        <td>
                           <?php echo $MGArraytmp2["kitbox"]; ?>
                        </td>
                        <td>
                           <?php echo $MGArraytmp2["lwh"]; ?>
                        </td>
                        <td>
                           <a href="manage_box_b2bloop.php?id=<?php echo $MGArraytmp2["boxid"];?>&proc=View&" target="_blank"><?php echo $MGArraytmp2["boxdes"]; ?></a>
                        </td>
                        <td>
                           <?php echo $MGArraytmp2["vender_nm"]; ?>
                           <?php //echo "--".$MGArraytmp2["vendor_name"]; ?>
                        </td>
                        <td>
                           <?php echo $MGArraytmp2["warehouse"]; ?>
                        </td>
                        <td>
                           <?php echo $MGArraytmp2["perpallet"]; ?>
                        </td>
                        <td>
                           <?php echo $MGArraytmp2["pertruckload"]; ?>
                        </td>
                     </tr>
                     <?php  						
                        }
                        
                                          
                        
                                               //
                        
                                          $_SESSION['sortarrayn'] = $MGArray;
                        
                                      }
                        
                                       if(isset($_REQUEST["sort"]))
                        
                                      {
                        
                                  $MGArray = $_SESSION['sortarrayn'];
                        
                                          
                        
                                           if($_REQUEST['sort'] == "workaskit")
                        
                                              {
                        
                                              $MGArraysort_I = array();
                        
                        
                        
                                              foreach ($MGArray as $MGArraytmp) {
                        
                                              $MGArraysort_I[] = $MGArraytmp['boxkit_sort'];
                        
                        
                        
                                              }
                        
                        
                        
                                              if ($_REQUEST['sort_order_pre'] == "ASC"){
                        
                                                  array_multisort($MGArraysort_I,SORT_ASC,$MGArray); 
                        
                        
                        
                                              }
                        
                                              if ($_REQUEST['sort_order_pre'] == "DESC"){
                        
                                                  array_multisort($MGArraysort_I,SORT_DESC,$MGArray); 
                        
                                              }
                        
                                                  
                        
                                          }
                        
                                          if($_REQUEST['sort'] == "vend")
                        
                                          {
                        
                                              $MGArraysort_I = array();
                        
                        
                        
                                              foreach ($MGArray as $MGArraytmp) {
                        
                                              $MGArraysort_I[] = $MGArraytmp['vendor_name'];
                        
                        
                        
                                              }
                        
                        
                        
                                              if ($_REQUEST['sort_order_pre'] == "ASC"){
                        
                                                  array_multisort($MGArraysort_I,SORT_ASC,SORT_STRING,$MGArray); 
                        
                                              }
                        
                                              if ($_REQUEST['sort_order_pre'] == "DESC"){
                        
                                                  array_multisort($MGArraysort_I,SORT_DESC,SORT_STRING,$MGArray); 
                        
                                              }
                        
                                          }
                        
                                           if($_REQUEST['sort'] == "size")
                        
                                          {
                        
                                              $MGArraysort_I = array();
                        
                        
                        
                                              foreach ($MGArray as $MGArraytmp) {
                        
                                              $MGArraysort_I[] = $MGArraytmp['lwh'];
                        
                        
                        
                                              }
                        
                        
                        
                                              if ($_REQUEST['sort_order_pre'] == "ASC"){
                        
                                                  array_multisort($MGArraysort_I,SORT_ASC,$MGArray); 
                        
                                              }
                        
                                              if ($_REQUEST['sort_order_pre'] == "DESC"){
                        
                                                  array_multisort($MGArraysort_I,SORT_DESC,$MGArray); 
                        
                                              }
                        
                                          }
                        
                                           if($_REQUEST['sort'] == "descp")
                        
                                          {
                        
                                              $MGArraysort_I = array();
                        
                        
                        
                                              foreach ($MGArray as $MGArraytmp) {
                        
                                              $MGArraysort_I[] = $MGArraytmp['boxdes'];
                        
                        
                        
                                              }
                        
                        
                        
                                              if ($_REQUEST['sort_order_pre'] == "ASC"){
                        
                                                  array_multisort($MGArraysort_I,SORT_ASC,$MGArray); 
                        
                                              }
                        
                                              if ($_REQUEST['sort_order_pre'] == "DESC"){
                        
                                                  array_multisort($MGArraysort_I,SORT_DESC,$MGArray); 
                        
                                              }
                        
                                          }
                        
                                           if($_REQUEST['sort'] == "perpallet")
                        
                                          {
                        
                                              $MGArraysort_I = array();
                        
                        
                        
                                              foreach ($MGArray as $MGArraytmp) {
                        
                                              $MGArraysort_I[] = $MGArraytmp['boxdes'];
                        
                        
                        
                                              }
                        
                        
                        
                                              if ($_REQUEST['sort_order_pre'] == "ASC"){
                        
                                                  array_multisort($MGArraysort_I,SORT_ASC,$MGArray); 
                        
                                              }
                        
                                              if ($_REQUEST['sort_order_pre'] == "DESC"){
                        
                                                  array_multisort($MGArraysort_I,SORT_DESC,$MGArray); 
                        
                                              }
                        
                                          }
                        
                                            if($_REQUEST['sort'] == "pertruckload")
                        
                                          {
                        
                                              $MGArraysort_I = array();
                        
                        
                        
                                              foreach ($MGArray as $MGArraytmp) {
                        
                                              $MGArraysort_I[] = $MGArraytmp['pertruckload'];
                        
                        
                        
                                              }
                        
                        
                        
                                              if ($_REQUEST['sort_order_pre'] == "ASC"){
                        
                                                  array_multisort($MGArraysort_I,SORT_ASC,$MGArray); 
                        
                                              }
                        
                                              if ($_REQUEST['sort_order_pre'] == "DESC"){
                        
                                                  array_multisort($MGArraysort_I,SORT_DESC,$MGArray); 
                        
                                              }
                        
                                          }
                        
                                            if($_REQUEST['sort'] == "pertruckload")
                        
                                          {
                        
                                              $MGArraysort_I = array();
                        
                        
                        
                                              foreach ($MGArray as $MGArraytmp) {
                        
                                              $MGArraysort_I[] = $MGArraytmp['pertruckload'];
                        
                        
                        
                                              }
                        
                        
                        
                                              if ($_REQUEST['sort_order_pre'] == "ASC"){
                        
                                                  array_multisort($MGArraysort_I,SORT_ASC,$MGArray); 
                        
                                              }
                        
                                              if ($_REQUEST['sort_order_pre'] == "DESC"){
                        
                                                  array_multisort($MGArraysort_I,SORT_DESC,$MGArray); 
                        
                                              }
                        
                                          }
                        
                                          
                        
                        //Display sorted data in the table
                        
                              $unqid =0;
                        
                             foreach ($MGArray as $MGArraytmp2) { 
                        
                                 //get all child comp list
                        
                                 ?>
                     <tr>
                        <td>
                           <?php echo $MGArraytmp2["kitbox"]; ?>
                        </td>
                        <td>
                           <?php echo $MGArraytmp2["lwh"]; ?>
                        </td>
                        <td>
                           <a href="manage_box_b2bloop.php?id=<?php echo $MGArraytmp2["boxid"];?>&proc=View&" target="_blank"><?php echo $MGArraytmp2["boxdes"]; ?></a>
                        </td>
                        <td>
                           <?php echo $MGArraytmp2["vender_nm"]; ?>
                           <?php //echo "--".$MGArraytmp2["vendor_name"]; ?>
                        </td>
                        <td>
                           <?php echo $MGArraytmp2["warehouse"]; ?>
                        </td>
                        <td>
                           <?php echo $MGArraytmp2["perpallet"]; ?>
                        </td>
                        <td>
                           <?php echo $MGArraytmp2["pertruckload"]; ?>
                        </td>
                     </tr>
                     <?php
                        }//End foreach display data
                        
                        
                        
                        //
                        
                        }//End if (isset($_REQUEST["sort"]))
                        
                        ?>
                     </tr>
                  </table>
               </div>
            </td>
         </tr>
      </table>
      <input type="hidden" name="wid" id="wid" value="<?php echo $_REQUEST["warehouse_id"];?>"/>
   </body>
</html>
