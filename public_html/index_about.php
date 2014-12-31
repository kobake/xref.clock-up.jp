<?php

require_once(dirname(__FILE__) . '/_common.php');

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../../favicon.ico">

		<title><?php echo TITLE; ?></title>

		<!-- Bootstrap core CSS -->
		<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="/jquery-ui/jquery-ui.min.css" rel="stylesheet">
		<link href="/css/sb-admin-2.css" rel="stylesheet">
		<link href="/font-awesome/css/font-awesome.css" rel="stylesheet">
		<link href="/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
		
		<!-- Custom styles for this template -->
		<link href="/css/dashboard.css" rel="stylesheet">
		
		<!-- App css -->
		<link href="/css/app.css" rel="stylesheet">

		<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
		<!--[if lt IE 9]><script src="/jslib/ie8-responsive-file-warning.js"></script><![endif]-->
		<script src="/jslib/ie-emulation-modes-warning.js"></script>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<style>
			td{
				font-family: 'ＭＳ ゴシック';
			}
			red{
				color: red;
			}
		</style>

		<!-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -->
		<!-- コンテンツ用 -->
		<!-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -->
		<style>
			#content h1,
			#content h2{
				padding: 8px 0px;
				color: #444;
				font-size: 38pt;
				margin-bottom: 0px;
			}
			#content h2{
				font-size: 26pt;
				margin-bottom: 0px;
			}
			#content p,
			#content ul{
				padding: 8px 0px;
				color: #444;
				font-size: 16pt;
			}
			#content ul{
				margin-left: 10px;
				list-style: none;
			}
			#copyright{
				margin-top: 16px;
				font-size: 16px;
			}
		</style>
	</head>

	<body class="current-mode0 current-engine-mysql-on current-engine-oracle-on current-engine-postgresql-on current-engine-sqlite-on">

		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/"><?php echo TITLE; ?></a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li><a href="/database">Database</a></li>
					</ul>

					<!-- 右上About -->
					<ul class="nav navbar-nav navbar-right">
						<li class="active"><a href="/about">About</a></li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="container" id="content">
			<h1>About</h1>
			<h2>Author: kobake</h2>
			<ul>
				<li><a target="_blank" href="https://github.com/kobake"><i class="fa fa-github"></i> Github</a></li>
				<li><a target="_blank" href="https://twitter.com/kobayan_tokyo"><i class="fa fa-twitter"></i> Twitter</a></li>
				<li><a target="_blank" href="http://blog.clock-up.jp"><i class="fa fa-cube"></i> Blog</a></li>
				<li><a target="_blank" href="http://clock-up.jp"><i class="fa fa-cube"></i> Website</a></li>
			</ul>
			<div id="copyright">(C) 2014 <?php echo TITLE; ?></div>
		</div>

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="/jslib/jquery-2.1.3.min.js"></script>
		<script src="/jquery-ui/jquery-ui.min.js"></script>
		<script src="/bootstrap/js/bootstrap.min.js"></script>
		<!-- <script src="/jslib/docs.min.js"></script> -->
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="/jslib/ie10-viewport-bug-workaround.js"></script>
		<script src="/metisMenu/dist/metisMenu.min.js"></script>
		<script src="/js/app.js"></script>
		
		<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-8719837-12', 'auto');
  ga('send', 'pageview');

		</script>
	</body>
</html>
