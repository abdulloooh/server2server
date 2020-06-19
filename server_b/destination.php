<?php

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
       processing logic goes here on file directory
       
       $targetFilePath

       and output will be gotten in say $output

       then 

       die($ouput)

       The End
    
*/

//BUT, no processing logic yet, so let us just so confirmation by reading a file already saved and dumping it back

$read = readfile("downloads/a.txt");   //this file was saved already just to mimick the output that will come after file processing
//return status of file
die($read);