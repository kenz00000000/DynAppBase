<?php


/**** Login Status ****/

	$login_status = loginStatus( $tolken );


/**** MySQL Connect ****/

	if( strpos( $http_host, 'localhost' ) !== false ) // ~ Local Host
	{
		$pdo = new PDO( 'mysql:host='.MYSQL_HOST_LOCAL.';dbname='.MYSQL_DB_LOCAL, MYSQL_USER_LOCAL, MYSQL_PASS_LOCAL );
	}
	else // ~ Remote Host
	{
		$pdo = new PDO( 'mysql:host='.MYSQL_HOST_REMOTE.';dbname='.MYSQL_DB_REMOTE, MYSQL_USER_REMOTE, MYSQL_PASS_REMOTE );
	}


/**** Plugins ****/

	$plugin_dirs = pluginDirs();

	foreach( $plugin_dirs as $plugin_dir )
	{
		include 'includes/plugins/' . $plugin_dir . '/index.php';
	}

	// if( !isset( $plugin_content ) )
	// {
	// 	$plugin_content = null;
	// }


/**** Default Page ****/

	if( !isset( $pa ) && !isset( $po ) )
	{
		$pa = 1;
	}


/**** Navigation ****/

	$navigation = navigation( $pdo, $pa, $po );


/**** Breadcrumb ****/

	$breadcrumb = breadcrumb( $pdo, $pa, $po );


/**** Contents ****/

	if( isset( $pa ) )
	{
		$get__submit = @$_GET[ 'submit' ];
		$get__start_id = @$_GET[ 'start_id' ];
		$get__end_id = @$_GET[ 'end_id' ];
		$get__start_created_at = @$_GET[ 'start_created_at' ];
		$get__end_created_at = @$_GET[ 'end_created_at' ];
		$get__start_updated_at = @$_GET[ 'start_updated_at' ];
		$get__end_updated_at = @$_GET[ 'end_updated_at' ];
		$get__keyword = @$_GET[ 'keyword' ];

		$values = [ $pa, $get__submit, $get__start_id, $get__end_id, $get__start_created_at, $get__end_created_at, $get__start_updated_at, $get__end_updated_at, $get__keyword ];

		$contents = pages( $pdo, $pa, $pn, $values, $request_uri ) . $plugin_content;
	}
	elseif( isset( $po ) )
	{
		$contents = postDetail( $pdo, $po );
	}

 
?>