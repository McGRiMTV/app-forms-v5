<?php


namespace IPS\applicationform\modules\admin\forms;

/* To prevent PHP errors (extending class does not exist) revealing path */

use IPS\Helpers\Form\YesNo;

if ( !\defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * settings
 */
class _settings extends \IPS\Dispatcher\Controller
{
	/**
	 * Execute
	 *
	 * @return	void
	 */
	public function execute()
	{
		\IPS\Dispatcher::i()->checkAcpPermission( 'settings_manage' );
		parent::execute();
	}

	/**
	 * ...
	 *
	 * @return	void
	 */
	protected function manage()
	{
		\IPS\Output::i()->title = \IPS\Member::loggedIn()->language()->addToStack('settings');
		$form = new \IPS\Helpers\Form();
		$form->add( new YesNo('appforms_hide_icons', \IPS\Settings::i()->appforms_hide_icons ) );

		if( $values = $form->values() )
		{
			$form->saveAsSettings();
			\IPS\Output::i()->redirect( $this->url );
		}
		\IPS\Output::i()->output = $form;
	}
	
	// Create new methods with the same name as the 'do' parameter which should execute it
}