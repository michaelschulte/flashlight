<?
//////////////////////////////////////
// database configuration
//////////////////////////////////////

$dbHost = 'localhost';
$dbName = 'flashlight';
$dbUser = 'root';
$dbPass = '';
// connect to database
mysql_connect($dbHost,$dbUser,$dbPass);
mysql_select_db($dbName);

//////////////////////////////////////
// flashlight configuration
//////////////////////////////////////

//select cursor overlay from /pics folder // value moved to localconfig.php . @260810 moved back again at the end of config.php
//$imgsrc = "pics/circle0.png";

//define cursor overlay size
$sCircleWidth = 168;
$sCircleHeight = 168;

$sCircleOutWidth = 300;
$sCircleOutHeight = 300;

//define start position of cursor
$sStarty = 10;
$sStartx = 10;

//define clip speed
$clipSpeed = 20;


/////////////////////////////////////////////
//select cursor overlay from /pics folder//////
////////////////////////////////////////////
$imgsrc = "pics/circle0.png";


/////////////////////////////////////////////////////
// set the frequency of recording eg 10 persecond = 10//
////////////////////////////////////////////////////
$record_frequency = 1;


///////////////////////////////////////////////////////////////
//set button_offset value to move the buttons starting point/////
// eg : x pixels from the left of the page screen./////////////////
$button_offset = 300;
?>