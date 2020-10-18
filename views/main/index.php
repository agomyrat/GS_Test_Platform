<!-- Section -->

<section>
   <!-- SIDE BAR -->
   <aside>
      <h3>Logo</h3>
      <div class="test-list-block">
         <ul class="side-bar-list">
            <li data-type="Recent added"><a href="#"><i id="icons" class="far fa-window-restore"></i><?= Polyglot::translate('Recent added') ?></a></li>
            <li data-type="Top tests"><a href="#"><i id="icons" class="fas fa-medal"></i><?= Polyglot::translate('Top tests'); ?></a></li>
            <li data-type="Popular tests"><a href="#"><i id="icons" class="fas fa-fire-alt"></i><?= Polyglot::translate('Popular tests'); ?></a></li>
         </ul>
      </div>
      <div class="personal-list-block">
         <ul class="side-bar-list">
            <li data-type="Pinned Tests"><a href="#"><i id="icons" class="far fa-bookmark"></i><?= Polyglot::translate('Pinned tests'); ?></a></li>
            <li data-type="History"><a href="#"><i id="icons" class="fas fa-history"></i><?= Polyglot::translate('History'); ?></a></li>
            <li data-type="My tests"><a href="<?=URL."main/mytests"?>"><i id="icons" class="far fa-file-alt"></i><?= Polyglot::translate('My tests'); ?></a></li>
         </ul>
      </div>
      <div class="create-test-block">
         <div>
            <a href="test/constructor" class="create-btn"><?= Polyglot::translate('Create Test'); ?></a>
         </div>
      </div>
      <footer>
         <p>&#169; <?= Date('Y'); ?> TestSpace <br>
            <?= Polyglot::translate('All Rights'); ?><br>
         </p>
         <div class="feedback">
            <button class="feedback-btn"><?= Polyglot::translate('Feedback'); ?></button>
         </div>
      </footer>


   </aside>
   <div class="side-burger">
      <span>=</span>
   </div>
   <!---->

   <div class="finish-test-modal-wrapper">
      <div class="modal">
         <h4><?= Polyglot::translate('Send Feedback'); ?></h4>
         <form class="feedback-form">
            <textarea class="feedback-input"></textarea>
            <br>
            <input type="submit" class="submit-feedback" value="<?= Polyglot::translate('Submit'); ?>">
         </form>
      </div>
   </div>

   <!-- MAIN-->
   <main>
      <div class="search-tab">
         <!-- Search Bar -->
         <div class="search-box">
            <div class="search-icon"><i class="fas fa-search"></i></div>
            <form id="form-search">
               <input type="search" class="search-input" placeholder="<?= Polyglot::translate('Search with keyword'); ?>">
            </form>
         </div>
         <!-- TAbs -->
      </div>
      <!--/-->


      <!-- CARDS  -->
      <div class="wrapper">
         <h2 class="title-name"><?= Polyglot::translate('Recent added') ?></h2>
         <div class="cards">
            <!-- CARDS -->
         </div>
         <div class="loading active-loading">
            <div>
               <img src="source/general/img/2.svg" alt="">
            </div>
         </div>
      </div>
   </main>

   <!-- ALERT -->
   <div class="alert">
      <div>
         This is alert !
      </div>
   </div>

</section>
<script>
   const data_language = <?= Polyglot::forJS(); ?>;

   function js_translater(key = '') {
      return data_language[key]['<?= Session::get(LANG); ?>'];
   }
</script>