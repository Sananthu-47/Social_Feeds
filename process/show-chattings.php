<?php
include "../includes/db.php";
include "../global.php";
//Set the default time as India
date_default_timezone_set("Asia/Calcutta");
$date_time_now = date("Y-m-d H:i:s");//Time as of now
$current_user = $_POST['current_user'];
$current_user = getUserInfo('id',$current_user);
$message_from = $_POST['message_from'];
$message_to = $_POST['message_to'];
$output = '';
$response = getAllMessages($message_from,$message_to);//Get all messages from a particular people chat

//Set the user other than the logged in user
if($message_from !== $current_user)
{
    $current_message_user = $message_from;
}else
if($message_to !== $current_user)
{
    $current_message_user = $message_to;
}

//Get details of the friends 
    $profile_image = getUserInfoById('user_image',$current_message_user);
    $last_seen = getUserInfoById('last_seen',$current_message_user);
    $friend_name = getUserInfoById('username',$current_message_user);

    //Check if he is online or not
    if((time() - $last_seen) < 10)
        {
            $last_seen = 'Online';
            $last_seen_class = 'text-success h6';
        }else{
            $date = date('Y-m-d H:i:s',$last_seen);
            $post_posted = new DateTime($date);
            $end_date = new DateTime($date_time_now);
            $interval = $post_posted->diff($end_date);
            //Check if he was online today or not
            if($interval->d >= 1)
            {
            $last_seen = 'last seen at '. date("d-m-y",$last_seen);
            }else{
            $last_seen = 'last seen at '. date("g-ia",$last_seen);
            }
            $last_seen_class = 'small-text text-white';
        }

        $output.="
        <!--- Menu bar for chats --->
            <div class='d-flex m-0 p-1 w-100 custom-header'>
                    <div class='image-preview'>
                    <img src='assets/images/profiles/$profile_image' class='profile-image-tag' />
                    </div>
                    <div class='d-flex flex-column col-8 p-0 text-light ml-2'>
                        <span>$friend_name</span>
                        <span class='$last_seen_class'>$last_seen</span>
                    </div>
                    <div class='d-flex w-25 p-1 d-flex justify-content-between align-items-center'>
                        <i class='fa fa-search text-light'></i>
                        <i class='fa fa-ellipsis-v text-light'></i>
                        <i class='fa fa-times text-light' id='close-chat'></i>
                    </div>
                </div><!--  </custom-header>  --->

                <!---Display chatting messages --->
                <div class='d-flex flex-column' id='display-messages'>

                    <div class='flex-row border border-dark' id='display-all-messages'>";

                    while($row = mysqli_fetch_assoc($response))
                    {
                        $message = $row['message'];
                        $message_sent = date_create($row['sent_at']);
                        $message_sent = date_format($message_sent,'g:ia');
                        $msg_from = $row['message_from'];
                        $msg_to = $row['message_to'];
                        $msg_status = $row['seen_status'];
                        $message_class = '';
                        $seen_or_not = '';
                        //Set my message to right and friend as left
                        if($msg_from !== $current_message_user)
                        {
                            $message_class = 'my-message';
                            if($msg_status === 'seen')
                            {
                            $seen_or_not = 'fa fa-check-circle text-primary';
                            }else{
                            $seen_or_not = 'fa fa-check-circle-o';
                            }
                        }else{
                            $message_class = 'friend-message'; 
                        }

                        $output.="<div class='d-flex flex-column message $message_class'>$message<span class='text-right p-0 small-text text-secondary'>$message_sent <i class='mx-1 $seen_or_not'></i> </span></div>";
                    }

                    $output.="</div>

                    <div class='d-flex border border-dark w-100' id='user-input-field'>
                    <form class='d-flex align-items-center w-100'>
                        <input type='text' id='user-input-message' class='mx-3 form-control' placeholder='Type your message here...'>
                        <button type='submit' class='btn btn-primary' id='send-message' data-message-to='$current_message_user'>send</button>
                    </form>
                    </div>
                </div>";

                echo $output;