
<div class="container">
   <aside>
      <div id="questions">
         <!-- QUESTIONS SIDEBAR -->
      </div>
      <div class="add-question">
         <button id="add-question-btn"><?= Polyglot::translate('Add question +'); ?></button>
      </div>
   </aside>
   <section>
      <div div class="nav2">
         <a href="#" class="leave-test"><?= Polyglot::translate('Leave Test'); ?></a>
         <a href="#" class="finish-test-btn" ><?= Polyglot::translate('Test'); ?></a>
      </div>
      <header>
         <!-- Question -->
      </header>
      <div class="wrapper">
         <!-- Question Types -->
      </div>

      <div class="error-block">
         <?= Polyglot::translate('Error'); ?>
      </div>
      <div class="note">
         <?= Polyglot::translate('Warning'); ?>
      </div>
   </section>
</div>

<div class="side-burger">
   <div>
      <i class="fas fa-bars"></i>
   </div>
</div>

<!-- IMAGE BLOCK EFFECT -->
<div class="bg-dark">
   <div class="close-btn">
      +
   </div>
   <div class="image-place">
      <img src="8.jpg" alt="">
   </div>
</div>

<div class="rotate-bg">
   <div class="rotate-block">
      <img src="../../source/general/img/rotate.gif" alt="">
      <h1><?= Polyglot::translate('Please rotate your device'); ?></h1>
   </div>
</div>

<div class="test-id"><?= $test_id ?></div>
<div id="test_id" style="display:none;"><?= $test_id ?></div>


<script>
   const data_language = <?= Polyglot::forJS(); ?>;
   function js_translater(key = '') {
      return data_language[key]['<?= Session::get(LANG); ?>'];
   }
</script>