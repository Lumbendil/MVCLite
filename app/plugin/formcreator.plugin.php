<?php
/**
 * formcreator.plugin.php
 *
 * File wich contains the class FormCreatorPlugin.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 *
 * @package MVCLite
 */
/**
 * Plugin that helps creation of formularies.
 */
class FormCreatorPlugin
{
	/**
	 * The result of the current form.
	 *
	 * @var array
	 */
	protected $result = NULL;

	/**
	 * Starts creating a new formulary.
	 *
	 * @return FormCreatorPlugin	The own object.
	 */
	public function startForm()
	{
		$this->result				= array();

		$this->result['start']		= array();
		$this->result['elements']	= array();

		return $this;
	}

	/**
	 * Adds a new field to the form.
	 *
	 * @param string $type	The desired type of input.
	 * @param string $name	The desired name.
	 * @param string $label	If it's different than NULL, the desired label.
	 * @param string $value	The value of the input.
	 *
	 * @return FormCreatorPlugin	The own object.
	 */
	public function addElement( $type, $name, $label = NULL, $value = NULL )
	{
		$current_field = array();

		$current_field['type']	= $type;
		$current_field['name']	= $name;
		$current_field['value']	= $value;
		$current_field['label']	= $label;

		$this->result['elements'][] = $current_field;
		return $this;
	}

	public function addExtra( $key, $value )
	{
		$last_position = count( $this->result['elements'] ) - 1;

		if( array_key_exists( 'extra', $this->result['elements'][$last_position] ) )
		{
			$this->result['elements'][$last_position]['extra'] = array();
		}

		$this->result['elements'][$last_position]['extra'][$key] = $value;

		return $this;
	}

	public function startSelect()
	{}

	public function startOptgroup()
	{}

	public function addOption()
	{}

	public function endOptgroup()
	{}

	public function endSelect()
	{}

	/**
	 * Returns the string obtained from creating the current formulary.
	 *
	 * @param string $action	The action to be used when the form is submited.
	 * @param string $method	GET or POST.
	 * @param string $enctype	The enctype to be used in the form. It defaults to NULL,
	 * 							and when set to NULL, it isn't set.
	 *
	 * @return array			The demanded form.
	 */
	public function getForm( $action, $method, $enctype = NULL )
	{

		$start_element = array();

		$start_element['method']	= $method;
		$start_element['action']	= $action;
		$start_element['enctype']	= $enctype;

		$this->result['start']		= $start_element;

		return $this->result;
	}
}