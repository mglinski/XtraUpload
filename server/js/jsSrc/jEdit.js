 jQuery.editable = {};

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
    this.innerHTML = "<input id=\"text_edit\" type=\"text\" value = \"" + this.innerHTML + "\" /> ";


    $(this).removeClickable();
	$("#text_edit").keydown(function(e) 
	{
		if (e.keyCode == 13)
		{ // ENTER
			 process_edit(editable, urlString, url);
		}
		
		if (e.keyCode == 27)
		{ // ESC
			 $(editable).html(revert);
			 $(editable).editInPlace(url, urlString);
		}
	});
	
    $("#text_edit").blur(function(e)
	{
		process_edit(editable, urlString, url);
	});
  };

  jQuery.fn.removeClickable = function() 
  {
    this.unclick();    
    this.unmouseover().unmouseout();
	$(this).TooltipKill();
  };
  var me = $(this);
  me.editing = true;
  this.attr('title','Click to Edit').Tooltip({track: true, delay: 0});
  
  return this.click(editInPlaceClick);
};

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