<?php
include "../includes/db.php";
include "../global.php";

      $userLogged_in = $_POST['request_from'];
      $userLogged_in = getUserInfo('id',$userLogged_in);
      $output = ''; 
      $friends_array = userMessagedOrNot($userLogged_in);
        
          foreach ($friends_array as $key=>$friend) {  
              $friend_id = $friend->friend;
              $message_id = $friend->id;
                $profile_image = getUserInfoById('user_image',$friend_id);
                $last_seen = getUserInfoById("last_seen",$friend_id);
                $friend_name = getUserInfoById('username',$friend_id);
                $latest_message = getLastMessageByFriend($message_id);
                $time = time();
                $output.="<li class='list-group-item d-flex align-items-center p-2' id='chat-list' data-message-from='$userLogged_in' data-message-to='$friend_id'>
                <div class='image-preview'>
                <img src='assets/images/profiles/$profile_image' alt='image'>
                </div>
                <div class='d-flex flex-column ml-2'>
                <span class='text-primary h5'>$friend_name</span>
                <span class='mx-2'>$latest_message</span>";
                if($last_seen >= $time)
                {
                    $output.="<div class='online online-chat'></div></div></li>";
                }else{
                    $output.="<div class='offline offline-chat'></div></div></li>";
                }
              }
          
          echo $output;  
