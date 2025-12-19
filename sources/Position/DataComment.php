<?php
/**
 * @brief DataComment Content Comment Class
 * @copyright -storm_copyright-
 * @package IPS Social Suite
 * @subpackage applicationform
 * @since -storm_since_version-
 * @version -storm_version-
 */


namespace IPS\applicationform\Position;

if (!defined('\IPS\SUITE_UNIQUE_KEY')) {
    header(($_SERVER[ 'SERVER_PROTOCOL' ] ?? 'HTTP/1.0') . ' 403 Forbidden');
    exit;
}

use IPS\Content\Comment;
use function defined;
use function header;

/**
 * DataComment Class
 *
 * @mixin \IPS\applicationform\Position\DataComment
 */
class _DataComment extends Comment
{

    /**
     * @brief [ActiveRecord] Multiton Store
     * @var array
     */
    protected static $multitons = array();

    /**
     * @brief [ActiveRecord] Database table
     * @var string
     */
    public static $databaseTable = 'applicationform_comments';

    public static $itemClass =Data::class;

    /**
     * @brief Bitwise Keys
     * @var string
     */
    protected static $bitOptions = [
        'bitwise' => [
            'bitwise' => [
                
            ],
        ],
    ];

    /**
     * @brief Application
     * @var string
     */
    public static $application = 'applicationform';

    /**
     * @brief Module
     * @var string
     */
    public static $module = 'applicationform';

    /**
     * @brief Title
     * @var string
     */
    public static $title = 'applicationform_datacomment_comments';

    /**
     * @brief Database Column Map
     * @var array
     */
    public static $databaseColumnMap = array(
        'item' => 'item_id',
        'author' => 'author',
        'author_name' => 'author_name',
        'content' => 'content',
        'date' => 'start_date',
        'ip_address' => 'ip_address',
    );

	/**
	 * Get URL for doing stuff
	 *
	 * @param	string|NULL		$action		Action
	 * @return	\IPS\Http\Url
	 */
	public function url( ?string $action='find' ) : \IPS\Http\Url
	{
		$url = parent::url( $action );
		$idColumn = static::$databaseColumnId;

		if ( isset( $url->queryString['do'] ) )
		{
			return $url->stripQueryString( 'do' )->setQueryString( array( 'action' => $url->queryString['do'], 'comment' => $this->$idColumn ) );
		}
		return $url;
	}


}

