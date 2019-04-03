$(document).ready(function () {
    const ACCEPTED = '0';
    const REVISION = '1';
    const REJECTED = '2';
    const url = '/conf';
    console.log(url);
    $('#add_reviewer').select2();
    $('#decision_paper').select2();
    /**
     * AJAX SETUP
     */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#record_decision').click(function () {
        let conferenceId = $(this).data('conference_id');
        let paperId = $(this).data('paper_id');
        let trackDirectorId = $(this).data('track_director_id');
        console.log(paperId);
        let formData = {
            paper_id: paperId,
            track_director_id: trackDirectorId,
            decision: $('#decision_paper').val(),
        };
        $.ajax({
            url: url + '/' + conferenceId + '/track_director/paper/decision/' + paperId,
            type: "POST",
            dataType: 'json',
            data: formData,
            success: function(data) {
                console.log(data);
                console.log(data.decision);
                switch (data.decision) {
                    case ACCEPTED:
                        toastr.success('Accepted At ' + data.date_decided.date);
                        $('#last_decided').attr('class', 'text-green').text('Accepted At ' + data.date_decided.date);
                        break;
                    case REVISION:
                        toastr.success('Revision At ' + data.date_decided.date);
                        $('#last_decided').attr('class', 'text-yellow').text('Revision At ' + data.date_decided.date);
                        break;
                    case REJECTED:
                        toastr.success('Rejected At ' + data.date_decided.date);
                        $('#last_decided').attr('class', 'text-red').text('Rejected At ' + data.date_decided.date);
                        break;
                }
                console.log('change');
            },
            error: function (data) {
                console.log('Error', data);
            }
        });
    });
});
