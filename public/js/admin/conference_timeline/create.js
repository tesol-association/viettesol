$(document).ready(function() {
    $('#author_registration_opened').datetimepicker({
        'format': 'YYYY/MM/DD',
    });

    $('#author_registration_closed').datetimepicker({
        'format': 'YYYY/MM/DD',
        useCurrent: false, //Important! See issue #1075
    });

    $('#author_registration_opened').on("dp.change", function (e) {
        $('#author_registration_closed').data("DateTimePicker").minDate(e.date);
    });
    $('#author_registration_closed').on("dp.change", function (e) {
        $('#author_registration_opened').data("DateTimePicker").maxDate(e.date);
    });

    $('#submission_accepted').datetimepicker({
        'format': 'YYYY/MM/DD',
    });

    $('#submission_closed').datetimepicker({
        'format': 'YYYY/MM/DD',
        useCurrent: false, //Important! See issue #1075
    });

    $('#submission_accepted').on("dp.change", function (e) {
        $('#submission_closed').data("DateTimePicker").minDate(e.date);
    });
    $('#submission_closed').on("dp.change", function (e) {
        $('#submission_accepted').data("DateTimePicker").maxDate(e.date);
    });


    $('#reviewer_registration_opened').datetimepicker({
        'format': 'YYYY/MM/DD',
    });

    $('#reviewer_registration_closed').datetimepicker({
        'format': 'YYYY/MM/DD',
        useCurrent: false, //Important! See issue #1075
    });

    $('#reviewer_registration_opened').on("dp.change", function (e) {
        $('#reviewer_registration_closed').data("DateTimePicker").minDate(e.date);
    });
    $('#reviewer_registration_closed').on("dp.change", function (e) {
        $('#reviewer_registration_opened').data("DateTimePicker").maxDate(e.date);
    });

    $('#review_deadline').datetimepicker({
        'format': 'YYYY/MM/DD',
    });
});
