<?php

function charecterParse($val)
{
    global $connection;
    return mysqli_real_escape_string($connection,$val);
}

function alert($color,$msg)
{
    echo "<div class='alert $color'>$msg</div>";
}

function getUserInfo($getValue,$username)
{
    global $connection;
    $query = "SELECT $getValue FROM users where username = '$username'";
        $result = mysqli_query($connection,$query);

        if(!$result)
        {
            die("Error".mysqli_error($connection));
        }
        $row = mysqli_fetch_array($result);
        return $row[0];
}

function getUserInfoById($getValue,$id)
{
    global $connection;
    $query = "SELECT $getValue FROM users where id = '$id'";
        $result = mysqli_query($connection,$query);

        if(!$result)
        {
            die("Error".mysqli_error($connection));
        }
        $row = mysqli_fetch_array($result);
        return $row[0];
}

function getPostInfo($getValue,$id)
{
    global $connection;
    $query = "SELECT $getValue FROM posts where id = '$id'";
        $result = mysqli_query($connection,$query);

        if(!$result)
        {
            die("Error".mysqli_error($connection));
        }
        $row = mysqli_fetch_array($result);
        return $row[0];
}

function getCommentInfo($getValue,$id)
{
    global $connection;
    $query = "SELECT $getValue FROM comments where id = '$id'";
        $result = mysqli_query($connection,$query);

        if(!$result)
        {
            die("Error".mysqli_error($connection));
        }
        $row = mysqli_fetch_array($result);
        return $row[0];
}

function isFriend($friendToCheck , $username)
{
    $friends_list = getUserInfo('friends_list', $username);
    $friend = ","  .$friendToCheck. ",";
    if(strstr($friends_list,$friend))
    {
        return true;
    }else{
        return false;
    }
}

function isFriendRequestSent($friendToCheck)
{
    global $connection;
    $query = "SELECT request_status FROM friend_requests WHERE request_to = '$friendToCheck' AND request_by = '{$_SESSION['username']}'";
    $result = mysqli_query($connection,$query);
    if(!$result)
    {
        alert('alert-danger',"Please try some time later".mysqli_error($connection));
    }
    $row = mysqli_fetch_assoc($result);
    if($row['request_status'] === "pending")
    {
        return true;
    }else{
        return false;
    }
}

function isAcceptRequest($friendToAccept)
{
    global $connection;
    $query = "SELECT * FROM friend_requests WHERE request_to = '{$_SESSION['username']}' AND request_by = '{$friendToAccept}'";
    $result = mysqli_query($connection,$query);
    if(!$result)
    {
        alert('alert-danger','Something went wrong!'.mysqli_error($connection));
    }else{
    if(mysqli_num_rows($result)>0)
    {
        return true; 
    }else{
        return false;
    }
    }
}

function isPostMine($post_id,$post_by)
{
    global $connection;
    $query = "SELECT * FROM posts WHERE id = '$post_id'";
    $result = mysqli_query($connection,$query);
    $posted_by = mysqli_fetch_assoc($result);

    if($posted_by['posted_by'] === $post_by)
    {
        return true;
    }
}

function getDateFormat($interval)
{
    $time_message = '';

            if($interval->y >= 1)
            {
                if($interval->y==1)
                {
                   return $time_message = $interval->y . " year ago";
                }else{
                   return $time_message = $interval->y . " years ago";
                }
            }else if($interval->m >= 1)
            {
                if($interval->m==1)
                {
                   return $time_message = $interval->m . " month ago";
                }else{
                   return $time_message = $interval->m . " months ago";
                }
            }else if($interval->d >= 1)
            {
                if($interval->d == 1)
                {
                   return $time_message = $interval->d . " day ago";
                }else{
                   return $time_message = $interval->d . " days ago";
                }
            }else if($interval->h >= 1)
            {
                if($interval->h == 1)
                {
                   return $time_message = $interval->h . " hour ago";
                }else{
                   return $time_message = $interval->h . " hours ago";
                }
            }else if($interval->i >= 1)
            {
                if($interval->i == 1)
                {
                   return $time_message = $interval->i . " minute ago";
                }else{
                   return $time_message = $interval->i . " minutes ago";
                }
            }else
            {
                if($interval->s < 30)
                {
                   return $time_message = "Just now";
                }else{
                   return $time_message = $interval->s . " seconds ago";
                }
            }
}

