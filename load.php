<?php


require "index.php";


//fetch last file directory
try{
    $sql = "SELECT content FROM files ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);
    $fetched_directory = [];  //only one is expected

    if ($result->num_rows > 0) {
        // output data of each row

        while($row = $result->fetch_assoc()) {
          array_push ($fetched_directory , $row['content']);
        }
      } else {
        die("Nothing saved yet");
      }
      $conn->close();
}

catch (Exception $e){
    die("could not retrieve directory from database");
}



//load the file into browser    //I am only loading pdf files, others will not load
$filename = $fetched_directory[0]; 
    
// Header content type 
header("Content-type: application/pdf"); 
  
header("Content-Length: " . filesize($filename)); 
  
// Send the file to the browser. 
readfile($filename); 