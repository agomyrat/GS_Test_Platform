class MultiChoice {
   constructor() {
      this.choices = "";
      this.questionId = null
      this.choiceLetters = ['a', 'b', 'c', 'd', 'e', 'f'];
      this.number = null;
      this.answer = null;
   }
   getChoice(questionNumber) {
      this.choices = questionsClass.questions[questionNumber].choices;
      // this.choices.forEach((choice) => choice.isChecked = false)
      this.questionId = questionsClass.questions[questionNumber].id;
      this.number = questionNumber
      this.renderChoiceBlock()
   }
   renderChoiceBlock() {
      let html = '';
      this.choices.forEach((choice, index) => {
         let isChecked = choice.isChecked ? 'checked' : '';
         html += `
            <div class="choice" id="choice-${choice.id}">
               <span>
                  <input type="checkbox" class="multiple-checkbox" ${isChecked} data-row=${choice.id} >
               </span>
               <span>${this.choiceLetters[index]}) </span>
               <div class="question">
                  ${choice.value}
               </div>
            </div>
      `
      })
      // Creates choice side tag
      const answer_side = document.querySelector('.answer-side');
      answer_side.innerHTML = `<div class="choice-side"></div>`

      document.querySelector('.choice-side').innerHTML = html;

       // To  answer the question ,[checkboxes]
      const checkBoxes = document.querySelectorAll(".multiple-checkbox");
      for (let z = 0; z < checkBoxes.length; z++) {
         checkBoxes[z].addEventListener('click', (e) => {
            // const choiceId = e.target.dataset.row;
            // this.answers.push(choiceId)
            this.choices[z].isChecked = e.target.checked;
            this.answer = []
            this.choices.forEach((choice) => {
               if (choice.isChecked) {
                  this.answer.push(choice.id)
               }
            })
            let n = 0
            this.choices.forEach((choice) => {
               if (choice.isChecked == false) {
                  n += 1
               }
            })
            answers.getAnswer({
               id: this.questionId,
               answer: this.answer,
               type: 'multi-choice'
            }, this.number)
            if (n == this.choices.length) {
               answers.getAnswer(null, this.number)
            }
            this.renderChoiceBlock()
            console.log(answers.answers)
         })
      }
      // if(this.answer == []) answers.getAnswer(null, this.number)
   }
}
const multiChoice = new MultiChoice();

// multiChoice.getChoice()
