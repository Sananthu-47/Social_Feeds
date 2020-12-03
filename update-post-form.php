<?php 
require "includes/header.php";
include "includes/nav.php";
include "includes/db.php";

if(!isset($_SESSION['username']))
    {
        header("Location: login.php");
        die();
    }

$post_id = $_GET['post_id'];
$user = $_SESSION['username'];
$post_body = getPostInfo("post_body",$post_id);
$post_image = getPostInfo("post_image",$post_id);

if(isset($_POST['update-data']))
{
    $post_body = charecterParse(strip_tags($_POST['post_body']));
    $image = $_FILES['image']['name'];
    $post_image_new = time(). '_' .$image;
    $post_image_temp = $_FILES['image']['tmp_name'];
    
    if($image !== '' )
    {
        $image_query = ",post_image = '{$post_image_new}'";
        move_uploaded_file($post_image_temp,"assets/images/posts/$post_image_new");
    }else{
        $image_query = '';
    }
        $query = "UPDATE posts SET post_body = '{$post_body}'". $image_query ." WHERE id = '{$post_id}' ";

        $result = mysqli_query($connection,$query);
        if(!$result)
        {
            die("Query failed".mysqli_error($connection));
        }else{
            header("Location: $user");
            die();
        }
}

?>
<div class="alert alert-info m-2 h-100 h4">Edit post</div>

<div class="col-12 col-lg-6 p-0 m-auto">

<form action='' method='post' id='update-post-form' enctype='multipart/form-data' >
<div class='say-something d-flex flex-column align-items-center'>
        <div class='col-9 col-lg-9 p-0'>
            <textarea name='post_body' contenteditable class='w-100 textarea' id='post-content' placeholder='Have something to say?'><?php echo $post_body; ?></textarea>
        </div>

        <div class='image-div w-100 h-100 my-4 d-flex justify-content-center'>
            <div class='image-holder <?php 
            if($post_image === "none")
            {
                echo "d-none";
            }else{
                echo "d-block";
            } ?> '>
        
                <img src="assets/images/posts/<?php 
                if($post_image !== "none")
                {
                echo "$post_image";
                } ?>" id='preview' class='image-full' alt=''>
                <input type='button' id='cancel' value='Cancel' class='m-2' >
                <br>
            </div>
        </div>

        <div class='add-image-button m-3'>
            <input type='file' name='image' id='add-post' class='d-none' accept='.jpg, .jpeg, .png' onChange='previewImage(this)'>
        <span class='btn btn-primary text-white select-image'  onClick='addPhotoPost()'><?php 
        if($post_image !== "none")
        {
        echo "Change image";
        }else{
            echo "Add image";
        } ?></span>
        </div>
        
        <div class='d-lg-flex justify-content-center align-items-center'>
            <input type='submit' class='btn btn-primary text-white update' value='Update' name='update-data'>
        </div>
 </div>  
    
</form> 

</div>

<script>

    //Delete specific post image from database
    $("#cancel").on('click',function(e){
    let post_id ="<?php echo $post_id; ?>";
let conformation = confirm("Do you really want to remove the image");
if(conformation)
{
    $.ajax({
        url : "process/delete-post-image.php",
        type : "POST",
        data : {post_id},
        success : function(data)
        {
            if(data == 1)
            {
                $('.image-holder').removeClass('d-block');
    $('.image-holder').addClass('d-none');
    $('#add-post').src="none";
    $('.select-image').text("Add image");
            }else{
                alert(data);
            }
        }
    });
}
});

</script>

<?php require "includes/footer.php"; ?>
