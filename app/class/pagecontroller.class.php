<?php
/**
 * pagecontroller.class.php
 *
 * File that contains the PageController class.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 *
 * @package MVCLite
 */
/**
 * Class that is extended by all controllers that create full pages.
 */
abstract class PageController extends Controller
{
	/**
	 * All the modules wich will be used.
	 *
	 * @var array
	 */
	protected $modules = array();

	protected function redirect ( $url, $http_code = NULL )
	{
		header( 'Location: ' . $url );

		$this->setPreviousUri();

		exit();
	}

	/**
	 * Makes the parent controller use a module.
	 *
	 * @param string $controller_name
	 * @param string $action_name
	 * @param string $params
	 */
	protected function addModule( $controller_name, $action_name, $params = array() )
	{
		$this->modules[] = array(
			'controller'	=> $controller_name
			, 'action'		=> $action_name
			, 'params'		=> $params
		);
	}

	protected function afterAction( $action, $params )
	{
		parent::afterAction( $action, $params );

		$this->setPreviousUri();
	}

	protected function setPreviousUri()
	{
		FilterSingletonFactory::getInstance( 'FilterSession' )->storeData( 'prev_page'
			, FilterSingletonFactory::getInstance( 'FilterServer' )->getText( 'REQUEST_URI' ) );
	}

	/**
	 * Processes all the modules wich arent disabled.
	 */
	public function processModules()
	{
		$previous_context = $this->template->getCurrentContext();

		$disabled_modules = file( CONFIG_PATH . 'disabled_modules.list' );

		for ( $i = 0, $end = count( $this->modules ) ; $i < $end; $i++ )
		{
			$module = $this->modules[$i];

			if ( !in_array( $module['controller'], $disabled_modules) )
			{
				$module_controller	= ControllerFactory::getController( $module['controller'] );

				$module_controller->run( $module['action'], $module['params'] );
			}
		}

		$this->template->setContext( $previous_context );

		return $this;
	}
}