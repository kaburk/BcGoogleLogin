<p><?php
	echo $this->BcBaser->link(
		'Googleアカウントでログイン',
		[
			'admin' => true,
			'plugin' => 'bc_google_login',
			'controller' => 'bc_google_logins',
			'action' => 'login',
		],
		[
			'class' => 'bca-btn--login bca-btn',
			'data-bca-btn-type' => 'login',
		]
	);
?></p>
