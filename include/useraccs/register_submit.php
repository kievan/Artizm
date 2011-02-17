<?php
        session_start();
    
        require_once( "../shared/php/globals.php" );
        require_once( "../shared/php/encrypt.php" );
        require_once( "register.php" );
            
        register_main();
        
         
        function register_main()
        {
            $glob = $GLOBALS[ "artizm_globals" ];
    
            $oRegister = new Register(
                                       $_POST[ "r_username" ],
                                       $_POST[ "r_desired_password" ],
                                       $_POST[ "r_verify_password" ],
                                       $_POST[ "r_email" ]
                                     );
    
            $db_conn = new ArtizmDB( "mysql" );
            $db_conn->db_open( $glob[1], $glob[2], $glob[3], $glob[4] );
            $submit = $oRegister->submit();
    
            if ( $submit == true && $_POST[ "r_user_agreement" ] == 1 )
            {
                $u        = $oRegister->get_username();
                $p        = $oRegister->get_desired_password();
                $p_hashed = double_salt( $p, $u ); 
                $e        = $oRegister->get_email();
                
                //Add user to ArtizmDB
                $result = $db_conn->db_query( $glob[8] . " (\"" . $u ."\",\"". $p_hashed ."\",\"" . $e ."\")" );
                
                print $oRegister->response . "You are now registered! Please check your email.";
                $db_conn->db_close();
            }
            else
            {
                print $oRegister->response . "Please correct highlighted fields." . $glob[5];
            }        
        }
?>