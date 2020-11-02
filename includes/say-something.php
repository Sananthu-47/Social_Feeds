    <?php

        if(isset($_POST['post']))
        {
           addPost('none',$_POST['post-body'],$_FILES['image']['name']);
        }

    ?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="say-something row my-2">
        <div class="add-image-button col-3 col-lg-2">
            <input type="file" name="image" id="add-post" class="d-none" onChange="previewImage(this)">
        <span class="btn btn-primary text-white"  onClick="addPhotoPost()">Add image</span>
        </div>
        <div class="col-8 col-lg-7">
            <textarea name="post-body" contenteditable class="w-100 textarea" placeholder="Have something to say?"></textarea>
        </div>
        <div class="col-12 col-lg-1 d-flex justify-content-center ml-4">
            <input type="submit" class="btn btn-primary text-white" value="Post" name="post">
        </div>
    </div>
<div class="image-div w-100 d-flex justify-content-center">
    <div class="image-holder d-none">
        <img src="" id="preview" class="image-full" alt="">
        <input type="button" id="cancel" value="Cancel" class="m-1" onClick="removeImage()">
    </div>
</div>
</form>
