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