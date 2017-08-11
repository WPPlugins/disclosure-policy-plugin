<?php
$path = DISCLOSURE_SCRIPTACULOUS_URL;
$sortableLists = new SLLists($path);
$sortableLists->addList('divContainer','divOrder','div');
$sortableLists->debug = true;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
$sortableLists->printTopJS();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<script src="<?php echo DISCLOSURE_JS_URL;?>"></script>
<script type="text/javascript">
   function change_image(id)
  {
      name = 'close'+id;
	  var image = document.getElementById(name).src;
	  if(image == "<?php echo DISCLOSURE_IMAGES_URL; ?>/icon2.jpg" )
	  {
	    document.getElementById(name).src = "<?php echo DISCLOSURE_IMAGES_URL; ?>/icon1.jpg";
	  }
	  else {
	    document.getElementById(name).src = "<?php echo DISCLOSURE_IMAGES_URL; ?>/icon2.jpg";
	  }	
  }	

function set_focus(key)
{
  //var start_pos = document.getElementById(key).selectionStart;
  document.getElementById(key).focus();
  //alert(start_pos);
  //document.getElementById(key).selectionEnd=2;
}  
</script>

<body>
<form name="form" action="<?php echo DISCLOSURE_URL; ?>/functions/action.php" method="post">
<?php
					$settings = dpp_fetch_settings();
					foreach($settings as $setting)
					{
					  $new_window = $setting->new_window;
					  $case_sensitive = $setting->case_sensitive;
					  $warn_delete = $setting->warn_delete;
					}  
?>
<input type="hidden" name="warn_tags" value="<?php echo $warn_delete; ?>">
<input type="hidden" name="blog_url" value="<?php echo get_bloginfo('url'); ?>" >
<input type="hidden" name="blog_js" value="<?php echo DISCLOSURE_SCRIPT_URL; ?>" >
<input type="hidden" name="abspath" value="<?php echo ABSPATH; ?>" >
<input type="hidden" name="tagsID" value="" >
<h1>
<style type="text/css">

.dbx-handle1  {
	padding: 3px 1em 2px;
	font-size: 12px;
	margin: 0;
	height:12px;
	margin-left: -12px;
	margin-bottom: 1px;
	color: #E3EFF5;
}

div#divContainer div {
	margin: 5px;
	padding: 2px;
	cursor: move;
}

div#preview1 {
	text-align:left;
	width:595px;
	height:140px;
	min-height:140px;
}
div#preview1x {
	text-align: left;
	width:595px;
}
div#InsertForm
{
    margin: 0px 20px 0px 20px;
	display: none;
	height:240px;
}

<?php
	$keyword = dpp_fetch_keywords();
	if($keyword == "")
	{}
	else {
	foreach($keyword as $keywords)
	{ 
?>
div#listForm<?php echo $keywords->Id; ?>
{
    margin: 0px 20px 0px 20px;
	display: none;
	height:150px;
}
div#EditForm<?php echo $keywords->Id; ?>
{
    margin: 0px 20px 0px 20px;
	display: none;
	height:320px;
}
div#preview3<?php echo $keywords->Id; ?> {
	width: 580px; /* hug */
	display:none;
	height:60px;
	min-height: 60px;
	overflow:scroll;
}
<?php }} ?>

</style>
</h1>

