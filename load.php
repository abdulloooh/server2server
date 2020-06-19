<?php


require "index.php";



//fetch all exisiting file directory
try{
  $sql = "SELECT content FROM files";
  $result = $conn->query($sql);

  $fetched_directories = [];

  if ($result->num_rows > 0) {
      // output data of each row

      while($row = $result->fetch_assoc()) {
        array_push ($fetched_directories , $row['content']);
      }
    } else {
      die("Nothing saved yet");
    }
    $conn->close();
}

catch (Exception $e){
  die("could not retrieve directories from database");
}


die(var_dump($fetched_directories));
