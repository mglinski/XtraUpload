(function(){
/*
 * jQuery 1.2.1 - New Wave Javascript
 *
 * Copyright (c) 2007 John Resig (jquery.com)
 * Dual licensed under the MIT (MIT-LICENSE.txt)
 * and GPL (GPL-LICENSE.txt) licenses.
 *
 * $Date: 2007-09-16 23:42:06 -0400 (Sun, 16 Sep 2007) $
 * $Rev: 3353 $
 */

// Map over jQuery in case of overwrite
if ( typeof jQuery != "undefined" )
	var _jQuery = jQuery;

var jQuery = window.jQuery = function(selector, context) {
	// If the context is a namespace object, return a new object
	return this instanceof jQuery ?
		this.init(selector, context) :
		new jQuery(selector, context);
};

// Map over the $ in case of overwrite
if ( typeof $ != "undefined" )
	var _$ = $;
	
// Map the jQuery namespace to the '$' one
window.$ = jQuery;

var quickExpr = /^[^<]*(<(.|\s)+>)[^>]*$|^#(\w+)$/;

jQuery.fn = jQuery.prototype = {
	init: function(selector, context) {
		// Make sure that a selection was provided
		selector = selector || document;

		// Handle HTML strings
		if ( typeof selector  == "string" ) {
			var m = quickExpr.exec(selector);
			if ( m && (m[1] || !context) ) {
				// HANDLE: $(html) -> $(array)
				if ( m[1] )
					selector = jQuery.clean( [ m[1] ], context );

				// HANDLE: $("#id")
				else {
					var tmp = document.getElementById( m[3] );
					if ( tmp )
						// Handle the case where IE and Opera return items
						// by name instead of ID
						if ( tmp.id != m[3] )
							return jQuery().find( selector );
						else {
							this[0] = tmp;
							this.length = 1;
							return this;
						}
					else
						selector = [];
				}

			// HANDLE: $(expr)
			} else
				return new jQuery( context ).find( selector );

		// HANDLE: $(function)
		// Shortcut for document ready
		} else if ( jQuery.isFunction(selector) )
			return new jQuery(document)[ jQuery.fn.ready ? "ready" : "load" ]( selector );

		return this.setArray(
			// HANDLE: $(array)
			selector.constructor == Array && selector ||

			// HANDLE: $(arraylike)
			// Watch for when an array-like object is passed as the selector
			(selector.jquery || selector.length && selector != window && !selector.nodeType && selector[0] != undefined && selector[0].nodeType) && jQuery.makeArray( selector ) ||

			// HANDLE: $(*)
			[ selector ] );
	},
	
	jquery: "1.2.1",

	size: function() {
		return this.length;
	},
	
	length: 0,

	get: function( num ) {
		return num == undefined ?

			// Return a 'clean' array
			jQuery.makeArray( this ) :

			// Return just the object
			this[num];
	},
	
	pushStack: function( a ) {
		var ret = jQuery(a);
		ret.prevObject = this;
		return ret;
	},
	
	setArray: function( a ) {
		this.length = 0;
		Array.prototype.push.apply( this, a );
		return this;
	},

	each: function( fn, args ) {
		return jQuery.each( this, fn, args );
	},

	index: function( obj ) {
		var pos = -1;
		this.each(function(i){
			if ( this == obj ) pos = i;
		});
		return pos;
	},

	attr: function( key, value, type ) {
		var obj = key;
		
		// Look for the case where we're accessing a style value
		if ( key.constructor == String )
			if ( value == undefined )
				return this.length && jQuery[ type || "attr" ]( this[0], key ) || undefined;
			else {
				obj = {};
				obj[ key ] = value;
			}
		
		// Check to see if we're setting style values
		return this.each(function(index){
			// Set all the styles
			for ( var prop in obj )
				jQuery.attr(
					type ? this.style : this,
					prop, jQuery.prop(this, obj[prop], type, index, prop)
				);
		});
	},

	css: function( key, value ) {
		return this.attr( key, value, "curCSS" );
	},

	text: function(e) {
		if ( typeof e != "object" && e != null )
			return this.empty().append( document.createTextNode( e ) );

		var t = "";
		jQuery.each( e || this, function(){
			jQuery.each( this.childNodes, function(){
				if ( this.nodeType != 8 )
					t += this.nodeType != 1 ?
						this.nodeValue : jQuery.fn.text([ this ]);
			});
		});
		return t;
	},

	wrapAll: function(html) {
		if ( this[0] )
			// The elements to wrap the target around
			jQuery(html, this[0].ownerDocument)
				.clone()
				.insertBefore(this[0])
				.map(function(){
					var elem = this;
					while ( elem.firstChild )
						elem = elem.firstChild;
					return elem;
				})
				.append(this);

		return this;
	},

	wrapInner: function(html) {
		return this.each(function(){
			jQuery(this).contents().wrapAll(html);
		});
	},

	wrap: function(html) {
		return this.each(function(){
			jQuery(this).wrapAll(html);
		});
	},

	append: function() {
		return this.domManip(arguments, true, 1, function(a){
			this.appendChild( a );
		});
	},

	prepend: function() {
		return this.domManip(arguments, true, -1, function(a){
			this.insertBefore( a, this.firstChild );
		});
	},
	
	before: function() {
		return this.domManip(arguments, false, 1, function(a){
			this.parentNode.insertBefore( a, this );
		});
	},

	after: function() {
		return this.domManip(arguments, false, -1, function(a){
			this.parentNode.insertBefore( a, this.nextSibling );
		});
	},

	end: function() {
		return this.prevObject || jQuery([]);
	},

	find: function(t) {
		var data = jQuery.map(this, function(a){ return jQuery.find(t,a); });
		return this.pushStack( /[^+>] [^+>]/.test( t ) || t.indexOf("..") > -1 ?
			jQuery.unique( data ) : data );
	},

	clone: function(events) {
		// Do the clone
		var ret = this.map(function(){
			return this.outerHTML ? jQuery(this.outerHTML)[0] : this.cloneNode(true);
		});

		// Need to set the expando to null on the cloned set if it exists
		// removeData doesn't work here, IE removes it from the original as well
		// this is primarily for IE but the data expando shouldn't be copied over in any browser
		var clone = ret.find("*").andSelf().each(function(){
			if ( this[ expando ] != undefined )
				this[ expando ] = null;
		});
		
		// Copy the events from the original to the clone
		if (events === true)
			this.find("*").andSelf().each(function(i) {
				var events = jQuery.data(this, "events");
				for ( var type in events )
					for ( var handler in events[type] )
						jQuery.event.add(clone[i], type, events[type][handler], events[type][handler].data);
			});

		// Return the cloned set
		return ret;
	},

	filter: function(t) {
		return this.pushStack(
			jQuery.isFunction( t ) &&
			jQuery.grep(this, function(el, index){
				return t.apply(el, [index]);
			}) ||

			jQuery.multiFilter(t,this) );
	},

	not: function(t) {
		return this.pushStack(
			t.constructor == String &&
			jQuery.multiFilter(t, this, true) ||

			jQuery.grep(this, function(a) {
				return ( t.constructor == Array || t.jquery )
					? jQuery.inArray( a, t ) < 0
					: a != t;
			})
		);
	},

	add: function(t) {
		return this.pushStack( jQuery.merge(
			this.get(),
			t.constructor == String ?
				jQuery(t).get() :
				t.length != undefined && (!t.nodeName || jQuery.nodeName(t, "form")) ?
					t : [t] )
		);
	},

	is: function(expr) {
		return expr ? jQuery.multiFilter(expr,this).length > 0 : false;
	},

	hasClass: function(expr) {
		return this.is("." + expr);
	},
	
	val: function( val ) {
		if ( val == undefined ) {
			if ( this.length ) {
				var elem = this[0];
		    	
				// We need to handle select boxes special
				if ( jQuery.nodeName(elem, "select") ) {
					var index = elem.selectedIndex,
						a = [],
						options = elem.options,
						one = elem.type == "select-one";
					
					// Nothing was selected
					if ( index < 0 )
						return null;

					// Loop through all the selected options
					for ( var i = one ? index : 0, max = one ? index + 1 : options.length; i < max; i++ ) {
						var option = options[i];
						if ( option.selected ) {
							// Get the specifc value for the option
							var val = jQuery.browser.msie && !option.attributes["value"].specified ? option.text : option.value;
							
							// We don't need an array for one selects
							if ( one )
								return val;
							
							// Multi-Selects return an array
							a.push(val);
						}
					}
					
					return a;
					
				// Everything else, we just grab the value
				} else
					return this[0].value.replace(/\r/g, "");
			}
		} else
			return this.each(function(){
				if ( val.constructor == Array && /radio|checkbox/.test(this.type) )
					this.checked = (jQuery.inArray(this.value, val) >= 0 ||
						jQuery.inArray(this.name, val) >= 0);
				else if ( jQuery.nodeName(this, "select") ) {
					var tmp = val.constructor == Array ? val : [val];

					jQuery("option", this).each(function(){
						this.selected = (jQuery.inArray(this.value, tmp) >= 0 ||
						jQuery.inArray(this.text, tmp) >= 0);
					});

					if ( !tmp.length )
						this.selectedIndex = -1;
				} else
					this.value = val;
			});
	},
	
	html: function( val ) {
		return val == undefined ?
			( this.length ? this[0].innerHTML : null ) :
			this.empty().append( val );
	},

	replaceWith: function( val ) {
		return this.after( val ).remove();
	},

	eq: function(i){
		return this.slice(i, i+1);
	},

	slice: function() {
		return this.pushStack( Array.prototype.slice.apply( this, arguments ) );
	},

	map: function(fn) {
		return this.pushStack(jQuery.map( this, function(elem,i){
			return fn.call( elem, i, elem );
		}));
	},

	andSelf: function() {
		return this.add( this.prevObject );
	},
	
	domManip: function(args, table, dir, fn) {
		var clone = this.length > 1, a; 

		return this.each(function(){
			if ( !a ) {
				a = jQuery.clean(args, this.ownerDocument);
				if ( dir < 0 )
					a.reverse();
			}

			var obj = this;

			if ( table && jQuery.nodeName(this, "table") && jQuery.nodeName(a[0], "tr") )
				obj = this.getElementsByTagName("tbody")[0] || this.appendChild(document.createElement("tbody"));

			jQuery.each( a, function(){
				var elem = clone ? this.cloneNode(true) : this;
				if ( !evalScript(0, elem) )
					fn.call( obj, elem );
			});
		});
	}
};

function evalScript(i, elem){
	var script = jQuery.nodeName(elem, "script");

	if ( script ) {
		if ( elem.src )
			jQuery.ajax({ url: elem.src, async: false, dataType: "script" });
		else
			jQuery.globalEval( elem.text || elem.textContent || elem.innerHTML || "" );
	
		if ( elem.parentNode )
			elem.parentNode.removeChild(elem);

	} else if ( elem.nodeType == 1 )
    jQuery("script", elem).each(evalScript);

	return script;
}

jQuery.extend = jQuery.fn.extend = function() {
	// copy reference to target object
	var target = arguments[0] || {}, a = 1, al = arguments.length, deep = false;

	// Handle a deep copy situation
	if ( target.constructor == Boolean ) {
		deep = target;
		target = arguments[1] || {};
	}

	// extend jQuery itself if only one argument is passed
	if ( al == 1 ) {
		target = this;
		a = 0;
	}

	var prop;

	for ( ; a < al; a++ )
		// Only deal with non-null/undefined values
		if ( (prop = arguments[a]) != null )
			// Extend the base object
			for ( var i in prop ) {
				// Prevent never-ending loop
				if ( target == prop[i] )
					continue;

				// Recurse if we're merging object values
				if ( deep && typeof prop[i] == 'object' && target[i] )
					jQuery.extend( target[i], prop[i] );

				// Don't bring in undefined values
				else if ( prop[i] != undefined )
					target[i] = prop[i];
			}

	// Return the modified object
	return target;
};

var expando = "jQuery" + (new Date()).getTime(), uuid = 0, win = {};

jQuery.extend({
	noConflict: function(deep) {
		window.$ = _$;
		if ( deep )
			window.jQuery = _jQuery;
		return jQuery;
	},

	// This may seem like some crazy code, but trust me when I say that this
	// is the only cross-browser way to do this. --John
	isFunction: function( fn ) {
		return !!fn && typeof fn != "string" && !fn.nodeName && 
			fn.constructor != Array && /function/i.test( fn + "" );
	},
	
	// check if an element is in a XML document
	isXMLDoc: function(elem) {
		return elem.documentElement && !elem.body ||
			elem.tagName && elem.ownerDocument && !elem.ownerDocument.body;
	},

	// Evalulates a script in a global context
	// Evaluates Async. in Safari 2 :-(
	globalEval: function( data ) {
		data = jQuery.trim( data );
		if ( data ) {
			if ( window.execScript )
				window.execScript( data );
			else if ( jQuery.browser.safari )
				// safari doesn't provide a synchronous global eval
				window.setTimeout( data, 0 );
			else
				eval.call( window, data );
		}
	},

	nodeName: function( elem, name ) {
		return elem.nodeName && elem.nodeName.toUpperCase() == name.toUpperCase();
	},
	
	cache: {},
	
	data: function( elem, name, data ) {
		elem = elem == window ? win : elem;

		var id = elem[ expando ];

		// Compute a unique ID for the element
		if ( !id ) 
			id = elem[ expando ] = ++uuid;

		// Only generate the data cache if we're
		// trying to access or manipulate it
		if ( name && !jQuery.cache[ id ] )
			jQuery.cache[ id ] = {};
		
		// Prevent overriding the named cache with undefined values
		if ( data != undefined )
			jQuery.cache[ id ][ name ] = data;
		
		// Return the named cache data, or the ID for the element	
		return name ? jQuery.cache[ id ][ name ] : id;
	},
	
	removeData: function( elem, name ) {
		elem = elem == window ? win : elem;

		var id = elem[ expando ];

		// If we want to remove a specific section of the element's data
		if ( name ) {
			if ( jQuery.cache[ id ] ) {
				// Remove the section of cache data
				delete jQuery.cache[ id ][ name ];

				// If we've removed all the data, remove the element's cache
				name = "";
				for ( name in jQuery.cache[ id ] ) break;
				if ( !name )
					jQuery.removeData( elem );
			}

		// Otherwise, we want to remove all of the element's data
		} else {
			// Clean up the element expando
			try {
				delete elem[ expando ];
			} catch(e){
				// IE has trouble directly removing the expando
				// but it's ok with using removeAttribute
				if ( elem.removeAttribute )
					elem.removeAttribute( expando );
			}

			// Completely remove the data cache
			delete jQuery.cache[ id ];
		}
	},

	// args is for internal usage only
	each: function( obj, fn, args ) {
		if ( args ) {
			if ( obj.length == undefined )
				for ( var i in obj )
					fn.apply( obj[i], args );
			else
				for ( var i = 0, ol = obj.length; i < ol; i++ )
					if ( fn.apply( obj[i], args ) === false ) break;

		// A special, fast, case for the most common use of each
		} else {
			if ( obj.length == undefined )
				for ( var i in obj )
					fn.call( obj[i], i, obj[i] );
			else
				for ( var i = 0, ol = obj.length, val = obj[0]; 
					i < ol && fn.call(val,i,val) !== false; val = obj[++i] ){}
		}

		return obj;
	},
	
	prop: function(elem, value, type, index, prop){
			// Handle executable functions
			if ( jQuery.isFunction( value ) )
				value = value.call( elem, [index] );
				
			// exclude the following css properties to add px
			var exclude = /z-?index|font-?weight|opacity|zoom|line-?height/i;

			// Handle passing in a number to a CSS property
			return value && value.constructor == Number && type == "curCSS" && !exclude.test(prop) ?
				value + "px" :
				value;
	},

	className: {
		// internal only, use addClass("class")
		add: function( elem, c ){
			jQuery.each( (c || "").split(/\s+/), function(i, cur){
				if ( !jQuery.className.has( elem.className, cur ) )
					elem.className += ( elem.className ? " " : "" ) + cur;
			});
		},

		// internal only, use removeClass("class")
		remove: function( elem, c ){
			elem.className = c != undefined ?
				jQuery.grep( elem.className.split(/\s+/), function(cur){
					return !jQuery.className.has( c, cur );	
				}).join(" ") : "";
		},

		// internal only, use is(".class")
		has: function( t, c ) {
			return jQuery.inArray( c, (t.className || t).toString().split(/\s+/) ) > -1;
		}
	},

	swap: function(e,o,f) {
		for ( var i in o ) {
			e.style["old"+i] = e.style[i];
			e.style[i] = o[i];
		}
		f.apply( e, [] );
		for ( var i in o )
			e.style[i] = e.style["old"+i];
	},

	css: function(e,p) {
		if ( p == "height" || p == "width" ) {
			var old = {}, oHeight, oWidth, d = ["Top","Bottom","Right","Left"];

			jQuery.each( d, function(){
				old["padding" + this] = 0;
				old["border" + this + "Width"] = 0;
			});

			jQuery.swap( e, old, function() {
				if ( jQuery(e).is(':visible') ) {
					oHeight = e.offsetHeight;
					oWidth = e.offsetWidth;
				} else {
					e = jQuery(e.cloneNode(true))
						.find(":radio").removeAttr("checked").end()
						.css({
							visibility: "hidden", position: "absolute", display: "block", right: "0", left: "0"
						}).appendTo(e.parentNode)[0];

					var parPos = jQuery.css(e.parentNode,"position") || "static";
					if ( parPos == "static" )
						e.parentNode.style.position = "relative";

					oHeight = e.clientHeight;
					oWidth = e.clientWidth;

					if ( parPos == "static" )
						e.parentNode.style.position = "static";

					e.parentNode.removeChild(e);
				}
			});

			return p == "height" ? oHeight : oWidth;
		}

		return jQuery.curCSS( e, p );
	},

	curCSS: function(elem, prop, force) {
		var ret, stack = [], swap = [];

		// A helper method for determining if an element's values are broken
		function color(a){
			if ( !jQuery.browser.safari )
				return false;

			var ret = document.defaultView.getComputedStyle(a,null);
			return !ret || ret.getPropertyValue("color") == "";
		}

		if (prop == "opacity" && jQuery.browser.msie) {
			ret = jQuery.attr(elem.style, "opacity");
			return ret == "" ? "1" : ret;
		}
		
		if (prop.match(/float/i))
			prop = styleFloat;

		if (!force && elem.style[prop])
			ret = elem.style[prop];

		else if (document.defaultView && document.defaultView.getComputedStyle) {

			if (prop.match(/float/i))
				prop = "float";

			prop = prop.replace(/([A-Z])/g,"-$1").toLowerCase();
			var cur = document.defaultView.getComputedStyle(elem, null);

			if ( cur && !color(elem) )
				ret = cur.getPropertyValue(prop);

			// If the element isn't reporting its values properly in Safari
			// then some display: none elements are involved
			else {
				// Locate all of the parent display: none elements
				for ( var a = elem; a && color(a); a = a.parentNode )
					stack.unshift(a);

				// Go through and make them visible, but in reverse
				// (It would be better if we knew the exact display type that they had)
				for ( a = 0; a < stack.length; a++ )
					if ( color(stack[a]) ) {
						swap[a] = stack[a].style.display;
						stack[a].style.display = "block";
					}

				// Since we flip the display style, we have to handle that
				// one special, otherwise get the value
				ret = prop == "display" && swap[stack.length-1] != null ?
					"none" :
					document.defaultView.getComputedStyle(elem,null).getPropertyValue(prop) || "";

				// Finally, revert the display styles back
				for ( a = 0; a < swap.length; a++ )
					if ( swap[a] != null )
						stack[a].style.display = swap[a];
			}

			if ( prop == "opacity" && ret == "" )
				ret = "1";

		} else if (elem.currentStyle) {
			var newProp = prop.replace(/\-(\w)/g,function(m,c){return c.toUpperCase();});
			ret = elem.currentStyle[prop] || elem.currentStyle[newProp];

			// From the awesome hack by Dean Edwards
			// http://erik.eae.net/archives/2007/07/27/18.54.15/#comment-102291

			// If we're not dealing with a regular pixel number
			// but a number that has a weird ending, we need to convert it to pixels
			if ( !/^\d+(px)?$/i.test(ret) && /^\d/.test(ret) ) {
				var style = elem.style.left;
				var runtimeStyle = elem.runtimeStyle.left;
				elem.runtimeStyle.left = elem.currentStyle.left;
				elem.style.left = ret || 0;
				ret = elem.style.pixelLeft + "px";
				elem.style.left = style;
				elem.runtimeStyle.left = runtimeStyle;
			}
		}

		return ret;
	},
	
	clean: function(a, doc) {
		var r = [];
		doc = doc || document;

		jQuery.each( a, function(i,arg){
			if ( !arg ) return;

			if ( arg.constructor == Number )
				arg = arg.toString();
			
			// Convert html string into DOM nodes
			if ( typeof arg == "string" ) {
				// Fix "XHTML"-style tags in all browsers
				arg = arg.replace(/(<(\w+)[^>]*?)\/>/g, function(m, all, tag){
					return tag.match(/^(abbr|br|col|img|input|link|meta|param|hr|area)$/i)? m : all+"></"+tag+">";
				});

				// Trim whitespace, otherwise indexOf won't work as expected
				var s = jQuery.trim(arg).toLowerCase(), div = doc.createElement("div"), tb = [];

				var wrap =
					// option or optgroup
					!s.indexOf("<opt") &&
					[1, "<select>", "</select>"] ||
					
					!s.indexOf("<leg") &&
					[1, "<fieldset>", "</fieldset>"] ||
					
					s.match(/^<(thead|tbody|tfoot|colg|cap)/) &&
					[1, "<table>", "</table>"] ||
					
					!s.indexOf("<tr") &&
					[2, "<table><tbody>", "</tbody></table>"] ||
					
				 	// <thead> matched above
					(!s.indexOf("<td") || !s.indexOf("<th")) &&
					[3, "<table><tbody><tr>", "</tr></tbody></table>"] ||
					
					!s.indexOf("<col") &&
					[2, "<table><tbody></tbody><colgroup>", "</colgroup></table>"] ||

					// IE can't serialize <link> and <script> tags normally
					jQuery.browser.msie &&
					[1, "div<div>", "</div>"] ||
					
					[0,"",""];

				// Go to html and back, then peel off extra wrappers
				div.innerHTML = wrap[1] + arg + wrap[2];
				
				// Move to the right depth
				while ( wrap[0]-- )
					div = div.lastChild;
				
				// Remove IE's autoinserted <tbody> from table fragments
				if ( jQuery.browser.msie ) {
					
					// String was a <table>, *may* have spurious <tbody>
					if ( !s.indexOf("<table") && s.indexOf("<tbody") < 0 ) 
						tb = div.firstChild && div.firstChild.childNodes;
						
					// String was a bare <thead> or <tfoot>
					else if ( wrap[1] == "<table>" && s.indexOf("<tbody") < 0 )
						tb = div.childNodes;

					for ( var n = tb.length-1; n >= 0 ; --n )
						if ( jQuery.nodeName(tb[n], "tbody") && !tb[n].childNodes.length )
							tb[n].parentNode.removeChild(tb[n]);
	
					// IE completely kills leading whitespace when innerHTML is used	
					if ( /^\s/.test(arg) )	
						div.insertBefore( doc.createTextNode( arg.match(/^\s*/)[0] ), div.firstChild );

				}
				
				arg = jQuery.makeArray( div.childNodes );
			}

			if ( 0 === arg.length && (!jQuery.nodeName(arg, "form") && !jQuery.nodeName(arg, "select")) )
				return;

			if ( arg[0] == undefined || jQuery.nodeName(arg, "form") || arg.options )
				r.push( arg );
			else
				r = jQuery.merge( r, arg );

		});

		return r;
	},
	
	attr: function(elem, name, value){
		var fix = jQuery.isXMLDoc(elem) ? {} : jQuery.props;

		// Safari mis-reports the default selected property of a hidden option
		// Accessing the parent's selectedIndex property fixes it
		if ( name == "selected" && jQuery.browser.safari )
			elem.parentNode.selectedIndex;
		
		// Certain attributes only work when accessed via the old DOM 0 way
		if ( fix[name] ) {
			if ( value != undefined ) elem[fix[name]] = value;
			return elem[fix[name]];
		} else if ( jQuery.browser.msie && name == "style" )
			return jQuery.attr( elem.style, "cssText", value );

		else if ( value == undefined && jQuery.browser.msie && jQuery.nodeName(elem, "form") && (name == "action" || name == "method") )
			return elem.getAttributeNode(name).nodeValue;

		// IE elem.getAttribute passes even for style
		else if ( elem.tagName ) {

			if ( value != undefined ) {
				if ( name == "type" && jQuery.nodeName(elem,"input") && elem.parentNode )
					throw "type property can't be changed";
				elem.setAttribute( name, value );
			}

			if ( jQuery.browser.msie && /href|src/.test(name) && !jQuery.isXMLDoc(elem) ) 
				return elem.getAttribute( name, 2 );

			return elem.getAttribute( name );

		// elem is actually elem.style ... set the style
		} else {
			// IE actually uses filters for opacity
			if ( name == "opacity" && jQuery.browser.msie ) {
				if ( value != undefined ) {
					// IE has trouble with opacity if it does not have layout
					// Force it by setting the zoom level
					elem.zoom = 1; 
	
					// Set the alpha filter to set the opacity
					elem.filter = (elem.filter || "").replace(/alpha\([^)]*\)/,"") +
						(parseFloat(value).toString() == "NaN" ? "" : "alpha(opacity=" + value * 100 + ")");
				}
	
				return elem.filter ? 
					(parseFloat( elem.filter.match(/opacity=([^)]*)/)[1] ) / 100).toString() : "";
			}
			name = name.replace(/-([a-z])/ig,function(z,b){return b.toUpperCase();});
			if ( value != undefined ) elem[name] = value;
			return elem[name];
		}
	},
	
	trim: function(t){
		return (t||"").replace(/^\s+|\s+$/g, "");
	},

	makeArray: function( a ) {
		var r = [];

		// Need to use typeof to fight Safari childNodes crashes
		if ( typeof a != "array" )
			for ( var i = 0, al = a.length; i < al; i++ )
				r.push( a[i] );
		else
			r = a.slice( 0 );

		return r;
	},

	inArray: function( b, a ) {
		for ( var i = 0, al = a.length; i < al; i++ )
			if ( a[i] == b )
				return i;
		return -1;
	},

	merge: function(first, second) {
		// We have to loop this way because IE & Opera overwrite the length
		// expando of getElementsByTagName

		// Also, we need to make sure that the correct elements are being returned
		// (IE returns comment nodes in a '*' query)
		if ( jQuery.browser.msie ) {
			for ( var i = 0; second[i]; i++ )
				if ( second[i].nodeType != 8 )
					first.push(second[i]);
		} else
			for ( var i = 0; second[i]; i++ )
				first.push(second[i]);

		return first;
	},

	unique: function(first) {
		var r = [], done = {};

		try {
			for ( var i = 0, fl = first.length; i < fl; i++ ) {
				var id = jQuery.data(first[i]);
				if ( !done[id] ) {
					done[id] = true;
					r.push(first[i]);
				}
			}
		} catch(e) {
			r = first;
		}

		return r;
	},

	grep: function(elems, fn, inv) {
		// If a string is passed in for the function, make a function
		// for it (a handy shortcut)
		if ( typeof fn == "string" )
			fn = eval("false||function(a,i){return " + fn + "}");

		var result = [];

		// Go through the array, only saving the items
		// that pass the validator function
		for ( var i = 0, el = elems.length; i < el; i++ )
			if ( !inv && fn(elems[i],i) || inv && !fn(elems[i],i) )
				result.push( elems[i] );

		return result;
	},

	map: function(elems, fn) {
		// If a string is passed in for the function, make a function
		// for it (a handy shortcut)
		if ( typeof fn == "string" )
			fn = eval("false||function(a){return " + fn + "}");

		var result = [];

		// Go through the array, translating each of the items to their
		// new value (or values).
		for ( var i = 0, el = elems.length; i < el; i++ ) {
			var val = fn(elems[i],i);

			if ( val !== null && val != undefined ) {
				if ( val.constructor != Array ) val = [val];
				result = result.concat( val );
			}
		}

		return result;
	}
});

