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
