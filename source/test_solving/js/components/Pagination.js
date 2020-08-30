/* Pagination Class */
class Pagination {
   constructor() {
      this.number = null;
      this.count = 1;
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
            activatePage(thisPage)
            this.count = Number(thisPage)
            console.log(this.count)

            // to render specific question
            let num = thisPage - 1        //number of question
            questionBlock.getQuestion(num)
            header.getData(thisPage)
            
            // singleChoice.getChoice(num)
            this.typeofQuestion(questionBlock.question.type, num)

            this.count == questionsClass.questions.length ? this.disableBtn('next') : this.activateBtn('next')
            this.count == 1 ? this.disableBtn('prev') : this.activateBtn('prev')

            opacityEffect()
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
         const qNumber = this.count - 1
         console.log(this.count)
         if (this.count > 1) {
            activatePage(qNumber)
            this.count -= 1
            // to render specific question
            let num = qNumber - 1 //number of question
            questionBlock.getQuestion(num)
            header.getData(qNumber)

            // singleChoice.getChoice(num)
            this.typeofQuestion(questionBlock.question.type, num)
            // this.activateBtn('next')
            this.activateBtn('prev')
            this.activateBtn('next')
         } else {
            this.disableBtn('prev')
         }
      })
      nextBtn.addEventListener('click', (e) => {
         const qNumber = this.count + 1
         console.log(this.count)
         if(this.count < questionsClass.questions.length){
            activatePage(qNumber)
            this.count += 1
            
            // to render specific question
            let num = qNumber - 1 //number of question
            questionBlock.getQuestion(num)
            header.getData(qNumber)

            // singleChoice.getChoice(num)
            this.typeofQuestion(questionBlock.question.type, num)
            this.activateBtn('next')
            this.activateBtn('prev')
            }
            else{
               this.disableBtn('next')
            }
            opacityEffect()

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

pagination.getNumberOfQuestion()
pagination.displayPagination()
pagination.goSpecificQuestion()
pagination.nextprevBtn()

window.onload = () => {
   pagination.typeofQuestion(questionsClass.questions[0].type,0)
   // alert('started')
}