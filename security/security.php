<?php 

/*
*	session
*------------------
*
*
*/


 
function is_session_started()
{
    if ( php_sapi_name() !== 'cli' ) {
        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        } else {
            return session_id() === '' ? FALSE : TRUE;
        }
    }
    return FALSE;
}  
if ( is_session_started() === FALSE ){ 
		session_start();
		log_info("info","new session started");
}




/*
*	to prevent Session Stealing with javascript
*/
ini_set('session.cookie_httponly', 1); 
		log_info("info","session.cookie_httponly set to 1");

 


/*  session start here */  





/*
*	to prevent Session Fixation
*  regenerate sessionid each  20 request (counted bcoz if freq used may lead to over head and slow the web )
*
*/
    if(!isset($_SESSION['session_request_count']))$_SESSION['session_request_count'] = 0;

if (++$_SESSION['session_request_count'] >= 10) {
    $_SESSION['session_request_count'] = 0;
    session_regenerate_id(true);
		log_info("info","session_request_count set to 0 and id regenerated ");
}
		log_info("info","session_request_count increased to ".$_SESSION['session_request_count']." ");
 


 


class security{
	/**
	 * List of never allowed strings
	 *
	 * @var	array
	 */
	protected $_never_allowed_str =	array(
		'document.cookie'	=> '[removed]',
		'document.write'	=> '[removed]',
		'.parentNode'		=> '[removed]',
		'.innerHTML'		=> '[removed]',
		'-moz-binding'		=> '[removed]',
		'<!--'				=> '&lt;!--',
		'-->'				=> '--&gt;',
		'<![CDATA['			=> '&lt;![CDATA[',
		'<comment>'			=> '&lt;comment&gt;'
	);

	/**
	 * List of never allowed regex replacements
	 *
	 * @var	array
	 */
	protected $_never_allowed_regex = array(
		'javascript\s*:',
		'(document|(document\.)?window)\.(location|on\w*)',
		'expression\s*(\(|&\#40;)', // CSS and IE
		'vbscript\s*:', // IE, surprise!
		'wscript\s*:', // IE
		'jscript\s*:', // IE
		'vbs\s*:', // IE
		'Redirect\s+30\d',
		"([\"'])?data\s*:[^\\1]*?base64[^\\1]*?,[^\\1]*?\\1?"
	);

	protected $urltoken;
	protected $utltoken_coin="utltoken_coin";

	protected $cookietoken;
	public    $cookietoken_coin="cookietoken_coin";
	
	protected $securitytoken;
	public    $securitytoken_coin="securitytoken";
	protected $securitytoken_time;// 1 min
	protected $securitytoken_path="/";

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{ 

		log_info("info","security opened");  
		$this->securitytoken_time=time()+60*1;
		$this->securitytoken="token".randstring(10) ;// 1min
		$this->urltoken();


		$this->verifyUrl(); 
	}

// --------------------------------------------------------------------

	/**
	 * Do Never Allowed
	 *
	 * @used-by	CI_Security::xss_clean()
	 * @param 	string
	 * @return 	string
	 */
	protected function _do_never_allowed($str)
	{

		$str = str_replace(array_keys($this->_never_allowed_str), $this->_never_allowed_str, $str);

		foreach ($this->_never_allowed_regex as $regex)
		{
			$str = preg_replace('#'.$regex.'#is', '[removed]', $str);
		}

		return $str;
	}

protected function urltoken()
{


			$tmpurl=isset($_GET['url'])? strip_tags($_GET['url']) :"home/index";   
			$tmpurl=explode('/',filter_var(rtrim($tmpurl, FILTER_SANITIZE_URL)));

			foreach ($tmpurl as  $value) 
			{
				if(preg_match("'token'",$value)){
					$this->urltoken=$value;
					return $this->urltoken;
				}
			}
			return false;
}


	public function verifyUrl()
	{ 
		global $config;
		$unsecuredpages=$config['unsecuredpages'];
		$tmpinarray=true;
		if(!isset($_SESSION[$this->securitytoken_coin]))
		{
			$_SESSION[$this->securitytoken_coin]=$this->securitytoken; 
		} 

		if(strtolower($unsecuredpages[0])!="all")
		{
			$tmpinarray=in_array(parseurl()[0],$unsecuredpages);
		} 
		if (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET' &&  (!$tmpinarray)  )
		{ 
			$this->cookietoken=session("securitytoken");  
			if(!(isset($this->urltoken, $this->cookietoken) && ($this->urltoken==$this->cookietoken)) )			
			{ 
					die("[Security Guard] authentication problem (token missing) click  <a href='".BASEPATH."'>here</a> to go home ");
			}
		}

	} 

 


}//end class security