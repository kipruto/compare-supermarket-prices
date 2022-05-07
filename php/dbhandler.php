<?php



$servername = "localhost";
$password = "seansmith";
$dbname = "website";
$username = "seansmith";          
$conn = mysqli_connect($servername, $username, $password, $dbname);

   if(!$conn){
       die("connection failed ".mysqli_connect_error());
   }
