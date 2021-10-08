<?php


/**** Login Status ****/

	function loginStatus( $tolken )
	{
		if( isset( $tolken ) )
		{
			$res = '1';
		}
		else
		{
			$res = '0';
		}

		return $res;
	}


/**** Plugin Dirs ****/

	function pluginDirs()
	{
		$plugin_dirs = [];

		$dir = opendir( 'includes/plugins/' );

		while( ( $file = readdir( $dir ) ) !== false )
		{
		  if( $file === '.' || $file === '..' || $file === '.DS_Store' )
		  {
		    continue;
		  }

		  $plugin_dirs[] = $file;
		}

		closedir( $dir );

		sort( $plugin_dirs );

		return $plugin_dirs;
	}


/**** Navigation  ****/

	function navigation( $pdo, $pa, $po )
	{
		$html = null;

		if( isset( $pa ) )
		{
			$query = "SELECT * FROM `pages` WHERE `id` = ${pa}";
			$res = $pdo -> query( $query );
			$res -> execute();
			$row = $res -> fetch( PDO::FETCH_ASSOC );
			$db__active__toplevel_id = $row[ 'toplevel_id' ];
		}
		elseif( isset( $po ) )
		{
			$query = "SELECT * FROM `posts` WHERE `id` = ${po}";
			$res = $pdo -> query( $query );
			$res -> execute();
			$row = $res -> fetch( PDO::FETCH_ASSOC );
			$db__active__toplevel_id = $row[ 'toplevel_id' ];
		}

		$query = "SELECT * FROM `pages` ORDER BY `num_order` ASC";
		$res = $pdo -> query( $query );
		$res -> execute();

		$html .= "<nav id=\"navigation\">\n<ul>\n";

		foreach( $res as $row )
		{
			$db__id = $row[ 'id' ];
			$db__num_order = $row[ 'num_order' ];
			$db__toplevel_id = $row[ 'toplevel_id' ];
			$db__parent_id = $row[ 'parent_id' ];
			$db__type = $row[ 'type' ];
			$db__title = $row[ 'title' ];
			$db__sub_title = $row[ 'sub_title' ];
			$db__publish = $row[ 'publish' ];

			if( $pa == $db__id || $db__active__toplevel_id == $db__id )
			{
				$active_menu_style = ' class="active-menu"';
			}
			else
			{
				$active_menu_style = '';
			}

			if( $db__toplevel_id == 0 && $db__publish == 1 )
			{
				$html .= "<li${active_menu_style}><a href=\"./?pa=${db__id}\">${db__title}<span>${db__sub_title}</span></a></li>\n";
			}
		}

		$html .= "</ul>\n</nav><!--// #navigation -->\n";

		return $html;
	}


/**** Sub Menus ****/

	function subMenus( $pdo, $pa )
	{
		$html = null;
		$file = null;

		$query = "SELECT * FROM `pages` WHERE `parent_id` = ${pa} ORDER BY `num_order` ASC";
		$res = $pdo -> query( $query );
		$res -> execute();
		$rows = $res -> rowCount();

		if( $rows > 0 )
		{
			$html .= "<nav id=\"sub-menus\">\n<ul>\n";

			foreach( $res as $row )
			{
				$db__id = $row[ 'id' ];
				$db__num_order = $row[ 'num_order' ];
				$db__toplevel_id = $row[ 'toplevel_id' ];
				$db__parent_id = $row[ 'parent_id' ];
				$db__type = $row[ 'type' ];
				$db__publish = $row[ 'publish' ];
				$db__title = $row[ 'title' ];
				$db__sub_title = $row[ 'sub_title' ];

				$path = "resources/img/pages/${db__id}/";

				if( file_exists( $path ) )
				{
					if( is_dir( $path ) )
					{
				    if( $handle = opendir( $path ) )
				    {
				    	$count = 0;
				    	$files = [];

			        while( ( $file = readdir( $handle ) ) !== false )
			        {
			        	if ( $file != '.' && $file != '..' && $file != '.DS_Store' )
			        	{
			        		$files[ $count ] = $file;
			        	}

			        	$count ++;
			        }

			        sort( $files );

			        $file = $files[ 0 ];

			        closedir( $handle );
				    }
					}
				}

				if( $db__publish == 1 )
				{
					$html .= <<< EOF
						<style>
							.sub-menu-${db__id} a {
								background-image: url("${path}${file}");
								background-size: 100% auto;
							} 
						</style>
						<li class="sub-menu-${db__id}">
							<a href="?pa=${db__id}" class="clickable">
								<div class="menu-shadow">
									<span class="main">${db__title}</span>
									<span class="sub">${db__sub_title}</span>
								</div><!--// .menu-shadow -->
							</a>
						</li>
					EOF;
				}
			}

			$html .= "</ul>\n</nav><!--// #sub-menus -->\n";

			return $html;
		}
	}


