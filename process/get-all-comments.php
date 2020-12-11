<?php
    
    if(isset($_GET['post_id']))
    {

$post_id = $_GET['post_id'];
$username = $_SESSION['username'];
$query = "SELECT * FROM posts WHERE id = '$post_id'";
$result = mysqli_query($connection,$query);

    if(!$result)
    {
        alert("alert-danger","Failed to fetch comments");
    }
                $row = mysqli_fetch_assoc($result);
                $post_body = $row['post_body'];
                $post_image = $row['post_image'];
                $post_user = $row['posted_by'];
                $post_to = $row['post_to'];
                $posted_at = $row['posted_at'];
                $post_likes = $row['likes'];
                $user_image = getUserInfo('user_image',$post_user);
                date_default_timezone_set("Asia/Calcutta");
                $date_time_now = date("Y-m-d H:i:s");
                $post_posted = new DateTime($posted_at);
                $end_date = new DateTime($date_time_now);
                $interval = $post_posted->diff($end_date);
                $time_message = getDateFormat($interval);
                $total_comments = mysqli_query($connection,"SELECT * FROM comments WHERE post_id = '$post_id'");
                $total_comments = mysqli_num_rows($total_comments);

                echo "
                <div class='d-flex flex-column justify-content-center mt-2'>
                
                    <div class='user-details mx-2 d-flex'>
                        <div class='image-preview mx-3'>
                        <a href='$post_user'><img src='assets/images/profiles/$user_image' alt='image'></a>
                        </div>
                            <div class='d-flex flex-column'>
                            <span class='d-flex user-post'>
                            <a href='$post_user'><span class='text-primary'>$post_user</span></a>";

                    if($post_to !== "none")
                    {
                        echo "&nbsp;posted to&nbsp;<a href='$post_to'><span class='text-primary'>$post_to</span></a>";
                    }

                            echo "
                            </span>
                            <span class='text-dark'>$time_message</span>
                            </div>
                            </div>";

                    if($post_image!=="none")
                    {
                        echo "
                        <div class='post-body m-2'>
                        <span>$post_body</span>
                        </div>

                        <div class='post-image m-auto d-flex justify-content-center'>
                        <img class='w-100' src='assets/images/posts/$post_image' alt='image'>
                        </div>";
                    }else{
                        echo "
                        <div class='post-body m-2'>
                        <span class='h4 px-3'>$post_body</span>
                        </div> ";
                    }

                echo " 
                <div class='container my-2  like-comment bg-white d-flex justify-content-between align-items-center'>
                <div class='d-block'><span class='badge badge-primary mr-1' id='post".$post_id."'>$post_likes</span>
                <span class='badge badge-";
                if(postLiked($post_id,getUserInfo('id',$username)))
                {
                    echo "primary";
                }else{
                    echo "secondary";
                }
                echo "' id='like' data-post='$post_id'><span>Like</span> <i class='fa fa-thumbs-up fa-lg'></i></span>
                </div>
                <span>Comments <i class='fa fa-comments'></i><span id='comment".$post_id."'> $total_comments</span></span>
                </div>
                <div class='container d-flex mx-auto my-1 like-comment'>
                    <div class='col-9'><textarea class='col-12' contenteditable placeholder='comment here..' name='comment_field' id='comment_field'></textarea></div>
                    <div class='col-2' id='comment-btn'><input type='button' id='comment' data-postid='$post_id' class='btn btn-secondary p-1' value='Comment' name='post_comment'></div>
                </div>
                
                <span class='mx-3'>Comments</span>
                <div id='comment-$post_id'>";

                include "display-all-comments.php";

                echo "
                </div>
                </div>";

}
