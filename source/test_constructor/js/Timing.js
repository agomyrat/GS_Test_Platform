class Timing {
   constructor() {
      this.time = null;
      this.display = null
   }
   getTime() {
      this.time = questionsClass.time;
      this.timingFunction()
   }
   timingFunction () {

      let time = this.time - 1;
      let i = 60;

      let myVar = setInterval(() => {
         i -= 1
         if (i < 0) {
            time -= 1;
            i = 59
         }
         if (i / 10 >= 1) {
            this.display = time + ':' + i
         }
         else {
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

