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

    </div> <!-- wrapper -->

<script>
//Array holds the message ids of all unseen messages
let message_id_unseen = [];

if(window.innerWidth <= 768)
{
    $('#chating-messages').addClass('d-none');
}else{
    $('#chating-messages').removeClass('d-none');
}

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

//Global timer to set for receving new messages
    let timer = null;
//Show the private chattings of the people to whom user clicks
    $(document).on('click','#chat-list',function(e){
    let message_from = $(this).data('message-from');
    let message_to = $(this).data('message-to');
    let current_user = '<?php echo $_username; ?>';
    let current_click = this;

    if(window.innerWidth <= 768)
    {
        $('#chat-left').addClass('d-none');
        $('#chat-left').removeClass('d-flex');
        $('#chating-messages').removeClass('d-none');
    }
    
        $.ajax({
            url : "process/show-chattings.php",
            type : "POST",
            data : {message_from,message_to,current_user},
            success : function(data)
            {
                $("#chating-messages").html(data);
                document.querySelector('#display-all-messages').scrollTop = document.querySelector('#display-all-messages').scrollHeight ;
                $('#user-input-message').focus();
                makeMsgSeen(message_from,message_to);
            }
    });
    
    startTimer(current_click,message_from,message_to,current_user);

    });

    function startTimer(current_click,message_from,message_to,current_user)
    {
            window.clearInterval(timer);
            timer = refreshForNewMessages(message_from,message_to,current_user);
    }


    //refreshForNewMessages
    function refreshForNewMessages(message_from,message_to,current_user)
    {
        //Stores the timer to keep track of the interval of calling the function
       let timer = setInterval(function(){
    $.ajax({
            url : "process/see-for-new-messages.php",
            type : "POST",
            data : {message_from,message_to,current_user},
            success : function(data)
            {
                let response = JSON.parse(data);
                //If only a new meessage is been recived this will add it to the doc
                if(response.id !== 0)
                {
                $("#display-all-messages").append(response.output);
                document.querySelector('#display-all-messages').scrollTop = document.querySelector('#display-all-messages').scrollHeight ;
                }
            }
        });
        //check only if the message array has any unseen message ids
        if(message_id_unseen.length>0)
        {
            //Check for ecah message id to verify if its seen or not
        message_id_unseen.forEach(msgid=>{
                $.ajax({
                    url : "process/check-seen-or-not.php",
                    type : "POST",
                    data : {msgid},
                    success : function(data)
                    {
                        //If the sent message is seen by user the message is updated as seen with blue ticks with ajax
                        if(data === 'seen')
                        {
                            let check = now = $('#message-id-'+msgid)[0].children[0];
                            check.children[0].classList.add('text-primary');
                            message_id_unseen.shift();
                        }
                    }
            });
        });
       }//

},1000);
    return timer;
    }

    //makeMsgSeen

    function makeMsgSeen(message_from,message_to)
    {
        $.ajax({
            url : "process/make-msg-seen.php",
            type : "POST",
            data : {message_from,message_to},
            success : function(data)
            {
                
            }
        });
    }

//Send message to the person
    $(document).on('click','#send-message',sendMessage);

    function sendMessage(e)
    {
        e.preventDefault();
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
                        let response = JSON.parse(data);
                        $('#user-input-message').val('');
                        $("#display-all-messages").append(response.output);
                        document.querySelector('#display-all-messages').scrollTop = document.querySelector('#display-all-messages').scrollHeight ;
                        viewAllFriendsToChat();
                        message_id_unseen.push(response.id);//Push the message ids to make it seen or not seen
                    }
                });
        }
    }

//Close the chatting interface
    $(document).on('click','#close-chat',function(){
        let output = `<div class='d-flex justify-content-center align-items-center bg-white h-100'>
                         <span class='h4'>Keep chatting</span>
                       </div>`;
        if(window.innerWidth <= 768)
        {
            $('#chat-left').removeClass('d-none');
            $('#chat-left').addClass('d-flex');
            $('#chating-messages').addClass('d-none');
        }else{
            $('#chating-messages').html(output);
        }
        window.clearInterval(timer);
    });

    //Make more options for each message in chatting
$(document).on('click','.chat-options',function(){
    this.children[0].classList.remove('d-none');
});

//Check if the selec more options is on then close it if its on while clicking in window
window.addEventListener('click',function(e){
    if(!e.target.classList.contains('chat-options') && document.querySelectorAll('.more-options'))
    {
        document.querySelectorAll('.more-options').forEach(ele=>ele.classList.add('d-none'));
    }
});


    //delete a message from chat
    $(document).on('click','.delete-msg',function(){
        let message_id = $(this).data('msg-id');
        let current_user = '<?php echo $_SESSION['username']; ?>';
        $.ajax({
            url : "process/delete-msg.php",
            type : "POST",
            data : {message_id,current_user},
            success : function(data){
                $('#message-id-'+message_id).remove()
            }
        })
    });

//Set interval to check for new incoming messages
    setInterval(() => {
        viewAllFriendsToChat();
    }, 2000);

</script>

<?php include "includes/footer.php"; ?>