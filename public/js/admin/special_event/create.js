$(document).ready(function() {
    $('#date').datetimepicker({
        'format': 'YYYY/MM/DD',
    });

    $('#start_time').datetimepicker({
        'format': 'HH:mm',
    });

    $('#end_time').datetimepicker({
        'format': 'HH:mm',
    });

    $(document).ready(function () {
            $('#room_id').select2();
            var room_idSelected = $('#room_id').data('value');
            $('#room_id').val(countrySelected).trigger('change');
        });

});