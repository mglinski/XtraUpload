<?php
/*
XtraUpload - File Hosting Software
Copyright (C) 2006-2007  Matthew Glinski and XtraFile.com
Link: http://www.xtrafile.com
-----------------------------------------------------------------
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program(LICENSE.txt); if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
	<title><?=$sitename?></title>
    
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    
	<link rel="StyleSheet" href="./css/style.css" type="text/css" />
    <link rel="stylesheet" href="../css/farbtastic.css" type="text/css" />
	<link type="text/css" rel="stylesheet" href="./css/menu.css" />
    
	<script type="text/javascript" src="../js/xu.js"></script>
    <script language="javascript" src="./js/menu.inc.js"></script>
	<script language="JavaScript">
		function popUp(URL,NAME) 
		{
			amznwin=window.open(URL,NAME,'location=yes,scrollbars=yes,status=yes,toolbar=yes,resizable=yes,width=380,height=450,screenX=10,screenY=10,top=10,left=10');
			amznwin.focus();
		}
		function gotocluster(s)
		{       
			var d = s.options[s.selectedIndex].value
			if(d)
			{
				self.location.href = d
			}
			s.selectedIndex=0
		}
		$(document).ready(function()
		{
			cmThemeOffice.effect = new CMSlidingEffect(8)
			cmDraw ('staticMenuBar', xuMenu, 'hbr', cmThemeOffice, 'ThemeOffice');
		});
	</script>
<style type="text/css">
fieldset
{
	border: 1px solid #C2CDFF; 
}

legend
{
	color: #A43A15;
}

hr.divider
{
	height:1px;
	color: #3399FF;
}

.subLinks
{
	font-size:16px;
	font-weight:bold;
}

.mainContent
{
	height:auto;
}

.mainTable
{
	height:auto;
}

.mainRow
{
	height:auto;
}

.subTitle
{
	font-size:20px;
}


.farbtastic {
  position: relative;
}
.farbtastic * {
  position: absolute;
  cursor: crosshair;
}
.farbtastic, .farbtastic .wheel {
  width: 195px;
  height: 195px;
}
.farbtastic .color, .farbtastic .overlay {
  top: 47px;
  left: 47px;
  width: 101px;
  height: 101px;
}
.farbtastic .wheel {
  background: url(../images/wheel.png) no-repeat;
  width: 195px;
  height: 195px;
}
.farbtastic .overlay {
  background: url(../images/mask.png) no-repeat;
}
.farbtastic .marker {
  width: 17px;
  height: 17px;
  margin: -8px 0 0 -8px;
  overflow: hidden; 
  background: url(../images/marker.png) no-repeat;
}

#tooltip {
	background-color: #EEEEEE;
	border: 1px solid #000000;
	color: #333333;
	padding: 4px;
	-moz-border-radius-bottomleft: 7px;
	-moz-border-radius-bottomright: 7px;
	-moz-border-radius-topleft: 0;
	-moz-border-radius-topright: 7px;
	opacity: .95;
	max-width: 20em;
}
#tooltip h3 {
	font-size: 14pt !important;
    margin: 0;
	padding: 0 3px;
	text-align: left !important;
}

#tooltip p {
	font-size: 0.95em;
	margin: 5px 0 0 5px;
	text-align: left;
}
.style34 {font-size: 12px}
.style35 {color: #666666; font-size:14px; font-weight:bold}
-->
</style>
</head>
<body>
<div id="bodyWrap">
	<div class="pageWrapper">
		<div id="header">
			<div id="logo">
			  <h1>Logo &trade;</h1>
			</div>
<div id="heading">
				<div class="head"></div>
		  </div>
		</div>
	</div>
	<div class="pageWrapper" id="main">
		<div class="subTitleOuter">
			<div class="subTitleInner"></div>
	  </div>
		
		<div class="subBarOuter">
			<div class="subBarInner">
			  <div class="clear mozclear"></div>
			</div>
	  </div>
		<div class="content">
          <div class="titleMain" align="center">
          	<div id="staticMenuBar"></div>
          </div>
