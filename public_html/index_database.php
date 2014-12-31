<?php

// 各種変数初期化
$features = [];
$engines = ['MySQL', 'Oracle', 'PostgreSQL', 'SQLite'];

// 全データ読み込み
$table = file_get_contents('contents.txt');
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
// セッション
section(
	'session:ログイン・ログアウト',
	[
		'ログイン',
		'ログアウト',
	]
);

// 管理作業
section(
	'admin:管理/admin-user:ユーザ管理',
	[
		'ユーザ作成',
		'ユーザ削除',
		'ユーザ一覧',
	]
);
section(
	'admin:管理/admin-database:データベース管理',
	[
		'データベース作成',
		'データベース削除',
		'データベース一覧',
	]
);

// テーブル定義
// http://dev.mysql.com/doc/refman/5.6/en/sql-syntax-data-definition.html
section(
	'table-definition:テーブル定義/table-definition-createdrop:テーブル作成・削除',
	[
		'テーブル作成',
		'テーブル削除',
	]
);
section(
	'table-definition:テーブル定義/table-definition-alter:テーブル定義変更',
	[
		'テーブル名変更',
		'カラム名変更',
	]
);
section(
	'table-definition:テーブル定義/table-definition-info:テーブル情報参照',
	[
		'テーブル定義表示',
		'テーブル一覧表示',
	]
);

// テーブル操作
section(
	'table-manipulation:テーブル操作/table-manipulation-crud:テーブル操作概要',
	[
		'選択',
		'挿入',
		'更新',
		'削除',
	]
);
section(
	'table-manipulation:テーブル操作/table-manipulation-select:テーブル選択',
	[
		'条件',
		'並び',
		'件数',
	]
);
section(
	'table-manipulation:テーブル操作/table-manipulation-insert:テーブル挿入',
	[
		'自動連番',
	]
);

// トランザクション
section(
	'transaction:トランザクション',
	[
		'トランザクション開始',
		'トランザクション確定',
		'トランザクション破棄',
	]
);
