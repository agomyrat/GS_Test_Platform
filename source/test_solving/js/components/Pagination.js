/* Pagination Class */
class Pagination {
   constructor() {
      this.number = null;
      this.count = 1;
      this.current = 0;
   }
   displayPagination() {
      // Creates pagination slider DOM
      const paginationSlider = document.querySelector('.pagination-slider');
      let html = '';

      for (let i = 0; i < this.number; i++) {
         html += `<span class="page" id="pg-${i+1}" data-row="${i+1}">${i+1}</span>`
      }

      paginationSlider.innerHTML = html;
      
   }

   // When Clicked, goes to that question
   goSpecificQuestion() {
      const paginationSpan = document.querySelectorAll('.page');
      for (let i = 0; i < paginationSpan.length; i++) {

         paginationSpan[i].addEventListener('click', (e) => {

            const thisPage = e.target.dataset.row
            this.currenQnumber = thisPage
            this.count = Number(thisPage)

            // to render specific question
            let num = thisPage - 1        //number of question
            questionBlock.getQuestion(num)
            header.getData(thisPage)
            this.typeofQuestion(questionBlock.question.type, num)

            // Animations
            this.count == questionsClass.questions.length ? this.disableBtn('next') : this.activateBtn('next')
            this.count == 1 ? this.disableBtn('prev') : this.activateBtn('prev')
            activatePage(thisPage)
            opacityEffect()

            // if(this.currenQnumber !== thisPage){
               answers.diplayAnswers(this.current);
            // }

            this.current = num

         })
      }
   }

   // Type of Question
   typeofQuestion(type, num){
      switch(type){
         case 'single-choice':
            return singleChoice.getChoice(num)
         case 'multi-choice':
            return multiChoice.getChoice(num)
         case 'input':
            return inputType.getChoice(num)
         case 'matching':
            return matching.getChoice(num)
         case 'true-false':
            return trueFalse.getChoice(num)
         case 'blank':
            return blank.getChoice(num)
      }
   }
   nextprevBtn() {
      const nextBtn = document.querySelector('.next-btn');
      const prevBtn = document.querySelector('.prev-btn');
      prevBtn.style.opacity = '0.5'


      prevBtn.addEventListener('click', (e) => {
         if (this.count !== 1) {

            const qNumber = this.count - 1
            activatePage(qNumber)
            this.count -= 1

            // to render specific question
            let num = qNumber - 1 //number of question
            questionBlock.getQuestion(num)
            header.getData(qNumber)
            
            answers.diplayAnswers(num + 1);
            this.current = num


            this.typeofQuestion(questionBlock.question.type, num)
            // this.activateBtn('next')
            this.activateBtn('prev')
            this.activateBtn('next')
            if(qNumber == 1){
               this.disableBtn('prev')
            }

         } else {
            this.disableBtn('prev')
         }
      })
      nextBtn.addEventListener('click', (e) => {

         if(this.count !== questionsClass.questions.length){

            const qNumber = this.count + 1
            activatePage(qNumber)
            this.count += 1
            
            // to render specific question
            let num = qNumber - 1 //number of question
            questionBlock.getQuestion(num)
            header.getData(qNumber)

            answers.diplayAnswers(num - 1);
            this.current = num


            this.typeofQuestion(questionBlock.question.type, num)
            this.activateBtn('next')
            this.activateBtn('prev')

            if (qNumber == questionsClass.questions.length ){
               this.disableBtn('next')
            }
         }
         else{
            this.disableBtn('next')
         }

      })
   }
   disableBtn(str) {
      document.querySelector(`.${str}-btn`).style.opacity = "0.5"
   }
   activateBtn(str){
      document.querySelector(`.${str}-btn`).style.opacity = "1"
   }
   getNumberOfQuestion() {
      this.number = questionsClass.questions.length;
   }
}

const pagination = new Pagination();
