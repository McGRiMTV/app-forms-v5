<?php
 
namespace IPS\applicationform;

/**
 * Application Form Application Class
 */
class _Application extends \IPS\Application
{
	protected $fostersData = [
		'ips.file' => 'https://invisioncommunity.com/files/file/8394-application-forms/',
		'ips.topic' => 'https://invisionpower.com/forums/topic/434014-application-forms-supporttopic/',
		'github.repo' => 'https://github.com/Fosters-IPS/applicationform'
	];

	public function get__icon()
	{
		return 'id-card';
	}

	public static function fireEvent( $event, &...$args )
	{
		\IPS\Api\Webhook::fire( $event, $args['0'] );
	}
}