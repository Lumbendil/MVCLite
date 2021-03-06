<?php
/**
 * modulecontroller.class.php
 *
 * File wich contains the ModuleController class.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 *
 * @package MVCLite
 */
/**
 * Class to be extended by all the modules.
 */
abstract class ModuleController extends Controller
{
	/**
	 * Sets the context to the required one.
	 *
	 * @see Controller::beforeAction()
	 */
	protected function beforeAction( $action, $params )
	{
		parent::beforeAction( $action, $params );
		$context = get_class( $this ) . '::' . $action;
		$this->template->setContext( $context );
	}
}