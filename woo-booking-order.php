<?php

use Automattic\Jetpack\Constants;

/**
 * Plugin Name:     Woo Booking Order
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     PLUGIN DESCRIPTION HERE
 * Author:          YOUR NAME HERE
 * Author URI:      YOUR SITE HERE
 * Text Domain:     woo-booking-order
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Woo_Booking_Order
 */

// Your code starts here.
//include_once "../woocommerce/includes/admin/meta-boxes/class-wc-meta-box-order-data.php";
//include_once(plugin_dir_path(__FILE__) . 'woocommerce/includes/admin/meta-boxes/class-wc-meta-box-order-data.php');

function add_order_to_booking($booking_id)
{

    $booking = new WC_Booking($booking_id);
    $order_id = $booking->get_order_id();
    echo 'order id' . $order_id;
}

add_action('woocommerce_admin_booking_data_after_booking_details', 'add_order_to_booking', $priority = 10, $accepted_args = 1);

function add_order_data()
{
    global $post;
    $id = get_the_ID();
    $booking = new WC_Booking($id);
    $post = $booking->get_order();
    WC_Meta_Box_Order_Data::output($post);
}

function add_positions()
{
    global $post;
    $id = get_the_ID();
    $booking = new WC_Booking($id);
    $post = $booking->get_order();
    WC_Meta_Box_Order_Items::output($post);
}

function add_my_meta_boxes($booking_id)
{
    add_meta_box('woocommerce-product-data', 'Bestellung', 'add_order_data', get_current_screen());
    add_meta_box('woocommerce-product-details', 'Produkte', 'add_positions', get_current_screen());
}
add_action('add_meta_boxes', 'add_my_meta_boxes', $priority = 10, $accepted_args = 1);
