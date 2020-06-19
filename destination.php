<?php

require "index.php";  //for connection to db

//This is the main file

$statusMsg = '';

//file download path

//create "download" directory if not exists
if (!file_exists('downloads')) {
    mkdir('downloads', 0777, true);
}

$targetDir = "downloads/";
$fileName = basename($_FILES["file"]["name"]);    //asign filename as full incoming name
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);


if(!empty($_FILES["file"]["name"])) {

    //allow certain file formats
    $allowTypes = array('docx','doc','pdf');

    if(in_array($fileType, $allowTypes)){

        //download file to server B
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            $statusMsg = "The file ".$fileName. " has been downloaded on server B.";
        }else{
            $statusMsg = "Sorry, there was an error downloading your file to server B";
        }

    }else{
        $statusMsg = 'Sorry, only doc, docx & PDF files are allowed to download.';
    }
    
}else{
    $statusMsg = 'Server A sent an empty file';
}



//next is to process the file which can be found at <<<$targetFilePath>>>
/*
       processing logic goes here on the file 
       
       $targetFilePath

       and output will be gotten in say $output

       then 

       die($ouput)

       The End
    
*/

//BUT, no processing logic yet, so let us just do ensure some confirmation by returning all existing directories


//save the file directory into db 
try{

    $sql = "INSERT INTO `files` (content) VALUES ('{$targetFilePath}')";
    if ($conn->query($sql) === TRUE) {
        echo ("Uploaded to server B successful");
      } else {
        die("Error: " . $sql . "<br>" . $conn->error);
      }
      
}

catch(Exception $e){
    die("File failed to save");
}



//fetch all exisiting file directory to return to server A
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
