<?php
/**
 * Hook in and register a metabox to handle a theme options page and adds a menu item.
 */
function yourprefix_register_main_options_metabox() {
    /**
     * Registers main options page menu item and form.
     */
    $args = array(
        'id'           => 'yourprefix_main_options_page',
        'title'        => 'تنظیمات اصلی',
        'object_types' => array( 'options-page' ),
        'option_key'   => 'yourprefix_main_options',
        'tab_group'    => 'yourprefix_main_options',
        'tab_title'    => 'تنظیمات اصلی سایت',
    );
    // 'tab_group' property is supported in > 2.4.0.
 
    $main_options = new_cmb2_box( $args );
    /**
     * Options fields ids only need
     * to be unique within this box.
     * Prefix is not needed.
     */

   /*this  is end   pishanahad shegeftangoiz*/
    $args = array(
        'id'           => 'yourprefix_fore_options_page',
        'menu_title'   => 'تنظیمات دسته های ', // Use menu title, & not title to hide main h2.
        'object_types' => array( 'options-page' ),
        'option_key'   => 'yourprefix_fore_options_page',
        'parent_slug'  => 'yourprefix_main_options',
        'tab_group'    => 'yourprefix_main_options',
        'tab_title'    => 'تنظیمات دسته های  صفحه اصلی',
    );
    // 'tab_group' property is supported in > 2.4.0.
    if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
        $args['display_cb'] = 'yourprefix_options_display_with_tabs';
    }
    $fore_options= new_cmb2_box( $args );
    $group_field_id_category  = $fore_options->add_field( array(
        'id'          => 'category_option',
        'type'        => 'group',
        'description' => __( ' دسته هایی که میخواهید در صفحه اصلی  نمایش دهد را دراین بخش  تنظیماتشو انجام بدید', 'cmb2' ),
        // 'repeatable'  => false, // use false if you want non-repeatable group
        'options'     => array(
            'group_title'       => __( 'دسته {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number

            'sortable'          => true,
             'closed'         => true, // true to have the groups closed by default
            // 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
        ),
    ) );

    $fore_options->add_group_field( $group_field_id_category, array(
        'name'           => 'Test Taxonomy Select',
        'desc'           => 'Description Goes Here',
        'id'             => 'taxonomy_select',
        'taxonomy'       => 'product_cat', //Enter Taxonomy Slug
          'type'           => 'taxonomy_multicheck',
    // Optional :
    'text'           => array(
        'no_terms_text' => 'Sorry, no terms could be found.' // Change default text. Default: "No terms"
    ),
    'remove_default' => 'true', // Removes the default metabox provided by WP core.
    // Optionally override the args sent to the WordPress get_terms function.
    'query_args' => array(
        // 'orderby' => 'slug',
        // 'hide_empty' => true,
    ),
       
    ) );
    $fore_options->add_group_field( $group_field_id_category, array(
        'name' => 'تعداد  نمایش',
        'id'   => 'number',
        'type' => 'text',
        // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
    ) );
    $fore_options->add_group_field( $group_field_id_category, array(
        'name' => 'تصویر  دسته',
        'id'   => 'image',
        'type' => 'file',
    ) );










}
add_action( 'cmb2_admin_init', 'yourprefix_register_main_options_metabox' );
/**
 * A CMB2 options-page display callback override which adds tab navigation among
 * CMB2 options pages which share this same display callback.
 *
 * @param CMB2_Options_Hookup $cmb_options The CMB2_Options_Hookup object.
 */
function yourprefix_options_display_with_tabs( $cmb_options ) {
    $tabs = yourprefix_options_page_tabs( $cmb_options );
    ?>
    <div class="wrap cmb2-options-page option-<?php echo $cmb_options->option_key; ?>">
        <?php if ( get_admin_page_title() ) : ?>
            <h2><?php echo wp_kses_post( get_admin_page_title() ); ?></h2>
        <?php endif; ?>
        <h2 class="nav-tab-wrapper">
            <?php foreach ( $tabs as $option_key => $tab_title ) : ?>
                <a class="nav-tab<?php if ( isset( $_GET['page'] ) && $option_key === $_GET['page'] ) : ?> nav-tab-active<?php endif; ?>" href="<?php menu_page_url( $option_key ); ?>"><?php echo wp_kses_post( $tab_title ); ?></a>
            <?php endforeach; ?>
        </h2>
        <form class="cmb-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="POST" id="<?php echo $cmb_options->cmb->cmb_id; ?>" enctype="multipart/form-data" encoding="multipart/form-data">
            <input type="hidden" name="action" value="<?php echo esc_attr( $cmb_options->option_key ); ?>">
            <?php $cmb_options->options_page_metabox(); ?>
            <?php submit_button( esc_attr( $cmb_options->cmb->prop( 'save_button' ) ), 'primary', 'submit-cmb' ); ?>
        </form>
    </div>
    <?php
}
/**
 * Gets navigation tabs array for CMB2 options pages which share the given
 * display_cb param.
 *
 * @param CMB2_Options_Hookup $cmb_options The CMB2_Options_Hookup object.
 *
 * @return array Array of tab information.
 */
function yourprefix_options_page_tabs( $cmb_options ) {
    $tab_group = $cmb_options->cmb->prop( 'tab_group' );
    $tabs      = array();
    foreach ( CMB2_Boxes::get_all() as $cmb_id => $cmb ) {
        if ( $tab_group === $cmb->prop( 'tab_group' ) ) {
            $tabs[ $cmb->options_page_keys()[0] ] = $cmb->prop( 'tab_title' )
                ? $cmb->prop( 'tab_title' )
                : $cmb->prop( 'title' );
        }
    }
    return $tabs;
}