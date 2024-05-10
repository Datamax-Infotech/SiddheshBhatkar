<?php
   require ("inc/header_session.php");
   require ("../mainfunctions/database.php");
   require ("../mainfunctions/general-functions.php");
?>
<!DOCTYPE html>
<html>
   <head>
      <title>Bulk Timeclock Entry Add Tool</title>
      <script src="jquery.js"></script> 
      <script src="moment.min.js"></script> 
      <script src="combodate.js"></script> 	
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
      <script type="text/javascript"> 
         function checkdate()
         
         {
         
                //Checked for Worker dropdown
         
                if (document.getElementById("worker").value == "-") {
         
         		alert("Please select employee name");
         
                    return false;
         
         	}
         
                //Checked for Type dropdown
         
                if (document.getElementById("type").value == "") {
         
                    alert("Please select type");
         
                    return false;
         
         	}
         
                //
         
               
         
                for(var i=1; i<=20; i++)
         
                {
         
                    if ((document.getElementById("start_date"+i).value != "") && (document.getElementById("end_date"+i).value !="")) {
         
                        if ((document.getElementById("start_date"+i).value) > (document.getElementById("end_date"+i).value)) {
         
                            alert("Start date"+i+"  > End date "+i+", please check.");
         
                            return false;
         
                        }
         
                    }
         
         	
         
                    if ((document.getElementById("time_in_hour_"+i).value != "") && (document.getElementById("time_out_hour_"+i).value !="")) {
         
                        if(document.getElementById("time_in_minute_"+i).value == "")
         
                            {
         
                                alert("Please select minute");
         
                                return false;
         
                            }
         
                        if(document.getElementById("time_out_minute_"+i).value == "")
         
                            {
         
                                alert("Please select minute");
         
                                return false;
         
                            }
         
         
         
         			var startTime = new Date(document.getElementById("start_date"+i).value + " " + document.getElementById("time_in_hour_"+i).value + ":00:00");
         
         			var endTime = new Date(document.getElementById("end_date"+i).value + " " + document.getElementById("time_out_hour_"+i).value + ":00:00");
         
         
         
                        if (startTime > endTime) {
         
                            alert("Time In "+i+" > Time out "+i+", please check.");
         
                            return false;
         
                        }
         
                    }
         
                }
         
         
         
         	document.rptSearch2.submit();
         
                
         
         }
         
      </script> 
      <SCRIPT LANGUAGE="JavaScript" SRC="inc/CalendarPopup.js"></SCRIPT>
      <script LANGUAGE="JavaScript">document.write(getCalendarStyles());</script>
      <LINK rel='stylesheet' type='text/css' href='one_style.css' >
      <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
      <link rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>
   </head>
   <body>
      <?php include("inc/header.php"); ?>
      <div class="main_data_css">
         <div class="dashboard_heading" style="float: left;">
            <div style="float: left;">
               Bulk Timeclock Entry Add Tool
               <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
                  <span class="tooltiptext">
                  This tool allows the user to add timeclock entries in bulk.
                  </span>
               </div>
               <div style="height: 13px;">&nbsp;</div>
            </div>
         </div>
         <?php	
            if ($_REQUEST["action"]=="bulkadd")
            
            {
            
            	$sqlw = "SELECT * FROM loop_workers WHERE id = ".$_REQUEST["worker"];
				
				db();
            	$resultw = db_query($sqlw);
            
            	$roww = array_shift($resultw);
            
            	
            
            	$workerid = $roww["id"];
            
                   $name = $roww["name"];
            
            	$type = $_REQUEST["type"];
            
            	$warehouse_id = $roww["warehouse_id"];
            
            	$rate_cost = $roww["rate_cost"];
            
            	$rate_revenue = $roww["rate_revenue"];
            
            
            
                   $data="<font face='Arial, Helvetica, sans-serif' color='#333333' size='3'><br><b>Data has been saved successfully!!!</b></font><br><br> <table width=60% cellpadding=1 cellspacing=1>
            
                           <tr><td colspan=3 bgcolor='#e4e4e4'><font face='Arial, Helvetica, sans-serif' color='#333333' size='1'>Employee Name : $name &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; Type : $type</td></tr>
            
                           <tr>
            
                           <td bgcolor='#d6d6d6'>
            
                            <font face='Arial, Helvetica, sans-serif' color='#333333' size='1'><strong>Time In</strong></font>
            
                             </td>
            
                             <td bgcolor='#d6d6d6'><font face='Arial, Helvetica, sans-serif' color='#333333' size='1'><strong>Time Out</strong></font>
            
                             </td>
            
                             <td bgcolor='#d6d6d6'><font face='Arial, Helvetica, sans-serif' color='#333333' size='1'><strong>Notes</strong></font>
            
                             </td>
            
                             </tr>";
            
            			  
            
                   for($i=1; $i<=20; $i++)
            
                   {
            
                       $time_in = $_REQUEST["time_in_hour_".$i].":".$_REQUEST["time_in_minute_".$i];
            
                       $time_out = $_REQUEST["time_out_hour_".$i].":".$_REQUEST["time_out_minute_".$i];
            
                       $note = $_REQUEST['notes_1'.$i];
            
            
            
                       //
            
            		if ($_REQUEST["start_date".$i] !="" && $time_in != ":" && $time_out != ":") {
            
                        // 
            
                           $datetime_in=date("Y-m-d", strtotime($_REQUEST["start_date".$i]))." ".$time_in.":00";
            
                           $datetime_out=date("Y-m-d", strtotime($_REQUEST["end_date".$i]))." ".$time_out.":00";
            
                        // echo $datetime_in.$i;
            
                       //  
            
            		$sql3 = "INSERT INTO loop_timeclock SET time_in = '" . $datetime_in . "', time_out = '" . $datetime_out . "', warehouse_id='" . $warehouse_id . "', worker_id = '" . $workerid . "', type = '"  . $type . "', rate_cost='" . $rate_cost . "', rate_revenue='" . $rate_revenue . "', notes = '" . $_REQUEST["notes_1".$i] . "' ";
					
					db();
            		$result3 = db_query($sql3);
            
                         if($result3)
            
                         {
            
                             //echo $sql3;
            
                             $done="true";
            
                             $data.="<tr><td bgcolor='#e4e4e4'><font face='Arial, Helvetica, sans-serif' color='#333333' size='1'>";
            
                             $datei = date_create($datetime_in);
            
                             $data.=date_format($datei,"m-d-Y H:i:s")."
            
                             </font></td>
            
                             <td bgcolor='#e4e4e4'><font face='Arial, Helvetica, sans-serif' color='#333333' size='1'>";
            
                             $dateo = date_create($datetime_out);
            
                             $data.=date_format($dateo,"m-d-Y H:i:s")."
            
                             </font></td>
            
                             <td bgcolor='#e4e4e4'><font face='Arial, Helvetica, sans-serif' color='#333333' size='1'>$note</font>
            
                             </td>
            
                             </tr>";
            
                         }
            
            	  }
            
                   }
            
                   $data.="</table><br><br>";
            
                   echo $data;
            
            
            
            }
            
            ?>
         <form name="rptSearch2" action="report_timeclock_bulk_add.php" method="GET">
            <input type="hidden" name="action" value="bulkadd">
            <table width="80%" cellpadding="2" cellspacing="1">
               <tr align="middle">
                  <td colSpan="4" class="style7">
                     <strong>BULK ADD TIMESHEET</strong> 
                  </td>
               </tr>
               <tr>
                  <td bgColor="#99FF99" colspan='2'><font size="1">Employee</font></td>
                  <td bgColor="#99FF99" colspan='2'><font size="1">Type</font></td>
               </tr>
               <tr>
                  <td bgColor="#e4e4e4" colspan='2'>
                     <select id="worker" name="worker">
                        <option value="-" selected>Please Select</option>
                        <?php 
                           $sql3 = "SELECT * FROM loop_workers ORDER BY Active DESC, Name ASC";
                           
						   db();
                           $result3 = db_query($sql3);
                           
                           while ($myrowsel3 = array_shift($result3)) {
                           
                           ?>
                        <option value="<?php echo $myrowsel3["id"]; ?>"><?php echo $myrowsel3["name"]; ?></option>
                        <?php } ?>
                     </select>
                  </td>
                  <td bgColor="#e4e4e4" colspan='2'>
                     <select id="type" name="type">
                        <option value="" selected>Please Select</option>
                        <?php 
                           $sql3 = "SELECT DISTINCT(type) FROM loop_timeclock";
                           
						   db();
                           $result3 = db_query($sql3);
                           
                           while ($myrowsel3 = array_shift($result3)) {
                           
                           ?>
                        <option value="<?php echo $myrowsel3["type"]; ?>" ><?php echo $myrowsel3["type"]; ?></option>
                        <?php } ?>
                     </select>
                  </td>
               </tr>
               <tr>
                  <td bgColor="#e4e4e4"></td>
                  <td bgColor="#e4e4e4"><font size="1">Time In MM-DD-YYYY HH:MM:SS</font></td>
                  <td bgColor="#e4e4e4"><font size="1">Time Out MM-DD-YYYY HH:MM:SS</font></td>
                  <td bgColor="#e4e4e4"><font size="1">Notes</font></td>
               </tr>
               <?php
                  for($i=1; $i<=20; $i++)
                  
                  {
                  
                  ?>
               <script LANGUAGE="JavaScript">
                  var startcal="startcalxx"+<?php echo $i; ?>;
                  
                  var endcal="endcalxx"+<?php echo $i; ?>;
                  
                    startcal = new CalendarPopup("start_datediv"+<?php echo $i; ?>);
                  
                    startcal.showNavigationDropdowns();
                  
                    endcal = new CalendarPopup("end_datediv"+<?php echo $i; ?>);
                  
                    endcal.showNavigationDropdowns();
                  
               </script>
               <tr>
                  <td bgColor="#e4e4e4"><?php echo $i?></td>
                  <td bgColor="#e4e4e4">
                     <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">  <input type="text" name="start_date<?php echo $i?>" id="start_date<?php echo $i?>" size="11" > <a href="#" onclick="startcal.select(document.rptSearch2.start_date<?php echo $i?>,'anchor<?php echo $i?>xx','MM/dd/yyyy'); return false;" name="anchor<?php echo $i?>xx" id="anchor<?php echo $i?>xx"><img border="0" src="images/calendar.jpg"></a> 
                     <div ID="start_datediv<?php echo $i;?>" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>
                     &nbsp;&nbsp;&nbsp;&nbsp;
                     <select class="hour" style="width: auto;" id="time_in_hour_<?php echo $i?>" name="time_in_hour_<?php echo $i?>">
                        <option value="">hour</option>
                        <option value="0">00</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                     </select>
                     &nbsp;:&nbsp;
                     <select class="minute " style="width: auto;"  id="time_in_minute_<?php echo $i?>" name="time_in_minute_<?php echo $i?>">
                        <option value="">minute</option>
                        <option value="00" selected>00</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                        <option value="32">32</option>
                        <option value="33">33</option>
                        <option value="34">34</option>
                        <option value="35">35</option>
                        <option value="36">36</option>
                        <option value="37">37</option>
                        <option value="38">38</option>
                        <option value="39">39</option>
                        <option value="40">40</option>
                        <option value="41">41</option>
                        <option value="42">42</option>
                        <option value="43">43</option>
                        <option value="44">44</option>
                        <option value="45">45</option>
                        <option value="46">46</option>
                        <option value="47">47</option>
                        <option value="48">48</option>
                        <option value="49">49</option>
                        <option value="50">50</option>
                        <option value="51">51</option>
                        <option value="52">52</option>
                        <option value="53">53</option>
                        <option value="54">54</option>
                        <option value="55">55</option>
                        <option value="56">56</option>
                        <option value="57">57</option>
                        <option value="58">58</option>
                        <option value="59">59</option>
                     </select>
                  </td>
                  <td bgColor="#e4e4e4">
                     <font face="Arial, Helvetica, sans-serif" color="#333333" size="1">  <input type="text" name="end_date<?php echo $i?>" id="end_date<?php echo $i?>" size="11" > <a href="#" onclick="endcal.select(document.rptSearch2.end_date<?php echo $i?>,'anchor<?php echo $i?>xxx','MM/dd/yyyy'); return false;" name="anchor<?php echo $i?>xxx" id="anchor<?php echo $i?>xxx"><img border="0" src="images/calendar.jpg"></a> 
                     <div ID="end_datediv<?php echo $i;?>" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>
                     &nbsp;&nbsp;&nbsp;&nbsp;
                     <select class="hour" style="width: auto;" id="time_out_hour_<?php echo $i?>" name="time_out_hour_<?php echo $i?>">
                        <option value="">hour</option>
                        <option value="0">00</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                     </select>
                     &nbsp;:&nbsp;
                     <select class="minute" style="width: auto;"  id="time_out_minute_<?php echo $i?>" name="time_out_minute_<?php echo $i?>">
                        <option value="">minute</option>
                        <option value="00" selected>00</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                        <option value="32">32</option>
                        <option value="33">33</option>
                        <option value="34">34</option>
                        <option value="35">35</option>
                        <option value="36">36</option>
                        <option value="37">37</option>
                        <option value="38">38</option>
                        <option value="39">39</option>
                        <option value="40">40</option>
                        <option value="41">41</option>
                        <option value="42">42</option>
                        <option value="43">43</option>
                        <option value="44">44</option>
                        <option value="45">45</option>
                        <option value="46">46</option>
                        <option value="47">47</option>
                        <option value="48">48</option>
                        <option value="49">49</option>
                        <option value="50">50</option>
                        <option value="51">51</option>
                        <option value="52">52</option>
                        <option value="53">53</option>
                        <option value="54">54</option>
                        <option value="55">55</option>
                        <option value="56">56</option>
                        <option value="57">57</option>
                        <option value="58">58</option>
                        <option value="59">59</option>
                     </select>
                  </td>
                  <td bgColor="#e4e4e4"><input size=25 name="notes_1<?php echo $i?>" id="notes_1<?php echo $i?>" ></td>
               </tr>
               <?php
                  }
                  
                  ?>
               <tr>
                  <td bgColor="#e4e4e4" colspan=4 align=center>
                     <input type="button" value="Bulk Add" name="btnbulkadd" onclick="checkdate()">
                  </td>
               </tr>
            </table>
         </form>
      </div>
   </body>
</html>