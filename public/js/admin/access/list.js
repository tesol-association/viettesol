$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.allow_btn').change(function() {
        let accessId = $(this).data('access-id');
        console.log(accessId);
        let conferenceId = $('#conference_id').val();
        let formData = {
            conference_id: conferenceId,
            access_id: accessId,
        };
        $.ajax({
            url: '/conf/' + conferenceId + '/acl/access_allow',
            type: "POST",
            dataType: 'json',
            data: formData,
            success: function(data) {
                console.log(data);
                $(this).prop('checked');
                toastr.success('update successfull !');
            },
            error: function (data) {
                console.log('Error', data);
                toastr.error('update successfull !');
            }
        });
    });

    $('#access_list').DataTable({
        'order': [[1, 'desc']],
        responsive: true,
    });

});

