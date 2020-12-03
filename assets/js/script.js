function addPhotoPost()
{
    document.getElementById('add-post').click();
    document.querySelector('.select-image').innerText="Change image";
}

function previewImage(e) {
    if(e.files[0])
    {
      let reader = new FileReader();
      reader.onload = (e)=>{
          if(e.target.result.match(/^data:image\//))
          {
        document.getElementById('preview').setAttribute('src', e.target.result);
          }else{
              alert("Not supported");
          }
      }
      reader.readAsDataURL(e.files[0]);
    }
        document.querySelector('.image-holder').classList.remove('d-none');
        document.querySelector('.image-holder').classList.add('d-block');
  }

  function removeImage() {
    document.querySelector('.image-holder').classList.remove('d-block');
    document.querySelector('.image-holder').classList.add('d-none');
    document.getElementById('add-post').src="none";
    document.querySelector('.select-image').innerText="Add image";
  }

  if(document.getElementById('friends'))
  {
  document.getElementById('friends').addEventListener('click',()=>
  {
    document.querySelector('.main-content').style.display="none";
    document.querySelector('.friends-list').classList.remove('d-none');
  });
}

if(document.getElementById('close'))
  {
  document.getElementById('close').addEventListener('click',()=>
  {
    document.querySelector('.main-content').style.display="flex";
    document.querySelector('.friends-list').classList.add('d-none');
  });
}

function selectFile()
            {
                document.getElementById('profile-image').click();
            }

            function displayImage(e) {
              if(e.files[0])
              {
                let reader = new FileReader();
                reader.onload = (e)=>{
                    if(e.target.result.match(/^data:image\//))
                    {
                  document.getElementById('preview').setAttribute('src', e.target.result);
                    }else{
                        alert("Not supported");
                    }
                }
                reader.readAsDataURL(e.files[0]);
              }
            }