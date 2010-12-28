<?php
/**
 * template.class.php
 *
 * Function that defines the Template class.
 *
 * @author Roger Llopart Pla.
 */

require_once LIB_PATH . 'Twig/Autoloader.php';

/**
 * Template class, wich manages the whole templating system using contexts.
 */
class Template
{
	protected $twig = NULL;

	protected static $instance = NULL;

	protected $contexts = array();

	protected $context_name = '';

	protected $current_context = NULL;

	protected $layout = NULL;

	/**
	 * Constructor wich initializes the underlying templating system.
	 */
	protected function __construct()
	{
		Twig_Autoloader::register();

		$loader = new Twig_Loader_Filesystem( TEMPLATE_PATH );

		$params = array(
			'cache'		=> TMP_PATH
			, 'debug'	=> true
		);

		$this->twig = new Twig_Environment( $loader, $params );

		$this->twig->addExtension( new Twig_Extension_I18n() );
		$this->twig->addExtension( new Twig_Extension_LoadModule() );

		$this->setContext('MAIN');
	}

	/**
	 * Gets the instance of the class.
	 *
	 * Applies the Singleton design pattern.
	 *
	 * @return Template
	 */
	public static function getInstance()
	{
		if ( NULL === self::$instance )
		{
			self::$instance = new Template;
		}

		return self::$instance;
	}

	/**
	 * Checks if the Template contains the context.
	 *
	 * @param string $context_name
	 *
	 * @return boolean
	 */
	public function hasContext( $context_name )
	{
		return array_key_exists( $context_name, $this->contexts );
	}

	/**
	 * Returns the current context name.
	 *
	 * @return string
	 */
	public function getCurrentContext()
	{
		return $this->context_name;
	}

	/**
	 * Sets the current context to $context_name.
	 *
	 * In case the context exists, it just swaps the contexts. If it doesn't, it
	 * creates a new Smarty object and a template file string to store the data.
	 * In case $cached_data isn't NULL, it simply sets the context value to the
	 * one in $cached_data.
	 *
	 * @param string $context_name
	 * @param string $cached_data
	 */
	public function setContext( $context_name, $cached_data = NULL )
	{
		if ( !$this->hasContext( $context_name ) )
		{
			// Checks if we're given cached data.
			if ( NULL === $cached_data )
			{
				// If we aren't given cache data, we create an array with the needed items.
				$current_context = array();

				//$current_context['template_file']	= '';
				$current_context['data']			= array();
				$current_context['template']		= NULL;
			}
			else
			{
				// When we're given cached data, we simply store it.
				$current_context = $cached_data;
			}

			// Stores the created context in the contexts array.
			$this->contexts[$context_name] = $current_context;
		}
		// Sets the current context name to the one given.
		$this->context_name = $context_name;

		$this->current_context = &$this->contexts[$this->context_name];
	}

	public function assign( $key, $value )
	{
		$this->current_context['data'][$key] = $value;
	}

	/**
	 * Sets the template file path of the current context.
	 *
	 * @param string $template
	 */
	public function setTemplate( $template )
	{
		// Search for the template layout.
		if ( 'MAIN' == $this->context_name )
		{
			$found	= false;
			$path	= dirname( $template );


			for ( $i = 0; !$found && $i < 3; $i++ )
			{
				if ( file_exists( TEMPLATE_PATH . $path . '/layout' . TEMPLATE_EXTENSION ) )
				{
					$found = true;
					$path = $path . '/layout' . TEMPLATE_EXTENSION;
				}
				else
				{
					$path	= dirname( $path );
				}
			}

			if ( $found )
			{
				$this->layout	= $this->twig->loadTemplate( $path );
			}
		}
		$this->current_context['template'] = $this->twig->loadTemplate( $template );
	}

	/**
	 * Returns the context data.
	 *
	 * In case the context was obtained from a cache, it simply returns that content.
	 * In case it is a template, it creates the template with the set template file.
	 *
	 * @return string The output data.
	 */
	public function getContextData( $context_name = NULL )
	{
		if( NULL !== $context_name )
		{
			$previous_context_name = $this->context_name;
			$this->setContext( $context_name );
		}
		if ( 'MAIN' == $this->context_name )
		{
			$this->current_context['data']['layout']	= $this->layout;
		}
		// If $this->current_context is an array, we have to use the fetch function of the template object.
		if ( is_array( $this->current_context ) )
		{
			$result = $this->render( $this->current_context['data'] );
		}
		else
		{
			$result = $this->current_context;
		}
		if( NULL !== $context_name )
		{
			$this->setContext( $previous_context_name );
		}
		return $result;
	}

	/**
	 * Magic function wich is called when the function hasn't been defined.
	 *
	 * It is used to call the Smarty functions directly. It'll redirect the function
	 * calls of unknown functions as calls to the Smarty object of the current context.
	 *
	 * @param string $function
	 * @param array $params
	 *
	 * @return mixed Return of the Smarty called function.
	 */
	public function __call( $function, $params )
	{
		if( NULL !== $this->current_context['template'] )
		{
			return call_user_func_array( array( $this->current_context['template'], $function ), $params );
		}

		return NULL;
	}
}