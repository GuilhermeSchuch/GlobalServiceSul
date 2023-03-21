// let $msgContainer = document.querySelector(".msg-container");
// let $msg = document.querySelector(".msg");


// if($msg){
//     $($msg).fadeOut(10000);

//     setTimeout(function () {
//         $($msgContainer).fadeOut(1);
//     }, 9999);
// }


// Seleciona o elemento que você deseja desvanecer
var element = document.querySelector(".msg-container");

if(element){
    element.style.opacity = 1;

    function fadeOut() {
        var opacity = element.style.opacity;
        opacity -= 0.1;
        element.style.opacity = opacity;

        if (opacity > 0) {
            setTimeout(fadeOut, 30);
        }
    }


    setTimeout(fadeOut, 5000);
}
