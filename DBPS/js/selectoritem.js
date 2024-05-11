function selectorranklist() {
    var firstpage = document.getElementById('firstpage_selector');
    var secondpage = document.getElementById('secondpage_lor');
    var thirdpage = document.getElementById('thirdpage_loe');
    var fourthpage = document.getElementById('fourthpage_loc');
    var backbutton = document.getElementById('backbtn');
        firstpage.style.visibility = "hidden";
        firstpage.style.zIndex = "0";
        backbutton.style.visibility = "visible";
        secondpage.style.visibility = "visible";
        thirdpage.style.visibility = "hidden";
        fourthpage.style.visibility = "hidden";
}

function selectorevaluationlist() {
    var firstpage = document.getElementById('firstpage_selector');
    var secondpage = document.getElementById('secondpage_lor');
    var thirdpage = document.getElementById('thirdpage_loe');
    var fourthpage = document.getElementById('fourthpage_loc');
    var backbutton = document.getElementById('backbtn');
        firstpage.style.visibility = "hidden";
        backbutton.style.visibility = "visible";
        secondpage.style.visibility = "hidden";
        thirdpage.style.visibility = "visible";
        fourthpage.style.visibility = "hidden";
}

function selectorconsultationlist() {
    var firstpage = document.getElementById('firstpage_selector');
    var secondpage = document.getElementById('secondpage_lor');
    var thirdpage = document.getElementById('thirdpage_loe');
    var fourthpage = document.getElementById('fourthpage_loc');
    var backbutton = document.getElementById('backbtn');
        firstpage.style.visibility = "hidden";
        backbutton.style.visibility = "visible";
        secondpage.style.visibility = "hidden";
        thirdpage.style.visibility = "hidden";
        fourthpage.style.visibility = "visible";
}

function backbutton() {
    var firstpage = document.getElementById('firstpage_selector');
    var secondpage = document.getElementById('secondpage_lor');
    var thirdpage = document.getElementById('thirdpage_loe');
    var fourthpage = document.getElementById('fourthpage_loc');
    var backbutton = document.getElementById('backbtn');
    firstpage.style.visibility = "visible";
    backbutton.style.visibility = "hidden";
    secondpage.style.visibility = "hidden";
    thirdpage.style.visibility = "hidden";
    fourthpage.style.visibility = "hidden";
}
