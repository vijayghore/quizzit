// public/js/global.js
document.addEventListener('DOMContentLoaded', function () {
    // const selectElements = document.querySelectorAll('.select2');

    // selectElements.forEach(select => {
    //     // Initialize Select2 on each element
    //     new Select2(select, {
    //         placeholder: "Select...",
    //         allowClear: true
    //     });
    // });

    var element = document.getElementById('subject_id');
    new Choices(element, {
        searchEnabled: true,
        itemSelectText: '',
        placeholderValue: 'Select Subject'
    });
});
