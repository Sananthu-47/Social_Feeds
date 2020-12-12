<?php require "includes/header.php"; ?>
<?php include "includes/nav.php"; ?>

<?php 

if(!isset($_SESSION['username']))
    {
        header("Location: login.php");
        die();
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
    <i class="fa fa-refresh fa-spin fa-3x fa-fw loading"></i>
    <span class="sr-only">Loading...</span>
    </div>
    <!-- Add friend button  -->
    <div class='d-flex justify-content-center'>
    <?php 
    if($_username !== $_SESSION['username'])
    {?>
        <form  id="friend-form" method="POST">
         <?php
            if(isFriend($_username , $_SESSION['username']))
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
    <div class="content" id="main-content">
    <div id="say-something">
        <?php 
        if(isFriend($_username , $_SESSION['username']) || $_username == $_SESSION['username'])
        {
        include "includes/say-something.php";
        } ?>
    </div>
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
            if(isFriend($_username , $_SESSION['username']))
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
            <a href='friends.php'><button class="btn btn-primary" id="friends">View All friends</button></a>
            </div>
        </div><!-- </mobile>  -->
        <!--   Get all specific users  -->
        <div id='all-posts'><hr></div>
        <i class="fa fa-refresh fa-spin fa-3x fa-fw loading"></i>
        <span class="sr-only">Loading...</span>
    </div>
    </div>

    <div class="card friends-list bg-light d-none d-md-flex col-12 col-md-3 p-0">
                <div class="alert-info d-flex align-items-center p-2">
                <i class="fa fa-arrow-left d-flex d-md-none" id="close"></i>
                <span class="text-dark m-auto h5"><?php echo "<span class='text-primary h4'>".$_username."</span>"; ?> Friends List</span>
                </div>
            <ul class="list-group" id="all-friends">
            <i class="fa fa-refresh fa-spin fa-3x fa-fw loading"></i>
            <span class="sr-only">Loading...</span>
            </ul>
    </div>

    <script>
    let flag = 0;
  let over_alert = true;
    //Load all friends
$(document).ready(function(e)
{
    $(".loading").hide();
    viewAllFriends();
    loadProfileData();
    getSpecificUserPost(flag);
    updateUserLastSeen();

    $(".main-content").scroll(function(){
        if($(".main-content").scrollTop() >= $("#main-content").height() - $(window).height())
        {
            if(over_alert == true)
            {
            getSpecificUserPost(flag+=5);
            }
        }
        });
});



    //Delete specific post
$(document).on('click',"#delete-post",function(e){
    let request_from = $(this).data("user");
    let post_id =$(this).data("postid");
let conformation = confirm("Do you really want to delete the post");
if(conformation)
{
    $.ajax({
        url : "process/delete-post.php",
        type : "POST",
        data : {request_from , post_id},
        success : function(data)
        {
            if(data == 1)
            {
            loadProfileData();
            $("#all-posts").html('');
            $("#all-posts").html('<hr>');
            flag = 0;
            getSpecificUserPost(flag);
            }else{
                alert(data);
            }
        }
    });
}
});

//Add post
$("#my-form").on('submit',function(e){
    e.preventDefault();
        let formData = new FormData(this);
        formData.append("post_by","<?php echo $_SESSION['username']; ?>");
        formData.append("post_to","<?php echo $_username ;?>");

            $.ajax({
            url : "process/add-post.php",
            type : "POST",
            data : formData,
            contentType : false,
            processData : false,
            success : function(data)
            {
                if(data === 0)
                {
                    alert("Post cannot be empty");
                }else{
            loadProfileData();
            $("#all-posts").html('');
            $("#all-posts").html('<hr>');
            $("#post-content").val('');
            flag = 0;
            getSpecificUserPost(flag);
            removeImage();
                }
            }
        });
    });

    function getSpecificUserPost(page)
    {
        let username = "<?php echo $_username; ?>";
        let loggedInUser = "<?php echo $_SESSION['username'] ?>";
        $.ajax({
            url : "process/get-specific-user-post.php",
            type : "POST",
            data : {username,loggedInUser,page},
            beforeSend : function(){
            $(".loading").show();
            },
            success : function(data)
            {
                if(data === "No post!")
                {
                    $('.over-data').remove();
                    over_alert = false;
                }
                $("#all-posts").append(data);
                $(".loading").hide();
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
//Like a post
$(document).on('click',"#like",function(e){
    let post_id = $(this).data("post");
    let user_id = "<?php echo getUserInfo("id",$_SESSION['username']); ?>";
    let postCount = $("#post"+post_id);
    let likeBtn = this;
    $.ajax({
        url : "process/like.php",
        type : "POST",
        data : {post_id , user_id},
        success : function(data)
        {
            let result = JSON.parse(data);
            
            if(result.status == "add-like")
            {
            likeBtn.classList.remove("badge-secondary");
            likeBtn.classList.add("badge-primary");
            postCount.html(result.like);
            }else{
            likeBtn.classList.add("badge-secondary");
            likeBtn.classList.remove("badge-primary");
            postCount.html(result.like);
            }
        }
    });
});

//Comment on post
$(document).on('click',"#comment",function(e){
    e.preventDefault();
    let post_id = $(this).data("post");
    let user_id = "<?php echo getUserInfo("id",$_SESSION['username']); ?>";
    let commentCount = $("#comment"+post_id);
    let comment_body = $("textarea#comment_field"+post_id).val();
    if(comment_body !== "")
    {
    $.ajax({
        url : "process/comments.php",
        type : "POST",
        data : {post_id , user_id , comment_body},
        success : function(data)
        {
            $("textarea#comment_field"+post_id).val('');
            commentCount.html(" " + data);
            latestComment(post_id);
        }
    });
    }
});

//Latest comment
function latestComment(post_id)
{
    $.ajax({
        url : "process/latest-comment.php",
        type : "POST",
        data : {post_id},
        success : function(data)
        {
            $("#comment-"+post_id).html('');
            $("#comment-"+post_id).html(data);
        }
    });
    }
    
    </script>

<?php require "includes/footer.php"; ?>