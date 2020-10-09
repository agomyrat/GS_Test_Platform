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