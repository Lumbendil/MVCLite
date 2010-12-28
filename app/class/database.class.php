<?php
/**
 * database.class.php
 *
 * File that contains the Database class.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 */
/**
 * Database proxy class, wich extends PDO.
 */
class Database extends PDO
{
	/**
	 * Prepares a query and executes it with the given parameters.
	 *
	 * @param string	$sql
	 * @param array		$params
	 *
	 * @throws Error500Exception	Exception thrown if there is any error when
	 * 	executing the query.
	 *
	 * @return PDOStatement	The PDO Statement after executing the query.
	 */
	public function prepareAndExecute( $sql, $params )
	{
		try
		{
			$prepared_query = $this->prepare( $sql );

			if ( $prepared_query->execute( $params ) )
			{
				return $prepared_query;
			}
		}
		catch( PDOException $e )
		{}

		throw new Error500Exception( 'Error executing the sql' );
	}
}