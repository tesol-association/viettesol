$(document).ready(function() {
    $('#paper_list').DataTable({
        'order': [[0, 'desc']],
    });
    $('.country').select2();
    var countrySelected = $('.country').data('value');
    $('.country').val(countrySelected).trigger('change');

    $('.full_paper').summernote({
        height: 300
    });
});
