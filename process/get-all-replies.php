<?php
include "../includes/db.php";
include "../global.php";

$comment_id =  $_POST['comment_id'];
$reply_page =  $_POST['reply_page'];
$_username = $_POST['username'];
$reply_page +=5;
$query = "SELECT * FROM comment_replies WHERE comment_id = '$comment_id' LIMIT $reply_page , 5";
$result = mysqli_query($connection,$query);
$replied_comment_total = mysqli_query($connection,"SELECT * FROM comment_replies WHERE comment_id = '$comment_id'");
$replied_comment_total = mysqli_num_rows($replied_comment_total) - $reply_page - 5;

while($row = mysqli_fetch_assoc($result))
{
    $replied_message = $row['replied_message'];
    $replied_from = $row['replied_from'];
    $replied_to = $row['replied_to'];
    $replied_at = $row['replied_at'];
    date_default_timezone_set("Asia/Calcutta");
    $time_now = date("Y-m-d H:i:s");
    $replied_at = new DateTime($replied_at);
    $end_date = new DateTime($time_now);
    $interval = $replied_at->diff($end_date);
    $comment_time_message = getDateFormat($interval);
    $replied_from = getUserInfoById('username',$replied_from);
    $replied_to = getUserInfoById('username',$replied_to);
    $reply_user_image = getUserInfo('user_image',$replied_from);

    echo "
                    <div class='d-flex flex-column'>

                    <div class='comment-details mx-2 d-flex'>
                    <div class='comment-preview my-2 mx-1'>
                    <a href='$replied_from'><img src='assets/images/profiles/$reply_user_image' alt='image'></a>
                    </div>
                
                    <div class='d-flex flex-column'>
                    <span class='d-flex user-post'>
                    <a href='$replied_from'><span class='text-primary small-text'>$replied_from</span></a>
                    </span>
                    <span class='text-dark small-text'>$comment_time_message</span>
                    </div>
                
                    <div class='ml-3 d-flex flex-column'>
                    <span class='small-text wrap-comment'>
                    <a href='$replied_to'><span class='text-primary small-text'>@$replied_to</span></a>
                    $replied_message</span>

                    <div class='d-flex align-items-center my-1'>
                    <span class='mr-1 notification-time small-text text-primary'>0</span>
                    <i class='fa fa-heart fa-r-xs text-secondary' role='button' id='comment-like'></i>
                    <span class='text-info notification-time ml-2 reply-button small-text' id='reply-button' role='button'> Reply</span>
                    </div>

                    </div> 
                    </div>";
}

if($replied_comment_total>0)
{
        echo "<div id='load-more-replies' data-comment-id='$comment_id' data-reply-page='$reply_page' class='text-primary'>$replied_comment_total";
            if($replied_comment_total==1)
            {
                echo " Reply";
            }else{
                echo " Replies";
            }
            echo"</div>";
}
