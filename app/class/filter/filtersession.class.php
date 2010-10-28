<?php
/**
 * Class wich deals with session usage.
 *
 * @package GlobalFilters
 */
class FilterSession extends AbstractFilter implements FilterPersistentData
{
	/**
	 * Starts the session.
	 */
	public function __construct()
	{
		session_start();
	}

	public function storeData( $key, $data )
	{
		$_SESSION[$key] = $data;
		return true;
	}

	protected function getData( $key )
	{
		return array_key_exists( $key, $_SESSION ) ? $_SESSION[$key] : NULL;
	}

	public function removeData( $key )
	{
		if ( array_key_exists( $key, $_SESSION ) )
		{
			unset( $_SESSION[$key] );
			return true;
		}
		return false;
	}
}
