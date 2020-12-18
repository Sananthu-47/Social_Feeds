<div class="navbar py-1 custom-header d-flex jusify-content-around">
    <a href="index.php" class="remove-decoration text-end"><span class="custom-logo-font">
        Social_Feeds
    </span></a>
    <div class="d-flex justify-content-between align-items-center text-white menu col-12 col-md-auto">
        <i class="fa fa-bell mx-2" id="notification"><span></span></i>
        <a href="friends.php"><i class="fa fa-users mx-2 text-white"><span></span></i></a>
        <i class="fa fa-envelope mx-2"><span></span></i>
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
                
            <?php include "notification.php"; ?>

            </ul>
            <i class='fa fa-refresh fa-spin fa-3x fa-fw loading'></i>
            <span class='sr-only'>Loading...</span>
        </div>

        <script>
$("#notification").on('click',function(){
    $("#notification-dropdown").toggle('display');
});

    //Load more notification

    $(document).on('click',"#load-more-notifications",function(e){
    let page = $(this).data("page");
    let userId = $(this).data("id");
    loadMoreComments(page,userId);
});

//Load more comments ajax function
function loadMoreComments(page,userId)
{
    $.ajax({
            url : "includes/notification.php",
            type : "POST",
            data : {page,userId},
            beforeSend : function(){
            $(".loading").show();
            },
            success : function(data)
            {
                if(data !== "<li class='list-group-item d-flex align-items-center bg-danger text-white'>No notifications</li>")
                {
                $("#loaded-notification").remove();
                $(".loading").remove();
                $("#all-notifications").append(data);
                }else{
                    $("#load-more-notifications").remove();
                    $("#all-notifications").append(data);
                }
            }
        });
}
        </script>