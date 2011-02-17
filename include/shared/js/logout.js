  
    
    // Function to be called by an xmlHttpRequest.
    //function logout( server_data )
    //{
    //    var param = "window.location = './search-page.php'";
    //    var param1 = "document.write("+server_data+")";
    //    setTimeout( param1, 1000 );
    //    setTimeout( param, 1500 );
    //}
            
    window.onload =
            function()
            {
                // One way to logout. Doesn't work.
                //var param1 = "custom_xhr_call( 'include/useraccs/logout.php', 'logout', '' )";
                
                // Another way to log out.
                var param = "window.location = './include/useraccs/logout.php'";
                
                /*
                 * Execute a chosen way to logout.
                 * Log out after 888888/6000 = 14.8148 minutes.
                 */
                setTimeout( param, 888888 ); 
            };

