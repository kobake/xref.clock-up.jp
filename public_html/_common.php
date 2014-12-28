<?php
function h($text){
	return htmlspecialchars($text);
}
function r($text){
	return $text;
}

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
		$line = preg_replace('/\#.*/', '', $line);
		// 後ろの余計な文字削除
		$line = preg_replace('/[\t ]+$/', '', $line);
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
						if (preg_match("/^{$localIndent}(\t*)([^\\t].*)/", $line, $m)) {
							$content .= "<br/>" . str_replace("\t", "&nbsp;&nbsp;&nbsp;", $m[1]) . $m[2];
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
					if(preg_match("/^{$baseIndent}\t(\t*)([^\\t].*)/", $line, $m)){
						$content .= str_replace("\t", "&nbsp;&nbsp;&nbsp;", $m[1]) . $m[2] . "<br/>";
					}
					else{
						$i = $j - 1;
						break;
					}
				}
				$content = preg_replace('/<br\/>$/i', '', $content);
			}
			// title加工(連続アンダースコア除去)
			$title = preg_replace('/_+/', '_', $title);
			// engines, features
			$tmp = explode('_', $title);
			if(count($tmp) == 2){
				// feature_engine という構成の場合は要素を反転する
				if(array_search($tmp[1], $default_engines) !== false){
					$t = $tmp[0];
					$tmp[0] = $tmp[1];
					$tmp[1] = $t;
					$title = "{$tmp[0]}_{$tmp[1]}";
				}
				// 格納
				$engines[$tmp[0]] = 1;
				$features[$tmp[1]] = 1;
			}
			// title, content出力
			$ret[$title] = $content;
		}
	}
	$engines = array_keys($engines);
	$features = array_keys($features);
	return $ret;
}
