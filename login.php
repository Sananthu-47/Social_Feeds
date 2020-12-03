<?php 
    require "includes/header.php";
?>

<div class="d-flex justify-content-center align-items-center vh-100 register-bg">
    <!-- <div class="container"> -->
    <div class="card m-auto col-xl-3 col-lg-3 col-md-5 col-10">
        <div class="p-1 custom-header">
            <span class="custom-logo-font">Social_Feeds</span>
        </div>
        <?php 
            if(isset($_POST['login']))
            {
                $user_email = $_POST['login-email'];
                $user_password = $_POST['login-password'];

                $query = "SELECT * FROM users WHERE email = '$user_email'";
                $result = mysqli_query($connection,$query);

                if(!$result)
                {
                    alert("alert-danger","Some issues in proccessing!".mysqli_error($connection));
                }

               $row = mysqli_fetch_assoc($result);
                    $db_email = $row['email'];
                    $db_password = $row['password'];
                    $db_username = $row['username'];
                
                    if($db_email === $user_email && password_verify($user_password,$db_password))
                    {
                        $_SESSION['username'] = $db_username;
                        $time = time();
                        $query = "UPDATE users SET last_seen = '{$time}' WHERE username = '{$db_username}'";
                        $result = mysqli_query($connection,$query);
                        if($result)
                        {
                        header("Location: index.php");
                        }else{
                            die("Error".mysqli_error($connection));
                        }
                    }else{
                        alert("alert-danger","Password or email is inncorrect");
                    }
            }
        ?>
            <form action="" method="post" class="form form-group">
            <div class="card-body">
            <label for="login-email" class="badge badge-dark">Email</label>
            <input type="email" name="login-email" id="login-email" class="form-control" placeholder="Registered email"
            value="<?php if(isset($_POST['login-email']))
            {
                echo $_POST['login-email'];
            } ?>">
            <label for="login-password" class="badge badge-dark">Password</label>
            <input type="password" name="login-password" id="login-password" class="form-control" placeholder="Password">
            </br>
            <div class="d-flex justify-content-center align-items-center">
                <input type="submit" class="btn btn-primary mr-2" value="Login" name="login">
                <div class="label"><a href="">Forgot password?</a></div>
            </div>
            </div>
            </form>
            <hr>
            <span class="text-center">Or<span>
            <hr>
            <h4 class="text-center">Don't have an account?</h4>
            <div class="d-flex justify-content-center align-items-center">
            <span class="mr-1 text-primary">Create here </span>
            <button value="Sign Up" class="btn btn-success btn-flex">
            <a href="register.php" class="text-white remove-decoration">Sign Up</a>
            </button>
            </div>
            <br>
        </div>
    </div>

<?php require "includes/footer.php"; ?>