<?php

$page = 0;
if(isset($_POST['post_id']))
{
    include "../includes/db.php";
    include "../global.php";
    $post_id = $_POST['post_id'];
    $page = $_POST['page'];
    $page = $page + 5;
    $_username = $_POST['username'];
}

$query = "SELECT * FROM comments WHERE post_id = '$post_id' ORDER BY id DESC LIMIT $page , 5";
                $result = mysqli_query($connection,$query);

                if(mysqli_num_rows($result)>0)
                {
                while($row = mysqli_fetch_assoc($result))
                {
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
                    $comment_user_details = mysqli_fetch_assoc($comment_user_details);
                    $comment_id = $comment_user_details['id'];
                    $comment_username = $comment_user_details['username'];
                    $comment_user_image = $comment_user_details['user_image'];
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
                
                    <div class='ml-3 '>
                    <span class='lead wrap-comment'>$newest_comment</span>
                    </div>";

                    if($post_by === $_username)
                    {
                   echo " 
                    <div id='comment-details'>
                    <i class='fa fa-trash mx-2' id='delete-post' data-user='$post_by' data-postId='$comment_id'></i>
                    <a href='update-post-form.php?post_id=$comment_id' class='text-dark'><i class='fa fa-check' id='edit-post'></i></a>";

                    if($post_by === $_username)
                    {
                        echo "<a href='update-post-form.php?post_id=$comment_id' class='text-dark mx-2'><i class='fa fa-edit' id='edit-post'></i></a>";
                    }

                    echo "</div>";
                    }else
                    if($comment_username === $_username)
                    {
                            echo " 
                        <div id='comment-details'>
                        <i class='fa fa-trash mx-2' id='delete-post' data-user='$post_by' data-postId='$comment_id'></i>
                        <a href='update-post-form.php?post_id=$comment_id' class='text-dark'><i class='fa fa-edit' id='edit-post'></i></a>
                        </div>";
                    }

                    echo "</div>";
                }

                echo "
                <div class='text-center m-2' id='loaded-comments'>
                <hr>
                <div class='btn btn-info' id='load-more' data-page='$page' data-id='$post_id'>Load more</div>
                </div>";
            }
                