<div id="ex" style="margin:50px auto;width:200px;text-align:center"> 
<?php 
$files=scandir($config['view']."/baze");
$files[0]=null;
$files[1]=null;
$files=array_filter($files);

foreach ($files as $key=> &$value) {
	$value=explode(".", $value);
	$file[]=$value[0]; 
}

$file=array_filter($file);
foreach($file as $value)
echo "<a href='". BASEPATH."/baze/".$value."/".$urltoken."'>Basze $value</a><br/>";

?></div>