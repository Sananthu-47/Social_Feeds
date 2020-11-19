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
    getAllPosts(flag);

    $(".main-content").scroll(function(){
        if($(".main-content").scrollTop() >= $("#main-content").innerHeight() - $(document).innerHeight())
        {
            $(".loading").show();
            getAllPosts(flag+=5);
        }
        });
});

    function viewAllFriends()
    {
        let request_to = "<?php echo $_username; ?>";
        let request_from = "<?php echo $_SESSION['username']; ?>";

        $.ajax({
            url : "process/all-friends.php",
            type : "POST",
            data : {request_to , request_from},
            success : function(data)
            {
                $("#all-friends").html(data);
            }
        });
    }

    function getAllPosts(page)
    {
        let username = "<?php echo $_SESSION['username']; ?>";
        $.ajax({
            url : "process/getAllPosts.php",
            type : "POST",
            data : {username,page},
            success : function(data)
            {
                $(".loading").hide();
                $("#main-content").append(data);
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

    
</script>

<?php require "includes/footer.php"; ?>