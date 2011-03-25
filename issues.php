<?php
require_once 'functions.php';
Utils::requireLogin();

$redmine = new Redmine();

 
// Getting all Projects
$projects = $redmine->getProjects();
$projects = $redmine->processProjects($projects);

// Getting users
$users = $redmine->getUsers();
$users = $redmine->processUsers($users);

$today = date('Y-m-d');
$tmrw = date('Y-m-d', time() + 24 * 3600);

?>
<?php include 'head.html.php'; ?>
<h2>Add Issues</h2>
<p>Multiple issues can be added, all assigned to the same project.</p>
<form method="post" action="<?php echo Utils::getProcessLink(__FILE__); ?>" class="niceform">

<table cellpadding="5" class="rows" width="900" align="center">
	<tr class="project">
		<th valign="top">Please Select a Project *</th>
		<td valign="top" colspan="5"><?php echo Utils::Select($projects, 'project'); ?></td>
	</tr>
	
	<tr>
		<th>Subject *</th>
		<th>Description</th>
		<th>Assign To</th>
		<th>Start Date</th>
		<th>Due Date</th>
		<th>Est. Hours</th>
	</tr>
	
	<tr class="copy">
		<td valign="top"><input type="text" name="issues[subject][]" size="30"/></td>
		<td valign="top"><input type="text" name="issues[description][]" size="36" /></td>
		<td valign="top"><?php echo Utils::Select($users, 'issues[assigned_to_id][]', 'id="assignee"'); ?></td>
		<td valign="top"><input type="text" name="issues[start_date][]" class="date" size="10" value="<?php echo $today; ?>" /></td>
		<td valign="top"><input type="text" name="issues[due_date][]" class="date" size="10" value="<?php echo $tmrw; ?>" /></td>
		<td valign="top"><input type="text" name="issues[estimated_hours][]" size="4" /></td>
	</tr>

</table>
<table width="900" align="center">
<tr>
<td align="right">
	<a href="#" onclick="addmore(); return false;">Add More</a> or <input type="submit" name="submit" value="Save!" />
</td>
</tr>
</table>


<script>
	addmore(4);
</script>

</form>

<?php require 'footer.html.php'; ?>
