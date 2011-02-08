<?php
define( 'ROOT_PATH', dirname( dirname(  __FILE__ ) ) . '/' );
require_once ROOT_PATH . 'app/config/defines.php';
require_once CORE_PATH . 'autoload.php';

Autoloader::startInstance();

function factoryMocker( $factory_name, $factory_method, $factory_returns )
{
	$code = <<<FACTORYCODE
class $factory_name
{
	public static \$returns = NULL;
	public static function $factory_method ( \$class )
	{
		return self::\$returns[\$class];
	}
}
FACTORYCODE;
	eval( $code );
	$factory_name::$returns = $factory_returns;
}