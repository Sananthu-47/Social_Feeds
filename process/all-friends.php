<?php 
include "../includes/db.php";
include "../global.php";
      $from = $_POST['request_from'];
      $to = $_POST['request_to'];
      $all_friends = getUserInfo('friends_list',$to); 
      $output = ''; 
      $friends_array = array_filter(explode(',',$all_friends));
          foreach ($friends_array as $friend) {  
          $profile_image = getUserInfo('user_image',$friend);
          $output.="<a href='$friend'><li class='list-group-item d-flex align-items-center'>
          <div class='image-preview'>
          <img src='assets/images/profiles/$profile_image' alt='image'>
          </div>
          <span>$friend</span></li></a>";
          }  
          echo $output;  
?>
