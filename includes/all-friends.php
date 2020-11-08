<div class="alert-info text-center p-2">
    <span class="text-dark h4">Friends List</span>
</div>
<ul class="list-group">
<?php $all_friends = getUserInfo('friends_list',$_username);  
      $friends_array = array_filter(explode(',',$all_friends));
      foreach ($friends_array as $friend) {  
        $profile_image = getUserInfo('user_image',$friend);
          echo "<a href='$friend'><li class='list-group-item d-flex align-items-center'>
          <div class='image-preview'>
          <img src='assets/images/profiles/$profile_image' alt='image'>
          </div>
          <span>$friend</span></li></a>";
      }    
?>
</ul>
