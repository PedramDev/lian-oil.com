jQuery(document).ready(function () {
    jQuery('#wdc_supported_cars').select2({
        placeholder: "خودرو های سازگار",
        multiple: true,
        minimumInputLength: 3,
        ajax: {
            type: 'post',
            url: wdc_object.ajax_url,
            allowClear: true,
            dataType: 'json',
            delay: 250,
            params: {
                contentType: "application/json",
            },
            data: function (term, page) {
                return {
                    query: term.term,
                    nonce: wdc_object.ajax_nonce,
                    action: 'wdc_search_car',
                };
            },
            results: function (data, page) {
                console.log(data);
                return {
                    results: data.payload,
                }
            },
            cache: false,
        },
        formatResult: function (i) {
            return '<div>' + i.title + '</div>';
        },
        formatSelection: function (i) {
            return '<div>' + i.title + '</div>';
        },
        dropdownCssClass: 'bigdrop',
        escapeMarkup: function (m) {
            return m;
        },
    });
});