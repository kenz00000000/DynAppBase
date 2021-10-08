<?php


ini_set('display_errors', "On");


/**** Modules ****/

	// Define //
	include 'includes/modules/defines.php';

	// Common Settings //
	include 'includes/modules/settings.php';

	// Get Values //
	include 'includes/modules/gets.php';

	// Functions //
	include 'includes/modules/functions.php';

	// Controller //
	include 'includes/modules/controller.php';


/**** HTML Template ****/

	// Base HTML //
	include 'includes/themes/' . ACTIVE_THEME . '/index.php'


?>