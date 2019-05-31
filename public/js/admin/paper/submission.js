$(document).ready(function () {
    const ACCEPTED = '0';
    const REVISION = '1';
    const REJECTED = '2';
    const url = '/admin/conf';
    console.log(url);
    $('#add_reviewer').select2();
    $('#decision_paper').select2();
    $('.review_deadline').datetimepicker({
        'format': 'YYYY/MM/DD',
    });
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
            url: url + '/' + conferenceId + '/paper/decision/' + paperId,
            type: "POST",
            dataType: 'json',
            data: formData,
            success: function(data) {
                console.log(data);
                console.log(data.decision);
                switch (data.decision) {
                    case ACCEPTED:
                        toastr.success('Accepted At ' + data.date_decided.date);
                        $('#last_decided').attr('class', 'text-green').text('Accepted At' + data.date_decided.date);
                        $('#edit_decision_histories').prepend('<span class="text-green">Accepted At ' + data.date_decided.date + ' By ' + data.user.user_name +  '</span>');
                        $('#send_mail_author').html('<a href="'+ $('#send_mail_author').data('link') + '?email_key=SUBMISSION_PAPER_ACCEPT' +'">'+
                        '<button class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send'+
                        '</button>'+
                        '</a>');
                        break;
                    case REVISION:
                        toastr.success('Revision At ' + data.date_decided.date);
                        $('#last_decided').attr('class', 'text-yellow').text('Revision At ' + data.date_decided.date);
                        $('#edit_decision_histories').prepend('<span class="text-yellow">Revision At ' + data.date_decided.date + ' By ' + data.user.user_name +  '</span>');
                        $('#send_mail_author').html('<a href="'+ $('#send_mail_author').data('link') + '?email_key=SUBMISSION_PAPER_REVISE' +'">'+
                            '<button class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send'+
                            '</button>'+
                            '</a>');
                        break;
                    case REJECTED:
                        toastr.success('Rejected At ' + data.date_decided.date);
                        $('#last_decided').attr('class', 'text-red').text('Rejected At ' + data.date_decided.date);
                        $('#edit_decision_histories').prepend('<span class="text-red">Rejected At ' + data.date_decided.date + ' By ' + data.user.user_name +  '</span>');
                        $('#send_mail_author').html('<a href="'+ $('#send_mail_author').data('link') + '?email_key=SUBMISSION_PAPER_DECLINE' +'">'+
                            '<button class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send'+
                            '</button>'+
                            '</a>');
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
