class TrueFalse {
   constructor() {
      this.question = {}
   }
   renderDOM () {
      let html = '';
      this.question.choices.forEach((choice, index) => {
         let isChecked = choice.isChecked ? 'checked' : '';
         html += `
            <div class="true-false-block">
               <input class="true-false-check" value=${choice.id} ${isChecked} type="checkbox">
               ${choice.value.toUpperCase()}
            </div>
         `
      });

      document.querySelector('.output').innerHTML = html;

      const checkBoxes = document.querySelectorAll('.true-false-check');
      for (let x = 0; x < checkBoxes.length; x++) {
         checkBoxes[x].addEventListener('click', (e) => {
            this.question.choices.forEach((val, index) => this.question.choices[index].isChecked = false);
            this.question.choices[x].isChecked = e.target.checked;
            this.question.answer = e.target.value
            this.renderDOM()
            question.edited = true;
         });
      }

   }
}

const trueFalse = new TrueFalse()