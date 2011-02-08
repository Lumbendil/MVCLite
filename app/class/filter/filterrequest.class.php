<?php
/**
 * Class wich deals with $_REQUEST data.
 *
 * @package MVCLite
 * @subpackage Filters
 */
class FilterRequest extends FilterUnsetSource implements Filter
{
	/**
	 * Destroys $_REQUEST without storing it's data.
	 */
	protected function initData()
	{
		$_REQUEST = array();
	}
}
