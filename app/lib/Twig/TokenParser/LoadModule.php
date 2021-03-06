<?php
class Twig_TokenParser_LoadModule extends Twig_TokenParser
{
	public function parse(Twig_Token $token)
	{
		$lineno = $token->getLine();
		$value = $this->parser->getExpressionParser()->parseExpression();
		$this->parser->getStream()->expect(Twig_Token::BLOCK_END_TYPE);

		return new Twig_Node_LoadModule( $value, $lineno );
	}

	public function getTag()
	{
		return 'loadmodule';
	}
}