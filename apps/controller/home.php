<?php 
/**
* 
*/



class home extends controller
{
	function __construct()
	{
	  log_info("info","Home initiated");
	}
 

	public function index($url="error")
	{ 
	  log_info("info","home index started");

		global $config;
		$title="title";
	
		$meta['name="og:description"']='content="Achayans Homestay" /';
		$meta['name="og:url"']='content="'.BASEPATH.'/" /';
		$meta['name="og:image"']='content="'.$config['images'].'/fb-post.jpg" /'; 

		$css=["vendors/normalize/normalize.css","style.css"];

		$css=assigndir($config["css"],$css);

	$data["css"]=$css; 
	$data["title"]=$title;
	$data["meta"]=$meta;  
	/*

	do not change  ends 
	*/  
$url=["head","topnav","home","footer"];

		$this->view($url,$data);		
	}
	
/*
		end view method

*/




	public function error($url='404')
	{
		global $config;
		if(file_exists($config['view']."/404.php"))
			include_once $config['view']."/404.php";
	}
	
 
}