<?php
require_once 'lib/functions.php';
//Utils::requireLogin();

include 'html/head.html.php'; 
?>
<h2>Feedback</h2>
<p>
Thank you for using ChotaMine. 
Suggestions, improvements criticism - Everything welcome
</p>
<p>The ChotaMine Team</p>

<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=193374100688264&amp;xfbml=1"></script>
<fb:comments href="http://chotamine.tekdi.net" num_posts="5" width="950"></fb:comments>

<?php include 'html/footer.html.php'; ?>
