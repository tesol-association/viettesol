//document.addEventListener('DOMContentLoaded', function() {


  function getCalendarPaper(){

    $.ajax({
      url: "getData",
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
          renderCalendar(res.room, res.events);
        }else{

        }
      },error:function(res){
        console.log('Ajax call fail');
      }
    })

  }

  function renderCalendar(arrResources, arrEvents){
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
     schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
     now: date,
     //navLinks: true,
     //editable: true,
     //eventLimit: true,
     aspectRatio: 1.8,
     scrollTime: '00:00',
     header: {
      left: 'today prev,next',
      center: 'title',
      right: 'timelineDay,timelineThreeDays,agendaWeek,month'
    },
    defaultView: 'timelineDay',
    views: {
      timelineDay: {
        buttonText: 'timelineDay',
        slotDuration: '00:05'
      },
      timelineThreeDays: {
        type: 'timeline',
        duration: { days: 4 }
      }
    },
    resourceAreaWidth: '40%',
    resourceColumns: [
    {
      group: true,
      labelText: 'Building',
      field: 'building'
    },
    {
      labelText: 'Room',
      field: 'title'
    }
    ],
    resources: arrResources,
    events: arrEvents
  });

    calendar.render();
  }


  getCalendarPaper();

  // var resources=[
  //       { id: 'a', building: '460 Bryant', title: 'Auditorium A' },
  //       { id: 'b', building: '460 Bryant', title: 'Auditorium B', eventColor: 'green' },
  //       { id: 'c', building: '460 Bryant', title: 'Auditorium C', eventColor: 'orange' },
  //       { id: 'd', building: '460 Bryant', title: 'Auditorium D'},
  //       { id: 'e', building: '460 Bryant', title: 'Auditorium E' },
  //       { id: 'f', building: '460 Bryant', title: 'Auditorium F', eventColor: 'red' },
  //       { id: 'g', building: '564 Pacific', title: 'Auditorium G' },
  //       { id: 'h', building: '564 Pacific', title: 'Auditorium H' },
  //       { id: 'i', building: '564 Pacific', title: 'Auditorium I' },
  //       { id: 'j', building: '564 Pacific', title: 'Auditorium J' },
  //       { id: 'k', building: '564 Pacific', title: 'Auditorium K' },
  //       { id: 'l', building: '564 Pacific', title: 'Auditorium L' },
  //       { id: 'm', building: '564 Pacific', title: 'Auditorium M' }
  //     ];

  // var events=[
  //       { id: '1', resourceId: 'b', start: '2018-04-07T02:00:00', end: '2018-04-07T07:00:00', title: 'event 1' },
  //       { id: '2', resourceId: 'c', start: '2018-04-07T05:00:00', end: '2018-04-07T22:00:00', title: 'event 2' },
  //       { id: '3', resourceId: 'd', start: '2018-04-06', end: '2018-04-08', title: 'event 3' },
  //       { id: '4', resourceId: 'e', start: '2018-04-07T03:00:00', end: '2018-04-07T08:00:00', title: 'event 4' },
  //       { id: '5', resourceId: 'f', start: '2018-04-07T00:30:00', end: '2018-04-07T02:30:00', title: 'event 5' }
  //     ]; 

  //renderCalendar(resources, events);    
//});
