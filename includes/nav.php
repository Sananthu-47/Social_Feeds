<?php  $user_id = getUserInfo('id',$_SESSION['username']); ?>
<div class="navbar py-1 custom-header d-flex jusify-content-around">
    <a href="index.php" class="remove-decoration text-end"><span class="custom-logo-font">
        Social_Feeds
    </span></a>
    <div class="d-flex justify-content-between align-items-center text-white menu col-12 col-md-auto">
        <div class='d-flex notification-div'>
        <i class="fa fa-bell mx-2" id="notification" data-user-id='<?php echo $user_id; ?>'><span></span></i>
        <?php 
            $query = "SELECT notification_number FROM notifications WHERE notification_to = '$user_id' AND notification_number = 'not-checked'";
            $result = mysqli_query($connection,$query);
            $total = mysqli_num_rows($result);
            if($total > 0)
            {
                if($total > 10)
                {
                    echo "<div id='notification-number' data-user-id='$user_id'>10+</div>";
                }else{
                    echo "<div id='notification-number' data-user-id='$user_id'>".$total."</div>";
                }
            }
        ?>
        </div>
        <a href="friends.php"><i class="fa fa-users mx-2 text-white"><span></span></i></a>
        <div class='d-flex notification-div'>
        <a href='chats.php'><i class="fa fa-envelope mx-2 text-white" data-user-id='<?php echo $user_id; ?>'><span></span></i></a>
        <?php 
            $query = "SELECT message_from FROM messages WHERE message_to = '$user_id' AND msg_deleted = 'none' AND seen_status = 'not seen'";
            $result = mysqli_query($connection,$query);
            $chat_array = [];
            while($row =  mysqli_fetch_assoc($result))
            {
                if(checkInArray($row['message_from'],$chat_array))
                {
                    array_push($chat_array,(object)[
                        'friend' => $row['message_from']
                    ]);
                }
            }
            $total = count($chat_array);
            if($total > 0)
            {
                if($total > 10)
                {
                    echo "<div id='notification-number' data-user-id='$user_id'>10+</div>";
                }else{
                    echo "<div id='notification-number' data-user-id='$user_id'>".$total."</div>";
                }
            }
        ?>
        </div>
        <a href="profile-settings.php"><i class="fa fa-cog mx-2 text-white"><span></span></i></a>
        <a href="includes/logout.php"><i class="fa fa-sign-out mx-2 text-white"><span></span></i><a>
        <div class="image-preview mx-1">
        <?php if (isset($_SESSION['username'])): ?>
            <a href="<?php echo $_SESSION['username']; ?>"><img src="assets/images/profiles/<?php echo getUserInfo('user_image',$_SESSION['username']); ?>" alt="image"></a>
        <?php endif; ?>
        </div>
    </div>
</div>
<div id="notification-dropdown" style="display:none;">
            <ul class="list-group" id="all-notifications">
                
            <!-- <?php //include "notification.php"; ?> -->

            </ul>
            <i class='fa fa-refresh fa-spin fa-3x fa-fw loading'></i>
            <span class='sr-only'>Loading...</span>
        </div>

        <script>
        $("#notification").on('click',function(){
         $("#notification-dropdown").toggle('display');
            let user_id = $(this).data('user-id');
            $.ajax({
                    url : 'process/check-notifications.php',
                    type : "POST",
                    data : {user_id},
                    success : function(e){
                        $('#notification-number').remove();
                    }
            });
        });
        </script>