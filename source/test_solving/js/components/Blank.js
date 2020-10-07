
class Blank {
   constructor() {
      this.question = null
      this.questionId = null;
      this.number = null;
      this.solving_id = null;
      this.answer = [];
   }
   getChoice(questionNumber) {
      this.questionId = questionsClass.questions[questionNumber].id;
      this.question = questionsClass.questions[questionNumber].question;
      this.number = questionNumber;


      if (answers.answers[questionNumber].answer !== null) {
         this.solving_id = answers.answers[questionNumber].solving_id;
         this.answer = answers.answers[questionNumber].answer;
      }
      else this.answer = [];
      console.log(this.answer)
      this.renderChoiceBlock()
   }
   renderChoiceBlock() {
      let n = 0
      let arr;
      if(this.answer){
         arr = this.answer
         console.log('aaaa')
      }
      function inputField() {
         let p = '';
         console.log(arr)
         if (arr.length > 0){
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
            this.answer[i] = e.target.value;
            console.log(this.answer[i])

            let total = 0;
            this.answer.forEach((ans, index) => {
               if (this.answer[index] == '') {
                  total++
               }
            });
            console.log(total)
            if (total === this.answer.length) {
               this.answer = null;
            }

            answers.getAnswer({
               answer : this.answer,
               id: this.questionId,
               solving_id: this.solving_id,
               type : 'blank'
            },this.number)

            console.log(answers.answers[this.number])
         })
      }

   }
}

const blank = new Blank();