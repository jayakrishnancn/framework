 progress-bar<br/>
	bar red 
<div class="progress-bar">
	<div class="bar red" ><span class="bar-text">45%</span></div>
</div>
	<br/>
	bar red stripe
<div id="k" class="progress-bar ">
	<div class="bar red stripe" style="width:45%"><span class="bar-text">45%</span></div>
</div>


	<!--blue-->
	<br/><br/>
	bar blue
<div class="progress-bar">
	<div class="bar blue" style="width:45%"><span class="bar-text">45%</span></div>
</div>
	<br/>
	bar blue stripe
<div class="progress-bar ">
	<div class="bar blue stripe" style="width:45%"><span class="bar-text">45%</span></div>
</div>


	<!--green-->
	<br/><br/>
	bar green
<div class="progress-bar">
	<div class="bar green" style="width:45%"><span class="bar-text">45%</span></div>
</div>
	<br/>
	bar green stripe
<div class="progress-bar ">
	<div class="bar green stripe" style="width:45%"><span class="bar-text">45%</span></div>
</div>


	<!--orange-->
	<br/><br/>
bar orange	
<div class="progress-bar">
<div class="bar orange" style="width:45%"><span class="bar-text">45%</span></div>
</div>
	<br/>
	bar orange stripe
<div class="progress-bar ">
	<div class="bar orange stripe" style="width:45%"><span class="bar-text">45%</span></div>
</div>


	<!--black-->
	<br/><br/>
	bar black
<div class="progress-bar">
	<div class="bar black" style="width:45%"><span class="bar-text">45%</span></div>
</div>
	<br/>
	bar black stripe
<div class="progress-bar ">
	<div class="bar black stripe" style="width:45%"><span class="bar-text">45%</span></div>
</div>
 

 </div>

<button onclick="myFunction()">Try it</button> 
<script type="text/javascript"> 
    	var bar=document.querySelector('#k .bar'); 
    	if( !(parseInt(bar.style.width)>0 && parseInt(bar.style.width)<100))
    		bar.style.width=0;
    	bar.children[0].innerHTML=parseInt(bar.style.width)+"%";
    	window.onload=(myFunction());
function myFunction() {
    setTimeout(function(){
    	curw=parseInt(bar.style.width);
    	if(curw<=100)bar.children[0].innerHTML=curw+"%";else bar.children[0].innerHTML="100%";
    	bar.style.width=(curw+1)+"%"; 
    	if(curw<=100)myFunction(); 
    }, 100);
}


</script> 
