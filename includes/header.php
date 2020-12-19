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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
    let notification_from = "<?php echo getUserInfo('id',$_SESSION['username']); ?>";

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
        url : "process/reject-request.php",
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

</script>
                

