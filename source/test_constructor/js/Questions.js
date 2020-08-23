
/// Questions Class
class Questions {
   constructor() {
      this.questions = [{
         id: 1,
         question: '',
         saved: false,
         isRandom : false,
         choices : [
            {
               id: this.count - 2,
               value: '',
               type: 'string',
               path: '',
               isChecked: true
            },
            {
               id: this.count - 1,
               value: '',
               type: 'string',
               path: '',
               isChecked: false
            },
            {
               id: this.count,
               value: '',
               type: 'string',
               path: '',
               isChecked: false
            }
         ],
         type: 'single-choice',
         answer : '',
         hasImage : false
      }];
      this.countQst = 1;
      this.choiceLetter = ['a', 'b', 'c', 'd', 'e', 'f'];
      // count for choices
      this.count = 3;
      this.countMulti = 3
      this.countMatching = 4;
      this.countBlank = 0;
      this.error = "";
      this.edited = false;
   }
   // Creates questions bar
   createQuestions() {
       this.questions.forEach((question, index) => {
         question.id = index + 1;
       })
      let html = ''
      this.questions.forEach((qst, index) => {
         html += `
            <div id="question" data-row=${index}>
               <h3>Question ${qst.id}</h3>
               <p>${qst.question}</p>
            </div>
         `
      });
      document.getElementById('questions').innerHTML = html;


      // To pass next or prev question
      const questions = document.querySelectorAll('#question');
      for (let x = 0; x < questions.length; x++) {
         questions[x].addEventListener('click', (e) => {
            if(this.edited != true){
               console.log('edited = false')
               this.sectionRender(x);
               this.singleChoiceType(x);
               
               for (let x = 0; x < questions.length; x++) {
                  questions[x].style.opacity = '0.5'
               };
               questions[x].style.opacity = '1';
               addNewQuestion(x)
               opacityEffect();
            }
            else{
               displayError('You need to save this question !')
            }
            })
      }
      // For rendering this.createQuestions
      this.sectionRender()
      addNewQuestion()

   }
   //Select Type of Question
   selectType(event,row) {
      switch (event) {
         case 'single-choice':
            this.uiSingleChoiceType(row);
            break;
         case 'input':
            this.uiInputType(row);
            break;
         case 'multi-choice':
            this.uiMultiChoiceType(row);
            break;
         case 'true-false':
            this.uiTrueFalseType(row);
            break;
         case 'matching':
            this.uiMathcingType(row);
            break;
         case 'blank':
            this.uiBlankType(row);
            break;
         default:
            console.log('def');
      }
   }

   /** UI for type of question */
   uiSingleChoiceType(row) {
      document.querySelector('.wrapper').innerHTML = `
      <p>Ans</p>
         <div class="output">
         </div>
      <button id="add-btn">+</button>
   `
      this.singleChoiceType(row)
      add_choice(row)
   }
   uiInputType(row) {
      document.querySelector('.wrapper').innerHTML = `
         <div class="output">
         </div>
      `
      this.inputType(row)
   }
   uiMultiChoiceType(row){
      document.querySelector('.wrapper').innerHTML = `
      <p>Ans</p>
         <div class="output">
         </div>
      <button id="add-btn" class="btn btn-primary">+</button>
   `
      this.multiChoiceType(row)
      add_choice(row)
   }
   uiTrueFalseType(row){
      document.querySelector('.wrapper').innerHTML = `
         <div class="output true-false-type">
         </div>
   `
      this.trueFalseType(row)
   }
   uiMathcingType(row){
      document.querySelector('.wrapper').innerHTML = `
      <p>Ans is front of them</p>
      
         <div class="output">
         </div>
         <button id="add-matching">+</button>
   `
      this.matchingType(row);
      add_matching(row);
   }
   uiBlankType(row){
      document.querySelector('.wrapper').innerHTML = `
      <div class="add-blank-block">
         <button id="add-blank" class="btn btn-primary">Add Blank</button>

      </div>
         <div class="output"></div>
   `
      this.blankType(row);
      // add_blank(row);
   }

