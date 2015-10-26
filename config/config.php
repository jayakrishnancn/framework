<?php

if( (!defined("BASEPATH") ) || (!defined("ABSPATH")) )
		die("no direct script allowed [RCFCL4IG]");


$config['DEBUG']=false;
$config['showlog']=true;

$config['apps']=ABSPATH."/apps";
$config['config']=ABSPATH."/config";
$config['security']=ABSPATH."/security";

$config['model']=ABSPATH."/apps/model";
$config['controller']=ABSPATH."/apps/controller";
$config['view']=ABSPATH."/apps/view";

$config['js']=BASEPATH."/apps/js";
$config['css']=BASEPATH."/apps/css"; 
$config['images']=BASEPATH."/apps/images";

/* these pages will shown
* without token in url 
*starting with tokenblahlbah showld be an 1-D array
*/

$config['unsecuredpages']=["all"];

require_once $config['config']."/function.php";
require_once $config['config']."/class.php";

ini_set('display_errors',$config['DEBUG']);
