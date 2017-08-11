<?php

/*

Plugin Name: Disclosure Policy Plugin
Version: 1.0
Plugin URI: http://www.disclosurepolicyplugin.com
Description: An interface to manage disclosure, legal and business relationships in both Wordpress posts and RSS feeds
Author: Andy Beard
Author URI: http://andybeard.eu
                                              
*/

define('DISCLOSURE_PATH', 	ABSPATH . 'wp-content/plugins/' . dirname(plugin_basename(__FILE__)));
define('DISCLOSURE_CLASS_PATH', 	DISCLOSURE_PATH.'/functions');
require_once(DISCLOSURE_CLASS_PATH . '/disclosure.class.php');

dpp_path_define();
$table_prefix1 = "dpp_";
define('dpp_disclosure_tags_TABLE',$table_prefix1 . 'dpp_disclosure_tags');
define('dpp_keywords_settings_TABLE',$table_prefix1 . 'dpp_keyword_settings');

$tableExists = false;

$tables = $wpdb->get_results("show tables;");

foreach ( $tables as $table )
{
	foreach ( $table as $value )
	{
		if ( $value == $table_prefix1.dpp_disclosure_tags_TABLE )
		{
			$tableExists=true;
			break;
		}
		if ( $value == $table_prefix1.dpp_keywords_settings_TABLE )
		{
			$tableExists=true;
			break;
		}
	}
}

if ( !$tableExists )
{
	$sql = "CREATE TABLE `" . $table_prefix1.dpp_disclosure_tags_TABLE . "` (
	  `Id` int(11) NOT NULL auto_increment,
	  `company_tags` varchar(250) NOT NULL,
	  `company_name` varchar(250) NOT NULL,
	  `url` varchar(250) NOT NULL,
	  `description` text NOT NULL,
	  `create_date` varchar(50) NOT NULL,
	  `display_tags` varchar(20) NOT NULL,
	  `display` varchar(20) NOT NULL,
	   PRIMARY KEY  (`Id`)
	)";
	$wpdb->get_results($sql); 
	
	$sql = "CREATE TABLE `" . $table_prefix1.dpp_keywords_settings_TABLE . "` (
	  `new_window` varchar(10) NOT NULL,
      `case_sensitive` varchar(10) NOT NULL,
      `warn_delete` varchar(10) NOT NULL,
	  `input_start` text NOT NULL,
      `input_end` text NOT NULL
	)";
	$wpdb->get_results($sql); 
	
	$sql = "INSERT INTO `" . $table_prefix1.dpp_keywords_settings_TABLE . "` (`new_window`, `case_sensitive`, `warn_delete`, `input_start`, `input_end`) VALUES ('unchecked', 'unchecked', 'unchecked', '', '')";
	$wpdb->get_results($sql);
}

function dpp_disclosure_admin_menu($content)
{
	global $submenu;
	add_menu_page('Disclosure Policy','Disclosure Policy',9, DISCLOSURE_PATH . '/disclosure-policy.php');
	add_submenu_page(DISCLOSURE_PATH . '/disclosure-policy.php', 'Keywords', 'Options', 8, DISCLOSURE_PATH . '/Setting.php');
}

add_action('admin_menu', 'dpp_disclosure_admin_menu');

/* Function call to Publish Post Keywords Below, The Blog Post */
$dpp_post_keywords = new dpp_post_keywords();
add_filter('the_content', 		array(&$dpp_post_keywords, 'dpp_search_keywords'), 9);

?>