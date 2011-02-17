  /*
   * Image search ui file.
   */
  
  var si_ser_str = "empty";
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
                si_ser_str = $("#si_form").serialize();
            }
            
            function si_submit_status()
            {
                //enable loader
                $("#loading").css( "display", "block" );
                $("#loading").css( "position", "relative" );
                $("#loading").css( "top", "-14px" );
                $("#loading").css( "left", "65px" );

                custom_xhr_call( "./include/imgqueue/search_image_submit.php", "search_image_submit", si_ser_str );
                page_index = 0;
            }
            
            /* 
             * Register callback bindings
             * I bind the id of the text fields with the functions
             * that perform xmlHttpRequrest(xhr). These textfields
             * perform an xhr call upon execution of a certain event
             * (i.e. onclick, onkeyup, etc.).
             */
            get_ref( "si_query" ).onblur = show_values;
            get_ref( "si_submit" ).onclick = si_submit_status;            
            
            $("#si_query").keypress( function(e)
                                     {
                                        if( e.which == 13 )
                                        {
                                            //$("#si_query").css( "color", "red" );
                                            show_values();
                                            si_submit_status();
                                        }
                                     }
                                   )

            // Search page navigation.
            get_ref( "left" ).onclick =
            function()
            {
                page_index--;
                
                if( page_index < 0 )
                {
                    page_index = 0;
                    images = pages[ 0 ].split("|=|");
                    get_ref( "page_out_of" ).innerHTML = (page_index+1)+"/"+pages.length;
                }
                else
                {
                    images = pages[ page_index ].split("|=|");
                    get_ref( "page_out_of" ).innerHTML = (page_index+1)+"/"+pages.length;
                }
                
                for( var i = 0; i < images.length; i++ )
                {
                    get_ref( ("pic"+(i+1)) ).innerHTML = images[ i ];
                    $("#pic"+(i+1)).fadeIn( 100 );
                }
                
                for( var i = images.length; i < 26; i++ )
                {
                    get_ref( ("pic"+(i)) ).innerHTML = "";
                    $("#pic"+(i)).fadeIn( 100 );
                }
                    
            };
                    
                    
            get_ref( "right" ).onclick =
            function()
            {
                page_index++;
                if( page_index >= pages.length-1 )
                {
                    page_index = pages.length-1;
                    images = pages[ page_index ].split("|=|");
                    get_ref( "page_out_of" ).innerHTML = pages.length+"/"+pages.length;
                }
                else
                {
                    images = pages[ page_index ].split("|=|");
                    get_ref( "page_out_of" ).innerHTML = (page_index+1)+"/"+pages.length;
                }
        
                for( var i = 0; i < images.length; i++ )
                    get_ref( ("pic"+(i+1)) ).innerHTML = images[ i ];
                
                for( var i = images.length; i < 26; i++ )
                    get_ref( ("pic"+(i)) ).innerHTML = "";                
            };

            /*
             * Another way to hide search resutls box.
             * Click anywhere on shaded area.
             */
            get_ref( "shade" ).onclick =
            function()
            {
                get_ref( "shade" ).style.display            = "none";
                get_ref( "si_submit_status" ).style.display = "none";
            }
            
            get_ref( "shade_big_image" ).onclick =
            function()
            {
                get_ref( "shade_big_image" ).style.display  = "none";
                get_ref( "big_image" ).style.display        = "none";
            } 

            /*
             * Hide the search results box.
             * Clock on white cross.
             */            
            get_ref( "close_big_image" ).onclick =
            function()
            {
                get_ref("big_image").style.display        = "none";
                get_ref("shade_big_image").style.display        = "none";
            }
            
            $(".close").mouseover( function(){$(this).addClass("over");} )
                       .mouseout(  function(){$(this).removeClass("over");});

            $(".right").mouseover( function(){$(this).addClass("over");} )
                       .mouseout(  function(){$(this).removeClass("over");});
                       
            $(".left").mouseover( function(){$(this).addClass("over");} )
                      .mouseout(  function(){$(this).removeClass("over");});    

            $(".pic_cell").mouseover( function(){$(this).addClass("pic_cell_over");} )
                          .mouseout(  function(){$(this).removeClass("pic_cell_over");});            
            /*
             * Hide the search results box.
             * Clock on white cross.
             */            
            get_ref( "close_thumbs" ).onclick =
            function()
            {
                get_ref("si_submit_status").style.display = "none";
                get_ref("shade").style.display            = "none";
            }              

            /*
             * Keep the thumbnail and image box in the center of the screen.
             */
            window.onresize =
            function()
            {
                var win_width   = window.innerWidth;
                var win_height  = window.innerHeight;
                
                var thumb_box_w = 655;
                var thumb_box_h = 500;
                
                var img_box_w   = 655;
                var img_box_h   = 705;
            
                get_ref( "si_submit_status" ).style.left    = ( win_width  - thumb_box_w ) / 2;
                get_ref( "si_submit_status" ).style.top     = ( win_height - thumb_box_h ) / 2;
                
                get_ref( "big_image" ).style.left           = ( win_width  - img_box_w ) / 2;
                get_ref( "big_image" ).style.top            = ( win_height - img_box_h ) / 2;                
            }
            
            /*
             * This prevents the values from previous
             * submissions to be included in the xhr call(s).
             */ 
            show_values();
        }
   );
   
function search_image_submit( submit_status )
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
            
        if( imgs.length < 26 )
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

function view_big_image( img_id, width, height, img_info, img_index )
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