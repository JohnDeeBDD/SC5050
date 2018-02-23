<?php

namespace SC5050;

class ListenerDateTime{
		
    public function __construct(){
		$post_id = $_POST['SC5050-hidden-post-id'];
		$date = $_POST['SC5050-raffle-date'];
		$time = $_POST['SC5050-raffle-time'];
		
		if (is_array($date)){
			$dateString = $date[0];
		}else{
			$dateString = $date;
		}
		if (is_array($time)){
			$timeString = $time[0];
		}else{
			$timeString = $time;
		}
			
		update_post_meta($post_id, 'raffle_date', $dateString);
		update_post_meta($post_id, 'raffle_time', $timeString);			
	}

}