/**** Images ****/

	function images( $type, $id )
	{
		$html = null;

		if( $type == 1 )
		{
			$dir = 'posts';
			$class = 'post-images';
		}
		elseif( $type == 2 )
		{
			$dir = 'posts';
			$class = 'post-detail-images';
		}
		else
		{
			$dir = 'pages';
			$class = 'page-images';
		}

		$path = "resources/img/${dir}/${id}/";

		if( file_exists( $path ) )
		{
			if( is_dir( $path ) )
			{
		    if( $handle = opendir( $path ) )
		    {
		    	$html .= "<div class=\"images ${class}\">\n";

		    	$count = 0;
		    	$files = [];

	        while( ( $file = readdir( $handle ) ) !== false )
	        {
	        	if ( $file != '.' && $file != '..' && $file != '.DS_Store' )
	        	{
	        		$files[ $count ] = $file;
	        	}

	        	$count ++;
	        }

	        sort( $files );

	        foreach( $files as $file )
      		{
						if( $type == 1 )
						{
							$start_tag= "";
							$end_tag = "";
						}
						else
						{
							$start_tag = "<a href=\"${path}${file}\" target=\"_blank\" class=\"clickable\">";
							$end_tag = "</a>";
						}

      			$html .= "${start_tag}<img src=\"${path}${file}\">${end_tag}\n";

      			if( $type == 1 )
      			{
      				break;
      			}
      		}

	        closedir( $handle );

	        $html .= "</div><!--// .post-images -->\n";

	        return $html;
		    }
			}
		}
	}


/**** Breadcrumb Navigation ****/

	function breadNav( $pdo, $type, $id )
	{
		$html = null;

		if( $type == 'pa' )
		{
			$table = 'pages';
		}
		elseif( $type == 'po' )
		{
			$table = 'posts';
		}
		else
		{
			$table = null;
		}

		if( isset( $type ) && isset( $id ) )
		{
			$pa__query = "SELECT * FROM `${table}` WHERE `id` = ${id}";
			$pa__res = $pdo -> query( $pa__query );
			$pa__res -> execute();
			$pa__rows = $pa__res -> rowCount();

			if( $pa__rows > 0 )
			{
				$pa__row = $pa__res -> fetch( PDO::FETCH_ASSOC );

				$db__pa__id = $pa__row[ 'id' ];
				$db__pa__parent_id = $pa__row[ 'parent_id' ];

				if( $db__pa__parent_id > 0 )
				{
					$ch__query = "SELECT * FROM `pages` WHERE `id` = ${db__pa__parent_id}";
					$ch__res = $pdo -> query( $ch__query );
					$ch__res -> execute();
					$ch__rows = $ch__res -> rowCount();
					$ch__row = $ch__res -> fetch( PDO::FETCH_ASSOC );

					$db__ch__id = $ch__row[ 'id' ];
					$db__ch__parent_id = $ch__row[ 'parent_id' ];
					$db__ch__title = $ch__row[ 'title' ];
					$db__ch__sub_title = $ch__row[ 'sub_title' ];

					$html .= breadNav( $pdo, 'pa', $db__ch__id );

					$html .= "<li><a href=\"?pa=${db__ch__id}\"><span class=\"main\">${db__ch__title}</span><span class=\"sub\">${db__ch__sub_title}</span></a><div class=\"arrow\">>></div></li>\n";

					return $html;
				}
			}
		}
	}


