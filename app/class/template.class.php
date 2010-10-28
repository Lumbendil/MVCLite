<?php
/**
 * template.class.php
 *
 * Function that defines the Template class.
 *
 * @author Roger Llopart Pla.
 */

// Includes the Smarty library.
require_once LIB_PATH . 'Smarty/Smarty.class.php';

/**
 * Template class, wich manages the whole templating system using contexts.
 */
class Template
{
	protected static $instance = NULL;

	protected $contexts = array();

	protected $context_name = '';

	/**
	 * Overriden constructor that calls the Smarty constructor and sets the
	 * template and compile directories.
	 */
	protected function __construct()
	{
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
		// Sets the current context name to the one given.
		$this->context_name = $context_name;

		if ( !$this->hasContext( $context_name ) )
		{
			// Checks if we're given cached data.
			if ( NULL === $cached_data )
			{
				// If we aren't given cache data, we create an array with the needed items.
				$current_context = array();

				$current_context['template_file']		= '';
				$current_context['template_object']		= new Smarty;

				$current_context['template_object']->template_dir	= TMP_PATH . 'smarty_template/';
				$current_context['template_object']->compile_dir	= TMP_PATH . 'smarty_compile/';
			}
			else
			{
				// When we're given cached data, we simply store it.
				$current_context = $cached_data;
			}

			// Stores the created context in the contexts array.
			$this->contexts[$this->context_name] = $current_context;
		}
	}

	/**
	 * Sets the template file path of the current context.
	 *
	 * @param string $template
	 */
	public function setTemplate( $template )
	{
		$this->contexts[$this->context_name]['template_file'] = $template;
	}

	/**
	 * Returns the context data.
	 *
	 * In case the context was obtained from a cache, it simply returns that content.
	 * In case it is a template, it creates the template with the set template file.
	 *
	 * @return string The output data.
	 */
	public function getContextData()
	{
		$current_context = $this->contexts[$this->context_name];

		// If $current_context is an array, we have to use the fetch function of the Smarty object.
		if ( is_array( $current_context ) )
		{
			return $current_context['template_object']->fetch( $current_context['template_file'] );
		}
		else
		{
			return $current_context;
		}
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
		$smarty = $this->contexts[$this->context_name]['template_object'];

		return call_user_func_array( array( $smarty, $function ), $params );
	}
}