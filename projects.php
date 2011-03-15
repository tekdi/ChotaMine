<?php
require_once 'functions.php';

$redmine = new Redmine(REMINE_URL, $_SESSION['redmine']['username'], $_SESSION['redmine']['password']);
 
// Getting all Projects
$projects = $redmine->getProjects();
$projects = $redmine->processProjects($projects);


?>
<?php include 'head.html.php'; ?>
<form method="post" action="<?php echo Utils::getProcessLink(__FILE__); ?>" class="niceform">


<table cellpadding="5" class="rows" width="900" align="center" cellspacing="0">
	<tr class="row0">
		<td align="right">Name</td>
		<td align="left"><input type="text" name="project[name]" size="30"/></td>
	</tr>
	
	<tr class="row1">
		<td align="right">Parent</td>
		<td align="left"><?php echo Utils::Select($projects, 'project[parent_id]'); ?></td>
	</tr>

	<tr class="row0">
		<td align="right">Identifer</td>
		<td align="left"><input type="text" name="project[identifier]" size="30"/></td>
	</tr>
		
	<tr class="row1">
		<td align="right">Description</td>
		<td align="left"><textarea name="project[description]" cols="28"></textarea></td>
	</tr>
	
	<tr class="row0">
		<td align="right">Homepage</td>
		<td align="left"><input type="text" name="project[homepage]" size="30" /></td>
	</tr>

	<tr class="row1">
		<td align="right">Public</td>
		<td align="left"><input type="checkbox" name="project[is_public]" value="1" /></td>
	</tr>

	<?php echo Utils::customFieldRow($custom_fields['project'], 0); ?>
	
</table>
<p></p>
<table width="900" align="center">
<tr>
<td align="right">
	<input type="submit" name="project[submit" value="Save!" />
</td>
</tr>
</table>


<script>
	//$('.date').datepicker({dateFormat: 'yy-mm-dd'});
	addmore(4);
</script>

</form>

<?php require 'footer.html.php'; ?>
