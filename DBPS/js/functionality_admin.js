var isLarge = false; // Initial state
function toggleSidebar() {
    var body = document.getElementById('body');
    var csp = document.getElementById('cs');
    var body2 = document.getElementById('body2');
    var sp2 = document.getElementById('esp');
    var fre = document.getElementById('fre');
    var rd = document.getElementById('rd');
    var rc = document.getElementById('rc');
    var txt = document.getElementById('txt');
    var txt2 = document.getElementById('txt2');
    var sidebar = document.getElementById('sidebar');
    var dashnm = document.getElementById('dhtxt');
    var cournm = document.getElementById('ctxt');
    var logoutbtn = document.getElementById('logouttxt');
    if (dashnm.classList.contains('hide2')) {
        dashnm.classList.remove('hide2');
        dashnm.classList.add('show2');
    } else {
        dashnm.classList.remove('show2');
        dashnm.classList.add('hide2');
    }
    if (cournm.classList.contains('hide2')) {
        cournm.classList.remove('hide2');
        cournm.classList.add('show2');
    } else {
        cournm.classList.remove('show2');
        cournm.classList.add('hide2');
    }
    if (logoutbtn.classList.contains('hide')) {
        logoutbtn.classList.remove('hide');
        logoutbtn.classList.add('show');
    } else {
        logoutbtn.classList.remove('show');
        logoutbtn.classList.add('hide');
    }
    if (csp.classList.contains('position-course')) {
        csp.classList.remove('position-course');
        csp.classList.add('position-course-reverse2');
    } else {
        csp.classList.remove('position-course-reverse2');
        csp.classList.add('position-course');
    }
    if (body.classList.contains('resize')) {
        body.classList.remove('resize');
        body.classList.add('resize-reverse');
    } else {
        body.classList.remove('resize-reverse');
        body.classList.add('resize');
    }
    if (body2.classList.contains('resize2')) {
        body2.classList.remove('resize2');
        body2.classList.add('resize-reverse2');
    } else {
        body2.classList.remove('resize-reverse2');
        body2.classList.add('resize2');
    }
    if (sidebar.classList.contains('sidebar-resize')) {
        sidebar.classList.remove('sidebar-resize');
        sidebar.classList.add('sidebar-resize-reverse');
    } else {
        sidebar.classList.remove('sidebar-resize-reverse');
        sidebar.classList.add('sidebar-resize');
    }
    if (fre.classList.contains('position')) {
        fre.classList.remove('position');
        fre.classList.add('position-reverse');
    } else {
        fre.classList.remove('position-reverse');
        fre.classList.add('position');
    }
    if (rd.classList.contains('position-size')) {
        rd.classList.remove('position-size');
        rd.classList.add('position-size-reverse');
    } else {
        rd.classList.remove('position-size-reverse');
        rd.classList.add('position-size');
    }
    if (rc.classList.contains('position-course-size')) {
        rc.classList.remove('position-course-size');
        rc.classList.add('position-course-reverse');
    } else {
        rc.classList.remove('position-course-reverse');
        rc.classList.add('position-course-size');
    }
    
    if (txt.classList.contains('position-text')) {
        txt.classList.remove('position-text');
        txt.classList.add('position-text-reverse');
    } else {
        txt.classList.remove('position-text-reverse');
        txt.classList.add('position-text');
    }

    if (txt2.classList.contains('position-text2')) {
        txt2.classList.remove('position-text2');
        txt2.classList.add('position-text-reverse2');
    } else {
        txt2.classList.remove('position-text-reverse2');
        txt2.classList.add('position-text2');
    }


    if (sp2.classList.contains('event-sp')) {
        sp2.classList.remove('event-sp');
        sp2.classList.add('event-sp-reverse');
    } else {
        sp2.classList.remove('event-sp-reverse');
        sp2.classList.add('event-sp');
    }
    
    var menuItems = document.querySelectorAll('.menu .item a');
    // Toggle between two sets of styles based on the current state
    if (!isLarge) {
        menuItems.forEach(function(item) {
            item.classList.add('large'); // Add 'large' class
        });
    } else {
        menuItems.forEach(function(item) {
            item.classList.remove('large'); // Remove 'large' class
        });
    }
    var menuItems = document.querySelectorAll('.logoutform');
    // Toggle between two sets of styles based on the current state
    if (!isLarge) {
        menuItems.forEach(function(item) {
            item.classList.add('enlarge'); // Add 'large' class
        });
    } else {
        menuItems.forEach(function(item) {
            item.classList.remove('enlarge'); // Remove 'large' class
        });
    }
    var titleNames = document.querySelectorAll('.title'); // Select h6 elements
    // Toggle between two sets of styles based on the current state
    if (!isLarge) {
        titleNames.forEach(function(item) {
            item.classList.add('hide'); 
            item.classList.remove('show');
        });
    } else {
        titleNames.forEach(function(item) {
            item.classList.add('show');
            item.classList.remove('hide');
        });
    }
    // Toggle the state
    isLarge = !isLarge
    
}
function DashBoardFunction() {
    var dashboard = document.getElementById('body');
    var course = document.getElementById('body2');
    var evaluation = document.getElementById('body3');
    dashboard.style.position = "absolute";
    dashboard.style.visibility = "visible";
    course.style.visibility = "hidden";
}
function AccountManagement() {
    var dashboard = document.getElementById('body');
    var course = document.getElementById('body2');
    var evaluation = document.getElementById('body3');
    dashboard.style.position = "fixed";
    dashboard.style.visibility = "hidden";
    course.style.visibility = "visible";
}
// Function to toggle between iframes
function toggleIframe(iframeIdToShow, iframeIdToHide) {
    document.getElementById(iframeIdToShow).style.display = "block";
    document.getElementById(iframeIdToHide).style.display = "none";
}

// Attach event listeners to each row's Evaluation Form link for the first iframe
var evalLinks1 = document.querySelectorAll('.evaluation-link1');
evalLinks1.forEach(function(link) {
    link.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default link behavior
        toggleIframe('evaluationFormFrame1', 'evaluationFormFrame2'); // Show iframe 1 and hide iframe 2
    });
});

// Attach event listeners to each row's Evaluation Form link for the second iframe
var evalLinks2 = document.querySelectorAll('.evaluation-link2');
evalLinks2.forEach(function(link) {
    link.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default link behavior
        toggleIframe('evaluationFormFrame2', 'evaluationFormFrame1'); // Show iframe 2 and hide iframe 1
    });
});

function EvaluationFunction(button) {
    var dashboard = document.getElementById('body');
    var course = document.getElementById('body2');
    var evaluation = document.getElementById('body3');
    dashboard.style.position = "fixed";
    dashboard.style.visibility = "hidden";
    course.style.visibility = "hidden";
    evaluation.style.visibility = "visible";
    
    // Disable the button after it's clicked
    button.disabled = true;
}

