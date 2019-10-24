<?php
include 'header.php';
include 'config.php';

?>

<div class="container">
    <h1 style="text-align: center">Users</h1>
    <?php
    $sql = "SELECT * FROM `users`";

    //store the data in a variable called results
    $results = mysqli_query($conn, $sql);

    echo "<div class='row'>";
    while($row = mysqli_fetch_array($results)){
//            grab individual row data
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $image = $row['image'];
        $email = $row['email'];


//            presenting the data in HTML n boostrap
        echo "<div class='col-xs-4 col-sm-4 col-md-6 col-lg-4' id='item' >";
        echo "<div class='img-thumbnail shadow-lg p-1 mb-5 bg-white' id='item_css'>";
        echo "<a href='details.php?id=$id' style='text-decoration: none'>";
        ?>
        <p class="lead"  id="effecD" style="display: none">
            <?php echo  $firstname;echo  $lastname?>
        </p>
        <?php
        echo "<img src='$image' alt='' class='card-img' style='height: 218px;' id='$id'>";
        ?>

        <?php
        echo "<div class='caption'>";
        echo "<p class='lead ' style='text-align: center;margin-top: 8px;color:orange;font-weight: bold'>$firstname</p>";
        echo "<hr>";

        echo "</div>";
        echo "</a>";
        echo "</div>";
        echo "</div>";
    }
    echo "</div>";





    ?>
</div>
<div></div>