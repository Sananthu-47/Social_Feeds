<div class="navbar custom-header d-flex jusify-content-around">
    <a href="index.php" class="remove-decoration text-end"><span class="custom-logo-font">
        Social_Feeds
    </span></a>
    <div class="d-flex justify-content-between align-items-center text-white menu col-12 col-md-auto">
        <i class="fa fa-bell mx-3"><span></span></i>
        <i class="fa fa-users mx-3"><span></span></i>
        <i class="fa fa-envelope mx-3"><span></span></i>
        <i class="fa fa-cog mx-3"><span></span></i>
        <div class="image-preview mx-3">
            <img src="assets/images/profiles/<?php echo getUserInfo('user_image',$_SESSION['username']); ?>" alt="image">
        </div>
    </div>
</div>