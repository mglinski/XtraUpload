<?
/*
#########################################################################
# class Thumbnail.inc.php (PHP 4 Implementation)						#
#																		#
# Copyright (c)2005-2006 Ian Selby										#
# ian@gen-x-design.com													#
#-----------------------------------------------------------------------#
#																		#
# This program is free software; you can redistribute it and/or modify	#
# it under the terms of the MIT License 								#
#																		#
# This program is distributed in the hope that it will be useful,		#
# but WITHOUT ANY WARRANTY; without even the implied warranty of		#
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the			#
# MIT License for more details.											#
#																		#
#########################################################################

USAGE:
include the class in the file you wish to manipulate your images in
then set initial values for your new image.  

Required values are:
	* $fileName
	* $cropSize if you wish to crop image

You may make as many manipulations to the image that you want before 
showing it or saving it, remembering the following:
	* if percentage is not 0, maxWidth and maxHeight are ignored
	* maxWidth or maxHeight CANNOT be equal to cropSize (produces erratic results)
	
Sample Usage:
$thumb = new Thumbnail;
$thumb->quality = 100;
$thumb->fileName = "/path/to/file.jpg";
//IMPORTANT - must run init() function before any manipulation is performed
$thumb->init();
//shrink image by 50%
$thumb->percent = 50;
$thumb->resize();
//crop image to 350x350 from center of image
$thumb->cropSize = 350;
$thumb->crop();
//resize image to no more than 125px wide
$thumb->percent = 0;
$thumb->maxWidth = 125;
$thumb->resize();
//save image as 'filename.jpg'
$thumb->save('/path/to/save/filename.jpg');

You can also use this class to dynamically generate thumbnails and display them
After you have made your manipulations you could display the result by:
echo '<img src="' . $thumb->show() . '" />';

*/
class imageThumb {
	var $errmsg;				//error message to parse
	var $error;					//flag for whether there is an error
	var $format;				//file format of image
	var $currentDimensions;		//current dimensions of working image
	var $newDimensions;			//new dimensions after manipulation
	var $newImage;				//final image to be displayed/saved
	var $oldImage;				//original image to be manipulated
	var $workingImage;			//working image being manipulated
	var $fileName;				//filename of image, can include directory
	var $maxWidth;				//maximum width of the image
	var $maxHeight;				//maximum height of the image
	var $percent;				//percentage of the original image size
	var $quality;				//image quality of jpeg images
	var $cropSize;				//size in px to crop from the center of the image (crop is always square)
	var $cropX;
	var $cropY;
	
	function imageThumb() {
	//class constructor
		$this->errmsg = '';
		$this->error = false;
		$this->format = '';
		$this->currentDimensions = array();
		$this->newDimensions = array();
		$this->fileName = '';
		$this->maxWidth = 0;
		$this->maxHeight = 0;
		$this->percent = 0;
		$this->quality = 60;
		$this->cropSize = 0;
		$this->cropX = 0;
		$this->cropY = 0;
	}
	
	function destruct() {
		if($this->newImage) @ImageDestroy($this->newImage);
		if($this->oldImage) @ImageDestroy($this->oldImage);
		if($this->workingImage) @ImageDestroy($this->workingImage);
	}
	
	function init() 
	{
	//initialize function that does basic error checking and determines file type
		//check to see if file exists
		if(!file_exists($this->fileName)) 
		{
			$this->errmsg = "File not found: ".$this->fileName;
			$this->error = true;
		}
		//check to see if file is readable
		elseif(!is_readable($this->fileName)) 
		{
			$this->errmsg = "File is not readable";
			$this->error = true;
		}
		
		//determine file extension
		if($this->error == false) 
		{
			//check if gif
			if(stristr(strtolower($this->fileName),'.gif')) $this->format = 'GIF';
			//check if jpeg
			elseif(stristr(strtolower($this->fileName),'.jpg') || stristr(strtolower($this->fileName),'.jpeg')) $this->format = "JPG";
			//check if png
			elseif(stristr(strtolower($this->fileName),'.png')) $this->format = 'PNG';
			//unknown file format
			else {
				$this->errmsg = "Unknown file format";
				$this->error = true;
			}
		}
		
		//catch user forgetting to specify size paramenters
		if($this->maxWidth == 0 && $this->maxHeight == 0 && $this->percent == 0) $this->percent = 100;
		
		if($this->error == false) 
		{
			switch($this->format) {
				case "GIF":
					$this->oldImage = ImageCreateFromGif($this->fileName);
					break;
				case "JPG":
					$this->oldImage = ImageCreateFromJpeg($this->fileName);
					break;
				case "PNG":
					$this->oldImage = ImageCreateFromPng($this->fileName);
					break;
			}
			$size = GetImageSize($this->fileName);
			$this->currentDimensions = array("width"=>$size[0],"height"=>$size[1]);
			$this->newImage = $this->oldImage;
		}
		
		if($this->error) {
			$this->showErrorImage();
			break;
		}
	}
	
	function getCurrentWidth() {
		return $this->currentDimensions['width'];
	}
	function getCurrentHeight() {
		return $this->currentDimensions['height'];
	}
	
