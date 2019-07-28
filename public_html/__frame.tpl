<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="横断リファレンス的な。">
		{if $keywords !== ''}
		<meta name="keywords" content="{$keywords}">
		{/if}
		<meta name="author" content="kobake">
		<link rel="icon" type="image/png" href="/favicon.png">

		<title>{$sitetitle}{$sitesubtitle}</title>

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

		<!-- 最低限必要なJS -->
		<script src="/jslib/jquery-2.1.3.min.js"></script>
		<script src="/js/app.js"></script>

		<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
		<!--[if lt IE 9]><script src="/jslib/ie8-responsive-file-warning.js"></script><![endif]-->
		<script src="/jslib/ie-emulation-modes-warning.js"></script>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<!-- はてなID関連付け -->
		{if $contentpath !== ''}
			<rdf:RDF
			xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
			xmlns:dc="http://purl.org/dc/elements/1.1/"
			xmlns:foaf="http://xmlns.com/foaf/0.1/">
			<rdf:Description rdf:about="https://xref.clock-up.jp{$contentpath}">
			<foaf:maker rdf:parseType="Resource">
			<foaf:holdsAccount>
			<foaf:OnlineAccount foaf:accountName="kobake">
			<foaf:accountServiceHomepage rdf:resource="http://www.hatena.ne.jp/" />
			</foaf:OnlineAccount>
			</foaf:holdsAccount>
			</foaf:maker>
			</rdf:Description>
			</rdf:RDF>
		{/if}

		<!-- フォント等 -->
		<style>
			td{
				font-family: 'ＭＳ ゴシック';
			}
			red{
				color: red;
			}
		</style>

		<!-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -->
		<!-- マトリクス以外のコンテンツ用 -->
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
			#content.about ul{
				margin-left: 10px;
				list-style: none;
			}
			#copyright{
				margin-top: 16px;
				font-size: 16px;
				margin-bottom: 16px;
			}
			#content.top ul{
				margin-left: 30px;
			}
		</style>
		
	</head>

	<body data-spy="scroll" data-offset="50" class="current-mode1 content-{$contentname}">

		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#head-navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/">{$sitetitle}</a>
				</div>
				<div class="navbar-collapse collapse" id="head-navbar">
					<!-- 各コンテンツリンク -->
					<ul class="nav navbar-nav">
						<li {if $sitesubtitle === ' - Database'}class="active2"{/if}><a href="/database">Database</a></li>
						<li {if $sitesubtitle === ' - Package' }class="active2"{/if}><a href="/package" >Package</a></li>
						<li {if $sitesubtitle === ' - Language'}class="active2"{/if}><a href="/language">Language</a></li>
					</ul>
					
						{if $sitesubtitle === ' - Database' || $sitesubtitle === ' - Package' || $sitesubtitle === ' - Language'}
					<!-- 縦横切替 -->
					<div id="mode-buttons" class="btn-group" data-toggle="buttons" style="margin-top: 8px; margin-left: 16px;">
						<label class="btn btn-default">
							<input type="radio" name="options" id="mode0" autocomplete="off"> 縦
						</label>
						<label class="btn btn-info active">
							<input type="radio" name="options" id="mode1" autocomplete="off" checked> 横
						</label>
					</div>
					
					<!-- エンジン切替 -->
					<div id="engine-buttons" class="btn-group" data-toggle="buttons" style="margin-top: 8px; margin-left: 8px;">
						{foreach from=$engines item=engine}
							<label class="btn btn-info active">
								<input type="checkbox" name="options" id="engine-{$engine|enginekey}" autocomplete="off" checked> {$engine}
							</label>
						{/foreach}
					</div>
					
					<script>
						initMode(0);
					</script>
					{/if}

					<!-- 右上About -->
					<ul class="nav navbar-nav navbar-right">
						<li {if $sitesubtitle===' - About'}class="active2"{/if}><a href="/about">About</a></li>
					</ul>
				</div>
			</div>
		</nav>

		{$content}


		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="/jslib/jquery.mousewheel.min.js"></script>
		<script src="/jquery-ui/jquery-ui.min.js"></script>
		<script src="/bootstrap/js/bootstrap.min.js"></script>
		<!-- <script src="/jslib/docs.min.js"></script> -->
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="/jslib/ie10-viewport-bug-workaround.js"></script>
		<script src="/metisMenu/dist/metisMenu.min.js"></script>
		
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