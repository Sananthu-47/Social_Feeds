<?php
include "db.php";

if(isset($_POST['page']))
{
    include "../global.php";
    $page = $_POST['page'];
    $page = $page + 10;
    $logged_in_user_id = $_POST['userId'];
}else{
$page = 0;
$logged_in_user_id = getUserInfo("id",$_SESSION['username']);
}
$output = '';
$username = getUserInfoById("username",$logged_in_user_id);
$result = mysqli_query($connection,"SELECT * FROM notifications WHERE notification_to = '$logged_in_user_id' ORDER BY notified_at DESC LIMIT $page , 10");
$total_notification = mysqli_num_rows($result);

  if($total_notification > 0)
   {
       while($row = mysqli_fetch_assoc($result))
        {
                        $post_id = $row['post_id'];
                        $user_id = $row['notification_from'];
                        $user_image = getUserInfoById("user_image",$user_id);
                        $notification_status = $row['notification_status'];
                        $post_image = getPostInfo("post_image",$post_id);
                        date_default_timezone_set("Asia/Calcutta");
                        $date_time_now = date("Y-m-d H:i:s");
                        $end_date = new DateTime($date_time_now);

                if($row['type'] === 'like')
                    {
                        $liked_by = getUserInfoById("username",$user_id);
                        $liked_at = $row['notified_at'];
                        $post_liked = new DateTime($liked_at);
                        $interval = $post_liked->diff($end_date);
                        $time_message = getDateFormat($interval);
                        if($time_message !== 'Just now')
                        {
                        $time_array = (explode(" ",$time_message));
                        $time_message = $time_array[0] . ' ' . $time_array[1][0];
                        }
                        $output .= "<li class='list-group-item d-flex align-items-center p-0";
                        if($notification_status == "unseen")
                        {
                            $output.=" bg-not-seen";
                        }else{
                            $output.=" bg-light";
                        }
                        $output.= "'><div class='my-2 col-2 p-1'><div class='notification-user-preview'><a href='$liked_by'><img src='assets/images/profiles/$user_image'alt='image'></a></div></div>";
                        $output.="<div class='d-flex flex-column col-8'><a href='view-all-comment.php?post_id=$post_id'><span class='text-";
                        if($liked_by === $username)
                        {
                            $output.="dark'> You";
                        }else{
                            $output.="primary'>".$liked_by." ";
                        }
                        $output.="</span><span class='text-dark'> liked your post </span><sub class='mx-2 text-secondary notification-time text-nowrap'>$time_message</sub></a></div>";
                        if($post_image !== 'none')
                        {
                            $output.="<div class='post-notification-image my-2 col-2 p-0'><a href='view-all-comment.php?post_id=$post_id'><img src='assets/images/posts/$post_image'alt='image'></a></div>";
                        }
                        $output.= "</li>";
                    }
              else
                if($row['type'] === 'comment')
                {
                    $commented_by = getUserInfoById("username",$user_id);
                    $comment = $row['comment_message'];
                    $comment_date = $row['notified_at'];
                    $post_commented = new DateTime($comment_date);
                    $interval = $post_commented->diff($end_date);
                    $time_message = getDateFormat($interval);
                    if($time_message !== 'Just now')
                    {
                    $time_array = (explode(" ",$time_message));
                    $time_message = $time_array[0] . ' ' . $time_array[1][0];
                    }
                    $output .= "<li class='list-group-item d-flex align-items-center p-0";
                    if($notification_status == "unseen")
                    {
                        $output.=" bg-not-seen";
                    }else{
                        $output.=" bg-light";
                    }
                    $output.= "'><div class='my-2 col-2 p-1'><a href='$commented_by'><div class='notification-user-preview'><img src='assets/images/profiles/$user_image'alt='image'></a></div></div>";
                    $output.="<div class='d-flex flex-column col-8'><a href='view-all-comment.php?post_id=$post_id'><span class='text-";
                    if($commented_by === $username){
                        $output.="dark'> You";
                    }else{
                        $output.="primary'>".$commented_by." ";
                    }
                    $output.="</span><span class='text-dark'> commented on your post : '$comment'</span><sub class='mx-2 text-secondary notification-time text-nowrap'>$time_message</sub></a></div>";
                    if($post_image !== 'none')
                    {
                        $output.="<div class='post-notification-image my-2 col-2 p-0'><a href='view-all-comment.php?post_id=$post_id'><img src='assets/images/posts/$post_image'alt='image'></a></div>";
                    }
                    $output.= "</li>";
                }else
                if($row['type'] === 'posted')
                {
                    $posted_by = getUserInfoById("username",$user_id);
                    $posted_date = $row['notified_at'];
                    $post_added = new DateTime($posted_date);
                    $interval = $post_added->diff($end_date);
                    $time_message = getDateFormat($interval);
                    if($time_message !== 'Just now')
                    {
                    $time_array = (explode(" ",$time_message));
                    $time_message = $time_array[0] . ' ' . $time_array[1][0];
                    }
                    $output .= "<li class='list-group-item d-flex align-items-center p-0";
                    if($notification_status == "unseen")
                    {
                        $output.=" bg-not-seen";
                    }else{
                        $output.=" bg-light";
                    }
                    $output.= "'><div class='my-2 col-2 p-1'><a href='$posted_by'><div class='notification-user-preview'><img src='assets/images/profiles/$user_image'alt='image'></a></div></div>";
                    $output.="<div class='d-flex flex-column col-8'><a href='view-all-comment.php?post_id=$post_id'><span class='text-";
                    if($posted_by === $username){
                        $output.="dark'> You";
                    }else{
                        $output.="primary'>".$posted_by." ";
                    }
                    $output.="</span><span class='text-dark'> shared a post to your profile</span><sub class='mx-2 text-secondary notification-time text-nowrap'>$time_message</sub></a></div>";
                    if($post_image !== 'none')
                    {
                        $output.="<div class='post-notification-image my-2 col-2 p-0'><a href='view-all-comment.php?post_id=$post_id'><img src='assets/images/posts/$post_image'alt='image'></a></div>";
                    }
                    $output.= "</li>";
                }
        }
    $output.="<div class='text-center m-2' id='loaded-notification'>
    <div class='btn btn-info p-1 my-1 mx-auto' id='load-more-notifications' data-page='$page' data-id='$logged_in_user_id'>Load more</div>
    </div>";
    echo $output;
 }else{
     echo "<li class='list-group-item d-flex align-items-center bg-danger text-white'>No notifications</li>";
 }