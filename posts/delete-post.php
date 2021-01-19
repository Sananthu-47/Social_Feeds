<?php
    include "../includes/db.php";
    include "../global.php";
    $user = $_POST['request_from'];
    $post_id = $_POST['post_id'];
    $post_image = getPostInfo('post_image',$post_id);
    $query = "DELETE FROM posts WHERE id = '$post_id'";
    $result = mysqli_query($connection,$query);
    $total_post = getUserInfo('posts',$user) - 1;
    $post_image = getPostInfo('post_image',$post_id);
    chown("www-data:www-data","../assets/images/posts/".$post_image);
    $query = "UPDATE users SET posts = '$total_post' WHERE username = '$user'";
    $result = mysqli_query($connection,$query);
    $query = "DELETE FROM comments WHERE post_id = '$post_id'";
    $result = mysqli_query($connection,$query);
    $path = "../assets/images/posts/".$post_image;
    if($result)
    {
        if($post_image !== "none")
        {
            unlink($path);
        }
        echo 1;
    }else{
        echo "Couldn't delete post";
    }