   // Section Renderer   
   sectionRender(x = 0) {
      let a = ''
         if      (this.questions[x].type === 'single-choice') {
          a = `
            <select class="question-type">
               <option value="single-choice" selected > Single Choice </option>
               <option value="multi-choice" > Multi Choice </option>
               <option value="input" > Input </option>
               <option value="true-false"> True-False </option>
               <option value="matching">Matching</option>
               <option value="blank">Fill Blanks </option>
            </select>
          `
       } else if (this.questions[x].type === 'multi-choice') {
          a = `
            <select class="question-type">
               <option value="single-choice" > Single Choice </option>
               <option value="multi-choice" selected > Multi Choice </option>
               <option value="input" > Input </option>
               <option value="true-false"> True-False </option>
               <option value="matching">Matching</option>
               <option value="blank">Fill Blanks </option>
            </select>
          `
       } else if (this.questions[x].type === 'input') {
          a = `
            <select class="question-type">
               <option value="single-choice" > Single Choice </option>
               <option value="multi-choice"  > Multi Choice </option>
               <option value="input" selected> Input </option>
               <option value="true-false"> True-False </option>
               <option value="blank">Fill Blanks </option>
            </select>
          `
       } else if (this.questions[x].type === 'true-false') {
          a = `
            <select class="question-type">
               <option value="single-choice" > Single Choice </option>
               <option value="multi-choice"  > Multi Choice </option>
               <option value="input" > Input </option>
               <option value="true-false" selected> True-False </option>
               <option value="matching">Matching</option>
               <option value="blank">Fill Blanks </option>
            </select>
          `
       } else if (this.questions[x].type === 'matching') {
          a = `
            <select class="question-type">
               <option value="single-choice" > Single Choice </option>
               <option value="multi-choice"  > Multi Choice </option>
               <option value="input" > Input </option>
               <option value="true-false" > True-False </option>
               <option value="matching" selected>Matching</option>
               <option value="blank">Fill Blanks </option>
            </select>
          `
       } else if (this.questions[x].type === 'blank') {
          a = `
            <select class="question-type">
               <option value="single-choice" > Single Choice </option>
               <option value="multi-choice"  > Multi Choice </option>
               <option value="input" > Input </option>
               <option value="true-false" > True-False </option>
               <option value="matching" >Matching</option>
               <option value="blank" selected >Fill Blanks </option>
            </select>
          `
       }
      let isChecked = this.questions[x].isRandom ? 'checked' : '';
      document.querySelector('header').innerHTML =
         `<div class="question-block">
            <nav>
               <div class="nav1">
                  <h1>Question ${this.questions[x].id} </h1>
               </div>
               <div div class="nav2">
                  <a href="#" class="leave-test">Leave Test</a>
                  <button class="finish-test-btn">Finish Test</button>
               </div>
            </nav>
            <div class="question-create-block" data-row="${this.questions[x].id}">
               <div class="question-input-field">
                  <textarea class="question-field" placeholder="Question here"  data-row=${this.questions[x].id} rows = "1">${this.questions[x].question}</textarea>
                   <div class="custom-file-question">
                     <input type="file" accept="image/*" class="question-file" id="file-question-${x}">
                     <label for="file-question-${x}"><i class="far fa-image"></i></label>
                  </div>
                  ${this.questions[x].hasImage == true 
                        ? `<img src=${this.questions[x].path} class ="question-image" >
                        <button class="remove-file-btn" data-row=${x} ><i class="fas fa-times"></i></button>`
                        : ``}
               </div>
               <div class="question-parameters">
               ${this.questions[x].type == "single-choice" || this.questions[x].type =="multi-choice" ? 
                  `<div class="random-place">
                     <input type="checkbox" class="random" ${isChecked}> isRandom</div>`: ``
                  }
                  <div class="question-type-select">
                  <label>Type of question:</label>
                     ${a}
                  </div>
               </div>
            </div>
         </div>
         <footer>
            <button class="delete-qst-btn" data-row=${x}> Delete </button>
            <button class="save-btn" data-row=${x}> Save </button>
         </footer>
         `;
      
      // to Render type of question
      this.selectType(this.questions[x].type,x)

      const textarea = document.querySelector('.question-field');
      textarea.addEventListener('input', (e) => {
         this.questions[x].question = e.target.value.trim();
         this.edited = true
         if (this.questions[x].type == 'blank') {
            const splited = this.questions[x].question.split(' ')
            const filtered = splited
               .filter((str) => str.startsWith('[_') && str.endsWith('_]'))
               .map((ans) => ans.slice(2, ans.length - 2))
            const newAnswers = filtered.filter((val) => val !== "")
            this.questions[x].answers = newAnswers
            console.log(this.questions[x]);
            this.edited = true
         }
      })

      // image upload
      const fileUpload = document.querySelector('.question-file');
      fileUpload.addEventListener('change', (e) => {
            const fileInputValue = e.target.files[0];
            console.log(fileInputValue)
            this.questions[x].path = URL.createObjectURL(fileInputValue)
            this.questions[x].pathValue = fileInputValue; 
            this.questions[x].hasImage = true;
            this.sectionRender(x)
            this.questions[x].hasImage = true
            this.edited = true
      })

      //Remove File
      if(this.questions[x].hasImage == true){
         const removeFileBtn = document.querySelector('.remove-file-btn');
         removeFileBtn.addEventListener('click', (e) => {
            const thisQuestion = this.questions[x];
            thisQuestion.path = "",
            thisQuestion.pathValue = "",
            thisQuestion.hasImage = false
            console.log(thisQuestion)
            this.sectionRender(x)
            this.edited = true
         })
      }
      

      // Checkbox
      if (this.questions[x].type == "single-choice" || this.questions[x].type == "multi-choice"){
         const checkbox = document.querySelector('.random');
         checkbox.addEventListener('click' ,(e) => {
            this.questions[x].isRandom = e.target.checked;
            this.edited = true
         }) 
      }

      //Type of question
      const questionType = document.querySelector('.question-type');
      questionType.addEventListener('change', (e) => {
         const typeSelect = e.target.value;
         
         if(typeSelect == 'input'){
            this.questions[x] = {
               id : x+1 ,
               answer: '',
               question : '',
               saved: false,
               type: 'input',
               hasImage: false
            }
            this.questions[x].type = typeSelect;
         }
         else if(typeSelect == 'single-choice'){
            this.questions[x] = 
            {
               id: x + 1,
               question: ' ',
               saved: false,
               isRandom: false,
               hasImage: false,
               choices: [{
                     id: this.count - 2,
                     value: '',
                     type: 'string',
                     path: '',
                     isChecked: true
                  },
                  {
                     id: this.count - 1,
                     value: '',
                     type: 'string',
                     path: '',
                     isChecked: false
                  },
                  {
                     id: this.count,
                     value: '',
                     type: 'string',
                     path: '',
                     isChecked: false
                  }
               ],
               type: 'single-choice',
               answer: ''
            }
            this.questions[x].type = typeSelect;
         }
         else if (typeSelect == 'multi-choice') {
            this.questions[x] = {
               id: x + 1,
               question: ' ',
               saved: false,
               isRandom: false,
               hasImage: false,
               choices: [{
                     id: this.count - 2,
                     value: '',
                     type: 'string',
                     path: '',
                     isChecked: true
                  },
                  {
                     id: this.count - 1,
                     value: '',
                     type: 'string',
                     path: '',
                     isChecked: false
                  },
                  {
                     id: this.count,
                     value: '',
                     type: 'string',
                     path: '',
                     isChecked: false
                  }
               ],
               type: 'multi-choice',
               answer: []
            }
            this.questions[x].type = typeSelect;
         }
         else if (typeSelect == 'true-false'){
            this.questions[x] = {
                  id: x + 1,
                  question: '',
                  saved: false,
                  type: 'true-false',
                  answer: 1,
                  hasImage: false,
                  choices: [{
                        id: 1,
                        value: 'true',
                        isChecked : true
                     },
                     {
                        id: 2,
                        value: 'false',
                        isChecked: false
                     }
                  ]
            }
            this.questions[x].type = typeSelect;
         }
         else if (typeSelect == 'matching') {
            this.questions[x] = {
               id: x + 1,
               question: '',
               saved: false,
               hasImage: false,
               choices: [{
                     id: this.countMatching - 3,
                     value: '',
                  },
                  {
                     id: this.countMatching - 2,
                     value: '',
                  },
                  {
                     id: this.countMatching - 1,
                     value: '',
                  },
                  {
                     id: this.countMatching ,
                     value: '',
                  }
               ],
               type: 'matching',
               answer: []
            }
            this.questions[x].type = typeSelect;
         }
         else if (typeSelect == 'blank') {
            this.questions[x] = {
               id: x + 1,
               question: '',
               hasImage: false,
               answers : []
            }
            this.questions[x].type = typeSelect;
         }
         this.sectionRender(x);
         init()
         this.edited = true
      })


      // Delete Question
      const deleteBtn = document.querySelector('.delete-qst-btn');
      if(this.questions.length > 1){
         deleteBtn.addEventListener('click', (e) => {
            let currentQstId = Number(e.target.dataset.row) + 1;
            console.log(currentQstId)
//-------------------------------------------------------------
            $.ajax({
               url:'../test/deleteQuestion',
               type:'post',
               data: {questionId : currentQstId},
               success: function(data){
                  console.log(data);
               },
               error: function(data){
                  console.log(data, 'error boldy');
               }
            })
//--------------------------------------------------------------
            const newQuestions = this.questions.filter((question) => question.id != currentQstId)
            this.questions = newQuestions
            questionsClass.countQst -= 1;
            this.createQuestions()
            this.sectionRender()
            console.log(this.questions)
         })
      }else{
         deleteBtn.style.display = "none"
      }
      

         const saveButton = document.querySelector('.save-btn');
      // Saves question ,so you can create new question
         saveButton.addEventListener('click', (e) => {
            let validateQ = false
            let validateAns = false
            let countAns = 0;
            if (this.questions[x].question !== "") validateQ = true;
            if (this.questions[x].hasImage == true) validateQ = true
            console.log(validateQ)
            if (this.questions[x].type == 'single-choice' || this.questions[x].type == 'multi-choice' || this.questions[x].type == 'matching') {
               for (let k = 0; k < this.questions[x].choices.length; k++) {
                  console.log(this.questions[x].choices[0].value)
                  if (this.questions[x].choices[k].type != "image"){
                     if (this.questions[x].choices[k].value != '' ) {
                        countAns += 1;
                     }
                  }
                  else{
                     countAns +=1 
                  }     
               }
               if (countAns == this.questions[x].choices.length) {
                  validateAns = true
               }
            } 
            else if (this.questions[x].type == 'input') {
               if(this.questions[x].answer !== ""){
                  validateAns = true
               }
            }
            else if(this.questions[x].type == 'blank' || 'true-false'){
               validateAns = true
            }
            if (validateAns && validateQ) {
               this.questions[x].saved = true
               if(this.questions[x].type == 'single-choice'){
                  this.questions[x].choices.forEach((choice) =>  { 
                     if (choice.isChecked == true) {
                        this.questions[x].answer = choice.id
                     }
                  }) 
               }
               else if (this.questions[x].type == 'multi-choice') {
                  this.questions[x].answer = []
                  this.questions[x].choices.forEach((choice) => {
                     if (choice.isChecked == true) {
                        this.questions[x].answer.push(choice.id)
                     }
                  })
               }
               let formData = new FormData();
               if (this.questions[x].pathValue) {
                     formData.append("qFile-0", this.questions[x].pathValue , JSON.stringify({
                     id: this.questions[x].id,
                     type: this.questions[x].fileType
                  }));
               }
               let choiceType = this.questions[x].type == 'single-choice' || this.questions[x].type == 'multi-choice'
               if(choiceType){
                  for(let f=0; f < this.questions[x].choices.length ; f++){
                     if (this.questions[x].choices[f].pathValue){
                        console.log('answerfiles add')
                        formData.append("file-"+f, this.questions[x].choices[f].pathValue, JSON.stringify({
                           id: this.questions[x].choices[f].id,
                           type: this.questions[x].choices[f].type
                        }));
                     }
                  }
               }
               let data = ""
               if (this.questions[x].type == "single-choice" || this.questions[x].type == "multi-choice") {
                  data = {
                     question: this.questions[x].question,
                     choices: this.questions[x].choices,
                     answer: this.questions[x].answer,
                     type: this.questions[x].type,
                     hasImage : this.questions[x].hasImage,
                     id: this.questions[x].id,
                     isRandom: this.questions[x].isRandom,
                  };
               }
               if(this.questions[x].type == "input"){
                  data = {
                     answer: this.questions[x].answer,
                     question: this.questions[x].question,
                     type: this.questions[x].type,
                     hasImage: this.questions[x].hasImage,
                     id: this.questions[x].id,
                  }
               }
               if (this.questions[x].type == "true-false" || this.questions[x].type == "matching") {
                  data = {
                     answer: this.questions[x].answer,
                     question: this.questions[x].question,
                     type: this.questions[x].type,
                     hasImage: this.questions[x].hasImage,
                     id: this.questions[x].id,
                     choices: this.questions[x].choices
                  }
               }
               if(this.questions[x].type == "blank"){
                  data = {
                     question: this.questions[x].question,
                     type: this.questions[x].type,
                     hasImage: this.questions[x].hasImage,
                     id: this.questions[x].id,
                     answer: this.questions[x].answers
                  }
               }
               formData.append("data", JSON.stringify(data));
//-------------------------------------------------------------------------------
               $.ajax({
                  url:'http://localhost/TestPlatform/GS_Test_Platform/test/saveQuestion',
                  type:'post',
                  processData: false,
                  contentType: false,
                  data: formData,
                  success: function(data){
                     console.log(JSON.parse(data));
                  },
                  error: function(data){
                     console.log(data, 'error boldy');
                  }
               })
//-----------------------------------------------------------------------------
               console.log(formData)
               console.log(this.questions)
               addNewQuestion()
               this.count = 3
               this.countBlank = 0
               this.edited = false
               notify("Saved")
         }
         else {
            displayError('Please create your question correctly')
         }
         })
      
      // else {
      //    console.log('edited = true')
      //    displayError('You need to save your question ! ')
      // }
   }

