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
        <?php include "includes/say-something.php"; ?>
        <hr>
        <!-- Get all posts -->
        <div id='all-posts'></div>
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
  let over_alert = true;
    //Load all friends
$(document).ready(function(e)
{
    $(".loading").hide();
    viewAllFriends();
    loadProfileData();
    getAllPosts(flag);
    updateUserLastSeen();

    $(".main-content").scroll(function(){
        if($(".main-content").scrollTop() >= $("#main-content").height() - $(window).height())
        {
            if(over_alert == true)
            {
            getAllPosts(flag+=5);
            }
        }
        });
});

    function getAllPosts(page)
    {
        let username = "<?php echo $_SESSION['username']; ?>";
        $.ajax({
            url : "process/getAllPosts.php",
            type : "POST",
            data : {username,page},
            beforeSend : function(){
            $(".loading").show();
            },
            success : function(data)
            {
                if(data === "No more posts")
                {
                    $('.over-data').remove();
                    over_alert = false;
                    let output = "<div class='alert alert-danger text-center over-data'>"+data+"</div>"
                    $("#all-posts").append(output);
                }
                $(".loading").hide();
                $("#all-posts").append(data);
            }
        });
    }

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

//Add post
$("#my-form").on('submit',function(e){
    e.preventDefault();
        let formData = new FormData(this);
        formData.append("post_by","<?php echo $_SESSION['username']; ?>");
            $.ajax({
            url : "process/add-post.php",
            type : "POST",
            data : formData,
            contentType : false,
            processData : false,
            success : function(data)
            {
            loadProfileData();
            $("#all-posts").html('');
            $("#post-content").val('');
            flag = 0;
            getAllPosts(flag);
            removeImage();
            }
        });
    });

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
    let comment_body = $("#comment_field"+post_id).val();
    if(comment_body !== "")
    {
    $.ajax({
        url : "process/comments.php",
        type : "POST",
        data : {post_id , user_id , comment_body},
        success : function(data)
        {
            $("textarea#comment_field"+post_id).val('');
            commentCount.html(" " + data);
            latestComment(post_id);
        }
    });
    }
});

//Latest comment
function latestComment(post_id)
{
    $.ajax({
        url : "process/latest-comment.php",
        type : "POST",
        data : {post_id},
        success : function(data)
        {
            $("#comment-"+post_id).html('');
            $("#comment-"+post_id).html(data);
        }
    });
    }

    
</script>

<?php require "includes/footer.php"; ?>