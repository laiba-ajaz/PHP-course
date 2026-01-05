<?php

class Database{
public $conn;

public function __construct(){

    $this ->conn = new mysqli("localhost" , "root" ,"", "blog_application");
     if ($this->conn->error) {
            die("DB ERROR");
        }
}

}

?>