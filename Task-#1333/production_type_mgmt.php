<?php
   require ("inc/header_session.php");
   require ("../mainfunctions/database.php");
   require ("../mainfunctions/general-functions.php"); 
?>
<!DOCTYPE html>
<html>
   <head>
      <title>Production Type Database</title>
      <style>
         body{
         font-size: 13px;
         font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
         }
         .table_title{
         font-size: 13px;
         padding: 3px;
         font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
         background: #FF9900!important;
         /*white-space:nowrap;*/
         }
         .prd_table{
         font-size: 13px;
         padding: 3px;
         font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
         }	
         .prd_table tr th{
         background: #98bcdf;
         }
         .prd_table tr td{
         background: #fafafa;
         }
         .style2 {
         font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
         font-size: 12px;
         }	
         .txt_link{
         font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
         font-size: 13px;
         }
      </style>
      <LINK rel='stylesheet' type='text/css' href='one_style.css' >
      <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
      <link rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>
   </head>
   <body>
      <?php include("inc/header.php"); ?>
      <div class="main_data_css">
         <div class="dashboard_heading" style="float: left;">
            <div style="float: left;">
               Production Type Database
               <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
                  <span class="tooltiptext">
                  This database is where all of the data for B2B production values are saved. This lists out the types of produciton and their value which populates other reports for the facilities department.
                  </span>
               </div>
               <div style="height: 13px;">&nbsp;</div>
            </div>
         </div>
         <?php
            $thispage="production_type_mgmt.php";
			$pagevars = "";
            
            if($_REQUEST["posting"]=="yes")
            
            {
            
            ?>
         <a href="<?php echo $thispage; ?>?proc=New" class="txt_link">Add New Production Type (w/ Stored Value)</a>
         <br><br>
         <table class="prd_table" cellpadding="3" cellspacing="1" width="500">
            <tr>
               <td class="table_title" colspan="3" align="center">Production Type (w/ Stored Value)</td>
            </tr>
            <tr>
               <th>Production Type</th>
               <th>Value</th>
               <th width="90px"></th>
            </tr>
            <?php
               $pquery="select * from production_type_val order by type_value ASC";
               
			   db();
               $pres=db_query($pquery);
               
               while($prow=array_shift($pres))
               
               {
               
               ?>
            <tr>
               <td><?php echo $prow["prod_type"]; ?></td>
               <td>$<?php echo number_format($prow["type_value"],3); ?></td>
               <td><a href="production_type_mgmt.php?proc=Edit&pid=<?php echo $prow["id"]; ?>">Edit</a> | <a href="production_type_mgmt.php?proc=Delete&pid=<?php echo $prow["id"]; ?>">Delete</a></td>
            </tr>
            <?php
               }
               
               ?>
         </table>
         <?php
            }
            
            ?>
         <?php
            //Add new
            
            if($_REQUEST["proc"]=="New")
            
            {
            
            	if($_REQUEST["post"]=="yes"){
            
            		$prod_type=$_POST["prod_type"];
            
            		$type_value=$_POST["type_value"];
            
            		//
            
            		$sql = "INSERT INTO production_type_val (prod_type, type_value ) VALUES ( '$prod_type', '$type_value')";
					
					db();
            		$result = db_query($sql);
            
            		if (empty($result)) {
            
            			echo "<script type=\"text/javascript\">";
            
            				echo "window.location.href=\"production_type_mgmt.php?posting=yes\";";
            
            				echo "</script>";
            
            				echo "<noscript>";
            
            				echo "<meta http-equiv=\"refresh\" content=\"0;url=production_type_mgmt.php?posting=yes\" />";
            
            				echo "</noscript>"; exit;
            
            		}
            
            		//
            
            		
            
            	}
            
            ?>
         <a href="production_type_mgmt.php?posting=yes">Back</a><br><br>
         <table width="600">
            <tr>
               <td style="background-color: gainsboro">Add New Production Type (w/ Stored Value)</td>
            </tr>
         </table>
         <form method="POST" action="<?php echo $thispage; ?>?proc=New&post=yes&<?php echo $pagevars; ?>" name="frm">
            <table cellpadding="3" cellspacing="1" width="400">
               <tr>
                  <td bgcolor="#f5f5f5">Production Type:</td>
                  <td bgcolor="#f5f5f5"><input type="text" name="prod_type" id="prod_type" style="width: 90%;"></td>
               </tr>
               <tr>
                  <td bgcolor="#f5f5f5">Production Value:</td>
                  <td bgcolor="#f5f5f5">$<input type="text" name="type_value" id="type_value"></td>
               </tr>
               <tr>
                  <td bgcolor="#f5f5f5" colspan="2" align="center"><input type="submit" name="save" value="Save" class="save_btn"></td>
               </tr>
            </table>
         </form>
         <?php
            }//End add new
            
            ?>
         <?php
            //Edit Rec
            
            if($_REQUEST["proc"]=="Edit")
            
            {
            
            	if($_REQUEST["post"]=="yes"){
            
            		$prod_type=$_POST["prod_type"];
            
            		$type_value=$_POST["type_value"];
            
            		//
            
            		$sql = "update production_type_val set prod_type='$prod_type', type_value='$type_value' where id='".$_POST["pid"]."'";
					
					db();
            		$result = db_query($sql);
            
            		//echo $sql;
            
            		if (empty($result)) {
            
            			echo "<script type=\"text/javascript\">";
            
            				echo "window.location.href=\"production_type_mgmt.php?posting=yes\";";
            
            				echo "</script>";
            
            				echo "<noscript>";
            
            				echo "<meta http-equiv=\"refresh\" content=\"0;url=production_type_mgmt.php?posting=yes\" />";
            
            				echo "</noscript>"; exit;
            
            		}
            
            		//
            
            		
            
            	}
            
            ?>
         <a href="production_type_mgmt.php?posting=yes">Back</a><br><br>
         <table width="600">
            <tr>
               <td style="background-color: gainsboro">Edit Production Type (w/ Stored Value)</td>
            </tr>
         </table>
         <form method="POST" action="<?php echo $thispage; ?>?proc=Edit&post=yes&<?php echo $pagevars; ?>" name="frm">
            <?php
               $pqr="select * from production_type_val where id='".$_REQUEST["pid"]."'";
               
			   db();
               $pres=db_query($pqr);
               
               while($prow=array_shift($pres))
               
               {
               
               ?>
            <table cellpadding="3" cellspacing="1" width="400">
               <tr>
                  <td bgcolor="#f5f5f5">Production Type:</td>
                  <td bgcolor="#f5f5f5">
                     <input type="text" name="prod_type" id="prod_type" style="width: 90%;" value="<?php echo $prow["prod_type"]; ?>">
                  </td>
               </tr>
               <tr>
                  <td bgcolor="#f5f5f5">Production Value:</td>
                  <td bgcolor="#f5f5f5">
                     $<input type="text" name="type_value" id="type_value" value="<?php echo number_format($prow["type_value"], 3); ?>">
                     <input type="hidden" name="pid" id="pid" value="<?php echo $prow["id"]; ?>">
                  </td>
               </tr>
               <tr>
                  <td bgcolor="#f5f5f5" colspan="2" align="center"><input type="submit" name="save" value="Save" class="save_btn"></td>
               </tr>
            </table>
         </form>
         <?php
            }
            
            }//End Edit
            
            if($_REQUEST["proc"]=="Delete")
            
            {
            
            $pid=$_REQUEST["pid"];
            
            if($_REQUEST["delete"]=="yes"){
            
            	$sql = "DELETE FROM production_type_val WHERE id='".$_REQUEST["pid"]."' ";
				
				db();
            	$result = db_query($sql);	
            
            	if (empty($result)) {
            
            		echo "<script type=\"text/javascript\">";
            
            			echo "window.location.href=\"production_type_mgmt.php?posting=yes\";";
            
            			echo "</script>";
            
            			echo "<noscript>";
            
            			echo "<meta http-equiv=\"refresh\" content=\"0;url=production_type_mgmt.php?posting=yes\" />";
            
            			echo "</noscript>"; exit;
            
            	}
            
            }
            
            
            
            ?>
         <a href="production_type_mgmt.php?posting=yes">Back</a><br><br>
         <table width="600">
            <tr>
               <td style="background-color: gainsboro">Delete Production Type (w/ Stored Value)</td>
            </tr>
         </table>
         <br><br>
         Are you sure you want to delete this Production type?
         <br><br>
         THIS CANNOT BE UNDONE!
         <br><br>
         <a href="<?php echo $thispage; ?>?pid=<?php echo $pid; ?>&delete=yes&proc=Delete">Yes</a>
         <a href="<?php echo $thispage; ?>?posting=yes<?php echo $pagevars; ?>">No</a>
         <?php
            }
            
            ?>
      </div>
   </body>
</html>
