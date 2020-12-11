<?php include "includes/header.php"; ?>
<?php include "includes/nav.php"; ?>
<?php
if(!isset($_SESSION['username']))
{
    header("Location: login.php");
}
?>

<div class="container d-flex justify-content-center p-1 col-12 col-md-6 col-lg-4">
    <input type="text" placeholder='Search friends' class='form-control form-control-lg'>
    <input type="submit" class='btn btn-primary mx-2' value='Search'>
</div>

<div class="container-fluid d-flex flex-column justify-content-center text-center text-content-center p-1 col-12 col-md-6 col-lg-4 mt-2" id="all-friends">
        <div class="d-flex justify-content-center">
                <i class="fa fa-refresh fa-spin fa-3x fa-fw loading"></i>
                <span class="sr-only">Loading...</span>
        </div>    
</div>

<?php include "includes/footer.php"; ?>

<script>

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

function updateUserLastSeen()
    {
        let username = "<?php echo $_SESSION['username']; ?>";
            $.ajax({
            url : "process/update_last_seen.php",
            type : "POST",
            data : {username},
            success : function(data){
                viewAllFriends();
            }
        });
    }

        viewAllFriends();
        setInterval(updateUserLastSeen, 10000);

</script>