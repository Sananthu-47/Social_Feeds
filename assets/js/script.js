function addPhotoPost()
{
    document.getElementById('add-post').click();
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
    document.getElementById('add-post').value="";
    document.getElementById('preview').src='';
  }


//   const form = document.getElementById('likes-form');
// form.addEventListener('click',(e)=>{
//     e.preventDefault();
//     const formData = new FormData(form);
//     postData(formData);
// });

// async function postData(formData) {
//     const response = await fetch ('global.php',{
//         method : 'POST',
//         body : formData
//     });
//     const data = await response.text();
//     console.log(data);
// }