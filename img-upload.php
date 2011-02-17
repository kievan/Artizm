<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" >
<html>
<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<title>Artizm - Upload Art</title>

<link rel=StyleSheet href="styles.css" type="text/css">
<link rel=StyleSheet href="xsp_styles.css" type="text/css">

<script type="text/javascript" src="./include/shared/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="./include/shared/js/artizmutils.js"></script>
<script type="text/javascript" src="./include/shared/js/search_image.js"></script>
<script type="text/javascript" src="./include/shared/js/login.js"></script>
<script type="text/javascript" src="./include/shared/js/upload_image.js"></script>
<script type="text/javascript" src="./include/shared/js/browse_image.js"></script>

<!--##################### -->

</head>

<body bgcolor="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<p>&nbsp;</p>
<table width="730" height="495" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
<tr>
		<td colspan="2">
			<img src="images/upload_01.jpg" alt="Home" name="Home" width="231" height="78" border="0" usemap="#home" id="Home_Logo"></td>
		<td background="images/upload_02.jpg">
        <div id="search_box">
    	<form id="si_form" onSubmit="return false;">
       	  <div align="center">
       	    <input type="text" name="si_query" id="si_query" tabindex=1 />
          </div>
    	</form>
       	    <input type="image" src="images/btn_search_box.gif" width="47" height="44" name="si_submit" id="si_submit" alt="Search" title="Search" tabindex=2 />

        </div>    

</td>
<td><img src="images/upload_03.jpg" alt="Advanced Search" width="129" height="78" border="0" usemap="#advancedsearch"></td>
<td colspan="2">
			<img src="images/upload_04.jpg" alt="" width="85" height="78" border="0" usemap="#aboutus"></td>
  </tr>
	<tr>
		<td rowspan="3">
			<img src="images/upload_05.jpg" width="26" height="416" alt=""></td>
		<td colspan="4" background="images/upload_06.jpg"><table width="676" height= "48" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td valign="middle">

<?php require_once( "header.php" ); check_logged_out(); print_header(); ?>

            </td>
          </tr>
        </table></td>
		<td rowspan="3">
			<img src="images/upload_07.jpg" width="28" height="416" alt=""></td>
	</tr>
	<tr>
		<td width="676" height="149" colspan="4" valign="top" background="images/upload_08.jpg">
           <div id="nav">
            <ul>
            	<li><a href="#">Browse Artworks By</a>
                    <ul>
                        <li><a id="bi_artist">Artist</a></li>
                        <li><a id="bi_name">Name of Artwork</a></li>
                        <li><a id="bi_era">Era</a></li>
                        <li><a id="bi_genre">Genre</a></li>
                        <li><a id="bi_size">File Size</a></li>
                        <li><a id="bi_style">Style</a></li>
            		</ul>
                 <li><a href="#">Order By</a>
                    <ul>
                        <li><a id="bi_asc">Ascending</a></li>
                        <li><a id="bi_desc">Descending</a></li>         
            	    </ul>
                 <li><a style="color:#FF9933;">....</a></li>
                 <li><a id="bi_submit">GO</a></li>
            	</li>
            </ul>
           </div>
	   
	   <form id="bi_form" style="display:none;">
		<input type="text" id="bi_field" name="bi_field" />
		<input type="text" id="bi_order" name="bi_order" />
	   </form>
	    <!--Loading indicator-->
        <div id="loading_bar" style="float:left; position:relative; top:120px; left:-170px;">
	    <img src="./images/loading4_48x48.gif" id="loading" style="display:none"/>
        </div>
	    <!--Loading indicator-->
      </td>
	</tr>
	<tr>
		<td colspan="4" background="images/upload_09.jpg"><TABLE height="218" cellSpacing="0" cellPadding="0" width="635" align="center" border="0">
            <TR>
              <TD valign="top">
              
          <form action="./include/artmngmt/upload_image_submit.php" method="post" enctype="multipart/form-data"  >
	       
	       <!--<form id="form8" name="form8" method="post" action="">-->
                <div align="center" style="position: relative; top: 10px; left: 340px;">
		  <span class="middle_window_text_black">Image Name:</span>
                  <input type="text" name="iu_name" id="iu_name"  style="width: 150px; height: 20px;"/>
                </div>
              <!--</form>-->
	      </td>
              <td>
	       <!--<form id="form9" name="form9" method="post" action="">-->
                <label></label>
		
              <!--</form>-->
	      </td>
            </tr>
            <tr>
              <td width="51%">
	       <div align="center"  style="position: relative; top: 55px; left: 352px; width: 300px; height: 20px;">
                <p><span class="middle_window_text_black">Artist Name:</span>
                  <input type="text" name="iu_artist" id="iu_artist"  style="width: 150px; height: 20px;"/>
                </p>
                </div></td>
              <td width="49%">
	       <!--<form id="form2" name="form2" method="post" action="">-->
                <div align="center">
                  <label>
                  <!--<input type="submit" name="browse" id="browse" value="BROWSE" />-->

                  </label>
