<?php
	require("inc/header_session.php");
	require("mainfunctions/database.php");
	require("mainfunctions/general-functions.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Customer Orders That Need Planned Delivery Date Confirmed by Customer</title>
		<link rel='stylesheet' type='text/css' href='one_style.css'>
		<link rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>
		<link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
	</head>
	<body>
		<?php include("inc/header.php"); ?>
		<div class="main_data_css">
			<div class="dashboard_heading" style="float: left;">
				<div style="float: left;">
					Customer Orders That Need Planned Delivery Date Confirmed by Customer
					<div class="tooltip">
						<i class="fa fa-info-circle" aria-hidden="true"></i>
						<span class="tooltiptext">This report shows the user all of the active sales transactions where the planned delivery date is not confirmed with the customer. The user is to contact the customer (preferrably by phone) and confirm the planned delivery date, then update the system that they are aware and good with the planned delivery date.</span>
					</div>
					<div style="height: 13px;">&nbsp;</div>
				</div>
			</div>
			<table width="1024px">
				<tr class="text_align_center">
					<td class="style12_new bg_color_ABC5DF" style="width:70px;">Sr. No.</td>
					<td class="style12_new bg_color_ABC5DF" style="width:70px;">Trans ID</td>
					<td class="style12_new bg_color_ABC5DF" style="width:200px;">Company</td>
					<td class="style12_new bg_color_ABC5DF" style="width:80px;">PO Upload Date</td>
					<td class="style12_new bg_color_ABC5DF" style="width:80px;">Planned Delivery Date</td>
				</tr>
				<?php
					$dt_view_qry = "SELECT po_employee, ops_delivery_date, booked_delivery_cost, freight_booked_delivery_date, loop_transaction_buyer.po_poorderamount, loop_transaction_buyer.po_freight, loop_transaction_buyer.virtual_inventory_company_id, loop_transaction_buyer.good_to_ship_action_dt, loop_transaction_buyer.no_invoice, loop_transaction_buyer.po_delivery, planned_delivery_dt_customer_confirmed, ";
					$dt_view_qry .= "loop_transaction_buyer.po_delivery_dt, loop_warehouse.b2bid, loop_warehouse.Active, loop_warehouse.company_name AS B, loop_transaction_buyer.warehouse_id AS D, loop_transaction_buyer.inv_amount AS F, loop_transaction_buyer.so_entered , ";
					$dt_view_qry .= "loop_transaction_buyer.good_to_ship AS G, loop_transaction_buyer.po_date AS H , loop_transaction_buyer.id AS I, loop_transaction_buyer.inv_date_of AS J FROM loop_transaction_buyer INNER JOIN loop_warehouse ON loop_transaction_buyer.warehouse_id = loop_warehouse.id ";
					$dt_view_qry .= "WHERE loop_transaction_buyer.po_date <> '' and loop_transaction_buyer.ignore = 0 and good_to_ship = 0 and po_delivery_dt<>'' and ready_to_hand_off_ignore = 0 and loop_transaction_buyer.planned_delivery_dt_customer_confirmed=0 ORDER BY loop_transaction_buyer.id, loop_transaction_buyer.warehouse_id";
					
					$dt_view_res = db_query($dt_view_qry, db());
					$srno = 0;

					while ($dt_view_row = array_shift($dt_view_res)) {

						$trans_id = $dt_view_row["I"];
						$warehouse_id = $dt_view_row["D"];
						$sort_id = $dt_view_row["I"];
				
						$company_name = getnickname($dt_view_row["B"], $dt_view_row["b2bid"]);

						$Planned_delivery_date = date("m/d/Y", strtotime($dt_view_row["po_delivery_dt"]));

						$sort_warehouse_id = $dt_view_row["D"];

						if ($dt_view_row["H"] == "") {
							$po_dt = "";
						} else {
							$po_dt = date("m/d/Y", strtotime($dt_view_row["H"]));
						}
						$srno = $srno + 1;
				?>
				<tr>
					<td class="bg_color_EBEBEB text_align_center">
						<?php echo $srno; ?></td>
					<td  class="bg_color_EBEBEB">
						<a target="_blank" href="viewCompany.php?ID=<?php echo $dt_view_row["b2bid"]; ?>&show=transactions&warehouse_id=<?php echo $warehouse_id; ?>&proc=View&searchcrit=&rec_type=Supplier&id=<?php echo $warehouse_id; ?>&rec_id=<?php echo $trans_id; ?>&display=<?php echo "buyer_view"; ?>">
							<?php echo $trans_id; ?>
						</a>
					</td>
					<td class="bg_color_EBEBEB">
						<a target="_blank" href="viewCompany.php?ID=<?php echo $dt_view_row["b2bid"]; ?>&show=transactions&warehouse_id=<?php echo $warehouse_id; ?>&proc=View&searchcrit=&rec_type=Supplier&id=<?php echo $warehouse_id; ?>&rec_id=<?php echo $trans_id; ?>&display=<?php echo "buyer_view"; ?>">
							<?php echo $company_name; ?>
						</a>
					</td>
					<td class="bg_color_EBEBEB">
						<?php echo $po_dt; ?>
					</td>
					<td class="bg_color_EBEBEB">
						<?php echo $Planned_delivery_date; ?>
					</td>
				</tr>
				<?php
					}
				?>
			</table>
		</div>
	</body>
</html>
