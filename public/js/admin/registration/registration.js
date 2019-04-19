function updateStatus(id) {
	var idRegister= id.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.innerText;
	$.ajax({
		url: "update",
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type: 'get',
		dataType: 'json',
		data: {
			_token : $('meta[name="csrf-token"]').attr('content'),
			id     : idRegister,
			status : 'approved'
		},
		success:function(res) {
			if(res.status==true){
				toastr.success('duyệt thành công');
			}else{
				toastr.error('error');
			}
		},error:function(res){
			console.log('Ajax call fail');
		}
	})
}