$ = jQuery;

$(function () {
  jQuery("#brand_selector").change(function (e) {
    var selected_brand = jQuery("#brand_selector").val();
    var payload = {};
    payload.brand = selected_brand;
    clearCarModel();
    addDefaultCarModel();

    $('#brand_selector').attr('slug','');

    $.post(
        search_ajax_object.ajax_url+ `?action=search_filter&param=select_brand`, 
        payload, 
        function(response) {
          if(response.isSuccess){
              //load another option
              var requiredModel = response.data;
              addDefaultCarModel();
              updateCarModel(requiredModel);
          }
          else{
              //error
          }
        }
    );
    

  });

  jQuery('#brand_search_btn').click(function(e){
    e.preventDefault();

    var selected_brand = jQuery("#brand_selector").val();
    $('#brand_selector option').each((i,op) =>{
      if(op.value == selected_brand){
          $('#brand_selector').attr('slug',$(op).attr('slug'));
      }
    });

    var selected_model = jQuery("#model_selector").val();
    $('#model_selector option').each((i,op) =>{
      if(op.value == selected_model){
          $('#model_selector').attr('shortlink',$(op).attr('shortlink'));
      }
    });

    var brand = $('#brand_selector').attr('slug');
    var model = jQuery('#model_selector').val();

    var href = '//lian-oil.com/';
    
    var slug = '';
    if(brand != ''){
      slug = 'car_brand/' + brand;
    }

    if(model != ''){
      var shortlink = jQuery('#model_selector').attr('shortlink');
      window.location.href = shortlink;
      return;
    }

    window.location.href = href + slug;

  });


  var carModelDefault = '<option value="">انتخاب مدل خودرو </option>';
  var carModelHandler = '#model_selector';
  var carModelOptions = '#model_selector option';
  
  function clearCarModel(){
    $(carModelOptions).remove();
  }

  function addCarModel(item){
      $( carModelHandler ).append( `<option value='${item.id}' shortlink='${item.shortlink}'>${item.name}</option>` );
  }


  function addDefaultCarModel(){
    $( carModelHandler ).append( carModelDefault);
  }

  function updateCarModel(items){
    clearCarModel();
    addDefaultCarModel();
    if(items){
      items.forEach(item=>{
        addCarModel(item);
      })
    }
  }


})
