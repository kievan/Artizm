
/*
 * artizmutils.js
 * 
 * A function that calls a server side script,
 * passes in the variables from html form,
 * and calls a function that will process server response.
 * 
 * PARAMS: server side script name, javascript function, client side data
 */
function custom_xhr_call( sss_name, js_func, cs_data )
{
    $.ajax
        (
            {
                type: "POST",
                url: sss_name,
                data: cs_data,
                success: function( server_data )
                {
                    select_func( server_data, js_func );
                },
                error: function()
                {
                    alert( "Server error." );
                }
            }
        );        
}

/*
 * Select a function that will process the server side data.
 */
function select_func( server_data, js_func )
{
    switch( js_func )
    {
        /*
         * begin - register function(s)
         */
        case "register_username":
            register_username( server_data );
            break;
        case "register_desired_password":
            register_desired_password( server_data );
            break;
        case "register_verify_password":
            register_verify_password( server_data );
            break;
        case "register_email":
            register_email( server_data );
            break;
        case "register_submit":
            register_submit( server_data );
            break;
        /*
         * end - register function(s)
         */
        
        
        /*
         * begin - login function(s)
         */
        case "login_submit":
            login_submit( server_data );
            break;
        /*
         * end - login function(s)
         */
        
        
        /*
         * begin - user search function(s)
         */
        case "user_search_submit":
            user_search_submit( server_data );
            break;        
        /*
         * end - user search function(s)
         */
        
        /*
         * begin - search image function(s)
         */
        case "search_image_submit":
            search_image_submit( server_data );
            break;
        
        case "search_image_adv_submit":
            search_image_adv_submit( server_data );
            break;
        
        case "browse_image_submit":
            browse_image_submit( server_data );
            break;        
        /*
         * end - search image function(s)
         */
        
        
        
        /*
         * begin - logout function(s)
         * - Does not work.
         * - No time to figure out.
         * - Related commented code in logout.php and logout.js
         */
        case "logout":
            logout( server_data );
            break;        
        /*
         * end - logout function(s)
         */         
        
        default:
            document.write( "Unrecognized call - func_select. " + js_func + " Server response:" + server_data );
            break;        
    }
}

/*
 * Get reference of an element in an html document.
 */
function get_ref( id )
{
     return document.getElementById( id );
} 


