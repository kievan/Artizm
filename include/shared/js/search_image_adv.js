  /*
   * Image search ui file.
   */
  
  var sia_ser_str = "empty";
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
                sia_ser_str = $("#sia_form").serialize();
            }
            
            function sia_submit_status()
            {
                custom_xhr_call( "./include/imgqueue/search_image_adv_submit.php", "search_image_adv_submit", sia_ser_str );
                page_index = 0;
            }
            
            /* 
             * Register callback bindings
             * I bind the id of the text fields with the functions
             * that perform xmlHttpRequrest(xhr). These textfields
             * perform an xhr call upon execution of a certain event
             * (i.e. onclick, onkeyup, etc.).
             */
            //get_ref( "sia_submit" ).onclick = sia_submit_status;            
            //get_ref( "sia_name" ).onblur = show_values;
            //get_ref( "sia_artist" ).onblur = show_values;
            //get_ref( "sia_filesize" ).onchange = show_values;
            //get_ref( "sia_genre" ).onchange = show_values;
            //get_ref( "sia_style" ).onchange = show_values;
            //get_ref( "sia_era" ).onchange = show_values;

            $( "#sia_submit" ).click( sia_submit_status );            
            $( "#sia_name" ).blur( show_values );
            $( "#sia_artist" ).blur( show_values );
            $( "#sia_filesize" ).change( show_values );
            $( "#sia_genre" ).change( show_values );
            $( "#sia_style" ).change( show_values );
            $( "#sia_era" ).change( show_values );
            
            // Search page navigation.
            //$( "#left" ).click(
            //function()
            //{
            //    page_index--;
            //    
            //    if( page_index < 0 )
            //    {
            //        page_index = 0;
            //        images = pages[ 0 ].split("|=|");
            //        $( "#page_out_of" ).html( ((page_index+1)+"/"+pages.length) );
            //    }
            //    else
            //    {
            //        images = pages[ page_index ].split("|=|");
            //        $( "#page_out_of" ).html( ((page_index+1)+"/"+pages.length) );
            //    }
            //    
            //    for( var i = 0; i < images.length; i++ )
            //    {
            //        $( "#pic"+(i+1) ).html( images[ i ] );
            //        $( "#pic"+(i+1) ).fadeIn( 100 );
            //    }
            //    
            //    for( var i = images.length; i < 26; i++ )
            //    {
            //        $( "#pic"+(i+1) ).html( "" );
            //        $( "#pic"+(i+1) ).fadeIn( 100 );
            //    }
            //        
            //}
            //);
                    
                    
            //$( "#right" ).click(
            //function()
            //{
            //    page_index++;
            //    if( page_index >= pages.length-1 )
            //    {
            //        page_index = pages.length-1;
            //        images = pages[ page_index ].split("|=|");
            //        $( "#page_out_of" ).html( pages.length+"/"+pages.length );
            //    }
            //    else
            //    {
            //        images = pages[ page_index ].split("|=|");
            //        $( "#page_out_of" ).html( (page_index+1)+"/"+pages.length );
            //    }
            //
            //    for( var i = 0; i < images.length; i++ )
            //        $( "#pic"+(i+1) ).html( images[ i ] );
            //    
            //    for( var i = images.length; i < 26; i++ )
            //         $( "#pic"+(i+1) ).html( "" );                
            //}
            //);

            /*
             * Another way to hide search resutls box.
             * Click anywhere on shaded area.
             */
           //$( "#shade" ).click(
           // function()
           // {
           //     $( "#shade" ).css( "display", "none" );
           //     $( "#si_submit_status" ).css( "display", "none" );
           // }
           // );
           // 
           // $( "#shade_big_image" ).click(
           // function()
           // {
           //     $( "#shade_big_image" ).css( "display", "none" );
           //     $( "#big_image" ).css( "display", "none" );                
           // }
           // );

            /*
             * Hide the search results box.
             * Clock on white cross.
             */            
            //$( "#close_big_image" ).click(
            //function()
            //{
            //    $( "#shade_big_image" ).css( "display", "none" );
            //    $( "#big_image" ).css( "display", "none" );   
            //}
            //);
            //
            //$(".close").mouseover( function(){$(this).addClass("over");} )
            //           .mouseout(  function(){$(this).removeClass("over");});
            //
            //$(".right").mouseover( function(){$(this).addClass("over");} )
            //           .mouseout(  function(){$(this).removeClass("over");});
            //           
            //$(".left").mouseover( function(){$(this).addClass("over");} )
            //          .mouseout(  function(){$(this).removeClass("over");});    
            //
            //$(".pic_cell").mouseover( function(){$(this).addClass("pic_cell_over");} )
            //              .mouseout(  function(){$(this).removeClass("pic_cell_over");});            
            /*
             * Hide the search results box.
             * Clock on white cross.
             */            
            //$( "#close_thumbs" ).click(
            //function()
            //{
            //    $( "#si_submit_status" ).css( "display", "none" );
            //    $( "#shade" ).css( "display", "none" );                  
            //}
            //);

            /*
             * Keep the thumbnail and image box in the center of the screen.
             */
            //window.onresize =
            //function()
            //{
            //    var win_width   = window.innerWidth;
            //    var win_height  = window.innerHeight;
            //    
            //    var thumb_box_w = 655;
            //    var thumb_box_h = 500;
            //    
            //    var img_box_w   = 655;
            //    var img_box_h   = 705;
            //
            //    $( "#si_submit_status" ).css( "left", (( win_width  - thumb_box_w ) / 2) );
            //    $( "#si_submit_status" ).css( "top", (( win_height - thumb_box_h ) / 2) );
            //    
            //    $( "#big_image" ).css( "left", (( win_width  - img_box_w ) / 2) );
            //    $( "#big_image" ).css( "top", (( win_height - img_box_h ) / 2) );
            //}
            
            /*
             * This prevents the values from previous
             * submissions to be included in the xhr call(s).
             */ 
            show_values();
        }
   );
   
