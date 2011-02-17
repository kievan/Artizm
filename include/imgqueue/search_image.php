<?php
        session_start();
        
        require_once( "../shared/php/globals.php" );
        require_once( "../shared/php/db_abstraction.php" );
        
    
        class SearchForImage
        {
            public $glob    = "";
            private $query  = ""; 
            private $result = "";
            
            private $name        = "";
            private $era         = "";
            private $style       = "";
            private $genre       = "";
            private $artist      = "";
            private $filesize    = "";
            private $uploaded_by = "";
            
            private $field       = "";
            private $order       = "";
            
            
            function SearchForImage( $query )
            {
                $this->query = $query;
                $this->glob  = $GLOBALS[ "artizm_globals" ];  
            }
            
            function SearchForImage_adv( $name, $artist, $era, $style, $genre, $filesize, $uploaded_by )
            {
                $this->name        = $name;
                $this->artist      = $artist;
                $this->era         = $era;
                $this->style       = $style;
                $this->genre       = $genre;
                $this->filesize    = $filesize;
                $this->uploaded_by = $uploaded_by;
                $this->glob        = $GLOBALS[ "artizm_globals" ];                
            }
            
            function SearchForImage_browse( $field, $order )
            {
                $this->field = $field;
                $this->order = $order;
            }
            
            function result()
            {
                $oResult      = new ArtizmDB( "mysql" );
                $conn         = $oResult->db_open( $this->glob[1], $this->glob[2], $this->glob[3], $this->glob[4] );
                $this->result = $oResult->db_query( $this->glob[7] . " where name like     '%" . $this->query . "%'" 
                                                                   . " or era like         '%" . $this->query . "%'"
                                                                   . " or style like       '%" . $this->query . "%'"
                                                                   . " or genre like       '%" . $this->query . "%'"
                                                                   . " or artist like      '%" . $this->query . "%'"
                                                                   . " or filesize like    '%" . $this->query . "%'"
                                                                   . " or uploaded_by like '%" . $this->query . "%'"
                                                                   
                                                              );
                return $this->result;
            }
            
            function result_adv()
            {
                $oResult      = new ArtizmDB( "mysql" );
                $conn         = $oResult->db_open( $this->glob[1], $this->glob[2], $this->glob[3], $this->glob[4] );
                $local_query  = "";
                $query_arr    = array();
                

                for( $i=0; $i<7; $i++ )
                {
                    $query[$i] = "empty";
                }
                    
                if( preg_replace( "/[^a-zA-Z0-9 ]/", "", $this->name ) != "" )
                    $query[0] = " 1 and name like        '%" . $this->name        . "%'";
                else
                    $query[0] = " 1 ";

                if( preg_replace( "/[^a-zA-Z0-9 ]/", "", $this->artist ) != "" )                    
                    $query[1] = " 1 and artist like      '%" . $this->artist      . "%'";                    
                else
                    $query[1] = " 1 ";
                
                if( preg_replace( "/[^a-zA-Z0-9 ]/", "", $this->era ) != "" )
                {
                    if( $this->era == "Do not select" )
                        $query[2] = " 1 ";
                    else
                        $query[2] = " 1 and era like         '%" . $this->era         . "%'";
                }
                
                if( preg_replace( "/[^a-zA-Z0-9 ]/", "", $this->style ) != "" )
                {
                    if( $this->style == "Do not select" )
                        $query[3] = " 1 ";
                    else
                        $query[3] = " 1 and style like       '%" . $this->style       . "%'";
                }                
                 
                
                if( preg_replace( "/[^a-zA-Z0-9 ]/", "", $this->genre ) != "" )                    
                {
                    if( $this->genre == "Do not select" )
                        $query[4] = " 1 ";
                    else
                        $query[4] = " 1 and style like       '%" . $this->genre       . "%'";
                }
                
                if( preg_replace( "/[^a-zA-Z0-9 ]/", "", $this->filesize ) != "" )
                {
                    if( $this->filesize == "Do not select" )
                        $query[5] = " 1 ";
                    
                    else if( $this->filesize == "Smaller than 128 KB" )
                        $query[5] = " 1 and filesize < 131072";
                    
                    else if( $this->filesize == "128 to 256 KB" )
                        $query[5] = " 1 and filesize > 131072 and filesize < 262144";
                    
                    else if( $this->filesize == "256 to 512 KB" )
                        $query[5] = " 1 and filesize > 262144 and filesize < 524288";
                    
                    else if( $this->filesize == "512 to 1024 KB" )
                        $query[5] = " 1 and filesize > 524288 and filesize < 1000000";
                    
                    else if( $this->filesize == "1 to 5 MB" )
                        $query[5] = " 1 and filesize > 1000000 and filesize < 5242880";                        
                }
                
                if( preg_replace( "/[^a-zA-Z0-9 ]/", "", $this->uploaded_by ) != "" )                    
                    $query[6] = " 1 and uploaded_by like '%" . $this->uploaded_by . "%'";
                else
                    $query[6] = " 1 ";


                $local_query .= " where";
                for( $i=0; $i<7; $i++ )
                {
                    if( $query[ $i ] != "empty" )
                    {
                        $local_query .= $query[ $i ] . " and ";
                    }
                }
                $local_query .= " 1";
                
                $local_query = $this->glob[7] . " " . $local_query;
                
                $this->result = $oResult->db_query( $local_query  );
                return $this->result;
            }             
            
            function result_browse()
            {
                $oResult      = new ArtizmDB( "mysql" );
                $conn         = $oResult->db_open( $this->glob[1], $this->glob[2], $this->glob[3], $this->glob[4] );
                $local_query  = $this->glob[7] . " order by " . $this->field . " " . $this->order;
                $this->result = $oResult->db_query( $local_query );
                return $this->result;                
            }
        }        
        
?>