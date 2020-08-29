class Answers {
   constructor() {
      this.answers = []
   }
   getAnswer(ans = {},num) {
      this.answers[num] = ans 
   }
   diplayAnswers (){
      console.log(this.answers)
   }
}

const answers = new Answers()