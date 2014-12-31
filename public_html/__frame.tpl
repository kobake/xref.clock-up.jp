<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../../favicon.ico">

		<title>{$sitetitle} - {$sitesubtitle}</title>

		<!-- Bootstrap core CSS -->
		<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="/jquery-ui/jquery-ui.min.css" rel="stylesheet">
		<link href="/css/sb-admin-2.css" rel="stylesheet">
		<link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet">
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
					<a class="navbar-brand" href="/">{$sitetitle}</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="/database">Database</a></li>
					</ul>
					
					<!-- 縦横切替 -->
					<div id="mode-buttons" class="btn-group" data-toggle="buttons" style="margin-top: 8px; margin-left: 16px;">
						<label class="btn btn-info active">
							<input type="radio" name="options" id="mode0" autocomplete="off" checked> 縦
						</label>
						<label class="btn btn-default">
							<input type="radio" name="options" id="mode1" autocomplete="off"> 横
						</label>
					</div>
					
					<!-- エンジン切替 -->
					<div id="engine-buttons" class="btn-group" data-toggle="buttons" style="margin-top: 8px; margin-left: 8px;">
						<label class="btn btn-info active">
							<input type="checkbox" name="options" id="engine-mysql"      autocomplete="off" checked> MySQL
						</label>
						<label class="btn btn-info active">
							<input type="checkbox" name="options" id="engine-oracle"     autocomplete="off" checked> Oracle
						</label>
						<label class="btn btn-info active">
							<input type="checkbox" name="options" id="engine-postgresql" autocomplete="off" checked> PostgreSQL
						</label>
						<label class="btn btn-info active">
							<input type="checkbox" name="options" id="engine-sqlite"     autocomplete="off" checked> SQLite
						</label>
					</div>

					<!-- 右上About -->
					<ul class="nav navbar-nav navbar-right">
						<li><a href="/about">About</a></li>
					</ul>
				</div>
			</div>
		</nav>

		<!-- 左サイドバーメニュー参考：http://ironsummitmedia.github.io/startbootstrap-sb-admin-2/pages/index.html -->
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-3 col-md-2 sidebar">
					
					<ul class="nav nav-first-level" id="side-menu"> <!-- ※nav-sidebarクラスを付けると、active部分が強調表示になる -->
						<!--
						<li class="sidebar-search">
							<div class="input-group custom-search-form">
								<input type="text" class="form-control" placeholder="Search...">
								<span class="input-group-btn">
									<button class="btn btn-default" type="button">
										<i class="fa fa-search"></i>
									</button>
								</span>
							</div>
						</li>
						  -->
						
						{$menus}

					</ul>

					

					<!-- アクティブ状態（選択状態）サンプル
					<li class="active"><a href="#">管理 <span class="sr-only">(current)</span></a></li>
					-->
					
				</div>
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
					<!-- <h1 class="page-header">Database</h1> -->
					
					{$sections}
					
				</div>
			</div>
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
		
		{literal}
		<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-8719837-12', 'auto');
  ga('send', 'pageview');

		</script>
		{/literal}
	</body>
</html>