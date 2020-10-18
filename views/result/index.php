<main>
      <h2>Results Page</h2>
      <!-- CHART -->
      <section>
            <div id="container" >
               <canvas id="canvas"></canvas>
            </div>
            <div id="canvas-holder">
            <canvas id="chart-area"></canvas>
         </div>

         
      </section>

      <!-- TABLE -->
      <section class="tables">
         <table id="table_id" class="display" data-page-length='3'>
            <thead>
               <tr>
                  <th>User name</th>
                  <th>Full name</th>
                  <th>True answers</th>
                  <th>Wrong answers</th>
                  <th>No answers</th>
                  <th>Solved time</th>
                  <th>Score</th>
               </tr>
            </thead>
            <tbody class="data-body">
               <?php foreach($tableInfoes as $info): ?>
                  <tr>
                  <td><?=$info['USER_NAME']?></td>
                  <td><?=$info['USER_FULL_NAME']?></td>
                  <td><?=$info['TRUE_ANSWER_COUNT']?></td>
                  <td><?=$info['FALSE_ANSWER_COUNT']?></td>
                  <td><?=$info['NOT_SOLVED']?></td>
                  <td><?=$info['TIME_SOLVING']?></td>
                  <td><?=$info['SCORE']."%"?></td>
               </tr> 
               <?php endforeach; ?>
            </tbody>
         </table>
      </section>
   </main>

   <div class="rotate-bg">
      <div class="rotate-block">
         <img src="source/general/img/rotate.gif" alt="">
         <h1>Please rotate your device</h1>
      </div>
   </div>

   <script>
      var questionIndexes = <?=$questionIndexes?>;
      var trueAnswers = <?=$trueAnswers?>;
      var wrongAnswers = <?=$wrongAnswers?>;
      var noAnswers = <?=$noAnswers?>;
      var pieKeys = <?=$pieKeys?>;
      var pieValues = <?=$pieValues?>;
   </script>
