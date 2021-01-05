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

                    <div class='d-flex border border-dark w-100 d-flex align-items-center' id='user-input-field'>
                        <input type="text" id="user-input-message" class='mx-3 form-control' placeholder='Type your message here...'>
                        <button type='submit' class='btn btn-primary'>send</button>
                    </div>
                </div>