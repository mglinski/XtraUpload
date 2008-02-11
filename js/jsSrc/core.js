var currently_showing = null;
var checkBoxAllBool = false;

function switchCheckboxes()
{
	if(!checkBoxAllBool)
	{
		$('input[@type=checkbox]', document).each(function(i)
		{
			$(this).attr('checked', 'checked');
		});
		checkBoxAllBool = true;
	}
	else
	{
		$('input[@type=checkbox]', document).each(function(i)
		{
			$(this).attr('checked', '');
		});
		checkBoxAllBool = false;
	}
}

function switchUpload(ids)
{
	if(currently_showing == 1)
	{
		$('#up_flash').fadeOut('fast',function(){$(ids).fadeIn("fast");});
	}
	else if(currently_showing == 2)
	{
		$('#up_url').fadeOut('fast',function(){$(ids).fadeIn("fast");});
	}
	else if(currently_showing == 3)
	{
		$('#up_plain').fadeOut('fast',function(){$(ids).fadeIn("fast");});
	}
}

function show_upload_flash()
{
	if(currently_showing != 1)
	{
		switchUpload('#up_flash');
		currently_showing = 1;
	}
}

function show_upload_url()
{
	if(currently_showing != 2)
	{
		switchUpload('#up_url');
		currently_showing = 2;
	}
}

function show_upload_browse()
{
	if(currently_showing != 3)
	{
		switchUpload('#up_plain');
		currently_showing = 3;
	}
}

function popUP()
{
	$("#p_bar_text").css('display', "inline");
	$("#upload_sect").css('display', "none");
	$("#link_block").css('display', 'none');
	$("#uploadMethods").css('display', 'none');
}

function redirect(URLStr) 
{ 
	location = URLStr; 
}

function up_image(width)
{
	if((width * 6) >= 600)
	{
		var width1 = 600;
	}
	else
	{
		var width1 = width;
	}
	$("#progress_img").animate({width: width}, "normal");
}


function make_color(css)
{  
    $('#'+css).farbtastic('#'+css);
}

function disable_button()
{
	if(document.getElementById("private_key").value.length != document.getElementById("public_key").value.length)
	{
		alert("Please complete the captcha validation to download the file.");
		return false;
	}
	else
	{
		$("#downloadFileNow").attr('type','button');
		return true;
	}
	return false;
}

function showUploadUrlOptions()
{
	$('#uploadUrlOptions').slideDown('normal');
	$('#uploadUrlOptionsLink').slideUp('normal');
}

function showUploadBrowserOptions()
{
	$('#uploadBrowserOptions').slideDown('normal');
	$('#uploadBrowserOptionsLink').slideUp('normal');
}

function showUploadFlashOptions()
{
	$('#uploadFlashOptions').slideDown('normal');
	$('#uploadFlashOptionsLink').slideUp('normal');
}