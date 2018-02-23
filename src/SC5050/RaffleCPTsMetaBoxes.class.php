<?php

namespace SC5050;

//"Meta boxes" appear in the add new and edit post admin pages.

class RaffleCPTsMetaBoxes{
	
    public function initMetaboxs() {
		add_meta_box('SC5050-raffle-date-meta-box', __( 'Raffle Date' ),array( $this,'echoRaffleDateMetaBox'),'Raffle', 'side', 'high');
		add_meta_box('SC5050-manage-tickets-meta-box', __( 'Manage Tickets' ),array( $this,'echoManageTicketsMetaBox'),'Raffle', 'normal', 'high');
		add_meta_box('SC5050-add-tickets-meta-box', __('Add Tickets'), array( $this,'echoAddTicketsMetaBox'),'Raffle', 'side', 'high');
		add_meta_box('SC5050-declare-winner-meta-box', __('Winner'), array( $this,'echoDeclareWinnerMetaBox'),'Raffle', 'side', 'low');
    }
	
    public function echoDeclareWinnerMetaBox(){
        global $post;
        $crg_ID = $post->ID;
        $raffleWinner = get_post_meta( $crg_ID, 'raffleWinner', true );
        if($raffleWinner == FALSE){
            echo ("Declare Winning Ticket: <input name = 'SC5050-winner' id = 'SC5050-winner' />");
            wp_nonce_field( 'AdminActionDeclareWinner', 'SC5050-winner-nonce-field' );
        }else{
            echo ("Ticket #: $raffleWinner");
        }
    }
	public function echoRaffleDateMetaBox(){
		//li18 strings:
			$raffleDate = __('Raffle Date');
			$raffleTime = __('Raffle Time');
		$dateString = "";
		$timeString = "";
		global $post;
		$crg_ID = $post->ID;
		$dateString = $this->returnDateFromDatabase($crg_ID);
		$timeString = $this->returnTimeFromDatabase($crg_ID);
		$this->enqueueScripts();
		$unlocalizedRaffleDateTimeMetaBoxHTML = new unlocalizedRaffleDateTimeMetaBoxHTML;
		$output = $unlocalizedRaffleDateTimeMetaBoxHTML->ReturnUnlocalizedRaffleDateTimeMetaBoxHTML($raffleDate, $dateString, $crg_ID, $raffleTime, $timeString);
		echo $output;
	}
	public function enqueueScripts(){
	    wp_enqueue_style('metaBoxDateTimePickerStyle', ('/wp-content/plugins/SC5050/src/SC5050/jquery.timepicker.min.css'));
	    wp_enqueue_script('remoteTimePickerScript', ('/wp-content/plugins/SC5050/src/SC5050/jquery.timepicker.min.js'));
	    wp_enqueue_script( 'metaBoxTimePicker', ('/wp-content/plugins/SC5050/src/SC5050/metaBoxTimePicker.js'));
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_style('jquery-ui-css', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
	}
	
	public function echoAddTicketsMetaBox(){
	
		//lnI8 strings:
		$addOneTicket = __('Add one ticket:');
		$addTickets = __('Add Tickets');
		$addTicketsRange = __('Add Tickets Range:');
		//$clickPublishOrSaveToActivate = __("Click Publish or Save Draft to activate this feature.");
		$max = __('max');
		$min = __('min');
	
		$output = <<<formOutputHTML
<style>
	#crg-add-raffle-form-div{border-style: solid; max-width: 35%; padding: 5px;}
	.crg-add-raffle-form-inputs{float:right;}
	.crg-add-raffle-form-labels{float:left;}
	.crg-clear-fix{clear:both;width:100%;min-width:100%;}
</style>

<div id = "add-tickets-to-raffle-form-div">
	<div>
     
         <div class = 'crg-add-raffle-form-labels'>
            $addTicketsRange
         </div>
         <div class = 'crg-add-raffle-form-inputs'>
            <label for = 'SC5050-ticket-range-min'>$min</label>
            <input type = 'text' name = 'SC5050-ticket-range-min' id = 'SC5050-ticket-range-min' size = '5' />
            <label for = 'SC5050-ticket-range-max'>$max</label>
            <input type = 'text' name = 'SC5050-ticket-range-max' id = 'SC5050-ticket-range-max' size = '5' />
         </div>
         <div class = 'crg-clear-fix'>&nbsp;</div>
     
         <div class = 'crg-add-raffle-form-labels'>
            $addOneTicket
         </div>
         <div class = 'crg-add-raffle-form-inputs'>
            <label for = 'SC5050-ticket-one'>#</label>
            <input type = 'text' name = 'SC5050-ticket-one' id = 'SC5050-ticket-one' size = '5' />
         </div>
		 <div class = 'crg-clear-fix'>&nbsp;</div>
      </div><!-- END:#crg-add-raffle-form-revealed-area -->
</div><!-- #crg-add-raffle-form-div -->
formOutputHTML;
		echo $output;
		
	}

	public function echoManageTicketsMetaBox(){
		global $post;
		$ID = $post->ID;
		$TicketBin = new TicketBin();
		$TicketBin->getBinFromDB($ID);
		$binOfTickets= $TicketBin->binOfTickets;
		if((count($binOfTickets) == 0 ) or (!(is_array($binOfTickets))) ){
		    echo "There are no tickets in the bin.";
		    return;
		}
		$countBinOfTickets = count($binOfTickets);
		$countUnsoldTickets = $TicketBin->countUnSoldTickets();
		$output = "Total number of tickets: $countBinOfTickets<br /> Unsold tickets: $countUnsoldTickets<br />";
		foreach($binOfTickets as $ticket){
		    $output = $output . $ticket->ticketNumber . ":" . $ticket->owner . " ";
		}
		echo $output;
	}
	
	public function returnDateFromDatabase($crg_ID){
		$dateString = "";
		$dateArray = get_post_meta($crg_ID, 'raffle_date');
		if (is_array($dateArray)){
			if(isset($dateArray[0])){
				$dateString = $dateArray[0];
			 }else{
				$dateString = "";
			}
		}
		return $dateString;
	}
	
	public function returnTimeFromDatabase($crg_ID){
		$timeString = NULL;
		$timeArray = get_post_meta($crg_ID, 'raffle_time');
		if (is_array($timeArray)){
			if(isset($timeArray[0])){
				$timeString = $timeArray[0];
			}else{
				$timeString = "";
			}
		}else{
			$timeString = $timeArray;
		}
		return $timeString;
	}
	
}