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
            if(result == 0){
                $('.incorrect').fadeIn(750);
            }else if(result == 1){
                 window.location.href = 'main';    
            }else{
                window.location.href = 'mailnotification';
            }
            },
            error: function(error){
                console.log("error: checklogin error");
            }
        });
    	
    }));
    
 