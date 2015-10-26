<?php
 
 define("DBVERSION","1.0");
class Db
{
	protected $DbConn;
	protected $DbName;
	protected $ServerName;
	protected $DbUsername;
	protected $DbPassword;
	public $MultipleConn;	


	function __construct( $TempName='',$Tmp_MulConn='no' )
	{
		$Tmp_MulConn=strtolower($Tmp_MulConn);
		if( ($Tmp_MulConn=='yes')||($Tmp_MulConn=='true') )
			$this->MultipleConn=True;
		else $this->Tmp_MulConn=false;
		$this->DbName=$TempName; 
		log_info("info","<br/>------------------<br/> DbName initilized (".$this->DbName.") [ Db ~ constructor call --- ".__LINE__."----  ] ");
	}

	/*
	*
	*
	*
		create connection
	*---------------------------
	*
	*
	*/
 protected function CreateConn($ServerName='localhost',$DbUsername='root',$DbPassword='',$DbName='')
	{
		if( isset($DbName) && (!empty($DbName) ) ) $this->DbName=$DbName;

		if ((!$this->DbConn)||($this->MultipleConn==TRUE))
		{
			$this->DbConn =new mysqli($ServerName, $DbUsername, $DbPassword, $this->DbName);
			if ($this->DbConn->connect_error) {
				log_info("error","Connection failed [ Db ~ CreateConn  --- ".__FILE__."::".__LINE__."::---- ] [ ". $this->DbConn->connect_error." ] ");
				die("Connection failed: " . $this->DbConn->connect_error);
				} 
			else{
				log_info("info","Db Connection to ".$this->DbName." is successful [ Db ~ CreateConn  --- ".__FILE__."::".__LINE__."::---- ]"); 
				return $this->DbConn;
			}
		}
			else {
				log_info("error","Db {".$this->DbName."}  Connection already exist [ Db ~ CreateConn  --- ".__FILE__."::".__LINE__."::---- ]"); 
				return false;
			}
 	}

	//CreateConn() ends
	/*
	*
	*
	*
	*  close Db
	*---------------------------
	*
	*
	*/
 protected function CloseConn()
 	{
		$this->DbConn->close();
		log_info("info","connection closed[ Db ~ Query [db:".$this->DbName."] --- ".__FILE__."::".__LINE__."::---- ]");	

	}


	/*
	*
	*
	*
		create a Query 
	*	arguments "sql stmts"
	*---------------------------
	*
	*
	*/

 public function Query($sql='_temp_default')
 { 
 	if(strlen($this->DbName)<=0){
		log_info("error","Query Failed NO Db Selected  [ Db ~ Query  --- ".__FILE__."::".__LINE__."::---- ]");	
 		return false;
 	}
 	if($sql!='_temp_default'){
		if (!$this->DbConn) 
		$this->CreateConn();
		$Result=$this->DbConn->query($sql) ;
		log_info("info","Query Successful  {".$sql."  }[ Db ~ Query [db:".$this->DbName."] --- ".__FILE__."::".__LINE__."::---- ]");	
	
		return $Result;	

	}
	else {//no arguments
		log_info("error","Query sql arg not found in {".$this->DbName."  }[ Db ~ Query  --- ".__FILE__."::".__LINE__."::---- ]");	
		return false;
	}
}//end of Query function

	/*
	*
	*
	*
		create a Database 
	*	arguments "table name"
	*---------------------------
	*
	*
	*/
 function CreateDb($DbName='_temp_default')
 	{
 		if($DbName!='_temp_default')
		{

			if (!$this->DbConn) 
			$this->CreateConn();
			$sql = "CREATE DATABASE $DbName";
			if ($this->Query($sql)){
				log_info("info"," Db{ $DbName } Created Successfully[Db ~ CreateDb  --- ".__FILE__."::".__LINE__."::---- ]");
				return true;
			}	
			else {
				log_info("error"," Db $DbName Creation Failed [Db ~ CreateDb  --- ".__FILE__."::".__LINE__."::---- ][ ".$this->DbConn->error." ]");
				return false;
			}
		}	
		else {
			log_info("error","Db Name not specified [ Db ~ CreateDb  --- ".__FILE__."::".__LINE__."::---- ] ");	
			return false;
		}
 	}

