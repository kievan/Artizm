<?php

    /*
     * This file is a utility of Artizm therefore will not have web presence,
     * therefore the session_start() is not needed.
     * This file is primarily used for bulk database population. 
     */
    require_once( "encrypt.php" );
    require_once( "globals.php" );
    require_once( "thumbnail_generator.php" );
    
    $glob            = $GLOBALS[ "artizm_globals" ];
    $thumb_long_side = $glob[23];
    
    $dir = $_REQUEST[ "dir" ];
    if( !isset( $dir ) )
        $dir = "C:/wamp/www/mystectvo/";
        
    //$op = array();
    //$op[0] = "\"cd \"C:/wamp/www/mystectvo_encoded\"\"";
    //$op[1] = "\"del *\"";
    //$op[2] = "\"cd \"C:/wamp/www/masiatka\"\"";
    //$op[3] = "\"del *\"";
    //for( $i = 0; $i<4; $i++ )
    //    passthru( $op[$i] );
        
    
    if( $diropen = opendir( $dir ) )
    {
        $id  = 0;
        $idd = 0; 
        while ( false !== ($file = readdir($diropen) ))
        {
            $name_len        = strlen( $file );
            
            //$file_for_ext    = $file;
            //$file_ext        = split( "\.", $file_for_ext );
            //$file_ext        = end( $file_ext );
            
            $filesize        = filesize( $dir.$file );
            
            $file_for_others = $file;
            $split_file_name = split( "-", $file_for_others );
            //$file_for_others = preg_replace( "/[^a-zA-Z0-9_]/", "", $file_for_others );

            
            $artist_name     = preg_replace( "/_/", "&nbsp;", $split_file_name[0] );
            $artwork_name    = preg_replace( "/[^a-zA-Z0-9_]/", "", $split_file_name[1] );
            $artwork_name    = preg_replace( "/_/", "&nbsp;", $artwork_name );
            
            //$artwork_name    = preg_replace( "/\./", "", $artist_name );
            
            $extern_fn       = double_salt2( $artist_name, $artwork_name );
            $filename        = double_salt2( $artwork_name, $artist_name );
            $masiatko        = double_salt3( $artwork_name, $artist_name );
            //$artwork_name_e  = split( "\.", $split_file_name[2] );
            
            $sfn_era         = split( "\.", $split_file_name[2] );
            $artwork_era     = $sfn_era[0] ? $sfn_era[0] : 0;
            $mime_type       = $sfn_era[1];
            
            $users           = array( "kievan", "dionm", "martinsm", "gillhamn" );
            $random_user     = $users[ rand(0,3) ];          
 

            
            if( preg_match( "/[^\.]/", $file ) || preg_match( "/[^\.\.]/", $file ))
            {
                $id++;
                $img_size = getimagesize( $dir.$file );
                
                $insert  = "$id--->"."INSERT INTO itechbri_artizmdb.image ( era, name, extern_fn, filename, ";
                $insert .= "width, height, masiatko, mime_type, ";
                $insert .= "style, genre, uploaded_by, artist, filesize ) VALUES( ";
                $insert .= "\"$artwork_era\", \"$artwork_name\", \"$extern_fn\", \"$filename\", ";
                $insert .= "\"$img_size[0]\", \"$img_size[1]\", \"$masiatko\", \"$mime_type\", ";
                $insert .= "\"\", \"\", \"$random_user\", \"$artist_name\", \"$filesize\" );" . "<br>";

                $insert_f  = "INSERT INTO itechbri_artizmdb.image ( era, name, extern_fn, filename, ";
                $insert_f .= "width, height, masiatko, mime_type, ";
                $insert_f .= "style, genre, uploaded_by, artist, filesize ) VALUES( ";
                $insert_f .= "\"$artwork_era\", \"$artwork_name\", \"$extern_fn\", \"$filename\", ";
                $insert_f .= "\"$img_size[0]\", \"$img_size[1]\", \"$masiatko\", \"$mime_type\", ";
                $insert_f .= "\"\", \"\", \"$random_user\", \"$artist_name\", \"$filesize\" );" . "\n";                
                
                $e = "\""."copy " . "\"C:\\wamp\\www\\mystectvo\\".$file."\""." " . "\""."C:\\wamp\\www\\mystectvo_encoded\\"."$filename"."\"". "\""; 
                //echo $e."<br>";
                passthru( $e );
                
                $ratio  = aspect_ratio( $img_size[ 0 ],$img_size[1] );
                $new_w_h = new_w_h( $ratio, $thumb_long_side );                                
                $ct = createthumb( "C:/wamp/www/mystectvo_encoded/".$filename, "c:/wamp/www/masiatka/".$masiatko, $new_w_h[ 0 ], $new_w_h[ 1 ], $mime_type, $img_size[0], $img_size[1] );
                if( $ct != "success") print "<b>$ct---$file---$filename---$masiatko</b><br>";
                
                /*
                 * Move images with invalid names (custom case).
                 * Quick fix; instead of spending
                 * time on renaming all images by hand.
                 */ 
                //if ( !preg_match( "/[0|1|2|3|1\&2|2\&3|]/", $artwork_era ) )
                //{
                //    $idd++;
                //    //print $idd."------>".$insert;
                //    $e = "\""."move " . "\"C:\\wamp\\www\\mystectvo\\".$file."\""." " . "\""."C:\\wamp\\www\\bad_names\\".$file ."\"". "\""; 
                //    echo $e."<br>";
                //    passthru( $e );                
                //}
                
                print $insert;
                write_2_file( "C:/wamp/www/image_insert.sql", $insert_f );
            }
    
        }
    }
    closedir($diropen);
    
    /*
     * Function that writes data to a file.
     * Contains some some error handling.
     */
    function write_2_file( $path, $data )
    {
        touch( $path );
        
        // File exists and is writable?
        if (is_writable($path))
        {
            /*
             * w - Open for writing only; place the file pointer
             * at the beginning of the file and truncate the file to zero
             * length. If the file does not exist, attempt to create it.
             */ 
            if ( !$handle = @fopen( $path, "a" ) )
            {
                echo "Cannot open file ($path)";
                exit;
            }
            
            // Write to opened file.
            if ( @fwrite($handle, $data) < 0 )
            {
                echo "Cannot write to file ($path)";
                exit;
            }

            fclose($handle);
        }
        else
        {
            echo "The file $path is not writable";
        }
    }


    /*
     * This function iterates throught a given directory
     * and stores all file paths in an array, which it returns.
     */ 
    $file_names = array();
        
    function listFiles( $from = '.')
    {
        if(! is_dir($from))
            return false;
       
        global $file_names;
        $files = array();
        $dirs = array($from);
        
        while( NULL !== ($dir = array_pop( $dirs)))
        {
            if( $dh = opendir($dir))
            {
                while( false !== ($file = readdir($dh)))
                {
                    if( $file == '.' || $file == '..')
                        continue;
                    $path = $dir . '\\' . $file;
                    if( is_dir($path))
                        $dirs[] = $path;
                    else
                    {
                        $files[]      = $path;
                        $file_names[] = $file;
                    }
                }
                closedir($dh);
            }
        }
        return $files;
    }
    
    
    /*
     *  Here I walk through a given directory. Record all file paths.
     */
    //$file_list = listFiles( "C:\wamp\www\Atizm_IMAGES" );
    
    /*
     * Here I copy all the images from directory with subdirectories
     * into a single folder, for easy manipulation.
     */
    
    //for ( $i = 0; $i < sizeof( $file_list ); $i++ )
    //{
    //    //for( $j = 0; $j < sizeof( $file_names ); $j++
    //    $fn = preg_replace("/ /", "_", $file_names[ $i ] );
    //    preg_replace( "/'/", "", $fn );
    //    $e = "\""."copy " . "\"" .$file_list[ $i ]."\""." " . "\""."C:\\wamp\\www\\mystectvo\\".$fn ."\"". "\""; 
    //    echo $e."<br>";
    //    passthru( $e );
    //    
    //}

?>