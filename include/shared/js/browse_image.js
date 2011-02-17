  /*
   * Image search ui file.
   */
  
  var bi_ser_str = "empty";
  var last_fld = 0;
  var cur_fld = 0;
  
  var last_ord = 0; 
  var cur_ord  = 0; 
  var pages      = new Array();
  var images     = new Array();
  var all_images = new Array();
  var page_index = 0;
  
  $(document).ready
   (
        function()
        {
            function show_values()
            {
                bi_ser_str = $("#bi_form").serialize();
            }
            
            function bi_submit_status()
            {
                //enable loader
                $("#loading").css( "display", "block" );
                $("#loading").css( "position", "relative" );
                $("#loading").css( "top", "-14px" );
                $("#loading").css( "left", "65px" );
                show_values();
                custom_xhr_call( "./include/imgqueue/browse_image_submit.php", "browse_image_submit", bi_ser_str );
                page_index = 0;
            }
            
            /* 
             * Register callback bindings
             * I bind the id of the text fields with the functions
             * that perform xmlHttpRequrest(xhr). These textfields
             * perform an xhr call upon execution of a certain event
             * (i.e. onclick, onkeyup, etc.).
             */
            get_ref( "bi_field"  ).onblur = show_values;
            get_ref( "bi_order"  ).onblur = show_values;
            get_ref( "bi_submit" ).onclick = bi_submit_status;
            
            $("#bi_artist").click( function ()
                                   {
                                     //remember selection
                                     cur_fld = 1;
                                     //highlight
                                     $("#bi_artist").css( "color", "000000" );
                                     //put value into hidden form
                                     //$("#bi_field").text( "artist" );
                                     get_ref("bi_field").value = "artist";
                                     //unhighlight
                                     unhighlight( last_fld, 1 );
                                   }
                                 );
            $("#bi_name").click( function ()
                                   {
                                     //remember selection
                                     cur_fld = 2;
                                     //highlight
                                     $("#bi_name").css( "color", "000000" );
                                     //put value into hidden form
                                     //$("#bi_field").text( "name" );
                                     get_ref("bi_field").value = "name";                                     
                                     //unhighlight
                                     unhighlight( last_fld, 1 );
                                   }
                                 );
            $("#bi_era").click( function ()
                                   {
                                     //remember selection
                                     cur_fld = 3;
                                     //highlight
                                     $("#bi_era").css( "color", "000000" );
                                     //put value into hidden form
                                     //$("#bi_field").text( "era" );
                                     get_ref("bi_field").value = "era";
                                     //unhighlight
                                     unhighlight( last_fld, 1 );
                                   }
                                 );
            $("#bi_genre").click( function ()
                                   {
                                     //remember selection
                                     cur_fld = 4;
                                     //highlight
                                     $("#bi_genre").css( "color", "000000" );
                                     //put value into hidden form
                                     //$("#bi_field").text( "genre" );
                                     get_ref("bi_field").value = "genre";                                     
                                     //unhighlight
                                     unhighlight( last_fld, 1 );
                                   }
                                 );
            $("#bi_size").click( function ()
                                   {
                                     //remember selection
                                     cur_fld = 5;
                                     //highlight
                                     $("#bi_size").css( "color", "000000" );
                                     //put value into hidden form
                                     //$("#bi_field").text( "size" );
                                     get_ref("bi_field").value = "size";                                     
                                     //unhighlight
                                     unhighlight( last_fld, 1 );
                                   }
                                 );
            $("#bi_style").click( function ()
                                   {
                                     //remember selection
                                     cur_fld = 6;
                                     //highlight
                                     $("#bi_style").css( "color", "000000" );
                                     //put value into hidden form
                                     //$("#bi_field").text( "style" );
                                     get_ref("bi_field").value = "style";                                     
                                     //unhighlight
                                     unhighlight( last_fld, 1 );
                                   }
                                 );
            
            $("#bi_asc").click( function ()
                                   {
                                     //remember selection
                                     cur_ord = 1;
                                     //highlight
                                     $("#bi_asc").css( "color", "000000" );
                                     //put value into hidden form
                                     //$("#bi_order").text( "asc" );
                                     get_ref("bi_order").value = "asc";                                     
                                     //unhighlight
                                     unhighlight( last_ord, 2 );
                                   }
                                 );
            $("#bi_desc").click( function ()
                                   {
                                     //remember selection
                                     cur_ord = 2;
                                     //highlight
                                     $("#bi_desc").css( "color", "000000" );
                                     //put value into hidden form
                                     //$("#bi_order").text( "desc" );
                                     get_ref("bi_order").value = "desc";                                     
                                     //unhighlight
                                     unhighlight( last_ord, 2 );
                                   }
                                 );
            
            
            
            function unhighlight( lf, fo )
            {
                if( fo == 1 )
                {
                    last_fld = cur_fld;
                    switch( lf )
                    {
                        case 1:
                            $("#bi_artist").css( "color", "ffffff" );
                            break;
                        case 2:
                            $("#bi_name").css( "color", "ffffff" );
                            break;                        
                        case 3:
                            $("#bi_era").css( "color", "ffffff" );
                            break;                        
                        case 4:
                            $("#bi_genre").css( "color", "ffffff" );
                            break;                        
                        case 5:
                            $("#bi_size").css( "color", "ffffff" );
                            break;                        
                        case 6:
                            $("#bi_style").css( "color", "ffffff" );
                            break;
                        
                        case 0:
                            break;
                    }
                }
                else
                {
                    last_ord = cur_ord;
                    switch( lf )
                    {
                        case 1:
                            $("#bi_asc").css( "color", "ffffff" );
                            break;                        
                        case 2:
                            $("#bi_desc").css( "color", "ffffff" );
                            break;
                        
                        case 0:
                            break;
                    }
                }
            }
            
            
            /*
             * This prevents the values from previous
             * submissions to be included in the xhr call(s).
             */ 
            show_values();
        }
   );
   
