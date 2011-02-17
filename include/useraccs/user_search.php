<?php
        session_start();
        
        require_once( "../shared/php/globals.php" );
        require_once( "../shared/php/db_abstraction.php" );
        
    
        class SearchForUser
        {
            private $glob   = "";
            private $query  = ""; 
            private $result = "";
            
            function SearchForUser( $query )
            {
                $this->query = $query;
                $this->glob  = $GLOBALS[ "artizm_globals" ];  
            }
            
            function result()
            {
                $oResult      = new ArtizmDB( "mysql" );
                $conn         = $oResult->db_open( $this->glob[1], $this->glob[2], $this->glob[3], $this->glob[4] );
                $this->result = $oResult->db_query( $this->glob[6] . " where username like '%" . $this->query ."%'" );
                
                return $this->result;
            }
        }
?>