<?php
if (!defined('WEB_ROOT')) {
	exit;
}

if (isset($_GET['userId']) && (int)$_GET['userId'] > 0) {
	$userId = (int)$_GET['userId'];
} else {
	header('Location: index.php');
}

$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

$sql = "SELECT id, fname, lname, email FROM tbl_users
        WHERE id = $userId";
$result = dbQuery($sql);		
extract(dbFetchAssoc($result));


?> 
<p class="errorMessage"><?php echo $errorMessage; ?></p>
<form action="processUser.php?action=email" method="post" >
 <table width="500px" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr>
    <td colspan="2" class="label">Change Email Address </td>
    </tr>
  <tr> 
   <td width="150" class="label">User Name</td>
   <td class="content">
   	<input name="txtUserName" type="text" class="box" id="txtUserName" value="<?php echo $fname. ' '.$lname; ?>" size="30"  readonly="readonly">
    <input name="hidUserId" type="hidden" id="hidUserId" value="<?php echo $id; ?>"> </td>
  </tr>
  <tr> 
   <td width="150" class="label">Old Email ID</td>
   <td class="content">
   	<input name="old_email" type="text" class="box" value="<?php echo $email; ?>" id="old_email" size="30" readonly="readonly">
   </td>
  </tr>
  
   <tr> 
   <td width="150" class="label">New Email ID</td>
   <td class="content">
   	<input name="new_email" type="text" class="box"  id="new_email" size="30">
   </td>
  </tr>
 </table>
 <p align="center"> 
  <input name="btnModifyUser" type="submit" id="btnModifyUser" value="Modify Email ID" >
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Cancel" onClick="window.location.href='index.php';" >  
 </p>
</form>