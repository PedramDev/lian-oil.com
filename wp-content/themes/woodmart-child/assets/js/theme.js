$ = jQuery;

$(function () {
  jQuery("#brand_selector").change(function (e) {
    var selected_brand = jQuery("#brand_selector").val();
    var payload = {};
    payload.brand = selected_brand;

    $.post(
        search_ajax_object.ajax_url+ `?action=search_filter&param=select_brand`, 
        payload, 
        function(response) {
          if(response.isSuccess){
              //load another option
          }
          else{
              //error
          }
        }
    );
    
    console.log(selected_brand)
  });
})
