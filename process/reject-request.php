<?php 
include "../includes/db.php";
include "../global.php";
            $to = $_POST['request_to'];
            $from = $_POST['request_from'];
            $notification_to = getUserInfo('id',$from);
            $notification_by = getUserInfo('id',$to);
       
            //Update the friends_request table with friends status to notify
            $query = "DELETE FROM friend_requests WHERE request_by = '$to' AND request_to = '$from'";
            $result = mysqli_query($connection,$query);

            //Update the friends_request table with friends status to notify
            $query = "DELETE FROM notifications WHERE notification_to = '$notification_to' AND notification_from = '$notification_by' AND type = 'friend_req'";
            $result = mysqli_query($connection,$query);

            if(!$result)
            {
                alert('alert-danger',"Something went wrong!".mysqli_error($connection));
            }else{
                echo "<input type='submit' id='add-friend' data-reqto='$to' data-reqfrom='$from'  class='btn btn-primary' value='Add friend'>";
            } 
?>