<?php

if ( ! isset( $GLOBALS['abz_sg_version'] ) ) {

	if ( function_exists( 'sg_loader_version' ) ) {
		$version = (int) sg_loader_version();

		if ( ! in_array( $version, [ 12, 13 ] ) ) {
			$version = 13;
		}

	} else {
		$version = 13;
	}

	$GLOBALS['abz_sg_version'] = $version;
}

require substr( __FILE__, 0, - 4 ) . '-v' . $GLOBALS['abz_sg_version'] . '.php';