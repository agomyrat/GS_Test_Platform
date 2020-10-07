class TrueFalse {
   constructor() {
      this.choices = null;
      this.questionId = null;
      this.number = null;
      this.solving_id = null;

   }
   getChoice(questionNumber) {
      this.choices = questionsClass.questions[questionNumber].choices;
      console.log(this.choices)
      this.questionId = questionsClass.questions[questionNumber].id;
      if (answers.answers[questionNumber] != undefined) {
         this.solving_id = answers.answers[questionNumber].solving_id;
         this.answer = answers.answers[questionNumber].answer;
         this.choices.forEach((choice) => {
            if(choice.id === this.answer){
               choice.value = true;
            }
         })
      } else this.answer = ''

      this.number = questionNumber
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
            this.answer = e.target.dataset.row;

            let total = 0;
            this.choices.forEach((choice, index) => {
               if (this.choices[index].isChecked === false) {
                  total++
               }
            });
            console.log(total)
            if (total === this.choices.length) {
               this.answer = null;
            }

            answers.getAnswer({
               id: this.questionId,
               answer : this.answer,
               type: 'true-false',
               solving_id: this.solving_id,
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