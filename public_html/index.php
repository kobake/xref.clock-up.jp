<?php
function setDefaultTimezone($timezone) {
	if (!ini_get('date.timezone')) {
		date_default_timezone_set($timezone);
	}
}

// 環境
define('APP_TYPE', getenv('apptype'));

// 共通関数
require_once(dirname(__FILE__) . '/_common.php');

// 日本語対策 (これをしないと escapeshellarg が日本語を除外してしまう)
setlocale(LC_CTYPE, "en_US.UTF-8");
setDefaultTimezone('Asia/Tokyo');
mb_language('Japanese'); // mb_convert_encodingの挙動調整

// 定数定義
define('APP_ROOT', dirname(__FILE__));
define('DATA_ROOT', realpath(dirname(__FILE__) . '/../data'));
define('TMP_ROOT', realpath(dirname(__FILE__) . '/../tmp'));

// HTTPリクエスト -> $uri_without_query … "/", "/db" 等
$uri_without_query = '';
if(isset($_SERVER['REQUEST_URI'])){
	$uri_without_query = preg_replace('/\?.*/', '', $_SERVER['REQUEST_URI']);
	// *.xml, robots.txt の処理
	if(preg_match('/\.xml$/', $uri_without_query)){
		header('Content-type: text/xml; charset=UTF-8');
		print(file_get_contents(APP_ROOT . $uri_without_query));
		exit(0);
	}
	else if(preg_match('/robots\.txt$/', $uri_without_query)){
		header('Content-type: text/plain; charset=UTF-8');
		print(file_get_contents(APP_ROOT . $uri_without_query));
		exit(0);
	}
}
//print "uri_without_query = $uri_without_query\n";exit;

// コンテンツPHP
global $smarty;
$smarty->assign('sitetitle', TITLE);

if($uri_without_query === '/database'){
	include(dirname(__FILE__) . '/index_database.php');
	
	// 全セクション確定
	sections_commit();
	
	// 本体
	$smarty->assign('sitesubtitle', ' - Database');
	$smarty->assign('menus', fetch_menus());
	$smarty->assign('sections', fetch_sections());
	$content = $smarty->fetch(dirname(__FILE__) . '/_database.tpl');
}
else if($uri_without_query === '/about'){
	// 本体
	$smarty->assign('sitesubtitle', ' - About');
	$content = $smarty->fetch(dirname(__FILE__) . '/content_about.tpl');
}
else if($uri_without_query === '/'){
	// 本体
	$smarty->assign('sitesubtitle', '');
	$content = $smarty->fetch(dirname(__FILE__) . '/content_top.tpl');
}
else{
	header("HTTP/1.0 404 Not Found");
	include(dirname(__FILE__) . '/index_notfound.php');
	exit;
}

// HTML生成	
$smarty->assign('content', $content);
$html = $smarty->fetch(dirname(__FILE__) . '/__frame.tpl');

// 出力
print $html;
