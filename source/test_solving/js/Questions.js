/* Questions Class */
class Questions {
   constructor() {
      this.questions = [];
      this.time = null
   }
   getData(){
      // this.questions = data.questions
      // this.time = data.time
      // console.log(this.questions);
      // console.log(this.time)
      $.ajax({
         url: '../getSolvingQuestions',
         type: 'post',
         data: {
            testId: 12
         },
         success: function (data) {
            /*...*/
            // this.questions = data.questions
            // this.time = data.time
            var response = JSON.parse(data)
            console.log(response);
            this.questions = response.questions
            this.time = response.time   
            console.log(this.questions)
         },
         error: function (data) {
            displayError("Couldn't get questions")
         }
   
      })
   }
}


const questionsClass = new Questions();   
questionsClass.getData()




