$(document).ready(function() {
    var table = $('#paper_list').DataTable({
        'order': [[0, 'desc']],
        responsive: true,
        //Setup - add a select to each footer cell
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
                if (i == 5){
                    var column = this;
                    var value = [];
                    var select = $('<select style="width: 100%;"><option value=""></option></select>')
                        .appendTo( $(column.footer()).empty() )
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
                            end = d.search("</span>");
                            if(end < 0){
                                break;
                            }
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
                        if(value[i].search(">") > 0){
                            value[i] = value[i].substring(value[i].search(">") + 1).trim();
                        }
                        select.append( '<option value="' + value[i] + '">' + value[i] + '</option>' );
                        console.log(value[i]);
                    }
                }
            } );
        }
    });

    // Setup - add a text input to each footer cell
    $('#paper_list .filters td').each( function (i) {
        if(i == 3){
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
