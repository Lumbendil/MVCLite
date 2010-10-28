<?php
/**
 * Class wich deals with $_SERVER data.
 *
 * @package GlobalFilters
 */
class FilterServer extends FilterUnsetSource implements Filter
{
	protected function initData()
	{
		$this->data	= $_SERVER;
		$_SERVER	= array();
	}
}
