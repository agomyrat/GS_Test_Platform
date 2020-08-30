class Matching {
   constructor() {
      this.choices = "";
      this.questionId = null;
      this.choiceLetters = ['a', 'b', 'c', 'd', 'e', 'f'];
      this.choiceNumbers = [1,2,3,4,5,6];
      this.number = null;
      this.answer = [];
   }
   getChoice(questionNumber) {
      this.choices = questionsClass.questions[questionNumber].choices;
      this.questionId = questionsClass.questions[questionNumber].id;
      this.number = questionNumber;

      if (answers.answers[questionNumber] != undefined) this.answer = answers.answers[questionNumber].answer
      else this.answer = []

      const fir = this.choices.filter((choice ,index) => index == 0 || index % 2 == 0)
      this.firstSide = fir

      const sec = this.choices.filter((choice, index) => index % 2 !== 0)
      this.secondSide = sec


      this.renderChoiceBlock()
   }
   renderChoiceBlock() {
      // Creates choice side tag
      const answer_side = document.querySelector('.answer-side');
      answer_side.innerHTML = `
      <div class="matching-block">
         <div class="first-side"></div>
         <div class="second-side"></div>
      </div>`
      /* First Side */

      let html1 = '';
      this.firstSide.forEach((val,index) => {
         html1 += `
               <div class="blocks">
               ${this.answer[index] ? 
                  `<input type="number" max=${this.firstSide.length} min="1" value=${this.answer[index]} class="number-matching-input" id=${val.id} data-row=${index}>` 
                  :`<input type="number" max=${this.firstSide.length} min="1" class="number-matching-input" id=${val.id} data-row=${index}>`}
                  
                  <span>
                     ${this.choiceLetters[index]}) ${val.value}
                  </span>
               </div>
      `
      })
      
      document.querySelector('.first-side').innerHTML = html1;

      /* Second Side */
      let html2 = '';
      this.secondSide.forEach((val, index) => {
         html2 += `
               <div class="blocks" >
                  <span>
                     ${this.choiceNumbers[index]}) ${val.value}
                  </span>
               </div>
      `
      })
      document.querySelector('.second-side').innerHTML = html2;

      //Get values
      const inputs = document.querySelectorAll(".number-matching-input");

      for(let i = 0 ; i < inputs.length ; i++){
         inputs[i].addEventListener('input', (e) => {
            let value = e.target.value;
            let row = e.target.dataset.row
            this.answer[row] = value

            //Answers Objecta dakyas
            answers.getAnswer({
               id: this.questionId,
               answer : this.answer
            },this.number)
            console.log(answers.answers)
         })
      }
   }
}
const matching = new Matching();