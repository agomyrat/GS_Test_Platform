class Answers {
   constructor() {
      this.answers = [];
      this.testId = null;
   }
   getAnswer(ans = {},num) {
      this.answers[num] = ans;
      this.answers[num].testId = this.testId;
      this.answers[num].solving_id = questionsClass.questions[num].solving_id;
   }
   diplayAnswers (i){
      console.log(this.answers[i]);
      let data = this.answers[i];
      console.log('DATA',data)
      if(data != null){
         $.ajax({
            url: '../confirmAnswer',
            type: 'post',
            data: data,
            success: function (data) {
               //if(data==0){
               //eger 0 bolsa indiki question jogap bermage rugsat bermeli dal!
               //}
            },
            error: function (data) {
               console.log("Couldn't get questions")
            }
         })
      }
   }
}

const answers = new Answers()