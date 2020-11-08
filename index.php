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

    <div class="card friends-list bg-light d-none d-md-flex col-3 p-0">
    <?php include "includes/all-friends.php" ?>
    </div>
</div>

<?php require "includes/footer.php"; ?>