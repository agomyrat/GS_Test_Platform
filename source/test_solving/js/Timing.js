class Timing {
   constructor() {
      this.time = null;
      this.display = null
   }
   getTime() {
      this.time = questionsClass.time;
      console.log(this.time)
      this.timingFunction()
      // this.renderTime()
   }
   timingFunction () {

      let time = this.time - 1;
      let i = 60;
      console.log(this.time)

      let myVar = setInterval(() => {
         i -= 1
         if (i < 0) {
            time -= 1;
            i = 59
         }
         if (i / 10 >= 1) {
            //console.log(time + ':' + i)
            this.display = time + ':' + i
         }
         else {
            console.log(time + ':0' + i)
            this.display = time + ':0' + i
         }
         this.renderTime()
      }, 1000);

      
      // Clear TimeInterval
       setTimeout(() => {
          /// Finished Popup
          alert('finished');
          this.display = "0.00"
          clearInterval(myVar)
       }, this.time * 60000)

       console.log(this.time * 60000)
         
   }
    renderTime () {
      let html = '';
      html = `
         <div class="timer">
            <i class="far fa-clock"></i>&nbsp;${this.display}
         </div>
         
      `
      document.querySelector('.t').innerHTML = html
   }
}

const time = new Timing();

if(questionsClass.time){
   time.getTime()
}