<div class=" my-5 side-user d-block d-xl-flex justify-content-center">
    <div class="profile-side-image m-3">
    <a href="<?php echo $_SESSION['username']; ?>"><img src="assets/images/profiles/<?php echo getUserInfo('user_image',$_SESSION['username']); ?>" class="profile-image-tag" alt=""></a>
    </div>
    <div class="my-3 mx-2">
    <a href="<?php echo $_SESSION['username']; ?>"><h4 class="text-white"><?php echo $_SESSION['username']; ?></h4></a>
    <span class="text-white">First name: <?php echo getUserInfo('first_name',$_SESSION['username']); ?></span><br>
    <span class="text-white">Last name: <?php echo getUserInfo('last_name',$_SESSION['username']); ?></span><br>
    <span class="text-white">Posts: <?php echo getUserInfo('posts',$_SESSION['username']); ?></span><br>
    <span class="text-white">Friends: <?php echo getUserInfo('friends',$_SESSION['username']); ?></span>
    </div>
</div>