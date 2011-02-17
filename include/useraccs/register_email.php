<?php
        session_start();
    
        require_once ( "register.php" );   
    
            $r_email = $_POST[ "r_email" ];
            
            $oRegister = new Register( "dummy_username",
                                       "dummy_desired_password",
                                       "dummy_verify_password",
                                       $r_email );
            $oRegister->check_email();
            
            print $oRegister->response;
?>