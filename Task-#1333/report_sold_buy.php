<?php
  require("inc/header_session.php");
  require("../mainfunctions/database.php");
  require("../mainfunctions/general-functions.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>Customer Report (>90 days <180 days)</title>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
    <LINK rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>
    <style type="text/css">
      .style7 {
      font-size: 10pt;
      font-family: Arial, Helvetica, sans-serif;
      color: #333333;
      background-color: #FFCC66;
      }
    </style>
  </head>
  <body>
    <?php include("inc/header.php"); ?>
    <div class="main_data_css">
      <div class="dashboard_heading" style="float: left;">
        <div style="float: left;">
          Customer Report (>90 days <180 days) 
          <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
            <span class="tooltiptext">
            This report shows all B2B customers who have last purchased from UCB with 90 and 180 days ago.
            </span>
          </div>
          <div style="height: 13px;">&nbsp;</div>
        </div>
      </div>
      <table cellSpacing="1" cellPadding="1" width="800" border="0">
        <tr align="middle">
          <td colSpan="4" class="style7"> <b>List of Clients who buy from UCB (Order is older than 90 days and less than 180 days) </b> </td>
        </tr>
        <tr>
          <td class="style7"> <b>Sr.No.</b> </td>
          <td class="style7"> <b>Company</b> </td>
          <td class="style7"> <b>Order Date</b> </td>
          <td class="style7"> <b>No of Days</b> </td>
        </tr>
        <?php
          $query = "SELECT loop_warehouse.id, loop_warehouse.b2bid, loop_warehouse.company_name, loop_warehouse.Active, loop_warehouse.bs_status, max(transaction_date) as transdt, DATEDIFF(sysdate(), max(transaction_date)) as nodays";
          
          $query .= " FROM loop_transaction_buyer inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id ";
          
          $query .= " group by warehouse_id having  ";
          
          $query .= " (DATEDIFF(sysdate(), max(transaction_date)) > 90 and DATEDIFF(sysdate(), max(transaction_date)) < 180) order by loop_warehouse.company_name ";
          
          $rec_cnt = 1;
          db();
          $res = db_query($query);
          
          
          
          while ($row = array_shift($res)) {
          
          	if ($row["bs_status"] == "Buyer") {
          
          ?> 
        <tr vAlign="center">
          <td bgColor="#e4e4e4" class="style3" style="height: 22px;"> <?php echo $rec_cnt; ?> </td>
          <td bgColor="#e4e4e4" class="style3" style="height: 22px;">
            <a target="_blank" href="viewCompany.php?ID=<?php echo $row["b2bid"]; ?>"><?php echo get_nickname_val($row["company_name"], $row["b2bid"]); ?></a>
          </td>
          <td bgColor="#e4e4e4" class="style3" style="height: 22px;"> <?php echo $row["transdt"]; ?> </td>
          <td bgColor="#e4e4e4" class="style3" style="height: 22px;"> <?php echo $row["nodays"]; ?> </td>
        </tr>
        <?php
          $rec_cnt = $rec_cnt + 1;
          }
          } ?>
      </table>
      <br />
      <table cellSpacing="1" cellPadding="1" width="800" border="0">
        <tr align="middle">
          <td colSpan="4" class="style7"> <b>List of Clients who buy from UCB (Order is older than 180 days) </b> </td>
        </tr>
        <tr>
          <td class="style17"> <b>Sr.No.</b> </td>
          <td class="style17"> <b>Company</b> </td>
          <td class="style17"> <b>Order Date</b> </td>
          <td class="style5"> <b>No of Days</b> </td>
        </tr>
        <?php $query = "SELECT loop_warehouse.id, loop_warehouse.b2bid, loop_warehouse.company_name, loop_warehouse.Active,loop_warehouse.bs_status, max(transaction_date) as transdt, DATEDIFF(sysdate(), max(transaction_date)) as nodays";
          $query .= " FROM loop_transaction_buyer inner join loop_warehouse on loop_warehouse.id = loop_transaction_buyer.warehouse_id ";
          $query .= " group by warehouse_id having  ";
          $query .= " (DATEDIFF(sysdate(), max(transaction_date)) > 180) order by loop_warehouse.company_name ";
          $rec_cnt = 1;
		  db();
          $res = db_query($query);
          while ($row = array_shift($res)) {
          	if ($row["bs_status"] == "Buyer" && $row["Active"] == 1) {		?> 
        <tr vAlign="center">
          <td bgColor="#e4e4e4" class="style3" style="height: 22px;"> <?php echo $rec_cnt; ?> </td>
          <td bgColor="#e4e4e4" class="style3" style="height: 22px;">
            <a target="_blank" href="viewCompany.php?ID=<?php echo $row["b2bid"]; ?>"><?php echo get_nickname_val($row["company_name"], $row["b2bid"]); ?></a>
          </td>
          <td bgColor="#e4e4e4" class="style3" style="height: 22px;"> <?php echo $row["transdt"]; ?> </td>
          <td bgColor="#e4e4e4" class="style3" style="height: 22px;"> <?php echo $row["nodays"]; ?> </td>
        </tr>
        <?php $rec_cnt = $rec_cnt + 1;
          }
          } ?>
      </table>
      <br />
      <table cellSpacing="1" cellPadding="1" width="800" border="0">
        <tr align="middle">
          <td colSpan="4" class="style7"> <b>List of Clients who sell to UCB (Order is older than 90 days and less than 180 days) </b> </td>
        </tr>
        <tr>
          <td class="style17"> <b>Sr.No.</b> </td>
          <td class="style17"> <b>Company</b> </td>
          <td class="style17"> <b>Order Date</b> </td>
          <td class="style5"> <b>No of Days</b> </td>
        </tr>
        <?php $query = "SELECT loop_warehouse.id, loop_warehouse.b2bid, loop_warehouse.company_name, loop_warehouse.Active, loop_warehouse.bs_status, max(transaction_date) as transdt, DATEDIFF(sysdate(), max(transaction_date)) as nodays";
          $query .= " FROM loop_transaction inner join loop_warehouse on loop_warehouse.id = loop_transaction.warehouse_id ";
          $query .= " group by warehouse_id having  ";
          $query .= " (DATEDIFF(sysdate(), max(transaction_date)) > 90 and DATEDIFF(sysdate(), max(transaction_date)) < 180) order by loop_warehouse.company_name ";
          $rec_cnt = 1;
		  db();
          $res = db_query($query);
          while ($row = array_shift($res)) {
          	if ($row["bs_status"] == "Seller" && $row["Active"] == 1) {		?> 
        <tr vAlign="center">
          <td bgColor="#e4e4e4" class="style3" style="height: 22px;"> <?php echo $rec_cnt; ?> </td>
          <td bgColor="#e4e4e4" class="style3" style="height: 22px;">
            <a target="_blank" href="viewCompany.php?ID=<?php echo $row["b2bid"]; ?>"><?php echo get_nickname_val($row["company_name"], $row["b2bid"]); ?></a>
          </td>
          <td bgColor="#e4e4e4" class="style3" style="height: 22px;"> <?php echo $row["transdt"]; ?> </td>
          <td bgColor="#e4e4e4" class="style3" style="height: 22px;"> <?php echo $row["nodays"]; ?> </td>
        </tr>
        <?php $rec_cnt = $rec_cnt + 1;
          }
          } ?>
      </table>
      <br />
      <table cellSpacing="1" cellPadding="1" width="800" border="0">
        <tr align="middle">
          <td colSpan="4" class="style7"> <b>List of Clients who sell to UCB (Order is older than 180 days) </b> </td>
        </tr>
        <tr>
          <td class="style17"> <b>Sr.No.</b> </td>
          <td class="style17"> <b>Company</b> </td>
          <td class="style17"> <b>Order Date</b> </td>
          <td class="style5"> <b>No of Days</b> </td>
        </tr>
        <?php $query = "SELECT loop_warehouse.id, loop_warehouse.b2bid, loop_warehouse.company_name, loop_warehouse.Active, loop_warehouse.bs_status, max(transaction_date) as transdt, DATEDIFF(sysdate(), max(transaction_date)) as nodays";
          $query .= " FROM loop_transaction inner join loop_warehouse on loop_warehouse.id = loop_transaction.warehouse_id ";
          $query .= " group by warehouse_id having  ";
          $query .= " (DATEDIFF(sysdate(), max(transaction_date)) > 180) order by loop_warehouse.company_name ";
          echo "";
          $rec_cnt = 1;
		  db();
          $res = db_query($query);
          while ($row = array_shift($res)) {
          	if ($row["bs_status"] == "Seller" && $row["Active"] == 1) {		?> 
        <tr vAlign="center">
          <td bgColor="#e4e4e4" class="style3" style="height: 22px;"> <?php echo $rec_cnt; ?> </td>
          <td bgColor="#e4e4e4" class="style3" style="height: 22px;">
            <a target="_blank" href="viewCompany.php?ID=<?php echo $row["b2bid"]; ?>"><?php echo get_nickname_val($row["company_name"], $row["b2bid"]); ?></a>
          </td>
          <td bgColor="#e4e4e4" class="style3" style="height: 22px;"> <?php echo $row["transdt"]; ?> </td>
          <td bgColor="#e4e4e4" class="style3" style="height: 22px;"> <?php echo $row["nodays"]; ?> </td>
        </tr>
        <?php $rec_cnt = $rec_cnt + 1;
          }
          } ?>
      </table>
    </div>
  </body>
</html>
