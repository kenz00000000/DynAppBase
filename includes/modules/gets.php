<?php

	// Date Timne //
	$date_time = date( "Y-m-d H:i:s" );

	// HTTP Host //
	$http_host = $_SERVER[ 'HTTP_HOST' ];

	// Request URI //
	$request_uri = $_SERVER[ 'REQUEST_URI' ];

	// Page ID //
	$pa = @$_REQUEST[ 'pa' ];

	// Pagination //
	$pn = @$_REQUEST[ 'pn' ];

	// Post ID //
	$po = @$_REQUEST[ 'po' ];

	// Transition ID //
	$tr = @$_REQUEST[ 'tr' ];

?>