   /*  SINGLE CHOICE TYPE   */
   singleChoiceType(p = 0) {
      let html = '';
      if (this.questions[p].type == 'single-choice') {
         this.questions[p].choices.forEach((choice, index) => {
            let isChecked = choice.isChecked ? 'checked' : '';
            html += `
               <div class="choice-container" id=${this.choiceLetter[index]}>
                  <input class="checkBox" ${isChecked}  type="checkbox" value=${index+1}>
                  ${this.choiceLetter[index]} )
                  ${choice.type == 'string' 
                        ? `<input class="choice"  placeholder="Choice ${this.choiceLetter[index]}" data-choice=${index} type="text" value=${choice.value} >`
                        : `<img src=${choice.path} class ="choice-image" data-row=${index} >`}

                  <div class="custom-file" data-row=${index}>
                     <input type="file" id="file-choice-${index}" accept="image/*" class="file-upload" data-row=${index} value=${choice.path}>
                     <label for="file-choice-${index}"><i class="far fa-image"></i></label>
                  </div>
                  <button class="remove-btn" data-row=${index} ><i class="fas fa-times"></i></button>
               </div>
            `
         });
      
      document.querySelector('.output').innerHTML = html ;

      // Choice elements take all valueS of this.choiceLetter array
      this.questions[p].choices.forEach((val, index) => {
         this.questions[p].choices[index].id = this.choiceLetter[index]
      })

      // Removes choice
      let rmvBtn = document.querySelectorAll('.remove-btn');
      for (let x = 0; x < rmvBtn.length; x++) {
         rmvBtn[x].addEventListener('click', (e) => {
            if (rmvBtn.length > 2) {
               let thisElement = this.choiceLetter[x]
               let newChoices = this.questions[p].choices.filter((choice) => choice.id !== thisElement);
               this.questions[p].choices = newChoices;
               this.decreaseCount();
               this.singleChoiceType(p);
               this.edited = true
            }
            else{
               displayError("You can't remove more choice")
            }
         })
      }

      // Gives Input Form values to choices array
      const inputForm = document.querySelectorAll('.choice');
      for (let x = 0; x < inputForm.length; x++) {
         inputForm[x].addEventListener('input', (e) => {
            let data = e.target.dataset.choice;
            this.questions[p].choices[data].value = e.target.value;
            this.edited = true
         })
      }

      // Changes input form to img tag
      const fileUpload = document.querySelectorAll('.file-upload');
      for (let j = 0; j < fileUpload.length; j++) {
         fileUpload[j].addEventListener('change', (e) => {
            const fileInputValue = e.target.files[0];
            let data = e.target.parentElement.dataset.row
            this.questions[p].choices[j].type = "image";
            this.questions[p].choices[j].path = URL.createObjectURL(fileInputValue);
            this.questions[p].choices[j].pathValue = fileInputValue;
            this.questions[p].choices[j].value = "";
            this.singleChoiceType(p)
            this.edited = true
         })
      }
      
      // if(this.questions[p].choices[])

      // To  answer the question ,[checkboxes]
      const checkBoxes = document.querySelectorAll(".checkBox");
      for (let z = 0; z < checkBoxes.length; z++) {
         checkBoxes[z].addEventListener('click', (e) => {
            this.questions[p].choices.forEach((val, index) => this.questions[p].choices[index].isChecked = false);
            this.questions[p].choices[z].isChecked = e.target.checked;
            this.singleChoiceType(p)
            this.edited = true
         })
      }

   }
   }

