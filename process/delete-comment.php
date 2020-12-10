<?php
    include "../includes/db.php";
    include "../global.php";
    $comment_id = $_POST['comment_id'];
    $post_id = $_POST['post_id'];
    $query = "DELETE FROM comments WHERE id = '$comment_id'";
    $result = mysqli_query($connection,$query);
    
    if($result)
    {
        $query = "SELECT * FROM comments WHERE post_id = '$post_id'";
        $result = mysqli_query($connection,$query);
        $response = mysqli_num_rows($result);
        echo $response;
    }else{
        echo 0;
    }