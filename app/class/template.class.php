<?php
/**
 * template.class.php
 *
 * Function that defines the Template class.
 *
 * @author Roger Llopart Pla.
 */
// TODO: End documentation.
require_once LIB_PATH . 'Smarty/Smarty.class.php';

/**
 * Template class, wich is a Facade of Smarty.
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

	public static function getInstance()
	{
		if ( NULL === self::$instance )
		{
			self::$instance = new Template;
		}

		return self::$instance;
	}

	public function hasContext( $context_name )
	{
		return array_key_exists( $context_name, $this->contexts );
	}

	public function setContext( $context_name, $cached_data = NULL )
	{
		$this->context_name = $context_name;

		if ( !$this->hasContext( $context_name ) )
		{
			if ( NULL === $cached_data )
			{
				$current_context = array();

				$current_context['template_file']		= '';
				$current_context['template_object']		= new Smarty;

				$current_context['template_object']->template_dir	= TMP_PATH . 'smarty_template/';
				$current_context['template_object']->compile_dir	= TMP_PATH . 'smarty_compile/';
			}
			else
			{
				$current_context = $cached_data;
			}

			$this->contexts[$this->context_name] = $current_context;
		}
	}

	public function setTemplate( $template )
	{
		$this->contexts[$this->context_name]['template_file'] = $template;
	}

	public function getContextData()
	{
		$current_context = $this->contexts[$this->context_name];

		if ( is_array( $current_context ) )
		{
			return $current_context['template_object']->fetch( $current_context['template_file'] );
		}
		else
		{
			return $current_context;
		}
	}

	public function __call( $function, $params )
	{
		$smarty = $this->contexts[$this->context_name]['template_object'];

		return call_user_func_array( array( $smarty, $function ), $params );
	}
}