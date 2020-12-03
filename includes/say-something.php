<form action='' method='post' id='my-form' enctype='multipart/form-data'>
<div class='say-something d-flex col-12 col-lg-10 p-1'>
        <div class='add-image-button col-3 p-0'>
            <input type='file' name='image' id='add-post' class='d-none' accept='.jpg, .jpeg, .png' onChange='previewImage(this)'>
        <span class='btn btn-primary text-white select-image'  onClick='addPhotoPost()'>Add image</span>
        </div>
        <div class='col-9 col-lg-9 p-0'>
            <textarea name='post_body' contenteditable class='w-100 textarea' id='post-content' placeholder='Have something to say?'></textarea>
        </div>
        <div class='d-none col-2 p-0 d-lg-flex justify-content-center align-items-center'>
            <input type='submit' class='btn btn-primary text-white post' value='Post' name='post-data'>
        </div>
 </div>  
    <div class='col-12 col-lg-2 d-flex d-lg-none justify-content-center lg-ml-4'>
            <input type='submit' class='btn btn-primary text-white post' value='Post' name='post-data'>
    </div>

<div class='image-div w-100 d-flex justify-content-center'>
    <div class='image-holder d-none h-100'>
        <img src='' id='preview' class='image-full' alt=''>
        <input type='button' id='cancel' value='Cancel' class='m-1' onClick='removeImage()'>
        <br>
    </div>
</div>
</form>
