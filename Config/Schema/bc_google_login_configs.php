<?php
/**
 * [BcGoogleLogin] CakeSchema
 *
 * @link			http://blog.kaburk.com/
 * @author			kaburk
 * @package			BcGoogleLogin
 * @license			MIT
 */
class BcGoogleLoginConfigsSchema extends CakeSchema {

	public $name = 'BcGoogleLoginConfigs';
	public $file = 'bc_google_login_configs.php';
	public $connection = 'plugin';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {

	}

	public $bc_google_login_configs = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null),
		'value' => array('type' => 'text', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
	);

}
