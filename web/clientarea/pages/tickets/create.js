$(document).ready(function(){
	$('#centro').on('change', function(){
	var select = $(this);
	var serie = $('#serie');
	$.post(base_path + '/app/find-devices',{ centro : select.val()}, function(result){
			serie.children('option:not(:first)').remove();
	$.each(result, function(i, value){
		serie.append($('<option>').text(value.serie + ' - ' + value.ubicacion).attr('value', value.id));
		console.log(value);
	});
	});
});

});