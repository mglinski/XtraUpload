
function addToQueue()
{
	var links = $('#linkBlock').val().split("\n");
	var file;
	var fileLObj;
	var fileObj;
	var f_prefix = 'up';
	for(var i=0; links.length > i ;i++)
	{
		file = links[i];
		
		var fileLen = $.trim(file);
		var fileId = crc32(file);
		fileLen = fileLen.length;
		if(fileLen == 0)
		{
			continue;
		}
		var skip=false;
		for(var i=0; filesToUpload.length > i ;i++)
		{
			if(typeof(filesToUpload[i]) != 'undefined' && filesToUpload[i].name == basename(file))
			{
				skip=true;
			}
		}
		
		if(skip)
		{
			continue;
		}
		
		fileLObj = file.split('.');
		var fExt = fileLObj[(fileLObj.length - 1)];
		fileObj = {
			id: 'up_'+file_count,
			link: file,
			uploaded: false,
			type: fExt,
			name: basename(file)
		};
		
		filePropsObj[fileObj.id] = new Array();
		filePropsObj[fileObj.id]['feat'] = ''; 
		filePropsObj[fileObj.id]['desc'] = ''; 
		filePropsObj[fileObj.id]['pass'] = '';
		
		filesToUpload[file_count] = fileObj;
		addFileQueue(fileObj);
		file_count++;
	}
	toggleUploadBlock();
}

function rm_file(id)
{
	idO = id.split('up_')[1];
	$('#'+id).remove();
	$('#'+id+"-details").remove();
	var filesN = $('#summary').html().split(' Files')[0];
	$('#summary').html((filesN - 1) + ' Files');
	delete filesToUpload[idO];
}

function clearUploadQueue()
{
	for(var i=0; filesToUpload.length > i ;i++)
	{
		rm_file(filesToUpload[i].id);
	}
}

function startUploadQueue()
{
	var hasLoaded = false;
	$.each(filesToUpload, function(i, k)
	{
		if(typeof(k) != 'undefined' && !hasLoaded && k.uploaded != true)
		{
			hasLoaded = true;
			//alert(k.id);
			startUpload(k.id);
		}
		return;
	});
}

function addFileQueue(file)
{
	$('#file_list_table').append(""+
		"<tr id='"+file.id+"'>"+
			"<td class='align-left' style='vertical-align:middle'>"+
				"<img class='nb' src='"+___baseUrl()+"img/files/"+___getFileIcon(file.type.toLowerCase())+".png' border='0' />&nbsp;" +
				file.name +
			"</td>"+
			"<td id='"+file.id+"-del'>"+
				"<img id='"+file.id+"-edit_img' onclick=\"$('#"+file.id+"-details').show();$(this).fadeOut('fast')\" src='"+___baseUrl()+"img/icons/edit_16.png' title='Edit File Details' style='cursor:pointer' class='nb'>&nbsp;"+
				"<img onclick=\"rm_file('" + file.id + "');\" src='"+___baseUrl()+"img/icons/close_16.png' style='cursor:pointer' class='nb'>"+
			"</td>"+
		"</tr>"+
		
		"<tr id='"+file.id+"-details' class='details' style='display:none'>"+
			"<td id='"+file.id+"-details-inner' colspan='3'>"+
				'<span class="float-right"><label for="'+file.id+'_desc">'+___upLang('desc')+'</label>'+
				'<textarea name="'+file.id+'_desc" id="'+file.id+'_desc" cols="30" style="height:100px" rows="4"></textarea></span>'+
				'<label for="'+file.id+'_pass">'+___upLang('fp')+'</label>'+
				'<input name="'+file.id+'_pass" id="'+file.id+'_pass" size="35" maxlength="32" type="text" /><br />'+
                '<label for="'+file.id+'_feat">'+___upLang('ff1')+'</label>'+
				'<input name="'+file.id+'_feat" id="'+file.id+'_feat" type="checkbox" /> '+___upLang('ff2')+'<br /><br />'+
				'<input value="'+___upLang('sc')+'" type="button" onclick=\'saveFilePropChanges("'+file.id+'");$("#'+file.id+'-details").hide();$("#'+file.id+'-edit_img").fadeIn("fast");\' /><br /><br />'+
			"</td>"+
		"</tr>"
	);
	var filesN = parseInt($('#summary').html().split(' Files')[0]);
	$('#summary').html((filesN + 1) + ' Files');
}

function convert_bits(bytes) 
{
	var kb = bytes / 1024;
	if (kb < 1024) 
	{
		return Math.round(kb) + ' KB';
	} 
	else 
	{
		mb = kb / 1024;
		return Math.round(mb * 10) / 10 + ' MB';
	}
}

function checkProgress()
{
	if(allowCheckProgress)
	{
		$.getJSON(___progressURL()+"/"+currentFileId, function(json)
		{
			updateProgressBar(json[0]);
			setTimeout('checkProgress()', 5000);
		});
	}
}

function startProgress()
{
	allowCheckProgress = true;
	setTimeout('checkProgress()', 4000);
}

