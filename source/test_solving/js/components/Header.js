class Header {
   constructor() {
      
   }
   getData(questionNumber = 1) {
      this.questionNumber = questionNumber
      this.renderQuestionNumber()
   }
   renderQuestionNumber() {
      let html = '';
      html = `
         Question ${this.questionNumber}
      `
      document.querySelector('.question-number').innerHTML = html;
   }
}

const header = new Header()

// header.getData()