class QuestionBlock {
   constructor() {
      this.question = {}
   }
   getQuestion(questionNumber = 0) {
      this.question.id = questionsClass.questions[questionNumber].id
      this.question.question = questionsClass.questions[questionNumber].question;
      this.question.path = questionsClass.questions[questionNumber].path;
      this.question.hasImage = questionsClass.questions[questionNumber].hasImage
      this.question.type = questionsClass.questions[questionNumber].type
      this.renderQuestionBlock()
   }
   renderQuestionBlock() {
      let html = '';
      html = `
         <div class="question-side" id="question-${this.question.id}">
            <article>
               ${this.question.type !== "blank" ? `${this.question.question}` : ``}
            </article>
         </div>
      `
      document.querySelector('.render-question').innerHTML = html;
      //Hachanda image bar bolsa shul funksiyany ishledya
      if(this.question.hasImage) this.renderQuestionImage()
   }
   renderQuestionImage() {
      let html = '';
      html = `
         <div class="question-image-place">
            ${this.question.path ? `<img src="../../uploads/${this.question.path}" class="question-image" alt="">` : ``}
         </div>
      `
      document.querySelector('.question-side').innerHTML += html
   }
}

const questionBlock = new QuestionBlock()
// Questiony almak ucin
// questionBlock.getQuestion()