<?php

define( 'ROOT_PATH',dirname( dirname( dirname(  __FILE__ ) ) ) . '/' );
require_once ROOT_PATH . 'app/config/defines.php';
require_once CORE_PATH . 'autoload.php';
require_once 'vfsStream/vfsStream.php';

Autoloader::startInstance();

class RouterTest extends PHPUnit_Framework_TestCase
{
	protected $router = NULL;

	public function setUp()
	{
		vfsStream::setUp( 'root' );
        vfsStream::newFile( 'config.ini' )->at( vfsStreamWrapper::getRoot() );

		$this->router = new Router( vfsStream::url( 'root/config.ini' ) );
	}

	public function testGetControler()
	{
		$this->assertEquals('', $this->router->getController() );
	}
}