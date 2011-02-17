<?php
        @session_start();
        
        //require_once( "../shared/php/db_abstraction.php" );
        require_once( "globals.php" );    
    
        class ArtizmDB
        {
            private $conn;      // connection id
            private $result;    // query result
            private $db_platf;  // DB platform
            
            function ArtizmDB( $db_platf )
            {
                $this->conn     = "Default connection id.";
                $this->result   = "Default database result.";
                $this->db_platf = $db_platf;
            }
            
            function db_exec( $server, $username, $password, $DB, $query_str, $db_platf )
            {
                $this->db_platf = $db_platf;
                $this->conn = $this->db_open( $server, $username, $password, $DB );
                $this->result = $this->db_query( $query_str );
                $this->db_close();
                
                //print $this->conn . "---" . $this->result;
                return $this->result;
            }
            
            function db_open( $server, $username, $password, $DB )
            {
                if( $this->db_platf == "mysql" )
                {
                    $this->conn = @mysql_connect( $server, $username, $password )
                            or die( "Unable to connect to server." );
                    
                    if ( $DB == "" )
                        return $this->conn;
                    else
                        @mysql_select_db( $DB, $this->conn );
                    
                    return $this->conn;
                }
                else if( $this->db_platf == "mssql" )
                {
                    $this->conn = @mssql_connect( $server, $username, $password )
                            or die( "Unable to connect to server." );
                    
                    if( $DB == "" )
                        return $this->conn;
                    else
                        @mssql_select_db( $DB, $conn );
                    
                    return $this->conn;
                }
            }
            
            function db_query( $query_str )
            {
                $conn = $this->conn;                        
                if( $this->db_platf == "mysql" )
                    $this->result = @mysql_query( $query_str, $this->conn );
                else if( $this->db_platf == "mssql" )
                    $this->result = @mssql_query( $query_str, $this->conn );
                
                return $this->result;
            }        
    
            //function db_fetch_array( $row, $db_platf )
            //{
            //    if( $db_platf == "mysql" )
            //        mysql_fetch_array( $row );
            //    else if( $db_platf == "mssql" )
            //        mssql_fetch_array( $row );
            //}
            
            function db_close()
            {
                if( $this->db_platf == "mysql" )
                    @mysql_close();//$this->conn); //
                else if( $this->db_platf == "mssql" )    
                    @mssql_close( $this->conn );
            }
        }

?>