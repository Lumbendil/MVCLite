<?php
/**
 * Class wich deals with $_GET data.
 *
 * @package MVCLite
 * @subpackage Filters
 */
class FilterGet extends FilterUnsetSource implements Filter
{
	protected function initData()
	{
		$this->data	= $_GET;
		$_GET		= array();
	}
}