/**** Breadcrumb ****/

	function breadcrumb( $pdo, $pa, $po )
	{
		$html = null;

		if( isset( $pa ) )
		{
			$type = 'pa';
			$id = $pa;
			$table = 'pages';
		}
		elseif( isset( $po ) )
		{
			$type = 'po';
			$id = $po;
			$table = 'posts';
		}
		else
		{
			$type = null;
			$id = null;
			$table = null;
		}

		$query = "SELECT * FROM `${table}` WHERE `id` = ${id}";
		$res = $pdo -> query( $query );
		$res -> execute();
		$rows = $res -> rowCount();
		$row = $res -> fetch( PDO::FETCH_ASSOC );

		$db__id = $row[ 'id' ];
		$db__parent_id = $row[ 'parent_id' ];
		$db__title = $row[ 'title' ];
		$db__sub_title = $row[ 'sub_title' ];

		if( $db__parent_id > 0 )
		{
			$html .= "<nav id=\"breadcrumb\">\n<ul>\n";
			$html .= breadNav( $pdo, $type, $id );
			$html .= "<li><a href=\"?${type}=${db__id}\"><span class=\"main\">${db__title}</span><span class=\"sub\">${db__sub_title}</span></a></li>\n";
			$html .= "</ul>\n</nav>\n";
		}

		return $html;
	}


/**** Search Form ****/

	function searchForm( $pa, $values )
	{
		$get__pa = $values[ 0 ];
		$get__submit = $values[ 1 ];
		$get__start_id = $values[ 2 ];
		$get__end_id = $values[ 3 ];
		$get__start_created_at = $values[ 4 ];
		$get__end_created_at = $values[ 5 ];
		$get__start_updated_at = $values[ 6 ];
		$get__end_updated_at = $values[ 7 ];
		$get__keyword = $values[ 8 ];

		$html = null;

		$html = <<< EOF
			<form id="search-posts" method="get" action="./?pa=${get__pa}#search-posts">
			<h4 id="form-title">投稿記事検索</h4>
			<input name="pa" type="hidden" value="${get__pa}">
			<input name="submit" type="hidden" value="1">
				<div class="field id">
					<label>No.</label>
					<input name="start_id" type="number" value="${get__start_id}">
					<span> 〜 </span>
					<input name="end_id" type="number" value="${get__end_id}">
				</div><!--// .field -->
				<div class="field created_at">
					<label>登録日</label>
					<input name="start_created_at" type="date" value="${get__start_created_at}">
					<span> 〜 </span>
					<input name="end_created_at" type="date" value="${get__end_created_at}">
				</div><!--// .field -->
				<div class="field updated_at">
					<label>更新日</label>
					<input name="start_updated_at" type="date" value="${get__start_updated_at}">
					<span> 〜 </span>
					<input name="end_updated_at" type="date" value="${get__end_updated_at}">
				</div><!--// .field -->
				<div class="field keyword">
					<label>キーワード</label>
					<input name="keyword" type="text" value="${get__keyword}">
				</div><!--// .field -->
				<div class="submit">
					<input class="clickable" type="submit" value="Search">
					<input class="clickable" type="button" value="Clear" onClick="location.href='./?pa=${get__pa}#search-posts'">
				</div><!--// .submit -->
			</form><!--// #search-posts -->
		EOF;

		return $html;
	}


