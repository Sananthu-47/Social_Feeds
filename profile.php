<?php require "includes/header.php"; ?>
<?php include "includes/nav.php"; ?>

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
                <a href="<?php echo $_SESSION['username']; ?>"><img src="assets/images/profiles/<?php echo getUserInfo('user_image',$_SESSION['username']); ?>" class="profile-image-tag" alt=""></a>
            </div>
            <span class="text-primary h3"><?php echo getUserInfo('username',$_SESSION['username']); ?></span>
            <a href="includes/all-friends.php"><input type="submit" value="Friends" class="btn btn-info"></a>
        </div><!-- </mobile>  -->

        <?php echo getSpecificUserPosts($_SESSION['username']); ?>
    </div>
    </div>

    <div class="card friends-list bg-light d-none d-md-flex col-3 p-0">
        <?php include "includes/all-friends.php" ?>
    </div>

<?php require "includes/footer.php"; ?>