<?php
        session_start();
        
        require_once( "../shared/php/encrypt.php" );
        require_once( "../shared/php/globals.php" );
        require_once( "../shared/php/db_abstraction.php" );
        
        class Login
        {
            //public  $response = "";
            private $glob     = ""; // global values
    
            private $username = "";
            private $password = "";
            
            function Login( $u, $p )
            {
               $this->username = $u;
               $this->password = $p;
               $this->glob     = $GLOBALS[ "artizm_globals" ];
            }
            
            function do_login()
            {
                $status = false;
                
                /*
                 * Quietly purge username and password of all "bad" characters.
                 * By bad I mean everything except alphanumerics and _(underscore).
                 */
                $this->check_content();
                
                /*
                 * Check if username corresponds to password.
                 */
                $status = $this->check_validity();
    
                return $status;
            }
            
            function check_content()
            {
                $preg_u = preg_replace( "/[^a-zA-Z0-9_]/", "", $this->username );
                $preg_p = preg_replace( "/[^a-zA-Z0-9_]/", "", $this->password );
                
                $this->username = $preg_u;
                $this->password = $preg_p;
            }
            
            function check_validity()
            {
                $status = false;
                $p = double_salt( $this->password, $this->username );
                
                $oResult    = new ArtizmDB( "mysql" );
                $conn       = $oResult->db_open( $this->glob[1], $this->glob[2], $this->glob[3], $this->glob[4] );
                $result     = $oResult->db_query( $this->glob[6] );
                
                while ( $row = @mysql_fetch_array( $result ) )
                {
                    if( $row[ "username" ] == $this->username && $row[ "password" ] == $p )
                        return ($status = true);
                    else
                        $status = false;
                }
                
                $oResult->db_close();            
                
                return $status;
            }
        }
?>