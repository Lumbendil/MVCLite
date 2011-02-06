<?php
/**
 * index.php
 *
 * Single entry point of the framework.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 */
/**
 * Path to the root folder, wich contains the app and httpdocs folders.
 *
 * @var string
 */
define( 'ROOT_PATH', dirname( dirname( __FILE__ ) ) . '/' );

require ROOT_PATH . 'app/core/init.php';

$dispatcher = new Dispatcher;

$dispatcher->run( new Router( CONFIG_PATH . 'routes.ini' ) );