<?php
/**
 * router.class.php
 *
 * Defines the Router class.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 */
/**
 * Routes the URIs to the controllers and actions.
 */
class Router
{
	/**
	 * The controller's name.
	 *
	 * @var string
	 */
	protected $controller	= '';

	/**
	 * The controller's action to be done.
	 *
	 * @var string
	 */
	protected $action		= '';

	/**
	 * The controller's parameters for the given action.
	 *
	 * @var array
	 */
	protected $params		= array();

	/**
	 * The controller routes.
	 *
	 * @var array
	 */
	protected $routes		= array();

	/**
	 * Constructor, wich reads the file routes.ini in CONFIG_PATH, and stores it
	 * in $routes.
	 */
	public function __construct()
	{
		$this->routes = parse_ini_file( CONFIG_PATH . 'routes.ini', true );
	}

	/**
	 * Parses the given URI.
	 *
	 * @param string $uri
	 * @throws Error404Exception Thrown if page has not been found.
	 */
	public function parseUri ( $uri )
	{
		if ( strpos( $uri, '?') !== false )
		{
			$uri = strstr( $uri, '?', true );
		}
		foreach ( $this->routes as $regex => $data )
		{
			if ( preg_match( $regex, $uri, $matches ) )
			{
				array_shift( $matches );

				$this->controller	= $data['controller'];
				$this->action		= $data['action'];
				$this->params		= $matches;
				break;
			}
		}
		if ('' === $this->controller)
		{
			throw new Error404Exception( 'ERROR: Page not found', 1 );
		}
	}

	/**
	 * Gets the controller name.
	 *
	 * @return string
	 */
	public function getController()
	{
		return $this->controller;
	}

	/**
	 * Gets the controller action.
	 *
	 * @return string
	 */
	public function getAction()
	{
		return $this->action;
	}

	/**
	 * Returns an array of parameters.
	 *
	 * @return array
	 */
	public function getParams()
	{
		return $this->params;
	}
}