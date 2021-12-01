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

    //include __DIR__ . '/views/html-order-items.php';
    // $screen    = get_current_screen();
    // $screen_id = "shop_order";
    // $suffix       = Constants::is_true('SCRIPT_DEBUG') ? '' : '.min';
    // $version      = Constants::get_constant('WC_VERSION');
    
    // if (in_array(str_replace('edit-', '', $screen_id), wc_get_order_types('order-meta-boxes'))) {
    //     $default_location = wc_get_customer_default_location();
        
    //     wp_enqueue_script('wc-admin-order-meta-boxes', WC()->plugin_url() . '/assets/js/admin/meta-boxes-order' . $suffix . '.js', array('wc-admin-meta-boxes', 'wc-backbone-modal', 'selectWoo', 'wc-clipboard'), $version);
    //     wp_localize_script(
    //         'wc-admin-order-meta-boxes',
    //         'woocommerce_admin_meta_boxes_order',
    //         array(
    //             'countries'              => wp_json_encode(array_merge(WC()->countries->get_allowed_country_states(), WC()->countries->get_shipping_country_states())),
    //             'i18n_select_state_text' => esc_attr__('Select an option&hellip;', 'woocommerce'),
    //             'default_country'        => isset($default_location['country']) ? $default_location['country'] : '',
    //             'default_state'          => isset($default_location['state']) ? $default_location['state'] : '',
    //             'placeholder_name'       => esc_attr__('Name (required)', 'woocommerce'),
    //             'placeholder_value'      => esc_attr__('Value (required)', 'woocommerce'),
    //             )
    //         );
    //     }
        
    //     if (in_array(str_replace('edit-', '', $screen_id), array_merge(array('shop_coupon', 'product'), wc_get_order_types('order-meta-boxes')))) {
    //         $post_id                = isset($post->ID) ? $post->ID : '';
    //         $currency               = '';
    //         $remove_item_notice     = __('Are you sure you want to remove the selected items?', 'woocommerce');
    //         $remove_fee_notice      = __('Are you sure you want to remove the selected fees?', 'woocommerce');
    //         $remove_shipping_notice = __('Are you sure you want to remove the selected shipping?', 'woocommerce');
            
    //         if ($post_id && in_array(get_post_type($post_id), wc_get_order_types('order-meta-boxes'))) {
    //             $order = wc_get_order($post_id);
    //             if ($order) {
    //                 $currency = $order->get_currency();
                    
    //                 if (!$order->has_status(array('pending', 'failed', 'cancelled'))) {
    //                     $remove_item_notice = $remove_item_notice . ' ' . __("You may need to manually restore the item's stock.", 'woocommerce');
    //                 }
    //             }
    //         }
            
    //         $params = array(
    //             'remove_item_notice'            => $remove_item_notice,
    //             'remove_fee_notice'             => $remove_fee_notice,
    //             'remove_shipping_notice'        => $remove_shipping_notice,
    //             'i18n_select_items'             => __('Please select some items.', 'woocommerce'),
    //             'i18n_do_refund'                => __('Are you sure you wish to process this refund? This action cannot be undone.', 'woocommerce'),
    //             'i18n_delete_refund'            => __('Are you sure you wish to delete this refund? This action cannot be undone.', 'woocommerce'),
    //             'i18n_delete_tax'               => __('Are you sure you wish to delete this tax column? This action cannot be undone.', 'woocommerce'),
    //             'remove_item_meta'              => __('Remove this item meta?', 'woocommerce'),
    //             'remove_attribute'              => __('Remove this attribute?', 'woocommerce'),
    //             'name_label'                    => __('Name', 'woocommerce'),
    //             'remove_label'                  => __('Remove', 'woocommerce'),
    //             'click_to_toggle'               => __('Click to toggle', 'woocommerce'),
    //             'values_label'                  => __('Value(s)', 'woocommerce'),
    //             'text_attribute_tip'            => __('Enter some text, or some attributes by pipe (|) separating values.', 'woocommerce'),
    //             'visible_label'                 => __('Visible on the product page', 'woocommerce'),
    //             'used_for_variations_label'     => __('Used for variations', 'woocommerce'),
    //             'new_attribute_prompt'          => __('Enter a name for the new attribute term:', 'woocommerce'),
    //             'calc_totals'                   => __('Recalculate totals? This will calculate taxes based on the customers country (or the store base country) and update totals.', 'woocommerce'),
    //             'copy_billing'                  => __('Copy billing information to shipping information? This will remove any currently entered shipping information.', 'woocommerce'),
    //             'load_billing'                  => __("Load the customer's billing information? This will remove any currently entered billing information.", 'woocommerce'),
    //             'load_shipping'                 => __("Load the customer's shipping information? This will remove any currently entered shipping information.", 'woocommerce'),
    //             'featured_label'                => __('Featured', 'woocommerce'),
    //             'prices_include_tax'            => esc_attr(get_option('woocommerce_prices_include_tax')),
    //             'tax_based_on'                  => esc_attr(get_option('woocommerce_tax_based_on')),
    //             'round_at_subtotal'             => esc_attr(get_option('woocommerce_tax_round_at_subtotal')),
    //             'no_customer_selected'          => __('No customer selected', 'woocommerce'),
    //             'plugin_url'                    => WC()->plugin_url(),
    //             'ajax_url'                      => admin_url('admin-ajax.php'),
    //             'order_item_nonce'              => wp_create_nonce('order-item'),
    //             'add_attribute_nonce'           => wp_create_nonce('add-attribute'),
    //             'save_attributes_nonce'         => wp_create_nonce('save-attributes'),
    //             'calc_totals_nonce'             => wp_create_nonce('calc-totals'),
    //             'get_customer_details_nonce'    => wp_create_nonce('get-customer-details'),
    //             'search_products_nonce'         => wp_create_nonce('search-products'),
    //             'grant_access_nonce'            => wp_create_nonce('grant-access'),
    //             'revoke_access_nonce'           => wp_create_nonce('revoke-access'),
    //             'add_order_note_nonce'          => wp_create_nonce('add-order-note'),
    //             'delete_order_note_nonce'       => wp_create_nonce('delete-order-note'),
    //             'calendar_image'                => WC()->plugin_url() . '/assets/images/calendar.png',
    //             'post_id'                       => isset($post->ID) ? $post->ID : '',
    //             'base_country'                  => WC()->countries->get_base_country(),
    //             'currency_format_num_decimals'  => wc_get_price_decimals(),
    //             'currency_format_symbol'        => get_woocommerce_currency_symbol($currency),
    //             'currency_format_decimal_sep'   => esc_attr(wc_get_price_decimal_separator()),
    //             'currency_format_thousand_sep'  => esc_attr(wc_get_price_thousand_separator()),
    //             'currency_format'               => esc_attr(str_replace(array('%1$s', '%2$s'), array('%s', '%v'), get_woocommerce_price_format())), // For accounting JS.
    //             'rounding_precision'            => wc_get_rounding_precision(),
    //             'tax_rounding_mode'             => wc_get_tax_rounding_mode(),
    //             'product_types'                 => array_unique(array_merge(array('simple', 'grouped', 'variable', 'external'), array_keys(wc_get_product_types()))),
    //             'i18n_download_permission_fail' => __('Could not grant access - the user may already have permission for this file or billing email is not set. Ensure the billing email is set, and the order has been saved.', 'woocommerce'),
    //             'i18n_permission_revoke'        => __('Are you sure you want to revoke access to this download?', 'woocommerce'),
    //             'i18n_tax_rate_already_exists'  => __('You cannot add the same tax rate twice!', 'woocommerce'),
    //             'i18n_delete_note'              => __('Are you sure you wish to delete this note? This action cannot be undone.', 'woocommerce'),
    //             'i18n_apply_coupon'             => __('Enter a coupon code to apply. Discounts are applied to line totals, before taxes.', 'woocommerce'),
    //             'i18n_add_fee'                  => __('Enter a fixed amount or percentage to apply as a fee.', 'woocommerce'),
    //         );
            
    //         wp_localize_script('wc-admin-meta-boxes', 'woocommerce_admin_meta_boxes', $params);
    //     }
        
    }

    function add_my_meta_boxes($booking_id)
{
    add_meta_box('woocommerce-product-data', 'Bestellung', 'add_order_data', get_current_screen());
    add_meta_box('woocommerce-product-details', 'Produkte', 'add_positions', get_current_screen());

}
add_action( 'add_meta_boxes', 'add_my_meta_boxes', $priority = 10, $accepted_args = 1); 