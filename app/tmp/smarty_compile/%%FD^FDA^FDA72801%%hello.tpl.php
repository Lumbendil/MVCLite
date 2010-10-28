<?php /* Smarty version 2.6.26, created on 2010-10-22 10:34:25
         compiled from C:%5Cxampp%5Chtdocs%5Cframework/app/template/world/greet/hello.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'loadmodule', 'C:\\xampp\\htdocs\\framework/app/template/world/greet/hello.tpl', 8, false),array('modifier', 'getkey', 'C:\\xampp\\htdocs\\framework/app/template/world/greet/hello.tpl', 9, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Testing</title>
	</head>
	<body>
		<p><?php echo $this->_tpl_vars['hello']; ?>
 <?php echo smarty_function_loadmodule(array('controller' => 'GreetModuleWorldController','action' => 'hello'), $this);?>

		<p><?php echo smarty_modifier_getkey($this->_tpl_vars['translations'], "Hello World!"); ?>
</p>
	</body>
</html>