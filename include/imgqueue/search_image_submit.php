<?php
        error_reporting(E_ERROR);
        session_start();

        require_once( "search_image.php" );
        require_once( "../shared/php/thumbnail_generator.php" );

        $query = $_POST[ 'si_query' ];
        //$query = "Art^&/\*yom";

        if( !isset( $query ) || $query == "" ) die( "No images found.||=||" );
        else
        {
            $query = preg_replace( "/[^a-zA-Z0-9 ]/", "", $query );
            $query = preg_replace( "/ /", "&nbsp;", $query );
        }
        
        $results_per_page = 25;
        $results_counter  = 0;
                
        $oSearchForImage  = new SearchForImage( $query );
        $status           = $oSearchForImage->result();
        
        $thumb_long_side  = $oSearchForImage->glob[23];
        $big_long_side    = $oSearchForImage->glob[32];
        $img_sep          = $oSearchForImage->glob[5];
        $pg_sep           = $oSearchForImage->glob[10];
        
        $image_search_result = "";
        $img_id              = array();
        $width               = array();
        $height              = array();
        $img_info            = array();

        $results_counter = 0;
        while( $row = mysql_fetch_array( $status ) )
        {     
            $img_id[ $results_counter ]    = $row[ "extern_fn" ];
            
            $width[ $results_counter ]     = $row[ "width" ];
            $height[ $results_counter ]    = $row[ "height" ];
            
            $img_info[ $results_counter ]  = $row[ "name" ]        . "_iis_";
            $img_info[ $results_counter ] .= $row[ "artist" ]      . "_iis_";
            $img_info[ $results_counter ] .= $row[ "era" ]         . "_iis_";
            $img_info[ $results_counter ] .= $row[ "style" ]       . "_iis_";
            $img_info[ $results_counter ] .= $row[ "genre" ]       . "_iis_";
            $img_info[ $results_counter ] .= $row[ "filesize" ]    . "_iis_";
            $img_info[ $results_counter ] .= $row[ "uploaded_by" ] . "_iis_";

            $results_counter++;
        }
        
        for( $i = 0; $i < count( $img_id );  $i++ )
        {
            $img_info[$i]  = preg_replace( "/$query/i", "<span class=&qt;query_highlight&qt;>$query</span>", $img_info[ $i ] );
            
            $ratio         = aspect_ratio( $width[ $i ], $height[ $i ] );
            
            $new_w_h_thumb = new_w_h( $ratio, $thumb_long_side );
            $new_w_h_big   = new_w_h( $ratio, $big_long_side );


            $image_search_result .= "<div onclick=\"view_big_image( '$img_id[$i]',
                                                                    '$new_w_h_big[0]',
                                                                    '$new_w_h_big[1]',
                                                                    '$img_info[$i]',
                                                                    '$i'             );\"/>";

            $image_search_result .= "<img src=\"./include/imgqueue/".
                                    "display_image.php?img_id=$img_id[$i]\"".
                                    " width=$new_w_h_thumb[0] height=$new_w_h_thumb[1] />";

            if( $i % 25 == 0 && $i > 0)
                $image_search_result .= "</div>$img_sep$pg_sep";
            else
                $image_search_result .= "</div>$img_sep";            
        }
    
        if( $image_search_result != "" )
            print  "Success||=||" . $image_search_result;
        else
            print "No images found.||=||";
?>