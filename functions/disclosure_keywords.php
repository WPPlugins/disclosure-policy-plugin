<?php

/* function used for the preview of keywords in the admin page */
function dpp_get_preview($id = 0,$ID) {
   global $post;
	$post = &get_post($id);
	$keyword = dpp_fetch_keywords_id($ID);
	$settings =  dpp_fetch_settings();
	
	 foreach($settings as $setting) 
    {
	  $new_window = $setting->new_window;
	  $case_sensitive = $setting->case_sensitive;
	  $keywords_div_start = $setting->input_start;
	  $keywords_div_end = $setting->input_end;
    } 
	foreach($keyword as $keywords)
	{
	  $key = $keywords->company_tags;
	  $c_name = $keywords->company_name;
	  $fetch_url = $keywords->url;
	  $description = $keywords->description;
	  $display = $keywords->display_tags;
	}
	$key1 = explode(",",$key);
	$url = "http://".$fetch_url;
	$content = $post->post_content;
	echo $keywords_div_start;
    if($new_window != "checked") {
		              if($fetch_url == "") { $link = $c_name; } else { // Url Check Condition
					  $link = "<a href=".$url.">".$c_name."</a>"; }
					  $bodytag = str_replace("[Keywords]", $key1[0], $description);
					  $keywords_print =   str_replace("[Company]", $link, $bodytag);
						  echo $keywords_print;
				   }
	else {
				      $blank = "_blank";
					  $title = "Company Link";
					  if($fetch_url == "") { $link = $c_name; } else { // Url Check Condition
					  $link = "<a href=".$url." target=".$blank.">".$c_name."</a>"; }
					  $bodytag = str_replace("[Keywords]", $key1[0], $description);
					  $keywords_print =   str_replace("[Company]", $link, $bodytag);
						  echo $keywords_print;
				  }  
   echo $keywords_div_end;				  
}

