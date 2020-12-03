<?php
    include "../includes/db.php";
    include "../global.php";

    $user = $_POST['username'];
    $logged_in_user = $_POST['loggedInUser'];
    $page = $_POST['page'];

    if(getUserInfo('account_type',$user) === 'public' || isFriend($user,$logged_in_user) || $user == $logged_in_user)
    {
    global $connection;
    $query = "SELECT * FROM posts WHERE posted_by = '{$user}' ORDER BY id DESC LIMIT $page , 5";
    $result = mysqli_query($connection,$query);
    if(!$result)
    {
        alert("alert-danger","Failed to fetch posts");
    }

    if(mysqli_num_rows($result)>0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
                $post_id = $row['id'];
                $post_body = $row['post_body'];
                $post_image = $row['post_image'];
                $post_user = $row['posted_by'];
                $posted_at = $row['posted_at'];
                $post_likes = $row['likes'];
                $post_id = $row['id'];
                $user_image = getUserInfo('user_image',$post_user);
                $date_time_now = date("Y-m-d H:i:s");
                $post_posted = new DateTime($posted_at);
                $end_date = new DateTime($date_time_now);
                $interval = $post_posted->diff($end_date);
                $time_message = getDateFormat($interval);

                echo "
                
                <div class='d-flex flex-column'>
                    <div class='user-details mx-2 d-flex'>
                    <div class='image-preview mx-3'>
                    <a href='$post_user'><img src='assets/images/profiles/$user_image' alt='image'></a>
                    </div>
                    <div class='d-flex flex-column'>
                    <a href='$post_user'><span class='text-primary'>$post_user</span></a>
                    <span class='text-dark'>$time_message</span>
                    </div>";  
                    
                    if($post_user === $logged_in_user)
                    {
                   echo " 
                    <div id='post-details'>
                    <i class='fa fa-trash mx-2' id='delete-post' data-user='$logged_in_user' data-postId='$post_id'></i>
                    <a href='update-post-form.php?post_id=$post_id' class='text-dark'><i class='fa fa-edit' id='edit-post'></i></a>
                    </div>";
                    }
                echo "</div>";//d-flex and flex-column
                    if($post_image!=="none")
                    {
                        echo "
                        <div class='post-body m-2'>
                        <span>$post_body</span>
                        </div>

                        <div class='post-image m-auto d-flex justify-content-center'>
                        <img class='w-100' src='assets/images/posts/$post_image' alt='image'>
                        </div>";
                    }else{
                        echo "
                        <div class='post-body m-2'>
                        <span class='h4 px-3'>$post_body</span>
                        </div> ";
                    }

                echo " 
                <div class='container my-2 mx-auto like-comment bg-white d-flex justify-content-between align-items-center'>
                <div class='d-block'><span class='badge badge-primary mr-1' id='post".$post_id."'>$post_likes</span>
                <span class='badge badge-";
                if(postLiked($post_id,getUserInfo('id',$logged_in_user)))
                {
                    echo "primary";
                }else{
                    echo "secondary";
                }
                echo "' id='like' data-post='$post_id'><span>Like</span> <i class='fa fa-thumbs-up fa-lg'></i></span>
                </div>
                <span>Comments <i class='fa fa-comments'>1</i></span>
                </div>
                </div><br><hr>";
        }//while end
    }//if end
    else{
        return "<div class='text-secondary text-center my-3'>No post!</div>";
    }
  }//End of the accoutn_type
  else{
      echo "<span class='text-center h4'>Account private</span>";
  }

  // data-user='$logged_in_user' data-postId='$post_id'