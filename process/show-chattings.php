<?php
include "../includes/db.php";
include "../global.php";

$current_user = $_POST['current_user'];
$current_user = getUserInfo('id',$current_user);

$message_from = $_POST['message_from'];
$message_to = $_POST['message_to'];
$single_message_id = '';
$response = '';
$output = '';

if($message_from !== $current_user)
{
$profile_image = getUserInfoById('user_image',$message_from);
$last_seen = getUserInfoById('last_seen',$message_from);
$friend_name = getUserInfoById('username',$message_from);
$response = getAllMessages($message_from,$message_to);
$current_message_user = $message_from;
}else
if($message_to !== $current_user)
{
    $profile_image = getUserInfoById('user_image',$message_to);
    $last_seen = getUserInfoById('last_seen',$message_to);
    $friend_name = getUserInfoById('username',$message_to);
    $response = getAllMessages($message_from,$message_to);
    $current_message_user = $message_to;
}

        $output.="
        <!--- Menu bar for chats --->
            <div class='d-flex m-0 p-1 w-100 custom-header'>
                    <div class='image-preview'>
                    <img src='assets/images/profiles/$profile_image' class='profile-image-tag' />
                    </div>
                    <div class='d-flex flex-column col-8 p-0 text-light ml-2'>
                        <span>$friend_name</span>
                        <span class='small-text'>Last seen 10:45 pm</span>
                    </div>
                    <div class='d-flex w-25 p-1 d-flex justify-content-center align-items-center'>
                        <i class='fa fa-search text-light mr-3'></i>
                        <i class='fa fa-ellipsis-v text-light ml-3'></i>
                    </div>
                </div><!--  </custom-header>  --->

                <!---Display chatting messages --->
                <div class='d-flex flex-column' id='display-messages'>

                    <div class='flex-row border border-dark' id='display-all-messages'>";

                    while($row = mysqli_fetch_assoc($response))
                    {
                        $message = $row['message'];
                        $message_sent = $row['sent_at'];
                        $msg_from = $row['message_from'];
                        $msg_to = $row['message_to'];
                        $message_class = '';
                        if($msg_from !== $current_message_user)
                        {
                            $message_class = 'my-message';
                        }else{
                            $message_class = 'friend-message'; 
                        }

                        $output.="<div class='message $message_class'>$message</div>";
                    }

                    $output.="</div>

                    <div class='d-flex border border-dark w-100 d-flex align-items-center' id='user-input-field'>
                        <input type='text' id='user-input-message' class='mx-3 form-control' placeholder='Type your message here...'>
                        <button type='submit' class='btn btn-primary'>send</button>
                    </div>
                </div>";

                echo $output;