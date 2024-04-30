<?php
	require("inc/header_session.php");
	require("../mainfunctions/database.php");
	require("../mainfunctions/general-functions.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Delete Transaction Tool</title>
		<link rel='stylesheet' type='text/css' href='one_style.css'>
		<link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
		<link rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>

		<script language="JavaScript">
			function getValidation() {
				var from = document.getElementById('from');
				var id = document.getElementById('id');
				var pw = document.getElementById('pw');
				if (from.value == '') {
					alert('Please select transaction.');
					from.focus();
					return false;
				}
				if (id.value == '') {
					alert('Please enter ID.');
					id.focus();
					return false;
				}
				if (pw.value == '') {
					alert('Please enter password.');
					pw.focus();
					return false;
				}

				var option = confirm("Are you sure, you want to delete the transaction #" + id.value + "?");
				if (option == true) {
					document.frmDavidDel.submit();
				}
			}
		</script>
	</head>
	<body>
		<?php include("inc/header.php"); ?>
		<div class="main_data_css">
			<div class="dashboard_heading" style="float: left;">
				<div style="float: left;">Delete Transaction Tool</div>
				&nbsp;<div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
					<span class="tooltiptext">This tool allows the user to delete a transaction within a purchasing or sales record. This is generally only done if creating the transaction was a mistake. Cancelled transactions should use the Cancel Transaction Tool.</span>
				</div>
				<div style="height: 13px;">&nbsp;</div>
			</div>
			
			<?php if($_REQUEST["pwdnotmatcch"] == "y"){ ?>
				<font color=red>Password didn't match.</font>
			<?php }	?>

			<?php if($_REQUEST["recdel"] == "y"){ ?>
				<font color="green">Transaction #<? echo $_REQUEST["tran_del"]; ?> has been deleted</font>;
			<?php } ?>

			<form method="post" action="daviddeletesubmit.php" name="frmDavidDel" id="frmDavidDel">
				<table>
					<tr>
						<td>FROM:</td>
						<td>
							<select name="from" id="from">
								<option value="loop_transaction">Loop Sorting Transaction</option>
								<option value="loop_transaction_buyer">Loop Sales Transaction</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>ID: </td>
						<td>
							<input name="id" id="id" type="text" size=5>
						</td>
					</tr>
					<tr>
						<td>Password :</td>
						<td>
							<input name="pw" id="pw" type="password" size=5>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>
							<input type="button" name="btnSubmitDel" id="btnSubmitDel" value="DELETE" onclick="getValidation()">
						</td>
					</tr>
				</table>
			</form>
		</div>
	</body>
</html>