	document.addEventListener('DOMContentLoaded', function() {
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
      events: [
      {
      	title: 'All Day Event',
      	start: '2018-10-01',
      },
      {
      	title: 'Long Event',
      	start: '2018-10-07',
      	end: '2018-10-10'
      },
      {
      	groupId: 999,
      	title: 'Repeating Event',
      	start: '2018-10-09T16:00:00'
      },
      {
      	groupId: 999,
      	title: 'Repeating Event',
      	start: '2018-10-16T16:00:00'
      },
      {
      	title: 'Conference',
      	start: '2018-10-11',
      	end: '2018-10-13'
      },
      {
      	title: 'Meeting',
      	start: '2018-10-12T10:30:00',
      	end: '2018-10-12T12:30:00'
      },
      {
      	title: 'Lunch',
      	start: '2018-10-12T12:00:00'
      },
      {
      	title: 'Meeting',
      	start: '2018-10-12T14:30:00'
      },
      {
      	title: 'Happy Hour',
      	start: '2018-10-12T17:30:00'
      },
      {
      	title: 'Dinner',
      	start: '2018-10-12T20:00:00'
      },
      {
      	title: 'Birthday Party',
      	start: '2018-10-13T07:00:00'
      },
      {
      	title: 'Click for Google',
      	url: 'http://google.com/',
      	start: '2018-10-28'
      }
      ]
  });

		calendar.render();
	});