var userAgent = navigator.userAgent.toLowerCase();

// Figure out what browser is being used
jQuery.browser = {
	version: (userAgent.match(/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/) || [])[1],
	safari: /webkit/.test(userAgent),
	opera: /opera/.test(userAgent),
	msie: /msie/.test(userAgent) && !/opera/.test(userAgent),
	mozilla: /mozilla/.test(userAgent) && !/(compatible|webkit)/.test(userAgent)
};

var styleFloat = jQuery.browser.msie ? "styleFloat" : "cssFloat";
	
jQuery.extend({
	// Check to see if the W3C box model is being used
	boxModel: !jQuery.browser.msie || document.compatMode == "CSS1Compat",
	
	styleFloat: jQuery.browser.msie ? "styleFloat" : "cssFloat",
	
	props: {
		"for": "htmlFor",
		"class": "className",
		"float": styleFloat,
		cssFloat: styleFloat,
		styleFloat: styleFloat,
		innerHTML: "innerHTML",
		className: "className",
		value: "value",
		disabled: "disabled",
		checked: "checked",
		readonly: "readOnly",
		selected: "selected",
		maxlength: "maxLength"
	}
});

jQuery.each({
	parent: "a.parentNode",
	parents: "jQuery.dir(a,'parentNode')",
	next: "jQuery.nth(a,2,'nextSibling')",
	prev: "jQuery.nth(a,2,'previousSibling')",
	nextAll: "jQuery.dir(a,'nextSibling')",
	prevAll: "jQuery.dir(a,'previousSibling')",
	siblings: "jQuery.sibling(a.parentNode.firstChild,a)",
	children: "jQuery.sibling(a.firstChild)",
	contents: "jQuery.nodeName(a,'iframe')?a.contentDocument||a.contentWindow.document:jQuery.makeArray(a.childNodes)"
}, function(i,n){
	jQuery.fn[ i ] = function(a) {
		var ret = jQuery.map(this,n);
		if ( a && typeof a == "string" )
			ret = jQuery.multiFilter(a,ret);
		return this.pushStack( jQuery.unique(ret) );
	};
});

jQuery.each({
	appendTo: "append",
	prependTo: "prepend",
	insertBefore: "before",
	insertAfter: "after",
	replaceAll: "replaceWith"
}, function(i,n){
	jQuery.fn[ i ] = function(){
		var a = arguments;
		return this.each(function(){
			for ( var j = 0, al = a.length; j < al; j++ )
				jQuery(a[j])[n]( this );
		});
	};
});

jQuery.each( {
	removeAttr: function( key ) {
		jQuery.attr( this, key, "" );
		this.removeAttribute( key );
	},
	addClass: function(c){
		jQuery.className.add(this,c);
	},
	removeClass: function(c){
		jQuery.className.remove(this,c);
	},
	toggleClass: function( c ){
		jQuery.className[ jQuery.className.has(this,c) ? "remove" : "add" ](this, c);
	},
	remove: function(a){
		if ( !a || jQuery.filter( a, [this] ).r.length ) {
			jQuery.removeData( this );
			this.parentNode.removeChild( this );
		}
	},
	empty: function() {
		// Clean up the cache
		jQuery("*", this).each(function(){ jQuery.removeData(this); });

		while ( this.firstChild )
			this.removeChild( this.firstChild );
	}
}, function(i,n){
	jQuery.fn[ i ] = function() {
		return this.each( n, arguments );
	};
});

jQuery.each( [ "Height", "Width" ], function(i,name){
	var n = name.toLowerCase();
	
	jQuery.fn[ n ] = function(h) {
		return this[0] == window ?
			jQuery.browser.safari && self["inner" + name] ||
			jQuery.boxModel && Math.max(document.documentElement["client" + name], document.body["client" + name]) ||
			document.body["client" + name] :
		
			this[0] == document ?
				Math.max( document.body["scroll" + name], document.body["offset" + name] ) :
        
				h == undefined ?
					( this.length ? jQuery.css( this[0], n ) : null ) :
					this.css( n, h.constructor == String ? h : h + "px" );
	};
});

var chars = jQuery.browser.safari && parseInt(jQuery.browser.version) < 417 ?
		"(?:[\\w*_-]|\\\\.)" :
		"(?:[\\w\u0128-\uFFFF*_-]|\\\\.)",
	quickChild = new RegExp("^>\\s*(" + chars + "+)"),
	quickID = new RegExp("^(" + chars + "+)(#)(" + chars + "+)"),
	quickClass = new RegExp("^([#.]?)(" + chars + "*)");