function getFreindRequestInfo($getValue,$username)
{
    global $connection;
    $query = "SELECT id FROM friend_requests WHERE $getValue = '$username'";
        $result = mysqli_query($connection,$query);
        $user_array= [];
        if(!$result)
        {
            die("Error".mysqli_error($connection));
        }
        while($row = mysqli_fetch_assoc($result))
        {
            array_push($user_array,$row['id']);
        }
        
        return $user_array;
}

function postLiked($post_id,$user_id)
{
    global $connection;
    $query = "SELECT * FROM likes WHERE post_id = '$post_id' AND user_id = '$user_id'";
    $result = mysqli_query($connection,$query); 
    if(mysqli_num_rows($result) > 0)
    {
        return true;
    }else{
        return false;
    }
}

function commentLiked($comment_id,$user_id)
{
    global $connection;
    $query = "SELECT * FROM comment_likes WHERE comment_id = '$comment_id' AND user_id = '$user_id'";
    $result = mysqli_query($connection,$query); 
    if(mysqli_num_rows($result) > 0)
    {
        return true;
    }else{
        return false;
    }
}

function commentReplyLiked($reply_id,$user_id)
{
    global $connection;
    $query = "SELECT * FROM comment_likes WHERE reply_comment_id = '$reply_id' AND user_id = '$user_id'";
    $result = mysqli_query($connection,$query); 
    if(mysqli_num_rows($result) > 0)
    {
        return true;
    }else{
        return false;
    }
}

function getRepliedCommentInfo($getValue,$id)
{
    global $connection;
    $query = "SELECT $getValue FROM comment_replies where id = '$id'";
        $result = mysqli_query($connection,$query);

        if(!$result)
        {
            die("Error".mysqli_error($connection));
        }
        $row = mysqli_fetch_array($result);
        return $row[0];
}

function userMessagedOrNot($userLogged_in)
{
    global $connection;
    $friends_array = [];
    $query = "SELECT message_to , message_from , id FROM messages WHERE message_from = '$userLogged_in' OR message_to = '$userLogged_in'  AND msg_deleted = 'none' ORDER BY id DESC";
        $result = mysqli_query($connection,$query);

            while($row = mysqli_fetch_assoc($result))
            {
                $message_to = $row['message_to'];
                $message_from = $row['message_from'];
                $id = $row['id'];
                
                
                if($message_to !== $userLogged_in)
                {
                    if(checkInArray($message_to,$friends_array))
                    {
                    array_push($friends_array, (object)[
                        'id' => $id ,
                        'friend' => $message_to
                    ]);
                    }
                }else{
                    if(checkInArray($message_from,$friends_array))
                    {
                        array_push($friends_array, (object)[
                            'id' => $id ,
                            'friend' => $message_from
                        ]);
                    }
                }
            }
        
        return $friends_array;
}

function checkInArray($search,$array)
{
    for($i=0;$i<count($array);$i++)
    {
        if($array[$i]->friend === $search)
        {
            return false;
        }
    }
    return true;
}

function getAllMessgaesById($getValue,$id)
{
    global $connection;
    $query = "SELECT $getValue FROM messages WHERE id = '$id'";
    $result = mysqli_query($connection,$query);
    if(!$result)
        {
            die("Error".mysqli_error($connection));
        }
        $row = mysqli_fetch_array($result);
        return $row[0];
}

function getAllMessages($message_from,$message_to)
{
    global $connection;
    $query = "SELECT * FROM messages WHERE (message_from = '$message_from' OR message_from = '$message_to') AND (message_to = '$message_to' OR message_to = '$message_from')";
    $result = mysqli_query($connection,$query);
    if(!$result)
        {
            die("Error".mysqli_error($connection));
        }
        return $result;
}

function getAllMessagesWithUnseen($message_from,$message_to)
{
    global $connection;
    $query = "SELECT * FROM messages WHERE (message_from = '$message_from' OR message_from = '$message_to') AND (message_to = '$message_to' OR message_to = '$message_from') AND seen_status = 'not seen'";
    $result = mysqli_query($connection,$query);
    if(!$result)
        {
            die("Error".mysqli_error($connection));
        }
        return $result;
}

function getLastMessageByFriend($getValue,$id)
{
    global $connection;
    $query = "SELECT $getValue FROM messages WHERE id = '$id'";
    $result = mysqli_query($connection,$query);
    if(!$result)
        {
            die("Error".mysqli_error($connection));
        }
        $row = mysqli_fetch_array($result);
        return $row[0];
}