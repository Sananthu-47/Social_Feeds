<?php require "includes/header.php";
?>

<div class="d-flex justify-content-center align-items-center vh-100 register-bg">
    <!-- <div class="container"> -->
    <div class="card m-auto col-xl-4 col-lg-6 col-md-8 col-12">
        <div class="p-1 custom-header">
            <span class="custom-logo-font">Social_Feeds</span>
        </div>
            <form action="" method="post" class="form form-group" enctype="multipart/form-data">
            <div class="card-body">
            
            <?php
            $first_name=$last_name=$email=$reg_password=$reg_password_again='';
            if(isset($_POST['register']))
            {
                $first_name = charecterParse(ucfirst(strtolower(trim($_POST['first-name']))));
                $last_name = charecterParse(ucfirst(strtolower(trim($_POST['last-name']))));
                $email = charecterParse(trim($_POST['reg-email']));
                $reg_password = charecterParse($_POST['reg-password']);
                $reg_password_again = charecterParse($_POST['reg-password-again']);
                $user_image =time(). '_' .$_FILES['profile']['name'];
                $user_image_temp = $_FILES['profile']['tmp_name'];
                move_uploaded_file($user_image_temp,"assets/images/profiles/$user_image");
                $status = true;

            $query = "SELECT email FROM users";
            $result = mysqli_query($connection,$query);

            while($row = mysqli_fetch_assoc($result))
            {
                $db_email = $row['email'];
                if($db_email === $email)
                {
                $status = false;
                }
            }

                if(!$status)
                {
                    alert('alert-danger',"$email has already been already registered");
                    $first_name = '';
                    $last_name = '';
                    $email = '';
                }
                else
                {
                    if(!empty($first_name) || !empty($last_name) || !empty($email) || !empty($reg_password) || !empty($reg_password_again))
                    {
                        $hashed_password = password_hash($reg_password,PASSWORD_DEFAULT);
                        $username = $first_name . '_' . $last_name;

                        if($_FILES['profile']['size'] <= 0)
                            {
                                $user_image = "profile.png";
                            }
                        
                        $query = "SELECT username FROM users WHERE first_name = '$first_name' && last_name = '$last_name'";
                        $result = mysqli_query($connection,$query);

                        if(!$result)
                        {
                            alert("alert-danger","Something wrong");
                        }
                        $unique = mysqli_num_rows($result);
                        if($unique != 0)
                        {
                            $username = $username . '_' . $unique;
                        }
                        
                        $query = "INSERT INTO users (username , first_name , last_name , user_image , email , password , joined , friends_list) VALUES ('{$username}','{$first_name}','{$last_name}','{$user_image}','{$email}' , '{$hashed_password}' , now() , ',')";
                        $result = mysqli_query($connection,$query);
               
                        if(!$result)
                        {
                            die("Error".mysqli_error($connection));
                        }else{
                            header("Location: login.php");
                        }
                    
                    }
                }
        }
            ?>
            <div class="row d-flex flex-column justify-content-center align-items-center">
            <div class="profile-circle" id='profile-selector'>
            <img src='assets/images/profiles/profile.png' class="profile-image-tag" id="preview">
            <input type="file" name="profile" id="profile-image" value="" onChange="displayImage(this)" class="d-none">
            </div>
            <button id='clearImage' class='my-2 border border-primary btn btn-light d-none'>Cancel</button>
            </div>
                <label class='badge badge-dark' for="first-name">First name</label>
                <input type="text" name="first-name" class="form-control border" id="first-name" autocomplete='false' placeholder="first name" onChange="firstNameCheck(this.value)" value="<?php if(isset($first_name))
                {
                    echo $first_name;
                } ?>">
                <span class="d-none f-name-indicater text-danger">First name should have minimum of length 4</span>
                <label class='badge badge-dark' for="last-name">Last name</label>
                <input type="text" name="last-name" class="form-control border" id="last-name" placeholder="last name" onChange="lastNameCheck(this.value)" value="<?php if(isset($last_name))
                {
                    echo $last_name;
                } ?>">
                <span class="d-none l-name-indicater text-danger">Last name should not be empty!</span>
                <label class='badge badge-dark' for="reg-email">Email</label> 
                <input type="email" name="reg-email" class="form-control border" id="reg-email" placeholder="xyz@gmail.com" onChange="emailCheck(this.value)" value="<?php if(isset($email))
                {
                    echo $email;
                } ?>">
                <span class="d-none email-indicater text-danger">Email id is in inavild format</span>
                <label class='badge badge-dark' for="reg-password">Password</label>
                <input type="password" name="reg-password" class="form-control border" id="reg-password" placeholder="password" onKeyup='passwordCheck(this.value)'>

                <div class="row  m-2 text-danger" id="length">
                <i class="fa fa-check-circle mr-2  my-1"></i>
                <span>Length Should be minimum 8</span>
                </div>
                <div class="row  m-2 text-danger" id="capital">
                <i class="fa fa-check-circle mr-2  my-1"></i>
                <span>Atleast 1 Capital letter</span>
                </div>
                <div class="row  m-2 text-danger" id="lower">
                <i class="fa fa-check-circle mr-2  my-1"></i>
                <span>Atleast 1 small letter</span>
                </div>
                <div class="row  m-2 text-danger" id="digit">
                <i class="fa fa-check-circle mr-2  my-1"></i>
                <span>Atleast 1 digit</span>
                </div>
                <div class="row  m-2 text-danger" id="special">
                <i class="fa fa-check-circle mr-2  my-1"></i>
                <span>Atleast 1 special char like(^.,:;'!@#$%^&*_+=(){}[]?\/-)</span>
                </div>

                <label class='badge badge-dark' for="reg-password-again">Confirm password</label>
                <input type="password" disabled="true" name="reg-password-again" class="form-control border" id="reg-password-again" placeholder="confirm password" onKeyup="passwordMatch(this.value)">
                <span class="d-none password-again-indicater text-danger">Password did not match</span>
                </br>
                <div class="w-100 d-flex justify-content-between">
                <input type="submit" name="register" class="btn btn-primary mr-2" id="register" value="Register" disabled='false'>
                <a href="login.php" class="h6">Already have an account?</a>
                </div>
            </form>
        </div>
    </div>
    <!-- </div> -->
</div>  
<script src='assets/js/register.js'></script>
<?php require "includes/footer.php"; ?>