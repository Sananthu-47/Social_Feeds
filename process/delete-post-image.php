<?php
include "../global.php";
include "../includes/db.php";
$post_id = $_POST['post_id'];
$query = "UPDATE posts SET post_image = 'none' WHERE id = '{$post_id}' ";
$result = mysqli_query($connection,$query);
if(!$result)
{
    echo "Image was not removed";
}else{
    echo 1;
}
