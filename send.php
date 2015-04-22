<?	

include 'config.php';
if($_POST['moves']) 
{
	mysql_query("INSERT INTO moves SET 
									participant_id = '{$_SESSION['pid']}',
									task_id = '{$_SESSION['version']}',
									moves =  '{$_POST['moves']}',
									timestamp = UNIX_TIMESTAMP(),
									button = '{$_POST['click']}'");
								
}

// Show data in DB:
$query="SELECT * FROM moves";
$result=mysql_query($query) or die(mysql_error());
//get results
while ($row = mysql_fetch_assoc($result)) {
$r[]= $row; 
}
//make output look nice
require_once 'include/function.array2table.php';
array2table($r,600);
?>