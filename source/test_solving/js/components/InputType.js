class InputType {
   constructor() {
      this.questionId = null
      this.answer = ''
      this.number = null;
   }
   getChoice(questionNumber) {
      this.questionId = questionsClass.questions[questionNumber].id;
      this.number = questionNumber;
      if(answers.answers[questionNumber] != undefined) this.answer = answers.answers[questionNumber].answer
      else this.answer = ''
      this.renderChoiceBlock()
   }
   renderChoiceBlock() {
      let html = '';
      html += `
         <div class = "input-block" data-qst=${this.questionId}>
            <input type="text" placeholder="Your answer here" class="input-field" value=${this.answer}  >
         </div>
      `
      document.querySelector('.answer-side').innerHTML = html;

      const input_field = document.querySelector(".input-field");

      input_field.addEventListener('input',(e) => {
         let val = e.target.value;
         this.answer = val;
         
         if(this.answer !== ''){
            answers.getAnswer({
               id: this.questionId,
               answer : this.answer
            },this.number)
         }
         else{
            answers.getAnswer(null,this.number)
         }
         console.log(answers.answers)
      });
      if (this.answer == null) answers.getAnswer(null, this.number)
   }
}
const inputType = new InputType();

// inputType.getChoice()