jQuery.extend({
	expr: {
		"": "m[2]=='*'||jQuery.nodeName(a,m[2])",
		"#": "a.getAttribute('id')==m[2]",
		":": {
			// Position Checks
			lt: "i<m[3]-0",
			gt: "i>m[3]-0",
			nth: "m[3]-0==i",
			eq: "m[3]-0==i",
			first: "i==0",
			last: "i==r.length-1",
			even: "i%2==0",
			odd: "i%2",

			// Child Checks
			"first-child": "a.parentNode.getElementsByTagName('*')[0]==a",
			"last-child": "jQuery.nth(a.parentNode.lastChild,1,'previousSibling')==a",
			"only-child": "!jQuery.nth(a.parentNode.lastChild,2,'previousSibling')",

			// Parent Checks
			parent: "a.firstChild",
			empty: "!a.firstChild",

			// Text Check
			contains: "(a.textContent||a.innerText||jQuery(a).text()||'').indexOf(m[3])>=0",

			// Visibility
			visible: '"hidden"!=a.type&&jQuery.css(a,"display")!="none"&&jQuery.css(a,"visibility")!="hidden"',
			hidden: '"hidden"==a.type||jQuery.css(a,"display")=="none"||jQuery.css(a,"visibility")=="hidden"',

			// Form attributes
			enabled: "!a.disabled",
			disabled: "a.disabled",
			checked: "a.checked",
			selected: "a.selected||jQuery.attr(a,'selected')",

			// Form elements
			text: "'text'==a.type",
			radio: "'radio'==a.type",
			checkbox: "'checkbox'==a.type",
			file: "'file'==a.type",
			password: "'password'==a.type",
			submit: "'submit'==a.type",
			image: "'image'==a.type",
			reset: "'reset'==a.type",
			button: '"button"==a.type||jQuery.nodeName(a,"button")',
			input: "/input|select|textarea|button/i.test(a.nodeName)",

			// :has()
			has: "jQuery.find(m[3],a).length",

			// :header
			header: "/h\\d/i.test(a.nodeName)",

			// :animated
			animated: "jQuery.grep(jQuery.timers,function(fn){return a==fn.elem;}).length"
		}
	},
	
	// The regular expressions that power the parsing engine
	parse: [
		// Match: [@value='test'], [@foo]
		/^(\[) *@?([\w-]+) *([!*$^~=]*) *('?"?)(.*?)\4 *\]/,

		// Match: :contains('foo')
		/^(:)([\w-]+)\("?'?(.*?(\(.*?\))?[^(]*?)"?'?\)/,

		// Match: :even, :last-chlid, #id, .class
		new RegExp("^([:.#]*)(" + chars + "+)")
	],

	multiFilter: function( expr, elems, not ) {
		var old, cur = [];

		while ( expr && expr != old ) {
			old = expr;
			var f = jQuery.filter( expr, elems, not );
			expr = f.t.replace(/^\s*,\s*/, "" );
			cur = not ? elems = f.r : jQuery.merge( cur, f.r );
		}

		return cur;
	},

	find: function( t, context ) {
		// Quickly handle non-string expressions
		if ( typeof t != "string" )
			return [ t ];

		// Make sure that the context is a DOM Element
		if ( context && !context.nodeType )
			context = null;

		// Set the correct context (if none is provided)
		context = context || document;

		// Initialize the search
		var ret = [context], done = [], last;

		// Continue while a selector expression exists, and while
		// we're no longer looping upon ourselves
		while ( t && last != t ) {
			var r = [];
			last = t;

			t = jQuery.trim(t);

			var foundToken = false;

			// An attempt at speeding up child selectors that
			// point to a specific element tag
			var re = quickChild;
			var m = re.exec(t);

			if ( m ) {
				var nodeName = m[1].toUpperCase();

				// Perform our own iteration and filter
				for ( var i = 0; ret[i]; i++ )
					for ( var c = ret[i].firstChild; c; c = c.nextSibling )
						if ( c.nodeType == 1 && (nodeName == "*" || c.nodeName.toUpperCase() == nodeName.toUpperCase()) )
							r.push( c );

				ret = r;
				t = t.replace( re, "" );
				if ( t.indexOf(" ") == 0 ) continue;
				foundToken = true;
			} else {
				re = /^([>+~])\s*(\w*)/i;

				if ( (m = re.exec(t)) != null ) {
					r = [];

					var nodeName = m[2], merge = {};
					m = m[1];

					for ( var j = 0, rl = ret.length; j < rl; j++ ) {
						var n = m == "~" || m == "+" ? ret[j].nextSibling : ret[j].firstChild;
						for ( ; n; n = n.nextSibling )
							if ( n.nodeType == 1 ) {
								var id = jQuery.data(n);

								if ( m == "~" && merge[id] ) break;
								
								if (!nodeName || n.nodeName.toUpperCase() == nodeName.toUpperCase() ) {
									if ( m == "~" ) merge[id] = true;
									r.push( n );
								}
								
								if ( m == "+" ) break;
							}
					}

					ret = r;

					// And remove the token
					t = jQuery.trim( t.replace( re, "" ) );
					foundToken = true;
				}
			}

			// See if there's still an expression, and that we haven't already
			// matched a token
			if ( t && !foundToken ) {
				// Handle multiple expressions
				if ( !t.indexOf(",") ) {
					// Clean the result set
					if ( context == ret[0] ) ret.shift();

					// Merge the result sets
					done = jQuery.merge( done, ret );

					// Reset the context
					r = ret = [context];

					// Touch up the selector string
					t = " " + t.substr(1,t.length);

				} else {
					// Optimize for the case nodeName#idName
					var re2 = quickID;
					var m = re2.exec(t);
					
					// Re-organize the results, so that they're consistent
					if ( m ) {
					   m = [ 0, m[2], m[3], m[1] ];

					} else {
						// Otherwise, do a traditional filter check for
						// ID, class, and element selectors
						re2 = quickClass;
						m = re2.exec(t);
					}

					m[2] = m[2].replace(/\\/g, "");

					var elem = ret[ret.length-1];

					// Try to do a global search by ID, where we can
					if ( m[1] == "#" && elem && elem.getElementById && !jQuery.isXMLDoc(elem) ) {
						// Optimization for HTML document case
						var oid = elem.getElementById(m[2]);
						
						// Do a quick check for the existence of the actual ID attribute
						// to avoid selecting by the name attribute in IE
						// also check to insure id is a string to avoid selecting an element with the name of 'id' inside a form
						if ( (jQuery.browser.msie||jQuery.browser.opera) && oid && typeof oid.id == "string" && oid.id != m[2] )
							oid = jQuery('[@id="'+m[2]+'"]', elem)[0];

						// Do a quick check for node name (where applicable) so
						// that div#foo searches will be really fast
						ret = r = oid && (!m[3] || jQuery.nodeName(oid, m[3])) ? [oid] : [];
					} else {
						// We need to find all descendant elements
						for ( var i = 0; ret[i]; i++ ) {
							// Grab the tag name being searched for
							var tag = m[1] == "#" && m[3] ? m[3] : m[1] != "" || m[0] == "" ? "*" : m[2];

							// Handle IE7 being really dumb about <object>s
							if ( tag == "*" && ret[i].nodeName.toLowerCase() == "object" )
								tag = "param";

							r = jQuery.merge( r, ret[i].getElementsByTagName( tag ));
						}

						// It's faster to filter by class and be done with it
						if ( m[1] == "." )
							r = jQuery.classFilter( r, m[2] );

						// Same with ID filtering
						if ( m[1] == "#" ) {
							var tmp = [];

							// Try to find the element with the ID
							for ( var i = 0; r[i]; i++ )
								if ( r[i].getAttribute("id") == m[2] ) {
									tmp = [ r[i] ];
									break;
								}

							r = tmp;
						}

						ret = r;
					}

					t = t.replace( re2, "" );
				}

			}

			// If a selector string still exists
			if ( t ) {
				// Attempt to filter it
				var val = jQuery.filter(t,r);
				ret = r = val.r;
				t = jQuery.trim(val.t);
			}
		}

		// An error occurred with the selector;
		// just return an empty set instead
		if ( t )
			ret = [];

		// Remove the root context
		if ( ret && context == ret[0] )
			ret.shift();

		// And combine the results
		done = jQuery.merge( done, ret );

		return done;
	},

	classFilter: function(r,m,not){
		m = " " + m + " ";
		var tmp = [];
		for ( var i = 0; r[i]; i++ ) {
			var pass = (" " + r[i].className + " ").indexOf( m ) >= 0;
			if ( !not && pass || not && !pass )
				tmp.push( r[i] );
		}
		return tmp;
	},

	filter: function(t,r,not) {
		var last;

		// Look for common filter expressions
		while ( t  && t != last ) {
			last = t;

			var p = jQuery.parse, m;

			for ( var i = 0; p[i]; i++ ) {
				m = p[i].exec( t );

				if ( m ) {
					// Remove what we just matched
					t = t.substring( m[0].length );

					m[2] = m[2].replace(/\\/g, "");
					break;
				}
			}

			if ( !m )
				break;

			// :not() is a special case that can be optimized by
			// keeping it out of the expression list
			if ( m[1] == ":" && m[2] == "not" )
				r = jQuery.filter(m[3], r, true).r;

			// We can get a big speed boost by filtering by class here
			else if ( m[1] == "." )
				r = jQuery.classFilter(r, m[2], not);

			else if ( m[1] == "[" ) {
				var tmp = [], type = m[3];
				
				for ( var i = 0, rl = r.length; i < rl; i++ ) {
					var a = r[i], z = a[ jQuery.props[m[2]] || m[2] ];
					
					if ( z == null || /href|src|selected/.test(m[2]) )
						z = jQuery.attr(a,m[2]) || '';

					if ( (type == "" && !!z ||
						 type == "=" && z == m[5] ||
						 type == "!=" && z != m[5] ||
						 type == "^=" && z && !z.indexOf(m[5]) ||
						 type == "$=" && z.substr(z.length - m[5].length) == m[5] ||
						 (type == "*=" || type == "~=") && z.indexOf(m[5]) >= 0) ^ not )
							tmp.push( a );
				}
				
				r = tmp;

			// We can get a speed boost by handling nth-child here
			} else if ( m[1] == ":" && m[2] == "nth-child" ) {
				var merge = {}, tmp = [],
					test = /(\d*)n\+?(\d*)/.exec(
						m[3] == "even" && "2n" || m[3] == "odd" && "2n+1" ||
						!/\D/.test(m[3]) && "n+" + m[3] || m[3]),
					first = (test[1] || 1) - 0, last = test[2] - 0;

				for ( var i = 0, rl = r.length; i < rl; i++ ) {
					var node = r[i], parentNode = node.parentNode, id = jQuery.data(parentNode);

					if ( !merge[id] ) {
						var c = 1;

						for ( var n = parentNode.firstChild; n; n = n.nextSibling )
							if ( n.nodeType == 1 )
								n.nodeIndex = c++;

						merge[id] = true;
					}

					var add = false;

					if ( first == 1 ) {
						if ( last == 0 || node.nodeIndex == last )
							add = true;
					} else if ( (node.nodeIndex + last) % first == 0 )
						add = true;

					if ( add ^ not )
						tmp.push( node );
				}

				r = tmp;

			// Otherwise, find the expression to execute
			} else {
				var f = jQuery.expr[m[1]];
				if ( typeof f != "string" )
					f = jQuery.expr[m[1]][m[2]];

				// Build a custom macro to enclose it
				f = eval("false||function(a,i){return " + f + "}");

				// Execute it against the current filter
				r = jQuery.grep( r, f, not );
			}
		}

		// Return an array of filtered elements (r)
		// and the modified expression string (t)
		return { r: r, t: t };
	},

	dir: function( elem, dir ){
		var matched = [];
		var cur = elem[dir];
		while ( cur && cur != document ) {
			if ( cur.nodeType == 1 )
				matched.push( cur );
			cur = cur[dir];
		}
		return matched;
	},
	
	nth: function(cur,result,dir,elem){
		result = result || 1;
		var num = 0;

		for ( ; cur; cur = cur[dir] )
			if ( cur.nodeType == 1 && ++num == result )
				break;

		return cur;
	},
	
	sibling: function( n, elem ) {
		var r = [];

		for ( ; n; n = n.nextSibling ) {
			if ( n.nodeType == 1 && (!elem || n != elem) )
				r.push( n );
		}

		return r;
	}
});
/*
 * A number of helper functions used for managing events.
 * Many of the ideas behind this code orignated from 
 * Dean Edwards' addEvent library.
 */
jQuery.event = {

	// Bind an event to an element
	// Original by Dean Edwards
	add: function(element, type, handler, data) {
		// For whatever reason, IE has trouble passing the window object
		// around, causing it to be cloned in the process
		if ( jQuery.browser.msie && element.setInterval != undefined )
			element = window;

		// Make sure that the function being executed has a unique ID
		if ( !handler.guid )
			handler.guid = this.guid++;
			
		// if data is passed, bind to handler 
		if( data != undefined ) { 
        		// Create temporary function pointer to original handler 
			var fn = handler; 

			// Create unique handler function, wrapped around original handler 
			handler = function() { 
				// Pass arguments and context to original handler 
				return fn.apply(this, arguments); 
			};

			// Store data in unique handler 
			handler.data = data;

			// Set the guid of unique handler to the same of original handler, so it can be removed 
			handler.guid = fn.guid;
		}

		// Namespaced event handlers
		var parts = type.split(".");
		type = parts[0];
		handler.type = parts[1];

		// Init the element's event structure
		var events = jQuery.data(element, "events") || jQuery.data(element, "events", {});
		
		var handle = jQuery.data(element, "handle", function(){
			// returned undefined or false
			var val;

			// Handle the second event of a trigger and when
			// an event is called after a page has unloaded
			if ( typeof jQuery == "undefined" || jQuery.event.triggered )
				return val;
			
			val = jQuery.event.handle.apply(element, arguments);
			
			return val;
		});

		// Get the current list of functions bound to this event
		var handlers = events[type];

		// Init the event handler queue
		if (!handlers) {
			handlers = events[type] = {};	
			
			// And bind the global event handler to the element
			if (element.addEventListener)
				element.addEventListener(type, handle, false);
			else
				element.attachEvent("on" + type, handle);
		}

		// Add the function to the element's handler list
		handlers[handler.guid] = handler;

		// Keep track of which events have been used, for global triggering
		this.global[type] = true;
	},

	guid: 1,
	global: {},

	// Detach an event or set of events from an element
	remove: function(element, type, handler) {
		var events = jQuery.data(element, "events"), ret, index;

		// Namespaced event handlers
		if ( typeof type == "string" ) {
			var parts = type.split(".");
			type = parts[0];
		}

		if ( events ) {
			// type is actually an event object here
			if ( type && type.type ) {
				handler = type.handler;
				type = type.type;
			}
			
			if ( !type ) {
				for ( type in events )
					this.remove( element, type );

			} else if ( events[type] ) {
				// remove the given handler for the given type
				if ( handler )
					delete events[type][handler.guid];
				
				// remove all handlers for the given type
				else
					for ( handler in events[type] )
						// Handle the removal of namespaced events
						if ( !parts[1] || events[type][handler].type == parts[1] )
							delete events[type][handler];

				// remove generic event handler if no more handlers exist
				for ( ret in events[type] ) break;
				if ( !ret ) {
					if (element.removeEventListener)
						element.removeEventListener(type, jQuery.data(element, "handle"), false);
					else
						element.detachEvent("on" + type, jQuery.data(element, "handle"));
					ret = null;
					delete events[type];
				}
			}

			// Remove the expando if it's no longer used
			for ( ret in events ) break;
			if ( !ret ) {
				jQuery.removeData( element, "events" );
				jQuery.removeData( element, "handle" );
			}
		}
	},

	trigger: function(type, data, element, donative, extra) {
		// Clone the incoming data, if any
		data = jQuery.makeArray(data || []);

		// Handle a global trigger
		if ( !element ) {
			// Only trigger if we've ever bound an event for it
			if ( this.global[type] )
				jQuery("*").add([window, document]).trigger(type, data);

		// Handle triggering a single element
		} else {
			var val, ret, fn = jQuery.isFunction( element[ type ] || null ),
				// Check to see if we need to provide a fake event, or not
				evt = !data[0] || !data[0].preventDefault;
			
			// Pass along a fake event
			if ( evt )
				data.unshift( this.fix({ type: type, target: element }) );

			// Enforce the right trigger type
			data[0].type = type;

			// Trigger the event
			if ( jQuery.isFunction( jQuery.data(element, "handle") ) )
				val = jQuery.data(element, "handle").apply( element, data );

			// Handle triggering native .onfoo handlers
			if ( !fn && element["on"+type] && element["on"+type].apply( element, data ) === false )
				val = false;

			// Extra functions don't get the custom event object
			if ( evt )
				data.shift();

			// Handle triggering of extra function
			if ( extra && extra.apply( element, data ) === false )
				val = false;

			// Trigger the native events (except for clicks on links)
			if ( fn && donative !== false && val !== false && !(jQuery.nodeName(element, 'a') && type == "click") ) {
				this.triggered = true;
				element[ type ]();
			}

			this.triggered = false;
		}

		return val;
	},

	handle: function(event) {
		// returned undefined or false
		var val;

		// Empty object is for triggered events with no data
		event = jQuery.event.fix( event || window.event || {} ); 

		// Namespaced event handlers
		var parts = event.type.split(".");
		event.type = parts[0];

		var c = jQuery.data(this, "events") && jQuery.data(this, "events")[event.type], args = Array.prototype.slice.call( arguments, 1 );
		args.unshift( event );

		for ( var j in c ) {
			// Pass in a reference to the handler function itself
			// So that we can later remove it
			args[0].handler = c[j];
			args[0].data = c[j].data;

			// Filter the functions by class
			if ( !parts[1] || c[j].type == parts[1] ) {
				var tmp = c[j].apply( this, args );

				if ( val !== false )
					val = tmp;

				if ( tmp === false ) {
					event.preventDefault();
					event.stopPropagation();
				}
			}
		}

		// Clean up added properties in IE to prevent memory leak
		if (jQuery.browser.msie)
			event.target = event.preventDefault = event.stopPropagation =
				event.handler = event.data = null;

		return val;
	},

	fix: function(event) {
		// store a copy of the original event object 
		// and clone to set read-only properties
		var originalEvent = event;
		event = jQuery.extend({}, originalEvent);
		
		// add preventDefault and stopPropagation since 
		// they will not work on the clone
		event.preventDefault = function() {
			// if preventDefault exists run it on the original event
			if (originalEvent.preventDefault)
				originalEvent.preventDefault();
			// otherwise set the returnValue property of the original event to false (IE)
			originalEvent.returnValue = false;
		};
		event.stopPropagation = function() {
			// if stopPropagation exists run it on the original event
			if (originalEvent.stopPropagation)
				originalEvent.stopPropagation();
			// otherwise set the cancelBubble property of the original event to true (IE)
			originalEvent.cancelBubble = true;
		};
		
		// Fix target property, if necessary
		if ( !event.target && event.srcElement )
			event.target = event.srcElement;
				
		// check if target is a textnode (safari)
		if (jQuery.browser.safari && event.target.nodeType == 3)
			event.target = originalEvent.target.parentNode;

		// Add relatedTarget, if necessary
		if ( !event.relatedTarget && event.fromElement )
			event.relatedTarget = event.fromElement == event.target ? event.toElement : event.fromElement;

		// Calculate pageX/Y if missing and clientX/Y available
		if ( event.pageX == null && event.clientX != null ) {
			var e = document.documentElement, b = document.body;
			event.pageX = event.clientX + (e && e.scrollLeft || b.scrollLeft || 0);
			event.pageY = event.clientY + (e && e.scrollTop || b.scrollTop || 0);
		}
			
		// Add which for key events
		if ( !event.which && (event.charCode || event.keyCode) )
			event.which = event.charCode || event.keyCode;
		
		// Add metaKey to non-Mac browsers (use ctrl for PC's and Meta for Macs)
		if ( !event.metaKey && event.ctrlKey )
			event.metaKey = event.ctrlKey;

		// Add which for click: 1 == left; 2 == middle; 3 == right
		// Note: button is not normalized, so don't use it
		if ( !event.which && event.button )
			event.which = (event.button & 1 ? 1 : ( event.button & 2 ? 3 : ( event.button & 4 ? 2 : 0 ) ));
			
		return event;
	}
};

jQuery.fn.extend({
	bind: function( type, data, fn ) {
		return type == "unload" ? this.one(type, data, fn) : this.each(function(){
			jQuery.event.add( this, type, fn || data, fn && data );
		});
	},
	
	one: function( type, data, fn ) {
		return this.each(function(){
			jQuery.event.add( this, type, function(event) {
				jQuery(this).unbind(event);
				return (fn || data).apply( this, arguments);
			}, fn && data);
		});
	},

	unbind: function( type, fn ) {
		return this.each(function(){
			jQuery.event.remove( this, type, fn );
		});
	},

	trigger: function( type, data, fn ) {
		return this.each(function(){
			jQuery.event.trigger( type, data, this, true, fn );
		});
	},

	triggerHandler: function( type, data, fn ) {
		if ( this[0] )
			return jQuery.event.trigger( type, data, this[0], false, fn );
	},

	toggle: function() {
		// Save reference to arguments for access in closure
		var a = arguments;

		return this.click(function(e) {
			// Figure out which function to execute
			this.lastToggle = 0 == this.lastToggle ? 1 : 0;
			
			// Make sure that clicks stop
			e.preventDefault();
			
			// and execute the function
			return a[this.lastToggle].apply( this, [e] ) || false;
		});
	},

	hover: function(f,g) {
		
		// A private function for handling mouse 'hovering'
		function handleHover(e) {
			// Check if mouse(over|out) are still within the same parent element
			var p = e.relatedTarget;
	
			// Traverse up the tree
			while ( p && p != this ) try { p = p.parentNode; } catch(e) { p = this; };
			
			// If we actually just moused on to a sub-element, ignore it
			if ( p == this ) return false;
			
			// Execute the right function
			return (e.type == "mouseover" ? f : g).apply(this, [e]);
		}
		
		// Bind the function to the two event listeners
		return this.mouseover(handleHover).mouseout(handleHover);
	},
	
	ready: function(f) {
		// Attach the listeners
		bindReady();

		// If the DOM is already ready
		if ( jQuery.isReady )
			// Execute the function immediately
			f.apply( document, [jQuery] );
			
		// Otherwise, remember the function for later
		else
			// Add the function to the wait list
			jQuery.readyList.push( function() { return f.apply(this, [jQuery]); } );
	
		return this;
	}
});

jQuery.extend({
	/*
	 * All the code that makes DOM Ready work nicely.
	 */
	isReady: false,
	readyList: [],
	
	// Handle when the DOM is ready
	ready: function() {
		// Make sure that the DOM is not already loaded
		if ( !jQuery.isReady ) {
			// Remember that the DOM is ready
			jQuery.isReady = true;
			
			// If there are functions bound, to execute
			if ( jQuery.readyList ) {
				// Execute all of them
				jQuery.each( jQuery.readyList, function(){
					this.apply( document );
				});
				
				// Reset the list of functions
				jQuery.readyList = null;
			}
			// Remove event listener to avoid memory leak
			if ( jQuery.browser.mozilla || jQuery.browser.opera )
				document.removeEventListener( "DOMContentLoaded", jQuery.ready, false );
			
			// Remove script element used by IE hack
			if( !window.frames.length ) // don't remove if frames are present (#1187)
				jQuery(window).load(function(){ jQuery("#__ie_init").remove(); });
		}
	}
});

jQuery.each( ("blur,focus,load,resize,scroll,unload,click,dblclick," +
	"mousedown,mouseup,mousemove,mouseover,mouseout,change,select," + 
	"submit,keydown,keypress,keyup,error").split(","), function(i,o){
	
	// Handle event binding
	jQuery.fn[o] = function(f){
		return f ? this.bind(o, f) : this.trigger(o);
	};
});

var readyBound = false;

function bindReady(){
	if ( readyBound ) return;
	readyBound = true;

	// If Mozilla is used
	if ( jQuery.browser.mozilla || jQuery.browser.opera )
		// Use the handy event callback
		document.addEventListener( "DOMContentLoaded", jQuery.ready, false );
	
	// If IE is used, use the excellent hack by Matthias Miller
	// http://www.outofhanwell.com/blog/index.php?title=the_window_onload_problem_revisited
	else if ( jQuery.browser.msie ) {
	
		// Only works if you document.write() it
		document.write("<scr" + "ipt id=__ie_init defer=true " + 
			"src=//:><\/script>");
	
		// Use the defer script hack
		var script = document.getElementById("__ie_init");
		
		// script does not exist if jQuery is loaded dynamically
		if ( script ) 
			script.onreadystatechange = function() {
				if ( this.readyState != "complete" ) return;
				jQuery.ready();
			};
	
		// Clear from memory
		script = null;
	
	// If Safari  is used
	} else if ( jQuery.browser.safari )
		// Continually check to see if the document.readyState is valid
		jQuery.safariTimer = setInterval(function(){
			// loaded and complete are both valid states
			if ( document.readyState == "loaded" || 
				document.readyState == "complete" ) {
	
				// If either one are found, remove the timer
				clearInterval( jQuery.safariTimer );
				jQuery.safariTimer = null;
	
				// and execute any waiting functions
				jQuery.ready();
			}
		}, 10); 

	// A fallback to window.onload, that will always work
	jQuery.event.add( window, "load", jQuery.ready );
}
jQuery.fn.extend({
	load: function( url, params, callback ) {
		if ( jQuery.isFunction( url ) )
			return this.bind("load", url);

		var off = url.indexOf(" ");
		if ( off >= 0 ) {
			var selector = url.slice(off, url.length);
			url = url.slice(0, off);
		}

		callback = callback || function(){};

		// Default to a GET request
		var type = "GET";

		// If the second parameter was provided
		if ( params )
			// If it's a function
			if ( jQuery.isFunction( params ) ) {
				// We assume that it's the callback
				callback = params;
				params = null;

			// Otherwise, build a param string
			} else {
				params = jQuery.param( params );
				type = "POST";
			}

		var self = this;

		// Request the remote document
		jQuery.ajax({
			url: url,
			type: type,
			data: params,
			complete: function(res, status){
				// If successful, inject the HTML into all the matched elements
				if ( status == "success" || status == "notmodified" )
					// See if a selector was specified
					self.html( selector ?
						// Create a dummy div to hold the results
						jQuery("<div/>")
							// inject the contents of the document in, removing the scripts
							// to avoid any 'Permission Denied' errors in IE
							.append(res.responseText.replace(/<script(.|\s)*?\/script>/g, ""))

							// Locate the specified elements
							.find(selector) :

						// If not, just inject the full result
						res.responseText );

				// Add delay to account for Safari's delay in globalEval
				setTimeout(function(){
					self.each( callback, [res.responseText, status, res] );
				}, 13);
			}
		});
		return this;
	},

	serialize: function() {
		return jQuery.param(this.serializeArray());
	},
	serializeArray: function() {
		return this.map(function(){
			return jQuery.nodeName(this, "form") ?
				jQuery.makeArray(this.elements) : this;
		})
		.filter(function(){
			return this.name && !this.disabled && 
				(this.checked || /select|textarea/i.test(this.nodeName) || 
					/text|hidden|password/i.test(this.type));
		})
		.map(function(i, elem){
			var val = jQuery(this).val();
			return val == null ? null :
				val.constructor == Array ?
					jQuery.map( val, function(val, i){
						return {name: elem.name, value: val};
					}) :
					{name: elem.name, value: val};
		}).get();
	}
});

// Attach a bunch of functions for handling common AJAX events
jQuery.each( "ajaxStart,ajaxStop,ajaxComplete,ajaxError,ajaxSuccess,ajaxSend".split(","), function(i,o){
	jQuery.fn[o] = function(f){
		return this.bind(o, f);
	};
});

var jsc = (new Date).getTime();

jQuery.extend({
	get: function( url, data, callback, type ) {
		// shift arguments if data argument was ommited
		if ( jQuery.isFunction( data ) ) {
			callback = data;
			data = null;
		}
		
		return jQuery.ajax({
			type: "GET",
			url: url,
			data: data,
			success: callback,
			dataType: type
		});
	},

	getScript: function( url, callback ) {
		return jQuery.get(url, null, callback, "script");
	},

	getJSON: function( url, data, callback ) {
		return jQuery.get(url, data, callback, "json");
	},

	post: function( url, data, callback, type ) {
		if ( jQuery.isFunction( data ) ) {
			callback = data;
			data = {};
		}

		return jQuery.ajax({
			type: "POST",
			url: url,
			data: data,
			success: callback,
			dataType: type
		});
	},

	ajaxSetup: function( settings ) {
		jQuery.extend( jQuery.ajaxSettings, settings );
	},

	ajaxSettings: {
		global: true,
		type: "GET",
		timeout: 0,
		contentType: "application/x-www-form-urlencoded",
		processData: true,
		async: true,
		data: null
	},
	
	// Last-Modified header cache for next request
	lastModified: {},

	ajax: function( s ) {
		var jsonp, jsre = /=(\?|%3F)/g, status, data;

		// Extend the settings, but re-extend 's' so that it can be
		// checked again later (in the test suite, specifically)
		s = jQuery.extend(true, s, jQuery.extend(true, {}, jQuery.ajaxSettings, s));

		// convert data if not already a string
		if ( s.data && s.processData && typeof s.data != "string" )
			s.data = jQuery.param(s.data);

		// Handle JSONP Parameter Callbacks
		if ( s.dataType == "jsonp" ) {
			if ( s.type.toLowerCase() == "get" ) {
				if ( !s.url.match(jsre) )
					s.url += (s.url.match(/\?/) ? "&" : "?") + (s.jsonp || "callback") + "=?";
			} else if ( !s.data || !s.data.match(jsre) )
				s.data = (s.data ? s.data + "&" : "") + (s.jsonp || "callback") + "=?";
			s.dataType = "json";
		}

		// Build temporary JSONP function
		if ( s.dataType == "json" && (s.data && s.data.match(jsre) || s.url.match(jsre)) ) {
			jsonp = "jsonp" + jsc++;

			// Replace the =? sequence both in the query string and the data
			if ( s.data )
				s.data = s.data.replace(jsre, "=" + jsonp);
			s.url = s.url.replace(jsre, "=" + jsonp);

			// We need to make sure
			// that a JSONP style response is executed properly
			s.dataType = "script";

			// Handle JSONP-style loading
			window[ jsonp ] = function(tmp){
				data = tmp;
				success();
				complete();
				// Garbage collect
				window[ jsonp ] = undefined;
				try{ delete window[ jsonp ]; } catch(e){}
			};
		}

		if ( s.dataType == "script" && s.cache == null )
			s.cache = false;

		if ( s.cache === false && s.type.toLowerCase() == "get" )
			s.url += (s.url.match(/\?/) ? "&" : "?") + "_=" + (new Date()).getTime();

		// If data is available, append data to url for get requests
		if ( s.data && s.type.toLowerCase() == "get" ) {
			s.url += (s.url.match(/\?/) ? "&" : "?") + s.data;

			// IE likes to send both get and post data, prevent this
			s.data = null;
		}

		// Watch for a new set of requests
		if ( s.global && ! jQuery.active++ )
			jQuery.event.trigger( "ajaxStart" );

		// If we're requesting a remote document
		// and trying to load JSON or Script
		if ( !s.url.indexOf("http") && s.dataType == "script" ) {
			var head = document.getElementsByTagName("head")[0];
			var script = document.createElement("script");
			script.src = s.url;

			// Handle Script loading
			if ( !jsonp && (s.success || s.complete) ) {
				var done = false;

				// Attach handlers for all browsers
				script.onload = script.onreadystatechange = function(){
					if ( !done && (!this.readyState || 
							this.readyState == "loaded" || this.readyState == "complete") ) {
						done = true;
						success();
						complete();
						head.removeChild( script );
					}
				};
			}

			head.appendChild(script);

			// We handle everything using the script element injection
			return;
		}

		var requestDone = false;

		// Create the request object; Microsoft failed to properly
		// implement the XMLHttpRequest in IE7, so we use the ActiveXObject when it is available
		var xml = window.ActiveXObject ? new ActiveXObject("Microsoft.XMLHTTP") : new XMLHttpRequest();

		// Open the socket
		xml.open(s.type, s.url, s.async);

		// Set the correct header, if data is being sent
		if ( s.data )
			xml.setRequestHeader("Content-Type", s.contentType);

		// Set the If-Modified-Since header, if ifModified mode.
		if ( s.ifModified )
			xml.setRequestHeader("If-Modified-Since",
				jQuery.lastModified[s.url] || "Thu, 01 Jan 1970 00:00:00 GMT" );

		// Set header so the called script knows that it's an XMLHttpRequest
		xml.setRequestHeader("X-Requested-With", "XMLHttpRequest");

		// Allow custom headers/mimetypes
		if ( s.beforeSend )
			s.beforeSend(xml);
			
		if ( s.global )
		    jQuery.event.trigger("ajaxSend", [xml, s]);

		// Wait for a response to come back
		var onreadystatechange = function(isTimeout){
			// The transfer is complete and the data is available, or the request timed out
			if ( !requestDone && xml && (xml.readyState == 4 || isTimeout == "timeout") ) {
				requestDone = true;
				
				// clear poll interval
				if (ival) {
					clearInterval(ival);
					ival = null;
				}
				
				status = isTimeout == "timeout" && "timeout" ||
					!jQuery.httpSuccess( xml ) && "error" ||
					s.ifModified && jQuery.httpNotModified( xml, s.url ) && "notmodified" ||
					"success";

				if ( status == "success" ) {
					// Watch for, and catch, XML document parse errors
					try {
						// process the data (runs the xml through httpData regardless of callback)
						data = jQuery.httpData( xml, s.dataType );
					} catch(e) {
						status = "parsererror";
					}
				}

				// Make sure that the request was successful or notmodified
				if ( status == "success" ) {
					// Cache Last-Modified header, if ifModified mode.
					var modRes;
					try {
						modRes = xml.getResponseHeader("Last-Modified");
					} catch(e) {} // swallow exception thrown by FF if header is not available
	
					if ( s.ifModified && modRes )
						jQuery.lastModified[s.url] = modRes;

					// JSONP handles its own success callback
					if ( !jsonp )
						success();	
				} else
					jQuery.handleError(s, xml, status);

				// Fire the complete handlers
				complete();

				// Stop memory leaks
				if ( s.async )
					xml = null;
			}
		};
		
		if ( s.async ) {
			// don't attach the handler to the request, just poll it instead
			var ival = setInterval(onreadystatechange, 13); 

			// Timeout checker
			if ( s.timeout > 0 )
				setTimeout(function(){
					// Check to see if the request is still happening
					if ( xml ) {
						// Cancel the request
						xml.abort();
	
						if( !requestDone )
							onreadystatechange( "timeout" );
					}
				}, s.timeout);
		}
			
		// Send the data
		try {
			xml.send(s.data);
		} catch(e) {
			jQuery.handleError(s, xml, null, e);
		}
		
		// firefox 1.5 doesn't fire statechange for sync requests
		if ( !s.async )
			onreadystatechange();
		
		// return XMLHttpRequest to allow aborting the request etc.
		return xml;

		function success(){
			// If a local callback was specified, fire it and pass it the data
			if ( s.success )
				s.success( data, status );

			// Fire the global callback
			if ( s.global )
				jQuery.event.trigger( "ajaxSuccess", [xml, s] );
		}

		function complete(){
			// Process result
			if ( s.complete )
				s.complete(xml, status);

			// The request was completed
			if ( s.global )
				jQuery.event.trigger( "ajaxComplete", [xml, s] );

			// Handle the global AJAX counter
			if ( s.global && ! --jQuery.active )
				jQuery.event.trigger( "ajaxStop" );
		}
	},

	handleError: function( s, xml, status, e ) {
		// If a local callback was specified, fire it
		if ( s.error ) s.error( xml, status, e );

		// Fire the global callback
		if ( s.global )
			jQuery.event.trigger( "ajaxError", [xml, s, e] );
	},

	// Counter for holding the number of active queries
	active: 0,

	// Determines if an XMLHttpRequest was successful or not
	httpSuccess: function( r ) {
		try {
			return !r.status && location.protocol == "file:" ||
				( r.status >= 200 && r.status < 300 ) || r.status == 304 ||
				jQuery.browser.safari && r.status == undefined;
		} catch(e){}
		return false;
	},

	// Determines if an XMLHttpRequest returns NotModified
	httpNotModified: function( xml, url ) {
		try {
			var xmlRes = xml.getResponseHeader("Last-Modified");

			// Firefox always returns 200. check Last-Modified date
			return xml.status == 304 || xmlRes == jQuery.lastModified[url] ||
				jQuery.browser.safari && xml.status == undefined;
		} catch(e){}
		return false;
	},

	httpData: function( r, type ) {
		var ct = r.getResponseHeader("content-type");
		var xml = type == "xml" || !type && ct && ct.indexOf("xml") >= 0;
		var data = xml ? r.responseXML : r.responseText;

		if ( xml && data.documentElement.tagName == "parsererror" )
			throw "parsererror";

		// If the type is "script", eval it in global context
		if ( type == "script" )
			jQuery.globalEval( data );

		// Get the JavaScript object, if JSON is used.
		if ( type == "json" )
			data = eval("(" + data + ")");

		return data;
	},

	// Serialize an array of form elements or a set of
	// key/values into a query string
	param: function( a ) {
		var s = [];

		// If an array was passed in, assume that it is an array
		// of form elements
		if ( a.constructor == Array || a.jquery )
			// Serialize the form elements
			jQuery.each( a, function(){
				s.push( encodeURIComponent(this.name) + "=" + encodeURIComponent( this.value ) );
			});

		// Otherwise, assume that it's an object of key/value pairs
		else
			// Serialize the key/values
			for ( var j in a )
				// If the value is an array then the key names need to be repeated
				if ( a[j] && a[j].constructor == Array )
					jQuery.each( a[j], function(){
						s.push( encodeURIComponent(j) + "=" + encodeURIComponent( this ) );
					});
				else
					s.push( encodeURIComponent(j) + "=" + encodeURIComponent( a[j] ) );

		// Return the resulting serialization
		return s.join("&").replace(/%20/g, "+");
	}

});
jQuery.fn.extend({
	show: function(speed,callback){
		return speed ?
			this.animate({
				height: "show", width: "show", opacity: "show"
			}, speed, callback) :
			
			this.filter(":hidden").each(function(){
				this.style.display = this.oldblock ? this.oldblock : "";
				if ( jQuery.css(this,"display") == "none" )
					this.style.display = "block";
			}).end();
	},
	
	hide: function(speed,callback){
		return speed ?
			this.animate({
				height: "hide", width: "hide", opacity: "hide"
			}, speed, callback) :
			
			this.filter(":visible").each(function(){
				this.oldblock = this.oldblock || jQuery.css(this,"display");
				if ( this.oldblock == "none" )
					this.oldblock = "block";
				this.style.display = "none";
			}).end();
	},

	// Save the old toggle function
	_toggle: jQuery.fn.toggle,
	
	toggle: function( fn, fn2 ){
		return jQuery.isFunction(fn) && jQuery.isFunction(fn2) ?
			this._toggle( fn, fn2 ) :
			fn ?
				this.animate({
					height: "toggle", width: "toggle", opacity: "toggle"
				}, fn, fn2) :
				this.each(function(){
					jQuery(this)[ jQuery(this).is(":hidden") ? "show" : "hide" ]();
				});
	},
	
	slideDown: function(speed,callback){
		return this.animate({height: "show"}, speed, callback);
	},
	
	slideUp: function(speed,callback){
		return this.animate({height: "hide"}, speed, callback);
	},

	slideToggle: function(speed, callback){
		return this.animate({height: "toggle"}, speed, callback);
	},
	
	fadeIn: function(speed, callback){
		return this.animate({opacity: "show"}, speed, callback);
	},
	
	fadeOut: function(speed, callback){
		return this.animate({opacity: "hide"}, speed, callback);
	},
	
	fadeTo: function(speed,to,callback){
		return this.animate({opacity: to}, speed, callback);
	},
	
	animate: function( prop, speed, easing, callback ) {
		var opt = jQuery.speed(speed, easing, callback);

		return this[ opt.queue === false ? "each" : "queue" ](function(){
			opt = jQuery.extend({}, opt);
			var hidden = jQuery(this).is(":hidden"), self = this;
			
			for ( var p in prop ) {
				if ( prop[p] == "hide" && hidden || prop[p] == "show" && !hidden )
					return jQuery.isFunction(opt.complete) && opt.complete.apply(this);

				if ( p == "height" || p == "width" ) {
					// Store display property
					opt.display = jQuery.css(this, "display");

					// Make sure that nothing sneaks out
					opt.overflow = this.style.overflow;
				}
			}

			if ( opt.overflow != null )
				this.style.overflow = "hidden";

			opt.curAnim = jQuery.extend({}, prop);
			
			jQuery.each( prop, function(name, val){
				var e = new jQuery.fx( self, opt, name );

				if ( /toggle|show|hide/.test(val) )
					e[ val == "toggle" ? hidden ? "show" : "hide" : val ]( prop );
				else {
					var parts = val.toString().match(/^([+-]=)?([\d+-.]+)(.*)$/),
						start = e.cur(true) || 0;

					if ( parts ) {
						var end = parseFloat(parts[2]),
							unit = parts[3] || "px";

						// We need to compute starting value
						if ( unit != "px" ) {
							self.style[ name ] = (end || 1) + unit;
							start = ((end || 1) / e.cur(true)) * start;
							self.style[ name ] = start + unit;
						}

						// If a +=/-= token was provided, we're doing a relative animation
						if ( parts[1] )
							end = ((parts[1] == "-=" ? -1 : 1) * end) + start;

						e.custom( start, end, unit );
					} else
						e.custom( start, val, "" );
				}
			});

			// For JS strict compliance
			return true;
		});
	},
	
	queue: function(type, fn){
		if ( jQuery.isFunction(type) ) {
			fn = type;
			type = "fx";
		}

		if ( !type || (typeof type == "string" && !fn) )
			return queue( this[0], type );

		return this.each(function(){
			if ( fn.constructor == Array )
				queue(this, type, fn);
			else {
				queue(this, type).push( fn );
			
				if ( queue(this, type).length == 1 )
					fn.apply(this);
			}
		});
	},

	stop: function(){
		var timers = jQuery.timers;

		return this.each(function(){
			for ( var i = 0; i < timers.length; i++ )
				if ( timers[i].elem == this )
					timers.splice(i--, 1);
		}).dequeue();
	}

});

var queue = function( elem, type, array ) {
	if ( !elem )
		return;

	var q = jQuery.data( elem, type + "queue" );

	if ( !q || array )
		q = jQuery.data( elem, type + "queue", 
			array ? jQuery.makeArray(array) : [] );

	return q;
};

jQuery.fn.dequeue = function(type){
	type = type || "fx";

	return this.each(function(){
		var q = queue(this, type);

		q.shift();

		if ( q.length )
			q[0].apply( this );
	});
};

jQuery.extend({
	
	speed: function(speed, easing, fn) {
		var opt = speed && speed.constructor == Object ? speed : {
			complete: fn || !fn && easing || 
				jQuery.isFunction( speed ) && speed,
			duration: speed,
			easing: fn && easing || easing && easing.constructor != Function && easing
		};

		opt.duration = (opt.duration && opt.duration.constructor == Number ? 
			opt.duration : 
			{ slow: 600, fast: 200 }[opt.duration]) || 400;
	
		// Queueing
		opt.old = opt.complete;
		opt.complete = function(){
			jQuery(this).dequeue();
			if ( jQuery.isFunction( opt.old ) )
				opt.old.apply( this );
		};
	
		return opt;
	},
	
	easing: {
		linear: function( p, n, firstNum, diff ) {
			return firstNum + diff * p;
		},
		swing: function( p, n, firstNum, diff ) {
			return ((-Math.cos(p*Math.PI)/2) + 0.5) * diff + firstNum;
		}
	},
	
	timers: [],

	fx: function( elem, options, prop ){
		this.options = options;
		this.elem = elem;
		this.prop = prop;

		if ( !options.orig )
			options.orig = {};
	}

});

jQuery.fx.prototype = {

	// Simple function for setting a style value
	update: function(){
		if ( this.options.step )
			this.options.step.apply( this.elem, [ this.now, this ] );

		(jQuery.fx.step[this.prop] || jQuery.fx.step._default)( this );

		// Set display property to block for height/width animations
		if ( this.prop == "height" || this.prop == "width" )
			this.elem.style.display = "block";
	},

	// Get the current size
	cur: function(force){
		if ( this.elem[this.prop] != null && this.elem.style[this.prop] == null )
			return this.elem[ this.prop ];

		var r = parseFloat(jQuery.curCSS(this.elem, this.prop, force));
		return r && r > -10000 ? r : parseFloat(jQuery.css(this.elem, this.prop)) || 0;
	},

	// Start an animation from one number to another
	custom: function(from, to, unit){
		this.startTime = (new Date()).getTime();
		this.start = from;
		this.end = to;
		this.unit = unit || this.unit || "px";
		this.now = this.start;
		this.pos = this.state = 0;
		this.update();

		var self = this;
		function t(){
			return self.step();
		}

		t.elem = this.elem;

		jQuery.timers.push(t);

		if ( jQuery.timers.length == 1 ) {
			var timer = setInterval(function(){
				var timers = jQuery.timers;
				
				for ( var i = 0; i < timers.length; i++ )
					if ( !timers[i]() )
						timers.splice(i--, 1);

				if ( !timers.length )
					clearInterval( timer );
			}, 13);
		}
	},

	// Simple 'show' function
	show: function(){
		// Remember where we started, so that we can go back to it later
		this.options.orig[this.prop] = jQuery.attr( this.elem.style, this.prop );
		this.options.show = true;

		// Begin the animation
		this.custom(0, this.cur());

		// Make sure that we start at a small width/height to avoid any
		// flash of content
		if ( this.prop == "width" || this.prop == "height" )
			this.elem.style[this.prop] = "1px";
		
		// Start by showing the element
		jQuery(this.elem).show();
	},

	// Simple 'hide' function
	hide: function(){
		// Remember where we started, so that we can go back to it later
		this.options.orig[this.prop] = jQuery.attr( this.elem.style, this.prop );
		this.options.hide = true;

		// Begin the animation
		this.custom(this.cur(), 0);
	},

	// Each step of an animation
	step: function(){
		var t = (new Date()).getTime();

		if ( t > this.options.duration + this.startTime ) {
			this.now = this.end;
			this.pos = this.state = 1;
			this.update();

			this.options.curAnim[ this.prop ] = true;

			var done = true;
			for ( var i in this.options.curAnim )
				if ( this.options.curAnim[i] !== true )
					done = false;

			if ( done ) {
				if ( this.options.display != null ) {
					// Reset the overflow
					this.elem.style.overflow = this.options.overflow;
				
					// Reset the display
					this.elem.style.display = this.options.display;
					if ( jQuery.css(this.elem, "display") == "none" )
						this.elem.style.display = "block";
				}

				// Hide the element if the "hide" operation was done
				if ( this.options.hide )
					this.elem.style.display = "none";

				// Reset the properties, if the item has been hidden or shown
				if ( this.options.hide || this.options.show )
					for ( var p in this.options.curAnim )
						jQuery.attr(this.elem.style, p, this.options.orig[p]);
			}

			// If a callback was provided, execute it
			if ( done && jQuery.isFunction( this.options.complete ) )
				// Execute the complete function
				this.options.complete.apply( this.elem );

			return false;
		} else {
			var n = t - this.startTime;
			this.state = n / this.options.duration;

			// Perform the easing function, defaults to swing
			this.pos = jQuery.easing[this.options.easing || (jQuery.easing.swing ? "swing" : "linear")](this.state, n, 0, 1, this.options.duration);
			this.now = this.start + ((this.end - this.start) * this.pos);

			// Perform the next step of the animation
			this.update();
		}

		return true;
	}

};

jQuery.fx.step = {
	scrollLeft: function(fx){
		fx.elem.scrollLeft = fx.now;
	},

	scrollTop: function(fx){
		fx.elem.scrollTop = fx.now;
	},

	opacity: function(fx){
		jQuery.attr(fx.elem.style, "opacity", fx.now);
	},

	_default: function(fx){
		fx.elem.style[ fx.prop ] = fx.now + fx.unit;
	}
};
// The Offset Method
// Originally By Brandon Aaron, part of the Dimension Plugin
// http://jquery.com/plugins/project/dimensions
jQuery.fn.offset = function() {
	var left = 0, top = 0, elem = this[0], results;
	
	if ( elem ) with ( jQuery.browser ) {
		var	absolute     = jQuery.css(elem, "position") == "absolute", 
		    parent       = elem.parentNode, 
		    offsetParent = elem.offsetParent, 
		    doc          = elem.ownerDocument,
		    safari2      = safari && parseInt(version) < 522;
	
		// Use getBoundingClientRect if available
		if ( elem.getBoundingClientRect ) {
			box = elem.getBoundingClientRect();
		
			// Add the document scroll offsets
			add(
				box.left + Math.max(doc.documentElement.scrollLeft, doc.body.scrollLeft),
				box.top  + Math.max(doc.documentElement.scrollTop,  doc.body.scrollTop)
			);
		
			// IE adds the HTML element's border, by default it is medium which is 2px
			// IE 6 and IE 7 quirks mode the border width is overwritable by the following css html { border: 0; }
			// IE 7 standards mode, the border is always 2px
			if ( msie ) {
				var border = jQuery("html").css("borderWidth");
				border = (border == "medium" || jQuery.boxModel && parseInt(version) >= 7) && 2 || border;
				add( -border, -border );
			}
	
		// Otherwise loop through the offsetParents and parentNodes
		} else {
		
			// Initial element offsets
			add( elem.offsetLeft, elem.offsetTop );
		
			// Get parent offsets
			while ( offsetParent ) {
				// Add offsetParent offsets
				add( offsetParent.offsetLeft, offsetParent.offsetTop );
			
				// Mozilla and Safari > 2 does not include the border on offset parents
				// However Mozilla adds the border for table cells
				if ( mozilla && /^t[d|h]$/i.test(parent.tagName) || !safari2 )
					border( offsetParent );
				
				// Safari <= 2 doubles body offsets with an absolutely positioned element or parent
				if ( safari2 && !absolute && jQuery.css(offsetParent, "position") == "absolute" )
					absolute = true;
			
				// Get next offsetParent
				offsetParent = offsetParent.offsetParent;
			}
		
			// Get parent scroll offsets
			while ( parent.tagName && !/^body|html$/i.test(parent.tagName) ) {
				// Work around opera inline/table scrollLeft/Top bug
				if ( !/^inline|table-row.*$/i.test(jQuery.css(parent, "display")) )
					// Subtract parent scroll offsets
					add( -parent.scrollLeft, -parent.scrollTop );
			
				// Mozilla does not add the border for a parent that has overflow != visible
				if ( mozilla && jQuery.css(parent, "overflow") != "visible" )
					border( parent );
			
				// Get next parent
				parent = parent.parentNode;
			}
		
			// Safari doubles body offsets with an absolutely positioned element or parent
			if ( safari2 && absolute )
				add( -doc.body.offsetLeft, -doc.body.offsetTop );
		}

		// Return an object with top and left properties
		results = { top: top, left: left };
	}

	return results;

	function border(elem) {
		add( jQuery.css(elem, "borderLeftWidth"), jQuery.css(elem, "borderTopWidth") );
	}

	function add(l, t) {
		left += parseInt(l) || 0;
		top += parseInt(t) || 0;
	}
};
})();



/*
 * Compatibility Plugin for jQuery 1.1 (on top of jQuery 1.2)
 * By John Resig
 * Dual licensed under MIT and GPL.
 *
 * For XPath compatibility with 1.1, you should also include the XPath
 * compatability plugin.
 */

// UPGRADE: The following attribute helpers should now be used as:
// .attr("title") or .attr("title","new title")
jQuery.each(["id","title","name","href","src","rel"], function(i,n){
	jQuery.fn[ n ] = function(h) {
		return h == undefined ?
			this.length ? this[0][n] : null :
			this.attr( n, h );
	};
});

// UPGRADE: The following css helpers should now be used as:
// .css("top") or .css("top","30px")
jQuery.each("top,left,position,float,overflow,color,background".split(","), function(i,n){
	jQuery.fn[ n ] = function(h) {
		return h == undefined ?
			( this.length ? jQuery.css( this[0], n ) : null ) :
			this.css( n, h );
	};
});

// UPGRADE: The following event helpers should now be used as such:
// .oneblur(fn) -> .one("blur",fn)
// .unblur(fn) -> .unbind("blur",fn)
var e = ("blur,focus,load,resize,scroll,unload,click,dblclick," +
	"mousedown,mouseup,mousemove,mouseover,mouseout,change,reset,select," + 
	"submit,keydown,keypress,keyup,error").split(",");

// Go through all the event names, but make sure that
// it is enclosed properly
for ( var i = 0; i < e.length; i++ ) new function(){
			
	var o = e[i];
		
	// Handle event unbinding
	jQuery.fn["un"+o] = function(f){ return this.unbind(o, f); };
		
	// Finally, handle events that only fire once
	jQuery.fn["one"+o] = function(f){
		// save cloned reference to this
		var element = jQuery(this);
		var handler = function() {
			// unbind itself when executed
			element.unbind(o, handler);
			element = null;
			// apply original handler with the same arguments
			return f.apply(this, arguments);
		};
		return this.bind(o, handler);
	};
			
};

// UPGRADE: .ancestors() was removed in favor of .parents()
jQuery.fn.ancestors = jQuery.fn.parents;

// UPGRADE: The CSS selector :nth-child() now starts at 1, instead of 0
jQuery.expr[":"]["nth-child"] = "jQuery.nth(a.parentNode.firstChild,parseInt(m[3])+1,'nextSibling')==a";

// UPGRADE: .filter(["div", "span"]) now becomes .filter("div, span")
jQuery.fn._filter = jQuery.fn.filter;
jQuery.fn.filter = function(arr){
	return this._filter( arr.constructor == Array ? arr.join(",") : arr );
};

// You should now use .slice() instead of eq/lt/gt
// And you should use .filter(":contains(text)") instead of .contains()
jQuery.each( [ "eq", "lt", "gt", "contains" ], function(i,n){
	jQuery.fn[ n ] = function(num,fn) {
		return this.filter( ":" + n + "(" + num + ")", fn );
	};
});

// This is no longer necessary in 1.2
jQuery.fn.evalScripts = function(){};

// You should now be using $.ajax() instead
jQuery.fn.loadIfModified = function() {
	var old = jQuery.ajaxSettings.ifModified;
	jQuery.ajaxSettings.ifModified = true;

	var ret = jQuery.fn.load.apply( this, arguments );

	jQuery.ajaxSettings.ifModified = old;

	return ret;
};

// You should now be using $.ajax() instead
jQuery.getIfModified = function() {
	var old = jQuery.ajaxSettings.ifModified;
	jQuery.ajaxSettings.ifModified = true;

	var ret = jQuery.get.apply( jQuery, arguments );

	jQuery.ajaxSettings.ifModified = old;

	return ret;
};

jQuery.ajaxTimeout = function( timeout ) {
	jQuery.ajaxSettings.timeout = timeout;
};





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


// Functions to draw the Flash Charting Apps
function draw_pie(data,name,xtra,id)
{
	var flash = '';
	var html = '';
	var font = '14';
	var XML = '';
	var vars = '';
	
	XML = "<graph ";
	XML += "caption='"+name+"' ";
	XML += "bgColor='FFFFFF' ";
	XML += "decimalPrecision='1' ";
	XML += "showPercentageValues='1' ";
	XML += "showNames='1' ";
	XML += "showValues='1' ";
	XML += "showPercentageInLabel='1' ";
	XML += "pieYScale='45' ";
	XML += "Alpha='85' ";
	XML += "pieFillAlpha='90' ";
	XML += "pieSliceDepth='20' ";
	XML += "pieBorderThickness='2' ";
	XML += "nameTBDistance='3' ";
	XML += "pieRadius='80' ";
	XML += "baseFontSize='"+font+"' >";
	XML += data;
	XML += "</graph>";
	
	vars = 'chartWidth=550&chartHeight=350&dataXML='+XML+'&'+xtra;
	
	flash += '<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" WIDTH="520" HEIGHT="250" id="PieChart_'+id+'" ALIGN="">'+'\n';
	flash += '<PARAM NAME=movie VALUE="./flash/chart.swf?'+vars+'">'+'\n';
	flash += '<PARAM NAME=FlashVars VALUE="&'+vars+'">';
	flash += '<PARAM NAME=quality VALUE="high">'+'\n';
	flash += '<PARAM NAME=bgcolor VALUE="#FFFFFF">';
	flash += '<EMBED '+'\n';
	flash += 'src="./flash/chart.swf?'+vars+'" '+'\n';
	flash += 'FlashVars="&'+vars+'"'+'\n'; 
	flash += 'quality=high'+'\n';
	flash += 'bgcolor=#FFFFFF'+'\n'; 
	flash += 'WIDTH="520" '+'\n';
	flash += 'HEIGHT="250" '+'\n';
	flash += 'NAME="PieChart_'+id+'" '+'\n';
	flash += 'ALIGN="center"'+'\n';
	flash += 'TYPE="application/x-shockwave-flash" '+'\n';
	flash += 'PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer">'+'\n';
	flash += '</EMBED>'+'\n';
	flash += '</OBJECT>'+'\n'+'\n';
	html = flash;
	document.write(html);
}


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
document.getElementById("p_bar_text").style.display = "inline";
document.getElementById("upload_sect").style.display = "none";
document.getElementById("link_block").style.display = 'none';
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

function check_upload()
{
	if(document.getElementById('attached').attached.value.length == '0')
	{
		return false;
	}
	return true;
}

function check_url()
{
	if(document.getElementById("urlfile").value.length <= '12')
	{
		alert(lang4);
		return false;
	}
	else
	{
		if(check_types('urlfile'))
		{	
			//document.getElementById("url_txt").style.display = "inline"; 
			document.getElementById("link_block").style.display = "none";
			document.getElementById("up_url").style.display = "none";
			document.getElementById("p_bar_load").style.display='';
			document.getElementById("p_bar_text").style.display='';
			setTimeout('cgiUploadBar()', 5000);
			return true;
		}
		else
		{
			return false;
		}
	}
}

function close_loading()
{
	TB_remove_load();
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

function cgiUploadBar()
{
	var ourl = $('#p_link').attr('value');
	
	$.getScript(ourl, function(){setTimeout("cgiUploadBar()",6000);});
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


/*
Farbtastic: jQuery color picker plug-in
Copyright (C) 2006  Steven Wittens

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

jQuery.fn.farbtastic = function (callback,defaultColor) {
  $.farbtastic(this, callback,defaultColor);
  return this;
};

jQuery.farbtastic = function (container, callback,defaultColor) {
  var container = $(container).get(0);
  return container.farbtastic || (container.farbtastic = new jQuery._farbtastic(container, callback,defaultColor));
};

jQuery._farbtastic = function (container, callback,defaultColor) {
  // Store farbtastic object
  var fb = this;

  // Insert markup
  $(container).html('<div class="farbtastic"><div class="color"></div><div class="wheel"></div><div class="overlay"></div><div class="h-marker marker"></div><div class="sl-marker marker"></div></div>');
  var e = $('.farbtastic', container);
  fb.wheel = $('.wheel', container).get(0);
  // Dimensions
  fb.radius = 84;
  fb.square = 100;
  fb.width = 194;
  fb.callback = callback;

  /**
   * Link to the given element(s) or callback.
   */
  fb.linkTo = function (callback) 
  {
    $('#'+callback).css('backgroundColor', fb.rgb);
	$('#'+callback).attr('value', fb.rgb);
    return this;
  };
  fb.updateValue = function (event) {
    if (this.value && this.value != fb.color) {
      fb.setColor(this.value);
    }
  };

  /**
   * Change color with HTML syntax #123456
   */
  fb.setColor = function (color) {
    var unpack = fb.unpack(color);
    if (fb.color != color && unpack) {
      fb.color = color;
      fb.rgb = unpack;
      fb.hsl = fb.RGBToHSL(fb.rgb);
      fb.updateDisplay();      
    }
    return this;
  };

  /**
   * Change color with HSL triplet [0..1, 0..1, 0..1]
   */
  fb.setHSL = function (hsl) {
    fb.hsl = hsl;
    fb.rgb = fb.HSLToRGB(hsl);
    fb.color = fb.pack(fb.rgb);
    fb.updateDisplay();
    return this;
  };

  /////////////////////////////////////////////////////

  /**
   * Mousedown handler
   */
  fb.mousedown = function (event) {
    // Capture mouse
    $(document).bind('mousemove', fb.mousemove).bind('mouseup', fb.mouseup);

    // Check which area is being dragged
    var pos = fb.absolutePosition(fb.wheel);
    var eventX = event.pageX || (event.clientX + $('html').get(0).scrollLeft);
    var eventY = event.pageY || (event.clientY + $('html').get(0).scrollTop);
    var x = eventX - pos.x - fb.width / 2;
    var y = eventY - pos.y - fb.width / 2;
    fb.circleDrag = Math.max(Math.abs(x), Math.abs(y)) * 2 > fb.square;

    // Process
    fb.mousemove(event);
    return false;
  };

  /**
   * Mousemove handler 
   */
  fb.mousemove = function (event) {
    // Get coordinates relative to color picker center
    var pos = fb.absolutePosition(fb.wheel);
    var eventX = event.pageX || (event.clientX + $('html').get(0).scrollLeft);
    var eventY = event.pageY || (event.clientY + $('html').get(0).scrollTop);
    var x = eventX - pos.x - fb.width / 2;
    var y = eventY - pos.y - fb.width / 2;

    // Set new HSL parameters
    if (fb.circleDrag) {
  	  var hue = Math.atan2(x,-y) / 6.28;
  	  if (hue < 0) hue += 1;
  	  fb.setHSL([hue, fb.hsl[1], fb.hsl[2]]);
    }
    else {
  	  var sat = Math.max(0, Math.min(1, -(x / fb.square) + .5));
  	  var lum = Math.max(0, Math.min(1, -(y / fb.square) + .5));
  	  fb.setHSL([fb.hsl[0], sat, lum]);
    }
    return false;
  };

  /**
   * Mouseup handler
   */
  fb.mouseup = function () {
    // Uncapture mouse
    $(document).unbind('mousemove', fb.mousemove);
    $(document).unbind('mouseup', fb.mouseup);    
  };

  /**
   * Update the markers and styles
   */
  fb.updateDisplay = function () {     
    // Markers
    var angle = fb.hsl[0] * 6.28;
    $('.h-marker', e).css({
      left: Math.round(Math.sin(angle) * fb.radius + fb.width / 2) + 'px',
      top: Math.round(-Math.cos(angle) * fb.radius + fb.width / 2) + 'px'
    });

    $('.sl-marker', e).css({
      left: Math.round(fb.square * (.5 - fb.hsl[1]) + fb.width / 2) + 'px',
      top: Math.round(fb.square * (.5 - fb.hsl[2]) + fb.width / 2) + 'px'
    });

    // Saturation/Luminance gradient
    $('.color', e).css('backgroundColor', fb.pack(fb.HSLToRGB([fb.hsl[0], 1, 0.5])));

    // Linked elements or callback
      // Set background/foreground color
      $('#'+fb.callback).css({
        backgroundColor: fb.color,
        color: fb.hsl[2] > 0.5 ? '#000' : '#fff'
      });

      // Change linked value
      $('#'+fb.callback).each(function() {
        if (this.value && this.value != fb.color) {
          this.value = fb.color;
        }        
      });
	
	
  };

  /**
   * Get absolute position of element
   */
  fb.absolutePosition = function (el) {
    var r = { x: el.offsetLeft, y: el.offsetTop };
    if (el.offsetParent) {
      var tmp = fb.absolutePosition(el.offsetParent);
      r.x += tmp.x;
      r.y += tmp.y;
    }
    return r;
  };

  /* Various color utility functions */
  fb.pack = function (rgb) {      
    var r = Math.round(rgb[0] * 255);
    var g = Math.round(rgb[1] * 255);
    var b = Math.round(rgb[2] * 255);
    return '#' + (r < 16 ? '0' : '') + r.toString(16) +
  			   (g < 16 ? '0' : '') + g.toString(16) +
  			   (b < 16 ? '0' : '') + b.toString(16);
  };

  fb.unpack = function (color) {
    if (color.length == 7) {
  	  return [parseInt('0x' + color.substring(1, 3)) / 255,
  			parseInt('0x' + color.substring(3, 5)) / 255,
  			parseInt('0x' + color.substring(5, 7)) / 255];
    }
    else if (color.length == 4) {
  	  return [parseInt('0x' + color.substring(1, 2)) / 15,
  			parseInt('0x' + color.substring(2, 3)) / 15,
  			parseInt('0x' + color.substring(3, 4)) / 15];
    }
  };

  fb.HSLToRGB = function (hsl) {
    var m1, m2, r, g, b;
    var h = hsl[0], s = hsl[1], l = hsl[2];
    m2 = (l <= 0.5) ? l * (s + 1) : l + s - l*s;
    m1 = l * 2 - m2;
    return [this.hueToRGB(m1, m2, h+0.33333),
  		  this.hueToRGB(m1, m2, h),
  		  this.hueToRGB(m1, m2, h-0.33333)];
  };

  fb.hueToRGB = function (m1, m2, h) {
    h = (h < 0) ? h + 1 : ((h > 1) ? h - 1 : h);
    if (h * 6 < 1) return m1 + (m2 - m1) * h * 6;
    if (h * 2 < 1) return m2;
    if (h * 3 < 2) return m1 + (m2 - m1) * (0.66666 - h) * 6;
    return m1;
  };

  fb.RGBToHSL = function (rgb) {
    var min, max, delta, h, s, l;
    var r = rgb[0], g = rgb[1], b = rgb[2];
    min = Math.min(r, Math.min(g, b));
    max = Math.max(r, Math.max(g, b));
    delta = max - min;
    l = (min + max) / 2;
    s = 0;
    if (l > 0 && l < 1) {
  	  s = delta / (l < 0.5 ? (2 * l) : (2 - 2 * l));
    }
    h = 0;
    if (delta > 0) {
  	  if (max == r && max != g) h += (g - b) / delta;
  	  if (max == g && max != b) h += (2 + (b - r) / delta);
  	  if (max == b && max != r) h += (4 + (r - g) / delta);
  	  h /= 6;
    }
    return [h, s, l];
  };

  // Install mousedown handler (the others are set on the document on-demand)
  $('*', e).mousedown(fb.mousedown);

  // Init color
  fb.setColor(defaultColor);

  // Set linked elements/callback
  if (callback) {
    fb.linkTo(callback);
  }
}


/**
 * Flash (http://jquery.lukelutman.com/plugins/flash)
 * A jQuery plugin for embedding Flash movies.
 * 
 * Version 1.0
 * November 9th, 2006
 *
 * Copyright (c) 2006 Luke Lutman (http://www.lukelutman.com)
 * Licensed under the MIT License:
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Inspired by:
 * SWFObject (http://blog.deconcept.com/swfobject/)
 * UFO (http://www.bobbyvandersluis.com/ufo/)
 * sIFR (http://www.mikeindustries.com/sifr/)
 * 
 * IMPORTANT: 
 * The packed version of jQuery breaks ActiveX control
 * activation in Internet Explorer. Use JSMin to minifiy
 * jQuery (see: http://jquery.lukelutman.com/plugins/flash#activex).
 *
 **/ 
;(function(){
	
var $$;

/**
 * 
 * @desc Replace matching elements with a flash movie.
 * @author Luke Lutman
 * @version 1.0.1
 *
 * @name flash
 * @param Hash htmlOptions Options for the embed/object tag.
 * @param Hash pluginOptions Options for detecting/updating the Flash plugin (optional).
 * @param Function replace Custom block called for each matched element if flash is installed (optional).
 * @param Function update Custom block called for each matched if flash isn't installed (optional).
 * @type jQuery
 *
 * @cat plugins/flash
 * 
 * @example $('#hello').flash({ src: 'hello.swf' });
 * @desc Embed a Flash movie.
 *
 * @example $('#hello').flash({ src: 'hello.swf' }, { version: 8 });
 * @desc Embed a Flash 8 movie.
 *
 * @example $('#hello').flash({ src: 'hello.swf' }, { expressInstall: true });
 * @desc Embed a Flash movie using Express Install if flash isn't installed.
 *
 * @example $('#hello').flash({ src: 'hello.swf' }, { update: false });
 * @desc Embed a Flash movie, don't show an update message if Flash isn't installed.
 *
**/
$$ = jQuery.fn.flash = function(htmlOptions, pluginOptions, replace, update) {
	
	// Set the default block.
	var block = replace || $$.replace;
	
	// Merge the default and passed plugin options.
	pluginOptions = $$.copy($$.pluginOptions, pluginOptions);
	
	// Detect Flash.
	if(!$$.hasFlash(pluginOptions.version)) {
		// Use Express Install (if specified and Flash plugin 6,0,65 or higher is installed).
		if(pluginOptions.expressInstall && $$.hasFlash(6,0,65)) {
			// Add the necessary flashvars (merged later).
			var expressInstallOptions = {
				flashvars: {  	
					MMredirectURL: location,
					MMplayerType: 'PlugIn',
					MMdoctitle: jQuery('title').text() 
				}					
			};
		// Ask the user to update (if specified).
		} else if (pluginOptions.update) {
			// Change the block to insert the update message instead of the flash movie.
			block = update || $$.update;
		// Fail
		} else {
			// The required version of flash isn't installed.
			// Express Install is turned off, or flash 6,0,65 isn't installed.
			// Update is turned off.
			// Return without doing anything.
			return this;
		}
	}
	
	// Merge the default, express install and passed html options.
	htmlOptions = $$.copy($$.htmlOptions, expressInstallOptions, htmlOptions);
	
	// Invoke $block (with a copy of the merged html options) for each element.
	return this.each(function(){
		block.call(this, $$.copy(htmlOptions));
	});
	
};
/**
 *
 * @name flash.copy
 * @desc Copy an arbitrary number of objects into a new object.
 * @type Object
 * 
 * @example $$.copy({ foo: 1 }, { bar: 2 });
 * @result { foo: 1, bar: 2 };
 *
**/
$$.copy = function() {
	var options = {}, flashvars = {};
	for(var i = 0; i < arguments.length; i++) {
		var arg = arguments[i];
		if(arg == undefined) continue;
		jQuery.extend(options, arg);
		// don't clobber one flash vars object with another
		// merge them instead
		if(arg.flashvars == undefined) continue;
		jQuery.extend(flashvars, arg.flashvars);
	}
	options.flashvars = flashvars;
	return options;
};
/*
 * @name flash.hasFlash
 * @desc Check if a specific version of the Flash plugin is installed
 * @type Boolean
 *
**/
$$.hasFlash = function() {
	// look for a flag in the query string to bypass flash detection
	if(/hasFlash\=true/.test(location)) return true;
	if(/hasFlash\=false/.test(location)) return false;
	var pv = $$.hasFlash.playerVersion().match(/\d+/g);
	var rv = String([arguments[0], arguments[1], arguments[2]]).match(/\d+/g) || String($$.pluginOptions.version).match(/\d+/g);
	for(var i = 0; i < 3; i++) {
		pv[i] = parseInt(pv[i] || 0);
		rv[i] = parseInt(rv[i] || 0);
		// player is less than required
		if(pv[i] < rv[i]) return false;
		// player is greater than required
		if(pv[i] > rv[i]) return true;
	}
	// major version, minor version and revision match exactly
	return true;
};
/**
 *
 * @name flash.hasFlash.playerVersion
 * @desc Get the version of the installed Flash plugin.
 * @type String
 *
**/
$$.hasFlash.playerVersion = function() {
	// ie
	try {
		try {
			// avoid fp6 minor version lookup issues
			// see: http://blog.deconcept.com/2006/01/11/getvariable-setvariable-crash-internet-explorer-flash-6/
			var axo = new ActiveXObject('ShockwaveFlash.ShockwaveFlash.6');
			try { axo.AllowScriptAccess = 'always';	} 
			catch(e) { return '6,0,0'; }				
		} catch(e) {}
		return new ActiveXObject('ShockwaveFlash.ShockwaveFlash').GetVariable('$version').replace(/\D+/g, ',').match(/^,?(.+),?$/)[1];
	// other browsers
	} catch(e) {
		try {
			if(navigator.mimeTypes["application/x-shockwave-flash"].enabledPlugin){
				return (navigator.plugins["Shockwave Flash 2.0"] || navigator.plugins["Shockwave Flash"]).description.replace(/\D+/g, ",").match(/^,?(.+),?$/)[1];
			}
		} catch(e) {}		
	}
	return '0,0,0';
};
/**
 *
 * @name flash.htmlOptions
 * @desc The default set of options for the object or embed tag.
 *
**/
$$.htmlOptions = {
	height: 240,
	flashvars: {},
	pluginspage: 'http://www.adobe.com/go/getflashplayer',
	src: '#',
	type: 'application/x-shockwave-flash',
	width: 320		
};
/**
 *
 * @name flash.pluginOptions
 * @desc The default set of options for checking/updating the flash Plugin.
 *
**/
$$.pluginOptions = {
	expressInstall: false,
	update: true,
	version: '6.0.65'
};
/**
 *
 * @name flash.replace
 * @desc The default method for replacing an element with a Flash movie.
 *
**/
$$.replace = function(htmlOptions) {
	this.innerHTML = '<div class="alt">'+this.innerHTML+'</div>';
	jQuery(this)
		.addClass('flash-replaced')
		.prepend($$.transform(htmlOptions));
};
/**
 *
 * @name flash.update
 * @desc The default method for replacing an element with an update message.
 *
**/
$$.update = function(htmlOptions) {
	var url = String(location).split('?');
	url.splice(1,0,'?hasFlash=true&');
	url = url.join('');
	var msg = '<p>This content requires the Flash Player. <a href="http://www.adobe.com/go/getflashplayer">Download Flash Player</a>. Already have Flash Player? <a href="'+url+'">Click here.</a></p>';
	this.innerHTML = '<span class="alt">'+this.innerHTML+'</span>';
	jQuery(this)
		.addClass('flash-update')
		.prepend(msg);
};
/**
 *
 * @desc Convert a hash of html options to a string of attributes, using Function.apply(). 
 * @example toAttributeString.apply(htmlOptions)
 * @result foo="bar" foo="bar"
 *
**/
function toAttributeString() {
	var s = '';
	for(var key in this)
		if(typeof this[key] != 'function')
			s += key+'="'+this[key]+'" ';
	return s;		
};
/**
 *
 * @desc Convert a hash of flashvars to a url-encoded string, using Function.apply(). 
 * @example toFlashvarsString.apply(flashvarsObject)
 * @result foo=bar&foo=bar
 *
**/
function toFlashvarsString() {
	var s = '';
	for(var key in this)
		if(typeof this[key] != 'function')
			s += key+'='+escape(this[key])+'&';
	return s.replace(/&$/, '');		
};
/**
 *
 * @name flash.transform
 * @desc Transform a set of html options into an embed tag.
 * @type String 
 *
 * @example $$.transform(htmlOptions)
 * @result <embed src="foo.swf" ... />
 *
 * Note: The embed tag is NOT standards-compliant, but it 
 * works in all current browsers. flash.transform can be
 * overwritten with a custom function to generate more 
 * standards-compliant markup.
 *
**/
$$.transform = function(htmlOptions) {
	htmlOptions.toString = toAttributeString;
	if(htmlOptions.flashvars) htmlOptions.flashvars.toString = toFlashvarsString;
	return '<embed ' + String(htmlOptions) + '/>';		
};

/**
 *
 * Flash Player 9 Fix (http://blog.deconcept.com/2006/07/28/swfobject-143-released/)
 *
**/
if (window.attachEvent) {
	window.attachEvent("onbeforeunload", function(){
		__flash_unloadHandler = function() {};
		__flash_savedUnloadHandler = function() {};
	});
}
	
})();


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


/*
	JSCookMenu v2.0.3 (c) Copyright 2002-2006 by Heng Yuan

	http://jscook.sourceforge.net/JSCookMenu/

	Permission is hereby granted, free of charge, to any person obtaining a
	copy of this software and associated documentation files (the "Software"),
	to deal in the Software without restriction, including without limitation
	the rights to use, copy, modify, merge, publish, distribute, sublicense,
	and/or sell copies of the Software, and to permit persons to whom the
	Software is furnished to do so, subject to the following conditions:

	The above copyright notice and this permission notice shall be included
	in all copies or substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
	OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	ITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
	FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
	DEALINGS IN THE SOFTWARE.
*/

// default node properties
var _cmNodeProperties =
{
	// theme prefix
	prefix:	'',

  	// main menu display attributes
  	//
  	// Note.  When the menu bar is horizontal,
  	// mainFolderLeft and mainFolderRight are
  	// put in <span></span>.  When the menu
  	// bar is vertical, they would be put in
  	// a separate TD cell.

  	// HTML code to the left of the folder item
  	mainFolderLeft: '',
  	// HTML code to the right of the folder item
  	mainFolderRight: '',
	// HTML code to the left of the regular item
	mainItemLeft: '',
	// HTML code to the right of the regular item
	mainItemRight:	'',

	// sub menu display attributes

	// HTML code to the left of the folder item
	folderLeft:		'',
	// HTML code to the right of the folder item
	folderRight:	'',
	// HTML code to the left of the regular item
	itemLeft:		'',
	// HTML code to the right of the regular item
	itemRight:		'',
	// cell spacing for main menu
	mainSpacing:	0,
	// cell spacing for sub menus
	subSpacing:		0,

	// optional settings
	// If not set, use the default

	// auto disappear time for submenus in milli-seconds
	delay:			500,

	// 1st layer sub menu starting index
	zIndexStart:	1000,
	// z-index incremental step for subsequent layers
	zIndexInc:		5,

	// sub menu header appears before the sub menu table
	subMenuHeader:	null,
	// sub menu header appears after the sub menu table
	subMenuFooter:	null,

	// submenu location adjustments
	//
	// offsetHMainAdjust for adjusting the first submenu
	// 		of a 'hbr' menu.
	// offsetVMainAdjust for adjusting the first submenu
	//		of a 'vbr' menu.
	// offsetSubAdjust for subsequent level of submenus
	//
	offsetHMainAdjust:	[0, 0],
	offsetVMainAdjust:	[0, 0],
	offsetSubAdjust:	[0, 0],

	// act on click to open sub menu
	// not yet implemented
	// 0 : use default behavior
	// 1 : hover open in all cases
	// 2 : click on main, hover on sub
	// 3 : click open in all cases (illegal as of 1.5)
	clickOpen:		1,

	// special effects on open/closing a sub menu
	effect:			null
};

// Globals
var _cmIDCount = 0;
var _cmIDName = 'cmSubMenuID';		// for creating submenu id

var _cmTimeOut = null;				// how long the menu would stay
var _cmCurrentItem = null;			// the current menu item being selected;

var _cmNoAction = new Object ();	// indicate that the item cannot be hovered.
var _cmNoClick = new Object ();		// similar to _cmNoAction but does not respond to mouseup/mousedown events
var _cmSplit = new Object ();		// indicate that the item is a menu split

var _cmMenuList = new Array ();		// a list of the current menus
var _cmItemList = new Array ();		// a simple list of items

var _cmFrameList = new Array ();	// a pool of reusable iframes
var _cmFrameListSize = 0;			// keep track of the actual size
var _cmFrameIDCount = 0;			// keep track of the frame id
var _cmFrameMasking = true;			// use the frame masking

// disable iframe masking for IE7
/*@cc_on
	@if (@_jscript_version >= 5.6)
		if (_cmFrameMasking)
		{
			var v = navigator.appVersion;
			var i = v.indexOf ("MSIE ");
			if (i >= 0)
			{
				if (parseInt (navigator.appVersion.substring (i + 5)) >= 7)
					_cmFrameMasking = false;
			}
		}
	@end
@*/

var _cmClicked = false;				// for onClick

// flag for turning on off hiding objects
//
// 0: automatic
// 1: hiding
// 2: no hiding
var _cmHideObjects = 0;

// Utility function to do a shallow copy a node property
function cmClone (nodeProperties)
{
	var returnVal = new Object ();
	for (v in nodeProperties)
		returnVal[v] = nodeProperties[v];
	return returnVal;
}

//
// store the new menu information into a structure to retrieve it later
//
function cmAllocMenu (id, menu, orient, nodeProperties, prefix)
{
	var info = new Object ();
	info.div = id;
	info.menu = menu;
	info.orient = orient;
	info.nodeProperties = nodeProperties;
	info.prefix = prefix;
	var menuID = _cmMenuList.length;
	_cmMenuList[menuID] = info;
	return menuID;
}

//
// request a frame
//
function cmAllocFrame ()
{
	if (_cmFrameListSize > 0)
		return cmGetObject (_cmFrameList[--_cmFrameListSize]);
	var frameObj = document.createElement ('iframe');
	var id = _cmFrameIDCount++;
	frameObj.id = 'cmFrame' + id;
	frameObj.frameBorder = '0';
	frameObj.style.display = 'none';
	frameObj.src = 'javascript:false';
	document.body.appendChild (frameObj);
	frameObj.style.filter = 'alpha(opacity=0)';
	frameObj.style.zIndex = 99;
	frameObj.style.position = 'absolute';
	frameObj.style.border = '0';
	frameObj.scrolling = 'no';
	return frameObj;
}

//
// make a frame resuable later
//
function cmFreeFrame (frameObj)
{
	_cmFrameList[_cmFrameListSize++] = frameObj.id;
}

//////////////////////////////////////////////////////////////////////
//
// Drawing Functions and Utility Functions
//
//////////////////////////////////////////////////////////////////////

//
// produce a new unique id
//
function cmNewID ()
{
	return _cmIDName + (++_cmIDCount);
}

//
// return the property string for the menu item
//
function cmActionItem (item, isMain, idSub, menuInfo, menuID)
{
	_cmItemList[_cmItemList.length] = item;
	var index = _cmItemList.length - 1;
	idSub = (!idSub) ? 'null' : ('\'' + idSub + '\'');

	var clickOpen = menuInfo.nodeProperties.clickOpen;
	var onClick = (clickOpen == 3) || (clickOpen == 2 && isMain);

	var param = 'this,' + isMain + ',' + idSub + ',' + menuID + ',' + index;

	var returnStr;
	if (onClick)
		returnStr = ' onmouseover="cmItemMouseOver(' + param + ',false)" onmousedown="cmItemMouseDownOpenSub (' + param + ')"';
	else
		returnStr = ' onmouseover="cmItemMouseOverOpenSub (' + param + ')" onmousedown="cmItemMouseDown (' + param + ')"';
	return returnStr + ' onmouseout="cmItemMouseOut (' + param + ')" onmouseup="cmItemMouseUp (' + param + ')"';
}

//
// this one is used by _cmNoClick to only take care of onmouseover and onmouseout
// events which are associated with menu but not actions associated with menu clicking/closing
//
function cmNoClickItem (item, isMain, idSub, menuInfo, menuID)
{
	// var index = _cmItemList.push (item) - 1;
	_cmItemList[_cmItemList.length] = item;
	var index = _cmItemList.length - 1;
	idSub = (!idSub) ? 'null' : ('\'' + idSub + '\'');

	var param = 'this,' + isMain + ',' + idSub + ',' + menuID + ',' + index;

	return ' onmouseover="cmItemMouseOver (' + param + ')" onmouseout="cmItemMouseOut (' + param + ')"';
}

function cmNoActionItem (item)
{
	return item[1];
}

function cmSplitItem (prefix, isMain, vertical)
{
	var classStr = 'cm' + prefix;
	if (isMain)
	{
		classStr += 'Main';
		if (vertical)
			classStr += 'HSplit';
		else
			classStr += 'VSplit';
	}
	else
		classStr += 'HSplit';
	return eval (classStr);
}

//
// draw the sub menu recursively
//
function cmDrawSubMenu (subMenu, prefix, id, nodeProperties, zIndexStart, menuInfo, menuID)
{
	var str = '<div class="' + prefix + 'SubMenu" id="' + id + '" style="z-index: ' + zIndexStart + ';position: absolute; top: 0px; left: 0px;">';
	if (nodeProperties.subMenuHeader)
		str += nodeProperties.subMenuHeader;

	str += '<table summary="sub menu" id="' + id + 'Table" cellspacing="' + nodeProperties.subSpacing + '" class="' + prefix + 'SubMenuTable">';

	var strSub = '';

	var item;
	var idSub;
	var hasChild;

	var i;

	var classStr;

	for (i = 5; i < subMenu.length; ++i)
	{
		item = subMenu[i];
		if (!item)
			continue;

		if (item == _cmSplit)
			item = cmSplitItem (prefix, 0, true);
		item.parentItem = subMenu;
		item.subMenuID = id;

		hasChild = (item.length > 5);
		idSub = hasChild ? cmNewID () : null;

		str += '<tr class="' + prefix + 'MenuItem"';
		if (item[0] != _cmNoClick)
			str += cmActionItem (item, 0, idSub, menuInfo, menuID);
		else
			str += cmNoClickItem (item, 0, idSub, menuInfo, menuID);
		str += '>'

		if (item[0] == _cmNoAction || item[0] == _cmNoClick)
		{
			str += cmNoActionItem (item);
			str += '</tr>';
			continue;
		}

		classStr = prefix + 'Menu';
		classStr += hasChild ? 'Folder' : 'Item';

		str += '<td class="' + classStr + 'Left">';

		if (item[0] != null)
			str += item[0];
		else
			str += hasChild ? nodeProperties.folderLeft : nodeProperties.itemLeft;

		str += '</td><td class="' + classStr + 'Text">' + item[1];

		str += '</td><td class="' + classStr + 'Right">';

		if (hasChild)
		{
			str += nodeProperties.folderRight;
			strSub += cmDrawSubMenu (item, prefix, idSub, nodeProperties, zIndexStart + nodeProperties.zIndexInc, menuInfo, menuID);
		}
		else
			str += nodeProperties.itemRight;
		str += '</td></tr>';
	}

	str += '</table>';

	if (nodeProperties.subMenuFooter)
		str += nodeProperties.subMenuFooter;
	str += '</div>' + strSub;
	return str;
}

//
// The function that builds the menu inside the specified element id.
//
// id				id of the element
// orient			orientation of the menu in [hv][ub][lr] format
// menu				the menu object to be drawn
// nodeProperties	properties for the theme
// prefix			prefix of the theme
//
function cmDraw (id, menu, orient, nodeProperties, prefix)
{
	var obj = cmGetObject (id);

	if (!prefix)
		prefix = nodeProperties.prefix;
	if (!prefix)
		prefix = '';
	if (!nodeProperties)
		nodeProperties = _cmNodeProperties;
	if (!orient)
		orient = 'hbr';

	var menuID = cmAllocMenu (id, menu, orient, nodeProperties, prefix);
	var menuInfo = _cmMenuList[menuID];

	// setup potentially missing properties
	if (!nodeProperties.delay)
		nodeProperties.delay = _cmNodeProperties.delay;
	if (!nodeProperties.clickOpen)
		nodeProperties.clickOpen = _cmNodeProperties.clickOpen;
	if (!nodeProperties.zIndexStart)
		nodeProperties.zIndexStart = _cmNodeProperties.zIndexStart;
	if (!nodeProperties.zIndexInc)
		nodeProperties.zIndexInc = _cmNodeProperties.zIndexInc;
	if (!nodeProperties.offsetHMainAdjust)
		nodeProperties.offsetHMainAdjust = _cmNodeProperties.offsetHMainAdjust;
	if (!nodeProperties.offsetVMainAdjust)
		nodeProperties.offsetVMainAdjust = _cmNodeProperties.offsetVMainAdjust;
	if (!nodeProperties.offsetSubAdjust)
		nodeProperties.offsetSubAdjust = _cmNodeProperties.offsetSubAdjust;
	// save user setting on frame masking
	menuInfo.cmFrameMasking = _cmFrameMasking;

	var str = '<table summary="main menu" class="' + prefix + 'Menu" cellspacing="' + nodeProperties.mainSpacing + '">';
	var strSub = '';

	var vertical;

	// draw the main menu items
	if (orient.charAt (0) == 'h')
	{
		str += '<tr>';
		vertical = false;
	}
	else
	{
		vertical = true;
	}

	var i;
	var item;
	var idSub;
	var hasChild;

	var classStr;

	for (i = 0; i < menu.length; ++i)
	{
		item = menu[i];

		if (!item)
			continue;

		item.menu = menu;
		item.subMenuID = id;

		str += vertical ? '<tr' : '<td';
		str += ' class="' + prefix + 'MainItem"';

		hasChild = (item.length > 5);
		idSub = hasChild ? cmNewID () : null;

		str += cmActionItem (item, 1, idSub, menuInfo, menuID) + '>';

		if (item == _cmSplit)
			item = cmSplitItem (prefix, 1, vertical);

		if (item[0] == _cmNoAction || item[0] == _cmNoClick)
		{
			str += cmNoActionItem (item);
			str += vertical? '</tr>' : '</td>';
			continue;
		}

		classStr = prefix + 'Main' + (hasChild ? 'Folder' : 'Item');

		str += vertical ? '<td' : '<span';
		str += ' class="' + classStr + 'Left">';

		str += (item[0] == null) ? (hasChild ? nodeProperties.mainFolderLeft : nodeProperties.mainItemLeft)
					 : item[0];
		str += vertical ? '</td>' : '</span>';

		str += vertical ? '<td' : '<span';
		str += ' class="' + classStr + 'Text">';
		str += item[1];

		str += vertical ? '</td>' : '</span>';

		str += vertical ? '<td' : '<span';
		str += ' class="' + classStr + 'Right">';

		str += hasChild ? nodeProperties.mainFolderRight : nodeProperties.mainItemRight;

		str += vertical ? '</td>' : '</span>';

		str += vertical ? '</tr>' : '</td>';

		if (hasChild)
			strSub += cmDrawSubMenu (item, prefix, idSub, nodeProperties, nodeProperties.zIndexStart, menuInfo, menuID);
	}
	if (!vertical)
		str += '</tr>';
	str += '</table>' + strSub;
	obj.innerHTML = str;
}

//
// The function builds the menu inside the specified element id.
//
// This function is similar to cmDraw except that menu is taken from HTML node
// rather a javascript tree.  This feature allows links to be scanned by search
// bots.
//
// This function basically converts HTML node to a javascript tree, and then calls
// cmDraw to draw the actual menu, replacing the hidden menu tree.
//
// Format:
//	<div id="menu">
//		<ul style="visibility: hidden">
//			<li><span>icon</span><a href="link" title="description">main menu text</a>
//				<ul>
//					<li><span>icon</span><a href="link" title="description">submenu item</a>
//					</li>
//				</ul>
//			</li>
//		</ul>
//	</div>
//
function cmDrawFromText (id, orient, nodeProperties, prefix)
{
	var domMenu = cmGetObject (id);
	var menu = null;
	for (var currentDomItem = domMenu.firstChild; currentDomItem; currentDomItem = currentDomItem.nextSibling)
	{
		if (!currentDomItem.tagName)
			continue;
		var tag = currentDomItem.tagName.toLowerCase ();
		if (tag != 'ul' && tag != 'ol')
			continue;
		menu = cmDrawFromTextSubMenu (currentDomItem);
		break;
	}
	if (menu)
		cmDraw (id, menu, orient, nodeProperties, prefix);
}

//
// a recursive function that build menu tree structure
//
function cmDrawFromTextSubMenu (domMenu)
{
	var items = new Array ();
	for (var currentDomItem = domMenu.firstChild; currentDomItem; currentDomItem = currentDomItem.nextSibling)
	{
		if (!currentDomItem.tagName || currentDomItem.tagName.toLowerCase () != 'li')
			continue;
		if (currentDomItem.firstChild == null)
		{
			items[items.length] = _cmSplit;
			continue;
		}
		var item = new Array ();
		var currentItem = currentDomItem.firstChild;
		var hasAction = false;
		for (; currentItem; currentItem = currentItem.nextSibling)
		{
			// scan for span or div tag
			if (!currentItem.tagName)
				continue;
			if (currentItem.className == 'cmNoClick')
			{
				item[0] = _cmNoClick;
				item[1] = getActionHTML (currentItem);
				hasAction = true;
				break;
			}
			if (currentItem.className == 'cmNoAction')
			{
				item[0] = _cmNoAction;
				item[1] = getActionHTML (currentItem);
				hasAction = true;
				break;
			}
			var tag = currentItem.tagName.toLowerCase ();
			if (tag != 'span')
				continue;
			if (!currentItem.firstChild)
				item[0] = null;
			else
				item[0] = currentItem.innerHTML;
			currentItem = currentItem.nextSibling;
			break;
		}
		if (hasAction)
		{
			items[items.length] = item;
			continue;
		}
		if (!currentItem)
			continue;
		for (; currentItem; currentItem = currentItem.nextSibling)
		{
			if (!currentItem.tagName)
				continue;
			var tag = currentItem.tagName.toLowerCase ();
			if (tag == 'a')
			{
				item[1] = currentItem.innerHTML;
				item[2] = currentItem.href;
				item[3] = currentItem.target;
				item[4] = currentItem.title;
				if (item[4] == '')
					item[4] = null;
			}
			else if (tag == 'span' || tag == 'div')
			{
				item[1] = currentItem.innerHTML;
				item[2] = null;
				item[3] = null;
				item[4] = null;
			}
			break;
		}

		for (; currentItem; currentItem = currentItem.nextSibling)
		{
			// scan for span tag
			if (!currentItem.tagName)
				continue;
			var tag = currentItem.tagName.toLowerCase ();
			if (tag != 'ul' && tag != 'ol')
				continue;
			var subMenuItems = cmDrawFromTextSubMenu (currentItem);
			for (i = 0; i < subMenuItems.length; ++i)
				item[i + 5] = subMenuItems[i];
			break;
		}
		items[items.length] = item;
	}
	return items;
}

//
// obtain the actual action item's action, which is inside a
// table.  The first row should be it
//
function getActionHTML (htmlNode)
{
	var returnVal = '<td></td><td></td><td></td>';
	var currentDomItem;
	// find the table first
	for (currentDomItem = htmlNode.firstChild; currentDomItem; currentDomItem = currentDomItem.nextSibling)
	{
		if (currentDomItem.tagName && currentDomItem.tagName.toLowerCase () == 'table')
			break;
	}
	if (!currentDomItem)
		return returnVal;
	// skip over tbody
	for (currentDomItem = currentDomItem.firstChild; currentDomItem; currentDomItem = currentDomItem.nextSibling)
	{
		if (currentDomItem.tagName && currentDomItem.tagName.toLowerCase () == 'tbody')
			break;
	}
	if (!currentDomItem)
		return returnVal;
	// get the first tr
	for (currentDomItem = currentDomItem.firstChild; currentDomItem; currentDomItem = currentDomItem.nextSibling)
	{
		if (currentDomItem.tagName && currentDomItem.tagName.toLowerCase () == 'tr')
			break;
	}
	if (!currentDomItem)
		return returnVal;
	return currentDomItem.innerHTML;
}

//
// get the DOM object associated with the item
//
function cmGetMenuItem (item)
{
	if (!item.subMenuID)
		return null;
	var subMenu = cmGetObject (item.subMenuID);
	// we are dealing with a main menu item
	if (item.menu)
	{
		var menu = item.menu;
		// skip over table, tbody, tr, reach td
		subMenu = subMenu.firstChild.firstChild.firstChild.firstChild;
		var i;
		for (i = 0; i < menu.length; ++i)
		{
			if (menu[i] == item)
				return subMenu;
			subMenu = subMenu.nextSibling;
		}
	}
	else if (item.parentItem) // sub menu item
	{
		var menu = item.parentItem;
		var table = cmGetObject (item.subMenuID + 'Table');
		if (!table)
			return null;
		// skip over table, tbody, reach tr
		subMenu = table.firstChild.firstChild;
		var i;
		for (i = 5; i < menu.length; ++i)
		{
			if (menu[i] == item)
				return subMenu;
			subMenu = subMenu.nextSibling;
		}
	}
	return null;
}

//
// disable a menu item
//
function cmDisableItem (item, prefix)
{
	if (!item)
		return;
	var menuItem = cmGetMenuItem (item);
	if (!menuItem)
		return;
	if (item.menu)
		menuItem.className = prefix + 'MainItemDisabled';
	else
		menuItem.className = prefix + 'MenuItemDisabled';
	item.isDisabled = true;
}

//
// enable a menu item
//
function cmEnableItem (item, prefix)
{
	if (!item)
		return;
	var menuItem = cmGetMenuItem (item);
	if (!menuItem)
		return;
	if (item.menu)
		menu.className = prefix + 'MainItem';
	else
		menu.className = prefix + 'MenuItem';
	item.isDisabled = true;
}

//////////////////////////////////////////////////////////////////////
//
// Mouse Event Handling Functions
//
//////////////////////////////////////////////////////////////////////

//
// action should be taken for mouse moving in to the menu item
//
// Here we just do things concerning this menu item, w/o opening sub menus.
//
function cmItemMouseOver (obj, isMain, idSub, menuID, index, calledByOpenSub)
{
	if (!calledByOpenSub && _cmClicked)
	{
		cmItemMouseOverOpenSub (obj, isMain, idSub, menuID, index);
		return;
	}

	clearTimeout (_cmTimeOut);

	if (_cmItemList[index].isDisabled)
		return;

	var prefix = _cmMenuList[menuID].prefix;

	if (!obj.cmMenuID)
	{
		obj.cmMenuID = menuID;
		obj.cmIsMain = isMain;
	}

	var thisMenu = cmGetThisMenu (obj, prefix);

	// insert obj into cmItems if cmItems doesn't have obj
	if (!thisMenu.cmItems)
		thisMenu.cmItems = new Array ();
	var i;
	for (i = 0; i < thisMenu.cmItems.length; ++i)
	{
		if (thisMenu.cmItems[i] == obj)
			break;
	}
	if (i == thisMenu.cmItems.length)
	{
		//thisMenu.cmItems.push (obj);
		thisMenu.cmItems[i] = obj;
	}

	// hide the previous submenu that is not this branch
	if (_cmCurrentItem)
	{
		// occationally, we get this case when user
		// move the mouse slowly to the border
		if (_cmCurrentItem == obj || _cmCurrentItem == thisMenu)
		{
			var item = _cmItemList[index];
			cmSetStatus (item);
			return;
		}

		var thatMenuInfo = _cmMenuList[_cmCurrentItem.cmMenuID];
		var thatPrefix = thatMenuInfo.prefix;
		var thatMenu = cmGetThisMenu (_cmCurrentItem, thatPrefix);

		if (thatMenu != thisMenu.cmParentMenu)
		{
			if (_cmCurrentItem.cmIsMain)
				_cmCurrentItem.className = thatPrefix + 'MainItem';
			else
				_cmCurrentItem.className = thatPrefix + 'MenuItem';
			if (thatMenu.id != idSub)
				cmHideMenu (thatMenu, thisMenu, thatMenuInfo);
		}
	}

	// okay, set the current menu to this obj
	_cmCurrentItem = obj;

	// just in case, reset all items in this menu to MenuItem
	cmResetMenu (thisMenu, prefix);

	var item = _cmItemList[index];
	var isDefaultItem = cmIsDefaultItem (item);

	if (isDefaultItem)
	{
		if (isMain)
			obj.className = prefix + 'MainItemHover';
		else
			obj.className = prefix + 'MenuItemHover';
	}

	cmSetStatus (item);
}

//
// action should be taken for mouse moving in to the menu item
//
// This function also opens sub menu
//
function cmItemMouseOverOpenSub (obj, isMain, idSub, menuID, index)
{
	clearTimeout (_cmTimeOut);

	if (_cmItemList[index].isDisabled)
		return;

	cmItemMouseOver (obj, isMain, idSub, menuID, index, true);

	if (idSub)
	{
		var subMenu = cmGetObject (idSub);
		var menuInfo = _cmMenuList[menuID];
		var orient = menuInfo.orient;
		var prefix = menuInfo.prefix;
		cmShowSubMenu (obj, isMain, subMenu, menuInfo);
	}
}

//
// action should be taken for mouse moving out of the menu item
//
function cmItemMouseOut (obj, isMain, idSub, menuID, index)
{
	var delayTime = _cmMenuList[menuID].nodeProperties.delay;
	_cmTimeOut = window.setTimeout ('cmHideMenuTime ()', delayTime);
	window.defaultStatus = '';
}

//
// action should be taken for mouse button down at a menu item
//
function cmItemMouseDown (obj, isMain, idSub, menuID, index)
{
	if (_cmItemList[index].isDisabled)
		return;

	if (cmIsDefaultItem (_cmItemList[index]))
	{
		var prefix = _cmMenuList[menuID].prefix;
		if (obj.cmIsMain)
			obj.className = prefix + 'MainItemActive';
		else
			obj.className = prefix + 'MenuItemActive';
	}
}

//
// action should be taken for mouse button down at a menu item
// this is one also opens submenu if needed
//
function cmItemMouseDownOpenSub (obj, isMain, idSub, menuID, index)
{
	if (_cmItemList[index].isDisabled)
		return;

	_cmClicked = true;
	cmItemMouseDown (obj, isMain, idSub, menuID, index);

	if (idSub)
	{
		var subMenu = cmGetObject (idSub);
		var menuInfo = _cmMenuList[menuID];
		cmShowSubMenu (obj, isMain, subMenu, menuInfo);
	}
}

//
// action should be taken for mouse button up at a menu item
//
function cmItemMouseUp (obj, isMain, idSub, menuID, index)
{
	if (_cmItemList[index].isDisabled)
		return;

	var item = _cmItemList[index];

	var link = null, target = '_self';

	if (item.length > 2)
		link = item[2];
	if (item.length > 3 && item[3])
		target = item[3];

	if (link != null)
	{
		_cmClicked = false;
		window.open (link, target);
	}

	var menuInfo = _cmMenuList[menuID];
	var prefix = menuInfo.prefix;
	var thisMenu = cmGetThisMenu (obj, prefix);

	var hasChild = (item.length > 5);
	if (!hasChild)
	{
		if (cmIsDefaultItem (item))
		{
			if (obj.cmIsMain)
				obj.className = prefix + 'MainItem';
			else
				obj.className = prefix + 'MenuItem';
		}
		cmHideMenu (thisMenu, null, menuInfo);
	}
	else
	{
		if (cmIsDefaultItem (item))
		{
			if (obj.cmIsMain)
				obj.className = prefix + 'MainItemHover';
			else
				obj.className = prefix + 'MenuItemHover';
		}
	}
}

//////////////////////////////////////////////////////////////////////
//
// Mouse Event Support Utility Functions
//
//////////////////////////////////////////////////////////////////////

//
// move submenu to the appropriate location
//
function cmMoveSubMenu (obj, isMain, subMenu, menuInfo)
{
	var orient = menuInfo.orient;

	var offsetAdjust;

	if (isMain)
	{
		if (orient.charAt (0) == 'h')
			offsetAdjust = menuInfo.nodeProperties.offsetHMainAdjust;
		else
			offsetAdjust = menuInfo.nodeProperties.offsetVMainAdjust;
	}
	else
		offsetAdjust = menuInfo.nodeProperties.offsetSubAdjust;

	if (!isMain && orient.charAt (0) == 'h')
		orient = 'v' + orient.charAt (1) + orient.charAt (2);

	var mode = String (orient);
	var p = subMenu.offsetParent;
	var subMenuWidth = cmGetWidth (subMenu);
	var horiz = cmGetHorizontalAlign (obj, mode, p, subMenuWidth);
	if (mode.charAt (0) == 'h')
	{
		if (mode.charAt (1) == 'b')
			subMenu.style.top = (cmGetYAt (obj, p) + cmGetHeight (obj) + offsetAdjust[1]) + 'px';
		else
			subMenu.style.top = (cmGetYAt (obj, p) - cmGetHeight (subMenu) - offsetAdjust[1]) + 'px';
		if (horiz == 'r')
			subMenu.style.left = (cmGetXAt (obj, p) + offsetAdjust[0]) + 'px';
		else
			subMenu.style.left = (cmGetXAt (obj, p) + cmGetWidth (obj) - subMenuWidth - offsetAdjust[0]) + 'px';
	}
	else
	{
		if (horiz == 'r')
			subMenu.style.left = (cmGetXAt (obj, p) + cmGetWidth (obj) + offsetAdjust[0]) + 'px';
		else
			subMenu.style.left = (cmGetXAt (obj, p) - subMenuWidth - offsetAdjust[0]) + 'px';
		if (mode.charAt (1) == 'b')
			subMenu.style.top = (cmGetYAt (obj, p) + offsetAdjust[1]) + 'px';
		else
			subMenu.style.top = (cmGetYAt (obj, p) + cmGetHeight (obj) - cmGetHeight (subMenu) + offsetAdjust[1]) + 'px';
	}

	// IE specific iframe masking method
	/*@cc_on
		@if (@_jscript_version >= 5.5)
			if (menuInfo.cmFrameMasking)
			{
				if (!subMenu.cmFrameObj)
				{
					var frameObj = cmAllocFrame ();
					subMenu.cmFrameObj = frameObj;
				}

				var frameObj = subMenu.cmFrameObj;
				frameObj.style.zIndex = subMenu.style.zIndex - 1;
				frameObj.style.left = (cmGetX (subMenu) - cmGetX (frameObj.offsetParent)) + 'px';
				frameObj.style.top = (cmGetY (subMenu)  - cmGetY (frameObj.offsetParent)) + 'px';
				frameObj.style.width = cmGetWidth (subMenu) + 'px';
				frameObj.style.height = cmGetHeight (subMenu) + 'px';
				frameObj.style.display = 'block';
			}
		@end
	@*/
	if (horiz != orient.charAt (2))
		orient = orient.charAt (0) + orient.charAt (1) + horiz;
	return orient;
}

//
// automatically re-adjust the menu position based on available screen size.
//
function cmGetHorizontalAlign (obj, mode, p, subMenuWidth)
{
	var horiz = mode.charAt (2);
	if (!(document.body))
		return horiz;
	var body = document.body;
	var browserLeft;
	var browserRight;
	if (window.innerWidth)
	{
		// DOM window attributes
		browserLeft = window.pageXOffset;
		browserRight = window.innerWidth + browserLeft;
	}
	else if (body.clientWidth)
	{
		// IE attributes
		browserLeft = body.clientLeft;
		browserRight = body.clientWidth + browserLeft;
	}
	else
		return horiz;
	if (mode.charAt (0) == 'h')
	{
		if (horiz == 'r' && (cmGetXAt (obj) + subMenuWidth) > browserRight)
			horiz = 'l';
		if (horiz == 'l' && (cmGetXAt (obj) + cmGetWidth (obj) - subMenuWidth) < browserLeft)
			horiz = 'r';
		return horiz;
	}
	else
	{
		if (horiz == 'r' && (cmGetXAt (obj, p) + cmGetWidth (obj) + subMenuWidth) > browserRight)
			horiz = 'l';
		if (horiz == 'l' && (cmGetXAt (obj, p) - subMenuWidth) < browserLeft)
			horiz = 'r';
		return horiz;
	}
}

//
// show the subMenu w/ specified orientation
// also move it to the correct coordinates
//
function cmShowSubMenu (obj, isMain, subMenu, menuInfo)
{
	var prefix = menuInfo.prefix;

	if (!subMenu.cmParentMenu)
	{
		// establish the tree w/ back edge
		var thisMenu = cmGetThisMenu (obj, prefix);
		subMenu.cmParentMenu = thisMenu;
		if (!thisMenu.cmSubMenu)
			thisMenu.cmSubMenu = new Array ();
		thisMenu.cmSubMenu[thisMenu.cmSubMenu.length] = subMenu;
	}

	var effectInstance = subMenu.cmEffect;
	if (effectInstance)
		effectInstance.showEffect (true);
	else
	{
		// position the sub menu only if we are not already showing the submenu
		var orient = cmMoveSubMenu (obj, isMain, subMenu, menuInfo);
		subMenu.cmOrient = orient;

		var forceShow = false;
		if (subMenu.style.visibility != 'visible' && menuInfo.nodeProperties.effect)
		{
			try
			{
				effectInstance = menuInfo.nodeProperties.effect.getInstance (subMenu, orient);
				effectInstance.showEffect (false);
			}
			catch (e)
			{
				forceShow = true;
				subMenu.cmEffect = null;
			}
		}
		else
			forceShow = true;

		if (forceShow)
		{
			subMenu.style.visibility = 'visible';
			/*@cc_on
				@if (@_jscript_version >= 5.5)
					if (subMenu.cmFrameObj)
						subMenu.cmFrameObj.style.display = 'block';
				@end
			@*/
		}
	}

	if (!_cmHideObjects)
	{
		_cmHideObjects = 2;	// default = not hide, may change behavior later
		try
		{
			if (window.opera)
			{
				if (parseInt (navigator.appVersion) < 9)
					_cmHideObjects = 1;
			}
		}
		catch (e)
		{
		}
	}

	if (_cmHideObjects == 1)
	{
		if (!subMenu.cmOverlap)
			subMenu.cmOverlap = new Array ();
		cmHideControl ("IFRAME", subMenu);
		cmHideControl ("OBJECT", subMenu);
	}
}

//
// reset all the menu items to class MenuItem in thisMenu
//
function cmResetMenu (thisMenu, prefix)
{
	if (thisMenu.cmItems)
	{
		var i;
		var str;
		var items = thisMenu.cmItems;
		for (i = 0; i < items.length; ++i)
		{
			if (items[i].cmIsMain)
			{
				if (items[i].className == (prefix + 'MainItemDisabled'))
					continue;
			}
			else
			{
				if (items[i].className == (prefix + 'MenuItemDisabled'))
					continue;
			}
			if (items[i].cmIsMain)
				str = prefix + 'MainItem';
			else
				str = prefix + 'MenuItem';
			if (items[i].className != str)
				items[i].className = str;
		}
	}
}

//
// called by the timer to hide the menu
//
function cmHideMenuTime ()
{
	_cmClicked = false;
	if (_cmCurrentItem)
	{
		var menuInfo = _cmMenuList[_cmCurrentItem.cmMenuID];
		var prefix = menuInfo.prefix;
		cmHideMenu (cmGetThisMenu (_cmCurrentItem, prefix), null, menuInfo);
		_cmCurrentItem = null;
	}
}

//
// Only hides this menu
//
function cmHideThisMenu (thisMenu, menuInfo)
{
	var effectInstance = thisMenu.cmEffect;
	if (effectInstance)
		effectInstance.hideEffect (true);
	else
	{
		thisMenu.style.visibility = 'hidden';
		thisMenu.style.top = '0px';
		thisMenu.style.left = '0px';
		thisMenu.cmOrient = null;
		/*@cc_on
			@if (@_jscript_version >= 5.5)
				if (thisMenu.cmFrameObj)
				{
					var frameObj = thisMenu.cmFrameObj;
					frameObj.style.display = 'none';
					frameObj.style.width = '1px';
					frameObj.style.height = '1px';
					thisMenu.cmFrameObj = null;
					cmFreeFrame (frameObj);
				}
			@end
		@*/
	}

	cmShowControl (thisMenu);
	thisMenu.cmItems = null;
}

//
// hide thisMenu, children of thisMenu, as well as the ancestor
// of thisMenu until currentMenu is encountered.  currentMenu
// will not be hidden
//
function cmHideMenu (thisMenu, currentMenu, menuInfo)
{
	var prefix = menuInfo.prefix;
	var str = prefix + 'SubMenu';

	// hide the down stream menus
	if (thisMenu.cmSubMenu)
	{
		var i;
		for (i = 0; i < thisMenu.cmSubMenu.length; ++i)
		{
			cmHideSubMenu (thisMenu.cmSubMenu[i], menuInfo);
		}
	}

	// hide the upstream menus
	while (thisMenu && thisMenu != currentMenu)
	{
		cmResetMenu (thisMenu, prefix);
		if (thisMenu.className == str)
		{
			cmHideThisMenu (thisMenu, menuInfo);
		}
		else
			break;
		thisMenu = cmGetThisMenu (thisMenu.cmParentMenu, prefix);
	}
}

//
// hide thisMenu as well as its sub menus if thisMenu is not
// already hidden
//
function cmHideSubMenu (thisMenu, menuInfo)
{
	if (thisMenu.style.visibility == 'hidden')
		return;
	if (thisMenu.cmSubMenu)
	{
		var i;
		for (i = 0; i < thisMenu.cmSubMenu.length; ++i)
		{
			cmHideSubMenu (thisMenu.cmSubMenu[i], menuInfo);
		}
	}
	var prefix = menuInfo.prefix;
	cmResetMenu (thisMenu, prefix);
	cmHideThisMenu (thisMenu, menuInfo);
}

//
// hide a control such as IFRAME
//
function cmHideControl (tagName, subMenu)
{
	var x = cmGetX (subMenu);
	var y = cmGetY (subMenu);
	var w = subMenu.offsetWidth;
	var h = subMenu.offsetHeight;

	var i;
	for (i = 0; i < document.all.tags(tagName).length; ++i)
	{
		var obj = document.all.tags(tagName)[i];
		if (!obj || !obj.offsetParent)
			continue;

		// check if the object and the subMenu overlap

		var ox = cmGetX (obj);
		var oy = cmGetY (obj);
		var ow = obj.offsetWidth;
		var oh = obj.offsetHeight;

		if (ox > (x + w) || (ox + ow) < x)
			continue;
		if (oy > (y + h) || (oy + oh) < y)
			continue;

		// if object is already made hidden by a different
		// submenu then we dont want to put it on overlap list of
		// of a submenu a second time.
		// - bug fixed by Felix Zaslavskiy
		if(obj.style.visibility == 'hidden')
			continue;

		//subMenu.cmOverlap.push (obj);
		subMenu.cmOverlap[subMenu.cmOverlap.length] = obj;
		obj.style.visibility = 'hidden';
	}
}

//
// show the control hidden by the subMenu
//
function cmShowControl (subMenu)
{
	if (subMenu.cmOverlap)
	{
		var i;
		for (i = 0; i < subMenu.cmOverlap.length; ++i)
			subMenu.cmOverlap[i].style.visibility = "";
	}
	subMenu.cmOverlap = null;
}

//
// returns the main menu or the submenu table where this obj (menu item)
// is in
//
function cmGetThisMenu (obj, prefix)
{
	var str1 = prefix + 'SubMenu';
	var str2 = prefix + 'Menu';
	while (obj)
	{
		if (obj.className == str1 || obj.className == str2)
			return obj;
		obj = obj.parentNode;
	}
	return null;
}

//
// A special effect function to hook the menu which contains
// special effect object to the timer.
//
function cmTimeEffect (menuID, show, delayTime)
{
	window.setTimeout ('cmCallEffect("' + menuID + '",' + show + ')', delayTime);
}

//
// A special effect function.  Called by timer.
//
function cmCallEffect (menuID, show)
{
	var menu = cmGetObject (menuID);
	if (!menu || !menu.cmEffect)
		return;
	try
	{
		if (show)
			menu.cmEffect.showEffect (false);
		else
			menu.cmEffect.hideEffect (false);
	}
	catch (e)
	{
	}
}

//
// return true if this item is handled using default handlers
//
function cmIsDefaultItem (item)
{
	if (item == _cmSplit || item[0] == _cmNoAction || item[0] == _cmNoClick)
		return false;
	return true;
}

//
// returns the object baring the id
//
function cmGetObject (id)
{
	if (document.all)
		return document.all[id];
	return document.getElementById (id);
}

//
// functions that obtain the width of an HTML element.
//
function cmGetWidth (obj)
{
	var width = obj.offsetWidth;
	if (width > 0 || !cmIsTRNode (obj))
		return width;
	if (!obj.firstChild)
		return 0;
	// use TABLE's length can cause an extra pixel gap
	//return obj.parentNode.parentNode.offsetWidth;

	// use the left and right child instead
	return obj.lastChild.offsetLeft - obj.firstChild.offsetLeft + cmGetWidth (obj.lastChild);
}

//
// functions that obtain the height of an HTML element.
//
function cmGetHeight (obj)
{
	var height = obj.offsetHeight;
	if (height > 0 || !cmIsTRNode (obj))
		return height;
	if (!obj.firstChild)
		return 0;
	// use the first child's height
	return obj.firstChild.offsetHeight;
}

//
// functions that obtain the coordinates of an HTML element
//
function cmGetX (obj)
{
	if (!obj)
		return 0;
	var x = 0;

	do
	{
		x += obj.offsetLeft;
		obj = obj.offsetParent;
	}
	while (obj);
	return x;
}

function cmGetXAt (obj, elm)
{
	var x = 0;

	while (obj && obj != elm)
	{
		x += obj.offsetLeft;
		obj = obj.offsetParent;
	}
	if (obj == elm)
		return x;
	return x - cmGetX (elm);
}

function cmGetY (obj)
{
	if (!obj)
		return 0;
	var y = 0;
	do
	{
		y += obj.offsetTop;
		obj = obj.offsetParent;
	}
	while (obj);
	return y;
}

function cmIsTRNode (obj)
{
	var tagName = obj.tagName;
	return tagName == "TR" || tagName == "tr" || tagName == "Tr" || tagName == "tR";
}

//
// get the Y position of the object.  In case of TR element though,
// we attempt to adjust the value.
//
function cmGetYAt (obj, elm)
{
	var y = 0;

	if (!obj.offsetHeight && cmIsTRNode (obj))
	{
		var firstTR = obj.parentNode.firstChild;
		obj = obj.firstChild;
		y -= firstTR.firstChild.offsetTop;
	}

	while (obj && obj != elm)
	{
		y += obj.offsetTop;
		obj = obj.offsetParent;
	}

	if (obj == elm)
		return y;
	return y - cmGetY (elm);
}

//
// extract description from the menu item and set the status text
//
function cmSetStatus (item)
{
	var descript = '';
	if (item.length > 4)
		descript = (item[4] != null) ? item[4] : (item[2] ? item[2] : descript);
	else if (item.length > 2)
		descript = (item[2] ? item[2] : descript);

	window.defaultStatus = descript;
}

//
// debug function, ignore :)
//
function cmGetProperties (obj)
{
	if (obj == undefined)
		return 'undefined';
	if (obj == null)
		return 'null';

	var msg = obj + ':\n';
	var i;
	for (i in obj)
		msg += i + ' = ' + obj[i] + '; ';
	return msg;
}

/*
	JSCookMenu Effect (c) Copyright 2002-2006 by Heng Yuan

	http://jscook.sourceforge.net/JSCookMenu/

	Permission is hereby granted, free of charge, to any person obtaining a
	copy of this software and associated documentation files (the "Software"),
	to deal in the Software without restriction, including without limitation
	the rights to use, copy, modify, merge, publish, distribute, sublicense,
	and/or sell copies of the Software, and to permit persons to whom the
	Software is furnished to do so, subject to the following conditions:

	The above copyright notice and this permission notice shall be included
	in all copies or substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
	OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	ITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
	FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
	DEALINGS IN THE SOFTWARE.
*/
//
// utiltity object to simplify common tasks in effects.
//
function CMSpecialEffectInstance (effect, menu)
{
	effect.show = true;
	effect.menu = menu;
	menu.cmEffect = effect;
	this.effect = effect;
}

CMSpecialEffectInstance.prototype.canShow = function (changed)
{
	if (changed)
	{
		if (this.effect.show)
			return false;
		this.effect.show = true;
	}
	else if (!this.effect.show)
		return false;
	return true;
}

CMSpecialEffectInstance.prototype.canHide = function (changed)
{
	var effect = this.effect;
	if (changed)
	{
		if (!effect.show)
			return false;
		effect.show = false;
	}
	else if (effect.show)
		return false;
	return true;
}

//
// public function to be called to initate the display of the
// menu.
//
CMSpecialEffectInstance.prototype.startShowing = function ()
{
	var menu = this.effect.menu;
	menu.style.visibility = 'visible';
	/*@cc_on
		@if (@_jscript_version >= 5.5)
			if (menu.cmFrameObj)
			{
				var frameObj = menu.cmFrameObj;
				frameObj.style.display = 'block';
			}
		@end
	@*/
}

//
// public function to be called after showing effect is finished.
//
CMSpecialEffectInstance.prototype.finishShowing = function ()
{
}

//
// clean up after finish hiding effect.
//
CMSpecialEffectInstance.prototype.finishHiding = function ()
{
	var menu = this.effect.menu;
	menu.style.visibility = 'hidden';
	menu.style.top = '0px';
	menu.style.left = '0px';
	/*@cc_on
		@if (@_jscript_version >= 5.5)
			if (menu.cmFrameObj)
			{
				var frameObj = menu.cmFrameObj;
				frameObj.style.display = 'none';
				frameObj.style.top = '0px';
				frameObj.style.left = '0px';
				menu.cmFrameObj = null;
				cmFreeFrame (frameObj);
			}
		@end
	@*/
	menu.cmEffect = null;
	menu.cmOrient = null;
	this.effect.menu = null;
}

//
// this is the internal class to perform the sliding effect
//
function CMSlidingEffectInstance (menu, orient, speed)
{
	this.base = new CMSpecialEffectInstance (this, menu);

	menu.style.overflow = 'hidden';

	this.x = menu.offsetLeft;
	this.y = menu.offsetTop;

	if (orient.charAt (0) == 'h')
	{
		this.slideOrient = 'h';
		this.slideDir = orient.charAt (1);
	}
	else
	{
		this.slideOrient = 'v';
		this.slideDir = orient.charAt (2);
	}

	this.speed = speed;
	this.fullWidth = menu.offsetWidth;
	this.fullHeight = menu.offsetHeight;
	this.percent = 0;
	/*@cc_on
		@if (@_jscript_version >= 5.5)
			if (menu.cmFrameObj)
			{
				var frameObj = menu.cmFrameObj;
				this.frameX = frameObj.offsetLeft;
				this.frameY = frameObj.offsetTop;
				this.frameWidth = frameObj.offsetWidth;
				this.frameHeight = frameObj.offsetHeight;
			}
		@end
	@*/
}
	// public function to show the menu
CMSlidingEffectInstance.prototype.showEffect = function (changed)
{
	if (!this.base.canShow (changed))
		return;

	var percent = this.percent;
	if (this.slideOrient == 'h')
		this.slideMenuV ();
	else
		this.slideMenuH ();

	if (percent == 0)
	{
		this.base.startShowing ();
	}

	if (percent < 100)
	{
		this.percent += this.speed;
		cmTimeEffect (this.menu.id, this.show, 10);
	}
	else if (this.show)
	{
		this.base.finishShowing ();
	}
}

// public function to hide the menu
CMSlidingEffectInstance.prototype.hideEffect = function (changed)
{
	if (!this.base.canHide (changed))
		return;

	var percent = this.percent;
	if (this.slideOrient == 'h')
		this.slideMenuV ();
	else
		this.slideMenuH ();

	if (percent > 0)
	{
		this.percent -= this.speed;
		cmTimeEffect (this.menu.id, this.show, 10);
	}
	else if (!this.show)
	{
		this.menu.style.clip = 'auto';
		this.base.finishHiding ();
	}
}

// internal function to scroll a menu left/right
CMSlidingEffectInstance.prototype.slideMenuH = function ()
{
	var percent = this.percent;
	if (percent < 0)
		percent = 0;
	if (percent > 100)
		percent = 100;
	var fullWidth = this.fullWidth;
	var fullHeight = this.fullHeight;
	var x = this.x;
	var space = percent * fullWidth / 100;
	var menu = this.menu;

	if (this.slideDir == 'l')
	{
		menu.style.left = (x + fullWidth - space) + 'px';
		menu.style.clip = 'rect(0px ' + space + 'px ' + fullHeight + 'px 0px)';
	}
	else
	{
		menu.style.left = (x - fullWidth + space) + 'px';
		menu.style.clip = 'rect(0px ' + fullWidth + 'px ' + fullHeight + 'px ' + (fullWidth - space) + 'px)';
	}
	/*@cc_on
		@if (@_jscript_version >= 5.5)
			if (menu.cmFrameObj)
			{
				var frameObj = menu.cmFrameObj;
				if (this.slideDir == 'l')
					frameObj.style.left = (this.frameX + fullWidth - space) + 'px';
				frameObj.style.width = space + 'px';
			}
		@end
	@*/
}

// internal function to scroll a menu up/down
CMSlidingEffectInstance.prototype.slideMenuV = function ()
{
	var percent = this.percent;
	if (percent < 0)
		percent = 0;
	if (percent > 100)
		percent = 100;
	var fullWidth = this.fullWidth;
	var fullHeight = this.fullHeight;
	var y = this.y;
	var space = percent * fullHeight / 100;
	var menu = this.menu;

	if (this.slideDir == 'b')
	{
		menu.style.top = (y - fullHeight + space) + 'px';
		menu.style.clip = 'rect(' + (fullHeight - space) + 'px ' + fullWidth + 'px ' + fullHeight + 'px 0px)';
	}
	else
	{
		menu.style.top = (y + fullHeight - space) + 'px';
		menu.style.clip = 'rect(0px ' + fullWidth + 'px ' + space + 'px 0px)';
	}
	/*@cc_on
		@if (@_jscript_version >= 5.5)
			if (menu.cmFrameObj)
			{
				var frameObj = menu.cmFrameObj;
				if (this.slideDir == 'u')
					frameObj.style.top = (this.frameX - space) + 'px';
				frameObj.style.height = space + 'px';
			}
		@end
	@*/
}

//
// call
//		new CMSlidingEffect (speed)
// to create a new effect object.
//
function CMSlidingEffect (speed)
{
	if (!speed)
		speed = 10;
	else if (speed <= 0)
		speed = 10;
	else if (speed >= 100)
		speed = 100;
	this.speed = speed;
}

CMSlidingEffect.prototype.getInstance = function (menu, orient)
{
	return new CMSlidingEffectInstance (menu, orient, this.speed);
}

//
// this is the internal class to perform the sliding effect
//
function CMFadingEffectInstance (menu, showSpeed, hideSpeed)
{
	this.base = new CMSpecialEffectInstance (this, menu);

	menu.style.overflow = 'hidden';

	this.showSpeed = showSpeed;
	this.hideSpeed = hideSpeed;

	this.opacity = 0;
}

// public function to show the menu
CMFadingEffectInstance.prototype.showEffect = function (changed)
{
	if (!this.base.canShow (changed))
		return;

	var menu = this.menu;
	var opacity = this.opacity;

	this.setOpacity ();

	if (opacity == 0)
	{
		this.base.startShowing ();
	}

	if (opacity < 100)
	{
		this.opacity += 10;
		cmTimeEffect (menu.id, this.show, this.showSpeed);
	}
	else if (this.show)
	{
		this.base.finishShowing ();
	}
}

// public function to hide the menu
CMFadingEffectInstance.prototype.hideEffect = function (changed)
{
	if (!this.base.canHide (changed))
		return;

	var menu = this.menu;
	var opacity = this.opacity;

	this.setOpacity ();

	if (this.opacity > 0)
	{
		this.opacity -= 10;
		cmTimeEffect (menu.id, this.show, this.hideSpeed);
	}
	else if (!this.show)
	{
		this.base.finishHiding ();
	}
}

// internal functions
CMFadingEffectInstance.prototype.setOpacity = function ()
{
	this.menu.style.opacity = this.opacity / 100;
	/*@cc_on
		this.menu.style.filter = 'alpha(opacity=' + this.opacity + ')';
		//this.menu.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity=' + this.opacity + ')';
	@*/
}

function CMFadingEffect (showSpeed, hideSpeed)
{
	this.showSpeed = showSpeed;
	this.hideSpeed = hideSpeed;
}

CMFadingEffect.prototype.getInstance = function (menu, orient)
{
	return new CMFadingEffectInstance (menu, this.showSpeed, this.hideSpeed);
}




/**
 * Star Rating - jQuery plugin
 *
 * Copyright (c) 2007 Wil Stuckey
 * Modified by John Resig
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 *
 */

/**
 * Create a degradeable star rating interface out of a simple form structure.
 * Returns a modified jQuery object containing the new interface.
 *   
 * @example jQuery('form.rating').rating();
 * @cat plugin
 * @type jQuery 
 *
 */
jQuery.fn.rating = function(){
    return this.each(function(){
        var div = jQuery("<div/>").attr({
            title: this.title,
            className: this.className
        }).insertAfter( this );

        jQuery(this).find("select option").each(function(){
            div.append( this.value == "0" ?
                "<div class='cancel'><a href='#0' title='Cancel Rating'>Cancel Rating</a></div>" :
                "<div class='star'><a href='#" + this.value + "' title='Give it a " + 
                    this.value + " Star Rating'>" + this.value + "</a></div>" );
        });

        var averageRating = this.title.split(/:\s*/)[1].split("."),
            url = this.action,
            averageIndex = averageRating[0],
            averagePercent = averageRating[1];

        // hover events and focus events added
        var stars = div.find("div.star")
            .mouseover(drainFill).focus(drainFill)
            .mouseout(drainReset).blur(drainReset)
            .click(click);

        // cancel button events
        div.find("div.cancel")
            .mouseover(drainAdd).focus(drainAdd)
            .mouseout(resetRemove).blur(resetRemove)
            .click(click);

        reset();

        function drainFill(){ drain(); fill(this); }
        function drainReset(){ drain(); reset(); }
        function resetRemove(){ reset(); jQuery(this).removeClass('on'); }
        function drainAdd(){ drain(); jQuery(this).addClass('on'); }

        function click(){
            averageIndex = stars.index(this) + 1;
            averagePercent = 0;

            if ( averageIndex == 0 )
                drain();

            jQuery.post(url,{
                rating: jQuery(this).find('a')[0].href.split('#')[1],
				hash:   hashRate
            });

            return false;
        }

        // fill to the current mouse position.
        function fill( elem ){
            stars.find("a").css("width", "100%");
            stars.lt( stars.index(elem) + 1 ).addClass("hover");
        }
    
        // drain all the stars.
        function drain(){
            stars.removeClass("on hover");
        }

        // Reset the stars to the default index.
        function reset(){
            stars.lt(averageIndex).addClass("on");

            var percent = averagePercent ? averagePercent * 10 : 0;
            if (percent > 0)
                stars.eq(averageIndex).addClass("on").children("a").css("width", percent + "%");
        }
    }).remove();
};

// fix ie6 background flicker problem.
if ( jQuery.browser.msie == true )
    document.execCommand('BackgroundImageCache', false, true);



/**
 * SWFUpload v2.0 by Jacob Roberts, Nov 2007, http://www.swfupload.org, http://linebyline.blogspot.com
 * -------- -------- -------- -------- -------- -------- -------- --------
 * SWFUpload is (c) 2006 Lars Huring and Mammon Media and is released under the MIT License:
 * http://www.opensource.org/licenses/mit-license.php
 *
 * See Changelog.txt for version history
 *
 * Development Notes:
 *  * This version of SWFUpload requires Flash Player 9.0.28 and should autodetect the correct flash version.
 *  * In Linux Flash Player 9 setting the post file variable name does not work. It is always set to "Filedata".
 *  * There is a lot of repeated code that could be refactored to single functions.  Feel free.
 *  * It's dangerous to do "circular calls" between Flash and JavaScript. I've taken steps to try to work around issues
 *     by having the event calls pipe through setTimeout.  However you should still avoid calling in to Flash from
 *     within the event handler methods.  Especially the "startUpload" event since it cannot use the setTimeout hack.
 */


/* *********** */
/* Constructor */
/* *********** */

var SWFUpload = function (init_settings) {
	this.initSWFUpload(init_settings);
};

SWFUpload.prototype.initSWFUpload = function (init_settings) {
	// Remove background flicker in IE (read this: http://misterpixel.blogspot.com/2006/09/forensic-analysis-of-ie6.html)
	// This doesn't have anything to do with SWFUpload but can help your UI behave better in IE.
	try {
		document.execCommand('BackgroundImageCache', false, true);
	} catch (ex1) {
	}


	try {
		this.customSettings = {};	// A container where developers can place their own settings associated with this instance.
		this.settings = {};
		this.eventQueue = [];
		this.movieName = "SWFUpload_" + SWFUpload.movieCount++;
		this.movieElement = null;

		// Setup global control tracking
		SWFUpload.instances[this.movieName] = this;

		// Load the settings.  Load the Flash movie.
		this.initSettings(init_settings);
		this.loadFlash();

		this.displayDebugInfo();

	} catch (ex2) {
		this.debug(ex2);
	}
}

/* *************** */
/* Static thingies */
/* *************** */
SWFUpload.instances = {};
SWFUpload.movieCount = 0;
SWFUpload.QUEUE_ERROR = {
	QUEUE_LIMIT_EXCEEDED	  		: -100,
	FILE_EXCEEDS_SIZE_LIMIT  		: -110,
	ZERO_BYTE_FILE			  		: -120,
	INVALID_FILETYPE		  		: -130
};
SWFUpload.UPLOAD_ERROR = {
	HTTP_ERROR				  		: -200,
	MISSING_UPLOAD_URL	      		: -210,
	IO_ERROR				  		: -220,
	SECURITY_ERROR			  		: -230,
	UPLOAD_LIMIT_EXCEEDED	  		: -240,
	UPLOAD_FAILED			  		: -250,
	SPECIFIED_FILE_ID_NOT_FOUND		: -260,
	FILE_VALIDATION_FAILED	  		: -270,
	FILE_CANCELLED			  		: -280,
	UPLOAD_STOPPED					: -290
};
SWFUpload.FILE_STATUS = {
	QUEUED		 : -1,
	IN_PROGRESS	 : -2,
	ERROR		 : -3,
	COMPLETE	 : -4,
	CANCELLED	 : -5
};


/* ***************** */
/* Instance Thingies */
/* ***************** */
// init is a private method that ensures that all the object settings are set, getting a default value if one was not assigned.

SWFUpload.prototype.initSettings = function (init_settings) {
	// Upload backend settings
	this.addSetting("upload_url",		 		init_settings.upload_url,		  		"");
	this.addSetting("file_post_name",	 		init_settings.file_post_name,	  		"Filedata");
	this.addSetting("post_params",		 		init_settings.post_params,		  		{});

	// File Settings
	this.addSetting("file_types",			  	init_settings.file_types,				"*.*");
	this.addSetting("file_types_description", 	init_settings.file_types_description, 	"All Files");
	this.addSetting("file_size_limit",		  	init_settings.file_size_limit,			"1024");
	this.addSetting("file_upload_limit",	  	init_settings.file_upload_limit,		"0");
	this.addSetting("file_queue_limit",		  	init_settings.file_queue_limit,			"0");

	// Flash Settings
	this.addSetting("flash_url",		  		init_settings.flash_url,				"swfupload.swf");
	this.addSetting("flash_width",		  		init_settings.flash_width,				"1px");
	this.addSetting("flash_height",		  		init_settings.flash_height,				"1px");
	this.addSetting("flash_color",		  		init_settings.flash_color,				"#FFFFFF");

	// Debug Settings
	this.addSetting("debug_enabled", init_settings.debug,  false);

	// Event Handlers
	this.flashReady_handler         = SWFUpload.flashReady;	// This is a non-overrideable event handler
	this.swfUploadLoaded_handler    = this.retrieveSetting(init_settings.swfupload_loaded_handler,	    SWFUpload.swfUploadLoaded);
	
	this.fileDialogStart_handler	= this.retrieveSetting(init_settings.file_dialog_start_handler,		SWFUpload.fileDialogStart);
	this.fileQueued_handler			= this.retrieveSetting(init_settings.file_queued_handler,			SWFUpload.fileQueued);
	this.fileQueueError_handler		= this.retrieveSetting(init_settings.file_queue_error_handler,		SWFUpload.fileQueueError);
	this.fileDialogComplete_handler	= this.retrieveSetting(init_settings.file_dialog_complete_handler,	SWFUpload.fileDialogComplete);
	
	this.uploadStart_handler		= this.retrieveSetting(init_settings.upload_start_handler,			SWFUpload.uploadStart);
	this.uploadProgress_handler		= this.retrieveSetting(init_settings.upload_progress_handler,		SWFUpload.uploadProgress);
	this.uploadError_handler		= this.retrieveSetting(init_settings.upload_error_handler,			SWFUpload.uploadError);
	this.uploadSuccess_handler		= this.retrieveSetting(init_settings.upload_success_handler,		SWFUpload.uploadSuccess);
	this.uploadComplete_handler		= this.retrieveSetting(init_settings.upload_complete_handler,		SWFUpload.uploadComplete);

	this.debug_handler				= this.retrieveSetting(init_settings.debug_handler,			   		SWFUpload.debug);

	// Other settings
	this.customSettings = this.retrieveSetting(init_settings.custom_settings, {});
};

// loadFlash is a private method that generates the HTML tag for the Flash
// It then adds the flash to the "target" or to the body and stores a
// reference to the flash element in "movieElement".
SWFUpload.prototype.loadFlash = function () {
	var html, target_element, container;

	// Make sure an element with the ID we are going to use doesn't already exist
	if (document.getElementById(this.movieName) !== null) {
		return false;
	}

	// Get the body tag where we will be adding the flash movie
	try {
		target_element = document.getElementsByTagName("body")[0];
		if (typeof(target_element) === "undefined" || target_element === null) {
			this.debug('Could not find the BODY element. SWFUpload failed to load.');
			return false;
		}
	} catch (ex) {
		return false;
	}

	// Append the container and load the flash
	container = document.createElement("div");
	container.style.width = this.getSetting("flash_width");
	container.style.height = this.getSetting("flash_height");

	target_element.appendChild(container);
	container.innerHTML = this.getFlashHTML();	// Using innerHTML is non-standard but the only sensible way to dynamically add Flash in IE (and maybe other browsers)
};

// Generates the embed/object tags needed to embed the flash in to the document
SWFUpload.prototype.getFlashHTML = function () {
	var html = "";

	// Create Mozilla Embed HTML
	if (navigator.plugins && navigator.mimeTypes && navigator.mimeTypes.length) {
		// Build the basic embed html
		html = '<embed type="application/x-shockwave-flash" src="' + this.getSetting("flash_url") + '" width="' + this.getSetting("flash_width") + '" height="' + this.getSetting("flash_height") + '"';
		html += ' id="' + this.movieName + '" name="' + this.movieName + '" ';
		html += 'bgcolor="' + this.getSetting("flash_color") + '" quality="high" menu="false" flashvars="';

		html += this.getFlashVars();

		html += '" />';

		// Create IE Object HTML
	} else {

		// Build the basic Object tag
		html = '<object id="' + this.movieName + '" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="' + this.getSetting("flash_width") + '" height="' + this.getSetting("flash_height") + '">';
		html += '<param name="movie" value="' + this.getSetting("flash_url") + '">';

		html += '<param name="bgcolor" value="' + this.getSetting("flash_color") + '" />';
		html += '<param name="quality" value="high" />';
		html += '<param name="menu" value="false" />';

		html += '<param name="flashvars" value="' + this.getFlashVars() + '" />';
		html += '</object>';
	}

	return html;
};

// This private method builds the parameter string that will be passed
// to flash.
SWFUpload.prototype.getFlashVars = function () {
	// Build a string from the post param object
	var param_string = this.buildParamString();

	// Build the parameter string
	var html = "";
	html += "movieName=" + encodeURIComponent(this.movieName);
	html += "&uploadURL=" + encodeURIComponent(this.getSetting("upload_url"));
	html += "&params=" + encodeURIComponent(param_string);
	html += "&filePostName=" + encodeURIComponent(this.getSetting("file_post_name"));
	html += "&fileTypes=" + encodeURIComponent(this.getSetting("file_types"));
	html += "&fileTypesDescription=" + encodeURIComponent(this.getSetting("file_types_description"));
	html += "&fileSizeLimit=" + encodeURIComponent(this.getSetting("file_size_limit"));
	html += "&fileUploadLimit=" + encodeURIComponent(this.getSetting("file_upload_limit"));
	html += "&fileQueueLimit=" + encodeURIComponent(this.getSetting("file_queue_limit"));
	html += "&debugEnabled=" + encodeURIComponent(this.getSetting("debug_enabled"));

	return html;
};

SWFUpload.prototype.getMovieElement = function () {
	if (typeof(this.movieElement) === "undefined" || this.movieElement === null) {
		this.movieElement = document.getElementById(this.movieName);

		// Fix IEs "Flash can't callback when in a form" issue (http://www.extremefx.com.ar/blog/fixing-flash-external-interface-inside-form-on-internet-explorer)
		// Removed because Revision 6 always adds the flash to the body (inside a containing div)
		// If you insist on adding the Flash file inside a Form then in IE you have to make you wait until the DOM is ready
		// and run this code to make the form's ID available from the window object so Flash and JavaScript can communicate.
		//if (typeof(window[this.movieName]) === "undefined" || window[this.moveName] !== this.movieElement) {
		//	window[this.movieName] = this.movieElement;
		//}
	}

	return this.movieElement;
};

SWFUpload.prototype.buildParamString = function () {
	var post_params = this.getSetting("post_params");
	var param_string_pairs = [];
	var i, value, name;

	// Retrieve the user defined parameters
	if (typeof(post_params) === "object") {
		for (name in post_params) {
			if (post_params.hasOwnProperty(name)) {
				if (typeof(post_params[name]) === "string") {
					param_string_pairs.push(encodeURIComponent(name) + "=" + encodeURIComponent(post_params[name]));
				}
			}
		}
	}

	return param_string_pairs.join("&");
};

// Saves a setting.	 If the value given is undefined or null then the default_value is used.
SWFUpload.prototype.addSetting = function (name, value, default_value) {
	if (typeof(value) === "undefined" || value === null) {
		this.settings[name] = default_value;
	} else {
		this.settings[name] = value;
	}

	return this.settings[name];
};

// Gets a setting.	Returns empty string if not found.
SWFUpload.prototype.getSetting = function (name) {
	if (typeof(this.settings[name]) === "undefined") {
		return "";
	} else {
		return this.settings[name];
	}
};

// Gets a setting, if the setting is undefined then return the default value
// This does not affect or use the interal setting object.
SWFUpload.prototype.retrieveSetting = function (value, default_value) {
	if (typeof(value) === "undefined" || value === null) {
		return default_value;
	} else {
		return value;
	}
};


// It loops through all the settings and displays
// them in the debug Console.
SWFUpload.prototype.displayDebugInfo = function () {
	var key, debug_message = "";

	debug_message += "----- SWFUPLOAD SETTINGS     ----\nID: " + this.moveName + "\n";

	debug_message += this.outputObject(this.settings);

	debug_message += "----- SWFUPLOAD SETTINGS END ----\n";
	debug_message += "\n";

	this.debug(debug_message);
};
SWFUpload.prototype.outputObject = function (object, prefix) {
	var output = "", key;

	if (typeof(prefix) !== "string") {
		prefix = "";
	}
	if (typeof(object) !== "object") {
		return "";
	}

	for (key in object) {
		if (object.hasOwnProperty(key)) {
			if (typeof(object[key]) === "object") {
				output += (prefix + key + ": { \n" + this.outputObject(object[key], "\t" + prefix) + prefix + "}" + "\n");
			} else {
				output += (prefix + key + ": " + object[key] + "\n");
			}
		}
	}

	return output;
};

/* *****************************
	-- Flash control methods --
	Your UI should use these
	to operate SWFUpload
   ***************************** */

SWFUpload.prototype.selectFile = function () {
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.SelectFile) === "function") {
		try {
			movie_element.SelectFile();
		}
		catch (ex) {
			this.debug("Could not call SelectFile: " + ex);
		}
	} else {
		this.debug("Could not find Flash element");
	}

};

