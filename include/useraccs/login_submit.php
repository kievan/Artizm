<?php
        session_start();
        
        require_once( "login.php" );
        require_once( "../shared/php/globals.php" );

        $u = $_POST[ "l_username" ];
        $p = $_POST[ "l_password" ];
        
        $oLogin = new Login( $u, $p );
        $status = $oLogin->do_login();
        
        if( $status == true )
        {
           print "Welcome $u!";
           $_SESSION[ "username" ] = $u;
        }
        else
           print "Please try again.";
?>