<div class="wrap"> 
	<h2>Keywords</h2>
	     <div id="divContainer">
		 <?php
			$keyword = dpp_fetch_keywords();
			if($keyword == "")
			{}
			else {
			foreach($keyword as $keywords)
			{ 
	     ?>
		
		<div id="<?php echo $keywords->Id; ?>" align="center">
		<table align="center" width="600" bgcolor="#2685af">
		 <tr>
		    <td><img src="<?php echo DISCLOSURE_IMAGES_URL; ?>/home .jpg" height="14" align="middle"></td>
		    <td width="825">
		    <h3 class="dbx-handle1" align="left"><?php echo $keywords->company_name; ?></h3></td>
			<td>
			   <a href="javascript:toggle('listForm<?php echo $keywords->Id; ?>','<?php echo $keywords->Id; ?>');" title="Open The Block" onclick="change_image('<?php echo $keywords->Id; ?>');"><img src="<?php echo DISCLOSURE_IMAGES_URL; ?>/icon2.jpg" align="middle" name="close<?php echo $keywords->Id; ?>" id="close<?php echo $keywords->Id; ?>"  height="14"></a></h3>
			</td>
			<td>
			   <a href="javascript:toggle1('EditForm<?php echo $keywords->Id; ?>','<?php echo $keywords->Id; ?>');" title="Edit The Block" > <img src="<?php echo DISCLOSURE_IMAGES_URL; ?>/icon3.jpg" align="middle" height="14" name="edit"></a></h3>
			</td>
			<td>
			   <img src="<?php echo DISCLOSURE_IMAGES_URL; ?>/close.jpg" title="Delete the Block" height="14" name="delete" onclick="return cross('<?php echo $keywords->Id; ?>');"></h3>
			</td>
		  </tr>
	    </table>					
		         <div id="listForm<?php echo $keywords->Id; ?>">  
							<div id='preview1' class='wrap'>
							  <strong><?php _e('Preview (Published Keywords)'); ?> <small class="quickjump"></small></strong>
							  <br>
							      <div style="padding-left:8px"><?php dpp_get_preview($_GET['post'],$keywords->Id); ?></div>
							</div>			
                 </div>
					<?php if(isset($_GET['edit']) && $_GET['id'] ==  $keywords->Id) { ?>	
					<div id="EditForm<?php echo $keywords->Id; ?>" style="display:block">  
							<!--<div> 	   -->
							    <table align="center" height="232">
							    <tr>
								  <td height="24" ><strong>Company Keywords:</strong></td>
								  <td nowrap="nowrap"><input type="text" name="keywords<?php echo $keywords->Id; ?>" id="keywords<?php echo $keywords->Id; ?>" value="<?php echo $keywords->company_tags; ?>" onclick="set_focus('keywords<?php echo $keywords->Id; ?>');" size="40" /></td>
								</tr>
								<tr>
								  <td ><strong>Company Name:</strong></td>
								  <td><input type="text" name="name<?php echo $keywords->Id; ?>" id="name<?php echo $keywords->Id; ?>" value="<?php echo $keywords->company_name; ?>" onclick="set_focus('name<?php echo $keywords->Id; ?>');" size="40"/></td>
								</tr>
								<tr>
								  <td ><strong>URL:</strong></td>
								  <td><input type="text" name="url<?php echo $keywords->Id; ?>" id="url<?php echo $keywords->Id; ?>" size="40" value="<?php echo $keywords->url; ?>" onclick="set_focus('url<?php echo $keywords->Id; ?>');" /></td>
								</tr>
								<tr>
								  <td height="97" ><strong>Text to display:</strong></td>
								  <td width="146"><textarea name="description<?php echo $keywords->Id; ?>" id="description<?php echo $keywords->Id; ?>" onclick="set_focus('description<?php echo $keywords->Id; ?>');" rows="4" cols="38"><?php echo $keywords->description; ?></textarea></td>
								</tr>
								<tr>
								  <td nowrap="nowrap" ><strong>Display:</strong>
								    <input type="checkbox" name="display<?php echo $keywords->Id; ?>" id="display<?php echo $keywords->Id; ?>" size="40" <?php if($keywords->display_tags == "yes") echo 'checked="checked"'; ?>/>
								  </td>
								  <td nowrap="nowrap"><strong>Always Display:</strong>
								      <input type="checkbox" name="displaytext<?php echo $keywords->Id; ?>" id="displaytext<?php echo $keywords->Id; ?>" size="40" <?php if($keywords->display == "yes") echo 'checked="checked"'; ?>/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="submit">
<input type="submit" name="update" value="Update &raquo;" onclick="return check_update('<?php echo $keywords->Id; ?>');"/></span>
                                 </td>
								</tr>
							  </table>					
							  <div id='preview1x' class='wrap'>
							  <a href="javascript:toggle2('preview3<?php echo $keywords->Id; ?>');"><strong><?php _e('Preview (Published Keywords)'); ?> <small class="quickjump"></small></strong></a>
							   <div id='preview3<?php echo $keywords->Id; ?>' class='wrap'>
									<?php echo dpp_get_preview($_GET['post'],$keywords->Id); ?>
							   </div>	
							  </div>			
							</div>							
         <!-- </div>	-->
						<br>
					  <?php } else { ?>
					  	<div id="EditForm<?php echo $keywords->Id; ?>">  
							<!--<div> 	   -->
							    <table align="center" height="233">
							    <tr>
								  <td height="24" ><strong>Company Keywords:</strong></td>
								  <td nowrap="nowrap">
							        <input type="text" name="keywords<?php echo $keywords->Id; ?>" id="keywords<?php echo $keywords->Id; ?>" value="<?php echo $keywords->company_tags; ?>" onclick="set_focus('keywords<?php echo $keywords->Id; ?>');" size="40"/>
							      </td>
								</tr>
								<tr>
								  <td ><strong>Company Name:</strong></td>
								  <td><input type="text" name="name<?php echo $keywords->Id; ?>" id="name<?php echo $keywords->Id; ?>" value="<?php echo $keywords->company_name; ?>" onclick="set_focus('name<?php echo $keywords->Id; ?>');" size="40"/></td>
								</tr>
								<tr>
								  <td ><strong>URL:</strong></td>
								  <td><input type="text" name="url<?php echo $keywords->Id; ?>" id="url<?php echo $keywords->Id; ?>" size="40" value="<?php echo $keywords->url; ?>" onclick="set_focus('url<?php echo $keywords->Id; ?>');" /></td>
								</tr>
								<tr>
								  <td height="98" ><strong>Text to display :</strong></td>
								  <td width="146"><textarea name="description<?php echo $keywords->Id; ?>" id="description<?php echo $keywords->Id; ?>" onclick="set_focus('description<?php echo $keywords->Id; ?>');" rows="4" cols="38"><?php echo $keywords->description; ?></textarea></td>
								</tr>
								<tr>
								  <td nowrap="nowrap" ><strong>Display:</strong>
								    <input type="checkbox" name="display<?php echo $keywords->Id; ?>" id="display<?php echo $keywords->Id; ?>" size="40" <?php if($keywords->display_tags == "yes") echo 'checked="checked"'; ?>/>
								  </td>
								  <td nowrap="nowrap"><strong>Always Display:</strong>
								      <input type="checkbox" name="displaytext<?php echo $keywords->Id; ?>" id="displaytext<?php echo $keywords->Id; ?>" size="40" <?php if($keywords->display == "yes") echo 'checked="checked"'; ?>/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="submit">
<input type="submit" name="update" value="Update &raquo;" onclick="return check_update('<?php echo $keywords->Id; ?>');"/></span>
                                 </td>
								</tr>
							  </table>				
							  <div id='preview1x' class='wrap'>
							  <a href="javascript:toggle2('preview3<?php echo $keywords->Id; ?>');"><strong><?php _e('Preview (Published Keywords)'); ?> <small class="quickjump"></small></strong></a>
							   <div id='preview3<?php echo $keywords->Id; ?>' class='wrap'>
									<?php echo dpp_get_preview($_GET['post'],$keywords->Id); ?>
							   </div>	
							  </div>	
							</div>			
                      <!--  </div>	-->
						<br>
						<?php } ?>
		   </div>	
								  <?php }} ?>		
					<div id="1x" align="center"> 
						<table align="center" width="600" bgcolor="#2685af">
						 <tr>
						   <td><img src="<?php echo DISCLOSURE_IMAGES_URL; ?>/home .jpg" height="14" align="middle"></td>
						   <td width="825" align="left"><h3 class="dbx-handle1">Add New</h3></td>
						   <td>
							  <a href="javascript:toggle2('InsertForm');" title="Close The Block" onclick="change_image('1x');"> <img src="<?php echo DISCLOSURE_IMAGES_URL; ?>/icon2.jpg" height="14" align="middle" name="close1x" id="close1x"></a></h3>
						   </td>
						 </tr>
						</table>   
						<div id="InsertForm"> 
	                    <table align="center" height="233">
							    <tr>
								  <td ><strong>Company Keywords:</strong></td>
								  <td><input type="text" name="keywords" id="keywords" onclick="set_focus('keywords');" size="40"/></td>
								</tr>
								<tr>
								  <td ><strong>Company Name:</strong></td>
								  <td><input type="text" name="name" id="name" onclick="set_focus('name');" size="40"/></td>
								</tr>
								<tr>
								  <td ><strong>URL:</strong></td>
								  <td><input type="text" name="url" id="url" onclick="set_focus('url');" size="40" value="" /></td>
								</tr>
								<tr>
								  <td ><strong>Text to display :</strong></td>
								  <td width="146"><textarea name="description" id="description" onclick="set_focus('description');" rows="4" cols="38"></textarea></td>
								</tr>
								<tr>
								  <td nowrap="nowrap" ><strong>Display:</strong>
								    <input type="checkbox" name="display" id="display" checked size="40"/>
								  </td>
								  <td nowrap="nowrap"><strong>Always Display:</strong>
								    <input type="checkbox" name="displaytext" id="displaytext" size="40"/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="submit">
<input type="submit" name="insert" value="Insert &raquo;"/></span>
                                 </td>
								</tr>
						  </table>
						</div>							
		   </div>  
		    <div align="right">
		      <?php  $sortableLists->sorting(get_bloginfo('url'),dirname(plugin_basename(__FILE__))); ?>
		   </div>
	</div>							
  </div>
<div align="center">
	<a href="http://disclosurepolicyplugin.com/feed/">RSS Feed For Updates</a> | 
	<a href="http://disclosurepolicyplugin.com/development/">Support Development</a><br/>
	<a href="http://disclosurepolicyplugin.com/recommended/">Recommended Products</a> | 
	<a href="http://disclosurepolicyplugin.com/shopping/">Shopping</a>	
	
</div>						
<div id="footer"></div>
<?php
$sortableLists->printBottomJS();
?>
</form>
</body>
</html>