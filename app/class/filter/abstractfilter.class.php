<?php
/**
 * Abstract class wich has the basic implementation of most of the methods in
 * the interface Filter.
 *
 * @package GlobalFilters
 */
abstract class AbstractFilter implements Filter
{
	public function getText( $key )
	{
		$obtained_data = $this->getData( $key );

		return NULL !== $obtained_data ? htmlspecialchars( $obtained_data ) : NULL;
	}

	public function getNumber( $key )
	{
		$obtained_data = $this->getData( $key );

		return  is_numeric( $obtained_data ) ? $obtained_data : NULL;
	}

	public function getEmail( $key )
	{
		$obtained_data	= $this->getData( $key );
		$at_explode		= explode( '@', $obtained_data );

		if ( 2  != count( $at_explode ) || !ctype_alnum( $at_explode[0] ) )
		{
			return NULL;
		}

		$dot_explode = explode( '.', $at_explode[1] );

		if ( 2 != count( $dot_explode ) || !ctype_alnum( $dot_explode[0] ) || !ctype_alnum( $dot_explode[1] ) )
		{
			return NULL;
		}

		return $obtained_data;
	}

	public function getDate( $key )
	{
		$obtained_data	= $this->getData( $key );

		list( $year, $month, $day ) = explode( '-', $obtained_data . '--' );

		if ( !is_numeric( $year ) || !is_numeric( $month ) || !is_numeric( $day ) )
		{
			return NULL;
		}

		return checkdate( $month, $day, $year ) ? $obtained_data : NULL;
	}

	public function getHtml( $key, $allowed_tags )
	{
		$obtained_data			= $this->getData( $key );
		$allowed_tags_string	= '';

		for ($i = 0, $end = count( $allowed_tags ); $i < $end; $i++ )
		{
			$allowed_tags_string .= '<' . $allowed_tags[$i] . '>';
		}

		return NULL !== $obtained_data ? strip_tags( $obtained_data, $allowed_tags_string ) : NULL;
	}

	/**
	 * Gives the data stored in $key.
	 *
	 * @param string	$key	The key to the data to be retrived.
	 *
	 * @return mixed			The data that was asked, or NULL if $key doesn't
	 * 	exist.
	 */
	protected abstract function getData( $key );
}
