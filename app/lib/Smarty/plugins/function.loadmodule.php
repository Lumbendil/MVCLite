<?php
function smarty_function_loadmodule($params, &$smarty)
{
    $template = Template::getInstance();
	if ( array_key_exists( 'controller', $params) && array_key_exists( 'action', $params) )
	{
		$context_name = $params['controller'] . '_' . $params['action'];
		if ( $template->hasContext( $context_name ) )
		{
			$template->setContext( $context_name );

			$data = $template->getContextData();

			$template->setContext( 'MAIN' );

			return $data;
		}
	}
}
?>
