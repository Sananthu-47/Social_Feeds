            const procced = [
            {
            fName : false
            },
            {
            lName : false
            },
            {
            email : false
            },
            {
            password : false
            },
            {
            password_again : false
            }
            ];
            let proccessed_password = '';

            const password_again_element = document.getElementById('reg-password-again');
            const register = document.getElementById('register');

            function addBorder(element,indicater,add,remove,keep,erase,index,status)
            {
            element.classList.add(`border-${add}`);
            element.classList.remove(`border-${remove}`);
            indicater.classList.add(`d-${keep}`);
            indicater.classList.remove(`d-${erase}`);
            procced[index] = status;
            allSet();
            }

            function firstNameCheck(f_name)
            {
            let fNameElement = document.getElementById('first-name');
            let fNameIndicater = document.querySelector('.f-name-indicater');
            if(f_name===''||f_name.length<=3)
            {
            addBorder(fNameElement,fNameIndicater,'danger','success','flex','none',0,false);
            }else{
            addBorder(fNameElement,fNameIndicater,'success','danger','none','flex',0,true);
            }
            }

            function lastNameCheck(l_name)
            {
            let lNameElement = document.getElementById('last-name');
            let lNameIndicater = document.querySelector('.l-name-indicater');
            if(l_name==='')
            {
            addBorder(lNameElement,lNameIndicater,'danger','success','flex','none',1,false);
            }else{
            addBorder(lNameElement,lNameIndicater,'success','danger','none','flex',1,true);
            }
            }

            function emailCheck(user_email)
            {
            let emailElement = document.getElementById('reg-email');
            let emailIndicater = document.querySelector('.email-indicater');
            if(/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(user_email))
            {
            addBorder(emailElement,emailIndicater,'success','danger','none','flex',2,true);
            }else{
            addBorder(emailElement,emailIndicater,'danger','success','flex','none',2,false);
            }
            }

            function passwordCheck(user_password)
            {
            let length = document.getElementById('length');
            let capital = document.getElementById('capital');
            let lower = document.getElementById('lower');
            let digit = document.getElementById('digit');
            let special = document.getElementById('special');
            let statusCount = 0;

            (user_password.length>=8) ? success(length) : danger(length);
            user_password.match(/[A-Z]/)? success(capital) : danger(capital);
            user_password.match(/[a-z]/)? success(lower) : danger(lower);
            user_password.match(/[0-9]/)? success(digit) : danger(digit);
            user_password.match(/[.,:;'!@#$%^&*_+=|(){}[?\-\]\/\\]/)? success(special) : danger(special);

            function success(element)
            {
            element.classList.remove('text-danger');
            element.classList.add('text-success');
            statusCount++;
            }

            function danger(element)
            {
            element.classList.add('text-danger');
            element.classList.remove('text-success');
            statusCount--;
            }

            if(statusCount===5)
            {
            proccessed_password = user_password;
            password_again_element.disabled = false;
            procced[3] = true;
            }else{
            password_again_element.disabled = true;
            procced[3] = false;
            }
            }

            function passwordMatch(user_password_again)
            {
            let password_again_indicater = document.querySelector('.password-again-indicater');

            if(user_password_again === proccessed_password)
            {
            addBorder(password_again_element,password_again_indicater,'success','danger','none','flex',4,true);
            }else{
            addBorder(password_again_element,password_again_indicater,'danger','success','flex','none',4,false);
            }
            }

            function allSet()
            {
            if(procced[0] == true && procced[1] == true && procced[2] == true && procced[3] == true && procced[4] == true)
            {
            register.disabled = false;
            }else{
            register.disabled= true;
            }
            }

            document.getElementById('profile-selector').addEventListener('click',()=>{
              document.getElementById('clearImage').classList.remove('d-none');
              document.getElementById('profile-image').click();  
            });

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

            document.getElementById('clearImage').addEventListener('click',(e)=>{
              e.preventDefault();
                document.getElementById('profile-image').value='';
                document.getElementById('preview').setAttribute('src','assets/images/profiles/profile.png');
                document.getElementById('clearImage').classList.add('d-none');
            });