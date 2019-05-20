  function getData(){
  	var roomName= $('#room :selected').text();

  	$.ajax({
  		url: "getTable",
  		headers: {
  			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  		},
  		type: 'get',
  		dataType: 'json',
  		data: {
  			_token : $('meta[name="csrf-token"]').attr('content')
  		},
  		success:function(res) {
  			if(res.status==true){
  				$('#conferenceId').val(res.conference_id);
  				renderScheduleTable(res);
  			}else{
					//console.log('hết paper để xếp');
					$('#schedule_list').html('<h2 style="text-align: center;">hết paper</h2>');
				}
			},error:function(res){
				console.log('Ajax call fail');
			}
		})
  }

  function selectTimeBlock(id){
  	var idPaper = id.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.innerText;
  	var timeBlockValue=document.getElementById('timeblock_'+idPaper).value;
  	var roomId=document.getElementById('room_'+idPaper).value;
  	
		//console.log(idPaper,timeBlockValue,roomId);
		var timeBlockText=$('#timeblock_'+idPaper+" :selected").text();
		//$('#timeblock_'+idPaper).attr("disabled", "disabled");
		// $("select option").each(function(){
		// 	if ($(this).text() == timeBlockText) {
		// 		$(this).attr("disabled", "disabled");
		// 	}
		// });

		$.ajax({
			url: "store",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: 'get',
			dataType: 'json',
			data: {
				_token : $('meta[name="csrf-token"]').attr('content'),
				paperId : idPaper,
				timeBlockId : timeBlockValue,
				roomId  :  roomId,
				conferenceId : $('#conferenceId').val()
			},
			success:function(res) {
				if(res.status==true){
					$('#timeblock_'+idPaper).attr("disabled", "disabled");
					$('#room_'+idPaper).attr("disabled", "disabled");
					toastr.success('Schedule has been created successfully');
				}else{
					toastr.error(res.notify);
				}
			},error:function(res){
				console.log('Ajax call fail');
			}
		})
	}

	function renderScheduleTable(res){
		var html="";
		for (var i = 0; i < res.paper.length; i++) {
			html+="<tr><td>"+ res.paper[i].id + "</td>";
			html+="<td>"+ res.paper[i].title + "</td>";
			html+="<td>"+res.paper[i].duration+" min"+"</td>";
			html+="<td><select style='width: 115%;height: 40px; margin-left:-7px' id='room_"+res.paper[i].id+"'><option>Select room</option>";
			for (var k = 0; k < res.room.length; k++) {
				html+="<option value="+res.room[k].id+">"+res.room[k].name+"</option>";
			}
			html+= "<td><select style='width: 72%;height: 40px; margin-left:20px' onchange='selectTimeBlock(this)' id='timeblock_"+res.paper[i].id+"'><option>Select time block</option>";
			for (var j = 0; j < res.timeblock.length; j++) {
				if (res.paper[i].duration > res.timeblock[j].duration) {
					html+="<option value="+res.timeblock[j].id+" disabled>"+res.timeblock[j].date+"---"+res.timeblock[j].start_time+"-"+res.timeblock[j].end_time+"</option>";
				}else{
					html+="<option value="+res.timeblock[j].id+">"+res.timeblock[j].date+"---"+res.timeblock[j].start_time+"-"+res.timeblock[j].end_time+"</option>"; 
				}
			}
			html+="</select></td></tr>";
		}
		$('#body_schedule').html(html);
	}

getData();