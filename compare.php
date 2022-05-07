<?php 
require_once './includes/header.php';

$id = isset($_GET['id']) ? $_GET['id'] : false;

class getproductID
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
        $tablename = "foodproducts"
  
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
    public function fetchproducts($id)
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
          <h2>Compare prices between different stores </h2>
          </div>
        </div>
        <div class="btn-cart-wrapper" id="bttn">
        <div class="btn-cart-box">
        <i class="fas fa-shopping-bag"></i>
        <p> Basket</p>
        <div class='counter'><p  class='itemsincart'></p></div>
    </div>
        </div>
        <div class='cartdropdownbox' id="cttn">
        </div>
      </div>
    </section>
    <section class="products">
      <div class="container ">
        <div class="row">


            <?php
           $details = new getproductID();
           $result = $details->fetchproducts($id);
            while ($row = mysqli_fetch_assoc($result)) {
              comparepriceelement($row['id'], $row['product_img'], $row['product_name'], $row['product_desc'], $row['price_morrisons'], $row['price_tesco'], $row['price_ocado'], $row['price_sainsbury']);
            }
            ?>

        
            </div>
            </div>
    </section>


    <?php 
require_once './includes/footer.php';
?>