<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" >
<html>
<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<title>Artizm</title>

<meta NAME="description" content="<?php require_once( './include/shared/php/crawl_helper.php' ); $cho = new CrawlHelper(); $cho->description(); ?>">
<meta NAME="keywords" content="
<?php //require_once( './include/shared/php/crawl_helper.php' ); $cho = new CrawlHelper(); $cho->keywords(); ?>
">

<link rel=StyleSheet href="styles.css" type="text/css">
<link rel=StyleSheet href="xsp_styles.css" type="text/css">

<script type="text/javascript" src="./include/shared/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="./include/shared/js/artizmutils.js"></script>
<script type="text/javascript" src="./include/shared/js/search_image.js"></script>
<script type="text/javascript" src="./include/shared/js/browse_image.js"></script>
<script type="text/javascript" src="./include/shared/js/login.js"></script>

</head>

<body bgcolor="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<p>&nbsp;</p>
<table width="730" height="495" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
<tr>
		<td colspan="2">
			<img src="images/index_01.jpg" alt="Home" name="Home" width="231" height="78" border="0" usemap="#home" id="Home_Logo"></td>
		<td background="images/bg_search_box.gif">
        <div id="search_box">
    	<form id="si_form" onSubmit="return false;">
       	  <div align="center">
       	    <input type="text" name="si_query" id="si_query" tabindex=1 />
       	  </div>
    	</form>
       	    <input type="image" src="images/btn_search_box.jpg" width="47" height="44" name="si_submit" id="si_submit" alt="Search" title="Search" tabindex=2 />

       </div></td>
<td><img src="images/index_03.jpg" alt="Advanced Search" width="129" height="78" border="0" usemap="#advancedsearch"></td>
<td colspan="2">
			<img src="images/index_04.jpg" alt="" width="85" height="78" border="0" usemap="#aboutus"></td>
  </tr>
	<tr>
		<td rowspan="3">
			<img src="images/index_05.jpg" width="26" height="416" alt=""></td>
		<td colspan="4" background="images/index_06.jpg"><table width="676" height= "48" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td valign="middle">

<?php require_once( "header.php" ); print_header(); ?>            </td>
          </tr>
        </table></td>
		<td rowspan="3">
			<img src="images/index_07.jpg" width="28" height="416" alt=""></td>
	</tr>
	<tr>
		<td width="676" height="149" colspan="4" valign="top" background="images/index_08.jpg">
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
		<input type="text" id="bi_field" name="bi_field" value=""/>
		<input type="text" id="bi_order" name="bi_order" value=""/>
	   </form>
	    <!--Loading indicator-->
        <div id="loading_bar" style="float:left; position:relative; top:120px; left:-170px;">
	    <img src="./images/loading4_48x48.gif" id="loading" style="display:none"/>
        </div>
	    <!--Loading indicator-->
      </td>
	</tr>
	<tr>
		<td colspan="4" background="images/index_09.jpg"><TABLE height="218" cellSpacing="0" cellPadding="0" width="635" align="center" border="0">
          <TBODY>
            <TR>
              <TD class="middle_window_text"><p><b>The Artizm web portal provides information about art that cannot   be easily found on the internet.</b></p>
              <p><b>You will be able to learn about art in a number of ways, and   will also be able to leave your contributions to the community (i.e. upload   your art piece, leave a comment, specify museum(s) that have a certain   painting, etc.)</b></p>
              <p>&nbsp;</p>              </TD>
            </TR>
          </TBODY>
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