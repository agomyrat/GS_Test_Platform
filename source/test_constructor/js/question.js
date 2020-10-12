class Question {
   constructor() {
      this.error = "";
      this.edited = false;
      this.deletedQuestionFile = []
      this.deletedChoiceFiles = []
   }
   //Select Type of Question
   selectType(event, row) {
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
            break
      }
   }


   uiSingleChoiceType(row) {
      document.querySelector('.wrapper').innerHTML = `
   <p>Ans</p>
   <div class="output">
   </div>
   <button id="add-btn">+</button>
   `
      singleChoice.question = main.questions[row];
      singleChoice.renderDOM()
      add_choice(row)
   }
   uiInputType(row) {
      document.querySelector('.wrapper').innerHTML = `
   <div class="output">
   </div>
   `
      inputType.question = main.questions[row];
      inputType.renderDOM()
   }
   uiMultiChoiceType(row) {
      document.querySelector('.wrapper').innerHTML = `
   <p>Ans</p>
   <div class="output">
   </div>
   <button id="add-btn" class="btn btn-primary">+</button>
   `
      multiChoice.question = main.questions[row];
      multiChoice.renderDOM()
      add_choice(row)
   }
   uiTrueFalseType(row) {
      document.querySelector('.wrapper').innerHTML = `
   <div class="output true-false-type">
   </div>
   `
      trueFalse.question = main.questions[row];
      trueFalse.renderDOM()
   }
   uiMathcingType(row) {
      document.querySelector('.wrapper').innerHTML = `
   <p>Ans is front of them</p>
   <div class="output">
   </div>
   <button id="add-matching">+</button>
   `
      matching.question = main.questions[row];
      matching.renderDOM()
      add_matching(row);
   }
   uiBlankType(row) {
      document.querySelector('.wrapper').innerHTML = `
   <div class="add-blank-block">
   <button id="add-blank" class="btn btn-primary">Add Blank</button>
   
   </div>
   <div class="output"></div>
   `
      blank.question = main.questions[row];
      blank.renderDOM(row)
   }



   // Section Renderer
   sectionRender(x = 0) {

      / TYPE OF QUESION /
      let t1 = '',
         t2 = '',
         t3 = '',
         t4 = '',
         t5 = '',
         t6 = '';
      let s = 'selected';

      if (main.questions[x].type == 'single-choice') {
         t1 = s
      }
      if (main.questions[x].type == 'multi-choice') {
         t2 = s
      }
      if (main.questions[x].type == 'input') {
         t3 = s
      }
      if (main.questions[x].type == 'true-false') {
         t4 = s
      }
      if (main.questions[x].type == 'matching') {
         t5 = s
      }
      if (main.questions[x].type == 'blank') {
         t6 = s
      }

      let t = '';
      t = `
   <select class="question-type">
   <option value="single-choice" ${t1} > Single Choice </option>
   <option value="multi-choice" ${t2} > Multi Choice </option>
   <option value="input" ${t3} > Input </option>
   <option value="true-false" ${t4}> True-False </option>
   <option value="matching" ${t5} >Matching</option>
   <option value="blank" ${t6} >Fill Blanks </option>
   </select>
   `


      let isChecked = main.questions[x].isRandom ? 'checked' : '';
      document.querySelector('header').innerHTML =
         `<div class="question-block">
            <nav>
               <div class="nav1">
                  <h1>Question ${main.questions[x].order} </h1>
               </div>
               <div div class="nav2">
                  <a href="#" class="leave-test">Leave Test</a>
                  <a href="${$('#test_id').text()}/postview" class="finish-test-btn">Finish Test</a>
               </div>
            </nav>
            <div class="question-create-block" data-row="${main.questions[x].id}">
               <div class="question-input-field">
                  <textarea class="question-field"  rows = "1"  data-row="${main.questions[x].order}" >${main.questions[x].question}</textarea>
                   <div class="custom-file-question">
                     <input type="file" accept="image/*" class="question-file" id="file-question-${x}">
                     <label for="file-question-${x}"><i class="far fa-image"></i></label>
                  </div>
                  ${main.questions[x].hasImage == true 
                        ? `<img src=${main.questions[x].path} class ="question-image img-eff" >
                        <button class="remove-file-btn" data-row=${x} ><i class="fas fa-times"></i></button>`
                        : ``}
               </div>
               <div class="question-parameters">
               ${main.questions[x].type == "single-choice" || main.questions[x].type =="multi-choice" ? 
                  `<div class="random-place">
                     <input type="checkbox" class="random" ${isChecked}> isRandom</div>`: ``
                  }
                  <div class="question-type-select">
                  <label>Type of question:</label>
                     ${t}
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
      this.selectType(main.questions[x].type, x)


      /// GET VALUE OF TEXTAREA QUESTION
      const textarea = document.querySelector('.question-field');
      textarea.addEventListener('input', (e) => {
         main.questions[x].question = e.target.value.trim();
         this.edited = true;

         if (main.questions[x].type == 'blank') {

            const splited = main.questions[x].question.split(' ')
            const filtered = splited
               .filter((str) => str.startsWith('[_') && str.endsWith('_]'))
               .map((ans) => ans.slice(2, ans.length - 2))
            main.questions[x].answers = filtered.filter((val) => val !== "");

            this.edited = true
         }

      })

      // image upload for question
      const fileUpload = document.querySelector('.question-file');
      fileUpload.addEventListener('change', (e) => {
         const fileInputValue = e.target.files[0];
         let size = fileInputValue.size / 1024 / 1024;
         if (size < 2) {
            if (main.questions[x].id) {
               this.deletedQuestionFile.push(main.questions[x].path);
            }
            main.questions[x].path = URL.createObjectURL(fileInputValue)
            main.questions[x].pathValue = fileInputValue;
            main.questions[x].hasImage = true;
            this.sectionRender(x)
            main.questions[x].hasImage = true
            this.edited = true;
            imageEffect()
         } else {
            displayError('Your file must be less than 2MB')
         }
      })

      //Remove File
      if (main.questions[x].hasImage == true) {
         const removeFileBtn = document.querySelector('.remove-file-btn');
         removeFileBtn.addEventListener('click', (e) => {
            const thisQuestion = main.questions[x];

            if (main.questions[x].id) {
               this.deletedQuestionFile.push(thisQuestion.path.slice(14, main.questions[x].path.length));
            }
            thisQuestion.path = "",
               thisQuestion.pathValue = "",
               thisQuestion.hasImage = false
            this.sectionRender(x)
            this.edited = true
         })
      }


      // Checkbox
      if (main.questions[x].type == "single-choice" || main.questions[x].type == "multi-choice") {
         const checkbox = document.querySelector('.random');
         checkbox.addEventListener('click', (e) => {
            main.questions[x].isRandom = e.target.checked;
            this.edited = true
         })
      }
      init()
      // if(main.questions[x].id){
         let prevID = main.questions[x].id;
      // }
      //Type of question
      const questionType = document.querySelector('.question-type');
      questionType.addEventListener('change', (e) => {
         const typeSelect = e.target.value;

         if (typeSelect == 'input') {
            main.questions[x] = {
               order: x + 1,
               answer: '',
               question: '',
               saved: false,
               type: 'input',
               hasImage: false
            }
            main.questions[x].type = typeSelect;
         } else if (typeSelect == 'single-choice') {
            main.questions[x] = {
               order: x + 1,
               question: '',
               saved: false,
               isRandom: false,
               hasImage: false,
               choices: [{
                     id: singleChoice.count - 2,
                     value: '',
                     type: 'string',
                     path: '',
                     isChecked: true
                  },
                  {
                     id: singleChoice.count - 1,
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
            main.questions[x].type = typeSelect;
         } else if (typeSelect == 'multi-choice') {
            main.questions[x] = {
               order: x + 1,
               question: '',
               saved: false,
               isRandom: false,
               hasImage: false,
               choices: [{
                     id: singleChoice.count - 2,
                     value: '',
                     type: 'string',
                     path: '',
                     isChecked: true
                  },
                  {
                     id: singleChoice.count - 1,
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
            main.questions[x].type = typeSelect;
         } else if (typeSelect == 'true-false') {
            main.questions[x] = {
               order: x + 1,
               question: '',
               saved: false,
               type: 'true-false',
               answer: 1,
               hasImage: false,
               choices: [{
                     id: 1,
                     value: 'true',
                     isChecked: true
                  },
                  {
                     id: 2,
                     value: 'false',
                     isChecked: false
                  }
               ]
            }
            main.questions[x].type = typeSelect;
         } else if (typeSelect == 'matching') {
            main.questions[x] = {
               order: x + 1,
               question: '',
               saved: false,
               hasImage: false,
               choices: [{
                     id: matching.countMatching - 3,
                     value: '',
                  },
                  {
                     id: matching.countMatching - 2,
                     value: '',
                  },
                  {
                     id: matching.countMatching - 1,
                     value: '',
                  },
                  {
                     id: matching.countMatching,
                     value: '',
                  }
               ],
               type: 'matching',
               answer: []
            }
            main.questions[x].type = typeSelect;
         } else if (typeSelect == 'blank') {
            main.questions[x] = {
               order: x + 1,
               question: '',
               hasImage: false,
               answers: []
            }
            main.questions[x].type = typeSelect;
         }
         main.questions[x].id = prevID
         this.sectionRender(x);
         init()
         this.edited = true
      })


      // Delete Question
      const deleteBtn = document.querySelector('.delete-qst-btn');
      if (main.questions.length > 1) {
         deleteBtn.addEventListener('click', (e) => {
            let currentQstId = Number(e.target.dataset.row) + 1;
            let questionId = main.questions[x].id;

            const newQuestions = main.questions.filter((question) => question.order != currentQstId)
            main.questions = newQuestions
            main.orderQuestion -= 1;
            main.createQuestions()
            this.sectionRender()

            // DELETES FROM DB
            $.ajax({
               url: '../deleteQuestion',
               type: 'post',
               data: {
                  questionId : questionId
               },
               success: function (data) {
                  /*...*/
                  var response = JSON.parse(data)
                  displayError(questionId,': this question has deleted !')
               },
               error: function (data) {
                  displayError('couldn;t get questions')
               }
            })
         })
      } else {
         deleteBtn.style.display = "none"
      }


      const saveButton = document.querySelector('.save-btn');
      // Saves question ,so you can create new question
      saveButton.addEventListener('click', (e) => {
         let validateQ = false
         let validateAns = false
         let vaidateCheckbox = true
         let countAns = 0;
         if (main.questions[x].question !== "") validateQ = true;
         if (main.questions[x].hasImage == true) validateQ = true
         if (main.questions[x].type == 'single-choice' || main.questions[x].type == 'multi-choice') {
            for (let k = 0; k < main.questions[x].choices.length; k++) {

               if (main.questions[x].choices[k].type != "image") {
                  if (main.questions[x].choices[k].value != '') {
                     countAns += 1;
                  }
               } else {
                  countAns += 1
               }
            }
            if (countAns == main.questions[x].choices.length) validateAns = true
         }
         if (main.questions[x].type == 'matching'){
            for (let k = 0; k < main.questions[x].choices.length; k++) {
               if (main.questions[x].choices[k].value != '') {
                  countAns += 1;
               }
            }
            if (countAns == main.questions[x].choices.length) validateAns = true
         }
         if (main.questions[x].type == 'single-choice' || main.questions[x].type == 'multi-choice') {
            const checked = main.questions[x].choices.filter((choice) => choice.isChecked == true);
            if (checked.length > 0) vaidateCheckbox = true
            else vaidateCheckbox = false
         } else if (main.questions[x].type == 'input') {
            if (main.questions[x].answer !== "") {
               validateAns = true
            }
         } else if (main.questions[x].type == 'blank') {
            const splited = main.questions[x].question.split(' ')

            let filtered1 = '',
               filtered2 = '',
               filtered3 = '',
               c = 0,
               p = 0;
            splited.forEach((str) => {

               filtered1 = (str.startsWith('[_') && !str.endsWith('_]')) ? false : true;
               filtered2 = (!str.startsWith('[_') && str.endsWith('_]')) ? false : true;
               if (str.startsWith('[_') && str.endsWith('_]')) {
                  c++
                  if (str.charAt(2) == "_" || str.charAt(2) == "]") {
                     p -= 1
                  } else {
                     p++
                  }
               }

            })


            const ans = main.questions[x].answers;
            p == c ? filtered3 = true : filtered3 = false

            if (filtered1 && filtered2 && filtered3 && ans.length > 0) {
               validateAns = true
            }
         } else if (main.questions[x].type == 'true-false') {
            main.questions[x].choices.forEach((choice) => {
               if (choice.isChecked) validateAns = true
            })
         }

         if (validateAns && validateQ && vaidateCheckbox) {
            main.questions[x].saved = true;
            let left = [];
            let right = [];
            if (main.questions[x].type == 'single-choice') {
               main.questions[x].choices.forEach((choice) => {
                  if (choice.isChecked == true) {
                     main.questions[x].answer = choice.id
                  }
               })
            }
            else if (main.questions[x].type == 'multi-choice') {
               main.questions[x].answer = []
               main.questions[x].choices.forEach((choice) => {
                  if (choice.isChecked == true) {
                     main.questions[x].answer.push(choice.id)
                  }
               })
            }
            else if(main.questions[x].type == 'matching'){
               console.log(main.questions[x].choices);
               
               main.questions[x].choices.forEach((choice,index) => {
                  if(index === 0 || index % 2 === 0){
                     left.push(choice.value);
                     console.log('l',choice.id)
                  }
                  if (index % 2 !== 0) {
                     right.push(choice.value);
                     console.log('r',choice.id)

                  }
               })
               console.log('left', left);
               console.log('right', right);
            }
            
            if (main.questions[x].path ){
               console.log(main.questions[x].path.slice(14, main.questions[x].path.length))
               main.questions[x].path = main.questions[x].path.slice(14, main.questions[x].path.length);
            }

            if (main.questions[x].type == "single-choice" || main.questions[x].type == "multi-choice"){
               main.questions[x].choices.forEach((choice) => {
                  if (choice.type == 'image') {
                     choice.path = choice.path.slice(14, choice.path.length);
                  }
               });
            }

            // File lar ucin form data
            let formData = new FormData();
            if (main.questions[x].pathValue) {
               formData.append("qFile", main.questions[x].pathValue, JSON.stringify({
                  id: main.questions[x].id,
                  type: main.questions[x].fileType
               }));
            }

            let p = [];
            let choiceType = main.questions[x].type == 'single-choice' || main.questions[x].type == 'multi-choice'
            if (choiceType) {
               for (let f = 0; f < main.questions[x].choices.length; f++) {
                  if (main.questions[x].choices[f].pathValue) {

                     formData.append("file-" + f, main.questions[x].choices[f].pathValue, JSON.stringify({
                        index: f,
                        id: main.questions[x].choices[f].id,
                        type: main.questions[x].choices[f].type
                     }));
                  } else {

                     p[f] = main.questions[x].choices[f].path;

                  }
               }
            }
            formData.append("choiceFiles", JSON.stringify(p));

            // type a gora Form Data yasaya
            
            

            let data = ""
            if (main.questions[x].type == "single-choice" || main.questions[x].type == "multi-choice") {
               data = {
                  question: main.questions[x].question,
                  choices: main.questions[x].choices,
                  answer: main.questions[x].answer,
                  type: main.questions[x].type,
                  hasImage: main.questions[x].hasImage,
                  id: main.questions[x].id,
                  isRandom: main.questions[x].isRandom,
                  order: main.questions[x].order,
                  path: main.questions[x].path,
                  testId: main.testId
               };
            }
            if (main.questions[x].type == "input") {
               data = {
                  answer: main.questions[x].answer,
                  question: main.questions[x].question,
                  type: main.questions[x].type,
                  hasImage: main.questions[x].hasImage,
                  id: main.questions[x].id,
                  order: main.questions[x].order,
                  path: main.questions[x].path,
                  testId: main.testId

               }
            }
            if (main.questions[x].type == "true-false" ) {
               data = {
                  answer: main.questions[x].answer,
                  question: main.questions[x].question,
                  type: main.questions[x].type,
                  hasImage: main.questions[x].hasImage,
                  id: main.questions[x].id,
                  choices: main.questions[x].choices,
                  order: main.questions[x].order,
                  path: main.questions[x].path,
                  testId: main.testId
               }
            }
            if (main.questions[x].type == "matching"){
                  data = {
                     answer: right,
                     question: main.questions[x].question,
                     type: main.questions[x].type,
                     hasImage: main.questions[x].hasImage,
                     id: main.questions[x].id,
                     choices: main.questions[x].choices,
                     order: main.questions[x].order,
                     path: main.questions[x].path,
                     testId: main.testId
                  }
            }
            if (main.questions[x].type == "blank") {
               data = {
                  question: main.questions[x].question,
                  type: main.questions[x].type,
                  hasImage: main.questions[x].hasImage,
                  id: main.questions[x].id,
                  answers: main.questions[x].answers,
                  order: main.questions[x].order,
                  path: main.questions[x].path,
                  testId: main.testId

               }
            }
            // Hacanda id bar bolsa questionda shonda deleted file ugratmaly
            if (main.questions[x].id) {
               formData.append("deletedQuestionFile", JSON.stringify(this.deletedQuestionFile))
               formData.append('deletedChoiceFiles', JSON.stringify(this.deletedChoiceFiles))
            }
            formData.append("data", JSON.stringify(data));


            console.log(data)
            const addBtn = document.getElementById('add-question-btn');
            addBtn.setAttribute("disabled", "");
            addBtn.style.opacity = '0.5';

            // FETCH QUESTION
            async function fetchQuestions() {
               // Question y Databasedan alyancam garashyan we menin objectime dakyan
               notify('Saving your quesion ...')
               //-------------------------------------------------------------------------------
               $.ajax({
                  url: '../saveQuestion',
                  type: 'post',
                  processData: false,
                  contentType: false,
                  data: formData,
                  success: function (data) {

                     let newQuestion = JSON.parse(data)

                     if (newQuestion.type == 'single-choice' || newQuestion.type == 'multi-choice') {
                        newQuestion.choices.forEach((choice) => {
                           if (choice.type == "image" && !choice.path.includes("../../uploads")) {
                              console.log('withoutpath' , choice.path)
                              choice.path = `../../uploads/${choice.path}`;
                              choice.pathValue = false;
                           }
                        })
                     }

                     if (newQuestion.hasImage) {
                        newQuestion.path = `../../uploads/${newQuestion.path}`;
                     }

                     console.log(newQuestion)
                     main.questions[x] = newQuestion

                     question.edited = false
                     main.questions[x].saved = true
                     singleChoice.count = 3
                     blank.countBlank = 0
                     notify("Saved")
                     addBtn.removeAttribute("disabled", "");
                     addBtn.style.opacity = '1'
                     addNewQuestion()
                     main.createQuestions(x);

                  },
                  error: function (data) {
                     displayError('Your question has not been saved')
                  }
               })
            }
            //-----------------------------------------------------------------------------

            fetchQuestions()
         } else {
            displayError('Please create your question correctly')
         }
      })
   }
}

const question = new Question()