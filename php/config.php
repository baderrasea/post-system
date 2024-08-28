<?php 
 
 $con = mysqli_connect("localhost","root","","db_mosnad") or die("Couldn't connect");

 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "db_mosnad";

 try {
   $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
   // set the PDO error mode to exception
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 } catch(PDOException $e) {
   die("ERROR: Could not connect. " . $e->getMessage());
 }
?>