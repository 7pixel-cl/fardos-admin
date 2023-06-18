<?php 
/*
	Plugin Name: Fardos Admin
	Plugin URI: http://www.fardosderopapremium.com/
	Description: Plugin para administrar los fardos de ropa existentes en el sistema
	Author: Manuel Estevez Gonzalez
	Version: 1.0
	Author URI: http://www.fardosderopapremium.com/
*/

include(ABSPATH.'/wp-admin/includes/plugin.php');
//require_once(ABSPATH.'/wp-content/plugins/fardos-admin/process/clases.php');
$page_title = "Administración";
$menu_title = "Fardos Admin";
$capability = "read";
$menu_slug = "fardos-admin/admin.php";
$function = "";
$icon_url = "";
$position = "300";

add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
// Define the custom hook
// add_action('woocommerce_order_status_completed', 'my_custom_function');
// Define the custom function

// function my_custom_function($order_id) {
//     $order = wc_get_order($order_id);

//     // Loop through the order items
//     foreach ($order->get_items() as $item) {
//         // Get the product ID and quantity
//         $product_id = $item->get_product_id();
//         $sku = $product->get_sku();
//         Modificar_Productos_($product_id, $sku);
//     }
// }
add_action('woocommerce_update_product', 'my_custom_function');

function my_custom_function($product_id) {
    $product = wc_get_product($product_id);
    // Check if the SKU has changed
    if (isset($_POST['_sku'])) {
        Modificar_Productos_($_POST['_sku'], $product_id);
    }
}
function Modificar_Productos_($id_producto_empresa, $id) {
    global $wpdb;
    $query = "UPDATE fardos.fd_stock SET ID_PRODUCTO_EMPRESA = $id_producto_empresa WHERE ID_WP_POSTS = $id";
    $wpdb->query($query);
}
?>