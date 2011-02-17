<?php
        session_start();
        require_once( "register.php" );
        
        $username = $_POST[ "r_username" ];
        
        $oRegister = new Register( $username, "dummy_desired_password", "dummy_verify_password", "dummy_email" );
        $oRegister->check_username();
        print $oRegister->response; 
?>