class dpp_post_keywords
{

/* Function used for the search saved keywords from the database in the publish post Blog */
function dpp_search_keywords($content)
{
  global $post;
  $settings =  dpp_fetch_settings();
  $keywords =  dpp_fetch_keywords();
  
  if($settings == "")
  {}
  else{
	  foreach($settings as $setting) 
	  {
		  $new_window = $setting->new_window;
		  $case_sensitive = $setting->case_sensitive;
		  $keywords_div_start = $setting->input_start;
		  $keywords_div_end = $setting->input_end;
	  } 
   }
	  $str = $content;
	  $content1 = $str."<br><br>"; 
	  $content2 = $keywords_div_start;
	  $a = str_word_count($str, 1);
	  $count_str = count($a);
	  
	  if($keywords == "")
      {}
      else{
		  foreach($keywords as $keyword) // II foreach
		  {
			  $id = $keyword->Id;
			  $key = $keyword->company_tags;
			  $count_key1 = count(explode(",",$key));
			  $url_fetch = $keyword->url;
			  $description = $keyword->description;
			  $company_name = $keyword->company_name;
			  $display = $keyword->display_tags;
			  $display1 = $keyword->display;
			  $url = "http://".$url_fetch; 
			
			  if($count_key1 == "1")
			  {
				  $count_key = count(explode(" ",$key));
				  if($count_key == "1")
				  {
						  foreach ($a as $i => $value) { // I foreach
							 if($case_sensitive == "checked")
							 {
								   if(strcmp($value,$key)==0)
								   {
										  if($new_window != "checked") { 
											  if($url_fetch == "") { $link = $company_name; } else { // Url Check Condition
											  $link = "<a href=".$url.">".$company_name."</a>"; }
											  $bodytag = str_replace("[Keywords]", $key, $description);
											  $keywords_print =   str_replace("[Company]", $link, $bodytag);
											  if($display == "yes") {
												  $content3 = $keywords_print;
											  }
										  }
										  else {
											  $blank = "_blank";
											  if($url_fetch == "") { $link = $company_name; } else { // Url Check Condition
											  $link = "<a href=".$url." target=".$blank.">".$company_name."</a>"; }
											  $bodytag = str_replace("[Keywords]", $key, $description);
											  $keywords_print =   str_replace("[Company]", $link, $bodytag);
											  if($display == "yes") {
												  $content3 = $keywords_print;
											  }
										  }  
										 break;
									}
							 } // End if of check condition of case_sensitive
							 else{ 
									if($value == $key)
									{
										  if($new_window != "checked") {
											  if($url_fetch == "") { $link = $company_name; } else { // Url Check Condition
											  $link = "<a href=".$url.">".$company_name."</a>"; }
											  $bodytag = str_replace("[Keywords]", $key, $description);
											  $keywords_print =   str_replace("[Company]", $link, $bodytag);
											  if($display == "yes") {
													 $content3 = $keywords_print;
											   }
										 }
										 else {
											   $blank = "_blank";
											   if($url_fetch == "") { $link = $company_name; } else { // Url Check Condition
											   $link = "<a href=".$url." target=".$blank.">".$company_name."</a>"; }
											   $bodytag = str_replace("[Keywords]", $key, $description);
											   $keywords_print =   str_replace("[Company]", $link, $bodytag);
											   if($display == "yes") {
													 $content3 = $keywords_print;
											   }
										 }  
										  break;
									}
							  }	 // End of main else condition
							  if($display1 == "yes")
								{
								   if($new_window != "checked") {
									          if($url_fetch == "") { $link = $company_name; } else { // Url Check Condition
											  $link = "<a href=".$url.">".$company_name."</a>"; }
											  $bodytag = str_replace("[Keywords]", $key, $description);
											  $keywords_print =   str_replace("[Company]", $link, $bodytag);
											  if($display == "yes") {
													 $content3 = $keywords_print;
											   }
										 }
										 else {
										   $blank = "_blank";
										   if($url_fetch == "") { $link = $company_name; } else { // Url Check Condition
										   $link = "<a href=".$url." target=".$blank.">".$company_name."</a>"; }
										   $bodytag = str_replace("[Keywords]", $key, $description);
										   $keywords_print =   str_replace("[Company]", $link, $bodytag);
										   if($display == "yes") {
												 $content3 = $keywords_print;
												  }
											  }
								   break;
								}
						   } // I End foreach
				   } // End of Count Condition
				   else{
						 $counter = "1";
						 $explode = explode(" ",$key);
						 for($x=1;$x<=$count_str;$x++)
						 {
							  if($a[$x-1] == $explode[$counter-1])
							  {
								 if($new_window != "checked") {
									    if($url_fetch == "") { $link = $company_name; } else { // Url Check Condition
										$link = "<a href=".$url.">".$company_name."</a>"; }
										$bodytag = str_replace("[Keywords]", $key, $description);
										$keywords_print =   str_replace("[Company]", $link, $bodytag);
										if($display == "yes") {
											 $content3 = $keywords_print;
										}
								  }
								 else {
										$blank = "_blank";
										if($url_fetch == "") { $link = $company_name; } else { // Url Check Condition
										$link = "<a href=".$url." target=".$blank.">".$company_name."</a>"; }
										$bodytag = str_replace("[Keywords]", $key, $description);
										$keywords_print =   str_replace("[Company]", $link, $bodytag);
										if($display == "yes") {
											  $content3 = $keywords_print;
										}
								  }  
								 $counter++;
								 break;
							  } 
							  if($display1 == "yes")
								{
								   if($new_window != "checked") {
									          if($url_fetch == "") { $link = $company_name; } else { // Url Check Condition
											  $link = "<a href=".$url.">".$company_name."</a>"; }
											  $bodytag = str_replace("[Keywords]", $key, $description);
											  $keywords_print =   str_replace("[Company]", $link, $bodytag);
											  if($display == "yes") {
													 $content3 = $keywords_print;
											   }
										 }
										 else {
										   $blank = "_blank";
										   if($url_fetch == "") { $link = $company_name; } else { // Url Check Condition
										   $link = "<a href=".$url." target=".$blank.">".$company_name."</a>"; }
										   $bodytag = str_replace("[Keywords]", $key, $description);
										   $keywords_print =   str_replace("[Company]", $link, $bodytag);
										   if($display == "yes") {
												 $content3 = $keywords_print;
											  }
										 }
								   break;
								}
						 } //End of for Loop
				   }  // End of Count else Condition   
			  } // End of Comma Seprated Keywords if
			  else{
				   $b;$y = "1";
				   $explode1 = explode(",",$key);
				   foreach($explode1 as $explode2) 
				   {
				     for($x=1;$x<=$count_str;$x++)
				     {
					    $count_explode = count(explode(" ",$explode2));
						if($count_explode == "1")
					   {
						  if($a[$x-1] == $explode2)
						  { 
						   $b[$y-1] = $explode2;
						   if($b[$y-1] == $explode2)
							  $y++;
						  }
					   }	
					   else{
						 $counter = "1";
						 $space_explode = explode(" ",$explode2);
						 if($a[$x-1] == $space_explode[$counter-1])
						 {
							$b[$y-1] = $explode2;
							if($b[$y-1] == $explode2)
							$y++;
							$counter++;
						 } 
					   }
					 }
				   }
					// if($b=="") {}
					// else {  // Test Condition
							 if($display1 == "yes")  //Check Display Tickbox condition
							 {  
							   //foreach($explode1 as $explode2) //1 foreach
							   //{
									  if($new_window != "checked") {
										 if($url_fetch == "") { $link = $company_name; } else { // Url Check Condition
										 $link = "<a href=".$url.">".$company_name."</a>"; }
										 $bodytag = str_replace("[Keywords]", $explode1[0], $description);
										 $keywords_print =   str_replace("[Company]", $link, $bodytag);
										 if($display == "yes") {
											$content3 = $keywords_print;
										 }
									 }
									 else {
										 $blank = "_blank";
										 if($url_fetch == "") { $link = $company_name; } else { // Url Check Condition
										 $link = "<a href=".$url." target=".$blank.">".$company_name."</a>"; }
										 $bodytag = str_replace("[Keywords]", $explode1[0], $description);
										 $keywords_print =   str_replace("[Company]", $link, $bodytag);
										 if($display == "yes") {
											$content3 = $keywords_print;
										 }
									 }
							  // } // End of 1 Foreach
							 }   // End of Display Tick box if Condition
						     else {	   //Check Display else Tickbox condition
							   if($b=="") {}
					           else {  // Test Condition
								 $comma_keys = array_unique($b);
								 //foreach($comma_keys as $comma_key)  //2 foreach
								 //{
										if($new_window != "checked") {
											if($url_fetch == "") { $link = $company_name; } else { // Url Check Condition
											$link = "<a href=".$url.">".$company_name."</a>"; }
											$bodytag = str_replace("[Keywords]", $comma_keys[0], $description);
											$keywords_print =   str_replace("[Company]", $link, $bodytag);
											if($display == "yes") {
												 $content3 = $keywords_print;
											}
										}
										else {
											$blank = "_blank";
											if($url_fetch == "") { $link = $company_name; } else { // Url Check Condition
											$link = "<a href=".$url." target=".$blank.">".$company_name."</a>"; }
											$bodytag = str_replace("[Keywords]", $comma_keys[0], $description);
											$keywords_print =   str_replace("[Company]", $link, $bodytag);
											if($display == "yes") {
												 $content3 = $keywords_print;
											}
										}
								// } // End of 2 Foreach  (Commented by Client to display only first serach keywords from the comma list)
							   }  // End of else Test Condition
							 }   // End of Display Tick box else Condition
			 } // End of Comma Seprated Keywords else conditions 
		  } // II End foreach
	  }
	$content4 = $keywords_div_end;
    $content = $content1.$content2.$content3.$content4;
	return $content;
}  // End search_keywords function
} // End of class dpp_post_keywords
?>