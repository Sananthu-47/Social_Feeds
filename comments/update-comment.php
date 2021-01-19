<?php
include "../includes/db.php";
include "../global.php";
$comment_id = $_POST['comment_id'];
$comment_body = $_POST['comment_body'];
$post_id = $_POST['post_id'];

$query = "UPDATE comments SET comment = '{$comment_body}' WHERE id = '{$comment_id}'";
$result = mysqli_query($connection,$query);
if($result)
{
    echo "<input type='button' id='comment' data-postid='$post_id' class='btn btn-secondary p-1' value='Comment' name='post_comment'>";
}