<?php
/**
 * modulecontroller.class.php
 *
 * File wich contains the ModuleController class.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
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
	public function beforeAction( $action, $params )
	{
		$context = get_class( $this ) . '_' . $action;
		$this->template->setContext( $context );
	}
}