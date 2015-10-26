<?php 

if( (!defined("BASEPATH") ) || (!defined("ABSPATH")) )
		die("no direct script allowed [RCFFL4IN]");
/*

common core  functions 

*/




function echoarray($arr=[])
{
if(!empty($arr))
	if(is_array($arr))
		foreach ($arr as  $value) 
			echo $value;
	else echo $arr;

}




function log_info($info="error",$msg=" - ")
{
	global $config;
	if($config['DEBUG'] && $config['showlog'])echo $info." : ".$msg."<br/>\n";
}



function assigndir($dir="",$variable=[])
{
	global $config; 
	if(!empty($variable))
	{
		foreach ($variable as $key => $value) 
		{ 
			$variable[$key]=$dir."/".$value;
		} 	
		return $variable;
	}
}



function parent_method_exists($object,$method)
{
    foreach(class_parents($object) as $parent)
    {
        if(method_exists($parent,$method))
        {
           return true;
        }
    }
    return false;
}



	function parseurl()
	{

	$url=isset($_GET['url'])? strip_tags($_GET['url']) :"home/index";
	$url=explode('/',filter_var(rtrim($url, FILTER_SANITIZE_URL)));
	$url=array_filter($url);
	$url[1]=isset($url[1])?$url[1]:"index";//method
	$url[2]=isset($url[2])?$url[2]:[];// arg

	return $url;
	}


function session($index=false)
{
	if($index)
	{
		if(isset($_SESSION[$index])  &&  (!empty($_SESSION[$index]))  )
			return $_SESSION[$index]; 
	} 
	
}


function randstring($length="4")
{ 
	return  substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);

}







/*
*	user input validation
*-----------------------
*
*/
function filter_specialchar($var=" "){  
$from=array(
	'!' ,
	'@' , 
	'$' ,
	'%' ,
	'^' , 
	'*' ,
	'(' ,
	')' ,
	'_' ,
	'-' ,
	'+' ,
	'<' ,
	'>' ,
	'?' ,
	'/' ,
	'\\' ,
	'|' ,
	'[' ,
	']' ,
	'{' ,
	'}' ,
	'.' ,
	',' ,
	':' ,
	'"' ,
	"'" ,
	';' ,
	'=' 
	);
$to  =array(
	"&#33;",   /* ! */
	"&#64",	  /* @ */ 
	"&#36",	  /* $ */
	"&#37",	  /* % */
	"&#94",	  /* ^ */ 
	"&#42",	  /* * */
	"&#40",	  /* ( */
	"&#41",	  /* ) */
	"&#95",	  /* _ */
	"&#45",	  /* - */
	"&#43",	  /* + */
	"&#60",	  /* < */
	"&#62",	  /* > */
	"&#63",	  /* ? */
	"&#47",	  /* / */
	"&#92",	  /* \ */
	"&#124",	  /* | */
	"&#91",	  /* [ */
	"&#93",	  /* ] */
	"&#123",	  /* { */
	"&#125",	  /* } */
	"&#46",	  /* . */
	"&#44",	  /* , */
	"&#58",	  /* : */
	"&#34",	  /* " */
	"&#39",	  /* ' */
	"&#59",	  /* ; */
	"&#61"	  /* = */
	);
/*$vars= str_replace($from,$to,$var);*/
if(preg_match("([^a-zA-Z\.@\s&#])",$var))
$var=str_replace($from,$to, $var);

return $var;
}


function saintizeurl($url)
{
	if(isset($url))
		return filter_var(rtrim($url, FILTER_SANITIZE_URL));
	else return false;
}




function encript_it($string=NULL,$salt="3h7lV6CaHP"){

	if(isset($string) && $string!=NULL)
	{
		$string1=substr($string,0,strlen($string)/2) ;
		$string2=substr($string,strlen($string)/2) ;

		$string=$string1.$salt.$string2;
		return  hash("sha1",$string); 
	}
	
	return false;
}


