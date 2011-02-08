<?php
/**
 * defines.php
 *
 * File that contains all the needed constants for the application to work.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 *
 * @package MVCLite
 */
// The constant ROOT_PATH needs to be defined before importing this script.
/**
 * Path to the app folder, wich contains the framework, and shouldn't be accesible
 * by apache.
 *
 * @var string
 */
define( 'APP_PATH',		ROOT_PATH . 'app/' );
/**
 * Path to the public folder, where there is the entry point and all the static
 * files.
 *
 * @var string
 */
define( 'PUBLIC_PATH',	ROOT_PATH . 'httpdocs/');

/**
 * Path to the config folder.
 *
 * @var string
 */
define( 'CONFIG_PATH',		APP_PATH . 'config/' );
/**
 * Path to the controller folder, where all controllers should be placed
 * hierarchicaly.
 *
 * @var string
 */
define( 'CTRL_PATH',		APP_PATH . 'controller/' );
/**
 * Path to the lib folder, where all external libraries are.
 *
 * @var string
 */
define( 'LIB_PATH',			APP_PATH . 'lib/' );
/**
 * Path to the model folder, where all models should be placed.
 * @var string
 */
define( 'MODEL_PATH',		APP_PATH . 'model/' );
/**
 * Path to the template directory, where all the templates should be placed
 * hierarchicaly.
 *
 * @var string
 */
define( 'TEMPLATE_PATH',	APP_PATH . 'template/' );
/**
 * Path to the temporal folder.
 *
 * @var string
 */
define( 'TMP_PATH',			APP_PATH . 'tmp/' );
/**
 * Path to the class folder, where most of the relavant classes of the framework
 * are placed.
 *
 * @var string
 */
define( 'CLASS_PATH',		APP_PATH . 'class/' );
/**
 * Path to the core folder, where files of the framework that don't fit in the
 * other folders are placed.
 *
 * @var string
 */
define( 'CORE_PATH',		APP_PATH . 'core/' );
/**
 * Path to the uploads folder, where the files that have been uploaded by users
 * (or created with those files) are stored.
 *
 * @var string
 */
define( 'UPLOAD_PATH', APP_PATH . 'uploads/' );
/**
 * Path to the plugins folder.
 *
 * @var string
 */
define( 'PLUGIN_PATH', APP_PATH . 'plugin/' );

/**
 * Path to the CSS files.
 *
 * @var string
 */
define( 'CSS_PATH',	PUBLIC_PATH . 'css/' );
/**
 * Path to the static images.
 *
 * @var string
 */
define( 'IMG_PATH',	PUBLIC_PATH . 'img/' );
/**
 * Path to the javascript.
 *
 * @var string
 */
define( 'JS_PATH',	PUBLIC_PATH . 'js/' );

/**
 * The extension of the template files.
 *
 * @var string
 */
define( 'TEMPLATE_EXTENSION', '.tpl' );

/**
 * The controller's matching regex.
 *
 * @var string.
 */
define( 'CONTROLLER_REGEX',	'/^([A-Z][^A-Z]*)((?:[A-Z][^A-Z]*)+)Controller$/' );
/**
 * The model's matching regex.
 *
 * @var string.
 */
define( 'MODEL_REGEX',		'/^(.+)Model$/' );
/**
 * The plugin's matching regex.
 *
 * @var string.
 */
define( 'PLUGIN_REGEX',		'/^(.+)Plugin$/' );

/**
 * Default database host.
 *
 * @var string.
 */
define( 'DB_HOSTNAME',	'localhost' );
/**
 * Default database user.
 *
 * @var string.
 */
define( 'DB_USERNAME',	'rawchive_rw' );
/**
 * Default database password.
 *
 * @var string.
 */
define( 'DB_PASSWORD',	'123456789' );
/**
 * Default database.
 *
 * @var string.
 */
define( 'DB_DATABASE',	'rawchive' );

/**
 * Default locale.
 *
 * @var string
 */
define( 'DEFAULT_LOCALE', 'es_ES' );

/**
 * Constant wich enables or disables the cache.
 *
 * @var boolean
 */
define( 'CACHE_ENABLED',	false );
/**
 * Memcached server IP.
 *
 * @var string
 */
define( 'MEMCACHED_HOST',	'192.168.150.128' );
/**
 * Memacached server connection port.
 *
 * @var int
 */
define( 'MEMCACHED_PORT',	11211 );

/**
 * Algorithm used to do all the hash.
 *
 * @var string
 */
define( 'HASH_ALGORITHM', 'sha1');

/**
 * Random salt to create the control character.
 *
 * @var string
 */
define( 'PHOTO_SALT', 'asfdhsLAD8asfOKJASF7fsa7AH&%TrqYH' );