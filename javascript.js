function lib_bwcheck(){ //Browsercheck (needed)
	this.ver=navigator.appVersion
	this.agent=navigator.userAgent
	this.dom=document.getElementById?1:0
	this.opera5=this.agent.indexOf("Opera 5")>-1
	this.ie5=(this.ver.indexOf("MSIE 5")>-1 && this.dom && !this.opera5)?1:0; 
	this.ie6=(this.ver.indexOf("MSIE 6")>-1 && this.dom && !this.opera5)?1:0;
	this.ie7=(this.ver.indexOf("MSIE 7")>-1 && this.dom && !this.opera5)?1:0;
	this.ie4=(document.all && !this.dom && !this.opera5)?1:0;
	this.ie=this.ie4||this.ie5||this.ie6||this.ie7
	this.mac=this.agent.indexOf("Mac")>-1
	this.ns6=(this.dom && parseInt(this.ver) >= 5) ?1:0; 
	this.ns4=(document.layers && !this.dom)?1:0;
	this.bw=(this.ie7 || this.ie5 || this.ie4 || this.ns4 || this.ns6 || this.opera5)
	return this
}
var bw=new lib_bwcheck()


// Variables added by Michael
var moves = '';
var startTime = 0;
var stimulusLeft = 0;
var stimulusTop = 0;
var stimulusRight = 0;
var stimulusBottom = 0;
var mouseX = 0;
var mouseY = 0;
var intervalId = 0;
var buttonX = 0;
var buttonY = 0;

/******************************************************************************
Making the clipobject part
******************************************************************************/	
function makeObj(obj, nest, x, y){
	nest = (!nest) ? "":'document.'+nest+'.';										
   	this.css = bw.dom? document.getElementById(obj).style:bw.ie4?document.all[obj].style:bw.ns4?eval(nest+"document.layers." +obj):0;		
	this.evnt = bw.dom? document.getElementById(obj):bw.ie4?document.all[obj]:bw.ns4?eval(nest+"document.layers." +obj):0;													
	this.clip = b_clip;
	this.clipIt = b_clipIt;
	this.clipTo = b_clipTo;
	this.obj = obj + "Object";
	eval(this.obj + "=this");
	return this;
}

// A unit of measure that will be added when setting the position or size of a layer.
var px = bw.ns4||window.opera?"":"px";

