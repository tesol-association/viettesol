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

    var table = $('#access_list').DataTable({
        'order': [[1, 'desc']],
        responsive: true,
        initComplete: function () {
            this.api().columns().every( function (i) {
                if (i == 1){
                    var column = this;
                    var select = $('<select style="width: 100%;"><option value=""></option></select>')
                        .appendTo( $(column.footer()).empty() )
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

    $('#access_list .filters td').each( function (i) {
        if(i == 2){
            var title = $('#access_list thead th').eq( $(this).index() ).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        }
    } );

    table.columns().eq( 0 ).each( function ( colIdx ) {
        $( 'input', $('.filters td')[colIdx] ).on( 'keyup change', function () {
            table
                .column( colIdx )
                .search( this.value )
                .draw();
        } );
    });
});