SWFUpload.prototype.selectFiles = function () {
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.SelectFiles) === "function") {
		try {
			movie_element.SelectFiles();
		}
		catch (ex) {
			this.debug("Could not call SelectFiles: " + ex);
		}
	} else {
		this.debug("Could not find Flash element");
	}

};


/* Start the upload.  If a file_id is specified that file is uploaded. Otherwise the first
 * file in the queue is uploaded.  If no files are in the queue then nothing happens.
 * This call uses setTimeout since Flash will be calling back in to JavaScript
 */
SWFUpload.prototype.startUpload = function (file_id) {
	var self = this;
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.StartUpload) === "function") {
		setTimeout(
			function () {
				try {
					movie_element.StartUpload(file_id);
				}
				catch (ex) {
					self.debug("Could not call StartUpload: " + ex);
				}
			}, 0
		);
	} else {
		this.debug("Could not find Flash element");
	}

};

/* Cancels a the file upload.  You must specify a file_id */
SWFUpload.prototype.cancelUpload = function (file_id) {
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.CancelUpload) === "function") {
		try {
			movie_element.CancelUpload(file_id);
		}
		catch (ex) {
			this.debug("Could not call CancelUpload: " + ex);
		}
	} else {
		this.debug("Could not find Flash element");
	}

};

