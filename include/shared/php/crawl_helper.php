<?php

    require( "db_abstraction.php" );
    
    //session_start();

    class CrawlHelper
    {
        private $glob = "";
        
        function CrawlHelper()
        {
            $this->glob        = $GLOBALS[ "artizm_globals" ]; 
        }
        
        function keywords()
        {
            $dbo    = new ArtizmDB("mysql");
            $conn   = $dbo->db_open( $this->glob[1], $this->glob[2], $this->glob[3], $this->glob[4] );
            $result = $dbo->db_query( "select distinct(artist) from image" );
            $conn   = $dbo->db_close();
            
            
            $new_result = array();
            for( $i = 0; $row = mysql_fetch_array( $result ); $i++ )
            {
                $new_result[ $i ] = preg_replace( "/&nbsp;/", " ", $row[0] );
            }
            
            for( $i = 0; $i < count( $new_result ); $i++ )
            {
                if( $i == count( $new_result ) - 1 )
                    print $new_result[ $i ];
                else
                    print $new_result[ $i ] . ", ";
            }
        }
    
        function description()
        {
            $desc  = "The Artizm web portal provides information about art ";
            $desc .= "that cannot be easily found on the internet. You will ";
            $desc .= "be able to learn about art in a number of ways, and ";
            $desc .= "will also be able to leave your contributions to the ";
            $desc .= "community (i.e. upload your art piece, leave a comment, ";
            $desc .= "specify museum(s) that have a certain painting, etc.)";
            
            print $desc;            
        }
    }

?>