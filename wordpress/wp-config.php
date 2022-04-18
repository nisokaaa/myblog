<?php
//define( 'WP_DEBUG', true);

// リビジョンの無効化
define('WP_POST_REVISIONS', false);

/** WordPress のためのデータベース名 */
define( 'DB_NAME', getenv("DB_NAME") );

/** MySQL データベースのユーザー名 */
define( 'DB_USER', getenv("DB_USER") );

/** MySQL データベースのパスワード */
define( 'DB_PASSWORD', getenv("DB_PASSWORD") );

/** MySQL のホスト名 */
define( 'DB_HOST', getenv("DB_HOST") );

/** データベースのテーブルを作成する際のデータベースの文字セット */
define( 'DB_CHARSET', 'utf8mb4' );

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define( 'DB_COLLATE', '' );

/**
 * WordPress データベーステーブルの接頭辞
 */
$table_prefix = 'wp_';

/**
 * 認証用ユニークキー
 */
define( 'AUTH_KEY',         '-t-n*JXF&d^?`A`1Mn7-l)5[QA} M,U{&W$sQXQa(m}:8{q5@{Xq#!Ll*NIE+>p&' );
define( 'SECURE_AUTH_KEY',  'GI_#(ug(z=y,BY@X@JLqrLc0!C+cU=5{WIMDdG@NKdvPN`5Ef61I+o(1O}K%EkHr' );
define( 'LOGGED_IN_KEY',    'vRe^jz^T]orwGnEI|s)(28HOZ*S/-0Z=T3u*={`YN`%VvPtWWoQY+:wM.-|0`f83' );
define( 'NONCE_KEY',        '7WCM=SQ~$~%h]1G=<h79/Byv:`l,5lMOZ]Qr/oX,Zs 0QK^m]ec3bd`8ec<pBG`_' );
define( 'AUTH_SALT',        'cU?x)`5N(nJ!Tz_Qs3z;F`[Je|2E`AcJO<k_oV[r84g+qBs[y6T`y&gd}GY@.l9V' );
define( 'SECURE_AUTH_SALT', 'izHshf{0Ucry?B_;LF-SwqrJE0:[k?r34jxg00s<War_.,;N]1Rx%V}!8B($_syu' );
define( 'LOGGED_IN_SALT',   'Rf??W&bFjXENq3z`qU-A vvceBA3)nk_wl@OofB,<(<@/R3A5g?/jLhyOVefsD%0' );
define( 'NONCE_SALT',       'x^V<wp,^7%Z>A[}*NveYeELttmF_7T*z>yJ-D$.Rlz06|_fVS%vQ=[k$&-FELPm}' );

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
