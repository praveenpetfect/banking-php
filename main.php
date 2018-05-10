<h3>Welcome back User Name:</h3>
	  <p>You have logged in from IP: <?php echo $_SERVER['REMOTE_ADDR']; ?><br />You log in at: <?php echo date("h:i A d M Y"); ?></p>
	  
	  <div class="TabbedPanels" id="AccountSummaryPanel">
		<ul class="TabbedPanelsTabGroup">
			<li class="TabbedPanelsTab" tabindex="0">Account Summary</li>
			<li class="TabbedPanelsTab" tabindex="0">Fund Transfer</li>
			<li class="TabbedPanelsTab" tabindex="0">Statements</li>
		</ul>
		<div class="TabbedPanelsContentGroup">
			<div class="TabbedPanelsContent">
		<h2>User Account Details..</h2>	
		<table width="300" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
		<tr>
		  <th scope="col">Account Updates</th>
		  <th width="100" scope="col">&nbsp;</th>
		</tr>
		<tr>
		  <td>Total Transactions</td>
		  <td width="100">
		  hello
		  </td>
		</tr>
		<tr>
		  <td>Cheques</td>
		  <td width="100">0.00</td>
		</tr>
		<tr>
		  <td>Cleared</td>
		  <td width="100">0.00</td>
		</tr>
		<tr>
		  <td>Uncleared</td>
		  <td width="100">0.00</td>
		</tr>
		<tr>
		  <td>Booked Balance</td>
		  <td>0.00</td>
		</tr>
		<tr>
		  <td>Available Balance</td>
		  <td>0.00</td>
		</tr>
	  </table>
			</div>
			<div class="TabbedPanelsContent">Tab 3 Content</div>
			<div class="TabbedPanelsContent">Tab 4 Content</div>
		</div>
	</div>
	
	  
	  <h3>Account Balance:</h3>
    </div>
	
<script language="JavaScript" type="text/javascript">
	var tp1 = new Spry.Widget.TabbedPanels("AccountSummaryPanel", { defaultTab: 0});
</script>	