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

    $('#start_time').datetimepicker({
        'format': 'YYYY/MM/DD HH:mm',
    });

    $('#end_time').datetimepicker({
        'format': 'YYYY/MM/DD HH:mm',
        useCurrent: false, //Important! See issue #1075
    });

    $('#start_time').on("dp.change", function (e) {
        $('#end_time').data("DateTimePicker").minDate(e.date);
    });
    $('#end_time').on("dp.change", function (e) {
        $('#start_time').data("DateTimePicker").maxDate(e.date);
    });
});
