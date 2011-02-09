<?php

class DispatcherTest extends PHPUnit_Framework_TestCase
{
	protected $dispatcher;
	protected $router_mock;

	public function SetUp()
	{
		$this->router_mock = $this->getMockBuilder( 'Router' )
							->setMethods( array( 'parseUri',
												'getController',
												'getAction',
												'getParams' ) )
							->disableOriginalConstructor()
							->getMock();
		$this->dispatcher = new Dispatcher();
	}

	public function testRunNoController()
	{
		$this->markTestIncomplete( 'Test not implemented yet.' );
	}

	public function testRun()
	{
		$filter_server_mock = $this->getMockBuilder('FilterServer')
							->setMethods( array( 'getText' ) )
							->getMock();


		$filter_factory_returns = array(
			'FilterServer' => $filter_server_mock
		);
		factoryMocker( 'FilterSingletonFactory', 'getInstance', $filter_factory_returns );

		$filter_server_mock->expects( $this->any() )
						->method( 'getText' )
						->with( $this->equalTo( 'REQUEST_URI' ) )
						->will( $this->returnValue( '/' ) );

		$this->router_mock->expects( $this->any() )
							->method( 'parseUri' )
							->with( $this->equalTo( '/' ) )
							->will( $this->returnValue( null ) );

		$this->router_mock->expects( $this->any() )
							->method( 'getController' )
							->will( $this->returnValue( 'Controller' ) );

		$this->router_mock->expects( $this->any() )
							->method( 'getAction' )
							->will( $this->returnValue( 'action' ) );

		$this->router_mock->expects( $this->any() )
							->method( 'getParams' )
							->will( $this->returnValue( array() ) );

		$controller_mock = $this->getMockBuilder('PageController')
								->setMethods( array( 'run', 'processModules', 'fetch' ) )
								->disableOriginalConstructor()
								->getMock();

		$controller_factory_returns = array(
			'Controller' => $controller_mock
		);

		factoryMocker( 'ControllerFactory', 'getController', $controller_factory_returns);

		$controller_mock->expects( $this->once() )
						->method( 'run' )
						->with( 'action', array() )
						->will( $this->returnValue( $controller_mock ) );


		$controller_mock->expects( $this->any() )
						->method( 'processModules' )
						->will( $this->returnValue( $controller_mock ) );

		$controller_mock->expects( $this->any() )
						->method( 'fetch' )
						->will( $this->returnValue( 'Desired output' ) );

		ob_start();
		$this->dispatcher->run( $this->router_mock );
		$this->assertEquals( 'Desired output', ob_get_contents() );
	}
}