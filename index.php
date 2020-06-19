<?php


//everything here is to log all path to files downloaded into database, so you might not necessarily need this


$config = require 'config.php';  //config file

// Create connection
$conn = new mysqli($config['database']['server'], $config['database']['username'], $config['database']['password'],$config['database']['dbname'] );

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
echo "<br>";



//only one table is used 
//create table files (id int primary key auto_increment,content text)
//note that all files stored dynamically in heroku are cleared when dyno restarts, so you might not find all your files back

