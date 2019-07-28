<?php
function h($text){
	return htmlspecialchars($text);
}
function r($text){
	return $text;
}

// title
define('TITLE', 'xRef');

// smarty
define('SMARTY_DIR', dirname(dirname(__FILE__)) . '/smarty/libs/');
require_once(SMARTY_DIR . '/Smarty.class.php');
$smarty = new Smarty();
$smarty->template_dir = dirname(dirname(__FILE__)) . '/smarty/tmp/template';
$smarty->compile_dir  = dirname(dirname(__FILE__)) . '/smarty/tmp/compile';
$smarty->config_dir   = dirname(dirname(__FILE__)) . '/smarty/tmp/config';
$smarty->cache_dir    = dirname(dirname(__FILE__)) . '/smarty/tmp/cache';
// 次の行のコメントをはずすと、デバッギングコンソールを表示します
// $smarty->debugging = true;


// Smartyカスタムフィルタ
function enginekey($tpl_output) {
	$tpl_output = strtolower($tpl_output);
	$tpl_output = str_replace('c++', 'cpp', $tpl_output);
	$tpl_output = str_replace('c#', 'csharp', $tpl_output);
	return $tpl_output;
}
//$smarty->registerFilter('post', 'enginekey');

// 全セクション保持
$g_sections = [];
$g_sectionsBody = '';

// セクションタイトル抜き出し
function section_title($sectiontitle){
	$tmp = explode('/', $sectiontitle);
	return $tmp[count($tmp) - 1];
}

// リンク出力
function easylink($title) {
	$tmp = explode(':', $title);
	return "<a href=\"#{$tmp[0]}\">{$tmp[1]}</a>\n";
}

// メニュー出力
function fetch_menus(){
	$ret = '';
	global $g_categories;
	foreach ($g_categories as $category){
		if ($category['categoryname'] === '無'){
			foreach ($category['titles'] as $title){
				$ret .= "<li>" . easylink($title) . "</li>\n";
			}
		}
		else{
			// 階層を用いない。これだとScrollSpyが親子ともに効く
			if(true){
				$ret .= "<li class=\"parent-li\">" . easylink($category['categoryname']) . "</li>\n";
				foreach ($category['titles'] as $title) {
					$ret .= "<li class=\"second\">" . easylink($title) . "</li>";
				}
			}
			// 階層。これだとScrollSpyが親にしか効かない。
			if(false){
				$ret .= "<li class=\"parent-li\">" . easylink($category['categoryname']) . "\n";
				$ret .= "<ul class=\"nav nav-second-level\">\n";
				foreach ($category['titles'] as $title){
					$ret .= "<li>" . easylink($title) . "</li>";
				}
				$ret .= "</ul>\n";
				$ret .= "</li>\n";
			}
		}
	}
	return $ret;
}

function slashright($str){
	$tmp = explode('/', $str);
	return $tmp[count($tmp) - 1];
}

function colright($str) {
	$tmp = explode(':', $str);
	return $tmp[count($tmp) - 1];
}

function colleft($str) {
	$tmp = explode(':', $str);
	return $tmp[0];
}

function find_section($sectiontitle){
	global $g_sections;
	//var_dump($g_sections);exit;
	foreach ($g_sections as $section) {
		if(slashright($section['title']) === slashright($sectiontitle))return $section;
	}
	return null;
}

