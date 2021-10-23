<?php



class Database{

    public $server    ="localhost";
    public $userName  ="root";
    public $password  ="";
    public $dbName    ="blog_oop";
    public $con       = null;


    function __construct(){


        $this->con=mysqli_connect($this->server,$this->userName,$this->password,$this->dbName);

        if(! $this-> con){
            echo mysqli_connect_error();
        }



    }


    function DoQuery($sql){
        $result = mysqli_query($this->con,$sql);

        return $result;

    }


    function __destruct(){
        mysqli_close($this->con);
    }


}




?>