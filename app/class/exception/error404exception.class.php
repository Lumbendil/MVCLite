<?php
/**
 * error404exception.class.php
 *
 * File that contains the Exception for the error 404 (Page not found)
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 *
 * @package MVCLite
 */
/**
 * Thrown exception when the page can't be found.
 */
class Error404Exception extends CustomException implements HttpErrorException
{
	public function sendHeader()
	{
		header('HTTP/1.1 404 Not Found');
	}

	public function getController()
	{
		return 'ErrorPageNotFoundController';
	}

	public function getAction()
	{
		return 'show';
	}

	public function getParams()
	{
		return array();
	}
}