<?php
/**
 * Extension of filter wich adds methods needed by the filters wich deal with
 * persistent data.
 *
 * @package GlobalFilters
 */
interface FilterPersistentData extends Filter
{
	/**
	 * Stores the data in $data on the $key position.
	 *
	 * @param string	$key	The key on wich the data should be stored.
	 * @param mixed		$data	The data to be stored.
	 *
	 * @return boolean			Returns true on success, and false on failure.
	 */
	public function storeData( $key, $data );

	/**
	 * Removes the specified key.
	 * @param string	$key	The key to be removed.
	 */
	public function removeData( $key );
}
