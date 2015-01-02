<?php

// 各種変数初期化
$features = [];
$engines = ['yum', 'apt', 'rpm', 'gem', 'pear', 'pecl', 'npm', 'pip'];
$originalEngines = $engines;

// 全データ読み込み
$table = file_get_contents(APP_ROOT . '/contents/package.txt');
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
section('view:閲覧/view-list:一覧', [
	'利用可能一覧',
	'インストール済一覧',
	]
);
section('view:閲覧/view-details:詳細', [
	'パッケージ情報',
	'依存表示',
	'ファイル一覧',
	]
);

// 更新
// section('update:更新/update-database:データベース更新', [
// 	'リポジトリ更新',
// 	]
// );
section('update:更新/update-database:パッケージ更新', [
	'インストール',
	'アンインストール',
	'アップデート'
	]
);
section('update:更新/update-all:一括更新', [
	'一括アップデート',
	]
);

// その他
/*
section('other:その他/other-develop:開発者向け', [
	'ソースコード取得',
	]
);
*/
