<?php
/**
 * cache.class.php
 *
 * File that contains the cache class.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 */
/**
 * Class that handles the caching of data.
 */
class Cache extends Memcache
{
	/**
	 * Singleton instance of the cache.
	 *
	 * @var Cache
	 */
	protected static $instance = NULL;

	/**
	 * Protected constructor, that connects to the memcached server.
	 */
	protected function __construct()
	{
		$this->connect( MEMCACHED_HOST, MEMCACHED_PORT );
	}

	/**
	 * Gets the instance of the Cache object.
	 */
	public static function getInstance()
	{
		if ( NULL === self::$instance )
		{
			self::$instance = new Cache;
		}
		return self::$instance;
	}
}