<?php
include "../includes/db.php";
include "../global.php";

$_username = $_POST['username'];
$output = '';
$output.= "<div class='my-5 side-user d-block d-xl-flex justify-content-center'>
<div class='profile-side-image m-2'>
<a href='".$_username."'><img src='assets/images/profiles/".getUserInfo('user_image',$_username)."'class='profile-image-tag' alt=''></a>
</div>
<div class='my-2 mx-2'>
<a href='".$_username."'><h5 class='text-white'>".$_username."</h5></a>
<span class='text-white'>First name: ".getUserInfo('first_name',$_username)."</span><br>
<span class='text-white'>Last name: ".getUserInfo('last_name',$_username)."</span><br>
<span class='text-white'>Posts: ".getUserInfo('posts',$_username)."</span><br>
<span class='text-white'>Friends: ".getUserInfo('friends',$_username)."</span><br>";
if(getUserInfo('bio',$_username) !== '')
{
   $output.="<span class='text-white'>Bio: ".getUserInfo('bio',$_username)."</span>";
}
$output.="</div>
</div>";

echo $output;

?>