function endProgress(id)
{
	allowCheckProgress = false;
	pushUpdate(null, 0, null, 100);
}

function pushUpdate(total, remain, speed, per)
{
	if(total != null)
		$('#total').html(total);
	
	if(remain != null)
		$('#remaining').html(remain);
	
	if(speed != null)
		$('#speed').html(speed);
	
	if(per != null)
	{
		$('#percent').html(per);
		$("#progress_img").animate({width: per+"%"}, 'fast');
	}
}

function placeProgressBar(id)
{
	$("#up_"+id+"-details-inner").empty().html('<strong>Percent Complete</strong>: <span id="percent">0</span>%<table width="350" height="24" border="0"><tr><td width="25" height="24"><img src="'+___baseUrl()+'img/icons/import_24.png"  class="nb"  width="24" height="24" /></td><td width="300"><div class="progress_border"><div class="progress_img" id="progress_img"></div></div></td><td width="25"><img src="'+___baseUrl()+'img/icons/event_24.png" class="nb" width="24" height="24" /></td></tr></table><span id="total">0</span>KB Remaining (at <span id="speed">0</span> KBPS) <br /><span id="remaining">00h : 00m : 00s</span> remaining').show();
	$("#up_"+id+"-details").show();
}

function updateProgressBar(json)
{
	var sofar = json.sofar;
	var total = json.total;
	var startTime = json.startTime;
	
	var flashCurrentTime = Math.round(new Date().getTime()/1000.0);

	var lapsed =  flashCurrentTime - startTime;
	var bRead = sofar;
	var bSpeed = 0; 
	var speed = 0; 
	var remaining = 0;
	
	if(lapsed > 0)
	{ 
		bSpeed = (bRead / lapsed); 
	}
	
	if(bSpeed > 0)
	{ 
		remaining = Math.round((total - sofar) / bSpeed); 
	}
	
	var remaining_sec = (remaining % 60); 
	var remaining_min = (((remaining - remaining_sec) % 3600) / 60); 
	var remaining_hours = ((((remaining - remaining_sec) - (remaining_min * 60)) % 86400) / 3600); 
	
	if(remaining_sec < 10){ remaining_sec = "0"+remaining_sec; }
	if(remaining_min < 10){ remaining_min = "0"+remaining_min; }
	if(remaining_hours < 10){ remaining_hours = "0"+remaining_hours; }
	
	var remainingf = remaining_hours+"h : "+remaining_min+"m : "+remaining_sec+"s"; 
	
	var percent = Math.round(100 * bRead / total);
	if(lapsed>1)
	{
		speed = Math.round(bRead / lapsed);
	}
	else
	{
		speed = 0;
	}
	speed = Math.round(speed / 1024);	
	
	pushUpdate(Math.round((total-sofar)/1024), remainingf, speed, percent);
}

function basename(path, suffix) 
{
    var b = path.replace(/^.*[\/\\]/g, '');
    if (typeof(suffix) == 'string' && b.substr(b.length-suffix.length) == suffix) {
        b = b.substr(0, b.length-suffix.length);
    }
    return b;
}

function convert_bits(bytes) 
{
	var kb = bytes / 1024;
	if (kb < 1024) 
	{
		return Math.round(kb) + ' KB';
	} 
	else 
	{
		mb = kb / 1024;
		return Math.round(mb * 10) / 10 + ' MB';
	}
}

function utf8_encode ( str_data ) 
{
	str_data = str_data.replace(/\r\n/g,"\n");
    var tmp_arr = [], ac = 0;
 
    for (var n = 0; n < str_data.length; n++) {
        var c = str_data.charCodeAt(n);
        if (c < 128) {
            tmp_arr[ac++] = String.fromCharCode(c);
        } else if((c > 127) && (c < 2048)) {
            tmp_arr[ac++] = String.fromCharCode((c >> 6) | 192);
            tmp_arr[ac++] = String.fromCharCode((c & 63) | 128);
        } else {
            tmp_arr[ac++] = String.fromCharCode((c >> 12) | 224);
            tmp_arr[ac++] = String.fromCharCode(((c >> 6) & 63) | 128);
            tmp_arr[ac++] = String.fromCharCode((c & 63) | 128);
        }
    }
    
    return tmp_arr.join('');
}

