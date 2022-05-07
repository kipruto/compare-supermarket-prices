<?php 
require_once './includes/header.php';

$id = isset($_GET['id']) ? $_GET['id'] : false;

class getrecipeID
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
    public function fetchrecipe($id)
    {
     
        $sql = "SELECT *  FROM $this->tablename WHERE id=$id";

        $result = mysqli_query($this->conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            die("error found nothing");
        }
      
    }
   
}


?>
   
    <!------------------------------------------------ COMPARE SECTION --------------------------------------------------------->
    <section>
      <div class='header-strip'>
        <div class="head-text">
          <div class='border-boxx'>
          <h2>Delicious Snacks & Vegan Recipes </h2>
          </div>
        </div>
   
        <div class='cartdropdown-box'>

    
        </div>
      </div>
    </section>
    <section class="products">
      <div class="container ">
        <div class="row">



            <?php
           $details = new getrecipeID();
           $result = $details->fetchrecipe($id);
            while ($row = mysqli_fetch_assoc($result)) {
                viewrecipeelement($row['id'], $row['image'], $row['name'], $row['ingredients'], $row['instructions'], $row['nutrition facts'], $row['time']);
            }
            ?>

        
            </div>
            </div>
    </section>


    <?php 
require_once './includes/footer.php';
?>