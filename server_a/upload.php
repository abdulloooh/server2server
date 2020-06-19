<?php
session_start();
//first, upload file to server A

$statusMsg = '';

//file upload path

//create "uploads" directory if not exists
if (!file_exists('uploads')) {
    mkdir('uploads', 0777, true);
}

$targetDir = "uploads/";

$fileName = basename($_FILES["file"]["name"]);

$targetFilePath = $targetDir . $fileName;

$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {

    //allow certain file formats
    $allowTypes = array('docx','doc','pdf', 'jpg', 'jpeg', 'odt');

    if(in_array($fileType, $allowTypes)){

        //upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            $statusMsg = "The file ".$fileName. " has been uploaded to this server.";
        
        }else{
            $statusMsg = "Sorry, there was an error uploading your file to server A.";
        }
    
    }else{
        $statusMsg = 'Sorry, only doc, docx & PDF files are allowed to upload.';
    }

}else{
    $statusMsg = 'Please select a file to upload.';
}

//display status message
echo $statusMsg;


//now move from server A to server B

$target_url = 'http://localhost:7000/destination.php';
//This needs to be the full path to the file you want to send.

$file_name_with_full_path = realpath($targetFilePath); //bring the file initially saved

//remember $fileType from up there
//use it to assign mimeTypes
$mimeType = array('pdf' => 'application/pdf', 'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' , 'doc' => '	application/msword');
//other mime-types can be found in https://developer.mozilla.org/en-US/docs/Web/HTTP/Basics_of_HTTP/MIME_types/Common_types


/* curl will accept an array here too.
 * Many examples I found showed a url-encoded string instead.
 * Take note that the 'key' in the array will be the key that shows up in the
 * $_FILES array of the accept script. and the at sign '@' is required before the
 * file name.
 */


$post = array('file' => new CurlFile($file_name_with_full_path /* MIME-Type */));


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$target_url);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$result=curl_exec ($ch);
$err = curl_error($ch);
curl_close ($ch);

if($err) die($err);

?>


<!-- handling of the response from server B goes here -->
<strong> <?php echo "Successful so I loaded this txt type resume file already saved on server B back to confirm both way communication \n\n"; ?> </strong>

<?php
if ($result) die(json_decode($result));
