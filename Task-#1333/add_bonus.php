<?php 
   require ("inc/header_session.php");
   require ("../mainfunctions/database.php");
   require ("../mainfunctions/general-functions.php"); 
?>
<!DOCTYPE html>
<html>
   <head>
      <title>Add Other Bonus Tool</title>
      <style type="text/css">
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
         font-size: 10px; 
         color : #000000; 
         font-weight: normal; 
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
               Add Other Bonus Tool
               <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
                  <span class="tooltiptext">
                  This tool allows the user to add an additional bonus to their payroll summary on a selected date. The list only includes hourly employees with an active timeclock profile.
                  </span>
               </div>
               <div style="height: 13px;">&nbsp;</div>
            </div>
         </div>
         <form name="rptSearch" action="add_bonus_submit.php" method="POST">
            <input type="hidden" name="action" value="run">
            <br /><font face="Arial, Helvetica, sans-serif" color="#333333" size="1">
            Date for Bonus 
            <SCRIPT LANGUAGE="JavaScript" SRC="inc/CalendarPopup.js"></SCRIPT>
            <script LANGUAGE="JavaScript">document.write(getCalendarStyles());</script>
            <script LANGUAGE="JavaScript">
               var cal1xx = new CalendarPopup("listdiv");
               
               cal1xx.showNavigationDropdowns();
               
               var cal2xx = new CalendarPopup("listdiv");
               
               cal2xx.showNavigationDropdowns();
               
            </script>
            <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">  <input type="text" name="start_date" size="11" value="<?php echo (isset($_GET["start_date"]) && $_GET["start_date"] != "")?date('m/d/Y', strtotime($_GET["start_date"])):date('m/d/Y')?>"> <a href="#" onclick="cal1xx.select(document.rptSearch.start_date,'anchor1xx','MM/dd/yyyy'); return false;" name="anchor1xx" id="anchor1xx"><img border="0" src="images/calendar.jpg"></a> 
            <div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>
            <br>
            <br><br>
            <table>
               <tr>
                  <td class="style7">Name</td>
                  <td class="style7">Amount</td>
                  <td class="style7">Notes</td>
               </tr>
               <?php
                  $bg = "#e4e4e4";
                  
                  $sql3 = "SELECT * FROM loop_workers WHERE active = 1 ORDER BY warehouse_id ASC, name ASC";
                  db();
                  $result3 = db_query($sql3);
                  
                  while ($myrowsel3 = array_shift($result3)) {
                  
                  ?>
               <tr>
                  <td width=300  bgColor="<?php echo $bg;?>" >
                     <?php echo $myrowsel3["name"]; ?>
                  </td>
                  <td  bgColor="<?php echo $bg;?>"  width=100>$<input size=5 type=text name="amount_<?php echo $myrowsel3["id"]; ?>" value="0.00" ></td>
                  <td bgColor="<?php echo $bg;?>"><input type="text" size=40 name="notes_<?php echo $myrowsel3["id"]; ?>"></td>
               </tr>
               <?php
                  ($bg == "#e4e4e4" ? $bg = "#c4c4c4" : $bg = "#e4e4e4");
                  
                  } ?>
            </table>
            <br>
            &nbsp; <input type="submit" value="Add Bonus">
         </form>
      </div>
   </body>
</html>