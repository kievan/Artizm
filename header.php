<?php
@session_start();
require_once( "./include/shared/php/globals.php" );

    $logout_call  = "<script type=\"text/javascript\" src=\"./include/shared/js/logout.js\"></script>";
	$mem_srch_lnk = "<a href=\"mem-search.php\">Members</a> |";
	$upload_lnk   = "<a href=\"img-upload.php\">Upload </a> |";
	// $user_status  = "<span style=\"font-weight: bold; color: #585858;\">".
				// "Welcome " . $_SESSION[ "username" ].
				// "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".
				// "<a href='./include/useraccs/logout.php'>Log out</a></span>";
	
        function print_header()
        {
            if( !isset( $_SESSION[ "username" ] ) )
            {
		print <<<HEADER
		<div id="Login">
		<form id="l_form" onSubmit="return false;" style="width: 380px; height: 20px; float:left; margin-left: 0px; margin-top:15px;">
		<span class="style7">&nbsp;&nbsp;Username:</span><span class="style8">Password:</span>
                <input type="text" name="l_username" id="l_username" tabindex=3/>
		<input type="password" name="l_password" id="l_password" tabindex=4 /></form>
		<input type="submit" name="l_submit" id="l_submit" value="Login" tabindex=5 />
		&nbsp;<a href="forgot-pass.php">Forgot Password?</a>&nbsp; <a href="reg-page.php">Not yet a member?</a>
		</div>
		
HEADER;
	    }
	    else
	    {
	    $mem_srch_lnk = "<a href=\"mem-search.php\">Members</a> |";
	    $upload_lnk   = "<a href=\"img-upload.php\">Upload </a> |";
	    $user_status  = $_SESSION[ "username" ];
	    $logout_call  = "<script type=\"text/javascript\" src=\"./include/shared/js/logout.js\"></script>";
	    
	    print <<<HEADER
		<div class="middle_window_text" align="center">
		<span style="color:#0099FF; font-weight:bolder;">WELCOME $user_status</span> | <a href="img-upload.php">UPLOAD ART</a> | <a href="#"> MANAGE ARTS</a> | <a href="include/useraccs/logout.php"> LOGOUT</a>
		</div>
HEADER;
	    }
	}
      
        /*
         * Go to home page(image search) if user is logged out and tries to
         * navigate to the Upload, Member Search, or to Delete Image page,
         * or a number of other utility files.
         */        
        
        function check_logged_out()
        {
            if( !isset( $_SESSION[ "username" ] ) )
                print "<html><meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=./index.php\"></html>";
            else
                print "";
        }
        
        /*
         * Go to home page(image search) if user is logged in and tries to
         * navigate to the Login, Register, or Forgot Password page.
         */ 
        
        function check_logged_in()
        {
            if( isset( $_SESSION[ "username" ] ) )
                print "<html><meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=./index.php\"></html>";
            else
                print "";
        }
?>