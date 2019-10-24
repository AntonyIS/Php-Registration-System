<?php
session_start();
include 'config.php';

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];

}
$firstname= $lastname = $email = $image= $linkedin= $website= $id ='';

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST['updateBtn'])){
    $id = $_SESSION['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $website = $_POST['website'];
    $linkedin = $_POST['linkedin'];



    if($target_file == 'uploads/') {
        $image = $_POST['oldimg'];
        $sql = "UPDATE `users` SET `firstname`='$firstname',`lastname`='$lastname',`email`='$email',`image`='$image',`website`='$website',`linkedin`='$linkedin' WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            header("location: profile.php?id=$id");
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
//        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    $image = ltrim($target_file);
//    $image = $_POST['image'];
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $sql = "UPDATE `users` SET `firstname`='$firstname',`lastname`='$lastname',`email`='$email',`image`='$image',`website`='$website',`linkedin`='$linkedin' WHERE id='$id'";
        if(mysqli_query($conn,$sql)){
            header('location:profile.php?id='.$id);
        }else{
            echo "Saving unsuccessfull";
            echo mysqli_error($conn);
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }



//
//    $sql = "UPDATE `users` SET `firstname`='$firstname',`lastname`='$lastname',`email`='$email',`image`='$image',`website`='$website',`linkedin`='$linkedin' WHERE id='$id'";
//    if(mysqli_query($conn, $sql)){
//        header('location:profile.php?id=$id');
//        exit();
//    }else{
//        echo "error".mysqli_error($conn);
////        header('location:index.php?err=err');
////        exit();
//    }
}
?>