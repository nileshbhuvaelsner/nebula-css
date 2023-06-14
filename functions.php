<?php
/*
** Don't put any extra code inside this file. Instead, create a new file 
** inside the functions directory, and then append it to the below list.
** This is to help keep everything readable and easily editable.  
*/
$functions_includes = array(
	'/setup.php',
	'/enqueue.php',
	'/acf.php',
);

foreach ( $functions_includes as $file ) {
	$filepath = locate_template( 'functions' . $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
	}
	require_once $filepath;
}