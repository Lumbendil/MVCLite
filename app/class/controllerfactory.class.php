<?php
/**
 * controllerfactory.class.php
 *
 * File that contains the controller factory class.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 *
 * @package MVCLite
 */
/**
 * Factory that produces controllers.
 */
class ControllerFactory
{
	/**
	 * Overriden constructor to avoid instantiation of the class.
	 */
	protected function __construct() {}

	/**
	 * Given a controller name, gives a controller.
	 *
	 * @param string $controller_name
	 *
	 * @return Controller New instance of $controller_name.
	 */
	public static function getController( $controller_name )
	{
		$controller = new $controller_name;
		if ( $controller instanceof Controller )
		{
			return $controller;
		}

		return NULL;
	}
}