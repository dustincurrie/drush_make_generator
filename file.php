<?php

include('_lib.php');

// sanitize token and pull makefile from db
$token = (isset($_REQUEST['token']) && preg_match('/^[a-f0-9]{12}/',$_REQUEST['token'])) ? $_REQUEST['token'] : '';
$makefile = generateMakefile($token);

if (!$makefile){
  $fail = 'fail';
  $error = "Something broke :(\r\n
Check your URL...\r\n\r\n\r\n
...or if there's an error onscreen post it at https://github.com/rupl/drush_make_generator/issues - thanks!";
}

?><!doctype html>  

<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title>Drush Make Generator - Customized Drupal Installs</title>
	<meta name="description" content="http://drushmake.me helps you build install profiles or quickly install Drupal using drush make. Powered by Four Kitchens. ">
	<meta name="author" content="Chris Ruppel">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	
	<!-- link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Droid+Sans" -->
	<link rel="stylesheet" href="/css/960.css" media="(min-width: 960px)">
	<link rel="stylesheet" href="/css/formalize.css" media="(min-width: 481px)">
	<link rel="stylesheet" href="/css/style.css?v=2">
	<script src="/js/libs/modernizr-1.6.min.js"></script>
</head>

<body class="container_12">
	
	<header class="grid_12">
		<h1>Drush Make Generator</h1>
		<nav>
			<ol>
				<li><a href="/">what's going on?</a></li>
				<li><a href="/index.php#generate">generate</a></li>
				<li><a href="http://drupal.org/project/drush_make">make</a></li>
			</ol>
		</nav>
	</header>
	
	<div class="grid_12" id="what">
		<?php if (isset($fail)){ ?>
  		<h2>Dang it...</h2>
  		<textarea name="makefile" id="makefile" class="<?php print $fail ?>"><?php print $error; ?></textarea>
		<?php } else { ?>
  		<h2>Your makefile is ready</h2>
  		<p>We've saved it for you as well!</p>
  		<p><a href="<?php print fileURL($token); ?>">Bookmark</a> or (in the future) update at any time.</p>
  		<textarea name="makefile" id="makefile"><?php print $makefile; ?></textarea>
		<?php } ?>
	</div>
	
	<div class="grid_12" id="deploy">
		<h2>Deploy your makefile</h2>
		<p><a href="http://drupal.org/project/drush">Drush</a> and <a href="http://drupal.org/project/drush_make">Drush Make</a> turn your makefile into a Drupal installation. Then you can get building!</p>
	</div>
	
  <?php include('footer.php'); ?>

</body>
</html>