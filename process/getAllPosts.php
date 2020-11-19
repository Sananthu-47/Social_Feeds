<?php
    include "../includes/db.php";
    include "../global.php";

$username = $_POST['username'];
$page = $_POST['page'];
$query = "SELECT * FROM posts ORDER BY id DESC LIMIT $page , 5";
    $result = mysqli_query($connection,$query);

    if(!$result)
    {
        alert("alert-danger","Failed to fetch posts");
    }

    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
                $post_body = $row['post_body'];
                $post_image = $row['post_image'];
                $post_user = $row['posted_by'];
                $posted_at = $row['posted_at'];
                $post_likes = $row['likes'];
                $user_image = getUserInfo('user_image',$post_user);
                $date_time_now = date("Y-m-d H:i:s");
                $post_posted = new DateTime($posted_at);
                $end_date = new DateTime($date_time_now);
                $interval = $post_posted->diff($end_date);
                $time_message = getDateFormat($interval);

            if(isFriend($post_user,$username) || $post_user === $username)
            {
                echo "
                <div class='d-flex flex-column justify-content-center'>
                
                    <div class='user-details mx-2 d-flex'>
                    <div class='image-preview mx-3'>
                    <a href='$post_user'><img src='assets/images/profiles/$user_image' alt='image'></a>
                    </div>
                    <div class='d-flex flex-column'>
                    <a href='$post_user'><span class='text-primary'>$post_user</span></a>
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
                <div class='container my-2 mx-auto like-comment bg-white d-flex justify-content-between align-items-center'>
                <div class='d-block'><span class='badge badge-primary mr-1'>$post_likes</span>
                <span class='badge badge-secondary'><span>Like</span> <i class='fa fa-thumbs-up fa-lg'></i></span>
                </div>
                <span>Comments <i class='fa fa-comments'>1</i></span>
                </div>
                </div><br><hr>";
            }
        }//while end
    }//if end
    else
    {
        return "<div class='text-secondary text-center my-3'>No post!</div>"; 
    }

