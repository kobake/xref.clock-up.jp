<?php
function h($text){
	return htmlspecialchars($text);
}
function r($text){
	return $text;
}

function generateContents($text, &$engines, &$features){
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
			}
			else{
				// content読み取り
				$content = '';
				for($j = $i + 1; $j < count($lines); $j++){
					$line = $lines[$j];
					if(preg_match("/^{$baseIndent}\t(\t*)([^\\t].*)/", $line, $m)){
						$content .= str_replace("\t", "&nbsp;&nbsp;&nbsp;", $m[1]) . $m[2] . "<br/>";
					}
					else{
						break;
					}
				}
				$content = preg_replace('/<br\/>$/i', '', $content);
			}
			// title加工(連続アンダースコア除去)
			$title = preg_replace('/_+/', '_', $title);
			// title, content出力
			$ret[$title] = $content;
			// engines, features
			$tmp = explode('_', $title);
			if(count($tmp) == 2){
				$engines[$tmp[0]] = 1;
				$features[$tmp[1]] = 1;
			}
		}
	}
	$engines = array_keys($engines);
	$features = array_keys($features);
	return $ret;
}
