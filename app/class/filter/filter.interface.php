<?php
/**
 * Interface wich has the methods any filter of user input should have.
 *
 * @package GlobalFilters
 */
interface Filter
{
	/**
	 * Function wich returns the data on position $key if it's a number.
	 *
	 * @param string	$key	The key to the data to be filtered.
	 *
	 * @return string			The data in case the data is numeric, and NULL
	 * 	otherwise.
	 */
	public function getNumber	( $key );

	/**
	 * Function wich returns the text on $key to be printed by a browser as
	 * plain text.
	 *
	 * @param string	$key	The key to the data to be filtered.
	 *
	 * @return string			The data on $key with the relevant HTML entities
	 * 	written in a printable format.
	 */
	public function getText		( $key );

	/**
	 * Function wich returns the data on position $key if it's an e-mail.
	 *
	 * @param string	$key	The key to the data to be filtered.
	 *
	 * @return string			The e-mail in case the data is correct, and NULL
	 * 	otherwise.
	 */
	public function getEmail	( $key );

	/**
	 * Function wich returns the data on position $key if it's a date in the
	 * DDD-MM-YY format.
	 *
	 * @param string	$key	The key to the data to be filtered.
	 *
	 * @return string			The date in case the data is correct, and NULL
	 * 	otherwise.
	 */
	public function getDate		( $key );

	/**
	 * Function wich returns the data on $key with all the tags but those in
	 * $allowed_tags removed.
	 *
	 * @param string	$key			The key to the data to be filtered.
	 * @param array		$allowed_tags	Array with the allowed tags, in the following
	 * 	syntax:
	 * <code>
	 * <?php
	 * 	getHtml( $key, array( '<b>', '<a>' ) );
	 * ?>
	 * </code>
	 * @return string					The data string with all the HTML tags but
	 * 	the ones on $allowed_tags removed.
	 */
	public function getHtml		( $key, $allowed_tags );
}