// Stops the current upload.  The file is re-queued.  If nothing is currently uploading then nothing happens.
SWFUpload.prototype.stopUpload = function () {
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.StopUpload) === "function") {
		try {
			movie_element.StopUpload();
		}
		catch (ex) {
			this.debug("Could not call StopUpload: " + ex);
		}
	} else {
		this.debug("Could not find Flash element");
	}

};

/* ************************
 * Settings methods
 *   These methods change the settings inside SWFUpload
 *   They shouldn't need to be called in a setTimeout since they
 *   should not call back from Flash to JavaScript (except perhaps in a Debug call)
 *   and some need to return data so setTimeout won't work.
 */

/* Gets the file statistics object.	 It looks like this (where n = number):
	{
		files_queued: n,
		complete_uploads: n,
		upload_errors: n,
		uploads_cancelled: n,
		queue_errors: n
	}
*/
SWFUpload.prototype.getStats = function () {
	var self = this;
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.GetStats) === "function") {
		try {
			return movie_element.GetStats();
		}
		catch (ex) {
			self.debug("Could not call GetStats");
		}
	} else {
		this.debug("Could not find Flash element");
	}
};
SWFUpload.prototype.setStats = function (stats_object) {
	var self = this;
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.SetStats) === "function") {
		try {
			movie_element.SetStats(stats_object);
		}
		catch (ex) {
			self.debug("Could not call SetStats");
		}
	} else {
		this.debug("Could not find Flash element");
	}
};
SWFUpload.prototype.getFile = function (file_id) {
	var self = this;
	var movie_element = this.getMovieElement();
			if (typeof(file_id) === "number") {
				if (movie_element !== null && typeof(movie_element.GetFileByIndex) === "function") {
					try {
						return movie_element.GetFileByIndex(file_id);
					}
					catch (ex) {
						self.debug("Could not call GetFileByIndex");
					}
				} else {
					this.debug("Could not find Flash element");
				}
			} else {
				if (movie_element !== null && typeof(movie_element.GetFile) === "function") {
					try {
						return movie_element.GetFile(file_id);
					}
					catch (ex) {
						self.debug("Could not call GetFile");
					}
				} else {
					this.debug("Could not find Flash element");
				}
			}
};

