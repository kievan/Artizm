<?php
    
    $SERVER_NAME = $_SERVER["SERVER_NAME"];
    $IP          = gethostbyname($SERVER_NAME);
    $server      = gethostbyaddr($IP);

    $glob = array
     (
        /*
         * Absolute URLs - Cascading Style Sheets.
         */
        
        /* 
         * Absolute URLs - JavaScript.
         */
        "jquery_js"         => "http://$IP/SacMenu3/shared/jquery/jquery-1.2.3.js",

    
        
        /*
         * Absolute paths to PHP files.
         */
        //"login_php"         => "http://$IP/SacMenu3/shared/php/login.php",
       
                                          
        /*
         * MySQL connection settings.
         */
        1    => "localhost",           // server
        2    => "artizmAdmin",    // username
        3    => "hard24get",      // password
        4    => "artizmdb",   // database
        
        5    => "|=|", // image separator
        10   => "__pg_separ__",
        /*
         * MySQL queries 
         */
        6    => "SELECT * FROM user",
        7    => "SELECT * FROM image",
        8    => "INSERT INTO user (username, password, email) VALUES",
        16   => "INSERT INTO image (era,name,extern_fn,filename,masiatko,mime_type,width,height,style,genre,uploaded_by,artist,filesize) VALUES",
        9    => "not used anywhere",
        14   => "{very.long,and_funny)salt*value&for-the=attackers+to]have[fun|with}",
        17   => "{v3^%.lo!!g,&_fu%ny)salt*..:\"\"'valu3&for-th3=aTtackers+to]hav3[fun|with}",
        
        /*
         * Thumbnail longer side.
         */
        23   => 75,
        32   => 500,
        
        /* Username */
        35   => "Guest",
    );
    
    $GLOBALS[ "artizm_globals" ] = $glob;
        
   //function get_glob()
   //{
   //   return $GLOBALS[ "artizm_globals" ];
   //}

?>