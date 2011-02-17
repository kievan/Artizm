  /*
   * Upload Image UI and Ajax file.
   */
  var u_ser_str = "empty";
  var debug_count = 0;

  $(document).ready
   (
        function()
        {
            function show_values()
            {
                r_ser_str = $("#iu_submit_form").serialize();
            }
            
            function iu_name_status()
            {
                r_ser_str = $("#iu_submit_form").serialize();
                custom_xhr_call( "./include/useraccs/register_desired_password.php", "register_desired_password", r_ser_str );
            }

            function iu_era_status()
            {
                r_ser_str = $("#iu_submit_form").serialize();
                custom_xhr_call( "./include/useraccs/register_username.php", "register_username", r_ser_str );
            }
            
            function iu_style_status()
            {
                r_ser_str = $("#iu_submit_form").serialize();
                custom_xhr_call( "./include/useraccs/register_verify_password.php", "register_verify_password", r_ser_str );
            }
            
            function iu_genre_status()
            {
                r_ser_str = $("#iu_submit_form").serialize();
                custom_xhr_call( "./include/useraccs/register_email.php", "register_email", r_ser_str );
            }            

            function iu_artist_status()
            {
                r_ser_str = $("#iu_submit_form").serialize();
                custom_xhr_call( "./include/useraccs/register_email.php", "register_email", r_ser_str );
            }

            function iu_upload_status()
            {
                custom_xhr_call( "./include/useraccs/register_submit.php", "register_submit", r_ser_str );
            }
            
            function iu_submit_status()
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

            
            //get_ref( "iu_upload_button" ).onclick = iu_upload_status;
            //get_ref( "iu_submit_button" ).onclick = iu_submit_status;
            
            //get_ref( "iu_era" ).onchange    = iu_era_status;
            //get_ref( "iu_name" ).onchange   = iu_name_status;
            //get_ref( "iu_style" ).onchange  = iu_style_status;
            //get_ref( "iu_genre" ).onchange  = iu_genre_status;
            //get_ref( "iu_artist" ).onchange = iu_artist_status;
            //$("#iu_user_agreement").change( show_values );
            
            /*
             * This prevents the values from previous
             * submissions to be included in the xhr call(s).
             */ 
            //show_values();
            
            
            /*
             * Hide the status box
             */
            get_ref("iu_submit_status").style.display = "none";
            //get_ref("r_submit_status_failure").style.display = "none";
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
    //document.write("-------");
    var register_statui = new Array();
    register_statui = submit_status.split( "|=|" );
    
    //document.write(register_statui[0]);

    $("#r_username_status").html( register_statui[0] );
    $("#r_desired_password_status").html( register_statui[1]  );
    $("#r_verify_password_status").html( register_statui[2]  );
    $("#r_email_status").html( register_statui[3]  );
    //document.write( (register_statui[4]).substr( 21, 1 ) );
    var reg = (register_statui[4]).substr( 21, 1 );
   
    if( reg == "d" )
    {
        //document.write( (register_statui[4]).substr( 0, 24 ) );
        
        get_ref("r_submit_status").style.display = "block";
        $("#r_submit_status").html(register_statui[4]);
        setTimeout( 'window.location = "./login-page.php"', 2000 );

        //document.write( "why" );
    }
    else
    {
        //document.write( register_statui[4] );
        //$("#r_submit_status_failure").html(register_statui[4]).addClass("r_submit_status_failure");
        //document.write( "why" );
        //window.location = "./login-page.php";
        
        get_ref("r_submit_status").style.display = "block";
        $("#r_submit_status").html(register_statui[4]);
    }
    
    return false;
}


function startUpload()
{
      get_ref('iu_upload_process').style.display = 'block';
      get_ref('iu_upload_form').style.display = 'none';
      
      //document.write( "-------------------" );
      
      return true;
}

function stopUpload(success)
{
      var result = '';
      if (success == 1)
      {
         result = '<span class="msg">The file was uploaded successfully!<\/span><br/><br/>';
      }
      else
      {
         result = '<span class="emsg">There was an error during file upload!<\/span><br/><br/>';
      }

      document.getElementById('iu_upload_process').style.visibility = 'hidden';
      document.getElementById('iu_upload_form').innerHTML = result + '<label>File: <input name="myfile" type="file" size="30" /><\/label><label><input type="submit" name="submitBtn" class="sbtn" value="Upload" /><\/label>';
      document.getElementById('iu_upload_form').style.visibility = 'visible';      

      return true;   
}