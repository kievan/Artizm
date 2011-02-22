<?php
		error_reporting(E_ERROR); 
		//error_reporting(E_ALL);
        session_start();
        
        require_once( "../shared/php/db_abstraction.php" );
        require_once( "../shared/php/globals.php" );
        require_once( "../shared/php/rfc822.php" );
        
        /*
         * Register class definition.
         */
        class Register
        {
            public  $response          = ""; // server response
            private $glob              = ""; // global values
            
            private $username          = "";
            private $desired_password  = "";
            private $verify_password   = ""; 
            private $email             = "";
    
            
            function Register( $username, $desired_password, $verify_password, $email )
            {
                $this->set_username( $username );
                $this->set_desired_password( $desired_password );
                $this->set_verify_password( $verify_password );
                $this->set_email( $email );
                $this->glob = $GLOBALS[ "artizm_globals" ];
            }
            /*
             * Sets
             */
            function set_username( $username )
            {
                $this->username = $username;
            }
            function set_desired_password( $desired_password )
            {
                $this->desired_password = $desired_password;
            }
            function set_verify_password( $verify_password )
            {
                $this->verify_password = $verify_password;
            }
            function set_email( $email )
            {
                $this->email = $email;
            }
     
            /*
             * Gets
             */
            function get_username()
            {
                return $this->username;
            }
            function get_desired_password()
            {
                return $this->desired_password;
            }
            function get_verify_password()
            {
                return $this->verify_password;
            }
            function get_email()
            {
                return $this->email;
            }
            
            function submit()
            {
                $submit_status = false;
                
                $username_status         = $this->check_username( $this->username );
                $desired_password_status = $this->check_desired_password( $this->desired_password );
                $verify_password_status  = $this->check_verify_password( $this->verify_password );
                $email_status            = $this->check_email( $this->email );
                
                if ( $username_status         == true &&
                     $desired_password_status == true &&
                     $verify_password_status  == true &&
                     $email_status            == true )
                     {
                        $submit_status = true;
                     }
                else
                {
                    $submit_status = false;
                }
                
                return $submit_status;
            }
            
            function check_username()
            {
                $status = false;
                $field_type = "username";
    
                $char_quantity = strlen( $this->username );
                $field_content = $this->check_content( $this->username, $field_type );
    
    
                if( $char_quantity < 6 && $field_content == true )
                {
                    $this->response = "Username is too short." . $this->glob[5];
                    return ($status = false);
                }
                if( $char_quantity < 6 && $field_content == false )
                {
                    $this->response = "Not allowed and too short." . $this->glob[5];
                    return ($status = false);
                }                
                else if( $char_quantity > 25 && $field_content == true )
                {
                    $this->response = "Username is too long." . $this->glob[5];
                    return ($status = false);
                }
                else if( $char_quantity > 25 && $field_content == false )
                {
                    $this->response = "Not allowed and too long." . $this->glob[5];
                    return ($status = false);
                }                
                else if( $char_quantity >= 6 && $char_quantity <= 25 && $field_content == false )
                {
                    $this->response = "English alphanumeric characters and _(underscore) only." . $this->glob[5];
                    return ($status = false);
                }
                
                $found_flag = false;
                $oResult    = new ArtizmDB( "mysql" );
                $conn       = $oResult->db_open( $this->glob[1], $this->glob[2], $this->glob[3], $this->glob[4] );
                $result     = $oResult->db_query( $this->glob[6] );
                
                while ( $row = mysql_fetch_array( $result ) )
                {
                    if( $row[ "username" ] == $this->username )
                    {
                        $this->response = "This username is in use." . $this->glob[5];
                        $found_flag = true;
                        $status = false;
                    }
                }
                
                if( $found_flag == false )
                {
                    $this->response = "OK" . $this->glob[5];
                    $status = true;
                }
                
                $oResult->db_close();
                
                return $status;
            }
            
            function check_desired_password()
            {
                $status = false;
                $field_type = "desired_password";
                $char_quantity = strlen( $this->desired_password );
                $field_content = $this->check_content( $this->desired_password, $field_type );
                
                if( $field_content == true )
                {
                    $preg_match_alpha = preg_match( "/[^0-9_]/", $this->desired_password );
                    $preg_match_numer = preg_match( "/[^a-zA-Z]/", $this->desired_password );
                }
                
                if ( $char_quantity < 6 )
                {
                    $this->response .= "Password is too short." . $this->glob[5];
                    $status = false;
                }
                else if( $char_quantity >= 6 && $char_quantity <= 8 && $field_content == true )
                {
                    if( $preg_match_alpha == false || $preg_match_numer == false )
                        $this->response .= "Password is weak." . $this->glob[5];
                        
                    else if( $preg_match_alpha == true )
                        $this->response .= "Password is good." . $this->glob[5];
                        
                    $status = true;
                }
                else if( $char_quantity >= 8 && $char_quantity <= 25 && $field_content == true )
                {
                    if( $preg_match_alpha == false || $preg_match_numer == false )
                        $this->response .= "Password is weak..." . $this->glob[5];
                        
                    else if( $preg_match_alpha == true )
                        $this->response .= "Password is strong." . $this->glob[5];
                        
                    $status = true;
                }            
                else if( $char_quantity > 25 )
                {
                    $this->response .= "Password is too long." . $this->glob[5];
                    $status = false;
                }
                else if( $field_content == false )
                {
                    $this->response .= "Password can consist of english alphanumeric characters and _(underscore) only." . $this->glob[5];
                    $status = false;
                }
                
                return $status;
            }
            
            function check_verify_password()
            {
                $status = false;
                
                if( $this->desired_password != $this->verify_password )
                {
                    $this->response .= "Passwords do not match." . $this->glob[5];
                    $status = false;
                }
                else
                {
                    $this->response .= "OK" . $this->glob[5];
                    $status = true;
                }
                
                return $status;
            }
            
            function check_email()
            {
                $status = false;
                $field_type = "email";
                $field_content = $this->check_content( $this->email, $field_type );
                if( $field_content == false )
                {
                    $this->response .= "Invalid email." . $this->glob[5];
                    $status = false;
                }
                else
                {
                    $this->response .= "OK" . $this->glob[5];
                    $status = true;
                }
                
                return $status;
            }
            
            function check_content( $field, $field_type )
            {
                switch ($field_type)
                {
                    case "username":
                        return $this->is_valid_username( $field );
                    
                    case "desired_password":
                        return $this->is_valid_desired_password( $field );
                    
                    case "email":
                        return $this->is_valid_email( $field );
                    
                    default:
                        return false;
                }
            }
            
            function is_valid_username( $field )
            {
                $preg_match = preg_match( "/[^a-zA-Z0-9_]/", $field );
    
                if( $preg_match != true )
                    return true;
                else
                    return false;
            }
            
            function is_valid_desired_password( $field )
            {
                $preg_match = preg_match( "/[^a-zA-Z0-9_]/", $field );
    
                if( $preg_match != true )
                    return true;
                else
                    return false;          
            }
            
            function is_valid_email( $field )
            {
                // Refer to rfc822.php
                $status = is_valid_email_address( $field );
                
                if ( $status == true )
                    return true;
                else
                    return false;
            }
        }
?>