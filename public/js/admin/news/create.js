$(document).ready(function() {
    $('#short_content').summernote({
        height: 100
    });
    $('#body').summernote({
        height: 300
    });
    $('#choose_tags').select2({
        tags: true,
    });
    $('#choose_category').select2();
});