   /*  INPUT TYPE   */
   inputType(p){
      if (this.questions[p].type == 'input') {
      let html = '';
         html = `
            <div>
               <input class="input-form" placeholder="Answer" value=${this.questions[p].answer}>
            </div>
         `
         document.querySelector('.output').innerHTML = html;

         const inputForm = document.querySelector('.input-form');
         inputForm.addEventListener('input', (e) => {
            this.questions[p].answer = e.target.value
            this.edited = true
         })
      }
   }

   /* MULTI CHOICE TYPE  */
   multiChoiceType(p){
      let html = '';
      if (this.questions[p].type == 'multi-choice') {
         this.questions[p].choices.forEach((choice, index) => {
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
         this.questions[p].choices.forEach((val, index) => {
            this.questions[p].choices[index].id = this.choiceLetter[index]
         })

         // Removes choice
         let rmvBtn = document.querySelectorAll('.remove-btn');
         for (let x = 0; x < rmvBtn.length; x++) {
            rmvBtn[x].addEventListener('click', (e) => {
               if (rmvBtn.length > 3) {
                  let newChoices = this.questions[p].choices.filter((choice) => choice.id !== e.target.parentElement.parentElement.id);
                  this.questions[p].choices = newChoices;
                  this.decreaseCount();
                  this.multiChoiceType(p);
                  this.edited = true
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
               this.questions[p].choices[data].value = e.target.value;
               this.edited  = true;
            })
         }

         // Changes input form to img tag
         const fileUpload = document.querySelectorAll('.file-upload');
         for (let j = 0; j < fileUpload.length; j++) {
            fileUpload[j].addEventListener('change', (e) => {
               const fileInputValue = e.target.files[0];
               let data = e.target.dataset.row
               console.log(fileInputValue)
               console.log(data)
               this.questions[p].choices[data].type = "image";
               this.questions[p].choices[data].path = URL.createObjectURL(fileInputValue)
               this.questions[p].choices[data].value = ""
               this.multiChoiceType(p)
               this.edited  = true;
            })
         }

         // To  answer the question ,[checkboxes]
         const checkBoxes = document.querySelectorAll(".checkBox");
         for (let z = 0; z < checkBoxes.length; z++) {
            checkBoxes[z].addEventListener('click', (e) => {
               // this.questions[p].choices.forEach((val, index) => this.questions[p].choices[index].isChecked = false);
               this.questions[p].choices[z].isChecked = e.target.checked;
               this.multiChoiceType(p)
               this.edited  = true;
            })
         }

      }
   }

   /* TRUE FALSE TYPE */
   trueFalseType(p) {
      if (this.questions[p].type == 'true-false') {
         let html = '';
         this.questions[p].choices.forEach((choice,index) => {
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
         for ( let x = 0; x < checkBoxes.length ; x++) {
            checkBoxes[x].addEventListener('click', (e) => {
               this.questions[p].choices.forEach((val, index) => this.questions[p].choices[index].isChecked = false);
               this.questions[p].choices[x].isChecked = e.target.checked;
               this.questions[p].answer = e.target.value
               this.trueFalseType(p)
               this.edited  = true;
            });
         }

      }
   }

   /* MATCHING TYPE  */
   matchingType(p){
      if (this.questions[p].type == 'matching') {
         let html = '';
         for(let j = 0; j < this.questions[p].choices.length / 2 ; j++ ) {
            let index = j * 2;
            let choice1 = this.questions[p].choices[index];
            let choice2 = this.questions[p].choices[index + 1];
            html += `
               <div class="matching-block" id="block-${j}">
                  <input type="text" placeholder="First Match" class="first-match" data-input=${choice1.id} value = ${choice1.value}    ><strong>-</strong>
                  <input type="text" placeholder="Second Match" class="second-match" data-input=${choice2.id} value = ${choice2.value}   >
                  <button class="remove-btn" data-row=${j}><i class="fas fa-times"></i></button>
               </div>
            `
         };

         document.querySelector('.output').innerHTML = html;

         // Changes id s of choices
         this.questions[p].choices.forEach((val, index) => {
            this.questions[p].choices[index].id = index + 1
         })
         

         // Removes choice
         let rmvBtn = document.querySelectorAll('.remove-btn');
         console.log(rmvBtn)
         for (let x = 0; x < rmvBtn.length; x++) {
            rmvBtn[x].addEventListener('click', (e) => {
               console.log(rmvBtn.length)
               if(rmvBtn.length > 2){
                  let this_button = e.target.parentElement.dataset.row;
                  const remove1 = Number(this_button) * 2 + 2;
                  const remove2 = Number(this_button) * 2 + 1;
                  console.log(remove1)
                  console.log(remove2)
                  let newChoices = this.questions[p].choices.filter((choice) => choice.id !== remove1);
                  let lastChoices = newChoices.filter((choice) => choice.id !== remove2);
                  this.questions[p].choices = lastChoices;
                  this.decreaseMatchingCount();
                  this.matchingType(p);
                  this.edited  = true;
               }
               else if(rmvBtn.length == 2){
                  displayError("You can't remove more matching choice");
               }
            })
         }

         // Gives Input Form values to choices array
         const inputFormFirst = document.querySelectorAll('.first-match');
         for (let x = 0; x < inputFormFirst.length; x++) {
            inputFormFirst[x].addEventListener('input', (e) => {
               let data = e.target.dataset.input - 1;
               this.questions[p].choices[data].value = e.target.value;
               this.edited  = true;
            })
         }
         // Gives Input Form values to choices array
         const inputFormSecond = document.querySelectorAll('.second-match');
         for (let x = 0; x < inputFormSecond.length; x++) {
            inputFormSecond[x].addEventListener('input', (e) => {
               let data = e.target.dataset.input - 1;
               this.questions[p].choices[data].value = e.target.value;
               this.edited  = true;
            })
         }
         
      }
   }

   /**  BLANK TYPE  */
   blankType(p) {
      if(this.questions[p].type == 'blank'){
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
            let qst = this.questions[p].question;
            qst = qst.concat(blank)
            this.questions[p].question = qst
            this.blankType(p)
            this.sectionRender(p)   
            this.edited  = true;
         })


         // //Remove BLANK
         // const rmv_blank = document.querySelectorAll('.remove-blank');
         // for(let r = 0 ; r < rmv_blank.length ; r++ ){
         //    rmv_blank[r].addEventListener('click', (e) => {
         //       let data_row = e.target.dataset.row;
         //       let newArr = this.questions[p].answers.filter((answer) => answer.id !==  Number(data_row));
         //       this.questions[p].answers = newArr;
         //       let qst = this.questions[p].question;
         //       let empty_text = "";
         //       qst
         //          .split("[__BLANK__]")
         //          .forEach(
         //             (value, index) =>
         //                (empty_text +=
         //                   index == data_row || index == 0 ? value : "[__BLANK__]" + value)
         //          );
         //       console.log(empty_text)
         //       this.questions[p].question = empty_text;
         //       this.decreaseBlankCount();
         //       this.blankType(p);
         //       this.sectionRender(p)
         //       console.log(this.countBlank);
         //    })
         // }
      }
   }

   //These are to control number of choices
   increaseCount() {
      this.count += 1;
   }
   decreaseCount() {
      this.count -= 1;
   }
   decreaseMatchingCount() {
      this.countMatching -= 2
   }
   increaseMatchingCount() {
      this.countMatching += 1
   }
   decreaseBlankCount(){
      this.countBlank -= 1;
   }
   increaseBlankCount(){
      this.countBlank += 1;
   }
}

const questionsClass = new Questions();

/* SINGLE, MULTIPLE CHOICE TYPE  */
//Add new Choice block to single and multiple choice UI
const add_choice = (row) => {
   const addBtn = document.getElementById('add-btn');
   addBtn.addEventListener('click', () => {
      if (questionsClass.count <= 5 && questionsClass.questions[row].choices.length !== 6) {
         questionsClass.questions[row].choices = [
            ...questionsClass.questions[row].choices,
            {
               id: questionsClass.choiceLetter[questionsClass.count],
               value: '',
               type: 'string',
               path: '',
               isChecked: false
            }
         ]
         if (questionsClass.questions[row].type === 'single-choice'){
            questionsClass.singleChoiceType(row)
         }
         else if (questionsClass.questions[row].type === 'multi-choice'){
            questionsClass.multiChoiceType(row)
         }
         addBtn.style.opacity = "1"
      }
      else {
         alert('you cant add more choice')
         console.log(questionsClass.count)
      }
   })
}
/***/

const add_matching = (row) => {
   const addMatching = document.getElementById('add-matching');
   addMatching.addEventListener('click', () => {
      if (questionsClass.questions[row].choices.length !== 12) {
         questionsClass.increaseMatchingCount();
         questionsClass.questions[row].choices = [
            ...questionsClass.questions[row].choices,
            {
               id: questionsClass.countMatching,
               value: ' ',
            },
            {
               id: questionsClass.countMatching + 1,
               value: ' ',
            }
         ]
         questionsClass.matchingType(row)
         questionsClass.increaseMatchingCount()
      } else {
         alert('you cant add more choice')
      }
   })
}  

function newQuestion() {
   // If last question saved ,you can craeate new one
   if (questionsClass.questions[questionsClass.questions.length - 1].saved) {
      questionsClass.countQst += 1;
      questionsClass.questions = [
         ...questionsClass.questions,
         {
            id: questionsClass.countQst,
            question: ' ',
            saved: false,
            isRandom: false,
            choices: [{
               id: questionsClass.count - 2,
               value: '',
               type: 'string',
               path: '',
               isChecked: true
            }, {
               id: questionsClass.count - 1,
               value: '',
               type: 'string',
               path: '',
               isChecked: false
            }, {
               id: questionsClass.count,
               value: '',
               type: 'string',
               path: '',
               isChecked: false
            }],
            type: 'single-choice',
            answer: ''
         }
      ]
      console.log(questionsClass)
      questionsClass.createQuestions();
      questionsClass.sectionRender(questionsClass.questions.length - 1);
      questionsClass.singleChoiceType(questionsClass.questions.length - 1)
      document.querySelectorAll('#question')[questionsClass.questions.length - 1].style.opacity = '1'
      document.querySelectorAll('#question')[0].style.opacity = '0.5'
      opacityEffect()
   }
}
// Add New Quesiton
const addNewQuestion = () => {
   const addBtn = document.getElementById('add-question-btn');
   addBtn.addEventListener('click', newQuestion)
}

/* Page Load Functions */
const onloadFunction = () => {
   questionsClass.createQuestions();
   document.querySelectorAll('#question')[0].style.opacity = '1'
}
window.onload = onloadFunction()


// navigator.onLine ? alert('ONLINE') : alert('you are offline');