<?php
include "../global.php";
include "../includes/db.php";

$image = $_FILES['image']['name'];
$post_image_temp = $_FILES['image']['tmp_name'];
$post_to = 'none';
$post_by = $_POST['post_by'];
$post_data = $_POST['post_body'];
$post_body = charecterParse(strip_tags($post_data));
$post_at = date("Y-m-d H:i:s");
if(!empty($post_data) || !empty($image))
{
    
$post_image =time(). '_' . $image;
    if($image == '')
    {
        $post_image = "none";
    }

    move_uploaded_file($post_image_temp,"../assets/images/posts/$post_image");

    if($post_by == $post_to)
    {
        $post_to="";
    }

    $query = "INSERT INTO posts (post_body , post_image , post_to, posted_by , posted_at) VALUES ('{$post_body}' , '{$post_image}' , '{$post_to}' , '{$post_by}' , '{$post_at}')";
    $result = mysqli_query($connection,$query);

    $total_post = getUserInfo('posts',$post_by);
    $query = "UPDATE users SET posts = $total_post+1 WHERE username = '$post_by'";
    $result = mysqli_query($connection,$query);
    return 1;
}else{
    alert('alert-danger','Post cannot be empty!');
    return 0;
}