class MultiChoice {
   constructor() {
      this.question = {};
      this.countMulti = 3;
      this.choiceLetter = ['a', 'b', 'c', 'd', 'e', 'f'];

   }
   renderDOM (){
      let html = '';
      this.question.choices.forEach((choice, index) => {
         let isChecked = choice.isChecked ? 'checked' : '';
         html += `
            <div class="form-group-sm choice-container" id=${this.choiceLetter[index]}>
               <input class="form-check-input checkBox" ${isChecked}  type="checkbox" value=${index+1}>
               ${this.choiceLetter[index]} )
               ${choice.type == 'string' 
                     ? `<input class="choice" placeholder="Choice ${this.choiceLetter[index]}" data-choice=${index} type="text" value=${choice.value} >`
                     : `<img src=${choice.path} class ="choice-image" data-row=${index} `}
               <div class="custom-file file-upload-block">
                  <input class="form-control-file file-upload" data-row=${index} accept="image/x-png,image/jpeg" value=${index+1} type="file" name="" id="file">
                  <label class="custom-file-label" for="file"><i id="file-img" class="far fa-image"></i></label>
               </div>
               <button class="remove-btn" data-row=${index} ><i class="fas fa-times"></i></button>
            </div>
         `
      });

      document.querySelector('.output').innerHTML = html;

      // Choice elements take all valueS of this.choiceLetter array
      this.question.choices.forEach((val, index) => {
         this.question.choices[index].id = this.choiceLetter[index]
      })

      // Removes choice
      let rmvBtn = document.querySelectorAll('.remove-btn');
      for (let x = 0; x < rmvBtn.length; x++) {
         rmvBtn[x].addEventListener('click', (e) => {
            if (rmvBtn.length > 3) {
               let newChoices = this.question.choices.filter((choice) => choice.id !== e.target.parentElement.parentElement.id);
               this.question.choices = newChoices;
               this.decreaseCount();
               this.renderDOM();
               question.edited = true
            }
            else {
               displayError("You can't remove more choice")
            }
         })
      }

      // Gives Input Form values to choices array
      const inputForm = document.querySelectorAll('.choice');
      for (let x = 0; x < inputForm.length; x++) {
         inputForm[x].addEventListener('input', (e) => {
            let data = e.target.dataset.choice;
            this.question.choices[data].value = e.target.value;
            question.edited  = true;
         })
      }

      // Changes input form to img tag
      const fileUpload = document.querySelectorAll('.file-upload');
      for (let j = 0; j < fileUpload.length; j++) {
         fileUpload[j].addEventListener('change', (e) => {
            const fileInputValue = e.target.files[0];
            let size = fileInputValue.size / 1024 / 1024;

            if (size < 2) {

               let data = e.target.dataset.row
               
               this.question.choices[data].type = "image";
               this.question.choices[data].path = URL.createObjectURL(fileInputValue)
               this.question.choices[data].value = ""
               this.renderDOM();
               question.edited  = true;
            }
            else {
               displayError('Your file muste be less than 2MB')
            }
         })
      }

      // To  answer the question ,[checkboxes]
      const checkBoxes = document.querySelectorAll(".checkBox");
      for (let z = 0; z < checkBoxes.length; z++) {
         checkBoxes[z].addEventListener('click', (e) => {
            
            this.question.choices[z].isChecked = e.target.checked;
            this.renderDOM();
            question.edited  = true;
         })
      }

   }
}

const multiChoice = new MultiChoice()