$(document).ready(function() {
    var rusult = $('#paper_result_list').DataTable({
        'order': [[0, 'desc']],
    });

    var unschedule = $('#paper_unschedule_list').DataTable({
        'order': [[0, 'desc']],
    });
    var accepted = 'accepted';
    var revision = 'revision';
    var rejected = 'rejected';

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#paper_result_list tbody').on('click', '.btn_paper_result', function(){
        let conferenceId = $(this).data('conference_id');
        let paperId = $(this).data('paper_id');
        console.log(conferenceId);
        console.log(paperId);
        rusult.row($(this).parents('tr')).remove().draw();
        let attachFile = '';
        let formData = {
            paper_id: paperId,
        };
        $.ajax({
            url: '/conf/' + conferenceId + '/director/paper/change_paper_un_schedule/' + paperId,
            type: "POST",
            dataType: 'json',
            data: formData,
            success: function(data) {
                console.log(data);
                if (data.file_id){
                    attachFile = attachFile + '<a target="_blank" href="{{ asset("/storage/" . ' + data.attachFile.path + '" class="btn btn-primary"><span class="fa fa-download"></span>' + data.attachFile.original_file_name + '</a>'
                }
                unschedule.row.add([
                    data.id,
                    data.title,
                    data.abstract,
                    attachFile,
                    data.track.name ,
                    '<span class="label label-primary">' + data.status + ' Paper</span>',
                    data.created_at,
                    '<button type="button" class="btn_paper_unchedule btn btn-danger"  data-conference_id="' + conferenceId + '" data-paper_id="' + data.id + '"> <i class="fa fa-minus"></i></button>'
                    ]).draw(false);
                toastr.success('Paper ' + data.title + ' changed ' + data.status + ' successfull');
            },
            error: function (data) {
                console.log('Error', data);
            }
        });
    });

    $('#paper_unschedule_list tbody').on('click', '.btn_paper_unchedule', function(){
        let conferenceId = $(this).data('conference_id');
        let paperId = $(this).data('paper_id');
        console.log(conferenceId);
        console.log(paperId);
        unschedule.row($(this).parents('tr')).remove().draw();
        let attachFile = '';
        let statusClass = '';
        let formData = {
            paper_id: paperId,
        };
        $.ajax({
            url: '/conf/' + conferenceId + '/director/paper/change_paper_redo_un_schedule/' + paperId,
            type: "POST",
            dataType: 'json',
            data: formData,
            success: function(data) {
                console.log(data);
                switch (data.status) {
                    case (accepted):
                        statusClass = statusClass + 'label label-success';
                        break;
                    case (revision):
                        statusClass = statusClass + 'label label-info';
                        break;
                    case (rejected):
                        statusClass = statusClass + 'label label-danger';
                        break;
                }
                rusult.row.add([
                    data.id,
                    data.title,
                    data.abstract,
                    attachFile,
                    data.track.name ,
                    '<span class="' + statusClass + '">' + data.status + ' Paper</span>',
                    data.created_at,
                    '<button type="button" class="btn_paper_result btn btn-primary"  data-conference_id="' + conferenceId + '" data-paper_id="' + data.id + '"> <i class="fa fa-plus"></i></button>'
                    ]).draw(false);
                toastr.success('Paper ' + data.title + ' changed ' + data.status + ' successfull');
            },
            error: function (data) {
                console.log('Error', data);
            }
        });
    });
});
