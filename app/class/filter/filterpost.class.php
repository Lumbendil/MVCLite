<?php
/**
 * Class wich deals with $_POST data.
 *
 * @package MVCLite
 * @subpackage Filters
 */
class FilterPost extends FilterUnsetSource implements Filter
{
	protected function initData()
	{
		$this->data	= $_POST;
		$_POST		= array();
	}
}
