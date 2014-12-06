<?php
// Load WordPress test environment
// https://github.com/nb/wordpress-tests
//
// The path to wordpress-tests
$path = '/home/wern/web_files/wordpress/wp-content/plugins/ecom/src/wordpress-tests/bootstrap.php';

if( file_exists( $path ) ) {
  
    require_once $path;
} else {
    exit( "Couldn't find path to wordpress-tests/bootstrap.php\n" );
}