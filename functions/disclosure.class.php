<?php

/* function to define all the path which used for to defined the disclosure policy plugins */ 
function dpp_path_define()
{
    define('DISCLOSURE_SCRIPT_PATH', 		ABSPATH . 'wp-content/plugins/' . dirname(plugin_basename(__FILE__)));
	define('DISCLOSURE_URL',				get_bloginfo('url') . 	'/wp-content/plugins/disclosure');
	define('DISCLOSURE_JS_URL', 			DISCLOSURE_URL . 			'/js/toggle1.js');
	define('DISCLOSURE_IMAGES_URL', 		DISCLOSURE_URL . 			'/images');
	define('DISCLOSURE_SCRIPTACULOUS_URL', 	DISCLOSURE_URL . 			'/scriptaculous');
	define('DISCLOSURE_SCRIPT_URL', 		DISCLOSURE_URL . 			'/functions');
	define('dpp_disclosure_tags_TABLE',$table_prefix1 . 'disclosure_tags');
	define('dpp_keywords_settings_TABLE',$table_prefix1 . 'keyword_settings');
	require_once(DISCLOSURE_CLASS_PATH . '/disclosure_keywords.php');
	require_once(DISCLOSURE_SCRIPT_PATH . '/SLLists.class.php');
	$table_prefix1 = 'dpp_';
} 
 
/* function used to get all the saved keywords details from the Database */   
function dpp_fetch_keywords()
{
  global $wpdb, $pagenow, $user_ID;
  $table_prefix1 = 'dpp_';
  $request = "SELECT  distinct * FROM " . $table_prefix1.dpp_disclosure_tags_TABLE ;
  $posts = $wpdb->get_results($request);
  return $posts;
}	

/* function used to get the saved keywords details from the Database on the basic of their uniqyue Id for the Preview window */   
function dpp_fetch_keywords_id($id)
{
  global $wpdb, $pagenow, $user_ID;
  $table_prefix1 = 'dpp_';
  $request = "SELECT  distinct * FROM " . $table_prefix1.dpp_disclosure_tags_TABLE . " where Id = $id ";
  $posts = $wpdb->get_results($request);
  return $posts;
}	

/* function to get the setting options from the database */
function dpp_fetch_settings()
{
  global $wpdb;
  $table_prefix1 = 'dpp_';
  $request = "SELECT  distinct * FROM " . $table_prefix1.dpp_keywords_settings_TABLE ; 
  $settings = $wpdb->get_results($request);
  return $settings;  
}	
?>