<?php
/**
 * greet.ctrl.php
 *
 * File wich contains the GreetWorldController.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 */
/**
 * Controller wich handles the "hello world".
 */
class GreetWorldController extends PageController
{
	/**
	 * Action for "/hola-mundo" y "/".
	 */
	protected function hello()
	{
		$this->assign( 'hello', 'Hola' );

		$cache			= Cache::getInstance();
		$uri			= FilterSingletonFactory::getInstance( 'FilterServer' )->getText( 'REQUEST_URI' );

		$template_key	= 'translations';
		$cache_key		= serialize( array( $uri, $template_key ) );

		$translation_data = $cache->get( $cache_key );

		if ( false === $translation_data )
		{
			$translation_data = $this->getData( 'TranslationModel', 'getAllTranslations'
				, array( 'ca_ES' ) );

			$cache->set( $cache_key, $translation_data, 0, 30 );
		}

		$this->assign( $template_key, $translation_data );

		$this->addModule( 'GreetModuleWorldController', 'hello', array() );
	}
}