class Main {
   constructor() {
      this.questions = [{
         order: 1,
         question: '',
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
      }];
      this.testId = null;
      this.orderQuestion = 1;
   }
   createQuestions(currentQ = 0) { 

      // Get new orders
      this.questions.forEach((question, index) => {
         question.order = index + 1;
      })

      /* LEFT SIDE QUESTIONS LIST */
      let html = ''
      this.questions.forEach((qst, index) => {
         html += `
            <div id="question" data-row=${index}>
            <h3>Question ${qst.order}</h3>
            <p>${qst.question.substring(0,20)}...</p>
            </div>
            `
      });
      document.getElementById('questions').innerHTML = html;


      // HAYSY QUESTIONA BASSAN SHONA AKIDYA
      const questions = document.querySelectorAll('#question');

      for (let x = 0; x < questions.length; x++) {

         questions[x].addEventListener('click', () => {

            if (question.edited != true) {
               question.sectionRender(x);

               // Animations
               for (let x = 0; x < questions.length; x++) {
                  questions[x].style.opacity = '0.5'
               };
               questions[x].style.opacity = '1';
               opacityEffect();

               addNewQuestion(x)
            } else {
               displayError('You need to save this question !')
            }

         })
      }
      // For rendering this.createQuestions
      question.sectionRender(currentQ);
      // Animations
      for (let x = 0; x < questions.length; x++) {
      questions[x].style.opacity = '0.5'
      };
      questions[currentQ].style.opacity = '1';
      addNewQuestion()
   }
}

let main = new Main()

function newQuestion() {
   // If last question saved ,you can create new one
   if (main.questions[main.questions.length - 1].saved && !question.edited) {
      console.log('asadsad')
      main.orderQuestion += 1;
      main.questions = [
         ...main.questions,
         {
            order: main.orderQuestion,
            question: ' ',
            saved: false,
            isRandom: false,
            choices: [{
               // id: main.count - 2,
               value: '',
               type: 'string',
               path: '',
               isChecked: true
            }, {
               // id: main.count - 1,
               value: '',
               type: 'string',
               path: '',
               isChecked: false
            }, {
               // id: main.count,
               value: '',
               type: 'string',
               path: '',
               isChecked: false
            }],
            type: 'single-choice',
            answer: ''
         }
      ]
      console.log(main)
      main.createQuestions();
      question.sectionRender(main.questions.length - 1);
      singleChoice.renderDOM()
      document.querySelectorAll('#question')[main.questions.length - 1].style.opacity = '1'
      document.querySelectorAll('#question')[0].style.opacity = '0.5'
      opacityEffect()
   } else {
      displayError('Please SAVE question')
   }
}
// Add New Quesiton
const addNewQuestion = () => {
   const addBtn = document.getElementById('add-question-btn');
   addBtn.addEventListener('click', newQuestion)
}


/* Page Load Functions*/
const onloadFunction = () => {
   const testId = document.querySelector('.test-id').innerHTML;
   main.testId = Number(testId)
   $.ajax({
      url: '../getQuestions',
      type: 'post',
      data: {
         testId: main.testId
      },
      success: function (data) {
         /*...*/
         var response = JSON.parse(data)
         if (response != 0) {
            main.questions = response.questions;
            main.orderQuestion = response.orderQuestion;
            main.testId = response.testId;

            response.questions.forEach((question) => {
               if(question.hasImage){
                  question.path = `../../uploads/${question.path}`
               }
               if (question.type === "single-choice" || question.type === "multi-choice"){
                  question.choices.forEach((choice) => {
                     console.log(choice.path )
                     if (choice.type == "image"){
                        choice.path = `../../uploads/${choice.path}`
                        choice.pathValue = false;
                     }
                  })
               }
            })


            main.createQuestions();
            question.sectionRender(0);

            document.querySelectorAll('#question')[0].style.opacity = '1'
            console.log(main);
         } else {
            main.createQuestions();
            question.sectionRender();
            document.querySelectorAll('#question')[0].style.opacity = '1'
         }
      imageEffect()

      },
      error: function (data) {
         displayError("Couldn't get questions")
      }

   })




   if (main.id) {
      console.log("YOU HAVE TEST ID")
   }

}
window.onload = onloadFunction()