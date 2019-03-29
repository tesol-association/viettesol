            function getCalendarConference(){
              $.ajax({
                  url: "getDataConference",
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
                          renderCalendar(res.conference);
                    }else{
                         var event = [];
                         renderCalendar(event);
                   }
             },error:function(res){
                console.log('Ajax call fail');
          }
    })
        }

        function renderCalendar(arrEvents){
            var calendarEl = document.getElementById('calendar');

            var d=new Date();
            var monthCurrent = d.getMonth()+1 ; 
            var dateCurrent = d.getDate(); 

            if( monthCurrent < 10 ){
                  if(dateCurrent  < 10) {
                        date = d.getFullYear()+'-0'+monthCurrent+'-0'+dateCurrent ;
                  }else{
                        date = d.getFullYear()+'-0'+monthCurrent+'-'+dateCurrent ;
                  }
            }else{
                  if(dateCurrent  < 10) {
                        date = d.getFullYear()+'-'+monthCurrent+'-0'+dateCurrent ;
                  }else{
                        date = d.getFullYear()+'-'+monthCurrent+'-'+dateCurrent ;
                  }
            }

            var calendar = new FullCalendar.Calendar(calendarEl, {
                  header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay,listWeek'
                  },
                  now: date,
                        navLinks: true, // can click day/week names to navigate views
                        // editable: true,
                        eventLimit: true, // allow "more" link when too many events
                        events: arrEvents
                  });

            calendar.render();
      }


      getCalendarConference();
