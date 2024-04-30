<?php
	require("inc/header_session.php");
	require("mainfunctions/database.php");
	require("mainfunctions/general-functions.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Cancel Transaction Tool</title>
		<link rel='stylesheet' type='text/css' href='one_style.css'>
		<link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
		<link rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>

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

			select,
			input {
				font-family: Arial, Helvetica, sans-serif;
				font-size: 10px;
				color: #000000;
				font-weight: normal;
			}
		</style>

		<script type="text/javascript">
			function checkValidation() {
				var trans_rec_id = document.getElementById('trans_rec_id');
				var trans_type = document.getElementById('trans_type');
				var status = document.getElementById('status');
				if (trans_rec_id.value == '') {
					alert('Please enter ID.');
					trans_rec_id.focus();
					return false;
				}
				if (trans_type.value == '') {
					alert('Please select transaction.');
					trans_type.focus();
					return false;
				}
				if (status.value == '') {
					alert('Please select status.');
					status.focus();
					return false;
				}
				var option = confirm("Are you sure?");
				if (option == true) {
					document.frmReportUpdate.submit();
				}
			}
		</script>
	</head>
	<body>
		<?php include("inc/header.php"); ?>

		<div class="main_data_css">
			<div class="dashboard_heading" style="float: left;">
				<div style="float: left;">Cancel Transaction Tool</div>
				&nbsp;<div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
					<span class="tooltiptext">This tool allows the user to cancel or re-activate a transaction within a purchasing or sales record. This is generally only done if the customer cancelled the order. If the transaction was made by mistake, then use the Delete Transaction Tool. This used to be called the "Ignore" tool.</span>
				</div>
				<div style="height: 13px;">&nbsp;</div>
			</div>
		
			<form name="frmReportUpdate" action="report_ignore.php" method="POST">
				<table>
					<tr>
						<td colspan="7"><input type="hidden" name="action" value="run"></td>
					</tr>
					<tr>
						<td>Update ID: </td>
						<td><input type="text" size=2 name="trans_rec_id" id="trans_rec_id"></td>
						<td>of type </td>
						<td>
							<select name="trans_type" id="trans_type">
								<option value=1>Sales Transaction</option>
								<option value=2>Rescue Transaction</option>
							</select>
						</td>
						<td>of type</td>
						<td>
							<select name="status" id="status">
								<option value="0">Active</option>
								<option value="1">Ignore</option>
							</select>
						</td>
						<td>
							<input type="button" name="btnUpdate" id="btnUpdate" value="Update" onclick="checkValidation()">
						</td>
					</tr>
				</table>

			</form>
			
			<div ID="listdiv" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>
			
			<br></span></span></span>
		</div>

		<?php
			$recstatus = "";
			$tablename = "";

			if ($_REQUEST["action"] == 'run') {
				if ($_REQUEST["trans_type"] > 0) {
					if ($_REQUEST["trans_type"] == 1) {
						$tablename = " loop_transaction_buyer ";
					}

					if ($_REQUEST["trans_type"] == 2) {
						$tablename = " loop_transaction ";
					}

					if ($_REQUEST["status"] == 0) {
						$recstatus = "Active";
					}

					if ($_REQUEST["status"] == 1) {
						$recstatus = "Ignor";
					}

					db();
					
					$qry = "UPDATE " . $tablename;
					$qry .= " SET `ignore` = " . $_REQUEST["status"] . " WHERE id = " . $_REQUEST["trans_rec_id"];

					//echo $qry . "<br>";
					
					db_query($qry);
					db_query("INSERT INTO `loop_transaction_deleted`(`trans_rec_id`, `trans_table`, `trans_removed_by`, `trans_status`, `trans_reason`) VALUES (" . $_REQUEST["trans_rec_id"] . ",'" . $tablename . "','" . $_COOKIE['userinitials'] . "','" . $recstatus . "','Record Status Changed from report_ignore.php.')");
				}
			}
		?>
	</body>
</html>