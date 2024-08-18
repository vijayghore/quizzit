// public/js/global.js
document.addEventListener('DOMContentLoaded', function () {
    $('.select2').select2();

    $('.select2').on('select2:open', function() {
        $('.select2-search__field').attr('placeholder', 'Search here...');
    });
});
