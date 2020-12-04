<div class="navbar py-1 custom-header d-flex jusify-content-around">
    <a href="index.php" class="remove-decoration text-end"><span class="custom-logo-font">
        Social_Feeds
    </span></a>
    <div class="d-flex justify-content-between align-items-center text-white menu col-12 col-md-auto">
        <i class="fa fa-bell mx-2"><span></span></i>
        <i class="fa fa-users mx-2"><span></span></i>
        <i class="fa fa-envelope mx-2"><span></span></i>
        <a href="profile-settings.php"><i class="fa fa-cog mx-2 text-white"><span></span></i></a>
        <a href="includes/logout.php"><i class="fa fa-sign-out mx-2 text-white"><span></span></i><a>
        <div class="image-preview mx-1">
        <?php if (isset($_SESSION['username'])): ?>
            <a href="<?php echo $_SESSION['username']; ?>"><img src="assets/images/profiles/<?php echo getUserInfo('user_image',$_SESSION['username']); ?>" alt="image"></a>
        <?php endif; ?>
        </div>
    </div>
</div>