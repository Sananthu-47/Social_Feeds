<?php
include "../global.php";
include "../includes/db.php";

$image = $_FILES['image']['name'];
$post_image_temp = $_FILES['image']['tmp_name'];
$post_to = $_POST['post_to'];
$post_by = $_POST['post_by'];
$post_body = $_POST['post_body'];
$post_to = charecterParse(strip_tags($post_to));
$post_by = charecterParse(strip_tags($post_by));
$post_body = charecterParse(strip_tags($post_body));
$notification_to = getUserInfo('id',$post_to);
$notification_by = getUserInfo('id',$post_by);


if(!empty($post_body) || !empty($image))
{
    
$post_image =time(). '_' . $image;
    if($image == '')
    {
        $post_image = "none";
    }

    move_uploaded_file($post_image_temp,"../assets/images/posts/$post_image");

    if($post_by === $post_to || $post_to === '')
    {
        $post_to='none';
    }

    $query = "INSERT INTO posts (post_body , post_image , post_to, posted_by , posted_at) VALUES ('{$post_body}' , '{$post_image}' , '{$post_to}' , '{$post_by}' , now())";
    $result = mysqli_query($connection,$query);
    $post_id = mysqli_insert_id($connection); 

    //Insert to nification table
    if($post_to !== "none")
    {
        $query = "INSERT INTO notifications (type , notified_at , notification_status , notification_to , notification_from , post_id , comment_message) VALUES ('posted' , now() , 'unseen' , '$notification_to' , '$notification_by' , '$post_id' , 'none')";
        $result = mysqli_query($connection,$query);
    }

    $total_post = getUserInfo('posts',$post_by);
    $query = "UPDATE users SET posts = $total_post+1 WHERE username = '$post_by'";
    $result = mysqli_query($connection,$query);
    return 1;
}else{
    return 0;
}