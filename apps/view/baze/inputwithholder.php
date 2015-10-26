
<div id="inputholder" class="inputholder inp inp-blue">
  <input type="text" id="inputtext" autofocus/>
</div>

<script type="text/javascript" src="<?php echo $config['js']."/vendors/jquery/jquery2.js";?>"></script>
<script type="text/javascript">

$("#inputholder input").focus(function(){ 
  $("#inputholder").addClass(" active");
    event.stopPropagation();
    return false;
});

$("#inputholder input")[0].onblur=(function(){ 
  $("#inputholder").removeClass("active");
});

$("#inputholder").click(function(e){
  $("#inputholder input").focus();
  $("#inputholder").addClass(" active");
    event.stopPropagation();
});  


$("#inputtext").keydown(function(e){
  this.style.width = ((this.value.length + 1)*9 ) + 'px';
  var valueofinput= this.value;
  if(e.which==13 && valueofinput && (valueofinput.trim()!= "") ){
     $('#inputtext').before('<div class="tag">' + valueofinput + '<span>x</span></div>');
    $('input').val('');
  }
var  key=  e.keyCode || e.charCode;
if(key==8){
       $('#inputholder .tag:last-of-type').remove();
}

});

$('html').click(function() { 
  $('#inputholder .tag span').click(function(){
       this.parentNode.remove();
  $("#inputholder").removeClass("active");
    });
});
</script>
