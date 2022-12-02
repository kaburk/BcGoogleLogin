<?php
/**
 * [BcGoogleLoginConfig] BcGoogleLogin model
 *
 * @link			http://blog.kaburk.com/
 * @author			kaburk
 * @package			BcGoogleLogin
 * @license			MIT
 */
class BcGoogleLoginConfig extends AppModel {

	public $name = 'BcGoogleLoginConfig';

	public $actsAs = [
	];

	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);

		$this->validate = [
			'client_id' => [
				[
					'rule' => [
						'notBlank',
					],
					'message' => __d('baser', 'クライアントIDを入力してください。'),
					'required' => true,
				],
			],
			'client_secret' => [
				[
					'rule' => [
						'notBlank',
					],
					'message' => __d('baser', 'クライアントシークレットを入力してください。'),
					'required' => true,
				],
			],
		];
	}

}
