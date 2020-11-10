<?php require "includes/header.php"; ?>
<?php include "includes/nav.php"; ?>

<?php 
    if(isset($_GET['profile_username']))
    {
        $_username = $_GET['profile_username'];
    }
?>

<div class="w-100 d-flex justify-content-center home-wrapper">
    <div class="card bg-light d-none d-md-flex col-3 p-0">
    <div class="d-flex justify-content-center">
        <?php include "includes/profile-user-side.php"; ?>
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
            viewAllFriends();
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
        }
    });
});

</script>

    <div class="card main-content bg-light col-12 col-md-6 p-0">
    <div class="content">
        <?php include "includes/say-something.php"; ?>
        <hr>
        <!--- Mobile view of profile --->
        <div class="d-flex d-md-none flex-column text-center">
            <div class="profile-mobile">
                <a href="<?php echo $_username; ?>"><img src="assets/images/profiles/<?php echo getUserInfo('user_image',$_username); ?>" class="profile-image-tag" alt=""></a>
            </div>
            <span class="text-primary h3"><?php echo getUserInfo('username',$_username); ?></span>
            <!-- <a href="mobile-friends.php"><input type="submit" name="see-friends" value="Friends" class="btn btn-info"></a> -->
            <div class="btn btn-primary btn-small" id="friends">Friends</div>
        </div><!-- </mobile>  -->

        <?php echo getSpecificUserPosts($_username); ?>
    </div>
    </div>

    <div class="card friends-list bg-light d-none d-md-flex col-12 col-md-3 p-0">
                <div class="alert-info text-center p-2">
                <span class="text-dark h4"><?php echo "<span class='text-primary h3'>".$_username."</span>"; ?> Friends List</span>
                </div>
            <ul class="list-group" id="all-friends">
            
            </ul>
    </div>

    <script>
    
    //Load all friends
$(document).ready(function(e)
{
    viewAllFriends();
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
    
    </script>

<?php require "includes/footer.php"; ?>