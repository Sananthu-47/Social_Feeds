<?php require "includes/header.php"; ?>
<?php include "includes/nav.php"; ?>

<?php 

if(!isset($_SESSION['username']))
    {
        header("Location: login.php");
    }
    
    if(isset($_GET['profile_username']))
    {
        $_username = $_GET['profile_username'];
    }else{
        $_username = $_SESSION['username'];
    }
?>

<div class="w-100 d-flex justify-content-center home-wrapper">
    <div class="card bg-light d-none d-md-flex col-3 p-0">
    <div class="d-flex justify-content-center" id="profile-data">
    <!-- Here goes the data from the profile side ajax php -->
    </div>
    <!-- Add friend button  -->
    <div class='d-flex justify-content-center'>
    <?php 
    if($_username !== $_SESSION['username'])
    {?>
        <form  id="friend-form" method="POST">
         <?php
            if(isFriend($_username))
            {
                echo "<input type='submit' data-reqto='{$_username}' data-reqfrom='{$_SESSION['username']}' id='unfriend' class='btn btn-danger'
                value='Unfriend $_username'>";
            }else
            if(isFriendRequestSent($_username))
            {
                echo "<input type='submit' data-reqto='{$_username}' data-reqfrom='{$_SESSION['username']}' id='cancel-request' class='btn btn-warning'
                value='Cancel request'>";
            }else
            if(isAcceptRequest($_username))
            {
                echo "<input type='submit' data-reqto='{$_username}' data-reqfrom='{$_SESSION['username']}' id='accept-request' class='btn btn-success'
                value='Accept request'>
                <input type='submit' data-reqto='{$_username}' data-reqfrom='{$_SESSION['username']}' id='reject-request' class='btn btn-danger'
                value='Reject request'>
                ";
            }else
            {
               echo "<input type='submit' id='add-friend' data-reqto='{$_username}' data-reqfrom='{$_SESSION['username']}'  class='btn btn-primary'
               value='Add friend'>"; 
            }
         ?>
         </form>
         <?php }?>
    </div>
    </div>

<script>
//Add friend ajax function
$(document).on('click',"#add-friend",function(e){
    e.preventDefault();
    let request_to = $(this).data("reqto");
    let request_from =$(this).data("reqfrom");
    
    $.ajax({
        url : "process/add-friend.php",
        type : "POST",
        data : {request_to , request_from},
        success : function(data)
        {
            $("#friend-form").html(data);
            $("#friend-form-mobile").html(data);
        }
    });
});
//Cancel friend request using ajax
$(document).on('click','#cancel-request',function(e){
    e.preventDefault();
    let request_to = $(this).data("reqto");
    let request_from =$(this).data("reqfrom");
    
    $.ajax({
        url : "process/cancel-friend-request.php",
        type : "POST",
        data : {request_to , request_from},
        success : function(data)
        {
            $("#friend-form").html(data);
            $("#friend-form-mobile").html(data);
        }
    });
});
//Accept friend request
$(document).on('click','#accept-request',function(e){
    e.preventDefault();
    let request_to = $(this).data("reqto");
    let request_from =$(this).data("reqfrom");

    $.ajax({
        url : "process/accept-request.php",
        type : "POST",
        data : {request_to , request_from},
        success : function(data)
        {
            $("#friend-form").html(data);
            $("#friend-form-mobile").html(data);
            viewAllFriends();
            loadProfileData();
        }
    });
});
//Reject friend request
$(document).on('click','#reject-request',function(e){
    e.preventDefault();
    let request_to = $(this).data("reqto");
    let request_from =$(this).data("reqfrom");

    $.ajax({
        url : "process/reject-request.php",
        type : "POST",
        data : {request_to , request_from},
        success : function(data)
        {
            $("#friend-form").html(data);
            $("#friend-form-mobile").html(data);
        }
    });
});
//Unfriend the following friend
$(document).on('click',"#unfriend",function(e){
    e.preventDefault();
    let request_to = $(this).data("reqto");
    let request_from =$(this).data("reqfrom");

    $.ajax({
        url : "process/unfriend.php",
        type : "POST",
        data : {request_to , request_from},
        success : function(data)
        {
            $("#friend-form").html(data);
            $("#friend-form-mobile").html(data);
            viewAllFriends();
            loadProfileData();
        }
    });
});

