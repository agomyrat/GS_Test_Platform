class Matching {
   constructor() {
      this.choices = "";
      this.questionId = null;
      this.choiceLetters = ['a', 'b', 'c', 'd', 'e', 'f'];
      this.choiceNumbers = [1, 2, 3, 4, 5, 6];
      this.number = null;
      this.answer = [];
   }
   getChoice(questionNumber) {
      console.log(questionsClass.questions[questionNumber])
      this.choices = questionsClass.questions[questionNumber].choices;
      this.questionId = questionsClass.questions[questionNumber].id;
      this.secondSide = questionsClass.questions[questionNumber].answer;
      this.number = questionNumber;

      if (answers.answers[questionNumber] != undefined){
         console.log(answers.answers[questionNumber].answer)
         this.answer = answers.answers[questionNumber].answer;
         this.solving_id = answers.answers[questionNumber].solving_id;
         this.secondSide = this.answer
      }
      else this.answer = []

      const fir = this.choices.filter((choice, index) => index == 0 || index % 2 == 0)
      this.firstSide = fir
      console.log('sec',this.secondSide)

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
      this.firstSide.forEach((val, index) => {
         html1 += `
               <div class="blocks">
                  <span>
                     ${index+1}) ${val.value}
                  </span>
               </div>
      `
      })

      document.querySelector('.first-side').innerHTML = html1;

      /* Second Side */
      console.log('SEC',this.secondSide)
      let html2 = '';
      this.secondSide.forEach((val, index) => {
         html2 += `
               <div class="blocks right-block" >
                  <span>
                     ${val}
                  </span>
               </div>
      `
      })
      document.querySelector('.second-side').innerHTML = html2;


      ////DRAGGABLE
      const fir = document.querySelector('.first-side');
      const sec = document.querySelector('.second-side');
      const right_row = document.querySelectorAll('.right-block')
      const sortable = Sortable.create(sec, {
         animation: 200,
         ghostClass: 'myghostclass',
         dragClass: 'sortable-drag',
         onEnd: (e) => {
            let arr1 = fir.children;
            let arr2 = sec.children;
            let index = e.newIndex;
            
            // Get Answers
            let ans = []
            for(let i = 0 ; i < arr2.length ; i++){
               ans.push(arr2[i].innerText)
               this.secondSide = ans;
            }
            console.log()
            answers.getAnswer({
               id: this.questionId,
               answer: this.secondSide,
               type: 'matching',
               solving_id : this.solving_id
            }, this.number)
            console.log('SEC', this.secondSide)
            for (let x = 0; x < arr2.length; x++) {
               arr1[x].style.height = "auto";
               arr2[x].style.height = "auto";
            }
            for (let x = 0; x < arr2.length; x++) {
               if (arr2[x].clientHeight > arr1[x].clientHeight) {
                  arr1[x].style.height = arr2[x].clientHeight + "px"
               } else if (arr2[x].clientHeight < arr1[x].clientHeight) {
                  arr2[x].style.height = arr1[x].clientHeight + "px"
               }
            }
            arr1[index].style.height = arr2[index].clientHeight + "px"

         }
      })


      //Get values
      // const inputs = document.querySelectorAll(".number-matching-input");

      // for (let i = 0; i < inputs.length; i++) {
      //    inputs[i].addEventListener('input', (e) => {
      //       let value = e.target.value;
      //       let row = e.target.dataset.row
      //       this.answer[row] = value

      //       //Answers Objecta dakyas
      //       answers.getAnswer({
      //          id: this.questionId,
      //          answer: this.answer
      //       }, this.number)
      //       console.log(answers.answers)
      //    })
      // }
   }
}
const matching = new Matching();