$('#form_').on('submit',(function(e) {
       		  e.preventDefault();
        	  var data = {
                  user : $('#user').val(),
                  password : $('#password').val()
              }
        $.ajax({
            type: 'post',
            url: 'login/checkLogin',
            data: data,
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
    
 