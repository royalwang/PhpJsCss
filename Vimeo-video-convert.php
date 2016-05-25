<?php
function convertVimeo($string) {	
	//extract the ID
	preg_match('/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/',$string,$matches);
	//the ID of the Vimeo URL: 71673549 
	$id = $matches[2];	
	//set a custom width and height
	$width = '100%';
	$height = '';		
	return '<iframe src="http://player.vimeo.com/video/'.$id.'?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ff6600" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
}
?>
