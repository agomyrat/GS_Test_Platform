class Blank {
   constructor() {
      this.question = {};
      this.countBlank = 0;
   }

   renderDOM (row) {
      let html = '';
      html = `
            <div class = "example" >
            <h3 >Example : (You can create your question this way)</h3>
            <p>What [_is_] the [_capital_] city of the Azerbaijan ?</p>
            </div>
         `
      document.querySelector('.output').innerHTML = html

      // ADD new BLANK
      const add_blank = document.querySelector('#add-blank');
      add_blank.addEventListener('click', () => {

         let blank = ` [__] `;
         let qst = this.question.question;
         qst = qst.concat(blank)
         this.question.question = qst

         this.renderDOM()
         question.sectionRender(row)
         question.edited = true;
      })
   }

   decreaseBlankCount() {
      this.countBlank -= 1;
   }
   increaseBlankCount() {
      this.countBlank += 1;
   }
}

const blank = new Blank()