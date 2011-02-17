  /*
   * Register UI and Ajax file.
   */
  var r_ser_str = "empty";
  var debug_count = 0;

  $(document).ready
   (
        function()
        {
            function show_values()
            {
                r_ser_str = $("#r_form").serialize();
            }
            
            function r_username_status()
            {
                r_ser_str = $("#r_form").serialize();
                custom_xhr_call( "./include/useraccs/register_username.php", "register_username", r_ser_str );
            }
            
            function r_desired_password_status()
            {
                r_ser_str = $("#r_form").serialize();
                custom_xhr_call( "./include/useraccs/register_desired_password.php", "register_desired_password", r_ser_str );
            }
            
            function r_verify_password_status()
            {
                r_ser_str = $("#r_form").serialize();
                custom_xhr_call( "./include/useraccs/register_verify_password.php", "register_verify_password", r_ser_str );
            }
            
            function r_email_status()
            {
                r_ser_str = $("#r_form").serialize();
                custom_xhr_call( "./include/useraccs/register_email.php", "register_email", r_ser_str );
            }            
            
            function r_submit_status()
            {
                custom_xhr_call( "./include/useraccs/register_submit.php", "register_submit", r_ser_str );
            }
            
            /* 
             * Register callback bindings
             * I bind the id of the text fields with the functions
             * that perform xmlHttpRequrest(xhr). These textfields
             * perform an xhr call upon execution of a certain event
             * (i.e. onclick, onkeyup, etc.)
             */
            get_ref( "r_username" ).onkeyup = r_username_status;
            get_ref( "r_desired_password" ).onkeyup = r_desired_password_status;
            get_ref( "r_verify_password" ).onkeyup = r_verify_password_status;
            get_ref( "r_email" ).onkeyup = r_email_status;
            get_ref( "r_submit" ).onclick = r_submit_status;
            
            $("#r_user_agreement").change( show_values );

            window.onresize =
            function()
            {
                var win_width   = window.innerWidth;
                var status_box_w = 450;
                    
                get_ref( "r_submit_status" ).style.left = ( win_width  - status_box_w ) / 2;
            }
            
            /*
             * This prevents the values from previous
             * submissions to be included in the xhr call(s).
             */ 
            show_values();
                        
            /*
             * Hide the status box
             */
            get_ref("r_submit_status").style.display = "none";
        }
   );
   
function register_username( server_data )
{
    server_data = server_data.split("|=|");
    
    $("#r_username_status").html( server_data[0] );
    
    return false;
}
function register_desired_password( server_data )
{
    server_data = server_data.split("|=|");
    
    $("#r_desired_password_status").html( server_data[0] );
    
    return false;
}
function register_verify_password( server_data )
{
    server_data = server_data.split("|=|");
    
    $("#r_verify_password_status").html( server_data[0] );
    
    return false;
}
function register_email( server_data )
{
    server_data = server_data.split("|=|");
    
    $("#r_email_status").html( server_data[0] );
    
    return false;
}
function register_submit( submit_status )
{
    var register_statui = new Array();
    register_statui = submit_status.split( "|=|" );
    

    $("#r_username_status").html( register_statui[0] );
    $("#r_desired_password_status").html( register_statui[1]  );
    $("#r_verify_password_status").html( register_statui[2]  );
    $("#r_email_status").html( register_statui[3]  );
    var reg = (register_statui[4]).substr( 21, 1 );
   
    if( reg == "d" )
    {
        get_ref("r_submit_status").style.display = "block";
        $("#r_submit_status").html(register_statui[4]);
        setTimeout( 'window.location = "./index.php"', 2000 );
    }
    else
    {
        var win_width   = window.innerWidth;
        var status_box_w = 450;
            
        get_ref( "r_submit_status" ).style.left = ( win_width  - status_box_w ) / 2;
        
        get_ref("r_submit_status").style.display = "block";
        $("#r_submit_status").html(register_statui[4]);
    }
    
    return false;
}