<?php
/**
 * controller.class.php
 *
 * File wich contains the abstract class Controller.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
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
	 * Constructor that creates the template and gets it's name.
	 *
	 * @throws Error404Exception Exception thrown when the class name isn't as
	 * expected.
	 */
	public function __construct()
	{
		$this->template	= Template::getInstance();

		$class_name		= get_class( $this );

		if ( preg_match( CONTROLLER_REGEX, $class_name, $matches ) )
		{
			$this->template_file = TEMPLATE_PATH . strtolower( $matches[2] ) . '/';
			$this->template_file .= strtolower( $matches[1] ) . '/';
		}
		else
		{
			throw new Error404Exception;
		}
	}

	/**
	 * In an action, function used to set the template to a new one, wich is in the
	 * same folder as all the actions asociated to the given model, but named as
	 * {action}{$extra}{TEMPLATE_EXTENSION}.
	 *
	 * @param string $extra
	 */
	protected function addExtraToTemplatePath( $extra )
	{
		$this->template_file = substr( $this->template_file, 0, - strlen( TEMPLATE_EXTENSION ) );
		$this->template_file .= $extra . TEMPLATE_EXTENSION;
	}

	/**
	 * Common instructions to be called before executing the action.
	 *
	 * @param string	$action Action of the controller that will be called.
	 * @param array		$params Indexed array of parameters to be given to the
	 * 	action that will be called.
	 */
	protected function beforeAction( $action, $params ) {}

	/**
	 * Common instructions to be called after executing the action.
	 *
	 * @param string	$action Action of the controller that will be called.
	 * @param array		$params Indexed array of parameters to be given to the
	 * 	action that will be called.
	 */
	protected function afterAction( $action, $params )
	{
		$this->template->setTemplate( $this->template_file );
	}

	/**
	 * Runs the controller with $action and the given params.
	 *
	 * @param string	$action Action of the controller to be called.
	 * @param array		$params Indexed array of parameters to be given to the
	 * 	called action.
	 */
	public function run( $action, $params )
	{
		$this->template_file .= $action . TEMPLATE_EXTENSION;

		$this->beforeAction( $action, $params );

		call_user_func_array( array( $this, $action ), $params );

		$this->afterAction( $action, $params );
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
		$model = ModelSingletonFactory::getModel( $model_name );

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
}