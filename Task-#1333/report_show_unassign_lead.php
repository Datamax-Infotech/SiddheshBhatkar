<?php
	require ("inc/header_session.php");
	require ("../mainfunctions/database.php");
	require ("../mainfunctions/general-functions.php");
	require ("functions_for_report_search_table.php");

?>
<!DOCTYPE html>
<html>
	<head>

		<title>Accounts with No Account Owner Report</title>

		<link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet"> 

		<LINK rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>

		<meta http-equiv="refresh" content="1800" />	

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

			font-size: 10px; 

			color : #000000; 

			font-weight: normal; 

			}



				span.infotxt:hover {text-decoration: none; background: #ffffff; z-index: 6; }

				span.infotxt span {position: absolute; left: -9999px; margin: 20px 0 0 0px; padding: 3px 3px 3px 3px; z-index: 6;}

				span.infotxt:hover span {left: 45%; background: #ffffff;} 

				span.infotxt span {position: absolute; left: -9999px; margin: 0px 0 0 0px; padding: 3px 3px 3px 3px; border-style:solid; border-color:black; border-width:1px;}

				span.infotxt:hover span {margin: 18px 0 0 170px; background: #ffffff; z-index:6;} 

				

				span.infotxt_freight:hover {text-decoration: none; background: #ffffff; z-index: 6; }

				span.infotxt_freight span {position: absolute; left: -9999px; margin: 20px 0 0 0px; padding: 3px 3px 3px 3px; z-index: 6;}

				span.infotxt_freight:hover span {left: 0%; background: #ffffff;} 

				span.infotxt_freight span {position: absolute; width:850px; overflow:auto; height:300px; left: -9999px; margin: 0px 0 0 0px; padding: 10px 10px 10px 10px; border-style:solid; border-color:white; border-width:50px;}

				span.infotxt_freight:hover span {margin: 5px 0 0 50px; background: #ffffff; z-index:6;} 

				

				span.infotxt_freight2:hover {text-decoration: none; background: #ffffff; z-index: 6; }

				span.infotxt_freight2 span {position: absolute; left: -9999px; margin: 20px 0 0 0px; padding: 3px 3px 3px 3px; z-index: 6;}

				span.infotxt_freight2:hover span {left: 0%; background: #ffffff;} 

				span.infotxt_freight2 span {position: absolute; width:850px; overflow:auto; height:300px; left: -9999px; margin: 0px 0 0 0px; padding: 10px 10px 10px 10px; border-style:solid; border-color:white; border-width:50px;}

				span.infotxt_freight2:hover span {margin: 5px 0 0 500px; background: #ffffff; z-index:6;} 



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

				.nowrap_style{

				white-space: nowrap;

			}

		</style>	
	</head>
<body>

	<?php include("inc/header.php"); ?>

	<div class="main_data_css">

	<div class="dashboard_heading" style="float: left;">

		<div style="float: left;">

			Accounts with No Account Owner Report  

		

		<div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>

		<span class="tooltiptext">This report allows the user to see all company records (accounts) which are still assigned to an inactive account owner.</span></div><br>

		</div>

	</div>


		<table width="100%">
			<tr>
				<td width="80%">
					<!-- Load the page by default with old logic - do not apply date range-->
					<table border="0" >
						<tr>
							<td colspan="5" align="left" >
								<form method="get" name="rpt_leaderboard" action="report_show_unassign_lead.php">
									<table border="0">
										<tr>
											<td>Select Status:</td>
											<td>
												<select name="sel_status">
													<option value="" >All Records</option> 
													<option value="onlysales"  <?php if ($_GET["sel_status"] == "onlysales") { echo " selected "; }?> >Sales Records Only</option> 
													<option value="onlypurchasing"  <?php if ($_GET["sel_status"] == "onlypurchasing") { echo " selected "; }?> >Purchasing Records Only</option> 
													<?php

														$tableedit  = "SELECT * FROM status where (sales_flg = 0 or sales_flg = 1 or sales_flg = 2)order by sort_order";
														db_b2b();
														$dt_view_res = db_query($tableedit);

														while ($row = array_shift($dt_view_res)) {

													?>
															<option value="<?php echo $row["id"];?>" <?php if ($_GET["sel_status"] == $row["id"]) { echo " selected "; }?>><?php echo $row["name"];?>
															</option>

													<?php

													}

													?>
												</select>					
											</td>
											<td>
												<input type="submit" value="Run Report">
											</td>
										</tr>
									</table>
								</form>
							</td>
						</tr>
						<?php
							if (isset($_GET["sel_status"]) && $_GET["sel_status"] != ""){
						?>	
						<tr valign="top">
							<td valign="top">
								<?php
									$arr = array($_GET["sel_status"]);
									
									showStatusesDashboard_new($arr, $eid, 0, "all");
								?>
							</td>
						</tr>
						<?php } ?>
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>

