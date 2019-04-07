$(document).ready(function () {
    $('.country').select2();
    $('.edit_author').click(function() {
        let authorId = $(this).data('author-id');
        var countrySelected = $('#author_' + authorId + '_country').data('value');
        $('#author_' + authorId + '_country').val(countrySelected).trigger('change');
    });

    $('#abstract').summernote({
        height: 300
    })
});
