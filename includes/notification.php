<?php
include "db.php";

$query = "SELECT * FROM notifications ORDER BY notified_at DESC";
$result = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($result))
    {
        if($row['type'] === 'like')
            {
                $post_id = $row['post_id'];
                if(isPostMine($post_id,$_SESSION['username']))
                {
                    $user_id = $row['notification_from'];
                    $user_image = getUserInfoById("user_image",$user_id);
                    $liked_by = getUserInfoById("username",$user_id);
                    $notification_status = $row['notification_status'];
                    $liked_at = $row['notified_at'];
                    date_default_timezone_set("Asia/Calcutta");
                    $date_time_now = date("Y-m-d H:i:s");
                    $post_liked = new DateTime($liked_at);
                    $end_date = new DateTime($date_time_now);
                    $interval = $post_liked->diff($end_date);
                    $time_message = getDateFormat($interval);
                    $output = "<li class='list-group-item d-flex align-items-center";
                    if($notification_status == "unseen")
                    {
                        $output.=" bg-not-seen";
                    }else{
                        $output.=" bg-light";
                    }
                    $output.= "'><div class='image-preview my-2 mx-1'><a href='$liked_by'><img src='assets/images/profiles/$user_image'alt='image'></a></div>";
                    $output.="<div class='d-flex flex-column ml-2'><a href='view-all-comment.php?post_id=$post_id'><span class='text-";
                    if($liked_by === $_SESSION['username'])
                    {
                        $output.="dark'> You";
                    }else{
                        $output.="primary'>".$liked_by." ";
                    }
                    $output.="</span><span class='text-dark'> liked your post </span><sub class='mx-2 text-secondary notification-time'>$time_message</sub></a>";
                    $output.= "</li>";
                    echo $output;
                }
            }
        else
            if($row['type'] === 'comment')
            {
                $post_id = $row['post_id'];
                if(isPostMine($post_id,$_SESSION['username']))
                {
                    $user_id = $row['notification_from'];
                    $user_image = getUserInfoById("user_image",$user_id);
                    $commented_by = getUserInfoById("username",$user_id);
                    $notification_status = $row['notification_status'];
                    $comment = $row['comment_message'];
                    $comment_date = $row['notified_at'];
                    date_default_timezone_set("Asia/Calcutta");
                    $date_time_now = date("Y-m-d H:i:s");
                    $post_commented = new DateTime($comment_date);
                    $end_date = new DateTime($date_time_now);
                    $interval = $post_commented->diff($end_date);
                    $time_message = getDateFormat($interval);
                    $output = "<li class='list-group-item d-flex align-items-center";
                    if($notification_status == "unseen")
                    {
                        $output.=" bg-not-seen";
                    }else{
                        $output.=" bg-light";
                    }
                    $output.= "'><div class='image-preview my-2 mx-1'><a href='$commented_by'><img src='assets/images/profiles/$user_image'alt='image'></a></div>";
                    $output.="<div class='d-flex flex-column ml-2'><a href='view-all-comment.php?post_id=$post_id'><span class='text-";
                    if($commented_by === $_SESSION['username']){
                        $output.="dark'> You";
                    }else{
                        $output.="primary'>".$commented_by." ";
                    }
                    $output.="</span><span class='text-dark'> commented on your post : '$comment'</span><sub class='mx-2 text-secondary notification-time'>$time_message</sub></a>";
                    $output.= "</li>";
                    echo $output;
                }
            }
    }

