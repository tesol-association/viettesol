$(document).ready(function() {
    var table = $('#paper_list').DataTable({
        'order': [[0, 'desc']],
        responsive: true,
        //Setup - add a select to each footer cell
        initComplete: function () {
            this.api().columns().every( function (i) {
                if (i == 3 || i == 4){
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

    // Setup - add a text input to each footer cell
    $('#paper_list .filters td').each( function (i) {
        if(i == 1){
            var title = $('#paper_list thead th').eq( $(this).index() ).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        }
    } );

    // Apply the search
    table.columns().eq( 0 ).each( function ( colIdx ) {
        $( 'input', $('.filters td')[colIdx] ).on( 'keyup change', function () {
            table
                .column( colIdx )
                .search( this.value )
                .draw();
        } );
    } );
});
