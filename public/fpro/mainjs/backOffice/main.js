var notfound = {
    'title': 'Contraseña Incorrecta',
    'message': 'Intente nuevamente',
    'theme': 'flat',
    'icon': 'danger-3',
};

var userNotFound = new notifi(notfound);

$('#inputEmail').keydown( function(e) {
    var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
    if(key == 13) {
        errorLogin(e);
    }
});

$('#inputPassword').keydown( function(e) {
    var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
    if(key == 13) {
        errorLogin(e);
    }
});

$(".login-btn").on("click", function(e){
    errorLogin(e);
});

function testAnim(x) {
    $('#passGroup').addClass(x + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
        $(this).removeClass(x + ' animated');
    });
};

function errorLogin(e){
    e.preventDefault();
    var anim = "shake";
    testAnim(anim);
    $('#inputPassword').val('');
    userNotFound.show();
    /*setTimeout(() => {
        userNotFound.hide();
    }, 10000);*/
}

function showOverlay(){
    $(".md-overlay").css('visibility', 'visible');
    $(".md-overlay").css('opacity', '0.9');
}

function hideOverlay(){
    $(".md-overlay").css('visibility', 'hidden');
    $(".md-overlay").css('opacity', '0');
}