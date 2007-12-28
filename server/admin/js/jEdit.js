 jQuery.editable = {};
var not_edited = true;

jQuery.fn.editInPlace = function(url, urlString) 
{
  var data;
  var div_id = this.id;
  
  editInPlaceClick = function() 
  {
    type = "text";
	var self = this;
	var editable = this; 
    var revert = this.innerHTML;
	not_edited = true;
    this.innerHTML = "<input id=\"text_edit\" type=\"text\" value = \"" + this.innerHTML + "\" /> ";
	//checkEdit(revert,editable,url,urlString);

    $(this).removeClickable();
	$("#text_edit").keydown(function(e) 
	{
		if (e.keyCode == 13)
		{ // ENTER
			 process_edit(editable, urlString, url);
		}
		
		if (e.keyCode == 27)
		{ // ESC
			 revert_editable(revert,editable,url,urlString);
		}
		not_edited = false;
	});
	
    $("#text_edit").blur(function(e)
	{
		process_edit(editable, urlString, url);
	});
	
	$("#text_edit").focus(function(e)
	{
		not_edited = false;
	});
	
	$("#text_edit").select(function(e)
	{
		not_edited = false;
	});
  }

  jQuery.fn.removeClickable = function() 
  {
    this.unclick();    
    this.unmouseover().unmouseout();
	$(this).TooltipKill();
  }
  var me = $(this);
  this.attr('title','Click to Edit').Tooltip({track: true, delay: 0});
  
  return this.click(editInPlaceClick);
}

function process_edit(editable, urlString, url)
{
      var value = $("#text_edit").val();
	  var me = $(editable);
      me.editing = false;
	  value = $.trim(value);
      $.ajax(
	  {
        url: url,
        type: "POST",
		dataType: "html",
        data: "ntg=" + value + "&" + urlString,
		
        success: function(text) 
		{
          $(editable).html(text);
		  $(editable).editInPlace(url, urlString);
        }
       });
	  return false;
}

function revert_editable(revert,editable,url,urlString)
{
	$(editable).html(revert);
	$(editable).editInPlace(url, urlString);
}
/*
function checkEdit(revert,editable,url,urlString)
{
	setTimeout('if(not_edited){	revert_editable("'+revert+'","'+editable+'","'+url+'","'+urlString+'");}alert("Times UP!")',10000);
}
*/