$(document).ready(function() {
    $('#short_content').summernote({
        height: 100
    });
    $('#body').summernote({
        height: 300
    });

    $('#expiry_date').datetimepicker({
        'format': 'YYYY/MM/DD',
    });

});
