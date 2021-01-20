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
        <?php include "includes/say-something.php"; ?>
        <hr>
        <!-- Get all posts -->
        <div id='all-posts'></div>
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
            url : "posts/getAllPosts.php",
            type : "POST",
            data : {username,page},
            beforeSend : function(){
            $(".loading").show();
            },
            success : function(data)
            {
        if(document.querySelector('.over-data') === null)
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
        }
        });
    }

//Add post
$("#my-form").on('submit',function(e){
    e.preventDefault();
        let formData = new FormData(this);
        formData.append("post_by","<?php echo $_SESSION['username']; ?>");
            $.ajax({
            url : "posts/add-post.php",
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
    
</script>

<?php require "includes/footer.php"; ?>