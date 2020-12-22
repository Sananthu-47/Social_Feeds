<?php

if(isset($_POST['post_id']))
{
    include "../includes/db.php";
    include "../global.php";
    $post_id = $_POST['post_id'];
    $page = $_POST['page'];
    $page = $page + 5;
    $_username = $_POST['username'];
}else{
    $page = 0;
}

$query = "SELECT * FROM comments WHERE post_id = '$post_id' ORDER BY id DESC LIMIT $page , 5";
                $result = mysqli_query($connection,$query);

                if(mysqli_num_rows($result)>0)
                {
                while($row = mysqli_fetch_assoc($result))
                {
                    $comment_id = $row['id'];
                    $newest_comment = $row['comment'];
                    $commented_at = $row['comment_date'];
                    date_default_timezone_set("Asia/Calcutta");
                    $time_now = date("Y-m-d H:i:s");
                    $comment_at = new DateTime($commented_at);
                    $end_date = new DateTime($time_now);
                    $interval = $comment_at->diff($end_date);
                    $comment_time_message = getDateFormat($interval);
                    $comment_user_id = $row['comment_user_id'];
                    $comment_user_details = mysqli_query($connection,"SELECT * FROM users WHERE id = '$comment_user_id'");
                    $comment_user_data = mysqli_fetch_assoc($comment_user_details);
                    $comment_total_likes = mysqli_query($connection,"SELECT * FROM comment_likes WHERE comment_id = '$comment_id'");
                    $comment_total_likes = mysqli_num_rows($comment_total_likes);
                    $comment_username = $comment_user_data['username'];
                    $comment_user_image = $comment_user_data['user_image'];
                    $post_by = getPostInfo("posted_by",$post_id);

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
                
                    <div class='ml-3 d-flex flex-column'>
                    <span class='lead wrap-comment'>$newest_comment</span>
                    <div class='d-flex align-items-center'>
                    <span class='mr-1 notification-time text-primary' id='like-count-".$comment_id."'>$comment_total_likes</span>
                    <i class='fa fa-heart fa-sm text-";
                    if(commentLiked($comment_id,getUserInfo('id',$username)))
                    {
                        echo "danger";
                    }else{
                        echo "secondary";
                    }

                    echo "' role='button' id='comment-like' data-comment-id='$comment_id' data-post-id='$post_id'></i>
                    <span class='text-info notification-time ml-3' role='button' data-comment-id='$comment_id' data-post-id='$post_id'>Reply</span>
                    </div>
                    </div>";

                    if($post_by === $_username)
                    {
                   echo " 
                    <div id='comment-details'>
                    <i class='fa fa-trash mx-2' id='delete-comment' data-id='$comment_id' data-postid='$post_id'></i>";

                    if($comment_username === $_username)
                    {
                        echo "<i class='fa fa-edit text-dark mx-2' id='edit-comment' data-postid='$post_id' data-commentid='$comment_id'></i>";
                    }

                    echo "</div>";
                    }else
                    if($comment_username === $_username)
                    {
                            echo " 
                        <div id='comment-details'>
                        <i class='fa fa-trash mx-2' id='delete-comment' data-id='$comment_id' data-postid='$post_id'></i>
                        <i class='fa fa-edit text-dark mx-2' id='edit-comment' data-postid='$post_id' data-commentid='$comment_id'></i>
                        </div>";
                    }

                    echo "
                    </div>
                    <div class='m-1 d-none' id='reply-comment'><input type='text' placeholder='Reply to this comment' class='form-control d-flex'><input type='submit' class='btn btn-primary mx-1' value='Reply'></div>";
                }

                echo "
                <div class='text-center m-2' id='loaded-comments'>
                <hr>
                <div class='btn btn-info' id='load-more' data-page='$page' data-id='$post_id'>Load more</div>
                </div>";
            }
