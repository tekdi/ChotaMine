<?php 
$title = 'Chotamine - ';
$pcs = explode('.', basename($_SERVER['REQUEST_URI']));
$title .= ucfirst($pcs[0]);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<title><?php echo $title; ?></title>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	
	<!-- facebook meta -->
	<meta property="og:title" content="ChotaMine - A lightweight redmine wrapper" />
	<meta property="og:type" content="product" />
	<meta property="og:url" content="http://chotamine.tekdi.net" />
	<meta property="og:image" content="http://chotamine.tekdi.net/images/logo.png" />
	<meta property="og:site_name" content="CHotaMine" />
	<meta property="fb:admins" content="618695599"/>
	<meta property="og:description"
          content="ChotaMine is a lightweight, PHP based frontend for Redmine. Features include the faclity to add multiple issues from a single screen & upload issues."/>

	<link rel="shortcut icon" href="images/favicon_2.ico" />
	<link rel="icon" href="images/favicon.ico" />

	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="css/default.css" />
	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7/themes/smoothness/jquery-ui.css" />

	<!-- JS -->
	<script type="text/javascript" language="javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>
	<!--<script type="text/javascript" language="javascript" src="http://github.com/malsup/corner/raw/master/jquery.corner.js?v2.09"></script>-->

	<script>
	//$('#header').corner();
	//$('#wrapper').corner();	
	
	function addmore(count) {
		if (typeof(count) == 'undefined') {
			count = 1;
		}
		
		for (i=0; i<count; i++) {
			$('.copy').clone(false).removeClass('copy').removeClass('hasDatepicker').appendTo('.rows').show();
		}
		$('.date').datepicker({dateFormat: 'yy-mm-dd'});
		$('#ui-datepicker-div').hide();

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
	
	function loadUrl() {
		alert($('#urllist').value);
		$('#url').value = $('#urllist').value;
	}

	</script>
	
	<script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-22788771-1']);
	  _gaq.push(['_trackPageview']);

	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	</script>

</head>
<body>

<div id="logo-wrap">
	<table id="logo" width="100%">
		<tr>
			<td>
				<h1><a href="index.php">ChotaMine</a></h1>
				<h2>beta</h2>
			</td>
			<td id="logo-right"><iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fchotamine.tekdi.net&amp;layout=button_count&amp;show_faces=false&amp;width=200&amp;action=like&amp;font&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:21px;" allowTransparency="true"></iframe></td>
		</tr>
	</table>
</div>

<!-- start header -->
<div id="header" class="rounded">
	<div id="menu">
		<?php if (Utils::isLoggedin()) { ?>
		<ul>
			<li class=""><a href="issues.php">Add issues</a></li>
			<li><a href="projects.php">Add Projects</a></li>
			<li><a href="issuescsv.php">Upload Issues</a></li>
			<li><a href="logout.php">Log out</a></li>
			<li><a href="feedback.php" class="special">Feedback</a></li>
		</ul>
		<?php } else { ?>
		<ul>
			<li><a href="login.php">Login to add issues projects & more</a></li>
			<li><a href="feedback.php" class="special">Feedback</a></li>		
		</ul>
		<?php } ?>
	</div>
</div>
<!-- end header -->
<p></p>
<!-- start page -->
<div id="wrapper" class="rounded">
<div id="wrapper-btm">
<div id="page">
	<!-- start content -->
	<div id="content">
	<?php echo Utils::showMessage(); ?>
