<?php
/**
 * @brief		Application Form Action extension
 * @since		12 Feb 2021
 */

namespace IPS\applicationform\extensions\applicationform\ApplicationAction;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !\defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Action extension
 */
class _Webhook  extends \IPS\applicationform\Position\Extension
{

	public static function onSubmit( \IPS\applicationform\Position $position, array &$values, \IPS\Member $member = NULL )
	{
		$member = $member ? : \IPS\Member::loggedIn();

		$dataToSend = [
			'position' => $position->apiOutput(),
			'data' => $values,
			'member' => $member->apiOutput(),
		];
		\IPS\Api\Webhook::fire( 'applicationform_submission_submit', $dataToSend );
	}


	public static function onApproval( \IPS\applicationform\Position\Data $data, \IPS\Member $approver = NULL )
	{
		\IPS\Api\Webhook::fire( 'applicationform_submission_approved', $data );
	}

	public static function onDeny( \IPS\applicationform\Position\Data $data, \IPS\Member $approver = NULL )
	{
		\IPS\Api\Webhook::fire( 'applicationform_submission_denied', $data );
	}

	public static function onFormDelete( \IPS\applicationform\Position $position )
	{

	}

	public static function onSubmissionDelete( \IPS\applicationform\Position\Data $data )
	{

	}

	public static function form( \IPS\Helpers\Form &$form, \IPS\applicationform\Position $position )
	{

	}

	public static function createFromForm( array &$values, \IPS\applicationform\Position $position )
	{

	}
}