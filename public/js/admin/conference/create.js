$(document).ready(function() {
    $('#start_time').datetimepicker({
        'format': 'YYYY/MM/DD',
    });

    $('#end_time').datetimepicker({
        'format': 'YYYY/MM/DD',
        useCurrent: false, //Important! See issue #1075
    });

    $('#start_time').on("dp.change", function (e) {
        $('#end_time').data("DateTimePicker").minDate(e.date);
    });
    $('#end_time').on("dp.change", function (e) {
        $('#start_time').data("DateTimePicker").maxDate(e.date);
    });
});
