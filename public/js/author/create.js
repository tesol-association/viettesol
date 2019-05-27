$(document).ready(function () {
    $('#track_id').select2();
    $('#session_type_id').select2();

    $('#country').select2();
    var countrySelected = $('#country').data('value');
    $('#country').val(countrySelected).trigger('change');

    $('#abstract').summernote({
        height: 300
    });

    $('#keywords').select2({
        tags: true,
    });
});
