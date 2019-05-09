$(document).ready(function() {
    var paperSubmitted = $('#admin_chart').data('paper_submitted');
    var paperInReview = $('#admin_chart').data('paper_submitted');
    var paperReviewResult = $('#admin_chart').data('paper_review_result');
    var paperReJected = $('#admin_chart').data('paper_rejected');
    var paperRevision = $('#admin_chart').data('paper_revision');
    var paperAccepted = $('#admin_chart').data('paper_accepted');
    var paperUnscheduled = $('#admin_chart').data('paper_un_schedule');
    var paperScheduled = $('#admin_chart').data('paper_schedule');

    //canvasJs
    window.onload = function () {
        var chart = new CanvasJS.Chart("admin_chart", {
            exportEnabled: true,
            animationEnabled: true,
            title:{
                text: "Paper Status"
            },
            legend:{
                cursor: "pointer",
                itemclick: explodePie,
            },
            data: [{
                type: "pie",
                showInLegend: true,
                toolTipContent: "{name}: <strong>{y} paper</strong>",
                indexLabel: "{name} - {y} paper",
                dataPoints: [
                    { y: paperSubmitted, name: "Submitted", exploded: true },
                    { y: paperInReview, name: "In Review" },
                    { y: paperReviewResult, name: "Review Result" },
                    { y: paperReJected, name: "ReJected" },
                    { y: paperRevision, name: "Revision" },
                    { y: paperAccepted, name: "Accepted" },
                    { y: paperUnscheduled, name: "Unscheduled"},
                    { y: paperScheduled, name: "Scheduled"}
                ]
            }]
        });
        chart.render();
    }

    function explodePie (e) {
        if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
            e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
        } else {
            e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
        }
        e.chart.render();
    }

    var table = $('#paper_submitted').DataTable({
        'order': [[0, 'desc']],
        responsive: true,
        //Setup - add a select to each footer cell
        initComplete: function () {
            this.api().columns().every( function (i) {
                if (i == 2){
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
    $('#paper_submitted .filters td').each( function (i) {
        if(i == 1){
            var title = $('#paper_submitted thead th').eq( $(this).index() ).text();
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

    var table = $('#paper_review_result').DataTable({
        'order': [[0, 'desc']],
        responsive: true,
        //Setup - add a select to each footer cell
        initComplete: function () {
            this.api().columns().every( function (i) {
                if (i == 2){
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
    $('#paper_review_result .filters td').each( function (i) {
        if(i == 1){
            var title = $('#paper_review_result thead th').eq( $(this).index() ).text();
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

    var table = $('#paper_accept_rivision_reject').DataTable({
        'order': [[0, 'desc']],
        responsive: true,
        //Setup - add a select to each footer cell
        initComplete: function () {
            this.api().columns().every( function (i) {
                if (i == 2 || i == 3){
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
    $('#paper_accept_rivision_reject .filters td').each( function (i) {
        if(i == 1){
            var title = $('#paper_accept_rivision_reject thead th').eq( $(this).index() ).text();
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
