$(document).ready(function () {
    $('#country').select2();
    var countrySelected = $('#country').data('value');
    $('#country').val(countrySelected).trigger('change');

    $('#abstract').summernote({
        height: 300
    })
});
