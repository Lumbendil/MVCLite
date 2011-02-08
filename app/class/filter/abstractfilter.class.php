<?php
/**
 * Abstract class wich has the basic implementation of most of the methods in
 * the interface Filter.
 *
 * @package MVCLite
 * @subpackage Filters
 */
abstract class AbstractFilter implements Filter
{
	public function getText( $key, $regex = NULL )
	{
		$obtained_data = $this->getData( $key );

		return $this->filterText( $obtained_data, $regex );
	}

	/**
	 * Filters the text data.
	 *
	 * @param mixed $data
	 * @param string $regex
	 *
	 * @return string
	 */
	protected function filterText( $data, $regex = NULL )
	{
		if ( NULL !== $data )
		{
			$data = htmlspecialchars( $data );

			if ( NULL !== $regex )
			{
				if ( !preg_match( $data, $regex ) )
					$data = NULL;
			}
		}

		return $data;
	}

	public function getNumber( $key )
	{
		$obtained_data = $this->getData( $key );

		return $this->filterNumber( $obtained_data );
	}

	/**
	 * Filter numeric data.
	 *
	 * @param mixed $data
	 *
	 * @return mixed
	 */
	protected function filterNumber( $data )
	{
		return  is_numeric( $data ) ? $data : NULL;
	}

	public function getEmail( $key )
	{
		$obtained_data	= $this->getData( $key );

		return $this->filterEmail( $obtained_data );
	}

	/**
	 * Checks if data is an email.
	 *
	 * @param mixed $data
	 *
	 * @return string
	 */
	protected function filterEmail( $data )
	{
		$at_explode		= explode( '@', $data );

		if ( 2  != count( $at_explode ) || !ctype_alnum( $at_explode[0] ) )
		{
			return NULL;
		}

		$dot_explode = explode( '.', $at_explode[1] );

		if ( 2 != count( $dot_explode ) || !ctype_alnum( $dot_explode[0] ) || !ctype_alnum( $dot_explode[1] ) )
		{
			return NULL;
		}

		return $data;
	}

	public function getDate( $key )
	{
		$obtained_data	= $this->getData( $key );

		return $this->filterDate( $obtained_data );
	}

	/**
	 * Checks if data is a date.
	 *
	 * @param mixed $data
	 *
	 * @return string
	 */
	protected function filterDate( $data )
	{
		list( $year, $month, $day ) = explode( '-', $data . '--' );

		if ( !is_numeric( $year ) || !is_numeric( $month ) || !is_numeric( $day ) )
		{
			return NULL;
		}

		return checkdate( $month, $day, $year ) ? $data : NULL;
	}

	public function getHtml( $key, $allowed_tags )
	{
		$obtained_data			= $this->getData( $key );

		return $this->filterHtml( $obtained_data , $allowed_tags );
	}

	/**
	 * Filters the html data, allowing only some tags.
	 *
	 * @param mixed	$data
	 * @param array	$allowed_tags
	 *
	 * @return string
	 */
	protected function filterHtml( $data, $allowed_tags )
	{
		$allowed_tags_string	= '';

		for ($i = 0, $end = count( $allowed_tags ); $i < $end; $i++ )
		{
			$allowed_tags_string .= '<' . $allowed_tags[$i] . '>';
		}

		return NULL !== $data ? strip_tags( $data, $allowed_tags_string ) : NULL;
	}

	public function getFilteredArray( $key, $filter, $extra_params = array() )
	{
		$obtained_data = $this->getData( $key );

		if( !is_array( $obtained_data ) )
		{
			return NULL;
		}

		switch ( $filter )
		{
			case 'text':
				$function = 'filterText';
				break;
			case 'number':
				$function = 'filterNumber';
				break;
			case 'email':
				$function = 'filterEmail';
				break;
			case 'date':
				$function = 'filterDate';
				break;
			case 'html':
				$function = 'filterHtml';
				break;
			default:
				return NULL;
		}

		for( $i = 0, $end = count( $obtained_data ); $i < $end ; $i++ )
		{
			$data = $obtained_data[$i];

			array_unshift( $extra_params, $data );

			$obtained_data[$i] = call_user_func_array( array( $this, $function ), $extra_params );

			array_shift( $extra_params );
		}

		return $obtained_data;
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
