<?php

// 各種変数初期化
$features = [];
$engines = ['C++', 'C#', 'Java', 'VB', 'PHP', 'JS', 'Ruby', 'Python', 'Perl'];
$originalEngines = $engines;

// 全データ読み込み
$table = file_get_contents(APP_ROOT . '/contents/language.txt');
$contents = generateContents($table, $engines, $features, $engines);

// テンプレート出力準備
$smarty->assign('engines', $originalEngines);
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
section('engine:エンジン/run:起動', [
	'対話起動',
	]
);

// 変数
section('variable:変数・定数/declare:変数宣言', [
	'変数宣言',
	'グローバル変数',
	'局所変数',
	]
);
section('variable:変数・定数/literal:整数リテラル', [
	'10進',
	'16進',
	'8進',
	'2進',
	]
);
section('variable:変数・定数/const:定数等', [
	'定数',
	'列挙型',
	]
);
section('variable:変数・定数/string:文字列', [
	'リテラル',
	'結合',
	]
);

// 出力
section('io:入出力/standard:標準入出力', [
	'標準出力',
	'標準入力',
	]
);
section('io:入出力/file:ファイル入出力', [
	'ファイル出力',
	'ファイル入力',
	]
);

// 演算
section('calc:演算/logic:論理演算', [
	'論理OR',
	'論理AND',
	'論理NOT',
	]
);
section('calc:演算/bit:ビット演算', [
	'ビットOR',
	'ビットAND',
	'ビットNOT',
	'ビットXOR',
	]
);
section('calc:演算/bool:BOOL', [
	'True定数',
	'False定数',
	'True判定',
	'False判定',
	]
);

// 制御構造
section('control:制御/cond:分岐', [
	'if分岐',
	'switch分岐',
	]
);
section('control:制御/floop:For系ループ', [
	'Forループ',
	'ForEachループ',
	]
);
section('control:制御/wloop:While系ループ', [
	'Whileループ',
	'DoWhileループ',
	]
);
section('control:制御/jump:ジャンプ', [
	'ループ抜け',
	'ループ継続',
	]
);
section('control:制御/exception:例外', [
	'例外送出',
	'例外Catch',
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


section('invalid:無効値', [
	'無効値',
	'無効判定',
	]
);