/**** Search Queries ****/

	function searchQueries( $values )
	{
		$where = '';

		$get__pa = $values[ 0 ];
		$get__submit = $values[ 1 ];
		$get__start_id = $values[ 2 ];
		$get__end_id = $values[ 3 ];
		$get__start_created_at = $values[ 4 ];
		$get__end_created_at = $values[ 5 ];
		$get__start_updated_at = $values[ 6 ];
		$get__end_updated_at = $values[ 7 ];
		$get__keyword = $values[ 8 ];

		//-- `id` check --//

			if( $get__start_id != '' || $get__end_id != '' )
			{
				if( $get__start_id != '' && $get__end_id != '' )
				{
					$where .= " `id` BETWEEN ${get__start_id} AND ${get__end_id} &&";
				}
				elseif( $get__start_id != '' && $get__end_id == '' )
				{
					$where .= " `id` >= ${get__start_id} &&";
				}
				elseif( $get__start_id == '' && $get__end_id != '' )
				{
					$where .= " `id` <= ${get__end_id} &&";
				}
			}

		//-- `created_at` check --//

			if( $get__start_created_at != '' || $get__end_created_at != '' )
			{
				if( $get__start_created_at != '' && $get__end_created_at != '' )
				{
					$where .= " `created_at` BETWEEN ${get__start_created_at} AND ${get__end_created_at} &&";
				}
				elseif( $get__start_created_at != '' && $get__end_created_at == '' )
				{
					$where .= " `created_at` >= ${get__start_created_at} &&";
				}
				elseif( $get__start_created_at == '' && $get__end_created_at != '' )
				{
					$where .= " `created_at` <= ${get__end_created_at} &&";
				}
			}

		//-- `updated_at` check --//

			if( $get__start_updated_at != '' || $get__end_updated_at != '' )
			{
				if( $get__start_updated_at != '' && $get__end_updated_at != '' )
				{
					$where .= " `created_at` BETWEEN ${get__start_updated_at} AND ${get__end_updated_at} &&";
				}
				elseif( $get__start_updated_at != '' && $get__end_updated_at == '' )
				{
					$where .= " `created_at` >= ${get__start_updated_at} &&";
				}
				elseif( $get__start_updated_at == '' && $get__end_updated_at != '' )
				{
					$where .= " `created_at` <= ${get__end_updated_at} &&";
				}
			}

		//-- `title`, `sub_title`, `description` keyword check --//

			if( $get__keyword != '' )
			{
				$where .= " ( `title` LIKE '%${get__keyword}%' || `sub_title` LIKE '%${get__keyword}%' || `description` LIKE '%${get__keyword}%' ) &&";
			}


			if( $get__submit > 0 )
			{
				$where = ' && ' . substr_replace( $where, '', -2 );
			}
			else
			{
				$where = '';
			}

			return $where;
	}


/**** Page Contents ****/

	function pages( $pdo, $pa, $pn, $values, $request_uri )
	{
		$html = null;
		$images = null;
		$title = null;
		$sub_title = null;
		$dir = null;
		$plugins = null;

		$query = "SELECT * FROM `pages` WHERE `id` = ${pa}";
		$res = $pdo -> query( $query );
		$res -> execute();
		$rows = $res -> rowCount();

		foreach( $res as $row )
		{
			$db__id = $row[ 'id' ];
			$db__num_order = $row[ 'num_order' ];
			$db__toplevel_id = $row[ 'toplevel_id' ];
			$db__parent_id = $row[ 'parent_id' ];
			$db__type = $row[ 'type' ];
			$db__created_at = $row[ 'created_at' ];
			$db__updated_at = $row[ 'updated_at' ];
			$db__publish = $row[ 'publish' ];
			$db__title = $row[ 'title' ];
			$db__sub_title = $row[ 'sub_title' ];
			$db__description = $row[ 'description' ];

			if( $db__publish == 1 )
			{
				$images = images( 0, $pa );

				if( isset( $db__sub_title ) )
				{
					$el__sub_title = "<span>${db__sub_title}</span>\n";
				}

				if( isset( $db__title ) )
				{
					$el__title = "<h3 id=\"page-title\">${db__title}${el__sub_title}</h3>\n";
				}

				if( isset( $db__description ) )
				{
					$el__description = "<p id=\"page-description\">${db__description}</p>\n";
				}

				$html .= <<< EOF
					<div id="page">
						${images}
						<div id="page-content">
							${el__title}
							${el__description}
						</div><!--// #page-content -->
					</div><!--// #page -->
				EOF;
			}
		}

		$html .= subMenus( $pdo, $pa );

		if( $db__type == 1 )
		{
			$html .= searchForm( $pa, $values );
		}

		$html .= posts( $pdo, $pa, $pn, $values, $request_uri );

		return $html;
	}


