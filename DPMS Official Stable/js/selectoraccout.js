const studentAccount = document.getElementById('studentAccount');
const teacherAccount = document.getElementById('teacherAccount');
const parentAccount = document.getElementById('parentAccount');

// Function to add hover effect
function addHoverEffect(element) {
    element.addEventListener('mouseenter', function() {
        this.classList.add('hovered');
    });

    element.addEventListener('mouseleave', function() {
        this.classList.remove('hovered');
    });
}

// Add hover effect to StudentAccount
addHoverEffect(studentAccount);

// Add hover effect to TeacherAccount
addHoverEffect(teacherAccount);

// Add hover effect to ParentAccount
addHoverEffect(parentAccount);


function selectorpresstudent() {
    var firstpage = document.getElementById('firstpage_selector');
    var secondpage = document.getElementById('secondpage_studentAccount');
    var thirdpage = document.getElementById('thirdpage_teacherAccount');
    var fourthpage = document.getElementById('fourthpage_parentAccount');
    var backbutton = document.getElementById('backbtn');
        firstpage.style.visibility = "hidden";
        firstpage.style.zIndex = "0";
        backbutton.style.visibility = "visible";
        secondpage.style.visibility = "visible";
        thirdpage.style.visibility = "hidden";
        fourthpage.style.visibility = "hidden";
}
function selectorpressteacher() {
    var firstpage = document.getElementById('firstpage_selector');
    var secondpage = document.getElementById('secondpage_studentAccount');
    var thirdpage = document.getElementById('thirdpage_teacherAccount');
    var fourthpage = document.getElementById('fourthpage_parentAccount');
    var backbutton = document.getElementById('backbtn');
        firstpage.style.visibility = "hidden";
        backbutton.style.visibility = "visible";
        secondpage.style.visibility = "hidden";
        thirdpage.style.visibility = "visible";
        fourthpage.style.visibility = "hidden";
}

function selectorpressparent() {
    var firstpage = document.getElementById('firstpage_selector');
    var secondpage = document.getElementById('secondpage_studentAccount');
    var thirdpage = document.getElementById('thirdpage_teacherAccount');
    var fourthpage = document.getElementById('fourthpage_parentAccount');
    var backbutton = document.getElementById('backbtn');
        firstpage.style.visibility = "hidden";
        backbutton.style.visibility = "visible";
        secondpage.style.visibility = "hidden";
        thirdpage.style.visibility = "hidden";
        fourthpage.style.visibility = "visible";
}

function backbutton() {
    var firstpage = document.getElementById('firstpage_selector');
    var secondpage = document.getElementById('secondpage_studentAccount');
    var thirdpage = document.getElementById('thirdpage_teacherAccount');
    var fourthpage = document.getElementById('fourthpage_parentAccount');
    var backbutton = document.getElementById('backbtn');
    firstpage.style.visibility = "visible";
    backbutton.style.visibility = "hidden";
    secondpage.style.visibility = "hidden";
    thirdpage.style.visibility = "hidden";
    fourthpage.style.visibility = "hidden";
}