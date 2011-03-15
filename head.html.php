<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<title>Redmine - Issue Add</title>
	<link rel="stylesheet" type="text/css" href="css/default.css" />
	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7/themes/smoothness/jquery-ui.css" />

	<script type="text/javascript" language="javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
	<script type="text/javascript" language="javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/jquery-ui.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://github.com/malsup/corner/raw/master/jquery.corner.js?v2.09"></script>

	<script>
	$('#header').corner();
	$('#wrapper').corner();	
	
	function addmore(count) {
		if (typeof(count) == 'undefined') {
			count = 1;
		}
		
		for (i=0; i<count; i++) {
			$('.copy').clone(false).removeClass('copy').removeClass('hasDatepicker').appendTo('.rows');
		}
		$('.date').datepicker({dateFormat: 'yy-mm-dd'});
		//$('#ui-datepicker-div').hide();

	}
	
	function  loginToggle() {
		if ($('#user').is(":visible") ) {
			$('#user').hide();
			$('.username').attr('disabled', true);
			
			$('#key').show();
			$('.key').attr('disabled', false);
		} else {
			$('#user').show();
			$('.username').attr('disabled', false);
			
			$('#key').hide();
			$('.key').attr('disabled', true);
		}

	}

	</script>
</head>
<body>

<div id="logo-wrap">
<div id="logo">
	<h1><a href="#">LITEMINE</a></h1>
	<h2>A Light Redmine</h2>
</div>
</div>

<!-- start header -->
<div id="header">
	<div id="menu">
		<ul>
			<li class=""><a href="issues.php">Add issues</a></li>
			<li><a href="projects.php">Add Projects</a></li>
			<li><a href="issuescsv.php">Upload Issues</a></li>
		</ul>
	</div>
</div>
<!-- end header -->
<p></p>
<!-- start page -->
<div id="wrapper">
<div id="wrapper-btm">
<div id="page">
	<!-- start content -->
	<div id="content">
