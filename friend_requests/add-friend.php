<?php 
    include "../includes/db.php";
    include "../global.php";
    $userToAdd = $_POST['request_to'];
    $userFrom = $_POST['request_from'];
    $notification_to = getUserInfo('id',$userToAdd);
    $notification_by = getUserInfo('id',$userFrom);

    $query = "INSERT INTO friend_requests (request_to , request_by , request_time , request_status) VALUES ('$userToAdd','{$userFrom}',now(),'pending')";
    $result = mysqli_query($connection,$query) or alert('alert-danger',"Friend request couldn't be sent. Please try some time later");

    $query = "INSERT INTO notifications (type , notified_at , notification_status , notification_to , notification_from , comment_message) VALUES ('friend_req' , now() , 'unseen' , '$notification_to' , '$notification_by' , 'none')";
    $result = mysqli_query($connection,$query);

    if($result)
    {
        echo "<input type='submit' id='cancel-request' data-reqto='$userToAdd' data-reqfrom='$userFrom' class='btn btn-warning'
        value='Cancel request'>";
    }