
function load_download(hash1)
{
	show_loading();
	$("#main_c").hide(800, 
	function()
	{ 
		$("#main_c").empty();
		$("#main_c").height("1000px");
		$.get("./api.php", {page: "download", hash: ""+hash1+""},
		function(data)
		{
			
			$("#main_c").html("<div align='center'>"+data+"</div>");
			eval(eval_code(data));
			$("#main_c").show(1200,
			function()
			{
				close_loading();
			});
		});
	});
}

function load_download_form(hash1)
{
	//var height1 = $("#main_c").height();
	//$("#main_c").height(height1);
	//$("#main_c").fadeOut("slow",);
	show_loading();
	$("#main_c").hide(800, 
	function()
	{ 
		$("#main_c").empty();
		$("#main_c").height("1000px");
		$.get("./api.php", {page: "download", hash: ""+hash1+""},
		function(data)
		{
			
			$("#main_c").html("<div align='center'>"+data+"</div>");
			//$("#main_c").after("<"+"script language='javascript' type='text/javascript'"+">"+eval_code(data)+"<"+"/script"+">");
			eval(eval_code(data));
			$("#main_c").show(1200,
			function()
			{
				//$("#main_c").css("opacity", "100%").css("display", "block");
				close_loading();
			});
		});
	});
	return false;
}

function load_page(page_1,height,params)
{
	var src;
	if(height == null)
	{
	   height = '100%';
	}
	
	if(params==  null)
	{
	   params = '';
	}
	show_loading();
	$("#main_c").hide(800, 
	function()
	{ 
		$("#main_c").empty();
		$("#main_c").height(height);
		$.get("./api.php?page="+page_1, params,
		function(data)
		{
			$("#main_c").html("<div align='center'>"+data+"</div>");
			eval(eval_code(data));
			$("#main_c").show(1200,
			function()
			{
				//$("#main_c").css("opacity", "100%").css("display", "block");
				close_loading();
			});
		}); 
	});
}

function load_page_form(page_1,height,params)
{
	var src;
	if(height == null)
	{
	   height = '100%';
	}
	
	if(params==  null)
	{
	   params = '';
	}
	show_loading();
	$("#main_c").hide(800, 
	function()
	{ 
		$("#main_c").empty();
		$("#main_c").height(height);
		$.get("./api.php?page="+page_1, params,
		function(data)
		{
			$("#main_c").html("<div align='center'>"+data+"</div>");
			eval(eval_code(data));
			$("#main_c").show(1200,
			function()
			{
				//$("#main_c").css("opacity", "100%").css("display", "block");
				close_loading();
			});
		}); 
	});
		return false;
}

function load_link(hash1,pass)
{
	//var height1 = $("#main_c").height();
	//$("#main_c").height(height1);
	//$("#main_c").fadeOut("slow",);
	show_loading();
	$("#main_c").hide(1200, 
	function()
	{ 
		$("#main_c").empty();
		$("#main_c").height("300px");
		$.post("./api.php", {waited: "true", page: "download", pass_test: "true", pass1: pass, hash: ""+hash1+""},
		function(data)
		{
			$("#main_c").html("<div align='center'>"+data+"</div>");
			//eval(eval_code(data));
			$("#main_c").show(1200,
			function()
			{
				//$("#f_link").height("35px");
				close_loading();
				$("#f_link").show(700);
			});
		}); 
	});
}


function eval_code(rm_html)
{
	var text_blocks=new Array();
	var max_iteration=50;
	var i=0;
	var code='';
	while(_match = rm_html.match(new RegExp("<script\\s+?type=['\"]text/javascript['\"]>([^`]+?)</script>","i")))
	{
		i++;
		if(i>=max_iteration)
		{
			break;
		}
		else
		{
			text_blocks[text_blocks.length]=_match[1];
			rm_html=rm_html.replace(_match[0],'');
		}
	}
	if(text_blocks.length)
	{
		for(i=0;i<text_blocks.length;i++)
		{
			code += text_blocks[i];
		}
	}
	return code;
}