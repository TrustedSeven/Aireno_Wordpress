jQuery(document).ready(function ($) {
    /**
    $('[data-kt-ecommerce-product-filter="search"]').keyup(function (event) {
        var txt = $(this).val();
        if (txt != '') {
            // $('.kt-quotes > div:contains("'+txt+'")').show();
            $('.kt-quotes .kt-quote').each(function(){
                if($(this).text().toUpperCase().indexOf(txt.toUpperCase()) != -1){
                    $(this).show();
                }
                else $(this).hide();
            });
        }
        else {
            $('.kt-quotes .kt-quote').show();
        }
        return false;
    });
     */
    $('[name=quote-tags]').change(function () {
        var tags = $(this).val();
        if (tags.length > 0) {
            $('.kt-quotes .kt-quote').each(function(){
                var show = false;
                for (var index in tags) {
                    var tag = tags[index];
                    if($(this).find('.kt-tags').text().toUpperCase().indexOf(tag.toUpperCase()) != -1){
                        show = true;
                    }
                }
                if (show) $(this).show(); else $(this).hide();
                console.log(show);
            });

        }
        else {
            $('.kt-quotes .kt-quote').show();
        }
        return false;
    });
});