<?php
    include "../includes/db.php";
    include "../global.php";
    $reply_id = $_POST['reply_id'];
    $post_id = $_POST['post_id'];
    $query = "DELETE FROM comment_replies WHERE id = '$reply_id'";
    $result = mysqli_query($connection,$query);
    $query = "DELETE FROM notifications WHERE replied_comment_id = '$reply_id'";
    $result = mysqli_query($connection,$query);
    echo 1;
    // if($result)
    // {
    //     $query = "SELECT * FROM comments WHERE post_id = '$post_id'";
    //     $result = mysqli_query($connection,$query);
    //     $response = mysqli_num_rows($result);
    //     echo $response;
    // }else{
    //     echo 0;
    // }