<?php
include "../includes/db.php";
include "../global.php";
$post_id = $_POST['post_id'];
$comment_id = $_POST['comment_id'];

$comment_body = getCommentInfo('comment',$comment_id);
$update_comment = "<input type='button' id='update-comment' data-postid='$post_id' data-commentid='$comment_id' class='btn btn-secondary p-1' value='Update' name='post_comment'>";

$output = [$comment_body , $update_comment];
echo json_encode($output);