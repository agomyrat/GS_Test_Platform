$('#form_').on('submit',(function(e) {
       		  e.preventDefault();
              var formData = new FormData(this);
        $.ajax({
            type: 'post',
            url: 'login/checkLogin',
            processData: false,
            contentType: false,
            data: formData,
            success: function(result){     
                if(result == 1){
                    window.location.href = 'main';    
                }else if(result == 2){
                    window.location.href = 'mailnotification';
                }else{
                    $('.incorrect').fadeIn(750);
                }
            },
            error: function(error){
                console.log("error: checklogin error");
            }
        });
    	
    }));
    
const navImage = document.querySelector('.nav-image');

navImage.src = 'source/general/img/LogoText-White.svg'


function changeLogoColor() {
   if (window.innerWidth < 768) {
      navImage.src = 'source/general/img/LogoText-Orange.svg'
   } else {
      navImage.src = 'source/general/img/LogoText-White.svg'
   }
}

window.onresize = changeLogoColor;
window.onload = changeLogoColor;
