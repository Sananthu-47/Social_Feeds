<div class=" my-5 side-user d-block d-xl-flex justify-content-center">
    <div class="profile-side-image m-2">
    <a href="<?php echo $_SESSION['username']; ?>"><img src="assets/images/profiles/<?php echo getUserInfo('user_image',$_SESSION['username']); ?>" class="profile-image-tag" alt=""></a>
    </div>
    <div class="my-2 mx-2">
    <a href="<?php echo $_SESSION['username']; ?>"><h5 class="text-white"><?php echo $_SESSION['username']; ?></h5></a>
    <span class="text-white">Posts: <?php echo getUserInfo('posts',$_SESSION['username']); ?></span><br>
    <span class="text-white">Friends: <?php echo getUserInfo('friends',$_SESSION['username']); ?></span>
    </div>
</div>