   <section>
      <div class="circles">
         <span id="page" class="active-circle">1</span>
         <span id="page">2</span>
         <span id="page">3</span>
      </div>

      <div class="container">
         <div class="box">
            <div class="horizontal">
               <!-- First Form -->
               <div class="slide">
                  <form class="first-form" action="">
                     <div>
                        <label><?= Polyglot::translate('Frstnm') ?></label> <br>
                        <input class="firstname form-input" type="text" />
                     </div>
                     <div>
                        <label><?= Polyglot::translate('Lstnm') ?></label> <br>
                        <input class="lastname form-input" type="text" />
                     </div>
                     <div>
                        <label><?= Polyglot::translate('Usrnm') ?></label> <br>
                        <input class="username form-input" type="text" />
                        <div class="check-username" style="color:red; font-size:12px; display:none;"><?= Polyglot::translate('Occupied') ?></div>
                     </div>
                  </form>
                  <div class="btn-group" style="display: grid; justify-items: center;">
                     <!-- <button class="prev-button"><i class="fas fa-angle-left"></i></button> -->
                     <button class="next-button next-button-1"><?= Polyglot::translate('Next') ?></button>
                  </div>
               </div>
               <!-- Second Form -->
               <div>
                  <form class="second-form" action="">
                     <div>
                        <label><?= Polyglot::translate('Conphnum') ?></label> <br>
                        <input id="phone" class="phone-number form-input" name="phone" type="tel">
                     </div>
                     <div>
                        <label><?= Polyglot::translate('Birthdate') ?></label> <br>
                        <select class="birth-day birth" name="day" id="">
                           <option selected hidden value=""><?= Polyglot::translate('Day') ?></option>
                        </select>
                        <select class="birth-month birth" name="month" id="">
                           <option selected hidden value=""><?= Polyglot::translate('Month') ?></option>
                        </select>
                        <select class="birth-year birth" name="year" id="">
                           <option selected hidden value=""><?= Polyglot::translate('Year') ?></option>
                        </select>
                     </div>
                  </form>
                  <div class="btn-group">
                     <button class="prev-button prev-button-2"><i class="fas fa-angle-left"></i></button>
                     <button class="next-button next-button-2"><?= Polyglot::translate('Next') ?></button>
                  </div>
               </div>
               <!-- Third Form -->
               <div>
                  <form class="third-form" action="">
                     <div>
                        <label><?= Polyglot::translate('Email') ?></label> <br>
                        <input class="email form-input" type="email" />
                        <div class="check-email" style="color:red; font-size:12px; display:none;">
                           <?= Polyglot::translate('Entered Email') ?>
                        </div>
                     </div>
                     <div>
                        <label><?= Polyglot::translate('Paswrd') ?></label> <br>
                        <input class="password form-input" type="password" />
                     </div>
                     <div>
                        <label><?= Polyglot::translate('Confirm paswrd') ?></label> <br>
                        <input class="password2 form-input" checked type="password" />
                     </div>
                     <div style="display: flex; align-items: center;">
                        <input type="checkbox" class="check" />
                        <span style="padding-left: 10px;">
                           <?= Polyglot::translate('Iagree') ?>
                        </span>
                     </div>
                  </form>
                  <div class="btn-group">
                     <button class="prev-button prev-button-3"><i class="fas fa-angle-left"></i></button>
                     <button class="next-button next-button-3"><?= Polyglot::translate('Create') ?></button>
                  </div>
               </div>
            </div>

            <!-- Error Block -->
            <div class="error-block"><?= Polyglot::translate('fill_in') ?></div>

         </div>
      </div>

      <!-- MODAL - POP-UP -->
      <div class="modal">
         <div class="pop-up">
            <h2><?= Polyglot::translate('terms_conditions') ?></h2>
            <article>
               <?= Polyglot::translate('terms_conditions_body') ?>
            </article>
            <div>
               <button class="close"> <?= Polyglot::translate('close') ?></button>
            </div>
         </div>
      </div>

   </section>

   <div class="background"></div>

   <script>
      let month_language = JSON.parse('<?= Polyglot::translate('months') ?>');
      // console.log(month_language);
   </script>