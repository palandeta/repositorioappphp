<?php
class Database 
{
	/*
	private static $dbName = 'productos' ; 
	private static $dbHost = 'mysql23669-pablo.jl.serv.net.mx' ;
	private static $dbUsername = 'root';
	private static $dbUserPassword = 'ATCoch59681';
	*/
	private static $dbName = 'sampledb' ; 
	private static $dbHost = '10.129.68.32' ;
	private static $dbUsername = 'pablo';
	private static $dbUserPassword = 'Pablolandeta2018';
	
	private static $cont  = null;
	
	public function __construct() {
		exit('Init function is not allowed');
	}
	
	public static function connect()
	{
	   // One connection through whole application
       if ( null == self::$cont )
       {      
        try 
        {
          //self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);  
		self::$cont =  new PDO( "pgsql:host=$dbHost;port=5432;dbname=$dbName;user=$dbUsername;password=$dbUserPassword");
        }
        catch(PDOException $e) 
        {
          die($e->getMessage());  
        }
       } 
       return self::$cont;
	}
	
	public static function disconnect()
	{
		self::$cont = null;
	}
}
?>
