<?php
        session_start();
        
        require_once( "../shared/php/globals.php" );
        require_once( "../shared/php/db_abstraction.php" );
        require_once( "../shared/php/thumbnail_generator.php" );

        $img_id = $_REQUEST[ "img_id" ];
        if( !isset( $img_id ) )
            $img_id = "4dcb882573d4e2cbd82f8f2485c2d96e";
            
            
        $glob        = $GLOBALS[ "artizm_globals" ];
        $query       = "select * from image where extern_fn = '$img_id'";
          
        $oResult     = new ArtizmDB( "mysql" );
        $conn        = $oResult->db_open( $glob[1], $glob[2], $glob[3], $glob[4] );
        $result      = $oResult->db_query( $query );
        
        $row         = mysql_fetch_array( $result ); 
        $img_id_real = $row[ "filename" ];
        $masiatko    = $row[ "masiatko" ];

        
        $file1     = "../../../mystectvo_encoded/$img_id_real";
        $handle1   = fopen( $file1, "r" );
        $image     = fread( $handle1, filesize( $file1 ) );
        
        $file2     = "../../../masiatka/$masiatko";
        
        if( $fe = file_exists( $file2 ) )
        {
            $handle2   = fopen( $file2, "r" );
            $image_tn = fread( $handle2, filesize( $file2 ) ); // Image thumbnail.
        }
                
        if( $fe && !isset( $_GET[ "full" ] ) )
        {
            header( "Content-type: image" );
            print $image_tn;
        }
        else //if ( $_GET[ "full" ] == 1 )
        {
            header( "Content-type: image" );
            print $image;
        }
?>