<?php
require_once 'functions.php';
require 'head.html.php'; 
?>

<form method="post" action="<?php echo Utils::getProcessLink(__FILE__); ?>" class="niceform">
<h2>Chotamine</h2>
<p>A lightweight redmine wrapper. Use your redmine API key to add issues projects and more.</p>
<table id="user" width="600" align="center">
	<tr>
		<td align="right" width="200"><label for="username">Redmine URL</label></td>
		<td align="left">
			<input name="url" type="text" id="url" size="25" class="username" value="<?php echo Utils::getLastUrl(); ?>" />
			<?php echo Utils::select(Utils::getUrls(), '', 'id="urllist" onchange="loadUrl(this.value)"'); ?>
		</td>
	</tr>
	
	<tr>
		<td align="right"><label for="username">Username</label></td>
		<td align="left"><input name="username" type="text" id="username" size="25" class="username" /></td>
	</tr>

	<tr>
		<td align="right"><label for="password">Password</label></td>
		<td align="left"><input name="password" type="password" id="password" size="25" class="username" /></td>
	</tr>

	<tr>
		<td align="left" colspan="2"></td>
	</tr>
	
	<tr>
		<td align="left"><a href="#" onclick="loginToggle(); return false;">Provide API Key</a></td>
		<td align="right"><input type="submit" name="submit" value="Login" /></td>
	</tr>

</table>
<p> </p>
<table id="key" width="600" align="center">
	<tr>
		<td align="right" width="200"><label for="url">Redmine URL</label></td>
		<td align="left">
			<input name="url" type="text" id="url" size="25" class="key" value="<?php echo Utils::getLastUrl(); ?>" />
			<?php echo Utils::select(Utils::getUrls(), '', 'id="urllist" onchange="loadUrl(this.value)"'); ?>
		</td>
	</tr>
	
	<tr>
		<td align="right"><label for="key">API Key</label></td>
		<td align="left">
			<input name="username" value="" type="text" class="key" id="key" size="25" />
			<input name="password" value="X" type="hidden" class="key" />
		</td>
	</tr>

	<tr>
		<td align="left" colspan="2">
			<p>You can find your API key on your account page ( /my/account ) when logged in, on the right-hand pane of the default layout.</p>
		</td>
	</tr>
	
	<tr>
		<td align="left"><a href="#" onclick="loginToggle(); return false;">Provide Username/Pass</a></td>
		<td align="right"><input type="submit" name="submit" value="Login" /></td>
	</tr>
</table>
</form>

<script>
	loginToggle()
</script>
<?php require 'footer.html.php'; ?>
