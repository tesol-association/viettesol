
	function updateStatus(id){
		var idComment = id.parentElement.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.innerText;
		var _status= document.getElementById('status_'+idComment);
		var statusValue=_status.value;
            console.log(statusValue,idComment);
		 $.ajax({
            	url: "update",
            	headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
            	type: 'get',
            	dataType: 'json',
            	data: {
            		_token : $('meta[name="csrf-token"]').attr('content'),
            		id     : idComment,
            		status : statusValue
            	},
            	success:function(res) {
            		if(res.status==true){
            			toastr.success('duyệt thành công');
            		  }
			  	},error:function(res){
                        console.log('Ajax call fail');
			  	}
            })
	}
