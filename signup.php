<?php include 'header.php';
include 'config.php';
$firstname= $lastname = $email = $password1 = $password2 = $image= $linkedin= $website='';
$login_err = '';


function cleaner($data){
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    return $data;
}

//REQUEST:USED TO COLLECT DATA from a submitted html form.
//POST:USED TO COLLECT DATA from a submitted html form that used method = post
if(isset($_POST['signupBtn'])){
//    grabbing form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

//    default data:images,website,linkedin
    $image = $_POST['image'];
    $website = $_POST['website'];
    $linkedin = $_POST['linkedin'];


//    clean the data
    $name = cleaner($name);
    $email = cleaner($email);
    $password1 = cleaner($password1);
    $password2 = cleaner($password2);

    $sql = "SELECT * FROM `users` WHERE email ='$email' LIMIT 1";
    $results = mysqli_query($conn,$sql);


//    check if the user exists in the database: if true ask them to login instead
    $sql = "SELECT * FROM `users` WHERE email ='$email' LIMIT 1";
    $results = mysqli_query($conn,$sql);

    if(mysqli_num_rows($results) > 0){

        //User found
        $login_err = "User exists. Login";
        header("location:login.php?error=$login_err");
        exit();
    }else{

        //Check if passwords match
        if($password1!==$password2){
            $password_err = 'Error, passwords not matching';

            header('location:signup.php?error=password_err');
            exit();

        }else{

//            encrypt the password
            $password1 = md5($password2);

            //Insert user into the database
            $sql = "INSERT INTO `users`(`id`, `firstname`, `lastname`, `email`, `password`, `image`, `website`, `linkedin`) VALUES (NULL,'$firstname','$lastname','$email','$password1','$image','$website','$linkedin')";
            if (mysqli_query($conn,$sql)){
                echo "New record added";
            }else{
                echo "Error: " .$sql . "<br>";
            }

            //Redirect to the login page
            header("location:login.php");
        }
    }
    mysqli_close($conn);

}
?>

<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4" style="margin-top: 20px">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                <div class="form-group">
                    <label for="firstname">Firstname</label>
                    <input type="text" name="firstname" class="form-control" placeholder="Enter first name">
                </div>
                <div class="form-group">
                    <label for="lastname">Lastname</label>
                    <input type="text" name="lastname" class="form-control" placeholder="Enter last name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password1" class="form-control" placeholder="Enter password">
                </div>
                <div class="form-group">
                    <label for="password">Confirm Password</label>
                    <input type="password" name="password2" class="form-control" placeholder="Confirm password">
                </div>
                <div class="form-group">
                    <input type="text" name="image" value="image" hidden>
                </div>
                <div class="form-group">
                    <input type="text" name="website" value="weburl" hidden>
                </div>
                <div class="form-group">
                    <input type="text" name="linkedin" value="linkedinurl" hidden>
                </div>

                <input type="submit" name="signupBtn" value="Create an account" class="btn btn-success btn-lg">
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>






<?php include 'footer.php'?>

