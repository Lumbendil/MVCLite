<?php
// TODO: Documentar
class DatabaseSingletonFactory
{
	static protected $instance = NULL;
	protected function __construct() {}

	public static function getInstance()
	{
		if ( NULL === self::$instance )
		{
			$dsn		= 'mysql:host=' . DB_HOSTNAME . ';dbname=' . DB_DATABASE;
			$options	= array(
				Database::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
				, Database::ATTR_ERRMODE => Database::ERRMODE_EXCEPTION
			);

			try
			{
				self::$instance = new Database( $dsn, DB_USERNAME, DB_PASSWORD, $options );
			}
			catch(PDOException $e)
			{
				throw new Error500Exception( 'Database connection error' );
			}
		}

		return self::$instance;
	}
}