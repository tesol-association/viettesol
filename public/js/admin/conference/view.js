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
    //ChartJs
    // var adminChart = new Chart($('#admin_chart'), {
    //     type: 'pie',
    //     data: {
    //         labels: ['Submitted', 'InReview', 'ReviewResult', 'ReJected', 'Revision', 'Accepted', 'Unscheduled', 'Scheduled'],
    //         datasets: [{
    //             backgroundColor: [
    //                 '#cceeff',
    //                 '#66ccff',
    //                 '#0000ff',
    //                 '#ff0000',
    //                 '#ff9933',
    //                 '#33cc33',
    //                 '#ffff00',
    //                 '#660066',
    //             ],
    //           data: [paperSubmitted, paperInReview, paperReviewResult, paperReJected, paperRevision, paperAccepted, paperUnscheduled, paperScheduled]
    //         }]
    //     },
    //     options: {
    //         title: {
    //             display: true,
    //             fontColor: 'black',
    //             fontFamily: 'sans-serif',
    //             fontSize: 20,
    //             text: 'Paper Status'
    //         },
    //         responsive: true,
    //         legend: {
    //             position: 'right',
    //             fontFamily: 'sans-serif',
    //             fontSize: 20,
    //             display: true,
    //         },
    //     }
    // });
});
