<?php
function autoload($classname) {
	if(file_exists($file = '../app/classes/' . $classname . '.php')) {
		require $file;
	}
}
spl_autoload_register('autoload');