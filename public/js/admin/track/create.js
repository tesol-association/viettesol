$(document).ready(function() {
    $('#policy').summernote({
        height: 300
    });
    $('#choose_user').select2();

    $('#keywords').select2({
        tags: true,
    });
});
