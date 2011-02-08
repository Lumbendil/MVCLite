<?php
/**
 * internal.ctrl.php
 *
 * File wich contains the ErrorInternalController.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 *
 * @package MVCLite
 */
/**
 * Class that will handle the 500 exception.
 */
class ErrorInternalController extends PageController
{
	/**
	 * Action to show the HTML of the 500 error.
	 */
	public function show()
	{
		$this->assign( 'title',	'Error 500: Internal Server Error' );
		$this->assign( 'data',	'Internal error' );
	}
}