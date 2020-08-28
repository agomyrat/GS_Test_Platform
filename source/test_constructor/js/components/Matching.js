class Matching {
   constructor() {
      this.question = {};
      this.countMatching = 4;
   }

   renderDOM () { 
      let html = '';
      for (let j = 0; j < this.question.choices.length / 2; j++) {
         let index = j * 2;
         let choice1 = this.question.choices[index];
         let choice2 = this.question.choices[index + 1];
         html += `
            <div class="matching-block" id="block-${j}">
               <input type="text" placeholder="First Match" class="first-match" data-m=${choice1.id}  value = ${choice1.value}    ><strong>-</strong>
               <input type="text" placeholder="Second Match" class="second-match" data-m=${choice2.id}  value = ${choice2.value}   >
               <button class="remove-btn" data-row=${j}><i class="fas fa-times"></i></button>
            </div>
         `
      };

      document.querySelector('.output').innerHTML = html;

      // Changes id s of choices
      this.question.choices.forEach((val, index) => {
         this.question.choices[index].id = index + 1
      })


      // Removes choice
      let rmvBtn = document.querySelectorAll('.remove-btn');
     
      for (let x = 0; x < rmvBtn.length; x++) {
         rmvBtn[x].addEventListener('click', (e) => {

            if (rmvBtn.length > 2) {
               let this_button = e.target.parentElement.dataset.row;
               const remove1 = Number(this_button) * 2 + 2;
               const remove2 = Number(this_button) * 2 + 1;

               let newChoices = this.question.choices.filter((choice) => choice.id !== remove1);
               let lastChoices = newChoices.filter((choice) => choice.id !== remove2);
               this.question.choices = lastChoices;

               this.decreaseMatchingCount();
               this.renderDOM();

               question.edited = true;

            }
            else if (rmvBtn.length == 2) displayError("You can't remove more matching choice");
         })
      }

      // Gives Input Form values to choices array
      const inputFormFirst = document.querySelectorAll('.first-match');
      for (let x = 0; x < inputFormFirst.length; x++) {
         inputFormFirst[x].addEventListener('input', (e) => {

            let data = Number(e.target.dataset.m) - 1;
            
            this.question.choices[data].value = e.target.value;
            question.edited = true;

         })
      }
      // Gives Input Form values to choices array
      const inputFormSecond = document.querySelectorAll('.second-match');
      for (let x = 0; x < inputFormSecond.length; x++) {
         inputFormSecond[x].addEventListener('input', (e) => {

            let data = Number(e.target.dataset.m) - 1;
            
            this.question.choices[data].value = e.target.value;
            question.edited = true;

         })
      }

   }

   decreaseMatchingCount() {
      this.countMatching -= 2
   }
   increaseMatchingCount() {
      this.countMatching += 1
   }
}

const matching = new Matching()

// Add matching rows
const add_matching = () => {
   const addMatching = document.getElementById('add-matching');
   addMatching.addEventListener('click', () => {
      if (matching.question.choices.length !== 12) {

         matching.increaseMatchingCount();

         matching.question.choices = [
            ...matching.question.choices,
            {
               id: matching.countMatching,
               value: ' ',
            },
            {
               id: matching.countMatching + 1,
               value: ' ',
            }
         ]

         matching.renderDOM()
         matching.increaseMatchingCount()
      }
      else alert('you cant add more choice')
   })
}