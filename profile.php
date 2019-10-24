<?php

include 'header.php';
include 'config.php';
$firstname= $lastname = $email = $password1 = $password2 = $image= $linkedin= $website=$id='';


if (!isset($_SESSION['loggedin'])) {
    header('location:login.php');
}

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    $sql = "SELECT `id`, `firstname`, `lastname`, `email`, `password`, `image`, `website`, `linkedin` FROM `users` WHERE id='$id'";
    $result = mysqli_query($conn, $sql) or die($id);

    $row = mysqli_fetch_assoc($result);
    $firstname = $row['firstname'];
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $email = $row['email'];
    $image = $row['image'];

    $website = $row['website'];
    $linkedin = $row['linkedin'];


}

?>
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="thumbnail " style="margin-top: 20px">
                    <img src="<?php echo $image?>" alt="" style="width: 350px;height: 350px" class="img-thumbnail shadow-lg p-1 mb-5 bg-white">
                    <div class="caption">
                        <p class="lead "><?php echo $firstname."  ".$lastname?></p>

                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <form action="update.php" method="post" enctype="multipart/form-data">
                    <input type="number" name="id" value="<?php echo $id?>" hidden>
                    <div class="form-group">
                        <label for="firstname">Firstname</label>
                        <input type="text" name="firstname" class="form-control" value="<?php echo $firstname?>">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input type="text" name="lastname" class="form-control" value="<?php echo $lastname?>" >
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $email?>">
                    </div>
                    <div class="form-group">
                        <label for="website">Website</label>
                        <input type="text" name="website" class="form-control" value="<?php echo $website?>">
                    </div>
                    <div class="form-group">
                        <label for="linkedin">Linkedin</label>
                        <input type="text" name="linkedin" class="form-control" value="<?php echo $linkedin?>">
                    </div>
                    <div class="form-group">
                        <input type="file" name="fileToUpload">
                        <input type="text" hidden name="oldimg" value="<?php echo $image?>" >
                    </div>

                    <input type="submit" name="updateBtn" value="Update account" class="btn btn-success btn-lg">
                </form>
            </div>
        </div>
    </div>
</div>