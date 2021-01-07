<?php include "includes/header.php"; ?>
   
    <div class='wrapper d-flex justify-content-center'>
    <!-- Holds all the data in the chats page -->
        <div class='col-12 col-md-5 col-lg-5 col-xl-3 vh-100 border border-dark p-0 d-flex flex-column' id='chat-left'>
            <!-- Header or the logo of the app  --->
            <header class='text-center custom-header'><span class="custom-logo-font">Social_Feeds</span></header>
            <!-- Search field --->
            <div class='w-100'><input type='text' class='form-control my-1 border border-secondary' placeholder='Search..'/></div>
            <!-- all cahts persons --->
                <div id='all-chats-wrapper' class='all-chats d-flex flex-column w-100'>
                <i class="fa fa-refresh fa-spin fa-3x fa-fw loading m-auto text-white"></i>
                <span class="sr-only">Loading...</span>
                </div><!--</all-chats>-->
            </div>

            <!--- Show chats -->
            <div id='chating-messages' class='col-md-7 col-lg-5 border border-dark chats lg-d-flex flex-column p-0 m-0'>
                
                <div class='d-flex justify-content-center align-items-center bg-white h-100'>
                    <span class='h4'>Keep chatting</span>
                </div>

            </div>

       </div><!-- Ends holding -->
    </div> <!-- wrapper -->

<script>

function viewAllFriendsToChat()
    {
        let request_to = "<?php echo $_username; ?>";
        let request_from = "<?php echo $_SESSION['username']; ?>";

        $.ajax({
            url : "process/show-friends-to-chat.php",
            type : "POST",
            data : {request_from},
            success : function(data)
            {
                $("#all-chats-wrapper").html(data);
            }
        });
    }

    viewAllFriendsToChat();

//Show the private chattings of the people to whom user clicks
    $(document).on('click','#chat-list',function(e){
    let message_from = $(this).data('message-from');
    let message_to = $(this).data('message-to');
    let current_user = '<?php echo $_username; ?>';

        $.ajax({
            url : "process/show-chattings.php",
            type : "POST",
            data : {message_from,message_to,current_user},
            success : function(data)
            {
                $("#chating-messages").html(data);
                document.querySelector('#display-all-messages').scrollTop = document.querySelector('#display-all-messages').scrollHeight ;
            }
        });
    });

//Send message to the person
    $(document).on('click','#send-message',function(e){
    let message = $('#user-input-message').val();
    let message_to = $(this).data('message-to');
    let current_user = '<?php echo $_username; ?>';

if(message !== '')
{
        $.ajax({
            url : "process/send-message.php",
            type : "POST",
            data : {message,message_to,current_user},
            success : function(data)
            {
                $('#user-input-message').val('');
                $("#display-all-messages").append(data);
                document.querySelector('#display-all-messages').scrollTop = document.querySelector('#display-all-messages').scrollHeight ;
                viewAllFriendsToChat();
            }
        });
}
    });

</script>

<?php include "includes/footer.php"; ?>