<?php

if(isset($_POST['post_id']))
{
    include "../includes/db.php";
include "../global.php";
    $post_id = $_POST['post_id'];
}


$total_comments = mysqli_query($connection,"SELECT * FROM comments WHERE post_id = '$post_id'");
$total_comments = mysqli_num_rows($total_comments);

if($total_comments > 0)
                {
                    $comment_detail = mysqli_query($connection,"SELECT * FROM comments WHERE post_id = '$post_id' ORDER BY id DESC LIMIT 1");
                    $comment_detail = mysqli_fetch_assoc($comment_detail);
                    $newest_comment = $comment_detail['comment'];
                    $commented_at = $comment_detail['comment_date'];
                    date_default_timezone_set("Asia/Calcutta");
                    $time_now = date("Y-m-d H:i:s");
                    $comment_at = new DateTime($commented_at);
                    $end_date = new DateTime($time_now);
                    $interval = $comment_at->diff($end_date);
                    $comment_time_message = getDateFormat($interval);
                    $comment_user_id = $comment_detail['comment_user_id'];
                    $comment_user_details = mysqli_query($connection,"SELECT * FROM users WHERE id = '$comment_user_id'");
                    $comment_user_details = mysqli_fetch_assoc($comment_user_details);
                    $comment_username = $comment_user_details['username'];
                    $comment_user_image = $comment_user_details['user_image'];
                    echo "
                    <div class='comment-details mx-2 d-flex'>
                    <div class='comment-preview my-2 mx-1'>
                    <a href='$comment_username'><img src='assets/images/profiles/$comment_user_image' alt='image'></a>
                    </div>
                
                    <div class='d-flex flex-column'>
                    <span class='d-flex user-post'>
                    <a href='$comment_username'><span class='text-primary small-text'>$comment_username</span></a>
                    </span>
                    <span class='text-dark small-text'>$comment_time_message</span>
                    </div>
                
                    <div class='ml-3 '>
                    <span class='lead wrap-comment'>$newest_comment</span>
                    </div>
                    </div>
                    <div class='d-flex justify-content-end'><a href='#'>View all comments</a></div>";
                }else{
                    echo "<span class='mx-3'>No comments yet</span>";
                }


    