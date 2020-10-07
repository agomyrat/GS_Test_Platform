class Answers {
   constructor() {
      this.answers = [];
      this.testId = null;
   }
   getAnswer(ans = {},num) {
      this.answers[num] = ans;
      console.log(this.answers)
      this.answers[num].testId = this.testId;
      this.current = num
   }
   diplayAnswers (i){
      let data = this.answers[i];
      if(data != null){
         $.ajax({
            url: '../confirmAnswer',
            type: 'post',
            data: {data:data},
            success: function (response) {

               console.log('POST Answers', answers.answers);
               if (answers.answers[i].solving_id == null) {
                  answers.answers[i].solving_id = Number(response);
               }
            },
            error: function (response) {
               console.log("Couldn't get questions")
            }
         })
      }
   }
}

const answers = new Answers()