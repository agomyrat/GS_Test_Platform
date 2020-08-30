/* Questions Class */
class Questions {
   constructor() {
      this.questions = [];
      this.time = null
   }
   getData(){
      this.questions = data.questions
      this.time = data.time
      // console.log(this.questions);
      // console.log(this.time)
   }
}


const questionsClass = new Questions();   
questionsClass.getData()




