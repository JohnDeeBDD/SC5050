<?php

namespace SC5050;

class SystemActionCreateTicketProduct{
	
	public $productCost = 1;
	
	private $raffleID;

	public function addContentTextToRaffle(){
	    global $wpdb;
	    $kv_post = $wpdb->get_row("SELECT post_content,post_title FROM $wpdb->posts WHERE ID = $raffleID");   
	    $kv_post_title = $kv_post->post_title;
	    $kv_post_content = $kv_post->post_content;
	    $mystring = "Some stuff!";
	    $pos = strpos($kv_post_content, $mystring);
	    if($update == false) {
	        
	    
	       $kv_post_content = $kv_post_content . $mystring;

            $kv_edited_post = array(
                'ID'           => $raffleID,
                'post_title' => $kv_post_title, 
                'post_content' => $kv_post_content
                );
            remove_action( 'save_raffle', array(new SystemActionCreateTicketProduct, 'addContentTextToRaffle'));
            wp_update_post( $kv_edited_post);
	    }
	}
	
	public function doCreateTicketProduct($raffleID){
	    

	    
		//Checks if should create new product:
	    $raffleTitle = get_the_title($raffleID);
		if($raffleTitle == "Auto Draft"){return;}
		if($this->productExists($raffleID)){return;}
		

		
		$productCost = $this->productCost;
		$productTitle = "Tickets for $raffleTitle";
		$post_id = wp_insert_post(
			array(
				'post_title' => $productTitle,
				'post_content' => 'You can purchase a ticket for this raffle.',
				'post_status' => 'publish',
				'post_type' => "product",
			) 
		);
		wp_set_object_terms( $post_id, 'simple', 'product_type' );
		update_post_meta( $post_id, '_visibility', 'visible' );
		update_post_meta( $post_id, '_stock_status', 'instock');
		update_post_meta( $post_id, '_virtual', 'yes' );
		update_post_meta( $post_id, '_sale_price', 1);
		update_post_meta( $post_id, '_price', 1);
		update_post_meta( $post_id, '_manage_stock', 'yes' );
		update_post_meta( $post_id, '_stock', 0);
		update_post_meta( $post_id, 'raffleID', $raffleID);
        update_post_meta($raffleID, "wooTicketProduct", $post_id);
        
        //$this->addContentTextToRaffle($raffleID);
		return $post_id;
	}

	public function productExists($post_id) {
	    if(metadata_exists('post', $post_id, 'wooTicketProduct')){
	        return TRUE;
	    }else{
	        return FALSE;
	    }
	}
}