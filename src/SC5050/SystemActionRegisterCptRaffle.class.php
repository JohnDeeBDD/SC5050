<?php

namespace SC5050;

//This class creates the Raffle Custom Post Type

class SystemActionRegisterCptRaffle{

	function createRaffleCustomPostType(){
		//$menu_icon = $this->pluginDirectory . "/assets/images/Raffle.gif";
		$labels = array(
			'name'                => _x( 'Raffles', 'Post Type General Name', 'crg_text_domain' ),
			'singular_name'       => _x( 'Raffle', 'Post Type Singular Name', 'crg_text_domain' ),
			'menu_name'           => __( 'Raffles', 'crg_text_domain' ),
			'parent_item_colon'   => __( 'Parent Raffle:', 'crg_text_domain' ),
			'all_items'           => __( 'All Raffles', 'crg_text_domain' ),
			'view_item'           => __( 'View Raffle', 'crg_text_domain' ),
			'add_new_item'        => __( 'Add New Raffle', 'crg_text_domain' ),
			'add_new'             => __( 'Add New', 'crg_text_domain' ),
			'edit_item'           => __( 'Edit Raffle', 'crg_text_domain' ),
			'update_item'         => __( 'Update Raffle', 'crg_text_domain' ),
			'search_items'        => __( 'Search Raffle', 'crg_text_domain' ),
			'not_found'           => __( 'Not found', 'crg_text_domain' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'crg_text_domain' ),
		);
		$args = array(
			'label'               => __( 'Raffle', 'crg_text_domain' ),
			'description'         => __( 'Raffles', 'crg_text_domain' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields'),
			'taxonomies'          => array( 'Raffle-type' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			//'menu_icon'           => $menu_icon,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
		register_post_type('Raffle', $args);

		wp_insert_term( __('Wordpress'),'Raffle-type', array( 'description' => __('A link to a Wordpress ad'),'slug' => 'feature'));
	}
}
