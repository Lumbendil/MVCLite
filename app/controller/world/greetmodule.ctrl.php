<?php
/**
 * greetmodule.ctrl.php
 *
 * File wich contains the GreetModuleWorldController
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 */
/**
 * Module wich helps greet.
 */
class GreetModuleWorldController extends ModuleController
{
	/**
	 * Example function.
	 */
	protected function hello()
	{
		$this->assign( 'world', 'mundo!' );
	}
}