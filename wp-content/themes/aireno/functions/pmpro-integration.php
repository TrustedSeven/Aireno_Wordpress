<?php
function aireno_alert_client_on_membership_checkout(){
    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
        $user_data = aireno_get_userdata($user_id);
        if (is_client($user_id)) {
            ?>
            <p class="text-dark">Hello, <span class="fw-boldest"><?=$user_data->display_name?></span>!</p>
            <p class="text-dark">Once you complete this step, then you will upgrade your account to Business one!</p>
            <?php
        }
        else {
            if (pmpro_hasMembershipLevel(null, $user_id)) {
                ?>
                <p class="text-dark">Hello, <span class="fw-boldest"><?=$user_data->display_name?></span>!</p>
                <p class="text-dark">You already purchased this membership.</p>
                <?php
            }
            else {
                ?>
                <p class="text-dark">Hello, <span class="fw-boldest"><?=$user_data->display_name?></span>!</p>
                <p class="text-dark">Once you purchase Business membership, you will have more features on Aireno.</p>
                <?php
            }
        }
    }
    else {
        ?>
        <?php
    }
    ?>
    <style>
    </style>
    <?php
}
add_action('pmpro_checkout_before_form', 'aireno_alert_client_on_membership_checkout');

function aireno_pmpro_checkout_after_pricing_fields(){
    if (is_user_logged_in()) {
        ?>
        <style>
            #pmpro_account_loggedin {
                display : none !important;
            }
        </style>
        <?php
    }
    ?>
    <style>
        #pmpro_payment_information_fields > h3 {
            display : none !important;
        }
        .pmpro_checkout-fields .pmpro_checkout-field input {
            width : 100% !important;
            height: 40px;
            font-size: 20px;
        }
        .pmpro_checkout-fields .pmpro_checkout-field > label {
            color: black !important;
            margin-bottom: 0.5em;
        }
    </style>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $('#pmpro_pricing_fields .pmpro_checkout-fields').removeClass('row');
        });
    </script>
    <?php
}
add_action('pmpro_checkout_after_pricing_fields', 'aireno_pmpro_checkout_after_pricing_fields');

function aireno_pmpro_checkout_after_username(){
    ?>
    <div class="<?php echo pmpro_get_element_class( 'pmpro_checkout-field pmpro_checkout-field-fullname', 'pmpro_checkout-field-fullname' ); ?>">
        <label for="fullname"><?php esc_html_e('Display Name', TEXT_DOMAIN );?></label>
        <input id="fullname" name="fullname" type="text" class="<?php echo pmpro_get_element_class( 'input', 'fullname' ); ?>" size="30" value="<?php echo esc_attr($fullname); ?>" />
    </div>
    <?php
}
//add_action('pmpro_checkout_after_username', 'aireno_pmpro_checkout_after_username');

function aireno_pmpro_element_class($class, $element){
    switch ($element) {
        case 'pmpro_checkout-fields':
            $class[] = 'row';
            break;
        case 'pmpro_checkout-field-username':
            $class[] = 'col-md-12';
            break;
        case 'pmpro_checkout-field-display_name':
        case 'pmpro_checkout-field-password':
        case 'pmpro_checkout-field-password2':
        case 'pmpro_checkout-field-bemail':
        case 'pmpro_checkout-field-bconfirmemail':
            $class[] = 'col-md-6';
            break;
        case 'pmpro_btn-submit-checkout':
            $class[] = 'btn';
            $class[] = 'btn-danger';
            $class[] = 'text-white';
            $class[] = 'fw-boldest';
            break;
    }
    return $class;
}
add_filter('pmpro_element_class', 'aireno_pmpro_element_class', 10, 2);


function aireno_pmpro_checkout_before_user_auth($user_id){
    $userdata = array(
        'ID' => $user_id,
        'display_name' => $_REQUEST['display_name'],
        'user_nicename' => $_REQUEST['display_name'],
    );
    wp_update_user( $userdata );
    update_user_meta($user_id, 'user_type', 'Business');
    update_field('user_type', 'Business', 'user_' . $user_id);
}
add_action('pmpro_checkout_before_user_auth', 'aireno_pmpro_checkout_before_user_auth');

function aireno_pmpro_checkout_before_change_membership_level($user_id, $morder){
    update_user_meta($user_id, 'user_type', 'Business');
    update_field('user_type', 'Business', 'user_' . $user_id);
}
add_action('pmpro_checkout_before_change_membership_level', 'aireno_pmpro_checkout_before_change_membership_level', 10, 2);

function my_pmpro_add_fields_to_checkout() {
    // Don't break if PMPro is out of date or not loaded.
    if ( ! function_exists( 'pmpro_add_user_field' ) ) {
        return false;
    }

    // This is where our fields code will go.
    $fields = array();

    // Add a Full Name text field.
    $fields[] = new PMPro_Field(
        'display_name',
        'text',
        array(
            'label' => 'Display Name',
            'size' => 40,
            'class' => pmpro_get_element_class( 'input', 'display_name' ),
            'profile' => false,
            'required' => true,
            'levels' => array(),
            'memberslistcsv' => false
        )
    );

    // Add a field group to put our fields into.
    pmpro_add_field_group( 'Additional Information' );

    // Add all of our fields into that group.
    foreach ( $fields as $field ) {
        pmpro_add_user_field(
            'Additional Information',
            $field
        );
    }
}
add_action( 'init', 'my_pmpro_add_fields_to_checkout' );