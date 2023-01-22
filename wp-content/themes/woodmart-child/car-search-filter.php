<?php
add_action("wp_ajax_nopriv_search_filter", "search_filter_handler");
add_action("wp_ajax_search_filter", "search_filter_handler");
function search_filter_handler()
{
  //  \Logger\Log("hy");
  if ($_REQUEST['param'] == "select_brand") {
    $select_brand = $_REQUEST['brand'];

    $terms = get_terms(
      array(
        'taxonomy'   => 'car_brand',
        'hide_empty' => false,
        'parent'     => $select_brand
      )
    );
    if (is_wp_error($terms)) {
      wp_send_json(array("isSuccess" => false));
    } elseif (!empty($terms)) {
      $bodyArray = [];

      $args = array(
        'post_type' => 'car',
        'taxonomy' => 'car_brand',
        'tax_query' => array(
          array(
            'taxonomy' => 'car_brand',
            'field' => 'term_id',
            'terms' => $select_brand, /// Where term_id of Term 1 is "1".
            'include_children' => false
          )
        )
      );
      global $wp_query;
      $wp_query = new WP_Query($args);
      while ($wp_query->have_posts()) :
        $wp_query->the_post();
        array_push($bodyArray, array('id' => get_the_ID(), 'name' =>  get_the_title(), 'shortlink' =>  wp_get_shortlink()));
      endwhile;

    }

    wp_send_json(array("isSuccess" => true, "data" => $bodyArray));
    wp_die();
  }
}

add_shortcode("certificate_search", "search_form");
function search_form()
{

  $args = array(
    'taxonomy' => 'car_brand',
    'hide_empty' => false,
    'parent' => 0
  );
  $terms = get_terms($args);

?>
  <form>
    <select class="form-control form-control-lg" id="brand_selector" name="brand">
      <option slug="" value="">انتخاب برند خودرو</option>
      <?php
      foreach ($terms as $term) :
      ?>
        <option slug="<?php echo $term->slug; ?>" value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
      <?php
      endforeach;
      ?>
    </select>
    <select class="form-control" name="model" id="model_selector">
      <option value="">انتخاب مدل خودرو </option>
    </select>
    <input type="hidden" name="post_type" value="car" />
    <a class="btn btn-primary" id="brand_search_btn">جستجو</button>
  </form>
<?php
}
