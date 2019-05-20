$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.pb-filemng-panel-body').on('click', '.document', function(){
        $.ajax({
            url: 'get_track',
            type: "POST",
            dataType: 'json',
            success: function(data) {
                if(data.length){
                    $(".track_remove").remove();
                    $(".paper_remove").remove();
                    $(".author_remove").remove();
                    $(".reviewer_remove").remove();
                    $(".attach_file_remove").remove();
                    let folderData =[];
                    let trackId = [];
                    $.each(data, function (key, item){
                        folderData.push({
                            "icon": "<img class=\"img-responsive\" src=\"/admin/image/folder.png\">",
                            "text": item['name']
                        });
                        trackId.push(item['id']);
                    });

                    for (var key in folderData) {
                        $(".pb-filemng-template-body").append(
                            '<div class=\"track track_remove\" data-track_id=\"' + trackId[key] + '\">'+
                                '<div class=\"col-xs-6 col-sm-6 col-md-3 pb-filemng-body-folders\">' +
                                    folderData[key].icon + '<br />' +
                                    '<p class="pb-filemng-paragraphs">' + folderData[key].text + '</p>' +
                                '</div>'+
                            '</div>'
                        );
                    }
                }else{
                    $(".track_remove").remove();
                    $(".paper_remove").remove();
                    $(".author_remove").remove();
                    $(".reviewer_remove").remove();
                    $(".attach_file_remove").remove();
                    alert("No file or foder!!!");
                }
            },
            error: function (data) {
                console.log('Error', data);
                alert("Error!!!");
            }
        });
    });

    $('.pb-filemng-panel-body').on('click', '.track', function(){
        let trackId = $(this).data('track_id');
        let folderData =[];
        let paperId = [];
        $.ajax({
            url: 'track/' + trackId + '/get_paper',
            type: "POST",
            dataType: 'json',
            success: function(data) {
                if(data.length){
                    $.each(data, function (key, item){
                        folderData.push({
                            "icon": "<img class=\"img-responsive\" src=\"/admin/image/folder.png\">",
                            "text": "Paper " + item['title']
                        });
                        paperId.push(item['id']);
                    });
                    $(".track_remove").remove();
                    $(".paper_remove").remove();
                    $(".author_remove").remove();
                    $(".reviewer_remove").remove();
                    $(".attach_file_remove").remove();
                    for (var key in folderData) {
                        $(".pb-filemng-template-body").append(
                            '<div class=\"paper paper_remove\" data-track_id=\"' + trackId + '\" data-paper_id=\"' + paperId[key] + '\">'+
                                '<div class=\"col-xs-6 col-sm-6 col-md-3 pb-filemng-body-folders\">' +
                                    folderData[key].icon + '<br />' +
                                    '<p class="pb-filemng-paragraphs">' + folderData[key].text + '</p>' +
                                '</div>'+
                            '</div>'
                        );
                    }
                }else{
                    $(".track_remove").remove();
                    $(".paper_remove").remove();
                    $(".author_remove").remove();
                    $(".reviewer_remove").remove();
                    $(".attach_file_remove").remove();
                    alert("No file or foder!!!");
                }
            },
            error: function (data) {
                console.log('Error', data);
                alert("Error!!!");
            }
        });
    });

    $('.pb-filemng-panel-body').on('click', '.paper', function(){
        let trackId = $(this).data('track_id');
        let paperId = $(this).data('paper_id');
        let folderDataAuthor =[];
        let folderDataReviewer =[];
        let reviewerId = [];
        let authorId = [];
        $(".author_remove").remove();
        $(".reviewer_remove").remove();
        $.ajax({
            url: 'track/' + trackId + '/paper/' + paperId + '/get_author',
            type: "POST",
            dataType: 'json',
            success: function(data) {
                if(data.length){
                    $.each(data, function (key, item){
                        if(item["pivot"] != null && item["pivot"]["seq"] == 0){
                            folderDataAuthor.push({
                                "icon": "<img class=\"img-responsive\" src=\"/admin/image/folder.png\">",
                                "text": "Author " + item['first_name'] + ' ' + item['middle_name'] + ' ' + item['last_name']
                            });
                            authorId.push(item['id']);
                        };
                    });
                    $(".track_remove").remove();
                    $(".paper_remove").remove();
                    $(".attach_file_remove").remove();
                    for (var key in folderDataAuthor) {
                        $(".pb-filemng-template-body").append(
                            '<div class=\"author author_remove\" data-track_id=\"' + trackId + '\" data-paper_id=\"' + paperId + '\" data-author_id=\"' + authorId[key] + '\">'+
                                '<div class=\"col-xs-6 col-sm-6 col-md-3 pb-filemng-body-folders\">' +
                                    folderDataAuthor[key].icon + '<br />' +
                                    '<p class="pb-filemng-paragraphs">' + folderDataAuthor[key].text + '</p>' +
                                '</div>'+
                            '</div>'
                        );
                    }
                }else{
                    $(".track_remove").remove();
                    $(".paper_remove").remove();
                    $(".attach_file_remove").remove();
                }
            },
            error: function (data) {
                console.log('Error', data);
                alert("Error!!!");
            }
        });

        $.ajax({
            url: 'track/' + trackId + '/paper/' + paperId + '/get_reviewer',
            type: "POST",
            dataType: 'json',
            success: function(data) {
                if(data.length){
                    $.each(data, function (key, item){
                        folderDataReviewer.push({
                            "icon": "<img class=\"img-responsive\" src=\"/admin/image/folder.png\">",
                            "text": "Reviewer " + item['first_name'] + ' ' + item['middle_name'] + ' ' + item['last_name']
                        });
                        reviewerId.push(item['id']);
                    });
                    $(".track_remove").remove();
                    $(".paper_remove").remove();
                    $(".attach_file_remove").remove();
                    for (var key in folderDataReviewer) {
                        $(".pb-filemng-template-body").append(
                            '<div class=\"reviewer reviewer_remove\" data-track_id=\"' + trackId + '\" data-paper_id=\"' + paperId + '\" data-reviewer_id=\"' + reviewerId[key] + '\">'+
                                '<div class=\"col-xs-6 col-sm-6 col-md-3 pb-filemng-body-folders\">' +
                                    folderDataReviewer[key].icon + '<br />' +
                                    '<p class="pb-filemng-paragraphs">' + folderDataReviewer[key].text + '</p>' +
                                '</div>'+
                            '</div>'
                        );
                    }
                }else{
                    $(".track_remove").remove();
                    $(".paper_remove").remove();
                    $(".attach_file_remove").remove();
                }
            },
            error: function (data) {
                console.log('Error', data);
                alert("Error!!!");
            }
        });
    });

    $('.pb-filemng-panel-body').on('click', '.author', function(){
        let trackId = $(this).data('track_id');
        let paperId = $(this).data('paper_id');
        let authorId = $(this).data('author_id');
        let folderData =[];
        let link = [];
        $.ajax({
            url: 'track/' + trackId + '/paper/' + paperId + '/author/' + authorId + '/get_attach_file',
            type: "POST",
            dataType: 'json',
            success: function(data) {
                if(data.length){
                    $.each(data, function (key, item){
                        if(item != null){
                            if(item['file_type'] == "7z" || item['file_type'] == "zip" || item['file_type'] == "rar"){
                                folderData.push({
                                    "icon": "<img class=\"img-responsive\" src=\"/admin/image/zip-rar-7z.png\">",
                                    "text": item['original_file_name']
                                });
                            }else if(item['file_type'] == "docx"){
                                folderData.push({
                                    "icon": "<img class=\"img-responsive\" src=\"/admin/image/word.png\">",
                                    "text": item['original_file_name']
                                });
                            }else if(item['file_type'] == "xlsx"){
                                folderData.push({
                                    "icon": "<img class=\"img-responsive\" src=\"/admin/image/excel.png\">",
                                    "text": item['original_file_name']
                                });
                            }else if(item['file_type'] == "pptx"){
                                folderData.push({
                                    "icon": "<img class=\"img-responsive\" src=\"/admin/image/ppt.png\">",
                                    "text": item['original_file_name']
                                });
                            }else if(item['file_type'] == "pdf"){
                                folderData.push({
                                    "icon": "<img class=\"img-responsive\" src=\"/admin/image/pdf.png\">",
                                    "text": item['original_file_name']
                                });
                            }else{
                                folderData.push({
                                    "icon": "<img class=\"img-responsive\" src=\"/admin/image/file.png\">",
                                    "text": item['original_file_name']
                                });
                            }

                            link.push(item['path']);
                        }
                    });
                    $(".track_remove").remove();
                    $(".paper_remove").remove();
                    $(".author_remove").remove();
                    $(".reviewer_remove").remove();
                    $(".attach_file_remove").remove();
                    for (var key in folderData) {
                        $(".pb-filemng-template-body").append(
                            '<div class=\"attach_file attach_file_remove\" data-track_id=\"' + trackId + '\" data-paper_id=\"' + paperId + '\" data-author_id=\"' + authorId + '\">'+
                                '<div class=\"col-xs-6 col-sm-6 col-md-3 pb-filemng-body-folders\">' +
                                    folderData[key].icon + '<br />' +
                                    '<a target=\"_blank\" href=\"/storage/' + link[key] + '\">' + '<p class="pb-filemng-paragraphs">' + folderData[key].text + '</p></a>' +
                                '</div>'+
                            '</div>'
                        );
                    }
                }else{
                    $(".track_remove").remove();
                    $(".paper_remove").remove();
                    $(".author_remove").remove();
                    $(".reviewer_remove").remove();
                    $(".attach_file_remove").remove();
                    alert("No file or foder!!!");
                }
            },
            error: function (data) {
                console.log('Error', data);
                alert("Error!!!");
            }
        });
    });

    $('.pb-filemng-panel-body').on('click', '.reviewer', function(){
        let trackId = $(this).data('track_id');
        let paperId = $(this).data('paper_id');
        let reviewerId = $(this).data('reviewer_id');
        let folderData =[];
        let link = [];
        $.ajax({
            url: 'track/' + trackId + '/paper/' + paperId + '/reviewer/' + reviewerId + '/get_attach_file',
            type: "POST",
            dataType: 'json',
            success: function(data) {
                if(data.length){
                    $.each(data, function (key, item){
                        if(item != null){
                            if(item['file_type'] == "7z" || item['file_type'] == "zip" || item['file_type'] == "rar"){
                                folderData.push({
                                    "icon": "<img class=\"img-responsive\" src=\"/admin/image/zip-rar-7z.png\">",
                                    "text": item['original_file_name']
                                });
                            }else if(item['file_type'] == "docx"){
                                folderData.push({
                                    "icon": "<img class=\"img-responsive\" src=\"/admin/image/word.png\">",
                                    "text": item['original_file_name']
                                });
                            }else if(item['file_type'] == "xlsx"){
                                folderData.push({
                                    "icon": "<img class=\"img-responsive\" src=\"/admin/image/excel.png\">",
                                    "text": item['original_file_name']
                                });
                            }else if(item['file_type'] == "pptx"){
                                folderData.push({
                                    "icon": "<img class=\"img-responsive\" src=\"/admin/image/ppt.png\">",
                                    "text": item['original_file_name']
                                });
                            }else if(item['file_type'] == "pdf"){
                                folderData.push({
                                    "icon": "<img class=\"img-responsive\" src=\"/admin/image/pdf.png\">",
                                    "text": item['original_file_name']
                                });
                            }else{
                                folderData.push({
                                    "icon": "<img class=\"img-responsive\" src=\"/admin/image/file.png\">",
                                    "text": item['original_file_name']
                                });
                            }

                            link.push(item['path']);
                        }
                    });
                    $(".track_remove").remove();
                    $(".paper_remove").remove();
                    $(".author_remove").remove();
                    $(".reviewer_remove").remove();
                    $(".attach_file_remove").remove();
                    for (var key in folderData) {
                        $(".pb-filemng-template-body").append(
                            '<div class=\"attach_file attach_file_remove\" data-track_id=\"' + trackId + '\" data-paper_id=\"' + paperId + '\" data-author_id=\"' + reviewerId + '\">'+
                                '<div class=\"col-xs-6 col-sm-6 col-md-3 pb-filemng-body-folders\">' +
                                    folderData[key].icon + '<br />' +
                                    '<a target=\"_blank\" href=\"/storage/' + link[key] + '\">' + '<p class="pb-filemng-paragraphs">' + folderData[key].text + '</p></a>' +
                                '</div>'+
                            '</div>'
                        );
                    }
                }else{
                    $(".track_remove").remove();
                    $(".paper_remove").remove();
                    $(".author_remove").remove();
                    $(".reviewer_remove").remove();
                    $(".attach_file_remove").remove();
                    alert("No file or foder!!!");
                }
            },
            error: function (data) {
                console.log('Error', data);
                alert("Error!!!");
            }
        });
    });
});
