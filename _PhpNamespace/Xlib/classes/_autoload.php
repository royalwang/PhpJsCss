<?php
// autoload php classes
function __autoload($class) {
	// convert namespace to full file path
	$class = 'classes/' . str_replace('\\', '/', $class) . '.php';
	require_once($class);
}
?>