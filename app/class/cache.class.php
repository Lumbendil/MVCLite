<?php
/**
 * cache.class.php
 *
 * File that contains the cache class.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 *
 * @package MVCLite
 */
/**
 * Class that handles the caching of data.
 */

if ( CACHE_ENABLED )
{
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
}
else
{
	// TODO: Arreglar apaños
	class Cache
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

		public function __call($method, $args)
		{
			return false;
		}

		public static function __callstatic($method, $args)
		{
			return false;
		}
	}
}