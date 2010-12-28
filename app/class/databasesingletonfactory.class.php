<?php
/**
 * File that contains the definition of the database singleton factory.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 */
/**
 * Factory that returns singletoned database instances.
 */
class DatabaseSingletonFactory
{
	/**
	 * Instances of the diferent database connections.
	 *
	 *  @var array
	 */
	static protected $instances = array();

	/**
	 * Overriden constructor to avoid instantiation of the class.
	 */
	protected function __construct() {}

	/**
	 * Function that returns a Database object for the given params.
	 *
	 * This function will create the connection if it has not yet been established.
	 * Otherwise, it'll return the previous connection wich used the same parameters.
	 *
	 * @param array $params	Array of parameters. Accepts the following ones:
	 * <ul>
	 * <li>hostname: The host on wich the connection should be done.</li>
	 * <li>database: The database that will be used.</li>
	 * <li>username: The user wich we should user to connect.</li>
	 * <li>password: The password of the user.</li>
	 * </ul>
	 * @return Database
	 * @throws Error500Exception
	 */
	public static function getInstance( $user = DB_USERNAME, $password = DB_PASSWORD,
		$database = DB_DATABASE, $host = DB_HOSTNAME )
	{
		$key = $host . '|' . $database . '|' . $user . '|' . $password;
		if ( !array_key_exists( $key, self::$instances ) )
		{
			$dsn		= 'mysql:host=' . $host . ';dbname=' . $database;
			$options	= array(
				Database::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
				, Database::ATTR_ERRMODE => Database::ERRMODE_EXCEPTION
			);

			try
			{
				self::$instances[$key] = new Database( $dsn, $user, $password, $options );
			}
			catch(PDOException $e)
			{
				throw new Error500Exception( 'Database connection error' );
			}
		}
		return self::$instances[$key];
	}
}
