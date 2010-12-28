<?php
// TODO: Fix documentation
class PluginManager
{
	/**
	 * This variable contains all the instances wich have been created.
	 *
	 * @var array
	 */
	protected static $instances = array();

	/**
	 * Overriden constructor to avoid instantiation of the class.
	 */
	protected function __construct() {}

	/**
	 * Function that will give an instance of the solicited model.
	 *
	 * @param string $model_name	The name of the wanted model.
	 *
	 * @return Model				The instance of the model.
	 */
	public static function getPlugin( $plugin_name, $params = array() )
	{
		$plugin_name .= 'Plugin';

		if ( !array_key_exists( $plugin_name, self::$instances ) )
		{
			self::$instances[$plugin_name] = new $plugin_name( $params );
		}

		return self::$instances[$plugin_name];
	}
}