	//CreateDb() ends



/*
	*
	*
	*
		Select  a Table 
	*	arguments "table name, condition"
	*---------------------------
	*
	*
	*/ 
	 function Select($TableName="_temp_default",$Conditions='_tmp_default')
	{
		if($TableName!='_temp_default'){
			if($Conditions=='_tmp_default')$Conditions="";
			log_info("info","Selecting..[ Db ~ Select  --- ".__FILE__."::".__LINE__."::---- ] ");
			return $this->Query("SELECT * FROM ".$TableName." ".$Conditions);
		}//end of if($TableName!='_temp_default')
		else{
			log_info("error","TableName Not specified [ Db ~ Select   --- ".__FILE__."::".__LINE__."::---- ]");	
			return false;
		}//end of else ($TableName!='_temp_default')

	}//end of Select function

/*
	*
	*
	*
		Delete a Database 
	*	arguments "table name"
	*---------------------------
	*
	*
	*/ 
	 function Delete($TableName="_temp_default",$Conditions='_tmp_default')
	{
		if($TableName!='_temp_default'){
			if($Conditions=='_tmp_default')$Conditions=" ";
			log_info("info","Deleting..[ Db ~ Delete  --- ".__FILE__."::".__LINE__."::---- ] ");
			return $this->Query("DELETE  FROM ".$TableName." ".$Conditions);
		}//end of if($TableName!='_temp_default')
		else{
			log_info("error","TableName Not specified [ Db ~ Delete --- ".__FILE__."::".__LINE__."::---- ] ");	
			return false;
		}//end of else ($TableName!='_temp_default')

	}//end of delete function

/*
	*
	*
	*
		Drop table  
	*	arguments "table name"
	*---------------------------
	*
	*
	*/ 
	 function DropTable($TableName="_temp_default")
	{
		if($TableName!='_temp_default'){
			log_info("info","Table Droping...[ Db ~ DropTable  --- ".__FILE__."::".__LINE__."::---- ] ");
			return $this->Query("DROP TABLE  ".$TableName." ");
		}//end of if($TableName!='_temp_default')
		else{
			log_info("error","TableName Not specified [ Db ~ DropTable  --- ".__FILE__."::".__LINE__."::---- ] ");	
			return false;
		}//end of else ($TableName!='_temp_default')

	}//end of TableDrop function



/*
	*
	*
	*
		Trunc table  
	*	arguments "table name"
	*---------------------------
	*
	*
	*/ 
	 function TruncTable($TableName="_temp_default")
	{
		if($TableName!='_temp_default'){
			log_info("info","Table TRUNCATING...[ Db ~ TruncTable --- ".__FILE__."::".__LINE__."::---- ] ");
			return $this->Query("TRUNCATE  TABLE  ".$TableName." ");
		}//end of if($TableName!='_temp_default')
		else{
			log_info("error","TableName Not specified [ Db ~ TruncTable  --- ".__FILE__."::".__LINE__."::---- ] ");	
			return false;
		}//end of else ($TableName!='_temp_default')

	}//end of TruncTable function
		function __destruct() {
			
		 
		}


/*
	*
	*
	*
		create Column  
	*	arguments "table name" , type
	*---------------------------
	*
	*
	*/ 
	 function CreateColumn($TableName="_temp_default",$ColumnName='_temp_default',$Type='int(10) NOT NULL')
	 {
		if( ($TableName!='_temp_default')&&($ColumnName!='_temp_default')){
			if($this->Query("select $ColumnName from $TableName")!=false) 
				return false;
			else{
				log_info("info","create Column...[ Db ~ CreateColumn --- ".__FILE__."::".__LINE__."::---- ] ");
				return $this->Query("ALTER TABLE ".$TableName." ADD ".$ColumnName." ".$Type);
			}
		}//end of if($TableName!='_temp_default')
		else{
		log_info("error","TableName /column Not specified [ Db ~ CreateColumn  --- ".__FILE__."::".__LINE__."::---- ] ");	
		return false;
		}//end of else ($TableName!='_temp_default')




	 }
		

}///end of class Db


?>