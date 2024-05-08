<?php
  require("inc/header_session.php");
  require("../mainfunctions/database.php");
  require("../mainfunctions/general-functions.php");
  ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Name Dropping Report</title>
    <lin rel='stylesheet' type='text/css' href='one_style.css'>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
    <link rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>
  </head>
  <?php
    $sort_order_pre = "ASC";
    
    if ($_GET['sort_order_pre'] == "ASC") {
    
    	$sort_order_pre = "DESC";
    } else {
    
    	$sort_order_pre = "ASC";
    }
    
    $sorturl = "name_dropping_report.php";
    ?>
  <body>
    <?php include("inc/header.php"); ?>
    <div class="main_data_css">
      <div class="dashboard_heading" style="float: left;">
        <div style="float: left;">
          Name Dropping Report
          <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
            <span class="tooltiptext">
            This report shows the user all of the biggest companies in each industry that we sell to, so that when we go to sell to other companies in that industry, we can drop the names of the big ones.
            </span>
          </div>
          <div style="height: 13px;">&nbsp;</div>
        </div>
      </div>
      <table cellpadding="3" cellspacing="1">
        <tr>
          <th bgcolor="#D9F2FF">
            Contact
            <a href="<?php echo $sorturl; ?>?contact=asc&sort=y"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;
            <a href="<?php echo $sorturl; ?>?contact=desc&sort=y"><img src="images/sort_desc.png" width="6px;" height="12px;"></a>
          </th>
          <th bgcolor="#D9F2FF">
            Company Name
            <a href="<?php echo $sorturl; ?>?CompanyName=asc&sort=y"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;
            <a href="<?php echo $sorturl; ?>?CompanyName=desc&sort=y"><img src="images/sort_desc.png" width="6px;" height="12px;"></a>
          </th>
          <th bgcolor="#D9F2FF">
            Industry
            <a href="<?php echo $sorturl; ?>?Industry=asc&sort=y"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;
            <a href="<?php echo $sorturl; ?>?Industry=desc&sort=y"><img src="images/sort_desc.png" width="6px;" height="12px;"></a>
          </th>
          <th bgcolor="#D9F2FF">
            Phone
            <a href="<?php echo $sorturl; ?>?Phone=asc&sort=y"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;
            <a href="<?php echo $sorturl; ?>?Phone=desc&sort=y"><img src="images/sort_desc.png" width="6px;" height="12px;"></a>
          </th>
          <th bgcolor="#D9F2FF">
            City
            <a href="<?php echo $sorturl; ?>?City=asc&sort=y"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;
            <a href="<?php echo $sorturl; ?>?City=desc&sort=y"><img src="images/sort_desc.png" width="6px;" height="12px;"></a>
          </th>
          <th bgcolor="#D9F2FF">
            Zip
            <a href="<?php echo $sorturl; ?>?Zip=asc&sort=y"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;
            <a href="<?php echo $sorturl; ?>?Zip=desc&sort=y"><img src="images/sort_desc.png" width="6px;" height="12px;"></a>
          </th>
          <th bgcolor="#D9F2FF">
            Email
            <a href="<?php echo $sorturl; ?>?Email=asc&sort=y"><img src="images/sort_asc.png" width="6px;" height="12px;"></a>&nbsp;
            <a href="<?php echo $sorturl; ?>?Email=desc&sort=y"><img src="images/sort_desc.png" width="6px;" height="12px;"></a>
          </th>
        </tr>
        <?php
          if (!isset($_REQUEST["sort"])) {
          
          	db_b2b();
          
          	$qry = "Select industry_id, industry_other, company, ID,contact, contact, phone, city, zip, email from companyInfo where publicity='Yes' and active = 1";
          
          	$result = db_query($qry);
          
          	while ($row = array_shift($result)) {
          
          
          
          		if ($row["industry_id"] != "") {
          
          			$industry = "";
          
          			$indus_qry = "Select industry from industry_master where active_flg = 1 and industry_id = '" . $row["industry_id"] . "'";
          
					db_b2b();
          
          			$indus_res = db_query($indus_qry);
          
          			while ($indus_row = array_shift($indus_res)) {
          
          				$industry = $indus_row["industry"];
          			}
          
          			if ($row["industry_other"] != "") {
          
          				$industry = "Other: " . $row["industry_other"];
          			}
          		} else {
          
          			$industry = "<span style='color:#FF0000;'>No Industry Selected</span>";
          		}
          
          
          
          		$qry_indu = "select * from companyInfo where publicity='Yes'";
          
          		$result_indu = db_query($qry_indu);
          
          		while ($row_indu = array_shift($result_indu)) {
          		}
          
          
          
          		$nickname = get_nickname_val($row["company"], $row["ID"]);
          
          		$id = $row["ID"];
          
          ?>
        <tr>
          <td bgcolor="#E4E4E4">
            <?php echo $row["contact"]; ?>
          </td>
          <td bgcolor="#E4E4E4">
            <a href="http://loops.usedcardboardboxes.com/viewCompany.php?ID=<?php echo $id ?>" target="_blank"><?php echo $nickname; ?></a>
          </td>
          <td bgcolor="#E4E4E4">
            <?php echo $industry; ?>
          </td>
          <td bgcolor="#E4E4E4">
            <?php echo $row["phone"]; ?>
          </td>
          <td bgcolor="#E4E4E4">
            <?php echo $row["city"]; ?>
          </td>
          <td bgcolor="#E4E4E4">
            <?php echo $row["zip"]; ?>
          </td>
          <td bgcolor="#E4E4E4">
            <?php echo $row["email"]; ?>
          </td>
        </tr>
        <?php
          $MGArray_data[] = array(
          	'id' => $row["ID"], 'contact' => $row["contact"], 'company' => $nickname, 'industry' => trim($industry),
          
          	'phone' => $row["phone"], 'city' => $row["city"], 'zip' => $row["zip"], 'email' => $row["email"]
          );
          }
          
          
          
          $_SESSION['sortarrayn'] = $MGArray_data;
          } else {
          
          $MGArray_data = $_SESSION['sortarrayn'];
          
          
          
          foreach ($MGArray_data as $key => $row) {
          
          $vc_array_contact[$key] = $row['contact'];
          
          $vc_array_company[$key] = $row['company'];
          
          $vc_array_industry[$key] = $row['industry'];
          
          $vc_array_phone[$key] = $row['phone'];
          
          $vc_array_city[$key] = $row['city'];
          
          $vc_array_zip[$key] = $row['zip'];
          
          $vc_array_email[$key] = $row['email'];
          }
          
          
          
          if ($_REQUEST["contact"] == "asc") {
          
          array_multisort($vc_array_contact, SORT_ASC, $MGArray_data);
          } elseif ($_REQUEST["contact"] == "desc") {
          
          array_multisort($vc_array_contact, SORT_DESC, $MGArray_data);
          }
          
          if ($_REQUEST["CompanyName"] == "asc") {
          
          array_multisort($vc_array_company, SORT_ASC, $MGArray_data);
          } elseif ($_REQUEST["CompanyName"] == "desc") {
          
          array_multisort($vc_array_company, SORT_DESC, $MGArray_data);
          }
          
          if ($_REQUEST["Industry"] == "asc") {
          
          array_multisort($vc_array_industry, SORT_ASC, $MGArray_data);
          } elseif ($_REQUEST["Industry"] == "desc") {
          
          array_multisort($vc_array_industry, SORT_DESC, $MGArray_data);
          }
          
          if ($_REQUEST["Phone"] == "asc") {
          
          array_multisort($vc_array_phone, SORT_ASC, $MGArray_data);
          } elseif ($_REQUEST["Phone"] == "desc") {
          
          array_multisort($vc_array_phone, SORT_DESC, $MGArray_data);
          }
          
          if ($_REQUEST["City"] == "asc") {
          
          array_multisort($vc_array_city, SORT_ASC, $MGArray_data);
          } elseif ($_REQUEST["City"] == "desc") {
          
          array_multisort($vc_array_city, SORT_DESC, $MGArray_data);
          }
          
          if ($_REQUEST["Zip"] == "asc") {
          
          array_multisort($vc_array_zip, SORT_ASC, $MGArray_data);
          } elseif ($_REQUEST["Zip"] == "desc") {
          
          array_multisort($vc_array_zip, SORT_DESC, $MGArray_data);
          }
          
          if ($_REQUEST["Email"] == "asc") {
          
          array_multisort($vc_array_email, SORT_ASC, $MGArray_data);
          } elseif ($_REQUEST["Email"] == "desc") {
          
          array_multisort($vc_array_email, SORT_DESC, $MGArray_data);
          }
          
          
          
          foreach ($MGArray_data as $MGArraytmp2) {
          
          ?>
        <tr>
          <td bgcolor="#E4E4E4">
            <?php echo $MGArraytmp2["contact"]; ?>
          </td>
          <td bgcolor="#E4E4E4">
            <a href="http://loops.usedcardboardboxes.com/viewCompany.php?ID=<?php echo $MGArraytmp2["id"] ?>" target="_blank"><?php echo $MGArraytmp2["company"]; ?></a>
          </td>
          <td bgcolor="#E4E4E4">
            <?php echo $MGArraytmp2["industry"]; ?>
          </td>
          <td bgcolor="#E4E4E4">
            <?php echo $MGArraytmp2["phone"]; ?>
          </td>
          <td bgcolor="#E4E4E4">
            <?php echo $MGArraytmp2["city"]; ?>
          </td>
          <td bgcolor="#E4E4E4">
            <?php echo $MGArraytmp2["zip"]; ?>
          </td>
          <td bgcolor="#E4E4E4">
            <?php echo $MGArraytmp2["email"]; ?>
          </td>
        </tr>
        <?php
          }
          }
          
          ?>
      </table>
    </div>
  </body>
</html>