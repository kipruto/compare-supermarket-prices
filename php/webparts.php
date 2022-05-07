<?php

function comparepriceelement($id, $product_img, $product_name, $product_desc, $price_morrisons, $price_tesco, $price_ocado, $price_sainsbury)

{

    // sorting the prices

    //create an array to hold the values
    $sort_array = array(
        'price_morrisons' => $price_morrisons,
        'price_tesco' => $price_tesco,
        'price_ocado' => $price_ocado,
        'price_sainsbury' => $price_sainsbury

    );


    // sort the array

    asort($sort_array);


    echo

    "
    <div class='compare-container' data-pid='$id'>
        <div class='product-boxx col-6 '>
            <div class='product-image'>
                <img class='p-image' data-image='$product_img' src='$product_img' alt=''/>
            </div>
        </div>
      <div class='product-infos'>
            <h2 class='title-heading' data-name='$product_name' >$product_name</h2>
            <p><strong>Product description:</strong> $product_desc </p>
            </br>
        <div>
  

    ";

    foreach ($sort_array as $x => $x_value) {

        // get the key and display its values

        if ($x == "price_morrisons") {

            echo "

            <div class='item-price-card'>
                <div class='image-holder'>
                    <img class='store-logo-compare' src='./images/store-logos/M.png'/>
                </div>
                <div class='product-title-price'>
                    <p>Price: € $price_morrisons</p>
                </div>
                <button class='savecart' type='submit' data-pid='$id' data-image='$product_img'  data-name='$product_name' data-price='$price_morrisons'>
                    <span><i id='save-to-cart' class='far fa-bookmark'></i><p> Save</p></span>
                </button>
            </div>

            ";
        } elseif ($x == "price_tesco") {

            echo "

            <div class='item-price-card'>
                <div class='image-holder'>
                    <img class='store-logo-compare' src='./images/store-logos/T.png'/>
                </div>
                <div class='product-title-price'>
                    <p>Price: € $price_tesco</p>
                </div>
                <button class='savecart' type='submit' data-pid='$id' data-image='$product_img'  data-name='$product_name' data-price='$price_tesco'>
                    <span><i id='save-to-cart' class='far fa-bookmark'></i><p> Save</p></span>
                </button>
            </div>


            ";
        } elseif ($x == "price_ocado") {
            echo
            "

            <div class='item-price-card'>
                <div class='image-holder'>
                    <img class='store-logo-compare' src='./images/store-logos/O.png'/>
                </div>
                <div class='product-title-price'>
                    <p>Price: € $price_ocado</p>
                </div>
                <button class='savecart' type='submit' data-pid='$id' data-image='$product_img'  data-name='$product_name' data-price='$price_ocado'>
                    <span><i id='save-to-cart' class='far fa-bookmark'></i><p> Save</p></span>
                </button>
            </div>

            ";
        } else {

            echo "

                <div class='item-price-card'>
                    <div class='image-holder'>
                        <img class='store-logo-compare' src='./images/store-logos/S.png'/>
                    </div>
                    <div class='product-title-price'>
                        <p>Price: € $price_sainsbury</p>
                    </div>
                    <button class='savecart' type='submit' data-pid='$id' data-image='$product_img'  data-name='$product_name' data-price='$price_sainsbury'>
                        <span><i id='save-to-cart' class='far fa-bookmark'></i><p> Save</p></span>
                    </button>
                </div>
                ";
        }
    }
    "</div>'
    '</div>'
    '</div>";
}



function productelement($id, $product_img, $product_name, $product_desc, $price_morrisons)
{
    $element = "   
     <div class='product-box col-xs-12 col-md-3 col-lg-3'>
     <a class='fixcomponent' href='./compare.php?id=$id'>
    <div class='product-image'>
      <img src='$product_img' alt=''>
    </div>
    <div class='product-info'>
              <div class='price-left brand-logo-name'> <p class='product-title'> $product_name </p> </div>
              <p class='product-desc'>$product_desc</p>
              <a id='comparec' href='./compare.php?id=$id'><i class='fas fa-exchange-alt'></i></a>
              <button type='submit' id='compare' class='bbtn' data-pid='$id'  data-price='$price_morrisons'   data-image='$product_img'   data-name='$product_name' > <i  class='fas fa-shopping-bag'></i></button>
    
             <span>  <p class='product-title-price1'> £ $price_morrisons</p>   <img class='store-logo' src='./images/store-logos/O.png'></span>
      </div>
      </a>
    </div>
";
    echo $element;
}


function recipeelement($id, $recipe_img, $recipe_name)
{
    $element = "   
     <div class='product-box col-xs-12 col-md-3 col-lg-3'>
     <a class='fixcomponent' href='./fullview.php?id=$id'>
    <div class='product-image'>
      <img class='imgg' src='$recipe_img' alt=''>
    </div>
    <div class='product-info'>
              <div class='price-left brand-logo-name'> <p class='product-title'> $recipe_name </p> </div>
              <a id='seerecipe' href='./fullview.php?id=$id'>View Recipe</a>
      </div>
      </a>
    </div>
";
    echo $element;
}


function viewrecipeelement($id, $recipe_img, $recipe_name, $ingredients, $instructions, $nutrition_facts, $time)
{
    $element = "
    <div class='compare-container' data-pid='$id'>
    <div class='row'>
    <div class='product-boxx col-xs-12 col-md-6 col-lg-6'>
          <div class='product-image'>
            <img class='p-image' src='$recipe_img' alt=''>
          </div>
          </div>
          <div class='product-infos col-xs-12 col-md-6 col-lg-6'>
                 <h2 class='title-heading'  >$recipe_name</h2>
                 <p><b>Ingredients:</b> </br> </br>$ingredients </p>
                 </br>
                 <p><b>Instructions:</b> </br></br> $instructions </p>
   </br>
   <p><b>Nutritional Facts:</b> </br></br> $nutrition_facts </p>
   </br>
   <p><b>Duration:</b>  </br>$time </p>
   </br>
                  <div>
                  </div>
                 </div>
                 </div>
    </div>
   ";

    echo $element;
}


function showrecommended($id, $recipe_img, $recipe_name, $ingredients, $instructions, $nutrition_facts, $time)
{
    $element = "
    <div class='compare-container' data-pid='$id'>
    <div class='row'>
    <div class='product-boxx col-xs-12 col-md-6 col-lg-6'>
          <div class='product-image'>
            <img class='p-image' src='$recipe_img' alt=''>
          </div>
          </div>
          <div class='product-infos col-xs-12 col-md-6 col-lg-6'>
                 <h2 class='title-heading'  >$recipe_name</h2>
                 <p><b>Ingredients:</b> </br> </br>$ingredients </p>
                 </br>
                 <p><b>Instructions:</b> </br></br> $instructions </p>
   </br>
   <p><b>Nutritional Facts:</b> </br></br> $nutrition_facts </p>
   </br>
   <p><b>Duration:</b>  </br>$time </p>
   </br>
                  <div>
                  </div>
                 </div>
                 </div>
    </div>
   ";

    echo $element;
}
