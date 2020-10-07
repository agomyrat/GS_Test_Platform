<!-- TABS -->
<div class="tabs">
      <div class="container">
         <div class="tab active-tab"><i id="icons" class="far fa-file-alt"></i>&nbsp; MY TESTS</div>
         <div class="tab"><i class="fa fa-lock"></i>&nbsp; PRIVATE</div>
         <div class="tab"><i class="fa fa-globe"></i>&nbsp; PUBLIC</div>
         <div class="tab"><i class="fa fa-hourglass-half"></i>&nbsp; WAITING</div>
         <div class="tab"><i class="fa fa-archive"></i>&nbsp; ARCHIVE</div>
      </div>
   </div>

   <!-- CARDS -->
   <div class="wrapper">
      <div class="cards">
         <?php $this->renderCards(); ?>
      </div>
   </div>

   <div class="modal-bg">
      <div class="modal">
         <p class="substring q-title">Question Title</p>
         <!-- <div class="view-question">
            <a href="">View Question</a>
         </div> -->
         <div class="settings">
            <ul>
               <li><a href="">Show Results</a></li>
               <li><a href="">View Questions</a></li>
               <li><a href="">Edit</a></li>
               <li><a href="">Copy</a></li>
               <li><a style="color:red" href="">Delete</a></li>
            </ul>
         </div>
      </div>
   </div>