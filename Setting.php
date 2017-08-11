<?php 

  if(isset($_POST['update1']))
  {    
     global $wpdb;
	 $start_input = $_POST['input_start'];
	 $end_input = $_POST['input_end'];
     if(isset($_POST['nodeletewarning']))
	 {
	    $deletewarning = "checked";
	 }
	 else {
	 	$deletewarning = "unchecked";
	 }
	 
	 if(isset($_POST['casesensitive']))
	 {
	    $casesense = "checked";
	 }
	 else {
	 	$casesense = "unchecked";
	 }
	 
	 if(isset($_POST['newwindow']))
	 {
	    $newwin = "checked";
	 }
	 else {
	 	$newwin = "unchecked";
	 }
	 $wpdb->query(
			"UPDATE " . $table_prefix1.dpp_keywords_settings_TABLE . " SET
			new_window = '$newwin',
			case_sensitive = '$casesense',
			warn_delete = '$deletewarning',
			input_start = '$start_input',
			input_end = '$end_input'
			");
  } 
?>
  	 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Plugins &rsaquo; Disclosure Policy Plugins &#8212; WordPress</title>

<script type="text/javascript" src="../wp-includes/js/fat.js"></script>

<style type="text/css">* html { overflow-x: hidden; }</style>
</head>
<body>
<form name="form" action="<?php echo $_SERVER[’PHP_SELF’]; ?>" method="post" >

<div class="wrap"> 
	<h2>Options</h2>
	
	    <h3 style="border-bottom: #CCC 1px solid;" class="dbx-handle">Settings</h3>
		<br>
		<table class="optiontable"> 

		      <?php
					$settings = dpp_fetch_settings();
					foreach($settings as $setting)
					{
					  $new_window = $setting->new_window;
					  $case_sensitive = $setting->case_sensitive;
					  $warn_delete = $setting->warn_delete;
					  $input_start = $setting->input_start;
					  $input_end = $setting->input_end;
					}  
   		      ?>
			<tr valign="top"> 
			<th scope="row">Open links in new window: </th> 
			<td><input type="checkbox" name="newwindow" id="newwindow" <?php if($new_window == "checked") echo 'checked="checked"'; ?>/></td> 
			</tr>

			<tr valign="top"> 
			<th scope="row">Keywords are case sensitive: </th> 
			<td><input type="checkbox" name="casesensitive" id="casesensitive" <?php if($case_sensitive == "checked") echo 'checked="checked"'; ?>/></td>
			</tr>

			<tr valign="top"> 
			<th scope="row">Don't warn on keywords delete: </th> 
			<td><input type="checkbox" name="nodeletewarning" id="nodeletewarning" <?php if($warn_delete == "checked") echo 'checked="checked"'; ?>/></td>
			</tr>
			
			<tr valign="top"> 
			<th scope="row">Insert Start Div Tags: </th> 
			<td><textarea name="input_start"><?php echo $input_start; ?></textarea></td>
			</tr>
			
			<tr valign="top"> 
			<th scope="row">Insert End Div Tags: </th> 
			<td><textarea name="input_end"><?php echo $input_end; ?></textarea></td>
			</tr>

		</table>
		<p class="submit"><input type="submit" name="update1" value="Update Settings &raquo;" /></p>
		

</div> 
<div id="footer"><p>&nbsp;</p>
</div>

		<script type="text/javascript">if(typeof wpOnload=='function')wpOnload();</script>

</form>
</body>
</html>
