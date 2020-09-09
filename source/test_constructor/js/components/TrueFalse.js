class TrueFalse {
   constructor() {
      this.choices = null;
      this.questionId = null;
      this.number = null;
   }
   getChoice(questionNumber) {
      this.choices = questionsClass.questions[questionNumber].choices;
      this.questionId = questionsClass.questions[questionNumber].id;
      this.number = questionNumber
      this.answer = answers.answers[questionNumber]
      this.renderChoiceBlock()
   }
   renderChoiceBlock() {
      let html = '';      
      html += `
            <div class="true-false-block" data-qst=${this.questionId}></div>
      `
      document.querySelector('.answer-side').innerHTML = html;

      let tag = '';
      this.choices.forEach((choice) => {
         let isChecked = choice.isChecked ? 'checked' : '';
               tag += `
               <div>
                  <input type="checkbox" class="true-false-checkbox" data-row=${choice.id} ${isChecked}>
                  ${choice.value.toUpperCase()}
               </div>               
               `
      });
      document.querySelector('.true-false-block').innerHTML = tag


      const checkBoxes = document.querySelectorAll('.true-false-checkbox');
      for (let x = 0; x < checkBoxes.length; x++) {
         checkBoxes[x].addEventListener('click', (e) => {
            this.choices.forEach((val, index) => this.choices[index].isChecked = false);
            this.choices[x].isChecked = e.target.checked;
            this.answer = e.target.dataset.row
            answers.getAnswer({
               id: this.questionId,
               answer : this.answer,
               type: 'true-false'
            },this.number)
            console.log(answers.answers)
            // if()
            this.renderChoiceBlock()
         });
      }

   }
}
const trueFalse = new TrueFalse();

// trueFalse.getChoice()