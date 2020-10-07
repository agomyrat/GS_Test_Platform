<div style="top: -50px; opacity: 0" class="alert error">
      <i class="fa fa-times"></i>
   </div>

   <!-- Navbar -->

   <main>
      <div class="container">
         <form id="form">
            <div class="postview-wrapper">
               <div class="left">
                  <h1>Information about test</h1>

                  <div class="input">
                     <label for="name">Name</label>
                     <input type="text" id="name" name="name" placeholder="Intro to exam" />
                  </div>
                  <div class="input language">
                     <label for="lang">Language</label>
                     <select name="langs" id="lang">
                        <option value="english">English</option>
                        <option value="english">Russian</option>
                        <option value="english">Turkmen</option>
                     </select>
                  </div>
                  <div class="input">
                     <label for="description">Description</label>
                     <textarea name="description" id="description" cols="30" rows="10"></textarea>
                  </div>
                  <div class="row">
                     <div class="input">
                        <label for="status">Status</label>
                        <select name="status" id="status">
                           <option value="public">Public</option>
                           <option value="private">Private</option>
                        </select>
                     </div>
                     <div class="input">
                        <label for="password">Password</label>
                        <input type="text" name="password" id="password" />
                     </div>
                  </div>
                  <!-- <div class="input language">
                     <label for="lang">Keywords:</label>
                     <input list="keywords-list" name="browser" id="browser">

                     <datalist id="keywords-list">
                        <option value="Edge">
                        <option value="Firefox">
                        <option value="Chrome">
                        <option value="Opera">
                        <option value="Safari">
                     </datalist>
                  </div> -->
                  <div class="container-key">
                     <label>Keywords</label>
                     <ul id="list"></ul>
                     <input type="text" id="txt" placeholder="Add Keyword ...">
                  </div>
               </div>
               <div class="right">
                  <div class="test-img-wrapper">
                     <img src="./img/profile.jpg" alt="" id="photo" />
                  </div>
                  <div class="row">
                     <div class="input">
                        <label for="time">Given time(min)</label>
                        <input type="number" name="time" id="time" />
                     </div>
                     <div class="input">
                        <label for="photoInput">Photo of test</label>
                        <div class="input-file">
                           <i class="far fa-image" style="font-size: 2.5rem;"></i>
                           <input type="file" name="photo" id="photoInput" />
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="input">
                        <label for="time">Start Date</label>
                        <input type="date" name="start-date" id="time" />
                        <label for="time">Start Time</label>
                        <input type="time" placeholder="in minutes" name="start-time" id="time" />
                     </div>
                     <div class="input">
                        <label for="deadline">End Date</label>
                        <input type="date" name="end-date" id="deadline" />   
                        <label for="deadline">End Time</label>
                        <input type="time" name="end-time" id="deadline" />
                     </div>
                  </div>
                  <div class="row btns">
                     <button class="btn">Check Test</button>
                     <button type="submit" class="btn">Publish Test</button>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </main>