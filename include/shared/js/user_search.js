  //User search serialized string.
  var us_ser_str = "empty";

  $(document).ready
   (
        function()
        {
            function show_values()
            {
                us_ser_str = $("#us_form").serialize();
            }
            
            function us_submit_status()
            {
                custom_xhr_call( "./include/useraccs/user_search_submit.php", "user_search_submit", us_ser_str );
            }
            
            /* 
             * Register callback bindings
             * I bind the id of the text fields with the functions
             * that perform xmlHttpRequrest(xhr). These textfields
             * perform an xhr call upon execution of a certain event
             * (i.e. onclick, onkeyup, etc.).
             */
            get_ref( "us_submit" ).onclick = us_submit_status;            
            get_ref( "us_query" ).onkeyup = show_values;

            ///*
            // * This prevents the values from previous
            // * submissions to be included in the xhr call(s).
            // */ 
            //show_values();
            
            get_ref("us_submit_status_close").onclick = function(){ get_ref("us_submit_status").style.display = "none"; };
            get_ref("us_user_page_close").onclick = function(){ get_ref("us_user_page").style.display = "none"; };
            
            window.onresize =
            function()
            {
                var win_width   = window.innerWidth;
                var win_height  = window.innerHeight;
                
                var us_box_w = 450;
                var us_box_h = 450;
                var u_box_w = 500;
                var u_box_h = 500;                
            
                get_ref( "us_submit_status" ).style.left    = ( win_width  - us_box_w ) / 2;
                get_ref( "us_submit_status" ).style.top     = ( win_height - us_box_h ) / 2;
                
                get_ref( "us_user_page" ).style.left    = ( win_width  - u_box_w ) / 2;
                get_ref( "us_user_page" ).style.top     = ( win_height - u_box_h ) / 2;
            }
            
            /*
             * Hide the status box, and user page.
             */
            //get_ref("us_submit_status").style.display = "none";
            //get_ref("us_user_page").style.display = "none";

        
            /*
             * This prevents the values from previous
             * submissions to be included in the xhr call(s).
             */ 
            show_values();
        }       
        
   );
   
function user_search_submit( submit_status )
{
    var us_statui = new Array();
    us_statui = submit_status.split( "|=|" );
   
    if( us_statui[0] == "Success" )
    {
        var win_width   = window.innerWidth;
        var win_height  = window.innerHeight;
        
        var thumb_box_w = 450;
        var thumb_box_h = 450;
    
        get_ref( "us_submit_status" ).style.left    = ( win_width  - thumb_box_w ) / 2;
        get_ref( "us_submit_status" ).style.top     = ( win_height - thumb_box_h ) / 2;        
        get_ref( "us_submit_status" ).style.display = "block";
        
        get_ref( "us_submit_status_inner" ).innerHTML = "";
                //us_submit_status_inner
        
        for( var i = 1; i < us_statui.length; i++ )
            get_ref( "us_submit_status_inner" ).innerHTML += "<span id='"+i+"' onclick='show_user_page(\""+us_statui[i]+"\")'>"+us_statui[i]+"</span><br>";
    }
    else
    {
        get_ref( "us_submit_status" ).innerHTML = "No users found.";
        get_ref( "us_submit_status" ).style.display = "block";
        
    }
    
    return false;
}

function show_user_page( username )
{
        var win_width   = window.innerWidth;
        var win_height  = window.innerHeight;
        
        var thumb_box_w = 500;
        var thumb_box_h = 500;
    
        get_ref( "us_user_page" ).style.left    = ( win_width  - thumb_box_w ) / 2;
        get_ref( "us_user_page" ).style.top     = ( win_height - thumb_box_h ) / 2;        
        
        get_ref( "us_user_page_inner" ).innerHTML     = "<div style='position:absolute; top: 230px;'>Future page of <b> "+username+".</b></div>";
        
        get_ref( "us_user_page" ).style.display = "block";
        
        
    
}