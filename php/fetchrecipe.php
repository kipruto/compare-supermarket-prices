<?php


class getRecipe
{
    public $servername;
    public $password;
    public $dbname;
    public $username;
    public $conn;
    public $tablename;

    public function __construct(  
        
        $servername = "localhost",
        $password = "seansmith",
        $dbname = "website",
        $username = "seansmith",
        $tablename = "recipe"
  
    ) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        $this-> tablename = $tablename;

        $this->conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$this->conn) {
            die("connection failed " . mysqli_connect_error());
        }
    }
    public function fetchrecipe()
    {
        $sql = "SELECT * FROM $this->tablename";

        $result = mysqli_query($this->conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            die("error found nothing");
        }
      
    }
   
}



