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
section('engine:エンジン/run:起動・依存', [
	'対話起動',
	'インポート',
	]
);

// メタ
section('engine:エンジン/comment:コメント', [
	'行コメント',
	'ブロックコメント',
	]
);
/*
section('meta:メタ/depend:依存', [
	'名前空間',
	'プリプロセス',
	]
);
*/

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
section('variable:変数・定数/invalid:無効値', [
	'無効値定数',
	'無効値判定',
	]
);
section('variable:変数・定数/bool:真偽', [
	'True定数',
	'False定数',
	'True判定',
	'False判定',
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
	'ビットシフト',
	]
);

// 文字・文字列
section('string:文字・文字列/string-literal:文字と文字列', [
	'文字',
	'文字列',
	'ヒアドキュメント'
	]
);
section('string:文字・文字列/string-op:比較と抽出', [
	'文字列比較',
	'文字列検索',
	'文字列抽出',
	]
);
	
section('string:文字・文字列/string-format:文字列加工', [
	'文字列結合',
	'変数埋め込み',
	'文字列整形',
	]
);



// 制御構造
section('control:制御/cond:分岐', [
	'If分岐',
	'Switch分岐',
	]
);
section('control:制御/loop:ループ', [
	'Forループ',
	'ForEachループ',
	'Whileループ',
	// 'DoWhileループ',
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

// 高度
section('ex:構造/function:関数', [
	'関数定義',
	'関数利用',
	'参照渡し',
	'参照渡し利用',
	]
);
section('ex:構造/class:クラス', [
	'クラス定義',
	'クラス継承',
	'クラス利用',
	]
);
/*
section('ex:構造/opover:演算子オーバーロード', [
	'演算子オーバーロード',
	]
);
*/

/*
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
*/




/*
section('logic2:演算まとめ', [
	'論理演算',
	'ビット演算',
	'四則演算',
	]
);
*/



