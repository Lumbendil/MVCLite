<?php
/**
 * uploadsmanager.plugin.php
 *
 * File wich contains the UploadsManager plugin.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 *
 * @package MVCLite
 */
/**
 * Class wich handles the uploads of the system.
 */
class UploadsManagerPlugin
{
	/**
	 * Array that contains the data of $_FILES
	 *
	 * @var array
	 */
	protected $files			= array();

	/**#@+
	 * @var int
	 */
	/**
	 * File was uploaded and moved suscesfuly.
	 */
	const CORRECT_UPLOAD		= 0;

	/**
	 * Wrong identifier given to the function.
	 */
	const WRONG_IDENTIFIER		= 1;

	/**
	 * Error on the POST upload.
	 */
	const UPLOAD_ERROR			= 2;

	/**
	 * Mime type doesn't match the expected one.
	 */
	const INCORRECT_MIME_TYPE	= 3;

	/**
	 * File already stored in the filesystem.
	 */
	const FILE_ALREADY_EXISTS	= 4;
	/**#@+*/

	protected $last_moved_file = NULL;

	/**
	 * Constructor, wich sets $files and unsets $_FILES.
	 */
	public function __construct()
	{
		$this->files	= $_FILES;
		$_FILES			= array();
	}

	/**
	 * Function that checks if there are any files uploaded.
	 *
	 * @return boolean true if there is one or more files, false otherwise.
	 */
	public function hasFile( $file )
	{
		if ( !array_key_exists( $file, $this->files ) )
		{
			return false;
		}

		$path = $this->files[$file]['tmp_name'];

		if ( '' !== $path && file_exists( $path ) )
		{
			return true;
		}

		return false;
	}

	/**
	 * Function that stores the file wich is identified by $file in $path, if it has
	 * the expected mime type.
	 *
	 * @param string $file			File identifier.
	 * @param string $path			Path to store the file.
	 * @param string $expected_mime	Expected mime type. If NULL, it's ignored. Defaults
	 * 	to NULL.
	 */
	public function storeFile( $file, $path, $expected_mime = NULL )
	{
		if ( !array_key_exists( $file, $this->files ) )
		{
			return self::WRONG_IDENTIFIER;
		}

		if ( UPLOAD_ERR_OK !== $this->files[$file]['error'] )
		{
			return self::UPLOAD_ERROR;
		}

		$temp_file_path = $this->files[$file]['tmp_name'];

		if ( NULL != $expected_mime && mime_content_type( $temp_file_path ) != $expected_mime )
		{
			return self::INCORRECT_MIME_TYPE;
		}

		$file_path = $path . $this->files[$file]['name'];

		if ( file_exists( $file_path ) )
		{
			return self::FILE_ALREADY_EXISTS;
		}

		if( !file_exists( $path ) )
		{
			mkdir( $path, 0777, true );
		}

		move_uploaded_file( $temp_file_path, $file_path );

		$this->last_moved_file = $file_path;

		return self::CORRECT_UPLOAD;
	}

	public function movedFile()
	{
		return $this->last_moved_file;
	}

	public function fileMd5( $file )
	{
		return md5_file( $this->files[$file]['tmp_name'] );
	}
}