/**** Pagination ****/

	function pagination( $pdo, $pa, $pn, $values, $request_uri )
	{
		$html = null;
		$where = null;

		if( !isset( $pn ) )
		{
			$pn = 0;
		}

		$where = searchQueries( $values );

		$query = "SELECT * FROM `posts` WHERE `parent_id` = ${pa} ${where}";
		$res = $pdo -> query( $query );
		$res -> execute();
		$rows = $res -> rowCount();

		if( $rows > NUM_OF_PAGING )
		{
			$html .= "<nav id=\"pagination\">\n<ul>\n";

			$division = floor( $rows / NUM_OF_PAGING );
			$surplus = $rows % NUM_OF_PAGING;

			$paging_num = $division + $surplus;

			for( $i = 0; $i < $paging_num; $i ++ )
			{
				$paging_count = NUM_OF_PAGING * $i;
				$pagination_num = $i + 1;

				if( $pn == $paging_count )
				{
					$active_style = 'active-peging';
				}
				else
				{
					$active_style = '';
				}

				$html .= "<li><a class=\"clickable ${active_style}\" href=\"${request_uri}&pa=${pa}&pn=${paging_count}#search-posts\">${pagination_num}</a></li>\n";
			}

			$html .= "</ul>\n</nav>\n";

			return $html;
		}
	}


/**** Post Contents ****/

	function posts( $pdo, $pa, $pn, $values, $request_uri )
	{
		$search_query = null;
		$html = null;
		$images = null;
		$title = null;
		$sub_title = null;
		$dir = null;
		$where = null;

		$where = searchQueries( $values );

		$query_all = "SELECT * FROM `posts` WHERE `parent_id` = ${pa}";
		$res_all = $pdo -> query( $query_all );
		$res_all -> execute();
		$rows_all = $res_all -> rowCount();

		$query_where = "SELECT * FROM `posts` WHERE `parent_id` = ${pa} ${where}";
		$res_where = $pdo -> query( $query_where );
		$res_where -> execute();
		$rows_where = $res_where -> rowCount();

		$query = "SELECT * FROM `pages` WHERE `id` = ${pa}";
		$res = $pdo -> query( $query );
		$res -> execute();
		$pages_row = $res -> fetch( PDO::FETCH_ASSOC );
		$db__pages_type = $pages_row[ 'type' ];

		if( $db__pages_type == 1 )
		{
			$html .= "<p id=\"num-of-hits\">該当 " . $rows_where . " 件 / 全体 " . $rows_all . " 件</p>\n";
		}

		if( !isset( $pn ) )
		{
			$pn = 0;
		}

		$query_limit = "SELECT * FROM `posts` WHERE `parent_id` = ${pa} ${where} LIMIT ${pn}, " . NUM_OF_PAGING;
		$res_limit = $pdo -> query( $query_limit );
		$res_limit -> execute();
		$rows_limit = $res_limit -> rowCount();

		if( $rows_where > 0 )
		{
			$html .= "<div id=\"posts\">\n";

			foreach( $res_limit as $row )
			{
				$db__id = $row[ 'id' ];
				$db__num_order = $row[ 'num_order' ];
				$db__toplevel_id = $row[ 'toplevel_id' ];
				$db__parent_id = $row[ 'parent_id' ];
				$db__created_at = $row[ 'created_at' ];
				$db__updated_at = $row[ 'updated_at' ];
				$db__publish = $row[ 'publish' ];
				$db__title = $row[ 'title' ];
				$db__sub_title = $row[ 'sub_title' ];
				$db__description = $row[ 'description' ];

				if( mb_strlen( $db__description ) > POSTS_DESCRIPTION_TEXT_QUANTITY )
				{
					$dis__description = mb_substr( $row[ 'description' ], 0, POSTS_DESCRIPTION_TEXT_QUANTITY ) . " ...\n";
				}
				else
				{
					$dis__description = $db__description;
				}

				if( $db__publish == 1 )
				{
					$images = images( 1, $db__id );

					if( isset( $db__sub_title ) )
					{
						$el__sub_title = "<span>${db__sub_title}</span>\n";
					}

					if( isset( $db__title ) )
					{
						$el__title = "<h4 class=\"post-title\">${db__title}${el__sub_title}</h4>\n";
					}

					if( isset( $db__description ) )
					{
						$el__description = "<p class=\"post-description\">${dis__description}</p>\n";
					}

					$html .= <<< EOF
						<a href="?po=${db__id}" class="post">
							${images}
							<div class="post-content">
								${el__title}
								${el__description}
							</div><!--// .content -->
						</a><!--// .post-content -->
					EOF;
				}
			}

			$html .= "</div>\n";

			$html .= pagination( $pdo, $pa, $pn, $values, $request_uri );
		}

		return $html;
	}


