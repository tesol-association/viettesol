function getAll(){
     var all= document.getElementById("all");

                // Lấy danh sách checkbox
                var checkboxes = document.getElementsByName('status[]');

                // Lặp và thiết lập checked
                if(all.checked==false){
                  for (var i = 0; i < checkboxes.length; i++){
                        checkboxes[i].checked = false;
                  }
                  $.ajax({
                        url: "updateAll",
                        headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'get',
                        dataType: 'json',
                        data: {
                            _token : $('meta[name="csrf-token"]').attr('content'),
                            status : 'pending'
                      },
                      success:function(res) {
                            if(res.status==true){
                                 toastr.success('duyệt tất cả thành công');
                           }
                     },error:function(res){
                        console.log('Ajax call fail');
                  }
            })
            }
            else{
                  for (var i = 0; i < checkboxes.length; i++){
                        checkboxes[i].checked = true;
                  }
                  $.ajax({
                        url: "updateAll",
                        headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'get',
                        dataType: 'json',
                        data: {
                            _token : $('meta[name="csrf-token"]').attr('content'),
                            status : 'approved'
                      },
                      success:function(res) {
                            if(res.status==true){
                                 toastr.success('duyệt tất cả thành công');
                           }
                     },error:function(res){
                        console.log('Ajax call fail');
                  }
            })
            }

      }

      function updateStatus(id){
          var idComment = id.parentElement.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.innerText;
          var _status= document.getElementById('status_'+idComment);
		//var statusValue=_status.value;
            // if(_status.checked==false){
            //       var statusValue='approved';
            // }else{
            //       var statusValue='pending';
            // }
            if(_status.checked){ 
                  var statusValue='approved';
            }else{
                  var statusValue='pending';
            }
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
