<?php require "includes/header.php"; ?>
<?php include "includes/nav.php"; ?>

<?php 
    if(isset($_GET['profile_username']))
    {
        $_username = $_GET['profile_username'];
    }else{
        $_username = $_SESSION['username'];
    }
?>

<div class="w-100 d-flex justify-content-center profile-wrapper">
    <div class="card bg-light d-none d-md-flex col-3 p-0">
    <div class="d-flex justify-content-center">
        <?php include "includes/profile-user-side.php"; ?>
    </div>
    </div>

    <div class="card main-content bg-light col-12 col-md-6 p-0">
    <div class="content">
        <?php include "includes/say-something.php"; ?>
        <hr>
        <!--- Mobile view of profile --->
        <div class="d-flex d-md-none flex-column text-center">
            <div class="profile-mobile">
                <a href="<?php echo $_username; ?>"><img src="assets/images/profiles/<?php echo getUserInfo('user_image',$_username); ?>" class="profile-image-tag" alt=""></a>
            </div>
            <span class="text-primary h3"><?php echo getUserInfo('username',$_username); ?></span>
            <!-- <a href="mobile-friends.php"><input type="submit" name="see-friends" value="Friends" class="btn btn-info"></a> -->
            <div class="btn btn-primary btn-small" id="friends">Friends</div>
        </div><!-- </mobile>  -->

        <?php echo getSpecificUserPosts($_username); ?>
    </div>
    </div>

    <div class="card friends-list bg-light d-none d-md-flex col-12 col-md-3 p-0">
        <?php include "includes/all-friends.php" ?>
    </div>

<?php require "includes/footer.php"; ?>