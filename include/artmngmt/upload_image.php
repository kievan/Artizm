<?php
        session_start();
        
        require_once( "../shared/php/db_abstraction.php" );
        require_once( "../shared/php/globals.php" );
        require_once( "../shared/php/rfc822.php" );
        
        /*
         * UploadImage class definition.
         */
        class UploadImage
        {
            public  $response          = ""; // server response
            private $glob              = ""; // global values
            
            // User input.
            private $era;
            private $name;
            private $style;
            private $genre;
            private $artist;
            
            // Internal variables.
            private $filesize;
            private $username;
            
            function UploadImage( $era, $name, $style, $genre, $artist, $filesize, $username )
            {
                $this->set_era   ( $era    );
                $this->set_name  ( $name   );
                $this->set_style ( $style  );
                $this->set_genre ( $genre  );
                $this->set_artist( $artist );
                
                $this->set_filesize( $filesize );
                $this->set_username( $username );
    
                $this->glob = $GLOBALS[ "artizm_globals" ];
            }
            /*
             * Sets
             */
            function set_era( $era )
            {
                $this->era = $era;
            }
            
            function set_name( $name  )
            {
                $this->name = $name;
            }
            
            function set_style( $style  )
            {
                $this->style = $style;
            }
            
            function set_genre( $genre  )
            {
                $this->genre = $genre;
            }
            
            function set_artist( $artist )
            {
                $this->artist = $artist;
            }
                
            function set_filesize( $filesize )
            {
                $this->filesize = $filesize;
            }
            
            function set_username( $username )
            {
                $this->username = $username;
            }        
     
            /*
             * Gets
             */
            function get_era()
            {
                return $this->era;
            }
            
            function get_name()
            {
                return $this->name;
            }
            
            function get_style()
            {
                return $this->style;
            }
            
            function get_genre()
            {
                return $this->genre;
            }
            
            function get_artist()
            {
                return $this->artist;
            }
                
            function get_filesize()
            {
                return $this->filesize;
            }
            
            function get_username( $username )
            {
                return $this->username;
            }  
            
            function upload_submit()
            {
                $submit_status = false;
                
                
                
                $name_status     = $this->check_name  ( $this->cleansor( $this->name ) );
                $artist_status   = $this->check_artist( $this->cleansor( $this->artist ) );
    
                $era_status      = 1; //$this->check_era  ( $this->cleansor( $this->era ) );
                $style_status    = 1; //$this->check_style( $this->cleansor( $this->style ) );
                $genre_status    = 1; //$this->check_genre( $this->cleansor( $this->genre ) );
                
                $filesize_status = $this->check_filesize( $this->filesize ); 
                
                if(  $name_status     == true &&
                     $artist_status   == true &&
                     $era_status      == true &&
                     $style_status    == true &&
                     $genre_status    == true &&
                     $filesize_status == true
                  )
                {
                    $submit_status = true;
                }
                else
                {
                    $submit_status = false;
                }
                
                
                $this->era = $this->spacifier    ( $this->era );
                $this->name = $this->spacifier   ( $this->name );
                $this->style = $this->spacifier  ( $this->style );
                $this->genre = $this->spacifier  ( $this->genre );
                $this->artist = $this->spacifier ( $this->artist );
                
                return $submit_status;
            }
            
            
            function check_name()
            {
                $status = false;
    
                $char_quantity = strlen( $this->name );
                
                if( $char_quantity <= 512 ||
                    !preg_match( "/[^a-zA-Z0-9_]/", $this->name ) )
                    $status = true;
                else
                    $status = false;
                    
                return $status;
            }
            
            
            function check_artist()
            {
                $status = false;
    
                $char_quantity = strlen( $this->artist );
                
                if( $char_quantity <= 108 ||
                    !preg_match( "/[^a-zA-Z0-9_]/", $this->artist ) )
                    $status = true;
                else
                    $status = false;
                    
                return $status;
            }
            
            function check_era()
            {
                $status = false;
    
                $char_quantity = strlen( $this->era );
                
                if( $char_quantity >= 3                           ||
                    preg_match( "/[^a-zA-Z0-9\-]/", $this->era )  ||
                    $this->era != "<15th Century"                 ||
                    $this->era != "15th-19th Century"             ||
                    $this->era != "20th+ Century"
                  )
                    $status = false;
                else
                    $status = true;
                    
                return $status;
            }
            
            function check_style()
            {
                $status = false;
    
                $char_quantity = strlen( $this->style );
            
                if( $char_quantity <= 45 ||
                    preg_match( "/[^a-zA-Z0-9\_]/", $this->era ) ||
                    $this->style != "None"                       ||
                    $this->style != "Drawing"                    ||
                    $this->style != "Painting"                   ||
                    $this->style != "Photography"
                  )
                    $status = false;
                else
                    $status = true;
                    
                return $status;
            }
            
            function check_genre()
            {
                $status = false;
    
                $char_quantity = strlen( $this->style );
            
                if( $char_quantity <= 3 ||
                    preg_match( "/[^a-zA-Z0-9\-]/", $this->era )  ||
                    $this->style != "None"                        ||
                    $this->style != "Abstract"                    ||
                    $this->style != "Cubism"                      ||
                    $this->style != "Expressionism"               ||
                    $this->style != "Fauvism"                     ||
                    $this->style != "Impressionism"               ||
                    $this->style != "Realism"                     ||
                    $this->style != "Surrealism"                  ||
                    $this->style != "Pointillism"                 ||
                    $this->style != "Postimpressionism"           ||
                    $this->style != "Primitivism"                             
                  )
                    $status = false;
                else
                    $status = true;
                    
                return $status;
            }
            
            function check_filesize()
            {
                $status = false;
                
                if( $this->filesize > 5000000 )
                    $status = false;
                else
                    $status = true;
                    
                return $status;
            }
            
            function cleansor( $to_clean )
            {
                return preg_replace( "/[^a-zA-Z0-9_ ]/", "", $to_clean );
            }
            function spacifier( $to_spacify )
            {
                return preg_replace( "/ /", "&nbsp;", $to_spacify );
            }
            
        }
?>