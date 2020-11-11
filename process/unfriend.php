<?php 
include "../includes/db.php";
include "../global.php";
            $to = $_POST['request_to'];
            $from = $_POST['request_from'];
            $my_friend_list = str_replace(","."$to","",getUserInfo('friends_list',$from)) ;//My friends list
            $accepted_friend_list = str_replace(","."$from","",getUserInfo('friends_list',$to));//The new friends friend list
       
            //Update the friends_request table with friends status to notify
            $query = "DELETE FROM friend_requests WHERE (request_by = ('$from' OR '$to')) AND (request_to = ('$to' OR '$from'))";
            $result = mysqli_query($connection,$query);
            //Update my friends list with the new friend added
            $query = "UPDATE users SET friends_list = '$my_friend_list' WHERE username = '$from'";
            $result = mysqli_query($connection,$query);
            //Update the friends users list with my name
            $query = "UPDATE users SET friends_list = '$accepted_friend_list' WHERE username = '$to'";
            $result = mysqli_query($connection,$query);

            if(!$result)
            {
                alert('alert-danger',"Something went wrong!");
            }else{
                echo "<input type='submit' id='add-friend' data-reqto='$to' data-reqfrom='$from'  class='btn btn-primary' value='Add friend'>";
            } 
?>