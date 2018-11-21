<?php
//Database
class DB{

    static $link;

    static function connect(){
      if(self::$link = mysqli_connect("localhost","root","","multiform")){
        return self::$link;
      } else {
        die('could not connect to db');
      }
    }
  
    static function getcon(){
      return isset(self::$link) ? self::$link : self::connect();
    }
    /*public $con;
    public $error;
    
    protected static $db;

    public function __construct()
    {
        $db="";
    }

    public static function getDB()
    {
        if (!isset(self::$db)) {
            self::$db = new mysqli("localhost","root","","multiform");

            if ($db->connect_error) {
                die("<pre>Unable to connect to the MySQL Server -> $db->connect_error</pre>");
            }
            else{
                echo "connected";
            }
        }
        return self::$db;
    }
   /* public static function getDBConnection()
    {
        if (!isset(self::$con)) {
            self::$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if ($db->connect_error) {
                die("<pre>Unable to connect to the MySQL Server -> $db->connect_error</pre>");
            }
        }
        $this->con = mysqli_connect("localhost", "root", "", "multiform");
        if(!$this->con)
        {
        echo 'Database Connection Error' . mysqli_connect_error($this->con);
        }
        else{
            //echo "no db error";
            return $this->con;
        }
    }*/
}
?>