function browse_image_submit( submit_status )
{
    //disable loader
    $("#loading").css( "display", "none" );    
    
    var success = new Array();  
    var imgs    = new Array();
    var pgs     = new Array();
    
    var win_width  = window.innerWidth;
    var win_height = window.innerHeight;
    var srch_box_w = 655;
    var srch_box_h = 500;

    get_ref( "si_submit_status" ).style.left    = (win_width  - srch_box_w) / 2;
    get_ref( "si_submit_status" ).style.top     = (win_height - srch_box_h) / 2;
    
    get_ref( "shade" ).style.display = "block"; 
    $("#si_submit_status").fadeIn( 1000 );

    
    success = submit_status.split( "||=||" );
    pgs     = success[ 1 ].split( "__pg_separ__" );
    imgs    = pgs[ 0 ].split( "|=|" );
    
    // Populate global array for thumb navigation to work.
    pages            = pgs;
    
    get_ref( "page_out_of" ).innerHTML = 1+"/"+pages.length;
    
    if( success[0] == "Success" )
    {
        // Populate first page.
        for( var i = 0; i < imgs.length; i++ )
            get_ref( ("pic"+(i+1)) ).innerHTML = imgs[ i ];
            
        if( imgs.length < 25 )
        {
            for( var i = imgs.length; i < 26; i++ )
                $( "#pic" + i).html("");
        }
        
    }
    else
    {
        for( var i = 0; i < 25; i++ )
            get_ref( ("pic"+(i+1)) ).innerHTML = "";        
        $("#pic13").html( "<div style='position: absolute; top: 250px; left: 148px; font-size:32px; color: #ffffff; z-index: 1000;'>Nothing found.</div>" );
    }
    
    return false;
}

function view_big_image_browse( img_id, width, height, img_info, img_index )
{
    var img_src = "<img src=\"./include/imgqueue/display_image.php?img_id="
                  +img_id+"&full=1\" width="+width+" height="+height+"/>";
    
    var win_width  = window.innerWidth;
    var win_height = window.innerHeight;
    var img_box_w  = 611;
    var img_box_h  = 655;

    get_ref( "big_image" ).style.left    = (win_width  - img_box_w) / 2;
    get_ref( "big_image" ).style.top     = (win_height - img_box_h) / 2;
    
    get_ref( "shade_big_image" ).style.display   = "block";
    get_ref( "big_image_inner" ).innerHTML       = img_src;
    $( "#big_image" ).fadeIn( 500 );    
    
    var new_img_info = img_info.split( "_iis_" );
    var era = new_img_info[2].split("&");
    var era_trans = "";
    
    era_trans += era[0] == "1" ? "&lt;15th"  : "";
    era_trans += era[0] == "2" ? "15th-19th" : "";
    era_trans += era[0] == "3" ? "20th+"     : "";
    era_trans += era[1] == "2" ? "&nbsp;and&nbsp;15th-19th" : "";
    era_trans += era[1] == "3" ? "&nbsp;and&nbsp;20th+" : "";
    
    new_img_info[ 2 ] = era_trans;
    
    var tags = [];
    
    tags[0] = "Title:&nbsp;";
    tags[1] = "Artist:&nbsp;";
    tags[2] = "Era:&nbsp;";
    tags[3] = "Style:&nbsp;";
    tags[4] = "Genre:&nbsp;";
    tags[5] = "Filesize(bytes):&nbsp;";
    tags[6] = "Uploaded by:&nbsp;";
    
    get_ref( "image_tags" ).innerHTML = "";
    get_ref( "image_info" ).innerHTML = "";
    
    for( var i = 0; i < tags.length; i++ )
        get_ref( "image_tags" ).innerHTML += tags[i]+"<br>";
        
    for( var i = 0; i < tags.length; i++ )
    {
        new_img_info[ i ] = new_img_info[ i ].replace( /&qt;/g, "\"" );
        get_ref( "image_info" ).innerHTML += new_img_info[i]+"<br>";
    }
}