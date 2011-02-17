<?php
        session_start();
        
        require_once( "search_image.php" );
        require_once( "../shared/php/thumbnail_generator.php" );

        $name        = $_POST[ "sia_name" ];
        $artist      = $_POST[ "sia_artist" ];
        $filesize    = $_POST[ "sia_filesize" ];

        $era         = $_POST[ "sia_era" ];   //-
        $style       = $_POST[ "sia_style" ]; //-
        $genre       = $_POST[ "sia_genre" ]; //-
        
        $uploaded_by = ""; //- will be used for artwork management
        
        
        //$era         = ""; //-
        //$style       = ""; //-
        //$genre       = ""; //-
        //$filesize    = ""; //+
        

        if(    $name == "" && $artist == "" && $filesize == ""  )
            die( "No images found.||=||" );
        else
        {
            $query = preg_replace( "/[^a-zA-Z0-9 ]/", "", $query );
            $query = preg_replace( "/ /", "&nbsp;", $query );
        }
        
        $results_per_page = 25;
        $results_counter  = 0;
                
        $oSearchForImage_adv  = new SearchForImage( "dummy_query_as_there_are_no_overloaded_constructors_in_php" );
        $oSearchForImage_adv->SearchForImage_adv( $name, $artist, $era, $style, $genre, $filesize, $uploaded_by );
        $status           = $oSearchForImage_adv->result_adv();
        
        $thumb_long_side  = $oSearchForImage_adv->glob[23];
        $big_long_side    = $oSearchForImage_adv->glob[32];
        $img_sep          = $oSearchForImage_adv->glob[5];
        $pg_sep           = $oSearchForImage_adv->glob[10];
        
        $image_search_result = "";
        $img_id              = array();
        $width               = array();
        $height              = array();
        $img_info            = array();
        
        while( $row = @mysql_fetch_array( $status ) )
        {
            $results_counter++;
            
            $img_id[ $results_counter ]    = $row[ "extern_fn" ];
            
            $width[ $results_counter ]     = $row[ "width" ];
            $height[ $results_counter ]    = $row[ "height" ];
            
            if( $name != "" )
            {
                //$tmp_name  =
                $row[ "name" ] = preg_replace( "/$name/i", "<span class=&qt;query_highlight&qt;>$name</span>", $row[ "name" ] );
                //$row[ "name" ] = $tmp_name;
            }
            if( $artist != "" )
            {
                //$tmp_artist  =
                $row[ "artist" ] = preg_replace( "/$artist/i", "<span class=&qt;query_highlight&qt;>$artist</span>", $row[ "artist" ] );
                //$row[ "artist" ] = $tmp_artist;
            }
            
            $img_info[ $results_counter ]  = $row[ "name" ]        . "_iis_";
            $img_info[ $results_counter ] .= $row[ "artist" ]      . "_iis_";
            $img_info[ $results_counter ] .= $row[ "era" ]         . "_iis_";
            $img_info[ $results_counter ] .= $row[ "style" ]       . "_iis_";
            $img_info[ $results_counter ] .= $row[ "genre" ]       . "_iis_";
            $img_info[ $results_counter ] .= $row[ "filesize" ]    . "_iis_";
            $img_info[ $results_counter ] .= $row[ "uploaded_by" ] . "_iis_";            
        }
        
        for( $i = 1; $i < count( $img_id );  $i++ )
        {
            
            $ratio         = aspect_ratio( $width[ $i ], $height[ $i ] );
            
            $new_w_h_thumb = new_w_h( $ratio, $thumb_long_side );
            $new_w_h_big   = new_w_h( $ratio, $big_long_side );


            $image_search_result .= "<div onclick=\"view_big_image_adv( '$img_id[$i]',
                                                                    '$new_w_h_big[0]',
                                                                    '$new_w_h_big[1]',
                                                                    '$img_info[$i]',
                                                                    '$i'             );\">";

            $image_search_result .= "<img src=\"./include/imgqueue/".
                                    "display_image.php?img_id=$img_id[$i]\"".
                                    " width=$new_w_h_thumb[0] height=$new_w_h_thumb[1] >";

            if( $i % 25 == 0 )
                $image_search_result .= "</div>$img_sep$pg_sep";
            else
                $image_search_result .= "</div>$img_sep";            
        }
    
        
        if( $image_search_result != "" )
            print  "Success||=||" . $image_search_result;
        else
            print "No images found.||=||";
?>