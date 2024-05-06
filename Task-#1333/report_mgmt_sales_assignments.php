<?php
  session_start();
  require ("inc/header_session.php");
  require ("../mainfunctions/database.php");
  require ("../mainfunctions/general-functions.php");
  
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Sales Account Ownership Summary Report - UCB Sales Review Report</title>
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
    <?php include("inc/header.php"); ?>
    <div class="main_data_css">
      <div class="dashboard_heading" style="float: left;">
        <div style="float: left;">
          Sales Account Ownership Summary Report
          <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
            <span class="tooltiptext">This report shows the user all B2B sales records in the system summarized by account owner.</span>
          </div>
          <br>
        </div>
      </div>
      <table border="0" >
        <tr>
          <td style="font-size:16pt;"><strong>Lead Assignment</strong></td>
        </tr>
        <tr>
          <td valign="top">
            <table cellSpacing="1" cellPadding="1" border="0" width="1300">
              <tr>
                <td class="txtstyle_color" align="center" style="font-size:14pt;"><strong>Sales Assignments</strong></td>
              </tr>
            </table>
            <table cellSpacing="1" cellPadding="1" border="0" width="1300" id="table15" class="tablesorter">
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
				  db_b2b();
				  $sql = "SELECT assignedto, employeeID, name, count(assignedto) FROM companyInfo inner join employees on employees.employeeID = companyInfo.assignedto where haveNeed='Need Boxes' AND companyInfo.status IN (3,50,32,56,51,43,24,31) group by companyInfo.assignedto having count(assignedto) > 0 order by count(assignedto) desc";
                  $resulte = db_query($sql);
                  
                  while ($rowemp = array_shift($resulte)) {
                  	
                  	$emp_list .= $rowemp["employeeID"].",";
                  	
                  	$tmp1 = $tmp2 = $tmp3 = $tmp4 = $tmp5 = $tmp6 = $tmp7 = $tmp8 = $tmp9 = $tmp10 = $tmp11 = 0;
					db_b2b();
					$sql = db_query("SELECT status, count(ID) as cnt FROM companyInfo WHERE haveNeed='Need Boxes' AND assignedto = '" . $rowemp["employeeID"] . "' AND status IN (3,50,32,56,51,43,24,31) GROUP BY `status` ");
                  	$array = array_combine(array_column($sql, 'status'), array_column($sql, 'cnt'));
                  	
                  	if (array_key_exists('3', $array)) { $tmp1 = $array['3']; }
                  	if (array_key_exists('50', $array)) { $tmp2 = $array['50']; }
                  	if (array_key_exists('32', $array)) { $tmp3 = $array['32']; }
                  	if (array_key_exists('56', $array)) { $tmp4 = $array['56']; }
                  	if (array_key_exists('51', $array)) { $tmp5 = $array['51']; }
                  	$tmp6 = $tmp1 + $tmp2 + $tmp3 + $tmp4 + $tmp5;
                  	
                  	if (array_key_exists('43', $array)) { $tmp7 = $array['43']; }
                  	if (array_key_exists('24', $array)) { $tmp8 = $array['24']; }
                  	if (array_key_exists('31', $array)) { $tmp9 = $array['31']; }
                  	$tmp10 = $tmp7 + $tmp8 + $tmp9;
                  	$col1 = $col1 + $tmp1;
                  	
                  	echo "<tr><td bgColor='#E4EAEB'>" . $rowemp["name"] . "</td><td bgColor='#E4EAEB' align=right>";
                  	echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=3&eid=" . $rowemp["employeeID"] . "'>" . $tmp1 . "</a></td>";
                  	echo "</td>";
                  			
                  	echo "<td bgColor='#E4EAEB' align=right>";
                  		$col2 = $col2 + $tmp2;
                  	echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=50&eid=" . $rowemp["employeeID"] . "'>" . $tmp2 . "</a>";
                  	
                  	echo "</td><td bgColor='#E4EAEB' align=right>";
                  		$col3 = $col3 + $tmp3;	
                  	echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=32&eid=" . $rowemp["employeeID"] . "'>" . $tmp3 . "</a>";
                  	
                  	echo "</td><td bgColor='#E4EAEB' align=right>";
                  		$col4 = $col4 + $tmp4;	
                  	echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=56&eid=" . $rowemp["employeeID"] . "'>" . $tmp4 . "</a>";
                  	echo "</td><td bgColor='#E4EAEB' align=right>";
                  		$col5 = $col5 + $tmp5;	
                  		echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=51&eid=" . $rowemp["employeeID"] . "'>" . $tmp5 . "</a>";
                  	echo "</td><td bgColor='#E4EAEB' align=right style='border-left: 1px solid #000;'>";
                  		$col6 = $col6 + $tmp6;
                  	echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=3,50,32,56,51&eid=" . $rowemp["employeeID"] . "'>" . $tmp6 . "</a>";
                  	echo "</td><td align=right> &nbsp;";
                  	echo "</td><td bgColor='#E4EAEB' align=right>";
                  		$col7 = $col7 + $tmp7;
                  		echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=43&eid=" . $rowemp["employeeID"] . "'>" . $tmp7 . "</a>";
                  	echo "</td><td bgColor='#E4EAEB' align=right>";
                  		$col8 = $col8 + $tmp8;
                  		echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=24&eid=" . $rowemp["employeeID"] . "'>" . $tmp8 . "</a>";
                  	echo "</td><td bgColor='#E4EAEB' align=right>";
                  		$col9 = $col9 + $tmp9;
                  		echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=31&eid=" . $rowemp["employeeID"] . "'>" . $tmp9 . "</a>";
                  		
                  	echo "</td><td bgColor='#E4EAEB' align=right style='border-left: 1px solid #000;'>";
                  		$col10 = $col10 + $tmp10;
                  		echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=43,24,31&eid=" . $rowemp["employeeID"] . "'>" . $tmp10 . "</a>";
                  	echo "</td>";
                  	echo "</tr>";
                  		
                  }
                  
                  
                  $unassign_col1 = $unassign_col2 = $unassign_col3 = $unassign_col4 = $unassign_col5 = 0;
                  $unassign_col6 = $unassign_col7 = $unassign_col8 = $unassign_col9 = $unassign_col10  = 0;
                  $sqlu = db_query("SELECT status, count(ID) as cnt FROM companyInfo WHERE haveNeed='Need Boxes' AND assignedto = '' AND status IN (3,50,32,56,51,43,24,31) GROUP BY `status` ");
                  
                  $array = array_combine(array_column($sqlu, 'status'), array_column($sqlu, 'cnt'));
                  if (array_key_exists('3', $array)) { $unassign_col1 = $unassign_col1 + $array['3'];}
                  if (array_key_exists('50', $array)) { $unassign_col2 = $unassign_col2 + $array['50'];}
                  if (array_key_exists('32', $array)) { $unassign_col3 = $unassign_col3 + $array['32'];}
                  if (array_key_exists('56', $array)) { $unassign_col4 = $unassign_col4 + $array['56'];}
                  if (array_key_exists('51', $array)) { $unassign_col5 = $unassign_col5 + $array['51'];}
                  $unassign_col6 = $unassign_col1 + $unassign_col2 + $unassign_col3 + $unassign_col4 + $unassign_col5;
                  if (array_key_exists('43', $array)) { $unassign_col7 = $unassign_col7 + $array['43'];}
                  if (array_key_exists('24', $array)) { $unassign_col8 = $unassign_col8 + $array['24'];}
                  if (array_key_exists('31', $array)) { $unassign_col9 = $unassign_col9 + $array['31'];}
                  $unassign_col10 = $unassign_col7 + $unassign_col8 + $unassign_col9;
                  
                  
                  echo "<tr><td bgColor='#E4EAEB' align=left><b>Unassigned</b></td>";
                  echo "<td bgColor='#E4EAEB' align=right>";
                  			
                  echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=3&eid='>". $unassign_col1 ."</a>";
                  	
                  echo "</td><td bgColor='#E4EAEB' align=right>";
                  			
                  echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=50&eid='>". $unassign_col2 ."</a>";
                  	
                  echo "</td><td bgColor='#E4EAEB' align=right>";
                  			
                  echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=32&eid='>". $unassign_col3 ."</a>";
                  	
                  echo "</td><td bgColor='#E4EAEB' align=right>";
                  		
                  echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=56&eid='>". $unassign_col4 ."</a>";
                  	
                  echo "</td><td bgColor='#E4EAEB' align=right>";
                  		
                  echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=51&eid='>". $unassign_col5 ."</a>";
                  	
                  echo "</td><td bgColor='#E4EAEB' align=right style='border-left: 1px solid #000;'>";
                  echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=3,50,32,56,51&eid='>" . $unassign_col6 . "</a>";
                  
                  echo "</td><td align=right>&nbsp;";
                  echo "</td><td bgColor='#E4EAEB' align=right>";
                  echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=43&eid='>". $unassign_col7 ."</a>";
                  	
                  echo "</td><td bgColor='#E4EAEB' align=right>";
                  echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=24&eid='>". $unassign_col8 ."</a>";
                  	
                  echo "</td><td bgColor='#E4EAEB' align=right>";
                  echo "<a target='_blank' href='report_show_assignments.php?show=status&statusid=31&eid='>". $unassign_col9 ."</a>";
                  echo "</td><td bgColor='#E4EAEB' align=right style='border-left: 1px solid #000;'>";
                  			
                  echo "<a target='_blank' href='report_show_assignments.php?comp=purchasing&show=status&statusid=43,24,31&eid='>" . $unassign_col10 . "</a>";
                  echo "</td></tr>";
                  echo "</tbody>";
                  
                  	
                  $emp_list = rtrim($emp_list, ",");	
                  $sorturl = "report_show_assignments_new.php?show=status&eid=".$emp_list."&statusid=";
                  
                  echo "<tr><td bgColor='#E4EAEB' align=right><b>Total</b></td><td bgColor='#E4EAEB' align=right><strong>";
                  echo "<a target='_blank' href='".$sorturl."3'>". ($col1 + $unassign_col1) . "</a>";
                  echo "</strong></td><td bgColor='#E4EAEB' align=right><strong>";
                  echo "<a target='_blank' href='".$sorturl."50'>". ($col2+$unassign_col2) . "</a>";
                  echo "</strong></td><td bgColor='#E4EAEB' align=right><strong>";
                  echo "<a target='_blank' href='".$sorturl."32'>". ($col3+$unassign_col3) . "</a>";
                  echo "</strong></td><td bgColor='#E4EAEB' align=right><strong>";
                  echo "<a target='_blank' href='".$sorturl."56'>". ($col4+$unassign_col4) . "</a>";
                  echo "</strong></td><td bgColor='#E4EAEB' align=right><strong>";
                  echo "<a target='_blank' href='".$sorturl."51'>". ($col5+$unassign_col5) . "</a>";
                  echo "</strong></td><td bgColor='#E4EAEB' align=right  style='border-left: 1px solid #000;'><strong>";
                  echo "<a target='_blank' href='".$sorturl."3,50,32,56,51'>". ($col6+$unassign_col6) . "</a>";
                  echo "</strong></td><td></td><td bgColor='#E4EAEB' align=right><strong>";
                  echo "<a target='_blank' href='".$sorturl."43'>". ($col7+$unassign_col7) . "</a>";
                  echo "</strong></td><td bgColor='#E4EAEB' align=right><strong>";
                  echo "<a target='_blank' href='".$sorturl."24'>". ($col8+$unassign_col8) . "</a>";
                  echo "</strong></td><td bgColor='#E4EAEB' align=right><strong>";
                  echo "<a target='_blank' href='".$sorturl."31'>". ($col9+$unassign_col9) . "</a>";
                  echo "</strong></td><td bgColor='#E4EAEB' align=right style='border-left: 1px solid #000;'><strong>";
                  echo "<a target='_blank' href='".$sorturl."43,24,31'>". ($col10+$unassign_col10) . "</a>";
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