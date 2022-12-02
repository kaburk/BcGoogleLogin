<?php
/**
 * [BcGoogleLogin] setting
 *
 * @link			http://blog.kaburk.com/
 * @author			kaburk
 * @package			BcGoogleLogin
 * @license			MIT
 */

 /**
 * システムナビ
 */
$config['BcApp.adminNavigation'] = [
	'Plugins' => [
		'menus' => [
			'BcGoogleLoginConfig' => [
				'title' => 'Googleログイン設定',
				'url' => [
					'admin' => true,
					'plugin' => 'bc_google_login',
					'controller' => 'bc_google_logins',
					'action' => 'config',
				],
			],
		],
	],
];

/**
 * Googlewログイン API エンドポイント
 */
// ユーザーに認証と認可を要求する
define('GOOGLE_EP_AUTHORIZE', 'https://accounts.google.com/o/oauth2/v2/auth');

// アクセストークンを発行する
define('GOOGLE_EP_TOKEN', 'https://oauth2.googleapis.com/token');