/**** Post Detail ****/

	function postDetail( $pdo, $po )
	{
		$html = null;
		$images = null;
		$title = null;
		$sub_title = null;
		$dir = null;

		$query = "SELECT * FROM `posts` WHERE `id` = ${po}";
		$res = $pdo -> query( $query );
		$res -> execute();
		$row = $res -> fetch( PDO::FETCH_ASSOC );

		$db__id = $row[ 'id' ];
		$db__num_order = $row[ 'num_order' ];
		$db__toplevel_id = $row[ 'toplevel_id' ];
		$db__parent_id = $row[ 'parent_id' ];
		$db__created_at = $row[ 'created_at' ];
		$db__updated_at = $row[ 'updated_at' ];
		$db__publish = $row[ 'publish' ];
		$db__title = $row[ 'title' ];
		$db__sub_title = $row[ 'sub_title' ];
		$db__description = $row[ 'description' ];

		$pa__query = "SELECT * FROM `pages` WHERE `id` = ${db__parent_id}";
		$pa__res = $pdo -> query( $pa__query );
		$pa__res -> execute();
		$pa__row = $pa__res -> fetch( PDO::FETCH_ASSOC );

		$db__pa__title = $pa__row[ 'title' ];
		$db__pa__sub_title = $pa__row[ 'sub_title' ];

		if( $db__publish == 1 )
		{
			$images = images( 2, $db__id );

			if( isset( $db__sub_title ) )
			{
				$el__sub_title = "<span>${db__sub_title}</span>\n";
			}

			if( isset( $db__title ) )
			{
				$el__title = "<h4 class=\"post-title\">${db__title}${el__sub_title}</h4>\n";
			}

			if( isset( $db__description ) )
			{
				$el__description = "<p class=\"post-description\">${db__description}</p>\n";
			}

			$el__title_start = "<span class=\"start\"><<</span>";

			if( isset( $db__pa__title ) )
			{
				$el__pa__title = "<span class=\"main\">${db__pa__title}</span>";
			}

			if( isset( $db__pa__sub_title ) )
			{
				$el__pa__sub_title = "<span class=\"sub\">${db__pa__sub_title}</span>";
			}

			$el__title_end = "<span class=\"end\">一覧へ戻る</span>";

			if( isset( $db__pa__title ) )
			{
				$el__return_to_posts = "<a href=\"?pa=${db__parent_id}\" class=\"return-to-posts\">${el__title_start}${el__pa__title}${el__pa__sub_title}${el__title_end}</a>";
			}

			$html .= <<< EOF
				<div class="post-detail">
					${images}
					<div class="post-content">
						${el__return_to_posts}
						${el__title}
						${el__description}
					</div><!--// .post-content -->
				</div><!--// .post-detail -->
			EOF;
		}

		$html .= "</div>\n";

		return $html;
	}


/**** Post Detail ****/

	function contact( $tr )
	{
		if( $tr == 1 )
		{

		}
	}

?>