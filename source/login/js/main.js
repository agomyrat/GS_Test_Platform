$('#form_').on('submit',(function(e) {
       		  e.preventDefault();
        	  formdata = new FormData(this);
        $.ajax({
            type: 'post',
            url: 'login/checkLogin',
            processData: false,
            contentType: false,
            data: formdata,
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
    
 