<?php

function charecterParse($val)
{
    global $connection;
    return mysqli_real_escape_string($connection,$val);
}

function alert($color,$msg)
{
    echo "<div class='alert $color'>$msg</div>";
}

function getUserInfo($getValue,$username)
{
    global $connection;
    $query = "SELECT $getValue FROM users where username = '$username'";
        $result = mysqli_query($connection,$query);

        if(!$result)
        {
            die("Error".mysqli_error($connection));
        }
        $row = mysqli_fetch_array($result);
        return $row[0];
}


function addPost($post_to,$post_data,$image)
{
    global $connection;
    if(!empty($post_data) || !empty($image))
    {
        $post_body = charecterParse(strip_tags($post_data));
        $image = $image;
        $post_at = date("Y-m-d H:i:s");
        $post_to = $post_to;
        $post_by = $_SESSION['username'];
        $post_image =time(). '_' . $image;
        if($image == '')
        {
            $post_image = "none";
        }
        $post_image_temp = $_FILES['image']['tmp_name'];
        move_uploaded_file($post_image_temp,"assets/images/posts/$post_image");

        if($post_by == $post_to)
        {
            $post_to="";
        }

        $query = "INSERT INTO posts (post_body , post_image , post_to, posted_by , posted_at) VALUES ('{$post_body}' , '{$post_image}' , '{$post_to}' , '{$post_by}' , '{$post_at}')";
        $result = mysqli_query($connection,$query);

        $total_post = getUserInfo('posts',$post_by);
        $query = "UPDATE users SET posts = $total_post+1 WHERE username = '$post_by'";
        $result = mysqli_query($connection,$query);

    }else{
        alert('alert-danger','Post cannot be empty!');
    }
}

function getAllPosts()
{
    global $connection;
    $query = "SELECT * FROM posts ORDER BY id DESC";
    $result = mysqli_query($connection,$query);

    if(!$result)
    {
        alert("alert-danger","Failed to fetch posts");
    }

    while($row = mysqli_fetch_assoc($result))
    {
        $post_body = $row['post_body'];
        $post_image = $row['post_image'];
        $post_user = $row['posted_by'];
        $posted_at = $row['posted_at'];
        $post_likes = $row['likes'];
        $user_image = getUserInfo('user_image',$post_user);
        $time_message = '';
        //Timeframe

        $date_time_now = date("Y-m-d H:i:s");
        $post_posted = new DateTime($posted_at);
        $end_date = new DateTime($date_time_now);
        $interval = $post_posted->diff($end_date);
        if($interval->y >= 1)
        {
            if($interval->y==1)
            {
                $time_message = $interval->y . " year ago";
            }else{
                $time_message = $interval->y . " years ago";
            }
        }else if($interval->m >= 1)
        {
            if($interval->m==1)
            {
                $time_message = $interval->m . " month ago";
            }else{
                $time_message = $interval->m . " months ago";
            }
        }else if($interval->d >= 1)
        {
            if($interval->d == 1)
            {
                $time_message = $interval->d . " day ago";
            }else{
                $time_message = $interval->d . " days ago";
            }
        }else if($interval->h >= 1)
        {
            if($interval->h == 1)
            {
                $time_message = $interval->h . " hour ago";
            }else{
                $time_message = $interval->h . " hours ago";
            }
        }else if($interval->i >= 1)
        {
            if($interval->i == 1)
            {
                $time_message = $interval->i . " minute ago";
            }else{
                $time_message = $interval->i . " minutes ago";
            }
        }else
        {
            if($interval->s < 30)
            {
                $time_message = "Just now";
            }else{
                $time_message = $interval->s . " seconds ago";
            }
        }

        echo "
        <div class='d-flex flex-column justify-content-center'>
        
            <div class='user-details mx-2 d-flex'>
            <div class='image-preview mx-3'>
            <img src='assets/images/profiles/$user_image' alt='image'>
            </div>
            <div class='d-flex flex-column'>
            <span class='text-primary'>$post_user</span>
            <span class='text-dark'>$time_message</span>
            </div>
            </div>";

            if($post_image!=="none")
            {
                echo "
                <div class='post-body my-2'>
                <span class='m-4'>$post_body</span>
                </div>

                <div class='post-image w-100 h-100 d-flex justify-content-center'>
                <img class='w-75 h-25' src='assets/images/posts/$post_image' alt='image'>
                </div>
                
                <div class='container my-2 mx-auto w-75 bg-white d-flex justify-content-between align-items-center'>
                <div class='d-block'><span class='badge badge-primary p-2 mr-1'>$post_likes</span>
                <span class='badge badge-secondary'><span>Like</span> <i class='fa fa-thumbs-up fa-lg'></i></span>
                </div>
                <span>Comments <i class='fa fa-comments'>1</i></span>
                </div>
                ";
            }else{
                echo "
                <div class='post-body'>
                <span class='m-4 h4'>$post_body</span>
                </div>
                
                <div class='container my-2 mx-auto w-100 bg-white d-flex justify-content-between align-items-center'>
                <div class='d-block'><span class='badge badge-primary p-2 mr-1'>$post_likes</span>
                <span class='badge badge-secondary'><span>Like</span> <i class='fa fa-thumbs-up fa-lg'></i></span>
                </div>
                <span>Comments <i class='fa fa-comments'>1</i></span>
                </div>
                ";
            }

           echo "</div><br><hr>";
    }
}

