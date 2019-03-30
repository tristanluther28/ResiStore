<?php
    function __autoload($class){
        require_once "../classes/$class.php";
    }
    session_start();
?>
<html>
    <head>
        <?php
            require_once "../support/head.php";
        ?>
    </head>
    <body>
        <?php
            if(isset($_SESSION['id']) && $_SESSION['sudo'] == '1'){
                $error_msg = "";
                $pos_msg = "";
                $target_dir_data = "../datasheets/";
                $target_dir_pic = "../img/";
                $uploadOk = 1;
                if (isset($_POST['submit'])){
                    $product = new Product();
                    $id = $_GET['id'];
                    $rows = $product->search_id($id);
                    $row = $rows[0];
                    $plu = $product->escape($_POST['plu']);
                    $description = $product->escape(htmlspecialchars($_POST['description']));
                    $qty = $product->escape($_POST['qty']);
                    $price = $product->escape($_POST['price']);
                    $category = $product->escape($_POST['category']);
                    $box = $product->escape($_POST['box']);
                    $location = $product->escape($_POST['location']);
                    $picture = $row['picture'];
                    $datasheet = $row['datasheet'];
                    if (isset($_FILES['picToUpload']['name']) && $_FILES["picToUpload"]["size"] > 0){
                        $target_file_pic = $target_dir_pic . basename($_FILES["picToUpload"]["name"]);
                        $imageFileType = strtolower(pathinfo($target_file_pic,PATHINFO_EXTENSION));
                        $picture = $product->escape($_FILES['picToUpload']['name']);
                        $check_pic = getimagesize($_FILES["picToUpload"]["tmp_name"]);
                        if($check_pic !== false) {
                            echo "File is an image - " . $check_pic["mime"] . ".\n";
                            $uploadOk = 1;
                        } else {
                            echo "File is not an image.\n";
                            $uploadOk = 0;
                        }
                        // Check if image file already exists
                        if (file_exists($target_file_pic)) {
                            $picture = $product->escape($_FILES['picToUpload']['name']);
                            $uploadOk = 0;
                        }
                        // Check image file size
                        if ($_FILES["picToUpload"]["size"] > 30000000) { //3000 kilobytes is the MAX size
                                echo "Sorry, your image file is too large.\n";
                                $uploadOk = 0;
                        }
                        // Allow certain file formats for the picture
                        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ){
                            echo "Only JPG, JPEG, PNG & GIF files are allowed for images.\n";
                            $uploadOk = 0;
                        }
                        // Check if $uploadOk is set to 0 by an error
                        if ($uploadOk == 0) {
                            echo "Sorry, your image file was not uploaded. It is likely that the file already exists on the server.\n";
                        } 
                        // if everything is ok, try to upload file
                        else {
                            if (move_uploaded_file($_FILES["picToUpload"]["tmp_name"], $target_file_pic)) {
                                echo "The file ". basename( $_FILES["picToUpload"]["name"]). " has been uploaded.";
                            } 
                            else {
                                echo "Sorry, there was an error uploading your image file.\n";
                            }
                        }
                    }
                    //If a new file was not given then the name remains the same 
                    else{
                        $picture = $row['picture'];
                    }
                    if (isset($_FILES['dataToUpload']['name']) && $_FILES["dataToUpload"]["size"] > 0){
                        $target_file_data = $target_dir_data . basename($_FILES["dataToUpload"]["name"]);
                        $dataFileType = strtolower(pathinfo($target_file_data,PATHINFO_EXTENSION));
                        $datasheet = $product->escape($_FILES['dataToUpload']['name']);
                        $check_data = filesize($_FILES["dataToUpload"]["tmp_name"]);
                        if ($check_data !== false) {
                            echo "File is a pdf or gif - " . $check_data["mime"] . ".\n";
                            $uploadOk = 1;
                        } else {
                            echo "File is not a pdf or gif.\n";
                            $uploadOk = 0;
                        }

                        // Check if datasheet file already exists
                        if (file_exists($target_file_data)) {
                            $datasheet = $product->escape($_FILES['dataToUpload']['name']);
                            $uploadOk = 0;
                        }
                        // Check datasheet file size
                        if ($_FILES["dataToUpload"]["size"] > 30000000) { //3000 kilobytes is the MAX size
                            echo "Sorry, your datasheet file is too large.\n";
                            $uploadOk = 0;
                        }
                        // Allow certain file formats for the datasheet
                        if($dataFileType != "pdf" && $dataFileType != "gif" ) {
                            echo "Sorry, only PDF & GIF files are allowed.\n";
                            $uploadOk = 0;
                        }
                        // Check if $uploadOk is set to 0 by an error
                        if ($uploadOk == 0) {
                            echo "Sorry, your datasheet file was not uploaded. It is likely that the file already exists on the server.\n";
                        } 
                        // if everything is ok, try to upload file
                        else {
                            if (move_uploaded_file($_FILES['dataToUpload']['tmp_name'], $target_file_data)) {
                                echo "The file ". basename( $_FILES["dataToUpload"]["name"]). " has been uploaded.";
                            } 
                            else {
                                echo "Sorry, there was an error uploading your datasheet file.\n";
                            }
                        }
                    }
                    //If a new file was not given then the name remains the same 
                    else{
                        $datasheet = $row['datasheet'];
                    }
                    $product->update($id, $plu, $description, $qty, $price, $category, $picture, $datasheet, $box, $location);
                    header("Location: manageprod.php");
                    exit();
                }
            }
            else{
                header("Location: ../404.php");
                exit();
            }
        ?>
        <?php
            require_once "../support/footer.php";
        ?>
    </body>
</html>