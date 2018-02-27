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

function myplugin_plugin_path() {
    
    // gets the absolute path to this plugin directory
    
    return untrailingslashit( plugin_dir_path( __FILE__ ) );
}
add_filter( 'woocommerce_locate_template', '\SC5050\myplugin_woocommerce_locate_template', 10, 3 );

function myplugin_woocommerce_locate_template( $template, $template_name, $template_path ) {
    global $woocommerce;
    //die('hi!');
    $_template = $template;
    
    if ( ! $template_path ) $template_path = $woocommerce->template_url;
    
    $plugin_path  = \SC5050\myplugin_plugin_path() . '/woocommerce/';
    
    // Look within passed path within the theme - this is priority
    $template = locate_template(
        
        array(
            $template_path . $template_name,
            $template_name
        )
        );
    
    // Modification: Get the template from this plugin, if it exists
    if ( ! $template && file_exists( $plugin_path . $template_name ) )
        $template = $plugin_path . $template_name;
        
        // Use default template
        if ( ! $template )
            $template = $_template;
            
            // Return what we found
            return $template;
}