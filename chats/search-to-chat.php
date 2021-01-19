<?php
include "../includes/db.php";
include "../global.php";

$get_user = $_POST['get_user'];
$current_user = $_POST['current_user'];
$current_user = getUserInfo('id',$current_user);

$query = "SELECT * FROM users WHERE username LIKE '%$get_user%'";
$result = mysqli_query($connection,$query);
$friends_tot = mysqli_num_rows($result);
$output = '';

if($friends_tot > 0)
{
    while($row = mysqli_fetch_assoc($result))
    {
        $friend_id = $row['id'];
        $profile_image = $row['user_image'];
        $last_seen = $row['last_seen'];
        $friend_name = $row['username'];
        $time = time();
            if($friend_id !== $current_user)
             {
                $output.="
                <li class='list-group-item d-flex align-items-center p-2 start' id='chat-list' data-message-from='$current_user' data-message-to='$friend_id'>
                <div class='image-preview'>
                <img src='assets/images/profiles/$profile_image' alt='image'>
                </div>
                <div class='d-flex flex-column ml-2'>
                <span class='text-primary h5'>$friend_name</span>";
                
                if($last_seen >= $time)
                {
                    $output.="<div class='mt-4 online online-chat'></div></div>";
                }else{
                    $output.="<div class='mt-4 offline offline-chat'></div></div>";
                }
                
                $output.="</li>";
            }
    }
    echo $output;
}else{
    echo "<li class='list-group-item d-flex align-items-center p-2 text-danger'>User not found</li>";
}

