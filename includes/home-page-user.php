<div class=" my-5 side-user d-block d-xl-flex justify-content-center">
    <div class="profile-side-image m-3">
    <img src="assets/images/profiles/<?php echo getUserInfo('user_image',$_SESSION['username']); ?>" class="profile-image-tag" alt="">
    </div>
    <div class="my-3 mx-2">
    <h4 class="text-white"><?php echo $_SESSION['username']; ?></h4>
    <span class="text-white">Posts: <?php echo getUserInfo('posts',$_SESSION['username']); ?></span><br>
    <span class="text-white">Friends: <?php echo getUserInfo('friends',$_SESSION['username']); ?></span>
    </div>
</div>