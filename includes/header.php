<?php
require_once './php/webparts.php';
require_once './php/fetchproducts.php';
require_once './php/fetchrecipe.php';
$database = new getData();
$db = new getRecipe();
session_start();

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Metas -->
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Links -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <!-- Document Title -->
    <title>Price Checker</title>
  </head>
  <body>
    <!------------------------------------------------ HEADER SECTION -->
    <header id="home">
      <nav class="animate">
        <div class="container">
          <div class="logo left">
            <!-- Logo -->
          <img src="./images/logo.png">
          </div>
          <div class="menu-button hide right pointer">
            <span></span>
            <span></span>
            <span></span>
          </div>
          <div class="menu left">
            <div class="page-menu left">
              <!-- Navigation -->
              <li><a href="index.php">Home</a></li>
              <li><a href="prices.php">Check & Compare Prices </a></li>
              <li><a href="recipes.php">Recipes</a></li>
            </div>
            <div class="registration flex-center">

            <?php
                                if (isset($_SESSION['useragent'])) {
                                  echo '<div class="join-us">
                                  <!-- Join Us Button -->
                                  <li class="pointer  animate"><a href=""></a></li>
                                </div>
                                <div class="getting-started">
                                  <!-- Get Started Button -->
                                  <li class="main-btn pointer text-center animate" id="logbtn"><a name="logout" href="./php/logout.php"><Label>Logout</Label></a></li>
                                </div>' ;
                              } else {
                                  echo'<div class="join-us">
                                  <!-- Join Us Button -->
                                  <li class="pointer  animate"><a href="login.php">Login</a></li>
                                </div>
                                <div class="getting-started">
                                  <!-- Get Started Button -->
                                  <li class="main-btn pointer text-center animate"><a href="register.php"><Label>Register</Label></a></li>
                                </div>' ;
                              }
                                  ?>
            </div>
          </div>
        </div>
      </nav>
	</header>