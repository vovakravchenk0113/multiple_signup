<?php
//Database
class DB{

    static $link;

    static function connect(){
        try {
            if(self::$link = @mysqli_connect("localhost","root","","multiform1")){
                return self::$link;
              } else {
                error_reporting(0);
                die("Error: Unable to connect to Server." . PHP_EOL);
              }
          }
          catch(Exception $e) {
            die("Error: Unable to connect to Server." . PHP_EOL);
          }
      
    }
  
    static function getcon(){
      return isset(self::$link) ? self::$link : self::connect();
    }
}
?>