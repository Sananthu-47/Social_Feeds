<?php
include "../includes/db.php";
include "../global.php";

      $userLogged_in = $_POST['request_from'];
      $userLogged_in = getUserInfo('id',$userLogged_in);
      $output = ''; 
      $friends_array = userMessagedOrNot($userLogged_in);
        
      if(count($friends_array) > 0)
      {
          foreach ($friends_array as $key=>$friend) {  
              $friend_id = $friend->friend;
              $message_id = $friend->id;
                $profile_image = getUserInfoById('user_image',$friend_id);
                $last_seen = getUserInfoById("last_seen",$friend_id);
                $friend_name = getUserInfoById('username',$friend_id);
                $latest_message = getLastMessageByFriend('message',$message_id);
                $latest_message = (strlen($latest_message) > 20) ? mb_strimwidth($latest_message,0,20,'...') : $latest_message;
                $msg_status = getLastMessageByFriend('seen_status',$message_id);
                $last_message_sent_by = getLastMessageByFriend('message_from',$message_id);
                $time = time();
                $seen_or_not = '';

                $query = "SELECT seen_status FROM messages WHERE message_from = '$friend_id' AND message_to = '$userLogged_in' AND seen_status = 'not seen'";
                $result = mysqli_query($connection,$query);
                $total_unseen_msg = mysqli_num_rows($result);

                //Set my message to right and friend as left
                if($userLogged_in !== $friend_id)
                {
                    if($msg_status === 'seen')
                    {
                    $seen_or_not = 'fa fa-check-circle text-primary';
                    }else{
                    $seen_or_not = 'fa fa-check-circle-o text-secondary';
                    }
                }

                $output.="<li class='list-group-item d-flex align-items-center p-2 start' id='chat-list' data-message-from='$userLogged_in' data-message-to='$friend_id'>
                <div class='image-preview'>
                <img src='assets/images/profiles/$profile_image' alt='image'>
                </div>
                <div class='d-flex flex-column ml-2'>
                <span class='text-primary h5'>$friend_name</span>
                <span class='mx-2'>$latest_message";
                if($last_message_sent_by === $userLogged_in)
                {
                    $output.="<i class='mx-1 small-text $seen_or_not'></i> ";
                }
                $output.="</span>";
                if($last_seen >= $time)
                {
                    $output.="<div class='online online-chat'></div></div>";
                }else{
                    $output.="<div class='offline offline-chat'></div></div>";
                }
                if($total_unseen_msg > 0)
                {
                $output.="<div class='show-total-unseen'> $total_unseen_msg </div>";
                }
                $output.="</li>";
              }
          
          echo $output;  

            }else{
                echo "<div class='text-center p-2 bg-light text-danger'>No chats found!</div>";
            }
