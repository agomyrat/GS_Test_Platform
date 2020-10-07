class InputType {
   constructor() {
      this.questionId = null;
      this.answer = null;
      this.number = null;
      this.solving_id  = null;
   }
   getChoice(questionNumber) {
      console.log('INPUT', questionsClass.questions[questionNumber].id)
      console.log(answers.answers[questionNumber].answer)
      this.number = questionNumber;
      this.questionId = questionsClass.questions[questionNumber].id;
      this.solving_id = questionsClass.questions[questionNumber].solving_id;
      if(answers.answers[questionNumber] != undefined) this.answer = answers.answers[questionNumber].answer
      else this.answer = ''
      this.renderChoiceBlock()
   }

   renderChoiceBlock() {
      console.log('ANS',this.answer)
      let html = '';
      html += `
         <div class = "input-block" data-qst=${this.questionId}>
         ${this.answer === null ? 
            `<input type="text" placeholder="Your answer here" class="input-field" >`:
            `<input type="text" placeholder="Your answer here" class="input-field" value=${this.answer}  >`
         }
         </div>
      `
      document.querySelector('.answer-side').innerHTML = html;

      const input_field = document.querySelector(".input-field");

      input_field.addEventListener('input',(e) => {
         let val = e.target.value;
         this.answer = val;
         
         // if(this.answer !== ''){
            answers.getAnswer({
               id: this.questionId,
               answer : this.answer,
               solving_id: this.solving_id,
               type: 'input'
            },this.number)
         // }
         // else{
         //    answers.getAnswer(null,this.number)
         // }
      });
      // if (this.answer == null) answers.getAnswer(null, this.number)
   }
}
const inputType = new InputType();

// inputType.getChoice()
