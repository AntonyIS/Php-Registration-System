<?php include 'header.php';
include 'config.php';

$email = $password1 = '';
function cleaner($data){
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    return $data;
}
if(isset($_POST['loginBtn'])){

//    grabbing form data
    $email = $_POST['email'];
    $password = $_POST['password'];

//    clean the data
    $email = cleaner($email);
    $password = cleaner($password);

    //encrypt the password
    $password = md5($password);


//    check if the user exists in the database: if true they exist in the system and there they can be allowed into the site hence ask them to login instead
    $sql = "SELECT `id`, `email`, `password` FROM `users` WHERE email = '$email' AND password = '$password'";
//    $sql = "SELECT `email`, `password` FROM `users` WHERE email = '$email' AND password = '$password'";
    $results = mysqli_query($conn,$sql);


    if(mysqli_num_rows($results) > 0){
//    if number of rows are >0 , that means that a record was found in the db
//        give the user a session so that they can be able to access private pages like private page using this session
        $_SESSION['loggedin'] = true;

        while($row = mysqli_fetch_assoc($results)) {
//            To give the user special access to other pages using the id, we use the while loop to through the records and grab the id
//            This id will be handy whenever we want to access reocrds of the user from any page, we just reference the id and we can select the from the db using this ID
            $_SESSION['id'] = $row['id'];
//            after grabbing the id we redirect the user to the index page
            header("location:index.php");
            exit();
        }

        //Redirect if user is present
//        header("location:index.php?id=$id");
        exit();
    }else{
        //Redirect to the signup page
        header("location:signup.php");

    }
    mysqli_close($conn);
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="login.php" method="post">
                <div>
                    <?php
                    if (isset($_GET['error'])){
                        echo "<p class='text-danger'>Error: User already exists</p>";
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for ='username'>Email</label>
                    <input type="email" name="email" placeholder="Enter Email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for ='username'>Password</label>
                    <input type="password" name="password" placeholder="Enter Password" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="submit" name="loginBtn" value="login">
                </div>

            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>













<?php include 'footer.php'?>

