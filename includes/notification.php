<?php
include "db.php";

$query = "SELECT * FROM likes";
$result = mysqli_query($connection,$query);


    while($row = mysqli_fetch_assoc($result))
    {
        $post_id = $row['post_id'];
            if(isPostMine($post_id,$_SESSION['username']))
            {
                $user_id = $row['user_id'];
                $user_image = getUserInfoById("user_image",$user_id);
                $liked_by = getUserInfoById("username",$user_id);
                $notification_status = $row['notification_status'];
                $output = "<li class='list-group-item d-flex align-items-center";
                if($notification_status == "unseen")
                {
                    $output.=" bg-not-seen";
                }else{
                    $output.=" bg-light";
                }
                $output.= "'><div class='image-preview my-2 mx-1'><a href='$liked_by'><img src='assets/images/profiles/$user_image'alt='image'></a></div>";
                $output.="<div class='d-flex flex-column ml-2'>
                <a href='view-all-comment.php?post_id=$post_id'><span class='text-primary'>$liked_by</span><span class='text-dark'> liked your post</span></a>";
                $output.= "</li>";
                echo $output;
            }
    }
