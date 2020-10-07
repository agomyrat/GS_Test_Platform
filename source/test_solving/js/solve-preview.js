$("#back-button").click(function(){
    console.log('back');
    window.history.back();
});

$("#start-button").click(function(){
    let test_id = $("#test_id").val();
    sessionStorage.setItem(test_id,'allowed');
    window.location.href = "./";
});