	#############################################
	#---- Image Size Calculation Functions -----#
	#############################################
	function calcWidth($width,$height) {
		$newWP = (100 * $this->maxWidth) / $width;
		$newHeight = ($height * $newWP) / 100;
		return array("newWidth"=>intval($this->maxWidth),"newHeight"=>intval($newHeight));
	}
	
	function calcHeight($width,$height) {
		$newHP = (100 * $this->maxHeight) / $height;
		$newWidth = ($width * $newHP) / 100;
		return array("newWidth"=>intval($newWidth),"newHeight"=>intval($this->maxHeight));
	}

	function calcPercent($width,$height) {
		$newWidth = ($width * $this->percent) / 100;
		$newHeight = ($height * $this->percent) / 100;
		return array("newWidth"=>intval($newWidth),"newHeight"=>intval($newHeight));
	}	

    function calcImageSize($width,$height) 
	{
		$newSize = array("newWidth"=>$width,"newHeight"=>$height);
		
		if($this->maxWidth > 0 && $width > $this->maxWidth) 
		{
			$newSize = $this->calcWidth($width,$height);
			
			if($this->maxHeight > 0 && $newSize['newHeight'] > $this->maxHeight)
				$newSize = $this->calcHeight($newSize['newWidth'],$newSize['newHeight']);
			
			$this->newDimensions = $newSize;
			return;
		}
		
		if($this->maxHeight > 0 && $height > $this->maxHeight) {
			$newSize = $this->calcHeight($width,$height);
			
			if($this->maxWidth > 0 && $newSize['newWidth'] > $this->maxWidth) {
				$newSize = $this->calcWidth($newSize['newWidth'],$newSize['newHeight']);
			}
			
			$this->newDimensions = $newSize;
			return;
		}
		
		if($this->percent > 0) {
			$newSize = $this->calcPercent($width,$height);
			$this->newDimensions = $newSize;
			return;
		}
		$this->newDimensions = $newSize;
		return;
	}

	#######################################
	#----- Show Error Image Function -----#
	#######################################
	function showErrorImage() {
	//output an error image to the user
		echo $this->errmsg;
	}

	##########################################
	#----- Image Manipulation Functions -----#
	##########################################
	function resize($name = '') 
	{		
		$this->calcImageSize($this->currentDimensions['width'],$this->currentDimensions['height']);
		
		if(function_exists("ImageCreateTrueColor")) 
		{
			//echo '['.$this->newDimensions['newWidth'].']X['.$this->newDimensions['newHeight'].']';
			$this->workingImage = ImageCreateTrueColor($this->newDimensions['newWidth'],$this->newDimensions['newHeight']);
		}
		else 
		{
			$this->workingImage = ImageCreate($this->newDimensions['newWidth'],$this->newDimensions['newHeight']);
		}
		
		ImageCopyResampled(
			$this->workingImage,
			$this->oldImage,
			0,
			0,
			0,
			0,
			$this->newDimensions['newWidth'],
			$this->newDimensions['newHeight'],
			$this->currentDimensions['width'],
			$this->currentDimensions['height']
		);
		
		$this->oldImage = $this->workingImage;
		$this->newImage = $this->workingImage;
		$this->currentDimensions['width'] = $this->newDimensions['newWidth'];
		$this->currentDimensions['height'] = $this->newDimensions['newHeight'];
	}	
	
	function crop() {
		$cropX = intval(($this->currentDimensions['width'] - $this->cropSize) / 2);
		$cropY = intval(($this->currentDimensions['height'] - $this->cropSize) / 2);
		
		if(function_exists("ImageCreateTrueColor")) {
			$this->workingImage = ImageCreateTrueColor($this->cropSize,$this->cropSize);
		}
		else {
			$this->workingImage = ImageCreate($this->cropSize,$this->cropSize);
		}
		
		ImageCopy(
			$this->workingImage,
			$this->oldImage,
			0,
			0,
			$this->cropX,
			$this->cropY,
			$this->cropSize,
			$this->cropSize
		);
		
		$this->oldImage = $this->workingImage;
		$this->newImage = $this->workingImage;
		$this->currentDimensions['width'] = $this->cropSize;
		$this->currentDimensions['height'] = $this->cropSize;
	}
	
	##########################################
	#----- Image Display/Save Functions -----#
	##########################################
	function save($name) {
		$this->show($name);
	}
	
	function show($name='') {
		
		switch($this->format) {
			case "GIF":
				if($name != '') {
					ImageGif($this->newImage,$name);
				}
				else {
					header("Content-type: image/gif");
					ImageGif($this->newImage);
				}
				break;
			case "JPG":
				if($name != '') {
					ImageJpeg($this->newImage,$name,$this->quality);
				}
				else {
					header("Content-type: image/jpeg");
					ImageJpeg($this->newImage,'',$this->quality);
				}
				break;
			case "PNG":
				if($name != '') {
					ImagePng($this->newImage,$name);
				}
				else {
					header("Content-type: image/png");
					ImagePng($this->newImage,$name);
				}
				break;
		}
	}
}
?>