SWFUpload.prototype.addFileParam = function (file_id, name, value) {
	var self = this;
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.AddFileParam) === "function") {
		try {
			return movie_element.AddFileParam(file_id, name, value);
		}
		catch (ex) {
			self.debug("Could not call AddFileParam");
		}
	} else {
		this.debug("Could not find Flash element");
	}
};

SWFUpload.prototype.removeFileParam = function (file_id, name) {
	var self = this;
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.RemoveFileParam) === "function") {
		try {
			return movie_element.RemoveFileParam(file_id, name);
		}
		catch (ex) {
			self.debug("Could not call AddFileParam");
		}
	} else {
		this.debug("Could not find Flash element");
	}

};

SWFUpload.prototype.setUploadURL = function (url) {
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.SetUploadURL) === "function") {
		try {
			this.addSetting("upload_url", url);
			movie_element.SetUploadURL(this.getSetting("upload_url"));
		}
		catch (ex) {
			this.debug("Could not call SetUploadURL");
		}
	} else {
		this.debug("Could not find Flash element in setUploadURL");
	}
};

SWFUpload.prototype.setPostParams = function (param_object) {
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.SetPostParams) === "function") {
		try {
			this.addSetting("post_params", param_object);
			movie_element.SetPostParams(this.getSetting("post_params"));
		}
		catch (ex) {
			this.debug("Could not call SetPostParams");
		}
	} else {
		this.debug("Could not find Flash element in SetPostParams");
	}
};

