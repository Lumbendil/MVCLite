<?php
class Twig_Node_LoadModule extends Twig_Node
{
	public function __construct( Twig_NodeInterface $value, $lineno )
	{
		parent::__construct(array('value' => $value), array(), $lineno);
	}

	public function compile($compiler)
	{
		$compiler
			->addDebugInfo($this)
			->write( 'echo Template::getInstance()->getContextData(' )
			->subcompile( $this->getNode( 'value' ) )
			->raw( ' );' . PHP_EOL )
		;
	}

}