$('#_form').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this); 
        $.ajax({
        type: 'post',
        url: '../changePassword',
        processData: false,
        contentType: false,
        data: formData,
        success: function(result){     
            if(result == 1){
                window.location.href = '../../login';    
            }else{
                $('.no_match').fadeIn(750);
            }
        },
        error: function(error){
        console.log("error: checklogin error");
        }
        });

}));