</div>
                <!--</form>-->
	      </td>
            </tr>
            <tr>
              <td><div align="center"  style="position: relative; top: -50px; left: 383px;  width: 300px; height: 20px;">
	      <span class="middle_window_text_black">Era:</span>
                  <select name="iu_era" id="iu_era" style="width: 150px; height: 20px;">
		    <option>Not&nbsp;sure</option>
                    <option>&lt;15th&nbsp;Century</option>
                    <option>15th-19th&nbsp;Century</option>
                    <option selected="selected">20th+&nbsp;Century</option>
                </select>
              </div>
              <td>
	       <!--<form id="form4" name="form4" method="post" action="">-->
                <div align="center" style="position: relative; top: -25px; left: 51px; width: 300px; height: 20px;">
                  <div align="center"><span class="middle_window_text_black">Genre:</span>
                      <select name="iu_genre" id="iu_genre" class="uniform" style="width: 150px; height: 20px;">
			<option>Not&nbsp;sure</option>
                        <option selected="selected">Abstract</option>
                        <option>Cubism</option>
                        <option>Expressionism</option>
                        <option>Fauvism</option>
                        <option>Impressionism</option>
                        <option>Realism</option>
                        <option>Surrealism</option>
                        <option>Pointillism</option>
                        <option>Postimpressionism</option>
                        <option>Primitivism</option>
                      </select>
                  </div>
                </div>
              <!--</form>-->
	      </td>
            </tr>
            <tr>
              <td>
	       <!--<form id="form5" name="form5" method="post" action="">-->
                <div align="center"  style="position: relative; top: -23px; left: 364px;">
		  <span class="middle_window_text_black">Style:</span>
                    <select name="iu_style" id="iu_style" width=300 style="width: 150px; height: 20px;">
		      <option>Not&nbsp;sure</option>
                      <option>Drawing</option>
                      <option>Painting</option>
                      <option selected="selected">Photography</option>
                    </select>
                </div>
		</td>
              <td>
                  <label>
                  <div align="left"></div>
                  <div align="center"></div>
                </label>
	      </td>
            </tr>
            <tr>
              <td>
	      <div style="position: relative; top: -118px; left: 10px;">
	       <input type="checkbox" name="iu_user_agreement" id="iu_user_agreement" value="1" checked="checked"/>
            <span class="middle_window_text_black" style="position: absolute; width: 290px; height: 80px; border: none">
		  I agree that this image is correctly labeled, and that by uploading it
		  I do not violate any ethical and/or legal laws.
		</span>
	      </div>
	      </td>
            
	      <td>
                     
	     
            <div align="center" class="middle_window_text_black"  style="position:relative; top: -138px; left: -340px;">
                  <p>Image Location:
                    <input type="file" name="iu_file" id="iu_file"  style="width: 150px; height: 25px;"/>
                  </p>
            </div>
		
                  <div align="right" style="position: relative; top: -28px; left: -250px;">
                    <button type="submit" name="iu_upload_button" id="iu_upload_button" style="width: 131px;">
			Upload
		    </button>
                  </div>
		  
	    </form>
        	      </td>
            </tr>

              </TD>
            </TR>
	    </TABLE></td>
</tr>
	<tr>
		<td>
			<img src="images/spacer.gif" width="26" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="205" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="285" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="129" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="57" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="28" height="1" alt=""></td>
	</tr>
