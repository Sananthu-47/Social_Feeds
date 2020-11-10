<?php 
    include "../includes/db.php";
    $userToAdd = $_POST['request_to'];
    $userFrom = $_POST['request_from'];
    $query = "INSERT INTO friend_requests (request_to , request_by , request_time , request_status) VALUES ('$userToAdd','{$userFrom}',now(),'pending')";
    $result = mysqli_query($connection,$query) or alert('alert-danger',"Friend request couldn't be sent. Please try some time later");
    if($result)
    {
        echo "<input type='submit' id='cancel-request' data-reqto='$userToAdd' data-reqfrom='$userFrom' class='btn btn-warning'
        value='Cancel request'>";
    }