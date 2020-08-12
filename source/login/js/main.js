$('#form_').submit(function(event){
        event.preventDefault();
        var formData = new FormData();
    $.ajax({
        url:'login/checkLogin',
        method:'POST',
        data: formData,
        success:function(data){
            switch(data){
                case 0:
                    $('.incorrect').fadeIn(750);
                    break;
                case 1:
                    window.location.href = 'main';
                    break;
                case 2:
                    window.location.href = 'mailnotification';
                    break;
                default:
            }
        },
        error: function(){
            console.log('Error bolda hoooow');
            return false;
        }
    });
    return false;
})
    
 