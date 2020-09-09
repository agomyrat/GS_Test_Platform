/* Questions Class */
class Questions {
   constructor() {
      this.questions = [];
      this.time = null
   }
   getData(){
      getQ()
   }
}


const questionsClass = new Questions();
questionsClass.getData()
console.log(questionsClass)

function getQ() {
   $.ajax({
      url: '../getSolvingQuestions',
      type: 'post',
      data: {
         testId: 1
      },
      success: function (data) {
         /*...*/

         var response = JSON.parse(data);

         // Get answers from db  
         answers.answers = response.answers

         console.log(response);
         questionsClass.questions = response.questions;
         questionsClass.time = response.time
         answers.testId = response.testId;
         //Render Questions
         header.getData()
         pagination.getNumberOfQuestion()
         questionBlock.getQuestion()
         pagination.typeofQuestion(questionsClass.questions[0].type, 0)
         pagination.displayPagination()
         pagination.goSpecificQuestion()
         // Starting Time
         if (questionsClass.time) {
            time.getTime()
         }
         onloadFunc()
         pagination.nextprevBtn();


      },
      error: function (data) {
         console.log("Couldn't get questions")
      }
      })
}