SWFUpload.prototype.setFileTypes = function (types, description) {
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.SetFileTypes) === "function") {
		try {
			this.addSetting("file_types", types);
			this.addSetting("file_types_description", description);
			movie_element.SetFileTypes(this.getSetting("file_types"), this.getSetting("file_types_description"));
		}
		catch (ex) {
			this.debug("Could not call SetFileTypes");
		}
	} else {
		this.debug("Could not find Flash element in SetFileTypes");
	}
};

SWFUpload.prototype.setFileSizeLimit = function (file_size_limit) {
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.SetFileSizeLimit) === "function") {
		try {
			this.addSetting("file_size_limit", file_size_limit);
			movie_element.SetFileSizeLimit(this.getSetting("file_size_limit"));
		}
		catch (ex) {
			this.debug("Could not call SetFileSizeLimit");
		}
	} else {
		this.debug("Could not find Flash element in SetFileSizeLimit");
	}
};

SWFUpload.prototype.setFileUploadLimit = function (file_upload_limit) {
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.SetFileUploadLimit) === "function") {
		try {
			this.addSetting("file_upload_limit", file_upload_limit);
			movie_element.SetFileUploadLimit(this.getSetting("file_upload_limit"));
		}
		catch (ex) {
			this.debug("Could not call SetFileUploadLimit");
		}
	} else {
		this.debug("Could not find Flash element in SetFileUploadLimit");
	}
};

SWFUpload.prototype.setFileQueueLimit = function (file_queue_limit) {
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.SetFileQueueLimit) === "function") {
		try {
			this.addSetting("file_queue_limit", file_queue_limit);
			movie_element.SetFileQueueLimit(this.getSetting("file_queue_limit"));
		}
		catch (ex) {
			this.debug("Could not call SetFileQueueLimit");
		}
	} else {
		this.debug("Could not find Flash element in SetFileQueueLimit");
	}
};

SWFUpload.prototype.setFilePostName = function (file_post_name) {
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.SetFilePostName) === "function") {
		try {
			this.addSetting("file_post_name", file_post_name);
			movie_element.SetFilePostName(this.getSetting("file_post_name"));
		}
		catch (ex) {
			this.debug("Could not call SetFilePostName");
		}
	} else {
		this.debug("Could not find Flash element in SetFilePostName");
	}
};

SWFUpload.prototype.setDebugEnabled = function (debug_enabled) {
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.SetDebugEnabled) === "function") {
		try {
			this.addSetting("debug_enabled", debug_enabled);
			movie_element.SetDebugEnabled(this.getSetting("debug_enabled"));
		}
		catch (ex) {
			this.debug("Could not call SetDebugEnabled");
		}
	} else {
		this.debug("Could not find Flash element in SetDebugEnabled");
	}
};

/* *******************************
	Internal Event Callers
	Don't override these! These event callers ensure that your custom event handlers
	are called safely and in order.
******************************* */

/* This is the callback method that the Flash movie will call when it has been loaded and is ready to go.
   Calling this or showUI() "manually" will bypass the Flash Detection built in to SWFUpload.
   Use a ui_function setting if you want to control the UI loading after the flash has loaded.
*/
SWFUpload.prototype.flashReady = function () {
	var self = this;
	if (typeof(self.fileDialogStart_handler) === "function") {
		this.eventQueue[this.eventQueue.length] = function() { self.flashReady_handler(); };
		setTimeout(function () { self.executeNextEvent();}, 0);
	} else {
		this.debug("fileDialogStart event not defined");
	}
};

/*
	Event Queue.  Rather can call events directly from Flash they events are
	are placed in a queue and then executed.  This ensures that each event is
	executed in the order it was called which is not guarenteed when calling
	setTimeout.  Out of order events was especially problematic in Safari.
*/
SWFUpload.prototype.executeNextEvent = function () {
	var  f = this.eventQueue.shift();
	if (typeof(f) === "function") {
		f();
	}
}

/* This is a chance to do something before the browse window opens */
SWFUpload.prototype.fileDialogStart = function () {
	var self = this;
	if (typeof(self.fileDialogStart_handler) === "function") {
		this.eventQueue[this.eventQueue.length] = function() { self.fileDialogStart_handler(); };
		setTimeout(function () { self.executeNextEvent();}, 0);
	} else {
		this.debug("fileDialogStart event not defined");
	}
};


/* Called when a file is successfully added to the queue. */
SWFUpload.prototype.fileQueued = function (file) {
	var self = this;
	if (typeof(self.fileQueued_handler) === "function") {
		this.eventQueue[this.eventQueue.length] = function() { self.fileQueued_handler(file); };
		setTimeout(function () { self.executeNextEvent();}, 0);
	} else {
		this.debug("fileQueued event not defined");
	}
};


/* Handle errors that occur when an attempt to queue a file fails. */
SWFUpload.prototype.fileQueueError = function (file, error_code, message) {
	var self = this;
	if (typeof(self.fileQueueError_handler) === "function") {
		this.eventQueue[this.eventQueue.length] = function() {  self.fileQueueError_handler(file, error_code, message); };
		setTimeout(function () { self.executeNextEvent();}, 0);
	} else {
		this.debug("fileQueueError event not defined");
	}
};

/* Called after the file dialog has closed and the selected files have been queued.
	You could call startUpload here if you want the queued files to begin uploading immediately. */
SWFUpload.prototype.fileDialogComplete = function (num_files_selected) {
	var self = this;
	if (typeof(self.fileDialogComplete_handler) === "function") {
		this.eventQueue[this.eventQueue.length] = function() { self.fileDialogComplete_handler(num_files_selected); };
		setTimeout(function () { self.executeNextEvent();}, 0);
	} else {
		this.debug("fileDialogComplete event not defined");
	}
};

/* Gets called when a file upload is about to be started.  Return true to continue the upload. Return false to stop the upload.
	If you return false then uploadError and uploadComplete are called (like normal).
	
	This is a good place to do any file validation you need.
	*/
SWFUpload.prototype.uploadStart = function (file) {
	var self = this;
	if (typeof(self.fileDialogComplete_handler) === "function") {
		this.eventQueue[this.eventQueue.length] = function() { self.returnUploadStart(self.uploadStart_handler(file)); };
		setTimeout(function () { self.executeNextEvent();}, 0);
	} else {
		this.debug("uploadStart event not defined");
	}
};

/* Note: Internal use only.  This function returns the result of uploadStart to
	flash.  Since returning values in the normal way can result in Flash/JS circular
	call issues we split up the call in a Timeout.  This is transparent from the API
	point of view.
*/
SWFUpload.prototype.returnUploadStart = function (return_value) {
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.ReturnUploadStart) === "function") {
		try {
			movie_element.ReturnUploadStart(return_value);
		}
		catch (ex) {
			this.debug("Could not call ReturnUploadStart");
		}
	} else {
		this.debug("Could not find Flash element in returnUploadStart");
	}
};



