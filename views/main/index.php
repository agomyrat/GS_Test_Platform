<!-- Section -->
<section>
   <!-- SIDE BAR -->
   <aside>
      <h3>Logo</h3>
      <div class="test-list-block">
         <ul class="side-bar-list">
            <li data-type="Recent added"><a href="#"><i id="icons" class="far fa-window-restore"></i>Recent added</a></li>
            <li data-type="Top tests"><a href="#"><i id="icons" class="fas fa-medal"></i>Top tests</a></li>
            <li data-type="Popular tests"><a href="#"><i id="icons" class="fas fa-fire-alt"></i>Popular tests</a></li>
         </ul>
      </div>
      <div class="personal-list-block">
         <ul class="side-bar-list">
            <li data-type="Pinned Tests"><a href="#"><i id="icons" class="far fa-bookmark"></i>Pinned tests</a></li>
            <li data-type="History"><a href="#"><i id="icons" class="fas fa-history"></i>History</a></li>
            <li data-type="My tests"><a href=""><i id="icons" class="far fa-file-alt"></i>My tests</a></li>
         </ul>
      </div>
      <div class="create-test-block">
         <div>
            <a href="test/constructor" class="create-btn">Create Test</a>
         </div>
      </div>
      <footer>
         <p>&#169; 2020 TestSpace <br>
            All Rights Reserved
         </p>
      </footer>
   </aside>
   <div class="side-burger">
      <span>=</span>
   </div>
   <!---->

   <!-- MAIN-->
   <main>
      <div class="search-tab">
         <!-- Search Bar -->
         <div class="search-box">
            <div class="search-icon"><i class="fas fa-search"></i></div>
            <form id="form-search">
               <input type="search" class="search-input" placeholder="Search with keyword">
            </form>
         </div>
         <!-- TAbs -->
         <!-- <div class="tabs">
            <a href="#">Physics</a>
            <a href="#">History</a>
            <a href="#">Math</a>
            <a href="#">Programming</a>
            <a href="#">Economics</a>
            <a href="#">Physics</a>
            <a href="#">History</a>
            <a href="#">Math</a>
            <a href="#">Programming</a>
            <a href="#">Economics</a>
         </div> -->
      </div>
      <!--/-->


      <!-- CARDS  -->
      <div class="wrapper">
         <h2 class="title-name">Recent Added</h2>
         <div class="cards">
            <!-- CARD -->
            <?php //$this->renderCards(['test_cards'=>$test_cards]); 
            ?>
         </div>
         <div class="loading active-loading">
            <div>
               <img src="source/general/img/2.svg" alt="">
            </div>
         </div>
      </div>


   </main>
</section>