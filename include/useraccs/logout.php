<?php
    
    session_start();

    class Logout
    {
        function Logout()
        {
            session_destroy();
        }
    }
    
    print "<html style='background-color: #F6F9F6'>";
    print "<h1 style='position: absolute; top: 35%; left: 41%; color: #585858'>".
          "Good bye " . $_SESSION[ "username" ] . "!";
    
    $oLogout = new Logout();
    
    print "<meta HTTP-EQUIV=\"REFRESH\" content=\"1; url=./../../index.php\">";
    print "</html>";
?>