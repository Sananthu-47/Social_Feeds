<?php
    include "../includes/db.php";
    include "../global.php";
    $user = $_POST['request_from'];
    $post_id = $_POST['post_id'];
    $post_image = getPostInfo('post_image',$post_id);
    $query = "DELETE FROM posts WHERE id = '$post_id'";
    $result = mysqli_query($connection,$query);
    $query = "DELETE FROM notifications WHERE post_id = '$post_id'";
    $result = mysqli_query($connection,$query);
    $query = "DELETE FROM comments WHERE post_id = '$post_id'";
    $result = mysqli_query($connection,$query);
    $query = "DELETE FROM likes WHERE post_id = '$post_id'";
    $result = mysqli_query($connection,$query);
    $query = "DELETE FROM comment_likes WHERE post_id = '$post_id'";
    $result = mysqli_query($connection,$query);
    $query = "DELETE FROM comment_replies WHERE post_id = '$post_id'";
    $result = mysqli_query($connection,$query);
    $total_post = getUserInfo('posts',$user) - 1;
    $post_image = getPostInfo('post_image',$post_id);
    $query = "UPDATE users SET posts = '$total_post' WHERE username = '$user'";
    $result = mysqli_query($connection,$query);
    $query = "DELETE FROM comments WHERE post_id = '$post_id'";
    $result = mysqli_query($connection,$query);
    if($result)
    {
        echo 1;
    }else{
        echo "Couldn't delete post";
    }