<?php
//Třídá pro snadnější práci s databází
class db
{
	private static $dbPripojeni;
    private static $error;
    private static $sql;
    private static $bind;
    private static $errorCallbackFunction;
    private static $errorMsgFormat;

    public static function pripoj ($adresa) {
        if(!isset(self::$dbPripojeni)){
            self::$dbPripojeni = new PDO("sqlite:$adresa"); 
            self::$dbPripojeni->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            
            
        }
                       
   }
   
   public static function pripojMySQL ($host, $uzivatel, $heslo, $databaze) {
        if(!isset(self::$dbPripojeni)){
            
//                self::$dbPripojeni = new PDO("mysql:host=$host;dbname=$databaze",$uzivatel,$heslo);
                self::$dbPripojeni = new PDO('mysql:host=localhost;dbname='.$databaze,
    $uzivatel,
    $heslo,
    array(
      PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_PERSISTENT => false
    ));
                
        }
                      
   }
    public static function VratVse($dotaz, $param = array()) {
    	$data = self::$dbPripojeni->prepare($dotaz);
    	$data->execute($param);
        return $data->fetchAll();
    }
    public static function VratRadek($dotaz, $param = array()) {
        $data = self::$dbPripojeni->prepare($dotaz);
        $data->execute($param);
        return $data->fetch();
    }
    
    public static function Login ($dotaz,$param = array() ){
        $data = self::$dbPripojeni->prepare($dotaz);
        $data->execute($param);
        return $data->fetch();        
    }
}