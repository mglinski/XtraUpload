/*
 * Tooltip - jQuery plugin  for styled tooltips
 *
 * Copyright (c) 2006 Jörn Zaefferer, Stefan Petre
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 *
 */
// the tooltip element
var helper,
	// it's title part
	tTitle,
	// it's body part
	tBody,
	// it's url part
	tUrl,
	// the current tooltipped element
	current,
	// the title of the current element, used for restoring
	oldTitle,
	// timeout id for delayed tooltips
	tID;

// the public plugin method
$.fn.Tooltip = function(settings) {
	// setup configuration
	// TODO: allow multiple arguments to extend, see bug #344
	settings = $.extend($.extend({}, arguments.callee.defaults), settings || {});

	// there can be only one tooltip helper
	if( !helper ) {
		// create the helper, h3 for title, div for url
		helper = $('<div id="tooltip"><h3></h3><p class="body"></p><p class="url"></p></div>')
			// hide it at first
			.hide()
			// move to top and position absolute, to let it follow the mouse
			.css({ position: 'absolute', zIndex: 3000, width: 'auto' })
			// add to document
			.appendTo('body');

		// save references to title and url elements
		tTitle = $('h3', helper);
		tBody = $('p:eq(0)', helper);
		tUrl = $('p:eq(1)', helper);
	}
	
	// bind events for every selected element with a title attribute
	$(this).filter('[@title]')
		// save settings into each element
		// TODO: pass settings via event system, not yet possible
		.each(function() {
			this.tSettings = settings;
		})
		// bind events
		.bind("mouseover", save)
		.bind(settings.event, handle);
	return this;
};

// the public plugin kill method
$.fn.TooltipKill = function() 
{
	helper.css({display:'none'},function()
	{
		this.bind("mouseover", function(){});
		return this;
	});
};

// main event handler to start showing tooltips
function handle(event) {
	// show helper, either with timeout or on instant
	if( this.tSettings.delay )
		tID = setTimeout(show, this.tSettings.delay);
	else
		show();
	
	// if selected, update the helper position when the mouse moves
	if(this.tSettings.track)
		$('body').bind('mousemove', update);
		
	// update at least once
	update(event);
	
	// hide the helper when the mouse moves out of the element
	$(this).bind('mouseout', hide);
}

// save elements title before the tooltip is displayed
function save() {
	// if this is the current source, or it has no title (occurs with click event), stop
	if(this == current || !this.title)
		return;
	// save current
	current = this;
	
	var source = $(this),
		settings = this.tSettings;
		
	// save title, remove from element and set to helper
	oldTitle = title = source.attr('title');
	source.attr('title','');
	if(settings.showBody) 
	{
		var parts = title.split(settings.showBody);
		tTitle.html(parts.shift());
		tBody.empty();
		for(var i = 0, part; part = parts[i]; i++) 
		{
			if(i > 0)
				tBody.append("<br/>");
			tBody.append(part);
		}
		if(tBody.html())
			tBody.css('display','none');
		else
			tBody.css('display','');
	} 
	else 
	{
		tTitle.html(title);
		tBody.hide();
	}
	
	// hide it
	tUrl.hide();
	
	// add an optional class for this tip
	if( settings.extraClass ) {
		helper.addClass(settings.extraClass);
	}
	// fix PNG background for IE
	if (settings.fixPNG && $.browser.msie ) {
		helper.each(function () {
			if (this.currentStyle.backgroundImage != 'none') {
				var image = this.currentStyle.backgroundImage;
				image = image.substring(5, image.length - 2);
				$(this).css({
					'backgroundImage': 'none',
					'filter': "progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true, sizingMethod=crop, src='" + image + "')"
				});
			}
		});
	}
	// set cool width
		var titleB = title;
			titleB = titleB.length;
			if(titleB > 20)
			{
				titleB = titleB - 3;
			}
			titleB = titleB * 11 + 'px';
			helper.css('width',titleB);
}

// delete timeout and show helper
function show() {
	tID = null;
	helper.css('display','block');
	update();
}

/**
 * callback for mousemove
 * updates the helper position
 * removes itself when no current element
 */
function update(event)	{
	// if no current element is available, remove this listener
	if( current == null ) {
		$('body').unbind('mousemove', update);
		return;	
	}
	
	var left = helper[0].offsetLeft;
	var top = helper[0].offsetTop;
	if(event) {
		// get the current mouse position
		function pos(c) {
			var p = c == 'X' ? 'Left' : 'Top';
			return event['page' + c] || (event['client' + c] + (document.documentElement['scroll' + p] || document.body['scroll' + p])) || 0;
		}
		// position the helper 15 pixel to bottom right, starting from mouse position
		left = pos('X') + 15;
		top = pos('Y') + 15;
		helper.css({
			left: left + 'px',
			top: top + 'px'
		});
	}
	
	var v = viewport(),
		h = helper[0];
	// check horizontal position
	if(v.x + v.cx < h.offsetLeft + h.offsetWidth) {
		left -= h.offsetWidth + 20;
		helper.css({left: left + 'px'});
	}
	// check vertical position
	if(v.y + v.cy < h.offsetTop + h.offsetHeight) {
		top -= h.offsetHeight + 20;
		helper.css({top: top + 'px'});
	}
}

function viewport() {
	var e = document.documentElement || {},
		b = document.body || {},
		w = window;

	return {
		x: w.pageXOffset || e.scrollLeft || b.scrollLeft || 0,
		y: w.pageYOffset || e.scrollTop || b.scrollTop || 0,
		cx: min( e.clientWidth, b.clientWidth, w.innerWidth ),
		cy: min( e.clientHeight, b.clientHeight, w.innerHeight )
	};

	function min() {
		var v = Infinity;
		for( var i = 0;  i < arguments.length;  i++ ) {
			var n = arguments[i];
			if( n && n < v ) v = n;
		}
		return v;
	}
}

// hide helper and restore added classes and the title
function hide() {
	// clear timeout if possible
	if(tID)
		clearTimeout(tID);
	// no more current element
	current = null;
	helper.hide();
	// remove optional class
	if( this.tSettings.extraClass ) {
		helper.removeClass( this.tSettings.extraClass);
	}
	
	// restore title and remove this listener
	$(this)
		.attr('title', oldTitle)
		.unbind('mouseout', hide);
		
	// remove PNG background fix for IE
	if( this.tSettings.fixPNG && $.browser.msie ) {
		helper.each(function () {
			$(this).css({'filter': '', backgroundImage: ''});
		});
	}
}

// define global defaults, editable by client
$.fn.Tooltip.defaults = {
	delay: 250,
	event: "mouseover",
	track: false,
	showURL: true,
	showBody: null,
	extraClass: null,
	fixPNG: false
};