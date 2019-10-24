<?php

///fetch tour from the database
include "config.php";

//session_start();
//$id=$name=$description=$image='';
if (isset($_GET['id'])) {
    $id = $_GET['id'];



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
include 'header.php';
?>


<div class="container-fluid">
</div>
<div class="container">
    <h2 style="text-align: center;color: orange"><?php echo $firstname." ".$lastname;?></h2>
    <hr>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <img src="<?php echo $image?>" alt="" class="img-thumbnail" style="height: 350px;height: 400px">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <div class="caption">
                <h5>Name: </h5><?php echo $firstname." ".$lastname?>
                <h5>Email: </h5><?php echo $email?><br>
                <?php echo "<a href='$website'>Website</a>.<br>"?>
                <?php echo "<a href='$linkedin'>Linkedin</a>.<br>"?>

            </div>
        </div>
    </div>
</div>
