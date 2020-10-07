$('#send-again').click(function (e) {
   e.preventDefault();
   $.ajax({
      method: 'post',
      url: 'mailnotification/sendAgain',
      success: function () {
         alert(mail_sended);
      },
      error: function () {
         alert(mail_not_sended);
      }
   });
})