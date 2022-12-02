<?php

/**
 * [BcGoogleLogin] HelperEventListener
 *
 * @link			http://blog.kaburk.com/
 * @author			kaburk
 * @package			BcGoogleLogin
 * @license			MIT
 */
class BcGoogleLoginHelperEventListener extends BcHelperEventListener {

	public $events = [
		'Form.afterEnd',
	];

	private $targetController = ['users'];
	private $targetAction = ['admin_login'];
	private $targetFormId = ['UserLoginForm'];

	public function __construct() {
	}

	/**
	 *
	 */
	public function formAfterEnd(CakeEvent $event) {

		if (!BcUtil::isAdminSystem()) {
			return true;
		}

		$View = $event->subject();

		if (!in_array($View->request->params['controller'], $this->targetController)) {
			return true;
		}

		if (!in_array($View->request->params['action'], $this->targetAction)) {
			return true;
		}

		if (!in_array($event->data['id'], $this->targetFormId)) {
			return true;
		}

		echo $View->element('BcGoogleLogin.admin/login');

		return true;
	}
}