// 全セクション確定
function sections_commit(){
	global $g_categories;
	global $g_sections;
	global $smarty;
	
	// カテゴリ構築、およびanchor整理
	$g_categories = [];
	foreach ($g_sections as $section) {
		$title = $section['title'];
		$tmp = explode('/', $title);
		if (count($tmp) < 2) {
			array_unshift($tmp, '無');
		}
		$category = $tmp[0];
		$title = $tmp[1];
		if (count($g_categories) == 0 || $g_categories[count($g_categories) - 1]['categoryname'] !== $category) {
			$g_categories[] = [
				'categoryname' => $category,
				'titles' => []
			];
		}
		$g_categories[count($g_categories) - 1]['titles'][] = $title;
	}
	
	// コンテンツ部構築
	// var_dump($g_categories); exit;
	foreach($g_categories as $category){ // 「無」とか「管理」とか「テーブル定義」とか
		// 大見出し
		$h = 2;
		if($category['categoryname'] !== '無'){
			$id = colleft($category['categoryname']);
			section_echo("<h{$h} id=\"{$id}\" class=\"sub-header\">" . colright($category['categoryname']) . "</h{$h}>");
			$h++;
		}

		foreach($category['titles'] as $sectiontitle0){ // 「テーブル作成・削除」とか
			$tmp = explode(':', $sectiontitle0);
			$anchor = '';
			$sectiontitle = $sectiontitle0;
			if(count($tmp) >= 2){
				$anchor = $tmp[0];
				$sectiontitle = $tmp[1];
			}
			
			// 中見出し
			$id = colleft($sectiontitle0);
			section_echo("<h{$h} id=\"{$id}\" class=\"sub-header\">$sectiontitle</h{$h}>");
	
			// section内容出力
			if($sectiontitle !== '無'){
				// sectionを探す
				$section = find_section($sectiontitle0);
				if(!$section){
					print "<div style=\"margin-left: 300px; margin-top: 50px;\">";
					print "sectiontitle = $sectiontitle0 が見つかりません\n";
					print "</div";
					//var_dump($sectiontitle);
					//continue;
					exit;
				}

				// section出力準備
				$smarty->assign('features', $section['features']);

				// 縦出力
				section_echo("<div class=\"mode0\">\n"); {
					// section_echo("<h2 class = \"sub-header\">{$sectiontitle}</h2>\n");
					section_echo($smarty->fetch('_table_features.tpl'));
				}
				section_echo("</div>\n");

				// 横出力
				section_echo("<div class=\"mode1\">\n"); {
					// section_echo("<h2 class = \"sub-header\">{$sectiontitle}</h2>\n");
					section_echo($smarty->fetch('_table_engines.tpl'));
				}
				section_echo("</div>\n");
			}
		}
	}
}

// 全セクション出力
function fetch_sections(){
	global $g_sectionsBody;
	return $g_sectionsBody;
}

// セクション出力ラップ
function section_echo($text){
	global $g_sectionsBody;
	$g_sectionsBody .= $text;
}

// セクション準備
function section($title, $features) {
	global $g_sections;
	
	$g_sections[] = [
		'title' => $title,
		'features' => $features
	];
}

// コメント除去
function removeLineComment($line){
	// 特殊な「#」をマーク
	$line = preg_replace('/\# (yum|service|mysql)/', '＃ \1', $line);
	$line = preg_replace('/([\_\,\t ])C\#([\_\,\t ])/', '\1C＃\2', $line);
	$line = preg_replace('/^C\#([\_\,\t ])/', 'C＃\1', $line);
	// コメントの除去
	// ※「#」の後ろには最低1個のスペースが必要。
	//   これにより、「#include」等をコメントとして扱われないようになる。
	$line = preg_replace('/\# .*/', '', $line);
	// 後ろの余計な文字削除
	$line = preg_replace('/[\t ]+$/', '', $line);
	// 戻し
	$line = str_replace('＃', '#', $line);
	return $line;
}

