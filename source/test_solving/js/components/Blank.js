
class Blank {
   constructor() {
      this.question = null
      this.questionId = null;
      this.number = null;
      this.answer = [];
   }
   getChoice(questionNumber) {
      this.questionId = questionsClass.questions[questionNumber].id;
      this.question = questionsClass.questions[questionNumber].question;
      this.number = questionNumber;

      if (answers.answers[questionNumber] != undefined) this.answer = answers.answers[questionNumber].answer
      else this.answer = []

      console.log('this.ans',this.answer)
      this.renderChoiceBlock()
   }
   renderChoiceBlock() {
      let n = 0
      let arr = this.answer
      function inputField() {
         let p = '';
         console.log(arr)
         if (arr != 0){
            p = `<input type="text" class="blank-input" data-row=${n} value=${arr[n]} >`;
         }
         else{
            p = `<input type="text" class="blank-input" data-row=${n}>`;
         }
         n += 1;
         return p
      }
      let html = '';
      const questionArray = this.question.split(' ')
      console.log(questionArray)
      questionArray.forEach((str,index) => {
         html += `
         ${str.startsWith('[_') && str.endsWith('_]') ? inputField() : str}
         `
      })
      
      document.querySelector('article').innerHTML = html;
      document.querySelector('.answer-side').innerHTML = "";
      // Get Answers
      const blanks = document.querySelectorAll('.blank-input');

      for(let i = 0 ; i < blanks.length ; i++){
         blanks[i].addEventListener('input', (e) => {
            this.answer[i] = e.target.value
            console.log(this.answer)

            answers.getAnswer({
               answer : this.answer,
               id: this.questionId
            },this.number)

            console.log(answers.answers)
         })
      }

   }
}

const blank = new Blank();