</table>

<div id="iu_submit_status" style="position: absolute; top: 360px; left: 300px; color: #000; height: 20px; width: 450px; border: 1px solid #ff0000; display:none;"></div>	 

<!-- #######import from the old page -->

<style>
/*
 *  D7D89E   - darker
 *  F6F9B6   - lighter
 */
.pic_cell
{
	text-align: center;
	padding: 5px;
	height: 85px;
	width: 85px;
	
	/*background-color:#885599;*/
	background-color: #dddddd;
	
	opacity: 0.62;
	filter: alpha( opacity = 62 );
	-moz-opacity: 0.62;
	
	z-index: 10;
	
}
.pic_cell_over
{
	/*background-color:#885599;*/
	background-color: #888888;
	
	opacity: 1.0;
	filter: alpha( opacity = 1.0 );
	-moz-opacity: 1.0;
}
.upper_row
{
	height: 20px;
}
.close_smallshade
{
	position: absolute;
	top: -25px;
	right: -20px;
	font-size: 20px;
	color: #585858;
	cursor: default;
}

.close_bigshade
{
	position: absolute;
	top: 0px;
	right: 5px;
	font-size: 20px;
	color: #585858;
	cursor: default;
}

.left
{
	position: absolute;
	/*text-align: left;*/
	top: 220px;
	left: 15px;
	font-size: 55px;	
}
.page_out_of
{
	position: absolute;
	top: 10px;
	left: 10px;
	font-size: 25px;
	width: 100x;
	height: 30px;
	text-align: right;

	opacity: 0.55;
	filter: alpha( opacity = 0.55 );
	-moz-opacity: 0.55;
	border-bottom: 2px solid;
	z-index: 1;

}
.query_highlight
{
	/*font-weight: bold;*/
	color: #5000EE;
	background-color: #ffffff;
}

.right
{
	position: absolute;
	/*text-align: right;*/
	top: 220px;
	left: 600px;
	font-size: 55px;
}
.nav
{
	/*color: #ffffff;*/
	color: 	rgb( 88, 88, 88 );
	cursor: default;
}
.over
{
	/*color: #555555;*/
	font-weight: bold;
}


</style>

<div id="shade"
     style="position: absolute;
	    opacity: 0.77;
	    filter: alpha( opacity = 77 );
	    -moz-opacity: 0.77;
            top: 0px;
	    left: 0px;
	    
	    /*background-color:#F6F9B6;*/
	    background-color: #202020;
	    
	    width: 100%;
	    height: 100%;
	    z-index:10;
	    display:none;"
></div>

<div id="shade_big_image"
     style="position: absolute;
	    opacity: 0.77;
	    filter: alpha( opacity = 77 );
	    -moz-opacity: 0.77;
            top: 0px;
	    left: 0px;
	    
	    /*background-color:#563365;*/
	    background-color: #404040;
	    
	    width: 100%;
	    height: 100%;
	    z-index:110;
	    display:none;"
></div>



<div id="si_submit_status"
     style="position: absolute;
	    /*top: 8%;*/
	    left: 300px;
	   
	    /*background-color:#885599;*/
	    background-color: #dddddd;
	    width:  655px;
	    height: 500px;
	    border: 5px solid #ffffff;
	    /*border-bottom: 5px solid #000000;*/
	    /*border-right: 5px solid #000000;*/
	    z-index: 100;
	    display: none;"
>

