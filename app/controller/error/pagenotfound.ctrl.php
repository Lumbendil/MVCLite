<?php
/**
 * pagenotfound.ctrl.php
 *
 * File that contains the ErrorPageNotFoundController.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 */
/**
 * Class that handles the 404 error.
 */
class ErrorPageNotFoundController extends PageController
{
	/**
	 * Action to show the HTML of the 404 error.
	 */
	public function show()
	{
		$this->assign( 'title',	'Error 404: Page not Found' );
		$this->assign( 'data',	'Page not Found' );
	}
}