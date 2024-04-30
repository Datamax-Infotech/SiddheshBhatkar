<?php
   session_start();
   
   require_once("inc/header_session.php");
   require_once("../mainfunctions/database.php");
   require_once("../mainfunctions/general-functions.php");
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Companies are On Hold</title>
      <link rel="stylesheet" type="text/css" href="css/new_header-dashboard.css" />
      <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
      <link rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>
   </head>
   <script>
      function remove_hold(cnt) {
      
      	if(confirm("Do you want to remove On hold flag?") == true) {
      
      		var note = document.getElementById('notes_' + cnt).value;
      
      		document.getElementById("holdrow_" + cnt).innerHTML = "<br><br>Loading .....<img src='images/wait_animated.gif' />";
      
      		if(window.XMLHttpRequest){
      
      			xmlhttp = new XMLHttpRequest();
    
      		} else {
      
      			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      
      		xmlhttp.onreadystatechange = function() {
      
      			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
      
      				document.onholdfrm.submit();
      			}
      		}
      
      		xmlhttp.open("GET", "comp_putonhold_remove.php?cnt=" + cnt + "&note=" + note, true);
      
      		xmlhttp.send();
      
      	}
      }
   </script>
   <style>
      .outer-container {
      width: 100%;
      margin: 0 auto;
      }
      .container {
      padding: 0 10px 10px;
      }
      .content {
      margin: 0 auto;
      width: 100%;
      display: grid;
      }
      .txtstyle_color {
      font-family: arial;
      font-size: 13;
      font-weight: 700;
      height: 16px;
      background: #d6d6d6;
      color: #333333;
      text-align: center;
      }
      .datarow tr:hover td {
      background-color: #FFFFFF;
      }
      .rowstyle {
      padding: 0 5px;
      background-color: #EFEFEF;
      }
      .center {
      text-align: center;
      }
      .left {
      text-align: left;
      }
      .right {
      text-align: right;
      }
      .white_content {
      display: none;
      position: absolute;
      top: 5%;
      left: 10%;
      width: 60%;
      height: 70%;
      padding: 16px;
      border: 1px solid gray;
      background-color: white;
      z-index: 99;
      overflow: auto;
      }
   </style>
   <body>
      <?php include("inc/header.php"); ?>
      <div class="container">
         <div class="content">
            <div class="main_data_css">
               <div class="dashboard_heading" style="float: left;">
                  <div style="float: left;">
                     Companies are On Hold
                     <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
                        <span class="tooltiptext">This report allows the user to see all company records which are marked as "ON HOLD".</span>
                     </div>
                     <div style="height: 13px;">&nbsp;</div>
                  </div>
               </div>
               <form method="get" name="onholdfrm" id="onholdfrm" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                  	<table>
                     	<tr>
                        	<td>
                           		<div style="padding:0 20px 0 0;">
									<select name="transacFilter" id="transacFilter">
										<option value="0" <?php if(isset($_REQUEST["transacFilter"])){ if($_REQUEST["transacFilter"] == "0") {
											echo " selected ";
											}} ?>>All</option>
										<option value="1" <?php if(isset($_REQUEST["transacFilter"])){ if($_REQUEST["transacFilter"] == "1") {
											echo " selected ";
										echo " selected ";
											} } ?>>Sales</option>
										<option value="2" <?php if(isset($_REQUEST["transacFilter"])){ if($_REQUEST["transacFilter"] == "2") {
	  									}}?>>Purchasing</option>
									</select>
                           		</div>
                        	</td>
							<td>
                           		<input type="hidden" id="reprun" name="reprun" value="yes">
                           		<input type="submit" value="Run Report">
               				</td>
               			</tr>
               		</table>
            	</div>
         	</div>
         	<br>
         	<div class="content">
				<?php
				$sorturl = "report_list_onhold.php?transacFilter=" . $_REQUEST['transacFilter'] . "&sort_order_pre=";
				
				$arrowasc = "<img src='images/sort_asc.png' width='6px' height='12px'>";
				
				$arrowdesc = "<img src='images/sort_desc.png' width='6px' height='12px'>";
				
				?>
				<table class="datarow" cellSpacing='1' cellPadding='1' border='0'>
				<thead>
					<tr>
						<th width="100%" bgcolor="#C0CDDA" align="center" colspan="4">
							<font face="Arial, Helvetica, sans-serif">On Hold - Companies</font>
						</th>
					</tr>
					<tr>
						<th class='txtstyle_color' width='10%'>Sr. No. </th>
						<th class='txtstyle_color' width='25%'>Company Name &nbsp;
							<a href='<?php echo $sorturl; ?>ASC&sort=cname'><?php echo $arrowasc; ?></a>&nbsp;
							<a href='<?php echo $sorturl; ?>DESC&sort=cname'><?php echo $arrowdesc; ?></a>
						</th>
						<th class='txtstyle_color' width='50%'>Internal Notes&nbsp;
							<a href='<?php echo $sorturl; ?>ASC&sort=notes'><?php echo $arrowasc; ?></a>&nbsp;
							<a href='<?php echo $sorturl; ?>DESC&sort=notes'><?php echo $arrowdesc; ?></a>
						</th>
						<th class='txtstyle_color' width='14%'>Action&nbsp;
						</th>
					</tr>
				</thead>
				<?php
					if (isset($_REQUEST["sort"])) {
					
						$MGArray = $_SESSION['sortarrayn'];
					
					
					
						if ($_GET['sort'] == "notes") {
					
							$MGArraysort_I = array();
					
							foreach ($MGArray as $MGArraytmp) {
					
								$MGArraysort_I[] = $MGArraytmp['notes'];
							}
					
							if ($_GET['sort_order_pre'] == "ASC") {
					
								array_multisort($MGArraysort_I, SORT_ASC, SORT_NUMERIC, $MGArray);
							}
					
							if ($_GET['sort_order_pre'] == "DESC") {
					
								array_multisort($MGArraysort_I, SORT_DESC, SORT_NUMERIC, $MGArray);
							}
						}
					
						if ($_GET['sort'] == "cname") {
					
							$MGArraysort_I = array();
					
							foreach ($MGArray as $MGArraytmp) {
					
								$MGArraysort_I[] = $MGArraytmp['company_name'];
							}
					
							if ($_GET['sort_order_pre'] == "ASC") {
					
								array_multisort($MGArraysort_I, SORT_ASC, SORT_STRING, $MGArray);
							}
					
							if ($_GET['sort_order_pre'] == "DESC") {
					
								array_multisort($MGArraysort_I, SORT_DESC, SORT_STRING, $MGArray);
							}
						}
					
						foreach ($MGArray as $MGArraytmp2) {
					
							if ($MGArraytmp2["compid"] != "") {
					
				?>
								<tr id="holdrow_<?php echo $MGArraytmp2['compid'] ?>">
									<td class='rowstyle center'><?php echo ++$cnt; ?></td>
									<td class='rowstyle'><a target='_blank' href='viewCompany.php?ID=<?php echo $MGArraytmp2['compid']; ?>&show=&warehouse_id=&rec_type=&proc=&searchcrit=&id=&rec_id=&display='><?php echo $MGArraytmp2["company_name"]; ?></a></td>
									<td class='rowstyle'>
										<textarea id="notes_<?php echo $MGArraytmp2['compid']; ?>" style="width:95%;"><?php echo $MGArraytmp2['notes'] ?></textarea>
									</td>
									<td class='rowstyle center'><input onclick="remove_hold(<?php echo $MGArraytmp2['compid'] ?>);" type="button" value="Remove Hold" /></td>
								</tr>
							<?php
							} else {
							
							?>
								<tr>
									<td class='rowstyle center' colspan='4'>
										<?php echo '<i><font color="red">No Record found.</font></i>'; ?>
									</td>
								</tr>
							<?php
							}
						}
					} else {
					
					if (isset($_GET["reprun"]) && $_GET["reprun"] == "yes") {
					
					$_SESSION['sortarrayn'] = $MGArray = "";
					
					$start_Dt = $_GET["date_from"];
					
					$end_Dt = $_GET["date_to"];
					
					if (isset($_GET['transacFilter'])) {
					
						if ($_GET['transacFilter'] == 0) {
					
							$searchstring = " ";
						}
					
						if ($_GET['transacFilter'] == 1) {
					
							$searchstring = " AND haveNeed = 'Need Boxes'";
						}
					
						if ($_GET['transacFilter'] == 2) {
					
							$searchstring = " AND haveNeed = 'Have Boxes'";
						}
					}
					
					$sql = "SELECT * FROM companyInfo WHERE on_hold = 1 AND active = 1 " . $searchstring . " ORDER BY ID";
					
					db_b2b();
					$result = db_query($sql);
					
					if (!empty($result)) {
					
						while ($row = array_shift($result)) {
					
							$nickname = "";
					
							if ($row["nickname"] != "") {
					
								$nickname = $row["nickname"];
							} else {
					
								$tmppos_1 = strpos($row["company"], "-");
					
								if ($tmppos_1 != false) {
					
									$nickname = $row["company"];
								} else {
					
									if ($row["shipCity"] <> "" || $row["shipState"] <> "") {
					
										$nickname = $row["company"] . " - " . $row["shipCity"] . ", " . $row["shipState"];
									} else {
										$nickname = $row["company"];
									}
								}
							}
					
							$rwcnt += 1;
					
					?>
							<tr id="holdrow_<?php echo $row['ID'] ?>">
								<td class='rowstyle center'><?php echo $rwcnt; ?></td>
								<td class='rowstyle'>
									<a target="_blank" href="viewCompany.php?ID=<?php echo $row['ID']; ?>&proc=View&searchcrit=&show=summary&rec_type="><?php echo $nickname; ?></a>
								</td>
								<td class='rowstyle'>
									<textarea id="notes_<?php echo $row['ID']; ?>" style="width:95%;"><?php echo $row['int_notes'] ?></textarea>
								</td>
								<td class='rowstyle center'><input onclick="remove_hold(<?php echo $row['ID'] ?>);" type="button" value="Remove Hold" /></td>
							</tr>
							<?php
								$MGArray[] = array(
									'compid' => $row["ID"],
									'company_name' => $nickname,
									'haveNeed' => $row["haveNeed"],
									'notes' => $row['int_notes']
								);
							}
					
					$_SESSION['sortarrayn'] = $MGArray;
					} else {
					
					?>
								<tr>
									<td class='rowstyle center' colspan='9'>
										<?php echo '<i><font color="red">No Record found.</font></i>'; ?>
									</td>
								</tr>
					<?php
							}
						}
					}
					
					?>
				</table>
         </div>
      </div>
      </div>
   </body>
</html>