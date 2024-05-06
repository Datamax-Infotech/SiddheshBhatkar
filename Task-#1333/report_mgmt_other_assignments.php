<?php
  session_start();
  require ("inc/header_session.php");
  require ("../mainfunctions/database.php");
  require ("../mainfunctions/general-functions.php");
  
  db();
  
  ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>Purchasing Account Ownership Summary Report - UCB Purchasing Review Report</title>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
    <LINK rel='stylesheet' type='text/css' href='css/ucb_common_style.css' >
    <link rel="stylesheet" href="sorter/style_rep.css" />
    <style type="text/css">
      .txtstyle_color
      {
      font-family:arial;
      font-size:12;
      height: 16px; 
      background:#ABC5DF;
      }
    </style>
    <script type="text/javascript" src="sorter/jquery-latest.js"></script>
    <script type="text/javascript" src="sorter/jquery.tablesorter.js"></script>
  </head>
  <body>
    <? include("inc/header.php"); ?>
    <div id="light" class="white_content">
    </div>
    <div id="fade" class="black_overlay"></div>
    <div class="main_data_css">
      <div class="dashboard_heading" style="float: left;">
        <div style="float: left;">
          Purchasing Account Ownership Summary Report
          <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
            <span class="tooltiptext">This report shows the user all B2B purchasing records in the system summarized by account owner.</span>
          </div>
          <br>
        </div>
      </div>
      <!-- 
        <table border="0" >
        <tr><td width="700px" align="center" style="font-size:24pt;"><strong>UCB Sales Review Report</strong></td>
        	<td width="200px" align="right"><img src="images/image001.jpg" width="70" height="70"/></td></tr>
        </table >
        -->
      <table border="0" >
        <tr>
          <td valign="top">
            <table cellSpacing="1" cellPadding="1" border="0" width="100%">
              <tr>
                <td class="txtstyle_color" align="center" style="font-size:14pt;"><strong>Purchasing Assignments</strong></td>
              </tr>
            </table>
            <table cellSpacing="1" cellPadding="1" border="0" width="100%" id="table15" class="tablesorter">
              <thead>
                <tr>
                  <th width="180px" bgColor='#E4EAEB'><u>Employee</u></th>
                  <th width='110px' bgColor='#E4EAEB'><u>Need to Qualify</u></th>
                  <th width='110px' bgColor='#E4EAEB'><u>Qualified<br>Back Burner</u></th>
                  <th width='110px' bgColor='#E4EAEB'><u>Proposal /Quoting</u></th>
                  <th width='110px' bgColor='#E4EAEB'><u>Engaged<br>(without contract)</u></th>
                  <th width='110px' bgColor='#E4EAEB'><u>Engaged<br>(with contract)</u></th>
                  <th width='110px' bgColor='#E4EAEB' style='border-left: 1px solid #000;'><u>Good<br>Account Total</u></th>
                  <th width='30px'>&nbsp;</th>
                  <th width='105px' bgColor='#E4EAEB'><u>Unqualified</u></th>
                  <th width='105px' bgColor='#E4EAEB'><u>Inactive<br>(out of business)</u></th>
                  <th width='105px' bgColor='#E4EAEB'><u>Trash<br>(duplicate /oopsies)</u></th>
                  <th width='105px' bgColor='#E4EAEB' style='border-left: 1px solid #000;'><u>Bad<br>Account Total</u></th>
                </tr>
              </thead>
              <tbody>
                <?php
                 
                  $grandtot = 0;
                  $emp_list = "";
                  $col1= 0; $col2= 0; $col3= 0; $col4= 0; $col5= 0; $col6= 0; $col7= 0; $col8= 0; $col9= 0; $col10= 0; $col11= 0;$col12= 0;$col13= 0;$col14= 0;
                  $sql = "SELECT assignedto, employeeID, name, count(assignedto) FROM companyInfo inner join employees on employees.employeeID = companyInfo.assignedto where haveNeed='Have Boxes' AND companyInfo.status IN (55,38,44,49,65,70,73) group by companyInfo.assignedto having count(assignedto) > 0 order by count(assignedto) desc";
				  db_b2b() ; 
				  $resulte = db_query($sql);
                  
                  while ($rowemp = array_shift($resulte)) {
                  	
                  	$emp_list .= $rowemp["employeeID"].",";
                  	
                  	$tmp1 = $tmp2 = $tmp3 = $tmp4 = $tmp5 = $tmp6 = $tmp7 = $tmp8 = $tmp9 = $tmp10 = $tmp11 = 0;
				    db_b2b();
					$sql = db_query("SELECT status, count(ID) as cnt FROM companyInfo WHERE haveNeed='Have Boxes' AND assignedto = '" . $rowemp["employeeID"] . "' AND status IN (55,38,44,49,65,70,73,31) GROUP BY `status` ");
                  	$array = array_combine(array_column($sql, 'status'), array_column($sql, 'cnt'));
                  	
                  	if (array_key_exists('65', $array)) { $tmp1 = $array['65']; }
                  	if (array_key_exists('73', $array)) { $tmp2 = $array['73']; }
                  	if (array_key_exists('70', $array)) { $tmp3 = $array['70']; }
                  	if (array_key_exists('55', $array)) { $tmp4 = $array['55']; }
                  	if (array_key_exists('38', $array)) { $tmp5 = $array['38']; }
                  	$tmp6 = $tmp1 + $tmp2 + $tmp3 + $tmp4 + $tmp5;
                  	
                  	if (array_key_exists('44', $array)) { $tmp7 = $array['44']; }
                  	if (array_key_exists('49', $array)) { $tmp8 = $array['49']; }
                  	if (array_key_exists('31', $array)) { $tmp9 = $array['31']; }
                  	$tmp10 = $tmp7 + $tmp8 + $tmp9;
                  	
                  	echo "<tr><td bgColor='#E4EAEB'>" . $rowemp["name"] . "</td>";
                  	echo "<td bgColor='#E4EAEB' align=right>";
                  		$col2 = $col2 + $tmp1;
                  		echo "<a target='_blank' href='report_show_assignments.php?comp=purchasing&show=status&statusid=65&eid=" . $rowemp["employeeID"] . "'>" . $tmp1 . "</a>";
                  	echo "</td><td bgColor='#E4EAEB' align=right>";
                  		$col3 = $col3 + $tmp2;
                  		echo "<a target='_blank' href='report_show_assignments.php?comp=purchasing&show=status&statusid=73&eid=" . $rowemp["employeeID"] . "'>" . $tmp2 . "</a>";
                  	echo "</td><td bgColor='#E4EAEB' align=right>";
                  		$col4 = $col4 + $tmp3;
                  		echo "<a target='_blank' href='report_show_assignments.php?comp=purchasing&show=status&statusid=70&eid=" . $rowemp["employeeID"] . "'>" . $tmp3 . "</a>";
                  	echo "</td><td bgColor='#E4EAEB' align=right>";
                  		$col5 = $col5 + $tmp4;	
                  		echo "<a target='_blank' href='report_show_assignments.php?comp=purchasing&show=status&statusid=55&eid=" . $rowemp["employeeID"] . "'>" . $tmp4 . "</a>";
                  	echo "</td><td bgColor='#E4EAEB' align=right>";
                  		$col6 = $col6 + $tmp5;	
                  		echo "<a target='_blank' href='report_show_assignments.php?comp=purchasing&show=status&statusid=38&eid=" . $rowemp["employeeID"] . "'>" . $tmp5 . "</a>";
                  	echo "</td><td bgColor='#E4EAEB' style='border-left: 1px solid #000;' align=right>";
                  		$col7 = $col7 + $tmp6;
                  		echo "<a target='_blank' href='report_show_assignments.php?comp=purchasing&show=status&statusid=65,73,70,55,38&eid= " . $rowemp["employeeID"] . "'>" . $tmp6 . "</a>";
                  	echo "</td><td align=right>&nbsp;";
                  	
                  	echo "</td><td bgColor='#E4EAEB' align=right>";
                  		$col8 = $col8 + $tmp7;
                  		echo "<a target='_blank' href='report_show_assignments.php?comp=purchasing&show=status&statusid=44&eid=" . $rowemp["employeeID"] . "'>" . $tmp7 . "</a>";
                  	echo "</td><td bgColor='#E4EAEB' align=right>";
                  		$col9 = $col9 + $tmp8;
                  		echo "<a target='_blank' href='report_show_assignments.php?comp=purchasing&show=status&statusid=49&eid=" . $rowemp["employeeID"] . "'>" . $tmp8 . "</a>";
                  	echo "<td bgColor='#E4EAEB' align=right>";
                  		$col10 = $col10 + $tmp9;	
                  		echo "<a target='_blank' href='report_show_assignments.php?comp=purchasing&show=status&statusid=31&eid=" . $rowemp["employeeID"] . "'>" . $tmp9 . "</a>";
                  		
                  	echo "</td><td bgColor='#E4EAEB' align=right style='border-left: 1px solid #000;'>";
                  		$col11 = $col11 + $tmp10;
                  		echo "<a target='_blank' href='report_show_assignments.php?comp=purchasing&show=status&statusid=44,49,31&eid=" . $rowemp["employeeID"] . "'>" . $tmp10 . "</a>";
                  		
                  	echo "</td>";
                  
                  	echo "</tr>";
                  		
                  }
                  
                  echo "</tbody>";	
                  echo "<tr><td bgColor='#E4EAEB' align=left><b>Unassigned</b></td>";
                  $unassign_col2 = $unassign_col3 = $unassign_col4 = $unassign_col5 = $unassign_col6 = 0;
                  $unassign_col7 = $unassign_col8 = $unassign_col9 = $unassign_col10 = $unassign_col11 = 0;
                  
				  db_b2b() ;
				  $sqlu = db_query("SELECT status, count(ID) as cnt FROM companyInfo WHERE haveNeed='Have Boxes' AND assignedto = '' AND status IN (55,38,44,49,65,70,73,31) GROUP BY `status` ");
                  
                  $array = array_combine(array_column($sqlu, 'status'), array_column($sqlu, 'cnt'));
                  if (array_key_exists('65', $array)) { $unassign_col2 = $unassign_col2 + $array['65'];}
                  if (array_key_exists('73', $array)) { $unassign_col3 = $unassign_col3 + $array['73'];}
                  if (array_key_exists('70', $array)) { $unassign_col4 = $unassign_col4 + $array['70'];}
                  if (array_key_exists('55', $array)) { $unassign_col5 = $unassign_col5 + $array['55'];}
                  if (array_key_exists('38', $array)) { $unassign_col6 = $unassign_col6 + $array['38'];}
                  $unassign_col7 = $unassign_col2 + $unassign_col3 + $unassign_col4 + $unassign_col5 + $unassign_col6;
                  if (array_key_exists('44', $array)) { $unassign_col8 = $unassign_col8 + $array['44'];}
                  if (array_key_exists('49', $array)) { $unassign_col9 = $unassign_col9 + $array['49'];}
                  if (array_key_exists('31', $array)) { $unassign_col10 = $unassign_col10 + $array['31'];}
                  $unassign_col11 = $unassign_col8 + $unassign_col9 + $unassign_col10;
                  
                  echo "<td bgColor='#E4EAEB' align=right>";
                  			
                  echo "<a target='_blank' href='report_show_assignments.php?comp=purchasing&show=status&statusid=65&eid='>" . $unassign_col2 . "</a>";
                  	
                  echo "</td><td bgColor='#E4EAEB' align=right>";
                  			
                  	echo "<a target='_blank' href='report_show_assignments.php?comp=purchasing&show=status&statusid=73&eid='>" . $unassign_col3 . "</a>";
                  	
                  echo "</td><td bgColor='#E4EAEB' align=right>";
                  			
                  	echo "<a target='_blank' href='report_show_assignments.php?comp=purchasing&show=status&statusid=70&eid='>" . $unassign_col4 . "</a>";
                  	
                  echo "</td><td bgColor='#E4EAEB' align=right>";
                  		
                  	echo "<a target='_blank' href='report_show_assignments.php?comp=purchasing&show=status&statusid=55&eid='>" . $unassign_col5 . "</a>";
                  	
                  echo "</td><td bgColor='#E4EAEB' align=right>";
                  		
                  	echo "<a target='_blank' href='report_show_assignments.php?comp=purchasing&show=status&statusid=38&eid='>" . $unassign_col6 . "</a>";
                  	
                  echo "</td><td bgColor='#E4EAEB' align=right style='border-left: 1px solid #000;'>";
                  	echo "<a target='_blank' href='report_show_assignments.php?comp=purchasing&show=status&statusid=65,73,70,55,38&eid='>" . $unassign_col7 . "</a>";
                  echo "</td><td align=right>&nbsp;";
                  echo "</td><td bgColor='#E4EAEB' align=right>";
                  	echo "<a target='_blank' href='report_show_assignments.php?comp=purchasing&show=status&statusid=44&eid='>" . $unassign_col8 . "</a>";
                  	
                  echo "</td><td bgColor='#E4EAEB' align=right>";
                  	echo "<a target='_blank' href='report_show_assignments.php?comp=purchasing&show=status&statusid=49&eid='>" . $unassign_col9 . "</a>";
                  	
                  echo "</td><td bgColor='#E4EAEB' align=right>";
                  	echo "<a target='_blank' href='report_show_assignments.php?comp=purchasing&show=status&statusid=31&eid='>" . $unassign_col10 . "</a>";
                  echo "</td><td bgColor='#E4EAEB' align=right style='border-left: 1px solid #000;'>";
                  			
                  	echo "<a target='_blank' href='report_show_assignments.php?comp=purchasing&show=status&statusid=44,49,31&eid='>" . $unassign_col11 . "</a>";
                  echo "</td></tr>";
                  
                  
                  $emp_list = rtrim($emp_list, ",");	
                  $sorturl = "report_show_assignments_new.php?comp=purchasing&show=status&eid=".$emp_list."&statusid=";
                  
                  echo "<tr><td bgColor='#E4EAEB' align=right><b>Total</b></td>";
                  echo "<td bgColor='#E4EAEB' align=right><strong>";
                  echo "<a target='_blank' href='".$sorturl."65'>". ($col2+$unassign_col2) . "</a>";
                  echo "</strong></td><td bgColor='#E4EAEB' align=right><strong>";
                  echo "<a target='_blank' href='".$sorturl."73'>". ($col3+$unassign_col3) . "</a>";
                  echo "</strong></td><td bgColor='#E4EAEB' align=right><strong>";
                  echo "<a target='_blank' href='".$sorturl."70'>". ($col4+$unassign_col4) . "</a>";
                  echo "</strong></td><td bgColor='#E4EAEB' align=right><strong>";
                  echo "<a target='_blank' href='".$sorturl."55'>". ($col5+$unassign_col5) . "</a>";
                  echo "</strong></td><td bgColor='#E4EAEB' align=right><strong>";
                  echo "<a target='_blank' href='".$sorturl."38'>". ($col6+$unassign_col6) . "</a>";
                  echo "</strong></td><td bgColor='#E4EAEB' align=right style='border-left: 1px solid #000;'><strong>";
                  echo "<a target='_blank' href='".$sorturl."65,73,70,55,38'>". ($col7+$unassign_col7) . "</a>";
                  echo "</strong></td><td>&nbsp;</td><td bgColor='#E4EAEB' align=right><strong>";
                  echo "<a target='_blank' href='".$sorturl."44'>". ($col8+$unassign_col8) . "</a>";
                  echo "</strong></td><td bgColor='#E4EAEB' align=right><strong>";
                  echo "<a target='_blank' href='".$sorturl."49'>". ($col9+$unassign_col9) . "</a>";
                  echo "</strong></td><td bgColor='#E4EAEB' align=right><strong>";
                  echo "<a target='_blank' href='".$sorturl."31'>". ($col10+$unassign_col10) . "</a>";
                  echo "</strong></td><td bgColor='#E4EAEB' align=right style='border-left: 1px solid #000;'><strong>";
                  echo "<a target='_blank' href='".$sorturl."44,49,31'>". ($col11+$unassign_col11) . "</a>";			
                  echo "</strong></td>";
                  
                  echo "</tr>";
                  
                  ?>
            </table>
          </td>
        </tr>
      </table>
    </div>
  </body>
</html>