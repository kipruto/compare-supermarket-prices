<?php 
require_once './includes/header.php';
?>
    <section>
      <div class='header-strip'>
        <div class="head-text">
          <div class='border-boxx'>
          <h2>Food Section </h2>
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
$servername = "localhost";
$password = "seansmith";
$dbname = "website";
$username = "seansmith";
$tablename = "foodproducts";
$connection = mysqli_connect($servername, $username, $password, $dbname);

$sql = "SELECT * FROM $tablename";
$result = $connection->query($sql);

function sort_pricing($morrisons,$tesco,$ocado,$sainsbury)
{
    $sort_prices = array($morrisons,$tesco,$ocado,$sainsbury);
    // sort the array
    sort($sort_prices);
    $lowest_price=  $sort_prices[0];
    if ($lowest_price == $morrisons) 
    {
        $my_super = "M.png";
        $return_name = array('supermarket' => $my_super,'prices' => $morrisons );        
        return $return_name;
    }
    elseif ($lowest_price == $tesco) 
    {
        $my_super = "T.png";
        $return_name = array('supermarket' => $my_super,'prices' => $tesco );        
        return $return_name;
    }
    elseif ($lowest_price == $ocado) 
    {
        $my_super = "O.png";
        $return_name = array('supermarket' => $my_super,'prices' => $ocado );        
        return $return_name;
    }
    else
    {
        $my_super = "S.png";
        $return_name = array('supermarket' => $my_super,'prices' => $sainsbury );        
        return $return_name;
    }
}

function display_products($id, $product_img, $product_name, $product_desc, $low_names , $lowest_costs)
{
    if ($low_names == "price_morrisons") 
    { 
        $super_logo = "M.png";
    }
    elseif ($low_names == "price_tesco") 
    {
        
        $super_logo = "T.png";
    }
    elseif ($low_names == "price_ocado") 
    {
        $super_logo = "O.png";
    }
    {
        $super_logo = "S.png";
    }

   echo 
    "<div class='product-box col-xs-12 col-md-4 col-lg-3'>
        <a class='fixcomponent' href='./compare.php?id=$id'>
            <div class='product-image'>
                <img src='$product_img' alt=''>
            </div>
            <div class='product-info'>
            <div class='price-left brand-logo-name'> <p class='product-title'> $product_name </p> </div>
                <p class='product-desc'>$product_desc</p>
                <a id='comparec' href='./compare.php?id=$id'><i class='fas fa-exchange-alt'></i></a>
                <button type='submit' id='compare' class='bbtn' data-pid='$id'  data-price='$lowest_costs'   data-image='$product_img'   data-name='$product_name' > <i  class='fas fa-shopping-bag'></i></button>
                <span>  <p class='product-title-price1'> £ $lowest_costs</p>   <img class='store-logo' src='./images/store-logos/$low_names'></span>
            </div>
        </a>
    </div>
    ";
}


if ($result->num_rows > 0) 
{
    while ($return_result = $result->fetch_assoc()) 
    {
        
        $col_morrisons      = $return_result['price_morrisons'];
        $col_tesco          = $return_result['price_tesco'];
        $col_ocado          = $return_result['price_ocado'];
        $col_sainsburry     = $return_result['price_sainsbury'];
        $col_id             = $return_result['id'];
        $col_desc           = $return_result['product_desc'];
        $col_img            = $return_result['product_img'];
        $col_name           = $return_result['product_name'];
        $lowest_super       = sort_pricing($col_morrisons,$col_tesco,$col_ocado,$col_sainsburry);
        $lowest_supermarket = $lowest_super['supermarket'];
        $lowest_supprice    = $lowest_super['prices'];
        // call funtion to display
        display_products($col_id, $col_img, $col_name, $col_desc, $lowest_supermarket, $lowest_supprice);
    }
    //return $result;
} 
else 
{
    die("error found nothing");
}
?>
            </div>
            </div>
    </section>
    <?php 
require_once './includes/footer.php';
?>