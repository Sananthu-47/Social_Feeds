<?php 
include "../includes/db.php";
include "../global.php";

$friend_to_find = $_POST['friend_name'];

$query = "SELECT username FROM users WHERE username LIKE '%$friend_to_find%'";
$result = mysqli_query($connection,$query);
$friends_tot = mysqli_num_rows($result);
$friends_array = [];
$output = '';

if($friends_tot > 0)
{
    while($row = mysqli_fetch_assoc($result))
    {
        array_push($friends_array,$row['username']);
    }
    foreach ($friends_array as $friend) {
          $profile_image = getUserInfo('user_image',$friend);
          $last_seen = getUserInfo("last_seen",$friend);
          $time = time();
          $output.="<a href='$friend'><li class='list-group-item d-flex align-items-center'>
          <div class='image-preview'>
          <img src='assets/images/profiles/$profile_image' alt='image'>
          </div>
          <div class='d-flex ml-2'>
          <span>$friend</span>
          </div></li></a>";
          }  
          echo $output;
}else{
    echo "User not found";
}