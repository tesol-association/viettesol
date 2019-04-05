$(document).ready(function() {
    $('#paper_list').DataTable({
        'order': [[0, 'desc']],
    });
    $('.country').select2();

    $('.full_paper').summernote({
        height: 300
    });
});
