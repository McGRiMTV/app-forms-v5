<?php
/**
 * @brief		IP Address Lookup extension
 * @author		<a href='https://www.invisioncommunity.com'>Invision Power Services, Inc.</a>
 * @copyright	(c) Invision Power Services, Inc.
 * @license		https://www.invisioncommunity.com/legal/standards/
 * @package		Invision Community
 * @subpackage	Application Forms
 * @since		18 Aug 2019
 */

namespace IPS\applicationform\extensions\core\IpAddresses;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !\defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * IP Address Lookup extension
 */
class _Comment
{

	static $dbTable = 'applicationform_comments';
	static $dbColumn = 'ip_address';
	static $dateColumn = 'start_date';

	/**
	 * Supported in the ACP IP address lookup tool?
	 *
	 * @return	bool
	 * @note	If the method does not exist in an extension, the result is presumed to be TRUE
	 */
	public function supportedInAcp()
	{
		return TRUE;
	}

	/**
	 * Supported in the ModCP IP address lookup tool?
	 *
	 * @return	bool
	 * @note	If the method does not exist in an extension, the result is presumed to be TRUE
	 */
	public function supportedInModCp()
	{
		return TRUE;
	}


	/**
	 * Find Records by IP
	 *
	 * @param	string			$ip			The IP Address
	 * @param	\IPS\Http\Url	$baseUrl	URL table will be displayed on or NULL to return a count
	 * @return	\IPS\Helpers\Table\Db|int|null
	 */
	public function findByIp( $ip, \IPS\Http\Url $baseUrl = NULL )
	{

		/* Return count */
		if ( $baseUrl === NULL )
		{
			return \IPS\Db::i()->select( 'COUNT(*)', static::$dbTable, array( static::$dbColumn . " LIKE ?", $ip ) )->first();
		}

		/* Init Table */
		// Replace database_table_name with the database table
		$table = new \IPS\Helpers\Table\Db( static::$dbTable, $baseUrl, array( static::$dbColumn . " LIKE ?", $ip ) );

		/* Return */
		return (string) $table;
	}

	/**
	 * Find IPs by Member
	 *
	 * @code
	return array(
	'::1' => array(
	'ip'		=> '::1'// string (IP Address)
	'count'		=> ...	// int (number of times this member has used this IP)
	'first'		=> ... 	// int (timestamp of first use)
	'last'		=> ... 	// int (timestamp of most recent use)
	),
	...
	);
	 * @endcode
	 * @param	\IPS\Member	$member	The member
	 * @return	array|NULL
	 */
	public function findByMember( $member )
	{
		return \IPS\Db::i()->select( static::$dbColumn . " AS ip, COUNT(*) AS count, MIN(" . static::$dateColumn . ") AS first, MAX(" . static::$dateColumn . ") AS last", static::$dbTable, array( 'author=?', $member->member_id ), NULL, NULL, static::$dbColumn )->setKeyField( 'ip' );
	}
}