jQuery(document).ready(function(){
	//alert('jQuery working!');
	jQuery( '#SC5050-raffle-date' ).datepicker({
		dateFormat: 'yy/mm/dd',
		changeMonth: true,
		changeYear: true,
		yearRange: '-100:+0'
	});
	jQuery('#SC5050-raffle-time').timepicker();
});