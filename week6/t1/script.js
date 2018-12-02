var clicke = document.querySelectorAll('div#tasks div');

for (var i = 0 ; i < clicke.length; i++) {
    clicke[i].addEventListener('click' , MakeCross) ;
}

function MakeCross() {
    var target = event.currentTarget;
    target.setAttribute("data-status", "done");
}