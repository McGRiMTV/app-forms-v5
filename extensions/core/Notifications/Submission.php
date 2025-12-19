<?php

namespace IPS\applicationform\extensions\core\Notifications;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !\defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Notification Options
 */
class _Submission
{

	/**
	 * Get fields for configuration
	 *
	 * @param	\IPS\Member|null	$member		The member (to take out any notification types a given member will never see) or NULL if this is for the ACP
	 * @return	array
	 */
	public static function configurationOptions( \IPS\Member $member = NULL )
	{
		return array(
			'submission'	=> array(
				'type'				=> 'standard',
				'notificationTypes'	=> array( 'submission' ),
				'title'				=> 'notifications__applicationform_Submission',
				'showTitle'			=> FALSE,
				'description'		=> 'notifications__applicationform_Submission_desc',
				'default'			=> array( 'inline', 'email' ),
				'disabled'			=> array()
			)
		);
	}


	/**
	 * Parse notification: key
	 *
	 * @param	\IPS\Notification\Inline	$notification	The notification
	 * @return	array
	 * @code
	 return [
		 'title'		=> "Mark has replied to A Topic",	// The notification title
		 'url'			=> \IPS\Http\Url::internal( ... ),	// The URL the notification should link to
		 'content'		=> "Lorem ipsum dolar sit",			// [Optional] Any appropriate content. Do not format this like an email where the text
		 													// 	 explains what the notification is about - just include any appropriate content.
		 													// 	 For example, if the notification is about a post, set this as the body of the post.
		 'author'		=>  \IPS\Member::load( 1 ),			// [Optional] The user whose photo should be displayed for this notification
	 ];
	 * @endcode
	 */
	public function parse_submission( \IPS\Notification\Inline $notification )
	{
		$submission = $notification->item;
		if ( !$submission )
		{
			throw new \OutOfRangeException;
		}
		return [
			'title'		=> "New submission",	// The notification title
			'url'			=> $submission->modCpUrl(),	// The URL the notification should link to
			'author'		=>  \IPS\Member::load( $submission->member_id ),			// [Optional] The user whose photo should be displayed for this notification
		];
	}
}