<?php
/**
 * dispatcher.class.php
 *
 * Defines the Dispatcher class.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 */
/**
 * Class that will be called each time there is a petition to the web, and shows
 * the needed output.
 */
class Dispatcher
{
	/**
	 * Runs the dispatcher, creating the controller, running the action, and then
	 * displaying the result.
	 *
	 * @param Router $router The router to be used by the system.
	 */
	public function run( Router $router )
	{
		try
		{
			$uri = FilterSingletonFactory::getInstance('FilterServer')
								->getText('REQUEST_URI');
			$router->parseUri( $uri );

			$controller_name	= $router->getController();
			$action				= $router->getAction();
			$params				= $router->getParams();

			echo $this->runController( $controller_name, $action, $params )
					->processModules()
					->fetch();
		}
		catch (HttpErrorException $e)
		{
			$e->sendHeader();

			$controller_name	= $e->getController();
			$action				= $e->getAction();
			$params				= $e->getParams();

			echo $this->runController( $controller_name, $action, $params )
					->fetch();
		}
	}

	/**
	 * Function that runs the controller.
	 *
	 * @param string	$controller_name	The name of the controller to be executed.
	 * @param string	$action				The name of the action to be ran.
	 * @param array		$params				The paramethers of the controller.
	 *
	 * @return PageController				The controller after running the action.
	 */
	protected function runController( $controller_name, $action, $params )
	{
		$controller			= ControllerFactory::getController( $controller_name );

		if ( !( $controller instanceof PageController ) )
		{
			throw new Error404Exception('Page not found', 2);
		}

		$controller->run( $action, $params );

		return $controller;
	}
}