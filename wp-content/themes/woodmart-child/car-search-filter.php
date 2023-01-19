<?php
add_action("wp_ajax_search_filter", "search_filter_handler");
function search_filter_handler()
{
 \Logger\Log("hy");
//    if ($_REQUEST['param'] == "select_brand") {
//     $select_brand = $_REQUEST['brand'];

//     $children = get_term_children($select_brand, 'car_brand');
//     if(is_wp_error($children)){
//         wp_send_json(array("status" => 2));
//     }
//     elseif (!empty($children)) {
//         $bodyArray = [];

//         foreach ( $children as $child ) {
//            array_push($bodyArray,array('id'=>$child->id , 'name' => $child->name));
//         }
//     }

//     wp_send_json(array("status" => 1, "data" => json_encode($bodyArray)));
//     wp_die();
// }
    wp_send_json(array("status" => 1));
    wp_die();
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
       <select class="form-control form-control-lg" id="brand_selector"  name="brand_selector">
          <option>انتخاب  برند خودرو</option>
             <?php
                    foreach ($terms as $term):
                        ?>
                         <option  value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
                    <?php
                    endforeach;
                    ?>
        </select>
        <select class="form-control">
          <option>انتخاب مدل  خودرو </option>
        </select>
          <button type="submit" class="btn btn-primary">جستجو</button>
</form>
<?php
}