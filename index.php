<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">

    <form action="upload.php" method="post" enctype="multipart/form-data">
    
        <div class="form-group">
            <label for="exampleFormControlFile1">Example file input</label>
            <input type="file" name="file" id="file" class="form-control-file" id="exampleFormControlFile1" onchange="fileValidation()">
        </div>

        <input type="submit" name="submit" value="Upload"></button>

    </form>

    <span id="result" ></span>

    <p id = "output"></p>

</div>

<script src="script.js"></script>
</body>
</html>