</script>

	<!--<div id="shadow" style="z-index: 50;background-color: #000000;position: absolute; top 0px; left: 0px; width: 665px; height: 510px;opacity: 0.55;filter: alpha( opacity = 55 );-moz-opacity: 0.55;"></div>-->
    <table border=0 style="table-layout: fixed; position: absolute; top: 20px; left: 85px; z-index: 200;">
	<tr>
	  <td class="upper_row"></td><div id="close_thumbs" class="close_smallshade"><img src="images/close_button.gif" alt="Close"></div>
	  <td class="upper_row"></td>
	  <td class="upper_row"></td>
	  <td class="upper_row"></td>
	  <td class="upper_row"></td>
	</tr>
	<tr>
	  <td id="pic1" class="pic_cell"></td>
	  <td id="pic2" class="pic_cell"></td>
	  <td id="pic3" class="pic_cell"></td>
	  <td id="pic4" class="pic_cell"></td>
	  <td id="pic5" class="pic_cell"></td>
	</tr>
	<tr>
	  <td id="pic6" class="pic_cell"></td>
	  <td id="pic7" class="pic_cell"></td>
	  <td id="pic8" class="pic_cell"></td>
	  <td id="pic9" class="pic_cell"></td>
	  <td id="pic10" class="pic_cell"></td>
	</tr>
	<tr>
	  <td id="pic11" class="pic_cell"></td>
	  <td id="pic12" class="pic_cell"></td>
	  <td id="pic13" class="pic_cell"></td>
	  <td id="pic14" class="pic_cell"></td>
	  <td id="pic15" class="pic_cell"></td>
	</tr>
	<tr>
	  <td id="pic16" class="pic_cell"></td>
	  <td id="pic17" class="pic_cell"></td>
	  <td id="pic18" class="pic_cell"></td>
	  <td id="pic19" class="pic_cell"></td>
	  <td id="pic20" class="pic_cell"></td>
	</tr>
	<tr>
	  <td id="pic21" class="pic_cell"></td>
	  <td id="pic22" class="pic_cell"></td>
	  <td id="pic23" class="pic_cell"></td>
	  <td id="pic24" class="pic_cell"></td>
	  <td id="pic25" class="pic_cell"></td>
	</tr>
	<tr>
		<td></td><div id="left" class="left nav">&lt;</div>
		<td></td>
		<td></td><div id="page_out_of" class="page_out_of nav" ></div>
		<td></td>
		<td></td><div id="right" class="right nav">&gt;</div>
	</tr>
  </table>
  </div>


<div id="big_image"
     style="position: absolute;
	    top: 8%;
	    left: 300px;
	    
	    /*background-color:#885599;*/
	    background-color: #bbbbbb;
	    
	    height: 655px;
	    width: 611px;
	    border: 5px solid #ffffff;
	    /*border-bottom: 5px solid #000000;*/
	    /*border-right: 5px solid #000000;*/
	    z-index: 250;
        overflow:auto;
	    display:none;"
>

    <table border=0 style="table-layout: fixed; position: absolute; left: 38px; z-index: 300; color: #ffffff; height: 705px; width: 535px;">
	<tr>
	  <td class="upper_row" colspan="2"><div id="close_big_image" class="close_bigshade"><img src="images/close_button.gif" alt="Close"></td>
	
	<tr>
	  <td id="big_image_inner" colspan="2" style="height:500px; text-align: center"></td>
	<tr>
		<td></td>
		<td></td>
			<div id="image_tags" style="position: absolute; top: 540px; left: 100px; width: 100px; text-align: right; color: #585858"></div>
			<div id="image_info" style="position: absolute; top: 540px; left: 210px; width: 350px; overflow: hidden; color: #585858; z-index: 1000"></div>
	
	<tr>
		<td> </td>
			<div id="big_image_left" class="left nav" style="display: none">
				<div>&lt;</div>
			</div>
			<div class="page_out_of nav" id="image_out_of"  style="display: none">1/1</div>
			<div id="big_image_right" class="right nav"  style="display: none">
				<div>&gt;</div>
			</div>
		

    </table>
</div>

<!-- #################### -->

<div id="l_submit_status"
     style="position: absolute;
	    top: 150px;
	    left: 0px;
	    color: #000000;
	    height: 20px;
	    width: 450px;
	    border: 1px solid #ff0000;
	    text-align: center;
	    font-family: Verdana, Arial, Georgia;
	    font-size: 14px;
        display: none;"></div>

</body>

<map name="home"><area shape="rect" coords="6,7,227,64" href="index.php" alt="Home">
</map>
<map name="advancedsearch"><area shape="rect" coords="13,13,124,69" href="advanced-search.php" alt="Advanced Search">
</map>
<map name="aboutus"><area shape="rect" coords="7,16,70,67" href="about-us.php" alt="About us">
</map>

</html>