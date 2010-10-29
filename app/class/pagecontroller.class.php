<?php
/**
 * pagecontroller.class.php
 *
 * File that contains the PageController class.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 */
/**
 * Class that is extended by all controllers that create full pages.
 */
abstract class PageController extends Controller
{
	// TODO: Documment the class.
	protected $modules = array();

	protected function addModule( $controller_name, $action_name, $params )
	{
		$this->modules[] = array(
			'controller'	=> $controller_name
			, 'action'		=> $action_name
			, 'params'		=> $params
		);
	}

	protected function getModules()
	{
		return $this->modules;
	}

	public function processModules()
	{
		$modules = $this->getModules();

		$disabled_modules = file( CONFIG_PATH . 'disabled_modules.list' );

		for ( $i = 0, $end = count( $modules ) ; $i < $end; $i++ )
		{
			$module				= $modules[$i];

			if ( !in_array( $module['controller'], $disabled_modules) )
			{
				$module_controller	= ControllerFactory::getController( $module['controller'] );

				$module_controller->run( $module['action'], $module['params'] );
			}
		}
	}
}