/* Called during upload as the file progresses. Use this event to update your UI. */
SWFUpload.prototype.uploadProgress = function (file, bytes_complete, bytes_total) {
	var self = this;
	if (typeof(self.uploadProgress_handler) === "function") {
		this.eventQueue[this.eventQueue.length] = function() { self.uploadProgress_handler(file, bytes_complete, bytes_total); };
		setTimeout(function () { self.executeNextEvent();}, 0);
	} else {
		this.debug("uploadProgress event not defined");
	}
};

/* Called when an error occurs during an upload. Use error_code and the SWFUpload.UPLOAD_ERROR constants to determine
   which error occurred. The uploadComplete event is called after an error code indicating that the next file is
   ready for upload.  For files cancelled out of order the uploadComplete event will not be called. */
SWFUpload.prototype.uploadError = function (file, error_code, message) {
	var self = this;
	if (typeof(this.uploadError_handler) === "function") {
		this.eventQueue[this.eventQueue.length] = function() { self.uploadError_handler(file, error_code, message); };
		setTimeout(function () { self.executeNextEvent();}, 0);
	} else {
		this.debug("uploadError event not defined");
	}
};

/* This gets called when a file finishes uploading and the server-side upload script has completed and returned a 200
status code. Any text returned by the server is available in server_data.
**NOTE: The upload script MUST return some text or the uploadSuccess and uploadComplete events will not fire and the
upload will become 'stuck'. */
SWFUpload.prototype.uploadSuccess = function (file, server_data) {
	var self = this;
	if (typeof(self.uploadSuccess_handler) === "function") {
		this.eventQueue[this.eventQueue.length] = function() { self.uploadSuccess_handler(file, server_data); };
		setTimeout(function () { self.executeNextEvent();}, 0);
	} else {
		this.debug("uploadSuccess event not defined");
	}
};

/* uploadComplete is called when the file is uploaded or an error occurred and SWFUpload is ready to make the next upload.
   If you want the next upload to start to automatically you can call startUpload() from this event. */
SWFUpload.prototype.uploadComplete = function (file) {
	var self = this;
	if (typeof(self.uploadComplete_handler) === "function") {
		this.eventQueue[this.eventQueue.length] = function() { self.uploadComplete_handler(file); };
		setTimeout(function () { self.executeNextEvent();}, 0);
	} else {
		this.debug("uploadComplete event not defined");
	}
};

/* Called by SWFUpload JavaScript and Flash functions when debug is enabled. By default it writes messages to the
   internal debug console.  You can override this event and have messages written where you want. */
SWFUpload.prototype.debug = function (message) {
	var self = this;
	if (typeof(self.debug_handler) === "function") {
		this.eventQueue[this.eventQueue.length] = function() { self.debug_handler(message); };
		setTimeout(function () { self.executeNextEvent();}, 0);
	} else {
		this.eventQueue[this.eventQueue.length] = function() { self.debugMessage(message); };
		setTimeout(function () { self.executeNextEvent();}, 0);
	}
};


/* **********************************
	Default Event Handlers.
	These event handlers are used by default if an overriding handler is
	not defined in the SWFUpload settings object.
	
	JS Note: even though these are defined on the SWFUpload object (rather than the prototype) they
	are attached (read: copied) to a SWFUpload instance and 'this' is given the proper context.
   ********************************** */

/* This is a special event handler that has no override in the settings.  Flash calls this when it has
   been loaded by the browser and is ready for interaction.  You should not override it.  If you need
   to do something with SWFUpload has loaded then use the swfupload_loaded_handler setting.
*/
SWFUpload.flashReady = function () {
	try {
		this.debug("Flash called back and is ready.");

		if (typeof(this.swfUploadLoaded_handler) === "function") {
			this.swfUploadLoaded_handler();
		}
	} catch (ex) {
		this.debug(ex);
	}
};

/* This is a chance to something immediately after SWFUpload has loaded.
   Like, hide the default/degraded upload form and display the SWFUpload form. */
SWFUpload.swfUploadLoaded = function () {
};

/* This is a chance to do something before the browse window opens */
SWFUpload.fileDialogStart = function () {
};


/* Called when a file is successfully added to the queue. */
SWFUpload.fileQueued = function (file) {
};


/* Handle errors that occur when an attempt to queue a file fails. */
SWFUpload.fileQueueError = function (file, error_code, message) {
	try {
		switch (error_code) {
		case SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT:
			this.debug("Error Code: File too big, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
			this.debug("Error Code: Zero Byte File, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.QUEUE_ERROR.QUEUE_LIMIT_EXCEEDED:
			this.debug("Error Code: Upload limit reached, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.QUEUE_ERROR.INVALID_FILETYPE:
			this.debug("Error Code: File extension is not allowed, Message: " + message);
			break;
		default:
			this.debug("Error Code: Unhandled error occured. Errorcode: " + error_code);
		}
	} catch (ex) {
		this.debug(ex);
	}
};

/* Called after the file dialog has closed and the selected files have been queued.
	You could call startUpload here if you want the queued files to begin uploading immediately. */
SWFUpload.fileDialogComplete = function (num_files_selected) {
};

/* Gets called when a file upload is about to be started.  Return true to continue the upload. Return false to stop the upload.
	If you return false then the uploadError callback is called and then uploadComplete (like normal).
	
	This is a good place to do any file validation you need.
	
	This is the only function that cannot be called on a setTimeout because it must return a value to Flash.
	You SHOULD NOT make any calls in to Flash (e.i, changing settings, getting stats, etc).  Flash Player bugs prevent
	calls in to Flash from working reliably.
*/
SWFUpload.uploadStart = function (file) {
	return true;
};

// Called during upload as the file progresses
SWFUpload.uploadProgress = function (file, bytes_complete, bytes_total) {
	this.debug("File Progress: " + file.id + ", Bytes: " + bytes_complete + ". Total: " + bytes_total);
};

/* This gets called when a file finishes uploading and the upload script has completed and returned a 200 status code.	Any text returned by the
server is available in server_data.	 The upload script must return some text or uploadSuccess will not fire (neither will uploadComplete). */
SWFUpload.uploadSuccess = function (file, server_data) {
};

/* This is called last.	 The file is uploaded or an error occurred and SWFUpload is ready to make the next upload.
	If you want to automatically start the next file just call startUpload from here.
*/
SWFUpload.uploadComplete = function (file) {
};

// Called by SWFUpload JavaScript and Flash functions when debug is enabled.
// Override this method in your settings to call your own debug message handler
SWFUpload.debug = function (message) {
	if (this.getSetting("debug_enabled")) {
		this.debugMessage(message);
	}
};

/* Called when an upload occurs during upload.  For HTTP errors 'message' will contain the HTTP STATUS CODE */
SWFUpload.uploadError = function (file, error_code, message) {
	try {
		switch (errcode) {
		case SWFUpload.UPLOAD_ERROR.SPECIFIED_FILE_ID_NOT_FOUND:
			this.debug("Error Code: File ID specified for upload was not found, Message: " + msg);
			break;
		case SWFUpload.UPLOAD_ERROR.HTTP_ERROR:
			this.debug("Error Code: HTTP Error, File name: " + file.name + ", Message: " + msg);
			break;
		case SWFUpload.UPLOAD_ERROR.MISSING_UPLOAD_URL:
			this.debug("Error Code: No backend file, File name: " + file.name + ", Message: " + msg);
			break;
		case SWFUpload.UPLOAD_ERROR.IO_ERROR:
			this.debug("Error Code: IO Error, File name: " + file.name + ", Message: " + msg);
			break;
		case SWFUpload.UPLOAD_ERROR.SECURITY_ERROR:
			this.debug("Error Code: Security Error, File name: " + file.name + ", Message: " + msg);
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_LIMIT_EXCEEDED:
			this.debug("Error Code: Upload limit reached, File name: " + file.name + ", File size: " + file.size + ", Message: " + msg);
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_FAILED:
			this.debug("Error Code: Upload Initialization exception, File name: " + file.name + ", File size: " + file.size + ", Message: " + msg);
			break;
		case SWFUpload.UPLOAD_ERROR.FILE_VALIDATION_FAILED:
			this.debug("Error Code: uploadStart callback returned false, File name: " + file.name + ", File size: " + file.size + ", Message: " + msg);
			break;
		case SWFUpload.UPLOAD_ERROR.FILE_CANCELLED:
			this.debug("Error Code: The file upload was cancelled, File name: " + file.name + ", File size: " + file.size + ", Message: " + msg);
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_STOPPED:
			this.debug("Error Code: The file upload was stopped, File name: " + file.name + ", File size: " + file.size + ", Message: " + msg);
			break;
		default:
			this.debug("Error Code: Unhandled error occured. Errorcode: " + errcode);
		}
	} catch (ex) {
		this.debug(ex);
	}
};



/* **********************************
	Debug Console
	The debug console is a self contained, in page location
	for debug message to be sent.  The Debug Console adds
	itself to the body if necessary.

	The console is automatically scrolled as messages appear.
	
	You can override this console (to use FireBug's console for instance) by setting the debug event method to your own function
	that handles the debug message
   ********************************** */
SWFUpload.prototype.debugMessage = function (message) {
	var exception_message, exception_values;

	if (typeof(message) === "object" && typeof(message.name) === "string" && typeof(message.message) === "string") {
		exception_message = "";
		exception_values = [];
		for (var key in message) {
			exception_values.push(key + ": " + message[key]);
		}
		exception_message = exception_values.join("\n");
		exception_values = exception_message.split("\n");
		exception_message = "EXCEPTION: " + exception_values.join("\nEXCEPTION: ");
		SWFUpload.Console.writeLine(exception_message);
	} else {
		SWFUpload.Console.writeLine(message);
	}
};

SWFUpload.Console = {};
SWFUpload.Console.writeLine = function (message) {
	var console, documentForm;

	try {
		console = document.getElementById("SWFUpload_Console");

		if (!console) {
			documentForm = document.createElement("form");
			document.getElementsByTagName("body")[0].appendChild(documentForm);

			console = document.createElement("textarea");
			console.id = "SWFUpload_Console";
			console.style.fontFamily = "monospace";
			console.setAttribute("wrap", "off");
			console.wrap = "off";
			console.style.overflow = "auto";
			console.style.width = "700px";
			console.style.height = "350px";
			console.style.margin = "5px";
			documentForm.appendChild(console);
		}

		console.value += message + "\n";

		console.scrollTop = console.scrollHeight - console.clientHeight;
	} catch (ex) {
		alert("Exception: " + ex.name + " Message: " + ex.message);
	}
};




// directory of where all the images are
var cmThemeOfficeBase = '/JSCookMenu/ThemeOffice/';

// the follow block allows user to re-define theme base directory
// before it is loaded.
try
{
	if (myThemeOfficeBase)
	{
		cmThemeOfficeBase = myThemeOfficeBase;
	}
}
catch (e)
{
}

var cmThemeOffice =
{
	prefix:	'ThemeOffice',
  	// main menu display attributes
  	//
  	// Note.  When the menu bar is horizontal,
  	// mainFolderLeft and mainFolderRight are
  	// put in <span></span>.  When the menu
  	// bar is vertical, they would be put in
  	// a separate TD cell.

  	// HTML code to the left of the folder item
  	mainFolderLeft: '&nbsp;',
  	// HTML code to the right of the folder item
  	mainFolderRight: '&nbsp;',
	// HTML code to the left of the regular item
	mainItemLeft: '&nbsp;',
	// HTML code to the right of the regular item
	mainItemRight: '&nbsp;',

	// sub menu display attributes

	// HTML code to the left of the folder item
	folderLeft: '<img alt="" src="' + cmThemeOfficeBase + 'spacer.gif">',
	// HTML code to the right of the folder item
	folderRight: '<img alt="" src="' + cmThemeOfficeBase + 'arrow.gif">',
	// HTML code to the left of the regular item
	itemLeft: '<img alt="" src="' + cmThemeOfficeBase + 'spacer.gif">',
	// HTML code to the right of the regular item
	itemRight: '<img alt="" src="' + cmThemeOfficeBase + 'blank.gif">',
	// cell spacing for main menu
	mainSpacing: 0,
	// cell spacing for sub menus
	subSpacing: 0,

	subMenuHeader: '<div class="ThemeOfficeSubMenuShadow"></div>',

	offsetHMainAdjust:	[-1, 0],
	offsetSubAdjust:	[-1, -1]

	// rest use default settings
};

// for horizontal menu split
var cmThemeOfficeHSplit = [_cmNoClick, '<td class="ThemeOfficeMenuItemLeft"></td><td colspan="2" class="ThemeOfficeMenuSplit"><div class="ThemeOfficeMenuSplit"></div></td>'];
var cmThemeOfficeMainHSplit = [_cmNoClick, '<td class="ThemeOfficeMainItemLeft"></td><td colspan="2" class="ThemeOfficeMenuSplit"><div class="ThemeOfficeMenuSplit"></div></td>'];
var cmThemeOfficeMainVSplit = [_cmNoClick, '|'];

/* IE can't do negative margin on tables */
/*@cc_on
	cmThemeOffice.subMenuHeader = '<div class="ThemeOfficeSubMenuShadow" style="background-color: #cccccc; filter: alpha(opacity=35);"></div>';
@*/



/*
 * Thickbox 2.1 - One Box To Rule Them All.
 * By Cody Lindley (http://www.codylindley.com)
 * Copyright (c) 2006 cody lindley
 * Licensed under the MIT License:
 *   http://www.opensource.org/licenses/mit-license.php
 * Thickbox is built on top of the very light weight jQuery library.
 */

//on page load call TB_init
//$(document).ready(TB_init);

//add thickbox to href elements that have a class of .thickbox
function TB_init()
{
	$("a.thickbox").click(function(){return false;});
	$("a.thickbox").click(
	function()
	{
		var t = this.title || this.name || null;
		var g = this.rel || false;
		TB_show(t,this.href,g);
		this.blur();
		return false;
	});
}

function TB_show(caption, url, imageGroup) {//function called when the user clicks on a thickbox link

	try {
		if (document.getElementById("TB_HideSelect") == null) 
		{
			$("body").append("<iframe id='TB_HideSelect'></iframe><div id='TB_overlay'></div><div id='TB_window' style='display:none'></div>");
			$("#TB_overlay").click(TB_remove);
		}
		
		if(caption==null){caption=""};
		
		$(window).scroll(TB_position);
 		
		TB_overlaySize();
		
		$("body").append("<div id='TB_load' style='background-color:#FFFFFF; border:5px ridge #CCCCCC;height:75px; width:175px;' align='center'><center><font color='#999999' size='3'><b>Loading, Please Wait.</b></font><br /><br /><img src='"+siteUrl+"images/loading.gif' /></center></div>");
		TB_load_position_loading();
		
		
		
	   if(url.indexOf("?")!==-1){ //If there is a query string involved
			var baseURL = url.substr(0, url.indexOf("?"));
	   }else{ 
	   		var baseURL = url;
	   }
	   var urlString = /\.jpg|\.jpeg|\.png|\.gif|\.bmp/g;
	   var urlType = baseURL.toLowerCase().match(urlString);
	   
	   var baseURL1 = url;
	   var urlString1 = /\.php\?file\=/g;
	   var urlType1 = baseURL1.toLowerCase().match(urlString1);
		
		if((urlType == '.jpg' || urlType == '.jpeg' || urlType == '.png' || urlType == '.gif' || urlType == '.bmp') || (urlType1 == '.php?file=')){//code to show images
				
			TB_PrevCaption = "";
			TB_PrevURL = "";
			TB_PrevHTML = "";
			TB_NextCaption = "";
			TB_NextURL = "";
			TB_NextHTML = "";
			TB_imageCount = "";
			TB_FoundURL = false;
			if(imageGroup){
				TB_TempArray = $("a[@rel="+imageGroup+"]").get();
				for (TB_Counter = 0; ((TB_Counter < TB_TempArray.length) && (TB_NextHTML == "")); TB_Counter++) {
					var urlTypeTemp = TB_TempArray[TB_Counter].href.toLowerCase().match(urlString);
						if (!(TB_TempArray[TB_Counter].href == url)) {						
							if (TB_FoundURL) {
								TB_NextCaption = TB_TempArray[TB_Counter].title;
								TB_NextURL = TB_TempArray[TB_Counter].href;
								TB_NextHTML = "<span id='TB_next'>&nbsp;&nbsp;<a href='#'>Next &gt;&gt;</a></span>";
							} else {
								TB_PrevCaption = TB_TempArray[TB_Counter].title;
								TB_PrevURL = TB_TempArray[TB_Counter].href;
								TB_PrevHTML = "<span id='TB_prev'>&nbsp;&nbsp;<a href='#'>&lt;&lt; Prev</a></span>";
							}
						} else {
							TB_FoundURL = true;
							TB_imageCount = "Image " + (TB_Counter + 1) +" of "+ (TB_TempArray.length);											
						}
				}
			}

			imgPreloader = new Image();
			imgPreloader.onload = function(){		
			imgPreloader.onload = null;
				
			// Resizing large images - orginal by Christian Montoya edited by me.
			var pagesize = TB_getPageSize();
			var x = pagesize[0] - 150;
			var y = pagesize[1] - 150;
			var imageWidth = imgPreloader.width;
			var imageHeight = imgPreloader.height;
			if (imageWidth > x) {
				imageHeight = imageHeight * (x / imageWidth); 
				imageWidth = x; 
				if (imageHeight > y) { 
					imageWidth = imageWidth * (y / imageHeight); 
					imageHeight = y; 
				}
			} else if (imageHeight > y) { 
				imageWidth = imageWidth * (y / imageHeight); 
				imageHeight = y; 
				if (imageWidth > x) { 
					imageHeight = imageHeight * (x / imageWidth); 
					imageWidth = x;
				}
			}
			// End Resizing
			
			TB_WIDTH = imageWidth + 30;
			TB_HEIGHT = imageHeight + 60;
			$("#TB_window").append("<a href='' id='TB_ImageOff' title='Close'><img id='TB_Image' src='"+url+"' width='"+imageWidth+"' height='"+imageHeight+"' alt='"+caption+"'/></a>" + "<div id='TB_caption'>"+caption+"<div id='TB_secondLine'>" + TB_imageCount + TB_PrevHTML + TB_NextHTML + "</div></div><div id='TB_closeWindow'><a href='#' id='TB_closeWindowButton' title='Close'>Close</a></div>"); 		
			//$("#TB_window").fadeIn(800);
			$("#TB_closeWindowButton").click(TB_remove);
			
			if (!(TB_PrevHTML == "")) 
			{
				function goPrev()
				{
					$("#TB_window").fadeOut('fast',
					function()
					{
						$("#TB_window").remove();
						if($(document).unclick(goPrev)){$(document).unclick(goPrev)};
						$("body").append("<div id='TB_window' style='display:none'></div>");
						TB_show(TB_PrevCaption, TB_PrevURL, imageGroup);
					});
					return false;	
				}
				$("#TB_prev").click(goPrev);
			}
			
			if (!(TB_NextHTML == "")) {		
			
				function goNext()
				{
					$("#TB_window").fadeOut('fast',
						function()
						{
							$("#TB_window").remove();
							if($(document).unclick(goNext)){$(document).unclick(goNext)};
							$("body").append("<div id='TB_window' style='display:none'></div>");
							TB_show(TB_NextCaption, TB_NextURL, imageGroup);
						});
					return false;	
				}
				$("#TB_next").click(goNext);
			}
			
			document.onkeydown = function(e)
			{ 	
				if (e == null) 
				{ // ie
					keycode = event.keyCode;
				} 
				else 
				{ // mozilla
					keycode = e.which;
				}
				if(keycode == 27)
				{ // close
					TB_remove();
				} 
				else if(keycode == 190)
				{ // display previous image
					if(!(TB_NextHTML == ""))
					{
						document.onkeydown = "";
						goNext();
					}
				} 
				else if(keycode == 188)
				{ // display next image
					if(!(TB_PrevHTML == ""))
					{
						document.onkeydown = "";
						goPrev();
					}
				}	
			}
				
			TB_position();
			$("#TB_load").remove();
			$("#TB_window").fadeIn('fast');
			$("#TB_ImageOff").click(TB_remove);
			}
	  
			imgPreloader.src = url;
		}
		else
		{//code to show html pages
			
			var queryString = url.replace(/^[^\?]+\??/,'');
			var params = TB_parseQuery( queryString );
			
			var url_link = params['link'];
			
			TB_WIDTH = (params['width']*1) + 30;
			TB_HEIGHT = (params['height']*1) + 40;
			ajaxContentW = TB_WIDTH - 30;
			ajaxContentH = TB_HEIGHT - 45;
			
			if(url.indexOf('TB_iframe') != -1)
			{				
					urlNoQuery = url.split('TB_');		
					 $("#TB_window").append("<div id='TB_dragWindow'>"+
											"<div id='TB_title'>"+
												"<div id='TB_ajaxWindowTitle'>"+caption+"</div>"+
												"<div id='TB_closeAjaxWindow'>"+
													"<a href='#' id='TB_closeWindowButton' title='Close'>Close</a>"+
												"</div>"+
											"</div>"+
											"<iframe frameborder='0' hspace='0' src='"+url_link+"' id='TB_iframeContent' name='TB_iframeContent' style='width:"+(ajaxContentW + 29)+"px;height:"+(ajaxContentH + 17)+"px;' onload='TB_showIframe()'> </iframe></div>");
			}
			else
			{
					 $("#TB_window").append("<div id='TB_dragWindow'>"+
												"<div id='TB_title'>"+
										    		"<div id='TB_ajaxWindowTitle'>"+
													caption
													+"</div>"+
										   			"<div id='TB_closeAjaxWindow'>"+
										   				"<a href='javascript:;' id='TB_closeWindowButton'>Close</a>"+
										   			"</div>"+
										    	"</div>"+
										    	"<div id='TB_ajaxContent' style='width:"+ajaxContentW+"px;height:"+ajaxContentH+"px;'></div>"+
											"</div>");
			}
					
			$("#TB_closeWindowButton").click(TB_remove);
			
				if(url.indexOf('TB_inline') != -1)
				{	
					$("#TB_ajaxContent").html($('#' + params['inlineId']).html());
					TB_position();
					$("#TB_load").hide(function(){$("#TB_load").remove();$("#TB_window").fadeIn('fast');});
				}
				else if(url.indexOf('TB_iframe') != -1)
				{
					TB_position();
					if(frames['TB_iframeContent'] == undefined)
					{//be nice to safari
						$("#TB_load").hide(function(){$("#TB_load").remove(function(){});$("#TB_window").fadeIn('fast');});
						//$("#TB_window").Draggable({ghosting: true,opacity: 0.5,fx: 100});
						$(document).keyup( function(e){ var key = e.keyCode; if(key == 27){TB_remove()} });
					}
				}else{
					$("#TB_ajaxContent").load(url_link, function(){
						TB_position();
						$("#TB_load").hide(function(){$("#TB_load").remove();$("#TB_window").fadeIn('fast');});
					});
				}
			
		}
		
		$(window).resize(TB_position);
		
		document.onkeyup = function(e){ 	
			if (e == null) { // ie
				keycode = event.keyCode;
			} else { // mozilla
				keycode = e.which;
			}
			if(keycode == 27){ // close
				TB_remove();
			}	
		}
		
	} catch(e) {
		alert( e );
	}
}

//helper functions below

function TB_showIframe(){
	$("#TB_load").remove();
	$("#TB_window").css({display:"block"});
}

function TB_remove()
{
	$("#TB_load").remove();
	$("#TB_window").fadeOut('fast',function(){$('#TB_window,#TB_overlay,#TB_HideSelect').remove();});
	return false;
}

function TB_remove_load()
{
	$("#TB_load,#TB_overlay_load").hide(function(){$("#TB_load,#TB_overlay_load").remove();});
	return false;
}

function TB_position() {
	var pagesize = TB_getPageSize();	
	var arrayPageScroll = TB_getPageScrollTop();	
	$("#TB_window").css({width:TB_WIDTH+"px",left: (arrayPageScroll[0] + (pagesize[0] - TB_WIDTH)/2)+"px", top: (arrayPageScroll[1] + (pagesize[1]-TB_HEIGHT)/2)+"px" });
}

function TB_overlaySize(){
	if (window.innerHeight && window.scrollMaxY || window.innerWidth && window.scrollMaxX) {	
		yScroll = window.innerHeight + window.scrollMaxY;
		xScroll = window.innerWidth + window.scrollMaxX;
	} else if (document.body.scrollHeight > document.body.offsetHeight || document.body.scrollWidth > document.body.offsetWidth){ // all but Explorer Mac
		yScroll = document.body.scrollHeight;
		xScroll = document.body.scrollWidth;
	} else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
		yScroll = document.body.offsetHeight;
		xScroll = document.body.offsetWidth;
  	}
	$("#TB_overlay").css({"height":yScroll +"px", "width":xScroll +"px"});
	$("#TB_HideSelect").css({"height":yScroll +"px","width":xScroll +"px"});
}

function TB_load_position() 
{
	var pagesize = TB_getPageSize();
	var arrayPageScroll = TB_getPageScrollTop();
	$("#TB_load").css({left: (arrayPageScroll[0] + (pagesize[0] - 100)/2)+"px", top: (arrayPageScroll[1] + ((pagesize[1]-100)/2))+"px" }).css({display:"block"});
}

function TB_load_position_loading() 
{
	var pagesize = TB_getPageSize();
	var arrayPageScroll = TB_getPageScrollTop();
	$("#TB_load").css("top","300px").css("left",(arrayPageScroll[0] + (pagesize[0] - 300)/2)+"px").css("display","block");
	$("#TB_load").show()
}

function TB_parseQuery ( query ) {
   var Params = new Object ();
   if ( ! query ) return Params; // return empty object
   var Pairs = query.split(/[;&]/);
   for ( var i = 0; i < Pairs.length; i++ ) {
      var KeyVal = Pairs[i].split('=');
      if ( ! KeyVal || KeyVal.length != 2 ) continue;
      var key = unescape( KeyVal[0] );
      var val = unescape( KeyVal[1] );
      val = val.replace(/\+/g, ' ');
      Params[key] = val;
   }
   return Params;
}

function TB_getPageScrollTop(){
	var yScrolltop;
	var xScrollleft;
	if (self.pageYOffset || self.pageXOffset) {
		yScrolltop = self.pageYOffset;
		xScrollleft = self.pageXOffset;
	} else if (document.documentElement && document.documentElement.scrollTop || document.documentElement.scrollLeft ){	 // Explorer 6 Strict
		yScrolltop = document.documentElement.scrollTop;
		xScrollleft = document.documentElement.scrollLeft;
	} else if (document.body) {// all other Explorers
		yScrolltop = document.body.scrollTop;
		xScrollleft = document.body.scrollLeft;
	}
	arrayPageScroll = new Array(xScrollleft,yScrolltop) 
	return arrayPageScroll;
}

function TB_getPageSize(){
	var de = document.documentElement;
	var w = window.innerWidth || self.innerWidth || (de&&de.clientWidth) || document.body.clientWidth;
	var h = window.innerHeight || self.innerHeight || (de&&de.clientHeight) || document.body.clientHeight
	arrayPageSize = new Array(w,h) 
	return arrayPageSize;
}



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


