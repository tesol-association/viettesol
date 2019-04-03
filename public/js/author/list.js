$(document).ready(function() {
    $('#author_list').DataTable({
        'order': [[0, 'desc']],
    });
    $('.country').select2();
    var countrySelected = $('.country').data('value');
    $('.country').val(countrySelected).trigger('change');
});
