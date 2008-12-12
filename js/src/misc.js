
// Enable cross browser/platform clipboard access.
function copyToClipboard(inElement) 
{
	if (inElement.createTextRange) 
	{
		var range = inElement.createTextRange();
		if (range)
		{
			range.execCommand('Copy');
		}
	} 
	else 
	{
		var flashcopier = 'flashcopier';
		if(!document.getElementById(flashcopier)) 
		{
			var divholder = document.createElement('div');
			divholder.id = flashcopier;
			document.body.appendChild(divholder);
		}
		document.getElementById(flashcopier).innerHTML = '';
		var divinfo = '<embed src="'+___baseUrl()+'/flash/_clipboard.swf" FlashVars="clipboard='+encodeURIComponent(inElement.value)+'" width="0" height="0" type="application/x-shockwave-flash"></embed>';
		document.getElementById(flashcopier).innerHTML = divinfo;
	}
}

function end(array) 
{
	// http://kevin.vanzonneveld.net
	var last_elm, key;
	
	if (array.constructor == Array)
	{
		last_elm = array[(array.length-1)];
	} 
	else 
	{
		for (key in array)
		{
			last_elm = array[key];
		}
	}

	return last_elm;
}

function in_array(needle, haystack, strict) 
{
	// http://kevin.vanzonneveld.net
	var found = false, key, strict = !!strict;
 
	for (key in haystack) {
		if ((strict && haystack[key] === needle) || (!strict && haystack[key] == needle)) {
			found = true;
			break;
		}
	}
	return found;
}

function getExtension(file)
{
	return end(file.split('.')).toLowerCase();	
}