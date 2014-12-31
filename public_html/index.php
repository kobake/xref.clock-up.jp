<?php
function setDefaultTimezone($timezone) {
	if (!ini_get('date.timezone')) {
		date_default_timezone_set($timezone);
	}
}

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
if($uri_without_query === '/database'){
	include(dirname(__FILE__) . '/index_database.php');
}
else if($uri_without_query === '/about'){
	include(dirname(__FILE__) . '/index_about.php');
}
else if($uri_without_query === '/'){
	include(dirname(__FILE__) . '/index_top.php');
}
else{
	header("HTTP/1.0 404 Not Found");
	include(dirname(__FILE__) . '/index_notfound.php');
}

