<?php
/**
 * httperrorexception.interface.php
 *
 * File that contains the interfice of HTTP errors.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 *
 * @package MVCLite
 */
/**
 * Interface to be implemented by all the classes wich give HTTP errors.
 */
interface HttpErrorException
{
	/**
	 * Function that sends the header of the error of the given exception.
	 */
	public function sendHeader();

	/**
	 * Function that returns the controller name wich handles the current error.
	 *
	 * @return string
	 */
	public function getController();

	/**
	 * Function that returns the action of the controller wich handles the current
	 * 	error.
	 *
	 * @return string
	 */
	public function getAction();

	/**
	 * Function that returns there parameters that are going to be used by the action's
	 * 	controller.
	 */
	public function getParams();
}