//clip part
function b_clipTo(t,r,b,l){

	this.css.clip="rect("+t+"px "+r+"px "+b+"px "+l+"px)";
	
}
function b_clipIt(tstop,rstop,bstop,lstop,step,fn){
	if (!fn) fn = null
	var clipval = new Array()
	if (bw.dom || bw.ie4) {
		clipval = this.css.clip
		clipval = clipval.slice(5,clipval.length-1);
		clipval = clipval.split(' ')
		for (var i=0; i<4; i++) clipval[i] = parseInt(clipval[i])
	}
	else {
		clipval[0] = this.css.clip.top
	    clipval[1] = this.css.clip.right
	    clipval[2] = this.css.clip.bottom
	    clipval[3] = this.css.clip.left
	}
	totantstep = Math.max(Math.max(Math.abs((tstop-clipval[0])/step),Math.abs((rstop-clipval[1])/step)),
		Math.max(Math.abs((bstop-clipval[2])/step),Math.abs((lstop-clipval[3])/step)))
	if (!this.clipactive)
		this.clip(clipval[0],clipval[1],clipval[2],clipval[3],(tstop-clipval[0])/totantstep,
			(rstop-clipval[1])/totantstep,(bstop-clipval[2])/totantstep,
				(lstop-clipval[3])/totantstep,totantstep,0, fn)
}
function b_clip(tcurr,rcurr,bcurr,lcurr,tperstep,rperstep,bperstep,lperstep,totantstep,antstep, fn){
	tcurr=tcurr+tperstep; rcurr=rcurr+rperstep
	bcurr=bcurr+bperstep; lcurr=lcurr+lperstep
	this.clipTo(tcurr,rcurr,bcurr,lcurr)
	if(antstep<totantstep){
		this.clipactive=true
		antstep++
		setTimeout(this.obj+".clip("+tcurr+","+rcurr+","+bcurr+","+lcurr+","+tperstep+","
			+rperstep+","+bperstep+","+lperstep+","+totantstep+","+antstep+",'"+fn+"')", 40)	
	}else{
		this.clipactive = false
		eval(fn)
	}
}
/******************************************************************************
Initiating the page and the clip objects.
******************************************************************************/	
function spotInit(){
	pageWidth = (bw.ns4 || bw.ns6)?innerWidth:document.body.clientWidth;
	pageHeight = (bw.ns4 || bw.ns6)?innerHeight:document.body.clientHeight;
	oExCont = new makeObj('divExCont')
	if (bw.dom || bw.ie4){
		oExCont.css.width = pageWidth+px
		oExCont.css.height = pageHeight+px
	}

	oCircle = new makeObj('divCircle','divExCont')
	oExCont.clipTo(sStarty,sStartx+sCircleWidth,sStarty+sCircleHeight,sStartx)
	oCircle.css.left = (sStartx-sCircleWidth/2)+px
	oCircle.css.top = (sStarty-sCircleWidth/2)+px
	oCircle.css.visibility = "visible"
	oCircle.css.width = sCircleOutWidth
	if (bw.ns4)document.captureEvents(Event.MOUSEMOVE)
	document.onmousemove = moveCircle;

//  These magic numbers set the maximum stimuli size -ROM
	stimulusLeft = document.getElementById('stimulus').offsetLeft;
	stimulusTop = document.getElementById('stimulus').offsetTop;
	stimulusRight = stimulusLeft + 1440;
	stimulusBottom = stimulusTop + 1200;
	startTime = new Date().getTime();
	startRecording();
	
	buttonX = document.getElementById('button').offsetLeft;
	buttonY = document.getElementById('button').offsetTop;
}
function moveCircle(e){
	x = (bw.ns4 || bw.ns6)?e.pageX:event.x
	y = (bw.ns4 || bw.ns6)?e.pageY:event.y

   pageWidth = (bw.ns4 || bw.ns6)?innerWidth:document.body.clientWidth;
	pageHeight = (bw.ns4 || bw.ns6)?innerHeight:document.body.clientHeight;
	if (bw.dom || bw.ie4){
		oExCont.css.width = pageWidth+px
		oExCont.css.height = pageHeight+px
	}
	
	if (x+sCircleOutWidth/2 >= pageWidth) oCircle.css.width = sCircleOutWidth - (x + sCircleOutWidth/2 - pageWidth);
	else oCircle.css.width = sCircleOutWidth;
	
	oExCont.clipTo(y-sCircleHeight/2, x+sCircleWidth/2, y+sCircleHeight/2, x-sCircleWidth/2);
	oCircle.css.left = x - sCircleOutWidth/2 + px
	oCircle.css.top = y - sCircleOutHeight/2 + px
	
	mouseX = x;
	mouseY = y;
	
	if(mouseX > buttonX && mouseX <= (buttonX + 80*buttonsNum) && mouseY > buttonY && mouseY <= (buttonY + 80*buttonsNum)) {
      oCircle.css.cursor = "pointer";
   }
   else {
      oCircle.css.cursor = "auto";
   }
}
//This is being called when someone clicks the circle.
function showCont(){

	//Added by Michael
	if(mouseX > buttonX && mouseX <= (buttonX + 80*buttonsNum) && mouseY > buttonY && mouseY <= (buttonY + 80*buttonsNum))
	{
	    for(var v=1;v<=buttonsNum;v++){
		if(mouseX <= (buttonX+80*(v)) && mouseX >= (buttonX+80*(v-1))){
		document.mainForm.click.value = btns[v];
		}
		}
		clearInterval(intervalId);
		setFormValues();
		document.forms.mainForm.submit();
	}
}

if (bw.bw) onload = spotInit



//Added by Michael ------------------------------------
function setFormValues()
{	

	document.forms.mainForm.moves.value = moves;	
}
function recordData()
{
	now = new Date().getTime(); 
	time = now - startTime; 
		
	stimulusMouseX = mouseX - stimulusLeft;
	stimulusMouseY = mouseY - stimulusTop;
	if(stimulusMouseX > 0 && stimulusMouseY > 0 && mouseX < stimulusRight && mouseY < stimulusBottom)
		moves += stimulusMouseX + ',' + stimulusMouseY +  ',' + time + ';';	
}
function startRecording()
{
	intervalId = setInterval('recordData()',recordTimeout);		
}