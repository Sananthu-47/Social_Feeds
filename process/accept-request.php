<?php

include "../includes/db.php";
include "../global.php";
    $to = $_POST['request_to'];
    $from = $_POST['request_from'];
    $my_friend_list = getUserInfo('friends_list',$from) . $to . ',' ;//My friends list
    $accepted_friend_list = getUserInfo('friends_list',$to) . $from . ',' ;//The new friends friend list

    //Update the friends_request table with friends status to notify
    $query = "UPDATE friend_requests SET request_status = 'friends' WHERE request_by = '$from' AND request_to = '$to'";
    $result = mysqli_query($connection,$query);
    //Update my friends list with the new friend added
    $query = "UPDATE users SET friends_list = '$my_friend_list' WHERE username = '$from'";
    $result = mysqli_query($connection,$query);
    //Update the friends users list with my name
    $query = "UPDATE users SET friends_list = '$accepted_friend_list' WHERE username = '$to'";
    $result = mysqli_query($connection,$query);

    if(!$result)
    {
        alert('alert-danger',"Friend request coudln't be sent!");
    }else{
        echo "<input type='submit' data-reqto='$to' data-reqfrom='$from' id='unfriend' class='btn btn-danger'
        value='Unfriend $to'>";
    }