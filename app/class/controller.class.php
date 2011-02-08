<?php
/**
 * controller.class.php
 *
 * File wich contains the abstract class Controller.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 *
 * @package MVCLite
 */
/**
 * Class to be extended by all controllers wich contains common methods and
 * properties.
 */
abstract class Controller
{
	/**
	 * The template object.
	 *
	 * @var Template
	 */
	protected $template			= NULL;

	/**
	 * The file wich contains the template to be used.
	 *
	 * @var string
	 */
	protected $template_file	= '';

	/**
	 * The folder wich contains the template to be used.
	 *
	 * @var string
	 */
	protected $template_folder	= '';

	/**
	 * The cache object.
	 *
	 * @var Cache
	 */
	protected $cache			= NULL;

	/**
	 * Array of required plugins. They're stored in the following way.
	 * array( action1 => array( plugin1, plugin2 ), action2 => array( plugin3 ) )
	 *
	 * @var array
	 */
	protected $plugins			= array();

	/**
	 * Constructor that creates the template and gets it's name.
	 */
	public function __construct()
	{
		$this->cache			= Cache::getInstance();

		$this->template			= Template::getInstance();

		$class_name				= get_class( $this );

		$this->template_folder	= preg_replace( CONTROLLER_REGEX, '$1/$2/' , $class_name );

		$this->template_folder	= strtolower( $this->template_folder );
	}

	/**
	 * Function wich loads the plugins required for the action.
	 *
	 * @param string $action
	 */
	protected function loadPlugins( $action )
	{
		$loaded_plugins		= array();
		$plugins_to_load	= array_key_exists( $action, $this->plugins ) ?
			$this->plugins[$action] : array();

		foreach ( $plugins_to_load as $key => $value )
		{
			if ( is_int( $key ) )
			{
				$plugin	= PluginManager::getPlugin( $value );

				$key	= $value;
			}
			else
			{
				$plugin = PluginManager::getPlugin( $key, $value );
			}

			if ( NULL !== $plugin )
			{
				$loaded_plugins[$key] = $plugin;
			}
		}

		$this->plugins = $loaded_plugins;
	}

	/**
	 * In an action, function used to set the template to a new one, wich is in the
	 * same folder as all the actions asociated to the given model, but named as
	 * {$new_name}{TEMPLATE_EXTENSION}.
	 *
	 * @param string $new_name
	 */
	protected function newTemplateName( $new_name )
	{
		$this->template_file = $new_name . TEMPLATE_EXTENSION;
	}

	/**
	 * Common instructions to be called before executing the action.
	 *
	 * @param string	$action Action of the controller that will be called.
	 * @param array		$params Indexed array of parameters to be given to the
	 * 	action that will be called.
	 */
	protected function beforeAction( $action, $params )
	{
		$this->loadPlugins( $action );
	}

	/**
	 * Common instructions to be called after executing the action.
	 *
	 * @param string	$action Action of the controller that will be called.
	 * @param array		$params Indexed array of parameters to be given to the
	 * 	action that will be called.
	 */
	protected function afterAction( $action, $params )
	{
		$this->template->setTemplate( $this->template_folder .  $this->template_file );
	}

	/**
	 * Runs the controller with $action and the given params.
	 *
	 * @param string		$action Action of the controller to be called.
	 * @param array			$params Indexed array of parameters to be given to the
	 * 	called action.
	 *
	 * @return Controller	The own class.
	 */
	public function run( $action, $params )
	{
		$this->template_file .= $action . TEMPLATE_EXTENSION;

		$this->beforeAction( $action, $params );

		call_user_func_array( array( $this, $action ), $params );

		$this->afterAction( $action, $params );

		return $this;
	}

	/**
	 * Calls a model to get data.
	 *
	 * @param string	$model_name	The model from wich to get the data.
	 * @param string	$function	The function of the model that gives the data.
	 * @param array		$params		Indexed array of parameters to be given to the
	 * called function
	 *
	 * @return mixed				The data that returns the called function.
	 */
	protected function getData( $model_name, $function, $params )
	{
		$model = ModelSingletonFactory::getModel( $model_name . 'Model' );

		return call_user_func_array( array( $model, $function ), $params );
	}

	/**
	 * Calls the fetch function of the template.
	 */
	public function fetch()
	{
		return $this->template->getContextData();
	}

	/**
	 * Calls the assign function of the template.
	 *
	 * @param string	$key
	 * @param data		$data
	 */
	protected function assign( $key, $data )
	{
		$this->template->assign( $key, $data );
	}

	/**
	 * Throws an HTTP exception, wich will trigger the error.
	 *
	 * @param int		$code		The error code.
	 * @param string	$message	The exception message.
	 *
	 * @throws HttpErrorException
	 */
	protected function error( $code, $message )
	{
		switch( $code )
		{
			case 404:
				throw new Error404Exception( $message );
				break;
		}
	}
}