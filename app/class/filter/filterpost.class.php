<?php
/**
 * Class wich deals with $_POST data.
 *
 * @package GlobalFilters
 */
class FilterPost extends FilterUnsetSource implements Filter
{
	protected function initData()
	{
		$this->data	= $_POST;
		$_POST		= array();
	}
}
