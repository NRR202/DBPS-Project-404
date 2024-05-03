document.addEventListener('DOMContentLoaded', function() {
    // Get the form elements
    var courseDropdown = document.getElementById('courses');
    var sectionDropdown = document.getElementById('sections');
    var yearLevelDropdown = document.getElementById('yearlevel');

    // Function to update the Year Level dropdown based on Course and Section selection
    function updateYearLevelOptions() {
        // Clear existing options
        yearLevelDropdown.innerHTML = '';

        // Get the selected course and section
        var selectedCourse = courseDropdown.value;
        var selectedSection = sectionDropdown.value;

        // Add default option to Year Level dropdown
        addYearLevelOption('All Year Level');

        // Logic to determine and add appropriate Year Level options based on Course and Section
        if (selectedCourse === 'BSIT' && selectedSection === 'A') {
            addYearLevelOption('1st year');
            addYearLevelOption('2nd year');
        } else if (selectedCourse === 'BSIT' && selectedSection === 'B') {
            addYearLevelOption('3rd year');
            addYearLevelOption('4th year');
        } // Add more conditions as needed for other courses and sections
    }

    // Function to add options to the Year Level dropdown
    function addYearLevelOption(value) {
        var option = document.createElement('option');
        option.text = value;
        option.value = value;
        yearLevelDropdown.add(option);
    }

    // Call the updateYearLevelOptions function when the form elements change
    if (courseDropdown && sectionDropdown && yearLevelDropdown) {
        courseDropdown.addEventListener('change', updateYearLevelOptions);
        sectionDropdown.addEventListener('change', updateYearLevelOptions);
    }
});