<?php
        session_start();
        
        require_once( "user_search.php" );

        $u = $_POST[ "us_query" ];
  
        if( !isset($u)) $u = "empty";
        
        $oSearchForUser = new SearchForUser( $u );
        $status = $oSearchForUser->result();
        
        if( $status == "" ) 
           print "No users found.||";
        else
        {
            print "Success|=|";
            while( $row = mysql_fetch_array( $status ) )
                print $row[ "username" ] . "|=|";
        }
?>