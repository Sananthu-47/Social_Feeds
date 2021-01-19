<?php
    include "../includes/db.php";
    include "../global.php";
    $userToAdd = $_POST['request_to'];
    $userFrom = $_POST['request_from'];
    $notification_to = getUserInfo('id',$userFrom);
    $notification_by = getUserInfo('id',$userToAdd);
    $query = "DELETE FROM friend_requests WHERE request_to = '$userToAdd' AND request_by = '$userFrom'";
    $result = mysqli_query($connection,$query) or alert('alert-danger',"Request couldn't be cancelled".mysqli_error($connection));

    //Update the notifications table by deletinf the data
    $query = "DELETE FROM notifications WHERE notification_to = '$notification_by' AND notification_from = '$notification_to' AND type = 'friend_req'";
    $result = mysqli_query($connection,$query);
    if($result)
    {
        echo "<input type='submit' id='add-friend' data-reqto='$userToAdd' data-reqfrom='$userFrom' class='btn btn-primary' value='Add friend'>"; 
    }