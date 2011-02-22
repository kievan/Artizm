<?php
        error_reporting(E_ERROR);
        session_start();
        
        require_once( "upload_image.php" );
        require_once( "../shared/php/encrypt.php" );
        require_once( "../shared/php/globals.php" );
        require_once( "../shared/php/thumbnail_generator.php" );
        require_once( "../shared/php/db_abstraction.php" );


        $era            = $_POST[ "iu_era" ];
        $name           = $_POST[ "iu_name" ];
        $style          = $_POST[ "iu_style" ];
        $genre          = $_POST[ "iu_genre" ];
        $artist         = $_POST[ "iu_artist" ];
        $user_agreement = $_POST[ "iu_user_agreement" ];
        $username       = $_SESSION[ "username" ];

//        $era    = "20th+&nbsp;Century";
//        $name   = "C:\Users\Tioma\Desktop\random_bubbles_800x800_1.png";
//        $style  = "Drawing";
//        $genre  = "Abstract";
//        $artist = "Artyom";
//        $user_agreement = "1";
//        $username = "kievan";

        $target_path_image    = "../../../mystectvo_encoded/";
        $target_path_masiatko = "../../../masiatka/";
        
        //$__debug                 = $_FILES['iu_file']['name'];
        //$_FILES['iu_file']['name'];
        $external_image_name   = double_salt2( basename( $_FILES['iu_file']['name'] ), $name."external" );
        $encoded_image_name    = double_salt2( basename( $_FILES['iu_file']['name'] ), $name );
        $encoded_masiatko_name = double_salt3( basename( $_FILES['iu_file']['name'] ), $name );
        
        $target_path_image    = $target_path_image    . $encoded_image_name;
        $target_path_masiatko = $target_path_masiatko . $encoded_masiatko_name;
        //$filesize        = @filesize( $_FILES['iu_file']['name'] );
        
        $oUploadImage = new UploadImage( $era, $name, $style,
                                $genre, $artist, $filesize, $username );
               
            
        if( $oUploadImage->upload_submit() )
        {
            if( move_uploaded_file( $_FILES['iu_file']['tmp_name'], $target_path_image )
               && $user_agreement == 1  )
            {
               
                $glob            = $GLOBALS["artizm_globals"];
                $thumb_long_side = $glob[ 23 ];
                $img_size        = @getimagesize( $target_path_image );
                $filesize        = @filesize( $target_path_image );
                $mime_type       = @split( "/", $img_size[ "mime" ] );
                $mime_type       = $mime_type[ 1 ];
                
                $ratio           = aspect_ratio( $img_size[ 0 ], $img_size[ 1 ] );
                $new_w_h         = new_w_h( $ratio, $thumb_long_side );

                $ct = @createthumb( $target_path_image, $target_path_masiatko, $new_w_h[ 0 ], $new_w_h[ 1 ], $mime_type, $img_size[0], $img_size[1] );
                
                // Add image record to the database.
                $oResult      = new ArtizmDB( "mysql" );
                //$conn         = $oResult->db_open(  $glob[1], $glob[2], $glob[3], $glob[4] );
                $add_image    = " ('".$oUploadImage->get_era()."','".$oUploadImage->get_name()."','".$external_image_name."','".
                                $encoded_image_name."','".$encoded_masiatko_name."','".$mime_type."',".$img_size[0].",".$img_size[1].",'".
                                $oUploadImage->get_style()."','".$oUploadImage->get_genre()."','".$username."','".$oUploadImage->get_artist()."',".$filesize.")";
                                
                //$result  = $oResult->db_query( $glob[16] . $add_image );
                //print "QUERY: " . $glob[16] . $add_image;
                $result  = $oResult->db_exec( $glob[1], $glob[2], $glob[3], $glob[4], $glob[16] . $add_image, "mysql" );
                
                if( $result )
                {
                    print "<html style='background-color: #F6F9F6'>";
                    print "<h1 style='position: absolute; top: 35%; left: 41%; color: #585858'>".
                          "The file ".  basename( $_FILES['iu_file']['name'])." has been uploaded!<br>";
                    
                    print "<meta HTTP-EQUIV=\"REFRESH\" content=\"3; url=./../../img-upload.php\">";
                    print "</html>";                    
                    
                    
                    //print "The file ".  basename( $_FILES['iu_file']['name'])." has been uploaded!<br>";
                }
                else
                {
                    print "Database transaction unsuccessful.";                    
                }
                //print "<meta HTTP-EQUIV=\"REFRESH\" content=\"3; url=../../img-upload.php\">";
            }
            else
            {
                echo "There was an error uploading the file, please try again.";
                print "<meta HTTP-EQUIV=\"REFRESH\" content=\"3; url=../../img-upload.php\">";
            }
        }
        else
        {
            print "There is an error in your input.";
            print "<meta HTTP-EQUIV=\"REFRESH\" content=\"3; url=../../img-upload.php\">";
        }
        
?>