<html>
<head>
<title>Flashlight</title>
<meta name="Author" content="Thomas Brattli">
<meta name="Author" content="Michael Schulte-Mecklenbeck">
<meta name="Author" content="Ryan O. Murphy">
<meta name="KeyWords" content="flashlight">

<style type="text/css">

html, body { margin:0; padding:0;}
body {background-image:url(pics/<?=$stimulus_blur?>);background-repeat:no-repeat; background-position:top center; overflow:hidden;}  
div, form,input,img { margin:0; padding:0;}
#divExCont {position:absolute; left:0px; top:0px; clip:rect(0px 0px 0px 0px); background-color:#ffffff; background-color:#ffffff; width:100%; height:100%;}
#divCircle {background-image:url(<?=$imgsrc?>);background-repeat:no-repeat; background-position:top left; position:absolute; z-index:500; visibility:hidden;}
#button {position:static; width:80px;height:80px;background-color:#00FF33;color:#FFFFFF;cursor:pointer;float:left;}
.btn {position:static; width:80px;height:80px;background-color:#00FF33;color:#FFFFFF;cursor:pointer;float:left;}
.buttonholder {text-align:center;padding-left:<?php echo $button_offset;?>px;}
</style>
<script type="text/javascript">
	/*** Variables to set ***/
	sCircleWidth = <? echo $sCircleWidth;?>;	//The width the script will clip to
	sCircleHeight = <? echo $sCircleHeight;?>;	//The height the script will clip to
	sCircleOutWidth = <? echo $sCircleOutWidth ;?>;	//The outer width of the circle
	sCircleOutHeight = <? echo $sCircleOutHeight;?>;	//The outer height of the circle
	sStarty = <? echo $sStarty;?>;		//Where do you want it to initially start
	sStartx = <? echo $sStartx;?>;		//Where do you want it to initially start
	clipSpeed = <? echo $clipSpeed;?>;		//Number of pixels for each step in the animation.
	recordTimeout = <? echo 1000/$record_frequency; ?>; // timeout for recording events; $record_frequency is set in (recordings per second)
	buttonsNum = <?php echo $buttons_num; ?>;
    btns = new Array();
	<?php for($i=1;$i<=$buttons_num;$i++) {
	echo "btns[$i]='".$buttons_arr[$i-1]."';";
	}
	?>
</script>

<script language="JavaScript" type="text/javascript" src="javascript.js"></script>
<!--[if lt IE 7]>
<script language="JavaScript">
function correctPNG() // correctly handle PNG transparency in Win IE 5.5 & 6.
{
   var arVersion = navigator.appVersion.split("MSIE");
   var version = parseFloat(arVersion[1]);
   if ((version >= 5.5) && (document.body.filters))
   {
      for(var i=0; i<document.images.length; i++)
      {
         var img = document.images[i];
         var imgName = img.src.toUpperCase();
         if (imgName.substring(imgName.length-3, imgName.length) == "PNG")
         {
            var imgID = (img.id) ? "id='" + img.id + "' " : "";
            var imgClass = (img.className) ? "class='" + img.className + "' " : "";
            var imgTitle = (img.title) ? "title='" + img.title + "' " : "title='" + img.alt + "' ";
            var imgStyle = "display:inline-block;" + img.style.cssText ;
            if (img.align == "left") imgStyle = "float:left;" + imgStyle;
            if (img.align == "right") imgStyle = "float:right;" + imgStyle;
            if (img.parentElement.href) imgStyle = "cursor:hand;" + imgStyle;
            var strNewHTML = "<span " + imgID + imgClass + imgTitle
            + " style=\"" + "width:" + img.width + "px; height:" + img.height + "px;" + imgStyle + ";"
            + "filter:progid:DXImageTransform.Microsoft.AlphaImageLoader"
            + "(src=\'" + img.src + "\', sizingMethod='scale');\"></span>" ;
            img.outerHTML = strNewHTML;
            i = i-1;
         }
      }
   }
   
   if (bw.bw) spotInit();
}
window.attachEvent("onload", correctPNG);
</script>
<![endif]-->

</head>
 <body>