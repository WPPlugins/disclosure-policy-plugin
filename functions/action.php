<?php

/* function used for the insert keywords from the admin disclosure/disclosure-policy.php page into database */
function dpp_insert_keywords($postarr = array()) {
	global $wpdb, $wp_rewrite, $allowedtags, $user_ID;
	$table_prefix1 = "dpp_";

	if ( is_object($postarr) )
		$postarr = get_object_vars($postarr);

	// export array as variables
	extract($postarr);
	
	// Get the basics.
	$tags_keywords       = apply_filters('tags_save_pre',     $tags_keywords);
	$tags_name           = apply_filters('company_name_save_pre',   $tags_name);
	$tags_url            = apply_filters('company_url_save_pre',   $tags_url);
	$tags_description    = apply_filters('tags_description_save_pre',   $tags_description);
	$tags_display        = apply_filters('tags_display_save_pre',   $tags_display);
	$display             = apply_filters('tags_display_save_pre',   $display);
	
	$create_date = date("F j, Y, g:i a");
	
	$wpdb->query(
			"INSERT IGNORE INTO `" . $table_prefix1.dpp_disclosure_tags_TABLE . "`
			(company_tags,company_name,url,description,create_date,display_tags,display)
			VALUES
			('$tags_keywords','$tags_name','$tags_url','$tags_description','$create_date','$tags_display','$display')");
}

/* function used for the update keywords from the disclosure-policy.php page */
function dpp_update_keywords($postarr = array()) {
	global $wpdb, $wp_rewrite, $allowedtags, $user_ID;
    $table_prefix1 = "dpp_";

	if ( is_object($postarr) )
		$postarr = get_object_vars($postarr);

	extract($postarr);

	$tags_keywords       = apply_filters('tags_save_pre',     $tags_keywords);
	$tags_name           = apply_filters('company_name_save_pre',   $tags_name);
	$tags_url            = apply_filters('company_url_save_pre',   $tags_url);
	$tags_description    = apply_filters('tags_description_save_pre',   $tags_description);
	$tags_display        = apply_filters('tags_display_save_pre',   $tags_display);
	$display             = apply_filters('tags_display_save_pre',   $display);
	$tags_ID = (int) $tags_ID;
	$create_date = date("F j, Y, g:i a");
	
	$wpdb->query(
			"UPDATE IGNORE `" . $table_prefix1.dpp_disclosure_tags_TABLE . "` SET
			company_tags = '$tags_keywords',
			company_name = '$tags_name',
			url = '$tags_url',
			description = '$tags_description',
			create_date = '$create_date',
			display_tags = '$tags_display',
			display = '$display'
			WHERE Id = $tags_ID");
}

/* function used to get all the keywords and their details from the disclosure-policy.php to save in database */
function dpp_write_keywords($action)
	{
	  global $user_ID;

	  // Tags and description of keyswords
		  $_POST['tags_keywords'] = $_POST['keywords'];
		  $_POST['tags_name'] = $_POST['name'];
		  $_POST['tags_url'] = $_POST['url'];
		  $_POST['tags_description'] = $_POST['description'];
		  $_POST['tags_ID'] = $_POST['tagsID'];
	
     // Status of all Extra Content Tags
	     if(isset($_POST['display']))
		 {
		    $_POST['tags_display'] = "yes";
		 }
		 else
		 {
		   	$_POST['tags_display'] = "no";
		 }		
		 
		 if(isset($_POST['displaytext']))
		 {
		    $_POST['display'] = "yes";
		 }
		 else
		 {
		   	$_POST['display'] = "no";
		 }
		 
	 // Call of the defined function for manipulation of keywords from the database
		 if ($action == "insert")
		 $keywords_ID = dpp_insert_keywords($_POST);  
		 if ($action == "delete")
		 $keywords_ID = dpp_delete_keywords($_POST);
	}

/* fuction used for redirect hte page again to disclosure-policy.php */
function dpp_redirect($location)
{
  header("Location: $location");
}  

/* Call all the above defined function for manipulation of keywords into database on the button set commands */
if(isset($_POST['insert']))
{
   $blogUrl = $_POST['blog_url'];
   $abspath = $_POST['abspath'];
   require_once($abspath . '/wp-config.php');
   define('dpp_disclosure_tags_TABLE',$table_prefix . 'disclosure_tags');
   $action = "insert";
   dpp_write_keywords($action);
   $location = $blogUrl."/wp-admin/admin.php?page=disclosure/disclosure-policy.php";
   dpp_redirect($location);
   exit();
} 

if(isset($_POST['delete']))
{
   $blogUrl = $_POST['blog_url'];
   $abspath = $_POST['abspath'];
   require_once($abspath . '/wp-config.php');
   define('dpp_disclosure_tags_TABLE',$table_prefix . 'disclosure_tags');
   $action = "delete";
   dpp_write_keywords($action);
   $location = $blogUrl."/wp-admin/admin.php?page=disclosure/disclosure-policy.php";
   dpp_redirect($location);
   exit();
} 

if(isset($_GET['delete']))
{
   global $wpdb, $wp_rewrite, $allowedtags, $user_ID;
   	$table_prefix1 = "dpp_";

	$tags_ID = (int) $_GET['id'];
    $abspath = $_GET['abspath'];
	$blogUrl = $_GET['blog_url'];
    require_once($abspath . '/wp-config.php');
   
   $wpdb->query("DELETE FROM `" . $table_prefix1.dpp_disclosure_tags_TABLE . "` WHERE Id = $tags_ID");
   $location = $blogUrl."/wp-admin/admin.php?page=disclosure/disclosure-policy.php";
   dpp_redirect($location);
   exit();
} 

if(isset($_POST['update']))
{
    $id = $_POST['tagsID'];
    $_POST['tags_ID'] = $id;
    $_POST['tags_keywords'] = $_POST['keywords'.$id];
    $_POST['tags_name'] = $_POST['name'.$id];
    $_POST['tags_url'] = $_POST['url'.$id];
    $_POST['tags_description'] = $_POST['description'.$id];
	
   // Status of all Extra Content Tags
	if(isset($_POST['display'.$id]))
	{
	  $_POST['tags_display'] = "yes";
	}
	else
	{
      $_POST['tags_display'] = "no";
    }		
	
	if(isset($_POST['displaytext'.$id]))
	{
	  $_POST['display'] = "yes";
	}
	else
	{
      $_POST['display'] = "no";
    }

   $blogUrl = $_POST['blog_url'];
   $abspath = $_POST['abspath'];
   require_once($abspath . '/wp-config.php');
   define('dpp_disclosure_tags_TABLE',$table_prefix . 'disclosure_tags');
   $keywords_ID = dpp_update_keywords($_POST);
   $location = $blogUrl."/wp-admin/admin.php?page=disclosure/disclosure-policy.php&edit=edit&id=$id";
   dpp_redirect($location);
   exit();
} 

if(isset($_REQUEST['sorting']))
{
   $blogUrl = $_REQUEST['blog_url'];
   $abspath = $_REQUEST['abspath'];
   require_once($abspath . '/wp-config.php');
   define('dpp_disclosure_tags_TABLE',$table_prefix . 'disclosure_tags');
   
    $id1 = $_REQUEST['orgid'];
    $id2 = $_REQUEST['changeid'];
	//echo $id1."   ".$id2;
	if($id1 == "1x" || $id2 == "1x" || $id1 == "" || $id2 == "")
	{}
	else{
	$query1 = "SELECT  distinct * FROM " . $table_prefix1.dpp_disclosure_tags_TABLE . " where Id = $id1";
	$query2 = "SELECT  distinct * FROM " . $table_prefix1.dpp_disclosure_tags_TABLE . " where Id = $id2";
	
	$settings1 = $wpdb->get_results($query1);
	$settings2 = $wpdb->get_results($query2);
	foreach ($settings1 as $values1)
	{
	   $c_tags1 = $values1->company_tags;
	   $c_name1 = $values1->company_name;
	   $c_url1 = $values1->url;
	   $c_description1 = $values1->description;
	   $c_date1 = $values1->create_date;
	   $c_display_tags1 = $values1->display_tags;
	   $c_display1 = $values1->display;
	}
	foreach ($settings2 as $values2)
	{
	   $c_tags2 = $values2->company_tags;
	   $c_name2 = $values2->company_name;
	   $c_url2 = $values2->url;
	   $c_description2 = $values2->description;
	   $c_date2 = $values2->create_date;
	   $c_display_tags2 = $values2->display_tags;
	   $c_display2 = $values2->display;
	}
	$wpdb->query(
				"UPDATE IGNORE `" . $table_prefix1.dpp_disclosure_tags_TABLE . "` SET
				company_tags = '$c_tags2',
				company_name = '$c_name2',
				url = '$c_url2',
				description = '$c_description2',
				create_date = '$c_date2',
				display_tags = '$c_display_tags2',
				display = '$c_display2'
				WHERE Id = $id1");
				
	$wpdb->query(
				"UPDATE IGNORE `" . $table_prefix1.dpp_disclosure_tags_TABLE . "` SET
				company_tags = '$c_tags1',
				company_name = '$c_name1',
				url = '$c_url1',
				description = '$c_description1',
				create_date = '$c_date1',
				display_tags = '$c_display_tags1',
				display = '$c_display1'
				WHERE Id = $id2");
	 }
   $location = $blogUrl."/wp-admin/admin.php?page=disclosure/disclosure-policy.php";
   dpp_redirect($location);
   exit();
} 
?>