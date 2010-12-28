<?php
/**
 * filtersingletonfactory.class.php
 *
 * File that contains the singleton factory of filters.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 */
class FilterSingletonFactory
{
	/**
	 * Instances of the filters.
	 *
	 * @var array
	 */
	protected static $instances = array();

	/**
	 * Overriden constructor to avoid instantiation of this class.
	 */
	protected function __construct() {}

	/**
	 * Returns an instance of Filter.
	 *
	 * @param string $filter_name	The filter class.
	 *
	 * @return Filter
	 */
	public static function getInstance( $filter_name )
	{
		if ( !array_key_exists( $filter_name, self::$instances ) )
		{
			$filter = new $filter_name;

			if ( !( $filter instanceof Filter ) )
			{
				return NULL;
			}

			self::$instances[$filter_name] = $filter;
		}
		return self::$instances[$filter_name];
	}
}