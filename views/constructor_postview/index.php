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
                     <input type="text" id="name" name="name" placeholder="Intro to exam" value="<?=$test_arr['TEST_NAME']?>"/>
                  </div>
                  <div class="input language">
                     <label for="lang">Language</label>
                     <select name="langs" id="lang">
                        <option value="English" <?php if($test_arr['LANGUAGE']=='English'){echo 'selected';} ?>>English</option>
                        <option value="Russian" <?php if($test_arr['LANGUAGE']=='Russian'){echo 'selected';} ?>>Russian</option>
                        <option value="Turkmen" <?php if($test_arr['LANGUAGE']=='Turkmen'){echo 'selected';} ?>>Turkmen</option>
                     </select>
                  </div>
                  <div class="input">
                     <label for="description">Description</label>
                     <textarea name="description" id="description" cols="30" rows="10"><?=$test_arr['DESCRIPTION']?></textarea>
                  </div>
                  <div class="row">
                     <div class="input">
                        <label for="status">Status</label>
                        <select name="status" id="status">
                           <option value="public" <?php if($test_arr['IS_PUBLIC']==1){echo 'selected';} ?>>Public</option>
                           <option value="private" <?php if($test_arr['IS_PUBLIC']==0){echo 'selected';} ?>>Private</option>
                        </select>
                     </div>
                     <div class="input">
                        <label for="password">Password</label>
                        <input type="text" name="password" id="password"/>
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
                     <img src="<?=URL."uploads/".$test_arr['TEST_IMAGE']?>" data-image="<?=$test_arr['TEST_IMAGE']?>" id="photo" />
                  </div>
                  <div class="row">
                     <div class="input">
                        <label for="time">Given time(min)</label>
                        <input type="number" name="time" id="time" value="<?=$test_arr['GIVEN_TIME']?>"/>
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
                        <input type="date" name="start-date" id="time" value="<?=$test_arr['START_DATE']?>"/>
                        <label for="time">Start Time</label>
                        <input type="time" placeholder="in minutes" name="start-time" id="time" value="<?=$test_arr['START_TIME']?>"/>
                     </div>
                     <div class="input">
                        <label for="deadline">End Date</label>
                        <input type="date" name="end-date" id="deadline" value="<?=$test_arr['END_DATE']?>"/>   
                        <label for="deadline">End Time</label>
                        <input type="time" name="end-time" id="deadline" value="<?=$test_arr['END_TIME']?>"/>
                        <input type="hidden" name="test_id" value="<?=$test_id?>">
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