<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$self = WEB_ROOT . 'admin/index.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $pageTitle; ?></title>

<link href="<?php echo WEB_ROOT;?>css/admin.css" rel="stylesheet" type="text/css">
<link href="<?php echo WEB_ROOT;?>css/menu.css" rel="stylesheet" type="text/css">

<link href="<?php echo WEB_ROOT; ?>library/spry/tabbedpanels/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/tabbedpanels/SpryTabbedPanels.js" type="text/javascript"></script>
<style>
body {background-color:#F8F8F8 !important;}
</style>
</head>
<body>

<table width="900" border="0" align="center" cellpadding="0" cellspacing="1" class="graybox">
  <tr style="background-color:#FFFFFF">
    <td colspan="2"><img src="<?php echo WEB_ROOT; ?>images/OnlineBanking-logo.png"></td>
  </tr>
  <tr style="background-color:#7f92a4;height:10px;">
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr style="border-bottom:0px;">
    <td width="150" valign="top" class="navArea">
	<?php include('menu.php'); ?>
    </td>
    <td width="750" valign="top" class="contentArea">
		<table width="100%" border="0" cellspacing="0" cellpadding="20">
        <tr>
          <td>
			<?php
			require_once $content;	 
			?>
          </td>
        </tr>
      	</table>
	</td>
  </tr>
  
</table>
</body>
</html>