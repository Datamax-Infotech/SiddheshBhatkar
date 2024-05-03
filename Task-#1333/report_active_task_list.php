<?php
  require_once("inc/header_session.php");
  require_once("mainfunctions/database.php");
  require_once("mainfunctions/general-functions.php");
  ?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Active Task Report</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
    <LINK rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>
  </head>
  <script type="text/javascript">
    function todoitem_markcomp_dash(unqid, empid)
    
    {
    
    	window.location.href = "todolist_update.php?fromactivetaskrep=y&unqid=" + unqid + "&empid=" + empid + "&markcomp=1";
    
    }
  </script>
  <body>
    <?php include("inc/header.php"); ?>
    <div class="main_data_css">
      <div class="dashboard_heading" style="float: left;">
        <div style="float: left;">
          Active Tasks Report
          <div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>
            <span class="tooltiptext">This report shows all currently active tasks per employee.</span>
          </div>
          <div style="height: 13px;">&nbsp;</div>
        </div>
      </div>
      <form name="" action="" method="get">
        <table width="300" border="0" cellspacing="0" cellpadding="0">
          <tr align="center">
            <td>
              Select User
            </td>
            <td align="left">
              <select name="eid">
                <option value="all" <?php echo (($_REQUEST["eid"] == "all") ? "selected" : "") ?>> All </option>
                <?php
				  db();

                  $sql = "SELECT * FROM loop_employees WHERE `status` = 'Active' ORDER BY `name`";
                  
                  $result = db_query($sql);
                  
                  while ($rowemp = array_shift($result)) {
                  
                  	echo '<option  value="' . $rowemp['id'] . '" ' . (($_REQUEST["eid"] == $rowemp['id']) ? "selected" : "") . '>' . $rowemp['name'] . '</option>';
                  }
                  
                  ?>
              </select>
            </td>
            <td>
              <input type="submit" id="submit" value="Submit" />
            </td>
          </tr>
        </table>
      </form>
      <br><br>
      <?php
        if (isset($_REQUEST['eid'])) {
			db();
        	if ($_REQUEST['eid'] == "all") {
        
        		$sql = "SELECT * FROM loop_employees WHERE `status` = 'Active' ORDER BY `name`";
        	} else {
        
        		$sql = "SELECT * FROM loop_employees WHERE `id` = " . $_REQUEST['eid'];
        	}
        
        	$trbackcolor = 0;
        
        	$result = db_query($sql);
        
        	while ($rowemp = array_shift($result)) {
        
        		//echo $rowemp['initials']." == ". $rowemp['name'] ;
        
        		if ($trbackcolor == 0) {
        
        			//even
        
        			$trclass = "#AAA";
        
        			$trheading = "#AAA";
        
        			$trbackcolor = 1;
        		} else {
        
        			$trclass = "#CCC";
        
        			$trheading = "#CCC";
        
        			$trbackcolor = 0;
        		}
        
        
        
        
        
        		$display_flg = "no";
        
				db();
        
        		$sql = "SELECT * FROM todolist where assign_to = '" . $rowemp['initials'] . "' and status = 1 order by due_date";
        
        		$result2 = db_query($sql);
        
        		while ($myrowsel = array_shift($result2)) {
        
        			$date1 = new DateTime($myrowsel["due_date"]);
        
        			$date2 = new DateTime();
        
        			$days = (strtotime($myrowsel["due_date"]) - strtotime(date("Y-m-d"))) / (60 * 60 * 24);
        
        
        
        			if ($display_flg == "no") {
        
        				$display_flg = "yes";
        
        
        
        ?>
      <table width="700" border="0" cellspacing="1" cellpadding="1">
        <tr align="center" bgcolor="<?php echo $trclass; ?>">
          <td colspan="8">
            <font face="Arial, Helvetica, sans-serif" size="1">Active Tasks of <b><?php echo $rowemp['name']; ?></b></font>
          </td>
        </tr>
        <tr align="center" bgcolor="<?php echo $trheading; ?>">
          <td>
            <font size="1">Company</font>
          </td>
          <td>
            <font size="1">Task Name</font>
          </td>
          <td>
            <font size="1">Created By</font>
          </td>
          <td>
            <font size="1">Assigned To</font>
          </td>
          <td>
            <font size="1">Created On</font>
          </td>
          <td>
            <font size="1">Due Date</font>
          </td>
          <td>
            <font size="1">Priority</font>
          </td>
          <td>&nbsp;
          </td>
        </tr>
        <?php } ?>
        <tr align="center">
          <td bgcolor="#E4E4E4" align="left">
            <font size="1"><a target="_blank" href='https://loops.usedcardboardboxes.com/viewCompany.php?ID=<?php echo $myrowsel["companyid"]; ?>'><?php echo getnickname('', $myrowsel["companyid"]); ?></a></font>
          </td>
          <td bgcolor="#E4E4E4" align="left">
            <font size="1"><?php echo $myrowsel["task_name"] ?></font>
          </td>
          <td bgcolor="#E4E4E4">
            <font size="1"><?php echo $myrowsel["task_created_by"] ?></font>
          </td>
          <td bgcolor="#E4E4E4">
            <font size="1"><?php echo $myrowsel["assign_to"] ?></font>
          </td>
          <td bgcolor="#E4E4E4">
            <font size="1"><?php echo date("m/d/Y H:i:s", strtotime($myrowsel["task_added_on"]))  . " CT"; ?></font>
          </td>
          <? if ($days == 0) { ?>
          <td bgcolor="green">
            <font size="1"><?php echo date("m/d/Y", strtotime($myrowsel["due_date"])) . " CT"; ?></font>
          </td>
          <? }
            if ($days > 0) { ?>
          <td bgcolor="#E4E4E4">
            <font size="1"><?php echo date("m/d/Y", strtotime($myrowsel["due_date"])) . " CT"; ?></font>
          </td>
          <? }
            if ($days < 0) { ?>
          <td bgcolor="red">
            <font size="1"><?php echo date("m/d/Y", strtotime($myrowsel["due_date"])) . " CT"; ?></font>
          </td>
          <? } ?>
          <td bgcolor="#E4E4E4">
            <font size="1"><?php echo $myrowsel["task_priority"]; ?></font>
          </td>
          <td bgcolor="#E4E4E4" align="middle">
            <input type="button" value="Mark Complete" name="todo_markcompl" id="todo_markcompl" onclick="todoitem_markcomp_dash(<?php echo $myrowsel["unqid"] ?>, <?php echo $_REQUEST['eid']; ?>)">
          </td>
        </tr>
        <?php
          }
          
          if ($display_flg == "yes") {
          
          	?>
      </table>
      <br>
      <?php } ?>
      <?php
        $display_flg = "no";
        db();

        $sql = "SELECT * FROM todolist where assign_to = '" . $rowemp['initials'] . "' and status = 2 order by due_date desc limit 10";
        
        $result3 = db_query($sql);
        
        while ($myrowsel = array_shift($result3)) {
        
        
        
        	if ($display_flg == "no") {
        
        		$display_flg = "yes";
        
        ?>
      <table width="700" border="0" cellspacing="1" cellpadding="1">
        <tr align="center" bgcolor="<?php echo $trclass; ?>">
          <td colspan="7">
            <font face="Arial, Helvetica, sans-serif" size="1">Recently Completed Tasks <b><?php echo $rowemp['name']; ?></b></font>
          </td>
        </tr>
        <tr align="center" bgcolor="<?php echo $trheading; ?>">
          <td>
            <font size="1">Company</font>
          </td>
          <td>
            <font size="1">Task Name</font>
          </td>
          <td>
            <font size="1">Assigned To</font>
          </td>
          <td>
            <font size="1">Created On</font>
          </td>
          <td>
            <font size="1">Due Date</font>
          </td>
          <td>
            <font size="1">Priority</font>
          </td>
          <td>
            <font size="1">Completed by and On</font>
          </td>
        </tr>
        <?php } ?>
        <tr align="center">
          <td bgcolor="#E4E4E4" align="left">
            <font size="1"><a target="_blank" href='https://loops.usedcardboardboxes.com/viewCompany.php?ID=<?php echo $myrowsel["companyid"]; ?>'><?php echo getnickname('', $myrowsel["companyid"]); ?></a></font>
          </td>
          <td bgcolor="#E4E4E4" align="left">
            <font size="1"><?php echo $myrowsel["task_name"] ?></font>
          </td>
          <td bgcolor="#E4E4E4">
            <font size="1"><?php echo $myrowsel["assign_to"] ?></font>
          </td>
          <td bgcolor="#E4E4E4">
            <font size="1"><?php echo date("m/d/Y H:i:s", strtotime($myrowsel["task_added_on"]))  . " CT"; ?></font>
          </td>
          <td bgcolor="#E4E4E4">
            <font size="1"><?php echo date("m/d/Y", strtotime($myrowsel["due_date"])) . " CT"; ?></font>
          </td>
          <td bgcolor="#E4E4E4">
            <font size="1"><?php echo $myrowsel["task_priority"] ?></font>
          </td>
          <td bgcolor="#E4E4E4">
            <font size="1"><?php echo $myrowsel["mark_comp_by"] . " " . date("m/d/Y", strtotime($myrowsel["mark_comp_on"])) . " CT"; ?></font>
          </td>
        </tr>
        <?php
          }
          
          
          
          if ($display_flg == "yes") {
          
          	?>
      </table>
      <br>
      <table width="700" border="0" cellspacing="1" cellpadding="1">
        <tr>
          <td>
            <hr style="height:1px;border:none;color:#799899;background-color:#799899;" />
          </td>
        </tr>
      </table>
      <br>
      <?php }
        ?>
      <?php
        }
        }
        
        	?>
    </div>
  </body>
</html>