function search_image_adv_submit( submit_status )
{
    //document.write( submit_status );
    
    var success = new Array();  
    var imgs    = new Array();
    var pgs     = new Array();
    
    var win_width  = window.innerWidth;
    var win_height = window.innerHeight;
    var srch_box_w = 655;
    var srch_box_h = 500;

    $( "#si_submit_status" ).css( "left", ((win_width  - srch_box_w) / 2) );
    $( "#si_submit_status" ).css( "top", ((win_height - srch_box_h) / 2) );
    
    $( "#shade" ).css( "display", "block" ); 
    $( "#si_submit_status" ).fadeIn( 1000 );

    
    success = submit_status.split( "||=||" );
    pgs     = success[ 1 ].split( "__pg_separ__" );
    imgs    = pgs[ 0 ].split( "|=|" );
    
    // Populate global array for thumb navigation to work.
    pages            = pgs;
    
    $( "#page_out_of" ).html( 1+"/"+pages.length );
    
    if( success[0] == "Success" )
    {
        // Populate first page.
        for( var i = 0; i < imgs.length; i++ )
            $( "#pic"+(i+1) ).html( imgs[ i ] );
            
        if( imgs.length < 25 )
        {
            for( var i = imgs.length; i < 26; i++ )
                $( "#pic" + i).html("");
        }
        
    }
    else
    {
        for( var i = 0; i < 25; i++ )
            $( ("#pic"+(i+1)) ).html( " " );        
        $("#pic13").html( "<div style='position: absolute; top: 250px; left: 148px; font-size:32px; color: #ffffff; z-index: 1000;'>Nothing found...</div>" );
    }
    
    return false;
}

function view_big_image_adv( img_id, width, height, img_info, img_index )
{
    //document.write( "tut" );
    var img_src = "<img src=\"./include/imgqueue/display_image.php?img_id="
                  +img_id+"&full=1\" width="+width+" height="+height+"/>";
    
    var win_width  = window.innerWidth;
    var win_height = window.innerHeight;
    var img_box_w  = 611;
    var img_box_h  = 655;

    $( "#big_image" ).css( "left", (win_width  - img_box_w) / 2 );
    $( "#big_image" ).css( "top", (win_height  - img_box_h) / 2 )
    
    $( "#shade_big_image" ).css( "display", "block" );
    $( "#big_image_inner" ).html( img_src );
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
    
    $( "#image_tags" ).html( "" );
    $( "#image_info" ).html( "" );
    
    var tmp_v = "";
    for( var i = 0; i < tags.length; i++ )
        tmp_v += tags[i]+"<br>";
    $( "#image_tags" ).html( tmp_v );
        
    var tmp_imginfo = "";
    for( var i = 0; i < tags.length; i++ )
    {
        new_img_info[ i ] = new_img_info[ i ].replace( /&qt;/g, "\"" );
        tmp_imginfo += new_img_info[i]+"<br>";
    }
    $( "#image_info" ).html( tmp_imginfo );
}