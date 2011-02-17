<?php
	session_start();
	
	function aspect_ratio( $width, $height )
	{
	    $ratio = array();
	    
	    // If image is a landscape.
	    if( $width > $height )
	    {
		$ratio[0] = $height / $width;
		$ratio[1] = "bigger_width";
	    }
	    // If image is a portrait.
	    if( $width < $height )
	    {
		$ratio[0] = $width / $height;
		$ratio[1] = "bigger_height";
	    }
	    // If image is a square.
	    if( $width == $height )
	    {
		$ratio[0] = 1;
		$ratio[1] = "equal";
	    }
	    
	    return $ratio;
	}
	function new_w_h( $ratio, $thumb_long_side )
        {
		$w_h = array();
		
		if( $ratio[ 1 ] == "bigger_width" )
		{
		    $w_h[0] = $thumb_long_side;
		    $w_h[1] = (int)($thumb_long_side * $ratio[ 0 ]);
		}
		if( $ratio[ 1 ] == "bigger_height" )
		{
		    $w_h[0] = (int)($thumb_long_side * $ratio[ 0 ]);
		    $w_h[1] = $thumb_long_side;
		}
		if( $ratio[ 0 ] == 1 )
		{
		    $w_h[0] = $thumb_long_side;
		    $w_h[1] = $thumb_long_side;
		}
		
		return $w_h;
	}

/*
	Function createthumb($name,$filename,$new_w,$new_h)
	creates a resized image
	variables:
	$name		Original filename
	$filename	Filename of the resized image
	$new_w		width of resized image
	$new_h		height of resized image
*/	
function createthumb( $name, $filename, $new_w, $new_h, $mime_type, $old_x, $old_y )
{
	//$system = explode( ".", $name );
	if ( $mime_type == "png" )
	{
		if( !imagecreatefrompng( $name ) )
			return "<b>imagecreatefrompng_false</b>";
		else
			$src_img = imagecreatefrompng( $name );
	}
	if ( $mime_type == "jpg" || $mime_type == "jpeg" )
	{
		if( !imagecreatefromjpeg( $name ) )
			return "<b>imagecreatefromjpeg_false</b>";
		else
			$src_img = imagecreatefromjpeg( $name );
	}
	if ( $mime_type == "gif" )
	{
		if( !imagecreatefromgif( $name ) )
			return "<b>imagecreatefromgif_false</b>";
		else
			$src_img = imagecreatefromgif( $name );
	}
	
	//$old_x = imageSX( $src_img );
	//$old_y = imageSY( $src_img );

	$dst_img = ImageCreateTrueColor( $new_w, $new_h );
	
	imagecopyresampled( $dst_img, $src_img, 0, 0, 0, 0, $new_w, $new_h, $old_x, $old_y ); 
	
	if ( $mime_type == "png" )
	{
		if( !imagepng( $dst_img, $filename ) )
			return "<b>imagepng_false</b>";
		else
			imagepng( $dst_img, $filename ); 
		
	}
	if ( $mime_type == "jpg" || $mime_type == "jpeg" )
	{
		if( !imagejpeg( $dst_img, $filename ) )
			return "<b>imagejpeg_false</b>";
		else
			imagejpeg( $dst_img, $filename ); 
	}
	if( $mime_type == "gif" )
	{
		if( !imagegif( $dst_img, $filename ) )
			return "<b>imagegif_false</b>";
		else
			imagegif( $dst_img, $filename ); 
	}
	//if( $mime_type == "png" && $mime_type == "jpg" && $mime_type != "jpeg" && $mime_type == "gif" )
	//{
	//	/*
	//	 * Indicates that mime type is not supported.
	//	 *  Image will be just resized instead of having
	//	 * thumbnail.
	//	 */ 
	//	return false;
	//}
	
	if( !imagedestroy( $src_img ) )
		return "<b>false_src_destroy</b>";
	//else
		//imagedestroy( $src_img );
		
	if( !imagedestroy( $dst_img ) )
		return "<b>false_dst_destroy</b>";
	//else
		//imagedestroy( $src_img );	
	
	return "success";
}

?>
