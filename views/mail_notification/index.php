   <div class="wrapper">
      <div>
         <div class="header">
            <div class="msg-icon">
               <i class="far fa-envelope-open"></i>
            </div>
         </div>
         <div class="bottom">
            <div class="title">
               <h3 class="check"><?= Polyglot::translate('Activation Notification') ?> </h3>
            </div>
            <div class="btn-place">
               <div class="button">
                  <a class="btn" href="#"><?= Polyglot::translate('Back to Home') ?></a>
               </div>
               <div class="button">
                  <a class="btn btn-light" href="#" id="send-again"><?= Polyglot::translate('Send Again') ?></a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <script>
      let mail_sended = "<?= Polyglot::translate('mail_sended') ?>";
      let mail_not_sended = "<?= Polyglot::translate('mail_not_sended') ?>";
   </script>