$("#back-button").click(function(){
    console.log('back');
    window.history.back();
});

$("#start-button").click(function(e){
    e.preventDefault();
    let test_id = $("#test_id").val();
    let password = $(".password").val();
    $.ajax({
        url: '../../checkTestPassword',
        method: 'POST',
        data: { test_id : test_id ,password : password},
        success: function (data) {
            if(data!=0){
                window.location.href = "./";
            }else{
                alert('wrong password');
            }
        },
        error: function () {
           return false;
        }
     });
    
});


function cutLongStrings() {
   const substring = document.querySelectorAll('.substring');

   console.log(substring)

   for(let x = 0 ; x < substring.length; x++){
      const sub = substring[x].innerText;
      let res = '';

      if(sub.length > 70){
         res = sub.substr(0,70);
         substring[x].innerHTML = res + "..."
      }
      else{
         substring[x].innerHTML = sub ;
      }
   }
}


cutLongStrings()