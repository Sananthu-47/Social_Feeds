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
        <i class="fa fa-refresh fa-spin fa-3x fa-fw loading"></i>
        <span class="sr-only">Loading...</span>
    </div>
    </div>

    <div class="card main-content bg-light col-12 col-md-6 p-0">
    <div class="content" id="main-content">
        <?php include "process/get-all-comments.php"; ?>
        <i class="fa fa-refresh fa-spin fa-3x fa-fw loading"></i>
        <span class="sr-only">Loading...</span>
    </div>
    </div>

            <div class="card friends-list bg-light d-none d-md-flex col-12 col-md-3 p-0">
                        <div class="alert-info text-center p-2">
                        <span class="text-dark h4"><?php echo "<span class='text-primary h3'>".$_username."</span>"; ?> Friends List</span>
                        </div>
                    <ul class="list-group" id="all-friends">
                    <i class="fa fa-refresh fa-spin fa-3x fa-fw loading"></i>
                    <span class="sr-only">Loading...</span>
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

//Comment like 
$(document).on('click',"#comment-like",function(e){
    let post_id = $(this).data("post-id");
    let comment_id = $(this).data("comment-id");
    let user_id = "<?php echo getUserInfo("id",$_SESSION['username']); ?>";
    let likeCount = $("#like-count-"+comment_id);
    let likeBtn = this;
    $.ajax({
        url : "process/comment-like.php",
        type : "POST",
        data : {post_id , user_id , comment_id},
        success : function(data)
        {
            let result = JSON.parse(data);
            
            if(result.status == "add-like")
            {
            likeBtn.classList.remove("text-secondary");
            likeBtn.classList.add("text-danger");
            likeCount.html(result.like);
            }else{
            likeBtn.classList.add("text-secondary");
            likeBtn.classList.remove("text-danger");
            likeCount.html(result.like);
            }
        }
    });
});

//Comment on post
$(document).on('click',"#comment",function(e){
    let post_id = $(this).data("postid");
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

//Edit the comment
$(document).on('click',"#edit-comment",function(e){
    $(".main-content").animate({ scrollTop: 0 }, "fast");
    let post_id = $(this).data("postid");
    let comment_id = $(this).data("commentid");
    $.ajax({
        url : "process/edit-comment.php",
        type : "POST",
        data : {post_id , comment_id},
        success : function(data)
        {
            let output = jQuery.parseJSON(data);
            $("textarea#comment_field").val(output[0]);
            $("#comment-btn").html('');
            $("#comment-btn").html(output[1]);
        }
    });
});

//Update the comment
$(document).on('click',"#update-comment",function(e){
    let post_id = $(this).data("postid");
    let comment_id = $(this).data("commentid");
    let comment_body = $("textarea#comment_field").val();
    $.ajax({
        url : "process/update-comment.php",
        type : "POST",
        data : {post_id , comment_id , comment_body},
        success : function(data)
        {
            $("textarea#comment_field").val('');
            $("#comment-btn").html('');
            $("#comment-btn").html(data);
            latestCommentAdded(post_id);
        }
    });
});

//Latest comment
function latestCommentAdded(post_id)
{
    let page = -5;
    let username = "<?php echo $_username; ?>"; 
    $.ajax({
        url : "process/display-all-comments.php",
        type : "POST",
        data : {post_id, page , username},
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
    loadMoreComments(post_id,page,username);
});

//Load more comments ajax function
function loadMoreComments(post_id,page,username)
{
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
}

//Delete comment 
$(document).on('click',"#delete-comment",function(e){
    let comment_id = $(this).data("id");
    let post_id = $(this).data("postid");
        $.ajax({
            url : "process/delete-comment.php",
            type : "POST",
            data : {comment_id,post_id},
            beforeSend : function(){
            $(".loading").show();
            },
            success : function(data)
            {
                if(data !== false)
                {
                let username = "<?php echo $_username; ?>";
                $("#comment-"+post_id).html('');
                loadMoreComments(post_id,-5,username); //-5 is to remove all comments and start from first
                $("#comment"+post_id).html(data);
                }else{
                    alert("Comment was not deleted");
                }
            }
        });
});

//Reply for comment reply-comment
$(document).on('click',".reply-button",function(e){
    let user_to_reply = $(this).data('comment-username');
    $('#reply-comment').removeClass('d-none');
    $('#reply-comment').addClass('d-flex');
    let mentioned_data = "@"+user_to_reply+"<i class='fa fa-times ml-2' id='cancel-mention'></i>";
    $('#mention').html(mentioned_data);
    $('#reply-field').attr('placeholder','Reply to '+user_to_reply)
    $('#reply-field').focus();
});

$(document).on('click',"#cancel-mention",(e)=>{
    $('#reply-comment').addClass('d-none');
    $('#reply-comment').removeClass('d-flex');
});
    
</script>

<?php require "includes/footer.php"; ?>