<?php

include('config.php');

$con = mysql_connect($dbHost,$dbUser,$dbPass);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

if (mysql_query("CREATE DATABASE $dbName",$con))
  {
  echo "Database $dbName created";
  }
else
  {
  echo "Error creating database: " . mysql_error();
  }

// Create table moves
mysql_select_db("$dbName", $con);
$sql = "
CREATE TABLE IF NOT EXISTS `moves` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `participant_id` blob,
  `task_id` int(10) unsigned default NULL,
  `moves` text,
  `timestamp` int(10) unsigned default NULL,
  `button` text NOT NULL,
  PRIMARY KEY  (`id`)
)";

// Execute query
mysql_query($sql,$con);


// Create table tasks
mysql_select_db("$dbName", $con);
$sql = "
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `task` int(10) unsigned default NULL,
  `visibility` int(10) unsigned default NULL,
  `stimulus` varchar(100) NOT NULL default '',
  `stimulus_blur` varchar(105) NOT NULL default '',
  PRIMARY KEY  (`id`)
)";

// Execute query
mysql_query($sql,$con);

// Fill table tasks
mysql_select_db("$dbName", $con);
$sql = "
INSERT INTO `tasks` (`id`, `task`, `visibility`, `stimulus`, `stimulus_blur`) VALUES
(1, 1, 1, 'add1.jpg', 'add-blur.jpg'),
(2, 2, 1, 'gamble1.jpg', 'gamble-blur.jpg'),
(3, 3, 1, 'read1.jpg', 'read-blur.jpg'),
(4, 4, 1, 'search1.jpg', 'search1-blur.jpg')
";

// Execute query
mysql_query($sql,$con);



// Create table task buttons
mysql_select_db("$dbName", $con);
$sql = "
CREATE TABLE IF NOT EXISTS `task_buttons` (
  `id` int(11) NOT NULL auto_increment,
  `task_id` int(11) NOT NULL,
  `button_name` varchar(255) NOT NULL default 'Button Name',
  PRIMARY KEY  (`id`)
)";

// Execute query
mysql_query($sql,$con);

// Fill table Buttons
mysql_select_db("$dbName", $con);
$sql = "
INSERT INTO `task_buttons` (`id`, `task_id`, `button_name`) VALUES
(1, 1, 'Next'),
(2, 2, 'Gamble A'),
(3, 2, 'Gamble B'),
(4, 3, 'Next'),
(5, 4, 'Next')
";

// Execute query

;
if (mysql_query($sql,$con))
  {
  echo "<BR>";
  echo "Tables created, have a nice day!";
  }
else
  {
  echo "<BR>";
  echo "!! Check Table Creation - Something is wrong !!";
  }



mysql_close($con);
?>

