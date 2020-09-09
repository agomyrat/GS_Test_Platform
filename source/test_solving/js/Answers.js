class Answers {
   constructor() {
      this.answers = [];
      this.testId = null;
   }
   getAnswer(ans = {},num) {
      this.answers[num] = ans;
      this.answers[num].testId = this.testId;
      this.answers[num].solving_id = questionsClass.questions[num].solving_id;
      console.log('NUM',num)
      this.current = num
   }
   diplayAnswers (i){
      console.log(this.answers[i]);
      console.log(this.answers)
      let data = this.answers[i];
      console.log('DATA',data)
      if(data != null){
         $.ajax({
            url: '../confirmAnswer',
            type: 'post',
            data: {data:data},
            success: function (data) {
               let solving_id = data;
               console.log('i',i)
               console.log(questionsClass.questions[i].solving_id)
               if (questionsClass.questions[i].solving_id == null) {
                  questionsClass.questions[i].solving_id = Number(data);
                  console.log(questionsClass.questions[i].solving_id)
               }
            },
            error: function (data) {
               console.log("Couldn't get questions")
            }
         })
      }
   }
}

const answers = new Answers()