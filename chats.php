<?php include "includes/header.php"; ?>
   
    <div class='wrapper d-flex justify-content-center'>
    <!-- Holds all the data in the chats page -->
        <div class='col-12 col-md-5 col-lg-5 col-xl-3 vh-100 border border-dark p-0 d-flex flex-column' id='chat-left'>
            <!-- Header or the logo of the app  --->
            <header class='text-center custom-header'><span class="custom-logo-font">Social_Feeds</span></header>
            <!-- Search field --->
            <div class='w-100'><input type='text' class='form-control my-1 border border-secondary' placeholder='Search..'/></div>
            <!-- all cahts persons --->
                <div id='all-chats-wrapper' class='all-chats d-flex flex-column w-100'>
                    <!--- Loop here to display all chats --->
                    <div class='d-flex border border-secondary alert alert-secondary m-0'>
                        <div class='image-preview'>
                            <img src='assets/images/profiles/profile.png' class='profile-image-tag' />
                        </div>
                        <div class='chat-preview ml-2 w-100'>
                            <div class='d-flex w-100'>
                                <span class='h5 col-10 p-0'>Ananthu</span>
                                <span class='col-2 p-0'>10:45pm</span>
                            </div>
                            <p>Good to see you</p>
                        </div>
                    </div><!--- Loop ends of displaying all chats--->
                </div><!--</all-chats>-->
            </div>

            <!--- Show chats -->
            <div id='chating-messages' class='col-md-7 col-lg-5 border border-dark chats lg-d-flex flex-column p-0 m-0'>
                <!--- Menu bar for chats --->
                <div class='d-flex m-0 p-1 w-100 custom-header'>
                    <div class='image-preview'>
                    <img src='assets/images/profiles/profile.png' class='profile-image-tag' />
                    </div>
                    <div class='d-flex flex-column col-8 p-0 text-light ml-2'>
                        <span>Ananthu</span>
                        <span class='small-text'>Last seen 10:45 pm</span>
                    </div>
                    <div class='d-flex w-25 p-1 d-flex justify-content-center align-items-center'>
                        <i class='fa fa-search text-light mr-3'></i>
                        <i class="fa fa-ellipsis-v text-light ml-3"></i>
                    </div>
                </div><!--  </custom-header>  --->

                <!---Display chatting messages --->
                <div class='d-flex flex-column' id="display-messages">

                    <div class='flex-row border border-dark' id="display-all-messages">
                        <div class="message my-message">Hi</div>
                        <div class="message friend-message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis sint nemo magni expedita fuga asperiores vel! Ut veritatis perspiciatis, debitis sapiente impedit voluptate distinctio, necessitatibus architecto cum, ratione officiis natus.</div>
                        <div class="message my-message">Hi</div>
                        <div class="message friend-message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis sint nemo magni expedita fuga asperiores vel! Ut veritatis</div>
                        <div class="message my-message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Et commodi nisi sint in quis, quibusdam labore minus dignissimos ullam nostrum alias deserunt officiis impedit illum molestias ratione laudantium. Sit, ut!</div>
                        <div class="message friend-message">Lorpiciatis, debitis sapiente impedit voluptate distinctio, necessitatibus architecto cum, ratione officiis natus.</div>
                        <div class="message my-message">Hi</div>
                        <div class="message friend-message">Lorem ipsum dolor sis, debitiss.</div>
                        <div class="message my-message"> sapiente impedit voluptate distinctio, necessitatibus architecto cum, ratione officiis natu</div>
                        <div class="message friend-message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis sint nemo magni expedita fuga asperiores vel! Ut veritatis perspiciatis, debitis sapiente impedit voluptate distinctio, necessitatibus architecto cum, ratione officiis natus.</div>
                        <div class="message my-message">Hi</div>
                        <div class="message friend-message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis sint nemo magni expedita fuga asperiores vel! Ut veritatis perspiciatis, debitis sapiente impedit voluptate distinctio, necessitatibus architecto cum, ratione officiis natus.</div>
                    </div>

                    <div class='d-flex border border-dark' id='user-input-field'></div>
                </div>

            </div>

       </div><!-- Ends holding -->
    </div> <!-- wrapper -->


<?php include "includes/footer.php"; ?>