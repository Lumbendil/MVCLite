<?php
/**
 * Class wich deals with cookie usage.
 *
 * @package MVCLite
 * @subpackage Filters
 */
class FilterCookie extends AbstractFilter implements FilterPersistentData
{
	/**
	 * The expiration time of the cookie.
	 * @var int
	 */
	protected $expire_time = NULL;

	/**
	 * The cookie path.
	 * @var string
	 */
	protected $cookie_path = NULL;

	/**
	 * The cookie domain.
	 * @var string
	 */
	protected $cookie_domain = NULL;

	protected function getData( $key )
	{
		return array_key_exists( $key, $_COOKIE ) ? $_COOKIE[$key] : NULL;
	}

	/**
	 * Uses only parameters (expiration time, path and domain) if set with the
	 * setters. It can only use path and domain if expiration time has been set,
	 * and domain if both expiration time and path are set.
	 *
	 * @see FilterPersistentData::storeData()
	 */
	public function storeData( $key, $data )
	{
		if ( NULL == $this->expire_time )
		{
			return setcookie( $key, $data);
		}
		if ( NULL === $this->cookie_path )
		{
			return setcookie( $key, $data, time() + $this->expire_time );
		}
		if ( NULL === $this->cookie_domain )
		{
			return setcookie( $key, $data, time() + $this->expire_time, $this->cookie_path );
		}
		return setcookie( $key, $data, time() + $this->expire_time, $this->cookie_path, $this->cookie_domain );
	}

	/**
	 * Removes the data from the cookie by setting it's time to 25 hours in the
	 * past.
	 *
	 * @see src/FilterPersistentData::removeData()
	 */
	public function removeData( $key )
	{
		return setcookie( $key, NULL, time() - 90000);
	}

	/**
	 * Sets the expiration time of the cookie (in seconds).
	 *
	 * @param int	$new_time	The new time. It has to be positive. If you want
	 * 	to remove the time, set it to NULL.
	 */
	public function setExpireTime ( $new_time )
	{
		$new_time = (int) $new_time;

		if ( 0 < $new_time || NULL === $new_time )
		{
			$this->expire_time = $new_time;
		}
	}

	/**
	 * Sets the path on wich the cookie works.
	 *
	 * @param string	$new_path	The new path.
	 */
	public function setCookiePath ( $new_path )
	{
		$this->cookie_path = (string) $new_path;
	}

	/**
	 * Sets the domain on wich the cookie works.
	 *
	 * @param string	$new_domain	The new domain.
	 */
	public function setCookieDomain ( $new_domain )
	{
		$this->cookie_domain = (string) $new_domain;
	}
}
