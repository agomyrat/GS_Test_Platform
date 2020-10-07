class Input {
   constructor() {
      this.question = {}
   }
   renderDOM () {
      let html = '';
      html = `
         <div>
            <input class="input-form" placeholder="Answer" value="${this.question.answer}" >
         </div>
      `
      document.querySelector('.output').innerHTML = html;

      const inputForm = document.querySelector('.input-form');
      inputForm.addEventListener('input', (e) => {
         this.question.answer = e.target.value
         question.edited = true
      })
   }
}

const inputType = new Input()