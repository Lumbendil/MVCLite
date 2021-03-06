<?php
require_once 'vfsStream/vfsStream.php';

class Error404Exception extends Exception {}

class RouterTest extends PHPUnit_Framework_TestCase
{
	protected $router = NULL;

	public function setUp()
	{
		vfsStream::setUp( 'root' );
        vfsStream::newFile( 'config.ini' )->at( vfsStreamWrapper::getRoot() );

        $config_file = vfsStream::url( 'root/config.ini' );

        $config_content = <<<CONFIG
['%^/random-uri-(with)-(params)$%']
controller = 'ControllerToBeUsed'
action = 'actionToBeRun'
CONFIG;
		file_put_contents( $config_file , $config_content );

		$this->router = new Router( $config_file );
	}

	/**
	 * @covers Router::parseUri
	 */
	public function testParseUriWithWrongUri()
	{
		$this->setExpectedException( 'Error404Exception' );
		$this->router->parseUri( '/url-non-existant' );
	}

	/**
	 * @covers Router::parseUri
	 * @covers Router::getController
	 * @covers Router::getAction
	 * @covers Router::getParams
	 */
	public function testParseUri()
	{
		$this->assertEquals( '', $this->router->getController(), 'Controller name starts empty' );
		$this->assertEquals( '', $this->router->getAction(), 'Action starts empty' );
		$this->assertEquals( array(), $this->router->getParams(), 'Params starts empty' );

		$this->router->parseUri( '/random-uri-with-params' );

		$this->assertEquals( 'ControllerToBeUsed', $this->router->getController(), 'Controller name is modified.' );
		$this->assertEquals( 'actionToBeRun', $this->router->getAction(), 'Action is modified' );
		$this->assertEquals( array( 'with', 'params' ), $this->router->getParams(), 'Params are modified' );
	}

	/**
	 * @covers Router::parseUri
	 * @covers Router::getController
	 * @covers Router::getAction
	 * @covers Router::getParams
	 */
	public function testParseUriWithGet()
	{
		$this->assertEquals( '', $this->router->getController(), 'Controller name starts empty' );
		$this->assertEquals( '', $this->router->getAction(), 'Action starts empty' );
		$this->assertEquals( array(), $this->router->getParams(), 'Params starts empty' );

		$this->router->parseUri( '/random-uri-with-params?get=parameter' );

		$this->assertEquals( 'ControllerToBeUsed', $this->router->getController(), 'Controller name is modified.' );
		$this->assertEquals( 'actionToBeRun', $this->router->getAction(), 'Action is modified' );
		$this->assertEquals( array( 'with', 'params' ), $this->router->getParams(), 'Params are modified' );
	}
}