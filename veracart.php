<?php
/*
Plugin Name: Veracart Shopping Cart Software
Plugin URI: http://www.veracart.com/plugins/wordpress/
Description: Easily create a powerful shopping cart into your blog
Version: 1.2.1
Author: Verango
Author URI: http://www.veracart.com
*/

function vc_options() {
	add_menu_page('Veracart', 'Veracart', 8, basename(__FILE__), 'vc_options_page');
	add_submenu_page(basename(__FILE__), 'Settings', 'Settings', 8, basename(__FILE__), 'vc_options_page');
}

function vc_options_page() {
?>
    <div class="wrap">
    <div class="icon32" id="icon-options-general"><br/></div><h2>Settings for Veracart Integration</h2>
    <p>This will install Veracart Ecommerce Shopping Cart into your Blog Posts or Pages.  You will need an active account with Veracart to use. Click here to open an account <a href="https://secure.veracart.com/vc/signup.html?package=9998" target="_blank">click here</a>  
    It can be easily configured to provide you with one of the most powerful shopping carts in the ecommerce market.
    </p>
    <form method="post" action="options.php">
    <?php
        // New way of setting the fields, for WP 2.7 and newer
        if(function_exists('settings_fields')){
            settings_fields('vc-options');
        } else {
            wp_nonce_field('update-options');
            ?>
            <input type="hidden" name="action" value="update" />
            <input type="hidden" name="page_options" value="vc_user_id" />
            <?php
        }
    ?>
         <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="vc_user_id">Veracart Plugin ID</label>
                </th>
                <td>
                	<p>This can be retrieved by logging into your Veracart account and clicking on My Profile.  On the top of the My Profile page is your Veracart Plugin ID. </p>
                    <p>
                        <input type="text" value="<?php echo get_option('vc_user_id'); ?>" name="vc_user_id" id="vc_user_id" />
                    </p>
                    <span class="setting-description">Your Plugin ID, available from <a href="http://www.veracart.com" target="_blank">Veracart</a></span>
                </td>
            </tr>
        </table>
        <p class="submit">
            <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
        </p>
    </form>
    </div>
<?php
}

function vc_catalog(){
	$vc_user_id=get_option('vc_user_id');
	$html ="";
	if($vc_user_id){
		$html = "<script>vcCatalog();</script>";
  }
  return $html;
}


function vc_cart(){
	$vc_user_id=get_option('vc_user_id');
	$html ="";
	if($vc_user_id){
		$html = "<script>vcCart();</script>";
  }
  return $html;
}

function vc_mini_cart(){
   $vc_user_id=get_option('vc_user_id');
	$html ="";
	if($vc_user_id){
		$html = "<script>vcMiniCart();</script>";
    }
  return $html;
}

function vc_catalog_list(){
   $vc_user_id=get_option('vc_user_id');
	$html ="";
	if($vc_user_id){
		$html = "<script>vcCatalogList();</script>";
    }
  return $html;
}

function vc_drop_down(){
   $vc_user_id=get_option('vc_user_id');
	$html ="";
	if($vc_user_id){
		$html = "<script>vcCatalogDropDown();</script>";
    }
  return $html;
}

function vc_catalog_table(){
   $vc_user_id=get_option('vc_user_id');
	$html ="";
	if($vc_user_id){
		$html = "<script>vcCatalogCategoryTable();</script>";
    }
  return $html;
}

function vc_favorites(){
   $vc_user_id=get_option('vc_user_id');
	$html ="";
	if($vc_user_id){
		$html = "<script>vcFavorites();</script>";
    }
  return $html;
}

function vc_search(){
   $vc_user_id=get_option('vc_user_id');
	$html ="";
	if($vc_user_id){
		$html = "<script>vcSearch();</script>";
    }
  return $html;
}

function vc_advance_search(){
   $vc_user_id=get_option('vc_user_id');
	$html ="";
	if($vc_user_id){
		$html = "<script>vcAdvanceSearch();</script>";
    }
  return $html;
}

function vc_dynamic_menu(){
   $vc_user_id=get_option('vc_user_id');
	$html ="";
	if($vc_user_id){
		$html = "<script>vcDynamicMenu();</script>";
    }
  return $html;
}

function vc_feedback_form(){
  
  $vc_user_id=get_option('vc_user_id');
	$html ="";
	if($vc_user_id){
		$html = "<script>vcFeedBackForm();</script>";
    }
  return $html;
}

 function vc_promotions(){
  
  $vc_user_id=get_option('vc_user_id');
	$html ="";
	if($vc_user_id){
		$html = "<script>vcPromotions();</script>";
    }
  return $html;
}


function vc_currency(){
  
  $vc_user_id=get_option('vc_user_id');
	$html ="";
	if($vc_user_id){
		$html = "<script>vcCurrency();</script>";
    }
  return $html;
}


function vc_checkout_button(){
  
  $vc_user_id=get_option('vc_user_id');
	$html ="";
	if($vc_user_id){
		$html = "<script>vcCheckoutButton();</script>";
    }
  return $html;
}

// On access of the admin page, register these variables (required for WP 2.7 & newer)
function vc_init(){
    if(function_exists('register_setting')){
        register_setting('vc-options','vc_user_id', 'vc_sanitize_username');
    }
}

function vc_sanitize_username($username){
    return preg_replace('/[^0-9_]/','',$username);
}

// Only all the admin options if the user is an admin
if(is_admin()){
    add_action('admin_menu', 'vc_options');
    add_action('admin_init', 'vc_init');
}

// Set the default options when the plugin is activated
function vc_activate(){
    register_setting('vc-options', 'vc_user_id');
}

function vc_add_header(){
   $vc_user_id=get_option('vc_user_id');
   $vc_plugin_url = "http://jscode.veracart.com/cart";
   if(!is_admin() && ($vc_user_id)>0){
      wp_enqueue_script('vc_header_script', $vc_plugin_url.'/wordpress.js');
	  wp_localize_script( 'vc_header_script', 'WPCODE', array('vc_user_id' => $vc_user_id));
   }
}

add_action('wp_print_scripts', 'vc_add_header');
add_shortcode('veracart-catalog', 'vc_catalog');
add_shortcode('veracart-cart', 'vc_cart');
add_shortcode('veracart-mini-cart','vc_mini_cart');
add_shortcode('veracart-list','vc_catalog_list');
add_shortcode('veracart-dropdown','vc_drop_down');
add_shortcode('veracart-catalog-table','vc_catalog_table');
add_shortcode('veracart-favorites','vc_favorites');
add_shortcode('veracart-search','vc_search');
add_shortcode('veracart-advance-search','vc_advance_search');
add_shortcode('veracart-menu','vc_dynamic_menu');
add_shortcode('veracart-feedback','vc_feedback_form');
add_shortcode('veracart-promotion','vc_promotions');
add_shortcode('veracart-currency','vc_currency');
add_shortcode('veracart-checkout-button','vc_checkout_button');

register_activation_hook( __FILE__, 'vc_activate');