<?php
/**
 * Class wich deals with $_GET data.
 *
 * @package GlobalFilters
 */
class FilterGet extends FilterUnsetSource implements Filter
{
	protected function initData()
	{
		$this->data	= $_GET;
		$_GET		= array();
	}
}