// 展開関数
function generateContents($text, &$engines, &$features, $default_engines){
	$engines = array();
	$features = array();
	
	$ret = array();
	$text = preg_replace('/\r\n/', "\n", $text);
	$text = preg_replace('/^\n/i', '', $text);
	$text = preg_replace('/\n\t+$/i', '', $text);
	$lines = preg_split('/\n/', $text);
	// 基本インデント
	$baseIndent = '';
	$m = array();
	if (preg_match('/^\t+/', $lines[0], $m)) {
		$baseIndent = $m[0];
	}
	// 構築
	$title = '';
	for($i = 0; $i < count($lines); $i++){
		$line = $lines[$i];
		// コメントの除去
		$line = removeLineComment($line);
		// 空行の無視
		if($line === '' || $line === $baseIndent){
			continue;
		}
		// 行解釈
		if(preg_match("/^{$baseIndent}([^\t].*)/", $line, $m)){
			$title = $m[1];
			$tmp = preg_split('/\t+/', $title);
			if(count($tmp) >= 2){
				// 行内content
				$title = array_shift($tmp);
				$content = implode("\t", $tmp);
				// -- 次以降も見ていく -- //
				// インデント長さ決定 (けっこうややこしいので注意。文字サイズという微妙な基準を元に計算を行う)
				preg_match('/^([^\t]+)(\t+)/', $line, $m);
				$tabs = $m[2];
				$sjis_title = mb_convert_encoding($title, 'Shift_JIS', 'UTF-8');
				$len = strlen($sjis_title);
				for($t = 0; $t < strlen($tabs); $t++){
					if($len % 4 === 0){
						$len += 4;
					}
					else{
						$len += (4 - $len % 4);
					}
				}
				$localIndentCount = (int)($len / 4);
				$localIndent = '';
				for($t = 0; $t < $localIndentCount; $t++){
					$localIndent .= "\t";
				}
				// 続き解釈
				if($i + 1 < count($lines) && preg_match('/^\t/', $lines[$i + 1])){
					for ($j = $i + 1; $j < count($lines); $j++) {
						$line = $lines[$j];
						// コメントの除去
						$line = removeLineComment($line);
						// 解析
						if (preg_match("/^{$localIndent}(\t*)([^\\t].*)/", $line, $m)) {
							if($m[2] === '.')$m[2] = '';
							$line = str_replace("\t", "&nbsp;&nbsp;&nbsp;&nbsp;", $m[1]) . $m[2];
							$content .= "<br/>" . $line;
						} else {
							$i = $j - 1;
							break;
						}
					}
				}
				$content = preg_replace('/<br\/>$/i', '', $content);
			}
			else{
				// content読み取り
				$content = '';
				// 続き解釈
				for($j = $i + 1; $j < count($lines); $j++){
					$line = $lines[$j];
					// コメントの除去
					$line = removeLineComment($line);
					if(preg_match("/^{$baseIndent}\t(\t*)([^\\t].*)/", $line, $m)){
						$content .= str_replace("\t", "&nbsp;&nbsp;&nbsp;", $m[1]) . $m[2] . "<br/>\n";
					}
					else if($line === ''){
						$content .= "<br/>\n";
					}
					else{
						$i = $j - 1;
						break;
					}
				}
				// 後ろの改行除去
				$old = $content;
				while(true){
					$content = preg_replace('/<br\/>\n$/i', '', $content);
					if($content === $old)break;
					$old = $content;
				}
			}
			// title加工(連続アンダースコア除去)
			$title = preg_replace('/_+/', '_', $title);
			// engines, features
			$tmp = explode('_', $title);
			if(count($tmp) == 2){
				// engine_feature という構成の場合はそのまま
				if (array_search($tmp[0], $default_engines) !== false) {
				}
				else if(strpos($tmp[0], ',') !== false){ // ※コンマがある場合はエンジンとみなす
				}
				// feature_engine という構成の場合は要素を反転する
				else if(strpos($tmp[1], ',') !== false){ // ※コンマがある場合はエンジンとみなす
					$t = $tmp[0];
					$tmp[0] = $tmp[1];
					$tmp[1] = $t;
					$title = "{$tmp[0]}_{$tmp[1]}";
				}
				else if(array_search($tmp[1], $default_engines) !== false){
					$t = $tmp[0];
					$tmp[0] = $tmp[1];
					$tmp[1] = $t;
					$title = "{$tmp[0]}_{$tmp[1]}";
				}
				// それ以外の構成の場合は無視
				else{
					continue;
				}
				// 格納
				$engines[$tmp[0]] = 1;
				$features[$tmp[1]] = 1;
			}
			// title, content出力
			$ret[$title] = $content;
			// 複数engine対応
			// 例「行コメント_C++,C#,Java,PHP	// comment」
			if(count($tmp) == 2){
				$multiEngines = explode(',', $tmp[0]);
				if(count($multiEngines) >= 2){
					$feature = $tmp[1];
					foreach($multiEngines as $engine){
						$title = "{$engine}_{$feature}";
						$ret[$title] = $content;
					}
				}
			}
		}
	}
	$engines = array_keys($engines);
	$features = array_keys($features);
	return $ret;
}
