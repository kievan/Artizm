<?php
        session_start();
        require_once( "register.php" );
        
        $r_desired_password = $_POST[ "r_desired_password" ];
        $r_verify_password  = $_POST[ "r_verify_password" ];
        
        $oRegister = new Register( "dummy_username",
                                   $r_desired_password,
                                   $r_verify_password,
                                   "dummy_email" );
        $oRegister->check_verify_password();
        print $oRegister->response;    
?>