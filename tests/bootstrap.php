<?php
define( 'ROOT_PATH', dirname( dirname(  __FILE__ ) ) . '/' );
require_once ROOT_PATH . 'app/config/defines.php';
require_once CORE_PATH . 'autoload.php';

Autoloader::startInstance();