<?php
if(isset($_FILES['image'])){
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_type = $_FILES['image']['type'];
    $file_tmp = $_FILES['image']['tmp_name'];
    
    $allowed_extensions = array("jpg", "jpeg", "png", "gif");
    $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

    // Check if the file extension is allowed
    if(in_array($file_extension, $allowed_extensions)){
        // Check the file size (max 2MB)
        if($file_size <= 2097152){
            // Move the uploaded file to the desired directory
            if(move_uploaded_file($file_tmp, "upload-image/" . $file_name)){
                echo "Successfully uploaded.";
            } else {
                echo "Could not upload the file.";
            }
        } else {
            echo "File size must be less than or equal to 2MB.";
        }
    } else {
        echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
    }
}
?>

<html>
<body>
<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="image" /><br><br>
    <input type="submit"/>
</form>
</body>
</html>