function crc32 ( str ) 
{
    str = utf8_encode(str);
    var table = "00000000 77073096 EE0E612C 990951BA 076DC419 706AF48F E963A535 9E6495A3 0EDB8832 79DCB8A4 E0D5E91E 97D2D988 09B64C2B 7EB17CBD E7B82D07 90BF1D91 1DB71064 6AB020F2 F3B97148 84BE41DE 1ADAD47D 6DDDE4EB F4D4B551 83D385C7 136C9856 646BA8C0 FD62F97A 8A65C9EC 14015C4F 63066CD9 FA0F3D63 8D080DF5 3B6E20C8 4C69105E D56041E4 A2677172 3C03E4D1 4B04D447 D20D85FD A50AB56B 35B5A8FA 42B2986C DBBBC9D6 ACBCF940 32D86CE3 45DF5C75 DCD60DCF ABD13D59 26D930AC 51DE003A C8D75180 BFD06116 21B4F4B5 56B3C423 CFBA9599 B8BDA50F 2802B89E 5F058808 C60CD9B2 B10BE924 2F6F7C87 58684C11 C1611DAB B6662D3D 76DC4190 01DB7106 98D220BC EFD5102A 71B18589 06B6B51F 9FBFE4A5 E8B8D433 7807C9A2 0F00F934 9609A88E E10E9818 7F6A0DBB 086D3D2D 91646C97 E6635C01 6B6B51F4 1C6C6162 856530D8 F262004E 6C0695ED 1B01A57B 8208F4C1 F50FC457 65B0D9C6 12B7E950 8BBEB8EA FCB9887C 62DD1DDF 15DA2D49 8CD37CF3 FBD44C65 4DB26158 3AB551CE A3BC0074 D4BB30E2 4ADFA541 3DD895D7 A4D1C46D D3D6F4FB 4369E96A 346ED9FC AD678846 DA60B8D0 44042D73 33031DE5 AA0A4C5F DD0D7CC9 5005713C 270241AA BE0B1010 C90C2086 5768B525 206F85B3 B966D409 CE61E49F 5EDEF90E 29D9C998 B0D09822 C7D7A8B4 59B33D17 2EB40D81 B7BD5C3B C0BA6CAD EDB88320 9ABFB3B6 03B6E20C 74B1D29A EAD54739 9DD277AF 04DB2615 73DC1683 E3630B12 94643B84 0D6D6A3E 7A6A5AA8 E40ECF0B 9309FF9D 0A00AE27 7D079EB1 F00F9344 8708A3D2 1E01F268 6906C2FE F762575D 806567CB 196C3671 6E6B06E7 FED41B76 89D32BE0 10DA7A5A 67DD4ACC F9B9DF6F 8EBEEFF9 17B7BE43 60B08ED5 D6D6A3E8 A1D1937E 38D8C2C4 4FDFF252 D1BB67F1 A6BC5767 3FB506DD 48B2364B D80D2BDA AF0A1B4C 36034AF6 41047A60 DF60EFC3 A867DF55 316E8EEF 4669BE79 CB61B38C BC66831A 256FD2A0 5268E236 CC0C7795 BB0B4703 220216B9 5505262F C5BA3BBE B2BD0B28 2BB45A92 5CB36A04 C2D7FFA7 B5D0CF31 2CD99E8B 5BDEAE1D 9B64C2B0 EC63F226 756AA39C 026D930A 9C0906A9 EB0E363F 72076785 05005713 95BF4A82 E2B87A14 7BB12BAE 0CB61B38 92D28E9B E5D5BE0D 7CDCEFB7 0BDBDF21 86D3D2D4 F1D4E242 68DDB3F8 1FDA836E 81BE16CD F6B9265B 6FB077E1 18B74777 88085AE6 FF0F6A70 66063BCA 11010B5C 8F659EFF F862AE69 616BFFD3 166CCF45 A00AE278 D70DD2EE 4E048354 3903B3C2 A7672661 D06016F7 4969474D 3E6E77DB AED16A4A D9D65ADC 40DF0B66 37D83BF0 A9BCAE53 DEBB9EC5 47B2CF7F 30B5FFE9 BDBDF21C CABAC28A 53B39330 24B4A3A6 BAD03605 CDD70693 54DE5729 23D967BF B3667A2E C4614AB8 5D681B02 2A6F2B94 B40BBE37 C30C8EA1 5A05DF1B 2D02EF8D";
 
    var crc = 0;
    var x = 0;
    var y = 0;
 
    crc = crc ^ (-1);
    for( var i = 0, iTop = str.length; i < iTop; i++ ) {
        y = ( crc ^ str.charCodeAt( i ) ) & 0xFF;
        x = "0x" + table.substr( y * 9, 8 );
        crc = ( crc >>> 8 ) ^ x;
    }
 
    return crc ^ (-1);
}

function genRandId(length) 
{
    if(parseInt(length) == '')
	{
		length = 16;
	}
	
    var sPassword = "";

    for (i=0; i < length; i++) 
	{

        numI = getRandomNum();
        while (checkPunc(numI)) 
		{ 
			numI = getRandomNum();
		}
        sPassword += String.fromCharCode(numI);
    }

    return sPassword;
}

function getRandomNum() 
{
    // between 0 - 1
    var rndNum = Math.random()

    // rndNum from 0 - 1000
    rndNum = parseInt(rndNum * 1000);

    // rndNum from 33 - 127
    rndNum = (rndNum % 94) + 33;

    return rndNum;
}

function checkPunc(num) {

    if ((num >=33) && (num <=47)) { return true; }
    if ((num >=58) && (num <=64)) { return true; }
    if ((num >=91) && (num <=96)) { return true; }
    if ((num >=123) && (num <=126)) { return true; }

    return false;
}