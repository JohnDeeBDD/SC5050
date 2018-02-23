<?php
/*
 Plugin Name: South Carolina 50/50
 Plugin URI: http://SC5050.com/
 Description: A plugin to allow the selling of Raffle tickets
 Version: 1.0
 Author: John Dee
 Author URI: https://wordpress-bdd.com/
 */

namespace SC5050;

require_once (plugin_dir_path(__FILE__). 'src/SC5050/autoloader_SC5050.function.php');

add_action('init', array($SystemActionRegisterCptRaffle = new SystemActionRegisterCptRaffle, 'createRaffleCustomPostType'));
add_action('publish_raffle', array(new SystemActionCreateTicketProduct, 'doCreateTicketProduct'));
//add_action( 'save_raffle', array(new SystemActionCreateTicketProduct, 'addContentTextToRaffle'));
if (is_admin()){
    add_action('load-post.php',     array(new RaffleCPTsMetaBoxes, 'initMetaboxs'));
    add_action('load-post-new.php', array(new RaffleCPTsMetaBoxes, 'initMetaboxs'));
}
$AdminActionAddTickets = new AdminActionAddTickets;
if ($AdminActionAddTickets->addTicketsListenerConditionalBoolean()){
    add_action('init', array( $AdminActionAddTickets, 'listenToAddTickets' ));
}
if ($AdminActionAddTickets->dateTimeListenerConditionalBoolean()){
    add_action('save_post', array( $AdminActionAddTickets, 'listenToDateTime' ));
}

add_action( 'woocommerce_order_status_completed', array(new CustomerActionPurchaseTickets, 'doPurchaseTickets'));

add_action('init', array(new SystemActionListenForDeclareWinner, 'listen'));