<section>
   <!-- MODAL - 1 -->
   <div class="finish-test-modal-wrapper" id="first-modal">
      <div class="modal">
           <p>Are you sure ?</p>
           <div class="btn-block">
               <button class="close-btn">No</button>
               <button class="active-btn">Yes</button>
           </div>
      </div>
   </div>
   <!-- MODAL - 2 -->
   <div class="finish-test-modal-wrapper" id="second-modal">
         <div class="modal">
            <div class="score">
               <p>Congrats! Your score:</p>
               <p id="score" class='good'> 92</p>
            </div>
            <div class="counts">
               <div class="count">
                  <p ><i class="fa fa-check"></i> Right answers: <span id="right-answers"></span></p>
               </div>
               <div class="count">
                  <p><i class="fa fa-times"></i> Wrong answers: <span  id="wrong-answers"></span></p>
               </div>
               <div class="count">
                  <p >Not solved: <span id="not-solved"></span></p>
               </div>
            </div>
            <form class="feedback">
               <label for="feedback">Feedback (not required)</label>
               <textarea id="feedback" placeholder="How was the test?"></textarea>
               <div class="bottom">
                  <p><i id="like-test" class="fa fa-heart"></i>Testi haladym</p>
                  <button class="btn">Send</button>
               </div>
            </form>
            <div class="btns">
               <!-- <button class="btn">View results</button> -->
               <button class="btn">Go to main page</button>
            </div>
         </div>
      </div>
      <!-- Header -->
      <header>
         <div class="question-number"></div>
         <div class="right-side">
            <div class="t"></div>
               <!-- <div class="timer">
                  <i class="far fa-clock"></i>&nbsp;
               </div> -->
            <div class="finish">
               <a class="finish-btn" href="#">Finish Test</a>
            </div>
         </div>
      </header>
      <!-- Container -->
      <div class="container">
         <!-- Question Side -->
         <div class="render-question">
            <!-- render question -->
         </div>
         <!-- Answers Side -->
         <div class="answer-side">
            
         </div>
      </div>
      <!--  -->
      <!-- Pagination Footer -->
      <footer>
         <div class="pagination">
            <div>
               <button class="prev-btn">Prev</button>
            </div>
            <div class="numbers">
               <button class="left"><i class="fas fa-chevron-left"></i></button>
               <div class="pagination-slider">
                  <!-- Spans of pagination-->
               </div>
               <button class="right"><i class="fas fa-chevron-right"></i></button>
            </div>
            <div>
               <button class="next-btn">Next</button>
            </div>
         </div>
      </footer>
   </section>
<input type="hidden" id="test-id" value="<?=$test_id?>">