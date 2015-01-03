<?php

// 各種変数初期化
$features = [];
$engines = ['C++', 'C#', 'Java', 'PHP', 'JS', 'Ruby', 'Python', 'Perl'];
$originalEngines = $engines;

// 全データ読み込み
$table = file_get_contents(APP_ROOT . '/contents/language.txt');
$contents = generateContents($table, $engines, $features, $engines);

// テンプレート出力準備
$smarty->assign('engines', $engines);
$smarty->assign('contents', $contents);

// 全セクション準備
/*
  section(
  '導入・管理',
  [
  'インストール',
  '起動・停止',
  '管理ログイン'
  ]
  );
 */
// 閲覧
section('variable:変数', [
	'変数宣言',
	'グローバル変数',
	]
);
section('invalid:無効値', [
	'無効値',
	'無効判定',
	]
);

// 制御構造
section('control:制御構造', [
	'if分岐',
	'switch分岐',
	'whileループ',
	'回数ループ'
	]
);

// 出力
section('output:出力', [
	'Hello出力',
	]
);

