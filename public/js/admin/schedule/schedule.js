	$('#room').change(function(event) {
		$('.list').css('display', 'block');
		var roomId= $('#room').val();
		$("#room option").each(function(){
			if ($(this).val() == roomId) {
				$(this).attr("disabled", "disabled");
			}
		});
	});

	function selectTimeBlock(id){
		var idPaper = id.parentElement.previousElementSibling.previousElementSibling.innerText;
		var timeBlockValue=document.getElementById('timeblock_'+idPaper).value;
		$('#timeblock_'+idPaper).attr("disabled", "disabled");
		$("select option").each(function(){
			if ($(this).val() == timeBlockValue) {
				$(this).attr("disabled", "disabled");
			}
		});
		//$(`select option[value=${timeBlockValue}]`).prop('disabled', true);
	}
