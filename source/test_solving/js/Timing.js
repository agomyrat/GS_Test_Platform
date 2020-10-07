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

      let totalSec = this.time;
      // totalSec = 5;
      const timing = setInterval(() => {
         totalSec--;
         let mnt = parseInt(totalSec / 60);
         let sec = totalSec % 60;
         this.display = (mnt < 10 ? '0' + mnt : mnt) + ':' + (sec < 10 ? '0' + sec : sec);
         this.renderTime()
      }, 1000);

      
      // Clear TimeInterval
       setTimeout(() => {
          /// Finished Popup
          alert('finished');
          this.display = "0.00"
          clearInterval(timing)
       }, totalSec * 1000)

         
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

