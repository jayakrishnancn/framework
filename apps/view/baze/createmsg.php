<style type="text/css">
    
/* create msg (gmail like) */.createmsg{width:80%;max-width:500px;background:#f5f5f5;position:fixed;bottom:-1px;right:3%;margin:0;border-left:1px solid #ccc;border-bottom:1px solid #ccc;border-right:1px solid #ccc;-webkit-box-shadow:0 0 60px #aaa;-moz-box-shadow:0 0 60px #aaa;-o-box-shadow:0 0 60px #aaa;box-shadow:0 0 60px #aaa;z-index:10}.createmsg.min{height:30px;width:180px;-webkit-box-shadow:0 0 0 transparent;-moz-box-shadow:0 0 0 transparent;-o-box-shadow:0 0 0 transparent;box-shadow:0 0 0 transparent}.createmsg.max{width:80%;max-width:900px;height:375px;background:#f5f5f5;left:0;right:0;top:0;bottom:0;margin:auto;-webkit-box-shadow:0 0 60px #aaa;-moz-box-shadow:0 0 60px #aaa;-o-box-shadow:0 0 60px #aaa;box-shadow:0 0 60px #aaa}.createmsg.min:hover h1{background:#111}.createmsg.max h1 .heading{width:95%;max-width:840px}.createmsg h1{color:#fff;background:#333;font-size:15px;line-height:20px;padding:5px 10px;font-family:sans-serif;margin:0;cursor:pointer}.createmsg h1 .heading{width:100%;max-width:475px}.createmsg.min h1 .heading{width:120px}.createmsg h1 div.box-control{text-align:left;display:inline-block;margin:0;position:relative;float:right;width:5%;min-width:40px}.createmsg h1 .close{color:#fff;padding:0 5px;background:0 0;margin:0;position:relative}.createmsg.min .close{display:none}.createmsg .close,.createmsg:hover .close{display:block}.createmsg h1 .close:hover{color:#ccc;background:#4f4f4f}.createmsg h1 .close .info{display:none;left:-100%;margin:-35px -10px;width:60px;text-align:center}.createmsg h1 .close:hover .info{display:block}.bold{font-weight:700}.msg-input{width:100%;outline:0;padding:10px;margin:0;color:#999;background:#fff;border:none;border-bottom:1px solid #ccc;font-size:13px;font-family:sans-serif;position:relative;line-height:20px}.msg-input:focus{color:#333}.createmsg form{margin:0;padding:0}textarea.msg-input{height:210px;resize:none}.createmsg .msg-footer{background:#f5f5f5;padding:10px;text-align:right}.info-container:hover>.info,.info-container:hover + .info {
    display: block;
}
div.info {
    padding: 5px 10px;
    font-size: 13px;
    line-height: 13px;
    position: absolute;
    margin: -35px auto;
    display: none;
    z-index: 2;
}
/* color */

.info.black {
    background-color: #111;
    border: 1px solid #fff;
}
/* dim position */

.info.down {
    margin: 35px auto;
}
.info.up {
    margin: -35px auto;
}
.info.left {
    margin: -5px -100%;
}
.info.right {
    margin: -5px 100%;
}
/* arrows */

.info:after,
.info:before {
    border: solid transparent;
    content: " ";
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
}
/* */

.info:after {
    border-color: rgba(0, 0, 0, 0);
    border-width: 5px;
}
.info:before {
    border-color: rgba(255, 255, 255, 0);
    border-width: 7px;
}
/* arrow down */

.info.up:after,
.info.up:before {
    top: 100%;
    left: 50%;
}
.info.up:after {
    border-top-color: #111111;
    margin-left: -5px;
}
.info.up:before {
    border-top-color: #ffffff;
    margin-left: -7px;
}
/* arrow up */

.info.down:after,
.info.down:before {
    bottom: 100%;
    left: 50%;
}
.info.down:after {
    border-bottom-color: #111111;
    margin-left: -5px;
}
.info.down:before {
    border-bottom-color: #ffffff;
    margin-left: -7px;
}
/* arrow left */

.info.right:after,
.info.right:before {
    top: 10px;
    right: 100%;
}
.info.right:after {
    border-right-color: #111111;
    margin-top: -5px;
}
.info.right:before {
    border-right-color: #ffffff;
    margin-top: -7px;
}
/* arrow right */

.info.left:after,
.info.left:before {
    top: 10px;
    left: 100%;
}
.info.left:after {
    border-left-color: #111111;
    margin-top: -5px;
}
.info.left:before {
    border-left-color: #ffffff;
    margin-top: -7px;
} .close{color:#ccc;font-family:sans-serif;font-size:15px;line-height:20px;cursor:pointer;padding:10px;float:right}
.close:active,.close:focus,.close:hover,.close:visited{color:#333}

</style> 
<!-- createmsg -->
<div id="createmsg" class="createmsg min">  
<h1>
    <div class="box-control ">
        <div id="close" class="close info-container">
            <div class="info black up">Close</div>
        x</div>
        <div id="max" class="close info-container">
            <div class="info black up">maximze</div>
        []</div>
    </div><!-- box-control  -->
<div class="heading">
 Create msg
</div>
</h1><!-- h1 -->

<div class="msg-container">
<form action="?" method="post">
    <input class="msg-input bold" name="to" value="" placeholder="To :">
    <input class="msg-input bold" name="subject" value="" placeholder="Subject :">
    <textarea class="msg-input "  name="text" placeholder="Message :"></textarea>
    </div><!-- msg-container  -->
    <div class="msg-footer ">
        <button class="bu1 bu-blue">Send</button>
    </div>
</form>
</div>
<!-- createmsg  ends-->
   


<script type="text/javascript">

    var x = $('#createmsg')[0];
    var max_min_btn=$('#createmsg #max')[0];
function maxmin(){  
    if(!x.classList.contains("max"))
        max_min_btn.innerHTML="[]";
    else max_min_btn.innerHTML="-";
    return;
}
$('#createmsg h1 .heading').click(function(e){
    $('#createmsg').toggleClass(' .createmsg min','createmsg');
    maxmin();
});
$('#createmsg #max').click(function(){
    $('#createmsg').toggleClass(' .createmsg max','createmsg');
    maxmin();
});
$('#createmsg #close').click(function(){
    $('#createmsg').remove();
});


</script>   