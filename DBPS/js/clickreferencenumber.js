function switchFunction(){
    var dis1 = document.getElementById('display1');
    var dis2 = document.getElementById('display2');
    dis1.style.visibility = "hidden";
    dis2.style.visibility = "visible";

}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
function switchFunction(referenceNum) {
    // Send the referenceNum value to a PHP script via AJAX
    $.ajax({
        url: 'process_reference.php', // PHP script to handle the referenceNum value
        method: 'POST',
        data: { referenceNum: referenceNum }, // Send referenceNum as POST data
        success: function(response) {
            // Handle the response from the PHP script if needed
            console.log('Response from PHP:', response);
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            // Optionally, display an error message to the user
        }
    });
}