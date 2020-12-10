<?php include "includes/header.php"; ?>
<?php include "includes/nav.php"; ?>
<?php 
    if(!isset($_SESSION['username']))
    {
        header("Location: login.php");
    }

    if(isset($_GET['profile_username']))
    {
        $_username = $_GET['profile_username'];
    }else{
        $_username = $_SESSION['username'];
    }
?>
<div class="w-100 home-wrapper d-flex justify-content-center">
    <div class="card bg-light d-none d-md-flex col-3 p-0">
    <div class="d-flex justify-content-center" id="profile-data">
        <!-- Here goes the data from the profile side ajax data -->
        <h3 class="loading text-center">Loading...</h3>
    </div>
    </div>

    <div class="card main-content bg-light col-12 col-md-6 p-0">
    <div class="content" id="main-content">
        <?php include "process/get-all-comments.php"; ?>
        <h3 class="loading text-center">Loading...</h3>
    </div>
    </div>

            <div class="card friends-list bg-light d-none d-md-flex col-12 col-md-3 p-0">
                        <div class="alert-info text-center p-2">
                        <span class="text-dark h4"><?php echo "<span class='text-primary h3'>".$_username."</span>"; ?> Friends List</span>
                        </div>
                    <ul class="list-group" id="all-friends">
                    <h3 class="loading text-center">Loading...</h3>
                    </ul>
            </div>
</div>
<script>
  let flag = 0;  
    //Load all friends
$(document).ready(function(e)
{
    $(".loading").hide();
    viewAllFriends();
    loadProfileData();
    updateUserLastSeen();
});

function loadProfileData()
{
    let username = "<?php echo $_username; ?>";
    $.ajax({
        url : "process/profile-user-side.php",
        type : "POST",
        data : {username},
        success : function(data)
        {
            $("#profile-data").html(data);
        }
    });
}

//Like post
$(document).on('click',"#like",function(e){
    let post_id = $(this).data("post");
    let user_id = "<?php echo getUserInfo("id",$_SESSION['username']); ?>";
    let postCount = $("#post"+post_id);
    let likeBtn = this;
    $.ajax({
        url : "process/like.php",
        type : "POST",
        data : {post_id , user_id},
        success : function(data)
        {
            let result = JSON.parse(data);
            
            if(result.status == "add-like")
            {
            likeBtn.classList.remove("badge-secondary");
            likeBtn.classList.add("badge-primary");
            postCount.html(result.like);
            }else{
            likeBtn.classList.add("badge-secondary");
            likeBtn.classList.remove("badge-primary");
            postCount.html(result.like);
            }
        }
    });
});

//Comment on post
$(document).on('click',"#comment",function(e){
    let post_id = $(this).data("post");
    let user_id = "<?php echo getUserInfo("id",$_SESSION['username']); ?>";
    let commentCount = $("#comment"+post_id);
    let comment_body = $("textarea#comment_field").val();
    if(comment_body !== "")
    {
    $.ajax({
        url : "process/comments.php",
        type : "POST",
        data : {post_id , user_id , comment_body},
        success : function(data)
        {
            $("textarea#comment_field").val('');
            commentCount.html(" " + data);
            latestCommentAdded(post_id);
        }
    });
    }
});

//Latest comment
function latestCommentAdded(post_id)
{
    $.ajax({
        url : "process/display-all-comments.php",
        type : "POST",
        data : {post_id},
        success : function(data)
        {
            $("#comment-"+post_id).html('');
            $("#comment-"+post_id).html(data);
        }
    });
}

//Load more comments

$(document).on('click',"#load-more",function(e){
    let page = $(this).data("page");
    let username = "<?php echo $_username; ?>";
    let post_id = $(this).data("id"); 
        $.ajax({
            url : "process/display-all-comments.php",
            type : "POST",
            data : {post_id,page,username},
            beforeSend : function(){
            $(".loading").show();
            },
            success : function(data)
            {
                if(data)
                {
                $("#loaded-comments").remove();
                $(".loading").hide();
                $("#comment-"+post_id).append(data);
                }else{
                    $(".loading").remove();
                    $("#load-more").removeClass('btn-info');
                    $("#load-more").addClass('btn-secondary disabled not-allowed');
                     $("#load-more").html('No more comments');
                }
            }
        });
});
    
</script>

<?php require "includes/footer.php"; ?>