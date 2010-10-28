<?php
/**
 * model.class.php
 *
 * File that contains the Model class.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 */
/**
 * Abstract class wich must be inerited by all the models.
 */
abstract class Model
{
	/**
	 * Database instance.
	 *
	 * @var Database
	 */
	protected $db = NULL;

	/**
	 * Constructor, that gets a database instance.
	 */
	public function __construct()
	{
		$this->db = DatabaseSingletonFactory::getInstance();
	}
}