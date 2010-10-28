<?php
/**
 * autoload.php
 *
 * File that contains the __autoload function, wich is called every time that
 * there is a call to a class wich isn't known by the application.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 */

/**
 * Autoload magic function definition.
 *
 * @param string $classname Name of the class that isn't known.
 */
function __autoload( $classname )
{
	$matches	= array();
	$path		= '';

	if ( preg_match( CONTROLLER_REGEX, $classname, $matches ) )
	{
		$path = CTRL_PATH . strtolower( $matches[2] ) . '/';
		$path .= strtolower( $matches[1] ) . '.ctrl.php';
	}
	elseif ( preg_match( MODEL_REGEX, $classname, $matches ) )
	{
		$path = MODEL_PATH . strtolower( $matches[1] ) . '.model.php';
	}
	if ( !file_exists( $path ) )
	{
		$folder = '';

		if ( false !== stripos( $classname, 'filter' ) )
		{
			$folder = 'filter/';
		}
		elseif ( false !== stripos( $classname, 'exception' ) )
		{
			$folder = 'exception/';
		}

		$path = CLASS_PATH . $folder . strtolower( $classname ) . '.class.php';

		if ( !file_exists( $path ) )
		{
			$path = CLASS_PATH . $folder . strtolower( $classname ) . '.interface.php';
		}
	}

	require_once $path;
}