<?php 
include "../includes/db.php";
include "../global.php";
            $to = $_POST['request_to'];
            $from = $_POST['request_from'];
       
            //Update the friends_request table with friends status to notify
            $query = "DELETE FROM friend_requests WHERE request_by = '$to' AND request_to = '$from'";
            $result = mysqli_query($connection,$query);

            if(!$result)
            {
                alert('alert-danger',"Something went wrong!");
            }else{
                echo "<input type='submit' id='add-friend' data-reqto='$to' data-reqfrom='$from'  class='btn btn-primary' value='Add friend'>";
            } 
?>