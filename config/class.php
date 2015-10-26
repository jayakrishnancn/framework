<?php

if( (!defined("BASEPATH") ) || (!defined("ABSPATH")) )
		die("no direct script allowed [RCFCL4SS]");

log_info("info","class opened");

/*

core classes

*/



class errorcontroller
{
	public function error($msg="")
	{
		echo "an error occured error ".$msg;
		die();
	}
	public function __construct()
	{
		log_info("info","errorcontroller initialized");
	}

}


class controller{
	protected  $controller="home";

	protected  $method="index";


	protected  $param=[];

	public $url="home/index";
	public function __construct(){

		log_info("info","controller initialized");
		global $config;
		$url=parseurl();

		if(file_exists($config['controller'].'/'.$url[0].'.php'))
		{
			$this->controller=$url[0];
		}
			unset($url[0]);

		require_once $config['controller'].'/'.$this->controller.'.php';
		log_info("info","$this->controller included");
		$this->controller=new $this->controller;
		log_info("info","main controller object created");

		
		if(isset($url[1]))
			if(! (method_exists($this->controller,$url[1]) && parent_method_exists($this->controller,$url[1])) )
			{
				if(method_exists($this->controller,$url[1]))
				$this->method=$url[1];
				log_info("info","$url[1] exist");
			}
		unset($url[1]);

		$url=array_filter($url);
		$this->param=$url?array_values($url):[];

		$this->controller->{$this->method}($this->param);

	}





	protected function defaultmetas()
	{
	$meta['name="viewport"']='content="width=device-width, initial-scale=1.0"';
	$meta['charset="UTF-8"']=' ';
	return $meta;
	}

	protected function defaultcss()
	{
		global $config;
		$css=null;
	return $css;
	}

	protected function defaultjs()
	{
		global $config;
		$js=null;
	return $js;
	}

	public function view($url=[],$data=[])
	{
 
		global $config;
		$urltoken=$this->urltoken();

		if(isset($data))
				foreach ($data as $key => $value) {
							$$key=$value;
				}

		foreach ($url as $value)
			{

				if(file_exists($config['view']."/".$value.".php")){
					include_once $config['view']."/".$value.".php";


				}
				else log_info("error","$value not found");
			}
	}


	public function  model($model)
	{
		global $config;
		require_once "{$config['model']}/{$model}.php";
		return new $model();
	}

	protected function urltoken()
	{ 
		$tmpsecurity=new security;
		$this->urltoken=$tmpsecurity->securitytoken_coin; 
		return $_SESSION[$this->urltoken];
	}

}


class model
{

}
