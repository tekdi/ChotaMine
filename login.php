<?php
require_once 'functions.php';
require 'head.html.php'; 
?>

<form method="post" action="<?php echo Utils::getProcessLink(__FILE__); ?>" class="niceform">


<table id="user" width="500" align="center">
	<tr>
		<td align="right"><label for="username">Username</label></td>
		<td align="right"><input name="username" value="" type="input" id="username" /></td>
	</tr>

	<tr>
		<td align="right"><label for="password">Password</label></td>
		<td align="right"><input name="pass" value="" type="input" id="password" /></td>
	</tr>

	<tr>
		<td align="left" colspan="2"></td>
	</tr>
	
	<tr>
		<td align="left"><a href="#" onclick="$('#user').hide(); $('#key').show(); return false;">Provide API Key</a></td>
		<td align="right"><input type="submit" name="submit" value="Login" /></td>
	</tr>

</table>
<p> </p>
<table id="key" width="500" style="display:none" align="center">
	<tr>
		<td align="right"><label for="key">API Key</label></td>
		<td align="right">
			<input name="username" value="" type="input" id="key" />
			<input name="password" value="X" type="hidden" id="key" />
		</td>
	</tr>

	<tr>
		<td align="left" colspan="2"></td>
	</tr>
	
	<tr>
		<td align="left"><a href="#" onclick="$('#user').show(); $('#key').hide(); return false;">Provide Username/Pass</a></td>
		<td align="right"><input type="submit" name="submit" value="Login" /></td>
	</tr>
</table>
</form>

<?php require 'footer.html.php'; ?>
