<?php
/**
 * Class wich deals with session usage.
 *
 * @package MVCLite
 * @subpackage Filters
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

	/**
	 * Restarts the session.
	 *
	 * @param $keys_to_save	Array of keys that should be saved after session restart.
	 */
	public function restart( $keys_to_save )
	{
		$data_to_save = array();

		foreach( $keys_to_save as $key )
		{
			$obtained_data = $this->getData( $key );

			if ( NULL !== $obtained_data )
			{
				$data_to_save[$key] = $obtained_data;
			}
		}

		session_destroy();
		session_start();

		foreach( $data_to_save as $key => $value )
		{
			$this->storeData( $key, $value );
		}
	}
}
