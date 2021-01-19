<?php
    include "db.php";
    include "global.php";
    ob_start();
    session_start();
    if(isset($_SESSION['username']))
    {
    if(isset($_GET['profile_username']))
    {
        $_username = $_GET['profile_username'];
    }else{
        $_username = $_SESSION['username'];
    }
    }   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css"></link>
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css"></link>
    <script src="assets/jQuery/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Social_Feeds</title>
</head>
<body>

<script>

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

function updateUserLastSeen()
            {
                let username = "<?php echo $_SESSION['username']; ?>";
                    $.ajax({
                    url : "process/update_last_seen.php",
                    type : "POST",
                    data : {username},
                    success : function(data){
                        viewAllFriends();
                    }
                });
                
            }
            setInterval(updateUserLastSeen, 10000);

//Add friend ajax function
$(document).on('click',"#add-friend",function(e){
    e.preventDefault();
    let request_to = $(this).data("reqto");
    let request_from =$(this).data("reqfrom");
    
    $.ajax({
        url : "friend_requests/add-friend.php",
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
        url : "friend_requests/cancel-friend-request.php",
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
    let notification_from = "<?php echo getUserInfo('id',$_SESSION['username']); ?>";

    $.ajax({
        url : "friend_requests/accept-request.php",
        type : "POST",
        data : {request_to , request_from},
        success : function(data)
        {
            $("#friend-form").html(data);
            $("#friend-form-mobile").html(data);
            viewAllFriends();
            loadProfileData();
            $("#all-notifications").html('');
            loadMoreNotifications(-10,notification_from);//-10 -> To remove previews data
        }
    });
});
//Reject friend request
$(document).on('click','#reject-request',function(e){
    e.preventDefault();
    let request_to = $(this).data("reqto");
    let request_from =$(this).data("reqfrom");
    let notification_from = "<?php echo getUserInfo('id',$_SESSION['username']); ?>";
    $.ajax({
        url : "friend_requests/reject-request.php",
        type : "POST",
        data : {request_to , request_from},
        success : function(data)
        {
            $("#friend-form").html(data);
            $("#friend-form-mobile").html(data);
            $("#all-notifications").html('');
            loadMoreNotifications(-10,notification_from);//-10 -> To remove previews data
        }
    });
});
//Unfriend the following friend
$(document).on('click',"#unfriend",function(e){
    e.preventDefault();
    let request_to = $(this).data("reqto");
    let request_from =$(this).data("reqfrom");

    $.ajax({
        url : "friend_requests/unfriend.php",
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

    //Load more notification

    $(document).on('click',"#load-more-notifications",function(e){
    let page = $(this).data("page");
    let userId = $(this).data("id");
    loadMoreNotifications(page,userId);
});

//Load more comments ajax function
function loadMoreNotifications(page,userId)
{
    $.ajax({
            url : "includes/notification.php",
            type : "POST",
            data : {page,userId},
            beforeSend : function(){
            $(".loading").show();
            },
            success : function(data)
            {
                if(data !== "<li class='list-group-item d-flex align-items-center bg-danger text-white'>No notifications</li>")
                {
                $("#loaded-notification").remove();
                $(".loading").hide();
                $("#all-notifications").append(data);
                }else{
                    $("#load-more-notifications").remove();
                    $(".loading").hide();
                    $("#all-notifications").append(data);
                }
            }
        });
}

//Make the notification seen
$(document).on('click','#notification-seen',function(e){
    let notification_id = $(this).data('notification-id');
    let status = $(this).data('status');
    if(status !== 'seen')
    {
    $.ajax({
            url : "process/notification-seen.php",
            type : "POST",
            data : {notification_id},
            success : function(data)
            {
                status.data('status','seen');
            }
        });   
    }
});

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

//Like post
$(document).on('click',"#like",function(e){
    let post_id = $(this).data("post");
    let user_id = "<?php echo getUserInfo("id",$_SESSION['username']); ?>";
    let postCount = $("#post"+post_id);
    let likeBtn = this;
    $.ajax({
        url : "posts/like.php",
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
        url : "comments/comments.php",
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
        url : "comments/latest-comment.php",
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
                

