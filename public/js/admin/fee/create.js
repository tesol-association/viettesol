$(document).ready(function() {
    $('#time').datetimepicker({
        'format': 'YYYY/MM/DD',
    });
    $('.box-body').on('click', '.remove_category', function() {
      $('.remove_category').closest('.box-body').find('.form-category').not(':first').last().remove();
    });
    $('.box-body').on('click', '.add_category', function() {
      $('.add_category').closest('.box-body').find('.form-category').first().clone().appendTo('.results');
    });
});
