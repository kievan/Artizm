<?php
		error_reporting(E_ERROR); 
		
        session_start();
        
        require_once( "globals.php" );
        
        $glob = $GLOBALS[ "artizm_globals" ];
    
        // Password hashing.
        function double_salt( $to_hash, $username )
        {
            $password = str_split( $to_hash, ( (int)strlen ( $to_hash ) / 2 ) + 1 );
            $data = $username.$password[ 1 ] . $glob[ 14 ] . $password[ 0 ];
            
            return hash( "whirlpool", $data );
        }
        
        // Image hashing.
        function double_salt2( $to_hash, $artist )
        {
            $password = str_split( $to_hash, ( (int)strlen ( $to_hash ) / 2 ) + 1 );
            $data = $artist.$password[ 0 ] . $glob[ 17 ] . $password[ 1 ].rand( 0, 1000000 );
            
            return hash( "md4", $data );
        }
        
        // Thumbnail hashing.
        function double_salt3( $to_hash, $artist )
        {
            $password = str_split( $to_hash, (int)( strlen ( $to_hash ) / 2 ) + 1 );
            $data = $artist.$password[ 0 ] . $glob[ 17 ] . $password[ 1 ].rand( 0, 55555 );
            
            return hash( "md4", $data );
        }  
?>