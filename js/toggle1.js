// JavaScript Document
 function toggle2(whichLayer)
{
	if (document.getElementById)
	{
	// this is the way the standards work
	var style2 = document.getElementById(whichLayer).style;
	style2.display = style2.display? "":"block";
	}
	else if (document.all)
	{
	// this is the way old msie versions work
	var style2 = document.all[whichLayer].style;
	style2.display = style2.display? "":"block";
	}
	else if (document.layers)
	{
	// this is the way nn4 works
	var style2 = document.layers[whichLayer].style;
	style2.display = style2.display? "":"block";
	}
}

function toggle(whichLayer,id)
{
	var style1 = 'EditForm'+id;
	if (document.getElementById)
	{
	// this is the way the standards work
	var style2 = document.getElementById(whichLayer).style;
	var style3 = document.getElementById(style1).style;
	if(style3.display == "block")
	{
		style3.display = style3.display? "":"none";
		style2.display = style2.display? "":"none";
		//alert("hello");
	}
	style2.display = style2.display? "":"block";
	}
	
}

 function toggle1(whichLayer,id)
{
		// this is the way the standards work
		var style1 = 'listForm'+id;
		if (document.getElementById)
	{
		// this is the way the standards work
		var style2 = document.getElementById(whichLayer).style;
		var style3 = document.getElementById(style1).style;
		if(style2.display == "block")
		{
		  style3.display = style3.display? "":"block";
		  style2.display = style2.display? "":"none";
		  //alert("check");
		}
		else if(style3.display == "block")
		{
		  style2.display = style2.display? "":"block";
		  style3.display = style3.display? "":"none";
		}
         else{
		  style2.display = style2.display? "":"block";
		  //style3.display = style3.display? "":"none";
		//alert("uncheck");
		 }
	}
}

  function check_delete(id)
  {
    document.form.tagsID.value = id;
    var warn_delete = document.form.warn_tags.value;
	if(warn_delete == "unchecked")
	{
	  var agree=confirm("Are you sure you delete this Keywords Information?");
      if (agree)
	   return true;
      else
	   return false;
	}  
  }
  
  function cross(id)
  {
    var path = document.form.blog_url.value;
	var disclosure_path = document.form.blog_js.value;
	var include = document.form.abspath.value;
	var warn_delete = document.form.warn_tags.value;
	if(warn_delete == "unchecked")
	{
		  var agree=confirm("Are you sure you want to remove this block,there is no undo and you will lose all data of this block?");
		  if (agree) {
		   location.href= disclosure_path+"/action.php?delete=delete&id="+id+"&abspath="+include+"&blog_url="+path;
		   return true;
		  } 
		  else
		   return false;
	}
	else{
	    // alert(warn_delete);
		location.href= disclosure_path+"/action.php?delete=delete&id="+id+"&abspath="+include+"&blog_url="+path;
	}
  }
  
  function check_update(id)
  {
    document.form.tagsID.value = id;
  }
 