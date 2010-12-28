<?php
/**
 * error500exception.class.php
 *
 * File that contains the Exception for the error 500 (Server Error)
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 */
/**
 * Thrown exception when there is an error with the server.
 */
class Error500Exception extends CustomException implements HttpErrorException
{
	public function sendHeader()
	{
		header('HTTP/1.1 500 Server Error');
	}

	public function getController()
	{
		return 'ErrorInternalController';
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