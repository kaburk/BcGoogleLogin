<?php
/**
 * [BcGoogleLogin] Controller
 *
 * @link			http://blog.kaburk.com/
 * @author			kaburk
 * @package			BcGoogleLogin
 * @license			MIT
 */
class BcGoogleLoginsController extends AppController {

	public $uses = [
		'BcGoogleLogin.BcGoogleLoginConfig',
	];

	public $components = [
		'BcAuth',
		'Cookie',
		'BcAuthConfigure',
		'BcMessage',
	];

	private $siteUrl;
	private $siteUrlCallback;

	public function beforeFilter() {
		parent::beforeFilter();

		// 認証設定
		$this->BcAuth->allow(
			'admin_login', 'admin_callback'
		);

		// ログイン時のコールバックURL
		$this->siteUrl = Configure::read('BcEnv.sslUrl');
		if (empty($this->siteUrl)) {
			$this->siteUrl = Configure::read('BcEnv.siteUrl');
		}
		$this->siteUrl = rtrim($this->siteUrl, '/');

		$this->siteUrlCallback =
			$this->siteUrl .
			Router::url([
				'admin' => true,
				'plugin' => 'bc_google_login',
				'controller' => 'bc_google_logins',
				'action' => 'callback',
			]);
	}

	/**
	 * [ADMIN] 設定画面
	 */
	public function admin_config() {

		if (!$this->request->data) {
			$this->request->data['BcGoogleLoginConfig'] = $this->BcGoogleLoginConfig->findExpanded();
		} else {
			$this->BcGoogleLoginConfig->set($this->request->data);
			if (!$this->BcGoogleLoginConfig->validates()) {
				$this->BcMessage->setError(__d('baser', '入力エラーです。内容を修正してください。'));
			} else {
				$this->BcGoogleLoginConfig->saveKeyValue($this->request->data);
				clearCache();
				$this->BcMessage->setSuccess(__d('baser', 'Googleログイン設定を保存しました。'));
				$this->redirect('config');
			}
		}

		$this->pageTitle = '各種設定';
		$this->set('siteUrl', $this->siteUrl);
		$this->set('siteUrlCallback', $this->siteUrlCallback);
	}

	/**
	 * ログイン処理
	 */
	public function admin_login() {

		$this->autoRender = false;

		$state = rand();
		$nonce = hash('sha512', openssl_random_pseudo_bytes(128));
		$bcGoogleLoginConfig = $this->BcGoogleLoginConfig->findExpanded();

		$url = GOOGLE_EP_AUTHORIZE . '?' . http_build_query([
			'response_type' => 'code',
			'client_id'     => $bcGoogleLoginConfig['client_id'],
			'redirect_uri'  => $this->siteUrlCallback,
			'state'         => $state,
			'nonce'         => $nonce,
			'scope'         => 'openid email profile',
		]);

		$this->redirect($url);
	}

	/**
	 *
	 */
	public function admin_callback() {

		require_once __DIR__ . '/../vendor/autoload.php';

		$this->autoRender = false;

		// 各種設定を読込
		$bcGoogleLoginConfig = $this->BcGoogleLoginConfig->findExpanded();

		// POSTするデータ
		$postData = [
			'grant_type' => 'authorization_code',
			'code' => h($_GET['code']),
			'redirect_uri' => $this->siteUrlCallback,
			'client_id' => $bcGoogleLoginConfig['client_id'],
			'client_secret' => $bcGoogleLoginConfig['client_secret'],
		];
		// 実際にGoogleへPOST
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
		curl_setopt($ch, CURLOPT_URL, GOOGLE_EP_TOKEN);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);

		// JSONオブジェクトをデコード
		$json = json_decode($response);

		// IDトークンを取得
		$id_token = $json->id_token;

		// ## レスポンス ##
		// access_token  // アクセストークン。
		// expires_in    // アクセストークンの有効期限が切れるまでの秒数
		// id_token      // ユーザー情報を含むJSONウェブトークン（JWT）
		// scope         // ユーザーが付与する権限
		// token_type    // Bearer


		/**
		 * IDトークンからプロフィール情報を取得する
		 */
		$client = new Google_Client(['client_id' => $bcGoogleLoginConfig['client_id']]);
		$payload = $client->verifyIdToken($id_token);
		$email = $payload['email']; // emailを取得
		$userid = $payload['sub']; // ユーザー識別子

		// ## レスポンス ##
		// iss            // IDトークンの生成URL
		// azp            //
		// sub            // ユーザー識別子
		// aud            // チャネルID
		// email          // ユーザーのメールアドレス
		// email_verified //
		// at_hash        //
		// nonce          //
		// name           // ユーザーの表示名
		// picture        // ユーザープロフィールの画像URL
		// given_name     // 名
		// family_name    // 性
		// locale         //
		// iat            // IDトークンの生成時間（UNIXタイム）
		// exp            // IDトークンの有効期限（UNIXタイム）


		// メールアドレスからログインアカウントを検索してログイン状態にする
		if (!empty($email)) {
			$result = $this->User->find(
				'first',
				[
					'conditions' => [
						'User.email' => $email,
					],
					'recursive' => 0
				]
			);
			if ($result) {
				$user = $result['User'];
				unset($user['password'], $result['User']);
				$user = array_merge($user, $result);
				$this->BcAuth->login($user);
				$this->redirect( '/' . Configure::read('Routing.prefixes.0'));
			}
		}

		// ログインできない場合はログイン画面へ
		$this->BcMessage->setError(__d('baser', 'アカウントが正しくありません。'));
		$this->redirect(['admin' => true, 'plugin' => false, 'controller' => 'users', 'action' => 'login']);

	}
}
