$(document).ready(function() {
    var table = $('#user_conference_role_list').DataTable({
        'order': [[0, 'desc']],
        initComplete: function () {
            this.api().columns().every( function (i) {
                if (i == 3 ){
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

    $('#user_conference_role_list .filters td').each( function (i) {
        if(i == 0 || i == 1 || i == 2){
            var title = $('#user_conference_role_list thead th').eq( $(this).index() ).text();
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

    $('.role_name').select2();
});
