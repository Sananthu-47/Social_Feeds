    <?php

        if(isset($_POST['post']))
        {
           addPost('none',$_POST['post-body'],$_FILES['image']['name']);
        }

    ?>
<form action="" method="post" enctype="multipart/form-data">

<div class="say-something d-flex col-12 col-lg-10 p-1">
        <div class="add-image-button col-3 p-0">
            <input type="file" name="image" id="add-post" class="d-none" onChange="previewImage(this)">
        <span class="btn btn-primary text-white"  onClick="addPhotoPost()">Add image</span>
        </div>
        <div class="col-9 col-lg-10 p-0">
            <textarea name="post-body" contenteditable class="w-100 textarea" placeholder="Have something to say?"></textarea>
        </div>
        <div class="d-none col-12 col-lg-2 d-lg-flex justify-content-center">
            <input type="submit" class="btn btn-primary text-white" value="Post" name="post">
        </div>
 </div>  
    <div class="col-12 col-lg-1 d-flex d-lg-none justify-content-center lg-ml-4">
            <input type="submit" class="btn btn-primary text-white" value="Post" name="post">
    </div>

<div class="image-div w-100 d-flex justify-content-center">
    <div class="image-holder d-none">
        <img src="" id="preview" class="image-full" alt="">
        <input type="button" id="cancel" value="Cancel" class="m-1" onClick="removeImage()">
    </div>
</div>
</form>
