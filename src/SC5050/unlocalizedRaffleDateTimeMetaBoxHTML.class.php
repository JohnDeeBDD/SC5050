<?php

namespace SC5050;

class unlocalizedRaffleDateTimeMetaBoxHTML{
	
function ReturnUnlocalizedRaffleDateTimeMetaBoxHTML($raffleDate, $dateString, $crg_ID, $raffleTime, $timeString){
	$output = "
	<div class = 'crg-add-raffle-form-labels'>
	
	$raffleDate
	
	</div>
	<!-- end: .crg-add-raffle-form-labels -->
	<div class = 'crg-add-raffle-form-inputs'>
	<input type = 'text' id = 'SC5050-raffle-date' name = 'SC5050-raffle-date' class = 'SC5050-custom-date' value = '$dateString' />
	</div>
	<input type = 'hidden' id = 'SC5050-hidden-post-id' name = 'SC5050-hidden-post-id' value = '$crg_ID' />
	<!-- end: .crg-add-raffle-form-inputs -->
	<div class = 'crg-clear-fix'>&nbsp;</div>
	<div class = 'crg-add-raffle-form-labels'>
	
	$raffleTime
	
	</div>
	<!-- end: .crg-add-raffle-form-labels -->
	<div class = 'crg-add-raffle-form-inputs'>
	<input type = 'text' id = 'SC5050-raffle-time' name = 'SC5050-raffle-time' class = 'SC5050-raffle-time' value = '$timeString' />
	</div>
	<!-- end: .crg-add-raffle-form-inputs -->
	<div class = 'crg-clear-fix'>&nbsp;</div>
	";
	
	return $output;
}

}
