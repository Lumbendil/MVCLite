<?php
/**
 * Abstract class wich implements the function getData for the classes wich use
 * data where the source can be unset (it's better to unset it so it can't be
 * accessed directly).
 *
 * @package MVCLite
 * @subpackage Filters
 */
abstract class FilterUnsetSource extends AbstractFilter implements Filter
{
	/**
	 * Array wich stores the data of the filter.
	 *
	 * @var array
	 */
	protected $data = array();

	/**
	 * Constructs this class, using initData().
	 */
	public function __construct()
	{
		$this->initData();
	}

	protected function getData( $key )
	{
		return array_key_exists( $key, $this->data ) ? $this->data[$key] : NULL;
	}

	/**
	 * Abstract function wich deals with all the initialization and unseting on
	 * each function.
	 */
	abstract protected function initData();
}
