<?php
    include "../includes/db.php";
    $userToAdd = $_POST['request_to'];
    $userFrom = $_POST['request_from'];
    $query = "DELETE FROM friend_requests WHERE request_to = '$userToAdd' AND request_by = '$userFrom'";
    $result = mysqli_query($connection,$query) or alert('alert-danger',"Request couldn't be cancelled".mysqli_error($connection));
    if($result)
    {
        echo "<input type='submit' id='add-friend' data-reqto='$userToAdd' data-reqfrom='$userFrom' class='btn btn-primary' value='Add friend'>"; 
    }