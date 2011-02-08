<?php
/**
 * autoload.php
 *
 * File that contains the Autoloader class, that adds several functions to the
 * autoload system of php.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 *
 * @package MVCLite
 */
/**
 * Class wich, when started, sets all the autoloaders.
 */
class Autoloader
{
	/**
	 * The instance of the object.
	 *
	 * @var Autoloader
	 */
	protected static $instance = NULL;

	/**
	 * Constructor, wich adds the other functions to the autoloader.
	 */
	protected function __construct()
	{
		spl_autoload_register( array( $this, 'requireClassFolder' ) );
		spl_autoload_register( array( $this, 'requireController' ) );
		spl_autoload_register( array( $this, 'requireModel' ) );
		spl_autoload_register( array( $this, 'requirePlugin' ) );
	}

	/**
	 * Public function wich, when there is no instance, starts it.
	 *
	 * @return Autoloader	The instance created. Otherwise, it returns the previously
	 * 	generated instance.
	 */
	public static function startInstance()
	{
		if ( NULL === self::$instance )
		{
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Function wich, if the entry is a plugin, loads it.
	 *
	 * @param string $plugin
	 */
	public function requirePlugin( $plugin )
	{
		$path = preg_replace( PLUGIN_REGEX, PLUGIN_PATH . '$1.plugin.php', $plugin );

		if ( $path === $plugin )
		{
			return false;
		}

		$path = strtolower( $path );

		if ( file_exists( $path ) )
		{
			require $path;
			return true;
		}
		return false;

	}

	/**
	 * Function wich, if the entry is a controller, loads it.
	 *
	 * @param string $controller
	 */
	public function requireController( $controller )
	{
		$path = preg_replace( CONTROLLER_REGEX, CTRL_PATH . '$1/$2.ctrl.php', $controller );

		if ( $path === $controller )
		{
			return false;
		}

		$path = strtolower( $path );

		if ( file_exists( $path ) )
		{
			require $path;
			return true;
		}
		return false;
	}

	/**
	 * Function wich, if the entry is a model, loads it.
	 *
	 * @param string $model
	 */
	public function requireModel( $model )
	{
		$path = preg_replace( MODEL_REGEX, MODEL_PATH . '$1.model.php', $model );

		if ( $path === $model )
		{
			return false;
		}

		$path = strtolower( $path );

		if ( file_exists( $path ) )
		{
			require $path;
			return true;
		}
		return false;
	}

	/**
	 * Function wich, if the entry is a file in the class folder, loads it.
	 *
	 * @param string $classname
	 */
	public function requireClassFolder( $classname )
	{
		$path = CLASS_PATH;

		if ( false !== stripos( $classname, 'filter' ) )
		{
			$path .= 'filter/';
		}
		elseif ( false !== stripos( $classname, 'exception' ) )
		{
			$path .= 'exception/';
		}

		$path .= strtolower( $classname );

		$path_class = $path . '.class.php';

		if ( file_exists( $path_class ) )
		{
			require $path_class;
			return true;
		}

		$path_interface = $path . '.interface.php';

		if ( file_exists( $path_interface ) )
		{
			require $path_interface;
			return true;
		}
		return false;
	}
}