</script>

    <div class="card main-content bg-light col-12 col-md-6 p-0">
        <?php include "includes/say-something.php"; ?>
        <!--- Mobile view of profile --->
        <div class="d-flex d-md-none flex-column text-center">
        <hr>
            <div class="profile-mobile">
                <a href="<?php echo $_username; ?>"><img src="assets/images/profiles/<?php echo getUserInfo('user_image',$_username); ?>" class="profile-image-tag" alt=""></a>
            </div>
            <span class="text-primary h3"><?php echo getUserInfo('username',$_username); ?></span>
            <span class="text-dark">First name: <?php echo getUserInfo('first_name',$_username); ?></span>
            <span class="text-dark">Last name: <?php echo getUserInfo('last_name',$_username); ?></span>
            <span class="text-dark">Posts: <?php echo getUserInfo('posts',$_username); ?></span>
            <span class="text-dark">Friends: <?php echo getUserInfo('friends',$_username); ?></span>
            <?php if(getUserInfo('bio',$_username) !== '')
            {
            echo "<span class='text-dark'>Bio: ".getUserInfo('bio',$_username)."</span>";
            } ?>
            <!-- Request buttons -->
            <div class='d-flex justify-content-center my-2'>
    <?php 
    if($_username !== $_SESSION['username'])
    {?>
        <form  id="friend-form-mobile" method="POST">
         <?php
            if(isFriend($_username))
            {
                echo "<input type='submit' data-reqto='{$_username}' data-reqfrom='{$_SESSION['username']}' id='unfriend' class='btn btn-danger'
                value='Unfriend $_username'>";
            }else
            if(isFriendRequestSent($_username))
            {
                echo "<input type='submit' data-reqto='{$_username}' data-reqfrom='{$_SESSION['username']}' id='cancel-request' class='btn btn-warning'
                value='Cancel request'>";
            }else
            if(isAcceptRequest($_username))
            {
                echo "<input type='submit' data-reqto='{$_username}' data-reqfrom='{$_SESSION['username']}' id='accept-request' class='btn btn-success'
                value='Accept request'>
                <input type='submit' data-reqto='{$_username}' data-reqfrom='{$_SESSION['username']}' id='reject-request' class='btn btn-danger'
                value='Reject request'>
                ";
            }else
            {
               echo "<input type='submit' id='add-friend' data-reqto='{$_username}' data-reqfrom='{$_SESSION['username']}'  class='btn btn-primary'
               value='Add friend'>"; 
            }
         ?>
         </form>
         <?php }?>
    </div> <!-- This is end of request buttons -->

            <div class="d-flex justify-content-center">
            <button class="btn btn-primary" id="friends">View All friends</button>
            </div>
        </div><!-- </mobile>  -->
        <hr>
        <?php echo getSpecificUserPosts($_username); ?>
    </div>

    <div class="card friends-list bg-light d-none d-md-flex col-12 col-md-3 p-0">
                <div class="alert-info d-flex align-items-center p-2">
                <i class="fa fa-arrow-left d-flex d-md-none" id="close"></i>
                <span class="text-dark m-auto h5"><?php echo "<span class='text-primary h4'>".$_username."</span>"; ?> Friends List</span>
                </div>
            <ul class="list-group" id="all-friends">
            
            </ul>
    </div>

    <script>
    
    //Load all friends
$(document).ready(function(e)
{
    viewAllFriends();
    loadProfileData();
});

    function viewAllFriends()
    {
        let request_to = "<?php echo $_username; ?>";
        let request_from = "<?php echo $_SESSION['username']; ?>";
        
        $.ajax({
            url : "process/all-friends.php",
            type : "POST",
            data : {request_to , request_from},
            success : function(data)
            {
                $("#all-friends").html(data);
            }
        });
    }

    function loadProfileData()
{
    let username = "<?php echo $_username; ?>";
    $.ajax({
        url : "process/profile-user-side.php",
        type : "POST",
        data : {username},
        success : function(data)
        {
            $("#profile-data").html(data);
        }
    });
}
    
    </script>

<?php require "includes/footer.php"; ?>