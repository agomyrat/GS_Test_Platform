<div class="container">
   <!-- Home -->

   <div id="home">
      <div class="part1">
         <div class="header">
            <h1 class="anim1"><?= Polyglot::translate('Proverb1') ?></h1>
            <h3 class="anim1"><?= Polyglot::translate('Proverb2') ?></h3>
            <div class="orange-btn">
               <button class="anim1"><a href="signup"><?= Polyglot::translate('Get Started') ?><i class="fas fa-angle-right"></i></a></button>
            </div>
         </div>
      </div>
      <div class="part2">
         <div class="svg">
            <img class="home-1" src="source/welcome/images/home-1.svg" alt="">
         </div>
      </div>
   </div>

   <!-- About -->
   <div id="about" class="animate">
      <header class="about-header">
         <?= Polyglot::translate('About') ?>
      </header>
      <div class="box">
         <div class="box1">
            <div class="svg">
               <img class="about-image" src="source/welcome/images/about-1.svg" alt="about">
            </div>
         </div>
         <div class="box2">
            <article>
               <h1>Who we are?</h1>
               <?= Polyglot::translate('AboutUs') ?>
            </article>
         </div>
      </div>
   </div>
   <!-- Contact -->
   <div id="contact" class="animate">
      <header class="contact-header">
         <?= Polyglot::translate('ContactUs') ?>
      </header>
      <div class="box">
         <div class="box1">
            <div class="svg">
               <img class="contact-image" src="source/welcome/images/contact.svg" alt="about">
            </div>
         </div>
         <div class="box2">
            <aside>
               <form action="mailnotification/contactUs">
                  <div>
                     <h3><?= Polyglot::translate('SendMessage') ?></h3>
                  </div>
                  <div>
                     <label for="name"><?= Polyglot::translate('Name') ?></label><br>
                     <input name="name" type="text" class="name input" id="name">
                  </div>
                  <div>
                     <label for="email"><?= Polyglot::translate('YourEmail') ?></label><br>
                     <input name="email" type="email" class="name input" id="email">
                  </div>
                  <div>
                     <label for="message"><?= Polyglot::translate('YourMessage') ?></label><br>
                     <textarea name="message" maxlength="250" name="message" id="message" cols="30" rows="5"></textarea>
                  </div>
                  <div class="error">
                     <p></p>
                  </div>
                  <div>
                     <input class="send" type="submit" value="<?= Polyglot::translate('Send') ?>">
                  </div>
               </form>
            </aside>
         </div>
      </div>
