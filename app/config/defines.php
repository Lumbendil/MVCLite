<?php
/**
 * defines.php
 *
 * File that contains all the needed constants for the application to work.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
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

define( 'CSS_PATH',	PUBLIC_PATH . 'css/' );
define( 'IMG_PATH',	PUBLIC_PATH . 'img/' );
define( 'JS_PATH',	PUBLIC_PATH . 'js/' );

define( 'TEMPLATE_EXTENSION', '.tpl' );

define( 'CONTROLLER_REGEX', '/^((?:[A-Z][^A-Z]*)+)([A-Z][^A-Z]*)Controller$/' );
define( 'MODEL_REGEX', '/^(.+)Model$/' );

define( 'DB_HOSTNAME',	'localhost' );
define( 'DB_USERNAME',	'framework_rw' );
define( 'DB_PASSWORD',	'123456789' );
define( 'DB_DATABASE',	'framework' );

define( 'DEFAULT_LOCALE', 'es_ES' );

define( 'CACHE_ENABLED',	false );
define( 'MEMCACHED_HOST',	'192.168.150.128' );
define( 'MEMCACHED_PORT',	11211 );