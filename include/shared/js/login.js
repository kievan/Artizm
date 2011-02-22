  // Login serialized string.
  var l_ser_str = "empty";

  $(document).ready
   (
        function()
        {
            function show_values()
            {
                l_ser_str = $("#l_form").serialize();
            }
            
            function l_result()
            {
                custom_xhr_call( "./include/useraccs/login_submit.php", "login_submit", l_ser_str );
            }
            
            /* 
             * Register callback bindings
             * I bind the id of the text fields with the functions
             * that perform xmlHttpRequrest(xhr). These textfields
             * perform an xhr call upon execution of a certain event
             * (i.e. onclick, onkeyup, etc.).
             */
            get_ref( "l_submit" ).onclick = l_result;
            get_ref( "l_username" ).onkeyup = show_values;
            get_ref( "l_password" ).onkeyup = show_values;
            
            window.onresize =
            function()
            {
                var win_width   = window.innerWidth;
                var status_box_w = 450;
                    
                get_ref( "l_submit_status" ).style.left = ( win_width  - status_box_w ) / 2;
            }            
            
            /*
             * Hide the status box.
             */
            get_ref("l_submit_status").style.display = "none";

            /*
             * This prevents the values from previous
             * submissions to be included in the xhr call(s).
             */ 
            show_values();
        }
   );
   
function login_submit( submit_status )
{
    
    var log = submit_status.substr( 1, 1 );
   
//    if( log == "e" )
//    {
//        setTimeout( 'window.location = "./index.php"', 20 );
//    }
//    else
//    {
        var win_width   = window.innerWidth;
        var status_box_w = 450;
            
        get_ref( "l_submit_status" ).style.left = ( win_width  - status_box_w ) / 2;
        
        get_ref( "l_submit_status" ).style.display = "block";
        $("#l_submit_status").html( submit_status );

        setTimeout( 'window.location = "./index.php"', 100 );
//    }
    
    return false;
}