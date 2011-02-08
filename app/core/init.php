<?php
/**
 * init.php
 *
 * File that requires all the needed files before the framework can be used.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 *
 * @package MVCLite
 */
require ROOT_PATH . 'app/config/defines.php';
require CORE_PATH . 'autoload.php';

// Starts the autoloader.
Autoloader::startInstance();

require CORE_PATH . 'startfilters.php';

// Sets the default timezone.
date_default_timezone_set('Europe/Madrid');