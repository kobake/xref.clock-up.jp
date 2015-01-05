<?php

/*
a
a
a
a
 */
// 各種変数初期化
$features = [];
$engines = ['C++', 'C#', 'Java', 'VB', 'PHP', 'JS', 'Ruby', 'Python', 'Perl'];
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
section('run:起動', [
	'対話起動',
	]
);

section('logic:論理演算', [
	'論理OR',
	'論理AND',
	'論理NOT',
	]
);
section('bit:ビット演算', [
	'ビットOR',
	'ビットAND',
	'ビットNOT',
	'ビットXOR',
	]
);
section('bool:BOOL', [
	'True定数',
	'False定数',
	'True判定',
	'False判定',
	]
);
/*
section('logic2:演算まとめ', [
	'論理演算',
	'ビット演算',
	'四則演算',
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

