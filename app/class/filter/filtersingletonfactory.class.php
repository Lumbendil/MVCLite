<?php
class FilterSingletonFactory
{
	protected static $instances = array();

	protected function __construct() {}

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