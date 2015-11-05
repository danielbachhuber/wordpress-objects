<?php

/**
 * WordPress Objects
 *
 * A series of classes to represent objects within WordPress
 */

spl_autoload_register( function( $class ){
	$class = ltrim( $class, '\\' );
	if ( 0 !== stripos( $class, 'WordPress_Objects\\' ) ) {
		return;
	}

	$parts = explode( '\\', $class );
	array_shift( $parts ); // Don't need "WordPress_Objects\"
	$last = array_pop( $parts ); // File should be 'class-[...].php'
	$last = 'class-' . $last . '.php';
	$parts[] = $last;
	$file = dirname( __FILE__ ) . '/inc/' . str_replace( '_', '-', strtolower( implode( $parts, '/' ) ) );
	if ( file_exists( $file ) ) {
		require $file;
	}
});
