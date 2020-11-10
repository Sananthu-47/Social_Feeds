<?php require "includes/header.php"; ?>
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
    <div class="d-flex justify-content-center">
        <?php include "includes/home-page-user.php"; ?>
    </div>
    </div>

    <div class="card main-content bg-light col-12 col-md-6 p-0">
    <div class="content">
        <?php include "includes/say-something.php"; ?>
        <hr>
        <?php getAllPosts(); ?>
    </div>
    </div>

            <div class="card friends-list bg-light d-none d-md-flex col-12 col-md-3 p-0">
                        <div class="alert-info text-center p-2">
                        <span class="text-dark h4"><?php echo "<span class='text-primary h3'>".$_username."</span>"; ?> Friends List</span>
                        </div>
                    <ul class="list-group" id="all-friends">
                    
                    </ul>
            </div>
</div>

<script>
    
    //Load all friends
$(document).ready(function(e)
{
    viewAllFriends();
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
    
</script>

<?php require "includes/footer.php"; ?>