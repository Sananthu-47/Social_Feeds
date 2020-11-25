<?php include "includes/header.php"; ?>
<?php include "includes/nav.php"; ?>
<?php
    $user_id = getUserInfo('id',$_SESSION['username']);
     if(isset($_POST['update']))
    {
        $first_name = charecterParse(ucfirst(strtolower(trim($_POST['first_name']))));
        $last_name = charecterParse(ucfirst(strtolower(trim($_POST['last_name']))));
        $bio = charecterParse(trim($_POST['bio']));
        $user_image =time(). '_' .$_FILES['profile']['name'];
        $user_image_temp = $_FILES['profile']['tmp_name'];
        $acc_type = strtolower($_POST['account_type']);
        
        if($_FILES['profile']['tmp_name'] !== '')
        {
            $image_query = ", user_image = '{$user_image}'";
        }else{
            $image_query = '';
        }
        move_uploaded_file($user_image_temp,"assets/images/profiles/$user_image");
        $username = $first_name . '_' . $last_name;
        $query = "SELECT username FROM users WHERE first_name = '$first_name' && last_name = '$last_name'";
        $result = mysqli_query($connection,$query);

        if(!$result)
        {
            alert("alert-danger","Something wrong");
        }
        $unique = mysqli_num_rows($result);
        if($unique != 0 && $_SESSION['username'] !== $username)
        {
            $username = $username . '_' . $unique;
        }

            if(!empty($first_name) && !empty($last_name) && !empty($acc_type) && !empty($user_image))
            {

                    //Get list of all my friends
                    $all_friends = getUserInfo('friends_list',$_SESSION['username']);  
                    $friends_array = array_filter(explode(',',$all_friends));
                    foreach ($friends_array as $friend) { 
                        //Select my name from their db row
                          $query = "SELECT friends_list FROM users WHERE username = '$friend'";
                          $result = mysqli_query($connection,$query);
                          $response = [];
                          $response = mysqli_fetch_assoc($result);
                                  $string = $response['friends_list'];
                                  $search = ','.$_SESSION['username'].',';
                                  $replace = ','.$username.',';
                                  $updated_list = str_replace($search, $replace , $string);//Replace the new profile name
                                  $query = "UPDATE users SET friends_list = '$updated_list' WHERE username = '$friend' "; 
                                  $result = mysqli_query($connection,$query);
                                  if(!$result)
                                  {
                                      die('error').mysqli_error($connection);
                                  }
                    }//foreach

                    //Update my name and profile
                    $query = "UPDATE users SET username = '$username' , account_type = '$acc_type' , first_name = '$first_name' , last_name = '$last_name'  , bio = '$bio'". $image_query ." WHERE id = '$user_id' ";
                    $result = mysqli_query($connection,$query);
                    //Update posts setion with my new updated name
                    $query = "UPDATE posts SET posted_by = '$username'  WHERE posted_by = '{$_SESSION['username']}' ";
                    $result = mysqli_query($connection,$query);
                    //Get all the user name with the old name in request by and to in request table
                    $request_by_list = getFreindRequestInfo('request_by',$_SESSION['username']);
                    $request_to_list = getFreindRequestInfo('request_to',$_SESSION['username']);
                    
                    //Update the fried_request table with the updated request_by
                    foreach ($request_by_list as $id) {
                        $query = "UPDATE friend_requests SET request_by = '$username' WHERE id = '$id' ";
                        $result = mysqli_query($connection,$query);
                    } 
                    //Update the friend_reuets table with the updated request_to
                    foreach ($request_to_list as $id) {
                        $query = "UPDATE friend_requests SET request_to = '$username' WHERE id = '$id' ";
                        $result = mysqli_query($connection,$query);
                    } 
                    session_destroy();
                    session_start();
                    $_SESSION['username'] = $username;

                        if(!$result)
                        {
                            alert('alert-danger',"User couldn't be updated!".mysqli_error($connection));
                        }else{
                            alert('alert-success',"User updated successfully!");
                        }
            }else{
                echo "Any of the fields cannont be empty!";
            }
 }
?>

<?php
    $username = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($connection,$query);
    if(!$result)
    {
        alert('alert-danger',"Bad query");
    }
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $bio = $row['bio'];
    $account_type = $row['account_type'];
?>

<div class="container-fluid d-flex flex-column justify-content-center text-content-center p-1 col-12 col-md-6 col-lg-4 mt-2">
<form action="" method="post" class="form form-group" enctype="multipart/form-data">
            <div class="profile-mobile" onClick="selectFile()">
            <img src="assets/images/profiles/<?php echo getUserInfo('user_image',$username); ?>" class="image-full" id="preview" alt="">
            <input type="file" name="profile" id="profile-image" accept="<?php echo getUserInfo('user_image',$username); ?>" onChange="displayImage(this)" class="d-none">
            </div>
            <label class='badge badge-dark' for="username">Username</label>
            <input type="text" name="username" class="form-control border profile-username" id="username" placeholder="Username" value="<?php echo $username ;?>" disabled='true'>
            <label class='badge badge-dark' for="account-type">Account type</label>
            <input type="button" class="form-control border btn btn-sm text-uppercase font-weight-bold" id="account-type" value="<?php echo $account_type ;?>">
            <input type="hidden" id="hidden-account-type" value="<?php echo $account_type ;?>" name="account_type" >
            <label class='badge badge-dark' for="bio">Add bio</label>
            <textarea type="text" name="bio" class="form-control border" id="bio" placeholder="About me!"><?php echo $bio ;?></textarea>
            <label class='badge badge-dark' for="first-name">First name</label>
            <input type="text" name="first_name" class="form-control border" id="first-name" placeholder="First name" value="<?php echo $first_name ;?>">
            <label class='badge badge-dark' for="last-name">Last name</label>
            <input type="text" name="last_name" class="form-control border" id="last-name" placeholder="Last name" value="<?php echo $last_name ;?>"><br>
            <input type="submit" name="update" class="form-control border btn btn-primary" id="update" value="Update">
</form>            
</div>

<?php include "includes/footer.php"; ?>

<script>

$("#account-type").on("click",()=>{
    if($("#account-type").val()==="public")
    {
        $("#hidden-account-type").val("private");
        $("#account-type").val("private");
    }else{
        $("#hidden-account-type").val("public");
        $("#account-type").val("public");
    }
});

</script>