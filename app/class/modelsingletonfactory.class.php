<?php
/**
 * modelsingletonfactory.class.php
 *
 * File that contains the class ModelSingletonFactory.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 */
/**
 * Factory wich produces singletoned instances of the models.
 */
class ModelSingletonFactory
{
	/**
	 * This variable contains all the instances wich have been created.
	 *
	 * @var array
	 */
	protected static $instances = array();

	/**
	 * Overriden constructor to avoid instantiation of the class.
	 */
	protected function __construct() {}

	/**
	 * Function that will give an instance of the solicited model.
	 *
	 * @param string $model_name	The name of the wanted model.
	 *
	 * @return Model				The instance of the model.
	 */
	public static function getModel( $model_name )
	{
		if ( !array_key_exists( $model_name, self::$instances ) )
		{
			$model = new $model_name;

			if ( !( $model instanceof Model ) )
			{
				return NULL;
			}

			self::$instances[$model_name] = $model;
		}

		return self::$instances[$model_name];
	}
}