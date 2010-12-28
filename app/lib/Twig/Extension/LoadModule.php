<?php
/**
 * LoadModule.php
 *
 * File wich contains the extension for using LoadModule.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 */
/**
 * Extension wich will enable LoadModule.
 */
class Twig_Extension_LoadModule extends Twig_Extension
{
	/**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
	public function getName()
	{
		return 'LoadModule';
	}

	/**
     * Returns the token parser instances to add to the existing list.
     *
     * @return array An array of Twig_TokenParserInterface or Twig_TokenParserBrokerInterface instances
     */
	public function getTokenParsers()
	{
		return array( new Twig_TokenParser_LoadModule() );
	}
}