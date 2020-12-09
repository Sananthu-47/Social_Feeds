<?php 
include "../includes/db.php";
include "../global.php";
      $from = $_POST['request_from'];
      $to = $_POST['request_to'];
      $all_friends = getUserInfo('friends_list',$to); 
      $output = ''; 
      $friends_array = array_filter(explode(',',$all_friends));
      if(isFriend($to , $from) || $from === $to)
      {
          foreach ($friends_array as $friend) {  
          $profile_image = getUserInfo('user_image',$friend);
          $last_seen = getUserInfo("last_seen",$friend);
          $time = time();
          $output.="<a href='$friend'><li class='list-group-item d-flex align-items-center'>
          <div class='image-preview'>
          <img src='assets/images/profiles/$profile_image' alt='image'>
          </div>
          <div class='d-flex flex-column ml-2'>
          <span>$friend</span>";
          if($last_seen >= $time)
          {
            $output.="<div class='online'></div><span class='text-success'>Online</span></div></li></a>";
          }else{
            $output.="<div class='offline'></div><span class='text-danger'>Offline</span></div></li></a>";
          }
          }  
          echo $output;  
        }
        else{
          echo "<span class='d-flex justify-content-center align-items-center h5 mt-2'>Account private</span>";
        }
?>
