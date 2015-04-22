<? 
//////////////////////////////////////
// Flahlight main script
// Version 0.9
// October 2008
//////////////////////////////////////
 
// include config file
include_once 'config.php';

//get the task number from the link
$task=$_GET['task'];
$task = ($task)? $task :1;

// query database for stimulus and stimulus blur filename with task id $task=1,2 etc..
	$result = mysql_query("SELECT stimulus, stimulus_blur FROM tasks WHERE task=$task");
	$arr = mysql_fetch_array($result);
	$stimulus = $arr[0];
	$stimulus_blur = $arr[1];
//query database for button values for each task id
	$query = "select button_name from task_buttons where task_id=$task";
	$result_buttons = mysql_query($query);
	//$buttons_arr = mysql_fetch($result_buttons);
	while($row = mysql_fetch_array($result_buttons)){
		
		$buttons_arr[] = $row['button_name'];
	}
	$buttons_num  = count($buttons_arr);
	
   
include 'include/html_header.php';
?>
<!-- SHOW Stimulus  -->
<div style="position:absolute; left:0; top:0"></div>
<div id="divCircle" onClick="showCont(); return false" onFocus="if(this.blur)this.blur()" style="width:<?=$sCircleOutWidth?>px; height:<?=$sCircleOutHeight?>px;"></div>
  <div id="divExCont">
    <div align="center">
	    <div>
		  <img id="stimulus" src="pics/<?=$stimulus?>" border="0">
	    </div>
<!-- ADD SUBMIT BUTTON -->
	    <br>
	    <div>
		    <form name="mainForm" method="post" action="send.php">
			  <input type="hidden" name="moves">
			  <input type="hidden" name="click" value="#">
				<div class="buttonholder">  
			<?php 
				foreach ($buttons_arr as $key=>$button) {
				if($key == 0){
				echo '<div id="button"><br><br><b>'.$button.'</b></div>';
				}else{
				echo '<div class="btn"><br><br><b>'.$button.'</b></div>';
				}
				}
			?>
				</div>
			</form>
	  </div>
	</div>
	</div>
</body>
</html>

