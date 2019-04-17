$(document).ready(function() {
    var rusult = $('#paper_result_list').DataTable({
        'order': [[0, 'desc']],
        initComplete: function () {
            this.api().columns().every( function (i) {
                if (i == 3){
                    var column = this;
                    var select = $('<select style="width: 100%;"><option value=""></option></select>')
                        .appendTo( $(column.header()).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } ).select2();

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                }
                if (i == 4){
                    var column = this;
                    var value = [];
                    var select = $('<select style="width: 100%;"><option value=""></option></select>')
                        .appendTo( $(column.header()).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search( val ? '^(.*)'+val+'(.*)$' : '', true, false )
                                .draw();
                        } ).select2();

                    column.data().unique().sort().each( function ( d, j ) {
                        let begin, end;
                        while(true){
                            let test = true;
                            begin = d.search(">");
                            d = d.substring(begin).trim();
                            end = d.search("<");
                            for (var i = 0; i < value.length; i++) {
                                if(value[i] == (d.substring(1, end).trim())){
                                    test = false;
                                    break;
                                }
                            }
                            if(test){
                                value.push(d.substring(1, end).trim());
                            }
                            d = d.substring(end).trim();
                            if(d.length < 8)
                                break;
                        }

                    } );
                    for (var i = 0; i < value.length; i++) {
                        select.append( '<option value="' + value[i] + '">' + value[i] + '</option>' );
                    }
                }
            } );
        }
    });

    var unschedule = $('#paper_unschedule_list').DataTable({
        'order': [[0, 'desc']],
        initComplete: function () {
            this.api().columns().every( function (i) {
                if (i == 3){
                    var column = this;
                    var select = $('<select style="width: 100%;"><option value=""></option></select>')
                        .appendTo( $(column.header()).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } ).select2();

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                }
            } );
        }
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
                    '<a target="_blank" href="view/' + data.id + '">' + data.title + '</a>',
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
                    '<a target="_blank" href="view/' + data.id + '">' + data.title + '</a>',
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

    // Setup - add a text input to each footer cell
    $('#paper_result_list .filter_result td').each( function (i) {
        if(i == 1){
            var title_result = $('#paper_result_list thead th').eq( $(this).index() ).text();
            $(this).html( '<input type="text" placeholder="Search '+title_result+'" />' );
        }
    } );
    $('#paper_unschedule_list .filter_unschedule td').each( function (i) {
        if(i == 1){
            var title_unchedule = $('#paper_unschedule_list thead th').eq( $(this).index() ).text();
            $(this).html( '<input type="text" placeholder="Search '+title_unchedule+'" />' );
        }
    } );

    // Apply the search
    rusult.columns().eq( 0 ).each( function ( colIdx ) {
        $( 'input', $('.filter_result td')[colIdx] ).on( 'keyup change', function () {
            rusult
                .column( colIdx )
                .search( this.value )
                .draw();
        } );
    });
    unschedule.columns().eq( 0 ).each( function ( colIdx ) {
        $( 'input', $('.filter_unschedule td')[colIdx] ).on( 'keyup change', function () {
            unschedule
                .column( colIdx )
                .search( this.value )
                .draw();
        } );
    });
});
