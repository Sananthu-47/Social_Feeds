<?php
include "../includes/db.php";
include "../global.php";

$comment_id =  $_POST['comment_id'];
$reply_page =  $_POST['reply_page'];
$_username = $_POST['username'];
$reply_page +=5;
$query = "SELECT * FROM comment_replies WHERE comment_id = '$comment_id' ORDER BY id DESC LIMIT $reply_page , 5";
$result = mysqli_query($connection,$query);
$replied_comment_total = mysqli_query($connection,"SELECT * FROM comment_replies WHERE comment_id = '$comment_id'");
$replied_comment_total = mysqli_num_rows($replied_comment_total) - $reply_page - 5;

while($row = mysqli_fetch_assoc($result))
{
    $reply_id = $row['id'];
    $post_id = $row['post_id'];
    $post_by = getPostInfo('posted_by',$post_id);
    $replied_message = $row['replied_message'];
    $replied_from_id = $row['replied_from'];
    $replied_to_id = $row['replied_to'];
    $replied_at = $row['replied_at'];
    date_default_timezone_set("Asia/Calcutta");
    $time_now = date("Y-m-d H:i:s");
    $replied_at = new DateTime($replied_at);
    $end_date = new DateTime($time_now);
    $interval = $replied_at->diff($end_date);
    $comment_time_message = getDateFormat($interval);
    $replied_from = getUserInfoById('username',$replied_from_id);
    $replied_to = getUserInfoById('username',$replied_to_id);
    $reply_user_image = getUserInfo('user_image',$replied_from);
    $comment_total_likes = mysqli_query($connection,"SELECT * FROM comment_likes WHERE reply_comment_id = '$reply_id'");
    $comment_total_likes = mysqli_num_rows($comment_total_likes);

    echo "
    <div id='comments-holder'>

                    <div class='d-flex flex-column'>

                    <div class='comment-details mx-2 d-flex'>
                    <div class='comment-preview my-2 mx-1' id='all-replies'>
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
                    <span class='mr-1 notification-time small-text text-primary' id='reply-like-count-$reply_id'>$comment_total_likes</span>
                    <i class='fa fa-heart fa-r-xs text-";
                    if(commentReplyLiked($reply_id,getUserInfo('id',$_username)))
                    {
                        echo "danger";
                    }else{
                        echo "secondary";
                    }

                    echo "' role='button' id='comment-reply-like' data-comment-id='$comment_id' data-reply-comment-id='$reply_id' data-post-id='$post_id'></i>
                    <span class='text-info notification-time ml-2 comment-reply-button small-text' role='button' data-comment-id='$comment_id' data-comment-replied-id='$reply_id' data-post-id='$post_id' data-comment-username='$replied_from' data-comment-user-id='$replied_from_id'> Reply</span>
                    </div>

                    </div> ";

                    if($post_by === $_username)
                    {
                   echo " 
                    <div id='comment-details'>
                    <i class='fa fa-trash mx-2' id='delete-replied-comment' data-id='$reply_id' data-postid='$post_id'></i>";

                    if($replied_from === $_username)
                    {
                        echo "<i class='fa fa-edit text-dark mx-2' id='edit-comment-replied' data-postid='$post_id' data-commentid='$reply_id'></i>";
                    }

                    echo "</div>";
                    }else
                    if($replied_from === $_username)
                    {
                            echo " 
                        <div id='comment-details'>
                        <i class='fa fa-trash mx-2' id='delete-replied-comment' data-id='$reply_id' data-postid='$post_id'></i>
                        <i class='fa fa-edit text-dark mx-2' id='edit-comment-replied' data-postid='$post_id' data-commentid='$reply_id'></i>
                        </div>";
                    }

                    echo " </div>

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
